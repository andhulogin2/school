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
							<li class="active">New Branch</li>
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
									New Branch
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                                  
                              <a href="<?php echo base_url();?>index.php/admin/view_branch/"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                       <?php echo form_open('Admin/branch_add', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="branch_name" placeholder="Branch Name" class="col-xs-10 col-sm-5" name="branch_name" required/>
										</div>
									</div>
                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch Address :</label>

										<div class="col-sm-9">
											<textarea name="branch_address" id="branch_address" class="col-xs-10 col-sm-5"></textarea>
										</div>
									</div>
                              <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone1 :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="phone1" placeholder="Phone1" class="col-xs-10 col-sm-5" name="phone1" required/>
										</div>
									</div>
									
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone2 :</label>

										<div class="col-sm-9">
											<input type="text" id="phone2" placeholder="Phone2" class="col-xs-10 col-sm-5" name="phone2" />
										</div>
									</div>
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email :</label>

										<div class="col-sm-9">
											<input type="text" id="email" placeholder="Email" class="col-xs-10 col-sm-5" name="email" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">State :</label>

										<div class="col-sm-9">
											<select name="state" class="col-xs-10 col-sm-5" id="state">
                              <option value="">Select</option>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">District :</label>

										<div class="col-sm-9">
											<select name="district" class="col-xs-10 col-sm-5" id="district">
                              <option value="">Select</option>
                              
                          </select>
										</div>
									</div>

								
                                    
                                     
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