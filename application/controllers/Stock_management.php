<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_management extends CI_Controller {


// stock item category

	function view_stock_item_category()
	{
			$data['log']	=	 $this->Stock_management_model->get_stock_item_category();
			$this->load->view('stock_management/view_stock_item_category.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_maker(); 
		//$this->load->view('transport_management/view_vehicle_maker.php');
	}

	function add_stock_item_category() 
    {
        $this->load->view('stock_management/add_stock_item_category.php');
		
    }

	function stock_item_category_add() 
    {
		$category_name		=	$this->input->post('category_name');
		
		$stock_item_category 			=  	$this->Stock_management_model->stock_item_category_insert($category_name);
		
		if($stock_item_category>0)
		{
			$action = "Inserted";
		}
		else
		{
			$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('stock_management/view_stock_item_category/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	function stock_item_category_edit($category_id	='',$category_name='')
	{
	
	
		$data['category_id']	=	$category_id; 
		$data['category_name']	=	$category_name; 
		$this->load->view('stock_management/edit_stock_item_category.php',$data);
	}
	
				function stock_item_category_update($category_id)
				{
					
					$data	=	array(
								'category_name' => $this->input->post('category_name')
											
								);
								$num_rows_updated = $this->Stock_management_model->stock_item_category_update($data,$category_id);
								if($num_rows_updated > 0)
								{
								$action = "Updated";
								}
								else
								{
								$action = "Not updated";
								}
								$this->session->set_flashdata('action',$action);
								//$this->view_vehicle_maker();
								redirect('stock_management/view_stock_item_category/');
								
				}
				
					function stock_item_category_delete($category_id)
					{
						
						$num_rows_affected = $this->Stock_management_model->stock_item_category_delete($category_id);
						if($num_rows_affected > 0)
						{
						$action = "Deleted";
						}
						else
						{
						$action = "Failed";
						}
						$this->session->set_flashdata('action',$action);
						$this->view_stock_item_category();
					}
					
	// stock item sub category

	function view_stock_item_sub_category()
	{
			$data['result']	=	 $this->Stock_management_model->get_stock_item_sub_category();
			$this->load->view('stock_management/view_stock_item_sub_category.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_maker(); 
		//$this->load->view('transport_management/view_vehicle_maker.php');
	}

	function add_stock_item_sub_category() 
    {
      $data['category']	=$this->Stock_management_model->get_category();
	
       $this->load->view('stock_management/add_stock_item_sub_category.php',$data);
		
    }

	function stock_item_sub_category_add() 
    {
	    $data['category_id']       =      $this->input->post('category_id');
		$data['sub_category_name']		=	$this->input->post('sub_category_name');
		
		$stock_item_sub_category 			=  	$this->Stock_management_model->stock_item_sub_category_insert($data);
		
		if($stock_item_sub_category > 0)
		{
			$action = "Inserted";
		}
		else
		{
			$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('stock_management/view_stock_item_sub_category/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	function stock_item_sub_category_edit($sub_category_id)
	{
	
	    $data['sub_category_id']= $sub_category_id;
		$data['category']	=$this->Stock_management_model->get_category();
	
	    $data['log']	=	 $this->Stock_management_model->get_subcategory_edit($sub_category_id);; 
		$this->load->view('stock_management/edit_stock_item_sub_category.php',$data);
	}
	
	function stock_item_sub_category_update($sub_category_id)
				{
					
					$data	=	array(
								'category_id' => $this->input->post('category_id'),
								'sub_category_name' => $this->input->post('sub_category_name'));
								$num_rows_updated = $this->Stock_management_model->stock_item_sub_category_update($data,$sub_category_id);
								if($num_rows_updated > 0)
								{
								$action = "Updated";
								}
								else
								{
								$action = "Not updated";
								}
								$this->session->set_flashdata('action',$action);
								//$this->view_vehicle_maker();
								redirect('stock_management/view_stock_item_sub_category/');
								
				}
				
					function stock_item_sub_category_delete($sub_category_id)
					{
						
						$num_rows_affected = $this->Stock_management_model->stock_item_sub_category_delete($sub_category_id);
						if($num_rows_affected > 0)
						{
						$action = "Deleted";
						}
						else
						{
						$action = "Failed";
						}
						$this->session->set_flashdata('action',$action);
						$this->view_stock_item_sub_category();
					}
	
	
	
	// stock item brand

	function view_stock_item_brand()
	{
			$data['log']	=	 $this->Stock_management_model->get_stock_item_brand();
			$this->load->view('stock_management/view_stock_item_brand.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_maker(); 
		//$this->load->view('transport_management/view_vehicle_maker.php');
	}

	function add_stock_item_brand() 
    {
        $this->load->view('stock_management/add_stock_item_brand.php');
		
    }

	function stock_item_brand_add() 
    {
		$brand_name		=	$this->input->post('brand_name');
		
		$stock_item_brand			=  	$this->Stock_management_model->stock_item_brand_insert($brand_name);
		
		if($stock_item_brand>0)
		{
			$action = "success";
		}
		else
		{
			$action = "duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('stock_management/view_stock_item_brand/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	function stock_item_brand_edit($brand_id	='',$brand_name='')
	{
	
	
		$data['brand_id']	=	$brand_id; 
		$data['brand_name']	=	$brand_name; 
		$this->load->view('stock_management/edit_stock_item_brand.php',$data);
	}
	
				function stock_item_brand_update($brand_id)
				{
					
					$data	=	array(
								'brand_name' => $this->input->post('brand_name'));
								$num_rows_updated = $this->Stock_management_model->stock_item_brand_update($data,$brand_id);
								if($num_rows_updated > 0)
								{
								$action = "Updated";
								}
								else
								{
								$action = "Not updated";
								}
								$this->session->set_flashdata('action',$action);
								//$this->view_vehicle_maker();
								redirect('stock_management/view_stock_item_brand/');
								
				}
				
					function stock_item_brand_delete($brand_id)
					{
						
						$num_rows_affected = $this->Stock_management_model->stock_item_brand_delete($brand_id);
						if($num_rows_affected > 0)
						{
						$action = "Deleted";
						}
						else
						{
						$action = "Failed";
						}
						$this->session->set_flashdata('action',$action);
						$this->view_stock_item_brand();
					}
			
					
	//unit measurement
	
	
	function view_stock_item_unit_measurement()
	{
			$data['log']	=	 $this->Stock_management_model->get_stock_item_unit_measurement();
			$this->load->view('stock_management/view_stock_item_unit_measurement.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_maker(); 
		//$this->load->view('transport_management/view_vehicle_maker.php');
	}

	function add_stock_item_unit_measurement() 
    {
        $this->load->view('stock_management/add_stock_item_unit_measurement.php');
		
    }

	function stock_item_unit_measurement_add() 
    {
		$data['unit_short_name']		=	$this->input->post('unit_short_name');
		$data['unit_long_name']       	=	 $this->input->post('unit_long_name');
		
		$stock_item_unit_measurement	=  	$this->Stock_management_model->stock_item_unit_measurement_insert($data);
		
		if($stock_item_unit_measurement>0)
		{
			$action = "success";
		}
		else
		{
			$action = "duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('stock_management/view_stock_item_unit_measurement/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	function stock_item_unit_measurement_edit($unit_of_measurement_id)
	{
	
		$data['unit_of_measurement_id']	=	$unit_of_measurement_id; 
		 $data['log']	=	 $this->Stock_management_model->get_unit_edit($unit_of_measurement_id);; 
		$this->load->view('stock_management/edit_stock_item_unit_measurement.php',$data);
	}
	
		function stock_item_unit_measurement_update($unit_id)
		{
			
			$data	=	array(
						'unit_short_name' => $this->input->post('unit_short_name'),
							'unit_long_name' => $this->input->post('unit_long_name'));
						$num_rows_updated = $this->Stock_management_model->stock_item_unit_measurement_update($data,$unit_id);
						if($num_rows_updated > 0)
						{
						$action = "Updated";
						}
						else
						{
						$action = "Not updated";
						}
						$this->session->set_flashdata('action',$action);
						//$this->view_vehicle_maker();
						redirect('stock_management/view_stock_item_unit_measurement/');
						
		}
				
		function stock_item_unit_measurement_delete($unit_of_measurement_id)
		{
			
			$num_rows_affected = $this->Stock_management_model->stock_item_unit_measurement_delete($unit_of_measurement_id);
			if($num_rows_affected > 0)
			{
			$action = "Deleted";
			}
			else
			{
			$action = "Failed";
			}
			$this->session->set_flashdata('action',$action);
			$this->view_stock_item_unit_measurement();
		}
	//stock item master
	
	
	
		function view_stock_item_master()
	{
			$data['result']	=	 $this->Stock_management_model->get_stock_master();
			$this->load->view('stock_management/view_stock_item_master.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_maker(); 
		//$this->load->view('transport_management/view_vehicle_maker.php');
	}

	function add_stock_item_master() 
    {
	 $data['branch']	=$this->Stock_management_model->get_branch();
      $data['category']	=$this->Stock_management_model->get_category();
	  $data['sub_category']	=$this->Stock_management_model->get_sub_category();
	   $data['brand']	=$this->Stock_management_model->get_brand_id();
	   $data['unit']	=$this->Stock_management_model->get_unit_of_measurement();
	   $data['year']	=$this->Stock_management_model->get_year();
		 
	
       $this->load->view('stock_management/add_stock_item_master.php',$data);
		
    }

	function stock_item_master_add() 
    {
	    $data['branch_id']                =      $this->input->post('branch_id');
		$data['category_id']		      =	$this->input->post('category_id');
		 $data['sub_category_id']         = $this->input->post('sub_category_id');
		$data['brand_id']		          =	$this->input->post('brand_id');
		 $data['unit_of_measurement_id']         =      $this->input->post('unit_of_measurement_id');
		 $data['item_name']               =      $this->input->post('item_name');
		$data['current_stock']		      =	$this->input->post('current_stock');
		 $data['sales_price']             =      $this->input->post('sales_price');
		$data['academic_year']		      =	$this->input->post('academic_year');
		
		$stock_item_master 			=  	$this->Stock_management_model->stock_item_master_insert($data);
		
		if($stock_item_master > 0)
		{
			$action = "Inserted";
		}
		else
		{
			$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('stock_management/view_stock_item_master/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	function stock_item_master_edit($item_master_id)
	{
	
	    $data['item_master_id']= $item_master_id;
		$data['category']	=$this->Stock_management_model->get_category();
		 $data['branch']	=$this->Stock_management_model->get_branch();
        $data['category']	=$this->Stock_management_model->get_category();
	    $data['sub_category']	=$this->Stock_management_model->get_sub_category();
	    $data['brand']	=$this->Stock_management_model->get_brand_id();
	    $data['unit']	=$this->Stock_management_model->get_unit_of_measurement();
		 $data['year']	=$this->Stock_management_model->get_year();
		 
	
	
	    $data['log']	=	 $this->Stock_management_model->get_stock_master_edit($item_master_id);; 
		$this->load->view('stock_management/edit_stock_item_master.php',$data);
	}
	
	function stock_item_master_update($item_master_id)
				{
					
					$data	=	array(
								'branch_id' => $this->input->post('branch_id'),
								'category_id' => $this->input->post('category_id'),
								'sub_category_id' => $this->input->post('sub_category_id'),
								'brand_id' => $this->input->post('brand_id'),
								'item_name' => $this->input->post('item_name'),
								'unit_of_measurement_id' => $this->input->post('unit_of_measurement_id'),
								'current_stock' => $this->input->post('current_stock'),
								'sales_price' => $this->input->post('sales_price'),
								'academic_year' => $this->input->post('academic_year'));
								$num_rows_updated = $this->Stock_management_model->stock_item_master_update($data,$item_master_id);
								if($num_rows_updated > 0)
								{
								$action = "Updated";
								}
								else
								{
								$action = "Not updated";
								}
								$this->session->set_flashdata('action',$action);
								//$this->view_vehicle_maker();
								redirect('stock_management/view_stock_item_master/');
								
				}
				
					function stock_item_master_delete($item_master_id)
					{
					
					
					 $item_master_id=$item_master_id;
                   $data=array('is_deleted' =>'Y','deleted_by' =>$this->session->userdata('login_user_id','user_id'),'deleted_date'=>date('Y-m-d'));
						
						$num_rows_affected = $this->Stock_management_model->stock_item_master_delete($item_master_id);
						if($num_rows_affected > 0)
						{
						$action = "Deleted";
						}
						else
						{
						$action = "Failed";
						}
						$this->session->set_flashdata('action',$action);
						$this->view_stock_item_master();
					}
	
	//-------------*******Purchase*********--------------------------------------------------------//
		
	/// 	call add purchase view to add purchase
	
	public function view_purchase()
	{

		// get all purchase record and display list
		$data['data'] = $this->Stock_management_model->getPurchase();
		//$data['master'] = $this->Stock_management_model->getMaster();
		
		$this->load->view('stock_management/purchase_list',$data);
	} 
	
		public function view_purchase_details($id="")
	{

		// get all purchase record and display list
		$data['data'] = $this->Stock_management_model->getPurchase_details($id);
		 //echo "<pre>";
		//print_r($data);
		//echo "</pre>";

		//die();
	$data['master'] = $this->Stock_management_model->getMaster($id);
		
		$this->load->view('stock_management/view_stock_purchase',$data);
	} 
	
	
	public function add()
	{
	 $data['branch']	=$this->Stock_management_model->get_branch();
	    // $data['branch']	=$this->Stock_management_model->get_branch();
		$data['product'] = $this->Stock_management_model->get_items();
		$this->load->view('stock_management/add_stock_purchase',$data);

	}
	
	
		/* 
		this function is used when product add in purchase table 
	*/
	public function getProductAjax($id='')
	{
	$data = $this->Stock_management_model->getProductAjax($id);
	
		//$data['discount'] = $this->purchase_model->getDiscount();
		//$data['tax'] = $this->purchase_model->getTax();
					//echo "<pre>";
					//print_r($data);
					//echo "</pre>";
					//die();
	    echo json_encode($data);
		
		
	}
	//get Discount value for AJAX 
	
	public function getDiscountValue($id){
		$data = $this->Stock_management_model->getDiscountValue($id);
		echo json_encode($data);
	}
	
	
	
	
	
	/* 
		This function is used to search product code / name in database 
	*/
	/*public function getAutoCodeName($code,$search_option){
          //$code = strtolower($code);
		  $p_code = $this->input->post('p_code');
		  $p_search_option = $this->input->post('p_search_option');
          $data = $this->purchase_model->getProductCodeName($p_code,$p_search_option);
          if($search_option=="Code"){
          	$list = "<ul class='auto-product'>";
          	foreach ($data as $val){
          		$list .= "<li value=".$val->code.">".$val->code."</li>";
          	}
          	$list .= "</ul>";
          }
          else{
          	$list = "<ul class='auto-product'>";
          	foreach ($data as $val){
          		$list .= "<li value=".$val->product_id.">".$val->name."</li>";
          	}
          	$list .= "</ul>";
          }
          
          echo $list;
          //echo json_encode($data);
          //print_r($list);
	}*/
	
	
	 
		//*This function is used to add purchase in database 
	
	public function addPurchase(){
	$data['branch']	=$this->Stock_management_model->get_branch();
	
	
		//$this->form_validation->set_rules('date','Date','trim|required');
		//$this->form_validation->set_rules('reference_no','Reference No','trim|required');
		//$this->form_validation->set_rules('supplier_id','Supplier ID','trim|required');
		//$this->form_validation->set_rules('warehouse_id','Warehouse ID','trim|required');
		//if($this->form_validation->run()==false){

			//$this->add();
		//}
		//else
		//{
			//$warehouse_id = $this->input->post('warehouse');
			 $this->db->trans_begin();
			$data = array(
						"purchase_date" 			=> 	date('Y-m-d',strtotime($this->input->post('date'))),
						"purchase_invoice_number"	=>	$this->input->post('purchase_invoice_number'),
						"item_master_id" 	        =>	$this->input->post('item_master_id'),
						"invoice_amount" 	        =>	$this->input->post('total_value'),
						"discount_received" 		=>	$this->input->post('total_discount'),
						"net_amount"                =>  $this->input->post('grand_total'),
						"branch_id"	                =>	$this->input->post('branch_id')
						);
						//}	
				$purchase_master_id =   $this->Stock_management_model->stock_purchase_master_insert($data);
							
				
				$purchase_item_data = $this->input->post('table_data');
				$js_data = json_decode($purchase_item_data);
			 	foreach ($js_data as $key => $value) {
					if($value==null){
					}
					else{
					
						$data1 = array(
						                
										"purchase_master_id"			=> $purchase_master_id,
									   "item_master_id" 			    =>  $value->item_master_id,
										"purchase_quantity"	            =>	$value->quantity,
										"purchase_rate" 		        =>$value->sales_price,
										"purchase_price"                =>  $value->total,
										"discount_received"             =>  $value->discount,
										"net_amount"                    =>  $value->net
						
										);
						$id =   $this->Stock_management_model->stock_purchase_insert($data1); 
						$result= $this->Stock_management_model->stock_item_master_update1($data1); 
						
						
					}
					
					}
					
	$this->db->trans_complete();
		  if ($this->db->trans_status() === FALSE) 
		  {
		  	$this->db->trans_rollback();
        	$action="Duplicate";
          } 
		else {
            //if everything went right, commit the data to the database
            $this->db->trans_commit();
            $action="Inserted";
              }
				//echo $id;
				//die(); 
	$this->session->set_flashdata('action',$action);
	redirect('stock_management/view_purchase');
				
						
}

//*************** SALES**************//




// get all sales to display list
  public function view_sales()
    {
		
		$data['data'] = $this->Stock_management_model->getSales();
		$this->load->view('stock_management/sales_list',$data);
	} 
	
		public function view_stock_details($id="")
	{

		// get all purchase record and display list
		$data['data'] = $this->Stock_management_model->getSales_details($id);
		 //echo "<pre>";
		//print_r($data);
		//echo "</pre>";

		//die();
	  $data['master'] = $this->Stock_management_model->getMaster_stud($id);
		
		$this->load->view('stock_management/view_stock_sales',$data);
	} 




						
 function sales_add()
	{
	    $data['branch']	=$this->Stock_management_model->get_branch();
		$data['product'] = $this->Stock_management_model->get_items();
		$data['student'] = $this->Stock_management_model->get_student();
		if($this->session->userdata('role') >2)
		{
		
		$branch=$this->session->userdata('branch_id');
		
		$data['dept'] = $this->Stock_management_model->get_department_by_branch($branch);
		}
		$this->load->view('stock_management/add_stock_sales',$data);

	}
	//for getting student details
	function student_payment_details($class_id, $section_id)
	  {
		$details			=	$this->Fee_management_model->special_fee_students($class_id,$section_id);
		//$data['student']	=	$details;
		//$data['class_id']	=	$class_id;
		//$data['batch']		=	$section_id;
		echo '<option value="">Select</option>';
		foreach ($details as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'] . '</option>';
		}
	
	  }
	
	 function get_receipt($branch_id) 
	 {
	 //echo $branch_id;
	 echo get_receipt_number("Receipt",$branch_id)+1;
	 }
	
	
	public function addSales()
		{
		
		$receipt_number= $this->input->post('txtreceipt_number');
		$branch_id = $this->input->post('branch_id');	
		$data = array('voucher_number' => $receipt_number );
	 	$this->db->where('voucher_type_name', "Receipt");
	 	$this->db->where('branch_id', $branch_id);
		$this->db->update('tbl_voucher', $data); 
		$this->db->trans_begin();
		$data = array(
						"sales_date" 			 => $this->input->post('date'),
						"branch_id"	             =>	$this->input->post('branch_id'),
						"student_id" 	         =>	$this->input->post('student_id'),
						"bill_number" 	         =>	$this->input->post('txtreceipt_number'),
						"bill_amount"            =>  $this->input->post('total_value'),
						"discount_allowed" 		 =>	$this->input->post('total_discount'),
						"net_amount"             =>  $this->input->post('grand_total')
						);
				$sales_master_id =   $this->Stock_management_model->stock_sales_master_insert($data);
							
				
				$purchase_item_data = $this->input->post('table_data');
				$js_data = json_decode($purchase_item_data);
				//echo "<pre>";	
				//print_r($js_data);
				//die();
			    //echo "</pre>";
			 	foreach ($js_data as $key => $value) {
					if($value==null){
					}
					else{
					
						$data1 = array(
						"sales_master_id"                 => $sales_master_id,
					   "item_master_id" 			       =>  $value->item_master_id,
						"sales_quantity"	               =>	$value->quantity,
						"unit_rate" 		               =>  $value->sales_price,
						"sales_amount"                     =>  $value->total,
						"discount_allowed"                 =>  $value->discount,
						"net_amount"                       =>  $value->net
						
						);
						$id =   $this->Stock_management_model->stock_sales_insert($data1); 
				      $result= $this->Stock_management_model->stock_item_master_update2($data1); 
					}
						
					}
				
				
				//echo $id;
				//die(); 
							$this->db->trans_complete();
						  if ($this->db->trans_status() === FALSE) 
							{
							$this->db->trans_rollback();
						
							  } else {
							//if everything went right, commit the data to the database
							  $this->db->trans_commit();
							  $action="Inserted";
							 }
		
				    $this->session->set_flashdata('action',$action);
					redirect('stock_management/sales_add');
				
						
         }

//**********delete purchase details**********
       /*     function stock_item_purchase_delete($id)
					{
				
					
                     $data=array('is_deleted' =>'Y','deleted_by' =>$this->session->userdata('login_user_id','user_id'),'deleted_date'=>date('Y-m-d'));
						
						$num_rows_affected = $this->Stock_management_model->stock_item_purchase_delete($id,$data);
						if($num_rows_affected > 0)
						{
						$action = "Deleted";
						}
						else
						{
						$action = "Failed";
						}
						$this->session->set_flashdata('action',$action);
						$this->view_purchase();
					}
	*/




/* 
		This function   is to edit purchase Details */
		
		
		public function edit_purchase($id)
		   {
		   
		   	
			$data['branch']	=$this->Stock_management_model->get_branch();
		// $data['branch']	=$this->Stock_management_model->get_branch();
			$data['product'] = $this->Stock_management_model->get_items();
			$data['items'] = $this->Stock_management_model->getPurchase_details($id);
			$data['master'] = $this->Stock_management_model->getMaster($id);
		   $this->load->view('stock_management/edit_stock_purchase_details',$data);
		   }

		
		
		
		
		
	
	public function edit_Purchase_list($id="")
	{
			//$js_data = json_decode($this->input->post('table_data'));
			

	             $i=0;
		      $cnt = $this->input->post('countr');  
				//echo $cnthg = $this->input->post('qty');die();
				
			    //$js_data = json_decode($purchase_item_data);
				//print_r($js_data );die();*/
				
	
	
		//echo $id;die();
		$this->db->trans_begin();
			$data = array(
						"purchase_date" 			  	     => $this->input->post('date'),
						"purchase_invoice_number"		     =>	$this->input->post('purchase_invoice_number'),
						"item_master_id" 	       		     =>	$this->input->post('item_master_id'),
						"invoice_amount" 	       		     =>	$this->input->post('total_value'),
						"discount_received" 		  	     =>	$this->input->post('total_discount'),
						"net_amount"              			 =>  $this->input->post('grand_total'),
						"branch_id"	            			 =>	$this->input->post('branch_id')
						);
						//}	
			//print_r($data);die();
			$purchase_master_id =   $this->Stock_management_model->stock_purchase_master_edit($data,$id);
			
            $num_rows_affected  =   $this->Stock_management_model->stock_purchase_stcok_edit($purchase_master_id);
			//echo $this->db->last_query();die();
  //  echo $num_rows_affected;die();
if($num_rows_affected > 0)
	{
			

			
					
				
			for($i=1;$i<=$cnt;$i++)
			  {
								$data2 = array(
								 "purchase_master_id"			  =>  $purchase_master_id,
							     "item_master_id" 			      =>  $this->input->post('item_master_id'.$i),
								 "purchase_quantity"	          =>  $this->input->post('qty'.$i),
								 "purchase_rate" 		          => $this->input->post('price'.$i),
								 "purchase_price"                 => $this->input->post('linetotal'.$i),
								 "discount_received"              =>  $this->input->post('hidden_discount'.$i),
								 "net_amount"                     => $this->input->post('product_total'.$i)
								
								);
					if($this->input->post('item_master_id'.$i)!='' )
					{
						$id =   $this->Stock_management_model->stock_purchase_edit($data2); 
						
						$update= $this->Stock_management_model->stock_item_master_update3($data2);
					}
					
				 }
				
				   
	 }
				//echo $id;
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) 
					{
				$this->db->trans_rollback();
						
					} else {
							//if everything went right, commit the data to the database
					$this->db->trans_commit();
					$action="Updated";
							 }
				$this->session->set_flashdata('action',$action);
				redirect('stock_management/view_purchase');
			
			}
			
	//**************************************************************************************		
			public function edit_sales($id)
		   {
		   
			$data['branch']	=$this->Stock_management_model->get_branch();
		// $data['branch']	=$this->Stock_management_model->get_branch();
			$data['product'] = $this->Stock_management_model->get_items();
			//$data['pitem'] = $this->Stock_management_model->getProduct_qty(id);
			$data['items'] = $this->Stock_management_model->getSales_details($id);
			$data['master'] = $this->Stock_management_model->getMaster_sales($id);
			$data['stud'] = $this->Stock_management_model->get_student($id);
		   $this->load->view('stock_management/edit_stock_sales_details',$data);
		   }
	
		public function edit_sales_list($id="")
	{
			//$js_data = json_decode($this->input->post('table_data'));
			
	             $i=0;
		        $cnt = $this->input->post('countr');  
				//echo $cnthg = $this->input->post('qty');die();
				
			    //$js_data = json_decode($purchase_item_data);
				//print_r($js_data );die();*/
		       //echo $id;die();
		    $this->db->trans_begin();
			$data4 = array(
						"sales_date" 			 => $this->input->post('date'),
						"branch_id"	             =>	$this->input->post('branch_id'),
						//"student_id" 	        =>	$this->input->post('student_id'),
						"bill_amount"               =>  $this->input->post('total_value'),
						"discount_allowed" 		    =>	$this->input->post('total_discount'),
						"net_amount"               =>  $this->input->post('grand_total')
					  
						);
						//}	
			//print_r($data);die();
			$sales_master_id =   $this->Stock_management_model->stock_sales_master_edit($data4,$id);
			
            $num_rows_affected1  =   $this->Stock_management_model->stock_sales_stcok_edit($sales_master_id);
   //   echo $num_rows_affected;die();
if($num_rows_affected1 > 0)
	{
			for($i=1;$i<=$cnt;$i++)
			  {
								$data5 = array(
								 "sales_master_id"			  =>  $sales_master_id,
							     "item_master_id" 			      =>  $this->input->post('item_master_id'.$i),
								 "sales_quantity"	          =>  $this->input->post('qty'.$i),
								 "unit_rate" 		          => $this->input->post('price'.$i),
								 "sales_amount"                 => $this->input->post('linetotal'.$i),
								 "discount_allowed"              =>  $this->input->post('hidden_discount'.$i),
								 "net_amount"                     => $this->input->post('product_total'.$i)
								
								);
					    
				
				$id =   $this->Stock_management_model->stock__edit($data5); 
			
				$update= $this->Stock_management_model->stock_item_master_update4($data5);
				 }
				   
	 }
				//echo $id;
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) 
					{
				$this->db->trans_rollback();
						
					} else {
							//if everything went right, commit the data to the database
					$this->db->trans_commit();
					$action="Updated";
							 }
				$this->session->set_flashdata('action',$action);
				redirect('stock_management/view_sales');
			
			}	
			
			
			
			
			
			
		/*
		generate pdf for purchase list
	*/
			public function pdf_purchase($id)
			       {
						ob_start();
						$html 			=	ob_get_clean();
						$html 			= 	utf8_encode($html);
						$data1			=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
						$data['data'] = $this->Stock_management_model->getPurchase_details($id);
						$data['master'] = $this->Stock_management_model->getMaster($id);
						$html = $this->load->view('stock_management/pdf_stock_purchase_details',$data,true);
						include(APPPATH.'third_party/mpdf/mpdf.php');
						$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
						$mpdf->SetDisplayMode('fullpage');
						$mpdf->allow_charset_conversion 	= true;
						$mpdf->charset_in = 'UTF-8';
						$mpdf->WriteHTML($html);
						$mpdf->Output($data['data'][0]->reference_no.'pdf','I');	
	               }
				   
		
			
				/*
		generate pdf for Sales list
	*/
			public function pdf_sales($id)
			       {
						ob_start();
						$html 								=	ob_get_clean();
						$html 								= 	utf8_encode($html);
						$data1								=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
						$data['data'] = $this->Stock_management_model->getSales_details($id);
						$data['master'] = $this->Stock_management_model->getMaster_stud($id);
						$html = $this->load->view('stock_management/pdf_stock_sales_details',$data,true);
						include(APPPATH.'third_party/mpdf/mpdf.php');
						$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
						$mpdf->SetDisplayMode('fullpage');
						$mpdf->allow_charset_conversion 	= true;
						$mpdf->charset_in = 'UTF-8';
						$mpdf->WriteHTML($html);
						$mpdf->Output($data['data'][0]->reference_no.'pdf','I');	

	               }
///***************************************pdf of purchase/sales report******************************************************* 				   
				   
	public function pdf_purchase_report($purchase_master_id)
			       {
						ob_start();
						$html 								=	ob_get_clean();
						$html 								= 	utf8_encode($html);
						$data1								=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
                        $data['result']=$this->Stock_management_model->get_detail_report($purchase_master_id);
						$html = $this->load->view('stock_management/view_report_all_in_one_purchase_details_pdf',$data,true);
						include(APPPATH.'third_party/mpdf/mpdf.php');
						$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
						$mpdf->SetDisplayMode('fullpage');
						$mpdf->allow_charset_conversion 	= true;
						$mpdf->charset_in = 'UTF-8';
						$mpdf->WriteHTML($html);
						$mpdf->Output($data['data'][0]->reference_no.'pdf','I');	

	               }			   
				   
		public function pdf_sales_report($sales_master_id)
			       {
						ob_start();
						$html 								=	ob_get_clean();
						$html 								= 	utf8_encode($html);
						$data1								=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
                        $data['result']=$this->Stock_management_model->get_detail_reports($sales_master_id);
						//print_r($data['result']);die();
						$html = $this->load->view('stock_management/view_report_all_in_one_sales_details_pdf',$data,true);
						include(APPPATH.'third_party/mpdf/mpdf.php');
						$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
						$mpdf->SetDisplayMode('fullpage');
						$mpdf->allow_charset_conversion 	= true;
						$mpdf->charset_in = 'UTF-8';
						$mpdf->WriteHTML($html);
						$mpdf->Output($data['data'][0]->reference_no.'pdf','I');	
	               }			   
				   
               public function pdf_sales_report_item()
			       {
						ob_start();
						$html 								=	ob_get_clean();
						$html 								= 	utf8_encode($html);
						$data								=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
						$data1['result']=$this->Stock_management_model->get_item_details_sales($data);
						$html = $this->load->view('stock_management/view_report_all_in_one_sales_item_pdf',$data1,true);
						include(APPPATH.'third_party/mpdf/mpdf.php');
						$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
						$mpdf->SetDisplayMode('fullpage');
						$mpdf->allow_charset_conversion 	= true;
						$mpdf->charset_in = 'UTF-8';
						$mpdf->WriteHTML($html);
						$mpdf->Output($data['data'][0]->reference_no.'pdf','I');	
	               }			   
				   
	 public function pdf_purchase_report_item()
			       {
						ob_start();
						$html = ob_get_clean();
						$html = utf8_encode($html);
				         $data	=	$_SESSION["data1"];
						$data1['result']=$this->Stock_management_model->get_item_details($data);
						//print_r($data1['result']);die();
						$html = $this->load->view('stock_management/view_report_all_in_one_purchase_item_pdf',$data1,true);
				
						include(APPPATH.'third_party/mpdf/mpdf.php');
						$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
						$mpdf->allow_charset_conversion = true;
						$mpdf->charset_in = 'UTF-8';
						$mpdf->WriteHTML($html);
						$mpdf->Output($data['data'][0]->reference_no.'pdf','I');
	               }			   
				   
	
	
	
	
	
				   
//**********************************************************Report********************************************************************************************			   
	function view_inventory_all_in_one_report()
	{
		$role	=	$this->session->userdata('role');
		
			$this->load->view('stock_management/view_report_all_in_one');
		
		/*if($role == 3)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$data['bus']	=	$this->Transport_management_model->get_bus_by_branch($branch_id);
		}*/
		
	}
		
		function get_report_purchase($report_type='')
	    {
		$data['branch']		=	$this->Stock_management_model->get_branch();
		if($report_type == 'purchase_report')
		{
			$this->load->view('stock_management/view_report_all_in_one_purchase',$data);
		}
		if($report_type == 'sales_report')
		{
		
					$this->load->view('stock_management/view_report_all_in_one_sales',$data);
		}
		
	}
	
	function get_report()
	{
	
		$ids			=	json_decode($_POST['ids']);
		
		$data			=	array(
								'report_type'			=>	$ids->report_type,
								'branch_id'				=>	$ids->branch_id,
								'item_master_id'		=>	$ids->item_master_id,
								);
							//echo $data['report_type'];die();
 
		if($data['report_type'] == 'purchase_report')
		{

		if($data['item_master_id']!="")
		{
			$data['date_from']			     =	$ids->date_from;
			$data['date_to']			     =	$ids->date_to;
			$data['result']=$this->Stock_management_model->get_item_details($data);
			$this->load->view('stock_management/view_report_all_in_one_purchase_item',$data);
		}
		 else
		 {     
			$data['purchase_invoice_number'] = $ids->purchase_invoice_number;
			$data['date_from']			     =	$ids->date_from;
			$data['date_to']			     =	$ids->date_to;
			$data['result']					 =	$this->Stock_management_model->get_report($data);
			
			$this->load->view('stock_management/view_report_all_in_one_purchase1',$data);
			}
		}
		if($data['report_type'] == 'sales_report')
		{
					if($data['item_master_id']!="")
					{
						$data['department_id']		=	$ids->department_id;
						$data['class_id']			=	$ids->class_id;
						$data['section_id']			=	$ids->section_id;
						$data['student_id']			=	$ids->student_id;
						$data['date_from']		    =	$ids->date_from;
						$data['date_to']		    =	$ids->date_to;
						$data['result']=$this->Stock_management_model->get_item_details_sales($data);
						//print_r($data['result']);die();
						
						$this->load->view('stock_management/view_report_all_in_one_sales_item',$data);
					}
					else
					{
						$data['department_id']		=	$ids->department_id;
						$data['class_id']			=	$ids->class_id;
						$data['section_id']			=	$ids->section_id;
						$data['student_id']			=	$ids->student_id;
						$data['date_from']		    =	$ids->date_from;
						$data['date_to']		    =	$ids->date_to;
						$data['result']				=	$this->Stock_management_model->get_report($data);
						//print_r($data['result']);die();
						$this->load->view('stock_management/view_report_all_in_one_sales1',$data);
					}
		}
	}

/////////////// report details
 function view_purchase_report($purchase_master_id)
 {
// echo $purchase_master_id;
 $data['result']=$this->Stock_management_model->get_detail_report($purchase_master_id);
//echo "<pre>";
// print_r($data['result']);
//echo "</pre>";
//die();
 $this->load->view('stock_management/view_report_all_in_one_purchase_details',$data);
 }


function view_sales_report($sales_master_id)
 {
 $data['result']=$this->Stock_management_model->get_detail_reports($sales_master_id);
//echo "<pre>";
 //print_r($data['result']);
//echo "</pre>";
// die();
 $this->load->view('stock_management/view_report_all_in_one_sales_details',$data);
 }



	
    function get_invoice_by_branch($branch_id)
	   {
	
		$invoice	=	$this->Stock_management_model->get_invoice_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($invoice as $row) 
		{
		
			echo '<option value="' . $row['purchase_invoice_number'] . '">' . $row['purchase_invoice_number'].' </option>' ;
		}
	}

	 function get_item_by_branch($branch_id)
	{
		$item	=	$this->Stock_management_model->get_item_by_branch($branch_id);
		//echo $this->db->last_query();
		echo '<option value="">Select</option>';
		foreach ($item as $row) 
		{
    echo '<option value="' . $row['item_master_id'] . '">' . $row['item_name'].' </option>';
		}
	}

// function get_item_by_invoice($purchase_invoice_number)
	//{
	
	//echo "huhk";die();
		//$item	=	$this->Transport_management_model->get_item_by_invoice($purchase_invoice_number);
		//	echo '<option value="">Select</option>';
		//foreach ($item as $row) 
		//{
		
    //echo '<option value="' . $row['item_master_id'] . '">' . $row['item_name'].' </option>';
		//}
	//}//
	
	
	
	///////////////////////sales report
		function get_department_by_branch($branch_id='')
	{
		$department	=	$this->Stock_management_model->get_department_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($department as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'].'</option>';
		}
	}
	function get_class_by_branch($branch_id='')
	{
		$class1	=	$this->Stock_management_model->get_class_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($class1 as $row) 
		{
			echo '<option value="' . $row['class_id'] . '">' . $row['name'].'</option>';
		}
	}
	function get_section_by_branch($branch_id='')
	{
		$section	=	$this->Stock_management_model->get_section_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($section as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'].'('.$row['class_name'].')</option>';
		}
	}
	function get_student_by_branch($branch_id='')
	{
		$student	=	$this->Stock_management_model->get_student_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}

function get_class_by_department($department_id='')
	{
		
		$class	=	$this->Stock_management_model->get_class_by_dept($department_id);
		echo '<option value="">Select</option>';
		foreach ($class as $row) 
		{
			echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function get_section_by_department($department_id='')
	{
		
		$section	=	$this->Stock_management_model->get_section_by_department($department_id);
		echo '<option value="">Select</option>';
		foreach ($section as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'].'('.$row['class_name'].')</option>';
		}
	}
	function get_student_by_department($department_id='')
	{
		$student	=	$this->Stock_management_model->get_student_by_department($department_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_section_by_class($class_id='')
	{
		
		$section	=	$this->Stock_management_model->get_class_section($class_id);
		echo '<option value="">Select</option>';
		foreach ($section as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function get_student_by_class($class_id='')
	{
		
		$student	=	$this->Stock_management_model->get_student_by_class($class_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_student_by_section($section_id='')
	{
		$student	=	$this->Stock_management_model->get_student_by_section($section_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}	
	
////////////check duplicate invoice
function get_invoice($purchase_invoice_number='')
{


$result=$this->Stock_management_model->purchase_master_check($purchase_invoice_number);
if(count($result) > 0)
{
echo '<b> <p style="color:red;">Alredy Exist.</p></b> ';
echo '<script type="text/javascript">$( "#submit" ).prop( "disabled", true )</script>';
}
else
{
echo '<script type="text/javascript">$( "#submit" ).prop( "disabled", false )</script>';

}

}


	function delete_purchase_master($purchase_master_id='')
	{
		$result	=	$this->Stock_management_model->delete_purchase_master($purchase_master_id);
		if($result>0)
		{
			$action	=	"deleted";
		}
		else
		{
			$action	=	"not_deleted";
		}
		$this->session->set_flashdata('action',$action);
		redirect('stock_management/view_purchase');
	}
	
	function delete_sales_master($sales_master_id='')
	{
		$result	=	$this->Stock_management_model->delete_sales_master($sales_master_id);
		if($result>0)
		{
			$action	=	"deleted";
		}
		else
		{
			$action	=	"not_deleted";
		}
		$this->session->set_flashdata('action',$action);
		redirect('stock_management/view_sales');
	}
	
			
}			
			
	
			
	

	
