<?php include_once APPPATH . 'views/main_head.php';
$running_year=get_running_year();?><body>
        
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
<li class="active">Edit Profile</li>
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
                        <h1> Edit 
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Profile </h1>
                        
                        <div align="right" style="padding-right:100px"> 
                           <a href="<?php echo base_url();?>index.php/enquiry_controller/enquiry_view/"><b><button class="btn-info">Back</button>				                      </b></a> 
                            </div>
                        </div><!-- /.page-header -->
                        
						<?php 
                        //error_reporting(0);   
                        echo form_open('enquiry_controller/update_profile/', array('class' => 'form-horizontal'));
                        ?>
                               
						<?php
                        foreach($a as $row):
                        {
                        ?>

                    

                   
  

                                            

									

				<div class="row">
									<div class="col-sm-6">
										

										<!-- #section:elements.accordion -->
									
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														
															
															&nbsp;PERSONAL DETAILS
														</a>
													</h4>
												</div>

												
													<div class="panel-body">
														<div class="form-group">
                    <div class="col-sm-9">
                    <input type="hidden" id="id" value="<?php echo $row->enquiry_id;?>"  class="col-xs-10 col-sm-5" name="id" />
                    </div>
                    </div>
                                                                                           

                    <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">First Name:<font color="#FF0000">*</font></label>
                    <div class="col-sm-8">
                    <input type="text" id="fname" value="<?php echo $row->first_name;?> " class="col-xs-10 col-sm-9" name="fname" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Last Name:<font color="#FF0000">*</font></label>
                    <div class="col-sm-8">
                    <input type="text" id="lname" value="<?php echo $row->last_name;?>" class="col-xs-10 col-sm-9" name="lname" />
                    </div>
                    </div>


                    <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Phone Number 1 :<font color="#FF0000">*</font></label>
                    <div class="col-sm-8">
                    <input type="text" id="phone1" value="<?php echo $row->phone1;?>" class="col-xs-10 col-sm-9" name="phone1" />
                    </div>
                    </div>


                    <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Phone Number 2:</label>
                    <div class="col-sm-8">
                    <input type="text" id="phone2" value="<?php echo $row->phone2;?>" class="col-xs-10 col-sm-9" name="phone2" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Email ID:</label>
                    <div class="col-sm-8">
                    <input type="text" id="email" value="<?php echo $row->email;?>" class="col-xs-10 col-sm-9" name="email" />
                    </div>
                    </div>

						<div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Date of Birth: </label>
								   <div class="col-sm-6">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <input type="text" id="mydatepicker1" class="form-control mydatepicker" name="dob" value="<?php echo $row->date_of_birth;?>"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>



                                    <div class="form-group">
                                            <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Sex :</label>
                                            <div class="col-sm-8">
                                            <select class="select2" id="sex" name="sex" value="<?php echo $row->sex;?>">
                                                                                
                                                                        <option value="male">Male</option>
                                                                        <option value="female">Female</option>
                                                                        </select></div>
                                    </div>
 <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Father's Name :</label>
                                    <div class="col-sm-8">
                                    <input type="text" id="fathername" value="<?php echo $row-> parent_name;?>" class="col-xs-10 col-sm-9" name="fathername" />
                                    </div>
                                    </div>


                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Father's Occupation:</label>
                                    <div class="col-sm-8">
                                    <input type="text" id="occupation" value="<?php echo $row->occupation;?>" class="col-xs-10 col-sm-9" name="occupation" />
                                    </div>
                                    </div>
                                    
                                    
									 <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Class to be alloted: </label>
								   <div class="col-sm-8" >
								   <select name="class_id" class="select2" onChange="return get_class_sections(this.value)">
                                   <?php $cls=$this->db->get_where('class',array('class_id'=>$row->course_enquired))->row()->name;?>

                                   <option value="<?php echo $row->course_enquired;?>"><?php echo $cls;?></option>
                                   <?php    $this->db->where('branch_id',$this->session->userdata('branch_id'));
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
                                   
                                   
<?php }endforeach;?>               
													</div>
												</div></div>
												
											
                                          

											<div class="col-sm-6">

											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														
															&nbsp;OTHER DETAILS
														
													</h4>
												</div>

												
													<div class="panel-body">
														 <div class="form-group">
                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Whatsapp Number(If have any) :</label>
                    <div class="col-sm-8">
                    <input type="text" id="whatsapp" value="<?php echo $row->whatsapp;?>" class="col-xs-10 col-sm-9" name="whatsapp" />
                    </div>
                    </div>

                                
                    

				

                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Address : </label>
                                    <div class="col-sm-8">
                                    <input type="text" id="address" value="<?php echo $row->address;?>" class="col-xs-10 col-sm-9" name="address" />
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Pin :</label>
                                    <div class="col-sm-8">
                                    <input type="text" id="pin" value="<?php echo $row->pin;?>" class="col-xs-10 col-sm-9" name="pin" />
                                    </div>
                                    </div>


                                    

                                
                                                                    <?php
                                    $query = $this->db->get('tbl_states');
                                    if ($query->num_rows() > 0):
                                    $state1 = $query->result_array();
                                    ?>
                                	<div class="form-group">
                                       <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> State: </label>
                                       <div class="col-sm-6">
                                       <?php $state=$this->db->get_where('tbl_states',array('state_id'=>$row->state))->row()->state;
									  echo $row->state;
									   ?>
                                         <select class="select2" name="state_id" onChange="select_district(this.value)">
                                           <option value="<?php echo $row1->state;?>"><?php echo $state;?></option>
                                           <?php foreach ($state1 as $row1): ?>
                                           <option value="<?php echo $row1['state_id']; ?>" ><?php echo $row1['state']; ?></option>
                                           <?php endforeach; ?>
                                         </select>
                                       </div>
                                       </div>
                                   <?php endif; ?>
                             
  
  									  
  
   								    <div id="get_state">
                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> District: </label>
                                    <div class="col-sm-6">
                                    <?php $district=$this->db->get_where('tbl_districts',array('district_id'=>$row->district))->row()->district;?>
									  
									   
                                    <select class="select2" name="district_id">
                                    <option value="<?php echo $row->district;?>"><?php echo $district;?></option>
                                    </select>
                                    </div>
                                    </div>
                                    </div>

  
													
														<?php
                        //$detail	=$this->db->get_where('enquiry_master_details',array('enquiry_id'=>$enquiry_id))->result_array();
                        foreach($b as $row):
                        {
                        ?>
                                    
                                    
                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Highest Qualification :</label>
                                    <div class="col-sm-8">
                                    <input type="text" id="qualification" value="<?php echo $row-> qualification;?>" class="col-xs-10 col-sm-9" name="qualification" />
                                    </div>
                                    </div>


                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Year of Pass:</label>
                                    <div class="col-sm-8">
                                    <input type="text" id="year" value="<?php echo $row->year;?>" class="col-xs-10 col-sm-9" name="year" />
                                    </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Percentage:</label>
                                    <div class="col-sm-8">
                                    <input type="text" id="percentage" value="<?php echo $row->percentage;?>" class="col-xs-10 col-sm-9" name="percentage" />
                                    </div>
                                    </div>


                                    <div class="form-group">
                                    <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Instituation:</label>
                                    <div class="col-sm-8" style="padding-bottom:35px">
                                    <input type="text" id="instituation" value="<?php echo $row->last_institute;?>" class="col-xs-10 col-sm-9" name="instituation" />
                                    </div>
                                    </div>
                        <?php }endforeach;?>
                        <?php
						foreach($a as $row):
						?>            
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Enquiry Send By: </label>
                                   <div class="col-sm-8">
								   <input type="text" id="send_by" name="send_by" value="<?php echo $row->enquired_by;?>" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>
                                   
                                   <div class="form-group">
								   <label class="col-sm-4 control-label no-padding-right" for="form-field-1-1"> Enquiry Send Through: </label>
                                   <div class="col-sm-8">
								   <input type="text" id="send_trough" name="send_trough" value="<?php echo $row->enquired_through;?>" class="col-xs-10 col-sm-9" />
								   </div>
								   </div>
                         <?php
						 endforeach;	
						 ?>           
													</div>
												</div>
											</div>
										</div>

										<!-- /section:elements.accordion -->
									</div>

<div class="col-md-offset-4 col-md-9"> 
<input type="submit" class="btn btn-info" value='Update'>  

</div>

				
</div></div></div></div><br><br><br><br>




                        
<?php echo form_close(); ?>
</body>	
<?php include_once APPPATH . 'views/footer.php'; ?>
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

