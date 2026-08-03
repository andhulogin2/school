<body>
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
<?php echo form_open(base_url() . 'index.php/Transport_management/get_bus_fee_all_in_one',array('class'=>'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>
					

 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                       <?php  $role=$this->session->userdata('role');
if($role>0)
{?>
		<div class="table-responsive">
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                <thead>
                    <tr>
                        <th style="width:130px"><center>Branch</center></th>
                        <th style="width:130px"><center>Route</center></th>
                        <th style="width:130px"><center>Bus Number</center></th>
                        <th style="width:130px"><center>Pickup Point</center></th>
                        <th style="width:130px"><center>Receipt Number</center></th>
                        <th style="width:160px"><center>Due Date From</center></th>
                        <th style="width:160px"><center>Due Date To</center></th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <center>
                            <select name="branch_id" class="" style="width:100%" id="branch_id" required >
                                <option value="">Select</option>
                                    <?php 
                                    foreach ($branch as $branch1)
                                    {
                                        ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                                    <?php 
                                    }
                                    ?>
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="route_master_id" style="width:100%" class="col-xs-10 col-sm-5" id="route_master_id"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="route_register_id" style="width:100%" class="col-xs-10 col-sm-5" id="route_register_id"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="route_details_id" style="width:100%" class="col-xs-10 col-sm-5" id="route_details_id"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="receipt_number" class="" style="width:100%" id="receipt_number" required >

                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <input type="text" name="due_date_from" style="width:100%" class="col-xs-10 col-sm-5 datepick" id="due_date_from" >
                            </center>
                        </td>
                        <td>
                            <center>
                            <input type="text" name="due_date_to" style="width:100%" class="col-xs-10 col-sm-5 datepick" id="due_date_to" >
                            </center>
                        </td>
                    </tr>
                </tbody>
             </table>
			 <table id="simple-table" class="table table-striped table-bordered table-hover" >
                <thead>
                    <tr>
                        <th style="width:130px"><center>Installment</center></th>
                        <th style="width:130px"><center>Department</center></th>
                        <th style="width:130px"><center>Class</center></th>
                        <th style="width:130px"><center>Section</center></th>
                        <th style="width:130px"><center>Student</center></th>
                        <th style="width:160px"><center>Paid Date From</center></th>
                        <th style="width:160px"><center>Paid Date To</center></th>
                   </tr>
                </thead>
                <tbody>
                	<tr>
                        <td>
                            <center>
                            <select name="bus_fee_settings_id" style="width:100%" class="col-xs-10 col-sm-5" id="bus_fee_settings_id"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="department_id" style="width:100%" class="col-xs-10 col-sm-5" id="department_id"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="class_id" style="width:100%" class="col-xs-10 col-sm-5" id="class_id"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="section_id" style="width:100%" class="col-xs-10 col-sm-5" id="section_id" >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="student_id" style="width:100%" class="col-xs-10 col-sm-5" id="student_id" >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <input type="text" name="paid_date_from" style="width:100%" class="col-md-10 col-md-6 datepick" id="paid_date_from" >
                            </center>
                        </td>
                        <td>
                            <center>
                            <input type="text" name="paid_date_to" style="width:100%" class="col-xs-10 col-sm-5 datepick" id="paid_date_to" >
                            </center>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="3">
                        	<input type="checkbox" name="payment" class="payment_filter" value="1" /> Students Paid After Due Date 
                        </td>
                    	<td colspan="4">
                        	<input type="checkbox" name="payment" class="payment_filter" value="2" /> Students not paid and due date is over 
                        </td>
                    </tr>
                </tbody>
               </table>
               <div style="text-align:center"><button type="button" class="btn btn-info" id="btnSubmit">Show Report</button></div>
               </div>                     
                                    
                                    <?php }} ?>
                                    
                                    
                                   <?php /*  if($role==3){?>
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bus :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="bus_number" class="col-xs-10 col-sm-5" id="bus_number" required >
                              					<option value="">Select</option>
                          						<?php 
												foreach($bus as $bus1):
												?>
                                                <option value="<?php echo $bus1['bus_number'] ?>"><?php echo $bus1['bus_number'] ?></option>
                                                <?php 
												endforeach;
												?>
                          					</select>
										</div>
									</div>
                                    <?php } */?>
                                    
<?php echo form_close();?>
                        </div>
                        <div id="report" style="text-align:center">
                        
                        </div>
                        </div></div></body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>  
<script type="text/javascript">
  
$(document).ready(function(){
	var $j = jQuery.noConflict();
	$j('.datepick').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
	})    
	$( "#btnSubmit" ).prop("disabled",true);
	$( "#td_btn" ).attr("title","Please select branch");
    $( "#branch_id" ).change(function() {
		if($( "#branch_id" ).val() != '')
		{
			$( "#btnSubmit" ).prop("disabled",false);
			$( "#td_btn" ).attr("title","");
		}
		else
		{
			$( "#btnSubmit" ).prop("disabled",true);
			$( "#td_btn" ).attr("title","Please select branch");
		}
		get_route();
		get_bus();
		get_pickup();
		get_receipt_number();
		get_department();
		get_class1();
		get_section();
		get_student(); 
		get_installment_by_branch();
    });
    $( "#route_master_id" ).change(function() {
		get_bus_by_route();
		get_pickup_by_route();
		get_receipt_number_by_route();
		get_student_by_route();
	});
    $( "#route_register_id" ).change(function() {
		get_student_by_bus();
	});
    $( "#route_details_id" ).change(function() {
		get_student_by_pickup();
	});
    $( "#department_id" ).change(function() {
		get_class_by_department();
		get_section_by_department();
		get_student_by_department();
	});
    $( "#class_id" ).change(function() {
		get_section_by_class();
		get_student_by_class();
	});
    $( "#section_id" ).change(function() {
		get_student_by_section();
	});
    $( "#btnSubmit" ).click(function() {
		get_report();
	});
	
	$('input[type="checkbox"]').on('change', function() {
		$('input[type="checkbox"]').not(this).prop('checked', false);
	});

});  

