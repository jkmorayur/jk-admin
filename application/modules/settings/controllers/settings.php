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
            $this->settings_model->newSettings($this->input->post());
             $this->session->set_flashdata('app_success', 'Settings successfully updated!');
             redirect(strtolower(__CLASS__).'/general_settings');
       }
  } 