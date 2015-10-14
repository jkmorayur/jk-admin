<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class settings_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'settings';
       }

       function newSettings($values) {
            if (!empty($values)) {
                 foreach ($values as $key => $value) {
                      $this->dropSettingsByKey($key);
                      $insert['set_key'] = trim($key);
                      $insert['set_value'] = trim($value);
                      $this->db->insert($this->table, $insert);
                 }
                 return true;
            } else {
                 return false;
            }
       }

       function getSettings($key = '') {

            $this->db->select('*')->from($this->table);
            if (!empty($key)) {
                 return $this->db->where('set_key', $key)->get()->row_array();
            } else {
                 return $this->db->get()->result_array();
            }
       }

       function dropSettingsByKey($key) {
            if (!empty($key)) {
                 $this->db->where('set_key', $key);
                 $this->db->delete($this->table);
                 return true;
            } else {
                 return false;
            }
       }
  } 