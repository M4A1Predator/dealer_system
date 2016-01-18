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

$('.pBtnPlus').click(function (){
    p = parseInt($("#pNow").html()) + 1;
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

$('.pBtnMin').click(function (){
    console.log('plus');
    p = parseInt($("#pNow").html()) -1;
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

$('.lim').click(function (){
    lim = $(this).html();
    url = document.URL;
    url = url.replace('#', '');
    qry = q.split('&');
    n = '';
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('p=') != -1) {
            url = url.replace('&'+qry[i], '');
            url = url.replace(qry[i], '');
            break;
        }
    }
    
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('lim=') != -1) {
            n = qry[i];
            url = url.replace(n, 'lim='+lim);
            window.location.replace(url);
            return;
        }
    }
    if (url.indexOf('?') == -1) {
        url = url+'?';
    }
    newUrl = url+'&lim='+lim;
    window.location.replace(newUrl);
    
});

$('[id^=sort]').click(function (){
    sort = $(this).attr('id').substring('sort'.length);
    url = document.URL;
    url = url.replace('#', '');
    qry = q.split('&');
    n = '';
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('sort=') != -1) {
            n = qry[i];
            url = url.replace(n, 'sort='+sort);
            window.location.replace(url);
            return;
        }
    }
    if (url.indexOf('?') == -1) {
        url = url+'?';
    }
    newUrl = url+'&sort='+sort;
    window.location.replace(newUrl);
    //console.log(newUrl);
});

$(document).ready(function (){
    sortNow = $('[id^="odNow"]')[0]['id'];
    sortId = "sort"+sortNow.substring('odNow'.length);
    sortVal = $("#"+sortId).html();
    
    $('#'+sortNow).html(sortVal);
    console.log(sortVal);
});

