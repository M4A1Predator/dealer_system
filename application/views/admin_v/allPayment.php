
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
                                          รายการแจ้งชำระเงิน
                                        </h3>
                                    </div>

                                    <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-12">
                                      <select id="brandProduct" name="brandProduct" class="form-control statusBtn">
                                        <option value="">เลือกสถานะรายการ</option>
                                        <?php foreach($sts as $st){ ?>
                                        <option value="<?=$st['order_status_id']?>" <?= $st['order_status_id']==$osid?'selected':'' ?>><?=$st['order_status_name']?></option>
                                         <?=$st['order_status_id']?>
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
                                                            <th>ธนาคาร</th>
                                                            <th>เวลาที่โอน</th>
                                                            <th>ชื่อลูกค้า</th>
                                                            <th>จำนวนเงินที่โอน</th>
                                                            <th>หลักฐานการโอนเงิน</th>
                                                            <!--<th>ดำเนินการ</th>-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $c=$off+1; ?>
                                                        <?php foreach($payments as $p){ ?>
                                                        <tr>
                                                            <th scope="row"><?=$c++?></th>
                                                            <td><?=$p->order_id?></td>
                                                            <td><?=$p->bank_name?></td>
                                                            <td><?=$p->payment_date." ".$p->payment_time?></td>
                                                            <td><?=$p->dealer_fullname?></td>
                                                            <td><?=display_money($p->payment_amount)?> บาท</td>
                                                            <td>
                                                              <button type="button" class="btn btn-default btn-xs" onclick="location.href='<?=base_url()?>admin/order/payment/<?=$p->payment_id?>';">
                                                                <i class="fa fa-file-image-o"></i> แสดงหลักฐาน
                                                              </button>
                                                            </td>
                                                            <!--
                                                            <td>
                                                              <button type="button" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash"></i> ลบรายการ
                                                              </button>
                                                            </td>
                                                            -->
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
                            <script type="text/javascript" src="<?=base_url()?>assets/angjq/pageJq.js"></script>
                            <script type="text/javascript" src="<?=base_url()?>assets/angjq/orderJq.js"></script>

                            <!-- footer content -->
                            <?php include 'include/footer-text.php';?>
                            <!-- /footer content -->

                        </div><!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
