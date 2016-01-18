<?php
    class Bank_set extends CI_Controller{
        
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
        }
        
        function view_banks(){
            
            $banks = $this->Bank->list_banks();
            
            $data['banks'] = $banks;
            $data['off'] = 0;
            $this->load->view('admin_v/allBank', $data);
        }
        
        function add_bank(){
            
            $this->load->view('admin_v/addBankaccount');
        }
        
        function add(){
            // validate form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bankName', 'bankName', 'required');
            $this->form_validation->set_rules('accountNum', 'accountNum', 'trim|required');
            $this->form_validation->set_rules('accountName', 'accountName', 'trim|required');
            $this->form_validation->set_rules('branch', 'branch', 'trim');
            
            if($this->form_validation->run() == FALSE){
                echo validation_errors();
                $this->session->set_flashdata('msg', 'ไม่สามารถเพิ่มบัญชีได้');
                echo "<script>window.history.back();</script>";
                return;
            }
            // set variable
            $bank_name = split('-', set_value('bankName'));  //split by - from pattern BANK-แยงค์
            $name = $bank_name[1];
            $picture = $bank_name[0];
            $account_name = set_value('accountName');
            $account_num = set_value('accountNum');
            $branch = set_value('branch');
            
            if(strlen($account_num) == 10 && is_numeric($account_num)){
                $new_num = substr($account_num, 0, 3)."-".$account_num[3]."-".substr($account_num, 4, 5)."-".substr($account_num, 9);
                $account_num = $new_num;
            }
            
            $bank_arr['bank_name'] = $name;
            $bank_arr['bank_number'] = $account_num;
            $bank_arr['bank_accountname'] = $account_name;
            $bank_arr['bank_branch'] = $branch;
            $bank_arr['bank_picture'] = $picture;
            $bank_arr['bank_status'] = 1;
            
            if($this->Bank->add($bank_arr) == TRUE){
                redirect('/admin/bank');
                return;
            }
            $this->session->set_flashdata('msg', 'ไม่สามารถเพิ่มบัญชีได้');
            echo "<script>window.history.back();</script>";
        }
        
        function edit_bank(){
            $bid = $this->uri->segment(3);
            if($bid == NULL || !is_numeric($bid)){
                redirect('/admin/bank');
                return;
            }
            
            $bank = $this->Bank->get_bank_by_id($bid);
            if($bank != NULL){
                $data['bank'] = $bank;
                $data['bank_name'] = $bank['bank_picture']."-".$bank['bank_name'];
                
                $this->load->view('admin_v/editBankaccount', $data);
                return;
            }
            redirect('/admin/bank');
        }
        
        function edit(){
            // validate form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bid', 'bid', 'required');
            $this->form_validation->set_rules('bankName', 'bankName', 'required');
            $this->form_validation->set_rules('accountNum', 'accountNum', 'trim|required');
            $this->form_validation->set_rules('accountName', 'accountName', 'trim|required');
            $this->form_validation->set_rules('branch', 'branch', 'trim');
            
            if($this->form_validation->run() == FALSE){
                echo validation_errors();
                $this->session->set_flashdata('msg', 'ไม่สามารถเพิ่มบัญชีได้');
                echo "<script>window.history.back();</script>";
                return;
            }
            // set variable
            $bid = set_value('bid');
            $bank_name = split('-', set_value('bankName'));  //split by - from pattern BANK-แยงค์
            $name = $bank_name[1];
            $picture = $bank_name[0];
            $account_name = set_value('accountName');
            $account_num = set_value('accountNum');
            $branch = set_value('branch');
            
            if(strlen($account_num) == 10 && is_numeric($account_num)){
                $new_num = substr($account_num, 0, 3)."-".$account_num[3]."-".substr($account_num, 4, 5)."-".substr($account_num, 9);
                $account_num = $new_num;
            }
            
            $bank_arr['bank_name'] = $name;
            $bank_arr['bank_number'] = $account_num;
            $bank_arr['bank_accountname'] = $account_name;
            $bank_arr['bank_branch'] = $branch;
            $bank_arr['bank_picture'] = $picture;
            $bank_arr['bank_status'] = 1;
            
            if($this->Bank->edit($bid, $bank_arr) == TRUE){
                redirect('/admin/bank');
            }
            $this->session->set_flashdata('msg', 'ไม่สามารถแก้ไขได้');
            echo "<script>window.history.back();</script>";
        }
        
        function remove(){
            $type = $this->input->post('type');
            $bid = $this->input->post('bid');
            
            if($type == 'bank' && is_numeric($bid)){
                if($this->Bank->remove($bid)){
                    echo 'removed';
                }
                return;
            }
            
        }
    }