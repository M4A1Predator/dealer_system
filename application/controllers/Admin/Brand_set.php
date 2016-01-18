<?php
    class Brand_set extends CI_Controller{
        
        var $lim = 10;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
        }
        
        function index(){
            
        }
        
        function view_brands(){
            // manage page input
            $page = $this->input->get('page');
            if(!$page || !is_numeric($page)){   //if page is invalid
                $page = 1;
            }
            $q = array(
                    'brand_status_id != ' => 0
                    );
            // manage page amount
            $rows = $this->Brand->get_num_rows($q);
            if($rows%$this->lim == 0 || $rows%$this->lim == $this->lim){
                $page_amount = $rows/$this->lim;
            }else{
                $page_amount = $rows/$this->lim+1;
            }
            
            if($page > $page_amount){ // if page number > all page set page to 1
                $page = 1;
            }
            // get data from db
            $off = ($page*$this->lim)-$this->lim;
            //$brands = $this->Brand->list_brands($q, $this->lim, $off, 'obj');
            $brands = $this->Brand->list_brands_with_products($q, $this->lim, $off, 'obj');
            
            // setdata
            $data['brands'] = $brands;
            $data['rows'] = $rows;
            $data['page_amount'] = (int)$page_amount;
            $data['page'] = $page;
            $data['off'] = $off;
            //loadview
            $this->load->view('admin_v/allBrand', $data);
        }
        
        function add_brand(){
            $this->load->view('/admin_v/addBrand');
        }
        
        function add_new_brand(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('brandName', 'brandName', 'trim|required|xss_clean');
            // if form is invalid
            if($this->form_validation->run() == FALSE){
                if(form_error('brandName')){
                    $this->session->set_flashdata('msg', 'กรุณาใส่ชื่อแบรนด์');
                    redirect('admin/add_brand');
                    return;
                }
            }
            
            $name = set_value('brandName');
            //add brand
            $arr = array(
                        'brand_name' => $name
                        );
            $res = $this->Brand->add($arr);
            // if can't add to db
            if($res == FALSE){
                $this->session->set_flashdata('msg', 'ไม่สามารถเพิ่มแบรนด์ได้');
                redirect('admin/add_brand');
                return;
            }
            redirect('admin/brand');
        }
        
        function brand_edit(){
            $bid = $this->uri->segment(3);
            if($bid == NULL || !is_numeric($bid)){
                $this->session->set_flashdata('msg', 'no brand id');
                redirect('/admin/brand');
                return;
            }
            $brand = $this->Brand->get_brand($bid, 'obj');
            if($brand != NULL){
                $data['brand'] = $brand;
                $this->load->view('admin_v/editBrand', $data);
                return;
            }
            $this->session->set_flashdata('msg', 'no brand');
            redirect('/admin/brand');
            return;
        }
        
        function edit(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('brandName', 'brandName', 'trim|required|xss_clean');
            $this->form_validation->set_rules('bid', 'bid', 'required|numeric');
            
            if(!$this->form_validation->run()){
                //echo validation_errors();
                redirect('admin/brand');
                return;
            }
            
            $bid = set_value('bid');
            $name = set_value('brandName');
            
            $q = array(
                    'brand_id' => $bid
                    );
            $new = array(
                        'brand_name' => $name
                        );
            $brand_edit = $this->Brand->edit($q, $new);
            if($brand_edit == TRUE){
                $this->session->set_flashdata('msg', 'แก้ไขแบรน์เรียบร้อย');
                redirect('/admin/brand');
                return;
            }
            $this->session->set_flashdata('msg', 'ไม่สามารถแก้ไขได้');
            redirect('/admin/brand_edit/'.$bid);
        }
        
        function remove(){
            $bid = $this->input->post('id');
            if($bid == NULL || is_nan($bid)){
                redirect('/admin/brand');
                return;
            }
            
            $res = $this->Brand->remove($bid);
            if($res == 1){
                $this->session->set_flashdata('msg', 'ลบแบรนด์เรียบร้อย');
            }
            echo $res;
        }
    }