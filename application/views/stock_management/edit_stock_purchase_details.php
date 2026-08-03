<?php include_once APPPATH . 'views/main_head.php';?>
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
							<li class="active">Stock Item Master</li>
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
								Create 
								
									<i class="ace-icon fa fa-angle-double-right"></i>
									New Stock Item  Purchase
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                             
                                   </div> 
						</div><!-- /.page-header -->
                            <?php foreach ($master as  $key) {
	   
	   }
                          ?>	
                              <div align="right"><a href="<?php echo base_url();?>index.php/stock_management/view_purchase/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> </div>
                        <?php echo form_open('Stock_management/edit_Purchase_list/'.$key['purchase_master_id'], array('class' => 'form-horizontal'));?>	
                     
		
  <?php
									$role = $this->session->userdata('role');
									if($role == 3 || $role == 4)
									{
									$branch_id = $this->session->userdata('branch_id');
									?>
   <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Branch: <font color="#FF0000">*</font></label>
											<div class="col-sm-3">
                                        	<input type="hidden" id="branch_id" name="branch_id" value="<?php echo $branch_id; ?>" />
                                            <select name="branch" class="select2" id="branch"  disabled  onChange="return get_dept(this.value)">
	                                            <option value="0">Select</option>
	                           						<?php 
   										        		foreach ($branch as $bran)
													  		{
							  						?>
                       <option value="<?php echo $bran['branch_id'];?>"<?php if($bran['branch_id'] == $branch_id){ echo "selected"; } ?>><?php echo $bran['branch_name'];?></option>
                              						<?php 
															}
													?>
                              
                          					</select>
                                        </div>
									</div>
                                    <?php
									}
									else
									{
									?>
                     
                 
                     
                                <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Branch Name:<font color="#FF0000">*</font> </label>
                                      <div class="col-sm-3">
                                 <select id="branch_id" name="branch_id" class="select2" onChange="return get_dept(this.value)" required >
                                        	<option value="">Select</option>
                                            <?php 
											foreach($branch as $bran):
											?>
    <option value="<?php echo $bran['branch_id'];?>"<?php if($bran['branch_id'] == $key['branch_id']){?> selected <?php } ?>><?php echo $bran['branch_name'];?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
                                 </div>
                                 </div>
                              <?php
									}
									?>
                                
                        
                        
                           <div class="space-2"></div>
                        <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="date">Date<font color="#FF0000">*</font>:</label>
									<div class="col-sm-2">
									<div class="clearfix">
									<div class="input-group input-group-sm">
									<input type="text" id="date" name="date" value="<?php echo $key['purchase_date'];?>" class="form-control mydatepicker"  />
                                     <span class="validation-color" id="err_date"><?php echo form_error('date'); ?></span>
									<span class="input-group-addon">
								    <i class="ace-icon fa fa-calendar"></i>
								    </span>
								    </div>
								    </div>
									</div>
									</div>

                          <div class="space-2"></div>

                           <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="purchase invoice number">Invoice Number:<font color="#FF0000">*</font></label>
									<div class="col-sm-3">
				<input type="text" id="purchase_invoice_number" name="purchase_invoice_number"  class="select2" value="<?php echo $key['purchase_invoice_number'];?>" required>	
                                 </div>
								</div>


                      <div class="space-2"></div>

                  <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="product"></label>
								<div class="col-sm-3">
								    <select class="select2" id="product" name="product" required>	
									 <option value="0">Select Product</option>
		                         <?php 
											foreach($product as $item):
											?>
                                            <option value="<?php echo $item['item_master_id']; ?>"<?php if($item['item_master_id'] == $key['item_master_id']){ ?> selected <?php } ?>><?php echo $item['item_name']; ?></option>
                                            <?php
											endforeach;
											?>
				                   </select>
                                   
								</div>
								</div>

