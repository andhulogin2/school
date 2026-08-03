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
							<li class="active">Fee Head</li>
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
								Create 
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Special Fee Head
								</small>
							</h1>
                           
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                        <div style="text-align:right;padding-right:20px;">
                        	<a href="<?php echo base_url().'index.php/FeeManagement/view_special_fee_head'; ?>" ><button class="btn-info">Back</button></a>
                        </div>                
                     <?php echo form_open('FeeManagement/insert_special_fee_heads/', array('class' => 'form-horizontal'));
					 ?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Head Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="fee_head"  class="col-xs-10 col-sm-5" name="fee_head" required />
										</div>
									</div>
                                  
                                    <input type="hidden" id="fee_category_id"  class="col-xs-10 col-sm-5" name="fee_category_id" value="2" >										
									
				
                              

								
                                 
                                     
									
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit"  class="btn btn-info" type="button" value='Submit'> 
											
										</div>
                                         <?php echo form_close(); ?>
									</div>
                                    </div>
                                    </div>
                                   
                                    

												
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="failed")
{
echo "<script>toastr.error('". "Not Added...', 'Sorry...', {timeOut: 5000})</script>";
}
?>

