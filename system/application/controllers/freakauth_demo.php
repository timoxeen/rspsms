<?php
class Freakauth_demo extends Controller {
	
	function Freakauth_demo ()
	{
		parent::Controller();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  	
		$this->_container = $this->config->item('FAL_template_dir').'template/container';
		/*if(belongsToGroup() || isFbLoggedIn())
	    	{
	    		redirect('sms');
	    	}*/
	}
	
	function index()
	{		
		$data['heading'] = 'SendSMS2India';
		if(belongsToGroup() || isFbLoggedIn())
		{
			$data['sms'] = anchor('sms','SMS',array('data-icon'=>'custom'));
			$data['contacts'] = anchor('contacts','Contacts',array('data-icon'=>'custom'));
			$data['page'] = $this->config->item('FAL_template_dir').'template/main';
	    	$data['header'] = true;
	    	$data['navigation'] = false;
		}
		else 
		{
			$data['page'] = $this->config->item('FAL_template_dir').'template/home';
			$data['header'] = false;
			$data['navigation'] = true;
		}
	    	
        
        
        $this->load->vars($data);

		$this->load->view($this->_container);
		
		//$this->output->enable_profiler(TRUE);
	}
}
?>