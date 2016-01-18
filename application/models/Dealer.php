<?php
    class Dealer extends CI_Model{
        
        var $table = 'dealer';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_dealer($id, $type='arr'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('level', 'level_id = dealer_level_id');
            $this->db->where('dealer_id', $id);
            $query = $this->db->get();
            
            if($type == 'arr'){
                $res = $query->row_array();
                unset($res['dealer_password']);
                return $res;
            }
            $res = $query->row();
            unset($res->dealer_password);
            return $res;
        }
        
        function get_dealer_by_email($email, $q=array()){
            $this->db->select('dealer_id, dealer_username, dealer_fullname, dealer_email');
            $this->db->from($this->table);
            $this->db->where('dealer_email', $email);
            $this->db->where($q);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function get_dealer_by_id($id){
            $this->db->select('dealer_id, dealer_username, dealer_fullname, dealer_level_id, dealer_status');
            $this->db->from($this->table);
            $this->db->join('level', 'level_id = dealer_level_id');
            $this->db->where('dealer_id', $id);
            $this->db->where('dealer_status ', 1);
            $this->db->where('level_order >', 0);
            $query = $this->db->get();

            return $query->row_array();
        }
        
        function get_dealer_by_login($usr, $pwd){
            $this->db->select('dealer_id, dealer_username, dealer_fullname, dealer_level_id');
            $this->db->from($this->table);
            $this->db->join('level', 'level_id = dealer_level_id');
            $this->db->where('dealer_username', $usr);
            $this->db->where('dealer_password', $pwd);
            $this->db->where('dealer_status', 1);
            $this->db->where('level_order >', 0);
            $query = $this->db->get();
            $dealer = $query->row_array();
            if($dealer != NULL){
                //unset($dealer['dealer_password']);
                $dealer['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                return $dealer;
            }
            return NULL;
        }
        
        function get_dealer_status($id){
            $this->db->select('dealer_id, dealer_level_id ,dealer_status');
            $this->db->where('dealer_id', $id);
            $this->db->from($this->table);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function list_dealers($q=array(), $lim=0, $off=0, $type="arr", $sort='level_order DESC'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('level', 'level_id = dealer_level_id');
            $this->db->where($q);
            $this->db->where('dealer_status', 1);
            $this->db->limit($lim, $off);
            $this->db->order_by($sort);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function add($arr){
            $res = $this->db->insert($this->table, $arr);
            if($res == TRUE){
                $data['id'] = $this->db->insert_id();
                return $data;
            }
            return NULL;
        }
        
        function edit($q, $new){
            $this->db->set($new);
            $this->db->where($q);
            $res = $this->db->update($this->table);
            //$res = $this->db->affected_rows();
            return $res;
        }
        
        function remove($id){
            $this->db->set('dealer_status', 0);
            $this->db->where('dealer_id', $id);
            $res = $this->db->update('dealer');
            return $res;
        }
        
        function get_num_rows($q=array()){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('level', 'level_id = dealer_level_id');
            $this->db->where($q);
            return $this->db->count_all_results();
        }
    
        //*** reset password
        function add_reset_password($arr){
            $res = $this->db->insert('reset_password', $arr);
            if($res == TRUE){
                $data['id'] = $this->db->insert_id();
                return $data;
            }
            return NULL;
        }
        
        function get_reset_password($arr){
            $this->db->select('*');
            $this->db->from('reset_password');
            $this->db->where($arr);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function remove_reset_password($arr){
            $this->db->where($arr);
            $res = $this->db->delete('reset_password');
            return $res;
        }
    }
    