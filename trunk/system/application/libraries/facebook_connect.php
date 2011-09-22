<?php

include "facebook/facebook.php";
class facebook_connect {

	private $_api_key;
	private $_api_secret;
	private $facebook_connect;
	private $session;
	private $user_id;
	private $me;
	function __construct()
	{
		$this->_obj =& get_instance();
		$this->_obj->load->config('facebook');
		$this->_obj->load->helper('facebook');
		 $this->_api_key 	= $this->_obj->config->item('facebook_app_id');
		$this->_api_secret 	= $this->_obj->config->item('facebook_api_secret');
		$this->facebook_connect = new Facebook(array(
			  'appId' => $this->_api_key,
			  'secret' => $this->_api_secret,
			  'cookie' => true,
		));
	}

	function getSessions()
	{
		$this->session = $this->facebook_connect->getSession();
		return $this->session;
	}
	
	/**
	 * checks weather facebook account is loged in or not
	 * @return session object contains acctoken expiary time 
	 */
	function is_loggedIn()
	{
		if($this->getSessions())
		{
		if ($this->session) {
				return true;
			/*if(isset($_COOKIE['fbs_114652618609282']))
			{
				return true;
			}*/
		  /*try {
		    $this->user_id = $this->facebook_connect->getUser();
		    $this->me = $this->facebook_connect->api('/me');
		  } catch (FacebookApiException $e) {
		    error_log($e);
		  }*/
		}
		}
		
		if ($this->me) {
			return true;
		} else {
			return false;
		}
		
	}
	
	function getLoginAnchor()
	{
		if($this->is_loggedIn())
		{
			$logoutUrl = $this->facebook_connect->getLogoutUrl();
			return '<a href="'.$logoutUrl.'">
      <img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif">
    </a>';
			
		} else {
			$loginUrl = $this->facebook_connect->getLoginUrl();
			return '<a href="'.$loginUrl.'&display=touch">
        <img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif">
      </a>';
		}
	}
	
	function getFbLoginUrl()
	{
		$loginUrl = $this->facebook_connect->getLoginUrl(array('display'=>'touch','scope'=>'email'),base_url().'auth/facebook');
		return $loginUrl;
	}
	
	function getFbLogoutUrl($params)
	{
		$logoutUrl = $this->facebook_connect->getLogoutUrl($params);
		return $logoutUrl;
	}
	function getUserDetails()
	{
		try {
			$this->me = $this->facebook_connect->api('/me');
		} catch (Exception $e) {
			$this->me = false;
		}
		
		return $this->me;
	}
}