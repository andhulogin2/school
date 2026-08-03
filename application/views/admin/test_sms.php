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
							<li class="active">Edit Section</li>
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
					<?php echo form_open_multipart('Admin/test_message_submit', array('class' => 'form-horizontal'));?>
    					<div>Class:
        					<select name="class_id" >
        					    <option value="">Select Class</option>
        					    <?php
        					    foreach($class as $row):
        					        ?>
        					    <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>     
        					        <?php
        					    endforeach;     
        					    ?>
        					</select>
    					</div>
    					<br>
    					<div>
    					    Message:
    					    <textarea name="message"></textarea>
    					</div>
    					<br>
    					<div>
    					    Image
    					    <input type="file" name="image" />    
    					</div>	
    					 <input type="submit" class="btn btn-info" type="button" value='Send' name="save"> 
					</div><!-- /.row -->
					<?php echo form_close(); ?>
				</div><!-- /.page-content -->
			</div>
			<!-- /.main-content -->
</body>        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>
