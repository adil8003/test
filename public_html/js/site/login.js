

function checkPassword() {
    var input_value = $('#password').val();
    $.ajax({
        url: 'index.php?r=site/checkpassword',
        type: 'POST',
        data: {
            password: input_value
        },
        success: function (response) {
            data = JSON.parse(response);
            if (data.status == true) {
            } else {
                $('#err-password').text('Required valid password');
//                $('#loginButton').attr('disabled', 'disabled');
            }
        }
    });
}
function checkEmail() {
    var input_value = $('#email').val();
    $.ajax({
        url: 'index.php?r=site/checkemail',
        type: 'POST',
        data: {
            email: input_value
        },
        success: function (response) {
            data = JSON.parse(response);
            if (data.status == true) {
            } else {
                $('#err-email').text('Required valid email');
                $('#email').focus();
            }
        }
    });
}
function checkPasswordMatch() {
    var password = $("#newpassword").val();
    var confirmPassword = $("#confirmpassword").val();
    if (password != confirmPassword) {
        $("#err-confirmpassword").html("Passwords do not match!  Try Again ")
//                    document.oo.password2.focus();
        return false;
    }
    else {
        $("#err-confirmpassword").html("Passwords match.");
//        $("#err-confirmpassword").css("color", "#2daf62");
        return true;
    }
}
function saveChangePassword() {
    if (checkPasswordMatch()) {
        if (validPasswordandemail()) {
            var obj = new Object();
            obj.email = $('#email').val();
            obj.password = $('#confirmpassword').val();
            $.ajax({
                url: 'index.php?r=site/savenewpassword',
                async: false,
                data: obj,
                type: 'POST',
                success: function (data) {
                    alertify.alert("Password change successfully !!", function () {
                    });
                    setTimeout(function () {
//                        window.location.replace("http://kiwings.aem/index.php?r=site/login");
                    }, 3000);
                }
            });
        }
    }
}
function validPasswordandemail() {
    var flag = true;
    var email = $('#email').val();
    var newpassword = $('#newpassword').val();
    var confirmpassword = $('#confirmpassword').val();

    if (email == '') {
        $('#err-email').html(' Please enter email');
        flag = false;
    }
    if ((email.trim().length) == 0) {
        $('#err-email').html(' Please enter email');
        flag = false;
    } else {
        $('#err-email').html('');
    }
    if (newpassword == '') {
        $('#err-newpassword').html(' Please enter new password');
        flag = false;
    }
    if ((newpassword.trim().length) == 0) {
        $('#err-newpassword').html(' Please enter new password');
        flag = false;
    } else {
        $('#err-newpassword').html('');
    }
    if (confirmpassword == '') {
        $('#err-confirmpassword').html('Please enter  confirm password');
        flag = false;
    }
    if ((confirmpassword.trim().length) == 0) {
        $('#err-confirmpassword').html(' Please enter  confirm password');
        flag = false;
    } else {
        $('#err-confirmpassword').html('');
    }

    return flag;
}
