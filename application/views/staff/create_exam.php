<?php include_once APPPATH . 'views/main_head.php';?>
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
												<h4 class="widget-title lighter">UNIT EXAMS</h4>

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="myTab2">
														<li class="active">
															<a data-toggle="tab" href="#home2">Unit tests</a>
														</li>

														<li>
															<a data-toggle="tab" href="#profile2">New</a>
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
													
														<th>Sl no</th>
														<th>Unit Test</th>
														<th class="hidden-480">Description</th>

														<th>
															
															Class 
														</th>
														<th class="hidden-480">Status</th>

														
													</tr>
												</thead>
              <?php $count =1;foreach($exams as $row):?>
                <tr>
                 <td style="text-align: center;"><?php echo $count++;?></td>
                <td style="text-align: center;"><?php echo $row['name'];?></td>
                <td style="text-align: center;"><?php echo $row['comment'];?></td>
               
               <td style="text-align: center;"><?php 
               $ses = $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
               echo $ses;?></td>
			   
               
               
               
               <td>
															<div class="hidden-sm hidden-xs action-buttons">
                                                            <?php echo anchor('Admin/edit_unit_exam/'.$row['exam_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');?>
                                                             
																
															</div>

															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		

																		<li>
																			  <?php echo anchor('Admin/edit_unit_exam/'.$row['exam_id'], '<i class="ace-icon fa fa-pencil bigger-130"></i>');?>
																		</li>

																		<li>
																			 <?php echo anchor('Admin/create_exam/delete/'.$row['exam_id'],'<i class="ace-icon fa fa-trash-o bigger-130"></i>');?>
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
																<?php echo form_open(base_url() . 'index.php/admin/create_exam/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

       
          <div class="white-box">
            <h3 class="box-title m-b-0">New</h3>
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