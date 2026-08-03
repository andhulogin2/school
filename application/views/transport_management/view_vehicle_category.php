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
									Vehicle Category
								
							</h1>
						</div> 
                       
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Transport_management/add_vehicle_category/'.$branch_id; ?>" >New Vehicle category-</a></div> 
                              <br> 
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Vehicle category name</th>
                                                       
                                                       <th class="table-header" colspan="3"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												  //$this->db->where('branch_id',$branch_id);
												  // $this->db->where('is_deleted','N');
												
												  foreach($log as $vehicle):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $vehicle['vehicle_category_name'];?></center></td>
                                                       
                                                        
														
														
														
														<td>
															
																

																<?php
                echo anchor('Transport_management/vehicle_category_edit/' .$vehicle['vehicle_category_id'].'/'.$vehicle['vehicle_category_name'], '<i class="fa fa-edit text-info"title="Edit"></i>');
                ?>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    										
																

								<a href="<?php echo base_url();?>index.php/Transport_management/vehicle_category_delete/<?php echo $vehicle['vehicle_category_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"title="Delete"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															
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
