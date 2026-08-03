<?php
$role=$this->session->userdata('role');
include_once APPPATH . 'views/head.php';
$running_year = get_running_year(); ?>
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
    			<li class="active">Attendance</li>
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
        <div class="page-content">
    		
            <div class="page-header">
    			<h1>
    				STUDENT
    				
    					<i class="ace-icon fa fa-angle-double-right"></i>
    					 Attendance
    				
    			</h1>
    		</div>             
   


            <?php echo form_open_multipart(base_url() . 'index.php/admin/upload_student_excel_data/');?>
            <div class="row">
               
   
                <div class="col-md-2">
            		<div class="form-group">
            		    <label class="control-label" style="margin-bottom: 5px;">Class</label>
            			<select name="class_id" class="select2" onchange="select_section(this.value)" id="class_id">
            				<option value="">Select</option>
                            <?php 
            									 
            									 $this->db->where('academic_year',$running_year);
            									 $class 	=	$this->db->get('class')->result_array();
            									 foreach($class as $data){?>
                                                  <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                                   <?php } ?>
            				
            			</select>
            		</div>
            	</div>
       
        
        
                <div id="section_holder">
                	<div class="col-md-2">
                		<div class="form-group">
                		    <label class="control-label" style="margin-bottom: 5px;">Section</label>
                			<select class="select2" name="section_id">
                                <option value="">Select</option>
                			</select>
                		</div>
                	</div>
                </div>
        
        <div class="col-md-2">
            		<div class="form-group">
            		    <label class="control-label" style="margin-bottom: 5px;">Chose File</label>
						 <input type="file" name="file" id="file">
					</div></div>
       
    	
                
             	<div class="col-md-2" style="margin-top: 20px;">
            		<button type="submit" class="btn btn-info" name="import">submit</button>
            	</div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close();?>
<br><br><br><br>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/Admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
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
	

	
</script>
