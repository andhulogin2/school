<?php $role=$this->session->userdata('role');
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
							  
							      <li>Set Holidays</li>
						   
							</li>
						</ul>
                        <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					</div>
                    </div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
							Set Working Days
                            <small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								</small>
							</h1>
						</div>  
                     <?php echo form_open('Hourly_attendance/save_working_days/', array('class' => 'form-horizontal'));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
   
                    
                              
 <?php if($role==1 || $role==2) { ?>
                                 <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Branch: <font color="#FF0000">* </font></label>
                                <div class="col-sm-9">
                                   <select name="branch" class="col-xs-10 col-sm-5" id="branch" required="required" >
                                      <option value="">--Select--</option> 
                                      <?php
                                      foreach ($branch as $branch1)
                                      {
                                      ?><option value="<?php echo $branch1['branch_id'];?>" ><?php echo $branch1['branch_name'];?></option>
                                      <?php 
                                      }
                                     ?>
                 				  </select>
                                </div> 
                                </div>
 <?php   } ?>  
 
<?php if($role==3 || $role==4 || $role==5 || $role==6)
{
?>
<input type="hidden" name="branch" id="branch" value="<?php echo $this->session->userdata('branch_id'); ?>" />
<?php
} 
?>                                
                                    
                                    
                                    
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Choose Year:<font color="#FF0000">* </font></label>
								    	<div class="col-sm-9">
											<select class="col-xs-10 col-sm-5" id="year" name="year" data-placeholder="Select A Year">
                                                  <option value="<?php echo  date('Y'); ?>"><?php echo  date('Y'); ?></option>
                                                <option value="<?php echo  date('Y')-1; ?>"><?php echo  date('Y')-1; ?></option>
                                              
                                                <option value="<?php echo  date('Y')+1; ?>"><?php echo  date('Y')+1; ?></option>
                                            </select>
										</div>
									</div>
                                    
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Choose Month:<font color="#FF0000">* </font></label>
								    	<div class="col-sm-9">
											<select class="col-xs-10 col-sm-5" id="month" name="month" data-placeholder="Select A Month" onchange="get_holidays(this.value)">
                                                <option value="">Select Month</option>
                                                <option value="1">January</option>
                                                <option value="2">Febraury</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                             </select>
										</div>
									</div>
                                    <div id='holiday_list_holder' class='holiday_list_holder' style="padding-left:150px;padding-right:150px;"></div>
                                    
                               
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                         <input type="submit" class="btn btn-info" type="button" value='Update'> 
											
									   </div>
                                        
									</div>
                 
                                    <?php echo form_close(); ?>
                                    </div>
                                     </div>
                                    </div>

			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_holidays(month_id) 
	{
	var year = $('#year').val();
	var branch_id = $('#branch').val();
	//alert(branch_id);

    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_working_days/' + month_id +'/'+year+'/'+branch_id,
            success: function(response)
            {
                jQuery('#holiday_list_holder').html(response);
            }
        });
    }
</script>


