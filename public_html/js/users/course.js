$(document).ready(function () {
    allCourse();
    var id = $('#user_id').val();
});

function allCourse(id) {
    var obj = new Object();
    obj.id = id;
    $.ajax({
        url: "index.php?r=users/allcourse",
        async: false,
        data: obj,
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            console.log()
            if (data.data == '') {
                $('#notAvailable').html("<span><h4><b>Course not available. </h4></span>");
            } else {
                if (data.data[0].status == true) {
//                createCourseHTML(data);
                    CardBox(data);
                }
            }
        }
    });
}
function CardBox(data) {
    var cardbox = $('#box').val();
    if (cardbox === 1) {
        var htm = '';
        htm = getCourseCardBox(data);
        $('#list-course').html(htm);
    } else {
        var htm = '';
        htm = getCourseHorizontalCard(data);
        $('#list-course').html(htm);
    }
}
//course layout-
function searchPage(page) {
    $('#listpage').val(page);
    allCourse();
}

function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getCourseHorizontalCard(dataAll) {
    window.dataAll = dataAll;
    var intRecords = dataAll.data.length;
    var intRecordsPerpage = 2;
    var intRecordsMaxpage = Math.ceil(dataAll.data.length / intRecordsPerpage);
    var intCurrPage = $('#listpage').val();
    var html = '';
    $.each(dataAll.data, function (k, v) {
        var url = window.location.href;
        var startRecord = (intCurrPage - 1) * intRecordsPerpage;
        var endRecord = intCurrPage * intRecordsPerpage;
        if (startRecord <= k && k < endRecord) {
            html += '<div class="col-xs-12">';
            html += '<div class="card coursecard">';
            html += ' <div class="card-block">';
            html += '<div class="card-block">';
            html += ' <div class="row">';
            html += '  <div class="col-md-9">';
            html += ' <h5 class="card-title courseTitle">' + jsUcfirst(v.title) + '</h5><hr class="hrline">';
            html += ' <div class="row">';
            html += '  <div class="col-md-12">';
            html += ' <p class="card-text courselayout"><b>Description:</b> ' + v.description + '</p>';
            html += ' </div>';
//            html += '  <div class="col-md-6">';
//            html += ' <p class=" courselayout"><b>Subject:</b> ' + v.subject + '</p>';
//            html += ' <p class="card-text courselayout"><b>Department:</b>  ' + v.deptname + '</p>';
//            html += ' <p class="card-text courselayout"><b>Branch:</b> ' + v.branchname + '</p>';
//            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
            html += '  <div class="col-md-3">';
            html += ' <div class="author pull-right" id="orgImage">';
            html += ' <img src="index.php?r=users/linkcourseimage&id='+ v.id +'" style="height:180px;" id="imagepic" alt="Image" class="img-rounded img-responsive img-raised">';
            html += ' </div>';
            html += ' </div>';
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
function getCourseCardBox(dataAll) {
    window.dataAll = dataAll;
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
            html += ' <div class="col-xs-4">';
            html += '<div class="card coursecard">';
            html += ' <div class="card-block">';
            html += '<div class="card-block">';
            html += ' <h5 class="card-title ">Title:  ' + v.title + '</h5><hr class="hrline">';
            html += ' <p class=" courselayout">Subject:' + v.subject + '</p>';
            html += ' <p class="card-text courselayout">Branch: ' + v.branchname + '</p>';
            html += ' <p class="card-text courselayout">Department: ' + v.deptname + '</p>';
            html += ' <p class="card-text courselayout">Description: ' + v.description + '</p>\n\
               <hr>';
            html += '&nbsp; <a href="index.php?r=course/coursecontent&amp;id=' + v.id + '" title="Add content"><i  class="ti-plus teal-text editCourse"></i></a>\n\
               &nbsp;&nbsp;<span><a href="index.php?r=course/editcourse&amp;id=' + v.id + '" title="Edit" class="teal-text editCourse"   ><i  class="ti-pencil teal-text "></i></a></span>';
            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
            html += ' </div>';
        }
    });

    html += '<div id="pagination"><br><br>';
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
} //course layout end
//} // end of createCourseHTML