var fullPrice = $('#fullPrice');
var vipPercent = $('[name^="vipPercent"]');
var vipPrice = $('[name^="vipPrice"]');
//-------------------------------------
var submitBtn = $('#submitBtn');
submitBtn.prop('disabled', false);

var com = new Array(6);
var imgAll = new Array(3);
for (i=0;i<imgAll.length;i++) {
    imgAll[i] = 1;
}

for (i=0;i<com.length;i++) {
    com[i] = 1;
}

can_send();

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

$('#productName').bind('input', function(){
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

/*
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
*/
com[4] = 1;

$('[id^=photoProduct]').bind('change', function (){
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
            if(allowExt.indexOf(ext) != -1){
                $("#msg"+id).html('');
            }else{
                $("#msg"+id).html('ไฟล์รูปไม่ถูกต้อง');
            }
        };
        image.onerror= function() {
            $("#msg"+id).html('ไฟล์รูปไม่ถูกต้อง');
        };
    };
    
    can_send();
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
    imgSum = 0;
    for(i=0;i<com.length;i++){
        sum += com[i];
    }
    
    for(i=0;i<imgAll.length;i++){
        imgSum += imgAll[i];
    }
    
    if (sum == com.length && imgSum == imgAll.length) {
        submitBtn.prop('disabled', false);
    }else{
        submitBtn.prop('disabled', true);
    }
    console.log(sum+" "+imgSum);
}

function submitEditForm() {
    detail = $('#detailProductNote').summernote('code').trim();
    if (detail == null || detail == '') {
        detail = '-';
    }
    $('#detailProduct').val(detail);
    //console.log($('[name=detailProduct]').val());
    $('#productForm').submit();
}

function validField(val){
    return val.length == 0
}

//------------
initPercent();
function initPercent() {
    pp = $('[id^=pp]');
    console.log(pp.length);
    for(var i=0;i<pp.length;i++){
        id = pp[i]['id'].substring(2);
        console.log(id);
        changePercent('pm'+id);
    }
}
