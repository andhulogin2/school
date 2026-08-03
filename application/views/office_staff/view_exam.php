<?php include_once APPPATH . 'views/office_staff_head.php';?>
 

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
							<li class="active">Exam</li>
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
								Exam 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
								
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
                                        
                                        
                                         
                                        
                                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/Admin/create_exam/new/'; ?>"><b>New Exams</b></a></div> 
<br>


																<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
													
														<th class="table-header"><center> Sl no</center></th>
														<th class="table-header"><center>Unit Test</center></th>
														<th class="table-header"><center>Description</center></th>
														<th class="table-header"><center>Class </center></th>
													
													</tr>
												</thead>
              <?php $count =1;foreach($exams as $row1):?>
                <tr>
                 <td style="text-align: center;"><?php echo $count++;?></td>
                <td style="text-align: center;"><?php echo $row1['name'];?></td>
                <td style="text-align: center;"><?php echo $row1['comment'];?></td>
               
               <td style="text-align: center;"><?php 
               $ses = $this->db->get_where('class', array('class_id' => $row1['class_id']))->row()->name;
               echo $ses;?></td>
             


<!-- /.modal-content -->




</td>

</tr>
                <?php endforeach;?>
              
            </table>

			<?php include_once APPPATH . 'views/footer.php'; ?>


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
  <script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>