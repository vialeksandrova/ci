<?php

/**
* SENDS EMAIL WITH GMAIL
*/
class Email extends CI_Controller
{
	function _construct()
	{
		parent::Controller();
	}
	
	function index() 
	{
		$this->load->view('news');
	}
	
	function send() 
	{	
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		
		if($this->form_validation->run()== FALSE)
		{
			$this->load->view('news');
		}
		else
		{
			// validation has passed. Now send the email
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			
			$this->load->library('email');
			$this->email->set_newline("\r\n");

			$this->email->from('vii.aleksandrova@gmail.com', 'Vi Aleksandrova');
			$this->email->to($email);		
			$this->email->subject('Test');		
			$this->email->message('Hello!');


			if($this->email->send())
			{
				//echo 'Your email was sent.';
				$this->load->view('sentform_view');
			}

			else
			{
				show_error($this->email->print_debugger());
			}			
		}
	}
}


      ?>
