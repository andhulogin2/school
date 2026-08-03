<?php
	include_once APPPATH . 'views/student_head.php';

?>
 

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
							<li class="active">View Time Table</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1><span class="active">View Time Table</span></h1>
					  </div><!-- /.page-header -->
  
  
  <table id="simple-table" class="table table-striped table-bordered table-hover resposive" cellpadding="2">                                   
 <tr>                                       
<?php 
$count=1;

echo "<tr><th  class='table-header' align='right'>" ;
$cols=0;
foreach($class_timing as $row)
{ 
echo "<th  class='table-header' align='right'>".$row['timing_name']." </th>";
$cols++;
}
foreach($time_table as $row)
{ 
echo "<tr> ";
$pos=0;
foreach($row as $value)
{
$pos++;
if($pos==5 || ($pos>=8 && $pos<8+$cols))
echo "<td>".$value." </td>";
}
echo " </tr> ";
} 

?>

       </tr> 
     
<tr><td colspan="8">

</td></tr>
</table>
</div></div></div>

                      
	
			<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/feeManagement/get_class_section1/' + class_id ,
            success: function(response)
            {
                jQuery('#section_id').html(response);
			}
        });
    }
	
	
	function get_class_hours()
	{
	var class_id = document.getElementById('class').value;
	var section_id = document.getElementById('section_id').value;
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_class_hours/'+class_id+'/'+section_id,
            success: function(response)
            {
                jQuery('#class_hours').html(response);
			}
        });

	}
	
	function get_time_table()
	{
	var class_id = document.getElementById('class').value;
	var section_id = document.getElementById('section_id').value;
	var branch_id = document.getElementById('branch').value;
	//alert(section_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/Hourly_attendance/get_time_table/'+class_id+'/'+section_id+'/'+branch_id,
            success: function(response)
            {
                jQuery('#class_hours').html(response);
			}
        });

	}

</script>
<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
            }
        });
    }
	

	
</script>

<script type="text/javascript">
	function get_class(dept_id) 
	{
	//alert(dept_id);
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_students/' + dept_id ,
            success: function(response)
            {
                jQuery('#class').html(response);
            }
        });
    }
	

	
</script>
