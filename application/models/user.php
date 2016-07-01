<?php
class User extends CI_Model{
	
	function login($account_no, $pin){
		$this -> db -> select('id, account_no, pin, first_name, last_name, balance');
		$this -> db -> from('accounts');
		$this -> db -> where('account_no', $account_no);
		$this -> db -> where('pin = ' . "'" . MD5($pin) . "'");
		$this -> db -> limit(1);
	 
		$query = $this -> db -> get();
	 
		if($query -> num_rows() == 1){
			return $query->result();
		}
		else{
			return false;
		}
	}
	
	 
	function get_accounts($account_no){
		$this->db->select('id, account_no, pin, first_name, last_name, balance');
		$this->db->from('accounts');
		$this->db->where('account_no', $account_no);
		$query = $this->db->get();
		
		if($query -> num_rows() == 1){
			return $query->result(); 
		}
		else{
			return false;
		}
	}
	
	function get_transaction($account_no){
		
		$this->db->select('id, account_no, history');
		$this->db->from('transactions');
		$this->db->where('account_no', $account_no);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
		
	}
	 
	function deposit($data, $transaction_history){
		
		$daccount['id'] = $data['id'];
		$daccount['account_no'] = $data['account_no'];
		$daccount['first_name'] = $data['first_name'];
		$daccount['last_name'] = $data['last_name'];
		$daccount['balance'] = $data['balance'];
		 
		$this->db->where('id', $data['id']);
		$this->db->update('accounts', $daccount);
	
		$this->db->from('transactions');
		$this->db->insert('transactions', $transaction_history);
		
		redirect('home', 'refresh');
		
	}
	 
	function withdraw($data, $transaction_history){
		
		$waccount['id'] = $data['id'];
		$waccount['account_no'] = $data['account_no'];
		$waccount['first_name'] = $data['first_name'];
		$waccount['last_name'] = $data['last_name'];
		$waccount['balance'] = $data['balance'];
		
		$this->db->where('id', $data['id']);
		$this->db->update('accounts', $waccount);	

		$this->db->from('transactions');
		$this->db->insert('transactions', $transaction_history);
		
		redirect('home', 'refresh');
		
	}
	 
	function transfer($data, $data2, $transaction_history){
		
		$taccount['id'] = $data['id'];
		$taccount['account_no'] = $data['account_no'];
		$taccount['first_name'] = $data['first_name'];
		$taccount['last_name'] = $data['last_name'];
		$taccount['balance'] = $data['balance'];
		
		$this->db->where('account_no', $data['account_no']);
		$this->db->update('accounts', $taccount);	
		
		$toaccount['account_no'] = $data2['to_account_no'];
		$toaccount['balance'] = $data2['balance'];
		
		$this->db->where('account_no', $data2['to_account_no']);
		$this->db->update('accounts', $toaccount);	
		
		$this->db->from('transactions');
		$this->db->insert('transactions', $transaction_history);
		
		
		redirect('home', 'refresh');
	}
	 

}
?>