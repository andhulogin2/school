<div class="table-header">
   Due Report
</div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th style="text-align: center;">SlNo</th> 
    <th style="text-align: center;">Book No.</th>
    <th style="text-align: center;">Book Name</th>
    <th style="text-align: center;">Student Name</th>
    <th style="text-align: center;">Admission No.</th>
    <th style="text-align: center;">Class/Section</th>
    <th style="text-align: center;">Last Date</th>


</tr>
</thead>

<tbody>
<?php
$i=1;
foreach($result as $row)
{
$return_date = $row['return_date'];

?>
<tr>
   <td style="text-align: center;"> <?php echo $i; ?> </td>
   <td style="text-align: center;"> <?php echo $row['book_number'];?> </td>
   <td style="text-align: center;"> <?php echo $row['book_name'];?> </td>
   <td style="text-align: center;"> <?php echo $row['name'];?> </td>
   <td style="text-align: center;"> <?php echo get_admission_number($row['member_id']);?> </td>
   <td style="text-align: center;"> <?php echo get_student_class_name($row['member_id'])." / ".get_student_section_name($row['member_id']);?> </td>
   <td style="text-align: center;"> <?php echo date("d-m-Y",strtotime($return_date));?> </td>
 </tr>
   
<?php 
$i=$i+1;
} ?>

</tbody>
</table>
