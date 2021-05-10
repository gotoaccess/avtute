<?php
class Topic_model extends CI_Model {


    public function all(){
      return $this->db->get_where('sitetopic', array('sitemenu_parent' => '', 'deleted' => 0))->result();
    }
    public function parent_list($search = ''){
      if (!empty($search)) {
        $this->db->select('topic_primary as id, topic_title as text');
        $this->db->from('sitetopic');
        $this->db->where('deleted', 0);
        $this->db->where('topic_title LIKE', $search.'%');
        $result = $this->db->get();
        return $result->result();
      }else{
        return $this->db->select('topic_primary as id, topic_title as text')->get_where('sitetopic', array('deleted' => 0))->result();
      }
    }
}
