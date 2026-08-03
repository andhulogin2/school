
<input type="hidden" value="<?php echo $branch_id;?>" name="branch_id" id="branch_id">
<input type="hidden" value="<?php echo $class_id;?>" name="class_id" id="class_id">
<input type="hidden" value="<?php echo $section_id;?>" name="section_id" id="section_id">
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
                        <?php
						if($add_remove=='add')
						{
						?>
                    		<th class="table-header"><center>Notes</center></th>
                        <?php
						}
						?>    
                        <th class="table-header"><center><input type="checkbox" name="select_all" id="select_all" onclick="check_all()" /></center></th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
						if(count($students)>0):
							$i	=	1;
							foreach($students as $stud):
					?>
                	<tr name="rows[]">
                    	<td><center><?php echo $i; ?></center></td>
                    	<td>
                        	<center><?php echo $stud['name']; ?></center>
                            <input type="hidden" name="student_id[]" id="student_id[]" value="<?php echo $stud['student_id']; ?>"  />
                        </td>
                        <?php
						if($add_remove=='add')
						{
						?>
                            <td>
                                <textarea id="notes" placeholder="Notes" class="col-xs-10 col-sm-5" name="notes[]" style="width:100%"></textarea>
                            </td>
                        <?php
						}
						?>    
                        <td><center><input type="checkbox" name="single_student[]" id="single_student[]" onclick="update_receipt_number()" value="<?php echo $i; ?>" /></center></td>
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
	//check_assigned();
	var add_remove	=	$('#add_remove').val();
	if(add_remove=='add')
	{
		document.getElementById('btnSubmit').value	=	'Add';
	}	
	if(add_remove=='remove')
	{
		document.getElementById('btnSubmit').value	=	'Remove';
	}	
})
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
		if($('#branch_id').val()=="")
		{
			jQuery('#msg_branch').html("Please select branch");
			counter++;
		}
		if($('#department_id').val()=="")
		{
			jQuery('#msg_department').html("Please select department");
			counter++;
		}
		if($('#class_id').val()=="")
		{
			jQuery('#msg_class').html("Please select class");
			counter++;
		}
		if($('#section_id').val()=="")
		{
			jQuery('#msg_section').html("Please select section");
			counter++;
		}
		for(var i=0;i<student_checkbox.length;i++)
		{
			if(student_checkbox[i].checked == true)
			{
				checked++;
			}
			if(student_checkbox[i].disabled == true)
			{
				disabled++;
			}
		}
		if(disabled==student_checkbox.length)
		{
			if($('#add_remove').val()=='add')
			{
				alert("All students are already members of the selected group.");
			}
			if($('#add_remove').val()=='remove')
			{
				alert("Students are not members of the selected group.");
			}
			return false;
		}
		else if(checked==0)
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
//This function is used to check if a student already paid the selected special fee
/*	function check_assigned()
	{	
		var students_group_master_id	=	$('#students_group_master_id').val();	
		var academic_year_id			=	$('#academic_year_id').val();
		var branch_id					=	$('#branch_id').val();
		var student						=	document.getElementsByName('student_id[]');
		var student_checkbox			=	document.getElementsByName('single_student[]');
		for(var i=0;i<student.length;i++)
		{	
			student_id			=	student[i].value;
			//student_checkbox[i].disabled	=	false;
			check_assigned1(academic_year_id,branch_id,students_group_master_id,student_id,i);
			//alert(val['student_id']);
		}
	}
	function check_assigned1(academic_year_id,branch_id,students_group_master_id,student_id,i)
	{
		
			$.ajax({
				url: '<?php echo base_url();?>index.php/Admin/check_assigned/' + academic_year_id + '/' + branch_id + '/' + students_group_master_id + '/' + student_id,
				success: function(response)
				{ 
				//alert(i+"-"+student_id+"-"+response);
					//jQuery('#class_id').html(response);
					//return array(student_id,response);
				disable_if_assigned(i,response);
				}
			});
	}
	function disable_if_assigned(i,response)
	{
		var student_checkbox					=	document.getElementsByName('single_student[]');
		var row									=	document.getElementsByName('rows[]');
		var add_remove							=	$('#add_remove').val();
		if(add_remove=='add')
		{
			document.getElementById('btnSubmit').value	=	'Add';
			if(response==1)
			{
				student_checkbox[i].disabled	=	true;
				student_checkbox[i].checked		=	false;
				row[i].title					=	"Student already assigned";
			}
			else
			{
				student_checkbox[i].disabled	=	false;
				row[i].title					=	"";
			}
		}
		if(add_remove=='remove')
		{
			document.getElementById('btnSubmit').value	=	'Remove';
			if(response==1)
			{
				//student_checkbox[i].disabled	=	true;
				student_checkbox[i].checked		=	true;
				row[i].title					=	"";
			}
			else
			{
				student_checkbox[i].disabled	=	true;
				row[i].title					=	"Student not in the group";
			}
		}
	}
*/
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