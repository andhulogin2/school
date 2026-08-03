<?php include_once APPPATH . 'views/head.php';?>
 

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
							<li class="active">Admission</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								STAFF
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Admission Form
								</small>
							</h1>
						</div>
<div class="col-sm-12 widget-container-col">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4 class="widget-title lighter">Tabs With Scroll</h4>

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="myTab2">
														<li class="active">
															<a data-toggle="tab" href="#home2">New</a>
														</li>

														<li>
															<a data-toggle="tab" href="#profile2">Absentees</a>
														</li>

														<li>
															<a data-toggle="tab" href="#info2">Login Details</a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info3">Send All</a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info4">Special Message</a>
														</li>
                                                        <li>
															<a data-toggle="tab" href="#info5">Malayalam SMS</a>
														</li>
													</ul>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main padding-12 no-padding-left no-padding-right">
													<div class="tab-content padding-4">
                                                    
														<div id="home2" class="tab-pane in active">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
																<?php echo form_open(base_url() . 'index.php/admin/new_private_message/');?>

 <div class="row">
    <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="form-control" required="" onChange="return get_class_sections(this.value)">
                              <option value="0">Select</option>
                             
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
                         
                       
						</div> 
					</div>
    </div>  <div class="col-md-6">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
                           
		                        <select name="section" class="form-control" id="section_selector_holder" onChange="return get_student_details(this.value,class.value)">
		                            <option value="">Select-Class</option>
                                   
                                   
                                   
                                   
			                    </select>
                                
			                </div>
					</div>
</div>
 <div class="col-md-12">
          <div class="form-group">
						<label for="field-2" class="control-label">SMS Template</label>
						<div >
							<select name="template" class="form-control"  onchange="return get_template_content(this.value)">
                              <option value="">Select</option>
                              <?php $template = $this->db->get('sms_template')->result_array();
								foreach($template as $row){ ?>
                            		<option value="<?php echo $row['id'];?>">
									<?php echo $row['title'];}?>
                                    </option>
                               
                          </select>
                          
						</div> 
					</div> 
           </div>
</div>

    <div class="compose-message-editor">
                <textarea class=" form-control" name="message" id="message" rows="10"  placeholder="Write-Message..." onChange="return get_count(this.value)"></textarea>
    </div>
   
  
 
   
   
    <button type="submit" class="btn btn-success btn-icon pull-right">
       Send
        <i class="entypo-mail"></i>
    </button>
