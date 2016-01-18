<?php
    ob_start();
    class Product_set extends CI_Controller{
        
        var $lim = 20;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
            date_default_timezone_set('Asia/Bangkok');
        }
        
        function index(){
            
        }
        
        function view_products(){
            // validate form
            $name = $this->input->get('name');
            $brand_id = $this->input->get('b');
            $cat_id = $this->input->get('cat');
            $page = $this->input->get('p');
            
            $q = array(
                    'product_status_id !=' => 0
                    );
            if($name != NULL && strlen($name) > 0){
                $q['product_name like'] = $name.'%';
                $search_name = $name;
            }else{
                $search_name = '';
            }
            if(!$page || !is_numeric($page) || $page == ''){
                $page = 1;
            }
            if($cat_id && is_numeric($cat_id)){
                $q['product_category_id'] = $cat_id;
            }
            if($brand_id && is_numeric($brand_id)){
                $q['product_brand_id'] = $brand_id;
            }
            
            //get data from db
            $off = ($this->lim*$page)-$this->lim;
            $products = $this->Product->list_products($q, $this->lim, $off, 'obj');
            $rows = $this->Product->get_num_rows($q);
            if($rows%$this->lim == 0 || $rows%$this->lim == $this->lim){
                $page_amount = $rows/$this->lim;
            }else{
                $page_amount = $rows/$this->lim+1;
            }
            
            //set data
            $data['products'] = $products;
            $data['cats'] = $this->Category->list_categories();
            $data['brands'] = $this->Brand->list_brands();
            $data['page'] = $page;
            $data['page_amount'] = $page_amount;
            $data['rows'] = $rows;
            $data['cur_cat_id'] = $cat_id;
            $data['cur_b_id'] = $brand_id;
            $data['search_name'] = $search_name;
            $this->load->view('admin_v/allProduct', $data);
        }
        
        //* View add Product;
        function add_product(){
            $levels = $this->Level->list_levels();
            $data['levels'] = $levels;
            $data['cats'] = $this->Category->list_categories(array(), 0, 0, 'arr');
            $data['brands'] = $this->Brand->list_brands(array(), 0, 0, 'arr');

            $this->load->view('admin_v/addProduct', $data);
        }
        
        //* add product to db
        function add_new_product(){
            $msg = '';
            //validate form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('productCode', 'productCode', 'trim|required');
            $this->form_validation->set_rules('productName', 'productName', 'trim|required');
            $this->form_validation->set_rules('brandProduct', 'brandProduct', 'trim|required|numeric');
            $this->form_validation->set_rules('catagoryProduct', 'catagoryProduct', 'trim|required|numeric');
            $this->form_validation->set_rules('detailProduct', 'detailProduct', 'required');
            $this->form_validation->set_rules('fullPrice', 'fullPrice', 'trim|required|numeric');
            
            $levels = $this->Level->list_levels(); //declare level rules
            foreach($levels as $lv){
                //echo key($lv)."<br/>";
                $this->form_validation->set_rules('vipPrice'.$lv['level_id'], 'vipPrice'.$lv['level_id'], 'numeric');
            }
            
            if($_FILES['photoProduct1']['error'] == 4){  // declare required image
                $this->form_validation->set_rules('photoProduct', 'photoProduct', 'required');
            }else{
                $allow_ext = array('gif', 'jpg', 'png', 'jpeg');
                $ext = strtolower(pathinfo($_FILES['photoProduct1']['name'], PATHINFO_EXTENSION));
                if(!in_array($ext, $allow_ext)){
                    $this->session->set_flashdata('msgimg1', 'ไฟล์รูปภาพไม่ถูกต้อง');
                    $this->session->set_flashdata('productCode' , $this->input->post('productCode'));
                    $this->session->set_flashdata('productName' , $this->input->post('productName'));
                    $this->session->set_flashdata('detailProduct', $this->input->post('detailProduct'));
                    $this->session->set_flashdata('fullPrice' , $this->input->post('fullPrice'));
                    echo "<script>window.history.back();</script>";
                    return;
                }
            }
            $this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
            if(!$this->form_validation->run()){
                //if form is invalid, back to previous page.
                echo validation_errors();
                if(form_error('productCode')){
                    $this->session->set_flashdata('msgcode', form_error('productCode'));
                }else if(form_error('productName')){
                    $this->session->set_flashdata('msgname', form_error('productName'));
                }
                $this->session->set_flashdata('msg', validation_errors());
                echo "<script>window.history.back();</script>";
                return;
            }
            
            // prepare imange to upload
            $img_names = array();
            //$c = 1;
            /*
            foreach($_FILES as $fn => $f){
                echo "C at before = ".$c."<br/>";
                echo "now field = ".$fn."<br/>";
                if($f['error'] == 0){   // if has file, then check ext
                    $ext =  strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                    if(!in_array($ext, $allow_ext)){
                        $this->session->set_flashdata('msg'.$c, 'ไฟล์รูปไม่ถูกต้อง');
                        echo "<script>window.history.back();</script>";
                        return;
                    }
                    // if valid ext >> add tagname to filename array
                    $img_names[$c] = $f;
                    $img_names[$c]['ext'] = $ext;
                    echo '$f = '.$c."<br/>";
                }
                $c++;
                echo 'C at after'.$c."<br/>";
            }*/
            $max_img = 3;
            for($i=1; $i<=$max_img; $i++){
                $f = $_FILES['photoProduct'.$i];
                if($f['error'] == 0){   // if has file, then check ext
                    $ext =  strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                    if(!in_array($ext, $allow_ext)){
                        $this->session->set_flashdata('msg'.$i, 'ไฟล์รูปไม่ถูกต้อง');
                        echo "<script>window.history.back();</script>";
                        return;
                    }
                    // if valid ext >> add tagname to filename array
                    $img_names[$i] = $f;
                    $img_names[$i]['ext'] = $ext;
                }
            }
            
            // set data from form
            $code = set_value('productCode');
            $name = set_value('productName');
            $bid = set_value('brandProduct');
            $cat_id = set_value('catagoryProduct');
            $detail = set_value('detailProduct');
            $price = (double)set_value('fullPrice');
            $price_lv = array();
            foreach($levels as $lv){    // set price array follow the levels
                /*if(set_value('vipPrice'.$lv['level_id']) != ''){    // don't need to add for all levels [Algo]
                    $price_lv[$lv['level_id']] = set_value('vipPrice'.$lv['level_id']);
                }*/
                $price_lv[$lv['level_id']] = set_value('vipPrice'.$lv['level_id']) != ''?set_value('vipPrice'.$lv['level_id']):$price;
            }
            
            //add product process
            $this->db->trans_strict(TRUE);  // enable transaction mode
            $this->db->trans_start();
            
            $this->load->library('upload');
            
            //set product array
            $product_arr['product_code'] = $code;
            $product_arr['product_name'] = $name;
            $product_arr['product_detail'] = $detail;
            $product_arr['product_img1'] = '';
            $product_arr['product_price'] = $price;
            $product_arr['product_status_id'] = 1;
            $product_arr['product_category_id'] = $cat_id;
            $product_arr['product_brand_id'] = $bid;
            $product_arr['product_datetime'] = date('Y-m-d H:i:s');
            $product_add = $this->Product->add($product_arr);
            unset($product_arr);
            // if add success
            if($product_add != null){
                $pid = $product_add['id'];
                $product_arr = array();
                foreach($img_names as $num => $img_name){
                    //set upload config
                    $config['upload_path'] = PRODUCT_IMG_PATH;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['remove_spaces'] = true;
                    //$config['max_size']	= '';
                    $config['max_width']  = '5000';
                    $config['max_height']  = '5000';
                    $config['overwrite'] = true;
                    $config['file_name'] = 'product'.$product_add['id'].'-'.$num;
                    $filename = 'photoProduct'.$num;  //input tag name
                    $this->upload->initialize($config);
                    // do upload image
                    if($this->upload->do_upload($filename)){
                        $upload = $this->upload->data();
                        $product_arr['product_img'.$num] = PRODUCT_IMG_PATH."/".$upload['file_name'];
                        //* resize image
                        $this->load->library('image_lib');
                        $config_img['image_library'] = 'gd2';
                        $config_img['source_image']	= $product_arr['product_img'.$num];
                        $config_img['create_thumb'] = FALSE;
                        $config_img['maintain_ratio'] = TRUE;
                        $config_img['width']	= 555;
                        $config_img['height']	= 313;
                        $dim = (intval($upload["image_width"]) / intval($upload["image_height"])) - ($config_img['width'] / $config_img['height']);
                        $config_img['master_dim'] = ($dim > 0)? "height" : "width";
                        $this->image_lib->clear();
                        $this->image_lib->initialize($config_img);
                        $this->image_lib->resize();
                        //***
                    }else{
                        $msg = 'ไฟล์รูปภาพไม่ถูกต้อง ไม่สามารถอัพโหลดรูปได้ รูปที่'.$num;
                        $this->session->set_flashdata('msg', $msg);
                        echo "<script>window.history.back();</script>";
                        return;
                    }
                }
                // if upload success
                $added_arr = array( //added product select by id
                    'product_id' => $pid
                );
                $product_up = $this->Product->edit($added_arr, $product_arr);
                if($product_up){
                    //set price
                    $price_arr = array();
                    $price_arr['price_product_id'] = $pid;
                    foreach($price_lv as $k => $v){  //insert price to price table
                        $price_arr['price_price'] = $v;
                        $price_arr['price_level_id'] = $k;
                        // add price to db
                        if($this->Price->add($price_arr) == FALSE){ // if failed back to previous page
                            $msg = 'ไม่สามารถเพิ่มสินค้าได้';
                            $this->db->trans_off();
                            $this->db->trans_strict(FALSE);
                            $this->session->set_flashdata('msg', $msg);
                            //echo "<script>window.history.back();</script>";
                            return;
                        }
                    }
                    $this->db->trans_complete();
                    $this->db->trans_strict(FALSE);
                    // everything is work.
                    redirect('/admin/product');
                    return;
                }else{
                    $msg = 'ไม่สามารถเพิ่มสินค้าได้';
                }
            }else{
                $msg = 'ไม่สามารถเพิ่มสินค้าได้';
            }
            $this->db->trans_off();
            $this->db->trans_strict(FALSE);
            $this->session->set_flashdata('msg', $msg);
            $this->session->set_flashdata('msgimg', $msg);
            echo $msg;

            $this->session->set_flashdata('productCode', set_value('productCode'));
            $this->session->set_flashdata('productName', set_value('productName'));
            $this->session->set_flashdata('brandProduct', set_value('brandProduct'));
            $this->session->set_flashdata('catagoryProduct', set_value('catagoryProduct'));
            $this->session->set_flashdata('detailProduct', set_value('detailProduct'));
            $this->session->set_flashdata('fullPrice', set_value('fullPrice'));
            echo "<script>window.history.back();</script>";
        }
        
        
        
        function edit_product(){
            //validate form
            $pid = $this->uri->segment(3);
            if($pid == NULL || !is_numeric($pid)){
                redirect('/admin/product');
                return;
            }
            
            //get data from db by Product ID
            $product = $this->Product->get_product($pid, 'obj');
            if($product != NULL){
                //set data
                $data['levels'] = $this->Level->list_levels();
                $data['prices'] = $this->Price->list_prices(array('price_product_id' => $pid));
                $data['cats'] = $this->Category->list_categories(array(), 0, 0, 'arr');
                $data['brands'] = $this->Brand->list_brands(array(), 0, 0, 'arr');
                $data['product'] = $product;
                //$data['cur_brand'] = $product->brand_id;
                //$data['cur_cat'] = $product->category_id;
                
                $this->load->view('admin_v/editProduct', $data);
                return;
            }
            redirect('/admin/product');
            return;
        }
        
        // edit product
        function edit(){
            $this->load->library('upload');
            
            $msg = '';
            //validate form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pid', 'pid', 'required|numeric');
            $this->form_validation->set_rules('productCode', 'productCode', 'trim|required');
            $this->form_validation->set_rules('productName', 'productName', 'trim|required');
            $this->form_validation->set_rules('brandProduct', 'brandProduct', 'trim|required|numeric');
            $this->form_validation->set_rules('catagoryProduct', 'catagoryProduct', 'trim|required|numeric');
            $this->form_validation->set_rules('detailProduct', 'detailProduct', 'required');
            $this->form_validation->set_rules('fullPrice', 'fullPrice', 'trim|required|numeric');
            
            $levels = $this->Level->list_levels(); //declare level rules
            foreach($levels as $lv){
                //echo key($lv)."<br/>";
                $this->form_validation->set_rules('vipPrice'.$lv['level_id'], 'vipPrice'.$lv['level_id'], 'numeric');
            }
            
            // validate image files
            $allow_ext = array('gif', 'jpg', 'png', 'jpeg');
            $filenames = array();
            /*
            $c = 1;
            foreach($_FILES as $fn => $f){
                if($f['error'] == 0){   // if has file, then check ext
                    $ext =  strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                    if(!in_array($ext, $allow_ext)){
                        $this->session->set_flashdata('msgimg'.$c, 'ไฟล์รูปไม่ถูกต้อง');
                        echo "<script>window.history.back();</script>";
                        return;
                    }
                    // if valid ext >> add tagname to filename array
                    $filenames[$c] = $f;
                    $filenames[$c]['ext'] = $ext;
                }
                $c++;
            }*/
            $max_img = 3;
            for($i=1; $i<=$max_img; $i++){
                $f = $_FILES['photoProduct'.$i];
                if($f['error'] == 0){   // if has file, then check ext
                    $ext =  strtolower(pathinfo($f['name'], PATHINFO_EXTENSION));
                    if(!in_array($ext, $allow_ext)){
                        $this->session->set_flashdata('msgimg'.$i, 'ไฟล์รูปไม่ถูกต้อง');
                        echo "<script>window.history.back();</script>";
                        return;
                    }
                    // if valid ext >> add tagname to filename array
                    $filenames[$i] = $f;
                    $filenames[$i]['ext'] = $ext;
                }
            }
            
            //$this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
            if(!$this->form_validation->run()){
                //if form is invalid, back to previous page.
                echo validation_errors();
                if(form_error('productCode')){
                    $this->session->set_flashdata('msgcode', form_error('productCode'));
                }else if(form_error('productName')){
                    $this->session->set_flashdata('msgname', form_error('productName'));
                }else if(form_error('brandProduct')){
                    $this->session->set_flashdata('msgbrand', form_error('brandProduct'));
                }else if(form_error('catagoryProduct')){
                    $this->session->set_flashdata('msgcat', form_error('catagoryProduct'));
                }
                //$this->session->set_flashdata('msg', validation_errors());
                //echo "<script>window.history.back();</script>";
                return;
            }
            
            $pid = set_value('pid');
            $code = set_value('productCode');
            $name = set_value('productName');
            $bid = set_value('brandProduct');
            $cat_id = set_value('catagoryProduct');
            $detail = set_value('detailProduct');
            $price = (double)set_value('fullPrice');
            $price_lv = array();
            
            foreach($levels as $lv){    // set price array follow the levels
                $price_lv[$lv['level_id']] = set_value('vipPrice'.$lv['level_id']) != ''?set_value('vipPrice'.$lv['level_id']):$price;
            }
            /*echo html_entity_decode(stripslashes(nl2br($detail)),ENT_NOQUOTES,"Utf-8")."<br/>";
            echo stripslashes(nl2br($detail))."<br/>";
            echo utf8_decode($detail);
            return;
            
            foreach($price_lv as $k => $v){
                echo $k." : ".$v."<br/>";
            }*/
            
            $product_arr = array();
            $product_arr['product_code'] = $code;
            $product_arr['product_name'] = $name;
            $product_arr['product_detail'] = $detail;
            $product_arr['product_price'] = $price;
            $product_arr['product_status_id'] = 1;
            $product_arr['product_category_id'] = $cat_id;
            $product_arr['product_brand_id'] = $bid;
            // edit process
            
            //upload image
            $upload_imgs = array(); // uploaded file
            foreach($filenames as $num => $pic){
                $config['upload_path'] = PRODUCT_IMG_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = true;
                //$config['max_size']	= '';
                $config['max_width']  = '5000';
                $config['max_height']  = '5000';
                $config['file_name'] = 'product'.$pid."-".$num;
                $config['overwrite'] = TRUE;
                $fn = 'photoProduct'.$num;  //input tag name
                $old_file = PRODUCT_IMG_PATH."/"."product".$pid."-".$num.".".$pic['ext'];

                if(file_exists($old_file)){
                    echo unlink($old_file);
                }
                // upload
                $this->upload->initialize($config);
                if($this->upload->do_upload($fn)){
                    $upload = $this->upload->data();
                    $product_arr['product_img'.$num] = PRODUCT_IMG_PATH."/".$upload['file_name'];
                    //***
                    $this->load->library('image_lib');
                    $config_img['image_library'] = 'gd2';
                    $config_img['source_image']	= $product_arr['product_img'.$num];
                    $config_img['create_thumb'] = FALSE;
                    $config_img['maintain_ratio'] = TRUE;
                    $config_img['width']	= 555;
                    $config_img['height']	= 313;
                    $dim = (intval($upload["image_width"]) / intval($upload["image_height"])) - ($config_img['width'] / $config_img['height']);
                    $config_img['master_dim'] = ($dim > 0)? "height" : "width";
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_img);
                    $this->image_lib->resize();
                    //***
                }
            }
            
            // enable transaction mode
            $this->db->trans_strict(TRUE);  
            $this->db->trans_start();

            $q = array(
                    'product_id' => $pid
                    );
            if($product_edit = $this->Product->edit($q, $product_arr)){
                // if update success
                $qp = array();
                $qp['price_product_id'] = $pid;
                foreach($price_lv as $lv => $p){
                    $qp['price_level_id'] = $lv;
                    $new_price['price_price'] = $p;
                    if($price_edit = $this->Price->edit($qp, $new_price) == FALSE){
                        $msg = 'ไม่สามารถแก้ไขสินค้าได้';
                        $this->session->set_flashdata('msg', $msg);
                        $this->db->trans_off();
                        $this->db->trans_strict(FALSE);
                        echo "<script>window.history.back();</script>";
                    }
                }
                //if update price complete
                $this->db->trans_complete();
                $this->db->trans_strict(FALSE);

                redirect('admin/product');
                return;
            }
            $this->db->trans_off();
            $this->db->trans_strict(FALSE);
            $msg = 'ไม่สามารถแก้ไขสินค้าได้';
            $this->session->set_flashdata('msg', $msg);
            echo "<script>window.history.back();</script>";
        }
        
        function pause(){
            $pid = $this->input->post('pid');
            if($pid == NULL || is_nan($pid)){
                return;
            }
            $q = array(
                'product_id' => $pid
            );
            
            $product = $this->Product->get_product($pid);
            if($product['product_status_id'] == 2){
                $status = 1;
            }else{
                $status = 2;
            }
            
            $new = array(
                'product_status_id' => $status
            );
            
            $res = $this->Product->edit($q, $new);
            echo $res;
        }
        
        function unpause(){
            $pid = $this->input->post('pid');
            if($pid == NULL || is_nan($pid)){
                return;
            }
            $q = array(
                'product_id' => $pid
            );
            $new = array(
                'product_status_id' => 1
            );
            
            $res = $this->Product->edit($q, $new);
            echo $res;
        }
        
        function remove(){
            $this->db->trans_complete();
            $this->db->trans_strict(FALSE);
            //check form
            $pid = $this->input->post('pid');
            if($pid == NULL || is_nan($pid)){
                redirect('/admin/product');
                return;
            }
            // remove
            $rm = $this->Product->remove($pid);
            echo $rm;   // echo result
        }
        
        //* private function
        private function get_file_extension($name){
            $pos = strripos($name, '.');
            return substr($name, $pos+1);
        }
        
        private function get_file_name($name){
            $pos = strripos($name, '.');
            return substr($name, 0, $pos);
        }
        
    }