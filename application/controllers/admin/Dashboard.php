<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 
    public function index(){
        $data = array();
        $data['page_title'] = 'Dashboard';
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