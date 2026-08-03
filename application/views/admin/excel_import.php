<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

<body>
        
        	<div class="main-content col-md-10"> 
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
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>
                    <div class="page-content">
						 <div class="row pull-right">
                            <a href="<?php echo base_url(); ?>sample.csv"><h5> Sample csv file </h5></a>
							</div>
                            
                        <div class="page-header">
							<h1>
								Admin
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Import From Excel
								</small>
							</h1>
                           
                            
						</div>     
                        
                        <form action="<?php echo base_url(); ?>index.php/Uploadcsv/import" method="post" name="upload_excel" enctype="multipart/form-data">

                        <div class="row">


	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Class:<font color="#CC0000">*</font></label>
			<select name="class_id" class="form-control selectboxit" onChange="select_section(this.value)" required="required">
				<option value="">Select</option>
				<?php
                                        $yr=get_running_year();
                                        $role	=$this->session->userdata('role');
					if($role==3)
					{
					$this->db->where('branch_id',$this->session->userdata('branch_id'));
					}
					if($role==4 || $role==12)
					{
					$this->db->where('branch_id',$this->session->userdata('branch_id'));
					$this->db->where('dept_id',$this->session->userdata('dept_id'));
					}
                                        $this->db->where('academic_year',$yr);
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):                        
				?>                
				<option value="<?php echo $row['class_id'];?>"
					><?php echo $row['name'];?></option>            
				<?php endforeach;?>
			</select>
		</div>
	</div>

    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;">Section:<font color="#CC0000">*</font></label>
			<select class="form-control selectboxit" name="section_id" required="required">
            <option value="">Select</option>
			</select>
		</div>
	</div>
    </div>
	
    <div class="form-group">
                        
						<div class="col-sm-5">
											
				
			<!-- our form -->
        <input type="file" name="file" id="file">
				
             
				
				
	

                                                   
                        </div>                           
                            
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" name="import" class="btn btn-info">Go</button>
	</div>
</div>
</div>
</div></div> </div>    
<?php echo form_close();?>






<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/Admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd/mm/yy'
        })
		
	
    });
	</script>