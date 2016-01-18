
<?php include 'include/head.php';?>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

                    <?php include 'include/sidebar.php';?>
                    <?php include 'include/topNavigation.php';?>

            <!-- page content -->
           <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>รายละเอียดตัวแทน</h3>
                        </div>

                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
							
							<div class="row">
								<div class="col-md-12">

									<div class="card hovercard">
										<img class="cardheader" src="" />
										<div class="avatar">
											<img alt="" src="<?=base_url().$dealer->dealer_picture?>?c=<?=urlencode(time())?>">
										</div>
										<div class="info">
											<div class="title">
												<a><?=$dealer->dealer_fullname?></a>
											</div>
											<div class="desc">
												<p>
													<?php $c = 4; ?>
													<?php for($i=0;$i<$dealer->level_order;$i++){?>
													<i class="fa fa-star"></i>
													<?php $c--; } ?>
													<?php for($i=0;$i<$c;$i++){?>
													<i class="fa fa-star-o"></i>
													<?php } ?>
													<br>
													<?=$dealer->level_name?>
												</p>
											</div>
											<div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
												<table class="table table-bordered userList">
													<thead>
														<tr>
															<th>ชื่อ</th>
															<td><?=$dealer->dealer_fullname?></td>
														</tr>
													</thead>
													<tbody>
														<tr>
															<th>ที่อยู่</th>
															<td> <?=$dealer->dealer_address?></td>
														</tr>
														<tr>
															<th>ชื่อร้าน</th>
															<td> <?=$dealer->dealer_shopname?></td>
														</tr>
														<tr>
															<th>เบอร์โทร</th>
															<td><?=$dealer->dealer_tel?></td>
														</tr>
														<tr>
															<th>ไลน์ไอดี</th>
															<td><?=$dealer->dealer_line?></td>
														</tr>
														<tr>
															<th>อีเมล์</th>
															<td><?=$dealer->dealer_email?></td>
														</tr>
														<tr>
															<th>username</th>
															<td><?=$dealer->dealer_username?></td>
														</tr>
														<tr>
															<th>เว็บไซต์</th>
															<td><a href="<?=$dealer->dealer_website?>" target="_blank"><?=$dealer->dealer_website?></a></td>
														</tr>
														<tr>
															<th>เฟสบุ๊ค</th>
															<td><a href="<?=$dealer->dealer_facebook?>" target="_blank>"><?=$dealer->dealer_facebook?></a></td>
														</tr>
														<tr>
															<th>แฟนเพจ</th>
															<td><a href="<?=$dealer->dealer_fanpage?>" target="_blank"><?=$dealer->dealer_fanpage?></a></td>
														</tr>
														<tr>
															<th>รายละเอียดอื่นๆ</th>
															<td><?=$dealer->dealer_detail?></td>
														</tr>
													</tbody>
												</table>
												<div class="row btnRow">
													<a class="btn btn-success" href="<?=base_url()?>admin/dealer/<?=$dealer->dealer_id?>/edit"><i class="fa fa-pencil m-right-xs"></i> แก้ไขข้อมูล</a>
												</div>
											</div>
										</div>
										
									</div>

								</div>
							</div>
                                <div class="x_content">
									
								</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <?php include 'include/footer-text.php';?>
                <!-- /footer content -->

            </div>
	   </div>
    </div>
<?php include 'include/footer.php';?>
