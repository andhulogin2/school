
<?php  $running_year = get_running_year(); ?>
<!--<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;">Section</label>
		<select name="section_id" id="section_id" class="form-control selectboxit" style="width:200px; required">
			<?php 
				$sections = $this->db->get_where('section' , array(
					'class_id' => $class_id,
					'academic_year' => $running_year
				))->result_array();
				foreach($sections as $row):
			?>
			<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
			<?php endforeach;?>
		</select>
	</div>
</div> -->

<div class="col-md-12">
	<div class="form-group">
	


			<?php if($this->db->get_where('settings' , array('type' =>'attendance'))->row()->description == 'yes')
												{
												?>
			<label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="attendance" checked> Attendance</label> 
			<div style="padding-left:50px;padding-bottom:20px;">
            	<?php
					$year	=	get_running_year();
					$this->db->select('DISTINCT(MONTH(FROM_UNIXTIME(timestamp))) as month');
					$this->db->where('year',$year);
					$query	=	$this->db->get('attendance')->result_array();
					foreach($query as $row):
						?>
						<input type="checkbox" checked="checked" name="months[]" value="<?php echo $row['month']; ?>"  /> <?php echo date('F', mktime(0, 0, 0, $row['month'], 10)); ?>&nbsp;&nbsp;
                        <?php
					endforeach;
				?>
            </div>
            <?php } ?>
            
            	<?php if($this->db->get_where('settings' , array('type' =>'hourly_attendance'))->row()->description == 'yes')
												{
												?>
			<label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="h_attendance" checked>Hourly Attendance</label> 
            <?php } ?>
            <label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="profile" checked> Profile</label> 
            
			<?php if($this->db->get_where('settings' , array('type' =>'fee_details'))->row()->description == 'yes')
			{
			?>
				<br /><label class="switch switch-success" style="padding-left:30px;"><input type="checkbox" name="fee_details"> Fee Details</label> 
			<?php } ?>
			
		
</div>
</div>

<div class="col-md-12">
	<div class="form-group">
	


			<?php 
				$this->db->where('is_deleted','N');
				$unit_test = $this->db->get_where('exam' , array(
					'class_id' => $class_id 
				))->result_array();
				
			
            if(count($unit_test)>0)
            {
            ?>
            <div class="col-md-12" style="margin-top:10px;"><b>EXAMS</b><br />
            <?php
				foreach($unit_test as $row):
			?>
			<label class="switch switch-success" style="padding-left:30px;padding-top:10px;"><input type="checkbox" name="exam[]" value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></label> 
			<?php endforeach;
			?>
            </div>
            <?php
			}
			
			if($this->db->get_where('settings' , array('type' =>'home_test'))->row()->description == 'yes')
			{
				$this->db->select('home_test_id,exam_name,date_exam');
				$this->db->where('is_deleted','N');
				$this->db->order_by('date_exam','DESC');
				$home_test = $this->db->get_where('tbl_home_test' , array('class_id' => $class_id,'section_id' => $section_id))->result_array();
				if(count($home_test)>0)
				{
				?>
				<div class="col-md-12" style="margin-top:10px;"><b>HOME TESTS</b><br />
				<?php
					foreach($home_test as $row):
				?>
				<label class="switch switch-success" style="padding-left:30px;padding-top:10px;"><input type="checkbox" name="home_test[]" value="<?php echo $row['home_test_id'];?>"><?php echo $row['exam_name'].'('.date('d/m/Y',strtotime($row['date_exam'])).')';?></label> 
				<?php endforeach;
				?>
				</div>
				<?php
				}
				?>
            <?php
			}
			
			if($this->db->get_where('settings' , array('type' =>'entrance_test'))->row()->description == 'yes')
			{
				$this->db->select('entrance_test_id,exam_name,date_exam');
				$this->db->where('is_deleted','N');
				$this->db->order_by('date_exam','DESC');
				$entrance_test = $this->db->get_where('tbl_entrance_test' , array('class_id' => $class_id,'section_id' => $section_id))->result_array();
				if(count($entrance_test)>0)
				{
				?>
				<div class="col-md-12" style="margin-top:10px;"><b>ENTRANCE TESTS</b><br />
				<?php
					foreach($entrance_test as $row):
				?>
				<label class="switch switch-success" style="padding-left:30px;padding-top:10px;"><input type="checkbox" name="entrance_test[]" value="<?php echo $row['entrance_test_id'];?>"><?php echo $row['exam_name'].'('.date('d/m/Y',strtotime($row['date_exam'])).')';?></label> 
				<?php endforeach;
				?>
				</div>
				<?php
				}
			} 
			?>
		
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