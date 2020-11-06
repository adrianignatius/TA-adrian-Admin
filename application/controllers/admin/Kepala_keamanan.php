<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kepala_keamanan extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function getKecamatan(){
        $json=execute_curl_get("settings/getKecamatan");
        return $json;
    }

    public function index()
    {
        $data['page_title'] = 'Kepala keamanan';
        $kecamatan=$this->getKecamatan();
        $data['kecamatan'] = $kecamatan;
        $data['main_content'] = $this->load->view('admin/kepala_keamanan/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function add(){
        $url= $this->config->item('url');
        $nama_user=$this->input->post('nama_user');
        $telpon_user=$this->input->post('telpon_user');
        $password_user=$this->input->post('password_user');
        $kecamatan_user=$this->input->post('kecamatan_user');
        if($nama_user==""||$telpon_user==""||$password_user==""){
            $this->session->set_flashdata('error_msg', 'Harap lengkapi semua data terlebih dahulu');
            redirect(base_url('admin/kepala_keamanan'));
        }else{
            $ch = curl_init();  
            $postData=[
                'nama_user'=>$nama_user,
                'telpon_user'=>$telpon_user,
                'password_user'=>$password_user,
                'id_kecamatan_user'=>$kecamatan_user
            ];
            curl_setopt($ch, CURLOPT_URL,$url."admin/addKepalaKeamanan"); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $curl_response = curl_exec($ch);  
            $json = json_decode(utf8_encode($curl_response), true);
            curl_close($ch);
            if($json["status"]=="1"){
                $this->session->set_flashdata('msg', 'Tambah kepala keamanan berhasil!');
                redirect(base_url('admin/kepala_keamanan'));
            }else{
                $this->session->set_flashdata('error_msg', 'Tambah kepala keamanan gagal, coba beberapa saat lagi');
                redirect(base_url('admin/kepala_keamanan'));
            }
        }
    }

    public function daftar_kepala_keamanan(){
        $url= $this->config->item('url');
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url."admin/getKepalaKeamanan"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $curl_response = curl_exec($ch);  
        $json = json_decode(utf8_encode($curl_response), true);
        curl_close($ch);
        $data['page_title'] = 'Daftar kepala keamanan';
        $data['kepala_keamanan'] = $json;
        $data['main_content'] = $this->load->view('admin/kepala_keamanan/daftar_kepala_keamanan', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function daftar_user(){
        $url= $this->config->item('url');
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url."admin/getAllUser"); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $curl_response = curl_exec($ch);  
        $json = json_decode(utf8_encode($curl_response), true);
        curl_close($ch);
        $data['page_title'] = 'Daftar user';
        $data['user'] = $json;
        $data['main_content'] = $this->load->view('admin/user/daftar_user', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update($id){
        $token = $this->session->userdata('token');
        $url= $this->config->item('url');
        if($_POST){
            $nama_user=$this->input->post('nama_user');
            $kecamatan_user=$this->input->post('kecamatan_user');
            $data = array(
                'nama_user' => $nama_user,
                'id_kecamatan_user' => $kecamatan_user,
            );
            $ch = curl_init($url."admin/updateKepalaKeamanan/".$id);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $curl_response = curl_exec($ch);  
            $json = json_decode(utf8_encode($curl_response), true);
            curl_close($ch);
            if($json["status"]=="1"){
                $this->session->set_flashdata('msg', $json["message"]);
                redirect(base_url('admin/kepala_keamanan/daftar_kepala_keamanan'));
            }
        }
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL,$url."user/getUser/".$id); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: '.$token
          ));
        $curl_response = curl_exec($ch);  
        $json = json_decode(utf8_encode($curl_response), true);
        curl_close($ch);
        $data['kepala_keamanan'] = $json;
        $data['kecamatan'] = $this->getKecamatan();
        $data['main_content'] = $this->load->view('admin/kepala_keamanan/edit_kepala_keamanan', $data, TRUE);
		$data['page_title'] = 'Edit Kepala Keamanan';
        $this->load->view('admin/index', $data);
    }

    public function active($id) 
    {
        $url= $this->config->item('url');
        $data = array("id_user" => $id);
        $ch = curl_init($url."admin/activateUser/".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        $curl_response = curl_exec($ch);  
        $json = json_decode(utf8_encode($curl_response), true);
        curl_close($ch);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/kepala_keamanan/daftar_kepala_keamanan'));
    }

    public function deactive($id) 
    {
        $url= $this->config->item('url');
        $data = array("id_user" => $id);
        $ch = curl_init($url."admin/banUser/".$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
        $curl_response = curl_exec($ch);  
        $json = json_decode(utf8_encode($curl_response), true);
        curl_close($ch);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/kepala_keamanan/daftar_kepala_keamanan'));
    }
    
}