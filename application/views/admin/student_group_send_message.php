<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?><body>
        
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
							<li class="active">Groups</li>
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
								Groups
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Send Message
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Admin/view_student_group/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                    <?php 
						if($group_for=="students")
						{
							echo form_open_multipart('Admin/send_message_to_student_group', array('class' => 'form-horizontal','id'=>"myform"));
                        }
                        else
                        {
							echo form_open_multipart('Admin/send_message_to_staff_group', array('class' => 'form-horizontal','id'=>"myform"));
                        }
						?>
                        	<input type="hidden" name="students_group_master_id" id="students_group_master_id" value="<?php echo $students_group_master_id; ?>" >
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Message: <font color="#FF0000">*</font></label>
										<div class="col-sm-4">
											<textarea class="form-control" rows="5" required name="message_content" ></textarea>
                                        </div>
									</div>
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-4" align="center"><input type="submit" value="Send" class="btn btn-info"></div>
					<?php echo form_close(); ?>
                        </div>
                    </body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
			

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">

	function get_dept(branch_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department_id').html(response);
            }
        });
    }

</script>            