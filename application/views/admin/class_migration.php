<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?><body>
        
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
     <div class="col-md-2">
          <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch</label>
						<div >
							<select name="branch" id="branch" class="form-control" required="" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                             <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
					  </select>
						</div> 
					</div></div>
     <div class="col-md-2">
          <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department </label>
						<div >
							<select name="department" id="department" class="form-control" required="" >
                              <option value="">Select</option>
                              
					  </select>
						</div> 
					</div></div>
                    
                    <div class="col-md-2">
					<div class="form-group">
						<label for="field-2" class=" control-label">Academic Year</label>
		                    <div >
		                        <select name="academic_year"  class="form-control" id="academic_year" onChange="return get_class(this.value)">
		                            <option value="0">Select</option>
                                    <?php 
									$this->db->where('is_deleted','N');
									$year=$this->db->get('tbl_academic_year')->result_array();
							  foreach ($year as $year1)
							  {
							  ?><option value="<?php echo $year1['acdemic_year_id'];?>"><?php echo $year1['academic_year'];?></option>
                              <?php }?>
			                    </select>
			                </div>
					</div>
</div>
    <div class="col-md-2">
          <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class </label>
						<div >
							<select name="class" id="class_selector_holder" class="form-control" required="" onChange="get_class_sections(this.value)">
                              <option value="">Select</option>
                              
					  </select>
						</div> 
					</div>
    </div>  <div class="col-md-2">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
		                        <select name="section"  class="form-control" id="section_selector_holder" onChange="get_details()">
		                            <option value="0">Select</option>
			                    </select>
			                </div>
					</div>
</div>

 
</div>
<div class="row" id="absent">
</div>
    
</div>

</div></div></div></body>
<?php include_once APPPATH . 'views/footer.php'; ?>




<script type="text/javascript">	
 function get_details(){
	 jQuery('#absent').html("");
        var classid = $('#class_selector_holder').val();
        var section = $('#section_selector_holder').val();
		var academic_year = $('#academic_year').val();
		var branch = $('#branch').val();
		var department = $('#department').val();
		//var date = $("#timestamp").val();
		//console.log(date);
		if(section == "0" || section == ""){
			return false;
		}
		else
		{
       $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/migrate_check/' + classid + '/' + section + '/' + academic_year + '/' + branch + '/' + department ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent').html(response);
            }
   });
   }
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Migrated Successfully...', 'Migrated', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	
	function get_class(year) 
	{
	var dept_id = $('#department').val();
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id +'/'+year,
            success: function(response)
            {
                jQuery('#class_selector_holder').html(response);
            }
        });
    }
	
	function get_class_sections(class_id) 
	{
	//alert(class_id);
	var year = $('#academic_year').val();
	//alert(year);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id+'/'+year ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }

	
</script>


