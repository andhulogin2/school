<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
<?php $running_year = get_running_year(); ?>
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
		

         

<?php if ($class_id != '' && $section_id != '' && $exam_id != ''):?>
<br>

<div class="row">

	<div class="col-md-4"></div>
    
	<div class="col-md-4" style="text-align: center;">
		<div class="tile-stats tile-gray">
        
		<div class="icon"><i class="entypo-docs"></i></div>
       
			<h3 style="color: #696969;">
				<?php
					$exam_name  = $this->db->get_where('tbl_entrance_test' , array('entrance_test_id' => $exam_id))->row()->exam_name; 
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

         <div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
				<td style="text-align: center;" class="table-header">
					Students <i class="fa fa-arrow-circle-down"></i> | Subjects <i class="fa fa-arrow-circle-right"></i>
				</td>
               
					<td  class="table-header">
                    
					<?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->name; ?> 
					
            <label>Remark : 
				
               <?php 
				$this->db->select('distinct(remarks)');
				$this->db->from('tbl_entrance_test_mark');
				$this->db->where('class_id',$class_id);
				$this->db->where('section_id',$section_id);
				$this->db->where('entrance_test_id',$exam_id);
				$this->db->where('subject_id',$subject_id);
				$a=$this->db->get()->row();
				
				echo $a->remarks;
				
				?></label> 
				<!--	<button id="demo2" class="btn btn-yellow" type="submit" style="background-color:#FFFFFF; height:40px"  onclick="send_message1('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','<?php echo $subject_id;?>',)"> 
						
                        <font color="#000000">Send SMS</font>
					</button>&nbsp;&nbsp;&nbsp; -->
               
                 
					</td>
                     
			
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
			  $students = $this->db->get('enroll e')->result_array();
				
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align: left;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0; ?>
					<td style="text-align: center;">
				<?php $marks = 	$this->db->get_where('tbl_entrance_test_mark' , array('class_id' => $class_id ,'entrance_test_id' => $exam_id , 
				'subject_id' => $subject_id , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0) 
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
            <div class="col-xs-8">
				<label class="switch switch-success"><input type="checkbox"  name="send_grade" id="send_grade" ><span></span> Send-Grade </label> 
				<label class="switch switch-success"><input type="checkbox"  name="send_position" id="send_position" ><span></span> Send-Position </label> 
                <label class="switch switch-success"><input type="checkbox"  name="remarks_check" id="remarks_check" value="0"><span></span> Send-Remark </label>
                </div>
			</div>
		</div>
       
			<button id="demo2" class="btn btn-yellow" type="submit" style="background-color:#FFFFFF; height:40px"  onclick="send_message1('<?php echo $class_id;?>','<?php echo $section_id;?>','<?php echo $exam_id;?>','<?php echo $subject_id;?>',)"> 
						
                        <font color="#000000">Send SMS</font>
					</button>
                    <br />
                    <br />
                    
                     <?php echo form_open(base_url() . 'index.php/admin/entrancetest_print_report/'.$class_id.'/'.$section_id.'/'.$exam_id);?>
                           
                          
        <button type="submit" class="btn btn-info"><?php echo 'Download'; ?></button> <?php echo form_close();?>
			<?php echo form_close();?>
                    
                    
		</center></div>
		</div>
	</div>
    </div>
   
<?php endif;?>


</div></div></div></div></div></div>


<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
  
<script type="text/javascript">




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
    //$(".preloader").show();
	
	$.ajax({
	    url: '<?php echo base_url();?>index.php/admin/subject_message/' + class_id + '/' + section_id + '/' + exam_id + '/' +  grade + '/' + position +'/' +rmark , 
            success: function(response)
            {
			
       
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
	$.ajax({
	
	
	    url: '<?php echo base_url();?>index.php/admin/entrance_test_message/' + class_id + '/' + section_id + '/' + exam_id + '/' + subject_id + '/' +
		  grade + '/' + position+ '/' + rmark ,
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


            