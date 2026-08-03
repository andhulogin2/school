<?php 
$role=$this->session->userdata('role');
  include_once APPPATH . 'views/main_head.php';  
?>
 <?php $running_year = get_running_year();?>
 
 
 			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Issue TC</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form>
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>
                <div class="page-header">
                    <h1>Issue Transfer Cetificate</h1>
                      </div>


                <div style="float:right;margin-right:200px;"> 
                    <a href="<?php echo base_url();?>index.php/admin/student_portal/<?php echo $student_id;?>/<?php echo $class_id;?>" data-dismiss="fileinput"><button class="btn-info">Back</button></a> 
                </div>

<div style="margin-left:20px" class="row col-md-10" >
<div class="table-responsive" >
    <?php echo form_open(base_url() . 'index.php/admin/insert_tc_data/'); ?>
        <table>
        <?php 
		foreach($student as $student_view)
		{
		 ?>
             
                <?php $student_id = $student_view['student_id']; ?>

      	<div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Book NO'); ?></span></label>
            <div class="col-md-8">
                <input type="text" name="book_num" value=""   class="form-control" placeholder="<?php echo get_phrase('Book No'); ?>"  ><br />
            </div>
         </div>
         
        <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('TC Number'); ?></span><font color="#FF0000">*</font></label>
            <div class="col-md-8">
                <input type="text" name="tc_num" value="" class="form-control" placeholder="<?php echo get_phrase('TC No'); ?>" required><br />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Student Name'); ?></span><font color="#FF0000">*</font></label>
            <div class="col-md-8">
                <input type="hidden" name="student_id" value="<?php echo $student_view['student_id']; ?> " required>
                <input type="text" name="name" value="<?php echo $student_view['name']; ?> " class="form-control" placeholder="<?php echo get_phrase('Name'); ?>"><br />
            </div>
        </div>
        
    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Sex'); ?></span></label>
        <div class="col-md-8"><div>
                <select name="sex" class="select2" id="scheduled_caste">	
                <option value="">Select</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
                </select>
                </div><br />
        </div>
    </div>
        
                
         <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Nationality'); ?></span><font color="#FF0000">*</font></label>
        <div class="col-md-8"><div>
            <select class="select2" name="nationality"  >
                  <option value="">select</option>
                  <?php 
                  $nationality = $this->db->get('tbl_nationality')->result_array();
                  foreach($nationality as $row){ 
                  ?>
                <option value="<?php echo $row['nationality_id'];?>"><?php echo $row['nationality'];?></option>
                <?php
                }
                ?>
		  </select>
          </div><br />
        </div>
     </div>
               
         <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Religion'); ?></span></label>
        <div class="col-md-8"><div>
            <select name="religion" class="select2"  onChange="get_caste(this.value);">
                  <option value="">select</option>
                  <?php 
                  $religion = $this->db->get('tbl_religion')->result_array();
                  foreach($religion as $row){ 
                  ?>
                <option value="<?php echo $row['religion_id'];?>">
                <?php echo $row['religion'];?>
                </option>
                <?php
                }
                ?>
		  </select></div><br />
             
        </div>
     </div>
                
    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Caste'); ?></span></label>
        <div class="col-md-8"><div>
                <select name="Caste" class="select2" id="caste">	
                <option value="">Select</option>
                </select></div><br />
        </div>
    </div>

<!--    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('is scheduled caste'); ?></span></label>
        <div class="col-md-8"><div>
                <select name="scheduled_caste" class="select2" id="scheduled_caste">	
                <option value="">Select</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
                </select></div><br />
        </div>
    </div>
-->    
    <?php
        $student_class = $this->db->get_where('enroll', array('student_id' => $student_id))->result();
        if(count($student_class)>1)
        { 
            $this->db->order_by('date_added','desc');
            $this->db->limit('1','1');
            $student_class1 = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;
        }    
        else if(count($student_class) == 1)
        {   //print_r($student_class[0]->class_id);
            $student_class1  =   $student_class[0]->class_id;
        }
        $class_name = $this->db->get_where('class', array('class_id' => $student_class1))->row()->name;
		$branch=$this->db->get_where('class' , array('class_id' =>  $student_class1))->row()->branch_id;
    ?>
    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Last Class Studied'); ?></label>
        <div class="col-md-8">
        <div>
           <select name="class" class="select2" id="fee_master_id" >
            <option value="<?php echo $student_class1; ?>"><?php echo $class_name; ?></option>
			<?php
			$running_year=get_running_year();
			
			$this->db->where('branch_id',$branch);
			$this->db->where('academic_year',$running_year);
            $class = $this->db->get('class')->result_array();
            foreach($class as $r){
            ?>
           <option value="<?php echo $r['class_id'];?>" ><?php echo $r['name'];?></option>
            <?php
            }
            ?>
            </select>
        </div><br />
    </div>
    </div>               

    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Name of Gaurdian/Father'); ?></span><font color="#FF0000">*</font></label>
        <div class="col-md-8">
            <input type="text" name="father_name"  value="" class="form-control" placeholder="<?php echo get_phrase('Name of Father'); ?>"><br />
        </div>
    </div>
                
     <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Name of Mother'); ?></span></label>
        <div class="col-md-8">
            <input type="text" name="mother_name" value="" class="form-control" placeholder="<?php echo get_phrase('Name of Mother'); ?>"><br />
        </div>
    </div>
    
    <?php
        $admission_date = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->date_added;
    ?>
        <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Date of Admission'); ?></span></label>
            <div class="col-md-8">
                <input type="text" name="date_of_admission" value="<?php echo date("d-m-Y",$admission_date);  ?>" id="mydatepicker" class="form-control mydatepicker"  ><br />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Date of Birth'); ?></span><font color="#FF0000">*</font></label>
            <div class="col-md-8">
                <input type="text" name="birthday" id="mydatepickerr" class="form-control mydatepicker" value="<?php echo $student_view['birthday']; ?>"  ><br />
            </div>
        </div>

<!--    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Last Exam Appeared'); ?></span><font color="#FF0000">*</font></label>
        <div class="col-md-8">
            <input type="text" name="last_exam" value="" class="form-control" placeholder="<?php echo get_phrase('last Exam Appeared'); ?>" ><br />
        </div>
    </div>
-->
    <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Last Exam Result'); ?></span></label>
        <div class="col-md-8">
            <input type="text" name="last_exam_result" value="" class="form-control" placeholder="<?php echo get_phrase('Last Exam Result'); ?>"><br />
        </div>
    </div><br />


    <?php
        $subject = $this->db->get_where('subject', array('class_id' => $student_class1))->result_array();
	?>
<!--	<div class="row" style="margin-left:0px;">
    <div class="form-group">
        <label class="col-md-4" ><?php echo get_phrase('Subjects Studied'); ?></span></label>
             <div class="col-md-8"><div>
                <?php foreach($subject as $sub) { ?>
            <input type="checkbox" name="subjects[]" value="<?php echo $sub['subject_id']; ?>" onclick="check_status();"><?php echo $sub['name']; ?>&nbsp;
            <input type="hidden" name="subjects_checked[]" value="N" />
			<?php } ?></div><br />
        </div>
    </div>
    </div>
       <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Qualified for Higher Class'); ?></label>
            <div class="col-md-8"><div>
                <select name="qualify" value="" class="form-control" >
                <option value="Y">Yes</option>
                <option value="N">No</option>
                </select></div><br />
            </div>
        </div>
-->
        <div class="form-group">
            <label class="col-sm-4"><?php echo get_phrase('Total Working Days'); ?></label>
            <div class="col-sm-8">
                <input type="text" name="working_days" value="" class="form-control" placeholder="<?php echo get_phrase('Total Working Days'); ?>"><br />
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-sm-4"><?php echo get_phrase('Total Present'); ?></label>
            <div class="col-sm-8">
                <input type="text" name="total_present" value="" class="form-control" placeholder="<?php echo get_phrase('Total Present'); ?>"><br />
            </div>
        </div>
        
    <!--<div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('General Conduct'); ?><font color="#FF0000">*</font></label>
        <div class="col-md-8">
        <div>
           <select name="conduct" class="select2" id="fee_master_id" >
            <option value="">Select</option>
			<?php
            $class = $this->db->get('tbl_general_conduct')->result_array();
            foreach($class as $r){
            ?>
           <option value="<?php echo $r['conduct_id'];?>"><?php echo $r['conduct'];?></option>
            <?php
            }
            ?>
            </select>
        </div><br />
    </div>
    </div>-->               
        
        <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Date of Apply'); ?></span></label>
            <div class="col-md-8">
                <input type="text" name="applied_date" id="applied" class="form-control mydatepicker" value="" ><br />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4"><?php echo get_phrase('Date of Issue'); ?></span></label>
            <div class="col-md-8">
                <input type="text" name="issued_date" id="issued" class="form-control mydatepicker" value="" ><br />
            </div>
        </div>
                   
     <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Reason for Leaving'); ?></span></label>
        <div class="col-md-8">
        <div>
           <select name="reason" class="select2" id="fee_master_id">
            <option value="">Select</option>
			<?php
            $reason = $this->db->get('tbl_tc_reason_for_leaving')->result_array();
            foreach($reason as $re){
            ?>
           <option value="<?php echo $re['reason_id'];?>"><?php echo $re['reason'];?></option>
            <?php
            }
            ?>
            </select>
        </div><br />
        </div>
    </div>

     <div class="form-group">
        <label class="col-md-4"><?php echo get_phrase('Remarks'); ?></span></label>
        <div class="col-md-8">
            <input type="text" name="remarks" value="" class="form-control" >
        </div>
    </div>

            <div class="col-md-12">
    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Issue TC</button> 
             </div>
             <br><br>

                <?php } ?>
                </table>
                
				<?php echo form_close(); ?>
                </div>
            </div>
        
 <div>
 </div>
 
<div class="row">      
      </div> 
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_caste(religion_id) 
	{
		$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_caste/' + religion_id ,
            success: function(response)
            {
                jQuery('#caste').html(response);
            }
        });
    }
</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
    $(document).ready(function () {
        $('.mydatepickerr').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
    $(document).ready(function () {
        $('.applied').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
    $(document).ready(function () {
        $('.issued').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
	</script>  
    
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
        <script type="text/javascript">
        $('.select2').css('width','600px').select2({allowClear:true})
                        $('#select2-multiple-style .btn').on('click', function(e){
                            var target = $(this).find('input[type=radio]');
                            var which = parseInt(target.val());
                            if(which == 2) $('.select2').addClass('tag-input-style');
                             else $('.select2').removeClass('tag-input-style');
                        });                                    
</script> 

<script>         
function check_status()
{
var check_subjects = document.getElementsByName('subjects[]');
var check_status = document.getElementsByName('subjects_checked[]');
var count_item 	 = check_status.length;
	for (var i = 0;  i < count_item; i++)
	{
		if(check_subjects[i].checked)
		{
			check_status[i].value='Y';
		}
		else
		{
			check_status[i].value='N';
		}
	}
}
</script>
