<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	# constructor
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
      	$this->load->helper('string');
      	$this->load->model('Model'); // calling helper class
      	$this->load->library('form_validation');
      	$this->load->library('session'); // loading session library
      	date_default_timezone_set("Asia/Kolkata");
      	//$this->load->database();
	}
	public function index()
	{
		$data['title'] = "My Task";
		$this->load->view('login',$data);
    }
	function login(){
		$date = date("Y-m-d H:i:s");
		$tbl = 'admin';
		$where = array('email' => $this->input->post('email'));
		$where1 = array('password' => md5($this->input->post('password')));
		$result = $this->Model->getDataByTwoCondition($tbl,$where, $where1);
		if($result){
			$storedata = [
				'id'  		=>  $result[0]->id,
				'name'      =>  $result[0]->name,
				'email'     =>  $result[0]->email,
				'profile_pic'     =>  $result[0]->profile_pic,
			  ];
		  	$this->session->set_userdata($storedata);
		  	$data = array(
				'is_online' => '1',
          		'last_login_on' => $date
    	  	);
			$where2 = array('id' => $result[0]->id);
			$result2 = $this->Model->updateDataByCondition($tbl,$data,$where);
	      	redirect('home');
		}
		else{
		    $this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Wrong Username or Password. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('/');
		}
	}
  	function logout()
  	{
		$date = date("Y-m-d H:i:s");
		$tbl = 'admin';
		$data = array(
			'is_online' => '0',
          	'last_logout_on' => $date
    	);
		$where = array('id' => $this->session->userdata('id'));
		$result2 = $this->Model->updateDataByCondition($tbl,$data,$where);
    	$this->session->sess_destroy();
        redirect('/');
  	}
}