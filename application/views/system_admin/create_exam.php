<?php include_once APPPATH . 'views/head.php';?>
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
							<li class="active">Admission</li>
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
								Add
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 New Exam
								
							</h1>
						</div>
<div class="col-sm-10 widget-container-col">
										
						<?php echo form_open(base_url() . 'index.php/admin/create_exam/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

       
          <div class="white-box">
            <br><br>
				<div class="padded">
		     
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label">Unit_test</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="name" placeholder="Name">
                    </div>
                  </div>
                            </div>

					<div class="form-group">
                    <label class="col-sm-4 control-label">Description</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="comment" placeholder="Description">
                  </div>
                            </div>
                            
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Class</label>
                    <div class="col-sm-5">
					<select name="class" class="form-control selectboxit" >
					<option value="">Select</option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row1):
				?>
				<option value="<?php echo $row1['class_id'];?>"><?php echo $row1['name'];?></option>
				<?php endforeach;?>
			</select>                  </div>
                            </div>        
                            
                            
				

        <div class="form-group">
            <div class="col-sm-offset-6 col-sm-5">
              <button type="submit" class="btn btn-info">Add</button>
              <span id="preloader-form"></span>
            </div>
            </div>
        </div>
       
						 <?php echo form_close();?>
															</div>
														</div>
                                                      
                </div>                              

			</div>											

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
