<?php $running_year = get_running_year(); ?>
            <div class="table-responsive">
            <?php echo form_open_multipart('Transport_management/reassign_students_to_bus', array('class' => 'form-horizontal','id'=>"myform"));?>
            <?php $ids = serialize($checked_master_ids); $ids = rawurlencode($ids); ?> <!-- We want to pass array to hidden field. So the array is serialized. -->
            
            <input type="hidden" name="checked_master_ids" id="checked_master_ids" value="<?php echo $ids; ?>" />
            
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
                                                        <th class="table-header">Route</th>
                                                        <th class="table-header">Bus No</th>
                                                        <th class="table-header">Pick-up Point</th>
                                                         <th class="table-header">Charge</th>
                                                     	</tr>
												</thead>
             
             <tbody>
													<tr>
														
														
                                                     <td align="center" style="padding-left:10px;padding-right:0px;" >
													<select name="route_master_id" id="route_master_id" class="col-xs-10 col-sm-11" onchange="get_bus(this);get_pick_up(this);check_select_box();">
                                                        	<option value="">Select</option>
                                                            <?php 
															foreach($route_master as $route):
															?>
                                                            <option value="<?php echo $route['route_master_id'];?>"><?php echo $route['route_master_name'];?></option>
                                                            <?php
															endforeach;
															?>
                                                        </select>
														
                                                        <br /><br />
                                                        <div id="msg_route_name" style="color:#FF0000"></div>
                                                        </td>
														
                                                        <td><center>
					<select name="route_register_id" id="route_register_id" onchange="get_bus_seats(this);check_select_box();" class="col-xs-10 col-sm-9"  >
                                                        	
                                                        </select>
														</center>
                                                        <br /><br />
                                                        <div id="msg_bus" style="color:#FF0000"></div>
                                                        <div id="msg_bus1" style="color:#FF0000"></div>
                                                        </td>
														
                                                        <td><center>
														<select name="pickup_point" id="pickup_point"  class="col-xs-10 col-sm-9" onchange="get_base_fare(this);check_select_box();"  >
                                                        	
                                                          
                                                        </select>
														</center>
                                                       <br /><br />
                                                        <div id="msg_pickup_point" style="color:#FF0000"></div>
                                                        </td>
                                                        
                                                        <td><center>
														<input type="text" name="base_fare" id="base_fare"  class="col-xs-10 col-sm-9"   readonly="readonly" />
														</center></td>
														
                                                        
													</tr>
													<tr>
                                                    	<td colspan="5" align="center">
                                                        	<input type="submit" class="btn btn-info" name="sub" id="sub" value='Assign' onclick="check_select_box()">     
                                                        </td>
                                                    </tr>

                                                	
											</tbody>
            </table>
            <div class="col-md-offset-3 col-md-9">
                        
						<?php echo form_close(); ?>					
										</div>
            </div>
                   
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="Inserted")
{
echo "<script>toastr.success('". "Vehicle maker name inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "The name already exists...', 'Duplicate', {timeOut: 5000})</script>";
}
else if($action=="Updated")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="Not updated")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}
else if($action=="Deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="Failed")
{
echo "<script>toastr.error('". "Not deleted...', 'Not deleted', {timeOut: 5000})</script>";
}

?>
<script type="text/javascript">
function check_select_box()
{
	if(document.getElementById("route_master_id").value == '')
	{
		document.getElementById("msg_route_name").innerHTML = "Please select route name";
		document.getElementById("sub").disabled = true;
	}
	else
	{
		$("#msg_route_name").hide();
		document.getElementById("sub").disabled = false;
	}
	if(document.getElementById("route_register_id").value == '')
	{
		document.getElementById("msg_bus1").innerHTML = "Please select bus number";
		document.getElementById("sub").disabled = true;
	}
	else
	{
		$("#msg_bus1").hide();
		document.getElementById("sub").disabled = false;
	}
	if(document.getElementById("pickup_point").value == '')
	{
		document.getElementById("msg_pickup_point").innerHTML = "Please select pickup point";
		document.getElementById("sub").disabled = true;
	}
	else
	{
		$("#msg_pickup_point").hide();
		document.getElementById("sub").disabled = false;
	}
}

	function get_bus(route_master_id) 
	{
	var id= route_master_id.name.substr(15);
	$("#msg_bus"+id).html("");
   	$.ajax({
           url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id.value ,
          success: function(response)
          {
              jQuery('#route_register_id'+id).html(response);
            }
     });
   }
	
function get_pick_up(route_master_id) 
	{
		var id= route_master_id.name.substr(15);
		//alert(route_master_id.value);
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_pick_up/' + route_master_id.value ,
            success: function(response)
            {
			
                jQuery('#pickup_point'+id).html(response);
            }
        });
    }
	
function get_base_fare(pickup_point) 
	{
		var id= pickup_point.name.substr(12);
		//alert(route_master_id.value);
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_base_fare/' + pickup_point.value ,
            success: function(response)
            {
			//alert(response);
				document.getElementById("base_fare"+id).value = response;
                //jQuery('#base_fare'+id).val(response) ;
            }
        });
    }
function get_bus_seats(route_register_id) 
	{
		var id= route_register_id.name.substr(17);
		$("#msg_bus"+id).show();
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus_seats/' + route_register_id.value ,
            success: function(response)
            {
            	jQuery('#msg_bus'+id).html(response);
            }
        });
    }
</script>