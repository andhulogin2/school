<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Fee_management_model extends CI_Model {

     function __construct() {
        parent::__construct();
		$this->db->query('SET SESSION sql_mode =
                  REPLACE(REPLACE(REPLACE(
                  @@sql_mode,
                  "ONLY_FULL_GROUP_BY,", ""),
                  ",ONLY_FULL_GROUP_BY", ""),
                  "ONLY_FULL_GROUP_BY", "")');
    }
	
	function get_classes()
	{
		$this->db->order_by('name','ASC');
		$classes = $this->db->get('class')->result_array();
		return $classes;
	}
	
	function fee_payment_options()
	{
 		$options = $this->db->get('tbl_fee_payment_options_master')->result_array();
		return $options;
	}
	function fee_payment_option($option_master_id='')
	{
		$this->db->select('*');
		$this->db->from('tbl_fee_payment_options_master');
		$this->db->where('fee_payment_options_master_id',$option_master_id);
		$result=$this->db->get()->result_array();
		
		foreach($result as $option)
		return $option['fee_payment_options_master'];
	}
	function fee_payment_options_details($payment_option='')
	{
			$this->db->select('fee_payment_options_details_id,fee_payment_options_details');
			$this->db->where('fee_payment_options_master_id',$payment_option);
			$installments = $this->db->get('tbl_fee_payment_options_details')->result_array();
			return $installments;
	}
	function get_fee_heads($fee_category_id='')
	{
			$this->db->select('fee_head_id,fee_head');
			if($fee_category_id!='')
			{
				$this->db->where('fee_category_id',$fee_category_id);
			}
			$this->db->where('active','Y');
			$this->db->where('is_deleted','N');
			$this->db->where('fee_head_id<>','9999');
			$fee_items = $this->db->get('tbl_fee_heads')->result_array();
			return $fee_items;
	}

	
	function delete_fee_master($fee_master_id='')
	{
			$this->db->where('fee_master_id' , $fee_master_id);
			$this->db->delete('tbl_fee_details');
			$this->db->set('is_deleted','Y');
			$this->db->where('fee_master_id',$fee_master_id);
			$this->db->update('tbl_fee_master');
	}
	
	function update_fee_master($fee_master_id='',$data)
	{
			
			$this->db->where('fee_master_id' , $fee_master_id);
			$this->db->update('tbl_fee_master' , $data);

	}
	
	function edit_fee_master1($fee_master_id)
	{
		
	}
	
	function get_fee_master()
	{
			$year	=	get_running_year();
	        $branch	=	$this->input->post('branch');
		    $dept	=	$this->input->post('department');
			$this->db->distinct('f.fee_master_id');
			$this->db->select('f.fee_master_id,f.fee_master_name,f.fee_total,c.name,c.class_id,f.branch_id,f.department_id,d.dept_name as dept,b.branch_name as branch,
				CASE WHEN (select count(fee_master_id) from tbl_students_fee_master where fee_master_id=f.fee_master_id and is_deleted="N" limit 1) > 0 THEN "Y" ELSE "N" END AS is_fee_assigned,
				(select SUM(fee_total) as fee_total from tbl_fee_installment_master where fee_master_id=f.fee_master_id) as full_fee_amount' );
			$this->db->from('view_fee_master f');
			$this->db->join('class c','f.class_id=c.class_id');
				$this->db->join('tbl_branch b','f.branch_id=b.branch_id','LEFT');
				$this->db->join('tbl_department d','f.department_id=d.dept_id','LEFT');
			 $this->db->where('c.academic_year',$year);
			if($this->session->userdata('role')==1 ||$this->session->userdata('role')==2)
		    {
		     if($branch && $dept)
		     {
		     $this->db->where('f.branch_id',$branch);
		     $this->db->where('f.department_id',$dept);
			 }
			}
			
			if($this->session->userdata('role')==3 )
		    {
		      if($dept)
		     {
	           $this->db->where('f.department_id',$dept);
			   $this->db->where('f.branch_id',$this->session->userdata('branch_id'));
		     }
			 else
			 {
			 	$this->db->where('f.branch_id',$this->session->userdata('branch_id'));
			 }
		     
		    }
			
		  if($this->session->userdata('role')==4 )
		  {
		   $this->db->where('f.branch_id',$this->session->userdata('branch_id'));
		   $this->db->where('f.department_id',$this->session->userdata('dept_id'));
		  }
		    
			$this->db->order_by('f.fee_master_id','asc');
			$fee_master	=	$this->db->get() ->result_array();//echo $this->db->last_query();die;
			//print_r($fee_master);die;
			return $fee_master;
	}

function get_installment_name($option_details_id)
	{
		$this->db->where('fee_payment_options_details_id',$option_details_id);
		return $this->db->get('tbl_fee_payment_options_details')->row()->fee_payment_options_details;
	}


	function get_fee_master_name($fee_master_id='')
	{
		$this->db->select('fee_master_name');
		$this->db->from('tbl_fee_master');
		$this->db->where('fee_master_id',$fee_master_id);
		$result=$this->db->get()->result_array();
		
		foreach ( $result as $row)
		return $row['fee_master_name'];
	}
	function get_fee_amount($fee_master_id='')
	{
		$this->db->select('fee_total');
		$this->db->from('tbl_fee_master');
		$this->db->where('fee_master_id',$fee_master_id);
		$result=$this->db->get()->result_array();
		
		foreach ( $result as $row)
		return $row['fee_total'];
	}
	function delete_fee_details($fee_master_id='')
	{
			$this->db->where('fee_master_id' , $fee_master_id);
			$this->db->delete('tbl_fee_details');
	}
	function insert_fee_details($data)
	{
			$this->db->insert('tbl_fee_details', $data);
	}
	function get_class_name($class_id='')
	{
		$this->db->select('name');
		$this->db->from('class');
		$this->db->where('class_id',$class_id);
		$result=$this->db->get()->result_array();
		
		foreach ($result as $row)
		return $row['name'];
	}
	function get_installment_details($fee_master_id='')
	{
	$this->db->select('fee_installment_master_id,fee_payment_options_master_id,fee_payment_options_details_id,fee_payment_options_master,fee_payment_options_details,fee_total');
		$this->db->from('view_installment_details ');
		$this->db->where('fee_master_id',$fee_master_id);
		$result = $this->db->get()->result_array();
		return $result;
	}
	function get_installment_items($fee_master_id='')
	{
	  $this->db->select('fd.fee_head_id,fh.fee_head,fee_amount');
	  $this->db->from('tbl_fee_details fd');
	  $this->db->join('tbl_fee_heads fh','fh.fee_head_id=fd.fee_head_id','LEFT');
	  $this->db->where('fd.fee_master_id',$fee_master_id);
	  $result=$this->db->get()->result_array();
	  return $result;
	}
	
function delete_installment_details($installment_master_id='',$fee_head_id='')
	{
		$this->db->delete('tbl_fee_installment_details', array('fee_installment_master_id'=> $installment_master_id,'fee_head_id'=> $fee_head_id));
	}
	
		
	function insert_installment_details($data='')
	{
		$queryResult=$this->db->insert('tbl_fee_installment_details', $data);
	}
	
	function update_fee_installment_master($data1='',$id='')
	{
		$this->db->where('fee_installment_master_id',$id);
		$this->db->update('tbl_fee_installment_master', $data1);
	}

	function get_single_paid_head_amount($installment_master_id,$fee_head_id)
	{
		$this->db->select('fee_amount');
		$this->db->where('fee_installment_master_id',$installment_master_id);
		$this->db->where('fee_head_id',$fee_head_id);
		$fee_amount	=	$this->db->get('tbl_fee_installment_details')->row();
		if(isset($fee_amount))
		{
			return $fee_amount->fee_amount;
		}
	}
	function get_fee_balance($fee_master_id,$fee_head_id)
	{
		$total	= 0;
	//echo $fee_master_id."-".$fee_head_id;die();
		$this->db->select('fee_installment_master_id');
		$this->db->where('fee_master_id',$fee_master_id);
		
		$installment_masters	=	$this->db->get('tbl_fee_installment_master')->result_array();
		
		foreach($installment_masters as $installment_master)
		{
			
			$this->db->select('fee_amount');
			$this->db->where('fee_installment_master_id',$installment_master['fee_installment_master_id']);
			$this->db->where('fee_head_id',$fee_head_id);
			$fee_amount	=	$this->db->get('tbl_fee_installment_details')->result_array();
			foreach($fee_amount as $fee_amounts)
			{
				$total	=	$total+$fee_amounts['fee_amount'];
				
			}
			//echo $this->db->last_query();
			//print_r($fee_amount);
		}
		//echo $total;
		return $total;
	}


		
	function get_students($data)
	{
		$academic_year=get_running_year();
		$role_id				=	$this->session->userdata('role');
		if($role_id==1 || $role_id==2)
		{
			$this->db->where('e.year',$academic_year);
			$this->db->where('s.branch_id',$data['branch_id']);
			$this->db->where('s.dept_id',$data['department_id']);
			$this->db->where('e.class_id',$data['class_id']);
			if($data['section_id']!='all')
			{
				$this->db->where('e.section_id',$data['section_id']);
			}
			$this->crud_model->check_student_status();
			$this->db->join('student s', 'e.student_id = s.student_id');
			$students = $this->db->get('enroll e')->result_array();
		}
		if($role_id==3)
		{
			$this->db->where('e.year',$academic_year);
			$this->db->where('s.dept_id',$data['department_id']);
			$this->db->where('e.class_id',$data['class_id']);
			if($data['section_id']!='all')
			{
				$this->db->where('e.section_id',$data['section_id']);
			}
			$this->crud_model->check_student_status();
			$this->db->join('student s', 'e.student_id = s.student_id');
			$students = $this->db->get('enroll e')->result_array();
		}
		if($role_id>=4)
		{
			$this->db->where('e.year',$academic_year);
			$this->db->where('e.class_id',$data['class_id']);
			if($data['section_id']!='all')
			{
				$this->db->where('e.section_id',$data['section_id']);
			}
			$this->crud_model->check_student_status();
			$this->db->join('student s', 'e.student_id = s.student_id');
			$students = $this->db->get('enroll e')->result_array();
		}
		//echo $this->db->last_query();die();
		return $students;
	}

	function check_fee_head_assigned($fee_head_id)
	{
		$this->db->select('a.*');
		$this->db->from('tbl_fee_details a');
		$this->db->join("tbl_fee_master b","b.fee_master_id=a.fee_master_id and a.fee_head_id='".$fee_head_id."' and b.is_deleted='N'");
		return $this->db->get()->result_array();
	}

	function check_receipt_exist($receipt_number,$branch_id)
	{
		$academic_year_id	=	get_running_year();
		$this->db->where('receipt_number',$receipt_number);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year_id',$academic_year_id);
		$qry1	=	$this->db->get('tbl_fee_collection_master')->result_array();
		
		$this->db->where('receipt_number',$receipt_number);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year_id',$academic_year_id);
		$qry2	=	$this->db->get('tbl_special_fee_collection_master')->result_array();
		
		$this->db->where('receipt_number',$receipt_number);
		$this->db->where('academic_year',$academic_year_id);
		$this->db->join('student b','b.student_id=a.student_id');
		$this->db->where('b.branch_id',$branch_id);
		$qry3	=	$this->db->get('tbl_transport_students_bus_fee_collection_master a')->result_array();

		if(count($qry1)>0 || count($qry2)>0 || count($qry3)>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	



	function get_student_by_id($student_id='')
	{

		$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent');
		$this->db->from('student');
		$this->db->where('student_id', $student_id);
		$student	=	$this->db->get()->result_array();
		return $student;
	}

	
	function get_fee_master_by_class($data)
	{
		$role_id		=	$this->session->userdata('role');
		if($role_id==1 || $role_id==2)
		{
			$fee_master = $this->db->get_where('tbl_fee_master' , array('branch_id' => $data['branch_id'],'department_id' => $data['department_id'],'class_id' => $data['class_id'],'is_deleted' =>'N'))->result_array();
		}
		if($role_id==3)
		{
			$branch_id	=	$this->session->userdata('branch_id');
			$fee_master = 	$this->db->get_where('tbl_fee_master' , array('branch_id' => $branch_id,'department_id' => $data['department_id'],'class_id' => $data['class_id'],'is_deleted' =>'N'))->result_array();
		}
		if($role_id>=4)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$department_id	=	$this->session->userdata('dept_id');
			$fee_master 	= 	$this->db->get_where('tbl_fee_master' , array('branch_id' => $branch_id,'department_id' => $department_id,'class_id' => $data['class_id'],'is_deleted' =>'N'))->result_array();
		}
		if(count($fee_master)>0)
		{
			$fee_master1	=	array();
			foreach($fee_master as $fee)
			{
				$amount	=	0;
				$this->db->where('fee_master_id',$fee['fee_master_id']);
				$query=$this->db->get('tbl_fee_installment_master')->result_array();
				foreach($query as $inst)
				{
					$amount	=	$amount+$inst['fee_total'];
				}
				if($amount==$fee['fee_total'])
				{
					$fee_master1[]	=	array(
											'fee_master_id'		=>	$fee['fee_master_id'],
											'fee_master_name'	=>	$fee['fee_master_name']
											);
				}
			}
			if(count($fee_master1)>0)
			{
				return $fee_master1;
			}
			else
			{
				$fee_master	=	array();	
				return $fee_master;
			}
		}
		else
		{
			return $fee_master;
		}
		//return $fee_master;
	}



	
	function get_student_fee_details($class_id='',$section='')
	{
		$academic_year=get_running_year();
		
                $this->db->where('year', $academic_year);
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id',$section);
		$this->crud_model->check_student_status();
		$this->db->join('enroll', 'enroll.student_id = s.student_id');
		$this->db->select('s.student_id, s.name');
		$student_fee_details		=	$this->db->get('student s')->result_array();
		return 	$student_fee_details;

	}
	function modify_fees($students_fee_master_id='')
	{
		$this->db->db_debug	=	FALSE;
		$this->db->select('students_fee_details_id,students_fee_master_id,students_fee_details_id,fee_head_id,fee_amount,fee_balance,fee_concession,remarks');
		$this->db->where('fee_amount>0');
		$this->db->where('students_fee_master_id',$students_fee_master_id);
		$this->db->where('is_deleted','N');
		$this->db->from('tbl_students_fee_details');
		$this->db->order_by("fee_head_id","asc");
		$result				=	$this->db->get()->result_array();
		$this->db->db_debug	=	TRUE;
		return $result;
	}
	function student_fee_master_update($data,$students_fee_master_id)
	{
		//$this->db->db_debug	=	FALSE;
		$this->db->set('fee_balance',$data['total_balance']);
		$this->db->set('fee_concession',$data['total_concession']);
		$this->db->set('fee_concession',$data['total_concession']);
		$this->db->where('students_fee_master_id',$students_fee_master_id);
		$this->db->update('tbl_students_fee_master');
		//$this->db->db_debug	=	TRUE;
		return $this->db->affected_rows();
	}
	function student_fee_details_update($data,$students_fee_details_id)
	{
		//$this->db->db_debug	=	FALSE;
		$this->db->set($data);
		$this->db->where('students_fee_details_id',$students_fee_details_id);
		$this->db->update('tbl_students_fee_details');
		$this->db->db_debug	=	TRUE;
		//return $this->db->affected_rows();
	}
	
	function get_total_inst_amount($fee_master_id)
	{
		$this->db->select('SUM(fee_total) as fee_total');
		$this->db->where('fee_master_id',$fee_master_id);
		$det	=	$this->db->get('tbl_fee_installment_master')->row();
		return $det->fee_total?$det->fee_total:0;
	
	}
	
	function check_fee_master_assigned($fee_master_id)
	{
		$this->db->select('students_fee_master_id');
		$this->db->where('fee_master_id',$fee_master_id);
		$this->db->limit(1);
		return $this->db->get('tbl_students_fee_master')->row();
	}

	function get_fee_head_details($fee_master_id)
	{
		$this->db->select('f.*,fh.fee_head');
		$this->db->from('tbl_fee_details f');
		$this->db->join('tbl_fee_heads fh','fh.fee_head_id=f.fee_head_id');
		$this->db->where('f.fee_master_id',$fee_master_id);
		return $this->db->get()->result_array();
	}
/**************Special Fee Start***************************/
	function get_branch()
	{
		$this->db->select('branch_id,branch_name');
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_branch')->result_array();
	}
	function get_department($branch_id)
	{
		$this->db->select('dept_id,dept_name');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_department')->result_array();
	}
	function get_class_by_branch($branch_id='',$department_id='',$academic_year_id='')
	{
		$this->db->select('c.class_id,c.name,d.dept_name');
		$this->db->from('class c');
		$this->db->where('c.branch_id',$branch_id);
		if($department_id!='')
		{
			$this->db->where('c.dept_id',$department_id);
		}
		if($academic_year_id!='')
		{
			$this->db->where('c.academic_year',$academic_year_id);
		}
		$this->db->join('tbl_department d','d.dept_id=c.dept_id');
		return $this->db->get()->result_array();
	}
	function special_fee_students($class_id,$section_id)
	{
		$academic_year	=	get_running_year();
        $this->db->where('year', $academic_year);
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id',$section_id);
		$this->crud_model->check_student_status();
		$this->db->join('enroll', 'enroll.student_id = s.student_id');
		$this->db->select('s.student_id, s.name,s.admission_number');
		$student		=	$this->db->get('student s')->result_array();
		return 	$student;
	}
	function get_special_fee_heads()
	{
		$this->db->select('fee_head_id,fee_head');
		$this->db->where('fee_category_id','2');
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_fee_heads')->result_array();
	}
	function special_fee_payment($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id');
		$data['entered_date']	=	date('Y-m-d');
		$this->db->insert('tbl_special_fee_collection_master',$data);
		$affected_rows			=	$this->db->affected_rows();	
		$last_insert_id			=	$this->db->insert_id();
		$result					=	array(
										'affected_rows'		=>	$affected_rows,
										'last_insert_id'	=>	$last_insert_id
										);
		return	$result;
	}
	function update_receipt($id,$branch_id)
	{
		//Get last inserted receipt number
		$this->db->select('receipt_number');
		$this->db->where('special_fee_collection_master_id',$id);
		$receipt	=	$this->db->get('tbl_special_fee_collection_master')->row();
		if(isset($receipt))
		{
			$receipt_number	=	$receipt->receipt_number;
                        $year           =	get_running_year();
                        if($this->db->table_exists('tbl_deleted_receipts'))
                        {
                                $this->db->where('receipt_number',$receipt_number);
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('year_id', $year);
                                $this->db->set('is_allotted',TRUE);
                                $this->db->update('tbl_deleted_receipts');
                                if($this->db->affected_rows() == 0)
                                {
                                        $data = array('voucher_number' => $receipt_number );
                                        $this->db->where('voucher_type_name', "Receipt");
                                        $this->db->where('branch_id', $branch_id);
                                        $this->db->where('academic_year_id', $year);
                                        $this->db->update('tbl_voucher', $data); 
                                        return $this->db->affected_rows();
                                }
                                return $this->db->affected_rows();
                        }
                        else
                        {
                                $data = array('voucher_number' => $receipt_number );
                                $this->db->where('voucher_type_name', "Receipt");
                                $this->db->where('branch_id', $branch_id);
                                $this->db->where('academic_year_id', $year);
                                $this->db->update('tbl_voucher', $data); 
                                return $this->db->affected_rows();
                        }
		}
		//Update tbl_voucher
		//$this->db->where('academic_year_id',$this->session->userdata('academic_year'));
		/*$this->db->where('branch_id',$branch_id);
		$this->db->where('voucher_type_name','Receipt');
	 	$this->db->where('academic_year_id', $year);
		$this->db->update('tbl_voucher',array('voucher_number'=>$receipt_number));
                echo $this->db->last_query()."<br>";
		return $this->db->affected_rows();*/
                
                
                
	}
	function check_paid($data)
	{
		$this->db->select('special_fee_collection_master_id');
		$this->db->limit(1);
		$query	=	$this->db->get_where('tbl_special_fee_collection_master',$data)->result_array();
		return $query;
	}
	function get_special_fee_report($ids)
	{
		//print_r($ids);die();
		if($ids['role']==1 || $ids['role']==2)
		{
			$this->db->where('branch_id',$ids['branch_id']);
			if($ids['department_id']!='')
			{
				$this->db->where('dept_id',$ids['department_id']);
			}
			if($ids['class_id']!='')
			{
				$this->db->where('class_id',$ids['class_id']);
			}
		}
		if($ids['role']==3)
		{
			$this->db->where('branch_id',$ids['branch_id']);
			if($ids['department_id']!='')
			{
				$this->db->where('dept_id',$ids['department_id']);
			}
			if($ids['class_id']!='')
			{
				$this->db->where('class_id',$ids['class_id']);
			}
		}
		if($ids['role']==4)
		{
			$this->db->where('branch_id',$ids['branch_id']);
			$this->db->where('dept_id',$ids['department_id']);
			if($ids['class_id']!='')
			{
				$this->db->where('class_id',$ids['class_id']);
			}
		}
		if($ids['role']==15)
		{
			$this->db->where('entered_by',$this->session->userdata('login_user_id'));
		}
		if($ids['section_id']!='')
		{
			$this->db->where('section_id',$ids['section_id']);
		}
		if($ids['fee_head_id']!='')
		{
			$this->db->where('fee_head_id',$ids['fee_head_id']);
		}
                $this->db->where('is_deleted','N');
		return $this->db->get('view_special_fee_collection_master')->result_array();
	}
	function get_name_by_id($query)
	{
		return $this->db->query($query)->row();
	}
/**************Special Fee End***************************/
/**************New Fee Start*******************************/
/*
 *Created By Mani, Started on 09-11-2018 12.57
 */
	function new_fee_head($para1='',$para2='')
	{
		$role	=	$this->session->userdata('role');
		if($para1 == 'view')
		{
			$this->db->select('a.fee_head_id,a.department_id,a.branch_id,a.fee_head_name,a.dept_name,(CASE WHEN a.fee_head_id=b.fee_head_id THEN "Y" ELSE "N"
END) AS is_used');
			$this->db->where('a.is_deleted','N');
			if($role==3)
			{
				$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
			}
			elseif($role>3)
			{
				$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('a.department_id',$this->session->userdata('dept_id'));
			}
			$this->db->join('tbl_fee_2_students_fee_details b','b.fee_head_id=a.fee_head_id','left');
			$this->db->join('tbl_fee_2_students_fee_master c','c.students_fee_master_id=b.students_fee_master_id and c.is_deleted="N"','left');
			$this->db->group_by('a.fee_head_id');
			$fee_head	=	$this->db->get('view_fee_2_heads a')->result_array();
			return $fee_head;
		}
		if($para1 == 'add')
		{
			if($role==1 || $role==2)
			{
				return $this->get_branch();
			}
			if($role>=3)
			{
				return $this->get_department($this->session->userdata('branch_id'));
			}
			
		}
		if($para1 == 'insert')
		{
			if($para2['department_id']!='all')
			{
				$this->db->db_debug = FALSE; 
				$this->db->insert('tbl_fee_2_heads',$para2);
				return $this->db->affected_rows();
				$this->db->db_debug = TRUE; 
			}
			else if($para2['department_id']=='all')	
			{
				$dept	=	$this->get_department($para2['branch_id']);
				foreach($dept as $row)
				{
					$set	=	array(
									'branch_id'		=>	$para2['branch_id'],
									'department_id'	=>	$row['dept_id'],
									'fee_head_name'	=>	$para2['fee_head_name']
									);
					$this->db->insert('tbl_fee_2_heads',$set);
				}
				return $this->db->affected_rows();
			}
		}
		if($para1 == 'edit')
		{
			$this->db->select('fee_head_id,department_id,branch_id,fee_head_name');
			$this->db->where('is_deleted','N');
			$this->db->where('fee_head_id',$para2);
			$result			=	$this->db->get('view_fee_2_heads')->row();
			return $result;
		}
		if($para1 == 'update')
		{
			$this->db->db_debug = FALSE; 
			$this->db->set('fee_head_name',$para2['fee_head_name']);
			$this->db->where('fee_head_id',$para2['fee_head_id']);
			$this->db->update('tbl_fee_2_heads');
			return $this->db->affected_rows();
			$this->db->db_debug = TRUE; 
		}
		if($para1 == 'delete')
		{
			$this->db->db_debug = FALSE; 
			$this->db->set('is_deleted','Y');
			$this->db->set('deleted_by',$this->session->userdata('login_user_id'));
			$this->db->set('deleted_date',date('Y-m-d'));						
			$this->db->where('fee_head_id',$para2);
			$this->db->update('tbl_fee_2_heads');
			return $this->db->affected_rows();
			$this->db->db_debug = TRUE; 
		}
	}
	
	function get_students_having_no_fee_structure($class_id,$section_id) 
	{
	/* This function is used in the functions 'assign_fee/insert_for_all' and 'get_students_having_no_fee_structure' of controller */
		$year	=	get_running_year();
	  /** Select students those who have no fee structure is assigned **/	
	  //Sub query	
		$this->db->select('student_id');
		$this->db->from('tbl_fee_2_students_fee_master');
		$this->db->where('is_deleted','N');
		$this->db->where('year_id',$year);
		$this->db->where('class_id',$class_id);
		$where_clause = $this->db->get_compiled_select();
	  //Main query	
		$this->db->select('s.student_id,s.name');
		$this->db->where('e.year',$year);
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.section_id',$section_id);
		$this->crud_model->check_student_status();
		$this->db->join('student s', 'e.student_id = s.student_id');
		$this->db->where("`s`.`student_id` NOT IN ($where_clause)", NULL, FALSE);
		$students = $this->db->get('enroll e')->result_array();
		return $students; 
	}
	function get_students1($class_id,$section_id)
	{
		$year	=	get_running_year();
		$this->db->select('s.student_id,s.name');
		$this->db->where('e.year',$year);
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.section_id',$section_id);
		$this->crud_model->check_student_status();
		$this->db->join('student s', 'e.student_id = s.student_id');
		$students = $this->db->get('enroll e')->result_array();
		return $students; 
	}
	function get_students2($dept_id='')
	{
		if($dept_id=='all')
		{
			$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
		}
		else if($dept_id!='')
		{
			$this->db->where('s.dept_id',$dept_id);
		}
		$year	=	get_running_year();
		$this->db->select('s.student_id,s.name');
		$this->db->where('e.year',$year);
		$this->crud_model->check_student_status();
		$this->db->join('student s', 'e.student_id = s.student_id');
		$students = $this->db->get('enroll e')->result_array();
		return $students; 
	}
	function get_fee2_heads($dept_id='')
	{
		if($dept_id!='')
		{
			$this->db->where('department_id',$dept_id);
		}
		$this->db->where('is_deleted','N');
		$this->db->select('fee_head_id,fee_head_name');
		return $this->db->get('tbl_fee_2_heads')->result_array();
	}
	function get_fee2_students_fee_master($student_id='')
	{
		$year	=	get_running_year();
		if($student_id!='')
		{
			$this->db->where('student_id',$student_id);
		}
		$this->db->where('is_deleted','N');
		$this->db->where('year_id',$year);
		//$this->db->where('student_id',$student_id);
		$this->db->select('students_fee_master_id,installment_no,due_date,student_id');
		$master		=	$this->db->get('tbl_fee_2_students_fee_master')->result_array();
		$fee_master	=	array();
		//Check if payment is done using the students fee master
		foreach($master as $row):
			$this->db->select('students_fee_master_id');
			$this->db->where('is_deleted','N');
			$this->db->where('students_fee_master_id',$row['students_fee_master_id']);
			$collection	=	$this->db->get('tbl_fee_2_students_fee_collection_master')->row();
			if(count($collection)>0)
			{
				$row['is_used']	=	'Y';
			}
			else
			{
				$row['is_used']	=	'N';
			}
			array_push($fee_master,$row);
		endforeach;
		return $fee_master;
	}
	
	function get_fee2_students_and_fee_master($class_id,$section_id)
	{
		$students	=	$this->get_students1($class_id,$section_id);
		$fee_master	=	array();
		foreach($students as $row):
			$row['fee_master']		=	$this->get_fee2_students_fee_master($row['student_id']);
			array_push($fee_master,$row);
		endforeach;
		return $fee_master;
	}
	
	function assign_fee($para1='',$para2='',$para3='')
	{
		/*
		 * Mani, 29-11-2018 12:08 
		 */ 
		$this->db->db_debug = FALSE;
		if($para1 == 'insert')
		{ 
			$this->db->insert('tbl_fee_2_students_fee_master',$para2); 
			return $this->db->insert_id();
		}
		if($para1 == 'insert2')
		{ 
			$this->db->insert('tbl_fee_2_students_fee_details',$para2); 
			return $this->db->insert_id();
		}
		if($para1 == 'master_update')
		{
			//$this->db->db_debug = FALSE; 
			$this->db->where('students_fee_master_id',$para3);
			$this->db->update('tbl_fee_2_students_fee_master',$para2);
			return $this->db->affected_rows();
			//$this->db->db_debug = TRUE; 
		}
	}	
	function edit_fee($para1='',$para2='',$para3='')
	{
		/*
		 * Mani, 02-12-2018 16:23 
		 */ 
		$this->db->db_debug = FALSE;
		if($para1 == 'master_update')
		{
			$this->db->where('students_fee_master_id',$para3);
			$this->db->update('tbl_fee_2_students_fee_master',$para2);//echo $this->db->last_query();die();
			return $this->db->affected_rows();
		}
		if($para1 == 'details_update')
		{
			$this->db->where('students_fee_details_id',$para3);
			$this->db->update('tbl_fee_2_students_fee_details',$para2);
			return $this->db->affected_rows();
		}
		if($para1 == 'delete')
		{
			$this->db->where('students_fee_master_id',$para2);
			$this->db->set('is_deleted','Y');
			$this->db->update('tbl_fee_2_students_fee_master');
			//echo $this->db->last_query();die();
			$this->db->where('students_fee_master_id',$para2);
			$this->db->delete('tbl_fee_2_students_fee_details');
			return $this->db->affected_rows();
		}
		
	}		 
	function get_stud_fee_master($stud_id='')
	{
		$year		=	get_running_year();
		$this->db->order_by('installment_no','ASC');
		$fee_master	=	$this->db->get_where('tbl_fee_2_students_fee_master',array('student_id'=>$stud_id,'year_id'=>$year,'is_deleted'=>'N'))->result_array();
		return $fee_master;
	}
	function fee_report($para1='',$para2='')
	{
		/*
		 * Mani, 05-12-2018 17:10 
		 */ 
		if($para1 == 'show_report')
		{
			$year							=	get_running_year();
			if($para2['report_type'] == 'due')
			{
				if($para2['dept_id'] == 'all')
				{
					$this->db->where('a.branch_id',$para2['branch_id']);
				}
				else
				{
					$this->db->where('a.department_id',$para2['dept_id']);
				}
				if($para2['class_id'] == 'all')
				{
					$this->db->where('a.department_id',$para2['dept_id']);
				}
				else if($para2['class_id']!='')
				{
					$this->db->where('a.class_id',$para2['class_id']);
				}
				if($para2['section_id'] == 'all')
				{
					$this->db->where('a.class_id',$para2['class_id']);
				}
				else if($para2['section_id']!='')
				{
					$this->db->where('a.section_id',$para2['section_id']);
				}
				if($para2['due_from_date']!='')
				{
					$this->db->where('a.due_date>=',date('Y-m-d',strtotime($para2['due_from_date'])));
				}
				if($para2['due_to_date']!='')
				{
					$this->db->where('a.due_date<=',date('Y-m-d',strtotime($para2['due_to_date'])));
				}
				$this->db->where('a.year_id',$year);
				$this->db->where('a.is_deleted','N');
				$this->db->where('a.amount_balance>','0');	
				$this->db->select('a.student_id,a.installment_no,a.due_date,a.amount_balance,a.student_name,a.phone1,a.class_name,a.section_name,a.dept_name,a.branch_name');			
				$this->db->from('view_fee2_due a');
				$due_students		=	$this->db->get()->result_array();//echo $this->db->last_query();die();
				return $due_students;
				
			}
			else if($para2['report_type'] == 'collection')
			{

				if($this->session->userdata('role')>4)
				{
					$this->db->where('a.created_by',$this->session->userdata('login_user_id'));
				}
				if($para2['dept_id'] == 'all')
				{
					$this->db->where('a.branch_id',$para2['branch_id']);
				}
				else
				{
					$this->db->where('a.department_id',$para2['dept_id']);
				}
				if($para2['class_id'] == 'all')
				{
					$this->db->where('a.department_id',$para2['dept_id']);
				}
				else if($para2['class_id']!='')
				{
					$this->db->where('a.class_id',$para2['class_id']);
				}
				if($para2['section_id'] == 'all')
				{
					$this->db->where('a.class_id',$para2['class_id']);
				}
				else if($para2['section_id']!='')
				{
					$this->db->where('a.section_id',$para2['section_id']);
				}
				if($para2['collection_from_date']!='')
				{
					$this->db->where('a.date_paid>=',date('Y-m-d',strtotime($para2['collection_from_date'])));
				}
				if($para2['collection_to_date']!='')
				{
					$this->db->where('a.date_paid<=',date('Y-m-d',strtotime($para2['collection_to_date'])));
				}
				if($para2['fee_head_id']!='all')
				{
					$this->db->where('a.fee_head_id',$para2['fee_head_id']);
				}
				/*if($para2['show_all_fee_items']=='Y')
				{*/
				$this->db->where('a.academic_year_id',$year);
				$this->db->where('a.is_deleted','N');
				$this->db->select('a.student_id,a.fee_head_id,a.head_amount_paid,a.date_paid,a.receipt_number,a.student_name,a.class_name,a.section_name,a.dept_name,a.fee_head_name');
				$this->db->from('view_fee2_collection a');
				$fee_collection	=	$this->db->get()->result_array();
				/*}
				else if($para2['show_all_fee_items']=='N')
				{
				
				}*/
				return $fee_collection;
			}
		}
	}	
	function check_receipt_exist2($receipt_number,$branch_id)
	{
		$year	=	get_running_year();
		$this->db->where('receipt_number',$receipt_number);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year_id',$year);
		$count1	=	$this->db->get('tbl_fee_collection_master')->num_rows();
		
		$count2	=	$this->db->get_where('tbl_fee_2_students_fee_collection_master',array('branch_id'=>$branch_id,'is_deleted'=>'N','receipt_number'=>$receipt_number))->num_rows();
		
		$count3	=	$this->db->get_where('tbl_special_fee_collection_master',array('branch_id'=>$branch_id,'receipt_number'=>$receipt_number))->num_rows();
		if($count1>0 || $count2>0 || $count3>0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
/**************New Fee End*********************************/

/************* Edit Receipt Start ***********************/
	function get_receipts()
	{
              //Get receipt number from tbl_fee_collection_master
		$role	=	$this->session->userdata('role_id');
		$year	=	get_running_year();
		$this->db->select('a.receipt_number,b.student_id,b.name,b.class_name,b.section_name');
		$this->db->from('tbl_fee_collection_master a');
		$this->db->join('view_students b','b.student_id=a.admission_number and b.year='.$year.'  and b.student_status_id=0');
//		$this->db->join('student c','c.student_id=b.student_id');
		if($role==4)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
		}
		if($role==3)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('a.academic_year_id',$year);
		$this->db->order_by('a.receipt_number','ASC');
//		$this->db->group_by('a.receipt_number');
		$receipts	=	$this->db->get()->result_array();

              //Get receipt number from tbl_transport_students_bus_fee_collection_master  
		$this->db->select('a.receipt_number,b.student_id,b.name,b.class_name,b.section_name');
		$this->db->from('tbl_transport_students_bus_fee_collection_master a');
		$this->db->join('view_students b','b.student_id=a.student_id and b.year='.$year.' and b.student_status_id=0');
//		$this->db->join('student c','c.student_id=b.student_id');
		if($role==4)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
		}
		if($role==3)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('a.academic_year',$year);
		$this->db->order_by('a.receipt_number','ASC');
//		$this->db->group_by('a.receipt_number');
		$receipts1	=   $this->db->get()->result_array();
                //print_r($receipts1);die;
              //Get receipt number from tbl_opening_balance_fee_collection 
		$this->db->select('a.receipt_number,b.student_id,b.name,b.class_name,b.section_name');
		$this->db->from('tbl_opening_balance_fee_collection a');
		$this->db->join('view_students b','b.student_id=a.student_id and b.year='.$year.' and b.student_status_id=0');
//		$this->db->join('student c','c.student_id=b.student_id');
		if($role==4)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
		}
		if($role==3)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('a.is_deleted','N');
		$this->db->where('a.paid_year_id',$year);
		$this->db->order_by('a.receipt_number','ASC');
//		$this->db->group_by('a.receipt_number');
		$receipts2	=   $this->db->get()->result_array();
              //Get receipt number from tbl_opening_balance_transport_fee_collection    
		$this->db->select('a.receipt_number,b.student_id,b.name,b.class_name,b.section_name');
		$this->db->from('tbl_opening_balance_transport_fee_collection a');
		$this->db->join('view_students b','b.student_id=a.student_id and b.year='.$year.' and b.student_status_id=0');
//		$this->db->join('student c','c.student_id=b.student_id');
		if($role==4)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
		}
		if($role==3)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
		}
                $this->db->where('a.is_deleted','N');
		$this->db->where('a.paid_year_id',$year);
		$this->db->order_by('a.receipt_number','ASC');
//		$this->db->group_by('a.receipt_number');
		$receipts3	=   $this->db->get()->result_array();
		
                $array          =   array_merge($receipts,$receipts1,$receipts2,$receipts3);
                $result         =   array_map("unserialize", array_unique(array_map("serialize", $array)));
                asort($result);
                //print_r($result);die;
                return $result;
	}
	function get_receipt_details($receipt_number,$student_id)
	{
                $year   =   get_running_year();
		$this->db->select('a.fee_collection_master_id,a.receipt_number,a.student_fee_master_id,a.admission_number,d.fee_payment_options_details');
		$this->db->from('tbl_fee_collection_master a');
		$this->db->join('tbl_students_fee_master b','b.students_fee_master_id=a.student_fee_master_id');
		$this->db->join('tbl_fee_installment_master c','c.fee_installment_master_id=b.fee_installment_master_id');
		$this->db->join('tbl_fee_payment_options_details d','d.fee_payment_options_details_id=c.fee_payment_options_details_id');
		$this->db->where('a.receipt_number',$receipt_number);
		$this->db->where('b.is_deleted','N');
                $this->db->where('a.academic_year_id',$year);
                if($student_id!='')
                {
                    $this->db->where('a.admission_number',$student_id);
                }    
		$result	=	$this->db->get()->result_array();
		$result1=	array();
		foreach($result as $row):
			$this->db->select('a.fee_collection_details_id,a.fee_head_id,a.fee_amount as paid_amount,b.fee_head,c.fee_amount as actual_amount,c.fee_balance');
			$this->db->from('tbl_fee_collection_details a');
			$this->db->join('tbl_fee_heads b','b.fee_head_id=a.fee_head_id');
			$this->db->join('tbl_students_fee_details c','c.fee_head_id=a.fee_head_id and c.students_fee_master_id='.$row['student_fee_master_id']);
			$this->db->where('a.fee_collection_master_id',$row['fee_collection_master_id']);
                        $this->db->where('c.is_deleted','N');
			$row['fee_collection_details']	=	$this->db->get()->result_array();
			array_push($result1,$row);
		endforeach;
		/*echo "<pre>";
		print_r($result1);
		echo "</pre>";*/
		return $result1;
	}
	
	function get_transport_receipt_details($receipt_number,$student_id)
	{
                $year   =   get_running_year();
		$this->db->select('a.bus_fee_collection_master_id,a.bus_fee_collection_details_id,a.students_bus_fee_master_id, a.fee_amount, b.fee_balance, b.fee_concession, b.bus_fee_settings_id,c.receipt_number,c.student_id,d.installment_name');
		$this->db->from('tbl_transport_students_bus_fee_collection_details a');
		$this->db->join('tbl_transport_students_bus_fee_master b','b.students_bus_fee_master_id=a.students_bus_fee_master_id');
		$this->db->join('tbl_transport_students_bus_fee_collection_master c','c.bus_fee_collection_master_id=a.bus_fee_collection_master_id');
		$this->db->join('tbl_transport_bus_fee_installment_settings d','d.bus_fee_settings_id=b.bus_fee_settings_id');
		$this->db->where('c.receipt_number',$receipt_number);
		$this->db->where('c.academic_year',$year);
		if($student_id!='')
                {
                    $this->db->where('c.student_id',$student_id);
                }    
		$res = $this->db->get();

		return $res->result_array();
	}
        
        function get_opening_balance_receipt_details($receipt_number,$student_id)
        {
                $select     =   'fee_from_year_id,fee_from_year ';
                $where      =   'receipt_number="'.$receipt_number.'" and is_deleted="N" ';
                if($student_id!='')
                {
                    $where  =   $where.'and student_id='.$student_id;
                }
                $group_by   =   'fee_from_year_id';
                $years      =   $this->view_opening_balance_collection($select,$where,$group_by)->result();
                        
                        
                /*$this->db->select('fee_from_year_id,fee_from_year');
                $this->db->from('view_opening_balance_collection');
                $this->db->where('receipt_number',$receipt_number);
                if($student_id!='')
                {
                    $this->db->where('student_id',$student_id);
                } 
                $this->db->where('is_deleted','N');
                $this->db->group_by('fee_from_year_id');
                $years  =   $this->db->get()->result(); //print_r($years);die;*/
                foreach($years as $row):
                    $select     =   'id as fee_collection_id,fee_head,opening_balance_id,amount_paid,fee_head_id,fee_balance ';
                    $where      =   'receipt_number="'.$receipt_number.'" and is_deleted="N" and fee_from_year_id='.$row->fee_from_year_id;
                    $row->data  =   $this->view_opening_balance_collection($select,$where)->result();
                            
                            
                    /*$this->db->select('fee_collection_id,fee_head,opening_balance_id,amount_paid,fee_head_id,fee_balance');
                    $this->db->where('receipt_number',$receipt_number);
                    $this->db->where('fee_from_year_id',$row->fee_from_year_id);
                    $this->db->where('is_deleted','N');
                    $row->data  =   $this->db->get('view_opening_balance_collection')->result();*/
                endforeach;
                /*echo "<pre>";
		print_r($years);
		echo "</pre>";die;*/
                return $years;
        }
        
        function view_opening_balance_collection($select="",$where="",$group_by="",$order_by="")
        {
            if($select == "")
            {
                $select =   'id as fee_collection_id,type,fee_head,opening_balance_id,receipt_number,amount_paid,date_paid,student_id,paid_year_id,paid_year,remarks,collected_by,collected_date,is_deleted,deleted_by,deleted_date,'.
                                'fee_from_year_id,fee_from_year,fee_head_id,fee_reference_id,fee_amount,fee_balance,enroll_id,student_name,class_id,class_name,section_id,section_name,roll,phone1,phone2,admission_number,'.
                                'branch_id,dept_id ';
            }
            if($where !== "")
            {
                $where  =   ' where '.$where;
            }
            if($group_by !== "")
            {
                $group_by   =   ' group by '.$group_by;
            }
            if($order_by !== "")
            {
                $order_by   =   ' order by '.$order_by;
            }
            $query  =   'select '.$select.        
                        ' from '.
                        '('.
                                '(select '.
                                        'a.*,b.fee_from_year_id,b.fee_head_id,b.fee_reference_id,b.fee_amount,b.fee_balance,'.
                                        'c.enroll_id,c.name as student_name,c.class_id,c.class_name,c.section_id,c.section_name,c.roll,c.phone1,c.phone2,c.admission_number,c.branch_id,c.dept_id,d.fee_head,'.
                                        '"normal_fee" as type,e.academic_year as fee_from_year,f.academic_year as paid_year '.
                                'from '.
                                        'tbl_opening_balance_fee_collection a '.
                                'inner join '. 
                                        'tbl_opening_balance b on b.id=a.opening_balance_id '.
                                'inner join '. 
                                        'view_students c on c.student_id=a.student_id and a.paid_year_id=c.year '.
                                'inner join '.
                                        'tbl_fee_heads d on d.fee_head_id=b.fee_head_id '.
                                'inner join '.
                                        'tbl_academic_year e on e.acdemic_year_id=b.fee_from_year_id '.
                                'inner join '.
                                        'tbl_academic_year f on f.acdemic_year_id=a.paid_year_id) '.
                                'union all '.
                                '(select '.
                                        'a.*,b.fee_from_year_id,"99999" as fee_head_id,b.fee_reference_id,b.fee_amount,b.fee_balance,'.
                                        'c.enroll_id,c.name as student_name,c.class_id,c.class_name,c.section_id,c.section_name,c.roll,c.phone1,c.phone2,c.admission_number,c.branch_id,c.dept_id,"Bus Fee" as fee_head,'.
                                        '"bus_fee" as type,e.academic_year as fee_from_year,f.academic_year as paid_year '.
                                'from '.
                                        'tbl_opening_balance_transport_fee_collection a '. 
                                'inner join '.
                                        'tbl_opening_balance_transport b on b.id=a.opening_balance_id '.
                                'inner join '.
                                        'view_students c on c.student_id=a.student_id and a.paid_year_id=c.year '.
                                'inner join '.
                                        'tbl_academic_year e on e.acdemic_year_id=b.fee_from_year_id '.
                                'inner join '.
                                        'tbl_academic_year f on f.acdemic_year_id=a.paid_year_id) '.	
                        ') tbl '.$where.$group_by.$order_by;
            $result     =   $this->db->query($query);
            return $result;
        }
	
/************* Edit Receipt end *************************/


/*************** Delete Receipt Start ********************/
	function get_receipt_number($dept_id)
	{
		$year		=	get_running_year();
		$this->db->select('receipt_number');
		$this->db->where('academic_year_id',$year);
		$this->db->where('department_id',$dept_id);
		$this->db->order_by('receipt_number','ASC');
		$this->db->group_by('receipt_number');
		$receipt	=	$this->db->get('tbl_fee_collection_master')->result_array();
		return $receipt;
	}
	function delete_receipt($receipt_number)
	{       
                date_default_timezone_set('Asia/Kolkata');
		$this->db->where('receipt_number',$receipt_number);
		$fee_col_master		=	$this->db->get('tbl_fee_collection_master')->result_array();
		
		$this->db->db_debug	=	FALSE;
		$this->db->trans_start();
		foreach($fee_col_master as $row):
                    //Insert data to tbl_deleted_fee_collection_master
                        $data           =       array(
                                                    'fee_collection_master_id'  =>  $row['fee_collection_master_id'],
                                                    'receipt_number'            =>  $row['receipt_number'],
                                                    'date_paid'                 =>  $row['date_paid'],
                                                    'student_fee_master_id'     =>  $row['student_fee_master_id'],
                                                    'admission_number'          =>  $row['admission_number'],
                                                    'class_id'                  =>  $row['class_id'],
                                                    'batch_id'                  =>  $row['batch_id'],
                                                    'department_id'             =>  $row['department_id'],
                                                    'branch_id'                 =>  $row['branch_id'],
                                                    'academic_year_id'          =>  $row['academic_year_id'],
                                                    'remarks'                   =>  $row['remarks'],
                                                    'payment_mode'              =>  $row['payment_mode'],
                                                    'collected_by'              =>  $row['collected_by'],
                                                    'collected_date'            =>  $row['collected_date'],
                                                    'deleted_by'                =>  $this->session->userdata('login_user_id'),
                                                    'deleted_date'              =>  date('Y-m-d H:i:s')
                                                );
                        $this->db->insert('tbl_deleted_fee_collection_master',$data);
                        
			$fee_col_det	=	$this->db->get_where('tbl_fee_collection_details',array('fee_collection_master_id'=>$row['fee_collection_master_id']))->result_array();
			$tot_fee_bal	=	0;
			foreach($fee_col_det as $row1):
                            //Insert data to tbl_deleted_fee_collection_details
                                $data   =       array(
                                                    'fee_collection_details_id' =>  $row1['fee_collection_details_id'],
                                                    'fee_collection_master_id'  =>  $row1['fee_collection_master_id'],
                                                    'fee_head_id'               =>  $row1['fee_head_id'],
                                                    'fee_amount'                =>  $row1['fee_amount']
                                                );
                                $this->db->insert('tbl_deleted_fee_collection_details',$data);
				
                                //Update fee balance in tbl_students_fee_details
				$this->db->where('fee_head_id',$row1['fee_head_id']);
				$this->db->where('students_fee_master_id',$row['student_fee_master_id']);
				$this->db->set('fee_balance','fee_balance+'.$row1['fee_amount'],FALSE);
				$this->db->update('tbl_students_fee_details');
				$tot_fee_bal=	$tot_fee_bal+$row1['fee_amount']; //echo $this->db->last_query()."<br>";
				
				//Delete data from tbl_fee_collection_details
				$this->db->where('fee_collection_details_id',$row1['fee_collection_details_id']);
				$this->db->delete('tbl_fee_collection_details');
			endforeach;	
			
			//Update feee balance in tbl_students_fee_master
			$this->db->where('students_fee_master_id',$row['student_fee_master_id']);
			$this->db->set('fee_balance','fee_balance+'.$tot_fee_bal,FALSE);
			$this->db->update('tbl_students_fee_master');
			
			//Delete data from tbl_fee_collection_master
			$this->db->where('fee_collection_master_id',$row['fee_collection_master_id']);
			$this->db->delete('tbl_fee_collection_master');
			
		endforeach;

		if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
                        $yr = get_running_year();
			$this->db->where('receipt_number',$receipt_number);
			$this->db->where('is_deleted','N');
			$this->db->where('academic_year',$yr);
			$bus_fee_collection_master		=	$this->db->get('tbl_transport_students_bus_fee_collection_master')->result_array();
			foreach($bus_fee_collection_master as $row1)
			{
			
                                //Insert data to tbl_deleted_transport_students_bus_fee_collection_master
                                $data           =       array(
                                                            'bus_fee_collection_master_id'  =>  $row1['bus_fee_collection_master_id'],
                                                            'receipt_number'                =>  $row1['receipt_number'],
                                                            'date_paid'                     =>  $row1['date_paid'],
                                                            'late_fee'                      =>  $row1['late_fee'],
                                                            'student_id'                    =>  $row1['student_id'],
                                                            'class_id'                      =>  $row1['class_id'],
                                                            'section_id'                    =>  $row1['section_id'],
                                                            'payment_mode'                  =>  $row1['payment_mode'],
                                                            'is_active'                     =>  $row1['is_active'],
                                                            'entered_by'                    =>  $row1['entered_by'],
                                                            'entered_date'                  =>  $row1['entered_date'],
                                                            'is_deleted'                    =>  'Y',
                                                            'deleted_by'                    =>  $this->session->userdata('login_user_id'),
                                                            'deleted_date'                  =>  date('Y-m-d H:i:s'),
                                                            'academic_year'                 =>  $row1['academic_year'] 
                                                        );
                                $this->db->insert('tbl_deleted_transport_students_bus_fee_collection_master',$data);

				$bus_fee_collection_details	=	$this->db->get_where('tbl_transport_students_bus_fee_collection_details',array('bus_fee_collection_master_id'=>$row1['bus_fee_collection_master_id']))->result_array();
				foreach($bus_fee_collection_details as $row2)
				{
                                    
                                        //Insert data to tbl_deleted_transport_students_bus_fee_collection_details
                                        $data   =       array(
                                                            'bus_fee_collection_details_id' =>  $row2['bus_fee_collection_details_id'],
                                                            'bus_fee_collection_master_id'  =>  $row2['bus_fee_collection_master_id'],
                                                            'students_bus_fee_master_id'    =>  $row2['students_bus_fee_master_id'],
                                                            'fee_amount'                    =>  $row2['fee_amount']
                                                        );
                                        $this->db->insert('tbl_deleted_transport_students_bus_fee_collection_details',$data);
                                    
					$this->db->set('fee_balance','fee_balance+'.$row2['fee_amount'],FALSE);
					$this->db->where('students_bus_fee_master_id',$row2['students_bus_fee_master_id']);
					$this->db->update('tbl_transport_students_bus_fee_master');
					
				}
				
				$this->db->where('bus_fee_collection_master_id',$row1['bus_fee_collection_master_id']);
				$this->db->delete('tbl_transport_students_bus_fee_collection_details');
			
			}
			$this->db->where('receipt_number',$receipt_number);
			$this->db->delete('tbl_transport_students_bus_fee_collection_master');
		}
		
                /***** Opening Balance Start *******/
                
                $this->db->select('opening_balance_id,amount_paid');
                $this->db->where('receipt_number',$receipt_number);
                $this->db->where('is_deleted','N');
                $res    =   $this->db->get('tbl_opening_balance_fee_collection')->result();
                foreach($res as $row):
                    $this->db->set('fee_balance','fee_balance+'.$row->amount_paid,FALSE);
                    $this->db->where('id',$row->opening_balance_id);
                    $this->db->update('tbl_opening_balance');
                endforeach;
                
                $this->db->where('receipt_number',$receipt_number);
                $this->db->where('is_deleted','N');
                $this->db->set('is_deleted','Y');
                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
                $this->db->update('tbl_opening_balance_fee_collection');
                
                $this->db->select('opening_balance_id,amount_paid');
                $this->db->where('receipt_number',$receipt_number);
                $this->db->where('is_deleted','N');
                $res    =   $this->db->get('tbl_opening_balance_transport_fee_collection')->result();
                foreach($res as $row):
                    $this->db->set('fee_balance','fee_balance+'.$row->amount_paid,FALSE);
                    $this->db->where('id',$row->opening_balance_id);
                    $this->db->update('tbl_opening_balance_transport');
                endforeach;
                
                $this->db->where('receipt_number',$receipt_number);
                $this->db->where('is_deleted','N');
                $this->db->set('is_deleted','Y');
                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
                $this->db->update('tbl_opening_balance_transport_fee_collection');
                
                
                /***** Opening Balance End *******/
                
                
		$year	=	get_running_year();
		$this->db->set('receipt_number',$receipt_number);
		$this->db->set('branch_id',$this->session->userdata('branch_id'));
		$this->db->set('year_id',$year);
		$this->db->insert('tbl_deleted_receipts');
		
		$this->db->trans_complete();
		
		if($this->db->trans_status() === FALSE)
		{
			return FALSE;		
		}	
		else
		{
			return TRUE;
		}	
	}

