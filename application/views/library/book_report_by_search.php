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
					<li class="active">Reports</li>
					<li class="active">Book Report</li>
				</ul>
			</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
		
			<div class="page-header">
			<h1>
			View
			<small>
			<i class="ace-icon fa fa-angle-double-right"></i>
			Book Report 
			</small>
			</h1>
			</div>
			 <br />
			 <?php echo form_open('Library/download_book_details');?>
			   <div align="right" style="padding-right:10px"><a href="#"><button class="btn-info">PDF</button></a></div> 
			
			<div class="clearfix">
				<div class="pull-right tableTools-container"></div>
			</div>
			<div class="table-header">
			   VIEW BOOKS
			</div>
			<br />

			<div class="form-group">
					<div class="col-sm-2 col-xs-12">
				   Author Name
					<select id="author" name="author"  class="select2" onchange="test(event);">
					<option value="0">All</option>
					<?php
						$author = $this->db->get('tbl_lib_authors')->result_array();
						foreach($author as $row11){
					?>
						<option value="<?php echo $row11['author_id']; ?>" ><?php echo $row11['author_name']; ?></option>
						<?php } ?>
					</select>
				</div>
				
				<div class="col-sm-2 col-xs-12">
					Language
					<select id="language" name="language"  class="select2" onchange="test(event);">
					<option value="0">All</option>
					<?php
						$language = $this->db->get('tbl_lib_book_language')->result_array();
						foreach($language as $row2){
					?>
						<option value="<?php echo $row2['book_language_id']; ?>" ><?php echo $row2['book_language_name']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div class="col-sm-2 col-xs-12">
					Category
					<select id="category" name="category"  class="select2" onchange="test(event);">
					<option value="0">All</option>
					<?php
						$language = $this->db->get('tbl_lib_book_category')->result_array();
						foreach($language as $row2){
					?>
						<option value="<?php echo $row2['book_category_id']; ?>" ><?php echo $row2['book_category_name']; ?></option>
						<?php } ?>
					</select>
				</div>
				<?php echo form_close(); ?>
				<br /><br /><br /><br />
				</div>
			
			
			<table id="bookTable" class="table table-striped table-bordered table-hover">
			<thead>
			<tr>
				<th style="text-align: center;">SlNo	</th> 
				<th style="text-align: center;">Book Number	</th>
				<th style="text-align: center;">Book Name	</th>
				<th style="text-align: center;">Author Name	</th>
				<th style="text-align: center;">Category	</th>
				<th style="text-align: center;">Language	</th>
			</tr>
			</thead>
			</table>
			 <br /><br />
			
			</div></div>
	</div>
</div></div>
</div>
        <?php include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>       
<script type="text/javascript">
	window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
        
<?php
if(isset($action)){
if ($action=="success")
{
echo "<script>toastr.success('". "Updated successfully...', {timeOut: 5000})</script>";
}
else if ($action=="failed")
 {
echo "<script>toastr.success('". "Updation failed...', {timeOut: 5000})</script>"; 
}
}
?>

<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
<script type="text/javascript">
$(function() {
$('#bookTable').dataTable({ stateSave: true,
              "aLengthMenu": [[25, 100, 250, -1], [25, 100, 250, "All"]],
        "iDisplayLength": 25, 
        // Processing indicator
        "processing": true,
        // DataTables server-side processing mode
        "serverSide": true,
        // Initial no order.
        "order": [],
        // Load data from an Ajax source
        "ajax": {
            "url": "<?php echo base_url(); ?>index.php/Library/getBook_details_ajax1",
            "type": "POST",
             "data":function(d){
                 d.author=$("#author").val()
                 d.language=$("#language").val()
                 d.category=$("#category").val()
             },
        },
        //Set column definition initialisation properties
        "columnDefs": [{ 
            "targets": [0],
            "orderable": false
        }]
	});
});

function test(event){
$('#bookTable').DataTable().ajax.reload();
}
</script>

        
        