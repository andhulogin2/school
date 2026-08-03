<?php include_once APPPATH . 'views/main_head.php';?>
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
								<a href="#">Home</a>
							</li>
							<li class="active">Admission</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
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
								STUDENT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admission Form
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 <!--   <div class="row">
							<div class="col-xs-12">
								
								<form class="form-horizontal" role="form">
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name :* </label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5" name="name" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> School Name: </label>

										<div class="col-sm-9">
											<input type="text" id="School-Name" name="School-Name" placeholder="School Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:* </label>

										<div class="col-sm-9">
											<input type="text" id="class" name="class" placeholder="Class" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Section: </label>

										<div class="col-sm-9">
											<input type="text" id="Section" name="Section" placeholder="Section" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Roll Number: </label>

										<div class="col-sm-9">
											<input type="text" id="roll-number" name="roll-number" placeholder="Roll Number" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    
                                       <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>

										<div class="col-sm-4">
										<input type="text" id="datepicker" class="form-control" />
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
										</div>
									</div>
                                    
                             </form>
                      </div>
                     </div>     -->  
                     
                     <?php error_reporting(0);   echo form_open('enquiry_controller/add_student/'.$enquiry_id, array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
<								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> First Name :<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                  <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->first_name;?> 
							
									<input type="text" id="name" value="<?php echo $w;?>"  class="col-xs-10 col-sm-5" name="fname" required=""/>
                                   
										</div>
									</div>
                                    
                                    								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name :<font color="#FF0000">*</font></label>
										<div class="col-sm-9">		
                                  <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->last_name;?> 
							
									<input type="text" id="name" value="<?php echo $w;?>"  class="col-xs-10 col-sm-5" name="lname" required=""/>
                                   
										</div>
									</div>


                                    <?php 
					   if($this->db->get_where('settings' , array('type' =>'school'))->row()->description == 'True')
					   {?>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> School Name: </label>

										<div class="col-sm-9">
											<input type="text" id="school" name="school" placeholder="School Name" class="col-xs-10 col-sm-5" />
										</div>
									</div>
                                    <?php } ?>

									<!-- /section:elements.form -->
									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" class="col-xs-10 col-sm-5" required="" onChange="return get_class_sections(this.value)">
                              <option value="">select</option>
                              <?php  $classes = $this->db->get('class')->result_array();
								foreach($classes as $row){ ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								}
							  ?>
                          </select>
											
										</div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Section: <font color="#FF0000">* </font></label>

										 <div class="col-sm-5">
		                        <select name="section_id" class="col-xs-10 col-sm-9"  id="section_selector_holder">
		                            <option value="">Select-Class</option>
			                    </select>
			                </div>
									</div>

									<div class="space-4"></div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Roll Number: </label>

										<div class="col-sm-9">
											<input type="text" id="roll-number" name="roll_number" placeholder="Roll Number" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>

                                       <div class="form-group">
									     <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->phone1;?> 
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number1: <font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="phone1" value="<?php echo $w;?>" name="phone1" placeholder="Phone number" class="col-xs-10 col-sm-5" required=""/>
											
										</div>
									</div>
                                    
                                    <div class="form-group">
									     <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->phone2;?> 
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number2: </label>

										<div class="col-sm-9">
											<input type="text" id="phone2" value="<?php echo $w;?>" name="phone2" placeholder="Phone number" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
				
                              
                                  
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email ID: </label>
                                          <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->email;?> 
										<div class="col-sm-9">
											<input type="text" id="email" value="<?php echo $w;?>" name="email" placeholder="Email ID" class="col-xs-10 col-sm-5" />
											
										</div>
									</div>
                                    
                                   
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>
                                         <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->sex;?> 
										<div class="col-sm-9">
											<select class="col-xs-10 col-sm-5" id="sex" name="sex" data-placeholder="Select one">
                                               <option value="<?php echo $w;?>"><?php echo $w;?></option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                             </select>
											
										</div>
									</div>
                                     
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
                                        <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->date_of_birth;?> 
								   <div class="input-group input-group-sm">
								   <input type="text" id="mydatepicker1" class="form-control mydatepicker" name="birthday" value="<?php echo $w;?>" />
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>

						
								<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address: </label>
                                <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->address;?> 
								<div class="col-sm-9">
								<textarea class="col-xs-10 col-sm-5" id="address"  name="address"> <?php echo $w;?> </textarea>
								</div>
								</div>
                                    
 					                         
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pin: </label>
                                   <div class="col-sm-9">
                                   <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->pin;?> 
								   <input type="text" id="pin" name="pin" value="<?php echo $w;?>"  class="col-xs-10 col-sm-5" />
								   </div>
								   </div>

                                              
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> District : </label>
                                   <div class="col-sm-9">
                                   <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->district;?> 
								   <input type="text" id="district" name="district" value="<?php echo $w;?>" class="col-xs-10 col-sm-5" />
								   </div>
								   </div>
                                   
                                               
                                   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> State: </label>
                                   <div class="col-sm-9">
                                   <?php $w=$this->db->get_where('tbl_enquiry_master',array('enquiry_id'=>$enquiry_id))->row()->state;?> 
								   <input type="text" id="state" name="state" value="<?php echo $w;?>" class="col-xs-10 col-sm-5" />
								   </div>
								   </div>
                                    
                             
										
             
                           
                                                   <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Photo'); ?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-info btn-file">
										<span class="fileinput-new"><?php echo get_phrase('Upload'); ?></span>
										<span class="fileinput-exists"><?php echo get_phrase('Change'); ?></span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete'); ?></a>
								</div>
							</div>
						</div>
					</div>
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                   
                                                      

															
                                    
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> </label>

										<div class="col-sm-9">
                                        <div class="space-4"></div>
											<input type="checkbox" checked name="notification" id="notification" value="1">
											<span class="lbl"> Send notification</span>
                                            &nbsp;
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
                    <div class="col-md-offset-3 col-md-9">
                                
                                 <input type="submit" class="btn btn-info" name="submit"  value='Submit' > 											
                               
                        
							        
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
          <script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/bootstrap-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/ace-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
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
