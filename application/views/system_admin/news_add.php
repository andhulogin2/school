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
							<li class="active">News</li>
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
								News
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add
								
							</h1>
						</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><font color="#FFFFFF">Send News</font>
            </div>
            <br>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/news/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                
                
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="Required" value="" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"></textarea>
                    </div>
                </div>
<div class="form-group">
<label for="field-1" class="col-sm-3 control-label">Photo</label>
                        
						<div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>           
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                            Send</button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
         </div></div></div></div></div></div></div>
    
<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  