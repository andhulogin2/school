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
							<li class="active">New Section</li>
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
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Section
								
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/admin/section/<?php echo $cls;?>"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                       <?php echo form_open('Admin/add_section', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="class_id" id="class_id" class="select2" required>
                              <option value="">Select</option>
                              <?php  $role=$this->session->userdata('role');
                              $running_year   =   get_running_year();
				if($role==1 ||$role==2)
				{
				$this->db->where('academic_year',$running_year);    
				$classes = $this->db->get('class')->result_array();
				}
				if($role==3)
				{
				$this->db->where('academic_year',$running_year);    
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$classes = $this->db->get('class')->result_array();
				}
				if($role>=4)
				{
				$this->db->where('academic_year',$running_year);    
				$this->db->where('dept_id',$this->session->userdata('dept_id'));
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$classes = $this->db->get('class')->result_array();
				}
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
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Section Name :<font color="#FF0000">* </font></label>
                                                                <div class="col-sm-9">
                            <input type="text" id="name" placeholder="Section Name" class="col-xs-10 col-sm-5" name="name" onblur="check_section_exist(this.value)"  required/>
                            &nbsp;<label id="errMsg" style="display:none;color:red;font-size:12px;">Section Name already exist.</label>
                        </div>
                    </div>
                    
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Select Teacher :</label>


                    <div class="col-sm-9">
                        <select name="teacher_id" id="teacher_id" class="select2" data-validate="required">
                            <option value="">Select Teacher</option>
                            <?php 
                            if($role==3)
                            {
                                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                            }
                            if($role>=4)
                            {
                                $this->db->where('dept_id',$this->session->userdata('dept_id'));
                                $this->db->where('branch_id',$this->session->userdata('branch_id'));
                            }
                            $this->db->where('staff.role',6);
                            $teachers = $this->db->get('staff')->result_array();
                          foreach($teachers as $row){
                          ?>
                                		<option value="<?php echo $row['staff_id'];?>"><?php echo $row['name']; ?></option>
                            <?php
                           }
                            ?>
                        </select>
                      &nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#add_teacher_modal" style="font-size:12px"><i class="fa fa-plus"></i> New Teacher</a>
                          
										</div>
									</div>
									
<!----------------------Add new teacher Modal begins ------------------------->

  <div class="modal fade" id="add_teacher_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Teacher</h4>
        </div>
        <div class="modal-body">
        <p>
          
		<?php if($this->session->userdata('role')==1  || $this->session->userdata('role')==2) { ?>
        
		<div class="form-group">
        <div class="col-sm-4">Branch:</div>
        <div class="col-sm-8">
          <select name="branch1" class="col-xs-10 col-sm-6 form-control"  id="branch1" onChange="get_dept1(this.value);" >
          <option value="">Select</option>
          <?php $branch=$this->db->get('tbl_branch')->result_array();
          foreach ($branch as $branch1)
          {
          ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
          <?php }?>
          </select></div>
          </div>

		<div class="form-group">
         <div class="col-sm-4"> Department:</div>
         <div class="col-sm-8">
            <select name="department1" class="col-xs-10 col-sm-6 form-control"  id="department1"  >
            <option value="">Select</option>
            </select></div>
            </div>
            
          <?php }
		  if($this->session->userdata('role')==3) { ?>
          
		<div class="form-group">
          <div class="col-sm-4">Department:</div>
          <div class="col-sm-8">
            <select name="department1" class="col-xs-10 col-sm-6 form-control"  id="department1" />
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
            
            <input type="hidden" name="branch1" id="<?php echo $this->session->userdata('branch_id'); ?>"  >

            <?php }
			  if($this->session->userdata('role')>=4) { 
			 ?>
            <input type="hidden" name="branch1" id="branch1" value="<?php echo $this->session->userdata('branch_id'); ?>" >
            <input type="hidden" name="department1" id="department1" value="<?php echo $this->session->userdata('dept_id'); ?>" >
        	<?php } ?>

		<div class="form-group">
          <div class="col-sm-4">Teacher Name:</div>
          <div class="col-sm-8">
			<input id="new_teacher" name="new_teacher" placeholder="Teacher Name" type="text" class="form-control" >
	      </div>
        </div>  
          
		<div class="form-group">
          <div class="col-sm-4">User Name:</div>
          <div class="col-sm-8">
			<input id="user_name" name="user_name" placeholder="User Name" type="text" onchange="username(this.value);" class="form-control">
         <label id="errorMsg" style="display:none;color:red;font-size:12px;">Username Name already exist.</label></div><br><br>
	    </div>
        
		<div class="form-group">
          <div class="col-sm-4">Password:</div>
          <div class="col-sm-8">
			<input id="password" name="password" placeholder="Password" type="password" class="form-control">
	     </div>
        </div> 
        
		<div class="form-group">
          <div class="col-sm-4">Phone Number:</div>
          <div class="col-sm-8">
			<input id="phone_number" name="phone_number" placeholder="Phone Number" type="text" class="form-control">
	     </div>
        </div> 
        
         <div align="center"><button type="button" class="btn btn-info" id="btn_insert" onClick="insert_new_teacher();">Insert</button></div>
