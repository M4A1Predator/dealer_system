<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
    <!--=== Header v5 ===-->   
    <?php include 'inc/nav.php' ?>
    <!--=== End Header v5 ===-->
    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">เกี่ยวกับเรา</span>
            <h1>Dealer <span class="shop-green">System</span></h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="<?=base_url()?>/shop">Home</a></li>
                <li class="active">About</li>
            </ul>
        </div><!--/end container-->
    </div> 
    <!--=== End Breadcrumbs v4 ===-->

    <!--=== Login ===-->
    <div class="log-reg-v3 content-md">
        <div class="container">
            <div class="row">
                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title">เกี่ยวกับเรา</h2>
                    <?=$about?>
                </div>

                <div class="col-md-5">

                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Login ===-->     

    <?php include 'inc/footer.php' ?>