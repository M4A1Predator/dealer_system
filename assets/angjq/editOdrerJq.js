opt = $('[name="opt"]').val();
$('#option'+opt).attr('checked', 'checked');

url = document.URL;
protocol = window.location.protocol;
hostname = window.location.hostname;

function saveOrder() {
    //console.log($('input[name="optionsOrder"]:checked').val());
    status = $('input[name="optionsOrder"]:checked').val();
    oid = $('input[name="oid"]').val();
    param = {
        'oid' : oid,
        'newStatus' : status
    }
     $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+hostname+"/admin/order/edit_status",
        data: param
    }).done(function (data){
        //console.log(data);
        if (data == 1) {
            window.location.replace($('[name="next"]').val());
        }
    }).fail(function (data){
        console.log(data);
    });
}

function deleteOrder(id) {
    nextUrl = $('[name="next"]').val();
    param = {
        'oid' : id,
        'mode' : 'ajax',
    }
    
    $.ajax({
        type: 'POST',
        url: protocol+"//"+hostname+"/admin/order/delete_order",
        data: param
    }).done(function (data){
        if (data == 'removed') {
            window.location.reload(nextUrl);
        }
    });
}
