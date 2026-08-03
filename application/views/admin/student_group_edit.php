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
									 Edit Group
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Admin/view_student_group/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     <?php 
                                   echo form_open_multipart('Admin/update_student_group', array('class' => 'form-horizontal','id'=>"myform"));?>

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
                                            <input type="text" name="branch_id" class="col-xs-10 col-sm-5" id="branch_id" disabled value="<?php 
   										        		foreach ($branch as $branch1)
													  		{
															if($branch1['branch_id']==$single_student_group->branch_id)
															{
															echo $branch1['branch_name'];
															}
															}
															?>">
                                        </div>
									</div>
                                    <?php
									}
									?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Group for :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select id="group_for" class="col-xs-10 col-sm-5" name="group_for" required >
                                            	<option value="">Group For</option>
                                                <option value="staffs" <?php if($single_student_group->group_for=="staffs"){ echo "Selected"; } ?>>Staffs</option>
                                                <option value="students" <?php if($single_student_group->group_for=="students"){ echo "Selected"; } ?>>Students</option>
                                            </select>
										</div>
                                     </div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Group Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
                                        <input type="hidden" name="students_group_master_id" id="students_group_master_id" value="<?php echo $single_student_group->students_group_master_id; ?>" >
<input type="text" id="group_name" placeholder="Group Name" class="col-xs-10 col-sm-5" name="group_name" value="<?php echo $single_student_group->students_group_master_name; ?>" required />
										</div>
                                     </div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Notes :</label>

										<div class="col-sm-9">
											<textarea id="notes" placeholder="Notes" class="col-xs-10 col-sm-5" name="notes" ><?php echo $single_student_group->notes; ?></textarea>
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