</script>  
<script type="text/javascript">
function get_route() 
{    
	var branch_id	=	$( "#branch_id" ).val();
		$.ajax({
			url: '<?php echo base_url();?>index.php/Transport_management/get_route_by_branch/' + branch_id ,
			success: function(response)
			{
				jQuery('#route_master_id').html(response);
			}
		});
}

function get_bus() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#route_register_id').html(response);
            }
        });
}
function get_pickup() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_pickup_by_branch1/' + branch_id ,
            success: function(response)
            {
                jQuery('#route_details_id').html(response);
            }
        });
}
function get_receipt_number()
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_receipt_number_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#receipt_number').html(response);
            }
        });
}
function get_department() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_department_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#department_id').html(response);
            }
        });
}
function get_class1() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_class_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
            }
        });
}
function get_section() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_section_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#section_id').html(response);
            }
        });
}
function get_student() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#student_id').html(response);
            }
        });
}
function get_installment_by_branch()
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_installment_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#bus_fee_settings_id').html(response);
            }
        });
}
function get_bus_by_route() 
{
	var route_master_id	=	$( "#route_master_id" ).val();
	if(route_master_id == '')
	{
		get_bus();
	}
	else
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus/' + route_master_id ,
            success: function(response)
            {
                jQuery('#route_register_id').html(response);
            }
        });
	}
}
function get_pickup_by_route() 
{
	var route_master_id	=	$( "#route_master_id" ).val();
	if(route_master_id == '')
	{
		get_pickup();
	}
	else
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_pick_up/' + route_master_id ,
            success: function(response)
            {
				jQuery('#route_details_id').html(response);
            }
        });
	}
}
function get_receipt_number_by_route()
{
	var route_master_id	=	$( "#route_master_id" ).val();
	if(route_master_id == '')
	{
		get_receipt_number();
	}
	else
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_receipt_number_by_route/' + route_master_id ,
            success: function(response)
            {
				jQuery('#receipt_number').html(response);
            }
        });
	}
}
function get_student_by_route()
{
	var route_master_id	=	$( "#route_master_id" ).val();
	if(route_master_id == '')
	{
		get_student();
	}
	else
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_route/' + route_master_id ,
            success: function(response)
            {
				jQuery('#student_id').html(response);
            }
        });
	}
}
function get_student_by_bus()
{
	var route_register_id	=	$( "#route_register_id" ).val();
	if(route_register_id == '')
	{
		get_student();
	}
	else
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_bus/' + route_register_id ,
            success: function(response)
            {
				jQuery('#student_id').html(response);
            }
        });
	}
}
function get_student_by_pickup()
{
	var route_details_id	=	$( "#route_details_id" ).val();
	if(route_details_id == '')
	{
		get_student();
	}
	else
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_pickup/' + route_details_id ,
            success: function(response)
            {
				jQuery('#student_id').html(response);
            }
        });
	}
}
function get_class_by_department() 
{
	var department_id	=	$( "#department_id" ).val();
	
		if(department_id == '')
		{
			get_class1();
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Transport_management/get_class_by_department/' + department_id ,
				success: function(response)
				{
					jQuery('#class_id').html(response);
				}
			});
		}
}
function get_section_by_department() 
{
	var department_id	=	$( "#department_id" ).val();
	
		if(department_id == '')
		{
			get_section();
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Transport_management/get_section_by_department/' + department_id ,
				success: function(response)
				{
					jQuery('#section_id').html(response);
				}
			});
		}
}
function get_student_by_department() 
{
	var department_id	=	$( "#department_id" ).val();
	
		if(department_id == '')
		{
			get_student();
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_department/' + department_id ,
				success: function(response)
				{
					jQuery('#student_id').html(response);
				}
			});
		}
}
function get_section_by_class() 
	{
	var class_id	=	$( "#class_id" ).val();
	
		if(class_id == '')
		{
			get_section();
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Transport_management/get_section_by_class/' + class_id ,
				success: function(response)
				{
					jQuery('#section_id').html(response);
				}
			});
		}
    }
