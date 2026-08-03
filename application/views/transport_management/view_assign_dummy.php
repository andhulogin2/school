<?php $running_year = get_running_year(); ?>
            <div class="table-responsive">
            <?php echo form_open_multipart('Transport_management/assign_dummy', array('class' => 'form-horizontal','id'=>"myform"));?>
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th class="table-header">Sl No.</th>
														<th class="table-header">Student Name</th>
                                                        <th class="table-header">Route</th>
                                                        <th class="table-header">Bus No</th>
                                                        <th class="table-header">Pick-up Point</th>
                                                         <th class="table-header">Charge</th>
                                                     	</tr>
												</thead>
             
             <tbody>
                                                 <?php 
												  $count = 1;
												  if(count($students)>0)
												  {
												  		foreach($students as $student):?>
													<tr>
														
														
														<td><center>
															<?php echo $count++;?>
														</center></td>
														<td><center></center></td>
														
                                                        <td><center></center></td>
														
                                                        <td><center></center></td>
														
                                                        <td><center></center></td>
                                                        
                                                        <td><center></center></td>
														
                                                        
														
														
														

<!--                                                        <td >	
                    										
																

								<a href="<?php // echo base_url();?>index.php/admin/add_branch_users/<?php //echo $branch['branch_id']?>" class="btn-sm btn-icon icon-left">
                            <i class="fa fa-user text-info"></i>
                    </a>	
                    
                    
                   				
                                                               
															</div>

															
														</td>  -->
                                                        
													</tr>

												<?php endforeach;?>	
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
                        <input type="button" class="btn btn-info"  value='Assign' > 
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
	
	
</script>