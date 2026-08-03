<div class="table-responsive">
<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">


<thead>
<tr>
<th class="table-header">Sl No</th>	
<th class="table-header">Name</th>
<th class="table-header">Total Working Days</th>	
<th class="table-header">Total Working Hours</th>
<th class="table-header">Total Hours</th>	
<th class="table-header">Total Present</th>	
<th class="table-header">Attendance Percentage</th>	
														
</tr>													
</thead>														


<tbody>	
<?php
$i=1;
foreach($total_present as $data)
{
?>
<tr>
<td style="text-align: center;"><?php echo $i; ?></td>											
<td style="text-align: center;"><?php echo $data['student_name']; ?></td>
<td style="text-align: center;"><?php echo $working_days; ?></td>
<td style="text-align: center;"><?php echo $total_working_hours; ?></td>
<td style="text-align: center;"><?php echo $total_hours; ?></td>
<td style="text-align: center;"><?php echo $data['total_present']; ?></td>
<td style="text-align: center;"><?php echo number_format($data['percentage'],2)." %"; ?></td>
</tr>
<?php
$i++;
}
?>
           
</tbody>


</table>
</div> 

 <div class="col-md-2" style="margin-top: 20px;">
        <input type="submit" class="btn btn-info" type="button" value='Download Attendance Report'> 
   </div>
 
    
     <?php echo form_close();?>         