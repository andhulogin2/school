<?php include_once APPPATH . 'views/main_head.php';?><body>
        
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
							<li class="active">Fee Collection Report</li>
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
								Report 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Bus Fee Collection Report
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

                <?php echo form_open(base_url() . 'index.php/Transport_management/fee_collection_detailed_report1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


  				<div class="form-group">
						<label for="form-field-1" style="padding-right:0px" class="col-sm-3 control-label">Date From :<font color="#FF0000">*</font></label>
						<div class="col-sm-9">
							<input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="col-xs-10 col-sm-5 mydatepicker"  />		
                         </div> 
					</div>              
     
  				<div class="form-group">
						<label for="form-field-1" style="padding-right:0px" class="col-sm-3 control-label">Date To :<font color="#FF0000">*</font></label>
						<div class="col-sm-9">
						<input type="text" name="date_to" id="mydatepicker" value="<?php echo date('d-m-Y'); ?>" class="col-xs-10 col-sm-5 mydatepicker"  />
						</div> 
					</div>   
                    
                     	         
                    
                 	<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Fee Item :<font color="#FF0000">*</font></label>
						<div class="col-sm-9">
							<select name="fee_item" id ="fee_item" class="select2" >
                           
                              <option value="Select">Select</option>
                             <option value="Bus_Fee">Bus Fee</option>
                              <option value="Late_Fee">Late Fee</option>
                          </select>
						</div> 
					</div>           
                
				<?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
				
                 <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">*</font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" required onChange="return get_dept(this.value)">
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
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class_by_dept(this.value)">
                              <option value="All">All</option>
                             
                              
                          </select>
										</div>
									</div>
		     		
                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class :</label>

										<div class="col-sm-9">
									<select name="class_id" id="class" class="select2" onChange="return get_class_sections(this.value)">
                                     <option value="All">All</option>
                          </select>
											 <input type="hidden" id="txtcourse" name="txtcourse" />    
										</div>
									</div>
                                    <?php }?>
                                    
                                    <?php if($this->session->userdata('role')==3)
{?>

		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class_by_dept(this.value)">
            <option value="">Select</option>
            
                              <?php 
							 
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
		</div>
	</div>
<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class :</label>

										<div class="col-sm-9">
			<select name="class_id" onChange="get_class_sections(this.value)" id="class1" class="select2">
				<option value="">Select</option>
				
			</select>
             <input type="hidden" id="txtcourse" name="txtcourse" />    
		</div>
	</div>

<?php }?>
<?php if($this->session->userdata('role')>=4)
{?>

		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class :</label>
        <div class="col-sm-9">
            <?php
            $branch	=   $this->session->userdata('branch_id');
            $dept	=	$this->session->userdata('dept_id');
            $year   =   get_running_year();
            
            $class  =   $this->db->get_where('class',array('branch_id'=>$branch,'dept_id'=>$dept,'academic_year'=>$year))->result_array();
            

            ?>
            <input type="hidden" value="<?php echo $branch ?>" id="branch" name="branch" />   
            <input type="hidden" value="<?php echo $dept ?>" id="department" name="department" />   
			<select  name="class_id"  onchange="get_class_sections(this.value)" id="class" class="select2">
				<option value="">Select</option>
                <option value="all">All</option>
                                    <?php 
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
             <input type="hidden" id="txtcourse" name="txtcourse" />    
		</div>
	</div>
    <?php }?>

					<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label">Section :</label>
		            <div class="col-sm-9">
		             <select name="section_id" class="select2"  id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;" >
		             <option value="">Select</option>
		             <option value="all">All</option>
			         </select>
                      <input type="hidden" id="txtsection" name="txtsection" />
			        </div>
					</div>
                    
   <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo 'Show Report'; ?></button>
						</div>
					</div>               <?php echo form_close();?>
                                   </div></div></div></body>

			<?php include_once APPPATH . 'views/footer.php'; ?>



<script type="text/javascript">
	function get_class_sections(class_id) 
	{
		if(class_id=='all')
		{
			jQuery('#section_selector_holder').html('');
			jQuery('#section_selector_holder').prop('disabled',true);
		}
		else
		{
			jQuery('#section_selector_holder').prop('disabled',false);
			$.ajax({
				url: '<?php echo base_url();?>index.php/Admin/get_class_section/' + class_id ,
				success: function(response)
				{
					//jQuery('#section_selector_holder').html('<option value="all">All</option>');
					jQuery('#section_selector_holder').html('');
					jQuery('#section_selector_holder').append(response);
					jQuery('#section_selector_holder').children('option:first').remove();
					if((jQuery('select#section_selector_holder option').length)>=2)
					{
						jQuery('#section_selector_holder').prepend('<option value="" selected>Select</option><option value="all">All</option>');
					}
					else
					{
						jQuery('#section_selector_holder').prepend('<option value="" selected>Select</option>');
					}	
				}
			});
		}
		setText();
    }
	
	function setText()
	{
	var elt = document.getElementById('class_id');
	var selectedText = elt.options[elt.selectedIndex].text;
	document.getElementById('txtcourse').value=selectedText;
	}
	
	function check_fee_head()
	{
	var elt = document.getElementById('report_type');
	var selectedText = elt.options[elt.selectedIndex].value;  
		if (selectedText=="detailed")
			document.getElementById('fee_head_id').disabled=false;
		else
			document.getElementById('fee_head_id').disabled=true;
	
	}
	
		</script>  

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
    <script>
    function get_class_sections1(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
				
			}
			
        });
		setText_b();
    }
    </script>
    <script>
    function setText_b()
	{
	var elt = document.getElementById('class1');
	var selectedText = elt.options[elt.selectedIndex].text;
	document.getElementById('txtcourse').value=selectedText;
	}
	</script>
    <script type="text/javascript">
	

	
</script>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

<script type="text/javascript">
	function get_class_by_dept(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_class_by_dept/' + dept_id ,
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
