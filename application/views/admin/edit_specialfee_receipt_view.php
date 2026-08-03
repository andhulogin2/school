<?php include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year();?><body>
        
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
							<li class="active">Receipt</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Receipt
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Edit
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                       
									<!-- #section:elements.form -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="text-align:right"> Receipt Number <font color="#FF0000">* </font></label>
                            <div class="col-sm-9">
                                <select name="receipt_number" class="select2" id="receipt_number" onChange="get_receipt(this.value)" >
                                  <option value="">Select</option>
                                  <?php
                                  foreach($receipts as $row)
                                  {
                                  ?><option value="<?php echo $row['receipt_number'];?>"><?php echo $row['receipt_number'].' ('.$row['name'].' - '.$row['class_name'].'/'.$row['section_name'].')';?></option>
                                  <?php }?>
                                  
                              	</select>
                            </div> 
                        </div>
                        <br />	
                        
                        
                        <div id="show_receipt">
                        	
                        </div>
                        
					</div>
          		</div>
         	</div>
            

			<br><?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Updated successfully...', 'Updated', {timeOut: 5000})</script>";
}
else if($action=="transaction_failed")
{
echo "<script>toastr.error('". "Not updated...', 'Failed', {timeOut: 5000})</script>";
}
else if($action=="receipt_deleted")
{
echo "<script>toastr.success('". "Receipt Deleted Successfully...', 'Success', {timeOut: 5000})</script>";
}
else if($action=="receipt_not_deleted")
{
echo "<script>toastr.error('". "Receipt Not Deleted...', 'Failed', {timeOut: 5000})</script>";
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

 	var receipt_number	=	$('#receipt_number').val();
	get_receipt(receipt_number);  

});
</script>
<script type="text/javascript">
	function get_receipt(receipt_number)
	{
//	alert(receipt_number);
		if(receipt_number!='')
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/FeeManagement/get_specialfee_receipt_details/' + receipt_number ,
				success: function(response)
				{
					jQuery('#show_receipt').html(response);
				}
			});
		}
		else
		{
			jQuery('#show_receipt').html('');
		}
	}
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>              

 
 