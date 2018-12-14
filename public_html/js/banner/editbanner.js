$(document).ready(function () {
    var id = $('#banner_id').val();
    var studentDropzone = new Dropzone("#bannerImages", {
        url: "index.php?r=banner/uploadbanner&id=" + id + "",
        success: function (file,response) {
            if (response === '{"status":false,"data":"error img size"}') {
                $('#err-file').html('image size must be 1680 x 700 pixels.');
            } else if(response === '{"status":true,"msg":"save successfully."}'){
                $('#err-file').hide();
            }
        },
        clickable: '#profilepic',
        previewTemplate: '<div style="display:none"></div>',

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
        getUserImagebyid($('#banner_id').val());
    });
    getUserImagebyid(id);

})

function deleteUserImage() {
    var obj = new Object();
    obj.id = $('#banner_id').val();
    alertify.confirm("Are you sure you want to delete this image?",
            function () {
                $.ajax({
                    url: "index.php?r=banner/deletebannerimg",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        getUserImagebyid(obj.id);
                        if (data.status) {
                            showMessage('success', 'Banner image is deleted.');
                        } else {
                            showMessage('danger', 'Please try again.');
                        }
                    }
                });
            });
}
function getUserImagebyid(id) {
    var obj = new Object();
    obj.id = id;
    $.ajax({
        url: "index.php?r=banner/getbannerimagebyid",
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                $('#bannerpic').attr('src', 'index.php?r=banner/linkbannerimage&id=' + data.data.id);
//                console.log(data.data.image)
                if (data.data.bannerimg.indexOf('/resources/users/no_image.jpg') > -1) {
                    $('#picid').hide('hide');
                    $('#picid').css('display', 'none');
                } else {
                    $('#picid').show();
                    $('#picid').css('color', '#1f1d1d');
                }
            } else {

            }

        }
    });
}


function updateBanner() {
    if (validateBanner()) {
        alertify.confirm("Are you sure you want update this banner?",
                function () {
                    var obj = new Object();
                    obj.id = $('#banner_id').val();
                    obj.subtitle = $('#subtitle').val();
                    obj.title = $('#title').val();
                    obj.statusid = $('#statusid').val();
                    $.ajax({
                        url: 'index.php?r=banner/updatebanner',
                        async: false,
                        data: obj,
                        type: 'POST',
                        success: function (data) {
                            showMessage('success', 'Banner update successfully.');
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }
                    });
                });
    }
}
function validateBanner() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    if (title == '') {
        $('#err-title').html('Title required');
        flag = false;
    } else {
        $('#err-title').html('');
    }
    if (subtitle == '') {
        $('#err-subtitle').html('Sub title required');
        flag = false;
    } else {
        $('#err-subtitle').html('');
    }

    return flag;
}