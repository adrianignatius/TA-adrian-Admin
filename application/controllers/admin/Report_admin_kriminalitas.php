<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_admin_kriminalitas extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data = array();
        $data['page_title'] = 'Laporan';
        $marker=execute_curl_get("admin/getMarkerLocationLaporanLostFound");
        $count=execute_curl_get("admin/getJumlahLaporanLostFound");
        $data_kecamatan=execute_curl_get("admin/getJumlahLaporanLostFoundKecamatan");
        $data_item=execute_curl_get("admin/getJumlahLaporanLostFoundPerItem");
        $data['marker']=$marker;
        $data['count']=$count["count"];
        $data['data_item']=$data_item;
        $data['data_kecamatan']=$data_kecamatan["data"];
        $data['max_laporan']=$data_kecamatan["max"];
        $data['main_content']=$this->load->view('admin/report_admin/report_kriminalitas',$data,TRUE);
        $this->load->view('admin/index', $data);
    }
}