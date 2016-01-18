
<?php include 'include/head.php';?>

<body class="nav-md" ng-app="addProduct" ng-controller="addProductCtrl">
    <style>

    </style>
    
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>
                    
                    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
                    
                    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery"></script> 
                    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> -->
                    <link href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
                    
                    <!-- include summernote css/js-->
                    <link href="<?=base_url()?>assets/css/summernote.css" rel="stylesheet">
                    <script src="<?=base_url()?>assets/js/summernote.min.js"></script>

            <!-- page content -->
            <div class="right_col" role="main" >

                <!-- top tiles -->
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>ข้อมูลการติดต่อ</h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form id="productForm" action="<?=base_url()?>admin/detail/edit_detail" method="POST" data-parsley-validate="" required class="form-horizontal form-label-left">
                                <input type="hidden" name="type" value="address">
                                <div class="form-group">
                                    <label class="control-label col-md-2">ที่อยู่<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$address?>" name="address" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">เบอร์โทรศัพท์มือถือ<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?=$mobile?>" name="mobile" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">เบอร์โทรสำนักงาน<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?=$tel?>" name="tel" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">email<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="email" value="<?=$email?>" name="email" required="" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ลิงค์ facebook<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$facebook?>" name="facebook"  class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ลิงค์ twitter<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$twitter?>" name="twitter" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ลิงค์ Google+<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  value="<?=$google?>" name="google"class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ลิงค์ Youtube<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$youtube?>" name="youtube"  class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                        <ul class="parsley-errors-list" id="msgcode"></ul>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ข้อความ<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="store"  class="form-control col-md-7 col-xs-12"><?=$store?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="submit" id="saveBtn" onclick="" class="btn btn-success" value="บันทึก">
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
                
                <!-- /top tiles -->
                <!-- footer content -->

                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
