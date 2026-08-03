<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class FeeManagement extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }

    public function index() {

        $button_name = 'Save';
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $fee_name = $this->input->post('fee_item');
            $fee_item_invoice = $this->input->post('fee_item_invoice');

            $fee_jan = (null === $this->input->post('jan_chk')) ? 0 : 1;
            $fee_feb = (null === $this->input->post('feb_chk')) ? 0 : 1;
            $fee_mar = (null === $this->input->post('mar_chk')) ? 0 : 1;
            $fee_apr = (null === $this->input->post('apr_chk')) ? 0 : 1;
            $fee_may = (null === $this->input->post('may_chk')) ? 0 : 1;
            $fee_jun = (null === $this->input->post('jun_chk')) ? 0 : 1;
            $fee_jul = (null === $this->input->post('jul_chk')) ? 0 : 1;
            $fee_aug = (null === $this->input->post('aug_chk')) ? 0 : 1;
            $fee_sep = (null === $this->input->post('sep_chk')) ? 0 : 1;
            $fee_oct = (null === $this->input->post('oct_chk')) ? 0 : 1;
            $fee_nov = (null === $this->input->post('nov_chk')) ? 0 : 1;
            $fee_dec = (null === $this->input->post('dec_chk')) ? 0 : 1;
            $amount_details = $this->input->post('fee_amount');

            /**
             * Saving the submitted data             
             */
            $data['fee_item'] = $fee_name;
            $data['fee_item_invoice'] = $fee_item_invoice;
            $data['is_active'] = 1;
            $data['JAN'] = $fee_jan;
            $data['FEB'] = $fee_feb;
            $data['MAR'] = $fee_mar;
            $data['APR'] = $fee_apr;
            $data['MAY'] = $fee_may;
            $data['JUN'] = $fee_jun;
            $data['JUL'] = $fee_jul;
            $data['AUG'] = $fee_aug;
            $data['SEP'] = $fee_sep;
            $data['OCT'] = $fee_oct;
            $data['NOV'] = $fee_nov;
            $data['DEC'] = $fee_dec;
            /**
             * Saving the submitted data  - To fee_items           
             */
            $this->db->insert('fee_items', $data);
            $fee_item_id = $this->db->insert_id();

            /**
             * Saving the submitted data  - To fee_amount_classwise           
             */
            foreach ($amount_details as $class_id => $amt_detail) {
                $this->db->insert('fee_amount_classwise', array(
                    'fee_item' => $fee_item_id,
                    'class' => $class_id,
                    'amount' => $amt_detail,
                ));
            }
        } else {
            $fee_name = '';
            $fee_item_invoice = '';
            $fee_jan = 0;
            $fee_feb = 0;
            $fee_mar = 0;
            $fee_apr = 0;
            $fee_may = 0;
            $fee_jun = 0;
            $fee_jul = 0;
            $fee_aug = 0;
            $fee_sep = 0;
            $fee_oct = 0;
            $fee_nov = 0;
            $fee_dec = 0;
            $amount_details = array();
        }
        $page_data['amount_details'] = $amount_details;
        $page_data['fee_item_invoice'] = $fee_item_invoice;
        $page_data['button_name'] = $button_name;
        $page_data['fee_name'] = $fee_name;
        $page_data['fee_jan'] = $fee_jan;
        $page_data['fee_feb'] = $fee_feb;
        $page_data['fee_mar'] = $fee_mar;
        $page_data['fee_apr'] = $fee_apr;
        $page_data['fee_may'] = $fee_may;
        $page_data['fee_jun'] = $fee_jun;
        $page_data['fee_jul'] = $fee_jul;
        $page_data['fee_aug'] = $fee_aug;
        $page_data['fee_sep'] = $fee_sep;
        $page_data['fee_oct'] = $fee_oct;
        $page_data['fee_nov'] = $fee_nov;
        $page_data['fee_dec'] = $fee_dec;

        $form_action = 'feeManagement';
        $page_data['form_action'] = $form_action;



        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name'] = 'fee_management';
        $page_data['page_title'] = get_phrase('Fee Management');
        $this->load->view('backend/index', $page_data);
    }

    public function ListAll() {
        $page_data['page_name'] = 'fee_management_list';
        $page_data['page_title'] = get_phrase('Fee Management - All');

        $this->load->view('backend/index', $page_data);
    }

    public function Edit($id) {

        $button_name = 'Modify';
        $form_action = 'feeManagement/Edit/' . $id;
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $fee_name = $this->input->post('fee_item');
            $fee_item_invoice = $this->input->post('fee_item_invoice');

            $fee_jan = (null === $this->input->post('jan_chk')) ? 0 : 1;
            $fee_feb = (null === $this->input->post('feb_chk')) ? 0 : 1;
            $fee_mar = (null === $this->input->post('mar_chk')) ? 0 : 1;
            $fee_apr = (null === $this->input->post('apr_chk')) ? 0 : 1;
            $fee_may = (null === $this->input->post('may_chk')) ? 0 : 1;
            $fee_jun = (null === $this->input->post('jun_chk')) ? 0 : 1;
            $fee_jul = (null === $this->input->post('jul_chk')) ? 0 : 1;
            $fee_aug = (null === $this->input->post('aug_chk')) ? 0 : 1;
            $fee_sep = (null === $this->input->post('sep_chk')) ? 0 : 1;
            $fee_oct = (null === $this->input->post('oct_chk')) ? 0 : 1;
            $fee_nov = (null === $this->input->post('nov_chk')) ? 0 : 1;
            $fee_dec = (null === $this->input->post('dec_chk')) ? 0 : 1;
            $amount_details = $this->input->post('fee_amount');

            /**
             * Saving the submitted data             
             */
            $data['fee_item'] = $fee_name;
            $data['fee_item_invoice'] = $fee_item_invoice;
            $data['is_active'] = 1;
            $data['JAN'] = $fee_jan;
            $data['FEB'] = $fee_feb;
            $data['MAR'] = $fee_mar;
            $data['APR'] = $fee_apr;
            $data['MAY'] = $fee_may;
            $data['JUN'] = $fee_jun;
            $data['JUL'] = $fee_jul;
            $data['AUG'] = $fee_aug;
            $data['SEP'] = $fee_sep;
            $data['OCT'] = $fee_oct;
            $data['NOV'] = $fee_nov;
            $data['DEC'] = $fee_dec;
            /**
             * Saving the submitted data  - To fee_items           
             */
            $this->db->where('id', $id);
            $this->db->update('fee_items', $data);
            /**
             * Remove the already saved data  - To fee_amount_classwise           
             */
            $this->db->where('fee_item', $id);
            $this->db->delete('fee_amount_classwise');

            /**
             * Saving the submitted data  - To fee_amount_classwise           
             */
            foreach ($amount_details as $class_id => $amt_detail) {
                $this->db->insert('fee_amount_classwise', array(
                    'fee_item' => $id,
                    'class' => $class_id,
                    'amount' => $amt_detail,
                ));
            }
        } else {
            $this->db->where('id', $id);
            $fee_items = $this->db->get('fee_items')->row();
            $fee_name = $fee_items->fee_item;
            $fee_item_invoice = $fee_items->fee_item_invoice;
            $fee_jan = $fee_items->JAN;
            $fee_feb = $fee_items->FEB;
            $fee_mar = $fee_items->MAR;
            $fee_apr = $fee_items->APR;
            $fee_may = $fee_items->MAY;
            $fee_jun = $fee_items->JUN;
            $fee_jul = $fee_items->JUL;
            $fee_aug = $fee_items->AUG;
            $fee_sep = $fee_items->SEP;
            $fee_oct = $fee_items->OCT;
            $fee_nov = $fee_items->NOV;
            $fee_dec = $fee_items->DEC;
            $this->db->where('fee_item', $id);
            $amnt_details = $this->db->get('fee_amount_classwise')->result_array();
            foreach ($amnt_details as $ad) {
                $class = $ad['class'];
                $amount_details[$class] = $ad['amount'];
            }
        }
        $page_data['amount_details'] = $amount_details;
        $page_data['fee_item_invoice'] = $fee_item_invoice;
        $page_data['button_name'] = $button_name;
        $page_data['fee_name'] = $fee_name;
        $page_data['fee_jan'] = $fee_jan;
        $page_data['fee_feb'] = $fee_feb;
        $page_data['fee_mar'] = $fee_mar;
        $page_data['fee_apr'] = $fee_apr;
        $page_data['fee_may'] = $fee_may;
        $page_data['fee_jun'] = $fee_jun;
        $page_data['fee_jul'] = $fee_jul;
        $page_data['fee_aug'] = $fee_aug;
        $page_data['fee_sep'] = $fee_sep;
        $page_data['fee_oct'] = $fee_oct;
        $page_data['fee_nov'] = $fee_nov;
        $page_data['fee_dec'] = $fee_dec;
        $page_data['form_action'] = $form_action;

        if ($this->session->userdata('admin_login') != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name'] = 'fee_management';
        $page_data['page_title'] = get_phrase('Fee Management - Edit');

        $this->load->view('backend/index', $page_data);
    }

    public function generate($month = null, $year = null) {
        $form_action = 'feeManagement/generate';
        $page_data['page_name'] = 'fee_invoice_generate';
        $page_data['page_title'] = get_phrase('Fee Management - Invoice Generate');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $month = $this->input->post('month');
            $year = $this->input->post('year');
        }

        if (null != $month && null != $year) {
            $this->db->where(array(
                'year' => $year,
                'month' => $month,
            ));
            $invoices = $this->db->get('invoice_history')->result_array();
            $invoices_count = count($invoices);
            if (0 === $invoices_count) {

                // Fetch all fees - classes and amount for the selected month
                $this->db->where(array(
                    $month => 1,
                ));
                $fee_items = $this->db->get('fee_items')->result_array();
                $fee_items_array = array();
                foreach ($fee_items as $f_items) {

                    $f_id = $f_items['id'];

                    $this->db->where(array(
                        'fee_item' => $f_id,
                    ));
                    $fee_items_amnt = $this->db->get('fee_amount_classwise')->result_array();

                    foreach ($fee_items_amnt as $f_items_amnt) {
                        $class = $f_items_amnt['class'];
                        $fee_items_array[$f_id][$class] = $f_items_amnt['amount'];
                    }
                }
                $students_enroll = $this->db->get('enroll')->result_array();
                $this->db->order_by("student", "asc");
                $this->db->order_by("fee_item", "asc");

                $students_fee = $this->db->get('student_fee')->result_array();

                $student_details = array();

                foreach ($students_enroll as $se) {
                    $st_id = $se['student_id'];
                    $student_details[$st_id]['class'] = $se['class_id'];
                }
                foreach ($students_fee as $sf) {
                    $sf_id = $sf['student'];
                    $student_details[$sf_id]['fee_itm'][] = $sf['fee_item'];
                }
                // Creating invoice  - for the month
                $slno = 1;
                $this->db->trans_begin();
                foreach ($student_details as $inv_student => $s_details) {
                    $inv_class = $s_details['class'];
                    $inv_fee_items = $s_details['fee_itm'];

                    $inv_fee_items_cnt = count($inv_fee_items);
                    if ($inv_fee_items_cnt > 0) {

                        $invoice_no = 'INV/' . $month . '/' . $year . '/' . $slno;
                        $invoice_date = date('Y-m-d');
                        $inv_amount_total = 0;

                        $invoice_head = array(
                            'invoice_no' => $invoice_no,
                            'invoice_date' => $invoice_date,
                            'student' => $inv_student,
                            'month' => $month,
                            'year' => $year,
                        );
                        $this->db->insert('invoice_head', $invoice_head);
                        $invoice_head_id = $this->db->insert_id();
                        $inv_items = array();
                        foreach ($inv_fee_items as $inv_fee_item) {
                            $inv_amount = isset($fee_items_array[$inv_fee_item][$inv_class]) ? $fee_items_array[$inv_fee_item][$inv_class] : 0;
                            $inv_amount_total += $inv_amount;
                            $inv_items[] = array(
                                'invoice_id' => $invoice_head_id,
                                'item' => $inv_fee_item,
                                'amount' => $inv_amount,
                            );
                        }
                        $this->db->insert_batch('invoice_details', $inv_items);

                        $this->db->where('id', $invoice_head_id);
                        $this->db->update('invoice_head', array(
                            'amount' => $inv_amount_total,
                        ));
                        $slno++;
                    }
                }
                $this->db->insert('invoice_history', array(
                    'year' => $year,
                    'month' => $month,
                ));
                $this->db->trans_commit();
            }
        }
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['form_action'] = $form_action;
        $this->load->view('backend/index', $page_data);
    }

    public function mapping() {
        $section = $this->input->post('section');
        $form_action = 'feeManagement/mapping';
        $page_data['section'] = $section;
        $page_data['form_action'] = $form_action;
        $page_data['page_name'] = 'fee_student_mapping';
        $page_data['page_title'] = get_phrase('Fee Student - Mapping');
        $this->load->view('backend/index', $page_data);
    }
    
    public function mappingAction() {
        
        $flag = $this->input->post('flag');
        $student = $this->input->post('student');
        $fee = $this->input->post('fee');
        
        $this->db->delete('student_fee', array(
                'student' => $student,
                'fee_item' => $fee,
            ));
        if("add" == $flag){
            $this->db->insert('student_fee', array(
                'student' => $student,
                'fee_item' => $fee,
            ));
        }
    }
    public function pendingList() {
        
        $page_data['page_name'] = 'invoice_pending_students';
        $page_data['page_title'] = get_phrase('Fee Pending List');
        $this->load->view('backend/index', $page_data);
        
    }
	
	
	function edit_fee_master($fee_master_id)
	{
        $page_data['fee_master_id'] = $fee_master_id;
        $this->load->view('admin/edit_fee_master', $page_data);
	}
	
	
	function fee_master($param1 = '', $param2 = '', $param3 = '')
	{
		
		
		
		if ($param1 == 'delete') 
		{
			$this->Fee_management_model->delete_fee_master($param2);
			redirect('feeManagement/fee_master/', 'refresh');
		}
		
		else if ($param1 == 'edit')
		{
			
			$fee_master_id=$this->session->userdata('fee_master_id');
			
			$data['fee_master_name'] = 	rawurldecode(  $this->input->post('fee_master_name'));
			$data['class_id']  		 =  $this->input->post('class_id');
			$data['fee_total']		 =	$this->input->post('tot');
			
			$this->Fee_management_model->update_fee_master($fee_master_id,$data);
			$this->Fee_management_model->delete_fee_details($fee_master_id);
			
			$fees		=	$this->input->post('fee_details1');
			$hdnfees	=	$this->input->post('hdnfee_details');

			$count1		=	count($fees);
			$count		=	count($hdnfees);
			
			for($i=0;$i<$count;$i++)
			{
				if($fees[$i]>0)
				{
					$data1['fee_master_id']	=	$fee_master_id;
					$data1['fee_head_id']	= 	$hdnfees[$i];
					$data1['fee_amount']	=	$fees[$i];
					$this->Fee_management_model->insert_fee_details($data1);
				}
			}	
		}
		
		$fee_master = $this->Fee_management_model->get_fee_master();
		
		$page_data['fee_master']	=	$fee_master;
		$page_data['page_name']     =	'fee_master';
		$page_data['page_title']    =	'Private-Messages';
		$this->load->view('admin/fee_master.php', $page_data);
}
	function edit_fee_master1($fee_master_id)
	{
		$data['result']				=	$this->fee_management_model->edit_fee_master1($fee_master_id);
		$data['fee_heads'] 			= 	$this->Fee_management_model->get_fee_heads('1');
		$data['installments'] 		= 	$this->Fee_management_model->fee_payment_options_details($payment_option);
		$this->load->view('admin/edit_fee_master1',$data);
	}
		
	function fee_check($classid,$name)
	{
		$fee_heads = $this->Fee_management_model->get_fee_heads();
		$page_data['fee_heads'] 	=	$fee_heads;
		$page_data['class']			=	$classid;
		$page_data['name']			=	$name;
		 
		$this->load->view('check_fee_master.php', $page_data);
	}
	function installment_check($classid){
		
		
		 $this->db->select('fee_head_id,fee_head');
		 $this->db->where('active','Y');
		$cls = $this->db->get('tbl_fee_heads')->result_array();
		$data['student'] =$cls;
		$data['class']=$classid;
		 
		$this->load->view('fee_installment.php', $data);
	
	
	
	}
	function payement_check($option,$fee_name,$class_id){
		
		
		 $this->db->select('fee_payment_options_details_id,fee_payment_options_details');
		 $this->db->where('fee_payment_options_master_id',$option);
		$cls = $this->db->get('tbl_fee_payment_options_details')->result_array();
		$data['student'] =$cls;
		$data['option']=$option;
		$data['fee_name']=$fee_name;
		$data['class_id']=$class_id;
		
		
		 
		$this->load->view('backend/admin/fees_payement_option', $data);
	
	
	
	}


	
	
	
	
	function edit_fee_details($classid,$name)
	{
		$data['class']=$classid;
		$data['name']=$name;
		$this->load->view('backend/admin/fee_details_edit', $data);
	}
	
	
	 function insert_fee_master()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
			
		$page_data['page_name']                 = 'fee_master';
		$page_data['page_title']                = get_phrase('Private-Messages');
		
		$data['fee_master_name']=rawurldecode( $this->input->post('fee_master_name'));
		$data['class_id']= $this->input->post('class_id');
		$data['fee_total']= $this->input->post('total');
		$this->db->insert('tbl_fee_master', $data);
		

		$master_id= $this->db->insert_id();
		$fees=($_POST['fee_details']);
		$hdnfees=$_POST['hdnfee_details'];
		$count1=count($fees);
		
		$count=count($hdnfees);
		
		for($i=0;$i<$count;$i++)
		{
			if($fees[$i]>0)
			{
				$data1['fee_master_id']= $master_id;
				$data1['fee_head_id']= $hdnfees[$i];
				$data1['fee_amount']=$fees[$i];
				$this->db->insert('tbl_fee_details', $data1);
			}
		}
	
		$page_data['page_name']                 = 'fee_master';
		$page_data['page_title']                = get_phrase('Private-Messages');
		//$this->load->view('backend/index', $page_data);
		   redirect(base_url() . 'index.php?FeeManagement/fee_master/', 'refresh');
    }
		 
	function student_fee_payment()
	{
//		$receipt_number             = 	$this->input->post('txtreceipt_number');
		$branch_id					=	$this->input->post('branch_id');
		$receipt_number				=	get_receipt_number("Receipt",$branch_id)+1;
		$year 						= 	get_running_year();	
	
		//echo $this->input->post('auto_gen_receipt');die;
		if($this->db->get_where('settings', array('type' => 'auto_gen_receipt'))->row()->description=='yes')
		{
			if($this->input->post('auto_gen_receipt')=='1')
			{
				$receipt_number		=	get_receipt_number("Receipt",$branch_id)+1;
			}
		}
		//echo $receipt_number;die;
		
	  //If 	tbl_deleted_receipts is present, then check if the receipt number exist in that table. If exist,change is_alloted to true and don't update tbl_voucher table.
		if($this->db->table_exists('tbl_deleted_receipts'))
		{
			$this->db->where('receipt_number',$receipt_number);
			$this->db->where('branch_id', $branch_id);
			$this->db->where('year_id', $year);
			$this->db->set('is_allotted',TRUE);
			$this->db->update('tbl_deleted_receipts');
			if($this->db->affected_rows() == 0)
			{
				$data = array('voucher_number' => $receipt_number );
				$this->db->where('voucher_type_name', "Receipt");
				$this->db->where('branch_id', $branch_id);
				$this->db->where('academic_year_id', $year);
				$this->db->update('tbl_voucher', $data); 
			}
		}
		else
		{
			$data = array('voucher_number' => $receipt_number );
			$this->db->where('voucher_type_name', "Receipt");
			$this->db->where('branch_id', $branch_id);
			$this->db->where('academic_year_id', $year);
			$this->db->update('tbl_voucher', $data); 
		}
		$data   =   array();
                /************* Opening Balance Payment Start ***************/
                $op_bal_years           =   $this->input->post('op_bal_year[]');
                $amount			=   $this->input->post('amount')- $this->input->post('late_fee');
                $student_id		=   $this->input->post('student_id');
                $var 						= 		$this->input->post('txtdate_paid');
		$date 						= 		str_replace('/', '-', $var);
		date_default_timezone_set('Asia/Kolkata');
		$date_paid 					=  		date('Y-m-d', strtotime($date))." ".date('H:i:s');
                $cnt                                            =               0;
                if($op_bal_years)
                {
                    for($i=0;$i<count($op_bal_years);$i++):
                        $year_id            =   $op_bal_years[$i];    
                        $op_bal_fee_head_ids=   $this->input->post('op_bal_fee_head_'.$year_id.'[]');
                        $op_bal_ids         =   $this->input->post('op_bal_id_'.$year_id.'[]');
                        //print_r($op_bal_fee_heads);
                        for($j=0;$j<count($op_bal_fee_head_ids);$j++):
                            $fee_head_id    =   $op_bal_fee_head_ids[$j]; 
                            $op_bal_id      =   $op_bal_ids[$j];    //echo $op_bal_id."-".$fee_head_id."<br>";
                            if(null !== $this->input->post('op_bal_balance_check_'.$year_id.'_'.$fee_head_id))
                            {   
                                $cnt++;
                                $pay_amount                     =   $this->input->post('op_bal_balance_check_'.$year_id.'_'.$fee_head_id);
                                if($amount>=$pay_amount)
                                {
                                    $data['opening_balance_id'] =   $op_bal_id;
                                    $data['receipt_number']     =   $receipt_number;
                                    $data['amount_paid']        =   $pay_amount;
                                    $data['date_paid']          =   $date_paid;
                                    $data['student_id']         =   $student_id;
                                    $data['paid_year_id']       =   get_running_year();
                                    $data['remarks']            =   "";
                                    $data['collected_by']       =   $this->session->userdata('login_user_id');
                                    $data['collected_date']     =   date('Y-m-d H:i:s');
    
                                    if($fee_head_id != 999999)
                                    {
                                        $this->db->insert('tbl_opening_balance_fee_collection',$data);
                                        
                                        
                                        $this->db->where('id',$op_bal_id);
                                        $this->db->set('fee_balance','fee_balance-'.$pay_amount,FALSE);
                                        $this->db->update('tbl_opening_balance');
                                    }
                                    else if($fee_head_id == 999999)
                                    {
                                        $this->db->insert('tbl_opening_balance_transport_fee_collection',$data);
                                        
                                        $this->db->where('id',$op_bal_id);
                                        $this->db->set('fee_balance','fee_balance-'.$pay_amount,FALSE);
                                        $this->db->update('tbl_opening_balance_transport');
                                    }
                                    
                                    $amount                     =   $amount-$pay_amount;
                                }
                                else if($amount<$pay_amount && $amount!=0)
                                {
                                    $data['opening_balance_id'] =   $op_bal_id;
                                    $data['receipt_number']     =   $receipt_number;
                                    $data['amount_paid']        =   $amount;
                                    $data['date_paid']          =   $date_paid;
                                    $data['student_id']         =   $student_id;
                                    $data['paid_year_id']       =   get_running_year();
                                    $data['remarks']            =   "";
                                    $data['collected_by']       =   $this->session->userdata('login_user_id');
                                    $data['collected_date']     =   date('Y-m-d H:i:s');
    
                                    if($fee_head_id != 999999)
                                    {
                                        $this->db->insert('tbl_opening_balance_fee_collection',$data);
                                        
                                        
                                        $this->db->where('id',$op_bal_id);
                                        $this->db->set('fee_balance','fee_balance-'.$amount,FALSE);
                                        $this->db->update('tbl_opening_balance');
                                    }
                                    else if($fee_head_id == 999999)
                                    {
                                        $this->db->insert('tbl_opening_balance_transport_fee_collection',$data);
                                        
                                        $this->db->where('id',$op_bal_id);
                                        $this->db->set('fee_balance','fee_balance-'.$amount,FALSE);
                                        $this->db->update('tbl_opening_balance_transport');
                                    }
                                    
                                    $amount                     =   0;
                                }
                            }
                        endfor;
                    endfor;
                }    
                //die;
                /************* Opening Balance Payment End ***************/
                
		
		$installments = $this->input->post('balance_check[]');
		$fee_items = $this->input->post('fee_head_balance_check[]');
		
		$inst_count = count($installments);
		$item_count = count($fee_items);
	
		$late_fee					=		$this->input->post('late_fee');
		$receipt_number				=		$receipt_number;	//get_receipt_number("Receipt");
		$payment_mode				=		$this->input->post('lstpayment_mode');
	
		$dept_id					=		$this->input->post('dept_id');
		$class_id					=		$this->input->post('class');
		$section					=		$this->input->post('section');
		$student_id					=		$this->input->post('student_id');
		$var 						= 		$this->input->post('txtdate_paid');
		$date 						= 		str_replace('/', '-', $var);
		date_default_timezone_set('Asia/Kolkata');
		$date_paid 					=  		date('Y-m-d', strtotime($date))." ".date('H:i:s');
		$academic_year_id			=		get_running_year();
		if(isset($_POST['chk_send_sms']))
		{
			$amount	=	$this->input->post('amount');
			$phone_number = get_student_phone($student_id);
			$msg= "Dear Student, Your fee Rs. " . $amount	. " is received on " . date('d/m/Y',strtotime($date_paid)) . " and the Receipt No. is " . $receipt_number;
			
			/////////////////////////////////////////////////////
			$sms = $this->db->get('sms_settings')->row();
			$sender_id = $sms->sender_id;
			$username = $sms->username;
			$password = $sms->password;
			$common = $sms->common_word;
			$url = $sms->url;
//			$location = 'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.urlencode($phone_number).'&msg=' .urlencode($msg." ").'&route=T';
//			$api = $url;
//			$handle = fopen($api."/creditsleft/".$username."/".$password."/T", "r");
//			$balance = stream_get_contents($handle);
//			if($balance >= 0)
//			{
//				$api."/sendsms?".$location;
//				$send = fopen($api."/sendsms?".$location,"r");
//				$return_message_ids = stream_get_contents($send);
//				$message_id_array = explode($return_message_ids,''); 
//			}
				//////////////////////////////////////////////////////
		}

		if($inst_count>0)
		{
			$students_fee_master_id		=		$this->input->post('students_fee_master_id');
			$check_uncheck				=		$this->input->post('check_uncheck');
			$check_balance				=		$this->input->post('check_balance');
			//$amount						=		$this->input->post('amount')- $this->input->post('late_fee');
			$count						=		count($check_balance);

			for($i=0;$i<$count;$i++)
			{
				if($check_uncheck[$i]==1)
				{
				
					if($amount >=$check_balance[$i])
					{
						// insert into collection master
						$data4['date_paid']				=	$date_paid;
						$data4['receipt_number']		=	$receipt_number;
						$data4['student_fee_master_id']	=	$students_fee_master_id[$i];
						$data4['admission_number']		=	$student_id;
						$data4['branch_id']				= 	$branch_id;
						$data4['department_id']			= 	$dept_id;
						$data4['class_id']				= 	$class_id;
						$data4['batch_id']				=	$section;
						$data4['academic_year_id']		=	$academic_year_id;
						$data4['payment_mode']			=	$payment_mode;
						$data4['collected_by']			=	$this->session->userdata('login_user_id');
						$data4['collected_date']		=	date('Y-m-d H:i:s');
						$this->db->insert('tbl_fee_collection_master', $data4);
						$master_id= $this->db->insert_id();
						$data1['fee_balance']= 0;
						//$data1['is_idle']	 =	'N';
						$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
						$this->db->update('tbl_students_fee_master', $data1);
						
						//insert into collection details
						$collection= $this->db->query('SELECT fee_head_id, fee_balance
						FROM tbl_students_fee_details WHERE students_fee_master_id ='.$students_fee_master_id[$i])->result_array();
			
						foreach( $collection as $col)
						{
							$data5['fee_collection_master_id']	=	$master_id;
							$data5['fee_head_id']				=	$col['fee_head_id'];
							$data5['fee_amount']				=	$col['fee_balance'];
							if($col['fee_balance']>0)
							$this->db->insert('tbl_fee_collection_details', $data5);
						}
						$data1['fee_balance']				=	0;
						$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
						$this->db->update('tbl_students_fee_details', $data1);
						$amount								=	$amount-$check_balance[$i];
					}
					else
					{
						$data4['date_paid']					=	$date_paid;
						$data4['receipt_number']			=	$receipt_number;
						$data4['student_fee_master_id']		=	$students_fee_master_id[$i];
						$data4['admission_number']			=	$student_id;
						$data4['branch_id']					=	$branch_id;
						$data4['department_id']				= 	$dept_id;
						$data4['class_id']					=	$class_id;
						$data4['batch_id']					=	$section;
						$data4['academic_year_id']			=	$academic_year_id;
						$data4['payment_mode']				=	$payment_mode;
						$data4['collected_by']			=	$this->session->userdata('login_user_id');
						$data4['collected_date']		=	date('Y-m-d H:i:s');
			
						$this->db->insert('tbl_fee_collection_master', $data4);
						
						$master_id							= 	$this->db->insert_id();
						/*if($data2['fee_balance'] == 0)
						{
							$data2['is_idle']	 =	'N';
						}*/
						$data2['fee_balance']				=	$check_balance[$i]-$amount;
						$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
						$this->db->update('tbl_students_fee_master', $data2);
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
								$collection= $this->db->query('SELECT fee_head_id, fee_balance FROM tbl_students_fee_details WHERE is_deleted="N" and  fee_balance>0  AND students_fee_details_id='.$result['students_fee_details_id'] )->result_array();
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
						break;
					}
				}
			}
		} // if installment count >0
		else if ( $item_count >0)
		{
			$fee_items_details_id 	= 	$this->input->post('student_fee_details_id[]');
			$fee_master_id 			= 	$this->input->post('student_fee_master_id[]');
			$fee_heads 				=	$this->input->post('head_id[]');
			$fee_amount				= 	$this->input->post('item_balance[]');
			$checked_items 			= 	$this->input->post('item_check[]');
			
			$items_count 			= 	count($fee_items_details_id);
			$master_count			= 	count($fee_master_id );
			//$amount					=	$this->input->post('amount')- $this->input->post('late_fee');
		
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
						$data4['branch_id']				= 	$branch_id;
						$data4['department_id']			= 	$dept_id;
						$data4['class_id']				= 	$class_id;
						$data4['batch_id']				=	$section;
						$data4['academic_year_id']		=	$academic_year_id;
						$data4['payment_mode']			=	$payment_mode;
						$data4['collected_by']			=	$this->session->userdata('login_user_id');
						$data4['collected_date']		=	date('Y-m-d H:i:s');
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
						$data4['branch_id']				= 	$branch_id;

						$data4['department_id']			= 	$dept_id;
						$data4['class_id']				= 	$class_id;
						$data4['batch_id']				=	$section;
						$data4['academic_year_id']		=	$academic_year_id;
						$data4['payment_mode']			=	$payment_mode;
						$data4['collected_by']			=	$this->session->userdata('login_user_id');
						$data4['collected_date']		=	date('Y-m-d H:i:s');
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
		
		/*
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
			*/		
				}
		///////////////////////////////
			}
	
		}// else i f  $item_count >0
			$inst_count1	=	0;
			if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
			{
			/******* Transportaion Fee Start************/
				$data3						=		array();
				$data4						=		array();
				$year						=		get_running_year();	
                                
                                $this->db->select('SUM(amount_paid) as fee_amount');
				$this->db->where('receipt_number',$receipt_number);
				$this->db->where('is_deleted','N');
				$this->db->where('paid_year_id',$year);
                                $amt1   =   $this->db->get('tbl_opening_balance_fee_collection')->row()->fee_amount;
                                
                                $this->db->select('SUM(amount_paid) as fee_amount');
				$this->db->where('receipt_number',$receipt_number);
                                $this->db->where('is_deleted','N');
				$this->db->where('paid_year_id',$year);
                                $amt2   =   $this->db->get('tbl_opening_balance_transport_fee_collection')->row()->fee_amount;
                                
                                
				$this->db->select('SUM(fee_amount) as fee_amount');
				$this->db->where('receipt_number',$receipt_number);
				$this->db->where('academic_year_id',$year);
                                $amt3   =   $this->db->get('view_fee_collection_details')->row()->fee_amount;
				$amount						=		$amt1+$amt2+$amt3;
				
				$installments = $this->input->post('balance_check1[]');
				$inst_count1 = count($installments);
		
				$payment_mode				=		$this->input->post('lstpayment_mode');
				$class_id					=		$this->input->post('class');
				$section					=		$this->input->post('section');
				$student_id					=		$this->input->post('student_id');
				$var 						= 		$this->input->post('txtdate_paid');
				$date 						= 		str_replace('/', '-', $var);
				$date_paid1					=  		date('Y-m-d', strtotime($date));
		
				if($inst_count1>0)
				{
					$students_bus_fee_master_id	=		$this->input->post('students_bus_fee_master_id');
					$check_uncheck				=		$this->input->post('check_uncheck1');
					$check_balance				=		$this->input->post('check_balance1');
					$amount						=		$this->input->post('amount')- $amount;
					$count						=		count($check_balance);
					$total_late_fee				=		$late_fee;
					
					if($amount>0)
					{
						for($i=0;$i<$count;$i++)
						{
							if($check_uncheck[$i]==1) //If a row is checked...
							{
								if($amount >=$check_balance[$i]) 
								{
									// insert into collection master
									$data4['date_paid']						=	$date_paid1;
									$data4['late_fee']						=	0;
									$data4['receipt_number']				=	$receipt_number;
									$data4['student_id']					=	$student_id;
									$data4['class_id']						= 	$class_id;
									$data4['section_id']					=	$section;
									$data4['payment_mode']					=	$payment_mode;
									$data4['entered_by']					=	$this->session->userdata('login_user_id');
									$data4['entered_date']					=	date('Y-m-d H:i:s');
									$data4['academic_year']					=	get_running_year();
									$data3['students_bus_fee_master_id']	=	$students_bus_fee_master_id[$i];
						 
									//Insert into students_bus_fee_collection_master
									$this->db->insert('tbl_transport_students_bus_fee_collection_master', $data4);
									$master_id= $this->db->insert_id();
									
									//Update students_bus_fee_master
									$data1['fee_balance']= 0;
									//$data1['is_idle']	 =	'N';
									$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id[$i]);
									$this->db->update('tbl_transport_students_bus_fee_master', $data1);
									
									//insert into students_bus_fee_collection_details
						
									$data3['bus_fee_collection_master_id']	=	$master_id;	
									$data3['fee_amount']					=	$check_balance[$i];	
									$this->db->insert('tbl_transport_students_bus_fee_collection_details', $data3);
									$amount									= 	$amount - $check_balance[$i];
								}
								else if($amount == 0 && $late_fee == 0)
								{}
								else
								{
									$data4['date_paid']					=	$date_paid1;
									$data4['late_fee']					=	0;
									$data4['receipt_number']			=	$receipt_number;
									$data4['student_id']				=	$student_id;
									$data4['class_id']					=	$class_id;
									$data4['section_id']				=	$section;
									$data4['payment_mode']				=	$payment_mode;
									$data4['entered_by']				=	$this->session->userdata('login_user_id');
									$data4['entered_date']				=	date('Y-m-d H:i:s');
									$data4['academic_year']				=	get_running_year();
									$data3['students_bus_fee_master_id']=	$students_bus_fee_master_id[$i];
						
									$this->db->insert('tbl_transport_students_bus_fee_collection_master', $data4);//echo $this->db->last_query()."<br>";
									$master_id							= 	$this->db->insert_id();
									
									$data2['fee_balance']				=	$check_balance[$i]-$amount;
									/*if($data2['fee_balance'] == 0)
									{
										$data2['is_idle']	 =	'N';
									}*/
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
								}
							}
						} 						
					}	
				}
			/******* Transportaion Fee End**************/
			}
			/*else
			{
				redirect($_SERVER['HTTP_REFERER']);
			}*/
			if($inst_count==0 && $item_count==0 && $inst_count1==0 && $cnt==0)
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
	
	
		//// Inserting the late fee, if available. The late fee id is set aS '9999' 
		if($late_fee>0)
		{
			$data5['fee_collection_master_id']		=	$master_id;
			$data5['fee_head_id']					=	'9999';
			$data5['fee_amount']					=	$late_fee;
			$this->db->insert('tbl_fee_collection_details', $data5);
		}
		
	
		$page_data['branch_id']		=	$branch_id;
		$page_data['dept_id']		=	$dept_id;
		$page_data['class_id']		=	$class_id;
		$page_data['section_id']	=	$section;
		$page_data['student_id']	=	$student_id;
		$page_data['receipt_no']	=	$receipt_number;
		$page_data['payment_mode']	=	$payment_mode;
		$page_data['date_paid']		=	$date_paid;
		$page_data['collected_by']	=	$this->session->userdata('login_user_id');
		$page_data['page_name']		=	'receipt';
		$page_data['page_title']	=	'Fee Management - All';
		
		$this->session->set_userdata("page_data",$page_data);
		$this->session->mark_as_temp('page_data', 60);//Set expiry time(1min) for page_data
		redirect('FeeManagement/produce_receipt');
		
	} 
	function produce_receipt()
	{
		if(isset($_SESSION['page_data']))
		{
                    $page_data					=	$this->session->userdata("page_data");

                    if($this->db->get_where('settings',array('type'=>'show_double_receipt_per_page'))->row()->description=='yes')
                    {	
                            $data					=	array();
                            $data['student_id']		=	$page_data['student_id'];
                            $data['branch_id']		=	$page_data['branch_id'];
                            $data['receipt_number']	=	$page_data['receipt_no'];
                            $data['date_paid']		=	$page_data['date_paid'];	
                            $data['from_page']		=	'payment';		
                            $this->load->view('admin/receipt_double_reprint',$data);
                    }
                    else if($this->db->get_where('settings',array('type'=>'show_double_receipt_minhaj'))->row()->description=='yes')
                    {	
                            $data					=	array();
                            $data['student_id']		=	$page_data['student_id'];
                            $data['branch_id']		=	$page_data['branch_id'];
                            $data['receipt_number']	=	$page_data['receipt_no'];
                            $data['date_paid']		=	$page_data['date_paid'];	
                            $data['from_page']		=	'payment';		
                            $this->load->view('admin/receipt_double_reprint1',$data);
                    }
                    else
                    {   
                        $this->load->view('admin/receipt.php', $page_data);
                    }	
		}	
		else
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	function print_receipt($student_id='',$branch_id='',$receipt_number='',$date_paid='')
	{
		$data['student_id']		=	$student_id;
		$data['branch_id']		=	$branch_id;
		$data['receipt_number']	=	$receipt_number;
		$data['date_paid']		=	$date_paid;
	
		if($this->db->get_where('settings',array('type'=>'show_double_receipt_per_page'))->row()->description=='yes')
		{	
			$this->load->view('admin/receipt_double_reprint',$data);
		}
		else if($this->db->get_where('settings',array('type'=>'show_double_receipt_minhaj'))->row()->description=='yes')
		{	
			$this->load->view('admin/receipt_double_reprint1',$data);
		}
		else
		{	
			$this->load->view('admin/receipt1',$data);
		}
	}


function reprint_receipt()
{
    $data['receipts']	=	$this->Fee_management_model->get_receipts(); //print_r($data['receipts']);die;
    $this->load->view('admin/reprint_receipt',$data);
}
function reprint_receipt1()
{
        $year               =   get_running_year();
        $receipt_number     =   $this->input->post('receipt_number');
		$date_from        	= 	date("Y-m-d", strtotime($this->input->post('date_from')));
		$date_to          	=	date("Y-m-d", strtotime($this->input->post('date_to')));
		$class_id        	=	$this->input->post('class_id');
		$section_id       	=	$this->input->post('section_id');
		$department_id		=	$this->input->post('department');
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$branch_id	=	$this->input->post('branch');
		}
		else
		{
			$branch_id	=	$this->session->userdata('branch_id');	
		}
		if($receipt_number=='')
		{
			$condition = " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and a.academic_year_id=".$year;
			$condition1= " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and a.academic_year=".$year;
			$condition2= " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and a.paid_year_id=".$year."  and d.year=".$year." and a.is_deleted='N'";
			if($department_id!='All')
			{	
				if ($class_id=='ALL' && $section_id=='ALL'){
					$condition  = $condition . " and b.department_id=". $department_id ;
					$condition1 = $condition1 . " and c.dept_id=". $department_id ;
					$condition2 = $condition2 . " and c.dept_id=". $department_id ;
                                }
				elseif ($class_id !='ALL' && $section_id=='ALL'){
					$condition  = $condition . " and a.class_id=". $class_id;
					$condition1 = $condition1 . " and a.class_id=". $class_id;
					$condition2 = $condition2 . " and d.class_id=". $class_id;
                                }
				else{
					$condition = $condition . "  and a.class_id=". $class_id. " and a.batch_id=". $section_id;
					$condition1 = $condition1 . "  and a.class_id=". $class_id. " and a.section_id=". $section_id;
					$condition2 = $condition2 . "  and d.class_id=". $class_id. " and d.section_id=". $section_id;
                                }
			}
			else
			{
				$condition  = $condition;
				$condition1 = $condition1;
				$condition2 = $condition2;
			}		
		
		}
		else
		{
		    $condition   =   " where a.receipt_number='".$receipt_number."' and a.academic_year_id=".$year;
		    $condition1  =   " where a.receipt_number='".$receipt_number."' and a.academic_year=".$year;
		    $condition2  =   " where a.receipt_number='".$receipt_number."' and a.is_deleted='N' and a.paid_year_id=".$year." and d.year=".$year;
		}
		    //$sql = "select a.admission_number,a.date_paid,a.receipt_number,a.fee_head,sum(a.fee_amount) as fee_amount from view_fee_collection_details  as a inner join tbl_fee_collection_master as b on b.fee_collection_master_id=a.fee_collection_master_id and b.branch_id=".$branch_id . $condition . " group by a.receipt_number  order by a.receipt_number,a.date_paid,a.fee_head ";
	
                    
                $sql="select admission_number,date_paid,receipt_number,fee_head,sum(fee_amount) as fee_amount from "
                        . "((select a.admission_number,a.date_paid,a.receipt_number,a.fee_head,sum(a.fee_amount) as fee_amount from view_fee_collection_details  as a inner join tbl_fee_collection_master as b on b.fee_collection_master_id=a.fee_collection_master_id and b.branch_id=".$branch_id . $condition . " group by a.receipt_number) ";
                if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
                {
                    $sql=    $sql. "union all "
                        . "(select a.student_id as admission_number,a.date_paid,a.receipt_number,'Bus Fee' as fee_head,sum(b.fee_amount) as fee_amount from tbl_transport_students_bus_fee_collection_master a inner join tbl_transport_students_bus_fee_collection_details as b on b.bus_fee_collection_master_id=a.bus_fee_collection_master_id inner join student c on c.student_id=a.student_id ".$condition1." group by a.receipt_number) ";
                }    
                    $sql=    $sql. "union all "
                        . "(select a.student_id as admission_number,a.date_paid,a.receipt_number,b.fee_head_id,sum(a.amount_paid) as fee_amount from tbl_opening_balance_fee_collection a inner join tbl_opening_balance b on b.id=a.opening_balance_id inner join student c on c.student_id=a.student_id left join enroll d on d.student_id=a.student_id ".$condition2." group by a.receipt_number) "
                        . "union all "
                        . "(select a.student_id as admission_number,a.date_paid,a.receipt_number,'Bus Fee' as fee_head,sum(a.amount_paid) as fee_amount from tbl_opening_balance_transport_fee_collection a inner join tbl_opening_balance_transport b on b.id=a.opening_balance_id inner join student c on c.student_id=a.student_id inner join enroll d on d.student_id=a.student_id ".$condition2." group by a.receipt_number)) tbl "
                        . " group by receipt_number  order by receipt_number";    
                    
                    
                    
                    
		    $query_result = $this->db->query($sql)->result_array();//echo $this->db->last_query();die();
		//print_r($query_result);die;
		$page_data['branch_id']        = $branch_id ;
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
		$page_data['department_id']    = $department_id;
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['query_result']	   = $query_result;
		$this->load->view('admin/reprint_receipt1', $page_data);
}


