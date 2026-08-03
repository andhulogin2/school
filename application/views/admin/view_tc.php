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
                    <h1>Transfer Cetificate</h1>
              		  <div style="text-align:right;margin-right:24px"><a href="<?php echo base_url(); ?>index.php/Admin/view_tc_issued"><b>Back</b></a></div>
                      </div>

<div style="margin-left:6px" class="row col-md-9" >
<div class="table-responsive" >
        <table>
        <?php 
		foreach($tc_issued as $tc)
		{
		 ?>
             
                <?php $student_id = $tc['student_id']; ?>

      	<div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('Book NO'); ?></span></div>
            <div class="col-md-8">
                <input type="text" name="book_num" value="<?php echo $tc['book_number']; ?>"   class="form-control" placeholder="<?php echo get_phrase('Book No'); ?>" readonly ><br />
            </div>
         </div>

         
        <div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('TC Number'); ?></span><font color="#FF0000">*</font></div>
            <div class="col-md-8">
                <input type="text" name="tc_num" value="<?php echo $tc['tc_number']; ?>" class="form-control" readonly><br />
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('Student Name'); ?></span><font color="#FF0000">*</font></div>
            <div class="col-md-8">
    <?php
        $name = $this->db->get_where('student', array('student_id' => $student_id))->row()->name;
        $nationality = $this->db->get_where('tbl_nationality', array('nationality_id' => $tc['nationality']))->row()->nationality;
        $religion = $this->db->get_where('tbl_religion', array('religion_id' => $tc['religion']))->row()->religion;
        $caste = $this->db->get_where('tbl_caste', array('caste_id' => $tc['caste']))->row()->caste;
        $conduct = $this->db->get_where('tbl_general_conduct', array('conduct_id' => $tc['general_conduct']))->row()->conduct;
    ?>
                <input type="text" name="name" value="<?php echo $name; ?> " class="form-control" readonly="readonly"><br />
            </div>
        </div>
        
    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Sex'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="sex" value="<?php if($tc['sex']=='M') { echo "Male"; } else{ echo "Female"; } ?> " class="form-control" readonly="readonly" ><br>
        </div>
    </div>
        
        <div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('Date of Birth'); ?></span><font color="#FF0000">*</font></div>
            <div class="col-md-8">
                <input type="text" name="birthday" id="mydatepickerr" class="form-control mydatepicker" value="<?php echo date("d-m-Y", strtotime($tc['date_of_birth'])); ?>" readonly="readonly" ><br />
            </div>
        </div>

         <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Nationality'); ?></span><font color="#FF0000">*</font></div>
        <div class="col-md-8">
            <input type="text" name="nationality" value="<?php echo $nationality; ?> " class="form-control" readonly="readonly" ><br />
        </div>
     </div>
               
         <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Religion'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="religion" value="<?php echo $religion; ?> " class="form-control" readonly="readonly" ><br />
        </div>
     </div>
                
    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Caste'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="caste" value="<?php echo $caste; ?> " class="form-control" readonly="readonly" ><br />
        </div>
    </div>

<!--    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('is scheduled caste'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="scheduled_caste" value="<?php if($tc['is_scheduled_caste']=='N') { echo "No"; } else{ echo "Yes"; } ?> " class="form-control" readonly="readonly" ><br />
        </div>
    </div>
-->
    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Name of Gaurdian/Father'); ?></span><font color="#FF0000">*</font></div>
        <div class="col-md-8">
            <input type="text" name="father_name" readonly="readonly" value="<?php echo $tc['name_of_father']; ?>" class="form-control" ><br />
        </div>
    </div>
                
     <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Name of Mother'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="mother_name" value="<?php echo $tc['name_of_mother']; ?>" class="form-control" readonly="readonly" ><br />
        </div>
    </div>
    
    <?php
        $class_name = $this->db->get_where('class', array('class_id' => $tc['last_class_studied']))->row()->name;
    ?>
           
    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Last Class Studied'); ?></div>
        <div class="col-md-8">
        <div>
            <input type="text" name="class" value="<?php echo $class_name; ?> " class="form-control" readonly="readonly" ><br />
        </div>
    </div>
    </div>               

        <div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('Date of Admission'); ?></span><font color="#FF0000">*</font></div>
            <div class="col-md-8">
                <input type="text" name="date_of_admission" value="<?php echo date("d-m-Y", strtotime($tc['date_of_admission'])); ?>" id="mydatepicker" class="form-control mydatepicker" readonly="readonly" ><br />
            </div>
        </div>

<!--    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('last Exam Appeared'); ?></span><font color="#FF0000">*</font></div>
        <div class="col-md-8">
            <input type="text" name="last_exam" value="<?php echo $tc['last_exam_appeared']; ?>" class="form-control" readonly="readonly" ><br />
        </div>
    </div>
-->
    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Last Exam Result'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="last_exam_result" value="<?php echo $tc['last_exam_result']; ?>" class="form-control" readonly="readonly" ><br />
        </div>
    </div>
    
<!--       <div class="form-group">
            <div class="col-sm-4"><?php echo get_phrase('Subjects Studied'); ?></div>
            <div class="col-sm-8"><div>
            <?php foreach($tc_subjects as $sub) 
			{
			    $subject = $this->db->get_where('subject', array('subject_id' => $sub['subject_id']))->row()->name;
                echo $subject." , ";
			} ?></div><br />
            </div>
        </div>
    
       <div class="form-group">
            <div class="col-sm-4"><?php echo get_phrase('Qualified for Higher Class'); ?></div>
            <div class="col-sm-8">
            <?php
			if($tc['qualified_for_higher_class']=="Y")
			{ ?>
                <input type="text" name="qualify" value="Yes" class="form-control" readonly="readonly" ><br />
             <?php
			 } else {
			 ?>
                <input type="text" name="qualify" value="No" class="form-control" readonly="readonly" ><br />
			<?PHP } ?>
            </div>
        </div>
-->
        <div class="form-group">
            <div class="col-sm-4"><?php echo get_phrase('Total Working Days'); ?></div>
            <div class="col-sm-8">
                <input type="text" name="working_days" value="<?php echo $tc['total_working_days']; ?>" class="form-control" readonly="readonly" ><br />
            </div>
        </div>
            
        <div class="form-group">
            <div class="col-sm-4"><?php echo get_phrase('Total Present'); ?></div>
            <div class="col-sm-8">
                <input type="text" name="total_present" value="<?php echo $tc['total_present']; ?>" class="form-control" readonly="readonly" ><br />
            </div>
        </div>
        
<!--    <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('General Conduct'); ?><font color="#FF0000">*</font></div>
        <div class="col-md-8">
        <div>
                <input type="text" name="conduct" value="<?php echo $conduct; ?>" class="form-control" readonly="readonly" ><br />
        </div>
    </div>
    </div>               
-->        
        <div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('Date of Apply'); ?></span></div>
            <div class="col-md-8">
                <input type="text" name="applied_date" id="applied" class="form-control mydatepicker" value="<?php echo date("d-m-Y", strtotime($tc['date_applied'])); ?>" readonly="readonly" ><br />
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4"><?php echo get_phrase('Date of Issue'); ?></span></div>
            <div class="col-md-8">
                <input type="text" name="issued_date" id="issued" class="form-control mydatepicker" value="<?php echo date("d-m-Y", strtotime($tc['date_issued'])); ?>" readonly="readonly" ><br />
            </div>
        </div>
                   
     <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Reason for Leaving'); ?></span></div>
        <div class="col-md-8">
        <div>
                 <input type="text" name="reason" id="issued" class="form-control mydatepicker" value="<?php echo $this->db->get_where('tbl_tc_reason_for_leaving', array('reason_id' => $tc['reason_for_leaving']))->row()->reason; ?>" readonly="readonly" ><br />
        </div>
        </div>
    </div>

     <div class="form-group">
        <div class="col-md-4"><?php echo get_phrase('Remarks'); ?></span></div>
        <div class="col-md-8">
            <input type="text" name="remarks" value="<?php echo $tc['remarks']; ?>" class="form-control" readonly="readonly" ><br />
        </div>
    </div>

            <div class="col-md-12">
    <a href="<?php echo base_url(); ?>index.php/Admin/pdf_report_of_tc/<?php echo $tc['tc_id']; ?>" target="_blank" ><button type="submit" class="btn btn-info waves-effect waves-light m-r-10">PDF</button> </a>
             </div>
             <br><br>

                <?php } ?>
                </table>
                
                </div>
            </div>
        
 <div>
 </div>
 
<div class="row">      
      </div> 
<?php include_once APPPATH . 'views/footer.php'; ?>
