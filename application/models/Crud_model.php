<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

    function get_students($class_id) {
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }
    function student_insert($data,$id,$data1) {
      $data1['is_admitted'];
	
       $this->db->insert('student', $data);
	  $s=$this->db->insert_id();
	  $this->db->where('enquiry_id', $id);
	  $this->db->update('tbl_enquiry_master',$data1); 
	   return $s;
    }
	 function test_insert($data) {
        $this->db->insert('exam', $data);
    }
	function marks_upload_nameby($class_id,$section_id,$exam_id,$subject_id) {
         $this->db->select('s.name,m.mark_obtained,m.mark_total,m.mark_id,e.roll');
					   $this->db->from('mark m');
			            $this->db->join('student s','s.student_id=m.student_id','LEFT');
			         $this->db->join('enroll e','e.student_id=m.student_id','LEFT');
						$this->db->where('m.class_id',$class_id);
						 $this->db->where('m.section_id',$section_id);
						   $this->db->where('m.exam_id',$exam_id);
						    $this->db->where('m.subject_id',$subject_id);
							 $this->db->order_by('s.name', 'asc');
							return $this->db->get()->result_array();
    }
	
	function marks_upload_roleby($class_id,$section_id,$exam_id,$subject_id) {
        $this->db->select('s.name,m.mark_obtained,m.mark_total,m.mark_id,e.roll');
					   $this->db->from('mark m');
			            $this->db->join('student s','s.student_id=m.student_id','LEFT');
			         $this->db->join('enroll e','e.student_id=m.student_id','LEFT');
						$this->db->where('m.class_id',$class_id);
						 $this->db->where('m.section_id',$section_id);
						   $this->db->where('m.exam_id',$exam_id);
						    $this->db->where('m.subject_id',$subject_id);
							 $this->db->order_by('e.roll', 'asc');
							return $this->db->get()->result_array();
    }
	function teacher_insert($name,$username,$salary,$birthday,$sex,$address,$phone,$email,$password) {
				
				
			$data2['username']=$username;
	 		$data2['password']	=sha1($password);
	 		$data2['user_role_id']='2';
	  		$this->db->insert('tbl_users', $data2);
	   		$user_id= $this->db->insert_id();
	   
	   
			 $data['name']        = $name;
             $data['username']    = $username;
             $data['salary']      = $salary;
			 $data['birthday']      = $birthday;
             $data['sex']         = $sex;
             $data['address']     = $address;
            $data['phone']       = $phone;
            $data['email']       = $email;
           $data['password']    = sha1($password);
		   $data['user_id']    = $user_id;
		   
	
	  
      $this->db->insert('teacher', $data);
	 $teacher_id= $this->db->insert_id();
	
	 
	   return $teacher_id;
    }
	function rank($students,$class_id,$section_id,$exam_id) {
      $this->db->select('SUM(mark_obtained) as marks_get,SUM(mark_total) as total_mark');
				$this->db->from('mark ');
				$this->db->where('student_id',$students);
				$this->db->where('class_id',$class_id);
				$this->db->where('section_id',$section_id);
				$this->db->where('exam_id',$exam_id);
				$query = $this->db->get();
			  return $query->row();
    }
	function teacher_delete($teacher_id) {
     $this->db->where('teacher_id', $teacher_id);
            $this->db->delete('teacher');
    }
	function teacher_update($data,$teacher_id) {
      $this->db->where('teacher_id', $teacher_id);
      $this->db->update('teacher', $data);
    }
	function teacher_change_password($data,$teacher_id) {
      $this->db->where('teacher_id', $teacher_id);
      $this->db->update('teacher', array('password' => $data['new_password']));
    }
    function student_insert_bulk($data2) {
      return $this->db->insert('enroll', $data2);
	    
    }
	function update_news($news_code) {
       $this->db->where('news_code' , $param2);
       $this->db->update('news' , array('news_status' => 0));
    }
	function view_complaints() {
      $this->db->select('c.title,c.report_code,c.priority,c.description,c.timestamp,t.name as teacher,s.name as student');
		$this->db->from('reporte_alumnos c');
		$this->db->join('teacher t','t.teacher_id=c.teacher_id','LEFT');
		$this->db->join('student s','s.student_id=c.student_id','LEFT');
		return $this->db->get()->result_array();
    }
	function view_enquiry() {
     $this->db->select('e.title,e.description,e.date,s.name');
		$this->db->from('enquiry e');
		$this->db->join('student s','e.student_id=s.student_id','LEFT');
		
		return $this->db->get()->result_array();
    }
	function manage_classes($data) {
    return $this->db->insert('section' , $data);
    }
	function get_students_marks($class_id,$section_id,$exam_id,$subject_id,$running_year) {
		$this->db->join('student b','b.student_id=a.student_id and b.student_status_id=0');
		$this->db->where('a.exam_id',$exam_id);
		$this->db->where('a.class_id',$class_id);
		$this->db->where('a.section_id',$section_id);
		$this->db->where('a.year',$running_year);
		$this->db->where('a.subject_id',$subject_id);
		return  $this->db->get('mark a')->result_array();
    /*return  $this->db->get_where('mark' , array(
        'exam_id' => $exam_id, 
		'class_id' => $class_id,
        'section_id' => $section_id, 'year' => $running_year,
        'subject_id' => $subject_id))->result_array();*/
    }
	
	
	
	
	function insert_exam($data) {
    return $this->db->insert('exam' , $data);
    }
	function update_classes($data,$param2) {
     $this->db->where('class_id', $data);
     $this->db->update('class', array('name'=>$param2));
    }
	function delete_classes($param2) {
      $this->db->where('class_id', $param2);
      $this->db->delete('class');
		
	  $this->db->where('class_id', $param2);
      $this->db->delete('section');
    }
	function student_update($data,$student_id,$data1) {
	    $year	=	get_running_year();
      $this->db->where('student_id', $student_id);
      $this->db->update('student', $data);
	  $this->db->where('student_id', $student_id);
	  $this->db->where('year', $year);
     return $this->db->update('enroll', $data1);
 
    }
	function student_delete($student_id) {
	$this->db->where('status','deleted');
	$data['student_status_id']=$this->db->get('student_status')->row()->id;
	
	$this->db->where('student_id', $student_id);
        $this->db->update('student',$data);
	
	$this->db->where('student_id',$student_id);
	$user_id=$this->db->get('student')->row()->user_id;
	
	$data1['is_deleted']='Y';
	$this->db->where('user_id', $user_id);
        $this->db->update('tbl_users',$data1);
     
    }
	function student_bulk($data) {
	 
       $this->db->insert('student', $data);
	   return $this->db->insert_id();
    }
	
	function individual_message($student_id,$message_send ) {
	
	         $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
		
             $phone1 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone1;
             $phone2 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone2;

		 
			  
			  $sms = $this->db->get('sms_settings')->row();
			  
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
			  $web_url=$sms->web_url;
			  
			  
			   if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
					   { 

             if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
			  $message = $common." " .'Hi '.$student_name." ".$message_send.".";
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message).'&route=T';
			  }
			  else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
			  $message = 'Hi '.$student_name." ".$message_send ." ".$common;
			
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';}}
			  else
			  {
			  
			  if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
			  $message = $common." ".$message_send.".";
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message).'&route=T';
			  }
			  else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
			  $message = $message_send ." ".$common;
			
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';}
			  }
			  
		$api = $url;
		
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		
		if($balance >= 0){
			
			$api."/sendsms?".$location;
			
			 $send = fopen($api."/sendsms?".$location,"r");
			 
		
			  $return_message_ids = stream_get_contents($send);
			
			 $message_id_array = explode($return_message_ids,""); 
			//echo $count= count($return_message_ids);
			
			$data['student_id']			=	$student_id;
			$data['message']			=	$message;
			$data['phone1']				=	$phone1;
			$data['phone2']				=	$phone2;
			
			$data['sms_code']			=	$return_message_ids;
			$data['is_delivered']		=	'Y';
			$data['delivered_date']		=	date('Y/m/d');
			$this->db->insert('sms_delivery',$data);
			
			
			
			//$this->load->view('admin/preloader.php');
			
	                redirect(base_url() . 'index.php/admin/student_portal/' .$student_id , 'refresh');

        }
   }
	function student_bulk_enroll($data2) {
       $this->db->insert('enroll', $data2);
	   return $this->db->insert_id();
    }
	function migrate_check($class,$section,$academic_year) {
      $this->db->where('class_id', $class);
      $this->db->where('section_id',$section);
	  $this->db->where('year',$academic_year);
	  $this->check_student_status();
	    
	  $this->db->join('enroll', 'enroll.student_id = s.student_id');
	  $this->db->select('s.student_id, s.name,s.admission_number,enroll.roll,enroll.class_id,enroll.section_id');
	  $this->db->order_by('s.name','asc');
	  return $this->db->get('student s')->result_array();
    }
	function add_section($data) {
      return $this->db->insert('section' , $data);
    }
	function class_migrate($data,$stud) {
      
	 return $this->db->insert('enroll',$data);
	  
    }
	function edit_section($data,$param2) {
      $this->db->where('section_id' , $param2);
      $this->db->update('section' , $data);
    }
	function template_create($data) {
      return $this->db->insert('sms_template', $data);

    }
	function template_edit($data,$param2) {
                  $this->db->where('id', $param2);
            return $this->db->update('sms_template', $data);


    }
	function template_delete($param2) {
      $this->db->where('id', $param2);
       $this->db->delete('sms_template');

    }
	function subject_add($data,$data1='') {
    	$result		=	$this->db->insert('subject', $data);
		$subject_id	=	$this->db->insert_id();
		if($data1!='')
		{
    		if($result>0)
    		{
    			for($i=0;$i<count($data1['section_id']);$i++)
    			{
    				$sub_data	=	array
    									(
    									'subject_id'	=>	$subject_id,
    									'class_id'		=>	$data1['class_id'],
    									'section_id'	=>	$data1['section_id'][$i],
    									'teacher_id'	=>	$data1['teacher_id'][$i]
    									);
    				$result	=	$this->db->insert('subject_teacher',$sub_data);
    			}
    		}
    	}
		return $result;

    }
	function subject_delete($param2) {
       $this->db->where('subject_id', $param2);
       $this->db->delete('subject');
	   
       $this->db->where('subject_id', $param2);
       $this->db->delete('subject_teacher');

    }
	function subject_edit($data,$param2,$data1='') {
	//echo $param2;
	//die();
	
       $this->db->where('subject_id', $param2);
       $this->db->update('subject',$data);
		
		for($i=0;$i<count($data1['section_id']);$i++)
		{
			$this->db->where('subject_id',$param2);
			$this->db->where('class_id',$data1['class_id']);
			$this->db->where('section_id',$data1['section_id'][$i]);
			$result	=	$this->db->get('subject_teacher')->result_array();
			if(count($result)>0)
			{
				$this->db->set('teacher_id',$data1['teacher_id'][$i]);
				$this->db->where('subject_id',$param2);
				$this->db->where('class_id',$data1['class_id']);
				$this->db->where('section_id',$data1['section_id'][$i]);
				$this->db->update('subject_teacher');
			}
			else
			{
				$this->db->insert('subject_teacher',array('subject_id'=>$param2,'class_id'=>$data1['class_id'],'section_id'=>$data1['section_id'][$i],'teacher_id'=>$data1['teacher_id'][$i]));
			}
		}

    }
	function delete_section($param2) {
      $this->db->where('section_id' , $param2);
      $this->db->delete('section');
    }
	function staff_insert($branch_id,$dept,$name,$designation,$username,$birthday,$salary,$sex,$address,$phone,$email,$password) {
			 $role=$this->session->userdata('role');
			 
    		 if($role==4)
			 {
			 $branch_id	=$this->session->userdata('branch_id');
			  $department	=$this->session->userdata('dept_id');
			 }
			 
			  if($role==3)
			 {
			 $branch_id	=$this->session->userdata('branch_id');
			 // $department	=$this->session->userdata('dept_id');
			 }
			 
			
			$data2['username']=$username;
	 		$data2['password']	=sha1($password);
	 		$data2['user_role_id']=	$designation;
			$data2['branch_id']		=	$branch_id;
			$data2['dept_id']		=	$dept;
			$data2['created_by']		=	$this->session->userdata('login_user_id');
			$data2['created_date']		=	date('Y/m/d');
			$this->db->where('is_deleted','N'); 
			$this->db->where('username',$username); 
$users=$this->db->get('tbl_users');
if($users->num_rows()==0){


	  		$this->db->insert('tbl_users', $data2);
			}
	   		$user_id= $this->db->insert_id();
			
	
			$data['branch_id']		=	$branch_id;
			$data['dept_id']		=	$dept;
			$data['name']        = $name;
			$data['username']    = $username;
			$data['role']    = $designation;
            $data['salary']      = $salary;
            $data['sex']         = $sex;
            $data['address']     = $address;
            $data['phone']       = $phone;
			$data['birthday']       = $birthday;
            $data['email']       = $email;
            //$data['password']    = sha1($password);
			$data['user_id']	=$user_id;
			
if($users->num_rows()==0){


	  		$this->db->insert('staff', $data);
			}
	  
	   return $this->db->insert_id();
	  


		
	   
    }
	function staff_update($data,$staff_id) {
      $this->db->where('staff_id', $staff_id);
      $this->db->update('staff', $data);
    }
	function staff_change_password($data,$staff_id) {
	
      $this->db->where('staff_id', $staff_id);
	  
      $this->db->update('staff', array('password' => $data['new_password']));
    }
	function staff_delete($staff_id) {
     $this->db->where('staff_id', $staff_id);
     $this->db->delete('staff');
	 }
	 
	 function student_portal_data($student_id) 
	{
    	return  $this->db->get_where('student', array('student_id' => $student_id))->result_array();
	}
	function student_marks($student_id, $exam,$class_id,$running_year)
	{
		$this->db->select('s.subject_id,m.mark_total as mark_total,s.name ,m.mark_obtained as mark_obtained,m.comment as comment');
		$this->db->from('subject s');
		$this->db->join('mark m', 's.subject_id=m.subject_id', 'LEFT');
		//$this->db->join('ranks r', 'm.student_id=r.student_id', 'LEFT');
		$this->db->where('m.exam_id', $exam);
		$this->db->where('s.class_id', $class_id);
		$this->db->where('m.student_id', $student_id);
		$this->db->where('s.year', $running_year);
		$query = $this->db->get();
		return $subjects = $query->result_array();
	}
    function student_insert_sms($name,$phone1,$phone2,$additional) {
	 
       $sms = $this->db->get('sms_settings')->row();
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			 
			
			 
			  $url = $sms->url;
			  $web_url=$sms->web_url;
			 if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True') {
			  $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$phone1." and password ".$phone1." ". $additional;
			  }
			 else if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == '') { 
			   $message ="Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after.".$additional;
			   }
			   
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2. '&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		
		if($balance >= 0){
			
		$api."/sendsms?".$location;
			$send = fopen($api."/sendsms?".$location,"r");
			//var_dump($location);
			
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
	
	function student_insert_sms1($name,$phone1,$phone2) {
	 
       $sms = $this->db->get('sms_settings')->row();
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			 
			
			 
			  $url = $sms->url;
			  $web_url=$sms->web_url;
			 if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True') {
			  $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$phone1." and password ".$phone1." ";
			  }
			 else if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == '') { 
			   $message ="Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after.";
			   }
			   
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2. '&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		
		if($balance >= 0){
			
		$api."/sendsms?".$location;
			$send = fopen($api."/sendsms?".$location,"r");
			//var_dump($location);
			
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

    function get_student_info($student_id) {
        $query = $this->db->get_where('student', array('student_id' => $student_id));
        return $query->result_array();
		
		
    }
	 function get_student_area_alphabet($running_year,$class_id) {
        $this->db->select('e.student_id,e.roll,s.name as name');
					 $this->db->from('enroll e');
					 $this->db->join('student s', 'e.student_id = s.student_id', 'left');
                     $this->db->order_by('s.name', 'asc');	
					
                     $this->db->where('e.class_id',$class_id);
					 $this->db->where('e.year',$running_year);
					 $this->db->where('e.student_id >', 0);
 $this->check_student_status();
                     $query = $this->db->get();
					return $query->result_array();
    }
	function get_student_area_roll($running_year,$class_id,$order,$migrated='') {
		
        $this->db->select('s.student_id, s.name, s.admission_number, s.phone1, s.email, s.sex, e.roll, e.class_id, e.section_id, e.year');
		$this->db->from('student s');
		$this->db->join('enroll e', 'e.student_id = s.student_id', 'inner');
		if($order==1)
		{
             $this->db->order_by('s.name', 'asc');
		}
		elseif($order==2)
		{
             $this->db->order_by('s.name', 'desc');
		}	
		elseif($order==3)
		{
            $this->db->order_by('e.roll', 'asc');
		}	
		elseif($order==4)
		{
            $this->db->order_by('e.roll', 'desc');
		}	
		elseif($order==5)
		{
             $this->db->order_by('s.admission_number', 'asc');
		}	
		elseif($order==6)
		{
             $this->db->order_by('s.admission_number', 'desc');
		}			
		elseif($order==7)
		{
             $this->db->order_by('s.sex', 'asc');
		}		
		
        if ($class_id != '' && $class_id != '0' && $class_id > 0) {
            $this->db->where('e.class_id', $class_id);
        }
		$this->db->where('e.year',$running_year);
		$this->db->where('s.student_id >', 0);
		if($migrated=='non_migrated')
		{
			$this->db->where('e.is_migrated!=','Y');
		}
		$this->db->where('s.student_status_id', 0);
		$this->db->group_by('s.student_id');
        $query = $this->db->get();
		return $query->result_array();
    }
	
	 function additional_message_content() {
       	$this->db->select('content,title');
		$this->db->from('sms_template');
		 $this->db->where('title','admission');
	 	 return $this->db->get();
    }
	
	 function additional_message_content1() {
       	$this->db->select('content');
   		 $this->db->from('sms_template');
		 $this->db->where('title','admission');
	return  $this->db->get()->result_array();
    }
	
	function sms_balance() {
        $sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
							// $api = 'http://bulksms.login2itsolutions.com';
		//$api = 'http://sms4add.in';
		$api = $url;
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		 echo $balance;
    }


    function email_exists($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('student');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
        
    function create_online_exam() {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['availablefrom'] = $this->input->post('availablefrom');
        $data['availableto'] = $this->input->post('availableto');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['duration'] = $this->input->post('duration');
        $data['pass'] = $this->input->post('pass');
        $data['questions'] = $this->input->post('questions');
        $data['teacher_id'] = $this->session->userdata('login_user_id');
        $data['exam_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('exams', $data);
    }

    function create_post() {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['timestamp'] = strtotime(date("d M,Y"));
        $data['subject_id'] = $this->input->post('subject_id');
        $data['teacher_id'] = $this->session->userdata('login_user_id');
        $data['post_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $this->db->insert('forum', $data);
        $post_code = $this->db->get_where('forum', array('post_id' => $this->db->insert_id()))->row()->post_code;
        $docs_id = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/forum/" . $_FILES["file_name"]["name"]);
        return $post_code;
    }

    function homework_create() {
$running_year=get_running_year();
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end'] = $this->input->post('time_end');
        $data['class_id'] = $this->input->post('class_id');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
$data['academic_year'] = $running_year;
		 $data['created_at'] = date('Y-m-d');
		if($this->session->userdata('role')==1 ||$this->session->userdata('role')==2)
		{
		$data['branch_id']	=$this->input->post('branch');
		$data['dept_id']	=$this->input->post('department');
		}
		if($this->session->userdata('role')==3)
		{
		$data['branch_id']	=$this->session->userdata('branch_id');
		$data['dept_id']	=$this->input->post('department');
		}
		if($this->session->userdata('role')==4 || $this->session->userdata('role')==5 || $this->session->userdata('role')==6)
		{
		$data['branch_id']	=$this->session->userdata('branch_id');
		$data['dept_id']	=$this->session->userdata('dept_id');
		}
        //$data['uploader_type'] = $this->session->userdata('login_type');
        $data['uploader_id'] = $this->session->userdata('login_user_id');
        $data['homework_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['homework_status'] = 1;
        $this->db->insert('homework', $data);
        $homework_code = $this->db->get_where('homework', array('homework_id' => $this->db->insert_id()))->row()->homework_code;
        $doc_id = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/homework/" . $_FILES["file_name"]["name"]);
        return $homework_code;
    }

    function update_homework($homework_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['time_end'] = $this->input->post('time_end');
        $this->db->where('homework_code', $homework_code);
        $this->db->update('homework', $data);
    }

    function update_post($post_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $this->db->where('post_code', $post_code);
        $this->db->update('forum', $data);
    }

    function update_exam($exam_code) {
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['availablefrom'] = $this->input->post('availablefrom');
        $data['availableto'] = $this->input->post('availableto');
        $data['pass'] = $this->input->post('pass');
        $data['questions'] = $this->input->post('questions');
        $data['duration'] = $this->input->post('duration');
        $this->db->where('exam_code', $exam_code);
        $this->db->update('exams', $data);
    }

    function add_questions() {
        $data['question'] = $this->input->post('question');
        $data['exam_id'] = $this->input->post('exam_id');
        $data['exam_code'] = $this->input->post('exam_code');
        $data['optiona'] = $this->input->post('optiona');
        $data['optionb'] = $this->input->post('optionb');
        $data['optionc'] = $this->input->post('optionc');
        $data['optiond'] = $this->input->post('optiond');
        $data['correctanswer'] = $this->input->post('correctanswer');
        $data['marks'] = $this->input->post('marks');
        $this->db->insert('questions', $data);
    }

    function create_post_message($post_code = '') {
        $data['message'] = $this->input->post('message');
        $data['post_id'] = $this->db->get_where('forum', array('post_code' => $post_code))->row()->post_id;
        $data['date'] = date("d M Y");
        $data['user_type'] = $this->session->userdata('login_type');
        $data['user_id'] = $this->session->userdata('login_user_id');
        $this->db->insert('forum_message', $data);
    }

    function delete_homework($homework_code) {
        $this->db->where('homework_code', $homework_code);
        $this->db->update('homework',array('is_deleted'=>'Y'));
    }

    function delete_post($post_code) {
        $this->db->where('post_code', $post_code);
        $this->db->delete('forum');
    }

    function admin_create() {
        $data['name'] = $this->input->post('name');
        $data['username'] = $this->input->post('username');
        $data['email'] = $this->input->post('email');
        $data['password'] = sha1($this->input->post('password'));
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        $data['owner_status'] = $this->input->post('owner_status');
        $this->db->insert('admin', $data);
        $new_admin_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $new_admin_id . '.jpg');
    }

    function admin_edit($admin_id) {
        $data['name'] = $this->input->post('name');
        $data['username'] = $this->input->post('username');
        $data['email'] = $this->input->post('email');
        $data['phone'] = $this->input->post('phone');
        $data['address'] = $this->input->post('address');
        $data['birthday'] = $this->input->post('birthday');
        $data['status'] = $this->input->post('status');
        $this->db->where('admin_id', $admin_id);
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $admin_id . '.jpg');
    }

    function admin_pass($admin_id) {
        $data['new_password'] = sha1($this->input->post('new_password'));
        $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
        if ($data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('admin_id', $admin_id);
            $this->db->update('admin', array('password' => $data['new_password']));
        }
    }

    function admin_delete($admin_id) {
        $this->db->where('admin_id', $admin_id);
        $this->db->delete('admin');
    }

    function delete_questions($question_id) {
        $this->db->where('question_id', $question_id);
        $this->db->delete('questions');
    }

    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_subject_name_by_id($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
        return $query->name;
    }

    function get_class_name($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $year   =   get_running_year();
        $query = $this->db->get_where('class',array('academic_year'=>$year));
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    function get_exams($class_id) {
        $yr=get_running_year();
        $query = $this->db->get_where('exam', array('class_id'=>$class_id ,'is_deleted'=>'N',
            'year' => $yr
        ));
        return $query->result_array();
    }
	
	 function get_exams1($class_id,$exam_id) {
             $yr=get_running_year();
        $query = $this->db->get_where('exam', array('class_id'=>$class_id ,'exam_id'=>$exam_id,
            'year' => $yr
        ));
        return $query->result_array();
    }
	function get_home_tests($class_id,$section_id,$home_test_id,$student_id)
	{
		$year	=	get_running_year();
		$this->db->select('a.exam_name,a.date_exam,a.mark_obtained,a.mark_total,a.grade,a.year,a.remarks as details,a.position,b.name as subject_name');
		$this->db->join('subject b','b.subject_id=a.subject_id');
        $query = $this->db->get_where('tbl_home_test_mark a', array('a.class_id'=>$class_id ,'a.section_id'=>$section_id ,'a.home_test_id'=>$home_test_id,'a.year' => $year,'a.student_id' => $student_id))->result_array();
        return $query;
	}

	function get_entrance_tests($class_id,$section_id,$entrance_test_id,$student_id)
	{
		$year	=	get_running_year();
		$this->db->select('a.exam_name,a.date_exam,a.mark_obtained,a.mark_total,a.grade,a.year,a.remarks as details,a.position,b.name as subject_name');
		$this->db->join('subject b','b.subject_id=a.subject_id');
        $query = $this->db->get_where('tbl_entrance_test_mark a', array('a.class_id'=>$class_id ,'a.section_id'=>$section_id ,'a.entrance_test_id'=>$entrance_test_id,'a.year' => $year,'a.student_id' => $student_id))->result_array();
        return $query;
	} 


    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_obtained_marks($exam_id, $class_id, $subject_id, $student_id) {
        $marks = $this->db->get_where('mark', array(
                    'subject_id' => $subject_id,
                    'exam_id' => $exam_id,
                    'class_id' => $class_id,
                    'student_id' => $student_id))->result_array();

        foreach ($marks as $row) {
            echo $row['mark_obtained'];
            echo $row['labuno'];
            echo $row['labdos'];
            echo $row['labtres'];
            echo $row['labcuatro'];
            echo $row['labcinco'];
            echo $row['labseis'];
            echo $row['labsiete'];
            echo $row['labocho'];
            echo $row['labnueve'];
        }
    }

    function get_highest_marks($exam_id, $class_id, $subject_id) {
        $this->db->where('exam_id', $exam_id);
        $this->db->where('class_id', $class_id);
        $this->db->where('subject_id', $subject_id);
        $this->db->select_max('mark_obtained');
        $highest_marks = $this->db->get('mark')->result_array();
        foreach ($highest_marks as $row) {
            echo $row['mark_obtained'];
        }
    }

    function get_grade($mark_obtained) {
        $query = $this->db->get('grade');
        $grades = $query->result_array();
        foreach ($grades as $row) {
            if ($mark_obtained >= $row['mark_from'] && $mark_obtained <= $row['mark_upto'])
                return $row;
        }
    }

    function create_log($data) {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $location = new SimpleXMLElement(file_get_contents('http://freegeoip.net/xml/' . $_SERVER["REMOTE_ADDR"]));
        $data['location'] = $location->City . ' , ' . $location->CountryName;
        $this->db->insert('log', $data);
    }

    function get_system_settings() {
        $query = $this->db->get('settings');
        return $query->result_array();
    }

    function truncate($type) {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function get_image_video($type = '', $id = '') {
        if (file_exists('uploads/screen/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/screen/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    function save_study_material_info() {
 $running_year=get_running_year();
        $data['timestamp'] = strtotime(date("Y-m-d H:i:s"));
		$role=$this->session->userdata('role');
		if($role==1|| $role==2)
		{
		$data['branch_id']	=	$this->input->post('branch');
		$data['dept_id']	=	$this->input->post('department');
		}
		if($role==3)
		{
		$data['branch_id']	=	$this->session->userdata('branch_id');
		$data['dept_id']	=	$this->input->post('department');
		}
		if($role==4 || $role==5 || $role==6)
		{
		$data['branch_id']	=	$this->session->userdata('branch_id');
		$data['dept_id']	=	$this->session->userdata('dept_id');
		}
		
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['file_name'] = $_FILES["file_name"]["name"];
        $data['file_type'] = $this->input->post('file_type');
        $data['class_id'] = $this->input->post('class_id');
$data['academic_year'] =  $running_year;
		
		$user=$this->session->userdata('login_user_id'); 
	    $teacher_id=$this->db->get_where('staff' ,array('user_id'=>$user))->row()->staff_id;
		if( $role==5 || $role==6)
		{
		$data['teacher_id'] =$teacher_id;
		}
		else
		{
		$data['teacher_id'] =$user;
		}
        $data['subject_id'] = $this->input->post('subject_id');
        $study_material=$this->db->insert('document', $data);
        $document_id = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
		return $study_material;
    }
    function guardar_poa() {
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $data['titulo'] = $this->input->post('title');
        $data['descripcion'] = $this->input->post('description');
        $data['nombre_archivo'] = $_FILES["file_name"]["name"];
        $data['tipo_archivo'] = $this->input->post('file_type');
        $this->db->insert('poa', $data);
        $id_poa = $this->db->insert_id();
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/poa/" . $_FILES["file_name"]["name"]);
    }

     function select_study_material_info() {
         $yr=get_running_year();
	    $role=$this->session->userdata('role');
		if($role==6 || $role==5)
		{
		$admin=$this->session->userdata('login_user_id'); 
		$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
		$this->db->where('teacher_id',$teacher_id);
		}
		$this->db->where('academic_year',$yr);
		$this->db->where('is_deleted','N');
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('document')->result_array();
    }


    function create_news() {
$running_year = get_running_year();
	//$news_date = $this->input->post('date');
            //$s1_date=date_create($news_date);
            //$data['date']  =date_format($s1_date,"Y-m-d");
			$role=$this->session->userdata('role');
			if($role==1 || $role==2)
			{
		$data['branch_id'] = $this->input->post('branch');
		$data['dept_id'] = $this->input->post('department');
		}
		if($role==3)
			{
			$data['dept_id'] = $this->session->userdata('branch_id');
			$data['dept_id'] = $this->input->post('department');
		}
		if($role>=4)
			{
		$data['branch_id'] = $this->session->userdata('branch_id');
		$data['dept_id'] = $this->session->userdata('dept_id');
		}
		
        $data['title'] = $this->input->post('title');
        $data['news_code'] = substr(md5(rand(100000000, 200000000)), 0, 10);
        $data['description'] = $this->input->post('description');
		$data['news_status']  =date("Y-m-d");
		$data['academic_year']  =$running_year;

        $this->db->insert('news', $data);
        $news_code = $this->db->get_where('news', array('news_id' => $this->db->insert_id()))->row()->news_code;
		 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/news_image/' . $news_code . '.jpg');
        return $news_code;
    }
	
	
	 function rest_password() {
	//$news_date = $this->input->post('date');
            //$s1_date=date_create($news_date);
            //$data['date']  =date_format($s1_date,"Y-m-d");
			$student_id=$this->session->userdata('login_user_id');
        $data['password'] = $this->input->post('confirm');
       
		$this->db->where('student_id',$student_id);
        $this->db->update('student', $data);
	redirect(base_url() . 'index.php?student/reset_password/');
     
    }
	
	
	

    function delete_news($news_code) {
        $this->db->where('news_code', $news_code);
        $this->db->delete('news');
    }

    function delete_unit($academic_syllabus_id) {
        $this->db->where('academic_syllabus_id', $academic_syllabus_id);
        $this->db->delete('academic_syllabus');
    }
	
	function get_news() {
        $this->db->order_by("title","desc");
                      $this->db->from('news');
                  return  $news=$this->db->get()->result_array();
    }

	

    function delete_book($libro_id) {
        $this->db->where('libro_id', $libro_id);
        $this->db->delete('libreria');
    }

    function create_news_message($news_code = '') {
        $data['message'] = $this->input->post('message');
        $data['news_id'] = $this->db->get_where('news', array('news_code' => $news_code))->row()->news_id;
        $data['date'] = date("d M Y");
       // $data['user_type'] = $this->session->userdata('login_type');
        $data['user_id'] = $this->session->userdata('login_user_id');
       // if ($_FILES['userfile']['name'] != '')
//            $data['message_file_name'] = $_FILES['userfile']['name'];
        $this->db->insert('mensaje_reporte', $data);
       // if ($_FILES['userfile']['name'] != '')
//            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/project_message_file/' . $_FILES['userfile']['name']);
    }

    function create_notice_message($notice_code = '') {
        $data['message'] = $this->input->post('message');
        $data['notice_id'] = $this->db->get_where('news_teacher', array('notice_code' => $notice_code))->row()->notice_id;
        $data['date'] = date("d M Y");
        $data['user_type'] = $this->session->userdata('login_type');
        $data['user_id'] = $this->session->userdata('login_user_id');
        if ($_FILES['userfile']['name'] != '')
            $data['message_file_name'] = $_FILES['userfile']['name'];
        $this->db->insert('notice_message', $data);
        if ($_FILES['userfile']['name'] != '')
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/notice_message_file/' . $_FILES['userfile']['name']);
    }

    function obtener_poa() {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('poa')->result_array();
    }

    function get_pages() {
        $this->db->order_by("timestamp", "desc");
        return $this->db->get('pages')->result_array();
    }

   function select_study_material_info_for_student() {
        $user_id	= $this->session->userdata('login_user_id');

    	  $student       = $this->db->get_where('student', array('user_id' => $user_id))->row()->student_id;
	$yr=get_running_year();	
        $class_id = $this->db->get_where('enroll', array(
                    'student_id' => $student ,
                    'year' => $yr
                ))->row()->class_id;
        $this->db->order_by("timestamp", "desc");
        return $this->db->get_where('document', array('class_id' => $class_id))->result_array();
    }

    function update_study_material_info($document_id) 
	{
	//echo $document_id;

        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
		$data['file_name'] = $_FILES["file_name"]["name"];
        $data['file_type'] = $this->input->post('file_type');
		 move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/document/" . $_FILES["file_name"]["name"]);
        $this->db->where('document_id', $document_id);
        $this->db->update('document', $data);
    }

    function actualizar_poa($document_id) {
        $data['timestamp'] = strtotime($this->input->post('timestamp'));
        $data['title'] = $this->input->post('title');
        $data['description'] = $this->input->post('description');
        $data['class_id'] = $this->input->post('class_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $this->db->where('document_id', $document_id);
        $this->db->update('document', $data);
    }

    function delete_study_material_info($document_id)
	 {
	 $data['is_deleted']	='Y';
        $this->db->where('document_id', $document_id);
        $this->db->update('document',$data);
    }

    function borrar_poa($id_poa) {
        $this->db->where('id_poa', $id_poa);
        $this->db->delete('poa');
    }

    function delete_page($page_id) {
        $this->db->where('page_id', $page_id);
        $this->db->delete('pages');
    }

    function send_new_absent_message($absent_date) {

        $student = $this->input->post('student');
        if (count($student) > 0) {

            $sms = $this->db->get('sms_settings')->row();
            $sender_id = $sms->sender_id;
            $username = $sms->username;
            $password = $sms->password;
            $common = $sms->common_word;
            $url = $sms->url;

            foreach ($student as $stud) {
                $student_id = $stud;

                $phone1 = $this->db->get_where('student', array('student_id' => $student_id))->row()->phone1;
	            $phone2 = $this->db->get_where('student', array('student_id' => $student_id))->row()->phone2;

                //$reciever = $phn->phone;
                $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;


                $message = $student_name . " is absent on ".$absent_date;
				
                //  $this->db->insert('message_thread', $data_message_thread);	
         if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

                $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common . " " . $message) . '&route=T';
				}
				else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
               $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message . " " . $common) . '&route=T';
				}
				//var_dump($location);
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
					
					$data['student_id']=	$student_id;
					$data['message']=	$message;
					$data['phone1']	=	$phone1;
					$data['phone2']	=	$phone2;
					$data['sms_code']=	$return_message_ids;
					$data['is_delivered']=	'Y';
					$data['delivered_date']=	date('Y/m/d');
					$this->db->insert('sms_delivery',$data);
                    /* $message_id_array is the array which contains the message IDs */
                    /* You can save it to database */
                }
            }
        }?><script>alert("Message Send Successfully")</script><?php 
		redirect(base_url() . 'index.php/admin/message' , 'refresh');
		
    }
	function send_new_special_message() {

        $student = $this->input->post('student');
        if (count($student) > 0) {

            $sms = $this->db->get('sms_settings')->row();
            $sender_id = $sms->sender_id;
            $username = $sms->username;
            $password = $sms->password;
            $common = $sms->common_word;
            $url = $sms->url;

            foreach ($student as $stud) {
                $student_id = $stud;

                $phone1 = $this->db->get_where('student', array('student_id' => $student_id))->row()->phone1;
	            $phone2 = $this->db->get_where('student', array('student_id' => $student_id))->row()->phone2;

                //$reciever = $phn->phone;
                $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;

                           $msg=$this->input->post('message1');
                $message = "Hi ".$student_name ." ". $msg;
				 $message1 =  $msg;
				 
                //  $this->db->insert('message_thread', $data_message_thread);	
				if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
					   { 
			  
         if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

                $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common . " " . $message) . '&route=T';
				}
				else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
               $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message . " " . $common) . '&route=T';
				}
				}
				else
				{
				
				if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

                $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common . " " . $message1) . '&route=T';
				}
				else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
               $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message1 . " " . $common) . '&route=T';
				}
				
				}
				//var_dump($location);
				
                $api = $url;

                $handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
                $balance = stream_get_contents($handle);


                if ($balance >= 0) {

                    $api . "/sendsms?" . $location;
                    $send = fopen($api . "/sendsms?" . $location, "r");
                    $api . "/sendsms?" . $location;
                    $return_message_ids = stream_get_contents($send);
                    $message_id_array = explode(",", $return_message_ids);
					
					$data['student_id']=	$student_id;
$data['message']=	$message;
$data['phone1']	=	$phone1;
$data['phone2']	=	$phone2;
$data['sms_code']=	$return_message_ids;
$data['is_delivered']=	'Y';
$data['delivered_date']=	date('Y/m/d');
$this->db->insert('sms_delivery',$data);
                    /* $message_id_array is the array which contains the message IDs */
                    /* You can save it to database */
                }
            }
        }
		?><script>alert("Message Send Successfully")</script><?php 
		redirect(base_url() . 'index.php/admin/message' , 'refresh');
    }
	
		function send_new_malayalam_message() {

        $student = $this->input->post('student');
        if (count($student) > 0) {

            $sms = $this->db->get('sms_settings')->row();
            $sender_id = $sms->sender_id;
            $username = $sms->username;
            $password = $sms->password;
            $common = $sms->common_word;
            $url = $sms->url;

            foreach ($student as $stud) {
                $student_id = $stud;

                $phone1 = $this->db->get_where('student', array('student_id' => $student_id))->row()->phone1;
	            $phone2 = $this->db->get_where('student', array('student_id' => $student_id))->row()->phone2;

                //$reciever = $phn->phone;
                $student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;

                           $msg=$this->input->post('message_special');
                $message = "Hi ".$student_name ." ". $msg;
				 $message1 =  $msg;
				 
                //  $this->db->insert('message_thread', $data_message_thread);	
				if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
					   { 
			  
         if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

                $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common . " " . $message) . '&route=T';
				}
				else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
               $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message . " " . $common) . '&route=T';
				}
				}
				else
				{
				
				if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

                $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common . " " . $message1) . '&route=T';
				}
				else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
               $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($message1 . " " . $common) . '&route=T';
				}
				
				}
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
    }
	
	
	

    function send_new_private_message() {
        //$this->load->helper('sendsms_helper');sss
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));

        $class = $this->input->post('class');
        $section = $this->input->post('section');
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        $message_thread_code = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;

        // $this->db->insert('message', $data_message);

        $reciver_count = 0;
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $this->db->where('class_id', $class);
        $this->db->where('section_id', $section);
        $cls = $this->db->get('enroll')->result_array();
        $a1 = "";
        foreach ($cls as $cl) {
            $student_id = $cl['student_id'];
            $phn1 = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
            $reciever1 = array();
            foreach ($phn1 as $phn) {
                /* increment reciver_count if a reciever number found */
                $reciver_count++;
                $reciever1 = $phn['phone'];
                $res = $reciever1;
                $a1 .= ("" == $a1) ? $res : ',' . $res;
                // echo $a1;
            }

            $phn = $this->db->get_where('student', array('student_id' => $student_id))->row();
            $reciever = $phn->phone;
            $student_name = $phn->name;

            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender'] = $sender;
            $data_message_thread['reciever'] = $reciever1;

            //$msg =  $message . "<br>" . "Name: " . $student_name."<br>";
            //  $this->db->insert('message_thread', $data_message_thread);		
        }

       /* $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . urlencode($a1) . '&msg=' . urlencode($message . " " . $common) . '&route=T';
        $api = 'http://bulksms.login2itsolutions.com';

        $handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");*/
        $balance = stream_get_contents($handle);

        /* Error handling */

        if ($reciver_count == 0) {
            // Handle - No reciever
        }
        if ($balance < $reciver_count) {
            // Handle - Reciever count is greater than the message balance
        }

        if ($balance >= $reciver_count && $reciver_count > 0) {

            $api . "/sendsms?" . $location;
            $send = fopen($api . "/sendsms?" . $location, "r");
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
    }

    function send_reply_message($message_thread_code) {
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');


        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;
        $this->db->insert('message', $data_message);
    }

    /* function mark_thread_messages_read($message_thread_code) {
      $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
      $this->db->where('sender !=', $current_user);
      $this->db->where('message_thread_code', $message_thread_code);
      $this->db->update('message', array('read_status' => 1));
      } */

     function create_report() {
        $data['title'] = $this->input->post('title');
        $data['report_code'] = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['priority'] = $this->input->post('priority');
        $data['teacher_id'] = $this->input->post('teacher_id');
		$data['description']=$this->input->post('description');
		$data['branch_id']=$this->session->userdata('branch_id');
		$data['dept_id']=$this->session->userdata('dept_id');
        $login_type = $this->session->userdata('login_type');
        //if ($login_type == 'student')
            $user_id= $this->session->userdata('login_user_id');
			
			$this->db->where('user_id',$user_id);
			$data['student_id']=$this->db->get('student')->row()->student_id;
       // else
           // $data['student_id'] = $this->input->post('student_id');

        $data['timestamp'] = date("d M,Y");
        $this->db->insert('reporte_alumnos', $data);
       /* $data2['report_code'] = $data['report_code'];
        $data2['message'] = $this->input->post('description');
        $data2['timestamp'] = date("d M,Y");
        $data2['sender_type'] = $this->session->userdata('login_type');
        $data2['sender_id'] = $this->session->userdata('login_user_id');
        //if ($_FILES['file']['name'] != '')
//            $data2['file'] = $_FILES['file']['name'];

        $this->db->insert('reporte_mensaje', $data2);*/
        //move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/reportes_alumnos/' . $_FILES['file']['name']);
    }
	
	
	
	 function create_enquiry() {
	 $user=$this->session->userdata('login_user_id');
	 $this->db->where('user_id',$user);
	 $stud=$this->db->get('student')->row()->student_id;
	 
	 
	 	$data['	student_id'] = $stud;
        $data['title'] = $this->input->post('title');
     	$data['description']=$this->input->post('description');
		$data['branch_id']=$this->session->userdata('branch_id');
		$data['dept_id']=$this->session->userdata('dept_id');
		 $data['date'] = date("Y-m-d");
        $this->db->insert('enquiry', $data);
		  } 
		  
