
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
                            เพิ่มแบรนด์สินค้า
                            <small>
                                Add Product Brand
                            </small>
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
                                              <a href="<?=base_url()?>admin/brand"><button type="button" class="btn btn-dark btn-lg" style="width:100%">แบรนด์สินค้าทั้งหมด <i class="fa fa-list"></i></button></a>
                                  </div>
                                    <div class="clearfix"></div>


                                </div>
                                <div class="x_content">

                                    <div class="row">
                                      <form method="POST" action="add_new_brand" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                                      <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อแบรนด์ <span class="required">*</span>
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                              <input type="text" name="brandName" id="first-name" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="4565"><ul class="parsley-errors-list" id="parsley-id-4565"></ul>
                                              <div><?=$this->session->flashdata('msg')?></div>
                                          </div>
                                      </div>
                                      <div class="ln_solid"></div>
                                      <div class="form-group">
                                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                              <button type="submit" class="btn btn-success">เพิ่มแบรนด์</button>
                                              <a href="<?=base_url()?>admin/brand"><input type="button" value="ยกเลิก" class="btn btn-danger"></a>
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
