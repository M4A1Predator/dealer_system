<?php
    class Brand extends CI_Model{
        
        var $table = 'brand';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_brand($id, $type='arr'){
            $this->db->select('*');
            $this->db->where('brand_id', $id);
            $this->db->where('brand_status_id !=', 0);
            $query = $this->db->get($this->table);
            
            if($type == 'arr'){
                return $query->row_array();
            }
            return $query->row();
        }
        
        function get_brand_op($q=array(), $type='arr'){
            $this->db->select('*');
            $this->db->where($q);
            $this->db->where('brand_status_id !=', 0);
            $query = $this->db->get($this->table);
            
            if($type == 'arr'){
                return $query->row_array();
            }
            return $query->row();
        }
        
        function list_brands($q=array(), $lim=30, $off=0, $type='arr'){
            $this->db->select('brand_id, brand_name');
            $this->db->where($q);
            $this->db->where('brand_status_id !=', 0);
            $this->db->limit($lim, $off);
            $query = $this->db->get($this->table);
            //$data['num_rows'] = $this->get_num_rows($q);
            
            if($type == 'arr'){
                return $query->result_array();
            }
            return $query->result();
        }
        
        function list_brands_with_products($q=array(), $lim=0, $off=0, $type='arr'){
            $this->db->select('brand_id, brand_name, count(dealer_product.product_id) as p_amount');
            $this->db->from('brand');
            $this->db->join('product', 'product.product_brand_id = brand.brand_id and product.product_status_id != 0', 'left');
            $this->db->where('brand_status_id != ', 0);
            $this->db->where($q);
            $this->db->group_by('brand.brand_id');
            $this->db->limit($lim, $off);
            $this->db->order_by('p_amount', 'DESC');
            $this->db->order_by('brand_id');
            $query = $this->db->get();
            
            if($type == 'arr'){
                return $query->result_array();
            }
            return $query->result();
        }
        
        function list_brands_with_products_op($q=array(),$lim=10 ,$off=0 ,$type='arr', $order=NULL, $op='ASC', $hv=NULL){
            $this->db->select('brand_id, brand_name, count(dealer_product.product_id) as p_amount');
            $this->db->from('brand');
            $this->db->join('product', 'product.product_brand_id = brand.brand_id and product.product_status_id != 0', 'left');
            $this->db->where('brand_status_id != ', 0);
            $this->db->where($q);
            $this->db->group_by('brand.brand_id');
            if($hv != NULL){
                $this->db->having($hv);
            }
            $this->db->limit($lim, $off);
            if($order != NULL){
                $this->db->order_by($order, $op);
            }else{
                $this->db->order_by('p_amount', 'DESC');
                $this->db->order_by('brand_id');
            }
            $query = $this->db->get();
            
            if($type == 'arr'){
                return $query->result_array();
            }
            return $query->result();
        }
        
        function list_brand_from_category($cat_id, $type='arr'){
            $this->db->select('brand.*');
            $this->db->distinct();
            $this->db->from($this->table);
            $this->db->join('product', 'product.product_brand_id = brand.brand_id and product.product_status_id != 0');
            $this->db->where('product_category_id', $cat_id);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
            
        }
        
        function get_product_amount($bid){
            $this->select('');
        }
        
        function get_num_rows($q){
            $query = $this->db->get_where($this->table, $q);
            return $query->num_rows();
        }
        
        function add($arr){
            $res = $this->db->insert('brand', $arr);
            return $res;
        }
        
        function edit($q, $new){
            $this->db->set($new);
            $this->db->where($q);
            $res = $this->db->update($this->table);
            return $res;
        }
        
        function remove($id){
            $this->db->set('brand_status_id', 0);
            $this->db->where('brand_id', $id);
            return $res = $this->db->update($this->table);
        }
        
        private static function result_as($obj, $type='arr'){
            if($type == 'arr'){
                return $obj->result_array();
            }
            return $obj->result();
        }
    }
    