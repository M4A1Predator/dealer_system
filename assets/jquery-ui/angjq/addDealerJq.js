
var submitBtn = $("#submitBtn");
var usr = false;

submitBtn.prop('disabled', true);

var attr = new Array(13);
for(i=0;i<attr.length;i++){
        attr[i] = 0;
}

$("#username").bind('input', function (){
    username = $(this);
    regexp = '^[a-zA-Z0-9-_]+$';
    if (username.val().length >= 4 && username.val().length <= 32) {
        if (!has_space(username.val()) && username.val().search(regexp) != -1 ) { 
            param = {
                'type' : 'username',
                'name' : username.val()
            }
            $.ajax({
                type: "POST",
                url: "check_uqname",
                data: param
            }).done(function (data){
                res = data;
                if (res == 0) {
                    $('#msgusername').html('ชื่อนี้ถูกใช้แล้ว');
                }else{
                    console.log('username');
                    $('#msgusername').html('');
                    attr[1] = 1;
                    can_send();
                    return;
                }
            }).fail(function (e){
                console.log(JSON.stringify(e));
            });
        }else{
            $('#msgusername').html('สามารถใส่ตัวอักษร, ตัวเลขและ - _ ได้เท่านั้น');
        }
    }else{
        $('#msgusername').html('ความยาว 4 ถึง 32 ตัวอักษร');
    }
    attr[1] = 0;
    can_send();
});

$('#password').bind('input', function() {
    pwd = $(this);
    if (pwd.val().length >= 8 && pwd.val().length <= 32) {
        if (!has_space(pwd.val())) {
            $('#msgpassword').html('');
            attr[2] = 1;
            can_send();
            return;
        }else{
            $('#msgpassword').html('ห้ามมีเว้นวรรค');
        }
    }else{
        $('#msgpassword').html('ความยาว 8 ถึง 32 ตัวอักษร');
    }
    attr[2] = 0;
    can_send();
});

$('#name').bind('input', function (){
    n = $(this);
    if (n.val().trim() != '') {
        $('#msgname').html('');
        attr[3] = 1;
        can_send();
        return;
    }else{
        $('#msgname').html('กรุณาใส่ชื่อ นามสกุล');
    }
    attr[3] = 0;
    can_send();
});

$('#address').change(function (){
    if ($(this).val().trim() != '') {
        attr[4] = 1;
        can_send();
        return;
    }
    attr[4] = 0;
    can_send();
});

$('#profile').change(function (){
    //alert(JSON.stringify($(this)[0]));
    readImage($(this)[0].files[0]);
    can_send();
    
});

function readImage(file) {
    if (file == null) {
        attr[5] = 0;
        can_send();
        return;
    }
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
            if (allowExt.indexOf(ext) != -1) {
                attr[5] = 1;
                can_send();
            }else{
                $('#msgprofile').html('ไฟล์รูปไม่ถูกต้อง');
                attr[5] = 0;
                can_send();
            }
        };
        image.onerror= function() {
            attr[5] = 0;
            can_send();
            $('#msgprofile').html('ไฟล์รูปไม่ถูกต้อง');
            //alert('Invalid file type: '+ file.type);
        };      
    };
}

$('#email').bind('input', function (){
    e = $(this);
    if (e.val().indexOf('@') != -1) {
        param = {
            'type' : 'email',
            'name' : e.val()
        }
        $.ajax({
            type: "POST",
            url: "check_uqname",
            data: param
        }).done(function (data){
            res = data;
            if (res == 0) {
                $('#msgemail').html('email นี้ถูกใช้แล้ว');
            }else{
                $('#msgemail').html('');
                attr[6] = 1;
                can_send();
                return;
            }
        }).fail(function (e){
        });
    }else{
        $('#msgemail').html('กรุณาใส่ email');
    }
    attr[6] = 0;
    can_send();
});

$('#phone').bind('focusout', function (){
    phone = $(this);
    regexp = '^[a-zA-Z-_]+$';
    /*
    if (phone.search(regexp) != -1) {
        
    }else{
        $('#phone')
    }*/
    if (phone.val().trim() != '') {
        attr[7] = 1;
        can_send();
        $('#msgphone').html('');
        return;
    }
    $('#msgphone').html('กรุณาใส่เบอร์โทรศัพท์');
    attr[7] = 0;
    can_send();
});

$('#line').bind('focusout', function (){
    line = $(this);
    if (line.val().trim() != '') {
        attr[8] = 1;
        can_send();
        $('#msgline').html('');
        return;
    }
    $('#msgline').html('กรุณาใส่ไอดีไลน์');
    attr[8] = 0;
    can_send();
});

$('#shopname').bind('input', function(){
    sn = $(this);
    if (sn.val().trim() != '') {
        attr[9] = 1;
        can_send();
        $('#msgshopname').html('');
        return;
    }
    $('#msgshopname').html('กรุณาใส่ชื่อร้าน');
    attr[9] = 0;
    can_send();
});
/*
$('#website').bind('focusout', function(){
    web = $(this);
    if (web.val().trim() != '') {
        attr[10] = 1;
        $('#msgwebsite').html('');
        can_send();
        return;
    }
    $('#msgwebsite').html('กรุณาใส่ลิงค์เว็บ');
    attr[10] = 0;
    can_send();
});

$('#fanpage').bind('focusout', function (){
    fn = $(this);
    if (fn.val().trim() != '') {
        $('#msgfanpage').html('');
        attr[11] = 1;
        can_send();
        return;
    }
    $('#msgfanpage').html('กรุณาใส่ลิงค์แฟนเพจ');
    attr[11] = 0;
    can_send();
});

$('#facebook').bind('focusout', function(){
    fb = $(this);
    if (fb.val().trim() != '') {
        $('#msgfacebook').html('');
        attr[12] = 1;
        can_send();
        return;
    }
    $('#msgfacebook').html('กรุณาใส่ลิงค์เฟซบุ้ค');
    attr[12] = 0;
    can_send();
});

$('#other').bind('input', function(){
    other = $(this);
    if (other.val().trim() != '') {
        $('#msgother').html('');
        attr[13] = 1;
        can_send();
        return;
    }
    $('#msgother').html('กรุณาใส่รายละเอียด');
    attr[13] = 0;
    can_send();
});
*/
function has_space(word){
    if (word.indexOf(' ') != -1) {
        return true;
    }
    return false;
}

function can_send(){
    sum = 0;
    for(i=0;i<attr.length;i++){
        //console.log(attr[i]);
        sum += attr[i];
    }
    console.log("sum: "+parseInt(sum));
    if (sum == 9) {
        submitBtn.prop('disabled', false);
    }else{
        submitBtn.prop('disabled', true);
    }
}