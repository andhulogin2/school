

Skip to content
Using Gmail with screen readers

15 of 13,194
changes in jamaath school
Inbox
x

Moby Antony <mobyantony96@gmail.com>
Attachments
Mar 11, 2020, 6:04 PM (5 days ago)
to me


3 Attachments

<?php if($class_id!=NULL) 
{ ?>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="table-header">SI</th>
<th class="table-header">Subject</th>
<th class="table-header"><input type="checkbox" name="check_all" onclick="toggle(this)" /></th>
<th class="table-header">Exam Name</th>
<th class="table-header">Date</th>
<th class="table-header">Time From</th>
<th class="table-header">Time To</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
			$running_year = get_running_year(); 
	  $count=count($subject);
	  if($count>0)
	  {

foreach($subject as $sub)
{
		$this->db->where('year_id',$running_year);
		$this->db->where('exam_title',$exam_title);
		$this->db->where('class_id',$class_id);
		$this->db->where('subject_id',$sub['subject_id']);
		$exam_detail = $this->db->get('view_exam_time_table')->result_array();

if($exam_detail)
{
foreach($exam_detail as $exam_details)
?>
<tr>
<td><?php echo $i=$i+1; ?></td>
<td><?php echo $sub['name']; ?></td>

            <?php
			$checked=""; 
			if(count($exam_details) > 0)
			$checked="checked";
			?>

<td><input type="checkbox" name="subject[]" class="sub_check" id="subject[]"<?php echo $checked; ?>  onchange="get_subject();" />

</td>
<td><input type="text" name="exam_name[]" id="exam_name[]" value="<?php echo $exam_details['exam_name']; ?>"  /></td>       
<td><input type="date" name="exam_date[]" value="<?php echo $exam_details['exam_date']; ?>" class="form-control mydatepicker" id="mydatepicker"  /></td>
<td><input type="text" name="time_from[]" value="<?php echo $exam_details['time_from']; ?>" class="form-control timepicker1"  /></td>
<td><input type="text" name="time_to[]" value="<?php echo $exam_details['time_to']; ?>" class="form-control timepicker1" />

<input type="text" name="check_status[]" id="check_status[]" value="<?php echo $sub['subject_id']; ?>" hidden />
<input type="text" name="checked[]" id="checked[]" hidden /></td>
<?php 
}
else
{
 ?>
<tr>
<td><?php echo $i=$i+1; ?></td>
<td><?php echo $sub['name']; ?></td>
<td><input type="checkbox" class="sub_check" name="subject[]" id="subject[]" onchange="get_subject();" /></td>
<td><input type="text" name="exam_name[]" id="exam_name[]" value="<?php echo $sub['name']; ?>" /></td>
<td><input type="date" name="exam_date[]" class="form-control mydatepicker" class="form-control mydatepicker" id="mydatepicker" /></td>
<td><input type="text" name="time_from[]" class="form-control timepicker1"  /></td>
<td><input type="text" name="time_to[]" class="form-control timepicker1" />
<input type="text" name="check_status[]" id="check_status[]" value="<?php echo $sub['subject_id']; ?>" hidden />
<input type="text" name="checked[]" id="checked[]" hidden />
</td>
</tr>
<?php
}
}
}
else
{
?>
    <tr>
      <td colspan="7" align="center"><font color="#0066FF">No Data Found</font></td>
    </tr>

<?php
}}
?>
<input type="text" name="count_item" id="count_item" hidden />

</tbody>
</table>

<div align="center">
<button type="submit" class="btn btn-info" id="save" name="save">Save</button>
</div><br /><br />
<br /><br />


<script src="<?php echo base_url();?>/assets/js/date-time/bootstrap-timepicker.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: false,
					showMeridian: true
				})
    });
	</script> 

<script>
$(document).ready(function(){
	var subject=document.getElementsByName('subject[]');
	var exam_date=document.getElementsByName('exam_date[]');
	var time_from=document.getElementsByName('time_from[]');
	var time_to=document.getElementsByName('time_to[]');
	var check_status=document.getElementsByName('check_status[]');
	var count_item=check_status.length;
	document.getElementById('count_item').value=count_item;
	var checked=document.getElementsByName('checked[]');
	for(i=0; i<count_item; i++)
	{
		if(subject[i].checked)
		{
			checked[i].value='Y';
			exam_date[i].required = true;
			time_from[i].required = true;
			time_to[i].required   = true;
		}
		else
		{
			checked[i].value='N';
			exam_date[i].required = false;
			time_from[i].required = false;
			time_to[i].required = false;
		}
	}	
});
function get_subject()
{
	var subject=document.getElementsByName('subject[]');
	var exam_date=document.getElementsByName('exam_date[]');
	var time_from=document.getElementsByName('time_from[]');
	var time_to=document.getElementsByName('time_to[]');
	
	var check_status=document.getElementsByName('check_status[]');
	var count_item=check_status.length;
	document.getElementById('count_item').value=count_item;
	var checked=document.getElementsByName('checked[]');
	for(i=0; i<count_item; i++)
	{
		if(subject[i].checked)
		{
			checked[i].value='Y';//alert(checked[i].value);
			exam_date[i].required = true;
			time_from[i].required = true;
			time_to[i].required   = true;
		}
		else
		{
			checked[i].value='N';
			exam_date[i].required = false;
			time_from[i].required = false;
			time_to[i].required = false;
		}
	}
}
</script>


<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('subject[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
  get_subject();
}</script>

exam_time_table.php
Displaying admin_controller_jaems.php.