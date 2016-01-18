<?php
    ob_start();
    class Order_ctrl extends CI_Controller{
        
        function __construct(){
            parent::__construct();
            $this->load->helper('authen_helper');
            $this->load->helper('set_data_helper');
            verify_authen();
            date_default_timezone_set('Asia/Bangkok');
        }
        
        function index(){
            $this->load->view('pages/order');
        }
        
        function view_order(){
            $oid = $this->uri->segment(3);
            if($oid == NULL || is_nan($oid)){
                redirect('/shop/account');
                return;
            }
            $order_arr = array(
                'order_id' => $oid,
                'order_dealer_id' => $this->session->userdata('dealer_id'),
            );
            $order = $this->Order->get_order($order_arr);
            if($order != NULL){
                $q = array(
                    'order_product_order_id' => $oid,
                );
                $order_products = $this->Order_product->list_order_products_view($q, 'obj');
                $price = 0;
                foreach($order_products as $op){
                    $price += $op->order_product_price*$op->order_product_quantity;
                }
                $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
                $banks = $this->Bank->list_banks();
                
                // set data and load view
                $data['order'] = $order;
                $data['order_products'] = $order_products;
                $data['total_product_price'] = $price;
                $data['dealer'] = $dealer;
                $data['banks'] = $banks;
                $this->load->view('pages/showorder', $data);
                return;
            }
            redirect('/shop/account');
        }
        
        function view_now_orders(){
            $page = $this->input->get('page');
            if($page == NULL || is_nan($page)){
                $page = 1;
            }
            
            $lim = 10;
            $off = ($lim*$page)-$lim;
            
            $arr = array(
                'order_status_id != ' => 5,
                'order_dealer_id' => $this->session->userdata('dealer_id')
            );
            $now_orders = $this->Order->list_orders($arr, $lim, $off, 'obj', 'order_order_status_id ASC, order_datetime DESC');
            $rows = $this->Order->get_num_rows($arr);
            
            if($rows%$lim == 0 || $rows%$lim == $lim){  // set page amount
                $page_amount = $rows/$lim;
            }else{
                $page_amount = $rows/$lim+1;
            }
            
            $data['now_orders'] = $now_orders;
            $data['page_amount'] = $page_amount;
            $data['page'] = $page;
            $this->load->view('pages/order', $data);
        }
        
        function add_order(){
            $this->load->library('form_validation');
            // validate form
            $this->form_validation->set_rules('con', 'con', 'required');
            $this->form_validation->set_rules('address', 'address', 'trim');
            if($this->form_validation->run() == FALSE || set_value('con') != 'ok'){
                redirect('/shop/product');
                return;
            }
            $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
            if(set_value('address') == NULL || set_value('address') == ''){
                //$dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
                $address = $dealer['dealer_address'];
            }else{
                $address = set_value('address');
            }
            
            // check cart
            $cart = $this->session->userdata('cart');
            if($cart == NULL){
                redirect('/shop/product');
                return;
            }
            
            $this->db->trans_start();
            // add order
            $order_arr = array(
                'order_order_status_id' => 1,
                'order_dealer_id' => $this->session->userdata('dealer_id'),
                'order_address' => $address,
                'order_datetime' => date('Y-m-d H:i:s')
            );
            //calculate total price
            $total_price = 0.00;
            $total_oprice = 0.00;
            $q['price_level_id'] = $this->session->userdata('dealer_level_id');
            foreach($cart as $c){
                $q['product_id'] = $c['pid'];
                $p = $this->Product->get_product_view($q, 'obj');
                $total_oprice += $c['amount']*$p->product_price;
                $total_price += $c['amount']*$p->price_price;
            }
            $order_arr['order_price'] = $total_price;
            $order_arr['order_oprice'] = $total_oprice;
            $add_order = $this->Order->add($order_arr); // add order
            if($add_order != NULL){
                $oid = $add_order['id'];
                $order_products = array();
                $order_product_list = array();
                foreach($cart as $c){
                    // get product info
                    $q['product_id'] = $c['pid'];
                    $p = $this->Product->get_product_view($q, 'obj');
                    
                    // add products in order
                    $order_product['order_product_product_id'] = $p->product_id;
                    $order_product['order_product_quantity'] = $c['amount'];
                    $order_product['order_product_order_id'] = $oid;
                    $order_product['order_product_price'] = $p->price_price;
                    $order_product['order_product_name'] = $p->product_name;
                    
                    $add_od = $this->Order_product->add($order_product);
                    if($add_od == NULL){
                        $this->session->set_flashdata('msg', 'ไม่สามารถทำรายการสั่งซื้อได้');
                        redirect('/shop/cart');
                        return;
                    }
                    //----
                    $list = $order_product;
                    $list['order_product_code'] = $p->product_code;
                    
                    $order_product_list[] = $list;
                }
                // add order complete
                $this->db->trans_complete();
                $this->session->set_userdata('cart', NULL);
                
                if( $this->input->post('type') != NULL && $this->input->post('type')=='web'){
                    echo "added.".$oid;
                    return;
                }
                //*** email
                $this->send_email_order($oid, $order_product_list, $dealer, $address);
                //***
                redirect('/shop/order/order_complete/'.$oid);
                return;
                //---
            }
            $this->db->trans_off();
            redirect('/shop/cart');
        }
        
        function view_orders_history(){
            $did = $this->session->userdata('dealer_id');
            $page = $this->input->get('page');
            if($page == NULL || is_nan($page)){
                $page = 1;
            }
            
            $lim = 25;
            $off = ($lim*$page)-$lim;
            $arr = array(
                'order_dealer_id' => $did,
                'order_order_status_id' => 5
            );
            $rows = $this->Order->get_num_rows($arr);
            if($rows%$lim == 0 || $rows%$lim == $lim){  // set page amount
                $page_amount = $rows/$lim;
            }else{
                $page_amount = $rows/$lim+1;
            }
            $orders = $this->Order->list_orders($arr, $lim, $off, 'obj', 'order_datetime DESC');  // get orders
            
            $data['orders'] = $orders;
            $data['page_amount'] = $page_amount;
            $data['page'] = $page;
            $this->load->view('pages/history', $data);
        }
        
        function order_complete(){
            //echo $oid = $this->uri->segment(4);
            // get id from uri and validate
            $oid = $this->uri->segment(4);
            if($oid == NULL){
                redirect('/shop/cart');
                return;
            }
            // get order by order_id and dealer level
            $q = array(
                'order_id' => $oid,
                'order_dealer_id' => $this->session->userdata('dealer_id'),
            );
            $order = $this->Order->get_order($q);
            if($order != NULL){
                $q = array(
                    'order_product_order_id' => $oid,
                );
                $order_products = $this->Order_product->list_order_products_view($q, 'obj');
                $price = 0;
                foreach($order_products as $op){
                    $price += $op->order_product_price*$op->order_product_quantity;
                }
                $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
                $banks = $this->Bank->list_banks();
                
                // set data and load view
                $data['order'] = $order;
                $data['order_products'] = $order_products;
                $data['total_product_price'] = $price;
                $data['dealer'] = $dealer;
                $data['banks'] = $banks;
                $this->load->view('pages/complete', $data);
                return;
            }
            redirect('/shop/product');
        }
        
        function remove(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('oid', 'oid', 'required|numeric');
            
            if($this->form_validation->run() == FALSE){
                return;
            }
            
            $oid = set_value("oid");

            $rm = $this->Order->remove($oid);
            if($rm == 1){
                $this->session->set_flashdata('rmmsg', 'รายการถูกลบแล้ว');
            }
            echo $rm;
        }
        
        //***
        function send_email_order($oid, $list, $dealer, $address){
            $content = '<h2>ยืนยันการสั่งซื้อ</h2><br/>';
            $content .= '<p>'.'สวัสดีค่ะ คุณ '.$dealer['dealer_fullname'].' ขอบคุณที่ไว้วางใจ เลือกซื้อสินค้ากับเรา ขณะนี้ทางเราได้รับรายการสั่งซื้อเรียบร้อยแล้ว'.'</p>';
            $content .= '<h2>ใบสั่งซื้อเลขที่ #'.$oid.'</h2><br/>';
            $content .= 'ที่อยู่ จัดส่ง'.'<br/>';
            $content .= '<p width="700">'.$address.'</p>';
            $content .= 'รายการสินค้า'.'<br/>';
            $content .= '<table style="width:700px;border:1px solid #e0e0e0;">';
            $content .= '<tr style="font-weight:bold;background-color:#e0e0e0;height:25px;"><td width="100">รหัสสินค้า</td><td>สินค้า</td><td width="50">จำนวน</td><td width="120">ราคา</td></tr>';
            foreach($list as $p){
                $content .= "<tr>";
                $content .= '<td style="text-align: left;">'.$p['order_product_code'].'</td>';
                $content .= '<td style="text-align: left;">'.$p['order_product_name'].'</td>';
                $content .= '<td style="text-align:right;">'.$p['order_product_quantity'].'</td>';
                $content .= '<td style="text-align:right;">'.display_money($p['order_product_quantity']*$p['order_product_price']).'</td>';
                $content .= "</tr>";
            }
            $content .= '</table>'.'<br/>';
            $order = $this->Order->get_order_by_id($oid);
            $content .= 'ราคารวม : '.$order['order_price'].'บาท'.'<br/>';
            $content .= '<p>'.'<a href="'.base_url().'shop/order/'.$oid.'/payment_report'.'"><button>แจ้งชำระเงิน</button></a>'.'</p>';
            
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($this->config->item('stmp_user'), 'Dealer System');
            $this->email->to($dealer['dealer_email']); 
            $this->email->subject('Dealer System | รายการสั่งซื้อ #'.$oid);
            $this->email->message($content);
            return $this->email->send();
        }
        
    }
    