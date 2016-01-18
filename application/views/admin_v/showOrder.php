
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
                                          รายการสั่งซื้อสินค้า #<?=$order['order_id']?>
                                        </h3>
                                    </div>

                                   
                                </div>
                                <div class="clearfix"></div>


                                <div class="row">


                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_content">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>รหัสสินค้า</th>
                                                            <th>ชื่อสินค้า</th>
                                                            
                                                            <th>ราคา</th>
                                                            <th>จำนวน</th>
															<th>ราคารวม</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php $c = 1; ?>
														<?php $tp = 0; ?>
														<?php foreach($order_products as $op){ ?>
                                                        <tr>
                                                            <th scope="row"><?=$c++?></th>
                                                            <td><?=$op->product_code?></td>
                                                            <td><?=$op->order_product_name?></td>
                                                            <td><?=$op->order_product_price?> บาท</td>
                                                            <td><?=$op->order_product_quantity?></td>
															<td><?=$op->order_product_quantity*$op->order_product_price?> บาท</td>
															<?php $tp += $op->order_product_quantity*$op->order_product_price ?>
                                                        </tr>
														<?php } ?>
                                                        <tr>
															<td colspan="5" class="text-right"><h2>รวมทั้งหมด</h2></td>
                                                            <td class="text-left"><h2><?=$tp?> บาท</h2></td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <hr>
												<div>
													<h2>ที่อยู่ จัดส่ง</h2>
													<p><?=$order['order_address']?></p>
												</div>
                                                <hr>
                                                <div class="row text-center">
												<div class="radio">
													<input type="hidden" name="opt" value="<?=$order['order_order_status_id']?>" >
													<input type="hidden" name="oid" value="<?=$order['order_id']?>" >
													<input type="hidden" name="next" value="<?=$previous?>">
                                                    <label>
                                                        <input type="radio" value="1" id="option1" name="optionsOrder" disabled=""> ยังไม่ได้แจ้งชำระเงิน
                                                    </label>
													<label>
                                                        <input type="radio" value="2" id="option2" name="optionsOrder" disabled=""> แจ้งชำระเงินแล้ว  
                                                    </label>
													<?php //if($order['order_order_status_id'] != 1){ ?>
													<?php if($payment != NULL){ ?>
													<a href="javascript:;" class="btn btn-info btn-xs" data-toggle="modal" data-target="#paymentDetail"> <i class="fa fa-file"></i> คลิกดูหลักฐาน</a>
													<?php } ?>
													<label>
                                                        <input type="radio" value="3" id="option3" name="optionsOrder"> ยืนยันการชำระเงินเรียบร้อย
                                                    </label>
													<label>
                                                        <input type="radio" value="4" id="option4" name="optionsOrder"> อยู่ในขั้นตอนการจัดส่ง
                                                    </label>
													<label>
                                                        <input type="radio" value="5" id="option5" name="optionsOrder"> จัดส่งแล้ว
                                                    </label>
                                                </div>
                                                  <a class="btn btn-primary" href="<?=base_url()?>admin/order"><i class="fa fa-chevron-circle-left m-right-xs"></i> รายการสั่งซื้อทั้งหมด</a>
												  <a class="btn btn-warning" href="javascript:;" onclick="saveOrder()"><i class="fa fa-save m-right-xs"></i> บันทึก</a>
												  <a class="btn btn-success" href="<?=base_url()?>admin/order/<?=$order['order_id']?>/print" target="_blank"><i class="fa fa-print m-right-xs"></i> พิมพ์รายการสั่งซื้อ</a>
												  <?php if($order['order_order_status_id'] == 1){ ?>
												  <a class="btn btn-danger" href="#" onclick="" data-toggle="modal" data-target="#rmModal"><i class="fa fa-trash"></i> ลบรายการ</a>
												  <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>
								<div id="paymentDetail" class="modal fade" role="dialog">
									<?php if($payment != NULL){ ?>
									<div class="modal-dialog">
									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title">หลักฐานการโอนเงิน</h4>
										</div>
										<div class="modal-body">
											<div class="jumbotron">
												<h3>ORDER #<?=$payment['payment_order_id']?></h3>
												<p>บัญชีที่โอนเงิน: <strong><?=$payment['bank_name']?></strong></p>
												<p>วันที่ชำระเงิน: <strong><?=$payment['payment_date']?></strong></p>
												<p>เวลา(โดยประมาณ): <strong><?=$payment['payment_time']?></strong></p>
												<p>จำนวนเงิน : <strong><?=$payment['payment_amount']?></strong></p>
												<input type="hidden" name="oid" value="<?=$payment['payment_order_id']?>" >
												<input type="hidden" name="nextPm" value="">
												<?php if($order['order_order_status_id'] < 3){ ?>
												<a class="btn btn-success" href="#" onclick="editPayment(1)"><i class="fa fa-check m-right-xs"></i> ยืนยันรายการ</a>
												<a class="btn btn-danger" href="#" onclick="removePayment(<?=$payment['payment_id']?>)"><i class="fa fa-trash m-right-xs"></i> รายการไม่ถูกต้อง</a>
												<?php } ?>
											</div>
											<div class="jumbotron">
												<h3>หลักฐานการโอนเงิน</h3>
													<a href="<?=base_url().$payment['payment_img']?>" target="_blank">
												<img src="<?=base_url().$payment['payment_img']?>" class="img-responsive">
												</a>
											</div>
										</div>
										<div class="modal-footer">
										</div>
									  </div>
									</div>
									<?php }else{ ?>
									<div class="modal-dialog">
									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="close" data-dismiss="modal">&times;</button>
										  <h4 class="modal-title">ไม่พบหลักฐานการโอนเงิน</h4>
										</div>
										<div class="modal-body">
											
										</div>
										<div class="modal-footer">
										</div>
									  </div>
									</div>
									<?php } ?>
								</div>
                            </div>
							<div id="rmModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">ลบรายการสั่งซื้อ เลขที่ <span><?=$order['order_id']?></span></h4>
                                    </div>
                                    <div class="modal-body">
                                      <button type="button" onclick="deleteOrder(<?=$order['order_id']?>)" class="btn btn-default rmBtn" data-dismiss="modal">ยืนยัน</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
							<script type="text/javascript" src="<?=base_url()?>assets/angjq/editOdrerJq.js"></script>
							<script type="text/javascript" src="<?=base_url()?>assets/angjq/editPaymentJq.js"></script>

                            <!-- footer content -->
                            <?php include 'include/footer-text.php';?>
                            <!-- /footer content -->

                        </div><!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
