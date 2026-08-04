<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get exam by ID
     *
     * @param int $exam_id
     * @return object|false
     */
    public function get_exam_by_id($exam_id) {
        $this->db->select('exam_id, name, date, comment, year, branch_id, dept_id');
        $this->db->from('exam');
        $this->db->where('exam_id', $exam_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get list of exams by year and optional branch filter
     *
     * @param string $year
     * @param int $branch_id
     * @return array
     */
    public function get_all_exams($year = '', $branch_id = 0) {
        $this->db->select('exam_id, name, date, comment, year, branch_id, dept_id');
        $this->db->from('exam');
        if (!empty($year)) {
            $this->db->where('year', $year);
        }
        if ($branch_id > 0) {
            $this->db->where('branch_id', $branch_id);
        }
        $this->db->order_by('date', 'DESC');
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate exam name for academic year and branch
     *
     * @param string $exam_name
     * @param string $year
     * @param int $branch_id
     * @return bool
     */
    public function check_duplicate_exam($exam_name, $year, $branch_id = 0) {
        $this->db->where('name', $exam_name);
        $this->db->where('year', $year);
        if ($branch_id > 0) {
            $this->db->where('branch_id', $branch_id);
        }
        return ($this->db->count_all_results('exam') > 0);
    }

    /**
     * Create new exam inside a transaction
     *
     * @param array $data_exam
     * @return int|false Exam ID or FALSE
     */
    public function add_exam_transaction($data_exam) {
        $this->db->trans_start();

        $this->db->insert('exam', $data_exam);
        $exam_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }
        return $exam_id;
    }

    /**
     * Update exam details
     *
     * @param int $exam_id
     * @param array $data_exam
     * @return bool
     */
    public function update_exam_transaction($exam_id, $data_exam) {
        $this->db->trans_start();

        $this->db->where('exam_id', $exam_id);
        $this->db->update('exam', $data_exam);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Delete exam safely
     *
     * @param int $exam_id
     * @return bool
     */
    public function delete_exam_transaction($exam_id) {
        $this->db->trans_start();

        $this->db->where('exam_id', $exam_id);
        $this->db->delete('mark');

        $this->db->where('exam_id', $exam_id);
        $this->db->delete('exam');

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
