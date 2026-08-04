<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get system setting value by type key
     *
     * @param string $type
     * @param string $default
     * @return string
     */
    public function get_setting_value($type, $default = '') {
        $this->db->select('description');
        $this->db->from('settings');
        $this->db->where('type', $type);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->description;
        }
        return $default;
    }

    /**
     * Get all system settings as associative array
     *
     * @return array
     */
    public function get_all_settings() {
        $this->db->select('settings_id, type, description');
        $this->db->from('settings');
        $query = $this->db->get();

        $settings = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $settings[$row['type']] = $row['description'];
            }
        }
        return $settings;
    }

    /**
     * Update setting value inside a transaction
     *
     * @param string $type
     * @param string $description
     * @return bool
     */
    public function update_setting_transaction($type, $description) {
        $this->db->trans_start();

        $this->db->where('type', $type);
        if ($this->db->count_all_results('settings') > 0) {
            $this->db->where('type', $type);
            $this->db->update('settings', array('description' => $description));
        } else {
            $this->db->insert('settings', array('type' => $type, 'description' => $description));
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
