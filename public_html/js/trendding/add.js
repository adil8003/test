$(document).ready(function () {
    var trenddingid = $('#trenddingid').val();
    allTrendingProduct();
//   var auto_refresh = setInterval( function() { $('#loadtweets').load('add.php').fadeIn("slow"); }, 15000); // refreshing after every 15000 milliseconds

});

function getId(id) {
    var studentDropzone = new Dropzone("#courseImage", {
        url: "index.php?r=trendding/uploadtrenddingproductimage&id=" + id + "",
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
//        gettrendbyid($('#t_id').val());
        allTrendingProduct();
    });
}

//function gettrendbyid(id) {
//    var id = $('#t_id').val();
//    var obj = new Object();
//    obj.id = id;
//    $.ajax({
//        url: "index.php?r=trendding/gettrendbyid",
//        async: false,
//        data: obj,
//        type: 'GET',
//        success: function (data) {
//            data = JSON.parse(data);
//            $('#curspic').attr('src', 'index.php?r=trendding/linkcourseimage&id=' + data.data.id);
//            if (data.data.trendingimg.indexOf('/resources/users/no_image.jpg') > -1) {
//                $('#picid').hide('hide');
//                $('#iconHide').hide('hide');
//                $('#picid').css('display', 'none');
//            } else {
//                $('#iconHide').show();
//                $('#picid').show();
//                $('#picid').css('color', '#1f1d1d');
//            }
//        }
//    });
//}
function allTrendingProduct(trenddingid) {
    var trenddingid = $('#trenddingid').val();
    var obj = new Object();
    obj.trenddingid = trenddingid;
    obj.page = $('#listpage').val();
    $.ajax({
        url: "index.php?r=trendding/getallproduct",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            if (data.data == '') {
                $('#notAvailable').html("<h5>Product not available </h5>");
            } else {
                if (data.data[0].status == true) {
                    window.listCourse = data;
                    var htm = getTrendingProductHtml();
                    $('#tProduct').html(htm);
                }
            }
        }
    });
}
//course layout-
function searchPage(page) {
    $('#listpage').val(page);
    allTrendingProduct();
}

function getTrendingProductHtml(dataAll) {
    dataAll = window.listCourse;
    var intRecords = dataAll.data.length;
    var intRecordsPerpage = 6;
    var intRecordsMaxpage = Math.ceil(dataAll.data.length / intRecordsPerpage);
    var intCurrPage = $('#listpage').val();
    var html = '';

    $.each(dataAll.data, function (k, v) {
        var url = window.location.href;
        var startRecord = (intCurrPage - 1) * intRecordsPerpage;
        var endRecord = intCurrPage * intRecordsPerpage;
        if (startRecord <= k && k < endRecord) {
            html += '<div class="col-md-4">';
            html += '<div class="card" style="min-height:102px!important; border-top: 5px solid #dd0330;">';
            html += '<div class="card-body">';
            html += '<h5 class="card-title">' + v.title + '</h5>';
            html += '<small><b>Offer %: </b> ' + v.offer + '</small><br>';
            html += '<small><b>Original Price:</b> ' + v.price + '</small></br>';
            html += '<small><b>Offer price:</b> ' + v.offerprice + '</small></br>';
            html += '<small><b>Size: </b>' + v.ptype + '<span><i class="ti-trash pull-right" style="cursor: pointer;font-size: 16px;" id="productid" onclick="getProductId(' + v.id + ');"></i></span>\n\
<span><a href="index.php?r=trendding/addimage&id=' + v.id + '""><i class="ti-pencil pull-right" style="cursor: pointer;font-size: 16px;"></i></a></span></small>';
            html += '</div>';
            html += '<div class="item" id="courseImage">';
            html += '<img src="index.php?r=trendding/linkproductimage&id=' + v.id + '" onclick="getId(' + v.id + ');" style="cursor: pointer;width:100%; height:100%" id="coursepic" alt="Product image">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
    });

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
function getProductId(id) {
    var productid = $('#productid').val();
    var obj = new Object();
    obj.id = id;
    alertify.confirm("Are you sure you want to delete this image?",
            function () {
                $.ajax({
                    url: "index.php?r=trendding/deletproduct",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            allTrendingProduct();
                            showMessage('success', 'product is deleted.');
                        } else {
                            showMessage('danger', 'Please try again.');
                        }
                    }
                });
            });
}

function Savetrenddingproduct() {
    var price = $('#price').val();
    if (validateTrendding()) {
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        var trenddingid = $('#trenddingid').val();
        var title = $('#title').val();
        var offer = $('#offer').val();
        var offerprice = $('#offerprice').val();
        var productstatusid = $('#productstatusid').val();
        var producttypeid = $('#producttypeid').val();
        var statusid = $('#statusid').val();
        alertify.confirm("Are you sure you want add this trending?",
                function () {

                    $.ajax({
                        url: "index.php?r=trendding/savetrendingproduct&trenddingid=" + trenddingid +
                                "&price= " + price + "&title= " + title + "&offer= " + offer + "&offerprice= " + offerprice +
                                "&productstatusid= " + productstatusid + "&producttypeid= " + producttypeid + "&statusid=" + statusid + "",
                        async: false,
                        type: 'POST',
                        data: formData,
                        processData: false, // tell jQuery not to process the data
                        contentType: false, // tell jQuery not to set contentType
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == true) {
                                allTrendingProduct();
                                showMessage('success', 'Added successfully.');
                                $('#title').val(' ');
                                $('#price').val(' ');
                                $('#offerprice').val(' ');

                            } else {
                                $('#err-file').html('image size must be 255 x 291 pixels.');
                            }
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }
                    });
                });

    }
}
function validateTrendding() {
    var flag = true;
    var title = $('#title').val();
    var offer = $('#offer').val();
    var price = $('#price').val();
    var offerprice = $('#offerprice').val();
    var file = $('#file').val();

    if (title == '') {
        $('#err-title').html('Title required');
        flag = false;
    } else {
        $('#err-title').html('');
    }
    if (offerprice == '') {
        $('#err-offerprice').html('Offer price required');
        flag = false;
    } else {
        $('#err-offerprice').html('');
        if (isNaN(offerprice)) {
            $('#err-offerprice').html('Must be numerical');
            flag = false;
        }

    }
    if (price == '') {
        $('#err-price').html('Price required');
        flag = false;
    } else {
        $('#err-price').html('');
        if (isNaN(price)) {
            $('#err-price').html('Must be numerical');
            flag = false;
        }

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
    if (file == '') {
        $('#err-file').html('Image required');
        flag = false;
    } else {
        $('#err-file').html('');
    }

    return flag;
}
function GetOfferPrice() {
    var price = $('#price').val();
    var obj = new Object();
    obj.price = price;
    obj.trenddingid = $('#trenddingid').val();
    $.ajax({
        url: 'index.php?r=trendding/getofferprice',
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            var data = JSON.parse(data);
            if (data.status == true) {
                console.log(data.data)
                $('#offerprice').val(data.data);
//                var x = document.getElementById("offerprice");
//                x.value = data.data;
            }
        }
    });
}