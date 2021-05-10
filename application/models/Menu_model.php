<?php
class Menu_model extends CI_Model {


    public function all(){
      return $this->db->get_where('sitemenu', array('sitemenu_parent' => '', 'deleted' => 0))->result();
    }
    public function parent_list($search = ''){
      if (!empty($search)) {
        $this->db->select('sitemenu_url as id, sitemenu_title as text');
        $this->db->from('sitemenu');
        $this->db->where('deleted', 0);
        $this->db->where('sitemenu_title LIKE', $search.'%');
        $result = $this->db->get();
        return $result->result();
      }else{
        return $this->db->select('sitemenu_url as id, sitemenu_title as text')->get_where('sitemenu', array('deleted' => 0))->result();
      }
    }

    public function side_menu($menu = '') {
      if (!empty($menu)) {
        $sql = "SELECT sitetopic.topic_primary, sitetopic.topic_title, sitetopic.menu_parent, sitetopic.topic_url, sitemenu.sitemenu_title,
        (SELECT CONCAT( '[', GROUP_CONCAT( JSON_OBJECT('article_primary', CONCAT(sitearticle.article_primary), 'article_url', CONCAT(sitearticle.article_url), 'article_title', CONCAT(sitearticle.article_title) ) ), ']' )
        FROM sitearticle WHERE fk_topic_primary = sitetopic.topic_primary) AS topic_article
        FROM sitetopic
        INNER JOIN sitemenu ON sitetopic.menu_parent = sitemenu.sitemenu_url
        WHERE sitetopic.deleted = 0 AND sitetopic.menu_parent = '{$menu}'";
        $result = $this->db->query($sql);
        return $result->result();
      }else{
        return $this->db->get_where('sitetopic', array('menu_parent' => '', 'deleted' => 0))->result();
      }
    }
}
