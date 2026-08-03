
<input type="hidden" value="<?php echo $class_id?>" name="class_id" id="class_id">
<input type="hidden" value="<?php echo $batch?>" name="section" id="section">
<br />
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select name="student" id="student" class="col-xs-10 col-sm-5" required="" onchange="get_details()">
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
        var classid = $('#class_id').val();
        var student = $('#student').val();
		 var section = $('#section').val();
		if(student == "0" || student == ""){
			return false;
			jQuery('#payment_student1').html("");
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/Transport_management/get_bus_fee_concession_details/' + student + '/' + classid + '/' + section,
            success: function(response)
            {
				console.log(response);
				//alert(response);
                jQuery('#payment_student1').html(response);
            }
   });
}
</script>