function reprint_special_fee_receipt()
{
	$this->load->view('admin/reprint_special_fee_receipt');
}

function reprint_special_fee_receipt1()
{
		if($this->input->post('date_from') != '')
		{
			$date_from        	= 	date("Y-m-d", strtotime($this->input->post('date_from')));
		}
		else
		{
			$date_from        	=	'';
		}
		if($this->input->post('date_to') != '')
		{
			$date_to          	=	date("Y-m-d", strtotime($this->input->post('date_to')));
		}
		else
		{
			$date_to          	=	'';
		}
		$class_id        	=	$this->input->post('class_id');
		$section_id       	=	$this->input->post('section_id');
		$department_id		=	$this->input->post('department');
		$year				=	get_running_year();
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$branch_id	=	$this->input->post('branch');
		}
		else
		{
			$branch_id	=	$this->session->userdata('branch_id');	
		}
		
			$condition = " where is_deleted='N' and date_paid between '" . $date_from . "' and '" . $date_to . "' ";
			if($department_id!='All')
			{	
				if ($class_id=='ALL' && $section_id=='ALL')
					$condition = $condition ;
				elseif ($class_id !='ALL' && $section_id=='ALL')
					$condition = $condition . " and class_id=". $class_id;
				else
					$condition = $condition . "  and class_id=". $class_id. " and section_id=". $section_id;
			}
			else
			{
				$condition = $condition;
			}		
		
		
		$sql = "select student_id,student_name,class_name,section_name,date_paid,receipt_number,fee_head,fee_amount from view_special_fee_collection_master " . $condition . " and branch_id=".$branch_id." and academic_year_id=".$year." order by CAST(receipt_number AS UNSIGNED INTEGER) DESC,date_paid,fee_head ";
	
		$query_result = $this->db->query($sql)->result_array();//echo $this->db->last_query();die();
		
		$page_data['branch_id']        = $branch_id ;
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
		$page_data['department_id']    = $department_id;
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['query_result']	   = $query_result;
		$this->load->view('admin/reprint_special_fee_receipt1', $page_data);
}
function print_special_fee_receipt($student_id='',$branch_id='',$receipt_number='',$date_paid='')
{
	$data['student_id']		=	$student_id;
	$data['branch_id']		=	$branch_id;
	$data['receipt_number']	=	$receipt_number;
	$data['date_paid']		=	$date_paid;
	
	$this->load->view('admin/receipt_special_fee',$data);
}



//////////////////////

function receipt_print($receipt_number)
{
	
	
		$page_data['page_name']			= 	'receipt_print';
		$page_data['receipt_number']	=	$receipt_number;
		
	$this->load->view('backend/index' , $page_data);
}

////////////////

function reset_fee_due_date()
{
	$students_fee_master_id		=	$this->input->post('students_fee_master_id[]');
	$due_date					=	$this->input->post('due_date[]');
	$department_id				=	$this->input->post('department');
	$count						=	count($students_fee_master_id);
	
	for($i=0;$i<$count;$i++)
	{
		$data['due_date']				=	date('Y-m-d',strtotime($due_date[$i]));
		$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
	//	echo "due date : " . $data['due_date'] . "<br>";
		$this->db->update('tbl_students_fee_master', $data);
	}

		$student_id = $this->input->post('student_id');
		$class_id=  $this->input->post('class');
		$section_id =  $this->input->post('section');
		$url= base_url() . 'index.php/FeeManagement/bulk_assign_fees1/'.$student_id.'/'.$class_id.'/'.$section_id.'/back/'.$department_id;
		redirect($url);
	}
///////////////
 

		 
function insert_installment_options()
{
	if ($this->session->userdata('admin_login') != 1)
	redirect('login', 'refresh');

	$installment_option=($_POST['details_id']);
	$hdnoption=$_POST['fee_details1'];
	$count=count($hdnoption);

	for($i=0;$i<$count;$i++)
	{
		if($hdnoption[$i]==1)
		{
			$data1['fee_master_id']					=	$this->input->post('fee_name1');
			$data1['class_id']						=	$this->input->post('class_id');
			$data1['fee_payment_options_master_id']	=	$this->input->post('option');
			$data1['fee_payment_options_details_id']= $installment_option[$i];
			$this->db->insert('tbl_fee_installment_master', $data1);
		}
		
	}
	$page_data['page_name']                 = 'installment_payement';
	$page_data['page_title']                = 'Private-Messages';
	redirect(base_url() . 'index.php?FeeManagement/installment_payement/', 'refresh');
}
		 
		 
public function get_fee_amount($fee_master_id,$fee_head_id)
{		 
		 $this->db->select('fee_total');
		 $this->db->from('tbl_fee_details');
		 $this->db-where('fee_master_id',$fee_master_id);
		 $this->db-where('fee_head_id',$fee_head_id);
		 
		 $fee=$this->db->get();
		 return $fee;
}

