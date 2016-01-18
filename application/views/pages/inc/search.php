<!--=== Search ===-->
                <div class="search-container">
                    <div class="container tpsearch-box text-center">
                        <form action="<?=base_url()?>shop/product"  class="form-inline" role="form" method="get">
                            <div class="input-group search-group">
                                <input type="text" id="searchKeyword" value="<?=$this->session->flashdata('keyword');?>" class="form-control search-input" name="keyword" placeholder="กรอกชื่อสินค้า">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger btn-search searchBtn" type="submit">ค้นหาสินค้า!</button>
                                    <!--<input type="button" class="btn btn-danger btn-search searchBtn" value="ค้นหาสินค้า!">-->
                                </span>
                            </div>
                        </form>          
                    </div>
                </div>
                
<!--=== End Search ===-->
