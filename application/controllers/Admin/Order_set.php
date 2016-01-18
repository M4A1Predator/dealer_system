<?php
    ob_start();
    class Order_set extends CI_Controller{
        
        var $lim = 10;

        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
        }
        
        function edit_order(){
            $oid = $this->uri->segment(3);
            if($oid == NULL || is_nan($oid)){
                redirect('/admin');
                return;
            }
            
            $q = array(
                'order_product_order_id' => $oid,
            );
            // get product list and order
            $order_products = $this->Order_product->list_order_products_view($q, 'obj');
            $order = $this->Order->get_order(array('order_id' => $oid));
            if($order == NULL){
                redirect('/admin/order');
            }
            $status = $this->Order_status->list_order_status();
            $payment = $this->Payment->get_payment(array('payment_order_id' => $oid));
            
            $data['order_products'] = $order_products;
            $data['order'] = $order;
            $data['status'] = $status;
            $data['previous'] = isset($_SERVER['HTTP_REFERER'])==TRUE?$_SERVER['HTTP_REFERER']:base_url()."admin/order";
            $data['payment'] = $payment;
            $this->load->view('admin_v/showOrder', $data);
        }
        
        function view_orders(){
            $status = $this->input->get('st');
            $page = $this->input->get('page');
            
            if($page == NULL || $page =='' || is_nan($page)){
                $page = 1;
            }
            
            $q = array();
            if($status != NULL && is_numeric($status)){
                $q['order_order_status_id'] = $status;
            }else{
                $status = "";
            }
            
            $off = ($this->lim*$page)-$this->lim;
            $rows = $this->Order->get_num_rows($q);
            if($rows%$this->lim == 0 || $rows%$this->lim == $this->lim){
                $page_amount = $rows/$this->lim;
            }else{
                $page_amount = $rows/$this->lim+1;
            }
            if($page > $page_amount){
                $off = 0;
            }
            
            $orders = $this->Order->list_orders_with_dealer($q, $this->lim, $off, 'obj');
            $sts = $this->Order_status->list_order_status();    //get order status
            
            $data['orders'] = $orders;
            $data['sts'] = $sts;
            $data['osid'] = $status; // order status id
            $data['page_amount'] = $page_amount;
            $data['page'] = $page;
            $data['rows'] = $rows;
            $data['off'] = $off;
            $this->load->view('admin_v/allOrder', $data);
        }
        
        function edit_status(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('oid', 'oid', 'required|numeric');
            $this->form_validation->set_rules('newStatus', 'newStatus', 'required|numeric');
            
            if($this->form_validation->run() == FALSE){
                redirect('/admin');
                return;
            }
            
            $new_status = set_value("newStatus");
            $oid = set_value("oid");
            
            $q = array(
                'order_id' => $oid,
            );
            
            $new_arr = array(
                'order_order_status_id' => $new_status,
            );
            
            $order_update = $this->Order->edit($q, $new_arr);
            if($new_status == 3){
                //$this->send_email_confirm_payment($oid);
            }
            
            echo $order_update;
            
        }
        
        function print_order(){
            //echo "test";
            $oid = $this->uri->segment(3);
            if($oid == NULL || !is_numeric($oid)){
                redirect('/admin/order');
                exit;
            }
            
            // get order and order products
            $order_q = array(
                'order_id' => $oid,
            );
            $order = $this->Order->get_order($order_q);
            if($order != NULL){
                $list_q['order_product_order_id'] = $oid;
                $products = $this->Order_product->list_order_products_view($list_q, 'obj');
                $dealer = $this->Dealer->get_dealer($order['order_dealer_id']);
                
                $data['order'] = $order;
                $data['products'] = $products;
                $data['dealer'] = $dealer;
                
                $this->load->view('admin_v/print', $data);
                return;
            }
            redirect('/admin/order');
        }
        
        function delete_order(){
            $oid = $this->input->post('oid');
            $mode = $this->input->post('mode');
            if($oid == NULL || !is_numeric($oid)){
                return;
            }
            
            // delete order
            if($this->Order->remove($oid)){
                // check where refernce page
                if($mode == 'ajax'){
                    echo 'removed';
                }else if($mode == ''){
                    redirect('/admin/order');
                }
                return;
            }
        }
        
        function send_email_confirm_payment($oid){
            // prepare data
            $order = $this->Order->get_order_by_id($oid);
            $dealer = $this->Dealer->get_dealer($order['order_dealer_id']);
            
            // set message
            $content = '<h2>ยืนยันการชำระเงิน</h2><br/>';
            $content .= '<p>'.'สวัสดีค่ะ คุณ '.$dealer['dealer_fullname'].' ขณะนี้ทางเราได้รับและตรวจสอบข้อมูลการชำระเงินของท่านเรียบร้อยแล้ว'.'</p>';
            $content .= '<p style="font-weight:bold;">ใบสั่งซื้อเลขที่ #'.$oid.'</p><br/>';
            $content .= '<p>'.'สถานะ : ยืนยันการชำระเงินแล้ว'.'</p>'.'<br/>';
            $content .= '<p>'.'สามารถตรวจสอบสถานะการจัดส่งได้ที่ '.'<a href="'.base_url().'shop/order/'.$oid.'"><button>สถานะ</button></a>'.'</p>';
            
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from($this->config->item('stmp_user'), 'Dealer System');
            $this->email->to($dealer['dealer_email']); 
            $this->email->subject('Dealer System | ยืนยันการชำระเงิน รายการสั่งซื้อ #'.$oid);
            $this->email->message($content);
            return $this->email->send();
        }
        
    }
    