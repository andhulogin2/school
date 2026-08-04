<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Check if student attendance is already recorded for a specific date, class, section, and year
     *
     * @param int $class_id
     * @param int $section_id
     * @param string $date
     * @param string $year
     * @return bool
     */
    public function check_duplicate_student_attendance($class_id, $section_id, $date, $year) {
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        $this->db->where('timestamp', strtotime($date));
        $this->db->where('year', $year);
        return ($this->db->count_all_results('attendance') > 0);
    }

    /**
     * Save or update student daily attendance inside a transaction
     *
     * @param int $class_id
     * @param int $section_id
     * @param string $date
     * @param array $attendance_records Array of ['student_id' => int, 'status' => int]
     * @param string $year
     * @return bool
     */
    public function save_student_attendance_transaction($class_id, $section_id, $date, $attendance_records, $year) {
        $this->db->trans_start();

        $timestamp = strtotime($date);

        foreach ($attendance_records as $student_id => $status) {
            // Check if record exists for student, timestamp, and year
            $this->db->select('attendance_id');
            $this->db->from('attendance');
            $this->db->where('student_id', $student_id);
            $this->db->where('timestamp', $timestamp);
            $this->db->where('year', $year);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $attendance_id = $query->row()->attendance_id;
                $this->db->where('attendance_id', $attendance_id);
                $this->db->update('attendance', array(
                    'status'     => $status,
                    'class_id'   => $class_id,
                    'section_id' => $section_id
                ));
            } else {
                $this->db->insert('attendance', array(
                    'timestamp'  => $timestamp,
                    'year'       => $year,
                    'class_id'   => $class_id,
                    'section_id' => $section_id,
                    'student_id' => $student_id,
                    'status'     => $status
                ));
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Retrieve daily student attendance for a class, section, and date
     *
     * @param int $class_id
     * @param int $section_id
     * @param string $date
     * @param string $year
     * @return array
     */
    public function get_daily_student_attendance($class_id, $section_id, $date, $year) {
        $timestamp = strtotime($date);
        $this->db->select('a.attendance_id, a.student_id, a.status, a.class_id, a.section_id, a.timestamp, s.name as student_name, e.roll');
        $this->db->from('attendance a');
        $this->db->join('student s', 's.student_id = a.student_id', 'INNER');
        $this->db->join('enroll e', 'e.student_id = a.student_id AND e.year = ' . $this->db->escape($year), 'LEFT');
        $this->db->where('a.class_id', $class_id);
        $this->db->where('a.section_id', $section_id);
        $this->db->where('a.timestamp', $timestamp);
        $this->db->where('a.year', $year);
        $this->db->order_by('e.roll', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Retrieve monthly attendance for a student
     *
     * @param int $student_id
     * @param string $month
     * @param string $year
     * @return array
     */
    public function get_monthly_student_attendance($student_id, $month, $year) {
        $this->db->select('attendance_id, student_id, status, timestamp, year, class_id, section_id');
        $this->db->from('attendance');
        $this->db->where('student_id', $student_id);
        $this->db->where('year', $year);
        $this->db->order_by('timestamp', 'ASC');
        return $this->db->get()->result_array();
    }

    /**
     * Save teacher attendance record inside a transaction
     *
     * @param int $teacher_id
     * @param string $date
     * @param int $status
     * @return bool
     */
    public function save_teacher_attendance_transaction($teacher_id, $date, $status) {
        $this->db->trans_start();

        $timestamp = strtotime($date);
        $this->db->select('teacher_attendance_id');
        $this->db->from('tbl_teacher_attendance');
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('att_date', date('Y-m-d', $timestamp));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $this->db->where('teacher_attendance_id', $query->row()->teacher_attendance_id);
            $this->db->update('tbl_teacher_attendance', array('status' => $status));
        } else {
            $this->db->insert('tbl_teacher_attendance', array(
                'teacher_id' => $teacher_id,
                'att_date'   => date('Y-m-d', $timestamp),
                'status'     => $status
            ));
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Save staff attendance record inside a transaction
     *
     * @param int $staff_id
     * @param string $date
     * @param int $status
     * @return bool
     */
    public function save_staff_attendance_transaction($staff_id, $date, $status) {
        $this->db->trans_start();

        $timestamp = strtotime($date);
        $this->db->select('staff_attendance_id');
        $this->db->from('tbl_staff_attendance');
        $this->db->where('staff_id', $staff_id);
        $this->db->where('att_date', date('Y-m-d', $timestamp));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $this->db->where('staff_attendance_id', $query->row()->staff_attendance_id);
            $this->db->update('tbl_staff_attendance', array('status' => $status));
        } else {
            $this->db->insert('tbl_staff_attendance', array(
                'staff_id' => $staff_id,
                'att_date' => date('Y-m-d', $timestamp),
                'status'   => $status
            ));
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
