$(document).ready(function () {
    getUserdetailByid();
    var id = $('#user_id').val();

    var studentDropzone = new Dropzone("#userimage", {
        url: "index.php?r=orgusers/uploadusserprofilepic&id=" + id + "",
        clickable: '#profilepic',
        previewTemplate: '<div style="display:none"></div>'
    });
    studentDropzone.on("addedfile", function (file) {
        $('#progressimage').removeClass('hide');
    });
    studentDropzone.on("uploadprogress", function (file, progress, bytesSent) {
        $('#progressimage').attr('value', progress);
        $('#progressimage').html(bytesSent + ' bytes');
    });
    studentDropzone.on("complete", function (file) {
        $('#progressimage').addClass('hide');
        getUserbyid($('#user_id').val());
    });
    getUserbyid(id);
var baseUrl = (window.location).href; // You can also use document.URL
var id = baseUrl.substring(baseUrl.lastIndexOf('=') + 1);
if(!id){
    alert(1)
}
}); // end document.ready

function getUserid() {
    var obj = new Object();
    obj.id = $('#user_id').val();
    alertify.confirm("Are you sure you want to delete this image?",
            function () {
                $.ajax({
                    url: "index.php?r=orgusers/deleteuserprofilepic",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        location.reload();
                    }
                });
            });
}

function getUserbyid(id) {
    var id = $('#user_id').val();
    var obj = new Object();
    obj.id = id;
    $.ajax({
        url: "index.php?r=orgusers/getempbyid",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            $('#userimage').attr('src', 'index.php?r=orgusers/linkuserimage&id=' + data.data.id);
            if (data.data.image === '/resources/users/no_image.jpg') {
                $('#picid').hide();
                $('#picid').css('display', 'none');
            } else {
                $('#picid').show();
                $('#picid').css('color', '#1f1d1d');
            }
        }
    });
}

function getUserdetailByid() {
    var obj = new Object();
    obj.id = $('#user_id').val();
    $.ajax({
        url: 'index.php?r=users/getuserdetailbyid',
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            var data = JSON.parse(data);
            console.log(data);
            if (data.status == true) {
                createHTML(data);
            }else{
                window.location.href = 'index.php?r=dashboard/error';
            }
        }
    });
}
function createHTML(data) {
    var html = '';
    html += ' <div class="content" >';
    html += '<form name="form" >';
    html += ' <div class="row">';
    html += '<div class="col-md-12 ">';
    html += ' <div class="form-group" >';
    html += ' <label>Full name:<span class="asterik">*</span>';
    html += ' <span  class="errmsg" id="err-fullname"></span> </label>';
    html += '<input type="text" class="form-control border-input input-sm" value="' + formattedText(data.fullname) + '"  name="fullname" id="fullname"  placeholder="Full Name" required/>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="row">';
    html += '<div class="col-md-6">';
    html += '<div class="form-group">';
    html += '<label>Username:<span class="asterik">*</span>';
    html += ' <span  class="errmsg" id="err-username"></span> </label>';
    html += '<input type="text" class="form-control border-input input-sm" name="username" value="' + formattedText(data.username) + '" id="username" placeholder="Username">';
    html += '</div>';
    html += ' </div>';
    html += '<div class="col-md-6 ">';
    html += '<div class="form-group" >';
    html += '<label>Email:<span class="asterik">*</span>';
    html += ' <span  class="errmsg" id="err-email"></span> </label>';
    html += '<input type="text" class="form-control border-input input-sm" disabled  name="email" value="' + formattedText(data.email) + '" id="email"  required placeholder="Email">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="row">';
    html += '<div class="col-md-12">';
    html += '<div class="form-group" >';
    html += '<label>Phone:<span class="asterik">*</span>';
    html += ' <span  class="errmsg" id="err-phone"></span> </label>';
    html += '<input type="email" class="form-control border-input" name="phone" value="' + formattedText(data.phone) + '" id="phone"  required placeholder="phone">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="text-center">';
    html += '<button type="button" onclick="saveUpdateuser();"  class="btn btn-info btn-fill btn-wd">Save</button>';
    html += '</div>';
    html += ' <div class="clearfix"></div>';
    html += '</form>';
    html += '</div>';
    $('#editUser').html(html);
}
function formattedText(text) {
    return (text == null || text == '') ? '' : text.trim();
}
function saveUpdateuser() {
    var id = $('#user_id').val();
    if (validateUser()) {
        alertify.confirm("Are you sure you want update this user?",
                function () {
                    var obj = new Object();
                    obj.id = id;
                    obj.fullname = $('#fullname').val();
                    obj.username = $('#username').val();
                    obj.phone = $('#phone').val();
                    obj.email = $('#email').val();
                    $.ajax({
                        url: 'index.php?r=users/updateuser',
                        async: false,
                        data: obj,
                        type: 'POST',
                        success: function (data) {
                        }
                    });
                });
    }
}
function validateUser() {
    var flag = true;
    var fullname = $('#fullname').val();
    var username = $('#username').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    if (fullname == '') {
        $('#err-fullname').html('Fullname required');
        flag = false;
    } else {
        $('#err-fullname').html('');
    }
    if (username == '') {
        $('#err-username').html('Username required');
        flag = false;
    } else {
        $('#err-username').html('');
    }
    if (phone == '') {
        $('#err-phone').html('Phone no. required');
        flag = false;
    } else {
        $('#err-phone').html('');
        if (((phone.length) > 10) || ((phone.length) < 10)) {
            $('#err-phone').html('10 Digit mobile number required');
            flag = false;
        }
        if (isNaN(phone)) {
            $('#err-phone').html('Must be numerical');
            flag = false;
        }
    }
    if (email == '') {
        $('#err-email').html('Email required');
        flag = false;
    } else {
        $('#err-email').html('');
        if (!reg.test(email)) {
            $('#err-email').html(' Valid email required');
            flag = false;
        }
    }

    return flag;
}