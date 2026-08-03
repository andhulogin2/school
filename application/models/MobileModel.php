<?php 
	if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MobileModel extends CI_Model {
    
    // public function set_message_read($mid,$time)
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:53
    //     * */
    //     $this->db->set('read',$time);
    //     $this->db->set('status',MESSAGE_STATUS_READ);
    //     $this->db->where('id', $mid);
    //     $this->db->update('wolf_messages');
    // }
    // public function set_message_received($mid,$time)
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:53
    //     * */
    //     $this->db->set('delivered',$time);
    //     $this->db->set('status',MESSAGE_STATUS_DELIVERED);
    //     $this->db->where('id', $mid);
    //     $this->db->update('wolf_messages');
    // }
    
	function teacher_message($student_id) 
	{
		$year	=	get_running_year();
		$this->db->select('a.message_id,a.from_teacher_id,a.message,DATE_FORMAT(a.date_time,"%d/%m/%Y %h:%i %p") as date_time,c.name,f.name as subject_name');
    	$this->db->from('tbl_teacher_student_message a');
		$this->db->join('tbl_users b','b.user_id=a.from_teacher_id');
		$this->db->join('staff c','c.user_id=b.user_id');
		$this->db->join('subject f','f.subject_id=a.subject_id');
		$this->db->where('a.to_student_id',$student_id);
		$this->db->where('a.year',$year);
		$this->db->order_by('message_id','desc');
		$query = $this->db->get()->result_array();//echo $this->db->last_query();die;
		return $query;
	}
	function teacher_message_update($message_id)
	{
		$this->db->set('viewed','Y');
		$this->db->set('viewed_date_time',date('Y-m-d H:i:s'));
		$this->db->where('message_id',$message_id);
		return $this->db->update('tbl_teacher_student_message');
	}
    function timetable($student_id)
    {
        $class_id           =   get_student_class_id($student_id);
        $section_id         =   get_student_section_id($student_id);
        $this->db->where('class_id',$class_id);
        $this->db->where('section_id',$section_id);
        //$this->db->select('time_table_master_id,week_day_short_name as day_title');
        $res                =   $this->db->get('view_att_time_table_tabular')->result_array();
        //print_r($res);die;
        //echo $this->db->last_query();die;
        $result             =   array();
        foreach($res as $row):
            $result1                    =   array();
            $result1['day_title']    =   $row['week_day_short_name'];
            $result1['subjects'][]   =   $row['1st Hour']==null?"-":$row['1st Hour'];
            $result1['subjects'][]   =   $row['2nd Hour']==null?"-":$row['2nd Hour'];
            $result1['subjects'][]   =   $row['3rd Hour']==null?"-":$row['3rd Hour'];
            $result1['subjects'][]   =   $row['4th Hour']==null?"-":$row['4th Hour'];
            $result1['subjects'][]   =   $row['5th Hour']==null?"-":$row['5th Hour'];
            $result1['subjects'][]   =   $row['6th Hour']==null?"-":$row['6th Hour'];
            $result1['subjects'][]   =   $row['7th Hour']==null?"-":$row['7th Hour'];
            $result[]=$result1;
        endforeach;   
        return $result;

    }    
    function exam_time_table($student_id)
    {
        $class_id   =   get_student_class_id($student_id);
        $year       =   get_running_year();
        $this->db->where('class_id',$class_id);
        $this->db->where('year_id',$year);
        $this->db->where('is_deleted','N');
        $this->db->group_by('exam_time_table_master_id');
        $this->db->select('exam_time_table_master_id,exam_title');
        $result     =   $this->db->get('view_exam_time_table')->result();//print_r($result);die;
        foreach($result as $row):
            $this->db->select('exam_name as subject_name,DATE_FORMAT(time_from,"%h:%i %p") as from_time,DATE_FORMAT(time_to,"%h:%i %p") as to_time,DATE_FORMAT(exam_date,"%d %M %Y") as date');
            $this->db->where('exam_time_table_master_id',$row->exam_time_table_master_id);
            $this->db->where('class_id',$class_id);
            $row->details   =   $this->db->get('view_exam_time_table')->result();
        endforeach;    
        //print_r($result);die;
        return $result;
    }        
    function list_albums($student_id='')
    {
        $year	    =	get_running_year();
		$this->db->select('id,title,description,url as cover_image,date');
		//$this->db->where('year_id',$year);
		$this->db->order_by('id','desc');
		$this->db->group_by('id');
		$result		=	$this->db->get('view_gallery_master')->result_array();
		$data       =   array();
		foreach($result as $row):
		    $row['cover_image'] =   base_url().$row['cover_image'];  
		    $row['date']        =   date('d M Y',strtotime($row['date']));      
		    array_push($data,$row);
		endforeach;    
		return $data;
    }
    function list_photos($album_id='')
    {
		$this->db->select('gallery_details_id as id,details_description as description,url');
		$this->db->where('id',$album_id);
		$this->db->order_by('id','asc');
		$result		=	$this->db->get('view_gallery_master')->result_array();
		$data       =   array();
		foreach($result as $row):
		    $row['url'] =   base_url().$row['url'];  
		    array_push($data,$row);
		endforeach;    
		return $data;
    }
    
    public function get_firebase_id($user_id)
    {
        /*
        * Wolf, 2018-09-25, 15:53
        * */
        $this->db->select('token');
        $this->db->where('id', $user_id);
        return $this->db->get('users')->row()->token;
    }

    // public function insert_message($sender_id, $receiver_id, $type, $text, $path = "")
    // {
    //     /*
    //     * Wolf, 2018-09-25, 15:53
    //     * */
    //     $data = array(
    //         'sender_id' => $sender_id,
    //         'receiver_id ' => $receiver_id,
    //         'type' => $type,
    //         'text' => $text,
    //         'path' => $path,
    //         'sent' => round(microtime(true) * 1000),
    //         'delivered' => 0,
    //         'read' => 0,
    //         'status' => 0,
    //     );
    //     $this->db->insert('wolf_messages', $data);
    //     $mid = $this->db->insert_id();
    //     return $mid;
    // }
    
	function news($limit) 
	{
		$site_url = base_url() . "uploads/news_image/";
		$this->db->select('news_id,title,description,news_code,news_status');
    	$this->db->from('news');
		
		if (null !== $limit)
		{
        	$this->db->limit($limit);
		}
		$query = $this->db->get();
		$data=array();
		foreach($query->result_array() as $row){
		    $filename   =   $site_url.$row['news_code'].".jpg";
		    if(@getimagesize($filename))
		    {
		        $row['img_url']=$site_url.$row['news_code'].".jpg";
		    }
		    else
		    {  
		        $row['img_url']= NULL ;
		    }
		    array_push($data,$row);
		}
		return $data;
	}
	function student($id) 
	{
	    $year   =   get_running_year();
		$this->db->select('s.student_id,s.name,s.birthday,s.sex,s.address,s.phone1,s.phone2,s.email,s.school,s.parent,c.name as class,a.name as section,e.roll,s.admission_number');
        $this->db->from('student s');
		$this->db->join('enroll e','s.student_id=e.student_id','LEFT');
		$this->db->join('class c','e.class_id=c.class_id','LEFT');
		$this->db->join('section a','e.section_id=a.section_id','LEFT');
		if (null !== $id) 
		{
            $this->db->where('s.student_id', $id);
        }
		$this->db->where('e.year', $year);
		$query = $this->db->get();
		
		return $query->result_array();
	}
		function student_img($id) 
	{
	
		return $site_url = base_url() . 'uploads/student_image/'.$id.'.jpg';
	}
	function student_info()
	{
	  	$this->db->select('settings_id,type,description');
     	$this->db->from('settings');
	 	$query = $this->db->get();
	  	return $query->result_array();
	}
	function attendence($id,$month,$year) 
	{
		$this->db->select('student_id,attendance_id,status,from_unixtime(timestamp) as date');
        $this->db->from('attendance');
		
		if (null !== $id) 
		{
            $this->db->where('student_id', $id);
        }
		if (null !== $month && null !== $year) 
		{
            $this->db->where('month( from_unixtime( timestamp))=',$month );
			  $this->db->where('year( from_unixtime( timestamp))=',$year );
			
        }
		$query = $this->db->get();
		return $query->result_array();
	}
	function attendence2($id,$month,$year) 
	{
		$this->db->select('student_id,attendance_id,status,day(from_unixtime(timestamp)) as date');
        $this->db->from('attendance');
		if (null !== $id) 
		{
            $this->db->where('student_id', $id);
        }
		if (null !== $month && null !== $year) 
		{
            $this->db->where('month( from_unixtime( timestamp))=',$month );
			  $this->db->where('year( from_unixtime( timestamp))=',$year );
		}
		$query = $this->db->get();
		return $query->result_array();
	}
	function attendence_report($student_id,$month,$year) 
	{
		 $this->db->select('student_id,count(attendance_id) as present,day(from_unixtime(timestamp)) as date');
        $this->db->from('attendance');
		$this->db->where('status',1);
		$this->db->group_by('student_id');
		if (null !== $student_id) 
		{
            $this->db->where('student_id', $student_id);
        }
		if (null !== $month && null !== $year) 
		{
            $this->db->where('month( from_unixtime( timestamp))=',$month );
			  $this->db->where('year( from_unixtime( timestamp))=',$year );
		}
		$query = $this->db->get();
		return $query->result_array();
	}



	function attendence1() 
	{
		$this->load->helper('date');
		$this->db->select('timestamp');
		$this->db->from('attendance');
		$query = $this->db->get();
		return $query->result_array();
	}

	function exam_report($id,$limit,$exam_id) 
	{
	    $this->db->select('m.exam_id,m.student_id,s.name as subject,m.mark_obtained,m.mark_total,m.grade,position');
        $this->db->from('mark m');
		$this->db->join('subject s','m.subject_id=s.subject_id','LEFT');
		if (null !== $id) 
		{
            $this->db->where('m.student_id', $id);
        }
		
		if (null !== $limit) 
		{
               $this->db->limit($limit);
        }
		if (null !== $exam_id) 
		{
            $this->db->where('m.exam_id', $exam_id);
        }
		$query = $this->db->get();
		return $query->result_array();
	}
	function exam_details($id) 
	{
	    $year   =   get_running_year();     
	    $this->db->select('m.student_id,e.exam_id,e.name as exam,sum(m.mark_obtained) as obtained_mark,sum(m.mark_total) as total,r.rank');
        $this->db->from('exam e');
		$this->db->join('mark m','e.exam_id=m.exam_id');
		$this->db->join('ranks r','m.student_id=r.student_id','LEFT');
		$this->db->group_by('e.exam_id');
		$this->db->group_by('m.student_id');
		
		if (null !== $id) 
		{
            $this->db->where('m.student_id', $id);
        }
        $this->db->where('e.year',$year);
		$query = $this->db->get();
		return $query->result_array();
	}

	function exam_report1($id,$name,$limit,$class,$section) 
	{
	    $year   =   get_running_year();    
	    $this->db->select('st.student_id,st.name as student,c.name as class,s.name as section,e.name as exam,m.mark_obtained,m.mark_total,m.position,m.grade,m.year');
        $this->db->from('mark m');
		$this->db->join('student st','st.student_id=m.student_id');
		$this->db->join('class c','c.class_id=m.class_id');
		$this->db->join('section s','s.section_id=m.section_id');
		$this->db->join('exam e','e.exam_id=m.exam_id');
		if (null !== $id) {
            $this->db->where('st.student_id', $id);
        }
		if (null !== $name) {
            $this->db->where('st.name', $name);
        }
		if (null !== $limit) {
               $this->db->limit($limit);
        }
		if (null !== $class) {
            $this->db->where('c.name', $class);
        }
		if (null !== $section) {
            $this->db->where('s.name', $section);
        }
        $this->db->where('m.year',$year);
		$query = $this->db->get();
		return $query->result_array();
	}

	function complaint($id, $title,$description,$teacher_id,$branch_id,$dept_id) 
	{
	    $data['title']=$title;
	    $data['description']=$description;
		$data['student_id']=$id;
		$data['teacher_id']=$teacher_id;
		$data['timestamp']=date('Y-m-d');
		$data['branch_id']=$branch_id;
		$data['dept_id']=$dept_id;
		 $this->db->insert('reporte_alumnos',$data);
	}
	function view_teacher() 
	{
$this->db->where('role',5);
$this->db->or_where('role',6);

		$this->db->select('staff_id,name');
		$this->db->from('staff');
		$query1 = $this->db->get();
		return $query1->result_array();
	}
	function enquiry($student_id,$title,$description,$branch_id,$dept_id) 
	{
		$data['student_id']=$student_id;
	    $data['title']=$title;
	    $data['description']=$description;
		$data['date']=date('Y-m-d');
		$data['branch_id']=$branch_id;
		$data['dept_id']=$dept_id;
		$this->db->insert('enquiry',$data);
	}
	function homework1($student_id) 
	{
	    if (null !== $student_id)
	    {
	        $class=   get_student_class_id($student_id);    
	    }	        
	    if (null !== $student_id)
	    {
	        $section=   get_student_section_id($student_id);    
	    }	        
	    $year   =   get_running_year();     
	    $this->db->select('e.student_id,m.name,h.homework_id,h.title,h.description,t.name as teacher,s.name as subject,h.file_name,h.time_end,h.created_at,h.class_id,h.section_id');
        $this->db->from('homework h');
		$this->db->join('class c','h.class_id=c.class_id');
		$this->db->join('section sec','h.section_id=sec.section_id');
		$this->db->join('enroll e','e.class_id=h.class_id');
		$this->db->join('student m','e.student_id=m.student_id');
		$this->db->join('staff t','t.user_id=h.uploader_id');
		$this->db->join('subject s','s.subject_id=h.subject_id','LEFT');
		
		

	
		
		if (null !== $student_id)
		{
            $this->db->where('e.student_id', $student_id);
            $this->db->where('h.section_id', $section);
        }
        $this->db->where('h.academic_year', $year);
        $this->db->order_by('h.created_at','desc');
		$query = $this->db->get()->result_array();
		/*echo "<pre>";
		print_r($query);
		echo "</pre>";die;*/
		return $query;
	}
	function study_meterial($student_id) 
	{
	    $this->db->select('e.student_id,m.name,h.document_id,h.title,h.description,h.file_name,s.name as subject,from_unixtime(timestamp) as date');
        $this->db->from('document h');
		$this->db->join('class c','h.class_id=c.class_id','LEFT');
		$this->db->join('subject s','s.subject_id=h.subject_id','LEFT');
		$this->db->join('enroll e','e.class_id=h.class_id','LEFT');
		$this->db->join('student m','e.student_id=m.student_id','LEFT');
		$this->db->where('h.is_deleted','N');
		
		
		if (null !== $student_id)
		{
            $this->db->where('e.student_id', $student_id);
        }

		$query = $this->db->get();
		return $query->result_array();
	}
	

	   function fees($id) 
	{
	    $year   =   get_running_year();
	   $this->db->select('f.students_fee_master_id,f.due_date,f.fee_amount as total_amount,f.fee_balance as total_balance,f.fee_concession,a.date_paid,f.admission_number');
	   $this->db->from('tbl_students_fee_master f');
	  $this->db->join('tbl_fee_collection_master a','f.students_fee_master_id=a.student_fee_master_id');
          $this->db->where('f.is_deleted','N');
	   
		if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
		$this->db->where('f.academic_year_id',$year);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	   function fees_head($id) 
	{
	   $this->db->select('f.fee_head_id');
	   $this->db->from('tbl_fee_details f');
	  //$this->db->join('tbl_fee_collection_master a','f.students_fee_master_id=a.student_fee_master_id');
	 
	   
		if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	
	  function fees_details($id) 
	{
	   $year    =   get_running_year();     
	   $this->db->select('f.students_fee_master_id,f.admission_number,f.fee_installment_master_id,f.due_date,f.fee_amount,f.fee_balance,');
	   $this->db->from('tbl_students_fee_master f');
	  //$this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
           $this->db->where('f.is_deleted','N');
	   
		if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
		$this->db->where('f.academic_year_id',$year); 
		$query = $this->db->get();
		return $query->result_array();
	}
	function fees_details_head($id,$month,$year,$n_month) 
	{
	   $this->db->select('f.admission_number,DATEDIFF(f.due_date,CURDATE()) AS DAYS,f.due_date,d.fee_head,s.fee_amount,X.fee_payment_options_details');
	   $this->db->from('tbl_students_fee_master f');
	  $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=s.fee_head_id');
	   $this->db->join('tbl_fee_installment_master Z','f.fee_installment_master_id=Z.fee_installment_master_id','LEFT');
	   $this->db->join('tbl_fee_payment_options_details X','X.fee_payment_options_details_id=Z.fee_payment_options_details_id','LEFT');
	  $this->db->where('f.is_deleted','N');
	 
	   
		if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
		if (null !== $month && null !== $year) 
		{
            $this->db->where('month(f.due_date)=',$month );
			  $this->db->where('year(f.due_date)=',$year );
		}
		if (null !== $n_month && null !== $year) 
		{
            $this->db->where('month(f.due_date)=',$n_month );
			  $this->db->where('year(f.due_date)=',$year );
		}


		
		$query = $this->db->get();
		return $query->result_array();
	}
	



function fees_details_head1($id) 
	{
	   $year    =   get_running_year();     
	   $this->db->select('f.admission_number,f.due_date,d.fee_head,sum(s.fee_amount) as amount,X.fee_payment_options_details');
	   $this->db->from('tbl_students_fee_master f');
	  $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=s.fee_head_id');
	   $this->db->join('tbl_fee_installment_master Z','f.fee_installment_master_id=Z.fee_installment_master_id','LEFT');
	   $this->db->join('tbl_fee_payment_options_details X','X.fee_payment_options_details_id=Z.fee_payment_options_details_id','LEFT');
	   $this->db->group_by('s.fee_head_id');
	  $this->db->where('f.is_deleted','N');
	 
	   
		if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
		//if (null !==$fees_head) 
		//{
            //$this->db->where('month(f.due_date)=',$month );
			 // $this->db->where('d.fee_head',$fees_head);
		//}
		/*if (null !== $n_month && null !== $year) 
		{
            $this->db->where('month(f.due_date)=',$n_month );
			  $this->db->where('year(f.due_date)=',$year );
		}*/
        $this->db->where('f.academic_year_id',$year); 

		
		$query = $this->db->get();
		return $query->result_array();
	}
	



function over_due_details($id) 
	{
	   $year    =   get_running_year(); 
	   $this->db->select('f.admission_number,DATEDIFF(f.due_date,CURDATE()) AS DAYS,f.due_date,d.fee_head,s.fee_balance as fee_amount,X.fee_payment_options_details');
	   $this->db->from('tbl_students_fee_master f');
	   $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=s.fee_head_id');
	   $this->db->join('tbl_fee_installment_master Z','f.fee_installment_master_id=Z.fee_installment_master_id','LEFT');
	   $this->db->join('tbl_fee_payment_options_details X','X.fee_payment_options_details_id=Z.fee_payment_options_details_id','LEFT');
	   $this->db->where('((month(f.due_date) < MONTH(NOW()) AND year(f.due_date) <= YEAR(NOW())) OR (month(f.due_date) > MONTH(NOW()) AND year(f.due_date) < YEAR(NOW())))',NULL,FALSE);
	   //$this->db->where('year(f.due_date) < YEAR(NOW())',NULL,FALSE);
	   $this->db->where('f.fee_balance!=','0');
           $this->db->where('f.is_deleted','N');
			if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }

        $this->db->where('f.academic_year_id',$year); 
		
		$query = $this->db->get();//echo $this->db->last_query();die;
		return $query->result_array();
	}
	
function current_due_details($id) 
	{
	   $year    =   get_running_year();  
	   $this->db->select('f.admission_number,DATEDIFF(f.due_date,CURDATE()) AS DAYS,f.due_date,d.fee_head,s.fee_balance as fee_amount,X.fee_payment_options_details');
	   $this->db->from('tbl_students_fee_master f');
	  $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=s.fee_head_id');
	   $this->db->join('tbl_fee_installment_master Z','f.fee_installment_master_id=Z.fee_installment_master_id','LEFT');
	   $this->db->join('tbl_fee_payment_options_details X','X.fee_payment_options_details_id=Z.fee_payment_options_details_id','LEFT');
	   $this->db->where('month(f.due_date)=MONTH(NOW())');
	   $this->db->where('year(f.due_date)=YEAR(NOW())');
	   $this->db->where('f.is_deleted','N');
			if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
        $this->db->where('f.academic_year_id',$year); 

		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function next_due_details($id) 
	{
	   $year    =   get_running_year();  
	   $this->db->select('f.admission_number,DATEDIFF(f.due_date,CURDATE()) AS DAYS,f.due_date,d.fee_head,s.fee_balance as fee_amount,X.fee_payment_options_details');
	   $this->db->from('tbl_students_fee_master f');
	  $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=s.fee_head_id');
	   $this->db->join('tbl_fee_installment_master Z','f.fee_installment_master_id=Z.fee_installment_master_id','LEFT');
	   $this->db->join('tbl_fee_payment_options_details X','X.fee_payment_options_details_id=Z.fee_payment_options_details_id','LEFT');
	   $this->db->where('month(f.due_date)>MONTH(NOW())');
	   $this->db->where('year(f.due_date)>=YEAR(NOW())');
           $this->db->where('f.is_deleted','N');
			if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }

        $this->db->where('f.academic_year_id',$year); 
		
		$query = $this->db->get();
		return $query->result_array();
	}



	
	function paid_details($id) 
	{
	   $year    =   get_running_year();
	   $this->db->select('c.date_paid,d.fee_head,cd.fee_amount as paid amount');
	   $this->db->from('tbl_fee_collection_master c');
	   $this->db->join('tbl_fee_collection_details cd','cd.fee_collection_master_id=c.fee_collection_master_id');
	 // $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=cd.fee_head_id');
	   //$this->db->join('tbl_fee_collection_master c','c.student_fee_master_id=f.students_fee_master_id');
		 
	  
	 
	   
		if (null !== $id) 
		{
            $this->db->where('c.admission_number', $id);
        }
		$this->db->where('academic_year_id',$year);
		$query = $this->db->get();
		return $query->result_array();
	}
	function pending_details($id) 
	{
	   $year    =   get_running_year();  
	   $this->db->select('distinct(d.fee_head),s.fee_balance');
	   $this->db->from('tbl_students_fee_master f');
	  $this->db->join('tbl_students_fee_details s','f.students_fee_master_id=s.students_fee_master_id');
	   $this->db->join('tbl_fee_heads d','d.fee_head_id=s.fee_head_id');
	  // $this->db->join('tbl_fee_collection_master c','c.student_fee_master_id=f.students_fee_master_id');
		// $this->db->join('tbl_fee_collection_details cd','cd.fee_collection_master_id=c.fee_collection_master_id');
		 $this->db->where('s.fee_balance !=0');
                 $this->db->where('f.is_deleted','N');
	 
	   
		if (null !== $id) 
		{
            $this->db->where('f.admission_number', $id);
        }
		$this->db->where('f.academic_year_id',$year); 
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function otp() 
	{
	   $this->db->select('url,username,password,sender_id,common_word');
	   $this->db->from('sms_settings ');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function check_number($phone1) 
	{
	   $this->db->select('student_id');
	   $this->db->from('student');
	   if (null !== $phone1) 
		{
            $this->db->where('phone1', $phone1);
        }
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	
	// code by savii

 function attendance1($id,$month,$year)
{
	$sql="SELECT a1.student_id, YEAR(FROM_UNIXTIME(a1.`timestamp`)) as yr, MONTH(FROM_UNIXTIME(a1.`timestamp`)) as mnth, 
 ifnull(a2.present_cnt,0)+ifnull(a4.late_cnt,0)+ ifnull(a5.diary_cnt,0) AS present_cnt, ifnull(a3.absent_cnt,0) AS absent_cnt ,
 count(attendance_id) as total_workdays,
 (ifnull(a2.present_cnt,0) + ifnull(a4.late_cnt,0) + ifnull(a5.diary_cnt,0))/(ifnull(a2.present_cnt,0) +ifnull(a3.absent_cnt,0)+
 ifnull(a4.late_cnt,0) + ifnull(a5.diary_cnt,0))*100 as perc FROM `attendance` a1 
 left JOIN (SELECT count(`attendance_id`) as present_cnt,
 `student_id`, YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=1 AND 
 `student_id`=".$id." AND YEAR(FROM_UNIXTIME(`timestamp`))=".$year." AND MONTH(FROM_UNIXTIME(`timestamp`))=".$month." GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),
 MONTH(FROM_UNIXTIME(`timestamp`)) ) a2 on (a1.`student_id`= a2.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a2.yr 
 AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a2.mnth ) 
 left JOIN (SELECT count(`attendance_id`) as absent_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth 
 FROM `attendance` WHERE `status`=2 AND `student_id`=".$id." AND YEAR(FROM_UNIXTIME(`timestamp`))=".$year." AND MONTH(FROM_UNIXTIME(`timestamp`))=".$month."
 GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) a3 on 
 (a1.`student_id`= a3.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a3.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a3.mnth ) 
 
 left JOIN (SELECT count(`attendance_id`) as late_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`))
    as mnth FROM `attendance` WHERE `status`=3 AND `student_id`=".$id."  AND YEAR(FROM_UNIXTIME(`timestamp`))=".$year." AND MONTH(FROM_UNIXTIME(`timestamp`))=".$month." 
	GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) a4 on (a1.`student_id`= a4.`student_id` AND
	YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a4.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a4.mnth ) 
left JOIN (SELECT count(`attendance_id`) as diary_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,
MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=4 AND `student_id`=".$id."  AND YEAR(FROM_UNIXTIME(`timestamp`))=".$year." 
AND MONTH(FROM_UNIXTIME(`timestamp`))=".$month." GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
a5 on (a1.`student_id`= a5.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a5.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a5.mnth ) 
WHERE a1.`student_id`=".$id."   and

YEAR(FROM_UNIXTIME(`timestamp`))=".$year." AND MONTH(FROM_UNIXTIME(`timestamp`))=".$month."

GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`))

";
$res=$this->db->query($sql);
 

	return $res->result_array();
	
}	
function about() 
	{
	   $this->db->select('description');
	   $this->db->from('settings');
	   $this->db->where('type','about');
	 
	   
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function special_fees($id)
	{
		$running_year = get_running_year();
		$this->db->select('f.fee_head,m.fee_amount,m.date_paid');
		$this->db->where('m.academic_year_id',$running_year);
		$this->db->where('m.student_id', $id);
		$this->db->join('tbl_fee_heads f','f.fee_head_id=m.fee_head_id','LEFT');
		$query=$this->db->get('tbl_special_fee_collection_master m')->result_array();//echo $this->db->last_query();die;
		return $query;
	}


	function student_message($id)
	{
		$year	=	get_running_year();
		$this->db->select('a.message_id,a.message,DATE_FORMAT(a.date_time,"%d-%m-%Y %h:%i %p") as date,b.name as teacher_name');
		$this->db->where('a.year',$year);
		$this->db->where('a.to_student_id',$id);
		$this->db->join('staff b','b.user_id=a.from_teacher_id');
		$result	=	$this->db->get('tbl_teacher_student_message a')->result_array();
		return $result;
	}

	
}
