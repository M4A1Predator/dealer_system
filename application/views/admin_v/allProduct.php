
<?php include 'include/head.php';?>
<body class="nav-md">
    <style>
        .ui-dialog {
            position: fixed !important;
        }
    </style>
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
            <div class="right_col" role="main">

                <!-- top tiles -->
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> สินค้าทั้งหมด</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-10 col-sm-9 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" value="<?=$search_name?>" id="pName" class="form-control" placeholder="กรอกชื่อสินค้า...">
                                    <span class="input-group-btn">
                            <button id="searchNameBtn" class="btn btn-default right-0" type="button">ค้นหา!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                  <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <form class="form-inline">
                                      <div class="form-group">
                                        <select id="brandProduct" name="brandId" class="bBtn form-control btn-lg h46">
                                          <option value="all">เลือกแบรนด์</option>
                                          <?php foreach($brands as $b){ ?>
                                          <option  value="<?=$b['brand_id']?>" <?=$b['brand_id'] == $cur_b_id?'selected=""':'' ?>><?=$b['brand_name']?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                          <select id="catagoryProduct" name="cat" class="catBtn form-control btn-lg h46">
                                            <option value="all">เลือกหมวดหมู่</option>
                                            <?php foreach($cats as $c){ ?>
                                            <option value="<?=$c['category_id']?>" <?=$c['category_id'] == $cur_cat_id?'selected=""':'' ?>><?=$c['category_name']?></option>
                                            <?php } ?>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-md-2 col-md-offset-4 col-sm-6 col-xs-12 text-right">
                                              <a href="<?=base_url()?>admin/add_product"><button type="button" class="btn btn-success btn-lg" style="width:100%">เพิ่มสินค้า <i class="fa fa-plus-circle"></i></button></a>
                                  </div>
                                    <div class="clearfix"></div><?=$rows." "?>รายการ


                                </div>
                                <div class="x_content">

                                    <div class="row">
                                        <?php foreach($products as $p){ ?>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block; " src="<?=base_url().$p->product_img1?>?c=<?=urlencode(time())?>" alt="image">
                                                    <div class="mask">
                                                        <p><?=$p->product_code?></p>
                                                        <div class="tools tools-bottom">
                                                            <?php if($p->product_status_id == 1){?>
                                                            <a href="#" onclick="javascript:;setPauseId(<?=$p->product_id?>)" data-toggle="modal" data-target="#pauseModel"><i class="fa fa-pause"></i></a>
                                                            <?php }else{ ?>
                                                            <a href="#" onclick="javascript:;setPauseId(<?=$p->product_id?>)" data-toggle="modal" data-target="#unPauseModel"><i class="fa fa-play"></i></a>
                                                            <?php } ?>
                                                            <a href="<?=base_url()?>admin/product_edit/<?=$p->product_id?>"><i class="fa fa-pencil"></i></a>
                                                            <a href="#" onclick="javascript:;setRmId(<?=$p->product_id?>)" data-toggle="modal" data-target="#rmModel"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><a href="<?=base_url()?>admin/product_edit/<?=$p->product_id?>"><?=$p->product_name?></a></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row text-center">
                                      <div class="btn-group">
                                            <?php for($i=1;$i<=$page_amount;$i++){?>
                                            <button class="pBtn btn btn-info <?=$i==$page?'active':''?>" type="button"><?=$i?></button>
                                            <?php } ?>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pauseModel" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">หยุดจำหน่ายสินค้า?</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-default pauseBtn" data-dismiss="modal">ยืนยัน</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        </div>
                        <!--<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยืนยัน</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        </div>-->
                      </div>
                    </div>
                </div>
                
                <div id="unPauseModel" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title" id="pTitle">จำหน่ายสินค้าต่อ?</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-default pauseBtn" data-dismiss="modal">ยืนยัน</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        </div>
                        <!--<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยืนยัน</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        </div>-->
                      </div>
                    </div>
                </div>
                
                <div id="rmModel" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">ลบรายการสินค้า?</h4>
                        </div>
                        <div class="modal-body">
                          <button type="button" class="btn btn-default rmBtn" data-dismiss="modal">ยืนยัน</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        </div>
                        <!--<div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยืนยัน</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                        </div>-->
                      </div>
                    </div>
                </div>
                
                <!--<link href="http://localhost/web_dealer/assets/jquery-ui/jquery-ui.css" rel="stylesheet">
                <script type="text/javascript" src="<?=base_url()?>assets/jquery-ui/jquery-ui.min.js"></script>-->
                <script type="text/javascript" src="<?=base_url()?>assets/angjq/productJq.js"></script>
                

                <!-- /top tiles -->
                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>