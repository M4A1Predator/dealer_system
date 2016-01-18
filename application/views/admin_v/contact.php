
<?php include 'include/head.php';?>

<body class="nav-md" ng-app="addProduct" ng-controller="addProductCtrl">
    <style>
        [ng\:cloak], [ng-cloak], [data-ng-cloak], [x-ng-cloak], .ng-cloak, .x-ng-cloak, .ng-hide {
        display: none !important;
        
        .he
        }
        .he{
            color: red;
        }
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
                            <h3>ข้อมูลร้านค้า</h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form id="productForm" action="<?=base_url()?>admin/add_new_product" method="POST" enctype="multipart/form-data" novalidate="" data-parsley-validate="" required class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <h3 class="">ข้อมูลการติดต่อ</h3><br/>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div id="contactNote"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h3 class="">เกี่ยวกับร้าน</h3><br/>
                                    <div class="col-md-10 col-sm-10 col-xs-12">
                                        <div id="aboutNote"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <input type="button" id="saveBtn" onclick="saveDetail()" data-toggle="modal" data-target="#saveModal" data-backdrop="static" class="btn btn-success" value="บันทึก">
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
                <?php include 'include/modals.php';?>
                <span id="nowContact" style="display: none;"><?=$contact?></span>
                <span id="nowAbout" style="display: none;"><?=$about?></span>
                <script>
                $(document).ready(function() {
                    $('#contactNote').summernote({
                        height: 300,
                    });
                    $('#contactNote').summernote('code', $('#nowContact').html());
                    
                    $('#aboutNote').summernote({
                        height: 300,
                    });
                    $('#aboutNote').summernote('code', $('#nowAbout').html());
                });    
                </script>

                <script type="text/javascript" src="<?=base_url()?>assets/angjq/editDetailJq.js"></script>
                
                <!-- /top tiles -->
                <!-- footer content -->

                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->
            </div>
            <!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
