<?php
$monthName = date('F', mktime(0, 0, 0, $month, 10)); // March
?>
<table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
<tr><td class='table-header'>Date</td><td class='table-header'>Reson for Holiday</td></tr>
<?php
$number = cal_days_in_month(CAL_GREGORIAN,  $month,$year); // 31
for($i=1; $i<$number;$i++)
{
	$date1 = $i.'-'.$month.'-'.$year;
	$date2 = $year.'/'.$month.'/'.$i;
	$dayname = date('l', strtotime($date2));
	
	if(is_working_day($date1)=='N')
	{
		$reason 	=	$dayname;
		$font_color	=	'color="red"';
		$checked	=	'checked';
		$check_checked = 1;
	}
	else
	{
		$reason 	=	'';
		$font_color	=	'color="black"';
		$checked	=	'';
		$check_checked=0;
	}
	$reason_for_holiday=is_holiday($date1);
	if($reason_for_holiday!='')
	{
		if($reason!='' && $reason_for_holiday!='Sunday' )
			$reason = $reason_for_holiday;
		else
			$reason = $reason_for_holiday;
			$check_checked = 1;
			$checked	=	'checked';
	}
?>
<tr>
<td class="col-sm-3"><font <?php echo $font_color; ?> >
<input type = 'hidden' name='date[]' id='date[]' value='<?php echo $date1 ;?>' class="col-xs-10 col-sm-3"><?php echo  $date1 . ' : ' . $dayname ;?>
</td>

<td>
<input type = 'checkbox' name='chk_holiday[]' id='chk_holiday[]' <?php echo $checked; ?> onchange="set_checked_value();" class="col-sm-1">
&nbsp;&nbsp;&nbsp;
<input type = 'text' name='reason[]' id='reason[]' value='<?php echo $reason; ?>' class="col-sm-10">
<input type = 'hidden' name='check_checked[]' id='check_checked[]' value='<?php echo $check_checked; ?>'>
</font>
</td>
</tr>
<?php

}
?>
</table>



<script type="text/javascript">
function set_checked_value()
{

var holidays_checked = document.getElementsByName('chk_holiday[]');
var day_count = holidays_checked.length;
var check =  document.getElementsByName('check_checked[]');

  for (var i = 0;  i < day_count; i++)
   {
   if(holidays_checked[i].checked)
		check [i].value =1;
	else
	  check [i].value =0;
 }   
}


</script>
