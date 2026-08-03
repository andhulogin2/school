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
							<li class="active">Setup Fee</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Setup  
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Fee Structure
								
							</h1>
						</div><!-- /.page-header -->
                     
                      
                      <div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_master'; ?>"><b><button class="btn-info">Back</button></b></a></div> 

                       <?php echo form_open('FeeManagement/save_fee_master/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

       
          
            <br><br>
             <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
				
                 <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" required="" onChange="return get_dept(this.value)">
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
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" required="" onChange="return get_class1(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="lst_class" id="class" class="select2" required="" >
                                     <option value="">Select</option>
                          </select>
											
										</div>
									</div>
                                   
                                    <?php }?>
                                    
                                    <?php if($this->session->userdata('role')==3)
{?>
			<input type="hidden" id="branch" name="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" />  
		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class1(this.value);">
            <option value="">Select</option>
            
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
	</div>
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
			<select name="lst_class"   id="class" class="select2">
				<option value="">Select</option>
				
			</select>
		</div>
	</div>
    <br>
     <?php }?>


<?php if($this->session->userdata('role')==4)
{?>

		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class<font color="#FF0000">* </font></label>
         <div class="col-sm-9">
			<select  name="lst_class"  onchange="check_class_and_fee_plan();" id="class" class="col-xs-12 col-sm-5" required>
				<option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									  $this->db->where('academic_year',$running_year);
									 
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
            
		</div>
        <label class="col-sm-3" id="msg_class" style="color:#FF0000"></label> 
	</div>
    <input type="hidden" id="branch" name="branch" value="<?php echo $branch; ?>" /> 
    <input type="hidden" id="department" value="<?php echo $dept; ?>" />                
   <?php }?>            
					
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fee Plan Name<font color="#FF0000">* </font></label>
    <div class="col-sm-9">
    <input type="text" class="col-xs-10 col-sm-5" name="txt_fee_plan_name"  id="txt_fee_plan_name" required="" onBlur="check_class_and_fee_plan();" ><label id="" style="color:#FF0000"></label>
    </div> 
    <label class="col-sm-3"></label><label class="col-sm-9" id="msg_txt_fee_plan_name" style="color:#FF0000"></label> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payment Mode<font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="lst_payment_option" id="lst_payment_option" class="select2"  onchange="check_class_and_fee_plan();" required="">
        <option value="">Select Option</option>
			<?php
            foreach($options as $row): ?>
            <option value="<?php echo $row['fee_payment_options_master_id'];?>">
            <?php echo $row['fee_payment_options_master'];?>
            </option>
            <?php
            endforeach;
            ?>
        </select>
    </div> 
</div>

<div class="form-group">
    <div class="row" id="payment_details" style="margin-top:20px;">
    
    </div>
</div>
        <?php echo form_close();?>
            </div></div></div></body>  
                                   

										
			
			<?php include_once APPPATH . 'views/footer.php'; ?>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script> 
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
<script type="text/javascript">	
jQuery(document).ready(function () {					//Check if special characters are entered in the fee plan field

	$('#txt_fee_plan_name').keyup(function () {
                $('#msg_txt_fee_plan_name').html("");
                var inputVal = $(this).val();
                var characterReg = /^[a-zA-Z0-9-., ]*$/;
                if (!characterReg.test(inputVal) && inputVal != '') {
                    $('#msg_txt_fee_plan_name').html("Invalid Characters");
                }
            });
    });

 function get_installments(){
	 jQuery('#payment_details').html("");
	   //var payment_option = $('#lst_payment_option').val();
	   var class_id 			= $('#class').val();
	   var dept_id 				= $('#department').val();
	   var branch_id 			= $('#branch').val();
	   var txt_fee_plan_name 	= $('#txt_fee_plan_name').val();
	   var installment			= $('#lst_payment_option').val();	
	   //alert(class_id+" "+dept_id+" "+txt_fee_plan_name);
	  
		$.ajax({
			url: 'setup_fee2/'+installment+'/'+class_id+'/'+txt_fee_plan_name+'/'+dept_id+'/'+branch_id,
			success: function(response)
				{
					//console.log(response);
					jQuery('#payment_details').html(response);
				}
		});
	}
function check_class_and_fee_plan()
{
	if($("#class").val()=='')
	{
		$("#class").focus();
		$("#msg_class").html("Please select class");
		$("#class").attr("title","Please select class");
		$('#payment_details').html("");
	}
	else
	{
		$("#msg_class").html("");
	}
	if($("#txt_fee_plan_name").val()=='')
	{
		$("#txt_fee_plan_name").focus();
		$("#msg_txt_fee_plan_name").html("Please enter fee plan");
		$('#payment_details').html("");
	}
	if($("#lst_payment_option").val()=='')
	{
		jQuery('#payment_details').html("");
	}
	if($("#class").val()!='' && $("#txt_fee_plan_name").val()!='' && $("#lst_payment_option").val()!='')
	{
		get_installments();
	}
}
</script>
 <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->

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
	function get_class1(department) 
	{
	//alert(department);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_cls/' + department ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
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