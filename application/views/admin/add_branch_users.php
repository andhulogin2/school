<?php include_once APPPATH . 'views/main_head.php';?>
 


        
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
							<li class="active">New Branch users</li>
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
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Branch users
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                                  
                              <a href="<?php echo base_url();?>index.php/admin/view_branch/"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                       <?php echo form_open('Admin/branch_users_add', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" name="name" required/>
										</div>
									</div>
                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address :</label>

										<div class="col-sm-9">
											<textarea name="address" id="address" class="col-xs-10 col-sm-5"></textarea>
										</div>
									</div>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Designation :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="designation" class="col-xs-10 col-sm-5" id="designation" required="required">
                              <option value="">Select</option>
                              <?php $roles=$this->db->get('tbl_designation')->result_array();
							  foreach ($roles as $designation)
							  {
							  ?><option value="<?php echo $designation['designation_id'];?>"><?php echo $designation['designation'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>

										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-5" id="sex" name="sex" data-placeholder="Select one">
                                               <option value="">Select one</option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                             </select>
											
										</div>
									</div>
                                    
                                    
                                    
                                    
                                    
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone1 :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="phone1" placeholder="Phone1" class="col-xs-10 col-sm-5" name="phone1" required/>
										</div>
									</div>
									
                                    
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email :</label>

										<div class="col-sm-9">
											<input type="text" id="email" placeholder="Email" class="col-xs-10 col-sm-5" name="email" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Username :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
										<input type="text" id="username" placeholder="Username" class="col-xs-10 col-sm-5" name="username" required />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Password :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
										<input type="password" id="password" placeholder="Password" class="col-xs-10 col-sm-5" name="password" required />
										</div>
									</div>
                                    
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Salary: </label>

										<div class="col-sm-9">
											<input type="text" id="salary" name="salary" placeholder="Salary" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    <input type="hidden" id="branch_id" placeholder="Phone1" class="col-xs-10 col-sm-5" name="branch_id"  value="<?php echo $branch_id; ?>"/>
                                    

								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Add' name="save"> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    


</div>
                                
                                
                                
                                <!-- PAGE CONTENT ENDS -->
							<!-- /.col -->
		
			<!-- /.main-content -->
        		
	

			<?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>