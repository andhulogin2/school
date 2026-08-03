<?php include_once APPPATH . 'views/staff_head.php';?>
<?php $running_year = get_running_year(); ?>


 

<body>
        
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
							<li class="active">Settings</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								SETTINGS
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									General Settings
								</small>
							</h1>
						</div>


<?php echo form_open(base_url() . 'index.php/staff/delete_unit_test_subject');?>
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onChange="get_class_subject2(this.value)">
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
					<option value="0"><?php echo get_phrase('Select');?></option>		
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
        
        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled">Delete</button>
			</center>
		</div>
	</div>
 </div>
<?php echo form_close();?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
	function get_class_subject2(class_id) {
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/staff/marks_get_subject2/' + class_id ,
			
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			});
			/*$.ajax({
		url: '<?php echo base_url();?>index.php?staff/get_unit_test/' + class_id ,
            success: function(response)
            {
                jQuery('#exam_id').html(response);
            }
            });*/
	}
</script>