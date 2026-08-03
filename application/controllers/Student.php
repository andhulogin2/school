<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller 
{
	public function student_dashboard()
	{
		$this->load->view('student/student_dashboard.php');
	}
	
	function subject($param1 = '', $param2 = '')
    {
        $yr =   get_running_year();
	 $user_id	= $this->session->userdata('login_user_id');

    	  $student_profile         = $this->db->get_where('student', array('user_id' => $user_id))->row();
		
		
         $student_class_id        = $this->db->get_where('enroll' , array('student_id' => $student_profile->student_id))->row()->class_id;
		
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $student_class_id,
                'year' => $yr
        ))->result_array();
        $this->load->view('student/subject', $page_data);
    }
	
	function my_marks($user_id = '')
	{
    	 $student = $this->db->get_where('student' , array('user_id' => $user_id))->row();

        /*foreach ($student as $row)
        {
        	if($row['student_id'] == $this->session->userdata('login_user_id'))
            {
            	$page_data['student_id'] =   $student_id;
            } 
			else if($row['parent_id'] != $this->session->userdata('login_user_id'))
            {
            	redirect(base_url(), 'refresh');
            }
        }*/
		$class_id     = $this->db->get_where('enroll' , array('student_id' => $student->student_id))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student->student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['class_id']   =   $class_id;
		$page_data['student_id']   =  $student->student_id;
        $this->load->view('student/my_marks', $page_data);
    }
	
	function attendance_report() 
    {
    	$page_data['month']        = date('m');
        $this->load->view('student/attendance_report',$page_data);
    }
	 
	 function attendance_report_selector()
    {
         $data['class_id']   = $this->input->post('class_id');
		 $data['year1']       = $this->input->post('year1');
        $data['year']       = $this->input->post('year');
         $data['month']  = $this->input->post('month');
	  
        $data['section_id'] = $this->input->post('section_id');
		 $data['student_id'] =   $this->input->post('student');
		
		
		//$this->session->userdata('login_user_id');
        redirect(base_url().'index.php/student/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$data['student_id'].'/'.$data['year1'],'refresh');
    }
	
	   function news_view($param1 = '' , $param2 = '')
    {
        
         if ($param1 == 'details') 
        {
            $page_data['room_page'] = 'details';
            $page_data['news_code'] = $param2;
        }
        //$page_data['page_name']   = 'news_overview'; 
        //$page_data['page_title']  = get_phrase('Details');
        $page_data['news']= $this->db->get_where('news',array('news_code'=>$param2))->row()->title;
        $this->load->view('student/news_overview', $page_data);
    }
	
	function report_attendance_view($class_id = '' , $section_id = '', $month = '',$student='',$year1='') 
    {
         
        $class_name = $this->db->get_where('class' , array(
            'class_id' => $class_id
        ))->row()->name;
        $page_data['class_id'] = $class_id;
        $page_data['month']    = $month;
        $section_name = $this->db->get_where('section' , array(
            'section_id' => $section_id
        ))->row()->name;
        $page_data['section_id'] = $section_id;
		$page_data['year1'] = $year1;
		//$this->db->where('user_id',$this->session->userdata('login_user_id'));
	 //  $page_data['student_id']=$this->db->get('student')->row()->student_id;
	   
		$page_data['student_id']=$student;
        $this->load->view('student/report_attendance_view', $page_data);
    }
	  
	function news() 
    {
        $this->load->view('student/news');
    }
	
	function newsroom($param1 = '')
    {
    	$page_data['room_page'] = 'news_overview';
        $page_data['news_code'] = $param1;
        $page_data['page_title'] =$this->db->get_where('news',array('news_code'=>$param1))->row()->title;
        $this->load->view('student/newsroom', $page_data);
    }
	
	function news_message($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'add') 
		{
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php/student/news', 'refresh');
        }
    }
	
	function complaint() 
    {
        $this->load->view('student/complaints');
    }
	
	function teacher_complaints ($param1 = '', $param2 = '', $param3 = '') 
    {
		if ($param1 == 'create')
        {
		
            $this->crud_model->create_report();
            redirect(base_url() . 'index.php/student/complaint/', 'refresh');
        }
	}
	
	function enquiry() 
    {
        $this->load->view('student/enquiry_add');
    }
	
	function add_enquiry ($param1 = '', $param2 = '', $param3 = '') 
    {
		if ($param1 == 'create')
        {
            $this->crud_model->create_enquiry();
            redirect(base_url() . 'index.php/student/enquiry/', 'refresh');
        }
	}
	
	function study_material($task = "", $document_id = "")
    {
		$data['study_material_info']    = $this->crud_model->select_study_material_info_for_student();
        $this->load->view('student/study_material', $data);
    }
	
	function homework($student_id = '')
    {
		$yr =   get_running_year();
		 $user_id	= $this->session->userdata('login_user_id');

    	  $student         = $this->db->get_where('student', array('user_id' => $user_id))->row()->student_id;
		$class_id        = $this->db->get_where('enroll' , array('student_id' =>$student,'year' => $yr))->row()->class_id;
        $page_data['student_id']   = $student;
		$page_data['class_id']=$class_id;
        $this->load->view('student/homework', $page_data);
    }
	
	function homeworkroom($param1 = '' , $param2 = '')
    {
		if ($param1 == 'details') 
		{
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        }
        $this->load->view('student/homework_room',$page_data);
    }
	
	function reset_password() 
    {
	
         $this->load->view('student/reset_password');
		
    }
	 
	 function change_password($student_id)
	 {
	
	  $new_password=$this->input->post('new');
	  $confirm_password=$this->input->post('confirm');
	  if($new_password==$confirm_password)
	  {
	  $data['password']=$confirm_password;
	  $this->db->where('user_id',$student_id);
	  $this->db->update('student',$data);
	   $data1['password']=sha1($confirm_password);
	   $this->db->where('user_id',$student_id);
	  $this->db->update('tbl_users',$data1);
	  }
	  else
	  {
	  ?>
	  <script>alert("Invalid");</script>
	  <?php }
	  redirect('student/reset_password');
	 }
	 
	  function view_hourly_attendance()
	{
		$classes = $this->db->get('class')->result_array();
		$class_hours = $this->db->get('tbl_att_class_timing_details')->result_array();
		$class_timing=$this->Hourly_attendance_model->get_class_hours();
		$page_data['classes']=$classes;
		$page_data['class_timing']=$class_hours;
		
		$this->load->view('student/view_hourly_attendance',$page_data);
	}
	
	public function view_attendance_list($from_date='',$to_date='')
	{
	   $page_data['from_date']=$from_date;
	   $page_data['to_date']=$to_date;
	   $branch_id=$this->session->userdata('branch_id');
	   $page_data['class_timing']=$this->Hourly_attendance_model->get_class_hours($branch_id);
	   
	   $this->db->where('user_id',$this->session->userdata('login_user_id'));
	   $student_id=$this->db->get('student')->row()->student_id;
	   
	   $this->db->where('student_id' , $student_id );
	   $this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
	   $this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));

	   $query = $this->db->get('view_att_attendance_details_tabular');
	   $students =  $query->result_array();
	   $page_data['students']=$students;

	  
		$this->load->view('student/view_hourly_attendance_1',$page_data);
	}
	
	
	public function get_time_table()   // for ajax calling
	{
	$branch_id=$this->session->userdata('branch_id');
	
	$working_days=$this->Hourly_attendance_model->get_working_days($branch_id);
	$class_timing=$this->Hourly_attendance_model->get_class_hours($branch_id);
	
	 $this->db->where('user_id',$this->session->userdata('login_user_id'));
	 $student_id=$this->db->get('student')->row()->student_id;
	 $this->db->where('student_id',$student_id);
	 $section_id=$this->db->get('enroll')->row()->section_id;
	
	$page_data['section_id']=$section_id;
	$page_data['class_timing']=$class_timing;
	

		$this->db->where('section_id',$section_id);
	    $time_table = $this->db->get('view_att_time_table_tabular')->result_array();
		$page_data['time_table']=$time_table;
		
	$this->load->view('student/show_class_time_table',$page_data);
	}
	function view_message()
	{
       	$student_login_id = $this->session->userdata('login_user_id');
		$student_id	      = $this->db->get_where('student' , array('user_id' => $student_login_id))->row()->student_id;
		$this->db->order_by("date_time","desc");
		$this->db->where('to_student_id',$student_id);
		$data['message_data'] = $this->db->get('tbl_teacher_student_message')->result_array();;
		$this->load->view('student/view_messages',$data);
	}

	function view_single_message()
	{
		date_default_timezone_set("Asia/Kolkata");
 		$message_id = $this->uri->segment(3);
		$this->db->where('message_id',$message_id);
		$message = $this->db->get('tbl_teacher_student_message')->result_array();
        $data['message_data'] = $message;
		foreach($message as $m)
		if($m['viewed']=='N')
		{
			$data_view=array(
			'viewed' 			=> 'Y',
			'viewed_date_time' 	=> date('Y/m/d H:i:s')
			);
		$this->db->where('message_id',$message_id);
		$this->db->update('tbl_teacher_student_message',$data_view);
		}
		$this->load->view('student/view_single_messages',$data);
	}
	

}
