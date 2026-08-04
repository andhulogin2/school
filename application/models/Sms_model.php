<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sms_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get active SMS settings
     *
     * @return object|false
     */
    public function get_sms_settings() {
        $this->db->select('sms_setting_id, sms_service, api_key, sender_id, username, password');
        $this->db->from('sms_settings');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return FALSE;
    }

    /**
     * Get SMS templates
     *
     * @return array
     */
    public function get_sms_templates() {
        $this->db->select('sms_template_id, name, template');
        $this->db->from('sms_template');
        return $this->db->get()->result_array();
    }

    /**
     * Log SMS delivery record inside a transaction
     *
     * @param array $log_data
     * @return bool
     */
    public function log_sms_transaction($log_data) {
        $this->db->trans_start();

        $this->db->insert('tbl_sms_logs', $log_data);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
