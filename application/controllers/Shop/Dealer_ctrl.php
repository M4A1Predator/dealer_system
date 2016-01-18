<?php
    ob_start();
    class Dealer_ctrl extends CI_Controller{
        function __construct(){
            parent::__construct();
            verify_authen();
            $this->session->set_userdata('page', '');
            date_default_timezone_set('Asia/Bangkok');
        }
        
        function account(){
            $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
            
            // get amount of products
            $q = array(
                'order_dealer_id' => $this->session->userdata('dealer_id')
            );
            $all_amount = $this->Order->get_order_amount($q);
            // get previous month
            //$this->db->select("MONTH(DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00')) as m");          
            //$mm = $this->db->get('')->row_array();
            
            //** set date
            $year = date('Y');
            $month = date('m');
            $date_ym = DateTime::createFromFormat('Y-m-d', $year.'-'.$month.'-01');
            $this_month = date_format($date_ym, 'Y-m');
            $date_lastmonth = $date_ym->modify('-1 month');
            $last_month = date_format($date_lastmonth, 'Y-m');
            //** 
            
            $q["DATE_FORMAT(dealer_order.order_datetime, '%Y-%m') = "] = $last_month;
            $previous_amount = $this->Order->get_order_amount($q);
            // get this month
            $q = array(
                'order_dealer_id' => $this->session->userdata('dealer_id'),
                //'MONTH(dealer_order.order_datetime) = ' => $nm['m']
                "DATE_FORMAT(dealer_order.order_datetime, '%Y-%m') = " => $this_month
            );
            $now_amount = $this->Order->get_order_amount($q);
            
            // get spent money
            $q = array(
                'order_dealer_id' => $this->session->userdata('dealer_id'),
            ); 
            $all_spent = $this->Order->get_order_spent($q);
            // get spent money for this month 
            //$q['MONTH(dealer_order.order_datetime) = '] = $nm['m'];
            $q["DATE_FORMAT(dealer_order.order_datetime, '%Y-%m') = "] = $this_month;
            $now_spent = $this->Order->get_order_spent($q);
            
            // get last 10 orders
            $list_order_arr = array(
                'order_dealer_id' => $this->session->userdata('dealer_id'),
            );
            $last_orders = $this->Order->list_orders($list_order_arr, 10, 0, 'obj', 'order_status_sort ASC, order_id DESC');
            
            $data = array();
            $data['dealer'] = $dealer;
            $data['all_amount'] = $all_amount['amount'];
            $data['previous_amount'] = $previous_amount['amount'];
            $data['now_amount'] = $now_amount['amount'];
            $data['all_spent'] = $all_spent['amount'];
            $data['benefit'] = $all_spent['benefit'];
            $data['now_spent'] = $now_spent['amount'];
            $data['orders'] = $last_orders;
           
            $this->load->view('pages/account', $data);
        }
        
        function profile(){
            $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
            
            $data['dealer'] = $dealer;
            $this->session->set_userdata('side_sel', 'profile');
            $this->load->view('pages/profile', $data);
        }
        
        function edit_profile(){
            $dealer = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
            
            $data['dealer'] = $dealer;
            $this->load->view('pages/editaccount', $data);
        }
        
        function edit(){
            $this->load->helper('security');
            $this->load->helper('transform_helper');
            $msg = '';
            $did = $this->session->userdata('dealer_id');
            $dealer = $this->Dealer->get_dealer($did);
            // validate form
            $this->load->library('form_validation');            
            //$this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash|min_length[4]|is_unique[dealer_dealer.dealer_username]');
            $this->form_validation->set_rules('password', 'password', 'trim|no_space|min_length[8]');
            $this->form_validation->set_rules('newPwd', 'newPwd', 'trim|no_space|min_length[8]');
            $this->form_validation->set_rules('newPwdConfirm', 'newPwdConfirm', 'trim|no_space|matches[newPwd]');
            //$this->form_validation->set_rules('level', 'level', 'required');
            $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
            $this->form_validation->set_rules('address', 'address', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('tel', 'tel', 'trim|required');
            $this->form_validation->set_rules('line', 'line', 'trim|required');
            $this->form_validation->set_rules('shopname', 'shopname', 'trim');
            $this->form_validation->set_rules('website', 'website', 'trim');
            $this->form_validation->set_rules('fanpage', 'fanpage', 'trim');
            $this->form_validation->set_rules('facebook', 'facebook', 'trim');
            $this->form_validation->set_rules('detail', 'detail', 'trim');
            
            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('msg', 'ข้อมูลไม่ถูกต้อง');
                echo validation_errors();
                echo "<script>window.history.back();</script>";
                return;
            }
            
            $usr = set_value('username');
            $pwd = set_value('password');
            $fullname = set_value('firstname')." ".set_value('lastname');
            $addr = set_value('address');
            $email = set_value('email');
            $tel = set_value('tel');
            $line = set_value('line');
            $shopname = set_value('shopname');
            $website = set_value('website');
            $fanpage = set_value('fanpage');
            $facebook = set_value('facebook');
            $detail = set_value('detail');
            $pwd = $pwd!=''?do_hash($pwd, 'sha256'):'';
            $website = $website == ''?'':set_url_pattern($website);
            $fanpage = $fanpage == ''?'':set_url_pattern($fanpage);
            $facebook = $facebook == ''?'':set_url_pattern($facebook);
            
            if(strlen($tel) == 10 && is_numeric($tel)){
                $new_tel = substr($tel, 0, 3)."-".substr($tel, 3, 3)."-".substr($tel, 6);
                $tel = $new_tel;
            }
            
            $dealer_arr = array();
            // set change data
            if(set_value('newPwd') != ''){
                $dealer_log = $this->Dealer->get_dealer_by_login($dealer['dealer_username'], $pwd);
                if($dealer_log != NULL){
                    $new_pwd = do_hash(set_value('newPwd'), 'sha256');
                    $dealer_arr['dealer_password'] = $new_pwd;
                }else{
                    $this->session->set_flashdata('msg', 'รหัสผ่านเดิมไม่ถูกต้อง');
                    echo "<script>window.history.back();</script>";
                    return;
                }
            }
            
            if($_FILES['photo']['error'] === 0){
                $this->load->library('upload');
                $config['upload_path'] = DEALER_IMG_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = true;
                $config['max_size']	= '4048';
                $config['max_width']  = '2100';
                $config['max_height']  = '2100';
                $config['file_name'] = do_hash('dealers-'.$did, 'sha1');
                $config['overwrite'] = TRUE;
                $filename = 'photo';  //input tag name
                
                if(file_exists($dealer['dealer_picture'])){
                    unlink($dealer['dealer_picture']);
                }
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload($filename)){
                    //echo "test".$this->upload->display_errors();
                    $this->session->set_flashdata('msgprofile', 'ไฟล์รูปภาพไม่ถูกต้อง');
                    echo "<script>window.history.back();</script>";
                    return;
                }
                $ud = $this->upload->data();
                $new_img_path = DEALER_IMG_PATH."/".$ud['file_name'];
                //* resize image
                $this->load->library('image_lib');
                $config_img['image_library'] = 'gd2';
                $config_img['source_image']	= $new_img_path;
                $config_img['create_thumb'] = FALSE;
                $config_img['maintain_ratio'] = TRUE;
                $config_img['width']	= 400;
                $config_img['height']	= 400;
                $dim = (intval($ud["image_width"]) / intval($ud["image_height"])) - ($config_img['width'] / $config_img['height']);
                $config_img['master_dim'] = ($dim > 0)? "height" : "width";
                $this->image_lib->clear();
                $this->image_lib->initialize($config_img);
                $this->image_lib->resize();
                //***
                $dealer_arr['dealer_picture'] = $new_img_path;
                
            }
            $dealer_arr['dealer_fullname'] = $fullname;
            $dealer_arr['dealer_address'] = $addr;
            $dealer_arr['dealer_email'] = $email;
            $dealer_arr['dealer_tel'] = $tel;
            $dealer_arr['dealer_line'] = $line;
            $dealer_arr['dealer_shopname'] = $shopname;
            $dealer_arr['dealer_website'] = $website;
            $dealer_arr['dealer_facebook'] = $facebook;
            $dealer_arr['dealer_fanpage'] = $fanpage;
            $dealer_arr['dealer_detail'] = $detail;
            
            $o_arr = array(
                'dealer_id' => $did
            );
            $up_dealer = $this->Dealer->edit($o_arr, $dealer_arr);
            if($up_dealer == TRUE){
                $this->session->set_flashdata('rmmsg', 'แก้ไขเรียบร้อย');
                redirect('/shop/account/profile');
                return;
            }
            $this->session->set_flashdata('msgprofile', 'ไม่สามารถแก้ไขได้');
            echo "<script>window.history.back();</script>";
        }
    }
