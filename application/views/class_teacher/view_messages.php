<div style="margin-left:15px;margin-right:15px;">
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<tr>
<th class="table-header">SL NO</th>
<th class="table-header">Student Name</th>
<th class="table-header">Class</th>
<th class="table-header">Message</th>
<th class="table-header">Date & Time</th>
<th class="table-header">Viewed</th>
<th class="table-header">Viewed Date</th>
<th class="table-header">Action</th>
</tr>
<?php
$i=0;
foreach($message_data as $msg)
{
		$student_name   = $this->db->get_where('student' , array('student_id' => $msg['to_student_id']))->row()->name;
		$class_name   = get_student_class_name($msg['to_student_id']);
		$section_name   = get_student_section_name($msg['to_student_id']);
?>
<tr>
<td><?php echo $i=$i+1; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $class_name."/".$section_name; ?></td>
<td><?php echo $msg['message']; ?></td>
<td><?php echo date('d/m/Y h:i A', strtotime($msg['date_time'])); ?></td>
<?php if($msg['viewed']=='N')
{ ?>
<td><?php echo "No" ?></td>
<td align="center">-</td>
<?php } else { ?>
<td><?php echo "Yes" ?></td>
<td><?php echo date('d/m/Y h:i A', strtotime($msg['viewed_date_time'])); ?></td>
<?php } ?>
<td><a href="#" id="delete_inline<?php echo $msg['message_id']; ?>" onClick="delete_message(<?php echo $msg['message_id']; ?>)" class="tooltip-success" data-rel="tooltip" title="Delete"   data-placement="top" title="Delete" data-original-title="Delete">
<i class="fa fa-remove bigger-130 text-danger"></i>
</a></td>
</tr>
<?php
}
?>
</table>
</div>


<script>
		function delete_message(id)
		{
			var confirmRes = confirm('Are you sure to Delete this record?');
			if(confirmRes == true)
			{
				$.ajax({
				url: "<?php echo base_url()?>index.php/Class_teacher/delete_message",
				type: "POST",
				data:'&id='+id,
				success: function(data){
					get_message_details();
				if(data==1)
				{
					toastr.success('Deleted Successfully...', {timeOut: 5000});
				}
				else
				{
					toastr.error('Not Deleted...', {timeOut: 5000});
				}
			}        
			});
			}
			else
			{
				return false;
			}
		}
		</script>
