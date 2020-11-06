<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 
    public function index(){
        $token = $this->session->userdata('token');
        $data = array();
        $jumlah_user=execute_curl_get("admin/getJumlahUser",$token);
        $jumlah_laporan_lostfound=execute_curl_get("admin/getTotalLaporanLostFound",$token);
        $jumlah_laporan_kriminalitas=execute_curl_get("admin/getTotalLaporanKriminalitas",$token);
        $data_kategori_laporan_lostfound=execute_curl_get("admin/getJumlahLaporanLostFoundPerJenis",$token);
        $headline_laporan_lostfound=execute_curl_get("laporan/getHeadlineLaporanLostFound",$token);
        $headline_laporan_kriminalitas=execute_curl_get("laporan/getHeadlineLaporanKriminalitas",$token);
        $data['page_title'] = 'Dashboard';
        $data['jumlah_user']=$jumlah_user["count"];
        $data['jumlah_laporan_lostfound']=$jumlah_laporan_lostfound["count"];
        $data['jumlah_laporan_kriminalitas']=$jumlah_laporan_kriminalitas["count"];
        $data['data_kategori_laporan_lostfound']=$data_kategori_laporan_lostfound;
        $data['headline_laporan_lostfound']=$headline_laporan_lostfound;
        $data['headline_laporan_kriminalitas']=$headline_laporan_kriminalitas;
        $data['main_content'] = $this->load->view('admin/home', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


/****************Function login**********************************
     * @type            : Function
     * @function name   : backup
     * @description     : Force database to be downloaded. 
     *                    if user or admin click on download button.
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */

}