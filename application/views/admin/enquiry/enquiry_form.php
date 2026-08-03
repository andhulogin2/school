<?php include_once APPPATH . 'views/main_head.php';
$running_year=get_running_year();?>
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
                            <a href="<?php echo base_url();?>index.php/admin/index/"><b><button class="btn-info">Back</button></b></a> 
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
								     <input id="timepicker" type="text" class="form-control timepicker" name="toe"  placeholder="Time of Enquiry" value="<?php date_default_timezone_set("Asia/Kolkata"); 
									 echo date("H:i a");?>" />
								     <span class="input-group-addon">
								   <i class="fa fa-clock-o bigger-110"></i>
								   </span>									</div>
                                    </div>
                                    </div>
                                    </div>
								      
       
                                     
                                  
                                  <div class="row">
									<div class="col-sm-6">
										

										<!-- #section:elements.accordion -->
							

											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														
															&nbsp;PERSONAL DETAILS
														
													</h4>
												</div>
												
													<div class="panel-body">
														<div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> First Name :<font color="#FF0000">*</font></label>
									<div class="col-sm-8">
									<input type="text" id="fname" placeholder="First Name" class="col-xs-10 col-sm-9" name="fname" required=""/>
									</div>
									</div>

<div class="space-2"></div>

                                    <div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Last Name :</label>
									<div class="col-sm-8">
									<input type="text" id="lname" placeholder="Last Name" class="col-xs-10 col-sm-9" name="lname"/>
									</div>
									</div>                                     
                                    
<div class="space-2"></div>
                                    <div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Phone number1:<font color="#FF0000">* </font></label>
                                    <div class="col-sm-8">
									<input type="text" id="phone1" name="phone1" placeholder="Phone number" class="col-xs-10 col-sm-9" required=""/>
									</div>
									</div>
                                    
 <div class="space-2"></div>
                                    
                                    <div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Phone number2: </label>
									<div class="col-sm-8">
									  <input type="text" id="phone2" name="phone2" placeholder="Phone number"  class="col-xs-10 col-sm-9" />
									</div>
									</div>
                                    <div class="space-2"></div>                             
                                     <div class="form-group">
									 <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Email ID:</label>
									 <div class="col-sm-8">
									 <input type="text" id="email" name="email" placeholder="Email ID" class="col-xs-10 col-sm-9" />
									 </div>
									 </div>
									<div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>
								   <div class="col-sm-6">
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
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Sex: </label>
                                    <div class="col-sm-8">
									<select class="select2" id="sex" name="sex" data-placeholder="Select one">
                                    <option value="">Select one</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    </select>
									</div>
									</div>
                                     <div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Fathers / Guardian Name: </label>
									<div class="col-sm-8">
									<input type="text" id="father" name="father" placeholder="Fathers/Gaurdian Name" class="col-xs-10 col-sm-9" />
								    </div>
									</div>
      
<div class="space-2"></div>
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Fathers / Guardian Occupation: </label>
								   <div class="col-sm-8">
								   <input type="text" id="occupation" name="occupation" placeholder="Fathers/Gaurdians Occupation" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>
      
<div class="space-2"></div>

     
                                   <div class="form-group" style="padding-bottom:25px;">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Class to be alloted: </label>
								   <div class="col-sm-8">
								   <select name="class_id" class="select2"  onChange="return get_class_sections(this.value)">
                                   <option value="">Select-class</option>
                                   <?php  
								   $this->db->where('branch_id',$this->session->userdata('branch_id'));
								   $this->db->where('dept_id',$this->session->userdata('dept_id'));
								   $this->db->where('academic_year',$running_year);
								   $class = $this->db->get('class')->result_array();
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
                                            
                                            <div class="col-sm-6">

											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														
															&nbsp;OTHER DETAILS
														
													</h4>
												</div>

												
													<div class="panel-body">
														 <div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Whatsapp Number(If have any): </label>
									<div class="col-sm-8">
									<input type="text" id="whatsapp" name="whatsapp" placeholder="Whatsapp Number"  class="col-xs-10 col-sm-9" />
								    </div>
									</div>
                                    
                                    

  

                                    
