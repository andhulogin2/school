<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Expense_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get list of expense categories
     *
     * @return array
     */
    public function get_expense_categories() {
        $this->db->select('expense_category_id, name');
        $this->db->from('expense_category');
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Get expense listing for academic year and branch
     *
     * @param string $year
     * @param int $branch_id
     * @return array
     */
    public function get_expenses($year = '', $branch_id = 0) {
        $this->db->select('e.payment_id, e.expense_category_id, e.title, e.description, e.amount, e.timestamp, e.year, ec.name as category_name');
        $this->db->from('payment e');
        $this->db->join('expense_category ec', 'ec.expense_category_id = e.expense_category_id', 'LEFT');
        $this->db->where('e.payment_type', 'expense');
        if (!empty($year)) {
            $this->db->where('e.year', $year);
        }
        $this->db->order_by('e.timestamp', 'DESC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate expense entry by title, amount, and timestamp
     *
     * @param string $title
     * @param float $amount
     * @param string $date
     * @return bool
     */
    public function check_duplicate_expense($title, $amount, $date) {
        $timestamp = strtotime($date);
        $this->db->where('title', $title);
        $this->db->where('amount', $amount);
        $this->db->where('timestamp', $timestamp);
        $this->db->where('payment_type', 'expense');
        return ($this->db->count_all_results('payment') > 0);
    }

    /**
     * Insert expense inside a transaction
     *
     * @param array $data_expense
     * @return int|false Payment/Expense ID or FALSE
     */
    public function add_expense_transaction($data_expense) {
        $this->db->trans_start();

        $data_expense['payment_type'] = 'expense';
        $this->db->insert('payment', $data_expense);
        $expense_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $expense_id;
    }
}
