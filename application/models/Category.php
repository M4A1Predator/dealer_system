<?php
    class Category extends CI_Model{
        
        var $table = 'category';
        
        function __contruct(){
            parent::__contruct();
        }
        
        function get_category($id, $type='arr'){
            $this->db->select('*');
            $this->db->where('category_id', $id);
            $query = $this->db->get($this->table);
            
            return Product::row_as($query, $type);
            
        }
        
        function get_category_op($q=array(), $type='arr'){
            $this->db->select('*');
            $this->db->where($q);
            $query = $this->db->get($this->table);
            
            return Product::row_as($query, $type);
        }
        
        function list_categories($q=array(),$lim=10 ,$off=0 ,$type='arr'){
            $this->db->select('category_id, category_name');
            $this->db->where($q);
            $this->db->where('category_status_id !=', 0);
            $this->db->limit($lim, $off);
            $query = $this->db->get($this->table);
            //$data['num_rows'] = $this->get_num_rows($q);
            
            if($type == 'arr'){
                return $query->result_array();
            }
            return $query->result();
        }
        
        function list_categories_with_products($q=array(),$lim=10 ,$off=0 ,$type='arr'){
            $this->db->select('category_id, category_name, count(dealer_product.product_id) as p_amount');
            $this->db->from($this->table);
            $this->db->join('product', 'product.product_category_id = category.category_id and product.product_status_id != 0', 'left');
            $this->db->where('category_status_id !=', 0);
            $this->db->where($q);
            $this->db->group_by('category.category_id');
            $this->db->limit($lim, $off);
            $this->db->order_by('p_amount', 'DESC');
            $this->db->order_by('category_id');
            $query = $this->db->get();
            
            if($type == 'arr'){
                return $query->result_array();
            }
            return $query->result();
        }
        
        function list_categories_with_products_op($q=array(),$lim=10 ,$off=0 ,$type='arr', $order=NULL, $op='ASC', $hv=NULL){
            $this->db->select('category_id, category_name, count(dealer_product.product_id) as p_amount');
            $this->db->from($this->table);
            $this->db->join('product', 'product.product_category_id = category.category_id and product.product_status_id != 0', 'left');
            $this->db->where('category_status_id !=', 0);
            $this->db->where($q);
            $this->db->group_by('category.category_id');
            if($hv != NULL){
                $this->db->having($hv);
            }
            $this->db->limit($lim, $off);
            if($order != NULL){
                $this->db->order_by($order, $op);
            }else{
                $this->db->order_by('p_amount', 'DESC');
                $this->db->order_by('category_id');
            }
            $query = $this->db->get();
            
            if($type == 'arr'){
                return $query->result_array();
            }
            return $query->result();
        }
        
        function get_num_rows($q=array()){
            $query = $this->db->get_where($this->table, $q);
            return $query->num_rows();
        }
        
        function add_category($arr){
            // add to db
            $res = $this->db->insert($this->table, $arr);
            return $res;
        }
        
        function edit($q, $new){
            $this->db->set($new);
            $this->db->where($q);
            $res = $this->db->update($this->table);
            return $res;
        }
        
        function remove($id){
            $this->db->set('category_status_id', 0);
            $this->db->where('category_id', $id);
            return $res = $this->db->update($this->table);
        }
    }
    