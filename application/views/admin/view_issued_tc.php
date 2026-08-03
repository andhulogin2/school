<?php 
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>
            
            <ul class="breadcrumb">
            <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="#">Home</a>
            </li>
            <li class="active">View TC</li>
            </ul><!-- /.breadcrumb -->
            
            <div class="nav-search" id="nav-search">
                <form>
                <span class="input-icon">
                
                </span>
                </form>
            </div><!-- /.nav-search -->
        </div>
        <div class="page-header">
        <h1>Transfer Cetificate</h1>
        </div>
 
 <div style="margin-left:6px;" class="row col-md-12" align="center" >
       
<table id="simple-table" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th class="table-header">SI</th>
<th class="table-header">TC Number</th>
<th class="table-header">Student Name</th>
<th class="table-header">Issued Date</th>
<th class="table-header">Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
foreach($tc_issued as $tc)
{
$student_id=$tc['student_id'];
$student_name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name;
?>
<tr>
<td><?php echo $i=$i+1; ?></td>
<td><?php echo $tc['tc_number']; ?></td>
<td><?php echo $student_name; ?></td>
<td><?php if($tc['date_issued'] == '1970-01-01' || $tc['date_issued'] == '' || $tc['date_issued'] == '0000-00-00'){ echo ""; }else{ echo date('d/m/Y',strtotime($tc['date_issued'])); } ?></td>
<td align="center">			
		<a href="<?php echo base_url(); ?>index.php/Admin/student_portal/<?php echo $student_id; ?>" class="tooltip-success" data-rel="tooltip" title="View Profile" ><span class="blue"><i class="ace-icon fa fa-user bigger-120"></i></span></a>&nbsp;&nbsp;&nbsp;
		<a href="<?php echo base_url(); ?>index.php/Admin/view_tc/<?php echo $tc['tc_id']; ?>" class="tooltip-success" data-rel="tooltip" title="View" ><span class="blue"><i class="ace-icon fa fa-eye bigger-120"></i></span></a>&nbsp;&nbsp;&nbsp;
    	<a href="<?php echo base_url(); ?>index.php/Admin/pdf_report_of_tc/<?php echo $tc['tc_id']; ?>/1" class="tooltip-success" data-rel="tooltip" title="Download PDF"><span class="blue"><i class="ace-icon fa fa-download bigger-120"></i></span></a>&nbsp;&nbsp;&nbsp;
    	<a href="<?php echo base_url(); ?>index.php/Admin/pdf_report_of_tc/<?php echo $tc['tc_id']; ?>/0" target="_blank" class="tooltip-success" data-rel="tooltip" title="Print"><span class="blue"><i class="ace-icon fa fa-print bigger-120"></i></span></a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>



<?php include_once APPPATH . 'views/footer.php'; ?>


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
