<?php include_once APPPATH . 'views/main_head.php';?>
<?php $running_year = get_running_year(); 
$role=$this->session->userdata('role');
?>
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
									 Vehicle Details
                                    
								
							</h1>
						</div> 
                       
                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_master/'.$branch_id; ?>" ><button class="btn-info">New Entry </button></a></div> 
                              <br> 
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Sl No.<center></th>
                                                        <?php if($role<4){ ?>
														<th class="table-header"><center>Branch<center></th>
                                                        <?php } ?>
														<th class="table-header"><center>Registration Number<center></th>
														<th class="table-header"><center>Category<center></th>
														<th class="table-header"><center>Vehicle Class<center></th>
														<th class="table-header"><center>Seat Capacity<center></th>
														<th class="table-header"><center>View Details</center></th>
                                                       <th class="table-header"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
             
                                                 <?php 
												 
												  $count = 1;
												  //$this->db->where('branch_id',$branch_id);
												  // $this->db->where('is_deleted','N');
												  if(count($result)>0)
												  {
												  		foreach($result as $vehicle):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
                                                        <?php if($role<4){ ?>
														<td><center><?php echo $vehicle['branch_name'];?></center></td>
                                                        <?php } ?>
														<td><center><?php echo $vehicle['vehicle_registration_number'];?></center></td>
														<td><center><?php echo $vehicle['vehicle_category_name'];?></center></td>
														<td><center><?php echo $vehicle['vehicle_class_name'];?></center></td>
														<td><center><?php echo $vehicle['seat_capacity'];?></center></td>
														<td><center>
                                                        	<?php
                											echo anchor('Transport_management/view_single_vehicle_master/'.$vehicle['vehicle_master_id'], '<i class="fa fa-bus text-info"  title="Vehicle Master"></i>');
                											?>
                                                        	&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/view_vehicle_running_log/'.$vehicle['vehicle_master_id'], '<i class="fa fa-tachometer text-info"  title="Running Log Book"></i>');
                											?>
                                                        	&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/view_vehicle_fuel_log/'.$vehicle['vehicle_master_id'], '<i class="fa fa-beer"  title="Fuel Log Book"></i>');
                											?>
                                                        	&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/view_vehicle_maintenance_log_book/'.$vehicle['vehicle_master_id'], '<i class="fa fa-automobile"  title="Maintenance Log Book"></i>');
                											?>
                                                        	&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/view_vehicle_tax_details/'.$vehicle['vehicle_master_id'], '<i class="fa fa-calculator"  title="Tax Details"></i>');
                											?>
                                                        	&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/view_vehicle_insurance_details/'.$vehicle['vehicle_master_id'], '<i class="fa fa-book"  title="Insurance Details"></i>');
                											?>
                                                        	&nbsp;&nbsp;<?php
                											echo anchor('Transport_management/view_vehicle_pollution_test_details/'.$vehicle['vehicle_master_id'], '<i class="fa fa-fire"  title="Pollution Test Details"></i>');
                											?>

                                                        </center></td>
                                                        		
														<td><center>
															
																

																<?php
                echo anchor('Transport_management/vehicle_master_edit/'.$vehicle['vehicle_master_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
				&nbsp;&nbsp;&nbsp;
								<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_master_delete/<?php echo $vehicle['vehicle_master_id']?>/<?php echo $vehicle_master_id; ?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
                    
                    
                   				
                                            </center></td>
                                                       
                                                        
														
														
														
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
echo "<script>toastr.success('". "Vehicle master name inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "The name already exists...', 'Duplicate', {timeOut: 5000})</script>";
}
else if($action=="Updated")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="Not updated")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}
else if($action=="Success")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="Failed")
{
echo "<script>toastr.error('". "Vehicle may assigned in Other Route...', 'Can not delete', {timeOut: 5000})</script>";
}

?>
