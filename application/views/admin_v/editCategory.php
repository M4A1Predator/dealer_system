
<?php include 'include/head.php';?>

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
                          <h3>
							แก้ไขหมวดหมู่
                          </h3>
                        </div>

                        <div class="title_right">
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">

                                  <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                              <button type="button" class="btn btn-dark btn-lg" style="width:100%">หมวดหมู่ทั้งหมด <i class="fa fa-list"></i></button>
                                  </div>
                                    <div class="clearfix"></div>


                                </div>
                                <div class="x_content">

                                    <div class="row">
										<form action="<?=base_url()?>admin/edit_category" method="post" data-parsley-validate="" class="form-horizontal form-label-left">
											<input type="hidden" name="catId" value="<?=$cat->category_id?>">
											<div class="form-group">
											  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อหมวดหมู่ <span class="required">*</span>
											  </label>
											  <div class="col-md-6 col-sm-6 col-xs-12">
												  <input value="<?=$cat->category_name?>" type="text" name="catName" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="4565">
												  <ul class="parsley-errors-list" id="parsley-id-4565"><?=$this->session->flashdata('msg')?></ul>
											  </div>
											</div>
											<div class="ln_solid"></div>
											<div class="form-group">
											  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
												  <button type="submit" class="btn btn-success">บันทึกการแก้ไข</button>
												  <a href="#" onclick="javascript:;window.history.back()"><button type="submit" class="btn btn-danger">ยกเลิก</button></a>
											  </div>
											</div>

										</form>
                                    </div>

                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- /top tiles -->
                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
