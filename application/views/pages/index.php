<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
        
         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>
         <?php date_default_timezone_set(SITE_TIMEZONE); ?>

    <!--=== Product Content ===-->
    <div class="container content-md">
            <div class="heading heading-v2 margin-bottom-20">
            <h2>สินค้ามาใหม่ล่าสุด</h2>
        </div>

        <!--=== Illustration v2 ===-->
        <div class="illustration-v2 margin-bottom-60">
            <div class="customNavigation margin-bottom-25">
                <a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
                <a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
            </div>

            <ul class="list-inline owl-slider">
                
                <?php foreach($nps as $p){ ?>
                <li class="item">
                    <div class="product-img" style="height: 180px !important;background-image: url('<?=base_url().$p->product_img1?>');background-size: cover;">
                        <!--<img class="full-width img-responsive" src="http://dealer.makeuperaserthailandofficial.com/images/products/product15-1_thumb.jpeg" alt="">-->
                        <a class="product-review" href="<?=base_url()?>shop/product/<?=$p->product_id?>">รายละเอียดสินค้า</a>
                        <?php if($p->status_id == '1'){?>
                        <a class="add-to-cart" href="javascript:;" onclick="addToCart(<?=$p->product_id?>, 1)"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                        <?php } ?>
                        <?php if($p->status_id == '2'){?>
                        <div class="shop-rgba-red rgba-banner">สินค้าหมดชั่วคราว</div>
                        <?php }else if(in_array($p->product_id, $this->session->userdata('new_pids'))){?>
                        <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                        <?php } ?>
                    </div> 
                    <div class="product-description product-description-brd">
                        <div class="overflow-h margin-bottom-5">
                            <div class="pull-left">
                                <h4 class="title-price"><a href="<?=base_url()?>shop/product/<?=$p->product_id.'?ccpic='.urlencode(time())?>"> <?=$p->product_name?> </a></h4>
                                <span class="gender text-uppercase"><?=$p->brand_name?></span>
                                <span class="gender">หมวดหมู่ - <?=$p->category_name?></span>
                            </div>    
                        </div>    
                        <ul class="list-inline">
                            <span class="title-price"><?=$p->price_price?> บาท</span>
                            <?php if($p->price_price != $p->product_price){ ?>
                            <li class="full-price"><span class="title-price line-through"><?=$p->product_price?> บาท</span></li>
                            <?php } ?>
                        </ul>     
                    </div>
                </li>
                <?php } ?>
                </ul>
        </div> 
        <!--=== End Illustration v2 ===-->

        <div class="heading heading-v2 margin-bottom-40">
            <h2>สินค้าขายดีประจำวันนี้</h2>
        </div>

        <!--=== Illustration v2 ===-->
        <div class="row illustration-v2">
            <?php foreach($hps as $p){ ?>
            <div class="col-md-3 col-sm-6 md-margin-bottom-30" >
               <div class="product-img" style="height: 180px !important;background-image: url('<?=base_url().$p->product_img1?>');background-size: cover;">
                    <a class="product-review" href="<?=base_url()?>shop/product/<?=$p->product_id?>">รายละเอียดสินค้า</a>
                    <?php if($p->status_id == '1'){?>
                    <a class="add-to-cart" href="javascript:;" onclick="addToCart(<?=$p->product_id?>, 1)"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                    <?php } ?>
                    <?php if($p->status_id == '2'){?>
                    <div class="shop-rgba-red rgba-banner">สินค้าหมดชั่วคราว</div>
                    <?php }else if(date("m", strtotime($p->product_datetime)) == date('m')){?>
                    <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                    <?php } ?>
                </div>
                <div class="product-description product-description-brd">
                    <div class="overflow-h margin-bottom-5">
                        <div class="pull-left">
                            <h4 class="title-price"><a href="<?=base_url()?>shop/product/<?=$p->product_id?>"><?=$p->product_name?></a></h4>
                            <span class="gender text-uppercase"><?=$p->brand_name?></span>
                            <span class="gender">หมวดหมู่ - <?=$p->category_name?></span>
                        </div>    
                    </div>    
                    <ul class="list-inline">
                            <span class="title-price"><?=$p->price_price?> บาท</span>
                            <?php if($p->price_price != $p->product_price){ ?>
                            <li class="full-price"><span class="title-price line-through"><?=$p->product_price?> บาท</span></li>
                            <?php } ?>
                     </ul>      
                </div>
            </div>
            <?php } ?>
        </div> 
        <!--=== End Illustration v2 ===-->
    </div>
    <!--=== End Product Content ===-->

<?php include 'inc/footer.php' ?>