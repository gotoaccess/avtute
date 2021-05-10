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
	if (!function_exists('pre')) {
	    function pre($data) {
				if (is_array($data)) {
					return '<pre>'.print_r($data).'</pre>';
				}else{
					echo "Variable is not array";
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
if(!function_exists('objectToArray')){
		function objectToArray($d) {
				if (is_object($d)) {
						// Gets the properties of the given object
						// with get_object_vars function
						$d = get_object_vars($d);
				}

				if (is_array($d)) {
						/*
						* Return array converted to object
						* Using __FUNCTION__ (Magic constant)
						* for recursive call
						*/
						return array_map(__FUNCTION__, $d);
				}
				else {
						// Return array
						return $d;
				}
		}
	}


if(!function_exists('objectToArray')){

	function arrayToObject($d) {
        if (is_array($d)) {
            /*
            * Return array converted to object
            * Using __FUNCTION__ (Magic constant)
            * for recursive call
            */
            return (object) array_map(__FUNCTION__, $d);
        }
        else {
            // Return object
            return $d;
        }
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

	if(!function_exists('my_date_show_time')){
	    function my_date_show($date){
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"M Y ");
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

	if(!function_exists('get_section')) {
		function get_section($path = ''){
			$ci = get_instance();
			$var = $ci->load->view($path);
			return $var;
		}
	}
