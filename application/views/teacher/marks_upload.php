<?php include_once APPPATH . 'views/teacher_head.php';?>
<?php $running_year = get_running_year(); ?>
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
							<li class="active">Upload Marks</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                   <div class="page-header">
							<h1>
								Dashboard
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Upload Marks

								
							</h1>
						</div>
<?php echo form_open(base_url() . 'index.php/teacher/marks_selector'); ?>
<div class="row" style="padding-left:20px; padding-right:20px">



    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;">Class</label>
            <select name="class_id" class="form-control selectboxit" onchange="get_class_subject1(this.value)" >
             <option value="">Select</option>
               <?php
				$teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
                       $this->db->select('c.class_id,c.name as class_name');
					   $this->db->where('c.branch_id',$this->session->userdata('branch_id'));
					    $this->db->where('c.dept_id',$this->session->userdata('dept_id'));
					   $this->db->where('d.teacher_id',$teacher_id);
					   // $this->db->where('s.teacher_id',$teacher_id);
					// $this->db->join('subject s','d.teacher_id=s.teacher_id','LEFT');
					   //$this->db->join('section d','d.class_id=c.class_id','LEFT');
					   $this->db->join('section d','d.class_id=c.class_id','LEFT');
						$class=$this->db->get_where('class c')->result_array();
						foreach ($class as $row1):
				?>
				<option value="<?php echo $row1['class_id'];?>"><?php echo $row1['class_name'];?></option>
				<?php endforeach;?>
            </select>
        </div>
    </div>

    <div id="subject_holder">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Section</label>
                <select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select</option>		
				</select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Unit Test</label>
                <select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select</option>		
				</select>
            </div>
        </div>


        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Subject</label>
               <select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select-Class</option>		
				</select>
            </div>
        </div>
       <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Remarks</label>
           
				<input type="text" class="form-control selectboxit" name="remarks" id="remarks" value="">
					
			</div>
		</div>
        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled">View</button>
			</center>
		</div>

    </div>
</div>

<hr />
<?php echo form_close(); ?>

<div class="row" style="padding-left:20px; padding-right:20px">
                <?php echo form_open(base_url() . 'index.php/teacher/marks_update/' . $class_id . '/' . $section_id . '/' . $exam_id . '/' . $subject_id); ?>

    <div class="col-md-2"></div>
    <div class="col-md-12">
        <div class="white-box">
        
            <div class="table-responsive">
           
            
               
            
               <input type="hidden" class="form-control selectboxit" name="comment" id="comment" value="">
                
                <table class="table table-bordered sortable">
                     <thead>
                        
                        <tr>
                           <th style="text-align: center;" class="table-header">Roll No.<font color="white"> <i class="fa fa-sort" aria-hidden="true" title="Sort Roll Number"></i></font></th>

                            <th style="text-align: center;" class="table-header">Student<font color="white"> <i class="fa fa-sort" aria-hidden="true" title="Sort Roll Number"></i></font></th>
                            <th style="text-align: center;" class="table-header">Marks Obtained</th>
                            <th style="text-align: center;" class="table-header"><input type="text" style="width:120px;height:30px" placeholder="Out Of Mark" id="total_mark_obt" class="form-control"></th>

                            <?php /* ?>	<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la3;?></th>
                              <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la4;?></th>
                              <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la5;?></th>
                              <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la6;?></th>
                              <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la7;?></th>
                              <th><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la8;?></th>
                              <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la9;?></th>
                              <th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->final;?></th><?php */ ?>
                          <th style="text-align: center;" class="table-header">Grade</th>

                            <th style="text-align: center;" class="table-header">Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $running_year=get_running_year();
                        $count = 1;
                       $this->db->select('s.name,m.mark_obtained,m.mark_total,m.mark_id,e.roll');
					   $this->db->from('mark m');
			            $this->db->join('student s','s.student_id=m.student_id','LEFT');
			         $this->db->join('enroll e','e.student_id=m.student_id','LEFT');
					 $this->crud_model->check_student_status();
						$this->db->where('e.year',$running_year);
						$this->db->where('m.class_id',$class_id);
						 $this->db->where('m.section_id',$section_id);
						   $this->db->where('m.exam_id',$exam_id);
						    $this->db->where('m.subject_id',$subject_id);
							 $this->db->order_by('s.name', 'asc');
						$marks_of_students=$this->db->get()->result_array();

                        foreach ($marks_of_students as $row):
                            ?>
                            <tr>
                                  <td>
                                        
                                   <?php echo $row['roll']; ?>
                                </td>
                                <td>
                                        
                                    <?php echo $row['name']; ?>
                                </td>
                                <td> 
                                <?php $g=$row['mark_id'];?>
                                    <input type="text" class="form-control" name="marks_obtained_<?php echo $row['mark_id']; ?>"
                                           style="width:60px;height:30px" value="<?php echo $row['mark_obtained']; ?>" onchange="return get_grade(this.value)">	
                                          
                                </td>
                                <td>
                                    <input type="text" class="form-control total_mark" name="mark_total_<?php echo $row['mark_id']; ?>"
                                           style="width:60px;height:30px" value="<?php echo $row['mark_total']; ?>">	
                                </td>
                                <?php /*?> <?php
                                                    $average = (($row['mark_obtained'] / $row['mark_total']) * 100);
                                                    echo number_format($average, 2, '.', '');
                                                    ?>%
                                          <?php 
										    if($average>30)
											{
											echo "pass";
											}
											else
											{
											 echo "failed";
											 }
											?>   <?php */?>       
                         
                         
                                       
                                                 
                                           
                                           
                                                    
                                                    
                                <td>
                                    <input type="text" class="form-control" name="grade"
                                           style="width:60px;height:30px" value="<?php
                                                    if($row['mark_total']==0)
													{
													  echo "-";
													  }
													  else
													  {
													
													$average = (($row['mark_obtained'] / $row['mark_total']) * 100);
                                                   //echo number_format($average, 2, '.', '');
													$p=$this->db->get('grade')->result_array();
													foreach($p as $res){
													
												  //echo  $res['minimum_range'];
													if($average >=$res['minimum_range'] and $average <=$res['maximum_range'])
													{
													  echo $res['grade'];
													
													
													
                                                    ?>">
                                                    <input type="hidden" name="grade_value_<?php echo $row['mark_id'];?>" value="<?php echo $res['grade'];?>" />	
                                                   <input type="hidden" name="position_value_<?php echo $row['mark_id'];?>" value="<?php echo $res['position'];?>" />	

                                </td>
<td>
                                     <input type="text" class="form-control" style="width:150px;height:30px" name="position_<?php echo $row['mark_id']; ?>"
                                           value="<?php echo $res['position'];
											

											
											 
											 }
											 }
											 }
											?>   
                                         
                         ">

                             </td>
                             
                            </tr>
                        <?php endforeach; ?>
                        
                    </tbody>
                </table>
                <center>
                    <button type="submit" class="btn btn-info" id="submit_button">
                        <i class="fa fa-check"></i> Upload
                    </button>
                </center>
            </div>
            <div class="col-md-2"></div>
     
  
