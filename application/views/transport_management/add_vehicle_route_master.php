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
							<li class="active">Add Vehicle Route Master</li>
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
									 Vehicle Route Master
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_master" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_route_master_add', array('class' => 'form-horizontal','id'=>"myform"));?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch: <font color="#FF0000">*</font></label>
										<div class="col-sm-9">
										    <?php
										    $role               =   $this->session->userdata('role');
										    if($role==1 || $role==2)
										    {
										    ?>
											<select name="branch_id" id="branch_id" name="branch_id" class="select2" required >
                                            
                                                <option value="">Select</option>
                                            <?php foreach($branch as $branch_type)
											{
											?>
                                            <option value= "<?php echo $branch_type['branch_id'] ?>"><?php echo $branch_type['branch_name'] ?>
                                             </option>
                                            <?php }
											?>
                                            </select>
                                            <?php
										    }
										    else
										    {
									            $branch_id  =   $this->session->userdata('branch_id');
										        foreach($branch as $branch1):
										            if($branch1['branch_id']==$branch_id):
                                            ?>
                                            <input type="text" class="col-xs-10 col-sm-5" name="branch" id="branch" value="<?php echo $branch1['branch_name'] ?>" disabled >
                                            <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $branch1['branch_id'] ?>"  >
                                            <?php
                                                    endif;
                                                endforeach;
										    }
                                            ?>
										</div>
                                        <p id="one"></p>
									</div>                                    
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Name:<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="route_master_name" placeholder="Route master name" class="col-xs-10 col-sm-5" name="route_master_name"  required onKeyUp="check_route_name()" />
										</div>
                                       <div class="col-sm-3"></div> <div id="error_route_name" class="col-xs-10 col-sm-5" style="color:red;"></div>
                                        
									</div>
                                     <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Number :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<input type="text" id="route_number" placeholder="Route number" class="col-xs-10 col-sm-5" name="route_number" onKeyUp="check_route_number()"  required />
										</div>
                                        <div class="col-sm-3"></div> <div id="error_route_number" class="col-xs-10 col-sm-5" style="color:red;"></div>
									</div>
									
								
                                    <div class="form-group" >
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Route Description :</label>
										<div class="col-sm-9">
											<input type="text" id="route_description" placeholder="Route description" class="col-xs-10 col-sm-5"                                           name="route_description" />
										</div>
									</div>
                                      
									<!-- /section:elements.form -->
									
									<div class="space-4"></div>

									
                                    
                                     
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Submit' id="btnSubmit" > 
											
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
	function check_route_name() 
	{
	//$( "#btnSubmit" ).prop( "disabled", true );
		var route_master_name = document.getElementById("route_master_name").value;
		var branch_id	 	  = document.getElementById("branch_id").value;
		if(branch_id=='')
		{
		alert("Please select branch first");
		document.getElementById("branch_id").focus();
		document.getElementById("route_master_name").value = '';
		}
		//alert(route_master_name);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/check_route_name/' + route_master_name + '/'+ branch_id  ,
            success: function(response)
            {
                jQuery('#error_route_name').html(response);
            }
        });
		/*if(document.getElementById("error_route_name").innerHTML != '')
		{
			$( "#btnSubmit" ).prop( "disabled", true );
		}*/

    }
	function check_route_number() 
	{
	//$( "#btnSubmit" ).prop( "disabled", true );
		var route_number = document.getElementById("route_number").value;
		var branch_id	 = document.getElementById("branch_id").value;
		if(branch_id=='')
		{
		alert("Please select branch first");
		document.getElementById("branch_id").focus();
		document.getElementById("route_number").value = '';
		}

		//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/check_route_number/' + route_number + '/'+ branch_id ,
            success: function(response)
            {
                jQuery('#error_route_number').html(response);
            }
        });
		/*if(document.getElementById("error_route_number").innerHTML != '')
		{
			$( "#btnSubmit" ).prop( "disabled", true );
		}*/
    }
	
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 	 
<script type="text/javascript">

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
