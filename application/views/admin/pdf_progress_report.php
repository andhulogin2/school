<head>
<title>STUDENT DETAILS</title>
</head>
<body>
<?php
 $class = get_class_name($class_id);
  $section = get_section_name($section_id);
 ?>

<div style="padding-left:50px;padding-right:50px;">
<?php
foreach($student_data as $row)
{
?>
<div style="text-align:center;padding-top:20px"><img src="<?php echo base_url() . 'uploads/logo.png'; ?>" height='9%' width='12%' ></div>
<div style="text-align:center;padding-bottom:20px"><h3><?php echo get_school() ?>,
<?php echo get_school_address() ?><br>
<?php echo get_school_phone() ?>,<?php echo get_school_mail() ?></h3></div>
<table id="simple-table" class="table table-striped table-bordered table-hover" width="100%"  cellpadding="2" style="border:1px solid;border-collapse:collapse">
<?php if(isset($_POST['profile']))
{ ?>

<tr><td style="border:1px solid;text-align:center" colspan="12"><b><font color='#0f6a92'>STUDENT PROFILE</font></b></td></tr>
<tr><td colspan="2" style="border:1px solid">Name</td><td colspan="8" style="border:1px solid"><?php echo $row['name']; ?></td><td rowspan="4" colspan="2" style="border:1px solid"><img src="<?php echo base_url() . 'uploads/student_image/'.$row['student_id'].'.jpg'; ?>" height='12%' width='13%' > </td></tr>
<tr><td colspan="2" style="border:1px solid">Roll No.</td ><td colspan="8" style="border:1px solid"><?php echo $row['roll']; ?></td></tr>
<tr><td colspan="2" style="border:1px solid">Class/Section</td><td colspan="8" style="border:1px solid"><?php echo $class."/".$section;  ?></td></tr>
<tr><td colspan="2" style="border:1px solid">Sex</td><td colspan="8" style="border:1px solid"><?php echo $row['sex']; ?></td></tr>
<tr><td colspan="2" style="border:1px solid">Phone</td><td colspan="10" style="border:1px solid"><?php echo $row['phone1']; ?></td></tr>
<tr><td colspan="2" style="border:1px solid">Address</td><td colspan="10" style="border:1px solid"><?php echo $row['address']; ?></td></tr>
<tr><td colspan="2" style="border:1px solid">Birthday</td><td colspan="10" style="border:1px solid"><?php echo $row['birthday']; ?></td></tr>
<tr><td colspan="2" style="border:1px solid">Email</td><td colspan="10" style="border:1px solid"><?php echo $row['email']; ?></td></tr>
<?php 
}



if(isset($_POST['attendance']))
{
	/*If afternoon attendance is NOT there.*/
	if($this->db->get_where('settings' , array('type' => 'afternoon_attendance'))->row()->description!='yes')
	{
		echo  "<tr><td style='border:1px solid' colspan='12' align='center'><b><font color='#0f6a92'>ATTENDANCE REPORT</font></b></td></tr>";
		
		echo "<tr><td style='border:1px solid' colspan='2'  align='center'>Year</td>";
		echo "<td style='border:1px solid' colspan='2'  align='center'>Month</td>";
		echo "<td style='border:1px solid' colspan='1'  align='center'>Present</td>";
		echo "<td style='border:1px solid' colspan='1'  align='center'>Late</td>";
		echo "<td style='border:1px solid' colspan='1'  align='center'>Absent</td>";
		if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
		{
			echo "<td style='border:1px solid' colspan='1'  align='center'>No Daiary</td>";
		}
		echo "<td style='border:1px solid' colspan='2'  align='center'>Total</td>";
		echo "<td style='border:1px solid' colspan='2'  align='center'>Percentage</td></tr>";
		
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
		$query = $this->db->query($sql, array($row['student_id'], $row['student_id'], $row['student_id'], $row['student_id'], $row['student_id']));
		$data = $query->result_array();
		//$arrangeData['x']	="\n\n";
		foreach($data as $ma)
		{
			echo "<tr><td  style='border:1px solid'  colspan='2'  align='center'>"	.$ma['yr']."</td>";
			
			if($ma['mnth']==1)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>January</td>";
			}
			else if($ma['mnth']==2)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>February</td>";
			}
			else if($ma['mnth']==3)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>March</td>";
			}
			else if($ma['mnth']==4)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>April</td>";
			}
			else if($ma['mnth']==5)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>May</td>";
			}
			else if($ma['mnth']==6)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>June</td>";
			}
			else if($ma['mnth']==7)
			{
				echo "<td  style='border:1px solid'  colspan='2'  align='center'>July</td>";
			}
			else if($ma['mnth']==8)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>August</td>";
			}
			else if($ma['mnth']==9)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>September</td>";
			}
			else if($ma['mnth']==10)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>October</td>";
			}
			else if($ma['mnth']==11)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>November</td>";
			}
			else if($ma['mnth']==12)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>December</td>";
			}
			
			echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
			echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['late_cnt']."</td>";
			echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['absent_cnt']."</td>";
			if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['diary_cnt']."</td>";
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
			echo "<td style='border:1px solid'  colspan='2'  align='center'>".$total."</td>";
			echo "<td style='border:1px solid'  colspan='2'  align='center'>".$perc."</td></tr>";
			
		}
		
	} 
	/*If afternoon attendance is there....*/
	else
	{
		echo  "<tr><td style='border:1px solid'  colspan='12' align='center'><b><font color='#0f6a92'>ATTENDANCE REPORT</font></b></td></tr>";
		
		echo "<tr><td style='border:1px solid'  colspan='2'  align='center'>Year</td>";
		echo "<td style='border:1px solid'  colspan='2'  align='center'>Month</td>";
		echo "<td style='border:1px solid'  colspan='1'  align='center'>Present</td>";
		echo "<td style='border:1px solid'  colspan='1'  align='center'>Late</td>";
		echo "<td style='border:1px solid'  colspan='1'  align='center'>Absent</td>";
		if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
		{
			echo "<td style='border:1px solid'  colspan='1'  align='center'>No Daiary</td>";
		}
		echo "<td style='border:1px solid'  colspan='2'  align='center'>Total</td>";
		echo "<td style='border:1px solid'  colspan='2'  align='center'>Percentage</td></tr>";
		
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
		$query = $this->db->query($sql, array($row['student_id'], $row['student_id'], $row['student_id'], $row['student_id'], $row['student_id']));
		$data = $query->result_array();
		//$arrangeData['x']	="\n\n";
		foreach($data as $ma)
		{
			echo "<tr><td style='border:1px solid'  colspan='2'  align='center'>"	.$ma['yr']."</td>";
			
			if($ma['mnth']==1)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>January</td>";
			}
			else if($ma['mnth']==2)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>February</td>";
			}
			else if($ma['mnth']==3)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>March</td>";
			}
			else if($ma['mnth']==4)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>April</td>";
			}
			else if($ma['mnth']==5)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>May</td>";
			}
			else if($ma['mnth']==6)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>June</td>";
			}
			else if($ma['mnth']==7)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>July</td>";
			}
			else if($ma['mnth']==8)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>August</td>";
			}
			else if($ma['mnth']==9)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>September</td>";
			}
			else if($ma['mnth']==10)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>October</td>";
			}
			else if($ma['mnth']==11)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>November</td>";
			}
			else if($ma['mnth']==12)
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>December</td>";
			}
			
			if(preg_match('/^\d+\.\d+$/',$ma['present_cnt']))
			{
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".number_format((float)($ma['present_cnt']), 1, '.', '')."</td>";	
			}
			else
			{
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['present_cnt']."</td>";	
			}
			if(preg_match('/^\d+\.\d+$/',$ma['late_cnt']))
			{
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".number_format((float)($ma['late_cnt']), 1, '.', '')."</td>";	
			}
			else
			{
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['late_cnt']."</td>";	
			}
			if(preg_match('/^\d+\.\d+$/',$ma['absent_cnt']))
			{
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".number_format((float)($ma['absent_cnt']), 1, '.', '')."</td>";	
			}
			else
			{
				echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['absent_cnt']."</td>";	
			}
			if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') 
			{ 
				if(preg_match('/^\d+\.\d+$/',$ma['diary_cnt']))
				{
					echo "<td style='border:1px solid'  colspan='1'  align='center'>".number_format((float)$ma['diary_cnt'], 1, '.', '')."</td>";	
				}
				else
				{
					echo "<td style='border:1px solid'  colspan='1'  align='center'>".$ma['diary_cnt']."</td>";	
				}
			} 
			
			if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') { 
				$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt'] + $ma['diary_cnt'];
			}
			else
			{
				$total =  $ma['present_cnt'] + $ma['absent_cnt'] + $ma['late_cnt']; 
			} 
			if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1') 
			{ 
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
				echo "<td style='border:1px solid'  colspan='2'  align='center'>".number_format((float)$total, 1, '.', '')."</td>";	
			}
			else
			{
				echo "<td style='border:1px solid'  colspan='2'  align='center'>".$total."</td>";	
			}
			echo "<td style='border:1px solid'  colspan='2'  align='center'>".$perc."</td></tr>";
			
		}
	}
}