/*************** Delete Receipt End **********************/

	function get_transportation_fee($due_date,$due_date_from,$student_id)
	{
                $year   =   get_running_year();
		if($due_date_from!='')
		{
			$this->db->where('due_date>=',$due_date_from);
		}
		$this->db->where('due_date<=',$due_date);
		$this->db->where('student_id',$student_id);
		$this->db->where('academic_year',$year);
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
	}
	function get_specialfee_receipts()
	{
		$role	=	$this->session->userdata('role_id');
		$year	=	get_running_year();
		$this->db->select('a.receipt_number,b.name,b.class_name,b.section_name');
		$this->db->from('tbl_special_fee_collection_master a');
		$this->db->join('view_students b','b.student_id=a.student_id and b.year='.$year.'  and b.student_status_id=0');
		$this->db->join('student c','c.student_id=b.student_id');
		if($role==4)
		{
			$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
		}
		if($role==3)
		{
			$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('a.academic_year_id',$year);
		$this->db->order_by('a.receipt_number','ASC');
		$this->db->group_by('a.receipt_number');
		$receipts	=	$this->db->get()->result_array();
		return $receipts;
	}
	
	function get_specialfee_receipt_details($receipt_number)
	{
                $year   =   get_running_year();
		$this->db->select('a.special_fee_collection_master_id,a.receipt_number,a.fee_head_id,a.student_id,a.fee_amount');
		$this->db->from('tbl_special_fee_collection_master a');
		$this->db->join('tbl_fee_heads b','b.fee_head_id=a.fee_head_id');
		$this->db->where('a.receipt_number',$receipt_number);
		$this->db->where('a.academic_year_id',$year);
		$result	=	$this->db->get()->result_array();
		return $result;
	}

	function delete_specialfee_receipt($receipt_number)
	{
		$this->db->db_debug	=	FALSE;
		$this->db->trans_start();

		//Delete data from tbl_special_fee_collection_master
		$this->db->where('receipt_number',$receipt_number);
		$this->db->delete('tbl_special_fee_collection_master');
		$this->db->trans_complete();

		$year	=	get_running_year();
		$this->db->set('receipt_number',$receipt_number);
		$this->db->set('branch_id',$this->session->userdata('branch_id'));
		$this->db->set('year_id',$year);
		$this->db->insert('tbl_deleted_receipts');
		
		
		if($this->db->trans_status() === FALSE)
		{
			return FALSE;		
		}	
		else
		{
			return TRUE;
		}	
	}
	
        
	function get_last_paid_info($student_id)
	{
	    $year   =   get_running_year();
	    $this->db->select('fee_collection_master_id,DATE_FORMAT(date_paid,"%d-%m-%Y") as date_paid');
	    //$this->db->where('admission_number',$student_id);
	    //$this->db->where('academic_year_id',$year);
	    $this->db->where('receipt_number = (select MAX(receipt_number) from tbl_fee_collection_master where admission_number='.$student_id.' and academic_year_id='.$year.')', NULL, FALSE);
	    $info   =   $this->db->get('tbl_fee_collection_master')->result_array();//echo $this->db->last_query();die;
	    //print_r($info);die;
	    if(count($info)>0)
	    {
	        $data['last_paid_date']     =   $info[0]['date_paid'];
	        $ids                        =   array();   
	        foreach($info as $row):
	            $ids[]                  =   $row['fee_collection_master_id'];
	        endforeach;     
	        $this->db->select('SUM(fee_amount) as fee_amount');
	        $this->db->where_in('fee_collection_master_id',$ids);
	        $data['last_paid_amount']   =   $this->db->get('tbl_fee_collection_details')->row()->fee_amount;//echo $this->db->last_query();die;
	    }
	    else
	    {
	        $data['last_paid_date']     =   "-";
	        $data['last_paid_amount']   =   "-";
	    }
	    //print_r($data);die;
	    return $data;
	}
	
	function get_fee_balance_master($student_id,$year)
	{
		$this->db->select('SUM(fee_balance) AS fee_balance');
		$this->db->where('admission_number',$student_id);
		$this->db->where('academic_year_id',$year);
		$this->db->where('is_deleted','N');
		$result		=	$this->db->get('tbl_students_fee_master')->row();
		return $result->fee_balance;
	}
	function generate_ref_id($student_id,$year)
	{
		$this->db->select('MAX(opening_balance_reference_id) as ref_id');
                $this->db->where('is_deleted','N');
		$ref_id1	=	$this->db->get('tbl_students_fee_master')->row()->ref_id;
		
		$this->db->select('MAX(opening_balance_reference_id) as ref_id');
                $this->db->where('is_deleted','N');
		$ref_id2	=	$this->db->get('tbl_transport_students_bus_fee_master')->row()->ref_id;
		
		if($ref_id1 > $ref_id2 || $ref_id1 == $ref_id2)
		{
			return $ref_id1+1;
		}
		else if($ref_id1 < $ref_id2)
		{
			return $ref_id2+1;
		}
		//return mt_rand(1,10000000).$student_id.$year;
	}
	function update_reference_id($col,$val,$table,$where)
	{
		$this->db->set($col,$val);
		$this->db->where($where);
		$this->db->update($table);
	}
	function insert_opening_balance($student_id,$year,$opening_balance_ref_id,$to_year)
	{
		$this->db->select('students_fee_master_id');
		$this->db->where('admission_number',$student_id);
		$this->db->where('academic_year_id',$year);
                $this->db->where('is_deleted','N');
		$fee_master			=	$this->db->get('tbl_students_fee_master')->result_array();
		
		$fee_masters		=	array();
		foreach($fee_master as $row):
			$fee_masters[]	=	$row['students_fee_master_id'];	
		endforeach;
		
		$this->db->select('sum(fee_amount) as fee_amount, sum(fee_balance) as fee_balance, fee_head_id');
		$this->db->where_in('students_fee_master_id',$fee_masters);
		$this->db->group_by('fee_head_id');
		$fee_details		=	$this->db->get('tbl_students_fee_details')->result_array(); //echo $this->db->last_query();
		
		foreach($fee_details as $row):
			if($row['fee_balance']>0)
			{
				$data			=	array(
										'student_id'		=>	$student_id,
										'fee_from_year_id'	=>	$year,
										'fee_to_year_id'	=>	$to_year,
										'fee_head_id'		=>	$row['fee_head_id'],
										'fee_reference_id'	=>	$opening_balance_ref_id,
										'fee_balance'		=>	$row['fee_balance'],
										'fee_amount'		=>	$row['fee_balance']
									);
				$this->db->insert('tbl_opening_balance',$data);		
			}				
		endforeach;
	}
	
	function get_bus_fee_balance($student_id,$year)
	{
		$this->db->select('SUM(fee_balance) AS fee_balance');
		$this->db->where('student_id',$student_id);
		$this->db->where('academic_year',$year);
                $this->db->where('is_deleted','N');
		$result		=	$this->db->get('tbl_transport_students_bus_fee_master')->row();
		return $result->fee_balance;
	}
	
	function insert_opening_balance_transport($student_id,$year,$opening_balance_ref_id,$to_year)
	{
		$this->db->select('sum(fee_amount) as fee_amount, sum(fee_balance) as fee_balance');
		$this->db->where('student_id',$student_id);
		$this->db->where('academic_year',$year);
                $this->db->where('is_deleted','N');
		$fee_details		=	$this->db->get('tbl_transport_students_bus_fee_master')->row(); //echo $this->db->last_query();
		
		if(isset($fee_details) && $fee_details->fee_balance > 0)
		{
			$data			=	array(
									'student_id'		=>	$student_id,
									'fee_from_year_id'	=>	$year,
                                                                        'fee_to_year_id'	=>	$to_year,
									'fee_reference_id'	=>	$opening_balance_ref_id,
									'fee_balance'		=>	$fee_details->fee_balance,
									'fee_amount'		=>	$fee_details->fee_balance
								);
			$this->db->insert('tbl_opening_balance_transport',$data);		
		}				
	}
        function get_all_fee_data($department,$class_id,$section_id,$student_id)
        {
            $year = get_running_year();
            $query  =   "select student_id,class_id,section_id,academic_year_id,SUM(fee_amount) AS fee_amount,SUM(fee_balance) AS fee_balance,SUM(fee_concession) AS fee_concession,dept_id,name,class_name,section_name from "
                    . "((select a.admission_number as student_id,a.class_id,a.batch_id as section_id,a.academic_year_id,SUM(a.fee_amount) AS fee_amount,SUM(a.fee_balance) AS fee_balance,SUM(a.fee_concession) AS fee_concession,b.dept_id,b.name,c.name as class_name,d.name as section_name"
                    . " from tbl_students_fee_master a "
                    . "inner join student b on b.student_id=a.admission_number "
                    . "inner join class c on c.class_id=a.class_id "
                    . "inner join section d on d.section_id=a.batch_id "
                    . "where a.academic_year_id=".$year." and a.is_deleted='N' and b.dept_id=".$department;
            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and a.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and a.batch_id=".$section_id;
            }
            if($student_id!='' && $student_id!='all')
            {
                $query  =   $query." and a.admission_number=".$student_id;	
            }

            $query  =   $query." group by a.admission_number) "
                    . "UNION ALL "
                    . "(select a.student_id,b.class_id,b.section_id,a.academic_year,SUM(a.fee_amount) AS fee_amount,SUM(a.fee_balance) AS fee_balance,SUM(a.fee_concession) AS fee_concession,b.dept_id,b.name,b.class_name,b.section_name"
                    . " from tbl_transport_students_bus_fee_master a "
                    . "inner join view_students b on b.student_id=a.student_id and b.year=".$year
                    . " where a.academic_year=".$year." and a.is_deleted='N' and b.dept_id=".$department;
            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and b.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and b.section_id=".$section_id;
            }
            if($student_id!='' && $student_id!='all')
            {
                $query  =   $query." and a.student_id=".$student_id;	
            }
            $query  =   $query." group by a.student_id) "
                    . "UNION ALL "
                    . "(select a.student_id,b.class_id,b.section_id,a.fee_from_year_id,SUM(a.fee_amount) AS fee_amount,SUM(a.fee_balance) AS fee_balance,0 AS fee_concession,b.dept_id,b.name,b.class_name,b.section_name"
                    . " from tbl_opening_balance a "
                    . "inner join view_students b on b.student_id=a.student_id and b.year=".$year
                    . " where a.fee_from_year_id<".$year." and b.dept_id=".$department;
            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and b.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and b.section_id=".$section_id;
            }
            if($student_id!='' && $student_id!='all')
            {
                $query  =   $query." and a.student_id=".$student_id;	
            }
            $query  =   $query." group by a.student_id) "
                    . "UNION ALL "
                    . "(select a.student_id,b.class_id,b.section_id,a.fee_from_year_id,SUM(a.fee_amount) AS fee_amount,SUM(a.fee_balance) AS fee_balance,0 AS fee_concession,b.dept_id,b.name,b.class_name,b.section_name"
                    . " from tbl_opening_balance_transport a "
                    . "inner join view_students b on b.student_id=a.student_id and b.year=".$year
                    . " where a.fee_from_year_id<".$year." and b.dept_id=".$department;
            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and b.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and b.section_id=".$section_id;
            }
            if($student_id!='' && $student_id!='all')
            {
                $query  =   $query." and a.student_id=".$student_id;	
            }
            $query  =   $query." group by a.student_id)) tbl group by student_id order by class_id asc,section_id asc";
            //echo $query;die;
            $data = $this->db->query($query)->result_array();
            return $data;
        }
        
        function progress_report_fee_data($student_id,$class_id,$section_id,$special_fee="yes",$single_record="no")
        {
            if($single_record == "yes")
            {
                $qry    =   "select sum(fee_amount) as fee_amount";
            }
            else
            {
                $qry    =   "select admission_number,date_paid,receipt_number,fee_head,fee_amount,fee_due_year";
            }
            
            $qry    =   $qry. " from ("
                        . "(select admission_number,date_paid,receipt_number,fee_head,fee_amount,0 as fee_due_year "
                        . "from view_fee_collection_details "
                        . "where admission_number=".$student_id." and class_id=".$class_id." and batch_id=".$section_id." )"
                        . " union all "
                        . "(select student_id as admission_number,date_paid,receipt_number,'Bus Fee' as fee_head,amount_paid as fee_amount,0 as fee_due_year "
                        . "from view_transport_students_bus_fee_collection_details "
                        . "where student_id=".$student_id." and class_id=".$class_id." and section_id=".$section_id." )"
                        . " union all ";
                        if($special_fee=="yes")
                        {
                        $qry    =   $qry."(select student_id as admission_number,date_paid,receipt_number,fee_head,fee_amount,0 as fee_due_year "
                            . "from view_special_fee_collection_master "
                            . "where student_id=".$student_id." and class_id=".$class_id." and section_id=".$section_id." and is_deleted='N' )"
                            . " union all ";
                        }
            $qry    =   $qry. '(select student_id as admission_number,date_paid,receipt_number,fee_head,amount_paid as fee_amount,fee_from_year as fee_due_year '
                        //. "from view_opening_balance_collection "
                        . 'from ((select '.
                                        'a.*,b.fee_from_year_id,b.fee_head_id,b.fee_reference_id,b.fee_amount,b.fee_balance,'.
                                        'c.enroll_id,c.name as student_name,c.class_id,c.class_name,c.section_id,c.section_name,c.roll,c.phone1,c.phone2,c.admission_number,c.branch_id,c.dept_id,d.fee_head,'.
                                        '"normal_fee" as type,e.academic_year as fee_from_year,f.academic_year as paid_year '.
                                'from '.
                                        'tbl_opening_balance_fee_collection a '.
                                'inner join '. 
                                        'tbl_opening_balance b on b.id=a.opening_balance_id '.
                                'inner join '. 
                                        'view_students c on c.student_id=a.student_id and a.paid_year_id=c.year '.
                                'inner join '.
                                        'tbl_fee_heads d on d.fee_head_id=b.fee_head_id '.
                                'inner join '.
                                        'tbl_academic_year e on e.acdemic_year_id=b.fee_from_year_id '.
                                'inner join '.
                                        'tbl_academic_year f on f.acdemic_year_id=a.paid_year_id) '.
                                'union all '.
                                '(select '.
                                        'a.*,b.fee_from_year_id,"99999" as fee_head_id,b.fee_reference_id,b.fee_amount,b.fee_balance,'.
                                        'c.enroll_id,c.name as student_name,c.class_id,c.class_name,c.section_id,c.section_name,c.roll,c.phone1,c.phone2,c.admission_number,c.branch_id,c.dept_id,"Bus Fee" as fee_head,'.
                                        '"bus_fee" as type,e.academic_year as fee_from_year,f.academic_year as paid_year '.
                                'from '.
                                        'tbl_opening_balance_transport_fee_collection a '. 
                                'inner join '.
                                        'tbl_opening_balance_transport b on b.id=a.opening_balance_id '.
                                'inner join '.
                                        'view_students c on c.student_id=a.student_id and a.paid_year_id=c.year '.
                                'inner join '.
                                        'tbl_academic_year e on e.acdemic_year_id=b.fee_from_year_id '.
                                'inner join '.
                                        'tbl_academic_year f on f.acdemic_year_id=a.paid_year_id)) tbl1 '
                        . "where student_id=".$student_id." and class_id=".$class_id." and section_id=".$section_id." and is_deleted='N' ) "
                        . ") tbl order by date_paid asc,receipt_number asc";
            //echo $qry;die;            
            $fee_details		=	$this->db->query($qry)->result_array(); 
            return $fee_details;
        }
        
        function get_pending_fee($student_id,$class_id,$till_today="no")
        {
            $year       =   get_running_year();
            
            $condition1 =   "a.fee_balance>0 and a.academic_year_id='$year' and a.enroll_year='$year' ";
            $condition2 =   "a.is_deleted='N' and  a.fee_balance>0 and a.academic_year='$year' and a.enroll_year='$year' ";
            $condition3 =   "a.fee_to_year_id='$year'  and a.fee_balance>0 ";
            $condition4 =   "a.fee_to_year_id='$year'  and a.fee_balance>0 ";
            
            if($student_id!="")
            {
                $condition1 =   $condition1." and a.admission_number='$student_id' ";
                $condition2 =   $condition2." and a.student_id='$student_id' ";
                $condition3 =   $condition3." and a.student_id='$student_id' ";
                $condition4 =   $condition4." and a.student_id='$student_id' ";    
            }
            if($class_id!="")
            {
                $condition1 =   $condition1." and a.class_id='$class_id' ";
                $condition2 =   $condition2." and a.class_id='$class_id' ";
            }
            if($this->session->userdata('role') >= 4)
            {
                $dept_id    =   $this->session->userdata('dept_id');
                $condition1 =   $condition1." and a.dept_id='$dept_id' ";
                $condition2 =   $condition2." and a.dept_id='$dept_id' ";
                $condition3 =   $condition3." and b.dept_id='$dept_id' ";
                $condition4 =   $condition4." and b.dept_id='$dept_id' ";
            }
          /*$condition1 =   "a.class_id='$class_id' and a.admission_number='$student_id'  and  a.fee_balance>0 and a.enroll_year='$year' ";
            $condition2 =   "a.class_id='$class_id' and a.student_id='$student_id'  and a.is_deleted='N' and  a.fee_balance>0 and a.academic_year='$year' ";
            $condition3 =   "a.student_id='$student_id' and a.fee_to_year_id='$year'  and a.fee_balance>0 ";
            $condition4 =   "a.student_id='$student_id' and a.fee_to_year_id='$year'  and a.fee_balance>0 ";*/
            
            if($till_today == "yes")
            {
                $condition1 =   $condition1."and a.due_date<='".date('Y-m-d')."'";
                $condition2 =   $condition2."and a.due_date<='".date('Y-m-d')."'";
            }
            
            $sql            =   "select sum(fee_balance) as fee_balance ".
                                "from ".
                                 "(".
                                     "(SELECT sum(case when (a.student_status_id !=0 and a.student_status_id !=5) then 0 else `a`.`fee_balance` end) as fee_balance ".
                                    //  "FROM view_fee_due a inner join student b on b.student_id=a.admission_number and b.student_status_id=0 ".
                                     "FROM view_fee_due a ".
                                     "where " . $condition1 ." ) ".
                                 "UNION ALL ".
                                     "(SELECT sum(case when (a.student_status_id !=0 and a.student_status_id !=5) then 0 else `a`.`fee_balance` end) as fee_balance ".
                                    //  "FROM view_transport_students_bus_fee_master a inner join student b on b.student_id=a.student_id and (b.student_status_id=0 or b.student_status_id=5) ".
                                     "FROM view_transport_students_bus_fee_master a inner join student b on b.student_id=a.student_id ".
                                     "where " . $condition2 ." ) ".
                                 "UNION ALL ".
                                     "(SELECT sum(a.fee_balance) as fee_balance ".
                                     "FROM tbl_opening_balance a inner join student b on b.student_id=a.student_id ".
                                     "where " . $condition3 ." ) ". 
                                 "UNION ALL ".
                                     "(SELECT sum(a.fee_balance) as fee_balance ".
                                     "FROM tbl_opening_balance_transport a inner join student b on b.student_id=a.student_id ".
                                     "where " . $condition4 ." )".      
                                 ") ".
                                 "as T";
            $fee_balance    =   $this->db->query($sql)->row()->fee_balance;//echo $this->db->last_query();die;
            return $fee_balance;
        }
        function check_fee_migrated($ref_id,$table)
        {
            $this->db->select('id');
            $this->db->where('fee_reference_id',$ref_id);
            $this->db->limit(1);
            $result =   $this->db->get($table)->row();
            return isset($result)?true:false;
        }
		
		function get_fee_head_wise_report($department,$class_id,$section_id,$from_date,$to_date)
        {
            $year = get_running_year();

            $query  =   'select c.class_id,c.section_id,c.dept_id,f.academic_year as academic_year_id,SUM(a.amount_paid) AS fee_amount,d.fee_head,"op" as title '.
                                'from '.
                                        'tbl_opening_balance_fee_collection a '.
                                'join '. 
                                        'tbl_opening_balance b on b.id=a.opening_balance_id '.
                                'join '. 
                                        'view_students c on c.student_id=a.student_id and a.paid_year_id=c.year '.
                                'join '.
                                        'tbl_fee_heads d on d.fee_head_id=b.fee_head_id '.
                                'join '.
                                        'tbl_academic_year f on f.acdemic_year_id=a.paid_year_id '.
								"where a.paid_year_id=".$year." and c.dept_id=".$department;
				if($class_id!='' && $class_id!='all')
				{
					$query  =   $query." and c.class_id=".$class_id;
				}
				if($section_id!='' && $section_id!='all')
				{
					$query  =   $query." and c.section_id=".$section_id;
				}
				if($from_date!='' && $to_date!='')
				{
					$query  =   $query." and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . date('Y-m-d',strtotime($from_date)) . "' and '" . date('Y-m-d',strtotime($to_date))."'";
				}
            $query  =   $query." group by d.fee_head_id ".
                                'union all '.
                                'select c.class_id,c.section_id,c.dept_id,f.academic_year as academic_year_id,SUM(a.amount_paid) AS fee_amount,"Transportation Fee" as fee_head,"op" as title '.
                                'from '.
                                        'tbl_opening_balance_transport_fee_collection a '. 
                                'join '.
                                        'tbl_opening_balance_transport b on b.id=a.opening_balance_id '.
                                'join '.
                                        'view_students c on c.student_id=a.student_id and a.paid_year_id=c.year '.
                                'join '.
                                        'tbl_academic_year f on f.acdemic_year_id=a.paid_year_id '.
								"where a.paid_year_id=".$year." and c.dept_id=".$department;
				if($class_id!='' && $class_id!='all')
				{
					$query  =   $query." and c.class_id=".$class_id;
				}
				if($section_id!='' && $section_id!='all')
				{
					$query  =   $query." and c.section_id=".$section_id;
				}
				if($from_date!='' && $to_date!='')
				{
					$query  =   $query." and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . date('Y-m-d',strtotime($from_date)) . "' and '" . date('Y-m-d',strtotime($to_date))."'";
				}
            $query  =   $query." "
                    . "UNION ALL "
            ."(select a.class_id,a.batch_id as section_id,a.department_id as dept_id,a.academic_year_id,SUM(b.fee_amount) AS fee_amount,c.fee_head,'' as title"
                    . " from tbl_fee_collection_master a "
                    . "join tbl_fee_collection_details b on b.fee_collection_master_id=a.fee_collection_master_id "
                    . "join tbl_fee_heads c on c.fee_head_id=b.fee_head_id "
                    . "where a.academic_year_id=".$year." and a.department_id=".$department;

            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and a.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and a.batch_id=".$section_id;
            }
            if($from_date!='' && $to_date!='')
            {
                $query  =   $query." and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . date('Y-m-d',strtotime($from_date)) . "' and '" . date('Y-m-d',strtotime($to_date))."'";
            }

            $query  =   $query." group by b.fee_head_id) "
                    . "UNION ALL "
                    . "(select a.class_id,a.section_id,c.dept_id,a.academic_year,SUM(b.fee_amount) AS fee_amount,'Transportation Fee' as fee_head,'' as title"
                    . " from tbl_transport_students_bus_fee_collection_master a "
                    . "join tbl_transport_students_bus_fee_collection_details b on b.bus_fee_collection_master_id=a.bus_fee_collection_master_id "
                    . "join class c on a.class_id=c.class_id "
                    . " where a.academic_year=".$year." and c.dept_id=".$department;
            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and a.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and a.section_id=".$section_id;
            }
            if($from_date!='' && $to_date!='')
            {
                $query  =   $query." and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . date('Y-m-d',strtotime($from_date)) . "' and '" . date('Y-m-d',strtotime($to_date))."'";
            }
            $query  =   $query.") "
                    . "UNION ALL "
                    . "(select a.class_id,a.section_id,c.dept_id,a.academic_year_id,SUM(a.fee_amount) AS fee_amount,b.fee_head,'' as title"
                    . " from tbl_special_fee_collection_master a "
                    . "join tbl_fee_heads b on b.fee_head_id=a.fee_head_id "
                    . "join class c on a.class_id=c.class_id "
                    . " where a.academic_year_id=".$year." and c.dept_id=".$department;
            if($class_id!='' && $class_id!='all')
            {
                $query  =   $query." and a.class_id=".$class_id;
            }
            if($section_id!='' && $section_id!='all')
            {
                $query  =   $query." and a.section_id=".$section_id;
            }
            if($from_date!='' && $to_date!='')
            {
                $query  =   $query." and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . date('Y-m-d',strtotime($from_date)) . "' and '" . date('Y-m-d',strtotime($to_date))."'";
            }
            $query  =   $query." group by a.fee_head_id)";
  //         echo $query;die;
            $data = $this->db->query($query)->result_array();
			//print_r($data);
            return $data;
        }

        
}
