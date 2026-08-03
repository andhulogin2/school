<?php include_once APPPATH . 'views/main_head.php';?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
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
								<a href="#">Home</a>							</li>
							<li class="active">Call Details</li>
						    <li class="active">Add Call Details</li>
						</ul>
				    <!-- /.breadcrumb -->

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
							<h1>Call Details<i class="ace-icon fa fa-angle-double-right"></i> Add Call Details</h1>
					  </div><!-- /.page-header -->
                        
				<?php
									$admin=$this->session->userdata('login_user_id');
									$this->db->select('name');
									$this->db->from('admin');
									$this->db->where('admin_id',$admin);
									$query=$this->db->get()->row();
									
                        ?>
                     
                     <?php   echo form_open('enquiry_controller/add_call_details/'.$enquiry_id, array('class' => 'form-horizontal'));?>
                     
					  <!-- PAGE CONTENT BEGINS -->
								
	    <!-- #section:elements.form -->
	       
                 

			   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date of Call: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <input type="text"  class="form-control mydatepicker" name="date" required="" placeholder="Date of Enquiry" value="<?php echo date('d-m-Y')?>"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                      
<div class="space-2"></div>
             
                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="timepicker1"> Time :</label>
                                    <div class="col-sm-2">
                                    <div class="clearfix">
                                    <div class="input-group bootstrap-timepicker">
									<input id="timepicker" type="text" name="time" class="form-control" required="" placeholder="Time of Enquiry" value="<?php date_default_timezone_set("Asia/Kolkata"); echo date('H:s a')?>"/> 
                                    <span class="input-group-addon">
                                    <i class="fa fa-clock-o bigger-110"></i>
                                    </span>
                                    </div>
									</div>
									</div>
                                    </div>
                                      
<div class="space-2"></div>

							
                                    <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Follow-up By :<font color="#FF0000">*</font></label>
									<div class="col-sm-9">
									<input type="text" id="name" value="<?php  echo $query->name; ?>" class="col-xs-10 col-sm-5" name="name" />
									</div>
									</div>
                                      
                                    

                                    
<div class="space-2"></div>
                                  					   
								   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Next Follow-up Date: </label>
								   <div class="col-sm-2">
								   <div class="clearfix">
											<!-- #section:plugins/date-time.datepicker -->
								   <div class="input-group input-group-sm">
								   <input type="text" class="form-control mydatepicker" name="call_date" required="" placeholder="Next Follow-up Date"/>
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
   <div class="space-2"></div>
             
                                      
								   <div class="form-group">
								   <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Remark: </label>
								   <div class="col-sm-9">
								   <textarea cols="10" rows="10" class="col-xs-10 col-sm-5" id="remark" name="remark" ></textarea>
								   </div>
					               </div>
 


<div class="space-2"></div>
                      
                                  
									
                                    
                                    
                                     
									 <div class="clearfix form-actions">
                    <div class="col-md-offset-4 col-md-9">
                        <input type="submit" class="btn btn-info"  value="Submit"> 

                       <a class="btn btn-info "  href="<?php echo base_url();?>index.php/enquiry_controller/enquiry_view/">Back</a> 
											
						
										</div>
                                        
									</div>
                                    </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </div></body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
          <script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>

		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-timepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/bootstrap-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/x-editable/ace-editable.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.scroller.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.colorpicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.fileinput.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.typeahead.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.spinner.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.treeview.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.wizard.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/elements.aside.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.ajax-content.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.touch-drag.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-box.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-skin.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>


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
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>