if($exam){
	for($i=0; $i<count($exam); $i++)
	{
	?>
	 <tr><td colspan='12' style="border:1px solid" align='center'><b><font color='#0f6a92'>MARK REPORT</font></b></td></tr>
<?php		$exams = $this->crud_model->get_exams1($class_id,$exam[$i]);
		foreach ($exams as $row2){
		?>
									
     <tr><td colspan='6' style="border:1px solid" align='left'><b>Exam Name:<?php echo $row2['name']; ?></b></td><td colspan='6' style="border:1px solid" align='left'><b><font align='right'>Rank:<?php echo get_rank($row2['exam_id'],$row['student_id']); ?></font></b></td></tr>
	 <tr><td colspan='3' style="border:1px solid"  align='center'>Subject</td>
	 <?php if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description=='yes')
	 {?>
	 <td colspan='1'  style="border:1px solid" align='center'>Internal</td>
     <td colspan='2' style="border:1px solid" align='center'>Marks Obtained</td>
	 <?php } else { ?>
     <td colspan='3' style="border:1px solid" align='center'>Marks Obtained</td>
     <?php } ?>
     <td colspan='2' style="border:1px solid"  align='center'>Total Mark</td>   	 
     <td colspan='2' style="border:1px solid"  align='center'>Percentage</td>
     <td colspan="2" style="border:1px solid"  align='center'>Grade</td></tr>								   
								   
	<?php
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('exam_id',$row2['exam_id']);
		$this->db->where('student_id',$row['student_id']);
			$query = $this->db->get('mark');
			$subjects = $query->result_array();
			foreach ($subjects as $row3)
			{ 
            $subject_id = $this->db->get_where("subject", array('subject_id'=> $row3['subject_id']))->row()->name;
			?>
			 <tr><td colspan='3' style="border:1px solid"  align='center'><?php echo $subject_id; ?></td>  
			<?php if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description=='yes')
			{?>
			 <td colspan='1'  style="border:1px solid" align='center'><?php echo $row3['internal_marks'].'/'.$row3['internal_total']; ?></td>
             <td colspan='2'  style="border:1px solid"  align='center'><?php echo $row3['mark_obtained']; ?></td>
			 <?php } else { ?>
             <td colspan='3'  style="border:1px solid"  align='center'><?php echo $row3['mark_obtained']; ?></td>
             <?php } ?>
			 <td colspan='2'  style="border:1px solid"  align='center'><?php echo $row3['mark_total']; ?></td>
			<?php 
			$average=0;
			if( $row3['mark_total']>0)
				$average = (($row3['mark_obtained'] / $row3['mark_total']) * 100);
				$avg=number_format($average, 2, '.', ''); ?>
				<td colspan='2' style="border:1px solid"  align='center'><?php echo $avg;?></td>
				<?php $r=$this->db->get('grade')->result_array();
				foreach($r as $res)
				{
					if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
					{
						  $grd=$res['grade']; ?>
						  <td colspan='2' style="border:1px solid" align='center'><?php echo $grd; ?></td>
						  <?php $grade_id=$res['grade_id'];
					}
				}
													
			  }
                        

		}
									
	} }
