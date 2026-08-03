<?php // echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
MEMBER DETAILS
</div>

<div style="text-align:center">

<table id="simple-table" class="table table-striped table-hover table-bordered" > 
<tr>
<th style="text-align: left;">Sl No.</th>
<th style="text-align: left;">Name</th>
<th style="text-align: left;">Admission No.</th>
<th style="text-align: left;">Class/Section</th>
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
<td><button name="student_id" id="student_id" onclick="get_book_detail(<?php echo $data['student_id'];?>); return false; " class="btn btn-info" value="<?php echo $data['student_id'];?>">Choose</button></td>
<input type="text" name="student_id" id="student_id" value="<?php echo $data['student_id'];?>" hidden />
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

<br />
<div id="book3" >
</div>
<br/></br>	
<br />
</div></div>
</div>
</div>


<script type="text/javascript">	
 function get_book_detail(id){
 document.getElementById("student_id").value = id;
 var student_id = id;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/member_transaction_detail_ajax/' + student_id ,
		type:"GET",
            success: function(response)
            {
				console.log(response);
                jQuery('#book3').html(response);
            }
   });
}
</script>
