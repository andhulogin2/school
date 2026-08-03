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
							<li class="active">Designation</li>
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
									 Designation
								
							</h1>
						</div> 
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/add_designation/'; ?>" >New</a></div> 
                              <br> 
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Designation</th>
                                                        <th class="table-header">Role</th>
                                                        
                                                       <th class="table-header" colspan="2"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php $count = 1;
												$this->db->select('d.designation,r.role_name');
		$this->db->from('tbl_designation d');
		$this->db->join('tbl_user_roles r','d.role=r.role_id','LEFT');
		$query	=	$this->db->get()->result_array();
												  foreach($query as $designation):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $designation['designation'];?></center></td>
                                                        <td><center><?php echo $designation['role_name'];?></center></td>
                                                       
                                                       
                                                        
														
														
														
														<td style="text-align: center;">
															
																

																<?php
                echo anchor('Admin/branch_edit/' .$branch['branch_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
					</div></td><td >	
                    										
																

								<a href="<?php echo base_url();?>index.php/admin/branch_delete/<?php echo $branch['branch_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
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
