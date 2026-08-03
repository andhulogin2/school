


<div class="table-responsive">
<table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">

                <tr>
                    <th style="text-align: center;" class="table-header">Date</th>
                   <?php
                   foreach($class_timing as $timing)
				   {
				   ?>
                    <th style="text-align: center;" class="table-header"><?php echo $timing['timing_name']; ?></th>
                    <?php
					}
					?>
                </tr>
                    <?php
                    foreach ($students as $row){
                        ?>
                        <tr>
                            <td style="text-align: center;"><?php echo date('d-m-Y',strtotime($row['att_date'])); ?></td>
                            <?php
                   foreach($class_timing as $timing)
				   {
				   $data=$timing['timing_name'];
				   ?>
                    <th style="text-align: center;" ><?php echo $row[$data]; ?></th>
                    <?php
					}
				    } ?>
                
            </table>
      

 </div>  

<div class="col-md-2" style="margin-top: 20px;">
        <input type="submit" class="btn btn-info" type="button" value='Download Attendance Report'> 
   </div>                 
 
