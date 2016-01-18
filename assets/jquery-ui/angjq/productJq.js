var url = document.URL;
url = url.replace('#', '');
var q = location.search.substring(1);
console.log(removePage(url));
$('.pBtn').click(function (){
    p = $(this).html();
    //alert(p);
    posQ = url.indexOf('?');
    next = '';
    if (posQ != -1) {
        posP = url.indexOf('p=', posQ);
        if (posP != -1) {
            //console.log('found p=');
            posA = url.indexOf('&', posP);
            if (posA != -1) {
                //console.log('found &');
                sub1 = url.substring(posP, posA);
                next = url.replace(sub1, 'p='+p);
            }else{
                sub1 = url.substring(posP, url.length);
                next = url.replace(sub1, 'p='+p);
            }
        }else{
            next = url+"&p="+p;
        }
    }else{
        next = url+"?p="+p;
    }
    window.location.replace(next);
});

$('.catBtn').change(function (){
    url = removePage(url);
    c = $(this).val();
    
    posQ = url.indexOf('?');
    if (posQ != -1) {
        posC = url.indexOf('cat=');
        if (posC != -1) {
            console.log('found cat=');
            posA = url.indexOf('&', posC);
            if (posA != -1) {
                console.log('found &=');
                sub1 = url.substring(posC, posA);
                next = url.replace(sub1, 'cat='+c);
            }else{
                sub1 = url.substring(posC, url.length);
                next = url.replace(sub1, 'cat='+c);
            }
        }else{
            next = url+"&cat="+c;
        }
    }else{
        next = url+"?cat="+c;
    }
    window.location.replace(next);
});

$('.bBtn').change(function (){
    url = removePage(url);
    b = $(this).val();
    posQ = url.indexOf('?');
    if (posQ != -1) {
        posB = url.indexOf('b=');
        if (posB != -1) {
            posA = url.indexOf('&', posB);
            if (posA != -1) {
                sub1 = url.substring(posB, posA);
                next = url.replace(sub1, 'b='+b);
            }else{
                sub1 = url.substring(posB, url.length);
                next = url.replace(sub1, 'b='+b);
            }
        }else{
            next = url+"&b="+b;
        }
    }else{
        next = url+"?b="+b;
    }
    window.location.replace(next);
});

$('#searchNameBtn').click(function (){
    searchName();
});

$('#pName').bind('keypress', function (e){
    if (e.keyCode == 13) {
        searchName();
    }
});

function searchName(){
    name = $('#pName').val();
    pn = 'name=';
    url = removePage(url);
    gets = q.split('&');
    console.log(gets);
    n = '';
    next = url;
    for (i=0;i<gets.length;i++) {
        if ( gets[i].substring(0, pn.length) == pn ) {
            //console.log(gets[i].substring(0, pn.length));
            n = gets[i];
            if (i > 0) {
                n = '&'+n;
            }
            url = url.replace(n, '');
            break;
        }
    }
    
    if (url.indexOf('?') == -1) {
        url = url + '?';
    }
    next = url+'&name='+name;
    
    window.location.replace(next);
}

function removePage(url){
    gets = q.split('&');
    p = '';
    for(i=0;i<gets.length;i++) {
        if ( (gets[i].substring(0, 2)) == 'p=' ) {
            p = gets[i];
            if (i > 0) {
                p = '&'+p;
            }
            break;
        }
    }
    return url.replace(p, '');
}

//---------------------------

var rmId = -1;

function setRmId(id) {
    rmId = id;
}

$('.rmBtn').click(function() {
    rmProduct(rmId);
});

function rmProduct(id) {
    param = {
        'pid' : id,
    }
    $.ajax({
      type: "POST",
      url: "product/remove",
      data: param
    }).done(function (data){
        if (data > 0) {
            //alert(data)
            location.reload();
        }else{
            alert('ไม่สามารถลบได้');
        }
    }).fail(function (e){
        console.log(JSON.stringify(e));
    });
    rmId = -1;
}

var pauseId = -1;
function setPauseId(id){
    pauseId = id;
}

$('.pauseBtn').click(function (){
    //console.log(pauseId);
    pauseProduct(pauseId);
});

function pauseProduct(id){
    param = {
        'pid' : id
    }
    $.ajax({
      type: "POST",
      url: "product/pause",
      data: param
    }).done(function (data){
        if (data > 0) {
            //alert(data)
            location.reload();
        }else{
            alert('ไม่สามารถหยุดจำหน่ายได้');
        }
    }).fail(function (e){
        console.log(JSON.stringify(e));
    });
}
