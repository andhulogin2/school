<?php include_once APPPATH . 'views/head.php'; ?>

<!-- /section:basics/sidebar -->
<div class="main-content">
    <div class="main-content-inner">
        <!-- #section:basics/content.breadcrumbs -->
<br />
        <div class="page-content">
            <!-- /section:settings.box -->
            <div class="page-header">
                <h1>
                   Financial Year
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="widget-box">
                        <div class="widget-header">
                            <h5 class="widget-title"></h5>

                            <!-- #section:custom/widget-box.toolbar -->
                            <div class="widget-toolbar">
                                
                                <a href="#" data-action="fullscreen" class="orange2">
                                    <i class="ace-icon fa fa-expand"></i>
                                </a>

                                <a href="#" data-action="reload">
                                    <i class="ace-icon fa fa-refresh"></i>
                                </a>

                                <a href="#" data-action="collapse">
                                    <i class="ace-icon fa fa-chevron-up"></i>
                                </a>

                                <a href="#" data-action="close">
                                    <i class="ace-icon fa fa-times"></i>
                                </a>
                            </div>

                            <!-- /section:custom/widget-box.toolbar -->
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <?php if(count($year)>0) { ?>
                                         <div align="right">
                                            <button data-toggle="modal" data-target="#set_current_year" class="btn btn-info">Set Current Year</button>
                                            <button data-toggle="modal" data-target="#add_new_year" class="btn btn-success"><i class="fa fa-plus bigger-120"></i> New</button>	</div>
                                         <?php } else { ?>
                                         <div align="center" style="padding-top:100px;">
                                            <button data-toggle="modal" data-target="#add_new_year" class="btn btn-success"><i class="fa fa-plus bigger-120"></i> New Financial Year</button></div>
                                         <?php } ?>
                                   
                              <div class="modal fade right" id="add_new_year" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full-height modal-right" role="document" >
                                    <div class="modal-content" style="width:600px;">
                                        <div class="modal-header">
                                            <h4 class="modal-title w-100" id="myModalLabel">New Financial Year
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            &times;
                                            </button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo form_open('Admin/add_financial_year'); ?>
                                                            <fieldset>

                                        <div class="col-md-12 col-md-12 form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Description:<i class="glyphicon-asterisk" style="color:#FF0000"></i></label>
                                            <div class="col-xs-12 col-sm-9">
                                            <input type="text" name="description" id="description" class="form-control" required="required" placeholder="Description" />
                                            </div>
                                        </div><br /><br />

                                        <div class="col-md-12 col-md-12 form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Date From:<i class="glyphicon-asterisk" style="color:#FF0000"></i></label>
                                            <div class="col-xs-12 col-sm-9">
                                            <input type="text" name="date_from" id="date_from" class="form-control mydatepicker" required="required" placeholder="Date From" />
                                            </div>
                                        </div><br /><br />

                                        <div class="col-md-12 col-md-12 form-group">
                                           <label class="control-label col-xs-12 col-sm-3 no-padding-right">Date To:<i class="glyphicon-asterisk" style="color:#FF0000"></i></label>
                                            <div class="col-xs-12 col-sm-9">
                                            <input type="text" name="date_to" id="date_to" class="form-control mydatepicker" required="required" placeholder="Date To" />
                                            </div>
                                        </div><br /><br />

                                
                                </fieldset>
                                </div>
                                </div>                                            </div>
                                            <div class="modal-footer justify-content-center">
                                            <button type="submit" class="btn btn-success">Save</button>
                                             <?php  echo form_close();?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="modal fade right" id="set_current_year" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full-height modal-right" role="document" >
                                    <div class="modal-content" style="width:600px;">
                                        <div class="modal-header">
                                            <h4 class="modal-title w-100" id="myModalLabel">Set Current Year
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            &times;
                                            </button></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php echo form_open('Admin/set_financial_year'); ?>
                                                    <fieldset>

                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="center"></th>
                                                                    <th class="center">SlNo.</th>
                                                                    <th>Description</th>
                                                                    <th>From Date</th>
                                                                    <th>To Date</th>
                                                                </tr>
                                                            </thead>
                                            
                                                            <tbody>
                                                            <?php 
                                                            $i=1;
                                                            foreach($year as $row){ ?>
                                                            <tr>
                                                                <td class="center">
                                                                    <input type="radio" name="current_year" <?php if($row['is_active']=='Y'){ echo "checked='checked'";  } ?> class="ace input-lg" value="<?php echo $row['financial_year_id']; ?>" />
                                                                        <span class="lbl bigger-120"></span>
                                                                </td>
                                                                <td class="center"><?php echo $i++; ?></td>
                                                                <td><?php echo $row['description']; ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($row['start_date'])); ?></td>
                                                                <td><?php echo date('d-m-Y',strtotime($row['end_date'])); ?></td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                   </table>
                                                </fieldset>
                                            </div>
                                        </div>                                            
                                    	</div>
                                        <div class="modal-footer justify-content-center">
                                        <button type="submit" class="btn btn-success">Save</button>
                                         <?php  echo form_close();?>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                                        <div class="clearfix">
                                            <div class="pull-right tableTools-container"></div>
                                        </div>
                                
                                        <!-- div.dataTables_borderWrap -->
                                        <div>
                                        <?php if(count($year)>0) { ?>
                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="center">SlNo.</th>
                                                        <th>Description</th>
                                                        <th>From Date</th>
                                                        <th>To Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                
                                                <tbody>
                                                <?php 
                                                $i=1;
                                                foreach($year as $row){ ?>
                                                    <tr>
                                                        <td class="center"><?php echo $i++; ?></td>
                                                        <td><?php echo $row['description']; ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($row['start_date'])); ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($row['end_date'])); ?></td>
                                                        <td>
                                                        <a data-toggle="modal" data-target="#year_edit<?= $row['financial_year_id'] ?>" title="Edit"><span class="blue"><i class="fa fa-pencil bigger-120"></i></span></a>&nbsp;&nbsp;</td>

                                                       
                       <div class="modal " id="year_edit<?= $row['financial_year_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-full-height modal-right">
                                <div class="modal-content" style="width:600px;">
                                    <div class="modal-header">
                                    <h4 class="modal-title w-100" id="myModalLabel">Edit Financial Year
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    &times;
                                    </button></h4>
                                </div><br />
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo form_open('Admin/edit_financial_year/'.$row['financial_year_id']); ?>
                                        <fieldset>
                                        
                                         <div class="col-md-12 col-md-12 form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Description:<i class="glyphicon-asterisk" style="color:#FF0000"></i></label>
                                            <div class="col-xs-12 col-sm-9">
                                            <input type="text" name="description" class="form-control" required="required" placeholder="Description" value="<?=$row['description']; ?>" />
                                            </div>
                                        </div><br /><br />
        
                                        <div class="col-md-12 col-md-12 form-group">
                                            <label class="control-label col-xs-12 col-sm-3 no-padding-right">Date From:<i class="glyphicon-asterisk" style="color:#FF0000"></i></label>
                                            <div class="col-xs-12 col-sm-9">
                                            <input type="text" name="date_from" class="form-control mydatepicker" required="required" placeholder="Date From"  value="<?=date('d-m-Y',strtotime($row['start_date'])); ?>" />
                                            </div>
                                        </div><br /><br />
        
                                        <div class="col-md-12 col-md-12 form-group">
                                           <label class="control-label col-xs-12 col-sm-3 no-padding-right">Date To:<i class="glyphicon-asterisk" style="color:#FF0000"></i></label>
                                            <div class="col-xs-12 col-sm-9">
                                            <input type="text" name="date_to" class="form-control mydatepicker" required="required" placeholder="Date To"  value="<?=date('d-m-Y',strtotime($row['end_date'])); ?>" />
                                            </div>
                                        </div><br /><br />
                                    </fieldset>
                                </div>
                            </div>

                        
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
    
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <?php  echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div> 
                                                        
                    <div class="modal " id="user_delete<?= $row['financial_year_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header modal-header-primary" style="background-color:#009688">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#FFFFFF">
                                        <i class="fa fa-close"></i>
                                    </button>
                                    <h3 style="color:#FFFFFF">
                                            Delete Branch
                                    </h3>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <fieldset>
                                                <div class="col-md-12 form-group user-form-group">
                                                    <label class="control-label"></label>
                                                </div>
                                            </fieldset>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                                                        
                                                    </tr>
													<?php } ?>
                                                </tbody>
                                            </table>
                                         <?php } ?>
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->

<?php include_once APPPATH . 'views/footer.php'; ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
 <script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
	</script> 
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
if ($action=="insert")
{
echo "<script>toastr.success('". "Added Successfully...', 'Added', {timeOut: 5000})</script>";
}

?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
    //initiate dataTables plugin
    var oTable1 = 
    $('#dynamic-table')
    //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
    .dataTable( {
        bAutoWidth: false,
        "aoColumns": [
         { "bSortable": false },
          null, null, null,
          { "bSortable": false }
        ],
        "aaSorting": [],

    } );
})

</script>

</body>
</html>
