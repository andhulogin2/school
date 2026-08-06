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
							<li class="active">Staff</li>
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
								STAFF
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								</small>
							</h1>
						</div>  
                        
                         <?php echo form_open('Admin/staff_view1', array('class' => 'form-horizontal'));?>
                          <div style="padding-right:10px"> 
                          <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Designation: </label>

										<div class="col-sm-4">
											<select class="select2" id="designation" name="designation">
                                               <option value="">Select</option>
                                              <?php 
											  $role	=	$this->session->userdata('role');
											  $designation=$this->db->get('tbl_user_roles')->result_array();
											   foreach($designation as $designation1)
											   {
											   if($role<=$designation1['role_id'])
											   {
											   ?>
                                               <option value="<?php echo $designation1['role_id']?>"><?php echo $designation1['role_name']; ?></option>
                                               <?php
											   }
											   }?>
                                               
                                             </select>
											<input type="submit" type="button" class="btn btn-info" value='Show'>
										</div>
                                        
									</div>
                                    
                                    
                                       
                          </div>
                           <?php echo form_close(); ?>
                        <div align="right" style="padding-right:10px"> 
                          
                              <a href="<?php echo base_url();?>index.php/admin/staff_add"><button class="btn-info">Add Staff</button></a>  
                              <?php if($role==2 ||$role==1)
							  {?>     
                                   </div><br>
                                   <?php 
								   
								   $this->db->where('is_deleted','N');
								   $branch =$this->db->get('tbl_branch')->result_array();
								  foreach($branch as $row1) {?>
                                  <br /><br />
            <div class="table-responsive">
           
                 <div class="col-md-offset-5"> <label><b><font size="+1"><?php echo "Branch : ".$row1['branch_name']?></font></b></label></div>
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Name</th>
														<th class="table-header">User Name</th>
                                                        <th class="table-header">designation</th>
                                                        <?php 
														if($role==1 || $role==2)
														{
														?>
                                                       
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
														<th class="hidden-480 table-header">salary</th>

												
														<th class="hidden-480 table-header">phone</th>
                                                        <th class="hidden-480 table-header">email</th>
                                                        <th class="hidden-480 table-header">options</th>

														
													</tr>
												</thead>
             
              <tbody>
													<tr>
                                                      <?php 
													  $this->db->select('s.name,s.username,s.email as email,s.phone,s.salary,s.role,s.dept_id,s.staff_id');
			 	
		             $this->db->where('s.is_deleted','N');
					  $this->db->where('s.branch_id',$row1['branch_id']);
					  $this->db->join('tbl_branch b','b.branch_id=s.branch_id','LEFT');
					$staff	=	$this->db->get('staff s' )->result_array();
		              foreach($staff as $row):
		          ?>
                <td style="text-align: center;"><?php echo $row['name'];?></td>
            	  <td style="text-align: center;"><?php echo $row['username'];?></td>
                 <td style="text-align: center;"><?php echo $this->db->get_where('tbl_user_roles' , array('role_id' =>$row['role']))->row()->role_name;?>
                  </td>
                  <?php
				  if($role==1 || $role==2)
				  {
				  ?>
                  
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
				  
                <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['salary'];?></td>
            	  <td style="text-align: center;"><?php echo $row['phone'];?></td>
				        <td style="text-align: center;"><?php echo $row['email'];?></td>
			         <td style="text-align: center;" class="text-nowrap">
						<a href="<?php echo base_url();?>index.php/admin/staff_profile/<?php echo $row['staff_id'];?>" data-toggle="tooltip" data-original-title="Profile"> <i class="fa fa-user text-inverse m-r-10"></i></a>
						&nbsp;&nbsp;&nbsp;
						<a href="<?php echo base_url();?>index.php/Admin/staff_delete/<?php echo $row['staff_id'];?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirmation();"> <i class="fa fa-remove text-inverse m-r-10" style="color:#FF0000"></i></a>
					 </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            <?php }?>
            </div>
          </div>
          </div>
                          
          <div></div>
          <?php }?>
          
          <?php if($role==3)
							  {?>     
                                   </div><br>
                                   <?php 
								   
								   $this->db->where('is_deleted','N');
								     $this->db->where('branch_id',$this->session->userdata('branch_id'));
								   $branch =$this->db->get('tbl_department')->result_array();
								  foreach($branch as $row1) {?>
                                  <br /><br />
            <div class="table-responsive">
            
                 <div class="col-md-offset-5"> <label><b><font size="+1"><?php echo "Dept : ".$row1['dept_name']?></font></b></label></div>
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Name</th>
														<th class="table-header">User Name</th>
                                                        <th class="table-header">designation</th>
                                                        
														<th class="hidden-480 table-header">salary</th>

												
														<th class="hidden-480 table-header">phone</th>
                                                        <th class="hidden-480 table-header">email</th>
                                                        <th class="hidden-480 table-header">options</th>

														
													</tr>
												</thead>
             
              <tbody>
													<tr>
                                                     <?php 
			 	 
		
		             $this->db->where('s.is_deleted','N');
					 
					  $this->db->where('s.dept_id',$row1['dept_id']);
					  $this->db->join('tbl_department b','b.dept_id=s.dept_id','LEFT');
					$staff	=	$this->db->get('staff s' )->result_array();
		              foreach($staff as $row):
		          ?>
                <td style="text-align: center;"><?php echo $row['name'];?></td>
            	  <td style="text-align: center;"><?php echo $row['username'];?></td>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_user_roles' , array('role_id' =>$row['role']))->row()->role_name;?>
                  </td>
                 
				  
                <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['salary'];?></td>
            	  <td style="text-align: center;"><?php echo $row['phone'];?></td>
				        <td style="text-align: center;"><?php echo $row['email'];?></td>
			         <td style="text-align: center;" class="text-nowrap">
						<a href="<?php echo base_url();?>index.php/admin/staff_profile/<?php echo $row['staff_id'];?>" data-toggle="tooltip" data-original-title="Profile"> <i class="fa fa-user text-inverse m-r-10"></i></a>
						&nbsp;&nbsp;&nbsp;
						<a href="<?php echo base_url();?>index.php/Admin/staff_delete/<?php echo $row['staff_id'];?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirmation();"> <i class="fa fa-remove text-inverse m-r-10" style="color:#FF0000"></i></a>
					 </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            <?php }?>
            </div>
          </div>
          </div>
                          
          <div></div>
          <?php }?>
          
           <?php if($role==4 || $role==12){?>
							  
            <div class="table-responsive">
            
                 
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Name</th>
														<th class="table-header">User Name</th>
                                                        <th class="table-header">designation</th>
                                                        
														<th class="hidden-480 table-header">salary</th>

												
														<th class="hidden-480 table-header">phone</th>
                                                        <th class="hidden-480 table-header">email</th>
                                                        <th class="hidden-480 table-header">options</th>

														
													</tr>
												</thead>
             
              <tbody>
													<tr>
                                                     <?php 
			 	 
		
		             $this->db->where('is_deleted','N');
					  $this->db->where('branch_id',$this->session->userdata('branch_id'));
					   $this->db->where('dept_id',$this->session->userdata('dept_id'));
					  if($staff_role)
					  {
					  		$this->db->where('role',$staff_role);	
					  }
					 
					$staff	=	$this->db->get('staff')->result_array();
					
		              foreach($staff as $row):
		          ?>
                <td style="text-align: center;"><?php echo $row['name'];?></td>
            	  <td style="text-align: center;"><?php echo $row['username'];?></td>
                  <td style="text-align: center;"><?php echo $this->db->get_where('tbl_user_roles' , array('role_id' =>$row['role']))->row()->role_name;?>
                  </td>
                 
				  
                <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['salary'];?></td>
            	  <td style="text-align: center;"><?php echo $row['phone'];?></td>
				        <td style="text-align: center;"><?php echo $row['email'];?></td>
			         <td style="text-align: center;" class="text-nowrap">
						<a href="<?php echo base_url();?>index.php/admin/staff_profile/<?php echo $row['staff_id'];?>" data-toggle="tooltip" data-original-title="Profile"> <i class="fa fa-user text-inverse m-r-10"></i></a>
						&nbsp;&nbsp;&nbsp;
						<a href="<?php echo base_url();?>index.php/Admin/staff_delete/<?php echo $row['staff_id'];?>" data-toggle="tooltip" data-original-title="Delete" onclick="return confirmation();"> <i class="fa fa-remove text-inverse m-r-10" style="color:#FF0000"></i></a>
					 </td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
           
            </div>
          </div>
          <div style="padding-top: 100px;"></div>
          </div>
                          
          <div></div>
          <?php }?>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
function confirmation()
{
	if(confirm("Are you sure?"))
	{
		return true;	
	}
	else
	{
		return false;
	}
}
</script>     
     
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if ($action=="null_staff")
{
echo "<script>toastr.error('". "Staff not deleted...', 'Failed', {timeOut: 5000})</script>";
}
if ($action=="exist_in_section")
{
echo "<script>toastr.error('". "Selected staff is assigned to a division...', 'Not Deleted', {timeOut: 5000})</script>";
}
if ($action=="exist_in_subject_teacher")
{
echo "<script>toastr.error('". "One or more subject is assigned to selected staff...', 'Not Deleted', {timeOut: 5000})</script>";
}
if ($action=="deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}

?>

