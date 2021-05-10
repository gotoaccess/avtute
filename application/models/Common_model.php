<?php
class Common_model extends CI_Model {

    //-- insert function
	public function insert($data,$table){
		// echo print_r($data);exit;
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    public function insert_account($data,$table) {
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

   	public function account($data,$table){
        $this->db->insert($table,$data);
        return ;
    }
     //-- edit function
		function edit_option($action, $id, $table){
    $this->db->where('id',$id);
    $query=$this->db->update($table,$action);
		//	echo print_r($query);exit;
		    return;
    }


 function edit_password($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }
    //-- update function
    function update($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }
    function user_active($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }
    function update_by_node($action, $node , $id, $table){
        $this->db->where($node ,$id);
        $this->db->update($table,$action);
        return TRUE;
    }
     function update_link($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }

     function move_to_get_help($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }


		 function update_model_profile1($data, $id){
			 	$query=	$this->db->where('user_id',$id);
				$this->db->update('user_profile',$data);

			//echo print_r($query);exit;
				return;
		 }
		 function update_model_profile_photo($data, $id){
				$query=	$this->db->where('user_id',$id);
				$this->db->update('user_profile',$data);
		}

    //-- delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    //-- user role delete function
    function delete_user_role($id,$table){
        $this->db->delete($table, array('user_id' => $id));
        return;
    }
		function getLastId(){
			$this->db->select("id");
			$this->db->from('user');
			$this->db->order_by('created_at','DESC');
			$this->db->limit(1);
			$query = $this->db->get();
			// print_r($this->db->last_query($query));exit;
			$query = $query->row();
			return $query;
		}

    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    //-- check user role power
    function check_power($type){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $this->session->userdata('id'));
        $this->db->where('ur.action', $type);
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

		public function check_id_exist($data, $table){
			return $this->db->where($data)->from($table)->count_all_results();
		}

    public function check_email($email){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result();
        }else{
            return false;
        }
    }
    public function checkuser($id){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result();
        }else{
            return false;
        }
    }
    public function check_exist_power($id){
        $this->db->select('*');
        $this->db->from('user_power');
        $this->db->where('power_id', $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {
            return $query->result();
        }else{
            return false;
        }
    }
    //-- get all power
    function get_all_power($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('power_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }
		//-- write by arti
//--validation for referal id
     function get_user_exist($referal_id){
        $this->db->select('id');
        $this->db->from('user');
        $this->db->where('id', $referal_id);
        $query = $this->db->get();
		  	// print_r($this->db->last_query($query));
        if($query->num_rows() == 1) {
            return true;
        }else{
            return false;
        }
    }
// select row

			function get_user_profile_row_value(){
				$this->db->select('*');
				$this->db->from('user_profile');
				$this->db->where('user_id',$_SESSION['id']);
				$query=$this->db->get();
			// echo print_r($query);exit;
				 return $query->row();

			}

	//-- write by arti

		function find_last_unit(){
			$this->db->select('MAX(unit) AS unit');
			$this->db->from('user');
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}


    //-- get logged user info
    function get_user_info(){
        $this->db->select('u.*');
        $this->db->select('c.name as country_name');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('u.id',$this->session->userdata('id'));
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    //-- get single user info
    function get_user_profile_value($id){
        $this->db->select('u.*');
        $this->db->from('user u');
        $this->db->where('u.id',$id);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }

    //-- get single user info
    function get_user_role($id){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id',$id);
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }


    //-- get all users with type 2
    function get_all_user(){
        $this->db->select('u.*');
        $this->db->select('c.name as country, c.id as country_id');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.packegeId','LEFT');
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }


    function get_helps_all_user_by_root(){
				$this->db->select('u.*');
				$this->db->from('user u');
				$this->db->where('complete = "1" ');
				$this->db->order_by('u.id','DESC');
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;
    }

		public function users_need_helps(){
			$this->db->select('u.*');
			$this->db->from('user u');
			$this->db->where('get_help = "1" AND status = "active" AND payment_verification = "1" AND link_send="1" AND complete="0"');
			$this->db->order_by('u.created_at','DESC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}

	public function link_provided(){
		$this->db->select('u.*');
			$this->db->from('user u');
			$this->db->where('get_help = "0" AND status = "active" AND payment_verification = "0" AND link_send="1"  AND complete="0"');
			$this->db->order_by('u.payment_verification_time','DESC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}

	public function users_need_helps_promotion(){
			$this->db->select('u.*');
			$this->db->from('user u');
			$this->db->where('get_help = "0" AND status = "active" AND payment_verification = "1" AND link_send="1" AND complete="0"');
			$this->db->order_by('u.payment_verification_time');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}


		public function users_provide_helps(){
			$this->db->select('u.*');
			$this->db->from('user u');
			$this->db->where('get_help = "0" AND status = "active" AND payment_verification = "0" AND link_send="0" AND complete="0"');
			$this->db->order_by('u.created_at','DESC');

			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}
		public function get_helps_link_byId($id){
			$this->db->select('u.*');
			$this->db->from('user as u');
			$this->db->join(' help_list h','h.provide_help = u.id','LEFT');
			$this->db->where('need_help = '.$id);
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}
		public function down_line($id){
			$this->db->select('COUNT(id) AS down');
			$this->db->from('user');
			$this->db->where('unit > '.$id);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}


		function get_all_user_by_root(){
            $this->db->select('*');
            $this->db->from('user u');
						$this->db->where('role !=', 'admin');
            $this->db->order_by('u.created_at','DESC');
            $query = $this->db->get();
            $query = $query->result_array();
            return $query;
        }
		function get_volunteer_name_ById($id){
						$this->db->select('CONCAT(first_name, " ", last_name) AS name');
						$this->db->from('user u');
						$this->db->where('id', $id);
						$this->db->order_by('u.created_at','DESC');
						$query = $this->db->get();
						$query = $query->row();
						if (isset($query)) {
							// code...
							$name = $query->name;
						}else{
							$name = "";
						}
            return $name;
        }

		function get_all_donor_by_root(){
        $this->db->select('donations.*');
				$this->db->select('CONCAT(u.first_name, " ", u.last_name) AS volunteer');
        $this->db->from('donations');
				$this->db->join('user u','donations.created_by = u.id','INNER');
        $this->db->order_by('donations.created','DESC');
        $query = $this->db->get();

        $query = $query->result_array();
        return $query;
    }
		function get_all_donor_by_rootId($id) {
        $this->db->select('donations.*, user.first_name, user.last_name');
        $this->db->from('donations');
        $this->db->join('user', 'user.id = donations.created_by', 'INNER');
				$this->db->where('donations.created_by', $id);
				$this->db->or_where('donations.referral', $id);
        $this->db->order_by('donations.created','DESC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

		function get_all_user_by_rootId($id){
        $this->db->select('*');
        $this->db->from('user');
				$this->db->where('created_by', $id);
				$this->db->or_where('referral', $id);
        $this->db->order_by('created_at','DESC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    //-- count active, inactive and total user
    function get_user_total1(){
        $this->db->select('*');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(user.id)
                            FROM user
                            WHERE (user.status = 1)
                            )
                            AS active_user',TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user
                            WHERE (user.status = 0)
                            )
                            AS inactive_user',TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user
                            WHERE (user.role = "admin")
                            )
                            AS admin',TRUE);

        $this->db->from('user');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


		function get_user_total(){
				$this->db->select('*');
				$this->db->select('(SELECT count(user.id)
														FROM user
														WHERE (user.payment_verification = 1)
														)
														AS verify_user',TRUE);

				$this->db->select('(SELECT count(user.id)
														FROM user
														WHERE (user.payment_verification = 0 AND user.role != "admin")
														)
														AS inactive_user',TRUE);

				$this->db->select('(SELECT count(user.id)
														FROM user
														WHERE (user.role = "user")
														)
														AS users',TRUE);

				$this->db->from('user');
				$query = $this->db->get();
				$query = $query->row();
				return $query;
		}


		// function get_user_total_byId($id){
		// 		$this->db->select('*');
		// 		$this->db->select('(SELECT count(user.id)
		// 												FROM user
		// 												WHERE (user.payment_verification = 1 AND created_by = '.$id.')
		// 												)
		// 												AS verify_user',TRUE);
		//
		// 		$this->db->select('(SELECT count(user.id)
		// 												FROM user
		// 												WHERE (user.payment_verification = 0 AND created_by = '.$id.')
		// 												)
		// 												AS inactive_user',TRUE);
		//
		// 		$this->db->select('(SELECT count(user.id)
		// 												FROM user
		// 												WHERE (user.role = "user" AND created_by = '.$id.')
		// 												)
		// 												AS users',TRUE);
		//
		// 		$this->db->from('user');
		// 		$query = $this->db->get();
		// 		$query = $query->row();
		// 		return $query;
		// }


		function get_user_total_byId($id){
			$this->db->select('count(id) AS users');
			$this->db->from('user');
			$this->db->where('referral', $id);
			$this->db->where('status = "active"');
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}

		function get_recent_user(){
				$this->db->select('*');
				$this->db->from('user');
				$this->db->where('created_at >= (CURDATE() + INTERVAL -5 DAY) AND status = "deactive"');
				$this->db->limit(15);
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;
		}

		function get_recent_user_byId($id){
				$this->db->select('*');
				$this->db->from('user');
				$this->db->where('created_at >= (CURDATE() + INTERVAL -5 DAY) AND status = "deactive"
				AND created_by = ', $id);
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;
		}
		function get_my_user_byId($id){
				$this->db->select('*');
				$this->db->from('user');
				$this->db->join('user_profile','user.id = user_profile.user_id', 'INNER');
				$this->db->where('status = "active" AND created_by = ', $id);
				$this->db->where('role != ', 'admin');
				$query = $this->db->get();
				$query = $query->result_array();
				return $query;
		}
      function lavel_income_list($id){
              $this->db->select('*, user_income.update_at AS last_update');
              $this->db->from('level_income');
              $this->db->join('user_income', 'user_income.lavel_id = level_income.lavel AND user_income.user_id = '.$id, 'left');
              $this->db->join('payment_request', 'payment_request.request_amount =  level_income.income
							AND payment_request.user_id =  '.$id, 'left');
              $query = $this->db->get();
              $query = $query->result_array();
              // echo $this->db->last_query();exit;
              return $query;
      }
       function user_lavel($id){
              $this->db->select('*');
              $this->db->from('user_income');
              $this->db->where('user_id', $id);
              $query = $this->db->get();
              $query = $query->result_array();

              return $query;
      }
       function last_payment($id){
              $this->db->select('created_date');
              $this->db->from('payment_request');
              $this->db->where('user_id', $id);
							$this->db->order_by('request_id DESC');
							$this->db->limit(1);
              $query = $this->db->get();
              $query = $query->row();
              return $query;
      }

		 function get_my_referrel_ammount_byId($id){
			 $this->db->select('SUM(level_income.income) AS total_referrel_amount');
			 $this->db->from('user_income');
             $this->db->join('level_income', 'user_income.lavel_id = level_income.lavel', 'INNER');
			 $this->db->where('user_income.status = "done"
			 AND user_income.user_id = ', $id);
			 $query = $this->db->get();
			 $query = $query->row();
			 return $query;
		 }

		 function get_ammount_paid_byId($id){
			 $this->db->select('sum(request_amount) AS total_amount_paid');
			 $this->db->from('payment_request');
			 $this->db->where('request_status = "done" AND user_id = ', $id);
			 $query = $this->db->get();
			 $query = $query->row();
			 return $query;
		 }

		 function get_pending_request_byId($id){
			 $this->db->select('sum(request_amount) AS total_pending_amount');
			 $this->db->from('payment_request');
			 $this->db->where('request_status = "pending" AND user_id = ', $id);
			 $query = $this->db->get();
			 $query = $query->row();
			 return $query;
		 }

		 function get_last_due_date_byId($id){
			 $this->db->select('payment_date');
			 $this->db->from('payment_request');
			 $this->db->where('user_id = ', $id);
			 $this->db->order_by('payment_date DESC');
			 $this->db->limit(1);
			 $query = $this->db->get();
			 $query = $query->row();
			 return $query;
		 }



		function get_pin_amount(){
				$this->db->select('CONCAT(CONCAT(packegeId / 100) * 25) AS pin_amount');
				$this->db->from('user');
				$this->db->where('created_at >= (CURDATE() + INTERVAL -5 DAY) AND status = "deactive"');
				$this->db->group_by('id');
				$query = $this->db->get();
				$query = $query->result_array();
				$result = array();
				foreach ($query as $key => $value) {
					$result[] = $value['pin_amount'];
				}

				return $result;
		}

		function get_pin_amount_byId($id = ''){
				$this->db->select('CONCAT(CONCAT(packegeId / 100) * 25) AS pin_amount');
				$this->db->from('user');
				$this->db->where('created_at >= (CURDATE() + INTERVAL -3 DAY) AND status = "deactive"
				AND created_by = ', $id);
				$this->db->group_by('id');
				$query = $this->db->get();
				$query = $query->result_array();
				$result = array();
				foreach ($query as $key => $value) {
					$result[] = $value['pin_amount'];
				}

				return $result;
		}



		function get_helps_total_byId($id = ''){
			$this->db->select('*');
			$this->db->select('(SELECT count(user.id)
													FROM user
													WHERE (user.get_help = 1 AND created_by = '.$id.')
													)
													AS verify_user',TRUE);

			$this->db->select('(SELECT count(user.id)
													FROM user
													WHERE (user.get_help = 0 AND created_by = '.$id.')
													)
													AS inactive_user',TRUE);

			$this->db->select('(SELECT count(user.id)
													FROM user
													WHERE (user.role = "user" AND created_by = '.$id.')
													)
													AS users',TRUE);

			$this->db->from('user');
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}

    //-- image upload function with resize option
    function upload_image($max_size){

            //-- set upload path
            $config['upload_path']  = "./upload/images";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '920000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {

                $data = $this->upload->data();

                //-- set upload path
                $source             = "./upload/images/".$data['file_name'] ;
                $destination_thumb  = "./upload/images/thumbnail/" ;
                $destination_medium = "./upload/images/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 200 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                //-- set upload path
                $images = 'upload/images/medium/'.$mid;
                unlink($source) ;

                return array(
                    'image' => $images,
                );
            }
            else {
                echo "Failed! to upload images" ;
            }

    }


		function upload_vedio($max_size){

            //-- set upload path
            $config['upload_path']  = "./upload/video";
            $config['allowed_types']= 'mp4|mov|avi|wmv';
            $config['max_size']     = '920000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload("upld_video")) {

                $data = $this->upload->data();
								return $data;
            }
            else {
                echo "Failed! to upload images" ;
            }

    }

		public function randomPassword() {
			$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$pass = array(); //remember to declare $pass as an array
			$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			for ($i = 0; $i < 8; $i++) {
					$n = rand(0, $alphaLength);
					$pass[] = $alphabet[$n];
			}
			return implode($pass); //turn the array into a string
		}

	  public function	get_single_user_bankInfo($id){
			$this->db->select('*');
			$this->db->from('account');
			$this->db->where('user_id = ', $id);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}
	 public function get_user_profile_info($id){
		$this->db->select('*, user.id AS user_id');
		$this->db->from('user');
		$this->db->join('user_profile', 'user.id = user_profile.user_id', 'INNER');
		$this->db->where('user.id', $id);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		$query = $query->row();
		return $query;
	}

	 public function get_donor_info($id){
		$this->db->select('*');
		$this->db->from('donations');
		$this->db->where('don_id', $id);
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		$query = $query->row();
		return $query;
	}
	public function get_volunteer_info(){
	 $this->db->select('*');
	 $this->db->from('volunteer_income');
	 $query = $this->db->get();
	 $query = $query->result_array();
	 return $query;
 }

		public function get_payment_report_byId($id){
			$this->db->select('*');
			$this->db->from('payment_request');
			$this->db->where('user_id = ', $id);
			$this->db->order_by('created_date DESC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}

		public function get_payment_completed(){
			$this->db->select('p.*,  u.first_name AS name');
			$this->db->from('payment_request p');
			$this->db->join('user u', 'p.user_id = u.id', 'left');
			$this->db->where('p.request_status = "done" ');
			$this->db->order_by('p.created_date','DESC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}

		public function get_payment_request(){
			$this->db->select('p.*, a.*, u.first_name AS name');
			$this->db->from('user AS u');
			$this->db->join('account a', 'a.user_id = u.id', 'INNER');
			$this->db->join('payment_request p', 'p.user_id = u.id', 'LEFT');
			$this->db->where('p.request_status = "pending" ');
			$this->db->order_by('p.created_date','DESC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}


		// Closing Function

		public function level_data(){
			$this->db->select('*');
			$this->db->from('level_income');
			$this->db->order_by('lavel','ASC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}
		public function volunteer_income_data($id){
			$this->db->select('*');
			$this->db->from('volunteer_income');
			$this->db->WHERE('level', $id);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}
		public function leaf_user(){
			$this->db->select('max(unit) AS unit');
			$this->db->from('user');
			$query = $this->db->get();
			$query = $query->row('unit');
			return $query;
		}

		public function get_users(){
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where('status = "active" AND id != 1');
			$this->db->order_by('created_at','ASC');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}

		public function get_user_income($id){
			$this->db->select('*');
			$this->db->from('user_income');
			$this->db->where('status = "pending" AND user_id = ', $id);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}
		public function dataByLevel($level_id){
			$this->db->select('*');
			$this->db->from('level_income');
			$this->db->where('lavel = ', $level_id);
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
		}
		public function level_update($action, $id, $table){
			$this->db->where('income_id',$id);
			$this->db->update($table,$action);
			return;
		}

		public function direct_sponsor($id){
			$this->db->select('COUNT(*) AS sponsor');
			$this->db->from('user');
			$this->db->where('status= "active" AND created_by = ', $id);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}

		public function level_sponsor($id){
			$this->db->select('SUM(direct) AS direct');
			$this->db->from('level_income');
			$this->db->where('lavel <= (SELECT MAX(lavel_id) FROM user_income WHERE status = "done" AND user_id = '.$id.')', NULL, FALSE);
			$query = $this->db->get();
			$query = $query->row();
			return $query;
		}

		function get_all_country(){
			$this->db->select('id, name');
			$this->db->from('country');
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
	}

	function get_all_states_by_id($country_id){
			$this->db->select('id, name');
			$this->db->from('states');
			$this->db->where('country_id', $country_id);
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
	}
	function get_all_city_by_id($state_id){
			$this->db->select('id, name');
			$this->db->from('cities');
			$this->db->where('state_id', $state_id);
			$query = $this->db->get();
			$query = $query->result_array();
			return $query;
	}
	// Created By Art Date : 25/11/2019

	function select_video($id){
        $this->db->select('*');
        $this->db->from('upload_video');
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

		public function row_count($query){

				if (!empty($query)) {
					$result = $this->db->query($query);
					if ($result->num_rows()) {
						return $result->num_rows();
					}else{
						return 0;
					}

				}
			}


}

// SELECT SUM(direct) FROM level_income WHERE lavel <= (SELECT MAX(lavel_id) FROM user_income WHERE user_id = 752464 AND status = 'done')
