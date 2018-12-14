$(document).ready(function () {
    var trenddingproductid = $('#trenddingproductid').val();
    getImageList(trenddingproductid);
});

function uploadImages() {
    if (validImage()) {
        var trenddingproductid = $('#trenddingproductid').val();
        var files = $('#files').get(0).files;
        var formData = new FormData();
        $(files).each(function (index, file) {
            formData.append(index, file);
        });
        alertify.confirm("Are you sure you want add this images?",
                function () {
                    $.ajax({
                        url: "index.php?r=trendding/uploadeshirtimage&shirtcategoriesid=" + trenddingproductid + "",
                        async: false,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            data = JSON.parse(data);
                            if (data.status == true) {
                                getImageList();
                                showMessage('success', 'Upload successfully.');
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

function validImage() {
    var flag = true;
    var file = $('#files').val();

    if (file == '') {
        $('#err-files').html('image required');
        flag = false;
    } else {
        $('#err-files').html('');
    }
    return flag;
}
function updateProduct() {
   var trenddingproductid = $('#trenddingproductid').val();
    if (validateProduct()) {
        alertify.confirm("Are you sure you want update this product?",
                function () {
                    var obj = new Object();
                    obj.id = trenddingproductid;
                    obj.title = $('#title').val();
                    obj.offer = $('#offer').val();
                    obj.price = $('#price').val();
                    obj.offerprice = $('#offerprice').val();
                    obj.productstatusid = $('#productstatusid').val();
                    obj.producttypeid = $('#producttypeid').val();
                    obj.statusid = $('#statusid').val();
                    $.ajax({
                        url: 'index.php?r=trendding/updateproduct',
                        async: false,
                        data: obj,
                        type: 'POST',
                        success: function (data) {
                            showMessage('success', 'Updated successfully.');
                        }
                    });
                });
    }
}

function validateProduct() {
    var flag = true;
    var title = $('#title').val();
    var subtitle = $('#subtitle').val();
    var price = $('#price').val();
    var statusid = $('#statusid').val();
    var productstatusid = $('#productstatusid').val();
    var productimg = $('#productimg').val();

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
    if (productimg == '') {
        $('#err-productimg').html('Select imgage required');
        flag = false;
    } else {
        $('#err-productimg').html('');
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
    return flag;
}
function GetOfferPrice() {
   var trenddingproductid = $('#trenddingproductid').val();
    var price = $('#price').val();
    var obj = new Object();
    obj.price = price;
    obj.id = trenddingproductid;
    $.ajax({
        url: 'index.php?r=trendding/getofferprice1',
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
function getImageList(trenddingproductid) {
    var trenddingproductid = $('#trenddingproductid').val();
    var obj = new Object();
    obj.id = trenddingproductid;
    $.ajax({
        url: "index.php?r=trendding/getimages",
        async: false,
        data: obj,
        type: 'POST',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);

            if (data.data[0].status === true) {
                var shirtImag = '';
                $.each(data.data, function (k, v) {
                    if (v.imgtype === 'trendcat') {
                        shirtImag += '<div class="dz-error-mark"><span id="resimg_id" style=" cursor:pointer;" ><i onclick="getImageId(`' + v.id + '`)" class="ti ti-trash"></i></span></div>';
                        shirtImag += '<img id="imageId" class="img-thumbnail card-img-top" src="index.php?r=trendding/linkshirtimage&id=' + v.id + '" alt="amenities image"><hr>';
                        $('#shirtList').html(shirtImag);
                    }
                });
            } else if (data.data == '') {
                $('#imgNotAvailable').text('Image not available.')
            }


        }
    });
}