function get_class_fee_master($class_id='')
     {
		$fee_master = $this->db->get_where('tbl_fee_master' , array('class_id' => $class_id,'is_deleted'=>'N'))->result_array();
		echo '<option value="">SELECT</option>';
		if(count($fee_master)>0)
		{
			foreach($fee_master as $fee)
			{
				$amount	=	0;
				$this->db->where('fee_master_id',$fee['fee_master_id']);
				$query=$this->db->get('tbl_fee_installment_master')->result_array();
				foreach($query as $inst)
				{
					$amount	=	$amount+$inst['fee_total'];
				}
				if($amount==$fee['fee_total'])
				{
					$fee_master1[]	=	array(
											'fee_master_id'		=>	$fee['fee_master_id'],
											'fee_master_name'	=>	$fee['fee_master_name']
											);
				}
			}
			if(count($fee_master1)>0)
			{
				foreach ($fee_master1 as $row) 
				{
					echo '<option value="' . $row['fee_master_id'] . '">' . $row['fee_master_name'] . '</option>';
				}
			}
			else
			{
				$fee_master	=	array();
				foreach ($fee_master as $row) 
				{
					echo '<option value="' . $row['fee_master_id'] . '">' . $row['fee_master_name'] . '</option>';
				}
			}
		}
		else
		{
			foreach ($fee_master as $row) 
				{
					echo '<option value="' . $row['fee_master_id'] . '">' . $row['fee_master_name'] . '</option>';
				}
		}

    }



	function check_fee_head_assigned($fee_head_id='')
	{
		$query	=	$this->Fee_management_model->check_fee_head_assigned($fee_head_id);
		if(count($query)>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}


	function check_receipt_exist($receipt_number='',$branch_id='')
	{
		$query	=	$this->Fee_management_model->check_receipt_exist($receipt_number,$branch_id);
		echo $query;
	}




function installment_payement()
{
	
	
		$page_data['page_name']                 = 'installment_payement';
		$page_data['page_title']                = get_phrase('Private-Messages');
		$this->load->view('backend/index', $page_data);
}

function fee_details_view($fee_master_id='',$class_id='')
{
    
		$fee_master_name	= 	$this->Fee_management_model->get_fee_master_name($fee_master_id);
		$class_name 		= 	$this->Fee_management_model->get_class_name($class_id);
		$total_amount		=	$this->Fee_management_model->get_fee_amount($fee_master_id);
		$installment_details= 	$this->Fee_management_model->get_installment_details($fee_master_id);
		$fee_head_details	=	$this->Fee_management_model->get_fee_head_details($fee_master_id); 
		$page_data['page_name']              = 'view_fee_details';
		$page_data['fee_master_id']          = $fee_master_id;
		$page_data['fee_master_name']        = $fee_master_name;
		$page_data['class_id']               = $class_id;
		$page_data['class_name']             = $class_name;
		$page_data['total_amount']           = $total_amount;
		$page_data['installment_details']    = $installment_details;
		$page_data['fee_head_details']    	 = $fee_head_details;
		$page_data['page_title']             = get_phrase('Private-Messages');
		
	$this->load->view('admin/view_fee_details.php', $page_data);
}
function set_fees($fee_master_id,$class_id,$option_master_id,$option_details_id,$installment_master_id)
{


			
			$fee_master_name 		=	 $this->Fee_management_model->get_fee_master_name($fee_master_id);
			$class_name 			= 	 $this->Fee_management_model->get_class_name($class_id);
			$option_master 			= 	 $this->Fee_management_model->fee_payment_option($option_master_id);
			$fee_heads 				=	 $this->Fee_management_model->get_installment_items($fee_master_id);
			$installment_details	= 	 $this->Fee_management_model->get_installment_details($fee_master_id);
			$installment_name		= 	 $this->Fee_management_model->get_installment_name($option_details_id);
		
			$page_data['page_name']              = 'set_fees';
			$page_data['total_installments']     = count($installment_details);
			$page_data['installment_name']     	 = $installment_name;
			$page_data['fee_master_id']          = $fee_master_id;
			$page_data['fee_master_name']        = $fee_master_name;
			$page_data['class_id']               = $class_id;
			$page_data['class_name']             = $class_name;
			$page_data['option_master_id']       = $option_master_id;
			$page_data['option_master']       	 = $option_master;
			$page_data['option_details_id']      = $option_details_id;
			$page_data['installment_master_id']  = $installment_master_id;
			$page_data['fee_heads']   			 = $fee_heads;
     		$page_data['page_title']             = get_phrase('Private-Messages');
			$this->load->view('admin/set_fees.php', $page_data);
}


 function insert_set_fees()
    {
  
      
	 $total_balance			=	$this->input->post('total_balance');					
	 $total_fee             =   $this->input->post('total');
	 $fee_total1            =   $this->input->post('fee_total1[]');
     $fee_head				=	$this->input->post('fee_head[]');
	 $fee_head_id			=	$this->input->post('fee_head_id[]');
	 $fee_master_id 		= 	$this->input->post('fee_master_id');
	 $class_id 				=	$this->input->post('class_id');
	 $installment_master_id = 	$this->input->post('installment_master_id');
	 $fee_total				=	$this->input->post('total');
	 $count					=	count($fee_head);
	 $total					= 	0;
	 $total_set_amount		=	0;

 	 for($i=0;$i<$count;$i++)													//Calculate the total set amount of current fee heads with current fee master in all installments
	 {		
	 	$total					= 	0;											//from tbl_fee_installment_details. Then add the amount with currently entered value.  
		$this->db->select('fee_installment_master_id');
		$this->db->where('fee_master_id',$fee_master_id);											 
		$installment_masters	=	$this->db->get('tbl_fee_installment_master')->result_array();	
		
		foreach($installment_masters as $installment_master)
		{
			if($installment_master_id!=$installment_master['fee_installment_master_id'])
			{
				$this->db->select('fee_amount');
				$this->db->where('fee_installment_master_id',$installment_master['fee_installment_master_id']);
				$this->db->where('fee_head_id',$fee_head_id[$i]);
				$fee_amount	=	$this->db->get('tbl_fee_installment_details')->result_array();
				foreach($fee_amount as $fee_amounts)
				{
					$total	=	$total+$fee_amounts['fee_amount'];
					
				}
			}
		}
		$total_set_amount	=	$total+$fee_head[$i];
		if($total_set_amount<=$fee_total1[$i])										//If it is less than the total fee set for the current fee head,then update data in 
		{																			// tbl_fee_installment_details.
		
			$this->Fee_management_model->delete_installment_details($installment_master_id, $fee_head_id[$i]);
			
			if($fee_head[$i]>0)
			{
				$data['fee_installment_master_id']		=	$installment_master_id;
				$data['fee_head_id']					=	$fee_head_id[$i];
				$data['fee_amount']						=	$fee_head[$i];
				$data['fee_balance']					=	$fee_head[$i];		//We entered an amount for admission fee,but the above condition fails.Then the total value in the 
				$this->Fee_management_model->insert_installment_details($data );// bottom of the page will get updated.To prevent this,the else part is written.
			}
		}
		else																						
		{
			$single_fee	=	$this->Fee_management_model->get_single_paid_head_amount($installment_master_id,$fee_head_id[$i]);
			$fee_total	=	$fee_total-$fee_head[$i]+$single_fee;
		}
	
		$id					=	$this->input->post('installment_master_id');
		$due_date			=	$this->input->post('due_date');
		$date1				=	date_create($due_date);
		$date2				=	date_format($date1,"Y-m-d");
		$data1['fee_total']	=	$fee_total;
		$data1['fee_balance']=	$this->input->post('total');
		 
		$data1['due_date']	=	$date2;
		$this->Fee_management_model->update_fee_installment_master($data1,$id);
	}
	$this->fee_details_view($fee_master_id,$class_id);
}

	function get_fee_balance($fee_master_id='',$fee_head_id='') 
	{
	
		$balance	=	$this->Fee_management_model->get_fee_balance($fee_master_id,$fee_head_id);
		echo $balance;
	}

public function assign_fees()
 {
        $this->load->view('admin/assign_fees.php');	// Before it was like this: $this->load->view('admin/assign_fees.php', $page_data);
 }	
	
public function bulk_assign_fees($param='')
 {
 		$classes = $this->Fee_management_model->get_classes();
		$page_data['classes']		= $classes;
		if ($param=='assign')
        $this->load->view('admin/bulk_assign_fees.php', $page_data);
		else if ($param=='assigned')
        $this->load->view('admin/bulk_assigned_fees.php', $page_data);
 }	
 
 
public function bulk_assign_fees1($student_id='',$class='',$section='',$direction='',$department_id='',$branch_id='')
{
	if($direction!='back')
	{
		$role_id				=	$this->session->userdata('role');
		if($role_id==1 || $role_id==2)
		{
			$page_data['branch_id']		=	$this->input->post('branch');
			$page_data['department_id']	=	$this->input->post('department');
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
		if($role_id==3)
		{
			$page_data['department_id']	=	$this->input->post('department');
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
		if($role_id>=4)
		{
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
	}
	else
	{
		$page_data['class_id']   		= 	$class;
		$page_data['section_id'] 		= 	$section;
		if($department_id!='')
		{
			$page_data['department_id']	=	$department_id;
		}
		if($branch_id!='')
		{
			$page_data['branch_id']		=	$branch_id;
		}
	}
      	//$page_data['class_id']  = 	$data['class_id'];
        //$page_data['section_id']= 	$data['section_id'];
		$page_data['section']	= 	$section;

        $students 				= 	$this->Fee_management_model->get_students($page_data);
        $fee_master				= 	$this->Fee_management_model->get_fee_master_by_class($page_data);

        $page_data['students']  =  	$students;
		$page_data['fee_master']=  	$fee_master;
		
		if (isset($_POST['btnSearch']))
		$this->load->view('admin/bulk_assign_fees1.php', $page_data);
		else
		$this->load->view('admin/bulk_assign_fees2.php', $page_data);
}	


 public function bulk_assign_fees2()
 {
      	$class_id   	= $this->input->post('class_id');
        $section_id 	= $this->input->post('section_id');
		$students		= $this->input->post('student_id');
		$fee_master_id 	= $this->input->post('fee_master_id');
		$checked		= $this->input->post('chk_checked');
        $section_id1 	= $this->input->post('section_id1');
	$count = count($students);
	
	$this->db->trans_start();

	for($i=0;$i<$count;$i++)
	{
	if($checked[$i]==1)
	{
	
	$this->db->select('fee_installment_master_id,fee_payment_options_master_id,fee_payment_options_details_id,fee_total,fee_balance,due_date');
	$this->db->from('tbl_fee_installment_master');
	$this->db->where('fee_master_id',$fee_master_id[$i]);
	$result=$this->db->get()->result_array();
	
	///////////////////////
					
		$this->db->select('students_fee_master_id'); // get the fee_master_id
		$this->db->from('tbl_students_fee_master');
		$this->db->where('admission_number' , $students[$i]);
		$this->db->where('class_id' , $class_id);
		$this->db->where('batch_id' , $section_id1[$i]);
		$this->db->where('is_deleted' , 'N');

		$result1=$this->db->get()->result_array();
		$master_id=0;
		foreach($result1 as $row1)
		{
			$master_id	=	$row1['students_fee_master_id'];
		
		if($master_id>0)
		{
			$this->db->where('students_fee_master_id' , $master_id); // delete itr from details table
                        $this->db->set('is_deleted','Y');
                        $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                        $this->db->set('deleted_date',date('Y-m-d H:i:s'));
                        $this->db->update('tbl_students_fee_details');
//			$this->db->delete('tbl_students_fee_details');
			
			
			$this->db->where('admission_number' , $students[$i]); // then delete from master table
			$this->db->where('class_id' , $class_id);
			$this->db->where('batch_id' , $section_id1[$i]);
			$this->db->where('is_deleted','N');
                        $this->db->set('is_deleted','Y');
                        $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                        $this->db->set('deleted_date',date('Y-m-d H:i:s'));
                        $this->db->update('tbl_students_fee_master');
//                        $this->db->delete('tbl_students_fee_master');
		}
		}

	/////////////////////

	foreach($result as $row)
	{
		$concession							=	0;
		$data1['admission_number']			=	$students[$i];
		$data1['class_id']					=	$class_id;
		$data1['batch_id']					=	$section_id1[$i];
		$data1['fee_master_id']				=	$fee_master_id[$i];
		$data1['fee_installment_master_id']	=	$row['fee_installment_master_id'];
		$data1['due_date']					=	$row['due_date'];
		$data1['fee_amount']				=	$row['fee_total'];
		$data1['fee_balance']				=	$row['fee_balance'];
		$data1['fee_concession']			=	$concession;
		$data1['academic_year_id']			=	get_student_academic_year($students[$i]);
		
				
		$this->db->insert('tbl_students_fee_master', $data1); // now insert into master table
		
		$master_id= $this->db->insert_id();
		$primary_id=$row['fee_installment_master_id'];
		
		$this->db->select('fee_head_id,fee_amount,fee_balance');
		$this->db->from('tbl_fee_installment_details');
		$this->db->where('fee_installment_master_id',$primary_id);
		$result1=$this->db->get()->result_array();
	
	foreach($result1 as $row1)
	{
		$data['students_fee_master_id']	=	$master_id;
		$data['fee_head_id']			=	$row1['fee_head_id'];
		$data['fee_amount']				=	$row1['fee_amount'];
		$data['fee_balance']			=	$row1['fee_balance'];
		$data['fee_concession']			=	$concession;
		$this->db->insert('tbl_students_fee_details', $data);
	}
	
	}
	}
		$this->db->trans_complete();
	//redirect(base_url() . 'index.php?FeeManagement/assign_fees/', 'refresh');
	}
		$role_id					=	$this->session->userdata('role');
		if($role_id==1 || $role_id==2)
		{
			$page_data['branch_id']		=	$this->input->post('branch_id');
			$page_data['department_id']	=	$this->input->post('department_id');
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
			//echo $data['branch_id'];die();
		}	
		if($role_id==3)
		{
			$page_data['department_id']	=	$this->input->post('department_id');
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
		if($role_id>=4)
		{
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
 		$students 					= 	$this->Fee_management_model->get_students($page_data);
        $fee_master					= 	$this->Fee_management_model->get_fee_master_by_class($page_data);

		//$page_data['class_id']	 	= 	$class_id  ;
		//$page_data['section_id'] 	= 	$section_id ;
        $page_data['students']   	=  	$students;
        $page_data['fee_master'] 	=  	$fee_master;
        $page_data['counter'] 		=  	1;
		
		$this->load->view('admin/bulk_assign_fees2.php', $page_data);
}		
	
	
public function reassign_student_fees($class_id,$batch_id,$admission_number,$department_id='',$branch_id='')
 {
        $page_data['page_name']	 = 'reassign_student_fees';
        $page_data['page_title'] = 'Reassign Fees';
		
		$page_data['class_id']	=	$class_id;
		$page_data['section']	=	$batch_id;
		$page_data['student_id']=	$admission_number;
		if($department_id!='')
		{
			$page_data['department_id']	=	$department_id;
		}
		if($branch_id!='')
		{
			$page_data['branch_id']		=	$branch_id;
		}
		$this->load->view('admin/reassign_student_fees.php', $page_data);
 }	
		
public function student_payment()
{
	$page_data['classes']	 = $this->Fee_management_model->get_classes();
	if($this->session->userdata('role')==7)
	{
	$this->load->view('office_staff/student_payment.php', $page_data);
	}
	$this->load->view('admin/student_payment.php', $page_data);
}	
	
	///////////////////////////////////added on 20-09-2017
	
public function setup_fee()
{
		$classes = $this->Fee_management_model->get_classes();
		$options = $this->Fee_management_model->fee_payment_options();
	
		$page_data['classes']= $classes;
		$page_data['options']= $options;
        $page_data['page_name']	 = 'setup_fee1';
        $page_data['page_title'] = 'Setup Fee Master';
		if($this->session->userdata('role')==7)
	{
	$this->load->view('office_staff/setup_fee1.php', $page_data);
	}
		$this->load->view('admin/setup_fee1.php', $page_data);
}


public function setup_fee2($payment_option='',$class_id='',$txt_fee_plan_name='',$dept_id='',$branch_id='')
{
		$fee_heads = $this->Fee_management_model->get_fee_heads('1');

		$page_data['payment_option'] 	=	$payment_option;
		$page_data['class_id'] 	        =	$class_id;
		$page_data['txt_fee_plan_name'] =	$txt_fee_plan_name;
		$page_data['fee_heads'] 		=	$fee_heads;
		$page_data['dept_id'] 			=	$dept_id;
		$page_data['branch_id'] 		=	$branch_id;
			
		if ($payment_option==1)
		{
			$page_data['payment_option']=$payment_option;
			$this->load->view('admin/setup_fee3', $page_data);
		}
		else if ($payment_option==2)
		{
			$installments = $this->Fee_management_model->fee_payment_options_details($payment_option);
			$page_data['installments']=$installments;
			$page_data['payment_option']=$payment_option;
			$this->load->view('admin/setup_fee2', $page_data);
		}
}

public function save_fee_master()
{
        $role=$this->session->userdata('role');
                if($role==1 || $role==2)
                {
					$branch_id		=	$this->input->post('branch_id');
					$department_id	=	$this->input->post('department');
                }
                if($role==3)
                {
					$branch_id		=	$this->session->userdata('branch_id');
					$department_id  =	$this->input->post('department');
                }
                if($role==4)
                {
					$branch_id		=	$this->session->userdata('branch_id');
					$department_id	=	$this->session->userdata('dept_id');
                } 
				
				
		$class_id		=	$this->input->post('lst_class');
		
		$fee_plan		=	urldecode($this->input->post('txt_fee_plan_name'));// urldecode();
		//echo $fee_plan;die();
		$payment_option	=	$this->input->post('lst_payment_option');
		
		
		

	if ( $this->input->post('btn_Save'))				// when payment option is Full Payment
	{
		$total			= 	$this->input->post('total');
		$due_date		= 	$this->input->post('due_date');
		$save			=	$this->input->post('btn_Save');
		
		
		$checked		= 	$this->input->post('chk_status');
		$hdn 			=	$this->input->post('hdnfee_details');
		$fee_details	=	$this->input->post('fee_details');
		
		$data['fee_master_name']			=	$fee_plan;		// save data to tbl_fee_master
		$data['class_id']					=	$class_id;
		$data['branch_id']					=	$branch_id;
		$data['department_id']				=	$department_id;
		$data['fee_total']					=	$total;
		$data['active']						=	'Y';
		$this->db->trans_start();
		$this->db->insert('tbl_fee_master', $data);
		$fee_master_id= $this->db->insert_id();
	
		$count = count($hdn);
		for ($i=0; $i<$count; $i++)										// save data to tbl_fee_details
		{
			if ($checked[$i]==1)
			{
				if($fee_details[$i]==0)
				{
					//If fee head is selected and fee amount is zero, do nothing
				}
				else
				{
					$data1['fee_master_id']			=	$fee_master_id;
					$data1['fee_head_id']			=	$hdn[$i];
					$data1['fee_amount']			=	$fee_details[$i];
					$this->db->insert('tbl_fee_details', $data1);
				}
			}
		}
		
		$data3['fee_master_id']					=	$fee_master_id	;	// save data to tbl_fee_installment_master
		$data3['class_id']						=	$class_id;
		$data3['fee_payment_options_master_id']	=	1;
		$data3['fee_payment_options_details_id']=	1;
		$data3['fee_total']						=	$total;
		$data3['fee_balance']					=	$total;
		$data3['due_date']						=	date('Y-m-d', strtotime($due_date));

		
		$this->db->insert('tbl_fee_installment_master', $data3);
		$fee_installment_master_id= $this->db->insert_id();	
	
		for ($i=0; $i<$count; $i++)										// save data to tbl_fee_installment_details
		{
			if ($checked[$i]==1)
			{
				$data4['fee_installment_master_id']	=	$fee_installment_master_id;
				$data4['fee_head_id']				=	$hdn[$i];
				$data4['fee_amount']				=	$fee_details[$i];
				$data4['fee_balance']				=	$fee_details[$i];
				$this->db->insert('tbl_fee_installment_details', $data4);
			}
		}
	
		$this->db->trans_complete();										// end of when payment option is Full Payment
	}
	else if($this->input->post('btn_save_and_continue'))   // when installments scheme
	{
		
	  //Insert into tbl_fee_master
		$data['fee_master_name']					=	$fee_plan;
		$data['branch_id']							=	$this->input->post('branch');
		$data['department_id']						=	$this->input->post('department');
		$data['class_id']							=	$this->input->post('lst_class');
		$data['fee_total']						=	$this->input->post('grand_total');
		$data['active']								=	'Y';
		$this->db->insert('tbl_fee_master', $data);
		$fee_master_id								= 	$this->db->insert_id();
		$data										=	array();
		
	  //Insert into tbl_fee_installment_master
	  
	  	$installments								=	$this->input->post('chk_installments[]');
	  	
		for($i=0;$i<count($installments);$i++)
		{
			$data['fee_master_id']					=	$fee_master_id;
			$data['class_id']						=	$this->input->post('lst_class');
			$data['fee_payment_options_master_id']	=	$this->input->post('lst_payment_option');
			$data['fee_payment_options_details_id']	=	$installments[$i];	
			$data['fee_total']						=	$this->input->post($installments[$i].'_fee_total');
			$data['fee_balance']					=	$this->input->post($installments[$i].'_fee_total');
			if($this->input->post($installments[$i].'_due_date')!='')
			{
				$data['due_date']					=	date('Y-m-d',strtotime($this->input->post($installments[$i].'_due_date')));
			}
			$this->db->insert('tbl_fee_installment_master',$data);
			$fee_installment_master_id				= 	$this->db->insert_id();
	  
	  //Insert into tbl_fee_installment_details
	  		$fee_head_id							=	$this->input->post($installments[$i].'_fee_head[]');	
			for($j=0;$j<count($fee_head_id);$j++)
			{
				$data1['fee_installment_master_id']	=	$fee_installment_master_id;
				$data1['fee_head_id']				=	$fee_head_id[$j];
				$data1['fee_amount']				=	$this->input->post($installments[$i].'_'.$fee_head_id[$j].'_fee_amount');
				$data1['fee_balance']				=	$this->input->post($installments[$i].'_'.$fee_head_id[$j].'_fee_amount');
				
				if(isset($head_arr[$fee_head_id[$j]]))
					$head_arr[$fee_head_id[$j]]+=$data1['fee_amount'];
				else
					$head_arr[$fee_head_id[$j]]  	=	$data1['fee_amount'];
				
				
				$this->db->insert('tbl_fee_installment_details',$data1);
			}			
		}
		
	  //Insert into tbl_fee_details
	  	foreach($head_arr as $key => $value):
			$data2['fee_master_id']					=	$fee_master_id;
			$data2['fee_head_id']					=	$key;
			$data2['fee_amount']					=	$value;
			$this->db->insert('tbl_fee_details',$data2);
		endforeach;		
		
		
	
	
	
	
	
	
	
	
	
	
	
	
	
		/*
		$total			= 	$this->input->post('total');
	//	$due_date		= 	$this->input->post('due_date');
		//$save			=	$this->input->post('btn_Save');
		
		
		$checked		= 	$this->input->post('chk_status');
		$hdn 			=	$this->input->post('hdnfee_details');
		$fee_details	=	$this->input->post('fee_details');
		$installemnts	=   $this->input->post('hdn__installments');
		$count_installments = count($installemnts);
		
		
		$data['fee_master_name']			=	$fee_plan;		// save data to tbl_fee_master
		$data['class_id']					=	$class_id;
		$data['branch_id']					=	$branch_id;
		$data['department_id']					=$department_id;
		$data['fee_total']					=	$total;
		$data['active']						=	'Y';
		$this->db->trans_start();
		
		$this->db->insert('tbl_fee_master', $data);
		$fee_master_id= $this->db->insert_id();
		
	
		$count = count($hdn);
		for ($i=0; $i<$count; $i++)										// save data to tbl_fee_details
		{
			if ($checked[$i]==1)
			{
				if($fee_details[$i]==0)
				{
					//If fee head is selected and fee amount is zero, do nothing
				}
				else
				{
					$data1['fee_master_id']			=	$fee_master_id;
					$data1['fee_head_id']			=	$hdn[$i];
					$data1['fee_amount']			=	$fee_details[$i];
					$this->db->insert('tbl_fee_details', $data1);
				}
			}
		}
		
		for ($i=0;$i<$count_installments; $i++)
		{
			if($installemnts[$i]!=0)
			{
				$data3['fee_master_id']					=	$fee_master_id	;	// save data to tbl_fee_installment_master
				$data3['class_id']						=	$class_id;
				$data3['fee_payment_options_master_id']	=	$payment_option;
				$data3['fee_payment_options_details_id']=	$installemnts[$i];
				$data3['fee_total']						=	0;
				$data3['fee_balance']					=	0;
				$data3['due_date']						=	"";//date('Y-m-d', strtotime($due_date));
		
				
				$this->db->insert('tbl_fee_installment_master', $data3);
				$fee_installment_master_id= $this->db->insert_id();	
			}
		}
	/*
		for ($i=0; $i<$count; $i++)										// save data to tbl_fee_installment_details
		{
			if ($checked[$i]==1)
			{
				$data4['fee_installment_master_id']	=	$fee_installment_master_id;
				$data4['fee_head_id']				=	$hdn[$i];
				$data4['fee_amount']				=	$fee_details[$i];
				$data4['fee_balance']				=	$fee_details[$i];
				$this->db->insert('tbl_fee_installment_details', $data4);
			}
		}
	
		
		$this->db->trans_complete();										// end of when payment option is Full Payment
		///////////////////////////installments scheme ends here
		$this->db->trans_complete();*/
	}//ens of else
	
	redirect( 'FeeManagement/fee_details_view/'.$fee_master_id.'/'.$class_id);
	
	

}



function view_students_fee_schedule($student_id='',$class_id='',$section='',$department_id='',$branch_id='')
{
		$this->db->where('student_id', $student_id);
		$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent,admission_number');
		$this->db->from('student');
		
		$cls1				=	$this->db->get()->result_array();
		$data['student']	=	$cls1;
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['section_id']	=	$section;
		$data['student_id']	=	$student_id;
		if($department_id!='')
		{
			$data['department_id']	=	$department_id;
		}
		if($branch_id!='')
		{
			$data['branch_id']		=	$branch_id;
		}

	$this->load->view('admin/students_fee_schedule.php', $data);
}

function students_payment_details($student_id='',$class_id='',$section='',$department_id='',$branch_id='')
{
// get_student-details
		$this->db->where('student_id', $student_id);
		$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent,admission_number');
		$this->db->from('student');
		
		$student			=	$this->db->get()->result_array();
		$data['student']	=	$student;
		
		// gee payment details


		$this->db->where('admission_number', $student_id);
		$this->db->where('class_id', $class_id);
		$this->db->where('batch_id', $section);
		$this->db->select('admission_number,date_paid,receipt_number,sum(fee_amount) as fee_amount');
		$this->db->group_by('receipt_number','asc');
		$this->db->from('view_fee_collection_details');
		
		$fee_details		=	$this->db->get()->result_array();
		
		
		$data['fee_details']=	$fee_details;
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['section_id']	=	$section;
		$data['student_id']	=	$student_id;
		if($department_id!='')
		{
			$data['department_id']	=	$department_id;
		}
		if($branch_id!='')
		{
			$data['branch_id']		=	$branch_id;
		}
	$this->load->view('admin/students_payment_details.php', $data);
}
function modify_fees($students_fee_master_id='')
{
	$data['students_fee_master_id']	=	$students_fee_master_id;
	$data['fee_details']			=	$this->Fee_management_model->modify_fees($students_fee_master_id);
	$this->load->view('admin/student_fee_modify',$data);
}	
function student_fee_concession_update($students_fee_master_id='')
{
	$students_fee_master_id			=	$students_fee_master_id;
	$students_fee_details_id		=	$this->input->post('students_fee_details_id[]');
	$fee_concession					=	$this->input->post('concession[]');
	$fee_balance					=	$this->input->post('balance[]');
	$remarks						=	$this->input->post('remarks[]');
	$check_uncheck					=	$this->input->post('check_uncheck[]');
	$data['total_balance']			=	$this->input->post('total_balance');
	$data['total_concession']		=	$this->input->post('total_concession');
	$fee_head_count					=	count($students_fee_details_id);
	
	$this->db->trans_start();	
	$fee_master						=	$this->Fee_management_model->student_fee_master_update($data,$students_fee_master_id);
	if($fee_head_count>0)
	{
		for($i=0;$i<$fee_head_count;$i++)
		{
			if($check_uncheck[$i]==1)
			{
				$students_fee_details_id1	=	$students_fee_details_id[$i];
				$data						=	array(
													"fee_balance"				=>	$fee_balance[$i],
													"fee_concession"			=>	$fee_concession[$i],
													"remarks"					=>	$remarks[$i]
													);
				$fee_details				=	$this->Fee_management_model->student_fee_details_update($data,$students_fee_details_id1);				
			}
		}
	}
	$this->db->trans_complete();
	if($this->db->trans_status() === TRUE)
	{
		$action	=	"transaction_success";
	}
	else
	{
		$action	=	"transaction_failed";
	}
	$this->session->set_flashdata('action',$action);
	redirect('FeeManagement/student_payment/');
}	

function view_fee_master()
{
	$page_data['page_name']                 = 'view_fee_master';
	$page_data['page_title']                = 'Fee Master';
	$this->load->view('backend/index', $page_data);
}

	///////////////////////////////////	end of /added on 20-09-2017
		
function student_details($class, $section)
{
	$this->db->where('class_id', $class);
	$this->db->where('section_id',$section);
	$this->db->join('enroll', 'enroll.student_id = student.student_id');
	$this->db->select('student.student_id, student.name');
	$cls = $this->db->get('student')->result_array();

	$data['student']	=	$cls;
	$data['class_id']	=	$class;
	$data['batch']		=	$section;
	$this->load->view('admin/student_details.php', $data);
	}	
	
	
	
	
	function student_payment_details($class_id='',$section_id='',$dept_id='',$branch_id='')
	{
		$details			=	$this->Fee_management_model->get_student_fee_details($class_id,$section_id);
		$data['student']	=	$details;
		$data['branch_id']	=	$branch_id;
		$data['dept_id']	=	$dept_id;
		$data['class_id']	=	$class_id;
		$data['batch']		=	$section_id;
		$this->load->view('admin/student_payment_details.php', $data);
	}	
	
	
	function modify_payment()
	{
	$master_id		=	$this->input->post('student_fee_master_id');
	$head			=	$this->input->post('fee_head[]');
	$fee_balance		=	$this->input->post('fee_balance[]');
	$fee_concession	=	$this->input->post('fee_concession[]');
	$fee_amount			=	$this->input->post('fee_amount[]');
	$count			=	count($head);
	$total_balance 	= 	0;
	$total_concession = 0;

	for($i=0;$i<$count;$i++)
	{
		$balance = floatval(str_replace(",","",$fee_balance[$i]));
		$concession =  floatval(str_replace(",","",$fee_concession[$i])) ;
		
		$total_balance   		=  $total_balance + $balance;
		$total_concession 		=  $total_concession + $concession ;

		$data1['fee_balance']	=	$balance - $concession;
		$data1['fee_concession']=   $concession;
		
		$this->db->where('students_fee_master_id',$master_id);
		$this->db->where('fee_head_id',$head[$i]);
		$this->db->update('tbl_students_fee_details', $data1);
	}
	$fee_balance =$total_balance -$total_concession;
	$data['fee_balance']=$fee_balance;
	$data['fee_concession']= $total_concession;
	
	
	$this->db->where('students_fee_master_id',$master_id);
	$this->db->update('tbl_students_fee_master', $data);
	
//redirect(base_url() . 'index.php?FeeManagement/student_payment/', 'refresh');
redirect($_SERVER['HTTP_REFERER']);
	}	
	
function student_details1($student,$class_id,$section,$fee_plan)
{
	$this->db->where('student_id', $student);
	$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent');
	$this->db->from('student');
	
		$cls1				=	$this->db->get()->result_array();
		$data['student']	=	$cls1;
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['student_id']	=	$student;
		$data['fee_plan']	=	$fee_plan;
		
		$this->load->view('admin/student_details_print', $data);
}	
	
	
	function student_payment_details1($student='',$class_id='',$section='',$dept_id='',$branch_id='')
	{
		$this->db->where('student_id', $student);
		$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent,admission_number');
		$this->db->from('student');
		
		$cls1				=	$this->db->get()->result_array();
		$data['student']	=	$cls1;
		$data['branch_id']	=	$branch_id;
		$data['dept_id']	=	$dept_id;
		$data['class_id']	=	$class_id;
		$data['section']	=	$section;
		$data['student_id']	=	$student;
	
		$this->load->view('admin/student_payment_details_print', $data);
	}
	
	
function student_fee_payment_details($student='',$class_id='',$section='',$dept_id='',$branch_id='')
	{

		$this->db->select('student_id,name,birthday,sex,address,phone1,email,parent,admission_number');
		$this->db->from('student');
		$this->db->where('student_id', $student);
		$cls1					=	$this->db->get()->result_array();
		
		$page_data['branch_id']	=	$branch_id;
		$page_data['dept_id']	=	$dept_id;
		$page_data['student']	=	$cls1;
		$page_data['class_id']	=	$class_id;
		$page_data['section']	=	$section;
		$page_data['student_id']	=$student;
		$page_data['page_name']	=	'student_fee_payment_details';
	
		$this->load->view('admin/student_fee_payment_details', $page_data);
	}

		
		
function fees_assign($class_id,$section,$student_id,$option,$fee_plan)
{
	$this->db->select('fee_installment_master_id,fee_total,fee_balance,due_date');
	$this->db->from('tbl_fee_installment_master');
	$this->db->where('fee_payment_options_master_id',$option);
	$this->db->where('fee_master_id',$fee_plan);
	$result=$this->db->get()->result_array();
	
	foreach($result as $row)
	{
		$concession							=	0;
		$data1['admission_number']			=	$student_id;
		$data1['class_id']					=	$class_id;
		$data1['batch_id']					=	$section;
		$data1['fee_master_id']				=	$fee_plan;
		$data1['fee_installment_master_id']	=	$row['fee_installment_master_id'];
		$data1['due_date']					=	$row['due_date'];
		$data1['fee_amount']				=	$row['fee_total'];
		$data1['fee_balance']				=	$row['fee_balance'];
		$data1['fee_concession']			=	$concession;
		$data1['academic_year_id']			=	get_student_academic_year($student_id);
		
		$this->db->trans_start();
		
		$this->db->insert('tbl_students_fee_master', $data1);
		
		$master_id= $this->db->insert_id();
		$primary_id=$row['fee_installment_master_id'];
		
		$this->db->select('fee_head_id,fee_amount,fee_balance');
		$this->db->from('tbl_fee_installment_details');
		$this->db->where('fee_installment_master_id',$primary_id);
		$result1=$this->db->get()->result_array();
	
	foreach($result1 as $row1)
	{
		$data['students_fee_master_id']	=	$master_id;
		$data['fee_head_id']			=	$row1['fee_head_id'];
		$data['fee_amount']				=	$row1['fee_amount'];
		$data['fee_balance']			=	$row1['fee_balance'];
		$data['fee_concession']			=	$concession;
		$this->db->insert('tbl_students_fee_details', $data);
	}
	
	$this->db->trans_complete();
	}
	$page_data['page_name']	 = 'assign_fees';
	$page_data['page_title'] = 'Assign-Fees';
	redirect(base_url() . 'index.php/FeeManagement/assign_fees/', 'refresh');
}
		
	
	
		//// Added by Sathish begins here 
	
    function add_fee_heads()
    {
        
        $page_data['page_name']  = 'add_fee_heads1';
        $page_data['page_title'] = get_phrase('Add-Fee-Heads');
        $this->load->view('backend/index', $page_data);
    }



	public function insert_fee_head1()
	{
		
		$fee_heads = array(
		'fee_head'  			=>$this->input->post('txtfee_head'),
		'fee_head_description'  =>$this->input->post('txtfee_head_description'),
		'account_head_id' 		=>$this->input->post('lstaccount_head_id'),
		'active'  				=>'Y');
		
		$page_data['page_name']  = 'add_fee_heads1';
        $page_data['page_title'] = get_phrase('Add-Fee-Heads');
      
		$this->db->insert('tbl_fee_heads',$fee_heads);
		$this->load->view('backend/index', $page_data);
	}
	
	public function delete_fee_head($id)
	{
    $this->db->where('fee_head_id', $id);
        $this->db->delete('tbl_fee_heads');

		$page_data['page_name']  = 'add_fee_heads1';
        $page_data['page_title'] = get_phrase('Add-Fee-Heads');
	    $this->load->view('backend/index', $page_data);
	}
	
	//////////////  
	public function course_fee_details()
	{
		$page_data['page_name']  = 'course_fee_details';
        $page_data['page_title'] = get_phrase('Course Fee Details');
		$this->load->view('backend/index', $page_data);
	}
	public function course_fee_details1()
	{
		$page_data['class_id']   =$this->input->post('class_id');
		$page_data['course_name']=$this->input->post('txtcourse');
		$page_data['page_name']  = 'course_fee_details1';
        $page_data['page_title'] = get_phrase('Course Fee Details');

		$this->load->view('backend/index', $page_data);
	}
	
	
	public function course_fee_installements()
	{
		$page_data['page_name']  = 'course_fee_installments';
        $page_data['page_title'] = get_phrase('Fee Installments Details');
		$this->load->view('backend/index', $page_data);
	}
	
	public function course_fee_installements1()
	{

		$page_data['class_id']             =$this->input->post('class_id');
		$page_data['course']               =$this->input->post('txtcourse');
		$page_data['section_id']           =$this->input->post('section_id');
		$page_data['section']              =$this->input->post('txtsection');
		
		$page_data['payment_option_id']    =$this->input->post('payment_option_id');
		$page_data['payment_option']       =$this->input->post('txtpayment_option');
		
		$page_data['installment_id']       =$this->input->post('installment_id');
		$page_data['installment']          =$this->input->post('txtinstallment');
		
		
		$page_data['page_name']            = 'course_fee_installments1';
        $page_data['page_title']           = get_phrase('Fee Installments Details');

		$this->load->view('backend/index', $page_data);
	}
	
	
	public function fee_due_report()
	{
		$page_data['page_name']  = 'fee_due_report';
        $page_data['page_title'] = 'Fee Due Report';
		
		if($this->session->userdata('role')==7)
		{
		$this->load->view('office_staff/fee_due_report', $page_data);
		}
		$this->load->view('admin/fee_due_report', $page_data);
	}

	
	public function fee_due_report1()
	{
		$page_data['class_id']			=	$this->input->post('class_id');
		$class_id			            =	$this->input->post('class_id');
		$dept_id			            =	$this->input->post('department');
		$page_data['course']            =	$this->input->post('txtcourse');
		$page_data['section_id']        =	$this->input->post('section_id');
		$section_id 			        =	$this->input->post('section_id');
		$page_data['section']           =	$this->input->post('txtsection');
		$page_data['title']             =	"Fee Due Report";
		$due_date_from					=	$this->input->post('due_date_from');
                $last_year_due					=	$this->input->post('last_year_due');
                $page_data['last_year_due']     =   $last_year_due;
		if($due_date_from!='')
		{
		    $due_date_from				=	date('Y-m-d',strtotime( $this->input->post('due_date_from')));
		}
		
		$due_date						=	$this->input->post('due_date');
		if($due_date!='')
		{
			$due_date					=	date('Y-m-d',strtotime( $this->input->post('due_date')));
		}
		
		$page_data['due_date_from']		=	$due_date_from;
		$page_data['due_date']			=	$this->input->post('due_date');
		$role							=	$this->session->userdata('role');
		if($role=='4' || $role=='16' )
		{
			$dept_id					=	$this->session->userdata('dept_id');
		}
		$page_data['dept_id']			=	$dept_id;
		
		$amount							=	$this->input->post('amount');
		$page_data['amount']			=	$amount;
		
		$condition						=	' ';
		$condition1						=	' ';
		$condition2						=	' ';
		$condition3						=	' ';
                
                $condition_op_bal                                       =       ' ';
                $condition_op_bal1                                      =       ' ';
                
		$page_data['report_type']		=	$this->input->post('report_type');
		$report_type					=	$this->input->post('report_type');
		if($this->db->get_where('settings' , array('type' =>'installment_wise_due_report'))->row()->description == 'yes')
		{
			$installment_id				=	$this->input->post('installment');	
		}
	 if($this->db->get_where('settings' , array('type' =>'reset_due_idle'))->row()->description == 'yes')
	 {
		if($report_type =='1')
		{
		    //$condition	=	$condition." is_idle = 'N' and ";
		    //$condition1	=	$condition1." is_idle = 'N' and ";
		    //$condition2	=	$condition2." a.is_idle = 'N' and ";
		    //$condition3	=	$condition3." is_idle = 'N' and ";
			$page_data['page_title']           = get_phrase('Fee Due Report');
		}
		else if($report_type =='2')
		{
		    $condition	=	$condition."is_idle = 'Y' and ";
		    $condition1	=	$condition1."is_idle = 'Y' and ";
		    $condition2	=	$condition2."a.is_idle = 'Y' and ";
		    $condition3	=	$condition3."is_idle = 'Y' and ";
                    $page_data['page_title']           = get_phrase('Fee Due Idle Report');
		}
	}
		if($dept_id == 'all')
		{
		    $condition	=	$condition." branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition1	=	$condition1." branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition2	=	$condition2." a.branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition3	=	$condition3." branch_id = '".$this->session->userdata('branch_id')."' ";
                    
                    $condition_op_bal   =   $condition_op_bal." branch_id = '".$this->session->userdata('branch_id')."' ";
                    $condition_op_bal1  =   $condition_op_bal1." branch_id = '".$this->session->userdata('branch_id')."' ";
                    
		}
		else if($class_id == 'all')
		{
			$condition	=	$condition." dept_id = '".$dept_id."' ";
			$condition1	=	$condition1." dept_id = '".$dept_id."' ";
			$condition2	=	$condition2." a.dept_id = '".$dept_id."' ";
			$condition3	=	$condition3." a.dept_id = '".$dept_id."' ";
			
                        $condition_op_bal	=	$condition_op_bal." dept_id = '".$dept_id."' ";
                        $condition_op_bal1	=	$condition_op_bal1." dept_id = '".$dept_id."' ";
                        
		}
		else
		{
			if($section_id == 'all')
			{
				$condition	=	$condition." class_id = '".$class_id."' ";
				$condition1	=	$condition1." class_id = '".$class_id."' ";
				$condition2	=	$condition2." a.class_id = '".$class_id."' ";
				$condition3	=	$condition3." class_id = '".$class_id."' ";
                                
				$condition_op_bal	=	$condition_op_bal." class_id = '".$class_id."' ";
                                $condition_op_bal1	=	$condition_op_bal1." class_id = '".$class_id."' ";
                                
			}
			else
			{
				$condition	=	$condition." class_id = '".$class_id."' and batch_id = '".$section_id."' ";
				$condition1	=	$condition1." class_id = '".$class_id."' and section_id = '".$section_id."' ";
				$condition2	=	$condition2." a.class_id = '".$class_id."' and a.batch_id = '".$section_id."' ";
				$condition3	=	$condition3." class_id = '".$class_id."' and section_id = '".$section_id."' ";
                                
                                $condition_op_bal	=	$condition_op_bal." class_id = '".$class_id."' and section_id = '".$section_id."' ";
                                $condition_op_bal1	=	$condition_op_bal1." class_id = '".$class_id."' and section_id = '".$section_id."' ";
                                
			}
		}
		if($due_date_from == '')
		{
			$condition	=	$condition;
			$condition1	=	$condition1;
			$condition2	=	$condition2;
			$condition3	=	$condition3;
		}
		if($this->db->get_where('settings' , array('type' =>'installment_wise_due_report'))->row()->description == 'yes' && $installment_id!='')
		{
			$condition	=	$condition." and fee_payment_options_details_id = '".$installment_id."' ";
		}
		else
		{
                    if($due_date_from !== '')
                    {
                        $condition	=	$condition." and due_date >= '".$due_date_from."' ";
			$condition1	=	$condition1." and due_date >= '".$due_date_from."' ";
			$condition2	=	$condition2." and a.due_date >= '".$due_date_from."' ";
			$condition3	=	$condition3." and due_date >= '".$due_date_from."' ";                        
                    }   
		}
		
		if($this->input->post('due_date') == '')
		{
			$condition	=	$condition;
			$condition1	=	$condition1;
			$condition2	=	$condition2;
			$condition3	=	$condition3;
		}
		if($this->db->get_where('settings' , array('type' =>'installment_wise_due_report'))->row()->description == 'yes' && $installment_id!='')
		{
			$condition	=	$condition." and fee_payment_options_details_id = '".$installment_id."' ";
		}
		else
		{
			$condition	=	$condition." and due_date <= '".$due_date."' and enroll_year='".get_running_year()."' and academic_year_id='".get_running_year()."' ";
			$condition1	=	$condition1." and due_date <= '".$due_date."' and enroll_year='".get_running_year()."' and academic_year='".get_running_year()."' ";
			$condition2	=	$condition2." and a.due_date <= '".$due_date."' and a.academic_year_id='".get_running_year()."' and a.enroll_year='".get_running_year()."' ";
			$condition3	=	$condition3." and due_date <= '".$due_date."' and a.academic_year='".get_running_year()."' and a.enroll_year='".get_running_year()."'";
			
                        $condition_op_bal	=	$condition_op_bal." and fee_to_year_id='".get_running_year()."' and enroll_year='".get_running_year()."'";
                        $condition_op_bal1	=	$condition_op_bal1." and fee_to_year_id='".get_running_year()."' and enroll_year='".get_running_year()."'";
                        
		}
		//echo $condition;die;
		if($amount=='')
		{
			$amount		=	0;
		}
		/*
		if($this->db->get_where('settings',array('type'=>'show_multiple_dues'))->row()->description=='no') 
		{		
	    	if($due_date_from == '')
	    	{
	        /*
	        Lazzaro:If due date from is null, then all dues till the selected date should be shown.(If one student's multiple dues are there, add all amount and show as a single row)
	        
    			if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes') //Add fee balance of all dues of a student and display in single row.
    			{
    				$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " .$condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
				
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
					}			
    			}	
    			else																									//Display the first due only.
    			{
    				$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
				
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
					}
    			}
	    	}
	    	else
	    	{
	    	    if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes')
	    	    {
    				$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
				
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
					}			
	    	    }
	    	    else
	    	    {
				    $sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
			
				    if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
				    {
				    	$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
				    }
	    	    }    
	    	}
		}
		else
		{
	    	if($due_date_from == '')
	    	{*/
                        $union  =   "";
                        $union1 =   "";
                        if($last_year_due == 1)
                        {
                            $union  =   "union all (select phone1 as phone,student_id as admission_number,class_id,section_id as batch_id,fee_amount,SUM(fee_balance) as fee_balance,'0000-00-00' as due_date,name from view_opening_balance where $condition_op_bal and fee_balance>$amount group by student_id) ";
                            $union1  =   "union all (select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,'0000-00-00' as due_date,name from view_opening_balance_transport where $condition_op_bal1 and fee_balance>$amount group by student_id) ";
                        }    
                
    			if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes') //Add fee balance of all dues of a student and display in single row.
    			{   
    				$sql = " select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from ( (select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " .$condition ." and  fee_balance>$amount group by admission_number ) $union ) as Tab group by admission_number order by due_date,class_id,batch_id,name ";
				
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from ( (select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id) $union1 ) as Tab1 group by student_id order by due_date,class_id,section_id,name ";
					}
    			}	
    			else	//Here last year fee due is not adding.Here all dues of regular fee is showing, then how to display last year due?																								//Display all dues.
    			{ 
    				$sql = " select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " .$condition. " and  fee_balance>$amount order by due_date,class_id,batch_id,name";
				
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount order by due_date,class_id,section_id,name";
					}
    			}
	    	/*}
	    	else
	    	{
				$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " .$condition. " and  fee_balance>$amount order by due_date,class_id,batch_id,name";
			
				if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
				{
					$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount order by due_date,class_id,section_id,name";
				}
	    	}
		}*/
		$result= $this->db->query($sql)->result_array();//echo $this->db->last_query();die;
            //The following is only for minhaj school.Here also last year due is not adding...    
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
			$result1= $this->db->query($sql1)->result_array();
			$page_data['result1']				= $result1;
			//print_r($result1);
			//echo $this->db->last_query();die;
		}
		
		if($this->db->get_where('settings',array('type'=>'show_multiple_dues'))->row()->description=='no' && $this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
		{	
			$sql = "select name,admission_number,sum(fee_balance) as fee_balance "
                                . "from "
                                . "("
                                    . "(SELECT a.admission_number,a.class_id,a.batch_id,a.due_date,sum(case when (a.student_status_id != 0 and a.student_status_id != 5) then 0 else a.fee_balance end) as fee_balance,a.name "
                                    . "FROM view_fee_due a inner join student b on b.student_id=a.admission_number and b.student_status_id=0 where " . $condition2 ." and  a.fee_balance>0 group by a.admission_number) "
                                    . "UNION ALL "
                                    . "(SELECT a.student_id,a.class_id,a.section_id as batch_id,a.due_date,sum(case when (a.student_status_id != 0 and a.student_status_id != 5) then 0 else a.fee_balance end) as fee_balance,a.name "
                                    . "FROM view_transport_students_bus_fee_master a inner join student b on b.student_id=a.student_id where " . $condition3 ." and a.is_deleted='N' and  a.fee_balance>0 group by a.student_id) "
                                    . "UNION ALL "
                                    . "(SELECT student_id as admission_number,class_id,section_id as batch_id,'0000-00-00' as due_date,sum(fee_balance) as fee_balance,name "
                                    . "FROM view_opening_balance where " . $condition_op_bal ." and  fee_balance>0 group by admission_number ) "
                                    . "UNION ALL "
                                    . "(SELECT student_id as admission_number,class_id,section_id as batch_id,'0000-00-00' as due_date,sum(fee_balance) as fee_balance,name "
                                    . "FROM view_opening_balance_transport where " . $condition_op_bal1 ." and  fee_balance>0 group by admission_number ) "
                                . ") as T "
                                . "group by admission_number HAVING fee_balance>$amount order by fee_balance desc";
			$result= $this->db->query($sql)->result_array();
			//echo $this->db->last_query();die;
		}
		
		$page_data['result']			   = $result;
		$page_data['page_name']            = 'fee_due_report1';
	
		if($this->session->userdata('role')==7)
		{
			$this->load->view('office_staff/fee_due_report1', $page_data);
		}
		$this->load->view('admin/fee_due_report1', $page_data);
	}
	
	/*function temp()
	{
	    $this->db->where('class_id IS NULL');  
	    $this->db->from('tbl_students_fee_master');
	    $qry    =   $this->db->get()->result_array(); 
	    foreach($qry as $row){
	        //echo $row['students_fee_master_id']."<br>";
	        $this->db->select('fee_collection_master_id');
	        $this->db->where('student_fee_master_id',$row['students_fee_master_id']);
	        $qry1   =   $this->db->get('tbl_fee_collection_master')->result_array();
	        if(count($qry1)>0)
	        {
	            echo $row['students_fee_master_id']."<br>";
	        }
	    }
	}*/
	public function fee_due_report2($class_id='',$section_id='',$due_date='',$due_date_from='',$dept_id='')
	{ //echo $due_date_from;die;
		if($class_id!='')
		{
			$data['class_id']			=	$class_id;
		}
		if($section_id!='')
		{
			$data['section_id']			=	$section_id;
		}
		if($due_date!='')
		{
			$data['due_date']			=	$due_date;
		}
		$condition  =   '';
		$condition1  =   '';
		if($dept_id == 'all')
		{
		    $condition	=	$condition." branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition1	=	$condition1." branch_id = '".$this->session->userdata('branch_id')."' ";
		}
		else if($class_id == 'all')
		{
			$condition	=	$condition." dept_id = '".$dept_id."' ";
			$condition1	=	$condition1." dept_id = '".$dept_id."' ";
		}
		else
		{
			if($section_id == 'all')
			{
				$condition	=	$condition." class_id = '".$class_id."' ";
				$condition1	=	$condition1." class_id = '".$class_id."' ";
			}
			else
			{
				$condition	=	$condition." class_id = '".$class_id."' and batch_id = '".$section_id."' ";
				$condition1	=	$condition1." class_id = '".$class_id."' and section_id = '".$section_id."' ";
			}
		}
		if($due_date_from == '' || $due_date_from=='0')
		{
			$condition	=	$condition;
			$condition1	=	$condition1;
		}
		else
		{
			$condition	=	$condition." and due_date >= '".$due_date_from."' ";
			$condition1	=	$condition1." and due_date >= '".$due_date_from."' ";
		}
		
	if($this->db->get_where('settings',array('type'=>'show_multiple_dues'))->row()->description=='no') 
	{		
	    if($due_date_from == '')
	    {
	        /*
	        Lazzaro:If due date from is null, then all dues till the selected date should be shown.(If one student's multiple dues are there, add all amount and show as a single row)
	        */
    		if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes') //Add fee balance of all dues of a student and display in single row.
    		{
    			$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " . $condition ." and due_date<='" . $due_date	. "' and  fee_balance>0 group by admission_number order by due_date,class_id,batch_id,name";
				
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and due_date<='" . $due_date	. "' and  fee_balance>0 group by student_id order by due_date,class_id,section_id,name";
}			
    		}	
    		else																									//Display the first due only.
    		{
    			$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " . $condition ." and due_date<='" . $due_date	. "' and  fee_balance>0 group by admission_number order by due_date,class_id,batch_id,name";
				
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and due_date<='" . $due_date	. "' and  fee_balance>0 group by student_id order by due_date,class_id,section_id,name";
}
    		}
	    }
    	else
    	{
    	    if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes')
    	    {
				$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
			
				if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
				{
					$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
				}			
    	    }
    	    else
    	    {
			    $sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
		
			    if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
			    {
			    	$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
			    }
    	    }    
    	}
	}
	else
	{
	    if($due_date_from == '')
	    {
    		if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes') //Add fee balance of all dues of a student and display in single row.
    		{
    			$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " .$condition ." and due_date<='" . $due_date	. "' and  fee_balance>0 group by admission_number order by due_date,class_id,batch_id,name";
				
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and due_date<='" . $due_date	. "' and  fee_balance>0 group by student_id order by due_date,class_id,section_id,name";
}
    		}	
    		else																									//Display all dues.
    		{
    			$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " .$condition. " and due_date<='" . $due_date	. "' and  fee_balance>0 order by due_date,class_id,batch_id,name";
				
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and due_date<='" . $due_date	. "' and  fee_balance>0 order by due_date,class_id,section_id,name";
}
    		}
	    }
	    else
	    {
			$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " .$condition. " and due_date<='" . $due_date	. "' and  fee_balance>0 order by due_date,class_id,batch_id,name";
			
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and due_date<='" . $due_date	. "' and  fee_balance>0 order by due_date,class_id,section_id,name";
}
	    }
	}


