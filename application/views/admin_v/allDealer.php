
<?php include 'include/head.php';?>

<body class="nav-md">
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
                            <h3>ตัวแทนจำหน่าย</h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" name="name" value="<?=$search_name?>" class="nField form-control" placeholder="กรอกชื่อตัวแทน...">
                                    <span class="input-group-btn">
                                        <button class="nBtn btn btn-default" type="button">ค้นหา!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_content">

                                    <div class="row">
                                        <div class="clearfix"></div>
                                        <?php foreach($dls as $d){ ?>
                                        <div class="col-md-4 col-sm-4 col-xs-12 animated fadeInDown">
                                            <div class="well profile_view">
                                                <div class="col-sm-12">
                                                    <h4 class="brief"><i>สมาชิกระดับ  <?=$d->level_order?></i></h4>
                                                    <div class="left col-xs-7">
                                                        <h2><?=$d->dealer_fullname?></h2>
                                                        <p><strong>ร้าน: </strong> <?=$d->dealer_shopname?></p>
                                                        <ul class="list-unstyled">
                                                            <li><i class="fa fa-phone"></i> โทร: <?=$d->dealer_tel?></li>
                                                        </ul>
                                                    </div>
                                                    <div class="right col-xs-5 text-center">
                                                        <img src="<?=base_url().$d->dealer_picture?>?ccpic=<?=urlencode(time())?>?c=<?=urlencode(time())?>" alt="" class="img-circle img-responsive" style="height: 90px; width: auto; display: block;">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 bottom text-center">
                                                  <div class="col-xs-12 col-sm-6 emphasis">
                                                      <p class="ratings">
                                                        <?php for($i=0;$i< $d->level_order; $i++){ ?>
                                                        <span class="fa fa-star"></span>
                                                        <?php } ?>
                                                      </p>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-6 emphasis">
                                                      <button type="button" class="btn btn-success btn-xs" style=""> <i class="fa fa-check"></i> </button>
													  <!--<button type="button" class="btn btn-errors btn-xs"> <i class="fa fa-disable"></i> </button>-->
                                                      <button type="button" class="btn btn-primary btn-xs" onclick="location.href='<?=base_url()."admin/dealer/".$d->dealer_id?>';"> <i class="fa fa-user">
                                                      </i> รายละเอียด </button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
										<?php } ?>
                                    </div>
                                    <div class="row text-center">
                                      <div class="btn-group">
                                            <?php for($i=1;$i<=$page_amount;$i++){ ?>
                                            <button class="pBtn btn btn-info <?=$page==$i?'active':'' ?>" type="button"><?=$i?></button>
                                            <?php } ?>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="<?=base_url()?>assets/angjq/dealerJq.js"></script>

                <!-- /top tiles -->
                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
