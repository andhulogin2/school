<?php include_once APPPATH . 'views/main_head.php';?><body>
<?php
foreach($route_details as $log):
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
							<li class="active">Edit Route Details</li>
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
									Edit Route Details
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_details/<?php echo $log['route_master_id']; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
						<div></div>
                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_route_details_update/'.$route_details_id, array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    <div class="form-group" >
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Name:</label>

										<div class="col-sm-9">
										<input type="text" class="col-xs-10 col-sm-5" value="<?php foreach ($master as $master_type){ if($master_type['route_master_id']==$log['route_master_id']){ echo $master_type['route_master_name']; } } ?>" readonly >
									
								<input type="hidden" name="route_master_id" id="route_master_id" value="<?php echo $log['route_master_id']; ?>" >
									
 
 										</div>
									</div>
                                    
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pickup Point  :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="pickup_point" placeholder="Pickup Point" class="col-xs-10 col-sm-5" name="pickup_point" value="<?php echo $log['pickup_point']; ?>"  required />
										</div>
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pickup Point Lattitude :</label>

										<div class="col-sm-9">
											<input type="text" id="pickup_point_lattitude" placeholder="Pickup Point Lattitude " class="col-xs-10 col-sm-5" name="pickup_point_lattitude" value="<?php echo $log['pickup_point_lattitude']; ?>"/>
										</div>
									</div>
                                    
									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Pickup Point Longitude: </label>
										<div class="col-sm-9">
                                            <input type="text" class="col-xs-10 col-sm-5" id="pickup_point_longitude" name="pickup_point_longitude" value="<?php echo $log['pickup_point_longitude']; ?>">
	                                            
											
										</div>
									</div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Distance:<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
                                            <input type="text" class="col-xs-10 col-sm-5" id="distance" placeholder="Distance" name="distance"  value="<?php echo $log['distance']; ?>" required />
	                                            
											
										</div>
									</div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Base Fare:<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
                                            <input type="text" class="col-xs-10 col-sm-5" id="base_fare" placeholder="Base Fare" name="base_fare" value="<?php echo $log['base_fare']; ?>" required />
	                                            
											
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
 </script>

		