
<input type="hidden" value="<?php echo $class_id?>" name="class_id" id="class_id">
<input type="hidden" value="<?php echo $batch?>" name="section" id="section">
<br />
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student <font color="#FF0000">* </font></label>
    <div class="col-sm-7">
       <select name="student" id="student" class="col-xs-10 col-sm-5" required="" >
        <option value=""><?php echo get_phrase('Select'); ?></option>
        <?php foreach($student as $stud){?>
        <option value="<?php echo $stud['student_id'];?>">
        <?php echo $stud['name'];?>
        </option>
        <?php
        }
        ?>
        </select>
    </div> 
</div>

                        
                        
  