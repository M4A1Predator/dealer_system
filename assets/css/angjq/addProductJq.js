
var fullPrice = $('#fullPrice');
var vipPercent = $('[name^="vipPercent"]');
var vipPrice = $('[name^="vipPrice"]');

fullPrice.on('input' ,function(){
    if(isNaN(fullPrice.val())){
        $('#fullPriceMsg').html('ข้อมูลไม่ถูกต้อง');
        $('#submitBtn').prop('disabled', true);
    }else{
        $('#fullPriceMsg').html('');
        $('#submitBtn').prop('disabled', false);
        for (var i=0; i<vipPercent.length ;i++) {
            changePrice($('[name^="vipPercent"]')[i]['id']);
        }
    }
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

console.log("vipPrice count = "+$('[name^="vipPrice"]').length);
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


function validField(val){
    return val.length == 0
}