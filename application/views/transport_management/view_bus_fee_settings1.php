            <div class="table-responsive">
            <?php echo form_open_multipart('Transport_management/insert_bus_fee_installment', array('class' => 'form-horizontal','id'=>"myform"));?>
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														<th class="table-header">Sl No.</th>
                                                        <th class="table-header">Installment</th>
														<th class="table-header">Due Date</th>
                                                        <th class="table-header"></th>
                                                     </tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												  if(count($result)>0)
												  {
												  		foreach($result as $setting):?>
													<tr>
														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center><?php echo $setting['installment_name'];?></center></td>
                                                        <td><center>
														<input type="text" name="payment_date<?php echo $count; ?>" id="payment_date<?php echo $count; ?>"  class="col-xs-10 col-sm-9 due_date"  value="<?php echo date('d-m-Y',strtotime($setting['payment_date']));?>" /></center></td>
                                                        <td><input type="checkbox" name="bus_fee<?php echo $count; ?>" id="bus_fee<?php echo $count; ?>" value="<?php echo $setting['bus_fee_settings_id']; ?>" <?php if($setting['is_active']=='Y'){ echo "checked='checked' disabled"; } ?> onclick="return check_installment()"  /> </td>
                                                        <input type="hidden" name="bus_fee_settings_id<?php echo $count; ?>" id="bus_fee_settings_id<?php echo $count; ?>" value="<?php echo $setting['bus_fee_settings_id']; ?>" />

													</tr>

												<?php endforeach;?>
                                                <input type="hidden" name="count" id="count" value="<?php echo $count; ?>" />	
                                                <?php
												}
												else
													{
												?>
                                                <tr>
                                                	
                                                	<td colspan="7">
												<?php
													echo "<center>No records found!</center>";
												?>
                                                	</td>
                                                   
                                                </tr> 
                                               <?php
													}
												?>
                                                	
											</tbody>
            </table>
            <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" name="btnSubmit" id="btnSubmit"  value='Assign' > 
                       
						<?php echo form_close(); ?>					
										</div>
            <div id="msg_button" class="col-md-offset-2 col-md-9" style="color:#FF0000"></div>
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
	function get_bus(route_master_id) 
	{
	var id= route_master_id.name.substr(15);
   	$.ajax({
           url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id.value ,
          success: function(response)
          {
              jQuery('#bus_number'+id).html(response);
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
$( document ).ready(function() {
   $( "#btnSubmit" ).prop( "disabled", true );
   check_installment1();
});
function check_installment1()
{
	var count			=	jQuery('#count').val();
		var checked	=	0;
			
		for(var i=2;i<=count;i++)
		{
			
			if($('input[id=bus_fee'+i+']').prop('checked'))
			{
				checked++;
			}
		}
		
		if(checked > 0)
		{
			jQuery('#msg_button').html("Can not update.These settings are assigned to students");
			$( "#btnSubmit" ).prop( "disabled", true );
		}
}
function check_installment() 
	{
		var count		=	jQuery('#count').val();
		var checked		=	0;
		var disabled	=	0;
			
		for(var i=2;i<=count;i++)
		{
			
			if($('input[id=bus_fee'+i+']').prop('checked'))
			{
				checked++;
			}
			if($('input[id=bus_fee'+i+']').prop('disabled'))
			{
				disabled++;
			}
		}
		
		if(checked == 0)
		{
			alert("Please select atleast one checkbox");
			$( "#btnSubmit" ).prop( "disabled", true );
			jQuery('#msg_button').html("");
		}
		else if(disabled > 0)
		{
			$( "#btnSubmit" ).prop( "disabled", true );
		}
		else
		{
			$( "#btnSubmit" ).prop( "disabled", false );
		}
		/*else
		{
		
		
			$.ajax({
				url: '<?php // echo base_url();?>index.php/Transport_management/check_installment/' ,
				success: function(response)
				{
					jQuery('#msg_button').html(response);
				}
			});
		}*/
    }
	
	$(document).ready(function () {
        $('.due_date').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });

	
</script>