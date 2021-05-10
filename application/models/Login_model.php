<?php
class Login_model extends CI_Model {

    //-- check valid user
    function validate_user() {
        $this->db->select('*');
        $this->db->from('siteuser');
        $this->db->where('siteuser.user_primary', $this->input->post('id'));
        $this->db->where('siteuser.user_password', md5($this->input->post('password')));
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
           return $query->result();
        }
        else{
            return false;
        }
    }



}
