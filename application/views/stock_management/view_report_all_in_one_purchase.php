<body>
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
					

 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                       <?php  $role=$this->session->userdata('role');
?>
		<div class="table-responsive">
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                <thead>
                    <tr>
                  <?php  if($role==1 || $role==2 )
				   {?>  

                        <th style="width:auto"><center>Branch</center></th> <?php } ?>
                        <th style="width:auto"><center>Date From</center></th>
                        <th style="width:auto"><center>Date TO</center></th>
                        <th style="width:160px"><center>Invoice No</center></th>
                        <th style="width:160px"><center>Item</center></th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                 <?php  if($role==1 || $role==2 )
				   {?>        <td>
                            <center>
                            <select name="branch_id" class="select2" style="width:100%" id="branch_id" required >
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
                        <?php } 
                       if($role > 2)
					   { ?>
                   <?php
				     $branch_id		=	$this->session->userdata('branch_id');
					
                           ?> 
                           <input type="hidden" name="branch_id"  id="branch_id" value="<?php echo $branch_id; ?>" />
						<?php	} ?>
                            <td>
                            <center>
                            <input type="text" name="date_from" style="width:100%" class="col-xs-10 col-sm-5 datepick" id="date_from" >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <input type="text" name="date_to" style="width:100%" class="col-xs-10 col-sm-5 datepick" id="date_to" >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                   <select name="purchase_invoice_number" style="width:100%" class="select2" onChange="return disable_item(this.value)" id="purchase_invoice_number"  >
                                  
                            </select>
                            </center>
                        </td>
                        <td>
                            <center>
                            <select name="item_master_id" style="width:100%" class="select2"  onChange="return disable_no(this.value)"  id="item_master_id"  >
                                  
                            </select>
                            </center>
                        </td>
                    </tr>
                </tbody>
             </table>
				<div style="text-align:center"><button type="button" class="btn btn-info" id="btnSubmit">Show</button></div>
               </div>                     
                                    
                                    <?php  } ?>
                                    
                                    
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
                        <div id="report">
                        	
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
		   var role= <?php echo $role; ?>;
	  if(role== 1 || role== 2)
	  { 
	  $( "#btnSubmit" ).prop("disabled",true);
	  $( "#td_btn" ).attr("title","Please select branch");
	  }
	  var role= <?php echo $role; ?>;
	  if(role== 1 || role== 2)
	  {
	  
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
		get_invoice();
		get_item();
    });
	}
	if(role > 2 )
	{
	//var branch_id1	=	$( "#branch_id1" ).val();
	//alert(branch_id1);
	get_invoice();
	get_item();
		}
    $( "#purchase_invoice_number" ).change(function() {
	get_item_by_invoice();
	});
    $( "#btnSubmit" ).click(function() {
		get_report();
	});

});  

</script>  
<script type="text/javascript">
function get_invoice() 
{ 
	var branch_id	=	$( "#branch_id" ).val();
	//alert( branch_id);
		$.ajax({
			url: '<?php echo base_url();?>index.php/Stock_management/get_invoice_by_branch/' + branch_id ,
			success: function(response)
			{
				jQuery('#purchase_invoice_number').html(response);
				//alert(response);
			}
		});
}

function get_item() 
{
	var branch_id	=	$( "#branch_id" ).val();
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Stock_management/get_item_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#item_master_id').html(response);
				//alert(response);
            }
        });
}
function get_item_by_invoice() 
{ 

	var purchase_invoice_number	=	$( "#purchase_invoice_number" ).val();
	//alert( purchase_invoice_number);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Stock_management/get_item_by_invoice/' + purchase_invoice_number ,
            success: function(response)
            {
				jQuery('#item_master_id').html(response);
				
            }
        });
}
function get_report()
{
//alert($( "#item_master_id" ).val());
	var values	=	{
					report_type:$( "#report_type" ).val(),
					branch_id:$( "#branch_id" ).val(),
					date_from:$( "#date_from" ).val(),
					date_to:$( "#date_to" ).val(),
					purchase_invoice_number:$( "#purchase_invoice_number" ).val(),
					item_master_id:$( "#item_master_id" ).val(),
					};
	var id_values = JSON.stringify(values);
	$.ajax({
		type: "POST",
		url: '<?php echo base_url();?>index.php/Stock_management/get_report/'  ,
		data: { ids : id_values },
		success: function(response)
		{
			jQuery('#report').html(response);
		}
	});
}

function disable_item()
{
document.getElementById("item_master_id").disabled = true;

}
function disable_no()
{
document.getElementById("purchase_invoice_number").disabled = true;

}

	
</script>

