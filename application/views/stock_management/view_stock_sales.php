<?php include_once APPPATH . 'views/main_head.php';?>

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
                              <li><a href="<?php echo base_url('purchase'); ?>"><?php echo $this->lang->line('header_purchase'); ?></a></li>
                              <li class="active">Sales details</li>
						</ul><!-- /.breadcrumb -->

						

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Sales details
                                
                                <i class="ace-icon fa fa-angle-double-right"></i>
									 View
                                
							</h1>
						</div><!-- /.page-header -->
                     
					  <!-- PAGE CONTENT BEGINS -->
   <div align="right" style="padding-bottom:10px" > <a href="<?php echo base_url();?>index.php/Stock_management/view_sales" data-dismiss="fileinput"><button class="btn-info">Back</button></a>

<div class="row">
<?php foreach ($master as $row) { ?>
	      	<!-- right column -->
	      	<div class="col-md-12">
		        <div class="box">
		            <div class="table-header">
		             <center>Sales details</center>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-sm-12 well well-sm">
			            	<div class="col-sm-5">
			            	
			            		<div align="left"><b><h4>DETAILS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row['name'];?></b></h4></b></div>
			            	</div>
                            	 		
			            	<div class="col-md-4">
			            		
			            			Total :	<b><?php echo $row['bill_amount'];?></b>		            
			            	
			            			
				            		<br>
				            		
			            		
			            	</div>
			            	<div class="col-md-3">
			            		
								
				            		Discount:<b><h4><?php echo $row['discount_allowed'];?></h4></b>
				            		<br>
				            	Grand Total:	<b><?php echo $row['net_amount'];?></b>	
                                	            	
				            	</div>
			            	</div>
			            </div>
                     
                   <?php  } ?>
			            <div class="col-sm-12" style="overflow-y: auto;">
			            	<table id="search-table" class="table table-striped table-bordered table-hover">
			            		<thead>
			            			
                                 
                                    <th style="text-align: center;">Item</th>
			            			<th style="text-align: center;">Quantity</th>
			            			<th style="text-align: center;">Price</th>
			            			<th style="text-align: center;">Unit</th>
			            			<th style="text-align: center;">Sub Total</th>
			            			<th style="text-align: center;">Discount</th>
			            			<th style="text-align: center;">Total</th>
			            			
			            		</thead>
			            		<tbody>
			            			<?php foreach ($data as $value) { ?>
			            			<tr>
			            			
                                   
                                    <td><center><?php echo $value['item_name'];?></center></td>
                                    <td><center><?php echo $value['sales_quantity'];?></center></td>
                                    <td><center><?php echo $value['unit_rate'];?></center></td>
                                    <td><center><?php echo $value['unit_long_name'];?></center></td>
                                    <td><center><?php echo $value['sales_amount'];?></center></td>
                                    <td><center><?php echo $value['discount'];?></center></td>
                                    <td><center><?php echo $value['net_total'];?></center></td>
                                    
                                                              
			            			</tr>
			            			<?php  } ?>
			            			<tr>
                                    
			            		        <td colspan="6" align="right"><b>Total Amount</b></td>
                                       
			            				<td align="right" colspan="7"><center><b><?php echo $this->session->userdata('symbol'). $row['net_amount'];?></b></center></td>	
			            			</tr>
                                    
			            		</tbody>
                               
			            	</table>
                            
                             <br /><br />
                            
			            </div>
                       
			            <div class="col-sm-12">
			            	<div class="buttons">
								<div class="btn-group btn-group-justified">
									<div class="btn-group">
										<a class="tip btn btn-primary tip" href="<?php echo base_url('purchase/payment/'); ?><?php echo $data[0]->purchase_id; ?>" title="Add Payment">
											<i class="fa fa-money"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('sales_add_payment'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-success" href="<?php echo base_url('index.php/stock_management/pdf_sales/');?><?php echo $row['sales_master_id']; ?>" title="Download as PDF" target="_blank">
											<i class="fa fa-download"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('product_alert_pdf'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-warning tip" href="<?php echo base_url('index.php/stock_management/edit_sales/');?><?php echo $row['sales_master_id']; ?>" title="Edit">
											<i class="fa fa-edit"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_edit'); ?></span>
										</a>
									</div>
									
								</div>
							</div>
			            </div>
		            </div>
		            <!-- /.box-body -->
		        </div>
	            <!-- /.box -->
	        </div>
	        <!--/.col (right) -->
      	</div>
      	<!-- /.row -->
</div>
</div>
</div>



	<?php include_once APPPATH . 'views/footer.php'; ?>

