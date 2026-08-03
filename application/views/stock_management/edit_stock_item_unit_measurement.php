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
							<li class="active">Edit Stock unit Measurement</li>
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
								Edit 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
								Stock Unit Measurement
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Stock_management/view_stock_item_unit_measurement/<?php echo $unit_of_measurement_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Stock_management/stock_item_unit_measurement_update/'.$unit_of_measurement_id, array('class' => 'form-horizontal'));?>
                     
                                 <?php
								   foreach($log as $subcat)
											{
											?>
                     
                     
					 
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Unit Short Name:<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
					<input type="text" id="unit_short_name" value="<?php echo $subcat['unit_short_name']; ?>"   class="col-xs-10   col-sm-5" name="unit_short_name" required />
										</div>
									   </div>
                                 
                      <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Unit Long Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
							<input type="text" id="unit_long_name" value="<?php echo $subcat['unit_long_name']; ?>"   class="col-xs-10   col-sm-5" name="unit_long_name" required />
										</div>
									   </div>
                                 
                     <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
										</div>
                                        
									</div>
                     
                     
                                        
                                          <?php 
												}
											?>            
                                                        
                                        
                                        
                                        
                                        
                                         <?php echo form_close(); ?>
                                        </div>

                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>




		