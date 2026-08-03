<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php 
	$department_name	= 	$this->db->get_where('tbl_department' , array('dept_id' => $class_id))->row()->dept_name;
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
?>
<div id="print">
	<script src="assets/js/jquery-1.11.0.min.js"></script>
	
<div class="box-body" id="printableArea">
	<center>
		<img src="../../../uploads/logo.png" style="max-height : 60px;"><br>
		<h2>Exam Time Table<br></h2>
        Department :<?php echo $department_name;?><br />
		Class  :<?php  echo $class_name;?><br>
		Exam Title  :<?php  echo $title;?><br>

<table style="width:80%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
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
            <th colspan="6" bgcolor="#999999" >Class : <?php echo get_class_name($current_class_id); ?></th>
            </tr>
            
            <tr>
            <th class="table-header" align="left">Sl.No.</th>
            <th class="table-header" align="left">Exam Name</th>
            <th class="table-header" align="left">Date</th>
            <th class="table-header" align="left">Time From</th>
            <th class="table-header" align="left">Time To</th>
            </tr>
            </thead>
            <tbody>
        <?php
		}
		?>

    <tr>
    <td><?php echo $i=$i+1; ?></td>
    <td ><?php echo $sub['exam_name']; ?></td>
    <td ><?php echo date('d-m-Y',strtotime($sub['exam_date'])); ?></td>
    <td ><?php echo $sub['time_from']; ?></td>
    <td ><?php echo $sub['time_to']; ?></td>
    </tr>
	<?php
    $previous_class_id = $current_class_id;
    }
	}
	else
	{
    ?>
    <tr><td colspan="5">No Data Found</td></tr>
    <?php } ?>
</tbody>
</table>
	</center>

</div>
    </div>

   <div style="padding-left:600px">
    <button class="btn" type="button" style="background-color:#009933; width:200px; height:30px"  onClick="printDiv('printableArea')"> 
				<font color="#FFFFFF">Print</font>
			</button>
            </div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
