url = document.URL;
hostname = window.location.hostname;

next = $('[name="nextPm"]').val();
if (next == null || next == '') {
    next = url;
}

console.log(next);

function editPayment(status) {
    
    oid = $('input[name="oid"]').val();
    if (status == 1) {
        dest = window.location.protocol+"//"+hostname+"/admin/payment/confirm";
    }else{
        dest = window.location.protocol+"//"+hostname+"/admin/payment/remove";
    }
    
    param = {
        'oid' : oid,
        //'newStatus' : status
    }
     $.ajax({
        type: "POST",
        url: dest,
        data: param
    }).done(function (data){
        console.log(data);
        if (data == 1) {
            window.location.replace(next);
        }
    });
}

function removePayment(id) {
    oid = $('input[name="oid"]').val();
    param = {
        'oid' : oid,
        'pid' : id
    }
    
     $.ajax({
        type: "POST",
        url: window.location.protocol+"//"+hostname+"/admin/payment/remove",
        data: param
    }).done(function (data){
        console.log(next);
        if (data == 1) {
            window.location.replace(next);
        }
    });
}