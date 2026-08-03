





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
		<button type="submit" class="btn btn-info">Delete</button>
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