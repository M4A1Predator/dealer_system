<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
        
         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>

    <!--=== Profile Content ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <?php include 'inc/accountbar.php' ?>
            <!--End Left Sidebar-->

            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="profile-body">
                  <!--Service Block v3-->
                    <!--Table Search v1-->
                    <div class="table-search-v1 margin-bottom-20">
                        
                        <div class="table-responsive">
                        <div class="heading heading-v2 margin-bottom-10">
                        <h2>ประวัติการสั่งซื้อ</h2>
                        </div>
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ใบสั่งซื้อ</th>
                                        <th class="hidden-sm">เวลา</th>
                                        <th>จำนวนเงิน</th>
                                        <th>ส่วนลดรวม</th>
                                        <th>สถานะ</th>
                                        <th class="max-120">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order){ ?>
                                    <tr>
                                        <td><a href="<?=base_url()?>shop/order/<?=$order->order_id?>"><?=$order->order_id?></a></td>
                                        <td class="td-width"><?=display_datetime($order->order_datetime)?></td>
                                        <td><?=display_money($order->order_price)?> บาท</td>
                                        <td><?=display_money($order->order_oprice - $order->order_price)?> บาท</td>
                                        <?php if($order->order_status_id == 1){ ?>
                                        <td>
                                             <a class="btn-u btn-u2 btn-u-red btn-block btn-u-xs">
                                               <i class="fa fa-credit-card margin-right-5"></i> ยังไม่ได้แจ้งชำระเงิน
                                             </a>
                                        </td>
                                        <td class="max-120">
                                            <a href="<?=base_url()?>shop/order/<?=$order->order_id?>/payment_report" class="btn-u btn-u2 btn-block btn-u-dark-blue btn-u-xs">
                                              <i class="fa fa-credit-card margin-right-5"></i> แจ้งชำระเงิน
                                            </a>
                                            <a id="order<?=$order->order_id?>" onclick="setOrderId(<?=$order->order_id?>)" class="btn-u btn-u2 btn-block btn-u-red btn-u-xs" data-toggle="modal" data-target="#rmModal">
                                              <i class="fa fa-close margin-right-5"></i> ยกเลิกรายการ
                                            </a>
                                        </td>
                                        <?php }else if($order->order_status_id == 2){ ?>
                                        <td><a class="btn-u btn-u2 btn-block btn-u-yellow btn-u-xs">
                                             <i class="fa fa-credit-card margin-right-5"></i> แจ้งชำระเงินแล้ว</a>
                                        </td>
                                        <td class="max-120">
                                             <a class="btn-u btn-u2 btn-block btn-u-dark btn-u-xs cursor-defult">
                                               <i class="fa fa-credit-card margin-right-5"></i> รอยืนยัน
                                             </a>
                                        </td>
                                        <?php }else if($order->order_status_id == 3 || $order->order_status_id == 4){ ?>
                                        <td>
                                             <a class="btn-u btn-u2 btn-u-blue btn-block btn-u-xs">
                                               <i class="fa fa-credit-card margin-right-5"></i> ยืนยันการชำระเงินแล้ว
                                             </a>
                                        </td>
                                        <td class="max-120">
                                             <a class="btn-u btn-u2 btn-block btn-u-dark btn-u-xs cursor-defult">
                                               <i class="fa fa-credit-card margin-right-5"></i> รอจัดส่งสินค้า
                                             </a>
                                        </td>
                                        <?php }else if($order->order_status_id == 5){ ?>
                                        <td class="max-120" colspan=2>
                                             <a class="btn-u btn-u2 btn-block btn-u-green btn-u-xs">
                                               <i class="fa fa-credit-card margin-right-5"></i> จัดส่งแล้ว
                                             </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                               </tbody>
                            </table>

                           <div class="text-center">
                               <ul class="pagination">
                                   <?php if($page-1 != 0){ ?>
                                  <li><a href="javascript:;" class="pBtnMin">«</a></li>
                                  <li class=""><a href="javascript:;" class="" class="pBtn"><?=$page-1?></a></li>
                                  <?php } ?>
                                  <li class="active"><a href="javascript:;" class="pBtn" id="pNow"><?=$page?></a></li>
                                  <?php if($page+1 <= $page_amount){ ?>
                                  <li class=""><a href="javascript:;" class="pBtn"><?=$page+1?></a></li>
                                  <li class=""><a href="javascript:;" class="pBtnPlus">»</a></li>
                                  <?php } ?>
                               </ul>
                           </div>

                        </div>
                    </div>
                    <!--End Table Search v1-->
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>
    <!--=== End Profile Content ===-->





    <?php include 'inc/footer.php' ?>