<div class="row" style="padding-top:10px;">
	<div class="col-md-12">
    	<div class="table-responsive">
        	<table id="simple-table" class="table table-sripped table-bordered">
            <thead>
            	<tr>
                    <th class="table-header">Sl.No.</th>                
                    <th class="table-header">Name</th>  
                    <?php
                    $role=$this->session->userdata('role');
                    if($role==1 || $role==2)
                    {
                        ?>
                    <th class="table-header">Branch</th>                
                        <?php
                    }
                    if($role<=3)
                    {
                        ?>
                    <th class="table-header">Department</th>                
                        <?php
                    }
                    ?>              
                    <th class="table-header">Class</th>                
                    <th class="table-header">Phone</th>   
              	</tr>
           </thead>
           <tbody>    
                	<?php
					$i=1;
					foreach($result as $row):
						?>
                        <tr>
                            <td><?php echo $i; ?></td>    
                            <td><a href="<?php echo base_url().'index.php/admin/student_portal/'.$row['student_id']; ?>" target="_blank"><?php echo $row['name']; ?></a></td>  
                            <?php    
                            if($role==1 || $role==2)
                            {
                                ?>
                            <td><?php echo $row['branch_name']; ?></td>                 
                                <?php
                            }
                            if($role<=3)
                            {
                                ?>
                            <td><?php echo $row['dept_name']; ?></td>           
                                <?php
                            }
                            ?>  
                            <td><?php echo $row['class_name'].'-'.$row['section_name']; ?></td>              
                            <td><?php echo $row['phone1']; ?></td>  
                        </tr>            
                        <?php
						$i++;	
					endforeach;
					?>
                	
                </tr> 
                </tbody>                  
            </table>
        </div>
        <br />
        <a href="<?php echo base_url();?>index.php/Admin/admission_report_excel/<?php echo $branch_id; ?>/<?php echo $dept_id; ?>/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $from_date; ?>/<?php echo $to_date; ?>" title="Download Excel"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i> Excel</button></a>

<a href="<?php echo base_url();?>index.php/Admin/admission_report_pdf/<?php echo $branch_id; ?>/<?php echo $dept_id; ?>/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $from_date; ?>/<?php echo $to_date; ?>" title="Download Excel"><button class="btn-info"><i class="fa fa-download" aria-hidden="true"></i> PDF</button></a>

    </div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	<!--<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
  



<script type="text/javascript">
$(function() {
	$('#simple-table').dataTable({
             stateSave:true,
             "aLengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200,'All']],
        "iDisplayLength": 10
	});
});
</script>       
