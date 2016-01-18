var protocol = window.location.protocol;
var hostname = window.location.hostname;
var uq;

function checkAddForm() {
    username = $('#adminName').val();

    if (username.length < 4) {
        $('#msg').html('username ต้องมีความยาวขั้นต่ำ 4 ตัวอักษร');
        return;
    }
    
    if (username.indexOf(' ')) {
        $('#msg').html('username ต้องประกอบด้วยตัวอักษรหรือเครื่องหมายเท่านั้น');
    }

    pwd = $('#password').val();
    pwdCon = $('#passwordConfirm').val();
    if (pwd.length < 6 ) {
        $('#msg').html('รหัสผ่านขั้นต่ำ 6 ตัวอักษร');
        return;
    }
    
    if (pwd != pwdCon) {
        $('#msg').html('ยืนยันรหัสผ่านไม่ถูกต้อง');
        return;
    }
    $('#msg').html('');
    $('#addAdminForm').submit();
}

function checkEditForm() {
    
    pwd = $('#password').val();
    newPwd = $('#newPassword').val();
    pwdCon = $('#newPasswordConfirm').val();
    if (newPwd != '') {
        if (newPwd.length < 6 ) {
            $('#msg').html('รหัสผ่านใหม่ขั้นต่ำ 6 ตัวอักษร');
            return;
        }
        
        if (newPwd.indexOf(' ') != -1) {
            $('#msg').html('รหัสผ่านห้ามมี เว้นวรรค');
            return;
        }
        
        if (newPwd != pwdCon) {
            $('#msg').html('กรุณาใส่ยืนยันรหัสผ่านให้ตรงกับรหัสผ่าน');
            return;
        }
    }
    
    if (pwd == '') {
        $('#msg').html('กรุณาใส่รหัสผ่านปัจจุบัน');
        return;
    }
    $('#msg').html('');
    $('#editAdminForm').submit();
}

function checkUqName(username) {
    $.ajax({
        type: "POST",
        url: protocol+"//"+hostname+"/admin/check_admin_name",
        data: {type: "username", name: username},
        //async:false
    }).success(function (data){
        
    });
}