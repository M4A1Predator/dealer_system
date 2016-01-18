<?php
    class Admin extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        function get_admin_by_id($id, $type='arr'){
            $this->db->select('admin_id, admin_username, admin_level');
            $this->db->where('admin_id', $id);
            $query = $this->db->get('admin');
            
            $admin = null;
            if($query->num_rows() == 1){
                if($type == 'arr'){
                    $admin = $query->row_array();
                }else{
                    $admin = $query->row();
                }
            }
            return $admin;
        }
        
        function get_admin_by_login($usr, $pwd){
            $this->db->select('admin_id, admin_username, admin_password, admin_salt, admin_level');
            $this->db->where('admin_username', $usr);
            $query_name = $this->db->get('admin');
            if($query_name->num_rows() != 1){
                return NULL;
            }
            $admin = $query_name->row_array();
            $pwd = do_hash($pwd.$admin['admin_salt'], 'sha256');
            if($pwd == $admin['admin_password']){
                unset($admin['admin_salt']);
                unset($admin['admin_password']);
                $admin['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                return $admin;
            }
            return NULL;
        }
        
        function register($usr, $pwd, $lv=2){
            //create salt and hash password
            $salt = hash('sha256', uniqid(mt_rand(1, mt_getrandmax()), true));
            $password = do_hash($pwd.$salt, 'sha256');
            
            //build db statement
            $arr = array(
                        'admin_username' => $usr,
                        'admin_password' => $password,
                        'admin_salt' => $salt,
                        'admin_level' => $lv
                        );
            $q = $this->db->insert('admin',$arr);
            return $q;
        }
        
        function change_password($id, $pwd){
            $salt = hash('sha256', uniqid(mt_rand(1, mt_getrandmax()), true));
            $new_password = do_hash($pwd.$salt, 'sha256');
            
            $arr = array(
                'admin_password' => $new_password,
                'admin_salt' => $salt
            );
            
            $this->db->set($arr);
            $this->db->where('admin_id', $id);
            $res = $this->db->update('admin');
            return;
        }
        
        function change_username($id, $name){
            $this->db->set('admin_username', $name);
            $this->db->where('admin_id', $id);
            $res = $this->db->update('admin');
            return;
        }
        
        function list_admins($q=array(), $lim=0, $off=0, $sort='admin_level ASC'){
            $this->db->select('admin_id, admin_username, admin_level');
            $this->db->from('admin');
            $this->db->where($q);
            $this->db->order_by($sort);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        function remove($id){
            $this->db->where('admin_id', $id);
            $res = $this->db->delete('admin');
            return $res;
        }
        
        //**** web info****
        function get_info(){
            $this->db->select('*');
            $this->db->from('info');
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function edit_info($id, $new_arr){
            $this->db->set($new_arr);
            $this->db->where('info_id', $id);
            $res = $this->db->update('info');
            return $res;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    