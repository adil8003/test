$(document).ready(function () {

    allBanner();
    window.listBanner = [];
    var id = $('#user_id').val();

});
function allBanner(id) {
    var obj = new Object();
    obj.id = id;
    obj.page = $('#listpage').val();
    $.ajax({
        url: "index.php?r=banner/allbanner",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data.data.length);
            if (data.data.length === 0) {
                showMessage('warning', 'Banner not available .')
                $('#notAvailable').html("<h5 id='notAvailable' >Banner not available. </h5>");
            } else {
                if (data.data[0].status === true) {
                    window.listBanner = data;
                    var htm = '';
                    htm = getBannerList(data);
                    $('#list-banner').html(htm);
                }
            }
        }
    });
}


//course layout-
function searchPage(page) {
    $('#listpage').val(page);
    allBanner();
}

function getBannerList(dataAll) {
    dataAll = window.listBanner;
    var intRecords = dataAll.data.length;
    var intRecordsPerpage = 3;
    var intRecordsMaxpage = Math.ceil(dataAll.data.length / intRecordsPerpage);
    var intCurrPage = $('#listpage').val();
    var html = '';

    $.each(dataAll.data, function (k, v) {
        var url = window.location.href;
        var startRecord = (intCurrPage - 1) * intRecordsPerpage;
        var endRecord = intCurrPage * intRecordsPerpage;
        if (startRecord <= k && k < endRecord) {
            html += '<div class="col-md-4" id="">';
            html += ' <div id="f1_container">';
            html += ' <input type="hidden" id="s" value="' + v.id + '">';
            html += ' <div id="f1_card" class="shadow">';
            html += '<div class="front face">';
            html += '<h3 class="js-topic" style="font-size:20px;">' + firstLettersCap(v.title) + ' <span class="pull-right "><a href="index.php?r=banner/editbanner&amp;id=' + v.id + '" title="Edit banner"><i  class="ti-pencil teal-text editCourse pull-right"></i>\n\
                     </a><a href="#" title="Edit banner" onclick="getBannerid(' + v.id + ')" id="bid"><i  class="ti-trash   teal-text editCourse pull-right"></i></a></span></h3>';
            html += '</div>';
            html += '<div class="back face center">';
            html += ' <p> ' + v.subtitle + '</p>';
            html += '</div><br></hr>';
            html += ' <div class="author pull-right" id="orgImage">';
            html += ' <img src="index.php?r=banner/linkbannerimage&id=' + v.id + '" onclick="getId(' + v.id + ');" style="width:302px; height: 142px;cursor: pointer;" id="imagepic" alt="Image" class="img-rounded img-responsive img-raised">';
            html += ' </div>';
            html += ' </div>';
            html += '</div>';
            html += '</div>';
        }
    });
    html += ' <div class="clearfix"></div>';
    html += '<div id="pagination">';
    html += '<span class="all-pages">Page ' + intCurrPage + ' of ' + intRecordsMaxpage + '</span>';
    for (var i = 1; i <= intRecordsMaxpage; i++) {
        if (i != intCurrPage) {
            html += '<span onclick="searchPage(' + i + ');" class="page-num">' + i + '</span>';
        } else {
            html += '<span class="current page-num">' + i + '</span>';
        }
    }
    html += '</div><br>';
    return html;
}
function getId(id) {
    var studentDropzone = new Dropzone("#orgImage", {
        url: "index.php?r=banner/uploadbanner&id=" + id + "",
        clickable: '#imagepic',
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
        allBanner();
    });

}
function getBannerid(bid) {
    $('#bid').val(bid);
    var obj = new Object();
    obj.id = $('#bid').val();
    obj.statusid = 1;
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
                            showMessage('success', 'Successfully deleted');
                            allBanner();
                        } else {
                        }
                    },
                    error: function (data) {
                        showMessage('danger', 'Please try again.');
                    }

                });
            });
}

function saveBanner() {
    if (validateBanner()) {
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        var subtitle = $('#subtitle').val();
        var title = $('#title').val();
        alertify.confirm("Are you sure you want add this banner?",
                function () {
                    var obj = new Object();
                    obj.subtitle = $('#subtitle').val();
                    obj.title = $('#title').val();
                    obj.bannerimg = $('#file').val();
                    $.ajax({
                        url: "index.php?r=banner/savebanner&title=" + title + "&subtitle= " + subtitle + "",
                        async: false,
                        type: 'POST',
                        data: formData,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == true) {
                                allBanner();
                                showMessage('success', 'Banner added successfully.');
                                $('#title').val(' ');
                                $('#subtitle').val(' ');
                                $('#file').val(' ');
                            } else if(data){
                                $('#err-file').html('image size must be 1680 x 700 pixels.');
                            }
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                              $('#err-file').html('image size must be 1680 x 700 pixels.');
                        }
                    });
                });
    }
}

function validateBanner() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var bannerimg = $('#file').val();

    if (bannerimg == '') {
        $('#err-file').html('image required');
        flag = false;
    } else {
        $('#err-file').html('');
    }
    if (title == '') {
        $('#err-title').html('Title required');
        flag = false;
    } else {
        $('#err-title').html('');
//         if (!isNaN(title)) {
//            $('#err-title').html('Must be Alphabate');
//            flag = false;
//        }
    }

    if (subtitle == '') {
        $('#err-subtitle').html('Sub title required');
        flag = false;
    } else {
        $('#err-subtitle').html('');
//         if (!isNaN(subtitle)) {
//            $('#err-subtitle').html('Must be Alphabate');
//            flag = false;
//        }
    }

    return flag;
}