<div class="space-2"></div>



  
                 <div class="col-sm-4">
                    <span class="validation-color" id="err_product"></span>
                  </div>
                  
                <!--newly added div!-->
 <div id="datas" style="padding-left:50px;padding-right:50px"></div>   
                 
                 <div class="col-sm-12">
                  <div class="form-group">
                   <br> <br><div class="table-header">
             <center>Inventory Items</center>
     </div>  


                    <div style="overflow-y: auto;">
                    <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                      <thead>
                        <tr>
                          <th style="width: 20px;" title="delete"><i class="fa fa-remove"></i></th>
                          <th class="span2">Sl.No.</th>
                          <th class="span2">Item Name</th>
                         
                          <th class="span2" width="10%">Quantity</th>
                          <th class="span2">Price</th>
                          <th class="span2">Unit</th>
                          <th class="span2" width="10%">Sub Total</th>
                          <th class="span2" width="15%">Discount</th>
                         <th class="span2" width="10%">Total</th>
                        </tr>

                       
                      </thead>
                      <tbody>
                      <?php
                          $i=0;
						  $j=1;
                          $tot=0;
						    $counter = 1;
                        ?>
                          <?php foreach ($items as  $row) { ?>
                       <tr>
<?php
 

?>

                          <td>
                              <a class='deleteRow1' title="delete"> <i class="fa fa-remove"></i> </a><input type='hidden' name='id' id='id' value="<?php echo $i ?>"><input type='hidden' name='item_master_id<?php echo $counter; ?>' id='item_master_id<?php echo $counter; ?>' value="<?php echo $row['item_master_id']; ?>"></td>
                              <td><?php echo $j++; //echo $row['item_master_id']; ?></td>
                              <td><?php echo $row['item_name']; ?></td>
                            
                      <td><input type="number" class="form-control text-center" value="<?php echo $row['purchase_quantity']; ?>" data-rule="quantity" 
                         name='qty<?php echo $counter; ?>' id='qty<?php echo $counter; ?>'   min="1" max="1000"></td>
                          <td><input type='text' name='price<?php echo $counter; ?>' id='price<?php echo $counter; ?>' value="<?php echo $row['purchase_rate']; ?>" readonly /></td>
                              <td><?php echo $row['unit_long_name']; ?></td>
                              <td><input type='text' class='form-control' style='' value="<?php echo $row['purchase_price']; ?>" name='linetotal<?php echo $counter; ?>'
                                 id='linetotal<?php echo $counter; ?>' readonly>
                              </td>
                              <td align="right">
                               <input type="text" id='hidden_discount<?php echo $counter; ?>'   name='hidden_discount<?php echo $counter; ?>' value="<?php echo $row['discount']; ?>" >
                              </td>
                           
                               <td align="right">
                              <input type="text" class="form-control text-right" id='product_total<?php echo $counter; ?>' name='product_total<?php echo $counter; ?>' value="<?php echo $row['net_total']; ?>" readonly>
                               </td><td><input type='hidden' name='new_column[]' id='new_column[]'></td>
                          </tr>
                   <?php
				   $counter++; ?>
				  
				  
				     <?php

                       
                              $product_data[$i] = $row['item_master_id'];
                              //array_push($product_data,$product);
                              $i++;
                              $tot += $row['purchase_price']; 
							
									}
							//echo $i;
									
                            $grand_total += $row['net_amount'];
                           $product = json_encode($product_data);
						
                          ?>

                        
                      </tbody>
                    </table>
                    </div>
                  
                    <input type="hidden" name="total_value" id="total_value" value="<?php echo $tot; ?>">
                    <input type="hidden" name="total_discount" id="total_discount" value="<?php  echo  $row['discount_received']; ?>">
                   
                    <input type="hidden" name="grand_total" id="grand_total" value="<?php  echo  $grand_total; ?>">
                    <input type="hidden" name="table_data" id="table_data"  value="<?php echo $product ?>">
                    <input type="hidden" name="table_data1" id="table_data1">
                    <input type="hidden" name="countr" id="countr">
                    
                    <table class="table table-striped table-bordered table-condensed table-hover">
                     
                      <tr>
                        <td align="right" width="80%">Total Value</td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="totalValue"><?php echo $tot; ?></span></td>
                      </tr>
                      <tr>
                        <td align="right">Total Discount</td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?>
                          <span id="totalDiscount"><?php  echo $row['discount_received']; ?></span>
                        </td>
                      </tr>
                      
                      <tr>
                        <td align="right">Total</td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="grandTotal"><?php echo  $grand_total; ?></span></td>
                      </tr>
                     
                    </table>


                  </div>
                </div>
                
                
                       
                       
                        
                     
                
                
                </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			        <div class="col-sm-9">
                    <button type="submit" id="submit" class="btn btn-info" onclick="return get_count();">&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;</button>
                  </div>
                </div>
                  
          				<?php echo form_close() ?>				
						
						
					                
								<!-- PAGE CONTENT ENDS -->
						
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
        		

		<?php include_once APPPATH . 'views/footer.php'; ?>
 
 
 
 
     
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 		 
<script type="text/javascript">
    $(document).ready(function () {
        $('#date').datepicker({
            autoclose: true,
            todayHighlight: true,
			dateFormat: 'dd-mm-yy'
        })		
		
	
    });
