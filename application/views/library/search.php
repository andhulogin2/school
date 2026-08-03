		<?php include_once APPPATH . 'views/library_head.php';?>
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
		<li class="active">Search</li>
		</ul>
		<!-- /.breadcrumb -->
		
		<!-- #section:basics/content.searchbox -->
		<div class="nav-search" id="nav-search">
		<input type="text" placeholder="Search ..." class="nav-search-input"  autocomplete="off" name="search_key" id="search_key"/>
		<i class="ace-icon fa fa-search nav-search-icon"></i>
		</span>
		</div>
		<!-- /.nav-search -->
		
		<!-- /section:basics/content.searchbox -->
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
		
		<div class="page-header">
		<h1>
		Search
		<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Search for
		</small>
		</h1>
		</div>
		
		
<?php echo form_open(base_url() . 'index.php/Library/search_selector/');?>
		
		<div class="row">
		<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Search For:</label>
		<select name="category_id" class="form-control selectboxit" onchange="select_result(this.value)">
		<option value="">Select</option>
		<?php
		$category = $this->db->get('tbl_lib_category')->result_array();
		foreach($category as $row):                        
		?>                
		<option value="<?php echo $row['category_id'];?>"><?php echo $row['category'];?></option>            
		<?php endforeach;?>
		</select>
		</div>
		</div>
		
		<div id="get_result">
		
		<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Search:</label>
		<select class="form-control selectboxit" name="results_id">
		<option value="">Select</option>
		</select>
		</div>
		</div>
		</div>
		
		<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info">View</button>
		</div>
		</div>
		</div>
		</div></div>
		<?php echo form_close();?>			
		
		
		<?php include_once APPPATH . 'views/footer.php'; ?>
		<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-timepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/bootstrap-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/ace-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>
		
		<!-- ace scripts -->
		
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		
		<script type="text/javascript">
		
		function select_result(category_id) 
		{
		$.ajax({
		url: '<?php echo base_url();?>index.php/Library/get_data/'+ category_id,
		success: function (response)
		{
		jQuery('#get_result').html(response);
		}
		});
		}
		</script>
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>  