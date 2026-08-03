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
							<li class="active">Stock</li>
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
									Stock  Sub Category
                                    
								
							</h1>
						</div> 
                       
                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/Stock_management/add_stock_item_sub_category/'.$sub_category_id; ?>" ><button class="btn-info">New Entry</button></a></div> 
                              <br> 
            <div class="table-responsive">
           <table id="simple-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th  class="table-header">Sl No.</th>
														<th class="table-header">Category</th>
                                                         <th class="table-header">Sub Category</th>
                                                       <th  class="table-header"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												  //$this->db->where('branch_id',$branch_id);
												  // $this->db->where('is_deleted','N');
												
												   if(count($result)>0)
												  {
												  foreach($result as $subcat):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $subcat['category_name'];?></center></td>
                                                        <td><center><?php echo $subcat['sub_category_name'];?></center></td>
                                                        
														<td>
															
																

																<?php
                echo anchor('Stock_management/stock_item_sub_category_edit/' .$subcat['sub_category_id'], '<i class="fa fa-edit text-info" title="Edit"></i>');
                ?>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    										
																

								<a href="<?php echo base_url();?>index.php/Stock_management/stock_item_sub_category_delete/<?php echo $subcat['sub_category_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger" title="Delete"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															
														</td>
                                           <!--             <td >	
                    										
				   												

								<a href="<?php echo base_url();?>index.php/admin/add_branch_users/<?php echo $branch['branch_id']?>" class="btn-sm btn-icon icon-left">
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
                                                
                                                	<td colspan="4" align="center">
												<?php
													echo "No records found!";
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
if ($action=="success")
{
echo "<script>toastr.success('". "Stock SubCategory name inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="duplicate")
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

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  



<script type="text/javascript">
$(function() {
	$('#simple-table').dataTable({
             stateSave:true,
             "aLengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200,'All']],
        "iDisplayLength": 10
	});
});
</script>       
