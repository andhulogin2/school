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
							<li class="active">New Message</li>
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
								Message
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 New Message
								
							</h1>
						</div>             
                 
   



                              

<div class="row">
   
    <div class="col-md-12">
    <div class="white-box">
   
        <?php echo form_open(base_url() . 'index.php/admin/sms_send_popup/'.$master_id); ?>
        <?php $this->db->select('count(student_id) as student_count');
		$this->db->from('tbl_sms_delivery_details');
		if($class_id)
		{
		$this->db->where_in('class_id',$class_id);
		}
		if($section_id)
		{
		$this->db->where('section_id',$section_id);
		}
		$this->db->where('sms_master_id',$master_id);
		$query=$this->db->get()->row()->student_count;
		
		?>
        <label class="col-md-offset-5" style="padding-left:40px;"><b>Total Students</b></label>  :<b><?php echo $query; ?></b>
        
          <div class="col-md-offset-5">
         
        <?php $this->db->select('count(phone) as student_count');
		$this->db->from('tbl_sms_delivery_details');
		if($class_id)
		{
		$this->db->where_in('class_id',$class_id);
		}
		if($section_id)
		{
		$this->db->where('section_id',$section_id);
		}
		$this->db->where('sms_master_id',$master_id);
		$query1=$this->db->get()->row()->student_count;
		
		?>
        <label style="padding-left:40px;"><b>Total Sms Count</b></label>  :  <label><b><?php echo $query1; ?></b></label>
        </div>
        <div style="padding:20px;">
        <center>
            <button type="submit" class="btn btn-info" id="submit_button" onclick="preloader()">
                <i class="entypo-check"></i> Send
            </button>
        </center>
        </div>
          <?php echo form_open(base_url() . 'index.php/admin/sms_send_popup/'.$master_id); ?>
<div class="table-responsive">
											 <table id="simple-table" class="table table-striped table-bordered table-hover sortable">
												
													<tr>
														
														<th style="text-align: center;" class="table-header">No.</th>
													
														<th style="text-align: center;" class="table-header">Student</th>
                                                        <th style="text-align: center;" class="table-header">Phone</th>

												
														<th style="text-align: center;" class="table-header">Message Content</th>

														
													</tr>
                    <?php
					//// if no diary checkbox is unchekked and value 1
                    $count = 1;
					
                    $sms_of_students = $this->db->get_where('tbl_sms_delivery_details', array(
                               // 'class_id' => $class_id,
                                //'section_id' => $section_id,
                                'sms_master_id' => $master_id,
                               
                            ))->result_array();
                    foreach ($sms_of_students as $row):
                        ?>
                        
                    
													<tr>
														
                            <td><?php echo $count++; ?></td>
                           
                            <td>
                                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <td>
                                <?php echo $row['phone']; ?>
                            </td>
                            <td>
                            <?php echo $row['msg_content']?>
                             
                                 
                            </td>
                           <?php /*?> <td>Diary <input type="checkbox" name="diary_<?php echo $row['attendance_id']; ?>" id="diary_<?php echo $row['attendance_id']; ?>" value="1" checked="checked"></td><?php */?> 
                        </tr>
                    <?php endforeach; ?>
               
            </table>
        </div>
</div>
        
       <div class="col-md-offset-4 col-md-3">
         <button type="submit" class="btn btn-info waves-effect waves-light m-r-10" id="submit_button" onclick="preloader()">Send</button> 
        <?php 
		
                 echo anchor(base_url() . 'index.php/admin/delete_sms_pop_up/' .$master_id , 'Delete', array('class' => 'btn btn-danger waves-effect waves-light m-r-10')); 
				 echo form_close(); ?>
        </div>
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
