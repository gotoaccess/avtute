<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// *************************************************************************
// *                                                                       *
// * Optimum LinkupComputers                              *
// * Copyright (c) Optimum LinkupComputers. All Rights Reserved                     *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@optimumlinkupsoftware.com                                 *
// * Website: https://optimumlinkup.com.ng								   *
// * 		  https://optimumlinkupsoftware.com							   *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// *                                                                       *
// *************************************************************************

//LOCATION : application - controller - Auth.php

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
    }


    public function index(){
        if($this->session->userdata('id')){
          redirect(base_url());
        }else{
          $data = array();
          $data['page'] = 'Auth';
          $this->load->view('auth/login', $data);
        }
    }



 /****************Function login**********************************
     * @type            : Function
     * @function name   : log
     * @description     : Authenticatte when uset try lo login.
     *                    if autheticated redirected to logged in user dashboard.
     *                    Also set some session date for logged in user.
     * @param           : null
     * @return          : null
     * ********************************************************** */

    public function ajaxlog(){
        if($this->session->userdata('id')) {
          echo json_encode(array('status' => 1, 'url' => 'admin/dashboard'));
        }else{
          $data = array();
          if($_POST) {
              $query = $this->login_model->validate_user();
              //-- if valid
              if($query) {
                  foreach($query as $row) {
                      $data = array(
                        'id' => $row->user_primary,
                        'name' => $row->user_name,
                        'is_login' => TRUE
                      );
                  }
                  $this->session->set_userdata($data);
                  echo json_encode(array('status' => 1, 'url' => base_url(), 'msg' => 'Login success'));

              }else{
                echo json_encode(array('status' => 0, 'url' => 'auth', 'msg' => 'Invalid User/Password. Try another...'));
              }

          }else{
              echo json_encode(array('status' => 0, 'url' => 'auth', 'msg' => 'Request Not allowed type.'));
          }
        }
    }



 /*     * ***************Function logout**********************************
     * @type            : Function
     * @function name   : logout
     * @description     : Log Out the logged in user and redirected to Login page
     * @param           : null
     * @return          : null
     * ********************************************************** */

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

}
