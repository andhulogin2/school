<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Check if receipt number already exists
     *
     * @param string $receipt_no
     * @return bool
     */
    public function check_duplicate_receipt($receipt_no) {
        if (empty($receipt_no)) {
            return FALSE;
        }
        $this->db->where('receipt_no', $receipt_no);
        return ($this->db->count_all_results('tbl_fee_collection_master') > 0);
    }

    /**
     * Check for duplicate fee payment submission by student, fee master, and amount
     *
     * @param int $student_id
     * @param int $students_fee_master_id
     * @param float $amount
     * @param string $date
     * @return bool
     */
    public function check_duplicate_payment($student_id, $students_fee_master_id, $amount, $date) {
        $this->db->where('student_id', $student_id);
        $this->db->where('students_fee_master_id', $students_fee_master_id);
        $this->db->where('paid_amount', $amount);
        $this->db->where('collection_date', $date);
        return ($this->db->count_all_results('tbl_fee_collection_master') > 0);
    }

    /**
     * Process student fee collection inside a single atomic transaction
     *
     * @param array $master_data Data for tbl_fee_collection_master
     * @param array $details_data Array of detail records for tbl_fee_collection_details
     * @param array $updates_data Array of fee balance updates
     * @return int|false Receipt/Master ID on success, FALSE on failure
     */
    public function collect_fee_transaction($master_data, $details_data, $updates_data = array()) {
        $this->db->trans_start();

        // 1. Insert master collection record
        $this->db->insert('tbl_fee_collection_master', $master_data);
        $master_id = $this->db->insert_id();

        // 2. Insert detail collection records
        foreach ($details_data as $detail) {
            $detail['fee_collection_master_id'] = $master_id;
            $this->db->insert('tbl_fee_collection_details', $detail);
        }

        // 3. Update student fee balance details
        foreach ($updates_data as $update) {
            $this->db->where('students_fee_details_id', $update['students_fee_details_id']);
            $this->db->update('tbl_students_fee_details', array('fee_balance' => $update['fee_balance']));
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $master_id;
    }

    /**
     * Retrieve payment collection history for a student
     *
     * @param int $student_id
     * @return array
     */
    public function get_student_payment_history($student_id) {
        $this->db->select('fee_collection_master_id, receipt_no, paid_amount, collection_date, payment_mode, academic_year');
        $this->db->from('tbl_fee_collection_master');
        $this->db->where('student_id', $student_id);
        $this->db->order_by('collection_date', 'DESC');
        return $this->db->get()->result_array();
    }
}
