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
							<li class="active">Setup Fee</li>
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
								Setup  
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Fee Structure
								
							</h1>
						</div><!-- /.page-header -->
                     
                      
                      <div align="right" style="padding-right:50px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_master'; ?>"><b><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Back</b></a></div> 

                       <?php echo form_open('FeeManagement/save_fee_master/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

       
          <div class="white-box">
            <br><br>
            

		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Class<font color="#FF0000">* </font></label>
         <div class="col-sm-9">
			<select  name="lst_class"  onchange="select_section(this.value)" id="class_id" class="col-xs-12 col-sm-5" required>
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
          
					
<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Fee Plan Name<font color="#FF0000">* </font></label>
    <div class="col-sm-9">
    <input type="text" class="col-xs-10 col-sm-5" name="txt_fee_plan_name"  id="txt_fee_plan_name" required=""  >
    </div> 
</div>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Payment Mode<font color="#FF0000">* </font></label>
    <div class="col-sm-9">
        <select name="lst_payment_option" id="lst_payment_option" class="col-xs-10 col-sm-5"  onchange="get_installments(this.value)" required="">
        <option value="">Select Option</option>
			<?php
            foreach($options as $row): ?>
            <option value="<?php echo $row['fee_payment_options_master_id'];?>">
            <?php echo $row['fee_payment_options_master'];?>
            </option>
            <?php
            endforeach;
            ?>
        </select>
    </div> 
</div>

<div class="form-group">
    <div class="col-sm-5">
        <div class="row" id="payment_details" align="center">
        
        </div>
    </div>
</div>
  
        <?php echo form_close();?>
            </div></div></div></body>                       
                                   

										
			
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">	
 function get_installments(){
 
	 jQuery('#payment_details').html("");
	   var payment_option = $('#lst_payment_option').val();
       $.ajax({
	    url: 'setup_fee2/'+payment_option,
            success: function(response)
            {
				console.log(response);
                jQuery('#payment_details').html(response);
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
	function get_class1(department) 
	{
	//alert(department);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_cls/' + department ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
        });
    }
	

	
</script>