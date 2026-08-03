<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */


if ( ! function_exists('get_receipt_number'))
{
function get_receipt_number($type='',$branch_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		// query for finding the last recept nu from tbl_voucher table
		$year		=	get_running_year();
		$receipt_no	=	0;
		if($CI->db->table_exists('tbl_deleted_receipts'))
		{
			
			$CI->db->select('MIN(receipt_number) as receipt_number');
			$CI->db->where('branch_id',$branch_id);
			$CI->db->where('year_id',$year);
			$CI->db->where('is_allotted',FALSE);
			$res	=	$CI->db->get('tbl_deleted_receipts');
			$res1	=	$res->row();
			
			$receipt_no	=	$res1->receipt_number;
			if($receipt_no!='')
			{
				$receipt_no	=	$receipt_no-1;
			}	
			else
			{			
				// query for finding the last recept nu from tbl_voucher table
				$query		=	$CI->db->get_where("tbl_voucher", array('voucher_type_name'=> $type,'branch_id'=> $branch_id,'academic_year_id'=>$year));
				$row		=	$query->row();	
				$receipt_no	=	$row->voucher_number;
				$next_receipt_no = $receipt_no + 1;
			}
		}
		else
		{			
			// query for finding the last recept nu from tbl_voucher table
			$query		=	$CI->db->get_where("tbl_voucher", array('voucher_type_name'=> $type,'branch_id'=> $branch_id,'academic_year_id'=>$year));
			$row		=	$query->row();	
			$receipt_no	=	$row->voucher_number;
			$next_receipt_no = $receipt_no + 1;
		}
		return $receipt_no;
	}
}


if ( ! function_exists('get_fee_item_total'))
{
	function get_fee_item_total($fee_master_id='',$fee_head_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		// query for finding the last recept nu from tbl_voucher table
		$fee_amount=0;
		$query		=	$CI->db->get_where("tbl_fee_details", array('fee_master_id'=> $fee_master_id,'fee_head_id'=> $fee_head_id));
		$row		=	$query->row();	
		$fee_amount	=	$row->fee_amount;
		return $fee_amount;
	}
}


if ( ! function_exists('get_fee_item_balance'))
{
	function get_fee_item_balance($fee_master_id='',$fee_head_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$CI->db->select('sum(fee_amount) as fee_amount');
		$CI->db->from('view_installments_details');
		$CI->db->where('fee_master_id',$fee_master_id);
		$CI->db->where('fee_head_id', $fee_head_id);
		$result=$CI->db->get()->result_array();
		$total = 0;
		$balance=0;
		foreach($result as $row)
		{
			$total = $total + $row['fee_amount'];
		}
		$balance = get_fee_item_total($fee_master_id,$fee_head_id)-$total;
		return $balance;
	}
}




if ( ! function_exists('get_installment_due_date'))
{
	function get_installment_due_date($installment_master_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		$due_date='';
		
		$CI->db->select('due_date');
		$CI->db->from('tbl_fee_installment_master');
		$CI->db->where('fee_installment_master_id',$installment_master_id);
		$result=$CI->db->get()->result_array();
		foreach($result as $row)
		{
			$due_date =  $row['due_date'];
		}
		if (substr($due_date,0,4)=="0000")
		$due_date=date('d-m-Y');
		else
		$due_date=date('d-m-Y',strtotime($due_date));
		return $due_date;
	}
}

if ( ! function_exists('get_installment_item_amount'))
{
	function get_installment_item_amount($installment_master_id='',$fee_head_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$CI->db->select('fee_amount');
		$CI->db->from('tbl_fee_installment_details');
		$CI->db->where('fee_installment_master_id',$installment_master_id);
		$CI->db->where('fee_head_id',$fee_head_id);
		$result=$CI->db->get()->result_array();
		$fee_amount=0;
		foreach($result as $row)
		{
			$fee_amount =  $row['fee_amount'];
		}
	
		return $fee_amount;
	}
}

if ( ! function_exists('get_fee_head_name'))
{
	function get_fee_head_name($fee_head_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		$fee_head="";
		$query		=	$CI->db->get_where("tbl_fee_heads", array('fee_head_id'=> $fee_head_id));
		$row		=	$query->row();	
		$fee_head	=	$row->fee_head;

		return $fee_head;
	}
}

if ( ! function_exists('is_fees_assigned'))
{
	function is_fees_assigned($student_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		$CI->db->select('fee_master_id');
		$CI->db->from('tbl_students_fee_master');
		$CI->db->where('admission_number',$student_id);
		$CI->db->where('is_deleted','N');
		
		$result=$CI->db->get()->result_array();
		$fee_master_id=0;
		foreach($result as $row)
		{
			$fee_master_id =  $row['fee_master_id'];
		}
	
		return $fee_master_id;
	}
}


if ( ! function_exists('is_fee_paid'))
{
	function is_fee_paid($student_id='',$class_id='',$batch_id='')
	{
		$year	=	get_running_year();
		$CI	=& get_instance();
		$CI->load->database();
		
		$CI->db->select('admission_number');
		$CI->db->from('tbl_fee_collection_master');
		$CI->db->where('admission_number',$student_id);
		$CI->db->where('academic_year_id',$year);
		//$CI->db->where('class_id',$class_id);
		//$CI->db->where('batch_id',$batch_id);
		
		$result=$CI->db->get()->result_array();
		$paid='n';
		//foreach($result as $row)
		//{
		//	$paid='y';
		//}
		
		if (count($result)>0)
		$paid='y';
	
		return $paid;
	}
}
// ------------------------------------------------------------------------
/* End of file language_helper.php */
/* Location: ./system/helpers/language_helper.php */