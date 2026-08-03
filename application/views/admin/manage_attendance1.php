
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
							<li class="active">Attendance</li>
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
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Attendance
								
							</h1>
						</div>             
                  
  

<?php echo form_open(base_url() . 'index.php/admin/attendance_selector/'); ?>
<div class="row">

    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;">Class</label>
            <select name="class_id" class="select2" onchange="select_section(this.value)">
                <option value="">Select</option>
                <?php
                    $yr=get_running_year();
				$this->db->where('branch_id',$branch_id);
				$this->db->where('dept_id',$dept_id);
				$this->db->where('academic_year',$yr);
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
				if($row['class_id']==$class_id)
				{
                    ?>
                    <option value="<?php echo $row['class_id']; ?>" selected="selected"> <?php echo $row['name']; ?></option>
                 <?php
				 }
				 else
				 {
				   ?>
                    <option value="<?php echo $row['class_id']; ?>"> <?php echo $row['name']; ?></option>
                 <?php
				 }
				            
                         endforeach; ?>
            </select>
        </div>
    </div>


<div id="section_holder">
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;">Section</label>
            <select name="section_id" id="section_id" class="select2">
                <?php
                    $yr=get_running_year();
				 $this->db->where('class_id',$class_id);
	             $this->db->where('academic_year',$yr);
				 $sections = $this->db->get('section')->result_array();
                foreach ($sections as $row): ?>
                    <option value="<?php echo $row['section_id']; ?>" 
                            <?php if ($section_id == $row['section_id']) echo 'selected'; ?>>
                            <?php echo $row['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div class="col-md-2">
        <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;">Date</label>
               <div class="col-md-12">
           <input type="text" name="timestamp" value="<?php echo date('d/m/Y', $timestamp);?>" class="form-control mydatepicker">
            </div>
        </div>
</div>

    <input type="hidden" name="year" value="<?php echo $running_year; ?>">
    <input type="hidden" name="branch" value="<?php echo $branch_id; ?>">
    <input type="hidden" name="department" value="<?php echo $dept_id; ?>">
    <div class="col-md-2" style="margin-top: 20px;">
        <button type="submit" class="btn btn-info">Show</button>
    </div>

</div>
<?php echo form_close(); ?>

<hr />

<div class="row">
    
    <div class="col-md-12">
    <div class="white-box">
        <?php echo form_open(base_url() . 'index.php/admin/attendance_update/'.$branch_id.'/'.$dept_id.'/' . $class_id . '/' . $section_id . '/' . $timestamp); ?>
         <input type="hidden" name="timestamp1" value="">
		
        
		<div class="row" style="padding-left:50px;">
			<div class="form-group">
				<label class="switch switch-success"><input type="checkbox" checked name="absent_notification" id="absent_notification" value="1"><span></span> Send-Absent-Notification</label> 
				<label class="switch switch-success"><input type="checkbox" checked name="late_notification" id="late_notification" value="1"><span></span> Send-Late-Notification </label> 
                 <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
              {
			  ?>
                <label class="switch switch-success"><input type="checkbox" checked="checked" name="no_diary_notification" id="no_diary_notification" value="1"><span></span> Send No Diary Notification</label> 
                <?php } ?>
			</div>
		</div>
		
       
 <div>
											  <table id="simple-table" class="table table-striped table-bordered table-hover sortable">
												
													<tr>
														
														<th style="text-align: center;" class="table-header">No.</th>
														<th style="text-align: center;" class="table-header">Roll</th>
														<th style="text-align: center;" class="table-header">Student</th>

												
														<th style="text-align: center;" class="table-header">Status</th>

														
													</tr>
											

                    <?php
					//// if no diary checkbox is unchekked and value 1
                    $count = 1;
					
                    $attendance_of_students = $this->db->get_where('attendance', array(
                                'branch_id' => $branch_id,
								'dept_id' => $dept_id,
								'class_id' => $class_id,
                                'section_id' => $section_id,
                                'year' => $running_year,
                                'timestamp' => $timestamp
                            ))->result_array();
							//print_r($attendance_of_students);die();
                    foreach ($attendance_of_students as $row){
                        ?>
                        
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td>
                                <?php echo $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->roll; ?>
                            </td>
                            <td>
                                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <td>
                            <div id="class1">
                                 <select class="form-control selectboxit" id="class" name="status_<?php echo $row['attendance_id']; ?>" onchange='Checklate(this.value,this.getAttribute("name"));'>
                                    
                                    <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>Present</option>
                                    <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>>Absent</option>
                                    <option value="3" <?php if ($row['status'] == 3) echo 'selected'; ?>>Late
                                   
                                     </option>
                                       
                                     <?php if($this->db->get_where('settings' , array('type' =>'diary'))->row()->description == '1')
                                     {
			                         ?>
                                    <option value="4" <?php if ($row['status'] == 4) echo 'selected'; ?>>No Diary</option>
                                    <?php } ?>
                                 </select>	
                                 </div>
                          
  <input type="text" name="late_<?php echo $row['attendance_id']; ?>" id="late_<?php echo $row['attendance_id']; ?>" style="display: none"/>
                                 
                            </td>
                           <?php /*?> <td>Diary <input type="checkbox" name="diary_<?php echo $row['attendance_id']; ?>" id="diary_<?php echo $row['attendance_id']; ?>" value="1" checked="checked"></td><?php */?> 
                        </tr>
                    <?php } ?>
                
            </table>
            
       
         <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Send-Additional Message</label>
		                    <div class="col-sm-5">
                             <label class="switch switch-success"><input type="checkbox"  name="additional_msg" id="additional_msg" value="1"><span></span></label> 
		                         <?php 
								 $this->db->select('content');
								 $this->db->from('sms_template');
								 $this->db->where('title','attendance');
								 $query=$this->db->get();
								 
								 if($query->num_rows() > 0)
								 {
								
								
								 //if($msg['title']=='admission'){
								?>
                                 <?php  
								 $this->db->select('content');
								 $this->db->from('sms_template');
								 $this->db->where('title','attendance');
								  $result=$this->db->get()->result_array();
								  foreach($result as $r){?>
								 
		                         <input type="text" id="message" name="message" value="<?php echo $r['content'];}?>" style="display: none">
                               
			                  
                              <?php }else
							  {?>
                            <input type="text" id="message" name="message" value="" style="display: none">
							 <?php } ?>
			                </div>
					</div>
        
</div>

        <center>
            <button type="submit" class="btn btn-info" id="submit_button" onclick="preloader()">
                <i class="entypo-check"></i> Update
            </button>
        </center>
        <?php echo form_close(); ?>
        
    </div>
</div>
</div></div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
<script>
 $(document).ready(function () {
$('#class1').change(function(){
        
          var thisvalue = $(this).find("option:selected").text();
			
            if(thisvalue=='Late' )            
			  {
             alert(thisvalue);
                $('#absent').show();
				}
			   				//$('#followup_date_container').hide();
				
				   
				
			   })
			     });

</script>



<script type="text/javascript">
    function select_section(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
	
	<?php /*?>$('#radiobutton1').click(function() {
   if($('#radio_button1').is(':checked')) { 
   
    }<?php */?>
});
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$("#timestamp").keyup(function () {
var a = $("#timestamp").val();
var c= a ;
$("#timestamp1").val(c);

});
});
</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#additional_msg").click(function () {
            if ($(this).is(":checked")) {
                $("#message").show();
            } else {
                $("#message").hide();
            }
        });
    });
</script>
<script type="text/javascript">
function Checklate(val,name){
//alert("hfghfthfdSS");
var res = name.substring(7);
 var element=document.getElementById("late_"+res);
 if(val=='3')
 {
   element.style.display='block';
   
   }
 else  
 {
   element.style.display='none';
   }
}

</script> 


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
    <script src="<?php echo base_url(). 'assets/js/sorttable.js'; ?>"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="success")
{
echo "<script>toastr.success('". "Updated Successfully...', 'Updated', {timeOut: 5000})</script>";
}

?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		setTimeout($.unblockUI, 3000); 
}
</script>