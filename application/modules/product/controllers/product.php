<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Product extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'General Tech - Product';
            $this->load->model('brand_model', 'brand_model');
            $this->load->model('category_model', 'category_model');
            $this->load->model('product_model', 'product_model');
       }

       public function index() {
            $this->section = 'Product List';
            $data['productDetails'] = $this->product_model->getProduct();
            $this->current_section = 'Product';
            $this->render_page(__CLASS__ . '/list', $data);
       }

       public function add() {
            $this->section = 'Add New Product';
            $data['brands'] = $this->brand_model->getBrands();
            $data['category'] = array();//$this->category_model->categoryTree();
            $this->current_section = 'Product add';
            $this->render_page('product/add', $data);
       }

       public function insert() {

            if ($prdId = $this->product_model->addNewProduct($this->input->post())) {

                 $this->load->library('upload');
                 $x1 = $this->input->post('x1');
                 $fileCount = count($x1);
                 $up = array();
                 for ($j = 0; $j < $fileCount; $j++) {
                      /**/
                      $data = array();
                      $angle = array();
                      $newFileName = rand(9999999, 0) . $_FILES['prd_image']['name'][$j];
                      $config['upload_path'] = './assets/uploads/product/';
                      $config['allowed_types'] = 'gif|jpg|png';
                      $config['file_name'] = $newFileName;
                      $this->upload->initialize($config);

                      $angle['x1']['0'] = $_POST['x1'][$j];
                      $angle['x2']['0'] = $_POST['x2'][$j];
                      $angle['y1']['0'] = $_POST['y1'][$j];
                      $angle['y2']['0'] = $_POST['y2'][$j];
                      $angle['w']['0'] = $_POST['w'][$j];
                      $angle['h']['0'] = $_POST['h'][$j];

                      $_FILES['prd_image_tmp']['name'] = $_FILES['prd_image']['name'][$j];
                      $_FILES['prd_image_tmp']['type'] = $_FILES['prd_image']['type'][$j];
                      $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['prd_image']['tmp_name'][$j];
                      $_FILES['prd_image_tmp']['error'] = $_FILES['prd_image']['error'][$j];
                      $_FILES['prd_image_tmp']['size'] = $_FILES['prd_image']['size'][$j];
                      if (!$this->upload->do_upload('prd_image_tmp')) {
                           $up = array('error' => $this->upload->display_errors());
                      } else {
                           $data = array('upload_data' => $this->upload->data());
                           crop($this->upload->data(), $angle);
                           $this->product_model->addImages(array('pdi_prod_id' => $prdId, 'pdi_image' => $data['upload_data']['file_name']));
                      }
                 }
                 /* Upload for technical documents */
                 $upCount = isset($_FILES['prod_docs']['name']) ? count($_FILES['prod_docs']['name']) : 0;
                 if ($upCount > 0) {
                      for ($i = 0; $i < $upCount; $i++) {
                           $newFileName = rand(9999999, 0) . $_FILES['prod_docs']['name'][$i];
                           $config['upload_path'] = './assets/uploads/product_docs/';
                           $config['allowed_types'] = 'pdf|doc|docx';
                           $config['file_name'] = $newFileName;
                           $this->upload->initialize($config);

                           $_FILES['prd_doc']['name'] = $_FILES['prod_docs']['name'][$i];
                           $_FILES['prd_doc']['type'] = $_FILES['prod_docs']['type'][$i];
                           $_FILES['prd_doc']['tmp_name'] = $_FILES['prod_docs']['tmp_name'][$i];
                           $_FILES['prd_doc']['error'] = $_FILES['prod_docs']['error'][$i];
                           $_FILES['prd_doc']['size'] = $_FILES['prod_docs']['size'][$i];
                           if ($this->upload->do_upload('prd_doc')) {
                                $data = $this->upload->data();
                                $this->product_model->addProductDocs(array('pdc_prod_id' => $prdId, 'pdc_title' => $data['file_name']));
                           }
                      }
                 }
                 /* Upload for technical documents */
                 $this->session->set_flashdata('app_success', 'Product successfully added!');
            } else {
                 $this->session->set_flashdata('app_error', "Can't add product!");
            }
            redirect(strtolower(__CLASS__));
       }
       
       public function view($id) {
            $data['brands'] = $this->brand_model->getBrands();
            $data['productsDetails'] = $this->product_model->getProduct($id);
            $data['category'] = $this->category_model->categoryTree();
            $this->current_section = 'Product edit';
            $this->render_page(__CLASS__.'/view', $data);
       }
       
       public function removeImage($id) {
            if ($this->product_model->removePrductImage($id)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Product image successfully deleted'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't delete product image"));
            }
       }
       
       public function removeDocs($id) {
            if ($this->product_model->removePrductDocs($id)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Product document successfully deleted'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't delete product document"));
            }
       }
       
       public function update() {
            $prdId = $this->input->post('prd_id');
            if ($this->product_model->updateProduct($this->input->post())) {

                 $this->load->library('upload');
                 $x1 = $this->input->post('x1');
                 $fileCount = count($x1);
                 $up = array();
                 for ($j = 0; $j < $fileCount; $j++) {
                      /**/
                      $data = array();
                      $angle = array();
                      $newFileName = rand(9999999, 0) . $_FILES['prd_image']['name'][$j];
                      $config['upload_path'] = './assets/uploads/product/';
                      $config['allowed_types'] = 'gif|jpg|png';
                      $config['file_name'] = $newFileName;
                      $this->upload->initialize($config);

                      $angle['x1']['0'] = $_POST['x1'][$j];
                      $angle['x2']['0'] = $_POST['x2'][$j];
                      $angle['y1']['0'] = $_POST['y1'][$j];
                      $angle['y2']['0'] = $_POST['y2'][$j];
                      $angle['w']['0'] = $_POST['w'][$j];
                      $angle['h']['0'] = $_POST['h'][$j];

                      $_FILES['prd_image_tmp']['name'] = $_FILES['prd_image']['name'][$j];
                      $_FILES['prd_image_tmp']['type'] = $_FILES['prd_image']['type'][$j];
                      $_FILES['prd_image_tmp']['tmp_name'] = $_FILES['prd_image']['tmp_name'][$j];
                      $_FILES['prd_image_tmp']['error'] = $_FILES['prd_image']['error'][$j];
                      $_FILES['prd_image_tmp']['size'] = $_FILES['prd_image']['size'][$j];
                      if (!$this->upload->do_upload('prd_image_tmp')) {
                           $up = array('error' => $this->upload->display_errors());
                      } else {
                           $data = array('upload_data' => $this->upload->data());
                           crop($this->upload->data(), $angle);
                           $this->product_model->addImages(array('pdi_prod_id' => $prdId, 'pdi_image' => $data['upload_data']['file_name']));
                      }
                 }
                 /* Upload for technical documents */
                 $upCount = isset($_FILES['prod_docs']['name']) ? count($_FILES['prod_docs']['name']) : 0;
                 if ($upCount > 0) {
                      for ($i = 0; $i < $upCount; $i++) {
                           $newFileName = rand(9999999, 0) . $_FILES['prod_docs']['name'][$i];
                           $config['upload_path'] = './assets/uploads/product_docs/';
                           $config['allowed_types'] = 'pdf|doc|docx';
                           $config['file_name'] = $newFileName;
                           $this->upload->initialize($config);

                           $_FILES['prd_doc']['name'] = $_FILES['prod_docs']['name'][$i];
                           $_FILES['prd_doc']['type'] = $_FILES['prod_docs']['type'][$i];
                           $_FILES['prd_doc']['tmp_name'] = $_FILES['prod_docs']['tmp_name'][$i];
                           $_FILES['prd_doc']['error'] = $_FILES['prod_docs']['error'][$i];
                           $_FILES['prd_doc']['size'] = $_FILES['prod_docs']['size'][$i];
                           if ($this->upload->do_upload('prd_doc')) {
                                $data = $this->upload->data();
                                $this->product_model->addProductDocs(array('pdc_prod_id' => $prdId, 'pdc_title' => $data['file_name']));
                           }
                      }
                 }
                 /* Upload for technical documents */
                 $this->session->set_flashdata('app_success', 'Product successfully added!');
            } else {
                 $this->session->set_flashdata('app_error', "Can't add product!");
            }
            redirect(strtolower(__CLASS__));
       }
       
       public function delete($id) {
            if($this->product_model->deleteProduct($id)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Product successfully deleted'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't delete product"));
            }
       }
       
       public function import() {
            $this->current_section = 'Import Product';
            $this->render_page(__CLASS__ . '/import');
       }

       public function doImport() {
            
            require_once APPPATH . "/third_party/PHPExcel.php";
            $this->load->library('upload');
            $this->load->library('unzip');
            /*Upload product images*/
            $newFile = date('d_m_Y') . '_' . rand(9999999, 0);
            $newFileName = $newFile . '_' . $_FILES['image_zip']['name'];
            $dataUpload = array();
            $config['upload_path'] = './assets/uploads/product_zip/';
            $config['allowed_types'] = 'application/zip|zip';
            $config['file_name'] = $newFileName;
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('image_zip')) {
                print_r($this->upload->display_errors());
            } 
            $this->unzip->extract('./assets/uploads/product_zip/'.$newFileName, './assets/uploads/product/');
            /*Upload product images*/
            /*Upload product excel file*/
            $newFileName = $newFile . '_' . $_FILES['product_file']['name'];
            $config['upload_path'] = './assets/uploads/product_xls/';
            $config['allowed_types'] = 'xls|xlsx|csv';
            $config['file_name'] = $newFileName;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('product_file')) {
                 $dataUpload = $this->upload->data();
            }
            /*Upload product excel file*/
            
            /*Upload product technical docs*/
            $newFile = date('d_m_Y') . '_' . rand(9999999, 0);
            $newFileName = $newFile . '_' . $_FILES['pdf_zip']['name'];
            $dataUpload = array();
            $config['upload_path'] = './assets/uploads/product_zip/';
            $config['allowed_types'] = 'application/zip|zip';
            $config['file_name'] = $newFileName;
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('image_zip')) {
                print_r($this->upload->display_errors());
            } 
            $this->unzip->extract('./assets/uploads/product_zip/'.$newFileName, './assets/uploads/product/');
            /*Upload product technical docs*/
            
            $prodCount = $this->input->post('product_count');
            if (!empty($dataUpload) && $prodCount > 0) {
                 //here i used microsoft excel 2007
                 $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                 //set to read only
                 $objReader->setReadDataOnly(true);
                 //load excel file
                 $objPHPExcel = $objReader->load("./assets/uploads/product_xls/" . $newFileName);
                 $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                 //loop from first data until last data
                 $prodCount = $prodCount + 1;
                 for ($i = 2; $i <= $prodCount; $i++) {
                      $productArray = array();
                      $brand = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
                      $subCategory = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();

                      $productArray['prd_name'] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
                      $productArray['prd_status'] = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
                      $productArray['prd_part_number'] = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
                      $productArray['prd_price'] = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
                      $productArray['prd_in_stock'] = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
                      $productArray['prd_brand'] = $this->product_model->getBrandIdByBrandName($brand);
                      $productArray['prd_category'] = $this->product_model->getCategoryIdByCategoryName($subCategory);
                      $productArray['prd_desc'] = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
                      $productArray['prd_features'] = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();

                      if (!empty($productArray['prd_name']) ||
                              !empty($productArray['prd_status']) ||
                              !empty($productArray['prd_part_number']) ||
                              !empty($productArray['prd_in_stock']) ||
                              !empty($productArray['prd_brand']) ||
                              !empty($productArray['prd_category']) ||
                              !empty($productArray['prd_desc']) ||
                              !empty($productArray['prd_features'])) {
                           $prod_id = $this->product_model->importNewProduct($productArray);

                           $prd_specifications_key = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
                           $prd_specifications_key = !empty($prd_specifications_key) ?
                                   explode('|', $prd_specifications_key) : array();

                           $prd_specifications_value = $objWorksheet->getCellByColumnAndRow(12, $i)->getValue();
                           $prd_specifications_value = !empty($prd_specifications_value) ?
                                   explode('|', $prd_specifications_value) : array();

                           $count_key = count($prd_specifications_key);
                           $count_val = count($prd_specifications_value);

                           if ($count_key == $count_val && $count_key > 0) {
                                for ($j = 0; $j < $count_val; $j++) {
                                     $prodSpecification = array();
                                     $prodSpecification['spe_prod_id'] = $prod_id;
                                     $prodSpecification['spe_specification'] = $prd_specifications_key[$j];
                                     $prodSpecification['spe_specification_detail'] = $prd_specifications_value[$j];
                                     $this->product_model->addNewProductSpecification($prodSpecification);
                                }
                           }
                           $prd_image = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
                           if (!empty($prd_image)) {
                                $this->product_model->addNewProductImage(array('pdi_prod_id' => $prod_id, 'pdi_image' => $prd_image));
                           }
                      } else {
                           break;
                      }
                 }
            }
            $this->session->set_flashdata('app_success', 'Product successfully imported!');
            redirect(strtolower(__CLASS__));
       }
  }
  