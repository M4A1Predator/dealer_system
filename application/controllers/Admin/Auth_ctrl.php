<?php
    class Auth_ctrl extends CI_Controller{
        var $exp = 2592000;
        function __construct(){
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('Admin');
        }
        
        function index(){
            $this->load->helper('admin_authen_helper');
            if(check_login_admin()){
                redirect('/admin');
            }
            $this->load->view('admin_v/login');
        }
        
        function go_login(){
            $this->form_validation->set_rules('username', 'username', 'required|xss_clean|alpha_dash');
            $this->form_validation->set_rules('password', 'password', 'required|xss_clean|alpha_dash');
            
            $msg;
            // check form validation
            if($this->form_validation->run() == FALSE){
                //$msg = 'ไม่สามารถเข้าสู่ระบบได้';
                //$this->session->set_flashdata('msg', $msg);
                redirect('/admin/login');
                return;
            }
            
            $usr = set_value('username');
            $pwd = set_value('password');
            $remember = $this->input->post('remember');
            
            $this->load->model('Admin');
            $admin = $this->Admin->get_admin_by_login($usr, $pwd);

            //login process
            if($admin == NULL){
                //login failed
                $msg = 'Username หรือ Password ผิด';
                $this->session->set_flashdata('usr', $usr);
                $this->session->set_flashdata('msg', $msg);
                redirect('/admin/login');
                return;
            }
            
            $this->session->set_userdata($admin);
            if($remember){
                //verify_authen_admin();
                //set payload
                $payload = array(
                                'iss' => base_url(),
                                'exp' => time() + $this->exp,
                                'admin_id' => $this->session->userdata('admin_id'),
                                'admin_agent' => $this->session->userdata('user_agent')
                                );
                //encode JWT
                $tok = JWT::encode($payload, $this->config->item('JWT_KEY'));
                //delete old cookie
                /*while($this->input->cookie(COOK_ADMIN_NAME) != NULL){
                    delete_cookie(COOK_ADMIN_NAME);
                }*/
                //set cookie
                $cookarr = array(
                                'name' => COOK_ADMIN_NAME,
                                'value' => $tok,
                                'expire' => $this->exp
                                );
                $this->input->set_cookie($cookarr);
            }
            while($this->session->userdata('admin_username') == NULL){
                
            }
            //sleep(2);
            redirect('/admin');
        }
        
        function logout(){
            $this->session->sess_destroy();
            delete_cookie(COOK_ADMIN_NAME);
            redirect('/admin');
        }
        
        function test(){
            
        }
    }
    