
<?php include 'include/head.php';?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
            <div class="right_col" role="main">
                            <div class="">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>
                                          รายละเอียดการแจ้งชำระเงิน
                                        </h3>
                                    </div>

                                   
                                </div>
                                <div class="clearfix"></div>


                                <div class="row">


                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_content">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="bs-example" data-example-id="simple-jumbotron">
														<div class="jumbotron">
															<h3>ORDER #<?=$payment['payment_order_id']?></h3>
															<p>บัญชีที่โอนเงิน: <strong><?=$payment['bank_name']?></strong></p>
															<p>วันที่ชำระเงิน: <strong><?=$payment['payment_date']?></strong></p>
															<p>เวลา(โดยประมาณ): <strong><?=$payment['payment_time']?></strong></p>
															<p>จำนวนเงิน : <strong><?=$payment['payment_amount']?></strong></p>
															<input type="hidden" name="oid" value="<?=$payment['payment_order_id']?>" >
															<input type="hidden" name="nextPm" value="<?=$previous?>">
															<?php if($order['order_order_status_id'] < 3){ ?>
															<a class="btn btn-success" href="#" onclick="editPayment(1)"><i class="fa fa-check m-right-xs"></i> ยืนยันรายการ</a>
															<a class="btn btn-danger" href="#" onclick="removePayment(<?=$payment['payment_id']?>)"><i class="fa fa-trash m-right-xs"></i> ลบรายการ</a>
															<?php } ?>
														</div>
													</div>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div class="bs-example" data-example-id="simple-jumbotron">
														<div class="jumbotron">
															<h3>หลักฐานการโอนเงิน</h3>
																<a href="<?=base_url().$payment['payment_img']?>" target="_blank">
															<img src="<?=base_url().$payment['payment_img']?>" class="img-responsive">
															</a>
														</div>
													</div>
												</div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
							<script type="text/javascript" src="<?=base_url()?>assets/angjq/editPaymentJq.js"></script>

                            <!-- footer content -->
                            <?php include 'include/footer-text.php';?>
                            <!-- /footer content -->

                        </div><!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
