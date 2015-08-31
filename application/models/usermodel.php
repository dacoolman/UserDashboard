<?php
class UserModel extends CI_MODEL{
	
	function select_users(){
		return $this->db->query("select * from users;")->result_array();
	}

	function select_userid($id){
		$query = "select * from users where id = ?;";
		$values = array($id);
		return $this->db->query($query, $values)->row_array();
	}

	function validate_user($post){
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

	function create_user($post){
		$query = "INSERT INTO `mydashboard`.`users` (`email`, `password`, `first_name`, `last_name`, `user_level`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, Now(), Now());";
		$level_of_user = 1;
		$values = array($post['email'],
			md5($post['password']),
			$post['first_name'],
			$post['last_name'],
			$level_of_user);
			return $this->db->insert_id($this->db->query($query, $values));
		}

		function update_userinfo($post){
			$query = "update users set email = ?, first_name= ?, last_name = ?, user_level = ?, updated_at = Now() where id = ?;";
			$values = array($post['email'],
			$post['first_name'],
			$post['last_name'],
			$post['user_level'],
			$post['id']);
			$this->db->query($query, $values);
			if ($this->session->userdata('id') == $post['id'] )
			{
				$this->session->set_userdata('email', $post['email']);
				$this->session->set_userdata('first_name', $post['first_name']);
				$this->session->set_userdata('last_name', $post['last_name']);
				$this->session->set_userdata('user_level', $post['user_level']);
			}
		}

		function update_passwordinfo($post){
			$query = "update users set password = ?, updated_at = Now() where id = ?;";
			$values = array(md5($post['password']),
			$post['id']);
			$this->db->query($query, $values);
		}

		function update_description($post){
			$query = "update users set description = ?, updated_at = Now() where id = ?;";
			$values = array($post['description'],
			$post['id']);
			$this->db->query($query, $values);
		}

		function validate_passwordinfo($post){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|matches[confirm_password]');
			if($this->form_validation->run()) {
	      	return "valid";
	   		}
	   		else {
	      	return array(validation_errors());
	    	}
		}
		function validate_userinfo($post){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		    if($this->form_validation->run()) {
		      return "valid";
		    } 
		    else {
		      return array(validation_errors());
		    }
		}

		function add_message($post){
			$query = "INSERT INTO `mydashboard`.`messages` (`content`, `user_id`, `post_id`, `created_at`, `updated_at` ) VALUES (?, ?, ?, Now(), Now());";
			$values = array($post['content'],
			$post['user_id'],
			$post['post_id']);
			return $this->db->insert_id($this->db->query($query, $values));
		}

		function add_comment($post){
			$query = "INSERT INTO `mydashboard`.`comments` (`contents`, `message_id`, `user_id`, `updated_at`, `created_at`) VALUES (?, ?, ?, Now(), Now());";
			$values = array($post['content'],
			$post['message_id'],
			$post['user_id']);
			return $this->db->insert_id($this->db->query($query, $values));
		}

		function select_messages($id){
			$query = "select messages.id, messages.content, messages.created_at, users.first_name, users.last_name, users.id as user_id from messages
			inner join users on users.id = messages.user_id
			where post_id = ? order by created_at desc;";
			$values = array($id);
			return $this->db->query($query, $values)->result_array();
		}

		function select_comments($id){
			$query = "select comments.contents, comments.message_id, comments.user_id, users.first_name, users.last_name, comments.created_at from comments
			inner join messages
			on comments.message_id = messages.id
			inner join users
			on users.id = comments.user_id
			where messages.post_id = ?
			order by created_at asc;";
			$values = array($id);
			return $this->db->query($query, $values)->result_array();
		}
}
?>