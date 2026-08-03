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
					'class_id' => $class_id 
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
			 $admin=$this->session->userdata('login_user_id'); 
			
			  $teacher_id=$this->db->get_where('staff' ,array('user_id'=>$admin))->row()->staff_id;
			$this->db->where('class_id',$class_id);
			//$this->db->where('teacher_id',$teacher_id);
				$subjects = $this->db->get_where('subject')->result_array();
				foreach($subjects as $row):
			?>
			<option value="<?php $subject_id = $row['subject_id'];echo $subject_id;?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Remarks</label>
				<input type="text" class="form-control selectboxit" name="remarks" id="remarks" value="">
					
			</div>
		</div>
<div class="col-md-2" style="margin-top: 20px;">
	<center>
		<button type="submit" class="btn btn-info">View</button>
	</center>
</div>

<script type="text/javascript">
	$(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
		{
			$("select.selectboxit").each(function(i, el)
			{
				var $this = $(el),
					opts = {
						showFirstOption: attrDefault($this, 'first-option', true),
						'native': attrDefault($this, 'native', false),
						defaultText: attrDefault($this, 'text', ''),
					};
					
				$this.addClass('visible');
				$this.selectBoxIt(opts);
			});
		}
    });
</script>