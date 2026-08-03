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
							<li class="active">Enquiry</li>
						    <li class="active">Approved Enquiry</li>
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
							<h1>View
									<i class="ace-icon fa fa-angle-double-right"></i>Approved Enquiry
							</h1>
						</div>
        <?php  echo form_open(base_url() . 'index.php/enquiry_controller/approved_enquiry_view/');?>


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
<?php  echo form_open(base_url() . 'index.php/enquiry_controller/sendsms/');?> 
<div class="row">
	<div class="col-md-12">
	
		
       
			<div class="tab-pane active" id="running">
             <div class="table-responsive">
				<table class="table table-bordered datatable" >
	<thead>
		<tr>
			<th style="text-align: center;"  class="table-header"><input type="checkbox" name="selectall" id="selectall" onChange="select_deselcet_all()" />
No.</th>
			<th style="text-align: center;"  class="table-header"><div>Date </div></th>
            <th style="text-align: center;"  class="table-header"><div>Name</div></th>
            <th style="text-align: center;"  class="table-header"><div>Course</div></th>       
            <th style="text-align: center;"  class="table-header"><div>Mobile</div></th>
             <th style="text-align: center;"  class="table-header"><div>Remark</div></th>
         
            <?php  if($this->session->userdata('role')==3){
			?>
              <th style="text-align: center;"  class="table-header"><div>Departement</div></th>
              <?php } ?>
           
             
		</tr>
	</thead>
	<tbody>
 <?php error_reporting(0);
         echo $condition;
     $counter = 1;
		
		foreach($enquiry_list as $row):
		
		?>
		           <?php
   {
   ?>
		<tr>
    <td style="text-align: center;"><input type="checkbox" name="chk[]" name="chk[]" value="<?php echo $row['enquiry_id']; ?>"/> &nbsp;&nbsp;&nbsp;<?php echo $counter++; ?></td>
    <td><?php echo date('d-m-Y',strtotime($row['date']));?></td>
    <td><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></td>
    <td><?php echo $row['name'];?></td>    
    <td><?php echo $row['phone1'];?></td>
     <td><?php echo $row['remark'];?></td>
     <?php  if($this->session->userdata('role')==3){
			?>
      <td><?php echo $row['dept_name'];?></td>
      <?php } ?>
   
   

         
         	</tr>
        <?php
		}
		
		?>
		<?php endforeach;?>
	</tbody>
</table>
			</div>
            </div>
		</div>
        <div class="col-sm-offset-3 col-sm-6" >
        
  <div class="col-sm-5">
   
         <textarea  id="msg" name="msg" placeholder="Message"></textarea>
         </div>
           <div class="col-sm-2 col-xs-6">               
          <input type="submit" class="btn btn-info"  value="SEND SMS" >
         	
			

		
         
</div>
<?php echo form_close(); ?>
        <?php  echo form_open(base_url() . 'index.php/enquiry_controller/approved_enquiry_download/'.$fdate.'/'.$tdate);?>
         <div class="col-sm-offset-3 col-sm-2 col-xs-2">
        
                          
          <input type="submit" class="btn btn-info" value="Download">
         	
			

		
         
</div>
 
 <?php echo form_close(); ?>
 
  

</div></div></div></div></div><br /><br /><br />

       
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
    <script>
    function select_deselcet_all()
{
var check = document.getElementById('selectall');
var students = document.getElementsByName('chk[]');
 for(var i =0; i< students.length;i++)
        students[i].checked=check.checked;

}
</script>
   