<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>


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
							<li class="active">Subject View</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
							</form>
						</div><!-- /.nav-search -->

					</div>

					
						<div class="page-header">
							<h1>
								Subject
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									View
							</h1>
						</div>
                        <!-- /.page-header -->
                        
     <div align="right" style="padding-right:50px"><a href="<?php echo base_url() . 'index.php/Admin/subject_bulk/'; ?>" ><button class="btn-info">Subject Bulk</button></a></div> 

                          <?php echo form_open('Admin/subjects_view', array('class' => 'form-horizontal'));?>
 							 <?php 
							 $role=$this->session->userdata('role');
							 if($role ==1 || $role==2 )
							 {
							 
							 if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                                    <div class="col-md-12">
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Branch :</label>

										<div class="col-sm-3">
											<select name="branch" class="select2" id="branch" onChange="return get_dept(this.value)">
                              <option value="">Select</option>
                              <?php $branch=$this->db->get('tbl_branch')->result_array();
							  foreach ($branch as $branch1)
							  {
							  ?><option value="<?php echo $branch1['branch_id'];?>"><?php echo $branch1['branch_name'];?></option>
                              <?php }?>
                              
                          </select>
										</div>
								
                                    
                                   
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Department:</label>

										<div class="col-sm-3">
											<select name="department" class="select2" id="department" onChange="return get_class(this.value)">
                              <option value="">Select</option>
                             
                              
                          </select>
										</div>
                                        
                                        <div class="col-sm-3">
											<input type="submit" class="btn btn-info" type="button" value='view'>
										</div>
                                         <?php } }?>
                                         
									<?php 
							 $role=$this->session->userdata('role');
							 if($role ==3)
							 {
							 
							 if($this->db->get_where('settings' , array('type' =>'department'))->row()->description == 'yes')
					   {?>
                                    <div class="col-md-12">
										
                                    
                                   
										<label class="col-sm-1 control-label no-padding-right" for="form-field-1">Department:</label>

										<div class="col-sm-3">
											<select name="department" class="col-xs-12 col-sm-12" id="department" onChange="return get_class1(this.value)">
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
                                        
                                        <div class="col-sm-3">
											<input type="submit" class="btn btn-info" type="button" value='view'>
										</div>
                                         <?php } }?>
                                     <?php echo form_close(); ?>
                                    
								
    
    
                        
                                   
                                    <div id="hidden" style="padding-top:100px;"></div>
                                    
								<div class="row">
                                
                                
									

									<div class="col-sm-12 infobox-container" >
										<!-- #section:pages/dashboard.infobox -->
                                         <?php
										  foreach($class as $row){?>
										<div class="infobox infobox-red" >
											<div class="infobox-icon">
												<i class="ace-icon fa fa-graduation-cap"></i>
											</div>

											<div class="infobox-data" >
                                           
												<span class="infobox-data-number"></span>
												<div class="infobox-content">
												<b><a href="<?php echo base_url(); ?>index.php/admin/view_subject/<?php echo $row['class_id']; ?>/<?php echo $row['branch_id']; ?>/<?php echo $row['dept_id']; ?>"><?php echo $row['name'];?></a></b></div>
                                                
                                                 <div class="infobox-content">
												<b>
                                                <?php 
                                            $running_year = get_running_year();
										      $this->db->select('count(subject_id) as subject_count');
											  $this->db->where('class_id',$row['class_id']);
                                              $this->db->where('year',$running_year);
											  $count=$this->db->get('subject')->row();?>Total Subject:<?php echo $count->subject_count;?></b></div>
											</div>
                                            
                                            
                                          

											<!-- #section:pages/dashboard.infobox.stat 
											<div class="stat stat-success">8%</div>-->

											<!-- /section:pages/dashboard.infobox.stat -->
										</div>
  <?php }?>
										

</div></div></div></div>
											</body>
			<?php include_once APPPATH . 'views/footer.php'; ?>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script> 

<script type="text/javascript">  
   $(window).load(function() {  
      $("#loader").fadeOut(1000);  
   });
</script>  	

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">  </script> 
 <script type="text/javascript">

function preloader()
{

$.blockUI({ css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 
		//setTimeout($.unblockUI, 1000); 
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

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','260px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>  
