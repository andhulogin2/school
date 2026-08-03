<?php include_once APPPATH . 'views/main_head.php';?><body>
        
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
							<li class="active">Add Bulk Vehicle Route Register</li>
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
									 Vehicle Route Register
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_register/<?php echo $route_master_id; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

<!--                     			<?php 
                                   echo form_open_multipart('Transport_management/vehicle_route_register_add', array('class' => 'form-horizontal','id'=>"myform"));?>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch :<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
											
                                            <input type="text" value="<?php foreach($route_master as $route){ if($route['route_master_id']==$route_master_id) { echo $route['branch_name']; $branch_id=$route['branch_id']; }} ?>" class="col-xs-10 col-sm-5" readonly />
											<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_id; ?>" />
										</div>
									</div>
                                                                        
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Master Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" value="<?php foreach($route_master as $route){ if($route['route_master_id']==$route_master_id) { echo $route['route_master_name']; }} ?>" name="route_master_id" class="col-xs-10 col-sm-5" readonly />
											<input type="hidden" name="route_master_id" id="route_master_id" value="<?php echo $route_master_id; ?>" />
                                        </div>
									</div>
                                          <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus Number :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="vehicle_master_id" id="vehicle_master_id"  class="col-xs-10 col-sm-5" onChange="check_bus_number_by_route(this.value)" required >
										<option value="">Select</option>
                                        <?php foreach($vehicle_master as $vehicle_mastr)
										{ ?>
                                        <option value="<?php echo $vehicle_mastr['vehicle_master_id'] ?>"> <?php echo $vehicle_mastr['bus_number'] ?>
                                        </option>
                                        <?php } ?>
                                        </select>
                                        
                                        </div>
                                        <div class="col-sm-3"></div><div id="error_bus_number" class="col-sm-9" style="color:#FF0000"></div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Driver Name :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="driver_id" id="driver_id"  class="col-xs-10 col-sm-5" onChange="check_driver_by_route(this.value)"  >
										<option value="">Select</option>
                                        <?php foreach($driver as $driver1)
										{ ?>
                                        <option value="<?php echo $driver1['staff_id']; ?>"> <?php echo $driver1['name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
										</div>
                                        <div class="col-sm-3"></div><div id="error_driver" class="col-sm-9" style="color:#FF0000"></div>
									</div>
                                     <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Conductor Name :</label>

										<div class="col-sm-9">
											<select name="conductor_id" id="conductor_id"  class="col-xs-10 col-sm-5">
										<option value="">Select</option>
                                        <?php foreach($conductor as $conductor1)
										{ ?>
                                        <option value=" <?php echo $conductor1['staff_id'] ?>"> <?php echo $conductor1['name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
										</div>
									</div>

								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Cleaner Name :</label>
										<div class="col-sm-9">
											<select name="cleaner_id" id="cleaner_id"  class="col-xs-10 col-sm-5">
										<option value="">Select</option>
                                        <?php foreach($cleaner as $cleaner1)
										{ ?>
                                        <option value=" <?php echo $cleaner1['staff_id'] ?>"> <?php echo $cleaner1['name']; ?>
                                        </option>
                                        <?php } ?>
                                        </select>
										</div>
									</div>
                                      
									
                                   
									
                                    

									
									<div class="space-4"></div>

									
                                    
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" id="btnSubmit" class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                        
									</div>
                                    
-->                                 


	<?php echo form_open(base_url().'index.php/Transport_management/vehicle_route_register_add_bulk', array('class' => 'form-inline validate','method' => 'POST'));?>							
	<div class="row">                                      
        <div class="col-md-offset-3 col-md-4" style="text-align:center">
            <input type="text" value="<?php foreach($route_master as $route){ if($route['route_master_id']==$route_master_id) { echo $route['route_master_name']; }} ?>" name="route_master_id" class="col-md-12" readonly />
            <input type="hidden" value="<?php foreach($route_master as $route){ if($route['route_master_id']==$route_master_id) { echo $route['branch_name']; $branch_id=$route['branch_id']; }} ?>" class="col-xs-10 col-sm-5" readonly />
            <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch_id; ?>" />
            <input type="hidden" name="route_master_id" id="route_master_id" value="<?php echo $route_master_id; ?>"  >                        
            </div>
        </div>           
                 
	<div class="col-md-12" style="padding-top:20px;">										
        <div id="bulk_add_form">
            <div id="student_entry">
                <div class="row" style="margin-bottom:10px;">
                	<div class="col-md-3">
                        <select name="vehicle_master_id[]" id="vehicle_master_id"  class="col-md-12" style="width:100%;" onChange="check_bus_number_by_route(this.value)" required >
                            <option value="">Select Bus Number</option>
                            <?php foreach($vehicle_master as $vehicle_mastr)
                            { ?>
                            <option value="<?php echo $vehicle_mastr['vehicle_master_id'] ?>"> <?php echo $vehicle_mastr['bus_number'] ?></option>
                            <?php } ?>
                        </select>
                	</div>
                	<div class="col-md-3">
                        <select name="driver_id[]" id="driver_id"  class="col-md-12" onChange="check_driver_by_route(this.value)"  >
                            <option value="">Select Driver</option>
                            <?php foreach($driver as $driver1)
                            { ?>
                            <option value="<?php echo $driver1['staff_id']; ?>"> <?php echo $driver1['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                	</div>
                    
                	<div class="col-md-3">
                        <select name="conductor_id[]" id="conductor_id"  class="col-md-12">
                            <option value="">Select Conductor</option>
                            <?php foreach($conductor as $conductor1)
                            { ?>
                            <option value=" <?php echo $conductor1['staff_id'] ?>"> <?php echo $conductor1['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                	</div>
                	<div class="col-md-2">
                        <select name="cleaner_id[]" id="cleaner_id"  class="col-md-12">
                            <option value="">Select Cleaner</option>
                            <?php foreach($cleaner as $cleaner1)
                            { ?>
                            <option value=" <?php echo $cleaner1['staff_id'] ?>"> <?php echo $cleaner1['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                	</div>
                    <div class="col-md-1">
                        <div class="form-group" style="padding:1%;">
                            <button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>" onClick="deleteParentElement(this)" style="margin-left: 10px;">
                                <i class="fa fa-trash-o" style="color: #fff;"></i>
                            </button>
                        </div>
                	</div>
                </div>
            
            </div>
        
        
        	<div id="student_entry_append"></div>
        	<br>
        
            <div class="row">
                <center>
                    <button type="button" class="btn btn-info" onClick="append_student_entry()">
                        <i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
                    </button>
                </center>
            </div>
        
        	<br><br>
            <div class="row">
                <center>
                    <input type="submit" class="btn btn-success" id="btnSubmit" name="submit_button" value="Save">
                </center>
            </div>
            <?php echo form_close();?> 
            
             
            <div class="hr hr32 hr-dotted"></div>
            <div></div>
        </div>
	</div>                                             



									</div>
                                    </div>
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
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();
		for ($i = 0; $i<4;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});
	function append_student_entry()
	{
	//alert("xzfd");
		$("#student_entry_append").append(blank_student_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode.parentNode);
	}
	
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
	function check_bus_number_by_route(vehicle_master_id) 
	{
	//alert(vehicle_master_id);
		var branch_id 			= document.getElementById("branch_id").value;
		var route_master_id 	= document.getElementById("route_master_id").value;
		var vehicle_mastr_id	= vehicle_master_id;
		//alert(vehicle_mastr_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/check_bus_number_by_route/' + branch_id + '/' + route_master_id + '/' + vehicle_master_id ,
            success: function(response)
            {
				if(response=="1")
				{
					alert("Bus number alredy exist in this route.");
					$("#btnSubmit" ).prop( "disabled", true );
				}
				else
				{
					$("#btnSubmit" ).prop( "disabled", false );
				}
            }
        });
    }
	
	function check_driver_by_route(driver_id) 
	{
		var branch_id 			= document.getElementById("branch_id").value;
		var route_master_id 	= document.getElementById("route_master_id").value;
		var driver_id			= driver_id;
		
		//alert(vehicle_mastr_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/check_driver_by_route/' + branch_id + '/' + route_master_id + '/' + driver_id ,
            success: function(response)
            {
				//alert(response);
                jQuery('#error_driver').html(response);
            }
        });
    }
	

	
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

		