<?php include_once APPPATH . 'views/main_head.php';?>
<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li><a href="#">Home</a></li>
                            <li class="active">Sales</li>
						</ul><!-- /.breadcrumb -->

						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Sales 
                              
                                <i class="ace-icon fa fa-angle-double-right"></i>
									 View
                                
							</h1>
						</div><!-- /.page-header -->
                     
					  <!-- PAGE CONTENT BEGINS -->

<div class="col-md-12">

      <?php
        if($message = $this->session->flashdata('message')){
      ?>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <button class="close" data-dismiss="alert" type="button">×</button>
              <?php echo $message; ?>
            <div class="alerts-con"></div>
          </div>
        </div>
      <?php
        }
      ?>
      
<div align="right" style="padding-right:10px;padding-bottom:10px"><a href="<?php echo base_url() . 'index.php/Stock_management/sales_add/' ?>"><button class="btn-info">New Entry</button></a>
</div> 
<div class="table-header">
<center>List Sales</center>
</div>

<div class="clearfix">
</div>


<table id="search-table" class="table table-striped table-bordered table-hover">
<thead>

<tr>
                  <th>No</th>
                  <th>Sales Date</th>
                  <th>Student</th>
                  <th>Total</th>
                  <th>Discount</th>
                  <th>Grand Total</th>
                  <th>Action</th>
                 
</tr>
</thead>

 <tbody>
                  <?php 
				  $count = 1;
                      foreach ($data as $row) {
                         $id= $row->sales_master_id;
                    ?>
                    <tr>
                      <td><center><?php echo $count++;?></center></td>
                      
                      <td><center><?php echo date('d-m-Y',strtotime($row['sales_date']));?></center></td>                                      
                      <td><center><?php echo $row['name'];?></center></td>
                      <td><center><?php echo $row['bill_amount'];?></center></td>
                      <td><center><?php echo $row['discount_allowed'];?></center></td>
                      <td><center><?php echo $row['net_amount'];?></center></td>
                      <td>
                             
                      <a href="<?php echo base_url('index.php/stock_management/view_stock_details/');?><?php echo $row['sales_master_id']; ?>"><i class="fa fa-file-text-o" title="Sales details"></i></a>
                             
                             
      <a href="<?php echo base_url('index.php/stock_management/edit_sales/'); ?><?php echo $row['sales_master_id']; ?>"><i class="fa fa-edit" title="Edit Sales"></i></a>
                             
                             
                                <a href="<?php echo base_url('index.php/stock_management/pdf_sales/');?><?php echo $row['sales_master_id']; ?>" target="_blank  "><i class="fa fa-file-pdf-o" title="Download as PDF"></i></a>
                             
                                <a href="<?php echo base_url('index.php/stock_management/delete_sales_master/');?><?php echo $row['sales_master_id']; ?>"  onClick="return confirm('Are you sure to delete this entry?');"  ><i class="fa fa-close text-danger" title="Delete"></i></a>
                               
                             
                             
                           
                      </td>
                    <?php
                      }
                    ?>
</tbody>
</table>

</div>
</div>
</div>
</div>

<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
</script>

<script type="text/javascript">
if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jqGrid/jquery.jqGrid.src.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jqGrid/i18n/grid.locale-en.js"></script>

<script>
function saveData(editableObj,column,id) {
$(editableObj).css("background","#FFF url(loader.gif) no-repeat right");
$.ajax({
url: "saveedit.php",
type: "POST",
data:'column='+column+'&editval='+editableObj.innerHTML+'&book_stream_id='+book_stream_id,
success: function(data){
$(editableObj).css("background","#FDFDFD");
}        
});
}
</script>


