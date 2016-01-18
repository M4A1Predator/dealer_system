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
                        <small class="shop-bg-red badge-results">0 ชิ้น</small>
                    </div>
                    <div class="col-sm-8">
                        
                    </div>    
                </div><!--/end result category-->

                <div class="filter-results">
                    <div class="row illustration-v2 margin-bottom-30">
                        <div class="col-md-12 text-center">
                            <h3>ทางเราไม่พบข้อมูลสำหรับ "<?php echo $_GET["keyword"];?>"</h3>

                            <p>กรุณาตรวจความถูกต้องของตัวสะกด, กรุณาใช้คำที่ใช้ทั่วไป และ ลองอีกครั้ง!<p>
                        </div>
                        <div class="col-md-12 text-center">
                        <form class="form-inline" role="form" action="searchshow.php" method="get">
                            <div class="input-group search-group">
                                    <input type="text" class="form-control search-input" name="keyword" placeholder="กรอกชื่อสินค้าเพื่อคนหาใหม่ดูสิจ๊ะ" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger btn-search" type="submit">ค้นหาสินค้า!</button>
                                    </span>
                                </div>
                        </form>   
                        </div>       
                    </div>
                </div><!--/end filter resilts-->
            </div>
        </div><!--/end row-->
    </div>





    <?php include 'inc/footer.php' ?>