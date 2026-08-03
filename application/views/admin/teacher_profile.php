<?php include_once APPPATH . 'views/main_head.php';?>
 

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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Teacher
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Profile
								
							</h1>
						</div>


<div class="main_data">
    <?php
$profile_info = $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->result_array();
foreach($profile_info as $row):?>
          <div class="user-profile">
            <div class="row">
              <div class="col-md-5">
          <div class="white-box">
          <div class="user-bg"> <img src="style/images/large/img.jpg" alt="" style="100%">
              <div class="overlay-box">
                <div class="user-content"><a href="javascript:void(0)"><center><img alt="img" class="thumb-lg img-circle" src="<?php echo $this->crud_model->get_image_url('teacher', $row['teacher_id']);?>" style="width:100px; height:100"></center></a>
                  <center><h4 class="text-white"><?php echo $row['name']; ?></h4>
                  <h5 class="text-white"><?php echo $row['email'];?></h5></center>
                </div>
              </div>
            </div><br><hr>
            <center><h3 class="box-title">Personal Info</h3></center>
            <ul class="basic-list">
              <li>Name<span class="pull-right label-danger label"><?php echo $row['name'];?></span></li><br>
              <li>Username<span class="pull-right label-purple label"><?php echo $row['username'];?></span></li><br>
              <li>Phone<span class="pull-right label-red label"><?php echo $row['phone'];?></span></li><br>
              <li>Email<span class="pull-right label-success label"><?php echo $row['email'];?></span></li><br>
              <li>Birthday<span class="pull-right label-info label"><?php echo $row['birthday'];?></span></li><br>
              <li>Sex<span class="pull-right label-warning label"><?php if($row['sex'] == 'male') echo "Male"; if($row['sex'] == 'female') echo "Female" ?></span></li>
            </ul>
          </div>
        </div>
              <div class="col-md-7">
               <div class="widget-box">
                  <div class="panel" >
            <div class="panel-heading">
                <div class="panel-title">
                   UpdateProfile
                </div>
            </div>
            <div class="panel-body">
               <?php $edit_data = $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->result_array();
                      foreach ($edit_data as $row2):
                ?>
                    <?php echo form_open(base_url() . 'index.php/admin/teacher_edit/do_update/'.$row2['teacher_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row2['name'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="username" value="<?php echo $row2['username'];?>"/>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label">Birthday</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control mydatepicker" name="birthday" value="<?php echo $row2['birthday'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row2['email'];?>"/>
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row2['address'];?>" >
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">Phone</label>

                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row2['phone'];?>"  >
                            </div> 
                        </div>
                        <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sex: </label>

										<div class="col-sm-8">
											<select class="form-control" id="sex" name="sex" data-placeholder="Select one" >
                                               <option value="<?php echo $row2['sex'];?>"><?php echo $row2['sex'];?></option>
                                               <option value="male">Male</option>
                                               <option value="female">Female</option>
                                             </select>
											
										</div>
									</div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label">Salary</label>

                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="salary" value="<?php echo $row2['salary'];?>"  >
                            </div> 
                        </div>

                        <div class="form-group">
<label for="field-1" class="col-sm-3 control-label">Photo</label>
                        
						<div class="col-sm-5">
											
				
			<!-- our form -->
				<input  type="file" name="userfile"  />
				 <div><font color="#FF0000">Note: Photo Must Be In 150x150 Size</font></div>
			<br>
             
				
				
				<button type="reset" class="btn btn-sm">Reset</button>
	

                                                   
                        </div>                           
                        </div>    
                
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-5">
                              <button type="submit" class="btn btn-info">Update</button>
                          </div>
                        </div>
                    </form>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
              </div>
            </div>
          </div></div>
<?php endforeach;?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading table-header">
                <div class="panel-title">
                    Update-Password
                </div>
            </div>
            <div class="panel-body">
                    <?php 
                   $edit_datas = $this->db->get_where('teacher' , array('teacher_id' => $teacher_id))->result_array();
                    foreach($edit_datas as $row3):
                        ?>
                         <?php echo form_open(base_url() . 'index.php/admin/teacher_edit/change_password/'.$row3['teacher_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">New-Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Confirm-Password</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info">Update</button>
                              </div>
                                </div>
                        </form>
                        <?php
                    endforeach;
                    ?>
            </div>
        </div>
    </div>
</div>
</div></div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>
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