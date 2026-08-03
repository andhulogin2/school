<?php include_once APPPATH . 'views/main_head.php';
$running_year = get_running_year();?>

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
                        <div class="table-header">
                            Target Report
          
                           							</div>

                        <!-- div.table-responsive -->

                        <!-- div.dataTables_borderWrap -->
                        <div>
                        <div class="table-responsive">
                         <?php echo form_open('Admin/change_password_bulk', array('class' => 'form-horizontal')); ?>
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="center">Slno</th>
                                        <th>Student Name</th>

                                        <th>Class</th>
                                        <th> Username</th>
                                        <th>Password</th>
                                        
										
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
									$no=1;
									$slno = 1;$amt=0;
									$tot_acheive=0;
									$tot_balance=0;
									
									$this->db->join('tbl_users u','s.user_id=u.user_id','LEFT');
									$st=$this->db->get('student s')->result_array();
                                    foreach ($st as $st1) { ?>
                                        <tr>
                                            <td class="center"> <?php echo $slno; ?></td>

                                          
                                            <td><?php echo $st1['name'];
 ?></td>
 
                                              <td></td>
                                            
                                            <td><input type="text" name="username[]" id="username[]" value="<?php echo $st1['username']?>"></td>
                                            <td><input type="password" name="pass[]" id="pass[]" value="<?php echo $st1['password']?>">
                                            <input type="hidden" name="user_id[]" id="user_id[]" value="<?php echo $st1['user_id']?>"></td>
</tr>
<?php }?>
                                </tbody>
                            </table>
                             <div class="row">
                 <div class="col-xs-12">
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <input type="submit" class="btn btn-info" type="button" value='submit' name="view">          
                        &nbsp; &nbsp; &nbsp; 
                       
                    </div>
                </div>
                </div>
                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page-content -->
<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        })
    });
</script>

<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">
$('.select2').css('width','300px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                    
 </script>   
 
 
 <script>

function ShowHide(body_id)
{
	var TBody
	TBody = document.getElementById(body_id);
	if(!TBody) return true;
	
	if (TBody.style.display=="none")
	  TBody.style.display=""
	else
	  TBody.style.display="none"
	return true;
}
</script>

