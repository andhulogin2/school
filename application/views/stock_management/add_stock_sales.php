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
							<li class="active">New Stock Item Master</li>
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
									 Stock Item  Sales
								
							</h1>
                             <div align="right" style="padding-right:100px"> 
                             
                                   </div> 
						</div><!-- /.page-header -->
 			
                              <div align="right"><a href="<?php echo base_url();?>index.php/stock_management/view_sales/" data-dismiss="fileinput"><b><button class="btn-info">Back</button></b></a> </div>
		<?php echo form_open('Stock_management/addSales', array('class' => 'form-horizontal'));?>				
		
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
                                 <select id="branch_id" name="branch_id" class="select2" onChange="return get_dept(this.value);" required >
                                        	<option value="">Select</option>
                                            <?php 
											foreach($branch as $bran):
											?>
                                            <option value="<?php echo $bran['branch_id']; ?>"><?php echo $bran['branch_name']; ?></option>
                                            <?php
											endforeach;
											?>
                                        </select>
                                 </div>
                                 </div>
                              <?php
									}
									?>
                                  <?php  if($role == 1 || $role == 2)
                                
								{?>
   <div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
  	<div class="col-sm-3">
 <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
 <option value="">Select</option>
                              </select>
    </div> 
</div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
    <div class="col-sm-7">
        <select name="class" id="class" class="select2" required="" onChange="return get_class_sections(this.value)">
                                     <option value="">Select</option>
                          </select>
    </div> 
</div>

<?php }?>


	

 <?php if($this->session->userdata('role')==3 || $this->session->userdata('role')==4)
{?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Department <font color="#FF0000">* </font></label>
   	<div class="col-sm-3">
        <select name="department" class="select2" id="department" onChange="return get_class(this.value)">
            <option value="">Select</option>
            
                              <?php 
							
							  foreach ($dept as $dept1)
							  {
							  ?><option value="<?php echo $dept1['dept_id'];?>"><?php echo $dept1['dept_name'];?></option>
                              <?php }?>
                             
                             
                              
                          </select>
    </div> 
</div>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
   	<div class="col-sm-7">
        <select name="class" id="class" class="select2" required="" onChange="return get_class_sections(this.value)">
                 <option value="">Select</option>
                     </select>
    </div> 
</div>

<?php }?>

 <?php if($this->session->userdata('role')>4)
{?>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class <font color="#FF0000">* </font></label>
   	<div class="col-sm-3">
       <select  name="class"  onchange="get_class_sections(this.value)" id="class" class="select2">
				<option value="">Select</option>
                <?php 
									 
									 foreach($class as $data){?>
                                      <option value="<?php echo $data['class_id']?>"><?php echo $data['name']?></option>
                                       <?php } ?>
				
			</select>
    </div> 
</div>
<?php } ?>

<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section <font color="#FF0000">* </font></label>
  	<div class="col-sm-3">
        <select name="section" onChange="get_details()"  class="select2" id="section_selector" required>
            <option value="">Select</option>
        </select>
    </div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Student <font color="#FF0000">* </font></label>
   	<div class="col-sm-7">
        <select name="student_id" id="payment" onChange="get_receipt()" class="select2" required="">
                 <option value="">Select</option>
                     </select>
    </div> 
</div>
                           
                          <div class="form-group">
<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Receipt Number <font color="#FF0000">* </font></label>
<div class="col-sm-7">
<input type="text" class="select2" name="txtreceipt_number" id="txtreceipt_number" />
</div> 
</div> 
                           

                             <div class="space-2"></div>
                            <div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="date">Date<font color="#FF0000">*</font>:</label>
									<div class="col-sm-2">
									<div class="clearfix">
									<div class="input-group input-group-sm">
									<input type="text" id="date" name="date" value="<?php echo date("Y-m-d");  ?>" class="form-control mydatepicker"  />
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
									<label class="col-sm-3 control-label no-padding-right" for="product"></label>
									<div class="col-sm-3">
								    <select class="select2" id="product" name="product" required>	
									 <option value="0">Select Product</option>
		                         <?php 
											foreach($product as $item):
											?>
                                            <option value="<?php echo $item['item_master_id']; ?>"><?php echo $item['item_name']; ?></option>
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
                          <th style="width: 20px;" title="delete"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
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
                        
                      </tbody>
                    </table>
                    </div>
                    <input type="hidden" name="total_value" id="total_value">
                    <input type="hidden" name="total_discount" id="total_discount">
                   
                    <input type="hidden" name="grand_total" id="grand_total">
                    <input type="hidden" name="table_data" id="table_data">
                    
                    
                    <table class="table table-striped table-bordered table-condensed table-hover">
                      <tr>
                        <td align="right" width="80%">Total Value</td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="totalValue">&nbsp;0.00</span></td>
                      </tr>
                      <tr>
                        <td align="right">Total Discount</td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?>
                          <span id="totalDiscount">&nbsp;0.00</span>
                        </td>
                      </tr>
                      
                      <tr>
                        <td align="right">Total</td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="grandTotal">&nbsp;0.00</span></td>
                      </tr>
                    </table>
                  </div>
                </div>
                
                
                </div>
               <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			        <div class="col-sm-9">
                    <button type="submit" id="submit" class="btn btn-info">Save</button>
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
</script>	 

