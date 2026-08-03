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
		Books 
		</small>
		</h1>
		</div>
     <br />
       <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Library/add_new_book/'; ?>"><button class="btn-info">New Book</button></a>&nbsp;<a href="<?php echo base_url() . 'index.php/Library/add_bulk_book/'; ?>"><button class="btn-info">Bulk Book</button></a></div> 
<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">
   VIEW BOOK
</div>
<?php echo form_open(base_url() . 'index.php/Library/issue_book_data/' ); ?>
    <h2></h2>
<div style="text-align:center">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Search By: </label>
        <table><tr><td>
            <select name="search_by" id="search_by" class="form-control">
            <option value="book_name">Book Name</option>
            <option value="book_number">Book Number</option>
            <option value="author_name">Author Name</option>
            <option value="book_language_name">Book Language</option>
            <option value="isbn">ISBN</option>
            </select></td>
             <td><input type="text" id="book_id" name="book_id" class="form-control"  /></td>
<td> <button class="btn btn-info"  onclick="get_details(); return false;" >Search</button></td></tr></table>
 &nbsp;&nbsp;
   </div>
 </div>
 <br /><br />

<div id="book1" >     
</div>
<br /><br />

&nbsp;&nbsp;
</div></div>
</div>
</div></div>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>       


<script type="text/javascript">	
 function get_details(){
 
         var search_by = $('#search_by').val();
         var book_id = $('#book_id').val();

       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_search_book_details_ajax/' + book_id+ '/' + search_by ,
            success: function(response)
            {
				console.log(response);
                jQuery('#book1').html(response);
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
echo "<script>toastr.success('". "Updated successfully...', {timeOut: 5000})</script>";
}
else if ($action=="failed")
 {
echo "<script>toastr.success('". "Updation failed...', {timeOut: 5000})</script>"; 
}

?>



		<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
        <?php include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
		<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>
        
        