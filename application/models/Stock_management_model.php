<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_management_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function clear_cache() {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        return $this->db->get_where($type, array($type . '_id' => $type_id))->row()->$field;
    }

   /////////////////////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	//Stock category add
	
	
	function get_stock_item_category()
	{
		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_stock_item_category')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_stock_item_category')->result_array();
			return $query;
		}
	}
	
	
	function stock_item_category_insert($category_name)
	{
		$data['category_name']	=	$category_name;
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_item_category',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	
	function stock_item_category_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('category_id',$id);
	   $this->db->update('tbl_stock_item_category',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function stock_item_category_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('category_id',$id);
	   $this->db->delete('tbl_stock_item_category');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	
	//sub category
	
	
	function get_stock_item_sub_category()
	{
		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('view_stock_item_sub_category')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('view_stock_item_sub_category')->result_array();
			return $query;
		}
	}
	
	
	function stock_item_sub_category_insert($data)
	{
		//$data['category_name']	=	$category_name;
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_item_sub_category',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	
	function stock_item_sub_category_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('sub_category_id',$id);
	   $this->db->update('tbl_stock_item_sub_category',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function stock_item_sub_category_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('sub_category_id',$id);
	   $this->db->delete('tbl_stock_item_sub_category');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	
	function get_category()
	{
	return	$this->db->get('tbl_stock_item_category')->result_array();
	
	}
	function get_subcategory_edit($sub_category_id)                           ///used for editing
	{
	 $this->db->where('sub_category_id',$sub_category_id);
	  $query=$this->db->get('tbl_stock_item_sub_category')->result_array();
	  return $query;	
	
	}
	
	
	
	
	//stock brand
	
	function get_stock_item_brand()
	{
		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_stock_item_brand')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_stock_item_brand')->result_array();
			return $query;
		}
	}
	
	
	function stock_item_brand_insert($brand_name)
	{
		$data['brand_name']	=	$brand_name;
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_item_brand',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	
	function stock_item_brand_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('brand_id',$id);
	   $this->db->update('tbl_stock_item_brand',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function stock_item_brand_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('brand_id',$id);
	   $this->db->delete('tbl_stock_item_brand');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	
	//unit measurement
	
	
	function get_stock_item_unit_measurement()
	{
		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_stock_unit_of_measurement')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_stock_unit_of_measurement')->result_array();
			return $query;
		}
	}
	
	
	function stock_item_unit_measurement_insert($data)
	{
		//$data['category_name']	=	$category_name;
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_unit_of_measurement',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	
	function stock_item_unit_measurement_update($data,$unit_of_measurement_id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('unit_of_measurement_id',$unit_of_measurement_id);
	   $this->db->update('tbl_stock_unit_of_measurement',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function stock_item_unit_measurement_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('unit_of_measurement_id',$id);
	   $this->db->delete('tbl_stock_unit_of_measurement');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	
	
	function get_unit_edit($unit_of_measurement_id)                           ///used for editing
	{
	 $this->db->where('unit_of_measurement_id',$unit_of_measurement_id);
	  $query=$this->db->get('tbl_stock_unit_of_measurement')->result_array();
	  return $query;	
	
	}
	
	
	
	//stock item master
	
	function get_stock_master()
	{
		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('view_stock_item_master')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('view_stock_item_master')->result_array();
			return $query;
		}
	}
	
	
	function stock_item_master_insert($data)
	{
		//$data['category_name']	=	$category_name;
		$this->db->db_debug 		=	FALSE;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');
		$this->db->insert('tbl_stock_item_master',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	
	function stock_item_master_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('item_master_id',$id);
	   $this->db->update('tbl_stock_item_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function stock_item_master_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('item_master_id',$id);
	   $this->db->delete('tbl_stock_item_master');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	
	
	function get_stock_master_edit($item_master_id)                           ///used for editing
	{
	 $this->db->where('item_master_id',$item_master_id);
	  $query=$this->db->get('tbl_stock_item_master')->result_array();
	  return $query;	
	
	}
	
	
	
	function get_sub_category()
	{
	return	$this->db->get('tbl_stock_item_sub_category')->result_array();
	
	}
	
	
	
	function get_brand_id()
	{
	return	$this->db->get('tbl_stock_item_brand')->result_array();
	
	}
	
		
	function get_unit_of_measurement()
	{
	return	$this->db->get('tbl_stock_unit_of_measurement')->result_array();
	
	}
	
	function get_branch()
	{
	return	$this->db->get('tbl_branch')->result_array();
	
	}
	
	function get_year()
	{
//	$running_year = $this->session->userdata('running_year');
	$this->db->where('type','running_year');
	$this->db->select('description');
	return $this->db->get('settings')->result_array();
	}
	//////************************Purchase******************///
	
	public function get_items()
	{
	   $this->db->where('is_deleted','N');
		return $this->db->get('tbl_stock_item_master')->result_array();
		 
	}
	
	
	public function getProductAjax($id)
	{
	$this->db->where('item_master_id',$id);
	return $this->db->get('view_stock_item_master')->result_array();
		//$sql = "select * from tbl_stock_item_master where item_master_id = $id";
		//$data = $this->db->query($sql,array($id));
		//$query= $data->result_array();
		
	}
	public function getProduct_qty($id)
	{
	$this->db->where('item_master_id',$id);
	return $this->db->get('view_stock_item_master')->result_array();
		//$sql = "select * from tbl_stock_item_master where item_master_id = $id";
		//$data = $this->db->query($sql,array($id));
		//$query= $data->result_array();
		
	}
	
	public function getDiscountValue($id)
	{
		
	}
	
	function stock_purchase_master_insert($data)
	{
	// $this->db->trans_begin();
	    $data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_purchase_master',$data);
		return $this->db->insert_id();
	    $this->db->db_debug 		=	TRUE;
	
	}
	
	
	function stock_purchase_insert($data1)
	{
	 
		//$data1['item_master_id']=	$this->db->insert_id();
		//$data['created_by']			=		1;
		//$data['created_date']		=		date('Y/m/d');
		//$data1['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		//$data1['entered_date'] 		=	date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_purchase_details',$data1);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
		
	}
	// updating stock item master
	function stock_item_master_update1($data1)
	{
	    $id=$data1['item_master_id'];
	   $this->db->where('item_master_id',$id);
	   $query= $this->db->get('tbl_stock_item_master')->row();
	   if(isset($query))
	   {
	   $data['current_stock']=$query->current_stock;
	   }
	   $data['current_stock']= $data['current_stock']+$data1['purchase_quantity'];
	   $this->db->db_debug	=	FALSE;
	   $this->db->where('item_master_id',$id);
	   $this->db->update('tbl_stock_item_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
		
	}
	
	public function get_student()
	{
		return $this->db->get('student')->result_array();
		 
	}
	
	
	function get_student_fee_details($class_id='',$section='')
	{
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id',$section);
		$this->db->join('enroll', 'enroll.student_id = student.student_id');
		$this->db->select('student.student_id, student.name');
		$student_fee_details		=	$this->db->get('student')->result_array();
		return 	$student_fee_details;
	}
	function stock_sales_master_insert($data)
	{
	    $this->db->trans_begin();
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_sales_master',$data);
		 return $this->db->insert_id();
		   $this->db->db_debug 		=	TRUE;
	}
	
function stock_sales_insert($data1)
	{
		//$data1['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		//$data1['entered_date'] 		=	date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_stock_sales_details',$data1);
		$this->db->db_debug 		=	TRUE;
		 
	}
function stock_item_master_update2($data1)
	{
	    $id=$data1['item_master_id'];
	   $this->db->where('item_master_id',$id);
	   $query= $this->db->get('tbl_stock_item_master')->row();
	   if(isset($query))
	   {
	   $data['current_stock']=$query->current_stock;
	   }
	   $data['current_stock']= $data['current_stock'] - $data1['sales_quantity'];
	   $this->db->db_debug	=	FALSE;
	   $this->db->where('item_master_id',$id);
	   $this->db->update('tbl_stock_item_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
		
	}	
	
	
	
	
	public function getPurchase()
	{
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_stock_purchase_master')->result_array();
		 
	}
	public function getMaster($id)
	{
	  $this->db->where('purchase_master_id', $id);
	  	$this->db->where('is_deleted','N');
		return $this->db->get('tbl_stock_purchase_master')->result_array();  ///for displaying master contents
		 
	}
	public function getMaster_sales($id)
	{
	  $this->db->where('sales_master_id', $id);
	  	$this->db->where('is_deleted','N');
		return $this->db->get('tbl_stock_sales_master')->result_array();  ///for displaying master contents
		 
	}
	
	
	
	public function getPurchase_details($id)
	{
	 $this->db->where('purchase_master_id', $id);
      	$this->db->where('is_deleted','N');
    return $this->db->get('view_stock_purchase')->result_array();       //for displaying details
	
		 
	}
	
	function stock_item_purchase_delete($id,$data)
	{
	//print_r($id);
		//die();
	   $this->db->db_debug = FALSE; 
	   $this->db->where('purchase_master_id',$id);
      $this->db->update('tbl_stock_purchase_master',$data);
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	public function getSales()
	{
		$this->db->where('is_deleted','N');
		return $this->db->get('view_sales_master')->result_array();
		 
	}

//edit purchase details
    function stock_purchase_master_edit($data,$id)
	   {
	//echo $id;
	//die();
	// $this->db->trans_begin();
	    //$data['created_by']			=		1;
		//$data['created_date']		=		date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		 $this->db->where('purchase_master_id',$id);
		$this->db->Update('tbl_stock_purchase_master',$data);
	    $this->db->db_debug 		=	TRUE;
	   return $id;
	     //return $this->db->affected_rows(); 
	
	   }
	
  function stock_purchase_stcok_edit($purchase_master_id)
	     {
	  $this->db->where('purchase_master_id',$purchase_master_id);
		//$this->db->db_debug 		=	FALSE;
	
	 $query = $this->db->get('tbl_stock_purchase_details')->result_array();
		foreach($query as $row)
		{
	$query_string = "update tbl_stock_item_master set current_stock=current_stock -" .$row['purchase_quantity']." where item_master_id = ".$row['item_master_id'];
	$this->db->query($query_string);
	}
	
		$this->db->db_debug 		=	FALSE;
	     $this->db->where('purchase_master_id',$purchase_master_id);
		 $this->db->delete('tbl_stock_purchase_details');
		  $this->db->db_debug 		=	TRUE;
		  return $this->db->affected_rows(); 
		
		
	    }
	function stock_purchase_edit($data1)
	{
		
     $purchase_master_id=$data1['purchase_master_id'];
	 
		//$data1['item_master_id']=	$this->db->insert_id();
		//$data['created_by']			=		1;
		//$data['created_date']		=		date('Y/m/d');
		//$data1['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		//$data1['entered_date'] 		=	date('Y/m/d');
		//$this->db->db_debug 		=	FALSE;
	    $this->db->where('purchase_master_id',$purchase_master_id);
		$this->db->insert('tbl_stock_purchase_details',$data1);
		//$this->db->db_debug 		=	TRUE;
		//print_r($this->db->conn_id->error_list);
		
		
		return $this->db->insert_id();
		
	}

	
	
	
	
	
	
function stock_item_master_update3($data1)
	{
	    $id=$data1['item_master_id'];
	   $this->db->where('item_master_id',$id);
	   $query= $this->db->get('tbl_stock_item_master')->row();
	   if(isset($query))
	   {
	   $data['current_stock']=$query->current_stock;
	   }
	   $data['current_stock']= $data['current_stock']+$data1['purchase_quantity'];
	   $this->db->db_debug	=	FALSE;
	   $this->db->where('item_master_id',$id);
	   $this->db->update('tbl_stock_item_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
		
}
	
//**********************************************************************************************************************************	
	 function stock_sales_master_edit($data4,$id)
	   {
	//echo $id;
	//die();
	// $this->db->trans_begin();
	    //$data['created_by']			=		1;
		//$data['created_date']		=		date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		 $this->db->where('sales_master_id',$id);
		$this->db->Update('tbl_stock_sales_master',$data4);
	    $this->db->db_debug 		=	TRUE;
	   return $id;
	     //return $this->db->affected_rows(); 
	
	   }
	
function stock_sales_stcok_edit($sales_master_id)
	{
	  $this->db->where('sales_master_id',$sales_master_id);
		//$this->db->db_debug 		=	FALSE;
	
	 	$query = $this->db->get('tbl_stock_sales_details')->result_array();
			foreach($query as $row)
			{
		$query_string = "update tbl_stock_item_master set current_stock=current_stock -" .$row['sales_quantity']." where item_master_id = ".$row['item_master_id'];
	   	$this->db->query($query_string);
	     	}

			 $this->db->db_debug 		=	FALSE;
	    	 $this->db->where('sales_master_id',$sales_master_id);
		 	 $this->db->update('tbl_stock_sales_details');
		     $this->db->db_debug 		=	TRUE;
		     return $this->db->affected_rows(); 
	 }
		
function stock__edit($data5)
	   {
		
        $sales_master_id=$data5['sales_master_id'];
	 
		//$data1['item_master_id']=	$this->db->insert_id();
		//$data['created_by']			=		1;
		//$data['created_date']		=		date('Y/m/d');
		//$data1['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		//$data1['entered_date'] 		=	date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
	    $this->db->where('sales_master_id',$sales_master_id);
		$this->db->update('tbl_stock_sales_details',$data5);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
		
	}
function stock_item_master_update4($data5)
	{
	    $id=$data5['item_master_id'];
	   $this->db->where('item_master_id',$id);
	   $query= $this->db->get('tbl_stock_item_master')->row();
	   if(isset($query))
	   {
	   $data['current_stock']=$query->current_stock;
	   }
	   $data['current_stock']= $data['current_stock'] - $data5['sales_quantity'];
	   $this->db->db_debug	=	FALSE;
	   $this->db->where('item_master_id',$id);
	   $this->db->update('tbl_stock_item_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
		
	}	
	
	
	
	public function getSales_details($id)
	{
	 $this->db->where('sales_master_id', $id);
      	$this->db->where('is_deleted','N');
    return $this->db->get('view_stock_sales')->result_array();       //for displaying details
	}

	public function getMaster_stud($id)
	{
	  $this->db->where('sales_master_id', $id);
	  	$this->db->where('is_deleted','N');
		return $this->db->get('view_sales_student')->result_array();  ///for displaying master contents
		 
	}
	
function purchase_master_check($purchase_invoice_number)
	{
	
	 $this->db->where('purchase_invoice_number',$purchase_invoice_number);
	 $query= $this->db->get('tbl_stock_purchase_master')->result_array();
	 return $query;
	
	}

	
	
	
	
//##############################Reports############################################
	function get_invoice_by_branch($branch_id)
	{
	   $this->db->select('purchase_invoice_number');
	   //$this->db->select('purchase_master_id');
		$this->db->where('branch_id',$branch_id);
	return  $this->db->get('tbl_stock_purchase_master')->result_array();
		
	}


	function get_item_by_branch($branch_id)
	{
	   $this->db->select('item_master_id,item_name');
	   //$this->db->select('route_master_name');
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('tbl_stock_item_master')->result_array();
	}

 function get_item_by_invoice($purchase_invoice_number)
	{
	
	   $this->db->select('item_name');
	   //$this->db->select('route_master_name');
		$this->db->where('purchase_invoice_number',$purchase_invoice_number);
		return $this->db->get('view_stock_purchase')->result_array();
		
	}
function get_report($data)
{
	
		$order_by		=	"";
					if($data['report_type']=='purchase_report')
					{
						$query_string	=	"select * from tbl_stock_purchase_master where branch_id = ".$data['branch_id']." and is_deleted = 'N'";
						if($data['purchase_invoice_number'] != '')
						{
							$query_string	=	$query_string." and purchase_invoice_number = ".$data['purchase_invoice_number'];
							
						}
						if($data['date_from'] != '')
						{
							$query_string	=	$query_string." and purchase_date >= '".date('Y-m-d',strtotime($data['date_from']))."'";
						}
						if($data['date_to'] != '')
						{
							$query_string	=	$query_string." and purchase_date <= '".date('Y-m-d',strtotime($data['date_to']))."'";
						}
						
						if($data['item_master_id'] != '')
						{
							$query_string	=	$query_string." and item_master_id = ".$data['item_master_id'];
							
						}
						$query_string	=	$query_string." order by purchase_master_id ASC";
						$res		=	$this->db->query($query_string)->result_array();
						//echo $this->db->last_query();die();
		 				return $res;
						
					}
    if($data['report_type']=='sales_report')
       {
	
						$query_string	=	"select * from view_sales_student where branch_id = ".$data['branch_id']." and is_deleted = 'N'";
					
					   if($data['date_from'] != '')
						{
							
							$query_string	=	$query_string." and sales_date >= '".date('Y-m-d',strtotime($data['date_from']))."'";
						}
						if($data['date_to'] != '')
						{
							$query_string	=	$query_string." and sales_date <= '".date('Y-m-d',strtotime($data['date_to']))."'";
						}
						if($data['item_master_id'] != '')
						{
							$query_string	=	$query_string." and item_master_id = ".$data['item_master_id'];
							
						}
			
						if($data['department_id'] != '')
						{
							$query_string	=	$query_string." and dept_id = ".$data['department_id'];
							$order_by		=	$order_by.",dept_id ASC";
						}
						if($data['class_id'] != '')
						{
							$query_string	=	$query_string." and class_id = ".$data['class_id'];
							$order_by		=	$order_by.",class_id ASC";
						}
						if($data['section_id'] != '')
						{
							$query_string	=	$query_string." and section_id = ".$data['section_id'];
							$order_by		=	$order_by.",section_id ASC";
						}
						if($data['student_id'] != '')
						{
							$query_string	=	$query_string." and student_id = ".$data['student_id'];
							$order_by		=	$order_by.",student_id ASC";
						}
							
		 //$query_string	=	$query_string;
	     //echo $query_string;die();
		 $res		=	$this->db->query($query_string)->result_array();
		 return   $res;
         // print_r($res);die();
	}
		
}


function get_detail_report($purchase_master_id)
{
//echo $purchase_master_id;die();
 $this->db->where('purchase_master_id',$purchase_master_id);
 $this->db->where('is_deleted','N');
return  $this->db->get('view_stock_purchase')->result_array();
//echo "<pre>";
 //print_r($querty);
//echo "</pre>";
// die();
}
function get_detail_reports($sales_master_id)
{
 $this->db->where('sales_master_id',$sales_master_id);
return $this->db->get('view_stock_sales')->result_array();
}



 function get_item_details($data)
	{
	
	  // $this->db->select('item_name');
	   //$this->db->select('route_master_name');                                ///purchase item report
	   	if($data['date_from'] != '')
				{
							
				$this->db->where('purchase_date>=',date('Y-m-d',strtotime($data['date_from'])));
				}
		if($data['date_to'] != '')
				{
				$this->db->where('purchase_date<=',date('Y-m-d',strtotime($data['date_to'])));
				}
		$this->db->where('item_master_id',$data['item_master_id']);
		return $this->db->get('view_stock_purchase')->result_array();
		
	}
	
	function get_item_details_sales($data)
	{
	              if($data['date_from'] != '')
						{
							
				$this->db->where('sales_date>=',date('Y-m-d',strtotime($data['date_from'])));
						}
						if($data['date_to'] != '')
						{
				$this->db->where('sales_date<=',date('Y-m-d',strtotime($data['date_to'])));
						}
				if($data['department_id'] != '')
						{
					$this->db->where('dept_id',$data['department_id']);

						}
						if($data['class_id'] != '')
						{
					$this->db->where('class_id',$data['class_id']);

						}
						if($data['section_id'] != '')
						{
					$this->db->where('section_id',$data['section_id']);

						}
						if($data['student_id'] != '')
						{
					$this->db->where('student_id',$data['student_id']);

						}
	 
		     $this->db->where('item_master_id',$data['item_master_id']);
	         return  $this->db->get('view_stock_sales')->result_array();
		print_r($rews);die();
	}
	
	
	function get_department_by_branch($branch_id)
	{
		$this->db->select('dept_id,dept_name');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_department')->result_array();
	}
	function get_class_by_branch($branch_id)
	{
		$this->db->select('class_id,name');
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('class')->result_array();
	}
	function get_section_by_branch($branch_id)
	{
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('view_section_class')->result_array();
	}
	function get_student_by_branch($branch_id)
	{
		$running_year = get_running_year();
		$this->db->where('year',$running_year);
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('view_students')->result_array();
	}
	function get_class_by_dept($department_id='')
	{
		$running_year = get_running_year();
		$this->db->where('academic_year',$running_year);
		$this->db->where('dept_id',$department_id);
		return $this->db->get('class')->result_array();
	}
	function get_section_by_department($department_id='')
	{
		$this->db->where('dept_id',$department_id);
		return $this->db->get('view_section_class')->result_array();
	}
	function get_student_by_department($department_id='')
	{
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('dept_id',$department_id);
		return $this->db->get('view_students')->result_array();
	}
	function get_class_section($class_id)
	{
		$this->db->select('class_name,section_id,name');
		$this->db->where('class_id',$class_id);
		return $this->db->get('view_section_class')->result_array();
	}
	function get_student_by_class($class_id)
	{
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('class_id',$class_id);
		return $this->db->get('view_students')->result_array();
	}
	function get_student_by_section($section_id)
	{
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('section_id',$section_id);
		return $this->db->get('view_students')->result_array();
	}

	function delete_purchase_master($purchase_master_id)
	{
		$data['deleted_by']			=	$this->session->userdata('login_user_id');
		$data['deleted_date']		=	date('Y-m-d');
		$data['is_deleted']			=	'Y';
		
		$this->db->where('purchase_master_id',$purchase_master_id);
		$this->db->update('tbl_stock_purchase_master',$data);
		return $this->db->affected_rows();
	}
	function delete_sales_master($sales_master_id)
	{
		$data['deleted_by']			=	$this->session->userdata('login_user_id');
		$data['deleted_date']		=	date('Y-m-d');
		$data['is_deleted']			=	'Y';
		
		$this->db->where('sales_master_id',$sales_master_id);
		$this->db->update('tbl_stock_sales_master',$data);
		return $this->db->affected_rows();
	}
	
///////////////////////////////////////////////////////////////////////////////////////
}
