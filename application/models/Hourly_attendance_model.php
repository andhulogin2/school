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
  	   
	 function delete_holidays($day='',$academic_year='',$branch_id='')
	 {
		     $this->db->where('date',$day);
			 $this->db->where('academic_year',$academic_year);
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
	 $year   =   get_running_year();
	 $this->db->where('branch_id',$branch_id);
	 $this->db->where('is_working_day', 'Y');
	 $this->db->where('academic_year',$year);
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
	 $year   =   get_running_year();
	 $this->db->where('branch_id',$branch_id);
	 $this->db->where('class_timing_master_id', '1');
	 $this->db->where('is_active', 'Y');
	 $this->db->where('academic_year',$year);
	 $class_hours = $this->db->get('tbl_att_class_timing_details')->result_array();
	 return $class_hours;
	}

	function get_class_wise_subjects($class_id='')
	{
		$this->db->where('class_id', $class_id);
		$subjects = $this->db->get('subject')->result_array();
		return $subjects;
	}
	function get_absent($student_id='',$att_date='')
	{
	   $this->db->where('student_id',$student_id);
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
	    $this->db->select('att_date');
		//$this->db->group_by('att_date');
		//$this->db->group_by('student_id');
		//$this->db->group_by('students_houlry_attendance_masters_id');
		//$this->db->group_by('class_timing_details_id');
		$this->db->from('tbl_att_students_houlry_attendance_master');
	    $this->db->where('branch_id',$branch_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		
		$working_days = $this->db->get()->result_array();
		return count($working_days);
		
	   
	}
	function get_total_hours($branch_id,$class_id,$section_id,$from_date,$to_date,$category,$category_id)
	{
	    
	    $this->db->select('class_timing_details_id');
		$this->db->from('view_att_houlry_attendance_details');
	    $this->db->where('branch_id',$branch_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		// $this->db->group_by('class_timing_details_id');
		 $this->db->group_by('class_timing_details_id'); 
		
		if($from_date==$to_date)
		{
		
		$this->db->where('att_date=',date('Y-m-d',strtotime($from_date)));
		}
		else
		{
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		$this->db->group_by('att_date'); 
		}
		if($category=="2")
		{
		 $this->db->where('class_timing_details_id',$category_id); 
		}
		elseif($category=="3")
		{
		 $this->db->where('subject_id',$category_id);
		}
		
		
		
		$working_hours = $this->db->get()->result_array();
		return count($working_hours);
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
	    
	    
	    $this->db->select('student_id,student_name,count(attendance_status) as total_present, count(attendance_status) / '.$total_hours . ' * 100  as percentage,subject_id,subject_name');
		$this->db->group_by('student_id');
		
		if($category=='5')
		{
		// $this->db->group_by('class_timing_details_id');
		// $this->db->group_by('subject_id');
		}
		
		$this->db->from('view_att_houlry_attendance_details');
	  //  $this->db->where('branch_id',$branch_id);
	//	$this->db->where('class_id',$class_id);
		//$this->db->where('section_id',$section_id);
		
		$this->db->where('branch_id='. $branch_id .' and class_id=' . $class_id . ' and section_id=' .$section_id);
		$this->db->where('( attendance_status=1 or attendance_status=3)');
		//$this->db->or_where('attendance_status','3');
		if($from_date==$to_date)
		{
		$this->db->where('att_date=',date('Y-m-d',strtotime($from_date)));
		}
		else
		{
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		}
		
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
	
	
	function show_attendance_summary($data)
	{
		$this->db->select("a.branch_id,a.dept_id,a.class_id,a.section_id,sum(case when a.status='1' then 1 else 0 end) as present_count,sum(case when a.status='2' then 1 else 0 end) as absent_count,sum(case when a.status='3' then 1 else 0 end) as late_count,sum(case when a.status='4' then 1 else 0 end) as no_diary_count,sum(case when a.status='5' then 1 else 0 end) as half_day_count,b.name as class_name,c.name as section_name,d.branch_name,e.dept_name");
		$this->db->where('a.branch_id',$data['branch_id']);
		$this->db->where('a.dept_id',$data['dept_id']);
		$this->db->where('a.timestamp',$data['date']);
		$this->db->where('a.year',$data['year']);
		$this->db->group_by('a.class_id');
		$this->db->group_by('a.section_id');
		$this->db->join('class b','b.class_id=a.class_id');
		$this->db->join('section c','c.section_id=a.section_id');
		$this->db->join('tbl_branch d','d.branch_id=a.branch_id');
		$this->db->join('tbl_department e','e.dept_id=a.dept_id');
		$this->db->order_by('b.name');
		$this->db->order_by('c.name');
		$result	=	$this->db->get('attendance a')->result_array();
		return $result;
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
	}


}