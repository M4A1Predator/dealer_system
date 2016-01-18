<?php
    class Price extends CI_Model {
        function __construct(){
            parent::__construct();
        }
        
        function add($arr){
            $res = $this->db->insert('price', $arr);
            return $res;
        }
        
        function list_prices($q=array(), $type='arr'){
            $this->db->select('*');
            $this->db->from('price');
            $this->db->join('level', 'price_level_id = level_id');
            $this->db->where($q);
            $this->db->where('level_order >', 0);
            $this->db->order_by('level_order');
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function edit($q, $new_data){
            $this->db->set($new_data);
            $this->db->where($q);
            $res = $this->db->update('price');
            
            return $res;
        }
    }
    