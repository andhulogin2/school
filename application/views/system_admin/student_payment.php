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
        <select name="class" id="class_selector" class="col-xs-10 col-sm-5" required="" onChange="return get_class_sections(this.value)" required>
        <option value="">Select</option>
        <?php 
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
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
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
        var classid = $('#class_selector').val();
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
 
 