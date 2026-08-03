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
								<a href="#">Home</a>							</li>
							<li class="active">Follow-Up Details</li>
						    <li class="active">View Follow-Up Details</li>
						</ul>
				    <!-- /.breadcrumb -->

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
							<h1>Call Details
									<i class="ace-icon fa fa-angle-double-right"></i>View Follow-Up Details
							</h1>
						</div>
	<div>				
	  <div align="right">
       <a  href="<?php echo base_url();?>index.php/enquiry_controller/enquiry_view/"><b><button class="btn-info">Back</button></b></a><br /><br />
	   <table>
	   <tr>
      <td><a   href="<?php echo base_url();?>index.php/enquiry_controller/call_details/<?php echo $enquiry_id ?>"><b>Add Call</b></a> </td>	</tr>
	 
     </table>
  </div>
	</div>
    </div>
     <?php  echo form_open(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id);?>


                                   <div class="form-group">
								   <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> <span class="col-sm-2">
								  
								   </span>From Date :</label>
								   <div class="col-sm-2"><div class="clearfix">
								   <div class="input-group input-group-sm"><input type="text" name="date_from" id="date_from" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />	
                                   <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
				      </div>
                                      
 
                                   <div class="form-group">
								   <label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> <span class="col-sm-2">
								  
								   </span>To Date:</label>
								   <div class="col-sm-2">
								     <div class="clearfix">
								   <div class="input-group input-group-sm">
                                   <input type="text" name="date_to" id="date_to" value="<?php echo date('d-m-Y'); ?>" class="form-control mydatepicker"  />
		                           <span class="input-group-addon">
								   <i class="ace-icon fa fa-calendar"></i>
								   </span>
						      	   </div>
								   </div>
								   </div>
								   </div>
                                      
                                      

<input type="submit" class="btn btn-info" name="view" value=" Show ">
 <?php echo form_close(); ?>
<br />
	<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	
		 <div class="table-responsive">
			
				<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;"  class="table-header">No.</th>
			<th style="text-align: center;"  class="table-header"><div>Date</div></th>
            <th style="text-align: center;"  class="table-header"><div>Follow-up By</div></th>
            <th style="text-align: center;"  class="table-header"><div>Next Follow up Date</div></th>

            <th style="text-align: center;"  class="table-header"><div>Remark</div></th>
			
			<th style="text-align: center;"  class="table-header"><div>Options</div></th>
			
		</tr>
	</thead>					
						
	<tbody>
		<?php		
     $counter = 1;
		
		
		foreach($call as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		
	 <td><?php echo date('d-m-Y',strtotime($row['date']));?></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo date('d-m-Y',strtotime($row['next_followup_date']));?></td>

    <td><?php echo $row['remark'];?></td>

    
		<td style="text-align: center;">
           &nbsp;&nbsp;&nbsp;
								
         <a href="<?php echo base_url();?>index.php/enquiry_controller/edit_call/<?php echo $row['call_id'] ?>" data-toggle="tooltip" data-placement="top"title=" Edit/View" data-original-title="Edit/View"> <span class="green">
		 <i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span>
         </a>
    
             &nbsp;&nbsp;&nbsp;
   
        <a href="<?php echo base_url();?>index.php/enquiry_controller/delete_call/<?php echo $row['call_id'] ?>/<?php echo $enquiry_id ?>" data-toggle="tooltip"  data-placement="top" title="Delete" data-original-title="Delete"> <span class="red">
		<i class="ace-icon fa fa-trash-o bigger-120"></i> </span>
        </a>
			
            	
             
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

</div></div></div></div>
 <?php  echo form_open(base_url() . 'index.php/enquiry_controller/enquiry_followup_download/'.$enquiry_id.'/'.$fdate.'/'.$tdate);?>
         <div class="col-sm-offset-3 col-sm-2">
        
                          
          <input type="submit" class="btn btn-info" value="Download">
         	
			

		
         
</div></div></div><br /><br /><br /><br />
 
 <?php echo form_close(); ?>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="assets/js/neon-custom-ajax.js"></script> 
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
 
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


						