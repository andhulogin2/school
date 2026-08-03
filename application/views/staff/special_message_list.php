<?php echo form_open(base_url() . 'index.php/staff/special_message/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

<input type="checkbox" name="selectall" id="selectall" />check/uncheck<br />
<?php

foreach($student as $stud){
?>

<input type="checkbox" name="student[]" id="student[]"  class="name"value="<?php echo $stud["student_id"] ?>"> <?php echo $stud["name"] ?>
<br/>
<?php } ?>
<br>
<div class="form-group">
                <label class="col-md-12"><?php echo get_phrase('Message'); ?></span></label>
                <div class="col-md-12">
                    <textarea class="form-control" name="message_special" placeholder="<?php echo get_phrase('Write-Message'); ?>..."></textarea>
                        
                   </div>
           
                         
                       
						</div> 
<?php 
if(count($student) > 0){
?>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button>
<?php }else{
	echo "No data found!!";
} ?>
<?php echo form_close(); ?>
<SCRIPT language="javascript">

    $(function () {

        // add multiple select / deselect functionality

        $("#selectall").click(function () {
		//alert("dsfd");
		

            $('.name').attr('checked', this.checked);

        });
		
		 
 

 

        // if all checkbox are selected, then check the select all checkbox

        // and viceversa

       

    });

</SCRIPT>
