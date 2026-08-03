<?php $role=$this->session->userdata('role');
 	include_once APPPATH . 'views/main_head.php';
 ?>
 

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
							<li class="active">Set Class Timing</li>
						</ul>
                        <div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					</div>
                        
                        <!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>Set Class Timing<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 View
								</small>
							</h1>
						</div> 
                        
                         <?php echo form_open('Hourly_attendance/set_class_timing', array('class' => 'form-horizontal'));    ?>              
                        
                              <?php
							  if($role==1 || $role==2)
							  {
							  ?>
                       
                       <div class="col-md-12">
					   <label class="col-sm-1"> Branch: </label>

    <div class="col-sm-3">
       <select name="branch" class="select2" id="branch" >
                    
                              
                              
                              <option value="">--Select--</option> 
                              <?php
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>" ><?php echo $branch1['branch_name'];?></option>
                              <?php 
							  }
							 ?>
        </select>
    </div> 
 
                                       
                                       
                                       <div class="col-sm-3">
                         <input type="submit" class="btn btn-info" type="button" value='Show'> 
										</div>
          </div>
          <?php } ?>                              

                          <?php echo form_close(); ?>
<br /><br /> <br>                       
				 
                     <?php echo form_open('Hourly_attendance/save_class_timing/'.$branch_id, array('class' => 'form-horizontal'));?>

<div class="row">
    <div class="col-md-12">
    <div class="white-box">
		<div class="row" style="padding-left:100px;">
		</div>
 <div>
 
 
           <div class="table-header">
			<center><?php echo "Branch:" .get_branch($branch_id ); ?></center>
          </div> 
 
          <table id="simple-table" class="table table-striped table-bordered table-hover ">
                <tr>
                    <th style="text-align: center;" class="table-header">No.</th>
                    <th style="text-align: center;" class="table-header">Timing Name</th>
                    <th style="text-align: center;" class="table-header">Start Time </th>
                    <th style="text-align: center;" class="table-header">End Time</th>
                    <th style="text-align: center;" class="table-header">Check Timing</th>
                </tr>
                    <?php
					 $count=1;
                    foreach ($class_timing as $timing){
                     ?>
                       <tr>
                            <td><?php echo $count++; ?>
                            <input type="hidden" name="timing_id[]" value="<?php echo $timing['class_timing_details_id']; ?>" />
                            </td>
                            <td><?php echo $timing['timing_name']; ?></td>
                            <td><input type="text" name="start_time[]" id="start_time[]" value="<?php echo $timing['start_time']; ?>" /> </td>
                            <td><input type="text" name="end_time[]" id="end_time[]" value="<?php echo $timing['end_time']; ?>" /> </td>
                            <td><?php 
							$checked="";
							if($timing['is_active']=='Y')
								 $checked="checked";
							 ?>
                             <input type='checkbox' name='timing[]' <?php echo $checked; ?>  onclick="chek_status();" title="Select If Working Day"/>
                             <input type="hidden" name="timing_checked[]" value="<?php echo $timing['is_active']; ?>" /></td>
                        </tr>
                    <?php  } ?>
            </table>
									
                    <div class="col-md-offset-3 col-md-9">
                         <input type="submit" class="btn btn-info" type="button" value='Show'> 
											
									   </div>
                                        
									</div>
      </div>
                                    </div>
                                    <?php echo form_close(); ?>
									</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
			<?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript">            
function chek_status()
{
var chk_days = document.getElementsByName('timing[]');
var check_status = document.getElementsByName('timing_checked[]');
var count_item = check_status.length;
var check_uncheck=document.getElementsByName('timing[]');	
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

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','260px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>  