<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> District: </label>
    <div class="col-sm-4">
		<select name="district_id" id="district_id" class="form-control selectboxit">
        <option value="">Select-District</option>
			<?php 
				$sections = $this->db->get_where('tbl_districts' , array(
					'state_id' => $state_id ))->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['district_id'];?>"><?php echo $row['district'];?></option>
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