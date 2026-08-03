<?php error_reporting(0); ?>
<div class="table-responsive">
<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">


<thead>
<tr>
<th class="table-header">Sl No</th>	
<th class="table-header">Name</th>
<?php
foreach($subject as $row)
{
?>
<th class="table-header"><?php echo $row['name']; ?></th>	
<?php
}
?>
														
</tr>													
</thead>														


<tbody>	
<?php
$i=1;
foreach($student as $data)
{
?>
<tr>
<td style="text-align: center;"><?php echo $i; ?></td>											
<td style="text-align: center;"><?php  echo $data['name']; ?></td>

<?php 
foreach($subject as $row)
{
$this->db->select('class_timing_details_id');
$this->db->where('student_id',$data['student_id']);
$this->db->where('subject_id',$row['subject_id']);
$this->db->where('( attendance_status=1 or attendance_status=3)');

if($from_date==$to_date)
		{
		$this->db->where('att_date=',date('Y-m-d',strtotime($from_date)));
		}
		else
		{
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		}
$total_present=$this->db->get('view_att_houlry_attendance_details')->result_array();

$this->db->select('class_timing_details_id');
$this->db->where('subject_id',$row['subject_id']);
$this->db->group_by('class_timing_details_id');
if($from_date==$to_date)
		{
		$this->db->where('att_date=',date('Y-m-d',strtotime($from_date)));
		}
		else
		{
		$this->db->where('att_date>=',date('Y-m-d',strtotime($from_date)));
		$this->db->where('att_date<=',date('Y-m-d',strtotime($to_date)));
		$this->db->group_by('att_date');
		}
$total_hour=$this->db->get('view_att_houlry_attendance_details')->result_array();

?> <td> <?php
echo "Total Hour: ".count($total_hour);
echo "<br>";
echo "Total Present: ".count($total_present);
?> </td> <?php
}

?>
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