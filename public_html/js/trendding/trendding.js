$(document).ready(function () {
    allTrendingList();
    var t_id = $('#t_id').val();
});
//function Alltrendding() {
//    $.noConflict()
//    $('#alltrenddingproduct').DataTable({
//        ajax: "index.php?r=trendding/alltreddingproduct",
//        "iDisplayLength": 3,
//        "columns": [
//            {"data": "title"},
//            {"data": "subtitle"},
//            {"data": "offer"},
//            {"data": "id",
//                "render": function (data, type, full, meta) {
//                    var htmlAction = '';
//                    if (full.statusid == 2) {
//                        htmlAction += '<a href="#" <i onclick="inactive(' + data + ')" id="tid"  title="Active toggle " class="ti-thumb-up teal-text"></i> </a>';
//                    } else {
//                        htmlAction += '<a href="#"  <i onclick="active(' + data + ')" id="tid" title="Inactive toggle"  class="ti-thumb-down  text-danger"></i></a>&nbsp;'
//                    }
//                    htmlAction += '<a href="index.php?r=trendding/edittrendding&amp;id=' + data + '" title="Edit" class="teal-text"  ><i  class="ti-pencil teal-text "></i></a>'
//                    htmlAction += '<a href="index.php?r=trendding/add&amp;id=' + data + '" title="Edit" class="teal-text"  ><i  class="fa fa-shopping-cart teal-text "></i></a>'
//                    return htmlAction;
//                }
//            }
//        ]
//    });
//}

function allTrendingList() {
    var obj = new Object();
    obj.page = $('#listpage').val();
    $.ajax({
        url: "index.php?r=trendding/alltreddingproduct",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            if (data.data == '') {
                $('#notAvailable').html("<h5>Trending offer not available. </h5>");
            } else {
                if (data.data[0].status == true) {

                    window.listTrending = data;
                    var htm = '';
                    htm = getTrendingList1(data);
                    $('#Trendinglist').html(htm);

                }
            }
        }
    });
}

function searchPage(page) {
    $('#listpage').val(page);
    allTrendingList();
}
function getTrendingList1(dataAll) {
    dataAll = window.listTrending;
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

            html += '<div class="card shadow" >';
            html += '<div class="alert " style="background-color: #c2d3d8 !important;">';
            html += '<strong style="color:red;background-color: #c2d3d8 !important;">Title: ' + v.title + '</strong>\n\
           <span><a href="index.php?r=trendding/add&amp;id=' + v.id + '" title="Add product" class="teal-text pull-right"  ><i  class="fa fa-shopping-cart teal-text ">&nbsp;</i></a>\n\
           <a href="index.php?r=trendding/edittrendding&amp;id=' + v.id + '" title="Edit" class="teal-text"  ><i  class="ti-pencil teal-text pull-right">&nbsp;</i></a>&nbsp;\n\
         <a href="#"> <i onclick="inactive(' + v.id + ')" id="tid"  title="Delete" class="ti-trash teal-text pull-right">&nbsp;</i> </a></span> ';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-6">';
            html += '<p class="card-text "><b>Sub title:</b>' + v.subtitle + '</p>';
            html += '<p class="card-text "><b>Offer:</b> ' + v.offer + '</p>';
            html += '<p class="card-text "><b>Status:</b> ' + v.stype + '</p>';
            html += '</div>';
            html += '<div class="col-md-6">';
            html += ' <img src="index.php?r=trendding/linkcourseimage&id=' + v.id + '" \n\
            style="width: 232px; height: 142px;" id="imagepic" alt="Image" class="img-rounded img-responsive img-raised">';
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

function inactive(tid) {
    $('#tid').val(tid);
    var obj = new Object();
    obj.id = $('#tid').val();
    alertify.confirm("Are you sure you want to delete?",
            function () {
                $.ajax({
                    url: 'index.php?r=trendding/deleteuser',
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status === false) {

                        } else if (data.status === true) {
                            showMessage('success', 'Successfully deleted');
                            allTrendingList();
                        }
                    },
                    error: function (data) {
                        showMessage('danger', 'Please try again.');
                    }

                });
            });
}

//function active(tid) {
//    $('#tid').val(tid);
//    var obj = new Object();
//    obj.id = $('#tid').val();
//    obj.statusid = 'Active';
//    alertify.confirm("Are you sure you want to active?",
//            function () {
//                $.ajax({
//                    url: 'index.php?r=trendding/deleteuser',
//                    async: false,
//                    data: obj,
//                    type: 'POST',
//                    success: function (data) {
//                        data = JSON.parse(data);
//                        if (data.status == true) {
//                            showMessage('success', ' Successfully active');
//                            allTrendingList();
//                        } else {
//
//                        }
//                    },
//                    error: function (data) {
//                        showMessage('danger', 'Please try again.');
//                    }
//                });
//            });
//}

function Savetrendding() {
    var offer = $('#offer').val();
    if (validateTrendding()) {
        var formData = new FormData();
        formData.append('file', $('#file')[0].files[0]);
        var subtitle = $('#subtitle').val();
        var title = $('#title').val();
        var offer = $('#offer').val();
        var statusid = 2;
        if (offer.length === 2) {
            if (offer != 00 && offer != 0) {
                if (offer != "0") {
                    alertify.confirm("Are you sure you want add this trending?",
                            function () {
                                var obj = new Object();
                                obj.subtitle = $('#subtitle').val();
                                obj.title = $('#title').val();
                                obj.offer = $('#offer').val();
                                obj.bannerimg = $('#bannerimg').val();
                                obj.test = 1;
                                $.ajax({
                                    url: "index.php?r=trendding/savetrendding&title=" + title +
                                            "&statusid= " + statusid + "&subtitle= " + subtitle + "&offer=" + offer + "",
                                    async: false,
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (data) {
                                        data = JSON.parse(data);
                                        if (data.status == false) {
                                            $('#err-file').html('First image size 510 x 620 And other must be 650 x 280 pixels.');
                                        } else {
                                            $("#err-file").hide();
                                            showMessage('success', 'Added successfully.');
                                            $('#title').val('');
                                            $('#subtitle').val('');
                                            $('#offer').val('');
                                            allTrendingList();
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
function clearFile() {
    $("#file").remove("");
    $("form").append(' <input id="file" type="file" name="image"/>');
}
function validateTrendding() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var offer = $('#offer').val();
    var file = $('#file').val();

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
    if (file == '') {
        $('#err-file').html('Image required');
        flag = false;
    } else {
        $('#err-file').html('');
    }

    return flag;
}