
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
                                          ตัวแทนที่รออนุมัติ
                                        </h3>
                                    </div>

                                    <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-12">
                                                  <a href="<?=base_url()?>admin/add_dealer" class="btn btn-success btn-lg" style="width:100%">เพิ่มตัวแทน <i class="fa fa-plus-circle"></i></a>

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
                                                            <th>ชื่อ-สกุล</th>
                                                            <th>ชื่อร้าน</th>
                                                            <th>เบอร์โทร</th>
                                                            <th>ไอดีไลน์</th>
                                                            <th>การดำเนินการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $c = $off+1 ?>
                                                        <?php foreach($dealers as $d){ ?>
                                                        <tr>
                                                            <th scope="row"><?=$c++?></th>
                                                            <td><?=$d->dealer_fullname?></td>
                                                            <td><?=$d->dealer_shopname?></td>
                                                            <td><?=$d->dealer_tel?></td>
                                                            <td><?=$d->dealer_line?></td>
                                                            <td>
                                                              <a href="<?=base_url()?>admin/dealer/<?=$d->dealer_id?>" class="btn btn-primary btn-xs">
                                                                <i class="fa fa-info"></i> ดูรายละเอียด
                                                              </a>
                                                              <a href="#" onclick="setRemove(<?=$d->dealer_id?>, 'dealer')" data-toggle="modal" data-target="#rmModal" class="btn btn-danger btn-xs">
                                                                <i class="fa fa-trash"></i> ลบ
                                                              </a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <div class="row text-center">
                                                  <div class="btn-group">
                                                        <?php for($i=1;$i<=$pa;$i++){?>
                                                        <button class="pageBtn btn btn-info <?=$i==$page?'active':''?>" type="button"><?=$i?></button>
                                                        <?php } ?>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>
                            <div id="rmModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">ลบรายตัวแทนจำหน่าย? <span id="rmOid"></span></h4>
                                    </div>
                                    <div class="modal-body">
                                      <button type="button" class="btn btn-default rmBtn" data-dismiss="modal">ยืนยัน</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <script type="text/javascript" src="<?=base_url()?>assets/angjq/pageJq.js"></script>

                            <!-- footer content -->
                            <?php include 'include/footer-text.php';?>
                            <!-- /footer content -->

                        </div><!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
