var url = window.location.hostname;
var hostname = window.location.hostname;
getCart();
function getCart() {
    
    $.ajax({
        type: "GET",
        url: window.location.protocol+"//"+url+"/shop/cart/get_in_cart",
    }).success(function (data){
        ps = $.parseJSON(data);
        if (ps == null) {
            ps = new Array();
        }
        tag = "";
        total = 0;
        for(var i=0;i<ps.length;i++){
            tag += '<li id=listCart'+ps[i].pid+'>';
            tag += '<img src="'+window.location.protocol+"//"+url+"/"+ps[i].img+'" alt="">';
            tag += '<button type="button" class="close" onclick="removeFromCart('+ps[i].pid+')">×</button>';
            tag += '<div class="overflow-h">';
            tag += '<span>'+ps[i].pname+'</span>';
            tag += '<small> '+ps[i].amount+'x '+ps[i].price+' บาท</small>'
            tag += '</div>'
            tag += "</li>";
            
            total += parseFloat(ps[i].amount)*parseFloat(ps[i].price)
        }
        
        viewCartUrl = window.location.protocol+"//"+url+"/shop/cart";
        
        sub = '<li class="subtotal">'+
                    '<div class="overflow-h margin-bottom-10">'+
                        '<span>รวมทั้งสิน</span>'+
                        '<span class="pull-right subtotal-cost">'+total.toFixed(2)+' บาท</span>'+
                    '</div>'+
                   ' <div class="row">'+
                        '<div class="col-xs-12 text-center">'+
                            '<a style="text-align:center; color:#fff;" href="'+window.location.protocol+"//"+url+'/shop/cart'+'" id="addOrderBtn" class="btn-u btn-u-sea-shop btn-block">ดูตะกร้าสินค้า</a>'+
                        '</div>'+
                    '</div>'+
                '</li>';
        
        $("#mCSB_1_container").html(tag);
        $("#mCSB_1_container").append(sub);
        $("#cartQty").html(ps.length);
        $("#cartQtyTop").html(ps.length);
        return;
    });
}

function addToCart(pid, amount) {
    param = {
        'pid' : pid,
        'amount' : amount
    }
    $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+url+"/shop/add_to_cart",
        data: param
    }).success(function (data){
        console.log(data);
        //window.location.reload();
        getCart();
        if (data == 'added') {
            $('#cartNotice').fadeToggle(200);
            setTimeout(function(){ $('#cartNotice').fadeToggle(200); }, 2000);
        }else if (data == 'increased'){ 
            $('#cartWarningMsg').html('เพิ่มจำนวนสินค้าในตะกร้าเรียบร้อย');
            $('#cartWarning').fadeToggle(200);
            setTimeout(function(){ $('#cartWarning').fadeToggle(200); }, 2000);
        }
        
                
    });
}

$("[id^='rmCart']").click(function (){
    pid = $(this).attr('id').substring('rmCart'.length);
    console.log(pid);
    removeFromCart(pid);
});

function removeFromCart(pid) {
    console.log(pid);
    param = {
        'pid' : pid,
    }
    $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+url+"/shop/remove_from_cart",
        data: param
    }).success(function (data){
        console.log(data);   
        if (data == "removed") {
            /*$("#listCart"+pid).hide();
            cartQty = $('#cartQty').html() - 1;
            $('#cartQty').html(cartQty);*/
        }
        //window.location.reload();
        getCart();
    });
}

$('#addToCardSubmit').click(function (){
    qty = $('[name="amount"]').val();
    if (qty >= 1) {
        $('[name="addToCardForm"]').submit();
        return;
    }
});

$('#addOrderBtn').click(function (){
    products = $('[id^="listCart"]');
    console.log(products.length);
    
    if (products.length >= 1) {
        param = {
            'con' : 'ok',
            'type' : 'web'
        }
        $.ajax({
            type: "POST",
            url: window.location.protocol+"//"+hostname+"/shop/order/add_order",
            data: param
        }).success(function (data){
            if (data.indexOf('added') != -1) {
                oid = data.substring('added.'.length);
                newUrl = window.location.protocol+"//"+hostname+"/shop/order/order_complete/"+oid;
                window.location.replace(newUrl);
            }
        });
    }
});

function addOrder(args) {
    //code
}
