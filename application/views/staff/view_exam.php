<?php include_once APPPATH . 'views/staff_head.php';?>
 

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
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
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
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
								</small>
							</h1>
						</div><!-- /.page-header -->
                        
				 
                     
                                        <div></div>
                                        
                                        <div align="right" style="padding-right:10px"><a href="<?php echo base_url() . 'index.php/staff/create_exam/new'; ?>"><b>New Exams</b></a></div> 
<br>


																<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
													
														<th class="table-header"><center> Sl no</center></th>
														<th class="table-header"><center>Unit Test</center></th>
														<th class="table-header"><center>Description</center></th>
														<th class="table-header"><center>Class </center></th>
														<th class="table-header" colspan="1"><center>Action</center></th>
													</tr>
												</thead>
              <?php $count =1;foreach($exams as $row1):?>
                <tr>
                 <td style="text-align: center;"><?php echo $count++;?></td>
                <td style="text-align: center;"><?php echo $row1['name'];?></td>
                <td style="text-align: center;"><?php echo $row1['comment'];?></td>
               
               <td style="text-align: center;"><?php 
			   
               $ses = $this->db->get_where('class', array('class_id' => $row1['class_id']))->row()->name;
               echo $ses;
			   ?></td>
             


<!-- /.modal-content -->
<td>
<?php echo anchor('staff/edit_unit_exam/'.$row1['exam_id'], '<i class="ace-icon fa fa-pencil bigger-130" title="Edit"></i>');?>
&nbsp;&nbsp;&nbsp;&nbsp;<?php 
$this->db->where('exam_id',$row1['exam_id']);
								$a=$this->db->get('mark');
							
								if($a->num_rows() >0)
								{
								echo "exist";
								}
								else{?>
                                <a href="<?php echo base_url();?>index.php/admin/create_exam/delete/<?php echo $row1['exam_id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');">
                            <i class="fa fa-close text-danger"></i>
                    </a>	
		<?php	}			
//echo anchor('staff/create_exam/delete/'.$row1['exam_id'],'<i class="ace-icon fa fa-trash-o bigger-130"  title="Delete"></i>');}?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('staff/tab_sheet/','<i class="fa fa-bars" aria-hidden="true"  title="Report">&nbsp;&nbsp;Report</i>');?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('staff/rank/','<i class="fa fa-arrow-right bigger-130" title="Rank">&nbsp;&nbsp;Rank</i>');?>
&nbsp;&nbsp;&nbsp;<?php echo anchor('staff/progress_report/','<i class="fa fa-download bigger-130" title="Download"></i>');?>
</td>

<div class="hidden-md hidden-lg">
<div class="inline pos-rel">
<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
</button>

<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">


<li>
<?php echo anchor('staff/edit_unit_exam/'.$row['exam_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');?>
</li>

<li>
<?php echo anchor('staff/create_exam/delete/'.$row['exam_id'],'<i class="ace-icon fa fa-trash-o bigger-130"></i>');?>
</li>
</ul>
</div>
</div>
</td>







</tr>
                <?php endforeach;?>
              
            </table>


												
											</div>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			<!-- /.main-content -->
        		
	 

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