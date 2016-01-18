
var submitBtn = $("#submitBtn");

con = new Array(4);

function validateForm() {
    pwd = $('#password');
    
    /*
    if (pwd.val() == '') {
        $('#msg').html('กรุณาใส่ รหัสผ่าน');
        return;
    }*/
    
    newPwd = $("#newPwd");
    newConPwd = $("#newPwdConfirm");
    if (newPwd.val() != '') {
        if (newPwd.val().length >= 8 && newPwd.val().length <= 32) {
            if (has_space(pwd.val())) {
                $('#msg').html('รหัสผ่าน ห้ามมีเว้นวรรค');
                return;
            }
        }else{
            $('#msg').html('รหัสผ่าน ต้องมี 8 ถึง 32 ตัวอักษร');
            return;
        }
    }
    
    
    if (newPwd.val() != newConPwd.val()) {
        $('#msg').html('กรุณาใส่ ยืนยันรหัสผ่านใหม่ ให้ตรงกับ รหัสผ่านใหม่');
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
        $('#msg').html('email นี้ถูกใช้แล้ว');
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
    
    $('#editForm').submit();
}

$('#photo').change(function (){
    //alert(JSON.stringify($(this)[0]));
    readImage($(this)[0].files[0]);
});

function readImage(file) {
    if (file == null) {
        con[1] = 1;
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
    if (e.val() == $('#nowEmail').val()) {
        $('#msgemail').html('');
        con[2] = 1;
        return;
    }
    if (e.val().indexOf('@') != -1) {
        param = {
            'type' : 'email',
            'name' : e.val()
        }
        $.ajax({
            type: "POST",
            url: window.location.protocol+"//"+hostname+"/shop/check_uqname",
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

submitBtn.click(function (){
    validateForm();
});

function has_space(word){
    if (word.indexOf(' ') != -1) {
        return true;
    }
    return false;
}