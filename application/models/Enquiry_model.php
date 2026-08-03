<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class enquiry_model extends CI_Model {
	
function __construct()
{  parent :: __construct();  }




function enquiry_insert($d,$e)
       {
	   
        $this->db->insert('tbl_enquiry_master',$d);
		$e['enquiry_id']=$this->db->insert_id();
		
		return $this->db->insert('tbl_enquiry_exam_passed',$e);
       }
  	   
	 function delete_enquiry($enquiry_id)
	 {
        $this->db->where('enquiry_id', $enquiry_id);
        $this->db->update('tbl_enquiry_master',array('is_deleted' =>'Y'));
     }
	 function enquiry_list($fdate='',$tdate='')
	 {
        $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.enquired_by,e.enquired_through,e.remark as enq_remark');
		$this->db->order_by('date','DESC');
		//$this->db->limit(10);
		if($fdate && $tdate)
		{
		  $date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','N');
		$this->db->where('e.interested','1');
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		return $this->db->get('tbl_enquiry_master e')->result_array(); 
     }
	 function not_interested_enquiry_list($fdate='',$tdate='')
	 {
        $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name,e.enquired_by,e.enquired_through,e.remark as enq_remark');
		$this->db->order_by('date','DESC');
		//$this->db->limit(10);
		if($fdate && $tdate)
		{
			$date_from        = date("Y-m-d", strtotime($fdate));
			$date_to          = date("Y-m-d", strtotime($tdate));
			$this->db->where('date>=',$date_from);
			$this->db->where('date<=',$date_to);
		}
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','N');
		$this->db->where('e.interested','0');
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		return $this->db->get('tbl_enquiry_master e')->result_array(); 
	 }
	 
	function enq_set_interest($enquiry_id='',$set_to='')
	{
		if($set_to == 'not_interested')
		{
			$this->db->where('enquiry_id',$enquiry_id);
			$this->db->set('interested','0');
			$this->db->update('tbl_enquiry_master');
			return $this->db->affected_rows();
		}
		if($set_to == 'interested')
		{
			$this->db->where('enquiry_id',$enquiry_id);
			$this->db->set('interested','1');
			$this->db->update('tbl_enquiry_master');
			return $this->db->affected_rows();
		}
	}	 
	 
	  function approved_enquiry_list($fdate='',$tdate='')
	 {
         $this->db->select('e.phone1,date,first_name,last_name,e.address,enquiry_id,c.name');
		$this->db->order_by('enquiry_id','DESC');
		$this->db->limit(10);
		if($fdate && $tdate)
		{
		  $date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.branch_id',$this->session->userdata('branch_id'));
		$this->db->where('e.dept_id',$this->session->userdata('dept_id'));
		$this->db->where('e.is_deleted','N');
		$this->db->where('e.is_admitted','Y');
		$this->db->join('class c','e.course_enquired=c.class_id','LEFT');
		return $this->db->get('tbl_enquiry_master e')->result_array(); 
     }
	 
	 
	  function enquiry_folow_list($fdate='',$tdate='',$enquiry_id)
	 {
        
		if($fdate && $tdate)
		{
		  $date_from        = date("Y-m-d", strtotime($fdate));
  			 $date_to          = date("Y-m-d", strtotime($tdate));
			 $this->db->where('date>=',$date_from);
			  $this->db->where('date<=',$date_to);
			 
		}
		$this->db->where('e.enquiry_id',$enquiry_id);
		
		return $this->db->get('tbl_enquiry_followups e')->result_array(); 
     }
	 
	 function enquiry_followup_list()
	 {
        $this->db->select('*');
		$this->db->order_by('enquiry_id','DESC');
		$this->db->limit(10);
		return $this->db->get('tbl_enquiry_master')->result_array();
     }

		function edit_is_admitted($enquiry_id) 
	{

       $this->db->where('enquiry_id',$enquiry_id);
       $this->db->update('tbl_enquiry_master',array('is_admitted'=>'Y'));

    }
 	 
	  function edit_enquiry($enquiry_id)
	 {
        $this->db->where('enquiry_id', $enquiry_id);
        $r=$this->db->get('tbl_enquiry_master');
		return $r->result();
	 } 
	  function edit_enquiry1($enquiry_id)
	 {
	    $this->db->where('enquiry_id', $enquiry_id);
		$t=$this->db->get('tbl_enquiry_exam_passed');
		return $t->result();

	 }

	 function register($enquiry_id)
	 {
        $this->db->where('enquiry_id', $enquiry_id);
        $q=$this->db->get('tbl_enquiry_master');
		return $q->result();
	}
	   
	   function edit($enquiry_id)
	 {
        $this->db->where('enquiry_id', $enquiry_id);
        $s=$this->db->get('tbl_enquiry_exam_passed');
	 	return $s->result();
     }
   	
  
	
	
	function insert_call_details($d)
	{

	  return $this->db->insert('tbl_enquiry_followups',$d);
      
	  }
	function call_edit($data,$call_id) 
	{
       
	
       $this->db->where('call_id',$call_id);
            $this->db->update('tbl_enquiry_followups',$data);

    }
	
	
	function profile_edit($a,$id) 
	{
       
	        //$id=$a['enquiry_id'];
            $this->db->where('enquiry_id',$id);
            $this->db->update('tbl_enquiry_master',$a);

	}

	function profile_edit_exam($b,$id) 
	{
       
	        //$id=$b['enquiry_id'];
            $this->db->where('enquiry_id',$id);
            $this->db->update('tbl_enquiry_exam_passed',$b);

	}

	
		function delete_call_details($call_id) 
	{


       $this->db->where('call_id',$call_id);
            return $this->db->delete('tbl_enquiry_followups');
        
    }
	   
	 //function delete_enquiry($enquiry_id)
	 //{
        //$this->db->where('enquiry_id', $enquiry_id);
       // $this->db->update('enquiry_master_details',array('is_deleted' =>'True'));
   //  }  
	 
	/*function edit_is_deleted($value,$data) 
	{
       
	
       $this->db->where('enquire_id',$enquire_id);
            $this->db->update('enquiry_master_details',$value);

    }*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}