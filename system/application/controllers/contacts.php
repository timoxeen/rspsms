<?php
class Contacts extends Controller{
	
	function Contacts()
	{
		parent::Controller();
		
		$this->_container = $this->config->item('FAL_template_dir').'template/container';
		$this->load->library('Contacts_lib', 'contacts_lib');
		
		$this->freakauth_light->check('user'); 
	}
	
	function index()
	{
		redirect('contacts/show');
		$data['heading'] = 'Contacts';
        $data['fal'] = '';
        $data['navigation'] = false;
        $data['header'] = true;
        $data['menu_sms'] = false;
        $data['menu_contact'] = true;
        $data['menu_feedback'] = false;
        $this->load->vars($data);

		$this->load->view($this->_container);
	}
	
	function show()
	{
		$data['heading'] = 'Contacts';
        $data['fal'] =  $this->contacts_lib->listContacts();
        $data['header'] = true;
        $this->load->vars($data);
		$this->load->view($this->_container);
	}
	
	function add()
	{
		$data['heading'] = 'Contacts';
        $data['fal'] =  $this->contacts_lib->addContact();
        $data['header'] = true;
        $this->load->vars($data);
		$this->load->view($this->_container);
	}
}