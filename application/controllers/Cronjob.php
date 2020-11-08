<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjob extends CI_Controller {

    public function index(){
        $username= $this->config->item('username');
        $password= $this->config->item('password');
        $postData=[
            'username'=>$username,
            'password'=>$password
        ];
        $json=execute_curl_post("loginAdmin",$postData,"");
        $token=$json["token"];
        $json=execute_curl_get("user/getPremiumUserInformation",$token);
        $date= new DateTime('2020-11-16');
        $dateString=$date->format('Y-m-d');
        $postData=[
            'tanggal_charge'=>$dateString
        ];
        foreach($json as $user){
            $expired_user=new DateTime($user["premium_available_until"]);
            if($date->diff($expired_user)->days===0){
                $id_user=$user["id_user"];
                $json=execute_curl_post("user/chargeUser/".$id_user,$postData,$token);
            }
        }
    }
}