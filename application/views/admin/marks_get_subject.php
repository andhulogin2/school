<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Section</label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<?php 
				$year	=	get_running_year();
				$this->db->order_by('name');
				$sections = $this->db->get_where('section' , array(
					'class_id' => $class_id ,'academic_year'=>$year
				))->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php $section_id =$row['section_id'];echo $section_id;?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>


<select name="exam_id" id="exam_id" class="form-control selectboxit">
			<?php 
				$unit_test = $this->db->get_where('exam' , array(
					'class_id' => $class_id,'is_deleted'=>'N' 
				))->result_array();
				foreach($unit_test as $row):
			?>
			<option value="<?php $exam_id=$row['exam_id'];echo $exam_id;?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
</div>
</div>






<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Subject</label>
		<select name="subject_id" id="subject_id" class="form-control selectboxit">
			<?php 
                                $yr=get_running_year();
				$subjects = $this->db->get_where('subject' , array(
					'class_id' => $class_id , 'year' => $yr
				))->result_array();
				foreach($subjects as $row):
			?>
			<option value="<?php $subject_id = $row['subject_id'];echo $subject_id;?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<div class="col-md-2" style="margin-top: 20px;">
	<center>
		<button type="submit" class="btn btn-info" onclick="return get_exam()">Show</button>
	</center>
</div>

<script>
function get_exam()
{

var result=document.getElementById("exam_id").value;

if(result=='')
{
return false;
}

}

</script>