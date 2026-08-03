
<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Section</label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<?php 
				$this->db->select('s.name as section_name,s.section_id');
				$this->db->join('section s','s.section_id=st.section_id');
				$this->db->where('st.teacher_id',$teacher_id);
				$this->db->where('st.class_id',$class_id);
				$this->db->group_by('s.section_id');
				$sections = $this->db->get('subject_teacher st')->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['section_name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>


<select name="exam_id" id="exam_id" class="form-control selectboxit">
			<?php 
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