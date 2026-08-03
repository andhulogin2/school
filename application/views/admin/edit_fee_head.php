<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 

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
							<li class="active">Edit Fee Item</li>
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
								Edit
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Fee Head
								</small>
							</h1>
                           
						</div><!-- /.page-header -->
                        
<div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/FeeManagement/view_fee_head/' ?>"><button class="btn-info">Back</button></a></div> 				 
                     
                                   
                     <?php echo form_open('FeeManagement/update_fee_head/', array('class' => 'form-horizontal'));
					 ?>
                     
								<!-- PAGE CONTENT BEGINS -->
<?php foreach($fee_head as $data)
{
?>	


<input type="hidden" id="fee_head_id"  class="col-xs-10 col-sm-5" name="fee_head_id" value="<?php echo $fee_head_id;?>" />						
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Head Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name"  class="col-xs-10 col-sm-5" name="name" value="<?php echo $data['fee_head'];?>" required />
										</div>
									</div>
                                    
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Category :<font color="#FF0000">* </font></label>
   
										<div class="col-sm-9">
											<select name="account" class="select2" required >
                                           	<option value="">Select</option>
										   <?php $account_head=$this->db->get('tbl_fee_category')->result_array();
										   foreach($account_head as $data1)
										   {
										   if($data['fee_category_id']==$data1['fee_category_id'])
										   {
	  ?> <option value="<?php echo $data1['fee_category_id']; ?>" selected="selected"><?php echo $data1['fee_category_name'];?></option><?php
                                           }
										   else
										   {
	  ?> <option value="<?php echo $data1['fee_category_id']; ?>" ><?php echo $data1['fee_category_name'];?></option><?php
                                           }
										   }
                                          ?>
                          </select>
										</div>
									</div>
                              

								
    <br><br>                                
                                     
									
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit"  class="btn btn-info" type="button" value='Update'> 
											
										</div>
                                         <?php
										 }
										  echo form_close(); 
										  ?>
									</div>
                                    </div>
                                    </div>
                                   
                                    

												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

			<?php include_once APPPATH . 'views/footer.php'; ?>

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
