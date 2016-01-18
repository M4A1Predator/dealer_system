	<?php
	// get categories and brands for display on menu bar
	$menu_cats = $this->Category->list_categories_with_products_op(array(), 0, 0, 'obj', 'category_name', 'ASC', array('p_amount >' => '0'));
	$menu_brands = $this->Brand->list_brands_with_products_op(array(), 0, 0, 'obj', 'brand_name', 'ASC', array('p_amount >' => '0'));
	// set brands in submenu of each categories
	$menu_brands_in_cat= array();
	foreach($menu_cats as $c){
		$menu_brands_in_cat[$c->category_id] = $this->Brand->list_brand_from_category($c->category_id, 'obj');
	}
	//-----------------------------------------------------
	// set data for display on cart
	/*$cart = $this->session->userdata('cart');
	$total_price = 0.00;
	// prepare for display product's data
	$product_in_cart = array();
	if($cart == NULL){
		$cart = array();
	}else{
		//get product by id from cart
		foreach($cart as $c){
			$p = $this->Product->get_product_view(array('product_id' => $c['pid'], 'price_level_id' => $this->session->userdata('dealer_level_id')));
			$p['qty'] = $c['amount'];
			array_push($product_in_cart, $p);
			$total_price += ($p['qty']*$p['price_price']);
		}
	}*/
	//-------------------------------------------------------
	//--set order data
	$now_order = $this->Order->get_depend_order_amount(array(
																'order_dealer_id' => $this->session->userdata('dealer_id')
															));
	//$this->session->set_flashdata('msg', 'test');
	date_default_timezone_set(SITE_TIMEZONE);
	?>
	
	<style>
		.warning{
			color: #555;
			border-radius:10px;
			font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
			padding:10px 36px;
			/*margin:10px;*/
			background:#fff8c4 no-repeat 10px 50%;
			border:1px solid #f2c779;
			text-align: center;
			position: fixed;
			left: 40%;
			z-index: 999;
			width: 20%;
			margin-top: 20%;
			display: none;
		}
		
		.notice{
			color:#555;
			border-radius:10px;
			font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
			padding:10px 36px;
			/*margin:10px;*/
			background:#e3f7fc no-repeat 10px 50%;
			border:1px solid #8ed9f6;
			text-align: center;
			position: fixed;
			left: 40%;
			z-index: 999;
			width: 20%;
			margin-top: 20%;
			display: none;
		}
	</style>
	
	<div class="header-v5 header-static">
        <!-- Topbar v3 -->
		<?php if(check_login()){ ?>
        <div class="topbar-v3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ul class="list-inline right-topbar pull-right">
                            <li><a href="<?=base_url()?>shop/account">บัญชีผู้ใช้</a></li>
							<li><a href="<?=base_url()?>shop/cart">ตะกร้าสินค้า (<span id="cartQtyTop"></span>)</a></li>
                            <li><a href="<?=base_url()?>shop/account/now_order">รายการสั่งซื้อทั้งหมด (<?=$now_order['amount']?>)</a></li>
                            <li><a href="<?=base_url()?>shop/logout">ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </div><!--/container-->
        </div>
		<?php } ?>
				<div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url()?>">
                        <img id="logo-header" src="<?=base_url()?>mats/img/logo.png" alt="Logo">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <!-- Shopping Cart -->
                    <ul class="list-inline shop-badge badge-lists badge-icons pull-right">
                        <li>
							<?php if(check_login()){ ?>
							<a href="<?=base_url()?>shop/cart"><i class="fa fa-shopping-cart"></i></a>
                            <span class="badge badge-sea rounded-x" id="cartQty"></span>
                            <ul id="cartList" class="list-unstyled badge-open mCustomScrollbar" data-mcs-theme="minimal-dark">
								<?php //foreach($product_in_cart as $p){ ?>
								<?php //} ?>
                            </ul>
							<?php } ?>
                        </li>
                    </ul>
					
					<ul class="nav navbar-nav">
                        <!-- Main Demo -->
                        <li class="<?=$this->session->userdata('page')=='index'?'active':'' ?>"><a href="<?=base_url()?>">หน้าหลัก</a></li>
                        <li class="<?=$this->session->userdata('page')=='allproduct'?'active':'' ?>"><a href="<?=base_url()?>shop/product">สินค้าทั้งหมด</a></li>
                        <li class="dropdown <?=$this->session->userdata('page')=='category'?'active':'' ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                หมวดหมู่สินค้า
                            </a>
                            <ul class="dropdown-menu">
								<?php foreach($menu_cats as $c){ ?>
                                <li class="dropdown-submenu">
                                    <a href="javascript:;" id="menuCat<?=$c->category_id?>"><?=$c->category_name?></a>
                                    <ul class="dropdown-menu">
										<?php foreach($menu_brands_in_cat[$c->category_id] as $b){ ?>
                                        <li><a href="<?=base_url().'shop/product?cats='.$c->category_id.'--&brands='.$b->brand_name."--&m=category" ?>"><?=$b->brand_name?></a></li>
										<?php } ?>
                                    </ul>
                                </li>
								<?php } ?>
                            </ul>
                        </li>
                        <li class="dropdown <?=$this->session->userdata('page')=='brand'?'active':'' ?>">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                แบรนด์สินค้า
                            </a>
                            <ul class="dropdown-menu">
								<?php foreach($menu_brands as $b){ ?>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" id="menuBrand<?=$b->brand_name?>"><?=$b->brand_name?></a>  
                                </li>
								<?php } ?>
                            </ul>
                        </li>
                        <li class="<?=$this->session->userdata('page')=='bestseller'?'active':'' ?>"><a href="<?=base_url()?>shop/product/bestseller">สินค้าขายดี</a></li>
                        <li class="<?=$this->session->userdata('page')=='contact'?'active':'' ?>"><a href="<?=base_url()?>shop/contact">ติดต่อเรา</a></li>
                        <!-- Main Demo -->
                    </ul>
                    </div>
            </div>    
        </div>    
        </div>
<span style="display: none;" id="notice"><?=$this->session->flashdata('rmmsg')?></span>
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
<div id="cartNotice" class="notice">
	<span style="font-weight: normal; font-size: 16px">เพิ่มสินค้าลงตะกร้าเรียบร้อย</span>
</div>

<div id="cartWarning" class="warning">
	<span id="cartWarningMsg" style="font-weight: normal; font-size: 16px"></span>
</div>