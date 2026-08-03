<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
  $running_year = get_running_year(); ?>
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
							<li class="active">birthdays</li>
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								View
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Birthdays
								
							</h1>
						</div> 
                                    
        <div class="form-group">
            <div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Date From</label>
				<input type="text" name="from_date" id="from_date" style="width:150px;" class="mydatepicker" required  />
			</div>
		</div>
        
        <div class="form-group">
            <div class="col-md-2">
				<label class="control-label" style="margin-bottom:5px;">Date To</label>
				<input type="text" name="to_date" id="to_date" style="width:150px;" class="mydatepicker" required  />
			</div>
		</div><br /><br /><br /><br />

    <div class="row">
    	<div class="col-md-4" style="text-align:center;padding-left:25px;">
        	<input type="button" name="submitBtn" value="Get" class="btn btn-info" onclick="return get_birthday_details()" />
        </div>
    </div>
                      
   <div id="birthday">     
    	<div class="col-md-12">
			<div class="form-group">
			
			</div>
    	</div>
    </div>
            </div>
            </div>
          </div>
          </div>
                   
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
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
	
	function get_birthday_details()
	{
		var from_date	=	$('#from_date').val();
		var to_date		=	$('#to_date').val();
	//	alert(from_date);
			$(".error").remove();
		if(from_date!="" && to_date!=""){
		$.ajax({
			url: '<?php echo base_url();?>index.php/Admin/get_birthdays/'+from_date + '/'+to_date ,
			success: function(response)
			{
				jQuery('#birthday').html(response);
			}
		});
		}
		else{
		if(from_date=='')
       $('#from_date').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
	   else if(to_date=='')
       $('#to_date').after('<span class="error" style="font-size:12px;color:red;">This field is required</span>');
		}
	}
	
</script>