                                      <?php include_once APPPATH . 'views/head.php';?>
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Upload Marks
								
							</h1>
						</div>
<?php echo form_open(base_url() . 'index.php/admin/marks_selector'); ?>
<div class="row">



    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;">Class</label>
            <select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)" >
                <option value="">Select</option>
                <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <option value="<?php echo $row['class_id']; ?>"
                            <?php if ($class_id == $row['class_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div id="subject_holder">
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Section</label>
                <select name="section_id" id="section_id" class="form-control selectboxit" > 
                    <?php
                    $sections = $this->db->get_where('section', array(
                                'class_id' => $class_id
                            ))->result_array();
                    foreach ($sections as $row):
                        ?>
                        <option value="<?php echo $row['section_id']; ?>" 
                                <?php if ($section_id == $row['section_id']) echo 'selected'; ?>>
                                    <?php echo $row['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Unit Test</label>
                <select name="exam_id" class="form-control selectboxit" required>
                    <?php
                    $exams = $this->db->get_where('exam', array('class_id' =>$class_id,'year' => $running_year))->result_array();
                    foreach ($exams as $row):
                        ?>
                        <option value="<?php echo $row['exam_id']; ?>"
                                <?php if ($exam_id == $row['exam_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                            <?php endforeach; ?>
                </select>
            </div>
        </div>


        <div class="col-md-2">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Subject</label>
                <select name="subject_id" id="subject_id" class="form-control selectboxit">
                    <?php
                    $yr=get_running_year();
                    $subjects = $this->db->get_where('subject', array(
                                'class_id' => $class_id, 'year' => $yr
                            ))->result_array();
                    foreach ($subjects as $row):
                        ?>
                        <option value="<?php echo $row['subject_id']; ?>"
                                <?php if ($subject_id == $row['subject_id']) echo 'selected'; ?>>
                                    <?php echo $row['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
       <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Remarks</label>
           
				<input type="text" class="form-control selectboxit" name="remarks" id="remarks" value="<?php $yr=get_running_year(); echo $this->db->get_where('mark' , array(
					'class_id' => $class_id , 'section_id' => $section_id , 'exam_id' => $exam_id , 'subject_id' => $subject_id , 'year' => $yr))->row()->comment
				;?>">
					
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

<div class="row">
                
    
                           <?php echo form_open(base_url() . 'index.php/admin/marks_update1/' . $class_id . '/' . $section_id . '/' . $exam_id . '/' . $subject_id); ?>

            
               <input type="hidden" class="form-control selectboxit" name="comment" id="comment" value="">
                
                <table class="table table-bordered sortable">
                    <thead>
                        
                        <tr>
                           <th style="text-align: center;" class="table-header"> Roll No.&nbsp;&nbsp; <font color="white"> <i class="fa fa-sort" aria-hidden="true" title="Sort Roll Number"></i></font></th>

                            <th style="text-align: center;" class="table-header">Student &nbsp;&nbsp; <font color="white"><i class="fa fa-sort" aria-hidden="true" title="Sort Name"></font></th>
                            <th style="text-align: center;" class="table-header">Marks Obtained</th>
                            <th style="text-align: center;" class="table-header"><input type="text" style="width:60px;height:30px" placeholder="Out Of" id="total_mark_obtt" class="form-control"></th>

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
                        $count = 1;
                       $this->db->select('s.name,m.mark_obtained,m.mark_total,m.mark_id,e.roll');
					   $this->db->from('mark m');
			            $this->db->join('student s','s.student_id=m.student_id','LEFT');
			         $this->db->join('enroll e','e.student_id=m.student_id','LEFT');
						$this->db->where('m.class_id',$class_id);
						 $this->db->where('m.section_id',$section_id);
						   $this->db->where('m.exam_id',$exam_id);
						    $this->db->where('m.subject_id',$subject_id);
							 $this->db->order_by('e.roll', 'asc');
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
                                    <input type="text" class="form-control" name="marks_obtained_<?php echo $row['mark_id']; ?>" tabindex="<?php echo $count; ?>"
                                           style="width:60px;height:30px" value="<?php echo $row['mark_obtained']; ?>" onchange="return get_grade(this.value)">	
                                          
                                </td>
                                <td>
                                    <input type="text" class="form-control total_markk" name="mark_total_<?php echo $row['mark_id']; ?>"
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
 </div></div></div>
 <?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/marks_get_subject/' + class_id,
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
            url: '<?php echo base_url();?>index.php/admin/get_grade/' + g ,
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>