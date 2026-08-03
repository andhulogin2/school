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
							<li class="active">Teacher</li>
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
								Teacher
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
								
							</h1>
						</div>  
                        
                        <div align="right" style="padding-right:10px">     
                              <a href="<?php echo base_url();?>index.php/admin/teacher_add">Add Teacher</a>       
                                   </div>
                                   <br />
          
            <div class="table-responsive">
           <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
												<thead>
													<tr>
														<th class="table-header" style="text-align: center;">Sl No</th>
														<th class="table-header" style="text-align: center;">Name</th>
														<th class="table-header" style="text-align: center;">User Id</th>
														<th class="table-header" style="text-align: center;">Salary</th>

												
														<th class="table-header" style="text-align: center;">Phone</th>
                                                        <th class="table-header" style="text-align: center;">Email</th>
                                                        <th class="table-header" style="text-align: center;" colspan="2">Action</th>

														
													</tr>
												</thead>
              <?php 
			  $i=0;
		              $teachers	=	$this->db->get('teacher' )->result_array();
		              foreach($teachers as $row):
					  $i=$i+1;
		          ?>
              <tbody>
              <tr>
                <td style="text-align: center;"><?php echo $i;?></td>
												
                <td style="text-align: center;"><?php echo $row['name'];?></td>
            	  <td style="text-align: center;"><?php echo $row['username'];?></td>
                <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['salary'];?></td>
            	  <td style="text-align: center;"><?php echo $row['phone'];?></td>
				        <td style="text-align: center;"><?php echo $row['email'];?></td>
			         <td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url();?>index.php/admin/teacher_profile/<?php echo $row['teacher_id'];?>" data-toggle="tooltip" title="View Profile"> <i class="fa fa-user text-inverse m-r-10"></i></a></td><td style="text-align: center;"><a href="<?php echo base_url();?>index.php/admin/teacher_edit/delete/<?php echo $row['teacher_id'];?>" data-toggle="tooltip" title="Delete"> <i class="fa fa-close text-danger"></i> </a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            </div>
          </div>
          </div>
          
          <?php include_once APPPATH . 'views/footer.php'; ?>
