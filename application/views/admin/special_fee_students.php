
<input type="hidden" value="<?php echo $branch_id;?>" name="branch_id" id="branch_id">
<input type="hidden" value="<?php echo $class_id;?>" name="class_id" id="class_id">
<input type="hidden" value="<?php echo $section_id;?>" name="section_id" id="section_id">
<input type="hidden" value="<?php echo get_running_year();?>" name="academic_year_id" id="academic_year_id">
<?php
$receipt_num	=	get_receipt_number("Receipt",$branch_id)+1;
$receipt_number	=	$receipt_num;
?>

<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_date"></label>
<div class="form-group">
	<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="padding-left:20px;text-align:left"> Date <font color="#FF0000">* </font></label>
    <div class="col-sm-9" style="padding-left:20px;">
        <input type="text" name="date_paid" class="select2" id="date_paid" required value="<?php echo date('d-m-Y') ?>">
    </div>
</div>



<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_fee_item"></label>
<div class="form-group">
	<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="padding-left:20px;text-align:left"> Fee Item <font color="#FF0000">* </font></label>
    <div class="col-sm-9" style="padding-left:20px;">
        <select name="fee_head_id" class="select2" id="fee_head_id" required>
            <option value="">Select</option>
            <?php
			foreach($special_fee_heads as $fee_heads):
			?>
            <option value="<?php echo $fee_heads['fee_head_id']; ?>"><?php echo $fee_heads['fee_head']; ?></option>
            <?php
			endforeach;
			?>
        </select>
    </div>
</div>

<label class="col-sm-3"></label><label class="col-sm-9" style="color:#FF0000" id="msg_fee_amount"></label>
<div class="form-group">
	<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="padding-left:20px;text-align:left"> Amount <font color="#FF0000">* </font></label>
    <div class="col-sm-9" style="padding-left:20px;">
        <input type="text" name="fee_amount" class="select2" id="fee_amount" required>
    </div>
</div>

<div class="form-group">
	<label class="col-sm-1"></label>
    <label class="col-sm-2 control-label no-padding-right" for="form-field-1" style="padding-left:20px;text-align:left"> Description </label>
    <div class="col-sm-9" style="padding-left:20px;">
        <textarea name="description" cols="39" rows="3"></textarea>
    </div>
</div>

<br /><br />
<div class="form-group">
	<div class="col-sm-1"></div>
    <div class="col-sm-8" align="center">
    	<div class="table-responsive">
            <table class="table simple-table table-bordered table-hover">   
                <thead>
                	<tr>
                    	<th class="table-header"><center>Sl.No.</center></th>
                    	<th class="table-header"><center>Name</center></th>
                    	<th class="table-header"><center>Admission Number</center></th>
                     <!--   <th class="table-header"><center>Receipt Number</center></th>-->
                        <th class="table-header"><center><input type="checkbox" name="select_all" id="select_all" onclick="check_all()" /></center></th>
                    </tr>
                </thead>
                <tbody>
                	<?php 
						$i	=	1;
						foreach($students as $stud):
					?>
                	<tr name="rows[]">
                    	<td><center><?php echo $i; ?></center></td>
                    	<td>
                        	<center><?php echo $stud['name']; ?></center>
                            <input type="hidden" name="student_id[]" id="student_id[]" value="<?php echo $stud['student_id']; ?>"  />
                        </td>
                        <td>
                        	<center><?php echo $stud['admission_number']; ?></center>

                        </td>
                  <!--      <td style="width:30%;"><center><input type="text" name="receipt_number[]" id="receipt_number[]" readonly="readonly" value="<?php echo $receipt_number; ?>" /></center></td>-->
                        <td><center><input type="checkbox" name="single_student[]" id="single_student[]" onclick="update_receipt_number()" value="<?php echo $i; ?>" /></center></td>
                    </tr>
                    <?php 
						$i++;
						$receipt_number++;
						endforeach;
					?>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="date_from" value="<?php echo date('d-m-Y'); ?>"  />
        <input type="hidden" name="date_to" value="<?php echo date('d-m-Y'); ?>"  />
        <input type="checkbox" name="chk_send_sms" id="chk_send_sms" /> <b>Send SMS</b>
        <input type="submit" class="btn btn-info" value="Pay" onclick="return validate_form()" />
        <?php echo form_close();?>
    </div> 
    <div class="col-sm-3">
</div>

<div id="payment_student1" style="padding-left:50px;padding-right:50px"></div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>                        
<script type="text/javascript">	
//This function is used to check and uncheck all checkboxes
	function check_all()
	{
		//var receipt				=	document.getElementsByName('receipt_number[]');
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
		//update_receipt_number();
	}
//This function is used to change the receipt number when checking or unchecking a checkbox 
	function update_receipt_number()
	{
		var student_checkbox	=	document.getElementsByName('single_student[]');
		var receipt				=	document.getElementsByName('receipt_number[]');
		var receipt_num			=	parseInt(<?php echo $receipt_num; ?>);
		for(var i=0;i<student_checkbox.length;i++)
		{
			if(student_checkbox[i].checked == true)
			{
				receipt[i].value	=	receipt_num;
				receipt_num++;		
			}
			if(student_checkbox[i].checked == false)
			{
				receipt[i].value	=	"";
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
		jQuery('#msg_fee_item').html("");
		jQuery('#msg_fee_amount').html("");
		jQuery('#msg_date').html("");
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
		if($('#fee_head_id').val()=="")
		{
			jQuery('#msg_fee_item').html("Please select fee item");
			counter++;
		}
		if($('#fee_amount').val()=="")
		{
			jQuery('#msg_fee_amount').html("Please enter fee amount");
			counter++;
		}
		if($('#date_paid').val()=="")
		{
			jQuery('#msg_date').html("Please enter date");
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
			alert("All students paid this fee.");
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
/*	function check_paid()
	{
		var fee_head_id			=	$('#fee_head_id').val();	
		var academic_year_id	=	$('#academic_year_id').val();
		var branch_id			=	$('#branch_id').val();
		var student				=	document.getElementsByName('student_id[]');
		var student_checkbox	=	document.getElementsByName('single_student[]');
		for(var i=0;i<student.length;i++)
		{
			student_id			=	student[i].value;
			//student_checkbox[i].disabled	=	false;
			check_paid1(academic_year_id,branch_id,fee_head_id,student_id,i);
			//alert(val['student_id']);
		}
	}
	function check_paid1(academic_year_id,branch_id,fee_head_id,student_id,i)
	{
			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/check_paid/' + academic_year_id + '/' + branch_id + '/' + fee_head_id + '/' + student_id,
				success: function(response)
				{
				//alert(i+"-"+student_id+"-"+response);
					//jQuery('#class_id').html(response);
					//return array(student_id,response);
				disable_if_paid(i,response);
				}
			});
	}
	function disable_if_paid(i,response)
	{
		var student_checkbox				=	document.getElementsByName('single_student[]');
		var row								=	document.getElementsByName('rows[]');
		if(response==1)
		{
			student_checkbox[i].disabled	=	true;
			student_checkbox[i].checked		=	false;
			row[i].title					=	"Fee paid";
		}
		else
		{
			student_checkbox[i].disabled	=	false;
			row[i].title					=	"";
		}
	}*/
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
 
