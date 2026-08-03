<?php include_once APPPATH . 'views/main_head.php';?>
 

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
							<li class="active">New Class</li>
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
								Create 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Class
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
<div class="mail-compose">
    <div class="row">
    <div class="col-md-3">
          <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :</label>
						<div >
							<select name="class" id="class_selector_holder" class="form-control" required="" onChange="return get_class_sections(this.value)">
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
		                        <select name="section" onChange="get_details()"  class="form-control" id="section_selector_holder">
		                            <option value="0">Select</option>
			                    </select>
			                </div>
					</div>
</div>
 
</div>
<div class="row" id="absent">
</div>
    
</div>

</div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
		jQuery('#absent').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">	
 function get_details(){
	 jQuery('#absent').html("");
        var classid = $('#class_selector_holder').val();
        var section = $('#section_selector_holder').val();
		//var date = $("#timestamp").val();
		console.log(section);
		//console.log(date);
		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/migrate_check/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent').html(response);
            }
   });
}
</script>

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
				jQuery('#timestamp').datepicker().on('changeDate', function(e) {
				// `e` here contains the extra attributes
				get_details();
			});
        });
    </script>
