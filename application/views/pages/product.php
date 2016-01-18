<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">

         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>

<div class="shop-product">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="<?=base_url()?>shop/"><i class="fa fa-home"></i></a></li>
                <li><a href="<?=base_url()?>shop/product">สินค้าทั้งหมด</a></li>
                <li><a href="<?=base_url()?>shop/product?cats=<?=$product->category_id?>"><?=$product->category_name?></a></li>
                <li><a href="<?=base_url()?>shop/product?brands=<?=$product->brand_name?>"><?=$product->brand_name?></a></li>
                <li class="active"><?=$product->product_name?></li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->

        <div class="container">
            <div class="row">
                <div class="col-md-6 md-margin-bottom-50">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <?php if($product->product_img2 != NULL){ ?>
                                <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                                <?php } ?>
                                <?php if($product->product_img3 != NULL){ ?>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                <?php } ?>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="<?=base_url().$product->product_img1.'?ccpic='.urlencode(time())?>" alt="">
                                </div>
                                <?php if($product->product_img2 != NULL){ ?>
                                <div class="item">
                                    <img class="slide-image" src="<?=base_url().$product->product_img2.'?ccpic='.urlencode(time())?>" alt="">
                                </div>
                                <?php } ?>
                                <?php if($product->product_img3 != NULL){ ?>
                                <div class="item">
                                    <img class="slide-image" src="<?=base_url().$product->product_img3.'?ccpic='.urlencode(time())?>" alt="">
                                </div>
                                <?php } ?>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                </div>

                   <div class="shop-product-heading">
                        <h2><?=$product->product_name?></h2>
                    </div><!--/end shop product social-->
                    <div class="col-md-6">
                           <p><?=html_entity_decode(stripslashes(nl2br($product->product_detail)),ENT_NOQUOTES,"Utf-8")?></p><br>
                           <ul class="list-inline shop-product-prices margin-bottom-30">
                               <?php if($product->product_price != $product->price_price){ ?>
                               <li class="shop-red"><?=$product->price_price?> บาท</li>
                               <li class="line-through"><?=$product->product_price?> บาท</li>
                               <li><small class="shop-bg-red time-day-left">กำไร <?=$product->product_price - $product->price_price?> บาท</small></li>
                               <?php }else{ ?>
                               <li class=""><?=$product->price_price?> บาท</li>
                               <?php } ?>
                           </ul><!--/end shop product prices-->
                           
                           <?php if($product->product_status_id == 1){ ?>
                           <h3 class="shop-product-title">จำนวน</h3>
                           <div class="margin-bottom-40">
                               <form action="<?=base_url()?>shop/add_to_cart" method="post" name="addToCardForm" class="product-quantity sm-margin-bottom-20">
                                   <input type="hidden" name="pid" value="<?=$product->product_id?>">
                                   <input type="hidden" name="next" value="cart">
                                   <button type="button" class="quantity-button" name="subtract" onclick="javascript: subtractQty();" value="-">-</button>
                                   <input type="text" class="quantity-field" name="amount" value="1" id="qty">
                                   <button type="button" class="quantity-button" name="add" onclick="javascript: document.  getElementById(&quot;qty&quot;).value++;" value="+">+</button>
                               </form>
                               <button type="button" id="addToCardSubmit" class="btn-u btn-u-sea-shop btn-u-lg"><i class="fa fa-shopping-cart"></i> ใส่ตะกร้า</button>
                           </div><!--/end product quantity-->
                           <?php }else if($product->product_status_id == 2){ ?>
                           <h1 style="color: red;">สินค้าหมดชั่วคราว</h1>
                           <?php } ?>
                           <p class="wishlist-category"><strong>หมวดหมู่:</strong> <a href="<?=base_url()?>shop/product?cats=<?=$product->category_id?>"><?=$product->category_name?> </a><strong> แบรนด์:</strong> <a href="<?=base_url()?>shop/product?brands=<?=$product->brand_name?>"><?=$product->brand_name?></a></p>
                  </div>
            </div><!--/end row-->
        </div>
    </div>




    <?php include 'inc/footer.php' ?>
