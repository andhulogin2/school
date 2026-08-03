<?php echo form_open(base_url() . 'index.php/admin/absent_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
<table>
<tr><td>
<div class="form-group"> 
   <label class="col-md-12"><b>Check / Uncheck</b> <input type="checkbox" name="selectall" id="selectall" onChange="select_deselcet_all()" />
</label>
 </div>
</td></tr>
<?php
foreach($student as $stud){
?>
<tr><td>
<input type="checkbox" name="student[]" checked="checked" value="<?php echo $stud["student_id"] ?>"> <?php echo $stud["name"] ?>

</td></tr>

<br/>
<?php } ?>
<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $date;?>" />
<hr>
<?php 
if(count($student) > 0){
?>
<div class="row pull-right">
<tr><td>
    <button type="submit" class="btn btn-success btn-icon pull-right" onclick="preloader()">
        Send
        <i class="entypo-mail"></i>
    </button></td></tr>
    </div>
<?php }else{
	echo "No data found!!";
} ?>
<?php echo form_close(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
}
</script>
    
