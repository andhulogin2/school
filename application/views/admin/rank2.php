<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year(); ?>

 

<body>
        
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Rank</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Rank
								
							</h1>
						</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php echo form_open(base_url() . 'index.php/admin/rank');?>
        <?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2){ ?>
        <div class="col-md-2">
        <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Branch</label>
			<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
		</div>
	</div>
    
    <div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Department</label>
			<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
		</div>
	</div>

			<div class="col-md-2">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="select2" onChange="return get_class_subject(this.value)" id="class_id">
                        <option value="">Select</option>
                       
                    </select>
				</div>
			</div>
            <?php } ?>
            <?php if($this->session->userdata('role')==3)
{?>
<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Department</label>
			<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
            <option value="">Select</option>
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
	</div>
<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="select2" onChange="return get_class_subject(this.value)" id="class_id">
				<option value="">Select</option>
				
			</select>
		</div>
	</div>

<?php }?>

<?php if($this->session->userdata('role')==4 || $this->session->userdata('role')==12)
{?>
<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="select2" onChange="return get_class_subject(this.value)" id="class_id">
				<option value="">Select</option>
                <?php 
                                                                        $yr=get_running_year();
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
                                                                         $this->db->where('academic_year',$yr);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
		</div>
	</div>
    <?php }?>
             <div id="subject_holder">
        <div class="form-group">
		<div class="col-md-2">
				<label class="control-label" style="margin-bottom: 5px;">Section</label>
				<select name="" id="" class="select2" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>
				<select name="" id="" class="select2" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
    </div>
    </div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-2" style="margin-top: 28px;">
				<button type="submit" class="btn btn-info">Show</button>
			</div>
		<?php echo form_close();?>
	</div>


<?php if ($class_id != '' && $section_id != '' && $exam_id != ''):?>

<br>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="text-align: center;">
		<div class="tile-stats tile-gray">
		<div class="icon"><i class="entypo-docs"></i></div>
			<h3 style="color: #696969;">
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; 
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; 
					$section_name = $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;
					
				?>
			</h3>
			<h4 style="color: #696969;">Report<br>
				 Class <?php echo $class_name;?><?php echo $section_name;?> : <?php echo $exam_name;?>
			</h4>
            
            
              <a href="<?php echo base_url();?>index.php/admin/rank_print/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>" class="btn btn-info" target="_blank">
				<font color="#FFFFFF">Print</font></a>

		</div>
	</div>
	<div class="col-md-4"></div>
