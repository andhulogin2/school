<?php include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year();?><body>
        
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
							<li class="active">Reprint Receipt</li>
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
								Receipt 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Reprint Receipt
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>

                <?php echo form_open(base_url() . 'index.php/feeManagement/reprint_receipt1' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="text-align:right"> Receipt Number <font color="#FF0000">* </font></label>
                    <div class="col-sm-9">
                        <select name="receipt_number" class="select2" id="receipt_number" onChange="disable_other(this.value)" >
                          <option value="">Select</option>
                          <?php
                          foreach($receipts as $row)
                          {
                          ?><option value="<?php echo $row['receipt_number'];?>"><?php echo $row['receipt_number'].' ('.$row['name'].' - '.$row['class_name'].'/'.$row['section_name'].')';?></option>
                          <?php }?>
                          
                      	</select>
                    </div> 
                </div>

  				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Date From"; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-4">
							<input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />		
                         </div> 
					</div>              
     
  				<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Date To"; ?><font color="#FF0000">*</font></label>
						<div class="col-sm-4">
						<input type="text" name="date_to" id="date_to" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />
						</div> 
					</div>   
                    
                
				<?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
				
                 <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :</label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" >
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
			<select name="department" class="select2" id="department" onChange="return get_class(this.value)" >
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
		     		
                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
									<select name="class_id" id="class" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
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
			<select name="department" class="select2" id="department" onChange="return get_class1(this.value)" required>
            <option value="">Select</option>
            <option value="All">All</option>
            
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
			<select name="class_id" onChange="get_class_sections1(this.value)" id="class1" class="select2" required>
				<option value="">Select</option>
				
			</select>
             <input type="hidden" id="txtcourse" name="txtcourse" />    
		</div>
	</div>

<?php }?>
<?php if($this->session->userdata('role')>=4)
{?>
        <input type="hidden" name="department" value="<?php echo $this->session->userdata('dept_id'); ?>">
		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>
        <div class="col-sm-9">
			<select  name="class_id"  onchange="get_class_sections(this.value)" id="class" class="select2" required>
				<option value="ALL">ALL</option>
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
             <input type="hidden" id="txtcourse" name="txtcourse" />    
		</div>
	</div>
    <?php }?>

					<div class="form-group">
					<label for="field-2" class="col-sm-3 control-label"><?php echo 'Section'; ?>
                    <font color="#FF0000">*</font></label>
		            <div class="col-sm-5">
		             <select name="section_id" class="select2" required="" id="section_selector_holder" onChange="document.getElementById('txtsection').value= this.options[this.selectedIndex].text;" required>
		             <option value="ALL"><?php echo 'ALL'; ?></option>
			         </select>
                      <input type="hidden" id="txtsection" name="txtsection" />
			        </div>
					</div>
                    
   <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
                           
							<button type="submit" class="btn btn-info"><?php echo 'Show'; ?></button>
						</div>
					</div>               <?php echo form_close();?>
                                   </div></div></div></body>

			<?php include_once APPPATH . 'views/footer.php'; ?>



<script type="text/javascript">
    function disable_other(receipt_number)
    {
        if(receipt_number!='')
        {
            if($('#date_from').length>0)
            {
                $('#date_from').prop('disabled',true);
            }
            if($('#date_to').length>0)
            {
                $('#date_to').prop('disabled',true);
            }
            if($('#class').length>0)
            {
                $('#class').prop('disabled',true);
            }
            if($('#class1').length>0)
            {
                $('#class1').prop('disabled',true);
            }
            if($('#section_selector_holder').length>0)
            {
                $('#section_selector_holder').prop('disabled',true);
            }
        }
        else
        {
            if($('#date_from').length>0)
            {
                $('#date_from').prop('disabled',false);
            }
            if($('#date_to').length>0)
            {
                $('#date_to').prop('disabled',false);
            }
            if($('#class').length>0)
            {
                $('#class').prop('disabled',false);
            }
            if($('#class1').length>0)
            {
                $('#class1').prop('disabled',false);
            }
            if($('#section_selector_holder').length>0)
            {
                $('#section_selector_holder').prop('disabled',false);
            }
        }
    }
	function get_class_sections(class_id) 
	{

    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
			}
        });
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
	function get_class1(dept_id) 
	{
	if(dept_id=='All')
			{
				document.getElementById('class1').disabled					=	true;	
				document.getElementById('section_selector_holder').disabled	=	true;	
			}
			else
			{
				document.getElementById('class1').disabled					=	false;	
				document.getElementById('section_selector_holder').disabled	=	false;	    	
				$.ajax({
					url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
					success: function(response)
					{
						jQuery('#class1').html(response);
					}
				});
			}	
    }
	

	
</script>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/FeeManagement/get_dept/' + branch_id ,
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
		if(dept_id=='All')
		{
			document.getElementsByName('class_id')[0].disabled		=	true;	
			document.getElementsByName('section_id')[0].disabled	=	true;	
		}
		else
		{
			document.getElementsByName('class_id')[0].disabled		=	false;	
			document.getElementsByName('section_id')[0].disabled	=	false;	

			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
				success: function(response)
				{
					jQuery('#class').html(response);
				}
			});
		}
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