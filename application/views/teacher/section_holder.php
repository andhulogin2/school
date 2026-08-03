<div class="col-md-3">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Section</label>
		<select name="section_id" id="section_id" class="form-control selectboxit">
			<?php 
                            
			    $academic_year=get_running_year();
			    $this->db->where('class_id',$class_id);
	                    $this->db->where('academic_year',$academic_year);
	                    $sections = $this->db->get('section')->result_array();
				
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
     {
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
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