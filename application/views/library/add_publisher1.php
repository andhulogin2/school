<?php include_once APPPATH . 'views/library_head.php';?>
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
<a href="#">Books</a>							</li>

<li class="active">Edit Publisher</li>

</ul>

</div>

<!-- /section:basics/content.breadcrumbs -->
<div class="page-content">

<br>
	<br>


<?php $edit_data = $this->db->get_where('tbl_lib_publishers' , array('publisher_id' => $publisher_id))->result_array();?>
                <?php      foreach ($edit_data as $row):
                ?>
                    <?php echo form_open(base_url() . 'index.php/library/edit_publisher/'.$row['publisher_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
        

                            <div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Publisher Name :<font color="#FF0000">*</font></label>
							<div class="col-sm-9">
							<input type="text" id="name" class="col-xs-10 col-sm-5" name="name" required="" value="<?php echo $row['publisher_name'];?>"/>
							</div>
							</div>

<div class="space-2"></div>

                                   

                               <div class="form-group">
                               <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Address: </label>
                               <div class="col-sm-9">
                               <input type="text" id="publisher_address" name="publisher_address" class="col-xs-10 col-sm-5" required="" value="<?php echo $row['publisher_address'];?>"/>
                               </div>
                               </div>
                               
<div class="space-2"></div>
                                <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number 1:<font color="#FF0000">* </font></label>
                                <div class="col-sm-9">
                                <input type="text" id="phone1" name="phone1" placeholder="Phone number 1" class="col-xs-10 col-sm-5" required="" value="<?php echo $row['publisher_phone1'];?>"/>
                                </div>
                                </div>
                                
<div class="space-2"></div>
                                
                                <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Phone number 2: </label>
                                <div class="col-sm-9">
                                  <input type="text" id="phone2" name="phone2" placeholder="Phone number 2"  class="col-xs-10 col-sm-5"  value="<?php echo $row['publisher_phone2'];?>"/>
                                </div>
                                </div>
                                
<div class="space-2"></div>
                             
                                 <div class="form-group">
                                 <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email ID 1:</label>
                                 <div class="col-sm-9">
                                 <input type="text" id="email1" name="email1" placeholder="Email ID 1" class="col-xs-10 col-sm-5" value="<?php echo $row['publisher_email1'];?>" />
                                 </div>
                                 </div>



<div class="space-2"></div>
                                 <div class="form-group">
                                 <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Email ID 2:</label>
                                 <div class="col-sm-9">
                                 <input type="text" id="email2" name="email2" placeholder="Email ID 2" class="col-xs-10 col-sm-5" value="<?php echo $row['publisher_email2'];?>" />
                                 </div>
                                 </div>                                   

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div class="col-md-offset-4 col-md-9">
<input type="submit" class="btn btn-info"  value="Update"> 
</div>

<div align="right">
<a href="<?php echo base_url();?>index.php/Library/view_publisher/"></a> 
</div>

<?php endforeach;?>
<?php echo form_close(); ?>



</div>
</div>
</div>


</div>


<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.gritter.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.js"></script>
<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-timepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.hotkeys.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap-wysiwyg.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.spinner.js"></script>
<script src="<?php echo base_url(); ?>assets/js/x-editable/bootstrap-editable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/x-editable/ace-editable.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.js"></script>

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace/elements.scroller.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.colorpicker.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.fileinput.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.typeahead.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.wysiwyg.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.spinner.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.treeview.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.wizard.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/elements.aside.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.ajax-content.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.touch-drag.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.submenu-hover.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-box.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-rtl.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.settings-skin.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.widget-on-reload.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>       

