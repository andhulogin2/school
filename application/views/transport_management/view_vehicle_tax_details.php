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
									Vehicle Tax details
								
							</h1>
						</div> 
                       
                        <div align="right"> <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_details/" data-dismiss="fileinput"><button class="btn-info">Back</button></b></a> 
                        <a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_tax_details/'.$vehicle_master_id; ?>" ><button class="btn-info">New Entry</button></a></div> 
                             
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                             
                                   </div> 
								<br />
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Sl No.</center></th>
														
                                                        <th class="table-header"><center>Paid On</center></th>
                                                        <th class="table-header"><center>Paid From </center></th>
                                                        <th class="table-header"><center>Paid To</center></th>
                                                    
                                                        <th class="table-header"><center>Amount</center></th>
                                                    
                                                        <th class="table-header"><center>Paid Office</center></th>
                                                        
                                                     
                                                       
                                                       <th class="table-header"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												  //$this->db->where('branch_id',$branch_id);
												  
												  foreach($log as $vehicle):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo date('d-m-Y',strtotime($vehicle['tax_paid_on']));?></center></td>
                                                          <td><center><?php echo date('d-m-Y',strtotime($vehicle['tax_paid_from']));?></center></td>
                                                           <td><center><?php echo date('d-m-Y',strtotime($vehicle['tax_paid_to']));?></center></td>
                                                            <td><center><?php echo $vehicle['tax_amount'];?></center></td>
                                                           <td><center><?php echo $vehicle['tax_paid_office'];?></center></td>
                                                            
                                                                                   
                                                       
                                                        
														
														
														
														<td><center>
															
																

																<?php
                echo anchor('Transport_management/vehicle_tax_details_edit/'.$vehicle['vehicle_tax_details_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
					</div>	
                    										
																

								<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_tax_details_delete/<?php echo $vehicle['vehicle_tax_details_id']?>/<?php echo $vehicle_master_id; ?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															</center>
														</td>
                                                       
													</tr>

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
