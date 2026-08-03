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
							<li class="active">Add Vehicle Insurance Details</li>
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
								Transportation
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Vehicle Insurance Details
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_insurance_details/<?php echo $vehicle_master_id; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_insurance_details_add', array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Registration Number :</label>

										<div class="col-sm-9">
                                        	<input type="hidden" id="vehicle_master_id" name="vehicle_master_id" value="<?php echo $vehicle_master_id; ?>" />
											<select name="vehicle_master_name" class="col-xs-10 col-sm-5" id="vehicle_master_name" disabled >
                              					<option value="">Select</option>
                              						<?php 
							 	 					foreach ($vehicle_master as $master)
							  				{
							  
											   ?>
                                               <option value="<?php echo $master['vehicle_master_id']?>"<?php if($master['vehicle_master_id']==$vehicle_master_id){ echo "selected"; } ?>><?php echo $master['vehicle_registration_number']; ?></option>
                                               <?php
											}
											   ?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Insurance Policy Number:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="insurance_policy_number" placeholder="Insurance Policy Number" class="col-xs-10 col-sm-5" name="insurance_policy_number" required />
										</div>
									</div>

                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Insurance Date From:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="insurance_date_from" placeholder="Insurance Date From" class="col-xs-10 col-sm-5" name="insurance_date_from" required />
										</div>
									</div>
								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Insurance Date To:<font color="#FF0000">*</font></label>
										<div class="col-sm-9">
											<input type="text" id="insurance_date_to" placeholder="Insurance Date To" class="col-xs-10 col-sm-5" name="insurance_date_to" required />
										</div>
									</div>
                                      
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Insurance Amount:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="insurance_amount" placeholder="Insurance Amount" onkeyUp="allDecimals(this)" class="col-xs-10 col-sm-5" name="insurance_amount" required />
										</div>
									</div>
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Insurance Type:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="insurance_type" placeholder="Insurance Type" class="col-xs-10 col-sm-5" name="insurance_type" required />
										</div>
									</div>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Insurance Company:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="insurance_company" placeholder="Insurance Company" class="col-xs-10 col-sm-5" name="insurance_company" required />
										</div>
									</div>
                                    

									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									
                                    
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
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
        $('#insurance_date_from').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
    $(document).ready(function () {
        $('#insurance_date_to').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
	 
	 function allDecimals(insurance_amount)
		{ 
		
	    var decimal = /^[0-9.]+$/; 
		if(insurance_amount.value.match(decimal))
		{
		return true;
		}
		else
		{
		alert('it must have numbers only');
		insurance_amount.focus();
		return false;
		}
		}  
	 
	 
 </script>

		