<?php include 'inc/head.php' ?>

<body class="header-fixed">
<div class="wrapper">
        
         <?php include 'inc/nav.php' ?>
         <?php include 'inc/search.php' ?>

    <?php
         $f_space = strpos($dealer['dealer_fullname'], ' ')!=-1?strpos($dealer['dealer_fullname'], ' '):strlen($dealer['dealer_fullname']);
         $name = substr($dealer['dealer_fullname'], 0, $f_space);
         if($f_space != -1){
                  $sname = substr($dealer['dealer_fullname'], strripos($dealer['dealer_fullname'], ' ')+1);
         }else{
                  $sname = '';
         }
         
    ?> 
    <!--=== Profile Content ===-->
    <div class="container content profile">
        <div class="row">
            <!--Left Sidebar-->
            <?php include 'inc/accountbar.php' ?>
            <!--End Left Sidebar-->

            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="profile-body">
                  <!--Service Block v3-->
                    <!--Table Search v1-->
                    <div class="table-search-v1 margin-bottom-20">
                   <div class="profile-bio">     
                <div class="row" style="padding:40px;">
                  
                    <form action="<?=base_url()?>shop/account/edit_profile" method="post" id="editForm" enctype="multipart/form-data" novalidate="" class="log-reg-block sky-form">
                        <h2>แก้ไขข้อมูลส่วนตัว</h2>
                        <input type="hidden" id="nowEmail" value="<?=$dealer['dealer_email']?>">
                        <div class="login-input reg-input">
                            <section>
                                <label class="input">
                                    <input disabled="" type="text" id="username" name="username" placeholder="ชื่อผู้ใช้งาน" class="form-control" value="<?=$dealer['dealer_username']?>" required>
                                </label>
                            </section> 
                            <section>
                                <label class="input">
                                    <input type="password" id="password" name="password" placeholder="รหัสผ่านเก่า" id="password" class="form-control" required>
                                </label>
                            </section>                            
                            <section>
                                <label class="input">
                                    <input type="password" id="newPwd" name="newPwd" placeholder="รหัสผ่านใหม่" id="password" class="form-control" required>
                                </label>
                            </section> 
                            <section>
                                <label class="input">
                                    <input type="password" id="newPwdConfirm" name="newPwdConfirm" placeholder="ยืนยันรหัสผ่านใหม่" class="form-control" required>
                                </label>
                            </section>  
                            <section>
                            <label class="label">เลือกรูปถ่าย (เว้นว่างไว้หากไม่ต้องการเปลี่ยน)</label>
                            <label for="file" class="input input-file">
                                <div class="button"><input name="photo" type="file" id="photo" onchange="this.parentNode.nextSibling.value = this.value" accept="image/*">Browse</div><input type="text" readonly="">
                            </label>
                            </section> 
                            <div class="row">
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" id="firstname" name="firstname" placeholder="ชื่อ" value="<?=$name?>" class="form-control" required>
                                        </label>
                                    </section>
                                </div>
                                <div class="col-sm-6">
                                    <section>
                                        <label class="input">
                                            <input type="text" id="lastname" name="lastname" placeholder="นามสกุล" value="<?=$sname?>" class="form-control" required>
                                        </label>
                                    </section>        
                                </div>
                            </div>
                            <section>
                                <label class="input">
                                    <textarea name="address" id="address" rows="3" class="form-control" placeholder="ที่อยู่"required><?=$dealer['dealer_address']?></textarea>
                                </label>
                            </section>  
                            <section>
                                <label class="input">
                                    <input type="email" id="email" name="email" placeholder="อีเมล์" class="form-control" value="<?=$dealer['dealer_email']?>" required>
                                    <span class="inv-form" id="msgemail"></span>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" id="tel" name="tel" placeholder="เบอร์โทรศัพท์" class="form-control" value="<?=$dealer['dealer_tel']?>" required>
                                </label>
                            </section>  
                            <section>
                                <label class="input">
                                    <input type="text" id="line" name="line" placeholder="ไลน์ไอดี" class="form-control" value="<?=$dealer['dealer_line']?>" required>
                                </label>
                            </section>
                            <section>
                                <label class="input">
                                    <input type="text" id="facebook" name="facebook" placeholder="ลิงค์เฟสบุ๊คส่วนตัว (ถ้ามี)" value="<?=$dealer['dealer_facebook']?>" class="form-control">
                                </label>
                            </section>  
                            <section>
                                <label class="input">
                                    <input type="text" id="shopname" name="shopname" placeholder="ชื่อนร้าน" class="form-control" value="<?=$dealer['dealer_shopname']?>">
                                </label>
                            </section>  
                            <section>
                                <label class="input">
                                    <input type="text" id="website" name="website" placeholder="เว็บไซต์ของคุณ(ถ้ามี)" class="form-control" value="<?=$dealer['dealer_website']?>">
                                </label>
                            </section>  
                            <section>
                                <label class="input">
                                    <input type="text" id="fanpage" name="fanpage" placeholder="ลิงค์แฟนเพจของคุณ (ถ้ามี)" class="form-control" value="<?=$dealer['dealer_fanpage']?>">
                                </label>
                            </section>  
                            <section>
                                <label class="input">
                                    <textarea name="detail" rows="3" class="form-control" placeholder="รายละเอียดอื่นๆ (ถ้ามี)"  ><?=$dealer['dealer_detail']?></textarea>
                                </label>
                            </section>                    
                        </div>
                        <input id="submitBtn" class="btn-u btn-u-sea-shop margin-bottom-20" type="button" value="บัทึกการแก้ไข">
                        <span class="inv-form" id="msg"><?=$this->session->flashdata('msg')?></span>
                    </form>
                </div>
                </div>
                        </div>
                    </div>
                    <!--End Table Search v1-->
                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>
    <!--=== End Profile Content ===-->
    
         <script type="text/javascript" src="<?=base_url()?>mats/js/forms/editAccJq.js"></script>

    <?php include 'inc/footer.php' ?>