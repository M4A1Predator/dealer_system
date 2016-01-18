
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
                                          แบรนด์สินค้าทั้งหมด
                                          <small>
                                              Product Brands
                                          </small>
                                        </h3>
                                    </div>

                                    <div class="col-md-3 col-md-offset-3 col-sm-3 col-sm-offset-3 col-xs-12">
                                                  <a href="<?=base_url()?>admin/add_brand"><button type="button" class="btn btn-success btn-lg" style="width:100%">เพิ่มแบรนด์สินค้า <i class="fa fa-plus-circle"></i></button></a>
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
                                                            <th>ชื่อแบรนด์สินค้า</th>
                                                            <th>จำนวนสินค้า</th>
                                                            <th>การดำเนินการ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count=$off+1; ?>
                                                        <?php foreach($brands as $brand){ ?>
                                                        <tr>
                                                          <th scope="row"><?=$count++?></th>
                                                          <td><?=$brand->brand_name?></td>
                                                          <td><?=$brand->p_amount?></td>
                                                          <td>
                                                            <a href="<?=base_url()?>admin/brand_edit/<?=$brand->brand_id?>">
                                                            <button type="button" class="btn btn-warning btn-xs">
                                                              <i class="fa fa-pencil-square"></i> แก้ไข
                                                            </button>
                                                            </a>
                                                            <?php if($brand->p_amount == 0 ){?>
                                                            <button type="button" class="btn btn-danger btn-xs" onclick="setRemove(<?=$brand->brand_id?>, 'brand')" data-toggle="modal" data-target="#rmBrand">
                                                              <i class="fa fa-trash"></i> ลบ
                                                            </button>
                                                            <?php } ?>
                                                          </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                                <div class="row text-center">
                                                  <div class="btn-group">
                                                        <?php for($i=1; $i <= $page_amount; $i++){ ?>
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
                            <div id="rmBrand" class="modal fade" role="dialog">
                                <div class="modal-dialog" style="width: 20%">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">ลบหมวดหมู่?</h4>
                                    </div>
                                    <div class="modal-body" style="text-align: center;">
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
