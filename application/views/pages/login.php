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
                <li><a href="<?=base_url()?>shop/">Home</a></li>
                <li class="active">Log In</li>
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
                    <form action="<?=base_url()?>shop/go_login" method="post" id="sky-form1" class="log-reg-block sky-form">
                        <h2>เข้าสู่ระบบตัวแทนจำหน่าย</h2>
                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" value="<?=$this->session->flashdata('username')?>" placeholder="Username" name="username" required class="form-control">
                                </div>
                            </label>
                        </section>        
                        <section>
                            <label class="input login-input no-border-top">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="Password" name="password" required class="form-control">
                                </div>    
                            </label>
                        </section>
                        <section>
                        <div class="row margin-bottom-5">
                            <div class="col-xs-6">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember"/>
                                    <i></i>
                                    จำฉันไว้ในระบบ
                                </label>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="<?=base_url()?>shop/forgot_password">ลืมรหัสผ่าน?</a>
                            </div>
                        </div>
                        </section>
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">เข้าสู่ระบบ</button>
                        <span style="color: red;"><?=$this->session->flashdata('msg')?></span>
                        <span style="color: green;"><?=$this->session->flashdata('sucmsg')?></span>
                    </form>
                    
                    <div class="margin-bottom-20"></div>
                    <p class="text-center">สมัครตัวแทนจำหน่าย <a href="<?=base_url()?>shop/regis">คลิกที่นี่</a></p>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Login ===-->     

    <?php include 'inc/footer.php' ?>