<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
    <!--=== Header v5 ===-->
    <?php include 'inc/nav.php' ?>
    <!--=== End Header v5 ===-->

    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">แจ้งชำระเงิน</span>
            <h1>Dealer <span class="shop-green">System</span></h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="index.html">Home</a></li>
                <li class="active">Payment</li>
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
                    <div class="row margin-bottom-50 hidden-sm hidden-xs">
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>500</span>
                                <small>รายการ</small>
                            </div>
                        </div>
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>235</span>
                                <small>คน</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="site-statistics">
                                <span>376</span>
                                <small>รีวิว</small>
                            </div>
                        </div>
                    </div>
                    <div class="members-number hidden-sm hidden-xs">
                        <h3>รวยไปด้วยกันกับเรา <span class="shop-green">กับสินค้าราคาส่งถูกที่สุด</span> สร้างกำไรได้มหาศาล</h3>
                        <img class="img-responsive" src="assets/img/map.png" alt="">
                    </div>

                </div>

                <div class="col-md-5">
                    <form id="sky-form4" class="log-reg-block sky-form">
                        <h2>สมัครตัวแทนจำหน่ายสินค้า</h2>

                        <div class="login-input reg-input">

                            <section>
                                <label class="input">
                                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="password" name="password" placeholder="Password" id="password" class="form-control" required>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="password" name="passwordConfirm" placeholder="Confirm password" class="form-control" required>
                                </label>
                            </section>
                            <section>
                            <label class="label">รูปถ่าย</label>
                            <label for="file" class="input input-file">
                                <div class="button"><input name="photo" type="file" id="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" readonly="">
                            </label>
                            </section>
                            <div class="row">
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" name="firstname" placeholder="ชื่อ" class="form-control" required>
                                        </label>
                                    </section>
                                </div>
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" name="lastname" placeholder="นามสกุล" class="form-control" required>
                                        </label>
                                    </section>
                                </div>
                            </div>
                            <section>
                                <label class="input">
                                    <textarea name="location" rows="3" class="form-control" placeholder="ที่อยู่" required></textarea>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="email" name="email" placeholder="อีเมล์" class="form-control" required>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="tel" placeholder="เบอร์โทรศัพท์" class="form-control" required>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="line" placeholder="ไลน์ไอดี" class="form-control" required>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="facebook" placeholder="เฟสบุ๊คส่วนตัว (ถ้ามี)" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="shopname" placeholder="ชื่อนร้าน" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="website" placeholder="เว็บไซต์ของคุณ(ถ้ามี)" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" name="fanpage" placeholder="แฟนเพจของคุณ (ถ้ามี)" class="form-control">
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <textarea name="detail" rows="3" class="form-control" placeholder="รายละเอียดอื่นๆ (ถ้ามี)"  ></textarea>
                                </label>
                            </section>


                        </div>

                        <label class="checkbox margin-bottom-10">
                            <input type="checkbox" name="checkbox"/>
                            <i></i>
                            ยอมรับเงื่อนไงการเป็นตัวแทนจำหน่าย
                        </label>
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">สมัครตัวแทน</button>
                    </form>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Login ===-->

    <?php include 'inc/footer.php' ?>
