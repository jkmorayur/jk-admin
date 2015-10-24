<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Dashboard extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->page_title = "Dashboard";
       }

       public function index() {
            $this->render_page('dashboard/dashboard');
       }
  }