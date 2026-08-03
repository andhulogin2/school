<?php include_once APPPATH . 'views/student_head.php';?>
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
								Messages
							</h1>
							
						</div>

<div style="margin-left:15px;margin-right:15px;">
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
<tr>
<th class="table-header">SL NO</th>
<th class="table-header">Send From</th>
<th class="table-header">Date & Time</th>
<th class="table-header">Action</th>
</tr>
<?php
$i=0;
foreach($message_data as $message)
{
		$teacher_id = $message['from_teacher_id'];
		$teacher_name   = $this->db->get_where('staff', array('user_id' => $teacher_id))->row()->name;//echo $this->db->last_query();
?>
<tr>
<td><?php echo $i=$i+1; ?></td>
<td><?php echo $teacher_name; ?></td>
<td><?php echo date('d/m/Y H:i A', strtotime($message['date_time'])); ?></td>
<td><a href="<?php echo base_url(); ?>index.php/Student/view_single_message/<?php echo $message['message_id']; ?>" title="View Message" ><i class="fa fa-eye bigger-130 color=blue"></i></a></td>
</tr>
<?php
}
?>
</table>
</div>

</div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

