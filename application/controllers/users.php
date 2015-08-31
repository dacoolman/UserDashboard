<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller{
public function __construct()
	{parent::__construct();
	$email = $this->session->userdata('email');
	if(empty($email))
		{redirect('/');}
	$this->load->model('UserModel');
	//$this->output->enable_profiler();
	}

	public function editUser($id){

	$user_level = $this->session->userdata('user_level');
	if($user_level == 9)
	{}
	else if($this->session->userdata('id') == $id)
	{}
	else {
		redirect('/dashboard');
		}
	$user = $this->UserModel->select_userid($id);
	$user = array('user' => $user);
	$this->load->view('dashboardpartial');
	$this->load->view('Edituser', $user);
	}

	public function profile($id){
		$user = $this->UserModel->select_userid($id);
		$messages = $this->UserModel->select_messages($id);
		$comments = $this->UserModel->select_comments($id);
		$info = array('user' => $user, 'messages' => $messages, 'comments' => $comments);
		$this->load->view('dashboardpartial');
		$this->load->view('profile', $info);
	}

	public function create_user(){
		$user_level = $this->session->userdata('user_level');
		if($user_level == 9)
		{}
		else {
			redirect('/users/Adduser');
		}
		$post = $this->input->post();
		$result = $this->UserModel->validate_user($post);
		if ($result=='valid')
		{
			$myid = $this->UserModel->create_user($post);
			$url = '/users/profile/'.$myid;
			redirect($url);
		}
		else{
			$result = array('errors', $result);
			$this->session->set_flashdata('errors', $result);
			redirect('/users/Adduser');
		}
	}
	public function Adduser(){
				$user_level = $this->session->userdata('user_level');
		if($user_level == 9)
	{}
		else {
			redirect('/dashboard');}
			$this->load->view('dashboardpartial');
			$this->load->view('Adduser');
		}

	public function update_userinfo(){	
		$post = $this->input->post();
		$myid = $post['id'];
		$url = '/users/profile/'.$myid;
		$returnurl = '/users/editUser/'.$myid;
		$user_level = $this->session->userdata('user_level');
		if($user_level == 9)
		{}
		else {
			redirect($returnurl);
		}
		$result = $this->UserModel->validate_userinfo($post);
		if ($result=='valid')
		{
		$this->UserModel->update_userinfo($post);
		if ($myid == $this->session->userdata('id'))
			{$this->session->set_userdata('user_level', $post['user_level']);}
		redirect($url);
		}
		else{
			$result = array('errors', $result);
			$this->session->set_flashdata('errors', $result);
			redirect($returnurl);
		}
	}

	public function update_passwordinfo(){
		$post = $this->input->post();
		$myid = $post['id'];
		$url = '/users/profile/'.$myid;
		$returnurl = '/users/editUser/'.$myid;
		$user_level = $this->session->userdata('user_level');
		if($user_level == 9)
		{}
		else if ($this->session->userdata('id') == $myid)
		{}
		else {
			redirect($returnurl);}
		$result = $this->UserModel->validate_passwordinfo($post);
		if ($result=='valid')
		{
		$this->UserModel->update_passwordinfo($post);
		redirect($url);
		}
		else{
		$result = array('passworderrors', $result);
		$this->session->set_flashdata('passworderrors', $result);
		redirect($returnurl);
		}
	}

	public function update_description(){
		$post = $this->input->post();
		$myid = $post['id'];
		$url = '/users/profile/'.$myid;
		if ($myid != $this->session->userdata('id'))
			{redirect($url);}
		$this->UserModel->update_description($post);
		redirect($url);
	}

	public function add_message(){
			$post = $this->input->post();
			$user_id = $this->session->userdata('id');
			$post['user_id'] = '';
			$post['user_id'] = $user_id;
			$url = '/users/profile/'.$post['post_id'];
			$this->UserModel->add_message($post);
			redirect($url);
		}

	public function add_comment(){
		$post = $this->input->post();
		$userid = $this->session->userdata('id');
		$post['user_id'] = '';
		$post['user_id'] = $userid;
		$url = '/users/profile/'.$post['post_id'];
		$this->UserModel->add_comment($post);
		redirect($url);

	}
}
?>