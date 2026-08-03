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
								Create 
								
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Class
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/admin/view_class/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Admin/add_class', array('class' => 'form-horizontal'));
					 $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
					 
										 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" required="required">
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
											<select name="department" class="select2" id="department" required="required">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    <?php } }?>
                                    
                                     <?php if($this->session->userdata('role')==3)
{?>

		<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
			<select name="department" class="select2" id="department" onChange="return get_class1(this.value)" required="required">
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
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class Name :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="class" placeholder="Class Name" class="col-xs-10 col-sm-5" name="class" onblur="check_class_exist(this.value)" required/>
										    <label id="errMsg" style="display:none;color:red">Class Name already exist.</label>
										</div>
									</div>

														
															<button type="submit" id="btnSubmit" class="btn btn-info" style="margin-left:400px;">
																Save
															</button>
                                                            <div></div>
														<br />
													</form>
												</div>
											</div>
										</div>
                                         <?php echo form_close(); ?>
                                        </div>

                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
//function ab(){
//swal("Successfull");
//
//
//}
//</script>
<script>
	function ab() 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/add_class/' ,
            success: function(response)
            {
                swal("Successfull");
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






<script>
function update(args){
   if(confirm('Do you want to submit?')){
      // put all the js code here.
   }else{
      return false;
   }
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
 <script type="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

	<script>
	function a(){
	bootbox.confirm({
    title: "Destroy planet?",
    message: "Do you want to activate the Deathstar now? This cannot be undone.",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
    callback: function (result) {
        console.log('This was logged in the callback: ' + result);
    }
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

