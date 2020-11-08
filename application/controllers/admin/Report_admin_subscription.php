<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_admin_subscription extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $token = $this->session->userdata('token');
        $data = array();
        $data['page_title'] = 'Report Subscription Pengguna';
        $data_transaksi=execute_curl_get("admin/getReportTransaksi",$token);
        $data['data_transaksi']=$data_transaksi;
        $data['main_content']=$this->load->view('admin/report_admin/report_subscription',$data,TRUE);
        $this->load->view('admin/index', $data);
    }
}