</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- --------------------add new teacher modal ends--------------------------------- -->                          
								
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='Add' id="btnSubmit"> 
											
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    


</div>
                                
                                
                                
                                <!-- PAGE CONTENT ENDS -->
							<!-- /.col -->
		
			<!-- /.main-content -->
        		
	

			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_teachers() 
	{
	//alert(class_id);
		var branch_id = $('#branch1').val();
		var dept_id = $('#department1').val();

    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_teachers/' + branch_id +'/'+ dept_id ,
            success: function(response)
            {
                jQuery('#teacher_id').html(response);
            }
        });
    }


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
    function check_section_exist(section_name)
    {
        if(section_name!='')
        {
            var class_id    =   $('#class_id').val();
        	$.ajax({
                url: '<?php echo base_url();?>index.php/admin/check_section_exist/' + section_name +'/'+class_id,
                success: function(response)
                {
                    if(response==1)
                    {
                        $('#errMsg').show();
                        $('#btnSubmit').prop('disabled',true);
                    }
                    else if(response==0)
                    {
                        $('#errMsg').hide();
                        $('#btnSubmit').prop('disabled',false);
                    }
                    //jQuery('#section_selector_holder').html(response);
                }
            });
        }
        else
        {
            $('#errMsg').hide();
            $('#btnSubmit').prop('disabled',false);
        }
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	function get_dept1(branch_id) 
	{
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department1').html(response);
            }
        });
    }
  
  function username(user_name)
  {
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/check_username_exist/' +user_name,
            success: function(response)
            {
                    if(response==1)
                    {
                        $('#errorMsg').show();
                        $('#btn_insert').prop('disabled',true);
                    }
                    else if(response==0)
                    {
                        $('#errorMsg').hide();
                        $('#btn_insert').prop('disabled',false);
                    }
          //      jQuery('#check_username').html(response);
            }
        });
    }
	
function insert_new_teacher()
{
		var branch_id = $('#branch1').val();
		var dept_id = $('#department1').val();
		var teacher_name = $('#new_teacher').val();
		var user_name = $('#user_name').val();
		var password = $('#password').val();
		var phone_number = $('#phone_number').val();

		$(".error").remove();
		if(branch_id==""){
		   $('#branch1').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(dept_id==""){
		   $('#department1').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(teacher_name==""){
		   $('#new_teacher').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(user_name==""){
		   $('#user_name').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(password==""){
		   $('#password').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else if(phone_number==""){
		   $('#phone_number').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
		else{
		$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/insert_new_teacher/' + teacher_name +'/'+ dept_id +'/'+ branch_id +'/'+ user_name +'/'+ password +'/'+ phone_number,
            success: function(response)
            {
				if(response == "1")
				{
					$("#add_teacher_modal .close").click();
					reload_teachers();
				}
				else if(response == "0")
				{
					alert("Teacher Not Added.");
					$("#add_teacher_modal .close").click()
				}
            }
        });
	}
}
function reload_teachers()
{
	//var branch_id	=	$("#branch").val();
	var dept_id		=	$("#department1").val();
	if(dept_id!='')
	{
		get_teachers(dept_id);
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