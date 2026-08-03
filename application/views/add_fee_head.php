<?php include_once APPPATH . 'views/head.php';?>
 

<body>
        
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
							<li class="active">New Fee Item</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Fee HEad
								</small>
							</h1>
                           
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                     <?php echo form_open('FeeManagement/insert_fee_heads/', array('class' => 'form-horizontal'));
					 ?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Head Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name"  class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>
                                    <br><br>
                                    
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Account Head :<font color="#FF0000">* </font></label>
   
										<div class="col-sm-9">
											<select name="account" class="col-xs-10 col-sm-5" >
                                           
										   <?php $account_head=$this->db->get('tbl_account_head')->result_array();
										   foreach($account_head as $data)
										   {
										   ?> 
                              <option value="<?php echo $data['account_head_id']; ?>"><?php echo $data['account_head_name'];?></option>
                              <?php }
                              ?>
                          </select>
										</div>
									</div>
                              

								
    <br><br>                                
                                     
									
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit"  class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>

