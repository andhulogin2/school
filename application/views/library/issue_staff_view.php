<?php //echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
STAFF DETAILS
</div>
<font size="3">
<table id="simple-table" class="table table-striped table-hover table-bordered" > 
<tr>
<th style="text-align: left;">SI NO</th>
<th style="text-align: left;">Name</th>
<th style="text-align: left;">Role</th>
<th style="text-align: left;">Photo</th>
<th></th>
</tr>
<?php 
$count = count($student);
if($count>0)
{
$i=1;
foreach($student as $data)
{
?>
<tr>
<td style="text-align: left;"><?php echo $i++;?></td>
<td style="text-align: left;"><?php echo $data['name'] ;?> </td> 
<td style="text-align: left;"><?php echo $data['role_name'] ;?> </td> 
<td style="text-align: left;"><img width="50px" height="50px" src="<?php echo base_url(); ?>/uploads/student_image/<?php echo $data['staff_id']; ?>.jpg" /></td> 
<td><button name="student_id" id="book_details" onclick="get_books(<?php echo $data['staff_id'];?>); return false; " class="btn btn-info" value="<?php echo $data['staff_id'];?>">Choose</button></td>
<input type="text" name="student_id" id="selected_book" value="<?php echo $data['staff_id'];?>" hidden />
</tr>
<?php 
}
}
else
{
?>
<tr>
<td colspan="5" align="center">
<font color="#FF0000"> No Staff Found</font></td>
</tr>
<?php
}
?>
</table>
</font>
<input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>

<!--<center>
<button type="submit" class="btn btn-info" id="submit_button">
<b>Issue Book</b>
</button>
-->
</center>

<div id="student2" >     
</div>
<script type="text/javascript">	
 function get_books(id){
 document.getElementById("selected_book").value = id;
 var staff_id = id;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/staff_book_detail_ajax/' + staff_id ,
		type:"GET",
            success: function(response)
            {
				console.log(response);
                jQuery('#student2').html(response);
            }
   });
}
</script>

<script type="text/javascript">
$(document).ready(function () {
$('.mydatepicker').datepicker({
autoclose: true,
todayHighlight: true,
dateFormat: 'dd/mm/yy'
})
});
</script>