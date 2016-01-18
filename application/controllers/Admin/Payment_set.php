<?php
    class Payment_set extends CI_Controller{
        var $lim = 10;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
        }
        
        function view_payment(){
            $id = $this->uri->segment(3);
            if($id == NULL || strlen($id) === 0){
                rederict('/admin');
                return;
            }
            $previous = isset($_SERVER['HTTP_REFERER'])==TRUE?$_SERVER['HTTP_REFERER']:base_url()."admin/order/payment";
            
            if($this->uri->segment(4) == 'payment'){
                $p_arr = array(
                    'payment_order_id' => $id
                );
                $order = $this->Order->get_order_by_id($id);
            }else{
                $id = $this->uri->segment(4);
                $p_arr = array(
                    'payment_id' => $id
                );
                //$order = $this->Order->get_order_by_id($id);
            }
            $payment = $this->Payment->get_payment($p_arr);
            $order = $this->Order->get_order_by_id($payment['payment_order_id']);
            if($payment == NULL){
                $this->session->set_flashdata('ntmsg', 'ไม่พบรายการแจ้งโอนเงิน');
                //redirect($previous);
                echo "<script>window.history.back();</script>";
                return;
            }
            
            $data['payment'] = $payment;
            $data['previous'] = isset($_SERVER['HTTP_REFERER'])==TRUE?$_SERVER['HTTP_REFERER']:base_url()."admin/order/payment";
            $data['order'] = $order;
            
            $this->load->view('admin_v/detailPayment', $data);
        }
        
        function view_payments(){
            $status = $this->input->get('st');
            $page = $this->input->get('page');
            if($page == NULL || $page =='' || is_nan($page)){
                $page = 1;
            }
            $p_arr = array();   //ftilter
            if($status != NULL && is_numeric($status)){
                $p_arr['order_order_status_id'] = $status;
            }else{
                $status = "";
            }
            
            $off = ($this->lim*$page)-$this->lim;
            $rows = $this->Payment->get_num_rows($p_arr);
            if($rows%$this->lim == 0 || $rows%$this->lim == $this->lim){
                $page_amount = $rows/$this->lim;
            }else{
                $page_amount = $rows/$this->lim+1;
            }
            
            $payments = $this->Payment->list_payments($p_arr, $this->lim, $off, 'obj');
            $sts = $this->Order_status->list_order_status();
            
            $data['payments'] = $payments;
            $data['sts'] = $sts;
            $data['osid'] = $status;
            $data['page_amount'] = $page_amount;
            $data['page'] = $page;
            $data['rows'] = $rows;
            $data['off'] = $off;
            $this->load->view('admin_v/allPayment', $data);
        }
        
        function confirm(){
            $oid = $this->input->post('oid');
            
            if($oid == NULL){
                echo false;
                return;
            }
            
            $order_q = array(
                'order_id' => $oid
            );
            
            $order = $this->Order->get_order($order_q);
            if($order['order_order_status_id'] < 3){
                $order_arr = array('order_order_status_id' => 3);
                //$order_update = $this->Order->edit($order_q, $order_arr);
                $update = $this->Order->edit($order_q, $order_arr);
                if($update){
                    echo 1;
                    $this->send_email_confirm_payment($oid);
                }else{
                    echo 0;
                }
                return;
            }
            echo 1;
            return;
            
        }
        
        function remove(){
            $oid = $this->input->post('oid');
            $pid = $this->input->post('pid');
            
            if($oid == NULL){
                echo false;
                return;
            }
            
            $this->db->trans_start();
            // change order status first
            $order_q = array('order_id' => $oid);
            
            $order = $this->Order->get_order($order_q);
            if($order['order_order_status_id'] < 3){
                $order_arr = array('order_order_status_id' => 1);
                $order_update = $this->Order->edit($order_q, $order_arr);
            }
            
            $payment = $this->Payment->get_payment_by_id($pid);
            // delete image file
            $img_path = $payment['payment_img'];
            if(file_exists($img_path)){
                unlink($img_path);
            }
            $payment_rm = $this->Payment->remove($pid);
            if($payment_rm == 1){
                $this->db->trans_complete();
                echo 1;
                return;
            }
            //}
            $this->db->trans_off();
            echo 0;
            
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