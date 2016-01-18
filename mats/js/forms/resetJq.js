
$('#submitBtn').click(function (){
    pwd = $('#password');
    pwdCon = $('#passwordConfirm');
    msg = $('#msg');
    if (pwd.val() == '' || pwd.val().length < 8 || pwd.val().length > 32) {
        msg.html('รหัสผ่านต้องมีความยาวระหว่าง 8 ถึง 32 ตัวอักษร');
        return;
    }
    if (has_space(pwd.val())) {
        msg.html('รหัสผ่านห้ามมีเว้นวรรค');
        return;
    }
    
    if (pwd.val() != pwdCon.val()) {
        msg.html('กรุณากรอกยืนยันรหัสผ่านให้ตรงกับรหัสผ่าน');
        return;
    }
    
    $('#resetForm').submit();
    
});

function has_space(word){
    if (word.indexOf(' ') != -1) {
        return true;
    }
    return false;
}