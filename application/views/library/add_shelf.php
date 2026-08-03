		<?php include_once APPPATH . 'views/library_head.php';?>
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
		<li class="active">Books</li>
		<li class="active">Shelf</li>
		</ul>
        <form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						<!-- /.breadcrumb -->
					</div>
		
		</div>
		
		<div class="page-content">
		<div class="page-header">
		<h1>Add<small>
		<i class="ace-icon fa fa-angle-double-right"></i>
		Shelf
		</small>
		</h1>
        
        <br/>
		
		<div align="right" style="padding-right:100px"> 
		<a href="<?php echo base_url();?>index.php/library/view_shelf/"  data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> 
		</div> 
		</div>		
		
		<?php echo form_open('Library/add_new_shelf', array('class' => 'form-horizontal'));?>
		<br/>
        
        
        <?php  $role=$this->session->userdata('role');
if($role==1 || $role==2)
{?>
                                    <div class="form-group" id="branch_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch :</label>

										<div class="col-sm-9">
											<select name="branch" class="col-xs-10 col-sm-5" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    
                                    
                                   
                                    
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
											<select name="department" class="col-xs-10 col-sm-5" id="department">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
									</div>
                                    <?php } ?>
                                    
                                    
                                   <?php  if($role==3){?>
                                    <div class="form-group" id="dept_role">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Department :</label>

										<div class="col-sm-9">
											<select name="department" class="col-xs-10 col-sm-5" id="department">
                              <option value="">Select</option>
                              <?php 
							  $this->db->where('branch_id',$this->session->userdata('branch_id'));
							  $dept=$this->db->get('tbl_department')->result_array();
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
									</div>
                                    <?php } 
                                    else
                                    {
                                        ?>
                                        <input type="hidden" name="branch_id" value="<?php echo $this->session->userdata('branch_id')?>" />
                                        <input type="hidden" name="dept_id" value="<?php echo $this->session->userdata('dept_id')?>" />
                                        <?php
                                    }
                                    ?>

		<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Shelf Number :<font color="#FF0000">* </font></label>
		<div class="col-sm-9">
		<input type="text"  name="shelf_name" id="shelf_name"  placeholder="Shelf Name" class="col-xs-10 col-sm-5" required=""  onchange="return get_data(this.value)"/>
		<div class="form-group" id="absent1"></div>
		</div>
		</div>
		
		
		<?php echo form_close(); ?>
		</div>
		</div>
        </div>
		<?php include_once APPPATH . 'views/footer.php'; ?>
		
		
		<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
		
		<script type="text/javascript">	
		function get_data(){
		jQuery('#absent1').html("");
		var shelf = $('#shelf_name').val();
		if(shelf!='')
		{
		$.ajax({
		url: '<?php echo base_url();?>index.php/Library/get_data3/' +shelf,
		success: function(response)
		{
		console.log(response);
		jQuery('#absent1').html(response);
		}
		});
		}
		}
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