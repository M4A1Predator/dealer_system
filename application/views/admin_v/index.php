
<?php $this->load->view('admin_v/include/head');?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

                    <?php $this->load->view('admin_v/include/sidebar');?>
                    <?php $this->load->view('admin_v/include/topNavigation');?>

            <!-- page content -->
            <div class="right_col" role="main">

                <!-- top tiles -->
                <div class="row tital_count">
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="left hidden-md hidden-lg hidden-sm"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-credit-card"></i> ยอดขายรวม</span>
                            <div class="count"><?=display_money($sale_total)?> ฿</div>
                            <span class="count_bottom"></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-credit-card"></i> ยอดขายปีนี้</span>
                            <div class="count"><?=display_money($sale_this_year)?> ฿</div>
                            <span class="count_bottom"></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="left hidden-sm"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-credit-card"></i> ยอดขายเดือนนี้</span>
                            <div class="count"><?=display_money($sale_this_month)?> ฿</div>
                            <span class="count_bottom"></span>
                        </div>
                    </div>
                    <div class="animated flipInY col-md-3 col-sm-6 col-xs-12 tile_stats_count">
                        <div class="left"></div>
                        <div class="right">
                            <span class="count_top"><i class="fa fa-credit-card"></i> ยอดขายวันนี้</span>
                            <div class="count"><?=display_money($sale_this_day)?> ฿</div>
                            <span class="count_bottom"></span>
                        </div>
                    </div>
                </div>
                <!-- /top tiles -->
                <div class="row">
                    <div class="col-md-6">
                        <h3>
                          รายการสั่งซื้อล่าสุด
                        </h3>
                    </div>
                </div>
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
                                            <td><?=$od->order_price?> บาท</td>
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
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                </div>
                
                <!-- footer content -->
                <?php $this->load->view('admin_v/include/footer-text');?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php $this->load->view('admin_v/include/footer');?>
