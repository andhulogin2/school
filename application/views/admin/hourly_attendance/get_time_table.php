  <?php
  // echo $class_timing;
   echo form_open('Hourly_attendance/save_time_table' , array('class' => 'form-horizontal'));
				?>

<table id="simple-table" class="table table-striped table-bordered table-hover resposive" cellpadding="2">            
</tr>
     
                                        
 <tr>                                       
<?php 
$count=1;

echo "<tr><th  class='table-header' align='right'>" ;
$cols=0;
foreach($class_timing as $row)
{ 
echo "<th  class='table-header' align='right'>".$row['timing_name']." </th>";
$cols++;
}
foreach($time_table as $row)
{ 
echo "<tr> ";
$pos=0;
foreach($row as $value)
{
$pos++;
if($pos==5 || ($pos>=8 && $pos<8+$cols))
echo "<td>".$value." </td>";
}
echo " </tr> ";
} 

?>

       </tr> 
     
<tr><td colspan="8">

</td></tr>
</table>
 <?php echo form_close();?>
