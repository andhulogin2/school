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
        if ($this->session->userdata('student_login') != 1)
            redirect(base_url(), 'refresh');
        
        $student_profile         = $this->db->get_where('student', array(
            'student_id' => $this->session->userdata('student_id')
        ))->row();
        $yr=get_running_year();
        $student_class_id        = $this->db->get_where('enroll' , array(
            'student_id' => $student_profile->student_id,
                'year' => $yr
        ))->row()->class_id;
        $page_data['subjects']   = $this->db->get_where('subject', array(
            'class_id' => $student_class_id,
                'year' => $yr
        ))->result_array();
        $this->load->view('student/subject', $page_data);
    }
	
	function my_marks($student_id = '')
	{
    	$student = $this->db->get_where('student' , array('student_id' => $student_id))->result_array();
        foreach ($student as $row)
        {
        	if($row['student_id'] == $this->session->userdata('login_user_id'))
            {
            	$page_data['student_id'] =   $student_id;
            } 
			else if($row['parent_id'] != $this->session->userdata('login_user_id'))
            {
            	redirect(base_url(), 'refresh');
            }
        }
        $yr=get_running_year();
		$class_id     = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $yr))->row()->class_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $page_data['class_id']   =   $class_id;
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
        $data['year']       = $this->input->post('year');
        $data['month']  = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
		$data['student_id'] =  $this->session->userdata('login_user_id');
        redirect(base_url().'index.php/student/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$data['student_id'],'refresh');
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
	
	function report_attendance_view($class_id = '' , $section_id = '', $month = '') 
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
		$stud=$this->session->userdata('student_id');
                $yr=get_running_year();
		$class_id        = $this->db->get_where('enroll' , array('student_id' =>$stud,'year' => $yr))->row()->class_id;
        $page_data['student_id']   = $student_id;
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
	  {?>
	  <script>alert("Invalid")</script>
	  <?php }
	  redirect('student/reset_password');
	 }
	

}
