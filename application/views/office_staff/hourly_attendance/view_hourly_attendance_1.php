<div class="row">
    <div class="col-md-12">
    <div class="white-box">
  <?php /*  
     <?php echo form_open('Admin/staff_view', array('class' => 'form-horizontal'));?>
                          <div align="right" style="padding-right:10px"> 
                          <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Absent For : </label>

										<div class="col-sm-4">
											<select class="col-xs-10 col-sm-5" id="absent" name="absent">
                                               <option value="">Select</option>
                                              <?php 
											  $role	=	$this->session->userdata('role');
											  $designation=$this->db->get('tbl_user_roles')->result_array();
											   foreach($designation as $designation1)
											   {
											   if($role<$designation1['role_id'])
											   {
											   ?>
                                               <option value="<?php echo $designation1['role_id']?>"><?php echo $designation1['role_name']; ?></option>
                                               <?php
											   }
											   }?>
                                               
                                             </select>
											<input type="submit" type="button" value='view'>
										</div>
                                        
									</div>
                                    
                                    
                                       
                          </div>
                           <?php echo form_close(); ?>
  */ ?>  
    
		<div class="row" style="padding-left:100px;">
		</div>
 <div>
          <table id="simple-table" class="table table-striped table-bordered table-hover sortable">
                <tr>
                    <th style="text-align: center;" class="table-header">No.</th>
                   <!-- <th style="text-align: center;" class="table-header">Roll</th> -->
                   <th style="text-align: center;" class="table-header">Student</th>
                   <?php
                   foreach($class_timing as $timing)
				   {
				   ?>
                    
                    <th style="text-align: center;" class="table-header"><?php echo $timing['timing_name']; ?></th>
                    <?php
					}
					?>
                   <?php // <th style="text-align: center;" class="table-header">6th Hour</th> ?>
                    <th style="text-align: center;" class="table-header">Option</th>
                </tr>
                    <?php
					 $count=1;
                    foreach ($students as $row){
                        ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                          <!--  <td><?php //echo $row['roll']; ?></td> -->
                            <td><?php echo $row['name']; ?></td>
                            <?php
                   foreach($class_timing as $timing)
				   {
				   $data=$timing['timing_name'];
				   ?>
                    <th style="text-align: center;" ><?php echo $row[$data]; ?></th>
                    <?php
					}
					?>
                            
                       <?php //     <td><?php echo $row['6th Hour']; ?></td> 
                            <td>
                            <a class="btn btn-info" name="send" href="<?php echo base_url();?>index.php//<?php echo $row['student_id']; ?>/<?php echo $row['class_id']; ?>/<?php echo $row['section_id']; ?>" >Send SMS</a>
                            </td>
                        </tr>
                    <?php } ?>
                
            </table>
        <?php echo form_close(); ?>
        
           
 <div class="form-group">
   
    <div class="col-sm-offset-3 col-sm-5">
        <a class="btn btn-info" name="send_all" href="<?php echo base_url();?>index.php//<?php ?>" >Send All</a>
    </div>
    </div>
