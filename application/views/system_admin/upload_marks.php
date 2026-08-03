<?php include_once APPPATH . 'views/head.php';?>
<?php $running_year = get_running_year(); ?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Upload Marks</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Mark Upload
								
							</h1>
						</div>

<?php echo form_open(base_url() . 'index.php/admin/marks_selector');?>
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)">
				<option value="">Select</option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
        <div id="subject_holder">
        <div class="form-group">
		<div class="col-md-2">
				<label class="control-label" style="margin-bottom: 5px;">Section</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Unit Test</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select</option>		
				</select>
			</div>
    </div>
	    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Subject</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select-Class</option>		
				</select>
			</div>
		</div>
         <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Remarks</label>
				<input type="text" class="form-control" name="remarks" id="remarks">
					
			</div>
		</div>
        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled">View</button>
			</center>
		</div>
	</div>
 </div>
<?php echo form_close();?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
	function get_class_subject(class_id) {
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/admin/marks_get_subject/' + class_id ,
			
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			});
			/*$.ajax({
		url: '<?php echo base_url();?>index.php?admin/get_unit_test/' + class_id ,
            success: function(response)
            {
                jQuery('#exam_id').html(response);
            }
            });*/
	}
</script>