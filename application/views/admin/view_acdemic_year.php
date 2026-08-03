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
							<li class="active">Academic Year</li>
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
									 Academic Year
								
							</h1>
						</div> 
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/set_academic_year/'; ?>" >New Academic Year</a></div> 
                              <br> 
           
                   <br /><br />
            <div class="table-responsive">
           
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Academic Year</center></th>
                                                        <th class="table-header"><center>Start Date</center></th>
                                                        <th class="table-header"><center>End Date</center></th>
                                                       <th class="table-header" colspan="3"><center>Action</center></th>
                                                      
													</tr>
												</thead>
             
             <tbody>
                                                  
													<tr>
                                                    <?php
													
													
													foreach($year as $data){ ?>
													
													    <td><center><?php echo $data['academic_year'];?></center></td>
                                                        <td><center><?php echo date('d-m-Y',strtotime($data['start_date']));?></center></td>
                                                        <td><center><?php echo date('d-m-Y',strtotime($data['end_date']));?></center></td>
                                            
														<td>
											        	<?php
                echo anchor('Admin/edit_academic_year/' .$data['acdemic_year_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
					</div> </td><td >	
                    										
																

								<a href="<?php echo base_url();?>index.php/admin/delete_academic_year/<?php echo $data['acdemic_year_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															
														</td>
                                                        
                                                        
													</tr>

												
												</tbody>
                                                <?php };?>	
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
