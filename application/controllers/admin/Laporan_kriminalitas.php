<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_kriminalitas extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $token = $this->session->userdata('token');
        $data = array();
        $data['page_title'] = 'Verifikasi Laporan Kriminalitas';
        $json=execute_curl_get("admin/getLaporanKriminalitasVerify",$token);
        $data['laporan_kriminalitas']=$json;
        $data['main_content'] = $this->load->view('admin/laporan_kriminalitas/verifikasi_laporan_kriminalitas', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function detail($id){
        $token = $this->session->userdata('token');
        $data = array();
        $data['page_title'] = 'Detail Laporan Kriminalitas';
        $json=execute_curl_get("admin/getDetailLaporanKriminalitas/".$id,$token);
        $data['laporan']=$json;
        $data['main_content'] = $this->load->view('admin/laporan_kriminalitas/detail_laporan_kriminalitas', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function verifikasiLaporan($id){
        $token = $this->session->userdata('token');
        $json=execute_curl_put("admin/verifikasiLaporanKriminalitas/".$id,$token); 
        $this->session->set_flashdata('msg', "Laporan ".$id." berhasil diverifikasi");
        redirect(base_url('admin/laporan_kriminalitas'));
    }

    public function declineLaporan($id){
        $token = $this->session->userdata('token');
        $json=execute_curl_put("admin/declineLaporanKriminalitas/".$id,$token);
        $this->session->set_flashdata('msg', "Laporan ".$id." berhasil ditolak");
        redirect(base_url('admin/laporan_kriminalitas'));
    }
}