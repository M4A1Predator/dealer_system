<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <style>
        @media all  
        {  
            .page-break { display:none; }  
            .page-break-no{ display:none; }  
        }  
        @media print  
        {  
            .page-break { display:block;height:1px; page-break-before:always; }  
            .page-break-no{ display:block;height:1px; page-break-after:avoid; }   
        }  
        .pure-table {
            border-collapse: collapse;
            border-spacing: 0;
            empty-cells: show;
            border: 1px solid #cbcbcb;
            width: 790px;
        }
        .pure-table-bordered td {
            border-bottom: 1px solid #cbcbcb;
        }
        .pure-table td, .pure-table th {
            border-left: 1px solid #cbcbcb;
            border-width: 0 0 0 1px;
            font-size: inherit;
            margin: 0;
            overflow: visible;
            padding: .5em 1em;
        }
        .pure-table tr, .pure-table tr {
            border-bottom: 1px solid #cbcbcb;
            font-size: inherit;
            margin: 0;
            overflow: visible;
            padding: .5em 1em;
        }
        .pure-table thead {
            background-color: #e0e0e0;
            color: #000;
            text-align: left;
            vertical-align: bottom;
        }
        .pure-table td {
            background-color: transparent;
        }
        .right{
            text-align: right;
        }
        .left{
            text-align: left;
        }
        .product{
            width: 70%;
        }
        .address {
            border: 2px solid #909090;
            width: 750px;
            border-style: dashed;
            margin-bottom: 10px;
            padding: 20px;
        }
        .name{
            font-size: 20px;
        }
        .call{
            
            position: absolute;
            left: 539px;
            font-size: 40px;
            font-family: fantasy;
            border: 1px #000;
            border-style: outset;
            padding: 10px;
            margin-top: -70px;
        
        }

    </style>
<body>


    <h2>ใบสั่งซื้อเลขที่ #<?=$order['order_id']?></h2>
    
    <table class="pure-table pure-table-bordered">
        <tbody>
        <tr>
            <p><span class="name">คุณ<?=$dealer['dealer_fullname']?></span> (<?=$dealer['level_name']?> MEMBER)<br>
            <?=$dealer['dealer_shopname']?><br>
            <?=display_address($order['order_address'])?></p>
        </tr>
        </tbody>
    </table>
    
    <table class="pure-table pure-table-bordered">
    <thead>
        <tr>
            <th class="left" width="200">รหัส</th>
            <th class="product">สินค้า</th>
            <th class="right">ราคา</th>
            <th class="right">จำนวน</th>
            <th class="right">รวม</th>
        </tr>
       
    </thead>

    <tbody>
        <?php foreach($products as $p){ ?>
        <tr>
            <td class="left"><?=$p->product_code?></td>
            <td><?=$p->product_name?></td>
            <td class="right"><?=display_money($p->order_product_price)?></td>
            <td class="right"><?=display_amount($p->order_product_quantity)?></td>
            <td class="right"><strong><?=display_money($p->order_product_price*$p->order_product_quantity)?></strong></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <div class="right"><h2>รวมทั้งหมด <?=display_money($order['order_price'])?> บาท</h2></div>
    <div class="page-break">&nbsp;</div>  
    <h2>ใบปะหน้า ใบสั่งซื้อเลขที่ #<?=$order['order_id']?></h2>
        <!--เอาสองอัน-->
            <div class="address" style="font-size:30px;">
            <a>กรุณาส่ง...</a>
                <p style="padding-left:20px;">
                    <div class="call"><?=$dealer['dealer_tel']?></div>
                    <span style="font-size:40px;">คุณ<?=$dealer['dealer_fullname']?></span><br>
                    <?=$dealer['dealer_shopname']?><br>
                    <?=display_front_box($order['order_address'])?>
                </p>
            </div>
            <div class="address" style="font-size:30px;">
            <a>กรุณาส่ง...</a>
                <p style="padding-left:20px;">
                    <div class="call"><?=$dealer['dealer_tel']?></div>
                    <span style="font-size:40px;">คุณ<?=$dealer['dealer_fullname']?></span><br>
                    <?=$dealer['dealer_shopname']?><br>
                    <?=display_front_box($order['order_address'])?>
                </p>
            </div>
 
    <script> //window.print();
    if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1){   // Chrome Browser Detected?
    window.PPClose = false;                                     // Clear Close Flag
    window.onbeforeunload = function(){                         // Before Window Close Event
        if(window.PPClose === false){                           // Close not OK?
            return 'Leaving this page will block the parent window!\nPlease select "Stay on this Page option" and use the\nCancel button instead to close the Print Preview Window.\n';
        }
    }                   
    window.print();                                             // Print preview
    window.PPClose = true;                                      // Set Close Flag to OK.
}
    </script>
</body>
</html>