function get_count()
{


var new_column	=	document.getElementsByName("new_column[]");
var count		=	new_column.length;
$('#countr').val(count);

}

</script>	 

<script>
  var i = <?php echo $i; ?>;
  //alert($i);
    var product_data = new Array();
    var counter = <?php echo $counter; ?>; //alert(counter);
  $('#product').change(function(){
      var id = $('#product').val();
	 // alert(id);
      $('#err_product').text('');
      var flag = 0;

        //var classid = $('#class_id').val();
        //var student = $('#student').val();
		// var section = $('#section').val();
		
		if(id == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/Stock_management/getProductAjax/' + id,
		 type: "GET",	
		datatype: "JSON",
            success: function(d)
            {
				//alert(d);
				//console.log(d);
				 data = JSON.parse(d);
				// alert(data[0].sales_price);
				//alert(response);
                //jQuery('#datas').html(response);
				//alert(response);
            //}
 //  });
//} );                 
 $("table.product_table").find('input[name^="item_master_id"]').each(function () {
                    if(data[0].item_master_id  == +$(this).val()){
                      flag = 1;
                    }
                });
				//}
				//});
				//});
				
				

if(flag == 0){

                  var id = data[0].item_master_id;
                  //var code = data[0].code;
                  var item_name = data[0].item_name;
                 // var name = data[0].name;
                  var price = data[0].sales_price;
				  var stocks = data[0].current_stock;
				  //var newRow = "<table><tr><td>"+item_name+"</td></tr></table>";
				 // document.getElementById("datas").innerHTML = newRow;
                var product = { "item_master_id" : id,
                                  "sales_price" :price
                                };
                 
//alert(product['sales_price']); 

                 product_data[i] = product;
				 //alert(product_data[2].item_master_id);
				 //alert(JSON.stringify(product_data));
                 length = product_data.length - 1 ;//alert(length);
                  
              var select_discount = "";
             //   select_discount += '<div class="form-group">';
				// select_discount += '<div class="col-sm-9">';
                 // select_discount += '<class="form-control selectboxit" id="item_discount" name="item_discount" >';
                
                  //select_discount += '</div></div>';

               
 
                  var newRow = $("<tr>");
                  var cols = "";
                  cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin1.png'/> </a><input type='hidden' name='id' name='id' value="+i+"><input   type='hidden' name='item_master_id"+ counter +"' id='item_master_id"+ counter +"' value="+id+"><input type='hidden' name='new_column[]' id='new_column[]'></td>";
                  cols += "<td>"+<?php echo $j; ?>+"</td>";
				  cols += "<td>"+item_name+"</td>";
                  cols += "<td>"
                          +"<input type='number' class='form-control text-center' value='0' data-rule='quantity' min='1' name='qty"+ counter +"' id='qty"+ counter +"' >"
                        +"</td>";
                  cols +=  "<td><span id='price'>"+data[0].sales_price
                              +"<input type='hidden' name='price"+ counter +"' id='price"+ counter +"' value='"+data[0].sales_price 
                            +"' readonly >"
                            +"</span></td>";
                  cols += "<td>"+data[0].unit_long_name+"</td>";
                  cols += "<td>"
                            +"<span id='sub_total'>"
                              +"<input type='text' class='form-control text-right' style='' value='0.00' name='linetotal"+ counter +"' id='linetotal"+ counter +"' readonly>"
                            +"</span>"
                          +"</td>";	
				  cols += "<td><input type='text' id='hidden_discount"+ counter +"' name='hidden_discount"+ counter +"'></td>";	  
				  cols += "<td><input type='text' class='form-control text-right' id='product_total"+ counter +"' name='product_total"+ counter +"' readonly></td>";
				  
                  
                
                  cols += "</tr>";
                  counter++;

                  newRow.append(cols);
                  $("table.product_table").append(newRow);
                  var table_data = JSON.stringify(product_data);
				  //alert(product_data);
                  $('#table_data').val(table_data);
				  
                  i++;
                }
                else{
                  //$('#err_product').text('Product Already Added').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
                }
           //var quantity = $('input[name^="quantity"]').val();
           //var price = $('input[name^="price"]').val();
            },
              error: function(xhr, status, error) {
                  $('#err_product').text('Enter Product Code / Name').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
              }
        });
      //}
    });

    $("table.product_table").on("click", "a.deleteRow", function (event) {
        deleteRow($(this).closest("tr"));
        $(this).closest("tr").remove();
		calculateRow($(this).closest("tr"));
        calculateGrandTotal();
    });

    function deleteRow(row){
      var id = +row.find('input[name^="id"]').val();
	   //alert(id);
      var array_id = product_data[id].item_master_id;//alert(array_id);
      //product_data.splice(id, 1);
      product_data[id] = null;
      //alert(product_data);
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
	  //alert($('#table_data').val());
    }
	
