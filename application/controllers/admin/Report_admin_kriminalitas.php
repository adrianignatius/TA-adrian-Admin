<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_admin_kriminalitas extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

    public function index(){
        $token = $this->session->userdata('token');
        $data = array();
        $data['page_title'] = 'Report laporan kriminalitas';
        $marker=execute_curl_get("admin/getMarkerLocationLaporanKriminalitas",$token);
        $data_kecamatan=execute_curl_get("admin/getJumlahLaporanKriminalitasKecamatan",$token);
        $data_kejadian=execute_curl_get("admin/getJumlahLaporanKriminalitasPerKejadian",$token);
        $data_chart=execute_curl_get("admin/getDataLaporanKriminalitasForChartKecamatan",$token);
        $data['marker']=$marker;
        $data['data_kejadian']=$data_kejadian;
        $data['data_chart']=$data_chart;
        $data['data_kecamatan']=$data_kecamatan["data"];
        $data['max_laporan']=$data_kecamatan["max"];
        $data['main_content']=$this->load->view('admin/report_admin/report_kriminalitas',$data,TRUE);
        $this->load->view('admin/index', $data);
    }
}