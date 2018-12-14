$(document).ready(function () {
    var t_id = $('#t_id').val();
    var studentDropzone = new Dropzone("#courseImage", {
        url: "index.php?r=trendding/uploadtrenddingimae&id=" + t_id + "",
//          success: function (file,response) {
//            if (response === '{"status":false,"data":"error img size"}') {
//                  $('#err-file').html('image size must be 650 x 280 pixels.');
//            } else if(response === '{"status":true,"msg":"save successfully."}'){
//                $('#err-file').hide();
//            }
//        },
        clickable: '#coursepic',
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
        gettrendbyid($('#t_id').val());
    });
    gettrendbyid(t_id);
});


function getTrendid() {
    var id = $('#t_id').val();
    var obj = new Object();
    obj.id = id;
    alertify.confirm("Are you sure you want to delete this image?",
            function () {
                $.ajax({
                    url: "index.php?r=trendding/deletimage",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        gettrendbyid(obj.id);
                        if (data.status) {
                            showMessage('success', 'Image is deleted.');
                        } else {
                            showMessage('danger', 'Please try again.');
                        }
                    }
                });
            });
}

function gettrendbyid(id) {
    var id = $('#t_id').val();
    var obj = new Object();
    obj.id = id;
    $.ajax({
        url: "index.php?r=trendding/gettrendbyid",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            $('#curspic').attr('src', 'index.php?r=trendding/linkcourseimage&id=' + data.data.id);
            if (data.data.trendingimg.indexOf('/resources/users/no_image.jpg') > -1) {
                $('#picid').hide('hide');
                $('#iconHide').hide('hide');
                $('#picid').css('display', 'none');
            } else {
                $('#iconHide').show();
                $('#picid').show();
                $('#picid').css('color', '#1f1d1d');
            }
        }
    });
}

function saveUpdate() {
    var id = $('#t_id').val();
    var offer = $('#offer').val();
    if (validateTrendding()) {
        if (offer.length === 2) {
            if (offer != 00 && offer != 0) {
                if (offer != "0") {
                    alertify.confirm("Are you sure you want update ?",
                            function () {
                                var obj = new Object();
                                obj.id = id;
                                obj.title = $('#title').val();
                                obj.subtitle = $('#subtitle').val();
                                obj.statusid = $('#statusid').val();
                                obj.offer = $('#offer').val();
                                $.ajax({
                                    url: 'index.php?r=trendding/updattrendding',
                                    async: false,
                                    data: obj,
                                    type: 'POST',
                                    success: function (data) {
                                        showMessage('success', 'Updated successfully.');
                                    }
                                });
                            });
                } else {
                    $('#err-offer').html('xhen zero');
                }
            } else {
                $('#err-offer').html('Must be greter then zero');
            }
        } else {
            $('#err-offer').html('Invalid amount');
        }
    }
}

function validateTrendding() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var offer = $('#offer').val();
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
    if (offer == '') {
        $('#err-offer').html('Offer required');
        flag = false;
    } else {
        $('#err-offer').html('');
        if (isNaN(offer)) {
            $('#err-offer').html('Must be numerical');
            flag = false;
        }
    }

    return flag;
}
