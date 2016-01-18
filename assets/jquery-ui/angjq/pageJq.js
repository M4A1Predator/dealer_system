$('.pageBtn').click(function (){
    p = $(this).html();
    url = document.URL;
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
    param = {
        'id' : rmId,
    }
    $.ajax({
        type: "POST",
        url: type+"/remove",
        data: param
    }).done(function (data){
        if (data == 1) {
            window.location.reload();
        }else{
            alert('ไม่สามารถบลได้');
        }
    }).fail(function (e){
        console.log(JSON.stringify(e));
    });
});


