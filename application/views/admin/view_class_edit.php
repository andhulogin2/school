<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 


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
							<li class="active">New Class</li>
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
								Edit
								
									<i class="ace-icon fa fa-angle-double-right"></i>
								Class
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                              <div align="right"><a href="<?php echo base_url();?>index.php/Admin/view_class/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> </div>

                     <?php echo form_open('Admin/edit_class', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                  <?php  $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
					 
										 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" required="">
                              <option value="">Select</option>
                              <?php 
							   $branch_id=$this->db->get_where('class',array('class_id'=>$class_id))->row()->branch_id;
							  $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  if($branch_id==$branch1['branch_id'])
							  {
							  ?>
                              <option value="<?php echo $branch1['branch_id'];?>" selected="selected"><?php echo $branch1['branch_name'];?></option>
                              <?php
							  }
							  else
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php } }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" required="">
                              <option value="">Select</option>
                             <?php 
							  $dept_id=$this->db->get_where('class',array('class_id'=>$class_id))->row()->dept_id;
							  //$this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  if($dept_id==$dept1['dept_id'])
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>" selected="selected"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  }?>
                              
                          </select>
										</div>
									</div>
                                    <?php } }?>
                                    
                                     <?php if($this->session->userdata('role')==3)
{?>

		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class1(this.value)" required="">
            <option value="">Select</option>
            
                              <?php
							   $dept_id=$this->db->get_where('class',array('class_id'=>$class_id))->row()->dept_id; 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  if($dept_id==$dept1['dept_id'])
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>" selected="selected"><?php echo $dept1['dept_name'];?></option>
                              <?php
							  }
							  else
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php } }?>
                             
                             
                              
                          </select>
		</div>
	</div>
    <?php } ?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="name" placeholder="Class Name" class="col-xs-10 col-sm-5" name="name" value="<?php echo $a;?>" required=""/>
										</div>
									</div>
<input type="hidden" id="cls_id" value="<?php echo $class_id;?>" class="col-xs-10 col-sm-5" name="cls_id" />
                                   
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                   
                                    <?php echo form_close(); ?>
                                    

											</div>
			<?php include_once APPPATH . 'views/footer.php'; ?>

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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function a(){
swal("Successfull");


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