$('.pageBtn').click(function (){
    p = $(this).html();
    url = document.URL;
    url = url.replace('#', '');
    posPath = url.lastIndexOf('/');
    if (url.indexOf('?', posPath) != -1) {
        url = url.substring(0, url.indexOf('?', posPath));
    }
    //alert(url+"?page="+p);
    newUrl = url+"?page="+p;
    window.location.replace(newUrl);
});

var rmId = -1;
var type = '';

function setRemove(id, type){
    rmId = id;
    this.type = type;
}

$('.rmBtn').click(function (){
    protocol = window.location.protocol;
    hostname = window.location.hostname;
    param = {
        'id' : rmId,
        'type' : type
    }
    $.ajax({
        type: "POST",
        url: protocol+"//"+hostname+"/admin/"+type+"/remove",
        data: param
    }).done(function (data){
        if (data == 1 || data == 'removed') {
            window.location.reload();
        }else{
            alert('ไม่สามารถลบได้');
        }
    }).fail(function (e){
        console.log(JSON.stringify(e));
    });
});


