//User Management scripts
/* HANDLES POPOVERS FOR USER INFO */
var ajax_action, url;
url = "admin/inc/ajax/depts.handler.inc.php?csrf_token=" + $('meta[name="csrf_token"]').attr("value");

function userInfoPull(id, elem) {
    $.ajax({
        type: "POST",
        url: url,
        data: {
            ajax_action: 'departmentUsersInfo',
            "user_id": id,
            "csrf_token": $('meta[name="csrf_token"]').attr("value")
        },
        async: false,
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function () {
            $.LoadingOverlay("hide");
        },
        success: function (user_info) {
            user_info = JSON.parse(user_info);
            var user_info_html = '';
            for (var prop in user_info) {
                if (user_info[prop] != '' && user_info[prop] != null) {
                    if (prop == 'UserImage') {
                        user_info_html += '<br><div class="img-thumbnail"><img src="' + user_info[prop] + '" height="240px"></div>';
                    } else {
                        user_info_html += '<div><b>' + prop.replace(/([A-Z])/g, ' $1') + ': </b>' + user_info[prop] + '</div>';
                    }
                }
            }
            $(elem).attr('data-content', user_info_html).popover('show', {"html": true});
        },
        error: function (xhr, error, thrown) {
            console.log(error);
        }
    });
};

$('body').on('mouseover', "a[id^='info_']", function () {
    if ($(this).attr('data-content')) {
        $(this).popover('show', {"html": true});
    } else {
        var id = this.id.split('_')[1];
        userInfoPull(id, this);
    }
});
$('body').on('mouseleave', "a[id^='info_']", function () {
    $(this).popover('hide');
});
/****************************/


/* HANDLES MODAL FOR ROLE USERS */
$('body').on('click', "button[id^='usersbtn_']", function () {
    var id = this.id.split('_')[1];
    var deptName = $(this).attr('data-title');
    departmentUsersList(id, deptName);
});

function departmentUsersList(id, deptName) {

    $.ajax({
        type: "POST",
        url: url,
        data: {
            ajax_action: 'departmentUsersList',
            "department_id": id,
            "csrf_token": $('meta[name="csrf_token"]').attr("value")
        },
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function () {
            $.LoadingOverlay("hide");
        },
        success: function (user_array) {
            user_array = JSON.parse(user_array);
            $('#usersButton').click();
            $('#deptName').html(deptName);
            $('#dept_users [data-idd="users-selected"]').empty();
            $('#dept_users [data-idd="users-available"]').empty();

            $('#dept_head [data-idd="users-available"]').empty();
            $('#dept_head [data-idd="users-selected"]').empty();
            $('#dept_head [data-idd="user-selected-id"]').empty();
            $('#dept_users #department_id').val(id);

            $.each(user_array['department_users'], function (key, value) {
                $('#dept_users [data-idd="users-selected"]').append("<option value='" + value.id + "'>" + value.username + "</option>");
            });
            $.each(user_array['department_head'], function (key, value) {
                $('#dept_head [data-idd="users-selected"]').val(value.username);
                $('#dept_head [data-idd="user-selected-id"]').val(value.id);
            })
            $.each(user_array['diff_users'], function (key, value) {
                $('#dept_users [data-idd="users-available"]').append("<option value='" + value.id + "'>" + value.username + "</option>");
                $('#dept_head [data-idd="users-available"]').append("<option value='" + value.id + "' data-label='" + value.username + "'>" + value.username + "</option>");
            })

            $("select[class^='users-']").multiselect({
                search: {
                    left: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="q" class="form-control" placeholder="Search..." />',
                },
                fireSearch: function (value) {
                    return value.length > 3;
                }
            });
        },
        error: function (xhr, error, thrown) {
            console.log(error);
        }
    });
};

