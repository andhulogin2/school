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
							<li class="active">Admission</li>
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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								STAFF
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add New
								</small>
							</h1>
						</div> 
                     <div align="right">     
                              <a href="<?php echo base_url();?>index.php/admin/staff_view" data-dismiss="fileinput"><button class="btn-info">View Staff</button></a>       
                                   </div> 
                     
                     <?php 
                                   echo form_open_multipart('Admin/add_staff', array('class' => 'form-horizontal'));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Designation :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="designation" class="select2" id="designation" onChange="get_branch(this.value)" required="" >
                              <option value="">Select</option>
                              <?php 
							  $role	=	$this->session->userdata('role');
							  $this->db->where('role_id!=5');
							$designation=$this->db->get('tbl_user_roles')->result_array();
							  foreach ($designation as $designation1)
							  {
							  if($role<$designation1['role_id'])
											   {
											   ?>
                                               <option value="<?php echo $designation1['role_id']?>"><?php echo $designation1['role_name']; ?></option>
                                               <?php
											   }
											  } ?>
                              
                          </select>
										</div>
									</div>
<?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" required="" >
                              <option value="">Select</option>
                              <?php 
							  $this->db->where('is_deleted','N');
							  $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    
                                   
                                    
                                    <div class="form-group" id="dept_role">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department"  >
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    <?php } ?>
                                    
                                    
                                   <?php  if($role==3){?>
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" required="" >
                              <option value="">Select</option>
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $this->db->where('is_deleted','N');
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    <?php } ?>
                                      
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" name="name" required="" />
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Name: <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="user_name" name="user_name" placeholder="User Name" class="col-xs-10 col-sm-5" required="" onchange="return username(this.value)" />
										</div>
									</div>
                                     <div id="check_username" align="left">
                        </div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Password: <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="password" id="password" name="password" placeholder="Password" class="col-xs-10 col-sm-5" required="" />
											
										</div>
									</div>

									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email: </label>

										<div class="col-sm-9">
											<input type="text" id="email" name="email" placeholder="Email" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>

									

											

								
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="phone" name="phone" placeholder="Phone number" class="col-xs-10 col-sm-5" required="" />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address: </label>

										<div class="col-sm-9">
											<textarea class="col-xs-10 col-sm-5" id="address" name="address" placeholder="Address"></textarea>
											
										</div>
									</div>
                                     <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Date Of Birth:</label>
									<div class="col-sm-2">
									<div class="clearfix">
									<div class="input-group input-group-sm">
									<input type="text" id="dob"  class="form-control mydatepicker" name="dob" />
									<span class="input-group-addon">
								    <i class="ace-icon fa fa-calendar"></i>
								    </span>
								    </div>
								    </div>
									</div>
									</div>
									
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Salary: </label>

										<div class="col-sm-9">
											<input type="text" id="salary" name="salary" placeholder="Salary" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>

										<div class="col-sm-9">
											<select class="select2" id="sex" name="sex" data-placeholder="Select one">
                                               <option value="">Select one</option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                             </select>
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										
             
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> PHOTO: </label>
                           <div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/150x150" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-info btn-file">
										<span class="fileinput-new">Upload</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Delete</a>
								</div>
							</div>
						</div>
                        </div>
                                   
                                     
                                    
                                    
                                     
								
                    <div class="col-md-offset-3 col-md-9">
                     <input type="submit" class="btn btn-info"  value='Submit'>
                        
										</div>
                                         <?php echo form_close(); ?></div> 
                                            </div></div>
									
                                        
                                 
									</div>
                                    
                                    </div>
                                   
                                    
                                    </div>
                                    
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

if ($action=="Error")
{
echo "<script>toastr.error('". "Invalid...', 'Failed', {timeOut: 5000})</script>";
}
?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
	function get_branch(role) 
	{
	
	if(role==2)
	{
	$('#branch_role').hide();
	$('#dept_role').hide();
	}
	if(role==3)
	{
	$('#branch_role').show();
	$('#dept_role').hide();
	}
	if(role==4 || role==12)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==5)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==6)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==7)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
    }
</script>

<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        if (typeof $.fn.datepicker !== 'undefined') {
            $('#dob').datepicker({
                autoclose: true,
                todayHighlight: true,
                format: 'dd-mm-yyyy'
            });
        }
	 });
</script>

<script type="text/javascript">
    function username(user_name)
    {
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/check_user/' +user_name,
            success: function(response)
            {
                jQuery('#check_username').html(response);
            }
        });
    }
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
    $(document).ready(function() {
        if (typeof $.fn.select2 !== 'undefined') {
            $('.select2').css('width','350px').select2({allowClear:true});
            $('#select2-multiple-style .btn').on('click', function(e){
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                if(which == 2) $('.select2').addClass('tag-input-style');
                else $('.select2').removeClass('tag-input-style');
            });
        }
    });
</script>
              