$result= $this->db->query($sql)->result_array();//echo $this->db->last_query();
$result1= $this->db->query($sql1)->result_array();//echo $this->db->last_query();

		if($this->db->get_where('settings',array('type'=>'show_multiple_dues'))->row()->description=='no' && $this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
		{	
			$sql = "select name,admission_number,sum(fee_balance) as fee_balance from ((SELECT admission_number,class_id,batch_id,due_date,sum(fee_balance) as fee_balance,name FROM view_fee_due where " . $condition ." and due_date<='" . $due_date	. "' and  fee_balance>0 group by admission_number) UNION (SELECT student_id,class_id,section_id,due_date,sum(fee_balance) as fee_balance,name FROM view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and due_date<='" . $due_date	. "' and  fee_balance>0 group by student_id)) as T group by admission_number order by fee_balance desc";
			$result= $this->db->query($sql)->result_array();
		}

		$data['result']					= $result;
		$data['result1']				= $result1;
		$data['page_name']            	= 'fee_due_report1';
        $data['page_title']           	= get_phrase('Fee Due Report');
	
	if($this->session->userdata('role')==7)
		{
		$this->load->view('office_staff/fee_due_report1', $data);
		}
		$this->load->view('admin/fee_due_report1', $data);
	}

	public function fee_due_abstract_report()
	{
		//$sql = "select admission_number from view_fee_due where class_id= '4' and batch_id= '35' and due_date<='2018-08-30' and  fee_balance>0";	
		$sql = "select admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where class_id= '4' and batch_id= '35' and due_date<='2018-08-30' and  fee_balance>0 group by admission_number order by due_date,class_id,batch_id,name";
		$students= $this->db->query($sql)->result_array();
		echo "Admission Numbers<br>";
		foreach($students as $student):
			echo $student['admission_number']."-".$student['fee_balance']."  ".$student['due_date']."<br>";
		endforeach;
		
	}	
	
	function fee_due_report_excel()
	{
		$query_result	=	unserialize(base64_decode($this->input->post('result')));
		$query_result1	=	unserialize(base64_decode($this->input->post('result1')));
		ob_start();
		ob_get_clean();
		$total = 0;
		$i=1;
		
		//$dataToExports = [];
		$filename = "DueReport.xls";
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo  "Fee Due List\n";
		if($this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
		{
			foreach ($query_result as $data)
			{
				$total 						=	$total+$data['fee_balance'];
				$arrangeData['Sl.No'] 		= 	$i;
				//$arrangeData['Student ID'] 	= $data['admission_number'];
				$arrangeData['Name'] 		=  	$data['name'];
				$arrangeData['Admission No.']=  get_admission_number($data['admission_number']);
				$arrangeData['Class'] 		=  	get_student_class_name($data['admission_number']);
				$arrangeData['Section'] 	= 	get_student_section_name($data['admission_number']);
				$arrangeData['Phone'] 		=  	get_student_phone1($data['admission_number']);
				$arrangeData['Amount'] 		=  	$data['fee_balance'];
				
				$dataToExports[]			= 	$arrangeData;
				$i							=	$i+1;
			}
			$arrangeData['Sl.No'] 		= 	"";
			$arrangeData['Name'] 		= 	"";
			$arrangeData['Admission No.'] 		= 	"";
			$arrangeData['Class'] 		= 	"";
			$arrangeData['Section'] 	= 	"";
			$arrangeData['Phone'] 		=  	"Total";
			$arrangeData['Amount']		=  	$total;
			$dataToExports[]			= 	$arrangeData;
		}
		else
		{
			foreach ($query_result as $data)
			{
				$total =$total+$data['fee_balance'];
				$arrangeData['Sl.No'] 		= $i;
				$arrangeData['Due Date'] 	= date('d-m-Y', strtotime( $data['due_date']));
				//$arrangeData['Student ID'] 	= $data['admission_number'];
				$arrangeData['Name'] 		=  	$data['name'];
				$arrangeData['Class'] 		=  	get_student_class_name($data['admission_number']);
				$arrangeData['Section'] 	= 	get_student_section_name($data['admission_number']);
				$arrangeData['Phone'] 		=  	$data['phone'];
				$arrangeData['Amount'] 		=  	$data['fee_balance'];
                                
                                if($this->db->get_where('settings',array('type'=>'last_paid_info_in_fee_due_report'))->row()->description=='yes')
                                    {   
                                        $last_paid_info                     =   $this->Fee_management_model->get_last_paid_info($data['admission_number']);
                                        $arrangeData['Last Paid Date'] 	    =   $last_paid_info['last_paid_date'];
                                        $arrangeData['Last Paid Amount'] 	=   $last_paid_info['last_paid_amount'];
                                    }

				
				$dataToExports[]			= $arrangeData;
				$i=$i+1;
			}
			if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
			{
				foreach ($query_result1 as $data)
				{
					$total =$total+$data['fee_balance'];
					$arrangeData['Sl.No'] 		= $i;
					$arrangeData['Due Date'] 	= date('d-m-Y', strtotime( $data['due_date']));
					//$arrangeData['Student ID'] 	= $data['admission_number'];
					$arrangeData['Name'] 		=  	$data['name'];
					$arrangeData['Class'] 		=  	$data['class_name'];
					$arrangeData['Section'] 	= 	$data['section_name'];
					$arrangeData['Phone'] 		=  	get_student_phone1($data['student_id']);
					$arrangeData['Amount'] 		=  	$data['fee_balance'];
					
					$dataToExports[]			= $arrangeData;
					$i=$i+1;
				}
			}
			$arrangeData['Sl.No'] 		= "";
			$arrangeData['Due Date'] 	= "";
			$arrangeData['Name'] 		= "";
			$arrangeData['Class'] 		= "";
			$arrangeData['Section'] 	= "";
			$arrangeData['Phone'] 		=  "Total";
			$arrangeData['Amount']		=  $total;
                        if($this->db->get_where('settings',array('type'=>'last_paid_info_in_fee_due_report'))->row()->description=='yes')
			{
			    $arrangeData['Last Paid Date'] 	    = "";
			    $arrangeData['Last Paid Amount'] 	= "";
			}

			$dataToExports[]			= $arrangeData;
			// set header
		}
		$this->exportExcelData($dataToExports);
		die();
	}	


function get_payment_options($payment_option_id,$class_id)
{
		
		  		$this->db->where('fee_payment_options_master_id ',$payment_option_id);
		  		$this->db->where('class_id',$class_id);
				$installments	=	$this->db->get('view_course_fee_installments' )->result_array();
		echo '<option value="0">[SELECT]</option>';
		foreach ($installments as $row) 
		{
		  	echo '<option value="' . $row['fee_payment_options_details_id'] . '">' . $row['fee_payment_options_details'] . '</option>';
		}
}



////////////////////////////////////////////////////////////////////////////
/////////// Modifications September 1st onwards
/////////////////////////////////////////////////////////////////////
	function get_class_section($class_id)  ////// is an ajax function to fill the list box of section 
	{
		$year			=	get_running_year();
		$class_option	=	$this->input->post('class');
		echo '<option value="ALL">ALL</option>';
		
		if($class_id!='ALL')
		{
			$this->db->order_by('name','ASC');
			$sections = $this->db->get_where('section' , array('class_id' => $class_id,'academic_year'=>$year))->result_array();
			foreach ($sections as $row)
			{
				echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
			}
		}
	}// end of ajax function 
	
	function get_class_section1($class_id)  ////// is an ajax function to fill the list box of section 
	{
		$class_option=$this->input->post('class');
		$yr=get_running_year();
		    $this->db->where('class_id',$class_id);
			$this->db->where('academic_year',$yr);
			$sections = $this->db->get('section')->result_array();
	
			foreach ($sections as $row)
			{
				echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
			}
	
	}// end of ajax function 
	function get_class_subject1($class_id,$hour_id)  ////// is an ajax function to fill the list box of section 
	{
		$class_option=$this->input->post('class');
	        
			$subject = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
			
			foreach ($subject as $row)
			{
				echo '<option value="' . $row['subject_id'] . '">' . $row['name'] . '</option>';
			}
	
	}
	function get_class_teacher1($subject_id)  ////// is an ajax function to fill the list box of section 
	{
		
		
		$this->db->select('s.name as staff,subject.teacher_id as teacher');
		$this->db->join('staff s','s.staff_id=subject.teacher_id','LEFT');
		$subject = $this->db->get_where('subject' , array('subject_id' => $subject_id))->result_array();
		foreach ($subject as $row)
			{
				echo '<option value="' . $row['teacher'] . '">' . $row['staff'] . '</option>';
			}
	
	}

	public function fee_collection_abstract_report()
	{
		
		$page_data['page_name']  = 'fee_collection_abstract_report';
        $page_data['page_title'] = 'Fee Collection Abstract';
	
		$this->load->view('backend/index', $page_data);
	}

	
	public function fee_collection_abstract_report1($date_from='',$date_to='' ,$class_id='' ,$section_id='',$output_type='' )
	{
		$date_from        = date("Y-m-d", strtotime($this->input->post('date_from')));
		$date_to          =date("Y-m-d", strtotime($this->input->post('date_to')));
		$class_id        =$this->input->post('class_id');
		$section_id       =$this->input->post('section_id');
		$condition = " where date_paid between '" . $date_from . "' and '" . $date_to . "' ";
		if ($class_id=='ALL' && $section_id=='ALL')
			$condition = $condition ;
		elseif ($class_id !='ALL' && $section_id=='ALL')
			$condition = $condition . " and class_id=". $class_id;
		else
			$condition = $condition . "  and class_id=". $class_id. " and batch_id=". $section_id;
		
		$sql = "select admission_number,date_paid,receipt_number,sum(fee_amount) as fee_amount from view_fee_collection_details " . $condition . "  group by receipt_number,date_paid,admission_number ";

		$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		if ($output_type=="Excel")
		{
									ob_start();
									ob_get_clean();
									$total = 0;
									$i=1;

								 //  $dataToExports = [];
								   echo  "\t\tFee Collection Report\n";
								   echo  "\t\tFrom " . date('d-m-Y',strtotime($date_from)) . " To " . date('d-m-Y',strtotime($date_to)). "\n";
								   echo  "\tClass  \t" . get_class_name($class_id ). "\n";
									echo  "\tSection/Batch  \t" . get_section_name( $section_id ). "\n\n\n";
								foreach ($query_result as $data)
								{
									$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Date Paid'] 	= date('d-m-Y',strtotime($data['date_paid']));
									$arrangeData['Receipt No.'] = $data['receipt_number'];
									$arrangeData['Name']		= get_student_name($data['admission_number']);
									$arrangeData['Amount']		= number_format($data['fee_amount'],2);
									$total = $total +  $data['fee_amount'];
									$dataToExports[]			= $arrangeData;
									$i=$i+1;
								}
									$arrangeData['Sl.No'] 		= "";
									$arrangeData['Date Paid'] 	= "";
									$arrangeData['Name']		= "";
									$arrangeData['Receipt No.']	= "Total";
									$arrangeData['Amount']		=number_format( $total,2);
									$dataToExports[]			= $arrangeData;
								// set header
								$filename = "FeeCollectionReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								$this->exportExcelData($dataToExports);
								die();
			}

		/////////////////////////////////
		
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Fee Collection Abstract Report";
		$page_data['page_name']        = 'fee_collection_abstract_report1';
        $page_data['page_title']       = 'Fee Collection Report';
		$page_data['query_result']	   = $query_result;
		$this->load->view('backend/index', $page_data);
	}
	
public function fee_collection_detailed_report()
	{
		$page_data['page_name']  = 'fee_collection_detailed_report';
        $page_data['page_title'] = 'Fee Collection Report';
		if($this->session->userdata('role')==7)
		{
		$this->load->view('office_staff/fee_collection_detailed_report', $page_data);
		}
		$this->load->view('admin/fee_collection_detailed_report', $page_data);
	}

	
	public function fee_collection_detailed_report1()
	{
                $year               =   get_running_year();
		$date_from        = date("Y-m-d", strtotime($this->input->post('date_from')));
		$date_to          =date("Y-m-d", strtotime($this->input->post('date_to')));
		$class_id        =$this->input->post('class_id');
		$section_id       =$this->input->post('section_id');
		$report_type = $this->input->post('report_type');
		$fee_head_id  = $this->input->post('fee_head_id');
		$section_name  = $this->input->post('txtsection');
		$department_id	=	$this->input->post('department');
		$role=$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$branch_id	=	$this->input->post('branch');
		}
		else
		{
			$branch_id	=	$this->session->userdata('branch_id');	
		}
		
		/*	if($department_id=='All')
			{
				$role=$this->session->userdata('role');
				 if($role==1 || $role==2)
				 {
					 $branch_id	=	$this->input->post('branch');
				 }
				 else
				 {
				 	 $branch_id	=	$this->session->userdata('branch_id');	
				 }
				 
			}*/
		
		if ($report_type=="abstract")
		{
			$condition = " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "'  and a.academic_year_id=".$year;
			$condition1 = " where is_deleted='N' and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "'  and a.academic_year_id=".$year;
		$condition2 = " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and b.academic_year=".$year;
			
			if($role==15)
			{
				$condition = $condition . " and b.collected_by=". $this->session->userdata('login_user_id');
				$condition1 = $condition1 . " and a.entered_by=". $this->session->userdata('login_user_id');
				$condition2 = $condition2 . " and b.entered_by=". $this->session->userdata('login_user_id');
			}
			
			if($department_id!='All')
			{	
				if ($class_id=='ALL' && $section_id=='ALL')
				{
					$condition = $condition . " and b.department_id=". $department_id ;
					$condition1 = $condition1 . " and a.dept_id=". $department_id ;
					$condition2 = $condition2 . " and a.dept_id=". $department_id ;
				}
				elseif ($class_id !='ALL' && $section_id=='ALL')
				{
					$condition = $condition . " and a.class_id=". $class_id;
					$condition1 = $condition1 . " and a.class_id=". $class_id;
					$condition2 = $condition2 . " and a.class_id=". $class_id;
				}
				else
				{
					$condition = $condition . "  and a.class_id=". $class_id. " and a.batch_id=". $section_id;
					$condition1 = $condition1 . "  and a.class_id=". $class_id. " and a.section_id=". $section_id;
					$condition2 = $condition2 . "  and a.class_id=". $class_id. " and a.section_id=". $section_id;
				}
			}
			else
			{
				$condition = $condition;
			}		
		
		
		$sql = "select a.admission_number,a.date_paid,a.receipt_number,sum(a.fee_amount) as fee_amount from view_fee_collection_details as a inner join tbl_fee_collection_master as b on b.fee_collection_master_id=a.fee_collection_master_id and b.branch_id=".$branch_id . $condition . "  group by a.receipt_number,a.date_paid,a.admission_number ";

		$query_result = $this->db->query($sql)->result_array(); 
		
		$sql1	=	"select a.student_id,a.date_paid,a.receipt_number,a.fee_head,a.fee_amount,a.student_name,a.class_name,a.section_name from view_special_fee_collection_master  as a " . $condition1 . " and a.branch_id=".$branch_id." order by a.receipt_number,a.date_paid,a.fee_head ";
		$query_result1 = $this->db->query($sql1)->result_array();

		/*------ transpotation fee----------------- */

		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
		$sql2 = "select a.student_id,a.date_paid,a.receipt_number,a.installment_name,SUM(a.amount_paid) AS amount_paid,a.student_name,a.class_name,a.section_name, b.academic_year from view_transport_students_bus_fee_collection_details  as a inner join tbl_transport_students_bus_fee_collection_master as b on b.bus_fee_collection_master_id=a.bus_fee_collection_master_id " . $condition2 . " and a.branch_id=".$branch_id." group by a.receipt_number order by a.receipt_number,a.date_paid,a.installment_name ";
		$query_result2 = $this->db->query($sql2)->result_array();
		}
		
		/////////////////////////////////

		$page_data['branch_id']        = $branch_id ;
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['department_id']    = $department_id;
		$page_data['section_name']     = $section_name;
		$page_data['title']            = "Fee Collection Abstract Report";
		$page_data['page_name']        = 'fee_collection_abstract_report1';
        $page_data['page_title']       = 'Fee Collection Report';
		$page_data['query_result']	   = $query_result;
		$page_data['query_result1']	   = $query_result1;
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
		$page_data['query_result2']	   = $query_result2;
		}
		$this->load->view('admin/fee_collection_abstract_report1', $page_data);
		}
		else
		{
		
		$condition = " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "'   and a.academic_year_id=".$year;
		$condition1 = " where is_deleted='N' and DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "'   and a.academic_year_id=".$year;
		$condition2 = " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and b.academic_year=".$year;
//		$condition3 = " where DATE_FORMAT(a.date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and a.paid_year_id=".$year." and a.is_deleted='N'";
		$condition3 = " DATE_FORMAT(date_paid,'%Y-%m-%d') between '" . $date_from . "' and '" . $date_to . "' and paid_year_id=".$year." and is_deleted='N'";
		
			if($role==15)
			{
				$condition = $condition . " and b.collected_by=". $this->session->userdata('login_user_id');
				$condition1 = $condition1 . " and a.entered_by=". $this->session->userdata('login_user_id');
				$condition2 = $condition2 . " and b.entered_by=". $this->session->userdata('login_user_id');
//				$condition3 = $condition3 . " and a.collected_by=". $this->session->userdata('login_user_id');
				$condition3 = $condition3 . " and collected_by=". $this->session->userdata('login_user_id');
			}
		if($department_id!='All')
		{
			if ($class_id=='ALL' && $section_id=='ALL')
			{
			$condition = $condition . " and b.department_id=". $department_id ;
			$condition1 = $condition1 . " and a.dept_id=". $department_id ;
			$condition2 = $condition2 . " and a.dept_id=". $department_id ;
//			$condition3 = $condition3 . " and a.dept_id=". $department_id ;
			$condition3 = $condition3 . " and dept_id=". $department_id ;
			}
			elseif ($class_id !='ALL' && $section_id=='ALL')
			{
			$condition = $condition . " and a.class_id=". $class_id;
			$condition1 = $condition1 . " and a.class_id=". $class_id;
			$condition2 = $condition2 . " and a.class_id=". $class_id;
//			$condition3 = $condition3 . " and a.class_id=". $class_id;
			$condition3 = $condition3 . " and class_id=". $class_id;
			}
			else
			{
			$condition = $condition . "  and a.class_id=". $class_id. " and a.batch_id=". $section_id;
			$condition1 = $condition1 . "  and a.class_id=". $class_id. " and a.section_id=". $section_id;
			$condition2 = $condition2 . "  and a.class_id=". $class_id. " and a.section_id=". $section_id;
//			$condition3 = $condition3 . "  and a.class_id=". $class_id. " and a.section_id=". $section_id;
			$condition3 = $condition3 . "  and class_id=". $class_id. " and section_id=". $section_id;
			}
		}
		else
		{
			$condition = $condition;
		}	
		
		if ($fee_head_id!='ALL')
		{
		    $condition = $condition . " and a.fee_head_id=". $fee_head_id;
		    $condition1 = $condition1 . " and a.fee_head_id=". $fee_head_id;
//		    $condition3 = $condition3 . " and a.fee_head_id=". $fee_head_id;
		    $condition3 = $condition3 . " and fee_head_id=". $fee_head_id;
		}
			$student_status = '(c.student_status_id=0 or c.student_status_id=1 or c.student_status_id=2 or c.student_status_id=3 or c.student_status_id=4 or c.student_status_id=5)';
		$sql = "select a.admission_number,a.date_paid,a.receipt_number,a.fee_head,sum(a.fee_amount) as fee_amount from view_fee_collection_details  as a inner join tbl_fee_collection_master as b on b.fee_collection_master_id=a.fee_collection_master_id and b.branch_id=".$branch_id ." inner join student c on c.student_id=b.admission_number and ".$student_status." ". $condition . " group by a.receipt_number,a.fee_head_id  order by a.receipt_number,a.date_paid,a.fee_head ";
	
		$query_result = $this->db->query($sql)->result_array();//echo $this->db->last_query();die;
		
		$year	=	get_running_year();
		$sql1	=	"select a.student_id,a.date_paid,a.receipt_number,a.fee_head,a.fee_amount,a.student_name,a.class_name,a.section_name from view_special_fee_collection_master  as a " . $condition1 . " and a.branch_id=".$branch_id." and academic_year_id = ".$year." order by a.receipt_number,a.date_paid,a.fee_head ";
		$query_result1 = $this->db->query($sql1)->result_array();
	
		/*------ transpotation fee----------------- */
	
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
		$sql2 = "select a.student_id,a.date_paid,a.receipt_number,a.installment_name,SUM(a.amount_paid) AS amount_paid,a.student_name,a.class_name,a.section_name, b.academic_year from view_transport_students_bus_fee_collection_details  as a inner join tbl_transport_students_bus_fee_collection_master as b on b.bus_fee_collection_master_id=a.bus_fee_collection_master_id inner join student c on c.student_id=b.student_id and ".$student_status." " . $condition2 . " and a.branch_id=".$branch_id." group by a.receipt_number order by a.receipt_number,a.date_paid,a.installment_name ";
		$query_result2 = $this->db->query($sql2)->result_array(); //echo $this->db->last_query();die;
		}

		/////////////////////////////////
            /*********** Opening balance start *******************/    
//                $sql3   =   "select a.student_id,a.date_paid,a.fee_from_year,a.admission_number,a.receipt_number,a.fee_head,a.amount_paid,a.student_name,a.class_name,a.section_name from view_opening_balance_collection a".$condition3."   order by a.receipt_number,a.date_paid,a.fee_head";
                
                $select     =   "student_id,date_paid,fee_from_year,admission_number,receipt_number,fee_head,amount_paid,student_name,class_name,section_name";
                $where      =   $condition3;
                $order_by   =   "receipt_number,date_paid,fee_head";
                
//                $query_result3 = $this->db->query($sql3)->result_array(); //echo $this->db->last_query();die;
                $query_result3 = $this->Fee_management_model->view_opening_balance_collection($select,$where,"",$order_by)->result_array(); //echo $this->db->last_query();die;
                //print_r($query_result3);die;
            /*********** Opening balance end *******************/    
		
		$page_data['branch_id']        = $branch_id ;
		$page_data['date_from']        = $date_from ;
		$page_data['date_to']          = $date_to;
		$page_data['department_id']    = $department_id;
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['section_name']     = $section_name;
		$page_data['title']            = "Fee Collection Report";
		$page_data['page_name']        = 'fee_collection_detailed_report1';
                $page_data['page_title']       = 'Fee Collection Report';
		$page_data['query_result']	   = $query_result;
		$page_data['query_result1']	   = $query_result1;
		$page_data['query_result3']	   = $query_result3;
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
		$page_data['query_result2']	   = $query_result2;
		}
		
		$this->load->view('admin/fee_collection_detailed_report1', $page_data);
		}
	}



public function fee_collection_detailed_report_excel()
	{	
		if (isset($_POST['chk_excel']))
		{
			$date_from		=	$this->input->post('date_from');
			$date_to		=	$this->input->post('date_to');
			$class_id		=	$this->input->post('class_id');
			$section_id		=	$this->input->post('section_id');
			$department_id	=	$this->input->post('department_id');
			$query_result	=	unserialize(base64_decode($this->input->post('result')));
			$query_result1	=	unserialize(base64_decode($this->input->post('result1')));
			$query_result3	=	unserialize(base64_decode($this->input->post('result3')));
			
			if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$query_result2	=	unserialize(base64_decode($this->input->post('result2')));
}
									ob_start();
									ob_get_clean();
									// set header
								$filename = "FeeCollectionReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
									$total = 0;
									$i=1;
						echo "<html>";
						echo  "<table border='1'><tr><td colspan='8' align='center'>Fee Collection Report</td></tr>";
						echo  "<tr><td colspan='8'  align='center'>From " .date('d-m-Y',strtotime( $date_from)) . " To " .date('d-m-Y',strtotime(  $date_to)). "</td></tr>";
						if($department_id!='All')
						{
								if ($class_id!="ALL")
								echo  "<tr><td colspan='8'>Class : " . get_class_name($class_id) . "</td></tr>";
							if ($section_id!="ALL")
								{
								echo  "<tr><td colspan='8'>Section/Batch : " .get_section_name($section_id) . "</td></tr>";
								}
							else
								{
								echo  "<tr><td colspan='8'>Section/Batch : All </td></tr>";
								}
						}
						else
						{
							echo  "<tr><td colspan='8'>Department : All </td></tr>";
						}
						
						echo  "<tr><td>Sl.No</td><td>Date Paid</td><td>Receipt No.</td><td>Name</td><td>Class</td><td>Section</td><td>Fee Item</td><td>Amount</td></tr>";
						
                                                if(count($query_result3)>0)
                                                {
                                                    echo "<tr><td style='text-align:center;' colspan='8'>Opening Balance</td></tr>";
                                                    foreach($query_result3 as $row)
                                                    {
                                                            $total =$total+$row['amount_paid'];
                                                            echo "<tr><td>$i</td><td>";
                                                            echo  date('d-m-Y', strtotime( $row['date_paid']));
                                                            echo " </td><td>" . $row['receipt_number'];
                                                            echo " </td><td>" . $row['student_name'];
                                                            echo " </td><td>" . $row['class_name'];
                                                            echo " - " . $row['section_name'];
                                                            echo " </td><td>".$row['admission_number']."</td><td>" . $row['fee_head']."(".$row['fee_from_year'].")";
                                                            echo "</td><td align='center'>". number_format($row['amount_paid'],2) . "</td></tr>";
                                                            $i=$i+1;
                                                    }
                                                }   
                                                if(count($query_result)>0)
                                                {
                                                    echo "<tr><td style='text-align:center;' colspan='8'>Regular Fee</td></tr>";
                                                    foreach ($query_result as $data)
                                                    {
                                                    $amount= $data['fee_amount'];
                                                    echo "<tr><td>". $i . "</td><td>" .date('d-m-Y',strtotime( $data['date_paid']));
                                                    echo "</td><td>" . $data['receipt_number']."</td><td>".get_student_name($data['admission_number']);
                                                    echo "</td><td>".get_student_class_name($data['admission_number']);
                                                    echo "</td><td>". get_student_section_name($data['admission_number'])."</td><td>".$data['fee_head']  ;
                                                    echo "</td><td>" . number_format( $amount,2) . "</td></tr>";
                                                    $i=$i+1;
                                                    $total = $total +  $data['fee_amount'];
                                                    }
                                                }
                                                if(count($query_result1)>0)
                                                {
                                                    echo "<tr><td style='text-align:center;' colspan='8'>Special Fee</td></tr>";
                                                    foreach ($query_result1 as $data)
                                                    {
                                                    $amount= $data['fee_amount'];
                                                    echo "<tr><td>". $i . "</td><td>" .date('d-m-Y',strtotime( $data['date_paid']));
                                                    echo "</td><td>" . $data['receipt_number']."</td><td>".$data['student_name'];
                                                    echo "</td><td>".$data['class_name'];
                                                    echo "</td><td>". $data['section_name']."</td><td>".$data['fee_head']  ;
                                                    echo "</td><td>" . number_format( $amount,2) . "</td></tr>";
                                                    $i=$i+1;
                                                    $total = $total +  $data['fee_amount'];
                                                    }
                                                }    
						
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
                                            if(count($query_result2)>0)
                                            {
                                                echo "<tr><td style='text-align:center;' colspan='8'>Transportation Fee</td></tr>";
						foreach ($query_result2 as $data)
						{
						$amount= $data['amount_paid'];
						echo "<tr><td>". $i . "</td><td>" .date('d-m-Y',strtotime( $data['date_paid']));
						echo "</td><td>" . $data['receipt_number']."</td><td>".$data['student_name'];
						echo "</td><td>".$data['class_name'];
						echo "</td><td>". $data['section_name']."</td><td>Bus Fee"  ;
						echo "</td><td>" . number_format( $amount,2) . "</td></tr>";
						$i=$i+1;
						$total = $total +  $data['amount_paid'];
						}
                                            }    
					}
						echo  "<tr><td colspan='7' align='right'><b>Total</b><td> <b>" . number_format($total,2) . "</b></td></tr></table>";
						echo "</body>";
						echo "</html>";	
							//	$this->exportExcelData($dataToExports);
								die();
			}
	}
    function fee_collection_detailed_report_pdf()
    {
		$data['date_from']		=	$this->input->post('date_from');
		$data['date_to']		=	$this->input->post('date_to');
		$data['class_id']		=	$this->input->post('class_id');
		$data['section_id']		=	$this->input->post('section_id');
		$data['department_id']	=	$this->input->post('department_id');
		$data['query_result']	=	unserialize(base64_decode($this->input->post('result')));
		$data['query_result1']	=	unserialize(base64_decode($this->input->post('result1')));
		$data['query_result3']	=	unserialize(base64_decode($this->input->post('result3')));
		
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
		$data['query_result2']	=	unserialize(base64_decode($this->input->post('result2')));
}

		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('admin/fee_collection_detailed_report_pdf',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php'); 
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true; 
        $mpdf->charset_in 					= 'UTF-8';
        $mpdf->WriteHTML($html);
		header('Content-Type: application/pdf');
        $mpdf->Output('fee_collection_detailed_report.pdf','D');	
    }

public function fee_collection_abstract_report_excel()
	{	
		if (isset($_POST['chk_excel']))
		{
			$date_from		=	$this->input->post('date_from');
			$date_to		=	$this->input->post('date_to');
			$class_id		=	$this->input->post('class_id');
			$section_id		=	$this->input->post('section_id');
			$department_id	=	$this->input->post('department_id');
			$query_result	=	unserialize(base64_decode($this->input->post('result')));
			$query_result1	=	unserialize(base64_decode($this->input->post('result1')));
			
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
{
			$query_result2	=	unserialize(base64_decode($this->input->post('result2')));
			
}									ob_start();
									ob_get_clean();
									$total = 0;
									$i=1;

//								   $dataToExports = [];
								$filename = "FeeCollectionReport.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								   echo  "\t\tFee Collection Report\n";
								   echo  "\t\tFrom " . date('d-m-Y',strtotime($date_from)) . " To " . date('d-m-Y',strtotime($date_to)). "\n";
								   if($department_id!='All')
									{
											  if ($class_id!="ALL") 
													{
													 echo  "\tClass  \t" . get_class_name($class_id ). "\n";
													}
												else
													{
													echo  "\tClass  \t All \n\n\n";	
													}	
											  
											  if ($section_id!="ALL") 
													{
													echo  "\tSection/Batch  \t" . get_section_name($section_id). "\n\n\n";
													}
												else
													{
													echo  "\tSection/Batch  \t All \n\n\n";	
													}	
									}
									else
									{
										echo  "\t Department  \t All \n";
									}
								foreach ($query_result as $data)
								{
									$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Date Paid'] 	= date('d-m-Y',strtotime($data['date_paid']));
									$arrangeData['Receipt No.'] = $data['receipt_number'];
									$arrangeData['Name']		= get_student_name($data['admission_number']);
									$arrangeData['Class']		= get_student_class_name($data['admission_number']);
									$arrangeData['Section']		= get_student_section_name($data['admission_number']);
									$arrangeData['Amount']		= number_format($data['fee_amount'],2);
									$total = $total +  $data['fee_amount'];
									$dataToExports[]			= $arrangeData;
									$i=$i+1;
								}
								foreach ($query_result1 as $data)
								{
									$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Date Paid'] 	= date('d-m-Y',strtotime($data['date_paid']));
									$arrangeData['Receipt No.'] = $data['receipt_number'];
									$arrangeData['Name']		= $data['student_name'];
									$arrangeData['Class']		= $data['class_name'];
									$arrangeData['Section']		= $data['section_name'];
									$arrangeData['Amount']		= number_format($data['fee_amount'],2);
									$total = $total +  $data['fee_amount'];
									$dataToExports[]			= $arrangeData;
									$i=$i+1;
								}
								
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
							{
								foreach ($query_result2 as $data)
								{
									$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Date Paid'] 	= date('d-m-Y',strtotime($data['date_paid']));
									$arrangeData['Receipt No.'] = $data['receipt_number'];
									$arrangeData['Name']		= $data['student_name'];
									$arrangeData['Class']		= $data['class_name'];
									$arrangeData['Section']		= $data['section_name'];
									$arrangeData['Amount']		= number_format($data['amount_paid'],2);
									$total = $total +  $data['amount_paid'];
									$dataToExports[]			= $arrangeData;
									$i=$i+1;
								}
							}
									$arrangeData['Sl.No'] 		= "";
									$arrangeData['Date Paid'] 	= "";
									$arrangeData['Name']		= "";
									$arrangeData['Receipt No.']	= "";
									$arrangeData['Class']		= "";
									$arrangeData['Section']		= "Total";
									
									$arrangeData['Amount']		=number_format( $total,2);
									$dataToExports[]			= $arrangeData;
								// set header
								$this->exportExcelData($dataToExports);
								die();
			}
	}
	
	function get_dept($branch_id)
	{
		$branch_option=$this->input->post('branch');
		$dept  = $this->db->get_where('tbl_department' , array('branch_id' => $branch_id,'is_deleted'=>'N'))->result_array();
		echo '<option value="">SELECT</option>';
		echo '<option value="All">All</option>';
		foreach ($dept as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
		}
	}
	
	
	
