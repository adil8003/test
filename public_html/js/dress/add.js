$(document).ready(function () {
    var shirttypeid = $('#shirttypeid').val();
    allShirtypeProduct();

});

function allShirtypeProduct(shirttypeid) {
    var shirttypeid = $('#shirttypeid').val();
    var obj = new Object();
    obj.shirtsid = shirttypeid;
    obj.page = $('#listpage').val();
    $.ajax({
        url: "index.php?r=dress/getallproduct",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            if (data.data == '') {
                $('#notAvailable').html("<h5>Product not available </h5>");
            } else {
                if (data.data[0].status == true) {
                    window.listShirtsProduct = data;
                    var htm = getTrendingProductHtml();
                    $('#sProduct').html(htm);
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
    dataAll = window.listShirtsProduct;
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
            html += '<small><b>Status:</b>  ' + v.sstatus + '</small></br>';
            html += '<small><b>Size: </b>' + v.ptype + '<span><i class="ti-trash pull-right" style="cursor: pointer;font-size: 16px;" id="productid" onclick="getProductId(' + v.id + ');"></i></span>\n\
<span><a href="index.php?r=dress/edit&id=' + v.id + '" ><i class="ti-pencil pull-right" style="cursor: pointer;font-size: 16px;;""></i></a></span></small>';
            html += '</div>';
            html += '<div class="item" id="courseImage">';
            html += '<img src="index.php?r=dress/linkproductimage&id=' + v.id + '" onclick="getId(' + v.id + ');" style="cursor: pointer;width:100%; height:100%" id="coursepic" alt="Product image">';
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
                    url: "index.php?r=dress/deletproduct",
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            allShirtypeProduct();
                            showMessage('success', 'product is deleted.');
                        } else {
                            showMessage('danger', 'Please try again.');
                        }
                    }
                });
            });
}

function saveShirtProduct() {
    var price = $('#price').val();
    if (validateShirtProduct()) {
          var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        
//        formData.append = $('#file').file;
        var shirttypeid = $('#shirttypeid').val();
        var title = $('#title').val();
        var offer = $('#offer').val();
        var offerprice = $('#offerprice').val();
        var productstatusid = $('#productstatusid').val();
        var producttypeid = $('#producttypeid').val();
        var statusid = $('#statusid').val();
        alertify.confirm("Are you sure you want add this trending?",
                function () {

                    $.ajax({
                        url: "index.php?r=dress/saveshirtproduct&shirtsid=" + shirttypeid +
                                "&price= " + price + "&title= " + title + "&offer= " + offer + "&offerprice= " + offerprice +
                                "&productstatusid= " + productstatusid + "&producttypeid= " + producttypeid + "&statusid=" + statusid + "",
                        async: false,
                        type: 'POST',
                        data: formData,
                        processData: false, 
                        contentType: false, 
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == true) {
                                allShirtypeProduct();
                                showMessage('success', 'Added successfully.');
                                $('#title').val(' ');
                                $('#price').val(' ');
                                $('#offerprice').val(' ');
                                $('#files').val(' ');

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
function validateShirtProduct() {
    var flag = true;
    var title = $('#title').val();
    var offer = $('#offer').val();
    var price = $('#price').val();
//    var offerprice = $('#offerprice').val();
    var file = $('#file').val();

    if (title == '') {
        $('#err-title').html('Title required');
        flag = false;
    } else {
        $('#err-title').html('');
    }
//    if (offerprice == '') {
//        $('#err-offerprice').html('Offer price required');
//        flag = false;
//    } else {
//        $('#err-offerprice').html('');
//        if (isNaN(offerprice)) {
//            $('#err-offerprice').html('Must be numerical');
//            flag = false;
//        }
//
//    }
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
    var shirttypeid = $('#shirttypeid').val();
    var price = $('#price').val();
    var obj = new Object();
    obj.price = price;
    obj.id = shirttypeid;
    $.ajax({
        url: 'index.php?r=dress/getofferprice',
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