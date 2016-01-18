<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="<?=base_url()?>admin" class="site_title"><i class="fa fa-space-shuttle"></i> <span>Dealer System</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="<?=base_url()?>assets/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?=$this->session->userdata('admin_username')?></h2>
            </div>
            <div style="display: block;clear: both;"></div>
        </div>
        <!-- /menu prile quick info -->

        <br />
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="<?=base_url()?>admin/"><i class="fa fa-home"></i> หน้าแรก</a></li>
            <li><a><i class="fa fa-edit"></i> สินค้า <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/product">สินค้าทั้งหมด</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/add_product">เพิ่มสินค้า</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-tag"></i> แบรนด์สินค้า <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/brand">แบรนด์ทั้งหมด</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/add_brand">เพิ่มแบรนด์</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-list-ul"></i> หมวดหมู่สินค้า <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/category">หมวดหมู่ทั้งหมด</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/add_category">เพิ่มหมวดหมู่</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-users"></i> ตัวแทนจำหน่าย <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/dealer">ตัวแทนทั้งหมด</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/dealer/non_arrpove">ตัวแทนรออนุมัติ</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/add_dealer">เพิ่มตัวแทน</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-shopping-cart"></i> รายการสั่งซื้อ <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/order">รายการสั่งซื้อทั้งหมด</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/order/payment">รายการแจ้งชำระเงิน</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-bank"></i> บัญชีธนาคาร <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/bank">บัญชีทั้งหมด</a>
                    </li>
                    <li><a href="<?=base_url()?>admin/bank/add">เพิ่มบัญชี</a>
                    </li>
                </ul>
            </li>
            <li><a><i class="fa fa-file"></i> ข้อมูลเว็บไซต์ <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/detail/address">ที่อยู่</a></li>
                    <li><a href="<?=base_url()?>admin/detail/buy">การสั่งซื้อและจัดส่ง</a></li>
                    <li><a href="<?=base_url()?>admin/detail/contact">เกี่ยวกับร้านและการติดต่อ</a></li>
                    <li><a href="<?=base_url()?>admin/detail/suggest">ข้อมูลการแนะนำ</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-cog"></i> ผู้ดูแลระบบ <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" style="display: none">
                    <li><a href="<?=base_url()?>admin/setting">ตั้งค่าแอดมินหลัก</a></li>
                    <?php if($this->session->userdata('admin_level') == 1){ ?>
                    <li><a href="<?=base_url()?>admin/all_admin">รายชื่อแอดมินทั้งหมด</a></li>
                    <li><a href="<?=base_url()?>admin/add_admin">เพิ่มแอดมิน</a></li>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->


</div>
</div>

<span style="display: none;" id="notice"><?=$this->session->flashdata('ntmsg')?></span>
<div id="noticeModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width: 30%; margin-top: 12%;">
                 <!-- Modal content-->
                 <div class="modal-content">
						<div class="modal-header" style="text-align: center;">
							<p id="ntMsg">ลบรายการเรียบร้อย</p>
						</div>
                        <div class="modal-body" style="text-align: center;">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                 </div>
        </div>
</div>


