<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class Settings extends App_Controller {

       public function __construct() {
            parent::__construct();
            $this->body_class[] = 'skin-blue';
            $this->page_title = 'General Tech - Product';
       }
  } 