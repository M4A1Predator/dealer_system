
<?php include 'include/head.php';?>
<style>
        .he{
            color: red;
        }
</style>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
            <div class="right_col" role="main">
                
                <link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
                <!-- include summernote css/js-->
                <link href="<?=base_url()?>assets/css/summernote.css" rel="stylesheet">
                <script src="<?=base_url()?>assets/js/summernote.min.js"></script>

                <!-- top tiles -->
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>แก้ไขสินค้า</h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form id="productForm" method="POST" action="<?=base_url()?>admin/edit_product" enctype="multipart/form-data" novalidate="" data-parsley-validate="" class="form-horizontal form-label-left">
                                <input type="hidden" name="pid" value="<?=$product->product_id?>" >
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productId">รหัสสินค้า<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="productCode" value="<?=$product->product_code?>" name="productCode" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productName">ชื่อสินค้า<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="productName" value="<?=$product->product_name?>" name="productName" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="msgname"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandProduct">ยี่ห้อสินค้า<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="brandProduct" required name="brandProduct" class="form-control">
                                      <option value="">เลือกแบรนด์</option>
                                      <?php foreach($brands as $b){ ?>
                                      <option value="<?=$b['brand_id']?>" <?=$b['brand_id']==$product->product_brand_id?'selected=""':'' ?>><?=$b['brand_name']?></option>
                                      <?php } ?>
                                    </select>
                                    <ul class="parsley-errors-list" id="msgbrand"></ul>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="catagoryProduct">หมวดหมู่<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="catagoryProduct" required name="catagoryProduct" class="form-control">
                                      <option value="">เลือกหมวดหมู่</option>
                                      <?php foreach($cats as $cat){ ?>
                                      <option value="<?=$cat['category_id']?>" <?= $cat['category_id']==$product->product_category_id?'selected=""':'' ?> ><?=$cat['category_name']?></option>
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
                                    <textarea id="detailProduct" required name="detailProduct" class="form-control" style="width: 100%;height: 100px;" ><?=$product->product_detail?></textarea>
                                  </div>-->
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="detailProductNote"></div>
                                  </div>
                                  <span class="he" id="msgdetail"><?=$this->session->flashdata('msgdetail')?></span>
                                </div>
                                <!--text area-->
                                <!--upload-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photoProduct">รูปภาพสินค้า1
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="photoProduct1" name="photoProduct1" class="input-file" type="file" accept="image/*">
                                    <span class="he" id="msgphotoProduct1" ><?=$this->session->flashdata('msgimg1')?></span>
                                    <div class="thumbnail" style="width: 170px; height: 120px">
                                        <img src="<?=base_url().$product->product_img1?>"/>
                                    </div>
                                  </div>
                                  
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photoProduct">รูปภาพสินค้า2
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="photoProduct2" name="photoProduct2" class="input-file" type="file" accept="image/*">
                                    <span class="he" id="msgphotoProduct2" ><?=$this->session->flashdata('msgimg2')?></span>
                                    <?php if(!is_null($product->product_img2)){ ?>
                                    <div class="thumbnail" style="width: 170px; height: 120px">
                                        <img src="<?=base_url().$product->product_img2?>"/>
                                    </div>
                                    <?php } ?>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photoProduct">รูปภาพสินค้า3
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="photoProduct3" name="photoProduct3" class="input-file" type="file" accept="image/*">
                                    <span class="he" id="msgimgmsgphotoProduct3" ><?=$this->session->flashdata('msgimg3')?></span>
                                    <?php if(!is_null($product->product_img3)){ ?>
                                    <div class="thumbnail" style="width: 170px; height: 120px">
                                        <img src="<?=base_url().$product->product_img3?>"/>
                                    </div>
                                    <?php } ?>
                                  </div>
                                </div>
                                <!-- upload-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fullPrice">ราคาห้าง/ราคาเต็ม<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" ng-model="product.fullPrice" value="<?=$product->product_price?>"  id="fullPrice" name="fullPrice" title='กรุณากรอกราคา' required placeholder="กรอกราคาเต็มของสินค้า" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="fullPriceMsg"></ul>
                                    </div>
                                </div>
                                <?php foreach($prices as $p){ ?>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vipPrice">ส่วนลดตัวแทน   <?=$p['level_name']?>
                                    </label>
                                    <div class="col-md-2 col-sm-2 col-xs-5">
                                        <input value="<?=$p['price_price']?>" ng-model="product.pm<?=$p['level_id']?>" placeholder="กรอกราคาลด" type="text" id="pm<?=$p['level_id']?>" pattern="^[0-9]+(\.\d+)*" title='กรุณากรอกเป็นราคา' name="vipPrice<?=$p['level_id']?>" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="msgPm<?=$p['level_id']?>"></ul>
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2 or-text text-center">
                                        หรือ
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-5">
                                        <input placeholder="กรอกเปอร์เซ็นต์ลด" ng-model="product.pp<?=$p['level_id']?>" type="text" id="pp<?=$p['level_id']?>" pattern="^-?[0-9]+(\.\d+)*"" title='กรุณากรอกเป็นตัวเลข'  name="vipPercent<?=$p['level_id']?>" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        <ul class="parsley-errors-list" id="msgPp<?=$p['level_id']?>"></ul>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="he"><?=$this->session->flashdata('msg')?></div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <!--<button type="button" id="submitBtn" class="btn btn-success">แก้ไข</button>-->
                                        <input type="button" id="submitBtn" onclick="submitEditForm()" value="แก้ไข" class="btn btn-success">
                                        <a href="<?=base_url()?>admin/product"><input type="button" class="btn btn-danger" value="ยกเลิก"></a>
                                    </div>
                                </div>
                                <input type="hidden" name="detailProduct" value="<?=$product->product_detail?>" id="detailProduct"/>
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
                    $('#detailProductNote').summernote('code', $('#detailProduct').val());
                });
                </script>
                <script type="text/javascript" src="<?=base_url()?>assets/angjq/editProductJq.js"></script>
                <!-- /top tiles -->
                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
