<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Komentar extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $token = $this->session->userdata('token');
        $data = array();
        $data['page_title'] = 'Manage Komentar';
        $json=execute_curl_get("admin/getKomentarLaporan",$token);
        $data['komentar']=$json;
        $data['main_content'] = $this->load->view('admin/komentar/manage_komentar', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function delete($id)
    {
        $token = $this->session->userdata('token');
        $json=execute_curl_delete("admin/deleteKomentarLaporan/".$id,$token);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
            redirect(base_url('admin/komentar'));
        }
        // $data['komentar']=$json;
        // $data['main_content'] = $this->load->view('admin/komentar/manage_komentar', $data, TRUE);
        // $this->load->view('admin/index', $data);
    }
}