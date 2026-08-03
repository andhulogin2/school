<?php include_once APPPATH . 'views/library_head.php';?>
 

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
							<li class="active">Report</li>
                            <li class="active">Due Report</li>
						</ul>
                        <form class="form-search">
								<span class="input-icon">
									
								</span>
							</form><!-- /.breadcrumb -->

						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                       <div class="page-header">
		<h1>View<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Due Report
		</small>
		</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
					
<div class="form-group">
    <label for="field-2" class="col-sm-3 control-label">Due On 
    <font color="#FF0000">*</font></label>
        <div class="col-sm-5">
             <input type="text" id="due_date" name="due_date" class="col-xs-10 col-sm-10 mydatepicker" required="" value="<?php echo date('d-m-Y'); ?>"/>
        </div>
</div>
                    
<div class="form-group">

    <div class="col-sm-offset-3 col-sm-5">
         <button type="submit" onClick="get_due_report();" class="btn btn-info">Show Due Report</button>
    </div>
</div> 

 <br><br><br>
<br>
<div id="due_report">
</div>

</div></div> </div>
</body>
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">	
 function get_due_report(){
 var due_date = document.getElementById("due_date").value;
       $.ajax({
	    url: '<?php echo base_url();?>index.php/library/due_report/' + due_date ,
            success: function(response)
            {
				console.log(response);
                jQuery('#due_report').html(response);
            }
   });
}
</script>

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
