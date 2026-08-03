<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 $running_year = get_running_year(); ?>

<div class="main-content">
<div class="main-content-inner">
  <!-- #section:basics/content.breadcrumbs -->
  <div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
    <ul class="breadcrumb">
      <li> <i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a> </li>
      <li class="active">Exam</li>
    </ul>
    <!-- /.breadcrumb -->
    <!-- #section:basics/content.searchbox -->
    <div class="nav-search" id="nav-search">
      <form class="form-search">
        <span class="input-icon"> </span>
      </form>
    </div>
    <!-- /.nav-search -->
    <!-- /section:basics/content.searchbox -->
  </div>
  <div class="page-content">
    <div class="page-header">
      <h1> Create Exam Time Table </h1>
    </div>
    
    <div class="col-sm-10 widget-container-col">
	<?php echo form_open(base_url() . 'index.php/admin/create_exam_time_table' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
      
      
      <div class="white-box" > <br>
        <br>
        <?php $role=$this->session->userdata('role');
					 if($role==1 || $role==2)
					 {?>
        <div class="padded">
          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Branch :<font color="#FF0000">* </font></label>
            <div class="col-sm-5">
              <select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)" required="">
                <option value="">Select</option>
                <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?>
                <option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                <?php }?>
              </select>
            </div>
          </div>
                   
          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
            <div class="col-sm-5">
              <select name="department" class="select2" id="department" onChange="get_class(this.value);" required="">
                <option value="">Select</option>
              </select>
            </div>
          </div>
                    
          <input type="text" name="selected_branch" id="selected_branch" hidden />
          <input type="text" name="dept" id="dept" hidden />
          <?php 
		  }
		  if($role==3)
		  {
		   ?>
          <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Department :<font color="#FF0000">* </font></label>
            <div class="col-sm-5">
              <select name="department" class="select2" id="department" onChange="get_class(this.value);" required="">
                <option value="">Select</option>
                <?php 
				$branch_id	=	$this->session->userdata('branch_id');
				$this->db->where('branch_id',$branch_id);
				$department=$this->db->get('tbl_department')->result_array();
			  foreach ($department as $depart)
			  {
			  ?>
			<option value="<?php echo $depart['dept_id'];?>"><?php echo $branch1['dept_name'];?></option>
			<?php }?>
              </select>
            </div>
          </div>
          <input type="text" name="selected_branch" id="selected_branch" value="<?php echo $this->session->userdata('branch_id'); ?>" hidden />
          <input type="text" name="dept" id="dept" hidden />
		  <?php 
		  }
		  if($role==4)
		  {
		  				  $dept_id	=	$this->session->userdata('dept_id');
		  ?>
          <input type="text" name="selected_branch" id="selected_branch" value="<?php echo $this->session->userdata('branch_id'); ?>" hidden />
          <input type="text" name="dept" id="dept" value="<?php echo $dept_id; ?>" hidden />
		 <?php 
		 }
		  ?>
         
          <div class="form-group">
            <label class="col-sm-4 control-label">Exam Title<font color="#FF0000">* </font></label>
            <div class="col-sm-5">
              <input type="text" class="form-control" required="" name="exam_title" id="exam_title" placeholder="Name">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-4 control-label">Description</label>
            <div class="col-sm-5">
              <input type="text" class="form-control"  name="description" placeholder="Description" class="col-xs-12 col-sm-12" />
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="submit" class="btn btn-info" onclick="get_details(); return false;" >Next</button>
              <span id="preloader-form"></span> </div>
          </div>
        </div>
    <br />

    <div id="class1"> </div>
    </div>
  </div>
</div>
<br />
        <?php echo form_close();?> </div>

<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action=$this->session->flashdata('action');
if(isset($action))
{
if ($action=="success")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}
if ($action=="failed")
{
echo "<script>toastr.success('". "Failed...', , {timeOut: 5000})</script>";
}
}
?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	document.getElementById('selected_branch').value=branch_id;
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
	function get_class(dept_id) 
	{
	document.getElementById('dept').value=dept_id;
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_classes/' + dept_id ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
	function get_details()
	{
	var exam_title=document.getElementById('exam_title').value;
	var dept_id=document.getElementById('dept').value;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_ajax/' + dept_id+ '/' +exam_title ,
            success: function(response)
            {
                jQuery('#class1').html(response);
            }
        });
    }
</script>

  

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','350px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>
