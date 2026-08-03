<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">View Vehicle Master</li>
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
									 View Vehicle Master
								</small>
							</h1>
                            <div align="right" style="padding-right:100px"> 
                              <a href="<?php echo base_url();?>index.php/Transport_management/view_vehicle_details/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 

                            </div> 
						</div><!-- /.page-header -->
						<div></div>
                     <?php 
                                   echo form_open_multipart('Transport_management/vehicle_master_edit/'.$vehicle_master_id, array('class' => 'form-horizontal','id'=>"myform"));?>

								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
								<style>
                                table.table-bordered{
                                border:1px solid #CCCCCC;
                                margin-top:20px;
                                }
                                table.table-bordered > thead > tr > th{
                                border:1px solid #CCCCCC;
                                }
                                table.table-bordered > tbody > tr > td{
                                border:1px solid #CCCCCC;
                                }
                                </style>
                                <?php
									foreach($vehicle_master as $master)
									{
								?>
                              
                             
                        <table align="center" class="simple-table table table-bordered" style="width:50%;">
                            <tbody>
                                <tr><td style="width:5%">Registration Number</td><td  style="width:10%"><left><?php echo  $master['vehicle_registration_number']; ?></left></td></tr>
                                <tr><td style="width:5%">Bus Number</td><td  style="width:10%"><left><?php echo  $master['bus_number']; ?></left></td></tr>
                                <tr><td style="width:5%">Registration Date</td><td style="width:10%"><left><?php echo date('d-m-Y',strtotime($master['registration_date'])); ?></left></td></tr>
                                <tr><td  style="width:5%">Owner Name </td><td  style="width:10%"><left><?php echo $master['owner_name']; ?></left></td></tr>
                                <tr><td  style="width:5%">Ownership Type</td><td  style="width:10%"><left><?php echo $master['ownership_type']; ?></left></td></tr>
                                <tr><td  style="width:5%">Category</td><td  style="width:10%"><left><?php echo $master['vehicle_category_name']; ?></left></td></tr>
                                <tr><td  style="width:5%">Vehicle Class</td><td  style="width:10%"><left><?php echo $master['vehicle_class_name']; ?></left></td></tr>
                                <tr><td  style="width:5%"> Vehicle Maker</td><td  style="width:10%"><left><?php echo $master['vehicle_class_name']; ?></left></td></tr>
                                <tr><td  style="width:5%">Seat Capacity</td><td  style="width:10%"><left><?php echo $master['seat_capacity']; ?></td></tr>
                                <tr><td  style="width:5%">Tax Licence Number</td><td  style="width:10%"><left><?php echo $master['tax_licence_number']; ?></left></td></tr>
                                <tr><td  style="width:5%">Year of Manufacture:</td><td  style="width:10%"><left><?php echo $master['year_of_manufacture']; ?></left></td></tr>
                                <tr><td  style="width:5%"> Month of Manufacture</td><td  style="width:10%"><left><?php echo $master['month_of_manufacture']; ?></left></td></tr>
                                <tr><td  style="width:5%"> Branch</td><td  style="width:10%"><left><?php echo $master['branch_name'];?></left></td></tr>
                                <tr><td  style="width:5%"> Remarks</td><td  style="width:10%"><left><?php echo $master['remarks'];?></left></td></tr>
                            </tbody>
                         </table>
                    
                                
                                
                                    
                                    
                                     
                                    
                                    
                                     
									
                                    </div>
                                    </div>
                                    
                                     
                                    <?php } echo form_close(); ?>
                                    </div>
</body>
                                  
<?php include_once APPPATH . 'views/footer.php'; ?>