<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
	}

	public function index()
	{$this->load->view('loginpartial');
	$this->load->view('home');
	}

	public function signin(){
		$this->load->view('loginpartial');
		$this->load->view('signin');

	}
	public function register(){
		$this->load->view('loginpartial');
		$this->load->view('register');
	}

	public function user_login(){
		$post = $this->input->post();
		$this->load->model('LoginModel');
		$result = $this->LoginModel->login($post);
		if ($result == 'valid')
		{$user = $this->LoginModel->select_user($post['email']);
			if (empty($user))
			{
				$result = array('loginerrors', array('Email not found'));
				$this->session->set_flashdata('loginerrors', $result);
				redirect('/signin');
			}
			else{
				if (md5($post['password']) != $user['password'])
				{
					$result = array('loginerrors', array('Invalid password'));
					$this->session->set_flashdata('loginerrors', $result);
					redirect('/signin');
				}
				$this->session->set_userdata('id', $user['id']);
				$this->session->set_userdata('email', $user['email']);
				$this->session->set_userdata('first_name', $user['first_name']);
				$this->session->set_userdata('last_name', $user['last_name']);
				$this->session->set_userdata('user_level', $user['user_level']);
				$this->session->set_userdata('description', $user['description']);
				redirect('/dashboard');
			}
		}
		else{
			$result = array('loginerrors', $result);
			$this->session->set_flashdata('loginerrors', $result);
			redirect('/signin');
		}
	}

	public function user_register(){
		$post = $this->input->post();
		$this->load->model('LoginModel');
		$result = $this->LoginModel->register($post);
		if ($result=='valid')
		{
		$first = $this->LoginModel->select_first();
		$myid = $this->LoginModel->create_user($post, $first);
		$user = $this->LoginModel->select_userid($myid);
		$this->session->set_userdata('id', $user['id']);
		$this->session->set_userdata('email', $user['email']);
		$this->session->set_userdata('first_name', $user['first_name']);
		$this->session->set_userdata('last_name', $user['last_name']);
		$this->session->set_userdata('user_level', $user['user_level']);
		$this->session->set_userdata('description', $user['description']);
		redirect('/dashboard');
		}
		else{
			$result = array('errors', $result);
			$this->session->set_flashdata('errors', $result);
			redirect('/register');
		}
	}
}

//end of main controller