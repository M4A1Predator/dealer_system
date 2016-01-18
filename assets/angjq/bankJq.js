var rmId;
var protocol = window.location.protocol;
var hostname = window.location.hostname;

function setBankRemove(id){
    rmId = id;
}

function removeBank(){
    param = {
        type : 'bank',
        bid : rmId
    }
    $.ajax({
        type: "POST",
        url: protocol+"//"+hostname+"/admin/bank/remove",
        data: param
    }).success(function (data){
        if (data == 'removed') {
            window.location.reload();
        }
    });
}