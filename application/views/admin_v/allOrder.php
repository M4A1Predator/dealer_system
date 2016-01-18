
<?php include 'include/head.php';?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
            <div class="right_col" role="main">
                            <div class="">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>
                                          รายการสั่งซื้อสินค้า
                                        </h3>
                                    </div>

                                    <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-12">
                                      <select id="brandProduct" name="brandProduct" class="form-control statusBtn">
                                        <option value="" selected>เลือกสถานะรายการ</option>
                                        <?php foreach($sts as $st){ ?>
                                        <option value="<?=$st['order_status_id']?>" <?= $st['order_status_id']==$osid?'selected':'' ?>><?=$st['order_status_name']?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>รหัสรายการสั่งซื้อ</th>
                                                            <th>เวลา</th>
                                                            <th>ชื่อลูกค้า</th>
                                                            <th>จำนวนเงิน</th>
                                                            <th>ดำเนินการ</th>
                                                            <th> </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $c =$off+1; ?>
                                                        <?php foreach($orders as $od){ ?>
                                                        <tr>
                                                            <th scope="row"><?=$c++?></th>
                                                            <td><?=$od->order_id?></td>
                                                            <td><?=$od->order_datetime?></td>
                                                            <td><?=$od->dealer_fullname?></td>
                                                            <td><?=display_money($od->order_price)?> บาท</td>
                                                            <td>
                                                              <button type="button" class="btn btn-default btn-xs" onclick="location.href='<?=base_url()."admin/order/".$od->order_id?>';">
                                                                <i class="fa fa-pencil"></i> จัดการ
                                                              </button>
                                                              <?php if($od->order_order_status_id == 1){ ?>
                                                              <button type="button" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-credit-card"></i> <?=$od->order_status_name?>
                                                              </button>
                                                              <button type="button" onclick="setDeleteId(<?=$od->order_id?>)" data-toggle="modal" data-target="#rmModal" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash"></i> ลบ
                                                              </button>
                                                              <?php }else if($od->order_order_status_id == 2){ ?>
                                                              <button type="button" class="btn btn-warning btn-xs">
                                                                <i class="fa fa-credit-card"></i> <?=$od->order_status_name?>
                                                              </button>
                                                              <?php }else if($od->order_order_status_id == 3){ ?>
                                                              <button type="button" class="btn btn-success btn-xs">
                                                                <i class="fa fa-credit-card"></i> <?=$od->order_status_name?>
                                                              </button>
                                                              <?php }else if($od->order_order_status_id == 4){ ?>
                                                              <button type="button" class="btn btn-info btn-xs">
                                                                <i class="fa fa-credit-card"></i> อยู่ในขั้นตอนการจัดส่ง
                                                              </button>
                                                              <?php }else if($od->order_order_status_id == 5){ ?>
                                                              <button type="button" class="btn btn-dark btn-xs">
                                                                <i class="fa fa-credit-card"></i> <?=$od->order_status_name?>
                                                              </button>
                                                              <?php } ?>
                                                            </td>
                                                            <td>
                                                              <a class="btn btn-success btn-xs" href='<?=base_url()."admin/order/".$od->order_id."/print"?>' target="_blank">
                                                                <i class="fa fa-print m-right-xs"></i> พิมพ์
                                                              </a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                        
                                                    </tbody>
                                                </table>
                                                <div class="row text-center">
                                                  <div class="btn-group">
                                                        <?php for($i=1;$i<=$page_amount;$i++){ ?>
                                                            <button class="btn btn-info pageBtn <?= $page==$i?'active':'' ?>" type="button"><?=$i?></button>
                                                        <?php } ?>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
                            <div id="rmModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">ลบรายการสั่งซื้อ เลขที่ <span id="rmOid"></span></h4>
                                    </div>
                                    <div class="modal-body">
                                      <button type="button" class="btn btn-default rmBtn" data-dismiss="modal">ยืนยัน</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <script type="text/javascript" src="<?=base_url()?>assets/angjq/pageJq.js"></script>
                            <script type="text/javascript" src="<?=base_url()?>assets/angjq/orderJq.js"></script>

                            <!-- footer content -->
                            <?php include 'include/footer-text.php';?>
                            <!-- /footer content -->

                        </div><!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
