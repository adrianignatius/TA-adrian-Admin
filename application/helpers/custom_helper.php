<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//-- check logged user
	if (!function_exists('check_login_user')) {
	    function check_login_user() {
	        $ci = get_instance();
	        if ($ci->session->userdata('is_login') != TRUE) {
	            $ci->session->sess_destroy();
	            redirect(base_url('auth'));
	        }
	    }
	}

	if(!function_exists('check_power')){
	    function check_power($type){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_power($type);        
	        
	        return $option;
	    }
    } 

	//-- current date time function
	if(!function_exists('current_datetime')){
	    function current_datetime(){        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}

	//-- show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	//-- show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	if(!function_exists('execute_curl_get')){
	    function execute_curl_get($url){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
	        $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$curl_response = curl_exec($ch);  
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

	if(!function_exists('execute_curl_put')){
	    function execute_curl_put($url){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url);  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			$curl_response = curl_exec($ch);  
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

	if(!function_exists('execute_curl_delete')){
	    function execute_curl_delete($url){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			$curl_response = curl_exec($ch);
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

  