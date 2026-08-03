<?php include_once APPPATH . 'views/class_teacher_head.php';?>
<?php $running_year = get_running_year(); ?>


	
	<body class="no-skin">
		
		<?php //include_once APPPATH . 'views/top_bar.php';?>
        
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
								<a href="#">Teacher</a>
							</li>
							<li class="active">Subjects</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Teacher
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Subjects
								
							</h1>
						</div>

<div class="row">
    <div class="col-sm-12">
<div class="tab-content">
		<div class="tab-pane box active" id="list">
          <div class="white-box">
            <div class="table-responsive">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                    <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Class');?></div></th>
                    <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Subject');?></div></th>
                    <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Teacher');?></div></th>
                    <th style="text-align: center;" class="table-header"><div><?php echo get_phrase('Edit');?></div></th>
                </tr>
              </thead>
              <tbody>
             <?php $count = 1;foreach($subjects as $row):?>
          
                <tr>
                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
              <td style="text-align: center;"><?php echo $row['name'];?></td>
              <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>

			    <td style="text-align: center;" class="text-nowrap">
          <a href="#" onClick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/courses_edit/<?php echo $row['subject_id'];?>');" data-toggle="tooltip" data-original-title="Subject Activity"> <i class="fa fa-edit text-info m-r-10"></i> </a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>       
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