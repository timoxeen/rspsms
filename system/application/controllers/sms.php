<?php
class Sms extends Controller {
	
	function Sms ()
	{
		parent::Controller();
		
		$this->_container = $this->config->item('FAL_template_dir').'template/container';
		$this->load->library('Sms_lib', 'sms_lib');
		
		$this->freakauth_light->check('user'); 
	}
	
	function index()
	{		
		$this->db_session->userdata('id');
		$data['heading'] = 'SendSMS2India';
        $data['fal'] = $this->sms_lib->send();
       // $data['page'] = $this->config->item('FAL_template_dir').'template/sms/send';
        $data['navigation'] = true;
        $data['header'] = true;
        $data['menu_sms'] = true;
        $data['menu_contact'] = false;
        $data['menu_feedback'] = false;
        $this->load->vars($data);

		$this->load->view($this->_container);
		
		//$this->output->enable_profiler(TRUE);
	}
	function sent()
	{
		$data['heading'] = 'Sent Sms List';
        $data['fal'] = $this->sms_lib->sentlist();
       // $data['page'] = $this->config->item('FAL_template_dir').'template/sms/send';
        $data['navigation'] = true;
        $data['header'] = true;
        $data['menu_sms'] = false;
        $data['menu_contact'] = true;
        $data['menu_feedback'] = false;
        $this->load->vars($data);

		$this->load->view($this->_container);
	}
	function contacts()
	{
		$data['heading'] = 'SendSMS2India';
        
        $data['page'] = $this->config->item('FAL_template_dir').'template/sms/contacts';
        $data['navigation'] = true;
        $data['header'] = true;
        $data['menu_sms'] = false;
        $data['menu_contact'] = true;
        $data['menu_feedback'] = false;
        $this->load->vars($data);

		$this->load->view($this->_container);
	}
}
?>