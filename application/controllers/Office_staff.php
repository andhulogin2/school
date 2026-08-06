<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Office_staff extends CI_Controller {

	public function office_dashboard()
	{
		$this->load->view('office_staff/office_dashboard.php');
	}
	
	
	public function excel_import()
	{
		$this->load->view('Office_staff/excel_import.php');
	}
	
	
	public function student_add($enquiry_id='')
	{
		$data['enquiry']= $this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row();
		$this->load->view('office_staff/add_student.php',$data);
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
	
	
	function get_dept($branch_id)
	{
		$branch_option=$this->input->post('branch');
		$dept  = $this->db->get_where('tbl_department' , array('branch_id' => $branch_id))->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($dept as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
		}
	}
	
	
	function get_class_students($dept_id)
	{
		$class  = $this->db->get_where('class' , array('dept_id' => $dept_id ))->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($class as $row) 
		{
			echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
		}
	}
	
	
	function get_dept_all($branch_id)
	{
		$branch_option=$this->input->post('branch');
		$dept  = $this->db->get_where('tbl_department' , array('branch_id' => $branch_id))->result_array();
		echo '<option value="All">All</option>';
		foreach ($dept as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
		}
	}
	
	
	public function print_students_list()
	{
		$this->load->view('Office_staff/print_students_list_full.php');
	}
	
	
	public function print_students_list1()
	{
		$class_id        =$this->input->post('class');
		$section_id       =$this->input->post('section_id');
		$this->db->where('class_id',$class_id);
		$c=$this->db->get('class')->row();
		$this->db->where('section_id',$section_id);
		$s=$this->db->get('section')->row();
		
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
			$filename = "StudentsList.xls";
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$filename);
			
			//$this->exportExcelData($dataToExports);
			$total = 0;
			$i=1;
			$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
			
			echo "<tr><td colspan='7'></td></tr>";
			
			
			//$dataToExports = [];
			echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
			echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
			echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
			echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>CLASS&nbsp;&nbsp;&nbsp;".$c->name."/".$s->name."</h3></b></td></tr>";
			echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Roll No.</td><td colspan='1'  align='left'>Name</td><td colspan='1'  align='left'>Phone1</td><td colspan='1'  align='left'>Phone2</td><td colspan='1'  align='left'>Address</td><td colspan='1'  align='left'>Email</td></tr>";
			
			foreach ($query_result as $data)
			{
			
			
				echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".get_student_roll($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_name($data['student_id'])."<td colspan='1'  align='left'>".get_student_phone1($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_phone2($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_address($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_email($data['student_id'])."</td></tr>";
				
				//$dataToExports[]			= $arrangeData;
				$i=$i+1;
			
			}
			
			die();
		}
		
		/////////////////////////////////
		
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Students List";
		$page_data['page_name']        = 'print_students_list1';
		$page_data['page_title']       = 'Students List';
		$page_data['query_result']	   = $query_result;
		$this->load->view('Office_staff/print_students_list1', $page_data);
	}
	
	
	public function student_area_print_report_section($class_id,$section_id)
	{
		$query_result  = $this->db->get_where('enroll',array('class_id'=>$class_id,'section_id'=>$section_id))->result_array();
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
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Students List";
		$page_data['page_name']        = 'print_students_list1';
		$page_data['page_title']       = 'Students List';
		$page_data['query_result']	   = $query_result;
		$this->load->view('Office_staff/print_students_list1', $page_data);
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
		
		if($this->session->userdata('role')==4)
		{
			
			$branch_id=$this->session->userdata('branch_id');
			$dept_id=$this->session->userdata('dept_id');
		}
		if($this->session->userdata('role')==7)
		{
			
			$branch_id=$this->session->userdata('branch_id');
			$dept_id=$this->session->userdata('dept_id');
		}
		if($this->session->userdata('role')==3)
		{
			$branch_id=$this->session->userdata('branch_id');
			
			$dept_id=$this->input->post('department');
		}
		if($this->session->userdata('role')==1 || $this->session->userdata('role')==2)
		{
			$branch_id	=	$this->input->post('branch');
			$dept_id	=	$this->input->post('department');
		}
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
		if($notification =='')
		{
			redirect('Office_staff/student_add/');
		}
		$content = "Admission Message";
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data10['send_by']	=$staff;
		$data10['content']	=  $content;
		$data10['send_date']	=  date('y/m/d');
		$this->db->insert('tbl_sms_delivery_master',$data10);
		$master_id		=	$this->db->insert_id();
		/*if($phone2==1)
		{
		$this->db->select('s.phone2,s.name,s.student_id');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class);
		$this->db->where('e.section_id',$section);
		$a=$this->db->get()->result_array();
		foreach($a as $b)
		{
		if($b['phone2']>0)
		{
		$data1['sms_master_id']	=$master_id;
		$data1['student_id']	=$b['student_id'];
		$data1['class_id']	=$class;
		$data1['section_id']	=$section;
		$data1['phone']	=$b['phone2'];
		$data1['msg_content']	= $content;
		$this->db->insert('tbl_sms_delivery_details',$data1);
		}
		}
		}*/
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
		if($notification =='1'  && $msg=='1')
		{
			$data11['msg_content']	= $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$phone1." and password ".$phone1." ". $additional;
		}
		if($notification =='1' && $msg=='')
		{
			$data11['msg_content']	= $message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$phone1." and password ".$phone1." ". $additional;
		}
		
		$this->db->insert('tbl_sms_delivery_details',$data11);
		$fee_master     = $this->input->post('fee_master');
		if ( $fee_master!='')
		{
			$class_id     = $this->input->post('class_id');
			$section_id	= $this->input->post('section_id');
			$this->assign_student_fee($student_id,$class_id,$section_id,$fee_master);
		}
		if($result>0)
		{
			$data3['action']="success";
		
		}
		$data5['master_id']	=	$master_id;	
		$data5['class_id']	=	$class;
		$data5['section_id']	=	$section;
		redirect('Office_staff/sms_send_admission/'.$phone1.'/'.$master_id);
	}
	
	
	function assign_student_fee($student_id,$class_id,$section_id,$fee_plan) 
	{
		$this->db->select('fee_installment_master_id,fee_total,fee_balance,due_date');
		$this->db->from('tbl_fee_installment_master');
		$this->db->where('fee_master_id',$fee_plan);
		$result=$this->db->get()->result_array();
		foreach($result as $row)
		{
			$concession							=	0;
			$data1['admission_number']			=	$student_id;
			$data1['class_id']					=	$class_id;
			$data1['batch_id']					=	$section_id;
			$data1['fee_master_id']				=	$fee_plan;
			$data1['fee_installment_master_id']	=	$row['fee_installment_master_id'];
			$data1['due_date']					=	$row['due_date'];
			$data1['fee_amount']				=	$row['fee_total'];
			$data1['fee_balance']				=	$row['fee_balance'];
			$data1['fee_concession']			=	$concession;
			$data1['academic_year_id']			=	get_student_academic_year($student_id);
			$this->db->trans_start();
			$this->db->insert('tbl_students_fee_master', $data1);
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

			$this->db->trans_complete();
		}
	}
	
	
	public function teacher_add()
	{
		$this->load->view('Office_staff/add_teacher.php');
	}
	
	
	function add_teacher()
	{
		$name        = $this->input->post('name');
		$username   = $this->input->post('user_name');
		$salary      = $this->input->post('salary');
		$birthday     = $this->input->post('birthday');
		$sex       = $this->input->post('sex');
		$address     = $this->input->post('address');
		$phone       = $this->input->post('phone');
		$email     = $this->input->post('email');
		$password   = $this->input->post('password');
		$teacher_id = $this->crud_model->teacher_insert($name,$username,$salary,$birthday,$sex,$address,$phone,$email,$password);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
		if($teacher_id>0)
		{
			$data10["action"]="success";
		}
		$this->load->view('Office_staff/add_teacher.php',$data10);
	}
	
	
	public function teacher_view()
	{
		$this->load->view('Office_staff/teacher_view.php');
	}
	
	
	function teacher_profile($teacher_id)
	{
		$page_data['teacher_id']  =  $teacher_id;
		$this->load->view('Office_staff/teacher_profile', $page_data);
	}
	function teacher_edit($param1 = '', $param2 = '', $param3 = '')
	{
		if ($param1 == 'do_update') 
		{
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
			redirect(base_url() . 'index.php/Office_staff/teacher_profile/'. $param2, 'refresh');
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
			redirect(base_url() . 'index.php/Office_staff/teacher_profile/'. $param2, 'refresh');
		}
		if ($param1 == 'delete') 
		{
			$this->db->where('teacher_id', $param2);
			$this->db->delete('teacher');
			redirect(base_url() . 'index.php/Office_staff/teacher_view/', 'refresh');
		}
	}
	
	
	public function staff_add()
	{
		$this->load->view('Office_staff/add_staff.php');
	}
	
	
	function add_staff()
	{

		$role=$this->session->userdata('role');
		if($role==1||$role==2)
		{
			$branch_id		=	$this->input->post('branch');
			$dept		=	$this->input->post('department');
		}
		if($role==3)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$dept				=	$this->input->post('department');
		}
		if($role==4)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$dept				=	$this->session->userdata('dept_id');
		}
		$name        = $this->input->post('name');
		$designation        = $this->input->post('designation');
		$birthday     =date('Y-m-d',strtotime($this->input->post('dob')));
		$username   = $this->input->post('user_name');
		$salary      = $this->input->post('salary');
		$sex       = $this->input->post('sex');
		$address     = $this->input->post('address');
		$phone       = $this->input->post('phone');
		$email     = $this->input->post('email');
		$password   = $this->input->post('password');
		$staff_id =$this->crud_model->staff_insert($branch_id,$dept,$name,$designation,$username,$birthday,$salary,$sex,$address,$phone,$email,$password);
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $staff_id . '.jpg');
		if($staff_id>0)
		{
			$data1["action"]="success";
		}
		else
		{
		$data1["action"]="Error";
		}
		$this->load->view('Office_staff/add_staff.php',$data1);
	}
	
	
	public function staff_view()
	{	
	
		$this->load->view('Office_staff/staff_view.php');
	}
	
	
	
	public function staff_view1()
	{	
		$designation	=	$this->input->post('designation');
		if($designation)
		{
			$this->db->where('designation',$designation);
		}
		
		$data['teachers']	=	$this->db->get('staff' )->result_array();
		$this->load->view('Office_staff/staff_view.php',$data);
	}
	
	
	
	function staff_profile($staff_id)
	{
		$page_data['staff_id']  =  $staff_id;
		$this->load->view('Office_staff/staff_profile', $page_data);
	}
	
	
	function staff_edit($param1 = '', $param2 = '', $param3 = '')
	{
		if ($param1 == 'do_update') 
		{
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
			redirect(base_url() . 'index.php/Office_staff/staff_profile/'. $param2, 'refresh');
		}
		if ($param1 == 'change_password') 
        {
           $data['new_password'] = sha1($this->input->post('new_password'));
        $data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) 
            {
                $this->db->where('staff_id', $param2);
				$user=$this->db->get('staff')->row()->user_id;
				$this->db->where('user_id', $user);
                $this->db->update('tbl_users', array('password' => $data['new_password']));
            } 
            redirect(base_url() . 'index.php/Office_staff/staff_profile/'. $param2, 'refresh');
        }
		if ($param1 == 'delete') 
		{
			$this->db->where('staff_id', $param2);
			$this->db->update('staff', array('is_deleted' => 'Y'));
			redirect(base_url() . 'index.php/Office_staff/staff_view/', 'refresh');
		}
	}
	
	
	public function full_attendance()
	{
		$this->load->view('Office_staff/full_attendance.php');
	}
	
	
	function search($search_key = '') 
	{
		$search_key=$this->input->post('search_key');
		$page_data['search_key']    =   $search_key;
		$this->load->view('Office_staff/search.php', $page_data);
	}
	
	
	function full_attendance_selector()
	{
		$data['year']       = $this->input->post('year');
		$a=$this->input->post('timestamp');
		$b  = str_replace('/','-',$a);
		$data['timestamp']=strtotime($b);
		$query = $this->db->get_where('attendance' ,array(
		'year'=>$data['year'],
		'timestamp'=>$data['timestamp']));
		if($query->num_rows() < 1) 
		{
			$students = $this->db->get_where('enroll' , array(
			'year' => $data['year']
			))->result_array();
			foreach($students as $row) 
			{
				$attn_data['class_id']   = $row['class_id'];
				$attn_data['year']       = $data['year'];
				$attn_data['timestamp']  = $data['timestamp'];
				$attn_data['section_id'] = $row['section_id'];
				$attn_data['student_id'] = $row['student_id'];
				$this->db->insert('attendance' , $attn_data);  
			}
		}
		redirect(base_url().'index.php/Office_staff/full_manage_attendance/'.$data['timestamp'],'refresh');
	}
	
	
	public function full_manage_attendance($timestamp)
	{
		$data['timestamp'] = $timestamp;
		$this->load->view('Office_staff/full_manage_attendance.php',$data);
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
		$content ="attendance";
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  $content;
		$data['send_date']	=  date('y/m/d');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id		=	$this->db->insert_id();
		
		
		
		foreach($attendance_of_students as $row) 
		{
			$notification = 0;
			$attendance_status = $this->input->post('status_'.$row['attendance_id']);
			if( 1 == $absent_notification && 2 == $attendance_status )
			{
				$notification = 1;
				$msg = " is absent on ".$date;
			}
			if( 1 == $late_notification && 3 == $attendance_status )
			{
				$notification = 1;
				$msg = " is late on ".$date;
			}
			if( 1 == $late_notification && 4 == $attendance_status )
			{
				$notification = 1;
				$msg = "has no Diary on ".$date;
			}
			if($notification =='1')
			{	
			$en = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row();
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
				$phone2  = $stu->phone2;
				$name  = $stu->name;
				$message = $name. " ".$msg;
				$data1['sms_master_id']	=$master_id;
					$data1['student_id']	=$row['student_id'];
					$data1['class_id']	=$en->class_id;
					$data1['section_id']	=$en->section_id;
					$data1['phone']	=$phone1;
					$data1['msg_content']	= $message;
					$this->db->insert('tbl_sms_delivery_details',$data1);
				
			}
			$this->db->where('attendance_id' , $row['attendance_id']);
			$result= $this->db->update('attendance' , array('status' => $attendance_status));
		}
		$data['master_id']	=	$master_id;	
		$data['class_id']	=	$en->class_id;
		$data['section_id']	=	$en->section_id;
		$this->load->view('Office_staff/message_popup',$data);
	}
	
	
	public function daily_attendance()
	{
		$this->load->view('Office_staff/daily_attendance.php');
	}
	
	
	function get_section($class_id) 
	{
		$page_data['class_id'] = $class_id; 
		$this->load->view('Office_staff/section_holder' , $page_data);
	}
	
	
	function attendance_selector()
    {
	   $role=$this->session->userdata('role');
	   if($role==1 || $role==2)
	   {
	     $data['branch_id']   = $this->input->post('branch');
		 $data['dept_id']   = $this->input->post('department');
		 $data['class_id']   = $this->input->post('class_id');
	   }
	    if($role==3)
	   {
	     $data['branch_id']   = $this->session->userdata('branch_id');
		 $data['dept_id']   = $this->input->post('department');
		 $data['class_id']   = $this->input->post('class_id');
	   }
	    if($role==4)
	   {
	     $data['branch_id']   = $this->session->userdata('branch_id');
		 $data['dept_id']   = $this->session->userdata('dept_id');
		 $data['class_id']   = $this->input->post('class_id');
	   }
	
	
        
		
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
          'branch_id'=>$data['branch_id'],
		   'dept_id'=>$data['dept_id'], 
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
			    $attn_data['branch_id']   = $data['branch_id'];
				$attn_data['dept_id']   = $data['dept_id'];
                $attn_data['class_id']   = $data['class_id'];
                $attn_data['year']       = $data['year'];
                $attn_data['timestamp']  = $data['timestamp'];
                $attn_data['section_id'] = $data['section_id'];
                $attn_data['student_id'] = $row['student_id'];
                $this->db->insert('attendance' , $attn_data);  
            }
        }
     redirect(base_url().'index.php/Office_staff/manage_attendance/'.$data['branch_id'].'/'.$data['dept_id'].'/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'],'refresh');
  // manage_attendance($data['class_id'],$data['section_id'],$data['timestamp']);
    }
	
	function manage_attendance($branch_id = '',$dept_id = '',$class_id = '' , $section_id = '' , $timestamp = '')
	{
	
	//$class_name = $this->db->get_where('student')
      //->row()->name;
        //$page_data['class_id'] = $class_id;
        $data['timestamp'] = $timestamp;
		$data['branch_id']  = $branch_id;
		$data['dept_id']  = $dept_id;
		$data['class_id']  = $class_id;
		$data['section_id'] = $section_id;
		
       // $page_data['page_name'] = 'full_manage_attendance';
        //$section_name = $this->db->get_where('section' , array(
            //'section_id' => $section_id
       // ))->row()->name;
        //$page_data['section_id'] = $section_id;

	
		$this->load->view('Office_staff/manage_attendance',$data);
	}
	function attendance_update($branch_id='',$dept_id='',$class_id = '' , $section_id = '' , $timestamp = '')
    {
	      $date=date('d/m/Y', $timestamp);
			
         $running_year = get_running_year();
        $attendance_of_students = $this->db->get_where('attendance' , array(
           'branch_id'=>$branch_id,'dept_id'=>$dept_id,'class_id'=>$class_id,'section_id'=>$section_id,'year'=>$running_year,'timestamp'=>$timestamp))->result_array();
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
				$msg = " is".$late." late on ".$date;
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
			
			 $return_message_ids = stream_get_contents($send);
			
			                    $message_id_array = explode(",", $return_message_ids);
								
								
								$data['student_id']=	$row['student_id'];
								$data['message']=	$message;
								$data['phone1']	=	$phone1;
								$data['phone2']	=	$phone2;
								$data['sms_code']=	$return_message_ids;
								$data['is_delivered']=	'Y';
								$data['delivered_date']=	date('Y/m/d');
								$this->db->insert('sms_delivery',$data);

			
			
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
			                    $message_id_array = explode(",", $return_message_ids);
								$data['student_id']=	$row['student_id'];
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
			 
			 
			 
			 
			 /*if($notification =='' &&  $additional_message=='1'){
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
                    $message_id_array = explode(",", $return_message_ids);
			/* $message_id_array is the array which contains the message IDs */
			/* You can save it to database */
			
			/*}
			  }*/
            $this->db->where('attendance_id' , $row['attendance_id']);
			 
           $result= $this->db->update('attendance' , array('status' => $attendance_status,'late_time'=>$late));
		   if($result>0){
			$data["action"]="success";
			$data['timestamp'] = $timestamp;
			$data['branch_id']  = $branch_id;
			$data['dept_id']  = $dept_id;
		$data['class_id']  = $class_id;
		$data['section_id'] = $section_id;
			}
        }
		//$this->db->insert('attendance_message',$message1);
		$this->load->view('Office_staff/manage_attendance',$data);
    }
	
	
	public function attendance_report()
	{
		$data['month']        = date('m');
		$this->load->view('Office_staff/attendance_report.php',$data);
	}
	
	
	function attendance_report_selector()
	{
		$data['class_id']   = $this->input->post('class_id');
		$data['year1']       = $this->input->post('year1');
		$data['month'] 	    = $this->input->post('month');
		$data['section_id'] = $this->input->post('section_id');
		redirect(base_url().'index.php/Office_staff/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$data['year1'],'refresh');
	}
	
	
	function report_attendance_view($class_id = '' , $section_id = '', $month = '',$year1='') 
	{
		$data['class_id'] 	= $class_id;
		$data['month']    	= $month;
		$data['section_id'] = $section_id;
		$data['year1'] = $year1;
		$this->load->view('Office_staff/report_attendance_view.php',$data);
	}
	
	
	function attendance_print($class_id ,$section_id ,$month) 
	{
		$page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['month'] =$month;
		$this->load->view('Office_staff/attendance_print' , $page_data);
	}
	
	
	function attendance_messages($class_id,$section_id,$student_id,$present,$total,$percentage,$month)
	{
		$running_year = get_running_year();
		$student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
		$phone1 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone1;
		$phone2 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone2;
		$percentage            = $percentage;
		$month1=$month;
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
		$sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
		$web_url=$sms->web_url;
		if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
		{
			$message = $common."Attendance Report - ".$month. ", Name : ".$student_name.", Working Days : ".$total.", Present : " .$present.", Percentage : ".$percentage.".";
		}
		else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == '')
		{
			$message = "Attendance Report - ".$month. ", Name : ".$student_name.", Working Days : ".$total.", Present : " .$present.", Percentage : ".$percentage.".".$common;
		}			 
		$location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.$phone1.','.$phone2.'&msg=' .urlencode($message." ").'&route=T';
		$api = $url;
		$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
		$balance = stream_get_contents($handle);
		if($balance >= 0)
		{
			$api."/sendsms?".$location;
			$send = fopen($api."/sendsms?".$location,"r");
			$return_message_ids = stream_get_contents($send);
			$message_id_array = explode($return_message_ids); 
		}
		redirect(base_url() . 'index.php/Office_staff/report_attendance_view/'.$class_id.'/'.$section_id.'/'.$month1,'refresh');
	}
	
	
	function view_exam()
	{
		
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->session->userdata('dept_id');
			$this->db->where('branch_id',$branch);
			$this->db->where('dept_id',$dept);
			$page_data['exams']      = $this->db->get('exam')->result_array();
		
		$this->load->view('Office_staff/view_exam', $page_data);
	}
	
	
	function create_exam($param1 = '', $param2 = '' , $param3 = '')
	{
		
		if ($param1 == 'create') 
		{
			$role=$this->session->userdata('role');
			if($role==1 || $role==2)
			{
				$data['branch_id']		=		$this->input->post('branch');
				$data['dept_id']		=		$this->input->post('department');
			}
			if($role==3)
			{
				$data['branch_id']	=		$this->session->userdata('branch_id');
				$data['dept_id']			=		$this->input->post('department');
			}
			if($role==4)
			{
				$data['branch_id']	=		$this->session->userdata('branch_id');
				$data['dept_id']		=		$this->session->userdata('dept_id');
			}
			$data['name']    = $this->input->post('name');
			$data['comment'] = $this->input->post('comment');
			$data['class_id'] = $this->input->post('class');
			$data['year']    = get_running_year();
			$result=$this->crud_model->insert_exam($data);
			if($result>0)
			{
				$data1["action"]="success";
			}
			$this->load->view('Office_staff/create_exam',$data1);
		}
		if ($param1 == 'edit') 
		{
			$data['name']    = $this->input->post('name');
			$data['comment'] = $this->input->post('comment');
			if($this->input->post('class')!='')
			{
				$data['class_id'] = $this->input->post('class');
			}
			if($this->input->post('branch')!='')
			{
				$data['branch_id'] = $this->input->post('branch');
			}
			if($this->input->post('department')!='')
			{
				$data['dept_id'] = $this->input->post('department');
			}
			$data['year']    = get_running_year();
			$this->db->where('exam_id', $param2);
			$this->db->update('exam', $data);
			$page_data['exams']      = $this->db->get('exam')->result_array();
			$this->load->view('Office_staff/view_exam', $page_data);
		} 
		if ($param1 == 'delete') 
		{
			$data['is_deleted']   = "Y";
			$this->db->where('exam_id', $param2);
			$this->db->update('exam', $data);
			redirect(base_url() . 'index.php/Office_staff/view_exam/', 'refresh');
		}
		if ($param1 == 'new') 
		{
			$this->load->view('Office_staff/create_exam');
		}
	}
	
	
	public function edit_unit_exam($exam_id)
	{
		$data['exam_id']=$exam_id;
		$this->load->view('Office_staff/edit_unit_exam.php',$data);
	}
	
	
	public function upload_marks()
	{
		$this->load->view('Office_staff/upload_marks.php');
	}
	
	
	function marks_get_subject($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('Office_staff/marks_get_subject' , $page_data);
	}
	
	
	function marks_get_subject_delete($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('Office_staff/marks_get_subject_delete' , $page_data);
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
		if($query->num_rows() < $query1->num_rows()) 
		{
			$students = $this->db->get_where('enroll' , array(
			'class_id' => $data['class_id'] , 'section_id' => $data['section_id'] , 'year' => $data['year']))->result_array();
			foreach($students as $row) 
			{
				$data['student_id'] = $row['student_id'];
				$dat = $this->db->get_where('mark' , array( 'class_id' => $data['class_id'],'section_id' => $data['section_id'],'exam_id' => $data['exam_id'],
				'subject_id' => $data['subject_id'],'year' => $data['year'],'student_id' =>$data['student_id']));
				if($dat->num_rows()<1)
				{
					$this->db->insert('mark' , $data);
				}
			}
		}
		redirect(base_url() . 'index.php/Office_staff/marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'] , 'refresh');
	}
	
	function marks_upload($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '', $remarks = '')
	{
		$page_data['exam_id']    =   $exam_id;
		$page_data['class_id']   =   $class_id;
		$page_data['subject_id'] =   $subject_id;
		$page_data['section_id'] =   $section_id;
		$page_data['remarks'] =  $remarks;
		$this->load->view('Office_staff/marks_upload', $page_data);
	}
	
	
	function marks_update($class_id = '' ,$section_id = '' ,$exam_id = '',$subject_id)
	{
		$running_year = get_running_year();
		$marks_of_students = $this->db->get_where('mark' , array(
		'exam_id' => $exam_id, 
		'class_id' => $class_id,
		'section_id' => $section_id, 'year' => $running_year,
		'subject_id' => $subject_id))->result_array();
		foreach($marks_of_students as $row) 
		{
			$obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
			$mark_total= $this->input->post('mark_total_'.$row['mark_id']);
			$grade1= $this->input->post('grade_value_'.$row['mark_id']);
			$comnt= $this->input->post('comment');
			$position1= $this->input->post('position_value_'.$row['mark_id']);
			if($grade1=="" && $position1 == "")
			{
				$average = (($obtained_marks /  $mark_total) * 100);
				$p=$this->db->get('grade')->result_array();
				foreach($p as $res)
				{
					if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
					{
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
			if($comnt =="")
			{
				$this->db->where('mark_id' , $row['mark_id']);
				$this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position));
			}
			else
			{
				$this->db->where('mark_id' , $row['mark_id']);
				$this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position, 'comment' =>$comnt));
			}
		}
		redirect(base_url().'index.php/Office_staff/marks_upload/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');
	}
	
	
	function marks_update1($class_id = '' ,$section_id = '' ,$exam_id = '',$subject_id)
	{
		$running_year = get_running_year();
		$marks_of_students= $this->crud_model->get_students_marks($class_id,$section_id,$exam_id,$subject_id,$running_year);
		foreach($marks_of_students as $row) 
		{
			$obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
			$mark_total= $this->input->post('mark_total_'.$row['mark_id']);
			$grade1= $this->input->post('grade_value_'.$row['mark_id']);
			$comnt= $this->input->post('comment');
			$position1= $this->input->post('position_value_'.$row['mark_id']);
			if($grade1=="" && $position1 == "")
			{
				$average = (($obtained_marks /  $mark_total) * 100);
				$p=$this->db->get('grade')->result_array();
				foreach($p as $res)
				{
					if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
					{
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
			if($comnt =="")
			{
				$this->db->where('mark_id' , $row['mark_id']);
				$result=$this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position));
			}
			else
			{
				$this->db->where('mark_id' , $row['mark_id']);
				$result=$this->db->update('mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position, 'comment' =>$comnt));
			}
		}
		if($result>0)
		{
			$page_data["action"]="success";
			$page_data['exam_id']    =   $exam_id;
			$page_data['class_id']   =   $class_id;
			$page_data['subject_id'] =   $subject_id;
			$page_data['section_id'] =   $section_id;
		}
		$this->load->view('Office_staff/marks_upload', $page_data);
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
			redirect(base_url() . 'index.php/Office_staff/grade/', 'refresh');
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
			redirect(base_url() . 'index.php/Office_staff/grade/', 'refresh');
		} 
		$page_data['grade']      = $this->db->get('grade')->result_array();
		$this->load->view('Office_staff/grade', $page_data);
	}
	
	
	public function edit_grade($grade_id)
	{
		$data['grade_id']=$grade_id;
		$this->load->view('Office_staff/grade_edit.php',$data);
	}
	
	
	function rank($class_id = '' ,$section_id= '' ,$exam_id = '' ) 
	{  
		if ($this->input->post('operation') == 'selection') 
		{
			$class_id   = $this->input->post('class_id');
			$section_id   = $this->input->post('section_id');
			$exam_id    = $this->input->post('exam_id');
			$this->crud_model->get_rank($class_id,$section_id,$exam_id);
			$page_data['exam_id']    = $exam_id;
			$page_data['class_id']   = $class_id;
			$page_data['section_id'] = $section_id;
			if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 &&  $page_data['section_id']>0) 
			{
				redirect(base_url() . 'index.php/Office_staff/rank/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
			}
			else 
			{
				redirect(base_url() . 'index.php/Office_staff/rank/', 'refresh');
			}
		}
		$page_data['exam_id']    = $exam_id;
		$page_data['class_id']   = $class_id;
		$page_data['section_id'] = $section_id;
		$this->load->view('Office_staff/rank', $page_data);
	}
	
	
	function subject_message($class,$section,$exam,$grade,$position,$rmark)
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
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	$this->db->where('mark.class_id', $class);
	$this->db->where('mark.section_id', $section);
	$this->db->where('mark.exam_id', $exam);
	$this->db->join('student', 'student.student_id = mark.student_id', 'left');
	$this->db->join('subject', 'subject.subject_id = mark.subject_id', 'left'); // student.name,
	$this->db->join('exam', 'exam.exam_id = mark.exam_id', 'left'); // student.name,
	$this->db->select('mark.comment,mark.student_id, mark.mark_obtained,mark.mark_total,mark.grade,mark.position,student.name as student,student.phone1,student.phone2,subject.name as subject,exam.name as exam');  
	$cls = $this->db->get('mark')->result_array();
	$student_array = array();
	foreach ($cls as $cl) {
	$stu_id = $cl['student_id'];
	$student_array[$stu_id]['data'][] = $cl;
	$student_array[$stu_id]['name'] = $cl['student'];
	$student_array[$stu_id]['exam'] = $cl['exam'];
	$student_array[$stu_id]['phone1'] = $cl['phone1'];
	$student_array[$stu_id]['phone2'] = $cl['phone2'];
	}
	$remark = null === $this->input->post('remarks_check') ? 0 : 1;
	$count = 0;
	foreach ($student_array as $stu_array) {
	$notification = 0;
	$phone = $stu_array['phone1'];
	foreach ($data as $dt) {
	if($remark==1)
	{
	$rmrk= $dt['comment'];
	}
	else
	{
	$rmrk =" ";
	}
	
	if($grade==0 && $position==0)
	{
	$msg=" ";
	}
	if($grade==1 && $position==1)
	{
	$msg="Grade and Position - ".$dt['grade']." ".$dt['position'];
	}
	else if($grade==1 && $position==0)
	{
	}
	else if($grade==0 && $position==1)
	{
	$msg="Position -".$dt['position'];
	}
	echo  $message .= " " . $dt['mark_obtained'] . "/" . $dt['mark_total'] . " for " . $dt['subject']." " .$msg." ".$rmrk;
	die();
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$student_id;
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$phone;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('Office_staff/message_popup',$data);
	}
	
	
	function subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark){
		$this->crud_model->subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark);
	}
	
	
	function get_report($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('Office_staff/get_report' , $page_data);
	}
	
	
	function get_prog_report($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('Office_staff/get_prog_report' , $page_data);
	}
	
	
	function rank_print($class_id ,$section_id ,$exam_id) 
	{
		$page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['exam_id'] =$exam_id;
		$this->load->view('Office_staff/rank_print' , $page_data);
	}
	
	
	function tab_sheet($class_id = '' ,$section_id= '' ,$exam_id = '' ) 
	{
		if ($this->input->post('operation') == 'selection') 
		{
			$page_data['class_id']   = $this->input->post('class_id');
			$page_data['section_id']   = $this->input->post('section_id');
			$page_data['exam_id']    = $this->input->post('exam_id');
			if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0) 
			{
				redirect(base_url() . 'index.php/Office_staff/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
			} 
			else 
			{
				redirect(base_url() . 'index.php/Office_staff/tab_sheet/', 'refresh');
			}
		}
		$page_data['exam_id']    = $exam_id;
		$page_data['class_id']   = $class_id;
		$page_data['section_id'] = $section_id;
		$this->load->view('Office_staff/tab_sheet', $page_data);
	}
	
	
	public function mark_print_report($class_id,$section_id,$exam_id)
	{
		$condition = " where  class_id=". $class_id. " and section_id=". $section_id;
		$sql = "select student_id from enroll " . $condition ;
		$query_result = $this->db->query($sql)->result_array();
		ob_start();
		ob_get_clean();
		$total = 0;
		$i=1;
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
			foreach($q as $v)
			{
				$arrangeData[$v['subject']] 		= " ".$v['mark_obtained'].'/'.$v['mark_total'];
			}
			$i=$i+1;
			$dataToExports[]			= $arrangeData;
		}
		$filename = "Students_Mark_List.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		$this->exportExcelData($dataToExports);
		die();
	}
	
	
	public function exportExcelData($records)
	{
		$heading = false;
		if (!empty($records))
		foreach ($records as $row) 
		{
			if (!$heading) 
			{
				echo implode("\t", array_keys($row)) . "\n";
				$heading = true;
			}
			echo implode("\t", ($row)) . "\n";
		}
	}
	
	
	function tab_sheet_print($class_id ,$section_id, $exam_id) 
	{
		$page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['exam_id']  = $exam_id;
		$this->load->view('Office_staff/tab_sheet_print' , $page_data);
	}
	
	
	function news_add() 
	{
		$this->load->view('Office_staff/news_add');
	}
	
	
	function news($param1 = '', $param2 = '') 
	{
		if ($param1 == 'create') 
		{
			$news_code = $this->crud_model->create_news();
			redirect(base_url() . 'index.php/Office_staff/news_view/details/' . $news_code , 'refresh');
		}
		if ($param1 == 'delete') 
		{
			$this->db->where('news_code' , $param2);
			$this->db->delete('news');
			redirect(base_url() . 'index.php/Office_staff/news/', 'refresh');
		}
		$this->load->view('Office_staff/news');
	}
	
	
	function news_view($param1 = '' , $param2 = '')
	{
		if ($param1 == 'details') 
		{
			$page_data['room_page'] = 'details';
			$page_data['news_code'] = $param2;
		}
		$page_data['news']= $this->db->get_where('news',array('news_code'=>$param2))->row()->title;
		$this->load->view('Office_staff/news_overview', $page_data);
	}
	
	
	function news_message($param1 = '', $param2 = '', $param3 = '') 
	{
		if ($param1 == 'add') 
		{
			$this->crud_model->create_news_message($param2);
			redirect(base_url() . 'index.php/Office_staff/news_view/details/' . $param2, 'refresh');
		}
	}
	
	function homework_add() 
	{    
		$this->load->view('Office_staff/homework_add');
	}
	
	
	function homework_view() 
	{    
		$this->load->view('Office_staff/homework1');
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
			if($homework_code>0)
			{
				$data['action']="success";
			}
			$this->load->view('Office_staff/homework_add',$data);      
		}
		if ($param1 == 'edit') 
		{
			$this->crud_model->update_homework($param2);
			redirect(base_url() . 'index.php/Office_staff/homework_view/' , 'refresh');
		}
		if ($param1 == 'delete')
		{
			$this->crud_model->delete_homework($param2);
			redirect(base_url() . 'index.php/Office_staff/homework_view/', 'refresh');
		}
	}
	
	
	function homeworkroom($param1 = '' , $param2 = '')
	{
		if ($param1 == 'file') 
		{
			$page_data['room_page']    = 'homework_file';
			$page_data['homework_code'] = $param2;
		}  
		else if ($param1 == 'details') 
		{
			$page_data['room_page'] = 'homework_details';
			$page_data['homework_code'] = $param2;
		}
		else if ($param1 == 'edit') 
		{
			$page_data['room_page'] = 'homework_edit';
			$page_data['homework_code'] = $param2;
		}
		$page_data['page_title']=$this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
		$this->load->view('Office_staff/homework_room', $page_data);
	}
	
	
	function homeworkroom_edit($param1 = '' , $param2 = '')
	{
		if ($param1 == 'edit') 
		{
			$page_data['homework_code'] = $param2;
		}
		$page_data['page_title']=$this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
		$this->load->view('Office_staff/homework_edit', $page_data);
	}
	
	
	function study_material($task = "", $document_id = "")
	{
		if ($task == "create")
		{
			$result=$this->crud_model->save_study_material_info();
			if($result>0)
			{
				$data['action']="success";
			}
			$this->load->view('Office_staff/modal_study_material_add.php',$data);
		}
		if ($task == "update")
		{
			$this->crud_model->update_study_material_info($document_id);
			redirect(base_url() . 'index.php/Office_staff/study_material' , 'refresh');
		}
		if ($task == "delete")
		{
			$this->crud_model->delete_study_material_info($document_id);
			redirect(base_url() . 'index.php/Office_staff/study_material');
		}
	}
	
	function study_material_add()
	{
		$this->load->view('Office_staff/modal_study_material_add.php');
	}
	
	
	function study_material_view()
	{
		$data['study_material_info']    = $this->crud_model->select_study_material_info();
		$this->load->view('Office_staff/study_material', $data);    
	}
	
	
	public function study_material_edit($id)
	{
		$data['id']=$id;
		$this->load->view('Office_staff/study_material_edit.php',$data);
	}
	
	
	function view_complaints() 
	{
		$this->load->view('Office_staff/view_complaints');
	}
	
	
	function complaint_description_view($param1 = '' , $param2 = '')
	{
		if ($param1 == 'details') 
		{
			$page_data['report_code'] = $param2;
		}
		$page_data['page_title'] =$this->db->get_where('reporte_alumnos',array('report_code'=>$param2))->row()->title;
		$this->load->view('Office_staff/complaint_details', $page_data);
	}
	
	
	function complaint_remark($param1 = '', $param2 = '')
	{
		if($param1 == 'create')
		{
			$this->crud_model->complaint_remark($param2);
			redirect(base_url() . 'index.php/Office_staff/view_complaints/', 'refresh');
		}
	}
	function view_enquiry() 
	{
		$this->load->view('Office_staff/veiw_enquiry');
	}
	
	
	function enquiry_description_view($param1 = '' , $param2 = '')
	{
		if ($param1 == 'details') 
		{
			$page_data['enquiry_id'] = $param2;
		}
		$page_data['page_title']= $this->db->get_where('enquiry',array('enquiry_id'=>$param2))->row()->title;
		$this->load->view('Office_staff/enquiry_details', $page_data);
	}
	
	
	function enquiry_remark($param1 = '', $param2 = '')
	{
		if($param1 == 'create')
		{
			$this->crud_model->enquiry_remark($param2);
		}
		redirect(base_url() . 'index.php/Office_staff/view_enquiry/', 'refresh');
	}
	
	
	function general_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($param1 == 'do_update') 
		{
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
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if ($param1 == 'socials') 
		{
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
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_logo') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if ($param1 == 'ad') 
		{
			$data['description'] = $this->input->post('ad');
			$this->db->where('type' , 'ad');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_slider') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider1.png');
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_slider2') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider2.png');
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_slider3') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider3.png');
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		if($param1 == 'skin_colour')
		{
			$data['description'] = $this->input->post('skin_colour');
			$this->db->where('type' , 'skin_colour');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/Office_staff/general_settings/', 'refresh');
		}
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('Office_staff/general_settings', $page_data);
	}
	
	
	function Office_staff_settings($param1 = '', $param2 = '', $param3 = '')
	{
		if ($param1 == 'do_update') 
		{
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
			$data['description'] = $this->input->post('students_enquiry');
			$this->db->where('type' , 'students_enquiry');
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
			$data['description'] = $this->input->post('branch');
			$this->db->where('type' , 'branch');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('designation');
			$this->db->where('type' , 'designation');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('attendance');
			$this->db->where('type' , 'attendance');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('department');
			$this->db->where('type' , 'department');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('h_attendance');
			$this->db->where('type' , 'hourly_attendance');
			$this->db->update('settings' , $data);
			redirect(base_url() .'index.php/Office_staff/Office_staff_settings/', 'refresh');
		}
		if ($param1 == 'ad') 
		{
			$data['description'] = $this->input->post('ad');
			$this->db->where('type' , 'ad');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/Office_staff/Office_staff_settings/', 'refresh');
		}
		if ($param1 == 'create') 
		{
			$data['url'] = $this->input->post('url');
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');
			$data['sender_id'] = $this->input->post('sender_id');
			$data['common_word'] = $this->input->post('common_word');
			$data['web_url'] = $this->input->post('web_url');
			$this->db->where('id' ,1);
			$this->db->update('sms_settings' , $data);
			redirect(base_url() . 'index.php/Office_staff/Office_staff_settings/', 'refresh');
		}
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('Office_staff/Office_staff_settings', $page_data);
	}
	
	
	function advanced_settings() 
	{
		$this->load->view('Office_staff/advanced_settings');
	}
	
	
	function attendance_delete() 
	{
		$this->load->view('Office_staff/attendance_delete');
	}
	
	
	function delete_attendance() 
	{
		$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
		$date2=$this->input->post('timestamp1');
		$date1=strtotime($date2);
		$result=$this->crud_model->delete_attendance($class_id,$section_id,$date1);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('Office_staff/attendance_delete',$data);    
	}
	
	
	function unit_test_delete() 
	{
		$this->load->view('Office_staff/unit_test_delete');
	}
	
	
	function marks_get_subject1($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('Office_staff/unit_test_delete1' , $page_data);
	}
	
	
	function delete_unit_test() 
	{
		$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
		$exam_id=$this->input->post('exam_id');
		$result=$this->crud_model->delete_unit_test($class_id,$section_id,$exam_id);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('Office_staff/unit_test_delete',$data);
	}
	
	
	function subject_unit_test_delete() 
	{
		$this->load->view('Office_staff/subject_unit_test_delete');
	}
	
	
	function delete_class() 
	{
		$this->load->view('Office_staff/delete_class');
	}

	
	function delete_section() 
	{
		$this->load->view('Office_staff/section_delete');
	}
	
	
	function delete_subject() 
	{
		$this->load->view('Office_staff/delete_subject');
	}
	
	
	function marks_get_subject2($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('Office_staff/delete_get_subject' , $page_data);
	}
	
	
	function delete_unit_test_subject() 
	{
		$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
		$exam_id=$this->input->post('exam_id');
		$subject_id=$this->input->post('subject_id');
		$result=$this->crud_model->delete_unit_test_subject($class_id,$section_id,$exam_id,$subject_id);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('Office_staff/subject_unit_test_delete',$data);
	}
	
	
	function delete_class_bulk() 
	{
		$class_id=$this->input->post('class_id');
		$result=$this->crud_model->delete_class_bulk($class_id);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('Office_staff/delete_class',$data);
	}
	
	
	function delete_section_bulk() 
	{
		$class_id=$this->input->post('class_id');

		$section_id=$this->input->post('section_id');
		$result=$this->crud_model->delete_section_bulk($class_id,$section_id);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('Office_staff/section_delete',$data);
	}
	
	
	function delete_subject_bulk() 
	{
		$class_id=$this->input->post('class_id');
		$subject_id=$this->input->post('subject_id');
		$result=$this->crud_model->delete_subject_bulk($class_id,$subject_id);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('Office_staff/delete_subject',$data);
	}
	
	
	function message()
	{
		$this->load->view('Office_staff/message');
	}
	
	
	function get_absent_student_for_message($class, $section, $date)
	{
		$timestamp = strtotime($date);
		$this->db->where('class_id', $class);
		$this->db->where('section_id',$section);
		$this->db->where('timestamp',$timestamp);
		$this->db->where('status','2');
		$this->db->join('student', 'student.student_id = attendance.student_id');
		$this->db->select('attendance.student_id, student.name');
		$cls = $this->db->get('attendance')->result_array();
		$data['student'] = $cls;
		$data['date']		=$timestamp;
		$this->load->view('Office_staff/absent_message_student_list', $data);
	}
	
	
	function get_special_message_students($class='', $section='')
	{
		$this->db->where('class_id', $class);
		$this->db->where('section_id',$section);
		$this->db->join('enroll', 'enroll.student_id = student.student_id');
		$this->db->select('student.student_id, student.name');
		$cls = $this->db->get('student')->result_array();
		$data['student'] =$cls;
		$data['class']	=	 $class;
		$data['section']	=	 $section;
		$this->load->view('Office_staff/special_message_list', $data);
	}
	
	
	function new_private_message() 
	{
		$ph='';
		$ph2='';
		$class =$this->input->post('class');
		$section = $this->input->post('section');
		$content = $this->input->post('message');
		$phone2= $this->input->post('phone2');
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  $content;
		$data['send_date']	=  date('y/m/d');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id		=	$this->db->insert_id();
		if($phone2==1)
		{
			$this->db->select('s.phone2,s.name,s.student_id');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.class_id',$class);
			$this->db->where('e.section_id',$section);
			$a=$this->db->get()->result_array();
			foreach($a as $b)
			{
				if($b['phone2']>0)
				{
					$data1['sms_master_id']	=$master_id;
					$data1['student_id']	=$b['student_id'];
					$data1['class_id']	=$class;
					$data1['section_id']	=$section;
					$data1['phone']	=$b['phone2'];
					$data1['msg_content']	= $content;
					$this->db->insert('tbl_sms_delivery_details',$data1);
				}
			}
		}
		$this->db->select('s.phone1,s.name,s.student_id');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class);
		$this->db->where('e.section_id',$section);
		$a=$this->db->get()->result_array();
		foreach($a as $b)
		{
			$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$b['student_id'];
			$data1['class_id']	=$class;
			$data1['section_id']	=$section;
			$data1['phone']	=$b['phone1'];
			$data1['msg_content']	= $content;
			$this->db->insert('tbl_sms_delivery_details',$data1);
		}
		$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$this->load->view('Office_staff/message_popup',$data);
	}
	
	
	function sms_send_popup($master_id)
	{
	
	$ph='';
	$this->db->select('details_id,phone,msg_content,GROUP_CONCAT(phone) as ph');
	$this->db->from('tbl_sms_delivery_details');
	$this->db->where('sms_master_id',$master_id);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	
	{
	$ph=$b['ph'];
	
	
	}
	
	
	$ph;
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	$message= " Hi ".$b['msg_content']." ";
	
	//$message1= $content." "; 
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	
	
	$this->db->where('sms_master_id',$master_id);
	$a1= $this->db->get('tbl_sms_delivery_details')->result_array();
	
	
	$i=0;
	foreach($a1 as $b1)
	{
	$str = filter_var($message_id_array[$i], FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b1['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	
	
	
	}
	}
	?><script>alert("Message Send Successfully")</script>
	
	
	<?php redirect(base_url() . 'index.php/Office_staff/message' , 'refresh');
	
	
	
	
	}
	
	
	function sms_send_popup1($master_id)
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
	$this->db->select('details_id,student_id,phone,s.name as student_name');
	$this->db->from('tbl_sms_delivery_details d');
	$this->db->join('student s','s.student_id=d.student_id','LEFT');
	$this->db->where('sms_master_id',$master_id);
	
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	
	{
	$phone1= $b['phone'];
	$student_name= $b['student_name']; 
	
	
	
	
	$message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$b['phone1']." and password ".$b['phone1']."";
	
	//$message1= $content." "; 
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	
	$str = filter_var($message_id_array[$i], FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	
	
	
	}
	}  
	?><script>alert("Message Send Successfully")</script>
	
	
	<?php //redirect(base_url() . 'index.php/Office_staff/message' , 'refresh');
	
	
	$this->load->view('Office_staff/message.php');
	
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
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone.'&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	
	$str = filter_var($message_id_array, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$details);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	
	
	
	}
	
	$this->load->view('Office_staff/add_student.php');
	
	}
	
	
	function sms_send_admission_bulk($phone,$master_id)
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
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone.'&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	
	$str = filter_var($message_id_array, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$details);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	
	
	
	
	}
	
	//$this->load->view('Office_staff/add_student.php');
	
	}
	
	function sms_send_resend($master_id)
	{
	
	$ph='';
	$this->db->select('details_id,phone,msg_content,GROUP_CONCAT(phone) as ph');
	$this->db->from('tbl_sms_delivery_details');
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed !=',2);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	
	{
	$ph=$b['ph'];
	
	
	}
	
	
	$ph;
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	$message= " Hi ".$b['msg_content']." ";
	
	//$message1= $content." "; 
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	
	$this->db->where('processed !=',2);
	$this->db->where('sms_master_id',$master_id);
	$a1= $this->db->get('tbl_sms_delivery_details')->result_array();
	
	
	$i=0;
	foreach($a1 as $b1)
	{
	$str = filter_var($message_id_array[$i], FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b1['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	
	
	
	}
	}
	
	
	
	
	//}
	
	//}
	
	//}
	//}
	?><script>alert("Message Send Successfully")</script>
	
	
	<?php //redirect(base_url() . 'index.php/Office_staff/message' , 'refresh');
	
	
	//$this->load->view('Office_staff/message.php',$page_data);
	
	}
	
	
	
	function sms_report()
	{
	 $yesterday=date('Y-m-d',strtotime("-1 days"));
	
	$this->db->where('send_date<=',$yesterday);
	$this->db->delete('tbl_sms_delivery_master');
	$this->load->view('Office_staff/sms_report.php');
	}
	function sms_que_report()
	{
	$this->load->view('Office_staff/sms_que_report.php');
	}
	function sms_deatail_report($master_id)
	{
	$data['master_id']	=	$master_id;
	$this->load->view('Office_staff/sms_details_report.php',$data);
	}
	function sms_que_deatail_report($master_id)
	{
	$data['master_id']	=	$master_id;
	$this->load->view('Office_staff/sms_que_details_report.php',$data);
	}
	function delete_sms_pop_up($master_id)
	{
	$this->db->where('sms_master_id',$master_id);
	$this->db->delete('tbl_sms_delivery_master');
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->delete('tbl_sms_delivery_details');
	
	//$data['master_id']	=$master_id;
	//$this->load->view('Office_staff/message.php');
	redirect('Office_staff/message');
	}
	function delete_sms_pop_up1($master_id)
	{
	
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed',0);
	$this->db->delete('tbl_sms_delivery_details');
	
	//$data['master_id']	=$master_id;
	$this->load->view('Office_staff/message.php');
	}
	
	
	function sms_deatail_report1($master_id)
	{
	$msg_code='';
	$this->db->select('details_id,msg_code,processed,GROUP_CONCAT(msg_code) as code');
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed !=',2);
	$msg_code=$this->db->get('tbl_sms_delivery_details')->result_array();
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	$api = $url;
	foreach($msg_code as $row)
	{
	$msg_code=$row['code'];
	}
	
	
	$send = fopen($api . "/getdelivery/" . $username . "/" . $password . "/".$msg_code, "r");
	
	$status = stream_get_contents($send);
	
	$status_array = explode(",", $status) ;
	
	
	//$str = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $status_array);
	//$str1='Delivered';
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed !=',2);
	$msg_code1=$this->db->get('tbl_sms_delivery_details')->result_array();
	$i=0;
	foreach($msg_code1 as $row1)
	{
	$str = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $status_array[$i]);
	$str1='Delivered';
	
	
	
	if($str ==$str1)
	{
	
	$this->db->set('processed', 2);
	}
	
	$this->db->set('status', $str);
	
	$this->db->where('details_id',$row1['details_id']);
	$this->db->update('tbl_sms_delivery_details');
	$i++;	
	
	}
	$data['master_id']	=	$master_id;
	$this->load->view('Office_staff/sms_details_report.php',$data);
	
	
	}
	
	
	
	
	
	
	function resend_sms($details_id)
	{
	$this->db->where('details_id',$details_id);
	$query=$this->db->get('tbl_sms_delivery_details')->row();
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	$message= " Hi ".$query->msg_content." ";
	$ph=$query->phone;
	//$message1= $content." "; 
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' .$ph. '&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
	$api = $url;
	
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	

	$return_message_ids = stream_get_contents($send);
	//$message_id_array = explode(",", $return_message_ids);
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	
	//$message_id_array = explode(",", $return_message_ids);
	
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$details_id);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	
	
	
	
	}
	redirect('Office_staff/sms_report');
	
	}
	function resend_all($master_id)
	{
	$data['master_id']	=	$master_id;
	$this->load->view('Office_staff/resend_all.php',$data);
	}
	
	function absent_message() 
	{
	$absent_date1=$this->input->post('timestamp');
	$absent_date=gmdate('d/m/Y',$absent_date1);
	$message_thread_code = $this->crud_model->send_new_absent_message($absent_date);
	}
	
	function new_notification_message() {
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	$web_url=$sms->web_url;
	$class =$this->input->post('class');
	$section = $this->input->post('section');
	$content = "Greetings from Login2 IT solutions.You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from school.login2.in site  with following details.username () and password ()";
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	
	$this->db->select('s.phone1,s.name,s.student_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$b['phone1'];
	$data1['msg_content']	=  "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$b['phone1']." and password ".$b['phone1']."";
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('Office_staff/message_popup2',$data);
	
	
	}
	function special_message() 
	{
	$class =$this->input->post('class');
	
	
	$section = $this->input->post('section');
	$content = $this->input->post('message1');
	//$phone2= $this->input->post('phone2');
	$student = $this->input->post('student');
	$student_count=count($student);
	if (count($student) > 0) {
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	
	/*$this->db->select('s.phone1,s.name,s.student_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();*/
	
	for($i=0;$i<$student_count;$i++)
	{
	$this->db->select('phone1');
	$this->db->where('student_id',$student[$i]);
	$a=$this->db->get('student')->row();
	
	
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$student[$i];
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$a->phone1;
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('Office_staff/message_popup1',$data);
	
	//$message_thread_code = $this->crud_model->send_new_special_message();
	
	
	}
	function new_malayalam_message() {
	$class =$this->input->post('class');
	$section = $this->input->post('section');
	$content = $this->input->post('message');
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	/*if($phone2==1)
	{
	$this->db->select('s.phone2,s.name,s.student_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	if($b['phone2']>0)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$b['phone2'];
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	}*/
	$this->db->select('s.phone1,s.name,s.student_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$b['phone1'];
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('Office_staff/message_popup',$data);
	
	}
	function get_grade($g)
	{
	
	$sections = $this->db->get_where('mark' , array('id' => $g
	))->result_array();
	foreach ($sections as $row) {
	echo  $row['exam_id'] ;
	}
	}
	
	function class_add()
	{
	$this->load->view('Office_staff/add_class.php');
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	
	function view_subject($class_id= '',$branch_id= '',$dept_id= '')
	{
	
	$page_data['class_id']=$class_id;
	$page_data['branch_id']=$branch_id;
	$page_data['dept_id']=$dept_id;
	$page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
	$this->load->view('Office_staff/view_subject.php',$page_data);
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	function add_class()
	{
	$role=$this->session->userdata('role');  
	if($role==1|| $role==2)
	{
	$data['branch_id']	=	$this->input->post('branch');
	$data['dept_id']	=	$this->input->post('department');
	}
	else if($role==3)
	{
	$data['branch_id']	=	$this->session->userdata('branch_id'); 
	$data['dept_id']	=	$this->input->post('department');
	}
	else if($role==4)
	{
	$data['branch_id']	=	$this->session->userdata('branch_id'); 
	$data['dept_id']	=	$this->session->userdata('dept_id'); 
	}
	
	$data['name']         = $this->input->post('class');
	
	$class_id =$this->crud_model->class_insert($data);
	$data2['class_id']  =   $class_id;
	$data2['name']      =   'A';
	$result=$this->crud_model->manage_classes($data2);
	if($result>0){
	$data1["action"]="success";
	}
	$this->load->view('Office_staff/add_class.php',$data1);
	
	
	}
	
	function delete_student($student_id,$class_id)
	{
	$data['class_id']=$class_id;
	$this->crud_model->student_delete($student_id);
	redirect(base_url() . 'index.php/Office_staff/students_area/'.$data['class_id']);
	
	}		
	
	
	function view_class()
	{
	$branch		=		$this->session->userdata('branch_id');
	$dept		=		$this->session->userdata('dept_id');
	$this->db->select('name,class_id,branch_id,dept_id');
	$this->db->from('class');
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$page_data['class']    =   $this->db->get()->result_array();
	
	$this->load->view('Office_staff/view_class.php',$page_data);
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	function new_subject_add($class_id,$branch_id,$dept_id)
	{
	$page_data['class_id'] =$class_id;
	$page_data['branch_id'] =$branch_id;
	$page_data['dept_id'] =$dept_id;
	$this->load->view('Office_staff/add_subject.php',$page_data);
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	function view_class_edit($class_id)
	{
	$this->load->Model('crud_model');
	$class_name['class_id']=$class_id;
	$class_name['a']    = $this->crud_model->get_class_name($class_id);
	$this->load->view('Office_staff/view_class_edit.php',$class_name);
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	function subject_edit($class_id,$branch_id,$dept_id,$subject_id,$teacher_id)
	{
	$data['class_id']=$class_id;
	$data['branch_id']=$branch_id;
	$data['dept_id']=$dept_id;
	$data['subject_id']=$subject_id;
	$data['teacher_id']=$teacher_id;
	$this->load->view('Office_staff/subject_edit.php',$data);
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	function update_subject($class_id,$branch_id,$dept_id)
	{  
	$data['class_id']	=$this->input->post('class_id');
	
	$p               	= $this->input->post('subject');
	$data['name']       = $this->input->post('name');
	$data['teacher_id']	=$this->input->post('teacher_id');
	
	$this->crud_model->subject_edit($data,$p);
	redirect(base_url() . 'index.php/Office_staff/view_subject/'. $data['class_id'].'/'.$branch_id.'/'.$dept_id, 'refresh'); 
	}       
	function edit_class()
	{
	$data['class_id']         = $this->input->post('cls_id');
	$data['name']         = $this->input->post('name');
	$data['branch_id']         = $this->input->post('branch');
	$data['dept_id']         = $this->input->post('department');                                        
	$this->load->Model('crud_model');
	$this->crud_model->update_classes($data['class_id'],$data['name']);
	redirect(base_url() . 'index.php/Office_staff/view_class/', 'refresh'); 
	
	}
	function view_class_delete($class_id)
	{
	$this->load->Model('crud_model');
	
	$this->crud_model->delete_classes($class_id);
	
	
	redirect(base_url() . 'index.php/Office_staff/view_class/', 'refresh'); 
	
	}
	function subject_delete($subject_id,$class_id)
	{
	$this->crud_model->subject_delete($subject_id);
	
	
	redirect(base_url() . 'index.php/Office_staff/view_subject/'.$class_id, 'refresh'); 
	
	}
	function section($class_id = '')
	{
	if ($class_id == '')
	$class_id           =   $this->db->get('class')->first_row()->class_id;
	
	$page_data['class_id']   = $class_id;
	$this->load->view('Office_staff/add_section.php',$page_data);
	}
	function view_section_add($class_id)
	{
	$this->load->Model('crud_model');
	$class_name['class_id']=$this->input->post('class');
	$class_name['a']    = $this->crud_model->get_class_name($class_name['class_id']);
	$class_name['cls']	=$class_id;
	$this->load->view('Office_staff/view_section_add.php',$class_name);
	//redirect(base_url().'index.php?Office_staff/create')
	
	}
	function add_section()
	{
	$data['name']       =   $this->input->post('name');
	$data['class_id']   =   $this->input->post('class_id');
	$data['teacher_id'] =   $this->input->post('teacher_id');
	
	$result=$this->crud_model->add_section($data);
	$this->db->select('user_id');
	$this->db->from('staff');
	$this->db->where('staff_id',$this->input->post('teacher_id'));
	$query=$this->db->get()->row();
	$data1['user_role_id']  =5;
	$this->db->where('user_id',$query->user_id);
	$this->db->update('tbl_users',$data1);
	if($result>0){
	$data["action"]="success";
	}
	//redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
	$this->load->view('Office_staff/view_section_add.php',$data);}
	function section_edit($class_id,$section_id)
	{
	$data['class_id']       = $class_id;
	$data['section_id']   =   $section_id;
	$this->load->view('Office_staff/section_edit.php',$data);
	}
	function update_section()
	{
	$param2=$this->input->post('section');
	$data['name']       =   $this->input->post('name');
	$data['class_id']   =   $this->input->post('class_id');
	
	$data['teacher_id'] =   $this->input->post('teacher_id');
	$this->load->Model('crud_model');
	$this->crud_model->edit_section( $data,$param2);
	redirect(base_url() . 'index.php/Office_staff/section/' . $data['class_id'] , 'refresh');
	}
	function section_delete($section_id)
	{
		$section_row = $this->db->get_where('section', array('section_id' => $section_id))->row();
		$class_id = isset($section_row->class_id) ? $section_row->class_id : '';
		$this->load->Model('crud_model');
		$this->crud_model->delete_section($section_id);
		if (!empty($class_id)) {
			redirect(base_url() . 'index.php/Office_staff/section/' . $class_id, 'refresh');
		} else {
			redirect(base_url() . 'index.php/Office_staff/section', 'refresh');
		}
	}
	function add_subject($class_id)
	{
	
	
	$data['name']       = $this->input->post('name');
	$data['class_id']   = $class_id;
	$data['teacher_id'] = $this->input->post('teacher_id');
	
	$data['year']       = get_running_year();
	$result=$this->crud_model->subject_add($data);
	if($result>0){
	$page_data['action']="success";
	$page_data['class_id']=$class_id;
	//$page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
	
	}
	//redirect(base_url() . 'index.php/Office_staff/view_subject/'.$class_id, 'refresh');
	$this->load->view('Office_staff/add_subject.php',$page_data);
	}
	function class_migration(){
	$this->load->view('Office_staff/class_migration.php');
	}
	function migrate_check($class, $section){
	
	
	$cls = $this->crud_model->migrate_check($class,$section);
	$data['student'] =$cls;
	
	$this->load->view('Office_staff/check_migration.php', $data);
	
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
	$result=$this->crud_model->class_migrate($data,$stud);
	
	
	//var_dump($stud);
	}}
	if($result>0){
	$data["action"]="success";
	}
	//var_dump($class);
	//var_dump($section);
	$this->load->view('Office_staff/class_migration.php',$data);
	}
	function sms_template() 
	{
	
	
	$page_data['sms']    = $this->db->get('sms_template')->result_array();
	$this->load->view('Office_staff/sms_template.php',$page_data);
	}
	function new_sms_template() 
	{
	$this->load->view('Office_staff/new_sms_template.php');
	}
	function sms_template_add() 
	{
	
	
	 $data['title']           = $this->input->post('title');
            $data['content']           = $this->input->post('content');
			$this->db->insert('sms_template', $data);
             redirect('Office_staff/sms_template');
	}
	function sms_settings() 
	{
	
	$this->load->view('Office_staff/sms_settings.php');
	}
	function student_bulk() 
	{
	
	$this->load->view('office_staff/student_bulk.php');
	}
	function add_template() 
	{
	$this->load->view('Office_staff/add_template.php');
	}
	function template_edit($id) 
	{
	$data['t_id']           =$id;
	$this->load->view('Office_staff/edit_template.php',$data);
	}
	
	function report() 
	{
	$this->load->view('Office_staff/report.php');
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
	
	$result=$this->crud_model->template_edit($data,$id);
	if($result>0){
	$data["action"]="success";
	$data['sms']    = $this->db->get('sms_template')->result_array();
	}
	$this->load->view('Office_staff/sms_template.php',$data);
	}
	function insert_template() 
	{
	$data['title']           = $this->input->post('name');
	$data['content']           = $this->input->post('content');
	$result=$this->crud_model->template_create($data);
	if($result>0){
	$data["action"]="success";
	}
	//redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
	$this->load->view('Office_staff/add_template.php',$data);
	}
	function template_delete($id) 
	{
	$this->crud_model->template_delete($id);
	redirect(base_url() . 'index.php/Office_staff/sms_template/', 'refresh');
	}
	
	function get_template_content($id)
	{
	
	$sections = $this->db->get_where('sms_template' , array('id' => $id
	))->result_array();
	foreach ($sections as $row) {
	echo  $row['content'] ;
	}
	}
	
	function get_template_content1($id)
	{
	
	$sections = $this->db->get_where('sms_template' , array('id' => $id
	))->result_array();
	foreach ($sections as $row) {
	echo  $row['content'] ;
	}
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
	if($this->session->userdata('role')==4)
	{
	$branch	=$this->session->userdata('branch_id');
	$dept	=$this->session->userdata('dept_id');
	}
	else if($this->session->userdata('role')==3)
	{
	$branch	=$this->session->userdata('branch_id');
	$dept    = $this->input->post('department');
	}
	else if($this->session->userdata('role')==7)
	{
	$branch	=$this->session->userdata('branch_id');
	$dept	=$this->session->userdata('dept_id');
	}
	else
	{
	$branch    = $this->input->post('branch');
	$dept    = $this->input->post('department');
	}
	
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
	if($data['name'] == '' || $data['phone1'] == '')
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
	
	
	if($notification =='1')
	{
	$message = "Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$data['phone1']." and password ".$data['phone1']."";
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data10['send_by']	=$staff;
	$data10['content']	=  $message;
	$data10['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data10);
	$master_id		=	$this->db->insert_id();
	
	$data11['sms_master_id']	=$master_id;
	$data11['student_id']	= $student_id;
	$data11['class_id']	=$this->input->post('class_id');
	$data11['section_id']	=$this->input->post('section_id');
	$data11['phone']	=$data['phone1'];
	$data11['msg_content']	= $message;
	$this->db->insert('tbl_sms_delivery_details',$data11);
	
	
	
	
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$data['phone1'].'&msg=' . urlencode($message . " " . $common) . '&route=T';
	
	
	
	
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
	
	
	
	//redirect(base_url() . 'index.php/Office_staff/student_bulk/' . $this->input->post('class_id') , 'refresh');
	}           
	//$page_data['page_name']  = 'student_bulk';
	//$page_data['page_title'] = get_phrase('Student-Bulk');
	$dat["action"]="success";
	
	$this->load->view('office_staff/student_bulk',$dat);
	
	}
	
	function get_sections($class_id)
	{
	$page_data['class_id'] = $class_id;
	$this->load->view('Office_staff/student_bulk_sections' , $page_data);
	}
	function students_area($class_id = '')
	{
	$data['class_id']=$class_id;
	$this->load->view('office_staff/student_area1.php',$data);
	
	}
	function individual_message($student_id)
	{ 
	
	
	$content = $this->input->post('message_send');
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	/*if($phone2==1)
	{
	$this->db->select('s.phone2,s.name,s.student_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	if($b['phone2']>0)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$b['phone2'];
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	}*/
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
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$b['class_id'];
	$data['section_id']	=	$b['section_id'];
	$this->load->view('Office_staff/message_popup',$data);
	//}
	/*    $message_send  = $this->input->post('message_send');
	
	
	
	$running_year = $this->db->get_where('settings' , array(
	'type' => 'running_year'
	))->row()->description;
	
	$this->crud_model->individual_message($student_id,$message_send);
	*/
	
	
	
	}
	
	
	function update_student($student_id)
	{
	$data1['roll']           = $this->input->post('roll');
	$data['admission_number']           = $this->input->post('admission_number');
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
	redirect(base_url() . 'index.php/Office_staff/student_portal/'.$student_id ,'refresh');
	
	}
	
	function mark_message($class_id,$section_id,$student_id,$mark_obtained,$mark_total,$average,$grade_id,$exam_id,$subject)
	{
	if ($this->session->userdata('Office_staff_login') != 1)
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
	redirect(base_url() . 'index.php/Office_staff/student_portal/'.$student_id ,'refresh');
	
	
	
	}
	function attendance_message($class_id,$section_id,$student_id,$present,$total,$percentage,$month)
	{
	if ($this->session->userdata('Office_staff_login') != 1)
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
	redirect(base_url() . 'index.php/Office_staff/student_portal/'.$student_id ,'refresh');
	
	
	
	}
	
	function student_portal($student_id)
	{
	$yr=get_running_year();
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
	
	
	$page_data['student_id'] 		 =  $student_id;
	$page_data['class_id']  		 =  $class_id;
	$page_data['section_id']  		 =  $section_id;
	$page_data['monthly_attendance'] =  $monthly_attendance;
	
	$this->load->view('office_staff/student_portal.php',$page_data);
	}
	function new_sendall_message()
	{
	$class =$this->input->post('class');
	
	$content = $this->input->post('message_send');
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	$data['send_date']	=  date('y/m/d');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	if($class=='All')
	{
	
	$this->db->select('s.phone1,s.name,s.student_id,e.section_id as section,e.class_id as class');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	//$this->db->where('e.class_id',$class);
	//$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	//$data1['class_id']	=$b['class'];
	//$data1['section_id']	=$b['section'];
	$data1['phone']	=$b['phone1'];
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	if($class!='All')
	{
	
	$this->db->select('s.phone1,s.name,s.student_id,e.section_id as section');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	//$this->db->where('e.section_id',$section);
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$b['student_id'];
	$data1['class_id']	=$class;
	$data1['section_id']	=$b['section'];
	$data1['phone']	=$b['phone1'];
	$data1['msg_content']	= $content;
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	$data['master_id']	=	$master_id;	
	if($class!='All')
	{
	$data['class_id']	=	$class;
	}
	//$data['section_id']	=	$section;
	$this->load->view('Office_staff/message_popup',$data);
	
	}
	function settings2() 
	{
	//$page_data['page_name'] = 'settings2';
	//$page_data['page_title'] = get_phrase('Send-News');
	$this->load->view('Office_staff/settings2.php');
	}
	function settings2_login() 
	{
	$password=$this->input->post('password');
	
	if($password=='login2')
	{
	//$page_data['page_name'] = 'settings3';
	//$page_data['page_title'] = get_phrase('Send-News');
	$this->load->view('Office_staff/advanced_settings');
	}
	}
	function update_admission_template($param1='') 
	{
	
	
	//$page_data['page_name'] = 'settings3';
	//$page_data['page_title'] = get_phrase('Send-News');
	$v=$this->input->post('admission_msg');
	
	$result=$this->crud_model->update_admission_template($v);
	if($result>0){
	$data["action"]="success";
	}
	//redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
	$this->load->view('Office_staff/sms_settings.php',$data);
	}
	function update_attendance_template() 
	{
	//$page_data['page_name'] = 'settings3';
	//$page_data['page_title'] = get_phrase('Send-News');
	$p=$this->input->post('attendance');
	
	$result=$this->crud_model->update_attendance_template($p);
	if($result>0){
	$data["action"]="success";
	}
	//redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
	$this->load->view('Office_staff/sms_settings.php',$data);
	
	}
	function update_birthday_template() 
	{
	//$page_data['page_name'] = 'settings3';
	//$page_data['page_title'] = get_phrase('Send-News');
	$q=$this->input->post('birthday');
	
	$result=$this->crud_model->update_birthday_template($q);
	if($result>0){
	$data["action"]="success";
	}
	//redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
	$this->load->view('Office_staff/sms_settings.php',$data);
	
	}
	
	function reset_password() 
	{
	
	$this->load->view('Office_staff/reset_password');
	
	}
	
	function change_password()
	{
	$new_password=sha1($this->input->post('new'));
	$confirm_password=sha1($this->input->post('confirm'));
	if($new_password==$confirm_password)
	{
	$data['password']=$confirm_password;
	$this->db->where('Office_staff_id',1);
	$this->db->update('Office_staff',$data);
	}
	else
	{?>
	<script>alert("Invalid")</script>
	<?php }
	redirect('Office_staff/reset_password');
	}
	function progress_report() 
	{
	
	$this->load->view('Office_staff/progress_report');
	
	}
	function birthday_message() {
	$wish= $this->input->post('wish_message');
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
	
	//$reciever = $phn->phone;
	$student_name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
	
	$message = "Hi ".$student_name ." ". $wish;
	$message1 =  $wish;
	
	//  $this->db->insert('message_thread', $data_message_thread);	
	if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
	{ 
	
	if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1. '&msg=' . urlencode($common . " " . $message) . '&route=T';
	}
	else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1. '&msg=' . urlencode($message . " " . $common) . '&route=T';
	}
	}
	else
	{
	
	if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First'){
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1. '&msg=' . urlencode($common . " " . $message1) . '&route=T';
	}
	else if( $this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == ''){
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' . $phone1. '&msg=' . urlencode($message1 . " " . $common) . '&route=T';
	}
	
	}
	//var_dump($location);
	//				die();
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
	redirect(base_url() . 'index.php/Office_staff/index' , 'refresh');
	}
	//////// 05-12-2017 //////////
	function add_branch() 
	{
	
	$this->load->view('Office_staff/add_branch.php');
	
	}
	
	function add_department($branch_id) 
	{
	$data['branch_id']	=	$branch_id;
	$this->load->view('Office_staff/add_department.php',$data);
	
	}
	
	function add_branch_users($branch) 
	{
	$data['branch_id']	=$branch;
	$this->load->view('Office_staff/add_branch_users.php',$data);
	
	}
	
	
	
	
	function branch_add() 
	{
	$branch_name		=		$this->input->post('branch_name');
	$branch_address		=		$this->input->post('branch_address');
	$phone1				=		$this->input->post('phone1');
	$phone2				=		$this->input->post('phone2');
	$email				=		$this->input->post('email');
	$state				=		$this->input->post('state');
	$district			=		$this->input->post('district');
	$branch =  $this->crud_model->branch_insert($branch_name,$branch_address,$phone1,$phone2,$email,$state,$district);
	
	redirect('Office_staff/view_branch/'.$branch);
	//$this->load->view('Office_staff/add_branch_users.php');
	
	}
	function department_add($branch_id) 
	{
	$dept_name		=		$this->input->post('department');
	
	$dept =  $this->crud_model->dept_insert($dept_name,$branch_id);
	
	redirect('Office_staff/view_department/'.$branch_id);
	//$this->load->view('Office_staff/add_branch_users.php');
	
	}
	
	function branch_users_add() 
	{
	$name				=		$this->input->post('name');
	$address			=		$this->input->post('address');
	$designation		=		$this->input->post('designation');
	$gender				=		$this->input->post('sex');
	$phone1				=		$this->input->post('phone1');
	$email				=		$this->input->post('email');
	$username			=		$this->input->post('username');
	$password			=		$this->input->post('password');
	$salary				=		$this->input->post('salary');
	$branch_id			=		$this->input->post('branch_id');
	$branch_users =  $this->crud_model->branch_users_insert($name,$address,$designation,$gender,$phone1,$email,$username,$password,$salary,$branch_id);
	redirect('Office_staff/add_branch_users/'.$branch_id);
	//$this->load->view('Office_staff/add_branch_users.php');
	
	}
	
	
	function view_branch()
	{
	
	$this->load->view('Office_staff/view_branch.php');
	}
	
	function view_department($branch_id='')
	{
	$role=$this->session->userdata('role'); 
	$branch_id1=$this->session->userdata('branch_id'); 
	if($role==3)
	{
	$data['branch_id']	=	$branch_id1;
	}
	else
	{
	$data['branch_id']	=	$branch_id;
	}
	$this->load->view('Office_staff/view_department.php',$data);
	}
	
	function add_designation() 
	{
	
	$this->load->view('Office_staff/add_designation.php');
	
	}
	
	function designation_add() 
	{
	$designation=$this->input->post('designation');
	$role=$this->input->post('role');
	$designation_insert =  $this->crud_model->designation_insert($designation,$role);
	if($designation_insert>0){
	$data1["action"]="success";
	}
	$this->load->view('Office_staff/add_designation.php',$data1);
	
	}
	
	function view_designation()
	{
	
	
	$this->load->view('Office_staff/view_designation.php');
	}
	
	function student_veiw() 
	{
	
	 $branch	=	$this->session->userdata('branch_id');
	
	$dept	=	$this->session->userdata('dept_id');
	
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$data['class']=$this->db->get('class')->result_array();
	
	
	$this->load->view('office_staff/student_view.php',$data);
	
	}
	
	function subjects_view() 
	{
	
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->session->userdata('dept_id');
	
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$data['class']=$this->db->get('class')->result_array();

	
	$this->load->view('Office_staff/subject_view.php',$data);
	
	}
	function branch_edit($branch_id='')
	{
	$data['branch_id']=$branch_id;
	//$data['branch']=$this->db->get_where('tbl_branch',array('branch_id'=>$branch_id))->result_array();
	$this->load->view('Office_staff/branch_edit.php',$data);
	}
	function branch_update($branch_id)
	{
	$data=array(
	
	'branch_name'		    =>		$this->input->post('branch_name'),
	'branch_address'		=>		$this->input->post('branch_address'),
	'phone1'				=>		$this->input->post('phone1'),
	'phone2'				=>		$this->input->post('phone2'),
	'email'				    =>		$this->input->post('email'),
	'state_id'				=>		$this->input->post('state'),
	'district_id'			=>		$this->input->post('district')
	);
	
	$this->crud_model->branch_update($data,$branch_id); 
	$this->view_branch();
	}
	function branch_delete($branch_id)
	{
	$data=array(
	'is_deleted'=>'Y',
	'deleted_date'=>date('Y-m-d'),
	'deleted_by'=>$this->session->userdata('login_user_id')
	);
	$this->crud_model->branch_update($data,$branch_id); 
	$this->view_branch();
	}
	function get_cls($department)
	{
	//$branch_option=$this->input->post('department');
	$dept  = $this->db->get_where('class' , array('dept_id' => $department))->result_array();
	echo '<option value="">SELECT</option>';
	foreach ($dept as $row) 
	{
	echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
	}
	}
	function department_edit($dept_id='',$branch_id='',$dept_name='')
	{
	
	
	$data['dept_id']=$dept_id; 
	$data['branch_id']=$branch_id; 
	$data['dept_name']=$dept_name; 
	$this->load->view('Office_staff/edit_department.php',$data);
	}
	function department_update($branch_id,$dept_id)
	{
	
	$data=array(
	'dept_name' => $this->input->post('department')
	);
	$this->crud_model->department_update($data,$dept_id);
	
	$this->view_department($branch_id);
	}
	function department_delete($branch_id,$dept_id)
	{
	
	$data=array(
	'is_deleted'   => 'Y',
	'deleted_date' => date('Y-m-d'),
	'deleted_by'   => $this->session->userdata('login_user_id')
	);
	$this->crud_model->department_update($data,$dept_id);
	
	$this->view_department($branch_id);
	}
	function view_attendance_list_hourly($subject,$from_date,$to_date,$student)
	{
		$data['subject']	=	$subject;
		$data['from_date']	=	$from_date;
		$data['to_date']	=	$to_date;
		$data['student_id']	=	$student;
		
		$this->load->view('Office_staff/view_attendance_list_hourly1.php',$data);
	}
function expense_category()	
	{
		
		$this->load->view('Office_staff/expense_category.php');
	}
	function view_expense_category()	
	{
		
		$this->load->view('Office_staff/view_expense_category.php');
	}
	function expense_category_add()	
	{
		$category_name	=	$this->input->post('category');
		$data['category_name']	=	$category_name;
		$data['branch_id']		=$this->session->userdata('branch_id');
		
		$this->db->insert('tbl_expence_category',$data);
		
		$this->load->view('office_staff/view_expense_category.php');
	}
	
	function expense_add()	
	{
		$data['category_id']	=	$this->input->post('category1');
		$data['amount']			=	$this->input->post('amount');
		$data['give_to']		=	$this->input->post('give_to');
		$data['remark']			=	$this->input->post('remark');
		$data['created_by']		=	$this->session->userdata('login_user_id');
		$data['created_date']	=	date('Y/m/d');
		$data['branch_id']		=	$this->session->userdata('branch_id');
		$data['dept_id']		=	$this->session->userdata('dept_id');
		$this->db->insert('tbl_add_expense',$data);
		
		$this->load->view('office_staff/view_expense.php');
	}
	function add_expense()	
	{
		
		
		$this->load->view('office_staff/add_expense.php');
	}
	function view_expense()	
	{
		
		$this->load->view('office_staff/view_expense.php');
	}
	function expense_category_edit($category_id)
	{
	   
	   $this->db->select('category_id,category_name');
	   $this->db->from('tbl_expence_category');
	   $this->db->where('category_id',$category_id);
	   $data['category']=$this->db->get()->result_array();
	   $this->load->view('Office_staff/expense_category_edit.php',$data);
	}
    function expense_category_update($category_id)
	{
	  $data=array(
	        'category_name' =>  $this->input->post('category')
			);
	  $this->db->where('category_id',$category_id);
	  $this->db->update('tbl_expence_category',$data);
	 $this->view_expense_category();
	  
	}
    function expense_category_delete($category_id)
	{
	  $this->db->where('category_id',$category_id);
	  $this->db->delete('tbl_expence_category');
	 $this->view_expense_category();

	   
	}
	function expense_edit($id)
	{
	   $this->db->select('c.category_name,a.amount,a.category_id,a.id,a.give_to,a.remark');
	   $this->db->from('tbl_add_expense a');
	   $this->db->join('tbl_expence_category c','a.category_id=c.category_id','LEFT');
	   $this->db->where('id',$id);
	   $data['expense']=$this->db->get()->result_array();
	   $this->load->view('Office_staff/expense_edit.php',$data);
	}
	function expense_update($id)
	{
	  $data=array(
	        'category_id' =>  $this->input->post('category1'),
			'amount' =>  $this->input->post('amount'),
			'give_to' =>  $this->input->post('give_to'),
			'remark' =>  $this->input->post('remark')
			);
	  $this->db->where('id',$id);
	  $this->db->update('tbl_add_expense',$data);
	 $this->view_expense();
	  
	}
    function expense_delete($id)
	{
	  $this->db->where('id',$id);
	  $this->db->delete('tbl_add_expense');
	 $this->view_expense();

	 }

function get_count($message)	
	{
		$data['message']	=$message;
		$this->load->view('Office_staff/msg_count.php',$data);
		
	}
	
	function check_user($user_name)	
	{
		$data['user_name']	=$user_name;
		$this->load->view('Office_staff/check_user_name.php',$data);
		
	}
	
	
	//////////////////////////////////////////////////////////
	
	
	
	
	
	
	
	


}
