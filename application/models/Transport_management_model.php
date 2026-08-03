<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transport_management_model extends CI_Model {

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

	
		 /////////////////--------------************employee designation----------------
		 function vehicle_employee_designation_insert($employee_designation)
	{
		$data['employee_designation']		=		$employee_designation;
		/*$data['branch_id']		=		$branch_id;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');*/
		$this->db->insert('tbl_transport_pri_employee_designation',$data);
		 return $this->db->insert_id();
	}
		 
	function vehicle_employee_designation_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('employee_designation_id',$id);
	   $this->db->update('tbl_transport_pri_employee_designation',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function vehicle_employee_designation_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('employee_designation_id',$id);
	   $this->db->delete('tbl_transport_pri_employee_designation');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}	 
		 
	function vehicle_class_insert($vehicle_class_name)
	{
		$data['vehicle_class_name']		=		$vehicle_class_name;
		/*$data['branch_id']		=		$branch_id;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');*/
		$this->db->insert('tbl_transport_pri_vehicle_class',$data);
		 return $this->db->insert_id();
	}
	function vehicle_ownership_insert($ownership_type)
	{
		$data['ownership_type']		=		$ownership_type;
		/*$data['branch_id']		=		$branch_id;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');*/
		$this->db->db_debug=FALSE;
		$this->db->insert('tbl_transport_pri_vehicle_ownership',$data);
		$this->db->db_debug=TRUE;
		 return $this->db->insert_id();
	}


//vehicle category
	function vehicle_category_insert($category_name)
	{
		$data['vehicle_category_name']		=		$category_name;
		/*$data['branch_id']		=		$branch_id;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');*/
		$this->db->db_debug=FALSE;
		$this->db->insert('tbl_transport_pri_vehicle_category',$data);
		$this->db->db_debug=TRUE;
		 return $this->db->insert_id();
	}
	
	
	
	//vehicle maker
	
	function vehicle_maker_insert($vehicle_maker_name)
	{
		$data['vehicle_maker_name']	=	$vehicle_maker_name;
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_transport_pri_vehicle_maker',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	
	function vehicle_maker_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('vehicle_maker_id',$id);
	   $this->db->update('tbl_transport_pri_vehicle_maker',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}

	function vehicle_maker_delete($id)
	{
	   $this->db->db_debug = FALSE; 
	   $this->db->where('vehicle_maker_id',$id);
	   $this->db->delete('tbl_transport_pri_vehicle_maker');
	   $this->db->db_debug	=	TRUE;
	   return $this->db->affected_rows(); 
	}
	
function vehicle_class_delete($id)
	{
		$this->db->db_debug = FALSE;
		$this->db->where('vehicle_class_id',$id);
		$this->db->delete('tbl_transport_pri_vehicle_class');
		$this->db->db_debug = TRUE;
		return $this->db->affected_rows();
	}
	
/////////////end code////////////////



//running log
	function vehicle_running_log_insert($data)
	{
		$this->db->db_debug=FALSE;
		$this->db->insert('tbl_transport_vehicle_running_log_book',$data);
		$this->db->db_debug=TRUE;
		return $this->db->insert_id();
	}
	
	
	function vehicle_running_log_update($data,$id)
	{
	  $this->db->db_debug			=	FALSE;
	   $this->db->where('running_log_id',$id);
	   $this->db->update('tbl_transport_vehicle_running_log_book',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
	//fuel
	function vehicle_fuel_log_insert($data)
	{
		$data['entered_by']	= $this->session->userdata('login_user_id','user_id');
		$data['entered_date'] = date('Y/m/d');
		$this->db->db_debug=FALSE;
		$this->db->insert('tbl_transport_vehicle_fuel_log_book',$data);
		$this->db->db_debug=TRUE;
		return $this->db->insert_id();
	}
	
	function vehicle_fuel_log_update($data,$id)
	{
	  $this->db->db_debug			=	FALSE;
	   $this->db->where('fuel_log_book_id',$id);
	   $this->db->update('tbl_transport_vehicle_fuel_log_book',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
	
	
	function get_vehicle_fuel_log($vehicle_master_id)
	{

      $role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			
		}
		else if($role == 3 || $role == 4)
		{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		
		   $this->db->where('vehicle_master_id',$vehicle_master_id);
			$this->db->where('is_deleted','N');
			$query	=	$this->db->get('view_transport_vehicle_fuel')->result_array();
			return $query;
		
	}
	// running log view code 
	
	function get_vehicle_running_log($vehicle_master_id)
	{
 


		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		
		}
		else if($role == 3 || $role == 4)
		{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		{
		    $this->db->where('vehicle_master_id',$vehicle_master_id);
			$this->db->where('is_deleted','N');
			$query	=	$this->db->get('view_transport_vehicle_running_log')->result_array();
			return $query;
		}
	}
	
	
	
	
	//category
	
	function get_vehicle_category()
	{



		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_category')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_category')->result_array();
			return $query;
		}
	}
	
	// vehicle maker view
	
	function get_vehicle_maker()
	{



		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_maker')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_maker')->result_array();
			return $query;
		}
	}
	// vehicle class view
	
		function get_vehicle_class()
	{



		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_class')->result_array();
			return $query;
		}
		else
		{
			//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_class')->result_array();
			return $query;
		}
	}
	
	//////////vehicle ownership
	
	
			function get_vehicle_ownership()
	{
				//$this->db->where('is_deleted','N');
			$query	=	$this->db->get('tbl_transport_pri_vehicle_ownership')->result_array();
			return $query;
		
	}
	///////////////////---------------master--------------------/////////////////////////
	
	
	function vehicle_master_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		//$this->db->db_debug 	=	FALSE;
		$this->db->insert('tbl_transport_vehicle_master',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_master_update($data,$id)
	{
	
	
	   //$this->db->db_debug			=	FALSE;
	   $this->db->where('vehicle_master_id',$id);
	   $this->db->update('tbl_transport_vehicle_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
	
	
	function vehicle_master_delete($data,$id)
	{
	
	$count=0;
    $this->db->where('vehicle_master_id',$id);
	$this->db->where('is_deleted','N');
	$query=$this->db->get('tbl_transport_route_register')->result_array();
   if(count($query)> 0)
   {
   $count++;
   }
	if($count==0)
	{
	   //$this->db->db_debug			=	FALSE;
	   $this->db->where('vehicle_master_id',$id);
	   $this->db->update('tbl_transport_vehicle_master',$data);
	   $this->db->db_debug	= 	TRUE;
	   return $this->db->affected_rows();
	}
	else
	{
		return 0;
		
	}
	}

	function check_bus_number($bus_number,$branch_id)
	{
		$this->db->where('bus_number',$bus_number);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		$query= $this->db->get('tbl_transport_vehicle_master')->result_array();
	 	return $query;
	}
	function check_bus_number_by_route($branch_id,$route_master_id,$vehicle_master_id)
	{
		$query = $this->db->get_where('view_transport_route_register',array('branch_id' => $branch_id, 'route_master_id' => $route_master_id, 'vehicle_master_id' => $vehicle_master_id, 'is_deleted' => 'N'))->result_array();
		//echo $this->db->last_query();die();
	 	return $query;
	}
	
	function check_driver_by_route($branch_id,$route_master_id,$driver_id)
	{
		$query = $this->db->get_where('view_transport_route_register',array('branch_id' => $branch_id, 'route_master_id' => $route_master_id, 'driver_id' => $driver_id, 'is_deleted' => 'N'))->result_array();
	 	return $query;
	}
	
	
	
	
	
	// 
	
	
	
	function get_vehicle_ownership1()
	{
	return $this->db->get('tbl_transport_pri_vehicle_ownership')->result_array();

	}
	
	function get_vehicle_class1()
	{
	return $this->db->get('tbl_transport_pri_vehicle_class')->result_array();
	}
	function get_vehicle_category1()
	{
	return $this->db->get('tbl_transport_pri_vehicle_category')->result_array();
	}
	function get_vehicle_branch1()
	{
	return $this->db->get('tbl_branch')->result_array();
	}
	function get_vehicle_maker1()
	{
	return $this->db->get('tbl_transport_pri_vehicle_maker')->result_array();
	}
	
	function get_vehicle_master1()
	{
		return $this->db->get('tbl_transport_vehicle_master ')->result_array();
	}
	function get_single_vehicle_master($vehicle_master_id)
	{
		$this->db->where('vehicle_master_id',$vehicle_master_id);
		return $this->db->get('view_transport_vehicle_master')->result_array();
	}
	function get_route_master()				
	{
	$this->db->where('is_deleted','N');
	return $this->db->get('view_transport_route_master ')->result_array();
	}
	function vehicle_master_check($vehicle_registration_number)
	{
	 $this->db->where('vehicle_registration_number',$vehicle_registration_number);
	$query= $this->db->get('tbl_transport_vehicle_master ')->result_array();
	 return $query;
	}
	
	//tax details insert
	
	function vehicle_tax_details_insert($data)
	{
	
		
		
		/*$data['branch_id']		=		$branch_id;
		$data['created_by']			=		1;
		$data['created_date']		=		date('Y/m/d');*/
		$this->db->db_debug=FALSE;
		$this->db->where('vehicle_master_id',$data['vehicle_master_id']);	//Set is_active to 'N' for the old records and insert new one.
		$this->db->set('is_active','N');									//So we will get the last inserted item by selecting the row with is_active = 'Y'
		$this->db->update('tbl_transport_vehicle_tax_details');
		$data['entered_by']	= $this->session->userdata('login_user_id','user_id');
		$data['entered_date'] = date('Y/m/d');
		$this->db->insert('tbl_transport_vehicle_tax_details',$data);
		$this->db->db_debug=TRUE;
		 return $this->db->insert_id();
	}
	//tax details update
	
		function vehicle_tax_details_update($data,$id)
	{
	  $this->db->db_debug			=	FALSE;
	   $this->db->where('vehicle_tax_details_id',$id);
	   $this->db->update('tbl_transport_vehicle_tax_details',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
	
	
	//view page code
	function get_vehicle_tax_details($vehicle_master_id)
	{
      $role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		
		}
		else if($role == 3 || $role == 4)
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		{
				
				$this->db->where('vehicle_master_id',$vehicle_master_id);
			$this->db->where('is_deleted','N');
		
			$query	=	$this->db->get('view_transport_vehicle_tax_details')->result_array();
		   return $query;	
		}
	}
	 //-------edit code --------------------------------------------//
	 function get_vehicle_master()
	{
		$role	=	$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		
		}
		else if($role == 3 || $role == 4)
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
			
		}
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_vehicle_master')->result_array();
		
	}
	 
	 
	function get_vehicle_master_edit($vehicle_master_id)
	{
	 $this->db->where('vehicle_master_id',$vehicle_master_id);
	  $query=$this->db->get('tbl_transport_vehicle_master')->result_array();
	  return $query;	
	 
	 }
	  function get_vehicle_running_log_edit($running_log_id)
	 {
	  $this->db->where('running_log_id',$running_log_id);
	  $query=$this->db->get('tbl_transport_vehicle_running_log_book')->result_array();
	  return $query;	
	 }
	   function get_vehicle_fuel_log_edit($fuel_log_book_id)
	 {
	  $this->db->where('fuel_log_book_id',$fuel_log_book_id);
       $query=$this->db->get('tbl_transport_vehicle_fuel_log_book')->result_array();
	  return $query;	
	 }
    function get_vehicle_tax_details_edit($vehicle_tax_details_id)
	 {
	 $this->db->where('vehicle_tax_details_id',$vehicle_tax_details_id);
    $query=$this->db->get('tbl_transport_vehicle_tax_details')->result_array();
	  return $query;	
	 }
function branch_update($data,$branch_id)
	{
	   $this->db->where('branch_id',$branch_id);
	   $this->db->update('tbl_branch',$data);
	}
	function vehicle_class_update($data,$id)
	{
		$this->db->db_debug=FALSE;
	   $this->db->where('vehicle_class_id',$id);
	   return $this->db->update('tbl_transport_pri_vehicle_class',$data);
	    $this->db->db_debug=TRUE;
	   return $this->db->affected_rows();
	}
	function vehicle_ownership_update($data,$id)
	{
	$this->db->db_debug=FALSE;
	   $this->db->where('ownership_type_id',$id);
	   $this->db->update('tbl_transport_pri_vehicle_ownership',$data);
	   $this->db->db_debug=TRUE;
	   return $this->db->affected_rows();
	}
	function vehicle_ownership_delete($id)
	{
	$this->db->where('ownership_type_id',$id);
	$this->db->delete('tbl_transport_pri_vehicle_ownership');
	}
	//vehicle category
	function vehicle_category_update($data,$id)
	{
	$this->db->db_debug=FALSE;
	   $this->db->where('vehicle_category_id',$id);
	   $this->db->update('tbl_transport_pri_vehicle_category',$data);
	   
	   $this->db->db_debug=TRUE;
	   return $this->db->affected_rows();
	}
	function vehicle_category_delete($id)
	{
	$this->db->db_debug=FALSE;
	$this->db->where('vehicle_category_id',$id);
	$this->db->delete('tbl_transport_pri_vehicle_category');
   $this->db->db_debug=TRUE;
   return $this->db->affected_rows();

	}
	/////////////////////////////-----------------manikantan----------------
	//**MAINTENANCE START*************//	
		function get_vehicle_maintenance_log_book($vehicle_master_id)
	{
	$role = $this->session->userdata('role');
	if($role == 1 || $role == 2)
	{
	
	}
	else if($role == 3 || $role == 4)
	{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
	}
		$this->db->where('vehicle_master_id',$vehicle_master_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_vehicle_maintenance_log_book')->result_array();
	}
	function get_single_maintenance_log_book($maintenance_log_book_id)
	{
		$this->db->where('maintenance_log_book_id',$maintenance_log_book_id);
		return $this->db->get('tbl_transport_vehicle_maintenance_log_book')->result_array();
	}
	function vehicle_maintenance_log_book_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->db_debug 	=	FALSE;
		$this->db->insert('tbl_transport_vehicle_maintenance_log_book',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_maintenance_log_book_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('maintenance_log_book_id',$id);
	   $this->db->update('tbl_transport_vehicle_maintenance_log_book',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
//**MAINTENANCE END*************//
//**INSURANCE START*************//
	function get_vehicle_insurance_details($vehicle_master_id)
	{
	$role = $this->session->userdata('role');
	if($role == 1 || $role == 2)
	{
	
	}
	else if($role == 3 || $role == 4)
	{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
	}
	$this->db->where('vehicle_master_id',$vehicle_master_id);
	$this->db->where('is_deleted','N');
	return $this->db->get('view_transport_master_insurance')->result_array();
	}
	function get_single_insurance_details($vehicle_insurance_details_id)
	{
		$this->db->where('vehicle_insurance_details_id',$vehicle_insurance_details_id);
		return $this->db->get('tbl_transport_vehicle_insurance_details')->result_array();
	}
	function vehicle_insurance_details_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->where('vehicle_master_id',$data['vehicle_master_id']);	//Set is_active to 'N' for the old records and insert new one.
		$this->db->set('is_active','N');									//So we will get the last inserted item by selecting the row with is_active = 'Y'
		$this->db->update('tbl_transport_vehicle_insurance_details');
		$this->db->db_debug 	=	FALSE;
		$this->db->insert('tbl_transport_vehicle_insurance_details',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_insurance_details_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('vehicle_insurance_details_id',$id);
	   $this->db->update('tbl_transport_vehicle_insurance_details',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
//**INSURANCE END*************//
//**POLLUTION TEST START*************//
	function get_vehicle_pollution_test_details($vehicle_master_id)
	{
		$role = $this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		
		}
		else if($role == 3 || $role == 4)
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('vehicle_master_id',$vehicle_master_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_vehicle_master_pollution_test')->result_array();
	}
	function get_single_pollution_test_details($vehicle_pollution_test_details_id)
	{
		$this->db->where('vehicle_pollution_test_details_id',$vehicle_pollution_test_details_id);
		return $this->db->get('tbl_transport_vehicle_pollution_test_details')->result_array();
	}
	function vehicle_pollution_test_details_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->db_debug 	=	FALSE;
		$this->db->where('vehicle_master_id',$data['vehicle_master_id']);		//Set is_active to 'N' for the old records and insert new one.
		$this->db->set('is_active','N');										//So we will get the last inserted item by selecting the row with is_active = 'Y'	
		$this->db->update('tbl_transport_vehicle_pollution_test_details');
		$this->db->insert('tbl_transport_vehicle_pollution_test_details',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_pollution_test_details_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('vehicle_pollution_test_details_id',$id);
	   $this->db->update('tbl_transport_vehicle_pollution_test_details',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
//**POLLUTION TEST END*************//

//*****************route master**************************************************************************
	function get_vehicle_route_master()
	{
		$year	=	get_running_year();
		$role	=	$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			
		}
		else if($role == 3|| $role == 4)
		{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('is_deleted','N');
		$this->db->where('year',$year);
		$query	=	$this->db->get('view_transport_route_master')->result_array();
		return $query;
	}
	
	//function get_vehicle_route_master()
	//{
		//$this->db->where('is_deleted','N');
		//return $this->db->get('view_transport_route_master')->result_array();  //view page
	//}
	function get_single_route_master($route_master_id)
	{
		$this->db->where('route_master_id',$route_master_id);
		return $this->db->get('tbl_transport_route_master')->result_array();  //edit page
	}
	function vehicle_route_master_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->db_debug 	=	FALSE;
		$this->db->insert('tbl_transport_route_master',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_route_master_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('route_master_id',$id);
	   $this->db->update('tbl_transport_route_master',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
	function vehicle_route_master_delete($data,$route_master_id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('route_master_id',$route_master_id);	
	   $this->db->where('is_deleted','N');
	   $this->db->from('tbl_transport_route_register');			//While deleting Route master, check that any vehicles are registered on this route. 
	   $query = $this->db->get()->result_array();				//If vehicles are registered,don't allow to delete.
	   if(count($query) == 0)
	   {
		   $this->db->where('route_master_id',$route_master_id);
		   $this->db->update('tbl_transport_route_master',$data);
	   	   return $this->db->affected_rows();
	   }
	   else
	   {
	   		return -1;
	   }
	}
	
	function check_route_name($route_master_name,$branch_id)
	{
		$this->db->where('year',get_running_year());
		$this->db->where('route_master_name',$route_master_name);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		$query= $this->db->get('tbl_transport_route_master ')->result_array();
	 	return $query;
	}
	function check_route_number($route_number,$branch_id)
	{
	    $year   =   get_running_year();
		$this->db->where('route_number',$route_number);
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		$this->db->where('year',$year);
		$query= $this->db->get('tbl_transport_route_master ')->result_array();
	 	return $query;
	}
	function get_designation($designation)
	{
		$this->db->where('employee_designation',$designation);
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_employee_master')->result_array();
	}
	
	//********route details***********************************
	
		function get_vehicle_route_details($route_master_id='')                           //view page
	{
		$role=$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		}
		else if($role == 3 || $role == 4)
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('route_master_id',$route_master_id);
		$this->db->where('is_deleted','N');
		$query	=	$this->db->get('view_transport_route_details')->result_array();
		/*****To get 'route_master_name' and 'route_number'******/
		$this->db->where('route_master_id',$route_master_id);
		$this->db->where('is_deleted','N');
		$this->db->select('route_master_name,route_number');
		$query1				=	$this->db->get('view_transport_route_master')->row();
		if(isset($query1))
		{
			$route_master_name	=	$query1->route_master_name;
			$route_number		=	$query1->route_number;
			return array(
				'result' 			=> $query,
				'route_master_name' => $route_master_name,
				'route_number' 		=> $route_number
				);
		}
	}

	
	//function get_vehicle_route_master()
	//{
		//$this->db->where('is_deleted','N');
		//return $this->db->get('view_transport_route_master')->result_array();  
	//}
	function get_single_route_details($route_details_id)
	{
		$this->db->where('route_details_id',$route_details_id);
		return $this->db->get('tbl_transport_route_details')->result_array();  //edit page
	}
	function vehicle_route_details_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->db_debug 	=	FALSE;
		$this->db->insert('tbl_transport_route_details',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_route_details_update($data,$id)
	{
	  $this->db->db_debug			=	FALSE;
	   $this->db->where('route_details_id',$id);
	   $this->db->update('tbl_transport_route_details',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	}
	function vehicle_route_details_delete($data,$id)
	{
		$this->db->db_debug		=	FALSE;
		$this->db->where('route_details_id',$id);
		$this->db->where('is_deleted','N');
		$query 					= 	$this->db->get('tbl_transport_students_bus_fee_master')->result_array();
		if(count($query) > 0)
		{
			return -1;
		}
		else
		{
			$this->db->where('route_details_id',$id);
	   		$this->db->update('tbl_transport_route_details',$data);
			return $this->db->affected_rows();
		}
		$this->db->db_debug		= 	TRUE;
		
	}
	
	function check_pickup_point($pickup_point,$route_master_id)
	{
		$this->db->where('pickup_point',$pickup_point);
		$this->db->where('route_master_id',$route_master_id);
		$this->db->where('is_deleted','N');
		$query= $this->db->get('tbl_transport_route_details')->result_array();
	 	return $query;
	}
	
	
	
	
//**EMPLOYEE MASTER START*************//	
	function get_employee_master()
	{
		$role = $this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		}
		else if($role == 3 || $role == 4)
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		
			$this->db->where('is_deleted','N');
			return $this->db->get('view_transport_employee_master')->result_array();

	}
	function get_single_employee_master($employee_master_id)
	{
		$this->db->where('employee_master_id',$employee_master_id);
		return $this->db->get('tbl_transport_employee_master')->result_array();
	}
	function get_marital_status()
	{
		return	$this->db->get('tbl_transport_pri_marital_status')->result_array();
	}
	function get_employee_designation()
	{
		return	$this->db->get('tbl_transport_pri_employee_designation')->result_array();
	}
	function employee_master_insert($data,$data1)
	{
	    $this->db->where('employee_designation_id',$data1['employee_designation_id']);    
	    $designation    =   $this->db->get('tbl_transport_pri_employee_designation')->row()->employee_designation;
	    $this->db->select('role_id');
	    $this->db->where('role_name',$designation);
	    $rol    =   $this->db->get('tbl_user_roles')->row();
	    $data['role']   =   $rol->role_id;
		$this->db->insert('staff',$data);
		$data1['employee_master_id']=	$this->db->insert_id();
		$data1['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data1['entered_date'] 		=	date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_transport_employee_master',$data1);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	function employee_master_update($data,$data1,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('staff_id',$id);
	   $this->db->update('staff',$data);
	   $this->db->where('employee_master_id',$id);
	   $this->db->update('tbl_transport_employee_master',$data1);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	} 
//**EMPLOYEE MASTER END*************//	

//**ROUTE REG START***//
	
function get_vehicle_route_register($route_master_id='')
	{
		$role = $this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
		}
		else if($role == 3 || $role == 4)
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		$this->db->where('route_master_id',$route_master_id);
		$this->db->where('is_deleted','N');
		$query = $this->db->get('view_transport_route_register')->result_array();
		
		$this->db->where('route_master_id',$route_master_id);							//This code is written to get the route master name
		$this->db->where('is_deleted','N');
		$this->db->select('route_master_name');
		$query1				=	$this->db->get('view_transport_route_master')->row();
		if(isset($query1))
		{
			$route_master_name	=	$query1->route_master_name;
			return array(
				'result' 			=> $query,
				'route_master_name' => $route_master_name
				);
		}

	}
	function get_single_route_register($route_register_id)
	{
		$this->db->where('route_register_id',$route_register_id);
		return $this->db->get('tbl_transport_route_register')->result_array();
	}

	function vehicle_route_register_insert($data)
	{
	
		$data['entered_by']			=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 		=	date('Y/m/d');
		$this->db->db_debug 		=	FALSE;
		$this->db->insert('tbl_transport_route_register',$data);
		$this->db->db_debug 		=	TRUE;
		return $this->db->insert_id();
	}
	function vehicle_route_register_update($data,$id)
	{
	   $this->db->db_debug			=	FALSE;
	   $this->db->where('route_register_id',$id);
	   $this->db->update('tbl_transport_route_register',$data);
	   $this->db->db_debug			= 	TRUE;
	   return $this->db->affected_rows();
	} 
	function vehicle_route_register_delete($data,$id)
	{
		$this->db->db_debug		=	FALSE;
		$this->db->where('route_register_id',$id);
		$this->db->where('is_deleted','N');
		$query 					= 	$this->db->get('tbl_transport_students_bus_fee_master')->result_array();
		if(count($query) > 0)
		{
			return -1;
		}
		else
		{
			$this->db->where('route_register_id',$id);
	   		$this->db->update('tbl_transport_route_register',$data);
			return $this->db->affected_rows();
		}
		$this->db->db_debug		= 	TRUE;
		
	} 
	function get_vehicle_master_by_route_master_branch($route_master_id)
	{
		$this->db->select('a.vehicle_master_id,a.vehicle_registration_number,a.bus_number');
		$this->db->from('tbl_transport_vehicle_master as a');
		$this->db->where('is_deleted','N');
		$this->db->where('a.bus_number!=','');
		$this->db->order_by('a.bus_number','ASC');
		$this->db->where('a.branch_id IN (select branch_id from tbl_transport_route_master where route_master_id = '.$route_master_id.')');
		return $this->db->get()->result_array();
	}	
	function get_designation_by_route_master_branch($designation,$route_master_id)
	{
		$this->db->select('a.staff_id,a.name,a.role,a.role_name');
		$this->db->from('view_staff as a');
		$this->db->where('is_deleted','N');
		$this->db->where('role_name',$designation);
		$this->db->where('a.branch_id IN (select branch_id from tbl_transport_route_master where route_master_id = '.$route_master_id.')');
		return $this->db->get()->result_array();
	}	

//**ROUTE REGISTER END*************//	

	function get_students_by_class($class_id,$section_id)
	{
	  //Get student who is not assigned to a bus
	   $this->db->db_debug			=	FALSE;
	   $year		=	get_running_year();
	   
	   //Subquery
	   $this->db->select('student_id')->from('tbl_transport_students_bus_fee_master')->where('academic_year',$year)->where('is_deleted','N')->where('is_active','Y');
	   $subQuery =  $this->db->get_compiled_select();
	   
	   // Main Query
	   $this->db->where('class_id',$class_id);
	   $this->db->where('section_id',$section_id);
	   $this->db->where('student_status_id','0');
	   $this->db->where('year',$year);
	   $this->db->where(" student_id not in ($subQuery)", NULL, FALSE);
	   $this->db->order_by('name','ASC');
	   return $this->db->get('view_students')->result_array();
	   $this->db->db_debug			= 	TRUE;
	   
	}
	
	function get_students_in_class($class_id,$section_id)
	{
	  //Get student who is assigned to a bus
	   $this->db->db_debug			=	FALSE;
	   $year		=	get_running_year();
	   
	   //Subquery
	   $this->db->select('student_id')->from('tbl_transport_students_bus_fee_master')->where('academic_year',$year)->where('is_deleted','N')->where('is_active','Y');
	   $subQuery =  $this->db->get_compiled_select();
	   
	   // Main Query
	   $this->db->where('class_id',$class_id);
	   $this->db->where('section_id',$section_id);
	   $this->db->where('student_status_id','0');
	   $this->db->where('year',$year);
	   $this->db->where(" student_id in ($subQuery)", NULL, FALSE);
	   $this->db->order_by('name','ASC');
	   return $this->db->get('view_students')->result_array();
	   $this->db->db_debug			= 	TRUE;
	   
	}

	function get_fee_collected($students_bus_fee_master_id)
	{
		$this->db->select('SUM(fee_amount) as fee_amount');
		$this->db->group_by('students_bus_fee_master_id');
		$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id);
		$result	=	$this->db->get('tbl_transport_students_bus_fee_collection_details')->row();
		$amount	=	isset($result)?$result->fee_amount:0;
		return $amount; 
	}
     function get_bus_no($route_master_id)
	  {
		$bus_no = $this->db->get_where('view_transport_route_register' , array('route_master_id' => $route_master_id,'is_deleted' => 'N'))->result_array();
		return $bus_no;
		}
		
    function get_bus_seats($route_register_id)
	{
		// Code to get the seat capacity of the bus selected
		$this->db->select('seat_capacity');
		$this->db->from('view_transport_vehicle_master');
		$this->db->where('is_deleted','N');
		$this->db->where('bus_number IN (select bus_number from view_transport_route_register where route_register_id = '.$route_register_id.' and is_deleted = "N")');
		$query = $this->db->get()->row();
		if(isset($query))
		{
			$seat_capacity = $query->seat_capacity;
			return $seat_capacity;
		}
	}
    function get_no_of_students_in_bus($route_register_id)			
	{
		// Code to get number of students in the bus selected
		// Here the logic is : select month and year from current date and compare it with due_date's month and year. If they are same, select that row and count it.
		$query1 = "select route_register_id from tbl_transport_students_bus_fee_master where DATE_FORMAT(due_date,'%Y%m') = DATE_FORMAT(CURDATE(),'%Y%m') and route_register_id = ".$route_register_id." and is_deleted = 'N'";
		return $this->db->query($query1)->result_array();
		/*
		$this->db->select('student_id');
		$this->db->from('view_transport_students_bus_fee_master');
		$this->db->where('is_deleted','N');
		$this->db->where('route_register_id',$route_register_id);
		$this->db->group_by('student_id');
		return $this->db->get()->result_array();
		*/
	}
		
	  function get_pick_up_point($route_master_id)
	  {
	   
		$pick_up= $this->db->get_where('view_transport_route_details' , array('route_master_id' => $route_master_id,'is_deleted' => 'N'))->result_array();
		return $pick_up;
		}	
		
	  function get_base_fare($route_details_id)
	  {
	   
		$base_fare = $this->db->get_where('view_transport_route_details' , array('route_details_id' => $route_details_id))->row();
		return $base_fare;
		}	
	function check_student_exist($student_id)
	{
                $year   = get_running_year();
		$this->db->where('student_id',$student_id);
		$this->db->where('is_deleted','N');
		$this->db->where('academic_year',$year);
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
	}
	function get_fee_installment($branch_id,$academic_year)
	{
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year',$academic_year);
		$this->db->where('is_active','Y');
		$rows	=	$this->db->get('tbl_transport_bus_fee_installment_settings')->result_array();
		return $rows;
	}
	function bus_fee_installment_insert($data)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id','user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->db_debug 	=	FALSE;
		$this->db->insert('tbl_transport_students_bus_fee_master',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->insert_id();
	}
	function get_route_master_by_branch($branch_id)
	{
		$year	=	get_running_year();
		$this->db->where('is_deleted','N');
		$this->db->where('year',$year);
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('view_transport_route_master')->result_array();
	}	
	function students_bus_fee_master_update($student_id,$students_bus_fee_master_id,$data,$academic_year)
	{
		$data['entered_by']		=	$this->session->userdata('login_user_id');
		$data['entered_date'] 	=	date('Y/m/d');
		$this->db->where('academic_year',$academic_year);
		$this->db->where('student_id',$student_id);
		$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id);
		$this->db->update('tbl_transport_students_bus_fee_master',$data);
		$this->db->db_debug			= 	TRUE;
		return $this->db->affected_rows();
	} 
	function deassign_students_bus_fee_master_update($students_bus_fee_master_id)
	{
		//$this->db->db_debug		=	FALSE;
		$data['is_deleted']		=	'Y';
		$data['deleted_by']		=	$this->session->userdata('login_user_id');
		$data['deleted_date'] 	=	date('Y/m/d');
		$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id);
		//$this->db->where('fee_balance=','0');
		$this->db->update('tbl_transport_students_bus_fee_master',$data);
		$this->db->db_debug			= 	TRUE;
		return $this->db->affected_rows();
	} 
/********************REPORTS START*****************************/

	function get_department()
	{
		$this->db->where('branch_id',$this->session->userdata('branch_id'));
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_department')->result_array();
	}
	
	function get_class()
	{
		$academic_year = get_running_year();
		$this->db->where('dept_id',$this->session->userdata('dept_id'));
		$this->db->where('academic_year',$academic_year);
		return $this->db->get('class')->result_array();
	}

	function get_bus_fee_class_wise($data)
	{
		$this->db->where(array('class_id' => $data['class_id'],'section_id' => $data['section_id'],'is_deleted'=>'N'));
		$this->db->group_by('student_id');
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
	}
	
	function get_bus_by_branch($branch_id)
	{
		$year	=	get_running_year();
		$this->db->join('tbl_transport_route_master b','b.route_master_id=a.route_master_id');
		//$this->db->where('b.year',$year);
		$this->db->where('a.branch_id',$branch_id);
		$this->db->where('a.is_deleted','N');
		$this->db->order_by('a.bus_number','ASC');
		return $this->db->get('view_transport_route_register a')->result_array();
	}
	function get_bus_fee_bus_wise($route_register_id)
	{
	    
		$this->db->where('route_register_id',$route_register_id);
		$this->db->where('is_deleted','N');
		$this->db->group_by('student_id');
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
	}
	function get_route_name($route_register_id)
	{
	    
		$this->db->select('route_master_name');
		$this->db->where('route_register_id',$route_register_id);
		$row = $this->db->get('view_transport_route_register')->row();
		return $row->route_master_name;
	}
	function get_bus_number($route_register_id)
	{
		$this->db->select('bus_number');
		$this->db->where('route_register_id',$route_register_id);
		$row = $this->db->get('view_transport_route_register')->row();
		return $row->bus_number;
	}
//////////////////------------
	function get_bus_fee_route_wise($route_master_id)
	{
	
		$this->db->where('route_master_id',$route_master_id);
                $this->db->where('is_deleted','N');
		$this->db->group_by('student_id');
		 $d= $this->db->get('view_transport_students_bus_fee_master')->result_array();
		 return $d;
		
	}
	function get_route_by_branch($branch_id)
	{
		$year	=	get_running_year();
		$this->db->select('route_master_id');
		$this->db->select('route_master_name');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		//$this->db->where('year',$year);
		return $this->db->get('view_transport_route_master')->result_array();
	}
	
	///////////
	
	function get_route_master_name_by_pick_up($data)
	{
		$this->db->where('branch_id',$data['branch_id']);
		$this->db->where('pickup_point',$data['pickup_point']);
		$this->db->where('is_deleted','N');
		$query = $this->db->get('view_transport_route_details')->row();
		if(isset($query))
		{
			return $query->route_master_name;
		}
	}
	function get_bus_fee_pickup_wise($data)
	{
                $year   =   get_running_year();
		$this->db->where('branch_id',$data['branch_id']);
		$this->db->where('pickup_point',$data['pickup_point']);
		$this->db->group_by('student_id');
		$this->db->where('is_deleted','N');
		$this->db->where('academic_year',$year);
		$d= $this->db->get('view_transport_students_bus_fee_master')->result_array();
		return $d;
	}
	function get_pickup_by_branch($branch_id)
	{
		$year	=	get_running_year();
		$this->db->join('tbl_transport_route_master b','b.route_master_id=a.route_master_id');
		//$this->db->where('b.year',$year);
		$this->db->select('a.pickup_point,a.route_master_name,a.route_details_id');
		$this->db->where('a.branch_id',$branch_id);
		$this->db->where('a.is_deleted','N');
		$this->db->order_by('a.pickup_point','ASC');
		return $this->db->get('view_transport_route_details a')->result_array();
	}
/********************REPORTS END*******************************/

	function get_bus_fee_installment_settings($branch_id,$academic_year)
	{
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year',$academic_year);
		return $this->db->get('tbl_transport_bus_fee_installment_settings')->result_array();
	}
	function get_running_year()
	{
		return get_running_year();
		
	}
	function insert_bus_fee_settings($branch_id,$academic_year)
	{
		$sql 	= 	"CALL insert_bus_fee_installment_settings(".$branch_id.",'".$academic_year."')";
		$query 	= 	$this->db->query($sql);
		return $this->db->affected_rows();
	}
	function bus_fee_installment_settings_update($data,$id)
	{
		//$this->db->db_debug 	=	FALSE;
		$this->db->where('bus_fee_settings_id',$id);
		$this->db->update('tbl_transport_bus_fee_installment_settings',$data);
		$this->db->db_debug 	=	TRUE;
		return $this->db->affected_rows();
		
	}
	function check_installment($branch_id,$academic_year)
	{
		$query			=	"select a.bus_fee_settings_id,a.academic_year from tbl_transport_students_bus_fee_master as a where a.is_deleted = 'N' and a.bus_fee_settings_id in (select bus_fee_settings_id from tbl_transport_bus_fee_installment_settings where academic_year = a.academic_year and is_active = 'Y')";
		return $this->db->query($query)->row();
	}

function get_student_fee_details($class_id='',$section='')
	{
		$year	=	get_running_year();
		$this->db->where('class_id', $class_id);
		$this->db->where('section_id',$section);
		$this->db->where('student_status_id','0');		
		$this->db->join('enroll', 'enroll.student_id = student.student_id and enroll.year='.$year);
		$this->db->select('student.student_id, student.name');
		$this->db->order_by('student.name','ASC');
		$student_fee_details		=	$this->db->get('student')->result_array();
		return 	$student_fee_details;
	}
	function get_class1()
	{
		$branch	=	$this->session->userdata('branch_id');
		$dept	=	$this->session->userdata('dept_id');
		$running_year	=	get_running_year();
		$this->db->where('branch_id',$branch);
		$this->db->where('dept_id',$dept);
		$this->db->where('academic_year',$running_year);
		$class 	=	$this->db->get('class')->result_array();//echo $this->db->last_query();die();
		return $class;
	}
	function get_student_payment_details1($student)
	{
		$this->db->where('student_id', $student);
		$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent,admission_number');
		$this->db->from('student');
		return $this->db->get()->result_array();	
	}
	function get_student_payment_details2($student_id)
	{
                $year   =   get_running_year();
		$this->db->select('students_bus_fee_master_id,due_date,fee_amount,fee_balance,fee_concession');
		$this->db->from('tbl_transport_students_bus_fee_master');
		$this->db->where('student_id',$student_id);
		$this->db->where('is_deleted','N');
		$this->db->where('academic_year',$year);
		$this->db->where('fee_amount>0');
		$this->db->order_by("due_date","asc");
		return $this->db->get()->result_array();
	}
	/////report
	function get_fee_collection_detailed_report1($data)
	{
		$this->db->select('student_id,date_paid,receipt_number,installment_name,SUM(amount_paid) AS amount_paid,student_name,class_name,section_name');
		$this->db->where('date_paid >=', $data['date_from']);
		$this->db->where('date_paid <=', $data['date_to']);
		if($this->session->userdata('role')==15)
		{
			$this->db->where('entered_by', $this->session->userdata('login_user_id'));
		}
		if($data['department_id'] != 'All')
		{
			$this->db->where('dept_id', $data['department_id']);
			if($data['class_id'] != 'All' && $data['class_id'] != 'all')
			{
				$this->db->where('class_id', $data['class_id']);
				if($data['section_id'] != 'All' && $data['section_id'] != 'all')
				{
					$this->db->where('section_id', $data['section_id']);
				}
			}
		}
		$this->db->where('branch_id ', $data['branch_id']);
		$this->db->group_by('receipt_number');
		return  $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();
	}
	function get_dept($branch_id)
	{
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('tbl_department')->result_array();
	}
	function get_class_by_dept($dept_id)
	{
		$year	=	get_running_year();
		$this->db->where('dept_id',$dept_id);
		$this->db->where('academic_year',$year);
		return $this->db->get('class')->result_array();
	}
	function get_class_section($class_id)
	{
		$this->db->where('class_id',$class_id);
		return $this->db->get('section')->result_array();
	}	
	/****************** Bus Fee Concession Start**************/

	function get_students_bus_fee_details($student_id='')
	{
        $year   = get_running_year();    
	$query = $this->db->query("select * from tbl_transport_students_bus_fee_master where student_id=".$student_id." and academic_year=".$year." and fee_balance!=0 and is_deleted = 'N' ")->result_array();
	return $query;
	}
	function bus_fee_concession_update($students_bus_fee_master_id='',$data)
	{
		$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id);
		$this->db->update('tbl_transport_students_bus_fee_master',$data);
		return $this->db->affected_rows();
	}	
	
/****************** Bus Fee Concession End**************/


	function get_bus_fee_due_report($data)
	{
                $year   = get_running_year();
		if($data['dept_id']!='all')
		{
			$this->db->where('a.dept_id',$data['dept_id']);
			if($data['class_id']!='all')
			{
				$this->db->where('a.class_id',$data['class_id']);
				if($data['section_id']!='all')
				{
					$this->db->where('a.section_id',$data['section_id']);
				}
			}
		}	
		
		$this->db->where('a.due_date<=',$data['due_date']);
		$this->db->where('a.fee_balance>',0);
		$this->db->where('a.is_deleted','N');
		$this->db->where('a.academic_year',$year);
		$this->db->join('student b','b.student_id=a.student_id');
		$this->db->where('b.student_status_id',0);
		$this->db->order_by('a.due_date ASC,a.name ASC');
		return $this->db->get('view_transport_students_bus_fee_master a')->result_array();
	}

/*****************ALL IN ONE REPORT START******************/
//1)Student Report Start
	function get_driver_by_branch($branch_id)
	{
		$this->db->select('driver_id,driver_name,route_master_name');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_route_register')->result_array();
	}
	function get_receipt_number_by_branch($branch_id)
	{
		$this->db->select('DISTINCT(receipt_number)');
		$this->db->where('receipt_number is NOT NULL');
		$this->db->where('branch_id',$branch_id);
		$this->db->order_by('receipt_number','ASC');
		return $this->db->get('view_transport_students_bus_fee_master_details')->result_array();
	}
	function get_receipt_number_by_route($route_master_id)
	{
		$this->db->select('DISTINCT(receipt_number)');
		$this->db->where('receipt_number is NOT NULL');
		$this->db->where('route_master_id',$route_master_id);
		$this->db->order_by('receipt_number','ASC');
		return $this->db->get('view_transport_students_bus_fee_master_details')->result_array();
	}
	function get_driver_by_route($route_master_id)
	{
		$this->db->select('driver_id,driver_name,route_master_name');
		$this->db->where('route_master_id',$route_master_id);
		$this->db->where('is_deleted','N');
		return $this->db->get('view_transport_route_register')->result_array();
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
		$year	=	get_running_year();
		$this->db->select('class_id,name');
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year',$year);
		return $this->db->get('class')->result_array();
	}
	function get_section_by_branch($branch_id)
	{
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('view_section_class')->result_array();
	}
	function get_student_by_branch($branch_id)
	{
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('branch_id',$branch_id);
		return $this->db->get('view_students')->result_array();
	}
	function get_installment_by_branch($branch_id)
	{
		$academic_year	=	get_running_year();
		$this->db->where('branch_id',$branch_id);
		$this->db->where('academic_year',$academic_year);
		$this->db->where('is_active','Y');
		return $this->db->get('tbl_transport_bus_fee_installment_settings')->result_array();
	}
	function get_student_by_route($route_master_id)
	{       
                $year   = get_running_year();
		$this->db->select('student_id,name,class_name,section_name,installment_name');
		$this->db->where('route_master_id',$route_master_id);
		$this->db->where('is_deleted','N');
		$this->db->where('academic_year',$year);
		$this->db->group_by('student_id');
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
	}
	function get_student_by_bus($route_register_id)
	{
                $year   = get_running_year();
		$this->db->select('student_id,name,class_name,section_name,installment_name');
		$this->db->where('route_register_id',$route_register_id);
                $this->db->where('is_deleted','N');
		$this->db->where('academic_year',$year);
		$this->db->group_by('student_id');
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
	}
	function get_student_by_pickup($route_details_id)
	{
                $year   = get_running_year();
		$this->db->select('student_id,name,class_name,section_name,installment_name');
		$this->db->where('route_details_id',$route_details_id);
                $this->db->where('is_deleted','N');
		$this->db->where('academic_year',$year);
		$this->db->group_by('student_id');
		return $this->db->get('view_transport_students_bus_fee_master')->result_array();
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
	function get_student_by_class($class_id)
	{
		$year	=	get_running_year();
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('class_id',$class_id);
		$this->db->where('student_status_id','0');
		$this->db->where('year',$year);
		$this->db->order_by('name','ASC');
		return $this->db->get('view_students')->result_array();
	}
	function get_student_by_section($section_id)
	{
		$year	=	get_running_year();
		$this->db->select('student_id,name,class_name,section_name');
		$this->db->where('section_id',$section_id);
		$this->db->where('student_status_id','0');
		$this->db->where('year',$year);
		$this->db->order_by('name','ASC');
		return $this->db->get('view_students')->result_array();
	}
	function get_student_report($data)
	{
		$this->db->where('branch_id',$data['branch_id']);
		$query_string	=	"select distinct(student_id) from view_transport_students_bus_fee_master where branch_id = ".$data['branch_id']." and is_deleted = 'N'";
		if($data['route_master_id'] != '')
		{
			$this->db->where('route_master_id',$data['route_master_id']);
			$query_string	=	$query_string." and route_master_id = ".$data['route_master_id'];
		}
		if($data['route_register_id'] != '')
		{
			$this->db->where('route_register_id',$data['route_register_id']);
			$query_string	=	$query_string." and route_register_id = ".$data['route_register_id'];
		}
		if($data['route_details_id'] != '')
		{
			$this->db->where('route_details_id',$data['route_details_id']);
			$query_string	=	$query_string." and route_details_id = ".$data['route_details_id'];
		}
		if($data['driver_id'] != '')
		{
			$this->db->where('driver_id',$data['driver_id']);
			$query_string	=	$query_string." and driver_id = ".$data['driver_id'];
		}
		if($data['department_id'] != '')
		{
			$this->db->where('dept_id',$data['department_id']);
			//$this->db->order_by('dept_id','ASC');
			$query_string	=	$query_string." and dept_id = ".$data['department_id'];
		}
		if($data['class_id'] != '')
		{
			$this->db->where('class_id',$data['class_id']);
			//$this->db->order_by('class_id','ASC');
			$query_string	=	$query_string." and class_id = ".$data['class_id'];
		}
		if($data['section_id'] != '')
		{
			$this->db->where('section_id',$data['section_id']);
			//$this->db->order_by('section_id','ASC');
			$query_string	=	$query_string." and section_id = ".$data['section_id'];
		}
		if($data['student_id'] != '')
		{
			$this->db->where('student_id',$data['student_id']);
			//$this->db->order_by('student_id','ASC');
			$query_string	=	$query_string." and student_id = ".$data['student_id'];
		}
		if($data['date_from'] != '')
		{
			$this->db->where('due_date>=',date('Y-m-d',strtotime($data['date_from'])));
			$query_string	=	$query_string." and due_date >= '".date('Y-m-d',strtotime($data['date_from']))."'";
		}
		if($data['date_to'] != '')
		{
			$this->db->where('due_date<=',date('Y-m-d',strtotime($data['date_to'])));
			$query_string	=	$query_string." and due_date <= '".date('Y-m-d',strtotime($data['date_to']))."'";
		}
		if($data['date_from'] == '' && $data['date_to'] == '')   // If no date is set, then get only the students whose due_date is over. 
		{
			$this->db->where('due_date<=',date('Y-m-d'));
			$query_string	=	$query_string." and due_date <=DATE_FORMAT(CURDATE(),'%Y%m%d')";
		}
		$this->db->order_by('student_id','ASC');
		//$this->db->order_by('due_date','ASC');
		$this->db->where('is_deleted','N');
		$query	=	$this->db->get('view_transport_students_bus_fee_master')->result_array();
		//echo $this->db->last_query();die();
		$query1	=	$this->db->query($query_string)->result_array();
		$count	=	count($query1);
		$result	=	array(
						'query'	=>	$query,
						'count'	=>	$count
						);
		return $result;
		//echo $this->db->last_query();
		//die();	
		/*echo "<pre>";
		print_r($query1);
		echo "</pre>";
		die();*/
	}
//1)Student Report End

//2)Fee Report Start

	function get_report($data)
	{
		$order_by		=	"";
		if($data['report_type']=='student_report')
		{
			$query_string	=	"select * from view_transport_students_bus_fee_master where branch_id = '".$data['branch_id']."' and is_deleted = 'N'";
			$query_string1	=	"select distinct(student_id) from view_transport_students_bus_fee_master where branch_id = '".$data['branch_id']."' and is_deleted = 'N'";
			if($data['driver_id'] != '')
			{
				$query_string	=	$query_string." and driver_id = '".$data['driver_id']."'";
				$query_string1	=	$query_string1." and driver_id = '".$data['driver_id']."'";
			}
			if($data['date_from'] != '')
			{
				$query_string	=	$query_string." and due_date >= '".date('Y-m-d',strtotime($data['date_from']))."'";
				$query_string1	=	$query_string1." and due_date >= '".date('Y-m-d',strtotime($data['date_from']))."'";
			}
			if($data['date_to'] != '')
			{
				$query_string	=	$query_string." and due_date <= '".date('Y-m-d',strtotime($data['date_to']))."'";
				$query_string1	=	$query_string1." and due_date <= '".date('Y-m-d',strtotime($data['date_to']))."'";
			}
			if($data['date_from'] == '' && $data['date_to'] == '')
			{
				$query_string	=	$query_string." and due_date <=DATE_FORMAT(CURDATE(),'%Y%m%d')";
				$query_string1	=	$query_string1." and due_date <=DATE_FORMAT(CURDATE(),'%Y%m%d')";
			}
			if($data['route_details_id'] != '')
			{
				$query_string	=	$query_string." and route_details_id = '".$data['route_details_id']."'";
				$query_string1	=	$query_string1." and route_details_id = '".$data['route_details_id']."'";
			}
			if($data['department_id'] != '')
			{
				$query_string	=	$query_string." and dept_id = '".$data['department_id']."'";
				$query_string1	=	$query_string1." and dept_id = '".$data['department_id']."'";
				$order_by		=	$order_by.",dept_id ASC";
			}
			if($data['class_id'] != '')
			{
				$query_string	=	$query_string." and class_id = '".$data['class_id']."'";
				$query_string1	=	$query_string1." and class_id = '".$data['class_id']."'";
				$order_by		=	$order_by.",class_id ASC";
			}
			if($data['section_id'] != '')
			{
				$query_string	=	$query_string." and section_id = '".$data['section_id']."'";
				$query_string1	=	$query_string1." and section_id = '".$data['section_id']."'";
				$order_by		=	$order_by.",section_id ASC";
			}
			if($data['student_id'] != '')
			{
				$query_string	=	$query_string." and student_id = '".$data['student_id']."'";
				$query_string1	=	$query_string1." and student_id = '".$data['student_id']."'";
				$order_by		=	$order_by.",student_id ASC";
			}
			if($data['route_master_id'] != '')
			{
				$query_string	=	$query_string." and route_master_id = '".$data['route_master_id']."'";
			}
			if($data['route_register_id'] != '')
			{
				$query_string	=	$query_string." and route_register_id = '".$data['route_register_id']."'";
			}
		}
		if($data['report_type']=='fee_report')
		{
			$query_string	=	"select * from view_transport_students_bus_fee_master_details where branch_id = '".$data['branch_id']."' and is_deleted = 'N'";
			if($data['receipt_number'] != '')
			{
				$query_string	=	$query_string." and receipt_number = '".$data['receipt_number']."'";
			}
			if($data['bus_fee_settings_id'] != '')
			{
				$query_string	=	$query_string." and bus_fee_settings_id = '".$data['bus_fee_settings_id']."'";
			}
			if($data['due_date_from'] != '')
			{
				$query_string	=	$query_string." and due_date >= '".date('Y-m-d',strtotime($data['due_date_from']))."'";
			}
			if($data['due_date_to'] != '')
			{
				$query_string	=	$query_string." and due_date <= '".date('Y-m-d',strtotime($data['due_date_to']))."'";
			}
			if($data['paid_date_from'] != '')
			{
				$query_string	=	$query_string." and date_paid >= '".date('Y-m-d',strtotime($data['paid_date_from']))."'";
			}
			if($data['paid_date_to'] != '')
			{
				$query_string	=	$query_string." and date_paid <= '".date('Y-m-d',strtotime($data['paid_date_to']))."'";
			}
			if($data['route_details_id'] != '')
			{
				$query_string	=	$query_string." and route_details_id = '".$data['route_details_id']."'";
			}
			if($data['department_id'] != '')
			{
				$query_string	=	$query_string." and dept_id = '".$data['department_id']."'";
				$order_by		=	$order_by.",dept_id ASC";
			}
			if($data['class_id'] != '')
			{
				$query_string	=	$query_string." and class_id = '".$data['class_id']."'";
				$order_by		=	$order_by.",class_id ASC";
			}
			if($data['section_id'] != '')
			{
				$query_string	=	$query_string." and section_id = '".$data['section_id']."'";
				$order_by		=	$order_by.",section_id ASC";
			}
			if($data['student_id'] != '')
			{
				$query_string	=	$query_string." and student_id = '".$data['student_id']."'";
				$order_by		=	$order_by.",student_id ASC";
			}
			if($data['payment_filter'] == 1) // Students Paid After Due Date
			{
				$query_string	=	$query_string." and (fee_balance = '0' or fee_balance + fee_concession != fee_amount) and date_paid > due_date";
			}
			if($data['payment_filter'] == 2)// Students not paid and due date is over
			{
				$query_string	=	$query_string." and fee_balance = fee_amount and DATE_FORMAT(CURDATE(),'%Y%m%d') > due_date";
			}
			if($data['route_master_id'] != '')
			{
				$query_string	=	$query_string." and route_master_id = '".$data['route_master_id']."'";
			}
			if($data['route_register_id'] != '')
			{
				$query_string	=	$query_string." and route_register_id = '".$data['route_register_id']."'";
			}
		}
		if($data['report_type']=='vehicle_report')
		{
			if($data['route_master_id'] == '' && $data['route_register_id'] == '')
			{
				$query_string	=	"select * from view_transport_vehicle_master where branch_id = '".$data['branch_id']."' and is_deleted = 'N'";
			}
			else
			{
				$query_string	=	"select * from view_transport_route_register where branch_id = '".$data['branch_id']."' and is_deleted = 'N'";
				if($data['route_master_id'] != '')
				{
					$query_string	=	$query_string." and route_master_id = '".$data['route_master_id']."'";
				}
				if($data['route_register_id'] != '')
				{
					$query_string	=	$query_string." and route_register_id = '".$data['route_register_id']."'";
				}
			}
			$query			=	$this->db->query($query_string)->result_array();
			$result			=	array(
									'query'			=>	$query,
									//'installments'	=>	$installments
									);
		}
		if($data['report_type']=='vehicle_tax_due_report')
		{
			$query_string	=	"select * from view_transport_vehicle_master where branch_id = ".$data['branch_id']." and is_deleted = 'N'";
			if($data['tax_due_date']!='')
			{
				$query_string	=	$query_string." and tax_paid_to <= '".date('Y-m-d',strtotime($data['tax_due_date']))."'";
			}
			$query			=	$this->db->query($query_string)->result_array();
			//echo $this->db->last_query();die();
			$result			=	array(
									'query'			=>	$query
									);
		}
		if($data['report_type']=='vehicle_insurance_due_report')
		{
			$query_string	=	"select * from view_transport_vehicle_master where branch_id = ".$data['branch_id']." and is_deleted = 'N'";
			if($data['insurance_due_date']!='')
			{
				$query_string	=	$query_string." and insurance_date_to <= '".date('Y-m-d',strtotime($data['insurance_due_date']))."'";
			}
			$query			=	$this->db->query($query_string)->result_array();
			//echo $this->db->last_query();die();
			$result			=	array(
									'query'			=>	$query
									);
		}
		if($data['report_type']=='vehicle_pollution_due_report')
		{
			$query_string	=	"select * from view_transport_vehicle_master where branch_id = ".$data['branch_id']." and is_deleted = 'N'";
			if($data['pollution_due_date']!='')
			{
				$query_string	=	$query_string." and valid_upto <= '".date('Y-m-d',strtotime($data['pollution_due_date']))."'";
			}
			$query			=	$this->db->query($query_string)->result_array();
			//echo $this->db->last_query();die();
			$result			=	array(
									'query'			=>	$query
									);
		}
		if($data['report_type']=='fee_report')
		{
			$query_string	=	$query_string." order by student_id ASC,bus_fee_settings_id ASC";
			$query			=	$this->db->query($query_string)->result_array();
			// Get all active Installments
			$academic_year	=	get_running_year();
			$this->db->where('is_active','Y');
			$this->db->where('academic_year',$academic_year);
			$this->db->where('branch_id',$data['branch_id']);
			$installments	=	$this->db->get('tbl_transport_bus_fee_installment_settings')->result_array();
			$result			=	array(
									'query'			=>	$query,
									'installments'	=>	$installments
									);
			
		}
		if($data['report_type']=='student_report')
		{
			//$query_string	=	$query_string." group by bus_number";
			$query_string	=	$query_string." order by student_id ASC";
			$query			=	$this->db->query($query_string)->result_array();
			$query1			=	$this->db->query($query_string1)->result_array();
			$count			=	count($query1);
			$result			=	array(
									'query'			=>	$query,
									'count'			=>	$count
									);
		}
		
		$order_by		=	$order_by.",due_date ASC";
		//echo $this->db->last_query();
		//die();
		/*echo "<pre>";
		print_r($query);
		echo "</pre>";
		die();*/
		return $result;
	}
	
//2)Fee Report End

	function view_single_vehicle_report($vehicle_master_id)
	{
		$this->db->db_debug = FALSE;
		$this->db->where('vehicle_master_id',$vehicle_master_id);
		$this->db->db_debug = TRUE;
		return	$this->db->get('view_transport_vehicle_master')->result_array();
	}
/*****************ALL IN ONE REPORT END********************/
	
	
	
///////////////////////////////////////////////////////////////////////////////////////
}
