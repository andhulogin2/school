<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year(); ?>
<div id="ajax_view" class="col-md-10">
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
							<li class="active">Report</li>
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
								Exam
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Report
								
							</h1>
						</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php echo form_open(base_url() . 'index.php/admin/tab_sheet');?>
        
        
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

<?php if($this->session->userdata('role')>=4)
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
                                      <option value="<?php echo $data['class_id']?>"<?php if($class_id!=''){if($class_id==$data['class_id']){ echo "selected"; }} ?>><?php echo $data['name']?></option>
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
			<div class="col-md-3" style="margin-top: 28px;">
				<button type="submit" class="btn btn-info">Show</button>
			</div>
		<?php echo form_close();?>
	</div>
   
		<?php //echo form_open(base_url() . 'index.php/admin/mark_print_report/'.$class_id.'/'.$section_id.'/'.$exam_id);?>

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
					echo "Report";
				?>
			</h3>
			<h4 style="color: #696969;">
				<?php echo "Class" . ' ' . $class_name;?><?php echo "	Section"	.'	'	.$section_name;?> : <?php echo $exam_name;?>
			</h4>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>


<hr />

<?php
if($this->db->get_where('settings' , array('type' => 'internal_mark'))->row()->description!='yes')
{
?>


         <div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
                <td style="text-align: center;" class="table-header"><input type="checkbox" id="toggle_check" checked="checked" /></td>
				<td style="text-align: center;" class="table-header">
					Students <i class="fa fa-arrow-circle-down"></i> | Subjects <i class="fa fa-arrow-circle-right"></i>
				</td>
                <?php $a=$this->input->post('send_grade');
				echo $a;?>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
				?>
					<td  class="table-header">
                    
					<?php echo $row['name'];?> 
					<?php /*?><a href="<?php echo base_url();?>index.php?admin/subject_message_individual/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>/<?php echo $row['subject_id'];?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Send SMS');?>
			</a><?php */?>
          
            <label>Remark : 
				
               <?php 
				$this->db->select('distinct(comment)');
				$this->db->from('mark');
				$this->db->where('class_id',$class_id);
				$this->db->where('section_id',$section_id);
				$this->db->where('exam_id',$exam_id);
				$this->db->where('subject_id',$row['subject_id']);
				$a=$this->db->get()->row();
				
				echo $a->comment;
				
				?></label> 
					<button id="demo2" class="btn btn-yellow" type="submit" style="background-color:#FFFFFF; height:40px"  onclick="send_message1('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','<?php echo $row['subject_id'];?>',)"> 
						
                        <font color="#000000">Send SMS</font>
					</button>&nbsp;&nbsp;&nbsp;
               
                 
					</td>
                     
				<?php endforeach;?>
               
				<?php /*?><td style="text-align: center;"><?php echo get_phrase('Average');?></td><?php */?>
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
                	<td style="text-align: center;"><input type="checkbox" name="stud_id[]" value="<?php echo $row['student_id']; ?>" class="stud_id_checkbox" checked="checked" /></td>
					<td style="text-align: left;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;
					  foreach($subjects as $row2): ?>
					<td style="text-align: center;">
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0 && $marks->row()->mark_total!=0)  
							{
								$obtained_marks = $marks->row()->mark_obtained;
								
								$total_marks += $obtained_marks;
								
								$mark_total = $marks->row()->mark_total;
								//echo $obtained_marks;
								$total_marks += $mark_total;
								$output =   "";
								if(is_numeric($obtained_marks))
								{
								    $output =   $obtained_marks .'/'.$mark_total;    
								}
								else
								{
								    if($obtained_marks=="")
								    {
								        $output =   '-';
								    }
								    else
								    {
								        $output =   $obtained_marks;
								    }    
								}
								echo $output;
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
				<?php /*?><td style="text-align: center;">
					<?php 
						$this->db->where('class_id' , $class_id);
						$this->db->where('year' , $running_year);
						$this->db->from('subject');
						$total_subjects = $this->db->count_all_results();
						
						echo ($total_marks / $total_subjects); echo "%";
					?>
				</td><?php */?>
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
		<table class="table table-bordered">
			<thead>
				<tr>
                <td style="text-align: center;" class="table-header"><input type="checkbox" id="toggle_check" checked="checked" /></td>
				<td style="text-align: center;" class="table-header">
					Students <i class="fa fa-arrow-circle-down"></i> | Subjects <i class="fa fa-arrow-circle-right"></i>
				</td>
                <?php $a=$this->input->post('send_grade');
				echo $a;?>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
				?>
					<td  class="table-header" colspan="3">
                    
					<?php echo $row['name'];?> 
					<?php /*?><a href="<?php echo base_url();?>index.php?admin/subject_message_individual/<?php echo $class_id;?>/<?php echo $section_id;?>/<?php echo $exam_id;?>/<?php echo $row['subject_id'];?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Send SMS');?>
			</a><?php */?>
          
            <label>Remark : 
				
               <?php 
				$this->db->select('distinct(comment)');
				$this->db->from('mark');
				$this->db->where('class_id',$class_id);
				$this->db->where('section_id',$section_id);
				$this->db->where('exam_id',$exam_id);
				$this->db->where('subject_id',$row['subject_id']);
				$a=$this->db->get()->row();
				
				echo $a->comment;
				
				?></label> 
					<button id="demo2" class="btn btn-yellow" type="submit" style="background-color:#FFFFFF; height:40px"  onclick="send_message1('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','<?php echo $row['subject_id'];?>',)"> 
						
                        <font color="#000000">Send SMS</font>
					</button>&nbsp;&nbsp;&nbsp;
               
                 
					</td>
                     
				<?php endforeach;?>
               
				<?php /*?><td style="text-align: center;"><?php echo get_phrase('Average');?></td><?php */?>
				</tr>
				<tr>
					<th></th>
					<?php
					for($i=0;$i<count($subjects);$i++):
						?>
						<th>Internal</th>
						<th>Main</th>
						<th>Total</th>
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
                	<td style="text-align: center;"><input type="checkbox" name="stud_id[]" value="<?php echo $row['student_id']; ?>" class="stud_id_checkbox" checked="checked" /></td>
					<td style="text-align: left;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;
					$tot_mark_obt	=	0;
					$tot_mark		=	0;
					  foreach($subjects as $row2): ?>
					
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
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
								
								
								//echo $obtained_marks .'/'.$mark_total;
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
							else{
							$mark_total=0;
							}
							
							
						?>
                         <?php if($mark_total==0)
						 {
						 ?>
						 		<td><?php echo "NA"; ?></td>
								<td><?php echo "NA"; ?></td>
								<td><?php echo "NA"; ?></td>
						 
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
				<?php /*?><td style="text-align: center;">
					<?php 
						$this->db->where('class_id' , $class_id);
						$this->db->where('year' , $running_year);
						$this->db->from('subject');
						$total_subjects = $this->db->count_all_results();
						
						echo ($total_marks / $total_subjects); echo "%";
					?>
				</td><?php */?>
				</tr>

			<?php endforeach;?>

			</tbody>
		</table>
        </div>
		<?php
}
?>		
		
		
        <div id="preloader_icon" style="display:none">
        <center><i class="ace-icon fa fa-spinner fa-spin orange bigger-125"> </i><h4><font color="#CC0000">Message Sent....</font></h4>
        </center>
        </div>
		<center>
        <div class="row">
	<div class="col-md-12">
	<div class="white-box">
   
    <div class="row">
			<div class="form-group"> 
            <div class="col-xs-12">
				<label class="switch switch-success"><input type="checkbox"  name="send_grade" id="send_grade" ><span></span> Send-Grade </label> 
				<label class="switch switch-success"><input type="checkbox"  name="send_position" id="send_position" ><span></span> Send-Position </label> 
                <label class="switch switch-success"><input type="checkbox"  name="remarks_check" id="remarks_check" value="0"><span></span> Send-Remark </label>
                <label class="switch switch-success"><input type="checkbox"  name="phone2" id="phone2" value="0"><span></span> Phone2 </label>
                </div>
			</div>
		</div>

			<button class="btn btn-yellow loader" type="button" style="background-color:#009933"  onclick="send_message('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','')"> <font color="black">Send SMS</font>
			</button>
                    <a href="<?php echo base_url();?>index.php/Admin/mark_print_report_pdf/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $exam_id; ?>" title="Download PDF"><button class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> PDF</button></a> &nbsp;
                    <a href="<?php echo base_url();?>index.php/Admin/mark_print_report_excel/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $exam_id; ?>" title="Download Excel"><button class="btn btn-info"><i class="fa fa-download" aria-hidden="true"></i> Excel</button></a>
		</center></div>
		</div>
	</div>
    </div>
   
<?php endif;?>
<div style="margin-bottom:100px;"></div>

<div id="overlay_loader" style="background: #ffffff;color: #666666;position: fixed;height: 100%;width: 100%;z-index: 5000;top: 0; left: 0;float: left;text-align: center;padding-top: 25%;display:none">
    
</div>

</div></div></div></div></div></div>


<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
  
<script type="text/javascript">

$(document).ready(function() {
	<?php
	if($class_id!='')
	{
		?>
		get_class_subject(<?php echo $class_id; ?>);
		<?php
	}
	?>
});

$("#toggle_check").change(function () {
    $("input:checkbox.stud_id_checkbox").prop('checked',this.checked);
});

function send_message(class_id,section_id,exam_id){
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
	if($('#phone2').prop('checked') == true) {
       var phone2 ='1';
    } else {
        var phone2 ='0';
    }
    //$(".preloader").show();
	var stud_ids	=	$('.stud_id_checkbox:checked').serializeArray();
	
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/subject_message/' + class_id + '/' + section_id + '/' + exam_id + '/' +  grade + '/' + position +'/' +rmark +'/' + phone2, 
		type: 'POST',
		data:{stud_ids:stud_ids},
	        beforeSend: function(){
	           $('#overlay_loader').html('<img src="<?php echo base_url(); ?>assets/images/ajax-loader2.gif" alt="Loading"></img>'); 
	           $('#overlay_loader').css('display', 'block');
	        },
            success: function(response)
            {
			    $('#overlay_loader').css('display', 'none');
       
				jQuery('#ajax_view').html(response);
            }
  });
  /*complete(function () {
                $('#preloader_icon').show().delay(2000).fadeOut(300); 
           }, 1000);*/
}
</script>
<script type="text/javascript">
function send_message1(class_id,section_id,exam_id, subject_id){
$(".preloader").show();
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
	if($('#phone2').prop('checked') == true) {
       var phone2 ='1';
    } else {
        var phone2 ='0';
    }
 // alert(grade);
  //alert(position);
$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
 
       // setTimeout($.unblockUI, 2000); 
		//$.blockUI();
	var stud_ids	=	$('.stud_id_checkbox:checked').serializeArray();
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/subject_message_individual/' + class_id + '/' + section_id + '/' + exam_id + '/' + subject_id + '/' +
		  grade + '/' + position+ '/' + rmark + '/' + phone2,
		type: 'POST',
		data:{stud_ids:stud_ids},
		success: function(response)
            {
				$.unblockUI();
				jQuery('#ajax_view').html(response);
            }
			
  /*}).ajaxStop(function()
  {
  */
 // $.unblockUI();
  });
 
 /* complete(function () {

                 $('#preloader_icon').show().delay(2000).fadeOut(300); 
           }, 1000);*/
		   
}
</script>

<script type="text/javascript">
	function get_class_subject(class_id) {	
        $(".preloader").show();
		var section_id	=	'<?php echo $section_id; ?>';	
		var exam_id	=	'<?php echo $exam_id; ?>';	
		$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_report/' + class_id + '/' +section_id + '/' +exam_id,
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


            