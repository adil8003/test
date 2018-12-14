$(document).ready(function () {
    $('#student-password').keyup(function () {
        var len = $('#student-password').val().length;
        if (len <= 4) {
            $('#err-student-password').text('Weak');
            $('#err-student-password').addClass('pass_weak');
            $('#err-student-password').removeClass('pass_good');
            $('#err-student-password').removeClass('pass_strong');
        } else if (len <= 8) {
            $('#err-student-password').text('Good');
            $('#err-student-password').addClass('pass_good');
            $('#err-student-password').removeClass('pass_weak');
            $('#err-student-password').removeClass('pass_strong');
        } else {
            $('#err-student-password').text('Strong');
            $('#err-student-password').addClass('pass_stong');
            $('#err-student-password').removeClass('pass_weak');
            $('#err-student-password').removeClass('pass_strong');
        }
    })
});

function saveStudent() {
    if (validateStudent()) {
        var obj = new Object();
        obj.name = $('#student-name').val();
        obj.email = $('#student-email').val();
        obj.password = $('#student-password').val();
        $.ajax({
            url: 'index.php?r=site/savestudent',
            async: false,
            data: obj,
            type: 'POST',
            success: function (response) {
                data = JSON.parse(response);
                if (data.status == true) {
                    $('#modal-register').modal('hide');
                    $('#student-name').val('');
                    $('#student-email').val('');
                    $('#student-password').val('');
                    $('#student-confirmPassword').val('');
                }
            }
        });
    }
}
function validateStudent() {
    var flag = true;
    var name = $('#student-name').val();
    var email = $('#student-email').val();
    var password = $('#student-password').val();
    var confirmPassword = $('#student-confirmPassword').val();
    var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (name == '') {
        $('#err-student-name').html('Please enter name');
        flag = false;
    } else {
        $('#err-student-name').html('');
    }
    if (password == '') {
        $('#err-student-password').html('Please enter password');
        flag = false;
    } else {
        $('#err-student-password').html('');
    }
    if (confirmPassword == '') {
        $('#err-student-confirmPassword').html('Please enter confirm password');
        flag = false;
    } else {
        $('#err-student-confirmPassword').html('');
    }
    if (password != confirmPassword) {
        $('#err-student-confirmPassword').html('Passwords do not match.');
        flag = false;
    }
    if (email == '') {
        $('#err-student-email').html('Please enter email ID');
        flag = false;
    } else {
        $('#err-student-email').html('');
        if (!reg.test(email)) {
            $('#err-student-email').html('Not a valid e-mail ID ');
            flag = false;
        } else {
            if (checkEmail()) {
                flag = false;
            }
        }
    }
    return flag;
}
function checkEmail() {
    var input_value = $('#student-email').val();
    $.ajax({
        url: 'index.php?r=site/checkemailid',
        type: 'POST',
        data: {
            email_check: input_value
        },
        success: function (response) {
            data = JSON.parse(response);
            if (data.status == true) {
                $('#err-student-email').text('Enter valid email ID..!');
                $('#err-student-email').fadeToggle();
            }
        }
    });
}
//function forgotEmail() {
//        var input_value = $('#student-email1').val();
//        $.ajax({
//            url: 'index.php?r=site/checkemailid',
//            type: 'POST',
//            data: {
//                email_check: input_value
//            },
//            success: function (response) {
//                data = JSON.parse(response);
//                console.log(data);
//                if (data.status == false) {
//                    $('#student-err-email1').text('Please enter valid email Id');
//                }else{
//                    $('#student-err-email1').text('');
//                }
//            }
//        });
//}
//function forgotEmail1() {
//    var input_value1 = $('#student-newpassword').val();
//    var input_value2 = $('#student-retype').val();
//    if (input_value1 != input_value2) {
//        $('#student-err-retype').text('Please check your password');
//    } else {
//        var obj = new Object();
//        obj.email = $('#student-email1').val();
//        obj.password = $('#student-newpassword').val();
//        $.ajax({
//            url: 'index.php?r=site/savenewpassword',
//            async: false,
//            data: obj,
//            type: 'POST',
//            success: function (response) {
//                data = JSON.parse(response);
//                if (data.status == true) {
//                    $('#myModal').modal('hide');
//
//                }
//            }
//        });
//
//    }
//}