// delete for alredy exist rows	
	
	    $("table.product_table").on("click", "a.deleteRow1", function (event) {
		
        var curr_id=deleteRow1($(this).closest("tr"));
		//alert(curr_id);
        $(this).closest("tr").remove();
		calculateRow($(this).closest("tr"));
		//updateRow1(curr_id,$(this).closest("tr").next("tr"));
        //calculateGrandTotal();
    });

    function deleteRow1(row){
	
      var id = +row.find('input[name^="id"]').val();
	  //alert(id);
	  id=parseInt(id)+parseInt(1);
		var curr_id		=	row.find('input[name^="item_master_id"]').attr("name").slice(14);
		
		var new_column	=	document.getElementsByName("new_column[]");
		var count		=	new_column.length;
		//alert(row.find('input[name^="item_master_id"]').val());
		var master		=	row.find('input[name^="item_master_id"]').attr("name").slice(0,14);
		
		var qt			=	row.find('input[name^="qty"]').attr("name").slice(0,3);//alert(qt);
		var prc			=	row.find('input[name^="price"]').attr("name").slice(0,5);
		var li_tot		=	row.find('input[name^="linetotal"]').attr("name").slice(0,9);
		var hi_disc		=	row.find('input[name^="hidden_discount"]').attr("name").slice(0,15);
		var pro_tot		=	row.find('input[name^="product_total"]').attr("name").slice(0,13);
		
		for(var k=id;k<count;k++)
		{
			//alert(k);
			document.getElementById(master+(parseInt(curr_id)+parseInt(1))).setAttribute('name',master+curr_id);
			document.getElementById(qt+(parseInt(curr_id)+parseInt(1))).setAttribute('name',qt+curr_id);
			document.getElementById(prc+(parseInt(curr_id)+parseInt(1))).setAttribute('name',prc+curr_id);
			document.getElementById(li_tot+(parseInt(curr_id)+parseInt(1))).setAttribute('name',li_tot+curr_id);
			document.getElementById(hi_disc+(parseInt(curr_id)+parseInt(1))).setAttribute('name',hi_disc+curr_id);
			document.getElementById(pro_tot+(parseInt(curr_id)+parseInt(1))).setAttribute('name',pro_tot+curr_id);
			curr_id++;
		}

	   
	
      product_data[id] = null;
	  // alert('hjh');
      //alert(product_data);
      var table_data = JSON.stringify(product_data);
	 
      $('#table_data').val(table_data);
	  return curr_id;
	   
    }

    $("table.product_table").on("change",'input[name^="hidden_discount"], input[name^="price"], input[name^="qty"]', function (event) {
		 //alert('manoj');
		// var row = $(this).closest("tr");
     calculateRow($(this).closest("tr"));
	
     // calculateGrandTotal();
	 
     
 
 });
	
function calculateRow(row)
 {
						  var key = +row.find('input[name^="id"]').val();
						
						  var price = +row.find('input[name^="price"]').val();
						   
						  var qty = +row.find('input[name^="qty"]').val();
						  
						  var discount = +row.find('input[name^="hidden_discount"]').val();
		
		 
						  row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));
						  row.find('input[name^="product_total"]').val(((price * qty)-discount).toFixed(2));
						 var totalValue = 0;
					     var totalDiscount = 0;
					     var grandTotal = 0;
