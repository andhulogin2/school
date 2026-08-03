<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
		<div class="table-header">
   Books
</div>
			
    <?php $i=1;?>							
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
  	<th style="text-align: center;">SlNo	</th> 
    <th style="text-align: center;">Book Number	</th>
    <th style="text-align: center;">Book Name	</th>
	<th style="text-align: center;">Author Name	</th>
	<th style="text-align: center;">Category	</th>
	<th style="text-align: center;">Language	</th>
    <th style="text-align: center;">Status	</th>
    <th style="text-align: center;">Actions	    </th>
</tr>
</thead>
<tbody>
<?php
$count = count($bookdata);
if($count>0)
{
$i=1;
foreach($bookdata as $book)
{
?>
<tr id="row<?php echo $book['book_master_id']?>"> <td  style="text-align: center;"> <?php echo $i; ?> </td> 
<td  style="text-align: center;" id="book_number<?php echo $book['book_master_id']?>"><?php if( $book['book_number']==null) echo '-'; else echo $book['book_number'];?> </td> 
<td  style="text-align: center;" id="book_name<?php echo $book['book_master_id']?>"> <?php if( $book['book_name']==null) echo '-'; else echo $book['book_name'];?>    </td> 
<td  style="text-align: center;" id="book_stream_name<?php echo $book['book_master_id']?>"><?php if( $book['author_name']==null) echo '-'; else echo $book['author_name'];?>  </td> 
<td  style="text-align: center;" id="book_category_name<?php echo $book['book_master_id']?>"> <?php if( $book['book_category_name']==null) echo '-'; else echo $book['book_category_name'];?> </td> 
<td  style="text-align: center;" id="book_language_name<?php echo $book['book_master_id']?>"><?php if( $book['book_language_name']==null) echo '-'; else echo $book['book_language_name'];?>  </td>
<?php if($book['is_available']=='N') 
{ 
?>
<td id="<?php echo $book['book_master_id']?>">
<span class="red" id="status" style="width:500px" ><font color="#FF0000"> NOT AVAILABLE </font> </span>
</td>
<?php 
}
elseif($book['is_available']=='Y') 
{ 
?>
<td id="<?php echo $book['book_master_id']?>">
<span class="red" id="status" style="width:500px" > <font color="#006600"> AVAILABLE </font>  </span>
</td>
<?php } ?>
<td style="text-align:center;" > 

			<a href="<?php echo base_url(); ?>index.php/Library/edit_book_details/<?php echo $book['book_master_id'];?>" class="tooltip-success" data-rel="tooltip" title="Edit" ">
              <span class="blue"><i class="ace-icon fa fa-pencil bigger-120"></i></span></a>
              
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" id="delete_inline<?php echo $book['book_master_id']; ?>"  class="tooltip-success" data-rel="tooltip" title="Delete" onClick="deleteBook(<?php echo $book['book_master_id']; ?>);">
          <span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a>					
    </td>
</tr>
<?php
$i=$i+1;
 }
 }
else
{
?>
<tr>
<td colspan="8" align="center">
<font color="#FF0000"> No Books Available </font></td>
</tr>
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
        
		<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
		<!-- inline scripts related to this page -->
<!--		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var oTable1 = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null,null,null,null,null,null,
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
							
							"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small> Book Details</small></a></div></div>",
							
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
				/////////////////////////////////
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
			
			
			function showEdit(id) {
		          

 					var book_number = document.getElementById("book_number"+id);
					 var book_name = document.getElementById("book_name"+id);
					  var book_category_name = document.getElementById("book_category_name"+id);
					   var book_stream_name = document.getElementById("book_stream_name"+id);
					    var book_language_name = document.getElementById("book_language_name"+id);
					    		book_number.contentEditable = "true";
					    		book_name.contentEditable = "true";
					    		book_category_name.contentEditable = "true";
					    		book_stream_name.contentEditable = "true";
					    		book_language_name.contentEditable = "true";
					    		book_number.focus();

$('#edit_inline'+id).css('display','none');
$('#save_inline'+id).css('display',"");
		        } 
		         
				    
		function saveBook(id) {
					var book_master_id = id;
					 var book_number = document.getElementById("book_number"+id).innerText;
					 var book_name = document.getElementById("book_name"+id).innerText;
					 var book_category_name = document.getElementById("book_category_name"+id).innerText;
					 var book_stream_name = document.getElementById("book_stream_name"+id).innerText;
					 var book_language_name = document.getElementById("book_language_name"+id).innerText;
		    		//$(id).css("background","#FFF url(<?php echo base_url('/assets/images/');?>loaderIcon.gif) no-repeat right");
		    		$.ajax({
		       		url: "<?php echo base_url()?>index.php/Library/edit_book",
		       		type: "POST",
		        	data:'&book_master_id='+book_master_id+'&book_number='+book_number+'&book_name='+book_name+'&book_category_name='+book_category_name+'&book_stream_name='+book_stream_name+'&book_language_name='+book_language_name,
		        	success: function(data){
					 location.reload(false);
		            //$(editableObj).css("background","#FDFDFD");
		        	}        
		  			});
				}	
		
	
-->        			
<script>
			function deleteBook(id) {
					var confirmRes = confirm('Are you sure to Delete this record?');
					if(confirmRes == true)
					{
    					$.ajax({
    		       		url: "<?php echo base_url()?>index.php/Library/delete_book",
    		       		type: "POST",
    		        	data:'&id='+id,
    		        	success: function(data){
    		        	    
    		        		location.reload(false);
    		        	    }        
		  			    });
					}
		  			else
		  			{
		  			    return false;
		  			}
			}					
					
				
</script>	

			
				
        
        <?php //include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
		<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>
        
        