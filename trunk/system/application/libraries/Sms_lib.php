<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sms_lib{
	
	private $user_id ;
	function Sms_lib()
	{
		$this->CI = &get_instance();
		//loads necessary libraries
        $this->CI->lang->load('freakauth');
        $this->CI->load->model('smsmodel');
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
	    
	    function send()
	    {
	    	
	    	$mobilenos_list = $this->CI->input->post('mobilenos');
	    	$mobileno_list = $this->CI->input->post('mobileno_list');
	    	if(empty($mobilenos_list) && empty($mobileno_list))
	    	$fields['mobileno'] = $this->CI->lang->line('SMS_mobileno_label');
            $fields['message'] = $this->CI->lang->line('SMS_message_label');
           
           	if(empty($mobilenos_list) && empty($mobileno_list))
            $rules['mobileno'] = $this->CI->config->item('SMS_mobileno_field_validation_smssend');
            $rules['message'] = $this->CI->config->item('SMS_message_field_validation_smssend');
            
             //-----------------------------------------------
            //ADD MORE FIELDS AND RULES HERE IF YOU NEED THEM
            //-----------------------------------------------
            
            $this->CI->fal_validation->set_fields($fields);
            $this->CI->fal_validation->set_rules($rules);
            
             //let's run the individual validation of mobile no and message
            $validation_response = $this->CI->fal_validation->run();
            $data = array();
	   		 if(!empty($mobilenos_list))
	           	{
	           		$this->CI->load->model('contactsmodel');
	           		$contacts_list = $this->CI->contactsmodel->getListByIds($mobilenos_list);
	           		$data['contacts_list'] = $contacts_list;
	           	}
           if($this->CI->fal_validation->run())
           {
           	
           		// get user id from session and insert into sms table 
           		$user_id = $this->user_id;
           		$mobileno = $this->CI->input->post('mobileno');
           		
           		$to_list = '';
           		if(!empty($mobileno_list))
           		{
           			$to_list = implode(';', $mobileno_list);
           		}
           		$mobilenos = explode(',', $mobileno);
           		$message = $this->CI->input->post('message');
           		$values = array(
           							'user_id'		=> $user_id,
           							'to_numbers'	=> implode(';', $mobilenos),
           							'message'		=> $message,
           							'createddate'	=> date ("Y-m-d H:i:s"),
           							'to_list'		=> $to_list,
           		);
           		$this->CI->smsmodel->insert($values);
           		flashMsg('Message Send Successfully');
           		redirect('sms');
           }
           else
           {
           		return $this->CI->load->view($this->CI->config->item('SMS_send_view'), $data, TRUE);
           }
	    }
	    
	    function sentlist()
	    {
	    	$result = $this->CI->smsmodel->getSmsListById($this->user_id);
	    	$data = array('list'=>$result);
	    	return $this->CI->load->view($this->CI->config->item('SMS_sent_list_view'), $data, TRUE);
	    }
	    
}
