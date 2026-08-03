<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

	function view_account_heads()
	{
		$this->load->view('account/account_heads_view');
	}
	
	function add_account_heads()
	{
		$this->load->view('account/account_heads_add');
	}
	
	function account_heads_add()
	{
		$running_year                   =   get_running_year();
		$account = array(
		'account_head_name'		=> $this->input->post('account_head'),
		'account_group_id'		=> $this->input->post('account_group'),
		'branch_id' 			=> $this->input->post('branch'),
		'department_id' 		=> $this->input->post('department'),
		'created_by'			=> $this->session->userdata('login_user_id'),
		'created_date'			=> date('Y-m-d'),
		'financial_year_id'		=> $running_year,
		);
		
		$affected_row = $this->db->insert('tbl_account_head',$account);
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','added');
		}
		redirect('account/view_account_heads/'.$action);
	}
	
	function account_heads_edit()
	{
		$account_head_id = $this->uri->segment(3);
		$this->db->where('account_head_id',$account_head_id);
		$data['account'] = $this->db->get('view_account_head')->result_array();

		$this->load->view('account/account_heads_edit',$data);
	}	
	function account_heads_update()
	{
		$account_head_id = $this->input->post('account_head_id');
		
		$account = array(
		'account_head_name'		=> $this->input->post('account_head'),
		'account_group_id'		=> $this->input->post('account_group'),
		'branch_id' 			=> $this->input->post('branch'),
		'department_id' 		=> $this->input->post('department'),
		);

		$this->db->where('account_head_id',$account_head_id);
		$affected_row = $this->db->update('tbl_account_head',$account);
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','Updated');
		}
		redirect('account/view_account_heads/'.$action);
	}
	
	function account_heads_delete($account_head_id)
	{
		$this->db->where('account_head_id',$account_head_id);
		$affected_row = $this->db->delete('tbl_account_head');
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','deleted');
		}
		redirect('account/view_account_heads/'.$action);
	}
	
	function view_receipts()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1 && $to_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('receipt_date>=',$from_date);
				 $this->db->where('receipt_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('receipt_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_receipts')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			if($this->session->userdata('branch_id'))
			{
				 $this->db->where('branch_id',$this->session->userdata('branch_id'));
			}
			if($this->session->userdata('dept_id'))
			{
				 $this->db->where('department_id',$this->session->userdata('dept_id'));
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('receipt_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_receipts')->result_array();
		}
		$this->load->view('account/receipts_view',$data);
	}

	function view_payments()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1 && $to_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('payment_date>=',$from_date);
				 $this->db->where('payment_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('payment_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_payments')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			if($this->session->userdata('branch_id'))
			{
				 $this->db->where('branch_id',$this->session->userdata('branch_id'));
			}
			if($this->session->userdata('dept_id'))
			{
				 $this->db->where('department_id',$this->session->userdata('dept_id'));
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('payment_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_payments')->result_array();
		}
		$this->load->view('account/payments_view',$data);
	}

	function view_journals()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1 && $to_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('journal_date>=',$from_date);
				 $this->db->where('journal_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('journal_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_journal')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			if($this->session->userdata('branch_id'))
			{
				 $this->db->where('branch_id',$this->session->userdata('branch_id'));
			}
			if($this->session->userdata('dept_id'))
			{
				 $this->db->where('department_id',$this->session->userdata('dept_id'));
			}
			 $this->db->where('is_deleted',"N");
			 $this->db->order_by('journal_date', 'DESC');
			 $this->db->order_by('voucher_number', 'ASC');
			$data['account'] = $this->db->get('view_account_journal')->result_array();
		}
		$this->load->view('account/journals_view',$data);
	}
	
	function voucher_edit()
	{
		$voucher_id = $this->uri->segment(3);
		$this->db->where('day_book_id',$voucher_id);
		$data['voucher'] = $this->db->get('view_account_day_book')->result_array();
		$this->load->view('account/voucher_edit',$data);
	}

	function voucher_update()
	{
		$account_section = $this->session->userdata('account_section_id');

		$data['day_book_id']			= $this->input->post('day_book_id');
		$data['branch_id']				= $this->input->post('branch');
		$data['department_id']			= $this->input->post('department');
		$data['day_book_date'] 			= date("Y-m-d", strtotime($this->input->post ('voucher_date')));
		$data['voucher_type_id']		= $this->input->post('voucher_type');
		$data['voucher_number']			= $this->input->post('voucher_number');
		$data['account_head_id']		= $this->input->post('item_head');
		$data['transaction_mode_id']	= $this->input->post('transaction_mode');
		$amount_type					= $this->input->post('amount_types');
		if($amount_type == '2'){
		$data['debit_amount']			= $this->input->post('amount');
		$data['credit_amount']			= "0";
		} 
		else if($amount_type == '1'){
		$data['credit_amount']			= $this->input->post('amount');
		$data['debit_amount']			= "0";
		}
		$data['narration']				= $this->input->post('narration');
		
		$this->db->where('day_book_id',$data['day_book_id']);
		$affected_row = $this->db->update('tbl_account_day_book',$data);
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','Updated');
		}
		redirect('account/view_voucher/');
	}
	
	function voucher_delete($day_book_id)
	{
		$deleted_by				= $this->session->userdata('login_user_id');
		$deleted_date			= date("Y-m-d");
		$this->db->where('day_book_id',$day_book_id);
		$this->db->set('deleted_by',$deleted_by);
		$this->db->set('deleted_date',$deleted_date);
		$this->db->set('is_deleted','Y');
		$affected_row = $this->db->update('tbl_account_day_book');
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','deleted');
		}
		redirect('account/view_voucher/'.$action);
	}
	
	function add_voucher_single()
	{
		$this->load->view('account/voucher_single');
	}
	
	function get_item_head($voucher_type,$dept)
	{
		$running_year = get_running_year();
		$this->db->where('department_id',$dept);
		if($this->session->userdata('account_section_id')!="1")
		{
			$this->db->where('account_section_id',$this->session->userdata('account_section_id')); 
		}
		if($voucher_type == "1"){
			$this->db->where('account_type_id','4'); 
		}
		if($voucher_type == "2"){
			$this->db->where('account_type_id','3'); 
		}
		if($voucher_type == "3"){
			$this->db->where('account_type_id','1'); 
		}
		$item_head  = $this->db->get('view_account_head')->result_array();//echo $this->db->last_query();die();
		echo '<option value="">Select</option>';
		foreach ($item_head as $row) 
		{
			echo '<option value="'.$row['account_head_id'].'">'.$row['account_head_name'].'</option>';
		}
	}
	
	function get_voucher_num($branch="",$dept="",$voucher_type="")
	{
		$account_section = $this->session->userdata('account_section_id');
		$query	=  $this->db->get_where("tbl_account_voucher_number", array('branch_id'=>$branch,'department_id'=>$dept,'accounting_section_id'=> $account_section,'voucher_type_id'=> $voucher_type))->row();
		//$voucher_number = $query->voucher_number;
		//echo $voucher_number;
		if($query)
		{
		$voucher_number = $query->voucher_number;
		echo $voucher_number;
		}
		else
		{
		echo "1";
		}
	}
	
	function voucher_single_add()
	{
		$account_section = $this->session->userdata('account_section_id');

		$data['branch_id']				= $this->input->post('branch');
		$data['department_id']			= $this->input->post('department');
		$data['day_book_date'] 			= date("Y-m-d", strtotime($this->input->post ('voucher_date')));
		$data['voucher_type_id']		= $this->input->post('voucher_type');
		$data['voucher_number']			= $this->input->post('voucher_number');
		$data['account_head_id']		= $this->input->post('item_head');
		$data['transaction_mode_id']	= $this->input->post('transaction_mode');
		$amount_type					= $this->input->post('amount_types');
		if($amount_type == '2'){
		$data['debit_amount']			= $this->input->post('amount');
		} 
		else if($amount_type == '1'){
		$data['credit_amount']			= $this->input->post('amount');
		}
		$data['narration']				= $this->input->post('narration');
		$data['created_by']				= $this->session->userdata('login_user_id');
		$data['created_date']			= date("Y-m-d");
		
		$affected_row = $this->db->insert('tbl_account_day_book',$data);
		if($affected_row>0)
		{
			$action = "added";
			$data['voucher_number'] = $data['voucher_number']+ 1;
			//echo $voucher_no;
			
			$this->db->set('voucher_number', $data['voucher_number']);
			$this->db->where('branch_id', $data['branch_id']);
			$this->db->where('department_id', $data['department_id']);
			$this->db->where('accounting_section_id', $account_section);
			$this->db->where('voucher_type_id', $data['voucher_type_id']);
			$this->db->update('tbl_account_voucher_number');
			if($this->db->affected_rows() == 0)
			{
				$data1['accounting_section_id'] = $account_section;
				$data1['voucher_type_id'] = $data['voucher_type_id'];
				$data1['branch_id'] = $data['branch_id'];
				$data1['department_id'] = $data['department_id'];
				$data1['voucher_number'] = $data['voucher_number'];
				
				$this->db->insert('tbl_account_voucher_number',$data1);
			}
		}

		redirect('account/view_voucher/');
	}
	function receipts_bulk() 
	{
		$this->load->view('account/receipts_bulk.php');
	}
	function receipts_bulk_add()
	{
		$running_year = get_running_year();
		$receipt_date 			= date("Y-m-d", strtotime($this->input->post ('receipt_date')));
		$payment_mode_id		= $this->input->post('payment_mod');
		$head_id				= $this->input->post('item_head[]');
		$amount					= $this->input->post('amount[]');
		$narration				= $this->input->post('narration[]');
		$approved				= $this->input->post('approved');
		$branch_id				= $this->input->post('branch');
		$department_id			= $this->input->post('department');
		
		$voucher_count  = sizeof($amount);
		for($i = 0; $i < $voucher_count; $i++)
		{
			$this->db->where('receipt_date',date("Y-m-d", strtotime($this->input->post ('receipt_date'))));
			$this->db->where('head_id', $head_id[$i]);
			$this->db->where('branch_id', $this->input->post('branch'));
			$this->db->where('department_id',$this->input->post('department'));
			$this->db->where('financial_year_id',$running_year);
			$this->db->where('is_deleted','N');
			$reciept = $this->db->get('tbl_account_receipts')->result_array();
			//echo $this->db->last_query();
			//print_r($reciept);die;
			if(count($reciept)==0)
			{
				$data['receipt_date'] 		= date("Y-m-d", strtotime($this->input->post ('receipt_date')));
				$data['payment_mode_id']	= $payment_mode_id;
				$data['head_id']			= $head_id[$i];
				$data['amount']				= $amount[$i];
				$data['narration']			= $narration[$i];
				$data['entered_by']			= $this->session->userdata('login_user_id');
				$data['entered_date']		= date("Y-m-d");
				$data['financial_year_id']	= $running_year;
				$data['branch_id']			= $branch_id;
				$data['department_id']		= $department_id;
				if($approved=='y')
				{
					$data['is_approved']		= 'Y';
					$data['approved_by']		= $this->session->userdata('login_user_id');
					$data['approved_date']		= date("Y-m-d");
				}
				$data['voucher_number']		= $this->db->get_where("tbl_account_voucher_number", array('branch_id'=>$branch_id,'department_id'=>$department_id,'voucher_type_id'=> '2'))->row()->voucher_number;
				
				$data1['voucher_number'] = $data['voucher_number']+ 1;
				$this->db->set('voucher_number', $data1['voucher_number']);
				$this->db->where('branch_id', $data['branch_id']);
				$this->db->where('department_id', $data['department_id']);
				$this->db->where('voucher_type_id', '2');
				$this->db->update('tbl_account_voucher_number');
	
				$affected_row = $this->db->insert('tbl_account_receipts',$data);
			}
			else
			{
				$this->db->where('receipt_date',date("Y-m-d", strtotime($this->input->post ('receipt_date'))));
				$this->db->where('head_id', $head_id[$i]);
				$this->db->where('branch_id', $this->input->post('branch'));
				$this->db->where('department_id',$this->input->post('department'));
				$this->db->where('financial_year_id',$running_year);
				$this->db->where('is_deleted','N');
				$this->db->set('amount',$amount[$i]);
				$this->db->update('tbl_account_receipts');
			}		
		}

		redirect('account/view_receipts/'.$action);
	}
	
	function receipt_edit($account_receipt_id)
	{
		$this->db->where('account_receipt_id',$account_receipt_id);
		$data['receipt'] = $this->db->get('tbl_account_receipts')->result_array();
		$this->load->view('account/receipt_edit',$data);
	}
	
	function receipt_update()
	{
		$account_receipt_id			= $this->input->post('receipt_id');
		$data['receipt_date'] 		= date("Y-m-d", strtotime($this->input->post ('receipt_date')));
		$data['head_id']			= $this->input->post('item_head');
		$data['amount']				= $this->input->post('amount');
		$data['narration']			= $this->input->post('narration');
		
		$this->db->where('account_receipt_id',$account_receipt_id);
		$this->db->update('tbl_account_receipts',$data);
		redirect('account/view_receipts/'.$action);
	
	}
	
	function receipt_delete($account_receipt_id)
	{
		$deleted_by				= $this->session->userdata('login_user_id');
		$deleted_date			= date("Y-m-d");
		$this->db->where('account_receipt_id',$account_receipt_id);
		$this->db->set('deleted_by',$deleted_by);
		$this->db->set('deleted_date',$deleted_date);
		$this->db->set('is_deleted','Y');
		$this->db->update('tbl_account_receipts');
		redirect('account/view_receipts/'.$action);
	}
	
	function payments_bulk() 
	{
		$this->load->view('account/payments_bulk.php');
	}
	function payment_bulk_add()
	{
		$running_year = get_running_year();
		$payment_mode_id		= $this->input->post('payment_mod');
		$head_id				= $this->input->post('item_head[]');
		$amount					= $this->input->post('amount[]');
		$narration				= $this->input->post('narration[]');
		$approved				= $this->input->post('approved');
		$branch_id				= $this->input->post('branch');
		$department_id			= $this->input->post('department');

		$voucher_count  = sizeof($amount);
		for($i = 0; $i < $voucher_count; $i++)
		{
			$this->db->where('payment_date',date("Y-m-d", strtotime($this->input->post ('payment_date'))));
			$this->db->where('head_id', $head_id[$i]);
			$this->db->where('branch_id', $this->input->post('branch'));
			//$this->db->where('department_id',$this->input->post('department'));
			$this->db->where('financial_year_id',$running_year);
			$this->db->where('is_deleted','N');
			$reciept = $this->db->get('tbl_account_payments')->result_array();

			if(count($reciept)==0)
			{

				$data['payment_date'] 		= date('Y-m-d', strtotime($this->input->post('payment_date')));
				$data['payment_mode_id']	= $payment_mode_id;
				$data['head_id']			= $head_id[$i];
				$data['amount']				= $amount[$i];
				$data['narration']			= $narration[$i];
				$data['entered_by']			= $this->session->userdata('login_user_id');
				$data['entered_date']		= date("Y-m-d");
				$data['financial_year_id']	= $running_year;
				$data['branch_id']			= $branch_id;
				$data['department_id']		= $department_id;
				if($approved=='y')
				{
					$data['is_approved']		= 'Y';
					$data['approved_by']		= $this->session->userdata('login_user_id');
					$data['approved_date']		= date("Y-m-d");
				}
				$data['voucher_number']		= $this->db->get_where("tbl_account_voucher_number", array('branch_id'=>$branch_id,'department_id'=>$department_id,'voucher_type_id'=> '1'))->row()->voucher_number;
				
				$data1['voucher_number'] = $data['voucher_number']+ 1;
				$this->db->set('voucher_number', $data1['voucher_number']);
				$this->db->where('branch_id', $data['branch_id']);
				$this->db->where('department_id', $data['department_id']);
				$this->db->where('voucher_type_id', '1');
				$this->db->update('tbl_account_voucher_number');
		
				$affected_row = $this->db->insert('tbl_account_payments',$data);
			}
			else
			{
				$this->db->where('payment_date',date("Y-m-d", strtotime($this->input->post ('payment_date'))));
				$this->db->where('head_id', $head_id[$i]);
				$this->db->where('branch_id', $this->input->post('branch'));
				//$this->db->where('department_id',$this->input->post('department'));
				$this->db->where('financial_year_id',$running_year);
				$this->db->where('is_deleted','N');
				$this->db->set('amount',$amount[$i]);
				$this->db->update('tbl_account_payments');
			}
		}
		redirect('account/view_payments/');
	}
	
	function payment_edit($account_payment_id)
	{
		$this->db->where('account_payment_id',$account_payment_id);
		$data['receipt'] = $this->db->get('tbl_account_payments')->result_array();
		$this->load->view('account/payments_edit',$data);
	}
	
	function payments_update()
	{
		$account_payment_id			= $this->input->post('payment_id');
		$data['payment_date'] 		= date("Y-m-d", strtotime($this->input->post ('payment_date')));
		$data['head_id']			= $this->input->post('item_head');
		$data['amount']				= $this->input->post('amount');
		$data['narration']			= $this->input->post('narration');
		
		$this->db->where('account_payment_id',$account_payment_id);
		$affected_row = $this->db->update('tbl_account_payments',$data);
		if($affected_row>0){
					$this->session->set_flashdata('action','updated');
					}
		redirect('account/view_payments/');
	}
	
	function payment_delete($account_payment_id)
	{
		$deleted_by				= $this->session->userdata('login_user_id');
		$deleted_date			= date("Y-m-d");
		$this->db->where('account_payment_id',$account_payment_id);
		$this->db->set('deleted_by',$deleted_by);
		$this->db->set('deleted_date',$deleted_date);
		$this->db->set('is_deleted','Y');
		$this->db->update('tbl_account_payments');
		redirect('account/view_payments/');
	}
	
	function journals_bulk() 
	{
		$this->load->view('account/journals_bulk.php');
	}
	function journal_bulk_add()
	{
		$running_year = get_running_year();
		$journal_date 			= date("Y-m-d", strtotime($this->input->post ('journal_date')));
		$payment_mode_id		= $this->input->post('payment_mod');
		$credit_head_id			= $this->input->post('credit_head[]');
		$debit_head_id			= $this->input->post('debit_head[]');
		$amount					= $this->input->post('amount[]');
		$narration				= $this->input->post('narration[]');
		$approved				= $this->input->post('approved');
		$branch_id				= $this->input->post('branch');
		$department_id			= $this->input->post('department');

		$voucher_count  = sizeof($amount);
		for($i = 0; $i < $voucher_count; $i++)
		{
			$data['journal_date'] 		= date("Y-m-d", strtotime($this->input->post ('journal_date')));
			$data['payment_mode_id']	= $payment_mode_id;
			$data['credit_head_id']		= $credit_head_id[$i];
			$data['debit_head_id']		= $debit_head_id[$i];
			$data['amount']				= $amount[$i];
			$data['narration']			= $narration[$i];
			$data['entered_by']			= $this->session->userdata('login_user_id');
			$data['entered_date']		= date("Y-m-d");
			$data['financial_year_id']	= $running_year;
			$data['branch_id']			= $branch_id;
			$data['department_id']		= $department_id;
			if($approved=='y')
			{
				$data['is_approved']		= 'Y';
				$data['approved_by']		= $this->session->userdata('login_user_id');
				$data['approved_date']		= date("Y-m-d");
			}
			$data['voucher_number']		= $this->db->get_where("tbl_account_voucher_number", array('branch_id'=>$branch_id,'department_id'=>$department_id,'voucher_type_id'=> '3'))->row()->voucher_number;
			
			$data1['voucher_number'] = $data['voucher_number']+ 1;
			$this->db->set('voucher_number', $data1['voucher_number']);
			$this->db->where('branch_id', $data['branch_id']);
			$this->db->where('department_id', $data['department_id']);
			$this->db->where('voucher_type_id', '3');
			$this->db->update('tbl_account_voucher_number');

			$affected_row = $this->db->insert('tbl_account_journal',$data);
		}
		redirect('account/view_journals/');
	}
	
	function journals_edit($account_journal_id)
	{
		$this->db->where('account_journal_id',$account_journal_id);
		$data['receipt'] = $this->db->get('tbl_account_journal')->result_array();
		$this->load->view('account/journals_edit',$data);
	}
	
	function journal_update()
	{
		$account_journal_id			= $this->input->post('journal_id');
		$data['journal_date'] 		= date("Y-m-d", strtotime($this->input->post ('journal_date')));
		$data['credit_head_id']		= $this->input->post('credit_head');
		$data['debit_head_id']		= $this->input->post('debit_head');
		$data['amount']				= $this->input->post('amount');
		$data['narration']			= $this->input->post('narration');
		
		$this->db->where('account_journal_id',$account_journal_id);
		$affected_row = $this->db->update('tbl_account_journal',$data);
		if($affected_row>0){
					$this->session->set_flashdata('action','updated');
					}
		redirect('account/view_journals/');
	}
	
	function journals_delete($account_journal_id)
	{
		$deleted_by				= $this->session->userdata('login_user_id');
		$deleted_date			= date("Y-m-d");
		$this->db->where('account_journal_id',$account_journal_id);
		$this->db->set('deleted_by',$deleted_by);
		$this->db->set('deleted_date',$deleted_date);
		$this->db->set('is_deleted','Y');
		$this->db->update('tbl_account_journal');
		redirect('account/view_journals/');
	}
	
	function expense_report()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $this->db->where('payment_date>=',$from_date);
			} 
			if($to_date1)
			{
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('payment_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('payment_date', 'DESC');
			$data['account'] = $this->db->get('view_account_payments')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
		 $this->db->order_by('payment_date', 'DESC');
		$data['account'] = $this->db->get('view_account_payments')->result_array();
		}
		$this->load->view('account/expense_report.php',$data);
	}
	
	function expense_report_pdf($branch_id='',$department_id='',$from_date='',$to_date='')
	{
		
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date1=date("Y-m-d", strtotime($from_date));
				 $this->db->where('payment_date>=',$from_date1);
			} 
			if($to_date)
			{
				 $to_date1=date("Y-m-d", strtotime($to_date));
				 $this->db->where('payment_date<=',$to_date1);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('payment_date', 'DESC');
			$data['account'] = $this->db->get('view_account_payments')->result_array();
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('account/expense_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'Expense_report.pdf','I');	
	}
	
	function expense_report_excel($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('payment_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('payment_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			$this->db->order_by('payment_date', 'DESC');
			$account = $this->db->get('view_account_payments')->result_array();
				ob_start();
				ob_get_clean();
				$i=1;
				$total=0;
				$image_url = base_url() . 'uploads/logo.png';
				echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
				
				echo "<tr><td colspan='7'></td></tr>";
				
				echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
				echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
				echo "<tr><td colspan='7' align='center'><h3></br>Expense Report</h3></td></tr>";	
				
				echo "<tr><td align='center'>Sl.No</td><td align='center'>Date</td><td align='center'>Voucher Number</td><td align='center'>Account Head</td><td align='center'>Amount</td><td align='center'>Narration</td></tr>";	
				foreach ($account as $data)
				{
				echo "<tr><td align='center'>".$i."</td><td align='center'>".date('d-m-Y',strtotime($data['payment_date']))."</td><td align='center'>".$data['voucher_number']."</td><td align='center'>".$data['account_head_name']."</td><td align='center'>".number_format($data['amount'],2)."</td><td align='center'>".$data['narration']."</td></tr>";	
					$i=$i+1;
					$total=$total+$data['amount'];
				}
				echo "<tr><td colspan='4' align='center'>Total</td><td align='center'>".number_format($total,2)."</td><td></td></tr>";	
				$filename = "ExpenseReport.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				die();
	}
	
	function income_report()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $this->db->where('receipt_date>=',$from_date);
			} 
			if($to_date1)
			{
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('receipt_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('receipt_date', 'DESC');
			$data['account'] = $this->db->get('view_account_receipts')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
		 $this->db->order_by('receipt_date', 'DESC');
		$data['account'] = $this->db->get('view_account_receipts')->result_array();
		}
		$this->load->view('account/income_report.php',$data);
	}
	
	function income_report_pdf($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('receipt_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('receipt_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('receipt_date', 'DESC');
			$data['account'] = $this->db->get('view_account_receipts')->result_array();
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('account/income_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'Income_report.pdf','I');	
	}
	
	function income_report_excel($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('receipt_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('receipt_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('receipt_date', 'DESC');
			$account = $this->db->get('view_account_receipts')->result_array();
				ob_start();
				ob_get_clean();
				$i=1;
				$total=0;
				$image_url = base_url() . 'uploads/logo.png';
				echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
				
				echo "<tr><td colspan='7'></td></tr>";
				
				echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
				echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
				echo "<tr><td colspan='7' align='center'><h3></br>Income Report</h3></td></tr>";	
				
				echo "<tr><td align='center'>Sl.No</td><td align='center'>Date</td><td align='center'>Voucher Number</td><td align='center'>Account Head</td><td align='center'>Amount</td><td align='center'>Narration</td></tr>";	
				foreach ($account as $data)
				{
				echo "<tr><td align='center'>".$i."</td><td align='center'>".date('d-m-Y',strtotime($data['receipt_date']))."</td><td align='center'>".$data['voucher_number']."</td><td align='center'>".$data['account_head_name']."</td><td align='right'>".number_format($data['amount'],2)."</td><td align='center'>".$data['narration']."</td></tr>";	
					$i=$i+1;
					$total=$total+$data['amount'];
				}
				echo "<tr><td colspan='4' align='center'>Total</td><td align='right'>".number_format($total,2)."</td><td></td></tr>";	

				$filename = "IncomeReport.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				die();
	}

	function cash_book_report()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($this->input->post())
		{
			$branch=$this->input->post('branch');
			$department=$this->input->post('department');
			$from_date1=$this->input->post('from_date');
			$to_date1=$this->input->post('to_date');

			$data['branch_id']=$branch;
			$data['department_id']=$department;
			$data['from_date']=$from_date1;
			$data['to_date']=$to_date1;
			if($from_date1)
			{
				 $from_date=date("Y-m-d", strtotime($from_date1));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date1)
			{
				 $to_date=date("Y-m-d", strtotime($to_date1));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch)
			{
				 $this->db->where('branch_id',$branch);
			}
			if($department)
			{
				 if($department!="All")
				 $this->db->where('department_id',$department);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		else
		{
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
		 $this->db->order_by('day_book_date', 'DESC');
		$data['account'] = $this->db->get('view_account_day_book')->result_array();
		}
		$this->load->view('account/cash_book_report.php',$data);
	}

	function cash_book_report_pdf($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('day_book_date', 'DESC');
			$data['account'] = $this->db->get('view_account_day_book')->result_array();
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('account/cash_book_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in = 'UTF-8';
        $mpdf->WriteHTML($html);
        $mpdf->Output($data['data'][0]->reference_no.'Cash_book_report.pdf','I');	
	}
	
	function cash_book_report_excel($branch_id="",$department_id="",$from_date="",$to_date="")
	{
		$account_section_id = $this->session->userdata('account_section_id');
			if($from_date)
			{
				 $from_date=date("Y-m-d", strtotime($from_date));
				 $this->db->where('day_book_date>=',$from_date);
			} 
			if($to_date)
			{
				 $to_date=date("Y-m-d", strtotime($to_date));
				 $this->db->where('day_book_date<=',$to_date);
			}
			if($branch_id)
			{
				 $this->db->where('branch_id',$branch_id);
			}
			if($department_id)
			{
				 if($department_id!="All")
				 $this->db->where('department_id',$department_id);
			}
			if($account_section_id!="1")
			{
				$this->db->where('account_section_id',$account_section_id);
			}
			 $this->db->order_by('day_book_date', 'DESC');
			$account = $this->db->get('view_account_day_book')->result_array();
				ob_start();
				ob_get_clean();
				$i=1;
				$credit_total=0;
				$debit_total=0;

				$image_url = base_url() . 'uploads/logo.png';
				echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
				
				echo "<tr><td colspan='7'></td></tr>";
				
				echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
				echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
				echo "<tr><td colspan='7' align='center'><h3></br>Cash Book Report</h3></td></tr>";	
				
				echo "<tr><td align='center'>Sl.No</td><td align='center'>Date</td><td align='center'>Voucher Number</td><td align='center'>Account Head</td><td align='center'>Credit Amount</td><td align='center'>Debit Amount</td><td align='center'>Narration</td></tr>";	
				foreach ($account as $data)
				{
				echo "<tr><td align='center'>".$i."</td><td align='center'>".date('d-m-Y',strtotime($data['day_book_date']))."</td><td align='center'>".$data['voucher_number']."</td><td align='center'>".$data['account_head_name']."</td><td align='center'>".$data['credit_amount']."</td><td align='center'>".$data['debit_amount']."</td><td align='center'>".$data['narration']."</td></tr>";	
					$i=$i+1;
					$credit_total=$credit_total+$data['credit_amount'];
					$debit_total=$debit_total+$data['debit_amount'];
				}
				echo "<tr><td colspan='4' align='center'>Total</td><td align='center'>".$credit_total."</td><td align='center'>".$debit_total."</td><td></td></tr>";	

				$filename = "CashBook.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				die();
	}

	function opening_balance()
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($account_section_id!="1")
		{
			$this->db->where('account_section_id',$this->session->userdata('account_section_id')); 
		}
		if($this->session->userdata('dept_id'))
		{
			$this->db->where('department_id',$this->session->userdata('dept_id')); 
		}
		$data['category'] = $this->db->get('tbl_account_head')->result_array();
		$this->load->view('account/set_opening_balance.php',$data);
	}
	
	function set_opening_balance()
	{
		$running_year = get_running_year();
		$account_head_id=$this->input->post('account_head_id[]');
		$opening_balance=$this->input->post('opening_balance[]');
		for($i=0;$i<count($account_head_id);$i++)
		{
			$data['head_id'] = $account_head_id[$i]; 
			$data['opening_balance'] = $opening_balance[$i];
			$data['financial_year_id'] = $running_year;
			$this->db->where('head_id',$account_head_id[$i]);
			$balance = $this->db->get('tbl_account_opening_balance')->result_array();
			if(count($balance) > 0)
			{
				$this->db->where('head_id',$account_head_id[$i]);
				$this->db->set('opening_balance',$opening_balance[$i]);
				$this->db->update('tbl_account_opening_balance');
			}
			else
			{
				$this->db->insert('tbl_account_opening_balance',$data);
			}
		}
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','updated');
		}
		redirect('account/opening_balance/');
 	}

	function assign_account_heads()
	{
		$this->load->view('account/assign_account_heads');
	}
	
	function manage_account_heads()
	{
		$running_year = get_running_year();
		$account_head_id=$this->input->post('account_head_id[]');
		$account_section=$this->input->post('account_section[]');
		for($i=0;$i<count($account_head_id);$i++)
		{
			$data['account_head_id'] = $account_head_id[$i]; 
			$data['account_section_id'] = $account_section[$i];
			$this->db->where('account_head_id',$account_head_id[$i]);
			$section = $this->db->get('tbl_account_head_section')->result_array();
			if(count($section) > 0)
			{
				$this->db->where('account_head_id',$account_head_id[$i]);
				$this->db->set('account_section_id',$account_section[$i]);
				$this->db->update('tbl_account_head_section');
			}
			else
			{
				$affected_row = $this->db->insert('tbl_account_head_section',$data);
			}
		}
		if($affected_row>0)
		{
			$this->session->set_flashdata('action','updated');
		}
		redirect('account/assign_account_heads/');
	}

	function get_account_head($type_id)
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($account_section_id!="1")
		{
			$this->db->where('account_section_id',$this->session->userdata('account_section_id')); 
		}
		if($this->session->userdata('dept_id'))
		{
			$this->db->where('department_id',$this->session->userdata('dept_id')); 
		}
		$this->db->where('account_type_id',$type_id);
		$data['category'] = $this->db->get('view_account_head')->result_array();
		$this->load->view('account/opening_balance',$data);
	}
	
	function get_account_head_to_assign($type_id)
	{
		$account_section_id = $this->session->userdata('account_section_id');
		if($account_section_id!="1")
		{
			$this->db->where('account_section_id',$this->session->userdata('account_section_id')); 
		}
		if($this->session->userdata('dept_id'))
		{
			$this->db->where('department_id',$this->session->userdata('dept_id')); 
		}
		$this->db->where('account_type_id',$type_id);
		$data['category'] = $this->db->get('view_account_head')->result_array();
		$this->load->view('account/account_heads_assign',$data);
	}
	
	function stock_sales_to_accounts($date="")
	{
		if($date!="")
		{
//			echo date('Y-m-d',strtotime($date));die;
			$this->db->select('SUM(net_total) AS fee_amount,branch_id,dept_id AS department_id');
			$this->db->where('sales_date',date('Y-m-d',strtotime($date)));
			$this->db->where('is_deleted','N');
			$data['stock'] = $this->db->get('view_stock_sales')->result_array();
			$this->load->view('account/stock_sales_to_account_by_date',$data);	
		}
		else
		{
			$this->db->select('SUM(net_total) AS fee_amount,branch_id,dept_id AS department_id');
			$this->db->where('sales_date',date('Y-m-d'));
			$this->db->where('is_deleted','N');
		//	$this->db->group_by('fee_head');
			$data['stock'] = $this->db->get('view_stock_sales')->result_array();
	//		print_r($data['stock']);die;
			$this->load->view('account/post_stock_sales_to_account',$data);	
		}
	}

	function stock_purchase_to_accounts($date="")
	{
		if($date!="")
		{
			$this->db->select('SUM(purchase_price) AS fee_amount,branch_id,department_id');
			$this->db->where('purchase_date',date('Y-m-d',strtotime($date)));
			$this->db->where('is_deleted','N');
			$data['stock'] = $this->db->get('view_stock_purchase')->result_array();
			$this->load->view('account/stock_purchase_to_account_by_date',$data);	
		}
		else
		{
			$this->db->select('SUM(purchase_price) AS fee_amount,branch_id,department_id');
			$this->db->where('purchase_date',date('Y-m-d'));
			$this->db->where('is_deleted','N');
		//	$this->db->group_by('fee_head');
			$data['stock'] = $this->db->get('view_stock_purchase')->result_array();
			//echo $this->db->last_query();
			//print_r($data['stock']);die;
			$this->load->view('account/post_stock_purchase_to_account',$data);
		}
	}
		
//********** account end ***********//

}