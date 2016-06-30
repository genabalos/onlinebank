<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	function __construct(){
		 
		parent::__construct();
	    $this->load->model('user', '', TRUE);
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
			
			$result_history = $this->user->get_transaction($data['account_no']); 
			
			if($result_history){
				foreach($result_history as $row){
					
					$hist['history'] = $row->history;
					$this->load->view('login/transaction_view', $hist);
				}
			}else{
				$hist['history'] = "You have no records to display yet.";
				$this->load->view('login/transaction_view', $hist);
			}
			
		}else{
			redirect('login', 'refresh');	//If no session, redirect to login page
		}
		
		$this->load->view('templates/footer');	 
	}
	
	 
	function deposit(){
		 if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
	
			$this->form_validation->set_rules('deposit_amount', 'Deposit Amount', 'required|integer|greater_than[0]');
			 
			$data['deposit_amount'] = $this->input->post('deposit_amount');
			$data['id'] = $session_data['id'];
			$data['account_no'] = $session_data['account_no'];
			$data['first_name'] = $session_data['first_name'];
			$data['last_name'] = $session_data['last_name'];
			$data['balance'] = $session_data['balance'];
			
		
			if($this->form_validation->run() == FALSE){
				$this->load->view('templates/header');
				$this->load->view('login/deposit_view', $data);  //Field validation failed.  User redirected to login page
				$this->load->view('templates/footer');
			}else{
					
				$result = $this->user->get_accounts($data['account_no']); 
				
				if($result){
					foreach($result as $row){
					   $temporary = array(
						 'account_no' => $row->account_no,
						 'first_name' =>  $row->first_name,
						 'last_name' => $row->last_name,
						 'balance' => $row->balance
					   );
					}
					
				}
				

				$data['balance'] = $row->balance + $data['deposit_amount'];
				
				$data['date'] = date('Y-m-d H:i:s',strtotime('+15 hour'));
	
				$result_history = $this->user->get_transaction($data['account_no']); 
			
				$transaction_history = array(
					'account_no' => $data['account_no'],
					'history' => "You deposited ₱".$data['deposit_amount']." (".$data['date'].")"
				);
				
				$this->user->deposit($data, $transaction_history);
				
				
		   }
		}else{ 
			redirect('login', 'refresh');	//If no session, redirect to login page
		}
	 }
	 
	 
	function withdraw(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');
			
			$this->form_validation->set_rules('withdraw_amount', 'Withdraw Amount', 'required|integer|greater_than[0]');
			
			$data['withdraw_amount'] = $this->input->post('withdraw_amount');
			$data['id'] = $session_data['id'];
			$data['account_no'] = $session_data['account_no'];
			$data['first_name'] = $session_data['first_name'];
			$data['last_name'] = $session_data['last_name'];
			$data['balance'] = $session_data['balance'];
			
			if($this->form_validation->run() == FALSE){
				$this->load->view('templates/header');
				$this->load->view('login/withdraw_view', $data);
				$this->load->view('templates/footer');
			}else{
				
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
				
					$data['balance'] = $row->balance;
					
					$data['date'] = date('Y-m-d H:i:s',strtotime('+15 hour'));
					
					
					$result_history = $this->user->get_transaction($data['account_no']);
				
				if ($data['balance']-$data['withdraw_amount'] < 0){
					$this->load->view('templates/header');
					$this->load->view('login/withdraw_view', $data);
					$this->load->view('templates/footer');
				}else{
					
					$transaction_history = array(
						'account_no' => $data['account_no'],
						'history' => "You withdrew ₱".$data['withdraw_amount']." (".$data['date'].")"
					);
					
					$data['balance'] = $row->balance - $data['withdraw_amount'];
				
					
					$this->user->withdraw($data, $transaction_history);
				}
				
			}
					
		}else{ 
			redirect('login', 'refresh');	//If no session, redirect to login page
		}
	 
	}

	 function check_account(){
	    $account_no = $this->input->post('account_no');
	    $transfer_amount = $this->input->post('transfer_amount');

	   $result = $this->user->get_accounts($account_no);

	   if($result){
			 $sess_array = array();
			 foreach($result as $row){
			   $sess_array = array(
					'account_no' => $row->account_no,
					'first_name' => $row->first_name,
					'last_name' => $row->last_name,
					'balance' => $row->balance
				);
				
			 }
			 return TRUE;
	   }else{
		   
		 $this->form_validation->set_message('check_account', 'Account No. does not exist!');
		 return false;
		 
	   }
	 }
	
	 
	function transfer(){
		if($this->session->userdata('logged_in')){
			$session_data = $this->session->userdata('logged_in');		  
					 
			$this->form_validation->set_rules('account_no', 'Account No.:', 'required|callback_check_account');
			$this->form_validation->set_rules('transfer_amount', 'Transfer Amount', 'required|integer|greater_than[0]');
			
			$data['transfer_amount'] = $this->input->post('transfer_amount');
			$data['id'] = $session_data['id'];
			$data['account_no'] = $session_data['account_no'];
			
			$data['first_name'] = $session_data['first_name'];
			$data['last_name'] = $session_data['last_name'];
			$data['balance'] = $session_data['balance'];
			
			$data2['to_account_no'] = $this->input->post('account_no');
		
			if($this->form_validation->run() == FALSE){
				$this->load->view('templates/header');
				$this->load->view('login/transfer_view', $data);
				$this->load->view('templates/footer');
			}else{
				
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
				
				$result2 = $this->user->get_accounts($data2['to_account_no']); 
				
				if($result2){
					foreach($result2 as $row){
					   $temporary2 = array(
						 'account_no' => $row->account_no,
						 'first_name' => $row->first_name,
						 'last_name' => $row->last_name,
						 'balance' => $row->balance
					   );
					}
				}
				
				$data['balance'] = $temporary['balance'];
				$data2['balance'] = $temporary2['balance'];

				$data['date'] = date('Y-m-d H:i:s',strtotime('+15 hour'));
				
				$result_history = $this->user->get_transaction($data['account_no']); 
				
				if ($data['balance']-$data['transfer_amount'] < 0){
					$this->load->view('templates/header');
					$this->load->view('login/transfer_view', $data);
					$this->load->view('templates/footer');
				}else{
					
					$transaction_history = array(
						'account_no' => $data['account_no'],
						'history' => "You transferred ₱".$data['transfer_amount']." to account no. ".$data2['to_account_no']." (".$data['date'].")"
					);
					
					$data['balance'] = $temporary['balance'] - $data['transfer_amount'];
					$data2['balance'] = $temporary2['balance'] + $data['transfer_amount'];
					
					$this->user->transfer($data, $data2, $transaction_history);
				}
				
				
			}
		}else{ 
			redirect('login', 'refresh');	//If no session, redirect to login page
		}
		 
	}
	 

	function logout(){
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh'); 
	}

}

?>