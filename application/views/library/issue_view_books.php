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
		<li class="active">Issue Book</li>
		</ul>
		<!-- /.breadcrumb -->
		
		
		<!-- /section:basics/content.searchbox -->
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
		
		<div class="page-header">
		<h1>
		View
		<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Issue 
		</small>
		</h1>
		</div>
     <br />
       
<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">
   ISSUE BOOK
</div>
<?php echo form_open(base_url() . 'index.php/Library/issue_book_data/' ); ?>
    </h2>
    <div >
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Member Category: </label>
        <div class="col-sm-3">
            <select class="form-control selectboxit"  name="member_type" id="member_type">
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
</div>
<br/></br>
<?php
foreach($fine as $r)
{
?>	
<input type="hidden" name="days_without_fine" value="<?php echo $r['number_of_days_without_fine']; ?>" />
<?php } ?>
<div >
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Search Members: </label>
        <div class="col-sm-3">
            <input type="text" required id="member_id" name="member_id" data-placeholder="Choose an id..." class="form-control"  />
        </div>
          <button onclick="get_details(); return false;" class="btn btn-info">Search</button>
    </div>
</div>
<div id="student1" >     
</div>
<br /><br />

</div></div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>       


<script type="text/javascript">	
 function get_details(member_id){
          var member_id = $('#member_id').val();
          var member_type = $('#member_type').val();
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_student_details_ajax/' + member_id +'/' + member_type ,
            success: function(response)
            {
				console.log(response);
                jQuery('#student1').html(response);
            }
   });
}
</script>
	

   
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

     <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
        
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Issued successfully...', {timeOut: 5000})</script>";
}
else if ($action=="failed")
 {
echo "<script>toastr.success('". "Issued failed...', {timeOut: 5000})</script>"; 
}

?>



<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
        <?php include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
		<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>
        
        