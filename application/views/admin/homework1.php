<?php
$role=$this->session->userdata('role');
 include_once APPPATH . 'views/main_head.php';
 ?>

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
                                        <li class="active">Homework</li>
                                    </ul><!-- /.breadcrumb -->
                   		 </div>
						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
	

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						
                        <div class="page-header">
							<h1>
								Admin
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									 Homework
								
							</h1>
						</div>
                    
                   </div> 
                                           
                        <div class="table-header">
                            AVAILABLE HOMEWORK
                            
                        </div>
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
								
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>SlNo			</th>
                            <th>Title			</th>
                            <th>Class			</th>
                            <th>Section   		</th>
                            <th>Added by		</th>
                            <th>Subject			</th>
                            <th>Options			</th>
                        
                        </tr>
                        </thead>
                        
                        <tbody>
                         <?php
						 if($this->session->userdata('role')==1 || $this->session->userdata('role')==2)
						 {
						  $running_year=get_running_year();
                            $counter = 1;
                            $this->db->where('homework_status', 1);
                            $this->db->order_by('homework_id', 'desc');
							$this->db->where('is_deleted','N');
							$this->db->where('academic_year',$running_year);
							//$this->db->where('branch_id',$this->session->userdata('branch_id'));
							//$this->db->where('dept_id',$this->session->userdata('dept_id'));
                            $homeworks = $this->db->get('homework')->result_array();
							}
							else
							{
							$running_year=get_running_year();
                            $counter = 1;
                            $this->db->where('homework_status', 1);
                            $this->db->order_by('homework_id', 'desc');
							$this->db->where('is_deleted','N');
							$this->db->where('academic_year',$running_year);
							$this->db->where('branch_id',$this->session->userdata('branch_id'));
						//	$this->db->where('dept_id',$this->session->userdata('dept_id'));
                            $homeworks = $this->db->get('homework')->result_array();
							
							}
							
                            foreach ($homeworks as $row):
                                ?>
                        
                        
                        <tr>
                           <td><?php echo $counter++; ?>					</td>
                           <td><a href="<?php echo base_url(); ?>index.php/admin/homeworkroom/details/<?php echo $row['homework_code']; ?>"><?php echo $row['title']; ?></a> </td>
                                                
                                            
                           <td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?>	</td>
                           <td><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?> 		</td>
                           <td><?php echo $this->db->get_where(tbl_users , array(user_id => $row['uploader_id']))->row()->username;?>	</td>
                                      
                           <td><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?>		</td>
                          <td> &nbsp;&nbsp;<a  href="<?php echo base_url(); ?>index.php/admin/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                                           <i class="fa fa-edit text-info"></i>
                                        </a>&nbsp;&nbsp;&nbsp;
                                        
                                        <a href="<?php echo base_url();?>index.php/admin/homework/delete/<?php echo $row['homework_code'];?>" onclick="return confirm('Are-you-sure');">
                                            <i class="fa fa-close text-danger"></i>
                                        </a>
                           </td>
                        </tr>
                        
                        <?php
                        $i=$i+1;
                        
                        ?>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
		</div>
</div>



  	    			<?php include_once APPPATH . 'views/footer.php'; ?>

		<!-- basic scripts -->

		<!--[if !IE]> -->
		
		

		<!-- page specific plugin scripts -->
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js"></script>

		<!-- ace scripts -->
		
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
					  null, null,null, null,
					  { "bSortable": false },
					  { "bSortable": false }
					],
					"aaSorting": [],
			
					
			    } );
				
			    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
				
				
				setTimeout(function() {
					$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
						var div = $(this).find('> div');
						if(div.length > 0) div.tooltip({container: 'body'});
						else $(this).tooltip({container: 'body'});
					});
				}, 200);
				
				
				
				//ColVis extension
				var colvis = new $.fn.dataTable.ColVis( oTable1, {
					"buttonText": "<i class='fa fa-search'></i>",
					"aiExclude": [0, 6],
					"bShowAll": true,
					//"bRestore": true,
					"sAlign": "right",
					"fnLabel": function(i, title, th) {
						return $(th).text();//remove icons, etc
					}
					
				}); 
				
				//style it
				$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
				
				//and append it to our table tools btn-group, also add tooltip
				$(colvis.button())
				.prependTo('.tableTools-container .btn-group')
				.attr('title', 'Show/hide columns').tooltip({container: 'body'});
				
				//and make the list, buttons and checkboxed Ace-like
				$(colvis.dom.collection)
				.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
				.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
				.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
			
			
				
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) tableTools_obj.fnSelect(row);
						else tableTools_obj.fnDeselect(row);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(!this.checked) tableTools_obj.fnSelect(row);
					else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
				});
				
			
				
				
					$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			})
		</script>
        <script src="assets/js/neon-custom-ajax.js"></script>
<script type="text/javascript">
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('.main_data').html(response);
        }
    });
}
</script>


