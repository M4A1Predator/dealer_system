
var fullPrice = $('#fullPrice');
var vipPercent = $('[name^="vipPercent"]');
var vipPrice = $('[name^="vipPrice"]');
//-------------------------------------
var submitBtn = $('#submitBtn');
submitBtn.prop('disabled', true);

var com = new Array(7);
for(i=0;i<7;i++){
    com[i] = 0;
}

$('#productCode').bind('focusout', function (){
    code = $(this);
    if (code.val().trim() != '') {
        com[0] = 1;
        $('#msgcode').html('');
        can_send();
        return;
    }
    com[0] = 0;
    $('#msgcode').html('กรุณาใส่รหัสสินค้า');
    can_send();
});

$('#productName').bind('focusout', function(){
   pn = $(this);
   if (pn.val().trim() != '') {
        com[1] = 1;
        $('#msgname').html('');
        can_send();
        return;
    }
    com[1] = 0;
    $('#msgname').html('กรุณาใส่ชื่อสินค้า');
    can_send();
});

$('#brandProduct').change(function (){
    bp = $(this);
    if (bp.val() != '') {
        $('#msgbrand').html('');
        com[2] = 1;
        can_send();
        return
    }
    com[2] = 0;
    $('#msgbrand').html('กรุณาเลือกแบรนด์สินค้า');
    can_send();
});

$('#catagoryProduct').change(function (){
    cp = $(this);
    if (cp.val() != '') {
        com[3] = 1;
        $('#msgcat').html('');
    }else{
        com[3] = 0;
        $('#msgcat').html('กรุณาหมวดหมู่สินค้า');
    }
    can_send();
});

$('#detailProduct').bind('focusout', function (){
    detail = $(this);
    if (detail.val().trim() != '') {
        com[4] = 1;
        $('#msgdetail').html('');
    }else{
        com[4] = 0;
        $('#msgdetail').html('กรุณาใส่รายละเอียดสินค้า');
    }
    can_send();
});

$('[id^=photoProduct]').change(function (){
    imgF = $(this)[0];
    readImage(imgF.files[0], imgF['id']);
});

function readImage(file, id) {
    //--------------------------
    var reader = new FileReader();
    var image  = new Image();
    var allowExt = ['jpeg', 'jpg', 'png', 'gif'];
    
    reader.onloadend = function () {
        preview.src = reader.result;
        can_send();
    }

    reader.readAsDataURL(file);
    reader.onloadend = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            ext = t.split('/')[1];
            //alert(allowExt.indexOf(ext));
            if (allowExt.indexOf(ext) != -1) {
                if (id == 'photoProduct1') {
                    com[5] = 1;
                }
                $("#msg"+id).html('');
            }else{
                if (id == 'photoProduct1') {
                    com[5] = 0;
                }
                $("#msg"+id).html('ไฟล์รูปไม่ถูกต้อง');
            }
        };
        image.onerror= function() {
            if (id == 'photoProduct1') {
                com[5] = 0;
            }
            $("#msg"+id).html('ไฟล์รูปไม่ถูกต้อง');
            //alert('Invalid file type: '+ file.type);
        };
    };
}

fullPrice.on('input' ,function(){
    if(isNaN(fullPrice.val())){
        $('#fullPriceMsg').html('ข้อมูลไม่ถูกต้อง');
        $('#submitBtn').prop('disabled', true);
        com[6] = 0;
    }else{
        $('#fullPriceMsg').html('');
        $('#submitBtn').prop('disabled', false);
        for (var i=0; i<vipPercent.length ;i++) {
            changePrice($('[name^="vipPercent"]')[i]['id']);
        }
        com[6] = 1;
    }
    can_send();
});

$('[name^="vipPercent"]').on('input', function(){
    if ( isNaN($(this).val()) ) {
        $("#msgPp"+($(this).attr('id').substr(2))).html('ข้อมูลไม่ถูกต้อง');
    }else{
        $("#msgPp"+($(this).attr('id').substr(2))).html('');
    }
    changePrice($(this).attr('id'));
});
$('[name^="vipPrice"]').on('input' ,function(){
    if ( isNaN($(this).val()) ) {
        $("#msgPm"+($(this).attr('id').substr(2))).html('ข้อมูลไม่ถูกต้อง');        
    }else{
        $("#msgPm"+($(this).attr('id').substr(2))).html('');
    }
    changePercent($(this).attr('id'));
});

//console.log("vipPrice count = "+$('[name^="vipPrice"]').length);
/*
$('#submitBtn').click(function (){
    for (var i=0;i<vipPrice.length;i++) {
        if (vipPrice[i]['value'] != '' && isNaN(vipPrice[i]['value'])) {
            alert(vipPrice[i]['value']);
            return;
        }
    }
    for (var i=0;i<vipPercent.length;i++) {
        if (vipPercent[i]['value'] != '' && isNaN(vipPercent[i]['value'])) {
            return;
        }
    }
    
    $('#productForm').validate(function (){alert('valid');});
});*/

function changePrice(id){
    percent = $('#'+id);
    price = $('#pm'+id.substr(2));
    if (percent.val()=='' || isNaN(percent.val()) || !validFp() ) {
        price.val('');
        return;
    }
    $("#msgPp"+id.substr(2)).html('');
    
    fpInt = parseFloat(fullPrice.val());
    pInt = parseFloat(percent.val());
    
    newPrice = fpInt-((pInt/100)*fpInt);
    //console.log(newPrice);
    price.val(newPrice.toFixed(2));
    $("#msgPm"+id.substr(2)).html('');
    //$('#fullPriceMsg').html(percent.val());
}

function changePercent(id){
    percent = $('#pp'+id.substr(2));
    price = $('#'+id);
    if (price.val()=='' || isNaN(price.val()) || !validFp() ) {
        percent.val('');
        return;
    }
    fpInt = parseFloat(fullPrice.val());
    pInt = parseFloat(price.val());
    
    newPercent = (fpInt-pInt)/fpInt * 100;
    percent.val(newPercent.toFixed(2));
    $("#msgPp"+id.substr(2)).html('');
}

function validFp(){
    if (isNaN(fullPrice.val()) || fullPrice.val().length==0 || parseInt(fullPrice.val()) <= 0) {
        return false;
    }
    return true;
}

function can_send(){
    sum = 0;
    for(i=0;i<com.length;i++){
        sum += com[i];
    }
    if (sum == com.length) {
        submitBtn.prop('disabled', false);
    }else{
        submitBtn.prop('disabled', true);
    }
    console.log(sum);
}


function validField(val){
    return val.length == 0
}