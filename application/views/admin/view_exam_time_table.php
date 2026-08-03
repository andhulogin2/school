<?php
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
      <h1> Exam Time Table </h1>
    </div>
    
    <div class="col-sm-10 widget-container-col"> 
	<?php echo form_open(base_url() . 'index.php/admin/create_exam_time_table' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
      
      
      <div class="white-box" > <br>
        <br>
                  <div class="form-group">
            <label class="col-sm-4 control-label no-padding-right" for="form-field-1">Exam Title :<font color="#FF0000">* </font></label>
            <div class="col-sm-5">
              <select name="exam_title" class="select2" id="exam_title" required="">
                <option value="">Select</option>
              <?php
              $title=$this->db->query("SELECT DISTINCT exam_title FROM tbl_exam_time_table_master")->result_array();
			  foreach($title as $t){
			  ?>
                <option value="<?php echo $t['exam_title']; ?>"><?php echo $t['exam_title']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        
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

          <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>
			<div class="col-sm-5">
				<select name="class" id="class" class="select2" required="" onChange="get_exam_time_table(this.value)">
                <option value="">Select</option>
                </select>
				</div>
		  </div>
          
          <?php }
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
          
                    <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>
			<div class="col-sm-5">
				<select name="class" id="class" class="select2" required="" onChange="get_exam_time_table(this.value)">
                <option value="">Select</option>
                </select>
				</div>
		  </div>

		  <?php 
		  }
		  if($role>=4)
		  {
		  				  $dept_id	=	$this->session->userdata('dept_id');
		  ?>
          <input type="text" name="selected_branch" id="selected_branch" value="<?php echo $this->session->userdata('branch_id'); ?>" hidden />
          <input type="text" name="dept" id="dept" value="<?php echo $dept_id; ?>" hidden />

          <div class="form-group">
			<label class="col-sm-4 control-label no-padding-right" for="form-field-1-1">Class:<font color="#FF0000">* </font> </label>
			<div class="col-sm-5">
				<select name="class" id="class" class="select2" required="" onChange="get_exam_time_table(this.value)">
                <option value="">Select</option>
                <?php 
				$branch_id	=	$this->session->userdata('branch_id');
 				$dept_id	=	$this->session->userdata('dept_id');
				$this->db->where('branch_id',$branch_id);
				$this->db->where('dept_id',$dept_id);
				$this->db->where('academic_year',$running_year);
				$class=$this->db->get('class')->result_array();
			  foreach ($class as $r)
			  {
			  ?>
			<option value="<?php echo $r['class_id'];?>"><?php echo $r['name'];?></option>
			<?php }?>
              </select>
				</div>
		  </div>
		 <?php 
		 }
		  ?>

          
<!--          <input type="text" name="selected_branch" id="selected_branch" hidden />
          <input type="text" name="dept" id="dept" hidden />
-->          

    <br />

    <div id="exam_time_table"> </div>
    </div>
  </div>
</div>
<br />
        <?php echo form_close();?> </div>

<?php include_once APPPATH . 'views/footer.php'; ?>

<script>
    $(document).ready(function(){
      $('#myTable').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "columnDefs": [
          { "visible": false, "targets": 2 }
          ],
          "order": [[ 2, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

                last = group;
              }
            } );
          }
        } );
    $('#example tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
        table.order( [ 2, 'desc' ] ).draw();
      }
      else {
        table.order( [ 2, 'asc' ] ).draw();
      }
    });
  });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
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
	function get_exam_time_table(class_id)
	{
		var branch_id=document.getElementById('selected_branch').value;
		var dept_id=document.getElementById('dept').value;
		var exam_title=document.getElementById('exam_title').value;
		if(class_id!='' && exam_title!='')
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/admin/exam_time_table_ajax/' +branch_id+ '/' + dept_id+ '/' +class_id+ '/' +exam_title ,
				success: function(response)
				{
					jQuery('#exam_time_table').html(response);
				}
			});
		}
		else
		{
			jQuery('#exam_time_table').html('');
		}	
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
