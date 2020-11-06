<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('execute_curl_get')){
	    function execute_curl_get($url,$token){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
	        $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$token
            ));
			$curl_response = curl_exec($ch);  
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

	if(!function_exists('execute_curl_post')){
	    function execute_curl_post($url,$postData,$token){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
	        $ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$token
            ));
			$curl_response = curl_exec($ch);  
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

	if(!function_exists('execute_curl_put')){
	    function execute_curl_put($url,$token){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url);  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$token
            ));
			$curl_response = curl_exec($ch);  
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

	if(!function_exists('execute_curl_delete')){
	    function execute_curl_delete($url,$token){    
			$API_URL="http://adrian-webservice.ta-istts.com/";    
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$API_URL.$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: '.$token
            ));
			$curl_response = curl_exec($ch);
			$json = json_decode(utf8_encode($curl_response), true);
			curl_close($ch);
			return $json;
	    }
	}

  