<?php //echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
STUDENT DETAILS
</div>
<font size="3">
<table id="simple-table" class="table table-striped table-hover table-bordered" > 
<tr>
<th style="text-align: left;">SI NO</th>
<th style="text-align: left;">Name</th>
<th style="text-align: left;">Admission No.</th>
<th style="text-align: left;">Class /Section</th>
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
<td style="text-align: left;"><?php echo get_admission_number($data['student_id']);?> </td> 
<td style="text-align: left;"><?php echo get_student_class_name($data['student_id'])." / ".get_student_section_name($data['student_id']) ;?> </td> 
<td style="text-align: left;"><img width="50px" height="50px" src="<?php echo base_url(); ?>/uploads/student_image/<?php echo $data['student_id']; ?>.jpg" /></td> 
<td><button name="book_details" id="book_details" onclick="get_books(<?php echo $data['student_id'];?>); return false;" value="<?php echo $data['student_id'];?>" class="btn btn-info" >Choose</button></td>
</tr>
<?php 
}
}
else
{
?>
<tr>
<td colspan="5" align="center">
<font color="#FF0000"> No Students Found</font></td>
</tr>
<?php
}
?>
</table>
</font>
<input type="text" name="student_id" id="student_id" hidden  />
<input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>


<div id="student2" >     
</div>
<script type="text/javascript">	
 function get_books(student_id){
	document.getElementById("student_id").value=student_id;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/student_book_detail_ajax/' + student_id ,
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