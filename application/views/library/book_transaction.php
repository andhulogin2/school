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
							<li class="active">Transaction</li>
                            <li class="active">Book Transaction</li>
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
		<h1>View<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Book Transaction
		</small>
		</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
<?php echo form_open(base_url() . 'index.php/library/book_transaction',array('class'=>'form-horizontal form-groups-bordered validate', 'enctype'=>'multipart/form-data'));?>
					


<div >
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Book Name: </label>
        <div class="col-sm-3">
            <input type="text" required id="book_id" name="book_id" class="form-control"  />
        </div>
          <button onClick="get_details(); return false;" class="btn btn-info">Search</button>
    </div>
</div>
<div id="books" >     
</div>
<br /><br />
	  
<?php echo form_close();?>
                        </div></div></div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/jquery-2.1.1.min.js" type="text/javascript"></script>

 

<link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet"/>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<script type="text/javascript">
function get_details(member_id)
{
      var book_id = $('#book_id').val();
      $.ajax({
	    	url: '<?php echo base_url();?>index.php/library/get_book_transaction_ajax/' + book_id ,
            success: function(response)
            {
				console.log(response);
                jQuery('#books').html(response);
            }
   	});
}
</script>
