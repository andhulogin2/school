<div class="table-header">
   Member Transaction Report
</div>
	
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th style="text-align: center;">SlNo	</th> 
    <th style="text-align: center;">Book Number	</th>
    <th style="text-align: center;">Book Name	</th>
    <th style="text-align: center;">Issued Date</th>
    <th style="text-align: center;">Return Date</th>
    <th style="text-align: center;">Returned Date</th>
</tr>
</thead>
<tbody>

<?php
$count = count($book);
if($count>0)
{
$i=1;
foreach($book as $row)
{
$issued_date = $row['issued_date'];
$return_date = $row['return_date'];
?>
<tr>
   <td style="text-align: center;"> <?php echo $i; ?> </td>
   <td style="text-align: center;"> <?php echo $row['book_number'];?> </td>
   <td style="text-align: center;"> <?php echo $row['book_name'];?> </td>
   <td style="text-align: center;"> <?php echo date("d-m-Y",strtotime($issued_date));?> </td>
   <td style="text-align: center;"> <?php echo date("d-m-Y",strtotime($return_date));?> </td>
   <td style="text-align: center;"> <?php if(($row['returned_date']) == '0000-00-00'){
    echo "-";
    }else{ 
	 echo date("d-m-Y",strtotime($row['returned_date'])); }?> </td> 
</tr>
   
<?php 
$i=$i+1;
}}
else
{ ?>
<tr>
<td colspan="6" align="center">
<font color="#FF0000"> No Transaction Occured</font></td>
</tr>
<?php
}
?>

</tbody>
</table>
