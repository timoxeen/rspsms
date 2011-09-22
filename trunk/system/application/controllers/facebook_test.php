<?php
	class Facebook_test extends Controller {
		
		function Facebook_test()
		{
			parent::__construct();
//			session_start();
			// $this->load->add_package_path('/Users/elliot/github/codeigniter-facebook/application/');
			$this->load->library('facebook_connect');
			$this->load->helper('facebook');
			//$this->facebook->enable_debug(TRUE);
			 $this->_container = $this->config->item('FAL_template_dir').'template/container';
		}
		
		
		function index()
		{
			// We can use the open graph place meta data in the head.
			// This meta data will be used to create a facebook page automatically
			// when we 'like' the page.
			// 
			// For more details see: http://developers.facebook.com/docs/opengraph
			/*if ( !$this->facebook->logged_in() )
			{
				echo "das";
			}
			else 
			{
				echo "logged";
			}
			echo facebook_picture('me');
			$opengraph = 	array(
								'type'				=> 'website',
								'title'				=> 'My Awesome Site',
								'url'				=> site_url(),
								'image'				=> '',
								'description'		=> 'The best site in the whole world'
							);

			$this->load->vars('opengraph', $opengraph);*/
			$this->load->view('facebook_view');
		}
	function connect()
		{
			
			$this->facebook_connect->getLoginAnchor();
			$link = $this->facebook_connect->getLoginAnchor();
			$me = $this->facebook_connect->getUserDetails();
//			print_r($me);
			$this->load->vars('me', $me);
			$this->load->vars('link', $link);
			$this->load->view('facebook');
			
		}
		function login()
		{
			// This is the easiest way to keep your code up-to-date. Use git to checkout the 
			// codeigniter-facebook repo to a location outside of your site directory.
			// 
			// Add the 'application' directory from the repo as a package path:
			// $this->load->add_package_path('/var/www/haughin.com/codeigniter-facebook/application/');
			// 
			// Then when you want to grab a fresh copy of the code, you can just run a git pull 
			// on your codeigniter-facebook directory.

			if ( !$this->facebook->logged_in() )
			{
				// From now on, when we call login() or login_url(), the auth
				// will redirect back to this url.

				$this->facebook->set_callback(site_url('facebook_test'));

				// Header redirection to auth.

				$this->facebook->login();

				// You can alternatively create links in your HTML using
				// $this->facebook->login_url(); as the href parameter.
			}
			else
			{
				redirect('facebook_test');
			}
		}
		
		function logout()
		{
			$this->facebook->logout();
			redirect('facebook_test');
		}
	}