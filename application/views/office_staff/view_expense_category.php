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
							<li class="active"> Category</li>
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
									 Category
								
							</h1>
						</div> 
                       
                        
                                    
                                       
                          
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/expense_category/'; ?>" >New Category</a></div> 
                              <br> 
                               
                         
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Category</th>
                                                       
												
														<th class="table-header" colspan="2"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php $count = 1;
												  $this->db->where('branch_id',$this->session->userdata('branch_id'));
												   $this->db->where('dept_id',$this->session->userdata('dept_id'));
												 $category=$this->db->get('tbl_expence_category')->result_array();
												  foreach($category as $row):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $row['category_name'];?></center></td>
														
														
														
														<td style="text-align: center;">
															
																

																<?php
                echo anchor('Admin/expense_category_edit/' .$row['category_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
					</div></td><td style="width:200px;">	
                    					

								<a href="<?php echo base_url();?>index.php/admin/expense_category_delete/<?php echo  $row['category_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
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
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept_all/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

