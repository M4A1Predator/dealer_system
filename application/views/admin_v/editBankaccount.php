
<?php include 'include/head.php';?>

<body class="nav-md" ng-app="addProduct" ng-controller="addProductCtrl">
    <style>

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
                            <h3>แก้ไขบัญชีธนาคาร</h3>
                        </div>

                        <div class="title_right">
                            
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">

                              <form id="productForm" action="<?=base_url()?>admin/bank/edit_bank" method="POST" data-parsley-validate="" required class="form-horizontal form-label-left">
                                <input type="hidden" name="bid" value="<?=$bank['bank_id']?>">
                                <div class="form-group">
                                    <label class="control-label col-md-2">ธนาคาร<span class="required">*</span>
                                    </label>
                                    <div class="col-sm-3">
                                        <select id="bankName" name="bankName" required="" class="form-control">
                                            <option value="<?=$bank_name?>" checked="">ธนาคาร<?=$bank['bank_name']?></option>
                                            <option value="BANGKOK-กรุงเทพ">ธนาคารกรุงเทพ</option>
                                            <option value="KTB-กรุงไทย">ธนาคารกรุงไทย</option>
                                            <option value="AYUT-กรุงศรีอยุธยา">ธนาคารกรุงศรีอยุธยา</option>
                                            <option value="KBANK-กสิกรไทย">ธนาคารกสิกรไทย</option>
                                            <option value="CIMB-ซีไอเอ็มบีไทย">ธนาคารซีไอเอ็มบีไทย</option>
                                            <option value="TMB-ทหารไทย">ธนาคารทหารไทย</option>
                                            <option value="SCB-ไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                                            <option value="THANACHAT-ธนชาต">ธนาคารธนชาต</option>
                                            <option value="UOB-ยูโอบี">ธนาคารยูโอบี</option>                        
                                            <option value="AOM-ออมสิน">ธนาคารออมสิน</option>
                                            <option value="ISALAM-อิสลามแห่งประเทศไทย">ธนาคารอิสลามแห่งประเทศไทย</option>
                                        </select>
                                        <ul class="parsley-errors-list" id="msgbankname"></ul>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">เลขบัญชี<span class="required">*</span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?=$bank['bank_number']?>" name="accountNum" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">ชื่อบัญชี<span class="required">*</span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?=$bank['bank_accountname']?>" name="accountName" required="required" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">สาขา<span class="required"></span>
                                    </label>
                                    <div class="col-sm-3">
                                        <input type="text" value="<?=$bank['bank_branch']?>" name="branch" class="form-control col-md-7 col-xs-12" data-parsley-id="1135">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-3 col-sm-offset-2">
                                        <div><span style="color: red;" id="msg"><?=$this->session->flashdata('msg')?></span></div>
                                        <input type="submit" onclick="" class="btn btn-success" value="บันทึก">
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