<?php echo form_close(); ?>
</div>
</div>



															

															<!-- /section:custom/scrollbar.horizontal -->
														

														<div id="profile2" class="tab-pane">
															<div class="scrollable" data-size="100" data-position="left">
                                                            <?php echo form_open(base_url() . 'index.php/admin/absent_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
																<div class="mail-compose">
    <div class="row">
    <div class="col-md-3">
          <div class="form-group">
						<label for="field-2" class="control-label">Class</label>
						<div >
							<select name="class" id="class_selector_holder" class="form-control" required="" onChange="return get_class_sections1(this.value)">
                              <option value="">Select</option>
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
					  </select>
						</div> 
					</div>
    </div>  <div class="col-md-3">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
		                        <select name="section" onChange="get_details1()"  class="form-control" id="section_selector_holder1">
		                            <option value="0">Select-Class</option>
			                    </select>
			                </div>
					</div>
</div>
  <div class="col-md-3">
	   <div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Date</label>
			<input type="text" class="form-control" name="timestamp" id="timestamp" value="" placeholder="Pick a date" />
                
              <!-- onchange="return get_details(this.value)"
               <input type="text" value="(timestamp.value)" name="date_selected" id="date_selected">-->
		</div>
	</div>
</div>
<div class="row" id="absent">
</div>
    
</div>
															</div>
                                                            <?php echo form_close(); ?>
														</div>
                                                        <div id="info3" class="tab-pane">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
                                                            <div class="col-md-3">
          <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?></label>
						<div >
							<select name="class" id="class_selector_holder" class="form-control" required="" onChange="return get_class_sections(this.value)">
                              <option value="All"><?php echo get_phrase('All'); ?></option>
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
					  </select>
						</div> 
					</div>
    </div> 
    <div class="col-md-6">
         
						 <div class="form-group">
                <label class="col-md-12"><?php echo get_phrase('Message'); ?></span></label>
                <div class="col-md-12">
                    <textarea class="form-control" name="message_send"></textarea>
            <!--<input type="text" name="message_send" class="form-control" />-->                
                   </div>
           
                         
                       
						</div> 
					</div>
                    <br><br><button type="submit" class="btn btn-success">
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button></div></div>
    <div id="info4" class="tab-pane">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
                                                            <?php echo form_open(base_url() . 'index.php?admin/special_message', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
                                                            <div class="col-md-3">
          <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?></label>
						<div >
							<select name="class" id="class_selector_holder4" class="form-control" required="" onChange="return get_class_sections4(this.value)">
                              <option value=""><?php echo get_phrase('Select'); ?></option>
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
					  </select>
						</div> 
					</div>
    </div>  <div class="col-md-3">
					<div class="form-group">
						<label for="field-2" class=" control-label"><?php echo get_phrase('Section'); ?></label>
		                    <div >
		                        <select name="section" onChange="get_details3()"  class="form-control" id="section_selector_holder4">
		                            <option value="0"><?php echo get_phrase('Select-Class'); ?></option>
			                    </select>
			                </div>
					</div>
</div>
<div class="row" id="absent1">
</div>
<?php echo form_close(); ?>

                                                            </div></div>
                                                            <div id="info5" class="tab-pane">
															<div class="scrollable" data-size="100">
                                                            <?php echo form_open(base_url() . 'index.php/admin/new_malayalam_message/');?>
                                                            <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label"><?php echo get_phrase('Class'); ?><font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="form-control" required="" onchange="return get_class_sections5(this.value)">
                              <option value="0"><?php echo get_phrase('Select'); ?></option>
                             
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
                         
                       
						</div> 
					</div>
    </div>  <div class="col-md-6">
					<div class="form-group">
						<label for="field-2" class=" control-label"><?php echo get_phrase('Section'); ?></label>
		                    <div >
                           
		                        <select name="section" class="form-control" id="section_selector_holder5" onchange="return get_student_details(this.value,class.value)">
		                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>
                                   
                                   
                                   
                                   
			                    </select>
                                
			                </div>
					</div>
</div>
<div class="compose-message-editor">
                <textarea class=" form-control" name="message" id="message" rows="10"  placeholder="<?php echo get_phrase('Write-Message'); ?>..." onchange="return get_count(this.value)"></textarea>
    </div>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button>
    <?php echo form_close(); ?>
                                                            </div></div>
                                                            

														<div id="info2" class="tab-pane">
															<div class="scrollable" data-size="100">
																<?php echo form_open(base_url() . 'index.php/admin/new_notification_message/');?>

 <div class="row">
    <div class="col-md-6">
          <div class="form-group">
						<label for="field-2" class="control-label">Class<font color="#FF0000">*</font></label>
						<div >
							<select name="class" class="form-control" required="" onChange="return get_class_sections3(this.value)">
                              <option value="0">Select</option>
                             
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
                         
                       
						</div> 
					</div>
    </div>  <div class="col-md-6">
					<div class="form-group">
						<label for="field-2" class=" control-label">Section</label>
		                    <div >
                           
		                        <select name="section" class="form-control" id="section_selector_holder3" onChange="return get_student_details(this.value,class.value)">
		                            <option value="">Select-Class</option>
                                   
                                   
                                   
                                   
			                    </select>
                                
			                </div>
					</div>
</div>
 
</div>

    
   
  
    
    </div>
 <td></td>
   
    <center><button type="submit" class="btn btn-success btn-icon pull-right">
        Send
        <i class="entypo-mail"></i>
    </button></center>
</form>
</div>
															</div>
                                                            <?php echo form_close(); ?>
                                                            
														</div>
                                                        
													</div>
                                                    
												</div>
											</div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            <?php include_once APPPATH . 'views/footer.php'; ?>
											<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
	function get_student_details(section_id,class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_student_details/' + class_id +'/' + $section_id,
            success: function(response)
            {
                jQuery('#reciever').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    function get_template_content(id)
  {
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_template_content/' + id ,
            success: function(response)
            {
                jQuery('#message').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    function get_count(message)
  {
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_count/' +message,
            success: function(response)
            {
                jQuery('#msgcount').html(response);
            }
        });
    }
</script>

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>
    
    <script type="text/javascript">
	function get_class_sections1(class_id) 
	{
		jQuery('#absent').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder1').html(response);
            }
        });
    }
</script>
<script type="text/javascript">	
 function get_details1(){
 
	 jQuery('#absent').html("");
	 
        var classid = $('#class_selector_holder').val();
        var section = $('#section_selector_holder1').val();
		var date = $("#timestamp").val();
		alert(date);
		console.log(section);
		console.log(date);
		if(section == "0" || date==""){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/get_absent_student_for_message/' + classid + '/' + section + '/' + date ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent').html(response);
            }
   });
}
</script>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
				jQuery('#timestamp').datepicker().on('changeDate', function(e) {
				// `e` here contains the extra attributes
				get_details();
			});
        });
    </script>
    <script type="text/javascript">
	function get_class_sections3(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder3').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
	function get_class_sections4(class_id) 
	{
		jQuery('#absent').html("");
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder4').html(response);
            }
        });
    }
</script>
<script type="text/javascript">	
 function get_details3(){
	 jQuery('#absent1').html("");
        var classid = $('#class_selector_holder4').val();
        var section = $('#section_selector_holder4').val();
		alert("section " +section);
		alert("class " +classid);
		//var date = $("#timestamp").val();
		//console.log(section);
		//console.log(date);
		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/admin/get_special_message_students/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#absent1').html(response);
            }
   });
}
</script>
<script type="text/javascript">
	function get_class_sections5(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder5').html(response);
            }
        });
    }
</script>
