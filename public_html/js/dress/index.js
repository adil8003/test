$(document).ready(function () {
    allShirtypeList();
    $('#updateForm').hide();
    $('#addshirtbutton').hide();
    getDressType();
});

function allShirtypeList() {
    var obj = new Object();
    obj.page = $('#listpage').val();
    $.ajax({
        url: "index.php?r=dress/allshirtstype",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            if (data.data == '') {
                $('#notAvailable').html("<h5>Dress type not available. </h5>");
            } else {
                if (data.data[0].status == true) {

                    window.listShirt = data;
                    var htm = '';
                    htm = getShirtList(data);
                    $('#ShirtList').html(htm);

                }
            }
        }
    });
}


function searchPage(page) {
    $('#listpage').val(page);
    allShirtypeList();
}
function getShirtList(dataAll) {
    dataAll = window.listShirt;
    var intRecords = dataAll.data.length;
    var intRecordsPerpage = 5;
    var intRecordsMaxpage = Math.ceil(dataAll.data.length / intRecordsPerpage);
    var intCurrPage = $('#listpage').val();
    var html = '';

    $.each(dataAll.data, function (k, v) {
        var url = window.location.href;
        var startRecord = (intCurrPage - 1) * intRecordsPerpage;
        var endRecord = intCurrPage * intRecordsPerpage;
        if (startRecord <= k && k < endRecord) {

            html += '<div class="card shadow" >';
            html += '<input type="hidden" id="sid" value="">';
            html += '<div class="alert " style="background-color: #c2d3d8 !important;">';
            html += '<strong>Dress  type:  <b style="color:red;background-color: #c2d3d8 !important;"> ' + v.stype + '</b></strong>\n\
           <span><a href="index.php?r=dress/add&amp;id=' + v.shirttypeid + '" title="Add product" class="teal-text pull-right"  ><i  class="fa fa-shopping-cart teal-text ">&nbsp;</i></a>\n\
           <a href="#" onclick="updateShirtType(`' + v.stype + '`,`' + v.qty + '`,`' + v.offer + '`,`' + v.shirttypeid + '`);" title="Edit" class="teal-text"  ><i  class="ti-pencil teal-text pull-right">&nbsp;</i></a>&nbsp;\n\
            </span> ';
            html += '</div>';
            html += '<div class="row">';
            html += '<div class="col-md-12">';
            html += '<p class="card-text "><b>Total available qty:</b> ' + v.qty + '</p>';
            html += '<p class="card-text "><b>Offer:</b>  ' + v.offer + '%</p>';
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
function updateShirtType(stype, qty, offer, shirttypeid) {
    $('#updateForm').show();
    $('#addForm').hide();
    $('#ushirttypeid').val(stype);
    $('#selectedid').html('<option  value="' + shirttypeid + '">' + stype + '</option>');
    $('#uqty').val(qty);
    $('#uoffer').val(offer);
    $('#sid').val(shirttypeid);
    $('#addshirtbutton').show();
}
function showAddForm() {
    $('#addForm').show();
    $('#updateForm').hide();
    setTimeout(function () {
        $('#addshirtbutton').hide();
    }, 1000);
}
function  UpdateSaveshirttype() {
    var id = $('#sid').val();
    if (validateupdateshirt()) {
        alertify.confirm("Are you sure you want update this dress type?",
                function () {
                    var obj = new Object();
                    obj.shirttypeid = id;
                    obj.qty = $('#uqty').val();
                    obj.offer = $('#uoffer').val();
                    $.ajax({
                        url: 'index.php?r=dress/updateshirttype',
                        async: false,
                        data: obj,
                        type: 'POST',
                        success: function (data) {
                            showMessage('success', 'Update successfully.');
                            allShirtypeList();
                            $('#addForm').show();
                            $('#updateForm').hide();
                            $('#addshirtbutton').hide();
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }
                    });
                });
    }
}
function  AddtypeofDress() {
    if (validatetype()) {
        alertify.confirm("Are you sure you want add this type of dress?",
                function () {
                    var obj = new Object();
                    obj.name = $('#typeofdress').val();
                    $.ajax({
                        url: 'index.php?r=dress/addgtypeofdress',
                        async: false,
                        data: obj,
                        type: 'POST',
                        success: function (data) {
                            showMessage('success', 'Add successfully.');
                            $('#name').val(' ');
                            getDressType();
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }
                    });
                });
    }
}
function Saveshirttype() {
    if (validateshirt()) {
        alertify.confirm("Are you sure you want add this dress type?",
                function () {
                    var obj = new Object();
                    obj.shirttypeid = $('#shirttypeid').val();
                    obj.qty = $('#qty').val();
                    obj.offer = $('#offer').val();
                    $.ajax({
                        url: "index.php?r=dress/saveshirttype",
                        async: false,
                        type: 'POST',
                        data: obj,
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == false) {
                                showMessage('danger', 'You have already added this shirt. Please try differnt.');
                            } else {
                                showMessage('success', 'Added successfully.');
                                $('#qty').val('');
                                $('#offer').val('');
                                allShirtypeList();
                            }
                        },
                        error: function (data) {
                            showMessage('danger', 'Please try again.');
                        }
                    });
                });
    }
}
function validatetype() {
    var flag = true;
    var typeofdress = $('#typeofdress').val();

    if (typeofdress == '') {
        $('#err-typeofdress').html('Name of dress required');
        flag = false;
    } else {
        $('#err-typeofdress').html('');
    }
    return flag;
}
function validateshirt() {
    var flag = true;
    var qty = $('#qty').val();
    var offer = $('#offer').val();
    var shirttypeid = $('#shirttypeid').val();

    if (qty == '') {
        $('#err-qty').html('Qty required');
        flag = false;
    } else {
        $('#err-qty').html('');
        if (isNaN(qty)) {
            $('#err-qty').html('Must be numerical');
            flag = false;
        }
    }
    if (shirttypeid == ' ') {
        $('#err-shirttypeid').html('Add dress type');
        flag = false;
    } else {
        $('#err-shirttypeid').html('');
    }
//    if (isNaN(offer)) {
//        $('#err-offer').html('Must be numerical');
//        flag = false;
//        
//    } else if (offer.length === 2) {
//            $('#err-offer').html('Invalid amount');
//            flag = false;
//        
//        
//    } 


//        if (offer != 00 && offer != 0) {
//
//            $('#err-offer').html('Must be greter then zero');
//            flag = false;
//        }
//        if (offer != "0") {
//
//            $('#err-offer').html('Invalid amount');
//            flag = false;
//        }


    return flag;
}
function validateupdateshirt() {
    var flag = true;
    var qty = $('#uqty').val();
    var offer = $('#uoffer').val();

    if (qty == '') {
        $('#uerr-qty').html('Qty required');
        flag = false;
    } else {
        $('#uerr-qty').html('');
        if (isNaN(qty)) {
            $('#uerr-qty').html('Must be numerical');
            flag = false;
        }
    }
//    if (isNaN(offer)) {
//        $('#err-offer').html('Must be numerical');
//        flag = false;
//        
//    } else if (offer.length === 2) {
//            $('#err-offer').html('Invalid amount');
//            flag = false;
//        
//        
//    } 


//        if (offer != 00 && offer != 0) {
//
//            $('#err-offer').html('Must be greter then zero');
//            flag = false;
//        }
//        if (offer != "0") {
//
//            $('#err-offer').html('Invalid amount');
//            flag = false;
//        }


    return flag;
}

function getDressType(id) {
    var obj = new Object();
    obj.id = id;
    $.ajax({
        url: 'index.php?r=dress/getdresstype',
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            var data = JSON.parse(data);
            console.log(data);
            if (data.data.length === 0) {

            } else {
                var html = '';
                $.each(data.data, function (k, v) {
                    console.log(v.name)
                    html += '<option value=' + v.id + ' >' + v.name + '</option>>';
                });
                $('#shirttypeid').html(html);
            }
        }
    });
}