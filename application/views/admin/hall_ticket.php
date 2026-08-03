<?php if($class_id!=NULL && $exam_title!=NULL )
  { 
  $title=$exam_title;
  ?>
<div align="right"><a href="<?php echo base_url(); ?>index.php/Admin/pdf_download_of_hall_ticket/<?php echo $class_id; ?>/0/<?php echo $title; ?>" title="Download" >
<button class="btn-info">Download</button></a></div>
<?php echo form_open('admin/set_exam_reg_no',array('class' => 'email', 'id' => 'hall_ticket_form')); ?>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <?php
	  $i=0;
	  $count=count($student_data);
	  if($count>0)
	  {
		?>
  <tr>
    <th class="table-header">SI</th>
    <th class="table-header">Name</th>
    <th class="table-header">Gender</th>
    <th class="table-header">Phone</th>
    <th class="table-header">Admission No.</th>
    <th class="table-header">Register No. <br />(Tick if Same as admission number)&nbsp;&nbsp;
<input type="checkbox" name="reg" id="reg" onclick="copy_number();return false;" />
<button type="button" onclick="update_reg_no();"><font color="#000000">Set <br />Reg.no</font></th>
    <th class="table-header">Action</th>
  </tr>
  </thead>
  
  <tbody>
    <?php
	  foreach($student_data as $sub)
	  {
		?>
    <tr>
      <td><?php echo $i=$i+1; ?></td><input type="hidden" id="student_id[]" name="student_id[]" value="<?php echo $sub['student_id']; ?>" />
      <td><?php echo $sub['name']; ?></td>
      <td><?php echo $sub['sex']; ?></td>
      <td><?php echo $sub['phone1']; ?></td>
      <td><?php echo $sub['admission_number']; ?><input type="hidden" id="admission[]" name="admission[]" value="<?php echo $sub['admission_number']; ?>" /></td>
      <td><input type="text" name="reg_no[]" id="reg_no[]" value="<?php echo $sub['exam_register_number']; ?>" /></td>
      
      <td align="center"><a href="<?php echo base_url(); ?>index.php/Admin/pdf_report_of_hall_ticket/<?php echo $sub['class_id']; ?>/<?php echo $sub['student_id']; ?>/<?php echo $title; ?>" target="_blank" title="View">
              <span class="blue"><i class="ace-icon fa fa-eye bigger-120"></i></span></a>&nbsp;&nbsp;&nbsp;</a> 
      
     <a href="<?php echo base_url(); ?>index.php/Admin/pdf_download_of_hall_ticket/<?php echo $sub['class_id']; ?>/<?php echo $sub['student_id']; ?>/<?php echo $title; ?>" title="Download" >
<span class="blue"><i class="ace-icon fa fa-download bigger-120"></i></span></a> </td>
    </tr>
    <?php
	}
	}
	else
	{
    ?>
    <tr>
      <td colspan="5">No Data Found</td>
    </tr>
    <?php 
	}
 ?>
  </tbody>
</table>
<?php echo form_close(); 
} ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

<script language="JavaScript">
function copy_number() {
if(document.getElementById('reg').checked){
  checkboxes = document.getElementsByName('reg_no[]');
  admission = document.getElementsByName('admission[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].value = admission[i].value;
  }}
  else{
  document.getElementsByName('reg_no[]').value="";}
}</script>

<script>
function update_reg_no()
{
	var form	=	$('#hall_ticket_form');
		$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/set_exam_reg_no/',
			type:"POST",
			data: form.serialize(),
			success: function(response)
            {
				if(response==1)
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
</script>
