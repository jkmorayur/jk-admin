<?php

  if (!defined('BASEPATH'))
       exit('No direct script access allowed');

  class Product_model extends CI_Model {

       public function __construct() {
            parent::__construct();
            $this->load->database();
            $this->table = TABLE_PREFIX . 'products';
       }

       public function getProduct($id = '') {
            $this->db->select($this->table . '.*, ' . TABLE_PREFIX . 'category.cat_id AS sub_category,' . TABLE_PREFIX . 'category.cat_title AS sub_category_name , ' . TABLE_PREFIX . 'brand.*, '
                    . 'cat1.cat_id AS category_id, cat1.cat_title AS category_name')->from($this->table);
            $this->db->join(TABLE_PREFIX . 'brand', TABLE_PREFIX . 'brand.brd_id = ' . $this->table . '.prd_brand', 'left');
            $this->db->join(TABLE_PREFIX . 'category', TABLE_PREFIX . 'category.cat_id = ' . $this->table . '.prd_category ', 'left');
            $this->db->join(TABLE_PREFIX . 'category cat1', 'cat1.cat_id = ' . TABLE_PREFIX . 'category.cat_parent ', 'left');
            if ($id) {
                 $this->db->where($this->table . '.prd_id', $id);
            }
            $productsArray = $this->db->get()->result_array();

            $products['product_details'] = array();
            $products['product_specification'] = array();
            $products['product_images'] = array();
            if (!empty($productsArray)) {
                 foreach ($productsArray as $key => $value) {
                      $prodSpecifications = $this->db->order_by("spe_id", "asc")->get_where(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $value['prd_id']))->result_array();
                      $prodImages = $this->db->get_where(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $value['prd_id']))->result_array();
                      $prodDocs = $this->db->get_where(TABLE_PREFIX . 'prod_docs', array('pdc_prod_id' => $value['prd_id']))->result_array();
                      $products['product_docs'] = $prodDocs;
                      if ($id) {
                           $products['product_details'] = $value;
                      } else {
                           $products['product_details'][] = $value;
                      }
                      $products['product_specification'] = $prodSpecifications;
                      $products['product_images'] = $prodImages;
                 }
            }
            return $products;
       }

       public function addNewProduct($datas) {

            if ($this->db->insert($this->table, $datas['product'])) {
                 $lastId = $this->db->insert_id();

                 $specifications = $datas['specification'];
                 if ($specifications) {
                      for ($i = 0; $i < count($specifications['spe_specification']); $i++) {
                           if (!empty($specifications['spe_specification'][$i]) || !empty($specifications['spe_specification_detail'][$i])) {
                                $specifi = array(
                                    'spe_prod_id' => $lastId,
                                    'spe_specification' => $specifications['spe_specification'][$i],
                                    'spe_specification_detail' => $specifications['spe_specification_detail'][$i],
                                );
                                $this->db->insert(TABLE_PREFIX . 'prod_specifications', $specifi);
                           }
                      }
                 }

                 return $lastId;
            } else {
                 return false;
            }
       }

       public function addImages($image) {
            if ($this->db->insert(TABLE_PREFIX . 'prod_images', $image)) {
                 return true;
            } else {
                 return false;
            }
       }

       public function addProductDocs($data) {
            if ($this->db->insert(TABLE_PREFIX . 'prod_docs', $data)) {
                 return true;
            } else {
                 return false;
            }
       }

       public function removePrductImage($id) {
            if ($id) {
                 $this->db->where('pdi_id', $id);
                 $image = $this->db->get(TABLE_PREFIX . 'prod_images')->result_array();
                 $image = isset($image['0']) ? $image['0'] : array();
                 if (isset($image['pdi_image']) && !empty($image['pdi_image'])) {
                      if (file_exists('./assets/uploads/product/' . $image['pdi_image'])) {
                           unlink('./assets/uploads/product/' . $image['pdi_image']);
                      }
                      $this->db->where('pdi_id', $id);
                      $this->db->delete(TABLE_PREFIX . 'prod_images');
                      return true;
                 }
            }
            return false;
       }

       public function removePrductDocs($id) {
            if ($id) {
                 $this->db->where('pdc_id', $id);
                 $image = $this->db->get(TABLE_PREFIX . 'prod_docs')->result_array();
                 $image = isset($image['0']) ? $image['0'] : array();
                 if (isset($image['pdc_title']) && !empty($image['pdc_title'])) {
                      if (file_exists('./assets/uploads/product_docs/' . $image['pdc_title'])) {
                           unlink('./assets/uploads/product_docs/' . $image['pdc_title']);
                      }
                      $this->db->where('pdc_id', $id);
                      $this->db->delete(TABLE_PREFIX . 'prod_docs');
                      return true;
                 }
            }
            return false;
       }

       public function updateProduct($datas) {

            if (isset($datas['prd_id']) && !empty($datas['prd_id'])) {
                 $this->db->where('prd_id', $datas['prd_id']);
//                 $datas['product']['prd_show_on_home'] = 
//                         isset($datas['product']['prd_show_on_home']) ? $datas['product']['prd_show_on_home'] : 0;

                 $datas['product']['prd_is_featured'] = isset($datas['product']['prd_is_featured']) ? $datas['product']['prd_is_featured'] : 0;

                 $datas['product']['prd_in_stock'] = isset($datas['product']['prd_in_stock']) ? $datas['product']['prd_in_stock'] : 0;

                 if ($this->db->update($this->table, $datas['product'])) {
                      $prodId = $datas['prd_id'];
                      $specifications = $datas['specification'];

                      $this->db->delete(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $prodId));
                      if ($specifications) {
                           for ($i = 0; $i < count($specifications['spe_specification']); $i++) {
                                if (!empty($specifications['spe_specification'][$i]) || !empty($specifications['spe_specification_detail'][$i])) {
                                     $specifi = array(
                                         'spe_prod_id' => $prodId,
                                         'spe_specification' => $specifications['spe_specification'][$i],
                                         'spe_specification_detail' => $specifications['spe_specification_detail'][$i],
                                     );
                                     $this->db->insert(TABLE_PREFIX . 'prod_specifications', $specifi);
                                }
                           }
                      }
                      return true;
                 } else {
                      return false;
                 }
            } else {
                 return false;
            }
       }

       public function deleteProduct($id) {
            if (!empty($id)) {
                 $this->db->delete($this->table, array('prd_id' => $id));
                 $this->db->delete(TABLE_PREFIX . 'prod_specifications', array('spe_prod_id' => $id));

                 $this->db->where('pdi_prod_id', $id);
                 $images = $this->db->get(TABLE_PREFIX . 'prod_images')->result_array();
                 $this->db->delete(TABLE_PREFIX . 'prod_images', array('pdi_prod_id' => $id));
                 if (!empty($images)) {
                      foreach ($images as $key => $value) {
                           if (file_exists('./assets/uploads/product/' . $value['pdi_image'])) {
                                unlink('./assets/uploads/product/' . $value['pdi_image']);
                           }
                      }
                 }
                 return true;
            } else {
                 return false;
            }
       }

       /* related to excel import */

       function getBrandIdByBrandName($brandName) {
            $brandName = trim($brandName);
            if (!empty($brandName)) {
                 $result = $this->db->select('brd_id')->from(TABLE_PREFIX . 'brand')->
                                 like('brd_title', $brandName)->get()->row_array();
                 if (isset($result['brd_id']) && !empty($result['brd_id'])) {
                      return $result['brd_id'];
                 } else {
                      return null;
                 }
            } else {
                 return null;
            }
       }

       function getCategoryIdByCategoryName($categoryName) {
            $categoryName = trim($categoryName);
            if (!empty($categoryName)) {
                 $result = $this->db->select('cat_id')->from(TABLE_PREFIX . 'category')->
                                 like('cat_title', $categoryName)->get()->row_array();
                 if (isset($result['cat_id']) && !empty($result['cat_id'])) {
                      return $result['cat_id'];
                 } else {
                      return null;
                 }
            } else {
                 return null;
            }
       }

       function importNewProduct($datas) {
            if (!empty($datas)) {
                 $datas['prd_from_excel'] = 1;
                 if ($this->db->insert(TABLE_PREFIX . 'products', $datas)) {
                      return $this->db->insert_id();
                 }
            }
       }

       function addNewProductSpecification($datas) {
            if (!empty($datas)) {
                 if ($this->db->insert(TABLE_PREFIX . 'prod_specifications', $datas)) {
                      return $this->db->insert_id();
                 }
            }
       }

       function addNewProductImage($datas) {
            if (!empty($datas)) {
                 if ($this->db->insert(TABLE_PREFIX . 'prod_images', $datas)) {
                      return $this->db->insert_id();
                 }
            }
       }

       /* related to excel import */
  }
  