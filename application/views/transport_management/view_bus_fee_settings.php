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
								<a href="#">Home</a>
							</li>
							<li class="active">Transportation</li>
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
								View
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Bus Fee Settings
							</h1>
						</div><!-- /.page-header -->
                        
				         
                     
                     <?php echo form_open_multipart('Transport_management/view_bus_fee_settings1', array('class' => 'form-horizontal','id'=>"myform"));?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                    
                                    
                                    <?php if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   { 
					   if($this->session->userdata('role')==1  || $this->session->userdata('role')==2){?>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font> </label>

										<div class="col-sm-9">
											<select name="branch_id" class="select2" id="branch_id" required="" >
                              <option value="">Select</option>
                              <?php 
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    
                                    <?php ?>
                                     

									<!-- /section:elements.form -->
									

								                     <div class="col-md-offset-3 col-md-9">
                        <input type="button" class="btn btn-info"  value='Submit' onClick="get_settings()" > 
											
										</div>
                                        
									</div>
                    <?php echo form_close(); ?>
                    <br> <br> <br>
                  <?php
				  	}
					
				    else if($this->session->userdata('role') == 3 || $this->session->userdata('role') >= 4) 
		             {
					 
					 $branch_id = $this->session->userdata('branch_id');
					 ?>
					<div onload="LoadSettings(<?php echo $branch_id; ?>)"> </div>
                     <?php   
					 }
					}
					 ?>
                    <div id="bus_fee_settings" style="padding-left:10px;padding-top=50px;"></div>              
                                   
              </body>  
                         
				  
                   
                                   
<?php include_once APPPATH . 'views/footer.php'; ?>
				
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
$action=$this->session->flashdata('action');
if ($action=="Failed")
{
	echo "<script>toastr.error('". "Not Updated...', 'Updation Failed', {timeOut: 5000})</script>";
}
else if (strpos($action, 'updated') !== false)
{
	echo "<script>toastr.success('".$action."', 'Success', {timeOut: 5000})</script>";
}
else
{
}
?>

<script type="text/javascript">
	function get_settings()
	{
	var branch_id = document.getElementById("branch_id").value;
		$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus_fee_settings/'+branch_id ,
            success: function(response)
            {
				//alert(response);
                jQuery('#bus_fee_settings').html(response);
            }
        });
	}

function LoadSettings(branch_id){
	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/get_bus_fee_settings/'+branch_id ,
            success: function(response)
            {
				//alert(response);
                jQuery('#bus_fee_settings').html(response);
            }
        });
}
$(function(){
	$('div[onload]').trigger('onload');
});
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
