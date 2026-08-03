
<div class="col-md-9">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Section</label>
		<select name="section_id" id="section_id" class="form-control selectboxit" style="width:200px;">
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

<div class="col-md-12">
	<div class="form-group">
	


			
			<label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="attendance" checked> Attendance</label> 
            <label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="profile" checked> Profile</label> 
			
		
</div>
</div>

<div class="col-md-12">
	<div class="form-group">
	


			<?php 
				$unit_test = $this->db->get_where('exam' , array(
					'class_id' => $class_id 
				))->result_array();
				foreach($unit_test as $row):
			?>
			<label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="exam[]" value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></label> 
			<?php endforeach;?>
		
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