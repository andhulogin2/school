<?php include_once APPPATH . 'views/library_head.php';?><body>
        
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
							<li class="active">Fine Settings</li>
						</ul>
                         <form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
                        <!-- /.breadcrumb -->

						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                       <div class="page-header">
		<h1>Fine Settings<small>
		
		</small>
		</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<?php echo form_open(base_url() . 'index.php/library/insert_fine',array('class'=>'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>
					

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Member Category: </label>
        <div class="col-sm-3">
            <select class="form-control selectboxit"  name="member_type" id="member_type" >
                <option value="1">Student</option> 
<!--				<?php
                foreach($member as $r)
                {
                ?>	
                <option value="<?php echo $r['member_type_id']; ?>"> <?php echo $r['member_type']; ?></option> 
                <?php } ?>           
-->            </select>
        </div>
    </div>
<?php
foreach($fine as $finedata)
{
?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fine for a Day (Rs.):   <font color="#FF0000">*</font></label></label>   

<div class="col-sm-5">
<input type="text" id="fine" name="fine" value="<?php echo $finedata['fine_amount_per_day']; ?>" class="form-control" required >
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Days Without Fine:   <font color="#FF0000">*</font></label></label>   

<div class="col-sm-5">
<input type="text" name="days_without_fine" value="<?php echo $finedata['number_of_days_without_fine']; ?>" class="form-control" required >
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Maximum Books Can Take:   <font color="#FF0000">*</font></label></label>   

<div class="col-sm-5">
<input type="text" name="max_books" value="<?php echo $finedata['maximum_books_can_take']; ?>" class="form-control" required >
</div>
</div>
 <?php
 }
 ?>

  <br/>                  
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
         <button type="submit" class="btn btn-info">Edit</button>
    </div>
</div> 
 
 <script> 
  function get_data(member_id){
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_fine_ajax/' + member_id  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#fine_setting').html(response);
            }
   });
}

 </script>
<?php echo form_close();?>
                        </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/jquery-2.1.1.min.js" type="text/javascript"></script>

 

<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

      <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        
<?php
if(isset($action))
{
if ($action=="success")
{
echo "<script>toastr.success('". "set successfully...', {timeOut: 5000})</script>";
}
else if ($action=="failed")
 {
echo "<script>toastr.success('". "Failed...', {timeOut: 5000})</script>"; 
}
}

?>
