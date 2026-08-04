<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Analytics_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get monthly fee collection summary for analytics charts
     *
     * @param string $year
     * @return array
     */
    public function get_monthly_collection_summary($year) {
        $this->db->select('MONTH(collection_date) as month_num, SUM(paid_amount) as total_amount');
        $this->db->from('tbl_fee_collection_master');
        $this->db->where('academic_year', $year);
        $this->db->group_by('MONTH(collection_date)');
        $this->db->order_by('month_num', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Get monthly expense summary for analytics charts
     *
     * @param string $year
     * @return array
     */
    public function get_monthly_expense_summary($year) {
        $this->db->select('MONTH(FROM_UNIXTIME(timestamp)) as month_num, SUM(amount) as total_amount');
        $this->db->from('payment');
        $this->db->where('payment_type', 'expense');
        $this->db->where('year', $year);
        $this->db->group_by('MONTH(FROM_UNIXTIME(timestamp))');
        $this->db->order_by('month_num', 'ASC');
        return $this->db->get()->result_array();
    }
}
