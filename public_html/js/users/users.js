$(document).ready(function () {
    Allusers();
    var id = $('#user_id').val();
}); // end document.ready

function Allusers() {
      $.noConflict()
    $('#tblusers').DataTable({
        ajax: "index.php?r=users/allusers",
        "iDisplayLength": 5,
        "columns": [
            {"data": "fullname"},
            {"data": "email"},
            {"data": "phone"},
            {"data": "roles"},
            {"data": "orgname",
                "render": function (data, type, full, meta) {
                    var htmlAction = '';
                    htmlAction += '<a href="index.php?r=organisation/editorganisationa&amp;id=' + full.org_id + '" title="organisation details" class="teal-text">' + full.orgname + ' </a>'
                    return htmlAction;
                }
            },
            {"data": "status"},
            {"data": "reg_date"},
            {"data": "id",
                "render": function (data, type, full, meta) {
                    var htmlAction = '';
                    if (full.status == 'Active') {
                        htmlAction += '<a href="#" <i onclick="inactiveUser(' + data + ')" id="userid"  title="Active toggle " class="ti-thumb-up teal-text"></i> </a>&nbsp;&nbsp;';
                    } else {
                        htmlAction += '<a href="#"  <i onclick="activeUser(' + data + ')" id="userid" title="Inactive toggle"  class="ti-thumb-down  text-danger"></i></a>&nbsp;&nbsp;'
                    }
                    htmlAction += '<a href="index.php?r=users/edituser&amp;id=' + data + '" title="Edit" class="teal-text" id="orgid"  ><i  class="ti-pencil teal-text "></i></a>&nbsp;&nbsp;'
                    return htmlAction;
                }
            }
        ]
    });
}
function inactiveUser(userid) {
    $('#userid').val(userid);
    var obj = new Object();
    obj.id = $('#userid').val();
    obj.status_id = 'Inactive';
    alertify.confirm("Are you sure you want to inactive this employee?",
            function () {
                $.ajax({
                    url: 'index.php?r=orgusers/deleteuser',
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            var table = $('#tblusers').DataTable();
                            table.ajax.reload();
                            $('#myTab a:first').tab('show');
                        } else {
                        }
                    }
                });
            });
}

function activeUser(userid) {
    $('#userid').val(userid);
    var obj = new Object();
    obj.id = $('#userid').val();
    obj.status_id = 'Active';
    alertify.confirm("Are you sure you want to active this employee?",
            function () {
                $.ajax({
                    url: 'index.php?r=orgusers/deleteuser',
                    async: false,
                    data: obj,
                    type: 'POST',
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status == true) {
                            var table = $('#tblusers').DataTable();
                            table.ajax.reload();
                            $('#myTab a:first').tab('show');
                        } else {

                        }
                    }
                });
            });
}
