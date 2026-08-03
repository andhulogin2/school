<?php include_once APPPATH . 'views/head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
        	<div class="main-content col-md-10">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>							</li>
							<li class="active">Enquiry</li>
						    <li class="active">Add Enquiry</li>
						</ul>
				    <!-- /.breadcrumb -->

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
							<h1>Enquiry  <i class="ace-icon fa fa-angle-double-right"></i> Add Enquiry</h1>
                            <div align="right" style="padding-right:100px"> 
                            <a href="<?php echo base_url();?>index.php/admin/index/"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a> 
                            </div>
					  </div><!-- /.page-header -->
                        
				
                     
                     <?php echo form_open('enquiry_controller/add_enquiry', array('class' => 'form-horizontal'));?>
                     
					  <!-- PAGE CONTENT BEGINS -->
								
	    <!-- #section:elements.form -->
  								
								  <div class="form-group">
								   <label class="col-sm-9 control-label no-padding-right" for="form-field-1-1"> Date of Enquiry: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <input type="text" id="mydatepicker" class="form-control mydatepicker" name="doe" required="" placeholder="Date of Enquiry" value="<?php echo date('d/m/Y')?>"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                      
<div class="space-2"></div>
								   <div class="form-group">
								   <label class="col-sm-9 control-label no-padding-right" for="form-field-1-1">Time of Enquiry: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">

								   <div class="input-group timepicker input-group-sm">
								     <input id="timepicker" type="text" class="form-control timepicker" name="toe"  placeholder="Time of Enquiry" value="<?php echo date("H:i a");?>" />
								     <span class="input-group-addon">
								   <i class="fa fa-clock-o bigger-110"></i>
								   </span>									</div>
                                    </div>
                                    </div>
                                    </div>
								      
       
                                     
                                  
                                  <div class="row">
									<div class="col-sm-12">
										

										<!-- #section:elements.accordion -->
										<div id="accordion" class="accordion-style1 panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
															<i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;PERSONAL DETAILS
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse in" id="collapseOne">
													<div class="panel-body">
														<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name :<font color="#FF0000">*</font></label>
									<div class="col-sm-9">
									<input type="text" id="fname" placeholder="First Name" class="col-xs-10 col-sm-5" name="fname" required=""/>
									</div>
									</div>

<div class="space-2"></div>

                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name :</label>
									<div class="col-sm-9">
									<input type="text" id="lname" placeholder="Last Name" class="col-xs-10 col-sm-5" name="lname"/>
									</div>
									</div>                                     
                                    
<div class="space-2"></div>
                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number1:<font color="#FF0000">* </font></label>
                                    <div class="col-sm-9">
									<input type="text" id="phone1" name="phone1" placeholder="Phone number" class="col-xs-10 col-sm-5" required=""/>
									</div>
									</div>
                                    
 <div class="space-2"></div>
                                    
                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number2: </label>
									<div class="col-sm-9">
									  <input type="text" id="phone2" name="phone2" placeholder="Phone number"  class="col-xs-10 col-sm-5" />
									</div>
									</div>
									<div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <input type="text" id="mydatepicker1" class="form-control mydatepicker" name="dob" placeholder="Date of Birth"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                  
									<div class="space-2"></div>

                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>
                                    <div class="col-sm-9">
									<select class="col-xs-10 col-sm-5" id="sex" name="sex" data-placeholder="Select one">
                                    <option value="">Select one</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    </select>
									</div>
									</div>
                                     <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fathers / Guardian Name: </label>
									<div class="col-sm-9">
									<input type="text" id="father" name="father" placeholder="Fathers/Gaurdian Name" class="col-xs-10 col-sm-5" />
								    </div>
									</div>
      
<div class="space-2"></div>
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Fathers / Guardian Occupation: </label>
								   <div class="col-sm-9">
								   <input type="text" id="occupation" name="occupation" placeholder="Fathers/Gaurdians Occupation" class="col-xs-10 col-sm-5" />
								   </div>
								   </div>
      
<div class="space-2"></div>

     
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Class to be alloted: </label>
								   <div class="col-sm-9">
								   <select name="class_id" class="col-xs-10 col-sm-5"  onChange="return get_class_sections(this.value)">
                                   <option value="">Select-class</option>
                                   <?php  $class = $this->db->get('class')->result_array();
								   foreach($class as $row){ ?>
                            	   <option value="<?php echo $row['class_id'];?>">
								   <?php echo $row['name'];?>
                                   </option>
                                   <?php
								   }
							       ?>
                                   </select>
								   </div>
								   </div>

													</div>
												</div>
											</div>

											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
															<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;CONTACT DETAILS
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseTwo">
													<div class="panel-body">
														 <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Whatsapp Number(If have any): </label>
									<div class="col-sm-9">
									<input type="text" id="whatsapp" name="whatsapp" placeholder="Whatsapp Number"  class="col-xs-10 col-sm-5" />
								    </div>
									</div>
                                    

  
<div class="space-2"></div>                             
                                     <div class="form-group">
									 <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email ID:</label>
									 <div class="col-sm-9">
									 <input type="text" id="email" name="email" placeholder="Email ID" class="col-xs-10 col-sm-5" />
									 </div>
									 </div>
                                    
