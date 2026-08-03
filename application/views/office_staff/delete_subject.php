<?php include_once APPPATH . 'views/main_head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
        	<div class="main-content col-md-10">
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
							<li class="active">Delete Subject</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Settings
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Delete Subject
								
							</h1>
						</div>

<?php echo form_open(base_url() . 'index.php/admin/delete_subject_bulk');?>
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onChange="get_class_subject(this.value)">
				<option value="">Select</option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
        <div id="subject_holder">
       
	    <div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;">Subject</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value="0">Select-Class</option>		
				</select>
			</div>
		</div>
         
        <div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled">Delete</button>
			</center>
		</div>
	</div>
 </div>
<?php echo form_close();?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
	function get_class_subject(class_id) {
	 	
		$.ajax({
		 
            url: '<?php echo base_url();?>index.php/admin/marks_get_subject_delete/' + class_id ,
			
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			});
			/*$.ajax({
		url: '<?php echo base_url();?>index.php?admin/get_unit_test/' + class_id ,
            success: function(response)
            {
                jQuery('#exam_id').html(response);
            }
            });*/
	}
</script>
 <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Deleted Successfully...', 'Deleted', {timeOut: 5000})</script>";
}

?>
