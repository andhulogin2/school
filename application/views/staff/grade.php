<?php include_once APPPATH . 'views/staff_head.php';?>
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
							<li class="active">Grade</li>
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
<div class="col-sm-12 widget-container-col">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4 class="widget-title lighter"><font color="#FFFFFF"><b>GRADE</b></font></h4>

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="myTab2">
														<li class="active">
															<a data-toggle="tab" href="#home2"><font color="#FFFFFF"><b>Grade</b></font></a>
														</li>

														<li>
															<a data-toggle="tab" href="#profile2"><font color="#FFFFFF"><b>New</b></font></a>
														</li>

													</ul>
												</div>
											</div>
                                            <div class="widget-body">
												<div class="widget-main padding-12 no-padding-left no-padding-right">
													<div class="tab-content padding-4">
														<div id="home2" class="tab-pane in active">
															<!-- #section:custom/scrollbar.horizontal -->
															<div class="scrollable-horizontal" data-size="800">
																<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
													
														<th class="table-header"><center>Sl no</center></th>
														<th class="table-header"><center>Grade</center></th>
														<th class="table-header"><center>Minimum Range</center></th>

														<th class="table-header"><center>
															
															Maximum Range</center> 
														</th>
														<th class="table-header"><center>Grade value</center></th>
                                                       <th class="table-header"><center>
															
															Grade Position </center>
														</th>
                                                        <th class="table-header"><center>
															
															Edit </center>
														</th>

														
													</tr>
												</thead>
             <?php  
			  
			  $count =1;
			                  $info = $this->db->get('grade')->result_array();

			  
			  
			  
			  
			  
			  foreach($info as $row):?>
                <tr>
                 <td style="text-align: center;"><?php echo $count++;?></td>
                <td style="text-align: center;"><?php echo $row['grade'];?></td>
                <td style="text-align: center;"><?php echo $row['minimum_range'];?></td>
               <td style="text-align: center;"><?php echo $row['maximum_range'];?></td>

              <td style="text-align: center;"><?php echo $row['value'];?></td>
              <td style="text-align: center;"><?php echo $row['position'];?></td>
															<td><div class="hidden-sm hidden-xs action-buttons">
                                                            <?php echo anchor('staff/edit_grade/'.$row['grade_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');?>
                                                            
																
															</div>
                                                            </td>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		

																		<li>
																			  <?php echo anchor('staff/edit_grade/'.$row['grade_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');?>
																		</li>

																		
																	</ul>
																</div>
															</div>
														</td>
               
               
               
			   
			  

			        
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
															</div>

															<!-- /section:custom/scrollbar.horizontal -->
														</div>
                                                        

														<div id="profile2" class="tab-pane">
															<div class="scrollable" data-size="100" data-position="left">
																<?php echo form_open(base_url() . 'index.php/staff/grade/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

       
          <div class="white-box">
            <h3 class="box-title m-b-0">New</h3>
            <br><br>
				<div class="padded">
		     
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label">Grade</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="grade" placeholder="Grade">
                    </div>
                  </div>
                            </div>

					<div class="form-group">
                    <label class="col-sm-4 control-label">Minimum Range</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="rangemin" placeholder="Minimum Range">
                  </div>
                            </div>
                            
                            <div class="form-group">
                    <label class="col-sm-4 control-label">Maximum Range</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="rangemax" placeholder="Maximum Range">
                  </div>
                            </div>
                            <div class="form-group">
                    <label class="col-sm-4 control-label">Grade Value</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="value" placeholder="Grade Value">
                  </div>
                            </div>
                             <div class="form-group">
                    <label class="col-sm-4 control-label">Grade Position</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="position" placeholder="Grade Position">
                  </div>
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