$(document).ready(function () {
    allNewproduct();
    window.listCourse = [];
    var id = $('#user_id').val();
    var course_id = $('#course_id').val();
//    getOrgdetailsByid();
});
function allNewproduct(id) {
    var obj = new Object();
    obj.id = id;
    obj.page = $('#listpage').val();
    $.ajax({
        url: "index.php?r=newarrivals/allnewproduct",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            if (data.data == '') {
                $('#notAvailable').html("<h5>New arrivals product not available. </h5>");
            } else {
                if (data.data[0].status == true) {
                    window.listArrivalsProduct = data;
                    var htm = '';
                    htm = getNewArrivalProduct(data);
                    $('#list-newproduct').html(htm);
                }
            }
        }
    });
}

function searchPage(page) {
    $('#listpage').val(page);
    allNewproduct();
}

function getNewArrivalProduct(dataAll) {
    dataAll = window.listArrivalsProduct;
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
            html += '<div class="col-md-4">';
            html += '<div class="card coursecard">';
            html += ' <div class="card-block">';
            html += '<div class="card-block">';
            html += ' <div class="row">';
            html += '  <div class="col-md-12">';
            html += ' <h5 class="card-title courseTitle">' + firstLettersCap(v.title) + '<span><a href="index.php?r=newarrivals/edit&amp;id=' + v.id + '" title="Add content"><i  class="ti-pencil teal-text editCourse pull-right"></i>&nbsp;&nbsp;</a>\n\
              </h5><hr class="hrline">';
            html += ' <div class="row">';
            html += '  <div class="col-md-12">';
            html += ' <p class="card-text courselayout"><b>Sub title :</b> ' + v.subtitle + '</p>';
            html += ' <p class="card-text courselayout"><b>Price :</b> ' + v.price + '</p>';
            html += ' <p class="card-text courselayout"><b>Offer :</b> ' + v.offer + '%</p>';
            html += ' <p class="card-text courselayout"><b>Final price :</b> ' + v.offerprice + '</p>';
            html += ' </div>';
//            html += '  <div class="col-md-6">';
//            html += ' <p class=" courselayout"><b>Subject:</b> ' + v.subject + '</p>';
//            html += ' <p class="card-text courselayout"><b>Department:</b>  ' + v.deptname + '</p>';
//            html += ' <p class="card-text courselayout"><b>Branch:</b> ' + v.branchname + '</p>';
//            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
//            html += '  <div class="col-md-3">';
//            html += ' <div class="author pull-right" id="orgImage" >';
////            html += ' <img src="index.php?r=newarrivals/linkproductimage&id=' + v.id + '" style="height: 110px;"  id="imagepic" alt="Image" class="img-rounded img-responsive img-raised">';
//            html += ' </div>';
//            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
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

function saveProduct() {
    if (validateProduct()) {
        var files = $('#files').get(0).files;
        var formData = new FormData();
        $(files).each(function (index, file) {
            formData.append(index, file);
        });
        var subtitle = $('#subtitle').val();
        var title = $('#title').val();
        var statusid = $('#statusid').val();
        var productstatusid = $('#productstatusid').val();
        var title = $('#title').val();
        var price = $('#price').val();
        var offer = $('#offer').val();
        var offerprice = $('#offerprice').val();
//        var val = offer / 100 * price;
        if (offer.length === 2) {
            if (offer != 00 && offer != 0) {
                if (offer != "0") {
                    alertify.confirm("Are you sure you want add this product?",
                            function () {
                                var obj = new Object();
                                $.ajax({
                                    url: "index.php?r=newarrivals/saveproduct&title=" + title + "&price=" + price + "&productstatusid=" + productstatusid +
                                            "&statusid=" + statusid + " &subtitle= " + subtitle + " &offer= " + offer + "",
                                    async: false,
                                    type: 'POST',
                                    data: formData,
                                    processData: false, // tell jQuery not to process the data
                                    contentType: false, // tell jQuery not to set contentType
                                    success: function (data) {
                                        data = JSON.parse(data);
                                        if (data.status == true) {
                                            showMessage('success', 'Added successfully.');
                                            $('#title').val('');
                                            $('#subtitle').val('');
                                            $('#price').val('');
                                            $('#offer').val('');
                                        } else {
                                            $('#err-file').html('image size must be 255 x 291 pixels.');

                                        }
                                    },
                                    error: function (data) {
                                        showMessage('danger', 'Please try again.');
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

function validateProduct() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var price = $('#price').val();
    var offer = $('#offer').val();
    var statusid = $('#statusid').val();
    var productstatusid = $('#productstatusid').val();
    var file = $('#files').val();

    if (title == '') {
        $('#err-title').html('Title required');
        flag = false;
    } else {
        $('#err-title').html('');
        if (!isNaN(title)) {
            $('#err-title').html('Must be Alphabate');
            flag = false;
        }
    }
    if (subtitle == '') {
        $('#err-subtitle').html('Sub title required');
        flag = false;
    } else {
        $('#err-subtitle').html('');
        if (!isNaN(subtitle)) {
            $('#err-subtitle').html('Must be Alphabate');
            flag = false;
        }
    }
    if (statusid == '') {
        $('#err-statusid').html('Status required');
        flag = false;
    } else {
        $('#err-statusid').html('');
    }
    if (productstatusid == '') {
        $('#err-productstatusid').html('Product status required');
        flag = false;
    } else {
        $('#err-productstatusid').html('');
    }
    if (file == '') {
        $('#err-file').html('Image required');
        flag = false;
    } else {
        $('#err-file').html('');
    }

    if (productstatusid == '') {
        $('#err-coursesstatusid').html('Status required');
        flag = false;
    } else {
        $('#err-coursesstatusid').html('');
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
        if (isNaN(price)) {
            $('#err-offer').html('Must be numerical');
            flag = false;
        }
    }
    return flag;
}
function getOrgdetailsByid() {
    var id = $('#user_id').val();
    var obj = new Object();
    obj.id = id;
    $.ajax({
        url: 'index.php?r=course/getorgdetailsbyid',
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            var data = JSON.parse(data);
            if (data.status == true) {
                createHTML(data);
            }
        }
    });
}

function createHTML(data) {
    var id = $('#org_id').val();
    var html = '';
    html += '<div class="card-header">';
    html += '<h4 class="card-title"> Orgnisation info:</h4>';
    html += '</div><hr>';
    html += '<div class="card-block" >';
    html += ' <label>Name:<span class="card-text"> ' + data.orgname + ' </span> </label>';
    html += '<label>Type:<span class="card-text"> ' + data.orgtypeid + '</span> </label>';
    html += '<label>Website:<span class="card-text"> ' + formattedText(data.website) + ' </span> </label>';
    html += ' <label>Address:<span class="card-text"> ' + formattedText(data.address1) + ' </span> </label>';
    html += ' <label>Status:<span class="card-text"> ' + formattedText(data.orgstatus) + ' </span> </label>';
    html += '</br>';
    html += '</br>';
    //    html += ' <a href="index.php?r=orgprofile/organisation"  class="btn btn-sm btn-primary">Show Details</a>';
    html += ' <a href="index.php?r=organisation/editorganisation&amp;id=' + data.org_id + '"  class="btn btn-sm btn-primary">Show Details</a>';
    html += '</div>';
    $('#orgDetails').html(html);
}