<script>
  var i = 0;
  var j = 1;
    var product_data = new Array();
    var counter = 1;
 
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
                  var qunt=data[0].current_stock;
                 
				  //var newRow = "<table><tr><td>"+item_name+"</td></tr></table>";
				 // document.getElementById("datas").innerHTML = newRow;
                var product = { "item_master_id" : id,
                                  "sales_price" :price
                                };
                 
//alert(product['item_master_id']); 

                 product_data[i] = product;
                 length = product_data.length - 1 ;
                  
              var select_discount = "";
             //   select_discount += '<div class="form-group">';
				// select_discount += '<div class="col-sm-9">';
                 // select_discount += '<class="form-control selectboxit" id="item_discount" name="item_discount" >';
                
                  //select_discount += '</div></div>';

               
 
                  var newRow = $("<tr>");
                  var cols = "";
                  cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin1.png'/> </a><input type='hidden' name='id' name='id' value="+i+"><input   type='hidden' name='item_master_id' name='item_master_id' value="+id+"></td>";
                  cols += "<td>"+j+"</td>";
				  cols += "<td>"+item_name+"</td>";
                  cols += "<td>"
                          +"<input type='number' class='form-control text-center' value='0' data-rule='quantity' min='1' max='"+data[0].current_stock+"' name='qty"+ counter +"' id='qty"+ counter +"' >"
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
				  cols += '<td><input type="text" id="hidden_discount" name="hidden_discount">'+select_discount+'</td>';	  
				  cols += '<td><input type="text" class="form-control text-right" id="product_total" name="product_total" readonly></td>';
				  
                  
                
                  cols += "</tr>";
                  counter++;

                  newRow.append(cols);
                  $("table.product_table").append(newRow);
                  var table_data = JSON.stringify(product_data);
                  $('#table_data').val(table_data);
                  i++;
				  j++;
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
        calculateGrandTotal();
    });

    function deleteRow(row){
      var id = +row.find('input[name^="id"]').val();
      var array_id = product_data[id].item_master_id;
      //product_data.splice(id, 1);
      product_data[id] = null;
      //alert(product_data);
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }

    $("table.product_table").on("change",'input[name^="hidden_discount"], input[name^="price"], input[name^="qty"]', function (event) {
	//alert('bvbfkjb');
		 // var row = $(this).closest("tr");
      calculateRow($(this).closest("tr"));
	 
	 //alert(discount);
		
     // calculateDiscountTax($(this).closest("tr"));
       calculateGrandTotal();
	   
      if(discount != ""){
	  //  alert('bfjnk');
	     calculateRow($(this).closest("tr"));
	       calculateGrandTotal(row); 
		  // calculateDiscount(row);
          
          }
      else{
	 // alert('bfjnk');
        row.find('#hidden_discount').val('0');
        calculateRow($(this).closest("tr"));
		//calculateDiscount(row,0);
        calculateGrandTotal();
      }

//alert('price');
//var sales_total = +row.find('input[name^="price"]').val();
 //var priceq= +row.find('#price').val();
//var quant = +row.find('#quant').val();
	//var quant = parseFloat($('#qty1').val()) || 0;
   // var iprice = parseFloat($('#price1').val()) || 0;
	//$('#linetotal1').val(quant * iprice); 
		//alert(iprice);
 
 });
	
function calculateRow(row) {
	
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
    }
	
	
 function calculateGrandTotal() {

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
    }	
	
	</script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
 function get_details(){
	 jQuery('#payment').html("");
        var classid = $('#class').val();
		
        var section = $('#section_selector').val();
		//alert(section);
		console.log(section);

		if(section == "0"){
			return false;
		}
       $.ajax({
	    url: '<?php echo base_url();?>index.php/Stock_management/student_payment_details/' + classid + '/' + section  ,
            success: function(response)
            {
				console.log(response);
                jQuery('#payment').html(response);
				document.getElementById("class_selector").disabled = true;
				document.getElementById("section_selector").disabled = true;
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
 function get_receipt() 
	{
	branch_id=document.getElementById('branch_id').value;
	
    	$.ajax({
            url: '<?php echo base_url();?>index.php/stock_management/get_receipt/' + branch_id ,
            success: function(response)
            {
                jQuery('#txtreceipt_number').val(response);
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
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<?php
$action = $this->session->flashdata('action');
if ($action=="Inserted")
{
echo "<script>toastr.success('". "SalesStock name inserted successfully...', 'Inserted', {timeOut: 5000})</script>";
}

?>


<script src="<?php echo base_url(); ?>assets/js/select2.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.css" />
<script type="text/javascript">

$('.select2').css('width','250px').select2({allowClear:true})
				$('#select2-multiple-style .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					if(which == 2) $('.select2').addClass('tag-input-style');
					 else $('.select2').removeClass('tag-input-style');
				});                                  
 </script>              
