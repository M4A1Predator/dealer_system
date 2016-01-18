
var oid = -1;

function setOrderId(id) {
    oid = id;
}

$('.rmOrderBtn').click(function (){
    param = {
        'oid' : oid
    }
    $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+hostname+"/shop/order/remove",
        data: param
    }).done(function (data){
        console.log(data);
        if (data == 1) {
            window.location.reload();
        }
    }).fail(function (data){
        console.log(data);
    });
});

if ( $("#notice").html() != null && $("#notice").html() != '' ) {
    $('#ntMsg').html($("#notice").html());
    $('#noticeModal').modal('toggle');
}