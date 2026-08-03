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
							<li class="active">Transportation</li>
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
								View
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Vehicle Maintenance Log
                                    
								
							</h1>
						</div> 
                       
                        <div align="right"><a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_details/" data-dismiss="fileinput"><button class="btn-info">Back</button></b></a> 
                        <a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_maintenance_log_book/'.$vehicle_master_id; ?>" ><button class="btn-info">New Entry</button></a></div> 
                              
                            <div align="right" style="padding-right:100px"> 
                              
                                   </div> 
                                   <br> 
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Sl No.</center></th>
														<th class="table-header"><center>Registration Number</th>
														<th class="table-header"><center>Date</center></th>
														<th class="table-header"><center>Work Done</center></th>
														<th class="table-header"><center>Work Done From</center></th>
														<th class="table-header"><center>Work Cost</center></th>
                                                       
                                                       <th class="table-header"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												  if(count($result)>0)
												  {
												  		foreach($result as $vehicle):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $vehicle['vehicle_registration_number'];?></center></td>
														<td><center><?php echo date('d/m/Y',strtotime($vehicle['date_of_entry']));?></center></td>
														<td><center><?php echo $vehicle['maintenance_work_done'];?></center></td>
														<td><center><?php echo $vehicle['maintenance_work_done_from'];?></center></td>
														<td><center><?php echo $vehicle['maintenance_work_cost'];?></center></td>
														
                                                        
                                                        <td>
															&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/vehicle_maintenance_log_book_edit/' .$vehicle['maintenance_log_book_id'], '<i class="fa fa-edit text-info"></i>');
                											?>
					</div>
															<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_maintenance_log_book_delete/<?php echo $vehicle['maintenance_log_book_id']?>/<?php echo $vehicle_master_id; ?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                           	 								<i class="fa fa-close text-danger"></i>
                    										</a>	
                    
                    
                   				
                                                               
															</div>

															
														</td>
<!--                                                        <td >	
                    										
																

								<a href="<?php // echo base_url();?>index.php/admin/add_branch_users/<?php //echo $branch['branch_id']?>" class="btn-sm btn-icon icon-left">
                            <i class="fa fa-user text-info"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															
														</td>  -->
                                                        
													</tr>

												<?php endforeach;?>	
                                                <?php
												}
												else
													{
												?>
                                                <tr>
                                                	<td colspan="14" align="center">
												<?php
													echo "<b>No records found!</b>";
												?>
                                                	</td>
                                                </tr> 
                                               <?php
													}
												?>
                                                	
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
$action = $this->session->flashdata('action');
if ($action=="Inserted")
{
echo "<script>toastr.success('". "Vehicle maintenance log inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "Insertion failed...', 'Duplicate', {timeOut: 5000})</script>";
}
else if($action=="Updated")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="Not updated")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}
else if($action=="Deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="Failed")
{
echo "<script>toastr.error('". "Not deleted...', 'Not deleted', {timeOut: 5000})</script>";
}

?>
