
<?php include 'include/head.php';?>

<body class="nav-md">
	<style>
		.he{
			color: red;
		}
	</style>
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
            <div class="right_col" role="main">

                <!-- top tiles -->
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>แก้ไขตัวแทนจำหน่าย</h3>
                        </div>

                        <div class="title_right">

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form action="<?=base_url()?>admin/edit_dealer" method="post" enctype="multipart/form-data" novalidate="" class="form-horizontal form-label-left">
								<input type="hidden" name="did" value="<?=$dealer->dealer_id?>" >
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">username<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_username?>" type="text" id="username" disabled name="username" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgusername"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">password<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input placeholder="เว้นว่างไว้หากไม่ต้องการเปลี่ยน" type="password" id="password" name="password" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
										<ul class="parsley-errors-list" id="msgpassword"></ul>
                                    </div>
                                </div>
								
								<div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ระดับตัวแทน<span class="required">*</span>
                                  </label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="radio">
											<?php foreach($levels as $lv){ ?>
											<label>
												<input type="radio" value="<?=$lv['level_id']?>" <?= $dealer->dealer_level_id==$lv['level_id']?'checked':'' ?> id="optionsRadios1" name="level"> <?=$lv['level_name']?>
											</label>
											<?php } ?>
										</div>
									</div>
                                </div>
								
								
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อ-นามสกุล<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input value="<?=$dealer->dealer_fullname?>" type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
									<ul class="parsley-errors-list" id="msgname"></ul>
                                  </div>
                                </div>
                                <!--text area-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">ที่อยู่<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="address" name="address" class="form-control" required="required" style="width: 100%;height: 100px;" ><?=$dealer->dealer_address?></textarea>
									<span class="he" id="msgaddress"></span>
                                  </div>
                                </div>
                                <!--text area-->
                                <!--upload-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile">ภาพประจำตัว<span class="required">*</span>
                                  </label>
								  
                                  <div class="col-md-6 col-sm-6 col-xs-12">
									<img alt="" src="<?=base_url().$dealer->dealer_picture?>" style="height: 120px; width: auto;">
									<br><br>
                                    <input id="profile" name="profile" class="input-file" type="file" accept="image/*" multiple="multiple">
									<span class="he" id="msgprofile"></span>
                                  </div>
                                </div>
                                <!-- upload-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">อีเมล์<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_email?>" type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
										<ul class="parsley-errors-list" id="msgemail"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">เบอร์โทรศัพท์<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_tel?>" type="text" id="phone" name="phone" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgphone"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="line">ไลน์ไอดี<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_line?>" type="text" id="line" name="line" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgline"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shopname">ชื่อร้าน<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_shopname?>" type="text" id="shopname" name="shopname" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgshopname"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">ลิงค์เวปไซต์<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_website?>" type="text" id="website" name="website" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="parsley-id-1135"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fanpage">ลิงค์แฟนเพจ<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_fanpage?>" type="text" id="fanpage" name="fanpage" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="parsley-id-1135"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">ลิงค์ Facebook<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input value="<?=$dealer->dealer_facebook?>" type="text" id="facebook" name="facebook" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135"><ul class="parsley-errors-list" id="parsley-id-1135"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="other">อื่นๆ<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <textarea id="other" name="other" class="form-control" style="width: 100%;height: 100px;" ><?=$dealer->dealer_detail?></textarea>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="row btnRow text-center">
									<button id="submitBtn" type="submit" class="btn btn-success"><i class="fa fa-save m-right-xs"></i> บันทึกการแก้ไขข้อมูล</button>
								</div>

                            </form>
                                  <div class="row text-center">

                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<script type="text/javascript" src="<?=base_url()?>assets/angjq/editDealerJq.js"></script>
				<script type="text/javascript" src="<?=base_url()?>assets/angjq/formFunction.js"></script>

                <!-- /top tiles -->
                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
