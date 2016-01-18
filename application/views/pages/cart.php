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
                <li><a href="<?=base_url()?>">Home</a></li>
                <li class="active">Cart</li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <div class="content-md margin-bottom-30">
        <div class="container">
            <form class="shopping-cart" id="orderForm" action="<?=base_url()?>shop/order/add_order" method="post" novalidate="novalidate">
                <input type="hidden" name="con" value="ok">
                <div role="application" class="wizard clearfix" id="steps-uid-0">
                  <div class="steps clearfix">
                    <ul role="tablist">

                      <li role="tab" class="first current" aria-disabled="false" aria-selected="true">
                        <a id="steps-uid-0-t-0" aria-controls="steps-uid-0-p-0"><span class="current-info audible">current step: </span><span class="number">1.</span>
                        <div class="overflow-h">
                            <h2>ตะกร้าสินค้า</h2>
                            <p>แก้ไข &amp; จัดการตะกร้าสินค้า</p>
                            <i class="rounded-x fa fa-check"></i>
                        </div>
                      </a>
                      </li>

                      <li role="tab" class="last disabled" aria-disabled="true">
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
                    <section id="steps-uid-0-p-0" role="tabpanel" aria-labelledby="steps-uid-0-h-0" class="body current" aria-hidden="false" style="display: block;">
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
                                    <?php foreach($products_with_qty as $p){ ?>
                                    <tr>
                                        <td class="product-in-table">
                                            <img class="img-responsive" src="<?=base_url().$p->product_img1?>" alt="">
                                            <div class="product-it-in">
                                                <h3><?=$p->product_name?></h3>
                                                <span><?=$p->brand_name?></span>
                                            </div>
                                        </td>
                                        <td id="price<?=$p->product_id?>"><?=$p->price_price?> บาท</td>
                                        <td>
                                            <button type="button" name="deQty<?=$p->product_id?>" class="quantity-button" onclick="deQty(<?=$p->product_id?>)" value="-">-</button>
                                            <input type="text" min="1" class="quantity-field" name="qty<?=$p->product_id?>" value="<?=$p->qty?>">
                                            <button type="button" name="inQty<?=$p->product_id?>" class="quantity-button" onclick="inQty(<?=$p->product_id?>)" value="+">+</button>
                                        </td>
                                        <td class="shop-red" id="calPrice<?=$p->product_id?>"> บาท</td>
                                        <td>
                                            <button type="button" onclick="removeFromCartPage(<?=$p->product_id?>)" class="close"><span>×</span><span class="sr-only">Close</span></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <!--
                                    <tr>
                                        <td class="product-in-table">
                                            <img class="img-responsive" src="<?=base_url()?>mats/img/thumb/07.jpg" alt="">
                                            <div class="product-it-in">
                                                <h3>Vivamus ligula</h3>
                                                <span>Sed aliquam tincidunt tempus</span>
                                            </div>
                                        </td>
                                        <td>160.00 บาท</td>
                                        <td>
                                            <button type="button" class="quantity-button" name="subtract" onclick="javascript: subtractQty2();" value="-">-</button>
                                            <input type="text" class="quantity-field" name="qty2" value="3" id="qty2">
                                            <button type="button" class="quantity-button" name="add" onclick="javascript: document.getElementById(&quot;qty2&quot;).value++;" value="+">+</button>
                                        </td>
                                        <td class="shop-red">320.00 บาท</td>
                                        <td>
                                            <button type="button" class="close"><span>×</span><span class="sr-only">Close</span></button>
                                        </td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </section>


                    <div class="coupon-code">
                        <div class="row">
                            <div class="col-sm-6">
                              <label>ข้อมูลสำหรับจัดส่ง (สามารถแก้ไขให้ถูกต้องได้)</label>
                              <textarea name="address" rows="4" style="font-size:20px;padding:5px;width:100%;"><?=$dealer['dealer_address']?></textarea>
                            </div>
                            <div class="col-md-3 col-sm-4 col-sm-offset-2 col-md-offset-3">
                                <ul class="list-inline total-result">
                                    <li>
                                        <h4>ราคารวม:</h4>
                                        <div class="total-result-in">
                                            <span id="totalPrice">0 บาท</span>
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
                                            <span id="nPrice">0 บาท</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="actions clearfix">
                  <ul role="menu" aria-label="Pagination">
                    <li class="disabled" aria-disabled="true"><a href="<?=base_url()?>shop/product" onclick="" role="menuitem"><i class="fa fa-shopping-cart"></i> เลือกซื้อสินค้าต่อ</a></li>
                    <li aria-hidden="false" aria-disabled="false"><a href="javascript:;" onclick="editCart()" role="menuitem">ดำเนินการสั่งซื้อ <i class="fa fa-chevron-right"></i></a></li><li aria-hidden="true" style="display: none;"><a href="#finish" role="menuitem">Finish</a></li>
                  </ul>
                </div>
                </div>
            </form>
        </div><!--/end container-->
    </div>
    <script type="text/javascript" src="<?=base_url()?>mats/js/cartJq.js"></script>

    <?php include 'inc/footer.php' ?>
