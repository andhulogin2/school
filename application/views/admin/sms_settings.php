<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
        	<div class="main-content col-md-10">
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
							<li class="active">SMS Settings</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Admin 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									SMS Settings
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                     
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    <div class="col-md-11"></div>
								
                                    <div class="col-sm-4">
                                    <?php echo form_open('Admin/update_admission_template/', array('class' => 'form-horizontal'));
					 ?>
										<div class="widget-box">
											<div class="widget-header">
												<h4><font color="#FFFFFF">Admission</font></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form>
														<!-- <legend>Form</legend> -->
														<fieldset><br>
															<center><label>Template Content</label></center>
                                                            <?php 
															 $this->db->select('content');
								                        	$this->db->from('sms_template');
															$this->db->where('title','admission');
									 						 $result=$this->db->get()->row()->content;
                                                             if($result==''){?>
															<center><textarea  style="width:200px;" name="admission_msg"></textarea></center> 
                                                          <?php } else 
															 { ?>
															<center><textarea  style="width:200px;" name="admission_msg"><?php echo $result;?></textarea><center>                                                           																									
														   <?php }?>
															
														</fieldset><br>

														<div class="form-actions center">
															<button type="submit" class="btn btn-sm btn-success">
																Update
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
                                         <?php echo form_close(); ?>
                                        </div>
                                     <div class="col-sm-4">
                                      <?php echo form_open('Admin/update_attendance_template/', array('class' => 'form-horizontal'));
					 ?>
										<div class="widget-box">
											<div class="widget-header">
												<h4><font color="#FFFFFF">Attendance</font></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form>
														<!-- <legend>Form</legend> -->
														<fieldset><br>
															<center><label>Template Content</label></center>
 <?php 
															 $this->db->select('content');
								                        	$this->db->from('sms_template');
															$this->db->where('title','attendance');
									 						 $result=$this->db->get()->row()->content;
                                                             if($result==''){?>
                                                            <center><textarea name="attendance" style="width:200px;"></textarea></center>  
                                                            <?php } else 
															 { ?>
																	<center><textarea name="attendance" style="width:200px;"><?php echo $result;?></textarea></center>                                                           																					
														   <?php } ?>
														</fieldset><br>

														<div class="form-actions center">
															<button type="submit" class="btn btn-sm btn-success">
																Update
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
														</div>
													</form>
												</div>
											</div>
										</div>
                                         <?php echo form_close(); ?>
									 </div>
                                     <div class="col-sm-4">
                                      <?php echo form_open('Admin/update_birthday_template/', array('class' => 'form-horizontal'));
					 ?>
										<div class="widget-box" class="table-header">
											<div class="widget-header">
												<h4><font color="#FFFFFF">Birthday</font></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form>
														<!-- <legend>Form</legend> -->
														<fieldset><br>
															<center><label>Template Content</label></center>
 															<?php 
															 $this->db->select('content');
								                        	$this->db->from('sms_template');
															$this->db->where('title','birthday');
									 						 $result=$this->db->get()->row()->content;
                                                             if($result==''){?>
															<center><textarea name="birthday" style="width:200px;"></textarea></center>                                                            
                                                             <?php } else 
															 { ?>
                                                             <center><textarea name="birthday" style="width:200px;"><?php echo $result;?></textarea></center>
                                                           <?php }
														   ?>
														</fieldset><br>

														<div class="form-actions center">
															<button type="submit" class="btn btn-sm btn-success">
																Update
																<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
															</button>
														</div>
													</form>
												
                                   
                                    </div></div></div>
                                     <?php echo form_close(); ?>
                                    
                                    </div></div></div></div>
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>