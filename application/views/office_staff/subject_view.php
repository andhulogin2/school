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
							<li class="active">Subject View</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

					</div>

					
						<div class="page-header">
							<h1>
								Subject
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
							</h1>
						</div>
                        <!-- /.page-header -->
                        
                          
								
                                    
                                   
                                    <div id="hidden" style="padding-top:100px;"></div>
                                    
								<div class="row">
                                
                                
									

									<div class="col-sm-12 infobox-container" >
										<!-- #section:pages/dashboard.infobox -->
                                         <?php
										  foreach($class as $row){?>
										<div class="infobox infobox-red" >
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data" >
                                           
												<span class="infobox-data-number"></span>
												<div class="infobox-content">
												<b><a href="<?php echo base_url(); ?>index.php/office_staff/view_subject/<?php echo $row['class_id']; ?>/<?php echo $row['branch_id']; ?>/<?php echo $row['dept_id']; ?>"><?php echo $row['name'];?></a></b></div>
											</div>
                                          

											<!-- #section:pages/dashboard.infobox.stat 
											<div class="stat stat-success">8%</div>-->

											<!-- /section:pages/dashboard.infobox.stat -->
										</div>
  <?php }?>
										

</div></div></div></div>
											</body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script> 

<script type="text/javascript">  
   $(window).load(function() {  
      $("#loader").fadeOut(1000);  
   });
</script>  	

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
}
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