function complaint_remark($param2) {
        $data['remark'] = $this->input->post('remark');
	
     	$this->db->where('report_code', $param2);
        $this->db->update('reporte_alumnos', $data);
		  }
		  
		function update_admission_template($admission_msg) {
        
	    $data['content']= $this->input->post('admission_msg');

     	$this->db->where('title', 'admission');
       return $this->db->update('sms_template', $data);
		  }
  		function update_attendance_template($attendance) {
        
	    $data['content']= $this->input->post('attendance');

     	$this->db->where('title', 'attendance');
       return $this->db->update('sms_template', $data);
		  }
  function update_birthday_template($birthday) {
        
	    $data['content']= $this->input->post('birthday');

     	$this->db->where('title', 'birthday');
       return $this->db->update('sms_template', $data);
		  }

		  
		  
    function enquiry_remark($param2) {
       $data['remarks'] = $this->input->post('remark');
	
     	$this->db->where('enquiry_id', $param2);
        $this->db->update('enquiry', $data);
		  }

    function delete_report($report_code) {
        $this->db->where('report_code', $report_code);
        $this->db->delete('reporte_alumnos');
    }
   function attendance_selector($class_id,$year,$timestamp,$section_id) {
        $query = $this->db->get_where('attendance' ,array(
            'class_id'=>$class_id,
                'section_id'=>$section_id,
                    'year'=>$year,
                        'timestamp'=>$timestamp));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $class_id , 'section_id' => $section_id , 'year' => $year
            ))->result_array();
            foreach($students as $row) {
                $attn_data['class_id']   = $class_id;
                $attn_data['year']       = $year;
                $attn_data['timestamp']  = $timestamp;
                $attn_data['section_id'] = $section_id;
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
        redirect(base_url().'index.php?admin/manage_attendance/'.$class_id.'/'.$section_id.'/'.$timestamp,'refresh');
    }

   function full_attendance_selector($year,$timestamp) {
 
       $query = $this->db->get_where('attendance' ,array(
           
                   'year'=>$year,
                        'timestamp'=>$timestamp));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                  'year' => $year
            ))->result_array();
             
            foreach($students as $row) {
                $attn_data['class_id']   = $row['class_id'];
                $attn_data['year']       = $year;
                $attn_data['timestamp']  = $timestamp;
                $attn_data['section_id'] = $row['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
        redirect(base_url().'index.php?admin/full_manage_attendance/'.$timestamp,'refresh');
    }

    function count_unread_message_of_thread($message_thread_code) {
        $unread_message_counter = 0;
        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
        $messages = $this->db->get_where('message', array('message_thread_code' => $message_thread_code))->result_array();
        foreach ($messages as $row) {
            if ($row['sender'] != $current_user && $row['read_status'] == '0')
                $unread_message_counter++;
        }
        return $unread_message_counter;
    }

    function permission_request() {
        $data['teacher_id'] = $this->session->userdata('login_user_id');
        $data['description'] = $this->input->post('description');
        $data['title'] = $this->input->post('title');
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');

        $this->db->insert('request', $data);
    }
	function get_attendance($class_id,$section_id,$running_year,$timestamp) {
       return $this->db->get_where('attendance', array(
                                'class_id' => $class_id,
                                'section_id' => $section_id,
                                'year' => $running_year,
                                'timestamp' => $timestamp
                            ))->result_array();
    }


    function subject_message($class,$section, $exam, $gradesss, $positionsss,$remark) {
        $this->db->where('mark.class_id', $class);
        $this->db->where('mark.section_id', $section);

        $this->db->where('mark.exam_id', $exam);
        
        $this->db->join('student', 'student.student_id = mark.student_id', 'left');
        $this->db->join('subject', 'subject.subject_id = mark.subject_id', 'left'); // student.name,
        $this->db->join('exam', 'exam.exam_id = mark.exam_id', 'left'); // student.name,
        $this->db->select('mark.comment,mark.student_id, mark.mark_obtained,mark.mark_total,mark.grade,mark.position,student.name,student.phone1,student.phone2,subject.name as subject,exam.name as exam');
        $cls = $this->db->get('mark')->result_array();
		  
        if (count($cls) == 0) {
            echo "Nothing to send!!";
            exit;
        }
		
        $student_array = array();
        foreach ($cls as $cl) {
		
            $stu_id = $cl['student_id'];
            $student_array[$stu_id]['data'][] = $cl;
            $student_array[$stu_id]['name'] = $cl['name'];
            $student_array[$stu_id]['exam'] = $cl['exam'];
            $student_array[$stu_id]['phone1'] = $cl['phone1'];
            $student_array[$stu_id]['phone2'] = $cl['phone2'];
		
        }
		
		/*if($this->input->post('send_grade')==1)
		{
		   $send_grade_check=1;
		   }
		   else
		   { 
		 $send_grade_check=0;
		 }*/
		 $send_grade_check = null === $this->input->post('send_grade') ? 0 : 1;
		$send_position_check = null === $this->input->post('send_position') ? 0 : 1;
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $url = $sms->url;
        $count = 0;
        foreach ($student_array as $stu_array) {
		$notification = 0;
		
            $message = "Student Name:  " . $stu_array['name']." "
			 . "Exam Name: " . $stu_array['exam'] . ", Marks: ";
            $data = $stu_array['data'];
            $phone1 = $stu_array['phone1'];
            $phone2 = $stu_array['phone2'];

            foreach ($data as $dt) {
			     
				    /*$average=($dt['mark_obtained']/$dt['mark_total'] * 100);
					$p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grade= $res['grade'];
													  //echo $grade;
													  $position= $res['position'];
													  
                                                       }
			                                              }*/
														if($remark==1)
														{
														$rmrk= $dt['comment'];
														}
														else
														{
														$rmrk =" ";
														}
														
					if($gradesss==0 && $positionsss==0)
														{
														$msg=" ";
														}
													 if($gradesss==1 && $positionsss==1)
														{
														$msg="Grade and Position - ".$dt['grade']." ".$dt['position'];
														}
													 else if($gradesss==1 && $positionsss==0)
													  {
													     $msg="Grade - ".$dt['grade'];
													  }
													  else if($gradesss==0 && $positionsss==1)
													  {
													    $msg="Position -".$dt['position'];
														}
														
                $message .= " " . $dt['mark_obtained'] . "/" . $dt['mark_total'] . " for " . $dt['subject']." " .$msg." ".$rmrk;
			
            }
			
         if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

            $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' .$phone1.','.$phone2. '&msg=' . urlencode($common . " " . $message) . '&route=T';
			}
		else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
          $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone1.','.$phone2. '&msg=' . urlencode($message . " " . $common) . '&route=T';
		  }
		  
		  
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
                $count ++;
            }
			
        }
		
        echo $count . " messages send";
        exit;
		
    }
	
  function subject_message_individual($class,$section, $exam, $subject, $gradesss, $positionsss,$remark) {
  
  
  
  
        $this->db->where('mark.class_id', $class);
        $this->db->where('mark.section_id', $section);

        $this->db->where('mark.exam_id', $exam);
        if ($subject) {
            $this->db->where('mark.subject_id', $subject);
        }
        $this->db->join('student', 'student.student_id = mark.student_id', 'left');
        $this->db->join('subject', 'subject.subject_id = mark.subject_id', 'left'); // student.name,
        $this->db->join('exam', 'exam.exam_id = mark.exam_id', 'left'); // student.name,
        $this->db->select('mark.comment,mark.student_id, mark.mark_obtained,mark.mark_total,student.name,student.phone1,student.phone2,subject.name as subject,exam.name as exam,mark.grade,mark.position');
        $cls = $this->db->get('mark')->result_array();
		
        if (count($cls) == 0) {
            echo "Nothing to send!!";
            exit;
        }
        $student_array = array();
        foreach ($cls as $cl) {
            $stu_id = $cl['student_id'];
            $student_array[$stu_id]['data'][] = $cl;
            $student_array[$stu_id]['name'] = $cl['name'];
            $student_array[$stu_id]['exam'] = $cl['exam'];
            $student_array[$stu_id]['phone1'] = $cl['phone1'];
            $student_array[$stu_id]['phone2'] = $cl['phone2'];

        }
		/*$send_grade = null === $this->input->post('send_grade') ? 0 : 1;
			$send_position= null === $this->input->post('send_position') ? 0 : 1;*/
		
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $url = $sms->url;
        $count = 0;
        foreach ($student_array as $stu_array) {
            $message = "Student Name:  " . $stu_array['name']." "
			 . "Exam Name: " . $stu_array['exam'] . ", Marks: ";
            $data = $stu_array['data'];
            $phone1 = $stu_array['phone1'];
            $phone2 = $stu_array['phone2'];

            foreach ($data as $dt) {
			if($dt['mark_obtained']>=0 && $dt['mark_total']>0)
			{
			 $average=($dt['mark_obtained']/$dt['mark_total'] *100);
			 
				 $p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
												  $msg='';
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grade= $res['grade'];
													  $position= $res['position'];
													  }
													  }
													  if($remark==1)
														{
														$rmrk=$dt['comment'];
														}
														else
														{
														$rmrk ="";
														}
													  if($gradesss==1 && $positionsss==1)
														{
														$msg="Grade and Position - ".$dt['grade']." and ".$dt['position'];
														}
													 else if($gradesss==1 && $positionsss==0)
													  {
													     $msg="Grade - ".$dt['grade'];
													  }
													  else if($gradesss==0 && $positionsss==1)
													  {
													    $msg="Position - ".$dt['position'];
														}
														
			
                $message .= " " . $dt['mark_obtained'] . "/" . $dt['mark_total'] . " for " . $dt['subject']." " .$msg ." " .$rmrk;
				
				//$message .= " grade=". $gradesss .'+ position ='. $positionsss;
            }
			
			if($dt['mark_obtained']=='AB')
			{
			$message .="absent";
			}
			}
			
           if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){

            $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 . '&msg=' . urlencode($common . " " . $message) . '&route=T';
			}
			else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
			            $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1.','.$phone2 .  '&msg=' . urlencode($message . " " . $common) . '&route=T';
}

            $api = $url;

           $handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
            $balance = stream_get_contents($handle);


            if ($balance >= 0) {

               $api . "/sendsms?" . $location;
               $send = fopen($api . "/sendsms?" . $location, "r");
               
               $return_message_ids = stream_get_contents($send);
               $message_id_array = explode(",", $return_message_ids);
                
                $count ++;
				//$this->load->view('admin/preloader.php');
            }
			
        }
        echo $count . " messages send";
        exit;
    }
	
	
	
	 function attendance_message_bulk($class_id,$section_id, $student_id, $present, $total, $percentage, $month) {
	 
	    
        $class_id=$class_id;
		$section_id=$section_id;
		$month=$month;
    $students = $this->db->get_where('enroll', array('class_id' => $class_id,'section_id' => $section_id))->result_array();
    foreach ($students as $row) {
          $total = 0;
         $present = 0;
	   $student_names=$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
      $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id,'student_id' => $row['student_id']))->result_array();
	   foreach ($attendance as $row1) {
                                            $month_dummy = date('d', $row1['timestamp']);

                                            if ($i == $month_dummy) {
                                                $status = $row1['status'];
                                            }
                                        }
										for ($i = 1; $i <= $days; $i++) {
                                        $timestamp = strtotime($i . '-' . $month . '-' . $year[0]);
                                        $this->db->group_by('timestamp');
                                        $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id,'student_id' => $row['student_id']))->result_array();

                                        $status = 0;
                                        foreach ($attendance as $row1) {
                                            $month_dummy = date('d', $row1['timestamp']);

                                            if ($i == $month_dummy) {
                                                $status = $row1['status'];
                                            }
                                        };
                                        ?>
                                         
                                        <?php $timestamp= $row1['timestamp'];?>
                                        <td style="text-align: center;">
                                            <?php if ($status == 1) { ?>
                                                <i class="fa fa-check-circle" title="<?php echo get_phrase('Present'); ?>" data-toggle="tooltip" style="color: #00a651;"></i></i>
                                            <?php } if ($status == 2) { ?>
                                                <i class="fa fa-times-circle" title="<?php echo get_phrase('Absent'); ?>" data-toggle="tooltip" style="color: #ee4749;"></i>
                                            <?php } if ($status == 3) { ?>
                                                <i class="fa fa-certificate" title="<?php echo get_phrase('Late'); ?>" data-toggle="tooltip" style="color: #fec42d;"></i>
                                           <?php
                                            }   
										 
										
										
										
										if (0 != $status) {  
                                                $total++;
                                            }
                                            if (1 == $status || 3 == $status) {
                                                $present++;
                                            }
										$m= $present . "/" . $total;
										$percentage = round(($present / $total) * 100,2);
        
        $student_array = array();
        
            $student_id = $row['student_id'];
	   $student_phone=$this->db->get_where('student', array('phone' => $row['student_id']))->row()->phone;
            
        }
		}
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $url = $sms->url;
        $count = 0;
        foreach ($student_array as $stu_array) {
            $message = "Student Name:  " . $student_names .$m.percentage;
            //$data = $stu_array['data'];
            $reciever = $student_phone;
            foreach ($data as $dt) {
                $message .= " " . $dt['mark_obtained'] . "/" . $dt['mark_total'] . " for " . $dt['subject'];
            }
            $location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . urlencode($reciever) . '&msg=' . urlencode($message . " " . $common) . '&route=T';
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
                $count ++;
            }
        }
        echo $count . " messages send";
        exit;
    }
	public function insertCSV($data)
            {
               $p=$this->db->insert('student', $data); 
		
		
			
                return $this->db->insert_id();
            }
