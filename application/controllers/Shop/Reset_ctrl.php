<?php
    class Reset_ctrl extends CI_Controller {
        function __construct(){
            parent::__construct();
            $this->load->helper('authen_helper');
            date_default_timezone_set(SITE_TIMEZONE);
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
            
            $dealer = $this->Dealer->get_dealer_by_email($email, array('dealer_level_id !=' => 0));
            if($dealer != NULL){
                $tok = do_hash($email.time(), 'sha1');
                //remove first
                $this->Dealer->remove_reset_password(array('reset_password_dealer_id' => $dealer['dealer_id']));
                
                $rp_arr = array(
                    'reset_password_token' => $tok,
                    'reset_password_dealer_id' => $dealer['dealer_id']
                );
                // add token to table
                $rp_add = $this->Dealer->add_reset_password($rp_arr);
                if($rp_add != NULL){
                    $reset_url = base_url()."shop/reset_password?r=".$tok;  // prepare message
                    
                    $content = "<p>ลิงค์สำหรับ รีเซ็ตรหัสผ่านของคุณคือ ".$reset_url." </p>";
                    
                    //send an email
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $this->email->from($this->config->item('stmp_user'), 'Dealer System');
                    $this->email->to($email); 
                    
                    $this->email->subject('Dealer System | reset password');
                    $this->email->message($content);
                    
                    if($this->email->send()){ // if send successfull
                        $this->session->set_flashdata('sucmsg', 'ส่ง email เพื่อรีเซ็ตรหัสผ่านเรียบร้อยแล้ว');
                        redirect('/shop/login');
                        return;
                    }else{
                        //$this->session->set_flashdata('msg', 'email ไม่ส่ง'.$this->email->print_debugger());
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
        
        function set_new_password(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('tok', 'tok', 'required');
            $this->form_validation->set_rules('did', 'did', 'required|numeric');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('passwordConfirm', 'passwordConfirm', 'required|matches[password]');
            
            if($this->form_validation->run() == FALSE){
                //echo validation_errors();
                redirect('/shop');
                return;
            }
            
            $tok = set_value('tok');
            $did = set_value('did');
            $pwd = set_value('password');
            
            $rp_q = array(
                'reset_password_token' => $tok,
                'reset_password_dealer_id' => $did,
            );
            $rp = $this->Dealer->get_reset_password($rp_q);
            if($rp != NULL){
                $pwd = do_hash($pwd, 'sha256');
                $dealer_q = array('dealer_id' => $did);
                $dealer_new = array(
                    'dealer_password' => $pwd
                );
                $dealer_up = $this->Dealer->edit($dealer_q, $dealer_new);
                if($dealer_up ==1){
                    $this->session->set_flashdata('sucmsg', 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
                    redirect('/shop/login');
                    return;
                }
            }
            redirect('/shop/login');
        }
    }
    