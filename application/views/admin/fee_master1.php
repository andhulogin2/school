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
							<li class="active">Fee Master</li>
						</ul>
                        <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Fee Master 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Course Fee Details
								
							</h1>
						</div><!-- /.page-header -->
                        
                        
         
         
          <div align="right" style="padding-right:10px;"><a href="<?php echo  base_url();?>index.php/FeeManagement/setup_fee">New Fee Plan</a></div>              
          <br>
            <table id="simple-table" class="table table-striped table-bordered table-hover"  cellpadding="2">
              <thead>
                <tr>
                  <th style="text-align: center;" class="table-header">SNo.</th>
                  <th style="text-align: center;" class="table-header">Name</th>
				  <th style="text-align: center;" class="table-header">Class Name</th>
                  <th style="text-align: center;" class="table-header">Total Fee</th>
			      <th style="text-align: center;" colspan="3" class="table-header">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php  $i=1;   foreach($fee_master as $row):       ?>
        <tr>
         <td style="text-align: center;"><?php echo $i; $i=$i+1;;?></td>
         <td style="text-align: center;"><?php echo html_entity_decode( $row['fee_master_name'],ENT_COMPAT,'UTF-8');?></td>
         <td style="text-align: center;"><?php echo $row['name'];?></td>
         <td style="text-align: center;"><?php echo $row['fee_total'];?></td>
         
         
		<td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url();?>index.php/FeeManagement/edit_fee_master/<?php echo $row['fee_master_id'];?>"  data-toggle="tooltip" title="Edit" data-original-title="Edit"> <i class="fa fa-edit text-info"></i> </a></td>			       
        <td style="text-align: center;" class="text-nowrap"><a href="<?php echo  base_url();?>index.php/FeeManagement/fee_master/delete/<?php echo $row['fee_master_id']."/".$row['class_id'];?>" data-toggle="tooltip"  title="Delete" onClick="return confirm('Are you sure to delete this entry?');" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a></td>
        
        
        <td style="text-align: center;" class="text-nowrap"><a href="<?php echo  base_url();?>index.php/FeeManagement/fee_details_view/<?php echo $row['fee_master_id']."/".$row['class_id'];?>" data-toggle="tooltip" title="Setup Installments"><i class="fa fa-wrench text-info"></i></a></td>
               </tr>
                <?php endforeach;?>
              </tbody>
            </table>
           </div></div></div></div></div></body>
           
<?php include_once APPPATH . 'views/footer.php'; ?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
