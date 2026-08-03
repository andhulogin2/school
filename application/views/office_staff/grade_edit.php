<?php include_once APPPATH . 'views/main_head.php';?>
<?php 
$edit_data		=	$this->db->get_where('grade' , array('grade_id' => $grade_id) )->result_array();
foreach ( $edit_data as $row):
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
                    <div class="page-content">
						
                        <div class="page-header">
							<h1>
								EDIT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Grade
								</small>
							</h1>
						</div>
<br>
			<div class="panel-body">	
                <?php echo form_open(base_url() . 'index.php/admin/grade/edit/'.$row['grade_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Grade</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="grade" value="<?php echo $row['grade'];?>" data-validate="required" data-message-required="Required"/>
                    </div>
                </div>
      
                <div class="form-group">
                    <label class="col-sm-4 control-label">Minimum Range</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="rangemin" value="<?php echo $row['minimum_range'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Maximum Range</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="rangemax" value="<?php echo $row['maximum_range'];?>"/>
                    </div>
                </div>
                
                                <div class="form-group">
                    <label class="col-sm-4 control-label">Grade Value</label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" name="value" value="<?php echo $row['value'];?>"/>
                    </div>
                </div>
     <div class="form-group">
                    <label class="col-sm-4 control-label">Grade Position</label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" name="position" value="<?php echo $row['position'];?>"/>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
<?php include_once APPPATH . 'views/footer.php'; ?>





