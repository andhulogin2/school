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
		<li class="active">Report</li>
        <li class="active">Fine Report</li>
		</ul>
		<!-- /.breadcrumb -->
		
		
		<!-- /section:basics/content.searchbox -->
		</div>
		
		<!-- /section:basics/content.breadcrumbs -->
		<div class="page-content">
		
		<div class="page-header">
		<h1>
		Report
		<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Fine Report
		</small>
		</h1>
		</div>
     <br />
       
<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
		<div class="table-header">
   Fine Details
</div>
<br />
	
<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Fine Collected:</label>
        <div class="col-sm-6">
         <table>
        <tr><td>From&nbsp;</td><td><input type="text" id="due_date1" name="due_date1" class="col-xs-10 col-sm-10 mydatepicker" required="" value="<?php echo date('d-m-Y'); ?>"/></td>
         <td>To&nbsp;</td><td><input type="text" id="due_date2" name="due_date2" class="col-xs-10 col-sm-10 mydatepicker" required="" value="<?php echo date('d-m-Y'); ?>"/></td>
         <td><button onclick="get_fine_details();" class="btn btn-info">Show</button></td></tr>
         </table>
        </div>
</div><br /><br />

<div id="fine1" >     
</div>

<br /><br /><br />
			
		<!-- basic scripts -->
<script type="text/javascript">	
 function get_fine_details(){
 var due_date1 = document.getElementById("due_date1").value;
 var due_date2 = document.getElementById("due_date2").value;
 
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/get_fine_report_ajax/' + due_date1+ '/' + due_date2 ,
            success: function(response)
            {
				console.log(response);
                jQuery('#fine1').html(response);
            }
   });
}
</script>

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
		
		<!-- inline scripts related to this page -->
		
        <?php include_once APPPATH . 'views/footer.php'; ?>		<!-- ace scripts -->
		<script type="text/javascript"> ace.vars['base'] = '<?php echo base_url(); ?>'; </script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.onpage-help.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.onpage-help.js"></script>
        
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	</script>  
     