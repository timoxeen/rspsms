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
           	return $this->CI->load->view($this->CI->config->item('SMS_contacts_form_view'), $data, TRUE);
           }
		
	}
}