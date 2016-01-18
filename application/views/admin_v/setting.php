
<?php include 'include/head.php';?>

<body class="nav-md" ng-app="addProduct" ng-controller="addProductCtrl">
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
            <div class="right_col" role="main" >

                <!-- top tiles -->
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Setting</h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form id="editAdminForm" action="<?=base_url()?>admin/edit_admin" method="POST" novalidate="" data-parsley-validate="" class="form-horizontal form-label-left">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productId">admin username<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?=$admin['admin_username']?>" name="adminName" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">รหัสผ่านใหม่<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="password" id="newPassword" value="" name="newPassword" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >ยืนยัน รหัสผ่านใหม่<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="password" id="newPasswordConfirm" value="" name="newPasswordConfirm" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productName">รหัสผ่านปัจจุบัน<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="password" id="password" value="" name="password" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="6499">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <div><span class="he" id="msg"><?=$this->session->flashdata('msg')?></span></div>
                                        <input type="button" id="saveBtn" onclick="checkEditForm()" class="btn btn-success" value="บันทึก">
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
                <script type="text/javascript" src="<?=base_url()?>assets/angjq/editAdminJq.js"></script>
                
                <!-- /top tiles -->
                <!-- footer content -->

                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
