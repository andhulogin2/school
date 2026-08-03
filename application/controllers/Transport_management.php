<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transport_management extends CI_Controller {
 //vehicle class function
	function view_vehicle_class() 
	{
	
			
			$data['log']	=	 $this->Transport_management_model->get_vehicle_class();
			$this->load->view('transport_management/view_vehicle_class.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_class(); 
		//$this->load->view('transport_management/view_vehicle_class.php');
	}
	//vehicle ownership function
	
	
	function view_vehicle_ownership()
	{
		
			$data['log']	=	 $this->Transport_management_model->get_vehicle_ownership();
			$this->load->view('transport_management/view_vehicle_ownership.php',$data);
	         
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_ownership(); 
	//	$this->load->view('transport_management/view_vehicle_ownership.php');
	}
	//vehicle category function
function view_vehicle_category()
	{
	 
			
			$data['log']	=	 $this->Transport_management_model->get_vehicle_category();
			$this->load->view('transport_management/view_vehicle_category.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_category(); 
		//$this->load->view('transport_management/view_vehicle_category.php');
	}
	// vehicle running log book function
	
	function view_vehicle_running_log($vehicle_master_id)
	{
	
         $data['vehicle_master_id']	=	$vehicle_master_id;
		$data['log1']	=	 $this->Transport_management_model->get_vehicle_running_log($data['vehicle_master_id']); 
		
		$this->load->view('transport_management/view_vehicle_running_log.php',$data);
	}
	
	///////employee designation
	function view_vehicle_employee_designation()
	{
	$role=$this->session->userdata('role');
		$branch_id1=$this->session->userdata('branch_id');
		
		if($role == 1 || $role == 2)
		{
			
			$data['log']	=	 $this->Transport_management_model->get_vehicle_employee_designation();
			$this->load->view('transport_management/view_vehicle_employee_designation.php',$data);
		}
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_class(); 
		//$this->load->view('transport_management/view_vehicle_class.php');
	}
	
	
	//fuel log
	function view_vehicle_fuel_log($vehicle_master_id)
	{
	
	    $data['vehicle_master_id']	=	$vehicle_master_id;
		$data['log']	=	 $this->Transport_management_model->get_vehicle_fuel_log($data['vehicle_master_id']); 
		$this->load->view('transport_management/view_vehicle_fuel_log.php',$data);
		
	}
	
 function add_vehicle_fuel_log($vehicle_master_id) 
    {   
	   $data['vehicle_master_id']  = $vehicle_master_id;
	   $data['result']	=	 $this->Transport_management_model->get_vehicle_master(); 
      $this->load->view('transport_management/add_vehicle_fuel_log.php',$data);
		
    }
	function vehicle_fuel_log_add() 
    {
	   $data['vehicle_master_id']	=  $this->input->post('vehicle_master_id');
	   $data['date_filled']	= date('Y-m-d',strtotime($this->input->post('date_filled')));
		$data['meter_reading']	=  $this->input->post('meter_reading');
		$data['quantity_of_fuel_filled']	=  $this->input->post('quantity_of_fuel_filled');
		$data['fuel_price']	=  $this->input->post('fuel_price');
		$data['fuel_rate_per_litre']	=  $this->input->post('fuel_rate_per_litre');
		$data['fuel_filled_from']	=  $this->input->post('fuel_filled_from');
		$data['fuel_filled_by']=  $this->input->post('fuel_filled_by'); 
		
		$id =   $this->Transport_management_model->vehicle_fuel_log_insert($data);  
		
		if($id>0)
		{
		$action="success";
		}
		else
		{
		$action="duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_fuel_log/'.$data['vehicle_master_id']);
         //$this->load->view('admin/add_branch_users.php');
		
    }
	function vehicle_fuel_log_update($fuel_log_book_id)
	{
	
		$id=$fuel_log_book_id; 
		$data['vehicle_master_id']=$this->input->post('vehicle_master_id'); 
		$data['date_filled']=$this->input->post('date_filled'); 
		$data['meter_reading']=$this->input->post('meter_reading'); 
		$data['quantity_of_fuel_filled']=$this->input->post('quantity_of_fuel_filled'); 
		$data['fuel_price']=$this->input->post('fuel_price');
		$data['fuel_rate_per_litre']=$this->input->post('fuel_rate_per_litre'); 
		$data['fuel_filled_from']=$this->input->post('fuel_filled_from'); 
		$data['fuel_filled_by']=$this->input->post('fuel_filled_by'); 
		
		$num_rows_updated = 	$this->Transport_management_model->vehicle_fuel_log_update($data,$id);
		if($num_rows_updated > 0)
		{
		$action="updated";
		}
		else
		{
		$action="not_updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_fuel_log/'.$data['vehicle_master_id']);
		
        // $this->view_vehicle_ownership($ownership_type_id);
	}
	function vehicle_fuel_log_edit($fuel_log_book_id)
	{
	    $data['fuel_log_book_id']=$fuel_log_book_id;
		$data['log']	=	 $this->Transport_management_model->get_vehicle_fuel_log_edit($fuel_log_book_id);
	     $data['master']	=	$this->Transport_management_model->get_vehicle_master();
		$this->load->view('transport_management/edit_vehicle_fuel_log.php',$data);
	}
		function vehicle_fuel_log_delete($id,$vehicle_master_id)
{
	 $vehicle_master_id=$vehicle_master_id;
    $data=array('is_deleted' =>'Y','deleted_by' =>$this->session->userdata('login_user_id','user_id'),'deleted_date'=>date('Y-m-d'));
    $num_rows_deleted = 	$this->Transport_management_model->vehicle_fuel_log_update($data,$id);
		if($num_rows_deleted > 0)
		{
		$action="deleted";
		}
		else
		{
		$action="not_deleted";
		}
		$this->session->set_flashdata('action',$action);
         redirect('Transport_management/view_vehicle_fuel_log/'.$vehicle_master_id);
	
}
	
	//vehicle tax details functn
	function view_vehicle_tax_details($vehicle_master_id)
	{
		$data['vehicle_master_id']	=	$vehicle_master_id;
		$data['log']				=	$this->Transport_management_model->get_vehicle_tax_details($data['vehicle_master_id']); 
		$this->load->view('transport_management/view_vehicle_tax_details.php',$data);
	}
	function add_vehicle_tax_details($vehicle_master_id) 
    {
		$data['vehicle_master_id'] 	=	$vehicle_master_id;
	 	$data['result']				=	$this->Transport_management_model->get_vehicle_master();
        $this->load->view('transport_management/add_vehicle_tax_details.php',$data);
    }
	function vehicle_tax_details_add() 
    {
	   	$data['vehicle_master_id']	=  $this->input->post('vehicle_master_id');
		$data['tax_paid_on']		=  date('Y-m-d',strtotime($this->input->post('tax_paid_on')));
		$data['tax_paid_from']		=  date('Y-m-d',strtotime($this->input->post('tax_paid_from')));
		$data['tax_paid_to']		=  date('Y-m-d',strtotime($this->input->post('tax_paid_to')));
		$data['tax_amount']			=  $this->input->post('tax_amount');
		$data['tax_paid_office']	=  $this->input->post('tax_paid_office');
		$id =   $this->Transport_management_model->vehicle_tax_details_insert($data);  
		if($id>0)
		{
		$action="success";
		}
		else
		{
		$action="duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_tax_details/'.$data['vehicle_master_id']);
    }
	

	
	//tax edit
	
	function vehicle_tax_details_edit($vehicle_tax_details_id)
	{
	    $data['vehicle_tax_details_id']	=	$vehicle_tax_details_id;
		$data['log']					=	$this->Transport_management_model->get_vehicle_tax_details_edit($vehicle_tax_details_id);
	    $data['master']					=	$this->Transport_management_model->get_vehicle_master();
		$this->load->view('transport_management/edit_vehicle_tax_details.php',$data);
	}
	
	
	// tax update
	
function vehicle_tax_details_update($vehicle_tax_details_id)
	{
	
		$id							=	$vehicle_tax_details_id; 
		$data['vehicle_master_id']	=	$this->input->post('vehicle_master_id'); 
		$data['tax_paid_on']		=  date('Y-m-d',strtotime($this->input->post('tax_paid_on')));
		$data['tax_paid_from']		=  date('Y-m-d',strtotime($this->input->post('tax_paid_from')));
		$data['tax_paid_to']		=  date('Y-m-d',strtotime($this->input->post('tax_paid_to')));
		$data['tax_amount']			=	$this->input->post('tax_amount'); 
		$data['tax_paid_office']	=	$this->input->post('tax_paid_office'); 
		
		$num_rows_updated 			= 	$this->Transport_management_model->vehicle_tax_details_update($data,$id);
		if($num_rows_updated > 0)
		{
		$action="updated";
		}
		else
		{
		$action="not_updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_tax_details/'.$data['vehicle_master_id']);
		
        // $this->view_vehicle_ownership($ownership_type_id);
	}
	
	// tax delete
	
	
	function vehicle_tax_details_delete($id,$vehicle_master_id)
	{
		$vehicle_master_id	=	$vehicle_master_id;
  		$data=array('is_deleted' =>'Y','deleted_by' =>$this->session->userdata('login_user_id','user_id'),'deleted_date'=>date('Y-m-d'));
  		$num_rows_deleted = 	$this->Transport_management_model->vehicle_tax_details_update($data,$id);
		if($num_rows_deleted > 0)
		{
			$action="deleted";
		}
		else
		{
			$action="not_deleted";
		}
		$this->session->set_flashdata('action',$action);
         redirect('Transport_management/view_vehicle_tax_details/'.$vehicle_master_id);
	
}

	
	
	//ADD FUNCTION RUNNING_LOG
	
		function add_vehicle_running_log($vehicle_master_id) 
		
         {
	   $data['vehicle_master_id']  =  	$vehicle_master_id;
	   $data['result']=$this->Transport_management_model->get_vehicle_master();
	   	$designation				= 	"Driver";
	   	$data['driver']				=	$this->Transport_management_model->get_designation($designation);
        $this->load->view('transport_management/add_vehicle_running_log.php',$data);
		
        }



function vehicle_running_log_add() 
    {
	   $data['vehicle_master_id']	=  $this->input->post('vehicle_master_id');
		$data['date_of_entry']	=  date('y-m-d',strtotime($this->input->post('date_of_entry')));
		$data['starting_meter_reading']	=  $this->input->post('starting_meter_reading');
		$data['ending_meter_reading']	=  $this->input->post('ending_meter_reading');
		$data['driver_id']	=  $this->input->post('driver_id');
		$data['journey_from']	=  $this->input->post('journey_from');
		$data['journey_to']	=  $this->input->post('journey_to');
		$data['reason_for_trip']	=  $this->input->post('reason_for_trip');
		/*$data['quantity_of_fuel_filled']	=  $this->input->post('quantity_of_fuel_filled');
		$data['fuel_price']	=  $this->input->post('fuel_price');
		$data['fuel_rate_per_liter']	=  $this->input->post('fuel_rate_per_liter');
		$data['fuel_filled_from']	=  $this->input->post('fuel_filled_from');
		$data['fuel_filled_by']=  $this->input->post('fuel_filled_by'); */
		
		$id =   $this->Transport_management_model->vehicle_running_log_insert($data);  
		
		if($id>0)
		{
		$action="success";
		}
		else
		{
		$action="duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_running_log/'.$data['vehicle_master_id']);
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	
	// fuel add()
	

	function add_vehicle_class() 
    {
        $this->load->view('transport_management/add_vehicle_class.php');
		
    }
		function add_vehicle_ownership() 
    {
        $this->load->view('transport_management/add_vehicle_ownership.php');
		
    }
	
	function add_vehicle_category() 
    {
        $this->load->view('transport_management/add_vehicle_category.php');
		
    }
	function add_vehicle_employee_designation() 
    {
        $this->load->view('transport_management/add_vehicle_employee_designation.php');
		
    }
	
	function vehicle_category_add() 
    {
		$vehicle_category_name	=  $this->input->post('vehicle_category_name');
		
		$id =   $this->Transport_management_model->vehicle_category_insert($vehicle_category_name);  
		
		if($id>0)
		{
		$action="success";
		}
		else
		{
		$action="duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_category/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	function vehicle_ownership_add() 
    {
		$ownership_type	=  $this->input->post('ownership_type');
		
		$id =   $this->Transport_management_model->vehicle_ownership_insert($ownership_type);  
		
		if($id>0)
		{
		$action="success";
		}
		else
		{
		$action="duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_ownership/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	function vehicle_ownership_update($ownership_type_id)
	{
	
	
		$id=$ownership_type_id; 
		$data['ownership_type']=$this->input->post('ownership_type');
		
		$num_rows_updated = 	$this->Transport_management_model->vehicle_ownership_update($data,$id);
		if($num_rows_updated > 0)
		{
		$action="updated";
		}
		else
		{
		$action="not_updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_ownership/');
		
        // $this->view_vehicle_ownership($ownership_type_id);
	}
function vehicle_ownership_delete($id)
{
  $this->Transport_management_model->vehicle_ownership_delete($id);
		
         $this->view_vehicle_ownership();
	
}

	
	function vehicle_class_edit($vehicle_class_id='',$vehicle_class_name='')
	{
	
	
	
		$data['vehicle_class_id']=$vehicle_class_id; 
		$data['vehicle_class_name']=$vehicle_class_name; 
		$this->load->view('transport_management/edit_vehicle_class.php',$data);
	//	$this->load->view('transport_management/edit_vehicle_class.php',$data);
	}
	function vehicle_ownership_edit($ownership_type_id='',$ownership_type='')
	{
		$data['ownership_type_id']=$ownership_type_id; 
		$data['ownership_type']=$ownership_type; 
		$this->load->view('transport_management/edit_vehicle_ownership.php',$data);
	}
//vehicle category edit

	function vehicle_category_edit($vehicle_category_id='',$vehicle_category_name='')
	{
		$data['vehicle_category_id']=$vehicle_category_id; 
		$data['vehicle_category_name']=$vehicle_category_name; 
		$this->load->view('transport_management/edit_vehicle_category.php',$data);
		
		/////////////////////////////RUNNING LOG--------------///////////////
	}
	//vehicle running log edit
	function vehicle_running_log_edit($running_log_id)
	{
	    $data['running_log_id']=$running_log_id;
	$data['log']	=	 $this->Transport_management_model->get_vehicle_running_log_edit($running_log_id);
	$data['master']	=	$this->Transport_management_model->get_vehicle_master();
	$designation				= 	"Driver";
		$data['driver']				=	$this->Transport_management_model->get_designation($designation);
    $this->load->view('transport_management/edit_vehicle_running_log.php',$data);
	}



function vehicle_running_log_update($running_log_id)
	{
	
		$id=$running_log_id; 
		$data['vehicle_master_id']=$this->input->post('vehicle_master_id'); 
		$data['date_of_entry']= date('Y-m-d',strtotime($this->input->post('date_of_entry')));
		$data['starting_meter_reading']=$this->input->post('starting_meter_reading'); 
		$data['ending_meter_reading']=$this->input->post('ending_meter_reading'); 
		$data['journey_from']=$this->input->post('journey_from'); 
		$data['starting_meter_reading']=$this->input->post('starting_meter_reading'); 
		$data['journey_to']=$this->input->post('journey_to'); 
		$data['fuel_price']=$this->input->post('fuel_price');
		$data['fuel_filled_by']=$this->input->post('fuel_filled_by');
		$data['reason_for_trip']=$this->input->post('reason_for_trip'); 
		
		$num_rows_updated = 	$this->Transport_management_model->vehicle_running_log_update($data,$id);
		if($num_rows_updated > 0)
		{
		$action="updated";
		}
		else
		{
		$action="not_updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_running_log/'.$data['vehicle_master_id']);
		
        // $this->view_vehicle_ownership($ownership_type_id);
	}
	
	
	
	//running log delete
	
	function vehicle_running_log_delete($id,$vehicle_master_id)
{
$vehicle_master_id 	=	$vehicle_master_id;
  $data=array('is_deleted' =>'Y','deleted_by' =>$this->session->userdata('login_user_id','user_id'),'deleted_date'=>date('Y-m-d'));
  $num_rows_deleted = 	$this->Transport_management_model->vehicle_running_log_update($data,$id);
		if($num_rows_deleted > 0)
		{
		$action="deleted";
		}
		else
		{
		$action="not_deleted";
		}
		$this->session->set_flashdata('action',$action);
		
         redirect('Transport_management/view_vehicle_running_log/'.$vehicle_master_id);
	
}
//////////////////////////FUEL---------------------------//////////////////
	
	
	//fuel update
	


//vehicle category update
function vehicle_category_update($vehicle_category_id)
	{
	
	
		$id=$vehicle_category_id; 
		$data['vehicle_category_name']=$this->input->post('vehicle_category_name');
		
		$num_rows_updated = 	$this->Transport_management_model->vehicle_category_update($data,$id);
		if($num_rows_updated > 0)
		{
		$action="updated";
		}
		else
		{
		$action="not_updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_category/');
		
        // $this->view_vehicle_ownership($ownership_type_id);
	}
	
	
	function vehicle_category_delete($id)
{
  
  $num_rows_deleted = 	$this->Transport_management_model->vehicle_category_delete($id);
		if($num_rows_deleted > 0)
		{
		$action="deleted";
		}
		else
		{
		$action="not_deleted";
		}
		$this->session->set_flashdata('action',$action);
         redirect('Transport_management/view_vehicle_category');
	
}



// code written by mani

// VEHICLE MAKER CLASS

	function view_vehicle_maker()
	{
	
	   
			
			$data['log']	=	 $this->Transport_management_model->get_vehicle_maker();
			$this->load->view('transport_management/view_vehicle_maker.php',$data);
		
		//$data['log']	=	 $this->Transport_management_model->get_vehicle_maker(); 
		//$this->load->view('transport_management/view_vehicle_maker.php');
	}

	function add_vehicle_maker() 
    {
        $this->load->view('transport_management/add_vehicle_maker.php');
		
    }

	function vehicle_maker_add() 
    {
		$vehicle_maker_name		=	$this->input->post('vehicle_maker_name');
		
		$vehicle_maker 			=  	$this->Transport_management_model->vehicle_maker_insert($vehicle_maker_name);
		
		if($vehicle_maker>0)
		{
			$action = "Inserted";
		}
		else
		{
			$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('Transport_management/view_vehicle_maker/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	
	function vehicle_maker_edit($vehicle_maker_id='',$vehicle_maker_name='')
	{
	
	
		$data['vehicle_maker_id']	=	$vehicle_maker_id; 
		$data['vehicle_maker_name']	=	$vehicle_maker_name; 
		$this->load->view('transport_management/edit_vehicle_maker.php',$data);
	}
	
	function vehicle_maker_update($vehicle_maker_id)
	{
		
		$data	=	array(
		        	'vehicle_maker_name' => $this->input->post('vehicle_maker_name')
								
					);
	    			$num_rows_updated = $this->Transport_management_model->vehicle_maker_update($data,$vehicle_maker_id);
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
					redirect('Transport_management/view_vehicle_maker/');
					
	}
	
	function vehicle_maker_delete($vehicle_maker_id)
	{
		
		$num_rows_affected = $this->Transport_management_model->vehicle_maker_delete($vehicle_maker_id);
		if($num_rows_affected > 0)
		{
		$action = "Deleted";
		}
		else
		{
		$action = "Failed";
		}
		$this->session->set_flashdata('action',$action);
        $this->view_vehicle_maker();
	}
	
	
	// vehicle class
	
		function vehicle_class_add() 
    {
		$vehicle_class_name		=	$this->input->post('vehicle_class_name');
		
		$vehicle_class 			=  	$this->Transport_management_model->vehicle_class_insert($vehicle_class_name);
		
		if($vehicle_class>0)
		{
			$action = "Inserted";
		}
		else
		{
			$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('Transport_management/view_vehicle_class/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	function vehicle_class_update($vehicle_class_id)
	{
		
	$data=array(
		        'vehicle_class_name' => $this->input->post('vehicle_class_name')
								
				);
	    $num_affected_rows = $this->Transport_management_model->vehicle_class_update($data,$vehicle_class_id);
		if($num_affected_rows > 0)
		{
		$action = "Updated";
		}
		else
		{
		$action = "Not updated";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_class');
	}
	function vehicle_class_delete($vehicle_class_id)
	{
	$num_rows_affected = $this->Transport_management_model->vehicle_class_delete($vehicle_class_id);
	if($num_rows_affected > 0)
	{
	$action = "Deleted";
	}
	else
	{
	$action = "Failed";
	}
	$this->session->set_flashdata('action',$action);
	redirect('Transport_management/view_vehicle_class');
	}
	
//*****************************employee designation
	function vehicle_employee_designation_add() 
    {
		$employee_designation		=	$this->input->post('employee_designation');
		
		$employee_designation 			=  	$this->Transport_management_model->vehicle_employee_designation_insert($employee_designation);
		
		if($employee_designation>0)
		{
			$action = "Inserted";
		}
		else
		{
			$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		
		redirect('Transport_management/view_vehicle_employee_designation/');
         //$this->load->view('admin/add_branch_users.php');
		
    }
	

	
//VEHICLE MASTER
function view_vehicle_master()
	{
		$data['log']	=	 $this->Transport_management_model->get_vehicle_master(); 
		$this->load->view('transport_management/view_vehicle_master.php');
	}
	function view_single_vehicle_master($vehicle_master_id='')
	{
	
	
		$result['vehicle_master_id']=	$vehicle_master_id; 
		$result['ownership']		=	$this->	Transport_management_model->get_vehicle_ownership1();
		$result['category']			=	$this->	Transport_management_model->get_vehicle_category1();
		$result['vehicle_class']	=	$this->	Transport_management_model->get_vehicle_class1();
		$result['maker']			=	$this->	Transport_management_model->get_vehicle_maker1();
		$result['branch']			=	$this->	Transport_management_model->get_vehicle_branch1();
		$result['vehicle_master']	=	$this->Transport_management_model->get_single_vehicle_master($result['vehicle_master_id']);
		$this->load->view('transport_management/view_vehicle_master_single.php',$result);
	}

	function add_vehicle_master() 
    {
	$data['ownership']=$this->Transport_management_model->get_vehicle_ownership1();
	$data['class']=$this->Transport_management_model->get_vehicle_class1();
	$data['maker']=$this->Transport_management_model->get_vehicle_maker1();
	$data['category']=$this->Transport_management_model->get_vehicle_category1();
	$data['branch']=$this->Transport_management_model->get_vehicle_branch1();
    $data['months'] 	= 	array('January','February','March','April','May','June','July','August','September','October','November','December');
        $this->load->view('transport_management/add_vehicle_master.php',$data);
		
    }


function vehicle_master_add()
	{
		$data['vehicle_registration_number']	=	$this->input->post('vehicle_registration_number');
		$data['bus_number']						=	$this->input->post('bus_number');
		if($this->input->post('registration_date')=='')
		{
			$data['registration_date']			=	"";
		}
		else
		{
			$data['registration_date']			=	date('Y-m-d',strtotime($this->input->post('registration_date')));
		}
		$data['owner_name']						=	$this->input->post('owner_name');
		$data['ownership_type_id']				=	$this->input->post('ownership_type_id');
		if($data['ownership_type_id']=='')
		{
			$data['ownership_type_id'] = NULL;
		}
		$data['vehicle_category_id']			=	$this->input->post('vehicle_category_id');
		if($data['vehicle_category_id']=='')
		{
			$data['vehicle_category_id'] = NULL;
		}

		$data['vehicle_class_id']				=	$this->input->post('vehicle_class_id');
		if($data['vehicle_class_id']=='')
		{
			$data['vehicle_class_id'] = NULL;
		}
		$data['vehicle_maker_id']				=	$this->input->post('vehicle_maker_id');
		if($data['vehicle_maker_id']=='')
		{
			$data['vehicle_maker_id'] = NULL;
		}
		$data['vehicle_number']					=	$this->input->post('vehicle_number');
		$data['seat_capacity']					=	$this->input->post('seat_capacity');
		$data['tax_licence_number']				=	$this->input->post('tax_licence_number');
		$data['year_of_manufacture']			=	$this->input->post('year_of_manufacture');
		$data['month_of_manufacture']			=	$this->input->post('month_of_manufacture');
		$data['branch_id']						=	$this->input->post('branch_id');
		$data['remarks']						=	$this->input->post('remarks');
		
		$vehicle_master							=	$this->Transport_management_model->vehicle_master_insert($data);
		if($vehicle_master > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_details/');
	}
	function vehicle_master_edit($vehicle_master_id)
	{
	$data['vehicle_master_id']	=	$vehicle_master_id;
	$data['log']				=	$this->Transport_management_model->get_vehicle_master_edit($vehicle_master_id);
	$data['master1']			=	$this->Transport_management_model->get_vehicle_master1(); 
	$data['ownership']			=	$this->Transport_management_model->get_vehicle_ownership1();
	$data['class']				=	$this->Transport_management_model->get_vehicle_class1();
	$data['maker']				=	$this->Transport_management_model->get_vehicle_maker1();
	$data['category']			=	$this->Transport_management_model->get_vehicle_category1();
	$data['branch']				=	$this->Transport_management_model->get_vehicle_branch1();
	$data['months']				= 	array('January','February','March','April','May','June','July','August','September','October','November','December');
     $this->load->view('transport_management/edit_vehicle_master.php',$data);
	}
	function vehicle_master_update($vehicle_master_id)
	{
		$data	=	array(
		        	'vehicle_registration_number' 	=> $this->input->post('vehicle_registration_number'),
		        	'bus_number' 					=> $this->input->post('bus_number'),
		        	'registration_date' 			=> date('Y-m-d',strtotime($this->input->post('registration_date'))),
		        	'owner_name' 					=> $this->input->post('owner_name'),
		        	'ownership_type_id' 			=> $this->input->post('ownership_type_id'),
		        	'vehicle_category_id' 			=> $this->input->post('vehicle_category_id'),
		        	'vehicle_class_id' 				=> $this->input->post('vehicle_class_id'),
		        	'vehicle_maker_id' 				=> $this->input->post('vehicle_maker_id'),
		        	'vehicle_number' 				=> $this->input->post('vehicle_number'),
		        	'seat_capacity' 				=> $this->input->post('seat_capacity'),
		        	'tax_licence_number' 			=> $this->input->post('tax_licence_number'),
		        	'year_of_manufacture' 			=> $this->input->post('year_of_manufacture'),
		        	'month_of_manufacture'		 	=> $this->input->post('month_of_manufacture'),
		        	'branch_id' 					=> $this->input->post('branch_id'),								
		        	'remarks'	 					=> $this->input->post('remarks')								
					);
		if($data['ownership_type_id']=='')
		{
			$data['ownership_type_id'] = NULL;
		}
		if($data['vehicle_category_id']=='')
		{
			$data['vehicle_category_id'] = NULL;
		}
		if($data['vehicle_class_id']=='')
		{
			$data['vehicle_class_id'] = NULL;
		}
		if($data['vehicle_maker_id']=='')
		{
			$data['vehicle_maker_id'] = NULL;
		}
		
	    $num_rows_updated = $this->Transport_management_model->vehicle_master_update($data,$vehicle_master_id);
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
					redirect('Transport_management/view_vehicle_details/');
					
	}
	function vehicle_master_delete($vehicle_master_id)
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user-id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_master_delete($data,$vehicle_master_id);
		if($num_rows_affected > 0)
		{
		$action = "Success";
		}
		else
		{
		$action = "Failed";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_details/'.$vehicle_master_id);
	}
	function check_bus_number($bus_number='',$branch_id='')
	{
		$result=$this->Transport_management_model->check_bus_number($bus_number,$branch_id);
		if(count($result) > 0)
		{
			echo 'Bus number alredy exist in this branch.';
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
		}
		else
		{
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';
		}
	}
	function check_bus_number_by_route($branch_id='',$route_master_id='',$vehicle_master_id='')
	{
		$result	=	$this->Transport_management_model->check_bus_number_by_route($branch_id,$route_master_id,$vehicle_master_id);
		if(count($result) > 0)
		{
			echo "1";
/*			echo 'Bus number alredy exist in this route.';
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
*/		}
		else
		{
			echo "0";
			/*echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';*/
		}
	}
	function check_driver_by_route($branch_id='',$route_master_id='',$driver_id='')
	{
		$result	=	$this->Transport_management_model->check_driver_by_route($branch_id,$route_master_id,$driver_id);
		if(count($result) > 0)
		{
			echo 'Driver alredy registered in this route.';
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
		}
		else
		{
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';
		}
	}

///////---------
function get_reg($vehicle_registration_number='')
{


$result=$this->Transport_management_model->vehicle_master_check($vehicle_registration_number);
if(count($result) > 0)
{
echo 'Alredy Exist.';
echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
}
else
{
echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';

}

}




	function view_vehicle_details()
	{
		$data['result'] = $this->Transport_management_model->get_vehicle_master();
		$this->load->view('transport_management/view_vehicle_details.php',$data);
	}



	function enquiry() 
    {
     $this->load->view('admin/enquiry/enquiry_form');
    }
	
	function get_district($state_id) 
    {
      $page_data['state_id'] = $state_id; 
      $this->load->view('admin/enquiry/get_state' ,$page_data);
    }
	
	function today_call_view($enquiry_id='')
    {
       $data['enquiry_id']=$enquiry_id;
		$this->load->view('admin/enquiry/today_call_details_view',$data);
    }
	
function add_call_details($enquiry_id='')
	{
		 	 $call_date=  date("Y-m-d", strtotime($this->input->post('date')));;
		 	 $follow_up_date=  date("Y-m-d", strtotime($this->input->post('call_date')));;

		 $d=array(
	           'call_id'=>'null',
			   'enquiry_id'=>$enquiry_id,
			   'date'=> $call_date,
			   'next_followup_date'=> $follow_up_date,
			   'time'=>$this->input->post('time'),
	           'name'=>$this->input->post('name'),
	           'remark'=>$this->input->post('remark')
		
			   );
		
            $result=$this->enquiry_model->insert_call_details($d);
			if($result>0){
			$data["action"]="success";
			}
			  //redirect(base_url() . 'index.php/enquiry_controller/view_call_details/'.$enquiry_id,'refresh');
           		$this->load->view('admin/enquiry/call_form.php',$data);

    	   
	}
	
	
	
	///////////////****************----------------------------code by manikantan----------------
	
		function view_vehicle_maintenance_log_book($vehicle_master_id)
	{
		$data['vehicle_master_id']	=	$vehicle_master_id;
		$data['result']				=	$this->Transport_management_model->get_vehicle_maintenance_log_book($data['vehicle_master_id']);
		$this->load->view('transport_management/view_vehicle_maintenance_log_book.php',$data);
	}
	function add_vehicle_maintenance_log_book($vehicle_master_id) 
    {
		$data['vehicle_master_id']	=	$vehicle_master_id;
		$data['result']				=	$this->Transport_management_model->get_vehicle_master();
		$designation				= 	"Driver";
		$data['driver']				=	$this->Transport_management_model->get_designation($designation);
        $this->load->view('transport_management/add_vehicle_maintenance_log_book.php',$data);
		
    }
	function vehicle_maintenance_log_book_add()
	{
		$data['vehicle_master_id']				=	$this->input->post('vehicle_master_id');
		$data['date_of_entry']					=	date('Y-m-d',strtotime($this->input->post('date_of_entry')));
		$data['maintenance_work_done']			=	$this->input->post('maintenance_work_done');
		$data['maintenance_work_done_from']		=	$this->input->post('maintenance_work_done_from');
		$data['maintenance_work_cost']			=	$this->input->post('maintenance_work_cost');
		$data['driver_id']						=	$this->input->post('driver_id');
		
		$num_rows_updated						=	$this->Transport_management_model->vehicle_maintenance_log_book_insert($data);
		if($num_rows_updated > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_maintenance_log_book/'.$data['vehicle_master_id']);
	}
	function vehicle_maintenance_log_book_edit($maintenance_log_book_id='')
	{
		$data['maintenance_log_book_id']	=	$maintenance_log_book_id; 
		$data['maintenance_log']			=	$this->Transport_management_model->get_single_maintenance_log_book($maintenance_log_book_id);
		$data['vehicle_master']				=	$this->Transport_management_model->get_vehicle_master();
		$designation						= 	"Driver";
		$data['driver']						=	$this->Transport_management_model->get_designation($designation);
		$this->load->view('transport_management/edit_vehicle_maintenance_log_book.php',$data);
	}
	function vehicle_maintenance_log_book_update($maintenance_log_book_id)
	{
		$data	=	array(
		        	'vehicle_master_id' 			=>	$this->input->post('vehicle_master_id'),
		        	'date_of_entry' 				=> 	date('Y-m-d',strtotime($this->input->post('date_of_entry'))),
		        	'maintenance_work_done' 		=> 	$this->input->post('maintenance_work_done'),
		        	'maintenance_work_done_from' 	=> 	$this->input->post('maintenance_work_done_from'),
		        	'maintenance_work_cost' 		=> 	$this->input->post('maintenance_work_cost'),
		        	'driver_id' 					=> 	$this->input->post('driver_id')								
					);
	    			$num_rows_updated = $this->Transport_management_model->vehicle_maintenance_log_book_update($data,$maintenance_log_book_id);
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
					redirect('Transport_management/view_vehicle_maintenance_log_book/'.$data['vehicle_master_id']);
					
	}
	function vehicle_maintenance_log_book_delete($maintenance_log_book_id,$vehicle_master_id)
	{
		$vehicle_master_id	=	$vehicle_master_id;
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_maintenance_log_book_update($data,$maintenance_log_book_id);
		if($num_rows_affected > 0)
		{
		$action = "Deleted";
		}
		else
		{
		$action = "Failed";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_maintenance_log_book/'.$vehicle_master_id);
	}
	///insurance
	
	function view_vehicle_insurance_details($vehicle_master_id)
	{
	    $data['vehicle_master_id']	=	$vehicle_master_id;
		$data['result']		=	$this->Transport_management_model->get_vehicle_insurance_details($data['vehicle_master_id']);
		$this->load->view('transport_management/view_vehicle_insurance_details.php',$data);
	}
	function add_vehicle_insurance_details($vehicle_master_id) 
    {
	    $data['vehicle_master_id']	=	$vehicle_master_id;
		$data['vehicle_master']		=	$this->Transport_management_model->get_vehicle_master();	
        $this->load->view('transport_management/add_vehicle_insurance_details.php',$data);
		
    }
	function vehicle_insurance_details_add()
	{
		$data['vehicle_master_id']				=	$this->input->post('vehicle_master_id');
		$data['insurance_policy_number']		=	$this->input->post('insurance_policy_number');
		$data['insurance_date_from']			=	date('Y-m-d',strtotime($this->input->post('insurance_date_from')));
		$data['insurance_date_to']				=	date('Y-m-d',strtotime($this->input->post('insurance_date_to')));
		$data['insurance_amount']				=	$this->input->post('insurance_amount');
		$data['insurance_type']					=	$this->input->post('insurance_type');
		$data['insurance_company']				=	$this->input->post('insurance_company');
		
		$num_rows_updated						=	$this->Transport_management_model->vehicle_insurance_details_insert($data);
		if($num_rows_updated > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_insurance_details/'.$data['vehicle_master_id']);
	}
	function vehicle_insurance_details_edit($vehicle_insurance_details_id='')
	{
		$data['vehicle_insurance_details_id']	=	$vehicle_insurance_details_id; 
		$data['insurance_details']				=	$this->Transport_management_model->get_single_insurance_details($vehicle_insurance_details_id);
		$data['vehicle_master']							=	$this->Transport_management_model->get_vehicle_master();	
		$this->load->view('transport_management/edit_vehicle_insurance_details.php',$data);
	}
	function vehicle_insurance_details_update($vehicle_insurance_details_id)
	{
		
		$data	=	array(
		        	'vehicle_master_id' 			=> $this->input->post('vehicle_master_id'),
		        	'insurance_policy_number' 		=> $this->input->post('insurance_policy_number'),
		        	'insurance_date_from' 			=> date('Y-m-d',strtotime($this->input->post('insurance_date_from'))),
		        	'insurance_date_to' 			=> date('Y-m-d',strtotime($this->input->post('insurance_date_to'))),
		        	'insurance_amount' 				=> $this->input->post('insurance_amount'),
		        	'insurance_type' 				=> $this->input->post('insurance_type'),
		        	'insurance_company' 			=> $this->input->post('insurance_company')								
					);
	    			$num_rows_updated = $this->Transport_management_model->vehicle_insurance_details_update($data,$vehicle_insurance_details_id);
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
					redirect('Transport_management/view_vehicle_insurance_details/'.$data['vehicle_master_id']);
					
	}
	function vehicle_insurance_details_delete($vehicle_insurance_details_id,$vehicle_master_id)
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_insurance_details_update($data,$vehicle_insurance_details_id);
		if($num_rows_affected > 0)
		{
		$action = "Deleted";
		}
		else
		{
		$action = "Failed";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_insurance_details/'.$vehicle_master_id);
	}
/**************Pollution Test Start***********/	

	function view_vehicle_pollution_test_details($vehicle_master_id)
	{
	    $data['vehicle_master_id']	=	$vehicle_master_id;
		$data['result']				=	$this->Transport_management_model->get_vehicle_pollution_test_details($data['vehicle_master_id']);
		$this->load->view('transport_management/view_vehicle_pollution_test_details.php',$data);
	}
	function add_vehicle_pollution_test_details($vehicle_master_id) 
    {
	    $data['vehicle_master_id']	=	$vehicle_master_id;
		$data['vehicle_master']		=	$this->Transport_management_model->get_vehicle_master();	
        $this->load->view('transport_management/add_vehicle_pollution_test_details.php',$data);
		
    }
	function vehicle_pollution_test_details_add()
	{
		$data['vehicle_master_id']				=	$this->input->post('vehicle_master_id');
		$data['date_of_test']					=	date('Y-m-d',strtotime($this->input->post('date_of_test')));
		$data['rpm_minimum']					=	$this->input->post('rpm_minimum');
		$data['rpm_maximum']					=	$this->input->post('rpm_maximum');
		$data['status']							=	$this->input->post('status');
		$data['valid_upto']						=	date('Y-m-d',strtotime($this->input->post('valid_upto')));
		$data['amount']							=	$this->input->post('amount');
		$data['paid_by']						=	$this->input->post('paid_by');
		$data['test_done_from']					=	$this->input->post('test_done_from');
		
		$num_rows_updated						=	$this->Transport_management_model->vehicle_pollution_test_details_insert($data);
		if($num_rows_updated > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_pollution_test_details/'.$data['vehicle_master_id']);
	}
	function vehicle_pollution_test_details_edit($vehicle_pollution_test_details_id='')
	{
		$data['vehicle_pollution_test_details_id']	=	$vehicle_pollution_test_details_id; 
		$data['pollution_test_details']				=	$this->Transport_management_model->get_single_pollution_test_details($vehicle_pollution_test_details_id);
		$data['vehicle_master']						=	$this->Transport_management_model->get_vehicle_master();	
		$this->load->view('transport_management/edit_vehicle_pollution_test_details.php',$data);
	}
	function vehicle_pollution_test_details_update($vehicle_pollution_test_details_id)
	{
		
		$data	=	array(
		        	'vehicle_master_id' 	=> $this->input->post('vehicle_master_id'),
		        	'date_of_test' 			=> date('Y-m-d',strtotime($this->input->post('date_of_test'))),
		        	'rpm_minimum' 			=> $this->input->post('rpm_minimum'),
		        	'rpm_maximum' 			=> $this->input->post('rpm_maximum'),
		        	'status' 				=> $this->input->post('status'),
		        	'valid_upto' 			=> date('Y-m-d',strtotime($this->input->post('valid_upto'))),
		        	'amount' 				=> $this->input->post('amount'),								
		        	'paid_by' 				=> $this->input->post('paid_by'),								
		        	'test_done_from' 		=> $this->input->post('test_done_from')								
					);
	    			$num_rows_updated = $this->Transport_management_model->vehicle_pollution_test_details_update($data,$vehicle_pollution_test_details_id);
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
					redirect('Transport_management/view_vehicle_pollution_test_details/'.$data['vehicle_master_id']);
					
	}
	function vehicle_pollution_test_details_delete($vehicle_pollution_test_details_id,$vehicle_master_id)
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_pollution_test_details_update($data,$vehicle_pollution_test_details_id);
		if($num_rows_affected > 0)
		{
		$action = "Deleted";
		}
		else
		{
		$action = "Failed";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_pollution_test_details/'.$vehicle_master_id);
	}
/**************Pollution Test End*************/	

///----route master----------
	function view_vehicle_route_master()
	{
		$data['result']		=	$this->Transport_management_model->get_vehicle_route_master();
		$this->load->view('transport_management/view_vehicle_route_master',$data);
	}
	function add_vehicle_route_master() 
    {
		$data['result']		=	$this->Transport_management_model->get_vehicle_route_master();
		$data['branch']     =   $this->Transport_management_model->get_vehicle_branch1();
        $this->load->view('transport_management/add_vehicle_route_master.php',$data);
		
    }
	function vehicle_route_master_add()
	{
		//$data['route_master_id']				=	$this->input->post('route_master_id');
		$data['route_master_name']				=	$this->input->post('route_master_name');
		$data['route_number']				    =	$this->input->post('route_number');
		$data['route_description']				=	$this->input->post('route_description');
		$data['year']							=	get_running_year();
		$data['branch_id']				        =	$this->input->post('branch_id');
		
		$num_rows_updated			=	$this->Transport_management_model->vehicle_route_master_insert($data);
		if($num_rows_updated > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_route_master');
	}
	
	function vehicle_route_master_edit($route_master_id='')
	{
		$data['route_master_id']	=	$route_master_id; 
		//$data['master1']	=	$this->Transport_management_model->get_vehicle_master(); 
		$data['route_master']			=	$this->Transport_management_model->get_single_route_master($route_master_id);
		$data['branch']				=	$this->Transport_management_model->get_vehicle_branch1();
		$this->load->view('transport_management/edit_vehicle_route_master.php',$data);
	}
	
	function vehicle_route_master_update($route_master_id)
	{
		$data	=	array(
		        //	'route_master_id' 			=>	$this->input->post('route_master_id'),
		        	'route_master_name' 		=>	$this->input->post('route_master_name'),	
		        	'route_number' 		=> 	$this->input->post('route_number'),
		        	'route_description' 	=> 	$this->input->post('route_description'),
		        	'branch_id' 		=> 	$this->input->post('branch_id'),
		        								
					);
	    			$num_rows_updated = $this->Transport_management_model->vehicle_route_master_update($data,$route_master_id);
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
					redirect('Transport_management/view_vehicle_route_master/');
					
	}
	function vehicle_route_master_delete($route_master_id='')
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_route_master_delete($data,$route_master_id);
		if($num_rows_affected > 0)
		{
			$action = "Deleted";
		}
		else if($num_rows_affected == 0)
		{
			$action = "Failed";
		}
		else
		{
			$action = "Used";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_route_master');
	}
	function check_route_name($route_master_name='',$branch_id='')
	{
		$result=$this->Transport_management_model->check_route_name($route_master_name,$branch_id);
		if(count($result) > 0)
		{
			echo 'Route name alredy exist.';
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
		}
		else
		{
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';
		}
	}
	function check_route_number($route_number='',$branch_id='')
	{
		$result=$this->Transport_management_model->check_route_number($route_number,$branch_id);
		if(count($result) > 0)
		{
			echo 'Route number alredy exist.';
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
		}
		else
		{
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';
		}
	}

	//************ROUTE DETAILS
	function view_vehicle_route_details($route_master_id='')
	{
		$data['route_master_id']	=	$route_master_id;
		$query						=	$this->Transport_management_model->get_vehicle_route_details($data['route_master_id']);
		$data['result']				=	$query['result'];
		$data['route_master_name']	=	$query['route_master_name'];
		$data['route_number']		=	$query['route_number'];
		$this->load->view('transport_management/view_vehicle_route_details',$data);
	}
	function add_vehicle_route_details($route_master_id='') 
    {
		$data['route_master_id']	=	$route_master_id;
		$data['master']				=	$this->Transport_management_model->get_vehicle_route_master();
        $this->load->view('transport_management/add_vehicle_route_details.php',$data);
		
    }
	function add_vehicle_route_details_bulk($route_master_id='') 
    {
		$data['route_master_id']	=	$route_master_id;
		$data['master']				=	$this->Transport_management_model->get_vehicle_route_master();
        $this->load->view('transport_management/add_vehicle_route_details_bulk.php',$data);
		
    }
	function vehicle_route_details_add()
	{
		//$data['route_details_id']				=	$this->input->post('route_details_id');
		$data['route_master_id']			=	$this->input->post('route_master_id');
		$data['pickup_point']				=	$this->input->post('pickup_point');
		$data['pickup_point_lattitude']		=	$this->input->post('pickup_point_lattitude');
		$data['pickup_point_longitude']		=	$this->input->post('pickup_point_longitude');
	    $data['distance']					=	$this->input->post('distance');
		$data['base_fare']					=	$this->input->post('base_fare');
		
		$num_rows_updated					=	$this->Transport_management_model->vehicle_route_details_insert($data);
		
		if($num_rows_updated > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_route_details/'.$data['route_master_id']);
	}
	
	function vehicle_route_details_add_bulk()
	{ 
		//$data['route_details_id']				=	$this->input->post('route_details_id');
		if(isset($_POST['route_master_id']))
		{
			$data['route_master_id']				=	$this->input->post('route_master_id');
			$pickup_point							=	$this->input->post('pickup_point[]');
			$pickup_point_lattitude					=	$this->input->post('pickup_point_lattitude[]');
			$pickup_point_longitude					=	$this->input->post('pickup_point_longitude[]');
			$distance								=	$this->input->post('distance[]');
			$base_fare								=	$this->input->post('base_fare[]');
			$this->db->db_debug						=	FALSE;
			$this->db->trans_start();
			for($i=0;$i<count($pickup_point);$i++)
			{
				$data['pickup_point']				=	$pickup_point[$i];
				$data['pickup_point_lattitude']		=	$pickup_point_lattitude[$i];
				$data['pickup_point_longitude']		=	$pickup_point_longitude[$i];
				$data['distance']					=	$distance[$i];
				$data['base_fare']					=	$base_fare[$i];
				if($data['pickup_point']!='' && $data['base_fare'])
				{
					$num_rows_updated				=	$this->Transport_management_model->vehicle_route_details_insert($data);
				}
			}
			$this->db->trans_complete();
			if($this->db->trans_status() === FALSE)
			{
				$action		=	"Failed";
			}
			else
			{
				$action		=	"Inserted";
			}
/*			if($num_rows_updated > 0)
			{
			$action = "Inserted";
			}
			else
			{
			$action = "Duplicate";
			}
*/			
			$this->session->set_flashdata('action',$action);
		}	
		redirect('Transport_management/view_vehicle_route_details/'.$data['route_master_id']);
	}
	
	function vehicle_route_details_edit($route_details_id='')
	{
		$data['route_details_id']	=	$route_details_id; 
		$data['master']				=	$this->Transport_management_model->get_vehicle_route_master();
		$data['route_details']		=	$this->Transport_management_model->get_single_route_details($route_details_id);
		
		$this->load->view('transport_management/edit_vehicle_route_details.php',$data);
	}
	
	function vehicle_route_details_update($route_details_id='')
	{
		$data	=	array(
						'route_master_id'			=>	$this->input->post('route_master_id'),
						'pickup_point' 				=> 	$this->input->post('pickup_point'),
						'pickup_point_lattitude' 	=> 	$this->input->post('pickup_point_lattitude'),
						'pickup_point_longitude' 	=> 	$this->input->post('pickup_point_longitude'),
						'distance' 					=> 	$this->input->post('distance'),	
						'base_fare' 				=> 	$this->input->post('base_fare'),						
						);
		$num_rows_updated = $this->Transport_management_model->vehicle_route_details_update($data,$route_details_id);
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
		redirect('Transport_management/view_vehicle_route_details/'.$data['route_master_id']);
					
	}
	function vehicle_route_details_delete($route_details_id='',$route_master_id='')
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_route_details_delete($data,$route_details_id);
		if($num_rows_affected > 0)
		{
			$action = "Deleted";
		}
		else if($num_rows_affected == 0)
		{
			$action = "Failed";
		}
		else if($num_rows_affected == -1)
		{
			$action = "Exist";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_route_details/'.$route_master_id);
	}	

	function check_pickup_point($pickup_point='',$route_master_id='')
	{	
		
		
		$result=$this->Transport_management_model->check_pickup_point($pickup_point,$route_master_id);
		if(count($result) > 0)
		{
			echo '1';
			/*echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';*/
		}
		else
		{
			echo '0';
			/*echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';*/
		}
	}


//***EMPLOYEE MASTER START***********//

	function view_employee_master()
	{
		$data['result'] = $this->Transport_management_model->get_employee_master();
		$this->load->view('transport_management/view_employee_master.php',$data);
	}
	function add_employee_master() 
    {
		$data['marital_status']			=	$this->	Transport_management_model->get_marital_status();
		$data['employee_designation']	=	$this->	Transport_management_model->get_employee_designation();
		$data['branch']					=	$this->	Transport_management_model->get_vehicle_branch1();
        $this->load->view('transport_management/add_employee_master.php',$data);
		
    }
	
	function employee_master_add()
	{
		$data['name']						=	$this->input->post('first_name');
		$data['birthday']					=	date('Y-m-d',strtotime($this->input->post('date_of_birth')));
		$data['sex']						=	$this->input->post('sex');
		$data['address']					=	$this->input->post('address');
		$data['phone']						=	$this->input->post('phone');
		$data['salary']						=	$this->input->post('salary');
		$data['branch_id']					=	$this->input->post('branch_id');

		$data1['first_name']				=	$this->input->post('first_name');
		$data1['last_name']					=	$this->input->post('last_name');
		$data1['house_name']				=	$this->input->post('house_name');
		$data1['post']						=	$this->input->post('post');
		$data1['address']					=	$this->input->post('address');
		$data1['date_of_birth']				=	date('Y-m-d',strtotime($this->input->post('date_of_birth')));
		$data1['sex']						=	$this->input->post('sex');
		$data1['marital_status_id']			=	$this->input->post('marital_status_id');
		$data1['employee_designation_id']	=	$this->input->post('employee_designation_id');
		$data1['licence_number']			=	$this->input->post('licence_number');
		$data1['badge_number']				=	$this->input->post('badge_number');
		$data1['licence_details']			=	$this->input->post('licence_details');
		$data1['date_of_joining']			=	date('Y-m-d',strtotime($this->input->post('date_of_joining')));
		$data1['salary']					=	$this->input->post('salary');
		$data1['phone']						=	$this->input->post('phone');
		$data1['branch_id']					=	$this->input->post('branch_id');
		
		$vehicle_master						=	$this->Transport_management_model->employee_master_insert($data,$data1);
		if($vehicle_master > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_employee_master');
	}
	function employee_master_edit($employee_master_id='')
	{
		$result['employee_master_id']		=	$employee_master_id; 
		$result['marital_status']			=	$this->	Transport_management_model->get_marital_status();
		$result['employee_designation']		=	$this->	Transport_management_model->get_employee_designation();
		$result['branch']					=	$this->	Transport_management_model->get_vehicle_branch1();
		
		$result['employee_master']			=	$this->Transport_management_model->get_single_employee_master($employee_master_id);
		$this->load->view('transport_management/edit_employee_master.php',$result);
	}
	function employee_master_update($employee_master_id)
	{
		$data	=	array(
						'name'						=>	$this->input->post('first_name'),
						'birthday'					=>	date('Y-m-d',strtotime($this->input->post('date_of_birth'))),
						'sex'						=>	$this->input->post('sex'),
						'address'					=>	$this->input->post('address'),
						'phone'						=>	$this->input->post('phone'),
						'salary'					=>	$this->input->post('salary'),
						'branch_id'					=>	$this->input->post('branch_id')
					);

		$data1	=	array(
						'first_name'				=>	$this->input->post('first_name'),
						'last_name'					=>	$this->input->post('last_name'),
						'house_name'				=>	$this->input->post('house_name'),
						'post'						=>	$this->input->post('post'),
						'address'					=>	$this->input->post('address'),
						'date_of_birth'				=>	date('Y-m-d',strtotime($this->input->post('date_of_birth'))),
						'sex'						=>	$this->input->post('sex'),
						'marital_status_id'			=>	$this->input->post('marital_status_id'),
						'employee_designation_id'	=>	$this->input->post('employee_designation_id'),
						'licence_number'			=>	$this->input->post('licence_number'),
						'badge_number'				=>	$this->input->post('badge_number'),
						'licence_details'			=>	$this->input->post('licence_details'),
						'date_of_joining'			=>	date('Y-m-d',strtotime($this->input->post('date_of_joining'))),
						'salary'					=>	$this->input->post('salary'),
						'phone'						=>	$this->input->post('phone'),
						'branch_id'					=>	$this->input->post('branch_id')
					);
	    			$num_rows_updated = $this->Transport_management_model->employee_master_update($data,$data1,$employee_master_id);
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
					redirect('Transport_management/view_employee_master/');
					
	}
	function employee_master_delete($employee_master_id)
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->employee_master_update($data,$employee_master_id);
		if($num_rows_affected > 0)
		{
		$action = "Deleted";
		}
		else
		{
		$action = "Failed";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_employee_master');
	} 
//***EMPLOYEE MASTER END***********//
//*************************  			End 		   *****************************************


//###########################**********ROUTE REGISTER**********
//****START*****************

function view_vehicle_route_register($route_master_id='')
	{
		$data['route_master_id']	=	$route_master_id;
		$query						=	$this->Transport_management_model->get_vehicle_route_register($route_master_id);
		$data['result']				=	$query['result'];
		$data['route_master_name']	=	$query['route_master_name'];
		$this->load->view('transport_management/view_vehicle_route_register',$data);
	}
	function add_vehicle_route_register($route_master_id) 
    {   
	    $data['route_master_id']	=	$route_master_id; 
	    $data['route_master']		=	$this->Transport_management_model->get_route_master(); 
	    $data['vehicle_master']		=	$this->Transport_management_model->get_vehicle_master_by_route_master_branch($data['route_master_id']); 
		$data['branch']				=	$this->Transport_management_model->get_vehicle_branch1(); 
		$designation				= 	"Driver";
		$data['driver']				=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
		$designation				= 	"Conductor";
		$data['conductor']			=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
		$designation				= 	"Cleaner";
		$data['cleaner']			=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
        $this->load->view('transport_management/add_vehicle_route_register.php',$data);
    }
	function add_vehicle_route_register_bulk($route_master_id) 
    {   
	    $data['route_master_id']	=	$route_master_id; 
	    $data['route_master']		=	$this->Transport_management_model->get_route_master(); 
	    $data['vehicle_master']		=	$this->Transport_management_model->get_vehicle_master_by_route_master_branch($data['route_master_id']); 
		$data['branch']				=	$this->Transport_management_model->get_vehicle_branch1(); 
		$designation				= 	"Driver";
		$data['driver']				=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
		$designation				= 	"Conductor";
		$data['conductor']			=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
		$designation				= 	"Cleaner";
		$data['cleaner']			=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
        $this->load->view('transport_management/add_vehicle_route_register_bulk.php',$data);
    }
	function vehicle_route_register_add()
	{
		$data['route_master_id']		=	$this->input->post('route_master_id');
		$data['vehicle_master_id']		=	$this->input->post('vehicle_master_id');
		$data['driver_id']				=	$this->input->post('driver_id');
		$data['conductor_id']			=	$this->input->post('conductor_id');
		if($data['conductor_id'] == "")
		{
			$data['conductor_id'] = NULL;
		}
		$data['cleaner_id']				=	$this->input->post('cleaner_id');
		if($data['cleaner_id'] == "")
		{
			$data['cleaner_id'] = NULL;
		}
		$data['branch_id']				=	$this->input->post('branch_id');
		$num_rows_updated				=	$this->Transport_management_model->vehicle_route_register_insert($data);
		if($num_rows_updated > 0)
		{
		$action = "Inserted";
		}
		else
		{
		$action = "Duplicate";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_vehicle_route_register/'.$data['route_master_id']);
	}
	function vehicle_route_register_add_bulk()
	{
		if(isset($_POST['route_master_id']))
		{
			$data['branch_id']				=	$this->input->post('branch_id');
			$data['route_master_id']		=	$this->input->post('route_master_id');
			$vehicle_master_id				=	$this->input->post('vehicle_master_id[]');
			$driver_id						=	$this->input->post('driver_id[]');
			$conductor_id					=	$this->input->post('conductor_id[]');
			$cleaner_id						=	$this->input->post('cleaner_id[]');
			
			$this->db->db_debug				=	FALSE;
			$this->db->trans_start();
			for($i=0;$i<count($vehicle_master_id);$i++)
			{
				$data['vehicle_master_id']		=	$vehicle_master_id[$i];
				$data['driver_id']				=	$driver_id[$i];
				$data['conductor_id']			=	$conductor_id[$i];
				if($data['conductor_id'] == "")
				{
					$data['conductor_id'] = NULL;
				}
				$data['cleaner_id']				=	$cleaner_id[$i];
				if($data['cleaner_id'] == "")
				{
					$data['cleaner_id'] = NULL;
				}
				$num_rows_updated				=	$this->Transport_management_model->vehicle_route_register_insert($data);
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				$action	=	"Not_inserted";
			}
			else
			{
				$action	=	"Inserted";
			}
			$this->session->set_flashdata('action',$action);
		}	
		redirect('Transport_management/view_vehicle_route_register/'.$data['route_master_id']);
	}
	
	function vehicle_route_register_edit($route_register_id='',$route_master_id='')  //Here route_master_id is passing becuase it is needed to get the branch of the route. 
	{																				 //This route_master_id is using in function get_vehicle_master_by_route_master_branch()
		$data['route_register_id']	=	$route_register_id; 
		$data['route_master_id']	=	$route_master_id;
		$data['route_register']	=	$this->Transport_management_model->get_single_route_register($route_register_id);
		$data['branch']			=	$this->Transport_management_model->get_vehicle_branch1();
        $designation			= 	"Driver";
		$data['driver']			=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
		$designation			= 	"Conductor";
		$data['conductor']		=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
		$designation			= 	"Cleaner";
		$data['cleaner']		=	$this->Transport_management_model->get_designation_by_route_master_branch($designation,$data['route_master_id']);
	    $data['route_master']	=	$this->Transport_management_model->get_route_master(); 
	    $data['vehicle_master']	=	$this->Transport_management_model->get_vehicle_master_by_route_master_branch($data['route_master_id']); 
        
		$this->load->view('transport_management/edit_vehicle_route_register.php',$data);
	}
	
	function vehicle_route_register_update($route_register_id='')
	{
		$data	=	array(
		        		'route_master_id' 		=>	$this->input->post('route_master_id'),
						'vehicle_master_id' 	=>	$this->input->post('vehicle_master_id'),
						'driver_id' 			=> 	$this->input->post('driver_id'),
						'conductor_id' 			=> 	$this->input->post('conductor_id'),
						'cleaner_id' 			=> 	$this->input->post('cleaner_id'),
						'branch_id' 			=> 	$this->input->post('branch_id')						
						);
		if($data['conductor_id'] == "")
		{
			$data['conductor_id'] = NULL;
		}
		if($data['cleaner_id'] == "")
		{
			$data['cleaner_id'] = NULL;
		}
	    			$num_rows_updated = $this->Transport_management_model->vehicle_route_register_update($data,$route_register_id);
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
					redirect('Transport_management/view_vehicle_route_register/'.$data['route_master_id']);
					
	}
	function vehicle_route_register_delete($route_register_id,$route_master_id)
	{
		$data	=	array(
					'is_deleted'	=> 	'Y',
					'deleted_by'	=>	$this->session->userdata('login_user_id'),
					'deleted_date'	=>	date('Y-m-d')
					);
		$num_rows_affected = $this->Transport_management_model->vehicle_route_register_delete($data,$route_register_id);
		if($num_rows_affected > 0)
		{
			$action = "Deleted";
		}
		else if($num_rows_affected == 0)
		{
			$action = "Failed";
		}
		else if($num_rows_affected == -1)
		{
			$action = "Exist";
		}
		$this->session->set_flashdata('action',$action);
        redirect('Transport_management/view_vehicle_route_register/'.$route_master_id);
	}
	
  
   // *** assign student to bus ****//
   
   
   function view_assign_student_to_bus()
	{
		//$data['result']		=	$this->Transport_management_model->get_vehicle_route_register();
		$this->load->view('transport_management/assign_student_to_bus');
	}
	function get_students($class_id="",$section_id="",$branch_id="")
	{
		$result['academic_year']	=	get_running_year();
		$result['branch_id']		=	$branch_id;
		$data['class_id']			=	$class_id;
		$data['section_id']			=	$section_id;
		$result['students'] 		= 	$this->Transport_management_model->get_students_by_class($data['class_id'],$data['section_id']);//echo $this->db->last_query();die();
		$result['route_master']		=	$this->Transport_management_model->get_route_master_by_branch($branch_id);
		//$result['vehicle_master']	=	$this->Transport_management_model->get_vehicle_master();
		//$query						=	$this->Transport_management_model->get_vehicle_route_register();
		//$result['vehicle_register']	=	$query['result'];
		//$result['route_details']	=	$this->Transport_management_model->get_vehicle_route_details();
        $this->load->view('transport_management/view_assign_student_to_bus',$result);	
	}
	
	
	//--------------
	function get_bus($route_master_id)
    {
		$result1=$this->Transport_management_model->get_bus_no($route_master_id);
		echo '<option value="">Select</option>';
		foreach ($result1 as $row) 
		{
			echo '<option value="' . $row['route_register_id'] . '">' . $row['bus_number'] . '</option>';
		}
	}

	function get_bus_seats($route_register_id='')
    {
		$seat_capacity	=	$this->Transport_management_model->get_bus_seats($route_register_id);  				// This function is used to get the seat capacity and 
		$no_of_students	=	$this->Transport_management_model->get_no_of_students_in_bus($route_register_id);	// number of students asssigned to a bus
		echo "Seat capacity = ".$seat_capacity;
		if(count($no_of_students)>0)
		{
		echo '<br>Number of students in this bus = '.count($no_of_students);			
		}
		else
		{
		echo '<br>Number of students in this bus = '.count($no_of_students);			
		}
	}


//----------------
function get_pick_up($route_master_id='')
     {
		  
		   $pick_up=$this->Transport_management_model->get_pick_up_point($route_master_id);
		  echo '<option value="">Select</option>';
		    foreach ($pick_up as $row) 
		     {
			echo '<option value="'.$row['route_details_id'].'">' . $row['pickup_point'] . '</option>';
		      }
 }

function get_base_fare($route_details_id)
     {
		
		   $base_fare=$this->Transport_management_model->get_base_fare($route_details_id);
		    if(isset($base_fare))
		     {
			echo $base_fare->base_fare;
		      }
 }
	function check_student_exist($student_id='')
	{
		$query	=	$this->Transport_management_model->check_student_exist($student_id);
		if(count($query)>0)
		{
			echo 1;
		}
		
	}
function assign_students_to_bus($branch_id='',$academic_year='')
{
	$rows				=	$this->Transport_management_model->get_fee_installment($branch_id,$academic_year);
	$count 				= 	$this->input->post('count');
	$num_rows_updated 	= 	0;
	for($i=1;$i<=$count;$i++)
	{
		$student_id = $this->input->post('student_id'.$i); 	// can not use '$this->input->post('student_id'.$i)' directly inside isset(). 
		if(isset($student_id))								// So the value is assigned to another variable
		{
			foreach($rows as $row)
			{
				$data = array(
							'student_id'			=> 	$this->input->post('student_id'.$i),
							'route_master_id' 		=> 	$this->input->post('route_master_id'.$i),
							'route_register_id' 	=> 	$this->input->post('route_register_id'.$i),
							'route_details_id'		=> 	$this->input->post('pickup_point'.$i),
							'fee_amount'			=> 	$this->input->post('base_fare'.$i),
							'fee_balance'			=> 	$this->input->post('base_fare'.$i),
							'bus_fee_settings_id' 	=> 	$row['bus_fee_settings_id'],
							'due_date' 				=> 	$row['payment_date'],
							'academic_year'			=>	$row['academic_year']
							);
				$num_rows_updated	=	$this->Transport_management_model->bus_fee_installment_insert($data);	
			}
		}
	}
	if($num_rows_updated > 0)
	{
		$action = "success";
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_assign_student_to_bus');
	}	
	else if(count($rows) == 0)
	{
		$action = "set installment";
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_assign_student_to_bus');	
	}	
	else
	{
		$action = "failed";
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_assign_student_to_bus');
	}
	
}
/**********Reassign student start*******************/
	function get_students_for_reassign($class_id='', $section_id='',$branch_id='')
	{
		$result['academic_year']	=	get_running_year();
		$result['branch_id']		=	$branch_id;
		$data['class_id']			=	$class_id;
		$data['section_id']			=	$section_id;	
		$result['students'] 		= 	$this->Transport_management_model->get_students_in_class($data['class_id'],$data['section_id']);//echo $this->db->last_query();die();
		$result['route_master']		=	$this->Transport_management_model->get_route_master_by_branch($branch_id);
		$this->load->view('transport_management/reassign_students_to_bus.php', $result);
	}

   	function view_reassign_student_to_bus()
	{
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']	=	$this->Transport_management_model->get_vehicle_branch1();
		}
		else if($this->session->userdata('role')==3)
		{
			$data['dept']	=	$this->Transport_management_model->get_department();
		}
		else if($this->session->userdata('role')==4)
		{
			$data['class']	=	$this->Transport_management_model->get_class();
		}
		$this->load->view('transport_management/view_reassign_student_to_bus',$data);
	}
   	function view_reassign_student_to_bus_bulk()
	{
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']	=	$this->Transport_management_model->get_vehicle_branch1();
		}
		else if($this->session->userdata('role')==3)
		{
			$data['dept']	=	$this->Transport_management_model->get_department();
		}
		else if($this->session->userdata('role')==4)
		{
			$data['class']	=	$this->Transport_management_model->get_class();
		}
		$this->load->view('transport_management/view_reassign_student_to_bus_bulk',$data);
	}
	function get_student_details_for_reassign($class_id='', $section_id='',$branch_id='')
	{
		$data['student']	=	$this->Transport_management_model->get_student_fee_details($class_id,$section_id);
		$data['class_id']	=	$class_id;
		$data['batch']		=	$section_id;
		$data['branch_id']	=	$branch_id;
		$this->load->view('transport_management/view_reassign_select_students.php', $data);
	}
	function get_bus_fee_details($student='',$class_id='',$section='',$branch_id='')
	{
		$data['student']	=	$this->Transport_management_model->get_student_payment_details1($student);
		$data['result']		=	$this->Transport_management_model->get_student_payment_details2($student);
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['student_id']	=	$student;
		$data['branch_id']	=	$branch_id;
		$this->load->view('transport_management/view_reassign_payment_details',$data);
	}
	function reassign_student_bus($student_id='',$branch_id='')	//This function is used to display bus route,pickup point,etc when clicking the reassign button
	{	
		$result['student_id']			=	$student_id;
		$result['branch_id']			=	$branch_id;
		$result['route_master']			=	$this->Transport_management_model->get_route_master_by_branch($branch_id);
		$result['checked_master_ids']	= 	json_decode($_POST['checked_ids']);

		$this->load->view('transport_management/view_reassign_student_to_bus1',$result);		
	}
	
	function reassign_students_to_bus($branch_id,$academic_year)
	{ 
		$rows				=	$this->Transport_management_model->get_fee_installment($branch_id,$academic_year);
		$count 				= 	$this->input->post('count'); 
		$num_rows_updated 	= 	0;
		$this->db->db_debug	=	FALSE;
		$this->db->trans_start();
		for($i=2;$i<=$count;$i++)
		{
			$student_id = $this->input->post('student_id'.$i); 	
			$paid_fee_amount = $this->db->get_where('tbl_transport_students_bus_fee_master',array('student_id'=>$student_id,'academic_year'=>$academic_year,'is_deleted'=>'N'))->result();
			if(isset($student_id))								
			{
				foreach($paid_fee_amount as $row)
				{
					$students_bus_fee_master_id 		= 	$row->students_bus_fee_master_id;
					$paid_fee_amount1 = $this->Transport_management_model->get_fee_collected($students_bus_fee_master_id); 
					$current_fee_concession	=	$this->db->get_where('tbl_transport_students_bus_fee_master',array('students_bus_fee_master_id'=>$students_bus_fee_master_id))->row()->fee_concession;
					$fee_amount			= 	$this->input->post('base_fare'.$i);
					$data = array(
								'route_master_id' 		=> 	$this->input->post('route_master_id'.$i),
								'route_register_id' 	=> 	$this->input->post('route_register_id'.$i),
								'route_details_id'		=> 	$this->input->post('pickup_point'.$i),
								'fee_amount'			=> 	$this->input->post('base_fare'.$i),
								'fee_balance'			=> 	$fee_amount-$paid_fee_amount1-$current_fee_concession, 
								);
					$num_rows_updated	=	$this->Transport_management_model->students_bus_fee_master_update($student_id,$students_bus_fee_master_id,$data,$academic_year);	
				}
			}
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$action = "failed";
		}
		else
		{
			$action = "success";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_reassign_student_to_bus_bulk');
	}
	
	function deassign_student_bus()	
	{	
		$bus_fee_master_id				=	$this->input->post('students_bus_fee_master_id');
		$check_uncheck					=	$this->input->post('check_uncheck');
		$count							=	count($bus_fee_master_id);

		for($i=0;$i<$count;$i++)
		{
			if($check_uncheck[$i] == 1)
			{
				$students_bus_fee_master_id	=	$bus_fee_master_id[$i];
				$query						=	$this->Transport_management_model->deassign_students_bus_fee_master_update($students_bus_fee_master_id);
			}
			else
			{
				
			}
		}
		if($query>0)
		{
			$action = "Updated";
		}
		else
		{
			$action = "Not updated";
		}
		$this->session->set_flashdata('action',$action);
		redirect('Transport_management/view_reassign_student_to_bus');		
	}
/**********Reassign student End*********************/
/********************REPORTS START*****************************/

	function bus_fee_class_wise()
	{
		$role	=	$this->session->userdata('role');
		if($role == 1 || $role ==2)
		{
			$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
		}
		if($role == 3)
		{
			$data['department']	=	$this->Transport_management_model->get_department();
		}
		if($role >= 4)
		{
			$data['class']	=	$this->Transport_management_model->get_class();
		}
		$this->load->view('transport_management/view_report_bus_fee_class_wise', $data);
	}
	function get_bus_fee_class_wise()
	{
		$data['class_id']		=	$this->input->post('class_id');
		$data['section_id']    	=	$this->input->post('section_id');
		$data['result']			=	$this->Transport_management_model->get_bus_fee_class_wise($data);
		$data['class_name']		=	get_class_name($data['class_id']);
		$data['section_name']	=	get_section_name($data['section_id']);
		$result1				=	$this->Transport_management_model->get_bus_fee_class_wise($data);
		
		$this->session->set_flashdata('class_id',$data['class_id']);	//This flash data is used in 'bus_fee_class_wise_excel()'
		$this->session->set_flashdata('section_id',$data['section_id']);
		
		$this->load->view('transport_management/view_report_bus_fee_class_wise1', $data);
	}
	
	function bus_fee_class_wise_excel()
	{
		$data['class_id']		=	$this->session->flashdata('class_id'); 
		$data['section_id']		=	$this->session->flashdata('section_id'); 
		$result					=	$this->Transport_management_model->get_bus_fee_class_wise($data);
		
		$i=1;
		echo  "Bus service - Class Wise Students";
		$filename = "StudentsList.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<table><tr>";
		echo "<th>Sl.No</th>";
		echo "<th>Name</th>";
		echo "<th>Bus Route</th>";
		echo "<th>Bus Number</th>";
		echo "<th>Pickup Point</th>";
		echo "<th>Fee Amount</th></tr>";
				
		foreach ($result as $data1)
		{
		
			echo "<tr><td>".$i."</td>";
			echo "<td>".$data1['name']."</td>";
			echo "<td>".$data1['route_master_name']."</td>";
			echo "<td>".$data1['bus_number']."</td>";
			echo "<td>".$data1['pickup_point']."</td>";
			echo "<td>".$data1['fee_amount']."</td></tr>";
			
			$i=$i+1;
		}
		//$this->exportExcelData($dataToExports);
		// set header
		
		echo "</table>";
		die();
	}

		function get_bus_fee_pickup_wise()
	{
		$data['branch_id']			=	$this->input->post('branch_id');
		$data['pickup_point']		=	$this->input->post('pickup_point');
		$data['route_master_name']	=	$this->Transport_management_model->get_route_master_name_by_pick_up($data);
		$data['result']				=	$this->Transport_management_model->get_bus_fee_pickup_wise($data);

		$this->session->set_flashdata('pickup_point',$data['pickup_point']);			//This flash data is used in 'bus_fee_pickup_wise_excel()'
		$this->load->view('transport_management/view_report_bus_fee_pickup_point_wise1', $data);
	}
function bus_fee_pickup_wise_excel()
	{
		$pickup_point			=	$this->session->flashdata('pickup_point'); 
		$result					=	$this->Transport_management_model->get_bus_fee_pickup_wise($pickup_point);
		
		$i=1;
		echo "Bus service - Pickup Wise Students<br>";
		echo "Pickup Point : ".$pickup_point;	
		$filename = "StudentsList.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<table><tr>";
		echo "<th>Sl.No</th>";
		echo "<th>Name</th>";
		echo "<th>Class</th>";
		echo "<th>Section</th>";
		echo "<th>Bus Route</th>";
				
		foreach ($result as $data1)
		{
		
			echo "<tr><td>".$i."</td>";
			echo "<td>".$data1['name']."</td>";
			echo "<td>".$data1['class_name']."</td>";
			echo "<td>".$data1['section_name']."</td>";
			echo "<td>".$data1['route_master_name']."</td>";
			
			$i=$i+1;
		}
		//$this->exportExcelData($dataToExports);
		// set header
		
		echo "</table>";
		die();
	}


	function bus_fee_bus_wise()
	{
		$role	=	$this->session->userdata('role');
		if($role == 1 || $role ==2)
		{
			$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
		}
		if($role == 3 || $role >= 4)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$data['bus']	=	$this->Transport_management_model->get_bus_by_branch($branch_id);
		}
		$this->load->view('transport_management/view_report_bus_fee_bus_wise',$data);

	}
	function get_bus_by_branch($branch_id)
	{
		$bus	=	$this->Transport_management_model->get_bus_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($bus as $row) 
		{
			echo '<option value="' . $row['route_register_id'] . '">' . $row['bus_number'] .'('.$row['route_master_name'].')</option>';
		}
	}
	function get_bus_fee_bus_wise()
	{
		$data['route_register_id']	=	$this->input->post('route_register_id');
		$data['result']				=	$this->Transport_management_model->get_bus_fee_bus_wise($data['route_register_id']);
		/*echo "<pre>";
		print_r($data['result']	);
		echo "</pre>";
		die();*/
		$data['route_master_name']	=	$this->Transport_management_model->get_route_name($data['route_register_id']);
		$data['bus_number']			=	$this->Transport_management_model->get_bus_number($data['route_register_id']);

		$this->session->set_flashdata('bus_number',$data['bus_number']);				//This flash data is used in 'bus_fee_bus_wise_excel()'
		$this->load->view('transport_management/view_report_bus_fee_bus_wise1', $data);
	}
function bus_fee_bus_wise_excel($route_register_id)
	{
	    $bus_number					=	$this->session->flashdata('bus_number'); 
		$result						=	$this->Transport_management_model->get_bus_fee_bus_wise($route_register_id);
	   
		
		$i=1;
		echo  "Bus service - Bus Wise Students";
		$filename = "StudentsList.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<table><tr>";
		echo "<th>Sl.No</th>";
		echo "<th>Name</th>";
		echo "<th>Class</th>";
		echo "<th>Section</th>";
		echo "<th>Bus Route</th>";
		echo "<th>Pickup Point</th></tr>";
				
		foreach ($result as $data1)
		{
		
			echo "<tr><td>".$i."</td>";
			echo "<td>".$data1['name']."</td>";
			echo "<td>".$data1['class_name']."</td>";
			echo "<td>".$data1['section_name']."</td>";
			echo "<td>".$data1['route_master_name']."</td>";
			echo "<td>".$data1['pickup_point']."</td>";
			
			$i=$i+1;
		}
		//$this->exportExcelData($dataToExports);
		// set header
		
		echo "</table>";
		die();

	}	

	
	
	
	function bus_fee_route_wise()
	{
		$role	=	$this->session->userdata('role');
		if($role == 1 || $role ==2)
		{
			$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
		}
		if($role == 3 || $role>=4)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$data['route']	=	$this->Transport_management_model->get_route_by_branch($branch_id);
		}
		
	
				$this->load->view('transport_management/view_report_bus_fee_route_wise',$data);

	}
	function get_route_by_branch($branch_id)
	{
		$route	=	$this->Transport_management_model->get_route_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($route as $row) 
		{
			echo '<option value="' . $row['route_master_id'] . '">' . $row['route_master_name'] . '</option>';
		}
	}


	function get_bus_fee_route_wise()
	{
		 $data['route_master_id']			=	$this->input->post('route_master_id');
		$data['result']				=	$this->Transport_management_model->get_bus_fee_route_wise($data['route_master_id']);
		
		$this->session->set_flashdata('route_master_id',$data['route_master_id']);			//This flash data is used in 'bus_fee_route_wise_excel()'

		
		$this->load->view('transport_management/view_report_bus_fee_route_wise1', $data);
	}
	function bus_fee_route_wise_excel()
	{
		$route_master_id			=	$this->session->flashdata('route_master_id'); 
		$result						=	$this->Transport_management_model->get_bus_fee_route_wise($route_master_id);
		
		$i=1;
		echo  "Bus service - Route Wise Students";
		$filename = "StudentsList.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<table><tr>";
		echo "<th>Sl.No</th>";
		echo "<th>Name</th>";
		echo "<th>Class</th>";
		echo "<th>Section</th>";
		echo "<th>Bus Route</th>";
		echo "<th>Bus Number</th>";
		echo "<th>Pickup Point</th></tr>";
				
		foreach ($result as $data1)
		{
		
			echo "<tr><td>".$i."</td>";
			echo "<td>".$data1['name']."</td>";
			echo "<td>".$data1['class_name']."</td>";
			echo "<td>".$data1['section_name']."</td>";
			echo "<td>".$data1['route_master_name']."</td>";
			echo "<td>".$data1['bus_number']."</td>";
			echo "<td>".$data1['pickup_point']."</td>";
			
			$i=$i+1;
		}
		//$this->exportExcelData($dataToExports);
		// set header
		
		echo "</table>";
		die();

	}
	
	
	
	
//////////////-----------
	function bus_fee_pickup_point_wise()
	{
	$role	=	$this->session->userdata('role');
		if($role == 1 || $role ==2)
		{
			$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
		}
		if($role == 3 || $role >=4)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$data['bus']	=	$this->Transport_management_model->get_pickup_by_branch($branch_id);//echo $this->db->last_query();die();
		}
		$this->load->view('transport_management/view_report_bus_fee_pickup_point_wise',$data);

	}
	function get_pickup_by_branch($branch_id)
	{
		$pickup	=	$this->Transport_management_model->get_pickup_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($pickup as $row) 
		{
			echo '<option value="' . $row['pickup_point'] . '">' . $row['pickup_point'] .'('.$row['route_master_name'].')</option>';
		}
	}

	

	
	public function fee_collection_detailed_report()
	{
		$page_data['page_name']		=	'receipt';
        $page_data['page_title']	=	'Fee Management - All';
		$page_data['dept']			=	$this->	Transport_management_model->get_department();		
	    $page_data['branch']		=	$this->	Transport_management_model->get_vehicle_branch1();	
		$page_data['class']		=	$this->	Transport_management_model->get_class1();		
		$this->load->view('transport_management/bus_fee_collection_detailed_report');
	}
	/////////////----
	
	function get_class_section1($class_id)  ////// is an ajax function to fill the list box of section 
	{
		$class_option=$this->input->post('class');
	
			$sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
			foreach ($sections as $row)
			{
				echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
			}
	
	}// end of ajax function 

/////////******
public function fee_collection_detailed_report1()
	{
	
	 	$data = array(
					'date_from'        		=> 	date("Y-m-d", strtotime($this->input->post('date_from'))),
					'date_to'          		=> 	date("Y-m-d", strtotime($this->input->post('date_to'))),
					'fee_item'            	=>  $this->input->post('fee_item'),
					'branch_id'          	=>  $this->input->post('branch'),
					'department_id'         =>  $this->input->post('department'),
					'class_id'          	=>  $this->input->post('class_id'),
					'section_id'       		=>  $this->input->post('section_id'),
					);
		$data['result']	        =	$this->	Transport_management_model->get_fee_collection_detailed_report1($data);	
/*		$this->session->set_flashdata('branch_id',$data['branch_id']);			//This flash data is used in 'bus_fee_due_report_excel()'
		$this->session->set_flashdata('department_id',$data['department_id']);			
		$this->session->set_flashdata('class_id',$data['class_id']);			
		$this->session->set_flashdata('section_id',$data['section_id']);	
		$this->session->set_flashdata('date_from',$data['date_from']);	
		$this->session->set_flashdata('date_to',$data['date_to']);	
		$this->session->set_flashdata('fee_item',$data['fee_item']);
		if($data['class_id'] != 'All')
		{
			$this->session->set_flashdata('class_name',get_class_name($data['class_id']));
		}	
		if($data['section_id'] != 'All')
		{
			$this->session->set_flashdata('section_name',get_section_name($data['section_id']));
		}	
*/
		
		$this->load->view('transport_management/bus_fee_collection_detailed_report1',$data);	
	}
function fee_collection_detailed_report_excel()
	{
		$data['branch_id']		=	$this->input->post('branch_id'); 
		$data['department_id']	=	$this->input->post('department_id'); 
		$data['class_id']		=	$this->input->post('class_id'); 
		$data['section_id']		=	$this->input->post('section_id'); 
		$data['date_from']		=	$this->input->post('date_from'); 
		$data['date_to']		=	$this->input->post('date_to'); 
		$data['fee_item']		=	$this->input->post('fee_item'); 
//		$class_name				=	$this->session->flashdata('class_name'); 
//		$section_name			=	$this->session->flashdata('section_name'); 
		$result					=	$this->Transport_management_model->get_fee_collection_detailed_report1($data);
		
		$i=1;
		echo "Bus Fee Collection Report From ".date('d-m-Y',strtotime($data['date_from']))." To ".date('d-m-Y',strtotime($data['date_to']))."<br>";
		echo "Class: ";
		if($data['class_id']=='All' || $data['class_id']=='all')
		{
			echo "All";
		}
		else
		{
			echo get_class_name($data['class_id']);
			echo "<br>Section: ";
			if($data['section_id']=='All' || $data['section_id']=='all')
			{
				echo "All";
			}
			else
			{
				echo get_section_name($data['section_id']);
			}
		}
		echo "<br>";
		$filename = "BusFeeCollectionReport.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<table><tr>";
		echo "<th>Sl.No</th>";
		echo "<th>Date Paid</th>";
		echo "<th>Receipt Number</th>";
		echo "<th>Name</th>";
		echo "<th>Class</th>";
		echo "<th>Fee Item</th>";
		echo "<th>Amount</th>";
		$total=0;		
		foreach ($result as $data1)
		{
		
			echo "<tr><td>".$i."</td>";
			echo "<td>".date('d-m-Y', strtotime($data1['date_paid']))."</td>";
			echo "<td>".$data1['receipt_number']."</td>";
			echo "<td>".$data1['student_name']."</td>";
			echo "<td>".$data1['class_name']."-".$data1['section_name']."</td>";
			echo "<td>".$data['fee_item']."</td>";
			
			if($data['fee_item']=='Bus_Fee')
			{
				echo "<td align='center'>". number_format($data1['amount_paid'],2) . "</td></tr>";
				$i=$i+1;
				$total =$total+$data1['amount_paid'];
			}
		  	else 
		  	{
				echo "</td><td align='center'>". number_format($data1['late_fee'],2) . "</td></tr>";
				$i=$i+1;
				$total =$total+$data1['late_fee'];
			 }
			
		}
        echo "<tr><td colspan='5'><td><b>Total Amount </b></td><td align='center'><b>". number_format( $total,2)."</B></td></tr>";
		echo "</table>";
		die();
	}

	function get_dept($branch_id)
     {
		$dept	=	$this->Transport_management_model->get_dept($branch_id);
		echo '<option value="All">All</option>';
		foreach ($dept as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
		}
		
    }
	function get_class_by_dept($dept_id)
     {
	 	if($dept_id == "All")
		{
			echo '<option value="All">All</option>';
		}
		else
		{
			$class	=	$this->Transport_management_model->get_class_by_dept($dept_id);
			echo '<option value="All">All</option>';
			foreach ($class as $row) 
			{
				echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
			}
		}
		
    }

	function get_class_section($class_id) 
	{
	 	if($class_id == "All")
		{
			echo '<option value="All">All</option>';
		}
		else
		{
			$sections = $this->Transport_management_model->get_class_section($class_id);
			echo '<option value="All">All</option>';
			foreach ($sections as $row)
			{
				echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
			}
		}
	}
	
	
	

/********************REPORTS END*******************************/

	function view_bus_fee_settings()
	{
		$role	=	$this->session->userdata('role');
		if($role == 1 || $role == 2)
		{
			$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
			$this->load->view('transport_management/view_bus_fee_settings',$data);
		}
		if($role == 3 || $role>=4)
		{
			$this->load->view('transport_management/view_bus_fee_settings');
		}
		/*
		$result		=	$this->Transport_management_model->get_bus_fee_settings();
		if(empty($result))
		{
			$bus_settings	=	$this->Transport_management_model->insert_bus_fee_installment_settings($branch,$academic_year);
		}
		$this->load->view('transport_management/view_bus_fee_settings');
		*/
	}
	function get_bus_fee_settings($branch_id)
	{
		$academic_year			=	$this->Transport_management_model->get_running_year();
		$data1['result']		=	$this->Transport_management_model->get_bus_fee_installment_settings($branch_id,$academic_year);
		
		if(count($data1['result'])==0)
		{
			$bus_settings	=  	$this->Transport_management_model->insert_bus_fee_settings($branch_id,$academic_year);
			
			if($bus_settings > 0)
			{
				$data['result']		=	$this->Transport_management_model->get_bus_fee_installment_settings($branch_id,$academic_year);
				$this->load->view('transport_management/view_bus_fee_settings1',$data);
				
			}
			else
			{
				echo "Procedure execution failed";
			}
			
		}
		else
		{
			$this->load->view('transport_management/view_bus_fee_settings1',$data1);
		}
	}
	function insert_bus_fee_installment()
	{
		$count 				= 	$this->input->post('count');
		$rows				=	0;
		$checked			=	0;
		for($i=1;$i<=$count;$i++)
		{
		$bus_fee = $this->input->post('bus_fee'.$i);
			if(isset($bus_fee))
			{
				$checked++;
				$id               				= 	$this->input->post('bus_fee_settings_id'.$i);
				$data['payment_date'] 			= 	date('Y-m-d',strtotime($this->input->post('payment_date'.$i)));
				$data['is_active']				=	'Y';
				$num_rows_updated				=	$this->Transport_management_model->bus_fee_installment_settings_update($data,$id);	
				if($num_rows_updated > 0)
				{
				$rows++;
				}
			}
		}
	if($rows != 0 && $checked != 0 && $rows == $checked)
	{
		if($rows == 1)
		{
			$action = $rows." Row updated";
		}
		else
		{
			$action = $rows." Rows updated";
		}
	}		
	else
	{
		$action = "Failed";
	}
	$this->session->set_flashdata('action',$action);
	redirect('Transport_management/view_bus_fee_settings/');

	}
	function check_installment($branch_id='',$academic_year='') //This function is used to check whether an installment is already assigned to student. 
	{															//If assigned,don't allow to update the settings
		$query	=	$this->Transport_management_model->check_installment($branch_id,$academic_year);
		if(isset($query))
		{
			echo "Can not update.These settings are assigned to students";
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", true )</script>';
		}
		else
		{
			echo '<script type="text/javascript">$( "#btnSubmit" ).prop( "disabled", false )</script>';
		}
	}
	function view_student_bus_fee_pay()
	{
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']	=	$this->Transport_management_model->get_vehicle_branch1();
		}
		else if($this->session->userdata('role')==3)
		{
			$data['dept']	=	$this->Transport_management_model->get_department();
		}
		else if($this->session->userdata('role')>=4)
		{
			$data['class']	=	$this->Transport_management_model->get_class();
		}
		$this->load->view('transport_management/student_bus_fee_pay',$data);
	}
	function student_payment_details($class_id='', $section_id='',$branch_id='')
	{
		$details			=	$this->Transport_management_model->get_student_fee_details($class_id,$section_id);
		$data['student']	=	$details;
		$data['branch_id']	=	$branch_id;
		$data['class_id']	=	$class_id;
		$data['batch']		=	$section_id;
		$this->load->view('transport_management/student_payment_details.php', $data);
	}
	
	
	function student_payment_details1($student='',$class_id='',$section='',$branch_id='')
	{
		$data['student']	=	$this->Transport_management_model->get_student_payment_details1($student);
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['student_id']	=	$student;
		$data['branch_id']	=	$branch_id;
		$this->load->view('transport_management/student_payment_details_print',$data);
	}	
	 
	 
	 //////*********RECEIPT
function student_fee_payment()
{
		$receipt_number = 	$this->input->post('txtreceipt_number');
		$year			=	get_running_year();	
		$data = array('voucher_number' => $receipt_number );
	 	$this->db->where('voucher_type_name', "Receipt");
	 	$this->db->where('academic_year_id', $year);
		$this->db->update('tbl_voucher', $data); 
		
		
$installments = $this->input->post('balance_check[]');
//$fee_items = $this->input->post('fee_head_balance_check[]');

$inst_count = count($installments);
//$item_count = count($fee_items);

	$late_fee					=		$this->input->post('late_fee');
	$receipt_number				=		$this->input->post('txtreceipt_number');	//get_receipt_number("Receipt");
	$payment_mode				=		$this->input->post('lstpayment_mode');

	$class_id					=		$this->input->post('class');
	$section					=		$this->input->post('section');
	$student_id					=		$this->input->post('student_id');
	$var 						= 		$this->input->post('txtdate_paid');
	$date 						= 		str_replace('/', '-', $var);
	$date_paid 					=  		date('Y-m-d', strtotime($date));

/*	if(isset($_POST['chk_send_sms']))
	{
				$phone_number = get_student_phone($student_id	);
				$msg= "Dear Student, Your fee Rs. " . $amount	. " is received on " . date('d/m/Y') . " and the Receipt No. is " . $receipt_number;
				/////////////////////////////////////////////////////
				$sms = $this->db->get('sms_settings')->row();
				$sender_id = $sms->sender_id;
				$username = $sms->username;
				$password = $sms->password;
				$common = $sms->common_word;
				$url = $sms->url;
				$location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.urlencode($phone_number).'&msg=' .urlencode($msg." ").'&route=T';
				$api = $url;
				$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
				$balance = stream_get_contents($handle);
				if($balance >= 0)
				{
					$api."/sendsms?".$location;
					$send = fopen($api."/sendsms?".$location,"r");
					$return_message_ids = stream_get_contents($send);
					$message_id_array = explode($return_message_ids); 
				}
				//////////////////////////////////////////////////////
	}
*/
if($inst_count>0)
{
	$students_bus_fee_master_id	=		$this->input->post('students_bus_fee_master_id');
	$check_uncheck				=		$this->input->post('check_uncheck');
	$check_balance				=		$this->input->post('check_balance');
	$amount						=		$this->input->post('amount')- $this->input->post('late_fee');
	$count						=		count($check_balance);
	$total_late_fee				=		$late_fee;
$num_of_sel_inst=0;											// Here we calculate the late_fee
for($i=0;$i<$count;$i++)									// If more than one installment is selected and late_fee is entered, then the late_fee is divided by number of         	
{															//  selected installments.
	if($check_uncheck[$i]==1)
	{
	$num_of_sel_inst++;
	}
}
$late_fee	=	bcdiv($late_fee, $num_of_sel_inst, 2);


for($i=0;$i<$count;$i++)
{
	if($check_uncheck[$i]==1) //If a row is checked...
	{
	
		if($amount >=$check_balance[$i]) 
		{
			// insert into collection master
			$data4['date_paid']						=	$date_paid;
			$data4['late_fee']						=	$late_fee;
			$data4['receipt_number']				=	$receipt_number;
			$data4['student_id']					=	$student_id;
			$data4['class_id']						= 	$class_id;
			$data4['section_id']					=	$section;
			$data4['payment_mode']					=	$payment_mode;
			$data4['entered_by']					=	$this->session->userdata('login_user_id');
			$data4['academic_year']					=	get_running_year();
			$data3['students_bus_fee_master_id']	=	$students_bus_fee_master_id[$i];
 
 			//Insert into students_bus_fee_collection_master
			$this->db->insert('tbl_transport_students_bus_fee_collection_master', $data4);
			$master_id= $this->db->insert_id();
			
			//Update students_bus_fee_master
			$data1['fee_balance']= 0;
			$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id[$i]);
			$this->db->update('tbl_transport_students_bus_fee_master', $data1);
			
			//insert into students_bus_fee_collection_details

			$data3['bus_fee_collection_master_id']	=	$master_id;	
			$data3['fee_amount']					=	$check_balance[$i];	
			$this->db->insert('tbl_transport_students_bus_fee_collection_details', $data3);
			$amount									= 	$amount - $check_balance[$i];
			/*$collection= $this->db->query('SELECT fee_balance
			FROM tbl_students_fee_details WHERE students_fee_master_id ='.$students_fee_master_id[$i])->result_array();

			foreach( $collection as $col)
			{
				$data5['fee_collection_master_id']	=	$master_id;
				//$data5['fee_head_id']				=	$col['fee_head_id'];
				$data5['fee_amount']				=	$col['fee_balance'];
				if($col['fee_balance']>0)
				$this->db->insert('tbl_fee_collection_details', $data5);
			}
			$data1['fee_balance']				=	0;
			$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
			$this->db->update('tbl_students_fee_details', $data1);
			$amount								=	$amount-$check_balance[$i];*/
		}
		else if($amount == 0 && $late_fee == 0)
		{}
		else
		{
			$data4['date_paid']					=	$date_paid;
			$data4['late_fee']					=	$late_fee;
			$data4['receipt_number']			=	$receipt_number;
			$data4['student_id']				=	$student_id;
			$data4['class_id']					=	$class_id;
			$data4['section_id']				=	$section;
			$data4['payment_mode']				=	$payment_mode;
			$data4['entered_by']				=	$this->session->userdata('login_user_id');
			$data4['academic_year']					=	get_running_year();
			$data3['students_bus_fee_master_id']=	$students_bus_fee_master_id[$i];

			$this->db->insert('tbl_transport_students_bus_fee_collection_master', $data4);
			$master_id							= 	$this->db->insert_id();
			
			$data2['fee_balance']				=	$check_balance[$i]-$amount;
			$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id[$i]);
			$this->db->update('tbl_transport_students_bus_fee_master', $data2);
			
			$data3['bus_fee_collection_master_id']	=	$master_id;	
			$data3['fee_amount']					=	$amount;	
			$this->db->insert('tbl_transport_students_bus_fee_collection_details', $data3);
			$amount									=	$amount - $check_balance[$i];
			if($amount < 0)
			{
				$amount = 0;
			}

			/*
			$this->db->select('students_fee_details_id,fee_amount,fee_balance');
			$this->db->from('tbl_students_fee_details');
			$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
			$row=$this->db->get()->result_array();
			$d_amount							=	$amount;
			foreach($row as $result)
			{
			if ($d_amount<=0) break;
				if($d_amount >=$result['fee_balance'])
				{
					$collection= $this->db->query('SELECT fee_head_id, fee_balance FROM tbl_students_fee_details WHERE   fee_balance>0  AND  students_fee_details_id='.$result['students_fee_details_id'])->result_array();
					foreach( $collection as $col)
					{
						$data5['fee_collection_master_id']		=	$master_id;
						$data5['fee_head_id']					=	$col['fee_head_id'];
						$data5['fee_amount']					=	$result['fee_balance'];
						
						if($result['fee_balance']>0)
						$this->db->insert('tbl_fee_collection_details', $data5);
					}
					$data3['fee_balance']					=	0;
					$d_amount								=	$d_amount- $result['fee_balance'];
					$this->db->where('students_fee_details_id',$result['students_fee_details_id']);
					$this->db->update('tbl_students_fee_details', $data3);
				}
				else
				{
					$collection= $this->db->query('SELECT fee_head_id, fee_balance FROM tbl_students_fee_details WHERE  fee_balance>0  AND students_fee_details_id='.$result['students_fee_details_id'] )->result_array();
						foreach( $collection as $col)
						{
							$data5['fee_collection_master_id']		=	$master_id;
							$data5['fee_head_id']					=	$col['fee_head_id'];
							$data5['fee_amount']					=	$d_amount;
							
							if($result['fee_balance']>0)
							$this->db->insert('tbl_fee_collection_details', $data5);
						}
					
						$data3['fee_balance']		= 		$result['fee_balance']-$d_amount;
						$d_amount					=		$d_amount- $result['fee_balance'];
						$this->db->where('students_fee_details_id',$result['students_fee_details_id']);
						$this->db->update('tbl_students_fee_details', $data3);
				}
			
		}
			break;*/
	}
	
}
}

} // if installment count >0
/*
else if ( $item_count >0)
{
	$fee_items_details_id 	= 	$this->input->post('student_fee_details_id[]');
	$fee_master_id 			= 	$this->input->post('student_fee_master_id[]');
	$fee_heads 				=	$this->input->post('head_id[]');
	$fee_amount				= 	$this->input->post('item_balance[]');
	$checked_items 			= 	$this->input->post('item_check[]');
	
	$items_count 			= 	count($fee_items_details_id);
	$master_count			= 	count($fee_master_id );
			$amount					=		$this->input->post('amount')- $this->input->post('late_fee');

	$prev_master_id= 0;
	$curr_master_id= 0;
	for($i=0;$i<$items_count;$i++)
	{
	if ($checked_items [$i]>0)
	{
	$curr_master_id= $fee_master_id[$i];
	
	$fee_items_details_id 	= 	$this->input->post('student_fee_details_id[]');
	$fee_master_id 			= 	$this->input->post('student_fee_master_id[]');
	$fee_heads 				=	$this->input->post('head_id[]');
	$fee_amount				= 	$this->input->post('item_balance[]');
	$checked_items 			= 	$this->input->post('item_check[]');
	
	
	
		if($amount >$fee_amount[$i])
		{
			// insert into collection master
			$data4['date_paid']				=	$date_paid;
			$data4['receipt_number']		=	$receipt_number;
			$data4['student_fee_master_id']	=	$fee_master_id[$i];
			$data4['admission_number']		=	$student_id;
			$data4['class_id']				= 	$class_id;
			$data4['batch_id']				=	$section;
			$data4['payment_mode']			=	$payment_mode;
			
			if ($prev_master_id!=$curr_master_id)
			{
				$this->db->insert('tbl_fee_collection_master', $data4);
				$master_id= $this->db->insert_id();
			}
			$prev_master_id=$curr_master_id;	
			
			//insert into collection details
				$data5['fee_collection_master_id']	=	$master_id;
				$data5['fee_head_id']				=	$fee_heads[$i];
				$data5['fee_amount']				=	$fee_amount[$i];
				
				$this->db->insert('tbl_fee_collection_details', $data5);


						
			////////////// update tbl_studetns_fee_master
				$this->db->set("fee_balance", "fee_balance - " . $fee_amount[$i], FALSE);
				$this->db->where('students_fee_master_id',$fee_master_id[$i]);
				$this->db->update('tbl_students_fee_master');
	
			////////////// update tbl_studetns_fee_details
				$this->db->set("fee_balance", "fee_balance - " . $fee_amount[$i], FALSE);
				$this->db->where('students_fee_details_id',$fee_items_details_id[$i]);
				$this->db->update('tbl_students_fee_details');
			$amount =$amount -$fee_amount[$i];

		}
		else
		{
			// insert into collection master
			$data4['date_paid']				=	$date_paid;
			$data4['receipt_number']		=	$receipt_number;
			$data4['student_fee_master_id']	=	$fee_master_id[$i];
			$data4['admission_number']		=	$student_id;
			$data4['class_id']				= 	$class_id;
			$data4['batch_id']				=	$section;
			$data4['payment_mode']			=	$payment_mode;
			
			if ($prev_master_id!=$curr_master_id)
			{
				$this->db->insert('tbl_fee_collection_master', $data4);
				$master_id= $this->db->insert_id();
			}
			$prev_master_id=$curr_master_id;	
			
			//insert into collection details
				$data5['fee_collection_master_id']	=	$master_id;
				$data5['fee_head_id']				=	$fee_heads[$i];
				$data5['fee_amount']				=	$amount;
				
				$this->db->insert('tbl_fee_collection_details', $data5);


						
			////////////// update tbl_studetns_fee_master
				$this->db->set("fee_balance", "fee_balance - " . $amount, FALSE);
				$this->db->where('students_fee_master_id',$fee_master_id[$i]);
				$this->db->update('tbl_students_fee_master');
	
			////////////// update tbl_studetns_fee_details
				$this->db->set("fee_balance", "fee_balance - " . $amount, FALSE);
				$this->db->where('students_fee_details_id',$fee_items_details_id[$i]);
				$this->db->update('tbl_students_fee_details');
			break;
	}
	
	
	//////////////////////////////
			$data4['date_paid']				=	$date_paid;
			$data4['receipt_number']		=	$receipt_number;
			$data4['student_fee_master_id']	=	$fee_master_id[$i];
			$data4['admission_number']		=	$student_id;
			$data4['class_id']				= 	$class_id;
			$data4['batch_id']				=	$section;
			$data4['payment_mode']			=	$payment_mode;
	
			
				$this->db->set("fee_balance", "fee_balance - " . $fee_amount[$i], FALSE);
				$this->db->where('students_fee_master_id',$fee_master_id[$i]);
				$this->db->update('tbl_students_fee_master');
		
			//insert into collection details
			
				$data5['fee_collection_master_id']	=	$master_id;
				$data5['fee_head_id']				=	$fee_heads[$i];
				$data5['fee_amount']				=	$fee_amount[$i];
				if($fee_amount[$i]>0)
				$this->db->insert('tbl_fee_collection_details', $data5);
				
				// update students fee details
			$data1['fee_balance']				=	0;
			$this->db->where('students_fee_master_id',$fee_master_id[$i]);
			$this->db->where('students_fee_details_id',$fee_items_details_id[$i]);
			$this->db->update('tbl_students_fee_details', $data1);
				
			}
		
	
	///////////////////////////////
	}

}*/// else i f  $item_count >0
else
{
// do nothing

redirect($_SERVER['HTTP_REFERER']);
}
	//// Inserting the late fee, if available. The late fee id is set aS '9999' 
	if($late_fee>0)
	{
		$data5['fee_collection_master_id']		=	$master_id;
		$data5['fee_head_id']					=	'9999';
		$data5['fee_amount']					=	$total_late_fee;
		$this->db->insert('tbl_fee_collection_details', $data5);
	}
	
$page_data['class_id']			=	$class_id;
$page_data['section_id']		=	$section;
$page_data['student_id']		=	$student_id;
$page_data['receipt_no']		=	$receipt_number;
$page_data['payment_mode']		=	$payment_mode;
$page_data['date_paid']			=	$date_paid;
$page_data['total_late_fee']	=	$total_late_fee;
$page_data['page_name']			=	'receipt';
$page_data['page_title']		=	'Fee Management - All';

$this->load->view('transport_management/receipt.php', $page_data);		 
} 


/****************** Bus Fee Concession Start**************/
	function view_bus_fee_concession()
	{
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']	=	$this->Transport_management_model->get_vehicle_branch1();
		}
		else if($this->session->userdata('role')==3)
		{
			$data['dept']	=	$this->Transport_management_model->get_department();
		}
		else if($this->session->userdata('role')>=4)
		{
			$data['class']	=	$this->Transport_management_model->get_class1();
		}
		$this->load->view('transport_management/view_bus_fee_concession',$data);
	}
	function get_student_details($class_id='', $section_id='')
	{
		$data['student']	=	$this->Transport_management_model->get_student_fee_details($class_id,$section_id);
		$data['class_id']	=	$class_id;
		$data['batch']		=	$section_id;
		$this->load->view('transport_management/view_bus_fee_concession_students.php', $data);
	}
	function get_bus_fee_concession_details($student='',$class_id='',$section='')
	{
		$data['student']	=	$this->Transport_management_model->get_student_payment_details1($student);
		$data['result']		=	$this->Transport_management_model->get_students_bus_fee_details($student);
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['student_id']	=	$student;
		$this->load->view('transport_management/view_bus_fee_concession_details',$data);
	}
	
	function bus_fee_concession_update()
	{
	$installments = $this->input->post('balance_check[]');
	$inst_count = count($installments);
	
	$class_id					=		$this->input->post('class');
	$section					=		$this->input->post('section');
	$student_id					=		$this->input->post('student_id');

	if($inst_count>0)
	{
		$students_bus_fee_master_id	=		$this->input->post('students_bus_fee_master_id');
		$check_uncheck				=		$this->input->post('check_uncheck');
		$check_balance				=		$this->input->post('check_balance');
		$fee_amount					=		$this->input->post('fee_amount');
		$fee_concession				=		$this->input->post('fee_concession');
		$fee_balance				=		$this->input->post('fee_balance');
		$count						=		count($check_balance);

		for($i=0;$i<$count;$i++)
		{
			if($check_uncheck[$i]==1)
			{
				if($fee_amount[$i] >= $fee_balance[$i] + $fee_concession[$i])
				{
					$data4['student_id']			=	$student_id;
					$data4['fee_concession']		=	$fee_concession[$i];
					$data4['fee_balance']			=	$fee_balance[$i];
					$data4['fee_amount']			=	$fee_amount[$i];
					$student_bus_fee_master_id		=	$students_bus_fee_master_id[$i];
					$result							=   $this->Transport_management_model->bus_fee_concession_update($student_bus_fee_master_id,$data4);
					if($result > 0)
					{
						$action = "Updated";
					}
					else
					{
						$action = "Not updated";
					}
					$this->session->set_flashdata('action',$action);
				}
			}
		}
        redirect('Transport_management/view_bus_fee_concession');
	}
	else
	{
	    redirect($_SERVER['HTTP_REFERER']);
	}
	
} 
	
/****************** Bus Fee Concession End**************/

/*****************FEE DUE REPORT START****************/
	
	function view_bus_fee_due_report()
	{
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
		}
		else if($role == 3)
		{
			$data['department']	=	$this->Transport_management_model->get_department();
		}
		else if($role >= 4)
		{
			$data['class']		=	$this->Transport_management_model->get_class1();
		}
		$this->load->view('transport_management/view_bus_fee_due_report', $data);
	}

	public function view_bus_fee_due_report1()
	{

		$data['branch_id']		=	$this->input->post('branch');
		$data['dept_id']		=	$this->input->post('department');
		$data['class_id']		=	$this->input->post('class_id');
		$data['class_name']		=	get_class_name($data['class_id']);
		$class_id			    =	$this->input->post('class_id');
		$data['course']        	=	$this->input->post('txtcourse');
		$data['section_id']    	=	$this->input->post('section_id');
		$data['section_name']	=	get_section_name($data['section_id']);
		$section_id 			=	$this->input->post('section_id');
		$data['section']       	=	$this->input->post('txtsection');
		$data['title']         	=	"Fee Due Report";
		$data['due_date']		=	date('Y-m-d',strtotime( $this->input->post('due_date')));
		$data['result']			=	$this->Transport_management_model->get_bus_fee_due_report($data);	//echo $this->db->last_query();die();	
		
		$this->load->view('transport_management/view_bus_fee_due_report1', $data);

	}

	
	function bus_fee_due_report_excel()
	{
		$data['dept_id']		=	$this->input->post('dept_id');
		$data['class_id']		=	$this->input->post('class_id'); 
		$data['section_id']		=	$this->input->post('section_id'); 
		$data['due_date']		=	$this->input->post('due_date'); 
		$result					=	$this->Transport_management_model->get_bus_fee_due_report($data);
		
		$i=1;
		echo "Bus Fee Due Report<br>";
		echo "Class : ";
		if($data['class_id']=='All' || $data['class_id']=='all')
		{
			echo "All";
		}
		else
		{
			echo get_class_name($data['class_id']);
			echo "<br>Section : ";
			if($data['section_id']=='All' || $data['section_id']=='all')
			{
				echo "All";
			}
			else
			{
				echo get_section_name($data['section_id']);
			}
		}
		$filename = "BusFeeDueReport.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<table><tr>";
		echo "<th>Sl.No</th>";
		echo "<th>Due Date</th>";
		echo "<th>Name</th>";
		echo "<th>Class/Section</th>";
		echo "<th>Amount</th>";
		$total=0;		
		foreach ($result as $data1)
		{
		
			echo "<tr><td>".$i."</td>";
			echo "<td>".date('d-m-Y',strtotime($data1['due_date']))."</td>";
			echo "<td>".$data1['name']."</td>";
			echo "<td>".$data1['class_name'].'/'.$data1['section_name']."</td>";
			echo "<td>".number_format($data1['fee_balance'],2)."</td>";
			
			$i=$i+1;
			$total= $total+ $data1['fee_balance'];
		}
		//$this->exportExcelData($dataToExports);
		// set header
		echo "<tr><td></td><td></td><td></td><td><b>Total Amount</b> </td><td align='right'><b>" . number_format( $total,2). "</b></td></tr>";
		echo "</table>";
		die();
	}
	
	
	
	
	
/*****************FEE DUE REPORT END******************/
	
/*****************ALL IN ONE REPORT START******************/

//1)Student Report Start
	function view_bus_fee_all_in_one_report()
	{
		$role	=	$this->session->userdata('role');
		if($role >0)
		{
			$this->load->view('transport_management/view_report_all_in_one');
		}
		/*if($role == 3)
		{
			$branch_id		=	$this->session->userdata('branch_id');
			$data['bus']	=	$this->Transport_management_model->get_bus_by_branch($branch_id);
		}*/
		
	}
	
	function get_report_student($report_type='')
	{
		$data['branch']		=	$this->Transport_management_model->get_vehicle_branch1();
		$data['report_type']=	$report_type;
		if($report_type == 'student_report')
		{
			$this->load->view('transport_management/view_report_all_in_one_student',$data);
		}
		if($report_type == 'fee_report')
		{
			$this->load->view('transport_management/view_report_all_in_one_fee',$data);
		}
		if($report_type == 'vehicle_report')
		{
			$this->load->view('transport_management/view_report_all_in_one_vehicle',$data);
		}
		if($report_type == 'vehicle_tax_due_report')
		{
			$this->load->view('transport_management/view_report_all_in_one_vehicle',$data);
		}
		if($report_type == 'vehicle_insurance_due_report')
		{
			$this->load->view('transport_management/view_report_all_in_one_vehicle',$data);
		}
		if($report_type == 'vehicle_pollution_due_report')
		{
			$this->load->view('transport_management/view_report_all_in_one_vehicle',$data);
		}
		
	}
	function get_pickup_by_branch1($branch_id)
	{
		$pickup	=	$this->Transport_management_model->get_pickup_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($pickup as $row) 
		{
			echo '<option value="' . $row['route_details_id'] . '">' . $row['pickup_point'] .'('.$row['route_master_name'].')</option>';
		}
	}
	function get_receipt_number_by_branch($branch_id)
	{
		$receipt	=	$this->Transport_management_model->get_receipt_number_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($receipt as $row) 
		{
			echo '<option value="' . $row['receipt_number'] . '">' . $row['receipt_number'].'</option>';
		}
	}
	function get_receipt_number_by_route($route_master_id)
	{
		$receipt	=	$this->Transport_management_model->get_receipt_number_by_route($route_master_id);
		echo '<option value="">Select</option>';
		foreach ($receipt as $row) 
		{
			echo '<option value="' . $row['receipt_number'] . '">' . $row['receipt_number'].'</option>';
		}
	}
	function get_driver_by_branch($branch_id='')
	{
		$driver	=	$this->Transport_management_model->get_driver_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($driver as $row) 
		{
			echo '<option value="' . $row['driver_id'] . '">' . $row['driver_name'].'('.$row['route_master_name'].')</option>';
		}
	}
	function get_driver_by_route($route_master_id='')
	{
		$driver	=	$this->Transport_management_model->get_driver_by_route($route_master_id);
		echo '<option value="">Select</option>';
		foreach ($driver as $row) 
		{
			echo '<option value="' . $row['driver_id'] . '">' . $row['driver_name'].'</option>';
		}
	}
	function get_student_by_route($route_master_id='')
	{
		$student	=	$this->Transport_management_model->get_student_by_route($route_master_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_student_by_bus($route_register_id='')
	{
		$student	=	$this->Transport_management_model->get_student_by_bus($route_register_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_student_by_pickup($route_details_id='')
	{
		$student	=	$this->Transport_management_model->get_student_by_pickup($route_details_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_department_by_branch($branch_id='')
	{
		$department	=	$this->Transport_management_model->get_department_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($department as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'].'</option>';
		}
	}
	function get_class_by_branch($branch_id='')
	{
		$class1	=	$this->Transport_management_model->get_class_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($class1 as $row) 
		{
			echo '<option value="' . $row['class_id'] . '">' . $row['name'].'</option>';
		}
	}
	function get_section_by_branch($branch_id='')
	{
		$section	=	$this->Transport_management_model->get_section_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($section as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'].'('.$row['class_name'].')</option>';
		}
	}
	function get_student_by_branch($branch_id='')
	{
		$student	=	$this->Transport_management_model->get_student_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_installment_by_branch($branch_id='')
	{
		$installment	=	$this->Transport_management_model->get_installment_by_branch($branch_id);
		echo '<option value="">Select</option>';
		foreach ($installment as $row) 
		{
			echo '<option value="' . $row['bus_fee_settings_id'] . '">' . $row['installment_name'].'('.date('d-m-Y',strtotime($row['payment_date'])).')</option>';
		}
	}
	function get_class_by_department($department_id='')
	{
		
		$class	=	$this->Transport_management_model->get_class_by_dept($department_id);
		echo '<option value="">Select</option>';
		foreach ($class as $row) 
		{
			echo '<option value="' . $row['class_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function get_section_by_department($department_id='')
	{
		
		$section	=	$this->Transport_management_model->get_section_by_department($department_id);
		echo '<option value="">Select</option>';
		foreach ($section as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'].'('.$row['class_name'].')</option>';
		}
	}
	function get_student_by_department($department_id='')
	{
		$student	=	$this->Transport_management_model->get_student_by_department($department_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_section_by_class($class_id='')
	{
		
		$section	=	$this->Transport_management_model->get_class_section($class_id);
		echo '<option value="">Select</option>';
		foreach ($section as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function get_student_by_class($class_id='')
	{
		
		$student	=	$this->Transport_management_model->get_student_by_class($class_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_student_by_section($section_id='')
	{
		$student	=	$this->Transport_management_model->get_student_by_section($section_id);
		echo '<option value="">Select</option>';
		foreach ($student as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'].'('.$row['class_name'].$row['section_name'].')</option>';
		}
	}
	function get_student_report()
	{
		$ids			=	json_decode($_POST['ids']);
		$data			=	array(
								'branch_id'			=>	$ids->branch_id,
								'route_master_id'	=>	$ids->route_master_id,
								'route_register_id'	=>	$ids->route_register_id,
								'route_details_id'	=>	$ids->route_details_id,
								'driver_id'			=>	$ids->driver_id,
								'department_id'		=>	$ids->department_id,
								'class_id'			=>	$ids->class_id,
								'section_id'		=>	$ids->section_id,
								'student_id'		=>	$ids->student_id,
								'date_from'			=>	$ids->date_from,
								'date_to'			=>	$ids->date_to
								); 
		$query			=	$this->Transport_management_model->get_student_report($data);
		$data['result']	=	$query['query'];
		$data['count']	=	$query['count'];
		$this->load->view('transport_management/view_report_all_in_one_student1',$data);
	}
	function pdf_report_student()
	{
		ob_start();
		$html 	=	ob_get_clean();
		$html 	= 	utf8_encode($html);
		$data	=	$_SESSION["data"];		// Session set from the view_report_all_in_one_student1 page
		$html	=	$this->load->view('transport_management/view_pdf_report_all_in_one_student',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 	= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('Student_Report.pdf','I');	
	}
	function pdf_report_single_student($student_id='')
	{
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$data1								=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
		$data1['student_id']				=	$student_id;
		$query								=	$this->Transport_management_model->get_report($data1);
		$data1['result']					=	$query['query'];
		$html								=	$this->load->view('transport_management/view_pdf_report_all_in_one_student',$data1,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'pdf','I');	
	}
	function pdf_report_fee()
	{
		ini_set('memory_limit', '-1');
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$data								=	$_SESSION["data"];		// Session set from the view_report_all_in_one_student1 page
		$html								=	$this->load->view('transport_management/view_pdf_report_all_in_one_fee',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in 					= 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('Fee_Report.pdf','I');	
		ini_set('memory_limit', '128M');
	}
	function pdf_report_single_fee($student_id='')
	{
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$data1								=	$_SESSION["data1"];		// Session set from the view_report_all_in_one_student1 page
		$data1['student_id']				=	$student_id;
		$query								=	$this->Transport_management_model->get_report($data1);
		$data1['result']					=	$query['query'];
		$html								=	$this->load->view('transport_management/view_pdf_report_all_in_one_fee',$data1,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('Fee_Single_Student.pdf','I');	
	}
	function pdf_report_vehicle_single($vehicle_master_id='')
	{
		ob_start();
		$html 					=	ob_get_clean();
		$html 					= 	utf8_encode($html);
		$vehicle_master_id		=	$vehicle_master_id;		
		$query					=	$this->Transport_management_model->view_single_vehicle_report($vehicle_master_id);
		$data['result']			=	$query;
		$html					=	$this->load->view('transport_management/view_pdf_report_all_in_one_vehicle_single',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 					= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output('Vehicle_Report.pdf','I');	
	}
//1)Student Report End

//2)Fee Report Start

	function get_report()
	{
		$ids			=	json_decode($_POST['ids']);
		$data			=	array(
								'report_type'			=>	$ids->report_type,
								'branch_id'				=>	$ids->branch_id,
								); 
		if($data['report_type'] == 'student_report')
		{
			$data['route_master_id']	=	$ids->route_master_id;
			$data['route_register_id']	=	$ids->route_register_id;
			$data['route_details_id']	=	$ids->route_details_id;
			$data['department_id']		=	$ids->department_id;
			$data['class_id']			=	$ids->class_id;
			$data['section_id']			=	$ids->section_id;
			$data['student_id']			=	$ids->student_id;
			$data['driver_id']			=	$ids->driver_id;
			$data['date_from']			=	$ids->date_from;
			$data['date_to']			=	$ids->date_to;
			$query						=	$this->Transport_management_model->get_student_report($data);
			$data['result']				=	$query['query'];
			$data['count']				=	$query['count'];
			$this->load->view('transport_management/view_report_all_in_one_student1',$data);
		}
		if($data['report_type'] == 'fee_report')
		{
			$data['route_master_id']	=	$ids->route_master_id;
			$data['route_register_id']	=	$ids->route_register_id;
			$data['route_details_id']	=	$ids->route_details_id;
			$data['department_id']		=	$ids->department_id;
			$data['class_id']			=	$ids->class_id;
			$data['section_id']			=	$ids->section_id;
			$data['student_id']			=	$ids->student_id;
			$data['payment_filter']		=	$ids->payment_filter;
			$data['receipt_number']		=	$ids->receipt_number;
			$data['due_date_from']		=	$ids->due_date_from;
			$data['due_date_to']		=	$ids->due_date_to;
			$data['bus_fee_settings_id']=	$ids->bus_fee_settings_id;
			$data['paid_date_from']		=	$ids->paid_date_from;
			$data['paid_date_to']		=	$ids->paid_date_to;
			$query						=	$this->Transport_management_model->get_report($data);
			$data['result']				=	$query['query'];
			$data['installments']		=	$query['installments'];
			$this->load->view('transport_management/view_report_all_in_one_fee1',$data);
		}
		if($data['report_type'] == 'vehicle_report')
		{
			$data['route_master_id']	=	$ids->route_master_id;
			$data['route_register_id']	=	$ids->route_register_id;
			$query						=	$this->Transport_management_model->get_report($data);
			$data['result']				=	$query['query'];
			$this->load->view('transport_management/view_report_all_in_one_vehicle1',$data);
		}
		if($data['report_type'] == 'vehicle_tax_due_report')
		{
			$data['tax_due_date']		=	$ids->tax_due_date;
			$query						=	$this->Transport_management_model->get_report($data);
			$data['result']				=	$query['query'];
			$this->load->view('transport_management/view_report_all_in_one_vehicle1',$data);
		}
		if($data['report_type'] == 'vehicle_insurance_due_report')
		{
			$data['insurance_due_date']	=	$ids->insurance_due_date;
			$query						=	$this->Transport_management_model->get_report($data);
			$data['result']				=	$query['query'];
			$this->load->view('transport_management/view_report_all_in_one_vehicle1',$data);
		}
		if($data['report_type'] == 'vehicle_pollution_due_report')
		{
			$data['pollution_due_date']	=	$ids->pollution_due_date;
			$query						=	$this->Transport_management_model->get_report($data);
			$data['result']				=	$query['query'];
			$this->load->view('transport_management/view_report_all_in_one_vehicle1',$data);
		}
	}
	function view_single_vehicle_report($vehicle_master_id='')
	{
		$data['vehicle_master_id']	=	$vehicle_master_id;
		$data['result']				=	$this->Transport_management_model->view_single_vehicle_report($vehicle_master_id);
		$this->load->view('transport_management/view_report_all_in_one_vehicle_single',$data);
	}

//2)Fee Report End
/*****************ALL IN ONE REPORT END********************/

}

