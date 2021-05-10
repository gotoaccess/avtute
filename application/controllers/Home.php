<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public $data;
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('menu_model');
        $this->load->library('menu_load');
        $this->data['menus'] = $this->menu_load->all();
    }


    public function index() {
      if ($_GET) {
        $uri = $this->security->xss_clean($_GET);
        if (isset($uri['menu'])) {
            $this->data['side_menu']  = $this->menu_model->side_menu($uri['menu']);
        }
      }else{
          $this->data['side_menu']  = $this->menu_model->side_menu('html');
      }
      $this->data['main_content'] = $this->load->view('home', $this->data, TRUE);
      $this->load->view('index', $this->data);
    }

}
