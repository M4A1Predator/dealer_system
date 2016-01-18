<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
    <!--=== Header v5 ===-->   
    <?php include 'inc/nav.php' ?>
    <!--=== End Header v5 ===-->

    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">เข้าสู่ระบบ</span>
            <h1>Dealer <span class="shop-green">System</span></h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="index.html">Home</a></li>
                <li class="active">Reset password</li>
            </ul>
        </div><!--/end container-->
    </div> 
    <!--=== End Breadcrumbs v4 ===-->

    <!--=== Login ===-->
    <div class="log-reg-v3 content-md">
        <div class="container">
            <div class="row">
                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title">ระบบสั่งซื้อสินค้าสำหรับตัวแทนจำหน่าย</h2>
                    <p>การเป็นตัวแทนจำหน่ายไม่ใช่เรื่องยากอีกต่อไปกับระบบสั่งซื้อสินค้าของเรา สั่งซื้อผ่านระบบขั้นตอนง่าย ราคาถูก ราคาชัดเจน สามารถติดตามสถาการจัดส่งสินค้าและระบบจะจัดเก็บข้อมูลการสั่งซื้อย้อนหลังไว้ให้</p><br>
                    <div class="info-block-v2">
                        <i class="icon icon-layers"></i>
                        <div class="info-block-in">
                            <h3>สั่งซื้อง่าย จ่ายสะดวก</h3>
                            <p>สั่งซื้อง่าย ไม่กี่ขั้นตอนก็เสร็จแล้ว ไม่ต้องงง ไม่ต้องลืม เข้ามาเช็คในเว็บได้ตลอด</p>
                        </div>    
                    </div>    
                    <div class="info-block-v2">
                        <i class="icon icon-settings"></i>
                        <div class="info-block-in">
                            <h3>แสดงราคาส่วนลดชัดเจน</h3>
                            <p>ระบบแสดงราคาสินค้าราคาเต็ม ราคาส่วนลดสำหรับตัวแทนชัดเจน ได้สินค้ากำไรสูง</p>
                        </div>    
                    </div>
                </div>

                <div class="col-md-5">
                    <form action="<?=base_url()?>shop/set_new_password" method="post" id="resetForm" class="log-reg-block sky-form">
                        <input type="hidden" name="tok" value="<?=$tok?>">
                        <input type="hidden" name="did" value="<?=$dealer['dealer_id']?>">
                        <h2>ตั้งรหัสสผ่านใหม่</h2>
                        <a style="font-size:16px;padding-bottom:10px;">กรุณากรอกรหัสผ่านใหม่ของคุณ</a><br><br>
                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?=$dealer['dealer_username']?>" name="username" class="form-control" disabled>
                                </div>
                            </label>
                        </section>
                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" id="password" placeholder="กรอกรหัสผ่านใหม่" name="password" class="form-control">
                                </div>
                            </label>
                        </section>  
                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" id="passwordConfirm" placeholder="ยืนยันรหัสผ่านใหม่อีกครั้ง" name="passwordConfirm" class="form-control">
                                </div>
                            </label>
                        </section>  
                        
                        <input type="button" id="submitBtn" value="เปลี่ยนรหัสผ่าน" class="btn-u btn-u-sea-shop btn-block margin-bottom-20 text-center" >
                        <span class="inv-form" id="msg"></span>
                    </form>

                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <script type="text/javascript" src="<?=base_url()?>mats/js/forms/resetJq.js"></script>
    <!--=== End Login ===-->     

    <?php include 'inc/footer.php' ?>