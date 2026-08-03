<?php include_once APPPATH . 'views/head.php';?>
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
								<a href="#">Home</a>							</li>
							<li class="active">Enquiry</li>
						    <li class="active">View Enquiry</li>
						</ul>
				    <!-- /.breadcrumb -->

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
							<h1>View<small>
									<i class="ace-icon fa fa-angle-double-right"></i>Enquiry</small>
							</h1>
						</div>

<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	
		<div class="tab-content">
        <div class="table-header"> 		Enquiry Details								</div>
			<div class="tab-pane active" id="running">
				<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;">No.</th>
			<th style="text-align: center;"><div>Date </div></th>
            <th style="text-align: center;"><div>Name</div></th>
            <th style="text-align: center;"><div>Address</div></th>       
            <th style="text-align: center;"><div>Mobile</div></th>
            <th style="text-align: center;"><div>Options</div></th>
             
		</tr>
	</thead>
	<tbody>
 <?php error_reporting(0);
         echo $condition;
     $counter = 1;
		
		foreach($query_result as $row):?>
		           <?php
   {
   ?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
    <td><?php echo $row['date'];?></td>
    <td><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></td>
    <td><?php echo $row['address'];?></td>    
    <td><?php echo $row['phone1'];?></td>
   
   

         
         	<td style="text-align: center;" class="text-nowrap">
<a data-toggle="tooltip" data-placement="top" href="<?php echo base_url();?>index.php/enquiry_controller/view_call_details/<?php echo $row['enquiry_id']?>" title="View Call" data-original-title="View Call"> <span class="green">
         <i class="green ace-icon fa fa-eye bigger-120"></i> 
</a> 
       
       &nbsp;&nbsp;&nbsp;
        
	
         <a data-toggle="tooltip" data-placement="top" href="<?php echo base_url();?>index.php/enquiry_controller/call_details/<?php   echo $row['enquiry_id']?>"title="Add Call" data-original-title="Add Call"> <span class="green">
		 <i class="ace-icon fa fa-phone bigger-120"></i></span>
 </a>          
              &nbsp;&nbsp;&nbsp;
								
         <a href="<?php echo base_url();?>index.php/enquiry_controller/edit/<?php echo $row['enquiry_id'];?>" data-toggle="tooltip" data-placement="top"title=" Edit/View" data-original-title="Edit/View"> <span class="green">
		 <i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
         </a>
    
             &nbsp;&nbsp;&nbsp;
   
        <a href="<?php echo base_url();?>index.php/enquiry_controller/delete/<?php echo $row['enquiry_id'];?>" data-toggle="tooltip"  data-placement="top" title="Delete" data-original-title="Delete"> <span class="red">
		<i class="ace-icon fa fa-trash-o bigger-120"></i> </span>
        </a>
			
                   &nbsp;&nbsp;&nbsp;

						
        <a data-toggle="tooltip" data-placement="top" href="<?php echo base_url();?>index.php/enquiry_controller/admit_enquiry/<?php   echo $row['enquiry_id']?>" title="Admit" data-original-title="Admit"> <span class="green">
         <i class="green ace-icon fa fa-user bigger-120"></i> 
         </a>
         </td></tr>
        <?php
		}
		?>
		<?php endforeach;?>
	</tbody>
</table>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>
</div>
  <?php echo form_close(); ?>
 <?php  echo form_open(base_url() . 'index.php/enquiry_controller/enquiry_report/');?>

      <div align="right">
        <div class="col-sm-offset-3 col-sm-8">
         <input type="checkbox" id="chk_excel" name="chk_excel"  /> Save As Excel &nbsp;&nbsp;&nbsp;
                          
          <input type="submit" class="btn btn-info"  value="Show Report">
         	
			

		
        </div>    
</div>
</div>
</div>
  <?php echo form_close(); ?>

<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script> 
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