<div class="space-2"></div> 
                                   

									<div class="space-2"></div>
                              								
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address: </label>
								   <div class="col-sm-9">
								   <textarea class="col-xs-10 col-sm-5" id="address" name="address" placeholder="Address"></textarea>
								   </div>
					               </div>
 


									<div class="space-2"></div>
                      
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pin: </label>
                                   <div class="col-sm-9">
								   <input type="text" id="pin" name="pin" placeholder="Pin" class="col-xs-10 col-sm-5" />
								   </div>
								   </div>

                               		 <div class="space-2"></div>
                                
                                    <?php
                                    $query = $this->db->get('tbl_states');
                                    if ($query->num_rows() > 0):
                                    $state = $query->result_array();
                                    ?>
                               		 <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> State: </label>
                                       <div class="col-sm-4">
                                         <select class="form-control selectboxit" name="state_id" onChange="select_district(this.value)">
                                           <option value="">Select-State</option>
                                           <?php foreach ($state as $row): ?>
                                           <option value="<?php echo $row['state_id']; ?>" ><?php echo $row['state']; ?></option>
                                           <?php endforeach; ?>
                                         </select>
                                       </div>
                                       </div>
                                   <?php endif; ?>
                                   
    
                                <div class="space-2"></div>
                                
                                     <div id="get_state">
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> District: </label>
                                    <div class="col-sm-4">
                                    <select class="form-control selectboxit" name="district_id">
                                    <option value="">Select-District</option>
                                    </select>
                                    </div>
                                    </div>
                                    </div>
													</div>
												</div>
											</div>

											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
															<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;QUALIFICATION DETAILS
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseThree">
													<div class="panel-body">
														<div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Highest Qualification:</label>
								   <div class="col-sm-9">
                                   <input type="text" id="pass1" name="qualification1" placeholder="Previous Qualification " class="col-xs-10 col-sm-5" />                                   </div>
								   </div>
                                   
<div class="space-2"></div>
                                   
                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  </label>
									<div class="col-sm-9">
									<input type="text" id="year1" name="year1" placeholder="Year of Pass" class="col-xs-10 col-sm-5" />
									</div>
									</div>
                                    
<div class="space-2"></div>
                           
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> </font> </label>
								   <div class="col-sm-9">
								   <input type="text" id="percentage1" name="percentage1" placeholder="Percentage" class="col-xs-10 col-sm-5" />
								   </div>
								   </div>   
                                   
<div class="space-2"></div>

 
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  </label>
								   <div class="col-sm-9">
								   <input type="text" id="institute1" name="institute1" placeholder="Graduated Institute" class="col-xs-10 col-sm-5" />
								   </div>
								   </div>         
													</div>
												</div>
											</div>
										</div>

										<!-- /section:elements.accordion -->
									</div>  
                                    
                                   <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1-1"> </label>

										<div class="col-sm-9">
                                        <div class="space-1"></div>
									    <input type="checkbox" name="additional_msg" id="additional_msg"  value="1"/>
											<span class="lbl"> Send Additional Message</span>
                                             <?php 
								 //$this->load->Model('crud_model');
								  //$query=$this->crud_model->additional_message_content();
								$this->db->select('content,title');
		$this->db->from('sms_template');
		 $this->db->where('title','admission');
	 	  $query=$this->db->get();
								 
								 if($query->num_rows() > 0)
								 {
								
								
								?>
                                 <?php  
								 // $this->load->Model('crud_model');
								  //$result=$this->crud_model->additional_message_content1();
								  $this->db->select('content');
   		 $this->db->from('sms_template');
		 $this->db->where('title','admission');
$result=$this->db->get()->result_array();
								  foreach($result as $r){?>
			                  <input type="text" name="message" id="message" class="form-control" value="<?php echo $r['content'];}?>" style="display: none"/><?php }
							  else
							  {?>
                              <input type="text" name="message" id="message" class="form-control" value=""  style="display: none"/>
							 <?php } ?>
										</div>
									</div>
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-4 col-md-9">
                        <input type="submit" class="btn btn-info"  value="Submit"> 
		          
	
										</div>
                                        
									</div> 
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    </div>
                                    
                                    <?php echo form_close(); ?>
                                    
												
											
        		
	
			<?php include_once APPPATH . 'views/footer.php'; ?>
         

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    function select_district(state_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/enquiry_controller/get_district/'+ state_id,
            success: function (response)
            {
                jQuery('#get_state').html(response);
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
			dateFormat: 'dd/mm/yy'
        })
		
	
    });
</script>

  <script type="text/javascript">
    $(document).ready(function () {
        $('#mydatepicker1').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
    });
</script>


<script type="text/javascript">
$(document).ready(function () {	
$('.timepicker').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: true,
					autoclose: true,
				   timeFormat: 'HH:mm a'
				 })
});
</script>


<script type="text/javascript">
$(document).ready(function () {	
$('.timepicker').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: true,
					autoclose: true,
				   timeFormat: 'HH:mm a'
				 })
});
</script>
 <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

