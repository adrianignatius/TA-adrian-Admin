<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_admin_lostfound extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $token = $this->session->userdata('token');
        $data = array();
        $data['page_title'] = 'Report laporan lost & found';
        $marker=execute_curl_get("admin/getMarkerLocationLaporanLostFound",$token);
        $data_kecamatan=execute_curl_get("admin/getJumlahLaporanLostFoundKecamatan",$token);
        $data_item=execute_curl_get("admin/getJumlahLaporanLostFoundPerItem",$token);
        $data_chart=execute_curl_get("admin/getDataLaporanLostFoundForChartKecamatan",$token);
        $data['marker']=$marker;
        $data['data_item']=$data_item;
        $data['data_chart']=$data_chart;
        $data['data_kecamatan']=$data_kecamatan["data"];
        $data['max_laporan']=$data_kecamatan["max"];
        $data['main_content']=$this->load->view('admin/report_admin/report_lostfound',$data,TRUE);
        $this->load->view('admin/index', $data);
    }
}