<?php
    ob_start();
    class Payment_ctrl extends CI_Controller{
        
        function __construct(){
            parent::__construct();
            $this->load->helper('authen_helper');
            $this->load->helper('set_data_helper');
            verify_authen();
        }
        
        function payment_report(){
            $oid = $this->uri->segment(3);
            if($oid == NULL || is_nan($oid)){
                redirect('/shop');
                return;
            }
            
            $order_arr = array(
                'order_id' => $oid,
                'order_dealer_id' => $this->session->userdata('dealer_id'),
                'order_order_status_id' => 1
            );
            
            $order = $this->Order->get_order($order_arr);
            if($order != NULL){
                $banks = $this->Bank->list_banks();
                
                $data['order'] = $order;
                $data['banks'] = $banks;
                $this->load->view('pages/payment', $data);
                return;
            }
            redirect('/shop');
        }
        
        function report(){
            $this->load->library('form_validation');
            date_default_timezone_set(SITE_TIMEZONE);
            $this->form_validation->set_rules('oid', 'oid', 'required');
            $this->form_validation->set_rules('bank', 'bank', 'required');
            $this->form_validation->set_rules('amount', 'amount', 'required|numeric');
            $this->form_validation->set_rules('time', 'time', 'required|numeric');
            $this->form_validation->set_rules('date', 'date', 'required');
            $this->form_validation->set_rules('month', 'month', 'required');
            $this->form_validation->set_rules('year', 'year', 'required');
            //$this->form_validation->set_rules('transDate', 'transDate', 'required');
            
            if($_FILES['pic']['error'] == 4){
                $this->form_validation->set_rules('pic', 'pic', 'required');
            }
            
            if($this->form_validation->run() == FALSE){
                echo validation_errors();
                $this->session->set_flashdata('msg', 'กรุณากรอกข้อมูลให้ถูกต้อง');
                echo "<script>window.history.back();</script>";
                return;
            }
            // set variables
            $oid = set_value('oid');
            $bank = set_value('bank');
            $amount = set_value('amount');
            //$date = set_value('transDate');
            $year = set_value('year')-543;
            $date = $year."-".set_value('month')."-".set_value('date');

            $time = set_value('time');
            
            //echo $date;
            //return;
            
            //updte order
            $this->db->trans_start();
            $new_arr = array(
                'order_order_status_id' => 2
            );
            $order_up = $this->Order->edit(array('order_id' => $oid), $new_arr);
            if($order_up == TRUE){
                $payment_arr = array();
                $payment_arr['payment_bank_id'] = $bank;
                $payment_arr['payment_order_id'] = $oid;
                $payment_arr['payment_date'] = $date;
                $payment_arr['payment_time'] = $time;
                $payment_arr['payment_amount'] = $amount;
                
                // upload image file
                $this->load->library('upload');
                $config['upload_path'] = PAYMENT_IMG_PATH;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = true;
                $config['max_size']	= '10000';
                $config['max_width']  = '5000';
                $config['max_height']  = '5000';
                //$config['file_name'] = 'pm_order_'.$oid;
                $config['file_name'] = 'pm_order_'.date('Y-m-d-H-i-s').'_'.uniqid();
                $config['overwrite'] = TRUE;
                $filename = 'pic';
                $this->upload->initialize($config); 
                if($this->upload->do_upload($filename)){    // if upload success
                    $ud = $this->upload->data();
                    $payment_arr['payment_img'] = PAYMENT_IMG_PATH."/".$ud['file_name'];
                    
                    //* resize image
                    $this->load->library('image_lib');
                    $config_img['image_library'] = 'gd2';
                    $config_img['source_image']	= $payment_arr['payment_img'];
                    $config_img['create_thumb'] = FALSE;
                    $config_img['maintain_ratio'] = TRUE;
                    $config_img['width']	= 1024;
                    $config_img['height']	= 768;
                    $dim = (intval($ud["image_width"]) / intval($ud["image_height"])) - ($config_img['width'] / $config_img['height']);
                    $config_img['master_dim'] = ($dim > 0)? "height" : "width";
                    $this->image_lib->clear();
                    $this->image_lib->initialize($config_img);
                    $this->image_lib->resize();
                    //***
                    
                }else{                                      // if fail back to previous page
                    $this->db->trans_off();
                    echo $this->upload->display_errors();
                    $this->session->set_flashdata("msg", "ไม่สามารถอัพโหลดรูปได้ หรือ ไฟล์รูปภาพไม่ถูกต้อง (ไฟล์ต้องมีขนาดไม่เกิน 4 MB)");
                    echo "<script>window.history.back();</script>";
                    return;
                }
                // insert to db
                $payment_add = $this->Payment->add($payment_arr);
                if($payment_add != NULL){
                    $this->db->trans_complete();
                    redirect('/shop/account/now_order');
                    return;
                }
            }
            $this->db->trans_off();
            $this->session->set_flashdata("msg", "ไม่สามารถแจ้งโอนได้");
            echo "<script>window.history.back();</script>";
        }
        
        function howtopay(){
            $banks = $this->Bank->list_banks();
            $data['banks'] = $banks;
            $this->load->view('pages/howtopay', $data);
        }
    }