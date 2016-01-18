calPrices = $('[id^="calPrice"]');
console.log(calPrices[0]['id']);

hostname = window.location.hostname;

calProductPrices();

function calProductPrices() {
    sum = 0;
    for(i=0;i<calPrices.length;i++){
        pid = calPrices[i]['id'].substring('calPrice'.length);
        qty = $('[name="qty'+pid+'"]').val();
        if (isNaN(qty)) {
            return;
        }
        
        price = $('#price'+pid).html();
        price = parseFloat(price.substring(0, price.indexOf(" ")));
        p = (price*parseInt(qty)).toFixed(2);
        $('#calPrice'+pid).html( p );
        sum += parseFloat(p);
        
        //console.log(pid+" "+qty+" : "+price);
    }
    
    $('#totalPrice').html(sum.toFixed(2));
    $('#nPrice').html($('#totalPrice').html()+" บาท");
}

$('input[name^="qty"]').on('input', function() {
    calProductPrices();
});

function inQty(pid) {
    qty = parseInt($('[name="qty'+pid+'"]').val()) + 1;
    if (isNaN(qty)) {
        return;
    }
    $('[name="qty'+pid+'"]').val(qty);
    
    calProductPrices();
}

function deQty(pid) {
    qty = parseInt($('[name="qty'+pid+'"]').val());
    if (qty > 1) {
        qty -= 1;
        $('[name="qty'+pid+'"]').val(qty);
    }
    calProductPrices();
}

function editCart() {
    if (calPrices.length == 0) {
        return;
    }
    
    param = {}
    for(i=0;i<calPrices.length;i++){
        pid = calPrices[i]['id'].substring('calPrice'.length);
        qty = $('[name="qty'+pid+'"]').val();
        if (qty=='' || isNaN(qty) || parseInt(qty) < 1) {
            return;
        }
        
        param["pid"+pid] = parseInt(qty);
    }
    //console.log(JSON.stringify(param));
    
    $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+hostname+"/shop/cart/edit_cart",
        data: param
    }).success(function (data){
        if (data) {
            console.log(data);
            //dest = window.location.protocol+"//"+hostname+"/shop/order/add_order";
            //window.location.replace(dest);
            $('#orderForm').submit();
        }
    });
}

function removeFromCartPage(pid) {
    param = {
        'pid' : pid,
    }
    $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+hostname+"/shop/remove_from_cart",
        data: param
    }).done(function (data){
        //console.log(data);   
        if (data == "removed") {
        }
        window.location.reload();
    });
}

function submitOrder() {
    $("#orderForm").submit();
}

