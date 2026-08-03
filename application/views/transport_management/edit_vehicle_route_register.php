<?php include_once APPPATH . 'views/main_head.php';?><body>
<?php
	foreach($route_register as $log):
	endforeach;
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
							<li class="active">Edit Route Register</li>
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
								TRANSPORTATION
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Edit Route Register
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_register/<?php echo $log[route_master_id]; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
						<div></div>
                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_route_register_update/'.$route_register_id, array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                
                                	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch :<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
                                           
                                            <input type="text" value="<?php foreach($route_master as $route){ if($route['route_master_id']==$route_master_id) { echo $route['branch_name']; $branch_id=$route['branch_id']; }} ?>"  class="col-xs-10 col-sm-5" readonly />
											<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_id; ?>" />
											
										</div>
									</div>
								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Master Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" value="<?php foreach($route_master as $route){ if($route['route_master_id']==$log['route_master_id']) { echo $route['route_master_name']; }} ?>" name="route_master_id" id="route_master_id"  class="col-xs-10 col-sm-5" readonly />
											<input type="hidden" name="route_master_id" id="route_master_id" value="<?php echo $log['route_master_id']; ?>" />
                                        </div>
									</div>
                                          <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus Number :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="vehicle_master_id" id="vehicle_master_id"  class="select2" required >
										<option value="">Select</option>
                                        <?php foreach($vehicle_master as $vehicle_mastr)
										{ ?>
                                        <option value=" <?php echo $vehicle_mastr['vehicle_master_id'] ?>" <?php if($vehicle_mastr['vehicle_master_id']==$log['vehicle_master_id']){?>selected<?php } ?>> <?php echo $vehicle_mastr['bus_number'] ?>
                                        </option>
                                        <?php } ?>
                                        </select>
                                        
                                        </div>
									</div>
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Driver Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
												<select name="driver_id" id="driver_id"  class="select2" required >
										<option value="">Select</option>
                                        <?php foreach($driver as $driver1)
										{ ?>
                                        <option value=" <?php echo $driver1['staff_id'] ?>" <?php if($driver1['staff_id']==$log['driver_id']){?>selected<?php } ?>> <?php echo $driver1['name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Conductor Number :</label>

										<div class="col-sm-9">
										<select name="conductor_id" id="conductor_id"  class="select2">
										<option value="">Select</option>
                                        <?php foreach($conductor as $conductor1)
										{ ?>
                                        <option value=" <?php echo $conductor1['staff_id'] ?>"<?php if($conductor1['staff_id']==$log['conductor_id']){?>selected<?php } ?>> <?php echo $conductor1['name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
										</div>
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Cleaner Name :</label>

										<div class="col-sm-9">
											<select name="cleaner_id" id="cleaner_id"  class="select2">
										<option value="">Select</option>
                                        <?php foreach($cleaner as $cleaner1)
										{ ?>
                                        <option value=" <?php echo $cleaner1['staff_id'] ?>"<?php if($cleaner1['staff_id']==$log['cleaner_id']){?>selected<?php } ?>> <?php echo $cleaner1['name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
										</div>
									</div>
                                    
									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									
                                    
                                                                      
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit' > 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    
                                     
                                    <?php  echo form_close(); ?>
                                    </div></body>
                                  
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
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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

?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
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
/*	function get_branch(role) 
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
	if(role==4)
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
	
*/
	
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 	 
<script type="text/javascript">
    $(document).ready(function () {
        $('#date_of_entry').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
 </script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>   
