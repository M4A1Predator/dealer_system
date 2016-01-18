<?php
ob_start();
    class Admin_ctrl extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
            $this->load->model('Admin');
            date_default_timezone_set('Asia/Bangkok');
        }
        
        function index(){
            
            //** set date
            $today = date("Y-m-d");
            $year = date('Y');
            $month = date('m');
            $date_ym = DateTime::createFromFormat('Y-m-d', $year.'-'.$month.'-01');
            $this_month = date_format($date_ym, 'Y-m');
            //$date_lastmonth = $date_ym->modify('-1 month');
            //$last_month = date_format($date_lastmonth, 'Y-m');
            //** 
            
            // get sale amount
            $total = $this->Order->get_sale_amount();
            $total_year = $this->Order->get_sale_amount(array('DATE_FORMAT(order_datetime, "%Y") =' => $year));
            $total_month = $this->Order->get_sale_amount(array('DATE_FORMAT(order_datetime, "%Y-%m") =' => $this_month));
            $total_day = $this->Order->get_sale_amount(array('DATE(order_datetime)' => $today));
            
            $order_filt['order_order_status_id = 1 OR order_order_status_id = 2'] = NULL;
            $lim = 15;
            $off = 0;
            $last_orders = $orders = $this->Order->list_orders_with_dealer($order_filt, $lim, $off, 'obj', 'order_datetime DESC');
            
            $data['sale_total'] = $total['amount'];
            $data['sale_this_year'] = $total_year['amount'];
            $data['sale_this_month'] = $total_month['amount'];
            $data['sale_this_day'] = $total_day['amount'];
            $data['orders'] = $last_orders;
            $data['off'] = $off;
            $this->load->view('admin_v/index', $data);
        }
        
        function setting(){
            $admin = $this->Admin->get_admin_by_id($this->session->userdata('admin_id'));
            
            $data['admin'] = $admin;
            $this->load->view('admin_v/setting', $data);
        }
        
        function register(){
            if($this->session->userdata('admin_level') != 1){
                redirect('/admin');
                return;
            }
            $this->load->view('admin_v/addAdmin');
        }
        
        function go_register(){
            if($this->session->userdata('admin_level') != 1){
                redirect('/admin');
                return;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('adminName', 'adminName', 'trim|required|is_unique[dealer_admin.admin_username]');
            $this->form_validation->set_rules('password', 'password', 'required|no_space|min_length[6]');
            $this->form_validation->set_rules('passwordConfirm', 'passwordConfirm', 'matches[password]');
            $this->form_validation->set_rules('level', 'level', 'required');
            
            $this->form_validation->set_message('is_unique', 'ไม่สามารถใช้ username นี้ได้');
            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('msg', validation_errors());
                echo "<script>window.history.back();</script>";
                return;
            }
            
            $usr = set_value('adminName');
            $pwd = set_value('password');
            $level = set_value('level');
            
            if($this->Admin->register($usr, $pwd, $level)){
                $this->session->set_flashdata('ntmsg', '<h4>เพิ่ม admin เรียบร้อย</h4>');
                redirect('/admin');
            }else{
                $this->session->set_flashdata('msg', 'ไม่สามารถเพิ่มได้');
                echo "<script>window.history.back();</script>";
            }
            return;
        }
        
        function edit(){
            $aid = $this->session->userdata('admin_id');
            // validate form
            $this->load->library('form_validation');
            if($this->input->post('adminName') != $this->session->userdata('admin_username')){
                $this->form_validation->set_rules('adminName', 'adminName', 'required|is_unique[dealer_admin.admin_username]');
                $change_name = TRUE;
            }
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('newPassword', 'newPassword', 'no_space');
            $this->form_validation->set_rules('newPasswordConfirm', 'newPasswordConfirm', 'matches[newPassword]');
            
            $this->form_validation->set_message('is_unique', 'ไม่สามารถใช้ username นี้ได้');
            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('msg', validation_errors());
                echo "<script>window.history.back();</script>";
                return;
            }
            
            $username = $this->session->userdata('admin_username');
            $pwd = set_value('password');
            
            //***
            // check password
            $admin = $this->Admin->get_admin_by_login($username, $pwd);
            if($admin != NULL){
                // set varaible
                $new_pwd = set_value('newPassword');
                $new_username = set_value('adminName');
                //if data change, then update
                if($change_name == TRUE){
                    $this->Admin->change_username($aid, $new_username);
                    $this->session->set_userdata('admin_username', $new_username);
                }
                if($new_pwd != ''){
                    $this->Admin->change_password($aid, $new_pwd);
                }
                $this->session->set_flashdata('ntmsg', '<h4>แก้ไขเรียบร้อย</h4>');
                redirect('/admin');
                return;
            }else{
                $this->session->set_flashdata('msg', 'รหัสผ่านปัจจุบันผิด');
                echo "<script>window.history.back();</script>";
                return;
            }
            //echo "<script>window.history.back();</script>";
            redirect('/admin/setting');
        }
        
        function view_admins(){
            $page = $this->input->get('page');
            if(!$page || !is_numeric($page)){   //if page is invalid
                $page = 1;
            }
            
            $admins = $this->Admin->list_admins();
            
            $data['admins'] = $admins;
            $data['off'] = 0;
            $data['page_amount'] = 1;
            $data['page'] = 1;
            $this->load->view('admin_v/allAdmin', $data);
        }
        
        function remove(){
            if($this->session->userdata('admin_level') != 1){
                redirect('/admin');
                return;
            }
            
            $type = $this->input->post('type');
            $id = $this->input->post('id');
            
            if($type != 'admin' || !is_numeric($id)){
                return;
            }
            
            if($this->Admin->remove($id)){
                echo 1;
                return;
            }
        }
        
        //---check unique name
        function check_uqname(){
            $this->load->library('form_validation');
            $col = $this->input->post('type');
            $this->form_validation->set_rules('name', 'name', 'required|is_unique[dealer_admin.admin_'.$col.']');
            
            $this->form_validation->set_message('is_unique', 'dup');
            if(!$this->form_validation->run()){
                //echo validation_errors();
                echo 0;
            }else{
                echo 1;
            }
        }
    }