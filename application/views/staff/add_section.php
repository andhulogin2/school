<?php include_once APPPATH . 'views/staff_head.php';?>
 

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
							<li class="active">New Class</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
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
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Section
								</small>
							</h1>
						</div><!-- /.page-header -->
                       
                    
                    
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
            
            
            <div class="row">
									<div class="col-sm-12 widget-container-col">
										<div class="widget-box">
											<div class="widget-header widget-header-small">
												<h5 class="widget-title smaller">Classes</h5>

												<!-- #section:custom/widget-box.tabbed -->
												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="myTab">
														<li class="active">
<?php 
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?><li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php/staff/section/<?php echo $row['class_id'];?>">
						
				<?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>														</li>

														
													</ul>
												</div>

												<!-- /section:custom/widget-box.tabbed -->
											</div>

											<div class="widget-body">
												
											</div>
										</div>
									</div></div>

            
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														
														<th bgcolor="#307ecc"><font color="#FFFFFF">Sl.No.</font></th>
														<th bgcolor="#307ecc"><font color="#FFFFFF">Section</font></th>
														
														<th bgcolor="#307ecc"><font color="#FFFFFF"></font></th>
													</tr>
												</thead>

												<tbody>
                                                  <?php $count = 1;
												  $q=$this->db->get_where('section',array('class_id'=>$class_id))->result_array();
												  foreach($q as $data):?>
													<tr>
														

														<td>
															<?php echo $count++;?>
														</td>
														<td><?php echo $data['name'];?></td>
														
														
														
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																

																<?php
                echo anchor('staff/section_edit/' .$class_id.'/'.$data['section_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');
                ?>
																	
																

																
                                                             
																	
																
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
                                                                        <div class="clearfix form-actions">
                    
																	</ul>
                                                                    
																</div>
															</div>
														</td>
													</tr>
                                                
											

           <li class="pull-right">
           <input type="hidden" name="class" value="<?php echo $class_id;?>">
<?php endforeach;?>
</tbody></table>	
<?php
                echo anchor('staff/view_section_add/', 'Add Section');
                ?>									

												
																	
												
												</li>
									
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

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/staff/get_class_section/' + class_id ,
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
