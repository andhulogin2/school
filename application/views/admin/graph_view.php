<?php include_once APPPATH . 'views/main_head.php';?>

<div class="main-content">
<style>
.container {
	padding-bottom:20px;
	min-width: 310px;
	max-width: 700px;
	height: 400px;
	margin: 0 auto
}

</style>
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
							<li class="active">Mark Report</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Report 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									Graph
								
							</h1>
						</div>
						<div style="text-align:right;padding-right:10px"><a href="<?php echo base_url().'index.php/admin/graph_marks'; ?>"><b>Back</b></a></div>
                    
                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <button type="button" onclick="printDiv('printableArea')" class="btn btn-info">Print</button>
                            </div>
                        </div>    
                        <div class="row" id="print">
                        	<?php 
							
							/*echo "<pre>";
							print_r($result); 
							echo "</pre>";*/
							//echo $result[0]['student_name'];
							?>
                            <div class="col-md-12" id="printableArea">
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <button type="button" onclick="printDiv('printableArea')" class="btn btn-info">Print</button>
                            </div>
                        </div>    
                    
                    </div>
            	</div>
          	</div>

    
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>    
<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
$(document).ready(function(){
	
	<?php
	for($i=0;$i<count($result['students']);$i++)
	{
	?>
		<?php  
				$year	=	get_running_year();	
				$this->db->select('a.exam_id,b.name');
				$this->db->where('a.student_id',$result['students'][$i]['student_id']);
				$this->db->where('a.class_id',$result['students'][$i]['class_id']);
				$this->db->where('a.year',$year);
				$this->db->join('exam b','b.exam_id=a.exam_id');
				$this->db->group_by('a.exam_id');
				$this->db->order_by('a.exam_id','ASC');
				$exams	=	$this->db->get('mark a')->result_array();
				
				?>
		$('#printableArea').append('<div id="container'+<?php echo $i; ?>+'" class="container"></div><br>')
		Highcharts.chart('container'+<?php echo $i; ?>, {
		
			title: {
				text: '<?php echo $result['students'][$i]['name']; ?>'
			},
		
			subtitle: {
				text: ''
			},
			xAxis: {
				title: {
					text: 'Exams'
				},
				categories: [
							<?php
							$j=1;
							foreach($exams as $row):	
								if($j==count($row))
								{
									echo "'".$row['name']."'";
								}
								else
								{
									echo "'".$row['name']."',";
								}
							endforeach;
							?>
							]
			},
			yAxis: {
				title: {
					text: 'Marks'
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},
		
			plotOptions: {
				line: {
					dataLabels: {
						enabled: true
					},
					enableMouseTracking: true
				},
				series: {
					label: {
						connectorAllowed: false
					},
				}
			},
			<?php
				$this->db->select('a.subject_id,b.name');
				$this->db->where('a.student_id',$result['students'][$i]['student_id']);
				$this->db->where('a.class_id',$result['students'][$i]['class_id']);
				$this->db->where('a.year',$year);
				$this->db->from('mark a');
				$this->db->join('subject b','b.subject_id=a.subject_id');
				$this->db->group_by('a.subject_id');
				$this->db->order_by('a.subject_id','ASC');
				$subjects	=	$this->db->get()->result_array();
				
			?>
			series: [
						<?php
						foreach($subjects as $row):
						?>
						{
							name: '<?php echo $row['name'] ?>',
							data: 	[
									<?php
										foreach($exams as $row1):
											$this->db->select('a.mark_obtained');
											$this->db->where('a.student_id',$result['students'][$i]['student_id']);
											$this->db->where('a.class_id',$result['students'][$i]['class_id']);
											$this->db->where('a.subject_id',$row['subject_id']);
											$this->db->where('a.exam_id',$row1['exam_id']);
											$this->db->where('a.year',$year);
											$this->db->from('mark a');
											$marks	=	$this->db->get()->row();
											if(isset($marks))
											{
											    if($marks->mark_obtained==NULL || $marks->mark_obtained=='')
											    {
											        echo "0,";
											    }
											    else
											    {
												    echo $marks->mark_obtained.",";
											    }
											}
											else
											{
												echo "0,";
											}
										endforeach;
									?>
									]
						},
						<?php
						endforeach;	
						?>
					],
		
			responsive: {
				rules: [{
					condition: {
						maxWidth: 500
					},
					chartOptions: {
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}]
			}
		
		});	
	<?php
	}
	?>
	
		
});	
</script>