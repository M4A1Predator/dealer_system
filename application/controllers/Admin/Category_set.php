<?php
    ob_start();
    class Category_set extends CI_Controller{
        
        var $lim = 10;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
        }
        
        function index(){
            
        }
        
        function view_categories(){
            // manage page input
            $page = $this->input->get('page');
            if(!$page || !is_numeric($page)){
                $page = 1;
            }
            $q = array();
            // manage page amount
            $rows = $this->Category->get_num_rows($q);
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
            $cats = $this->Category->list_categories_with_products($q, $this->lim, $off, 'obj');
            
            // setdata
            $data['categories'] = $cats;
            $data['page_amount'] = (int)$page_amount;
            $data['page'] = $page;
            $data['off'] = $off;
            //loadview
            $this->load->view('admin_v/allCategory', $data);
            //echo $rows." ".$page_amount;
        }
        
        function add_category(){
            $this->load->view('admin_v/addCategory');
        }
        
        function add_new_category(){
            // validate form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('categoryName', 'categoryName', 'trim|required|xss_clean');
            // if form is invalid
            if($this->form_validation->run() == FALSE){
                if(form_error('categoryName')){
                    $this->session->set_flashdata('msg', 'กรุณาใส่ชื่อหมวดหมู่');
                    redirect('admin/add_category');
                    return;
                }
            }
            
            $name = set_value('categoryName');
            //add category
            $arr = array(
                        'category_name' => $name
                        );
            $res = $this->Category->add_category($arr);
            // if can't add to db
            if($res == FALSE){
                $this->session->set_flashdata('msg', 'ไม่สามารถเพิ่มหมวดหมู่ได้');
                redirect('admin/add_category');
                return;
            }
            redirect('admin/category');
        }
        
        function category_edit(){
            $cat_id = $this->uri->segment(3);
            if($cat_id == NULL || !is_numeric($cat_id)){
                redirect('/admin/category');
                return;
            }
            
            //load data from db by category_id
            $cat = $this->Category->get_category($cat_id, 'obj');
            if($cat != NULL){
                $data['cat'] = $cat;
                $this->load->view('admin_v/editCategory', $data);
                return;
            }
            redirect('/admin/category');
            return;
        }
        
        function edit(){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('catName', 'catName', 'trim|required|xss_clean');
            $this->form_validation->set_rules('catId', 'catId', 'required|numeric');
            
            if(!$this->form_validation->run()){
                //echo validation_errors();
                redirect('admin/category');
                return;
            }
            
            $cat_id = set_value('catId');
            $name = set_value('catName');
            
            $q = array(
                    'category_id' => $cat_id
                    );
            $new = array(
                        'category_name' => $name
                        );
            $cat_edit = $this->Category->edit($q, $new);
            if($cat_edit == TRUE){
                $this->session->set_flashdata('msg', 'แก้ไขหมวดหมู่เรียบร้อย');
                redirect('/admin/category');
                return;
            }
            $this->session->set_flashdata('msg', 'ไม่สามารถแก้ไขได้');
            redirect('/admin/category_edit/'.$cat_id);
        }
        
        function remove(){
            $cat_id = $this->input->post('id');
            if($cat_id == NULL || is_nan($cat_id)){
                redirect('/admin/category');
                return;
            }
            
            $res = $this->Category->remove($cat_id);
            if($res == 1){
                $this->session->set_flashdata('msg', 'ลบหมวดมู่เรียบร้อย');
            }
            echo $res;
        }
        
    }
    