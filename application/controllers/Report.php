<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Report extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
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

  
 public function student_print_bulk($class_id)
	{
	
//$i=0;
//for($i=0;$i<=5;$i++){
		      		$filename = "Student_Profile-".$q['student_id'].".doc";
								header("Content-Type: application/vnd.ms-word");
								header("Content-Disposition: attachment; filename=".$filename);
				$query=$this->db->get_where('enroll',array('class_id'=>$class_id))->result_array();
	 			 foreach($query as $q){
	 								//echo $q['student_id'];
									
	 						$s=$this->db->get_where('enroll',array('student_id'=>$q['student_id']))->result_array();
	 							foreach($s as $p){	
		//$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		if (isset($_POST['chk_excel10']))
		{
		
		                           
									ob_start();
									ob_get_clean();
									$total = 0;
									
                       ?><p style="page-break-before: always"><?php
							   //$dataToExports = [];
	   								   //echo  "<table border='1'><tr><td colspan='10' align='center'><b><h2><img src=uploads/student_image/".$student_id.".jpg">"</h2></b></td></tr>";
									   //echo '<p style="page-break-before: always">';
									    $image_url = base_url() . 'uploads/logo.png';
									    $stu_url = base_url() . 'uploads/student_image/'.$q['student_id'].'.jpg';

                                   echo  "<center><table border='0'><tr><td colspan='5' align='center'></td><td colspan='3' align='center'></td><td colspan='3' align='center'></td></tr></center>";
   								   echo  "<tr><td colspan='5' align='center'></td><td colspan='3' align='center'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='3' align='center'></td></tr>";
								    echo "<tr><td colspan='11'></td></tr>";
   								    echo "<tr><td colspan='11'></td></tr>";
                                    
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h3></br>".get_school()."</h3></td><td colspan='4' align='center'></td></tr>";
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h4></br>".get_school_address()." , Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td><td colspan='4' align='center'></td></tr>";
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr></table>";
   								   

								   echo  "<table border='1'><tr><td colspan='11' align='center'><b><h3>STUDENT PROFILE&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";


									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Name</td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_name($q['student_id'])."</td><td colspan='3'><img src=".$stu_url." width='200px'></td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Roll No</td></td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_roll($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Class/Section</td></td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_class_name($class_id)."-".get_section_name($p['section_id'])."</td></tr>";
									
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Sex</td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_sex($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Phone</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_phone1($q['student_id'])."/".get_student_phone2($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Address</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_address($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Birthday</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_birthday($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Email</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_email($q['student_id'])."</td></tr>";	
									 echo "<tr><td colspan='11'></td></tr>";
									
									
									
								  
								
								   echo  "<tr><td colspan='11' align='center'><b><font color='#03a9f3'>ATTENDANCE REPORT</font></b></td></tr>";
								   
								   echo "<tr><td colspan='2'  align='center'>Year</td>";
									echo "<td colspan='2'  align='center'>Month</td>";
									echo "<td colspan='1'  align='center'>Present</td>";
									echo "<td colspan='1'  align='center'>Late</td>";
									echo "<td colspan='1'  align='center'>Absent</td>";
									echo "<td colspan='2'  align='center'>Total</td>";
									echo "<td colspan='2'  align='center'>Percentage</td></tr>";
									
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
        $query = $this->db->query($sql, array($q['student_id'], $q['student_id'], $q['student_id'], $q['student_id'], $q['student_id']));
        $data = $query->result_array();
                                 //$arrangeData['x']	="\n\n";
                                   foreach($data as $ma)
								   {
				
								  echo "<tr><td colspan='2'  align='center'>"	.$ma['yr']."</td>";
 								 
								  				   if($ma['mnth']==1)
				{
				    echo "<td colspan='2'  align='center'>January</td>";
				 }
				 else if($ma['mnth']==2)
				 {
				      echo "<td colspan='2'  align='center'>February</td>";
				}
				else if($ma['mnth']==3)
				{
				  echo "<td colspan='2'  align='center'>March</td>";
				}
				else if($ma['mnth']==4)
				{
				    echo "<td colspan='2'  align='center'>April</td>";
				}
				else if($ma['mnth']==5)
				{
				   echo "<td colspan='2'  align='center'>May</td>";
				}
				else if($ma['mnth']==6)
				{
				  echo "<td colspan='2'  align='center'>June</td>";
				}
				else if($ma['mnth']==7)
				{
				   echo "<td colspan='2'  align='center'>July</td>";
				}
				else if($ma['mnth']==8)
				{
				   echo "<td colspan='2'  align='center'>August</td>";
				}
				else if($ma['mnth']==9)
				{
				   echo "<td colspan='2'  align='center'>September</td>";
				}
				else if($ma['mnth']==10)
				{
				   echo "<td colspan='2'  align='center'>October</td>";
				}
				else if($ma['mnth']==11)
				{
				   echo "<td colspan='2'  align='center'>November</td>";
				}
				else if($ma['mnth']==12)
				{
				   echo "<td colspan='2'  align='center'>December</td>";
				}

								 echo "<td colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
								 echo "<td colspan='1'  align='center'>".$ma['late_cnt']."</td>";
								 echo "<td colspan='1'  align='center'>".$ma['absent_cnt']."</td>";
								//if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
//                                echo "<td colspan='1'  align='center'>".$ma['diary_cnt']."</td>";
//                																} 
               
                   						 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
											$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
											}
											else
											{
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; } 
                 									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                  									 $present =  $ma['present_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];}
                   							else{
				   									$present =  $ma['present_cnt'] + $ma['late_cnt'] ;}
													if($total>0){
								 					$perc =  round(($present/$total)*100,2);
								                      }
													  else{
													  $perc =  0;
													  }
								 echo "<td colspan='2'  align='center'>".$total."</td>";
								 echo "<td colspan='2'  align='center'>".$perc."</td>";

								 }
 								   //echo  "</br><table border='1'><tr><td colspan='11' align='center'></td></tr>";
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";

								   echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>MARK REPORT</font></b></td></tr>";
								    $exams = $this->crud_model->get_exams($class_id);
									foreach ($exams as $row2){

                                   echo	 "<tr><td colspan='11' align='left'><b>Exam Name:".$row2['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font align='right'>rank:".get_rank($row2['exam_id'],$q['student_id'])."</font></b></td></tr>";
								    echo "<tr><td colspan='3'  align='center'>Subject</td>";
								   echo "<td colspan='2'  align='center'>Marks Obtained</td>";
								   echo "<td colspan='2'  align='center'>Total Mark</td>";
								   echo "<td colspan='2'  align='center'>Percentage</td>";
								   echo "<td colspan='2'  align='center'>Grade</td></tr>";
								   
								   
								    $this->db->select('m.mark_obtained,m.position,m.mark_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$class_id);
									$this->db->where('m.section_id',$p['section_id']);
									$this->db->where('m.exam_id',$row2['exam_id']);
									$this->db->where('m.student_id',$q['student_id']);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();
                                        foreach ($subjects as $row3){
										echo "<tr><td colspan='3'  align='center'>".$row3['subject']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_obtained']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_total']."</td>";
										            $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
													$avg=number_format($average, 2, '.', '');
									 echo "<td colspan='2'  align='center'>".$avg."</td>";
                                                    $r=$this->db->get('grade')->result_array();
													foreach($r as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
									   echo "<td colspan='2'  align='center'>".$grd."</td>";

													$grade_id=$res['grade_id'];
					  

													
													}
													
												  }
                        

									}
									
									}
									
									
									echo "<tr><td colspan='11'  align='center'></td></tr>";

									echo "<tr><td colspan='11'  align='center'><u>Signature:</u></td></tr>";
									echo "<tr><td colspan='4'  align='center'></td><td colspan='3'  align='center'></td><td colspan='4'  align='center'></td></tr>";
									echo "<tr><td colspan='4'  align='center'><b>Guardian</b></td><td colspan='3'  align='center'><b>Class Teacher</b></td><td colspan='4'  align='center'><b>Principal</b></td></tr></table></table></table>";

									//$dataToExports[]			= $arrangeData;
									
									
									
							// set header
							   
								
								//$this->exportExcelData1($dataToExports);
								//die();
								
							

		/////////////////////////////////
		
		 }
		 }
		 
		}
		
		
							
	}
  public function student_print_bulk_section($class_id,$section_id,$order='',$migrated='')
	{
	
	
			$yr=get_running_year();	
			ob_start();
			ob_get_clean();
			$filename = "Student_Profile.doc";
			header("Content-Type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=".$filename);
                          
                          $this->db->where('e.class_id',$class_id);
			  $this->db->where('e.section_id',$section_id);
			  $this->db->where('e.year',$yr);
			  $this->crud_model->check_student_status();
			  $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
				if($migrated=='non_migrated')
				{
					$this->db->where('e.is_migrated!=','Y');
				}
			  $query = $this->db->get('enroll e')->result_array();
	 			 foreach($query as $q){

									$total = 0;
									
                                         ?><p style="page-break-before: always"><?php
							   
									    $image_url = base_url() . 'uploads/logo.png';
									    $stu_url = base_url() . 'uploads/student_image/'.$q['student_id'].'.jpg';

                                   echo  "<center><table border='0'><tr><td colspan='6' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr></center>";
   								echo  "<center><table border='0'><tr><td colspan='5'></td><td colspan='3'><img src=".$image_url."  style='padding-left:100px'></td><td colspan='3'></td></tr></center>";
								   
								    echo "<tr><td colspan='11'></td></tr>";
   								    echo "<tr><td colspan='11'></td></tr>";
									
                                    
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h3></br>".get_school()."</h3></td><td colspan='4' align='center'></td></tr>";
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h4></br>".get_school_address()." , Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td><td colspan='4' align='center'></td></tr>";
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr></table>";
   								   

								   echo  "<table border='1'><tr><td colspan='11' align='center'><b><h3>STUDENT PROFILE&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";


									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Name</td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_name($q['student_id'])."</td><td colspan='2'><img src=".$stu_url." width='100px'></td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Roll No</td></td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_roll($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Class/Section</td></td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_class_name($class_id)."-".get_section_name($section_id)."</td></tr>";
									
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Sex</td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_sex($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Phone</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_phone1($q['student_id'])."/".get_student_phone2($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Address</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_address($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Birthday</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_birthday($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Email</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_email($q['student_id'])."</td></tr>";	
									 echo "<tr><td colspan='11'></td></tr>";
									
									
									
							 if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
												{
												
								
								   echo  "<tr><td colspan='11' align='center'><b><font color='#03a9f3'>ATTENDANCE REPORT</font></b></td></tr>";
								   
								   echo "<tr><td colspan='2'  align='center'>Year</td>";
									echo "<td colspan='2'  align='center'>Month</td>";
									echo "<td colspan='1'  align='center'>Present</td>";
									echo "<td colspan='1'  align='center'>Late</td>";
									echo "<td colspan='1'  align='center'>Absent</td>";
									echo "<td colspan='2'  align='center'>Total</td>";
									echo "<td colspan='2'  align='center'>Percentage</td></tr>";
									
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
        $query = $this->db->query($sql, array($q['student_id'], $q['student_id'], $q['student_id'], $q['student_id'], $q['student_id']));
        $data = $query->result_array();
                                 //$arrangeData['x']	="\n\n";
                                   foreach($data as $ma)
								   {
				
								  echo "<tr><td colspan='2'  align='center'>"	.$ma['yr']."</td>";
 								 
								  				   if($ma['mnth']==1)
				{
				    echo "<td colspan='2'  align='center'>January</td>";
				 }
				 else if($ma['mnth']==2)
				 {
				      echo "<td colspan='2'  align='center'>February</td>";
				}
				else if($ma['mnth']==3)
				{
				  echo "<td colspan='2'  align='center'>March</td>";
				}
				else if($ma['mnth']==4)
				{
				    echo "<td colspan='2'  align='center'>April</td>";
				}
				else if($ma['mnth']==5)
				{
				   echo "<td colspan='2'  align='center'>May</td>";
				}
				else if($ma['mnth']==6)
				{
				  echo "<td colspan='2'  align='center'>June</td>";
				}
				else if($ma['mnth']==7)
				{
				   echo "<td colspan='2'  align='center'>July</td>";
				}
				else if($ma['mnth']==8)
				{
				   echo "<td colspan='2'  align='center'>August</td>";
				}
				else if($ma['mnth']==9)
				{
				   echo "<td colspan='2'  align='center'>September</td>";
				}
				else if($ma['mnth']==10)
				{
				   echo "<td colspan='2'  align='center'>October</td>";
				}
				else if($ma['mnth']==11)
				{
				   echo "<td colspan='2'  align='center'>November</td>";
				}
				else if($ma['mnth']==12)
				{
				   echo "<td colspan='2'  align='center'>December</td>";
				}

								 echo "<td colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
								 echo "<td colspan='1'  align='center'>".$ma['late_cnt']."</td>";
								 echo "<td colspan='1'  align='center'>".$ma['absent_cnt']."</td>";
								//if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
//                                echo "<td colspan='1'  align='center'>".$ma['diary_cnt']."</td>";
//                																} 
               
                   						 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
											$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
											}
											else
											{
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; } 
                 									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                  									 $present =  $ma['present_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];}
                   							else{
				   									$present =  $ma['present_cnt'] + $ma['late_cnt'] ;}
													if($total>0){
								 					$perc =  round(($present/$total)*100,2);
								                      }
													  else{
													  $perc =  0;
													  }
								 echo "<td colspan='2'  align='center'>".$total."</td>";
								 echo "<td colspan='2'  align='center'>".$perc."</td>";

								 }
 								   //echo  "</br><table border='1'><tr><td colspan='11' align='center'></td></tr>";
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";
								   }
								   
								   

								   echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>MARK REPORT</font></b></td></tr>";
								    $exams = $this->crud_model->get_exams($class_id);
									foreach ($exams as $row2){

                                   echo	 "<tr><td colspan='11' align='left'><b>Exam Name:".$row2['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font align='right'>Rank:".get_rank($row2['exam_id'],$q['student_id'])."</font></b></td></tr>";
								    echo "<tr><td colspan='3'  align='center'>Subject</td>";
								   echo "<td colspan='2'  align='center'>Marks Obtained</td>";
								   echo "<td colspan='2'  align='center'>Total Mark</td>";
								   echo "<td colspan='2'  align='center'>Percentage</td>";
								   echo "<td colspan='2'  align='center'>Grade</td></tr>";
								   
								   
								    $this->db->select('m.mark_obtained,m.position,m.mark_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$class_id);
									$this->db->where('m.section_id',$section_id);
									$this->db->where('m.exam_id',$row2['exam_id']);
									$this->db->where('m.student_id',$q['student_id']);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();
                                        foreach ($subjects as $row3){
										echo "<tr><td colspan='3'  align='center'>".$row3['subject']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_obtained']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_total']."</td>";
										$average=0;
										             if($row3['mark_total']>0){
										            $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
													}
													else{
													echo "0";
													}
													$avg=number_format($average, 2, '.', '');
									 echo "<td colspan='2'  align='center'>".$avg."</td>";
                                                    $r=$this->db->get('grade')->result_array();
													foreach($r as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
									   echo "<td colspan='2'  align='center'>".$grd."</td>";

													$grade_id=$res['grade_id'];
					  

													
													}
													
												  }
                        

									}
									
									}
									
									
									echo "<tr><td colspan='11'  align='center'></td></tr>";

									echo "<tr><td colspan='11'  align='center'><u>Signature:</u></td></tr>";
									echo "<tr><td colspan='4'  align='center'></td><td colspan='3'  align='center'></td><td colspan='4'  align='center'></td></tr>";
									echo "<tr><td colspan='4'  align='center'><b>Guardian</b></td><td colspan='3'  align='center'><b>Class Teacher</b></td><td colspan='4'  align='center'><b>Principal</b></td></tr></table></table></table>";

									//$dataToExports[]			= $arrangeData;
									
									
									
							// set header
							   
								
							
								//$this->exportExcelData1($dataToExports);
								//die();
								
							

		/////////////////////////////////
		
		 }
		 
		 }
		 
		
	
 
		
	
 
 
 
 
 
 public function student_print_report($student_id)
	{
	
	// die();
		$this->db->select('class_id,section_id');
		$this->db->from('enroll');
		$this->db->where('student_id',$student_id);
		$q=$this->db->get()->row();
	
		//$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
								ob_start();
									ob_get_clean();
							// set header
							   
								$filename = "Student_Profile-".$student_id.".xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
									$total = 0;
									
                       ?> <div style="page-break-before:always"><?php
							   //$dataToExports = [];
	   								   //echo  "<table border='1'><tr><td colspan='10' align='center'><b><h2><img src=uploads/student_image/".$student_id.".jpg">"</h2></b></td></tr>";
									   echo '<p style="page-break-before: always">';
									    $image_url = base_url() . 'uploads/logo.png';
									    $stu_url = base_url() . 'uploads/student_image/'.$student_id.'.jpg';

                                   echo  "<table border='0'><tr><td colspan='4' align='center'></td><td colspan='3' align='center'></td><td colspan='4' align='center'></td></tr>";
   								   echo  "<tr><td colspan='4' align='center'></td><td colspan='2' align='center'><img src=".$image_url." style='padding-left:100px'></td><td colspan='4' align='center'></td></tr>";
								    echo "<tr><td colspan='11'></td></tr>";
   								    echo "<tr><td colspan='11'></td></tr>";

								   echo "<tr><td colspan='11' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
   								   

								   echo  "<table border='1'><tr><td colspan='11' align='center'><b><h3>STUDENT PROFILE&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";


									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Name</td><td colspan='1'  align='center'>:</td><td colspan='6'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_name($student_id)."</td><img src=".$stu_url." height='20%' width='16%' hspace='20%'></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Roll No</td></td><td colspan='1'  align='center'>:</td><td colspan='6'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_roll($student_id )."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Class/Section</td></td><td colspan='1'  align='center'>:</td><td colspan='6'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_class_name($q->class_id)."-".get_section_name($q->section_id )."</td></tr>";
									
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Sex</td></td><td colspan='1'  align='center'>:</td><td colspan='6'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_sex($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Phone</td></td><td colspan='1'  align='center'>:</td><td colspan='6'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_phone1($student_id)."/".get_student_phone2($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Address</td></td><td colspan='1'  align='center'>:</td><td colspan='6'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_address($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Birthday</td></td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_birthday($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Email</td></td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_email($student_id)."</td></tr>";	
									
									
									
									
								  
								
								   echo  "</br><table border='1'><tr><td colspan='11' align='center'><b><font color='#03a9f3'>ATTENDANCE REPORT</font></b></td></tr>";
								   
								   echo "<tr><td colspan='2'  align='center'>Year</td>";
									echo "<td colspan='2'  align='center'>Month</td>";
									echo "<td colspan='1'  align='center'>Present</td>";
									echo "<td colspan='1'  align='center'>Late</td>";
									echo "<td colspan='1'  align='center'>Absent</td>";
									echo "<td colspan='1'  align='center'>No Diary</td>";
									echo "<td colspan='1'  align='center'>Total</td>";
									echo "<td colspan='2'  align='center'>Percentage</td>";
									
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
        $data = $query->result_array();
                                 //$arrangeData['x']	="\n\n";
                                   foreach($data as $ma)
								   {
				
								  echo "<tr><td colspan='2'  align='center'>"	.$ma['yr']."</td>";
 								 
								  				   if($ma['mnth']==1)
				{
				    echo "<td colspan='2'  align='center'>January</td>";
				 }
				 else if($ma['mnth']==2)
				 {
				      echo "<td colspan='2'  align='center'>February</td>";
				}
				else if($ma['mnth']==3)
				{
				  echo "<td colspan='2'  align='center'>March</td>";
				}
				else if($ma['mnth']==4)
				{
				    echo "<td colspan='2'  align='center'>April</td>";
				}
				else if($ma['mnth']==5)
				{
				   echo "<td colspan='2'  align='center'>May</td>";
				}
				else if($ma['mnth']==6)
				{
				  echo "<td colspan='2'  align='center'>June</td>";
				}
				else if($ma['mnth']==7)
				{
				   echo "<td colspan='2'  align='center'>July</td>";
				}
				else if($ma['mnth']==8)
				{
				   echo "<td colspan='2'  align='center'>August</td>";
				}
				else if($ma['mnth']==9)
				{
				   echo "<td colspan='2'  align='center'>September</td>";
				}
				else if($ma['mnth']==10)
				{
				   echo "<td colspan='2'  align='center'>October</td>";
				}
				else if($ma['mnth']==11)
				{
				   echo "<td colspan='2'  align='center'>November</td>";
				}
				else if($ma['mnth']==12)
				{
				   echo "<td colspan='2'  align='center'>December</td>";
				}

								 echo "<td colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
								 echo "<td colspan='1'  align='center'>".$ma['late_cnt']."</td>";
								 echo "<td colspan='1'  align='center'>".$ma['absent_cnt']."</td>";
								if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
                                echo "<td colspan='1'  align='center'>".$ma['diary_cnt']."</td>";
                																} 
               
                   						 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
											$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
											}
											else
											{
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; } 
                 									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                  									 $present =  $ma['present_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];}
                   							else{
				   									$present =  $ma['present_cnt'] + $ma['late_cnt'] ;}
													if($total>0){
								 					$perc =  round(($present/$total)*100,2);
								                      }
													  else{
													  $perc =  0;
													  }
								 echo "<td colspan='1'  align='center'>".$total."</td>";
								 echo "<td colspan='2'  align='center'>".$perc."</td>";

								 }
 								   //echo  "</br><table border='1'><tr><td colspan='11' align='center'></td></tr>";

								   echo  "</br><table border='1'><tr><td colspan='11' align='center'><b><font color='#0f6a92'>MARK REPORT</font></b></td></tr>";
								    $exams = $this->crud_model->get_exams($q->class_id);
									foreach ($exams as $row2){

                                   echo	 "<tr><td colspan='11' align='left'><b>Exam Name:".$row2['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font align='right'>rank:".get_rank($row2['exam_id'],$student_id)."</font></b></td></tr>";
								    echo "<tr><td colspan='3'  align='center'>Subject</td>";
								   echo "<td colspan='2'  align='center'>Marks Obtained</td>";
								   echo "<td colspan='2'  align='center'>Total Mark</td>";
								   echo "<td colspan='2'  align='center'>Percentage</td>";
								   echo "<td colspan='2'  align='center'>Grade</td></tr>";
								   
								   
								    $this->db->select('m.mark_obtained,m.position,m.mark_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$q->class_id);
									$this->db->where('m.section_id',$q->section_id);
									$this->db->where('m.exam_id',$row2['exam_id']);
									$this->db->where('m.student_id',$student_id);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();
                                        foreach ($subjects as $row3){
										echo "<tr><td colspan='3'  align='center'>".$row3['subject']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_obtained']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_total']."</td>";
													if($row3['mark_total']>0){
										            $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
													}
																										$avg=number_format($average, 2, '.', '');
									 echo "<td colspan='2'  align='center'>".$avg."</td>";
                                                    $p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
									   echo "<td colspan='2'  align='center'>".$grd."</td>";

													$grade_id=$res['grade_id'];
					  

													
													}
													
												  }
                        

									}
									
									}
									
									
									echo "<tr><td colspan='11'  align='center'></td></tr>";

									echo "<tr><td colspan='11'  align='center'><u>Signature:</u></td></tr>";
									echo "<tr><td colspan='4'  align='center'></td><td colspan='3'  align='center'></td><td colspan='4'  align='center'></td></tr>";
									echo "<tr><td colspan='4'  align='center'><b>Guardian</b></td><td colspan='3'  align='center'><b>Class Teacher</b></td><td colspan='4'  align='center'><b>Principal</b></td></tr>";

									//$dataToExports[]			= $arrangeData;
									
									
									
							
								//$this->exportExcelData1($dataToExports);
								//die();
								
							

		/////////////////////////////////
		
		
	}
	 public function student_area_report($student_id)
	{
	    echo $student_id;
	    die();
		$this->db->select('class_id,section_id');
		$this->db->from('enroll');
		$this->db->where('student_id',$student_id);
		$q=$this->db->get()->row();
	
		//$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		if (isset($_POST['chk_excel']))
		{
									ob_start();
									ob_get_clean();
									$filename = "Student_Profile-".$student_id.".xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
									$total = 0;
									$i=1;

							   //$dataToExports = [];
	   								   //echo  "<table border='1'><tr><td colspan='10' align='center'><b><h2><img src=uploads/student_image/".$student_id.".jpg">"</h2></b></td></tr>";
									    $image_url = base_url() . 'uploads/logo.png';
									    $stu_url = base_url() . 'uploads/student_image/'.$student_id.'.jpg';


   								   echo  "<table border='1'><tr><td colspan='3' align='center'><img src=".$stu_url." height='32%' width='18%'></td><td colspan='7' align='center'><img src=".$image_url." height='12%' width='13%'><b><h2>".get_school()."</h2></b><br><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";
   								   

								   echo  "<table border='1'><tr><td colspan='10' align='center'><b><h3>STUDENT PROFILE&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";


									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Name</td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_name($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Roll No</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_roll($student_id )."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Class/Section</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_class_name($q->class_id)."-".get_section_name($q->section_id )."</td></tr>";
									
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Sex</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_sex($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Phone</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_phone1($student_id)."/".get_student_phone2($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Address</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_address($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Birthday</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_birthday($student_id)."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Email</td></td><td colspan='1'  align='center'>:</td><td colspan='7'  align='left'>&nbsp;&nbsp;&nbsp;"	.get_student_email($student_id)."</td></tr>";	
									
									
									
									
								   echo  "</br><table border='1'><tr><td colspan='10' align='center'></td></tr>";
								
								   echo  "</br><table border='1'><tr><td colspan='10' align='center'><b>ATTENDANCE REPORT</b></td></tr>";
								   
								   echo "<tr><td colspan='2'  align='center'>Year</td>";
									echo "<td colspan='2'  align='center'>Month</td>";
									echo "<td colspan='1'  align='center'>Present</td>";
									echo "<td colspan='1'  align='center'>Late</td>";
									echo "<td colspan='1'  align='center'>Absent</td>";
									echo "<td colspan='1'  align='center'>No Diary</td>";
									echo "<td colspan='1'  align='center'>Total</td>";
									echo "<td colspan='1'  align='center'>Percentage</td>";
									
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
        $data = $query->result_array();
                                 $arrangeData['x']	="\n\n";
                                   foreach($data as $ma)
								   {
				
								  echo "<tr><td colspan='2'  align='center'>"	.$ma['yr']."</td>";
 								 
								  				   if($ma[mnth]==1)
				{
				    echo "<tr><td colspan='2'  align='center'>January</td>";
				 }
				 else if($ma[mnth]==2)
				 {
				      echo "<td colspan='2'  align='center'>February</td>";
				}
				else if($ma[mnth]==3)
				{
				  echo "<td colspan='2'  align='center'>March</td>";
				}
				else if($ma[mnth]==4)
				{
				    echo "<td colspan='2'  align='center'>April</td>";
				}
				else if($ma[mnth]==5)
				{
				   echo "<td colspan='2'  align='center'>May</td>";
				}
				else if($ma[mnth]==6)
				{
				  echo "<td colspan='2'  align='center'>June</td>";
				}
				else if($ma[mnth]==7)
				{
				   echo "<td colspan='2'  align='center'>July</td>";
				}
				else if($ma[mnth]==8)
				{
				   echo "<td colspan='2'  align='center'>August</td>";
				}
				else if($ma[mnth]==9)
				{
				   echo "<td colspan='2'  align='center'>September</td>";
				}
				else if($ma[mnth]==10)
				{
				   echo "<td colspan='2'  align='center'>October</td>";
				}
				else if($ma[mnth]==11)
				{
				   echo "<td colspan='2'  align='center'>November</td>";
				}
				else if($ma[mnth]==12)
				{
				   echo "<td colspan='2'  align='center'>December</td>";
				}

								 echo "<td colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
								 echo "<td colspan='1'  align='center'>".$ma['late_cnt']."</td>";
								 echo "<td colspan='1'  align='center'>".$ma['absent_cnt']."</td>";
								if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
                                echo "<td colspan='1'  align='center'>".$ma['diary_cnt']."</td>";
                																} 
               
                   						 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
											$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
											}
											else
											{
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; } 
                 									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                  									 $present =  $ma['present_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];}
                   							else{
				   									$present =  $ma['present_cnt'] + $ma['late_cnt'] ;}
								 					$perc =  round(($present/$total)*100,2);
								 
								 echo "<td colspan='1'  align='center'>".$total."</td>";
								 echo "<td colspan='1'  align='center'>".$perc."</td>";

								 }
 								   echo  "</br><table border='1'><tr><td colspan='10' align='center'></td></tr>";

								   echo  "</br><table border='1'><tr><td colspan='10' align='center'><b>MARK REPORT</b></td></tr>";
								    $exams = $this->crud_model->get_exams($q->class_id);
									foreach ($exams as $row2){

                                   echo	 "<tr><td colspan='10' align='left'>Exam Name:".$row2['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font align='right'>rank:".get_rank($row2['exam_id'],$student_id)."</font></td></tr>";
								    echo "<tr><td colspan='2'  align='center'>Subject</td>";
								   echo "<td colspan='2'  align='center'>Marks Obtained</td>";
								   echo "<td colspan='2'  align='center'>Total Mark</td>";
								   echo "<td colspan='2'  align='center'>Percentage</td>";
								   echo "<td colspan='2'  align='center'>Grade</td></tr>";
								   
								   
								    $this->db->select('m.mark_obtained,m.position,m.mark_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$q->class_id);
									$this->db->where('m.section_id',$q->section_id);
									$this->db->where('m.exam_id',$row2['exam_id']);
									$this->db->where('m.student_id',$student_id);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();
                                        foreach ($subjects as $row3){
										echo "<tr><td colspan='2'  align='center'>".$row3['subject']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_obtained']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_total']."</td>";
										            $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
													$avg=number_format($average, 2, '.', '');
									 echo "<td colspan='2'  align='center'>".$avg."</td>";
                                                    $p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
									   echo "<td colspan='2'  align='center'>".$grd."</td>";

													$grade_id=$res['grade_id'];
					  

													
													}
													
												  }
                        

									}
									
									}
									
									
									echo "<tr><td colspan='10'  align='center'></td></tr>";

									echo "<tr><td colspan='10'  align='center'><u>Signature:</u></td></tr>";
									echo "<tr><td colspan='3'  align='center'></td><td colspan='3'  align='center'></td><td colspan='4'  align='center'></td></tr>";
									echo "<tr><td colspan='3'  align='center'><b>Guardian</b></td><td colspan='3'  align='center'><b>Class Teacher</b></td><td colspan='4'  align='center'><b>Principal</b></td></tr>";

									$dataToExports[]			= $arrangeData;
									
									
									
							// set header
								
								//$this->exportExcelData1($dataToExports);
								die();
								}
							

		/////////////////////////////////
		
	}
	public function student_area_print_report($class_id,$migrated='')
	{
	$running_year   =   get_running_year();
	$class_name=$this->db->get_where('class ',array('class_id'=>$class_id))->row();
	    
		$this->db->join('section se','e.section_id=se.section_id','LEFT');
		$this->db->join('student s','e.student_id=s.student_id','LEFT');
		$this->crud_model->check_student_status();
		if($migrated=='non_migrated')
		{
			$this->db->where('e.is_migrated!=','Y');
		}
		$query_result = $this->db->get_where('enroll e',array('e.class_id'=>$class_id,'e.year'=>$running_year))->result_array();

		
		
		////////////////////////////// Export to Excel
		
		
			ob_start();
			ob_get_clean();
			$filename = "StudentsList.xls";
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$filename);

		//$this->exportExcelData($dataToExports);
			$total = 0;
			$i=1;
			$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='4'></td><td colspan='3'  align='center'><img src=".$image_url."  style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='9'></td></tr>";
			  echo "<tr><td colspan='9'></td></tr>";
			   echo "<tr><td colspan='9'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
								echo "<tr><td colspan='9' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
								echo  "<table border='0'><tr><td colspan='9' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								echo  "<table border='0'><tr><td colspan='9' align='center'><b><h3>CLASS: ".$class_name->name."</h3></b></td></tr>";
								
								echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Roll No.</td><td colspan='1'  align='left'>Admission No.</td><td colspan='1'  align='left'>Name</td><td colspan='1'  align='left'>Date of Birth</td><td colspan='1'  align='left'>Father's Name</td><td colspan='1'  align='left'>Mother's Name</td><td colspan='1'  align='left'>Phone1</td><td colspan='1'  align='left'>Phone2</td><td colspan='1'  align='left'>Address</td><td colspan='1'  align='left'>Email</td><td colspan='1'  align='left'>Class/section</td></tr>";
							 
								foreach ($query_result as $data)
								{
								
								
								echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".get_student_roll($data['student_id'])."</td><td colspan='1'  align='left'>".$data['admission_number']."</td><td colspan='1'  align='left'>".get_student_name($data['student_id'])."</td><td colspan='1'  align='left'>".$data['birthday']."</td><td colspan='1'  align='left'>".$data['parent']."</td><td colspan='1'  align='left'>".$data['mother_name']."</td><td colspan='1'  align='left'>".get_student_phone1($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_phone2($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_address($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_email($data['student_id'])."</td>
								<td colspan='1'  align='left'>".$class_name->name."/".get_section_name($data['section_id'])."</td></tr>";
								
									//$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}

								
			

		/////////////////////////////////
		
		
	}
	
	
	public function student_area_print_report_all($branch_id='',$dept_id='',$migrated='')
	{
	$yr=get_running_year();
	$this->db->select('e.student_id as student_id,c.name as class,se.name as section,s.name,s.admission_number,s.birthday,s.parent,s.mother_name');
	$this->db->join('class c','e.class_id=c.class_id','LEFT');
	$this->db->join('section se','e.section_id=se.section_id','LEFT');
	 $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
	 if($branch_id!='')
	 {
	   $this->db->where('c.branch_id',$branch_id);
	 }
	
	  if($dept_id!='')
	 {
	   $this->db->where('c.dept_id',$dept_id);
	 }
	
	 
	//$this->db->where('c.branch_id',$this->session->userdata('branch_id'));
	//$this->db->where('c.dept_id',$this->session->userdata('dept_id'));
	$this->db->where('e.year',$yr);
	$this->crud_model->check_student_status();
		 if($migrated=='non_migrated')
		 {
			$this->db->where('e.is_migrated!=','Y');
		 }
		$this->db->order_by('c.name','asc');
		$this->db->order_by('se.name','asc');
		$this->db->order_by('s.name','asc');
		$query_result = $this->db->get('enroll e')->result_array();

		
		
		////////////////////////////// Export to Excel
		
		
			ob_start();
			ob_get_clean();
			$filename = "StudentsList.xls";
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$filename);

		//$this->exportExcelData($dataToExports);
			$total = 0;
			$i=1;
			$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='4'></td><td colspan='3'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='7'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
								echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".$this->db->get_where('tbl_academic_year',array('acdemic_year_id'=>get_running_year()))->row()->academic_year."</h3></b></td></tr>";
								if($branch_id!='') {
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>Branch:".get_branch($branch_id)."</h3></b></td></tr>";
								}
								if($dept_id!='') {
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>Department:".get_dept($dept_id)."</h3></b></td></tr>";
								}
								echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Roll No.</td><td colspan='1'  align='left'>Admsn.No.</td><td colspan='1'  align='left'>Name</td><td colspan='1'  align='left'>Date of Birth</td><td colspan='1'  align='left'>Father's Name</td><td colspan='1'  align='left'>Mother's Name</td><td colspan='1'  align='left'>Phone1</td><td colspan='1'  align='left'>Phone2</td><td colspan='1'  align='left'>Address</td><td colspan='1'  align='left'>Email</td><td colspan='1'  align='left'>Class/Section</td></tr>";
							 
								foreach ($query_result as $data)
								{
								
								
								echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".get_student_roll($data['student_id'])."</td><td colspan='1'  align='left'>".$data['admission_number']."</td><td colspan='1'  align='left'>".get_student_name($data['student_id'])."</td><td colspan='1'  align='left'>".$data['birthday']."</td><td colspan='1'  align='left'>".$data['parent']."</td><td colspan='1'  align='left'>".$data['mother_name']."</td><td colspan='1'  align='left'>".get_student_phone1($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_phone2($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_address($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_email($data['student_id'])."</td><td colspan='1'  align='left'>".$data['class']."/".$data['section']."</td></tr>";
								
									//$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}

								
			

		/////////////////////////////////
		
		
	}
	
	public function student_area_print_report_section($class_id='',$section_id='',$order='',$migrated='')
	{
		$class_name=$this->db->get_where('class ',array('class_id'=>$class_id))->row();
		$section_name=$this->db->get_where('section ',array('section_id'=>$section_id))->row();
		$yr=get_running_year();
		      $this->db->where('e.class_id',$class_id);
			  $this->db->where('e.section_id',$section_id);
			  $this->db->where('e.year',$yr);
			  $this->crud_model->check_student_status();
			  $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
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
					if($migrated=='non_migrated')
					{
						$this->db->where('e.is_migrated!=','Y');
					}
			  $query_result = $this->db->get('enroll e')->result_array();
		
                
		
		
		////////////////////////////// Export to Excel
		
		
			ob_start();
			ob_get_clean();
			$filename = "StudentsList.xls";
			header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$filename);

		//$this->exportExcelData($dataToExports);
			$total = 0;
			$i=1;
			$image_url = base_url() . 'uploads/logo.png';
			echo  "<table border='0'><tr><td colspan='4'></td><td colspan='3'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
									
			 echo "<tr><td colspan='7'></td></tr>";
   								   

								   //$dataToExports = [];
echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
								echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>STUDENTS LIST&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";
								echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>CLASS:".$class_name->name."&nbsp;&nbsp;SECTION: ".$section_name->name."</h3></b></td></tr>";
								
								echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Roll No.</td><td colspan='1'  align='left'>Admission No.</td><td colspan='1'  align='left'>Name</td><td colspan='1'  align='left'>Date of Birth</td><td colspan='1'  align='left'>Father's Name</td><td colspan='1'  align='left'>Mother's Name</td><td colspan='1'  align='left'>Phone1</td><td colspan='1'  align='left'>Phone2</td><td colspan='1'  align='left'>Address</td><td colspan='1'  align='left'>Email</td><td colspan='1'  align='left'>Class/Section</td></tr>";
							 
								foreach ($query_result as $data)
								{
								
								
								echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".get_student_roll($data['student_id'])."</td><td colspan='1'  align='left'>".$data['admission_number']."</td><td colspan='1' align='left'>".get_student_name($data['student_id'])."</td><td colspan='1' align='left'>".$data['birthday']."</td><td colspan='1' align='left'>".$data['parent']."</td><td colspan='1' align='left'>".$data['mother_name']."</td><td colspan='1'  align='left'>".get_student_phone1($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_phone2($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_address($data['student_id'])."</td><td colspan='1'  align='left'>".get_student_email($data['student_id'])."</td><td colspan='1'  align='left'>".$class_name->name."/".$section_name->name."</td></tr>";
								
									//$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}

								
			

		/////////////////////////////////
		
		
	}
	
	
	public function student_print_bulk_section1($class_id='',$section='',$order='')
	{   
		$class_id	    =	$this->input->post('class_id');
		$section	    =	$this->input->post('section');
		$student_id	    =	$this->input->post('student_id');
		$exam		    =	$this->input->post('exam');
		$home_test	    =	$this->input->post('home_test');
		$entrance_test	=	$this->input->post('entrance_test');
		$months			=	$this->input->post('months[]');
		$month_count	=	count($months);
                $yr                 =   get_running_year();
		if($month_count>0)
		{
			$month_list		=	"(";
			for($i=0;$i<$month_count;$i++)
			{
				if($i+1!=$month_count)	
				{
					$month_list	=	$month_list.$months[$i].",";
				}
				else
				{
					$month_list	=	$month_list.$months[$i].")";
				}
			}
		}
		
		      $this->db->where('e.class_id',$class_id);
			  $this->db->where('e.section_id',$section);
			  if($student_id!='')
			  {
			  		$this->db->where('e.student_id',$student_id);
			  }		
			  $this->db->where('e.year',$yr);
			  $this->crud_model->check_student_status();
			  $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
			  
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
					 else
					 {
					      $this->db->order_by('e.roll', 'asc');
					 }
			  
			  $query = $this->db->get('enroll e')->result_array();
		if (isset($_POST['prog_pdf']))
		{
			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$data1['section_id']				=	$section;
			$data1['class_id']					=	$class_id;
			$data1['month_count']				=	$month_count;
			$data1['month_list']				=	$month_list;
			$sata1['entrance_test']				=	$entrance_test;
			$data1['home_test']					=	$home_test;
			if(isset($_POST['exam'])){
			$data1['exam']						=	$exam; }
			$data1['student_data']				=	$query;
	
			$html								=	$this->load->view('admin/pdf_progress_report',$data1,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output($data['data'][0]->reference_no.'progress_report.pdf','D');	
			die();
		}
		
		if (isset($_POST['prog_excel']))
		{
			ob_start();
				ob_get_clean();
		
												$filename = "Student_Profile.doc";
								header("Content-Type: application/vnd.ms-word");
								header("Content-Disposition: attachment; filename=".$filename);

		
	 	foreach($query as $q){
	 								
		////////////////////////////// Export to Excel
			
		    
				$total = 0;
					  $image_url = base_url() . 'uploads/logo.png';
									    $stu_url = base_url() . 'uploads/student_image/'.$q['student_id'].'.jpg';
				
                  ?>
                  
           <DIV style="page-break-after:always"></DIV>
				
				<?php 
									  
                                   echo  "<center><table border='0'><tr><td colspan='5' align='center'></td><td colspan='3' align='center'></td><td colspan='3' align='center'></td></tr></center></table>";
   								echo  "<center><table border='0'><tr><td colspan='3'></td><td rowspan='4'><img height='100px' width='80px' src=".$image_url."  style='padding-left:100px'></td><td colspan='0'></td></tr></center>";
								   
								    echo "<tr><td colspan='11'></td></tr>";
   								    echo "<tr><td colspan='11'></td></tr>";
									
                                    
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h3></br>".get_school()."</h3></td><td colspan='4' align='center'></td></tr>";
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h4></br>".get_school_address()." , Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td><td colspan='4' align='center'></td></tr>";
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr></table>";
   								   
								   

								   echo  "<table border='1'><tr><td colspan='11' align='center'><b><h3>STUDENT PROFILE&nbsp;&nbsp;&nbsp;".get_running_year()."</h3></b></td></tr>";

								  

									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Name</td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_name($q['student_id'])."</td><td colspan='3'><img src=".$stu_url." width='200px'></td></tr>";
									  if(isset($_POST['profile']))
			{
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Roll No</td></td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_roll($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Class/Section</td></td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_class_name($class_id)."-".get_section_name($section)."</td></tr>";
									
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Sex</td><td colspan='1'  align='center'>:</td><td colspan='5'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_sex($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Phone</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_phone1($q['student_id'])."/".get_student_phone2($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Address</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_address($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Birthday</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_birthday($q['student_id'])."</td></tr>";
									echo "<tr><td colspan='2'  align='left'>&nbsp;&nbsp;&nbsp;Email</td><td colspan='1'  align='center'>:</td><td colspan='8'  align='left'>&nbsp;&nbsp;&nbsp;".get_student_email($q['student_id'])."</td></tr>";	
									 echo "<tr><td colspan='11'></td></tr>";
									}
//Attendance Start									
								   if(isset($_POST['attendance']))
									{
/*If afternoon attendance is NOT there.*/if($this->db->get_where('settings' , array('type' => 'afternoon_attendance'))->row()->description!='yes')
										{
								   echo  "<tr><td colspan='11' align='center'><b><font color='#03a9f3'>ATTENDANCE REPORT</font></b></td></tr>";
								   
								   echo "<tr><td colspan='2'  align='center'>Year</td>";
									echo "<td colspan='2'  align='center'>Month</td>";
									echo "<td colspan='1'  align='center'>Present</td>";
									echo "<td colspan='1'  align='center'>Late</td>";
									echo "<td colspan='1'  align='center'>Absent</td>";
									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
										{
										echo "<td colspan='1'  align='center'>No Daiary</td>";
										}
									echo "<td colspan='2'  align='center'>Total</td>";
									echo "<td colspan='2'  align='center'>Percentage</td></tr>";
									
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
			 WHERE a1.`student_id`=?";
			 if($month_count>0)
			 {
			 	$sql = $sql." and MONTH(FROM_UNIXTIME(`timestamp`)) IN ".$month_list;
			 }
            $sql = $sql." GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`))";
        $query = $this->db->query($sql, array($q['student_id'], $q['student_id'], $q['student_id'], $q['student_id'], $q['student_id']));
        $data = $query->result_array();
                                 //$arrangeData['x']	="\n\n";
                                   foreach($data as $ma)
								   {
				
								  echo "<tr><td colspan='2'  align='center'>"	.$ma['yr']."</td>";
 								 
								  				   if($ma['mnth']==1)
										{
											echo "<td colspan='2'  align='center'>January</td>";
										 }
										 else if($ma['mnth']==2)
										 {
											  echo "<td colspan='2'  align='center'>February</td>";
										}
										else if($ma['mnth']==3)
										{
										  echo "<td colspan='2'  align='center'>March</td>";
										}
										else if($ma['mnth']==4)
										{
											echo "<td colspan='2'  align='center'>April</td>";
										}
										else if($ma['mnth']==5)
										{
										   echo "<td colspan='2'  align='center'>May</td>";
										}
										else if($ma['mnth']==6)
										{
										  echo "<td colspan='2'  align='center'>June</td>";
										}
										else if($ma['mnth']==7)
										{
										   echo "<td colspan='2'  align='center'>July</td>";
										}
										else if($ma['mnth']==8)
										{
										   echo "<td colspan='2'  align='center'>August</td>";
										}
										else if($ma['mnth']==9)
										{
										   echo "<td colspan='2'  align='center'>September</td>";
										}
										else if($ma['mnth']==10)
										{
										   echo "<td colspan='2'  align='center'>October</td>";
										}
										else if($ma['mnth']==11)
										{
										   echo "<td colspan='2'  align='center'>November</td>";
										}
										else if($ma['mnth']==12)
										{
										   echo "<td colspan='2'  align='center'>December</td>";
										}
						
								 echo "<td colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
								 echo "<td colspan='1'  align='center'>".$ma['late_cnt']."</td>";
								 echo "<td colspan='1'  align='center'>".$ma['absent_cnt']."</td>";
								if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
                                echo "<td colspan='1'  align='center'>".$ma['diary_cnt']."</td>";
                																} 
               
                   						 if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
											$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
											}
											else
											{
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; } 
                 									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                  									 $present =  $ma['present_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];}
                   							else{
				   									$present =  $ma['present_cnt'] + $ma['late_cnt'] ;}
													if($total>0){
								 					$perc =  round(($present/$total)*100,2);
								                      }
													  else{
													  $perc =  0;
													  }
								 echo "<td colspan='2'  align='center'>".$total."</td>";
								 echo "<td colspan='2'  align='center'>".$perc."</td>";

								 }

								} 
/*If afternoon attendance is there....*/
								else
								{
								   echo  "<tr><td colspan='11' align='center'><b><font color='#03a9f3'>ATTENDANCE REPORT</font></b></td></tr>";
								   
								   echo "<tr><td colspan='2'  align='center'>Year</td>";
									echo "<td colspan='2'  align='center'>Month</td>";
									echo "<td colspan='1'  align='center'>Present</td>";
									echo "<td colspan='1'  align='center'>Late</td>";
									echo "<td colspan='1'  align='center'>Absent</td>";
									if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
										{
										echo "<td colspan='1'  align='center'>No Daiary</td>";
										}
									echo "<td colspan='2'  align='center'>Total</td>";
									echo "<td colspan='2'  align='center'>Percentage</td></tr>";
									
                                 $sql = "SELECT a1.`student_id`,
           								 YEAR(FROM_UNIXTIME(a1.`timestamp`)) as yr,
			   							MONTH(FROM_UNIXTIME(a1.`timestamp`)) as mnth,
           								 a2.present_cnt,
 								           a3.absent_cnt,
								            a4.late_cnt,
							            a5.diary_cnt

                                 FROM `attendance` a1 
                               left JOIN 
                              (SELECT (count(`attendance_id`)/2) as present_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=1 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a2 on (a1.`student_id`= a2.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a2.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a2.mnth 
            ) 
            
			left JOIN (SELECT (count(`attendance_id`)/2) as absent_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=2 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a3 on (a1.`student_id`= a3.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a3.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a3.mnth ) 
            
			left JOIN (SELECT (count(`attendance_id`)/2) as late_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=3 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a4 on (a1.`student_id`= a4.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a4.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a4.mnth ) 
			
			left JOIN (SELECT (count(`attendance_id`)/2) as diary_cnt,`student_id`,YEAR(FROM_UNIXTIME(`timestamp`)) as yr,MONTH(FROM_UNIXTIME(`timestamp`)) as mnth FROM `attendance` WHERE `status`=4 AND `student_id`=? GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`)) ) 
            a5 on (a1.`student_id`= a5.`student_id` AND YEAR(FROM_UNIXTIME(a1.`timestamp`)) = a5.yr AND MONTH(FROM_UNIXTIME(a1.`timestamp`)) = a5.mnth )  
			 WHERE a1.`student_id`=?";
			 if($month_count>0)
			 {
			 	$sql = $sql." and MONTH(FROM_UNIXTIME(`timestamp`)) IN ".$month_list;
			 }
            $sql = $sql." GROUP BY YEAR(FROM_UNIXTIME(`timestamp`)),MONTH(FROM_UNIXTIME(`timestamp`))";
        $query = $this->db->query($sql, array($q['student_id'], $q['student_id'], $q['student_id'], $q['student_id'], $q['student_id']));
        $data = $query->result_array();
                                 //$arrangeData['x']	="\n\n";
                                   foreach($data as $ma)
								   {
				
								  echo "<tr><td colspan='2'  align='center'>"	.$ma['yr']."</td>";
 								 
								  				   if($ma['mnth']==1)
										{
											echo "<td colspan='2'  align='center'>January</td>";
										 }
										 else if($ma['mnth']==2)
										 {
											  echo "<td colspan='2'  align='center'>February</td>";
										}
										else if($ma['mnth']==3)
										{
										  echo "<td colspan='2'  align='center'>March</td>";
										}
										else if($ma['mnth']==4)
										{
											echo "<td colspan='2'  align='center'>April</td>";
										}
										else if($ma['mnth']==5)
										{
										   echo "<td colspan='2'  align='center'>May</td>";
										}
										else if($ma['mnth']==6)
										{
										  echo "<td colspan='2'  align='center'>June</td>";
										}
										else if($ma['mnth']==7)
										{
										   echo "<td colspan='2'  align='center'>July</td>";
										}
										else if($ma['mnth']==8)
										{
										   echo "<td colspan='2'  align='center'>August</td>";
										}
										else if($ma['mnth']==9)
										{
										   echo "<td colspan='2'  align='center'>September</td>";
										}
										else if($ma['mnth']==10)
										{
										   echo "<td colspan='2'  align='center'>October</td>";
										}
										else if($ma['mnth']==11)
										{
										   echo "<td colspan='2'  align='center'>November</td>";
										}
										else if($ma['mnth']==12)
										{
										   echo "<td colspan='2'  align='center'>December</td>";
										}
										
								if(preg_match('/^\d+\.\d+$/',$ma['present_cnt']))
								{
									echo "<td colspan='1'  align='center'>".number_format((float)($ma['present_cnt']), 1, '.', '')."</td>";	
								}
								else
								{
									echo "<td colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
								}
								if(preg_match('/^\d+\.\d+$/',$ma['late_cnt']))
								{
									echo "<td colspan='1'  align='center'>".number_format((float)($ma['late_cnt']), 1, '.', '')."</td>";	
								}
								else
								{
									echo "<td colspan='1'  align='center'>".$ma['late_cnt']."</td>";	
								}
								if(preg_match('/^\d+\.\d+$/',$ma['absent_cnt']))
								{
									echo "<td colspan='1'  align='center'>".number_format((float)($ma['absent_cnt']), 1, '.', '')."</td>";	
								}
								else
								{
									echo "<td colspan='1'  align='center'>".$ma['absent_cnt']."</td>";	
								}
								if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
									if(preg_match('/^\d+\.\d+$/',$ma['diary_cnt']))
									{
										echo "<td colspan='1'  align='center'>".number_format((float)$ma['diary_cnt'], 1, '.', '')."</td>";	
									}
									else
									{
										echo "<td colspan='1'  align='center'>".$ma['diary_cnt']."</td>";	
									}
								
                				} 
               
                   						 	if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
											}
											else
											{
												$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; 
											} 
                 							if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 

                  									 $present =  $ma['present_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];}
                   							else{
				   									$present =  $ma['present_cnt'] + $ma['late_cnt'] ;
												}
													if($total>0){
								 					$perc =  round(($present/$total)*100,2);
								                      }
													  else{
													  $perc =  0;
													  }
									if(is_float($total))
									{
										echo "<td colspan='2'  align='center'>".number_format((float)$total, 1, '.', '')."</td>";	
									}
									else
									{
										echo "<td colspan='2'  align='center'>".$total."</td>";	
									}
								 echo "<td colspan='2'  align='center'>".$perc."</td>";

								 }
								}
			}
								
								 if(isset($_POST['exam']))
									{
 								   //echo  "</br><table border='1'><tr><td colspan='11' align='center'></td></tr>";
								   if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
										{
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";
								for($i=0; $i<count($exam); $i++)
								{
								   echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>MARK REPORT</font></b></td></tr>";
								    $exams = $this->crud_model->get_exams1($class_id,$exam[$i]);
									foreach ($exams as $row2){
									
                                   echo	 "<tr><td colspan='11' align='left'><b>Exam Name:".$row2['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font align='right'>Rank:".get_rank($row2['exam_id'],$q['student_id'])."</font></b></td></tr>";
								    echo "<tr><td colspan='3'  align='center'>Subject</td>";
								   echo "<td colspan='2'  align='center'>Marks Obtained</td>";
								   echo "<td colspan='2'  align='center'>Total Mark</td>";
								   echo "<td colspan='2'  align='center'>Percentage</td>";
								   echo "<td colspan='2'  align='center'>Grade</td></tr>";
								   
								   
								    $this->db->select('m.mark_obtained,m.position,m.mark_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$class_id);
									$this->db->where('m.section_id',$section);
									$this->db->where('m.exam_id',$row2['exam_id']);
									$this->db->where('m.student_id',$q['student_id']);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();
                                        foreach ($subjects as $row3){
										echo "<tr><td colspan='3'  align='center'>".$row3['subject']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_obtained']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_total']."</td>";
										$average=0;
										if( $row3['mark_total']>0)
										            $average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
													$avg=number_format($average, 2, '.', '');
									 echo "<td colspan='2'  align='center'>".$avg."</td>";
                                                    $r=$this->db->get('grade')->result_array();
													foreach($r as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
									   echo "<td colspan='2'  align='center'>".$grd."</td>";

													$grade_id=$res['grade_id'];
					  

													}
													}
													
												  }
                        

									}
									
									}
								}
								/****If internal mark is there******/	
								else
								{
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";
								for($i=0; $i<count($exam); $i++)
								{
								   echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>MARK REPORT</font></b></td></tr>";
								    $exams = $this->crud_model->get_exams1($class_id,$exam[$i]);
									foreach ($exams as $row2){
									
                                   echo	 "<tr><td colspan='11' align='left'><b>Exam Name:".$row2['name']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font align='right'>Rank:".get_rank($row2['exam_id'],$q['student_id'])."</font></b></td></tr>";
								   echo "<tr><td colspan='1'  align='center'>Subject</td>";
								   echo "<td colspan='2'  align='center'>Internal</td>";
								   echo "<td colspan='1'  align='center'>Marks Obtained</td>";
								   echo "<td colspan='2'  align='center'>Total Mark</td>";
								   echo "<td colspan='1'  align='center'>Total</td>";
								   echo "<td colspan='2'  align='center'>Percentage</td>";
								   echo "<td colspan='2'  align='center'>Grade</td></tr>";
								   
								   
								    $this->db->select('m.mark_obtained,m.position,m.mark_total,m.internal_marks,m.internal_total,s.name as subject');
									$this->db->from('mark m');
									$this->db->join('subject s','m.subject_id=s.subject_id');
									$this->db->where('m.class_id',$class_id);
									$this->db->where('m.section_id',$section);
									$this->db->where('m.exam_id',$row2['exam_id']);
									$this->db->where('m.student_id',$q['student_id']);
                                        $query = $this->db->get();
                                        $subjects = $query->result_array();
                                        foreach ($subjects as $row3){
										echo "<tr><td colspan='1'  align='center'>".$row3['subject']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['internal_marks'].'/'.$row3['internal_total']."</td>";
										echo "<td colspan='1'  align='center'>".$row3['mark_obtained']."</td>";
										echo "<td colspan='2'  align='center'>".$row3['mark_total']."</td>";
										$total=$row3['internal_total']+$row3['mark_total'];
										$total_obtained=$row3['internal_marks']+$row3['mark_obtained'];
										echo "<td colspan='1'  align='center'>".$total_obtained.'/'.$total."</td>";
										$average=0;
										if( $total>0)
										            $average = (($total_obtained / $total) * 100);
													$avg=number_format($average, 2, '.', '');
									 				echo "<td colspan='2'  align='center'>".$avg."</td>";
                                                    $r=$this->db->get('grade')->result_array();
													foreach($r as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grd=$res['grade'];
									   echo "<td colspan='2'  align='center'>".$grd."</td>";

													$grade_id=$res['grade_id'];
					  

													}
													}
													
												  }
                        

									}
									
									}
								}	
									
									
							}
									
									if(isset($_POST['home_test']))
									{
										echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";
										echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>HOME TEST REPORT</font></b></td></tr>";
										for($i=0; $i<count($home_test); $i++)
										{	
											$tests = $this->crud_model->get_home_tests($class_id,$section,$home_test[$i],$q['student_id']);
											foreach ($tests as $row2){
												//$this->crud_model->get_home_test_rank($class_id,$section,$exam_id);
                                   				echo "<tr><td colspan='6' align='left'><b>Exam Name: ".$row2['exam_name']."<br /> Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row2['details']."</b></td>";
												echo "<td colspan='5' align='left'><b>Date&nbsp;&nbsp;: ".date('d/m/Y',strtotime($row2['date_exam']))."</b></td></tr>";
												echo "<tr><td colspan='3'  align='center'>Subject</td>";
												echo "<td colspan='2'  align='center'>Marks Obtained</td>";
												echo "<td colspan='2'  align='center'>Total Mark</td>";
												echo "<td colspan='2'  align='center'>Percentage</td>";
												echo "<td colspan='2'  align='center'>Grade</td></tr>";
												
								   				
												
												echo "<tr><td colspan='3'  align='center'>".$row2['subject_name']."</td>";
												echo "<td colspan='2'  align='center'>".$row2['mark_obtained']."</td>";
												echo "<td colspan='2'  align='center'>".$row2['mark_total']."</td>";
												$average=0;
												if( $row2['mark_total']>0)
															$average = (($row2['mark_obtained'] / $row2['mark_total']) * 100);
															$avg=number_format($average, 2, '.', '');
											 	echo "<td colspan='2'  align='center'>".$avg."</td>";
												echo "<td colspan='2'  align='center'>".$row2['grade']."</td>";
												
												}
								   
										}	
									}
									
									if(isset($_POST['entrance_test']))
									{
									    
										echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";
										echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>ENTRANCE TEST REPORT</font></b></td></tr>";
										for($i=0; $i<count($entrance_test); $i++)
										{	
											$tests = $this->crud_model->get_entrance_tests($class_id,$section,$entrance_test[$i],$q['student_id']);
											foreach ($tests as $row2){
												//$this->crud_model->get_home_test_rank($class_id,$section,$exam_id);
                                   				echo "<tr><td colspan='6' align='left'><b>Exam Name: ".$row2['exam_name']."<br /> Details&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$row2['details']."</b></td>";
												echo "<td colspan='5' align='left'><b>Date&nbsp;&nbsp;: ".date('d/m/Y',strtotime($row2['date_exam']))."</b></td></tr>";
												echo "<tr><td colspan='3'  align='center'>Subject</td>";
												echo "<td colspan='2'  align='center'>Marks Obtained</td>";
												echo "<td colspan='2'  align='center'>Total Mark</td>";
												echo "<td colspan='2'  align='center'>Percentage</td>";
												echo "<td colspan='2'  align='center'>Grade</td></tr>";
												
								   				
												
												echo "<tr><td colspan='3'  align='center'>".$row2['subject_name']."</td>";
												echo "<td colspan='2'  align='center'>".$row2['mark_obtained']."</td>";
												echo "<td colspan='2'  align='center'>".$row2['mark_total']."</td>";
												$average=0;
												if( $row2['mark_total']>0)
															$average = (($row2['mark_obtained'] / $row2['mark_total']) * 100);
															$avg=number_format($average, 2, '.', '');
											 	echo "<td colspan='2'  align='center'>".$avg."</td>";
												echo "<td colspan='2'  align='center'>".$row2['grade']."</td>";
												
												}
								   
										}	
									}
							//Fee details start	   
								   if(isset($_POST['fee_details']))
								   {
										echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>FEE PAYMENT DETAILS</font></b></td></tr>";
										/*$this->db->where('admission_number', $q['student_id']);
										$this->db->where('class_id', $class_id);
										$this->db->where('batch_id', $section);
										$this->db->select('admission_number,date_paid,receipt_number,fee_head,fee_amount');
										//$this->db->group_by('receipt_number','asc');
										$this->db->order_by('receipt_number','asc');
										$this->db->from('view_fee_collection_details');
										
										$fee_details		=	$this->db->get()->result_array();*/
										
                                                                        
                                                                        //echo $qry;die;
                                                                        $fee_details		=	$this->Fee_management_model->progress_report_fee_data($q['student_id'],$class_id,$section);        
                                                                        //$fee_details		=	$this->db->query($qry)->result_array();        
                                                                        //print_r($fee_details);die;        
										$sno=1;
										$total_amount_paid = 0;
										if(count($fee_details)>0)
										{
											echo "<tr><td colspan='1'>Sl.No</td><td colspan='3'>Date Paid</td><td colspan='2'>Receipt No.</td><td colspan='3'>Fee Head</td><td colspan='2'>Amount</td></tr>";
											foreach($fee_details as $fee_data)
											{
                                                                                            $fee_due_year   =   '';
                                                                                            if($fee_data['fee_due_year']!=='0')
                                                                                            {
                                                                                                $fee_due_year=  '(Due:'.$fee_data['fee_due_year'].')';
                                                                                            }
												echo "<tr>";
												echo "<td colspan='1'>".$sno."</td>";
												echo "<td colspan='3'>".date('d-m-Y',strtotime($fee_data['date_paid']))."</td>";
												echo "<td colspan='2'>".$fee_data['receipt_number']."</td>";
												echo "<td colspan='3'>".$fee_data['fee_head'].$fee_due_year."</td>";
												echo "<td colspan='2'>".number_format($fee_data['fee_amount'],2)."</td>";
												echo "</tr>";
												$total_amount_paid		 = $total_amount_paid+$fee_data['fee_amount'];
												$sno=$sno+1;
											}
											echo "<tr>";
											echo "<td colspan='9' style='text-align:right;'>Total</td><td colspan='2'>".number_format($total_amount_paid,2)."</td></tr>";
										}
										else
										{
											echo  "<tr><td colspan='11' align='center'><b><font color='red'>No Payment Details Found...</font></b></td></tr>";
										}
								   }
							//Fee details end
									echo "<tr><td colspan='11'  align='center'></td></tr>";

									echo "<tr><td colspan='11'  align='center'><u>Signature:</u></td></tr>";
									echo "<tr><td colspan='4'  align='center'></td><td colspan='3'  align='center'></td><td colspan='4'  align='center'></td></tr>";
									echo "<tr><td colspan='4'  align='center'><b>Guardian</b></td><td colspan='3'  align='center'><b>Class Teacher</b></td><td colspan='4'  align='center'><b>Principal</b></td></tr></table></table></table>";
		    ?>
		    <br style="page-break-after:always" />
		    <?php 
		 }
								
		}
	} 

		 


public function expense_report($category='',$from_date='',$to_date='') 
	{ 
	
	$category_exp=$this->crud_model->expence_view($category,$from_date,$to_date);
	
	  ob_start();
	  ob_get_clean();
	   $image_url = base_url() . 'uploads/logo.png';
									   
								
                                  
							      
								    echo "<html>";
									 echo "<center>";
								   
								     echo  "<table border='0'><tr><td colspan='5' align='center'></td><td colspan='3' align='center'></td><td colspan='3' align='center'></td></tr></table>";
   								echo  "<table border='0'><tr><td colspan='3'></td><td rowspan='4'><img height='100px' width='80px' src=".$image_url."  style='padding-left:100px'></td><td colspan='0'></td></tr>";
								   
								    echo "<tr><td colspan='11'></td></tr>";
   								    echo "<tr><td colspan='11'></td></tr>";
									 echo "<tr><td colspan='11'></td></tr>";
									
                                    
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h3></br>".get_school()."</h3></td><td colspan='4' align='center'></td></tr>";
									echo  "<tr><td colspan='5' align='center'></td><td colspan='2' align='center'><h4></br>".get_school_address()." , Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td><td colspan='4' align='center'></td></tr>";
								   echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr></table>";
   								   
								   

								   echo  "<table border='1'><tr><td colspan='11' align='center'><b><h3>Expense Report&nbsp;&nbsp;&nbsp;</h3></b></td></tr>";
								   if($from_date!='' && $to_date!='' && $from_date!=0 && $to_date!=0)
								    echo  "<tr><td colspan='11'  align='center'>From " .date('d-m-Y',strtotime( $from_date)) . " To " .date('d-m-Y',strtotime(  $to_date)). "</td></tr>";

						
						         
						        /*  echo  "<tr><td colspan='4'  align='center'>From " .date('d-m-Y',strtotime( $from_date)) . " To " .date('d-m-Y',strtotime(  $to_date)). "</td></tr>";
								  echo  "\tbranch : \t" . get_branch($branch_id ). "\n\n";
								   echo  "\tdepartment : \t" . get_dept($dept_id ). "\n\n";
								   echo  "\tClass : \t" . get_class_name($class_id ). "\n\n";
									echo  "\tSection:  \t" . get_section_name( $section_id ). "\n\n\n";
									echo  "<tr><td>Date</td>";*/
									echo  "<tr><td>Sl.No</td><td colspan='2'>Expense Date</td><td colspan='2'>Category</td><td colspan='2'>Amount</td><td colspan='2'>Give to</td><td colspan='2'>Remark</td>";
							    $i=1;	
								$total=0;	
								foreach($category_exp as $data)
								{
									$arrangeData['Sl.No'] 		             = $i;
									$arrangeData['Expense Date'] 	         = $data['expense_date'];
									$arrangeData['Category'] 		         = $data['category_name'];
									$arrangeData['Amount'] 		             = $data['amount'];
									$arrangeData['Give to'] 	             = $data['give_to'];
									$arrangeData['Remark'] 	                 = $data['remark'];
									 echo "<tr>";
									 echo "<td>" .$i. "</td>";
									  echo "<td colspan='2'>" .$data['expense_date']. "</td>";
									 echo "<td colspan='2'>" .$data['category_name']. "</td>";
									 echo "<td colspan='2'>" .$data['amount']. "</td>";
									 echo "<td colspan='2'>" .$data['give_to']. "</td>";
									 echo "<td colspan='2'>" .$data['remark']. "</td>";
									 echo "</tr>";
									$i=$i+1;
									$total=$total+$data['amount'];
									
								}
								echo "<tr><th colspan='5'>"."Total"."</th>
                                                <td align='right' colspan='2'>".$total."</td></tr>";
								echo "</body>";
								echo  "</center>";
						        echo "</html>";	
								// set header
								$filename = "ExpenseReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								die();
	
	}


	
	public function exportExcelData1($records)
{
  $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", ($row)) . "\n";
            }
 }
	 

////////////////////-------Moby---start------//////////////////////

	public function student_area_print_report_all_pdf($branch_id='',$dept_id='',$migrated='')
	{
            $yr=get_running_year();
		$this->db->select('e.student_id as student_id,c.name as class,se.name as section,s.name,s.admission_number,s.birthday,s.parent,s.mother_name');
		$this->db->join('class c','e.class_id=c.class_id','LEFT');
		$this->db->join('section se','e.section_id=se.section_id','LEFT');
		$this->db->join('student s','s.student_id=e.student_id', 'LEFT');
		if($branch_id!='')
		{
			$this->db->where('c.branch_id',$branch_id);
		}
		if($dept_id!='')
		{
			$this->db->where('c.dept_id',$dept_id);
		}
		
		$this->db->where('e.year',$yr);
		$this->db->order_by('c.name','asc');
		$this->db->order_by('se.name','asc');
		$this->db->order_by('s.name','asc');
		$this->crud_model->check_student_status();
		if($migrated=='non_migrated')
		{
		$this->db->where('e.is_migrated!=','Y');
		}
		$data['student_data'] = $this->db->get('enroll e')->result_array();
		
			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$data['branch_id']					=	$branch_id;
			$data['dept_id']					=	$dept_id;
			$html								=	$this->load->view('admin/pdf_student_list_all',$data,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output($data['data'][0]->reference_no.'student_list.pdf','D');	
			die();
	}

	public function student_area_print_report_pdf($class_id='',$migrated='')
	{
		$running_year   =   get_running_year();
		$class_name=$this->db->get_where('class ',array('class_id'=>$class_id))->row();
	    
		$this->db->join('section se','e.section_id=se.section_id','LEFT');
		$this->db->join('student s','e.student_id=s.student_id','LEFT');
		$this->crud_model->check_student_status();
		if($migrated=='non_migrated')
		{
			$this->db->where('e.is_migrated!=','Y');
		}
		$data['student_data'] = $this->db->get_where('enroll e',array('e.class_id'=>$class_id,'e.year'=>$running_year))->result_array();
			ini_set('display_errors', 0);
		
			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$data['class_id']					=	$class_id;
			$html								=	$this->load->view('admin/pdf_student_list_class',$data,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output($data['data'][0]->reference_no.'student_list.pdf','D');	
			die();
	}

	public function student_area_print_report_section_pdf($class_id='',$section_id='',$order='',$migrated='')
	{
		$class_name=$this->db->get_where('class ',array('class_id'=>$class_id))->row();
		$section_name=$this->db->get_where('section ',array('section_id'=>$section_id))->row();
		$yr=get_running_year();
		  $this->db->where('e.class_id',$class_id);
		  $this->db->where('e.section_id',$section_id);
		  $this->db->where('e.year',$yr);
		  $this->crud_model->check_student_status();
		  $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
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
			if($migrated=='non_migrated')
			{
				$this->db->where('e.is_migrated!=','Y');
			}
			 $data['student_data'] = $this->db->get('enroll e')->result_array();

			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$data['class_id']					=	$class_id;
			$data['section_id']					=	$section_id;
			$html								=	$this->load->view('admin/pdf_student_list_section',$data,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output($data['data'][0]->reference_no.'student_list.pdf','D');	
			die();
	}

		public function expense_report_pdf($category='',$from_date='',$to_date='') 
		{
			if($category!=''||$from_date!=''||$to_date!='')
			{
				$data['category_exp'] = $this->crud_model->expence_view($category,$from_date,$to_date);
			}
			else
			{
				$data['category_exp'] = $this->crud_model->expence_view('','','');
			}

			ob_start();
			$html 								=	ob_get_clean();
			$html 								= 	utf8_encode($html);
			$html								=	$this->load->view('admin/pdf_expense',$data,true);
			include(APPPATH.'third_party/mpdf/mpdf.php');
			$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->allow_charset_conversion 	= true;
			$mpdf->charset_in = 'UTF-8';
			$mpdf->WriteHTML($html);
			$mpdf->Output($data['data'][0]->reference_no.'Expense_report.pdf','I');	
			die();
		}



///////////////////-----------moby----end------//////////////////////	
}