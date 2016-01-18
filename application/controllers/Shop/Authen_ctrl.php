<?php
    ob_start();
    class Authen_ctrl extends CI_Controller{
        
        var $exp = 2592000;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('authen_helper');
            date_default_timezone_set('Asia/Bangkok');
        }
        
        function index(){
            echo 'ok';
        }
        
        function login(){
            if(check_login() == TRUE){
                redirect('/shop/logout');
            }
            
            $this->load->view('/pages/login');
        }
        
        function register(){
            if(check_login()){
                redirect('/shop');
                return;
            }
            $arr = array(
                'product_status_id != ' => 0
            );
            $product_amount = $this->Product->get_num_rows($arr);
            $arr = array(
                'dealer_level_id != ' => 0
            );
            $dealer_amount = $this->Dealer->get_num_rows($arr);
            $arr = array(
                'order_order_status_id ' => 5
            );
            $order_amount = $this->Order->get_num_rows($arr);
            $data['pa'] = $product_amount;
            $data['da'] = $dealer_amount;
            $data['oa'] = $order_amount;
            $this->load->view('/pages/regis', $data);
        }
        
        function go_login(){
            $this->load->helper('security');
            $this->load->helper('authen_helper');
            $msg = '';
            // validate form
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('password', 'password', 'trim|required|no_space');
            $remember = $this->input->post('remember');
            if($this->form_validation->run() == FALSE){
                $msg = 'ข้อมูลไม่ถูกต้อง';
                $this->session->set_flashdata('msg', $msg);
                redirect('/shop/login');
                return;
            }
            
            $usr = set_value('username');
            $pwd = do_hash(set_value('password'), 'sha256');
            $dealer = $this->Dealer->get_dealer_by_login($usr, $pwd);
            // if login success
            if($dealer != NULL){
                //set user data to session
                $this->session->set_userdata($dealer);
                // if remember
                $c = 0;
                // if server too slow
                while(!check_login()){
                    $c++;
                    sleep(1);
                    if($c >= 5){
                        redirect('/shop/login');
                        return;
                    }
                }
                if($remember){
                    // if remember, then set JWT
                    $payload = array(
                                'iss' => base_url(),
                                'exp' => time() + $this->exp,
                                'dealer_id' => $this->session->userdata('dealer_id'),
                                'dealer_agent' => $this->session->userdata('user_agent')
                                );
                    // encode JWT
                    $tok = JWT::encode($payload, $this->config->item('JWT_KEY'));
                    // set cookie
                    $cookie_arr = array(
                        'name' => COOK_USER_NAME,
                        'value' => $tok,
                        'expire' => $this->exp
                    );
                    $this->input->set_cookie($cookie_arr);
                }
                redirect('/shop');
                return;
            }else{
                $msg = "username หรือ password ไม่ถูกต้อง<br/>หรือบัญชีอาจยังไม่ได้รับการยืนยันจากทางร้าน";
            }
            $this->session->set_flashdata('username', $usr);
            $this->session->set_flashdata('msg', $msg);
            redirect('/shop/login');
        }
        
        function go_register(){
            $this->load->helper('security');
            $this->load->helper('transform_helper');
            $msg = '';
            // validate form
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash|min_length[4]|is_unique[dealer_dealer.dealer_username]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|no_space|min_length[8]');
            $this->form_validation->set_rules('passwordConfirm', 'passwordConfirm', 'trim|required|no_space|matches[password]');
            //$this->form_validation->set_rules('level', 'level', 'required');
            $this->form_validation->set_rules('firstname', 'firstname', 'trim|required');
            $this->form_validation->set_rules('lastname', 'lastname', 'trim|required');
            $this->form_validation->set_rules('address', 'address', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[dealer_dealer.dealer_email]');
            $this->form_validation->set_rules('tel', 'tel', 'trim|required');
            $this->form_validation->set_rules('line', 'line', 'trim|required');
            $this->form_validation->set_rules('shopname', 'shopname', 'trim');
            $this->form_validation->set_rules('website', 'website', 'trim');
            $this->form_validation->set_rules('fanpage', 'fanpage', 'trim');
            $this->form_validation->set_rules('facebook', 'facebook', 'trim');
            $this->form_validation->set_rules('detail', 'detail', 'trim');
            
            if($_FILES['photo']['error'] == 4){
                $this->form_validation->set_rules('photo', 'photo', 'required');
            }
            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('msg', 'ข้อมูลไม่ถูกต้อง');
                //echo validation_errors();
                echo "<script>window.history.back();</script>";
                return;
            }
            if($this->input->post('accept') != TRUE){
                $msg = 'กรุณายอมรับข้อตกลง';
                echo "<script>window.history.back();</script>";
                $this->session->set_flashdata('msg', $msg);
                return;
            }
            
            // set variables
            foreach($this->input->post() as $k => $v){
                echo $k." : ".$v."<br/>";
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
            
            $pwd = do_hash($pwd, 'sha256');
            $website = $website == ''?'':set_url_pattern($website);
            $fanpage = $fanpage == ''?'':set_url_pattern($fanpage);
            $facebook = $facebook == ''?'':set_url_pattern($facebook);
            $lv = $this->Level->get_level(array('level_order' => 0));
            if(strlen($tel) == 10 && is_numeric($tel)){
                $new_tel = substr($tel, 0, 3)."-".substr($tel, 3, 3)."-".substr($tel, 6);
                $tel = $new_tel;
            }
            
            // add dealer to db
            $this->db->trans_start();
            
            $dealer_arr = array(); // set array
            $dealer_arr['dealer_username'] = $usr;
            $dealer_arr['dealer_password'] = $pwd;
            $dealer_arr['dealer_fullname'] = $fullname;
            $dealer_arr['dealer_address'] = $addr;
            $dealer_arr['dealer_picture'] = '';
            $dealer_arr['dealer_email'] = $email;
            $dealer_arr['dealer_tel'] = $tel;
            $dealer_arr['dealer_line'] = $line;
            $dealer_arr['dealer_shopname'] = $shopname;
            $dealer_arr['dealer_website'] = $website;
            $dealer_arr['dealer_facebook'] = $facebook;
            $dealer_arr['dealer_fanpage'] = $fanpage;
            $dealer_arr['dealer_level_id'] = $lv['level_id'];
            $dealer_arr['dealer_detail'] = $detail;
            $dealer_arr['dealer_datetime'] = date('Y-m-d H:i:s');
            
            $dealer_add = $this->Dealer->add($dealer_arr);
            if($dealer_add != NULL){
                //echo  "added ";
                $did = $dealer_add['id'];
                
                $this->load->library('upload');
                $config['upload_path'] = DEALER_IMG_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = true;
                //$config['max_size']	= '';
                $config['max_width']  = '5000';
                $config['max_height']  = '5000';
                $config['file_name'] = do_hash('dealers-'.$did, 'sha1');
                $filename = 'photo';  //input tag name
                $this->upload->initialize($config);
                if($this->upload->do_upload($filename)){
                    //echo "uoload";
                    $ud = $this->upload->data();
                    $img_path = DEALER_IMG_PATH."/".$ud['file_name'];
                    //* resize image
                    $this->load->library('image_lib');
                    $config_img['image_library'] = 'gd2';
                    $config_img['source_image']	= $img_path;
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
                    
                    $q = array(
                            'dealer_id' => $did
                        );
                    $new_data = array(
                            'dealer_picture' => $img_path
                        );
                    $dealer_up = $this->Dealer->edit($q, $new_data);
                    if($dealer_up != 0){
                        $this->db->trans_complete();
                        $msg = 'สมัครเรียบร้อย กรุณารอการติดต่อทางไลน์จากทางร้าน';
                        $this->session->set_flashdata('sucmsg', $msg);
                        redirect('/shop/login');
                        return;
                    }else{
                        $msg = 'ไม่สามารถลงทะเบียนได้';
                    }
                }else{
                    //echo $this->upload->display_errors();
                    $msg = 'ไฟล์รูปภาพไม่ถูกต้อง';
                }
            }else{
                $msg = 'ไม่สามารถลงทะเบียนได้';
            }
            $this->db->trans_off();
            $this->session->set_flashdata('msg', $msg);
            echo "<script>window.history.back();</script>";
        }
        
        function logout(){
            $this->session->sess_destroy();
            delete_cookie(COOK_USER_NAME);
            redirect('/shop');
        }
        
        function forgot_password(){
            if(check_login()){
                redirect('/shop');
                return;
            }
            $this->load->view('pages/forgot');
        }
        
        function send_reset_password(){
            $this->load->helper('security');
            
            $email = $this->input->post('email');
            if($email == NULL || $email == ''){
                redirect('/shop/login');
                return;
            }
            
            $dealer = $this->Dealer->get_dealer_by_email($email);
            if($dealer != NULL){
                $tok = do_hash($email.time(), 'sha1');
                //remove first
                $this->Dealer->remove_reset_password(array('reset_password_dealer_id' => $dealer['dealer_id']));
                
                $rp_arr = array(
                    'reset_password_token' => $tok,
                    'reset_password_dealer_id' => $dealer['dealer_id']
                );
                
                $rp_add = $this->Dealer->add_reset_password($rp_arr);
                if($rp_add != NULL){
                    $reset_url = base_url()."shop/reset_password?r=".$tok;
                    $content = "<p>ลิงค์สำหรับ รีเซ็ตรหัสผ่านของคุณคือ ".$reset_url." </p>";
                    
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $this->email->from($this->config->item('stmp_user'), 'Dealer System');
                    $this->email->to($email); 
                    
                    $this->email->subject('Dealer System | reset password');
                    $this->email->message($content);
                    
                    if($this->email->send()){
                        $this->session->set_flashdata('msg', 'ส่ง email เพื่อรีเซ็ตรหัสผ่านเรียบร้อยแล้ว');
                        redirect('/shop/login');
                        return;
                    }else{
                        //$this->session->set_flashdata('msg', 'email ไม่ส่ง');
                    }
                }else{
                    //$this->session->set_flashdata('msg', 'add failed');
                }
            }else{
                $this->session->set_flashdata('msg', 'email ไม่ถูกต้อง');
            }
            $this->session->set_flashdata('email', $email);
            redirect('/shop/forgot_password');
        }
        
        function check_reset_token(){
            $tok = $this->input->get('r');
            if(isset($tok) == FALSE){
                redirect('/shop/login');
                return;
            }
            
            $rp = $this->Dealer->get_reset_password(array( 'reset_password_token' => $tok ));
            if($rp != NULL){
                $dealer = $this->Dealer->get_dealer_by_id($rp['reset_password_dealer_id']);
                $data['tok'] = $tok;
                $data['dealer'] = $dealer;
                $this->load->view('pages/reset', $data);
                return;
            }
            redirect('/shop/login');
        }
        
        //------check unique name---------
        function check_uqname(){
            $this->load->library('form_validation');
            $col = $this->input->post('type');
            $this->form_validation->set_rules('name', 'name', 'required|is_unique[dealer_dealer.dealer_'.$col.']');
            
            $this->form_validation->set_message('is_unique', 'dup');
            if(!$this->form_validation->run()){
                echo 0;
            }else{
                echo 1;
            }
        }
        
        function clear_session(){
            $sn = array(
                'dealer_id' => '',
                'dealer_username' => '',
                'dealer_fullname' => '',
                'dealer_level_id' => '',
            );
            
            $this->session->unset_userdata($sn);
        }
    }
    