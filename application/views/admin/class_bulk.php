<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />
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
                                        <li class="active">Class</li>
                                    </ul><!-- /.breadcrumb -->

									<!-- #section:basics/content.searchbox -->
                                    <div class="nav-search" id="nav-search">
                                        <form class="form-search">
                                            <span class="input-icon">
                                                
                                            </span>
                                        </form>
                                    </div><!-- /.nav-search -->
					</div>
						<!-- /section:basics/content.searchbox -->
					
					<!-- /section:basics/content.breadcrumbs -->
                                <div class="page-content">
                                    
                                     <div class="page-header">
                                        <h1>
                                            Class Bulk
                                        
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                                 Add
                                            
                                        </h1>
                                    </div>
                                 </div>
                              <div align="right"><a href="<?php echo base_url();?>index.php/admin/view_class/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> </div>
                              
                        <?php echo form_open(base_url() . 'index.php/Admin/add_class_bulk' , array('class' => 'form-inline validate'));?>
	<div class="row bg-title" style="text-align:center">
    
    

  <?php   if($this->session->userdata('role')==1 || $this->session->userdata('role')==2) { ?>
  <div class="col-md-3"></div>
    <div class="col-md-2">
		<div class="form_group">
			<label class="control-label" style="margin-bottom: 5px;">Branch:</label>
			<select name="branch" id="branch" onChange="return get_dept(this.value)" required="required" class="select2" >
                              <option value="">Select</option>
                             <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
		</div>
	</div>

 
    
     <div class="col-md-3">
		<div class="form_group">
			<label class="control-label" style="margin-bottom: 5px;">Department:</label>
			<select name="department"  id="department" required="required" class="select2" style="padding-right:70px;">
                              <option value="">Select</option>
            </select>
		</div>
	</div>
    
  <?php }  ?> 
  
  
  
  
  <?php   if($this->session->userdata('role')==3) { ?>
    <div class="col-md-3">
		<div class="form_group">
			<label class="control-label" style="margin-bottom: 5px;">Department:</label>
			<select name="department" class="select2" id="department"  required="required" >
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
  
   <?php }
    if($this->session->userdata('role')>3)
    {
        ?>
        <input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" >
        <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('dept_id'); ?>" >
        <?php
    }
   ?>
    
    
   
    
   
	<div id="section_holder"></div>
	<div class="col-md-3"></div>
</div>
<br><br>
<div class="col-md-10" style="text-align:center" >
    <div id="bulk_add_form">
        <div id="student_entry">
            <div class="row" style="margin-bottom:10px;">
        
                <div class="form-group">
                    <input type="text" name="class[]" id="amount" class="form-control" style="width: 260px; margin-left: 5px;"
                        placeholder="<?php echo get_phrase('Class Name');?>" onblur="check_class_exist(this.value)" required>
                </div>
                
        
                <div class="form-group">
                    <button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>"
                            onclick="deleteParentElement(this)" style="margin-left: 10px;">
                        <i class="fa fa-trash-o" style="color: #fff;"></i>
                    </button>
                </div>
        
            </div>
        
        </div>


		<div id="student_entry_append"></div>
        <br>
        
        <div class="row">
                <button type="button" class="btn btn-info" onclick="append_student_entry()" style="margin-left: 5px;">
                    <i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
                </button>
        </div>

        <br>
        
        <div class="row">
                <button type="submit" class="btn btn-success" id="btnSubmit" style="margin-left: 5px;">
                    <i class="entypo-check"></i> <?php echo get_phrase('Save');?>
                </button>
        </div>
     	<div style="margin-top:50px;height:20px;"></div>
     
<?php echo form_close();?> </div></div>
<div class="hr hr32 hr-dotted"></div>
<div></div>
</div> <div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

<script type="text/javascript">
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<4;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});
	function get_sections(class_id) {
	//alert(class_id);
		$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_sections/' + class_id ,
            success: function(response)
            {
                jQuery('#section_holder').html(response);
                jQuery('#bulk_add_form').show();
            }
        });
	}
    function check_class_exist(class_name)
    {
        if(class_name!='')
        {
            var branch_id       =   $('#branch').val();
            var dept_id         =   $('#department').val();
        	$.ajax({
                url: '<?php echo base_url();?>index.php/admin/check_class_exist/' + class_name +'/'+dept_id +'/'+branch_id,
                success: function(response)
                {
                    if(response==1)
                    {
                        alert("Class Name already exist");
                        $('#btnSubmit').prop('disabled',true);
                    }
                    else if(response==0)
                    {
                        $('#btnSubmit').prop('disabled',false);
                    }
                    //jQuery('#section_selector_holder').html(response);
                }
            });
        }
        else
        {
            $('#btnSubmit').prop('disabled',false);
        }
    }
	function append_student_entry()
	{
	//alert("xzfd");
		$("#student_entry_append").append(blank_student_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}

</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="failed")
{
echo "<script>toastr.success('". "Failed to add...', 'Failed', {timeOut: 5000})</script>";
}
?>


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

    

