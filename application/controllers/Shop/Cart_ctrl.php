<?php
    class Cart_ctrl extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->helper('authen_helper');
            $this->load->helper('set_data_helper');
            verify_authen();
        }
        
        function view_cart(){
            $cart = $this->session->userdata('cart');
            if($cart == NULL){
                $cart = array();
            }
            
            $products = array();
            $q['price_level_id'] = $this->session->userdata('dealer_level_id');
            foreach($cart as $c){
                $q['product_id'] = $c['pid'];
                $p = $this->Product->get_product_view($q, 'obj');
                //$p['qty'] = $c['amount'];
                $p->qty = $c['amount'];
                
                array_push($products, $p);
            }
            
            $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
            
            $data['products_with_qty'] = $products;
            $data['dealer'] = $dealer;
            $this->load->view('pages/cart.php', $data);
        }
        
        function edit_cart(){
            $prefix = 'pid';
            
            $cart = array();
            
            foreach($this->input->post() as $k => $v){
                if(strpos($k, $prefix) === 0){
                    $pid = substr($k, strlen($prefix));
                    $qty = $v;
                    
                    $p = array(
                        'pid' => $pid,
                        'amount' => (int)$qty
                    );
                    array_push($cart, $p);
                }
            }
            $this->session->set_userdata('cart', $cart);
            echo TRUE;
        }
    }
    