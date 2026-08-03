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
									 Vehicle Route Details
                                    
								
							</h1>
                            
						</div> 
                        <div align="right"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                             
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_master/" data-dismiss="fileinput"><button class="btn-info">Back</button></a> 
                              &nbsp;
                               <a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_route_details/'.$route_master_id; ?>" ><button class="btn-info">New Entry</button></a>
                              &nbsp;
                               <a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_route_details_bulk/'.$route_master_id; ?>" ><button class="btn-info">Bulk Entry</button></a> 

                        </div>
                       <div>
                       <table>
                       <tr>
                       		<th style="padding:0px 5px 5px 5px;">Route Name</th>	
                       		<th style="padding:0px 5px 5px 5px;">: <?php echo $route_master_name; ?></th>	
                       </tr>
                       <tr>
                       		<th style="padding:0px 5px 5px 5px;">Route Number</th>	
                       		<th style="padding:0px 5px 5px 5px;">: <?php echo $route_number; ?></th>	
                       </tr>
                       </table>
                       </div>
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Pick Up Point </th>
														<th class="table-header">Pickup Point Lattitude </th>
														<th class="table-header"> Pickup Point Longitude</th>
													     <th class="table-header"> Distance</th>
                                                         <th class="table-header"> Base Fare</th>
                                                       
                                                       <th class="table-header" colspan="3"><center>Action</center></th>
                                                      
														
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
														
														<td><center><?php echo $vehicle['pickup_point'];?></center></td>
														<td><center><?php echo $vehicle['pickup_point_lattitude'];?></center></td>
														<td><center><?php echo $vehicle['pickup_point_longitude'];?></center></td>
                                                        <td><center><?php echo $vehicle['distance'];?></center></td>
                                                        <td><center><?php echo $vehicle['base_fare'];?></center></td>
                                                        <td>
															<?php
                											echo anchor('Transport_management/vehicle_route_details_edit/' .$vehicle['route_details_id'], '<i class="fa fa-edit text-info"  title="Edit"></i>');
                											?>
					</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
															<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_route_details_delete/<?php echo $vehicle['route_details_id']?>/<?php echo $vehicle['route_master_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                           	 								<i class="fa fa-close text-danger"  title="Delete"></i>
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
echo "<script>toastr.success('". "Vehicle route details inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "Insertion failed...', 'Duplicate', {timeOut: 5000})</script>";
}
else if ($action=="Failed")
{
echo "<script>toastr.error('". "Not Added...', 'Failed', {timeOut: 5000})</script>";
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
echo "<script>toastr.error('". "Not deleted...', 'Delete operation failed', {timeOut: 5000})</script>";
}
else if($action=="Exist")
{
echo "<script>toastr.error('". "Students are assigned to this route, so can not delete...', 'Can not Delete', {timeOut: 5000})</script>";
}

?>
