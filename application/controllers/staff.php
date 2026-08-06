<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class staff extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function staff_dashboard()
	{
		$this->load->view('staff/staff_dashboard.php');
	}
	public function student_add()
	{
		$this->load->view('staff/add_student.php');

	}
	
	function get_class_section($class_id)
     {
	    $class_option=$this->input->post('class');
		$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
    }
	public function print_students_list()
{
		$this->load->view('staff/print_students_list_full.php');
}
public function print_students_list1()
	{
		$class_id        =$this->input->post('class_id');
		$section_id       =$this->input->post('section_id');
		
		$condition="";
		if ($class_id=='ALL' && $section_id=='ALL')
		{
		$condition = $condition ;
		}
		elseif ($class_id !='ALL' && $section_id=='ALL')
		$condition = " where  class_id=". $class_id;
		else
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
                                    $image_url = base_url() . 'uploads/logo.png';
									echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
								    echo "<tr><td colspan='7'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
								echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Roll No.</td><td colspan='1'  align='left'>Name</td><td colspan='1'  align='left'>Phone1</td><td colspan='1'  align='left'>Phone2</td><td colspan='1'  align='left'>Address</td><td colspan='1'  align='left'>Email</td></tr>";
							 
								foreach ($query_result as $data)
								{
								
								
								echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".get_student_roll($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_name($data['student_id'])."<td colspan='1'  align='left'>".get_student_phone1($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_phone2($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_address($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_email($data['student_id'])."</td></tr>";
								
									//$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}
								$filename = "StudentsList.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
			
								//$this->exportExcelData($dataToExports);
								die();
			}

		/////////////////////////////////
		
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Students List";
		$page_data['page_name']        = 'print_students_list1';
        $page_data['page_title']       = 'Students List';
		$page_data['query_result']	   = $query_result;
		$this->load->view('staff/print_students_list1', $page_data);
	}
	public function student_area_print_report_section($class_id,$section_id)
	{
	
		$query_result  = $this->db->get_where('enroll',array('class_id'=>$class_id,'section_id'=>$section_id))->result_array();

		////////////////////////////// Export to Excel
		
		if (isset($_POST['chk_excel3']))
		{
									ob_start();
									ob_get_clean();
									$total = 0;
									$i=1;
                                    $image_url = base_url() . 'uploads/logo.png';
									echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
								    echo "<tr><td colspan='7'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
								echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Roll No.</td><td colspan='1'  align='left'>Name</td><td colspan='1'  align='left'>Phone1</td><td colspan='1'  align='left'>Phone2</td><td colspan='1'  align='left'>Address</td><td colspan='1'  align='left'>Email</td></tr>";
							  echo  "\t<b>Class:  </b>\t" . get_class_name($class_id). "\n";
								
								foreach ($query_result as $data)
								{
								
								
								echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".get_student_roll($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_name($data['student_id'])."<td colspan='1'  align='left'>".get_student_phone1($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_phone2($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_address($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_email($data['student_id'])."</td></tr>";
								
									//$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}
								$filename = "StudentsList.doc";
								header("Content-Type: application/vnd.ms-word");
								header("Content-Disposition: attachment; filename=".$filename);
			
								//$this->exportExcelData($dataToExports);
								die();
			}

		/////////////////////////////////
		
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Students List";
		$page_data['page_name']        = 'print_students_list1';
        $page_data['page_title']       = 'Students List';
		$page_data['query_result']	   = $query_result;
		$this->load->view('staff/print_students_list1', $page_data);
	}




	
	 public function do_upload($Image,$Imagename,$path)
	{
		
        $image=false;
		$config['upload_path'] =$path;
		$config['allowed_types'] = 'jpeg,pdf,jpg';
		$config['max_size']	= '1024';
		$config['overwrite']  = TRUE;
		$config['file_name']  = $Imagename;
		
		$this->load->library('upload', $config);
		if($this->upload->do_upload($Image))
		{
			$image=$this->upload->data(); 
			$image=$image['file_name'];
		}
		else
		echo $this->session->set_flashdata('error_message', strip_tags($this->upload->display_errors()));
		return $image;	
		
		
		
	
	}
	
	
	
	
	
	function add_student()
    {
	$running_year = get_running_year();
	 	$data['name']           = $this->input->post('name');
		$data['birthday']       = $this->input->post('birthday');
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
		//$message['message']=$this->input->post('message');
		if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
			{
				$data['school']      = $this->input->post('school');
			}
		$notification =$this->input->post('notification');
		//echo $notification;die();
  		$msg =$this->input->post('additional_msg');
		//echo $msg;
		//die();
		$msg11=$this->input->post('message');
        $this->load->Model('crud_model');
        $student_id =  $this->crud_model->student_insert($data);
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
		$this->crud_model->student_insert_bulk($data2);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
		$additional=$this->input->post('message');
		if($notification =='1'  && $msg=='1')
		{
			$this->crud_model->student_insert_sms($data['name'],$data['phone1'],$data['phone2'],$additional);
		}
		if($notification =='1' && $msg=='')
		{
			$this->crud_model->student_insert_sms1($data['name'],$data['phone1'],$data['phone2']);
		}
          redirect(base_url() . 'index.php/staff/students_area/'.$data2['class_id']);
	}
	
	
	public function teacher_add()
	{
		$this->load->view('staff/add_teacher.php');
	}
	
	function add_teacher()
    {
             $data['name']        = $this->input->post('name');
             $data['username']    = $this->input->post('user_name');
             $data['salary']      = $this->input->post('salary');
			  $data['birthday']      = $this->input->post('birthday');
             $data['sex']         = $this->input->post('sex');
             $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
           $data['password']    = sha1($this->input->post('password'));
		
         // $this->load->Model('crud_model');
            $teacher_id = $this->crud_model->teacher_insert($data);
			 //$a=$this->input->post('userfile');
			
             move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            redirect(base_url() . 'index.php/staff/teacher_view/', 'refresh');
    }
	public function teacher_view()
	{
		$this->load->view('staff/teacher_view.php');
	}
	function teacher_profile($teacher_id)
    {
       
        //$page_data['page_name']  = 'staff_profile';
        //$page_data['page_title'] =  get_phrase('Profile');
        $page_data['teacher_id']  =  $teacher_id;
        $this->load->view('staff/teacher_profile', $page_data);
    }
	
	function teacher_edit($param1 = '', $param2 = '', $param3 = '')
    {
        
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['username']        = $this->input->post('username');
            $data['salary']      = $this->input->post('salary');
			$data['sex']         = $this->input->post('sex');
            $data['birthday']        = $this->input->post('birthday');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php/staff/teacher_profile/'. $param2, 'refresh');
        }
        if ($param1 == 'change_password') 
        {
           $data['new_password'] = sha1($this->input->post('new_password'));
        $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) 
            {
                $this->db->where('teacher_id', $param2);
                $this->db->update('teacher', array('password' => $data['new_password']));
            } 
            redirect(base_url() . 'index.php/staff/teacher_profile/'. $param2, 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            redirect(base_url() . 'index.php/staff/teacher_view/', 'refresh');
        }
        
    }
	
	
	
	
	public function staff_add()
	{
		$this->load->view('staff/add_staff.php');
	}
	
	function add_staff()
    {
    		$data['name']        = $this->input->post('name');
			$data['username']    = $this->input->post('user_name');
            $data['salary']      = $this->input->post('salary');
			 $data['birthday']      = $this->input->post('birthday');
            $data['sex']         = $this->input->post('sex');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $data['password']    = sha1($this->input->post('password'));
			$this->load->Model('crud_model');
            $staff_id =$this->crud_model->staff_insert($data);
			 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $staff_id . '.jpg');
            redirect(base_url() . 'index.php/staff/staff_view/', 'refresh');
    }
	public function staff_view()
	{
		$this->load->view('staff/staff_view.php');
	}
	function staff_profile($staff_id)
    {
       
        //$page_data['page_name']  = 'staff_profile';
        //$page_data['page_title'] =  get_phrase('Profile');
        $page_data['staff_id']  =  $staff_id;
        $this->load->view('staff/staff_profile', $page_data);
    }
	
	function staff_edit($param1 = '', $param2 = '', $param3 = '')
    {
        
        if ($param1 == 'do_update') {
            $data['name']        = $this->input->post('name');
            $data['username']        = $this->input->post('username');
            $data['salary']      = $this->input->post('salary');
			$data['sex']         = $this->input->post('sex');
            $data['birthday']        = $this->input->post('birthday');
            $data['address']     = $this->input->post('address');
            $data['phone']       = $this->input->post('phone');
            $data['email']       = $this->input->post('email');
            $this->db->where('staff_id', $param2);
            $this->db->update('staff', $data);
           move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php/staff/staff_profile/'. $param2, 'refresh');
        }
        if ($param1 == 'change_password') 
        {
           $data['new_password'] = sha1($this->input->post('new_password'));
        $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) 
            {
                $this->db->where('staff_id', $param2);
                $this->db->update('staff', array('password' => $data['new_password']));
            } 
            redirect(base_url() . 'index.php/staff/staff_profile/'. $param2, 'refresh');
        }
        if ($param1 == 'delete') 
        {
            $this->db->where('staff_id', $param2);
            $this->db->delete('staff');
            redirect(base_url() . 'index.php/staff/staff_view/', 'refresh');
        }
        //$page_data['staff']   = $this->db->get('staff')->result_array();
       // $page_data['page_name']  = 'staff';
        //$page_data['page_title'] = get_phrase('Manage-staff');
        //$this->load->view('backend/index', $page_data);
    }
		
	/*public function students_area($class_id = '')
	{
		$this->load->view('staff/student_area.php');

	}*/
	
	public function full_attendance()
	{
		$this->load->view('staff/full_attendance.php');
	}
	
	
	 function search($search_key = '') 
    {
        if ($this->session->userdata('staff_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(base_url(), 'refresh');
        }
        if ( $_POST ) {
            redirect(base_url() . 'index.php/staff/search/' . $this->input->post('search_key') , 'refresh');
        }
        $page_data['search_key']    =   $search_key;
        $page_data['page_name']     =   'search';
        $page_data['page_title']    =   Search-Result;
      //  $this->load->view('backend/index', $page_data);
	  
	   redirect(base_url() . 'index.php/staff/search/'. $param2, 'refresh');
    }

	
	function full_attendance_selector()
    {
        //$data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
		$a=$this->input->post('timestamp');
        $b  = str_replace('/','-',$a);
		$data['timestamp']=strtotime($b);
		//$data['section_id'] = $this->input->post('section_id');
		$query = $this->db->get_where('attendance' ,array(
        //'class_id'=>$data['class_id'],
        //'section_id'=>$data['section_id'],
        'year'=>$data['year'],
        'timestamp'=>$data['timestamp']));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                  'year' => $data['year']
            ))->result_array();
             
            foreach($students as $row) {
                $attn_data['class_id']   = $row['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
				
                $attn_data['section_id'] = $row['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
        redirect(base_url().'index.php/staff/full_manage_attendance/'.$data['timestamp'],'refresh');
    }
	
	public function full_manage_attendance($timestamp)
	{
	
	//$class_name = $this->db->get_where('student')
      //->row()->name;
        //$page_data['class_id'] = $class_id;
        $data['timestamp'] = $timestamp;
       // $page_data['page_name'] = 'full_manage_attendance';
        //$section_name = $this->db->get_where('section' , array(
            //'section_id' => $section_id
       // ))->row()->name;
        //$page_data['section_id'] = $section_id;
		$this->load->view('staff/full_manage_attendance.php',$data);
	}
	
	function full_attendance_update($timestamp = '')
    {
	
	     $date=$this->input->post('timestamp1');
		 $message1['message']=$this->input->post('message');
        $running_year = get_running_year();
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'year'=>$running_year,'timestamp'=>$timestamp))->result_array();
			$late_notification = null === $this->input->post('late_notification') ? 0 : 1;
			$absent_notification= null === $this->input->post('absent_notification') ? 0 : 1;
			$diary_notification= null === $this->input->post('no_diary_notification') ? 0 : 1;
			$sms = $this->db->get('sms_settings')->row();
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
        foreach($attendance_of_students as $row) {
			
			$notification = 0;
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
			if( 1 == $absent_notification && 2 == $attendance_status ){
				$notification = 1;
				$msg = " is absent on ".$date;
			}
			if( 1 == $late_notification && 3 == $attendance_status ){
				$notification = 1;
				$msg = " is late on ".$date;
			}
			if( 1 == $late_notification && 4 == $attendance_status ){
				$notification = 1;
				$msg = "has no Diary on ".$date;
			}
			
			if($notification =='1'){
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
			$phone2  = $stu->phone2;

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
			
			
            $this->db->where('attendance_id' , $row['attendance_id']);
            $this->db->update('attendance' , array('status' => $attendance_status));
        }
		//$this->db->insert('attendance_message',$message1);
        redirect(base_url().'index.php/staff/full_manage_attendance/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }
	
	public function daily_attendance()
	{
		$this->load->view('staff/daily_attendance.php');
	}
	
	function get_section($class_id) 
    {
          $page_data['class_id'] = $class_id; 
          $this->load->view('staff/section_holder' , $page_data);
    }
	
	function attendance_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
		
        $data['year']       = $this->input->post('year');
        //$data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
		$a=$this->input->post('timestamp');
        $b  = str_replace('/','-',$a);
		$data['timestamp']=strtotime($b);
		//echo $data['class_id'];
		////$data['section_id'];
		//$data['timestamp'];
		//die();
		
        $query = $this->db->get_where('attendance' ,array(
            'class_id'=>$data['class_id'],
                'section_id'=>$data['section_id'],
                    'year'=>$data['year'],
                        'timestamp'=>$data['timestamp']));
        if($query->num_rows() < 1) 
        {
            $students = $this->db->get_where('enroll' , array(
                'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']
            ))->result_array();
            foreach($students as $row) {
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
     redirect(base_url().'index.php/staff/manage_attendance/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
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

	
		$this->load->view('staff/manage_attendance',$data);
	}
	function attendance_update($class_id = '' , $section_id = '' , $timestamp = '')
    {
	      $date=date('d/m/Y', $timestamp);
			
         $running_year = get_running_year();
        $attendance_of_students = $this->db->get_where('attendance' , array(
            'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp))->result_array();
			$late_notification = null === $this->input->post('late_notification') ? 0 : 1;
			$absent_notification= null === $this->input->post('absent_notification') ? 0 : 1;
			$diary_notification= null === $this->input->post('no_diary_notification') ? 0 : 1;
			$additional_message=$this->input->post('additional_msg');

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
			 if($notification =='1' &&  $additional_message==''){
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
			if($notification =='1' &&  $additional_message=='1'){
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
			 
			 
			 
			 
			 if($notification =='' &&  $additional_message=='1'){
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
			$phone2  = $stu->phone2;
				$atn=$this->input->post('message');
				$name  = $stu->name;
			  $message = $name. " ".$atn;
			  
			 
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
        redirect(base_url().'index.php/staff/manage_attendance/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
    }
	public function attendance_report()
	{
		$data['month']        = date('m');
		$this->load->view('staff/attendance_report.php',$data);
	}
	
	function attendance_report_selector()
    {
        $data['class_id']   = $this->input->post('class_id');
        $data['year']       = $this->input->post('year');
        $data['month'] 	    = $this->input->post('month');
        $data['section_id'] = $this->input->post('section_id');
	//echo 	$data['class_id'] .'/'. $data['year'] .'/'.$data['month'] .'/'.$data['section_id'];
	//die();
        redirect(base_url().'index.php/staff/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'],'refresh');
    }
	
	 function report_attendance_view($class_id = '' , $section_id = '', $month = '') 
     {
         
        $data['class_id'] 	= $class_id;
        $data['month']    	= $month;
        $data['section_id'] = $section_id; 
        $this->load->view('staff/report_attendance_view.php',$data);
     }
	 function attendance_print($class_id ,$section_id ,$month) {
        $page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
         $page_data['month'] =$month;
        
        $this->load->view('staff/attendance_print' , $page_data);
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
			$month1=$month;
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
				  $month="August";
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
			//die();
			$message_id_array = explode($return_message_ids); 
			/* $message_id_array is the array which contains the message IDs */
			/* You can save it to database */
			
			
	      
		  
        }
		
       
          //echo $message;
           redirect(base_url() . 'index.php/staff/report_attendance_view/'.$class_id.'/'.$section_id.'/'.$month1,'refresh');

		 
		 
    }
	function create_exam($param1 = '', $param2 = '' , $param3 = '')
    {
	  $page_data['exams']      = $this->db->get('exam')->result_array();
       
        if ($param1 == 'create') 
        {
            $data['name']    = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['class_id'] = $this->input->post('class');
            $data['year']    = get_running_year();
            $this->db->insert('exam', $data);
        $this->load->view('staff/view_exam', $page_data);
        }
        if ($param1 == 'edit') 
        {
            $data['name']    = $this->input->post('name');
            $data['comment'] = $this->input->post('comment');
            $data['class_id'] = $this->input->post('class');

            $data['year']    = get_running_year();
            
            $this->db->where('exam_id', $param2);
            $this->db->update('exam', $data);
            redirect(base_url() . 'index.php/staff/create_exam/', 'refresh');
        } 
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            redirect(base_url() . 'index.php/staff/create_exam/', 'refresh');
        }
          if ($param1 == 'new') 
        {
            $this->load->view('staff/create_exam', $page_data);
        }
		  $page_data['exams']      = $this->db->get('exam')->result_array();
        $this->load->view('staff/view_exam', $page_data);
    }
	public function edit_unit_exam($exam_id)
	{
		$data['exam_id']=$exam_id;
		$this->load->view('staff/edit_unit_exam.php',$data);
	}
	
	public function upload_marks()
	{
		$this->load->view('staff/upload_marks.php');

	}
	function marks_get_subject($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/marks_get_subject' , $page_data);
    }
	
	function marks_get_subject_delete($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/marks_get_subject_delete' , $page_data);
    }
	
	function marks_selector()
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
        redirect(base_url() . 'index.php/staff/marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'] , 'refresh');
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
        $this->load->view('staff/marks_upload', $page_data);
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
        redirect(base_url().'index.php/staff/marks_upload/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');
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
        redirect(base_url().'index.php/staff/marks_upload/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');
    }
	
	function grade($param1 = '', $param2 = '' , $param3 = '')
    {
        
        if ($param1 == 'create') 
        {
            $data['grade']    = $this->input->post('grade');
           $data['minimum_range'] = $this->input->post('rangemin');
           $data['maximum_range'] = $this->input->post('rangemax');
            $data['value'] = $this->input->post('value');
           $data['position'] = $this->input->post('position');

            $data['year']    = get_running_year();
            $this->db->insert('grade', $data);
            redirect(base_url() . 'index.php/staff/grade/', 'refresh');
        }
       if ($param1 == 'edit') 
        {
            $data['grade']    = $this->input->post('grade');
            $data['minimum_range'] = $this->input->post('rangemin');
           $data['maximum_range'] = $this->input->post('rangemax');

            $data['value'] = $this->input->post('value');
            $data['position'] = $this->input->post('position');

            $data['year']    = get_running_year();
            
            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            redirect(base_url() . 'index.php/staff/grade/', 'refresh');
        } 
        /*if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            redirect(base_url() . 'index.php?staff/semesters/', 'refresh');
        }*/
        $page_data['grade']      = $this->db->get('grade')->result_array();
        //$page_data['page_name']  = 'grade';
       // $page_data['page_title'] = get_phrase('grade');
        $this->load->view('staff/grade', $page_data);
    }
	public function edit_grade($grade_id)
	{
		$data['grade_id']=$grade_id;
		$this->load->view('staff/grade_edit.php',$data);
	}
	function rank($class_id = '' ,$section_id= '' ,$exam_id = '' ) 
	{  
        
      //$exam_id=0;$class_id=0;$section_id=0;
        if ($this->input->post('operation') == 'selection') 
		{
		   $class_id   = $this->input->post('class_id');
			 $section_id   = $this->input->post('section_id');
            $exam_id    = $this->input->post('exam_id');
          
           $this->crud_model->get_rank($class_id,$section_id,$exam_id);
		
		//}		//$previous=$current;
        
		$page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section_id;
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) 
			{
                redirect(base_url() . 'index.php/staff/rank/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
            } else 
			{
                redirect(base_url() . 'index.php/staff/rank/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section_id;
        //$page_data['page_info'] = 'Exam marks';
        
        //$page_data['page_name']  = 'rank';
        //$page_data['page_title'] = get_phrase('Tabulation');
        $this->load->view('staff/rank', $page_data);
    
    }
	function subject_message($class,$section, $exam, $grade, $position, $remark){
		 
		$this->crud_model->subject_message($class,$section, $exam,  $grade, $position, $remark);
		
		
	}
	function subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark){
		
		$this->crud_model->subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark);
		
	}
	
	function get_report($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/get_report' , $page_data);
    }
	function get_prog_report($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/get_prog_report' , $page_data);
    }
	
	function rank_print($class_id ,$section_id ,$exam_id) {
       
        $page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
        $page_data['exam_id'] =$exam_id;
        
        $this->load->view('staff/rank_print' , $page_data);
    }
	 function tab_sheet($class_id = '' ,$section_id= '' ,$exam_id = '' ) {
        
        
        if ($this->input->post('operation') == 'selection') {
		    $page_data['class_id']   = $this->input->post('class_id');
			 $page_data['section_id']   = $this->input->post('section_id');
            $page_data['exam_id']    = $this->input->post('exam_id');
            
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) {
                redirect(base_url() . 'index.php/staff/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
            } else {
                redirect(base_url() . 'index.php/staff/tab_sheet/', 'refresh');
            }
        }
        $page_data['exam_id']    = $exam_id;
        $page_data['class_id']   = $class_id;
        $page_data['section_id'] = $section_id;
       
        $this->load->view('staff/tab_sheet', $page_data);
    
    }
	public function mark_print_report($class_id,$section_id,$exam_id)
	{
		

		
		
		
		$condition = " where  class_id=". $class_id. " and section_id=". $section_id;
		$sql = "select student_id from enroll " . $condition ;
	
		$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		
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
					
									$arrangeData[$v['subject']] 		= " ".$v['mark_obtained'].'/'.$v['mark_total'];
									
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
        $this->load->view('staff/tab_sheet_print' , $page_data);
    }
	
	function news_add() 
    {
        //$page_data['page_name'] = 'enviar_noticia';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/news_add');
    }
	function news($param1 = '', $param2 = '') 
    {
        if ($param1 == 'create') 
        {
            $news_code = $this->crud_model->create_news();
            redirect(base_url() . 'index.php/staff/news_view/details/' . $news_code , 'refresh');
        }
       /* if ($param1 == 'mark_as_archive') 
        {
            $this->db->where('news_code' , $param2);
            $this->db->update('news' , array('news_status' => 0));
        }*/        
		if ($param1 == 'delete') 
        {
            $this->db->where('news_code' , $param2);
            $this->db->delete('news');
            redirect(base_url() . 'index.php/staff/news/', 'refresh');
        }

        //$page_data['page_name'] = 'news';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/news');
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
        $this->load->view('staff/news_overview', $page_data);
    }
	
	 function news_message($param1 = '', $param2 = '', $param3 = '') 
    {
       
        if ($param1 == 'add') 
        {
            $this->crud_model->create_news_message($param2);
            redirect(base_url() . 'index.php/staff/news_view/details/' . $param2, 'refresh');
        }
    }
	
	function homework_add() 
    {    
        //$page_data['page_name'] = 'homework_add';
        //$page_data['page_title'] = get_phrase('Send-Homework');
        $this->load->view('staff/homework_add');
    }
	function get_class_subject($class_id) 
    {
        $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
        foreach ($subject as $row) 
        {
            
            echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
           
        }
    }

	function homework($param1 = '', $param2 = '') 
    {
        if ($param1 == 'create') 
        {
            $homework_code = $this->crud_model->homework_create();
            redirect(base_url() . 'index.php/staff/homeworkroom/details/' . $homework_code , 'refresh');
        }
        if ($param1 == 'edit') 
        {
            $this->crud_model->update_homework($param2);
            redirect(base_url() . 'index.php/staff/homeworkroom_edit/edit/' . $param2 , 'refresh');
        }
        if ($param1 == 'delete'){
            $this->crud_model->delete_homework($param2);
            redirect(base_url() . 'index.php/staff/homework', 'refresh');
        }

        //$page_data['page_name'] = 'homework';
        //$page_data['page_title'] = get_phrase('Homework');
        $this->load->view('staff/homework');
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
        $this->load->view('staff/homework_room', $page_data);
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
        $this->load->view('staff/homework_edit', $page_data);
    }
	
	function study_material($task = "", $document_id = "")
    {
        
        if ($task == "create")
        {
            $this->crud_model->save_study_material_info();
            redirect(base_url() . 'index.php/staff/study_material' , 'refresh');
        }
        if ($task == "update")
        {
            $this->crud_model->update_study_material_info($document_id);
            redirect(base_url() . 'index.php/staff/study_material' , 'refresh');
        }
        if ($task == "delete")
        {
            $this->crud_model->delete_study_material_info($document_id);
            redirect(base_url() . 'index.php/staff/study_material');
        }
        
        $data['study_material_info']    = $this->crud_model->select_study_material_info();
        //$data['page_name']              = 'study_material';
        //$data['page_title']             = get_phrase('Study-Material');
        $this->load->view('staff/study_material', $data);
    }
	function study_material_add()
    {
     
        $this->load->view('staff/modal_study_material_add.php');
    }
	
	public function study_material_edit($id)
	{
	$data['id']=$id;
		$this->load->view('staff/study_material_edit.php',$data);
	}
	function view_complaints() 
    {
        //$page_data['page_name'] = 'veiw_complaints';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/view_complaints');
    }
	
	function complaint_description_view($param1 = '' , $param2 = '')
    {
        if ($param1 == 'details') 
        {
            //$page_data['room_page'] = 'details';
            $page_data['report_code'] = $param2;
        }
		//$page_data['report_code']=
      	//$page_data['page_name']   = 'complaint_details'; 
       // $page_data['page_title']  = get_phrase('Details');
        $page_data['page_title'] =$this->db->get_where('reporte_alumnos',array('report_code'=>$param2))->row()->title;
        $this->load->view('staff/complaint_details', $page_data);
    }
	function complaint_remark($param1 = '', $param2 = '')
    {
       

        if($param1 == 'create')
        {
            $this->crud_model->complaint_remark($param2);
			
            redirect(base_url() . 'index.php/staff/view_complaints/', 'refresh');
        }

        
    }
	function view_enquiry() 
    {
       // $page_data['page_name'] = 'veiw_enquiry';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/veiw_enquiry');
    }
	
	function enquiry_description_view($param1 = '' , $param2 = '')
    {
        
        if ($param1 == 'details') 
        {
            //$page_data['room_page'] = 'details';
            $page_data['enquiry_id'] = $param2;
        }
        //$page_data['page_name']   = 'enquiry_details'; 
        //$page_data['page_title']  = get_phrase('Details');
        $page_data['page_title']= $this->db->get_where('enquiry',array('enquiry_id'=>$param2))->row()->title;
        $this->load->view('staff/enquiry_details', $page_data);
    }
	
	function enquiry_remark($param1 = '', $param2 = '')
    {
        
        if($param1 == 'create')
        {
            $this->crud_model->enquiry_remark($param2);
			}
			
            redirect(base_url() . 'index.php/staff/view_enquiry/', 'refresh');
        }
		
		function general_settings($param1 = '', $param2 = '', $param3 = '')
    {
       

        if ($param1 == 'do_update') {
             
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);
 
            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('rtl');
            $this->db->where('type' , 'rtl');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);
			
            $data['description'] = $this->input->post('running_year');
            $this->db->where('type' , 'running_year');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
        if ($param1 == 'socials') {
             
            $data['description'] = $this->input->post('facebook_url');
            $this->db->where('type' , 'facebook_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twitter_url');
            $this->db->where('type' , 'twitter_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('google_url');
            $this->db->where('type' , 'google_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('linkedin_url');
            $this->db->where('type' , 'linkedin_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('pinterest_url');
            $this->db->where('type' , 'pinterest_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('instagram_url');
            $this->db->where('type' , 'instagram_url');
            $this->db->update('settings' , $data);
 
            $data['description'] = $this->input->post('dribbble_url');
            $this->db->where('type' , 'dribbble_url');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('youtube_url');
            $this->db->where('type' , 'youtube_url');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
        if ($param1 == 'ad') {
            $data['description'] = $this->input->post('ad');
            $this->db->where('type' , 'ad');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }

        if ($param1 == 'upload_slider') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider1.png');
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
        if ($param1 == 'upload_slider2') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider2.png');
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
        if ($param1 == 'upload_slider3') 
        {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider3.png');
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
        if($param1 == 'skin_colour')
        {
            $data['description'] = $this->input->post('skin_colour');
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            redirect(base_url() . 'index.php/staff/general_settings/', 'refresh');
        }
       // $page_data['page_name']  = 'system_settings';
        //$page_data['page_title'] = get_phrase('System-Settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('staff/general_settings', $page_data);
    }
	
	function staff_settings($param1 = '', $param2 = '', $param3 = '')
    {
        

        if ($param1 == 'do_update') {
             
            

            $data['description'] = $this->input->post('rtl');
            $this->db->where('type' , 'rtl');
            $this->db->update('settings' , $data);
			 
			$data['description'] = $this->input->post('parent_login');
            $this->db->where('type' , 'parent_login');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('school');
            $this->db->where('type' , 'school');
            $this->db->update('settings' , $data);
            
			$data['description'] = $this->input->post('pos_common_word');
            $this->db->where('type' , 'pos_common_word');
            $this->db->update('settings' , $data);
            
			 $data['description'] = $this->input->post('diary');
            $this->db->where('type' , 'diary');
            $this->db->update('settings' , $data);
			
            $data['description'] = $this->input->post('rank');
            $this->db->where('type' , 'rank');
            $this->db->update('settings' , $data);
			
			 $data['description'] = $this->input->post('bus_details');
            $this->db->where('type' , 'bus_details');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('fee_details');
            $this->db->where('type' , 'fee_details');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('expence');
            $this->db->where('type' , 'expence');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('full_attendance');
            $this->db->where('type' , 'full_attendance');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('msg_student_name');
            $this->db->where('type' , 'msg_student_name');
            $this->db->update('settings' , $data);
			
			
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('complaint_view');
            $this->db->where('type' , 'complaint_view');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('enquiry_view');
            $this->db->where('type' , 'enquiry_view');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('homework');
            $this->db->where('type' , 'homework');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('study_meterial');
            $this->db->where('type' , 'study_meterial');
            $this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('delete');
            $this->db->where('type' , 'delete');
            $this->db->update('settings' , $data);
			
			
			$data['description'] = $this->input->post('bus_route');
            $this->db->where('type' , 'bus_route');
            $this->db->update('settings' , $data);
			

            
        
            redirect(base_url() . 'index.php/staff/staff_settings/', 'refresh');
        }
        
        if ($param1 == 'ad') {
            $data['description'] = $this->input->post('ad');
            $this->db->where('type' , 'ad');
            $this->db->update('settings' , $data);
        
            redirect(base_url() . 'index.phpstaff/staff_settings/', 'refresh');
        }

       
        //$page_data['page_name']  = 'settings';
        //$page_data['page_title'] = get_phrase('System-Settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('staff/staff_settings', $page_data);
    }
		
		function advanced_settings() 
    {
	 
       // $page_data['page_name'] = 'settings3';
       // $page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/advanced_settings');
		
    }
	function attendance_delete() 
    {
       // $page_data['page_name'] = 'attendance_delete';
       // $page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/attendance_delete');
    }
	
	function delete_attendance() 
    {
	$class_id=$this->input->post('class_id');
	$section_id=$this->input->post('section_id');
	$date=$this->input->post('timestamp');
	
	 $date1=strtotime($date);
	
	 $this->crud_model->delete_attendance($class_id,$section_id,$date1);
	
       redirect(base_url() . 'index.php/staff/attendance_delete/', 'refresh');
    }
	
	function unit_test_delete() 
    {
       // $page_data['page_name'] = 'unit_test_delete';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/unit_test_delete');
    }
	function marks_get_subject1($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/unit_test_delete1' , $page_data);
    }
	
	function delete_unit_test() 
    {
	$class_id=$this->input->post('class_id');
	 $section_id=$this->input->post('section_id');

	 $exam_id=$this->input->post('exam_id');
			
	 	
	 $this->crud_model->delete_unit_test($class_id,$section_id,$exam_id);
	
       redirect(base_url() . 'index.php/staff/unit_test_delete/', 'refresh');
    }


	function subject_unit_test_delete() 
    {
       // $page_data['page_name'] = 'subject_delete';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/subject_unit_test_delete');
    }
	
	function delete_class() 
    {
       // $page_data['page_name'] = 'subject_delete';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/delete_class');
    }
	
	function delete_section() 
    {
       // $page_data['page_name'] = 'subject_delete';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/section_delete');
    }
	
	function delete_subject() 
    {
       // $page_data['page_name'] = 'subject_delete';
        //$page_data['page_title'] = get_phrase('Send-News');
        $this->load->view('staff/delete_subject');
    }
	
	
	function marks_get_subject2($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/delete_get_subject' , $page_data);
    }
	
	function delete_unit_test_subject() 
    {
	$class_id=$this->input->post('class_id');
	 $section_id=$this->input->post('section_id');

	 $exam_id=$this->input->post('exam_id');
	 $subject_id=$this->input->post('subject_id');

			
	 	
	 $this->crud_model->delete_unit_test_subject($class_id,$section_id,$exam_id,$subject_id);
	
       redirect(base_url() . 'index.php/staff/subject_unit_test_delete/', 'refresh');
    }
	
	function delete_class_bulk() 
    {
	$class_id=$this->input->post('class_id');
	

			
	 	
	 $this->crud_model->delete_class_bulk($class_id);
	
       redirect(base_url() . 'index.php/staff/delete_class/', 'refresh');
    }
	
	function delete_section_bulk() 
    {
	$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
	

			
	 	
	 $this->crud_model->delete_section_bulk($class_id,$section_id);
	
       redirect(base_url() . 'index.php/staff/section_delete/', 'refresh');
    }
	
	
	function delete_subject_bulk() 
    {
	$class_id=$this->input->post('class_id');
		$subject_id=$this->input->post('subject_id');
	

			
	 	
	 $this->crud_model->delete_subject_bulk($class_id,$subject_id);
	
       redirect(base_url() . 'index.php/staff/delete_subject/', 'refresh');
    }
	
	
	function message()
    {
        
        $this->load->view('staff/message');
    }
	
	function get_absent_student_for_message($class, $section, $date){
		
		//$dateObj = DateTime::createFromFormat('d-m-Y', $date);
		//var_dump($dateObj);

		$timestamp = strtotime($date);
		//$password = $sms->password;
		//$common = $sms->common_word;
		$this->db->where('class_id', $class);
        $this->db->where('section_id',$section);
		 $this->db->where('timestamp',$timestamp);
		 $this->db->where('status','2');
		 $this->db->join('student', 'student.student_id = attendance.student_id');
		 $this->db->select('attendance.student_id, student.name');
		$cls = $this->db->get('attendance')->result_array();
		$data['student'] = $cls;
		$this->load->view('staff/absent_message_student_list', $data);
	 
	}
	function get_special_message_students($class='', $section=''){
	
		 $this->db->where('class_id', $class);
        $this->db->where('section_id',$section);
		 
		
		 $this->db->join('enroll', 'enroll.student_id = student.student_id');
		 $this->db->select('student.student_id, student.name');
		$cls = $this->db->get('student')->result_array();
		$data['student'] =$cls;
		//echo "dfdgdfgdgds<br>"; 
		//echo "Class : $class , Section : $section";
		$this->load->view('staff/special_message_list', $data);
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
		  var_dump($location);
		 die();
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
			  				redirect(base_url() . 'index.php/staff/message' , 'refresh');

        
    }
	
	function absent_message() 
    {
       
    $absent_date=$this->input->post('timestamp');
	 
	  
		
		
            $message_thread_code = $this->crud_model->send_new_absent_message($absent_date);
			
            
        
    }
	
	function new_notification_message() {
	    $class =$this->input->post('class');
		//echo $class;
	   $section = $this->input->post('section');
					//echo $section;
	    //$content = $this->input->post('message');
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
				  //echo  $student_name;
				//  die();  
	
				  
    
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $url = $sms->url;
       // $reciever = $ph;
        $web_url=$sms->web_url;
					  if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True')
			  {
			  $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$v['phone1']." and password ".$v['phone1']."";
			  }
			 
			  if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'False'){
			   $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after.";
			   }
			   
			   
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';

		   
		  
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
			  ?><script>alert("Message Send Successfully")</script><?php 
			  				redirect(base_url() . 'index.php/staff/message' , 'refresh');

        
    }
	function special_message() 
    {
       
      
		
		
           $message_thread_code = $this->crud_model->send_new_special_message();
            
        
    }
	function new_malayalam_message() {
	    $class =$this->input->post('class');
		//echo $class;
	   $section = $this->input->post('section');
					//echo $section;
	    $content = $this->input->post('message');
		//echo $content;
     	     $student_id =  $this->db->get_where('enroll' , array('class_id' => $class,'section_id' =>$section))->result_array();
			 foreach($student_id as $row)
			 {
			    // echo $row['student_id'];
				   $stu= $this->db->get_where('student' , array('student_id' =>$row['student_id']))->result_array();
				   foreach($stu as $v){
				  $phone1= $v['phone1'];
				  $phone2= $v['phone2'];

				  $student_name= $v['name'];      
	//echo $student_name;
	//die();
				  
    
        $sms = $this->db->get('sms_settings')->row();
        $sender_id = $sms->sender_id;
        $username = $sms->username;
        $password = $sms->password;
        $common = $sms->common_word;
        $url = $sms->url;
       
       
            
           // $reciever = $ph;
          
		 // echo $reciever;
		  
		
             //$message=$common. " Hi ".$student_name." ".$content;  
			 //echo $message; 
          
           $message= $student_name." ".$content." "; 
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
		   //die();
          $api = $url;

            $handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
            $balance = stream_get_contents($handle);

//" http://domainname/sendunicodesms?uname=yourUsername&pwd=yourPassword&senderid=yourSenderid&to=9444xxxxxx&msg=yourunicodeMessage&route=yourRoute " 
 

  
  
  
  
            if ($balance >= 0) {

              $api . "/sendunicodesms?" . $location;
			//	die();
                $send = fopen($api . "/sendunicodesms?" . $location, "r");
				
                $api . "/sendunicodesms?" . $location;
                $return_message_ids = stream_get_contents($send);
                $message_id_array = explode(",", $return_message_ids);
                /* $message_id_array is the array which contains the message IDs */
                /* You can save it to database */
               
				
          
         }
		   }
              }
			  ?><script>alert("Message Send Successfully")</script><?php
			  				redirect(base_url() . 'index.php/staff/message/malayalam_message' , 'refresh');

        
    }
	function get_grade($g)
     {
	 
        $sections = $this->db->get_where('mark' , array('id' => $g
        ))->result_array();
        foreach ($sections as $row) {
        echo  $row['exam_id'] ;
        }
    }
	
	public function class_add()
	{
		$this->load->view('staff/add_class.php');
				//redirect(base_url().'index.php?staff/create')

	}
	
	public function view_subject($class_id= '')
	{
	    
	    $page_data['class_id']=$class_id;
	    $page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
		$this->load->view('staff/view_subject.php',$page_data);
				//redirect(base_url().'index.php?staff/create')

	}
	 function add_class()
    {
      $data['name']         = $this->input->post('name');
      $this->load->Model('crud_model');
	  $class_id =$this->crud_model->class_insert($data);
	  $data2['class_id']  =   $class_id;
            $data2['name']      =   'A';
			$this->load->Model('crud_model');
			$this->crud_model->manage_classes($data2);
            
           redirect(base_url() . 'index.php/staff/view_class/', 'refresh');  
	}
	
	function delete_student($student_id,$class_id)
    {
	        $data['class_id']=$class_id;
	         $this->crud_model->student_delete($student_id);
           redirect(base_url() . 'index.php/staff/students_area/'.$data['class_id']);

	}		
		
		
	public function view_class()
	{
	 $page_data['classes']    = $this->db->get('class')->result_array();
		$this->load->view('staff/view_class.php',$page_data);
				//redirect(base_url().'index.php?staff/create')

	}
	public function new_subject_add($class_id)
	{
	$page_data['class_id'] =$class_id;
		$this->load->view('staff/add_subject.php',$page_data);
				//redirect(base_url().'index.php?staff/create')

	}
	public function view_class_edit($class_id)
	{
	$this->load->Model('crud_model');
	$class_name['class_id']=$class_id;
	 $class_name['a']    = $this->crud_model->get_class_name($class_id);
		$this->load->view('staff/view_class_edit.php',$class_name);
				//redirect(base_url().'index.php?staff/create')

	}
	public function subject_edit($class_id,$subject_id,$teacher_id)
	{
	$data['class_id']=$class_id;
	$data['subject_id']=$subject_id;
	$data['teacher_id']=$teacher_id;
		$this->load->view('staff/subject_edit.php',$data);
				//redirect(base_url().'index.php?staff/create')

	}
	public function update_subject($class_id)
	{  
	        $data['class_id']	=$this->input->post('class_id');

			$p               	= $this->input->post('subject');
	        $data['name']       = $this->input->post('name');
			$data['teacher_id']	=$this->input->post('teacher_id');
	        
			$this->crud_model->subject_edit($data,$p);
           redirect(base_url() . 'index.php/staff/view_subject/'. $data['class_id'], 'refresh'); 
     }       
	public function edit_class()
	{
	 $data['class_id']         = $this->input->post('cls_id');
	 $data['name']         = $this->input->post('name');
	 $this->load->Model('crud_model');
	 $this->crud_model->update_classes($data['class_id'],$data['name']);
	  redirect(base_url() . 'index.php/staff/view_class/', 'refresh'); 

	}
	public function view_class_delete($class_id)
	{
	$this->load->Model('crud_model');
	
	$this->crud_model->delete_classes($class_id);
	 
		  redirect(base_url() . 'index.php/staff/view_class/', 'refresh'); 

	}
	public function subject_delete($subject_id,$class_id)
	{
				$this->crud_model->subject_delete($subject_id);

	 
		  redirect(base_url() . 'index.php/staff/view_subject/'.$class_id, 'refresh'); 

	}
	 function section($class_id = '')
    {
	 if ($class_id == '')
        $class_id           =   $this->db->get('class')->first_row()->class_id;
        
        $page_data['class_id']   = $class_id;
        $this->load->view('staff/add_section.php',$page_data);
    }
	public function view_section_add($class_id)
	{
	  	$this->load->Model('crud_model');
		$class_name['class_id']=$this->input->post('class');
		 $class_name['a']    = $this->crud_model->get_class_name($class_name['class_id']);
		 $class_name['cls']	=$class_id;
		$this->load->view('staff/view_section_add.php',$class_name);
				//redirect(base_url().'index.php?staff/create')

	}
	function add_section()
    {
	        $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->load->Model('crud_model');
			$this->crud_model->add_section($data);
            redirect(base_url() . 'index.php/staff/section/' . $data['class_id'] , 'refresh');
}
function section_edit($class_id,$section_id)
    {
	        $data['class_id']       = $class_id;
            $data['section_id']   =   $section_id;
      		$this->load->view('staff/section_edit.php',$data);
      }
	  function update_section()
    {
	      $param2=$this->input->post('section');
	       $data['name']       =   $this->input->post('name');
            $data['class_id']   =   $this->input->post('class_id');
			
            $data['teacher_id'] =   $this->input->post('teacher_id');
              $this->load->Model('crud_model');
			$this->crud_model->edit_section( $data,$param2);
			 redirect(base_url() . 'index.php/staff/section/' . $data['class_id'] , 'refresh');
      }
	  function section_delete($section_id)
      {
		$section_row = $this->db->get_where('section', array('section_id' => $section_id))->row();
		$class_id = isset($section_row->class_id) ? $section_row->class_id : '';
		$this->load->Model('crud_model');
		$this->crud_model->delete_section($section_id);
		if (!empty($class_id)) {
			redirect(base_url() . 'index.php/staff/section/' . $class_id, 'refresh');
		} else {
			redirect(base_url() . 'index.php/staff/section', 'refresh');
		}
      }
			 function add_subject($class_id)
    {
	

			 $data['name']       = $this->input->post('name');
            $data['class_id']   = $class_id;
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['year']       = get_running_year();
			$this->crud_model->subject_add($data);
			 redirect(base_url() . 'index.php/staff/view_subject/'.$class_id, 'refresh');
			}
		function class_migration(){
	         $this->load->view('staff/class_migration.php');
    }
	function migrate_check($class, $section){
		
		 
		$cls = $this->crud_model->migrate_check($class,$section);
		$data['student'] =$cls;
		 
		$this->load->view('staff/check_migration.php', $data);
	
	}
	function class_migrate()
	{
	 
	  $student = $this->input->post('student');
        if (count($student) > 0) {
	$class=$this->input->post('class1');
	$section=$this->input->post('section1');
	
	
	    foreach ($student as $stud) {
                $student_id = $stud;
				$data['class_id']=$class;
				$data['section_id']=$section;
				$this->crud_model->class_migrate($data,$stud);
				
				
	//var_dump($stud);
	}}
	//var_dump($class);
	//var_dump($section);
    redirect(base_url() . 'index.php/staff/class_migration/');	
	}
	function sms_template() 
    {
	
	  
	$page_data['sms']    = $this->db->get('sms_template')->result_array();
	$this->load->view('staff/sms_template.php',$page_data);
	}
	function add_template() 
    {
	$this->load->view('staff/add_template.php');
	}
	function template_edit($id) 
    {
	$data['t_id']           =$id;
	$this->load->view('staff/edit_template.php',$data);
	}
	
	function report() 
    {
	$this->load->view('staff/report.php');
	}
	 function report_delivery() 
    {
	 $from=$this->input->post('timestamp1'); 
	 $to=$this->input->post('timestamp2'); 
	 
		  $sms = $this->db->get('sms_settings')->row();

	$sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
			  $web_url=$sms->web_url;
	
				$location = "/".urlencode($username)."/".urlencode($password)."/".urlencode($sender_id)."/".urlencode($from)."00:01/".urlencode($to)."23:59";
				$api = $url;
				
				header('Content-type: text/csv');
				header('Content-Disposition: attachment; filename="sms.csv"');
				$file = readfile($api."/getdeliverysender".$location, "r");
		//echo $api."/getdeliverysender".$location;
			}
	function update_template($id) 
    {
	$data['title']           = $this->input->post('name');
            $data['content']           = $this->input->post('content');
			
			$this->crud_model->template_edit($data,$id);
			 redirect(base_url() . 'index.php/staff/sms_template/', 'refresh');
	}
	function insert_template() 
    {
	$data['title']           = $this->input->post('name');
            $data['content']           = $this->input->post('content');
			$this->crud_model->template_create($data);
			//$this->db->insert('sms_template', $data);
             redirect(base_url() . 'index.php/staff/sms_template/', 'refresh');
	}
	function template_delete($id) 
    {
	$this->crud_model->template_delete($id);
	 redirect(base_url() . 'index.php/staff/sms_template/', 'refresh');
	}
	
	function get_template_content($id)
     {
	 
        $sections = $this->db->get_where('sms_template' , array('id' => $id
        ))->result_array();
        foreach ($sections as $row) {
        echo  $row['content'] ;
        }
    }
	
	 function student_bulk($param1 = '')
    {
       
        if($param1 == 'add_bulk_student') {
            $names     = $this->input->post('name');
            $rolls     = $this->input->post('roll');
        //    $parents    = $this->input->post('parent');
           $schools    = $this->input->post('school');

            $date           = strtotime(date("d M,Y"));
            $phones    = $this->input->post('phone');
			
        //    $genders   = $this->input->post('sex');
            $student_entries = sizeof($names);
			$notification = null === $this->input->post('notification') ? 0 : 1;
            for($i = 0; $i < $student_entries; $i++) {
                $data['name']     =   $names[$i];
				$data['username']     =   $phones[$i];
				$data['password']     =   $names[$i];
             //   $data['parent']    =   $parents[$i];
                 $data['school']    =   $schools[$i];
                $data['date']           = strtotime(date("d M,Y"));
                $data['phone1']    =   $phones[$i];
               // $data['sex']      =   $genders[$i];
                if($data['name'] == '' || $data['phone1'] == '')
                    continue;
                $this->db->insert('student' , $data);
                $student_id = $this->db->insert_id();
                $data2['enroll_code']   =   substr(md5(rand(0, 1000000)), 0, 7);
                $data2['student_id']    =   $student_id;
                $data2['class_id']      =   $this->input->post('class_id');
                if($this->input->post('section_id') != '') {
                    $data2['section_id']    =   $this->input->post('section_id');
                }
                $data2['roll']          =   $rolls[$i];
                $data2['date_added']    =   strtotime(date("Y-m-d H:i:s"));
                $data2['year']          =   get_running_year();
                $this->db->insert('enroll' , $data2);
				
				if($notification =='1'){
			  
			  $sms = $this->db->get('sms_settings')->row();
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
			  $web_url=$sms->web_url;
			  if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == 'True') {
			  $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$data['phone1']." and password ".$data['phone1']."";
			  }
			 else if($this->db->get_where('settings' , array('type' =>'parent_login'))->row()->description == '') { 
			   $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after.";
			   }
			   
			   
			  $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.urlencode($data['phone1']).'&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		
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
	      }
				
            }
            redirect(base_url() . 'index.php/staff/student_bulk/' . $this->input->post('class_id') , 'refresh');
        }           
        //$page_data['page_name']  = 'student_bulk';
        //$page_data['page_title'] = get_phrase('Student-Bulk');
        $this->load->view('staff/student_bulk');
    }
	
	function get_sections($class_id)
    {
        $page_data['class_id'] = $class_id;
        $this->load->view('staff/student_bulk_sections' , $page_data);
    }
		  function students_area($class_id = '')
	{
	    $data['class_id']=$class_id;
		$this->load->view('staff/student_area1.php',$data);

	}
	function individual_message($student_id)
    { 
	                $message_send  = $this->input->post('message_send');
			

        
        $running_year = get_running_year();
      
	   $this->crud_model->individual_message($student_id,$message_send);
    

		 
		 
    }
	
	
	function update_student($student_id)
    {
	 $data1['roll']           = $this->input->post('roll');
            $data1['class_id']           = $this->input->post('class');
			$data1['section_id']           = $this->input->post('section');
            $data['name']           = $this->input->post('name');
            $data['school']           = $this->input->post('school_name');
            $data['phone1']          = $this->input->post('phone1');
            $data['phone2']          = $this->input->post('phone2');
            $data['sex']          = $this->input->post('sex');

            $data['address']        = $this->input->post('address');
            $data['parent']      = $this->input->post('parent');
            $data['birthday']       = $this->input->post('birthday');
           // $data['dormitory_id']   = $this->input->post('dormitory_id');
           // $data['transport_id']   = $this->input->post('transport_id');
            $data['student_session'] = $this->input->post('student_session');
            $data['email']          = $this->input->post('email');
			$this->crud_model->student_update($data,$student_id,$data1);
            
		    
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
			           redirect(base_url() . 'index.php/staff/student_portal/'.$student_id ,'refresh');

			}
			
			 function mark_message($class_id,$section_id,$student_id,$mark_obtained,$mark_total,$average,$grade_id,$exam_id,$subject)
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect('login', 'refresh');
        $running_year = get_running_year();
      //$this->crud_model->student_marks_message($class_id,$section_id,$student_id,$mark_obtained,$mark_total,$average,$grade_id,$exam_id);
	    $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;

        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
		        $grade = $this->db->get_where('grade' , array('grade_id' => $grade_id))->row()->grade;

		//echo $student_name;
           // $data['username']           = $this->input->post('username');
        $phone1 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone1;
       $phone2 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone2;

		 //echo $student_phone;
           
			 
			  
			  $sms = $this->db->get('sms_settings')->row();
			  //echo $sms;
		      $sender_id = $sms->sender_id;
		      $username = $sms->username;
		      $password = $sms->password;
		      $common = $sms->common_word;
			  $url = $sms->url;
			  $web_url=$sms->web_url;
              if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
			  $message = $common."Progress Report - Exam Name: ".$exam_name. ", Name : ".$student_name.",For ".$subject." Total Marks Obtained : ".$mark_obtained." Out Of : " .$mark_total.", Percentage : ".$average."% grade: ".$grade;
			  }
			  else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
			 
$message = $common."Progress Report - Exam Name: ".$exam_name. ", Name : ".$student_name.",For ".$subject." Total Marks Obtained : ".$mark_obtained." Out Of : " .$mark_total.", Percentage : ".$average."% grade: ".$grade;		
	  }	
			   $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to=' .$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		//echo $location;
		var_dump($location);
		die();
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
	          
       
          //echo $message;
           redirect(base_url() . 'index.php/staff/student_portal/'.$student_id ,'refresh');

		 
		 
    }
  function attendance_message($class_id,$section_id,$student_id,$present,$total,$percentage,$month)
    {
        if ($this->session->userdata('staff_login') != 1)
            redirect('login', 'refresh');
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
				  $month="August";
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
			   $location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to=' .$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		var_dump($location);
		die();
		//echo $location;
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
       
          //echo $message;
           redirect(base_url() . 'index.php/staff/student_portal/'.$student_id ,'refresh');

		 
		 
    }
	
	 function student_portal($student_id)
    {
        $yr=get_running_year();
        $class_id     = $this->db->get_where('enroll' , array(
            'student_id' => $student_id , 'year' => $yr
        ))->row()->class_id;

        $student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
        $class_name   = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
        $system = $this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
   		$page_data['student_portal_model']=$this->crud_model->student_portal_data($student_id);
		//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');

        $monthly_attendance = $this->crud_model->get_attendance_monthly($student_id);

      
        $page_data['student_id']  =  $student_id;
        $page_data['class_id']   =   $class_id;
        $page_data['monthly_attendance']   =   $monthly_attendance;

       $this->load->view('staff/student_portal.php',$page_data);
    }
	function new_sendall_message()
	{
	$ph='';
	$ph2='';
		$message_send  = $this->input->post('message_send');
		 $class_id= $this->input->post('class');
		
		
	
		//$cls="";
		/*if ($class_id=='ALL')
		{
		$cls = $cls ;
		}
		else{
		$cls = " where  class_id=". $class_id;
		}*/
		//$sql = "select * from enroll " . $condition ;
	
		//$class = $this->db->query($sql)->result_array();
		
		//foreach($class as $data)
		//{
			//$student_id=$data['student_id'];
			//$student= $this->db->get_where('student' , array('student_id' =>$student_id))->result_array();
			
			//foreach($student as $v)
			//{
			if ($class_id!='All')
				{
					/*$this->db->select('s.phone1,s.phone2');
					$this->db->from('student s');
					$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
					$this->db->where('e.class_id',$class_id);
					$phone1=$this->db->get()->result_array();
					foreach($phone1 as $a){
					$ph=$a['phone1'].','.$ph;
					$ph2=$a['phone2'].','.$ph2;
								}*/
								
								
								
								$this->db->select('s.phone1,s.phone2,GROUP_CONCAT(s.phone1) as ph,GROUP_CONCAT(s.phone2) as ph1' );
								$this->db->from('student s');
								$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
								$this->db->where('e.class_id',$class_id);
								$a=$this->db->get()->result_array();
								foreach($a as $b)
								{
									 $ph=$b['ph'];
									 $ph2=$b['ph1'];
									
								}
								
								}
						
								
		
				
			if ($class_id=='All')
			{
				$this->db->select('s.phone1,s.phone2,GROUP_CONCAT(s.phone1) as ph,GROUP_CONCAT(s.phone2) as ph1' );
				$this->db->from('student s');

				//$this->db->select('phone1,phone2');
				//$this->db->from('student');
				$phone1=$this->db->get()->result_array();
				foreach($phone1 as $a){
				$ph=$a['ph'];
									 $ph2=$a['ph1'];
									 }
				//$ph=$a['phone1'].','.$ph;
				//$ph2=$a['phone2'].','.$ph2;}
				}
				//echo $ph;
				//echo $ph2;

				//$phone2= $v['phone2'];
				//$student_name= $v['name'];     
				$sms = $this->db->get('sms_settings')->row();
				$sender_id = $sms->sender_id;
				$username = $sms->username;
				$password = $sms->password;
				$common = $sms->common_word;
				$url = $sms->url;
				$reciever = $ph;
				$web_url=$sms->web_url;
				$message= " Hi ".$message_send." "; 
				$message1= $message_send." "; 
			 
					if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
					{ 
					if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
					$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' .$ph.','.$ph2. '&msg=' . urlencode($message . " " . $common) . '&route=T';}
					else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
					
					$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $ph.','.$ph2 . '&msg=' . urlencode($common." ".$message . ".") . '&route=T';}
					}
					else
					{
					if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
					$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $ph.','.$ph2 . '&msg=' . urlencode($message1 . " " . $common) . '&route=T';}
					else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
					
					$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $ph.','.$ph2 . '&msg=' . urlencode($common." ".$message1 . ".") . '&route=T';}
					}
					//var_dump($location);
					//die();
					$api = $url;

					$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
					$balance = stream_get_contents($handle);
					if ($balance >= 0) {
					
					$api . "/sendsms?" . $location;
					$send = fopen($api . "/sendsms?" . $location, "r");
					$api . "/sendsms?" . $location;
					$return_message_ids = stream_get_contents($send);
					$message_id_array = explode(",", $return_message_ids);
				}
				//}
			//}
			?><script>alert("Message Send Successfully")</script><?php   
			  				redirect(base_url() . 'index.php/staff/message' , 'refresh');
	}
	
	
	 function settings2() 
    {
        //$page_data['page_name'] = 'settings2';
        //$page_data['page_title'] = get_phrase('Send-News');
         $this->load->view('staff/settings2.php');
    }
	function settings2_login() 
    {
	 $password=$this->input->post('password');

	if($password=='login2')
	{
        //$page_data['page_name'] = 'settings3';
        //$page_data['page_title'] = get_phrase('Send-News');
         $this->load->view('staff/advanced_settings');
		}
    }
	function reset_password() 
    {
	
         $this->load->view('staff/reset_password');
		
    }
	 
	 function change_password()
	 {
	  $new_password=sha1($this->input->post('new'));
	  $confirm_password=sha1($this->input->post('confirm'));
	  if($new_password==$confirm_password)
	  {
	  $data['password']=$confirm_password;
	  $this->db->where('staff_id',1);
	  $this->db->update('staff',$data);
	  }
	  else
	  {?>
	  <script>alert("Invalid")</script>
	  <?php }
	  redirect('staff/reset_password');
	 }
	 function progress_report() 
    {
	
         $this->load->view('staff/progress_report');
		
    }
	

	
	


	
	
	

        
	
	

}
