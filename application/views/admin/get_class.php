
    <div class="form-group">
        <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Class :<font color="#FF0000">* </font></label>

        <div class="col-sm-5">
            <select name="class" class="select2" id="class" onChange="get_class(this.value);" required="">
             <option value="">Select</option>
			<?php foreach($class as $r) { ?>
             <option value="<?php echo $r['class_id']; ?>"><?php echo $r['name']; ?></option>
			<?php } ?>
            </select>
        </div>
    </div>
    <input type="text" name="exam_title" id="exam_title" value="<?php echo $exam_title; ?>" hidden />
    <div id="time_table">
    </div>
    
<script type="text/javascript">
	function get_class(class_id) 
	{
	//alert(class_id);
		var exam_title=document.getElementById('exam_title').value;
		if(class_id!='')
		{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_time_table_ajax/' + class_id+ '/' +exam_title ,
            success: function(response)
            {
                jQuery('#time_table').html(response);
            }
        });
		}
		else
		{
                jQuery('#time_table').html('');
		}
    }
	
</script>
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>
