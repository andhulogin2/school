<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">New Stock Item Brand</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Stock Item Brand
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/stock_management/view_stock_item_brand/<?php echo $brand_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Stock_management/stock_item_brand_add/', array('class' => 'form-horizontal'));?>
					 
										<center><div class="widget-box" style="width:420px">
											<div class="widget-header">
												<h4><font color="#FFFFFF">New Stock Item Brand</font></h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<form>
														<!-- <legend>Form</legend> -->
														<fieldset><br>
															<center><label>Brand Name</label></center>
                                                           
                                                            
															<center><input type="text" id="brand_name" placeholder="brand name" name="brand_name" /></center> 
                                                         
															
														</fieldset><br>

														
															<button type="submit" class="btn btn-sm btn-success">
																Save
																<!--<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>!-->
															</button>
                                                            <div></div>
														<br />
													</form>
												</div>
											</div>
										</div>
                                         <?php echo form_close(); ?>
                                        </div>

                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
//function ab(){
//swal("Successfull");
//
//
//}
//</script>
<script>
	function ab() 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Stock_management/view_stock_item_brand/' ,
            success: function(response)
            {
                swal("Successfull");
            }
        });
    }
</script>






<script>
function update(args){
   if(confirm('Do you want to submit?')){
      // put all the js code here.
   }else{
      return false;
   }
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
 <script type="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

	<script>
	function a(){
	bootbox.confirm({
    title: "Destroy planet?",
    message: "Do you want to activate the Deathstar now? This cannot be undone.",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
    callback: function (result) {
        console.log('This was logged in the callback: ' + result);
    }
});
</script>	
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>


		