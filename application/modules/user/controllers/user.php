<?php

  defined('BASEPATH') OR exit('No direct script access allowed');

  class User extends App_Controller {

       public function __construct() {
            parent::__construct();
       }

       public function index() {

            if ($this->ion_auth->logged_in()) {
                 redirect('dashboard');
            } else {
                 redirect(strtolower(__CLASS__) . '/login');
            }
       }

       public function login() {
            if ($this->ion_auth->logged_in()) {
                 redirect('dashboard');
            }

            $this->body_class[] = 'login-page';

            $this->page_title = 'Please sign in';

            $this->current_section = 'login';

            // validate form input
            $this->form_validation->set_rules('identity', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == true) {
                 // check to see if the user is logging in
                 // check for "remember me"
                 $remember = (bool) $this->input->post('remember');

                 if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                      $this->session->set_flashdata('app_success', $this->ion_auth->messages());
                      redirect('dashboard');
                 } else {
                      $this->session->set_flashdata('app_error', $this->ion_auth->errors());
                      redirect('user/login');
                 }
            } else {
                 // the user is not logging in so display the login page
                 // set the flash data error message if there is one
                 $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                 $data['identity'] = array('name' => 'identity',
                     'id' => 'identity',
                     'type' => 'text',
                     'value' => $this->form_validation->set_value('identity'),
                     'class' => 'form-control',
                     'placeholder' => 'Usernam'
                 );
                 $data['password'] = array('name' => 'password',
                     'id' => 'password',
                     'type' => 'password',
                     'class' => 'form-control',
                     'placeholder' => 'Password'
                 );

                 $this->render_page('user/login', $data);
            }
       }

       public function logout() {
            // log the user out
            $logout = $this->ion_auth->logout();
            // redirect them back to the login page
            redirect(strtolower(__CLASS__) . '/login');
       }

       public function forgot_password() {
            if ($this->form_validation->run('user_forgot_password')) {
                 $forgotten = $this->ion_auth->forgotten_password($this->input->post('email', TRUE));

                 if ($forgotten) {
                      // if there were no errors
                      $this->session->set_flashdata('app_success', $this->ion_auth->messages());
                      redirect('login');
                 } else {
                      $this->session->set_flashdata('app_error', $this->ion_auth->errors());
                      redirect('login');
                 }
            }

            $this->body_class[] = 'forgot_password';

            $this->page_title = 'Forgot password';

            $this->current_section = 'forgot_password';

            $this->render_page('user/forgot_password');
       }

       public function account() {
            $this->body_class[] = 'my_account';

            $this->page_title = 'My Account';

            $this->current_section = 'my_account';

            $user = $this->ion_auth->user()->row_array();

            $this->render_page('user/account', array('user' => $user));
       }
       
       function change_password() {
            
            $this->section = 'Change Password';
            $this->body_class[] = 'skin-blue';
            $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
            $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

            if (!$this->ion_auth->logged_in()) {
                 redirect('user/login', 'refresh');
            }

            $user = $this->ion_auth->user()->row();
            
            if ($this->form_validation->run() == false) {
                 //set the flash data error message if there is one
                 $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                 $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                 $uname = isset($this->ion_auth->user()->row()->username) ? $this->ion_auth->user()->row()->username : '';
                 $this->data['username'] = array(
                     'name' => 'uname',
                     'id' => 'uname',
                     'type' => 'test',
                     'class' => 'input-xxlarge',
                     'value' => $uname
                 );
                 $this->data['old_password'] = array(
                     'name' => 'old',
                     'id' => 'old',
                     'type' => 'password',
                     'class' => 'input-xxlarge'
                 );
                 $this->data['new_password'] = array(
                     'name' => 'new',
                     'id' => 'new',
                     'type' => 'password',
                     'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                     'class' => 'input-xxlarge'
                 );
                 $this->data['new_password_confirm'] = array(
                     'name' => 'new_confirm',
                     'id' => 'new_confirm',
                     'type' => 'password',
                     'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                     'class' => 'input-xxlarge'
                 );
                 $this->data['user_id'] = array(
                     'name' => 'user_id',
                     'id' => 'user_id',
                     'type' => 'hidden',
                     'value' => $user->id,
                 );

                 //render
                 $this->render_page('user/change_password', $this->data);
                 //$this->render_page('user/login', $data);
            } else {
                 
                 $identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

                 $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'), $this->input->post('uname'));

                 if ($change) {
                      //if the password was successfully changed
                      $this->session->set_flashdata('app_success', $this->ion_auth->messages());
                      $this->logout();
                 } else {
                      $this->session->set_flashdata('app_error', $this->ion_auth->errors());
                      redirect('user/change_password', 'refresh');
                 }
            }
       }

  }