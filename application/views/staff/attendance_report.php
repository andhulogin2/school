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
							<li class="active">Attendance Report</li>
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
								STUDENT
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Attendance Report
								</small>
							</h1>
						</div>


<?php echo form_open(base_url() . 'index.php/staff/attendance_report_selector'); ?>
<div class="row">
    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();
        
        ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Class</label>
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                    <option value="">Select</option>
                    <?php foreach ($class as $row): ?>
                    <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <div id="section_holder">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Section</label>
                <select class="form-control selectboxit" name="section_id">
                    <option value="">Select</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-3">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;">Month</label>
        <select name="month" class="form-control selectboxit" id="month" onchange="show_year()">
            <?php
            for ($i = 1; $i <= 12; $i++):
                if ($i == 1)
                    $m ='January';
                else if ($i == 2)
                    $m = 'February';
                else if ($i == 3)
                    $m = 'March';
                else if ($i == 4)
                    $m = 'April';
                else if ($i == 5)
                    $m = 'May';
                else if ($i == 6)
                    $m = 'June';
                else if ($i == 7)
                    $m = 'July';
                else if ($i == 8)
                    $m = 'August';
                else if ($i == 9)
                    $m = 'September';
                else if ($i == 10)
                    $m = 'October';
                else if ($i == 11)
                    $m = 'November';
                else if ($i == 12)
                    $m = 'December';
                ?>
                <option value="<?php echo $i; ?>"
                      <?php if($month == $i) echo 'selected'; ?>  >
                            <?php echo $m; ?>
                </option>
                <?php
            endfor;
            ?>
        </select>
         </div>
    </div>
    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info">View</button>
	</div>
</div>
<?php echo form_close(); ?>
</div></div></div>

<?php include_once APPPATH . 'views/footer.php'; ?>
<script type="text/javascript">
    function select_section(class_id) 
    {
	//alert(class_id);
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/staff/get_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>