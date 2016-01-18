
<?php include 'include/head.php';?>

<body class="nav-md" ng-app="addProduct" ng-controller="addProductCtrl">
    <style>
        [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide {
        display: none !important;
        
        .he
        }
        .he{
            color: red;
        }
    </style>
    
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
            <div class="right_col" role="main" >
                <link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
                <!-- include summernote css/js-->
                <link href="<?=base_url()?>assets/css/summernote.css" rel="stylesheet">
                <script src="<?=base_url()?>assets/js/summernote.min.js"></script>

                <!-- top tiles -->
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>เพิ่มสินค้า</h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form id="productForm" action="<?=base_url()?>admin/add_new_product" method="POST" enctype="multipart/form-data" novalidate="" data-parsley-validate="" required class="form-horizontal form-label-left">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productId">รหัสสินค้า<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="productCode" value="<?=$this->session->flashdata('productCode')?>" name="productCode" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"><?=$this->session->flashdata('msgcode')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productName">ชื่อสินค้า<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="productName" value="<?=$this->session->flashdata('productName')?>" name="productName" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="msgname"><?=$this->session->flashdata('msgname')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandProduct">ยี่ห้อสินค้า<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="brandProduct" name="brandProduct" required class="form-control">
                                      <option value="">เลือกแบรนด์</option>
                                      <?php foreach($brands as $b){ ?>
                                      <option value="<?=$b['brand_id']?>"><?=$b['brand_name']?></option>
                                      <?php } ?>
                                    </select>
                                    <ul class="parsley-errors-list" id="msgbrand"></ul>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catagoryProduct">หมวดหมู่<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="catagoryProduct" name="catagoryProduct" required class="form-control">
                                      <option value="">เลือกหมวดหมู่</option>
                                      <?php foreach($cats as $cat){ ?>
                                      <option value="<?=$cat['category_id']?>"><?=$cat['category_name']?></option>
                                      <?php } ?>
                                    </select>
                                    <ul class="parsley-errors-list" id="msgcat"></ul>
                                  </div>
                                </div>
                                <!--text area-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="detailProduct">รายละเอียด<span class="required">*</span>
                                  </label>
                                  
                                  <!--<div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="detailProduct" required name="detailProduct"   style="width: 100%;height: 100px;" ><?=$this->session->flashdata('productDetail')?></textarea>
                                  </div>-->
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="detailProductNote" class="form-control"></div>
                                  </div>
                                  <span class="he" id="msgdetail"><?=$this->session->flashdata('msgdetail')?></span>
                                </div>
                                <!--text area-->
                                <!--upload-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photoProduct">รูปภาพสินค้า<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="photoProduct1" name="photoProduct1" required class="input-file" type="file" accept="image/*">
                                    <span class="he" id="msgphotoProduct1" ><?=$this->session->flashdata('msgimg1')?></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photoProduct">รูปภาพสินค้า
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="photoProduct2" name="photoProduct2" required class="input-file" type="file" accept="image/*">
                                    <span class="he" id="msgphotoProduct2" ><?=$this->session->flashdata('msgimg2')?></span>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photoProduct">รูปภาพสินค้า
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="photoProduct3" name="photoProduct3" required class="input-file" type="file" accept="image/*">
                                    <span class="he" id="msgphotoProduct3" ><?=$this->session->flashdata('msgimg3')?></span>
                                  </div>
                                </div>
                                <!-- upload-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullPrice">ราคาห้าง/ราคาเต็ม<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" ng-model="product.fullPrice" value="<?=$this->session->flashdata('fullPrice')?>"  id="fullPrice" name="fullPrice" title='กรุณากรอกราคา' required placeholder="กรอกราคาเต็มของสินค้า" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="fullPriceMsg"></ul>
                                    </div>
                                </div>
                                <?php foreach($levels as $lv){ ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vipPrice">ส่วนลดตัวแทน   <?=$lv['level_name']?>
                                    </label>
                                    <div class="col-md-2 col-sm-2 col-xs-5">
                                        <input value="" ng-model="product.pm<?=$lv['level_id']?>" placeholder="กรอกราคาลด" type="text" id="pm<?=$lv['level_id']?>" pattern="^[0-9]+(\.\d+)*" title='กรุณากรอกเป็นราคา' name="vipPrice<?=$lv['level_id']?>" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="msgPm<?=$lv['level_id']?>"></ul>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 or-text text-center">
                                        หรือ
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-5">
                                        <input placeholder="กรอกเปอร์เซ็นต์ลด" ng-model="product.pp<?=$lv['level_id']?>" type="text" id="pp<?=$lv['level_id']?>" pattern="^[0-9]+(\.\d+)*" title='กรุณากรอกเป็นตัวเลข'  name="vipPercent<?=$lv['level_id']?>" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="msgPp<?=$lv['level_id']?>"></ul>
                                    </div>
                                </div>
                                <?php } ?>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!--<button type="submit" id="submitBtn" class="btn btn-success">เพิ่มสินค้า</button>-->
                                        <input type="button" id="submitBtn" onclick="submitAddForm()" class="btn btn-success" value="เพิ่มสินค้า">
                                        <a href="<?=base_url()?>admin/product"><input type="button" value="ยกเลิก" class="btn btn-danger"></a>
                                    </div>
                                </div><?=$this->session->flashdata('msg');?>
                                <!-- hidden field -->
                                <input type="hidden" name="detailProduct" value="" id="detailProduct"/>
                            </form>
                                  <div class="row text-center">
                                       
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $(document).ready(function() {
                    $('#detailProductNote').summernote({
                        height: 150,
                    });
                });
                </script>

                <script type="text/javascript" src="<?=base_url()?>assets/angjq/addProductJq.js"></script>
                <!--<script type="text/javascript" src="<?=base_url()?>assets/angjq/appAddProduct.js"></script>-->
                
                <!-- /top tiles -->
                <!-- footer content -->

                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
