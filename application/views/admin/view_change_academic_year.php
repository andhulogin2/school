<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
         
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
							<li class="active">Academic Year</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<?php /*?><?php echo form_open(base_url() . 'index.php/admin/search' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"  autocomplete="off" name="search_key" id="search_key"/>
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
				<?php form_close(); ?><?php */?>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Change 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Academic Year
								
							</h1>
						</div><!-- /.page-header -->
                       
                    
                    
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
                                   
            
					<?php
					echo form_open('admin/change_academic_year');
					$this->db->select('acdemic_year_id,academic_year');
					$ac_year    =   $this->db->get_where('tbl_academic_year',array('is_deleted'=>'N'))->result_array();
					$cur_year   =   get_running_year();
					?>
            		<div class="row" style="text-align:center">
            			<div class="col-md-12" >
							<select name="acc_year" id="acc_year" style="border-radius:5px;" >
								<option value="">Select</option>
								<?php
								foreach($ac_year as $row):
								?>
								<option value="<?php echo $row['acdemic_year_id']; ?>"<?php if($cur_year==$row['acdemic_year_id']){ echo "selected"; } ?>><?php echo $row['academic_year']; ?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
            			<div class="col-md-12" style="text-align:center;padding-top:10px;">
							<input type="submit" class="btn btn-info btn-sm" onClick="return check()" value="Reset Ac.Year" style="border-radius:5px;">
						</div>
            		</div>
					<?php
						echo form_close();
					?>	

		
            	
			</div>
	</div>
</div>		
												
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function check()
	{
		if(confirm('Do you want to change academic year?'))
		{
			return true; 
		}
		else
		{
			return false;
		}
	}
</script>
