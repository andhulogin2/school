<?php 
$role=$this->session->userdata('role');
 	include_once APPPATH . 'views/main_head.php';
 ?>
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
							  
							      <li>Set Week Days</li>
						   
							</li>
						</ul>						<!-- #section:basics/content.searchbox -->
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
								Set Week Days
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								</small>
							</h1>
						</div>  
                        
                         <?php echo form_open('Hourly_attendance/save_week_days', array('class' => 'form-horizontal'));?>
                          <div class="row">
    <div class="col-md-12">
    <div class="white-box">
		<div class="row" style="padding-left:100px;">
		</div>
 <div>
          <table id="simple-table" class="table table-striped table-bordered table-hover ">
                <tr>
                    <th style="text-align: center;" class="table-header">No.</th>
                    <th style="text-align: center;" class="table-header">Short Name</th>
                    <th style="text-align: center;" class="table-header">Day </th>
                    <th style="text-align: center;" class="table-header">Check Working Day</th>
                </tr>
                    <?php
					 $count=1;
                    foreach ($week_days as $day){
                     ?>
                        <tr>
                            <td><?php echo $count++; ?>
                            <input type="hidden" name="day_id[]" value="<?php echo $day['week_day_id']; ?>" />                            </td>
                            <td><?php echo $day['week_day_short_name']; ?></td>
                            <td><?php echo $day['week_day_long_name']; ?></td>
                          <td><?php 
							$checked="";
							if($day['is_working_day']=='Y')
								 $checked="checked";
							 ?>
                             <input type='checkbox' name='days[]' <?php echo $checked; ?>  onclick="chek_status();" title="Select If Working Day"/>
                             <input type="hidden" name="day_checked[]" value="<?php echo $day['is_working_day']; ?>" /></td>
                        </tr>
                    <?php } ?>
            </table>
									
                    <div class="col-md-offset-3 col-md-9">
                         <input  class="btn btn-info" type="submit" value='Update'> 
											
									   </div>
                                        
									</div>
      </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    </div>

			<?php include_once APPPATH . 'views/footer.php'; ?>
            <script type="text/javascript">            

function chek_status()
{
var chk_days = document.getElementsByName('days[]');
var check_status = document.getElementsByName('day_checked[]');
var count_item = check_status.length;
var check_uncheck=document.getElementsByName('days[]');	
  for (var i = 0;  i < count_item; i++)
   {
   if(chk_days[i].checked)
	{
	   check_status[i].value='Y';
	 //  for(j=0;j<count_item;j++) fee_item_balance[j].checked=false;
	}
	else
	{
	    check_status[i].value='N';
 }   }
}
</script>

    
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
	echo "<script>toastr.success('". "Week Day Updated Successfully..', 'Updation', {timeOut: 5000})</script>";
else if($action=="failed")
	echo "<script>toastr.error('". "Week Day Updation Failed..', 'Error', {timeOut: 5000})</script>";
?>
