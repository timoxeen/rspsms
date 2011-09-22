<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Enter description here ...
 * @author rampelli
 *
 */
class Smsapi{
	
	private $user_id ;
	function Smsapi()
	{
		$this->CI = &get_instance();
		//loads necessary libraries
        $this->CI->lang->load('freakauth');
        $this->CI->load->model('smsmodel');
        $this->CI->load->model('smsregistermodel');
        
        //lets load the validation class if it hasn't been already loaded
        //it is needed by the FAL_validation library
        if (!class_exists('CI_Validation'))
		{
		     $this->CI->load->library('validation');
		}
		//let's load the FAL_validation library if it isn't already loaded
		if (!class_exists('FAL_validation'))
		{
		     $this->CI->load->library('FAL_validation');
		}
		
		//let's load the Freakauth_light library if it isn't already loaded
		//or autoloaded
		if (!class_exists('Freakauth_light'))
		{
		     $this->CI->load->library('Freakauth_light', 'freakauth_light');
		}
       
		//let's check if we have core classes extensions, and if we have them
		//let's load them
    	if ($this->CI->config->item('FAL_use_extensions'))
    	{
    	    $this->_loadExtensions();
    	}
    	else
    	{
    	    log_message('debug', 'FAL not using extensions');
    	}
       
		$this->CI->fal_validation->set_error_delimiters($this->CI->config->item('FAL_error_delimiter_open'), $this->CI->config->item('FAL_error_delimiter_close'));
		
		$this->user_id = $this->CI->db_session->userdata('id');
	}
	function _loadExtensions()
	    {
	  
	        if (file_exists(APPPATH.'libraries/MyFAL'.EXT) OR file_exists(BASEPATH.'libraries/MyFAL'.EXT))
	        {
	            //let's load the core library (i.e. FreakAuth_light.php) extension
	            $this->CI->load->library('MyFAL');
	            
	            $this->CI->freakauth_light = new MyFAL();
	            log_message('debug', 'MyFAL library loaded');
	            log_message('debug', 'MyFAL class assigned to $this->CI->freakauth_light');
	        }
	        else
	        {
	            log_message('debug', 'MyFAL class not found');
	        }
	
	        if (file_exists(APPPATH.'libraries/MyFALVal'.EXT) OR file_exists(BASEPATH.'libraries/MyFALVal'.EXT))
	        {
	            //let's load the validation library (i.e. FAL_validation.php) extension
	            //and assign it to $this->CI->fal_validation
	            $this->CI->load->library('MyFALVal');
	            $this->CI->fal_validation = new MyFALVal();
	
	        }
	        else
	        {
	            log_message('debug', 'MyFALVal class not found');
	        }
	    }
	    
	    
	function sendMessage($id, $user, $password_email, $mobileno, $activation_code)
	{
		$activation_url = site_url($this->CI->config->item('FAL_activation_uri').'/'.$id.'/'.$activation_code);
        $data = array('activation_url' => $activation_url,
                      'user_name' => $user,
                      'password'=>$password_email,
                      'activation_code' => $activation_code); 

        $message = $this->CI->load->view($this->CI->config->item('FAL_activation_email'), $data, true);
		
        $subject= '['.$this->CI->config->item('FAL_website_name').'] '.$this->CI->lang->line('FAL_activation_email_subject');
        $this->_savetodb($mobileno, $subject , $message);
	}

	function _savetodb($mobileno, $subject , $message)
	{
		$user_id = $this->user_id;
		$values = array(
           							'to_mobile'	=> $mobileno,
           							'message'		=> $message,
           							'createddate'	=> date ("Y-m-d H:i:s"),
           		);
		$this->CI->smsregistermodel->insert($values);
		
		$responce = $this->sendViaApi($mobileno,$message);
	}
	
	
	function sendViaApi($mobile,$message)
	{
		$username="ysharath";
		$api_password="c4465qslu1ni25mb6";
		$sender="sendsms";
		$domain="www.justsmsvisa.com";
		$priority="1";// 1-Normal,2-Priority,3-Marketing
		$method="GET";
		
		//---------------------------------
		
		if(isset($message) && $message!='')
		{
			$username=urlencode($username);
			$password=urlencode($api_password);
			$sender=urlencode($sender);
			$message=urlencode($message);
			
			$parameters="username=$username&api_password=$api_password&sender=$sender&to=$mobile&message=$message&priority=$priority";
		
			$url="http://$domain/pushsms.php";

			$ch = curl_init($url);
		
			if($method=="POST")
			{
				curl_setopt($ch, CURLOPT_POST,1);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
			}
			else
			{
				$get_url=$url."?".$parameters;
		
				curl_setopt($ch, CURLOPT_POST,0);
				curl_setopt($ch, CURLOPT_URL, $get_url);
			}
		
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
			curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
			$return_val = curl_exec($ch);
		
			if($return_val=="")
			return false;
			else
			return $return_val;
			
			return true;
		
		}
		
	}
}
	 