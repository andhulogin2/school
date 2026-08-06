<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Class_teacher extends CI_Controller 
{
	public function class_teacher_dashboard()
	{
		$this->load->view('class_teacher/class_teacher_dashboard.php');
	}
	
	function subject($param1 = '', $param2 = '' , $param3 = '')
    {
		$page_data['class_id']   = $param1;
        $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $param1))->result_array();
        //$page_data['page_name']  = 'coursess';
        //$page_data['page_title'] = get_phrase('Manage-Subjects');
        $this->load->view('teacher/subjects', $page_data);
    }
	
	
	 function student_portal($student_id)
    {
        $yr =   get_running_year();
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $yr
        ))->row()->class_id;

		$section_id     = $this->db->get_where('enroll' , array(
		'student_id' => $student_id , 'year' => $yr
		))->row()->section_id;

        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $system = $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
   		$page_data['student_portal_model']=$this->crud_model->student_portal_data($student_id);
		//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');

        $monthly_attendance = $this->crud_model->get_attendance_monthly($student_id);

      
        $page_data['student_id']  =  $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['section_id']  =   $section_id;
        $page_data['monthly_attendance']   =   $monthly_attendance;

       $this->load->view('class_teacher/student_portal.php',$page_data);
    }
	function marks_selector()
    {
        //die();
        
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
		$data['exam_id']    = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
		$data['comment'] = $this->input->post('remarks');
        $data['year']       = get_running_year();
        $query = $this->db->get_where('mark' , array(
                    
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
							'exam_id' => $data['exam_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']));
									
		$query1 = $this->db->get_where('enroll' , array(
                    
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                    'year' => $data['year']));
        //echo $query->num_rows()."<br>".$query1->num_rows();die();                            
      //  if($query->num_rows() < 1) 
	  if($query->num_rows() < $query1->num_rows()) 
        {
              $yr=get_running_year();
            $this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$data['class_id']);
		$this->db->where('e.year',$yr);
		$this->db->where('e.section_id',$data['section_id']);
		$this->crud_model->check_student_status();
		$student=$this->db->get()->result_array();
		
            foreach($student as $row) 
            {
                $data['student_id'] = $row['student_id'];
				$dat = $this->db->get_where('mark' , array( 'class_id' => $data['class_id'],'section_id' => $data['section_id'],'exam_id' => $data['exam_id'],
                       'subject_id' => $data['subject_id'],'year' => $data['year'],'student_id' =>$data['student_id']));
				if($dat->num_rows()<1){
                $this->db->insert('mark' , $data);
				}
            }
        }
        redirect(base_url() . 'index.php/Class_teacher/marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'] , 'refresh');
    }
	function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('teacher/marks_get_subject' , $page_data);
    }
	
	function marks_upload($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '', $remarks = '')
    {
       
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
		 $page_data['remarks'] =  $remarks;
        //$page_data['page_name']  =   'marks_upload';
        //$page_data['page_title'] = get_phrase('Upload-Marks');
        $this->load->view('class_teacher/marks_upload', $page_data);
    }
	
	function marks_update($class_id = '' ,$section_id = '' ,$exam_id = '',$subject_id)
    {
        $running_year = get_running_year();
        $marks_of_students = $this->db->get_where('mark' , array(
        'exam_id' => $exam_id, 
		'class_id' => $class_id,
        'section_id' => $section_id, 'year' => $running_year,
        'subject_id' => $subject_id))->result_array();
			//echo $this->db->last_query();
	        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $mark_total= $this->input->post('mark_total_'.$row['mark_id']);
             $grade1= $this->input->post('grade_value_'.$row['mark_id']);
			 $comnt= $this->input->post('comment');
	         $position1= $this->input->post('position_value_'.$row['mark_id']);
			 //echo $obtained_marks;
			 
			  if($grade1=="" && $position1 == "")
				{
				  $average = (($obtained_marks /  $mark_total) * 100);
				  $p=$this->db->get('grade')->result_array();
				  foreach($p as $res){
													
				    if($average >=$res['minimum_range'] and $average <=$res['maximum_range']){
				       $grade = $res['grade'];
					   $position = $res['position'];
					}
				  }
				}
				else
				{
				 $grade = $grade1;
				 $position = $position1;
				}
			 
			 
           if($comnt ==""){
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position));
			}
		   else{
		     $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position, 'comment' =>$comnt));
			}
        }
        redirect(base_url().'index.php/class_teacher/marks_upload/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');
    }
	
	function marks_update1($class_id = '' ,$section_id = '' ,$exam_id = '',$subject_id)
    {
        $running_year = get_running_year();
        $marks_of_students = $this->db->get_where('mark' , array(
        'exam_id' => $exam_id, 
		'class_id' => $class_id,
        'section_id' => $section_id, 'year' => $running_year,
        'subject_id' => $subject_id))->result_array();
			//echo $this->db->last_query();
	        foreach($marks_of_students as $row) {
            $obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
            $mark_total= $this->input->post('mark_total_'.$row['mark_id']);
             $grade1= $this->input->post('grade_value_'.$row['mark_id']);
			 $comnt= $this->input->post('comment');
	         $position1= $this->input->post('position_value_'.$row['mark_id']);
			 //echo $obtained_marks;
			 
			  if($grade1=="" && $position1 == "")
				{
				  $average = (($obtained_marks /  $mark_total) * 100);
				  $p=$this->db->get('grade')->result_array();
				  foreach($p as $res){
													
				    if($average >=$res['minimum_range'] and $average <=$res['maximum_range']){
				       $grade = $res['grade'];
					   $position = $res['position'];
					}
				  }
				}
				else
				{
				 $grade = $grade1;
				 $position = $position1;
				}
			 
			 
           if($comnt ==""){
            $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position));
			}
		   else{
		     $this->db->where('mark_id' , $row['mark_id']);
            $this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position, 'comment' =>$comnt));
			}
        }
        redirect(base_url().'index.php/teacher/marks_upload/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');
    }
	function get_grade($g)
     {
	 
        $sections = $this->db->get_where('mark' , array('id' => $g
        ))->result_array();
        foreach ($sections as $row) {
        echo  $row['exam_id'] ;
        }
    }
	
	function tab_sheet($class_id = '' ,$section_id= '' ,$exam_id = '' ) {
        
        
        if ($this->input->post('operation') == 'selection') {
		    $page_data['class_id']   = $this->input->post('class_id');
			 $page_data['section_id']   = $this->input->post('section_id');
            $page_data['exam_id']    = $this->input->post('exam_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php/class_teacher/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
            } else {
                redirect(base_url() . 'index.php/class_teacher/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section_id;
       
        $this->load->view('class_teacher/tab_sheet', $page_data);
    
    }
	
	public function mark_print_report($class_id,$section_id,$exam_id)
	{
		

		
		
		
		$condition = " where  class_id=". $class_id. " and section_id=". $section_id;
		$sql = "select student_id from enroll " . $condition ;
	
		$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		if (isset($_POST['chk_excel']))
		{
									ob_start();
									ob_get_clean();
									$total = 0;
									$i=1;

								   $dataToExports = [];
								   echo  "Students List\n";
								if ($class_id!='ALL')   echo  "\tClass  \t" . get_class_name($class_id). "\n";
								if ($section_id!='ALL')	echo  "\tSection/Batch  \t" . get_section_name($section_id ). "\n\n\n";
								if ($exam_id!='ALL')	echo  "\tExam/Batch  \t" . get_exam_name($exam_id ). "\n\n\n";

								foreach ($query_result as $data)
								{
									$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Name'] 		= get_student_name($data['student_id']);
									$this->db->select('distinct(m.student_id) as student,m.mark_obtained,m.position,m.mark_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$class_id);
									$this->db->where('m.section_id',$section_id);
									$this->db->where('m.exam_id',$exam_id);
									$this->db->where('m.student_id',$data['student_id']);
									
									$q=$this->db->get()->result_array();
									
									foreach($q as $v){
					
									$arrangeData[$v['subject']] 		= $v['mark_obtained'].'/'.$v['mark_total'];
									
									}
									$i=$i+1;
									
									$dataToExports[]			= $arrangeData;
									}
									
									
							// set header
								$filename = "Students_Mark_List.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								$this->exportExcelData($dataToExports);
								die();
								}
							

		/////////////////////////////////
		
		//$page_data['class_id']         = $class_id ;
//		$page_data['section_id']       = $section_id;
//		$page_data['title']            = "Students List";
//		$page_data['page_name']        = 'print_students_list1';
//        $page_data['page_title']       = 'Students List';
//		$page_data['query_result']	   = $query_result;
//		$this->load->view('backend/index', $page_data);
	}
	
	public function exportExcelData($records)
{
  $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    // display field/column names as a first row
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", ($row)) . "\n";
            }
 }
 
 function tab_sheet_print($class_id ,$section_id, $exam_id) {
        
        $page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;

        $page_data['exam_id']  = $exam_id;
        $this->load->view('teacher/tab_sheet_print' , $page_data);
    }
	
	function subject_message($class,$section, $exam, $grade, $position, $remark){
		 
		$this->crud_model->subject_message($class,$section, $exam,  $grade, $position, $remark);
		
		
	}
	function subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark){
		
		$this->crud_model->subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark);
		
	}
	
	function get_report($class_id,$teacher_id='')
    {
        $page_data['class_id'] 		=	$class_id;
        $page_data['teacher_id'] 	= 	$teacher_id;
        $this->load->view('class_teacher/get_report' , $page_data);
    }
	
	function get_report_class($class_id,$teacher_id='')
    {
        $page_data['class_id'] 		=	$class_id;
        $page_data['teacher_id'] 	= 	$teacher_id;
        $this->load->view('class_teacher/get_report_class' , $page_data);
    }
	
	function homework_add() 
    {   
                $yr=get_running_year();
		$admin=$this->session->userdata('login_user_id'); 
		$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
		$this->db->select('c.class_id,c.name as class_name');
		$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('st.teacher_id',$teacher_id);
		$this->db->where('c.academic_year',$yr);
		$this->db->join('subject_teacher st','c.class_id=st.class_id','LEFT');
		$this->db->group_by('c.class_id');
		$this->db->order_by('c.name','ASC');
		$data['class']=$this->db->get_where('class c')->result_array();
 
        
        $this->load->view('class_teacher/homework_add',$data);
    }
	
	function homework($param1 = '', $param2 = '') 
    {
        if ($param1 == 'create') 
        {
            $homework_code = $this->crud_model->homework_create();
            redirect(base_url() . 'index.php/class_teacher/homeworkroom/details/' . $homework_code , 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud_model->update_homework($param2);
            redirect(base_url() . 'index.php/class_teacher/homeworkroom_edit/edit/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete'){
            $this->crud_model->delete_homework($param2);
            redirect(base_url() . 'index.php/class_teacher/homework', 'refresh');
        }

        //$page_data['page_name'] = 'homework';
        //$page_data['page_title'] = get_phrase('Homework');
        $this->load->view('class_teacher/homework');
    }
	function homeworkroom($param1 = '' , $param2 = '')
    {
        if ($param1 == 'file') 
        {
            $page_data['room_page']    = 'homework_file';
            $page_data['homework_code'] = $param2;
        }  
        else if ($param1 == 'details') {
            $page_data['room_page'] = 'homework_details';
            $page_data['homework_code'] = $param2;
        }
        else if ($param1 == 'edit') 
        {
            $page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }

        //$page_data['page_name']   = 'homework_room'; 
        //$page_data['page_title']  = get_phrase('Homework');
        $page_data['page_title']=$this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
        $this->load->view('class_teacher/homework_room', $page_data);
    }
	
	function homeworkroom_edit($param1 = '' , $param2 = '')
    {
        
         if ($param1 == 'edit') 
        {
          //$page_data['room_page'] = 'homework_edit';
            $page_data['homework_code'] = $param2;
        }

        //$page_data['page_name']   = 'homework_room'; 
        //$page_data['page_title']  = get_phrase('Homework');
        $page_data['page_title']=$this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
        $this->load->view('class_teacher/homework_edit', $page_data);
    }
	
	public function daily_attendance()
	{
		$user_id	=	$this->session->userdata('login_user_id'); 
		$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$running_year	=	get_running_year();
		$this->db->select('c.class_id,c.name as class_name');
		$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('c.academic_year',$running_year);
		$this->db->where('sec.teacher_id',$teacher_id);
		$this->db->join('section sec','sec.class_id=c.class_id','LEFT');
		$this->db->group_by('c.class_id');
				
		$data['class']=$this->db->get_where('class c')->result_array();
		$this->load->view('class_teacher/daily_attendance.php',$data);
	}
	
	function attendance_selector()
    {
		$data['branch_id']	=	$this->session->userdata('branch_id');
		$data['dept_id']	=	$this->session->userdata('dept_id');
        $data['class_id']   = $this->input->post('class_id');
		
        $data['year']       = $this->input->post('year');
        //$data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
		$a=$this->input->post('timestamp');
        $b  = str_replace('/','-',$a);//echo $b;die();
		$data['timestamp']=strtotime($b);
		//echo $data['class_id'];
		////$data['section_id'];
		//$data['timestamp'];
		//die();
		
        $query = $this->db->get_where('attendance' ,array(
          'branch_id'=>$data['branch_id'],
		   'dept_id'=>$data['dept_id'], 
            'class_id'=>$data['class_id'],
                'section_id'=>$data['section_id'],
                    'year'=>$data['year'],
                        'timestamp'=>$data['timestamp']));//echo $this->db->last_query();die();
        if($query->num_rows() < 1) 
        {
            $yr=get_running_year();
            $this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$data['class_id']);
		$this->db->where('e.year',$yr);
		$this->db->where('e.section_id',$data['section_id']);
		$this->crud_model->check_student_status();
		$students=$this->db->get()->result_array();
            foreach($students as $row) {
                $attn_data['branch_id']  = $data['branch_id'];
                $attn_data['dept_id']    = $data['dept_id'];
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
     redirect(base_url().'index.php/Class_teacher/manage_attendance/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
  // manage_attendance($data['class_id'],$data['section_id'],$data['timestamp']);
    }
	
	function manage_attendance($class_id = '' , $section_id = '' , $timestamp = '')
	{
	
	//$class_name = $this->db->get_where('student')
      //->row()->name;
        //$page_data['class_id'] = $class_id;
        $data['timestamp'] = $timestamp;
		$data['class_id']  = $class_id;
		$data['section_id'] = $section_id;
		
       // $page_data['page_name'] = 'full_manage_attendance';
        //$section_name = $this->db->get_where('section' , array(
            //'section_id' => $section_id
       // ))->row()->name;
        //$page_data['section_id'] = $section_id;

	
		$this->load->view('class_teacher/manage_attendance',$data);
	}
	function get_section($class_id) 
    {
          $page_data['class_id'] = $class_id; 
          $this->load->view('teacher/section_holder' , $page_data);
    }
	
	function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
	     $date=$this->input->post('timestamp1');
		
         $running_year = get_running_year();
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp))->result_array();
			$late_notification = null === $this->input->post('late_notification') ? 0 : 1;
			$absent_notification= null === $this->input->post('absent_notification') ? 0 : 1;
			$diary_notification= null === $this->input->post('no_diary_notification') ? 0 : 1;
			 $message1= $this->input->post('message');
			 
			$sms = $this->db->get('sms_settings')->row();
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
        foreach($attendance_of_students as $row) {
			
			$notification = 0;
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
			$late = $this->input->post('late_'.$row['attendance_id']);		
			if( 1 == $absent_notification && 2 == $attendance_status ){
				$notification = 1;
				$msg = " is absent on ".$date;
			}
			if( 1 == $late_notification && 3 == $attendance_status ){
				$notification = 1;
				$msg = " is".$late."late on ".$date;
			}
			if( 1 == $late_notification && 4 == $attendance_status ){
				$notification = 1;
				$msg = "has no Diary on ".$date;
			}
			 if($notification =='1' &&  $message1==''){
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
			$phone2  = $stu->phone2;
				//$atn=$this->input->post('message');
				$name  = $stu->name;
			  $message = $name. " ".$msg;
			 
			
			if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First') {

			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($common." ". $message).'&route=T';
			  }
    else if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == '') {
 $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode(" ". $message." ".$common).'&route=T';
               }
		$api = $url;
		
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		
		if($balance >= 0){
			
			$api."/sendsms?".$location;
			$send = fopen($api."/sendsms?".$location,"r");
			//var_dump($message);
			
			// echo $api."/sendsms?".$location;
			// echo "<br />";
			 $return_message_ids = stream_get_contents($send);
			//var_dump($return_message_ids);
			//die;
			$message_id_array = explode($return_message_ids); 
			/* $message_id_array is the array which contains the message IDs */
			/* You can save it to database */
			
			}
			}
			if($notification =='1' &&  $message1!=''){
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
			$phone2  = $stu->phone2;
				$atn=$this->input->post('message');
				$name  = $stu->name;
			  $message = $name. " ".$msg. " ".$atn;
			  
			 
			  if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First') {

			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($common." ". $message).'&route=T';
			  }
    else if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == '') {
 $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode(" ". $message." ".$common).'&route=T';
               }
		$api = $url;
		
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		
		if($balance >= 0){
			
			$api."/sendsms?".$location;
			$send = fopen($api."/sendsms?".$location,"r");
			//var_dump($message);
			
			// echo $api."/sendsms?".$location;
			// echo "<br />";
			 $return_message_ids = stream_get_contents($send);
			//var_dump($return_message_ids);
			//die;
			$message_id_array = explode($return_message_ids); 
			/* $message_id_array is the array which contains the message IDs */
			/* You can save it to database */
			
			}
			  }
			 
        
	     
			
			
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status,'late_time'=>$late));
        }
		//$this->db->insert('attendance_message',$message1);
        redirect(base_url().'index.php/Class_teacher/manage_attendance/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }
	
	public function attendance_report()
	{
		$user_id	=	$this->session->userdata('login_user_id'); 
		$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$running_year	=	get_running_year();
		$this->db->select('c.class_id,c.name as class_name');
		$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('c.academic_year',$running_year);
		$this->db->where('sec.teacher_id',$teacher_id);
		$this->db->join('section sec','sec.class_id=c.class_id','LEFT');
		$this->db->group_by('c.class_id');
		
		$data['class']=$this->db->get_where('class c')->result_array();
		
		$data['month']        = date('m');
		
		$this->load->view('class_teacher/attendance_report.php',$data);
	}
	
	function attendance_report_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month'] 	    = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
		
        redirect(base_url().'index.php/class_teacher/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$data['year'],'refresh');
    }
	
	 function report_attendance_view($class_id = '' , $section_id = '', $month = '',$year='') 
     {
         
        $data['class_id'] 	= $class_id;
        $data['month']    	= $month;
        $data['section_id'] = $section_id; 
		$data['year1'] 	= $year;
        $this->load->view('class_teacher/report_attendance_view.php',$data);
     }
	
	function attendance_print($class_id ,$section_id ,$month) {
        $page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
         $page_data['month'] =$month;
        
        $this->load->view('class_teacher/attendance_print' , $page_data);
    }
	
	function attendance_messages($class_id,$section_id,$student_id,$present,$total,$percentage,$month)
    {

        $running_year = get_running_year();
       // echo $student_id;
        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
		//echo $student_name;
           // $data['username']           = $this->input->post('username');
        $phone1 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone1;
       $phone2 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone2;

		 //echo $student_phone;
            $percentage            = $percentage;
			//$present=$;
			$month=$month;
			//echo $month;
			if($month==1)
				{
				 $month="January";
				 }
				 else if($month==2)
				 {
				   $month="February";
				}
				else if($month==3)
				{
				 $month="March";
				}
				else if($month==4)
				{
				 $month="April";
				}
				else if($month==5)
				{
				  $month= "May";
				}
				else if($month==6)
				{
				 $month="June";
				}
				else if($month==7)
				{
				  $month="July";
				}
				else if($month==8)
				{
				  $month="Augest";
				}
				else if($month==9)
				{
				  $month="September";
				}
				else if($month==10)
				{
				 $month="October";
				}
				else if($month==11)
				{
				 $month="November";
				}
				else if($month==12)
				{
				  $month="December";
				}
			//echo $percentage;
           //echo $percentage;
           // $data['password']       = sha1($this->input->post('password'));
			 
			  
			  $sms = $this->db->get('sms_settings')->row();
			  //echo $sms;
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
			  $web_url=$sms->web_url;
             if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
			  $message = $common."Attendance Report - ".$month. ", Name : ".$student_name.", Working Days : ".$total.", Present : " .$present.", Percentage : ".$percentage.".";
			  }
			  else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
			   $message = "Attendance Report - ".$month. ", Name : ".$student_name.", Working Days : ".$total.", Present : " .$present.", Percentage : ".$percentage.".".$common;
			   }			 
			    $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		//echo $location;
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		
		if($balance >= 0){
			
			$api."/sendsms?".$location;
			
			$send = fopen($api."/sendsms?".$location,"r");
			 
			//var_dump($send);
			
			// echo $api."/sendsms?".$location;
			// echo "<br />";
			$return_message_ids = stream_get_contents($send);
			//var_dump($return_message_ids);
			//die;
			$message_id_array = explode($return_message_ids); 
			/* $message_id_array is the array which contains the message IDs */
			/* You can save it to database */
			
			
	      
		  
        }
       
          //echo $message;
           redirect(base_url() . 'index.php/class_teacher/attendance_report/','refresh');

		 
		 
    }
	
	function study_material($task = "", $document_id = "")
    {
        
        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            redirect(base_url() . 'index.php/Class_teacher/study_material' , 'refresh');
        }
        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            redirect(base_url() . 'index.php/Class_teacher/study_material' , 'refresh');
        }
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(base_url() . 'index.php/Class_teacher/study_material');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        //$data['page_name']              = 'study_material';
        //$data['page_title']             = get_phrase('Study-Material');
        $this->load->view('class_teacher/study_material', $data);
    }
	
	public function study_material_edit($id)
	{
	$data['id']=$id;
	
	$admin=$this->session->userdata('login_user_id'); 
    $teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
   $this->db->select('s.class_id,c.name as class_name,s.subject_id,s.name as subject_name');
   $this->db->where('s.teacher_id',$teacher_id);
   $this->db->join('class c','c.class_id=s.class_id','LEFT');
	$data['class_info']=$this->db->get_where('subject s')->result_array();
      
$this->load->view('class_teacher/study_material_edit.php',$data);    }
	
	function study_material_add()
    {
     
        $this->load->view('class_teacher/modal_study_material_add.php');
    }
	function get_class_subject($class_id) 
    {
        $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) 
        {
            
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
           
        }
    }
	
	function message()
    {
	    $user_id = $this->session->userdata('login_user_id');
		$this->db->select('e.section_id,e.name as section_name,c.class_id,c.name as class_name');
		$this->db->from('staff s');
		$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->where('s.user_id',$user_id);
		$data['class']=$this->db->get()->result_array();
        
        $this->load->view('class_teacher/message',$data);
    }
	
	
	function new_private_message() {
	    $class =$this->input->post('class');
		//echo $class;
	   $section = $this->input->post('section');
					//echo $section;
	    $content = $this->input->post('message');
		//echo $content;
     	     $student_id =  $this->db->get_where('enroll' , array('class_id' => $class,'section_id' =>$section))->result_array();
			 foreach($student_id as $row)
			 {
			     //echo $row['student_id'];
				   $stu= $this->db->get_where('student' , array('student_id' =>$row['student_id']))->result_array();
				   foreach($stu as $v){
				  $phone1= $v['phone1'];
				  $phone2= $v['phone2'];

				  $student_name= $v['name'];      
	
				  
    
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $url = $sms->url;
       
       
            
            //$reciever = $ph;
          
		 // echo $reciever;
		  
		
             //$message=$common. " Hi ".$student_name." ".$content;  
			 //echo $message; 
          
            $message= " Hi ".$student_name." ".$content." "; 
			 $message1= $content." "; 
		     if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
					   { 
		   if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
		                 $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message . " " . $common) . '&route=T';}
			else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
			 
            $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common." ".$message . ".") . '&route=T';}
			}
			else
			{
			 if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
		                 $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message1 . " " . $common) . '&route=T';}
			else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
			 
            $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common." ".$message1 . ".") . '&route=T';}
			}
		 // var_dump($location);
		 // die();
          $api = $url;

            $handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
            $balance = stream_get_contents($handle);


            if ($balance >= 0) {

                $api . "/sendsms?" . $location;
                $send = fopen($api . "/sendsms?" . $location, "r");
                $api . "/sendsms?" . $location;
                $return_message_ids = stream_get_contents($send);
                $message_id_array = explode(",", $return_message_ids);
                /* $message_id_array is the array which contains the message IDs */
                /* You can save it to database */
               
				
          
         }
		   }
              }
			  				redirect(base_url() . 'index.php/Class_teacher/message' , 'refresh');

        
    }
	
	function absent_message() 
    {
       
      
		
		
            $message_thread_code = $this->crud_model->send_new_absent_message();
            
        
    }
	
	
	function special_message() 
    {
       
      
		
		
           $message_thread_code = $this->crud_model->send_new_special_message();
            
        
    }
	function students_area($class_id = '')
    {
        
       // $page_data['page_name']     = 'students_area';
        //$page_data['page_title']    = get_phrase('Students') ." - ".get_phrase('Class')." : ".
        $this->crud_model->get_class_name($class_id);
        $page_data['class_id']  = $class_id;
        $this->load->view('teacher/students_area', $page_data);
    }
	function get_class_subject1($class_id) 
    {
      $admin=$this->session->userdata('login_user_id'); 
			  $teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
			$this->db->where('class_id',$class_id);
			$this->db->where('teacher_id',$teacher_id);
				$subjects = $this->db->get_where('subject')->result_array();
				foreach($subjects as $row)
       
        {
            
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
           
        }
    }
	
	
	function student_add($action='',$enquiry_id='')
	{
            $yr=get_running_year();
		$data['enquiry']= $this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row();
		
		$data['action']=$action;
		
		$user_id = $this->session->userdata('login_user_id');
		$this->db->select('e.section_id,e.name as section_name,c.class_id,c.name as class_name');
		$this->db->from('staff s');
		$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->where('s.user_id',$user_id);
		$this->db->where('e.academic_year',$yr);
		$data['class']=$this->db->get()->result_array();
		 
		 $this->load->view('class_teacher/add_student.php',$data);
	}
	
	
	function student_bulk($action='') 
	{
            $yr=get_running_year();
	    $data['action']=$action;
	    $user_id = $this->session->userdata('login_user_id');
		$this->db->select('e.section_id,e.name as section_name,c.class_id,c.name as class_name');
		$this->db->from('staff s');
		$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->where('s.user_id',$user_id);
		$this->db->where('e.academic_year',$yr);
		$data['class']=$this->db->get()->result_array();
	   
	    $this->load->view('class_teacher/student_bulk.php',$data);
	}
	
	function add_student()
	{
		$running_year = get_running_year();
		
		
		$branch_id	=	$this->input->post('branch');
		$dept_id	=	$this->input->post('department');
		$data_user['branch_id']		=	$branch_id;
		$data_user['dept_id']		=	$dept_id;
		$data_user['username']		=	$this->input->post('phone1');
		$data_user['password']       = sha1($this->input->post('phone1'));
		$data_user['user_role_id']	=	'10';
		
		$this->db->insert('tbl_users',$data_user);
		$user_id=$this->db->insert_id();
		$data['branch_id']		=	$branch_id;
		$data['dept_id']		=	$dept_id;
		$data['student_status_id']	=	'0';
		$data['name']           = $this->input->post('name');
		$data['admission_number']           = $this->input->post('admission_no');
		
		$data['birthday']       = $this->input->post('birthday');
		$data['parent']         = $this->input->post('parent');
		$data['date']           = strtotime(date("d M,Y"));
		$data['sex']            = $this->input->post('sex');
		$data['address']        = $this->input->post('address');
		$data['phone1']          = $this->input->post('phone1');
		$data['phone2']          = $this->input->post('phone2');
		$phone= $data['phone1'].','.$data['phone2'] ;
		$data['email']          = $this->input->post('email');
		$data['password']       = $this->input->post('phone1');
		$data['parent']      = $this->input->post('parent');
		$data['username']=$this->input->post('phone1');
		if($user_id!='')
		 $data['user_id']	=$user_id;
		$enquiry_id=$this->input->post('id');
		$data1['is_admitted']='Y';
		if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
		{
			$data['school']      = $this->input->post('school');
		}
	 $notification =$this->input->post('notification');
		
		$msg =$this->input->post('additional_msg');
		$msg11=$this->input->post('message');
		$this->load->Model('crud_model');
		$student_id =  $this->crud_model->student_insert($data,$enquiry_id,$data1);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
		$data2['student_id']     = $student_id;
		$data2['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
		$data2['class_id']       = $this->input->post('class_id');
		if ($this->input->post('section_id') != '') 
		{
			$data2['section_id'] = $this->input->post('section_id');
		}
		$data2['roll']           = $this->input->post('roll_number');
		$data2['date_added']     = strtotime(date("Y-m-d H:i:s"));
		$data2['year']           = $running_year;
		$result=$this->crud_model->student_insert_bulk($data2);
		
		$additional=$this->input->post('message');
		$class =$this->input->post('class_id');
		$section = $this->input->post('section_id');
		 $fee_master     = $this->input->post('fee_master');
		
		
		if ($fee_master!='')
		{
			
			$class_id     = $this->input->post('class_id');
			$section_id	= $this->input->post('section_id');
			$this->assign_student_fee($student_id,$class_id,$section_id,$fee_master);
		}
		if($notification =='')
		{
			redirect('Class_teacher/student_add/');
		}
		$content = "Admission Message";
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data10['send_by']	=$staff;
		$data10['content']	=  $content;
		date_default_timezone_set("Asia/Kolkata");
		$data10['send_date']	=  date('Y/m/d h:i:s');
		$this->db->insert('tbl_sms_delivery_master',$data10);
		$master_id		=	$this->db->insert_id();
		
		$sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
		$web_url=$sms->web_url;
		$phone1=$this->input->post('phone1');
		$data11['sms_master_id']	=$master_id;
		$data11['student_id']	= $student_id;
		$data11['class_id']	=$class;
		$data11['section_id']	=$section;
		$data11['phone']	=$phone1;
		
		
		if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True')
					   {
		if($notification =='1'  && $msg=='1')
		{
		    
			$data11['msg_content']	= $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$phone1." and password ".$phone1." . ". $additional;
		}
		if($notification =='1' && $msg=='')
		{
			$data11['msg_content']	= $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$phone1." and password ".$phone1." . ";
		}
		}
		else
		{
		if($notification =='1'  && $msg=='1')
		{
		    
			$data11['msg_content']	= $message = "Greetings from ".$common."You will get attendance,Unit test and General notifications of your child here after. ". $additional;
		}
		if($notification =='1' && $msg=='')
		{
			$data11['msg_content']	= $message = "Greetings from ".$common."You will get attendance,Unit test and General notifications of your child here after.";
		}
		}
		date_default_timezone_set("Asia/Kolkata");
		$data11['send_date']	=  date('Y/m/d h:i:s');
		
		$this->db->insert('tbl_sms_delivery_details',$data11);
		
		  
		if($result>0)
		{
			$data3['action']="success";
		
		}
		$data5['master_id']	=	$master_id;	
		$data5['class_id']	=	$class;
		$data5['section_id']	=	$section;
		redirect('Class_teacher/sms_send_admission/'.$phone1.'/'.$master_id);
		
		

	}
	
	function sms_send_admission($phone,$master_id)
	{
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	$i=0;
	$this->db->select('details_id,student_id,msg_content');
	$this->db->from('tbl_sms_delivery_details d');
	
	$this->db->where('sms_master_id',$master_id);
	
	$a=$this->db->get()->row();
	$message=$a->msg_content;
	$details	=$a->details_id;
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone.'&msg=' . urlencode($message . " " ) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	 $return_message_ids = stream_get_contents($send);
	
	$message_id_array = explode(",", $return_message_ids);
	
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$details);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	
	
	
	}
	$this->load->view('class_teacher/add_student.php');
	
	}
	
	
	function student_bulk1($param1 = '')
	{
	
	if($param1 == 'add_bulk_student') 
	{
	$names     = $this->input->post('name');
	$rolls     = $this->input->post('roll');
	$schools    = $this->input->post('school');
	$date           = strtotime(date("d M,Y"));
	$phones    = $this->input->post('phone');
	$branch    = $this->input->post('branch');
	$dept    = $this->input->post('department');
	
	//    $genders   = $this->input->post('sex');
	$student_entries = sizeof($names);
	$notification = null === $this->input->post('notification') ? 0 : 1;
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	$web_url=$sms->web_url;
	for($i = 0; $i < $student_entries; $i++)
	{
	
	
	$data3['username']		=	$phones[$i];
	$data3['password']		=	$phones[$i];
	$data3['user_role_id']	=10;
	$data3['branch_id']	=$branch;
	$data3['dept_id']	=$dept;
	$this->db->insert('tbl_users' , $data3);
	$user_id=$this->db->insert_id();
	$data['user_id']	=$user_id;
	$data['branch_id']     =   $branch;
	$data['dept_id']     =   $dept;
	$data['name']     =   $names[$i];
	$data['username']     =   $phones[$i];
	$data['password']     =   $names[$i];
	$data['school']    =   $schools[$i];
	$data['date']           = strtotime(date("d M,Y"));
	$data['phone1']    =   $phones[$i];
	if($data['name'] == '' || $data['phone1'] == '' || $data['user_id']=='')
	continue;
	$this->db->insert('student' , $data);
	$student_id = $this->db->insert_id();
	$data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
	$data2['student_id']    =   $student_id;
	$data2['class_id']      =   $this->input->post('class_id');
	if($this->input->post('section_id') != '') 
	{
	$data2['section_id']    =   $this->input->post('section_id');
	}
	$data2['roll']          =   $rolls[$i];
	$data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
	$data2['year']          =   get_running_year();
	$this->db->insert('enroll' , $data2);
	$data1["action"]="success";
	
	
	if($notification =='1')
	{
	   if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True')
					   {
	$message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$data['phone1']." and password ".$data['phone1'].".";
	}
	 else
	 
	 {
	$message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after.";
	}
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data10['send_by']	=$staff;
	$data10['content']	=  "Admission Message";
	date_default_timezone_set("Asia/Kolkata");
		$data10['send_date']	=  date('Y/m/d h:i:s');
	$this->db->insert('tbl_sms_delivery_master',$data10);
	$master_id		=	$this->db->insert_id();
	
	$data11['sms_master_id']	=$master_id;
	$data11['student_id']	= $student_id;
	$data11['class_id']	=$this->input->post('class_id');
	$data11['section_id']	=$this->input->post('section_id');
	$data11['phone']	=$data['phone1'];
	$data11['msg_content']	= $message;
	
	date_default_timezone_set("Asia/Kolkata");
		$data11['send_date']	=  date('Y/m/d h:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data11);
	
	
	
	
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$data['phone1'].'&msg=' . urlencode($message . " ") . '&route=T';
	
	
	
	
	$api = $url;
	

	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) 
	{
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	//$message_id_array = explode(",", $return_message_ids);
	
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('sms_master_id',$master_id);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	
	}
	}
	
	}
	}
	
	//redirect(base_url() . 'index.php/admin/student_bulk/' . $this->input->post('class_id') , 'refresh');
	        
	//$page_data['page_name']  = 'student_bulk';
	//$page_data['page_title'] = get_phrase('Student-Bulk');
	
	
	$this->load->view('class_teacher/student_bulk',$data1);
	
	
	}
	
	function get_class_section($class_id)
	{
		$class_option=$this->input->post('class');
		$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
		echo '<option value="">---Select---</option>';
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}
	
	 function upload_marks()
	{
		$this->load->view('class_teacher/upload_marks.php');

	}
	
	 function upload_marks_subject()
	{
		$this->load->view('class_teacher/upload_marks_subject.php');

	}
	
	function marks_selector_subject()
    {
        
        
        $data['class_id']   = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
		$data['exam_id']    = $this->input->post('exam_id');
        $data['subject_id'] = $this->input->post('subject_id');
		$data['comment'] = $this->input->post('remarks');
        $data['year']       = get_running_year();
        $query = $this->db->get_where('mark' , array(
                    
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
							'exam_id' => $data['exam_id'],
                                'subject_id' => $data['subject_id'],
                                    'year' => $data['year']));
									
		$query1 = $this->db->get_where('enroll' , array(
                    
                        'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                                    'year' => $data['year']));
      //  if($query->num_rows() < 1) 
	  if($query->num_rows() < $query1->num_rows()) 
        {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']))->result_array();
            foreach($students as $row) 
            {
                $data['student_id'] = $row['student_id'];
				$dat = $this->db->get_where('mark' , array( 'class_id' => $data['class_id'],'section_id' => $data['section_id'],'exam_id' => $data['exam_id'],
                       'subject_id' => $data['subject_id'],'year' => $data['year'],'student_id' =>$data['student_id']));
				if($dat->num_rows()<1){
                $this->db->insert('mark' , $data);
				}
            }
        }
        redirect(base_url() . 'index.php/Class_teacher/marks_upload_subject/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'] , 'refresh');
    }
	
	
	function marks_upload_subject($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '', $remarks = '')
    {
       
        $page_data['exam_id']    =   $exam_id;
        $page_data['class_id']   =   $class_id;
        $page_data['subject_id'] =   $subject_id;
        $page_data['section_id'] =   $section_id;
		 $page_data['remarks'] =  $remarks;
        //$page_data['page_name']  =   'marks_upload';
        //$page_data['page_title'] = get_phrase('Upload-Marks');
        $this->load->view('class_teacher/marks_upload_subject', $page_data);
    }
	
  function excel_import()
	{
            $yr=get_running_year();
	    $user_id = $this->session->userdata('login_user_id');
		$this->db->select('e.section_id,e.name as section_name,c.class_id,c.name as class_name');
		$this->db->from('staff s');
		$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->where('s.user_id',$user_id);
		$this->db->where('e.academic_year',$yr);
		$data['class']=$this->db->get()->result_array();
		
		$this->load->view('class_teacher/excel_import.php',$data);
	}
	
	
	 function import()
        {
  if(isset($_POST["import"]))
    {
	 
	
	  $running_year = get_running_year();
	    				$class_id=$this->input->post('class_id');
						$section_id=$this->input->post('section_id');
						
        $filename=$_FILES["file"]["tmp_name"];
        if($_FILES["file"]["size"] > 0)
          {
            $file = fopen($filename, "r");
			
			$i=1;
			
             while (($importdata = fgetcsv($file)) !== FALSE)
             {
			    if($i>3){
				
				
				
				        $data2['user_role_id']  =  "10";
						$data2['created_by']    =  $this->session->userdata('login_user_id');
						$data2['created_date']  =  date('Y-m-d');
						$data2['is_deleted']    =  "N";
						$data2['username']      =  $importdata[4];
						$data2['password']      =  sha1($importdata[4]);
						$data2['branch_id']     =  $this->session->userdata('branch_id');
						$data2['dept_id']       =  $this->session->userdata('dept_id');
						
						$this->db->where('phone1',$importdata[4]); 
						$student=$this->db->get('student');
						if($student->num_rows()>0)
						{
						  $user_id='';
						}
						else
						{
						$user_id = $this->crud_model->insert_user_data($data2);
						}
						
                     	$data['name'] 		= $importdata[0];
						$data['birthday']	= $importdata[1];
                        $data['sex'] 		= $importdata[2];
						$data['address'] 	= $importdata[3];
						$data['phone1'] 	= $importdata[4];
						$data['phone2'] 	= $importdata[5];
						$data['email'] 		= $importdata[6];
						$data['parent'] 	= $importdata[7];
						$data['admission_number'] 	= $importdata[8];
						$data['user_id']    = $user_id;
						$data['branch_id'] =  $this->session->userdata('branch_id');
						$data['dept_id']   =  $this->session->userdata('dept_id');
                        $data['date'] 		= strtotime(date("d M,Y"));
						if($data['name']!='' && $data['phone1']!='' && $data['user_id']!=''){
						$insert = $this->crud_model->insertCSV($data);
						 	
						 $data1['student_id']=$insert;
						$data1['class_id']=$class_id;
	    				$data1['section_id']=$section_id;
						$data1['roll']=$importdata[9];
						$data1['date_added']=strtotime(date("d M,Y"));
						$data1['enroll_code']    = substr(md5(rand(0, 1000000)), 0, 7);
				        $data1['year']           = $running_year;

						$insert = $this->crud_model->insertenroll($data1);
						}
						}
						$i++;
             
             }                    
            fclose($file);
          }
		}
		redirect('Class_teacher/excel_import/');
}

 function check_phone_number($phone)	
	{
		$data['phone']	=$phone;
		$this->load->view('class_teacher/check_phone_number.php',$data);
		
	}
	
	function student_view()
	{
            $yr=get_running_year();
	    $user_id=$this->session->userdata('login_user_id');
	    $this->db->select('c.class_id,c.name as class_name,e.section_id,e.name as section_name');
		$this->db->from('staff s');
		$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->where('s.user_id',$user_id);
		$this->db->where('e.academic_year',$yr);
		$data['class']=$this->db->get()->result_array();
				
		$this->load->view('class_teacher/student_view.php',$data);
	}
	
	function student_view_subject()
	{
            $yr=get_running_year();
	    $user_id=$this->session->userdata('login_user_id');
	    $this->db->select('c.class_id,c.name as class_name,e.section_id,e.name as section_name');
		$this->db->from('staff s');
		$this->db->join('section e','e.teacher_id=s.staff_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->where('s.user_id',$user_id);
		$this->db->where('c.academic_year',$yr);
		$data['class']=$this->db->get()->result_array();
				
		$this->load->view('class_teacher/student_view_subject.php',$data);
	}
	
	/*function view_students_list($class_id='',$section_id='')
	{
	   
	   $this->db->select('s.name,s.phone1,s.student_id');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.year',$this->session->userdata('academic_year'));
		$this->db->where('e.section_id',$section_id);
		$this->crud_model->check_student_status();
		$data['class_id']=$class_id;
		$data['section_id']=$section_id;
		$data['student']=$this->db->get()->result_array();
				
		$this->load->view('class_teacher/student_view_1.php',$data);
	}*/

	function get_class_teacher_section($class_id)
	{
		$user_id	=	$this->session->userdata('login_user_id'); 
		$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;

		$this->db->select('s.name as section_name,s.section_id');
		//$this->db->join('section s','s.section_id=st.section_id');
		$this->db->where('s.teacher_id',$teacher_id);
		$this->db->where('s.class_id',$class_id);
		
		$sections = $this->db->get('section s')->result_array();
		//echo '<option value="">SELECT</option>';
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
		}
	}
	
	function marks_get_subject_myclass($class_id='')
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('class_teacher/marks_get_subject_myclass' , $page_data);
    }
	
	function marks_get_subject1($class_id='',$teacher_id='')
    {
        $page_data['class_id'] 		= $class_id;
        $page_data['teacher_id'] 	= $teacher_id;
        $this->load->view('class_teacher/marks_get_subject' , $page_data);
    }
	function get_teacher_subjects($class_id='',$section_id='',$teacher_id='')	
	{
		$this->load->model('Crud_model');
		if($class_id!='')
		{
			$data['class_id']	=	$class_id;
		}
		if($section_id!='')
		{
			$data['section_id']	=	$section_id;
		}
		if($teacher_id!='')
		{
			$data['teacher_id']	=	$teacher_id;
		}
				
		$subjects	=	$this->Crud_model->get_teacher_subjects($data);
		foreach($subjects as $subject):
			echo "<option value='".$subject['subject_id']."' >".$subject['subject_name']."</option>";
		endforeach;
	}
	
	function tab_sheet_class($class_id = '' ,$section_id= '' ,$exam_id = '' ) {
        
        
        if ($this->input->post('operation') == 'selection') {
		    $page_data['class_id']   = $this->input->post('class_id');
			 $page_data['section_id']   = $this->input->post('section_id');
            $page_data['exam_id']    = $this->input->post('exam_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php/class_teacher/tab_sheet_class/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
            } else {
                redirect(base_url() . 'index.php/class_teacher/tab_sheet_class/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section_id;
       
        $this->load->view('class_teacher/tab_sheet_class', $page_data);
    
    }
	
	function subject_message1($class,$section,$exam1,$grade,$position,$remark,$page_from)
	{
	/* echo "<script>alert(".$exam1.");</script>";die();*/
	$phone2='';
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	$content = "exmm";
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$datas['send_by']	=$staff;
	$datas['content']	=  $content;
	date_default_timezone_set("Asia/Kolkata");
		$datas['send_date']	=  date('Y/m/d h:i:s');
	$this->db->insert('tbl_sms_delivery_master',$datas);
	 $master_id		=	$this->db->insert_id();
	 if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
				 {
					$c= '1';
					}
					else
					{
					$c= '0';
					}
					$this->db->where('exam_id',$exam1);
	$exam_name1=$this->db->get('exam')->row();
	 $exam_name=$exam_name1->name;
					
					
					$this->db->select('distinct(student_id) as student_id');
					$this->db->where('class_id', $class);
					$this->db->where('section_id', $section);
					$this->db->where('exam_id', $exam1);
					$student=$this->db->get('mark')->result_array();//echo $this->db->last_query();
					//print_r($student);die();
					foreach($student as $stud)
					{
					//print_r($stud['student_id']);
					
					//$this->db->where('exam_id', $exam);
					$this->db->select('m.mark_obtained,m.mark_total,s.name as subject,m.comment,m.grade,m.position');
					$this->db->where('student_id',$stud['student_id']);
					 $this->db->join('subject s', 's.subject_id = m.subject_id', 'left');
					 //$this->db->join('student ', 'student.student_id = m.student_id', 'left');
					$exam = $this->db->get('mark m')->result_array();
				
					
	$this->db->where('student_id',$stud['student_id']);
	$exam_student_name=$this->db->get('student')->row();
	 $student_name=$exam_student_name->name;
	  $student_number=$exam_student_name->phone1;
	   $student_number2=$exam_student_name->phone2;
	 $text="Student Name : ".$student_name." Exam : ".$exam_name;
					foreach($exam as $exm)
					{
					if($remark==1)
	{
	
	  $rmrk= $exm['comment'];
	
	
	}
	else
	{
	$rmrk =" ";
	}
	
	if($grade==0 && $position==0)
	{
	
	 $msg=" ";
	
	}
	else if($grade==1 && $position==1)
	{
	 $msg="Grade and Position - ".$exm['grade']." ".$exm['position'];
	

	}
	else if($grade==1 && $position==0)
	{
	$msg="Grade -".$exm['grade'];
	}
	else if($grade==0 && $position==1)
	{
	$msg="Position -".$exm['position'];
	}
	
	 
	 

					$subject_student=" Marks:  " . $exm['mark_obtained'] . "/" . $exm['mark_total'] . " for " . $exm['subject'].' '.$msg.' '.$rmrk;
					 $text=$text.' '.$subject_student;
				
					}
					
					
				$data1['sms_master_id']	=$master_id;
	
	 $data1['student_id']	=$stud['student_id'];
	
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$student_number;
	$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d h:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data1);
	
	if($phone2==1)
	{
		if($student_number2!='')
		{
		
			$data2['sms_master_id']	=$master_id;
			
			$data2['student_id']	=$stud['student_id'];
			
			$data2['class_id']	=$class;
			$data2['section_id']	=$section;
			$data2['phone']	=$student_number2;
			$data2['msg_content']	=$this->sms_helper1($common,$c,$text);
			date_default_timezone_set("Asia/Kolkata");
			$data2['send_date']	=  date('Y/m/d h:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data2);
		}
	}	
	
	}
					
					
					
	$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$data['exam_id']	=	$exam1;
		$data['page_from']	=	$page_from;
		$this->load->view('class_teacher/message_popup_exam_report',$data);
					
					//$student=$this->db->get('student')
	}
	
	function sms_helper1($common_word,$c,$content)
	{
		if($c==1)
		$message = $common_word. ' ' .$content.'.';  
		if($c==0)
		$message = $content.' '.$common_word. ' .'; 
		
		return $message; 
	}
	
	function sms_send_popup_exam_report_all($master_id,$class_id,$section_id,$exam_id,$page_from='')
	
	{
	$this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
	$this->db->from('tbl_sms_delivery_details a');
	$this->db->where('sms_master_id',$master_id);
	$a=$this->db->get()->result_array();
$i=0;
$sms = $this->db->get('sms_settings')->row();
	 $sender_id = $sms->sender_id;
	
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	
	foreach($a as $b)
	
	{
	$ph=$b['ph'];
	$message= $b['msg_content'];
	
	
	if($b['processed']==0)
	{
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
	$api = $url;
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	//}
	}
	
	}
	else{?>
	<script>alert("No Message Send ")</script>
	<?php }
	}
	
	redirect(base_url() . 'index.php/Class_teacher/'.$page_from.'/'.$class_id.'/'.$section_id.'/'.$exam_id , 'refresh');
	
	}
	
	function subject_message_individual1($class,$section, $exam1, $subject, $grade, $position, $remark,$page_from='')
	{
	
	
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	$content = "exmm";
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$datas['send_by']	=$staff;
	$datas['content']	=  $content;
	date_default_timezone_set("Asia/Kolkata");
		$datas['send_date']	=  date('Y/m/d h:i:s');
	$this->db->insert('tbl_sms_delivery_master',$datas);
	 $master_id		=	$this->db->insert_id();
	 if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
				 {
					$c= '1';
					}
					else
					{
					$c= '0';
					}
					$this->db->where('exam_id',$exam1);
					$exam_name1=$this->db->get('exam')->row();
	 				$exam_name=$exam_name1->name;
					
					$this->db->where('subject_id',$subject);
					$sub_name=$this->db->get('subject')->row();
	 				 $subject_name=$sub_name->name;
					
					
					$this->db->select('m.student_id,s.name as student_name,m.mark_obtained,m.mark_total,m.grade,m.position,m.comment,s.phone1,s.phone2');
					$this->db->where('m.class_id', $class);
					$this->db->where('m.section_id', $section);
					$this->db->where('m.exam_id', $exam1);
					$this->db->where('m.subject_id', $subject);
					$this->db->join('student s','s.student_id=m.student_id','LEFT');
					$student=$this->db->get('mark m')->result_array();
					
					foreach($student as $stud)
					{
					
					if($remark==1)
	{
	
	  $rmrk= $stud['comment'];
	
	
	}
	else
	{
	$rmrk =" ";
	}
	
	if($grade==0 && $position==0)
	{
	
	 $msg=" ";
	
	}
	else if($grade==1 && $position==1)
	{
	 $msg="Grade and Position - ".$stud['grade']." ".$stud['position'];
	

	}
	else if($grade==1 && $position==0)
	{
	$msg="Grade -".$stud['grade'];
	}
	else if($grade==0 && $position==1)
	{
	$msg="Position -".$stud['position'];
	}
	
	
	  $text="Student Name : ".$stud['student_name']." Exam : ".$exam_name." Marks:  " . $stud['mark_obtained'] . "/" . $stud['mark_total'] . " for " . $subject_name.' '.$msg.' '.$rmrk;
	  
	  
	  
	  $data1['sms_master_id']	=$master_id;
	
	 $data1['student_id']	=$stud['student_id'];
	
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$stud['phone1'];
	$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d h:i:s');
		
	$this->db->insert('tbl_sms_delivery_details',$data1);
	
	/*if($phone2==1)
	{
		if($stud['phone2']!='')
		{
			$data2['sms_master_id']	=$master_id;
			
			 $data2['student_id']	=$stud['student_id'];
			
			$data2['class_id']	=$class;
			$data2['section_id']	=$section;
			$data2['phone']	=$stud['phone2'];
			$data2['msg_content']	=$this->sms_helper1($common,$c,$text);
			date_default_timezone_set("Asia/Kolkata");
				$data2['send_date']	=  date('Y/m/d h:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data2);
		}
	}*/
	
					}
					
				$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$data['exam_id']	=	$exam1;
		$data['subject_id']	=	$subject;
		$data['page_from']	=	$page_from;
		$this->load->view('class_teacher/message_popup_exam_report_subject',$data);
	}
	
	function sms_send_popup_exam_report_subject($master_id,$class_id,$section_id,$exam_id)
	
	{
	$this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
	$this->db->from('tbl_sms_delivery_details a');
	$this->db->where('sms_master_id',$master_id);
	$a=$this->db->get()->result_array();
$i=0;
$sms = $this->db->get('sms_settings')->row();
	 $sender_id = $sms->sender_id;
	
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	
	foreach($a as $b)
	
	{
	$ph=$b['ph'];
	$message= $b['msg_content'];
	
	
	if($b['processed']==0)
	{
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
	$api = $url;
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	//}
	}
	
	}
	else{?>
	<script>alert("No Message Send ")</script>
	<?php }
	}
	
	redirect(base_url() . 'index.php/class_teacher/tab_sheet_class/'.$class_id.'/'.$section_id.'/'.$exam_id , 'refresh');
	
	}
	
	function delete_sms_pop_up($master_id='',$page_from='',$class_id='',$section_id='',$due_date='')
	{
	$this->db->where('sms_master_id',$master_id);
	$this->db->delete('tbl_sms_delivery_master');
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->delete('tbl_sms_delivery_details');
	//$data['master_id']	=$master_id;
	//$this->load->view('admin/message.php');
	/*if($page_from=='fee_due')
	{
		redirect('FeeManagement/fee_due_report2/'.$class_id.'/'.$section_id.'/'.$due_date);
	}
	if($page_from=='special_fee')
	{
		redirect('FeeManagement/view_special_fee/');
	}*/
		redirect('Class_teacher/'.$page_from.'');
	
	}
	function get_teacher_class_section($class_id='',$year='')
	{
		//$class_option=$this->input->post('class');
		$user_id	=	$this->session->userdata('login_user_id'); 
		$teacher_id	=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;

		$this->db->select('s.name as section_name,s.section_id');
		$this->db->join('section s','s.section_id=st.section_id');
		$this->db->where('st.teacher_id',$teacher_id);
		$this->db->where('st.class_id',$class_id);
		$this->db->group_by('s.section_id');
		
		$sections = $this->db->get('subject_teacher st')->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
		}
	}
	function get_teacher_subjects1($class_id='',$teacher_id='')	
	{
		$this->load->model('Crud_model');
		if($class_id!='')
		{
			$data['class_id']	=	$class_id;
		}
		if($teacher_id!='')
		{
			$data['teacher_id']	=	$teacher_id;
		}
				
		$subjects	=	$this->Crud_model->get_teacher_subjects($data);
		foreach($subjects as $subject):
			echo "<option value='".$subject['subject_id']."' >".$subject['subject_name']."</option>";
		endforeach;
	}
	function update_student($student_id)
	{
	
	//$student_id		= $this->input->post('student_id');
	$class_id		= $this->input->post('class');
	$section_id		= $this->input->post('section');
	$fee_master_id	= $this->input->post('fee_master_id');
	$is_fee_paid= is_fee_paid($student_id);
	//////////////////Fee Master Update////////////////////
	/*
	if($is_fee_paid!='y')
	{
	
	$this->db->select('fee_installment_master_id,fee_payment_options_master_id,fee_payment_options_details_id,fee_total,fee_balance,due_date');
	$this->db->from('tbl_fee_installment_master');
	$this->db->where('fee_master_id',$fee_master_id);
	$result=$this->db->get()->result_array();
	
	///////////////////////
		$year	=	$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;			
		$this->db->select('students_fee_master_id,class_id'); // get the fee_master_id
		$this->db->from('tbl_students_fee_master');
		$this->db->where('admission_number' , $student_id);
		$this->db->where('academic_year_id',$year);
		//$this->db->where('class_id' , $class_id);
		//$this->db->where('batch_id' , $section_id);

		$result1=$this->db->get()->result_array();
		$master_id=0;
		foreach($result1 as $row1)
		{
			$master_id	=	$row1['students_fee_master_id'];
		
			if($master_id>0)
			{
				$this->db->where('students_fee_master_id' , $master_id); // delete it from details table
				$this->db->delete('tbl_students_fee_details');
				
				
				$this->db->where('admission_number' , $student_id); // then delete from master table
				//$this->db->where('class_id' , $class_id);
				//$this->db->where('batch_id' , $section_id);
				$this->db->where('academic_year_id',$year);
				$this->db->delete('tbl_students_fee_master');
			}
		}

	/////////////////////

		foreach($result as $row)
		{
			$concession							=	0;
			$data1['admission_number']			=	$student_id;
			$data1['class_id']					=	$class_id;
			$data1['batch_id']					=	$section_id;
			$data1['fee_master_id']				=	$fee_master_id;
			$data1['fee_installment_master_id']	=	$row['fee_installment_master_id'];
			$data1['due_date']					=	$row['due_date'];
			$data1['fee_amount']				=	$row['fee_total'];
			$data1['fee_balance']				=	$row['fee_balance'];
			$data1['fee_concession']			=	$concession;
			$data1['academic_year_id']			=	get_student_academic_year($student_id);
			
					
			$this->db->insert('tbl_students_fee_master', $data1); // now insert into master table
			
			$master_id= $this->db->insert_id();
			$primary_id=$row['fee_installment_master_id'];
			
			$this->db->select('fee_head_id,fee_amount,fee_balance');
			$this->db->from('tbl_fee_installment_details');
			$this->db->where('fee_installment_master_id',$primary_id);
			$result1=$this->db->get()->result_array();
		
			foreach($result1 as $row1)
			{
				$data['students_fee_master_id']	=	$master_id;
				$data['fee_head_id']			=	$row1['fee_head_id'];
				$data['fee_amount']				=	$row1['fee_amount'];
				$data['fee_balance']			=	$row1['fee_balance'];
				$data['fee_concession']			=	$concession;
				$this->db->insert('tbl_students_fee_details', $data);
			}
		
		}
	
		$data=array();
		$data1=array();
	}
	*/
	/////////////////Fee Master Update Complete
	
	
	
	$data1['roll']           = $this->input->post('roll');
	$data['admission_number']           = $this->input->post('admission_number');
	$data1['class_id']           = $this->input->post('class');
	$data1['section_id']           = $this->input->post('section');
	$data['name']           = $this->input->post('name');
	$data['school']           = $this->input->post('school_name');
	$data['phone1']          = $this->input->post('phone1');
	$data['phone2']          = $this->input->post('phone2');
	// $data['parent']          = $this->input->post('parent');

	$data['sex']          = $this->input->post('sex');
	
	$data['address']        = $this->input->post('address');
	$data['parent']      = $this->input->post('parent');
	$data['birthday']       = $this->input->post('birthday');
	// $data['dormitory_id']   = $this->input->post('dormitory_id');
	// $data['transport_id']   = $this->input->post('transport_id');
	$data['student_session'] = $this->input->post('student_session');
	 $data['email']          = $this->input->post('email');
	
	$this->crud_model->student_update($data,$student_id,$data1);
/**** Resize image Start*****/

	$image 				=	$_FILES["userfile"]["name"];
 	$uploadedfile 		= 	$_FILES['userfile']['tmp_name'];
	if ($image) 
	{
		$filename 		= 	stripslashes($_FILES['userfile']['name']);
		$extension 		= 	$this->getExtension($filename);
		$extension 		= 	strtolower($extension);
		$size			=	filesize($_FILES['userfile']['tmp_name']);
		if($extension=="jpg" || $extension=="jpeg" )
		{
			$uploadedfile = $_FILES['userfile']['tmp_name'];
			$src = imagecreatefromjpeg($uploadedfile);
		}
		else if($extension=="png")
		{
			$uploadedfile = $_FILES['userfile']['tmp_name'];
			$src = imagecreatefrompng($uploadedfile);
		}
		else 
		{
			$src = imagecreatefromgif($uploadedfile);
		}
		list($width,$height)	=	getimagesize($uploadedfile);
		
		$newwidth=150;
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		
		$filename = "uploads/student_image/". $student_id. '.jpg';
		
		imagejpeg($tmp,$filename,100);
		
		imagedestroy($src);
		imagedestroy($tmp);
	}	
		
/**** Resize image End*******/
	
	//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
	redirect(base_url() . 'index.php/Class_teacher/student_portal/'.$student_id ,'refresh');
	
	}
	function getExtension($str) 
	{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 	}
	function individual_message($student_id)
	{ 
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	$content = $this->input->post('message_send');
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
				 {
					$c= '1';
					}
					else
					{
					$c= '0';
					}
					if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
				 {
					$n= '1';
					}
					else
					{
					$n= '0';
					}
	$this->db->select('s.phone1,s.name,s.student_id,e.class_id,e.section_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('s.student_id',$student_id);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	$data1['class_id']	=$b['class_id'];
	$data1['section_id']	=$b['section_id'];
	$data1['phone']	=$b['phone1'];
	
	$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$b['class_id'];
	$data['section_id']	=	$b['section_id'];
	$data['student_id']	=	$student_id;
	$this->load->view('Class_teacher/message_popup_individual',$data);
	}
	 function sms_helper($common_word,$c,$n,$name,$content)
	{
		if($c==1 && $n==1)
		$message = $common_word. ' Hi ' .$name.' ' .$content.'.';  
		if($c==1 && $n==0)
		$message = $common_word. ' Hi ' .$content.'.'; 
		if($c==0 && $n==1)
		$message = 'Hi ' .$name.' ' .$content.' '.$common_word.'.' ;  
		if($c==0 && $n==0)
		$message = 'Hi ' .$content.' '.$common_word.'.';
		
		return $message; 
		
		
	}
	function sms_send_popup_individual($master_id,$student_id,$class_id)
	{
	
	error_reporting(0);
	
	$this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
	$this->db->from('tbl_sms_delivery_details a');
	$this->db->where('sms_master_id',$master_id);
	$a=$this->db->get()->result_array();
$i=0;
$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	foreach($a as $b)
	
	{
	$ph=$b['ph'];
	
	
	if($b['processed']==0)
	{
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($b['msg_content']) . '&route=T';
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	//$this->db->where('sms_master_id',$master_id);
	//$a1= $this->db->get('tbl_sms_delivery_details')->result_array();
	//$i=0;
	//foreach($a1 as $b1)
	//{
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	//}
	}
	
	}
	else{?>
	<script>alert("No Message Send ")</script>
	<?php }
	}
	 redirect(base_url() . 'index.php/Class_teacher/student_portal/'.$student_id.'/'.$class_id , 'refresh');
	}
	
	function view_students_list($class_id='',$section_id='')
	{
            $yr=get_running_year();
	    $this->db->select('s.name,s.phone1,s.student_id');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.year',$yr);
		$this->db->where('e.section_id',$section_id);
		$this->crud_model->check_student_status();
		$data['class_id']=$class_id;
		$data['section_id']=$section_id;
		$data['student']=$this->db->get()->result_array();
		if($class_id!=NULL && $section_id!=NULL)		
		$this->load->view('class_teacher/student_view_1.php',$data);
	}
	
	function send_message()
	{
		$data['student_id'] = $this->uri->segment(3);
		$this->load->view('class_teacher/send_messages.php',$data);
	}
	
	function submit_message()
	{
		date_default_timezone_set('Asia/Kolkata');
		$year	    = get_running_year();
    	$this->db->trans_start();
    	$this->db->db_debug         =   FALSE;   
		$message_data= array(
		'from_teacher_id'	=> $this->session->userdata('login_user_id'),
		'message'			=> $this->input->post('message'),
		'to_student_id'		=>$this->input->post('student_id'),
		'date_time'			=> date('Y/m/d H:i:s'),
		'year'				=> $year
		);
		
		$this->db->insert('tbl_teacher_student_message',$message_data);
        $this->db->trans_complete();
		if($this->db->trans_status()==FALSE)
		{
		$action="failed";
		}
		else
		{
		$action="success";
		}
		$this->session->set_flashdata('action',$action);
    	redirect('class_teacher/send_message');
	}

	function view_send_messages()
	{
		$teacher_id=$this->session->userdata('login_user_id');
		$this->db->order_by("date_time","desc");
		$this->db->where('from_teacher_id',$teacher_id);
		$data['message_data'] = $this->db->get('tbl_teacher_student_message')->result_array();//echo $this->db->last_query();die;
		$this->load->view('class_teacher/view_send_messages.php',$data);
	}
	
	function get_messages($date_from='',$date_to='')
	{
		$teacher_id=$this->session->userdata('login_user_id');
		if($date_from!=NULL){
		$this->db->where('date(date_time) >=',date('Y-m-d',strtotime($date_from)));
		}
		if($date_to!=NULL){
		$this->db->where('date(date_time) <=',date('Y-m-d',strtotime($date_to)));
		}
		$this->db->order_by("date_time","desc");
		$this->db->where('from_teacher_id',$teacher_id);
		$data['message_data'] = $this->db->get('tbl_teacher_student_message')->result_array();//echo $this->db->last_query();die;
		$this->load->view('class_teacher/view_messages.php',$data);
	}
	
	function delete_message()
	{
		$this->db->trans_start();
		$message_id=$this->input->post('id');
		$this->db->where('message_id',$message_id);
		$this->db->delete('tbl_teacher_student_message');
		$this->db->trans_complete();
		if ($this->db->trans_status()!== FALSE)
		{
			echo "1";
		}	
		else
		{
			echo "0";
		}
	}
	function send_message_students()
	{
		$this->load->view('class_teacher/send_messages_to_students');
	}
	function get_students_list($class_id='',$section_id='')
	{
                $yr=get_running_year();
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$yr);
		$this->db->where('section_id',$section_id);
		$data['class_id']=$class_id;
		$data['section_id']=$section_id;
		$this->db->where('student_status_id','0');
		$this->db->order_by('name','asc');
		$data['student']=$this->db->get('view_students')->result_array();
		$this->load->view('class_teacher/students_list',$data);
		/*echo '<option value="">SELECT</option>';
		echo '<option value="all">All</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'] . '</option>';
		}*/
	}
	function teacher_send_messages()
	{
		$section_id = $this->input->post('section_id'); 
		$subject_id = $this->input->post('subject_id'); 
		$student_id = $this->input->post('student_id[]'); 
//		echo $student_id; 
//		die();
		for($i=0;$i<count($student_id);$i++)
		{
			date_default_timezone_set('Asia/Kolkata');
			$year	    		=	get_running_year();
			$this->db->trans_start();
			$this->db->db_debug =   FALSE;   
			$message_data= array(
								'from_teacher_id'	=> $this->session->userdata('login_user_id'),
								'message'			=> $this->input->post('message'),
								'to_student_id'		=> $student_id[$i],
								'subject_id'		=> $subject_id,	
								'date_time'			=> date('Y/m/d H:i:s'),
								'year'				=> $year
							);
			
			$this->db->insert('tbl_teacher_student_message',$message_data);
			$this->db->trans_complete();
		}
		if($this->db->trans_status()==FALSE)
		{
		$action="failed";
		}
		else
		{
		$action="success";
		}
		$this->session->set_flashdata('action',$action);
    	redirect('class_teacher/send_message_students');
	
	}
	
}