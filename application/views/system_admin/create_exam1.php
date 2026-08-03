<?php include_once APPPATH . 'views/head.php';?>
 

<body>
        
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
							<li class="active">New Exam</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<?php /*?><?php echo form_open(base_url() . 'index.php/admin/search' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"  autocomplete="off" name="search_key" id="search_key"/>
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
				<?php form_close(); ?><?php */?>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Exam
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
                                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/Admin/view_exam/'; ?>"><b>View Exams</b></a></div> 

                                        
																<?php echo form_open(base_url() . 'index.php/admin/create_exam/create/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

       
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit Test Name <font color="#FF0000">* </font></label>

<div class="col-sm-9">
<input type="text" class="col-xs-10 col-sm-5"  required="" name="name" placeholder="Name">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description</label>

<div class="col-sm-9"> 
<input type="text" class="col-xs-10 col-sm-5"   name="comment" placeholder="Description">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Class <font color="#FF0000">* </font></label>

<div class="col-sm-9">
<select name="class" class="col-xs-10 col-sm-5"   required="">
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

</div></div></body>
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