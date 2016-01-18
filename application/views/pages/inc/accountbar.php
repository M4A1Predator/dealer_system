<?php
    $side_sel = $this->uri->segment(3)!=NULL?$this->uri->segment(3):'';
    $dealer_bar = $this->Dealer->get_dealer($this->session->userdata('dealer_id'));
?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<div class="col-md-3 md-margin-bottom-40">
    <img class="img-responsive profile-img margin-bottom-10" src="<?=base_url().$dealer_bar['dealer_picture']?>?ccpic=<?=urlencode(time())?>" alt="">
    <div class="col-md-12 text-center"><p class="profilename">คุณ<?=$dealer_bar['dealer_fullname']?></p></div>
    <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
        <li class="list-group-item <?=$side_sel == ''?'active':''?>">
            <a href="<?=base_url()?>shop/account"><i class="fa fa-bar-chart-o"></i> ภาพรวม</a>
        </li>
        <li class="list-group-item <?=$side_sel == 'profile'?'active':''?>">
            <a href="<?=base_url()?>shop/account/profile"><i class="fa fa-user"></i> ข้อมูลส่วนตัว</a>
        </li>
        <li class="list-group-item <?=$side_sel == 'now_order'?'active':''?>">
            <a href="<?=base_url()?>shop/account/now_order"><i class="fa fa-cubes"></i> รายการที่กำลังสั่งซื้อ</a>
        </li>
        <li class="list-group-item <?=$side_sel == 'history'?'active':''?>">
            <a href="<?=base_url()?>shop/account/history"><i class="fa fa-group"></i> ประวัติการสั่งซื้อ</a>
        </li>
        <li class="list-group-item">
            <a href="<?=base_url()?>shop/logout"><i class="fa fa-cog"></i> ออกจากระบบ</a>
        </li>
    </ul>
    <div class="margin-bottom-50"></div>
</div>



<div id="rmModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 30%; margin-top: 12%;">
                 <!-- Modal content-->
                 <div class="modal-content">
                          <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   <h4 class="modal-title">ลบรายการสั่งซื้อ</h4>
                          </div>
                          <div class="modal-body" style="text-align: center;">
                                   <button type="button" class="btn btn-default" data-dismiss="modal">ย้อนกลับ</button>
                                   <button type="button" class="rmOrderBtn btn btn-default" data-dismiss="modal">ลบรายการ</button>
                          </div>
                 </div>
        </div>
</div>