$("table.product_table").find('input[name^="linetotal"]').each(function () {
 totalValue += +$(this).val();
});
$("table.product_table").find('input[name^="hidden_discount"]').each(function () {
totalDiscount += +$(this).val();
});
$("table.product_table").find('input[name^="product_total"]').each(function () {
grandTotal += +$(this).val();
});
					 $('#totalValue').text(totalValue.toFixed(2));
					 $('#total_value').val(totalValue.toFixed(2));
					 $('#totalDiscount').text(totalDiscount.toFixed(2));
					 $('#total_discount').val(totalDiscount.toFixed(2));
					 $('#grandTotal').text(grandTotal.toFixed(2));
					 $('#grand_total').val(grandTotal.toFixed(2));
					 //alert(product_data[key].discount);
					  product_data[key].discount = discount;
					 //alert("asd");
					  product_data[key].quantity = qty;
					  product_data[key].total = (price * qty).toFixed(2);
					  product_data[key].net = ((price * qty)-discount).toFixed(2);
					  var table_data1 = JSON.stringify(product_data);
					  $('#table_data1').val(table_data1);
					  
		   //  var key = +row.find('input[name^="id"]').val();
		     //var price = +row.find('input[name^="price"]').val();
		    // var qty = +row.find('input[name^="qty"]').val();
		    // var discount = +row.find('input[name^="hidden_discount"]').val();
		  
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	/*function calculateRow(row) 
	{
		
      var key = +row.find('input[name^="id"]').val();
      var price = +row.find('input[name^="price"]').val();
	    
      var qty = +row.find('input[name^="qty"]').val();
	  
	    var discount = +row.find('input[name^="hidden_discount"]').val()
	 // alert(price);

      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));
      row.find('input[name^="product_total"]').val(((price * qty)-discount).toFixed(2));
       product_data[key].discount = discount;
	   product_data[key].quantity = qty;
       product_data[key].total = (price * qty).toFixed(2);
	   product_data[key].net = ((price * qty)-discount).toFixed(2);
       var table_data = JSON.stringify(product_data);
       $('#table_data').val(table_data);
      alert('hvhjvj');
    }
	
	
 function calculateGrandTotal()
  {
alert('jbkbk');
      var totalValue = 0;
      var totalDiscount = 0;
     // var grandTax = 0;
      var grandTotal = 0;
      $("table.product_table").find('input[name^="linetotal"]').each(function () {
        totalValue += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_discount"]').each(function () {
        totalDiscount += +$(this).val();
      });
     // $("table.product_table").find('input[name^="hidden_tax"]').each(function () {
      //  grandTax += +$(this).val();
      //});
      $("table.product_table").find('input[name^="product_total"]').each(function () {
        grandTotal += +$(this).val();
      });
      $('#totalValue').text(totalValue.toFixed(2));
      $('#total_value').val(totalValue.toFixed(2));
      $('#totalDiscount').text(totalDiscount.toFixed(2));
      $('#total_discount').val(totalDiscount.toFixed(2));
      //$('#totalTax').text(grandTax.toFixed(2));
      //$('#total_tax').val(grandTax.toFixed(2));
      $('#grandTotal').text(grandTotal.toFixed(2));
      $('#grand_total').val(grandTotal.toFixed(2));
    }*/	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
// function calculateGrandTotal()
 // {
//alert('bvbfkjb');
      //var totalValue = 0;
      //var totalDiscount = 0;
     // var grandTax = 0;
    //  var grandTotal = 0;
    //  $("table.product_table").find('input[name^="linetotal"]').each(function () {
      //  totalValue += +$(this).val();
     // });
      //$("table.product_table").find('input[name^="hidden_discount"]').each(function () {
      //    totalDiscount += +$(this).val();
		  //alert(totalDiscount);
      //});
     // $("table.product_table").find('input[name^="hidden_tax"]').each(function () {
      //  grandTax += +$(this).val();
      //});
     // $("table.product_table").find('input[name^="product_total"]').each(function () {
       // grandTotal += +$(this).val();
      //});
     // $('#totalValue').text(totalValue.toFixed(2));
     // $('#total_value').val(totalValue.toFixed(2));
     // $('#totalDiscount').text(totalDiscount.toFixed(2));
     // $('#total_discount').val(totalDiscount.toFixed(2));
      //$('#totalTax').text(grandTax.toFixed(2));
      //$('#total_tax').val(grandTax.toFixed(2));
    //  $('#grandTotal').text(grandTotal.toFixed(2));
    ////  $('#grand_total').val(grandTotal.toFixed(2));
  //  }	
	
	//modification///////
/*	$("table.product_table").on("change",'#hidden_discount',function (event) {*/
    
	
	/*});*/
	
	 //$("table.product_table").on("change",'input[name^="price"], input[name^="qty"]',function(event){
	//alert('dkfkdls');
    //var quant = parseFloat($('#qty').val()) || 0;
   // var iprice = parseFloat($('#price').val()) || 0;

    //$('#linetotal').val(quant * iprice);    
