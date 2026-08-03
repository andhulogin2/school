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
		<li class="active">Books</li>
		<li class="active">New Language</li>
		</ul>
        <form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					</div>
		</div>
		
		<div class="page-content">
		
		<div class="page-header">
		<h1>Add<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Language
		</small>
		</h1>
      
         <br/>
        
		<div align="right" style="padding-right:100px"> 
		<a href="<?php echo base_url();?>index.php/library/view_book_language/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
		</div>
		</div>
        
        </div>
        
		<?php echo form_open('Library/add_book_language', array('class' => 'form-horizontal'));?>
		<br/>
        
		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Language Name :<font color="#FF0000">* </font></label>
		
		<div class="col-sm-8">
		<input type="text"  name="language_name" id="language_name"  placeholder="Language Name" class="col-xs-10 col-sm-5" required=""  onchange="return get_data(this.value)"/>
		<div class="form-group" id="absent1">
        </div>
		
		</div>
		</div>
        
		</div>
		</div>
		<?php echo form_close(); ?>
		</div>
		
		<?php include_once APPPATH . 'views/footer.php'; ?>
		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
		
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		
		<script type="text/javascript">	
		function get_data(){
    		jQuery('#absent1').html("");
    		var language = $('#language_name').val();
    		if(language!='')
    		{
        		$.ajax({
            		url: '<?php echo base_url();?>index.php/Library/get_data1/' +language,
            		success: function(response)
            		{
                		console.log(response);
                		jQuery('#absent1').html(response); 
            		}
        		});
    		}	
	    }
		</script>
		
