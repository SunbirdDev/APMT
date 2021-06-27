<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
class Model extends CI_Model {

    # constructor class
    function __construct() 
    {
        parent::__construct();
        $this->load->database(); // load database 
    }

    /****************** Getting data condition on various factors *****************/

    /****** 1. all data to be fetched from a table **************/
    function getData($tbl){
    	$query = $this->db->get($tbl);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    /******** 2. getting data by one condition ***********/
    function getDataByOneCondition($tbl,$where){
    	$this->db->where($where);
    	$query = $this->db->get($tbl);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    /******** 3. getting data by two condition ***********/
    function getDataByTwoCondition($tbl,$where, $where1){
    	$this->db->where($where);
    	$this->db->where($where1);
    	$query = $this->db->get($tbl);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    /******** 4. getting data by Three condition ***********/
    function getDataByThreeCondition($tbl,$where, $where1,$where2){
    	$this->db->where($where);
    	$this->db->where($where1);
    	$this->db->where($where2);
    	$query = $this->db->get($tbl);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
    function getDataByFourCondition($tbl,$where, $where1,$where2,$where3){
    	$this->db->where($where);
    	$this->db->where($where1);
    	$this->db->where($where2);
    	$this->db->where($where3);
    	$query = $this->db->get($tbl);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }

    /******** 4. getting data by Descending condition ***********/
    function getDataByDescCondition($tbl){
        $this->db->order_by('created_at','DESC');
        $query = $this->db->get($tbl);
        if ($query){
            return $query->result();
        }
        return NULL;
    }
    function getDataByDescCondition1($tbl,$where){
        $this->db->order_by('created_at','DESC');
    	$this->db->where($where);
        $query = $this->db->get($tbl);
        if ($query){
            return $query->result();
        }
        return NULL;
    }
    /******** 4. getting data by Ascending condition ***********/
    function getDataByAscCondition($tbl){
        $this->db->order_by('created_at','ASC');
        $query = $this->db->get($tbl);
        if ($query){
            return $query->result();
        }
        return NULL;
    }


    /**************** update data condition by various factors *********/

    /******** 1. update data by one condition ************/
    function updateDataByCondition($tbl,$data,$where)
    {
        $this->db->where($where);
        return $this->db->update($tbl, $data);
    }
    /******** 2. update data by two condition ************/
    function updateDataByTwoCondition($tbl,$data,$where,$where1)
    {
        $this->db->where($where);
        $this->db->where($where1);
        return $this->db->update($tbl, $data);
    }
    /******** 3. update data by three condition ********/
    function updateDataByThreeCondition($tbl,$data,$where,$where1,$where2)
    {
        $this->db->where($where);
        $this->db->where($where1);
        $this->db->where($where2);
        return $this->db->update($tbl, $data);
    }
    /******** 4. update data by four condition *********/
    function updateDataByFourCondition($tbl,$data,$where,$where1,$where2,$where3)
    {
        $this->db->where($where);
        $this->db->where($where1);
        $this->db->where($where2);
        $this->db->where($where3);
        return $this->db->update($tbl, $data);
    }

    /**************** insert data  *********/
    public function insert($tbl,$data)
    {
        return $this->db->insert($tbl,$data);
    }
    function delete($tbl,$where)
    {
        $this->db->where($where);
        return $this->db->delete($tbl);
    }
    function deleteByTwoCondition($tbl,$where,$where1)
    {
        $this->db->where($where);
        $this->db->where($where1);
        return $this->db->delete($tbl);
    }
    function deleteByThreeCondition($tbl,$where,$where1,$where2)
    {
        $this->db->where($where);
        $this->db->where($where1);
        $this->db->where($where2);
        return $this->db->delete($tbl);
    }
        

        public function getDataByLimit($tbl,$limit,$where)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->order_by("created_at", "desc");
            $this->db->where($where);
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        }
        
        
        

        public function getDataLimit($tbl,$limit)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function getDataLimitByCondition($tbl,$limit,$where)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->where($where);
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        }

        public function getDatabyBetween($tbl,$first,$second){
            $query = "SELECT * FROM $tbl WHERE price between $first AND $second";
            $sql = $this->db->query($query);

            if ($sql->num_rows() > 0) {
                foreach ($sql->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;

        }



    function countdata($tbl){
        $this->db->select('count(*) as cnt');
		$query = $this->db->get($tbl);
		$numRow = $query->num_rows();
		if($numRow > 0){
			return $query->result();
		}else{
			return 0;
		}
    }
        
    function countdataByCondition($tbl,$where){
        $this->db->select('count(*) as cnt');
        $this->db->where($where);
		$query = $this->db->get($tbl);
		$numRow = $query->num_rows();
		if($numRow > 0){
			return $query->result();
		}else{
			return 0;
		}
    }


    function getemployeedata($id){
        $sql ="select employees.id, employees.emp_id, employees.emp_name, employees.username, employees.emp_email, employees.emp_phone, employees.joining_date, employees.emp_password, employees.emp_profile, employees.note, emp_permission.project_read, emp_permission.project_create, emp_permission.project_update, emp_permission.project_delete, emp_permission.tasks_read, emp_permission.tasks_create, emp_permission.tasks_update, emp_permission.tasks_delete, emp_permission.timesheet_read, emp_permission.timesheet_create, emp_permission.timesheet_update, emp_permission.timesheet_delete from employees inner join emp_permission on emp_permission.emp_id = employees.id  where employees.id = $id";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
    function groupby($tbl,$where,$column){
        $this->db->select('*');
        $this->db->where($where);
        $this->db->group_by($column);
		$query = $this->db->get($tbl);
        return $query->result();
    }
    
    
    

    
        public function getDataByTwoLimit($tbl,$limit,$where,$where1)
        {
            $this->db->select("*");
            $this->db->from($tbl);
            $this->db->order_by("created_at", "desc");
            $this->db->where($where);
            $this->db->where($where1);
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result();
        }

    function getprojectdata($id){
        $sql ="select projects.id, projects.project_name, projects.project_category, projects.project_start_date, projects.project_end_date, projects.description, projects.project_framework, projects.project_dashboard, projects.status, project_assigned.emp_id from projects inner join project_assigned on project_assigned.project_id = projects.id  where projects.id = $id";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
    function getemployeeproject($id){
        $sql ="select projects.id, projects.project_name, projects.project_category, projects.project_start_date, projects.project_end_date, projects.description, projects.project_framework, projects.project_dashboard, projects.members, projects.status, project_assigned.emp_id from project_assigned inner join projects on project_assigned.project_id = projects.id  where project_assigned.emp_id = $id";
        $query = $this->db->query($sql);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
}
?>