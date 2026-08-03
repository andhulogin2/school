<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>

<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs" id="breadcrumbs">
      <script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>
      <ul class="breadcrumb">
        <li> <i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a> </li>
        <li class="active">Hall Ticket</li>
      </ul>
      <div class="nav-search" id="nav-search">
        <form class="form-search">
          <span class="input-icon"> </span>
        </form>
      </div>
    </div>
    <div class="page-content">
      <div class="page-header">
        <h1> Hall Ticket</h1>
      </div>
      
      <div class="row col-md-8" >
        <div class="table-responsive" >
        
          <div class="form-group"  style="padding-bottom:20px;">
            <label class="col-md-3"><?php echo get_phrase('Exam Title'); ?></label>
            <div class="col-md-9">
              <select name="exam_title" class="select2" id="exam_title" required="">
                <option value="0">Select</option>
              <?php
              $title=$this->db->query("SELECT DISTINCT exam_title FROM tbl_exam_time_table_master")->result_array();
			  foreach($title as $t){
			  ?>
                <option value="<?php echo $t['exam_title']; ?>"><?php echo $t['exam_title']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group"  style="padding-bottom:20px;">
            <label class="col-md-3"><?php echo get_phrase('Class Name'); ?></label>
            <div class="col-md-9">
              <select name="class" class="select2" id="class" onchange="get_student(this.value);">
                <option value="0">select</option>
                <?php 
				  $this->db->where('academic_year',get_running_year());	
				  $this->db->where('dept_id',$this->session->userdata('dept_id'));
                  $class = $this->db->get('class')->result_array();
                  foreach($class as $row){ 
                  ?>
                <option value="<?php echo $row['class_id'];?>"> <?php echo $row['name'];?> </option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          
          <input type="text" name="class" id="class" hidden >
          
          <div class="form-group">
            <label class="col-md-3"></label>
            <div class="col-md-9">
              <button id="hall_ticket" class="btn btn-info waves-effect waves-light m-r-10" onClick="get_hall_ticket(this.value); return false;" >Get Hall Ticket</button>
            </div>
          </div>
        </div>
      </div>
      
          <div id="hall_ticket1">
          </div>
      
    </div>
  </div>
</div>
<?php include_once APPPATH . 'views/footer.php'; ?>


<script type="text/javascript">
	function get_student(class_id) 
	{
		document.getElementById('hall_ticket').value = class_id;
    }
</script>

<script type="text/javascript">
	function get_hall_ticket(class_id) 
	{
		var exam_title=document.getElementById('exam_title').value;
		$.ajax({
            url: '<?php echo base_url();?>index.php/Admin/get_hall_ticket/' + class_id + '/' + exam_title,
            success: function(response)
            {
                jQuery('#hall_ticket1').html(response);
            }

        });
    }
</script>
