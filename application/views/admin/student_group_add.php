<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?><body>
        
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
							<li class="active">Groups</li>
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
								Groups
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add Group
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Admin/view_student_group/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     <?php 
                                   echo form_open_multipart('Admin/insert_student_group', array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    <?php
									$role = $this->session->userdata('role');
									if($role == 1 || $role == 2)
									{
									?>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch: <font color="#FF0000">*</font></label>
										<div class="col-sm-9">
                                            <select name="branch_id" class="select2" id="branch_id" onChange="get_dept(this.value)" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($branch as $branch1)
													  		{
							  						?>
                              					<option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
                                        </div>
									</div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Department <font color="#FF0000">* </font></label>
                                        <div class="col-sm-9">
                                            <select name="department_id" class="select2" id="department_id">
                                                <option value="">Select</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <?php
									}
									if($role == 3)
									{
									$branch_id = $this->session->userdata('branch_id');
									?>

                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Department: <font color="#FF0000">*</font></label>
										<div class="col-sm-9">
                                            <select name="department_id" class="select2" id="department_id"  >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($dept as $dept1)
														{
														?>
                                                        <option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
														<?php 
                                                        }
                                                        ?>
                              
                          					</select>
                                        </div>
									</div>

                                    <input type="hidden" id="branch_id" name="branch_id" value="<?php echo $branch_id; ?>" />
                                    <?php
									}
									if($role>3)
									{
										$branch_id				=	$this->session->userdata('branch_id');
										$department_id			=	$this->session->userdata('dept_id');
									?>
                                    <input type="hidden" id="branch_id" name="branch_id" value="<?php echo $branch_id; ?>" />
                                    <input type="hidden" id="department_id" name="department_id" value="<?php echo $department_id; ?>" />
									<?php
									}
									?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Group for :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select id="group_for" class="select2" name="group_for" required >
                                            	<option value="">Group For</option>
                                                <option value="staffs">Staffs</option>
                                                <option value="students">Students</option>
                                            </select>
										</div>
                                     </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Group Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="group_name" placeholder="Group Name" class="col-xs-10 col-sm-5" name="group_name" required />
										</div>
                                     </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Notes :</label>

										<div class="col-sm-9">
											<textarea id="notes" placeholder="Notes" class="col-xs-10 col-sm-5" name="notes" ></textarea>
										</div>
                                     </div>
                                    
                                     
                                    
                                    
                                     
                                    <div class="clearfix form-actions">
                                        <div class="col-md-offset-3 col-md-9">
                                            <input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-info" type="button" value='Submit' >  
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php echo form_close(); ?>
                        </div>
                    </body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
			

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

	function get_dept(branch_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department_id').html(response);
            }
        });
    }

</script>            

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              
