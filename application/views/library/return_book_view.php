<?php // echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
BOOK DETAILS
</div>

<div style="text-align:center">

<table id="simple-table" class="table table-striped table-hover table-bordered" >
<tr><th style="text-align: left;font:bold;"> SI NO </th> 
<th style="text-align: left;"> Book Name  </th>
<th style="text-align: left;"> Book Number  </th>
<th style="text-align: left;"> Issued Date </th>
<th style="text-align: left;"> Return Date </th>
<th></th>
</tr> 
<input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>

<?php 
$count = count($book);
if($count>0)
{
$i=1;
foreach($book as $data)
{
?>
<tr>
<td style="text-align: left;"><?php echo $i++;?></td>
<td style="text-align: left;"><?php echo $data['book_name'];?></td>
<td style="text-align: left;"><?php echo $data['book_number'];?></td>
<td style="text-align: left;"><?php echo $data['issued_date'] ;?> </td> 
<td style="text-align: left;"><?php if($data['return_date']=='1970-01-01'){ echo "-"; }else{ echo $data['return_date'];} ?> </td>
<td style="text-align: left;"><button name="student_id" id="student_id" onclick="get_student_detail(<?php echo $data['member_id'];?>); return false; " class="btn btn-info" value="<?php echo $data['member_id'];?>">Choose</button>
<input type="text" name="student_id" id="selected_book" value="<?php echo $data['member_id'];?>" hidden /> </td>
</tr>
<?php
}}
else
{
?>
<tr>
<td colspan="6" align="center">
<font color="#FF0000"> No books issued </font></td>
</tr>
<?php

}
?>
</table>

<br />
<div id="student1" >
</div>
</div></div>
</div>
</div>


<script type="text/javascript">	
 function get_student_detail(id){
 document.getElementById("selected_book").value = id;
 var student_id = id;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/student_detail_ajax/' + student_id ,
		type:"GET",
            success: function(response)
            {
				console.log(response);
                jQuery('#student1').html(response);
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