<?php
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
                <li class="active"> Reports</li>
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
        <div class="page-content">
            
            <div class="page-header">
                <h1>
                    Fee Report Per Year
                </h1>
            </div>
            
            <div align="right" style="padding-right:10px;"><a href="<?php echo base_url() . 'index.php/FeeManagement/fee_report_full'; ?>"><b><button class="btn-info">Back</button></b></a></div> 
            <br/>
  			<div id="section-to-print">
                <div class="table-responsive">
                   <table id="dynamic-table" class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                                <tr>
                                    <th class="table-header"><center>Sl No.</center></th>
                                    <th class="table-header"><center>Class-Section</center></th>
                                    <th class="table-header"><center>Fee Head</center></th>
                                    <th class="table-header"><center>Total </center></th>
                                    <th class="table-header"><center>Collected</center></th>
                                    <th class="table-header"><center>Concession</center></th>
                                    <th class="table-header"><center>Balance</center></th>
                                </tr>
                        </thead>
                     
                         <tbody>
                            <?php 
                            $count 			= 	1;
                            $tot_amount		=	0;
                            $tot_collection	=	0;
                            $tot_balance	=	0;
                            $tot_concession	=	0;
                            foreach($data as $row):
                                $amount		=	0;
                                $collection	=	0;
                                $balance	=	0;
                                $concession	=	0;
                            ?>
                            <tr>
                                <td rowspan="<?php echo count($row['details'])+1; ?>"><center><?php echo $count++;?></center></td>
                                <td rowspan="<?php echo count($row['details'])+1; ?>"><center><?php echo $row['class_name']."-".$row['section_name'];?></center></td>
                                <?php 
                                foreach($row['details'] as $row1):
                                    $collected	=	$row1['amount']-$row1['balance']-$row1['concession'];
                                    $amount		=	$amount+$row1['amount'];
                                    $collection	=	$collection+$collected;
                                    $balance	=	$balance+$row1['balance'];
                                    $concession	=	$concession+$row1['concession'];
                                ?>
                                    <td><center><?php echo $row1['item_head'];?></center></td>
                                    <td align="right"><?php echo number_format($row1['amount'],2);?></td>
                                    <td align="right"><?php echo number_format(($collected),2);?></td>
                                    <td align="right"><?php echo number_format($row1['concession'],2);?></td>
                                    <td align="right"><?php echo number_format($row1['balance'],2);?></td>
                                </tr>
                                <tr>	
                                <?php
                                endforeach;
                                $tot_amount		=	$tot_amount+$amount;
                                $tot_collection	=	$tot_collection+$collection;
                                $tot_balance	=	$tot_balance+$balance;
                                $tot_concession	=	$tot_concession+$concession;
                                if(count($data)>1)
                                {
                                ?>
                                <td><b><i>Total</i></b></td>
                                <td align="right"><b><i><?php echo number_format($amount,2);?></i></b></td>
                                <td align="right"><b><i><?php echo number_format($collection,2);?></i></b></td>
                                <td align="right"><b><i><?php echo number_format($concession,2);?></i></b></td>
                                <td align="right"><b><i><?php echo number_format($balance,2);?></i></b></td>
                                <?php
                                }
                                ?>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="3"><center><b>Total</b></center></td>
                                <td align="right"><b><i><?php echo number_format($tot_amount,2);?></i></b></td>
                                <td align="right"><b><i><?php echo number_format($tot_collection,2);?></i></b></td>
                                <td align="right"><b><i><?php echo number_format($tot_concession,2);?></i></b></td>
                                <td align="right"><b><i><?php echo number_format($tot_balance,2);?></i></b></td>
                            </tr>
                        </tbody>
                    </table>
				</div>
        	</div>  
            <div style="text-align:center">    
            	<input type="button" class="btn btn-info" onclick="printDiv()" value="Print" />  
			</div>                
		</div>
	</div>
</div>
                   
<div></div>
<?php include_once APPPATH . 'views/footer.php'; ?>

<script type="text/javascript">
	function get_dept(branch_id) 
	{
	//alert(branch_id);
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_dept_all/' + branch_id ,
            success: function(response)
            {
                jQuery('#department').html(response);
				if($('#department').children('option').length=="1")
				{
					jQuery('#department').html("<option value='0'>Select</option>");
				}
            }
        });
    }
</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.mydatepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })
    });
	function printDiv() 
	{
		 window.print();
	}	
</script> 
<style>
@media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
  #dynamic-table{
	width:100%; 	 
  }
}

</style>
