<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('encryption');
		$this->load->model('user'); //, '', TRUE);
	}

	function index(){

		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
	
			$data['account_no'] = $session_data['account_no'];
			$data['first_name'] = $session_data['first_name'];
			$data['last_name'] = $session_data['last_name'];
			$data['balance'] = $session_data['balance'];
		 
			$result = $this->user->get_accounts($data['account_no']); 
		
			if($result){
				foreach($result as $row){
					$temporary = array(
						'account_no' => $row->account_no,
						'first_name' => $row->first_name,
						'last_name' => $row->last_name,
						'balance' => $row->balance
					);
				}
			
			}
			$this->load->view('templates/header');
			
			$this->load->view('login/home_view', $temporary);
			
			$config = array();
			$config['base_url'] = base_url() . '/index.php/home/index';
			$config['per_page'] = 10;
			$config['num_links'] = 3;
			//$this->db->select('id, account_no, history');
			//$this->db->where('account_no', $data['account_no']);
			$config['total_rows'] = $this->user->record_count();
			$config['use_page_numbers']  = TRUE;
			
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="next page">';
			$config['next_tag_close'] = '</li>';

			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="prev page">';
			$config['prev_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a href="">';
			$config['cur_tag_close'] = '</a></li>';

			$config['num_tag_open'] = '<li class="page">';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);
			$page = $this->uri->segment(3);
			
			//$this->db->limit($config['per_page'], $this->uri->segment(3));
			$this->db->select('id, account_no, history');
			$this->db->where('account_no', $data['account_no']);
			$this->db->order_by('id','desc');
			$hist['query'] = $this->db->get('transactions', $config['per_page'], $this->uri->segment(3));
			$hist['pagination'] = $this->pagination->create_links();
			$hist['history'] = "You have no records to display yet.";
	
			if($hist['query']){
				$this->load->view('login/transaction_view', $hist);
			}else{
				$hist['history'] = "You have no records to display yet.";
				$this->load->view('login/transaction_view', $hist);
			}
			$this->load->view('templates/footer');
			
		}else{
			$this->load->view('templates/header');
			$this->load->view('login/login_view');
			$this->load->view('templates/footer');
		}
	   
	}
	
	function verifylogin(){

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