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
        <li class="active">Book Stream</li>
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
		Stream
		</small>
		</h1>
		</div>
		
        
       <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Library/add_bookstream/'; ?>"><button class="btn-info">New stream</button></a></div> 
       <br />
       
<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
		<div class="table-header">
   Stream
</div>
	
    <?php $i=1;?>							
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th style="text-align: center;"> SlNo	</th> 
    <th style="text-align: center;"> Stream Name	</th>
    <th style="text-align: center;"> Actions	</th>
 
    
</tr>
</thead>

<tbody>

<?php
$i=1;

foreach($streamdata as $stream)
{
?>
<tr>
   <td style="text-align: center;"> <?php echo $i; ?> </td>
   <td id="<?php echo $stream['book_stream_id']?>" style="text-align: center;"><?php if( $stream['book_stream_name']==null) echo '-'; else  echo $stream['book_stream_name'];?> </td>
   <td style="text-align: center;" >
      <a href="#" id="edit_inline<?php echo $stream['book_stream_id']?>"  class="tooltip-success" data-rel="tooltip" title="Edit" onClick="showEdit(<?php echo $stream['book_stream_id']; ?>);">
<span class="blue"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>
      <a href="#" id="save_inline<?php echo $stream['book_stream_id']?>" style="display:none;" class="tooltip-success" data-rel="tooltip" title="Save" onClick="saveBookstream(document.getElementById(<?php echo $stream['book_stream_id']?>),<?php echo $stream['book_stream_id']; ?>)">
      <span class="green"><i class="ace-icon fa fa-floppy-o bigger-120"></i></span></a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
     <a href="#" id="delete_inline" onClick="deleteBookStream(<?php echo $stream['book_stream_id'] ?>)" class="tooltip-success" data-rel="tooltip" data-placement="top" title="Delete" data-original-title="Delete"> <span class="red">
      <i class="ace-icon fa fa-trash-o bigger-120"></i> </span>
      </a>  					
  </td>
</tr>
<?php
$i=$i+1;
?>
<?php
 } 
?>



</tbody>
</table>
   
			
		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
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
echo "<script>toastr.success('". "Inserted successfully...', {timeOut: 5000})</script>";
}
else if ($action=="failed")
 {
echo "<script>toastr.success('". "Insertion failed...', {timeOut: 5000})</script>"; 
}

?>


		<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var oTable1 = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null,
					  { "bSortable": false }
					],
					"aaSorting": [],
			    } );

				TableTools.classes.container = "btn-group btn-overlap";
				TableTools.classes.print = {
					"body": "DTTT_Print",
					"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
					"message": "tableTools-print-navbar"
				}
			
				var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
					"sSwfPath": "<?php echo base_url(); ?>/assets/js/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf", //in Ace demo ../assets will be replaced by correct assets path
					
					"sRowSelector": "td:not(:last-child)",
					"sRowSelect": "multi",
					"fnRowSelected": function(row) {
						//check checkbox when row is selected
						try { $(row).find('input[type=checkbox]').get(0).checked = true }
						catch(e) {}
					},
					"fnRowDeselected": function(row) {
						//uncheck checkbox
						try { $(row).find('input[type=checkbox]').get(0).checked = false }
						catch(e) {}
					},
			
					"sSelectedClass": "success",
			        "aButtons": [
						{
							"sExtends": "print",
							"sToolTip": "Print view",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
							
							"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Stream Details</small></a></div></div>",
							
							"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
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
					"aiExclude": [0, 6],
					"bShowAll": true,
					//"bRestore": true,
					"sAlign": "right",
					"fnLabel": function(i, title, th) {
						return $(th).text();//remove icons, etc
					}
				}); 
				
				$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
				
				$(colvis.button())
				.prependTo('.tableTools-container .btn-group')
				.attr('title', 'Show/hide columns').tooltip({container: 'body'});
				
				$(colvis.dom.collection)
				.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
				.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
				.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				$('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) tableTools_obj.fnSelect(row);
						else tableTools_obj.fnDeselect(row);
					});
				});
				
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(!this.checked) tableTools_obj.fnSelect(row);
					else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
				});
					$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
				
				/********************************/
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			})
			
			
			  function showEdit(editableObj) {
		            var editableField = document.getElementById(editableObj);
		            editableField.contentEditable = "true";
		            editableField.style.background = "#FFF";
		            editableField.focus();
		            $('#edit_inline'+editableObj).css('display','none');
		            $('#save_inline'+editableObj).css('display','');
		        } 

			function saveBookstream(editableObj,id) {
		    		$(editableObj).css("background","#FFF url(<?php echo base_url('/assets/images/');?>loaderIcon.gif) no-repeat right");
		    		$.ajax({
		       		url: "<?php echo base_url()?>index.php/Library/edit_stream_il",
		       		type: "POST",
		        	data:'cname='+editableObj.innerHTML+'&id='+id,
		        	success: function(data){
		        		location.reload();
		            $(editableObj).css("background","#FDFDFD");
		        	}        
		  			});
				}
				function deleteBookStream(id) {
					var confirmRes = confirm('Are you sure to Delete this record?');
					if(confirmRes == true)
					{
					$.ajax({
		       		url: "<?php echo base_url()?>index.php/Library/delete_book_stream",
		       		type: "POST",
		        	data:'&id='+id,
		        	success: function(data){
		        		location.reload();
		        	}        
		  			});
					}
		  			else
		  			{
		  			return false;
		  			}
					}
		    		</script>
        
        <?php include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
		<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>
        
        