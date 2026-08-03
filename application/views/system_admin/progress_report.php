<?php include_once APPPATH . 'views/head.php';?>
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
							<li class="active">Report</li>
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

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Progress 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Report
								
							</h1>
						</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php 
		
		echo form_open(base_url() . 'index.php/report/student_print_bulk_section1/'.$class_id);?>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Class</label>
					<select name="class_id" class="form-control selectboxit" onchange="return get_class_subject(this.value)">
                        <option value="">Select</option>
                        <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"
                            	<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
         
             <div id="subject_holder">
        <div class="form-group">
		<div class="col-md-9">
				<label class="control-label" style="margin-bottom:5px;">Section</label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled" style="width:200px;">
					<option value="0">Select</option>		
				</select>
			</div>
		</div>
    <div class="col-md-12">
			<div class="form-group">
			
				
			</div>
    </div>
    </div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-3 col-md-offset-2" style="margin-top: 28px;">
				<button type="submit" class="btn btn-info">Download</button>
			</div>
		<?php echo form_close();?>
	</div></div></div></div></div>
    <?php include_once APPPATH . 'views/footer.php'; ?>
    <script type="text/javascript">
	function get_class_subject(class_id) {	
            $(".preloader").show();
		$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_prog_report/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
			}).complete(function () {
                $(".preloader").hide();
            });
	}
</script>
