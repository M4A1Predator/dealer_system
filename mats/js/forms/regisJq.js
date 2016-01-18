
var submitBtn = $("#submitBtn");

con = new Array(4);

function validateForm() {
    
    if (con[0] == 0) {
        /*
        if($("#username").val == ''){
            $('#msg').html('กรุณาใส่ username');
        }*/
        $('#msg').html('ไม่สามารถใช้ username นี้ได้');
        return;
    }
    
    pwd = $("#password");
    conPwd = $("#passwordConfirm");
    if (pwd.val().length >= 8 && pwd.val().length <= 32) {
        if (has_space(pwd.val())) {
            $('#msg').html('password ห้ามมีเว้นวรรค');
            return;
        }
    }else{
        $('#msg').html('password ต้องมี 8 ถึง 32 ตัวอักษร');
        return;
    }
    
    if (pwd.val() != conPwd.val()) {
        $('#msg').html('กรุณาใส่ confirm password ให้ตรงกับ password');
        return;
    }
    //-----------------
    readImage($('#photo')[0].files[0]);
    console.log(con[1]);
    if (con[1] == 0) {
        $('#msg').html('ไฟล์รูปไม่ถูกต้อง');
        return;
    }
    //-----------------
    fname = $('#firstname');
    sname = $('#lastname');
    if (fname.val().trim() == '' || sname.val().trim() == '') {
        $('#msg').html('กรุณาใส่ ชื่อ และ นามสกุล');
        return;
    }
    //------------------
    address = $('#address');
    if (address.val().trim() == '') {
        $('#msg').html('กรุณาที่อยู่');
        return;
    }
    
    if (con[2] == 0) {
        $('#msg').html('ไม่สามารถใช้ email นี้ได้');
        return;
    }
    
    tel = $('#tel');
    if (tel.val().trim() == '') {
        $('#msg').html('กรุณาใส่เบอร์โทรติดต่อ');
        return;
    }
    
    line = $('#line');
    if (line.val().trim() == '') {
        $('#msg').html('ไอดี line');
        return;
    }
    
    shopname = $('#shopname');
    if (shopname.val().trim() == '') {
        $('#msg').html('กรุณาใส่ชื่อร้านค้า');
        return;
    }
    
    accept = $('#accept');
    console.log(accept.is(":checked"));
    if (!accept.is(":checked")) {
        $('#msg').html('กรุณายอมรับข้อตักลง');
        return;
    }
    
    $('#regisForm').submit();
}

//$("#username").bind('input', function (){
$("#username").on('input', function (){
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
                    //console.log('username');
                    $('#msgusername').html('');
                    con[0] = 1;
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
    con[0] = 0;
});


$('#photo').change(function (){
    //alert(JSON.stringify($(this)[0]));
    readImage($(this)[0].files[0]);
});

function readImage(file) {
    if (file == null) {
        con[1] = 0;
        
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
                con[1] = 1;
            }else{
                $('#msg').html('ไฟล์รูปไม่ถูกต้อง');
                con[1] = 0;
            }
        };
        image.onerror= function() {
            con[1] = 0;
            $('#msg').html('ไฟล์รูปไม่ถูกต้อง');
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
                con[2] = 1;
                
                return;
            }
        }).fail(function (e){
        });
    }else{
        $('#msgemail').html('กรุณาใส่ email');
    }
    con[2] = 0;
    
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
        con[7] = 1;
        
        $('#msgphone').html('');
        return;
    }
    $('#msgphone').html('กรุณาใส่เบอร์โทรศัพท์');
    con[7] = 0;
    
});

$('#line').bind('focusout', function (){
    line = $(this);
    if (line.val().trim() != '') {
        con[8] = 1;
        
        $('#msgline').html('');
        return;
    }
    $('#msgline').html('กรุณาใส่ไอดีไลน์');
    con[8] = 0;
    
});

$('#shopname').bind('input', function(){
    sn = $(this);
    if (sn.val().trim() != '') {
        con[9] = 1;
        $('#msgshopname').html('');
        return;
    }
    $('#msgshopname').html('กรุณาใส่ชื่อร้าน');
    con[9] = 0;
});

submitBtn.click(function (){
    validateForm();
});

function has_space(word){
    if (word.indexOf(' ') != -1) {
        return true;
    }
    return false;
}