$('#saveDeptUsers').click(function () {

    var sendData = new FormData();
    var formData = [];
    var new_users = [];

    var id = $('#department_id').val();
    $('#dept_users [data-idd="users-selected"] > option').each(function () {
        var value = $(this).val();
        new_users.push($(this).val());
    });

    formJson = JSON.stringify(new_users);
    sendData.append('formData', formJson);
    sendData.append('departmentId', id);
    sendData.append('csrf_token', $('meta[name="csrf_token"]').attr("value"));
    sendData.append('ajax_action', "assignDepartmentUsers");

    $.ajax({
        type: "POST",
        url: url,
        processData: false,
        contentType: false,
        data: sendData,
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function () {
            $.LoadingOverlay("hide");
        },
        success: function (response) {
            response = JSON.parse(response);
            departmentTable.ajax.reload();
            $('#usersModal').modal('toggle');
        },
        error: function (xhr, error, thrown) {
            console.log(error);
        }
    });
});
$('#saveDeptHead').click(function () {
    var formData, id, dept_head, sendData;
    sendData = new FormData();
    formData = [];

    id = $('#department_id').val();
    dept_head = $('#dept_head [data-idd="user-selected-id"]').val();

    // formJson = JSON.stringify(new_head);
    sendData.append('dept_head', dept_head);
    sendData.append('departmentId', id);
    sendData.append('csrf_token', $('meta[name="csrf_token"]').attr("value"));
    sendData.append('ajax_action', "assignDepartmentHead");

    $.ajax({
        type: "POST",
        url: url,
        processData: false,
        contentType: false,
        data: sendData,
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function () {
            $.LoadingOverlay("hide");
        },
        success: function (response) {
            console.log(id);
            response = JSON.parse(response);
            departmentTable.ajax.reload();
            $('#usersModal').modal('toggle');
        },
        error: function (xhr, error, thrown) {
            console.log(error);
        }
    });
});
/****************************/


/* DATATABLE INITIALIZATION */
$(document).ready(function () {
    departmentTable = $('#department_list').DataTable({
        dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        order: [[1, "asc"]],
        columns: [
            {
                name: "dept_id",
                visible: true,
                searchable: false,
                sortable: false,
                render: function (data, type, row) {
                    return "";
                }
            },
            {
                name: "dept_name",
                searchable: true
            },
            {
                name: "dept_head",
                searchable: true,
                render: function (data, type, row) {
                    if (row[3] != null && row[3] !== '') {
                        return row[3];
                    } else {
                        return 'Not Assigned';
                    }
                }
            },
            {
                name: "action",
                searchable: false,
                render: function (data, type, row) {
                    var data_action
                    if (row[4] != null && row[4] !== '') {
                        data_action = row[4];
                    } else {
                        data_action = '';
                    }
                    return "<button id='usersbtn_" + row[0] + "' data-title='" + row[1] + "' class='btn btn-outline-bright-primary btn-sm' data-idd=''>Assign Users</button>" + data_action;
                }
            }
        ],
        columnDefs: [{
            className: 'select-checkbox',
            targets: 0
        }],
        paging: true,
        ajax: {
            type: 'POST',
            url: url,
            data: {
                ajax_action: 'getAllDepts'
            },
            error: function (xhr, error, thrown) {
                alert(xhr.responseJSON.Error);
            }
        },
        scrollY: "600px",
        scrollCollapse: true,
        lengthMenu: [[10, 25, -1], [10, 25, "All"]],
        select: {
            style: "multi",
            selector: 'td:first-child'
        },
        buttons: [
            {
                extend: 'selectAll',
                className: 'selectall',
                action: function (e) {
                    e.preventDefault();
                    departmentTable.rows({page: 'current'}).select();
                    departmentTable.rows({search: 'removed'}).deselect();
                }
            },
            "selectNone",
            {
                text: 'Add New Department',
                action: function (e, dt, node, config) {
                    $('#newDepartment').modal('show');
                },
                className: "btn-primary-2"
            },
            {
                text: 'Delete Selected',
                action: function (e, dt, node, config) {
                    var selected_array = dt.rows({selected: true}).data();
                    if (confirm("Are you sure you want to delete the selected departments?")) {
                        for (var i = 0, len = selected_array.length; i < len; i++) {
                            if (selected_array[i][0] == 1 || selected_array[i][0] == 2 || selected_array[i][0] == 3) {
                                alert("Cannot delete Standard departments");
                                break;
                            } else {
                                deleteDepartment(selected_array[i][0], 'usersbtn_' + selected_array[i][0]);
                            }
                        }
                    }
                },
                className: "btn-danger"
            }
        ]
    }).on("select", function () {
        //console.log("selected");
    });

});

/****************************/


