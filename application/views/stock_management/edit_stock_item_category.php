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
								Stock Category
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Stock_management/view_stock_item_category/<?php echo $category_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Stock_management/stock_item_category_update/'.$category_id, array('class' => 'form-horizontal'));?>
					 
										<center><div class="widget-box" style="width:420px">
											<div class="widget-header">
												<h4><font color="#FFFFFF">Edit Stock Category</font></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form>
														<!-- <legend>Form</legend> -->
														<fieldset><br>
															<center><label>Category Name</label></center>
                                                          
                                                            
		<center><input type="text" id="category_name"  name="category_name" value="<?php echo urldecode($category_name); ?>" /></center> 
                                                         
															
														</fieldset><br>

														
															<button type="submit" class="btn btn-sm btn-success">
																Update
																<!--<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i> !-->
															</button>
                                                            <div></div>
														<br />
													</form>
												</div>
											</div>
										</div>
                                         <?php echo form_close(); ?>
                                        </div>

                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>




		