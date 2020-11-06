<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    var $API="";
	public function __construct(){
        $this->API="http://adrian-webservice.ta-istts.com/";
        parent::__construct();
    }


    public function index()
    {
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function daftar_user(){
        $token = $this->session->userdata('token');
        $url= $this->config->item('url');
        $json=execute_curl_get("admin/getAllUser",$token);
        $data['page_title'] = 'Daftar user';
        $data['users'] = $json;
        $data['main_content'] = $this->load->view('admin/user/daftar_user', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
    
    public function active($id) 
    {
        $token = $this->session->userdata('token');
        $json=execute_curl_put("admin/activateUser/".$id,$token);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/user/daftar_user'));
    }

    public function deactive($id) 
    {
        $token = $this->session->userdata('token');
        $json=execute_curl_put("admin/banUser/".$id,$token);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/user/daftar_user'));
    }

    public function accept($id){
        $json=execute_curl_put("admin/acceptUser/".$id,$token);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/user/daftar_user'));
    }

}