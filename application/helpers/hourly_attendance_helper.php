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
	function get_receipt_number($type='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		
		// query for finding the last recept nu from tbl_voucher table
		$receipt_no=0;
		$query		=	$CI->db->get_where("tbl_voucher", array('voucher_type_name'=> $type));
		$row		=	$query->row();	
		$receipt_no	=	$row->voucher_number;
		$next_receipt_no = $receipt_no + 1;

		return $receipt_no;
	}
}


if ( ! function_exists('is_holiday'))
{
	function is_holiday($date='',$branch_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

			$date = date('Y-m-d',strtotime($date));
			$reason_for_holiday='';
			$query			=	$CI->db->get_where("tbl_att_holiday_master", array('date'=> $date,'branch_id'=>$branch_id));
			if(count($query->row())>0)
			{
				$row			=	$query->row();	
				$reason_for_holiday=	$row->reason_for_holiday;
			}
			return $reason_for_holiday;
	}
}

if ( ! function_exists('is_working_day'))
{
	function is_working_day($date='',$branch_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();

			$date = date('Y-m-d',strtotime($date));
			$dayname =strtoupper( date('l', strtotime($date)));
			$is_working_day='';
			$query			=	$CI->db->get_where("tbl_att_week_days", array('week_day_long_name'=> $dayname,'branch_id'=>$branch_id));
			if(count($query->row())>0)
			{
				$row			=	$query->row();	
				$is_working_day=	$row->is_working_day;
			}
			return $is_working_day;
	}
}

if ( ! function_exists('get_branch'))
{
	function get_branch($branch_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		if($branch_id==null)
		{
		$branch_id=$CI->session->userdata('branch_id');
		}
		$CI->db->select('branch_id,branch_name');
		$CI->db->from('tbl_branch');
		$CI->db->where('branch_id',$branch_id);
		$result=$CI->db->get()->row();
		return $result->branch_name;
	}
}


if ( ! function_exists('get_dept'))
{
	function get_dept($dept_id='')
	{
		$CI	=& get_instance();
		$CI->load->database();
		if($dept_id==null)
		{
		$dept_id=$CI->session->userdata('dept_id');
		}
		$CI->db->select('dept_name');
		$CI->db->from('tbl_department');
		$CI->db->where('dept_id',$dept_id);
		$result=$CI->db->get()->row();
		return $result->dept_name;
	}
}

// ------------------------------------------------------------------------
/* End of file hourly_attendancet_helper.php */
/* Location: ./system/helpers/language_helper.php */