<?php echo form_close(); ?>
</div></div></div></div></div>
 <?php echo form_close(); ?>
 <?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function get_class_subject1(class_id) {
	
	
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/teacher/marks_get_subject_myclass/' + class_id,
            success: function (response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }

</script>
<script type="text/javascript">
    function get_grade(g)
  {
    	$.ajax({
            url: '<?php echo base_url();?>index.php/teacher/get_grade/' + g ,
            success: function(response)
            {
                jQuery('#grade').html(response);
            }
        });
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#total_mark_obt').change(function () {
            var tot_mark = $(this).val();
            var selected_seats = $("body .total_mark");
            $.each(selected_seats, function (key, value) {
                $(this).val(tot_mark);
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#total_mark_obtt').change(function () {
            var tot_mark = $(this).val();
            var selected_seats = $("body .total_markk");
            $.each(selected_seats, function (key, value) {
                $(this).val(tot_mark);
            });
        });
    });
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#remarks").keyup(function () {
var a = $("#remarks").val();
var c= a ;
$("#comment").val(c);
});
});
</script>
<script type="text/javascript">
$(document).ready(function() {
   $('input[type="radio"]').click(function() {
       if($(this).attr('value') == 'alphabet') {
	      
            $('#alphabet_list').show(); 
			$('#roll_list').hide();           
       }

       if($(this).attr('value') == 'roll') {
	  
            $('#alphabet_list').hide(); 
			$('#roll_list').show();   
       }
	  //  if($(this).attr('value') == 'roll_sec') {
//	  //alert("roll_sec_list");
//            $('#alphabet_sec_list').hide(); 
//			$('#roll_sec_list').show();   
//       }
//	    if($(this).attr('value') == 'alphabet_sec') {
//	 // alert("alphabet_sec_list");
//            $('#roll_sec_list').hide(); 
//			$('#alphabet_sec_list').show();   
//       }
	  ///////////////////////////////////////////////////
	  
	   <?php $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
         foreach ($sections as $row){ ?> 
		     if($(this).attr('value') == '<?php echo $row['section_id'];?>') {
            	if (this.checked) {
			
                 $('#<?php echo $row['section_id']."roll_list";?>').show(); 
			     $('#<?php echo $row['name'];?>').hide(); 
			    } 
              }
		   if($(this).attr('value') == '<?php echo $row['name'];?>') {
	           if (this.checked) {
		
			    $('#<?php echo $row['name'];?>').show();  
                $('#<?php echo $row['section_id']."roll_list";?>').hide(); 
             }
			 
	      }
	 <?php  } ?>
	
	  ////////////////////////////////////////////////////
   });
});
</script>
<script src="<?php echo base_url(). 'assets/js/sorttable.js'; ?>"></script>

