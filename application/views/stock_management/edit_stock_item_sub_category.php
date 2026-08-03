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
							<li class="active">Edit Stock Category</li>
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
								Stock  Sub Category
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Stock_management/view_stock_item_sub_category/<?php echo $sub_category_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Stock_management/stock_item_sub_category_update/'.$sub_category_id, array('class' => 'form-horizontal'));?>
					 
									
                                 <?php
								   foreach($log as $subcat)
											{
											?>
													<form>
														<!-- <legend>Form</legend> -->
														  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Category Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		                        <select name="category_id" class="select2" id="category_id" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($category as $cat)
													  		{
							  						?>
                              					<option value="<?php echo $cat['category_id'];?>"<?php if($cat['category_id'] == $subcat['category_id']) { ?> selected <?php } ?>><?php echo $cat['category_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
										</div>
									   </div>
                                  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sub Category Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		<input type="text" id="sub_category_name" value="<?php echo $subcat['sub_category_name']; ?>"   class="col-xs-10   col-sm-5" name="sub_category_name" required />
										</div>
									   </div>
				
									<div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                        
									</div>
                                            <?php 
															}
													?>            
                                                        
                                                        
													
                                                            <div></div>
														<br />
												</form>
												
										</div>
                                         <?php echo form_close(); ?>
                                        </div>
</div>
</div>
                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>

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