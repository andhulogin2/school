<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
  $running_year = get_running_year(); ?>
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
							<li class="active">New Class</li>
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
									 Classes
								
							</h1>
						</div> 
                         <?php echo form_open('Admin/view_class', array('class' => 'form-horizontal'));
                        $role=$this->session->userdata('role');
						if($role==1 || $role==2)
						{
						 ?>
                         
                         <div class="col-md-12">
										<label class="col-sm-1"> Branch: </label>

										<div class="col-sm-2">
											<select class="select2" id="branch" name="branch" onChange="return get_dept(this.value)">
                                               <option value="">Select</option>
                                               <?php $branch=$this->db->get('tbl_branch')->result_array();
											   foreach($branch as $branch_id){?>
                                               <option value="<?php echo $branch_id['branch_id']?>"><?php echo $branch_id['branch_name']; }?></option>
                                               
                                             </select>
											
										</div>
                                        
								
                                    
                                    
										<label class="col-sm-1"> Department: </label>

										<div class="col-sm-2">
											<select name="department" class="select2" id="department">
                              <option value="">Select</option>
                             
                              
                          </select>
                                             </div>
                                             <div class="col-sm-2">
											<input type="submit" type="button" class="btn btn-info" value='Show'>
										</div>
                                        
									</div>
                                    <?php } 
                                    $role=$this->session->userdata('role');
						if($role==3)
						{
						 ?>
                         
                         <div class="col-md-12">
									

										
								
                                    
                                    
										<label class="col-sm-1"> Department: </label>

										<div class="col-sm-3">
											<select name="department" class="select2" id="department">
                              <option value="">Select</option>
                             <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                              
                          </select>
                                             </div>
                                             <div class="col-sm-3">
											<input type="submit" type="button" class="btn btn-info" value='Show'>
										</div>
                                        
									</div>
                                    <?php }?>
                                     <?php echo form_close(); ?>
                                    
                                       
                          
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/class_add/'; ?>" ><button class="btn-info">New Class</button></a> <a href="<?php echo base_url() . 'index.php/Admin/class_bulk/'; ?>" ><button class="btn-info">Bulk Class</button></a></div> 
                        
                      
                         
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Class</th>
                                                        <?php 
														if($role==1 || $role==2)
														{
														?>
                                                        <th class="table-header">Branch</th>
                                                        <th class="table-header">Department</th>
                                                        <?php
														}
														if($role==3)
														{
														?>
                                                        <th class="table-header">Department</th>
                                                        <?php
														}
														?>
												
														<th class="table-header" colspan="2"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                  <?php $count = 1;
												 
												  foreach($class as $row):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $row['name'];?></center></td>
														 <?php
				  if($role==1 || $role==2)
				  {
				  ?>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_branch' , array('branch_id' =>$row['branch_id']))->row()->branch_name;?>
                  </td>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_department' , array('dept_id' =>$row['dept_id']))->row()->dept_name;?>
                  </td>
                  <?php
				  }
				  if($role==3)
				  {
				  ?>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_department' , array('dept_id' =>$row['dept_id']))->row()->dept_name;?>
                  </td>
                  <?php
				  }
				  ?>
														
														
														<td style="text-align: center;">
															
																

																<?php
                echo anchor('Admin/view_class_edit/' .$row['class_id'], '<i class="fa fa-edit text-info"></i>');
                ?>
					</div></td><td style="width:200px;">	
                    			<?php 
								$this->db->where('class_id',$row['class_id']);
								$a=$this->db->get('enroll');
							
								if($a->num_rows() >0)
								{
								echo "can not delete value exist";
								}
								else{?>								
																

								<a href="<?php echo base_url();?>index.php/admin/view_class_delete/<?php echo $row['class_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
                    <?php }?>	
                    
                   				
                                                               
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
	$('#dynamic-table').dataTable({
             stateSave:true,
             "aLengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200,'All']],
        "iDisplayLength": 10
	});
});
</script>       
