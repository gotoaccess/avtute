<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_load
{
  protected $CI;
  public function __construct() {
      $this->CI =& get_instance();
      $this->CI->load->model('menu_model');
  }

  public function all() {
    return $this->CI->menu_model->all();
  }
}