?>	


<?php
	if(isset($_POST['home_test']))
	{
		echo "<tr><td colspan='11' align='center'><h3></br></h3></b><h4></h4></td></tr>";
		echo  "<tr><td colspan='11' align='center'><b><font color='#0f6a92'>HOME TEST REPORT</font></b></td></tr>";
		for($i=0; $i<count($home_test); $i++)
		{	
			$tests = $this->crud_model->get_home_tests($class_id,$section,$home_test[$i],$row['student_id']);
			foreach ($tests as $row2)
			{
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
			$tests = $this->crud_model->get_entrance_tests($class_id,$section,$entrance_test[$i],$row['student_id']);
			foreach ($tests as $row2)
			{
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
?>



	<?php							  
	 if(isset($_POST['fee_details']))
	{
	echo "<tr><td colspan='12' style='border:1px solid' align='center'><b><font color='#0f6a92'>FEE PAYMENT DETAILS</font></b></td></tr>";
			
			/*$this->db->where('admission_number', $row['student_id']);
			$this->db->where('class_id', $class_id);
			$this->db->where('batch_id', $section_id);
			$this->db->select('admission_number,date_paid,receipt_number,fee_head,fee_amount');
			//$this->db->group_by('receipt_number','asc');
			$this->db->order_by('receipt_number','asc');
			$this->db->from('view_fee_collection_details');
			$fee_details	=	$this->db->get()->result_array();*/
                        $fee_details		=	$this->Fee_management_model->progress_report_fee_data($row['student_id'],$class_id,$section_id);     
		$sno=1;
		$total_amount_paid = 0;
		if(count($fee_details)>0)
		{ ?>
			<tr><td style="border:1px solid" colspan='1'>Sl.No</td><td style="border:1px solid" colspan='3'>Date Paid</td><td style="border:1px solid" colspan='3'>Receipt No.</td><td style="border:1px solid" colspan='3'>Fee Head</td><td style="border:1px solid" colspan='2'>Amount</td></tr>
			<?php foreach($fee_details as $fee_data)
			{ 
                            $fee_due_year   =   '';
                            if($fee_data['fee_due_year']!=='0')
                            {
                                $fee_due_year=  '(Due:'.$fee_data['fee_due_year'].')';
                            }
                            ?>
				<tr><td style="border:1px solid" colspan='1'><?php echo $sno; ?></td>
				<td style="border:1px solid" colspan='3'><?php echo date('d-m-Y',strtotime($fee_data['date_paid']));?></td>
				<td style="border:1px solid" colspan='3'><?php echo $fee_data['receipt_number'];?></td>
				<td style="border:1px solid" colspan='3'><?php echo $fee_data['fee_head'].$fee_due_year; ?></td>
				<td style="border:1px solid" colspan='2'><?php echo number_format($fee_data['fee_amount'],2);?></td></tr>
                
			<?php	$total_amount_paid		 = $total_amount_paid+$fee_data['fee_amount'];
				$sno=$sno+1;
			}
			echo "<tr>";
			echo "<td colspan='10' style='text-align:right;border:1px solid'>Total</td><td style='border:1px solid' colspan='2'>".number_format($total_amount_paid,2)."</td></tr>";
		}
		else
		{ ?>
			<tr><td colspan='12' style="border:1px solid;text-align:center"><b><font color='red'>No Payment Details Found...</font></b></td></tr>
	<?php	}
	}
?>
</tr>
    <tr><td style="border:1px solid" colspan='12'  align='center'><u>Signature:</u></td></tr>
    <tr><td style="border:1px solid;height:40px" colspan='4'  align='center'></td><td style="border:1px solid" colspan='4'  align='center'></td><td style="border:1px solid" colspan='4'  align='center'></td></tr>
    <tr><td style="border:1px solid" colspan='4'  align='center'><b>Guardian</b></td><td style="border:1px solid" colspan='4'  align='center'><b>Class Teacher</b></td><td colspan='4' style="border:1px solid"  align='center'><b>Principal</b></td></tr></table></table></table>

</table>
    <pagebreak />
<?php } ?>