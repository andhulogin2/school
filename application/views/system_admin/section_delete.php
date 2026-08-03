<?php include_once APPPATH . 'views/head.php';?>
<?php $running_year = get_running_year(); ?>

 

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
							<li class="active">Settings</li>
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
								SETTINGS
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									General Settings
								</small>
							</h1>
						</div>


<?php echo form_open(base_url() . 'index.php/admin/delete_section_bulk/');?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class</label>
			<select name="class_id" class="form-control selectboxit" onChange="select_section(this.value)">
				<option value="">Select</option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):                        
				?>                
				<option value="<?php echo $row['class_id'];?>"
					><?php echo $row['name'];?></option>            
				<?php endforeach;?>
			</select>
		</div>
	</div>

    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Section</label>
			<select class="form-control selectboxit" name="section_id">
            <option value="">Select</option>
			</select>
		</div>
	</div>
    </div>
	
    

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info">Delete</button>
	</div>
</div>
<?php echo form_close();?>
</div>
</div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Deleted Successfully...', 'Deleted', {timeOut: 5000})</script>";
}

?>
