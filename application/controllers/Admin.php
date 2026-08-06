<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('MobileModel');
        $this->load->helper('school_management');
    }
	public function index()
	{
	
	$this->load->view('admin/admin_dashboard.php');
	}
	
	function test_message()
	{
	    $year   =   get_running_year();
	    $this->db->select('class_id,name');
	    $this->db->where('academic_year',$year);
	    $this->db->where('dept_id',$this->session->userdata('dept_id'));
	    $this->db->where('branch_id',$this->session->userdata('branch_id'));
	    $data['class']  =   $this->db->get('class')->result_array();
	    $this->load->view('admin/test_sms',$data);
	}
	function test_message_submit()
	{
	    $class_id   =   $this->input->post('class_id');
	    $message    =   $this->input->post('message');
	    $file       =   $_FILES['image']['name'];
	    $type       =   explode("/",$_FILES['image']['type']);
	    if($type[0]=='image')
	    {
	        $media_type =   MEDIA_TYPE_IMAGE;
	    }
	    
	    $file_path  =   "uploads/chat/sent/images/";
	    
	    if (isset($_FILES['image']['name'])) {
            $file_name = $file_path . basename(round(microtime(true) * 1000).'_'.$_FILES['image']['name']);
            $upload_path = FCPATH . $file_name;
            try {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    
                    $file_name = str_replace("\\", "/", $file_name);
                    
                    $this->db->where('d.class_id',$class_id);
            	    $this->db->where('a.firebase_token!=','');
            	    $this->db->join('student b','b.user_id=a.user_id','left');
            	    $this->db->join('enroll c','c.student_id=b.student_id','left');
            	    $this->db->join('class d','d.class_id=c.class_id','left');
            	    $result =   $this->db->get('tbl_users a')->result_array();
            	    
            	    foreach($result as $row)
            	    {
            	        $receiver_id    =   $row['user_id'];
            	        $firebase_token =   $row['firebase_token'];
                	    //Insert message to table
                	    $server_id = $this->MobileModel->insert_message(-1, $receiver_id, $media_type, $message,$file_name);
                	    // Get message id
                	    
                	    $message_data = array(
                            "type" => CHAT_NEW_MESSAGE,
                            "message_id" => $server_id,
                            "conversation_id" => 1,
                            "media_type" => $media_type,
                            "message" => $message,
                            "url" => $file_name,
                            "file_size" => $this->human_filesize($upload_path),
                        );
                        $this->send_notification($firebase_token,$message_data);
            	    }
                    
                } else {
                    //$this->send_response('', false, "Couldn't move file");
                }
            } catch (Exception $e) {
                //$this->send_response('', false, $e->getMessage());
            }
        } else {
            //$this->send_response('', false, "Didn't receive file");
        }
	}

    public function human_filesize($file_path)
    {
        /*
        * Wolf, 2018-09-25, 14:55
        * */
        $size = filesize($file_path);
        $precision = 2;
        $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $step = 1024;
        $i = 0;
        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }
        return round($size, $precision) . $units[$i];
    }
	
    public function send_notification( $firebase_token, $message_data)
    {
        /*
        * Wolf, 2018-09-26, 10:13
        * */
        // $firebase_token = $this->ApiModel->get_firebase_id($user_id);
        $fields = array(
            'to' => $firebase_token,
            'data' => $message_data,
        );
        $headers = array(
            'Authorization: key=' . API_KEY,
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        //$this->send_response($result);
    }
	
	public function excel_import()
	{
		$this->load->view('admin/excel_import.php');
	}
	
	public function student_add($enquiry_id='',$action='')
	{
	    
	    $data['action']=$action;
		$data['enquiry']= $this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row();
		$data['certificate']= $this->db->get('student_certificates')->result_array();
		if($this->db->get_where('settings' , array('type' =>'class_category_wise_admission_number'))->row()->description == 'yes'){
			$this->load->view('admin/add_student_adm.php',$data);
		} else {
			$this->load->view('admin/add_student.php',$data);
		}
	}
	
	function get_class_section($class_id='',$year='')
	{       $run_year       = get_running_year();
		$class_option=$this->input->post('class');
		
		$this->db->where('class_id',$class_id);
		if($year!='')
		{
		$this->db->where('academic_year',$year);
		}
		elseif($year=='')
		{
		$this->db->where('academic_year',$run_year);
		}
		$sections = $this->db->get('section')->result_array();//echo $this->db->last_query();die;
		echo '<option value="">SELECT</option>';
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}
	
	function get_dept($branch_id)
	{
		$branch_option=$this->input->post('branch');
		$dept  = $this->db->get_where('tbl_department' , array('branch_id' => $branch_id,'is_deleted'=>'N'))->result_array();
		echo '<option value="">Select</option>';
		foreach ($dept as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
		}
	}
	
	function get_class_students($dept_id='',$year='')
	{
	    $running_year = get_running_year();
		$this->db->where('dept_id',$dept_id);
		if($year!='')
		{
		$this->db->where('academic_year',$year);
		}
		if($year=='')
		{
		$this->db->where('academic_year',$running_year);
		}
		$class  = $this->db->get('class')->result_array();//echo $this->db->last_query();die();
		echo '<option value="">Select</option>';
		foreach ($class as $row) 
		{
			echo '<option value="'.$row['class_id'].'">'.$row['name'].'</option>';
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
		$this->load->view('admin/print_students_list_full.php');
	}
	
	
	public function print_students_list1()
	{
		$class_id        =$this->input->post('class[]');
		$section_id       =$this->input->post('section_id');
		/*$this->db->where('class_id',$class_id);
		$c=$this->db->get('class')->row();
		$this->db->where('section_id',$section_id);
		$s=$this->db->get('section')->row();*/
		$run_year   =   get_running_year();
		$this->db->select('s.student_id,s.name,s.phone1,s.phone2,s.email,s.admission_number,s.birthday,s.parent,s.mother_name,e.roll');
		if($section_id!='ALL' && $section_id!='')
		{
		  $this->db->where('e.section_id',$section_id);
		}
		$this->db->where('e.year',$run_year);
		$this->db->where_in('e.class_id',$class_id);
		$this->crud_model->check_student_status();
		$this->db->join('student s','s.student_id=e.student_id', 'LEFT');
		$this->db->join('class c','c.class_id=e.class_id');
		$this->db->join('section sc','sc.section_id=e.section_id');
		$this->db->order_by('c.name', 'asc');
		$this->db->order_by('sc.name', 'asc');
		$this->db->order_by('s.name', 'asc');
		$this->db->order_by('e.roll', 'asc');
	    $query_result = $this->db->get('enroll e')->result_array();//echo $this->db->last_query();die;
		
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Students List";
		$page_data['page_name']        = 'print_students_list1';
		$page_data['page_title']       = 'Students List';
		$page_data['query_result']	   = $query_result;
		$this->load->view('admin/print_students_list1', $page_data);
	}
	
	function download_student_pdf($class,$section_id='')
	{
			//echo $section_id;die;
			$class_id = unserialize(base64_decode($class));
			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$data1['section_id']				=	$section_id;
			$data1['class_id']					=	$class_id;
                        $run_year                       = get_running_year();
			$this->db->select('s.student_id,s.name,s.phone1,s.phone2,s.email,s.admission_number,s.birthday,s.parent,s.mother_name,e.roll');
			if($section_id!='ALL' && $section_id!='')
			{
			  $this->db->where('e.section_id',$section_id);
			}
			$this->db->where('e.year',$run_year);
			$this->db->where_in('e.class_id',$class_id);
			$this->crud_model->check_student_status();
			$this->db->join('student s','s.student_id=e.student_id', 'LEFT');
			$this->db->join('class c','c.class_id=e.class_id');
			$this->db->join('section sc','sc.section_id=e.section_id');
			$this->db->order_by('c.name', 'asc');
			$this->db->order_by('sc.name', 'asc');
			$this->db->order_by('s.name', 'asc');
			$this->db->order_by('e.roll', 'asc');
			$query_result = $this->db->get('enroll e')->result_array();
						
				$data1['student_data'] 				= 	$query_result;
				//print_r($data1['student_data']);die;
				$html								=	$this->load->view('admin/pdf_student_list',$data1,true);
				include(APPPATH.'third_party/mpdf/mpdf.php');
				$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->allow_charset_conversion 	= true;
				$mpdf->charset_in = 'UTF-8';
				$mpdf->WriteHTML($html);
				$mpdf->Output('student_list.pdf','D');	
				die();
		
	}
	
	function download_student_excel($class,$section_id='')
	{
                $run_year   =   get_running_year();
		$class_id = unserialize(base64_decode($class));
		if(count($class_id)==1 && $section_id!='ALL')
		{
			$class_sec	=	"CLASS&nbsp;&nbsp;&nbsp;".get_class_name($class_id[0])."/" . get_section_name($section_id); 
		}	

			$this->db->select('s.student_id,s.name,s.phone1,s.phone2,s.email,s.admission_number,s.birthday,s.parent,s.mother_name,e.roll');
			if($section_id!='ALL' && $section_id!='')
			{
			  $this->db->where('e.section_id',$section_id);
			}
			$this->db->where('e.year',$run_year);
			$this->db->where_in('e.class_id',$class_id);
			$this->crud_model->check_student_status();
			$this->db->join('student s','s.student_id=e.student_id', 'LEFT');
			$this->db->join('class c','c.class_id=e.class_id');
			$this->db->join('section sc','sc.section_id=e.section_id');
			$this->db->order_by('c.name', 'asc');
			$this->db->order_by('sc.name', 'asc');
			$this->db->order_by('s.name', 'asc');
			$this->db->order_by('e.roll', 'asc');
			$query_result = $this->db->get('enroll e')->result_array();
	
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
		echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".$this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year."</h3></b></td></tr>";
		echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>".get_class_name($class_id[0])."/" . get_section_name($section_id)."</h3></b></td></tr>";
		echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Admission No.</td><td colspan='1'  align='left'>Name</td>";
		echo "<td colspan='1'  align='left'>Date of Birth</td>";
		echo "<td colspan='1'  align='left'>Father's Name</td><td colspan='1'  align='left'>Mother's Name</td><td colspan='1'  align='left'>Class/Section</td><td colspan='1'  align='left'>Phone</td></tr>";
		
		foreach ($query_result as $data)
		{
		
		
			echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".$data['admission_number']."</td><td colspan='1'  align='left'>".$data['name'];
			echo "<td colspan='1'  align='left'>".$data['birthday']."</td>";
			echo "<td colspan='1'  align='left'>".$data['parent']."</td><td colspan='1'  align='left'>".$data['mother_name']."</td><td colspan='1'  align='left'>".get_student_class_name($data['student_id'])."/".get_student_section_name($data['student_id'])."</td><td colspan='1'  align='left'>".$data['phone1']."</td></tr>";
			
			//$dataToExports[]			= $arrangeData;
			$i=$i+1;
		
		}
		
		die();
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
		$this->load->view('admin/print_students_list1', $page_data);
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
		
		if($this->session->userdata('role')>=4)
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

		// Validate academic hierarchy selection
		$class_id_post = $this->input->post('class_id');
		if (!empty($class_id_post)) {
			$this->db->where('class_id', $class_id_post);
			if (!empty($branch_id)) {
				$this->db->where('branch_id', $branch_id);
			}
			$this->db->where('academic_year', $running_year);
			$valid_class = $this->db->get('class')->num_rows();

			if ($valid_class == 0) {
				$this->session->set_flashdata('error_message', get_phrase('invalid_class_selected'));
				redirect(base_url() . 'index.php/admin/student_add', 'refresh');
				return;
			}
		}

		$data_user['branch_id']			=	$branch_id;
		$data_user['dept_id']			=	$dept_id;
		$data_user['username']			=	$this->input->post('phone1');
		$data_user['password']      	= 	sha1($this->input->post('phone1'));
		$data_user['user_role_id']		=	'10';
		
		/*$this->db->where('phone1',$this->input->post('phone1')); 
        $student=$this->db->get('student');*/
		$this->db->insert('tbl_users',$data_user);

		$user_id=$this->db->insert_id();
		$data['branch_id']				=	$branch_id;
		$data['dept_id']				=	$dept_id;
		$data['name']           		= $this->input->post('name');
		$data['admission_number']       = $this->input->post('admission_no');
		
		$data['birthday']       		= $this->input->post('birthday');
		$data['parent']       			= $this->input->post('parent');
		if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
		{
			$data['mother_name']		= $this->input->post('mother_name');
			$data['parent_id']  		= $this->input->post('parent_id');
			$data['whatsapp_number']    = $this->input->post('whatsapp_number');
		}
		$data['date']           		= strtotime(date("d M,Y"));
		$data['sex']            		= $this->input->post('sex');
		$data['address']        		= $this->input->post('address');
		$data['phone1']         		= $this->input->post('phone1');
		$data['phone2']         		= $this->input->post('phone2');
		$data['phone3']         		= $this->input->post('phone3');
		$phone= $data['phone1'].','.$data['phone2'] ;
		$data['email']          		= $this->input->post('email');
		$data['aadhaar_number']         = $this->input->post('aadhaar_number');
		$data['password']       		= $this->input->post('phone1');
		$data['parent']      			= $this->input->post('parent');
		$data['username']				= $this->input->post('phone1');
		$data['user_id']				= $user_id;
		$enquiry_id						= $this->input->post('id');
		$data1['is_admitted']			= 'Y';
		$certificate 					= $this->input->post('certificate[]');
		$certificate_id 	='';
		if(count($certificate)!=""){
    		foreach($certificate as $c){
	    		$certificate_id = $certificate_id.",'".$c."'";
		    }
		}
		$data['certificates_submitted'] = $certificate_id;
		if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
		{
			$data['school']      		= $this->input->post('school');
		}
	  	$notification =$this->input->post('notification');

		
		$msg 		= $this->input->post('additional_msg');
		$msg11		= $this->input->post('message');
		$this->load->Model('crud_model');
		
		$student_id =  $this->crud_model->student_insert($data,$enquiry_id,$data1);
		if($this->db->get_where('settings' , array('type' =>'class_category_wise_admission_number'))->row()->description == 'yes'){
			$class_id       		= $this->input->post('class_id');
			$admission_number       = $this->input->post('admission_no');
			$class_category_id		= $this->db->get_where('class' , array('class_id' => $class_id))->row()->class_category_id;
			$this->db->where('class_category_id',$class_category_id);
			$this->db->update('class_category', array('last_admission_num' => $admission_number));
		}
//Insert to bus start		
	$transportation=$this->db->get_where('settings' , array('type' => 'transportation'))->row()->description;
	if($transportation=='yes')
	{
		
		$rows				=	$this->Transport_management_model->get_fee_installment($branch_id,$running_year);
		
			foreach($rows as $row)
			{
				$bus_route = array(
							'student_id'			=> 	$student_id,
							'route_master_id' 		=> 	$this->input->post('route_master_id'),
							'route_register_id' 	=> 	$this->input->post('route_register_id'),
							'route_details_id'		=> 	$this->input->post('pickup_point'),
							'fee_amount'			=> 	$this->input->post('base_fare'),
							'fee_balance'			=> 	$this->input->post('base_fare'),
							'bus_fee_settings_id' 	=> 	$row['bus_fee_settings_id'],
							'due_date' 				=> 	$row['payment_date'],
							'academic_year'			=>	$row['academic_year'],
							);
				$num_rows_updated	=	$this->Transport_management_model->bus_fee_installment_insert($bus_route);	
			}
	}
		
//Insert to bus end		
		
		
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
		if($student_id > 0)
		{
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
		}
		else
		{
			$result = false;
		}
		$additional=$this->input->post('message');
		$class =$this->input->post('class_id');
		$section = $this->input->post('section_id');
		 $fee_master     = $this->input->post('fee_master');
		 if($result!='')
		 {
		 $page_data['action']="success";
		 }
		 else
		 {
		  $page_data['action']="failed";
		 }
		
		
		if ($fee_master!='')
		{
			
			$class_id     = $this->input->post('class_id');
			$section_id	= $this->input->post('section_id');
			$this->assign_student_fee($student_id,$class_id,$section_id,$fee_master);
		}
		
		
		
		
		if($notification =='1')
		{
		//echo "ab";die();
		$content = "Admission Message";
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data10['send_by']	=$staff;
		$data10['content']	=  $content;
		date_default_timezone_set("Asia/Kolkata");
		$data10['send_date']	=  date('Y/m/d H:i:s');
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
		$data11['send_date']	=  date('Y/m/d H:i:s');
		
		$this->db->insert('tbl_sms_delivery_details',$data11);
		} 
		if ($notification =='')
		{
		//echo "aa";
		    redirect('Admin/student_add');
			//$this->load->view('admin/add_student.php',$page_data);
			
		} 
		
		if($result>0)
		{
			$data3['action']="success";
		
		}
		$data5['master_id']	=	$master_id;	
		$data5['class_id']	=	$class;
		$data5['section_id']	=	$section;
		redirect('Admin/sms_send_admission/'.$phone1.'/'.$master_id);
		
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
		$this->load->view('admin/add_teacher.php');
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
		$this->load->view('admin/add_teacher.php',$data10);
	}
	
	
	public function teacher_view()
	{
		$this->load->view('admin/teacher_view.php');
	}
	
	
	function teacher_profile($teacher_id)
	{
		$page_data['teacher_id']  =  $teacher_id;
		$this->load->view('admin/teacher_profile', $page_data);
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
			redirect(base_url() . 'index.php/admin/teacher_profile/'. $param2, 'refresh');
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
			redirect(base_url() . 'index.php/admin/teacher_profile/'. $param2, 'refresh');
		}
		if ($param1 == 'delete') 
		{
			$this->db->where('teacher_id', $param2);
			$this->db->delete('teacher');
			redirect(base_url() . 'index.php/admin/teacher_view/', 'refresh');
		}
	}
	
	
	public function staff_add()
	{
		$this->load->view('admin/add_staff.php');
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
		$this->load->view('admin/add_staff.php',$data1);
	}
	
	
	public function staff_view()
	{	
	
		$this->load->view('admin/staff_view.php');
	}
	
	
	
	public function staff_view1()
	{	
		$designation	=	$this->input->post('designation');
		if($designation)
		{
			$data['staff_role']	=	$designation;			
			$this->db->where('role',$designation);
		}
		
		$data['teachers']	=	$this->db->get('staff' )->result_array();//echo $this->db->last_query();//die();
		$this->load->view('admin/staff_view.php',$data);
	}
	
	
	
	function staff_profile($staff_id)
	{
		$page_data['staff_id']  =  $staff_id;
		$this->load->view('admin/staff_profile', $page_data);
	}
	
	function staff_delete($staff_id='')
	{
	
		if($staff_id=='')
		{
			$this->session->set_flashdata('action','null_staff');
			redirect('Admin/staff_view');
		}
		else
		{
			$year	=	get_running_year();
			
			$this->db->where('teacher_id',$staff_id);
			$this->db->where('academic_year',$year);
			$section	=	$this->db->get('section')->result_array();//echo $this->db->last_query();die();
			if(count($section)>0)
			{
				$this->session->set_flashdata('action','exist_in_section');
				redirect('Admin/staff_view');
			}
			
			$this->db->where('teacher_id',$staff_id);
			$subject_teacher	=	$this->db->get('subject_teacher')->result_array();
			if(count($subject_teacher)>0)
			{
				$this->session->set_flashdata('action','exist_in_subject_teacher');
				redirect('Admin/staff_view');
			}
			
			if(count($section)==0 && count($subject_teacher)==0)
			{
				$current_user_id = $this->session->userdata('login_user_id');
				$staff_row = $this->db->get_where('staff', array('staff_id' => $staff_id))->row();
				$staff_user_id = isset($staff_row->user_id) ? $staff_row->user_id : 0;

				$data = array(
					'is_deleted'   => 'Y',
					'deleted_by'   => $current_user_id,
					'deleted_date' => date('Y-m-d')
				);
				$this->db->where('staff_id', $staff_id);
				$this->db->update('staff', $data);
				$row = $this->db->affected_rows();

				if ($staff_user_id > 0) {
					$data1 = array(
						'is_deleted'   => 'Y',
						'deleted_by'   => $current_user_id,
						'deleted_date' => date('Y-m-d')
					);
					$this->db->where('user_id', $staff_user_id);
					$this->db->update('tbl_users', $data1);
				}

				$this->session->set_flashdata('action', 'deleted');
				redirect('Admin/staff_view');
			}
		}
	}
	
	
	function staff_edit($param1 = '', $param2 = '', $param3 = '')
	{
		if ($param1 == 'do_update') 
		{
			$data['name']        = $this->input->post('name');
			//$data['username']    = $this->input->post('username');
			$data['salary']      = $this->input->post('salary');
			$data['sex']         = $this->input->post('sex');
			$data['birthday']    = $this->input->post('birthday');
			$data['address']     = $this->input->post('address');
			$data['phone']       = $this->input->post('phone');
			$data['email']       = $this->input->post('email');
			$this->db->where('staff_id', $param2);
			$this->db->update('staff', $data);
			
			/*$data1['username']    = $this->input->post('username');
			$this->db->where('user_id', $this->input->post('user_id'));
			$this->db->update('tbl_users', $data1);*/
			
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $param2 . '.jpg');
			redirect(base_url() . 'index.php/admin/staff_profile/'. $param2, 'refresh');
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
			elseif ($data['new_password'] != $data['confirm_new_password']) 
            {
                ?><script>
				alert("Password didn't match");
				</script><?php
            } 
            redirect(base_url() . 'index.php/admin/staff_profile/'. $param2, 'refresh');
        }
		if ($param1 == 'delete') 
		{
			$this->db->where('staff_id', $param2);
			$this->db->update('staff', array('is_deleted' => 'Y'));
			redirect(base_url() . 'index.php/admin/staff_view/', 'refresh');
		}
		if($param1 == 'update_username' )
		{
		
	    $username = $this->input->post('username');
		
		$this->db->where('username',$username); 
		$count_user=$this->db->get('tbl_users');
		if($count_user->num_rows()>0){?>
		<script> alert("Username Already Exist"); </script>
		<?php }
		
		else{
		$this->db->where('staff_id', $param2);
		$user=$this->db->get('staff')->row()->user_id;
		
		$this->db->where('user_id', $user);
		$this->db->update('tbl_users', array('username' => $username) );
		
		$this->db->where('staff_id', $param2);
		$this->db->update('staff', array('username' => $username) );
		}
            
	    redirect(base_url() . 'index.php/admin/staff_profile/'. $param2, 'refresh');
		}
	}
	
	
	public function full_attendance()
	{
		$this->load->view('admin/full_attendance.php');
	}
	
	
	function search($search_key = '') 
	{
		 $page_data['search_key']=$this->input->post('search_key');
		 
		//$page_data['search_key']    =  preg_replace("/[^a-zA-Z]+/", "",$search_key);
		$this->load->view('admin/search.php', $page_data);
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
		redirect(base_url().'index.php/admin/full_manage_attendance/'.$data['timestamp'],'refresh');
	}
	
	
	public function full_manage_attendance($timestamp)
	{
		$data['timestamp'] = $timestamp;
		$this->load->view('admin/full_manage_attendance.php',$data);
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
		$this->load->view('admin/message_popup',$data);
	}
	
	
	public function daily_attendance()
	{
		$this->load->view('admin/daily_attendance.php');
	}
	
	
	function get_section($class_id) 
	{
		$page_data['class_id'] = $class_id; 
		$this->load->view('admin/section_holder' , $page_data);
	}
	
	
	function attendance_selector()
    {
		$academic_year=get_running_year();
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
	    if($role==4 || $role==12)
	   	{
	     	$data['branch_id']   = $this->session->userdata('branch_id');
		 	$data['dept_id']   = $this->session->userdata('dept_id');
		 	$data['class_id']   = $this->input->post('class_id');
	   	}
	
	
        
		$data['time']       = $this->input->post('time');
        $data['year']       = $this->input->post('year');
        //$data['timestamp']  = strtotime($this->input->post('timestamp'));
        $data['section_id'] = $this->input->post('section_id');
		$a=$this->input->post('timestamp');
        $b  = str_replace('/','-',$a);
		$data['timestamp']=strtotime($b);
		/*echo $a."<br>";
		echo $b."<br>";
		echo $data['timestamp']."<br>";die();*/
		//echo $data['class_id'];
		////$data['section_id'];
		//$data['timestamp'];
		//die();
		$where		=		array(
								'branch_id'	=>	$data['branch_id'],
								'dept_id'	=>	$data['dept_id'], 
								'class_id'	=>	$data['class_id'],
								'section_id'=>	$data['section_id'],
								'year'		=>	$data['year'],
								'timestamp'	=>	$data['timestamp']
								);
		if($this->db->get_where('settings',array('type'=>'afternoon_attendance'))->row()->description=='yes')
		{
        	$where['time']	=	$data['time'];		
		}
		
        $query = $this->db->get_where('attendance' ,$where);
        if($query->num_rows() < 1) 
        {
			$this->db->where('class_id',$data['class_id']);
			$this->db->where('section_id',$data['section_id']);
			$this->db->where('year',$academic_year);
			$this->crud_model->check_student_status();
			$students=$this->db->get('view_students s')->result_array();
            foreach($students as $row) {
			    $attn_data['branch_id']   	= $data['branch_id'];
				$attn_data['dept_id']   	= $data['dept_id'];
                $attn_data['class_id']   	= $data['class_id'];
                $attn_data['year']       	= $data['year'];
                $attn_data['timestamp']  	= $data['timestamp'];
                $attn_data['section_id'] 	= $data['section_id'];
                $attn_data['student_id'] 	= $row['student_id'];
				if($this->db->get_where('settings',array('type'=>'afternoon_attendance'))->row()->description=='yes')
				{
					$attn_data['time']  		= $data['time'];
				}
                $this->db->insert('attendance' , $attn_data);  
            }
        } //echo $this->db->last_query();die();
     redirect(base_url().'index.php/admin/manage_attendance/'.$data['branch_id'].'/'.$data['dept_id'].'/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['timestamp'].'/'.$data['time'],'refresh');
  // manage_attendance($data['class_id'],$data['section_id'],$data['timestamp']);
    }


	
	function manage_attendance($branch_id = '',$dept_id = '',$class_id = '' , $section_id = '' , $timestamp = '' , $time = '')
	{
	
	//$class_name = $this->db->get_where('student')
      //->row()->name;
        //$page_data['class_id'] = $class_id;
        $data['time'] 		= 	$time;
        $data['timestamp'] 	= 	$timestamp;
		$data['branch_id']  = 	$branch_id;
		$data['dept_id']  	= 	$dept_id;
		$data['class_id']  	= 	$class_id;
		$data['section_id'] = 	$section_id;
		
       // $page_data['page_name'] = 'full_manage_attendance';
        //$section_name = $this->db->get_where('section' , array(
            //'section_id' => $section_id
       // ))->row()->name;
        //$page_data['section_id'] = $section_id;

	
		$this->load->view('admin/manage_attendance',$data);
	}

	/*function attendance_update($branch_id='',$dept_id='',$class_id = '' , $section_id = '' , $timestamp = '')
    {
	      $date=date('d/m/Y', $timestamp);
			
         $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
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
			  $atn=$this->input->post('message');
			  $user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  "Attendance Message";
date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d H:i:s');
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
				$msg = " is ".$late." late on ".$date;
				
			}
			if( 1 == $late_notification && 4 == $attendance_status ){
				$notification = 1;
				$msg = "has no Diary on ".$date;
				
			}
			$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
				$name  = $stu->name;
				if($notification =='1' &&  $additional_message==''){
				$att_message=$name.' '.$msg;
				}
				if($notification =='1' &&  $additional_message=='1'){
				$att_message=$name.' '.$msg.' '.$atn;
				}
				/*if($notification ==''&&  $additional_message=='')
				{
				$this->db->where('attendance_id' , $row['attendance_id']);
			 
           $result= $this->db->update('attendance' , array('status' => $attendance_status,'late_time'=>$late));
				redirect(base_url() . 'index.php/admin/manage_attendance/'.$branch_id.'/'.$dept_id.'/'.$class_id.'/'.$section_id.'/'.$timestamp, 'refresh');
				}
				
			$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$row['student_id'];
			$data1['class_id']	=$class_id;
			$data1['section_id']	=$section_id;
			$data1['phone']	=$phone1;
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
					$data1['msg_content']	= $this->sms_helper1($common,$c,$att_message);
					$data1['send_date']	=  date('Y/m/d H:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data1);
		
	
			 
            $this->db->where('attendance_id' , $row['attendance_id']);
			 
           $result= $this->db->update('attendance' , array('status' => $attendance_status,'late_time'=>$late));
		   }
		   if($result>0){
			$data["action"]="success";
			$data['timestamp'] = $timestamp;
			$data['branch_id']  = $branch_id;
			$data['dept_id']  = $dept_id;
		$data['class_id']  = $class_id;
		$data['section_id'] = $section_id;
		$data['master_id']	=	$master_id;	
		
		
			
        }
		//$this->db->insert('attendance_message',$message1);
		
		$this->load->view('admin/message_popup_aatn',$data);
    }*/
	function attendance_update($branch_id='',$dept_id='',$class_id = '' , $section_id = '' , $timestamp = '' , $time = '')
    {
		
		$date			=	date('d/m/Y',$timestamp);
		$running_year 	= 	get_running_year();
		$where			=	array(
								'branch_id'=>$branch_id,
								'dept_id'=>$dept_id,
								'class_id'=>$class_id,
								'section_id'=>$section_id,
								'year'=>$running_year,
								'timestamp'=>$timestamp
								);
		if($this->db->get_where('settings',array('type'=>'afternoon_attendance'))->row()->description=='yes')
		{	
			$where['time']	=	$time;
		}						
		
		
		$attendance_of_students = 	$this->db->get_where('attendance' , $where)->result_array();
		$late_notification 		= 	null === $this->input->post('late_notification') ? 0 : 1;
		$absent_notification	= 	null === $this->input->post('absent_notification') ? 0 : 1;
		$diary_notification		= 	null === $this->input->post('no_diary_notification') ? 0 : 1;
		$phone_2				= 	null === $this->input->post('phone2') ? 0 : 1;
		$voice_call				=	0;
		if($this->db->get_where('settings',array('type'=>'voice_call'))->row()->description=='yes')
		{
			$voice_call			= 	null === $this->input->post('voice_call') ? 0 : 1;
		}
		
		$additional_message		=	$this->input->post('additional_msg');
		
		$message1				= 	$this->input->post('message');
		
		$sms 					= 	$this->db->get('sms_settings')->row();
		$sender_id 				= 	$sms->sender_id;
		$username 				= 	$sms->username;
		$password 				= 	$sms->password;
		$common 				= 	$sms->common_word;
		$url 					= 	$sms->url;
		if($this->db->get_where('settings',array('type'=>'voice_call'))->row()->description=='yes')
		{
			$voice_tbl 					= 	$this->db->get('voice_call_settings')->row();
			
			$voice_username 				= 	$voice_tbl->username;
			$voice_password 				= 	$voice_tbl->password;
			
			$voice_url 					= 	$voice_tbl->url;
		}
        foreach($attendance_of_students as $row) {
			$stu1 = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
			$notification = 0;
            $attendance_status = $this->input->post('status_'.$row['attendance_id']);
			$late = $this->input->post('late_'.$row['attendance_id']);		
			if( 1 == $absent_notification && 2 == $attendance_status ){
				$notification = 1;
				$msg = " is absent on ".$date;
				if($voice_call==1)
				{
					$voice_location = $voice_url.'/newcall?uname='.urlencode($voice_username).'&pwd='.urlencode($voice_password).'&campaign=absent'.'&to='.$stu1->phone1.'&route=T';
				    $send1 = fopen($voice_location,"r");
				}
			}
			if( 1 == $late_notification && 3 == $attendance_status ){
				$notification = 1;
				$msg = " is".$late." late on ".$date;
				if($voice_call==1)
				{
				    $voice_location = 	$voice_url.'/newcall?uname='.urlencode($voice_username).'&pwd='.urlencode($voice_password).'&campaign=late'.'&to='.$stu1->phone1.'&route=T';
					$send1 			= 	fopen($voice_location,"r");
				}
			}
			if( 1 == $late_notification && 4 == $attendance_status ){
				$notification = 1;
				$msg = "has no Diary on ".$date;
				/*if($voice_call==1)
				{
				    $location1="http://voice.sms4add.in/newcall?uname=sarathsk&pwd=Sk5665&campaign=newvoice&to=".$stu1->phone1."&route=T";
			$send1 = fopen($location1,"r");
			
				}*/
			}
			if($this->db->get_where('settings' , array('type' =>'half_day_leave'))->row()->description == 'yes' &&  1 == $absent_notification && 5 == $attendance_status )
			{
				$notification = 1;
				$msg = " is half day leave on ".$date;
			}
			 if($notification =='1' &&  $additional_message==''){
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
				if($phone_2 == '1')
				{
					$phone2  = $stu->phone2;
				}
				else
				{
					$phone2  = '';
				}
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
								
								
								
			
			
			}
								
	//	$location1="http://voice.sms4add.in/newcall?uname=sarathsk&pwd=Sk5665&campaign=newvoice&to=".$phone1."&route=T";
		//	$send1 = fopen($location1,"r");
			
			/* $return_message_ids1 = stream_get_contents($send1);
			$message_id_array1 = explode(",", $return_message_ids1);*/
								
			
			
			}
			if($notification =='1' &&  $additional_message=='1'){
				$stu = $this->db->get_where('student', array('student_id' => $row['student_id']))->row();
				$phone1  = $stu->phone1;
				if($phone_2 == '1')
				{
					$phone2  = $stu->phone2;
				}
				else
				{
					$phone2  = '';
				}
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
			
			}
			  }
			 
			 
			 
			 
			
			$this->db->where('attendance_id' , $row['attendance_id']);
			
			$result= $this->db->update('attendance' , array('status' => $attendance_status,'late_time'=>$late));
			if($result>0){
			$data["action"]="success";
			$data['timestamp'] 	= $timestamp;
			$data['branch_id']  = $branch_id;
			$data['dept_id']  	= $dept_id;
			$data['class_id']  	= $class_id;
			$data['section_id'] = $section_id;
			$data['time'] 		= $time;
			
			}
		}
			
        $this->load->view('admin/manage_attendance',$data);
	}

		//$this->db->insert('attendance_message',$message1);
		//
		
    //}
	
	public function attendance_report()
	{
		$data['month']        = date('m');
		$this->load->view('admin/attendance_report.php',$data);
	}
	
	
	function attendance_report_selector()
	{
		$data['class_id']   = $this->input->post('class_id');
		$data['year1']       = $this->input->post('year1');
		$data['month'] 	    = $this->input->post('month');
		$data['section_id'] = $this->input->post('section_id');
		redirect(base_url().'index.php/admin/report_attendance_view/'.$data['class_id'].'/'.$data['section_id'].'/'.$data['month'].'/'.$data['year1'],'refresh');
	}
	
	
	function report_attendance_view($class_id = '' , $section_id = '', $month = '',$year1='') 
	{
		$data['class_id'] 	= $class_id;
		$data['month']    	= $month;
		$data['section_id'] = $section_id;
		$data['year1'] = $year1;
		$this->load->view('admin/report_attendance_view.php',$data);
	}
	
	
	function attendance_print($class_id ,$section_id ,$month,$year1) 
	{
		$page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['month'] =$month;
			$page_data['year1'] =$year1;
			//print_r($page_data);
		$this->load->view('admin/attendance_print' , $page_data);
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
			$message_id_array = explode(",",$return_message_ids); 
			
		}
		$current_year=date('Y');
		redirect(base_url() . 'index.php/admin/report_attendance_view/'.$class_id.'/'.$section_id.'/'.$month1.'/'.$current_year,'refresh');
	}
	
	
	function view_exam()
	{
	$running_year = get_running_year();
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$branch		=		$this->input->post('branch');
			$dept		=		$this->input->post('department');
			if($branch && $dept)
			{
				$this->db->where('branch_id',$branch);
				$this->db->where('dept_id',$dept);
			}
			$this->db->where('is_deleted','N');
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('exam')->result_array();
		}
		if($role==3)
		{
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->input->post('department');
			if($dept)
			{
				$this->db->where('dept_id',$dept);
			}
			$this->db->where('is_deleted','N');
			$this->db->where('branch_id',$branch);
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('exam')->result_array();
		}
		if($role==4|| $role==12)
		{
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->session->userdata('dept_id');
			$this->db->where('branch_id',$branch);
			$this->db->where('dept_id',$dept);
			$this->db->where('is_deleted','N');
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('exam')->result_array();
		}
		$this->load->view('admin/view_exam', $page_data);
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
			if($role==4 || $role==12)
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
			$this->load->view('admin/create_exam',$data1);
		}
		if ($param1 == 'edit') 
		{
			$exam_id = (!empty($param2) && $param2 > 0) ? $param2 : $this->input->post('exam_id');
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
			if (!empty($exam_id)) {
				$this->db->where('exam_id', $exam_id);
				$this->db->update('exam', $data);
				$db_err = $this->db->error();
				if (!empty($db_err['code']) && $db_err['code'] != 0) {
					$this->session->set_flashdata('error_message', 'Database Error: ' . $db_err['message']);
				} else {
					$this->session->set_flashdata('flash_message', 'Exam updated successfully.');
				}
			}
			redirect('admin/view_exam');
		} 
		if ($param1 == 'delete') 
		{
			$data['is_deleted']   = "Y";
			$this->db->where('exam_id', $param2);
			$this->db->update('exam', $data);
			redirect(base_url() . 'index.php/admin/view_exam/', 'refresh');
		}
		if ($param1 == 'new') 
		{
			$this->load->view('admin/create_exam');
		}
	}
	
	
	public function edit_unit_exam($exam_id)
	{
		$data['exam_id']=$exam_id;
		$this->load->view('admin/edit_unit_exam.php',$data);
	}
	
	
	public function upload_marks()
	{
		$this->load->view('admin/upload_marks.php');
	}
	
	
	function marks_get_subject($class_id='')
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('admin/marks_get_subject' , $page_data);
	}
	
	
	function marks_get_subject_delete($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('admin/marks_get_subject_delete' , $page_data);
	}
	
	
	function marks_selector()
	{
		$dept_id   			= $this->input->post('department');
		$data['class_id']   = $this->input->post('class_id');
		$data['section_id'] = $this->input->post('section_id');
		$data['exam_id']    = $this->input->post('exam_id');
		$data['subject_id'] = $this->input->post('subject_id');
		//$data['comment'] = $this->input->post('remarks');
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
		{ $this->db->where('class_id',$data['class_id']);
		   $this->db->where('section_id',$data['section_id']);
		   $this->db->where('year',$data['year']);
		   $this->crud_model->check_student_status();
		   $students=$this->db->get('view_students s')->result_array();
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
				redirect(base_url() . 'index.php/admin/marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['exam_id'] . '/' . $data['subject_id'] . '/'. $dept_id , 'refresh');
	}
	
	//function marks_upload($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '', $remarks = '', $dept_id = '')
	function marks_upload($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '', $dept_id = '')
	{
		$page_data['dept_id']    =   $dept_id;
		$page_data['exam_id']    =   $exam_id;
		$page_data['class_id']   =   $class_id;
		$page_data['subject_id'] =   $subject_id;
		$page_data['section_id'] =   $section_id;
		//$page_data['remarks'] =  $remarks;
		$this->load->view('admin/marks_upload', $page_data);
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
		redirect(base_url().'index.php/admin/marks_upload/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');
	}
	
	
    function marks_update1($class_id = '' ,$section_id = '' ,$exam_id = '',$subject_id = '',$dept_id='')
	{
		$running_year = get_running_year();
		$marks_of_students= $this->crud_model->get_students_marks($class_id,$section_id,$exam_id,$subject_id,$running_year);
		$result = 0;
		/*echo "<pre>";
		print_r($marks_of_students);
		echo "</pre>";die();*/
		foreach($marks_of_students as $row) 
		{
			$obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
			$mark_total= $this->input->post('mark_total_'.$row['mark_id']);
			if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description=='yes')
			{
				$obtained_marks2	=	$obtained_marks;
				$mark_total2		=	$mark_total;
				$obtained_marks1 	= 	$this->input->post('int_marks_obtained_'.$row['mark_id']);	
				$mark_total1		= 	$this->input->post('int_mark_total_'.$row['mark_id']);
				$obtained_marks		=	$obtained_marks+$obtained_marks1;
				$mark_total			=	$mark_total+$mark_total1;
				if($obtained_marks1=='')
				{
					$obtained_marks1	=	NULL;
				}
				if($mark_total1=='')
				{
					$mark_total1	=	NULL;
				}

			}
			$grade1= $this->input->post('grade_value_'.$row['mark_id']);
			$comnt= $this->input->post('comment');
			$position1= $this->input->post('position_value_'.$row['mark_id']);
			
			//if($grade1=="" && $position1 == "" && $obtained_marks!=="" )
			//{
				if($mark_total>0){
					$average = (($obtained_marks /  $mark_total) * 100);
				}
				else
				{
					$average = 0;
				}
				$p=$this->db->get('grade')->result_array();
				foreach($p as $res)
				{
					if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
					{
						$grade = $res['grade'];
						$position = $res['position'];
					}
				}
			/*}
			else
			{
				$grade = $grade1;
				$position = $position1;
			}*/
			if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description=='yes')
			{
				if($comnt =="")
				{
					$this->db->where('mark_id' , $row['mark_id']);
					$result=$this->db->update('mark' , array('mark_obtained' => $obtained_marks2 ,'mark_total' => $mark_total2,'internal_marks' => $obtained_marks1 ,'internal_total' => $mark_total1,'grade' => $grade, 'position' => $position));
				}
				else
				{
					$this->db->where('mark_id' , $row['mark_id']);
					$result=$this->db->update('mark' , array('mark_obtained' => $obtained_marks2 ,'mark_total' => $mark_total2,'internal_marks' => $obtained_marks1 ,'internal_total' => $mark_total1,'grade' => $grade, 'position' => $position, 'comment' =>$comnt));
				}
			}
			else
			{
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
			
		}

		$page_data = array(
			'dept_id'    => $dept_id,
			'exam_id'    => $exam_id,
			'class_id'   => $class_id,
			'subject_id' => $subject_id,
			'section_id' => $section_id
		);

		if($result>0)
		{
			$page_data["action"]="success";
		}
		$this->load->view('admin/marks_upload', $page_data);
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
			redirect(base_url() . 'index.php/admin/grade/', 'refresh');
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
			redirect(base_url() . 'index.php/admin/grade/', 'refresh');
		} 
		$page_data['grade']      = $this->db->get('grade')->result_array();
		$this->load->view('admin/grade', $page_data);
	}
	
	
	public function edit_grade($grade_id)
	{
		$data['grade_id']=$grade_id;
		$this->load->view('admin/grade_edit.php',$data);
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
				redirect(base_url() . 'index.php/admin/rank/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
			}
			else 
			{
				redirect(base_url() . 'index.php/admin/rank/', 'refresh');
			}
		}
		$page_data['exam_id']    = $exam_id;
		$page_data['class_id']   = $class_id;
		$page_data['section_id'] = $section_id;
		$this->load->view('admin/rank', $page_data);
	}
	
	
	function subject_message($class,$section,$exam1,$grade,$position,$remark,$phone2='')
	{
	$stud_ids			=	$this->input->post('stud_ids');
	$stud_array			=	array();
	foreach($stud_ids as $row):
		$stud_array[]	=	$row['value'];	
	endforeach;
	
	//print_r($stud_array);die;
	/*  echo "<script>alert();</script>";*/
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	$content = "exam";
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$datas['send_by']	=$staff;
	$datas['content']	=  $content;
	date_default_timezone_set("Asia/Kolkata");
		$datas['send_date']	=  date('Y/m/d H:i:s');
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
					$this->db->where_in('student_id',$stud_array);
					$student=$this->db->get('mark')->result_array();
					/*echo $this->db->last_query();
					echo "<pre>";
					print_r($student);
					echo "</pre>";die;*/
					foreach($student as $stud)
					{
					//print_r($stud['student_id']);
					
					$this->db->where('m.exam_id', $exam1);
					$this->db->select('m.mark_obtained,m.mark_total,m.internal_marks,m.internal_total,s.name as subject,m.comment,m.grade,m.position');
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
	
	 
	 
				if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
				{
					$subject_student=" Marks:  " . $exm['mark_obtained'] . "/" . $exm['mark_total'] . " for " . $exm['subject'].' '.$msg.' '.$rmrk;
				}
				else
				{
					$subject_student=" Marks:  " . ($exm['mark_obtained']+$exm['internal_marks']) . "/" . ($exm['mark_total']+$exm['internal_total']) . " for " . $exm['subject'].' '.$msg.' '.$rmrk;
				}
			$text=$text.' '.$subject_student;
				
			}
					
					
				$data1['sms_master_id']	=$master_id;
	
	 $data1['student_id']	=$stud['student_id'];
	
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$student_number;
	$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d H:i:s');
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
			$data2['send_date']	=  date('Y/m/d H:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data2);
		}
	}	
	}
					
					
					
	$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$data['exam_id']	=	$exam1;
		$this->load->view('admin/message_popup_exam_report',$data);
					
					//$student=$this->db->get('student')
	
	
	}
	
	
	function subject_message_individual($class,$section, $exam1, $subject, $grade, $position, $remark, $phone2='')
	{
	
		$stud_ids			=	$this->input->post('stud_ids');
		$stud_array			=	array();
		foreach($stud_ids as $row):
			$stud_array[]	=	$row['value'];	
		endforeach;
		//print_r($stud_array);die;
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
		$datas['send_date']	=  date('Y/m/d H:i:s');
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
					
					
					$this->db->select('m.student_id,s.name as student_name, m.mark_obtained,m.mark_total,m.internal_marks,m.internal_total,m.grade,m.position,m.comment,s.phone1,s.phone2');
					$this->db->where('m.class_id', $class);
					$this->db->where('m.section_id', $section);
					$this->db->where('m.exam_id', $exam1);
					$this->db->where('m.subject_id', $subject);
					$this->db->where_in('m.student_id',$stud_array);
					$this->db->join('student s','s.student_id=m.student_id','LEFT');
					$student=$this->db->get('mark m')->result_array();
					/*echo $this->db->last_query();
					echo "<pre>";
					print_r($student);
					echo "</pre>";die();*/
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
	
	if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
	{
	  $text="Student Name : ".$stud['student_name']." Exam : ".$exam_name." Marks:  " . $stud['mark_obtained'] . "/" . $stud['mark_total'] . " for " . $subject_name.' '.$msg.' '.$rmrk;
	 }
	 else
	 {
	  $text="Student Name : ".$stud['student_name']." Exam : ".$exam_name." Marks:  " . ($stud['mark_obtained']+$stud['internal_marks']) . "/" . ($stud['mark_total']+$stud['internal_total']) . " for " . $subject_name.' '.$msg.' '.$rmrk;
	 } 
	  
	  
	  $data1['sms_master_id']	=$master_id;
	
	 $data1['student_id']	=$stud['student_id'];
	
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$stud['phone1'];
	$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d H:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data1);
	if($phone2==1)
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
				$data2['send_date']	=  date('Y/m/d H:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data2);
		}
	}
	
					}
					
				$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$data['exam_id']	=	$exam1;
		$data['subject_id']	=	$subject;
		$this->load->view('admin/message_popup_exam_report_subject',$data);
	}	
	
			//redirect('admin/sms_send_popup/'.$master_id);		
	
	
	
		//$this->crud_model->subject_message_individual($class,$section, $exam, $subject, $grade, $position, $remark);

	
	
	function get_report($class_id='',$section_id='',$exam_id='')
	{
		$page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['exam_id'] = $exam_id;
		$this->load->view('admin/get_report' , $page_data);
	}
	
	
	function get_prog_report($class_id='',$section_id='')
	{
		$page_data['class_id'] 		= 	$class_id;
		$page_data['section_id'] 	= 	$section_id;
		$this->load->view('admin/get_prog_report' , $page_data);
	}
	function get_section_by_class($class_id='')
	{
	$this->load->model('Crud_model');
	$section	=	$this->Crud_model->get_section($class_id);
	echo "<option value=''>Select Section</option>";
	foreach($section as $row):
		echo "<option value='".$row['section_id']."'>".$row['name']."</option>";
	endforeach;
	}
	
	
	function rank_print($class_id ,$section_id ,$exam_id) 
	{
		$page_data['class_id'] = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['exam_id'] =$exam_id;
		$this->load->view('admin/rank_print' , $page_data);
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
				redirect(base_url() . 'index.php/admin/tab_sheet/' . $page_data['class_id'] . '/' . $page_data['section_id'] .'/' . $page_data['exam_id'] , 'refresh');
			} 
			else 
			{
				redirect(base_url() . 'index.php/admin/tab_sheet/', 'refresh');
			}
		}
		$page_data['exam_id']    = $exam_id;
		$page_data['class_id']   = $class_id;
		$page_data['section_id'] = $section_id;
		$this->load->view('admin/tab_sheet', $page_data);
	}
	
	
	function mark_print_report_pdf($class_id,$section_id,$exam_id)
	{
				ob_start();
				$html 								=	ob_get_clean();
				$html 								= 	utf8_encode($html);
				$year								=	get_running_year();
				$data1['class_id']					=	$class_id;
				$data1['section_id']				=	$section_id;
				$data1['exam_id']					=	$exam_id;
				if($class_id!='all')
				{
				$this->db->where('class_id',$class_id);
				if($section_id!='all')
				{
				$this->db->where('section_id',$section_id);
				}
				}
				$this->db->where('exam_id',$exam_id);
				$data1['student_data'] 				= $this->db->get('mark')->result_array();
				$html								= $this->load->view('admin/pdf_exam_marks',$data1,true);
				include(APPPATH.'third_party/mpdf/mpdf.php');
				$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->allow_charset_conversion 	= true;
				$mpdf->charset_in = 'UTF-8';
				$mpdf->WriteHTML($html);
				$mpdf->Output($data['data'][0]->reference_no.'report.pdf','D');	
				die();
	}
	
	function mark_print_report_excel($class_id,$section_id,$exam_id)
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
				if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
				{
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
				}
				else
				{
					foreach ($query_result as $data)
					{
						$arrangeData['Sl.No'] 		= $i;
						$arrangeData['Name'] 		= get_student_name($data['student_id']);
						$this->db->select('distinct(m.student_id) as student,m.mark_obtained,m.position,m.mark_total,m.internal_marks,m.internal_total,s.name as subject');
						$this->db->from('mark m');
						$this->db->join('subject s','m.subject_id=s.subject_id');
						$this->db->where('m.class_id',$class_id);
						$this->db->where('m.section_id',$section_id);
						$this->db->where('m.exam_id',$exam_id);
						$this->db->where('m.student_id',$data['student_id']);
						$q=$this->db->get()->result_array();
						foreach($q as $v)
						{
							$arrangeData[$v['subject']] 		= " ".($v['mark_obtained']+$v['internal_marks']).'/'.($v['mark_total']+$v['internal_total']);
						}
						$i=$i+1;
						$dataToExports[]			= $arrangeData;
					}
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
		$this->load->view('admin/tab_sheet_print' , $page_data);
	}
	
	
	function news_add() 
	{
		$this->load->view('admin/news_add');
	}
	
	
	function news($param1 = '', $param2 = '') 
	{
		if ($param1 == 'create') 
		{
			$news_code = $this->crud_model->create_news();
			redirect(base_url() . 'index.php/admin/news_view/details/' . $news_code , 'refresh');
		}
		if ($param1 == 'delete') 
		{
			$this->db->where('news_code' , $param2);
			$this->db->delete('news');
			redirect(base_url() . 'index.php/admin/news/', 'refresh');
		}
		$this->load->view('admin/news');
	}
	
	
	function news_view($param1 = '' , $param2 = '')
	{
		if ($param1 == 'details') 
		{
			$page_data['room_page'] = 'details';
			$page_data['news_code'] = $param2;
		}
		$page_data['news']= $this->db->get_where('news',array('news_code'=>$param2))->row()->title;
		$this->load->view('admin/news_overview', $page_data);
	}
	
	
	function news_message($param1 = '', $param2 = '', $param3 = '') 
	{
		if ($param1 == 'add') 
		{
			$this->crud_model->create_news_message($param2);
			redirect(base_url() . 'index.php/admin/news_view/details/' . $param2, 'refresh');
		}
	}
	
	function homework_add() 
	{    
		$this->load->view('admin/homework_add');
	}
	
	
	function homework_view() 
	{    
		$this->load->view('admin/homework1');
	}
	
	
	
	function get_class_subject($class_id) 
	{
	$running_year = get_running_year();
		$subject = $this->db->get_where('subject' , array('class_id' => $class_id,'year' => $running_year))->result_array();
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
			$this->load->view('admin/homework_add',$data);      
		}
		if ($param1 == 'edit') 
		{
			$this->crud_model->update_homework($param2);
			redirect(base_url() . 'index.php/admin/homework_view/' , 'refresh');
		}
		if ($param1 == 'delete')
		{
			$this->crud_model->delete_homework($param2);
			redirect(base_url() . 'index.php/admin/homework_view/', 'refresh');
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
		$this->load->view('admin/homework_room', $page_data);
	}
	
	
	function homeworkroom_edit($param1 = '' , $param2 = '')
	{
		if ($param1 == 'edit') 
		{
			$page_data['homework_code'] = $param2;
		}
		$page_data['page_title']=$this->db->get_where('homework',array('homework_code'=>$param2))->row()->title;
		$this->load->view('admin/homework_edit', $page_data);
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
			$this->load->view('admin/modal_study_material_add.php',$data);
		}
		if ($task == "update")
		{
			$this->crud_model->update_study_material_info($document_id);
			redirect(base_url() . 'index.php/admin/study_materials_view' , 'refresh');
		}
		if ($task == "delete")
		{
			$this->crud_model->delete_study_material_info($document_id);
			redirect(base_url() . 'index.php/admin/study_material');
		}
	}
	
	function study_material_add()
	{
		$this->load->view('admin/modal_study_material_add.php');
	}
	
	function study_material_delete($document_id)
		{
			$this->crud_model->delete_study_material_info($document_id);
			redirect(base_url() . 'index.php/admin/study_materials_view' , 'refresh');
		}
	
	function study_material_view()
	{
		$data['study_material_info']    = $this->crud_model->select_study_material_info();
		$this->load->view('admin/study_material', $data);    
	}
	
	
	public function study_material_edit($id)
	{
		$data['id']=$id;
		$this->load->view('admin/study_material_edit.php',$data);
	}
	
	
	function view_complaints() 
	{
		$this->load->view('admin/view_complaints');
	}
	
	
	function complaint_description_view($param1 = '' , $param2 = '')
	{
		if ($param1 == 'details') 
		{
			$page_data['report_code'] = $param2;
		}
		$page_data['page_title'] =$this->db->get_where('reporte_alumnos',array('report_code'=>$param2))->row()->title;
		$this->load->view('admin/complaint_details', $page_data);
	}

	function delete_complaints($report_id)
	{
		$this->db->where('report_id',$report_id);
		$this->db->delete('reporte_alumnos');
		redirect(base_url() . 'index.php/admin/view_complaints/');

	}
	
	
	function complaint_remark($param1 = '', $param2 = '')
	{
		if($param1 == 'create')
		{
			$this->crud_model->complaint_remark($param2);
			redirect(base_url() . 'index.php/admin/view_complaints/', 'refresh');
		}
	}
	function view_enquiry() 
	{
		$this->load->view('admin/veiw_enquiry');
	}
	
	
	function enquiry_description_view($param1 = '' , $param2 = '')
	{
		if ($param1 == 'details') 
		{
			$page_data['enquiry_id'] = $param2;
		}
		$page_data['page_title']= $this->db->get_where('enquiry',array('enquiry_id'=>$param2))->row()->title;
		$this->load->view('admin/enquiry_details', $page_data);
	}
	
	
	function enquiry_remark($param1 = '', $param2 = '')
	{
		if($param1 == 'create')
		{
			$this->crud_model->enquiry_remark($param2);
		}
		redirect(base_url() . 'index.php/admin/view_enquiry/', 'refresh');
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
			if($this->session->userdata('role')==1) 
			{
			    $data['description'] = $this->input->post('running_year');
			    $this->db->where('type' , 'running_year');
			    $this->db->update('settings' , $data);
			}
			$data['description'] = $this->input->post('header_title');
			$this->db->where('type' , 'header_title');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
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
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_logo') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_file') 
		{
			$data['title']=$this->input->post('title');
			$this->db->insert('tbl_apk_file',$data);
			$id=$this->db->insert_id();
			move_uploaded_file($_FILES['userfile']['tmp_name'],'uploads/apk/'.$id.'.apk');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_front_image') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/front_image.jpg');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_dashboard_slider') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'assets/images/slider_1.jpg');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'ad') 
		{
			$data['description'] = $this->input->post('ad');
			$this->db->where('type' , 'ad');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_slider') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider1.png');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_slider2') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider2.png');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if ($param1 == 'upload_slider3') 
		{
			move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/slider/slider3.png');
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		if($param1 == 'skin_colour')
		{
			$data['description'] = $this->input->post('skin_colour');
			$this->db->where('type' , 'skin_colour');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/admin/general_settings/', 'refresh');
		}
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('admin/general_settings', $page_data);
	}
	
	
	function admin_settings($param1 = '', $param2 = '', $param3 = '')
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
			
			$data['description'] = $this->input->post('rank');
			$this->db->where('type' , 'rank');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('bus_details');
			$this->db->where('type' , 'bus_details');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('expence');
			$this->db->where('type' , 'expence');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('msg_student_name');
			$this->db->where('type' , 'msg_student_name');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('system_name');
			$this->db->where('type' , 'system_name');
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
			
			$data['description'] = $this->input->post('department');
			$this->db->where('type' , 'department');
			$this->db->update('settings' , $data);
			
			
			redirect(base_url() .'index.php/admin/admin_settings/', 'refresh');
		}
		if ($param1 == 'ad') 
		{
			$data['description'] = $this->input->post('ad');
			$this->db->where('type' , 'ad');
			$this->db->update('settings' , $data);
			redirect(base_url() . 'index.php/admin/admin_settings/', 'refresh');
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
			redirect(base_url() . 'index.php/admin/admin_settings/', 'refresh');
		}
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('admin/admin_settings', $page_data);
	}
	
	
	function admin_settings_att_update()
	{
		
			
			$data['description'] = $this->input->post('diary');
			$this->db->where('type' , 'diary');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('full_attendance');
			$this->db->where('type' , 'full_attendance');
			$this->db->update('settings' , $data);
			
			
			$data['description'] = $this->input->post('attendance');
			$this->db->where('type' , 'attendance');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('h_attendance');
			$this->db->where('type' , 'hourly_attendance');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('teacher_attendance');
			$this->db->where('type' , 'teacher_attendance');
			$this->db->update('settings' , $data);
		
			redirect(base_url() .'index.php/admin/admin_settings/', 'refresh');
		}
	
	function admin_settings_menu_update()
	{
		
			$data['description'] = $this->input->post('fee_details');
			$this->db->where('type' , 'fee_details');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('special_fee');
			$this->db->where('type' , 'special_fee');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('transportation');
			$this->db->where('type' , 'transportation');
			$this->db->update('settings' , $data);//echo $this->db->last_query();die();
			
			$data['description'] = $this->input->post('stock');
			$this->db->where('type' , 'stock');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('home_test');
			$this->db->where('type' , 'home_test');
			$this->db->update('settings' , $data);
			
			$data['description'] = $this->input->post('entrance_test');
			$this->db->where('type' , 'entrance_test');
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
			
			$data['description'] = $this->input->post('expense');
			$this->db->where('type' , 'expense');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('news');
			$this->db->where('type' , 'news');
			$this->db->update('settings' , $data);
			$data['description'] = $this->input->post('time_table');
			$this->db->where('type' , 'time_table');
			$this->db->update('settings' , $data);
		
			$data['description'] = $this->input->post('admission');
			$this->db->where('type' , 'admission');
			$this->db->update('settings' , $data);
 
			$data['description'] = $this->input->post('migrate_class_section');
			$this->db->where('type' , 'migrate_class_section');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('show_multiple_dues');
			if($data['description']=='')
			{
				$data['description']	=	'no';
			}
			$this->db->where('type' , 'show_multiple_dues');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('single_row_for_all_dues');
			$this->db->where('type' , 'single_row_for_all_dues');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('view_inactive_for_others');
			$this->db->where('type' , 'view_inactive_for_others');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('internal_mark');
			$this->db->where('type' , 'internal_mark');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('afternoon_attendance');
			$this->db->where('type' , 'afternoon_attendance');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('fee2');
			$this->db->where('type' , 'fee2');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('completed_discontinued_button');
			$this->db->where('type' , 'completed_discontinued_button');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('photo_gallery');
			$this->db->where('type' , 'photo_gallery');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('student_delete');
			$this->db->where('type' , 'student_delete');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('mark_in_graph');
			$this->db->where('type' , 'mark_in_graph');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('auto_inc_adm_no');
			$this->db->where('type' , 'auto_inc_adm_no');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('acc_year_change');
			$this->db->where('type' , 'acc_year_change');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('tc');
			$this->db->where('type' , 'tc');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('exam_timetable');
			$this->db->where('type' , 'exam_timetable');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('hall_ticket');
			$this->db->where('type' , 'hall_ticket');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('half_day_leave');
			$this->db->where('type' , 'half_day_leave');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('attendance_summary');
			$this->db->where('type' , 'attendance_summary');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('admission_report');
			$this->db->where('type' , 'admission_report');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('year_change_in_settings');
			$this->db->where('type' , 'year_change_in_settings');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('show_receipt_number_in_textbox');
			$this->db->where('type' , 'show_receipt_number_in_textbox');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('non_migrated_students_list');
			$this->db->where('type' , 'non_migrated_students_list');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('show_todays_collection_in_dashboard');
			$this->db->where('type' , 'show_todays_collection_in_dashboard');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('parent_id_mother_name');
			$this->db->where('type' , 'parent_id_mother_name');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('otp_for_expense_add');
			$this->db->where('type' , 'otp_for_expense_add');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('show_transport_fee_with_normal_fee_pay');
			$this->db->where('type' , 'show_transport_fee_with_normal_fee_pay');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('installment_wise_receipt');
			$this->db->where('type' , 'installment_wise_receipt');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('view_deleted_for_others');
			$this->db->where('type' , 'view_deleted_for_others');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('installments_row_in_receipt');
			$this->db->where('type' , 'installments_row_in_receipt');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('account');
			$this->db->where('type' , 'account');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('transport_due_with_fee_due');
			$this->db->where('type' , 'transport_due_with_fee_due');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('show_double_receipt_per_page');
			$this->db->where('type' , 'show_double_receipt_per_page');
			$this->db->update('settings' , $data);

			$data['description'] = $this->input->post('show_double_receipt_minhaj');
			$this->db->where('type' , 'show_double_receipt_minhaj');
			$this->db->update('settings' , $data);



			redirect(base_url() .'index.php/admin/admin_settings/', 'refresh');
		}

	function advanced_settings() 
	{
		$this->load->view('admin/advanced_settings');
	}
	
	
	function attendance_delete() 
	{
		$this->load->view('admin/attendance_delete');
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
		$this->load->view('admin/attendance_delete',$data);    
	}
	
	
	function unit_test_delete() 
	{
		$this->load->view('admin/unit_test_delete');
	}
	
	
	function marks_get_subject1($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('admin/unit_test_delete1' , $page_data);
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
		$this->load->view('admin/unit_test_delete',$data);
	}
	
	
	function subject_unit_test_delete() 
	{
		$this->load->view('admin/subject_unit_test_delete');
	}
	
	
	function delete_class() 
	{
		$this->load->view('admin/delete_class');
	}

	
	function delete_section() 
	{
		$this->load->view('admin/section_delete');
	}
	
	
	function delete_subject() 
	{
		$this->load->view('admin/delete_subject');
	}
	
	
	function marks_get_subject2($class_id)
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('admin/delete_get_subject' , $page_data);
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
		$this->load->view('admin/subject_unit_test_delete',$data);
	}
	
	
	function delete_class_bulk() 
	{
		$class_id=$this->input->post('class_id');
		$result=$this->crud_model->delete_class_bulk($class_id);
		if($result>0)
		{
			$data["action"]="success";
		}
		$this->load->view('admin/delete_class',$data);
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
		$this->load->view('admin/section_delete',$data);
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
		$this->load->view('admin/delete_subject',$data);
	}
	
	
	function message()
	{
		$this->load->view('admin/message');
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
		$this->load->view('admin/absent_message_student_list', $data);
	}
	
	
	
	function get_special_message_students($class='', $section='')
	{
		$running_year=get_running_year();
		$this->db->where('class_id', $class);
		$this->db->where('section_id',$section);
		$this->db->where('year',$running_year);
$this->crud_model->check_student_status();
		$this->db->join('enroll', 'enroll.student_id = s.student_id');
		$this->db->select('s.student_id, s.name');
		$this->db->order_by('name','asc');
		$cls = $this->db->get('student s')->result_array();
		$data['student'] =$cls;
		$data['class']	=	 $class;
		$data['section']	=	 $section;
		$this->load->view('admin/special_message_list', $data);
	}
	function get_malayalam_message_students($class='', $section='')
	{
		$running_year=get_running_year();
		$this->db->where('class_id', $class);
		$this->db->where('section_id',$section);
		$this->db->where('year',$running_year);
$this->crud_model->check_student_status();
		$this->db->join('enroll', 'enroll.student_id = s.student_id');
		$this->db->select('s.student_id, s.name');
		$cls = $this->db->get('student s')->result_array();
		$data['student'] =$cls;
		$data['class']	=	 $class;
		$data['section']	=	 $section;
		$this->load->view('admin/malayalam_message_list', $data);
	}
	
	function new_private_message() 
	{
	$running_year=get_running_year();
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	    //$i=0;
		$ph='';
		$ph2='';
		$class =$this->input->post('class'); 
		$section = $this->input->post('section');
		$content = $this->input->post('message');
		$phone2= $this->input->post('phone2');
		$notification= $this->input->post('notification');
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  $content;
        date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d H:i:s');
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
		if($phone2==1)
		{
			$this->db->select('s.phone2,s.name,s.student_id,e.class_id as class');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.class_id',$class);
			if($section!='all')
			{
				$this->db->where('e.section_id',$section);
			}
           $this->db->where('e.year',$running_year);
         $this->crud_model->check_student_status();
			$a=$this->db->get()->result_array();
			//print_r($a);die();
			foreach($a as $b)
			{
				if($b['phone2']>0)
				{
					$data1['sms_master_id']	=$master_id;
					$data1['student_id']	=$b['student_id'];
					$data1['class_id']	=$class;
					$data1['section_id']	=$section;
					$data1['phone']	=$b['phone2'];
					date_default_timezone_set("Asia/Kolkata");
					$data1['send_date']	=  date('Y/m/d H:i:s');
					
					$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);
					if($master_id>0 && $content!='')
					{
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
			}
		}
		$this->db->select('s.phone1,s.name,s.student_id,e.class_id as class');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT'); 
	    $this->db->where('e.class_id',$class);
		if($section!='all')
		{
			$this->db->where('e.section_id',$section);
		}
     $this->db->where('e.year',$running_year);
    $this->crud_model->check_student_status();
		$a=$this->db->get()->result_array();
		foreach($a as $b)
		{
			$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$b['student_id'];
			$data1['class_id']	=$class;
			$data1['section_id']	=$section;
			$data1['phone']	=$b['phone1'];
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
					 $data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);
					 date_default_timezone_set("Asia/Kolkata");
					 $data1['send_date']	=  date('Y/m/d H:i:s');
					 if($master_id>0 && $content!='')
					 {
			         	$this->db->insert('tbl_sms_delivery_details',$data1);
					 }
		}
		$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$this->load->view('admin/message_popup',$data);
	}

	function new_multiple_class_message() 
	{
	$running_year=get_running_year();
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	    $i=0;
		$ph='';
		$ph2='';
		$class =$this->input->post('class[]'); 
		$cnt=sizeof($class);
		$section=0;
		$content = $this->input->post('message2');
		$phone2= $this->input->post('phone2');
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  $content;
        date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d H:i:s');
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
					//echo $phone2;die();
		if($phone2==1)
		{
			$this->db->select('s.phone2,s.name,s.student_id,e.class_id as class,e.section_id as section');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where_in('e.class_id',$class);
			if($section > 0)
			{
			$this->db->where('e.section_id',$section);
			}
           $this->db->where('e.year',$running_year);
         $this->crud_model->check_student_status();
   
			$a=$this->db->get()->result_array();
			//print_r($a);die();
			foreach($a as $b)
			{
				if($b['phone2']>0)
				{
				//for($i=0;$i<$cnt;$i++)
			    //{
					$data1['sms_master_id']	=$master_id;
					$data1['student_id']	=$b['student_id'];
					$data1['class_id']	=$b['class'];
					
					$data1['section_id']	=$b['section'];;
					$data1['phone']	=$b['phone2'];
					date_default_timezone_set("Asia/Kolkata");
					 $data1['send_date']	=  date('Y/m/d H:i:s');
					
					$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);
                    //if($b['class']==$class[$i])
					 //{
					 if($master_id>0 && $content!='')
					 {
						$this->db->insert('tbl_sms_delivery_details',$data1);
					 }
					 //}
			    //}
				}
			}
		}
		$this->db->select('s.phone1,s.name,s.student_id,e.class_id as class,e.section_id as section');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT'); 
	    $this->db->where_in('e.class_id',$class);
     	$this->db->where('e.year',$running_year);
    	$this->crud_model->check_student_status();
		$a=$this->db->get()->result_array();//echo $this->db->last_query();die();
		/*echo "<pre>";
		print_r($a);
		echo "</pre>";die();*/
		//for($i=0;$i<$cnt;$i++)
	//	{
		    foreach($a as $b)
			{
		
			$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$b['student_id'];
			
			$data1['class_id']	=$b['class'];
			
			$data1['section_id']	=$b['section'];
			$data1['phone']	=$b['phone1'];
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
			$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']	=  date('Y/m/d H:i:s');
					 //if($b['class']==$class[$i])
					 //{
			if($master_id>0 && $content!='')
			{		 
				$this->db->insert('tbl_sms_delivery_details',$data1);
			}
			         /*echo "<pre>";
		             print_r($data1);
		             echo "</pre>";*/
					 //}
			 
			}
			
		//}
		//die();
		$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$this->load->view('admin/message_popup',$data);
	}

