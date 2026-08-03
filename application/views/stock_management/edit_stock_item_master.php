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
								Stock  Master
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Stock_management/view_stock_item_master/<?php echo $item_master_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Stock_management/stock_item_master_update/'.$item_master_id, array('class' => 'form-horizontal'));?>
					 
									
                                 <?php
								   foreach($log as $master)
											{
											?>
													<form>
														<!-- <legend>Form</legend> -->
														  <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		                        <select name="branch_id" class="select2" id="branch_id" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($branch as $branh)
													  		{
							  						?>
                              					<option value="<?php echo $branh['branch_id'];?>"<?php if($branh['branch_id'] == $master['branch_id']) { ?> selected <?php } ?>><?php echo $branh['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
										</div>
									   </div>
                                       
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Category Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		                        <select name="category_id" class="select2" id="category_id" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($category as $cat)
													  		{
							  						?>
                              					<option value="<?php echo $cat['category_id'];?>"<?php if($cat['category_id'] == $master['category_id']) { ?> selected <?php } ?>><?php echo $cat['category_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
										</div>
									   </div>
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sub Category Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		                        <select name="sub_category_id" class="select2" id="sub_category_id" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($sub_category as $scat)
													  		{
							  						?>
                              					<option value="<?php echo $scat['sub_category_id'];?>"<?php if($scat['sub_category_id'] == $master['sub_category_id']) { ?> selected <?php } ?>><?php echo $scat['sub_category_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
										</div>
									   </div>
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Brand Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		                        <select name="brand_id" class="select2" id="brand_id" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($brand as $brad)
													  		{
							  						?>
                              					<option value="<?php echo $brad['brand_id'];?>"<?php if($brad['brand_id'] == $master['brand_id']) { ?> selected <?php } ?>><?php echo $brad['brand_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
										</div>
									   </div>
                               
                                       
                               <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Item Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		<input type="text" id="item_name" value="<?php echo $master['item_name']; ?>"   class="col-xs-10   col-sm-5" name="item_name" required />
										</div>
									   </div>
                                       
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Unit Of Measurement :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		                        <select name="unit_of_measurement_id" class="select2" id="unit_of_measurement_id" >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($unit as $umes)
													  		{
							  						?>
                              					<option value="<?php echo $umes['unit_of_measurement_id'];?>"<?php if($umes['unit_of_measurement_id'] == $master['unit_of_measurement_id']) { ?> selected <?php } ?>><?php echo $umes['unit_long_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
										</div>
									   </div>
                                       
                                       <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Current Stock :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		<input type="text" id="current_stock" value="<?php echo $master['current_stock']; ?>"   class="col-xs-10   col-sm-5" name="current_stock" required />
										</div>
									   </div>
                                       
                                       <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sales Price :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
		<input type="text" id="sales_price" value="<?php echo $master['sales_price']; ?>"   class="col-xs-10   col-sm-5" name="sales_price" required />
										</div>
									   </div>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Academic Year: </label>
										<div class="col-sm-9">
                                            <select name="academic_year" id="academic_year" class="select2">
                                            	<option value="">Select Year</option>
                                                <?php 
   										        		foreach ($year as $yea)
													  		{
							  						?>
                              					<option value="<?php echo $yea['description'];?>"<?php if($yea['description'] == $master['academic_year']) { ?> selected <?php } ?>><?php echo $yea['description'];?></option>
                              						<?php 
															}
													?>
                                              
                                            </select>
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
