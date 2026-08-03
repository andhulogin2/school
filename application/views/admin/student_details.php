<input type="hidden" value="<?php echo $class_id?>" name="class_id" id="class_id">
<input type="hidden" value="<?php echo $batch?>" name="section" id="section">
<input type="hidden" name="txtfee_plan" id="txtfee_plan" />

<br />
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fee Plan <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
	<select name="Fee_Plan" id="Fee_Plan" class="col-xs-10 col-sm-5" required="" onchange="document.getElementById('txtfee_plan').value=this.options[this.selectedIndex].value;" >
        <option value="">Select</option>

        <?php $this->db->select('fee_master_id,fee_master_name');
        $this->db->from('tbl_fee_master');
        $this->db->where('class_id',$class_id);
        $data=$this->db->get()->result_array();
        
        foreach($data as $data1){?> 
        <option value="<?php echo $data1['fee_master_id'];?>"> <?php echo $data1['fee_master_name'];?> </option>
        <?php	}  ?>
    </select>
    </div>
</div>
<br />

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student Name <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
    <select name="student" id="student" class="col-xs-10 col-sm-5" required="" onchange="get_details()" >
        <option value="">Select</option>
        
        <?php foreach($student as $stud){?>
        <option value="<?php echo $stud['student_id'];?>"> <?php echo $stud['name'];?> </option>
        <?php } ?>
    </select>
    </div>
</div>


<div class="row" id="absent_student1"></div>
                      
  <script type="text/javascript">	
 function get_details(){
 document.getElementById('Fee_Plan').disabled=true;
	 jQuery('#absent_student1').html("");
        var classid = $('#class_id').val();
        var student = $('#student').val();
		var section = $('#section').val();
		var fee_plan= $('#txtfee_plan').val();
		console.log(student);
		if(student == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_details1/' + student + '/' + classid + '/' + section+ '/' + fee_plan,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent_student1').html(response);
            }
   });
}
</script>