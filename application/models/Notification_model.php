<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get user notifications with explicit column selection
     *
     * @param int $user_id
     * @param int $limit
     * @return array
     */
    public function get_user_notifications($user_id, $limit = 20) {
        $this->db->select('notification_id, title, message, url, is_read, timestamp, year');
        $this->db->from('notification');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Check duplicate notification for user, title, and timestamp
     *
     * @param int $user_id
     * @param string $title
     * @param string $message
     * @return bool
     */
    public function check_duplicate_notification($user_id, $title, $message) {
        $this->db->where('user_id', $user_id);
        $this->db->where('title', $title);
        $this->db->where('message', $message);
        return ($this->db->count_all_results('notification') > 0);
    }

    /**
     * Save notification inside a transaction
     *
     * @param array $data_notification
     * @return int|false Notification ID or FALSE
     */
    public function add_notification_transaction($data_notification) {
        $this->db->trans_start();

        $this->db->insert('notification', $data_notification);
        $notification_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        }

        return $notification_id;
    }

    /**
     * Bulk insert notifications for multiple user IDs inside a transaction
     *
     * @param array $user_ids List of target user IDs
     * @param string $title
     * @param string $message
     * @param string $url
     * @param string $year
     * @return bool
     */
    public function send_bulk_notifications_transaction($user_ids, $title, $message, $url = '', $year = '') {
        $this->db->trans_start();

        $timestamp = time();
        foreach ($user_ids as $uid) {
            if (!$this->check_duplicate_notification($uid, $title, $message)) {
                $this->db->insert('notification', array(
                    'user_id'   => $uid,
                    'title'     => $title,
                    'message'   => $message,
                    'url'       => $url,
                    'is_read'   => 0,
                    'timestamp' => $timestamp,
                    'year'      => $year
                ));
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
