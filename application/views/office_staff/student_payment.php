<?php include_once APPPATH . 'views/office_staff_head.php';?>
 

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
							<li class="active">Fee Payment</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Student Fee
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Pay Fee
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
									<!-- #section:elements.form -->
<div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/FeeManagement/student_payment/'; ?>">Choose Another</a></div>
 
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
       <select  name="class"  onchange="get_class_sections(this.value)" id="class" class="col-xs-10 col-sm-5">
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
<br />	<br />

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="section" onChange="get_details()"  class="col-xs-10 col-sm-5" id="section_selector" required>
            <option value="">Select</option>
        </select>
    </div>
</div>
<br>
<div  class="form-group" id="payment"> </div>
                                    </div></div></div></body>

			<?php include_once APPPATH . 'views/footer.php'; ?>




<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/office_staff/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector').html(response);
            }
        });
    }
</script>
<script type="text/javascript">	
 function get_details(){
	 jQuery('#payment').html("");
        var classid = $('#class').val();
        var section = $('#section_selector').val();
		console.log(section);

		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/FeeManagement/student_payment_details/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#payment').html(response);
				document.getElementById("class_selector").disabled = true;
				document.getElementById("section_selector").disabled = true;
            }
   });
}
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 
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

 
 