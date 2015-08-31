<?php
class LoginModel extends CI_MODEL{

	function register($post){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]');
	    if($this->form_validation->run()) {
	      return "valid";
	    }
	    else {
	      return array(validation_errors());
	    }
	}

	function login($post){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if($this->form_validation->run()) {
	      return "valid";
	    }
	    else {
	      return array(validation_errors());
	    }
	}

	function create_user($post, $first){
		$query = "INSERT INTO `mydashboard`.`users` (`email`, `password`, `first_name`, `last_name`, `user_level`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, Now(), Now());";
		$level_of_user = 1;
		//I have every user created as an admin for testing purposes
		//next line should be the following to only have the 
		//first user be an admin: 	if (empty($first))
		if (1==1)
		{$level_of_user = 9;}
		$values = array($post['email'],
		md5($post['password']),
		$post['first_name'],
		$post['last_name'],
		$level_of_user);
		return $this->db->insert_id($this->db->query($query, $values));
	}

	function select_first(){
		$query = "select id from users limit 1;";
		return $this->db->query($query)->row_array();
	}

	function select_user($email){
		$query = "select * from users where email = ?;";
		$values = array($email);
		return $this->db->query($query, $values)->row_array();
	}

	function select_userid($id){
		$query = "select * from users where id = ?;";
		$values = array($id);
		return $this->db->query($query, $values)->row_array();
	}
}
?>