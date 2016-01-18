<?php
    ob_start();
    class Dealer_set extends CI_Controller{
            
        var $lim = 15;
        
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
            
            date_default_timezone_set('Asia/Bangkok');
        }
        
        function view_dealer(){
            $did = $this->uri->segment(3);
            
            if($did == NULL || !is_numeric($did)){
                redirect('/admin/dealer');
                return;
            }
            // get data from Model
            $dealer = $this->Dealer->get_dealer($did, 'obj');
            if($dealer != NULL){
                $data = array();
                $data['dealer'] = $dealer;
                
                $this->load->view('admin_v/showDealer', $data);
                return;
            }
            redirect('/admin/dealer');
            return;
        }
        function view_dealers(){
            
            $name = $this->input->get('name');
            $page = $this->input->get('p');
            if($name == NULL){
                $name ='';
            }
            if($page == NULL || is_nan($page)){
                $page = 1;
            }
            
            $q = array(
                'dealer_fullname like' => $name."%",
                'level_order > ' => 0
                );
            
            $off = ($this->lim*$page)-$this->lim;
            $dls = $this->Dealer->list_dealers($q, $this->lim, $off, 'obj');
            $rows = $this->Dealer->get_num_rows($q);
            
            $page_amount = 1;
            if($rows%$this->lim == 0 || $rows%$this->lim == $this->lim){
                $page_amount = $rows/$this->lim;
            }else{
                $page_amount = $rows/$this->lim+1;
            }
            
            $data['dls'] = $dls;
            $data['page'] = $page;
            $data['page_amount'] = (int)$page_amount;
            $data['rows'] = $rows;
            $data['search_name'] = $name;

            $this->load->view('admin_v/allDealer', $data);
        }
        
        function view_non_approve(){
            $page = $this->input->get('page');
            if($page == NULL || is_nan($page)){
                $page = 1;
            }
            
            // get non-approved dealers
            $q = array(
                'dealer_level_id' => 0
            );
            
            $lim = 15;
            $off = ($lim*$page)-$lim;
            
            $dealers = $this->Dealer->list_dealers($q, $lim, $off, 'obj', 'dealer_datetime DESC , dealer_id DESC');
            $rows = $this->Dealer->get_num_rows($q);
            $page_amount = 1;
            if($rows%$lim == 0 || $rows%$lim == $lim){
                $page_amount = $rows/$lim;
            }else{
                $page_amount = $rows/$lim+1;
            }
            
            $data['dealers'] = $dealers;
            $data['rows'] = $dealers;
            $data['off'] = $off;
            $data['pa'] = (int)$page_amount;
            $data['page'] = $page;
            
            //load view
            $this->load->view('admin_v/waitApprove', $data);
        }
        function add_dealer(){
            
            //$levels = $this->Level->list_levels();
            $levels = $this->Level->list_all_levels();
            $data['levels'] = $levels;
            $this->load->view('admin_v/addDealer', $data);
        }
        
        function add(){
            $this->load->helper('security');
            $msg = '';
            // validate form
            $this->load->library('form_validation');            
            $this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash|min_length[4]|is_unique[dealer_dealer.dealer_username]');
            $this->form_validation->set_rules('password', 'password', 'trim|required|no_space|min_length[8]');
            $this->form_validation->set_rules('level', 'level', 'required');
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('address', 'address', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[dealer_dealer.dealer_email]');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required');
            $this->form_validation->set_rules('line', 'line', 'trim|required');
            $this->form_validation->set_rules('shopname', 'shopname', 'trim');
            $this->form_validation->set_rules('website', 'website', 'trim');
            $this->form_validation->set_rules('fanpage', 'fanpage', 'trim');
            $this->form_validation->set_rules('facebook', 'facebook', 'trim');
            $this->form_validation->set_rules('other', 'other', 'trim');
            
            if($_FILES['profile']['error'] == 4){
                $this->form_validation->set_rules('profile', 'profile', 'required');
            }else{
                $allow_ext = array('gif', 'jpg', 'png', 'jpeg');
                $ext = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
                if(!in_array($ext, $allow_ext)){
                    $this->session->set_flashdata('msgprofile', 'ไฟล์รูปภาพไม่ถูกต้อง');
                    echo "<script>window.history.back();</script>";
                    return;
                }
            }
            /*
            foreach($this->input->post() as $k => $v){
                echo $k." : ".$v."<br/>";
            }*/
            
            $this->form_validation->set_message('required', 'กรุณาใส่ข้อมูล');
            $this->form_validation->set_message('min_length', 'ข้อมูลไม่ถูกต้อง');
            $this->form_validation->set_message('is_unique', 'ไม่สามารถใช้ชื่อนี้ได้');
            if(!$this->form_validation->run()){
                //echo validation_errors();
                if(form_error('username')){
                    $this->session->set_flashdata('msgusername', form_error('username'));
                }else if(form_error('password')){
                    $this->session->set_flashdata('msgpassword', form_error('password'));
                }else if(form_error('email')){
                    $this->session->set_flashdata('msgemail', form_error('email'));
                }
                echo "<script>window.history.back();</script>";
                return;
            }
            
            //set variable
            $username = set_value('username');
            $password = set_value('password');
            $level = set_value('level');
            $name = set_value('name');
            $address = set_value('address');
            $email = set_value('email');
            $phone = set_value('phone');
            $line = set_value('line');
            $shopname = set_value('shopname');
            $website = set_value('website');
            $fanpage = set_value('fanpage');
            $facebook = set_value('facebook');
            $other = set_value('other');
            // adjust value
            $password = do_hash($password, 'sha256');   // encrypt password
            $website = $website == ''?'':$this->set_url_pattern($website);
            $fanpage = $fanpage == ''?'':$this->set_url_pattern($fanpage);
            $facebook = $facebook == ''?'':$this->set_url_pattern($facebook);
            
            if(strlen($phone) == 10 && is_numeric($phone)){
                $new_tel = substr($phone, 0, 3)."-".substr($phone, 3, 3)."-".substr($phone, 6);
                $phone = $new_tel;
            }
            
            
            // enable transaction mode
            $this->db->trans_strict(TRUE);
            $this->db->trans_start();
            
            $dealer_arr = array();
            $dealer_arr['dealer_username'] = $username;
            $dealer_arr['dealer_password'] = $password;
            $dealer_arr['dealer_fullname'] = $name;
            $dealer_arr['dealer_address'] = $address;
            $dealer_arr['dealer_picture'] = '';
            $dealer_arr['dealer_email'] = $email;
            $dealer_arr['dealer_tel'] = $phone;
            $dealer_arr['dealer_line'] = $line;
            $dealer_arr['dealer_shopname'] = $shopname;
            $dealer_arr['dealer_website'] = $website;
            $dealer_arr['dealer_facebook'] = $facebook;
            $dealer_arr['dealer_fanpage'] = $fanpage;
            $dealer_arr['dealer_level_id'] = $level;
            $dealer_arr['dealer_detail'] = $other;
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
                $filename = 'profile';  //input tag name
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
                        $this->db->trans_strict(FALSE);
                        redirect('/admin/dealer');
                        return;
                    }
                }else{
                    //echo $this->upload->display_errors();
                    $this->session->set_flashdata('msgpicture', 'อัพโหลดรูปไม่ได้');
                }
            }else{
                $msg = 'ไม่สามารถเพิ่มได้';
            }
            $this->session->set_flashdata('msg', $msg);
            $this->db->trans_off();
            $this->db->trans_strict(FALSE);
            //echo "<script>window.history.back();</script>";
            return;
        }
        
        //---check unique name
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
        
        function edit_dealer(){
            $did = $this->uri->segment(3);
            if($did == NULL || !is_numeric($did)){
                redirect('/admin/dealer');
                return;
            }
            // get data from Model
            $dealer = $this->Dealer->get_dealer($did, 'obj');
            if($dealer != NULL){
                $levels = $this->Level->list_all_levels();
                
                $data = array();
                $data['dealer'] = $dealer;
                $data['levels'] = $levels;
                
                $this->load->view('admin_v/editDealer', $data);
                return;
            }
            redirect('/admin/dealer');
            return;
        }
        
        function edit(){
            $this->load->helper('security');
            $msg = '';
            // validate form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('did', 'did', 'required');
            //$this->form_validation->set_rules('username', 'username', 'trim|required|alpha_dash|min_length[4]');
            $this->form_validation->set_rules('password', 'password', 'trim|no_space|min_length[8]');
            $this->form_validation->set_rules('level', 'level', 'required');
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('address', 'address', 'trim|required');
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required');
            $this->form_validation->set_rules('line', 'line', 'trim|required');
            $this->form_validation->set_rules('shopname', 'shopname', 'trim');
            $this->form_validation->set_rules('website', 'website', 'trim');
            $this->form_validation->set_rules('fanpage', 'fanpage', 'trim');
            $this->form_validation->set_rules('facebook', 'facebook', 'trim');
            $this->form_validation->set_rules('other', 'other', 'trim');
            // if form is invalid
            if(!$this->form_validation->run()){
                echo validation_errors();
                //echo "<script>window.history.back();</script>";
                return;
            }
            
            $img_name = '';
            if($_FILES['profile']['error'] == 0){
                $allow_ext = array('gif', 'jpg', 'png', 'jpeg');
                $ext = strtolower(pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION));
                if(!in_array($ext, $allow_ext)){
                    $this->session->set_flashdata('msgprofile', 'ไฟล์รูปภาพไม่ถูกต้อง');
                    echo "<script>window.history.back();</script>";
                    return;
                }
                $img_name = 'profile';
            }
            
            //***
            //set variable
            $did = set_value('did');
            //$username = set_value('username');
            $password = set_value('password');
            $level = set_value('level');
            $name = set_value('name');
            $address = set_value('address');
            $email = set_value('email');
            $phone = set_value('phone');
            $line = set_value('line');
            $shopname = set_value('shopname');
            $website = set_value('website');
            $fanpage = set_value('fanpage');
            $facebook = set_value('facebook');
            $other = set_value('other');
            //$other = 'test';
            // adjust value
            if($website != ''){
                $website = $this->set_url_pattern($website);
            }
            if($fanpage != ''){
                $fanpage = $this->set_url_pattern($fanpage);
            }
            if($facebook != ''){
                $facebook = $this->set_url_pattern($facebook);
            }
            if(strlen($phone) == 10 && is_numeric($phone)){
                $new_tel = substr($phone, 0, 3)."-".substr($phone, 3, 3)."-".substr($phone, 6);
                $phone = $new_tel;
            }
            //$facebook = $this->set_url_pattern($facebook);
            
            $dealer_arr = array();
            //$dealer_arr['dealer_username'] = $username;
            if($password != ''){
                $password = do_hash($password, 'sha256');
                $dealer_arr['dealer_password'] = $password;
            }
            $dealer_arr['dealer_fullname'] = $name;
            $dealer_arr['dealer_address'] = $address;
            $dealer_arr['dealer_email'] = $email;
            $dealer_arr['dealer_tel'] = $phone;
            $dealer_arr['dealer_line'] = $line;
            $dealer_arr['dealer_shopname'] = $shopname;
            $dealer_arr['dealer_website'] = $website;
            $dealer_arr['dealer_facebook'] = $facebook;
            $dealer_arr['dealer_fanpage'] = $fanpage;
            $dealer_arr['dealer_level_id'] = $level;
            $dealer_arr['dealer_detail'] = $other;
            
            
            if($img_name != ''){
                $this->load->library('upload');
                $config['upload_path'] = DEALER_IMG_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = true;
                //$config['max_size']	= '';
                $config['overwrite'] = true;
                $config['max_width']  = '5000';
                $config['max_height']  = '5000';
                $config['file_name'] = do_hash('dealers-'.$did, 'sha1');
                
                $dealer = $this->Dealer->get_dealer($did);
                if(file_exists($dealer['dealer_picture'])){
                    unlink($dealer['dealer_picture']);
                }
                
                $this->upload->initialize($config);
                if(!$this->upload->do_upload($img_name)){
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
            
            $q = array(
                'dealer_id' => $did
            );
            
            $dealer_edit = $this->Dealer->edit($q, $dealer_arr);
            //echo $dealer_edit;
            if($dealer_edit == 1){
                redirect('/admin/dealer');
                return;
            }
            echo "can't";
            $this->session->set_flashdata('msg', 'ไม่สามารถแก้ไขได้');
            echo "<script>window.history.back();</script>";
        }
        
        function remove(){
            $did = $this->input->post('id');
            if($did == NULL || !is_numeric($did)){
                return;
            }
            
            // delete dealer
            $rm = $this->Dealer->remove($did);
            echo $rm;
        }
        
        private function set_url_pattern($link){
            if( strpos($link, 'http://') === 0 || strpos($link, 'https://') === 0 ){
                return $link;
            }
            return 'http://'.$link;
        }
        
    }