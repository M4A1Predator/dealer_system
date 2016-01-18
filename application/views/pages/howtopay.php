<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
    <!--=== Header v5 ===-->
    <?php include 'inc/nav.php' ?>
    <!--=== End Header v5 ===-->

    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">ช่องทางชำระเงิน</span>
            <h1>Dealer <span class="shop-green">System</span></h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="index.html">Home</a></li>
                <li class="active">How to pay</li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->
    

    <div class="content-md margin-bottom-30">
        <div class="container">
            <form class="shopping-cart" action="#" novalidate="novalidate">
                <div role="application" class="wizard clearfix" id="steps-uid-0">
                  <div class="steps clearfix">
                    <h2 class="welcome-title">ช่องทางชำระเงิน</h2>
                  </div>
                    <div class="content clearfix">
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
                            
                        </div>
                    </div>
                </div>
                    
            </form>
        </div><!--/end container-->
    </div>

    <?php include 'inc/footer.php' ?>
