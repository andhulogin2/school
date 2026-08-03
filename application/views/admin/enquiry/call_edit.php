<?php include_once APPPATH . 'views/main_head.php';?>
 

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
							<li class="active">Edit Call Details</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
                       
							<form class="form-search">
								<span class="input-icon">
									
									<i class="ace-icon fa fa-search nav-search-icon"></i>
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
									Call Details
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                     <?php error_reporting(0);   echo form_open('enquiry_controller/update_call/'.$call_id, array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                
									
                          											   

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Called By :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
                                         <?php  $w=$this->db->get_where('tbl_enquiry_followups',array('call_id'=>$call_id))->row()->name;?>
											<input type="text" id="name" value="<?php echo $w;?>" class="col-xs-10 col-sm-5" name="name" />
                                          
										</div>
									</div>
                          											
                                        <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Enquiry: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <?php  $w=$this->db->get_where('tbl_enquiry_followups',array('call_id'=>$call_id))->row()->date;?>
								   <input type="text" id="mydatepicker" class="form-control mydatepicker" name="date" required="" placeholder="Date of Enquiry" value="<?php echo $w?>"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                      
                             

								     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Time :<font color="#FF0000">* </font></label>
   
										<div class="col-sm-9">
											
                                           <?php $w=$this->db->get_where('tbl_enquiry_followups',array('call_id'=>$call_id))->row()->time;?> 
                                            <input type="text" id="time" value="<?php echo $w;?>" class="col-xs-10 col-sm-5" name="time" />
										</div>
									</div>
									
									
									 
									
                             

                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Remark : </font></label>
   
										<div class="col-sm-9">
											
                                           <?php $w=$this->db->get_where('tbl_enquiry_followups',array('call_id'=>$call_id))->row()->remark;?> 
                                            <textarea id="remark" cols="10" rows="10"  class="col-xs-10 col-sm-5" name="remark" ><?php echo $w;?></textarea>
										</div>
									</div>
                             

                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info"  value='Update'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                   
                                    <?php echo form_close(); ?>
                                    

												
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
	