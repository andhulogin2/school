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
									Vehicle Running log
								
							</h1>
						</div> 
                        <div align="right" > <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_details" data-dismiss="fileinput"><button class="btn-info">Back</button></a> &nbsp;
 <a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_running_log/'.$vehicle_master_id; ?>"><button class="btn-info">New Entry</button></a>

             
                           
                        
                        </div> 
          
            
            <br />
         
            
                              <br> 
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Sl No.</center></th>
														
                                                        <th class="table-header"><center>Date of entry</center></th>
                                                        <th class="table-header"><center>Meter reading ( Start - End )</center></th>
                                                    
                                                        <th class="table-header"><center>Route</center></th>
                                                       
                                                      
                                                       
                                                       <th class="table-header"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
											 	if(count($log1)>0):												
												  foreach($log1 as $vehicle):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo date('d-m-Y',strtotime($vehicle['date_of_entry']));?></center></td>
                                                          <td><center><?php echo $vehicle['starting_meter_reading'];?> - <?php echo $vehicle['ending_meter_reading'];?></center></td>
                                                            <td><center><?php echo $vehicle['journey_from'];?> - <?php echo $vehicle['journey_to'];?></center></td>
                                                             
                                                                                   
                                                       
                                                        
														
														
														
														<td><center>
															
																

																<?php
                echo anchor('Transport_management/vehicle_running_log_edit/'.$vehicle['running_log_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
				&nbsp;&nbsp;&nbsp;
								<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_running_log_delete/<?php echo $vehicle['running_log_id']?>/<?php echo $vehicle_master_id; ?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
                    
                    
                   				
                                                               
															

															
														</center></td>
                                                       
													</tr>

												<?php 
													endforeach;
												else:
												?>	
                                                <tr>
                                                	<td colspan="7" style="text-align:center;color:#FF0000"><b>No Records Found</b></td>
                                                </tr>
                                                <?php
												endif;
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
$action=$this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "added Successfully...', 'added', {timeOut: 5000})</script>";
}

else if ($action=="duplicate")
{
echo "<script>toastr.error('". "Error when adding.....', 'Error', {timeOut: 5000})</script>";

}
else if ($action=="updated")
{
echo "<script>toastr.success('". "updated successfully.....', 'updated', {timeOut: 5000})</script>";

}
else if ($action=="not_updated")
{
echo "<script>toastr.error('". "error when updating......', 'error', {timeOut: 5000})</script>";

}
else if ($action=="deleted")
{
echo "<script>toastr.success('". "deleted successfully......', 'success', {timeOut: 5000})</script>";

}
else if ($action=="not_deleted")
{
echo "<script>toastr.error('". "error when deleting......', 'error', {timeOut: 5000})</script>";

}


//echo $action;

?>
