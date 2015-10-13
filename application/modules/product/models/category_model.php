<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Category_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = 'gtech_category';
       }

       public function getCategories($id = '') {
            $this->db->select("*");
            $this->db->from($this->table);
            $this->db->where('cat_parent', 0);
            if (!empty($id)) {
                 $this->db->where('cat_id', $id);
            }
            $this->db->order_by('cat_id', 'desc');
            $brands = (!$id) ? $this->db->get()->result_array() : $this->db->get()->row_array();
            return $brands;
       }

       public function getSubCategories($categoryId = '') {
            $this->db->select("*");
            $this->db->from($this->table);

            if (!empty($categoryId) || $categoryId == 0) {
                 $this->db->where('cat_parent', $categoryId);
            } else {
                 $this->db->where('cat_parent !=', 0);
            }
            $this->db->order_by('cat_id', 'desc');
            $brands = $this->db->get()->result_array();
            return $brands;
       }

       function getParentCategory($id, $limit = '', $start = '') {
            $this->load->model('product_model');
            $this->db->select('*')->from($this->table);
            if ($id) {
                 $this->db->where('cat_parent', $id);
            }
            if (!empty($limit)) {
                 $this->db->limit($limit, $start);
            }
            $resultTmp = $this->db->get()->result_array();

            $result = array();
            if (!empty($resultTmp)) {
                 foreach ($resultTmp as $key => $value) {
                      $value['cat_subcate_count'] = $this->getSubcategoryCount($value['cat_id']);
                      $products = $this->product_model->getProductsByCategory($value['cat_id']);
                      $value['product_count'] = isset($products['product_details']) ? count($products['product_details']) : 0;
                      $result[] = $value;
                 }
            }
            return $result;
       }

       function getSubcategoryCount($id) {
            $this->db->like('cat_parent', $id);
            $this->db->from($this->table);
            return $this->db->count_all_results();
       }

       function getSingleCategory($catId) {
            if ($catId) {
                 $this->db->like('cat_id', $catId);
                 $this->db->from($this->table);
                 return $this->db->get()->row_array();
            }
       }

       function getRootCategory($inputId = 0, $idList = array()) {

            $this->db->where('cat_id', $inputId);
            $result = $this->db->get($this->table)->result_array();

            if ($result) {
                 $currentId = $result[0]["cat_id"];
                 $parentId = $result[0]["cat_parent"];

                 $idList[] = $currentId;

                 if ($parentId != 0) {
                      return $this->getRootCategory($parentId, $idList);
                 }
            }
            return $idList;
       }

       /* 22-08-2015 */

       function getCategoryByName($name, $isParent = false) {
            $name = str_replace('_', ' ', strtolower($name));
            if ($name) {
                 $this->db->select('*')->from($this->table);
                 $this->db->where('cat_title', $name);
                 if ($isParent == true) {
                      $this->db->where('cat_parent', 0);
                 }
                 return $this->db->get()->row_array();
                  //echo $this->db->last_query();
            } else {
                 return null;
            }
       }

       /* 22-08-2015 */
  }
  