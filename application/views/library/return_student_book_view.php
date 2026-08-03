<?php // echo form_open(base_url() . 'index.php/Library/issue_book_data/' . $book_details_id . '/' . $student_id ); ?>

<br/>
<br/>
<div class="table-header">
STUDENT BOOK DETAILS
</div>

<div style="text-align:center">
<table id="simple-table" class="table table-striped table-hover table-bordered" >
<?php 
foreach($student as $data)
$name=$data['name'];
$member_id=$data['student_id'];
$class=$data['class_name'];
$division=$data['section_name'];
?>
<input type="hidden" name="member_id" value="<?php echo $member_id; ?>" />
<tr>
<th align="right" colspan="2">Name :    <?php echo $name;?></th>
<th align="right"  colspan="4">Class / Division: <?php echo $class;?>/<?php echo $division;?></th>
<th valign="middle" align="right" rowspan="2"><img width="50px" height="50px" src="<?php echo base_url(); ?>/uploads/student_image/<?php echo $member_id; ?>.jpg" /></th></tr>
<tr><th style="text-align: left;font:bold;"> SI NO </th> 
<th style="text-align: left;"> Book Name  </th> 
<th style="text-align: left;"> Issued Date </th>
<th style="text-align: left;"> Return Date </th>
<th style="text-align: left;"> Late By Day </th>
<th style="text-align: left;"> Fine </th>
</tr> 

<?php 
foreach($fine as $data)
$fine_per_day=$data['fine_amount_per_day'];
$count = count($student);
if($count>0)
{
$i=1;
$total_fine=0;
foreach($book as $data)
{
$date1 = new DateTime($data['return_date']);
$date2 = new DateTime(date('Y-m-d'));
if($date1<$date2)
{
	$interval = $date1->diff($date2);
	$diff= $interval->days;
	$fine=$diff*$fine_per_day;
}
else
{
	$diff=0;
	$fine=$diff*$fine_per_day;
}
?>
<tr>
<td style="text-align: left;"><?php echo $i++;?></td>
<td style="text-align: left;"><?php echo $data['book_name'];?></td>
<td style="text-align: left;"><?php echo $data['issued_date'] ;?> </td> 
<td style="text-align: left;"><?php echo $data['return_date'] ;?> </td>
<td style="text-align: left;"><?php echo $diff; ?></td>
<td style="text-align: left;"> <?php echo $fine; ?></td>
<td style="text-align: left;"><input type='checkbox' name='book_details[]' id="book_details" onclick="get_book_id(<?php echo $data['book_details_id'];?>);"  title="Select Book"/>
<input type='text' name='book_id[]' id="book_id" hidden  />
            <input type="text" name="book_details_checked[]" value="<?php echo $data['book_details_id'];?>" hidden />
            <input type="text" name="checked[]" id="checked[]" hidden />

<input type="text" name="fine[]" id="fine[]" value="<?php echo $fine; ?>" hidden /></td>
</tr>
<?php
$total_fine=$total_fine+$fine;
}
}
else
{
?>
<tr>
<td colspan="4" align="center">
<font color="#FF0000"> No books issued </font></td>
</tr>
<?php
}
?>
<tr><td colspan="6" align="right">Total</td><td><input type="text" value="<?php echo $total_fine; ?>" readonly="readonly" /></td>
<tr><td colspan="6" align="right">Paying</td><td><input type="text" id="paying_fine" name="paying_fine" readonly="readonly" /></td></tr>
</table>
<br/></br>	
<br />
<center>
<input type="checkbox" name="pay_fine" onclick="get_fine();" id="pay_fine"  />Paying Fine<br />
            <input type="text" name="checking" id="checking" hidden   /><br />
<button type="submit" class="btn btn-info" id="submit_button">
<b>Return Book</b>
</button>
</center>
</div></div>
</div>
</div>

<script type="text/javascript">            
function get_book_id(id)
{
	var book = document.getElementsByName('book_details[]');
	var book_id = document.getElementsByName('book_id[]');
	var fine = document.getElementsByName('fine[]');
	var paying_fine = document.getElementById('paying_fine');
	var check_status = document.getElementsByName('book_details_checked[]');
	var count_item = check_status.length;
	var check_uncheck=document.getElementsByName('book_details[]'); 
	var checked = document.getElementsByName('checked[]'); 
	var tot_fine =0;
	  for (var i = 0;  i < count_item; i++)
	   {
	  //  check_status[i].value=book_id[i].value;
	   if(book[i].checked)
		{
	  checked[i].value = 'Y';
	  tot_fine = tot_fine + parseInt(fine[i].value);
		}
		else
			{
	  
	   checked[i].value = 'N';
		}
	   }
	   paying_fine.value=tot_fine;
}
</script>

<script>
function get_fine()
{
var pay_fine=document.getElementById('pay_fine');
var checking=document.getElementById('checking');
if (pay_fine.checked)
  {
  checking.value = 'Y';
  }
  else
  {
  checking.value = 'N';
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