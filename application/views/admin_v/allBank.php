
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
                                          บัญชีธนาคารทั้งหมด
                                          <small>
                                              Bank accounts
                                          </small>
                                        </h3>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
                                            <div class="x_content"><span><?=$this->session->flashdata('msg')?></span>
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>ธนาคาร</th>
                                                            <th>เลขบัญชี</th>
                                                            <th>ชื่อบัญชี</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count=$off+1; ?>
                                                        <?php foreach($banks as $bank){ ?>
                                                        <tr>
                                                          <th scope="row"><?=$count++?></th>
                                                          <td>ธนาคาร<?=$bank['bank_name']?></td>
                                                          <td><?=$bank['bank_number']?></td>
                                                          <td><?=$bank['bank_accountname']?></td>
                                                          <td>
                                                            <a href="<?=base_url()?>admin/bank/<?=$bank['bank_id']?>">
                                                            <button type="button" class="btn btn-warning btn-xs">
                                                              <i class="fa fa-pencil-square"></i> แก้ไข
                                                            </button>
                                                            </a>
                                                            <button type="button" class="btn btn-danger btn-xs" onclick="setBankRemove(<?=$bank['bank_id']?>)" data-toggle="modal" data-target="#rmBank">
                                                              <i class="fa fa-trash"></i> ลบ
                                                            </button>
                                                          </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <!--
                                                <div class="row text-center">
                                                  <div class="btn-group">
                                                        <?php for($i=1; $i <= $page_amount; $i++){ ?>
                                                        <button class="pageBtn btn btn-info <?=$i==$page?'active':''?>" type="button"><?=$i?></button>
                                                        <?php } ?>
                                                  </div>
                                                </div>
                                                -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <div id="rmBank" class="modal fade" role="dialog">
                                <div class="modal-dialog" style="width: 20%">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">ลบบัญชีธนาคาร?</h4>
                                    </div>
                                    <div class="modal-body" style="text-align: center;">
                                      <button type="button" onclick="removeBank()"  class="btn btn-default" data-dismiss="modal">ยืนยัน</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <script type="text/javascript" src="<?=base_url()?>assets/angjq/bankJq.js"></script>
                            <!--<script type="text/javascript" src="<?=base_url()?>assets/angjq/pageJq.js"></script>-->

                            <!-- footer content -->
                            <?php include 'include/footer-text.php';?>
                            <!-- /footer content -->

                        </div><!-- /page content -->
        </div>
    </div>
<?php include 'include/footer.php';?>
