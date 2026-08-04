<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get notice/news by ID or news_code
     *
     * @param string $news_code
     * @return object|false
     */
    public function get_notice_by_code($news_code) {
        $this->db->select('news_id, title, description, news_code, timestamp');
        $this->db->from('news');
        $this->db->where('news_code', $news_code);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get list of notices/news
     *
     * @param int $limit
     * @return array
     */
    public function get_all_notices($limit = 50) {
        $this->db->select('news_id, title, description, news_code, timestamp');
        $this->db->from('news');
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate notice by title and date
     *
     * @param string $title
     * @return bool
     */
    public function check_duplicate_notice($title) {
        $this->db->where('title', $title);
        return ($this->db->count_all_results('news') > 0);
    }

    /**
     * Add new notice inside a transaction
     *
     * @param array $data_notice
     * @return int|false Notice ID or FALSE
     */
    public function add_notice_transaction($data_notice) {
        $this->db->trans_start();

        $this->db->insert('news', $data_notice);
        $notice_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $notice_id;
    }
}
