
<input type="hidden" value="<?php echo $branch_id?>" name="branch_id" id="branch_id">
<input type="hidden" value="<?php echo $dept_id?>" name="dept_id" id="dept_id">
<input type="hidden" value="<?php echo $class_id?>" name="class_id" id="class_id">
<input type="hidden" value="<?php echo $batch?>" name="section" id="section">
<br />
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select name="student" id="student" class="select2" required="" onchange="get_details()">
        <option value=""><?php echo get_phrase('Select'); ?></option>
        <?php foreach($student as $stud){?>
        <option value="<?php echo $stud['student_id'];?>">
        <?php echo $stud['name'];?>
        </option>
        <?php
        }
        ?>
        </select>
    </div> 
</div>

       <div id="payment_student1" style="padding-left:50px;padding-right:50px"></div>                    
                        
  <script type="text/javascript">	
 function get_details(){
	 jQuery('#payment_student1').html("");
	 	var branch_id 	= $('#branch_id').val();
	 	var dept_id 	= $('#dept_id').val();
        var classid 	= $('#class_id').val();
        var student 	= $('#student').val();
		 var section 	= $('#section').val();
		if(student == ""){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_payment_details1/' + student + '/' + classid + '/' + section + '/' + dept_id + '/' + branch_id,
            success: function(response)
            {
				//console.log(response);
                jQuery('#payment_student1').html(response);
            }
   });
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