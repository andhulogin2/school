<?php $running_year = get_running_year(); ?>

<div class="table-responsive"> <?php echo form_open_multipart('Transport_management/reassign_students_to_bus/'.$branch_id."/".$academic_year, array('class' => 'form-horizontal','id'=>"myform"));?>
  <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
    <thead>
      <tr>
            <th class="table-header">Sl No.</th>
            <th class="table-header"><input type="checkbox" name="select_all" id="select_all" onclick="select_all_students();" /></th>
            <th class="table-header">Student Name</th>
            <th class="table-header">Admission No.</th>
            <th class="table-header">Route<br />
              <select  name="selected_route_master_id" id="selected_route_master_id"  class="col-xs-10 col-sm-9" onchange="get_bus1(this);get_pick_up1(this);change_bus_routes(this.value);check_checkbox();"  >
                <option value="">Select</option>
                <?php 
                                                                foreach($route_master as $route):
                                                                ?>
                <option value="<?php echo $route['route_master_id'];?>" ><?php echo $route['route_master_name'];?></option>
                <?php
                                                                endforeach;
                                                                ?>
              </select>
            </th>
            
            <th class="table-header">Bus No<br />
              <select name="sel_route_register_id" id="sel_route_register_id" onchange="check_checkbox();get_bus_seats(this);change_bus_no(this.value);" class="col-xs-10 col-sm-9"  >
                <option value="">Select</option>
              </select>
            </th>
            
            <th class="table-header">Pick-up Point<br />
              <select name="sel_pickup_point" id="sel_pickup_point"  class="col-xs-10 col-sm-9" onchange="change_pick_up(this.value);check_checkbox();"  >
                <option value="">Select</option>
              </select>
            </th>
            <th class="table-header">Charge</th>
      </tr>
    </thead>
    
    <tbody>
    <?php 
    $count = 1;
    if(!empty($students))
    {
        foreach($students as $student):
        $this->db->where('student_id',$student['student_id']);
        $bus_fee = $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();
        if(!empty($bus_fee)){
        $bus_fee_paid = 'y'; }
        else{ $bus_fee_paid = 'n';}
        
        $this->db->where('academic_year',$running_year);
        $this->db->where('student_id',$student['student_id']);
        $this->db->where('is_deleted','N');
        $this->db->group_by('student_id');
        $route1 = $this->db->get('tbl_transport_students_bus_fee_master')->row();
        //echo $this->db->last_query();
        ?>
          <tr id="row<?php echo $count; ?>">
                <td><center>
                    <?php echo $count++;?>
                  </center> <input type="hidden" value="<?php echo $route1->students_bus_fee_master_id; ?>" name="students_bus_fee_master_id<?php echo $count; ?>" /></td>
                  
                <td><input type="checkbox" name="student_id<?php echo $count; ?>" id="student_id<?php echo $count; ?>" value="<?php echo $student['student_id']; ?>" onclick="check_checkbox()" <?php //if($bus_fee_paid == 'y') { echo "disabled title='Fee Paid,can not reassign'";  } ?> />
                </td>
                
                <td><?php echo $student['name'];?></td>
                <td><?php echo $student['admission_number'];?></td>
                <td><center>
                    <select  name="route_master_id<?php echo $count; ?>" id="route_master_id<?php echo $count; ?>"  class="col-xs-10 col-sm-9" onchange="get_bus(this);get_pick_up(this);check_checkbox();"  >
                      <option value="">Select</option>
                      <?php 
                                                                    foreach($route_master as $route):
                                                                    ?>
                      <option value="<?php echo $route['route_master_id'];?>" <?php if(!empty($route1)){  if($route['route_master_id'] == $route1->route_master_id) { echo "selected"; } }  ?> ><?php echo $route['route_master_name'];?></option>
                      <?php
                                                                    endforeach;
                                                                    ?>
                    </select>
                  </center>
                  <hr />
                                <div id="msg_route_name<?php echo $count; ?>" style="color:#FF0000"></div>
                </td>
                
                <td><center>
                    <?php if(!empty($route1)){ 
                                    $bus_no = $this->db->get_where('view_transport_route_register' , array('route_master_id' => $route1->route_master_id,'is_deleted' => 'N'))->result_array(); //echo $this->db->last_query();?>
                    <select name="route_register_id<?php echo $count; ?>" id="route_register_id<?php echo $count; ?>" onchange="check_checkbox();" class="col-xs-10 col-sm-9"  >
                      <?php foreach($bus_no as $bus){ ?>
                      <option value="<?php echo $bus['route_register_id'];?>" <?php if($route1->route_register_id == $bus['route_register_id']) { echo "selected"; } ?>><?php echo $bus['bus_number'];?></option>
                      <?php } ?>
                    </select>
                    <?php  }
                                                                else { ?>
                    <select name="route_register_id<?php echo $count; ?>" id="route_register_id<?php echo $count; ?>" onchange="check_checkbox();" class="col-xs-10 col-sm-9"  >
                    </select>
                    <?php } ?>
                  </center>
                  <hr>
                                <div id="msg_bus<?php echo $count; ?>" style="color:#FF0000"></div>
    
                </td>
                
                <td><center>
                    <?php if(!empty($route1)){ 
                                    $pick_up= $this->db->get_where('view_transport_route_details' , array('route_master_id' => $route1->route_master_id,'is_deleted' => 'N'))->result_array(); ?>
                    <select name="pickup_point<?php echo $count; ?>" id="pickup_point<?php echo $count; ?>"  class="col-xs-10 col-sm-9" onchange="get_base_fare(this);check_checkbox();"  >
                      <?php foreach($pick_up as $p){ 
                                    ?>
                      <option value="<?php echo $p['route_details_id'];?>" <?php if($route1->route_details_id == $p['route_details_id']) { echo "selected"; } ?>><?php echo $p['pickup_point'];?></option>
                      <?php } ?>
                    </select>
                    <?php }
                                                                else { ?>
                    <select name="pickup_point<?php echo $count; ?>" id="pickup_point<?php echo $count; ?>"  class="col-xs-10 col-sm-9" onchange="get_base_fare(this);check_checkbox();"  >
                    </select>
                    <?php } ?>
                  </center>
                  <hr />
                  <div id="msg_pickup_point<?php echo $count; ?>" style="color:#FF0000"></div></td>
                  
                <td><center>
                    <?php if(!empty($route1)){ 
                                                  /*  $base_fare = $this->db->get_where('view_transport_route_details' , array('route_details_id' => $route1->route_details_id))->row()->base_fare; */
        ?>
                    <input type="text" name="base_fare<?php echo $count; ?>" id="base_fare<?php echo $count; ?>" value="<?php echo $route1->fee_amount; ?>"  class="col-xs-10 col-sm-9"    />
                    <?php  } 
                                                                else {?>
                    <input type="text" name="base_fare<?php echo $count; ?>" id="base_fare<?php echo $count; ?>" class="col-xs-10 col-sm-9"    />
                    <?php } ?>
                  </center></td>
                  
              </tr>
              <?php endforeach;?>
            <input type="hidden" name="count" id="count" value="<?php echo $count; ?>" />
            <?php
                                                        }
                                                    else
                                                        {
                                                    ?>
        <tr>
          <td colspan="7"><?php
                                                        echo "<center>No records found!</center>";
                                                    ?>
          </td>
    </tr>
    <?php
													}
												?>
    </tbody>
    
  </table>
  <?php 
            if(!empty($students))
			{
			?>
  <div class="col-md-offset-3 col-md-9">
    <input type="submit" class="btn btn-info" name="sub" id="sub" value='Assign' onclick="check_checkbox()">
    <?php 
			}
			echo form_close(); 
		?>
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
//  Checking student already assigned to bus on page load.
$( document ).ready(function() {
	var count = document.getElementById("count").value;
	count = Number(count);
	/*for(var i=2;i<=count;i++)
	{
	    
		$.ajax({
			url: '<?php echo base_url();?>index.php/Transport_management/check_student_exist/' + document.getElementById("student_id"+i).value ,
			async: false,
			success: function(response)
			{ 
				if(response == 1)
				{
					$( "#student_id"+i ).prop( "disabled", true );
					//alert($( "#student_id"+i ).prop( "disabled"));
					$( "#row"+(i-1) ).prop( "title", "This student is already assigned." );
				}
			  
			}
     	});

	}*/

});
function check_checkbox()
{
	var count = document.getElementById("count").value;
	count = Number(count);
	var checked_check_boxes = 0;
	var select_box_selected	= 0;
	for(var i=2;i<=count;i++)
	{
		
		if(document.getElementById("student_id"+i).checked)
		{
			
			checked_check_boxes++;
			var route_name 	 = document.getElementById("route_master_id"+i).value;
			var bus_number 	 = document.getElementById("route_register_id"+i).value;
			var pickup_point = document.getElementById("pickup_point"+i).value;
			if(route_name == '')
			{
				document.getElementById("msg_route_name"+i).innerHTML = "Please select route name";
				select_box_selected++;
			}
			else
			{
				$("#msg_route_name"+i).hide();
			}
			if(bus_number == '')
			{	
				document.getElementById("msg_bus"+i).innerHTML = "Please select bus number";
				select_box_selected++;
			}
			else
			{
//				$("#msg_bus"+i).html("");
				$("#msg_bus"+i).hide();
			}

			if(pickup_point == '')
			{
				document.getElementById("msg_pickup_point"+i).innerHTML = "Please select pickup point";
				select_box_selected++;
			}
			else
			{
				$("#msg_pickup_point"+i).hide();
			}
		}
		else
		{
				$("#msg_route_name"+i).hide();
				$("#msg_bus"+i).hide();
				$("#msg_pickup_point"+i).hide();
		}
	}
	if(checked_check_boxes == 0)
	{
		alert("Please select atleast one check box");
		document.getElementById("sub").disabled = true;
	}
	else if(select_box_selected > 0)
	{
		document.getElementById("sub").disabled = true;
	}
	else
	{
		document.getElementById("sub").disabled = false;
	}
}

