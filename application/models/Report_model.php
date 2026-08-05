<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get student list report dataset for export/print
     *
     * @param int $class_id
     * @param int $section_id
     * @param string $year
     * @return array
     */
    public function get_student_report_data($class_id = 0, $section_id = 0, $year = '') {
        $this->db->select('s.student_id, s.name, s.admission_number, s.phone1, s.phone2, s.address, s.email, s.sex, e.roll, e.class_id, e.section_id, c.name as class_name, sec.name as section_name');
        $this->db->from('student s');
        $this->db->join('enroll e', 'e.student_id = s.student_id', 'INNER');
        $this->db->join('class c', 'c.class_id = e.class_id', 'LEFT');
        $this->db->join('section sec', 'sec.section_id = e.section_id', 'LEFT');

        if ($class_id !== '' && $class_id !== null) {
            $this->db->where('e.class_id', $class_id);
        }
        if ($section_id > 0) {
            $this->db->where('e.section_id', $section_id);
        }
        if (!empty($year)) {
            $this->db->where('e.year', $year);
        }

        $this->db->group_by('s.student_id');
        $this->db->order_by('e.roll', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Get student marks report dataset for export
     *
     * @param int $class_id
     * @param int $section_id
     * @param int $exam_id
     * @param string $year
     * @return array
     */
    public function get_marks_report_data($class_id, $section_id, $exam_id, $year) {
        $this->db->select('m.student_id, m.mark_obtained, m.mark_total, m.grade, m.position, s.name as student_name, sub.name as subject_name, e.roll');
        $this->db->from('mark m');
        $this->db->join('student s', 's.student_id = m.student_id', 'INNER');
        $this->db->join('subject sub', 'sub.subject_id = m.subject_id', 'INNER');
        $this->db->join('enroll e', 'e.student_id = m.student_id AND e.year = ' . $this->db->escape($year), 'LEFT');
        $this->db->where('m.class_id', $class_id);
        if ($section_id > 0) {
            $this->db->where('m.section_id', $section_id);
        }
        $this->db->where('m.exam_id', $exam_id);
        $this->db->where('m.year', $year);
        $this->db->order_by('e.roll', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Get fee collection abstract report
     *
     * @param string $from_date
     * @param string $to_date
     * @param string $year
     * @return array
     */
    public function get_fee_collection_report_data($from_date = '', $to_date = '', $year = '') {
        $this->db->select('f.fee_collection_master_id, f.receipt_no, f.paid_amount, f.collection_date, f.payment_mode, s.name as student_name, s.admission_number');
        $this->db->from('tbl_fee_collection_master f');
        $this->db->join('student s', 's.student_id = f.student_id', 'INNER');
        if (!empty($from_date)) {
            $this->db->where('f.collection_date >=', $from_date);
        }
        if (!empty($to_date)) {
            $this->db->where('f.collection_date <=', $to_date);
        }
        if (!empty($year)) {
            $this->db->where('f.academic_year', $year);
        }
        $this->db->order_by('f.collection_date', 'DESC');
        return $this->db->get()->result_array();
    }
}
