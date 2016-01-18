<?php
    class Info_ctrl extends CI_Controller{
        
        var $info;
        var $buy_detail = 'details/buy_detail.json';
        
        function __construct(){
            parent::__construct();
            $this->info = $this->db->get('info')->row_array();
        }
        
        function contact(){
            
            //$data['contact'] = $this->info['info_contact'];
            $data['info'] = $this->info['info_contact'];
            $data['map'] = 'Contact';
            $data['page_name'] = 'ติดต่อเรา';
            
            $this->session->set_userdata('page', 'contact');
            //$this->load->view('pages/contact', $data);
            $this->load->view('pages/site_info', $data);
        }
        
        function about(){
            //$data['about'] = $this->info['info_about'];
            $data['info'] = $this->info['info_about'];
            $data['map'] = 'About';
            $data['page_name'] = 'เกี่ยวกับเรา';
            
            $this->load->view('pages/site_info', $data);
        }
        
        function qa(){
            $data['info'] = $this->info['info_qa'];
            $data['map'] = 'Q&A';
            $data['page_name'] = 'คำถามที่พบบ่อย';
            
            $this->load->view('pages/site_info', $data);
        }
        
        function suggest(){
            $data['info'] = $this->info['info_suggest'];
            $data['map'] = 'Suggest';
            $data['page_name'] = 'คำแนะนำการขาย';
            
            $this->load->view('pages/site_info', $data);
        }
        
        function howtobuy(){
            if(file_exists($this->buy_detail)){
                $jsonContent = file_get_contents($this->buy_detail);
                $json = json_decode($jsonContent);
                
                $data['info'] = $json->buy;
                $data['map'] = 'How to';
                $data['page_name'] = 'การสั่งซื้อ';
                
                $this->load->view('pages/site_info', $data);
                return;
            }
            
            redirect('/shop');
        }
        
        function howship(){
            if(file_exists($this->buy_detail)){
                $jsonContent = file_get_contents($this->buy_detail);
                $json = json_decode($jsonContent);
                
                $data['info'] = $json->ship;
                $data['map'] = 'Shipping';
                $data['page_name'] = 'การจัดส่งสินค้า';
                
                $this->load->view('pages/site_info', $data);
                return;
            }
            redirect('/shop');
        }
        
    }
    