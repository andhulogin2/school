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
							<li class="active">Add Vehicle Route Details</li>
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
									 Vehicle Route Details
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php //$cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_details/<?php echo $route_master_id; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_route_details_add', array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                   <!-- <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number :</label>

										<div class="col-sm-9">
											<input type="text"  class="col-xs-10 col-sm-5" id="route_master_id" class="col-xs-10 col-sm-5" />
                              					
										</div>
									</div>
 -->
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Name:</label>

										<div class="col-sm-9">
											<input type="text" class="col-xs-10 col-sm-5" value="<?php foreach ($master as $master_type){ if($master_type['route_master_id']==$route_master_id){ echo $master_type['route_master_name']; } } ?>" readonly >
									
											<input type="hidden" name="route_master_id" id="route_master_id" value="<?php echo $route_master_id; ?>"  >                        
                                        </div>
									</div>
                                    
                                    
                                   
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pick Up Point :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="pickup_point" placeholder="Pick Up Point" class="col-xs-10 col-sm-5" name="pickup_point" onKeyUp="check_pickup_point()" required />
										</div>
                                        <div class="col-sm-3"></div> <div id="error_pickup_point" class="col-xs-10 col-sm-5" style="color:red;"></div>
									</div>

								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pick Up Point Lattitude :</label>
										<div class="col-sm-9">
											<input type="text" id="pickup_point_lattitude" placeholder="Pick Up Point Lattitude" class="col-xs-10 col-sm-5" name="pickup_point_lattitude" />
										</div>
									</div>
                                      
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pick Up Point Longitude: </label>
										<div class="col-sm-9">
											<input type="text" id="pickup_point_longitude" name="pickup_point_longitude" placeholder="Pick Up Point Longitude"  class="col-xs-10 col-sm-5"  name="pickup_point_longitude" /> 
                                           
										</div>
									</div>
                                   
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Distance:<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
											<input type="text" id="distance" name="distance" placeholder="Distance"  class="col-xs-10 col-sm-5"  name="distance" required /> 
                                           
										</div>
									</div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Base Fare:<font color="#FF0000">*</font> </label>
										<div class="col-sm-9">
											<input type="text" id="base_fare" placeholder="Base Fare"   class="col-xs-10 col-sm-5"  name="base_fare" required />
                                           
										</div>
									</div>
                                    

									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									
                                    
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" id="btnSubmit" type="button" value='Submit' >  
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </div></body>
                                  
			<?php include_once APPPATH . 'views/footer.php'; ?>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function check_pickup_point() 
	{
		var pickup_point	 = document.getElementById("pickup_point").value;
		var route_master_id	 = document.getElementById("route_master_id").value;
		//alert(route_master_id+pickup_point);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/check_pickup_point/' + pickup_point + '/'+ route_master_id ,
            success: function(response)
            {
				if(response=='1')
				{
					$( "#btnSubmit" ).prop( "disabled", true );
					jQuery('#error_pickup_point').html("Pickup Point alredy exist.");
				}
				if(response=='0')
				{
					$( "#btnSubmit" ).prop( "disabled", false );
					jQuery('#error_pickup_point').html("");
				}
                
            }
        });
    }

</script> 	 

		