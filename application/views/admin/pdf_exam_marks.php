<head>
<title>STUDENTS MARK SHEET</title>
</head>
<body>
<div style="text-align:center;padding-top:20px">STUDENT MARK LIST</div>
<?php
	$running_year = get_running_year();
	$class = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$section = $this->db->get_where('section' , array('section_id' => $section_id))->row()->name; 
?>

<div style="text-align:center">CLASS  <?php echo $class; ?>/<?php echo $section; ?></div>
<div style="padding-left:50px;padding-right:50px;padding-top:30px">

<?php
if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
{
?>


         <div class="table-responsive">
    <table class="table table-bordered" width="100%" style="border:1px solid;border-collapse:collapse">
			<thead>
				<tr>
				<td style="text-align:center;border:1px solid;width:20%;height:40px" class="table-header">
					Students <i class="fa fa-arrow-circle-down"></i> | Subjects <i class="fa fa-arrow-circle-right"></i>
				</td>
                <?php $a=$this->input->post('send_grade');
				echo $a;?>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
				?>
					<td style="text-align:center;border:1px solid;width:20%" class="table-header">
						<?php echo $row['name'];?> 
					</td>
                     
				<?php endforeach;?>
               
				</tr>
			</thead>
			<tbody>
			<?php
			  $this->db->where('e.class_id',$class_id);
			  $this->db->where('e.section_id',$section_id);
			  $this->db->where('e.year',$running_year);
			  $this->crud_model->check_student_status();
			  $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
			   $this->db->order_by('e.roll', 'asc');
			  $students = $this->db->get('enroll e')->result_array();
				
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align:left;text-transform:capitalize;border:1px solid;height:40px">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;
					  foreach($subjects as $row2): ?>
					<td style="text-align: center;border:1px solid">
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0 && $marks->row()->mark_total!=0) 
							{
								$obtained_marks = $marks->row()->mark_obtained;
								
								$total_marks += $obtained_marks;
								
								$mark_total = $marks->row()->mark_total;
								//echo $obtained_marks;
								$total_marks += $mark_total;
								echo $obtained_marks .'/'.$mark_total;
							}
							else{
							$mark_total=0;
							}
							
						?>
                         <?php if($mark_total==0)
						 {
						 echo "NA";
						 
						 }
						 else{ 
						 $average = ($obtained_marks/$mark_total * 100);
                                                  //echo number_format($average, 2, '.', '');
													$p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  $grade= $res['grade'];
													  //echo $grade;
													  
													  
            }}
			}?>
            
                        
                        
					</td>
				<?php endforeach;?>
				</tr>

			<?php endforeach;?>

			</tbody>
		</table>
        </div>
		
<?php

}
else
{
?>

<div class="table-responsive">
    <table class="table table-bordered" width="100%" style="border:1px solid;border-collapse:collapse">
			<thead>
				<tr>
				<td style="text-align:center;border:1px solid;" class="table-header">
					Students <i class="fa fa-arrow-circle-down"></i> | Subjects <i class="fa fa-arrow-circle-right"></i>
				</td>
                <?php $a=$this->input->post('send_grade');
				echo $a;?>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
				?>
					<td style="text-align:center;border:1px solid;text-transform:capitalize;" colspan="3"  class="table-header" >
                    
					<?php echo $row['name'];?> 
          
					</td>
                     
				<?php endforeach;?>
               
				</tr>
				<tr>
					<th></th>
					<?php
					for($i=0;$i<count($subjects);$i++):
						?>
						<th style="border:1px solid">Internal</th>
						<th style="border:1px solid">Main</th>
						<th style="border:1px solid">Total</th>
						<?php
					endfor;
					?>
				</tr>
			</thead>
			<tbody>
			<?php
			  $this->db->where('e.class_id',$class_id);
			  $this->db->where('e.section_id',$section_id);
			  $this->db->where('e.year',$running_year);
			  $this->crud_model->check_student_status();
			  $this->db->join('student s','s.student_id=e.student_id', 'LEFT');
			   $this->db->order_by('e.roll', 'asc');
			  $students = $this->db->get('enroll e')->result_array();
				
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align:left;text-transform:capitalize;border:1px solid;height:40px">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;
					$tot_mark_obt	=	0;
					$tot_mark		=	0;
					  foreach($subjects as $row2): ?>
					
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0 && $marks->row()->mark_total>0) 
							{
								$obtained_marks = $marks->row()->mark_obtained;
								
								$total_marks += $obtained_marks;
								
								$mark_total = $marks->row()->mark_total;
								//echo $obtained_marks;
								$total_marks += $mark_total;
								
								$internal_marks	=	$marks->row()->internal_marks;
								$internal_total	=	$marks->row()->internal_total;
								
								$one_sub_tot_obt=	$obtained_marks+$internal_marks;
								$one_sub_tot	=	$mark_total+$internal_total;	
								
								$tot_mark_obt	=	$tot_mark_obt+$one_sub_tot_obt;
								$tot_mark		=	$tot_mark+$one_sub_tot;
								
								
								?>
								<td style="text-align: center;border:1px solid">
									<?php
									if($internal_total==null)
									{
									    echo "-";
									}
									else
									{
									    echo $internal_marks .'/'.$internal_total;
									}
									?>
								</td>
								<td style="text-align: center;border:1px solid">
									<?php
										echo $obtained_marks .'/'.$mark_total;
									?>	
								</td>
								<td style="text-align: center;border:1px solid">
									<?php
										echo $one_sub_tot_obt .'/'.$one_sub_tot;
									?>
								</td>
							<?php	
							}
							else{
							$mark_total=0;
							}
							
							
						?>
                         <?php if($mark_total==0)
						 {
						 ?>
						 		<td style="text-align: center;border:1px solid"><?php echo "NA"; ?></td>
								<td style="text-align: center;border:1px solid"><?php echo "NA"; ?></td>
								<td style="text-align: center;border:1px solid"><?php echo "NA"; ?></td>
						 
						 <?php
						 }
						 else{ 
						 $average = ($one_sub_tot_obt/$one_sub_tot * 100);
                                                  //echo number_format($average, 2, '.', '');
													$p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
														if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
														{
														  $grade= $res['grade'];
														  //echo $grade;
														}
													}
							}?>
            
                        
                        
					</td>
				<?php endforeach;?>
				</tr>

			<?php endforeach;?>

			</tbody>
		</table>
        </div>
		<?php
}
?>		
 </div>
 </body>
