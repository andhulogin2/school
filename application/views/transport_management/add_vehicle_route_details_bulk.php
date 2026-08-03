<?php include_once APPPATH . 'views/main_head.php';?><body>
        
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
							<li class="active">Add Bulk Vehicle Route Details</li>
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
								TRANSPORTATION
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Vehicle Route Details
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <?php //$cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_route_details/<?php echo $route_master_id; ?>" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->

                     

	<?php echo form_open(base_url().'index.php/Transport_management/vehicle_route_details_add_bulk', array('class' => 'form-inline validate','method' => 'POST'));?>							
	<div class="row">                                      
        <div class="col-md-offset-3 col-md-4" style="text-align:center">
            <input type="text" class="col-md-12" value="<?php foreach ($master as $master_type){ if($master_type['route_master_id']==$route_master_id){ echo $master_type['route_master_name']; } } ?>" readonly >
            
            <input type="hidden" name="route_master_id" id="route_master_id" value="<?php echo $route_master_id; ?>"  >                        
            </div>
        </div>           
                 
	<div class="col-md-12" style="padding-top:20px;">										
        <div id="bulk_add_form">
            <div id="student_entry">
                <div class="row" style="margin-bottom:10px;">
                	<div class="col-md-2">
                        <div class="form-group" style="padding:1%;">
                            <input type="text" name="pickup_point[]" id="pickup_point" class="form-control"  placeholder="Pick Up Point*" onChange="check_pickup_point(this.value)" required>
                        </div>
                	</div>
                	<div class="col-md-2">
                        <div class="form-group" style="padding:1%;">
                            <input type="text" name="pickup_point_lattitude[]" id="pickup_point_lattitude" class="form-control"  placeholder="Pick Up Point Lattitude">
                        </div>
                	</div>
                    
                	<div class="col-md-2">
                        <div class="form-group" style="padding:1%;">
                            <input type="text" name="pickup_point_longitude[]" id="pickup_point_longitude" class="form-control"  placeholder="Pick Up Point Longitude">
                        </div>
                	</div>
                	<div class="col-md-2">
                        <div class="form-group" style="padding:1%;">
                            <input type="text" name="distance[]" id="distance" class="form-control"  placeholder="Distance*" required>
                        </div>
                	</div>
                	<div class="col-md-2">
                        <div class="form-group" style="padding:1%;">
                            <input type="text" name="base_fare[]" id="base_fare" class="form-control"  placeholder="Basr Fare*" required>
                        </div>
                	</div>
                    <div class="col-md-2">
                        <div class="form-group" style="padding:1%;">
                            <button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>" onClick="deleteParentElement(this)" style="margin-left: 10px;">
                                <i class="fa fa-trash-o" style="color: #fff;"></i>
                            </button>
                        </div>
                	</div>
                </div>
            
            </div>
        
        
        	<div id="student_entry_append"></div>
        	<br>
        
            <div class="row">
                <center>
                    <button type="button" class="btn btn-info" onClick="append_student_entry()">
                        <i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
                    </button>
                </center>
            </div>
        
        	<br><br>
            <div class="row">
                <center>
                    <input type="submit" class="btn btn-success" id="btnSubmit" name="submit_button" value="Save">
                </center>
            </div>
            <?php echo form_close();?> 
            
             
            <div class="hr hr32 hr-dotted"></div>
            <div></div>
        </div>
	</div>                                             
                                       
                                        
                                    </div>     
									</div>
                                    </div>
                                    </body>
                                  
			<?php include_once APPPATH . 'views/footer.php'; ?>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

 

<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action	=	$this->session->flashdata('action');
if ($action=="Inserted")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="Failed")
{
echo "<script>toastr.error('". "Not Added...', 'Failed', {timeOut: 5000})</script>";
}

?>

<script type="text/javascript">
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<4;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});
	function append_student_entry()
	{
	//alert("xzfd");
		$("#student_entry_append").append(blank_student_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode.parentNode);
	}

	function check_pickup_point(pickup_point) 
	{ 
		var route_master_id	 = document.getElementById("route_master_id").value;
		//alert(route_master_id+pickup_point);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Transport_management/check_pickup_point/' + pickup_point + '/'+ route_master_id ,
            success: function(response)
            { 
				if(response=="1")
				{
                	alert("Pickup Point Already Exist");
					$( "#btnSubmit" ).prop( "disabled", true );
				}	
				if(response=="0")
				{
					$( "#btnSubmit" ).prop( "disabled", false );
				}	
            }
        });
    }

</script> 	 

		