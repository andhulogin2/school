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
        <li class="active">Return Book</li>
		</ul>
		<!-- /.breadcrumb -->
		
		
		<!-- /section:basics/content.searchbox -->
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
		
		<div class="page-header">
		<h1>
		Return
		<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		 Book
		</small>
		</h1>
		</div>
     <br />
       
<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
		<div class="table-header">
    Books
</div>
<?php echo form_open(base_url() . 'index.php/Library/insert_return_book_data/' ); ?>
<div style="text-align:">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Book Name: </label>
        <div class="col-sm-3">
            <input type="text" required id="book_id" name="book_id" data-placeholder="Choose an id..." class="form-control" />
           <button class="btn btn-info" onclick="get_details(); return false;">Search</button>
          &nbsp;&nbsp;
        </div>
   </div>
</div><br />
<br />
<div id="book1" >     
</div>
	
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
		</script>

<script type="text/javascript">	
 function get_details(book_id){
           var book_id = $('#book_id').val();

       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_books_ajax/' + book_id ,
            success: function(response)
            {
				console.log(response);
                jQuery('#book1').html(response);
            }
   });
}
</script>

		<!-- <![endif]-->

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
echo "<script>toastr.success('". "Return successfully...', {timeOut: 5000})</script>";
}
else if ($action=="failed")
 {
echo "<script>toastr.success('". "Return failed...', {timeOut: 5000})</script>"; 
}


?>

<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
 <br /><br /><br />
<br />
       <?php include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
		<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>
        
        