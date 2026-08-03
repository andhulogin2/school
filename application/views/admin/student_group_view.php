<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
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
							<li class="active">Groups</li>
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
									 Groups
                                    
								
							</h1>
						</div> 
                       
                        <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/add_student_group/'; ?>" >New Group</a></div> 
                              <br> 
           <div class="table-responsive">
           <table id="dynamic-table" class="table sortable table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header"><center>Sl No.</center></th>
														<th class="table-header" style="text-align:center">Group For&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Name"></i></th>
														<th class="table-header" style="text-align:center">Group Name&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Name"></i></th>
														<th class="table-header" style="text-align:center">Notes</i></th>
														<th class="table-header" style="text-align:center">Created Date&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Date"></i></th>
                                                        <?php
														if($role==1 || $role==2)
														{
														?>
                                                        <th class="table-header" style="text-align:center">Department&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Department"></i></th>
                                                       	<th class="table-header" style="text-align:center">Branch&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Branch"></i></th>
                                                        <?php		
														}
														if($role==3)
														{
														?>
                                                        <th class="table-header" style="text-align:center">Department&nbsp;&nbsp;<i class="fa fa-sort" aria-hidden="true" title="Sort By Department"></i></th>
                                                        <?php		
														}
														?>
                                                       
                                                       <th class="table-header" colspan="3"><center>Action</center></th>
                                                      
														
													</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												
												  if(count($group)>0)
												  {
												  foreach($group as $groups):?>
													<tr>
														

														<td><center>
															<?php echo $count++;?>
														</center></td>
                                                        <input type="hidden" name="students_group_master_id[]" id="students_group_master_id[]" value="<?php echo $groups['students_group_master_id'];?>"  />
														<td><center><?php echo ucfirst($groups['group_for']);?></center></td>
														<td><center><?php echo $groups['students_group_master_name'];?></center></td>
														<td><center><?php echo $groups['notes'];?></center></td>
														<td><center><?php echo date('d-m-Y',strtotime($groups['entered_date']));?></center></td>

                                                        <?php
														if($role==1 || $role==2)
														{
														?>
                                                        <td><center><?php echo $groups['dept_name'];?></center></td>
                                                        <td><center><?php echo $groups['branch_name'];?></center></td>
                                                        <?php		
														}
														if($role==3)
														{
														?>
                                                        <td><center><?php echo $groups['dept_name'];?></center></td>
                                                        <?php		
														}
														?>

                                                        
                                                       
                                                        
														
														
														
														<td><center>
															
																
				
																<?php
                echo anchor('Admin/edit_student_group/' .$groups['students_group_master_id'], '<i class="fa fa-edit text-info" title="Edit"></i>');
                ?>
					&nbsp;&nbsp;&nbsp;	
                    										
																

				<span name="delete1[]"><a name="delete[]" href="<?php echo base_url();?>index.php/Admin/delete_student_group/<?php echo $groups['students_group_master_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i name="i_delete[]" class="fa fa-close text-danger" title="Delete"></i>
                    </a></span>
                    &nbsp;&nbsp;&nbsp;
                    
				<?php
                echo anchor('Admin/add_students_to_group/' .$groups['students_group_master_id'].'/'.$groups['dept_id'].'/'.$groups['branch_id'].'/'.$groups['group_for'], '<i class="fa fa-user text-info" title="Add/Remove Students"></i>');
                ?>                   				
                    &nbsp;&nbsp;&nbsp;
               <span name="message1[]">     
				<?php
                echo anchor('Admin/student_group_message/' .$groups['students_group_master_id'].'/'.$groups['group_for'], '<i name="i_message[]" class="fa fa-envelope text-info" title="Send message to group members"></i>',array('name'=>'message[]'));
                ?>  
                </span>                 				
                    &nbsp;&nbsp;&nbsp;
                <?php 
				if($groups['group_for']=="students")
				{
				?>
                <span name="view1[]">     
				<?php
                echo anchor('Admin/view_student_group_members/' .$groups['students_group_master_id'].'/'.$groups['dept_id'].'/'.$groups['branch_id'], '<i name="i_view[]" class="fa fa-eye text-info" title="View group members"></i>',array('name'=>'view[]'));
                }
				else
				{
				echo anchor('Admin/view_staff_group_members/' .$groups['students_group_master_id'].'/'.$groups['dept_id'].'/'.$groups['branch_id'], '<i name="i_view[]" class="fa fa-eye text-info" title="View group members"></i>',array('name'=>'view[]'));
				}
				?>                   				
                                                               
															

															
														</center></td>
													</tr>

												<?php endforeach;?>	
                                                 <?php
												}
												else
													{
												?>
                                                <tr>
                                                	<td colspan="6" style="text-align:center;color:#FF0000"><b>
												<?php
													echo "No records found!";
												?>
                                                	</b></td>
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(). 'assets/js/sorttable.js'; ?>"></script>
<script>
$(document).ready(function(){
	
	check_members_exist();
});
function check_members_exist()
{
	var students_group	=	document.getElementsByName('students_group_master_id[]');
	
	for(var i=0;i<students_group.length;i++)
	{	
		student_group_master_id	=	students_group[i].value;
		check_members_exist1(student_group_master_id,i);
		//alert(i);
	}
}
function check_members_exist1(student_group_master_id,i)
{
		$.ajax({ 
			url: '<?php echo base_url();?>index.php/Admin/check_members_exist/' + student_group_master_id,
			success: function(response)
			{
				members_exist(response,i);
				
				//jQuery('#absent_student1').html(response);
			}
		});
}
function members_exist(response,i)
{
	delete_btn		=	document.getElementsByName('delete[]');
	delete_btn1		=	document.getElementsByName('delete1[]');
	i_delet			=	document.getElementsByName('i_delete[]');
	
	msg				=	document.getElementsByName('message[]');
	msg1			=	document.getElementsByName('message1[]');
	i_msg			=	document.getElementsByName('i_message[]');

	views			=	document.getElementsByName('view[]');
	views1			=	document.getElementsByName('view1[]');
	i_views			=	document.getElementsByName('i_view[]');

	if(parseInt(response) == 1)
	{
		delete_btn1[i].title				=	"Can not delete. Members exist in this group.";
		delete_btn[i].style.pointerEvents	=	"none";
		delete_btn[i].style.cursor			=	"default";
		i_delet[i].style.color				=	"#CCCCCC";
	}
	else
	{
		msg1[i].title						=	"Can not send message,because no members exist in this group.";
		msg[i].style.pointerEvents			=	"none";
		msg[i].style.cursor					=	"default";
		i_msg[i].style.color				=	"#CCCCCC";
		
		views1[i].title						=	"No members exist in this group to view.";
		views[i].style.pointerEvents		=	"none";
		views[i].style.cursor				=	"default";
		i_views[i].style.color				=	"#CCCCCC";
	}
}
</script>
          
          
          
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="inserted")
{
echo "<script>toastr.success('". "Group name inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="not_inserted")
{
echo "<script>toastr.error('". "Group name insertion failed...', 'Failed', {timeOut: 5000})</script>";
}
else if($action=="updated")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="not_updated")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}
else if($action=="deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="not_deleted")
{
echo "<script>toastr.error('". "Deletion failed...', 'Not deleted', {timeOut: 5000})</script>";
}

?>

