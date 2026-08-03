<?php echo form_open(base_url() . 'index.php/staff/absent_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<?php
foreach($student as $stud){
?>
<input type="checkbox" name="student[]" checked="checked" value="<?php echo $stud["student_id"] ?>"> <?php echo $stud["name"] ?>
<br/>
<?php } ?>
<hr>
<?php 
if(count($student) > 0){
?>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        Send
        <i class="entypo-mail"></i>
    </button>
<?php }else{
	echo "No data found!!";
} ?>
<?php echo form_close(); ?>
