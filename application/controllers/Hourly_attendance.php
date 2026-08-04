<?php  error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Hourly_attendance extends CI_Controller 
{
	public function set_week_days($branch_id='')
	{
		$role=$this->session->userdata('role');
		 
		 
		 if($branch_id=='')
		 {
		 if($role==1 || $role==2)
		 {
		   $branch_id=$this->input->post('branch');
		 }
		 elseif($role==3 || $role==4)
		 {
		   $branch_id=$this->session->userdata('branch_id');
		 }
		 }
		 
		$academic_year=get_running_year();
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year',$academic_year);
		$data['week_days'] = $this->db->get('tbl_att_week_days')->result_array();
		$data['branch']=$this->db->get('tbl_branch')->result_array();
		$data['branch_id']=$branch_id;
		
		$this->load->view('admin/hourly_attendance/set_week_days',$data);
	}
	
	public function save_week_days($branch_id='')
	{
		
		$day_id = $this->input->post('day_id',true);
		$day_checked = $this->input->post('day_checked',true);
		$i=0;
		$data1['action']="failed";
		
		foreach($day_id as $id)
		{
			$data = array('is_working_day' => $day_checked[$i]);
			$this->db->where('week_day_id',$id);
			$this->db->update('tbl_att_week_days', $data); 
			$i=$i+1;
			if($this->db->affected_rows()>0)
				$data1['action'] = "success";
		}
		
	$this->set_week_days($branch_id);
	}

	
	public function set_working_days($action='')
	{
	$data['action']=$action;
	$this->db->where('is_deleted','N');
    $data['branch']=$this->db->get('tbl_branch')->result_array();
	$this->load->view('admin/hourly_attendance/set_working_days',$data);
	}	
	
	public function get_working_days($month='',$year='',$branch_id='')  // ajax calling
	{
		$data['month']= $month;
		$data['year']= $year;
		$data['branch_id']= $branch_id;
		$this->load->view('admin/hourly_attendance/get_working_days',$data);
	}	
	
	public function save_working_days()		// save or update holiday master
	{
	  
		 $branch_id = $this->input->post('branch');
		 $month = $this->input->post('month');
		 $year =  $this->input->post('year');
		 $date=  $this->input->post('date[]');
		 $reason =  $this->input->post('reason[]');
		 $check_checked =  $this->input->post('check_checked[]');
		 
		 $academic_year = get_running_year();
		
		$count = count($date);
		
		for ($i= 0 ; $i<$count; $i++)
		{
		// delete the current date
			$day= date('Y-m-d',strtotime($date[$i]));
			$data['date']=$day;
			$data['academic_year']=$academic_year;
			$data['branch_id']=$branch_id;
			
			$this->db->where('att_date',$day);
			$attendance=$this->db->get('tbl_att_students_houlry_attendance_master')->result_array();
			
			if((count($attendance)>=1)&&($check_checked[$i]==1))
			{
				$this->session->set_flashdata('error_message', "Data exists on day " . date('d-m-Y', strtotime($day)) . ". That cannot be updated.");
			}
			else
			{
				$this->Hourly_attendance_model->delete_holidays($day,$academic_year,$branch_id);
				if( $check_checked[$i]==1)
				{
					$data['reason_for_holiday ']=$reason[$i];
					$this->Hourly_attendance_model->insert_holidays($data);
				}
			}
		}
		redirect(base_url() . 'index.php/hourly_attendance/set_working_days' ,'refresh');
	}	
	
	
	
	public function set_class_timing($branch_id='')
	{
		//$academic_year = 1;
		//$branch_id = 1;
		$role=$this->session->userdata('role');
		if($branch_id=='')
		{
		 if($role==1 || $role==2)
		 {
		   $branch_id=$this->input->post('branch');
		 }
		 elseif($role==3 || $role==4)
		 {
		   $branch_id=$this->session->userdata('branch_id');
		 }
		}
		$academic_year=get_running_year();
		$data['branch']=$this->db->get('tbl_branch')->result_array();
		$class_timing = $this->Hourly_attendance_model->get_class_timing($academic_year,$branch_id);
		$data['class_timing']=$class_timing;
		$data['branch_id']=$branch_id;
	    $this->load->view('admin/hourly_attendance/set_class_timing',$data);
	}

	public function set_time_table($action='')
	{// not completd
	$classes = $this->Fee_management_model->get_classes();
	$working_days=$this->Hourly_attendance_model->get_working_days();
	$page_data['classes']=$classes;
	$page_data['working_days']=$working_days;
	$page_data['action']=$action;
	$this->load->view('admin/hourly_attendance/set_class_time_table',$page_data);
	}
	public function show_time_table($action='')
	{// not completd
	$classes = $this->Fee_management_model->get_classes();
	$working_days=$this->Hourly_attendance_model->get_working_days();
	$page_data['classes']=$classes;
	$page_data['working_days']=$working_days;
	$page_data['action']=$action;
	$this->load->view('admin/hourly_attendance/show_class_time_table',$page_data);
	}
	
	public function get_class_hours($class_id='',$section_id='',$branch_id='',$dept_id='')   // for ajax calling
	{
	
	$working_days=$this->Hourly_attendance_model->get_working_days($branch_id);
	$class_timing=$this->Hourly_attendance_model->get_class_hours($branch_id);
	$subjects = $this->Hourly_attendance_model->get_class_wise_subjects($class_id);
	
	
	//$result = $this->db->get_where('tbl_att_time_table_master',array('class_id'=>$class_id,'section_id'=>$section_id,'branch_id'=>$branch_id,'dept_id'=>$dept_id))->result_array();
	    $year   =   get_running_year();
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('dept_id',$dept_id);
		$this->db->where('academic_year',$year);
		$time_table_master_id=$this->db->get('tbl_att_time_table_master')->row()->time_table_master_id;
		
	    if($time_table_master_id!='')
		{
		   $this->db->where('time_table_master_id',$time_table_master_id);
           $page_data['time_table']=$this->db->get('tbl_att_time_table_details')->result_array(); 
		}
	
	$page_data['branch_id']=$branch_id;
	$page_data['dept_id']=$dept_id;
	$page_data['class_id']=$class_id;
	$page_data['section_id']=$section_id;
	$page_data['working_days']=$working_days;
	$page_data['class_timing']=$class_timing;
	$page_data['subjects']=$subjects;
	
	
    $page_data['branch_id']=$branch_id;
	$this->load->view('admin/hourly_attendance/get_class_hours',$page_data);
	}
	
	public function get_time_table($class_id='',$section_id='',$branch_id='')   // for ajax calling
	{
	
	$working_days=$this->Hourly_attendance_model->get_working_days($branch_id);
	$class_timing=$this->Hourly_attendance_model->get_class_hours($branch_id);
	$subjects = $this->Hourly_attendance_model->get_class_wise_subjects($class_id);
	
	$page_data['class_id']=$class_id;
	$page_data['section_id']=$section_id;
	$page_data['class_timing']=$class_timing;
	

		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		//$this->db->select("week_day_short_name,[1st Hour],'2nd Hour','3rd Hour','4th Hour','5th Hour','6th Hour'");

	$time_table = $this->db->get('view_att_time_table_tabular')->result_array();
		$page_data['time_table']=$time_table;
		
	$this->load->view('admin/hourly_attendance/get_time_table',$page_data);
	}
	
	
	public function save_time_table()
	{// not completd
	    $branch_id = $this->input->post('branch');
		$dept_id = $this->input->post('department');
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');
		$subjects_id = $this->input->post('subject_id');
		$day_id = $this->input->post('day_id');
		$hour_id = $this->input->post('hour_id');
		$teacher_id = $this->input->post('teacher_id');
		$i=0;
		
		$result = $this->db->get_where('tbl_att_time_table_master',array('class_id'=>$class_id,'section_id'=>$section_id))->row_array();
		if(count($result>0))
		{
			$del_master_id=$result['time_table_master_id'];
			$this->db->delete('tbl_att_time_table_master',array('time_table_master_id'=>$del_master_id));
			$this->db->delete('tbl_att_time_table_details',array('time_table_master_id'=>$del_master_id));
		}

		// save to master table
		$master_data['branch_id']		=	$branch_id;
		$master_data['dept_id']	    	=	$dept_id;
		$master_data['class_id']		=	$class_id;
		$master_data['section_id']		=	$section_id;
		$master_data['academic_year']	=	get_running_year();
		
		$this->db->insert('tbl_att_time_table_master',$master_data);
		$master_id =  $this->db->insert_id();


		foreach ($subjects_id as $sub_id)
		{
		$details_data['time_table_master_id']=$master_id;
		$details_data['week_day_id']=$day_id[$i];
		$details_data['hour_id']=$hour_id[$i];
		$details_data['subject_id']=$sub_id;
		$details_data['teacher_id']=$teacher_id[$i];
		$this->db->insert('tbl_att_time_table_details',$details_data);
		$i=$i+1;
		}
	
		if($this->db->affected_rows()>0)
			$action='success';
		else
			$action = 'failed';
		$this->set_time_table($action);

	}
	
	public function mark_hourly_attendance()
	{
		$classes = $this->db->get('class')->result_array();
		
		$role=$this->session->userdata('role');
		if($role==3 || $role==4 || $role==5 ||$role==6 )
		{
		$branch_id=$this->session->userdata('branch_id');
		$page_data['class_timing']=$this->Hourly_attendance_model->get_class_hours($branch_id);
		}
		
		
		
	   
		$page_data['classes']=$classes;
		$this->load->view('admin/hourly_attendance/mark_hourly_attendance',$page_data);
	}
	public function view_hourly_attendance()
	{
		$classes = $this->db->get('class')->result_array();
		$class_hours = $this->db->get('tbl_att_class_timing_details')->result_array();
		$class_timing=$this->Hourly_attendance_model->get_class_hours();
		$page_data['classes']=$classes;
		$page_data['class_timing']=$class_hours;
		
		$this->load->view('admin/hourly_attendance/view_hourly_attendance',$page_data);
	}
	public function get_hour_subject($hour_id='',$att_date='',$class_id='')
	{ 
	    $user_id=$this->session->userdata('login_user_id');
		 $role=$this->session->userdata('role');
	   if($role==5 || $role==6)
	   {
	        $this->db->select('s.subject_id,s.name');
			$this->db->from('subject s');
			$this->db->join('staff e','e.staff_id=s.teacher_id','LEFT');
			$this->db->where('e.user_id',$user_id);
			$this->db->where('s.class_id',$class_id);
			$subject=$this->db->get()->result_array();
			?>
            <option value="">--Select--</option>
            <?php
			foreach($subject as $row)
			{
			?>
            <option value="<?php echo $row['subject_id']; ?>"><?php echo $row['name'];?> </option>
            <?php
			}
		}
		
		else
		{
	   $this->db->where('class_id',$class_id);
	   $this->db->where('att_date',date('Y-m-d',strtotime($att_date)));
	   $this->db->where('timing_name',$hour_id);
	   $result= $this->db->get('view_att_houlry_attendance_details')->result_array();
	   
	   $subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
		?>
        <option value="">--Select--</option>
        <?php	
	  foreach ($subject as $row)
	{
				
		$selected='';	
	   foreach($result as $row1)
	   {
	      if($row1['subject_id']==$row['subject_id'])
		  {
		   $selected='selected="selected"';
					break;  
		  }
		 
	   }
	    ?> 
                         <option value="<?php echo $row['subject_id']?>"  <?php echo $selected ; ?> ><?php echo $row['name']; ?></option>
                        <?php
	   
	 }
	 }
	}
	
	public function get_hour_teacher($hour_id='',$att_date='',$class_id='')
	{ 
	   $this->db->where('class_id',$class_id);
	   $this->db->where('att_date',date('Y-m-d',strtotime($att_date)));
	  // $this->db->where('timing_name',$hour_id);
	   $result= $this->db->get('view_att_houlry_attendance_details')->result_array();
	   
	   
	 
	   foreach($result as $row1)
	   {
	      
		   $selected='selected="selected"';
			

	    ?><option value="<?php echo $row1['teacher_id']?>"  <?php echo $selected ; ?> ><?php echo $row1['teacher_name']; ?></option><?php
	   
	 }
	}
	
	public function get_hour($branch_id)
	{
	 
	   $this->db->where('class_timing_master_id', '1'); // 1 is for normal working day.Now it is always 1.
	   $this->db->where('branch_id', $branch_id);
	    $this->db->where('is_active','Y');
	   $class_timing = $this->db->get('tbl_att_class_timing_details')->result_array();
	   ?>
        <option value="">--Select--</option>
        <?php  
        foreach($class_timing as $timing)
		{
		?>
		<option value="<?php echo $timing['class_timing_details_id']?>" ><?php echo $timing['timing_name']; ?></option>
		<?php
		}

		
	}
	
	public function get_students_list($class_id ='',$section_id='',$att_date='',$hour_id='',$subject_id='',$teacher_id='',$branch_id='')
	{
	    
		$page_data['class_id']=$class_id ;
		$page_data['section_id']=$section_id ;
		$page_data['att_date']=$att_date ;
		$page_data['hour_id']=$hour_id ;
		$page_data['subject_id']=$subject_id ;
		$page_data['teacher_id']=$teacher_id ;
		$page_data['branch_id']=$branch_id ;
		
	
	      $this->db->where('class_id', $class_id);
		  $this->db->where('section_id' , $section_id );
          $this->crud_model->check_student_status();
		  $query = $this->db->get('view_students s');
			
			 $students =  $query->result_array();
			$page_data['students']=$students;
		//echo "fff";
		//die();
		//////////////
		$query = $this->db->get_where('tbl_att_students_houlry_attendance_master' ,
		array(
            'class_id'=>$class_id,
            'section_id'=>$section_id,
			'branch_id'=>$branch_id,
            'att_date'=>date('Y-m-d',strtotime($att_date))
			));
			
		if($query->num_rows() < 1) 
        {
           $m_data['class_id']   = $class_id;
           $m_data['section_id'] = $section_id;
		   $m_data['branch_id'] = $branch_id;
           $m_data['att_date'] = date('Y-m-d',strtotime($att_date));
           $this->db->insert('tbl_att_students_houlry_attendance_master' , $m_data); 
		   
		   $att_master_id = $this->db->insert_id() ;
		}
		else
		{
			foreach ( $query->result() as $row)
			{
				$att_master_id = $row->students_houlry_attendance_masters_id;
				
			}	
		}
		$this->db->where('students_houlry_attendance_masters_id', $att_master_id);
		$this->db->where('class_timing_details_id', $hour_id);
		            $result = $this->db->get('tbl_att_students_houlry_attendance_details');
		            if($result->num_rows() > 0)
		            {
	                $page_data['attendance_details'] =  $result->result_array();
		            }
		
		
		
		
			
			
		$page_data['att_master_id']=$att_master_id ;

		$this->load->view('admin/hourly_attendance/mark_hourly_attendance_1',$page_data);
	}
	
	///////////
	public function view_attendance_list($class_id ='',$section_id='',$att_date='',$hour='',$branch_id='')
	{
	   $page_data['att_date']=$att_date;
	   $page_data['class_timing']=$this->Hourly_attendance_model->get_class_hours($branch_id);
	   $this->db->where('class_id', $class_id);
	   $this->db->where('section_id' , $section_id );
	   $this->db->where('att_date' , date('Y-m-d',strtotime($att_date)) );
	   $query = $this->db->get('view_att_attendance_details_tabular');
	   $students =  $query->result_array();
	   $page_data['students']=$students;

		$this->load->view('admin/hourly_attendance/view_hourly_attendance_1',$page_data);
	}
	//////////
		
	public function save_hourly_attendance_single($master_id='',$hour_id='',$subject_id='',$teacher_id='',$att_date='')
	{
		$data['students_houlry_attendance_masters_id'] = $master_id;
		$data['class_timing_details_id'] = $hour_id;
	
		$students_id = $this->input->post('student_id');
		$attendance = $this->input->post('attendance',true);
		$i=0;
		$this->db->delete('tbl_att_students_houlry_attendance_details',$data);
		foreach($students_id as $sid)
		{
			$data['student_id'] = $sid;
			$data['subject_id'] = $subject_id;
			$data['teacher_id'] = $teacher_id;
		//	$data['att_date'] = date('Y-m-d',strtotime($att_date));
			$data['attendance_status'] = $attendance[$i];
			//if( $attendance[$i]==2)
			
			$this->db->insert('tbl_att_students_houlry_attendance_details',$data);
			$i=$i+1;
			
		}
		
		$this->mark_hourly_attendance();
	}
	
	public function save_class_timing($branch_id='')
	{
		$timing_id = $this->input->post('timing_id',true);
		$start_time = $this->input->post('start_time',true);
		$end_time = $this->input->post('end_time',true);
		$timing_checked= $this->input->post('timing_checked',true);

		$i=0;
		foreach($timing_id as $tid)
		{
			$data = array('start_time' => $start_time[$i],'end_time' => $end_time[$i],'is_active' => $timing_checked[$i]);
			$this->db->where('class_timing_details_id',$tid);
			$this->db->update('tbl_att_class_timing_details', $data); 
			$i=$i+1;			
		}
		$this->set_class_timing($branch_id);
	}

	public function is_working_day($date='') // ajax function
	{
		$date = date('Y-m-d',strtotime($date));
		$data['date']=$date;
		$this->db->where('date', $date);
	    $query = $this->db->get('tbl_att_holiday_master');
	   $day =  $query->result_array();
	   if(count($day)>0)
	   	$message = "<font color='red'>Is a holiday</font>";
	else
		$message = "<font color='green'>Is a working day, you can proceed </font>";
	   $page_data['message']=$message;
	  echo $message;
	   
		
	}

	public function student_absent_sms($student_id='',$att_date='')
	{
	
	    $running_year=get_running_year();
		$sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
		$web_url=$sms->web_url;
		
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		
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
		
		$data['send_by']	=$staff;
		$data['content']	= "hourly attendace";
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d h:i:s');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id		=	$this->db->insert_id();

		$absent_data=$this->Hourly_attendance_model->get_absent($student_id,$att_date);
		foreach($absent_data as $row)
		{
		    if($row['attendance_status']==2)
			{
		 	$msg1[]= $row['timing_name'] ."(".$row['subject_name'].")" ;
			}
			$student_name=$row['student_name'];
			$student_id	=$row['student_id'];
			$class_id	=$row['class_id'];
			$section_id	=$row['section_id'];
			$phone	=$row['phone1'];
			
	    }		
			$msg2=implode(" and ",$msg1);
			$msg=$student_name." is absent for ".$msg2." on ".date('d-m-Y',strtotime($row['att_date']));
		
			$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$student_id;
			$data1['class_id']	=$class_id;
			$data1['section_id']	=$section_id;
			$data1['phone']	=$phone;
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']	=  date('Y/m/d h:i:s');
			
			$data1['msg_content']	= $msg;

			$this->db->insert('tbl_sms_delivery_details',$data1);
		  
		$data2['master_id']	=	$master_id;	
		$this->load->view('admin/hourly_attendance/message_popup_hourly_attendance',$data2);
		
	}
	public function all_student_absent_sms($att_date='')
	{
	    $running_year=get_running_year();
		$sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
		$web_url=$sms->web_url;
		
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		
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
		
		$data['send_by']	=$staff;
		$data['content']	= "hourly attendace";
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d h:i:s');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id		=	$this->db->insert_id();   
	  
		$absent_data=$this->Hourly_attendance_model->get_all_absent($att_date);
		foreach($absent_data as $row)
		{
		    $msg=$row['student_name']. " is absent for " .$row['timing_name'] ."(".$row['subject_name'].") on ".date('d-m-Y',strtotime($row['att_date']));
		    $data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$row['student_id'];
			$data1['class_id']	=$row['class_id'];
			$data1['section_id']	=$row['section_id'];
			$data1['phone']	=$row['phone1'];
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']	=  date('Y/m/d h:i:s');
			
			$data1['msg_content']	= $msg;

			$this->db->insert('tbl_sms_delivery_details',$data1);
		  
		}
		$data2['master_id']	=	$master_id;	
		$this->load->view('admin/hourly_attendance/message_popup_hourly_attendance',$data2);
		
	}
	
	
	
	
	function sms_send_popup_hourly_attendace($master_id)
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
	
	
	if($b['processed']==0 || $b['processed']==1)
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
	
	 redirect(base_url() . 'index.php/Hourly_attendance/view_hourly_attendance' , 'refresh');

	}
	
	function delete_sms_pop_up_hourly_attendace($master_id='')
	{
	$this->db->where('sms_master_id',$master_id);
	$this->db->delete('tbl_sms_delivery_master');
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->delete('tbl_sms_delivery_details');
	//$data['master_id']	=$master_id;
	//$this->load->view('admin/message.php');
	redirect(base_url() . 'index.php/Hourly_attendance/view_hourly_attendance' , 'refresh');
	}
	
	
	
	
	
	public function attendance_report()
	{
	 
	  $this->load->view('admin/hourly_attendance/attendance_report');
	}
	
	
	public function view_attendance_report($branch_id='',$dept_id='',$class_id ='',$section_id='',$from_date='',$to_date='',$category='',$category_id='')
	{ 
	
	   
	 
	   if($category==4)
		{
		   
	   $page_data1['class_timing']=$this->Hourly_attendance_model->get_class_hours($branch_id);
	   
	   $this->db->where('student_id', $category_id);
	   $this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
	   $this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
	   $query = $this->db->get('view_att_attendance_details_tabular');
	   $students =  $query->result_array();
	   $page_data1['students']=$students;
	  
	   $this->load->view('admin/hourly_attendance/view_attendance_report_student',$page_data1);
		
		
		}
		
		
		 elseif($category==5)
		{
		
		
	    $page_data['branch_id']  =  $branch_id ;
		$page_data['dept_id']    =  $dept_id ;
		$page_data['class_id']   =  $class_id ;
		$page_data['section_id'] =  $section_id ;
		$page_data['from_date']  =  $from_date ;
		$page_data['to_date']    =  $to_date ;
		
		
		
		$this->db->where('class_id',$class_id);
		$page_data['subject']=$this->db->get('subject')->result_array();
		$yr=get_running_year();
		$this->db->where('s.class_id',$class_id);
		$this->db->where('e.year',$yr);
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->crud_model->check_student_status();
		$page_data['student']=$this->db->get('view_students s')->result_array();
		
		
		//$page_data['working_days']=$this->Hourly_attendance_model->get_total_working_days($branch_id,$dept_id,$class_id,$section_id,$from_date,$to_date);
		
		
		//$class_hours=$this->Hourly_attendance_model->get_hours($branch_id);
		//$total_working_hours=$page_data['working_days']*$class_hours;
		//$page_data['total_working_hours']=$total_working_hours;
		
		
		//$total_hours=$this->Hourly_attendance_model->get_total_hours($branch_id,$class_id,$section_id,$from_date,$to_date,$category,$category_id);
		//$page_data['total_hours']=$total_hours;
		
		//$page_data['total_present']=$this->Hourly_attendance_model->get_total_present($branch_id,$class_id,$section_id,$from_date,$to_date,$total_hours,$category,$category_id);
		
		$this->load->view('admin/hourly_attendance/view_attendance_report_subject',$page_data);
		}
		

	    else
		{
	    $page_data['branch_id']  =  $branch_id ;
		$page_data['dept_id']    =  $dept_id ;
		$page_data['class_id']   =  $class_id ;
		$page_data['section_id'] =  $section_id ;
		$page_data['from_date']  =  $from_date ;
		$page_data['to_date']    =  $to_date ;
		
		$page_data['working_days']=$this->Hourly_attendance_model->get_total_working_days($branch_id,$dept_id,$class_id,$section_id,$from_date,$to_date);
		
		
		$class_hours=$this->Hourly_attendance_model->get_hours($branch_id);
		$total_working_hours=$page_data['working_days']*$class_hours;
		$page_data['total_working_hours']=$total_working_hours;
		
		
		$total_hours=$this->Hourly_attendance_model->get_total_hours($branch_id,$class_id,$section_id,$from_date,$to_date,$category,$category_id);
		$page_data['total_hours']=$total_hours;
		
		$page_data['total_present']=$this->Hourly_attendance_model->get_total_present($branch_id,$class_id,$section_id,$from_date,$to_date,$total_hours,$category,$category_id);
		
		$this->load->view('admin/hourly_attendance/view_attendance_report',$page_data);
		}
		
		
	}
	
	public function get_select($category='',$branch_id='',$class_id='',$section_id='')
	{
	   
		$this->db->where('class_timing_master_id', '1');
	    $this->db->where('branch_id', $branch_id);
	    $this->db->where('is_active','Y');
	    $class_timing = $this->db->get('tbl_att_class_timing_details')->result_array();
		
		$this->db->where('class_id', $class_id);
	    $subjects= $this->db->get('subject')->result_array();
		
	    $this->db->select('student_id,student_name');
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->group_by('student_id');
		$this->db->from('view_att_houlry_attendance_details');
		$student=$this->db->get()->result_array();
		
	
		
		if($category=='2')
		{ 
        foreach($class_timing as $timing)
		{
		?>
		<option value="<?php echo $timing['class_timing_details_id']?>" disabled="disabled"><?php echo $timing['timing_name']; ?></option>
		<?php
		}
		}
		
		if($category=='3')
		{ 
        foreach($subjects as $subject)
		{
		?>
		<option value="<?php echo $subject['subject_id']?>" ><?php echo $subject['name']; ?></option>
		<?php
		}
		}
		
		
		if($category=='4')
		{ 
		
        foreach($student as $row)
		{
		?>
		<option value="<?php echo $row['student_id']?>" ><?php echo $row['student_name']; ?></option>
		<?php
		}
		}
	
	  
	  
	}
	
	public function download_attendance_report()
	{ 
	    $branch_id  =  $this->input->post('branch') ;
		$dept_id    =  $this->input->post('department') ;
		$class_id   =  $this->input->post('class_id') ;
		$section_id =  $this->input->post('section_id') ;
		$from_date  =  $this->input->post('from_date') ;
		$to_date    =  $this->input->post('to_date');
	    $category      =  $this->input->post('category') ;
		$category_id    =  $this->input->post('type') ;
	   
	   if($category==4)
		{
		   
	   $class_timing=$this->Hourly_attendance_model->get_class_hours($branch_id);
	 
	   
	   $this->db->where('student_id', $category_id);
	   $this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
	   $this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
	   $query = $this->db->get('view_att_attendance_details_tabular');
	   $students =  $query->result_array();
	   //$page_data1['students']=$students;
	  
	  ob_start();
	  ob_get_clean();
								
                                  
							       echo "<html>";
						
						         echo  "<table border='1'><tr><td colspan='4' align='center'>Attendance Report</td></tr>";
						          echo  "<tr><td colspan='4'  align='center'>From " .date('d-m-Y',strtotime( $from_date)) . " To " .date('d-m-Y',strtotime(  $to_date)). "</td></tr>";
								  echo  "\tbranch : \t" . get_branch($branch_id ). "\n\n";
								   echo  "\tdepartment : \t" . get_dept($dept_id ). "\n\n";
								   echo  "\tClass : \t" . get_class_name($class_id ). "\n\n";
									echo  "\tSection:  \t" . get_section_name( $section_id ). "\n\n\n";
									echo  "<tr><td>Date</td>";
									foreach($class_timing as $data)
									{
									  echo  "<td>" .$data['timing_name']."</td>";
									}
									echo "</tr>";
								 foreach ($students as $row)
								{
									
								    echo "<tr><td>" .date('d-m-Y',strtotime($row['att_date']));
									foreach($class_timing as $timing)
				                    {
				                     $data=$timing['timing_name'];
									// $arrangeData[$data] 		= $row[$data];
									 echo "</td><td>" . $row[$data] . "</td>";
									
									}
									 echo "</tr>";
									
									
									
								}
								echo "</body>";
						        echo "</html>";	
								// set header
								$filename = "AttendanceReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								die();
		}
		
		if($category==5)
		{
		   $yr=get_running_year();
	  $this->db->where('class_id',$class_id);
		$subject=$this->db->get('subject')->result_array();
		
		$this->db->where('s.class_id',$class_id);
		$this->db->where('e.year',$yr);
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->crud_model->check_student_status();
		$student=$this->db->get('view_students s')->result_array();
		
		
		
		
		
	  
	  ob_start();
	  ob_get_clean();
		$i=1;						
                                  
							       echo "<html>";
						
						         echo  "<table border='1'><tr><td colspan='6' align='center'>Attendance Report</td></tr>";
						          echo  "<tr><td colspan='6'  align='center'>From " .date('d-m-Y',strtotime( $from_date)) . " To " .date('d-m-Y',strtotime(  $to_date)). "</td></tr>";
								  echo  "\tbranch : \t" . get_branch($branch_id ). "\n\n";
								   echo  "\tdepartment : \t" . get_dept($dept_id ). "\n\n";
								   echo  "\tClass : \t" . get_class_name($class_id ). "\n\n";
									echo  "\tSection:  \t" . get_section_name( $section_id ). "\n\n\n";
									echo  "<tr><td>SI No</td><td>Name</td>";
									foreach($subject as $row)
									{
									  echo  "<td>" .$row['name']."</td>";
									}
									echo "</tr><tr>";
								foreach($student as $data)
								{
									
								   echo "<td>" .$i. "</td>";
									 echo "<td>" .$data['name']. "</td>";
									foreach($subject as $row)
									{
									$this->db->select('class_timing_details_id');
$this->db->where('student_id',$data['student_id']);
$this->db->where('subject_id',$row['subject_id']);
$this->db->where('( attendance_status=1 or attendance_status=3)');
if($from_date==$to_date)
		{
		$this->db->where('att_date=',date('Y-m-d',strtotime($from_date)));
		}
		else
		{
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		}
$total_present=$this->db->get('view_att_houlry_attendance_details')->result_array();

$this->db->select('class_timing_details_id');
$this->db->where('subject_id',$row['subject_id']);
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
$total_hour=$this->db->get('view_att_houlry_attendance_details')->result_array();

echo  "<td>";
echo "Hours: ".count($total_hour);
echo "<br>";
echo "Present: ".count($total_present);
echo "</td>";
}
echo "</tr>";									
									
								$i=$i+1;	
								}
								echo "</body>";
						        echo "</html>";	
								// set header
								$filename = "AttendanceReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								die();
		
		
		}
		

	    else
		{
	    
		$working_days=$this->Hourly_attendance_model->get_total_working_days($branch_id,$dept_id,$class_id,$section_id,$from_date,$to_date);
		
		
		$class_hours=$this->Hourly_attendance_model->get_hours($branch_id);
		$total_working_hours=$working_days*$class_hours;
		
		
		
		$total_hours=$this->Hourly_attendance_model->get_total_hours($branch_id,$class_id,$section_id,$from_date,$to_date,$category,$category_id);
		
		
		$total_present=$this->Hourly_attendance_model->get_total_present($branch_id,$class_id,$section_id,$from_date,$to_date,$total_hours,$category,$category_id);
		
		ob_start();
	    ob_get_clean();
								
                                   $i=1;
								    echo "<html>";
						
						         echo  "<table border='1'><tr><td colspan='7' align='center'>Attendance Report</td></tr>";
						          echo  "<tr><td colspan='7'  align='center'>From " .date('d-m-Y',strtotime( $from_date)) . " To " .date('d-m-Y',strtotime(  $to_date)). "</td></tr>";
							       echo  "\tbranch : \t" . get_branch($branch_id ). "\n\n";
								   echo  "\tdepartment : \t" . get_dept($dept_id ). "\n\n";
								   echo  "\tClass : \t" . get_class_name($class_id ). "\n\n";
									echo  "\tSection:  \t" . get_section_name( $section_id ). "\n\n\n";
									echo  "<tr><td>Sl.No</td><td>Name</td><td>Total Working Days</td><td>Total Working Hours</td><td>Total Hours</td><td>Total Present</td><td>Attendance Percentage</td>";
								foreach($total_present as $data)
								{
									$arrangeData['Sl.No'] 		             = $i;
									$arrangeData['Name'] 		             = $data['student_name'];
									$arrangeData['Total Working Days'] 		 = $working_days;
									$arrangeData['Total Working Hours'] 	 = $total_working_hours;
									$arrangeData['Total Hours'] 		     = $total_hours;
									$arrangeData['Total Present'] 		     = $data['total_present'];
									$arrangeData['Attendance Percentage'] 	 = number_format($data['percentage'],2)." %";
									 echo "<tr>";
									 echo "<td>" .$i. "</td>";
									 echo "<td>" .$data['student_name']. "</td>";
									 echo "<td>" .$working_days. "</td>";
									 echo "<td>" .$total_working_hours. "</td>";
									 echo "<td>" .$total_hours. "</td>";
									 echo "<td>" .$data['total_present']. "</td>";
									 echo "<td>" .number_format($data['percentage'],2)." %". "</td>";
									 echo "</tr>";
									$i=$i+1;
									
								}
								echo "</body>";
						        echo "</html>";	
								// set header
								$filename = "AttendanceReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								die();
		
		}
		
		
	}
	
	function attendance_summary()
	{
		$this->load->view('admin/attendance_summary');
	}
	function show_attendance_summary()
	{
		$data['branch_id']		=	$this->input->post('branch_id');
		$data['dept_id']		=	$this->input->post('dept_id');
		$data['date']			=	strtotime($this->input->post('date'));
		$data['year']			=	get_running_year();
		//echo $branch_id."<br>".$dept_id."<br>".$date;
		$this->load->model('hourly_attendance_model');
		$data['result']			=	$this->hourly_attendance_model->show_attendance_summary($data);
		$this->load->view('admin/attendance_summary_view',$data);
	}

}
