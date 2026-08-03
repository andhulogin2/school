        	<table class="table table-sripped table-bordered">
            	<tr>
                    <th class="table-header">Sl.No.</th>                
                    <th class="table-header">Name</th>  
                    <th class="table-header">class</th>  
                    <th class="table-header">Birthday</th>  
              	</tr>
               
                	<?php
					$i=1;
					$from_date 	= $date_from;
					$to_date 	= $date_to;
					if(count($student)>0){
					foreach($student as $row){
					if($row['birthday']!=''){
					$bday	=	str_replace("/","-",$row['birthday']);
					$birth_date = date("m-d",strtotime($bday));
					if($birth_date>=$from_date && $birth_date<=$date_to){		
						?>
                        <tr>
                            <td><?php echo $i; ?></td>    
                            <td><?php echo $row['name']; ?></td>    
                            <td><?php echo $row['class_name']." - ".$row['section_name']; ?></td>    
                            <td><?php echo $row['birthday']; ?></td>    
                        </tr>            
                        <?php
						$i++;	
					}}
					}}
					else
					{ ?>
						<tr><td colspan="4">no data found</td></tr>
					<?php
                    }
					?>
                	
                </tr>                   
            </table>
        
