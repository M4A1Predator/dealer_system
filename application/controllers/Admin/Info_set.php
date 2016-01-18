<?php
ob_start();
    class Info_set extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->helper('admin_authen_helper');
            verify_authen_admin();
            $this->load->model('Admin');
        }
        
        function contact(){
            $info = $this->Admin->get_info();
            
            $data['contact'] = $info['info_contact'];
            $data['about'] = $info['info_about'];
            
            $this->load->view('admin_v/contact', $data);
        }
        
        function suggest(){
            //get info
            $info = $this->Admin->get_info();
            
            $data['suggest'] = $info['info_suggest'];
            $data['qa'] = $info['info_qa'];
            
            $this->load->view('admin_v/suggest', $data);
        }
        
        function address(){
            $jsonContent = file_get_contents('details/address.json');
            $json = json_decode($jsonContent);
            
            $address = $json->address;
            $mobile = $json->mobile;
            $tel = $json->tel;
            $email = $json->email;
            
            $data['address'] = $address;
            $data['mobile'] = $mobile;
            $data['tel'] = $tel;
            $data['email'] = $email;
            $data['facebook'] = $json->facebook;
            $data['twitter'] = $json->twitter;
            $data['google'] = $json->google;
            $data['youtube'] = $json->youtube;
            $data['store'] = $json->store;
            
            $this->load->view('admin_v/address', $data);
            
        }
        
        function buy(){
            $jsonContent = file_get_contents('details/buy_detail.json');
            $json = json_decode($jsonContent);
            
            $buy = $json->buy;
            $ship = $json->ship;
            
            $data['buy'] = $buy;
            $data['ship'] = $ship;
            
            $this->load->view('admin_v/buyDetail', $data);
        }
        
        //***
        function edit_contact(){
            //filter type
            $type = $this->input->post('type');
            if($type == 'contact'){
                $contact = $this->input->post('contact');
                $about = $this->input->post('about');
                
                $info_arr['info_contact'] = $contact;
                $info_arr['info_about'] = $about;
            }else if($type == 'suggest'){
                $qa = $this->input->post('qa');
                $suggest = $this->input->post('suggest');
                $info_arr['info_suggest'] = $suggest;
                $info_arr['info_qa'] = $qa;
            }
            
            // info id
            $info = $this->Admin->get_info();
            
            $update_info = $this->Admin->edit_info($info['info_id'], $info_arr);
            echo "saved";
        }
        
        function edit_detail(){
            $type = $this->input->post('type');
            if($type == 'buy'){
                $buy = $this->input->post('buy');
                $ship = $this->input->post('ship');
                $file_name = 'details/buy_detail.json';
                
                $jsonContent = file_get_contents($file_name);
                $json = json_decode($jsonContent);
                
                $json->buy = $buy;
                $json->ship = $ship;
            }else if($type == 'address'){
                // set attributes
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');
                $tel = $this->input->post('tel');
                $email = $this->input->post('email');
                $facebook = $this->input->post('facebook');
                $twitter = $this->input->post('twitter');
                $google = $this->input->post('google');
                $youtube = $this->input->post('youtube');
                $store = $this->input->post('store');
                $file_name = 'details/address.json';
                
                // set json file
                $jsonContent = file_get_contents($file_name);
                $json = json_decode($jsonContent);
                
                $json->address = $address;
                $json->mobile = $mobile;
                $json->tel = $tel;
                $json->email = $email;
                $json->facebook = $facebook;
                $json->twitter = $twitter;
                $json->google = $google;
                $json->youtube = $youtube;
                $json->store = $store;
                
            }
            $newJson = json_encode($json);
            if(file_put_contents($file_name, $newJson)){
                if($type == 'buy'){
                    echo 'saved';
                }else{
                    redirect('/admin/detail/address');
                }
            }
            
        }
    }