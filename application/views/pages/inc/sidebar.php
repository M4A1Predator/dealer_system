                <?php
                $p_has = array('p_amount >' => '0');
                $cats = $this->Category->list_categories_with_products_op(array(), 0, 0, 'obj', 'category_name', 'ASC', $p_has);
                $brands = $this->Brand->list_brands_with_products_op(array(), 0, 0, 'obj', 'brand_name', 'ASC', $p_has);
                ?>
<div class="col-md-3 filter-by-block md-margin-bottom-60">
                <h1>ตัวเลือกสินค้า</h1>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    แบรนด์
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul class="list-unstyled checkbox-list">
                                    <?php foreach($brands as $b){ ?>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox" name="brand<?=$b->brand_name?>" <?=in_array($b->brand_id, $brands_sel)?'checked':''?>>
                                            <i></i>
                                            <?=$b->brand_name?>
                                            <small><a href="#">(<?=$b->p_amount?>)</a></small>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--/end panel group-->

                <div class="panel-group" id="accordion-v2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseTwo">
                                    หมวดหมู่
                                    <i class="fa fa-angle-down"></i>
                                </a>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul class="list-unstyled checkbox-list">
                                    <?php foreach($cats as $cat){ ?>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox" name="cat<?=$cat->category_id?>" <?= in_array($cat->category_id, $cats_sel)?'checked':'' ?>>
                                            <i></i>
                                            <?=$cat->category_name?>
                                            <small><a href="#">(<?=$cat->p_amount?>)</a></small>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>        
                            </div>
                        </div>
                    </div>
                </div><!--/end panel group-->

                <button type="button" id="filtBtn" class="btn-u btn-brd btn-brd-hover btn-u-lg btn-u-sea-shop btn-block">ดำเนินการ</button>
            </div>