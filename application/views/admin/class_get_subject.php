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
	<label class="control-label" style="margin-bottom: 5px;">Exam</label>

<input type="text" name="exam" id="exam" />

</div>
</div>






<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Subject</label>
		<select name="subject_id" id="subject_id" class="form-control selectboxit">
			<?php 
                                $yr =   get_running_year();
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

  <div class="col-md-2">
	   <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Date</label>
			<input type="text" class="form-control mydatepicker" name="date" value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>


<div class="col-md-2" style="margin-top: 20px;">
	<center>
		<button type="submit" class="btn btn-info">Submit</button>
	</center>
</div>



<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	</script>  

