<?php include_once APPPATH . 'views/head.php';?>
<br />
                  <font color="black">Remark</font>
             
<div class="panel-body">                
        <?php echo form_open(base_url() . 'index.php/admin/complaint_remark/create/' . $report_code, array(
                    'class' => 'form-horizontal form-groups-bordered validate project-submit', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea class="form-control autogrow" rows="3" name="remark"  id="remark" placeholder="Write.."></textarea>
                        </div>
                            <button style="margin-left: 16px; margin-top: 5px;" type="submit" id="submit-button" class="btn btn-info">
                                Save
                            </button> 
                    </div>
                <?php echo form_close(); ?>
                </div>
                
    <?php include_once APPPATH . 'views/footer.php'; ?>
   