</div>
<br>
<?php
if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
{
?>


<div class="row">
	<div class="col-md-12">
	<div class="white-box">
    
       
		<table class="table table-bordered datatable">
			<thead>
				<tr>
                <td style="text-align: center;" class="table-header"><input type="checkbox" id="toggle_check" checked="checked" /></td>
                <th style="text-align: center;" class="table-header">
					Sl.No. 
				</th>
				<th style="text-align: center;" class="table-header">
					Students
				</th>
              
                
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
					 ?>
					<th style="text-align: center;" class="table-header">
					<?php echo $row['name'];?> 
					
					<?php /* ?><a href="<?php echo base_url();?>index.php/admin/subject_message_individual/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>/<?php echo $row['subject_id'];?>" class="btn btn-info" >
				<?php echo get_phrase('Send SMS');?>
			</a><?php */ ?>
			<button id="demo2" class="btn btn-yellow" type="submit" style="background-color:#FFFFFF; height:40px"  onclick="send_message1('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','<?php echo $row['subject_id'];?>',)"> 
						
                        <font color="#000000">Send SMS</font>
					</button>
          
            
					
					</th>
                    
                     
				<?php endforeach;?>
                <th style="text-align: center;" class="table-header">
					Total
				</th>
                <th style="text-align: center;" class="table-header">
					Rank 
				</th>
				<?php /*?><td style="text-align: center;"><?php echo get_phrase('Average');?></td><?php */?>
				</tr>
			</thead>
			<tbody>
			<?php
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			    $this->db->select('r.rank_id,r.class_id,r.total_marks,r.section_id,r.exam_id,e.enroll_id,e.enroll_code,e.student_id as student_id,e.roll,e.date_added,e.year');
				$this->db->from('ranks r');
		        $this->db->join('enroll e', 'r.student_id=e.student_id', 'LEFT');
				 $this->db->join('student s', 's.student_id=e.student_id', 'LEFT');
				$this->db->order_by('r.total_marks','desc');
				$this->db->where('r.class_id',$class_id);
				$this->db->where('e.year',$running_year);
				$this->db->where('r.section_id',$section_id);
				$this->db->where('r.exam_id',$exam_id);
				$this->crud_model->check_student_status();
				$query = $this->db->get();
				$students = $query->result_array();
			
			
			
			
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$counter = 1;$rank =1;
				$previous=0;
				$current=0;
				//$students = $this->db->get_where('enroll' , array('class_id' => $class_id ,'section_id' => $section_id , 'year' => $running_year))->result_array();
				foreach($students as $row){
			?>
				<tr>
                	<td style="text-align: center;"><input type="checkbox" name="stud_id_check[]" value="<?php echo $row['student_id']; ?>" class="stud_id_checkbox" checked="checked" /></td>
                                 <td style="text-align: center;"><?php echo $counter++; ?></td>

					<td style="text-align: center;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
                        <input type="hidden" name="student[]" id="student[]" value="<?php echo $row['student_id'];?>" />
					</td>
				<?php
				   $sum=0;
					$total_marks = 0;  foreach($subjects as $row2){?>
					<td style="text-align: center;">
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0) 
							{
								$obtained_marks = $marks->row()->mark_obtained;
								
								$total_marks += $obtained_marks;
								
								$mark_total = $marks->row()->mark_total;
								//echo $obtained_marks;
								$total_marks += $mark_total;
								echo $obtained_marks .'/'.$mark_total;
							}
						?>
                        
            
                        
                        
					</td>
                   
				<?php }?>
                
				
				<td style="text-align: center;"><?php 
				
				
				 $sum=$sum+$total_marks;
				 $a=$sum-$row['total_marks'];
				 echo $row['total_marks'].'/'.$a;
				$current=$sum;
				
				?>
                 <input type="hidden" name="sum[]" id="sum[]" value="<?php echo $sum;?>"/>
                </td>
                <td style="text-align: center;"><?php 
				if($total_marks =='0'){
				  echo "-";
				}else{
				if($current<$previous)
				{
				$rank=$rank+1;
				}
				//echo "current".$current;
				//echo '<br>';
				//echo "prev".$previous;
				//echo '<br>';
				
				 echo $rank; 
				}
				
				?>
                <input type="hidden" name="rank[]" id="rank[]" value="<?php echo $rank;?>"/>
                
                </td>
				</tr>
                

			<?php $previous=$current; }?>

			</tbody>
		</table>
		<center>
			<a href="<?php echo base_url();?>index.php?admin/tab_sheet_print/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Print');?>
			</a>
			<button class="btn" type="button" style="background-color:#009933"  onclick="send_message('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','')"> 
				<font color="#FFFFFF"><?php echo get_phrase('Send All');?></font>
			</button>
		</center>
		</div>
	</div>
