<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class enquiry_controller extends CI_Controller {
 

	function enquiry() 
    {
     $this->load->view('admin/enquiry/enquiry_form');
    }
	
	function get_district($state_id) 
    {
      $page_data['state_id'] = $state_id; 
      $this->load->view('admin/enquiry/get_state' ,$page_data);
    }
	
	function today_call_view($enquiry_id='')
    {
       $data['enquiry_id']=$enquiry_id;
		$this->load->view('admin/enquiry/today_call_details_view',$data);
    }
	
function add_call_details($enquiry_id='')
	{
		 	 $call_date=  date("Y-m-d", strtotime($this->input->post('date')));;
		 	 $follow_up_date=  date("Y-m-d", strtotime($this->input->post('call_date')));;

		 $d=array(
	           'call_id'=>'null',
			   'enquiry_id'=>$enquiry_id,
			   'date'=> $call_date,
			   'next_followup_date'=> $follow_up_date,
			   'time'=>$this->input->post('time'),
	           'name'=>$this->input->post('name'),
	           'remark'=>$this->input->post('remark')
		
			   );
		
            $result=$this->enquiry_model->insert_call_details($d);
			if($result>0){
			$data["action"]="success";
			}
			  //redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
           		$this->load->view('admin/enquiry/call_form.php',$data);

    	   
	}
	
	function add_enquiry()
    {
		
		$b=DateTime::createFromFormat('d/m/Y', $this->input->post('doe'));
   		$a= $b->format('Y/m/d'); 
	        if($this->input->post('dob')!=''){
  			$p=DateTime::createFromFormat('d/m/Y', $this->input->post('dob'));
		 	$r=$p->format('Y/m/d'); 
	   }
	   else{
	   $r=''; }
    
		 $f= $this->input->post('tstamp');
		 $g=date_create($f);
		 $h=date_format($g, "H:i a");
	  
	 
     $d=array(
	           'enquiry_id'=>'null',
			   'date'=> $a,
			   'time'=>$h,
	           'first_name'=>$this->input->post('fname'),
	           'last_name'=>$this->input->post('lname'),
	           'email'=>$this->input->post('email'),
			   'date_of_birth'=>$r,
	           'address'=>$this->input->post('address'),
			   'branch_id'=>$this->session->userdata('branch_id'),
			   'dept_id'=>$this->session->userdata('dept_id'),
	           'pin'=>$this->input->post('pin'),
	           'district'=>$this->input->post('district_id'),
	           'state'=>$this->input->post('state_id'),
			   'sex'=>$this->input->post('sex'),
	           'phone1'=>$this->input->post('phone1'),
			   'phone2'=>$this->input->post('phone2'),
			   'whatsapp'=>$this->input->post('whatsapp'),
			   'parent_name'=>$this->input->post('father'),
			   'occupation'=>$this->input->post('occupation'),
			   'course_enquired'=>$this->input->post('class_id'),
			   'is_deleted'=>'N',
			   'is_admitted'=>'N',
			    'enquired_by'=>$this->input->post('send_by'),
			    'enquired_through'=>$this->input->post('send_trough'),
				'interested'=>1,
			    'remark'=>$this->input->post('remark')
	           );
	
	 
	  
	$e=array(
	          'qualification_id'=>'null',
			  'qualification'=>$this->input->post('qualification1'),
			  'year'=>$this->input->post('year1'),
	          'percentage'=>$this->input->post('percentage1'),
	          'last_institute'=>$this->input->post('institute1')
	          );
			
		  
	
			  
		  
	
			  			  			
			  $this->load->Model('enquiry_model');
              $enquiry_id=$this->enquiry_model->enquiry_insert($d,$e);
			  if($enquiry_id>0){
			  $data["action"]="success";
			  }
		//If additional message	  	
		if(isset($_POST['additional_msg']))
		{
			//$running_year		=	$academic_year_id;
			
			$sms 				= 	$this->db->get('sms_settings')->row();
			$sender_id 			= 	$sms->sender_id;
			$username 			= 	$sms->username;
			$password 			= 	$sms->password;
			$common 			= 	$sms->common_word;
			$url 				= 	$sms->url;
			$web_url			=	$sms->web_url;
			
			//$ph='';
			//$ph2='';
			//$class 				=	$class_id;
			//$section 			= 	$section_id;
			$content 			= 	$this->input->post('msg_content');
			$user_id			= 	$this->session->userdata('login_user_id');
			$staff				=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
			$data2['send_by']	=	$staff;
			$data2['content']	=  	$content;
			date_default_timezone_set("Asia/Kolkata");
			$data2['send_date']	=  	date('Y/m/d h:i:s');
			$this->db->insert('tbl_sms_delivery_master',$data2);
			$master_id			=	$this->db->insert_id();
			
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
			
			
			$data1['sms_master_id']	=	$master_id;
			//$data1['student_id']	=	$student_id[$checked_row_num];
			//$data1['class_id']		=	$class;
			//$data1['section_id']	=	$section;
			$data1['phone']			=	$this->input->post('phone1');
			//$this->sms_helper($common,$c,$b['name'],$n,$content);
			$name					=	$this->input->post('fname');
			$content				=	$this->input->post('msg_content');
			$data1['msg_content']	= 	$this->sms_helper($common,$c,$n,$name,$content);
			date_default_timezone_set("Asia/Kolkata");
			$data1['send_date']		=  	date('Y/m/d h:i:s');
			$this->db->insert('tbl_sms_delivery_details',$data1);
			
			$data['master_id']	=	$master_id;	
			$data['name']		=	$name;	
			//$data['class_id']	=	$class;
			//$data['section_id']	=	$section;
			$this->load->view('admin/enquiry/enquiry_message_popup',$data);
			
		}
		  		
	$this->load->view('admin/enquiry/enquiry_form',$data);    
	}
	
	
	function sms_send_popup_fee($master_id='',$func='')
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
		
		if($func!='')
		{
			redirect('Enquiry_controller/'.$func);
		}
		else
		{
		 redirect(base_url() . 'index.php/Enquiry_controller/enquiry' , 'refresh');
	
		}
	}

	function delete_sms_pop_up($master_id='',$func='')
	{
		$this->db->where('sms_master_id',$master_id);
		$this->db->delete('tbl_sms_delivery_master');
		
		$this->db->where('sms_master_id',$master_id);
		$this->db->delete('tbl_sms_delivery_details');
		//$data['master_id']	=$master_id;
		//$this->load->view('admin/message.php');
		if($func!='')
		{
			redirect('Enquiry_controller/'.$func);
		}
		else
		{
			redirect('Enquiry_controller/enquiry');
		}
	}


	function enquiry_view() 
    {
	   $this->load->Model('enquiry_model');
	   if($this->input->post())
	   {
	    $fdate=$this->input->post('date_from');
	    $tdate=$this->input->post('date_to');
	   
	   $data['enquiry_list']=$this->enquiry_model->enquiry_list($fdate,$tdate);
	   $data['fdate']	= $fdate;
	   $data['tdate']	= $tdate;
	   }
	   else
	   {
	   
	      $data['enquiry_list']=$this->enquiry_model->enquiry_list('','');
		   $data['fdate']	= '';
	   $data['tdate']	= '';
	   }

		$this->load->view('admin/enquiry/enquiry_view',$data);
    }
	
	function approved_enquiry_view() 
    {
	   $this->load->Model('enquiry_model');
	   if($this->input->post())
	   {
	    $fdate=$this->input->post('date_from');
	    $tdate=$this->input->post('date_to');
	   
	   $data['enquiry_list']=$this->enquiry_model->approved_enquiry_list($fdate,$tdate);
	   $data['fdate']	= $fdate;
	   $data['tdate']	= $tdate;
	   }
	   else
	   {
	   
	      $data['enquiry_list']=$this->enquiry_model->approved_enquiry_list('','');
		   $data['fdate']	= '';
	   $data['tdate']	= '';
	   }

		$this->load->view('admin/enquiry/approved_enquiry_view',$data);
    }
	
	
	function enquiry_download($fdate='',$tdate='')
	{
	
	
	 $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.remark,e.email,e.date_of_birth,e.parent_name,e.phone2,e.enquired_by,e.enquired_through');
		$this->db->order_by('enquiry_id','DESC');
		
		if($fdate && $tdate)
		{
		$date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','N');
		$this->db->where('e.interested','1');
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		  $query_result=$this->db->get('tbl_enquiry_master e')->result_array(); 
	
	
	
	
	
	
			
		   
			
		                      
	        
									ob_start();
									ob_get_clean();
									$filename = "EnquiryDetailsReport.xls";
									header("Content-Type: application/vnd.ms-excel");
									header("Content-Disposition: attachment; filename=".$filename);
									
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='5'></td><td colspan='8'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='13'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='4' align='center'></td><td colspan='4' align='center'></td></tr>";
								echo "<tr><td colspan='11' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
								echo  "<table border='0'><tr><td colspan='11' align='center'><b><h3>ENQUIRY REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								
						echo  "<table border='1'><tr><td >Sl.No</td><td>Date</td><td>Name</td><td>Address</td><td>Phone1</td><td>Phone2</td><td>Course</td><td>Email</td><td>DOB</td><td>Fathers Name</td>
						<td>Enquired By</td><td>Enquired Through</td><td>Remark</td></tr>";
							
								 
								foreach ($query_result as $data)
								{
								echo "<tr><td>" .$i ; 
								echo "</td><td>" . $data['date'];
						echo "</td><td>" . $data['first_name']." ". $data['last_name'];
						 echo "</td><td>".$data['address'];
                        echo "</td><td>".$data['phone1'];
						 echo "</td><td>".$data['phone2'];
						 echo "</td><td>".$data['name'];
						  echo "</td><td>".$data['email'];
						   echo "</td><td>".$data['date_of_birth'];
						    echo "</td><td>".$data['parent_name'];
						    echo "</td><td>".$data['enquired_by'];
						    echo "</td><td>".$data['enquired_through'];
							  
												
						echo "</td><td>" .$data['remark']. "</td></tr>";
						$i=$i+1;	
								}
				echo "</body>";
						echo "</html>";		
			
								

    }
	function not_interested_enquiry_download($fdate='',$tdate='')
	{
	
	
	 $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.remark,e.email,e.date_of_birth,e.parent_name,e.phone2,e.enquired_by,e.enquired_through');
		$this->db->order_by('enquiry_id','DESC');
		
		if($fdate && $tdate)
		{
		$date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','N');
		$this->db->where('e.interested','0');
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		  $query_result=$this->db->get('tbl_enquiry_master e')->result_array(); 
	
	
	
	
	
	
			
		   
			
		                      
	        
									ob_start();
									ob_get_clean();
                                    $filename = "EnquiryDetailsReport.xls";
                                    header("Content-Type: application/vnd.ms-excel");
                                    header("Content-Disposition: attachment; filename=".$filename);
								
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='5'></td><td colspan='8'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='13'></td></tr>";
   								   

								   // $dataToExports = [];
echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='4' align='center'></td><td colspan='4' align='center'></td></tr>";
								echo "<tr><td colspan='11' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
								echo  "<table border='0'><tr><td colspan='11' align='center'><b><h3>ENQUIRY REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								
						echo  "<table border='1'><tr><td >Sl.No</td><td>Date</td><td>Name</td><td>Address</td><td>Phone1</td><td>Phone2</td><td>Course</td><td>Email</td><td>DOB</td><td>Fathers Name</td>
						<td>Enquired By</td><td>Enquired Through</td><td>Remark</td></tr>";
							
								 
								foreach ($query_result as $data)
								{
								echo "<tr><td>" .$i ; 
								echo "</td><td>" . $data['date'];
						echo "</td><td>" . $data['first_name']." ". $data['last_name'];
						 echo "</td><td>".$data['address'];
                        echo "</td><td>".$data['phone1'];
						 echo "</td><td>".$data['phone2'];
						 echo "</td><td>".$data['name'];
						  echo "</td><td>".$data['email'];
						   echo "</td><td>".$data['date_of_birth'];
						    echo "</td><td>".$data['parent_name'];
						    echo "</td><td>".$data['enquired_by'];
						    echo "</td><td>".$data['enquired_through'];
							  
												
						echo "</td><td>" .$data['remark']. "</td></tr>";
						$i=$i+1;	
								}
				echo "</body>";
						echo "</html>";		
			
								

    }

	
	function approved_enquiry_download($fdate='',$tdate='')
	{
	
	
	 $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.remark,e.email,e.date_of_birth,e.parent_name,e.phone2');
		$this->db->order_by('enquiry_id','DESC');
		
		if($fdate && $tdate)
		{
		$date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','Y');
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		  $query_result=$this->db->get('tbl_enquiry_master e')->result_array(); 
	
	
	
	
	
	
			
		   
			
		                      
	        
									ob_start();
									ob_get_clean();
								
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='5'></td><td colspan='8'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='13'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='4' align='center'></td><td colspan='4' align='center'></td></tr>";
								echo "<tr><td colspan='11' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
								echo  "<table border='0'><tr><td colspan='11' align='center'><b><h3>ENQUIRY REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								
						echo  "<table border='1'><tr><td >Sl.No</td><td>Date</td><td>Name</td><td>Address</td><td>Phone1</td><td>Phone2</td><td>Course</td><td>Email</td><td>DOB</td><td>Fathers Name</td>
						<td>Remark</td></tr>";
							
								 
								foreach ($query_result as $data)
								{
								echo "<tr><td>" .$i ; 
								echo "</td><td>" . $data['date'];
						echo "</td><td>" . $data['first_name']." ". $data['last_name'];
						 echo "</td><td>".$data['address'];
                        echo "</td><td>".$data['phone1'];
						 echo "</td><td>".$data['phone2'];
						 echo "</td><td>".$data['name'];
						  echo "</td><td>".$data['email'];
						   echo "</td><td>".$data['date_of_birth'];
						    echo "</td><td>".$data['parent_name'];
							  
												
						echo "</td><td>" .$data['remark']. "</td></tr>";
						$i=$i+1;	
								}
				echo "</body>";
						echo "</html>";		
			
			$filename = "EnquiryDetailsReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								

    }
	
	
	
	
	function enquiry_followup_download($enquiry_id,$fdate='',$tdate='')
	{
	
	$this->db->select('e.name as followup_by,e.date,e.next_followup_date,e.remark as status');
	 
		
		if($fdate && $tdate)
		{
		  $date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.enquiry_id',$enquiry_id);
		
	 $query_result= $this->db->get('tbl_enquiry_followups e')->result_array(); 
	 
	 
	 $this->db->where('enquiry_id',$enquiry_id);
	 $this->db->join('class c','e.course_enquired=c.class_id','LEFT');
	 $enq=$this->db->get('tbl_enquiry_master e')->row();
		
	ob_start();
									ob_get_clean();
								
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='7'></td><td colspan='10'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='15'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='4' align='center'></td><td colspan='4' align='center'></td></tr>";
								echo "<tr><td colspan='15' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
								echo  "<table border='0'><tr><td colspan='15' align='center'><b><h3>ENQUIRY FOLLOW-UP REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
						
							echo  "<table border='0'><tr><td colspan='15' align='center'><b><h5>NAME:&nbsp;&nbsp;&nbsp;".$enq->first_name." ". $enq->last_name."</h3></b></td></tr>";		
							echo  "<table border='0'><tr><td colspan='15' align='center'><b><h5>PHONE:&nbsp;&nbsp;&nbsp;".$enq->phone1."</h3></b></td></tr>";	
							echo  "<table border='0'><tr><td colspan='15' align='center'><b><h5>COURSE:&nbsp;&nbsp;&nbsp;".$enq->name."</h3></b></td></tr>";
								echo  "<table border='0'><tr><td colspan='15' align='center'><b><h5>REMARK:&nbsp;&nbsp;&nbsp;".$enq->remark."</h3></b></td></tr>";		
						echo  "<table border='1'><tr><td colspan='3' align='center'><b>Sl.No</b></td><td  colspan='3' align='center'><b>Call Date</b></td><td  colspan='3' align='center'><b>Follow-up By</b></td><td colspan='3' align='center'><b>Next Follow-up Date</b></td><td colspan='3' align='center'><b>Status</b></td></tr>";
							
								foreach ($query_result as $data)
								{ 
								
								echo "<tr><td colspan='3' align='center'>" .$i ; 
								echo "</td><td  colspan='3' align='center'>" . $data['date'];
						
						    echo "</td><td colspan='3' align='center'>".$data['followup_by'];
							 echo "</td><td colspan='3' align='center'>".$data['next_followup_date'];
							  
												
						echo "</td><td colspan='3' align='center'>" .$data['status']. "</td></tr>";
						$i=$i+1;	
								}
				echo "</body>";
						echo "</html>";		
			
			$filename = "EnquiryDetailsReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								

    }
	
	
	
	
	function todays_followup_download()
	{
	
	
	
	
	
	
			
		   
			
		                      
	        
									ob_start();
									ob_get_clean();
								
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='5'></td><td colspan='8'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='13'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='4' align='center'></td><td colspan='4' align='center'></td></tr>";
								echo "<tr><td colspan='11' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
								echo  "<table border='0'><tr><td colspan='11' align='center'><b><h3>ENQUIRY FOLLOW-UP REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								
						echo  "<table border='1'><tr><td >Sl.No</td><td>Call Date</td><td>Name</td><td>Address</td><td>Phone1</td><td>Phone2</td><td>Course</td><td>Email</td><td>DOB</td><td>Fathers Name</td>
						<td>Remark</td></tr>";
							
								 $this->db->select('distinct(enquiry_id) as enq_id');
	 $today_followup = $this->db->get_where('tbl_enquiry_followups',array('next_followup_date'=>date("Y-m-d")))->result_array();
	 foreach($today_followup as $data_f)
	 {
	
	 $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.remark,e.email,e.date_of_birth,e.parent_name,e.phone2');
		$this->db->order_by('enquiry_id','DESC');
		
		
		
			 ///$this->db->where('date',date('Y-m-d'));
			 
			 
		
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','N');
		$this->db->where('e.enquiry_id',$data_f['enq_id']);
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		  $query_result=$this->db->get('tbl_enquiry_master e')->result_array(); 
	
								foreach ($query_result as $data)
								{
								echo "<tr><td>" .$i ; 
								echo "</td><td>" . $data['date'];
						echo "</td><td>" . $data['first_name']." ". $data['last_name'];
						 echo "</td><td>".$data['address'];
                        echo "</td><td>".$data['phone1'];
						 echo "</td><td>".$data['phone2'];
						 echo "</td><td>".$data['name'];
						  echo "</td><td>".$data['email'];
						   echo "</td><td>".$data['date_of_birth'];
						    echo "</td><td>".$data['parent_name'];
							  
												
						echo "</td><td>" .$data['remark']. "</td></tr>";
						$i=$i+1;	
								}}
				echo "</body>";
						echo "</html>";		
			
			$filename = "EnquiryDetailsReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								

    }
	
	
	
	
	function enquiry_upcoming_followup_download($fdate='',$tdate='')
	{
	
	ob_start();
									ob_get_clean();
								
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='5'></td><td colspan='8'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='13'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='4' align='center'></td><td colspan='4' align='center'></td></tr>";
								echo "<tr><td colspan='11' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
								echo  "<table border='0'><tr><td colspan='11' align='center'><b><h3>ENQUIRY FOLLOW-UP REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								
						echo  "<table border='1'><tr><td >Sl.No</td><td>Call Date</td><td>Name</td><td>Address</td><td>Phone1</td><td>Phone2</td><td>Course</td><td>Email</td><td>DOB</td><td>Fathers Name</td>
						<td>Remark</td></tr>";
							
								 $this->db->select('distinct(enquiry_id) as enq_id');
								 $this->db->where('next_followup_date>=',date('Y-m-d',strtotime($fdate)));
								  $this->db->where('next_followup_date<=',date('Y-m-d',strtotime($tdate)));
	 $today_followup = $this->db->get('tbl_enquiry_followups')->result_array();
	 foreach($today_followup as $data_f)
	 {
	
	 $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.remark,e.email,e.date_of_birth,e.parent_name,e.phone2');
		$this->db->order_by('enquiry_id','DESC');
		
		
		
			 ///$this->db->where('date',date('Y-m-d'));
			 
			 
		
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','N');
		$this->db->where('e.enquiry_id',$data_f['enq_id']);
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		  $query_result=$this->db->get('tbl_enquiry_master e')->result_array(); 
	
								foreach ($query_result as $data)
								{
								echo "<tr><td>" .$i ; 
								echo "</td><td>" . $data['date'];
						echo "</td><td>" . $data['first_name']." ". $data['last_name'];
						 echo "</td><td>".$data['address'];
                        echo "</td><td>".$data['phone1'];
						 echo "</td><td>".$data['phone2'];
						 echo "</td><td>".$data['name'];
						  echo "</td><td>".$data['email'];
						   echo "</td><td>".$data['date_of_birth'];
						    echo "</td><td>".$data['parent_name'];
							  
												
						echo "</td><td>" .$data['remark']. "</td></tr>";
						$i=$i+1;	
								}}
				echo "</body>";
						echo "</html>";		
			
			$filename = "EnquiryDetailsReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								

    }
	
	
	function sendsms() 
    {
	    	
		$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;


	$content = $this->input->post('msg');
	//$phone2= $this->input->post('phone2');
	$student = $this->input->post('chk');
	$student_count=count($student);
	if (count($student) > 0) {
	$user_id	= $this->session->userdata('login_user_id');
	$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
	$data['send_by']	=$staff;
	$data['content']	=  $content;
date_default_timezone_set("Asia/Kolkata");
	$data['send_date']	=  date('Y/m/d  h:i:s');
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
	$this->db->select('phone1,first_name');
	$this->db->where('enquiry_id',$student[$i]);
	$a=$this->db->get('tbl_enquiry_master')->row();
	
	
	$data1['sms_master_id']	=$master_id;
	$data1['student_id']	=$student[$i];
	$data1['class_id']	=0;
	$data1['section_id']	=0;
	$data1['phone']	=$a->phone1;
	
	
	$data1['msg_content']	= $this->sms_helper($common,$c,$n,$a->first_name,$content);;
date_default_timezone_set("Asia/Kolkata");
	$data1['send_date']	=  date('Y/m/d  h:i:s');
	$this->db->insert('tbl_sms_delivery_details',$data1);
	}
	}
	else
	{
	$master_id=0;
	
	}
	$data['master_id']	=	$master_id;	
	$data['class_id']	=	0;
	$data['section_id']	=	0;
	$data['name']		=	$a->first_name;
	$this->load->view('admin/message_popup_enq',$data);
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

	
	
	function followup_enquiry() 
    {
	    	
		
	    $page_data['query_result']	   = $this->db->get_where('tbl_enquiry_followups',array('next_followup_date'=>date("Y-m-d")))->result_array();
		$page_data['enquiry_followup_list']=$this->enquiry_model->enquiry_list();


		$this->load->view('admin/enquiry/followup_enquiry_view',$page_data);
    }
	
	function enq_set_interest($enquiry_id='',$set_to='')
	{
		$this->load->model('Enquiry_model');
		$result	=	$this->Enquiry_model->enq_set_interest($enquiry_id,$set_to);
		if($result>0)
		{
			if($set_to=='not_interested')
			{
				$action	=	"not_interest";
			}
			if($set_to=='interested')
			{
				$action	=	"interest";
			}
		}
		else
		{
			$action	=	"failed";
		}
		$this->session->set_flashdata('action',$action);
		
		if($set_to=='not_interested')
		{
			redirect('enquiry_controller/enquiry_view');
		}
		if($set_to=='interested')
		{
			redirect('enquiry_controller/not_interested_enquiry_view');
		}
	}
	
	function not_interested_enquiry_view()
	{
		$this->load->Model('enquiry_model');
		if($this->input->post())
		{
		$fdate=$this->input->post('date_from');
		$tdate=$this->input->post('date_to');
		
		$data['enquiry_list']=$this->enquiry_model->not_interested_enquiry_list($fdate,$tdate);
		$data['fdate']	= $fdate;
		$data['tdate']	= $tdate;
		}
		else
		{
		  $data['enquiry_list']=$this->enquiry_model->not_interested_enquiry_list('','');
		   $data['fdate']	= '';
		$data['tdate']	= '';
		}
		
		$this->load->view('admin/enquiry/not_interested_enquiry_view',$data);
	}
	
	 function delete($enquiry_id)
    {
	  $this->load->model('enquiry_model');
	  $this->enquiry_model->delete_enquiry($enquiry_id);  
      redirect(base_url() . 'index.php/enquiry_controller/enquiry_view' , 'refresh');
	}

   
	function get_search_date()
	{
	
	$this->load->view('admin/enquiry/enquiry_view1.php');	
	}
	
	function call_details($enquiry_id='') 
    {
	
	$data['username']=$this->session->userdata("name");
        $data['enquiry_id']=$enquiry_id;
		$this->load->view('admin/enquiry/call_form.php',$data);
    }
	
	function view_call_details($enquiry_id='') 
    {
       $data['enquiry_id']=$enquiry_id;
	   
	   $this->load->Model('enquiry_model');
	   if($this->input->post())
	   {
	     $fdate=$this->input->post('date_from');
	  
	    $tdate=$this->input->post('date_to');
	   
	   
	   $data['call']=$this->enquiry_model->enquiry_folow_list($fdate,$tdate,$enquiry_id);
	   $data['fdate']	= $fdate;
	   $data['tdate']	= $tdate;
	   }
	   else
	   {
	   
	      $data['call']=$this->enquiry_model->enquiry_folow_list('','',$enquiry_id);
		   $data['fdate']	= '';
	   $data['tdate']	= '';
	   }

	   
	   $this->load->view('admin/enquiry/call_details_view',$data);
    }
  
	 function enquiry_report()
	{
			$sql = "select * from tbl_enquiry_master where is_deleted='N' and is_admitted='N'";
		    $query_result = $this->db->query($sql)->result_array();
			
		                      
	        
									ob_start();
									ob_get_clean();
								
									$i=1;
                                    echo "<html>";
									$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='3'></td><td colspan='2'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='7'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
								echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>ENQUIRY REPORT&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								
						echo  "<table border='1'><tr><td>Sl.No</td><td>Name</td><td>Email</td><td>Date Of Birth</td><td>Address</td><td>Phone1</td><td>Parent Name</td></tr>";
							
								 
								foreach ($query_result as $data)
								{
								echo "<tr><td>" .$i ; 
						echo "</td><td>" . $data['first_name']." ". $data['last_name'];
						echo "</td><td>".$data['email'];
						echo "</td><td>".$data['date_of_birth'];
						echo "</td><td>".$data['address'];
                        echo "</td><td>".$data['phone1'];						
						echo "</td><td>" .$data['parent_name']. "</td></tr>";
						$i=$i+1;	
								}
				echo "</body>";
						echo "</html>";						
			
			$filename = "EnquiryDetailsReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								

    }
	

	function edit_call($call_id='')
	{
		 $data['call_id']=$call_id;
		$this->load->view('admin/enquiry/call_edit',$data);
	}
	function delete_call($call_id='',$enquiry_id='')
	{
		 $data['call_id']=$call_id;
		 $this->load->model('enquiry_model');
		$this->enquiry_model->delete_call_details($call_id);
		 redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id, 'refresh');
	}
	 function update_call($call_id='')
	
	{
	           $a=  date("Y-m-d", strtotime($this->input->post('date')));;
	        $data['call_id']=$call_id;
	        $data['name']	=$this->input->post('name');
	        $data['date']       = $a;
			$data['time']	=$this->input->post('time');
	        $data['remark']	=$this->input->post('remark');
			
			$this->load->model('enquiry_model');
			
			$this->enquiry_model->call_edit($data,$call_id);
            redirect(base_url() . 'index.php/enquiry_controller/enquiry_view/', 'refresh');
     }       
	


function update_profile()
{
    $this->load->model('enquiry_model');
	$enquiry_id=$this->input->post('id');
	$a=array(
	    
	     'first_name'	=>$this->input->post('fname'),
		 'last_name'	=>$this->input->post('lname'),
		 'email'        =>$this->input->post('email'),
		 'date_of_birth'=>$this->input->post('dob'),
		 'address'	    =>$this->input->post('address'),
		 'pin'          =>$this->input->post('pin'),
		 'district'	    =>$this->input->post('district_id'),
		 'state'        =>$this->input->post('state_id'),
		 'sex'          =>$this->input->post('sex'),
		 'parent_name'	    =>$this->input->post('father_name'),
		 'occupation'	=>$this->input->post('occupation'),
		 'phone1'	    =>$this->input->post('phone1'),
		 'phone2'       =>$this->input->post('phone2'),
 		 'course_enquired'       =>$this->input->post('class_id'),
 		 'enquired_by'       =>$this->input->post('send_by'),
 		 'enquired_through'       =>$this->input->post('send_trough'),
	     'whatsapp'     =>$this->input->post('whatsapp')
		);
		
			
		 $this->enquiry_model->profile_edit($a,$enquiry_id);
		 $b=array(
	    
	     'qualification'	=>$this->input->post('qualification'),
		 'year'	=>$this->input->post('year'),
		 'percentage'        =>$this->input->post('percentage'),
		 'last_institute'=>$this->input->post('instituation'));
		 $this->enquiry_model->profile_edit_exam($b,$enquiry_id);

		
		 
		 
		 redirect(base_url() . 'index.php/enquiry_controller/enquiry_view/', 'refresh');
}

	 function admit_enquiry($enquiry_id='')
	
	{
         $data['enquiry_id']=$enquiry_id;
		$this->load->view('admin/enquiry/add_student',$data);
    }	 
	
	
	
	
function enquiry_detailed_report()
 {
   $date_from        = date("Y-m-d", strtotime($this->input->post('date_from')));
   $date_to          = date("Y-m-d", strtotime($this->input->post('date_to')));

	if (isset($_POST['chk_date_from']) && isset($_POST['chk_date_to']) )
     {	
		$condition = " where date between '" . $date_from . "' and '" . $date_to . "' and is_admitted!='Y' and is_deleted!='Y'";
		$sql = "select * from tbl_enquiry_master $condition  "  ;
		$query_result = $this->db->query($sql)->result_array();
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
	    $page_data['query_result']	   = $query_result;	
	    $this->load->view('admin/enquiry/enquiry1',$page_data );
}

else if (isset($_POST['chk_date_from']))
{	
		$condition = " where date >= '" . $date_from . "' and is_admitted!='Y'";
		$sql = "select * from tbl_enquiry_master $condition  "  ;
		$query_result = $this->db->query($sql)->result_array();
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
	    $page_data['query_result']	   = $query_result;	
	    $this->load->view('admin/enquiry/enquiry1',$page_data );
}	
else if (isset($_POST['chk_date_to']) )
{	
		$condition = " where date <= '" . $date_to . "' and is_admitted!='Y'";
		$sql = "select * from tbl_enquiry_master $condition  "  ;
		$query_result = $this->db->query($sql)->result_array();
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
	    $page_data['query_result']	   = $query_result;	
	    $this->load->view('admin/enquiry/enquiry1',$page_data );
}
else
{	
		$condition = "where is_admitted!='Y'";
		$sql = "select * from tbl_enquiry_master $condition"  ;
		$query_result = $this->db->query($sql)->result_array();
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
	    $page_data['query_result']	   = $query_result;	
	    $this->load->view('admin/enquiry/enquiry1',$page_data );
}								
			
}		
function enquiry_followup_report()
 {
   $date_from        = date("Y-m-d", strtotime($this->input->post('date_from')));
   $date_to          = date("Y-m-d", strtotime($this->input->post('date_to')));
$this->db->select('distinct(enquiry_id) as enquiry_id');
		
		 $this->db->where('next_followup_date>=',$date_from);
			  $this->db->where('next_followup_date<=',$date_to);
		
		$query_result = $this->db->get('tbl_enquiry_followups')->result_array();
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
	    $page_data['query_result']	   = $query_result;	
	    $this->load->view('admin/enquiry/enquiry_followup_report',$page_data );
							
			
}		
	
	
	
		      
function add_student($enquiry_id='')
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

            
$this->load->model('enquiry_model');
$this->enquiry_model->edit_is_admitted($enquiry_id);
redirect(base_url() . 'index.php/enquiry_controller/enquiry_view/', 'refresh');
     }       
		


  function edit($enquiry_id)
  {
      $this->load->model('enquiry_model');
	  $data['a']=$this->enquiry_model->edit_enquiry($enquiry_id);
	  $data['b']=$this->enquiry_model->edit_enquiry1($enquiry_id);	  
      $this->load->view('admin/enquiry/enquiry_edit',$data);
   }


}