//});
	
	

   /* $("table.product_table").on("change",'#item_discount',function (event) {
      var row = $(this).closest("tr");
      var discount = +row.find('#item_discount').val();
      if(discount != ""){
        $.ajax({
          url: '<?php //echo base_url('Stock_management/getDiscountValue/') ?>'+discount,
          type: "GET",
          data:{
            '<?php //echo $this->security->get_csrf_token_name(); ?>' : '<?php //echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: JSON,
          success: function(value){
            data = JSON.parse(value);
            row.find('#discount_value').val(data[0].discount_value);
            calculateDiscountTax(row,data[0].discount_value);
            calculateGrandTotal();
          }
        });
      }
      else{
        row.find('#discount_value').val('0');
        calculateDiscountTax(row,0);
        calculateGrandTotal();
      }
    });
    $("table.product_table").on("change",'#item_tax',function (event) {
      var row = $(this).closest("tr");
      var tax = +row.find('#item_tax').val();
      if(tax != ""){
        $.ajax({
          url: '<?php ///echo base_url('Stock_management/getTaxValue/') //?>'+tax,
          type: "GET",
          data:{
            '<?php//echo $this->security->get_csrf_token_name(); ?>' : '<?php// echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: JSON,
          success: function(value){
            data = JSON.parse(value);
            row.find('#tax_value').val(data[0].purchase_tax_value);
            calculateDiscountTax(row,0,data[0].purchase_tax_value);
            calculateGrandTotal();
          }
        });
      }
      else{
        row.find('#tax_value').val('0');
        calculateDiscountTax(row,0,0);
        calculateGrandTotal();
      }
    });
    function calculateDiscountTax(row,data = 0,data1 = 0){
      var discount;
      var tax;
      if(data == 0 ){
        discount = +row.find('#discount_value').val();
      }
      else{
        discount = data;
      }
      if(data1 == 0 ){
        tax = +row.find('#tax_value').val();
      }
      else{
        tax = data1;
      }
      var sales_total = +row.find('input[name^="linetotal"]').val();
      var total_discount = sales_total*discount/100;
      var taxable_value = sales_total - total_discount;
      row.find('#taxable_value').text(taxable_value);
      var total_tax = taxable_value*tax/100;
      row.find('#product_total').val(taxable_value + total_tax);

      row.find('#hidden_discount').val(total_discount);
      row.find('#hidden_tax').val(total_tax);

      var key = +row.find('input[name^="id"]').val();
      product_data[key].discount = total_discount;
      product_data[key].discount_value = +row.find('#discount_value').val();
      product_data[key].discount_id = +row.find('#item_discount').val();
      product_data[key].tax = total_tax;
      product_data[key].tax_value = +row.find('#tax_value').val();
      product_data[key].tax_id = +row.find('#item_tax').val();
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }
    function calculateRow(row) {
      var key = +row.find('input[name^="id"]').val();
      var price = +row.find('input[name^="price"]').val();
      var qty = +row.find('input[name^="qty"]').val();
      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));

      product_data[key].quantity = qty;
      product_data[key].total = (price * qty).toFixed(2);
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }
    
     function calculateGrandTotal() {
      var totalValue = 0;
      var totalDiscount = 0;
      var grandTax = 0;
      var grandTotal = 0;
      $("table.product_table").find('input[name^="linetotal"]').each(function () {
        totalValue += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_discount"]').each(function () {
        totalDiscount += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_tax"]').each(function () {
        grandTax += +$(this).val();
      });
      $("table.product_table").find('input[name^="product_total"]').each(function () {
        grandTotal += +$(this).val();
      });
      $('#totalValue').text(totalValue);
      $('#total_value').val(totalValue);
      $('#totalDiscount').text(totalDiscount.toFixed(2));
      $('#total_discount').val(totalDiscount.toFixed(2));
      $('#totalTax').text(grandTax.toFixed(2));
      $('#total_tax').val(grandTax.toFixed(2));
      $('#grandTotal').text(grandTotal.toFixed(2));
      $('#grand_total').val(grandTotal.toFixed(2));
    }
});*/

//<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
 <script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php/admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector').html(response);
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
















</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="Updated")
{
echo "<script>toastr.success('". "PurchaseStock updated successfully...', 'Inserted', {timeOut: 5000})</script>";
}
else if($action=="Duplicate")
{
echo "<script>toastr.error('". "The name already exists...', 'Duplicate', {timeOut: 5000})</script>";
}
?>
