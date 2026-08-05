<?php if($class_id!=NULL) 
{ ?>

<h4 style="text-transform:uppercase;"><?php echo $title; ?></h4>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <?php
	  $width="width='20px'";
	  $current_class_id = "";
	  $previous_class_id = "";
	  $i=0;
	  $count=count($subject);
	  if($count>0)
	  {
	  foreach($subject as $sub)
	  {
	  	$dept_id=$sub['department_id'];

		$current_class_id = $sub['class_id'];
		if($current_class_id != $previous_class_id )
		{
		?>
  <thead>
    <tr>
      <th colspan="6" class="table-header">Class : <?php echo get_class_name($current_class_id); ?></th>
    </tr>
    <tr>
      <th class="table-header">SI</th>
      <th class="table-header">Exam Name</th>
      <th class="table-header">date</th>
      <th class="table-header">Time From</th>
      <th class="table-header">Time To</th>
      <th class="table-header">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
		}
		?>
    <tr>
      <td><?php echo $i=$i+1; ?></td>
      <td id="exam_name<?php echo $sub['exam_time_table_details_id']?>"><?php echo $sub['exam_name']; ?></td>
      <td class="mydatepicker" id="exam_date<?php echo $sub['exam_time_table_details_id']?>"><?php echo date('d/m/Y',strtotime($sub['exam_date'])); ?></td>
      <td id="time_from<?php echo $sub['exam_time_table_details_id']?>"><?php echo date('g:i A',strtotime($sub['time_from'])); ?></td>
      <td id="time_to<?php echo $sub['exam_time_table_details_id']?>"><?php echo date('g:i A',strtotime($sub['time_to'])); ?></td>
      <td align="center"><a href="#" id="edit_inline<?php echo $sub['exam_time_table_details_id']?>"  class="tooltip-success" data-rel="tooltip" title="Edit" onClick="showEdit(<?php echo $sub['exam_time_table_details_id']; ?>);"> 
      <span class="blue"><i class="ace-icon fa fa-pencil bigger-120"></i></span>
      </a> <a href="#" id="save_inline<?php echo $sub['exam_time_table_details_id']?>" style="display:none;" class="tooltip-success" data-rel="tooltip" title="Save" onClick="save_exam(<?php echo $sub['exam_time_table_details_id']; ?>)"> 
      <span class="green"><i class="ace-icon fa fa-floppy-o bigger-120"></i></span></a> &nbsp; 
      <a href="#" id="delete_inline<?php echo $sub['exam_time_table_details_id'] ?>" onClick="delete_exam(<?php echo $sub['exam_time_table_details_id'] ?>)" class="tooltip-success" data-rel="tooltip" title="Delete"   data-placement="top" title="Delete" data-original-title="Delete">
       <span class="red"> <i class="ace-icon fa fa-trash-o bigger-120"></i> </span> </a> </td>
    </tr>
    <?php
    $previous_class_id = $current_class_id;
    }
	}
	else
	{
    ?>
    <tr>
      <td colspan="5">No Data Found</td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php  if($count>0) { ?>
<div align="right"><a href="<?php echo base_url();?>index.php/admin/exam_time_table_print/<?php echo $dept_id; ?>/<?php echo $title; ?>/<?php echo $current_class_id; ?>" class="btn btn-info" target="_blank"> <font color="#FFFFFF">Print</font></a>
  </button>
  </p>
</div>
<?php } 
}?>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
<script type="text/javascript">
			function showEdit(id)
			{
				var exam_name 	= document.getElementById("exam_name"+id);
				var exam_date 	= document.getElementById("exam_date"+id);
				var time_from 	= document.getElementById("time_from"+id);
				var time_to 	= document.getElementById("time_to"+id);
				exam_name.contentEditable = "true";
				exam_date.contentEditable = "true";
				time_from.contentEditable = "true";
				time_to.contentEditable = "true";
				exam_name.focus();
				
				$('#edit_inline'+id).css('display','none');
				$('#save_inline'+id).css('display',"");
				$( "#exam_date" ).datepicker({
					dateFormat: "yyyy-mm-dd"
				});
			} 


		function save_exam(id)
		{
	var form	=	$('#hall_ticket_form');
			var exam_time_table_details_id = id;
			var exam_name 	= document.getElementById("exam_name"+id).innerText;
			var exam_date 	= document.getElementById("exam_date"+id).innerText;
			var time_from 	= document.getElementById("time_from"+id).innerText;
			var time_to 	= document.getElementById("time_to"+id).innerText;
			var class_id	=	document.getElementById('class').value;
			$.ajax({
			url: "<?php echo base_url()?>index.php/Admin/edit_exam_time_table",
			type: "POST",
			data:'&exam_time_table_details_id='+exam_time_table_details_id+'&exam_name='+exam_name+'&exam_date='+exam_date+'&time_from='+time_from+'&time_to='+time_to,
			success: function(data){
					get_exam_time_table(class_id);
				if(data==1)
				{
					toastr.success('Updated Successfully...', 'Updated', {timeOut: 5000});
				}
				else
				{
					toastr.error('Not Updated...', 'Error', {timeOut: 5000});
				}
			}        
			});
		}	

		function delete_exam(id)
		{
			var class_id	=	document.getElementById('class').value;
			var confirmRes = confirm('Are you sure to Delete this record?');
			if(confirmRes == true)
			{
				$.ajax({
				url: "<?php echo base_url()?>index.php/Admin/delete_exam_time_table",
				type: "POST",
				data:'&id='+id,
				success: function(data){
					get_exam_time_table(class_id);
				if(data==1)
				{
					toastr.success('Updated Successfully...', 'Updated', {timeOut: 5000});
				}
				else
				{
					toastr.error('Not Updated...', 'Error', {timeOut: 5000});
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
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function () {
if ($.fn.datepicker) {
$('.mydatepicker').datepicker({
autoclose: true,
todayHighlight: true,
dateFormat: 'dd/mm/yy'
});
}
});
</script>
