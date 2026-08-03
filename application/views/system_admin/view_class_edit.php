<?php include_once APPPATH . 'views/head.php';?>
 


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
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Edit
								
									<i class="ace-icon fa fa-angle-double-right"></i>
								Class
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                     <?php echo form_open('Admin/edit_class', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
                                     
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name" value="<?php echo $a;?>" class="col-xs-10 col-sm-5" name="name" />
                                            
										</div>
									</div>
                          											<input type="hidden" id="cls_id" value="<?php echo $class_id;?>" class="col-xs-10 col-sm-5" name="cls_id" />

									

								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                   
                                    <?php echo form_close(); ?>
                                    

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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function a(){
swal("Successfull");


}
</script>