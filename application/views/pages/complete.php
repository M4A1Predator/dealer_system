<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
    <!--=== Header v5 ===-->
    <?php include 'inc/nav.php' ?>
    <!--=== End Header v5 ===-->

    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">ตะกร้าสินค้า</span>
            <h1>Dealer <span class="shop-green">System</span></h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="<?=base_url()?>shop">Home</a></li>
                <li class="active">Cart</li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <div class="content-md margin-bottom-30">
        <div class="container">
            <form class="shopping-cart" action="#" novalidate="novalidate">
                <div role="application" class="wizard clearfix" id="steps-uid-0">
                  <div class="steps clearfix">
                    <ul role="tablist">

                      <li role="tab" class="first disabled" aria-disabled="false" aria-selected="true">
                        <a id="steps-uid-0-t-0" aria-controls="steps-uid-0-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span>
                        <div class="overflow-h">
                            <h2>ตะกร้าสินค้า</h2>
                            <p>แก้ไข &amp; จัดการตะกร้าสินค้า</p>
                            <i class="rounded-x fa fa-check"></i>
                        </div>
                      </a>
                      </li>

                      <li role="tab" class="last current" aria-disabled="true">
                        <a id="steps-uid-0-t-2" aria-controls="steps-uid-0-p-2"><span class="number">2.</span>
                        <div class="overflow-h">
                            <h2>การชำระเงิน</h2>
                            <p>สามารถเลือกชำระเงินได้ทุกช่องทาง</p>
                            <i class="rounded-x fa fa-credit-card"></i>
                        </div>
                        </a>
                      </li>

                      </ul>
                    </div>

                    <div class="content clearfix">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ชื่อสินค้า</th>
                                        <th>ราคา</th>
                                        <th>จำนวน</th>
                                        <th>รวม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order_products as $op){ ?>
                                    <tr>
                                        <td class="product-in-table">
                                            <img class="img-responsive" src="<?=base_url().$op->product_img1?>" alt="">
                                            <div class="product-it-in">
                                                <h3><?=$op->order_product_name?></h3>
                                                <span><?=$op->brand_name?></span>
                                            </div>
                                        </td>
                                        <td><?=display_money($op->order_product_price)?> บาท</td>
                                        <td>
                                          x<?=$op->order_product_quantity?>
                                        </td>
                                        <td class="shop-red"><?=display_money($op->order_product_price*$op->order_product_quantity)?> บาท</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="coupon-code">
                            <div class="row">
                                <div class="col-sm-6">
                                  <label>ข้อมูลสำหรับจัดส่ง </label>
                                  <p><strong>คุณ<?=$dealer['dealer_fullname']?></strong></p>
                                  <p>โทร <?=$dealer['dealer_tel']?></p>
                                  <p><?=$order['order_address']?></p>
                                </div>
                                <div class="col-md-3 col-sm-4 col-sm-offset-2 col-md-offset-3">
                                    <ul class="list-inline total-result">
                                        <li>
                                            <h4>ราคารวม:</h4>
                                            <div class="total-result-in">
                                                <span><?=display_money($total_product_price)?> บาท</span>
                                            </div>
                                        </li>
                                        <li>
                                            <h4>ค่าขนส่ง:</h4>
                                            <div class="total-result-in">
                                                <span class="text-right">ฟรี</span>
                                            </div>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="total-price">
                                            <h4>ยอดชำระ:</h4>
                                            <div class="total-result-in">
                                                <span><?=display_money($order['order_price'])?> บาท</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <?php foreach($banks as $b){ ?>
                            <div class="col-sm-3 col-lg-3 col-md-3">
                                <div class="thumbnail">
                                    <img src="<?=base_url()."images/banks/BANK-N-".$b['bank_picture'].'.jpg'?>" alt="" style="width: 100% !important; max-height: 120px;">
                                    <div class="caption">
                                        <h4><a href="#">ธนาคาร<?=$b['bank_name']?></a>
                                        </h4>
                                        <p><strong>เลขบัญชี:</strong> <?=$b['bank_number']?></p>
                                          <p><strong>ชื่อบัญชี:</strong> <?=$b['bank_accountname']?></p>
                                          <p><strong>สาขา:</strong> <?=$b['bank_branch']?></p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="text-center">
                            <a href="<?=base_url()?>shop/order/<?=$order['order_id']?>/payment_report" class="btn btn-primary btn-lg"><i class="fa fa-credit-card"></i> แจ้งชำระเงิน</a>
                        </div>
                    </div>
                    </div>
                    
            </form>
        </div><!--/end container-->
    </div>

    <?php include 'inc/footer.php' ?>
