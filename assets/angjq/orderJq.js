var url = document.URL;
var q = location.search.substring(1);
var hostname = window.location.hostname;
var protocol = window.location.protocol;

var deleteId = 0;

$('.statusBtn').change(function (){
    sid = $(this).val();
    url = url.replace('#', '');
    qry = q.split('&');
    n = '';
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('page=') != -1) {
            url = url.replace('&'+qry[i], '');
            url = url.replace(qry[i], '');
            break;
        }
    }
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('st=') != -1) {
            n = qry[i];
            url = url.replace(n, 'st='+sid);
            window.location.replace(url);
            return;
        }
    }
    if (url.indexOf('?') == -1) {
        url = url+'?';
    }
    newUrl = url+'&st='+sid;
    window.location.replace(newUrl);
});

function setDeleteId(id) {
    $('#rmOid').html(id);
    deleteId = id;
}

$('.rmBtn').click(function (){
    deleteOrder(deleteId);
});

function deleteOrder(id) {
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
            window.location.reload();
        }
    });
}
