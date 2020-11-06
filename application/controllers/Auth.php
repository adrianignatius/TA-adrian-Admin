<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }


    public function index(){
        $this->load->view('admin/login');
    }

    public function login(){
        $url= $this->config->item('url');
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $this->session->set_userdata('is_login',TRUE);
        $ch = curl_init();  
        $postData=[
            'username'=>$username,
            'password'=>$password
        ];
        curl_setopt($ch, CURLOPT_URL,$url."loginAdmin"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $curl_response = curl_exec($ch);  
        $json = json_decode(utf8_encode($curl_response), true);
        curl_close($ch);
        if($json["status"]=="200"){
            $this->session->set_userdata('token',$json["token"]);
            redirect(base_url().'admin/dashboard', 'refresh');
        }else{
            $this->session->set_flashdata('msg', $json["message"]);
            redirect(base_url() . 'auth', 'refresh');
        }
    }

    
    function logout(){
        $this->session->sess_destroy();
        $this->load->view('admin/login');
    }

}