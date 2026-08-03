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
									 Vehicle Master
                                    
								
							</h1>
						</div> 
                       
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_master/'.$branch_id; ?>" >New Vehicle Master</a></div> 
                              <br> 
                               <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_details" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
             </div>
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Registration Number</th>
														<th class="table-header">Registration Date</th>
														<th class="table-header">Owner Name</th>
														<th class="table-header">Ownership Type</th>
														<th class="table-header">Category</th>
														<th class="table-header">Vehicle Class</th>
														<th class="table-header">Vehicle Maker</th>
														<th class="table-header">Seat Capacity</th>
														<th class="table-header">Tax Licence Number</th>
														<th class="table-header">Year of Manufacture</th>
														<th class="table-header">Month of Manufacture</th>
														<th class="table-header">Branch</th>
                                                       
                                                       <th class="table-header" colspan="3"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
							  //$this->db->where('branch_id',$branch_id);
												  // $this->db->where('is_deleted','N');
												  
												 if(count($log)>0)
												  {
												  		//s$query	=	$this->db->get('tbl_transport_vehicle_master')->result_array();
												  		foreach($log as $vehicle):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $vehicle['vehicle_registration_number'];?></center></td>
														<td><center><?php echo $vehicle['registration_date'];?></center></td>
														<td><center><?php echo $vehicle['owner_name'];?></center></td>
														<td><center><?php echo $vehicle['ownership_type_id'];?></center></td>
														<td><center><?php echo $vehicle['vehicle_category_id'];?></center></td>
														<td><center><?php echo $vehicle['vehicle_class_id'];?></center></td>
														<td><center><?php echo $vehicle['vehicle_maker_id'];?></center></td>
														<td><center><?php echo $vehicle['seat_capacity'];?></center></td>
														<td><center><?php echo $vehicle['tax_licence_number'];?></center></td>
														<td><center><?php echo $vehicle['year_of_manufacture'];?></center></td>
														<td><center><?php echo $vehicle['month_of_manufacture'];?></center></td>
														<td><center><?php echo $vehicle['branch_id'];?></center></td>
                                                       
                                                        
														
														
														
														<td>
															
																

																<?php
                echo anchor('Transport_management/vehicle_master_edit/' .$vehicle['vehicle_master_id'], '<i class="fa fa-edit text-info"  title="Edit"></i>');
                ?>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                    										
																

								<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_master_delete/<?php echo $vehicle['vehicle_master_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger" title="Delete"></i>
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
else if($action=="Deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="Failed")
{
echo "<script>toastr.error('". "Not deleted...', 'Not deleted', {timeOut: 5000})</script>";
}

?>
