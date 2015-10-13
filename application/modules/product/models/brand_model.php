<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Brand_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = 'gtech_brand';
       }

       public function getBrands($id = '') {
            $this->db->select("*");
            $this->db->from($this->table);
            if (!empty($id)) {
                 $this->db->where('brd_id', $id);
            }
            $this->db->order_by('brd_id', 'desc');
            $brands = $this->db->get()->result_array();
            return $brands;
       }
       
       public function getCount() {
            return $this->db->count_all($this->table);
       }
       
       public function getBrandPagination($perPage, $offset) {
            return $this->db->get($this->table, $perPage, $offset)->result_array();
       }
       
       /* 22-08-2015 */

       function getBrandByName($name) {
            $name = str_replace('_', ' ', strtolower($name));
            if ($name) {
                 $this->db->select('*')->from($this->table);
                 $this->db->where('brd_title', $name);
                 return $this->db->get()->row_array();
                  //echo $this->db->last_query();
            } else {
                 return null;
            }
       }

       /* 22-08-2015 */
  } 