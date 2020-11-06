<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 
    public function index(){
        $data = array();
        $jumlah_user=execute_curl_get("admin/getJumlahUser");
        $jumlah_laporan_lostfound=execute_curl_get("admin/getTotalLaporanLostFound");
        $jumlah_laporan_kriminalitas=execute_curl_get("admin/getTotalLaporanKriminalitas");
        $data_kategori_laporan_lostfound=execute_curl_get("admin/getJumlahLaporanLostFoundPerJenis");
        $headline_laporan_lostfound=execute_curl_get("laporan/getHeadlineLaporanLostFound");
        $data['page_title'] = 'Dashboard';
        $data['jumlah_user']=$jumlah_user["count"];
        $data['jumlah_laporan_lostfound']=$jumlah_laporan_lostfound["count"];
        $data['jumlah_laporan_kriminalitas']=$jumlah_laporan_kriminalitas["count"];
        $data['data_kategori_laporan_lostfound']=$data_kategori_laporan_lostfound;
        $data['headline_laporan_lostfound']=$headline_laporan_lostfound;
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