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
							<li class="active">Admission</li>
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
								Assign
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Student to Bus
							</h1>
						</div><!-- /.page-header -->
                        
				         
                     
                     <?php echo form_open_multipart('Transport_management/assign_student_to_bus', array('class' => 'form-horizontal','id'=>"myform"));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    
                                    <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   { 
					   if($this->session->userdata('role')==1  || $this->session->userdata('role')==2){?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" required onChange="return get_dept(this.value)" >
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)" required >
                              <option value="">Select</option>
                              
                              
                             
                              
                          </select>
										</div>
									</div>
                                    <?php } }?>
                                     <?php if($this->session->userdata('role')==3){?>
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)" required >
                              <option value="">Select</option>
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                              
                          </select>
                          <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" >
										</div>
									</div>
                                    <?php }?>
									

									<!-- /section:elements.form -->
							
 
									<div class="space-4"></div>
                                    
                                   <?php //if($this->session->userdata('role')==4){?>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" id="class_id" class="select2" onChange="return get_class_sections(this.value)"  required >
                                     <option value="">Select</option>
                                     <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $academic_year= get_running_year();
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
								 
                                	$this->db->where('academic_year',$academic_year);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
                          </select>
						<input type="hidden" name="branch" id="branch" value="<?php echo $branch; ?>" >				
                                       	
										</div>
									</div>
  <?php //} ?>	
									<div class="space-4"></div>


									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Section: <font color="#FF0000">* </font></label>

										 <div class="col-sm-9">
		                        <select name="section_id" class="select2" required="" id="section_selector_holder" >
		                            <option value="">Select</option>
			                    </select>
			                </div>
									</div>

								                     <div class="col-md-offset-3 col-md-9">
                        <input type="button" class="btn btn-info"  value='Submit' onClick="get_student()" > 
											
										</div>
                                        
									</div>
                    <?php echo form_close(); ?>
                    <br> <br> <br>
                    <div id="students_list" style="padding-left:10px;padding-top:50px;height:auto"></div>     
                    <div id="wait" style="text-align:center;display:none">
                    	<img src="<?php echo base_url() . 'assets/images/ajax-loader.gif'; ?>" alt="Loading..." style="width:100px;height:100px;">  
                    </div>         
                   </div></div>                
               			
                        
				  
                   
                                   
<?php include_once APPPATH . 'views/footer.php'; ?>
				
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#wait').hide();
	});
	function get_class_sections(class_id) 
	{
	//alert(class_id);
//	get_fee_master(class_id) ;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
	
function get_fee_master(class_id) 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/get_class_fee_master/' + class_id ,
            success: function(response)
            {
                jQuery('#fee_master').html(response);
            }
        });
    }	
	
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('". "Inserted Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="failed")
{
echo "<script>toastr.error('". "Please check atleast one check box...', 'Insertion failed', {timeOut: 5000})</script>";
}
if ($action=="set installment")
{
echo "<script>toastr.error('". "First set bus fee installments...', 'Insertion failed', {timeOut: 5000})</script>";
}

?>


<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

<script type="text/javascript">
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class_id').html(response);
            }
        });
    }
	function get_student()
	{
	    var a=0;
    	jQuery('#students_list').html("");
    	var class_id	=	document.getElementById("class_id").value;
    	var section_id	=	document.getElementById("section_selector_holder").value;
    	var branch_id	=	document.getElementById("branch").value;
    		$.ajax({
                url: '<?php echo base_url();?>index.php/Transport_management/get_students/'+class_id+"/"+section_id+"/"+branch_id,
    			beforeSend: function() { $('#wait').show(); },
            	
                success: function(response)
                {
                    a=1;
                    if(a==1)
                    {
                        $('#wait').hide()
                    }
                    jQuery('#students_list').html(response);
                }
                //,complete: function() { $('#wait').hide(); }
            });
           
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
