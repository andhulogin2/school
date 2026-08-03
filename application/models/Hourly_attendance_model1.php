<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Hourly_attendance_model extends CI_Model {
	
function __construct()
{  parent :: __construct();  }


	function insert_holidays($data)
       {
			$this->db->insert('tbl_att_holiday_master',$data);
       }
  	   
	 function delete_holidays($day='',$academic_year_id='',$branch_id='')
	 {
		     $this->db->where('date',$day);
			 $this->db->where('academic_year_id',$academic_year_id);
			 $this->db->where('branch_id',$branch_id);
      		 $this->db->delete('tbl_att_holiday_master');
     }
	 
	  function edit_enquiry($enquiry_id)
	 {
        $this->db->where('enquiry_id', $enquiry_id);
        $r=$this->db->get('tbl_enquiry_master');
		return $r->result();
	 } 
	  function edit_enquiry1($enquiry_id)
	 {
	    $this->db->where('enquiry_id', $enquiry_id);
		$t=$this->db->get('tbl_enquiry_exam_passed');
		return $t->result();
	 }
	function get_working_days($branch_id='')
	{
	 $this->db->where('branch_id',$branch_id);
	 $this->db->where('is_working_day', 'Y');
	 $working_days = $this->db->get('tbl_att_week_days')->result_array();
	 return $working_days;
	}
	
	function get_class_timing($academic_year='',$branch_id='')
	{
		$this->db->where('academic_year', $academic_year);
		$this->db->where('branch_id', $branch_id);
		$class_timing = $this->db->get('tbl_att_class_timing_details')->result_array();
		return $class_timing;
	}

	function get_class_hours($branch_id='')
	{
	 $this->db->where('branch_id',$branch_id);
	 $this->db->where('class_timing_master_id', '1');
	  $this->db->where('is_active', 'Y');
	 $class_hours = $this->db->get('tbl_att_class_timing_details')->result_array();
	 return $class_hours;
	}

	function get_class_wise_subjects($class_id='')
	{
		$this->db->where('class_id', $class_id);
		$subjects = $this->db->get('subject')->result_array();
		return $subjects;
	}
	function get_absent($att_date='',$student_id='')
	{
	  
	    $this->db->where('student_id', $student_id);
		$this->db->where('att_date',date('Y-m-d',strtotime($att_date)));
		$this->db->where('attendance_status','2');
		$absent_data = $this->db->get('view_att_houlry_attendance_details')->result_array();
		return $absent_data;
	}
	function get_all_absent($att_date='')
	{
	
		$this->db->where('att_date',date('Y-m-d',strtotime($att_date)));
		$this->db->where('attendance_status','2');
		$absent_data = $this->db->get('view_att_houlry_attendance_details')->result_array();
		return $absent_data;
	}
	function get_total_working_days($branch_id,$dept_id,$class_id,$section_id,$from_date,$to_date)
	{
	    $this->db->select('att_date,student_id,count(att_date) as count_date');
		$this->db->group_by('att_date');
		$this->db->group_by('student_id');
		$this->db->from('view_att_houlry_attendance_details');
	    $this->db->where('branch_id',$branch_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		
		$working_days = $this->db->get()->row();
		return $working_days->count_date;
	   
	}
	function get_total_hours($branch_id,$class_id,$section_id,$from_date,$to_date,$category,$category_id)
	{
	    
	    $this->db->select('att_date,count(class_timing_details_id) as count_total_hour');
		$this->db->from('view_att_houlry_attendance_details');
	    $this->db->where('branch_id',$branch_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		if($category=="2")
		{
		 $this->db->where('class_timing_details_id',$category_id); 
		 $this->db->group_by('att_date');
		}
		elseif($category=="3")
		{
		 $this->db->where('subject_id',$category_id);
		$this->db->group_by('student_id'); 
		}
		if($category=="1")
		{
		 $this->db->group_by('student_id');
		}
		$working_hours = $this->db->get()->row();
		return $working_hours->count_total_hour;
	}
	function get_hours($branch_id)
	{
	    $this->db->select('count(class_timing_details_id) as count_hours');
		$this->db->from('tbl_att_class_timing_details');
	    $this->db->where('branch_id',$branch_id);
		$this->db->where('is_active','Y');
		
		$class_hours = $this->db->get()->row();
		return $class_hours->count_hours;
	}
	function get_total_present($branch_id,$class_id,$section_id,$from_date,$to_date,$total_hours,$category,$category_id)
	{
	    
	    
	    $this->db->select('student_id,student_name,count(attendance_status) as total_present, count(attendance_status) / '.$total_hours . ' * 100  as percentage');
		$this->db->group_by('student_id');
		$this->db->from('view_att_houlry_attendance_details');
	    $this->db->where('branch_id',$branch_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('attendance_status','1');
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		
		if($category=='2')
		{
		 $this->db->where('class_timing_details_id',$category_id);
		
		}
		elseif($category=='3')
		{
		 $this->db->where('subject_id',$category_id); 
		}
		
		
		$total_present = $this->db->get()->result_array();
		
		return $total_present;
	}


}