<div class="table-responsive" style="padding:10px;">
    <table class="table table-bordered table-stripped">
        <tr>
            <th class="table-header">Sl.No</th>
            <th class="table-header">Name</th>
            <th class="table-header">Class</th>
            <th class="table-header">Phone</th>
            <th class="table-header">Reason</th>
            <th class="table-header"></th>
        </tr>
        <?php
        $sl_no	=	1;
        if(count($report)>0)
        {
            foreach($report as $row):
            ?>
                <tr>
                    <td><?php echo $sl_no; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['class_name']."-".$row['section_name']; ?></td>
                    <td><?php echo $row['phone1']; ?></td>
                    <td><?php echo $row['note']; ?></td>
					<td><a href="<?php echo base_url(); ?>index.php/Admin/student_portal/<?php echo $row['student_id']; ?>" class="tooltip-success" data-rel="tooltip" title="View Profile" ><span class="blue"><i class="ace-icon fa fa-user bigger-120"></i></span></a></td>
                </tr>
            <?php	
            $sl_no++;
            endforeach;
        }
        else
        {
        ?>
            <tr>
                <td colspan="5" style="text-align:center;color:#FF0000">No data found...</td>
            </tr>
        <?php    
        }
        ?>
    </table>
</div>    