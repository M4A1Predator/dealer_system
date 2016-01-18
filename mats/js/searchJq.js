var url = document.URL;
var q = location.search.substring(1);

$('.searchBtn').click(function (){
    keyword = $('#searchKeyword').val();
    url = document.URL;
    url = url.replace('#', '');
    qry = q.split('&');
    n = '';
    for(i=0;i<qry.length;i++){
        if (qry[i].indexOf('keyword=') != -1) {
            n = qry[i];
            url = url.replace(n, 'keyword='+keyword);
            window.location.replace(url);
            return;
        }
    }
    if (url.indexOf('?') == -1) {
        url = url+'?';
    }
    //newUrl = url+'&keyword='+keyword;
    newUrl = window.location.protocol+"//"+hostname+"/shop/product?"+q+'&keyword='+keyword;
    window.location.replace(newUrl);
    //console.log(newUrl);
});