
<div class="col-md-2">
	<div class="form-group">
	    <label class="control-label" style="margin-bottom: 5px;">Section:<font color="#CC0000">*</font></label>
		<select name="section_id" id="section_id" class="select2" required="required">
			<?php 
                        $yr=get_running_year();
			    $this->db->where('class_id',$class_id);
	            $this->db->where('academic_year',$yr);
				$sections = $this->db->get('section')->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>



<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('#section_id').css('width','150px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>              

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