function get_bus(route_master_id) 
	{ 
	var id= route_master_id.name.substr(15);
	$("#msg_bus"+id).html("");
	if(route_master_id.value!='')
	{
		$('#student_id'+id).prop('checked',true);
	}
	else
	{
		$('#student_id'+id).prop('checked',false);
	}
   	$.ajax({
           url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id.value ,
          success: function(response)
          {
              jQuery('#route_register_id'+id).html(response);
            }
     });
   }
function get_bus1(route_master_id) 
	{
   	$.ajax({
           url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id.value ,
          success: function(response)
          {
              jQuery('#sel_route_register_id').html(response);
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
function get_pick_up1(route_master_id) 
	{
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_pick_up/' + route_master_id.value ,
            success: function(response)
            {
			
                jQuery('#sel_pickup_point').html(response);
            }
        });
    }
	
function get_base_fare(pickup_point) 
	{
		var id= pickup_point.name.substr(12);
		//alert(route_master_id.value);
		if(pickup_point.value>0)
		{
		    document.getElementById("base_fare"+id).value = "";
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
		else
		{
		    document.getElementById("base_fare"+id).value = "";
		}
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
	
function select_all_students()
{
	var count = document.getElementById("count").value;
	count = Number(count);
	var select_all	=	document.getElementById("select_all");
	for(var i=2;i<=count;i++){
			if(select_all.checked==true)
			{
				document.getElementById("student_id"+i).checked	=	true;
			}
			else
			{
				document.getElementById("student_id"+i).checked	=	false;
			}
	}
}

function change_bus_routes(selected_route_master_id)
{
	var count = document.getElementById("count").value;
	count = Number(count);
	for(var k=2;k<=count;k++)
	{
		$("#route_master_id"+k).val("");
		$("#route_register_id"+k).val("");//alert($("#route_register_id"+k).val())
		$("#pickup_point"+k).val("");
		var route_master_id				=	document.getElementById("route_master_id"+k);
//		var route_master_id_val			=	route_master_id.value;
		for (var i = 0;  i < route_master_id.length; i++)
		{
					if(route_master_id[i].value ==  selected_route_master_id)
					{
						route_master_id[i].selected	=	true;
						get_bus(route_master_id);
						get_pick_up(route_master_id);
						break;
					}	
						
		}
	}
}

function change_bus_no(sel_route_register_id)
{
	var count = document.getElementById("count").value;
	count = Number(count);
	for(var k=2;k<=count;k++)
	{
		var route_register_id				=	document.getElementById("route_register_id"+k);
		for (var i = 0;  i < route_register_id.length; i++)
		{
					if(route_register_id[i].value ==  sel_route_register_id)
					{
						//alert(route_register_id[i].value);
						route_register_id[i].selected	=	true;
					}	
		}
	}
}

function change_pick_up(sel_pickup_point)
{
	var count = document.getElementById("count").value;
	count = Number(count);
	for(var k=2;k<=count;k++)
	{
		var pickup_point				=	document.getElementById("pickup_point"+k);
		for (var i = 0;  i < pickup_point.length; i++)
		{
					if(pickup_point[i].value ==  sel_pickup_point)
					{
						pickup_point[i].selected	=	true;
					get_base_fare(pickup_point);	
					}
		}
	}
}


</script>
