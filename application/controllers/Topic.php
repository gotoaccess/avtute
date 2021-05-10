<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends CI_Controller {

    public $data;
    public function __construct(){
        parent::__construct();
        $this->load->model('common_model');
        $this->load->model('menu_model');
        $this->load->model('topic_model');
        $this->load->library('menu_load');
        $this->data['menus'] = $this->menu_load->all();
    }

    public function index() {
      if (isset($_GET['index'])) {
        $topic = $this->security->xss_clean($_GET);
        $topiclist = array();
        if ($topic['index']  == 'all') {
          $topiclist = $this->topic_model->all();
        }else if($topic['index']  == 'parent') {
          if (isset($topic['search'])) {
            $topiclist = $this->topic_model->parent_list($topic['search']);
          }else{
            $topiclist = $this->topic_model->parent_list();
          }
        }else{

        }
        echo json_encode($topiclist);
      }else{
        echo json_encode(['error' => 1, 'msg' => 'Request not allowed']);
      }

    }

    public function get_topiclist() {

    		$uri = $this->security->xss_clean($_GET);

    		if (!empty($uri['key'])) {

    			$query = '';

    			$output = array();

    			$data = array();


          $query = "select * from sitetopic where deleted = 0 ";

          $recordsFiltered = $this->common_model->row_count($query);


    	    if (!empty($_GET["search"]["value"])) {
            $query .= ' AND sitetopic.topic_primary LIKE "%' . $uri["search"]["value"] . '%" ';
            $query .= ' OR sitetopic.topic_title LIKE "%' . $uri["search"]["value"] . '%" ';
            $query .= ' OR sitetopic.topic_url LIKE "%' . $uri["search"]["value"] . '%" ';
            $query .= ' OR sitetopic.topic_parent LIKE "%' . $uri["search"]["value"] . '%" ';

          }
          if(!empty($_GET["order"]))

  			{

  				$query .= 'ORDER BY '.$_GET['order']['0']['column'].' '.$_GET['order']['0']['dir'].' ';

  			}

  			else

  			{

  				$query .= 'ORDER BY sitetopic.created DESC ';

  			}

    			 if($_GET["length"] != -1)	{
    			      $query .= 'LIMIT ' . $uri['start'] . ', ' . $uri['length'];
      		 }

      			$sql = $this->db->query($query);

      			$result = $sql->result_array();

            foreach ($result as $row) {
              $sub_array = array();
              $sub_array[] = '<a href="' . base_url('users/edit?q=') . $row['topic_primary'] . '"> <button type="button" class="btn btn-sm btn-secondary"  data-placement="bottom" title="Edit Menu Information"><i class="fa fa-pencil-alt"></i></button></a>';

              $sub_array[] = $row['topic_title'];

              $sub_array[] = $row['topic_url'];

              $sub_array[] = $row['topic_parent'];

              $sub_array[] = $row['created'];

              $data[] = $sub_array;

            }

      			$output["draw"] = intval($_GET["draw"]);

            $output["recordsFiltered" ] =$recordsFiltered;

      			$output["recordsTotal"] =$recordsFiltered;

      			$output["data"] = $data;

      			echo json_encode($output);

    		}else{
          echo json_encode(['error' => 1, 'msg' => 'Request not allowed']);
        }

  	}

    public function add() {
        $this->data['main_content'] = $this->load->view('topic/add-view', $this->data, TRUE);
        $this->data['is_script'] = $this->load->view('topic/topic-script', $this->data, TRUE);
        $this->load->view('index', $this->data);
    }
    public function submit() {
      if ($_GET) {
        $menu = $this->security->xss_clean($_GET);
        $data = [
          'topic_title' => $menu['topic_title'],
          'menu_parent' => $menu['menu_parent'],
          'topic_url' => $menu['topic_url'],
          'created' => current_datetime()
        ];
        if ($this->common_model->insert($data, 'sitetopic')) {
          $responce = ['error' => 0, 'msg' => 'Your Topic save successfully' ];
        }else{
          $responce = ['error' => 1, 'msg' => 'Some Error occurs' ];
        }
        echo json_encode($responce);
      }else{
        echo json_encode(['error' => 1, 'msg' => 'Request not allowed']);
      }
    }

}
