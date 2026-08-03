<body>
        	<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					
					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
					

   <?php  $role=$this->session->userdata('role');
?>
		<div class="table-responsive">
        <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                <thead>
                    <tr>
                  <?php  if($role==1 || $role==2 )
				   {?>  
                      <th style="width:auto"><center>Branch</center></th> 
                        <th style="width:auto"><center>Department</center></th>  <?php }?>
                       
                      <?php  if($role==3){?> <th style="width:auto"><center>Department</center></th> <?php  }?>
						 
                        <th style="width:auto"><center>Class</center></th>
                        <th style="width:auto"><center>Section</center></th>
                        <th style="width:auto"><center>Student</center></th>
                   </tr>
                </thead>
                <tbody>
                	<tr>
                      <?php  if($role==1 || $role==2 )
				   {?>  
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
                            <select name="department_id" style="width:100%" class="col-xs-10 col-sm-5" id="department_id"  >
                                  
                            </select>
                            </center>
                        </td>
                       
						 <?php }?>
                      
                 <?php  if($role==3)
				 {?>
                     <?php   $branch_id		=	$this->session->userdata('branch_id'); ?>
                    <input type="hidden" name="branch_id"  id="branch_id" value="<?php echo $branch_id; ?>" />
                             <td>
                            <center>
                            <select name="department_id" style="width:100%" class="col-xs-10 col-sm-5" id="department_id"  >
                                  
                            </select>
                            </center>
                        </td> <?php }
					
                        if($role > 3)
						{
						 $branch_id		=	$this->session->userdata('branch_id');
					
                           ?> 
                           <input type="hidden" name="branch_id"  id="branch_id" value="<?php echo $branch_id; ?>" />
                           <input type="hidden" name="department_id"  id="department_id" value="<?php echo $this->session->userdata('dept_id'); ?>" />
						<?php	} ?>
						
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
                    </tr>
                </tbody>
               </table>
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
                <thead>
                    <tr>
                     
                        <th style="width:auto"><center>Date From</center></th>
                        <th style="width:auto"><center>Date To</center></th>
                        <th style="width:auto"><center>Item</center></th>
                   </tr>
                </thead>
                <tbody>
                    <tr>
                          
                        <td>
                            <center>
                            <input type="text" name="date_from" autocomplete="off" style="width:100%" class="col-xs-10 col-sm-5 datepick" id="date_from" >
                            </center>
                        </td>
                        <td>
                            <center>
                            <input type="text" name="date_to" style="width:100%" autocomplete="off" class="col-xs-10 col-sm-5 datepick" id="date_to" >
                            </center>
                        </td>
                           <td>
                            <center>
                            <select name="item_master_id" style="width:100%" class="col-xs-10 col-sm-5" id="item_master_id"  >
                            </select>
                            </center>
                        </td>

                    </tr>
                </tbody>
             </table>
			 
				<div style="text-align:center"><button type="button" class="btn btn-info" id="btnSubmit">Show</button></div>
               </div>                     
                                    
                                  
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
                        
                        </div></div>
<div id="report">
                       
                        </div>
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
	   
//	$( "#btnSubmit" ).prop("disabled",true);
	$( "#td_btn" ).attr("title","Please select branch");
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
		//
		get_item();
		get_student();
		get_department();
		get_class1();
		get_section();
    });
	}
	  if(role== 3)
	  {
	 
	  get_department();
	  get_class1();
	  get_section();
	  get_item();
	  	     if($( "#department_id" ).val() != '')
		       {
	        $( "#btnSubmit" ).prop("disabled",false);
	           }
	  }
	   if(role >3)
	  {
	 get_item();
	get_student();
	get_class1();
	get_section();

	  }
	  
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
    $( "#student_id" ).change(function() {
	get_item_by_student();
	});

});  

</script>  
<script type="text/javascript">
function get_item_by_student() 
{ 

	var student_id	=	$( "#student_id" ).val();
	//alert( purchase_invoice_number);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Stock_management/get_item_by_student/' + student_id ,
            success: function(response)
            {
				jQuery('#item_master_id').html(response);
				
            }
        });
}


function get_item() 
{
	var branch_id	=	$("#branch_id" ).val();
	//alert('hgk');
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Stock_management/get_item_by_branch/' + branch_id ,
            success: function(response)
            {
                jQuery('#item_master_id').html(response);
            }
        });
}


function get_department() 
{
	var branch_id	=	$( "#branch_id" ).val();
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Stock_management/get_department_by_branch/' + branch_id ,
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
            url: '<?php echo base_url();?>index.php/Stock_management/get_class_by_branch/' + branch_id ,
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
            url: '<?php echo base_url();?>index.php/Stock_management/get_section_by_branch/' + branch_id ,
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
            url: '<?php echo base_url();?>index.php/Stock_management/get_student_by_branch/' + branch_id ,
            success: function(response)
            {
			
                jQuery('#student_id').html(response);
            }
        });
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
				url: '<?php echo base_url();?>index.php/Stock_management/get_class_by_department/' + department_id ,
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
				url: '<?php echo base_url();?>index.php/Stock_management/get_section_by_department/' + department_id ,
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
				url: '<?php echo base_url();?>index.php/Stock_management/get_student_by_department/' + department_id ,
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
				url: '<?php echo base_url();?>index.php/Stock_management/get_section_by_class/' + class_id ,
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
				url: '<?php echo base_url();?>index.php/Stock_management/get_student_by_class/' + class_id ,
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
				url: '<?php echo base_url();?>index.php/Stock_management/get_student_by_section/' + section_id ,
				success: function(response)
				{
					jQuery('#student_id').html(response);
				}
			});
		}
    }
function get_report()
{
	var values	=	{
					report_type:$( "#report_type" ).val(),
					branch_id:$( "#branch_id" ).val(),
					item_master_id:$( "#item_master_id" ).val(),
					department_id:$( "#department_id" ).val(),
					class_id:$( "#class_id" ).val(),
					section_id:$( "#section_id" ).val(),
					student_id:$( "#student_id" ).val(),
					date_from:$( "#date_from" ).val(),
					date_to:$( "#date_to" ).val()
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
	
</script>