function get_student_by_class() 
	{
	var class_id	=	$( "#class_id" ).val();
	
		if(class_id == '')
		{
			get_student();
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_class/' + class_id ,
				success: function(response)
				{
					jQuery('#student_id').html(response);
				}
			});
		}
    }
function get_student_by_section() 
	{
	var section_id	=	$( "#section_id" ).val();
	
		if(section_id == '')
		{
			get_student();
		}
		else
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/Transport_management/get_student_by_section/' + section_id ,
				success: function(response)
				{
					jQuery('#student_id').html(response);
				}
			});
		}
    }
function get_report()
{
	if($( "input[name='payment']" ).is(":checked"))
	{
	var payment_filter1	=	$( ".payment_filter:checked" ).val();
	}
	else
	{ 
	var payment_filter1	=	"";
	}
	var values	=	{
					report_type:$( "#report_type" ).val(),
					branch_id:$( "#branch_id" ).val(),
					route_master_id:$( "#route_master_id" ).val(),
					route_register_id:$( "#route_register_id" ).val(),
					route_details_id:$( "#route_details_id" ).val(),
					department_id:$( "#department_id" ).val(),
					class_id:$( "#class_id" ).val(),
					section_id:$( "#section_id" ).val(),
					student_id:$( "#student_id" ).val(),
					receipt_number:$( "#receipt_number" ).val(),
					due_date_from:$( "#due_date_from" ).val(),
					due_date_to:$( "#due_date_to" ).val(),
					bus_fee_settings_id:$( "#bus_fee_settings_id" ).val(),
					paid_date_from:$( "#paid_date_from" ).val(),
					paid_date_to:$( "#paid_date_to" ).val(),
					payment_filter:payment_filter1
					};
	var id_values = JSON.stringify(values);
	$.ajax({
		type: "POST",
		url: '<?php echo base_url();?>index.php/Transport_management/get_report/'  ,
		data: { ids : id_values },
		beforeSend: function()
		{
			jQuery('#report').html('<img src="<?php echo base_url(); ?>assets/images/ajax-loader.gif" alt="Loading..." ></image>');
		},
		success: function(response)
		{
			jQuery('#report').html(response);
		}
	});
}
	
</script>