<div class="space-2"></div> 
                                   

									<div class="space-2"></div>
                              								
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Address: </label>
								   <div class="col-sm-8">
								   <textarea class="col-xs-10 col-sm-9" id="address" name="address" placeholder="Address"></textarea>
								   </div>
					               </div>
                                   
 


									<div class="space-2"></div>
                      
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Pin: </label>
                                   <div class="col-sm-8">
								   <input type="text" id="pin" name="pin" placeholder="Pin" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>
                                   

                               		 <div class="space-2"></div>
                                
                                    <?php
                                    $query = $this->db->get('tbl_states');
                                    if ($query->num_rows() > 0):
                                    $state = $query->result_array();
                                    ?>
                               		 <div class="form-group">
                                       <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> State: </label>
                                       <div class="col-sm-6">
                                         <select class="select2" name="state_id" onChange="select_district(this.value)">
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
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> District: </label>
                                    <div class="col-sm-6">
                                    <select class="select2" name="district_id">
                                    <option value="">Select-District</option>
                                    </select>
                                    </div>
                                    </div>
                                    </div>
                                    
													
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Highest Qualification:</label>
								   <div class="col-sm-8">
                                   <input type="text" id="pass1" name="qualification1" placeholder="Previous Qualification " class="col-xs-10 col-sm-9" />                                   </div>
								   </div>
                                   
                                   
<div class="space-2"></div>
                                   
                                    <div class="form-group">
									<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">  </label>
									<div class="col-sm-8">
									<input type="text" id="year1" name="year1" placeholder="Year of Pass" class="col-xs-10 col-sm-9" />
									</div>
									</div>
                                    
                                    
<div class="space-2"></div>
                           
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> </label>
                
								   <div class="col-sm-8">
								   <input type="text" id="percentage1" name="percentage1" placeholder="Percentage" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>   
                                   
                                   
<div class="space-2"></div>

 
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">  </label>
								   <div class="col-sm-8">
								   <input type="text" id="institute1" name="institute1" placeholder="Graduated Institute" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>  
                                   <div class="space-2"></div> 
                                   
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Enquiry Send By: </label>
                                   <div class="col-sm-8">
								   <input type="text" id="send_by" name="send_by" placeholder="Enquiry Send By" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>
                                   
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Enquiry Send Through: </label>
                                   <div class="col-sm-8">
								   <input type="text" id="send_trough" name="send_trough" placeholder="Enquiry Send Through" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>
                                   

									<div class="space-2"></div>
                              								
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Remark: </label>
								   <div class="col-sm-8">
								   <textarea class="col-xs-10 col-sm-9" id="remark" name="remark" placeholder="Address"></textarea>
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
									    <input type="checkbox" name="additional_msg" id="additional_msg"  value="1" onClick="display_box();"/>
											<span class="lbl"> Send Additional Message</span><br>
                                             <?php 
								 //$this->load->Model('crud_model');
								  //$query=$this->crud_model->additional_message_content();
								 // $this->load->Model('crud_model');
								  //$result=$this->crud_model->additional_message_content1();
								  
								  	$this->db->select('content');
								 	$this->db->from('sms_template');
								 	$this->db->where('title','enquiry');
									$this->db->where('dept_id',$this->session->userdata('dept_id'));
									$this->db->where('branch_id',$this->session->userdata('branch_id'));
									$result=$this->db->get()->result_array();
									if(count($result)>0)
									{
								  foreach($result as $r)
								  {
								  ?>
									<textarea name="msg_content" id="msg_content" cols="50" rows="5" style="margin-top:10px;margin-bottom:10px;display:none"><?php echo $r['content']; ?></textarea>
							 		<?php 
									}
									}
									else
									{
									?>
                                    <textarea name="msg_content" id="msg_content" cols="50" rows="5" style="margin-top:10px;margin-bottom:10px;display:none"></textarea>
                                    <?php
									}
									?>
										</div>
									</div>
                                 </div>
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-4 col-md-9">
                        <input type="submit" class="btn btn-info"  value="Submit"> 
		          
	
										</div>
                                        
									</div> 
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                   <br>	
										
                                   
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
	function display_box()
	{
	
		if(document.getElementById("additional_msg").checked==true)
		{
			document.getElementById("msg_content").style.display = 'block';
		}
		else
		{
			document.getElementById("msg_content").style.display = 'none';
		}
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
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','250px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>   