public function insertenroll($data1)
            {
               $p=$this->db->insert('enroll', $data1);
		
		
			
                return TRUE;
            }
			public function insert_user_data($data2)
            {
               $p=$this->db->insert('tbl_users', $data2);
		
		
			
                return $this->db->insert_id();
            }
			
	
	
	
	
	
	

    function send_new_private_message1() {
        //$this->load->helper('sendsms_helper');
        $message = $this->input->post('message');
        $timestamp = strtotime(date("Y-m-d H:i:s"));

        $student = $student_id;
        $sender = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');

        $message_thread_code = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data_message['message_thread_code'] = $message_thread_code;
        $data_message['message'] = $message;
        $data_message['sender'] = $sender;
        $data_message['timestamp'] = $timestamp;

        // $this->db->insert('message', $data_message);


        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $this->db->where('student_id', $student);
        $cls = $this->db->get('enroll')->result_array();
        $a1 = "";
        foreach ($cls as $cl) {
            $student_id = $cl['student_id'];

            $phn = $this->db->get_where('student', array('student_id' => $student_id))->row();
            $reciever = $phn->phone;
            $student_name = $phn->name;

            $data_message_thread['message_thread_code'] = $message_thread_code;
            $data_message_thread['sender'] = $sender;
            $data_message_thread['reciever'] = $reciever1;

            //$msg =  $message . "<br>" . "Name: " . $student_name."<br>";
            //  $this->db->insert('message_thread', $data_message_thread);		
        }

if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First') {
			  $location = urlencode($common).'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.urlencode($phone).'&msg=' .urlencode($message.".").'&route=T';}
			    else if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == '') {
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.urlencode($phone).'&msg=' .urlencode($message." ".$common).'&route=T';}        $api = 'http://bulksms.login2itsolutions.com';

        $handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
        $balance = stream_get_contents($handle);

        /* Error handling */

        if ($reciver_count == 0) {
            // Handle - No reciever
        }
        if ($balance < $reciver_count) {
            // Handle - Reciever count is greater than the message balance
        }

        if ($balance >= $reciver_count && $reciver_count > 0) {

            $api . "/sendsms?" . $location;
            $send = fopen($api . "/sendsms?" . $location, "r");
            //var_dump($send);
            // echo $api."/sendsms?".$location;
            // echo "<br />";
            $return_message_ids = stream_get_contents($send);
            //var_dump($return_message_ids);
            //die;
            $message_id_array = explode($return_message_ids);
            /* $message_id_array is the array which contains the message IDs */
            /* You can save it to database */
            /* $msg = "$message.." . "<br>" . "Name: " . $name . "," . "Mobile: " .$mobile . "," . "Total: " .$discount_total . '/- .' ."<br>";

              $location = '&msg=' .$msg.'Send from Login2School';
              header('Location: http://bulksms.login2itsolutions.com/sendsms?uname=beautysolution&pwd=beautysolution&senderid=BTYSLN&to=9946123453' . $location);


             */
        }
    }

    public function get_attendance_monthly($student_id) {

        $sql = "SELECT a1.`student_id`,
            YEAR(FROM_UNIXTIME(a1.`timestamp`)) as yr,
            MONTH(FROM_UNIXTIME(a1.`timestamp`)) as mnth,
            a2.present_cnt,
            a3.absent_cnt,
            a4.late_cnt,
            a5.diary_cnt

            FROM `attendance` a1 
            left JOIN 
            (SELECT count(`attendance_id`) as present_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=1 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a2 on (a1.`student_id`= a2.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a2.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a2.mnth 
            ) 
            
			left JOIN (SELECT count(`attendance_id`) as absent_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=2 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a3 on (a1.`student_id`= a3.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a3.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a3.mnth ) 
            
			left JOIN (SELECT count(`attendance_id`) as late_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=3 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a4 on (a1.`student_id`= a4.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a4.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a4.mnth ) 
			
			left JOIN (SELECT count(`attendance_id`) as diary_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=4 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a5 on (a1.`student_id`= a5.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a5.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a5.mnth )  
			 WHERE a1.`student_id`=?
            GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`))";
        $query = $this->db->query($sql, array($student_id, $student_id, $student_id, $student_id, $student_id));
        $data = $query->result();
        return (0 == count($data)) ? null : $data;
    }
	function delete_attendance($class_id,$section_id,$date1) {
        $this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('timestamp',$date1);
		

        return $this->db->delete('attendance');
    }
	function delete_unit_test($class_id,$section_id,$exam_id) {
        $this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('exam_id',$exam_id);
		

        $this->db->delete('mark');
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('exam_id',$exam_id);
		

		$this->db->delete('ranks');
		
		
		$this->db->where('exam_id',$exam_id);
		return $this->db->delete('exam');
    }
	
	function delete_unit_test_subject($class_id,$section_id,$exam_id,$subject_id) {
        $this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('exam_id',$exam_id);
		$this->db->where('subject_id',$subject_id);
		

      $this->db->delete('mark');
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('exam_id',$exam_id);
		

		 return   $this->db->delete('ranks');
    }
	
	function delete_class_bulk($class_id) {
        $this->db->where('class_id',$class_id);
		$this->db->delete('class');
		
		$this->db->where('class_id',$class_id);
		$this->db->delete('enroll');
		
		$this->db->where('class_id',$class_id);
		$this->db->delete('subject');
		
		$this->db->where('class_id',$class_id);
		$this->db->delete('exam');
		
		$this->db->where('class_id',$class_id);
		$this->db->delete('ranks');
		
		$this->db->where('class_id',$class_id);
		return $this->db->delete('mark');
		
		
    }
	function delete_section_bulk($class_id,$section_id) {
        $this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->delete('section');
		
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->delete('enroll');
		
		
		
		
		
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->delete('ranks');
		
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		return $this->db->delete('mark');
		
		
    }
	
	function delete_subject_bulk($class_id,$subject_id) {
        $this->db->where('class_id',$class_id);
		$this->db->where('subject_id',$subject_id);
		$this->db->delete('subject');
		
		
		
		$this->db->where('class_id',$class_id);
		$this->db->where('subject_id',$subject_id);
		return $this->db->delete('mark');
		
		
    }
	
	public function get_rank($classid,$sectionid,$examid)
	{
		$sql='';
		if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
		{
			$query  = "SELECT class_id,section_id,student_id,exam_id, total_marks,rank,out_of_mark
			FROM 
			( 
			SELECT class_id,section_id,student_id,exam_id, total_marks,out_of_mark , 
			@r := IF(@c = total_marks, @r, @r + 1) rank, @c := total_marks FROM ( SELECT class_id,section_id,student_id,exam_id, sum(`mark_obtained`) AS total_marks, sum(mark_total) as out_of_mark FROM mark t where `exam_id`=".$examid." and `section_id`=".$sectionid." and `class_id`=".$classid." group by `student_id` ORDER BY total_marks DESC ) t CROSS JOIN ( SELECT @r := 0, @c := NULL ) i ) q";
		}
		else
		{
			$query  = "SELECT class_id,section_id,student_id,exam_id, total_marks,rank,out_of_mark
			FROM 
			( 
			SELECT class_id,section_id,student_id,exam_id, total_marks,out_of_mark , 
			@r := IF(@c = total_marks, @r, @r + 1) rank, @c := total_marks FROM ( SELECT class_id,section_id,student_id,exam_id, sum(`mark_obtained`+internal_marks) AS total_marks, sum(mark_total+internal_total) as out_of_mark FROM mark t where `exam_id`=".$examid." and `section_id`=".$sectionid." and `class_id`=".$classid." group by `student_id` ORDER BY total_marks DESC ) t CROSS JOIN ( SELECT @r := 0, @c := NULL ) i ) q";
		}
	  /* "SELECT class_id,section_id,student_id,exam_id, total_marks,rank,out_of_mark
  FROM
(

  SELECT class_id,section_id,student_id,exam_id, total_marks,out_of_mark ,
                @r := IF(@c =  total_marks, @r, @r + 1) rank, @c :=  total_marks


    FROM 
  (
    SELECT class_id,section_id,student_id,exam_id, sum(`mark_obtained`) AS total_marks,
sum(mark_total) as out_of_mark
      FROM mark t 
      where `exam_id`=".$examid." and `section_id`=".$sectionid." and `class_id`=".$classid." group by `student_id`
          ORDER BY  total_marks DESC

  ) t CROSS JOIN 
  (
    SELECT @r := 0, @c := NULL
  ) i
) q";*/
		 
		$res=$this->db->query($query);               


		$res=$res->result_array();		
		//echo $this->db->last_query();die();
	//print_r($res);die();
		
		$dltqry="Delete from ranks where section_id=".$sectionid." and exam_id=".$examid." and class_id=".$classid."";
		$this->db->query($dltqry);
		  //echo $this->db->last_query();
     $this->db->insert_batch('ranks',$res); //echo $this->db->last_query();die();
	 return true;
	 }
	 
	 function get_home_test_rank($class_id,$section_id,$exam_id)
	 {
	 
	 }
	 
	 function class_insert($data) {
      $this->db->insert('class', $data);
	   return $this->db->insert_id();
    }
	/////////////////////////////////////////////////////////////////
	
	function branch_insert($branch_name,$branch_address,$phone1,$phone2,$email,$state,$district)
	{
		$data['branch_name']		=		$branch_name;
		$data['branch_address']		=		$branch_address;
		$data['phone1']				=		$phone1;
		$data['phone2']				=		$phone2;
		$data['email']				=		$email;
		$data['state_id']			=		$state;
		$data['district_id']		=		$district;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');
		$this->db->insert('tbl_branch',$data);
		 return $this->db->insert_id();
	}
	function designation_insert($designation,$role)
	{
		$data['designation']		=		$designation;
		$data['role']		=		$role;
		
		$this->db->insert('tbl_designation',$data);
		 return $this->db->insert_id();
	}
	
	function branch_users_insert($name,$address,$designation,$gender,$phone1,$email,$username,$password,$salary,$branch_id)
	{	$this->db->select('role');
		$this->db->from('tbl_designation');
		$this->db->where('designation_id',$designation);
		$role=$this->db->get()->row();
		$data2['username']		=$username;
	 	$data2['password']		=sha1($password);
	 	$data2['user_role_id']= $role->role;
		$data2['branch_id']= $branch_id;
	  	$this->db->insert('tbl_users', $data2);
	   	$user_id= $this->db->insert_id();
		
		$data['name']				=		$name;
		$data['address']			=		$address;
		$data['role']		        =		$designation;
		$data['sex']				=		$gender;
		$data['phone']				=		$phone1;
		$data['email']				=		$email;
		$data['username']			=		$username;
		//$data['password']			=		$password;
		$data['salary']				=		$salary;
		$data['user_id']				=		$user_id;
		$this->db->insert('staff',$data);
		 return $this->db->insert_id();
	}
	function dept_insert($dept_name,$branch_id)
	{
		$data['dept_name']		=		$dept_name;
		$data['branch_id']		=		$branch_id;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');
		$this->db->insert('tbl_department',$data);
		 return $this->db->insert_id();
	}

function branch_update($data,$branch_id)
	{
	   $this->db->where('branch_id',$branch_id);
	   $this->db->update('tbl_branch',$data);
	}
	function department_update($data,$dept_id)
	{
	   $this->db->where('dept_id',$dept_id);
	   $this->db->update('tbl_department',$data);
	}
	
	function insert_week_days($branch_id,$academic_year)
    {
	   
       $sql = "CALL insert_week_days(".$branch_id.",'".$academic_year ."')";
       $query = $this->db->query($sql);
       return $this->db->affected_rows();
	}
   
    function insert_class_timing($branch_id,$academic_year)
    {
	
    $sql = "CALL insert_class_timing(".$branch_id.",'".$academic_year ."')";
    $query = $this->db->query($sql);
    return $this->db->affected_rows();
	}


	function get_tbl_voucher($branch_id,$academic_year)
	{
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year_id',$academic_year);
		return $this->db->get('tbl_voucher')->result_array();
	}
	function insert_tbl_voucher($branch_id,$academic_year_id)
	{
		$sql 	= 	"CALL insert_tbl_voucher(".$branch_id.",".$academic_year_id.")";	//Calling the procedure to insert data to tbl_voucher.
		$query 	= 	$this->db->query($sql);
		return $this->db->affected_rows();
	}


	
function check_student_status()
	{
	 $data= $this->db->where('s.student_status_id','0');
	 return $data;
	 
	}
function student_inactive($student_id) 
	{
	$data['student_status_id']='2';
	$this->db->where('student_id', $student_id);
        $this->db->update('student',$data);
		//redirect(base_url() . 'index.php/admin/students_area/'.$class_id);
	
	
	
    }
	function expence_view($category='',$from_date1='',$to_date1='')
	{
	if($category!='' && $category!=0)
	{
	
	$this->db->where('a.category_id',$category);
	}
	if($from_date1!='' && $from_date1!=0)
	{
	 $from_date=date("Y-m-d", strtotime($from_date1));
	 $this->db->where('a.expense_date>=',$from_date);
    // $data['from_date']=$from_date;
	}
	if($to_date1!='' && $to_date1!=0)
	{
	$to_date=date("Y-m-d", strtotime($to_date1));
	//$data['to_date']=$to_date;
	$this->db->where('a.expense_date<=',$to_date);
	}
	$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
												 $this->db->where('a.is_deleted','N');
												 $this->db->where('a.created_by',$this->session->userdata('login_user_id'));
												  $this->db->join('tbl_expence_category e','e.category_id=a.category_id','LEFT');
												   $this->db->join('staff s','s.user_id=a.created_by','LEFT');
												   $this->db->join('tbl_department d','d.dept_id=a.dept_id','LEFT');
												   $this->db->order_by('a.expense_date','desc');
												   
													 return $this->db->get('tbl_add_expense a')->result_array();
													 // echo $this->db->last_query();
	
    }
	
	
	function get_fee_master_by_class($class_id)
	{
		$fee_master 	= 	$this->db->get_where('tbl_fee_master' , array('class_id' => $class_id,'is_deleted' =>'N'))->result_array();
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
	
	function get_group()
	{
		$role	=	$this->session->userdata('role');
                $yr     =   get_running_year();
		$this->db->select('a.students_group_master_id,a.students_group_master_name,a.notes,a.group_for,a.branch_id,a.entered_date,b.branch_name,c.dept_id,c.dept_name');
		$this->db->from('tbl_students_group_master a');
		$this->db->join('tbl_branch b','b.branch_id=a.branch_id');
		$this->db->join('tbl_department c','c.dept_id=a.department_id');
		$this->db->where('a.is_deleted','N');
		$this->db->where('a.academic_year_id',$yr);
		$this->db->order_by('a.students_group_master_name','ASC');
		if($role==3)
		{
			$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
		}
		if($role==4)
		{
			$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('a.department_id',$this->session->userdata('dept_id'));
		}
		return $this->db->get()->result_array();
	}
	function get_staffs($branch_id,$department_id,$add_remove,$students_group_master_id)
	{
		$this->db->select('staff_id,name');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('dept_id',$department_id);
		$this->db->where('is_deleted','N');
		if($add_remove=='add')
		{
			$this->db->where('staff_id not in(select staff_id from tbl_students_group_details where students_group_master_id="'.$students_group_master_id.'" and is_deleted="N")');
		}
		if($add_remove=='remove')
		{
			$this->db->where('staff_id in(select staff_id from tbl_students_group_details where students_group_master_id="'.$students_group_master_id.'" and is_deleted="N")');
		}
		return $this->db->get('staff')->result_array();
	}
	function check_staff_assigned($data)
	{
		$data['is_deleted']		=	'N';
		$this->db->select('students_group_details_id');
		$this->db->limit(1);
		$query	=	$this->db->get_where('tbl_students_group_details',$data)->result_array();
		return $query;
	}
	function get_branch()
	{
		$this->db->select('branch_id,branch_name');
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_branch')->result_array();
	}
	function insert_student_group($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id');
		$data['entered_date']	=	date('Y-m-d');
		$this->db->insert('tbl_students_group_master',$data);
		return $this->db->affected_rows();	
	}	
	
	function get_single_student_group($students_group_master_id)
	{
		$this->db->select('students_group_master_id,students_group_master_name,branch_id,notes,group_for');
		$this->db->where('students_group_master_id',$students_group_master_id);
		return $this->db->get('tbl_students_group_master')->row();
	}
	function update_student_group($data)
	{
		$this->db->where('students_group_master_id',$data['students_group_master_id']);
		$this->db->update('tbl_students_group_master',$data);
		return $this->db->affected_rows();	
	}
	function student_group_students($class_id,$section_id,$students_group_master_id,$add_remove)
	{
		$academic_year	=	get_running_year();
        $this->db->where('year', $academic_year);
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id',$section_id);
		$this->crud_model->check_student_status();
		$this->db->join('enroll', 'enroll.student_id = s.student_id');
		$this->db->select('s.student_id, s.name');
		if($add_remove=='add')
		{
			$this->db->where('s.student_id not in(select student_id from tbl_students_group_details where students_group_master_id="'.$students_group_master_id.'" and is_deleted="N")');
		}
		if($add_remove=='remove')
		{
			$this->db->where('s.student_id in(select student_id from tbl_students_group_details where students_group_master_id="'.$students_group_master_id.'" and is_deleted="N")');
		}
		$this->db->order_by('s.name');
		$student		=	$this->db->get('student s')->result_array();
		return 	$student;
	}
	function get_student_groups($branch_id='')
	{
		if($branch_id!='')
		{
			$this->db->where('branch_id',$branch_id);
		}
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_students_group_master')->result_array();
	}
	function add_remove_students_to_group($data,$add_remove,$group_for)
	{
		if($add_remove=='Add')
		{
			$this->db->select('students_group_details_id');
			$query	=	$this->db->get_where('tbl_students_group_details',$data)->result_array();
			if(count($query)>0)
			{
				$data['is_deleted']		=	'N';
				if($group_for=="students")
				{
					$this->db->where('student_id',$data['student_id']);
				}
				else
				{
					$this->db->where('staff_id',$data['staff_id']);
				}
				$this->db->where('students_group_master_id',$data['students_group_master_id']);
				$this->db->where('branch_id',$data['branch_id']);
				$this->db->where('academic_year_id',$data['academic_year_id']);
				$this->db->update('tbl_students_group_details',array('is_deleted'=>'N'));
			}
			else
			{
				$data['entered_by']		=	$this->session->userdata('login_user_id');
				$data['entered_date']	=	date('Y-m-d');
				$this->db->insert('tbl_students_group_details',$data);
			}
		}
		if($add_remove=='Remove')
		{
			$data['deleted_by']		=	$this->session->userdata('login_user_id');
			$data['deleted_date']	=	date('Y-m-d');
			if($group_for=="students")
			{
				$this->db->where('student_id',$data['student_id']);
			}
			else
			{
				$this->db->where('staff_id',$data['staff_id']);
			}
			$this->db->where('students_group_master_id',$data['students_group_master_id']);
			$this->db->where('branch_id',$data['branch_id']);
			$this->db->where('academic_year_id',$data['academic_year_id']); 
			$this->db->update('tbl_students_group_details',array('is_deleted'=>'Y'));
		}
		return $this->db->affected_rows();	
	}
	function get_staff_group_details($students_group_master_id)
	{
		$this->db->select('staff_id');
		$this->db->where('students_group_master_id',$students_group_master_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_students_group_details')->result_array();
	}
	function get_staff_group_details1($data)
	{
		$this->db->select('a.entered_date,b.name,b.phone,a.notes,a.students_group_details_id');
		$this->db->where('a.students_group_master_id',$data['students_group_master_id']);
		//$this->db->where('department_id',$data['department_id']);
		$this->db->where('a.branch_id',$data['branch_id']);
		$this->db->where('a.is_deleted','N');
		$this->db->where('a.academic_year_id',$data['academic_year_id']);
		//$this->db->order_by('class_id','ASC');
		//$this->db->order_by('section_id','ASC');
		$this->db->join('staff b','b.staff_id=a.staff_id','LEFT');
		$this->db->order_by('b.name','ASC');
		return $this->db->get('tbl_students_group_details a')->result_array();
	}
	function check_assigned($data)
	{
		$data['is_deleted']		=	'N';
		$this->db->select('students_group_details_id');
		$this->db->limit(1);
		$query	=	$this->db->get_where('tbl_students_group_details',$data)->result_array();
		return $query;
	}
	function get_class1($data)
	{
                $yr =   get_running_year();
		$this->db->select('class_id,name');
		$this->db->where('branch_id',$data['branch_id']);
		$this->db->where('dept_id',$data['department_id']);
		$this->db->where('academic_year',$yr);
		return $this->db->get('class')->result_array();
	}
	
	function get_students_group_details($students_group_master_id)
	{
		$this->db->select('student_id');
		$this->db->where('students_group_master_id',$students_group_master_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_students_group_details')->result_array();
	}
	function get_student_group_by_dept($dept_id='')
	{
		$this->db->select('students_group_master_id,students_group_master_name');
		$this->db->where('department_id',$dept_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_students_group_master')->result_array();
	}
	function get_student_group_details($data)
	{
		$this->db->where('students_group_master_id',$data['students_group_master_id']);
		$this->db->where('department_id',$data['department_id']);
		$this->db->where('branch_id',$data['branch_id']);
		$this->db->where('is_deleted','N');
		$this->db->where('academic_year_id',$data['academic_year_id']);
		//$this->db->order_by('class_id','ASC');
		//$this->db->order_by('section_id','ASC');
		$this->db->order_by('name','ASC');
		return $this->db->get('view_student_group_details')->result_array();
	}
	
	function check_members_exist($students_group_master_id)
	{
                $yr =   get_running_year();
		$this->db->select('students_group_details_id');
		$this->db->where('students_group_master_id',$students_group_master_id);
		$this->db->where('is_deleted','N');
		$this->db->where('academic_year_id',$yr);
		$this->db->limit(1);
		$result	=	$this->db->get('tbl_students_group_details')->result_array();
		return count($result);
	}
	
	
	function get_students_home_test_marks($class_id,$section_id,$exam_id,$subject_id,$running_year) {
    return  $this->db->get_where('tbl_home_test_mark' , array(
        'home_test_id' => $exam_id, 
		'class_id' => $class_id,
        'section_id' => $section_id, 'year' => $running_year,
        'subject_id' => $subject_id))->result_array();
    }
	
	function get_students_entrance_test_marks($class_id,$section_id,$exam_id,$subject_id,$running_year) {
    return  $this->db->get_where('tbl_entrance_test_mark' , array(
        'entrance_test_id' => $exam_id, 
		'class_id' => $class_id,
        'section_id' => $section_id, 'year' => $running_year,
        'subject_id' => $subject_id))->result_array();
    }
	
	function get_section($class_id='')
	{
		$year	=	get_running_year();
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year',$year);
		return $this->db->get('section')->result_array();
	}
	
	function get_teacher_subjects($data)
	{
		if(array_key_exists("class_id",$data))
		{
			$this->db->where('st.class_id',$data['class_id']);
		}
		if(array_key_exists("section_id",$data))
		{
			$this->db->where('st.section_id',$data['section_id']);
		}
		if(array_key_exists("teacher_id",$data))
		{
			$this->db->where('st.teacher_id',$data['teacher_id']);
		}
		$this->db->select('s.name as subject_name,s.subject_id');
		$this->db->join('subject s','s.subject_id=st.subject_id');
		$this->db->group_by('s.subject_id');
		return $this->db->get('subject_teacher st')->result_array();
	}
	
	function get_late_absent_students($status)
	{
		$role	=	$this->session->userdata('role');
		$this->db->select('a.*,b.name as student_name,b.admission_number,c.name as class_name,d.name as section_name,e.dept_name,f.branch_name');
		$this->db->from('attendance a');
		$this->db->join('student b','b.student_id=a.student_id');
		$this->db->join('class c','c.class_id=a.class_id');
		$this->db->join('section d','d.section_id=a.section_id');
		$this->db->join('tbl_department e','e.dept_id=a.dept_id');
		$this->db->join('tbl_branch f','f.branch_id=a.branch_id');
		if($role == 3)
		{
			$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
		}
		if($role > 3)
		{
			$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('a.dept_id',$this->session->userdata('dept_id'));
		}
		$this->db->where('a.timestamp',strtotime(date('Y-m-d')));
		$this->db->where('a.status',$status);
        return $this->db->get()->result_array();
	}
	
	function get_group_for($group_master_id)
	{
	    $this->db->select('group_for');
	    $query  =   $this->db->get_where('tbl_students_group_master',array('students_group_master_id'=>$group_master_id))->row();
	    if(isset($query))
	    {
	        return $query->group_for;
	    }
	}
	
/*********** Course completed and Discontinued start ***************/	
	function update_course_status($data)
	{
		$this->db->trans_start();
		$this->db->debug			=	FALSE;
		$data1['student_id']		=	$data['student_id'];
		$data1['year_id']			=	$data['year'];
		$data1['inserted_by']		=	$this->session->userdata('login_user_id');
		$data1['inserted_date']		=	date('Y-m-d');
		
		if($data['status']=='completed')
		{
			$data1['course_status']	=	'3';
		}
		else if($data['status']=='discontinued')
		{
			$data1['course_status']	=	'4';
			$data1['note']			=	$this->input->post('reason');
		}
		$this->db->insert('tbl_students_course_status',$data1);
		
		$this->db->set('student_status_id','1');
		$this->db->where('student_id',$data['student_id']);
		$this->db->update('student');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return 0;
		}
		else if ($this->db->trans_status() === TRUE)
		{
			return 1;
		}
		
	}	
	function course_status_report($data)
	{
		$this->db->select('a.student_id,a.note,b.name,b.class_name,b.section_name,b.phone1,c.status');
		$this->db->from('tbl_students_course_status a');
		$this->db->join('view_students b','b.student_id=a.student_id and b.year=a.year_id');
		$this->db->join('student_status c','c.id=a.course_status');
		$this->db->join('student d','d.student_id=b.student_id');
		if($data['status']=='completed')
		{
			$this->db->where('a.course_status','3');
		}
		else if($data['status']=='discontinued')
		{
			$this->db->where('a.course_status','4');
		}
		if($data['dept_id']=='All' || $data['dept_id']=='all')
		{
			$this->db->where('d.branch_id',$data['branch_id']);
		}
		else if($data['dept_id']!='All' && $data['dept_id']!='all' && $data['dept_id']!='')
		{
			if($data['class_id']=='All' || $data['class_id']=='all')
			{
				$this->db->where('d.dept_id',$data['dept_id']);
			}
			else if($data['class_id']!='All' && $data['class_id']!='all' && $data['class_id']!='')
			{
				$this->db->where('b.class_id',$data['class_id']);
				if($data['section_id']!='')
				{
					$this->db->where('b.section_id',$data['section_id']);
				}
			}
		}
		$query	=	$this->db->get()->result_array();
		return $query;
	}
/*********** Course completed and Discontinued end *****************/	

/*********** Photo Gallery start ***************/	
	
	function gallery($keyword='',$date_from='',$date_to='',$year='')
	{
		if($year=='')
		{
			$year	=	get_running_year();
		}
		if($keyword!='')
		{
			$this->db->like('title',$keyword);
		}
		if($date_from!='')
		{
			$this->db->where('date>=',date('Y-m-d',strtotime($date_from)));
		}
		if($date_to!='')
		{
			$this->db->where('date<=',date('Y-m-d',strtotime($date_to)));
		}
		$this->db->select('id,title,url,date');
		$this->db->where('year_id',$year);
		$this->db->order_by('id','desc');
		$this->db->group_by('id');
		$result		=	$this->db->get('view_gallery_master')->result_array();
		return $result;
		
	}
	function gallery_master_insert($data)
	{
		$this->db->insert('tbl_gallery_master',$data);
		return $this->db->insert_id();
	}
	function gallery_details_insert($data)
	{
		$this->db->insert('tbl_gallery_details',$data);
		return $this->db->insert_id();
	}
	function gallery_master_delete($gallery_master_id)
	{
		if($gallery_master_id!='')
		{
			$dir	=	'./uploads/photo_gallery/'.$gallery_master_id;
			$this->deleteDirectory($dir);
			
			$this->db->where('gallery_master_id',$gallery_master_id);
			$this->db->delete('tbl_gallery_details');
			
			$this->db->where('id',$gallery_master_id);
			$this->db->delete('tbl_gallery_master');
			
			return $this->db->affected_rows();
		}	
	}
	//Delete files inside a folder
	function deleteDirectory($dir) 
	{
		if (!file_exists($dir)) 
		{
			return true;
		}
	
		if (!is_dir($dir)) 
		{
			return unlink($dir);
		}
	
		foreach (scandir($dir) as $item) {
			if ($item == '.' || $item == '..') {
				continue;
			}
	
			if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
				return false;
			}
	
		}
	
		return rmdir($dir);
	}
	function view_gallery_images($gallery_master_id)
	{
		$year				=	get_running_year();
		
		$this->db->select('id,title,description');
		$this->db->where('id',$gallery_master_id);
		$this->db->where('year_id',$year);
		$result['master']				=	$this->db->get('tbl_gallery_master')->row();
		
		$this->db->select('id as gallery_details_id,description as details_description,url');
		$this->db->where('gallery_master_id',$gallery_master_id);
		$result['details']				=	$this->db->get('tbl_gallery_details')->result_array();

		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
		return $result;
	}
	function gallery_master_update($gallery_master_id,$title,$description)
	{
		if($gallery_master_id!='')
		{
			$this->db->where('id',$gallery_master_id);
			$this->db->set('title',$title);
			$this->db->set('description',$description);	
			$this->db->update('tbl_gallery_master');
			return $this->db->affected_rows();	
		}	
	}
	function gallery_details_update($gallery_details_id,$description)
	{ 
		if($gallery_details_id!='')
		{
			$this->db->where('id',$gallery_details_id);
			$this->db->set('description',$description);	
			$this->db->update('tbl_gallery_details');
			return $this->db->affected_rows();	
		}	
	}
	function gallery_details_delete($gallery_details_id)
	{
		if($gallery_details_id!='')
		{
			$url	=	$this->db->get_where('tbl_gallery_details',array('id'=>$gallery_details_id))->row()->url;
			$dir	=	'./'.$url;
			$this->deleteDirectory($dir);
			
			$this->db->where('id',$gallery_details_id);
			$this->db->delete('tbl_gallery_details');
			
			return $this->db->affected_rows();
		}	
	}
/*********** Photo Gallery end ***************/	
/*********** Graph Start ***************/	
	function view_graph_marks($data)
	{
		$year	=	get_running_year();
		$this->db->select('a.class_id,b.student_id,b.name');
		$this->db->from('enroll a');
		$this->db->join('student b','b.student_id=a.student_id');
		$this->db->where('a.year',$year);
		$this->db->where('a.class_id',$data['class_id']);
		$this->db->where('a.section_id',$data['section_id']);
		if($data['student_id']!='')
		{
			$this->db->where('a.student_id',$data['student_id']);
		}
		$this->db->where('b.student_status_id','0');
		$result['students']	=	$this->db->get()->result_array();
		
		return $result;
	}
/*********** Graph End ***************/	

/***********/
    function check_class_exist($class_name,$dept_id,$branch_id)
    {
        $year   =   get_running_year();
        $this->db->where('academic_year',$year);
        $this->db->where('dept_id',$dept_id);
        $this->db->where('branch_id',$branch_id);
        $this->db->where('name',$class_name);
        $result =   $this->db->get('class')->row();//echo $this->db->last_query();die();
        return count($result);
    }
    function check_section_exist($section_name,$class_id)
    {
        $year   =   get_running_year();
        $this->db->where('academic_year',$year);
        $this->db->where('class_id',$class_id);
        $this->db->where('name',$section_name);
        $result =   $this->db->get('section')->row();//echo $this->db->last_query();die();
        return count($result);
    }
/***********/

/******* Admission Report Start **********/
	function get_admission_report($data)
	{
		$year		=	get_running_year();
		$this->db->select('a.student_id,a.name,a.class_name,a.date,a.section_name,a.phone1,a.birthday,a.parent,b.admission_number,c.branch_name,d.dept_name');
		$this->db->from('view_students a');
		$this->db->join('student b','b.student_id=a.student_id');
		$this->db->join('tbl_branch c','c.branch_id=b.branch_id');
		$this->db->join('tbl_department d','d.dept_id=b.dept_id');
		$this->db->where('a.year',$year);
		$this->db->where('b.branch_id',$data['branch_id']);
		$this->db->where('b.dept_id',$data['dept_id']);
		if($data['class_id']!='All')
		{
			$this->db->where('a.class_id',$data['class_id']);
			if($data['section_id']!='all')
			{
				$this->db->where('a.section_id',$data['section_id']);
			}
		}
		$this->db->where('a.date>=',strtotime(date('d M,Y',strtotime($data['from_date']))));
		$this->db->where('a.date<=',strtotime(date('d M,Y',strtotime($data['to_date']))));
		$this->db->order_by('a.date','DESC');
		$this->db->order_by('a.name','ASC');
		$result		=	$this->db->get()->result_array();
		return $result;
	}

/******* Admission Report End ***********/
/******* Section Migration Start ********/
	function update_section($student_id,$class_id,$year,$to_section,$from_section)
	{
		//Update attendance table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->set('section_id',$to_section);
		$this->db->update('attendance');
		
		//Update mark table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->set('section_id',$to_section);
		$this->db->update('mark');
		
		//Update ranks table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->set('section_id',$from_section);
		$this->db->delete('ranks');
		
		//Update tbl_entrance_test_mark table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->where('section_id',$from_section);
		$this->db->delete('tbl_entrance_test_mark');
		
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->where('section_id',$to_section);
		$et		=	$this->db->get('tbl_entrance_test_mark')->row();
		
		if(!empty($et))
		{
			$data	=	array(
							'student_id'		=>	$student_id,
							'subject_id'		=>	$et->subject_id,
							'class_id'			=>	$class_id,
							'section_id'		=>	$to_section,
							'entrance_test_id'	=>	$et->entrance_test_id,
							'exam_name'			=>	$et->exam_name,
							'date_exam'			=>	$et->date_exam,
							'mark_total'		=>	$et->mark_total,
							'year'				=>	$year,
							'remarks'			=>	$et->remarks,
							'branch_id'			=>	$et->branch_id,
							'dept_id'			=>	$et->dept_id
							);
			$this->db->insert('tbl_entrance_test_mark',$data);				
		}
		
		//Update tbl_home_test_mark table
		
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->where('section_id',$from_section);
		$this->db->delete('tbl_home_test_mark');
		
		
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->where('section_id',$to_section);
		$ht		=	$this->db->get('tbl_home_test_mark')->row();
		
		if(!empty($ht))
		{
			$data	=	array(
							'student_id'	=>	$student_id,
							'subject_id'	=>	$ht->subject_id,
							'class_id'		=>	$class_id,
							'section_id'	=>	$to_section,
							'home_test_id'	=>	$ht->home_test_id,
							'exam_name'		=>	$ht->exam_name,
							'date_exam'		=>	$ht->date_exam,
							'mark_total'	=>	$ht->mark_total,
							'year'			=>	$year,
							'remarks'		=>	$ht->remarks,
							'branch_id'		=>	$ht->branch_id,
							'dept_id'		=>	$ht->dept_id
							);
			$this->db->insert('tbl_home_test_mark',$data);				
		}
		
		
		//Update tbl_special_fee_collection_master table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year_id',$year);
		$this->db->set('section_id',$to_section);
		$this->db->update('tbl_special_fee_collection_master');
		
		//Update tbl_transport_students_bus_fee_collection_master table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year',$year);
		$this->db->set('section_id',$to_section);
		$this->db->update('tbl_transport_students_bus_fee_collection_master');
		
		//Update tbl_fee_collection_master table
		$this->db->where('admission_number',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year_id',$year);
		$this->db->set('batch_id',$to_section);
		$this->db->update('tbl_fee_collection_master');
		
		//Update tbl_students_fee_master table
		$this->db->where('admission_number',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year_id',$year);
		$this->db->set('batch_id',$to_section);
		$this->db->update('tbl_students_fee_master');
		
		//Update tbl_sms_delivery_details table
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->set('section_id',$to_section);
		$this->db->update('tbl_sms_delivery_details');
		
	}
/******* Section Migration End **********/
	function have_data($student_id,$class_id,$year)
	{
		$count	=	0;
		$this->db->select('attendance_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$this->db->limit(1);
		$count	+=	$this->db->count_all_results('attendance');
		
		$this->db->select('mark_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$count	+=	$this->db->get('mark')->row();
		
		$this->db->select('rank_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$count	+=	$this->db->count_all_results('ranks');
		
		$this->db->select('mark_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$count	+=	$this->db->count_all_results('tbl_entrance_test_mark');
		
		$this->db->select('mark_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('year',$year);
		$count	+=	$this->db->count_all_results('tbl_home_test_mark');
		
		$this->db->select('special_fee_collection_master_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year_id',$year);
		$count	+=	$this->db->count_all_results('tbl_special_fee_collection_master');
		
		$this->db->select('bus_fee_collection_master_id');
		$this->db->where('student_id',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year',$year);
		$count	+=	$this->db->count_all_results('tbl_transport_students_bus_fee_collection_master');
		
		$this->db->select('fee_collection_master_id');
		$this->db->where('admission_number',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year_id',$year);
		$count	+=	$this->db->count_all_results('tbl_fee_collection_master');
		
		$this->db->select('students_fee_master_id');
		$this->db->where('admission_number',$student_id);
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year_id',$year);
		$this->db->where('is_deleted','N');
		$count	+=	$this->db->count_all_results('tbl_students_fee_master');
		
		if($count>0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
	}
	function get_stud_count_in_section($section_id, $running_year = '')
	{
		$this->db->join('student b','b.student_id=a.student_id and b.student_status_id=0');
		$this->db->where('a.section_id',$section_id);
		if (!empty($running_year)) {
			$this->db->where('a.year', $running_year);
		}
		$this->db->from('enroll a');
		$stud_count	=	$this->db->get()->num_rows();
		return $stud_count;
	}
        function get_year_name($year_id)
	{
		$this->db->select('academic_year');
		$this->db->where('acdemic_year_id',$year_id);
		$year	=	$this->db->get('tbl_academic_year')->row();
		if(isset($year))
		{
			return $year->academic_year;
		}
		else
		{
			return "";
		}
	}
///////////////////////////////////////////////////////////////////////////////////////
        function get_op_bal_years($student_id)
        {
            $qry    =   "select DISTINCT(fee_from_year_id) as fee_from_year_id,student_id,academic_year,acdemic_year_id from "
                        . "((select DISTINCT(a.fee_from_year_id) as fee_from_year_id,a.student_id,b.academic_year,b.acdemic_year_id from tbl_opening_balance a join tbl_academic_year b on b.acdemic_year_id=a.fee_from_year_id where a.student_id=".$student_id.") "
                        . "union all (select DISTINCT(a.fee_from_year_id) as fee_from_year_id,a.student_id,b.academic_year,b.acdemic_year_id from tbl_opening_balance_transport a join tbl_academic_year b on b.acdemic_year_id=a.fee_from_year_id where a.student_id=".$student_id.")) tbl";   
            $prev_years		=	$this->db->query($qry)->result_array();   
            return $prev_years;
        }
        function get_op_bal_details($student_id,$year)
        {
            $query	=	"(select a.*,b.fee_head from tbl_opening_balance a inner join tbl_fee_heads b on b.fee_head_id=a.fee_head_id where a.student_id=".$student_id." and a.fee_from_year_id=".
					$year." ) ".
					"union all ".
					"(select id,student_id,fee_from_year_id,fee_to_year_id,999999 as fee_head_id,fee_reference_id,fee_amount,fee_balance,'Trasportation Fee' as fee_head from tbl_opening_balance_transport ".
					"where student_id=".$student_id." and fee_from_year_id=".$year." )";
            $op_bal	=	$this->db->query($query)->result_array();	
            return $op_bal;
        }
		
		function certificate_issue_return_data($department,$class_id,$section_id,$from_date,$to_date,$student_id){
			$year = get_running_year();
			$query  = "(select a.student_id,a.academic_year_id,a.issued_on,b.certificate_id,b.return_date,b.issue_details_id,c.name,c.class_name,c.section_name"
					. " from tbl_certificate_issue_master a "
					. "join tbl_certificate_issue_details b on b.issue_master_id=a.issue_master_id "
					. "join view_students c on a.student_id=c.student_id ";
	
				if($class_id!='' && $class_id!='all')
				{
					$query  =   $query." and c.class_id=".$class_id;
				}
				if($section_id!='' && $section_id!='all')
				{
					$query  =   $query." and c.section_id=".$section_id;
				}
				if($student_id!='' && $student_id!='all')
				{
					$query  =   $query." and a.student_id=".$student_id;
				}
				if($from_date!='' && $to_date!='')
				{
					$query  =   $query." and DATE_FORMAT(a.issued_on,'%Y-%m-%d') between '" . date('Y-m-d',strtotime($from_date)) . "' and '" . date('Y-m-d',strtotime($to_date))."'";
				}
	
				$query  =   $query." )";
			 // 	echo $query;die;
				$data = $this->db->query($query)->result_array();
			//	print_r($data);
				return $data;
		}

		function student_certificate_data($department,$class_id,$section_id,$student_id){
			$year = get_running_year();
			$query  = "(select a.certificates_submitted,c.student_id,c.name,c.class_name,c.section_name"
					. " from view_students c join student a on a.student_id=c.student_id ";
	
				if($class_id!='' && $class_id!='all')
				{
					$query  =   $query." and c.class_id=".$class_id;
				}
				if($section_id!='' && $section_id!='all')
				{
					$query  =   $query." and c.section_id=".$section_id;
				}
				if($student_id!='' && $student_id!='all')
				{
					$query  =   $query." and c.student_id=".$student_id;
				}
				$query  =   $query." )";
			 // 	echo $query;die;
				$data = $this->db->query($query)->result_array();
			//	print_r($data);
				return $data;
		}

}
