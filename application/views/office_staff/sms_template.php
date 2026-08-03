<?php include_once APPPATH . 'views/main_head.php';?>
<?php $running_year = get_running_year(); ?>
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
							<li class="active">SMS Template</li>
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								SMS Templates
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div>
                        <div align="right" style="padding-right:10px"> 
                        <a href="<?php echo base_url();?>index.php/admin/new_sms_template">New Template</a>  </div>
            <div class="table-responsive" style="padding-right:10px">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Template</th>
														<th class="hidden-480 table-header">Message</th>

												
														<th class="hidden-480 table-header">Action</th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php $count = 1;foreach($sms as $row):
											
                                                  if($row['title']!= 'admission' && $row['title']!='attendance' && $row['title']!='birthday'){?>
													<tr>
														

														<td>
															<?php echo $count++;?>
														</td>
														<td>
														   
														<?php
														echo $row['title'];?></td>
														
														<td><?php echo $row['content'];?></td>
														
														<td>
															
																

																<?php
                echo anchor('Admin/template_edit/' .$row['id'], '<i class="fa fa-edit text-info"></i>');
                ?>

																	
																

					<a href="<?php echo base_url();?>index.php/admin/template_delete/<?php echo $row['id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>											
                                                          
																	
																
															</div>

															
														</td>
													</tr>
                                               <?php }?>
												<?php endforeach;?>	
												</tbody>
            </table>
            </div>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>
