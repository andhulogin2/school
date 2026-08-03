
<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Section</label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<?php 
				$sections = $this->db->get_where('section' , array(
					'class_id' => $class_id 
				))->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>


<select name="exam_id" id="exam_id" class="form-control selectboxit">
			<?php 
				$this->db->where('is_deleted','N');
				$unit_test = $this->db->get_where('exam' , array(
					'class_id' => $class_id 
				))->result_array();
				foreach($unit_test as $row):
			?>
			<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		<?php
		if($section_id!='')
		{
			?>
			$('#section_id').val(<?php echo $section_id; ?>);
			$('#exam_id').val(<?php echo $exam_id; ?>);
			<?php
		}
		?>	
    });
</script>