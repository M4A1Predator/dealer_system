<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
    <!--=== Header v5 ===-->
    <?php include 'inc/nav.php' ?>
    <!--=== End Header v5 ===-->

    <!--=== Breadcrumbs v4 ===-->
    <?php date_default_timezone_set("Asia/Bangkok"); ?>
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">แจ้งชำระเงิน</span>
            <h1>Dealer <span class="shop-green">System</span></h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="<?=base_url()?>">Home</a></li>
                <li class="active">Payment</li>
            </ul>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
    

    <!--=== Login ===-->
    <div class="log-reg-v3 content-md">
        <div class="container">
            <div class="row">
                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title">แจ้งชำระเงินค่าสินค้า</h2>
                    <p>ท่านสามารถเลือกช่องทางการชำระเงินที่สะดวกได้เลยคะ โอนเงินแล้วอย่าลืมเก็บหลักฐานการชำระเงินไว้ด้วยนะคะ
                    แล้วก็อย่าลืมมาแจ้งชำระเงินผ่านแบบฟอร์มด้านขวามือนะคะ กรอกข้อมูลให้ถูกต้อง ครบถ้วน แล้วสินค้าจะส่งถึงท่านอย่างไวที่สุด</p><br>
                    <?php foreach($banks as $b){ ?>
                    <div class="col-sm-6">
                        <div class="info-block-v2">
                            <i class="icon"><img src="<?=base_url()."images/banks/BANK-J-".$b['bank_picture'].'.jpg'?>" style="widows: 120px; height: 100px"></i>
                            <div class="info-block-in">
                                <h3>ธนาคาร<?=$b['bank_name']?></h3>
                                <p><strong>เลขบัญชี:</strong> <?=$b['bank_number']?></p>
                                <p><strong>ชื่อบัญชี:</strong><?=$b['bank_accountname']?></p>
                                <p><strong>สาขา:</strong> <?=$b['bank_branch']?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="clearfix hidden-md hidden-lg"></div>
                <div class="col-md-5">
                    <form action="<?=base_url()?>shop/payment/report" method="post" enctype="multipart/form-data" id="sky-form1" class="log-reg-block sky-form">
                        <h2>ใบสั่งซื้อเลขที่ #<?=$order['order_id']?></h2>
                        <H3>ราคา <?=display_money($order['order_price'])?> บาท</h3><hr>
                        <input type="hidden" value="<?=$order['order_id']?>" name="oid">
                        <section>
                            <label class="label">ธนาคารที่โอนเงินเข้ามา</label>
                            <label class="select">
                                <select name="bank" required>
                                    <option value="">เลือกธนาคารที่โอนเงินเข้ามา</option>
                                    <?php foreach($banks as $b){ ?>
                                    <option value="<?=$b['bank_id']?>"><?=$b['bank_name']?> ( ชื่อบัญชี<?=$b['bank_accountname']?>)</option>
                                    <?php } ?>
                                    <!--
                                    <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย ( ชื่อบัญชี กนกพร สวยเสมอ)</option>
                                    <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์ ( ชื่อบัญชี กนกพร สวยเสมอ)</option>
                                    <option value="ธนากรุงเทพ">ธนากรุงเทพ ( ชื่อบัญชี กนกพร สวยเสมอ)</option>
                                    -->
                                </select>
                                <i></i>
                            </label>
                        </section>
                        <section>
                            <label for="exampleInputEmail1">จำนวนเงินที่โอน</label>
                            <div class="input-group">
                                    <input type="text" id="paymentAmount" name="amount" class="form-control" placeholder="เช่น 1900.50" required="กรุณาใส่จำนวนเงิน" pattern="^[0-9]+(\.\d+)*" title='กรุณากรอกเป็นตัวเลข เช่น 1900.50'>
                                    <span class="input-group-addon">฿</span>
                             </div>
                        </section>
                        <section>
                            <label for="exampleInputEmail1">เวลาที่โอน</label>
                            <div class="input-group">
                                    <input type="text" name="time" class="form-control" placeholder="เช่น 16.35" required="" pattern="^[0-9]+(\.\d+)*" title='กรุณากรอกเวลา เช่น 16.50'>
                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                             </div>
                        </section>
                        
                        <section>
                            <label class="label">วันที่โอนเงิน</label>
                                <div class="row">
                            <section class="col col-4">
                                <label class="select">
                                <select name="date" required="">
                                    <option value="">วันที่</option>
                                    <?php
                                        for($i=1;$i<=31;$i++){
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    ?>
                                </select>
                                <i></i>
                            </label>
                            </section>
                            <section class="col col-4">
                                <label class="select">
                                    <select name="month" required="">
                                    <option value="">เดือน</option>
                                    <option value='01'>มกราคม</option>
                                    <option value='02'>กุมภาพันธ์</option>
                                    <option value='03'>มีนาคม</option>
                                    <option value='04'>เมษายน</option>
                                    <option value='05'>พฤษภาคม</option>
                                    <option value='06'>มิถุนายน</option>
                                    <option value='07'>กรกฎาคม</option>
                                    <option value='08'>สิงหาคม</option>
                                    <option value='09'>กันยายน</option>
                                    <option value='10'>ตุลาคม</option>
                                    <option value='11'>พฤศจิกายน</option>
                                    <option value='12'>ธันวาคม</option>
                                </select>
                                <i></i>
                                </label>
                            </section>
                            <section class="col col-4" >
                                <label class="select">
                                <select name="year" required="">
                                    <option value="<?php echo date("Y")+544; ?>"><?php echo date("Y")+545; ?></option>
                                    <option value="<?php echo date("Y")+544; ?>" selected=""><?php echo date("Y")+544; ?></option>
                                    <option value="<?php echo date("Y")+543; ?>"><?php echo date("Y")+543; ?></option>
                                    <option value="<?php echo date("Y")+542; ?>"><?php echo date("Y")+542; ?></option>
                                </select>
                                <i></i>
                                </label>
                            </section>
                        </div>
                            </label>
                        </section>
                                    
                        <!--<section>
                            <label class="label">วันที่โอนเงิน</label>
                            <label class="input" style="width: 50%;">
                                <input type="date" id="transDate" name="transDate" placeholder="เดือน/วัน/ปี" required>
                                <label class="label" style="font-weight: bold;">เช่น 09/20/2016</label>
                            </label>
                            
                        </section>-->
                        <section>
                            <label class="label">หลักฐานการโอนเงิน</label>
                            <label for="file" class="input input-file">
                                <div class="button"><input type="file" id="file" name="pic" accept="image/*" required onchange="this.parentNode.nextSibling.value = this.value">เลือกไฟล์</div><input type="text" readonly="">
                            </label>
                        </section>
                        <div class="margin-bottom-20" style="color: red;"><?=$this->session->flashdata('msg')?></div>
                        <button class="btn-u btn-u btn-block margin-bottom-20" style="text-align:center;" type="submit">แจ้งชำระเงิน</button>
                    </form>
                    <div class="margin-bottom-20"></div>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Login ===-->
    <script>
        $(document).ready(function (){
            amount = $('#paymentAmount');
            amount.on('blur focusout focusin change', function(){
                av = amount.val().replace(',', '');
                amount.val(av);
            });
            
        })
    </script>

    <?php include 'inc/footer.php' ?>
