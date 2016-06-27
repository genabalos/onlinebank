<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model('user'); //, '', TRUE);
	}

	function index(){
	   
		$this->load->helper(array('form'));

		$this->load->view('templates/header');
		$this->load->view('login/login_view');
		$this->load->view('templates/footer');
	   
	}
	
	function verifylogin(){
	   //This method will have the credentials validation
	   $this->load->library('form_validation');

	   $this->form_validation->set_rules('account_no', 'Account No.', 'required');
	   $this->form_validation->set_rules('pin', 'Pin', 'required|callback_check_database');

	   if($this->form_validation->run() == FALSE){
		 $this->load->view('templates/header');
		 $this->load->view('login/login_view');
		 $this->load->view('templates/footer');
	   }else{
		 //Go to private area
		 redirect('home', 'refresh');
	   }
	 }

	 function check_database(){
	   //Field validation succeeded.  Validate against database
	    $id = $this->input->post('id');
	    $account_no = $this->input->post('account_no');
	    $pin = $this->input->post('pin');

	   //query the database
	   $result = $this->user->login($account_no, $pin);

	   if($result){
			 $sess_array = array();
			 
			 foreach($result as $row){
			   $sess_array = array(
					'id' => $row->id, 
					'account_no' => $row->account_no,
					'pin' => $row->pin, 
					'first_name' => $row->first_name, 
					'last_name' => $row->last_name, 
					'balance' => $row->balance, 
					);
			   $this->session->set_userdata('logged_in', $sess_array);
			 }
			 return TRUE;
	   }else{
		   
		 $this->form_validation->set_message('check_database', 'Invalid Account No. or PIN');
		 return false;
		 
	   }
	 }
}

?>