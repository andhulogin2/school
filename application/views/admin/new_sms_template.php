<?php
 $role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
        
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
							<li class="active">Sms Template</li>
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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Sms Template
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add New
								</small>
							</h1>
						</div> 
                     
                    <div align="right" style="padding-right:80px"><a href="<?php echo base_url();?>index.php/Admin/sms_template"><button class="btn-info">Back</button></a></div>
                   <?php  echo form_open_multipart('Admin/sms_template_add', array('class' => 'form-horizontal'));?>
       
		     
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Title');?></label>
                    <div class="col-sm-8">
                    <div class="input-group">
                      <input type="text"  required="" name="title" id="title" placeholder="<?php echo get_phrase('title');?>">
                    </div>
                    </div>
                  </div>
      <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Content');?></label>
                    <div class="col-sm-8">
                    <div class="input-group">
                      <textarea id="content" name="content" class="form-control">
                      </textarea>
                    </div>
                    </div>
                  </div>
                 

    
						<div class="form-group">
						<div class="col-sm-offset-5 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
							<span id="preloader-form"></span>
						</div>
						</div>
						 <?php echo form_close();?>
                               
                </div>                
			</div>
			 </div>                
		
                                    
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
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
	

	
</script>

<script type="text/javascript">
	function get_branch(role) 
	{
	
	if(role==2)
	{
	$('#branch_role').hide();
	$('#dept_role').hide();
	}
	if(role==3)
	{
	$('#branch_role').show();
	$('#dept_role').hide();
	}
	if(role==4 || role==12)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==5)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==6)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
	if(role==7)
	{
	$('#branch_role').show();
	$('#dept_role').show();
	}
    }
	

	
</script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 	 
<script type="text/javascript">
    $(document).ready(function () {
        $('#dob').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
	 });
 </script>


