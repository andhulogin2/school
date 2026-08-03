<div style="padding-top:50px;">  
	<?php echo form_open(base_url() . 'index.php/admin/birthday_message/', array('class' => 'form')); ?> 
    <table class="table table-bordered table-striped" border="1" bordercolordark="#000000">
        <thead class="thin-border-bottom">
            <tr>
                <th class="table-header" style="background-color:#66CCFF">
                    Name
                </th>
    
                <th class="table-header" style="background-color:#66CCFF">
                    Class
                </th>
    
                <th class="table-header" style="background-color:#66CCFF">
                    Send Wish
                    
    
                </th>
            </tr>
        </thead>
    
        <tbody>
        <?php
                $counter	=	0;
                foreach($query as $birth_day1)
                {
                    $unixtime	=	str_replace("/","-",$birth_day1['month']);
                    $time 		= 	date("m-d",strtotime($unixtime));
					//echo $time."<br>";
                    if($time==$birth_month)
                    {
                        $counter++;
                        ?>
                        <tr>
                            <td><?php echo $birth_day1['student'];?></td>
                            <td>
                                <?php echo $birth_day1['class']."-".$birth_day1['section'];?>
                            </td>
                            <td>
                                <input type="checkbox" name="student[]" id="student[]" value=" <?php echo $birth_day1['student_id'];?>"/>
                            </td>
                        </tr>
                        <?php 
                    }
                }
                if($counter==0)
                {
                    ?>
                    <tr>
                        <td colspan="3" style="text-align:center;color:red">No Data Found!</td>
                    </tr>
                    <?php
                }
				?>
        </tbody>
    </table>
                <?php
                if($counter>0)
                {
                    ?>
                    	<div class="row col-xs-12" align="center" style="padding-top:10px;">
                            Message:&nbsp;<input type="text" name="wish_message" value="" style="width:300px;"/>
                            <button type="submit" class="btn btn-sm btn-yellow" onClick="preloader()">
                                <i class="ace-icon fa fa-check"></i>
                                SEND SMS
                            </button>
                      	</div>  	    
                    <?php
                }
	echo form_close();				
                ?>    
</div>