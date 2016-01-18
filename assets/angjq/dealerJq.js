var url = document.URL;

var q = location.search.substring(1);
$('.pBtn').click(function (){
    p = $(this).html();
    url = document.URL;
    url = url.replace('#', '');
    qry = q.split('&');
    n = '';
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('p=') != -1) {
            n = qry[i];
            url = url.replace(n, 'p='+p);
            window.location.replace(url);
            return;
        }
    }
    if (url.indexOf('?') == -1) {
        url = url+'?';
    }
    n = url+'&p='+p;
    window.location.replace(n);
});

$('.nBtn').click(function (){
    searchName();
});

$('.nField').bind('keypress', function(e){
    if (e.keyCode == 13) {
        searchName();
    }
});

function searchName(){
    n = $('.nField').val();
    url = document.URL;
    url = url.replace('#', '');
    qry = q.split('&');
    param = '';
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('p=') != -1) {
            url = url.replace('&'+qry[i], '');
            url = url.replace(qry[i], '');
            break;
        }
    }
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('name=') != -1) {
            param = qry[i];
            url = url.replace(param, 'name='+n);
            window.location.replace(url);
            return;
        }
    }
    if (url.indexOf('?') == -1) {
        url = url+'?';
    }
    next = url+'&name='+n;
    window.location.replace(next);
}