public function print_students_list()
{
		$page_data['page_name']  = 'print_students_list';
        $page_data['page_title'] = 'Students List';
		$this->load->view('admin/print_students_list', $page_data);
}
	
	public function print_students_list1()
	{
		$class_id        =$this->input->post('class_id');
		$section_id       =$this->input->post('section_id');
		$condition="";
		if ($class_id=='ALL' && $section_id=='ALL')
		{
		$condition = $condition ;
		}
		elseif ($class_id !='ALL' && $section_id=='ALL')
		$condition = " where  class_id=". $class_id;
		else
		$condition = " where  class_id=". $class_id. " and section_id=". $section_id;
		$sql = "select student_id from enroll " . $condition ;

		$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		if (isset($_POST['chk_excel']))
		{
									ob_start();
									ob_get_clean();
									$total = 0;
									$i=1;

//								   $dataToExports = [];
								   echo "\t\t\t\tStudents List\n";
								if ($class_id!='ALL')   echo  "\tClass  \t" . get_class_name($class_id). "\n";
							if ($section_id!='ALL')	echo  "\tSection/Batch  \t" . get_section_name($section_id ). "\n\n\n";
								foreach ($query_result as $data)
								{
								
								$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Roll No'] 		= get_student_roll($data['student_id']);
									$arrangeData['Name'] 		= get_student_name($data['student_id']);
                                    $arrangeData['Sex']      = get_student_sex($data['student_id']);
									$arrangeData['Phone1'] 		= get_student_phone1($data['student_id']);
									$arrangeData['Phone2'] 		= get_student_phone2($data['student_id']);
                                    $arrangeData['Address']      = get_student_address($data['student_id']);
                                    $arrangeData['Birthday']      = get_student_birthday($data['student_id']);

                                    $arrangeData['Email']      = get_student_email($data['student_id']);
									$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}
								$filename = "StudentsList.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								$this->exportExcelData($dataToExports);
			}

		/////////////////////////////////
		
		$page_data['class_id']         = $class_id ;
		$page_data['section_id']       = $section_id;
		$page_data['title']            = "Students List";
		$page_data['page_name']        = 'print_students_list1';
        $page_data['page_title']       = 'Students List';
		$page_data['query_result']	   = $query_result;
		$this->load->view('admin/print_students_list1', $page_data);
	}
	
	public function print_students_list2($class_id,$section_id)
	{
		
		$condition="";
		if ($class_id=='ALL' && $section_id=='ALL')
		{
		$condition = $condition ;
		}
		elseif ($class_id !='ALL' && $section_id=='ALL')
		$condition = " where  class_id=". $class_id;
		else
		$condition = " where  class_id=". $class_id. " and section_id=". $section_id;
		$sql = "select student_id from enroll " . $condition ." order by roll" ;

		$query_result = $this->db->query($sql)->result_array();
		
		
		////////////////////////////// Export to Excel
		
		if (isset($_POST['chk_excel']))
		{
									ob_start();
									ob_get_clean();
									$total = 0;
									$i=1;

//								   $dataToExports = [];
								   echo "\t\t\t\tStudents List\n";
								if ($class_id!='ALL')   echo  "\tClass  \t" . get_class_name($class_id). "\n";
							if ($section_id!='ALL')	echo  "\tSection/Batch  \t" . get_section_name($section_id ). "\n\n\n";
								foreach ($query_result as $data)
								{
								
								$arrangeData['Sl.No'] 		= $i;
									$arrangeData['Roll No'] 		= get_student_roll($data['student_id']);
									$arrangeData['Name'] 		= get_student_name($data['student_id']);
                                    $arrangeData['Sex']      = get_student_sex($data['student_id']);
									$arrangeData['Phone1'] 		= get_student_phone1($data['student_id']);
									$arrangeData['Phone2'] 		= get_student_phone2($data['student_id']);
                                    $arrangeData['Address']      = get_student_address($data['student_id']);
                                    $arrangeData['Birthday']      = get_student_birthday($data['student_id']);

                                    $arrangeData['Email']      = get_student_email($data['student_id']);
                                    $arrangeData['Admission_number']      = $this->db->get_where('student',array('student_id'=>$data['student_id']))->row()->admission_number;
									$dataToExports[]			= $arrangeData;
									$i=$i+1;
								
								}
								$filename = "StudentsList.xls";
								header("Content-Type: application/vnd.ms-excel");
								header("Content-Disposition: attachment; filename=".$filename);
								$this->exportExcelData($dataToExports);
		}

		/////////////////////////////////
		
		
	}
	
	

public function exportExcelData($records)
{
  $heading = false;
        if (!empty($records))
            foreach ($records as $row) {
                if (!$heading) {
                    // display field/column names as a first row
                    echo implode("\t", array_keys($row)) . "\n";
                    $heading = true;
                }
                echo implode("\t", ($row)) . "\n";
            }
 }



public function test_sms()
{
			$phone_number = "9446771675";
				$msg= "test message";
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
}	
function fee_plan_view() 
    {
	    $data['fee_master']= $this->Fee_management_model->get_fee_master();
		if($this->session->userdata('role')==7)
		{
		$this->load->view('office_staff/fee_master.php', $data);
		}
		$this->load->view('admin/fee_master.php', $data);
		
		
    }	
    function add_fee_head()
	{
	   $this->load->view('admin/add_fee_head');
	}
	
	function view_fee_head()
	{
	   $this->db->where('is_deleted','N');
	   $this->db->where('active','y');
	   $this->db->order_by('fee_category_name ASC,fee_head ASC');
	   $data['fees']=$this->db->get('view_fee_head')->result_array();
	   $this->load->view('admin/view_fee_head',$data);
	}
	function insert_fee_heads()
	{
	$data=array(
	'fee_head'=> $this->input->post('name'),
	'fee_category_id'=> $this->input->post('category')
	);
	$this->db->insert('tbl_fee_heads',$data);
    redirect('FeeManagement/view_fee_head');
	}
	
	function edit_fee_head($fee_head_id='')
	{
	   $page_data['fee_head_id']=$fee_head_id;
	   $this->db->where('fee_head_id',$fee_head_id);
	   $page_data['fee_head']=$this->db->get('tbl_fee_heads')->result_array();
	   $this->load->view('admin/edit_fee_head',$page_data);
	
	}
	
	
	function update_fee_head()
	{
	$data=array(
	'fee_head'=> $this->input->post('name'),
	'fee_category_id'=> $this->input->post('account')
	);
	$this->db->where('fee_head_id',$this->input->post('fee_head_id'));
	$this->db->update('tbl_fee_heads',$data);
    redirect('FeeManagement/view_fee_head');
	}
	
	function delete_fee_heads($fee_head_id='')
	{
	
	$data=array(
	'is_deleted'=>'Y'
		);
	$this->db->where('fee_head_id',$fee_head_id);
	$this->db->update('tbl_fee_heads',$data);
    redirect('FeeManagement/view_fee_head');
	}
	
	
