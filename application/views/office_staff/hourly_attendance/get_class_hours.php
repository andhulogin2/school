 
  
  <?php
  // echo $class_timing;
   echo form_open('Hourly_attendance/save_time_table' , array('class' => 'form-horizontal'));
				?>

<input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
<input type="hidden" name="section_id" value="<?php echo $section_id; ?>" />
<input type="hidden" name="branch" value="<?php echo $branch_id; ?>" />
<input type="hidden" name="department" value="<?php echo $dept_id; ?>" />

<table id="simple-table" class="table table-striped table-bordered table-hover resposive" cellpadding="2">            
<tr><td class="table-header" align='center'>Day / Hour</td>

<?php
 foreach($class_timing as $timing)
 {
		echo "<td  class='table-header' align='center'>". $timing['timing_name'];
		echo "<br>( ".$timing['start_time'] .' - ';
		echo $timing['end_time'] . ")";
		echo"</td>";
}
  ?>


</tr>
                                        
 <tr>                                       
<?php 
$count=1;

foreach($working_days as $day): 
echo "<tr><td  class='table-header' align='right'>" ;
echo $day['week_day_short_name'] ;
//   echo '&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="hour[]" checked />';
echo "</td>";  ?>
<?php
$i=0;
 foreach($class_timing as $row)
 { ?>
<td style="padding-left:1px;padding-right:1px" align='center'>
<input type="hidden" name="day_id[]" value="<?php echo $day['week_day_id']; ?>"  />
<input type="hidden" name="hour_id[]" value="<?php echo $row['timing_name']; ?>"  />
<select id="subject_id[]" name="subject_id[]" onchange="change_teacher(this.value)" required >
  <option value="">Choose Subject</option>
    <?php foreach($subjects as $sub)
                    { 
					$selected='';
					foreach($time_table as $data)
					{
					if($sub['subject_id']==$data['subject_id'] &&  $row['class_timing_details_id']==$data['hour_id'] &&   $day['week_day_id']==$data['week_day_id'])
					{
					$selected='selected="selected"';
					break;
					}
                    }    ?> 
                         <option value="<?php echo $sub['subject_id']?>"  <?php echo $selected ; ?> ><?php echo $sub['name']; ?></option>
                        <?php
					}

					
					
					
					?>




</select>

<select id="teacher_id[]" name="teacher_id[]" style="visibility: hidden" >
  <option value=""></option>
    <?php foreach($subjects as $sub)
                    { ?>
                         <option value="<?php echo $sub['teacher_id']?>"><?php echo $sub['teacher_id']; ?></option>
                        <?php 
                    } ?>


</select>
           </td>
           
 <?php 
 $count++;
 } ?>
       </tr> 
   
<?php endforeach; ?>
<tr><td colspan="8">
<div class="col-sm-offset-3 col-sm-5">
          <input type="submit" class="btn btn-info" name="btnSave" value="Save" />
</div>
</td></tr></table>
 <?php echo form_close();?>
 
 <script type="text/javascript">

 function change_teacher(value)
 {
 subjects= document.getElementsByName('subject_id[]');
 teachers= document.getElementsByName('teacher_id[]');
 for(i=0;i<subjects.length;i++)
  teachers[i].selectedIndex=subjects[i].selectedIndex;
 }
 
 </script>
