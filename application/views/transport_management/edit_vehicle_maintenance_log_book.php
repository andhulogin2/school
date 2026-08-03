<?php include_once APPPATH . 'views/main_head.php';?><body>
<?php 
foreach($maintenance_log as $log):

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
							<li class="active">Edit Vehicle Maintenance Log</li>
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
								
								 Edit
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Vehicle Maintenance Log
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_maintenance_log_book/<?php echo $log['vehicle_master_id']; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
						<div></div>
                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_maintenance_log_book_update/'.$maintenance_log_book_id, array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number :</label>
										<div class="col-sm-9">
                                        	<input type="hidden" name="vehicle_master_id" id="vehicle_master_id" value="<?php echo $log['vehicle_master_id'];?>" />
											<select name="vehicle_master_name" class="select2" id="vehicle_master_name" >
                              					<option value="">Select</option>
                              <?php 
							  foreach ($vehicle_master as $master)
							  				{
							  
											   ?>
                                               <option value="<?php echo $master['vehicle_master_id'];?>" <?php if($master['vehicle_master_id'] == $log['vehicle_master_id']){ ?> selected <?php } ?>><?php echo $master['vehicle_registration_number']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Entry :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="date_of_entry" placeholder="Date of Entry" class="col-xs-10 col-sm-5" name="date_of_entry" value="<?php echo date('d-m-Y',strtotime($log['date_of_entry'])); ?>" required />
										</div>
									</div>

                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Maintenance Work Done :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="maintenance_work_done" placeholder="Maintenance Work Done" class="col-xs-10 col-sm-5" name="maintenance_work_done" value="<?php echo $log['maintenance_work_done']; ?>" required />
										</div>
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Maintenance Work Done From :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="maintenance_work_done_from" placeholder="Maintenance Work Done From" class="col-xs-10 col-sm-5" name="maintenance_work_done_from" value="<?php echo $log['maintenance_work_done_from']; ?>" required />
										</div>
									</div>
                                    
									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Maintenance Work Cost:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="maintenance_work_cost" name="maintenance_work_cost" onkeyUp="allDecimals(this)" placeholder="Maintenance Work Cost" class="col-xs-10 col-sm-5" value="<?php echo $log['maintenance_work_cost']; ?>" required />
											
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Driver :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
										<select id="driver_id" name="driver_id" class="select2" required >
                                        	<option value="">Select</option>
                                            <?php
											foreach($driver as $driver1):
											?>
                                            <option value="<?php echo $driver1['employee_master_id']; ?>"<?php if($log['driver_id']==$driver1['employee_master_id']){ echo "selected"; } ?>><?php echo $driver1['first_name']." ".$driver1['last_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
											
										</div>
									</div>
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit'> 
											
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
	function allDecimals(maintenance_work_cost)
		{ 
		
		var number = (maintenance_work_cost.value.match(/^-?\d*(\.\d+)?$/));
		if(maintenance_work_cost.value.match(number))
		{
		return true;
		}
		else
		{
		alert('it must have numbers only');
		uname.focus();
		return false;
		}
		} 
	  
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
