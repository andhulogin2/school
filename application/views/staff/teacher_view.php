<?php include_once APPPATH . 'views/staff_head.php';?>
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
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								STUDENT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Attendance
								</small>
							</h1>
						</div>  
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														
														<th>Name</th>
														<th>User Name</th>
														<th class="hidden-480">salary</th>

												
														<th class="hidden-480">phone</th>
                                                        <th class="hidden-480">email</th>
                                                        <th class="hidden-480">options</th>

														
													</tr>
												</thead>
              <?php 
		              $teachers	=	$this->db->get('teacher' )->result_array();
		              foreach($teachers as $row):
		          ?>
              <tbody>
													<tr>
                <td style="text-align: center;"><?php echo $row['name'];?></td>
            	  <td style="text-align: center;"><?php echo $row['username'];?></td>
                <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['salary'];?></td>
            	  <td style="text-align: center;"><?php echo $row['phone'];?></td>
				        <td style="text-align: center;"><?php echo $row['email'];?></td>
			         <td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url();?>index.php/staff/teacher_profile/<?php echo $row['teacher_id'];?>" data-toggle="tooltip" data-original-title="Profile"> <i class="fa fa-user text-inverse m-r-10"></i></a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            </div>
          </div>
          </div>
          <div align="right">     
                              <a href="<?php echo base_url();?>index.php/staff/teacher_add" class="btn btn-success fileinput-exists" data-dismiss="fileinput">Add Teacher</a>       
                                   </div>
          
          <?php include_once APPPATH . 'views/footer.php'; ?>
