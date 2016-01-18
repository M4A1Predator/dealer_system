<?php
    ob_start();
    class Product_ctrl extends CI_Controller{
        
        var $new_amount = 6;
        var $best_amount = 8;
        var $lim = 9;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('authen_helper');
            $this->load->helper('set_data_helper');
            verify_authen();
            set_new_products($this->session->userdata('dealer_level_id'), $this->new_amount);
        }
        
        function index(){
            $lv_id = $this->session->userdata('dealer_level_id');
            
            // get new products
            $new_arr = array(
                'price_level_id' => $lv_id,
                //'product_status_id >=' => 1
            );
            $new_products = $this->Product->list_products_view_op($new_arr, $this->new_amount, 0, 'obj', 'product_id', 'DESC');
            //$this->session->set_userdata('new_products', $new_products);
            
            // get hot products
            $hot_products = $this->Product->list_hot_products($new_arr, $this->best_amount, 0, 'obj');
            
            // set data to page
            $data = array();
            $data['nps'] = $new_products;
            $data['hps'] = $hot_products;
            
            //load view
            $this->session->set_userdata('page', 'index');
            $this->load->view('pages/index', $data);
            
            //echo $lv_id;
        }
        
        function view_product(){
            $pid = $this->uri->segment(3);
            if($pid == NULL || $pid == ''){
                redirect('/shop');
                return;
            }
            $q = array(
                'product_id' => $pid,
                'price_level_id' => $this->session->userdata('dealer_level_id')
            );
            $product = $this->Product->get_product_view($q, 'obj');
            $this->Product->add_view($pid);
            
            $data['product'] = $product;
            //echo $product->product_detail."<br/>";
            $this->load->view('pages/product', $data);
        }
        
        function view_products(){
            
            $keyword = $this->input->get('keyword');
            $bs = $this->input->get('brands');
            $cat_ids = $this->input->get('cats');
            $lim = $this->input->get('lim');
            $order = $this->input->get('sort');
            $page = $this->input->get('p');
            $menu = $this->input->get('m');
            
            if($page == NULL || !is_numeric($page) || $page < 1){
                $page = 1;
            }
            
            // search
            $lv_id = $this->session->userdata('dealer_level_id'); // get level id
            $q = array(
                'product_status_id !=' => 0,
            );
            $q['price_level_id'] = $lv_id;
            if(isset($keyword)){
                $q['product_name like '] = '%'.trim($keyword).'%';
            }
            
            // set filter by cats and brands
            $filt = array();
            if($bs != NULL && strlen($bs) != 0 && strpos($bs, '--') !== FALSE){    // if brands were selected
                $b_arr = explode('--', $bs, -1);
                $b_ids = array();
                foreach($b_arr as $b){
                    $b_tmp = $this->Brand->get_brand_op(array('brand_name' => $b));
                    $b_ids[] = $b_tmp['brand_id'];
                    //array_push($b_ids, $this->Brand->get_brand_op(array('brand_name' => $b))['brand_id']);
                }
                $filt['b_ids'] = $b_ids;            // add brand ids to array
            }else if(strpos($bs, '--') === FALSE && strlen($bs) !== 0){
                $b_arr = array($bs);
                foreach($b_arr as $b){
                    $b_tmp = $this->Brand->get_brand_op(array('brand_name' => $b));
                    $b_ids[] = $b_tmp['brand_id'];
                }
                $filt['b_ids'] = $b_ids; 
            }
            
            if($cat_ids != NULL && strlen($cat_ids) != 0 && !is_numeric($cat_ids)){  // if cats were selected
                $cat_arr = explode('--', $cat_ids, -1);
                $filt['c_ids'] = $cat_arr;            // add cat ids to array
            }else if(is_numeric($cat_ids)){
                $cat_arr = array($cat_ids);
                $filt['c_ids'] = $cat_arr;
            }
            
            // set limit, offset
            $lim = isset($lim)&&strlen($lim!=0)?$lim:$this->lim;
            $off = ($lim*$page)-$lim;
            $sort = '';
            $sort_op = 'ASC';
            if(isset($order) && strlen($order)!= 0){
                switch((int)$order){
                    case 1: $sort = 'product_id';
                            $sort_op = 'DESC';
                            break;
                    case 2: $sort = 'price_price';
                            $sort_op = 'DESC';
                            break;
                    case 3: $sort = 'price_price';
                            $sort_op = 'ASC';
                            break;
                    case 4: $sort = 'product_view';
                            $sort_op = 'DESC';
                            break;
                    case 5: //$sort = '(dealer_view_product.product_price-dealer_price.price_price)/dealer_view_product.product_price*100';
                            $sort = '(dealer_view_product.product_price-dealer_price.price_price)';
                            $sort_op = 'DESC';
                            break;
                }
            }else{
                $sort = 'product_id';
                $sort_op = 'DESC';
            }
            
            // get products
            $list = $this->Product->list_products_view_by_filter($q, $filt, $lim, $off, 'obj', $sort, $sort_op);
            //unset($q['price_level_id']);
            $amount = $list['num_rows']; // amount of products
            // set page amount
            if($amount%$lim == 0 || $amount%$lim == $lim){  // set page amount
                $page_amount = $amount/$lim;
            }else{
                $page_amount = $amount/$lim+1;
            }
            if($page > $page_amount){
                $list = $this->Product->list_products_view_by_filter($q, $filt, 0, 0, 'obj', $sort, $sort_op);
            }
            $products = $list['products'];
            
            //set data
            $data = array();
            $data['products'] = $products;
            $data['amount'] = $amount;
            //$data['cats'] = $cats;
            //$data['brands'] = $brands;
            $data['page_amount'] = $page_amount;
            $data['lim'] = $lim;
            $data['sort'] = isset($order)?$order:1;
            $data['brands_sel'] = isset($b_ids)?$b_ids:array();
            $data['cats_sel'] = isset($cat_arr)?$cat_arr:array();
            $data['page'] = $page;
            $this->session->set_flashdata('keyword', isset($keyword)?$keyword:'');
            //$data['keyword'] = isset($keyword)?$keyword:'';
            
            if($menu == NULL || $menu == ''){
                $menu = 'allproduct';
            }
            $this->session->set_userdata('page', $menu);
            $this->load->view('pages/allproduct', $data);
        }
        
        function view_hot_products(){
            $keyword = $this->input->get('keyword');
            $bs = $this->input->get('brands');
            $cat_ids = $this->input->get('cats');
            $lim = $this->input->get('lim');
            $order = $this->input->get('sort');
            $page = $this->input->get('p');
            $menu = $this->input->get('m');
            
            $page = isset($page)?$page:1;
            
            $q = array(
                'price_level_id' => $this->session->userdata('dealer_level_id')
            );
            $lim = isset($lim)&&strlen($lim!=0)?$lim:$this->lim;
            $off = ($lim*$page)-$lim;
            $products = $this->Product->list_hot_products($q, $lim>=30?30:$lim, $off, 'obj');
            
            $data = array();
            $data['products'] = $products;
            $data['amount'] = count($products);
            $data['page_amount'] = 1;
            $data['page'] = $page;
            $data['lim'] = $lim;
            $data['sort'] = isset($order)?$order:1;
            $data['brands_sel'] = isset($b_ids)?$b_ids:array();
            $data['cats_sel'] = isset($cat_arr)?$cat_arr:array();
            $this->session->set_userdata('page', 'bestseller');
            $this->load->view('pages/allproduct', $data);
        }
        
        //add product to cart
        function add_to_cart(){
            $pid = $this->input->post('pid');
            $amount = $this->input->post('amount');
            $next = $this->input->post('next');
            
            $lid = $this->session->userdata('dealer_level_id');
            
            //echo $pid.$amount;
            // get product info
            $p = $this->Product->get_product_view(array('product_id'=> $pid, 'price_level_id' => $lid));
            
            // chech has cart?
            $cart = $this->session->userdata('cart');
            if($cart == NULL){
                $cart = array();
            }
            
            if(count($cart) >= 1){
                for($i=0;$i < count($cart); $i++){
                    if($pid == $cart[$i]['pid']){
                        //$amount += $cart[$i]['amount'];
                        //unset($cart[$i]);
                        $cart[$i]['amount'] += $amount;
                        $this->session->set_userdata('cart', $cart);
                        if( $next != NULL && $next == 'cart' ){
                            redirect('/shop/cart');
                        }else{
                            echo "increased";
                        }
                        return;
                    }
                }
            }
            
            // prepare array to put in cart session
            $product = array(
                'pid' => $pid,
                'amount' => $amount,
                'price' => $p['price_price'],
                'img' => $p['product_img1'],
                'pname' => $p['product_name']
            );
            array_push($cart, $product);
            $new_cart = array_values($cart);
            $this->session->set_userdata('cart', $new_cart);
            if( $next != NULL && $next == 'cart' ){
                redirect('/shop/cart');
            }else{
                echo "added";
            }
        }
        
        function remove_from_cart(){
            $pid = $this->input->post('pid');
            $msg = '';
            
            // get cart from session
            $cart = $this->session->userdata('cart');
            // find and remove pid
            for($i=0;$i<count($cart);$i++){
                if($pid == $cart[$i]['pid']){
                    unset($cart[$i]);
                    $msg = 'removed';
                }
            }
            // rearrange array
            $new_cart = array_values($cart);
            $this->session->set_userdata('cart', $new_cart);    //set cart to session
            echo $msg;
        }
        
        function get_in_cart(){
            $products = $this->session->userdata('cart');
            
            echo json_encode($products);
        }
    }
