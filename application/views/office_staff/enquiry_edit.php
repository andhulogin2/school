<?php include_once APPPATH . 'views/main_head.php';?>
 

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
<li class="active">Edit Profile</li>
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
<h1> Edit <small>
<i class="ace-icon fa fa-angle-double-right"></i>
Profile</small> </h1>
</div><!-- /.page-header -->
                        
<?php 
//error_reporting(0);   
echo form_open('enquiry_controller/update_profile/', array('class' => 'form-horizontal'));
?>
                     
								<!-- PAGE CONTENT BEGINS -->
								
									<!-- #section:elements.form -->
<?php
//$detail	=$this->db->get_where('enquiry_master_details',array('enquiry_id'=>$enquiry_id))->result_array();
foreach($a as $row):
{
?>

<div class="form-group">
<div class="col-sm-9">
<input type="hidden" id="id" value="<?php echo $row->enquiry_id;?>"  class="col-xs-10 col-sm-5" name="id" />
</div>
</div>
                          											   

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name:<font color="#FF0000">*</font></label>
<div class="col-sm-9">
<input type="text" id="fname" value="<?php echo $row->first_name;?> " class="col-xs-10 col-sm-5" name="fname" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Name:<font color="#FF0000">*</font></label>
<div class="col-sm-9">
<input type="text" id="lname" value="<?php echo $row->last_name;?>" class="col-xs-10 col-sm-5" name="lname" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone Number 1 :<font color="#FF0000">*</font></label>
<div class="col-sm-9">
<input type="text" id="phone1" value="<?php echo $row->phone1;?>" class="col-xs-10 col-sm-5" name="phone1" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Phone Number 2:</label>
<div class="col-sm-9">
<input type="text" id="phone2" value="<?php echo $row->phone2;?>" class="col-xs-10 col-sm-5" name="phone2" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Whatsapp Number(If have any) :</label>
<div class="col-sm-9">
<input type="text" id="whatsapp" value="<?php echo $row->whatsapp;?>" class="col-xs-10 col-sm-5" name="whatsapp" />
</div>
</div>

                                
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email ID:</label>
<div class="col-sm-9">
<input type="text" id="email" value="<?php echo $row->email;?>" class="col-xs-10 col-sm-5" name="email" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date of Birth :</label>
<div class="col-sm-9">
<input type="text" id="dob" value="<?php echo $row->date_of_birth;?>" class="col-xs-10 col-sm-5" name="dob" />
</div>
</div>



<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Sex :</label>
<div class="col-sm-9">
<input type="text" id="sex" value="<?php echo $row->sex;?>" class="col-xs-10 col-sm-5" name="sex" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Address : </label>
<div class="col-sm-9">
<input type="text" id="address" value="<?php echo $row->address;?>" class="col-xs-10 col-sm-5" name="address" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pin :</label>
<div class="col-sm-9">
<input type="text" id="pin" value="<?php echo $row->pin;?>" class="col-xs-10 col-sm-5" name="pin" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">District  :</label>
<div class="col-sm-9">
<input type="text" id="district" value="<?php echo $row->district;?>" class="col-xs-10 col-sm-5" name="district" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">State :</label>
<div class="col-sm-9">
<input type="text" id="state" value="<?php echo $row->state;?>" class="col-xs-10 col-sm-5" name="state" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father's Name :</label>
<div class="col-sm-9">
<input type="text" id="fathername" value="<?php echo $row-> parent_name;?>" class="col-xs-10 col-sm-5" name="fathername" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father's Occupation:</label>
<div class="col-sm-9">
<input type="text" id="occupation" value="<?php echo $row->occupation;?>" class="col-xs-10 col-sm-5" name="occupation" />
</div>
</div>


<?php
foreach($b as $row):
{
?>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last Qualification :</label>
<div class="col-sm-9">
<input type="text" id="qualification" value="<?php echo $row-> qualification;?>" class="col-xs-10 col-sm-5" name="qualification" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Year of Pass:</label>
<div class="col-sm-9">
<input type="text" id="year" value="<?php echo $row->year;?>" class="col-xs-10 col-sm-5" name="year" />
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Percentage:</label>
<div class="col-sm-9">
<input type="text" id="percentage" value="<?php echo $row->percentage;?>" class="col-xs-10 col-sm-5" name="percentage" />
</div>
</div>


<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Graduated Instituation:</label>
<div class="col-sm-9">
<input type="text" id="instituation" value="<?php echo $row->last_institute;?>" class="col-xs-10 col-sm-5" name="instituation" />
</div>
</div>

<?php }endforeach;?> 
<div class="clearfix form-actions">
<div class="col-md-offset-4 col-md-9"> 
<input type="submit" class="btn btn-info" value='Update'>  
                        <a class="btn btn-info "  href="<?php echo base_url();?>index.php/enquiry_controller/enquiry_view/">Back</a> 

</div>
</div>
</div>
</div></div>
</div>
</div>
                       
<?php }endforeach;?>                        
<?php echo form_close(); ?>
                                    

												
</div>
		
<?php include_once APPPATH . 'views/footer.php'; ?>

