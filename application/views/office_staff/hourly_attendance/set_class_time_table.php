<?php 
$role=$this->session->userdata('role');
 	include_once APPPATH . 'views/main_head.php';
 ?>
 

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
							<li class="active">Set Time Table</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1><span class="active">Set Time Table</span></h1>
					  </div><!-- /.page-header -->
                        
			   
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch: </label>
    <div class="col-sm-9">
       <select name="branch" class="col-xs-10 col-sm-5" id="branch" onChange="return get_dept(this.value)">
                    
                              
                              <?php
							  if($role==1 || $role==2)
							  {
							  $branch=$this->db->get('tbl_branch')->result_array();
							  ?>
                              <option value="">--Select--</option> 
                              <?php
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>" ><?php echo $branch1['branch_name'];?></option>
                              <?php 
							  }
							  }
							  if($role==3 || $role==4)
							  {
							  ?><option value="<?php echo $this->session->userdata('branch_id');?>" selected="selected"><?php echo get_branch(); ?></option>
                              <?php
							  }
							  ?>
        </select>
    </div> 
</div>
 <br><br>  

 
		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Departement</label>
    <div class="col-sm-9">
			<select name="department" class="col-xs-10 col-sm-5" id="department" onChange="return get_class(this.value)">
            
            
                              <?php 
							 
							  if($role==1 || $role==2)
							  {
							  ?> <option value="">Select</option> <?php
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  }
							  if($role==3)
							  {
							   ?> <option value="">Select</option> <?php
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  }
							  if($role==4)
							  {
							  ?><option value="<?php echo $this->session->userdata('dept_id');?>" selected="selected"><?php echo get_dept(); ?></option>
                              <?php
							  }
							  ?>
                          </select>
		</div>
	</div>
<br><br>  

		<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class</label>
    <div class="col-sm-9">
			<select  name="class"  onchange="return get_class_sections(this.value)" id="class" class="col-xs-10 col-sm-5">
				<option value="">Select</option>
                <?php 
									 $branch	=$this->session->userdata('branch_id');
									 $dept	=	$this->session->userdata('dept_id');
									 $this->db->where('branch_id',$branch);
									 $this->db->where('dept_id',$dept);
									 $class 	=	$this->db->get('class')->result_array();
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
		</div>
	</div>
   
   
 <br><br>   
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section </label>
    <div class="col-sm-9">
        <select name="section_id" class="col-xs-10 col-sm-5" required="" id="section_id" >
        <option value="">Select</option>
        </select>
    </div>
</div>
    
 <br><br>  
    <div class="col-sm-offset-3 col-sm-5">
      
          <input type="button" class="btn btn-info" name="btnSet" value="Set Time Table" onClick="get_class_hours();"/>
    </div>
</div>
<div style="padding-left:50px;padding-top:25px;padding-right:10px;">
		    <div id="class_hours" class="class_hours">
            
            </div>
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

<script type="text/javascript">
	
	function get_class_sections(class_id) 
	{

    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section1/' + class_id ,
            success: function(response)
            {
                jQuery('#section_id').html(response);
			}
        });
    }
	
	
	function get_class_hours()
	{
		//alert("kkkkk");
	var class_id = document.getElementById('class').value;
	var section_id = document.getElementById('section_id').value;
	var branch_id = document.getElementById('branch').value;
	var dept_id = document.getElementById('department').value;

    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_class_hours/'+class_id+'/'+section_id+'/'+branch_id+'/'+dept_id,
            success: function(response)
            {
			    
                jQuery('#class_hours').html(response);
			}
        });

	}
	
	function get_time_table()
	{
	var class_id = document.getElementById('class').value;
	var section_id = document.getElementById('section_id').value;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_time_table/'+class_id+'/'+section_id,
            success: function(response)
            {
                jQuery('#class_hours').html(response);
			}
        });

	}

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
                jQuery('#class').html(response);
            }
        });
    }
	

	
</script>
