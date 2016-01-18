<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
        
         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>
    <div class="content container">
        <div class="row">
            <?php include 'inc/sidebar.php'; ?>
            <div class="col-md-9">
                <div class="row margin-bottom-5">
                    <div class="col-sm-4 result-category">
                        <h2><?php echo $_GET["keyword"];?></h2>
                        <small class="shop-bg-red badge-results">45 ชิ้น</small>
                    </div>
                    <div class="col-sm-8">
                        <ul class="list-inline clear-both">
                            <li class="sort-list-btn padding-r-0">
                                <h3>เรียงลำดับโดย :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        วันที่ลงขาย <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">ราคา สูง > ต่ำ</a></li>
                                        <li><a href="#">ราคา ต่ำ > สูง</a></li>
                                        <li><a href="#">ความนิยม</a></li>
                                        <li><a href="#">ส่วนลด</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="sort-list-btn">
                                <h3>แสดงจำนวน :</h3>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        9 <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">18</a></li>
                                        <li><a href="#">27</a></li>
                                        <li><a href="#">36</a></li>
                                        <li><a href="#">45</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>    
                </div><!--/end result category-->

                <div class="filter-results">
                    <div class="row illustration-v2 margin-bottom-30">
                        <div class="col-md-4">
                             <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-2.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                            </div>
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Rayshi Thailand ครีมหน้าสด</a></h4>
                                        <span class="gender text-uppercase">Woman</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-3.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                            </div> 
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Men</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                        <div class="col-md-4">
                               <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-1.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-red rgba-banner">สินค้าหมดชั่วคราว</div>
                            </div> 
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Women</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                    </div>

                    <div class="row illustration-v2 margin-bottom-30">
                        <div class="col-md-4">
                             <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-4.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                            </div>
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Rayshi Thailand ครีมหน้าสด</a></h4>
                                        <span class="gender text-uppercase">Woman</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-1.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                            </div> 
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Men</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                        <div class="col-md-4">
                               <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-2.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-dark-green rgba-banner">สินค้าใหม่</div>
                            </div> 
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Women</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                    </div>

                    <div class="row illustration-v2">
                        <div class="col-md-4">
                             <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-3.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                            </div>
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Rayshi Thailand ครีมหน้าสด</a></h4>
                                        <span class="gender text-uppercase">Woman</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                        <div class="col-md-4">
                             <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-2.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                            </div> 
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Men</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                        <div class="col-md-4">
                               <div class="product-img">
                                <a href="#"><img class="full-width img-responsive" src="assets/img/p-test-4.jpg" alt=""></a>
                                <a class="product-review" href="product.php">รายละเอียดสินค้า</a>
                                <a class="add-to-cart" href="#"><i class="fa fa-shopping-cart"></i>ใส่ตะกร้า</a>
                                <div class="shop-rgba-red rgba-banner">สินค้าหมดชั่วคราว</div>
                            </div> 
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="#">Double-breasted</a></h4>
                                        <span class="gender text-uppercase">Women</span>
                                        <span class="gender">หมวดหมู่ - Blazers</span>
                                    </div>    
                                </div>    
                                <ul class="list-inline">
                                        <span class="title-price">95.00 บาท</span>
                                        <li class="full-price"><span class="title-price line-through">125.00 บาท</span></li>
                                    </ul>    
                            </div>
                        </div>
                    </div>

                </div><!--/end filter resilts-->

                <div class="text-center">
                    <ul class="pagination pagination-v2">
                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>                                                            
                </div><!--/end pagination-->
            </div>
        </div><!--/end row-->
    </div>





    <?php include 'inc/footer.php' ?>