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
								Teacher
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Attendance
								
							</h1>
						</div>             
                 
   


<?php echo form_open(base_url() . 'index.php/admin/teacher_attendance_selector/');?>

<div class="widget-body">
													<div class="widget-main">
														<div>
															<label for="form-field-mask-1" style="padding-left:30px;">
																<b>Date</b>
																
															</label>

															<!-- #section:plugins/input.masked-input -->
															<div class="input-group col-md-3" style="padding-left:30px;">
																<input class="form-control  mydatepicker" style="width:300px; height:40px;" type="text" id="form-field-mask-1" name="timestamp" value="<?php echo date('d/m/Y'); ?>"/>
                                                                <input type="hidden" name="year" value="<?php echo $running_year;?>">
																<span class="input-group-btn">
																	<button type="submit" class="btn">
																		<i class="ace-icon fa fa-calendar bigger-110"></i>
																		View
																	</button>
																</span>
															</div>
                                                            <?php echo form_close();?>
                                                            <hr />
                              

<div class="row">
   
    <div class="col-md-12">
    <div class="white-box">
        <?php echo form_open(base_url() . 'index.php/admin/teacher_attendance_update/'  . $timestamp); ?>
         <input type="hidden" name="timestamp1" value="<?php echo date("d-m-Y", $timestamp); ?>">
		
        
		<div class="row" style="padding-left:100px;">
		
		</div>
        
 <div>
											 <table id="simple-table" class="table table-striped table-bordered table-hover sortable">
												
													<tr>
														
														<th style="text-align: center;" class="table-header">No.</th>
														
														<th style="text-align: center;" class="table-header">Teacher</th>

												
														<th style="text-align: center;" class="table-header">Status</th>

														
													</tr>
                    <?php
					//// if no diary checkbox is unchekked and value 1
                    $count = 1;
					
                    $attendance_of_teacher = $this->db->get_where('teacher_attendance', array(
                               // 'class_id' => $class_id,
                                //'section_id' => $section_id,
                                'year' => $running_year,
                                'timestamp' => $timestamp
                            ))->result_array();
                    foreach ($attendance_of_teacher as $row):
                        ?>
                        
                    
													<tr>
														
                            <td><?php echo $count++; ?></td>
                         
                            <td>
                                <?php echo $this->db->get_where('staff', array('staff_id' => $row['staff_id']))->row()->name; ?>
                            </td>
                            <td>
                            <div id="class1">
                                 <select class="form-control selectboxit" id="class" name="status_<?php echo $row['attendance_id']; ?>">
                                    
                                    <option value="1" <?php if ($row['status'] == 1) echo 'selected'; ?>>Present</option>
                                    <option value="2" <?php if ($row['status'] == 2) echo 'selected'; ?>>Absent</option>
                                    <option value="3" <?php if ($row['status'] == 3) echo 'selected'; ?>>Late
                                   
                                     </option>
                                       
                                    
                                 </select>	
                                 </div>
                                <div class="row" id="absent" style="display:none;"> 
        <input type="text" name="late" id="late" />
        
</div>
                                 
                            </td>
                           <?php /*?> <td>Diary <input type="checkbox" name="diary_<?php echo $row['attendance_id']; ?>" id="diary_<?php echo $row['attendance_id']; ?>" value="1" checked="checked"></td><?php */?> 
                        </tr>
                    <?php endforeach; ?>
               
            </table>
        </div>
        
        <center>
            <button type="submit" class="btn btn-info" id="submit_button" onclick="preloader()">
                <i class="entypo-check"></i> Update
            </button>
        </center>
        <?php echo form_close(); ?>
        
    </div>
</div>
</div></div></div></div></div></div></div>
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
            url: '<?php echo base_url(); ?>index.php/admin/get_section/' + class_id,
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
			dateFormat: 'dd/mm/yy'
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
