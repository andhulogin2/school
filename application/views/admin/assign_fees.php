<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 

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
							<li class="active">Assign Fee</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Assign Fee 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Single Student
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
                                        <div></div>
                                        
                                        

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="class" id="class_selector_holder" class="col-xs-10 col-sm-5" required="" onChange="return get_class_sections(this.value)">
            <option value="">Select</option>
            <?php
            $classes = $this->db->get('class')->result_array();
            foreach($classes as $row): ?>
            <option value="<?php echo $row['class_id'];?>">		<?php echo $row['name'];?>    </option>
            <?php endforeach;  ?>
        </select>
    </div> 
</div>
<br /><br />
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section  <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="section" onChange="get_details()"  class="col-xs-10 col-sm-5" id="section_selector">
       	 <option value="0">Select</option>
        </select>
   </div>
 </div>

<div class="row" id="absent_student"></div>


                                    

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>




<script type="text/javascript">
	function get_class_sections(class_id) 
	{
		jQuery('#absent_student').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector').html(response);
            }
        });
    }
</script>
<script type="text/javascript">	
 function get_details(){
	 jQuery('#absent_student').html("");
        var classid = $('#class_selector_holder').val();
        var section = $('#section_selector').val();
		console.log(section);
		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_details/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent_student').html(response);
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
