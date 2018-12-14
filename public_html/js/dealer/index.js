
$(document).ready(function () {
    Alltrendding();
    var t_id = $('#t_id').val();

});

function Alltrendding() {
    $.noConflict()
    $('#tbldealrs').DataTable({
        ajax: "index.php?r=dealer/alldealers",
        "iDisplayLength": 3,
        "columns": [
            {"data": "name"},
            {"data": "phone"},
            {"data": "email"},
            {"data": "organisation"},
            {"data": "addeddate"},
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
        ]
    });
}