function deleteDepartment(id, btn_id) {
    var idJSON = "[" + JSON.stringify(id) + "]";
    $.ajax({
        type: "POST",
        url: url,
        data: {
            ajax_action: 'deleteDepartment',
            "ids": idJSON,
            "csrf_token": $('meta[name="csrf_token"]').attr("value")
        },
        async: false,
        success: function (resp) {
            console.log(resp);
            departmentTable.row($('#' + btn_id).parents('tr')).remove().draw();
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
}


$("#newDepartmentForm").submit(function (event) {
    event.preventDefault();

    var departmentName = $("#new_DepartmentName").val();

    $.ajax({
        url: url,
        type: "POST",
        data: {
            ajax_action: 'createDepartment',
            "departmentName": departmentName,
            "csrf_token": $('meta[name="csrf_token"]').attr("value")
        },
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function (resp) {
            $.LoadingOverlay("hide");
        },
        success: function (response) {
            departmentTable.ajax.reload();
            $("#newDepartment").modal('hide');
            $("#newDepartmentForm")[0].reset();
        },
        error: function (err) {
            console.log(err);
        }
    });
});

$("#editDepartmentForm").submit(function (event) {
    event.preventDefault();

    var dept_id = $("#edit_department_id").val();
    var dept_name = $("#edit_DepartmentName").val();

    $.ajax({
        url: url,
        type: "POST",
        data: {
            ajax_action: 'editDepartment',
            "dept_id": dept_id,
            "dept_name": dept_name,
            "csrf_token": $('meta[name="csrf_token"]').attr("value")
        },
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function (resp) {
            $.LoadingOverlay("hide");
        },
        success: function (response) {
            departmentTable.ajax.reload();
            $("#editDepartment").modal('hide');
            $("#editDepartmentForm")[0].reset();
        },
        error: function (err) {
            console.log(err);
        }
    });
});


function editDepartment(id) {

    var id = id;

    $.ajax({
        type: "POST",
        url: url,
        data: {
            ajax_action: 'getDepartmentData',
            "department_id": id,
            "csrf_token": $('meta[name="csrf_token"]').attr("value")
        },
        beforeSend: function () {
            $.LoadingOverlay('show', {
                image: '../login/images/Spin-0.8s-200px.svg',
                imageAnimation: false,
                imageColor: '#428bca',
                fade: [200, 100]
            });
        },
        complete: function () {
            $.LoadingOverlay("hide");
        },
        success: function (response) {

            var respdata = JSON.parse(response);

            $("#editDepartmentForm").trigger("reset");

            $("#edit_department_id").val(respdata.dept_id);
            $("#edit_DepartmentName").val(respdata.dept_name);

            $('#editDepartment').modal('show');

        },
        error: function (xhr, error, thrown) {
            console.log(thrown);
        }
    });
}

//Department assignment box button logic
(function () {
    $('#dept_users [data-idd="btnRight"]').click(function (e) {
        var selectedOpts = $('#dept_users [data-idd="users-available"] option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_users [data-idd="users-selected"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#dept_users [data-idd="btnAllRight"]').click(function (e) {
        var selectedOpts = $('#dept_users [data-idd="users-available"] option');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_users [data-idd="users-selected"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#dept_users [data-idd="btnLeft"]').click(function (e) {
        var selectedOpts = $('#dept_users [data-idd="users-selected"] option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_users [data-idd="users-available"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#dept_users [data-idd="btnAllLeft"]').click(function (e) {
        var selectedOpts = $('#dept_users [data-idd="users-selected"] option');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_users [data-idd="users-available"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    //Department Heads
    $('#dept_head [data-idd="set"]').click(function (e) {
        $('#dept_head [data-idd="users-selected"]').empty();
        $('#dept_head [data-idd="user-selected-id"]').empty();
        var selectedOpts = $('#dept_head [data-idd="users-available"] option:selected').attr('data-label');
        var selectedOptId = $('#dept_head [data-idd="users-available"] option:selected').val();
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_head [data-idd="users-selected"]').val(selectedOpts);
        $('#dept_head [data-idd="user-selected-id"]').val(selectedOptId);
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#dept_head [data-idd="btnAllRight"]').click(function (e) {
        var selectedOpts = $('#dept_head [data-idd="users-available"] option');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_head [data-idd="users-selected"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#dept_head [data-idd="btnLeft"]').click(function (e) {
        var selectedOpts = $('#dept_head [data-idd="users-selected"] option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_head [data-idd="users-available"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
    $('#dept_head [data-idd="btnAllLeft"]').click(function (e) {
        var selectedOpts = $('#dept_head [data-idd="users-selected"] option');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#dept_head [data-idd="users-available"]').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
}(jQuery));

// Converts array to object
function toObject(arr) {
    var rv = {};
    for (var i = 0; i < arr.length; ++i)
        rv[i] = arr[i];
    return rv;
}
