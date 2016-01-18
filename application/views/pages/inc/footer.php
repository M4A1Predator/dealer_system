<?php
    $detail_file = 'details/address.json';
    if(file_exists($detail_file)){
        $detail_json = file_get_contents($detail_file);
        $detail = json_decode($detail_json);
    }

    $de_address = isset($detail->address)?$detail->address:'';
    $de_mobile = isset($detail->mobile)?$detail->mobile:'';
    $de_tel = isset($detail->tel)?$detail->tel:'';
    $de_email = isset($detail->email)?$detail->email:'';
    $de_facebook = isset($detail->facebook)?$detail->facebook:'';
    $de_twitter = isset($detail->twitter)?$detail->twitter:'';
    $de_google = isset($detail->google)?$detail->google:'';
    $de_youtube = isset($detail->youtube)?$detail->youtube:'';
    $de_store = isset($detail->store)?$detail->store:'';
?>
    <!--=== Footer v4 ===-->
    <div class="footer-v4">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-4 md-margin-bottom-40">
                        <a href="<?=base_url()?>shop/"><img class="footer-logo" src="<?=base_url()?>mats/img/logo-2.png" alt=""></a>
                        <p><?=$de_store?></p>
                        <br>
                    </div>
                    <!-- End About -->
                    <!-- About -->
                    <div class="col-md-4 md-margin-bottom-40">
                        <h2 class="thumb-headline">ติดต่อบริษัท</h2>
                        <ul class="list-unstyled address-list margin-bottom-20">
                            <li><i class="fa fa-angle-right"></i> <?=$de_address?></li>
                            <li><i class="fa fa-angle-right"></i>โทรศัพท์มือถือ: <?=$de_mobile?></li>
                            <li><i class="fa fa-angle-right"></i>สำนักงาน: <?=$de_tel?></li>
                            <li><i class="fa fa-angle-right"></i>อีเมล์: <?=$de_email?></li>
                        </ul>

                        <ul class="list-inline shop-social">
                            <li><a href="<?=$de_facebook?>" target="_blank"><i class="fb rounded-md fa fa-facebook"></i></a></li>
                            <li><a href="<?=$de_twitter?>" target="_blank"><i class="tw rounded-md fa fa-twitter"></i></a></li>
                            <li><a href="<?=$de_google?>" target="_blank"><i class="gp rounded-md fa fa-google-plus"></i></a></li>
                            <li><a href="<?=$de_youtube?>" target="_blank"><i class="yt rounded-md fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <!-- End About -->

                    <!-- Simple List -->
                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">เมนูลัด</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><a href="<?=base_url()?>shop/account">เมนูสมาชิก</a></li>
                                    <li><a href="<?=base_url()?>shop/howtobuy">การสั่งซื้อ</a></li>
                                    <li><a href="<?=base_url()?>shop/account/now_order">แจ้งชำระเงิน</a></li>
                                    <li><a href="<?=base_url()?>shop/howtopay">ช่องทางชำระเงิน </a></li>
                                    <li><a href="<?=base_url()?>shop/howship">การจัดส่งสินค้า</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">บริการลูกค้า</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><a href="<?=base_url()?>shop/contact">ติดต่อเรา</a></li>
                                    <li><a href="<?=base_url()?>shop/about">เกี่ยวกับ</a></li>
                                    <li><a href="#">แผนผังเว็บไซต์</a></li>
                                    <li><a href="<?=base_url()?>shop/qa">คำถามที่พบบ่อย </a></li>
                                     <li><a href="<?=base_url()?>shop/suggest">แนะนำการขาย </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Simple List -->

                </div><!--/end row-->
            </div><!--/end continer-->
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            2015 &copy; Dealer. ALL Rights Reserved.
                            <a target="_blank" href="#">MazzSoft</a>
                        </p>
                    </div>
                    <!--
                    <div class="col-md-6">
                        <ul class="list-inline sponsors-icons pull-right">
                            <li><i class="fa fa-cc-paypal"></i></li>
                            <li><i class="fa fa-cc-visa"></i></li>
                            <li><i class="fa fa-cc-mastercard"></i></li>
                            <li><i class="fa fa-cc-discover"></i></li>
                        </ul>
                    </div>
                    -->
                </div>
            </div>
        </div><!--/copyright-->
    </div>
    <!--=== End Footer v4 ===-->
</div><!--/wrapper-->
<!-- JS JQuery -->

<script type="text/javascript" src="<?=base_url()?>mats/js/filterJq.js"></script>
<script type="text/javascript" src="<?=base_url()?>mats/js/pageJq.js"></script>
<script type="text/javascript" src="<?=base_url()?>mats/js/navJq.js"></script>
<script type="text/javascript" src="<?=base_url()?>mats/js/buyJq.js"></script>
<script type="text/javascript" src="<?=base_url()?>mats/js/orderJq.js"></script>
<!--<script type="text/javascript" src="<?=base_url()?>mats/js/searchJq.js"></script>-->

<!-- JS Global Compulsory -->
<script src="<?=base_url()?>mats/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>mats/plugins/jquery/jquery-migrate.min.js"></script>
<script src="<?=base_url()?>mats/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="<?=base_url()?>mats/plugins/back-to-top.js"></script>
<script src="<?=base_url()?>mats/plugins/smoothScroll.js"></script>
<script src="<?=base_url()?>mats/plugins/jquery.parallax.js"></script>
<script src="<?=base_url()?>mats/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="<?=base_url()?>mats/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?=base_url()?>mats/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?=base_url()?>mats/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- JS Customization -->
<script src="<?=base_url()?>mats/js/custom.js"></script>
<!-- JS Page Level -->
<script src="<?=base_url()?>mats/js/shop.app.js"></script>
<script src="<?=base_url()?>mats/js/plugins/owl-carousel.js"></script>
<script src="<?=base_url()?>mats/js/plugins/revolution-slider.js"></script>
<script src="<?=base_url()?>mats/js/plugins/stepWizard.js"></script>

<script>
    jQuery(document).ready(function() {
        App.init();
        App.initScrollBar();
        App.initParallaxBg();
        OwlCarousel.initOwlCarousel();
        RevolutionSlider.initRSfullWidth();

    });
</script>

<script>
function subtractQty() {
    var x=document.getElementById("qty").value;
    if (x > 1) {
      document.getElementById("qty").value--;
    }
}
</script>

<!--[if lt IE 9]>
    <script src="<?=base_url()?>mats/plugins/respond.js"></script>
    <script src="<?=base_url()?>mats/plugins/html5shiv.js"></script>
    <script src="<?=base_url()?>mats/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->



</body>
</html>
