<?php
	class Fbauth extends Controller{
		function Fbauth()
		{
			parent::__construct();
			$this->_container = $this->config->item('FAL_template_dir').'template/container';
		}
		
		function logout()
		{
			$data['heading'] = 'SendSMS2India';
			$ddd = getFbSessions();
			unset($_COOKIE['fbs_114652618609282']);
			if(!$this->db_session->userdata('iffbloggedout'))
			{
				if(getFbSessions())
				{
					if(!getFbUserDetails())
					{
						$_COOKIE['fbs_114652618609282'] = '';
						unset($_COOKIE['fbs_114652618609282']);
						$data['sms'] = anchor('sms','SMS',array('data-icon'=>'custom'));
						$data['contacts'] = anchor('contacts','Contacts',array('data-icon'=>'custom'));
						$data['page'] = $this->config->item('FAL_template_dir').'template/fbauth/logout';
				    	$data['header'] = true;
				    	$data['navigation'] = false;
					}
				}
				else 
				{
					redirect('');
					/*$data['page'] = $this->config->item('FAL_template_dir').'template/home';
					$data['header'] = false;
					$data['navigation'] = false;*/
				}
			}
			else
			{
				 $this->CI->db_session->unset_userdata('iffbloggedout');
			}
	        
	        $this->load->vars($data);
	
			$this->load->view($this->_container);
		}
		
	}