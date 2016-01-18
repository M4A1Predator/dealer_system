var submitBtn = $("#submitBtn");
var curName = $("#username").val();
var curEmail = $('#email').val();

var attr = new Array(9);
for(i=0;i<attr.length;i++){
        attr[i] = 1;
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
                url: "../../check_uqname",
                data: param
            }).done(function (data){
                res = data;
                if (res == 0 && username.val() != curName ) {
                    $('#msgusername').html('ชื่อนี้ถูกใช้แล้ว');
                }else{
                    $('#msgusername').html('');
                    attr[0] = 1;
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
    attr[0] = 0;
    can_send();
});

$('#password').bind('input', function() {
    pwd = $(this);
    if ( (pwd.val().length >= 8 && pwd.val().length <= 32) || pwd.val() == '') {
        if (!has_space(pwd.val())) {
            $('#msgpassword').html('');
            attr[1] = 1;
            can_send();
            return;
        }else{
            $('#msgpassword').html('ห้ามมีเว้นวรรค');
        }
    }else{
        $('#msgpassword').html('ความยาว 8 ถึง 32 ตัวอักษร');
    }
    
    attr[1] = 0;
    can_send();
});

$('#name').bind('input', function (){
    n = $(this);
    if (n.val().trim() != '') {
        $('#msgname').html('');
        attr[2] = 1;
        can_send();
        return;
    }else{
        $('#msgname').html('กรุณาใส่ชื่อ นามสกุล');
    }
    attr[2] = 0;
    can_send();
});

$('#address').change(function (){
    if ($(this).val().trim() != '') {
        attr[3] = 1;
        can_send();
        return;
    }
    attr[3] = 0;
    can_send();
    $('#msgaddress').html('กรุณาใส่ที่อยู่');
});

$('#profile').change(function (){
    //alert(JSON.stringify($(this)[0]));
    readImage($(this)[0].files[0]);
    can_send();
});
function readImage(file) {
    if (file == null) {
        attr[4] = 0;
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
                attr[4] = 1;
                can_send();
                $('#msgprofile').html('');
            }else{
                $('#msgprofile').html('ไฟล์รูปไม่ถูกต้อง');
                attr[4] = 0;
                can_send();
            }
        };
        image.onerror= function() {
            attr[4] = 0;
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
            url: "../../check_uqname",
            data: param
        }).done(function (data){
            res = data;
            if (res == 0 && e.val() != curEmail) {
                $('#msgemail').html('email นี้ถูกใช้แล้ว');
            }else{
                $('#msgemail').html('');
                attr[5] = 1;
                can_send();
                return;
            }
        }).fail(function (e){
        });
    }else{
        $('#msgemail').html('กรุณาใส่ email');
    }
    attr[5] = 0;
    can_send();
});

$('#phone').bind('focusout', function (){
    phone = $(this);
    regexp = '^[a-zA-Z-_]+$';
    if (phone.val().trim() != '') {
        attr[6] = 1;
        can_send();
        $('#msgphone').html('');
        return;
    }
    $('#msgphone').html('กรุณาใส่เบอร์โทรศัพท์');
    attr[6] = 0;
    can_send();
});

$('#line').bind('focusout', function (){
    line = $(this);
    if (line.val().trim() != '') {
        attr[7] = 1;
        can_send();
        $('#msgline').html('');
        return;
    }
    $('#msgline').html('กรุณาใส่ไอดีไลน์');
    attr[7] = 0;
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

function can_send(){
    sum = 0;
    for(i=0;i<attr.length;i++){
        sum += attr[i];
    }
    console.log("sum: "+parseInt(sum));
    if (sum == attr.length) {
        submitBtn.prop('disabled', false);
    }else{
        submitBtn.prop('disabled', true);
    }
}