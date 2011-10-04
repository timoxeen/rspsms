<?php
class Contacts_lib{

	function Contacts_lib()
	{
		$this->CI = &get_instance();
		$this->CI->lang->load('freakauth');
		$this->CI->load->model('contactsmodel');
		if (!class_exists('CI_Validation'))
		{
		     $this->CI->load->library('validation');
		}
		//let's load the FAL_validation library if it isn't already loaded
		if (!class_exists('FAL_validation'))
		{
		     $this->CI->load->library('FAL_validation');
		}
		
		
		$this->CI->fal_validation->set_error_delimiters($this->CI->config->item('FAL_error_delimiter_open'), $this->CI->config->item('FAL_error_delimiter_close'));
		
		$this->user_id = $this->CI->db_session->userdata('id');
	}

	function listContacts()
	{
		$list = $this->CI->contactsmodel->getListById($this->user_id);
		$data['list']= $list;
		return $this->CI->load->view($this->CI->config->item('SMS_contacts_list_view'), $data, TRUE);
	}
	function menu()
	{
		$data['menu_show']= false;
		$data['menu_list']= true;
		return $this->CI->load->view($this->CI->config->item('SMS_contacts_menu_view'), $data, TRUE);
	}
	function addContact()
	{
		$this->CI->load->plugin('gmail_contacts');
		
		if(strstr($_SERVER['REQUEST_URI'],'?'))
		{
			$tokens = array();
			$responce = $_SERVER['REQUEST_URI'];
			$responcearr = explode('?',$responce);
			if(!empty($responcearr))
			{
				$gets = explode('&',$responcearr[1]);
				if(!empty($gets))
				{
					
					foreach($gets as $value)
					{
						$array = explode('=',$value);
						if(!empty($array))
						$tokens[$array[0]] = $array[1];
					}
				}
			}
			
			$contacts = getContacts($tokens,$this->CI->config->item('SMS_google_ckey'),$this->CI->config->item('SMS_google_csecretkey'),$this->CI->config->item('SMS_google_callbackurl'));
			$data['contacts'] = $contacts;
			return $this->CI->load->view($this->CI->config->item('SMS_gcontacts_list_view'), $data, TRUE);
			die();
		}
				
		$fields['mobileno'] = $this->CI->lang->line('SMS_mobileno_label');
		$fields['full_name'] = $this->CI->lang->line('SMS_fullname_label');
		$rules['mobileno'] = $this->CI->config->item('SMS_mobileno_field_validation_smssend');
		$rules['full_name'] = $this->CI->config->item('SMS_fullname_field_validation_smssend');
		$this->CI->fal_validation->set_fields($fields);
		$this->CI->fal_validation->set_rules($rules);
		$data['ss'] = '';
		 if($this->CI->fal_validation->run())
           {
           		$user_id = $this->user_id;
           		$mobileno = $this->CI->input->post('mobileno');
           		$fullname = $this->CI->input->post('full_name');
           		$values = array(
           							'user_id'		=> $user_id,
           							'name'			=> $fullname,
           							'mobileno'		=> $mobileno,
           							'createdon'	    => date ("Y-m-d H:i:s"),
           		);
           		$this->CI->contactsmodel->insert($values);
           		flashMsg('Contact added Successfully');
           		redirect('contacts/show');
           }
           else
           {
           
			$data['gconnect'] = getGoogleConnectLink($this->CI->config->item('SMS_google_ckey'),$this->CI->config->item('SMS_google_csecretkey'),$this->CI->config->item('SMS_google_callbackurl'));
           	return $this->CI->load->view($this->CI->config->item('SMS_contacts_form_view'), $data, TRUE);
           }
		
	}
}