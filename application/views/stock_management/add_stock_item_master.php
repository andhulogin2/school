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
							<li class="active">New Stock Item Master</li>
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
									New Stock Item  Master
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                             
                              <a href="<?php echo base_url();?>index.php/stock_management/view_stock_item_master/<?php echo $item_master_id;?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
                     <?php echo form_open('Stock_management/stock_item_master_add/', array('class' => 'form-horizontal'));?>
                                <?php
									$role = $this->session->userdata('role');
									if($role == 3 || $role == 4)
									{
									$branch_id = $this->session->userdata('branch_id');
									?>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch: <font color="#FF0000">*</font></label>
										<div class="col-sm-9">
                                        	<input type="hidden" id="branch_id" name="branch_id" value="<?php echo $branch_id; ?>" />
                                            <select name="branch" class="select2" id="branch"  disabled >
	                                            <option value="">Select</option>
	                           						<?php 
   										        		foreach ($branch as $bran)
													  		{
							  						?>
                       <option value="<?php echo $bran['branch_id'];?>"<?php if($bran['branch_id'] == $branch_id){ echo "selected"; } ?>><?php echo $bran['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
                                        </div>
									</div>
                                    <?php
									}
									else
									{
									?>
                     
                 
                     
                                <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch Name:<font color="#FF0000">*</font> </label>
                                          <div class="col-sm-9">
                                 <select id="branch_id" name="branch_id" class="select2" required >
                                        	<option value="">Select</option>
                                            <?php 
											foreach($branch as $bran):
											?>
                                            <option value="<?php echo $bran['branch_id']; ?>"><?php echo $bran['branch_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
                                 </div>
                                 </div>
                              <?php
									}
									?>
                                                 
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Category Name :<font color="#FF0000">*</font> </label>
                                            <div class="col-sm-9">
                                          <select id="category_id" name="category_id" class="select2" required >
                                        	<option value="">Select</option>
                                            <?php 
											foreach($category as $cat):
											?>
                                            <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
                                        </div>
                                        </div>
                                         <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sub Category Name :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
								        <select id="sub_category_id" name="sub_category_id" class="select2" required >
                                        	<option value="0">Not Applicable</option>
                                            <?php 
											foreach($sub_category as $scat):
											?>
                                            <option value="<?php echo $scat['sub_category_id']; ?>"><?php echo $scat['sub_category_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
										</div>
									   </div>
                                       
                                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Brand name :<font color="#FF0000">*</font> </label>
                                          <div class="col-sm-9">
                                 <select id="brand_id" name="brand_id" class="select2" required >
                                        	<option value="">Select</option>
                                            <?php 
											foreach($brand as $band):
											?>
                                            <option value="<?php echo $band['brand_id']; ?>"><?php echo $band['brand_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
                                 </div>
                                 </div>
                                 
                                 
                                 
                                   
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Item Name:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="item_name" placeholder="item name" class="col-xs-10 col-sm-5" name="item_name"/>
										</div>
									</div>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Unit Of Measurement :<font color="#FF0000">*</font> </label>
                                        <div class="col-sm-9">
								        <select id="unit_of_measurement_id" name="unit_of_measurement_id" class="select2" required >
                                        	<option value="">Select</option>
                                            <?php 
											foreach($unit as $umeasure):
											?>
                                            <option value="<?php echo $umeasure['unit_of_measurement_id']; ?>"><?php echo $umeasure['unit_long_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
										</div>
									   </div>
                                       
                                      <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Current Stock:<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="current_stock" placeholder="current stock" class="col-xs-10 col-sm-5" name="current_stock"/>
										</div>
									</div>
                                      <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Sales price :<font color="#FF0000">*</font> </label>

										<div class="col-sm-9">
											<input type="text" id="sales_price" placeholder="sales price" class="col-xs-10 col-sm-5" name="sales_price"/>
										</div>
									</div>
                                   
                                     <div class="form-group">
										

										<div class="col-sm-9">
				<input type="hidden" name="academic_year" id="academic_year" placeholder="academic year"  value="<?php foreach($year as $year1){ echo  $year1['description']; }?>" class="select2" />
                                            
										</div>
									</div>
                                    
                                    
				
									<div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Save'> 
											
										</div>
                                        
									</div>
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
            url: '<?php echo base_url();?>index.php/Stock_management/view_stock_item_master/' ,
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
