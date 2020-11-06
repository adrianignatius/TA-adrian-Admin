<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    var $API="";
	public function __construct(){
        $this->API="http://adrian-webservice.ta-istts.com/";
        parent::__construct();
    }


    public function index()
    {
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function daftar_user(){
        $url= $this->config->item('url');
        $json=execute_curl_get("admin/getAllUser");
        $data['page_title'] = 'Daftar user';
        $data['users'] = $json;
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/user/daftar_user', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function all_user_list()
    {
	 	$data['page_title'] = 'All Registered Users';
        $data['users'] = $this->common_model->get_all_user();
        $data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/user/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- update users info
    public function update($id)
    {
        if ($_POST) {

            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'mobile' => $_POST['mobile'],
                'country' => $_POST['country'],
                'role' => $_POST['role']
            );
            $data = $this->security->xss_clean($data);

            $powers = $this->input->post('role_action');
            if (!empty($powers)) {
                $this->common_model->delete_user_role($id, 'user_role');
                foreach ($powers as $value) {
                   $role_data = array(
                        'user_id' => $id,
                        'action' => $value
                    ); 
                   $role_data = $this->security->xss_clean($role_data);
                   $this->common_model->insert($role_data, 'user_role');
                }
            }

            $this->common_model->edit_option($data, $id, 'user');
            $this->session->set_flashdata('msg', 'Information Updated Successfully');
            redirect(base_url('admin/user/all_user_list'));
        }
		
        $data['user'] = $this->common_model->get_single_user_info($id);
        $data['user_role'] = $this->common_model->get_user_role($id);
        $data['power'] = $this->common_model->select('user_power');
        $data['country'] = $this->common_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/edit_user', $data, TRUE);
		$data['page_title'] = 'Edit Users';
        $this->load->view('admin/index', $data);
        
    }

    
    public function active($id) 
    {
        $json=execute_curl_put("admin/activateUser/".$id);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/user/daftar_user'));
    }

    public function deactive($id) 
    {
        $json=execute_curl_put("admin/banUser/".$id);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/user/daftar_user'));
    }

    public function accept($id){
        $json=execute_curl_put("admin/acceptUser/".$id);
        if($json["status"]=="1"){
            $this->session->set_flashdata('msg', $json["message"]);
        }else{
            $this->session->set_flashdata('error_msg', $json["message"]);
        }
        redirect(base_url('admin/user/daftar_user'));
    }

    //-- add user power
    public function add_power()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name'],
                'power_id' => $_POST['power_id']
            );
            $data = $this->security->xss_clean($data);
            
            //-- check duplicate power id
            $power = $this->common_model->check_exist_power($_POST['power_id']);
            if (empty($power)) {
                $user_id = $this->common_model->insert($data, 'user_power');
                $this->session->set_flashdata('msg', 'Power added Successfully');
            } else {
                $this->session->set_flashdata('error_msg', 'Power id already exist, try another one');
            }
            redirect(base_url('admin/user/power'));
        }
        
    }

    //--update user power
    public function update_power()
    {   
        if (isset($_POST)) {
            $data = array(
                'name' => $_POST['name']
            );
            $data = $this->security->xss_clean($data);
            
            $this->session->set_flashdata('msg', 'Power updated Successfully');
            $user_id = $this->common_model->edit_option($data, $_POST['id'], 'user_power');
            redirect(base_url('admin/user/power'));
        }
        
    }

    public function delete_power($id)
    {
        $this->common_model->delete($id,'user_power'); 
        $this->session->set_flashdata('msg', 'Power deleted Successfully');
        redirect(base_url('admin/user/power'));
    }


}