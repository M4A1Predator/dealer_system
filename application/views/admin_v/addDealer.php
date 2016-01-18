
<?php include 'include/head.php';?>
<style>
	.he{
		color: red;
	}
</style>
<body class="nav-md">
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
                            <h3>เพิ่มตัวแทนจำหน่าย</h3>
                        </div>

                        <div class="title_right">

                        </div>
                    </div>
                    <div class="clearfix"></div><span><?=$this->session->flashdata('msg')?></span>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form novalidate="" action="<?=base_url()?>admin/add_new_dealer" method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">username<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="username" value="<?=$this->session->flashdata('username')?>" pattern=".{4,32}" title="ความยาว 4 ถึง 32 ตัวอักษร" name="username" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgusername"><?=$this->session->flashdata('msgusername')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">password<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="password" name="password" required="required" pattern="[\S]{8,32}" title="ความยาว 8 ถึง 32 ตัวอักษร" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
										<ul class="parsley-errors-list" id="msgpassword"><?=$this->session->flashdata('msgpassword')?></ul>
                                    </div>
                                </div>
								<div class="form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ระดับตัวแทน<span class="required">*</span>
									</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="radio">
											<?php foreach($levels as $lv){ ?>
											<label>
												<input type="radio" value="<?=$lv['level_id']?>" id="optionsRadios1" name="level" <?=$lv['level_id']==0?'checked=""':''?>> <?=$lv['level_name']?>
											</label>
											<?php } ?>
                                        </div>
									</div>
                                </div>
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">ชื่อ-นามสกุล<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="name" value="<?=$this->session->flashdata('name')?>" name="name" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
									<ul class="parsley-errors-list" id="msgname"><?=$this->session->flashdata('msgname')?></ul>
                                  </div>
                                </div>
                                <!--text area-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address">ที่อยู่<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="address" name="address" class="form-control" required="required" style="width: 100%;height: 100px;" ><?=$this->session->flashdata('address')?></textarea>
                                  </div>
                                </div>
                                <!--text area-->
                                <!--upload-->
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile">ภาพประจำตัว<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="profile" name="profile" class="input-file" type="file" accept="image/*" multiple="multiple">
									<span class="he" id="msgprofile"><?=$this->session->flashdata('msgprofile')?></span>
                                  </div>
                                </div>
                                <!-- upload-->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">อีเมล์<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email" value="<?=$this->session->flashdata('email')?>" name="email" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
										<ul class="parsley-errors-list" id="msgemail"><?=$this->session->flashdata('msgemail')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">เบอร์โทรศัพท์<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="phone" value="<?=$this->session->flashdata('phone')?>" name="phone" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgphone"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="line">ไลน์ไอดี<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="line" name="line" value="<?=$this->session->flashdata('line')?>" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgline"><?=$this->session->flashdata('msgline')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shopname">ชื่อร้าน<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="shopname" name="shopname" value="<?=$this->session->flashdata('shopname')?>" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgshopname"><?=$this->session->flashdata('msgshopname')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">ลิงค์เวปไซต์<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="website" name="website" value="<?=$this->session->flashdata('website')?>" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgwebsite"><?=$this->session->flashdata('msgwebsite')?></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fanpage">ลิงค์แฟนเพจ<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="fanpage" name="fanpage" value="<?=$this->session->flashdata('fanpage')?>" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgfanpage"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">ลิงค์ Facebook<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="facebook" name="facebook" value="<?=$this->session->flashdata('facebook')?>" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
										<ul class="parsley-errors-list" id="msgfacebook"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="other">อื่นๆ<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <textarea id="other" name="other" class="form-control" style="width: 100%;height: 100px;" ></textarea>
									  <span id="msgother" class="he"></span>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" id="submitBtn" class="btn btn-success">เพิ่มตัวแทน</button>
                                    </div>
                                </div>

                            </form>
                                  <div class="row text-center">

                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<script type="text/javascript" src="<?=base_url()?>assets/angjq/addDealerJq.js"></script>
                <!-- /top tiles -->
                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
