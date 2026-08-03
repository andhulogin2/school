<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-editable.css" />

        
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
							<li class="active">Download</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon"></span>
									
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Download
								
									
								
							</h1>
						</div>
                        
                        
                        
                        
<div class="row">
  
        <div class="col-md-4">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white"> <center>Download Files </center></font>
                    </div>
                </div>
                <div class="panel-body">
                <center>
                <?php 
				foreach ($apk as $row) { ?>  
       <a href="<?php echo base_url();?>uploads/apk/<?php echo $row['id'] ?>.apk"><?php echo $row['title']; ?></a> 
       &nbsp;&nbsp;&nbsp;
       <?php if($this->session->userdata('role')==1){ ?>
         <a href="<?php echo base_url();?>index.php/admin/delete_apk/<?php echo $row['id']?>" class="btn-sm btn-icon icon-left" onClick="return confirm('Are-you-sure');" title="delete"><i class="fa fa-close text-danger"></i></a> 
              <?php } ?>
              <br />
        <?php } ?>
        </center>
      
                  </div></div>
                  
                  
                  
  
     </div></div></div></div></div>
     
  
<?php include_once APPPATH . 'views/footer.php'; ?>
    