function fee_due_report_sms($class_id='',$section_id='',$due_date='')
{
	
	$class_id		=	$this->input->post('class_id');
	$section_id		=	$this->input->post('section_id');
	$due_date		=	$this->input->post('due_date');
	$due_date_from	=	$this->input->post('due_date_from');
	$dept_id		=	$this->input->post('dept_id');
 
	$running_year=get_running_year();
	
	$sms = $this->db->get('sms_settings')->row();
	$sender_id = $sms->sender_id;
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	
		$ph='';
		$ph2='';
		$content="Your Payment of ";
		$user_id	= $this->session->userdata('login_user_id');
		$staff=$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
		$data['send_by']	=$staff;
		$data['content']	=  "Fees due Message";
		date_default_timezone_set("Asia/Kolkata");
		$data['send_date']	=  date('Y/m/d H:i:s');
		$this->db->insert('tbl_sms_delivery_master',$data);
		$master_id		=	$this->db->insert_id();
		if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
				 {
					$c= '1';
					}
					else
					{
					$c= '0';
					}
					if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
				 {
					$n= '1';
					}
					else
					{
					$n= '0';
					}
		
		/*$this->db->where('class_id',$class_id);
		$this->db->where('batch_id',$section_id);
		$this->db->where('due_date<=',$due_date);
			$this->db->where('fee_balance>',0);
		$result=$this->db->get('view_fee_due')->result_array();*/
		
		$ch_single		=	$this->input->post('check_single[]');
		$checked		=	$this->input->post('checked[]');
		$student_id		=	$this->input->post('student_id[]');
		$student_id1	=	$this->input->post('student_id1[]');
		$due_date2		=	$this->input->post('due_date1[]');
		$due_date3		=	$this->input->post('due_date2[]');
		$fee_balance	=	$this->input->post('fee_balance[]');
		$fee_balance1	=	$this->input->post('fee_balance1[]');
		$phone2			=	$this->input->post('phone2');
		//echo count($student_id)."-".count($student_id1);die;	
			//foreach($result as $b)
			for($i=0;$i<count($student_id);$i++)
			{
				if($checked[$i]==1)
				{
				$fee_bal = $fee_balance[$i];
/*				if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
				{
					$trans_fee = $this->Fee_management_model->get_transportation_fee($due_date,$due_date_from,$student_id[$i]);
					//print_r($trans_fee); die();
					if($trans_fee>0)
					{
						foreach($trans_fee as $row1){
						$fee_bal=$fee_bal+$row1['fee_amount'];
						}
					}
					else
					{
						$fee_bal = $fee_balance[$i];
					}
				}
			else
			{
				$fee_bal = $fee_balance[$i];
			}
*/			
					$content='Your Payment of RS '.$fee_bal.' is due on '.date('d-m-Y',strtotime($due_date2[$i])).' please pay immediately. Ignore this message if already paid';
					if($this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
					{
						$content='Your Payment of RS '.$fee_bal.' is due.Please pay immediately. Ignore this message if already paid';
					}
					
					$data1['sms_master_id']	=$master_id;
					
					$data1['student_id']	=$student_id[$i];
					
					$data1['class_id']	=get_student_class_id($student_id[$i]);
					$data1['section_id']	=get_student_section_id($student_id[$i]);
					$data1['phone']	=get_student_phone($student_id[$i]);
					date_default_timezone_set("Asia/Kolkata");
					$data1['send_date']	=  date('Y/m/d H:i:s');
					
					$data1['msg_content']	= $this->sms_helper($common,$c,$n,get_student_name($student_id[$i]),$content,$due_date);
					
					$this->db->insert('tbl_sms_delivery_details',$data1);
					if($phone2==1)
					{
						$data1['phone']	=get_student_phone2($student_id[$i]);
						if($data1['phone']!='')
						{
							$this->db->insert('tbl_sms_delivery_details',$data1);	
						}
					}

				}
			}
				if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{ 
			for($i=0;$i<count($student_id1);$i++)
			{
				if($checked[$i]==1)
				{
					$fee_bal = $fee_balance1[$i];
					$content='Your Bus Fee Payment of RS '.$fee_bal.' is due on '.date('d-m-Y',strtotime($due_date3[$i])).' please pay immediately .ignore this message if already paid';
					$data1['sms_master_id']	=$master_id;
					
					$data1['student_id']	=$student_id1[$i];
					
					$data1['class_id']	=$class_id;
					$data1['section_id']	=$section_id;
					$data1['phone']	=get_student_phone($student_id1[$i]);
					date_default_timezone_set("Asia/Kolkata");
					$data1['send_date']	=  date('Y/m/d H:i:s');
					
					$data1['msg_content']	= $this->sms_helper($common,$c,$n,get_student_name($student_id1[$i]),$content,$due_date);
					
					$this->db->insert('tbl_sms_delivery_details',$data1);
					if($phone2==1)
					{
						$data1['phone']	=get_student_phone2($student_id1[$i]);
						if($data1['phone']!='')
						{
							$this->db->insert('tbl_sms_delivery_details',$data1);	
						}
					}

				}
			}
		}
			
		$data['master_id']		=	$master_id;	
		$data['class_id']		=	$class_id;
		$data['section_id']		=	$section_id;
		$data['due_date']		=	$due_date;
		$data['due_date_from']	=	$due_date_from;
		$data['dept_id']		=	$dept_id;
		$this->load->view('admin/message_popup_due',$data);
	
}

function sms_helper($common_word,$c,$n,$name,$content)
	{
		if($c==1 && $n==1)
		$message = $common_word. ' Hi ' .$name.' ' .$content.'.';  
		if($c==1 && $n==0)
		$message = $common_word. ' Hi ' .$content.'.'; 
		if($c==0 && $n==1)
		$message = 'Hi ' .$name.' ' .$content.' '.$common_word.'.' ;  
		if($c==0 && $n==0)
		$message = 'Hi ' .$content.' '.$common_word.'.';
		
		return $message; 
		
	}
	
	function sms_send_popup_fee($master_id)
	{
	$content	=	$this->input->post('content[]');
	$details_id	=	$this->input->post('details_id[]');
	//print_r($content);die();
	for($i=0;$i<count($content);$i++)
	{
		$this->db->set('msg_content',$content[$i]);
		$this->db->where('sms_master_id',$master_id);	
		$this->db->where('details_id',$details_id[$i]);	
		$this->db->update('tbl_sms_delivery_details');// echo $this->db->last_query();die();
	}
	
	$this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
	$this->db->from('tbl_sms_delivery_details a');
	$this->db->where('sms_master_id',$master_id);
	$a=$this->db->get()->result_array();
$i=0;
$sms = $this->db->get('sms_settings')->row();
	 $sender_id = $sms->sender_id;
	
	$username = $sms->username;
	$password = $sms->password;
	$common = $sms->common_word;
	$url = $sms->url;
	//$reciever = $ph;
	$web_url=$sms->web_url;
	
	foreach($a as $b)
	
	{
	$ph=$b['ph'];
	$message= $b['msg_content'];
	
	//if($b['processed']==0 || $b['processed']==1)
	if($b['processed']==0)
	{
	$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
	$api = $url;
	$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
	$balance = stream_get_contents($handle);
	if ($balance >= 0) {
	
	$api . "/sendsms?" . $location;
	$send = fopen($api . "/sendsms?" . $location, "r");
	$api . "/sendsms?" . $location;
	
	$return_message_ids = stream_get_contents($send);
	$message_id_array = explode(",", $return_message_ids);
	$str = filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
	$sms_data['msg_code']	=	$str;
	$sms_data['processed']	=	1;
	$this->db->where('details_id',$b['details_id']);
	$this->db->update('tbl_sms_delivery_details',$sms_data);
	$i++;
	//}
	}
	
	}
	else{?>
	<script>alert("No Message Send ")</script>
	<?php }
	}
	
	
	
	 redirect(base_url() . 'index.php/FeeManagement/fee_due_report' , 'refresh');
	
	
	
	
	}
	
	function get_total_inst_amount($fee_master_id='')
	{
		$amount	=	0;
		$amount	=	$this->Fee_management_model->get_total_inst_amount($fee_master_id);
/*		foreach($query as $row)
		{
			$amount	=	$amount+$row['fee_total'];
		}
*/		echo $amount;
	}
	
	function check_fee_master_assigned($fee_master_id='')
	{
		$query	=	$this->Fee_management_model->check_fee_master_assigned($fee_master_id);
		if(count($query)>0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

/**************Special Fee Start***************************/
	function view_special_fee()
	{
		$role	=	$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branch']			=	$this->Fee_management_model->get_branch();
		}
		if($role==3)
		{
			$branch_id				=	$this->session->userdata('branch_id');
			$data['dept']			=	$this->Fee_management_model->get_department($branch_id);
		}
		if($role>=4)
		{
			$branch_id				=	$this->session->userdata('branch_id');
			$department_id			=	$this->session->userdata('dept_id');
			$academic_year_id		=	get_running_year();
			$data['class']			=	$this->Fee_management_model->get_class_by_branch($branch_id,$department_id,$academic_year_id);
		}

		$this->load->view('admin/special_fee_pay.php', $data);
	}
	function special_fee_students($class_id='',$section_id='',$branch_id='')
	{
	
		$data['students']			=	$this->Fee_management_model->special_fee_students($class_id,$section_id);
		$data['class_id']			=	$class_id;
		$data['section_id']			=	$section_id;
		$data['branch_id']			=	$branch_id;
		$data['special_fee_heads']	= 	$this->Fee_management_model->get_special_fee_heads();
		$this->load->view('admin/special_fee_students.php',$data);
	}
	function special_fee_payment()
	{
		$branch_id					=	$this->input->post('branch_id');
		$class_id					=	$this->input->post('class_id');
		$section_id					=	$this->input->post('section_id');
		$academic_year_id			=	$this->input->post('academic_year_id');
		$date_paid					=	date('Y-m-d',strtotime($this->input->post('date_paid')));
		$fee_head_id				=	$this->input->post('fee_head_id');
		$fee_amount					=	$this->input->post('fee_amount');
		$description				=	$this->input->post('description');
		
		$student_id					=	$this->input->post('student_id[]');
		//$receipt_number				=	$this->input->post('receipt_number[]');
		$checkbox					=	$this->input->post('single_student[]');
		
		$ticked_count				=	count($checkbox);
		if(isset($_POST['chk_send_sms']))
		{
			$running_year		=	$academic_year_id;
			
			$sms 				= 	$this->db->get('sms_settings')->row();
			$sender_id 			= 	$sms->sender_id;
			$username 			= 	$sms->username;
			$password 			= 	$sms->password;
			$common 			= 	$sms->common_word;
			$url 				= 	$sms->url;
			$web_url			=	$sms->web_url;
			
			$ph='';
			$ph2='';
			$class 				=	$class_id;
			$section 			= 	$section_id;
			$content 			= 	"Special fee payment";
			$user_id			= 	$this->session->userdata('login_user_id');
			$staff				=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
			$data['send_by']	=	$staff;
			$data['content']	=  	$content;
			date_default_timezone_set("Asia/Kolkata");
			$data['send_date']	=  	date('Y/m/d h:i:s');
			$this->db->insert('tbl_sms_delivery_master',$data);
			$master_id			=	$this->db->insert_id();
			
			if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
			{
				$c= '1';
			}
			else
			{
				$c= '0';
			}
			if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
			{
				$n= '1';
			}
			else
			{
				$n= '0';
			}
		   
		}
		for($i=0;$i < $ticked_count;$i++)
		{
			$checked_row_num			=	$checkbox[$i]-1;	//$checked_row_num will have the position number of checked row.That is $i'th element is checked.
			$rec_num                                =       get_receipt_number("Receipt",$branch_id)+1;
                        $data						=	array(
												'fee_head_id'		=>	$fee_head_id,	
												'fee_amount'		=>	$fee_amount,	
												'description'		=>	$description,	
												'receipt_number'	=>	$rec_num,	
												'date_paid'			=>	$date_paid,	
												'student_id'		=>	$student_id[$checked_row_num],	
												'class_id'			=>	$class_id,	
												'section_id'		=>	$section_id,	
												'branch_id'			=>	$branch_id,	
												'academic_year_id'	=>	$academic_year_id,	
												);
			$result						=	$this->Fee_management_model->special_fee_payment($data);
			$affected_rows				=	$result['affected_rows'];
			$last_insert_id				=	$result['last_insert_id'];
			//Update receipt number(tbl_voucher)
		$receipt					=	$this->Fee_management_model->update_receipt($last_insert_id,$branch_id);


			if(isset($_POST['chk_send_sms']))
			{
				$data1['sms_master_id']	=	$master_id;
				$data1['student_id']	=	$student_id[$checked_row_num];
				$data1['class_id']		=	$class;
				$data1['section_id']	=	$section;
				$data1['phone']			=	get_student_phone($student_id[$checked_row_num]);
				//$this->sms_helper($common,$c,$b['name'],$n,$content);
				$content				=	"Your special fee payment of Rs.".$fee_amount." is received and your receipt number is ".$data['receipt_number'];
				$data1['msg_content']	= 	$this->sms_helper($common,$c,$n,get_student_name($student_id[$checked_row_num]),$content);
				date_default_timezone_set("Asia/Kolkata");
				$data1['send_date']		=  	date('Y/m/d h:i:s');
				$this->db->insert('tbl_sms_delivery_details',$data1);
			}


		}	
		
		if($affected_rows>0)
		{
			$action	=	"Inserted";
		}
		else
		{
			$action	=	"Not_Inserted";
		}
		$this->session->set_flashdata('action',$action);
		if(isset($_POST['chk_send_sms']))
		{
			$data['master_id']	=	$master_id;	
			$data['class_id']	=	$class;
			$data['section_id']	=	$section;
			$this->load->view('admin/special_fee_message_popup',$data);
		}
		
		else
		{
		//redirect('FeeManagement/reprint_special_fee_receipt1');
							$date_from        	= 	date("Y-m-d", strtotime($this->input->post('date_from')));
							$date_to          	=	date("Y-m-d", strtotime($this->input->post('date_to')));

						$class_id        	=	$this->input->post('class_id');
						$section_id       	=	$this->input->post('section_id');
						//$department_id		=	$this->input->post('department');
						$role=$this->session->userdata('role');
						if($role==1 || $role==2)
						{
							$branch_id	=	$this->input->post('branch');
						}
						else
						{
							$branch_id	=	$this->session->userdata('branch_id');	
						}
						
							$condition = " where is_deleted='N' and date_paid between '" . $date_from . "' and '" . $date_to . "' ";
							$condition = $condition . "  and class_id=". $class_id. " and section_id=". $section_id;
						
						$sql = "select student_id,student_name,class_name,section_name,date_paid,receipt_number,fee_head,fee_amount from view_special_fee_collection_master " . $condition . " and branch_id=".$branch_id." and academic_year_id=".$academic_year_id." order by receipt_number,date_paid,fee_head ";
					
						$query_result = $this->db->query($sql)->result_array();//echo $this->db->last_query();die();
						
						$page_data['branch_id']        = $branch_id ;
						$page_data['date_from']        = $date_from ;
						$page_data['date_to']          = $date_to;
						//$page_data['department_id']    = $department_id;
						$page_data['class_id']         = $class_id ;
						$page_data['section_id']       = $section_id;
						$page_data['query_result']	   = $query_result;
						$this->load->view('admin/reprint_special_fee_receipt1', $page_data);
			//redirect('FeeManagement/reprint_special_fee_receipt1');
		}
	}


	function check_paid($academic_year_id='',$branch_id='',$fee_head_id='',$student_id='')
	{
		$data		=	array(
							'academic_year_id'	=>	$academic_year_id,
							'branch_id'			=>	$branch_id,
							'fee_head_id'		=>	$fee_head_id,
							'student_id'		=>	$student_id
							);
		$query		=	$this->Fee_management_model->check_paid($data);
		if(count($query)>0)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}
	function special_fee_report()
	{
		$role	=	$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			$data['branches']		=	$this->Fee_management_model->get_branch();
		}
		if($role==3)
		{
			$branch_id				=	$this->session->userdata('branch_id');
			$data['dept']			=	$this->Fee_management_model->get_department($branch_id);
		}
		if($role>=4)
		{
			$branch_id				=	$this->session->userdata('branch_id');
			$department_id			=	$this->session->userdata('dept_id');
			$academic_year_id		=	get_running_year();
			$data['class']			=	$this->Fee_management_model->get_class_by_branch($branch_id,$department_id,$academic_year_id);
		}
		$data['special_fee_heads']	= 	$this->Fee_management_model->get_special_fee_heads();
		$this->load->view('admin/special_fee_report',$data);
	}
	function get_class_by_branch($branch_id='')
	{
		$academic_year_id			=	get_running_year();
		$department_id				=	'';
		$class						=	$this->Fee_management_model->get_class_by_branch($branch_id,$department_id,$academic_year_id);
		echo "<option value=''>Select</option>";
		foreach($class as $classes)
		{
			echo "<option value=".$classes['class_id'].">".$classes['name']."(".$classes['dept_name'].")"."</option>";
		}
	}
	function show_report()
	{
		$ids					=	$_POST['ids'];//echo $ids['department_id'];die();
		$data['branch_id']		=	$ids['branch_id'];		
		$data['department_id']	=	$ids['department_id'];		
		$data['class_id']		=	$ids['class_id'];		
		$data['section_id']		=	$ids['section_id'];		
		$data['fee_head_id']	=	$ids['fee_head_id'];		
		$data['report']			=	$this->Fee_management_model->get_special_fee_report($ids);
		
		if($data['branch_id']!='')
		{
			$query					=	"SELECT branch_name FROM tbl_branch WHERE branch_id='".$data['branch_id']."'";
			$branch					=	$this->Fee_management_model->get_name_by_id($query);
			$data['branch_name']	=	$branch->branch_name;
		}
		if($data['department_id']!='')
		{
			$query					=	"SELECT dept_name FROM tbl_department WHERE dept_id='".$data['department_id']."'";
			$department				=	$this->Fee_management_model->get_name_by_id($query);
			$data['department_name']=	$department->dept_name;
		}
		if($data['fee_head_id']!='')
		{
			$query					=	"SELECT fee_head FROM tbl_fee_heads WHERE fee_head_id='".$data['fee_head_id']."'";
			$fee_head				=	$this->Fee_management_model->get_name_by_id($query);
			$data['fee_item']		=	$fee_head->fee_head;
		}
		
		$this->load->view('admin/special_fee_report1',$data);
	}
	function special_fee_report_pdf()
	{
		$data['role']			=	$this->session->userdata('role');
		$data['branch_id']		=	$this->input->post('branch_id');	
		$data['department_id']	=	$this->input->post('department_id');
		$data['class_id']		=	$this->input->post('class_id');	
		$data['section_id']		=	$this->input->post('section_id');	
		$data['fee_head_id']	=	$this->input->post('fee_head_id');		
		$data['report']			=	$this->Fee_management_model->get_special_fee_report($data);
		
		if($data['branch_id']!='')
		{
			$query					=	"SELECT branch_name FROM tbl_branch WHERE branch_id='".$data['branch_id']."'";
			$branch					=	$this->Fee_management_model->get_name_by_id($query);
			$data['branch_name']	=	$branch->branch_name;
		}
		if($data['department_id']!='')
		{
			$query					=	"SELECT dept_name FROM tbl_department WHERE dept_id='".$data['department_id']."'";
			$department				=	$this->Fee_management_model->get_name_by_id($query);
			$data['department_name']=	$department->dept_name;
		}
		if($data['fee_head_id']!='')
		{
			$query					=	"SELECT fee_head FROM tbl_fee_heads WHERE fee_head_id='".$data['fee_head_id']."'";
			$fee_head				=	$this->Fee_management_model->get_name_by_id($query);
			$data['fee_item']		=	$fee_head->fee_head;
		}
		ob_start();
		$html 								=	ob_get_clean();
		$html 								= 	utf8_encode($html);
		$html								=	$this->load->view('admin/special_fee_pdf_report',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
        $mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
        $mpdf->allow_charset_conversion 	= true;
        $mpdf->charset_in 					= 'UTF-8';
        $mpdf->WriteHTML($html);
		header('Content-Type: application/pdf');
        $mpdf->Output('Special_Fee_Report.pdf','D');	

	}
/**************Special Fee End*****************************/
/**************New Fee Start*******************************/
/*
 *Created By Mani, Started on 09-11-2018 12.52
 */ 
	function new_fee_head($para1='',$para2='')
	{
		if($para1 == 'view')
		{
			$data['fee_head']		=	$this->Fee_management_model->new_fee_head($para1);
			$this->load->view('new_fee/fee_head_view',$data);
		}
		if($para1 == 'add')
		{
			$data['result']			=	$this->Fee_management_model->new_fee_head($para1);
			$this->load->view('new_fee/fee_head_add',$data);
		}
		if($para1 == 'insert')
		{
		    $fee_head_name          =   $this->input->post('fee_head_name[]');
		    for($i=0;$i<count($fee_head_name);$i++)
		    {
    			$data['branch_id']		=	$this->input->post('branch_id');	
    			$data['department_id']	=	$this->input->post('dept_id');	
    			$data['fee_head_name']	=	$fee_head_name[$i];	
    			$result					=	$this->Fee_management_model->new_fee_head($para1,$data);
    			$result>0?$action = "inserted":$action = "not_inserted";
		    }	
			$this->session->set_flashdata('action',$action);
			redirect('FeeManagement/new_fee_head/add');
		}	
		if($para1 == 'edit')
		{
			$data['fee_head']		=	$this->Fee_management_model->new_fee_head($para1,$para2);
			$this->load->view('new_fee/fee_head_edit',$data);
		}
		if($para1 == 'update')
		{
			$data['fee_head_id']	=	$this->input->post('fee_head_id');	
			$data['fee_head_name']	=	$this->input->post('fee_head_name');	
			$result					=	$this->Fee_management_model->new_fee_head($para1,$data);
			$result>0?$action = "updated":$action = "not_updated";
			$this->session->set_flashdata('action',$action);
			redirect('FeeManagement/new_fee_head/edit/'.$data['fee_head_id']);
		}
		if($para1 == 'delete')
		{
			$result					=	$this->Fee_management_model->new_fee_head($para1,$para2);
			$result>0?$action = "deleted":$action = "not_deleted";
			$this->session->set_flashdata('action',$action);
			redirect('FeeManagement/new_fee_head/view');
		}
	}
	function get_department($branch_id)
	{
		$dept  = $this->Fee_management_model->get_department($branch_id);
		echo '<option value="">Select Department</option>';
		foreach ($dept as $row) 
		{
			echo '<option value="' . $row['dept_id'] . '">' . $row['dept_name'] . '</option>';
		}
	}
	function assign_fee($para1='',$para2='')
	{
		/*
		 * Mani, 28-11-2018 12:46 
		 */ 
		if($para1 == 'view')
		{
			$data['role_data']	=	$this->get_role_datas();
			$this->load->view('new_fee/assign_fee',$data);
		}
		if($para1 == 'add')
		{
		
		}
		if($para1 == 'insert_for_all')
		{
		    //Assign fee structure to all students in a section(only if fee structure is not assigned)
			$branch_id		=	$_POST['branch_id'];
			$dept_id		=	$_POST['dept_id'];
			$class_id		=	$_POST['class_id'];
			$section_id		=	$_POST['section_id'];
			$student_id		=	$_POST['student_id'];
			
			$installments	=	$_POST['installments'];
			$due_date		=	$_POST['due_date'];
			$amount_array	=	$_POST['amount_array'];
			$fee_head_arr	=	$_POST['fee_head_arr'];
			$count			=	count($installments);
			$students		=	$this->Fee_management_model->get_students_having_no_fee_structure($class_id,$section_id);
			
			$this->db->trans_start();
			foreach($students as $stud):
				for($i=0;$i<$count;$i++)
				{ 
					$amount_to_pay						=	0;
					$data['student_id']					=	$stud['student_id'];
					$data['class_id']					=	$class_id;
					$data['department_id']				=	$dept_id;
					$data['branch_id']					=	$branch_id;
					
					$data['installment_no']				=	$installments[$i]['value'];
					$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]['value']));
					$data['created_by']					=	$this->session->userdata('login_user_id');
					$data['created_date']				=	date('Y-m-d');
					$data['year_id']					=	get_running_year();
					$students_fee_master_id				=	$this->Fee_management_model->assign_fee('insert',$data);
					
					for($j=0;$j<count($fee_head_arr[$i]);$j++) 
					{ 
					
						$data1['students_fee_master_id']=	$students_fee_master_id;		
						$data1['fee_head_id']			=	$fee_head_arr[$i][$j];		
						$data1['amount_to_pay']			=	$amount_array[$i][$j];		
						$data1['amount_balance']		=	$amount_array[$i][$j];
						$students_fee_details_id		=	$this->Fee_management_model->assign_fee('insert2',$data1);	
						$amount_to_pay					=	$amount_to_pay+$amount_array[$i][$j];
					}
					$data2['amount_to_pay']				=	$amount_to_pay;
					$data2['amount_balance']			=	$amount_to_pay;
					$affected_rows						=	$this->Fee_management_model->assign_fee('master_update',$data2,$students_fee_master_id);
				}
			endforeach;
			
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				$data['action']	=	"failed";
			}
			else
			{
				$data['action']	=	"success";
			}
			$this->load->view('new_fee/print_message',$data);
		}
		if($para1 == 'insert')
		{
		    //Assign fee structure to the selected student in a section
			$branch_id		=	$_POST['branch_id'];
			$dept_id		=	$_POST['dept_id'];
			$class_id		=	$_POST['class_id'];
			$section_id		=	$_POST['section_id'];
			$student_id		=	$_POST['student_id'];
			
			$installments	=	$_POST['installments'];
			$due_date		=	$_POST['due_date'];
			$amount_array	=	$_POST['amount_array'];
			$fee_head_arr	=	$_POST['fee_head_arr'];
			$count			=	count($installments);
			//$divid			=	count($fee_head_id)/$count;
			
			//$fee_head_array	=	array_chunk($fee_head_id,$divid,true);
			//$amount_array	=	array_chunk($amount,$divid,true);
			//echo count($fee_head_array[0]);die();
			/*echo "<pre>";
			print_r($amount_array);
			echo "</pre>";die();*/
			
			
			$this->db->trans_start();
			for($i=0;$i<$count;$i++)
			{ 
				$amount_to_pay						=	0;
				$data['student_id']					=	$student_id;
				$data['class_id']					=	$class_id;
				$data['department_id']				=	$dept_id;
				$data['branch_id']					=	$branch_id;
				
				$data['installment_no']				=	$installments[$i]['value'];
				$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]['value']));
				$data['created_by']					=	$this->session->userdata('login_user_id');
				$data['created_date']				=	date('Y-m-d');
				$data['year_id']					=	get_running_year();
				$students_fee_master_id				=	$this->Fee_management_model->assign_fee($para1,$data);
			  	
				for($j=0;$j<count($fee_head_arr[$i]);$j++) 
				{
				
					$data1['students_fee_master_id']=	$students_fee_master_id;		
					$data1['fee_head_id']			=	$fee_head_arr[$i][$j];		
					$data1['amount_to_pay']			=	$amount_array[$i][$j];		
					$data1['amount_balance']		=	$amount_array[$i][$j];
					$students_fee_details_id		=	$this->Fee_management_model->assign_fee('insert2',$data1);	
					$amount_to_pay					=	$amount_to_pay+$amount_array[$i][$j];
				}
				$data2['amount_to_pay']				=	$amount_to_pay;
				$data2['amount_balance']			=	$amount_to_pay;
				$affected_rows						=	$this->Fee_management_model->assign_fee('master_update',$data2,$students_fee_master_id);
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				$data['action']	=	"failed";
			}
			else
			{
				$data['action']	=	"success";
			}
			$this->load->view('new_fee/print_message',$data);
			
		}	
		if($para1 == 'edit')
		{
		
		}
		if($para1 == 'update')
		{
		
		}
		if($para1 == 'delete')
		{
		
		}
	}
	function pay_fee($para1='',$para2='')
	{
		/*
		 * Mani, 30-11-2018 10:25 
		 */ 
		if($para1 == 'view')
		{
			$data['role_data']	=	$this->get_role_datas();
			$this->load->view('new_fee/pay_fee',$data);
		}
		if($para1 == 'add')
		{
		
		}
		if($para1 == 'insert')
		{
			$receipt_number 	= 	$this->input->post('txtreceipt_number');
			$branch_id			=	$this->input->post('branch_id');
			
			$year				=	get_running_year();
			$this->db->trans_start();
			$this->db->db_debug = FALSE;
			$data 				=	array('voucher_number' => $receipt_number );
			$this->db->where('voucher_type_name', "Receipt");
			$this->db->where('branch_id', $branch_id);
			$this->db->where('academic_year_id', $year);
			$this->db->update('tbl_voucher', $data); 
		
		
			$installments 		= 	$this->input->post('balance_check[]');
			$fee_items 			= 	$this->input->post('fee_head_balance_check[]');

			$inst_count 		= 	count($installments);
			$item_count 		= 	count($fee_items);

			$late_fee			=	$this->input->post('late_fee');
			$receipt_number		=	$this->input->post('txtreceipt_number');	//get_receipt_number("Receipt");
			$payment_mode		=	$this->input->post('lstpayment_mode');
		
			$dept_id			=	$this->input->post('dept_id');
			$class_id			=	$this->input->post('class_id');
			$section_id			=	$this->input->post('section_id');
			$student_id			=	$this->input->post('student_id');
			$var 				= 	$this->input->post('txtdate_paid');
			$date 				= 	str_replace('/', '-', $var);
			$date_paid 			=  	date('Y-m-d', strtotime($date));
			$academic_year_id	=	get_running_year();
		//Send SMS start	
			if(isset($_POST['chk_send_sms']))
			{
				$amount			=	$this->input->post('amount');
				$phone_number 	= 	get_student_phone($student_id);
				$msg= "Dear Student, Your fee Rs. " . $amount	. " is received on " . date('d/m/Y',strtotime($date_paid)) . " and the Receipt No. is " . $receipt_number;
				
				$sms 			= 	$this->db->get('sms_settings')->row();
				$sender_id 		= 	$sms->sender_id;
				$username 		= 	$sms->username;
				$password 		= 	$sms->password;
				$common 		= 	$sms->common_word;
				$url 			= 	$sms->url;
				$location 		= 	'uname='.urlencode($username).'&pwd='.urlencode($password).'&senderid='.urlencode($sender_id).'&to='.urlencode($phone_number).'&msg=' .urlencode($msg." ").'&route=T';
				$api 			= 	$url;
				$handle 		= 	fopen($api."/creditsleft/".$username."/".$password."/T", "r");
				$balance 		= 	stream_get_contents($handle);
				if($balance >= 0)
				{
					$api."/sendsms?".$location;
					$send = fopen($api."/sendsms?".$location,"r");
					$return_message_ids = stream_get_contents($send);
					$message_id_array = explode($return_message_ids,''); 
				}
			}
		//Send SMS end	
			if($inst_count>0)
			{
				$students_fee_master_id		=		$this->input->post('students_fee_master_id');
				$check_uncheck				=		$this->input->post('check_uncheck');
				$check_balance				=		$this->input->post('check_balance');
				$amount						=		$this->input->post('amount')- $this->input->post('late_fee');
				$count						=		count($check_balance);
			
				for($i=0;$i<$count;$i++)
				{ 
					if($check_uncheck[$i]==1) 
					{	//echo $amount."<br>".$check_balance[$i];die();
						if($amount >=$check_balance[$i])
						{
						// insert into collection master
							$data4['date_paid']				=	$date_paid;
							$data4['receipt_number']		=	$receipt_number;
							$data4['students_fee_master_id']=	$students_fee_master_id[$i];
							$data4['student_id']			=	$student_id;
							$data4['branch_id']				= 	$branch_id;
							$data4['department_id']			= 	$dept_id;
							$data4['class_id']				= 	$class_id;
							$data4['section_id']			=	$section_id;
							$data4['academic_year_id']		=	$academic_year_id;
							$data4['payment_mode']			=	$payment_mode;
							
							$data4['amount_paid']			=	$amount;
							//$data4['late_fee']				=	$this->input->post('late_fee');
							$data4['created_by']			=	$this->session->userdata('login_user_id');
							$data4['created_date']			=	date('Y-m-d');
							
							$this->db->insert('tbl_fee_2_students_fee_collection_master', $data4);
							$master_id						= 	$this->db->insert_id();
							//$data1['amount_to_pay']			= 	0;
							$data1['amount_balance']		= 	0;
							$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
							$this->db->update('tbl_fee_2_students_fee_master', $data1);
			
							//insert into collection details
							$collection						=	$this->db->query('SELECT fee_head_id, amount_balance FROM tbl_fee_2_students_fee_details WHERE students_fee_master_id ='.$students_fee_master_id[$i])->result_array();

							foreach( $collection as $col)
							{
								$data5['students_fee_collection_master_id']	=	$master_id;
								$data5['fee_head_id']						=	$col['fee_head_id'];
								$data5['amount_paid']						=	$col['amount_balance'];
								if($col['amount_balance']>0)
									$this->db->insert('tbl_fee_2_students_fee_collection_details', $data5);
							}
							$data1['amount_balance']			=	0;
							$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
							$this->db->update('tbl_fee_2_students_fee_details', $data1);
							$amount							=	$amount-$check_balance[$i];
						}
						else
						{
							$data4['date_paid']					=	$date_paid;
							$data4['receipt_number']			=	$receipt_number;
							$data4['students_fee_master_id']	=	$students_fee_master_id[$i];
							$data4['student_id']				=	$student_id;
							$data4['branch_id']					=	$branch_id;
							$data4['department_id']				= 	$dept_id;
							$data4['class_id']					=	$class_id;
							$data4['section_id']				=	$section_id;
							$data4['academic_year_id']			=	$academic_year_id;
							$data4['payment_mode']				=	$payment_mode;

							$data4['amount_paid']				=	$amount;
							//$data4['late_fee']					=	$this->input->post('late_fee');
							$data4['created_by']				=	$this->session->userdata('login_user_id');
							$data4['created_date']				=	date('Y-m-d');

							$this->db->insert('tbl_fee_2_students_fee_collection_master', $data4);
							
							$master_id							= 	$this->db->insert_id();
							$data2['amount_balance']			=	$check_balance[$i]-$amount;
							
							$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
							$this->db->update('tbl_fee_2_students_fee_master', $data2);
							
							$this->db->select('students_fee_details_id,amount_to_pay,amount_balance');
							$this->db->from('tbl_fee_2_students_fee_details');
							$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
							$row								=	$this->db->get()->result_array();
							$d_amount							=	$amount;
							foreach($row as $result)
							{
								if ($d_amount<=0) break;
								if($d_amount >=$result['amount_balance'])
								{
									$collection= $this->db->query('SELECT fee_head_id, amount_balance FROM tbl_fee_2_students_fee_details WHERE   amount_balance>0  AND  students_fee_details_id='.$result['students_fee_details_id'])->result_array();
									foreach( $collection as $col)
									{
										$data5['students_fee_collection_master_id']		=	$master_id;
										$data5['fee_head_id']							=	$col['fee_head_id'];
										$data5['amount_paid']							=	$result['amount_balance'];
										
										if($result['amount_balance']>0)
											$this->db->insert('tbl_fee_2_students_fee_collection_details', $data5);
									}
									$data3['amount_balance']					=	0;
									$d_amount								=	$d_amount- $result['amount_balance'];
									$this->db->where('students_fee_details_id',$result['students_fee_details_id']);
									$this->db->update('tbl_fee_2_students_fee_details', $data3);
								}
								else
								{
									$collection= $this->db->query('SELECT fee_head_id, amount_balance FROM tbl_fee_2_students_fee_details WHERE  amount_balance>0  AND students_fee_details_id='.$result['students_fee_details_id'] )->result_array();
									foreach( $collection as $col)
									{
										$data5['students_fee_collection_master_id']		=	$master_id;
										$data5['fee_head_id']							=	$col['fee_head_id'];
										$data5['amount_paid']							=	$d_amount;
										
										if($result['amount_balance']>0)
											$this->db->insert('tbl_fee_2_students_fee_collection_details', $data5);
									}
								
									$data3['amount_balance']		= 		$result['amount_balance']-$d_amount;
									$d_amount					=		$d_amount- $result['amount_balance'];
									$this->db->where('students_fee_details_id',$result['students_fee_details_id']);
									$this->db->update('tbl_fee_2_students_fee_details', $data3);
								}
			
							}
							break;
						}
	
					}
				}

			} // if installment count >0
			
			else if ( $item_count >0)
			{
				$fee_items_details_id 	= 	$this->input->post('student_fee_details_id[]');
				$fee_master_id 			= 	$this->input->post('student_fee_master_id[]');
				$fee_heads 				=	$this->input->post('head_id[]');
				$fee_amount				= 	$this->input->post('item_balance[]');
				$checked_items 			= 	$this->input->post('item_check[]');
				
				$items_count 			= 	count($fee_items_details_id);
				$master_count			= 	count($fee_master_id );
				$amount					=	$this->input->post('amount')- $this->input->post('late_fee');
			
				$prev_master_id= 0;
				$curr_master_id= 0;
				for($i=0;$i<$items_count;$i++) 
				{
					if ($checked_items [$i]>0)
					{
						$curr_master_id			= 	$fee_master_id[$i];
						
						$fee_items_details_id 	= 	$this->input->post('student_fee_details_id[]');
						$fee_master_id 			= 	$this->input->post('student_fee_master_id[]');
						$fee_heads 				=	$this->input->post('head_id[]');
						$fee_amount				= 	$this->input->post('item_balance[]');
						$checked_items 			= 	$this->input->post('item_check[]');
	
	
	
						if($amount >$fee_amount[$i])
						{
							// insert into collection master
							$data4['date_paid']					=	$date_paid;
							$data4['receipt_number']			=	$receipt_number;
							$data4['students_fee_master_id']		=	$fee_master_id[$i];
							$data4['student_id']				=	$student_id;
							$data4['branch_id']					= 	$branch_id;
							$data4['department_id']				= 	$dept_id;
							$data4['class_id']					= 	$class_id;
							$data4['section_id']				=	$section_id;
							$data4['academic_year_id']			=	$academic_year_id;
							$data4['payment_mode']				=	$payment_mode;
							
							$data4['amount_paid']				=	$amount;
							//$data4['late_fee']					=	$this->input->post('late_fee');
							$data4['created_by']				=	$this->session->userdata('login_user_id');
							$data4['created_date']				=	date('Y-m-d');
							
							if ($prev_master_id!=$curr_master_id)
							{
								$this->db->insert('tbl_fee_2_students_fee_collection_master', $data4);
								$master_id= $this->db->insert_id();
							}
							$prev_master_id=$curr_master_id;	
						
						//insert into collection details
							$data5['students_fee_collection_master_id']	=	$master_id;
							$data5['fee_head_id']						=	$fee_heads[$i];
							$data5['amount_paid']						=	$fee_amount[$i];
							
							$this->db->insert('tbl_fee_2_students_fee_collection_details', $data5);


						
						////////////// update tbl_fee_2_students_fee_master
							$this->db->set("amount_balance", "amount_balance - " . $fee_amount[$i], FALSE);
							$this->db->where('students_fee_master_id',$fee_master_id[$i]);
							$this->db->update('tbl_fee_2_students_fee_master');
				
						////////////// update tbl_fee_2_students_fee_details
							$this->db->set("amount_balance", "amount_balance - " . $fee_amount[$i], FALSE);
							$this->db->where('students_fee_details_id',$fee_items_details_id[$i]);
							$this->db->update('tbl_fee_2_students_fee_details');
							$amount =$amount -$fee_amount[$i];

						}
						else
						{
							// insert into collection master
							$data4['date_paid']				=	$date_paid;
							$data4['receipt_number']		=	$receipt_number;
							$data4['students_fee_master_id']=	$fee_master_id[$i];
							$data4['student_id']			=	$student_id;
							$data4['branch_id']				= 	$branch_id;
							$data4['department_id']			= 	$dept_id;
							$data4['class_id']				= 	$class_id;
							$data4['section_id']			=	$section_id;
							$data4['academic_year_id']		=	$academic_year_id;
							$data4['payment_mode']			=	$payment_mode;
							
							$data4['amount_paid']				=	$amount;
							//$data4['late_fee']					=	$this->input->post('late_fee');
							$data4['created_by']				=	$this->session->userdata('login_user_id');
							$data4['created_date']				=	date('Y-m-d');
							
							if ($prev_master_id!=$curr_master_id)
							{
								$this->db->insert('tbl_fee_2_students_fee_collection_master', $data4);
								$master_id= $this->db->insert_id();
							}
							$prev_master_id=$curr_master_id;	
							
							//insert into collection details
								$data5['students_fee_collection_master_id']	=	$master_id;
								$data5['fee_head_id']						=	$fee_heads[$i];
								$data5['amount_paid']						=	$amount;
								
								$this->db->insert('tbl_fee_2_students_fee_collection_details', $data5);
				
				
										
							////////////// update tbl_fee_2_students_fee_master
								$this->db->set("amount_balance", "amount_balance - " . $amount, FALSE);
								$this->db->where('students_fee_master_id',$fee_master_id[$i]);
								$this->db->update('tbl_fee_2_students_fee_master');
					
							////////////// update tbl_fee_2_students_fee_details
								$this->db->set("amount_balance", "amount_balance - " . $amount, FALSE);
								$this->db->where('students_fee_details_id',$fee_items_details_id[$i]);
								$this->db->update('tbl_fee_2_students_fee_details');
							break;
						}
	
					}
		
	
	///////////////////////////////
				}

			}
			else
			{
				// do nothing
				redirect($_SERVER['HTTP_REFERER']);
			}
			if($late_fee>0)
			{
				$late['receipt_number']		=	$receipt_number;
				$late['late_fee']			=	$late_fee;
				$late['student_id']			=	$student_id;
				$late['branch_id']			=	$branch_id;
				$this->db->insert('tbl_fee_2_late_fee', $late);
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				echo "Payment Failed";
				echo anchor('FeeManagement/pay_fee/view', 'Go Back', array('title' => 'Go Back'));
			}
			else
			{
				$page_data['branch_id']		=	$branch_id;
				$page_data['dept_id']		=	$dept_id;
				$page_data['class_id']		=	$class_id;
				$page_data['section_id']	=	$section_id;
				$page_data['student_id']	=	$student_id;
				$page_data['receipt_no']	=	$receipt_number;
				$page_data['payment_mode']	=	$payment_mode;
				$page_data['date_paid']		=	$date_paid;
				$page_data['page_name']		=	'receipt';
				$page_data['page_title']	=	'Fee Management - All';
				
				$this->load->view('new_fee/receipt.php', $page_data);		 
			}
			
		}	
		if($para1 == 'edit')
		{
		
		}
		if($para1 == 'update')
		{
		
		}
		if($para1 == 'delete')
		{
		
		}
	}
	function edit_fee($para1='',$para2='')
	{
		/*
		 * Mani, 01-12-2018 02:14 
		 */ 
		if($para1=='view')
		{
			$data['role_data']	=	$this->get_role_datas();
			$this->load->view('new_fee/edit_fee',$data);
		}	
		if($para1=='update')
		{
			$branch_id				=	$_POST['branch_id'];
			$dept_id				=	$_POST['dept_id'];
			$class_id				=	$_POST['class_id'];
			$section_id				=	$_POST['section_id'];
			$student_id				=	$_POST['student_id'];
			
			$students_fee_master_id	=	$_POST['students_fee_master_id'];
			$deleted_fee_master_id	=	$_POST['deleted_fee_master_id'];
			$is_used				=	$_POST['is_used'];
			$installments			=	$_POST['installments'];
			$due_date				=	$_POST['due_date'];
			$amount_array			=	$_POST['amount_array'];
			$fee_head_arr			=	$_POST['fee_head_arr'];
			$fee_details_arr		=	$_POST['fee_details_array'];//This is not needed in this function. 
			$count					=	count($installments)-1; //One hidden installments textbox is there. So reduce 1 from total
			
			/*echo "<pre>";
			print_r($fee_details_arr);
			echo $count;
			echo "</pre>";die();*/
			
			$this->db->trans_start();
			//Delete fee structures from database
			if($deleted_fee_master_id!='')
			{
				for($i=0;$i<count($deleted_fee_master_id);$i++)
				{
					$this->Fee_management_model->edit_fee('delete',$deleted_fee_master_id[$i]['value']);
				} 
			}
			
			for($i=1;$i<=$count;$i++)
			{ 
				if($is_used[$i]=='Y')//If fee paid using the installment, update only the due date.
				{
					$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]['value']));
					$result								=	$this->Fee_management_model->edit_fee('master_update',$data,$students_fee_master_id[$i]['value']);	
				}
				else
				{
					if($students_fee_master_id[$i]['value']=='')//If new row, insert it into database.
					{
						$amount_to_pay						=	0;
						$data['student_id']					=	$student_id;
						$data['class_id']					=	$class_id;
						$data['department_id']				=	$dept_id;
						$data['branch_id']					=	$branch_id;
						
						$data['installment_no']				=	$installments[$i]['value'];
						$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]['value']));
						$data['created_by']					=	$this->session->userdata('login_user_id');
						$data['created_date']				=	date('Y-m-d');
						$data['year_id']					=	get_running_year();
						$student_fee_master_id				=	$this->Fee_management_model->assign_fee('insert',$data);
						
						for($j=0;$j<count($fee_head_arr[$i]);$j++) 
						{ 
							$data1['students_fee_master_id']=	$student_fee_master_id;		
							$data1['fee_head_id']			=	$fee_head_arr[$i][$j];		
							$data1['amount_to_pay']			=	$amount_array[$i][$j];		
							$data1['amount_balance']		=	$amount_array[$i][$j];
							$students_fee_details_id		=	$this->Fee_management_model->assign_fee('insert2',$data1);	
							$amount_to_pay					=	$amount_to_pay+$amount_array[$i][$j];
						}
						$data2['amount_to_pay']				=	$amount_to_pay;
						$data2['amount_balance']			=	$amount_to_pay;
						$affected_rows						=	$this->Fee_management_model->edit_fee('master_update',$data2,$student_fee_master_id);
					}	
					else	//If already existing row, update it.
					{
						$amount_to_pay						=	0;
						$data['installment_no']				=	$installments[$i]['value'];
						$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]['value']));
						$student_fee_master_id				=	$this->Fee_management_model->edit_fee('master_update',$data,$students_fee_master_id[$i]['value']);
						
						for($j=0;$j<count($fee_head_arr[$i]);$j++) 
						{ 
							//echo $amount_array[$i][$j];die();	
							//If new fee head added after assigning fee structure, add that fee head to details table.
							$this->db->where('students_fee_master_id',$students_fee_master_id[$i]['value']);
							$this->db->where('fee_head_id',$fee_head_arr[$i][$j]);
							$fee_det    =   $this->db->get('tbl_fee_2_students_fee_details')->row();
							if(!isset($fee_det))
							{
							    $this->db->set('students_fee_master_id',$students_fee_master_id[$i]['value']);
							    $this->db->set('fee_head_id',$fee_head_arr[$i][$j]);
							    $this->db->set('amount_to_pay',$amount_array[$i][$j]);
							    $this->db->set('amount_balance',$amount_array[$i][$j]);
							    $this->db->insert('tbl_fee_2_students_fee_details');
							}
							else
							{
    							$data1['amount_to_pay']			=	$amount_array[$i][$j];		
    							$data1['amount_balance']		=	$amount_array[$i][$j];
    							$students_fee_details_id		=	$this->Fee_management_model->edit_fee('details_update',$data1,$fee_details_arr[$i][$j]);	
    							$amount_to_pay					=	$amount_to_pay+$amount_array[$i][$j];
							}
						}
						$data2['amount_to_pay']				=	$amount_to_pay;
						$data2['amount_balance']			=	$amount_to_pay;
						$affected_rows						=	$this->Fee_management_model->edit_fee('master_update',$data2,$students_fee_master_id[$i]['value']);
					}
				}	
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				echo "failed";
			}
			else
			{
				echo "success";
			}
			//$this->load->view('new_fee/print_message',$data);
		}	
		if($para1=='update_bulk')
		{
		
			$students_fee_master_id		=	$this->input->post('students_fee_master_id');
			$installment				=	$this->input->post('installment');
			$due_date					=	$this->input->post('due_date');
			$is_used					=	$this->input->post('is_use');
			$amount						=	$this->input->post('amount');
			$fee_head_id				=	$this->input->post('fee_head_id');
			$student_fee_details_id		=	$this->input->post('student_fee_details_id');
			$deleted_fee_master_id		=	$this->input->post('deleted_fee_master_id');
			//print_r($fee_head_id);die;
		
			$branch_id					=	$_POST['branch_id'];
			$dept_id					=	$_POST['dept_id'];
			$class_id					=	$_POST['class_id'];
			$section_id					=	$_POST['section_id'];
			$student_id					=	$this->input->post('student_id');
			//$students_fee_details_id	=	$this->input->post('students_fee_details_id[]');
			//echo count($students_fee_master_id);die;
			
			$this->db->trans_start();
			$this->db->db_debug=false;
						
			for($i=0;$i<count($installment);$i++)
			{ 
				if($is_used[$i]=='Y')//If fee paid using the installment, update only the due date.
				{
					$data['due_date']						=	date('Y-m-d',strtotime($due_date[$i]));
					$result									=	$this->Fee_management_model->edit_fee('master_update',$data,$students_fee_master_id[$i]);	
				}
				else
				{
					if($students_fee_master_id[$i]=='')//If new row, insert it into database.
					{
						$amount_to_pay						=	0;
						$data['student_id']					=	$student_id;
						$data['class_id']					=	$class_id;
						$data['department_id']				=	$dept_id;
						$data['branch_id']					=	$branch_id;
						
						$data['installment_no']				=	$installment[$i];
						$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]));
						$data['created_by']					=	$this->session->userdata('login_user_id');
						$data['created_date']				=	date('Y-m-d');
						$data['year_id']					=	get_running_year();
						$student_fee_master_id				=	$this->Fee_management_model->assign_fee('insert',$data);
						
						for($j=0;$j<count($fee_head_id[$i]);$j++) 
						{ 
							$data1['students_fee_master_id']=	$student_fee_master_id;		
							$data1['fee_head_id']			=	$fee_head_id[$i][$j];		
							$data1['amount_to_pay']			=	$amount[$i][$j];		
							$data1['amount_balance']		=	$amount[$i][$j];
							$students_fee_details_id		=	$this->Fee_management_model->assign_fee('insert2',$data1);	
							$amount_to_pay					=	$amount_to_pay+$amount[$i][$j];
						}
						$data2['amount_to_pay']				=	$amount_to_pay;
						$data2['amount_balance']			=	$amount_to_pay;
						$affected_rows						=	$this->Fee_management_model->edit_fee('master_update',$data2,$student_fee_master_id);
					}	
					else	//If already existing row, update it.
					{
						$amount_to_pay						=	0;
						$data['installment_no']				=	$installment[$i];
						$data['due_date']					=	date('Y-m-d',strtotime($due_date[$i]));
						$student_fee_master_id				=	$this->Fee_management_model->edit_fee('master_update',$data,$students_fee_master_id[$i]);
						
						for($j=0;$j<count($fee_head_id[$i]);$j++) 
						{ 
							//echo $amount_array[$i][$j];die();	
							//If new fee head added after assigning fee structure, add that fee head to details table.
							$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
							$this->db->where('fee_head_id',$fee_head_id[$i][$j]);
							$fee_det    =   $this->db->get('tbl_fee_2_students_fee_details')->row();
							if(!isset($fee_det))
							{
							    $this->db->set('students_fee_master_id',$students_fee_master_id[$i]);
							    $this->db->set('fee_head_id',$fee_head_id[$i][$j]);
							    $this->db->set('amount_to_pay',$amount[$i][$j]);
							    $this->db->set('amount_balance',$amount[$i][$j]);
							    $this->db->insert('tbl_fee_2_students_fee_details');
							}
							else
							{
    							$data1['amount_to_pay']			=	$amount[$i][$j];		
    							$data1['amount_balance']		=	$amount[$i][$j];
    							$students_fee_details_id		=	$this->Fee_management_model->edit_fee('details_update',$data1,$student_fee_details_id[$i][$j]);	
    							$amount_to_pay					=	$amount_to_pay+$amount[$i][$j];
							}
						}
						$data2['amount_to_pay']					=	$amount_to_pay;
						$data2['amount_balance']				=	$amount_to_pay;
						$affected_rows							=	$this->Fee_management_model->edit_fee('master_update',$data2,$students_fee_master_id[$i]);
					}
				}
			}
			
			for($i=0;$i<count($deleted_fee_master_id);$i++)
			{
				if($deleted_fee_master_id[$i]!='')
				{
					$this->Fee_management_model->edit_fee('delete',$deleted_fee_master_id[$i]);
				}
			}
			
			
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				echo "failed";
			}
			else
			{
				echo "success";
			}
		}
		
	}		 

	function get_role_datas()
	{
		$role	=	$this->session->userdata('role');
		if($role==1 || $role==2)
		{
			return $this->Fee_management_model->get_branch();
		}
		if($role==3)
		{
			return $this->Fee_management_model->get_department($this->session->userdata('branch_id'));
		}
		if($role>3)
		{
			$branch_id	=	$this->session->userdata('branch_id');
			$dept_id	=	$this->session->userdata('dept_id');
			$year		=	get_running_year();
			return $this->Fee_management_model->get_class_by_branch($branch_id,$dept_id,$year);
		}
	}
	function get_students_having_no_fee_structure($class_id='',$section_id='')
	{
		$students	=	$this->Fee_management_model->get_students_having_no_fee_structure($class_id,$section_id);
		echo '<option value="">Select Student</option>';
		if(count($students)>0)
		{
			echo '<option value="all">All</option>';
		}	
		foreach ($students as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function get_students1($class_id='',$section_id='')
	{
		//Get students
		$students	=	$this->Fee_management_model->get_students1($class_id,$section_id);
		echo '<option value="">Select Student</option>';
		foreach ($students as $row) 
		{
			echo '<option value="' . $row['student_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function show_fee_structure()
	{
		$data['branch_id']	=	$this->input->post('branch_id');
		$data['dept_id']	=	$this->input->post('dept_id');
		$data['class_id']	=	$this->input->post('class_id');
		$data['section_id']	=	$this->input->post('section_id');
		$data['student_id']	=	$this->input->post('student_id');
		$data['fee_heads']	=	$this->Fee_management_model->get_fee2_heads($data['dept_id']);
		$this->load->view('new_fee/assign_fee_show_structure',$data);
	}
	function show_edit_fee_structure()
	{
		/*
		 * Mani, 01-12-2018 02:22 
		 */ 
		$data['branch_id']	=	$this->input->post('branch_id');
		$data['dept_id']	=	$this->input->post('dept_id');
		$data['class_id']	=	$this->input->post('class_id');
		$data['section_id']	=	$this->input->post('section_id');
		$data['student_id']	=	$this->input->post('student_id');
		$data['fee_heads']	=	$this->Fee_management_model->get_fee2_heads($data['dept_id']);
		$data['fee_master']	=	$this->Fee_management_model->get_fee2_students_fee_master($data['student_id']);
		$this->load->view('new_fee/edit_fee_show_structure',$data);
	}
	function show_bulk_edit_fee_structure()
	{
		/*
		 * Mani, 23-03-2019 16:35 
		 */ 
		$data['branch_id']	=	$this->input->post('branch_id');
		$data['dept_id']	=	$this->input->post('dept_id');
		$data['class_id']	=	$this->input->post('class_id');
		$data['section_id']	=	$this->input->post('section_id');
		$data['fee_heads']	=	$this->Fee_management_model->get_fee2_heads($data['dept_id']);
		$data['fee_details']=	$this->Fee_management_model->get_fee2_students_and_fee_master($data['class_id'],$data['section_id']);
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$this->load->view('new_fee/edit_fee_bulk_show_structure',$data);
	}
	function show_fee_pay()
	{	
		$data['branch_id']			=	$this->input->post('branch_id');
		$data['dept_id']			=	$this->input->post('dept_id');
		$data['class_id']			=	$this->input->post('class_id');
		$data['section_id']			=	$this->input->post('section_id');
		$data['student_id']			=	$this->input->post('student_id');
		$data['stud_fee_master']	=	$this->Fee_management_model->get_stud_fee_master($data['student_id']);
		$this->load->view('new_fee/pay_fee_details',$data);
	}
	function get_class_students($dept_id='')
	{
		$year	=	get_running_year();
		if($dept_id=='all')
		{
			$this->db->where('branch_id',$this->session->userdata('branch_id'));
		}
		else if($dept_id!='')
		{
			$this->db->where('dept_id',$dept_id);
		}
		$this->db->where('academic_year',$year);
		$this->db->order_by('name','ASC');
		$class  = $this->db->get('class')->result_array();
		echo '<option value="">SELECT</option>';
		if(count($class)>0)
		{
			echo '<option value="all">All</option>';
		}
		foreach ($class as $row) 
		{
			echo '<option value="'.$row['class_id'].'">'.$row['name'].'</option>';
		}
	}
	function get_sections($class_id='')
	{
		$year		=	get_running_year();
		$this->db->where('class_id',$class_id);
		$this->db->where('academic_year',$year);
		$this->db->order_by('name');
		$sections = $this->db->get('section')->result_array();
		echo '<option value="">SELECT</option>';
		if(count($sections)>1)
		{
			echo '<option value="all">All</option>';
		}
		foreach ($sections as $row) 
		{
			echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
		}
	}
	function get_students2($dept_id='')
	{
		$stud	=	$this->Fee_management_model->get_students2($dept_id);
		echo '<option value="">SELECT</option>';
		if(count($stud)>0)
		{
			echo '<option value="all">All</option>';
		}
		foreach ($stud as $row) 
		{
			echo '<option value="'.$row['student_id'].'">'.$row['name'].'</option>';
		}
	}
	
	function fee_report($para1='',$para2='')
	{
		/*
		 * Mani, 03-12-2018 13:28 
		 */ 
		if($para1 == 'view')
		{
			$data['role_data']				=	$this->get_role_datas();
			$data['fee_heads']				=	$this->Fee_management_model->new_fee_head($para1);
			$this->load->view('new_fee/reports',$data);
		}
		if($para1 == 'show_report')
		{
			$data['branch_id']					=	$_POST['branch_id'];
			$data['dept_id']					=	$_POST['dept_id'];
			$data['class_id']					=	$_POST['class_id'];
			$data['section_id']					=	$_POST['section_id'];
			$data['report_type']				=	$_POST['report_type'];
			$data['due_from_date']				=	$_POST['due_from_date'];
			$data['due_to_date']				=	$_POST['due_to_date'];
			$data['collection_from_date']		=	$_POST['collection_from_date'];
			$data['collection_to_date']			=	$_POST['collection_to_date'];
			$data['fee_head_id']				=	$_POST['fee_head_id'];
			
			if(isset($_POST['show_all_fee_items'])) // show_all_fee_items is not declared in fee due report page. So when downloading its report,error may occur. To overcome that isset is used.
			{
				$data['show_all_fee_items']		=	$_POST['show_all_fee_items'];
			}
			$data['result']						=	$this->Fee_management_model->fee_report($para1,$data);
		//Download Excel Start(DUE)	
			if(isset($_POST['due_report_excel']))
			{
				ob_start();
				ob_get_clean();
				$total = 0;
				$i=1;
				
				//$dataToExports = [];
				echo  "Fee Due List\n";
				if($data['due_from_date']!='')
				{
					echo "From: ".date('d-m-Y',strtotime($data['due_from_date']))."|";
					echo "To: ".date('d-m-Y',strtotime($data['due_to_date']))."\n";
				}
				else
				{
					echo "To: ".date('d-m-Y',strtotime($data['due_to_date']))."\n";
				}
				
				foreach ($data['result'] as $data1)
				{
				$total 							=	$total+$data1['amount_balance'];
				$arrangeData['Sl.No'] 			= 	$i;
				$arrangeData['Due Date'] 		= 	date('d-m-Y', strtotime( $data1['due_date']));
				//$arrangeData['Student ID'] 	= $data1['admission_number'];
				$arrangeData['Name'] 			=  	$data1['student_name'];
				$arrangeData['Class'] 			=  	$data1['class_name'];
				$arrangeData['Section'] 		= 	$data1['section_name'];
				if($data['dept_id']=='all')
				{
					$arrangeData['Department'] 	=  	$data1['dept_name'];	
				}
				$arrangeData['Phone'] 			=  	$data1['phone1'];
				$arrangeData['Amount'] 			=  	$data1['amount_balance'];
				
				$dataToExports[]				= 	$arrangeData;
				$i=$i+1;
				}
				$arrangeData['Sl.No'] 			= 	"";
				$arrangeData['Due Date'] 		= 	"";
				$arrangeData['Name'] 			= 	"";
				$arrangeData['Class'] 			= 	"";
				$arrangeData['Section'] 		= 	"";
				if($data['dept_id']=='all')
				{
					$arrangeData['Department'] 	=  	"";	
				}
				$arrangeData['Phone'] 			=  	"Total";
				$arrangeData['Amount']			= 	$total;
				$dataToExports[]				= 	$arrangeData;
				// set header
				$filename = "StudentsList.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				$this->exportExcelData($dataToExports);
				die();
				
			}
		//Download Excel End(DUE)
		
			if(isset($_POST['due_report_pdf']))
			{
				ob_start();
				$html 								=	ob_get_clean();
				$html 								= 	utf8_encode($html);
				$year								=	get_running_year();
				$this->db->where('department_id',$data['dept_id']);
				if($data['class_id']!='all')
				{
				$this->db->where('class_id',$data['class_id']);
				if($data['section_id']!='all')
				{
				$this->db->where('section_id',$data['section_id']);
				}
				}
				if($data['due_from_date']!='')
				{
					$this->db->where('due_date>=' , date('Y-m-d',strtotime($data['due_from_date'])));
				}
				if($data['due_to_date']!='')
				{
					$this->db->where('due_date<=' , date('Y-m-d',strtotime($data['due_to_date'])));
				}
				$this->db->where('year_id',$year);
				$this->db->where('is_deleted','N');
				$this->db->where('amount_balance>','0');	
				$data1['student_data'] 				= $this->db->get('view_fee2_due')->result_array();
				$html								= $this->load->view('new_fee/pdf_due',$data1,true);
				include(APPPATH.'third_party/mpdf/mpdf.php');
				$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->allow_charset_conversion 	= true;
				$mpdf->charset_in = 'UTF-8';
				$mpdf->WriteHTML($html);
				$mpdf->Output($data['data'][0]->reference_no.'report.pdf','D');	
				die();
			}

			if(isset($_POST['collection_report_excel']))
			{
				$filename = "FeeCollectionReport.xls";
				header("Content-Type: application/vnd.ms-excel");
				header("Content-Disposition: attachment; filename=".$filename);
				$total = 0;
				$i=1;
				echo "<html>";
				echo  "<table border='1'><tr><td colspan='9' align='center'>Fee Collection Report</td></tr>";
				if($data['collection_from_date']!='')
				{
					echo  "<tr><td colspan='9'  align='center'>" .date('d-m-Y',strtotime( $data['collection_from_date'])) . " To " .date('d-m-Y',strtotime(  $data['collection_to_date'])). "</td></tr>";
				}
				else
				{
					echo  "<tr><td colspan='9'  align='center'> Till " .date('d-m-Y',strtotime(  $data['collection_to_date'])). "</td></tr>";
				}
						if($data['dept_id']!='all')
						{
								if ($data['class_id']!="all")
								echo  "<tr><td colspan='8'>Class : " . get_class_name($data['class_id']) . "</td></tr>";
							if ($data['section_id']!="all")
								{
								echo  "<tr><td colspan='8'>Section/Batch : " .get_section_name($data['section_id']) . "</td></tr>";
								}
							else
								{
								echo  "<tr><td colspan='8'>Section/Batch : All </td></tr>";
								}
						}
						else
						{
							echo  "<tr><td colspan='9'>Department : All </td></tr>";
						}
						
						echo  "<tr><td>Sl.No</td><td>Date Paid</td><td>Receipt No.</td><td>Name</td><td>Class</td><td>Section</td>";
						$colspan="7";
						if($data['dept_id']=='all')
						{
							echo "<td>Department</td>";
							$colspan="8";
						}
						echo "<td>Fee Item</td><td>Amount</td></tr>";
						foreach ($data['result'] as $data1)
						{
						$amount= $data1['head_amount_paid'];
						echo "<tr><td>". $i . "</td><td>" .date('d-m-Y',strtotime( $data1['date_paid']));
						echo "</td><td>" . $data1['receipt_number']."</td><td>".$data1['student_name'];
						echo "</td><td>".$data1['class_name'];
						echo "</td><td>". $data1['section_name']."</td>";
						if($data['dept_id']=='all')
						{
							echo "<td>".$data1['dept_name']."</td>";
						}
						echo "<td>".$data1['fee_head_name']  ;
						echo "</td><td>" . number_format( $amount,2) . "</td></tr>";
						$i=$i+1;
						$total = $total +  $data1['head_amount_paid'];
						}
						echo  "<tr><td colspan='".$colspan."' align='right'><b>Total</b><td> <b>" . number_format($total,2) . "</b></td></tr></table>";
						echo "</body>";
						echo "</html>";	
							//	$this->exportExcelData($dataToExports);
								die();
			}
			
			if(isset($_POST['collection_report_pdf']))
			{
				ob_start();
				$html 								=	ob_get_clean();
				$html 								= 	utf8_encode($html);
				$year								=	get_running_year();
				$this->db->where('department_id',$data['dept_id']);
				if($data['class_id']!='all')
				{
				$this->db->where('class_id',$data['class_id']);
				if($data['section_id']!='all')
				{
				$this->db->where('section_id',$data['section_id']);
				}
				}
				if($data['due_from_date']!='')
				{
					$this->db->where('date_paid>=' , date('Y-m-d',strtotime($data['due_from_date'])));
				}
				if($data['due_to_date']!='')
				{
					$this->db->where('date_paid<=' , date('Y-m-d',strtotime($data['due_to_date'])));
				}
				if($data['fee_head_id']!='all')
				{
					$this->db->where('fee_head_id',$data['fee_head_id']);
				}
				$this->db->where('academic_year_id',$year);
				$this->db->where('is_deleted','N');
				$data1['student_data'] 				= $this->db->get('view_fee2_collection')->result_array();
				$html								= $this->load->view('new_fee/pdf_collection',$data1,true);
				include(APPPATH.'third_party/mpdf/mpdf.php');
				$mpdf 								= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->allow_charset_conversion 	= true;
				$mpdf->charset_in = 'UTF-8';
				$mpdf->WriteHTML($html);
				$mpdf->Output($data['data'][0]->reference_no.'report.pdf','D');	
				die();
			}
		
		
		//Download Excel End(COLLECTION)
		
			
			if($data['report_type'] == 'due')
			{
				$this->load->view('new_fee/report_due',$data);
			}
			if($data['report_type'] == 'collection')
			{
				$this->load->view('new_fee/report_collection',$data);
			}
		}
	//Store message content to table
		if($para1 == 'due_sms')
		{
			$class_id			=	$this->input->post('class_id');  //This class_id and section_id will not contain values if department's value is 'all'
			$section_id			=	$this->input->post('section_id');
			$due_date			=	$this->input->post('due_from_date');
			$due_date_from		=	$this->input->post('due_to_date');
			$dept_id			=	$this->input->post('dept_id');
				
			$running_year		=	get_running_year();
			
			$sms 				= 	$this->db->get('sms_settings')->row();
			$sender_id 			= 	$sms->sender_id;
			$username 			= 	$sms->username;
			$password 			= 	$sms->password;
			$common 			= 	$sms->common_word;
			$url 				= 	$sms->url;
			$web_url			=	$sms->web_url;
			
			$ph					=	'';
			$ph2				=	'';
			$user_id			= 	$this->session->userdata('login_user_id');
			$staff				=	$this->db->get_where('staff' ,array('user_id'=>$user_id))->row()->staff_id;
			$data['send_by']	=	$staff;
			$data['content']	=  	"Fees due Message";
			date_default_timezone_set("Asia/Kolkata");
			$data['send_date']	=  date('Y/m/d H:i:s');
			$this->db->insert('tbl_sms_delivery_master',$data);
			$master_id			=	$this->db->insert_id();
			if($this->db->get_where('settings' , array('type' =>'pos_common_word'))->row()->description == 'First')
			{
				$c= '1';
			}
			else
			{
				$c= '0';
			}
			if($this->db->get_where('settings' , array('type' =>'msg_student_name'))->row()->description == 'yes')
			{
				$n= '1';
			}
			else
			{
				$n= '0';
			}
			
			$ch_single			=	$this->input->post('check_single[]');
			$checked			=	$this->input->post('checked[]');
			$student_id			=	$this->input->post('student_id[]');
			$due_date2			=	$this->input->post('due_date1[]');
			$fee_balance		=	$this->input->post('fee_balance[]');
			$phone				=	$this->input->post('phone[]');
			$phone2				=	$this->input->post('phone2');
					
					
			for($i=0;$i<count($student_id);$i++)
			{
				if($checked[$i]==1)
				{
				
					$content				=	'. Your Payment of RS '.$fee_balance[$i].' is due on '.date('d-m-Y',strtotime($due_date2[$i])).'. Please pay immediately. Ignore this message if already paid';
					$data1['sms_master_id']	=	$master_id;
					$data1['student_id']	=	$student_id[$i];
					$data1['class_id']		=	get_student_class_id($student_id[$i]);
					$data1['section_id']	=	get_student_section_id($student_id[$i]);
					$data1['phone']			=	$phone[$i];
					date_default_timezone_set("Asia/Kolkata");
					$data1['send_date']		=  	date('Y/m/d H:i:s');
					
					$data1['msg_content']	= 	$this->sms_helper($common,$c,$n,get_student_name($student_id[$i]),$content,$due_date);
					
					$this->db->insert('tbl_sms_delivery_details',$data1);
					if($phone2==1)
					{
						$data1['phone']		=	get_student_phone2($student_id[$i]);
						if($data1['phone']!='')
						{
							$this->db->insert('tbl_sms_delivery_details',$data1);	
						}
					}

				}
			}
			$data['master_id']		=	$master_id;	
			$data['class_id']		=	$class_id;
			$data['section_id']		=	$section_id;
			$data['due_date']		=	$due_date;
			$data['due_date_from']	=	$due_date_from;
			$data['dept_id']		=	$dept_id;
			$this->load->view('new_fee/message_popup_due',$data);
		}
	//Send message	
		if($para1 == 'send_due_sms')
		{
			$master_id	=	$para2;
			$content	=	$this->input->post('content[]');
			$details_id	=	$this->input->post('details_id[]');
			//print_r($content);die();
			for($i=0;$i<count($content);$i++)
			{
				$this->db->set('msg_content',$content[$i]);
				$this->db->where('sms_master_id',$master_id);	
				$this->db->where('details_id',$details_id[$i]);	
				$this->db->update('tbl_sms_delivery_details');// echo $this->db->last_query();die();
			}
			
			$this->db->select('a.student_id,a.details_id,a.msg_content,a.phone as ph,a.processed');
			$this->db->from('tbl_sms_delivery_details a');
			$this->db->where('sms_master_id',$master_id);
			$a=$this->db->get()->result_array();
			$i				=	0;
			$sms 			= 	$this->db->get('sms_settings')->row();
			$sender_id 		= 	$sms->sender_id;
			$username 		= 	$sms->username;
			$password 		= 	$sms->password;
			$common 		= 	$sms->common_word;
			$url 			= 	$sms->url;
			$web_url		=	$sms->web_url;
			
			foreach($a as $b)
			
			{
				$ph=$b['ph'];
				$message= $b['msg_content'];
			
				if($b['processed']==0)
				{
					$location = 'uname=' . urlencode($username) . '&pwd=' . urlencode($password) . '&senderid=' . urlencode($sender_id) . '&to='.$ph.'&msg=' . urlencode($message) . '&route=T';
					$api = $url;
					$handle = fopen($api . "/creditsleft/" . $username . "/" . $password . "/T", "r");
					$balance = stream_get_contents($handle);
					if ($balance >= 0) 
					{
						$api . "/sendsms?" . $location;
						$send = fopen($api . "/sendsms?" . $location, "r");
						$api . "/sendsms?" . $location;
						
						$return_message_ids 	= 	stream_get_contents($send);
						$message_id_array 		= 	explode(",", $return_message_ids);
						$str 					= 	filter_var($return_message_ids, FILTER_SANITIZE_NUMBER_INT);
						$sms_data['msg_code']	=	$str;
						$sms_data['processed']	=	1;
						$this->db->where('details_id',$b['details_id']);
						$this->db->update('tbl_sms_delivery_details',$sms_data);
						$i++;
					}
			
				}
				else
				{
					?>
					<script>alert("No Message Send ")</script>
					<?php  
				} 
			} 
			redirect(base_url() . 'index.php/FeeManagement/fee_report/view' , 'refresh');          
		}
		if($para1 == 'delete_due_sms') 
		{
			$master_id	=	$para2;
			$this->db->where('sms_master_id',$master_id);
			$this->db->delete('tbl_sms_delivery_master');
			
			$this->db->where('sms_master_id',$master_id);
			$this->db->delete('tbl_sms_delivery_details');
			redirect(base_url() . 'index.php/FeeManagement/fee_report/view' , 'refresh');
		}
	}	
	function check_receipt_exist_fee2($receipt_number='',$branch_id='')
	{
		$query	=	$this->Fee_management_model->check_receipt_exist2($receipt_number,$branch_id);
	}
	
/**************New Fee End*********************************/

	function view_special_fee_head()
	{
	   $this->db->where('is_deleted','N');
	   $this->db->where('active','y');
	   $this->db->where('fee_category_id','2');
	   $this->db->order_by('fee_head ASC');
	   $data['fees']=$this->db->get('view_fee_head')->result_array();
	   $this->load->view('admin/view_special_fee_head',$data);
	}
	
	function edit_special_fee_head($fee_head_id)
	{
		$this->db->select('fee_head_id,fee_head');
		$this->db->where('fee_head_id',$fee_head_id);
		$data['fee_heads']		=	$this->db->get('tbl_fee_heads')->row();
        $this->load->view('admin/edit_special_fee_head',$data);
	}
	function update_special_fee_heads()
	{
		$fee_head_id			=	$this->input->post('fee_head_id');
		$fee_head				=	$this->input->post('fee_head');
		$this->db->where('fee_head_id',$fee_head_id);
		$this->db->set('fee_head',$fee_head);
		$result					=	$this->db->update('tbl_fee_heads');
		if($result>0)
		{
			$action		=	"success";
		}
		else
		{
			$action		=	"failed";
		}
		$this->session->set_flashdata('action',$action);
		redirect('FeeManagement/edit_special_fee_head/'.$fee_head_id);
	}
	
	function delete_special_fee_heads($fee_head_id)
	{
		$this->db->where('fee_head_id',$fee_head_id);
		$this->db->set('is_deleted','Y');
		$result					=	$this->db->update('tbl_fee_heads');
		if($result>0)
		{
			$action		=	"success";
		}
		else
		{
			$action		=	"failed";
		}
		$this->session->set_flashdata('action',$action);
		redirect('FeeManagement/view_special_fee_head');
	}
	function add_special_fee_head()
	{
        $this->load->view('admin/add_special_fee_head');
	}
	function insert_special_fee_heads()
	{
		$data['fee_category_id']	=	$this->input->post('fee_category_id');
		$data['fee_head']			=	$this->input->post('fee_head');
		$result						=	$this->db->insert('tbl_fee_heads',$data);
		if($result>0)
		{
			$action		=	"success";
		}
		else
		{
			$action		=	"failed";
		}
		$this->session->set_flashdata('action',$action);
		redirect('FeeManagement/add_special_fee_head');
	}
/************* Edit Receipt Start ***********************/
	function edit_receipt_view()
	{
		$data['receipts']	=	$this->Fee_management_model->get_receipts();
		//print_r($data['receipts']);die;
		$this->load->view('admin/edit_receipt_view',$data);
	}
	function get_receipt_details($receipt_number,$student_id='')
	{
		$data['results']		=	$this->Fee_management_model->get_receipt_details($receipt_number,$student_id);
		if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
			$data['transport']	=	$this->Fee_management_model->get_transport_receipt_details($receipt_number,$student_id);
			//echo "<pre>";print_r($data['results']);echo "</pre>";die;
		}
                $data['opening_balance']        =       $this->Fee_management_model->get_opening_balance_receipt_details($receipt_number,$student_id);          
		$data['receipt_number']         =	$receipt_number;
		$this->load->view('admin/edit_receipt_view1',$data);
	}
	function update_receipt()
	{
		$fee_collection_master_id		=	$this->input->post('fee_collection_master_id[]');
		$student_fee_master_id			=	$this->input->post('student_fee_master_id[]');
		$student_id				=	$this->input->post('student_id');
		$actual_receipt_num			=	$this->input->post('actual_receipt_number');
		$edit_receipt_num			=	$this->input->post('edit_receipt_number');
		
		$this->db->db_debug			=	FALSE;
		$this->db->trans_start();
		for($i=0;$i<count($fee_collection_master_id);$i++)      
		{
			$fee_collection_details_id	=	$this->input->post($fee_collection_master_id[$i].'_fee_collection_details_id[]');
			$fee_head_id			=	$this->input->post($fee_collection_master_id[$i].'_fee_head_id[]');
			$amount				=	$this->input->post($fee_collection_master_id[$i].'_amount[]');
			
			$tot_paid_amount		=	0;
			for($j=0;$j<count($amount);$j++)     
			{
				$this->db->set('fee_amount',$amount[$j]);
				$this->db->where('fee_collection_details_id',$fee_collection_details_id[$j]);
				$this->db->update('tbl_fee_collection_details');
				
				$this->db->select('SUM(a.fee_amount) as fee_amount');
				$this->db->from('tbl_fee_collection_details a');
				$this->db->join('tbl_fee_collection_master b','b.fee_collection_master_id=a.fee_collection_master_id');
				$this->db->where('b.student_fee_master_id',$student_fee_master_id[$i]);
				$this->db->where('a.fee_head_id',$fee_head_id[$j]);
				$amt	=	$this->db->get()->row()->fee_amount;
				
				$this->db->set('fee_balance','fee_amount-fee_concession-'.$amt,FALSE);
				$this->db->where('students_fee_master_id',$student_fee_master_id[$i]);
				$this->db->where('fee_head_id',$fee_head_id[$j]);
				$this->db->update('tbl_students_fee_details');
				
				$tot_paid_amount	   +=	$amount[$j];
			}
			$this->db->select('SUM(fee_balance) as fee_balance');
			$this->db->from('tbl_students_fee_details');
			$this->db->where('students_fee_master_id',$student_fee_master_id[$i]);
			$fee_bal	=	$this->db->get()->row()->fee_balance;
			
			$this->db->set('fee_balance',$fee_bal);
			$this->db->where('students_fee_master_id',$student_fee_master_id[$i]);
			$this->db->update('tbl_students_fee_master');
		}
		if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
			$student_id				=	$this->input->post('student_id1');
			$students_bus_fee_master_id		=	$this->input->post('students_bus_fee_master_id[]');
			$bus_fee_collection_master_id		=	$this->input->post('bus_fee_collection_master_id[]');
			$bus_fee_collection_details_id		=	$this->input->post('bus_fee_collection_details_id[]');
			$bus_fee_amount				=	$this->input->post('bus_fee_amount[]');
			
			for($m=0;$m<count($bus_fee_collection_details_id);$m++)      
			{
			
				$this->db->set('fee_amount',$bus_fee_amount[$m]);
				$this->db->where('bus_fee_collection_details_id',$bus_fee_collection_details_id[$m]);
				$this->db->update('tbl_transport_students_bus_fee_collection_details');

				$this->db->select('SUM(fee_amount) as fee_amount');
				$this->db->from('tbl_transport_students_bus_fee_collection_details');
				$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id[$m]);
				$paid_fee	=	$this->db->get()->row()->fee_amount;

				$this->db->set('fee_balance','fee_amount-fee_concession-'.$paid_fee,FALSE);
				$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id[$m]);
				$this->db->update('tbl_transport_students_bus_fee_master');//echo $this->db->last_query();die;
			}
		}
		
/*		$coll_master					=	$this->db->get_where('tbl_fee_collection_master',array('admission_number'=>$student_id))->result_array();
		foreach($coll_master as $row)
		{
			$coll_details				=	$this->db->get_where('tbl_fee_collection_details',array('fee_collection_master_id'=>$row['fee_collection_master_id']))->result_array();
			foreach($coll_details as $row1)
			{
				if(isset($fee_amount[$row1['fee_head_id']]))
				{
					$fee_amount[$row1['fee_head_id']]+= $row1['fee_amount'];	
				}
				else
				{
					$fee_amount[$row1['fee_head_id']] = $row1['fee_amount'];	
				}
			}
		}
		
		$fee_master						=	$this->db->get_where('tbl_students_fee_master',array('admission_number'=>$student_id))->result_array();
		foreach($fee_master as $row)
		{
			$fee_bal[$row['students_fee_master_id']]	=	0;
			$fee_details				=	$this->db->get_where('tbl_students_fee_details',array('students_fee_master_id'=>$row['students_fee_master_id']))->result_array();
			//echo count($fee_details);
			foreach($fee_details as $row1)
			{
				if(isset($fee_amount[$row1['fee_head_id']]))
				{
					$amount					=	$row1['fee_amount']-$row1['fee_concession']-$fee_amount[$row1['fee_head_id']];	
					$this->db->set('fee_balance',$amount);
					$this->db->where('students_fee_details_id',$row1['students_fee_details_id']);
					$this->db->update('tbl_students_fee_details');
				}
				else
				{
					$amount					=	$row1['fee_balance'];
				}
				
				if(isset($fee_bal[$row['students_fee_master_id']]))
				{
					//echo $row1['fee_balance']."<br>";	
					$fee_bal[$row['students_fee_master_id']]+=	$amount;
					
				}
				else
				{
					$fee_bal[$row['students_fee_master_id']] =	$amount;		
				}
				
			}
			//echo $this->db->last_query();die;
			$this->db->set('fee_balance',$fee_bal[$row['students_fee_master_id']]);
			$this->db->where('students_fee_master_id',$row['students_fee_master_id']);
			$this->db->update('tbl_students_fee_master');
		}
*/		
                /****** Opening Balance Start ************/
                
                $fee_collection_id          =   $this->input->post('fee_collection_id[]');
                $opening_balance_id         =   $this->input->post('opening_balance_id[]');
                $fee_head_id                =   $this->input->post('fee_head_id[]');
                $op_bal_fee_amount          =   $this->input->post('op_bal_fee_amount[]');
                $op_bal_fee_actual_amount   =   $this->input->post('op_bal_fee_actual_amount[]');
                $fee_balance                =   $this->input->post('fee_balance[]');
                
                if(count($fee_collection_id)>0)
                {
                    for($i=0;$i<count($fee_collection_id);$i++)
                    {
                        if($op_bal_fee_actual_amount[$i]!==$op_bal_fee_amount[$i])
                        {
                            $tot_fee_amount =   $op_bal_fee_actual_amount[$i]+$fee_balance[$i]; 
                            $fee_balance    =   $tot_fee_amount-$op_bal_fee_amount[$i];
                            if($fee_head_id[$i]!=='99999')
                            {
                                $this->db->set('amount_paid',$op_bal_fee_amount[$i]);
                                $this->db->where('id',$fee_collection_id[$i]);
                                $this->db->update('tbl_opening_balance_fee_collection'); 
                                
                                $this->db->set('fee_balance',$fee_balance);
                                $this->db->where('id',$opening_balance_id[$i]);
                                $this->db->update('tbl_opening_balance');
                            }
                            if($fee_head_id[$i]==='99999')
                            {
                                $this->db->set('amount_paid',$op_bal_fee_amount[$i]);
                                $this->db->where('id',$fee_collection_id[$i]);
                                $this->db->update('tbl_opening_balance_transport_fee_collection');  
                                
                                $this->db->set('fee_balance',$fee_balance);
                                $this->db->where('id',$opening_balance_id[$i]);
                                $this->db->update('tbl_opening_balance_transport');
                            }
                        }
                    }
                }
                
                /****** Opening Balance End ************/
                
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('action','failed');
		}	
		else
		{
                    if($edit_receipt_num!='')
                    {
			//Update receipt number
			$this->db->set('receipt_number',$edit_receipt_num);
			$this->db->where('receipt_number',$actual_receipt_num);
			$this->db->update('tbl_fee_collection_master');
			
			if($this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
			{
				$this->db->set('receipt_number',$edit_receipt_num);
				$this->db->where('receipt_number',$actual_receipt_num);
				$this->db->update('tbl_transport_students_bus_fee_collection_master');
			}
			
                        $this->db->set('receipt_number',$edit_receipt_num);
			$this->db->where('receipt_number',$actual_receipt_num);
			$this->db->update('tbl_opening_balance_fee_collection');
                        
                        $this->db->set('receipt_number',$edit_receipt_num);
			$this->db->where('receipt_number',$actual_receipt_num);
			$this->db->update('tbl_opening_balance_transport_fee_collection');
                        
			if($edit_receipt_num!=$actual_receipt_num)
			{
				$year	=	get_running_year();
				$this->db->set('voucher_number',$edit_receipt_num);	
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$this->db->where('voucher_type_name','Receipt');
				$this->db->where('academic_year_id',$year);
				$this->db->update('tbl_voucher'); //echo $this->db->last_query();die;
			}
			
			$this->session->set_flashdata('action','success');
                    }    
		}	
		redirect('FeeManagement/edit_receipt_view');
	}
	
	function check_receipt_num($new_receipt_num,$actual_receipt_num)
	{
                $this->db->select('receipt_number');
		$this->db->where('receipt_number',$new_receipt_num);
		$this->db->where('receipt_number !=',$actual_receipt_num);
		$result		=	$this->db->get('tbl_fee_collection_master')->result_array();
		
                $this->db->select('receipt_number');
		$this->db->where('receipt_number',$new_receipt_num);
		$this->db->where('receipt_number !=',$actual_receipt_num);
		$result1	=	$this->db->get('tbl_special_fee_collection_master')->result_array();
		
                $this->db->select('receipt_number');
                $this->db->where('receipt_number',$new_receipt_num);
		$this->db->where('receipt_number !=',$actual_receipt_num);
		$result2	=	$this->db->get('tbl_transport_students_bus_fee_collection_master')->result_array();
                
                $this->db->select('receipt_number');
                $this->db->where('receipt_number',$new_receipt_num);
		$this->db->where('receipt_number !=',$actual_receipt_num);
                $this->db->where('is_deleted','N');
		$result3	=	$this->db->get('tbl_opening_balance_fee_collection')->result_array();
                
                $this->db->select('receipt_number');
                $this->db->where('receipt_number',$new_receipt_num);
		$this->db->where('receipt_number !=',$actual_receipt_num);
                $this->db->where('is_deleted','N');
		$result4	=	$this->db->get('tbl_opening_balance_transport_fee_collection')->result_array();

                
		if(count($result)>0 || count($result1)>0 || count($result2)>0 || count($result3)>0 || count($result4)>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
/************* Edit Receipt end ************************/



/////////////////-----------moby (3/5/2019)--------////////////////
function fee_due_report_pdf()
{
		$class_id		=	$this->input->post('class_id');
		$section_id		=	$this->input->post('section_id');
		$due_date		=	date('Y-m-d',strtotime($this->input->post('due_date')));
		$due_date_from	=	$this->input->post('due_date_from');
		$report_type	=	$this->input->post('report_type');
                $last_year_due					=	$this->input->post('last_year_due');
		ob_start();
		ini_set('display_errors', 0);
		$html 					=	ob_get_clean();
		$html 					= 	utf8_encode($html);
		if($due_date_from!='')
		{
		    $due_date_from		=	date('Y-m-d',strtotime( $this->input->post('due_date_from')));
		}
		$dept_id		=	$this->input->post('dept_id');
		
		$amount			=	$this->input->post('amount');

		$condition		=	' ';
		$condition1		=	' ';
		$condition2		=	' ';
		$condition3		=	' ';
                
                $condition_op_bal                                       =       ' ';
                $condition_op_bal1                                      =       ' ';
		
		if($this->db->get_where('settings' , array('type' =>'reset_due_idle'))->row()->description == 'yes')
		{
			if($report_type =='1')
			{
				//$condition	=	$condition." is_idle = 'N' and ";
				//$condition1	=	$condition1." is_idle = 'N' and ";
				//$condition2	=	$condition2." a.is_idle = 'N' and ";
				//$condition3	=	$condition3." is_idle = 'N' and ";
			}
			else if($report_type =='2')
			{
				$condition	=	$condition."is_idle = 'Y' and ";
				$condition1	=	$condition1."is_idle = 'Y' and ";
				$condition2	=	$condition2."a.is_idle = 'Y' and ";
				$condition3	=	$condition3."is_idle = 'Y' and ";
			}
		}	
		if($dept_id == 'all')
		{
		    $condition	=	$condition." branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition1	=	$condition1." branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition2	=	$condition2." a.branch_id = '".$this->session->userdata('branch_id')."' ";
		    $condition3	=	$condition3." branch_id = '".$this->session->userdata('branch_id')."' ";
                    
                    $condition_op_bal   =   $condition_op_bal." branch_id = '".$this->session->userdata('branch_id')."' ";
                    $condition_op_bal1  =   $condition_op_bal1." branch_id = '".$this->session->userdata('branch_id')."' ";
                    
		}
		else if($class_id == 'all')
		{
			$condition	=	$condition." dept_id = '".$dept_id."' ";
			$condition1	=	$condition1." dept_id = '".$dept_id."' ";
			$condition2	=	$condition2." a.dept_id = '".$dept_id."' ";
			$condition3	=	$condition3." a.dept_id = '".$dept_id."' ";
                        
                        $condition_op_bal	=	$condition_op_bal." dept_id = '".$dept_id."' ";
                        $condition_op_bal1	=	$condition_op_bal1." dept_id = '".$dept_id."' ";
		}
		else
		{
			if($section_id == 'all')
			{
				$condition	=	$condition." class_id = '".$class_id."' ";
				$condition1	=	$condition1." class_id = '".$class_id."' ";
				$condition2	=	$condition2." a.class_id = '".$class_id."' ";
				$condition3	=	$condition3." class_id = '".$class_id."' ";
                                
				$condition_op_bal	=	$condition_op_bal." class_id = '".$class_id."' ";
                                $condition_op_bal1	=	$condition_op_bal1." class_id = '".$class_id."' ";
			}
			else
			{
				$condition	=	$condition." class_id = '".$class_id."' and batch_id = '".$section_id."' ";
				$condition1	=	$condition1." class_id = '".$class_id."' and section_id = '".$section_id."' ";
				$condition2	=	$condition2." a.class_id = '".$class_id."' and a.batch_id = '".$section_id."' ";
				$condition3	=	$condition3." class_id = '".$class_id."' and section_id = '".$section_id."' ";
                                
                                $condition_op_bal	=	$condition_op_bal." class_id = '".$class_id."' and section_id = '".$section_id."' ";
                                $condition_op_bal1	=	$condition_op_bal1." class_id = '".$class_id."' and section_id = '".$section_id."' ";
			}
		}
		if($due_date_from == '')
		{
			$condition	=	$condition;
			$condition1	=	$condition1;
			$condition2	=	$condition2;
			$condition3	=	$condition3;
		}
		else
		{
			$condition	=	$condition." and due_date >= '".$due_date_from."' ";
			$condition1	=	$condition1." and due_date >= '".$due_date_from."' ";
			$condition2	=	$condition2." and a.due_date >= '".$due_date_from."' ";
			$condition3	=	$condition3." and due_date >= '".$due_date_from."' ";
		}
		
		if($this->input->post('due_date') == '')
		{
			$condition	=	$condition;
			$condition1	=	$condition1;
			$condition2	=	$condition2;
			$condition3	=	$condition3;
		}
		else
		{
			$condition	=	$condition." and due_date <= '".$due_date."' and enroll_year='".get_running_year()."' and academic_year_id='".get_running_year()."' ";
			$condition1	=	$condition1." and due_date <= '".$due_date."' and enroll_year='".get_running_year()."' and academic_year='".get_running_year()."' ";
			$condition2	=	$condition2." and a.due_date <= '".$due_date."' and a.enroll_year='".get_running_year()."' ";
			$condition3	=	$condition3." and due_date <= '".$due_date."' and a.academic_year='".get_running_year()."' ";
                        
                        $condition_op_bal	=	$condition_op_bal." and fee_to_year_id='".get_running_year()."' and enroll_year='".get_running_year()."'";
                        $condition_op_bal1	=	$condition_op_bal1." and fee_to_year_id='".get_running_year()."' and enroll_year='".get_running_year()."'";
		}

		if($amount=='')
		{
			$amount		=	0;
		}
		
		/*
		if($this->db->get_where('settings',array('type'=>'show_multiple_dues'))->row()->description=='no') 
		{		
			if($due_date_from == '')
			{
				/*
				Lazzaro:If due date from is null, then all dues till the selected date should be shown.(If one student's multiple dues are there, add all amount and show as a single row)
				
				if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes') //Add fee balance of all dues of a student and display in single row.
				{
					$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
					
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
					}
					
				}	
				else																									//Display the first due only.
				{
					$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " . $condition ."and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
					
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
					}
				}
			}
			else
			{
	    	    if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes')
	    	    {
    				$sql = "select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
				
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
					}			
	    	    }
	    	    else
	    	    {
				    $sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " . $condition ." and  fee_balance>$amount group by admission_number order by due_date,class_id,batch_id,name";
			
				    if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
				    {
				    	$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id order by due_date,class_id,section_id,name";
				    }
	    	    }    
			}
		}
		else
		{
			if($due_date_from == '')
			{*/
                                $union  =   "";
                                $union1 =   "";
                                if($last_year_due == 1)
                                {
                                    $union  =   "union all (select phone1 as phone,student_id as admission_number,class_id,section_id as batch_id,fee_amount,SUM(fee_balance) as fee_balance,'0000-00-00' as due_date,name from view_opening_balance where $condition_op_bal and fee_balance>$amount group by student_id) ";
                                    $union1  =   "union all (select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,'0000-00-00' as due_date,name from view_opening_balance_transport where $condition_op_bal1 and fee_balance>$amount group by student_id) ";
                                }    

				if($this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes') //Add fee balance of all dues of a student and display in single row.
				{
					$sql = " select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from ( (select phone,admission_number,class_id,batch_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_fee_due where " .$condition ." and  fee_balance>$amount group by admission_number ) $union ) as Tab group by admission_number order by due_date,class_id,batch_id,name ";
					
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from ( (select student_id,class_id,class_name,section_name,section_id,fee_amount,SUM(fee_balance) as fee_balance,MAX(due_date) as due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount group by student_id) $union1 ) as Tab1 group by student_id order by due_date,class_id,section_id,name ";
					}
				}	
				else																									//Display all dues.
				{
					$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " .$condition. "and  fee_balance>$amount order by due_date,class_id,batch_id,name";
					
					if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
					{
						$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount order by due_date,class_id,section_id,name";
					}
				}
			/*}
			else
			{
				$sql = "select phone,admission_number,class_id,batch_id,due_date,fee_amount,fee_balance,name from view_fee_due where " .$condition. "and  fee_balance>$amount order by due_date,class_id,batch_id,name";
				
				if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
				{
					$sql1 = "select student_id,class_id,class_name,section_name,section_id,fee_amount,fee_balance,due_date,name from view_transport_students_bus_fee_master where " . $condition1 ." and is_deleted='N' and  fee_balance>$amount order by due_date,class_id,section_id,name";
				}
			}
		}*/
		
		$data1['fee_data']= $this->db->query($sql)->result_array();//echo $this->db->last_query();die;
		
		if($this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes')
		{
			$data1['fee_data1']= $this->db->query($sql1)->result_array();
		}
		if($this->db->get_where('settings',array('type'=>'show_multiple_dues'))->row()->description=='no' && $this->db->get_where('settings',array('type'=>'single_row_for_all_dues'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'transportation'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'show_transport_fee_with_normal_fee_pay'))->row()->description=='yes' && $this->db->get_where('settings',array('type'=>'transport_due_with_fee_due'))->row()->description=='yes')
		{	
			$sql = "select name,admission_number,sum(fee_balance) as fee_balance "
                                . "from "
                                . "("
                                    . "(SELECT a.admission_number,a.class_id,a.batch_id,a.due_date,sum(case when (a.student_status_id != 0 and a.student_status_id != 5) then 0 else a.fee_balance end) as fee_balance,a.name "
                                    . "FROM view_fee_due a inner join student b on b.student_id=a.admission_number and b.student_status_id=0 where " . $condition2 ." and  a.fee_balance>0 group by a.admission_number) "
                                    . "UNION ALL "
                                    . "(SELECT a.student_id,a.class_id,a.section_id as batch_id,a.due_date,sum(case when (a.student_status_id != 0 and a.student_status_id != 5) then 0 else a.fee_balance end) as fee_balance,a.name "
                                    . "FROM view_transport_students_bus_fee_master a inner join student b on b.student_id=a.student_id where " . $condition3 ." and a.is_deleted='N' and  a.fee_balance>0 group by a.student_id) "
                                    . "UNION ALL "
                                    . "(SELECT student_id as admission_number,class_id,section_id as batch_id,'0000-00-00' as due_date,sum(fee_balance) as fee_balance,name "
                                    . "FROM view_opening_balance where " . $condition_op_bal ." and  fee_balance>0 group by admission_number ) "
                                    . "UNION ALL "
                                    . "(SELECT student_id as admission_number,class_id,section_id as batch_id,'0000-00-00' as due_date,sum(fee_balance) as fee_balance,name "
                                    . "FROM view_opening_balance_transport where " . $condition_op_bal1 ." and  fee_balance>0 group by admission_number ) "
                                . ") as T "
                                . "group by admission_number HAVING fee_balance>$amount order by fee_balance desc";
			$data1['fee_data']= $this->db->query($sql)->result_array();
		}
//		print_r($data1);die;
		$html					=	$this->load->view('admin/pdf_fee_due',$data1,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
		$mpdf 					= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->allow_charset_conversion 		= true;
		$mpdf->charset_in = 'UTF-8';
		$mpdf->WriteHTML($html);
		$mpdf->Output($data['data'][0]->reference_no.'due_report.pdf','D');	//  I for view or create pdf  and D for download	
}

/////////////////-----------moby--------////////////////


/*************** Delete Receipt Start ********************/

/*	function delete_receipt_view()
	{
		$data['receipts']	=	$this->Fee_management_model->get_receipts();
		$this->load->view('admin/delete_receipt',$data);
	}
*//*	function get_receipt_number($dept_id)
	{
		$receipt_number		=	$this->Fee_management_model->get_receipt_number($dept_id);
		echo "<option value=''>Select Receipt Number</option>";
		foreach($receipt_number as $row):
			echo "<option value='".$row['receipt_number']."'>".$row['receipt_number']."</option>";
		endforeach;
	}
*/	
	function delete_receipt($receipt_number)
	{
		if($receipt_number!='')
		{
			$result		=	$this->Fee_management_model->delete_receipt($receipt_number);
			if($result == TRUE)
			{
				$this->session->set_flashdata('action','receipt_deleted');
			}
			else
			{
				$this->session->set_flashdata('action','receipt_not_deleted');
			}
		}
	}
/*************** Delete Receipt End **********************/
/*************** Complete Fee Report Start ***************/

	function complete_fee_report()
	{
		$this->load->view('admin/all_fee_report');
	}

	function get_all_fee_report($department='',$class_id='',$section_id='',$student_id='')
	{
		$data['department'] = $department; 
		$data['class_id'] = $class_id;
		$data['section_id'] = $section_id;
		$data['student_id'] = $student_id;
                $data['student_fee']    =   $this->Fee_management_model->get_all_fee_data($department,$class_id,$section_id,$student_id);
                /*
                $this->db->select('a.admission_number,a.class_id,a.batch_id,a.academic_year_id,SUM(a.fee_amount) AS fee_amount,SUM(a.fee_balance) AS fee_balance,SUM(a.fee_concession) AS fee_concession,a.class_id,a.batch_id,b.dept_id,b.name,c.name as class_name,d.name as section_name');
		$this->db->from('tbl_students_fee_master a');
		$this->db->join('student b','b.student_id=a.admission_number');
		$this->db->join('class c','c.class_id=a.class_id');
		$this->db->join('section d','d.section_id=a.batch_id');
		
			$this->db->where('b.student_status_id','0');
			$this->db->where('a.academic_year_id', $year);
			$this->db->where('a.is_deleted', 'N');
			$this->db->where('b.dept_id', $department);
			if($class_id!='')
			{
				if($class_id!='all')
				{
					$this->db->where('a.class_id', $class_id);
				}
			}
			if($section_id!='')
			{
				if($section_id!='all')
				{
					$this->db->where('a.batch_id', $section_id);
				}
			}
			if($student_id!='')
			{
				if($student_id!='all')
				{
					$this->db->where('a.admission_number', $student_id);
				}
			}
			$this->db->order_by('a.class_id','asc');
			$this->db->order_by('a.batch_id','asc');
			$this->db->group_by('a.admission_number');
			$data['student_fee'] = $this->db->get()->result_array();
                */
	//		echo $this->db->last_query(); die();
			$this->load->view('admin/all_fee_report_data.php',$data);

	}
	function all_fee_pdf()
	{
		ob_start();
		$html 					=	ob_get_clean();
		$html 					= 	utf8_encode($html);
		
		$department = $this->uri->segment(3); 
		$class_id = $this->uri->segment(4);
		$section_id = $this->uri->segment(5);
		$student_id = $this->uri->segment(6);
		$data['student_fee']    =   $this->Fee_management_model->get_all_fee_data($department,$class_id,$section_id,$student_id);                
                $html  =  $this->load->view('admin/all_fee_report_pdf.php',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
		$mpdf 					= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->allow_charset_conversion 		= true;
		$mpdf->charset_in = 'UTF-8';
		$mpdf->WriteHTML($html);
		$mpdf->Output($data['data'][0]->reference_no.'All_fee_report.pdf','I');	//  I for view or create pdf  and D for download	
	}
	function all_fee_excel()
	{
            $department = $this->uri->segment(3); 
            $class_id = $this->uri->segment(4);
            $section_id = $this->uri->segment(5);
            $student_id = $this->uri->segment(6);
            $data['student_fee']    =   $this->Fee_management_model->get_all_fee_data($department,$class_id,$section_id,$student_id); 

            $i=1;
            ob_start();
            ob_get_clean();
            $filename = "AllFeeReport.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
            //$this->exportExcelData($dataToExports);
            $total = 0;
            $i=1;
            $image_url = base_url() . 'uploads/logo.png';
            echo  "<table border='0'><tr><td colspan='3'></td><td colspan='4'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='0'></td></tr>";
            echo "<tr><td colspan='7'></td></tr>";
            //$dataToExports = [];
            echo  "<table border='0'><tr><td colspan='2' align='center'></td><td colspan='2' align='center'></td><td colspan='3' align='center'></td></tr>";
            echo "<tr><td colspan='7' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
            echo  "<table border='0'><tr><td colspan='7' align='center'><b><h3>ALL FEE REPORT</h3></b></td></tr>";
            echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Student Name</td><td colspan='1'  align='left'>Admission Number</td><td colspan='1'  align='left'>Class/Section</td><td colspan='1'  align='left'>Total Amount</td><td colspan='1'  align='left'>Paid</td><td colspan='1'  align='left'>Concession</td><td colspan='1'  align='left'>Pending</td></tr>";
            foreach ($data['student_fee'] as $row)
            {
                    $paid = $row['fee_amount']-$row['fee_balance']-$row['fee_concession'];
                    echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".$row['name']."</td><td colspan='1'  align='left'>".get_admission_number($row['student_id'])."</td><td colspan='1'  align='left'>".$row['class_name']."/".$row['section_name']."<td colspan='1'  align='left'>".$row['fee_amount']."</td><td colspan='1'  align='left'>".$paid."</td><td colspan='1'  align='left'>".$row['fee_concession']."</td><td colspan='1'  align='left'>".$row['fee_balance']."</td></tr>";
                    //$dataToExports[]			= $arrangeData;
                    $i=$i+1;
            }
            die();

	}
/*************** Complete Fee Report End *****************/

function clerk_dashboard()
{
	$this->db->view('admin/clerk_dash_board');
}

	function post_fee_to_account($date="")
	{
		if($date!="")
		{
			$this->db->select('fee_head,SUM(fee_amount) AS fee_amount,branch_id,department_id');
			$this->db->where('date_paid',date('Y-m-d',strtotime($date)));
			$this->db->group_by('fee_head');
			$data['fee'] = $this->db->get('view_fee_collection_details')->result_array();

			$this->db->select('SUM(amount_paid) AS fee_amount,branch_id,dept_id AS department_id');
			$this->db->where('date_paid',date('Y-m-d',strtotime($date)));
			$data['bus_fee'] = $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();

			$this->db->select('fee_head,SUM(fee_amount) AS fee_amount,branch_id,dept_id AS department_id');
			$this->db->where('date_paid',date('Y-m-d',strtotime($date)));
			$this->db->where('is_deleted','N');
			$this->db->group_by('fee_head');
			$data['special_fee'] = $this->db->get('view_special_fee_collection_master')->result_array();
			
			$this->load->view('account/post_fee_to_account_by_date',$data);
		}
		else
		{
			$this->db->select('fee_head,SUM(fee_amount) AS fee_amount,branch_id,department_id');
			$this->db->where('date_paid',date('Y-m-d'));
			$this->db->group_by('fee_head');
			$data['fee'] = $this->db->get('view_fee_collection_details')->result_array();

			$this->db->select('SUM(amount_paid) AS fee_amount,branch_id,dept_id AS department_id');
			$this->db->where('date_paid',date('Y-m-d'));
			$data['bus_fee'] = $this->db->get('view_transport_students_bus_fee_collection_details')->result_array();

			$this->db->select('fee_head,SUM(fee_amount) AS fee_amount,branch_id,dept_id AS department_id');
			$this->db->where('date_paid',date('Y-m-d'));
			$this->db->group_by('fee_head');
			$this->db->where('is_deleted','N');
			$data['special_fee'] = $this->db->get('view_special_fee_collection_master')->result_array();
			
			//print_r($data['special_fee']);die;
			$this->load->view('account/post_fee_to_account',$data);
		}
	}


	function fee_report_full()
	{
		$this->load->view('admin/fee_report_full');
	}
	
function fee_report_per_year1()
	{
		$branch_id		=	$this->input->post('branch');
		$dept_id		=	$this->input->post('department');
		$class_id		=	$this->input->post('class_id');
		$section_id		=	$this->input->post('section_id');
		$year 			= 	get_running_year();
		$report_option  =   $this->input->post('report_option');
		
		$where			=	" b.academic_year_id=".$year." AND cl.branch_id=".$branch_id." AND cl.dept_id=".$dept_id;
		$where1			=	" a.academic_year=".$year." AND d.branch_id=".$branch_id." AND d.dept_id=".$dept_id;
		$where2			=	" a.academic_year_id=".$year." AND a.branch_id=".$branch_id." AND d.dept_id=".$dept_id;
		$where3			=	" a.fee_from_year_id<".$year." AND c.branch_id=".$branch_id." AND c.dept_id=".$dept_id;
		if($class_id!='all')
		{
			$where		=	$where." and b.class_id=".$class_id;
			$where1		=	$where1." and d.class_id=".$class_id;
			$where2		=	$where2." and a.class_id=".$class_id;
			$where3		=	$where3." and c.class_id=".$class_id;
		}
		if($section_id!='all' && $section_id>0)
		{
			$where		=	$where." and b.batch_id=".$section_id;
			$where1		=	$where1." and e.section_id=".$section_id;
			$where2		=	$where2." and a.section_id=".$section_id;
			$where3		=	$where3." and c.section_id=".$section_id;
		}
		$qry			=	"select * from 
							(";
		if($report_option == "only_current_year_due" || $report_option == "both")
		{					
			$qry		=	$qry."(select sum(case when (d.student_status_id !=0 and d.student_status_id !=5 and `a`.`fee_amount`=`a`.`fee_balance`+`a`.`fee_concession`) then 0 else `a`.`fee_amount` end) AS `amount`,sum(case when (d.student_status_id !=0 and d.student_status_id !=5) then 0 else `a`.`fee_balance` end) AS `balance`,sum(case when (d.student_status_id !=0 and d.student_status_id !=5 and `a`.`fee_amount`=`a`.`fee_concession`) then 0 else `a`.`fee_concession` end) AS `concession`,`b`.`academic_year_id` AS `year`,`c`.`fee_head` AS `item_head`,b.class_id,b.batch_id,cl.name as class_name ,s.name AS section_name,0 as fee_due_year,0 as fee_from_year_id
							from tbl_students_fee_details a 
							inner join tbl_students_fee_master b on `a`.`students_fee_master_id` = `b`.`students_fee_master_id`
							inner join `tbl_fee_heads` `c` on `a`.`fee_head_id` = `c`.`fee_head_id` 
							inner join student d on d.student_id=b.admission_number 
							inner join class cl on cl.class_id=b.class_id
							INNER JOIN section s on s.section_id=b.batch_id
							where".$where." and b.is_deleted='N' and a.is_deleted='N'
							group by `b`.`academic_year_id`,`a`.`fee_head_id`,b.batch_id,b.class_id)
							union all
							(select sum(case when (b.student_status_id !=0 and b.student_status_id !=5 and `a`.`fee_amount`=`a`.`fee_balance`+`a`.`fee_concession`) then 0 else `a`.`fee_amount` end) AS `amount`,sum(case when (b.student_status_id !=0 and b.student_status_id !=5) then 0 else `a`.`fee_balance` end) AS `balance`,sum(case when (b.student_status_id !=0 and b.student_status_id !=5 and `a`.`fee_amount`=`a`.`fee_concession`) then 0 else `a`.`fee_concession` end) AS `concession`,`a`.`academic_year` AS `year`,'Bus Fee' AS `item` ,d.class_id,e.section_id,d.name as class_name ,e.name AS section_name,0 as fee_due_year,0 as fee_from_year_id
							from `tbl_transport_students_bus_fee_master` `a`
							inner join student b on b.student_id=a.student_id   
							INNER JOIN enroll c on c.student_id= a.student_id AND c.year=".$year."
							INNER JOIN class d on d.class_id=c.class_id
							INNER JOIN section e on e.section_id=c.section_id
							where".$where1." and a.is_deleted='N' 
							group by `a`.`academic_year`,e.section_id,d.class_id)
							union all
							(select sum(`a`.`fee_amount`) AS `amount`,'0' AS `balance`,'0' AS `concession`,`a`.`academic_year_id` AS `year`,`f`.`fee_head` AS `item` ,d.class_id,e.section_id,d.name as class_name ,e.name AS section_name,0 as fee_due_year,0 as fee_from_year_id
							from `tbl_special_fee_collection_master` `a`
							inner join student b on b.student_id=a.student_id  
							INNER JOIN enroll c on c.student_id= a.student_id AND c.year=".$year."
							INNER JOIN class d on d.class_id=c.class_id
							INNER JOIN section e on e.section_id=c.section_id
							INNER JOIN tbl_fee_heads f on f.fee_head_id = a.fee_head_id 
							where".$where2."
							group by `a`.`academic_year_id`,a.fee_head_id,e.section_id,d.class_id) ";
		}			
		if($report_option == "both")
		{
		    $qry        =   $qry."union all ";
		}    
		if($report_option == "only_last_year_due" || $report_option == "both")
		{
            $qry        =   $qry."(select * from
                                                        ((SELECT case when a.fee_to_year_id=".$year." then sum(a.fee_amount) else IFNULL(sum(e.amount_paid),0)+sum(a.fee_balance) end as amount,sum(a.fee_balance) as balance,'0' AS `concession`,c.year as year,`b`.`fee_head` AS `item_head`,c.class_id,c.section_id as batch_id,c.class_name ,c.section_name,d.academic_year as fee_due_year,a.fee_from_year_id 
                                                        FROM `tbl_opening_balance` a 
                                                        left join (select IFNULL(sum(amount_paid),0) as amount_paid,opening_balance_id from tbl_opening_balance_fee_collection where is_deleted='N' and paid_year_id=".$year." ) e on e.opening_balance_id=a.id 
							inner join `tbl_fee_heads` `b` on `b`.`fee_head_id` = `a`.`fee_head_id` 
							inner join view_students c on c.student_id=a.student_id  and c.year=".$year."
                                                        inner join tbl_academic_year d on d.acdemic_year_id=a.fee_from_year_id    
							where".$where3." 
							GROUP BY a.fee_head_id,a.fee_to_year_id,c.section_id,c.class_id)
                                                        union all
                                                        (SELECT case when a.fee_to_year_id=".$year." then sum(a.fee_amount) else IFNULL(sum(e.amount_paid),0)+sum(a.fee_balance) end as amount,sum(a.fee_balance) as balance,'0' AS `concession`,c.year as year,'Bus Fee' `item_head`,c.class_id,c.section_id as batch_id,c.class_name ,c.section_name,d.academic_year as fee_due_year,a.fee_from_year_id 
                                                        FROM `tbl_opening_balance_transport` a 
                                                        left join (select IFNULL(sum(amount_paid),0) as amount_paid,opening_balance_id from tbl_opening_balance_transport_fee_collection where is_deleted='N' and paid_year_id=".$year." ) e on e.opening_balance_id=a.id 
							inner join view_students c on c.student_id=a.student_id and c.year=".$year."
                                                        inner join tbl_academic_year d on d.acdemic_year_id=a.fee_from_year_id    
							where".$where3." 
							GROUP BY a.fee_to_year_id,c.section_id,c.class_id)) tbl2) ";
		}					
		$qry            =   $qry."order by fee_from_year_id asc
							) tab
							ORDER BY class_name,section_name";
		$result			=	$this->db->query($qry)->result_array();//echo $this->db->last_query();die;
		/*
		echo "<pre>";
		print_r($result);
		echo "</pre>";die;	
		*/
		$tempArr 	= 	array_unique(array_column($result, 'batch_id'));
		$result1	=	array_values(array_intersect_key($result, $tempArr)); //These 2 line of code is used to remove arrays containing duplicate batch_id. So we will get array with unique batch_id
		/*
		echo "<pre>";
		print_r($result1);
		echo "</pre>";
		die;*/
		$data		=	array();
		for($i=0;$i<count($result1);$i++):
			 
			$data1['class_id']		=	$result1[$i]['class_id'];	
			$data1['batch_id']		=	$result1[$i]['batch_id'];
			$data1['class_name']	=	$result1[$i]['class_name'];
			$data1['section_name']	=	$result1[$i]['section_name'];
			$data1['details']		=	array();
			for($j=0;$j<count($result);$j++):
				if($data1['class_id']==$result[$j]['class_id'] && $data1['batch_id']==$result[$j]['batch_id'])
				{
                                        if($result[$j]['fee_due_year']!=='0')
                                        {
                                            $result[$j]['item_head']    =   $result[$j]['item_head']."(Due-".$result[$j]['fee_due_year'].")";
                                        }
					array_push($data1['details'],$result[$j]);
				}
				
			endfor;
			array_push($data,$data1);	
		endfor;
		/*
		echo "<pre>";
		print_r($data);
		echo "</pre>";die;	
		*/			
		$res['data']	=	$data;	
		$this->load->view('admin/fee_report_full_year',$res);
	}
	function fee_report_per_year()
	{
		$year = get_running_year();
		/*$this->db->select('SUM(amount) as amount,SUM(balance) as balance,SUM(concession) as concession, year, item_head');
		$this->db->group_by('Item_head','year');
		$this->db->where('year',$year);
		$data['total_amount'] = $this->db->get('view_yearly_total_amount')->result_array();*/
		$qry	=	"(select sum(`a`.`fee_amount`) AS `amount`,sum(`a`.`fee_balance`) AS `balance`,sum(`a`.`fee_concession`) AS `concession`,`b`.`academic_year_id` AS `year`,`c`.`fee_head` AS `item_head` 
						from tbl_students_fee_details a 
						inner join tbl_students_fee_master b on `a`.`students_fee_master_id` = `b`.`students_fee_master_id`
						inner join `tbl_fee_heads` `c` on `a`.`fee_head_id` = `c`.`fee_head_id` 
						inner join student d on d.student_id=b.admission_number and d.student_status_id=0
						where `b`.`academic_year_id`='".$year."' and b.is_deleted='N' and a.is_deleted='N'
						group by `b`.`academic_year_id`,`a`.`fee_head_id` )
						union all
						(select sum(`a`.`fee_amount`) AS `amount`,sum(`a`.`fee_balance`) AS `balance`,sum(`a`.`fee_concession`) AS `concession`,`a`.`academic_year` AS `year`,'Bus Fee' AS `item` 
						from `tbl_transport_students_bus_fee_master` `a`
						inner join student b on b.student_id=a.student_id and b.student_status_id=0  where `a`.`academic_year`='".$year."'  and a.is_deleted='N'
						group by `a`.`academic_year`)";
		$data['total_amount'] =	$this->db->query($qry)->result_array(); //print_r($data['total_amount']);die;
		$this->load->view('admin/fee_report_per_year',$data);
	}
	
	function reset_due_date()
	{
		$this->load->view('admin/reset_due_date');
	}	

public function get_students_fee_details($student_id='',$class='',$section='',$direction='',$department_id='',$branch_id='')
{
	if($direction!='back')
	{
		$role_id				=	$this->session->userdata('role');
		if($role_id==1 || $role_id==2)
		{
			$page_data['branch_id']		=	$this->input->post('branch');
			$page_data['department_id']	=	$this->input->post('department');
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
		if($role_id==3)
		{
			$page_data['department_id']	=	$this->input->post('department');
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
		if($role_id>=4)
		{
			$page_data['class_id']   	= 	$this->input->post('class_id');
			$page_data['section_id'] 	= 	$this->input->post('section_id');
		}	
	}
	else
	{
		$page_data['class_id']   		= 	$class;
		$page_data['section_id'] 		= 	$section;
		if($department_id!='')
		{
			$page_data['department_id']	=	$department_id;
		}
		if($branch_id!='')
		{
			$page_data['branch_id']		=	$branch_id;
		}
	}
      	//$page_data['class_id']  = 	$data['class_id'];
        //$page_data['section_id']= 	$data['section_id'];
		$page_data['section']	= 	$section;

        $students 				= 	$this->Fee_management_model->get_students($page_data);
    //    $fee_master				= 	$this->Fee_management_model->get_fee_master_by_class($page_data);

        $page_data['students']  =  	$students;
//		$page_data['fee_master']=  	$fee_master;
		
		$this->load->view('admin/reset_due_date1.php', $page_data);
}	

public function reset_student_fees($class_id,$batch_id,$admission_number,$department_id='',$branch_id='')
 {
        $page_data['page_name']	 = 'reassign_student_fees';
        $page_data['page_title'] = 'Reassign Fees';
		
		$page_data['class_id']	=	$class_id;
		$page_data['section']	=	$batch_id;
		$page_data['student_id']=	$admission_number;
		if($department_id!='')
		{
			$page_data['department_id']	=	$department_id;
		}
		if($branch_id!='')
		{
			$page_data['branch_id']		=	$branch_id;
		}
		$this->load->view('admin/reset_student_fees.php', $page_data);
 }	

	function reset_fee_due_date_idle()
	{
		$check_student_fee				=	$this->input->post('check_value[]');
		$students_fee_master_id			=	$this->input->post('students_fee_master_id[]');
		$due_date						=	$this->input->post('due_date[]');
		$is_idle						=	$this->input->post('is_idle_value[]');
		$department_id					=	$this->input->post('department');
		$count							=	count($students_fee_master_id);
		//print_r($is_idle);die;
		for($i=0;$i<$count;$i++) 
		{
			
			$data['due_date']				=	date('Y-m-d',strtotime($due_date[$i]));
			$data['is_idle']				=	$is_idle[$i];
			if($check_student_fee[$i]=='Y')
			{
				$this->db->where('students_fee_master_id',$students_fee_master_id[$i]);
				$this->db->update('tbl_students_fee_master', $data);
			}
		}
		
		$due_date1						=	$this->input->post('due_date1[]');
		$is_idle1						=	$this->input->post('is_idle_value1[]');
		$check_bus_fee_value			=	$this->input->post('check_bus_fee_value[]');
		$students_bus_fee_master_id		=	$this->input->post('students_bus_fee_master_id[]');
		$count1							=	count($students_bus_fee_master_id);
	
		for($i=0;$i<$count1;$i++) 
		{	
			$data1['due_date']				=	date('Y-m-d',strtotime($due_date1[$i])); 
			$data1['is_idle']				=	$is_idle1[$i];
			if($check_bus_fee_value[$i]=='Y')
			{
				$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id[$i]);
				$this->db->update('tbl_transport_students_bus_fee_master', $data1);
			}
		}
	
			$student_id = $this->input->post('student_id');
			$class_id=  $this->input->post('class');
			$section_id =  $this->input->post('section');
			$branch_id =  $this->input->post('branch_id');
			$url= base_url() . 'index.php/FeeManagement/get_students_fee_details/'.$student_id.'/'.$class_id.'/'.$section_id.'/back/'.$department_id.'/'.$branch_id;
			redirect($url);
	}
	
	function delete_installments($students_fee_master_id,$class_id,$student_id)
	{
                date_default_timezone_set('Asia/Kolkata');
		$this->db->where('students_fee_master_id',$students_fee_master_id);
                $this->db->set('is_deleted','Y');
                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
		$this->db->update('tbl_students_fee_master');
                
		$this->db->where('students_fee_master_id',$students_fee_master_id);
                $this->db->set('is_deleted','Y');
                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
		$this->db->update('tbl_students_fee_details');
		$url= base_url() . 'index.php/Admin/student_portal/'.$student_id.'/'.$class_id;
		redirect($url);
	}
	
	function delete_bus_fee_installments($students_bus_fee_master_id,$student_id)
	{
		$this->db->where('students_bus_fee_master_id',$students_bus_fee_master_id);
                $this->db->set('is_deleted','Y');
                $this->db->set('deleted_by',$this->session->userdata('login_user_id'));
                $this->db->set('deleted_date',date('Y-m-d H:i:s'));
		$this->db->update('tbl_transport_students_bus_fee_master');
		$url= base_url() . 'index.php/Admin/student_portal/'.$student_id;
		redirect($url);
	}
	
	function test()
	{
		$this->db->select('a.fee_collection_master_id,a.admission_number');
		$this->db->join('student b','b.student_id=a.admission_number and b.student_status_id=0');
		$this->db->group_by('a.admission_number');
		$data   =   $this->db->get('tbl_fee_collection_master a')->result_array();
		//echo count($data);
		foreach($data as $row)
		{
			$this->db->select('fee_collection_master_id,student_fee_master_id');
			$this->db->where('admission_number',$row['admission_number']);
			$data1  =   $this->db->get('tbl_fee_collection_master')->result_array();
			$sum    =   0;    
			foreach($data1 as $row1)
			{
				$this->db->select('sum(fee_amount) as fee_amount');
				$this->db->where('fee_collection_master_id',$row1['fee_collection_master_id']);
				$sum    =   $sum+$this->db->get('tbl_fee_collection_details')->row()->fee_amount;
			}
			
			$this->db->select('(sum(fee_amount)-sum(fee_concession)-sum(fee_balance)) as total');
			$this->db->where('admission_number',$row['admission_number']);
			$this->db->where('is_deleted','N');
			$total      =   $this->db->get('tbl_students_fee_master')->row()->total;
			//echo $sum."<br>".$total;die;
			if($sum!=$total)
			{
				echo $row['admission_number']."<br>";
			}
		}    
	}

	function test1()
	{
		$this->db->select('a.bus_fee_collection_master_id,a.student_id');
		$this->db->join('student b','b.student_id=a.student_id and b.student_status_id=0');
		$this->db->group_by('a.student_id');
		$data   =   $this->db->get('tbl_transport_students_bus_fee_collection_master a')->result_array();
		//echo count($data);
		$tot	=	0;
		foreach($data as $row)
		{
			$this->db->select('bus_fee_collection_master_id');
			$this->db->where('student_id',$row['student_id']);
			$data1  =   $this->db->get('tbl_transport_students_bus_fee_collection_master')->result_array();
			$sum    =   0;    
			foreach($data1 as $row1)
			{
				$this->db->select('sum(fee_amount) as fee_amount');
				$this->db->where('bus_fee_collection_master_id',$row1['bus_fee_collection_master_id']);
				$sum    =   $sum+$this->db->get('tbl_transport_students_bus_fee_collection_details')->row()->fee_amount;
			}
			
			$this->db->select('(sum(fee_amount)-sum(fee_balance)-sum(fee_concession)) as total');
			$this->db->where('student_id',$row['student_id']);
			$this->db->where('is_deleted','N');
			$total      =   $this->db->get('tbl_transport_students_bus_fee_master')->row()->total;
			//echo $sum."<br>".$total;die;
			if($sum!=$total)
			{
				echo $row['student_id']."<br>";
			}
			$tot	=	$tot+$sum;
		}    
	}
	function test2()
	{
		$this->db->select('a.bus_fee_collection_master_id,a.student_id');
		$this->db->join('student b','b.student_id=a.student_id and b.student_status_id=0');
		$this->db->group_by('a.student_id');
		$this->db->where('class_id','10');
		$this->db->where('section_id','23');
		$data   =   $this->db->get('tbl_transport_students_bus_fee_collection_master a')->result_array();
		//echo count($data);
		$tot	=	0;
		foreach($data as $row)
		{
			$this->db->select('bus_fee_collection_master_id');
			$this->db->where('student_id',$row['student_id']);
			$data1  =   $this->db->get('tbl_transport_students_bus_fee_collection_master')->result_array();
			$sum    =   0;    
			foreach($data1 as $row1)
			{
				$this->db->select('sum(fee_amount) as fee_amount');
				$this->db->where('bus_fee_collection_master_id',$row1['bus_fee_collection_master_id']);
				$sum    =   $sum+$this->db->get('tbl_transport_students_bus_fee_collection_details')->row()->fee_amount;
			}
			
			$this->db->select('(sum(fee_amount)-sum(fee_balance)-sum(fee_concession)) as total');
			$this->db->where('student_id',$row['student_id']);
                        $this->db->where('is_deleted','N');
			$total      =   $this->db->get('tbl_transport_students_bus_fee_master')->row()->total;
			//echo $sum."<br>".$total;die;
			if($sum!=$total)
			{
				echo $row['student_id']."<br>";
			}
			$tot	=	$tot+$sum;
		}    
		echo $tot;
	}
	function test3()
	{
		$this->db->where('academic_year_id','6');
		$this->db->where('is_deleted','N');
		$res	=	$this->db->get('tbl_students_fee_master')->result_array();
		$count	=	0;
		foreach($res as $row):
			$this->db->where('student_id',$row['admission_number']);
			$this->db->where('year','6');
			$section_id	=	$this->db->get('enroll')->row()->section_id;
			if($section_id!=$row['batch_id'])
			{
				echo $row['admission_number']."<br>";
				$count++;
			}
			
		endforeach;
		echo "<br><br>Count=".$count;
	}
        
/************* Edit Special Receipt Start ***********************/
	function edit_specialfee_receipt_view()
	{
		$data['receipts']	=	$this->Fee_management_model->get_specialfee_receipts();
		//print_r($data['receipts']);die;
		$this->load->view('admin/edit_specialfee_receipt_view',$data);
	}

	function get_specialfee_receipt_details($receipt_number)
	{
		$data['results']            =	$this->Fee_management_model->get_specialfee_receipt_details($receipt_number);
		$data['receipt_number']     =	$receipt_number;
		$this->load->view('admin/edit_specialfee_receipt_view1',$data);
	}

	function update_specialfee_receipt()
	{
		$special_fee_collection_master_id		=	$this->input->post('special_fee_collection_master_id[]');
		$fee_head_id							=	$this->input->post('fee_head_id[]');
		$student_id								=	$this->input->post('student_id');
		$actual_receipt_num						=	$this->input->post('actual_receipt_number');
		$edit_receipt_num						=	$this->input->post('edit_receipt_number');
		$amount									=	$this->input->post('amount[]');
//		print_r($special_fee_collection_master_id);die;
		$this->db->db_debug				=	FALSE;
		$this->db->trans_start();
		for($i=0;$i<count($special_fee_collection_master_id);$i++)      
		{
			$this->db->set('fee_amount',$amount[$i]);
			$this->db->where('special_fee_collection_master_id',$special_fee_collection_master_id[$i]);
			$this->db->update('tbl_special_fee_collection_master');
		}
		
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('action','failed');
		}	
		else
		{
			//Update receipt number
			$this->db->set('receipt_number',$edit_receipt_num);
			$this->db->where('receipt_number',$actual_receipt_num);
			$this->db->update('tbl_special_fee_collection_master');
			
			
			if($edit_receipt_num!=$actual_receipt_num)
			{
				$year	=	get_running_year();
				$this->db->set('voucher_number',$edit_receipt_num);	
				$this->db->where('branch_id',$this->session->userdata('branch_id'));
				$this->db->where('voucher_type_name','Receipt');
				$this->db->where('academic_year_id',$year);
				$this->db->update('tbl_voucher'); //echo $this->db->last_query();die;
			}
			
			$this->session->set_flashdata('action','success');
		}	
		redirect('FeeManagement/edit_specialfee_receipt_view');
	}

	function delete_specialfee_receipt($receipt_number)
	{
		if($receipt_number!='')
		{
			$result		=	$this->Fee_management_model->delete_specialfee_receipt($receipt_number);
			if($result == TRUE)
			{
				$this->session->set_flashdata('action','receipt_deleted');
			}
			else
			{
				$this->session->set_flashdata('action','receipt_not_deleted');
			}
		}
	}

/************* Edit Special Receipt Ends ***********************/

/************* Fee Head wise collection Report start ***********************/
 
 	function fee_head_wise_collection_report(){
		$this->load->view('admin/fee_head_wise_collection_report');
	} 
	
	function get_fee_head_wise_report()
	{
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
		$department 			= $this->uri->segment(5); 
		$class_id 				= $this->uri->segment(6);
		$section_id 			= $this->uri->segment(7);
		$data['department'] 	= 	$department; 
		$data['class_id'] 		= 	$class_id;
		$data['section_id'] 	= 	$section_id;
		$data['from_date'] 		= 	$from_date;
		$data['to_date'] 		= 	$to_date;
		$data['student_fee']    =   $this->Fee_management_model->get_fee_head_wise_report($department,$class_id,$section_id,$from_date,$to_date);
		$this->load->view('admin/fee_head_wise_collection_data.php',$data);

	}
	function fee_head_wise_report_pdf()
	{
		ob_start();
		$html 					=	ob_get_clean();
		$html 					= 	utf8_encode($html);
		
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
		$department 			= $this->uri->segment(5); 
		$class_id 				= $this->uri->segment(6);
		$section_id 			= $this->uri->segment(7);
		$data['student_fee']    =   $this->Fee_management_model->get_fee_head_wise_report($department,$class_id,$section_id,$from_date,$to_date);                
        $html  					=  $this->load->view('admin/fee_head_wise_collection_report_pdf.php',$data,true);
		include(APPPATH.'third_party/mpdf/mpdf.php');
		$mpdf 					= new mPDF('en-GB-x','A4','','',10,10,10,10,6,3);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->allow_charset_conversion 		= true;
		$mpdf->charset_in = 'UTF-8';
		$mpdf->WriteHTML($html);
		$mpdf->Output('Fee head wise Collection report.pdf','I');	//  I for view or create pdf  and D for download	
	}
	function fee_head_wise_report_excel()
	{
		$from_date	 			= $this->uri->segment(3);
		$to_date	 			= $this->uri->segment(4);
		$department 			= $this->uri->segment(5); 
		$class_id 				= $this->uri->segment(6);
		$section_id 			= $this->uri->segment(7);
            $data['student_fee']    =   $this->Fee_management_model->get_fee_head_wise_report($department,$class_id,$section_id,$from_date,$to_date); 

            $i=1;
            ob_start();
            ob_get_clean();
            $filename = "FeeCollectionReport.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
            //$this->exportExcelData($dataToExports);
            $total = 0;
            $i=1;
            $image_url = base_url() . 'uploads/logo.png';
            echo  "<table border='0'><tr><td colspan='1'></td><td colspan='1' align='center'><img src=".$image_url." height='9%' width='12%' style='padding-left:100px'></td><td colspan='1'></td></tr>";
            echo "<tr><td colspan='3'></td></tr>";
            //$dataToExports = [];
            echo  "<table border='0'><tr><td colspan='3' align='center'></td></tr>";
            echo "<tr><td colspan='3' align='center'><h3></br>".get_school()."</h3></b><h4>".get_school_address().",Phone:".get_school_phone()."<br>".get_school_mail()."</h4></td></tr>";	
            echo  "<table border='0'><tr><td colspan='3' align='center'><b><h3>FEE COLLECTION REPORT</h3></b></td></tr>";
            echo "<table border='1'><tr><td colspan='1'  align='left'>Sl.No.</td><td colspan='1'  align='left'>Fee Head Name</td><td colspan='1'  align='left'>Total Amount</td></tr>";
            $total  =   0;
            foreach ($data['student_fee'] as $row)
            {
			if($row['fee_amount']!=0){
			if($row['title']=="op"){$fee_head = "Last Year ".$row['fee_head'];} else { $fee_head = $row['fee_head'];}
                    echo "<tr><td colspan='1'  align='left'>".$i."</td><td colspan='1'  align='left'>".$fee_head."</td><td colspan='1'  align='left'>".$row['fee_amount']."</td></tr>";
                    //$dataToExports[]			= $arrangeData;
                    $i=$i+1;
                    $total  +=  $row['fee_amount'];   
            } }
            echo '<tr><th colspan="2" style="text-align: right;">Total</th><th style="text-align: right;">'.number_format($total,2).'</th></tr></table>';
            die();

	}

/************* Fee Head wise collection Report ends ***********************/
}
