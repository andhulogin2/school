	
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th style="text-align:center">SlNo</th> 
    <th style="text-align:center">Date</th>
     <th style="text-align:center">Amount</th>
    
</tr>
</thead>

<tbody>

<?php
$count = count($fine);
$total_fine=0;
if($count>0)
{
$i=0;
foreach($fine as $data)
{
$fine=$data['fine_amounts'];
?>
<tr>
   <td style="text-align:center"> <?php echo $i=$i+1; ?> </td>
    <td style="text-align:center"><?php echo date('d-m-Y',strtotime($data['date_of_collection']));?> </td>
    <td style="text-align:right"><?php echo  number_format( $data['fine_amounts'],2) ;?> </td>
</tr>
<?php
$total_fine=$total_fine+$fine;
} }
 else
 { 
?>
<tr>
<td colspan="3" style="text-align:center">
<font color="#FF0000"> No Fine Collected</font></td>
</tr>
<?php
}
?>
<tr><td colspan="2" style="text-align:center"><b>Total Amount</b></td><td style="text-align:right"><b><?php echo number_format($total_fine,2); ?></b></td>

</tbody>
</table>
