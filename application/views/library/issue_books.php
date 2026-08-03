<?php // echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
BOOK DETAILS
</div>

<font size="3">
<div style="text-align:center">

<table id="simple-table" class="table table-striped table-hover table-bordered" > 
<tr>
<th style="text-align: left;font:bold;"> Book Number</th>
<th style="text-align: left;"> Book Name </th>
<th style="text-align: left;">Author Name </th>
<th>Select Books</th>
</tr>
<?php
$count = count($student);
if($count>0)
{
foreach($student as $data)
{
?>
<tr>
<td style="text-align: left;"><?php echo $data['book_number'];?></td>
<td style="text-align: left;"><?php echo $data['book_name'] ;?> </td>
<td style="text-align: left;"><?php echo $data['author_name'] ;?> </td>
<td><input type='checkbox' name='book_details[]' id="book_details[]" onclick="get_book_id();"  title="Select Book"/>
<input type='text' name='book_id[]' id="book_id[]" hidden  />
            <input type="text" name="book_details_checked[]" value="<?php echo $data['book_details_id'];?>" hidden />
            <input type="text" name="checked[]" id="checked[]" hidden  />
            <?php
foreach($fine as $r)
{
?>	
<input type="hidden" name="max_books_can_take" id="max_books_can_take" value="<?php echo $r['maximum_books_can_take']; ?>" />
<?php } ?>

</td>
</tr>
<?php
}
}
else
{
?>
<tr>
<td colspan="4" align="center">
<font color="#FF0000"> No Books Available </font></td>
</tr>
<?php
}
?>
</table>
</div>
</font>

<input type="text" name="checked_count" id="checked_count"  hidden />
<input type="text" name="book_count" value="book_count" value="<?php echo $book_count; ?>" hidden />
<input type="hidden" id="mydatepicker" class="form-control mydatepicker" name="current_date" value="<?php echo date('d/m/Y')?>"/>
<script type="text/javascript">            
function get_book_id()
{
	var book = document.getElementsByName('book_details[]');
	
	var book_id = document.getElementsByName('book_id[]');
	
	var check_status = document.getElementsByName('book_details_checked[]');
	var count_item = check_status.length;
	
	var check_uncheck=document.getElementsByName('book_details[]'); 
	var checked = document.getElementsByName('checked[]');
	var check_count = document.getElementById('checked_count');
	var max_books = document.getElementById('max_books_can_take');
	var book_count = document.getElementById('book_count');
	var j=0;
	for (var i = 0;  i < count_item; i++)
	{
		if(book[i].checked)
		{
			checked[i].value = "Y";
			
			j=j+1;
			
			check_count.value=j;
			if(check_count.value>(max_books.value-book_count.value))
			{
				document.getElementById("submit_button").disabled = true;
			}
			else
			{
				document.getElementById("submit_button").disabled = false;
			}
		}
		else
		{
			checked[i].value = 'N';
		}
	}
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