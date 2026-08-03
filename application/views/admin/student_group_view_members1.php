<input type="hidden" value="<?php echo $branch_id;?>" name="branch_id" id="branch_id">
<input type="hidden" value="<?php echo $add_remove;?>" name="add_remove" id="add_remove">
<input type="hidden" value="<?php echo get_running_year();?>" name="academic_year_id" id="academic_year_id">

<br /><br />
<div class="form-group">
	<div class="col-sm-2"></div>
    <div class="col-sm-6" align="center">
    	<div class="table-responsive">
            <table class="table simple-table table-bordered table-hover">   
                <thead>
                	<tr>
                    	<th class="table-header"><center>Sl.No.</center></th>
                    	<th class="table-header"><center>Name</center></th>
                    	<th class="table-header"><center>Class</center></th>
                        <th class="table-header"><center><input type="checkbox" name="select_all" id="select_all" onclick="check_all()" /></center></th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
						if(count($members)>0):
							$i	=	1;
							foreach($members as $stud):
					?>
                	<tr name="rows[]">
                    	<td><center><?php echo $i; ?></center></td>
                    	<td>
                        	<center><?php echo $stud['name']; ?></center>
                            <input type="hidden" name="student_id[]" id="student_id[]" value="<?php echo $stud['student_id']; ?>"  />
                        </td>
                        <td><center><?php echo $stud['class_name']." ".$stud['section_name']; ?></center></td>
                        <td><center><input type="checkbox" name="single_student[]" id="single_student[]" value="<?php echo $i; ?>" /></center></td>
                    </tr>
                    <?php 
							$i++;
							endforeach;
						else:
						?>
                     <tr>
                     	<td colspan="3" style="text-align:center;color:#FF0000"><b>No Records found.</b></td>
                     </tr>   
                        <?php
						endif;
					?>
                </tbody>
            </table>
        </div>
        <input type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-info" value="Add" onclick="return validate_form()" />
        <?php echo form_close();?>
    </div> 
    <div class="col-sm-4">
</div>

<div id="payment_student1" style="padding-left:50px;padding-right:50px"></div>  
                  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>                        
<script type="text/javascript">	

$(document).ready(function(){
	var add_remove	=	$('#add_remove').val();
	if(add_remove=='remove_all')
	{
		document.getElementById('btnSubmit').value	=	'Remove';
	}
});
//This function is used to check and uncheck all checkboxes
	function check_all()
	{
		var student_checkbox	=	document.getElementsByName('single_student[]');
		var select_all			=	document.getElementById('select_all');	
		var result				=	select_all.checked;
		for(var i=0;i<student_checkbox.length;i++)
		{	
			if(student_checkbox[i].disabled==false)
			{
				student_checkbox[i].checked	=	result;
			}
			
		}
		
	}

//Form validation
	function validate_form()
	{	
		var counter				=	0;
		var checked				=	0;
		var disabled			=	0;
		var student_checkbox	=	document.getElementsByName('single_student[]');
		jQuery('#msg_branch').html("");
		jQuery('#msg_department').html("");
		jQuery('#msg_class').html("");
		jQuery('#msg_section').html("");
		jQuery('#msg_group').html("");
		for(var i=0;i<student_checkbox.length;i++)
		{
			if(student_checkbox[i].checked == true)
			{
				checked++;
			}
		}
		if(checked==0)
		{
			alert("Please select atleast one checkbox.");
			return false;
		}
		if(counter>0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','300px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>       