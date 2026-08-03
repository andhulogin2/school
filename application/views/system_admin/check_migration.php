<?php echo form_open(base_url() . 'index.php/admin/class_migrate/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>

<?php

foreach($student as $stud){
?>

<input type="checkbox" name="student[]" checked="checked" value="<?php echo $stud["student_id"] ?>"> <?php echo $stud["name"] ?>
<br/>
<?php } ?>
<br>
<div class="mail-compose">
    <div class="row">
    <div class="col-md-3">
          <div class="form-group">
						<label for="field-2" class="control-label">Class:</label>
						<div >
							<select name="class1" id="class_selector_holder1" class="form-control" required="" onchange="return get_class_sections(this.value)">
                              <option value="">Select</option>
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
					  </select>
						</div> 
					</div>
    </div>  <div class="col-md-3">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
		                        <select name="section1" onchange="get_details1()"  class="form-control" id="section_selector_holder1">
		                            <option value="0">Select-Class</option>
			                    </select>
			                </div>
					</div>
</div>
 
</div>

    <button type="submit" class="btn btn-success btn-icon pull-right">
        Migrate
        <i class="entypo-mail"></i>
    </button>

<?php echo form_close(); ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder1').html(response);
            }
        });
    }
</script>
