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
							<li class="active">New Designation</li>
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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Designation
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                              <?php $cls= $this->db->get_where('enroll',array('student_id'=>$student_id))->row()->class_id;?>    
                              <a href="<?php echo base_url();?>index.php/admin/view_designation/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
                                   </div> 
						</div><!-- /.page-header -->
                        

                     
                                        <div></div>
                    
                                    
                                    <div>
                     <?php echo form_open('Admin/designation_add', array('class' => 'form-horizontal'));?>
					 
										<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Designation :<font color="#FF0000">* </font></label>

										<div class="col-sm-9">
											<input type="text" id="designation" placeholder="Designation" class="col-xs-10 col-sm-5" name="designation" required/>
										</div>
									</div>
                                  
                                     <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Role :</label>

										<div class="col-sm-9">
											<select name="role" class="col-xs-10 col-sm-5" id="role">
                              <option value="">Select</option>
                              <?php $roles=$this->db->get('tbl_user_roles')->result_array();
							  foreach ($roles as $designation)
							  {
							  ?><option value="<?php echo $designation['role_id'];?>"><?php echo $designation['role_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                     <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9"> 
                        <input type="submit" class="btn btn-info" type="button" value='Add' name="save">  
											
										</div>
                                        
									</div>
                                         <?php echo form_close(); ?>
                                        </div>

                                    </div>
</center>
                                    
</div></div>



			<?php include_once APPPATH . 'views/footer.php'; ?>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
//function ab(){
//swal("Successfull");
//
//
//}
//</script>
<script>
	function ab() 
	{
	//alert(class_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/add_class/' ,
            success: function(response)
            {
                swal("Successfull");
            }
        });
    }
</script>






<script>
function update(args){
   if(confirm('Do you want to submit?')){
      // put all the js code here.
   }else{
      return false;
   }
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>
 <script type="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

	<script>
	function a(){
	bootbox.confirm({
    title: "Destroy planet?",
    message: "Do you want to activate the Deathstar now? This cannot be undone.",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
    callback: function (result) {
        console.log('This was logged in the callback: ' + result);
    }
});
</script>	
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>


		