<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
        
         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>

    <!--=== Profile Content ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->

            <?php 
                include 'inc/accountbar.php' 
            ?>
            <!--End Left Sidebar-->

            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="profile-body">
        
                    <div class="profile-bio">
                        <div class="row">
                            <div class="col-md-12">
                                <h2><?=$dealer['dealer_fullname']?></h2>
                                <span><strong>ระดับตัวแทน:</strong> <?=$dealer['level_name']?></span>
                                <span><strong>ชื่อร้าน:</strong> <?=$dealer['dealer_shopname']?></span>
                                <hr>
                                <p><strong>ที่อยู่สำหรับจัดส่ง: </strong><?=$dealer['dealer_address']?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <!--Social Icons v3-->
                        <div class="col-sm-6 sm-margin-bottom-30">
                            <div class="panel panel-profile">
                                <div class="panel-heading overflow-h">
                                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i> ข้อมูลติดต่อ</h2>
                                    <a><i class="fa fa-cog pull-right"></i></a>
                                </div>
                                <div class="panel-body">
                                     <ul class="list-unstyled social-contacts-v2">
                                        <li><i class="rounded-x tw fa fa-phone-square"></i> <a><?=$dealer['dealer_tel']?></a></li>
                                        <li><i class="rounded-x fb fa fa-facebook"></i> <a target="_blank" href="<?=$dealer['dealer_facebook']?>"><?=display_facebook($dealer['dealer_facebook'])?></a></li>
                                        <li><i class="rounded-x gm fa fa-envelope"></i> <a><?=$dealer['dealer_email']?></a></li>
                                        <li><i class="rounded-x line fa fa-comment"></i> <a><?=$dealer['dealer_line']?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End Social Icons v3-->
                        <!--Social Icons v3-->
                        <div class="col-sm-6 sm-margin-bottom-30">
                            <div class="panel panel-profile">
                                <div class="panel-heading overflow-h">
                                    <h2 class="panel-title heading-sm pull-left"><i class="fa fa-pencil"></i> ข้อมูลร้านค้า</h2>
                                    <a><i class="fa fa-cog pull-right"></i></a>
                                </div>
                                <div class="panel-body">
                                     <ul class="list-unstyled social-contacts-v2">
                                        <li><i class="rounded-x gm fa fa-home"></i> <a><?=$dealer['dealer_shopname']?></a></li>
                                        <li><i class="rounded-x libe fa fa-star"></i> <a><?=$dealer['level_name']?></a></li>
                                        <li><i class="rounded-x fb fa fa-facebook-square"></i> <a target="_blank" href="<?=$dealer['dealer_fanpage']?>"><?=display_facebook($dealer['dealer_fanpage'])?></a></li>
                                        <li><i class="rounded-x link fa fa-link"></i> <a target="_blank" href="<?=$dealer['dealer_website']?>"><?=$dealer['dealer_website']?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--End Social Icons v3-->
                    </div>
                                   <hr> <div class="row text-center"><a class="btn-u btn-u-sea-shop" href="profile/edit"><i class="fa fa-pencil"></i> แก้ไขข้อมูล</a></div>
                </div>
                    <!--End Table Search v1-->
            </div>
        </div>
            <!-- End Profile Content -->
        </div>
</div>
    <!--=== End Profile Content ===-->





    <?php include 'inc/footer.php' ?>