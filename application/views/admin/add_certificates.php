<?php include_once APPPATH . 'views/main_head.php';?>
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
				<li class="active">Certificates</li>
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
		<div class="page-content">
			
			<div class="page-header">
				<h1>
					View
					
						<i class="ace-icon fa fa-angle-double-right"></i>
						 Certificates
					
				</h1>
			</div> 
			<div align="right" style="padding-right:10px"><a href="" data-toggle="modal" data-target="#certificate_modal" style="font-size:12px"><button class="btn-info">New Certificate</button></a></div>
				  <br>
				  
<!----------------------Modal begins ------------------------->

  <div class="modal fade" id="certificate_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Certificate</h4>
        </div>
        <div class="modal-body">
			  <p>
				 <?php echo form_open_multipart('Admin/add_certificate', array('class' => 'form-horizontal','id'=>"myform"));?>
				<div class="form-group">
					<div class="col-sm-3">Name:</div>
					<div class="col-sm-9">
						<input type="text" name="certificate_name" class="form-control" onkeyup="check_certificate_exist(this.value)"  />					
					</div>
				</div>
				<div class="col-sm-offset-3 col-sm-9" id="certificate_exist"></div>
			</p>
        </div><br /><br />
        <div class="modal-footer">
         <div><button type="submit" class="btn btn-info" id="btnSubmit" >Save</button>
				  <?php echo form_close(); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
  <!-- --------------------modal ends--------------------------------- -->                          
				   
           <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th class="table-header"><center>Sl No.</center></th>
						<th class="table-header"><center>Certificate Name</center></th>
					    <th class="table-header" colspan="2"><center>Action</center></th>
					</tr>
				</thead>

				 <tbody>
				  <?php $count = 1;
					 $query	=	$this->db->get('student_certificates')->result_array();
					 foreach($query as $branch){?>
					<tr>
						<td><center><?php echo $count++;?></center></td>
						<td><center><?php echo $branch['certificate_name'];?></center></td>
						<td align="center"><a href="" data-toggle="modal" data-target="#certificate_edit_modal_<?=$branch['certificate_id'] ?>" style="font-size:12px"><i class="fa fa-edit text-info"></i></a></td>
						<td align="center">
						<?php 
						$this->db->select('certificates_submitted');
						$this->db->like('certificates_submitted',",'".$branch['certificate_id']."'");
						$submiitted_certificate = $this->db->get('student')->result_array();
//						print_r($submiitted_certificate);
						if(count($submiitted_certificate)!='0') {
						 ?>
						<i class="fa fa-close" style="color:#999999" title="you can't delete this.certificate submitted by students."></i>
						<?php } else { ?>
						<a href="<?php echo base_url();?>index.php/admin/certificate_delete/<?php echo $branch['certificate_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are you sure?');"><i class="fa fa-close text-danger"></i></a>
						<?php }  ?>
<!----------------------Modal begins ------------------------->

  <div class="modal fade" id="certificate_edit_modal_<?=$branch['certificate_id'] ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Certificate</h4>
        </div>
        <div class="modal-body">
			  <p>
				 <?php echo form_open_multipart('Admin/certificate_edit/'.$branch['certificate_id']);?>
				<div class="form-group">
					<div class="col-sm-3">Name:</div>
					<div class="col-sm-9">
						<input type="text" name="certificate_name1" class="form-control" value="<?php echo $branch['certificate_name'];?>"  />					
					</div>
				</div>
			</p>
        </div><br /><br />
        <div class="modal-footer">
         <div><button type="submit" class="btn btn-info" id="btnSubmit1" >Save</button>
				  <?php echo form_close(); ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>
  <!-- --------------------modal ends--------------------------------- -->                          
					</td></tr>
				<?php }?>	
				</tbody>
            </table>
            </div>
            </div>
          </div>
          </div>
          <div></div>
          <?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>
<script>
function check_certificate_exist(cetificate){
	$.ajax({
		url: '<?php echo base_url();?>index.php/admin/check_certificate_exist/' + cetificate ,
		success: function(response)
		{
				if(response=="1")
				{
					jQuery('#certificate_exist').html("<span style='color:red'>Certificate already exist.</span>");
					$('#btnSubmit').prop('disabled',true);
				}
				else if(response=="0")
				{
					jQuery('#certificate_exist').html("<span style='color:red'></span>");
					$('#btnSubmit').prop('disabled',false);
				}
		}
	});
}
</script>