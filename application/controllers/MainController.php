<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

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
	}
  	function add_image($folder) 
	{
	    $type = explode('.', $_FILES["image"]["name"]);
	    $type = $type[count($type)-1];
	    $url = $folder.uniqid(rand()).'.'.$type;
	    if(in_array($type, array("jpg","JPEG", "JPG", "jpeg", "png","pdf")))
	        if(is_uploaded_file($_FILES["image"]["tmp_name"]))
	        if(move_uploaded_file($_FILES["image"]["tmp_name"],$url))
		        return $url;
		        return "";
	}
	function uploadimage($folder)
	{
        $files = $_FILES;
        $count = count($_FILES['image']['name']);
        for($i=0; $i<$count; $i++)
        {
            $_FILES['image']['name']= $files['image']['name'][$i];
            $_FILES['image']['type']= $files['image']['type'][$i];
            $_FILES['image']['tmp_name']= $files['image']['tmp_name'][$i];
            $_FILES['image']['error']= $files['image']['error'][$i];
            $_FILES['image']['size']= $files['image']['size'][$i];
            $config['upload_path'] = './'.$folder.'/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
            $config['max_size'] = '99000000';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) 
            {
                $error = array('error' => $this->upload->display_errors());
                $images = array();
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $fileName = $data['upload_data']['file_name'];
                $images[] = $folder.$fileName;
            }
        }
        $fileName = implode(',',$images);
        return $fileName;
    }
	function home()
	{
		$data['title'] = "My Task";
		$data['main_content'] = "Front/home";
		$this->load->view('Front/Common/template',$data);
    }
	function employees()
	{

		$tbl = "employees";

		$where = array('is_deleted' => '0');

		$data['employees'] = $this->Model->getDataByOneCondition($tbl,$where);

		$data['title'] = "My Task";
		$data['main_content'] = "Front/employees";
		$this->load->view('Front/Common/template',$data);
    }
	function manageteam()
	{
		$tbl = "employees";

		$where = array('is_deleted' => '0');

		$data['employees'] = $this->Model->getDataByOneCondition($tbl,$where);

		$data['title'] = "My Task";
		$data['main_content'] = "Front/manageemployees";
		$this->load->view('Front/Common/template',$data);
    }
	function addemployees(){
		$folder = 'upload/employees/';
		$date = date('Y-m-d H:i:s');
		$role_id = $this->input->post('emp_roles');
    	$data = array(
          	'emp_id' => $this->input->post('emp_id'),
          	'emp_name' => $this->input->post('emp_name'),
          	'username' => $this->input->post('username'),
          	'emp_email' => $this->input->post('emp_email'),
          	'emp_phone' => $this->input->post('emp_phone'),
          	'joining_date' => $this->input->post('joining_date'),
          	'emp_password' => md5($this->input->post('password')),
          	'emp_profile' => $this->add_image($folder),
          	'note'	=> $this->input->post('note'),
          	'added_on' => $date
    	);
    	$tbl = 'employees';
    	$result = $this->Model->insert($tbl,$data);
    	if($result){
    		$id = $this->db->insert_id();
    		$data1 = array(
		        'emp_id' => $id,
	          	'project_read' => $this->input->post('project_read'),
	          	'project_create' => $this->input->post('project_create'),
	          	'project_update' => $this->input->post('project_update'),
	          	'project_delete' => $this->input->post('project_delete'),
	          	'tasks_read' => $this->input->post('tasks_read'),
	          	'tasks_create' => $this->input->post('tasks_create'),
	          	'tasks_update' => $this->input->post('tasks_update'),
	          	'tasks_delete' => $this->input->post('tasks_delete'),
	          	'timesheet_read' => $this->input->post('timesheet_read'),
	          	'timesheet_create' => $this->input->post('timesheet_create'),
	          	'timesheet_update' => $this->input->post('timesheet_update'),
	          	'timesheet_delete' => $this->input->post('timesheet_delete'),
          		'added_on' => $date
		    );
		    $tbl1 = 'emp_permission';
		    $result1 = $this->Model->insert($tbl1,$data1);
    		$this->session->set_flashdata('message', array('message' => '<strong>Success !!</strong> Details added successfully. Please try again.','class' => 'alert alert-success alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-success-error admin-check-pro admin-check-pro-clr3'));
    	    redirect('employees');
    	}
    	else{
    		$this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Details was not added successfully. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
    	    redirect('employees');
    	}
	}
	function editemployees(){
		$id = $this->input->post('id');
		$result = $this->Model->getemployeedata($id);
		echo json_encode($result);
	}
	function updateemployees(){
		$folder = 'upload/employees/';
		$id = $this->input->post('employees_id');
		$date = date('Y-m-d H:i:s');
		$image = $_FILES["image"]["name"];
		if($image != "")
		{
    	  	$data = array(
	          	'emp_id' => $this->input->post('emp_id'),
	          	'emp_name' => $this->input->post('emp_name'),
	          	'username' => $this->input->post('username'),
	          	'emp_email' => $this->input->post('emp_email'),
	          	'emp_phone' => $this->input->post('emp_phone'),
	          	'joining_date' => $this->input->post('joining_date'),
	          	'emp_password' => md5($this->input->post('password')),
          		'note'	=> $this->input->post('note'),
	          	'emp_profile' => $this->add_image($folder),
	          	'modified_on' => $date
    	  	);
		}
		else{
		    
    	  	$data = array(
	          	'emp_id' => $this->input->post('emp_id'),
	          	'emp_name' => $this->input->post('emp_name'),
	          	'username' => $this->input->post('username'),
	          	'emp_email' => $this->input->post('emp_email'),
	          	'emp_phone' => $this->input->post('emp_phone'),
	          	'joining_date' => $this->input->post('joining_date'),
	          	'emp_password' => md5($this->input->post('password')),
          		'note'	=> $this->input->post('note'),
	          	'emp_profile' => $this->input->post('eimage'),
	          	'modified_on' => $date
    	  	);
		}
		$tbl = "employees";
		$where = array('id' => $id);
		$result = $this->Model->updateDataByCondition($tbl,$data,$where);
		if($result){
			if($this->input->post('project_read') == 1){
                $project_read = '1' ;
            }
            else{
            	$project_read = '0' ;
            }
			if($this->input->post('project_create') == 1){
                $project_create = '1' ;
            }
            else{
            	$project_create = '0' ;
            }
			if($this->input->post('project_update') == 1){
                $project_update = '1' ;
            }
            else{
            	$project_update = '0' ;
            }
			if($this->input->post('project_delete') == 1){
                $project_delete = '1' ;
            }
            else{
            	$project_delete = '0' ;
            }
			if($this->input->post('tasks_read') == 1){
                $tasks_read = '1' ;
            }
            else{
            	$tasks_read = '0' ;
            }
			if($this->input->post('tasks_create') == 1){
                $tasks_create = '1' ;
            }
            else{
            	$tasks_create = '0' ;
            }
			if($this->input->post('tasks_update') == 1){
                $tasks_update = '1' ;
            }
            else{
            	$tasks_update = '0' ;
            }
			if($this->input->post('tasks_delete') == 1){
                $tasks_delete = '1' ;
            }
            else{
            	$tasks_delete = '0' ;
            }
			if($this->input->post('timesheet_read') == 1){
                $timesheet_read = '1' ;
            }
            else{
            	$timesheet_read = '0' ;
            }
			if($this->input->post('timesheet_create') == 1){
                $timesheet_create = '1' ;
            }
            else{
            	$timesheet_create = '0' ;
            }
			if($this->input->post('timesheet_update') == 1){
                $timesheet_update = '1' ;
            }
            else{
            	$timesheet_update = '0' ;
            }
			if($this->input->post('timesheet_delete') == 1){
                $timesheet_delete = '1' ;
            }
            else{
            	$timesheet_delete = '0' ;
            }
    		$data1 = array(
	          	'project_read' => $project_read,
	          	'project_create' => $project_create,
	          	'project_update' => $project_update,
	          	'project_delete' => $project_delete,
	          	'tasks_read' => $this->input->post('tasks_read'),
	          	'tasks_create' => $this->input->post('tasks_create'),
	          	'tasks_update' => $this->input->post('tasks_update'),
	          	'tasks_delete' => $this->input->post('tasks_delete'),
	          	'timesheet_read' => $this->input->post('timesheet_read'),
	          	'timesheet_create' => $this->input->post('timesheet_create'),
	          	'timesheet_update' => $this->input->post('timesheet_update'),
	          	'timesheet_delete' => $this->input->post('timesheet_delete')
		    );
		    $tbl1 = 'emp_permission';
			$where1 = array('emp_id' => $id);
			$result1 = $this->Model->updateDataByCondition($tbl1,$data1,$where1);
			$this->session->set_flashdata('message', array('message' => '<strong>Success !!</strong> Details updated successfully.','class' => 'alert alert-success alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-success-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('manage-team');
		}
		else{
			$this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Details was not updated successfully. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('manage-team');
		}
	}
    function statusemployees()
    {
    	$id = $this->input->post('employeesid');
        $data = array(
            'status' => $this->input->post('status')
        );
		$where = array('id'=>$id);
		$tbl = 'employees';
		$result = $this->Model->updateDataByCondition($tbl,$data,$where);
		print_r($result);
    }
    function deleteemployees($id)
    {
        $data = array(
            'is_deleted' => '1'
        );
		$where = array('id'=>$id);
		$tbl = 'employees';
		$result = $this->Model->updateDataByCondition($tbl,$data,$where);
        if($result){
			$this->session->set_flashdata('message', array('message' => '<strong>Success !!</strong> Details deleted successfully.','class' => 'alert alert-success alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-success-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('employees');
		}
		else{
			$this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Details was not deleted successfully. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('manage-team');
		}
	}
	function employee_profile($id)
	{
        $tbl = "employees";
        $tbl2 = "project_assigned";

        $where = array('id' => $id);
        $where1 = array('emp_id' => $id);

        $data['employeedetail'] = $this->Model->getDataByOneCondition($tbl,$where);
        $data['project_assigned'] = $this->Model->getemployeeproject($id);

        $data['title'] = "My Task";
        $data['main_content'] = "Front/employee_profile";
        $this->load->view('Front/Common/template',$data);
    }



	function projects()
	{
		$tbl = "projects";
		$tbl1 = "employees";
		$tbl2 = "project_assigned";

		$where = array('is_deleted' => '0');
		$where1 = array('status' => '1');

		$data['projects'] = $this->Model->getDataByOneCondition($tbl,$where);
		$data['employees'] = $this->Model->getDataByTwoCondition($tbl1,$where,$where1);
		$data['projects_assigned'] = $this->Model->getData($tbl2);

		$data['title'] = "My Task";
		$data['main_content'] = "Front/projects";
		$this->load->view('Front/Common/template',$data);
    }
	function addprojects(){
		$date = date('Y-m-d H:i:s');
    	$project_assigned_person = $this->input->post('project_assigned_person');
    	$members = count($project_assigned_person);
    	$data = array(
          	'project_name' => $this->input->post('project_name'),
          	'project_category' => $this->input->post('project_category'),
          	'project_start_date' => $this->input->post('project_start_date'),
          	'project_end_date' => $this->input->post('project_end_date'),
          	'description' => $this->input->post('description'),
          	'project_framework' => $this->input->post('project_framework'),
          	'project_dashboard' => $this->input->post('project_dashboard'),
          	'members' => $members,
          	'added_on' => $date
    	);
    	$tbl = 'projects';
    	$result = $this->Model->insert($tbl,$data);
    	if($result){
    		$id = $this->db->insert_id();
    		for($i=0;$i<$members;$i++){
    			$data1  = array('project_id' => $id, 'emp_id' => $project_assigned_person[$i],'added_on' => $date);
		    	$tbl1 = 'project_assigned';
		    	$result1 = $this->Model->insert($tbl1,$data1);
    		}

    		$this->session->set_flashdata('message', array('message' => '<strong>Success !!</strong> Details added successfully. Please try again.','class' => 'alert alert-success alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-success-error admin-check-pro admin-check-pro-clr3'));
    	    redirect('projects');
    	}
    	else{
    		$this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Details was not added successfully. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
    	    redirect('projects');
    	}
	}
	function editprojects(){
		$id = $this->input->post('id');
		$result = $this->Model->getprojectdata($id);
		echo json_encode($result);
	}
	function updateprojects(){
		$id = $this->input->post('projects_id');
		$date = date('Y-m-d H:i:s');
    	$data = array(
          	'project_name' => $this->input->post('project_name'),
          	'project_category' => $this->input->post('project_category'),
          	'project_start_date' => $this->input->post('project_start_date'),
          	'project_end_date' => $this->input->post('project_end_date'),
          	'description' => $this->input->post('description'),
          	'project_framework' => $this->input->post('project_framework'),
          	'project_dashboard' => $this->input->post('project_dashboard'),
          	'status' => $this->input->post('project_status'),
          	'added_on' => $date
    	);
		$tbl = "projects";
		$where = array('id' => $id);
		$result = $this->Model->updateDataByCondition($tbl,$data,$where);
		if($result){
    		$id = $this->db->insert_id();
			$this->session->set_flashdata('message', array('message' => '<strong>Success !!</strong> Details updated successfully.','class' => 'alert alert-success alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-success-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('projects');
		}
		else{
			$this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Details was not updated successfully. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('projects');
		}
	}
    function statusprojects()
    {
    	$id = $this->input->post('projectsid');
        $data = array(
            'status' => $this->input->post('status')
        );
		$where = array('id'=>$id);
		$tbl = 'projects';
		$result = $this->Model->updateDataByCondition($tbl,$data,$where);
		print_r($result);
    }
    function deleteprojects($id)
    {
        $data = array(
            'is_deleted' => '1'
        );
		$where = array('id'=>$id);
		$tbl = 'projects';
		$result = $this->Model->updateDataByCondition($tbl,$data,$where);
        if($result){
			$this->session->set_flashdata('message', array('message' => '<strong>Success !!</strong> Details deleted successfully.','class' => 'alert alert-success alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-success-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('projects');
		}
		else{
			$this->session->set_flashdata('message', array('message' => '<strong>Oops!!</strong> Details was not deleted successfully. Please try again.','class' => 'alert alert-danger alert-mg-b alert-success-style4','fa_class' => 'fa fa-times adminpro-danger-error admin-check-pro admin-check-pro-clr3'));
	      	redirect('projects');
		}
	}
}