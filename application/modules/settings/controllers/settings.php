<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Settings extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->load->model('settings_model');
            $this->page_title = 'General Settings';
       }

       function general_settings() {

            $this->section = 'General Settings';
            $this->page_title = 'General Settings';
            $this->render_page(__CLASS__ . '/index');
       }

       function insert() {

            $newFileName = rand(9999999, 0) . $_FILES['site_logo']['name'];
            $config['upload_path'] = UPLOAD_PATH . 'admin_log';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $newFileName;
            $this->load->library('upload');
            $this->upload->initialize($config);

            $angle['x1']['0'] = $_POST['x1'];
            $angle['x2']['0'] = $_POST['x2'];
            $angle['y1']['0'] = $_POST['y1'];
            $angle['y2']['0'] = $_POST['y2'];
            $angle['w']['0'] = $_POST['w'];
            $angle['h']['0'] = $_POST['h'];

            if (!$this->upload->do_upload('site_logo')) {
                 $up = array('error' => $this->upload->display_errors());
            } else {
                 $data = $this->upload->data();
                 $_POST['settings']['site_logo'] = $data['file_name'];
                 crop($this->upload->data(), $angle);
            }
            
            $this->settings_model->newSettings($this->input->post('settings'));
            $this->session->set_flashdata('app_success', 'Settings successfully updated!');
            redirect(strtolower(__CLASS__) . '/general_settings');
       }
       
       function removeSettings($key) {
            if($key && $this->settings_model->dropSettingsByKey($key)) {
                 echo json_encode(array('status' => 'success', 'msg' => 'Logo successfully deleted'));
            } else {
                 echo json_encode(array('status' => 'fail', 'msg' => "Can't delete logo"));
            }
       }
  } 