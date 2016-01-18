<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper" ng-app="searchAng" ng-controller="searchAngCtrl">
        
         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>
    <div class="content container">
        <div class="row">
        
            <?php include 'inc/sidebar.php'; ?>

            <div class="col-md-9">
                <div class="row margin-bottom-5">
                    <div class="col-sm-4 result-category">
                        <h2>สินค้าทั้งหมด</h2>
                        <small class="shop-bg-red badge-results"><?=$amount?> ชิ้น</small>
                    </div>
                    <div class="col-sm-8">
                        <ul class="list-inline clear-both">
                            <li class="sort-list-btn padding-r-0">
                                <h3>เรียงลำดับโดย :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                             <span id="odNow<?=$sort?>">วันที่ลงขาย</span> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:;" id="sort1">วันที่ลงขาย</a></li>
                                        <li><a href="javascript:;" id="sort2">ราคา สูง > ต่ำ</a></li>
                                        <li><a href="javascript:;" id="sort3">ราคา ต่ำ > สูง</a></li>
                                        <li><a href="javascript:;" id="sort4">ความนิยม</a></li>
                                        <li><a href="javascript:;" id="sort5">ส่วนลด</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sort-list-btn">
                                <h3>แสดงจำนวน :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <?=$lim?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="javascript:;" class="lim">9</a></li>
                                        <li><a href="javascript:;" class="lim">18</a></li>
                                        <li><a href="javascript:;" class="lim">27</a></li>
                                        <li><a href="javascript:;" class="lim">36</a></li>
                                        <li><a href="javascript:;" class="lim">45</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>    
                </div><!--/end result category-->

                <div class="filter-results">
                  <?php $c=0; ?>
                  <?php foreach($products as $p){ ?>
                  <?php echo $c%3===0?'<div class="row illustration-v2 margin-bottom-30">':''; ?>
                        <div class="col-md-4">
                             <div class="product-img" style="height: 180px !important;background-image: url('<?=base_url().$p->product_img1?>');background-size: cover;">
                                <!--<img class="full-width img-responsive" src="" alt="" style=" width: 100% !important; max-height: 180px;">-->
                                <a class="product-review" href="<?=base_url()?>shop/product/<?=$p->product_id?>">รายละเอียดสินค้า</a>
                                <?php if($p->status_id == '1'){ ?>
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
                  <?php echo $c%3==2?'</div>':''; $c++?>
                  <?php } ?>

                </div><!--/end filter resilts-->
                <div class="text-center">
                  <ul class="pagination pagination-v2"> 
                        <?php if($page-1 != 0){ ?>
                        <li><a href="javascript:;" class="pBtnMin"><i class="fa fa-angle-left"></i></a></li>
                        <li class=""><a href="javascript:;" class="pBtn"><?=$page-1?></a></li>
                        <?php } ?>
                        <li class="active"><a href="javascript:;" class="pBtn" id="pNow"><?=$page?></a></li>
                        <?php if($page+1 <= $page_amount){ ?>
                        <li class=""><a href="javascript:;" class="pBtn"><?=$page+1?></a></li>
                        <li class=""><a href="javascript:;" class="pBtnPlus"><i class="fa fa-angle-right"></i></a></li>
                        <?php } ?>
                    </ul>                                                            
                </div><!--/end pagination-->
            </div>
            <!-- another div--></div>
        </div><!--/end row-->
    </div>
    
    
    <script type="text/javascript" src="<?=base_url()?>mats/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>mats/js/filterJq.js"></script>
    <script type="text/javascript" src="<?=base_url()?>mats/js/pageJq.js"></script>
    <script type="text/javascript" src="<?=base_url()?>mats/js/searchJq.js"></script>

<?php include 'inc/footer.php' ?>