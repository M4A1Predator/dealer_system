url = Document.URL;
hostname = window.location.hostname;
protocol = window.location.protocol;

function saveDetail() {
    contact = $('#contactNote').summernote('code');
    about = $('#aboutNote').summernote('code');
    
    param = {
        'type' : 'contact',
        'contact' : contact,
        'about' : about,
    }
    
    $.ajax({
        type: 'POST',
        url: protocol+"//"+hostname+"/admin/detail/edit_contact",
        data: param,
    }).done(function (data){
        //console.log(data);
        window.location.reload();
    }).fail(function (data){
        //console.log(data);
    });
    
}

function saveSuggest() {
    contact = $('#qaNote').summernote('code');
    about = $('#suggestNote').summernote('code');
    
    param = {
        'type' : 'suggest',
        'qa' : contact,
        'suggest' : about,
    }
    
    $.ajax({
        type: 'POST',
        url: protocol+"//"+hostname+"/admin/detail/edit_contact",
        data: param,
    }).done(function (data){
        //console.log(data);
        window.location.reload();
    }).fail(function (data){
        //console.log(data);
    });
}

function saveBuyDetail() {
    buy = $('#buyNote').summernote('code');
    ship = $('#shipNote').summernote('code');
    
    param = {
        'type' : 'buy',
        'buy' : buy,
        'ship' : ship,
    }
    
    $.ajax({
        type: 'POST',
        url: protocol+"//"+hostname+"/admin/detail/edit_detail",
        data: param,
    }).done(function (data){
        console.log(data);
        window.location.reload();
    }).fail(function (data){
        //console.log(data);
    });
    
}