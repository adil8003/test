$(document).ready(function () {
    var id = $('#banner_id').val();

    getImagebyid(id);
    getImagebyid2(id);


})
function getBannerid(bid) {
    $('#bid').val(bid);
    var obj = new Object();
    obj.id = $('#bid').val();
    alertify.confirm("Are you sure you want to delete?",
            function () {
                $.ajax({
                    url: 'index.php?r=banner/deletebanner',
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            showMessage('success', 'Successfully delete');
                        } else {
                        }
                    },
                    error: function (data) {
                        showMessage('danger', 'Please try again.');
                    }

                });
            });
}
function getImagebyid(id) {
    var obj = new Object();
    obj.id = 1;
    $.ajax({
        url: "index.php?r=subbanner/getbannerimagebyid",
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data.title);
//             $('#titleFirst').text('<p>' + data.title +'</p>');
            if (data.status === true) {
                $('#subimg1').attr('src', 'index.php?r=subbanner/linkbannerimage&id=' + data.data.id);
                $('#titleFirst').text(data.title);
                $('#subtitleFirst').text(data.subtitle);
//                console.log(data.data.image)
                if (data.data.indexOf('/resources/users/no_image.jpg') > -1) {
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
function getImagebyid2(id) {
    var obj = new Object();
    obj.id = 2;
    $.ajax({
        url: "index.php?r=subbanner/getbannerimagebyid2",
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            data = JSON.parse(data);
            if (data.status === true) {
                $('#bannerpic2').attr('src', 'index.php?r=subbanner/linkbannerimage2&id=' + data.data.id);
                $('#titleSecond').text(data.title);
                $('#subtitleSecond').text(data.subtitle);
                if (data.data.indexOf('/resources/users/no_image.jpg') > -1) {
                    $('#picid2').hide('hide');
                    $('#picid2').css('display', 'none');
                } else {
                    $('#picid2').show();
                    $('#picid2').css('color', '#1f1d1d');
                }
            } else {

            }

        }
    });
}

function deleteAddone(id) {
    alertify.confirm("Are you sure you want to Delete Image ?",
            function () {

                var obj = new Object();
                obj.id = 1;
                $.ajax({
                    url: "index.php?r=subbanner/deleteaddone",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        alertify.alert("Image Deleted !!", function () {
                        });
                        getImagebyid()
                    }
                });
            });

}
function deleteAddtwo(id) {
    alertify.confirm("Are you sure you want to Delete Image ?",
            function () {
                var obj = new Object();
                obj.id = 2;
                $.ajax({
                    url: "index.php?r=subbanner/deleteaddtwo",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        alertify.alert("Image Deleted !!", function () {
                        });
                        getImagebyid2();
                    }
                });
            });
}

function saveAddtwo() {
    if (validateBanner()) {
        var formData = new FormData();
        formData.append('file', $('#file2')[0].files[0]);
        var subtitle = $('#subtitle2').val();
        var title = $('#title2').val();
        var id = 2;
        alertify.confirm("Are you sure you want add this Add image?",
                function () {
                    var obj = new Object();
                    obj.id = 1;
                    obj.subtitle = $('#subtitle2').val();
                    obj.title = $('#title2').val();
                    obj.bannerimg = $('#file2').val();
                    $.ajax({
                        url: "index.php?r=subbanner/addtwo&title=" + title + "&subtitle= " + subtitle + "&id=" + id + "",
                        async: false,
                        type: 'POST',
                        data: formData,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == true) {
                                showMessage('success', 'Add 2 added successfully.');
                                $('#title2').val('');
                                $('#subtitle2').val('');
                                getImagebyid2();
                            } else if (data) {
                                $('#err-file2').html('image size must be 600 x 300 pixels.');
                            }
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
    var title = $('#title2').val();
    var subtitle = $('#subtitle2').val();
    var bannerimg = $('#file2').val();

    if (title == '') {
        $('#err-title2').html('Title required');
        flag = false;
    } else {
        $('#err-title2').html('');
        if (!isNaN(title)) {
            $('#err-title2').html('Must be Alphabate');
            flag = false;
        }
    }

    if (subtitle == '') {
        $('#err-subtitle2').html('Sub title required');
        flag = false;
    } else {
        $('#err-subtitle2').html('');
        if (!isNaN(subtitle)) {
            $('#err-subtitle2').html('Must be Alphabate');
            flag = false;
        }
    }

    if (bannerimg == '') {
        $('#err-file2').html('Image required');
        flag = false;
    } else {
        $('#err-file2').html('');
    }

    return flag;
}
function saveAddone() {
    if (validateBanner1()) {
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        var subtitle = $('#subtitle').val();
        var title = $('#title').val();
        var id = 1;
        alertify.confirm("Are you sure you want add this add image?",
                function () {
                    var obj = new Object();
                    obj.id = 1;
                    obj.subtitle = $('#subtitle').val();
                    obj.title = $('#title').val();
                    obj.bannerimg = $('#file').val();
                    $.ajax({
                        url: "index.php?r=subbanner/addone&title=" + title + "&subtitle= " + subtitle + "&id=" + id + "",
                        async: false,
                        type: 'POST',
                        data: formData,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == true) {
                                showMessage('success', 'Add 1 added successfully.');
                                $('#title').val('');
                                $('#subtitle').val('');
                                getImagebyid();
                            } else if (data) {
                                $('#err-file').html('image size must be 600 x 300 pixels.');
                            }

                        },

                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }

                    });
                });
    }
}

function validateBanner1() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var bannerimg = $('#file').val();

    if (title == '') {
        $('#err-title').html('Title required');
        flag = false;
    } else {
        $('#err-title').html('');
        if (!isNaN(title)) {
            $('#err-title').html('Must be numerical');
            flag = false;
        }
    }
    if (subtitle == '') {
        $('#err-subtitle').html('Sub title required');
        flag = false;
    } else {
        $('#err-subtitle').html('');
        if (!isNaN(subtitle)) {
            $('#err-subtitle').html('Must be numerical');
            flag = false;
        }
    }
    if (bannerimg == '') {
        $('#err-file').html('Image required');
        flag = false;
    } else {
        $('#err-file').html('');
    }

    return flag;
}
