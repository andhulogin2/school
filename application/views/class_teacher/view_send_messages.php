<?php include_once APPPATH . 'views/class_teacher_head.php';?>
<?php $running_year = get_running_year(); ?>
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
							<li class="active">Messages</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
						
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								Teacher
								<i class="ace-icon fa fa-angle-double-right"></i>
									 Send Messages
							</h1>
						</div>

<?php //echo form_open(base_url() . 'index.php/Class_teacher/submit_message'); ?>

    <div id="subject_holder">
        <div class="form-group">
            <div class="col-md-5" style="text-align:right">
                <label class="control-label" style="margin-bottom:5px;">Date From:</label><br />
            </div>
            <div class="col-md-4" style="margin-bottom:10px;">
                <div class="clearfix">
                    <div class="input-group input-group-sm">
                        <input type="text" name="from_date" id="mydatepicker"  class="form-control mydatepicker" />
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div> 

        <div class="form-group">
            <div class="col-md-5" style="text-align:right">
                <label class="control-label" style="margin-bottom:5px;">Date To:</label><br />
            </div>
            <div class="col-md-4">
                <div class="clearfix">
                    <div class="input-group input-group-sm">
                        <input type="text" name="to_date" id="mydatepicker1"  class="form-control mydatepicker" />
                        <span class="input-group-addon">
                        <i class="ace-icon fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-12" style="padding-top:20px;">
			<center>
				<button type="submit" class="btn btn-info" onclick="get_message_details();" >View Messages</button>
			</center>
		</div>
	</div>
  </div>
       
        <div id="message1">
<div style="margin-left:15px;margin-right:15px;">
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<tr>
<th class="table-header">SL NO</th>
<th class="table-header">Student Name</th>
<th class="table-header">Class</th>
<th class="table-header">Message</th>
<th class="table-header">Date & Time</th>
<th class="table-header">Viewed</th>
<th class="table-header">Viewed Date</th>
<th class="table-header">Action</th>
</tr>
<?php
$i=0;
foreach($message_data as $msg)
{
		$student_name   = $this->db->get_where('student' , array('student_id' => $msg['to_student_id']))->row()->name;
		$class_id   = $this->db->get_where('enroll' , array('student_id' => $msg['to_student_id']))->row()->class_id;
		$section_id   = $this->db->get_where('enroll' , array('student_id' => $msg['to_student_id']))->row()->section_id;
		$class_name   = get_student_class_name($msg['to_student_id']);
		$section_name   = get_student_section_name($msg['to_student_id']);
?>
<tr>
<td><?php echo $i=$i+1; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php echo $class_name."/".$section_name; ?></td>
<td><?php echo $msg['message']; ?></td>
<td><?php echo date('d/m/Y h:i A', strtotime($msg['date_time'])); ?></td>
<?php if($msg['viewed']=='N')
{ ?>
<td><?php echo "No" ?></td>
<td align="center">-</td>
<?php } else { ?>
<td><?php echo "Yes" ?></td>
<td><?php echo date('d/m/Y h:i A', strtotime($msg['viewed_date_time'])); ?></td>
<?php } ?>
<td><a href="#" id="delete_inline<?php echo $msg['message_id']; ?>" onClick="delete_message(<?php echo $msg['message_id']; ?>)" class="tooltip-success" data-rel="tooltip" title="Delete"   data-placement="top" title="Delete" data-original-title="Delete">
<i class="fa fa-remove bigger-130 text-danger"></i>
</a></td>
</tr>
<?php
}
?>
</table>
</div>
        </div>
        
    
<?php //echo form_close();?>
</div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="success")
{
echo "<script>toastr.success('Message Deleted', {timeOut: 5000})</script>";
}
else if($action=="failed")
{
echo "<script>toastr.error('Message Not Deleted', {timeOut: 5000})</script>";
}
?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>                                                           
  <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
        $('.mydatepicker1').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
		
	
    });
	</script>
    
    <script>
	function get_message_details()
	{
		var date_from=document.getElementById('mydatepicker').value;
		var date_to=document.getElementById('mydatepicker1').value;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Class_teacher/get_messages/' + date_from+ '/' +date_to,
            success: function(response)
            {
                jQuery('#message1').html(response);
            }
        });
    }
	</script> 
    
<script>
		function delete_message(id)
		{
			var confirmRes = confirm('Are you sure to Delete this record?');
			if(confirmRes == true)
			{
				$.ajax({
				url: "<?php echo base_url()?>index.php/Class_teacher/delete_message",
				type: "POST",
				data:'&id='+id,
				success: function(data){
					get_message_details();
				if(data==1)
				{
					toastr.success('Deleted Successfully...', {timeOut: 5000});
				}
				else
				{
					toastr.error('Not Deleted...', {timeOut: 5000});
				}
			}        
			});
			}
			else
			{
				return false;
			}
		}
		</script>
