<?php include_once APPPATH . 'views/student_head.php';?>

	
	<body class="no-skin">
		
		<?php //include_once APPPATH . 'views/top_bar.php';?>
        
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
								<a href="#">Student</a>
							</li>
							<li class="active">Subjects</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					
						<div class="page-header">
							<h1>
								Student
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Subjects
								
							</h1>
						</div>

<div class="row" style="padding-left:20px; padding-right:20px">
	<div class="col-md-12">
	<div class="white-box">
		         
           
                <table class="table table-bordered" id="table_export">
                	<thead>
                		<tr>
                    	<!--	<th style="text-align: center;" class="table-header"><div><h4><b><?php echo get_phrase('Class'); ?></b></h4></div></th> -->
                    		<th style="text-align: center;" class="table-header"><div><h4><b><?php echo get_phrase('Subject'); ?></b></h4></div></th>
<?php /*?>                    		<th style="text-align: center;"><div><?php echo get_phrase('Teacher'); ?></div></th>
<?php */?>						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1; foreach($subjects as $row):?>
                        <tr>
				<!--	<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td> -->
							<td style="text-align: center;"><?php echo $row['name'];
							
							?></td>
<?php /*?>							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
<?php */?>                        </tr>
<?php 
                        endforeach;?>
                    </tbody>
                </table>
			        
		
        
	</div>
</div>
</div>
</div></div>

<?php include_once APPPATH . 'views/footer.php'; ?>