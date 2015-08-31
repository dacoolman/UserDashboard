<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$email = $this->session->userdata('email');
		if(empty($email))
			{redirect('/');}
		$this->load->model('DashboardModel');
		//$this->output->enable_profiler();
	}

	public function index()
	{$users = $this->DashboardModel->select_users();
	$users = array('users' => $users);
	$this->load->view('dashboardpartial');
	$this->load->view('dashboard', $users);
	}

	public function profile($id){

		$user = $this->DashboardModel->select_userid();
		$user = array('user' => $user);
		$this->load->view('dashboardpartial');
		$this->load->view('profile', $user);
	}

	public function delete($id){
		$user_level = $this->session->userdata('user_level');
		if($user_level != 9)
			{redirect('/dashboard');}
		$this->DashboardModel->delete_userid($id);
		if ($this->session->userdata('id') == $id)
		{
			redirect('/dashboard/logoff');
		}
		else{
			redirect('/dashboard');
		}
	}

	public function logoff(){

		$this->session->sess_destroy();
		redirect('/');
	}
}
?>