</div>
<?php
}
//If internal marks are there.....
else
{
?>



<div class="row">
	<div class="col-md-12">
	<div class="white-box">
    
       
		<table class="table table-bordered datatable">
			<thead>
				<tr>
                <th style="text-align: center;" class="table-header">
					Sl.No. 
				</th>
				<th style="text-align: center;" class="table-header">
					Students
				</th>
              
                
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
					 ?>
					<th style="text-align: center;" class="table-header" colspan="3">
					<?php echo $row['name'];?> 
					
					<?php /*?><a href="<?php echo base_url();?>index.php?admin/subject_message_individual/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>/<?php echo $row['subject_id'];?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Send SMS');?>
			</a><?php */?>
            
					
					</th>
                    
                     
				<?php endforeach;?>
                <th style="text-align: center;" class="table-header">
					Total
				</th>
                <th style="text-align: center;" class="table-header">
					Rank 
				</th>
				<?php /*?><td style="text-align: center;"><?php echo get_phrase('Average');?></td><?php */?>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<?php
					foreach($subjects as $row):
					?>
					<th>Internal</th>	
					<th>Main</th>	
					<th>Total</th>	
					<?php endforeach;?>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
			<?php
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			    $this->db->select('r.rank_id,r.rank,r.class_id,r.total_marks,r.section_id,r.exam_id,e.enroll_id,e.enroll_code,e.student_id as student_id,e.roll,e.date_added,e.year');
				$this->db->from('ranks r');
		        $this->db->join('enroll e', 'r.student_id=e.student_id', 'LEFT');
				 $this->db->join('student s', 's.student_id=e.student_id', 'LEFT');
				$this->db->order_by('r.total_marks','desc');
				$this->db->where('r.class_id',$class_id);
				$this->db->where('e.year',$running_year);
				$this->db->where('r.section_id',$section_id);
				$this->db->where('r.exam_id',$exam_id);
				$this->crud_model->check_student_status();
				$query = $this->db->get();
				$students = $query->result_array();
			
			
			
			
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$counter = 1;$rank =1;
				$previous=0;
				$current=0;
				//$students = $this->db->get_where('enroll' , array('class_id' => $class_id ,'section_id' => $section_id , 'year' => $running_year))->result_array();
				foreach($students as $row){
			?>
				<tr>
                                 <td style="text-align: center;"><?php echo $counter++; ?></td>

					<td style="text-align: center;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
                        <input type="hidden" name="student[]" id="student[]" value="<?php echo $row['student_id'];?>" />
					</td>
				<?php
				   $sum=0;
					$total_marks = 0;  
					$tot_mark_obt	=	0;
					$tot_mark		=	0;
					foreach($subjects as $row2){?>
					
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
				//echo $this->db->last_query();
							if($marks->num_rows() > 0) 
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
								<td style="text-align: center;">
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
								<td style="text-align: center;">
									<?php
										echo $obtained_marks .'/'.$mark_total;
									?>	
								</td>
								<td style="text-align: center;background-color:#FFFF99">
									<?php
										echo $one_sub_tot_obt .'/'.$one_sub_tot;
									?>
								</td>
							<?php	
							}
							else
							{
							?>
								<td></td>
								<td></td>
								<td></td>
							<?php
							}
						?>
                        
            
                        
                        
					
                   
				<?php }?>
                
				
				<td style="text-align: center;"><?php 
				
				
				 $sum=$sum+$total_marks;
				 $a=$sum-$row['total_marks'];
				 //echo $row['total_marks'].'/'.$a;
				 echo $tot_mark_obt.'/'.$tot_mark;
				$current=$sum;
				
				?>
                 <input type="hidden" name="sum[]" id="sum[]" value="<?php echo $sum;?>"/>
                </td>
                <td style="text-align: center;"><?php 
				/*if($total_marks =='0'){
				  echo "-";
				}else{
				if($current<$previous)
				{
				$rank=$rank+1;
				}
				//echo "current".$current;
				//echo '<br>';
				//echo "prev".$previous;
				//echo '<br>';
				
				 echo $rank; 
				}*/
				echo $row['rank'];
				?>
                <input type="hidden" name="rank[]" id="rank[]" value="<?php echo $rank;?>"/>
                
                </td>
				</tr>
                

			<?php $previous=$current; }?>

			</tbody>
		</table>
		<?php /*?><center>
			<a href="<?php echo base_url();?>index.php?admin/tab_sheet_print/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Print');?>
			</a>
			<button class="btn" type="button" style="background-color:#009933"  onclick="send_message('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','')"> 
				<font color="#FFFFFF"><?php echo get_phrase('Send All');?></font>
			</button>
		</center><?php */?>
		</div>
	</div>
</div>




<?php
}
?>
        <?php endif;?>
</div>
</div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
function send_message(class_id,section_id,exam_id, subject_id){
if($('#send_grade').prop('checked') == true) {
       var grade ='1';
    } else {
        var grade ='0';
    }
	if($('#send_position').prop('checked') == true) {
       var position ='1';
    } else {
        var position ='0';
    }
	if($('#remarks_check').prop('checked') == true) {
       var rmark ='1';
    } else {
        var rmark ='0';
    }
    $(".preloader").show();
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/subject_message/' + class_id + '/' + section_id + '/' + exam_id + '/' + subject_id + '/' +  grade + '/' + position +'/' +rmark , 
            success: function(response)
            {
				alert(response);
            }
  }).complete(function () {
                $(".preloader").hide();
            });
}
</script>
<script type="text/javascript">
function send_message1(class_id,section_id,exam_id, subject_id){
	var rank = document.getElementsByName('rank[]').value;
	var stud_ids	=	$('.stud_id_checkbox:checked').serializeArray();
  alert(rank);
  //alert(position);
    $(".preloader").show();
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/subject_message_individual/' + class_id + '/' + section_id + '/' + exam_id + '/' + subject_id + '/' +  grade + '/' + position+ '/' + rmark ,
		data: {rank: a},
       dataType: "json",
            success: function(response)
            {
				alert(response);
            }
  }).complete(function () {
                $(".preloader").hide();
            });
}
</script>




<script type="text/javascript">
	function get_class_subject(class_id) {	
            $(".preloader").show();
			//alert(class_id);
		$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_report/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			}).complete(function () {
                $(".preloader").hide();
            });
	}
</script>

 <script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>
<script type="text/javascript">
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
            }
        });
    }
	

	
</script>

