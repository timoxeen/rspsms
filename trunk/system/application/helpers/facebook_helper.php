<?php

	function facebook_xmlns()
	{
		return 'xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/"';
	}
	
	function facebook_app_id()
	{
		$ci =& get_instance();
		
		return $ci->config->item('facebook_app_id');
	}
	
	function facebook_picture($who = 'me')
	{
		$ci =& get_instance();
		
		return $ci->facebook->append_token($ci->config->item('facebook_api_url').$who.'/picture');
	}
	
	function getFbLogin_Url()
	{
		$ci =& get_instance();
		return $ci->facebook_connect->getFbLoginUrl();
	}
	function getFbLogout_Url()
	{
		$ci =& get_instance();
		return $ci->facebook_connect->getFbLogoutUrl(array('next' =>site_url('fbauth/logout')));
	}
	
	function getFbUserDetails()
	{
		$ci =& get_instance();
		return $data = $ci->facebook_connect->getUserDetails();
	}
	function isFbLoggedIn()
	{
		$ci =& get_instance();
		return $ci->facebook_connect->is_loggedIn();
	}
	
	/**
	 * retuns fb sessions
	 */
	function getFbSessions()
	{
		$ci =& get_instance();
		return $ci->facebook_connect->getSessions();
	}
	
	function getMyDetails()
	{
		$ci =& get_instance();
		
		$data = $ci->facebook_connect->getUserDetails();
		$result = array();
		if(!empty($data))
		{
			$result = array(
							'fbid'		=> $data['id'],
					//		'firstname'	=> $data['first_name'],
					//		'lastname'	=> $data['last_name'],
					//		'name'		=> $data['name'],
			);
		}
		return $result;
	}
	function facebook_opengraph_meta($opengraph)
	{
		$ci =& get_instance();
		
		$return = '<meta property="fb:admins" content="'.$ci->config->item('facebook_admins').'" />';
		$return .= "\n";
		$return .= '<meta property="fb:app_id" content="'.$ci->config->item('facebook_app_id').'" />';
		$return .= "\n";
		$return .= '<meta property="og:site_name" content="'.$ci->config->item('facebook_site_name').'" />';
		$return .= "\n";	 
		
		foreach ( $opengraph as $key => $value )
		{
			$return .= '<meta property="og:'.$key.'" content="'.$value.'" />';
			$return .= "\n";
		}
		
		return $return;
	}