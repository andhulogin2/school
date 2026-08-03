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
							<li class="active">View Inactive Students</li>
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
								Inactive Students
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								
							</h1>
						</div> 
				
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/inactive_student_view/'; ?>" >Back</a></div>                          
                         
                           <div>
                           
                                     <div class="table-responsive">
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="table-header"><center>Sl.No.</center></th>
														<th class="table-header"><center>Name</center></th>	
                                                        <th class="table-header" colspan="2"><center>Actions</center></th>
													</tr>
												</thead>
												<tbody>
                                                
                                                 <?php $count = 1;foreach($students as $row):?>
													<tr>
														
                                                   
														<td align="center">
															<?php echo $count++;?>
														</td>
                                                       
														
                                                                      <td style="text-align: center;"><?php echo $row['name'];?></td>
                                          <td style="text-align: center;">
															
									<a href="<?php echo base_url();?>index.php/Admin/activate_student/<?php echo $row['student_id']?>/<?php echo $class_id?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-toggle-on"></i>
                    </a>								

				
				</td>													
																

													</tr>

												<?php endforeach;?>	
												</tbody>
											</table>
                                           </div></div></div></div></div>
                                    <?php echo form_close(); ?>
                       
			<?php include_once APPPATH . 'views/footer.php'; ?>

 <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Activated Successfully...', 'Activated', {timeOut: 5000})</script>";
}

?>
