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
							<li class="active">News</li>
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
								News
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Add
								
							</h1>
						</div>


<div class="row">
    <div class="col-md-12">
		<div align="right" style="padding-right:10px;padding-bottom:10px;"><a href="<?php echo base_url() . 'index.php/Admin/news'; ?>"><b><button class="btn-info">Back</button></b></a></div> 
        <div class="panel panel-info">
            <div class="panel-heading"><font color="#FFFFFF">Send News</font>
            </div>
            <br>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php/admin/news/create/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                
                <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
					 
										 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                                   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" required="">
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
											<select name="department" class="select2" id="department" required="">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    <?php } }?>
                                    
                                     <?php $role=$this->session->userdata('role');
					 if($role==3)
					 {?>
					 
										 <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                                   
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<select name="department" class="select2" id="department" required="">
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
                                    <?php } }?>
                                    
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Title<font color="#FF0000">* </font></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="Required" value="" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"></textarea>
                    </div>
                </div>
<div class="form-group">
<label for="field-1" class="col-sm-3 control-label">Photo</label>
                        
						<div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				
				<div class="hr hr-12 dotted"></div>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>           
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                            Send</button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
         </div></div></div></div></div></div></div>
    
<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
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

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','260px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              