<script type="text/javascript">
jQuery(function($) {
					var oTable1 = 
					$('#search-table').dataTable({
					bAutoWidth   : false,
					"aoColumns"  : [
					{"bSortable" : false},
					null,null,null,null,null,
					{"bSortable" : false },
					],
					"aaSorting"  : [],
					});
					
					TableTools.classes.container = "btn-group btn-overlap";
					TableTools.classes.print     = {
					                                "body": "DTTT_Print",
					                                "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
					                                "message": "tableTools-print-navbar"
					                                }
					
					var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, 
					                      {
					                       "sSwfPath": "<?php echo base_url(); ?>/assets/js/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",	
										   "sRowSelector": "td:not(:last-child)",
										   "sRowSelect": "multi",
										   "fnRowSelected": function(row) {
					try { $(row).find('input[type=checkbox]').get(0).checked = true }
					catch(e) {} },
					"fnRowDeselected": function(row) {
					try { $(row).find('input[type=checkbox]').get(0).checked = false }
					catch(e) {} },
					
					"sSelectedClass": "success",
					"aButtons"      : [{
					                    "sExtends"    : "copy",
										"sToolTip"    : "Copy to clipboard",
										"sButtonClass": "btn btn-white btn-primary btn-bold",
										"sButtonText" : "<i class='fa fa-copy bigger-110 pink'></i>",
					"fnComplete": function() {
					this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
					<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
					1500
					);
					}
					},
					
										{
										 "sExtends"    : "csv",
										 "sToolTip"    : "Export to CSV",
										 "sButtonClass": "btn btn-white btn-primary  btn-bold",
										 "sButtonText" : "<i class='fa fa-file-excel-o bigger-110 green'></i>"
										},
										
										{
										 "sExtends"    : "pdf",
										 "sToolTip"    : "Export to PDF",
										 "sButtonClass": "btn btn-white btn-primary  btn-bold",
										 "sButtonText" : "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
										},
										
										{
										 "sExtends"    : "print",
										 "sToolTip"    : "Print view",
										 "sButtonClass": "btn btn-white btn-primary  btn-bold",
										 "sButtonText" : "<i class='fa fa-print bigger-110 grey'></i>",
										 "sMessage"    : "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand'><small> Available Book Stream </small></a></div></div>",
										
										"sInfo"        : "<h3 class='no-margin-top'>Print view</h3>\
										<p>Please use your browser's print function to\
										print this table.\
										<br />Press <b>escape</b> when finished.</p>",
										}
					                   ]
					               } );
					$(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
 					setTimeout(function() {
					$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
					var div = $(this).find('> div');
					if(div.length > 0) div.tooltip({container: 'body'});
					else $(this).tooltip({container: 'body'});
					});
					}, 200);
					
					var colvis = new $.fn.dataTable.ColVis( oTable1, {
					"buttonText": "<i class='fa fa-search'></i>",
					"aiExclude" : [0, 3],
					"bShowAll"  : true,
					//"bRestore": true,
					"sAlign"    : "right",
					"fnLabel"   : function(i, title, th) {
					return $(th).text();
					}
					}); 
					
					$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
					$(colvis.button())
					.prependTo('.tableTools-container .btn-group')
					.attr('title', 'Show/hide columns').tooltip({container: 'body'});
					$(colvis.dom.collection)
					.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
					.find('li').wrapInner('<a href="javascript:void(0)" />') 
					.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
					
					$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
					
					$('#search-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;
					
					$(this).closest('table').find('tbody > tr').each(function(){
					var row = this;
					if(th_checked) tableTools_obj.fnSelect(row);
					else tableTools_obj.fnDeselect(row);
					});
					});
					
					$('#search-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(!this.checked) tableTools_obj.fnSelect(row);
					else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
					});
					
					$(document).on('click', '#search-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
					});
					
					/********************************/
					$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
					
					
					function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1    = $parent.offset();
					var w1      = $parent.width();
					
					var off2    = $source.offset();
					//var w2    = $source.width();
					
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
					}
					});
</script>



<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>



	<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('<?php echo $this->lang->line('product_delete_conform'); ?>'))
     {
        window.location.href='<?php  echo base_url('sales/delete/'); ?>'+id;
     }
  }
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if($action=="deleted")
{
echo "<script>toastr.success('". "Deleted successfully...', 'Deleted', {timeOut: 5000})</script>";
}
else if($action=="not_deleted")
{
echo "<script>toastr.error('". "Deletion failed...', 'Not deleted', {timeOut: 5000})</script>";
}
$action = $this->session->flashdata('action');
if ($action=="Updated")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "Updation failed...', 'Not updated', {timeOut: 5000})</script>";
}
?>
