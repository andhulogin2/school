<div class="table-header">
   Book Transaction Report
</div>
	
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th style="text-align: center;">SlNo	</th> 
    <th style="text-align: center;">Member</th>
    <th style="text-align: center;">Admission No.</th>
    <th style="text-align: center;">Class/Section</th>
    <th style="text-align: center;">Issued Date</th>
    <th style="text-align: center;">Return Date</th>
    <th style="text-align: center;">Returned Date</th>
 </tr>
</thead>
<?php
$count = count($book);
if($count>0)
{
$i=1;
foreach($book as $row)
{
$issued_date = $row['issued_date'];
$return_date = $row['return_date'];
$returned_date = $row['returned_date'];
?>
<tbody>
<tr>
   <td style="text-align: center;"> <?php echo $i; ?> </td>
   <td style="text-align: center;"> <?php echo $row['name'];?> </td>
   <td style="text-align: center;"> <?php echo get_admission_number($row['member_id']);?> </td>
   <td style="text-align: center;"> <?php echo get_student_class_name($row['member_id'])." / ".get_student_section_name($row['member_id']);?> </td>
   <td style="text-align: center;"> <?php echo date("d-m-Y",strtotime($issued_date));?> </td>
   <td style="text-align: center;"> <?php echo date("d-m-Y",strtotime($return_date));?> </td> 
   <td style="text-align: center;"> <?php if(strtotime($row['returned_date']) == ''){
    echo "-";
    }else{ 
	 echo date("d-m-Y",strtotime($returned_date)); }?> </td> 
 </tr>
   
<?php 
$i=$i+1;
}}
else
{ ?>
<tr>
<td colspan="5" align="center">
<font color="#FF0000"> No Transaction Occured</font></td>
</tr>
<?php
}
?>
</tbody>
</table>
			