function sms_send_popup($master_id)
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
	
	$return_message_ids = stream_get_contents($send); // It is a number. If invalid mob, then its value is 'Enter valid MobileNo'
	$message_id_array = explode(",", $return_message_ids);
	
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT); //If $return_message_ids is string,this will not print anything. Otherwise it's value will be same as $return_message_ids 
	$sms_data['msg_code']	=	$str; // If phone number is invalid,this field will be blank
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
	
	
	
	 redirect(base_url() . 'index.php/admin/message' , 'refresh');
	
	
	
	
	}
	
/*	function test_sms()
	{
//////////////////	
    $username   =   "schooldemo2017";
    $password   =   "school@123";
    $sender_id  =   "SCHOOL";
    $message    =   "Test sms";
    $time       =   "21-09-2018 11:00";
	$api        =   "http://bulksms.login2itsolutions.com";
	$location   =   $username.'/'.$password.'/'.urlencode($sender_id).'/8547750154/'.urlencode($message).'/'.urlencode($time).'/T';
	$api . "/sendsch?" . $location;
	$send = fopen($api . "/sendsch?" . $location, "r");
	$api . "/sendsch?" . $location;
	$return_message_ids = stream_get_contents($send); // It is a number. If invalid mob, then its value is 'Enter valid MobileNo'
	print_r($return_message_ids);
	$message_id_array = explode(",", $return_message_ids);
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	echo $str;
////////////////////	
	}*/
	
	
	function sms_send_popup_exam_report_all($master_id,$class_id,$section_id,$exam_id)
	
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
	
	redirect(base_url() . 'index.php/admin/tab_sheet/'.$class_id.'/'.$section_id.'/'.$exam_id , 'refresh');
	
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
	
	redirect(base_url() . 'index.php/admin/tab_sheet/'.$class_id.'/'.$section_id.'/'.$exam_id , 'refresh');
	
	}

	function sms_send_popup_exam_rank($master_id,$class_id,$section_id,$exam_id)
	
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
	
	redirect(base_url() . 'index.php/admin/rank/'.$class_id.'/'.$section_id.'/'.$exam_id , 'refresh');
	
	}
	
	
	function sms_send_popup_progress_report($master_id,$class_id,$student_id)
	
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
	
	redirect(base_url() . 'index.php/admin/student_portal/'.$student_id.'/'.$class_id, 'refresh');
	
	}
	
	
	
	function sms_send_popup_attn($master_id,$timestamp,$branch_id,$dept_id,$class_id,$section_id)
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
	
	
	 redirect(base_url() . 'index.php/admin/manage_attendance/'.$branch_id.'/'.$dept_id.'/'.$class_id.'/'.$section_id.'/'.$timestamp , 'refresh');
	
	
	
	
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
	
	
	
	 redirect(base_url() . 'index.php/admin/student_portal/'.$student_id.'/'.$class_id , 'refresh');
	
	
	
	
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
	
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	
	
	
	}
	}  
	?><script>alert("Message Send Successfully")</script>
	
	
	<?php //redirect(base_url() . 'index.php/admin/message' , 'refresh');
	
	
	$this->load->view('admin/message.php');
	
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
	
	$this->load->view('admin/add_student.php');
	
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
	
	//$this->load->view('admin/add_student.php');
	
	}
	
	function sms_send_resend($master_id)
	{
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	

	
	//$this->db->from('tbl_sms_delivery_details');
	$this->db->where('sms_master_id',$master_id);
	$this->db->group_start();
	$this->db->where('processed',0);
	$this->db->or_where('processed',1);
	$this->db->group_end();
	$a=$this->db->get('tbl_sms_delivery_details')->result_array();
	/*echo "<pre>";
	print_r($a);
	echo "</pre>";
	die();*/
	foreach($a as $b)
	
	{
    	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$b['phone'].'&msg=' . urlencode($b['msg_content']) . '&route=T';

    	$api = $url;
    	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
    	$balance = stream_get_contents($handle);
    	if ($balance >= 0) {
    	if($b['is_malayalam']=='N')
    	{
        	$api . "/sendsms?" . $location;
        	$send = fopen($api . "/sendsms?" . $location, "r");
        	$api . "/sendsms?" . $location;
    	}
    	else
    	{
        	
        	$api . "/sendunicodesms?" . $location;
        	$send = fopen($api . "/sendunicodesms?" . $location, "r");
        	$api . "/sendunicodesms?" . $location;
    	}
    	$return_message_ids = stream_get_contents($send);
    	$message_id_array = explode(",", $return_message_ids);
    	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
    	$sms_data['msg_code']	=	$str;
    	$sms_data['processed']	=	1;
    	$this->db->where('details_id',$b['details_id']);
    	$this->db->update('tbl_sms_delivery_details',$sms_data);
    	//$i++;
    	
    	
    	
    	}
	}
	
	?><script>alert("Message Send Successfully")</script>
	
	
	<?php redirect(base_url() . 'index.php/admin/message' , 'refresh');
	
	
	//$this->load->view('admin/message.php');
	
	}	
	
	function sms_report()
	{
	  $yesterday=date('Y-m-d',strtotime("-1 days"));
	
	$this->db->where('send_date<=',$yesterday);
	$this->db->delete('tbl_sms_delivery_master');
	$this->delete_sms_details_report();
	
	}
	function delete_sms_details_report()
	{
	    $yesterday=date('Y-m-d',strtotime("-1 days"));
		$this->db->where('send_date<=',$yesterday);
		$this->db->delete('tbl_sms_delivery_details');
		$this->load->view('admin/sms_report.php');
	}

	function sms_que_report()
	{
	$this->load->view('admin/sms_que_report.php');
	}
	function sms_deatail_report($master_id)
	{
	$data['master_id']	=	$master_id;
	$this->load->view('admin/sms_details_report.php',$data);
	}
	function sms_que_deatail_report($master_id)
	{
	$data['master_id']	=	$master_id;
	$this->load->view('admin/sms_que_details_report.php',$data);
	}
	function delete_sms_pop_up($master_id='',$page_from='',$class_id='',$section_id='',$due_date='',$due_date_from='null',$dept_id='')
	{ 
		$this->db->where('sms_master_id',$master_id);
		$this->db->delete('tbl_sms_delivery_master');
		
		$this->db->where('sms_master_id',$master_id);
		$this->db->delete('tbl_sms_delivery_details');
		
		//$data['master_id']	=$master_id;
		//$this->load->view('admin/message.php');
		//echo $due_date_from;die;
		if($page_from=='fee_due')
		{
			redirect('FeeManagement/fee_due_report2/'.$class_id.'/'.$section_id.'/'.$due_date.'/'.$due_date_from.'/'.$dept_id);
		}
		if($page_from=='special_fee')
		{
			redirect('FeeManagement/view_special_fee/');
		}
		if($page_from=='student_group')
		{	
			redirect('Admin/view_student_group/');
		}
		if($page_from=='entrance_test')
		{
			redirect('Admin/view_entrance_test/');
		}
		if($page_from=='rank')
		{
			redirect('Admin/rank/');
		}
		redirect('Admin/message');
	}


	function delete_sms_pop_up1($master_id)
	{
	
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed',0);
	$this->db->delete('tbl_sms_delivery_details');
	
	//$data['master_id']	=$master_id;
	redirect('admin/sms_que_report');
	}
	
	
	function sms_deatail_report1($master_id)
	{
	$msg_code='';
	$qry    =   'SET @@group_concat_max_len = 1000000';
	$this->db->query($qry);
	//SET SESSION group_concat_max_len = 1000000;
	$this->db->select('details_id,msg_code,processed,GROUP_CONCAT(msg_code) as code');
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed !=',2);
	$msg_code=$this->db->get('tbl_sms_delivery_details')->result_array();//echo $this->db->last_query();die();
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
	//echo $msg_code;die();
	
	$send = fopen($api . "/getdelivery/" . $username . "/" . $password . "/".$msg_code, "r");
	
	$status = stream_get_contents($send);
	//echo $status;die();
	$status_array = explode(",", $status) ;
	/*echo "<pre>";
	print_r($status_array);
	echo "</pre>";
	die();*/
	
	//$str = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $status_array);
	//$str1='Delivered';
	
	$this->db->where('sms_master_id',$master_id);
	$this->db->where('processed !=',2);
	$msg_code1=$this->db->get('tbl_sms_delivery_details')->result_array();
	$i=0;
	/*echo "<pre>";
	echo count($msg_code1);
	//print_r($status);
	echo "</pre>";
	die();*/ 
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
	$this->load->view('admin/sms_details_report.php',$data);
	
	
	}
	
	
	
	
	
	
	function resend_sms($details_id)
	{
	
	$this->db->where('details_id',$details_id);
	$this->db->group_start();
	$this->db->where('processed','1');
	$this->db->or_where('processed','0');
	$this->db->group_end();
	$query=$this->db->get('tbl_sms_delivery_details')->row();
	//print_r($query);die();
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	$message=$query->msg_content;
	$ph=$query->phone;
	
	//$message1= $content." "; 
	
	
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to=' .$ph. '&msg=' . urlencode($message ) . '&route=T';
	
	
	
	
	$api = $url;
	//echo $api."/sendsms?".$location;die();
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	if($query->is_malayalam=='N')
	{
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	}
	else
	{
	$api . "/sendunicodesms?" . $location;
	$send = fopen($api . "/sendunicodesms?" . $location, "r");
	$api . "/sendunicodesms?" . $location;
	}
	
	$return_message_ids = stream_get_contents($send);
	//$message_id_array = explode(",", $return_message_ids);
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	
	//$message_id_array = explode(",", $return_message_ids);
	
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$details_id);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	
	
	
	
	}
	redirect('admin/sms_report');
	
	}
	function resend_all($master_id)
	{
	$data['master_id']	=	$master_id;
	$this->load->view('admin/resend_all.php',$data);
	}
	
	function absent_message() 
	{
	$absent_date1=$this->input->post('timestamp');
	$absent_date=gmdate('d/m/Y',$absent_date1);
	$message_thread_code = $this->crud_model->send_new_absent_message($absent_date);
	}
	
	function new_notification_message() {
$running_year=get_running_year();
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
date_default_timezone_set("Asia/Kolkata");
	$data['send_date']	=  date('Y/m/d h:i:s ');
	$this->db->insert('tbl_sms_delivery_master',$data);
	$master_id		=	$this->db->insert_id();
	
	$this->db->select('s.phone1,s.name,s.student_id');
	$this->db->from('student s');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->where('e.class_id',$class);
	$this->db->where('e.section_id',$section);
$this->db->where('e.year',$running_year);
$this->crud_model->check_student_status();
	$a=$this->db->get()->result_array();
	foreach($a as $b)
	{
		$data1['sms_master_id']	=$master_id;
		$data1['student_id']	=$b['student_id'];
		$data1['class_id']	=$class;
		$data1['section_id']	=$section;
		$data1['phone']	=$b['phone1'];
		$content="Greetings from ".$common.".You will get attendance,Unit test and General notifications of your child here after. You can also check your students details online from ".$web_url." site  with following details.username ".$b['phone1']." and password ".$b['phone1']."";
		
		
						$message_content= " Hi ".$b['name'].' '.$content." ";
						
		$data1['msg_content']	= $message_content;
		
		
		 
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d h:i:s ');
		if($master_id>0)
		{
			$this->db->insert('tbl_sms_delivery_details',$data1);
		}
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('admin/message_popup2',$data);
	
	
	}
	function special_message() 
	{ 
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;

	$class =$this->input->post('class');
	
	 
	$section = $this->input->post('section');
	$content = $this->input->post('message1');
	$phone2= $this->input->post('phone2');
	$student = $this->input->post('student');
	$student_count=count($student);
	if (count($student) > 0) 
	{
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  $content;
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d  H:i:s');
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
		
		/*$this->db->select('s.phone1,s.name,s.student_id');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class);
		$this->db->where('e.section_id',$section);
		$a=$this->db->get()->result_array();*/
		
		for($i=0;$i<$student_count;$i++)
		{
			$this->db->select('phone1,phone2,name');
			$this->db->where('student_id',$student[$i]);
			$a=$this->db->get('student')->row();
			
			
			$data1['sms_master_id']	=   $master_id;
			$data1['student_id']	=   $student[$i];
			$data1['class_id']	    =   $class;
			$data1['section_id']	=   $section;
			$data1['phone']	        =   $a->phone1;
			
			
			$data1['msg_content']	= $this->sms_helper($common,$c,$n,$a->name,$content);;
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']	    =   date('Y/m/d  H:i:s');
			if($master_id>0 && $content!='')
			{
				$this->db->insert('tbl_sms_delivery_details',$data1);
				if($phone2==1)
				{
					if($a->phone2!='')
					{
						$data1['phone']	        =   $a->phone2; 
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
			}	
		}
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('admin/message_popup1',$data);
	
	//$message_thread_code = $this->crud_model->send_new_special_message();
	
	
	}
	function new_malayalam_message() {
	$student = $this->input->post('student');
$running_year=get_running_year();
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;

	
	 $class =$this->input->post('class');
	 $dept_id	=$this->input->post('dept_id');
	$section = $this->input->post('section');
	
	$content = $this->input->post('message');
	$phone2= $this->input->post('phone2');
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	date_default_timezone_set("Asia/Kolkata");
	$data['send_date']	=  date('Y/m/d  H:i:s');
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
		/*if($phone2==1)
		{
			$this->db->select('s.phone2,s.name,s.student_id');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.class_id',$class);
			$this->db->where('e.section_id',$section);
$this->db->where('e.year',$running_year);
$this->crud_model->check_student_status();
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
					$data1['is_malayalam']	='1';
					date_default_timezone_set("Asia/Kolkata");
					 $data1['send_date']	=  date('Y/m/d H:i:s');
					
					$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);

					$this->db->insert('tbl_sms_delivery_details',$data1);
				}
			}
		}*/
	if($dept_id=='all' || $dept_id=='All')
	{
    	
    	$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
    	$this->db->from('student s');
    	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
    	$this->db->where('e.year',$running_year);
        $this->crud_model->check_student_status();
    	$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
    	$a=$this->db->get()->result_array(); 
    	
    	foreach($a as $b)
    	{
        	$data1['sms_master_id']	=$master_id;
        	$data1['student_id']	=$b['student_id'];
        	$data1['class_id']	=$b['class'];
        	$data1['section_id']	=$b['section'];
        	$data1['phone']	=$b['phone1'];
        	$data1['is_malayalam']	='1';
        	$data1['msg_content']	=$this->sms_helper($common,$c,$n,$b['name'],$content);
            date_default_timezone_set("Asia/Kolkata");
    		$data1['send_date']	=  date('Y/m/d H:i:s');
			if($master_id>0 && $content!='')
			{
				$this->db->insert('tbl_sms_delivery_details',$data1);
				if($phone2==1)
				{
					if($b['phone2']!='')
					{
						$data1['phone'] =   $b['phone2'];    
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
			}	
    	}
	}
	
	if($class=='all')
	{
    	
    	$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
    	$this->db->from('student s');
    	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
    	$this->db->where('e.year',$running_year);
        $this->crud_model->check_student_status();
    	$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
    	$this->db->where('s.dept_id',$dept_id);
    	$a=$this->db->get()->result_array();
    	
    	foreach($a as $b)
    	{
        	$data1['sms_master_id']	=$master_id;
        	$data1['student_id']	=$b['student_id'];
        	$data1['class_id']	=$b['class'];
        	$data1['section_id']	=$b['section'];
        	$data1['phone']	=$b['phone1'];
        	$data1['is_malayalam']	='1';
        	$data1['msg_content']	=$this->sms_helper($common,$c,$n,$b['name'],$content);
            date_default_timezone_set("Asia/Kolkata");
    		$data1['send_date']	=  date('Y/m/d H:i:s');
			if($master_id>0 && $content!='')
			{
				$this->db->insert('tbl_sms_delivery_details',$data1);
				if($phone2==1)
				{
					if($b['phone2']!='')
					{
						$data1['phone'] =   $b['phone2'];    
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
			}
    	}
	}
	else if($class!='all')
	{
		if(count($student)>0)
		{
			$stud	=	array();
			for($i=0;$i<count($student);$i++)
			{
				array_push($stud,$student[$i]);  
			}
			
		}
		$this->db->select('s.phone1,s.phone2,s.name,s.student_id');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class);
		if($section!='all')
		{
			$this->db->where('e.section_id',$section);
		}
		$this->db->where('e.year',$running_year);
		if(count($student)>0)
		{
			$this->db->where_in('s.student_id',$stud);
		}
		$this->crud_model->check_student_status();
		$a=$this->db->get()->result_array();
		foreach($a as $b)
		{
		
			$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$b['student_id'];
			$data1['class_id']	=$class;
			$data1['section_id']	=$section;
			$data1['phone']	=$b['phone1'];
			$data1['is_malayalam']	='1';
			
			$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);;
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']	=  date('Y/m/d  H:i:s');
			if($master_id>0 && $content!='')
			{
				if($data1['phone']!='')
				{
					$this->db->insert('tbl_sms_delivery_details',$data1);
				}
				if($phone2==1)
				{
					$data1['phone']	=	$b['phone2'];
					if($data1['phone']!='')
					{
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
			}	
		}
	}	
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	$class;
	$data['section_id']	=	$section;
	$this->load->view('admin/message_popup_mal',$data);
	
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
	$this->load->view('admin/add_class.php');
	//redirect(base_url().'index.php?admin/create')
	
	}
	
	function view_subject($class_id= '',$branch_id= '',$dept_id= '')
	{
	$running_year = get_running_year();
	
	$page_data['class_id']=$class_id;
	$page_data['branch_id']=$branch_id;
	$page_data['dept_id']=$dept_id;
	$page_data['year']	=	$running_year;
	$page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $class_id,'year' => $running_year))->result_array();
	$this->load->view('admin/view_subject.php',$page_data);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function add_class()
	{
$running_year = get_running_year();
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
	else if($role==4 || $role==12)
	{
	$data['branch_id']	=	$this->session->userdata('branch_id'); 
	$data['dept_id']	=	$this->session->userdata('dept_id'); 
	}
	
	$data['name']         = $this->input->post('class');
$data['academic_year']         = $running_year;
	
	$class_id =$this->crud_model->class_insert($data);
	$data2['class_id']  =   $class_id;
	$data2['name']      =   'A';
$data2['academic_year']         = $running_year;
	$result=$this->crud_model->manage_classes($data2);
	if($result>0){
	$data1["action"]="success";
	}
	$this->load->view('admin/add_class.php',$data1);
	
	
	}
	
	function delete_student($student_id,$class_id)
	{
	$data['class_id']=$class_id;
	$this->crud_model->student_delete($student_id);
	redirect(base_url() . 'index.php/admin/students_area/'.$data['class_id']);
	
	}		
	
	
	function view_class()
	{
	 $running_year = get_running_year();
	$role=$this->session->userdata('role');
	if($role==1 || $role==2)
	{
	$branch		=		$this->input->post('branch');
	$dept		    =		$this->input->post('department');
	
	$this->db->select('name,class_id,branch_id,dept_id');
	$this->db->from('class');
	/*if($branch && $dept=='All')
	{
	$this->db->where('branch_id',$branch);
	}*/
	if($branch && $dept)
	{
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	}
	$this->db->where('academic_year',$running_year);
	$page_data['class']    =   $this->db->get()->result_array();
	}
	
	if($role==3)
	{
	$branch		=		$this->session->userdata('branch_id');
	$dept		=		$this->input->post('department');
	
	$this->db->select('name,class_id,branch_id,dept_id');
	$this->db->from('class');
	/*if($branch && $dept=='All')
	{
	$this->db->where('branch_id',$branch);
	}*/
	if($dept)
	{
	
	$this->db->where('dept_id',$dept);
	}
	$this->db->where('branch_id',$branch);
	$this->db->where('academic_year',$running_year);
	$page_data['class']    =   $this->db->get()->result_array();
	}
	
	if($role==4 || $role==12)
	{
	$branch		=		$this->session->userdata('branch_id');
	$dept		=		$this->session->userdata('dept_id');
	
	$this->db->select('name,class_id,branch_id,dept_id');
	$this->db->from('class');
	/*if($branch && $dept=='All')
	{
	$this->db->where('branch_id',$branch);
	}*/
	
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$this->db->where('academic_year',$running_year);
	$page_data['class']    =   $this->db->get()->result_array();
	}
	$this->load->view('admin/view_class.php',$page_data);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function new_subject_add($class_id,$branch_id='',$dept_id='')
	{
	$this->load->model('Crud_model');
	$page_data['class_id'] =$class_id;
	$page_data['branch_id'] =$branch_id;
	$page_data['dept_id'] =$dept_id;
	$page_data['section'] =	$this->Crud_model->get_section($class_id);
	$this->load->view('admin/add_subject.php',$page_data);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function view_class_edit($class_id)
	{
	$this->load->Model('crud_model');
	$class_name['class_id']=$class_id;
	$class_name['a']    = $this->crud_model->get_class_name($class_id);
	$this->load->view('admin/view_class_edit.php',$class_name);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function subject_edit($class_id,$branch_id,$dept_id,$subject_id,$teacher_id='')
	{
	$this->load->model('Crud_model');
	$data['class_id']=$class_id;
	$data['branch_id']=$branch_id;
	$data['dept_id']=$dept_id;
	$data['subject_id']=$subject_id;
	$data['teacher_id']=$teacher_id;
	$data['section'] =	$this->Crud_model->get_section($class_id);	
	$this->load->view('admin/subject_edit.php',$data);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function update_subject($class_id,$branch_id,$dept_id)
	{  
	
	$p               		= 	$this->input->post('subject');
	$data['name']       	= 	$this->input->post('name');
	
	$data1['class_id']		=	$this->input->post('cls_id');
	$data1['section_id']	=	$this->input->post('section_id[]');
	$data1['teacher_id']	=	$this->input->post('teacher_id[]');
	
	$this->crud_model->subject_edit($data,$p,$data1);
	redirect(base_url() . 'index.php/admin/view_subject/'. $data1['class_id'].'/'.$branch_id.'/'.$dept_id, 'refresh'); 
	}       
	function edit_class()
	{
	$data['class_id']         = $this->input->post('cls_id');
	$data['name']         = $this->input->post('name');
	$data['branch_id']         = $this->input->post('branch');
	$data['dept_id']         = $this->input->post('department');                                        
	$this->load->Model('crud_model');
	$this->crud_model->update_classes($data['class_id'],$data['name']);
	redirect(base_url() . 'index.php/admin/view_class/', 'refresh'); 
	
	}
	function view_class_delete($class_id)
	{
	$this->load->Model('crud_model');
	$this->crud_model->delete_classes($class_id);
	redirect(base_url() . 'index.php/admin/view_class/', 'refresh'); 
	}
	function subject_delete($subject_id,$class_id,$branch_id='',$dept_id='')
	{
	$this->crud_model->subject_delete($subject_id);
	
	
	redirect(base_url() . 'index.php/admin/view_subject/'.$class_id.'/'.$branch_id.'/'.$dept_id, 'refresh'); 
	
	}
	function section($class_id = '')
	{
	$academic_year=get_running_year();
	$role=$this->session->userdata('role');
	if ($class_id == '')
	{
	if($role==3)
	{
	$this->db->where('branch_id',$this->session->userdata('branch_id'));
	}
	elseif($role==4 || $role==12)
	{
	$this->db->where('branch_id',$this->session->userdata('branch_id'));
	$this->db->where('dept_id',$this->session->userdata('dept_id'));
	}
    if($role==1 || $role==2)
	{
	$academic_year = get_running_year();
	$this->db->where('academic_year',$academic_year);
	$class_id           =   $this->db->get('class')->first_row()->class_id;
	
	}
	else
	{
	$this->db->where('academic_year',$academic_year);
	$class_id           =   $this->db->get('class')->first_row()->class_id;
	
	}
	}
	$page_data['class_id']   = $class_id;
	$this->load->view('admin/add_section.php',$page_data);
	}
	function view_section_add($class_id)
	{
	$this->load->Model('crud_model');
	$class_name['class_id']=$this->input->post('class');
	$class_name['a']    = $this->crud_model->get_class_name($class_name['class_id']);
	$class_name['cls']	=$class_id;
	$this->load->view('admin/view_section_add.php',$class_name);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function add_section()
	{

	$running_year = get_running_year();
	$data['name']       =   $this->input->post('name');
	$data['class_id']   =   $this->input->post('class_id');
	$data['teacher_id'] =   $this->input->post('teacher_id');
	$data['academic_year'] =  $running_year;
	$result=$this->crud_model->add_section($data);
	if($this->input->post('teacher_id')!= "")
	{
	$this->db->select('user_id');
	$this->db->from('staff');
	$this->db->where('staff_id',$this->input->post('teacher_id'));
	$query=$this->db->get()->row();
	$data1['is_class_teacher']  ="Y";
	$this->db->where('user_id',$query->user_id);
	$this->db->update('tbl_users',$data1);
	}
	if($result>0){
	$data["action"]="success";
	}
	//redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
	$this->load->view('admin/view_section_add.php',$data);}
	function section_edit($class_id,$section_id)
	{
	$data['class_id']       = $class_id;
	$data['section_id']   =   $section_id;
	$this->load->view('admin/section_edit.php',$data);
	}
	function update_section()
	{
	$param2=$this->input->post('section');
	$data['name']       =   $this->input->post('name');
	$data['class_id']   =   $this->input->post('class_id');
	
	$data['teacher_id'] =   $this->input->post('teacher_id');
	
	if($this->input->post('teacher_id')!= "")
	{
		$this->db->select('user_id');
		$this->db->from('staff');
		$this->db->where('staff_id',$this->input->post('teacher_id'));
		$query=$this->db->get()->row();
		$data1['is_class_teacher']  ="Y";
		$this->db->where('user_id',$query->user_id);
		$this->db->update('tbl_users',$data1);
	}
	else
	{
		$year	=	get_running_year();
		$this->db->where('section_id',$param2);
		$this->db->where('academic_year',$year);
		$teacher_id	=	$this->db->get('section')->row()->teacher_id;
		if($teacher_id>0)
		{
			$this->db->select('user_id');
			$this->db->from('staff');
			$this->db->where('staff_id',$teacher_id);
			$query=$this->db->get()->row();
			//print_r($query);die();
			$data1['is_class_teacher']  ="N";
			$this->db->where('user_id',$query->user_id);
			$this->db->update('tbl_users',$data1); //echo $this->db->last_query();die();
		}	
	}
	
	$this->load->Model('crud_model');
	$this->crud_model->edit_section( $data,$param2);
	redirect(base_url() . 'index.php/admin/section/' . $data['class_id'] , 'refresh');
	}
	function section_delete($section_id)
	{
		$section_row = $this->db->get_where('section', array('section_id' => $section_id))->row();
		$class_id = isset($section_row->class_id) ? $section_row->class_id : '';
		$this->load->Model('crud_model');
		$this->crud_model->delete_section($section_id);
		if (!empty($class_id)) {
			redirect(base_url() . 'index.php/admin/section/' . $class_id, 'refresh');
		} else {
			redirect(base_url() . 'index.php/admin/section', 'refresh');
		}
	}
	function add_subject($class_id,$branch_id,$dept_id)
	{
	
	
	$data['name']       = $this->input->post('name');
	$data['class_id']   = $class_id;

	$data1['class_id']   	= 	$class_id;
	$data1['section_id']	=	$this->input->post('section_id[]');
	$data1['teacher_id'] 	= 	$this->input->post('teacher_id[]');
	
	$data['year']       = get_running_year();
	$result=$this->crud_model->subject_add($data,$data1);
	if($result>0){
	$page_data['action']="success";
	$page_data['class_id']=$class_id;
	$page_data['branch_id']=$branch_id;
	$page_data['dept_id']=$dept_id;
	
	//$page_data['subjects']   = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
	
	}
	$this->load->model('Crud_model');
	$page_data['section'] =	$this->Crud_model->get_section($class_id);
	//redirect(base_url() . 'index.php/admin/view_subject/'.$class_id, 'refresh');
	$this->load->view('admin/add_subject.php',$page_data);
	}
	
	function class_migration(){
	$this->load->view('admin/class_migration.php');
	}
	
	function migrate_check($class,$section,$academic_year,$branch,$department)
	{
		$cls = $this->crud_model->migrate_check($class,$section,$academic_year);
		$data['student'] =$cls;
		 $data['branch'] =$branch;
		$data['dept'] =$department;
                $data['from_year']	=	$academic_year;
		
		$this->load->view('admin/check_migration.php', $data);
	}

	function class_migrate()
	{
		$num 		= 	$this->input->post('num');
		$student 	= 	$this->input->post('student');
		$roll 		= 	$this->input->post('roll');
		$from_year 	=	$this->input->post('from_year');
		
		if (count($num) > 0) {
			$class=$this->input->post('class1');
			$section=$this->input->post('section1');
			$year=$this->input->post('academic_year');
			
			for($i=0;$i<count($num);$i++)
			{
				$counter					=	$num[$i];
				$this->db->where('student_id',$student[$counter]);
				$this->db->where('year',$year);
				$res						=	$this->db->get('enroll')->row();
				if(!isset($res))
				{
					$data['student_id']		=	$student[$counter];
					$data['roll']			=	$roll[$counter];
					$data['class_id']		=	$class;
					$data['section_id']		=	$section;
					$data['year']			=	$year;
					$data['enroll_code']    = 	substr(md5(rand(0, 1000000)), 0, 7);
					$data['date_added']     = 	strtotime(date("Y-m-d H:i:s"));
					$data['is_migrated']	=	"Y";
					$result					=	$this->crud_model->class_migrate($data,$student[$counter]);//echo $this->db->last_query();
					
					//Check if fee is pending
					$opening_balance_ref_id			=	"";
					$cur_year_fee_bal				=	$this->Fee_management_model->get_fee_balance_master($student[$counter],$from_year);
					if($cur_year_fee_bal>0)
					{
						$opening_balance_ref_id		=	$this->Fee_management_model->generate_ref_id($student[$counter],$from_year);
						//Update reference id in tbl_students_fee_master
						$where['admission_number']	=	$student[$counter];
						$where['academic_year_id']	=	$from_year;		
						$where['fee_balance>']		=	0;						
						$this->Fee_management_model->update_reference_id('opening_balance_reference_id',$opening_balance_ref_id,'tbl_students_fee_master',$where);
						$result						=	$this->Fee_management_model->insert_opening_balance($student[$counter],$from_year,$opening_balance_ref_id,$year);
						$where						=	array();
					}
					
					//Check if bus fee is pending
					$cur_year_bus_fee_bal			=	$this->Fee_management_model->get_bus_fee_balance($student[$counter],$from_year);
					if($cur_year_bus_fee_bal>0)
					{
						if($opening_balance_ref_id=="")
						{
							$opening_balance_ref_id	=	$this->Fee_management_model->generate_ref_id($student[$counter],$from_year);
						}
						//Update reference id in tbl_transport_students_bus_fee_master
						$where['student_id']		=	$student[$counter];
						$where['academic_year']		=	$from_year;	
						$where['fee_balance>']		=	0;					
						$this->Fee_management_model->update_reference_id('opening_balance_reference_id',$opening_balance_ref_id,'tbl_transport_students_bus_fee_master',$where);
						$result						=	$this->Fee_management_model->insert_opening_balance_transport($student[$counter],$from_year,$opening_balance_ref_id,$year);
						$where						=	array();
					}
				}
				
				
			}
		}
		if(isset($result) && $result>0){
			$data["action"]="success";
		}
		//$this->load->view('admin/class_migration.php',$data);
		redirect('admin/class_migration');
	}
	function sms_template() 
	{
	
	
	$page_data['sms']    = $this->db->get('sms_template')->result_array();
	$this->load->view('admin/sms_template.php',$page_data);
	}
	function new_sms_template() 
	{
	$this->load->view('admin/new_sms_template.php');
	}
	function sms_template_add() 
	{
	
	
	 $data['title']           = $this->input->post('title');
            $data['content']           = $this->input->post('content');
			$this->db->insert('sms_template', $data);
             redirect('admin/sms_template');
	}
	function sms_settings() 
	{
	
	$this->load->view('admin/sms_settings.php');
	}
	function student_bulk() 
	{
	$this->load->view('admin/student_bulk.php');
	}
	function add_template() 
	{
	$this->load->view('admin/add_template.php');
	}
	function template_edit($id) 
	{
	$data['t_id']           =$id;
	$this->load->view('admin/edit_template.php',$data);
	}
	
	function report() 
	{
	$this->load->view('admin/report.php');
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
    	if(date('m',strtotime($from))==date('m'))
    	{
    	    $location = "/".urlencode($username)."/".urlencode($password)."/".urlencode($sender_id)."/".urlencode($from)."00:01/".urlencode($to)."23:59"; 
    	    $api = $url;
    	    header('Content-type: text/csv');
    	    header('Content-Disposition: attachment; filename="sms.csv"');
    	    $file = readfile($api."/getdeliverysender".$location, "r");
    	}
    	else
    	{
        	//$location = "/".urlencode($username)."/".urlencode($password)."/".urlencode($sender_id)."/".urlencode($from)."00:01/".urlencode($to)."23:59";
        	$location = "/".urlencode($username)."/".urlencode($password)."/".urlencode($from)."12:00am/".urlencode($to)."11:59pm";
        	$api = $url;
        	//echo $api."/getolddelivery".$location;die();
        	header('Content-type: text/csv');
        	header('Content-Disposition: attachment; filename="sms.csv"');
        	//$file = readfile($api."/getdeliverysender".$location, "r");
        	$file = readfile($api."/getolddelivery".$location, "r");
    	}
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
	$this->load->view('admin/sms_template.php',$data);
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
	$this->load->view('admin/add_template.php',$data);
	}
	function template_delete($id) 
	{
	$this->crud_model->template_delete($id);
	redirect(base_url() . 'index.php/admin/sms_template/', 'refresh');
	}
	
	function get_template_content($id)
	{
		$sections = $this->db->get_where('sms_template' , array('id' => $id))->row();
		echo $sections->content;
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
				if($this->session->userdata('role')>=4)
				{
					$branch	=$this->session->userdata('branch_id');
					$dept	=$this->session->userdata('dept_id');
				}
				else if($this->session->userdata('role')==3)
				{
					$branch	=$this->session->userdata('branch_id');
					$dept    = $this->input->post('department');
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
					$data3['password']		=	sha1($phones[$i]);
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
					if($data['name'] == '' || $data['phone1'] == ''|| $data['user_id']=='')
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
		
						//echo "submit pressed";die();
					$this->db->insert('enroll' , $data2);
					//$data1["action"]="success";
					$action	=	"success";
					$this->session->set_flashdata('action',$action);
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
							$data10['send_date']	=  date('Y/m/d H:i:s');
						$this->db->insert('tbl_sms_delivery_master',$data10);
						$master_id		=	$this->db->insert_id();
						
						$data11['sms_master_id']	=$master_id;
						$data11['student_id']	= $student_id;
						$data11['class_id']	=$this->input->post('class_id');
						$data11['section_id']	=$this->input->post('section_id');
						$data11['phone']	=$data['phone1'];
						$data11['msg_content']	= $message;
						
						date_default_timezone_set("Asia/Kolkata");
							$data11['send_date']	=  date('Y/m/d H:i:s');
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
			
	
	//redirect(base_url() . 'index.php/admin/student_bulk/' . $this->input->post('class_id') , 'refresh');
		}           
	//$page_data['page_name']  = 'student_bulk';
	//$page_data['page_title'] = get_phrase('Student-Bulk');
		redirect('Admin/student_bulk');
	//$this->load->view('admin/student_bulk',$data1);
	
	}
	
	function get_sections($class_id)
	{
	$page_data['class_id'] = $class_id;
	$this->load->view('admin/student_bulk_sections' , $page_data);
	}
	
	function students_area($class_id = '',$order='',$migrated='')
	{
	
	$data['class_id']=$class_id;
	$data['order']=$order;
	$data['migrated']=$migrated;
	$this->load->view('admin/student_area1.php',$data);
	}
	
	function students_area_filter($class_id = '',$order='')
	{
	$data['class_id']=$class_id;
	$data['order']=$order;
	$this->load->view('admin/filter.php',$data);
	}
	
	function students_area_name($class_id = '',$order='',$section='')
	{
	$data['class_id']=$class_id;
	$data['order']=$order;
	$data['section']=$section;
	$this->load->view('admin/students_area_name.php',$data);
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
	$this->load->view('admin/message_popup_individual',$data);
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
	//$student_id		= $this->input->post('student_id');
		if(isset($_POST['class']))
		{
			$this->db->db_debug	=	FALSE;
			$this->db->trans_start();
			$class_id		= $this->input->post('class');
			$section_id		= $this->input->post('section');
			$from_section	= $this->input->post('from_section');
			$fee_master_id	= $this->input->post('fee_master_id');
			$is_fee_paid= is_fee_paid($student_id);
			//////////////////Fee Master Update////////////////////
			$year	=	get_running_year();	
			if($is_fee_paid!='y')
			{
			
			$this->db->select('fee_installment_master_id,fee_payment_options_master_id,fee_payment_options_details_id,fee_total,fee_balance,due_date');
			$this->db->from('tbl_fee_installment_master');
			$this->db->where('fee_master_id',$fee_master_id);
			$result=$this->db->get()->result_array();
			
			///////////////////////
						
				$this->db->select('students_fee_master_id,class_id'); // get the fee_master_id
				$this->db->from('tbl_students_fee_master');
				$this->db->where('admission_number' , $student_id);
				$this->db->where('academic_year_id',$year);
				$this->db->where('is_deleted','N');
				//$this->db->where('class_id' , $class_id);
				//$this->db->where('batch_id' , $section_id);
                                date_default_timezone_set('Asia/Kolkata');
				$result1=$this->db->get()->result_array();
				$master_id=0;
				foreach($result1 as $row1)
				{
					$master_id	=	$row1['students_fee_master_id'];
				
					if($master_id>0)
					{
						$this->db->where('students_fee_master_id' , $master_id); // delete it from details table
                                                $this->db->set('is_deleted','Y');
                                                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                                                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
						$this->db->update('tbl_students_fee_details');
//						$this->db->delete('tbl_students_fee_details');
						
						
						$this->db->where('admission_number' , $student_id); // then delete from master table
						//$this->db->where('class_id' , $class_id);
						//$this->db->where('batch_id' , $section_id);
						$this->db->where('academic_year_id',$year);
                                                $this->db->where('is_deleted','N');
                                                $this->db->set('is_deleted','Y');
                                                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                                                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
						$this->db->update('tbl_students_fee_master');
//						$this->db->delete('tbl_students_fee_master');
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
			
			/////////////////Fee Master Update Complete
			
	/////////////////Bus route Update Start /////////////
	
			$running_year = get_running_year();

	$transportation=$this->db->get_where('settings' , array('type' => 'transportation'))->row()->description;
	if($transportation=='yes' && $this->input->post('route_master_id')!='' && $this->input->post('route_register_id') && $this->input->post('pickup_point'))
	{
		$bus_fee_paid = $this->input->post('bus_fee_paid');
		$branch_id = $this->input->post('branch_id');
		if($bus_fee_paid != 'y')
		{
			$this->db->where('student_id',$student_id);
                        $this->db->where('academic_year',$running_year);
                        $this->db->set('is_deleted','Y');
                        $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                        $this->db->set('deleted_date',date('Y-m-d H:i:s'));
			$this->db->update('tbl_transport_students_bus_fee_master');
			
			$rows				=	$this->Transport_management_model->get_fee_installment($branch_id,$running_year);
			
			foreach($rows as $row)
			{
				$bus_route = array(
							'student_id'			=> 	$student_id,
							'route_master_id' 		=> 	$this->input->post('route_master_id'),
							'route_register_id' 	=> 	$this->input->post('route_register_id'),
							'route_details_id'		=> 	$this->input->post('pickup_point'),
							'fee_amount'			=> 	$this->input->post('base_fare'),
							'fee_balance'			=> 	$this->input->post('base_fare'),
							'bus_fee_settings_id' 	=> 	$row['bus_fee_settings_id'],
							'due_date' 				=> 	$row['payment_date'],
							'academic_year'			=>	$row['academic_year'],
							);
				$num_rows_updated	=	$this->Transport_management_model->bus_fee_installment_insert($bus_route);	
			}
		}
	}
	
	/////////////////Bus route Update End /////////////
			
			if($from_section!=$section_id)
			{
				$this->crud_model->update_section($student_id,$class_id,$year,$section_id,$from_section);
			}
			
			$data1['roll']           	= $this->input->post('roll');
			$data['admission_number']   = $this->input->post('admission_number');
			$data1['class_id']          = $this->input->post('class');
			$data1['section_id']        = $this->input->post('section');
			$data['name']           	= $this->input->post('name');
			$data['school']         	= $this->input->post('school_name');
			$data['phone1']         	= $this->input->post('phone1');
			$data['phone2']         	= $this->input->post('phone2');
			$data['phone3']         	= $this->input->post('phone3');
			$data['aadhaar_number']     = $this->input->post('aadhaar_number');
			// $data['parent']          = $this->input->post('parent');
			$certificate 				= $this->input->post('certificate[]');
			$certificate_id 	='';
			if(!empty($certificate)){
				foreach($certificate as $c){
					$certificate_id = $certificate_id.",'".$c."'";
				}
			}
			$data['certificates_submitted'] = $certificate_id;

			$data['sex']          		= $this->input->post('sex');
			
			$data['address']        	= $this->input->post('address');
			$data['parent']      		= $this->input->post('parent');
			if($this->db->get_where('settings' , array('type' =>'parent_id_mother_name'))->row()->description == 'yes')
			{
				$data['mother_name']     = $this->input->post('mother_name');
				
				$data['parent_id']       = $this->input->post('parent_id');
				$data['whatsapp_number'] = $this->input->post('whatsapp_number');
			}
			$data['birthday']       	= $this->input->post('birthday');
			// $data['dormitory_id']   	= $this->input->post('dormitory_id');
			// $data['transport_id']   	= $this->input->post('transport_id');
			$data['student_session'] 	= $this->input->post('student_session');
			 $data['email']          	= $this->input->post('email');
			
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
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('action','failed');	
			}
			else
			{
				$this->session->set_flashdata('action','success');	
			}
			
		}
		//move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
		redirect(base_url() . 'index.php/admin/student_portal/'.$student_id ,'refresh');
	
	}
	function getExtension($str) 
	{
         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 	}

	
	function mark_message($class_id,$section_id,$student_id,$mark_obtained,$mark_total,$average,$grade_id,$exam_id,$subject)
	{
		$sms = $this->db->get('sms_settings')->row();
		$sender_id = $sms->sender_id;
		$username = $sms->username;
		$password = $sms->password;
		$common = $sms->common_word;
		$url = $sms->url;
		$content = "Progress Report";
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$datas['send_by']	=$staff;
		$datas['content']	=  $content;
		date_default_timezone_set("Asia/Kolkata");
		$datas['send_date']	=  date('Y/m/d H:i:s');
		$this->db->insert('tbl_sms_delivery_master',$datas);
		$master_id		=	$this->db->insert_id();
		$running_year = get_running_year();
		$exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
		$student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
		$grade = $this->db->get_where('grade' , array('grade_id' => $grade_id))->row()->grade;
		$phone1 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone1;
		$phone2 = $this->db->get_where('student' , array('student_id' => $student_id))->row()->phone2;
		if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
			{
				$c= '1';
			}
		else
			{
				$c= '0';
			}
	
		$message ="Progress Report - Exam Name: ".$exam_name. ", Name : ".$student_name.",For ".$subject." Total Marks Obtained : ".$mark_obtained." Out Of : " .$mark_total.", Percentage : ".$average."% grade: ".$grade;
		$data1['sms_master_id']	=$master_id;
		$data1['student_id']	=$student_id;
		$data1['class_id']	=$class_id;
		$data1['section_id']	=$section_id;
		$data1['phone']	=$phone1;
		$data1['msg_content']	=$this->sms_helper1($common,$c,$message);
		date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d H:i:s');
		$this->db->insert('tbl_sms_delivery_details',$data1);
	
		$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class_id;
		$data['section_id']	=	$section_id;
		$data['student_id']	=	$student_id;
		
		$this->load->view('admin/message_popup_progress_report',$data);
	
	}
	function attendance_message($class_id,$section_id,$student_id,$present,$total,$percentage,$month)
	{
	if ($this->session->userdata('admin_login') != 1)
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
	redirect(base_url() . 'index.php/admin/student_portal/'.$student_id ,'refresh');
	
	
	
	}
	
	function student_portal($student_id,$class_id='')
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
 //           $page_data['student_portal_model']=$this->crud_model->student_portal_data($student_id);

            $monthly_attendance = array();//$this->crud_model->get_attendance_monthly($student_id);
            // $fee_master		=	$this->crud_model->get_fee_master_by_class($class_id);

            $page_data['student_id'] 		 	=  $student_id;
            $page_data['class_id']  		 	=  $class_id;
            $page_data['section_id']  		 	=  $section_id;
            // $page_data['fee_master']  		 	=  $fee_master;
            $page_data['monthly_attendance']    =  $monthly_attendance;
            // $page_data['total_paid_amount']     =  $this->Fee_management_model->progress_report_fee_data($student_id,$class_id,$section_id,$special_fee="no",$single_record="yes");
            // $page_data['pending_till_today']    =  $this->Fee_management_model->get_pending_fee($student_id,$class_id,$till_today="yes");
            // $page_data['total_pending']         =  $this->Fee_management_model->get_pending_fee($student_id,$class_id);
			$page_data['certificate']			= $this->db->get('student_certificates')->result_array();

            $this->load->view('admin/student_portal.php',$page_data);
	}

	function student_portal_fee($student_id,$class_id='')
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

        $fee_master		=	$this->crud_model->get_fee_master_by_class($class_id);

        $page_data['student_id'] 		 	=  $student_id;
        $page_data['class_id']  		 	=  $class_id;
        $page_data['section_id']  		 	=  $section_id;
        $page_data['fee_master']  		 	=  $fee_master;
        $page_data['total_paid_amount']     =  $this->Fee_management_model->progress_report_fee_data($student_id,$class_id,$section_id,$special_fee="no",$single_record="yes");
        $page_data['pending_till_today']    =  $this->Fee_management_model->get_pending_fee($student_id,$class_id,$till_today="yes");
        $page_data['total_pending']         =  $this->Fee_management_model->get_pending_fee($student_id,$class_id);

        $this->load->view('admin/student_portal_fee.php',$page_data);
	}
	
	function new_sendall_message()
	{
	$running_year=get_running_year();
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;

	$class = $this->input->post('class');
	$phone2= $this->input->post('phone2');
	$dept_id=$this->input->post('dept_id');
	
	$content = $this->input->post('message_send');
	//$phone2= $this->input->post('phone2');
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
	date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d H:i:s');
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
	/*				
	if($phone2==1)
		{
			$this->db->select('s.phone2,s.name,s.student_id');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.class_id',$class);
			//$this->db->where('e.section_id',$section);
            $this->db->where('e.year',$running_year);
            $this->crud_model->check_student_status();
			$a=$this->db->get()->result_array();
			
			foreach($a as $b)
			{
				if($b['phone2']>0)
				{
					$data2['sms_master_id']	=$master_id;
					$data2['student_id']	=$b['student_id'];
					$data2['class_id']	=$class;
					//$data1['section_id']	=$section;
					
					$data2['phone']	=$b['phone2'];
					date_default_timezone_set("Asia/Kolkata");
					 $data2['send_date']	=  date('Y/m/d H:i:s');
					
					$data2['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);

					$this->db->insert('tbl_sms_delivery_details',$data2);
				}
			}
		}
	*/				
	if($dept_id=='all')	
	{
		$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
		$this->db->from('student s');
		$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.year',$running_year);
		$this->crud_model->check_student_status();
		$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
		$a=$this->db->get()->result_array();
		
		foreach($a as $b)
		{
			$data1['sms_master_id']	=	$master_id;
			$data1['student_id']	=	$b['student_id'];
			$data1['class_id']		=	$b['class'];
			$data1['section_id']	=	$b['section'];
			$data1['phone']			=	$b['phone1'];
			
			$data1['msg_content']	=	$this->sms_helper($common,$c,$n,$b['name'],$content);
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']		=  date('Y/m/d H:i:s');
			if($master_id>0 && $content!='')
			{
				$this->db->insert('tbl_sms_delivery_details',$data1);
				if($phone2==1)
				{
					if($b['phone2']!='')
					{
						$data1['phone'] =   $b['phone2'];    
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
			}	
		}
	}	
	else
	{		
		if($class=='All' || $class=='all')
		{
			
			$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.year',$running_year);
			$this->crud_model->check_student_status();
			$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('s.dept_id',$dept_id);
			$a=$this->db->get()->result_array();
			
			foreach($a as $b)
			{
				$data1['sms_master_id']	=$master_id;
				$data1['student_id']	=$b['student_id'];
				$data1['class_id']	=$b['class'];
				$data1['section_id']	=$b['section'];
				$data1['phone']	=$b['phone1'];
				
				$data1['msg_content']	=$this->sms_helper($common,$c,$n,$b['name'],$content);
				date_default_timezone_set("Asia/Kolkata");
				$data1['send_date']	=  date('Y/m/d H:i:s');
				if($master_id>0 && $content!='')
				{
					$this->db->insert('tbl_sms_delivery_details',$data1);
					if($phone2==1)
					{
						if($b['phone2']!='')
						{
							$data1['phone'] =   $b['phone2'];    
							$this->db->insert('tbl_sms_delivery_details',$data1);
						}
					}
				}
			}
		}
		else if($class!='All') 
		{
		
			$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.class_id',$class);
			$this->db->where('e.year',$running_year);
			$this->crud_model->check_student_status();
			//$this->db->where('e.section_id',$section);
			$a=$this->db->get()->result_array();
			foreach($a as $b)
			{
				$data1['sms_master_id']	=$master_id;
				$data1['student_id']	=$b['student_id'];
				$data1['class_id']	=$class;
				$data1['section_id']	=$b['section'];
				$data1['phone']	=$b['phone1'];
				date_default_timezone_set("Asia/Kolkata");
				$data1['send_date']	=  date('Y/m/d H:i:s');
				$data1['msg_content']	= $data1['msg_content']	=$this->sms_helper($common,$c,$n,$b['name'],$content);
				if($master_id>0 && $content!='')
				{
					$this->db->insert('tbl_sms_delivery_details',$data1);
					if($phone2==1)
					{
						if($b['phone2']!='')
						{
							$data1['phone'] =   $b['phone2'];    
							$this->db->insert('tbl_sms_delivery_details',$data1);
						}
					}
				}
	
			}
		}
	}	
	$data['master_id']	=	$master_id;	
	if($class!='All')
	{
	$data['class_id']	=	$class;
	}
	//$data['section_id']	=	$section;
	$this->load->view('admin/message_popup',$data);
	
	}

	function sms_without_name()
	{
		$running_year		=	get_running_year();
		$sms 				= 	$this->db->get('sms_settings')->row();
		$sender_id 			= 	$sms->sender_id;
		$username 			= 	$sms->username;
		$password 			= 	$sms->password;
		$common 			= 	$sms->common_word;
		$url 				= 	$sms->url;
		$web_url			=	$sms->web_url;

		$class 				= 	$this->input->post('class');
		$phone2				= 	$this->input->post('phone2');
		$dept_id			=	$this->input->post('dept_id');
		$content 			= 	$this->input->post('message_send');

		$user_id			= 	$this->session->userdata('login_user_id');
		$staff				=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=	$staff;
		$data['content']	=  	$content;
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d H:i:s');
		//$this->db->insert('tbl_sms_delivery_master',$data);
		//$master_id			=	$this->db->insert_id();
		
		
		$numbers		=	"";
		$i				=	1;
		$tot_ph_count	=	0;
		$msg_content		=	$common." ".$content;
		if($dept_id=='all')	
		{
			$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
			$this->db->from('student s');
			$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
			$this->db->where('e.year',$running_year);
			$this->crud_model->check_student_status();
			$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
			$a	=	$this->db->get()->result_array();
			foreach($a as $b)
			{
				if($i != count($a))
				{
					$numbers				=	$numbers.$b['phone1'].",";
					$tot_ph_count++;
					if($phone2==1 && $b['phone2']!='')
					{
						$numbers			=	$numbers.$b['phone2'].","; 
						$tot_ph_count++;
					}
				}
				else
				{
					$numbers				=	$numbers.$b['phone1'];
					$tot_ph_count++;
					if($phone2==1 && $b['phone2']!='')
					{
						$numbers			=	$numbers.",".$b['phone2']; 
						$tot_ph_count++;
					}
				}
				$i++;
			}
		}	
		else
		{		
			if($class=='All' || $class=='all')
			{
				
				$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section,e.class_id as class');
				$this->db->from('student s');
				$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
				$this->db->where('e.year',$running_year);
				$this->crud_model->check_student_status();
				$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('s.dept_id',$dept_id);
				$a=$this->db->get()->result_array();
				
				foreach($a as $b)
				{
					if($i != count($a))
					{
						$numbers				=	$numbers.$b['phone1'].",";
						$tot_ph_count++;
						if($phone2==1 && $b['phone2']!='')
						{
							$numbers			=	$numbers.$b['phone2'].","; 
							$tot_ph_count++;
						}
					}
					else
					{
						$numbers				=	$numbers.$b['phone1'];
						$tot_ph_count++;
						if($phone2==1 && $b['phone2']!='')
						{
							$numbers			=	$numbers.",".$b['phone2']; 
							$tot_ph_count++;
						}
					}
					$i++;
				}
			}
			else if($class!='All') 
			{
			
				$this->db->select('s.phone1,s.phone2,s.name,s.student_id,e.section_id as section');
				$this->db->from('student s');
				$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
				$this->db->where('e.class_id',$class);
				$this->db->where('e.year',$running_year);
				$this->crud_model->check_student_status();
				//$this->db->where('e.section_id',$section);
				$a=$this->db->get()->result_array();
				foreach($a as $b)
				{
					if($i != count($a))
					{
						$numbers				=	$numbers.$b['phone1'].",";
						$tot_ph_count++;
						if($phone2==1 && $b['phone2']!='')
						{
							$numbers			=	$numbers.$b['phone2'].","; 
							$tot_ph_count++;
						}
					}
					else
					{
						$numbers				=	$numbers.$b['phone1'];
						$tot_ph_count++;
						if($phone2==1 && $b['phone2']!='')
						{
							$numbers			=	$numbers.",".$b['phone2']; 
							$tot_ph_count++;
						}
					}
					$i++;
		
				}
			}
		}
		
		$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$numbers.'&msg=' . urlencode($msg_content) . '&route=T';
		$api = $url;
		$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
		$balance = stream_get_contents($handle);
		
		$letter_count	=	strlen($msg_content);
		$msg_count		=	ceil($letter_count/160);
		$tot_msg_count	=	$msg_count*$tot_ph_count;
		
		if ($balance >= $tot_msg_count) 
		{
			$api . "/sendsms?" . $location;
			$send = fopen($api . "/sendsms?" . $location, "r");
			$api . "/sendsms?" . $location;
		}	
		else
		{
			$this->session->set_flashdata('action','not_enough_balance');
		}
		redirect('admin/message');
	}




	function settings2() 
	{
	//$page_data['page_name'] = 'settings2';
	//$page_data['page_title'] = get_phrase('Send-News');
	$this->load->view('admin/settings2.php');
	}
	function settings2_login() 
	{
	$password=$this->input->post('password');
	
	if($password=='login2')
	{
	//$page_data['page_name'] = 'settings3';
	//$page_data['page_title'] = get_phrase('Send-News');
	$this->load->view('admin/advanced_settings');
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
	$this->load->view('admin/sms_settings.php',$data);
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
	$this->load->view('admin/sms_settings.php',$data);
	
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
	$this->load->view('admin/sms_settings.php',$data);
	
	}
	
	function reset_password($action="") 
	{
	$data['action']=$action;
	$this->load->view('admin/reset_password',$data);
	
	}
	
	function change_password()
	{
	$data['new_password'] = sha1($this->input->post('new_password'));
	$data['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));
	
		if ($data['new_password'] == $data['confirm_new_password']) 
		{
		
			$user=$this->session->userdata('login_user_id');
			$this->db->where('user_id', $user);
			$this->db->update('tbl_users', array('password' => $data['new_password']));
			$action="success";
		} 
		else 
		{
			$action="failed";
		}
		$this->reset_password($action);
		
	}
	function progress_report() 
	{
	
	$this->load->view('admin/progress_report');
	
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
	redirect(base_url() . 'index.php/admin/index' , 'refresh');
	}
	//////// 05-12-2017 //////////
	function add_branch() 
	{
	
	$this->load->view('admin/add_branch.php');
	
	}
	
	function add_department($branch_id) 
	{
	$data['branch_id']	=	$branch_id;
	$this->load->view('admin/add_department.php',$data);
	
	}
	
	function add_branch_users($branch) 
	{
	$data['branch_id']	=$branch;
	$this->load->view('admin/add_branch_users.php',$data);
	
	}
	
	
	
	
	function branch_add() 
	{
		$branch_name			=	$this->input->post('branch_name');
		$branch_address			=	$this->input->post('branch_address');
		$phone1					=	$this->input->post('phone1');
		$phone2					=	$this->input->post('phone2');
		$email					=	$this->input->post('email');
		$state					=	$this->input->post('state');
		$district				=	$this->input->post('district');
		
		$academic_year			=	get_running_year();
		$academic_year_id		=	get_running_year();
		$branch             	=  	$this->crud_model->branch_insert($branch_name,$branch_address,$phone1,$phone2,$email,$state,$district);
		$week_days          	=  	$this->crud_model->insert_week_days($branch,$academic_year);
		$class_timing       	=  	$this->crud_model->insert_class_timing($branch,$academic_year);
		
		
		$data['result']			=	$this->crud_model->get_tbl_voucher($branch,$academic_year);		//Check if data is present in tbl_voucher table for the newly created branch
		if(count($data['result'])==0)																//If data is not inserted,then insert voucher details to tbl_voucher.
		{
			$voucher_settings	=  	$this->crud_model->insert_tbl_voucher($branch,$academic_year_id);	
			if($voucher_settings>0)
				{
					
				}
				else
				{
					echo "Procedure execution failed";
				}
		}
		
		redirect('Admin/view_branch/'.$branch);
	//$this->load->view('admin/add_branch_users.php');
	
	}


	function department_add($branch_id) 
	{
	$dept_name		=		$this->input->post('department');
	
	$dept =  $this->crud_model->dept_insert($dept_name,$branch_id);
	
	redirect('Admin/view_department/'.$branch_id);
	//$this->load->view('admin/add_branch_users.php');
	
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
	redirect('Admin/add_branch_users/'.$branch_id);
	//$this->load->view('admin/add_branch_users.php');
	
	}
	
	
	function view_branch()
	{
	
	$this->load->view('admin/view_branch.php');
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
	$this->load->view('admin/view_department.php',$data);
	}
	
	function add_designation() 
	{
	
	$this->load->view('admin/add_designation.php');
	
	}
	
	function designation_add() 
	{
	$designation=$this->input->post('designation');
	$role=$this->input->post('role');
	$designation_insert =  $this->crud_model->designation_insert($designation,$role);
	if($designation_insert>0){
	$data1["action"]="success";
	}
	$this->load->view('admin/add_designation.php',$data1);
	
	}
	
	function view_designation()
	{
	
	
	$this->load->view('admin/view_designation.php');
	}
	
	function student_veiw($migrated='') 
	{
		if($migrated=='non_migrated')
		{
			redirect('admin/directly_added_students');
		}
	$running_year=get_running_year();
	if($this->session->userdata('role')==1 ||$this->session->userdata('role')==2)
	{
	$branch	=	$this->input->post('branch');
	$dept	=	$this->input->post('department');
	if($branch && $dept)
	{
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	
	}
	$this->db->where('academic_year',$running_year);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	
	if($this->session->userdata('role')==3 ||  $this->session->userdata('role')==52)
	{
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->input->post('department');
	if($dept)
	{
	
	$this->db->where('dept_id',$dept);
	
	}
	$this->db->where('academic_year',$running_year);
	$this->db->where('branch_id',$branch);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	
	if($this->session->userdata('role')>=4)
	{
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->session->userdata('dept_id');
	
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$this->db->where('academic_year',$running_year);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	$this->load->view('admin/student_view.php',$data);
	
	}
	
	
	function subjects_view() 
	{
	$running_year = get_running_year();
	if($this->session->userdata('role')==1 || $this->session->userdata('role')==2)
	{
	$branch	=	$this->input->post('branch');
	$dept	=	$this->input->post('department');
	if($branch && $dept)
	{
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	
	}
	$this->db->where('academic_year',$running_year);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	
	elseif($this->session->userdata('role')==3)
	{
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->input->post('department');
	
	if($dept)
	{
	
	$this->db->where('dept_id',$dept);
	
	}
	$this->db->where('academic_year',$running_year);
	$this->db->where('branch_id',$branch);
	$data['class']=$this->db->get('class')->result_array();
	}
	if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
	{
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->session->userdata('dept_id');
	
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$this->db->where('academic_year',$running_year);
	$data['class']=$this->db->get('class')->result_array();
	}
	
	$this->load->view('admin/subject_view.php',$data);
	
	}
	function branch_edit($branch_id='')
	{
	$data['branch_id']=$branch_id;
	//$data['branch']=$this->db->get_where('tbl_branch',array('branch_id'=>$branch_id))->result_array();
	$this->load->view('admin/branch_edit.php',$data);
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
            $yr =   get_running_year();
	//$branch_option=$this->input->post('department');
	$this->db->where('dept_id',$department);
	$this->db->where('academic_year',$yr);
	$dept = $this->db->get('class')->result_array();
	
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
	$this->load->view('admin/edit_department.php',$data);
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
		
		$this->load->view('admin/view_attendance_list_hourly1.php',$data);
	}
function expense_category()	
	{
		
		$this->load->view('admin/expense_category.php');
	}
	function view_expense_category()	
	{
		
		$this->load->view('admin/view_expense_category.php');
	}
	function expense_category_add()	
	{
		$category_name	=	$this->input->post('category');
		$data['category_name']	=	$category_name;
		//$data['branch_id']		=$this->session->userdata('branch_id');
		
		$this->db->insert('tbl_expence_category',$data);
		
		$this->load->view('admin/view_expense_category.php');
	}
	
	function add_expense()	
	{
		$this->load->view('admin/add_expense.php');
	}
	function expense_add()	
	{
		$data['category_id']	=	$this->input->post('category1');
		$data['amount']			=	$this->input->post('amount');
		
		$data['expense_date']	=	date("Y-m-d", strtotime($this->input->post ('expense_date')));
		$data['give_to']		=	$this->input->post('give_to');
		$data['remark']			=	$this->input->post('remark');
		$data['created_by']		=	$this->session->userdata('login_user_id');
	    $data['created_date']	=	date('Y/m/d');
		if($this->session->userdata('role')==2)
		{
		$data['branch_id']		= $this->input->post('branch_id');
		}
		else
		{
		$data['branch_id']		=	$this->session->userdata('branch_id');
		}
		if($this->session->userdata('role')==3)
		{
		$data['dept_id']		=	$this->input->post('dept_id');
		}
		if($this->session->userdata('role')==4)
		{
		$data['dept_id']		=	$this->session->userdata('dept_id');
		}
		$this->db->insert('tbl_add_expense',$data);
		$id=$this->db->insert_id();
		move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/expense/' . $id . '.jpg');
		
		redirect('Admin/view_expense');
	}
	function view_expense()	
	{
		if($this->input->post())
		{
			$category=$this->input->post('category');
			$data['cat']=$category;
			$from_date1=$this->input->post ('from_date');
			$to_date1=$this->input->post ('to_date');
			
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($data['cat']=='')
			{
				$data['cat']	=	0;
			}
			if($data['from_date']=='')
			{
				$data['from_date']	=	0;
			}
			if($data['to_date']=='')
			{
				$data['to_date']	=	0;
			}
			
			$data['category_exp']=$this->crud_model->expence_view($category,$from_date1,$to_date1);
			
		}
		else
		{
			$data['cat']=0;
			$data['from_date']=0;
			$data['to_date']=0;
			$data['category_exp']=$this->crud_model->expence_view('','','');
	   }
		
		$this->load->view('admin/view_expense.php',$data);
	}
		
	function expense_category_edit($category_id)
	{
	   
	   $this->db->select('category_id,category_name');
	   $this->db->from('tbl_expence_category');
	   $this->db->where('category_id',$category_id);
	   $data['category']=$this->db->get()->result_array();
	   $this->load->view('admin/expense_category_edit.php',$data);
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
	   $this->load->view('admin/expense_edit.php',$data);
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

function get_count($message='')	
	{
	
		$data['message']	=$message;
		$this->load->view('admin/msg_count.php',$data);
		
	}
	
	function check_user($user_name)	
	{
		$data['user_name']	=$user_name;
		$this->load->view('admin/check_user_name.php',$data);
		
	}
	
	
	function teacher_attendance()
	{
	

		$this->load->view('admin/teacher_attendance');
	}
	public function teacher_manage_attendance($timestamp)
	{
		$data['timestamp'] = $timestamp;
		$this->load->view('admin/teacher_manage_attendance.php',$data);
	}
	function study_materials_view() 
	{    
		$this->load->view('admin/study_materials_view');
	}
	
	function teacher_attendance_selector()
	{

		$data['year']       = $this->input->post('year');
		$a=$this->input->post('timestamp');
		$b  = str_replace('/','-',$a);
		$data['timestamp']=strtotime($b);
		$query = $this->db->get_where('teacher_attendance' ,array(
		'year'=>$data['year'],
		'timestamp'=>$data['timestamp']));
		if($query->num_rows() < 1) 
		{
			$teacher = $this->db->get_where('staff' , array(
			'role' => '5',
			'role' => '6',
			'branch_id' => $this->session->userdata('branch_id'),
			'dept_id' => $this->session->userdata('dept_id')
			
			))->result_array();
			foreach($teacher as $row) 
			{
				//$attn_data['class_id']   = $row['class_id'];
				$attn_data['year']       = $data['year'];
				$attn_data['timestamp']  = $data['timestamp'];
				//$attn_data['section_id'] = $row['section_id'];
				$attn_data['staff_id'] = $row['staff_id'];
				$this->db->insert('teacher_attendance' , $attn_data);  
			}
		}
		redirect(base_url().'index.php/admin/teacher_manage_attendance/'.$data['timestamp'],'refresh');
	}
	function teacher_attendance_update($timestamp = '')
	{
		$date=$this->input->post('timestamp1');
		//$message1['message']=$this->input->post('message');
		$running_year = get_running_year();
		$attendance_of_students = $this->db->get_where('teacher_attendance' , array(
		'year'=>$running_year,'timestamp'=>$timestamp))->result_array();
		
		
		
		
		
		foreach($attendance_of_students as $row) 
		{
			
			$attendance_status = $this->input->post('status_'.$row['attendance_id']);
			
			$this->db->where('attendance_id' , $row['attendance_id']);
			$result= $this->db->update('teacher_attendance' , array('status' => $attendance_status));
		}
		redirect('Admin/teacher_attendance');
		
	}
	public function teacher_attendance_report()
	{
		$data['month']        = date('m');
		$this->load->view('admin/teacher_attendance_report.php',$data);
	}
	
	function teacher_attendance_report_selector()
	{
		
		$data['year1']       = $this->input->post('year1');
		$data['month'] 	    = $this->input->post('month');
		
		redirect(base_url().'index.php/admin/teacher_report_attendance_view/'.$data['month'].'/'.$data['year1'],'refresh');
	}
	function teacher_report_attendance_view($month = '',$year1='') 
	{
		
		$data['month']    	= $month;
		
		$data['year1'] = $year1;
		$this->load->view('admin/teacher_report_attendance_view.php',$data);
	}
	function teacher_attendance_print($month,$year1) 
	{
		
		$page_data['month'] =$month;
		$page_data['year1'] =$year1;
		$this->load->view('admin/teacher_attendance_print' , $page_data);
	}
	
	 function check_phone_number($phone)	
	{
		$data['phone']	=$phone;
		$this->load->view('admin/check_phone_number.php',$data);
		
	}
	
	function sms_send_popup_malayalam($master_id)
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
	
	$api . "/sendunicodesms?" . $location;
	$send = fopen($api . "/sendunicodesms?" . $location, "r");
	$api . "/sendunicodesms?" . $location;
	
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
	
	
	
	 redirect(base_url() . 'index.php/admin/message' , 'refresh');
	
	
	
	
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
	
	 function sms_helper1($common_word,$c,$content)
	{
		if($c==1)
		$message = $common_word. ' ' .$content.'.';  
		if($c==0)
		$message = $content.' '.$common_word. ' .'; 
		
		
		return $message; 
		
		
	}
	
	function help() 
	{
		
		
		$this->load->view('admin/help.php');
	}
	
function set_academic_year() 
	{
		
		
		$this->load->view('admin/add_academic_year.php');
	}
	function add_academic_year() 
	{
	 $academic_year=$this->input->post('name');
	  $branch_id=$this->input->post('branch');
	
	 $start_date=$this->input->post('start_date');
	 $start_date1= date("Y-m-d",strtotime($start_date));
	
	
	$end_date=$this->input->post('end_date');
	 $end_date1= date("Y-m-d",strtotime($end_date));
	 
	 
	 $data['academic_year']	=	 $academic_year; 
	 $data['start_date']	=	 $start_date1;
	 $data['end_date']		=	 $end_date1;
	 $data['created_by']		=	 1;
	  $data['created_date']		=	 date('Y-m-d');
	  $data['branch_id']		=	 $branch_id;
	 
	
		$this->db->insert('tbl_academic_year',$data);
		$ac_year_id	=	$this->db->insert_id();
		$result		=	$this->crud_model->insert_tbl_voucher($branch_id,$ac_year_id);
		redirect('Admin/set_academic_year');
	}

function inactive_student($student_id,$class_id)
	{
	
	$data['class_id']=$class_id;
	$this->crud_model->student_inactive($student_id);
	redirect(base_url() . 'index.php/admin/students_area/'.$data['class_id']);
	
	}	


function get_class_students1($year,$branch,$dept)
	{
	//$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$class  = $this->db->get_where('class' , array('branch_id' => $branch,'dept_id' => $dept,
'academic_year' => $year ))->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($class as $row) 
		{
			echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
		}
	}
	

function deleted_students()
	{
	$running_year=get_running_year();
	$this->db->select('s.student_id as student_id,s.name as student,e.class_id,c.class_id,c.name as class,e.section_id,t.name as section,s.phone1');

	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->join('class c','c.class_id=e.class_id','LEFT');
	$this->db->join('section  t ','e.section_id=t.section_id','LEFT');
	$this->db->where('s.student_status_id','1');
	$this->db->where('e.year',$running_year);
	$data['deleted_students']=$this->db->get('student s')->result_array();
	$this->load->view('admin/deleted_students.php',$data);
	}
	
	function restore_students($student_id)
	{
		$data['student_status_id']='0';
		$this->db->where('student_id',$student_id);
		$this->db->update('student',$data);
		redirect('Admin/deleted_students');
	
	}
	
	function inactive_students()
	{
	$running_year=get_running_year();
	$this->db->select('s.student_id as student_id,s.name as student,e.class_id,c.class_id,c.name as class,e.section_id,t.name as section,s.phone1');
	$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
	$this->db->join('class c','c.class_id=e.class_id','LEFT');
	$this->db->join('section  t ','e.section_id=t.section_id','LEFT');
	$this->db->where('s.student_status_id','2');
	$this->db->where('e.year',$running_year);
	$data['deleted_students']=$this->db->get('student s')->result_array();
	$this->load->view('admin/inactive_students.php',$data);
	}
	
	function restore_inactive_students($student_id)
	{
		$data['student_status_id']='0';
		$this->db->where('student_id',$student_id);
		$this->db->update('student',$data);
		redirect('Admin/inactive_students');
	
	}
	
	function view_acdemic_year()
	{
	 $this->db->where('is_deleted','N');
	 $data['year']	=	$this->db->get('tbl_academic_year')->result_array();
	
	$this->load->view('admin/view_acdemic_year.php',$data);
	}
	
	function edit_academic_year($academic_year_id='') 
	{
		$this->db->where('acdemic_year_id',$academic_year_id);
	    $data['year']	=	$this->db->get('tbl_academic_year')->result_array();
		$this->load->view('admin/edit_academic_year.php',$data);
	}
	
	
	function update_academic_year($academic_year_id='') 
	{
	 $academic_year=$this->input->post('name');
	  $branch_id=$this->input->post('branch');
	
	 $start_date=$this->input->post('start_date');
	 $start_date1= date("Y-m-d",strtotime($start_date));
	
	
	$end_date=$this->input->post('end_date');
	 $end_date1= date("Y-m-d",strtotime($end_date));
	 
	 
	 $data['academic_year']	=	 $academic_year; 
	 $data['start_date']	=	 $start_date1;
	 $data['end_date']		=	 $end_date1;
	 $data['created_by']		=	 1;
	  $data['created_date']		=	 date('Y-m-d');
	  $data['branch_id']		=	 $branch_id;
	 
	    $this->db->where('acdemic_year_id',$academic_year_id);
		$this->db->update('tbl_academic_year',$data);
		
		redirect('Admin/view_acdemic_year');
	}
	
	function delete_academic_year($academic_year_id='') 
	{
	 
	  
	  $data['is_deleted']		=	 'Y';
	  $data['deleted_by']		=	 $this->session->userdata('login_user_id');
	  $data['deleted_date']		=	 date('Y-m-d');
	 
	    $this->db->where('acdemic_year_id',$academic_year_id);
		$this->db->update('tbl_academic_year',$data);
		
		redirect('Admin/view_acdemic_year');
	}

    function inactive_student_view()
	{
	$running_year=get_running_year();
	if($this->session->userdata('role')==1 ||$this->session->userdata('role')==2)
	{
	$branch	=	$this->input->post('branch');
	$dept	=	$this->input->post('department');
	if($branch && $dept)
	{
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	
	}
	$this->db->where('academic_year',$running_year);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	
	if($this->session->userdata('role')==3 )
	{
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->input->post('department');
	if($dept)
	{
	
	$this->db->where('dept_id',$dept);
	
	}
	$this->db->where('academic_year',$running_year);
	$this->db->where('branch_id',$branch);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	
	if($this->session->userdata('role')==4 )
	{
	$branch	=	$this->session->userdata('branch_id');
	$dept	=	$this->session->userdata('dept_id');
	
	$this->db->where('branch_id',$branch);
	$this->db->where('dept_id',$dept);
	$this->db->where('academic_year',$running_year);
	$data['class']=$this->db->get('class')->result_array();
	
	}
	$this->load->view('admin/inactive_student_view.php',$data);
	}
	
	function inactive_students_area($class_id='',$action='')
	{
	    $data['action']=$action;
	    $running_year=get_running_year();
	    $this->db->join('enroll e','e.student_id=s.student_id','LEFT');
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.year',$running_year);
		 $this->db->where('s.student_status_id!=',0);
		 $data['class_id']=$class_id;
		$data['students']=$this->db->get('student s')->result_array();
	    $this->load->view('admin/inactive_students_area.php',$data);
	}
	
	function activate_student($student_id='',$class_id='')
	{
	   $data['student_status_id']=0;
	   $this->db->where('student_id',$student_id);
	   $this->db->update('student',$data); 
	   if($this->db->affected_rows()>0)
	   {
	     $action="success";
	   }
	   $this->inactive_students_area($class_id,$action);
	}
	
	
	function check_admission_no($adm_no)
	{
	$this->db->where('admission_number',$adm_no);
	$this->db->where('admission_number!=',0);
	$admission_no=$this->db->get('student');
	
	if($admission_no->num_rows()==0)
	{
	    echo "0";
	}
	else
	{
        echo "1";
	}
	}
	
	function subject_bulk() 
	{
	
	$this->load->view('admin/subject_bulk.php');
	}
	
	function add_subject_bulk()
	{
	$subject_name              = $this->input->post('subject_name');
	if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
	{
	$branch	=$this->session->userdata('branch_id');
	$dept	=$this->session->userdata('dept_id');
	}
	else if($this->session->userdata('role')==3)
	{
	$branch	=$this->session->userdata('branch_id');
	$dept    = $this->input->post('department');
	}
	else
	{
	$branch    = $this->input->post('branch');
	$dept    = $this->input->post('department');
	}
	$class_id    = $this->input->post('class_id');
	$subject_count = sizeof($subject_name);
	for($i = 0; $i < $subject_count; $i++)
	{
	$data['year']       = get_running_year();
	$data['class_id']=$class_id;
	$data['name']     =   $subject_name[$i];
	$result=$this->crud_model->subject_add($data);
	}
	if($result>0){
	$page_data['action']="success";
	}
	$this->load->view('admin/subject_bulk.php',$page_data);
	}
	
	function expense_bulk() 
	{
	
	$this->load->view('admin/expense_bulk.php');
	}
	
function add_expense_bulk()
	{
	
	    if($this->session->userdata('role')==3)
		{
		$dept_id		=	$this->input->post('dept_id');
		}
		if($this->session->userdata('role')==4)
		{
		$dept_id		=	$this->session->userdata('dept_id');
		}
	    $category_id	=	$this->input->post('category1');
		$amount			=	$this->input->post('amount');
		$give_to		=	$this->input->post('give_to');
		$remark         =	$this->input->post('remark');
		$expense_date	=	date("Y-m-d", strtotime($this->input->post ('expense_date')));
		
		$expense_count  = sizeof($amount);
		for($i = 0; $i < $expense_count; $i++)
		{
		$data['give_to']		=	$this->input->post('give_to');
		$data['remark']			=	$this->input->post('remark');
		$data['created_by']		=	$this->session->userdata('login_user_id');
		$data['created_date']	=	date('Y/m/d');
		$data['expense_date']   =   $expense_date;
		if($this->session->userdata('role') > 2)
		{
		$data['branch_id']		=	$this->session->userdata('branch_id');
		}
		if($this->session->userdata('role') > 3)
		{
		$data['dept_id']        =   $dept_id;
		}
		$data['category_id']    =   $category_id[$i];
		$data['amount']         =   $amount[$i];
		$data['give_to']        =   $give_to[$i];
		$data['remark']         =   $remark[$i];
		$this->db->insert('tbl_add_expense',$data);
		}
		if($this->db->insert_id()>0){
		$page_data['action']="success";
		$action="success";
		$this->session->set_flashdata('action',$action);
		}
		redirect('Admin/expense_bulk');
		//$this->load->view('admin/expense_bulk.php',$page_data);
	}
	
	
	function class_bulk() 
	{
	$this->load->view('admin/class_bulk.php');
	}
	
	function add_class_bulk()
	{
	
	    $running_year = get_running_year();
		$role=$this->session->userdata('role');  
		if($role==1|| $role==2)
		{
		$branch_id	=	$this->input->post('branch');
		$dept_id	=	$this->input->post('department');
		}
		else if($role==3)
		{
		$branch_id	=	$this->session->userdata('branch_id'); 
		$dept_id	=	$this->input->post('department');
		}
		else if($role==4 || $role==12)
		{
		$branch_id	=	$this->session->userdata('branch_id'); 
		$dept_id	=	$this->session->userdata('dept_id'); 
		}
		$name         = $this->input->post('class');
		$count_class  = sizeof($name);
		for($i = 0; $i < $count_class; $i++)
		{
		$data['name']		      =	$name[$i];
		$data['academic_year']    = $running_year;
		$data['branch_id']        = $branch_id;
		$data['dept_id']          = $dept_id;
		$class_id =$this->crud_model->class_insert($data);
		$data2['class_id']  =   $class_id;
		$data2['name']      =   'A';
		$data2['academic_year']         = $running_year;
		$result=$this->crud_model->manage_classes($data2);
		}
		if($result>0){
		$page_data['action']="success";
		}
		$this->load->view('admin/class_bulk.php',$page_data);
	}
	
	function upload_student_document($student_id='')
	{
	$document=$_FILES['userfile']['name'];
	$data=array(
	'student_id'  => $student_id,
	'title'  => $this->input->post('title'),
	'document_name'  => $document,
	'uploaded_date'=> date('Y-m-d'),
	'uploaded_by'=> $this->session->userdata('login_user_id')
	);
	$this->db->insert('tbl_student_documents',$data);
	$document_id=$this->db->insert_id();
	
	 move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_documents/'.$document_id.'.jpg');
     redirect(base_url() . 'index.php/admin/student_portal/'.$student_id ,'refresh');
	}
	
	function delete_student_document($document_id='',$student_id='')
	{
	   $this->db->where('document_id',$document_id);
	   $this->db->update('tbl_student_documents',array('is_deleted'=>'Y')); 
	   unlink( "uploads/student_documents/".$document_id.".jpg" );
	   redirect(base_url() . 'index.php/admin/student_portal/'.$student_id ,'refresh');
	}
	
	function student_password_update($student_id)
	{
	    $data['new_password'] = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            if ($data['new_password'] == $data['confirm_new_password']) 
            {
                $this->db->where('student_id', $student_id);
				$user=$this->db->get('student')->row()->user_id;
				
				$this->db->where('user_id', $user);
                $this->db->update('tbl_users', array('password' => sha1($data['new_password'])));
				
				$this->db->where('student_id', $student_id);
				$this->db->update('student', array('password' => $data['new_password']));
            } 
			elseif ($data['new_password'] != $data['confirm_new_password']) 
            {
                ?><script>
				alert("Password didn't match");
				</script><?php
            } 
	    redirect(base_url() . 'index.php/admin/student_portal/'.$student_id ,'refresh');
	}
	
	function student_username_update($student_id)
	{
	    $username = $this->input->post('username');
		
		$this->db->where('username',$username); 
		$count_user=$this->db->get('tbl_users');
		if($count_user->num_rows()>0){?>
		<script> alert("Username Already Exist"); </script>
		<?php }
		
		else {
		$this->db->where('student_id', $student_id);
		$user=$this->db->get('student')->row()->user_id;
		
		$this->db->where('user_id', $user);
		$this->db->update('tbl_users', array('username' => $username) );
		
		$this->db->where('student_id', $student_id);
		$this->db->update('student', array('username' => $username) );
		}
            
	    redirect(base_url() . 'index.php/admin/student_portal/'.$student_id ,'refresh');
	}
	
	public function student_add_enq($enquiry_id='')
	{
		$data['enquiry']= $enquiry_id;
		$this->load->view('admin/add_student_enq.php',$data);
	}
	
	function apk_view()
	{
	 $this->db->where('is_deleted','N');
	 $data['apk']=$this->db->get('tbl_apk_file')->result_array();
	 $this->load->view('admin/apk_view.php',$data); 
	}
	
	function delete_apk($id='')
	{
	$data['is_deleted']='Y';
	$this->db->where('id',$id);
	$this->db->update('tbl_apk_file',$data);
	unlink('uploads/apk/'.$id.'.apk');
	redirect(base_url() . 'index.php/admin/apk_view/','refresh');
	}
	
	function view_student_group()
	{
		$data['group']	=	$this->crud_model->get_group();	
		$this->load->view('admin/student_group_view',$data);
	}
	function add_student_group()
	{
		$role	=	$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']	=	$this->crud_model->get_branch();
			$this->load->view('admin/student_group_add',$data);
		}
		if($role==3)
		{
			$branch_id				=	$this->session->userdata('branch_id');
			$data['dept']			=	$this->Fee_management_model->get_department($branch_id);
			$this->load->view('admin/student_group_add',$data);
		}
		if($role==4 || $role==12)
		{
			$this->load->view('admin/student_group_add');
		}
	}
	function insert_student_group()
	{
		$data['branch_id']					=	$this->input->post('branch_id');
		$data['department_id']				=	$this->input->post('department_id');
		$data['academic_year_id']			=	get_running_year();
		$data['group_for']					=	$this->input->post('group_for');
		$data['students_group_master_name']	=	$this->input->post('group_name');
		$data['notes']						=	$this->input->post('notes');
		$affected_rows						=	$this->crud_model->insert_student_group($data);
		if($affected_rows>0)
		{
			$action	=	"inserted";
		}
		else
		{
			$action =	"not_inserted";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Admin/view_student_group');
	}
	
	
	function edit_student_group($students_group_master_id='')
	{
		$data['single_student_group']	=	$this->crud_model->get_single_student_group($students_group_master_id);
		$role							=	$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']	=	$this->crud_model->get_branch();
		}
		else
		{
		}
		$this->load->view('admin/student_group_edit',$data);
	}	
	function update_student_group()
	{
		$data['students_group_master_id']	=	$this->input->post('students_group_master_id');
		$data['group_for']					=	$this->input->post('group_for');
		$data['students_group_master_name']	=	$this->input->post('group_name');
		$data['notes']						=	$this->input->post('notes');
		$affected_rows						=	$this->crud_model->update_student_group($data);
		if($affected_rows>0)
		{
			$action	=	"updated";
		}
		else
		{
			$action =	"not_updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Admin/view_student_group');
	}
	function delete_student_group($students_group_master_id='')
	{
		$data['students_group_master_id']	=	$students_group_master_id;
		$data['is_deleted']					=	'Y';
		$affected_rows						=	$this->crud_model->update_student_group($data);
		if($affected_rows>0)
		{
			$action	=	"deleted";
		}
		else
		{
			$action =	"not_deleted";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Admin/view_student_group');
	}
	function get_staffs($branch_id='',$department_id='',$add_remove='',$students_group_master_id='')
	{
		$data['branch_id']					=	$branch_id; 
		$data['department_id']				=	$department_id; 
		$data['add_remove']					=	$add_remove; 
		$data['staffs']						=	$this->crud_model->get_staffs($branch_id,$department_id,$add_remove,$students_group_master_id);
		$this->load->view('admin/group_list_staff.php',$data);
	}
	function check_staff_assigned($academic_year_id='',$branch_id='',$students_group_master_id='',$staff_id='')
	{	
		$data		=	array(
							'academic_year_id'			=>	$academic_year_id,
							'branch_id'					=>	$branch_id,
							'students_group_master_id'	=>	$students_group_master_id,
							'staff_id'					=>	$staff_id
							);
		$query		=	$this->crud_model->check_staff_assigned($data);
		if(count($query)>0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	function add_students_to_group($students_group_master_id='',$department_id='',$branch_id='',$group_for='')
	{
		$data['students_group_master_id']	=	$students_group_master_id;
		$data['group_for']					=	$group_for;
		$data['department_id']				=	$department_id;
		$data['branch_id']					=	$branch_id;
		$data['classes']					=	$this->crud_model->get_class1($data);
		$this->load->view('admin/student_group_add_students.php',$data);
	}
	function student_group_students($class_id='',$section_id='',$branch_id='',$add_remove='',$students_group_master_id='')
	{ 
		$data['students']					=	$this->crud_model->student_group_students($class_id,$section_id,$students_group_master_id,$add_remove);
		$data['class_id']					=	$class_id;
		$data['section_id']					=	$section_id;
		$data['branch_id']					=	$branch_id; 
		$data['add_remove']					=	$add_remove; 
		$data['student_groups']				= 	$this->crud_model->get_student_groups($branch_id);
		$this->load->view('admin/student_group_add_students1.php',$data);
	}
	function add_remove_students_to_group()
	{
		$branch_id							=	$this->input->post('branch_id');
		$department_id						=	$this->input->post('department_id');
		$academic_year_id					=	$this->input->post('academic_year_id');
		$students_group_master_id			=	$this->input->post('students_group_master_id');
		$group_for							=	$this->input->post('group_for');
		$add_remove							=	$this->input->post('btnSubmit');
		if($group_for=="students")
		{
			$student_id						=	$this->input->post('student_id[]');
		}
		else
		{
			$student_id						=	$this->input->post('staff_id[]');
		}
		$checkbox							=	$this->input->post('single_student[]');
		$notes								=	$this->input->post('notes[]');
		
		$ticked_count						=	count($checkbox);
		for($i=0;$i < $ticked_count;$i++)
		{
			$checked_row_num				=	$checkbox[$i]-1;	//$checked_row_num will have the position number of checked row.That is $i'th element is checked.
			if($group_for=="students")
			{
			$data							=	array(
													'students_group_master_id'	=>	$students_group_master_id,	
													'student_id'				=>	$student_id[$checked_row_num],	
													'notes'						=>	$notes[$checked_row_num],	
													'branch_id'					=>	$branch_id,	
													'academic_year_id'			=>	$academic_year_id,	
													);
			}
			else
			{
			$data							=	array(
													'students_group_master_id'	=>	$students_group_master_id,	
													'staff_id'					=>	$student_id[$checked_row_num],	
													'notes'						=>	$notes[$checked_row_num],	
													'branch_id'					=>	$branch_id,	
													'academic_year_id'			=>	$academic_year_id,	
													);
			}										
			$affected_rows					=	$this->crud_model->add_remove_students_to_group($data,$add_remove,$group_for);
		}
		if($affected_rows>0)
		{
			if($add_remove=='Add'):
				$action	=	"added";
			elseif($add_remove=='Remove'):
				$action	=	"removed";
			endif;
		}
		else
		{
			if($add_remove=='Add'):
				$action	=	"not_added";
			elseif($add_remove=='Remove'):
				$action	=	"not_removed";
			endif;
		}
		$this->session->set_flashdata('action',$action);
		redirect('Admin/add_students_to_group/'.$students_group_master_id.'/'.$department_id.'/'.$branch_id.'/'.$group_for);
	}

	function check_assigned($academic_year_id='',$branch_id='',$students_group_master_id='',$student_id='')
	{	
		$data		=	array(
							'academic_year_id'			=>	$academic_year_id,
							'branch_id'					=>	$branch_id,
							'students_group_master_id'	=>	$students_group_master_id,
							'student_id'				=>	$student_id
							);
		$query		=	$this->crud_model->check_assigned($data);
		if(count($query)>0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	
	function student_group_message($students_group_master_id='',$group_for='')
	{
		$data['students_group_master_id']	=	$students_group_master_id;
		$data['group_for']					=	$group_for;
		$this->load->view('admin/student_group_send_message',$data);
	}
	function send_message_to_staff_group()
	{
		$students_group_master_id			=	$this->input->post('students_group_master_id');
		$staffs								=	$this->crud_model->get_staff_group_details($students_group_master_id);
		
		$running_year						=	get_running_year();
		$sms 								= 	$this->db->get('sms_settings')->row();
		$sender_id 							= 	$sms->sender_id;
		$username 							= 	$sms->username;
		$password 							= 	$sms->password;
		$common 							= 	$sms->common_word;
		$url 								= 	$sms->url;
		$web_url							=	$sms->web_url;
		
		$ph='';
		$ph2='';
		$content 							= 	"Staff Group message";
		$user_id							= 	$this->session->userdata('login_user_id');
		$staff								=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']					=	$staff;
		$data['content']					=  	$content;
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']					=  	date('Y/m/d H:i:s');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id							=	$this->db->insert_id();
		
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
	
		
		foreach($staffs as $staffs1):
			$data1['sms_master_id']			=	$master_id;
			$data1['student_id']			=	$staffs1['staff_id'];
			$data1['phone']					=	$this->db->get_where('staff',array('staff_id'=>$staffs1['staff_id']))->row()->phone;
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
			$content						=	$this->input->post('message_content');
			$data1['msg_content']			= 	$this->sms_helper($common,$c,$n,$this->db->get_where('staff',array('staff_id'=>$staffs1['staff_id']))->row()->name,$content);
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']				=  	date('Y/m/d H:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data1);
		endforeach;
		
		$data['master_id']					=	$master_id;	
		//$data['class_id']					=	$class;
		//$data['section_id']					=	$section;
		$this->load->view('admin/staff_group_message_popup',$data);
	}
	function view_staff_group_members($students_group_master_id='',$department_id='',$branch_id='')
	{
		$data['students_group_master_id']		=	$students_group_master_id;
		$data['department_id']					=	$department_id;
		$data['branch_id']						=	$branch_id;
		$data['academic_year_id']				=	get_running_year();
		$data['members']						=	$this->crud_model->get_staff_group_details1($data);//echo $this->db->last_query();die();
		//$data['class']							=	$this->Fee_management_model->get_class_by_branch($data['branch_id'],$data['department_id'],$data['academic_year_id']);
		$this->load->view('admin/staff_group_view_members',$data);
	}

	function send_message_to_student_group()
	{
		$students_group_master_id			=	$this->input->post('students_group_master_id');
		$students							=	$this->crud_model->get_students_group_details($students_group_master_id);
		
		$running_year						=	get_running_year();
		$sms 								= 	$this->db->get('sms_settings')->row();
		$sender_id 							= 	$sms->sender_id;
		$username 							= 	$sms->username;
		$password 							= 	$sms->password;
		$common 							= 	$sms->common_word;
		$url 								= 	$sms->url;
		$web_url							=	$sms->web_url;
		
		$ph='';
		$ph2='';
		$content 							= 	"Group message";
		$user_id							= 	$this->session->userdata('login_user_id');
		$staff								=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']					=	$staff;
		$data['content']					=  	$content;
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']					=  	date('Y/m/d H:i:s');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id							=	$this->db->insert_id();
		
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
	
		
		foreach($students as $student):
			$data1['sms_master_id']			=	$master_id;
			$data1['student_id']			=	$student['student_id'];
			$data1['class_id']				=	get_student_class_id($student['student_id']);
			$data1['section_id']			=	get_student_section_id($student['student_id']);
			$data1['phone']					=	get_student_phone($student['student_id']);
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
			$content						=	$this->input->post('message_content');
			$data1['msg_content']			= 	$this->sms_helper($common,$c,$n,get_student_name($student['student_id']),$content);
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']				=  	date('Y/m/d H:i:s');
			if($master_id>0 && $content!='')
			{
				$this->db->insert('tbl_sms_delivery_details',$data1);
			}
		endforeach;
		
		$data['master_id']					=	$master_id;	
		//$data['class_id']					=	$class;
		//$data['section_id']					=	$section;
		$this->load->view('admin/student_group_message_popup',$data);
	}
	function sms_send_popup_fee($master_id)
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
		redirect('Admin/view_student_group');
	}
	/* function get_student_group_by_branch($branch_id='')
	{
		$result		=	$this->crud_model->get_student_groups($branch_id);
		echo "<option value=''>Select</option>";
		foreach($result as $row)
		{
			echo "<option value='".$row['students_group_master_id']."'>".$row['students_group_master_name']."</option>";
		}
	}*/
	function get_student_group_by_dept($dept_id='')
	{
		$result		=	$this->crud_model->get_student_group_by_dept($dept_id);
		echo "<option value=''>Select</option>";
		foreach($result as $row)
		{
			echo "<option value='".$row['students_group_master_id']."'>".$row['students_group_master_name']."</option>";
		}
	}
	function view_student_group_members($students_group_master_id='',$department_id='',$branch_id='')
	{
		$data['students_group_master_id']		=	$students_group_master_id;
		$data['department_id']					=	$department_id;
		$data['branch_id']						=	$branch_id;
		$data['academic_year_id']				=	get_running_year();
		$data['members']						=	$this->crud_model->get_student_group_details($data);//echo $this->db->last_query();die();
		//$data['class']							=	$this->Fee_management_model->get_class_by_branch($data['branch_id'],$data['department_id'],$data['academic_year_id']);
		$this->load->view('admin/student_group_view_members',$data);
	}
	function group_note_update($para1="")
	{ 
		$students_group_details_id				=	$this->input->post('students_group_details_id');
		$data['notes']							=	$this->input->post('notes1');	
		$this->db->where('students_group_details_id',$students_group_details_id);
		$this->db->update('tbl_students_group_details',$data);
		
		$students_group_master_id				=	$this->input->post('students_group_master_id1');
		$branch_id								=	$this->input->post('branch_id1');
		$department_id							=	$this->input->post('dept_id1');
		if($para1=="staff")
		{
			redirect('admin/view_staff_group_members/'.$students_group_master_id.'/'.$department_id.'/'.$branch_id);
		}
		redirect('admin/view_student_group_members/'.$students_group_master_id.'/'.$department_id.'/'.$branch_id);
	}
	function check_members_exist($students_group_master_id='')
	{ 
		$count	=	$this->crud_model->check_members_exist($students_group_master_id);
		if($count>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	function view_student_group_members1($students_group_master_id='',$department_id='',$branch_id='',$add_remove='')
	{
		$data['students_group_master_id']		=	$students_group_master_id;
		$data['department_id']					=	$department_id;
		$data['branch_id']						=	$branch_id;
		$data['add_remove']						=	$add_remove;
		$data['academic_year_id']				=	get_running_year();
		$data['members']						=	$this->crud_model->get_student_group_details($data);
		$this->load->view('admin/student_group_view_members1',$data);
	}

/******* Entrance test start*****************/	

	function view_entrance_test()
	{
	    $running_year = get_running_year();
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$branch		=		$this->input->post('branch');
			$dept		=		$this->input->post('department');
			if($branch && $dept)
			{
				$this->db->where('branch_id',$branch);
				$this->db->where('dept_id',$dept);
			}
			$this->db->where('is_deleted','N');
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('tbl_entrance_test')->result_array();
		}
		if($role==3)
		{
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->input->post('department');
			if($dept)
			{
				$this->db->where('dept_id',$dept);
			}
			$this->db->where('is_deleted','N');
			$this->db->where('branch_id',$branch);
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('tbl_entrance_test')->result_array();
		}
		if($role==4|| $role==12)
		{
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->session->userdata('dept_id');
			$this->db->where('branch_id',$branch);
			$this->db->where('dept_id',$dept);
			$this->db->where('is_deleted','N');
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('tbl_entrance_test')->result_array();
		} 
		$this->load->view('admin/view_entrance_test',$page_data);
	}
	
	function create_entrance_test($param1 = '',$param2='')
	{
		
		if ($param1 == 'delete') 
		{
			$data['is_deleted']   = "Y";
			$this->db->where('exam_id', $param2);
			$this->db->update('exam', $data);
			redirect(base_url() . 'index.php/admin/view_entrance_test/', 'refresh');
		}
		if ($param1 == 'new') 
		{
			$this->load->view('admin/create_entrance_test');
		}
		if($param1 == 'upload_marks')
		{
		$data['class_id']   = $this->input->post('class_id');
		$data['section_id'] = $this->input->post('section_id');
		$data['exam_name']    = $this->input->post('exam');
		$data['subject_id'] = $this->input->post('subject_id');
		$data['date_exam'] = date('Y-m-d',strtotime( $this->input->post('date')));
		$data['year']       = get_running_year();
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
		 $data['branch_id']   = $this->input->post('branch');
		 $data['dept_id'] = $this->input->post('department');
		}
		if($role==3)
		{
		  $data['branch_id']   =  $this->session->userdata('branch_id');
		  $data['dept_id'] = $this->input->post('department');
		}
		if($role==4)
		{
		  $data['branch_id']   =  $this->session->userdata('branch_id');
          $data['dept_id'] 	   =  $this->session->userdata('dept_id');
		}
		
		$this->db->insert('tbl_entrance_test',$data);
		$data['entrance_test_id']=$this->db->insert_id();
		
		$query = $this->db->get_where('tbl_entrance_test_mark' , array(
		'class_id' => $data['class_id'],
		'section_id' => $data['section_id'],
		'entrance_test_id' => $data['entrance_test_id'],
		'subject_id' => $data['subject_id'],
		'year' => $data['year']));
		$query1 = $this->db->get_where('enroll' , array(
		'class_id' => $data['class_id'],
		'section_id' => $data['section_id'],
		'year' => $data['year']));
		if($query->num_rows() < $query1->num_rows()) 
		{ $this->db->where('class_id',$data['class_id']);
		   $this->db->where('section_id',$data['section_id']);
		   $this->db->where('year',$data['year']);
		   $this->crud_model->check_student_status();
		   $students=$this->db->get('view_students s')->result_array();
			foreach($students as $row) 
			{
				$data['student_id'] = $row['student_id'];
				$mark = $this->db->get_where('tbl_entrance_test_mark' , array( 'class_id' => $data['class_id'],'section_id' => $data['section_id'],'entrance_test_id' => $data['entrance_test_id'],
				'subject_id' => $data['subject_id'],'year' => $data['year'],'student_id' =>$data['student_id']));
				if($mark->num_rows()<1)
				{
					$this->db->insert('tbl_entrance_test_mark' , $data);
				}
			}
		}
		redirect(base_url() . 'index.php/admin/entrance_test_marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['entrance_test_id'] . '/' . $data['subject_id'].'/'.$data['branch_id'].'/'.$data['dept_id'].'/'.$data['date_exam'] , 'refresh');
		}
		
		
		if($param1 == 'update_marks')
		{
		
		$branch_id=$this->input->post('branch_id');
		$dept_id=$this->input->post('dept_id');
		$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
		$exam_id=$this->input->post('exam_id');
		$subject_id=$this->input->post('subject_id');
		$date=$this->input->post('date');
		$this->db->where('entrance_test_id',$exam_id);
		$this->db->update('tbl_entrance_test' , array('date_exam' => date('Y-m-d',strtotime($date))));
		  $running_year = get_running_year();
		$marks_of_students= $this->crud_model->get_students_entrance_test_marks($class_id,$section_id,$exam_id,$subject_id,$running_year);
		foreach($marks_of_students as $row) 
		{
		 
			$obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
			$mark_total= $this->input->post('mark_total_'.$row['mark_id']);
			$grade1= $this->input->post('grade_value_'.$row['mark_id']);
			$comnt= $this->input->post('remarks');
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
				$result=$this->db->update('tbl_entrance_test_mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position,'date_exam'=> date('Y-m-d',strtotime($date))));
			}
			else
			{
				$this->db->where('mark_id' , $row['mark_id']);
				$result=$this->db->update('tbl_entrance_test_mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position, 'remarks' =>$comnt,'date_exam'=> date('Y-m-d',strtotime($date))));
			}
		}
		if($result>0)
		{
			$page_data["action"]="success";
			$page_data['exam_id']    =   $exam_id;
			$page_data['class_id']   =   $class_id;
			$page_data['subject_id'] =   $subject_id;
			$page_data['section_id'] =   $section_id;
			$page_data['branch_id']  =   $branch_id;
		    $page_data['dept_id']    =   $dept_id;
		    $page_data['date']       =   $date;
		}
		$this->load->view('admin/entrance_test_marks_upload', $page_data);
		}
		
	}
	
	function entrance_test_marks_upload($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '',$branch_id='',$dept_id='',$date='')
	{
		$page_data['exam_id']    =   $exam_id;
		$page_data['class_id']   =   $class_id;
		$page_data['subject_id'] =   $subject_id;
		$page_data['section_id'] =   $section_id;
		$page_data['branch_id']  =   $branch_id;
		$page_data['dept_id']    =   $dept_id;
		 $page_data['date']    =   $date;
		$this->load->view('admin/entrance_test_marks_upload', $page_data);
	}
   function entrance_test_report($class_id = '' ,$section_id= '' ,$exam_id = '',$subject_id='' ) 
	{
		
		$page_data['exam_id']    = $exam_id;
		$page_data['class_id']   = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['subject_id'] = $subject_id;
		$this->load->view('admin/entrance_test_report', $page_data);
	}
	
	function entrance_test_message($class,$section, $exam1, $subject, $grade, $position, $remark)
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
		$datas['send_date']	=  date('Y/m/d H:i:s');
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
					$this->db->where('entrance_test_id',$exam1);
					$exam_name=$this->db->get('tbl_entrance_test')->row()->exam_name;
					$this->db->where('entrance_test_id',$exam1);
					$exam_date=date('d-m-Y',strtotime($this->db->get('tbl_entrance_test')->row()->date_exam));
					
					$this->db->where('subject_id',$subject);
					$sub_name=$this->db->get('subject')->row();
	 				 $subject_name=$sub_name->name;
			
					$this->db->select('m.student_id,s.name as student_name,m.mark_obtained,m.mark_total,m.grade,m.position,m.remarks,s.phone1,s.phone2');
					$this->db->where('m.class_id', $class);
					$this->db->where('m.section_id', $section);
					$this->db->where('m.entrance_test_id', $exam1);
					$this->db->where('m.subject_id', $subject);
					$this->crud_model->check_student_status();
					$this->db->join('student s','s.student_id=m.student_id','LEFT');
					$student=$this->db->get('tbl_entrance_test_mark m')->result_array();
					foreach($student as $stud)
					{
					if($remark==1)
	{
	
	  $rmrk= "in ".$stud['remarks'];
	
	
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
	
	
	  $text="Student Name : ".$stud['student_name']." Exam : ".$exam_name. " Date : ".$exam_date." Marks:  " . $stud['mark_obtained'] . "/" . $stud['mark_total'] . " for " . $subject_name.' '.$msg.' '.$rmrk;
	  
	  
	  
	  $data1['sms_master_id']	=$master_id;
	
	 $data1['student_id']	=$stud['student_id'];
	
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$stud['phone1'];
	$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d H:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data1);
	
	if($stud['phone2']!='')
	{
	$data2['sms_master_id']	=$master_id;
	
	 $data2['student_id']	=$stud['student_id'];
	
	$data2['class_id']	=$class;
	$data2['section_id']	=$section;
	$data2['phone']	=$stud['phone2'];
	$data2['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data2['send_date']	=  date('Y/m/d H:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data2);
	}
	
					}
					
				$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$data['exam_id']	=	$exam1;
		$data['subject_id']	=	$subject;
		$this->load->view('admin/message_popup_entrance_test',$data);
	}	
	
	
	function edit_entrance_test($exam_id='',$class_id='',$subject_id='',$section_id='',$branch_id='',$dept_id='',$date='')
	{
	        $page_data['exam_id']    =   $exam_id;
			$page_data['class_id']   =   $class_id;
			$page_data['subject_id'] =   $subject_id;
			$page_data['section_id'] =   $section_id;
			$page_data['branch_id']  =   $branch_id;
		    $page_data['dept_id']    =   $dept_id;
			$page_data['date']    =   $date;
		   $this->load->view('admin/entrance_test_marks_upload', $page_data);
	}
	
	public function entrancetest_print_report($class_id,$section_id,$exam_id)
	{
		
		$this->db->select('e.student_id');
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.section_id',$section_id);
		$this->crud_model->check_student_status();
		$this->db->join('student s','s.student_id=e.student_id','LEFT');
		$query_result=$this->db->get('enroll e')->result_array();
		ob_start();
		ob_get_clean();
		$total = 0;
		$i=1;
		echo  "Students List\n";
		if ($class_id!='ALL')   echo  "\tClass  \t" . get_class_name($class_id). "\n";
		if ($section_id!='ALL')	echo  "\tSection \t" . get_section_name($section_id ). "\n\n\n";
		if ($exam_id!='ALL')	echo  "\tExam \t" .  $this->db->get_where('tbl_entrance_test' , array('entrance_test_id' => $exam_id))->row()->exam_name. "\n\n\n";
		foreach ($query_result as $data)
		{
			$arrangeData['Sl.No'] 		= $i;
			$arrangeData['Name'] 		= get_student_name($data['student_id']);
			$this->db->select('distinct(m.student_id) as student,m.mark_obtained,m.position,m.mark_total,s.name as subject');
			$this->db->from('tbl_entrance_test_mark m');
			$this->db->join('subject s','m.subject_id=s.subject_id');
			$this->db->where('m.class_id',$class_id);
			$this->db->where('m.section_id',$section_id);
			$this->db->where('m.entrance_test_id',$exam_id);
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
	function sms_send_popup_entrance_test($master_id,$class_id,$section_id,$exam_id,$subject_id)
	
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
	 
	redirect(base_url() . 'index.php/admin/entrance_test_report/'.$class_id.'/'.$section_id.'/'.$exam_id.'/'.$subject_id , 'refresh');        
	
	} 
	
	
//******* Entrance test end ******************//
      
	function view_home_test()  
	{
	    $running_year = get_running_year();
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$branch		=		$this->input->post('branch');
			$dept		=		$this->input->post('department');
			if($branch && $dept)
			{
				$this->db->where('branch_id',$branch);
				$this->db->where('dept_id',$dept);
			}
			$this->db->where('is_deleted','N');
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('tbl_home_test')->result_array();
		}
		if($role==3)
		{
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->input->post('department');
			if($dept)
			{
				$this->db->where('dept_id',$dept);
			}
			$this->db->where('is_deleted','N');
			$this->db->where('branch_id',$branch);
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('tbl_home_test')->result_array();
		}
		if($role==4 || $role==12)
		{
			$branch		=		$this->session->userdata('branch_id');
			$dept		=		$this->session->userdata('dept_id');
			$this->db->where('branch_id',$branch);
			$this->db->where('dept_id',$dept);
			$this->db->where('is_deleted','N');
			$this->db->where('year',$running_year);
			$page_data['exams']      = $this->db->get('tbl_home_test')->result_array();
		} 
		$this->load->view('admin/view_home_test',$page_data);
	}
	
	function create_home_test($param1 = '',$param2='')
	{
		
		if ($param1 == 'delete') 
		{
			$data['is_deleted']   = "Y";
			$this->db->where('exam_id', $param2);
			$this->db->update('exam', $data);
			redirect(base_url() . 'index.php/admin/view_exam/', 'refresh');
		}
		if ($param1 == 'new') 
		{
			$this->load->view('admin/create_home_test');
		}
		if($param1 == 'upload_marks')
		{
		$data['class_id']   = $this->input->post('class_id');
		$data['section_id'] = $this->input->post('section_id');
		$data['exam_name']    = $this->input->post('exam');
		$data['subject_id'] = $this->input->post('subject_id');
		$data['date_exam'] = date('Y-m-d',strtotime( $this->input->post('date')));
		$data['year']       = get_running_year();
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
		 $data['branch_id']   = $this->input->post('branch');
		 $data['dept_id'] = $this->input->post('department');
		}
		if($role==3)
		{
		  $data['branch_id']   =  $this->session->userdata('branch_id');
		  $data['dept_id'] = $this->input->post('department');
		}
		if($role==4 || $role==12)
		{
		  $data['branch_id']   =  $this->session->userdata('branch_id');
          $data['dept_id'] 	   =  $this->session->userdata('dept_id');
		}
		
		$this->db->insert('tbl_home_test',$data);
		$data['home_test_id']=$this->db->insert_id();
		
		$query = $this->db->get_where('tbl_home_test_mark' , array(
		'class_id' => $data['class_id'],
		'section_id' => $data['section_id'],
		'home_test_id' => $data['home_test_id'],
		'subject_id' => $data['subject_id'],
		'year' => $data['year']));
		$query1 = $this->db->get_where('enroll' , array(
		'class_id' => $data['class_id'],
		'section_id' => $data['section_id'],
		'year' => $data['year']));
		if($query->num_rows() < $query1->num_rows()) 
		{ $this->db->where('class_id',$data['class_id']);
		   $this->db->where('section_id',$data['section_id']);
		   $this->db->where('year',$data['year']);
		   $this->crud_model->check_student_status();
		   $students=$this->db->get('view_students s')->result_array();
			foreach($students as $row) 
			{
				$data['student_id'] = $row['student_id'];
				$mark = $this->db->get_where('tbl_home_test_mark' , array( 'class_id' => $data['class_id'],'section_id' => $data['section_id'],'home_test_id' => $data['home_test_id'],
				'subject_id' => $data['subject_id'],'year' => $data['year'],'student_id' =>$data['student_id']));
				if($mark->num_rows()<1)
				{
					$this->db->insert('tbl_home_test_mark' , $data);
				}
			}
		}
		redirect(base_url() . 'index.php/admin/home_test_marks_upload/' . $data['class_id'] . '/' . $data['section_id'] . '/' . $data['home_test_id'] . '/' . $data['subject_id'].'/'.$data['branch_id'].'/'.$data['dept_id'].'/'.$data['date_exam'] , 'refresh');
		}
		
		
		if($param1 == 'update_marks')
		{
		
		$branch_id=$this->input->post('branch_id');
		$dept_id=$this->input->post('dept_id');
		$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
		$exam_id=$this->input->post('exam_id');
		$subject_id=$this->input->post('subject_id');
		$date=$this->input->post('date');
		$this->db->where('home_test_id',$exam_id);
		$this->db->update('tbl_home_test' , array('date_exam' => date('Y-m-d',strtotime($date))));
		  $running_year = get_running_year();
		$marks_of_students= $this->crud_model->get_students_home_test_marks($class_id,$section_id,$exam_id,$subject_id,$running_year);
		foreach($marks_of_students as $row) 
		{
		 
			$obtained_marks = $this->input->post('marks_obtained_'.$row['mark_id']);
			$mark_total= $this->input->post('mark_total_'.$row['mark_id']);
			$grade1= $this->input->post('grade_value_'.$row['mark_id']);
			$comnt= $this->input->post('remarks');
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
				$result=$this->db->update('tbl_home_test_mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position,'date_exam'=> date('Y-m-d',strtotime($date))));
			}
			else
			{
				$this->db->where('mark_id' , $row['mark_id']);
				$result=$this->db->update('tbl_home_test_mark' , array('mark_obtained' => $obtained_marks ,'mark_total' => $mark_total,'grade' => $grade, 'position' => $position, 'remarks' =>$comnt,'date_exam'=> date('Y-m-d',strtotime($date))));
			}
		}
		if($result>0)
		{
			$page_data["action"]="success";
			$page_data['exam_id']    =   $exam_id;
			$page_data['class_id']   =   $class_id;
			$page_data['subject_id'] =   $subject_id;
			$page_data['section_id'] =   $section_id;
			$page_data['branch_id']  =   $branch_id;
		    $page_data['dept_id']    =   $dept_id;
		    $page_data['date']       =   $date;
		}
		$this->load->view('admin/home_test_marks_upload', $page_data);
		}
		
	}
	
	
	function class_get_subject($class_id='')
	{
		$page_data['class_id'] = $class_id;
		$this->load->view('admin/class_get_subject' , $page_data);
	}
	
	function home_test_marks_upload($class_id = '' , $section_id = '' , $exam_id = '' , $subject_id = '',$branch_id='',$dept_id='',$date='')
	{
		$page_data['exam_id']    =   $exam_id;
		$page_data['class_id']   =   $class_id;
		$page_data['subject_id'] =   $subject_id;
		$page_data['section_id'] =   $section_id;
		$page_data['branch_id']  =   $branch_id;
		$page_data['dept_id']    =   $dept_id;
		 $page_data['date']    =   $date;
		$this->load->view('admin/home_test_marks_upload', $page_data);
	}
   function home_test_report($class_id = '' ,$section_id= '' ,$exam_id = '',$subject_id='' ) 
	{
		
		$page_data['exam_id']    = $exam_id;
		$page_data['class_id']   = $class_id;
		$page_data['section_id'] = $section_id;
		$page_data['subject_id'] = $subject_id;
		$this->load->view('admin/home_test_report', $page_data);
	}
	
	function home_test_message($class,$section, $exam1, $subject, $grade, $position, $remark)
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
		$datas['send_date']	=  date('Y/m/d H:i:s');
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
					$this->db->where('home_test_id',$exam1);
					$exam_name=$this->db->get('tbl_home_test')->row()->exam_name;
					$this->db->where('home_test_id',$exam1);
					$exam_date=date('d-m-Y',strtotime($this->db->get('tbl_home_test')->row()->date_exam));
					
					$this->db->where('subject_id',$subject);
					$sub_name=$this->db->get('subject')->row();
	 				 $subject_name=$sub_name->name;
			
					$this->db->select('m.student_id,s.name as student_name,m.mark_obtained,m.mark_total,m.grade,m.position,m.remarks,s.phone1,s.phone2');
					$this->db->where('m.class_id', $class);
					$this->db->where('m.section_id', $section);
					$this->db->where('m.home_test_id', $exam1);
					$this->db->where('m.subject_id', $subject);
					$this->crud_model->check_student_status();
					$this->db->join('student s','s.student_id=m.student_id','LEFT');
					$student=$this->db->get('tbl_home_test_mark m')->result_array();
					foreach($student as $stud)
					{
					if($remark==1)
	{
	
	  $rmrk= "in ".$stud['remarks'];
	
	
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
	
	
	  $text="Student Name : ".$stud['student_name']." Exam : ".$exam_name. " Date : ".$exam_date." Marks:  " . $stud['mark_obtained'] . "/" . $stud['mark_total'] . " for " . $subject_name.' '.$msg.' '.$rmrk;
	  
	  
	  
	  $data1['sms_master_id']	=$master_id;
	
	 $data1['student_id']	=$stud['student_id'];
	
	$data1['class_id']	=$class;
	$data1['section_id']	=$section;
	$data1['phone']	=$stud['phone1'];
	$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data1['send_date']	=  date('Y/m/d H:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data1);
	
	if($stud['phone2']!='')
	{
	$data2['sms_master_id']	=$master_id;
	
	 $data2['student_id']	=$stud['student_id'];
	
	$data2['class_id']	=$class;
	$data2['section_id']	=$section;
	$data2['phone']	=$stud['phone2'];
	$data2['msg_content']	=$this->sms_helper1($common,$c,$text);
	date_default_timezone_set("Asia/Kolkata");
		$data2['send_date']	=  date('Y/m/d H:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data2);
	}
	
					}
					
				$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class;
		$data['section_id']	=	$section;
		$data['exam_id']	=	$exam1;
		$data['subject_id']	=	$subject;
		$this->load->view('admin/message_popup_exam_report_subject',$data);
	}	
	
	
	function edit_home_test($exam_id='',$class_id='',$subject_id='',$section_id='',$branch_id='',$dept_id='',$date='')
	{
	        $page_data['exam_id']    =   $exam_id;
			$page_data['class_id']   =   $class_id;
			$page_data['subject_id'] =   $subject_id;
			$page_data['section_id'] =   $section_id;
			$page_data['branch_id']  =   $branch_id;
		    $page_data['dept_id']    =   $dept_id;
			$page_data['date']    =   $date;
		   $this->load->view('admin/home_test_marks_upload', $page_data);
	}
	
	public function hometest_print_report($class_id,$section_id,$exam_id)
	{
		
		$this->db->select('e.student_id');
		$this->db->where('e.class_id',$class_id);
		$this->db->where('e.section_id',$section_id);
		$this->crud_model->check_student_status();
		$this->db->join('student s','s.student_id=e.student_id','LEFT');
		$query_result=$this->db->get('enroll e')->result_array();
		ob_start();
		ob_get_clean();
		$total = 0;
		$i=1;
		echo  "Students List\n";
		if ($class_id!='ALL')   echo  "\tClass  \t" . get_class_name($class_id). "\n";
		if ($section_id!='ALL')	echo  "\tSection \t" . get_section_name($section_id ). "\n\n\n";
		if ($exam_id!='ALL')	echo  "\tExam \t" .  $this->db->get_where('tbl_home_test' , array('home_test_id' => $exam_id))->row()->exam_name. "\n\n\n";
		foreach ($query_result as $data)
		{
			$arrangeData['Sl.No'] 		= $i;
			$arrangeData['Name'] 		= get_student_name($data['student_id']);
			$this->db->select('distinct(m.student_id) as student,m.mark_obtained,m.position,m.mark_total,s.name as subject');
			$this->db->from('tbl_home_test_mark m');
			$this->db->join('subject s','m.subject_id=s.subject_id');
			$this->db->where('m.class_id',$class_id);
			$this->db->where('m.section_id',$section_id);
			$this->db->where('m.home_test_id',$exam_id);
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
	
function new_staff_message() 
	{
	$running_year=get_running_year();
	$role=$this->session->userdata('role');  
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	
		$ph='';
		$ph2='';
		 //$branch =$this->input->post('sbranch');
		 //$dept = $this->input->post('sdepartment');
	     $staff1 = $this->input->post('staff');  
		 $staffs =	 array();
		 for($i=0;$i<count($staff1);$i++) 
		 {
		 	array_push($staffs,$staff1[$i]);
		 }
	     $content = $this->input->post('smessage');
		 $user_id	= $this->session->userdata('login_user_id');
		 $staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		 $data['send_by']	=$staff;
		 $data['content']	=  $content;
         date_default_timezone_set("Asia/Kolkata");
		 $data['send_date']	=  date('Y/m/d H:i:s');
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
			//echo "hi";die();		
				//  echo $staff1;
				
				//echo $dept	=	$this->session->userdata('dept_id');
				$this->db->select('s.phone,s.name,s.staff_id');
				$this->db->from('staff s');
				//$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
				//$this->db->where('s.branch_id',$branch);
				//$this->db->where('s.dept_id',$dept);
				$this->db->where_in('s.staff_id',$staffs);
				//$this->db->where('e.year',$running_year);
				//$this->crud_model->check_student_status();
				$a=$this->db->get()->result_array();//echo $this->db->last_query();die();
				//echo "<pre>"; print_r($a); echo "<pre>"; die();
				foreach($a as $b)
				{
				
					if($b['phone']>0)
					{
						$data1['sms_master_id']	=$master_id;
						$data1['student_id']	=$b['staff_id'];
						//	$data1['class_id']	=$class;
						//$data1['section_id']	=$section;
						
						$data1['phone']	=$b['phone'];
						$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);
					}
					date_default_timezone_set("Asia/Kolkata");
					$data1['send_date']	=  date('Y/m/d H:i:s');
					//echo "<pre>"; print_r($data1); echo "<pre>"; die();
					if($master_id>0 && $content!='')
					{
						$this->db->insert('tbl_sms_delivery_details',$data1);
					}
				}
					 
	
			/*$data1['sms_master_id']	=$master_id;
			$data1['student_id']	=$b['staff_id'];
			//$data1['class_id']	=$class;
			//$data1['section_id']	=$section;
				foreach($a as $b)
		        {
			$data1['phone']	=$b['phone'];
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
			$data1['msg_content']	= $this->sms_helper($common,$c,$n,$b['name'],$content);
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']	=  date('Y/m/d H:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data1);
		     }*/
			 $data['master_id']		=	$master_id;	
			 $data['student_id']   	=	$staff1;
			//$data['section_id']	=	$section;
			$this->load->view('admin/message_popup_staff',$data);
	}


function get_staff($department)
	{
		//$staff_option=$this->input->post('department');
		$staff  = $this->db->get_where('staff' , array('dept_id' => $department,'is_deleted'=>'N'))->result_array();
		if(count($staff)>0)
		{
			echo '<input type="checkbox" name="check_all" id="check_all" onChange="check_uncheck_all()"><b> Select all </b><br><br>';	
			foreach($staff as $data)
			{	
				echo '<input type="checkbox" name="staff[]" id="staff" value="'.$data["staff_id"].'" > '.$data["name"].'<br>';
			}
		}
		else
		{
			echo '<span>No staff found...</span>';
		}	
	}	
	
	
	
	
	function bulk_password_set()
	{
	$this->load->view('admin/bulk_password');
	}
	function change_password_bulk()
	{
	$user_id=$this->input->post('user_id[]');
	$username=$this->input->post('username[]');
	$password=$this->input->post('pass[]');
	$user_count=count($user_id);
	 for($i = 0; $i < $user_count; $i++)
	 {
	 $data['username']=$username[$i];
	 $data['password']=sha1($password[$i]);
	 
	 $this->db->where('user_id',$user_id[$i]);
	 $this->db->update('tbl_users',$data);
	 
	 
	 }
	redirect('Admin/bulk_password_set');
	}

	//////////////////////////////////////////////////////////
	
	
	function get_fee_structure($class_id='')
	{
		$this->db->where('class_id',$class_id);
		$fee_structures = $this->db->get('tbl_fee_master')->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($fee_structures as $row) 
		{
			echo '<option value="' . $row['fee_master_id'] . '">' . $row['fee_master_name'] . '</option>';
		}
	}	
	
	function get_absent_students()
	{
		$status	=	2;
		$this->load->model('Crud_model');
		$data['students']	=	$this->Crud_model->get_late_absent_students($status);//echo $this->db->last_query();die();
		$this->load->view('admin/absent_students_list',$data);
	}
	
	function get_late_students()
	{
		$status	=	3;
		$this->load->model('Crud_model');
		$data['students']	=	$this->Crud_model->get_late_absent_students($status);//echo $this->db->last_query();die();
		$this->load->view('admin/late_students_list',$data);
	}
	
	function student_migration(){
		$this->load->view('admin/student_migration.php');
	}
	function student_migrate_check($class,$section,$academic_year,$branch,$department)
	{
	$cls = $this->crud_model->migrate_check($class,$section,$academic_year);
	$data['student'] =$cls;
	if($this->session->userdata('role')==4)
	{
	     $data['branch'] =$this->session->userdata('branch_id');
	
	$data['dept'] =$this->session->userdata('dept_id');
	}
	else
	{
	
	 $data['branch'] =$branch;
	
	$data['dept'] =$department;
	}
	$data['class'] =$class;
	$data['section'] =$section;
	$data['academic_year'] =$academic_year;
	$this->load->view('admin/student_check_migration.php', $data);
	
	}
	function student_migrate()
	{
	
		$student		=	$this->input->post('student');
		$class			=	$this->input->post('class1');
		$section		=	$this->input->post('section1');
		$year			=	$this->input->post('academic_year');
		$from_section	=	$this->input->post('section');

		$this->db->db_debug		=	FALSE;
		
		$this->db->trans_start();
		for($i=0;$i<count($student);$i++)   
		{
			$data['class_id']	=	$class;
			$data['section_id']	=	$section;
			
			$this->db->where('student_id',$student[$i]);
			$this->db->where('year',$year);
			$this->db->update('enroll',$data);
			
			$this->crud_model->update_section($student[$i],$class,$year,$section,$from_section);
		
		}
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('action','not_migrated');
		}
		else
		{
			$this->session->set_flashdata('action','migrated');
		}
		redirect('admin/student_migration');
		//$this->load->view('admin/student_migration.php',$data);
	}
	//This function is related to student/staff group message
	function get_group_for($group_master_id='')
	{
	    if($group_master_id!='')
	    {
	        $group_for  =   $this->crud_model->get_group_for($group_master_id);
	        echo $group_for;
	    }
	}
	
	function send_push_notification()
	{
	    $this->load->view('admin/notification');
	}

/******** To edit roll numbers of students in a class simultaneously *********/    	
	/*function roll_no()
	{
	    $year   =   get_running_year();
	    $this->db->select('a.enroll_id,b.name');
	    $this->db->from('enroll a');
	    $this->db->join('student b','b.student_id=a.student_id','left');
	    $this->db->where('a.class_id','1');
	    $this->db->where('a.section_id','4');
	    $this->db->where('a.year',$year);
	    $data['result'] =   $this->db->get()->result_array();
	    $this->load->view('admin/roll_no',$data);
	}
	function add_roll_no()
	{
	    $enroll_id  =   $this->input->post('enroll_id[]');    
	    $roll       =   $this->input->post('roll[]');    
	    for($i=0;$i<count($enroll_id);$i++): 
	        $this->db->set('roll',$roll[$i]);
	        $this->db->where('enroll_id',$enroll_id[$i]);
	        $this->db->update('enroll');
	    endfor;     
	}*/
/********************************/	


function get_class_section_notification($class_id='')
	{
	    echo '';
	    die();
		$class_option=$this->input->post('class');
		
		$this->db->where('class_id',$class_id);
	
		$sections = $this->db->get('section')->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}
	
/*********** Course completed and Discontinued start ***************/	
	/*
	 * Mani,14-01-2019 
	 */
	function update_course_status()
	{
		$data['status']				=	$this->input->post('status');
		$data['class_id']			=	$this->input->post('class_id');
		$data['student_id']			=	$this->input->post('student_id');
		$data['year']				=	get_running_year();
		$result						=	$this->crud_model->update_course_status($data);
		if($result == 0)//Not updated
		{
			redirect('admin/student_portal/'.$data['student_id']);
		}
		else if($result == 1)//Updated
		{
			redirect('admin/students_area/'.$data['class_id']);
		}
	}	
	function course_status_report($para1='')
	{
		if($para1!='')
		{
			$data['status']			=	$para1;
			$this->load->view('admin/course_status_report',$data);
		}
	}
	function course_status_report1()
	{
		$data['branch_id']			=	$this->input->post('branch_id');	
		$data['dept_id']			=	$this->input->post('dept_id');	
		$data['class_id']			=	$this->input->post('class_id');	
		$data['section_id']			=	$this->input->post('section_id');	
		$data['status']				=	$this->input->post('status');
		
		$data1['report']			=	$this->crud_model->course_status_report($data);	
		
		$this->load->view('admin/course_status_report_'.$data['status'],$data1);
	}
/*********** Course completed and Discontinued end *****************/	
	
	
/*********** Photo Gallery start ***************/	
	/*
	 * Mani,04-02-2019 
	 */


	function gallery()
	{
		$data['result']			=	$this->crud_model->gallery();
		$this->load->view('admin/gallery',$data);
	}
	function gallery_upload()
	{ 
		if($this->input->post('image_upload'))
		{
			$count 			= 	count($_FILES['images']['size']);
			date_default_timezone_set('Asia/Kolkata');	
				
			$img['title']		=	$this->input->post('title');	
			$img['description']	=	$this->input->post('description');	
			$img['date']		=	date('Y-m-d');
			$img['year_id']		=	get_running_year();
			$gallery_master_id	=	$this->crud_model->gallery_master_insert($img);
			$img_detail			=	array();
				
			if (!file_exists('./uploads/photo_gallery')) {
				mkdir('./uploads/photo_gallery', 0777, true);
			}
			/*$sub_folders  = count( glob("./uploads/photo_gallery/*", GLOB_ONLYDIR) );	
			$sub_folders++;*/
	
			foreach($_FILES as $key=>$value)
			for($i=0; $i<$count; $i++) { 
				
				if (!file_exists('./uploads/photo_gallery/'.$gallery_master_id)) {
					mkdir('./uploads/photo_gallery/'.$gallery_master_id, 0777, true);
				}
				
				$_FILES['userfile']['name']		=	$gallery_master_id.'_'.($i+1).'.'.pathinfo($value['name'][$i], PATHINFO_EXTENSION);
				$_FILES['userfile']['type']    	= 	$value['type'][$i];
				$_FILES['userfile']['tmp_name'] = 	$value['tmp_name'][$i];
				$_FILES['userfile']['error']    = 	$value['error'][$i];
				$_FILES['userfile']['size']    	= 	$value['size'][$i];   
				
				$config['upload_path'] 			= 	'./uploads/photo_gallery/'.$gallery_master_id;
				$config['allowed_types'] 		= 	'gif|jpg|png';
				/*$config['max_size']    			= 	'100';
				$config['max_width']  			= 	'600';
            	$config['max_height']  			= 	'300';*/
	
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$errors[]					=	array(
														'file_name'	=>	$value['name'][$i],		 
														'error'		=>	$this->upload->display_errors()
														);
												
				}
				else
				{
					$data 						= 	$this->upload->data();
					$img_detail                 =   array();
					$img_detail['gallery_master_id'] = $gallery_master_id;
					$img_detail['url']          =   'uploads/photo_gallery/'.$gallery_master_id.'/'.$data['file_name'];		
					$img_detail['description']  =   $this->input->post('description_'.$i);		
					$gallery_details_id[]       =   $this->crud_model->gallery_details_insert($img_detail);
					//$this->resize_image($img['url']);
					
					////////////
					
					 $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => './uploads/photo_gallery/'.$gallery_master_id.'/'.$data['file_name'],
                            'create_thumb' => FALSE,//tell the CI do not create thumbnail on image
                            'maintain_ratio' => TRUE,
                            'width' => 640,//new size of image
                            'height' => 480,//new size of image
                        );
					$this->load->library('image_lib', $config);	
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                                     
					if(!$this->image_lib->resize())
					{
					echo $this->image_lib->display_errors();                           
					}               
					
					
					////////////
				}
								
				
			}
			if(!isset($gallery_details_id))
			{
				rmdir('./uploads/photo_gallery/'.$gallery_master_id);
				$this->db->where('id',$gallery_master_id);
				$this->db->delete('tbl_gallery_master');
			}
			if(count($errors)>0)
			{
				$this->session->set_userdata('errors',$errors);
			}
			else
			{
				$this->session->set_flashdata('action','success');
			}
			redirect('admin/gallery');
    	}
	}
	function gallery_search()
	{
		$keyword			=		$this->input->post('keyword');
		$date_from			=		$this->input->post('date_from');
		$date_to			=		$this->input->post('date_to');
		$data['result']		=		$this->crud_model->gallery($keyword,$date_from,$date_to);
		$this->load->view('admin/gallery_search_result',$data);
	}	
	function gallery_master_delete()
	{
		$gallery_master_id	=		$this->input->post('gallery_master_id');
		$affected_rows		=		$this->crud_model->gallery_master_delete($gallery_master_id);
		if($affected_rows>0)
		{
			$this->session->set_flashdata('action','delete_success');
		}
		else
		{
			$this->session->set_flashdata('action','delete_failed');
		}
		$data['result']		=		$this->crud_model->gallery();
		$this->load->view('admin/gallery_search_result',$data);
	}
	function view_gallery_images($gallery_master_id)
	{
		$data['result']		=		$this->crud_model->view_gallery_images($gallery_master_id);
		$this->load->view('admin/gallery_details',$data);
	}
	function gallery_master_update()
	{
		$gallery_master_id		=		$this->input->post('gallery_master_id');
		$title					=		$this->input->post('title');
		$description			=		$this->input->post('description');
		$affected_rows			=		$this->crud_model->gallery_master_update($gallery_master_id,$title,$description);
		if($affected_rows>0)
		{
			echo "master_update_success";
		}
		else
		{
			echo "master_update_failed";
		}
	}
	function gallery_details_update()
	{
		$gallery_details_id		=		$this->input->post('gallery_details_id');
		$description			=		$this->input->post('description');
		$affected_rows			=		$this->crud_model->gallery_details_update($gallery_details_id,$description);
		if($affected_rows>0)
		{
			echo "details_update_success";
		}
		else
		{
			echo "details_update_failed";
		}
	}
	function gallery_details_delete()
	{
		$gallery_master_id	=		$this->input->post('gallery_master_id');
		$gallery_details_id	=		$this->input->post('gallery_details_id');
		$affected_rows		=		$this->crud_model->gallery_details_delete($gallery_details_id);
		if($affected_rows>0)
		{
			$this->session->set_flashdata('action','delete_success');
		}
		else
		{
			$this->session->set_flashdata('action','delete_failed');
		}
		$data['result']		=		$this->crud_model->view_gallery_images($gallery_master_id);
		$this->load->view('admin/gallery_details_search_result',$data);
	}
	function add_more_photos($gallery_master_id)
	{
		$description		=	$this->input->post('description');
		foreach($_FILES as $key=>$value)
		{	
			$directory 		= 	'./uploads/photo_gallery/'.$gallery_master_id;
			$filecount 		= 	(count(scandir($directory)) - 2);
			$filecount++;
			$_FILES['userfile']['name']		=	$gallery_master_id.'_'.($filecount).'.'.pathinfo($value['name'], PATHINFO_EXTENSION);
			$_FILES['userfile']['type']    	= 	$value['type'];
			$_FILES['userfile']['tmp_name'] = 	$value['tmp_name'];
			$_FILES['userfile']['error']    = 	$value['error'];
			$_FILES['userfile']['size']    	= 	$value['size'];   
			
			$config['upload_path'] 			= 	'./uploads/photo_gallery/'.$gallery_master_id;
			$config['allowed_types'] 		= 	'gif|jpg|png';
			/*$config['max_size']    			= 	'100';
			$config['max_width']  			= 	'600';
			$config['max_height']  			= 	'300';*/

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload())
			{
				$errors						=	array(
													'file_name'	=>	$value['name'],		 
													'error'		=>	$this->upload->display_errors()
													);
											
			}
			else
			{
				$data 						= 	$this->upload->data();
				$img_detail                 =   array();
				$img_detail['gallery_master_id'] = $gallery_master_id;
				$img_detail['url']          =   'uploads/photo_gallery/'.$gallery_master_id.'/'.$data['file_name'];		
				$img_detail['description']  =   $description;		
				$gallery_details_id			=	$this->crud_model->gallery_details_insert($img_detail);
				//$this->resize_image($img['url']);
			}
							
			
			if(isset($errors))
			{
				$this->session->set_flashdata('action','insert_failed');
			}
			else
			{
				$this->session->set_flashdata('action','insert_success');
			}
		}
		$data['result']		=		$this->crud_model->view_gallery_images($gallery_master_id);
		$this->load->view('admin/gallery_details_search_result',$data);
	}
	 
/*********** Photo Gallery end ***************/	
/*********** Graph Start ***************/	
	function graph_marks()
	{
		$this->load->view('admin/graph_marks');
	}
	
	function view_graph_marks()
	{
		$data['class_id']		=	$this->input->post('class_id');
		$data['section_id']		=	$this->input->post('section_id');
		$data['student_id']		=	$this->input->post('student_id');
		$data['result']			=	$this->crud_model->view_graph_marks($data);
		$this->load->view('admin/graph_view',$data);
	}
/*********** Graph End ***************/	

/***********/
    function check_class_exist($class_name,$dept_id,$branch_id)
    {
        $count =   $this->crud_model->check_class_exist(urldecode($class_name),$dept_id,$branch_id);
        if($count>0)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
    function check_section_exist($section_name,$class_id)
    {
        $count =   $this->crud_model->check_section_exist(urldecode($section_name),$class_id);
        if($count>0)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
	function view_section_add_bulk()
	{
	$data['class']    = $this->crud_model->get_classes();
	$this->load->view('admin/view_section_add_bulk.php',$data);
	//redirect(base_url().'index.php?admin/create')
	
	}
	function add_bulk_section()
	{
    	$running_year               =   get_running_year();
    	$class_id                   =   $this->input->post('class_id');
    	$section_name               =   $this->input->post('section_name[]');
    	$teacher_id                 =   $this->input->post('teacher_id[]');
    	
    	$this->db->trans_start();
    	$this->db->db_debug         =   FALSE;   
	    for($i=0;$i<count($section_name);$i++)
	    {
        	$data['academic_year']  =   $running_year;
	        $data['class_id']       =   $class_id;
	        $data['name']           =   $section_name[$i];
	        $data['teacher_id']     =   $teacher_id[$i];
            $result                 =   $this->crud_model->add_section($data);
            
        	if($teacher_id[$i]!= "")
        	{
            	$this->db->select('user_id');
            	$this->db->from('staff');
            	$this->db->where('staff_id',$teacher_id[$i]);
            	$query                      =   $this->db->get()->row();
            	$data1['is_class_teacher']  =   "Y";
            	$this->db->where('user_id',$query->user_id);
            	$this->db->update('tbl_users',$data1);
        	}
	    }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            $this->session->set_flashdata('action','not_added');
        }
        else
        {
            $this->session->set_flashdata('action','added');
        }
    	redirect('admin/view_section_add_bulk');
    		
	}
		
	function view_change_academic_year()
	{
		$this->load->view('admin/view_change_academic_year');
	}	
	
	function change_academic_year()
	{
	    $data['description'] = $this->input->post('acc_year');
	    //$this->db->where('type' , 'running_year');
	    //$this->db->update('settings' , $data);
	    
	    $this->session->set_userdata('academic_year',$data['description']);
	    redirect('admin');
	}
        function change_academic_year_in_clerk()
	{
	    $data['description'] = $this->input->post('acc_year');
    
	    $this->session->set_userdata('academic_year',$data['description']);
	    redirect('Admin/clerk_dashboard');
	}
/***********/

/******* TC and Hallticket Start ***********/
	function view_tc_issued()
	{
	$running_year = get_running_year();
	$this->db->where('academic_year_id',$running_year);
	$this->db->where('is_deleted','N');
	$data['tc_issued']=$this->db->get('tbl_tc_transfer_certifcate')->result_array();
	$this->load->view('admin/view_issued_tc',$data);
	}
	
	function view_tc()
	{
		$tc_id=$this->uri->segment(3);
		$this->db->where('tc_id',$tc_id);
		$data['tc_subjects']=$this->db->get('tbl_tc_student_subjects')->result_array();
		$this->db->where('tc_id',$tc_id);
		$data['tc_issued']=$this->db->get('tbl_tc_transfer_certifcate')->result_array();
		$this->load->view('admin/view_tc',$data);
	}
	
	
	function issue_tc($student_id,$class_id)
	{
		$data['class_id']	=  $class_id;
		$data['student_id']	=  $student_id;
		$this->db->where('student_id',$student_id);
		$data['student'] = $this->db->get('student')->result_array();
		$this->load->view('admin/issue_tc',$data);
	}
	function get_caste($religion_id)
	{
		$this->db->where('religion_id',$religion_id);
		$caste = $this->db->get('tbl_caste')->result_array();
		echo '<option value="">SELECT</option>';
		foreach ($caste as $row) 
		{
			echo '<option value="' . $row['caste_id'] . '">' . $row['caste'] . '</option>';
		}
	}
	
	function insert_tc_data()
	{
	$running_year = get_running_year();
	//$this->db->db_debug		=	FALSE;
	$data=array(
	'student_id'				=>$this->input->post('student_id'),
	'book_number'				=>$this->input->post('book_num'),
	'tc_number'					=>$this->input->post('tc_num'),
	'sex'						=>$this->input->post('sex'),
	'nationality'				=>$this->input->post('nationality'),
	'religion'					=>$this->input->post('religion'),
	'caste'						=>$this->input->post('Caste'),
	'is_scheduled_caste'		=>$this->input->post('scheduled_caste'),
	'name_of_father'			=>$this->input->post('father_name'),
	'name_of_mother'			=>$this->input->post('mother_name'),
	'date_of_admission'			=>date("Y-m-d", strtotime($this->input->post ('date_of_admission'))),
	'date_of_birth'				=>date("Y-m-d", strtotime($this->input->post ('birthday'))),
	'last_class_studied'		=>$this->input->post('class'),
	'last_exam_appeared'		=>$this->input->post('last_exam'),
	'last_exam_result'			=>$this->input->post('last_exam_result'),
	'qualified_for_higher_class'=>$this->input->post('qualify'),
	'total_working_days'		=>$this->input->post('working_days'),
	'total_present'				=>$this->input->post('total_present'),
	'general_conduct'			=>$this->input->post('conduct'),
	'date_applied'				=>date("Y-m-d", strtotime($this->input->post ('applied_date'))),
	'date_issued'				=>date("Y-m-d", strtotime($this->input->post ('issued_date'))),
	'reason_for_leaving'		=>$this->input->post('reason'),
	'remarks'					=>$this->input->post('remarks'),
	'academic_year_id'			=>$running_year,
	);
	if($this->input->post ('applied_date')=="")
	{
	    $data['date_applied']   =   "";
	}
	if($this->input->post ('issued_date')=="")
	{
	    $data['date_issued']   =   "";
	}
	$student_id=$this->input->post('student_id');
	
	$this->db->insert('tbl_tc_transfer_certifcate',$data);
	$insert_id=$this->db->insert_id();
	
	$subject_id =$this->input->post('subjects[]');
	$subjects_checked =$this->input->post('subjects_checked');
	$class = $this->input->post('class');	
	$i=0;
	if($subject_id!=''){
    	foreach($subject_id as $sub_id)
    	{
    		if($subjects_checked[$i]=='Y')
    		{
    			$sub=array('tc_id'=>$insert_id,
    			'subject_id'=>$subject_id[$i],
    			);
    	$this->db->insert('tbl_tc_student_subjects',$sub);
    		}
    		$i=$i+1;
    	}
	}
	
	$this->db->set('student_status_id','5');
	$this->db->where('student_id',$student_id);
	$this->db->update('student');
	$this->issue_tc($student_id,$class);
	}
	
	function pdf_report_of_tc()
	{
		$tc_id=$this->uri->segment(3);
		$direct_download  =$this->uri->segment(4);
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$data1['tc_id']						=	$tc_id;
		$this->db->where('tc_id',$tc_id);
		$data1['tc_subjects']				=$this->db->get('tbl_tc_student_subjects')->result_array();
		$this->db->where('tc_id',$tc_id);
		$data1['tc_issued']					=$this->db->get('tbl_tc_transfer_certifcate')->result_array();
		$html								=	$this->load->view('admin/view_pdf_report_tc',$data1,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
		if($direct_download==1)
		{
        $mpdf->Output('TC.pdf','D');	
		}
		else
		{
        $mpdf->Output('TC.pdf','I');	
		}
	}
	function exam_time_table($action='')
	{
		$data['action']=$action;
		$this->load->view('admin/create_exam_time_table',$data);
	}

	function create_exam_time_table()
	{
		$running_year = get_running_year();

		$this->db->trans_start();
		$data['branch_id']    				= $this->input->post('selected_branch');
		$data['exam_title'] 				= urldecode($this->input->post('exam_title'));	
		$data['description'] 				= $this->input->post('description');
		//echo $data['exam_title'];die; 
		//$master =	''; 
		
		$qry	=	$this->db->get_where('tbl_exam_time_table_master' , array('branch_id' => $data['branch_id'], 'exam_title' => $data['exam_title']))->row();
		if(isset($qry))
		{
			$master_id	=	$qry->exam_time_table_master_id;
		}
		else
		{
		$this->db->insert('tbl_exam_time_table_master' , $data);
		$master_id= $this->db->insert_id();
		}
		$subject							= $this->input->post('count_item');
		$checked    						= $this->input->post('checked[]');
		$datas['exam_time_table_master_id'] = $master_id;
		$datas['department_id'] 			= $this->input->post('dept');
		$datas['class_id']    				= $this->input->post('class');
		$datas['year_id']					= $running_year;

		
		$this->db->where('year_id',$running_year);
		$this->db->where('exam_time_table_master_id',$master_id);
		$this->db->where('class_id',$datas['class_id']);
		$this->db->delete('tbl_exam_time_table_details');

		
		$subject_id    						= $this->input->post('check_status[]');
		$exam_name   						= $this->input->post('exam_name[]');
		$exam_date   						= $this->input->post('exam_date[]');
		$time_from   						= $this->input->post('time_from[]');
		$time_to 							= $this->input->post('time_to[]');
		
		for($i=0; $i<$subject; $i++)
		{
		if($checked[$i]=='Y')
		{
		$datas['subject_id']    			= $subject_id[$i];
		$datas['exam_name']    				= $exam_name[$i];
		$datas['exam_date']    				= $exam_date[$i];
		$datas['time_from']    				= date('G:i',strtotime($time_from[$i]));
		$datas['time_to']    				= date('G:i',strtotime($time_to[$i]));
		
		$this->db->insert('tbl_exam_time_table_details' ,$datas);
		}
		}
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
		redirect('admin/exam_time_table'); 
	}
	function get_class_ajax($dept_id,$exam_title)
	{
		$data['exam_title']=urldecode($exam_title);
		$year	=	get_running_year();
		$this->db->where('dept_id',$dept_id);
		$this->db->where('academic_year',$year);
		$data['class']  = $this->db->get('class')->result_array();
		$this->load->view('admin/get_class',$data);
	}
	function get_time_table_ajax($class_id,$exam_title)
	{
		$data['exam_title']=urldecode($exam_title);
		$data['class_id']=$class_id;
		$year	=	get_running_year();
		$this->db->where('year',$year);
		$this->db->where('class_id',$class_id);
		$data['subject']  		= $this->db->get('subject')->result_array();
		$this->load->view('admin/exam_time_table',$data);
	}
	
	function get_classes($dept_id)
	{
		$year	=	get_running_year();
		$this->db->where('academic_year',$year);
		$this->db->where('dept_id',$dept_id);
		$class  = $this->db->get('class')->result_array();//echo $this->db->last_query();die();
		echo '<option value="">SELECT</option>';
		echo '<option value="0">ALL</option>';
		foreach ($class as $row) 
		{
			echo '<option value="'.$row['class_id'].'">'.$row['name'].'</option>';
		}
	}
	
	function edit_exam_time_table()
	{
		$this->db->trans_start();
		$exam_time_table_details_id    	= $this->input->post('exam_time_table_details_id');
		$data['exam_name']      		= $this->input->post('exam_name');
		$data['exam_date']      		= date('Y-m-d',strtotime($this->input->post('exam_date')));
		$data['time_from']				= $this->input->post('time_from');
		$data['time_to']        		= $this->input->post('time_to');
		
		$this->db->where('exam_time_table_details_id', $exam_time_table_details_id); 
		$this->db->update('tbl_exam_time_table_details',$data);
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
	
	function delete_exam_time_table()
	{
		$this->db->trans_start();
		$exam_time_table_details_id=$this->input->post('id');
		$this->db->where('exam_time_table_details_id', $exam_time_table_details_id);
		$this->db->delete('tbl_exam_time_table_details');
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
	
	function edit_exam_time_table_ajax($branch_id,$dept_id,$class_id)
	{
		$this->db->where('branch_id',$branch_id);
		$this->db->where('department_id',$dept_id);
		$this->db->where('class_id',$class_id);
		$data['subject']  = $this->db->get('view_exam_time_table')->result_array();
		$this->load->view('admin/exam_time_table_edit',$data);
	}

	function view_exam_time_table()
	{
		$this->load->view('admin/view_exam_time_table');
	}
	function exam_time_table_ajax($branch_id,$dept_id,$class_id,$exam_title)
	{
		$exam_title	=	urldecode($exam_title);
		$data['title']=$exam_title;
		$data['class_id']	=	$class_id;
		if($class_id==0)
		{
			$this->db->where('branch_id',$branch_id);
			$this->db->where('department_id',$dept_id);
			$this->db->where('exam_title',$exam_title);
			$data['subject']  = $this->db->get('view_exam_time_table')->result_array();
		}
		else
		{
			$this->db->where('branch_id',$branch_id);
			$this->db->where('department_id',$dept_id);
			$this->db->where('class_id',$class_id);
			$this->db->where('exam_title',$exam_title);
			$data['subject']  = $this->db->get('view_exam_time_table')->result_array();
		}
		$this->load->view('admin/exam_time_table_view',$data);
	}
	
	function exam_time_table_print($dept_id,$title,$current_class_id) 
	{
//	echo $current_class_id; die();
		$title					=	urldecode($title);
		$page_data['dept_id'] = $dept_id;
		$page_data['class_id'] = $current_class_id;
		$page_data['title'] = $title;
			//print_r($page_data);
		$this->db->where('class_id',$current_class_id);
		$this->db->where('exam_title',$title);
		$page_data['subject']  = $this->db->get('view_exam_time_table')->result_array();

		$this->load->view('admin/exam_time_table_print' , $page_data);
	}

	function hall_ticket()
	{
		$this->load->view('admin/view_hall_ticket');
	}
	
	function get_student($class_id)
	{
		$this->db->where('class_id',$class_id);
		$enroll = $this->db->get('enroll')->result_array();
		echo '<option value="">SELECT</option>';
		echo '<option value="0">ALL</option>';
		foreach($enroll as $r)
		{
		$student=$r['student_id'];
		 $sudent_name = $this->db->get_where('student' , array('student_id' => $student))->row()->name;
			echo '<option value="' . $student . '">' . $sudent_name . '</option>';
		}
	}
	
	function get_hall_ticket($class_id,$exam_title='')
	{
		$data['exam_title']=urldecode($exam_title);
		$data['class_id']=$class_id;
		$this->db->where('class_id',$class_id);
		$this->db->where('student_status_id','0');
		$data['student_data'] = $this->db->get('view_students')->result_array();
		$this->load->view('admin/hall_ticket',$data);
	}

	function set_exam_reg_no($student='',$reg='',$leng='')
	{
		$student	=	$this->input->post('student_id[]');
		$reg		=	$this->input->post('reg_no[]');
		$this->db->trans_start();
		$this->db->db_debug=FALSE;
		for($i=0; $i<count($student);$i++)
		{
			$data=array('exam_register_number'=>$reg[$i]);
			$this->db->where('student_id',$student[$i]);
			$this->db->update('student',$data);
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() !== FALSE)
		{
			echo "1";
		}	
		else
		{
			echo "0";
		}
	}
		
	function pdf_report_of_hall_ticket($class_id,$student_id,$title)
	{
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$data1								=	$_SESSION["data1"];
		$data1['title']						=	urldecode($title);
		$data1['class_id']					=	$class_id;
		if($student_id=='0')
		{
		$this->db->where('class_id',$class_id);
		$this->db->where('student_status_id','0');
		$data1['student_data'] 				= $this->db->get('view_students')->result_array();
		}
		else
		{
		$this->db->where('student_id',$student_id);
		$data1['student_data'] 				= $this->db->get('student')->result_array();
		}
		$html								=	$this->load->view('admin/view_pdf_hall_ticket',$data1,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'hall_ticket','I');	
	}


	function pdf_download_of_hall_ticket($class_id,$student_id,$title)
	{
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$data1								=	$_SESSION["data1"];
		$data1['title']						=	urldecode($title);
		$data1['class_id']					=	$class_id;
		if($student_id=='0')
		{
		$this->db->where('class_id',$class_id);
		$data1['student_data'] 				= $this->db->get('view_students')->result_array();
		}
		else
		{
		$this->db->where('student_id',$student_id);
		$data1['student_data'] 				= $this->db->get('student')->result_array();
		}
		$html								=	$this->load->view('admin/view_pdf_hall_ticket',$data1,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('Hall Ticket.pdf','D');	
	}
/******* TC and Hallticket End ***********/

/******* Admission Report Start **********/
	function admission_report()
	{
		$this->load->view('admin/admission_report');
	}
	function get_admission_report()
	{
		$data['branch_id']		=	$this->input->post('branch_id');
		$data['dept_id']		=	$this->input->post('dept_id');
		$data['class_id']		=	$this->input->post('class_id');
		$data['section_id']		=	$this->input->post('section_id');
		$data['from_date']		=	$this->input->post('from_date');
		$data['to_date']		=	$this->input->post('to_date');
		
		$data['result']		=	$this->crud_model->get_admission_report($data);
		$this->load->view('admin/admission_report_view',$data);
	}

	function admission_report_excel($branch_id,$dept_id,$class_id,$section_id,$from_date,$to_date)
	{
		$data['branch_id']		=	$branch_id;
		$data['dept_id']		=	$dept_id;
		$data['class_id']		=	$class_id;
		$data['section_id']		=	$section_id;
		$data['from_date']		=	$from_date;
		$data['to_date']		=	$to_date;
		$query_result			=	$this->crud_model->get_admission_report($data);
		ob_start();
		ob_get_clean();
		$filename = "AdmissionList.xls";
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
		echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".$this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year."</h3></b></td></tr>";
		echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>".get_class_name($class_id[0])."/" . get_section_name($section_id)."</h3></b></td></tr>";
		echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Admission No.</td><td colspan='1'  align='left'>Name</td>";
		echo "<td colspan='1'  align='left'>Date of Birth</td>";
		echo "<td colspan='1'  align='left'>Father's Name</td><td colspan='1'  align='left'>Class/Section</td><td colspan='1'  align='left'>Phone</td></tr>";
		
		foreach ($query_result as $data)
		{
		
		
			echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".$data['admission_number']."</td><td colspan='1'  align='left'>".$data['name'];
			echo "<td colspan='1'  align='left'>".$data['birthday']."</td>";
			echo "<td colspan='1'  align='left'>".$data['parent']."</td><td colspan='1'  align='left'>".get_student_class_name($data['student_id'])."/".get_student_section_name($data['student_id'])."</td><td colspan='1'  align='left'>".$data['phone1']."</td></tr>";
			
			//$dataToExports[]			= $arrangeData;
			$i=$i+1;
		
		}
		
		die();
	}

	function admission_report_pdf($branch_id,$dept_id,$class_id,$section_id,$from_date,$to_date)
	{
			$data['branch_id']		=	$branch_id;
			$data['dept_id']		=	$dept_id;
			$data['class_id']		=	$class_id;
			$data['section_id']		=	$section_id;
			$data['from_date']		=	$from_date;
			$data['to_date']		=	$to_date;
			$query_result			=	$this->crud_model->get_admission_report($data);
			
			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$data1['section_id']				=	$section_id;
			$data1['class_id']					=	$class_id;

			$data1['student_data'] 				= 	$query_result;
			//print_r($data1['student_data']);die;
			$html								=	$this->load->view('admin/pdf_admission_list',$data1,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output('admission_list.pdf','D');	
			die();
	}
	
/******* Admission Report End ***********/
/******* Directly added students start **/

	function directly_added_students()
	{
		$running_year		=	get_running_year();
		if($this->session->userdata('role')==1 ||$this->session->userdata('role')==2)
		{
			$this->db->where('academic_year',$running_year);
			$data['class']	=	$this->db->get('class')->result_array();
			
		}
		
		if($this->session->userdata('role')==3)
		{
			$branch			=	$this->session->userdata('branch_id');
			$this->db->where('academic_year',$running_year);
			$this->db->where('branch_id',$branch);
			$data['class']	=	$this->db->get('class')->result_array();
		
		}
		
		if($this->session->userdata('role')==4 ||  $this->session->userdata('role')==12)
		{
			$branch	=	$this->session->userdata('branch_id');
			$dept	=	$this->session->userdata('dept_id');
			
			$this->db->where('branch_id',$branch);
			$this->db->where('dept_id',$dept);
			$this->db->where('academic_year',$running_year);
			$data['class']=$this->db->get('class')->result_array();
			
		}
		$this->load->view('admin/student_view_directly_added.php',$data);
	}
/******* Directly added students end ***/

	function get_student_by_section($section_id)
	{
		$this->db->where('section_id',$section_id);
		$enroll = $this->db->get('enroll')->result_array();
		echo '<option value="">SELECT</option>';
		echo '<option value="all">ALL</option>';
		foreach($enroll as $r)
		{
		$student=$r['student_id'];
		 $sudent_name = $this->db->get_where('student' , array('student_id' => $student))->row()->name;
			echo '<option value="' . $student . '">' . $sudent_name . '</option>';
		}
	}
	
	
/******* Add Class from Modal start ************/
	public function insert_new_class($class_name,$dept_id,$branch_id)
	{
		$running_year = get_running_year();
		$role=$this->session->userdata('role');  
		$data['branch_id']		=	$branch_id;
		$data['dept_id']		=	$dept_id;
		$data['name']         	= 	urldecode($class_name);
		$data['academic_year']  = 	$running_year;
		
		$result					=	$this->db->insert('class',$data);
		
		$data2['class_id']  	=   $this->db->insert_id();
		$data2['name']      	=   'A';
		$data2['academic_year'] = 	$running_year;
		$result					=	$this->crud_model->manage_classes($data2);
		
		if($result>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	public function insert_new_section($section_name,$class_id,$dept_id,$branch_id)
	{
		$running_year = get_running_year();
		$data['name']      	 	=   urldecode($section_name);
		$data['class_id']   	=   $class_id;
	//	$data['teacher_id'] 	=   $this->input->post('teacher_id');
		$data['academic_year']	=  $running_year;
		$result					=	$this->db->insert('section',$data);
		if($result>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
/******* Add Class from Modal end ************/

/******* Expense settings start **************/

	 function expense_settings($action='')
	 {
	 	$data['action'] = $action;
		$data['expense'] = $this->db->get('tbl_expense_settings')->result_array();
		$this->load->view('admin/expense_settings',$data);
	 }
	 
	function expense_settings_edit()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
	 	$data['expense'] = $this->db->get('tbl_expense_settings')->result_array();
		$this->load->view('admin/expense_settings_edit',$data);
	}
	
	function edit_expense_settings()
	{
	 	$id = $this->input->post('id');
		$expense = array(
		'amount' 		=> $this->input->post('expense_limit'),
		'mobile_number' => $this->input->post('phone_number1'),
		);
		
		$this->db->where('id',$id);
		$affected_rows = $this->db->update('tbl_expense_settings',$expense);
		if($affected_rows>0)
		{
			$action = "edit";
		}
		redirect('admin/expense_settings/'.$action);

	}
	
	function expense_settings_delete()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$affected_rows = $this->db->delete('tbl_expense_settings');
		if($affected_rows>0)
		{
			$action = "delete";
		}
		redirect('admin/expense_settings/'.$action);
	}
	
	 function add_expense_settings()
	 {
		$this->load->view('admin/add_expense_settings');
	 }
	 
	 function set_expense_settings()
	 {
	 	$expense = array(
		'amount' 		=> $this->input->post('expense_limit'),
		'mobile_number' => $this->input->post('phone_number1'),
		'date' 			=> date('Y-m-d',strtotime($this->input->post('expense_date')))
		);
		
		$affected_rows = $this->db->insert('tbl_expense_settings',$expense);
		if($affected_rows>0)
		{
			$action = "success";
		}
		redirect('admin/expense_settings/'.$action);
		
	 }
	 
	 function check_date_exist($expense_date)
	 {
	 	$this->db->where('date',date('Y-m-d',strtotime($expense_date)));
	 	$result = $this->db->get('tbl_expense_settings')->result_array();
		if(count($result)>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	 }
	 
	function check_expense_limit($expence_value="",$expense_date)
	{
		$daily_limit = $this->db->get_where('tbl_expense_settings',array('date'=>date('Y-m-d',strtotime($expense_date))))->row();
		$limit = $daily_limit->amount;
		$mob_num = $daily_limit->mobile_number;
		if($expence_value>$limit)
		{
			$generator = "1357902468";
			$result = ""; 
  			$n="6";
			for ($i = 1; $i <= $n; $i++) 
			{ 
				$result .= substr($generator, (rand()%(strlen($generator))), 1);
			} 
			//	echo $result; 
				$this->session->set_userdata('otp', $result);
				
				
			$sms = $this->db->get('sms_settings')->row();
			$sender_id = $sms->sender_id;
			$username = $sms->username;
			$password = $sms->password;
			$common = $sms->common_word;
			$url = $sms->url;
			$web_url=$sms->web_url;
			
			$ph=$mob_num;
			$message= "Your OTP is :".$result;
			
				if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
				 	{
					$c= '1';
					}
					else
					{
					$c= '0';
					}
				$message	= $this->sms_helper($common,$c,"0","Admin",$message);


			$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
			$api = $url;
			$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
			$balance = stream_get_contents($handle);
			if ($balance >= 0) {
		
			$api . "/sendsms?" . $location;
			$send = fopen($api . "/sendsms?" . $location, "r");
			$api . "/sendsms?" . $location;
			
			$return_message_ids = stream_get_contents($send); // It is a number. If invalid mob, then its value is 'Enter valid MobileNo'
			$message_id_array = explode(",", $return_message_ids);
			
			$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT); //If $return_message_ids is string,this will not print anything. Otherwise it's value will be same as $return_message_ids 
			}

				
				$this->load->view('admin/insert_otp');
		}		
		else
		{
			echo "0";
		}
	}
/******* Expense settings end **************/
/******* Add Teacher from modal start ******/
	function get_teachers($branch_id,$dept_id)
	{
		if($this->session->userdata('role')==3)
		{
			$this->db->where('branch_id',$branch_id);
		}
		if($this->session->userdata('role')>=4)
		{
			$this->db->where('dept_id',$dept_id);
			$this->db->where('branch_id',$branch_id);
		}
		$this->db->where('role',6);
		$teachers = $this->db->get('staff')->result_array();
		echo '<option value="">Select Teacher</option>';
		foreach ($teachers as $row) 
		{
			echo '<option value="' . $row['staff_id'] . '">' . $row['name'] . '</option>';
		}

	}

    function check_username_exist($user_name)
    {
		$this->db->where('username',urldecode($user_name)); 
		$users=$this->db->get('tbl_users');
		if($users->num_rows()>0)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }

	function insert_new_teacher($teacher_name,$dept_id,$branch_id,$user_name,$password,$phone_number)
	{
		$data1['username']   	= urldecode($user_name);
		$data1['password']   	= sha1(urldecode($password));
		$data1['user_role_id'] 	= '6';
		$data1['created_by']	=	$this->session->userdata('login_user_id');
		$data1['created_date']	=	date('Y/m/d');
		$data1['branch_id']		=	$branch_id;
		$data1['dept_id']		=	$dept_id;
		
		$this->db->insert('tbl_users', $data1);
		$user_id = $this->db->insert_id();
			
		$data['name']        	= urldecode($teacher_name);
		$data['phone']       	= urldecode($phone_number);
		$data['username']   	= urldecode($user_name);
		$data['role']    		= '6';
		$data['user_id']		= $user_id;
		$data['branch_id']		= $branch_id;
		$data['dept_id']		= $dept_id;
			
  		$result = $this->db->insert('staff', $data);

		if($result>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
/******* Add Teacher from modal end ******/

	function get_birthday_details()
	{
		$this->load->view('admin/birthday_details');
	}
	function get_birthdays($from_date="",$to_date="")
	{
		$running_year = get_running_year();
		$data['date_from']= date("m-d",strtotime($from_date));
		$data['date_to']= date("m-d",strtotime($to_date));

		$this->db->select('student_id,name,birthday,class_name,section_name,year,student_status_id');
		$this->db->from('view_students');
		$this->db->where('student_status_id','0');
		$this->db->where('year',$running_year);
//		$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
	//	$this->db->where('s.dept_id',$this->session->userdata('dept_id'));
		$data['student']=$this->db->get()->result_array();
		
		$this->load->view('admin/get_birhdays',$data);
	}
	
	function birthday_detail_pdf()
	{
			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$from_date = $this->uri->segment(3);
			$from_date = $this->uri->segment(4);
			$running_year = get_running_year();
			$data['date_from']= date("m-d",strtotime($from_date));
			$data['date_to']= date("m-d",strtotime($to_date));
	
			$this->db->select('student_id,name,birthday,class_name,section_name,year,student_status_id');
			$this->db->from('view_students');
			$this->db->where('student_status_id','0');
			$this->db->where('year',$running_year);
	//		$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
		//	$this->db->where('s.dept_id',$this->session->userdata('dept_id'));
			$data['student']=$this->db->get()->result_array();
			$html								=	$this->load->view('admin/birthday_detail_pdf',$data,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output('Birthday_list.pdf','I');	
			die();
		
	}
	
//********** account start ***********//
	function view_account_heads()
	{
		$this->load->view('admin/account_heads_view');
	}
	
	function add_account_heads()
	{
		$this->load->view('admin/account_heads_add');
	}
	
	function account_heads_add()
	{
		$account = array(
		'account_head_name'		=> $this->input->post('account_head'),
		'account_group_id'		=> $this->input->post('account_group'),
		'account_section_id' 	=> $this->input->post('account_section'),
		'branch_id' 			=> $this->input->post('branch'),
		'department_id' 		=> $this->input->post('department'),
		'opening_balance'		=> $this->input->post('opening_balance')
		);
		
		$affected_row = $this->db->insert('tbl_account_head',$account);
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','added');
		}
		redirect('admin/view_account_heads/'.$action);
	}
	
	function account_heads_edit()
	{
		$account_head_id = $this->uri->segment(3);
		$this->db->where('account_head_id',$account_head_id);
		$data['account'] = $this->db->get('view_account_head')->result_array();

		$this->load->view('admin/account_heads_edit',$data);
	}	
	function account_heads_update()
	{
		$account_head_id = $this->input->post('account_head_id');
		
		$account = array(
		'account_head_name'		=> $this->input->post('account_head'),
		'account_group_id'		=> $this->input->post('account_group'),
		'account_section_id' 	=> $this->input->post('account_section'),
		'branch_id' 			=> $this->input->post('branch'),
		'department_id' 		=> $this->input->post('department'),
		'opening_balance'		=> $this->input->post('opening_balance')
		);

		$this->db->where('account_head_id',$account_head_id);
		$affected_row = $this->db->update('tbl_account_head',$account);
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','Updated');
		}
		redirect('admin/view_account_heads/'.$action);
	}
	
	function account_heads_delete($account_head_id)
	{
		$this->db->where('account_head_id',$account_head_id);
		$affected_row = $this->db->delete('tbl_account_head');
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','deleted');
		}
		redirect('admin/view_account_heads/'.$action);
	}
	
	function view_voucher()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		$data['voucher_type_id']="0";
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');
			$voucher_type1=$this->input->post('voucher_type');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			$data['voucher_type_id']=$voucher_type1;
			if($from_date1 && $to_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('day_book_date>=',$from_date);
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($voucher_type1)
			{
				 $this->db->where('voucher_type_id',$voucher_type1);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('day_book_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			if($this->session->userdata('branch_id'))
			{
				 $this->db->where('branch_id',$this->session->userdata('branch_id'));
			}
			if($this->session->userdata('dept_id'))
			{
				 $this->db->where('department_id',$this->session->userdata('dept_id'));
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('day_book_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		$this->load->view('admin/voucher_view',$data);
	}
	
	function voucher_edit()
	{
		$voucher_id = $this->uri->segment(3);
		$this->db->where('day_book_id',$voucher_id);
		$data['voucher'] = $this->db->get('view_account_day_book')->result_array();
		$this->load->view('admin/voucher_edit',$data);
	}

	function voucher_update()
	{
		$account_section = $this->session->userdata('account_section_id');

		$data['day_book_id']			= $this->input->post('day_book_id');
		$data['branch_id']				= $this->input->post('branch');
		$data['department_id']			= $this->input->post('department');
		$data['day_book_date'] 			= date("Y-m-d", strtotime($this->input->post ('voucher_date')));
		$data['voucher_type_id']		= $this->input->post('voucher_type');
		$data['voucher_number']			= $this->input->post('voucher_number');
		$data['account_head_id']		= $this->input->post('item_head');
		$data['transaction_mode_id']	= $this->input->post('transaction_mode');
		$amount_type					= $this->input->post('amount_types');
		if($amount_type == '2'){
		$data['debit_amount']			= $this->input->post('amount');
		$data['credit_amount']			= "0";
		} 
		else if($amount_type == '1'){
		$data['credit_amount']			= $this->input->post('amount');
		$data['debit_amount']			= "0";
		}
		$data['narration']				= $this->input->post('narration');
		
		$this->db->where('day_book_id',$data['day_book_id']);
		$affected_row = $this->db->update('tbl_account_day_book',$data);
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','Updated');
		}
		redirect('admin/view_voucher/');
	}
	
	function voucher_delete($day_book_id)
	{
		$deleted_by				= $this->session->userdata('login_user_id');
		$deleted_date			= date("Y-m-d");
		$this->db->where('day_book_id',$day_book_id);
		$this->db->set('deleted_by',$deleted_by);
		$this->db->set('deleted_date',$deleted_date);
		$this->db->set('is_deleted','Y');
		$affected_row = $this->db->update('tbl_account_day_book');
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','deleted');
		}
		redirect('admin/view_voucher/'.$action);
	}
	
	function add_voucher_single()
	{
		$this->load->view('admin/voucher_single');
	}
	
	function get_item_head($voucher_type,$dept)
	{
		$running_year = get_running_year();
		$this->db->where('department_id',$dept);
		if($this->session->userdata('account_section_id')!="1")
		{
			$this->db->where('account_section_id',$this->session->userdata('account_section_id')); 
		}
		if($voucher_type == "1"){
			$this->db->where('account_type_id','4'); 
		}
		if($voucher_type == "2"){
			$this->db->where('account_type_id','3'); 
		}
		if($voucher_type == "3"){
			$this->db->where('account_type_id','1'); 
		}
		$item_head  = $this->db->get('view_account_head')->result_array();//echo $this->db->last_query();die();
		echo '<option value="">Select</option>';
		foreach ($item_head as $row) 
		{
			echo '<option value="'.$row['account_head_id'].'">'.$row['account_head_name'].'</option>';
		}
	}
	
	function get_voucher_num($branch="",$dept="",$voucher_type="")
	{
		$account_section = $this->session->userdata('account_section_id');
		$query	=  $this->db->get_where("tbl_account_voucher_number", array('branch_id'=>$branch,'department_id'=>$dept,'accounting_section_id'=> $account_section,'voucher_type_id'=> $voucher_type))->row();
		//$voucher_number = $query->voucher_number;
		//echo $voucher_number;
		if($query)
		{
		$voucher_number = $query->voucher_number;
		echo $voucher_number;
		}
		else
		{
		echo "1";
		}
	}
	
	function voucher_single_add()
	{
		$account_section = $this->session->userdata('account_section_id');

		$data['branch_id']				= $this->input->post('branch');
		$data['department_id']			= $this->input->post('department');
		$data['day_book_date'] 			= date("Y-m-d", strtotime($this->input->post ('voucher_date')));
		$data['voucher_type_id']		= $this->input->post('voucher_type');
		$data['voucher_number']			= $this->input->post('voucher_number');
		$data['account_head_id']		= $this->input->post('item_head');
		$data['transaction_mode_id']	= $this->input->post('transaction_mode');
		$amount_type					= $this->input->post('amount_types');
		if($amount_type == '2'){
		$data['debit_amount']			= $this->input->post('amount');
		} 
		else if($amount_type == '1'){
		$data['credit_amount']			= $this->input->post('amount');
		}
		$data['narration']				= $this->input->post('narration');
		$data['created_by']				= $this->session->userdata('login_user_id');
		$data['created_date']			= date("Y-m-d");
		
		$affected_row = $this->db->insert('tbl_account_day_book',$data);
		if($affected_row>0)
		{
			$action = "added";
			$data['voucher_number'] = $data['voucher_number']+ 1;
			//echo $voucher_no;
			
			$this->db->set('voucher_number', $data['voucher_number']);
			$this->db->where('branch_id', $data['branch_id']);
			$this->db->where('department_id', $data['department_id']);
			$this->db->where('accounting_section_id', $account_section);
			$this->db->where('voucher_type_id', $data['voucher_type_id']);
			$this->db->update('tbl_account_voucher_number');
			if($this->db->affected_rows() == 0)
			{
				$data1['accounting_section_id'] = $account_section;
				$data1['voucher_type_id'] = $data['voucher_type_id'];
				$data1['branch_id'] = $data['branch_id'];
				$data1['department_id'] = $data['department_id'];
				$data1['voucher_number'] = $data['voucher_number'];
				
				$this->db->insert('tbl_account_voucher_number',$data1);
			}
		}

		redirect('admin/view_voucher/');
	}
	function voucher_bulk() 
	{
		$this->load->view('admin/voucher_bulk.php');
	}
	function voucher_bulk_add()
	{
		$transaction_date 		= date("Y-m-d", strtotime($this->input->post ('voucher_date')));
		$voucher_type_id		= $this->input->post('voucher_type');
		$account_head_id		= $this->input->post('item_head[]');
		$transaction_mode_id	= $this->input->post('transaction_mode[]');
		$amount					= $this->input->post('amount[]');
		$narration				= $this->input->post('narration[]');
		
		$voucher_count  = sizeof($amount);
		for($i = 0; $i < $voucher_count; $i++)
		{
		$data['transaction_date'] 		= date("Y-m-d", strtotime($this->input->post ('voucher_date')));
		$data['voucher_type_id']		= $this->input->post('voucher_type');

		$data['account_head_id']		= $account_head_id[$i];
		$data['transaction_mode_id']	= $transaction_mode_id[$i];
		if($voucher_type_id == '1'){
		$data['debit_amount']			= $amount[$i];
		} 
		else if($voucher_type_id == '2'){
		$data['credit_amount']			= $amount[$i];
		}
		$data['narration']				= $narration[$i];
		
		$affected_row = $this->db->insert('tbl_account_day_book',$data);
		}
	}
	function expense_report()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date1)
			{
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('account_type_id','4');
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
		 $this->db->where('account_type_id','4');
		 $this->db->order_by('day_book_date', 'DESC');
		$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		$this->load->view('admin/expense_report.php',$data);
	}
	
	function expense_report_pdf($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('account_type_id','4');
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('admin/expense_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'Expense_report.pdf','I');	
	}
	
	function expense_report_excel($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('account_type_id','4');
			 $this->db->order_by('day_book_date', 'DESC');
			$account = $this->db->get('view_account_day_book')->result_array();
				ob_start();
				ob_get_clean();
				$i=1;
				$credit_total=0;
				$debit_total=0;
				$image_url = base_url() . 'uploads/logo.png';
				echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
				
				echo "<tr><td colspan='7'></td></tr>";
				
				echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
				echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
				echo "<tr><td colspan='7' align='center'><h3></br>Expense Report</h3></td></tr>";	
				
				echo "<tr><td align='center'>Sl.No</td><td align='center'>Date</td><td align='center'>Voucher Number</td><td align='center'>Account Head</td><td align='center'>Credit Amount</td><td align='center'>Debit Amount</td><td align='center'>Narration</td></tr>";	
				foreach ($account as $data)
				{
				echo "<tr><td align='center'>".$i."</td><td align='center'>".date('d-m-Y',strtotime($data['day_book_date']))."</td><td align='center'>".$data['voucher_number']."</td><td align='center'>".$data['account_head_name']."</td><td align='center'>".$data['credit_amount']."</td><td align='center'>".$data['debit_amount']."</td><td align='center'>".$data['narration']."</td></tr>";	
					$i=$i+1;
					$credit_total=$credit_total+$data['credit_amount'];
					$debit_total=$debit_total+$data['debit_amount'];
				}
				echo "<tr><td colspan='4' align='center'>Total</td><td align='center'>".$credit_total."</td><td align='center'>".$debit_total."</td><td></td></tr>";	
				$filename = "ExpenseReport.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				die();
	}
	
	function income_report()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date1)
			{
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('account_type_id','3');
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
		 $this->db->where('account_type_id','3');
		 $this->db->order_by('day_book_date', 'DESC');
		$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		$this->load->view('admin/income_report.php',$data);
	}
	
	function income_report_pdf($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('account_type_id','3');
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('admin/income_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'Income_report.pdf','I');	
	}
	
	function income_report_excel($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('account_type_id','3');
			 $this->db->order_by('day_book_date', 'DESC');
			$account = $this->db->get('view_account_day_book')->result_array();
				ob_start();
				ob_get_clean();
				$i=1;
				$credit_total=0;
				$debit_total=0;
				$image_url = base_url() . 'uploads/logo.png';
				echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
				
				echo "<tr><td colspan='7'></td></tr>";
				
				echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
				echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
				echo "<tr><td colspan='7' align='center'><h3></br>Income Report</h3></td></tr>";	
				
				echo "<tr><td align='center'>Sl.No</td><td align='center'>Date</td><td align='center'>Voucher Number</td><td align='center'>Account Head</td><td align='center'>Credit Amount</td><td align='center'>Debit Amount</td><td align='center'>Narration</td></tr>";	
				foreach ($account as $data)
				{
				echo "<tr><td align='center'>".$i."</td><td align='center'>".date('d-m-Y',strtotime($data['day_book_date']))."</td><td align='center'>".$data['voucher_number']."</td><td align='center'>".$data['account_head_name']."</td><td align='center'>".$data['credit_amount']."</td><td align='center'>".$data['debit_amount']."</td><td align='center'>".$data['narration']."</td></tr>";	
					$i=$i+1;
					$credit_total=$credit_total+$data['credit_amount'];
					$debit_total=$debit_total+$data['debit_amount'];
				}
				echo "<tr><td colspan='4' align='center'>Total</td><td align='center'>".$credit_total."</td><td align='center'>".$debit_total."</td><td></td></tr>";	

				$filename = "IncomeReport.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				die();
	}

	function cash_book_report()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date1)
			{
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
		 $this->db->order_by('day_book_date', 'DESC');
		$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		$this->load->view('admin/cash_book_report.php',$data);
	}

	function cash_book_report_pdf($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('admin/cash_book_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'Cash_book_report.pdf','I');	
	}
	
	function cash_book_report_excel($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('day_book_date', 'DESC');
			$account = $this->db->get('view_account_day_book')->result_array();
				ob_start();
				ob_get_clean();
				$i=1;
				$credit_total=0;
				$debit_total=0;

				$image_url = base_url() . 'uploads/logo.png';
				echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
				
				echo "<tr><td colspan='7'></td></tr>";
				
				echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
				echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
				echo "<tr><td colspan='7' align='center'><h3></br>Cash Book Report</h3></td></tr>";	
				
				echo "<tr><td align='center'>Sl.No</td><td align='center'>Date</td><td align='center'>Voucher Number</td><td align='center'>Account Head</td><td align='center'>Credit Amount</td><td align='center'>Debit Amount</td><td align='center'>Narration</td></tr>";	
				foreach ($account as $data)
				{
				echo "<tr><td align='center'>".$i."</td><td align='center'>".date('d-m-Y',strtotime($data['day_book_date']))."</td><td align='center'>".$data['voucher_number']."</td><td align='center'>".$data['account_head_name']."</td><td align='center'>".$data['credit_amount']."</td><td align='center'>".$data['debit_amount']."</td><td align='center'>".$data['narration']."</td></tr>";	
					$i=$i+1;
					$credit_total=$credit_total+$data['credit_amount'];
					$debit_total=$debit_total+$data['debit_amount'];
				}
				echo "<tr><td colspan='4' align='center'>Total</td><td align='center'>".$credit_total."</td><td align='center'>".$debit_total."</td><td></td></tr>";	

				$filename = "CashBook.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				die();
	}

	function opening_balance()
	{
		$this->load->view('admin/set_opening_balance.php');
	}
	
	function set_opening_balance()
	{
		$account_head_id=$this->input->post('account_head_id[]');
		$opening_balance=$this->input->post('opening_balance[]');
		for($i=0;$i<count($account_head_id);$i++)
		{
			$data['account_head_id'] = $account_head_id[$i]; 
			$data['opening_balance'] = $opening_balance[$i];
			$this->db->where('account_head_id',$account_head_id[$i]);
			$this->db->set('opening_balance',$opening_balance[$i]);
			$affected_row = $this->db->update('tbl_account_head');
		}
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','updated');
		}
		redirect('admin/opening_balance/');
 	}

//********** account end ***********//
/*********** Test SMS Start *********/
	function send_test_sms()
	{
		if($this->input->post('send_sms'))
		{
			$phone			=	$this->input->post('phone');
			$message		=	$this->input->post('message');
			$is_malayalam	=	$this->input->post('is_malayalam');
			
			$sms 			= 	$this->db->get('sms_settings')->row();
			$sender_id 		= 	$sms->sender_id;
			
			$username 		= 	$sms->username;
			$password 		= 	$sms->password;
			$common 		= 	$sms->common_word;
			$url 			= 	$sms->url;
			$web_url		=	$sms->web_url;
			
			$location 		= 	'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$phone.'&msg=' . urlencode($message) . '&route=T';
			$api 			= 	$url;
			$handle 		= 	fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
			$balance 		= 	stream_get_contents($handle);
			if($balance>= 0) {
				if($is_malayalam=='')
				{
					$api . "/sendsms?" . $location;
					$send = fopen($api . "/sendsms?" . $location, "r");
					$api . "/sendsms?" . $location;
				}
				else if($is_malayalam=='on')
				{
					$api . "/sendunicodesms?" . $location;
					$send = fopen($api . "/sendunicodesms?" . $location, "r");
					$api . "/sendunicodesms?" . $location;
				}
			}
		}
		redirect('admin');
	}
/*********** Test SMS End ***********/

	function clerk_dashboard()
	{
		$this->load->view('admin/clerk_dashboard');
	}
	function all_fee_report()
	{
		$this->load->view('admin/clerk_wise_fee_report');
	}
	
	function get_clerk_wise_fee_report($from_date="",$to_date="")
	{
                $year=get_running_year();
		$condition ='';
		if($from_date!="")
		{
			$condition = $condition." WHERE collected_date >= '".date('Y-m-d',strtotime($from_date))."'";
		}
		if($to_date!="")
		{
			$condition = $condition." AND collected_date <= '".date('Y-m-d',strtotime($to_date))."'";
		}
                $condition = $condition." and academic_year_id=".$year;
		$data['fee'] = $this->db->query('SELECT SUM( amount_paid ) AS amount_paid ,collected_date ,collected_by FROM view_all_fees_by_clerk'.$condition.' GROUP BY collected_date, collected_by ORDER BY collected_date DESC')->result_array();
		
		$data['total_fee'] = $this->db->query('SELECT SUM( amount_paid ) AS amount_paid ,collected_date ,collected_by FROM view_all_fees_by_clerk'.$condition.' GROUP BY  collected_by')->result_array();
			
		$this->load->view('admin/clerk_wise_fee_report1',$data);
	}
		function upload_student_excel()
		{
		$this->load->view('admin/stud_excel');
		}
		
		function upload_student_excel_data()
		{
			
		 $class=$this->input->post('class_id');
		 $section=$this->input->post('section_id');
		
		if(isset($_POST["import"]))
			{

	 
		
          $filename=$_FILES["file"]["tmp_name"];
         
        
        if($_FILES["file"]["size"] > 0)
          {
              
            $file = fopen($filename, "r");
			
			$i=1;
			
             while (($importdata = fgetcsv($file)) !== FALSE)
             {
			    if($i>1){
			        
				
				
				        
						
                     	$data['admission_number'] 		= $importdata[2];
						$data['birthday'] 	= $importdata[5];
						$data['parent'] 	=strtok($importdata[7], ',');
						
						$data['address']    =$importdata[7];
						
						$this->db->where('s.name',$importdata[3]);
					    $this->db->where('e.class_id',$class);
					    $this->db->where('e.section_id',$section);
						$this->db->join('enroll e','e.student_id=s.student_id','LEFT');
						$student_id=$this->db->get('student s')->row();
						
						if(count($student_id)>0)
					   {
					  $this->db->where('student_id',$student_id->student_id);
						$this->db->update('student',$data);
					   }
						
						 	
						 
						}
						
						$i++;
             
             }                    
            fclose($file);
          }
		}
		redirect('Admin/upload_student_excel/');

	}
	function get_birthday()
	{
		$data['date']		=	$this->input->post('date');
		$year				=	get_running_year();
		
		$data['birth_month']=	date("m-d",strtotime($data['date']));
		$this->db->select('s.student_id,s.name as student,s.birthday as month,c.name as class,t.name as section');
		$this->db->from('student s');
		$this->db->join('enroll e','s.student_id=e.student_id','LEFT');
		$this->db->join('class c','c.class_id=e.class_id','LEFT');
		$this->db->join('section t','t.section_id=e.section_id','LEFT');
		$this->db->where('e.year',$year);
		$this->crud_model->check_student_status();
		//$this->db->where('s.branch_id',$this->session->userdata('branch_id'));
		//$this->db->where('s.dept_id',$this->session->userdata('dept_id'));
		$data['query']		=	$this->db->get()->result_array();//echo $this->db->last_query();die();
		//print_r($data['query']);die();
		$this->load->view('admin/view_birthdays',$data);
		
		
	}
	
	function rank_message_individual()
	{	
		$running_year = get_running_year();
		$rank			=	$this->input->post('rank[]');
		$class_id			=	$this->input->post('class_id');
		$section_id			=	$this->input->post('section_id');
		$exam_id			=	$this->input->post('exam_id');
		$total			=	$this->input->post('mark[]');
		$stud_ids			=	$this->input->post('stud_id_check[]');
		
				$sms = $this->db->get('sms_settings')->row();
				$sender_id = $sms->sender_id;
				$username = $sms->username;
				$password = $sms->password;
				$common = $sms->common_word;
				$url = $sms->url;
				$content = "exam";
				$user_id	= $this->session->userdata('login_user_id');
				$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
				$datas['send_by']	=$staff;
				$datas['content']	=  $content;
				date_default_timezone_set("Asia/Kolkata");
				$datas['send_date']	=  date('Y/m/d H:i:s');
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

		$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();

		$this->db->select('r.rank_id,r.class_id,r.total_marks,r.section_id,r.exam_id,e.enroll_id,e.enroll_code,e.student_id as student_id,e.roll,e.date_added,e.year');
		$this->db->from('ranks r');
		$this->db->join('enroll e', 'r.student_id=e.student_id', 'LEFT');
		 $this->db->join('student s', 's.student_id=e.student_id', 'LEFT');
		$this->db->order_by('r.total_marks','desc');
		$this->db->where('r.class_id',$class_id);
		$this->db->where('e.year',$running_year);
		$this->db->where('r.section_id',$section_id);
		$this->db->where('r.exam_id',$exam_id);
		$this->db->where_in('s.student_id',$stud_ids);
		$this->crud_model->check_student_status();
		$query = $this->db->get();
		$students = $query->result_array();

		$counter = 1;$rank =1;
		$previous=0;
		$current=0;
		foreach($students as $row)
		{
		    $sum=0;
			$total_marks = 0;  
			foreach($subjects as $row2)
			{
				$marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
				if($marks->num_rows() > 0) 
				{
					$obtained_marks = $marks->row()->mark_obtained;
					
					$total_marks += $obtained_marks;
					
					$mark_total = $marks->row()->mark_total;
					//echo $obtained_marks;
					$total_marks += $mark_total;
					//echo $obtained_marks .'/'.$mark_total;
				}
			}
			$sum=$sum+$total_marks;
			$a=$sum-$row['total_marks'];
			$marks = $row['total_marks'].'/'.$a;
			$current=$sum;
			
			if($total_marks !='0')
			{
				if($current<$previous)
				{
					$rank=$rank+1;
				}
				$previous=$current;

				$this->db->where('exam_id',$exam_id);
				$exam_name1=$this->db->get('exam')->row();
			 	$exam_name=$exam_name1->name;
		
				$this->db->where('student_id',$row['student_id']);
				$exam_student_name=$this->db->get('student')->row();
				$student_name=$exam_student_name->name;
				$student_number=$exam_student_name->phone1;
				$student_number2=$exam_student_name->phone2;
			 	$text="Student Name : ".$student_name." Exam : ".$exam_name;
				$msg="Rank -".$rank;
			 
				if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
				{
					$subject_student="Total Marks:  " . $marks.' '.$msg;
				}
				else
				{
					$subject_student="Total Marks:  " . $marks.' '.$msg;
				}
				$text=$text.' '.$subject_student;
						
				//echo $text."<br />";
				
				$data1['sms_master_id']	=$master_id;
				$data1['student_id']	=$row['student_id'];
				
				$data1['class_id']		=$class_id;
				$data1['section_id']	=$section_id;
				$data1['phone']			=$student_number;
				$data1['msg_content']	=$this->sms_helper1($common,$c,$text);
				date_default_timezone_set("Asia/Kolkata");
				$data1['send_date']		=  date('Y/m/d H:i:s');
				$this->db->insert('tbl_sms_delivery_details',$data1);
			
		//	if($phone2==1)
		//	{
		//		if($student_number2!='')
		//		{
		//		
		//			//$data2['sms_master_id']	=$master_id;
		//			
		//			$data2['student_id']	=$row['student_id'];
		//			
		//			$data2['class_id']	=$class_id;
		//			$data2['section_id']	=$section_id;
		//			$data2['phone']	=$student_number2;
		//			$data2['msg_content']	=$this->sms_helper1($common,$c,$text);
		//			date_default_timezone_set("Asia/Kolkata");
		//			$data2['send_date']	=  date('Y/m/d H:i:s');
		//			//$this->db->insert('tbl_sms_delivery_details',$data2);
		//		}
		//	}
			}					
		}				
					
		$data['master_id']	=	$master_id;	
		$data['class_id']	=	$class_id;
		$data['section_id']	=	$section_id;
		$data['exam_id']	=	$exam_id;
		$this->load->view('admin/message_popup_exam_rank',$data);
	}
	
////////////////////////////////////// By Moby(06/07/2020)////////////////////////////////////////////////////	
	
	function student_certificate(){
		$this->load->view('admin/add_certificates');
	}
	
	function add_certificate(){
		$data['certificate_name']	=	$this->input->post('certificate_name');
		$affected_row = $this->db->insert('student_certificates',$data);
		redirect('Admin/student_certificate/');
	}
	
	function check_certificate_exist($cetificate){
		$this->db->where('certificate_name',urldecode($cetificate));
		$res = $this->db->get('student_certificates')->result_array();
		if(count($res)>0){
			echo "1";
		} else {
			echo "0";
		}
	}

	function certificate_delete($certificate_id){
		$this->db->where('certificate_id',$certificate_id);
		$affected_row = $this->db->delete('student_certificates');
		redirect('Admin/student_certificate/');
	}	

	function certificate_edit($certificate_id){
		$data['certificate_name']	=	$this->input->post('certificate_name1');
		$this->db->where('certificate_id',$certificate_id);
		$affected_row = $this->db->update('student_certificates',$data);
		redirect('Admin/student_certificate/');
	}	

	function issue_certificate(){
        $data['action'] = $this->session->flashdata('action');
		$this->load->view('admin/certificate_issue',$data);
	}
	
	function get_submitted_certificates($student_id){
		$data['student_id']= $student_id;
		$data['certificate']= $this->db->get('student_certificates')->result_array();
		$data['certificates_id'] = $this->db->get_where('student',array('student_id'=>$student_id))->row()->certificates_submitted;
		$this->load->view('admin/certificates_submitted_data',$data);
	}

	function certificate_issue($student_id){
		date_default_timezone_set("Asia/Kolkata");
	    $year   					=   get_running_year();
		$data['student_id']			=	$this->input->post('student_id');
		$data['academic_year_id']	=	$year;
		$data['issued_on']			=	date("Y-m-d H:i:s");
		$this->db->insert('tbl_certificate_issue_master',$data);
		$issue_id	=	$this->db->insert_id();
		
		$certificate				=	$this->input->post('certificate[]');
		foreach($certificate as $c){
			$data1['issue_master_id']	=	$issue_id;
			$data1['certificate_id']	=	$c;
			$this->db->insert('tbl_certificate_issue_details',$data1);
		}
		$action	=	"success";
		$this->session->set_flashdata('action',$action);
		redirect('Admin/issue_certificate/');
	}

	function return_certificate(){
        $data['action'] = $this->session->flashdata('action');
		$this->load->view('admin/certificate_return',$data);
	}
	
	function get_certificates_issued_students($section_id){
		$this->db->where('section_id',$section_id);
		$enroll = $this->db->get('enroll')->result_array();
//		print_r($enroll);die;
		$query  = "(select a.student_id"
				. " from tbl_certificate_issue_master a "
				. "join tbl_certificate_issue_details b on b.issue_master_id=a.issue_master_id "
				. "where b.return_date='0000-00-00 00:00:00' group by a.student_id)";
		$cert = $this->db->query($query)->result_array();
//		print_r($cert);die;

		echo '<option value="">SELECT</option>';
		foreach($enroll as $r)
		{
			foreach($cert as $r1)
			{
				if($r['student_id']==$r1['student_id']){
					$sudent_name = $this->db->get_where('student' , array('student_id' => $r['student_id']))->row()->name;
					echo '<option value="' . $r['student_id'] . '">' . $sudent_name . '</option>';
				}
			}
		}
	}
	
	function get_issued_certificates($student_id){
		$data['certificate']= $this->db->get('student_certificates')->result_array();
		$query  = "(select a.student_id,b.certificate_id,b.issue_details_id"
				. " from tbl_certificate_issue_master a "
				. "join tbl_certificate_issue_details b on b.issue_master_id=a.issue_master_id "
				. "where b.return_date='0000-00-00 00:00:00' and a.student_id=".$student_id.")";
		$data['issued'] = $this->db->query($query)->result_array();
		$this->load->view('admin/certificates_issued',$data);
	}
	
	function certificate_return(){
		date_default_timezone_set("Asia/Kolkata");
		
		$certificate				=	$this->input->post('certificate[]');
		foreach($certificate as $c){
			$data['return_date']		=	date("Y-m-d H:i:s");
			$this->db->where('issue_details_id',$c);
			$this->db->update('tbl_certificate_issue_details',$data);
		}
		$action	=	"success";
		$this->session->set_flashdata('action',$action);
		redirect('Admin/return_certificate/');
	}

	function certificate_issue_return_report(){
		$this->load->view('admin/certificate_issue_return_report');
	}
	
	function certificate_issue_return_data()
	{
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
		$department 			= $this->uri->segment(5); 
		$class_id 				= $this->uri->segment(6);
		$section_id 			= $this->uri->segment(7);
		$student_id 			= $this->uri->segment(8);
		$data['department'] 	= 	$department; 
		$data['class_id'] 		= 	$class_id;
		$data['section_id'] 	= 	$section_id;
		$data['from_date'] 		= 	$from_date;
		$data['to_date'] 		= 	$to_date;
		$data['certificate']    =   $this->crud_model->certificate_issue_return_data($department,$class_id,$section_id,$from_date,$to_date,$student_id);
		$this->load->view('admin/certificate_issue_return_data.php',$data);
	}
	
	function certificate_issue_return_pdf()
	{
		ob_start();
		$html 					=	ob_get_clean();
		$html 					= 	utf8_encode($html);
		
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
		$department 			= $this->uri->segment(5); 
		$class_id 				= $this->uri->segment(6);
		$section_id 			= $this->uri->segment(7);
		$data['certificate']    =   $this->crud_model->certificate_issue_return_data($department,$class_id,$section_id,$from_date,$to_date);
        $html  					=  $this->load->view('admin/certificate_issue_return_report_pdf.php',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
		$mpdf 					= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->allow_charset_conversion 		= true;
		$mpdf->charset_in = 'UTF-8';
		$mpdf->WriteHTML($html);
		$mpdf->Output($data['data'][0]->reference_no.'Certificate Issue Return report.pdf','I');	//  I for view or create pdf  and D for download	
	}
	function certificate_issue_return_excel()
	{
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
		$department 			= $this->uri->segment(5); 
		$class_id 				= $this->uri->segment(6);
		$section_id 			= $this->uri->segment(7);
		$data['certificate']    =   $this->crud_model->certificate_issue_return_data($department,$class_id,$section_id,$from_date,$to_date);

            $i=1;
            ob_start();
            ob_get_clean();
            $filename = "CertificateIssueReturnReport.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
            //$this->exportExcelData($dataToExports);
            $total = 0;
            $i=1;
            $image_url = base_url() . 'uploads/logo.png';
            echo  "<table border='0'><tr><td colspan='3'></td><td colspan='1' align='center'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='3'></td></tr>";
            echo "<tr><td colspan='3'></td></tr>";
            //$dataToExports = [];
            echo  "<table border='0'><tr><td colspan='7' align='center'></td></tr>";
            echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
            echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>Certificate Issue Return Report</h3></b></td></tr>";
            echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Student Name</td><td colspan='1'  align='left'>Class</td><td colspan='1'  align='left'>Section</td><td colspan='1'  align='left'>Certificate Issued</td><td colspan='1'  align='left'>Issue Date</td><td colspan='1'  align='left'>Return Date</td></tr>";
            foreach ($data['certificate'] as $row)
            {
				if($row['return_date']!='0000-00-00 00:00:00'){ $return = date('d-m-Y',strtotime($row['return_date'])); } else { $return = ''; }
                    echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".$row['name']."</td><td colspan='1'  align='left'>".$row['class_name']."</td><td colspan='1'  align='left'>".$row['section_name']."</td><td colspan='1'  align='left'>".$this->db->get_where('student_certificates',array('certificate_id'=>$row['certificate_id']))->row()->certificate_name."</td><td colspan='1'  align='left'>".date('d-m-Y',strtotime($row['issued_on']))."</td></td><td colspan='1'  align='left'>".$return."</td></tr>";
                    //$dataToExports[]			= $arrangeData;
                    $i=$i+1;
            }
            die();
	}

	function student_certificate_report(){
		$this->load->view('admin/student_certificate_report');
	}
	
	function student_certificate_data(){
		$department 			= $this->uri->segment(3); 
		$class_id 				= $this->uri->segment(4);
		$section_id 			= $this->uri->segment(5);
		$student_id 			= $this->uri->segment(6);
		$data['department'] 	= 	$department; 
		$data['class_id'] 		= 	$class_id;
		$data['section_id'] 	= 	$section_id;
		$data['student_id']		= 	$student_id;
		$data['certificate_submitted']    =   $this->crud_model->student_certificate_data($department,$class_id,$section_id,$student_id);
		$data['certificate']= $this->db->get('student_certificates')->result_array();
		$this->load->view('admin/student_certificate_data.php',$data);
	}
	
	function set_yearly_opening_balance()
	{
		$data['opening']	=	$this->db->get('yearly_opening_balance')->result_array();
		$this->load->view('admin/yearly_opening_balance',$data);
	}
	
	function check_op_balance_exist($year_id){
		$this->db->where('financial_year',$year_id);
		$res = $this->db->get('yearly_opening_balance')->result_array();
		if(count($res)>0){
			echo "1";
		} else {
			echo "0";
		}
	}
	
	function add_yearly_opening_balance(){
		$data['financial_year']		=	$this->input->post('year');
		$data['amount']				=	$this->input->post('amount');
		$data['department_id']		=	$this->input->post('department');
		$data['created_by']		=	$this->session->userdata('login_user_id');
		$data['created_date']		=	date('Y-m-d');
		$this->db->insert('yearly_opening_balance',$data);
		redirect('Admin/set_yearly_opening_balance/');
	}
	
	function closing_balance(){
	    $year   				=   get_running_year();
		$financial_year			=	$this->db->get_where('tbl_financial_year',array('is_active'=>'Y'))->row()->financial_year_id;
		$balance_date			=	date('Y-m-d');
		$data['balance_date'] 	= 	date('Y-m-d');
		$op	=	$this->db->get_where('tbl_closing_balance',array('year'=>$year))->result_array();
		if(count($op)<=0){
			$op_balance	=	$this->db->get_where('yearly_opening_balance',array('financial_year'=>$financial_year))->result_array();
			if(count($op_balance)<=0){
				$opening_balance	=	0;
			} else {
				$opening_balance	=	$this->db->get_where('yearly_opening_balance',array('financial_year'=>$financial_year))->row()->amount;
			}
		} else {
			//$opening_balance	=	$this->db->get_where('tbl_closing_balance',array('closing_balance_date=>MAX(closing_balance_date)'))->row()->closing_balance;
			$this->db->select('closing_balance_date,closing_balance,opening_balance');
			$this->db->order_by("closing_balance_date", "desc");
			$this->db->limit(1);
			$opening_balance	=$this->db->get('tbl_closing_balance')->row()->closing_balance;
			//echo $opening_balance;die;
		}
				//echo $this->db->last_query();die;

		$role=$this->session->userdata('role');
		$this->db->select('SUM(a.fee_amount) as fee_amount');
		$this->db->join('student b','b.student_id=a.admission_number');
		if($role ==3)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
		}
		if($role >=4)
		{
			$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
		}
		if($balance_date!='' && $balance_date!=0)
		{
			 $this->db->where('DATE_FORMAT(a.date_paid,"%Y-%m-%d")',date("Y-m-d", strtotime($balance_date)));
		}
		$this->db->from('view_fee_collection_details a');
		//$this->db->where('DATE_FORMAT(a.date_paid,"%Y-%m-%d")',date('Y-m-d'));
		$this->db->where('a.academic_year_id',$year);
		$fee				=	$this->db->get()->row()->fee_amount;
		$special_fee		=	0;
		$transport_fee		=	0;
		if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes')
		{
			$this->db->select('SUM(a.fee_amount) as fee_amount');
			$this->db->join('student b','b.student_id=a.student_id');
			if($role ==3)
			{
				$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			}
			if($role >=4)
			{
				$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
			}
			if($balance_date!='' && $balance_date!=0)
			{
				 $this->db->where('a.date_paid',date("Y-m-d", strtotime($balance_date)));
			}
			$this->db->from('tbl_special_fee_collection_master a');
			$this->db->where('a.academic_year_id',$year);
			$special_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
		}
		if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes')
		{
			$this->db->select('SUM(a.amount_paid) as fee_amount');
			$this->db->join('tbl_transport_students_bus_fee_collection_master b','b.bus_fee_collection_master_id = a.bus_fee_collection_master_id');
			if($role ==3)
			{
				$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
			}
			if($role >=4)
			{
				$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('a.dept_id',$this->session->userdata('dept_id'));
			}
			if($balance_date!='' && $balance_date!=0)
			{
				 $this->db->where('a.date_paid',date("Y-m-d", strtotime($balance_date)));
			}
			$this->db->from('view_transport_students_bus_fee_collection_details a');
			//$this->db->where('a.date_paid',date('Y-m-d'));
			$this->db->where('b.academic_year',$year);
			$transport_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
		}
			//Opening balance
			$where = '';
			$select =   "sum(amount_paid) as amount_paid";
			if($balance_date!='' && $balance_date!=0)
			{
				$where  =   $where." DATE_FORMAT(date_paid,'%Y-%m-%d')='" . date("Y-m-d", strtotime($balance_date)) . "'";
			}
			$where  =   $where . " and paid_year_id=".$year." and is_deleted='N'";
			if($role >= 4)
			{
				$where  =   $where." and dept_id=". $this->session->userdata('dept_id');
			}
			$query_result3      =   $this->Fee_management_model->view_opening_balance_collection($select,$where)->row();
			$op_bal             =  	$query_result3->amount_paid;
			$income				=	$special_fee+$transport_fee+$fee+$op_bal;

			//expense
			$this->db->select('SUM(a.amount) as amount');
			$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
			$this->db->where('a.is_deleted','N');
			if($balance_date!='' && $balance_date!=0)
			{
				 $this->db->where('a.expense_date',date("Y-m-d", strtotime($balance_date)));
			}
//			$this->db->where('a.expense_date',date('Y-m-d'));
			$this->db->join('tbl_department d','d.dept_id=a.dept_id');
			$this->db->order_by('a.expense_date','desc');
			
			$exp					=	$this->db->get('tbl_add_expense a')->row();
			$expense				=	$exp->amount;
			
			$data['opening_balance']=	$opening_balance;
			$data['income']			=	$income;
			$data['$expense']		=	$expense;
			
			$data['total_amount'] = $opening_balance + $income - $expense;

		$this->load->view('admin/closing_balance',$data);
	}

	function get_balances($balance_date){
		$year   				=   get_running_year();
		$financial_year			=	$this->db->get_where('tbl_financial_year',array('is_active'=>'Y'))->row()->financial_year_id;
		$value	=	$this->db->get_where('tbl_closing_balance',array('closing_balance_date'=>date('Y-m-d',strtotime($balance_date))))->result_array();
		if(count($value)<=0){
			$data['balance_date']= $balance_date;
			$op	=	$this->db->get_where('tbl_closing_balance',array('year'=>$year))->result_array();
			if(count($op)<=0){
				$op_balance	=	$this->db->get_where('yearly_opening_balance',array('financial_year'=>$financial_year))->result_array();
				if(count($op_balance)<=0){
					$opening_balance	=	0;
				} else {
					$opening_balance	=	$this->db->get_where('yearly_opening_balance',array('financial_year'=>$financial_year))->row()->amount;
				}
			} else {
				$this->db->select('closing_balance_date,closing_balance,opening_balance');
				$this->db->order_by("closing_balance_date", "desc");
				$this->db->limit(1);
				$opening_balance	=$this->db->get('tbl_closing_balance')->row()->closing_balance;
			}
	
			$role=$this->session->userdata('role');
			$this->db->select('SUM(a.fee_amount) as fee_amount');
			$this->db->join('student b','b.student_id=a.admission_number');
			if($role ==3)
			{
				$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
			}
			if($role >=4)
			{
				$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
			}
			if($balance_date!='' && $balance_date!=0)
			{
				 $this->db->where('DATE_FORMAT(a.date_paid,"%Y-%m-%d")',date("Y-m-d", strtotime($balance_date)));
			}
			$this->db->from('view_fee_collection_details a');
			//$this->db->where('DATE_FORMAT(a.date_paid,"%Y-%m-%d")',date('Y-m-d'));
			$this->db->where('a.academic_year_id',$year);
			$fee				=	$this->db->get()->row()->fee_amount;
			$special_fee		=	0;
			$transport_fee		=	0;
			if($this->db->get_where('settings' , array('type' =>'special_fee'))->row()->description == 'yes')
			{
				$this->db->select('SUM(a.fee_amount) as fee_amount');
				$this->db->join('student b','b.student_id=a.student_id');
				if($role ==3)
				{
					$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
				}
				if($role >=4)
				{
					$this->db->where('b.branch_id',$this->session->userdata('branch_id'));
					$this->db->where('b.dept_id',$this->session->userdata('dept_id'));
				}
				if($balance_date!='' && $balance_date!=0)
				{
					 $this->db->where('a.date_paid',date("Y-m-d", strtotime($balance_date)));
				}
				$this->db->from('tbl_special_fee_collection_master a');
				$this->db->where('a.academic_year_id',$year);
				$special_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
			}
			if($this->db->get_where('settings' , array('type' =>'transportation'))->row()->description == 'yes')
			{
				$this->db->select('SUM(a.amount_paid) as fee_amount');
				$this->db->join('tbl_transport_students_bus_fee_collection_master b','b.bus_fee_collection_master_id = a.bus_fee_collection_master_id');
				if($role ==3)
				{
					$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				}
				if($role >=4)
				{
					$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
					$this->db->where('a.dept_id',$this->session->userdata('dept_id'));
				}
				if($balance_date!='' && $balance_date!=0)
				{
					 $this->db->where('a.date_paid',date("Y-m-d", strtotime($balance_date)));
				}
				$this->db->from('view_transport_students_bus_fee_collection_details a');
				//$this->db->where('a.date_paid',date('Y-m-d'));
				$this->db->where('b.academic_year',$year);
				$transport_fee	=	$this->db->get()->row()->fee_amount;//echo $this->db->last_query();
			}
				//Opening balance
				$where = '';
				$select =   "sum(amount_paid) as amount_paid";
				if($balance_date!='' && $balance_date!=0)
				{
					$where  =   $where." DATE_FORMAT(date_paid,'%Y-%m-%d')='" . date("Y-m-d", strtotime($balance_date)) . "'";
				}
				$where  =   $where . " and paid_year_id=".$year." and is_deleted='N'";
				if($role >= 4)
				{
					$where  =   $where." and dept_id=". $this->session->userdata('dept_id');
				}
				$query_result3      =   $this->Fee_management_model->view_opening_balance_collection($select,$where)->row();
				$op_bal             =  	$query_result3->amount_paid;
				$income				=	$special_fee+$transport_fee+$fee+$op_bal;
	
				//expense
				$this->db->select('SUM(a.amount) as amount');
				$this->db->where('a.branch_id',$this->session->userdata('branch_id'));
				$this->db->where('a.is_deleted','N');
				if($balance_date!='' && $balance_date!=0)
				{
					 $this->db->where('a.expense_date',date("Y-m-d", strtotime($balance_date)));
				}
	//			$this->db->where('a.expense_date',date('Y-m-d'));
				$this->db->join('tbl_department d','d.dept_id=a.dept_id');
				$this->db->order_by('a.expense_date','desc');
				
				$exp					=	$this->db->get('tbl_add_expense a')->row();
				$expense				=	$exp->amount;
				
				$data['opening_balance']=	$opening_balance;
				$data['income']			=	$income;
				$data['$expense']		=	$expense;
				$data['total_amount'] 	= 	$opening_balance + $income - $expense;
				$data['exist']	=	1;
			} else	{
				$data['exist']	=	0;
			}
			echo json_encode($data);

	}
	
	function close_balance(){
	    $year   					=   get_running_year();
		$data['closing_balance_date']=	date('Y-m-d',strtotime($this->input->post('balance_date')));
		$data['income']				=	$this->input->post('income');
		$data['expense']			=	$this->input->post('expense');
		$data['opening_balance']	=	$this->input->post('opening_balance');
		$data['closing_balance']	=	$this->input->post('closing_balance');
		$data['year']				=	$year;
		$this->db->insert('tbl_closing_balance',$data);
		redirect('Admin/closing_balance/');
	}
	
	function closing_balance_report(){
	    $year   			=   get_running_year();
		if($this->input->post())
		{
			$from_date	=	$this->input->post('from_date');
			$to_date	=	$this->input->post('to_date');
		}
		else{
			$from_date	=	'';
			$to_date	=	'';
		}
		$data['from_date'] 	= $from_date;
		$data['to_date']	= $to_date;
		if($from_date!='' && $from_date!=0)
		{
			 $this->db->where('closing_balance_date>=',date("Y-m-d", strtotime($from_date)));
		}
		if($to_date!='' && $to_date!=0)
		{
			$this->db->where('closing_balance_date<=',date("Y-m-d", strtotime($to_date)));
		}
		$this->db->where('year',$year);
		$data['close']		=	$this->db->get('tbl_closing_balance')->result_array();
		$this->load->view('admin/closing_balance_report',$data);
	}

	function closing_balance_report_excel()
	{
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
	    $year   			=   get_running_year();
		if($from_date!='' && $from_date!=0)
		{
			 $this->db->where('closing_balance_date>=',date("Y-m-d", strtotime($from_date)));
		}
		if($to_date!='' && $to_date!=0)
		{
			$this->db->where('closing_balance_date<=',date("Y-m-d", strtotime($to_date)));
		}
		$this->db->where('year',$year);
		$data['close']		=	$this->db->get('tbl_closing_balance')->result_array();

            $i=1;
            ob_start();
            ob_get_clean();
            $filename = "ClosingBalance.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
            //$this->exportExcelData($dataToExports);
            $total = 0;
            $i=1;
            $image_url = base_url() . 'uploads/logo.png';
            echo  "<table border='0'><tr><td colspan='3'></td><td colspan='1' align='center'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='2'></td></tr>";
            echo "<tr><td colspan='3'></td></tr>";
            //$dataToExports = [];
            echo  "<table border='0'><tr><td colspan='6' align='center'></td></tr>";
            echo "<tr><td colspan='6' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
            echo  "<table border='0'><tr><td colspan='6' align='center'><b><h3>Closing Balance Report</h3></b></td></tr>";
            echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Closing Date</td><td colspan='1'  align='left'>Income</td><td colspan='1'  align='left'>Expense</td><td colspan='1'  align='left'>Opening Balance</td><td colspan='1'  align='left'>Closing Balance</td></tr>";
            foreach ($data['close'] as $row)
            {
                    echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".date('d-m-Y',strtotime($row['closing_balance_date']))."</td><td colspan='1'  align='left'>".$row['income']."</td><td colspan='1'  align='left'>".$row['expense']."</td><td colspan='1'  align='left'>".$row['opening_balance']."</td><td colspan='1'  align='left'>".$row['closing_balance']."</td></tr>";
                    //$dataToExports[]			= $arrangeData;
                    $i=$i+1;
            }
            die();
	}

	function get_admn_number_by_class_category($class_id){
	    $running_year = get_running_year();
		$this->db->select('a.class_category_id,b.last_admission_num');
		$this->db->join('class a','b.class_category_id = a.class_category_id');
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year',$running_year);
		$this->db->from('class_category b');
		$adm_num  = $this->db->get()->row()->last_admission_num;
		echo $adm_num+1;
	}
	
	function financial_year(){
		$this->db->where('is_deleted','N');
		$data['year'] 	= $this->db->get('tbl_financial_year')->result_array();
        $data['action'] = $this->session->flashdata('action');
        $data['status'] = $this->session->flashdata('status');
        $this->load->view('admin/financial_year',$data);
	}

	function add_financial_year(){
		$data = array(
		'description' 	=> $this->input->post('description'),
		'start_date' 	=> date('Y-m-d',strtotime($this->input->post('date_from'))),
		'end_date' 		=> date('Y-m-d',strtotime($this->input->post('date_to'))),
		'is_active' 	=> 'N',
		'created_date' 	=> date('Y-m-d H:i:s'),
		'created_by' 	=> $this->session->userdata('login_user_id')
		);
		$action		= "insert";
		$status 	= $this->db->insert('tbl_financial_year',$data);
        $this->session->set_flashdata('action', $action);
        $this->session->set_flashdata('status', $status);
        if(!empty($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('Admin/financial_year');
        }
	}

	function edit_financial_year($financial_year_id){
		$data = array(
		'description' 	=> $this->input->post('description'),
		'start_date' 	=> date('Y-m-d',strtotime($this->input->post('date_from'))),
		'end_date' 		=> date('Y-m-d',strtotime($this->input->post('date_to'))),
		);
		$action		= "update";
		$this->db->where('financial_year_id',$financial_year_id);
		$status 	=$this->db->update('tbl_financial_year',$data);
        $this->session->set_flashdata('action', $action);
        $this->session->set_flashdata('status', $status);
        if(!empty($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('Admin/financial_year');
        }
	}

	function set_financial_year(){
		$year_id = $this->input->post('current_year');
		$action		= "update";
		$this->db->update('tbl_financial_year',array('is_active'=>'N'));
		$this->db->where('financial_year_id',$year_id);
		$this->db->set('is_active','Y');
		$status 	= $this->db->update('tbl_financial_year');
        $this->session->set_flashdata('action', $action);
        $this->session->set_flashdata('status', $status);
        if(!empty($_SERVER['HTTP_REFERER'])){
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('Admin/financial_year');
        }
	}
////////////////////////////////////// By Moby Ends ////////////////////////////////////////////////////	


/*function fee_discount()
        {
            $this->db->select('admission_number,sum(fee_amount) as fee_amount');
            $this->db->where('academic_year_id',get_running_year());
            $this->db->where('is_deleted','N');
            $this->db->group_by('admission_number');
            $this->db->order_by('admission_number','asc');
            $students   =   $this->db->get('tbl_students_fee_master')->result();
         
            $discount_amount    =   0;
            foreach($students as $row)
            {
                $discount_amount    =      round($row->fee_amount*25/100);
                //echo "$row->admission_number : $discount_amount";die;
                //$this->db->select('sum(fee_amount) as fee_amount,sum(fee_balance) as fee_balance');
                $this->db->where('academic_year_id',get_running_year());
                $this->db->where('is_deleted','N');
                $this->db->where('admission_number',$row->admission_number);
                $this->db->order_by('students_fee_master_id','asc');
                $fee_master  =   $this->db->get('tbl_students_fee_master')->result();
                
                foreach($fee_master as $row1)
                {
                    if($row1->fee_balance > 0)
                    {
                        $this->db->where('students_fee_master_id',$row1->students_fee_master_id);
                        $this->db->where('is_deleted','N');
                        $fee_details  =   $this->db->get('tbl_students_fee_details')->result();
                        
                        $tot_fee_bal        =   0;
                        $tot_fee_conc       =   0;
                        foreach($fee_details as $row3)
                        {
                            if($row3->fee_balance > $discount_amount)
                            {
                                $fee_bal            =   $row3->fee_balance-$discount_amount;
                                $fee_conc           =   $discount_amount;
                                $discount_amount    =   0;
                            }
                            else
                            {
                                $fee_bal            =   0;
                                $fee_conc           =   $row3->fee_balance;
                                $discount_amount    =   $discount_amount-$row3->fee_balance;
                            }
                            $this->db->set('fee_balance',$fee_bal);
                            $this->db->set('fee_concession',$fee_conc);
                            $this->db->where('students_fee_details_id',$row3->students_fee_details_id);
                            $this->db->update('tbl_students_fee_details');
                            
                            $tot_fee_bal    +=  $fee_bal;
                            $tot_fee_conc   +=  $fee_conc;
                        }
                        $this->db->set('fee_balance',$tot_fee_bal);
                        $this->db->set('fee_concession',$tot_fee_conc);
                        $this->db->where('students_fee_master_id',$row1->students_fee_master_id);
                        $this->db->update('tbl_students_fee_master');
                    }
                }
            }
            
        }*/
        function fee_discount()
        {   //die;
            
            $this->db->select('admission_number,sum(fee_amount) as fee_amount');
            $this->db->where('academic_year_id',get_running_year());
            $this->db->where('is_deleted','N');
            $this->db->where('admission_number','1402');
            $this->db->group_by('admission_number');
            $this->db->order_by('admission_number','asc');
            $students   =   $this->db->get('tbl_students_fee_master')->result();
         
            $discount_amount    =   0;
            foreach($students as $row)
            {
                
                //echo "$row->admission_number : $discount_amount";die;
                //$this->db->select('sum(fee_amount) as fee_amount,sum(fee_balance) as fee_balance');
                $this->db->where('academic_year_id',get_running_year());
                $this->db->where('is_deleted','N');
                $this->db->where('admission_number',$row->admission_number);
                $this->db->order_by('students_fee_master_id','asc');
                $fee_master  =   $this->db->get('tbl_students_fee_master')->result();
                
                $discount_amount    =   0;
                foreach($fee_master as $row1)
                {
                    
                        $this->db->where('students_fee_master_id',$row1->students_fee_master_id);
                        $this->db->where('is_deleted','N');
                        $fee_details  =   $this->db->get('tbl_students_fee_details')->result();
                        
                        $tot_fee_bal        =   0;
                        $tot_fee_conc       =   0;
                        
                        foreach($fee_details as $row3)
                        {
                            $discount_amount        =   $discount_amount+round($row3->fee_amount*25/100);
                            if($row3->fee_balance > $discount_amount)
                            {
                                $fee_bal            =   $row3->fee_balance-$discount_amount;
                                $fee_conc           =   $discount_amount;
                                $discount_amount    =   0;
                            }
                            else
                            {
                                $fee_bal            =   0;
                                $fee_conc           =   $row3->fee_balance;
                                $discount_amount    =   $discount_amount-$row3->fee_balance;
                            }
                            $this->db->set('fee_balance',$fee_bal);
                            $this->db->set('fee_concession',$fee_conc);
                            $this->db->where('students_fee_details_id',$row3->students_fee_details_id);
                            $this->db->update('tbl_students_fee_details');
                            
                            $tot_fee_bal    +=  $fee_bal;
                            $tot_fee_conc   +=  $fee_conc;
                        }
                        $this->db->set('fee_balance',$tot_fee_bal);
                        $this->db->set('fee_concession',$tot_fee_conc);
                        $this->db->where('students_fee_master_id',$row1->students_fee_master_id);
                        $this->db->update('tbl_students_fee_master');
                    
                }
            }
            
        } 

}
