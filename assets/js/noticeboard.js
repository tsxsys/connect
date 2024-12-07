//Noticeboard Management scripts

/* DATATABLE INITIALIZATION */
$(document).ready(function() {
    var preview, status;
    if ($('#manage_posts').length) {
        noticeboardTable = $('#manage_posts').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "id",
                    visible: true,
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        return "";
                    }
                },
                {
                    name: "title",
                    searchable: true,
                    render: function (data, type, row) {
                        return "<a href='noticeboard.php?t=view&q=" + row[0] + "&qq=" + row[1] + "'>" + row[2] + "</a><br/><small>Created " + row[4] + "</small>";
                    }
                },
                {
                    name: "details",
                    searchable: false,
                    render: function (data, type, row) {
                        preview = row[3].slice(0, 200);
                        return "<a href='noticeboard.php?t=view&q=" + row[0] + "&qq=" + row[1] + "'>" + preview + "</a>";
                    }
                },
                {
                    name: "status",
                    searchable: true,
                    render: function (data, type, row) {
                        if (row[5] === '1') {
                            status = "<span class='badge badge-success'>Live</span>";
                        } else {
                            status = "<span class='badge badge-warning'>Draft</span>";
                        }
                        return status;
                    }
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        return "<div class='btn-group'>\n" +
                            "<a class='btn btn-outline-bright-success btn-sm' href='noticeboard.php?t=view&q=" + row[0] + "&qq=" + row[1] + "'><i class='fas fa-folder-open'></i></a>\n" +
                            "<a class='btn btn-outline-bright-warning btn-sm' href='noticeboard.php?t=add-edit&q=" + row[0] + "&qq=" + row[1] + "'><i class='fas fa-pencil-alt'></i></a>\n" +
                            "<button type='button' class='btn btn-outline-bright-danger btn-sm' data-toggle='modal' data-target='#x_del_" + row[0] + "99" + row[1] + "'><i class='fas fa-trash'></i></button></div>\n" +
                            "<div class='modal fade' id='x_del_" + row[0] + "99" + row[1] + "'>\n" +
                            "    <div class='modal-dialog'>\n" +
                            "        <div class='modal-content'>\n" +
                            "            <div class='modal-header'>\n" +
                            "                <h4 class='modal-title'>Delete Announcement</h4>\n" +
                            "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>\n" +
                            "                    <span aria-hidden='true'>&times;</span>\n" +
                            "                </button>\n" +
                            "            </div>\n" +
                            "            <div class='modal-body'>\n" +
                            "                <p>Are you sure you want to delete " + row[2] + " ?</p>\n" +
                            "            </div>\n" +
                            "            <div class='modal-footer justify-content-between'>\n" +
                            "                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>\n" +
                            "                <button type='submit' class='btn btn-danger' id='del_" + row[0] + "_999" + row[1] + "' data-announcement='" + row[0] + "' data-unique-id='" + row[1] + "' onclick='deleteAnnouncement(this.id);'>Yes delete</button>\n" +
                            "            </div>\n" +
                            "        </div>\n" +
                            "        <!-- /.modal-content -->\n" +
                            "    </div>\n" +
                            "    <!-- /.modal-dialog -->\n" +
                            "</div>"

                    }
                }
            ],
            columnDefs: [{
                className: 'select-checkbox',
                targets: 0
            }],
            paging: true,
            ajax: {
                url: "inc/ajax/noticeboard_getAll.inc.php?csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[15, 30, -1], [15, 30, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            },
            buttons: [
                'selectAll',
                'selectNone',
                {
                    text: 'Delete Selected',
                    action: function (e, dt, node, config) {
                        var selected_array = dt.rows({selected: true}).data();
                        if (confirm("Are you sure you want to delete the selected permissions?")) {
                            for (var i = 0, len = selected_array.length; i < len; i++) {

                                deletePermission(selected_array[i][0], 'rolesbtn_' + selected_array[i][0]);
                            }
                        }
                    },
                    className: "btn-danger"
                }
            ]
        }).on("select", function () {
            //console.log("selected");
        });
    }
    if ($('#manage_deleted_posts').length) {
        noticeboardDeletedTable = $('#manage_deleted_posts').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "id",
                    visible: true,
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        return "";
                    }
                },
                {
                    name: "title",
                    searchable: true,
                    render: function (data, type, row) {
                        return "<a href='noticeboard.php?t=view&q=" + row[0] + "&qq=" + row[1] + "'>" + row[2] + "</a><br/><small>Created " + row[4] + "</small>";
                    }
                },
                {
                    name: "details",
                    searchable: false,
                    render: function (data, type, row) {
                        preview = row[3].slice(0, 200);
                        return "<a href='noticeboard.php?t=view&q=" + row[0] + "&qq=" + row[1] + "'>" + preview + "</a>";
                    }
                },
                {
                    name: "status",
                    searchable: false,
                    render: function (data, type, row) {
                        status = "<span class='badge badge-danger'>Deleted</span>";
                        return status;
                    }
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        return "<div class='btn-group'>\n" +
                            "<button type='button' class='btn btn-outline-bright-success btn-sm' data-toggle='modal' data-target='#x_res_" + row[0] + "99" + row[1] + "'><i class='fas fa-sync-alt'></i></button></div>\n" +
                            "<div class='modal fade' id='x_res_" + row[0] + "99" + row[1] + "'>\n" +
                            "    <div class='modal-dialog'>\n" +
                            "        <div class='modal-content'>\n" +
                            "            <div class='modal-header'>\n" +
                            "                <h4 class='modal-title'>Restore Announcement</h4>\n" +
                            "                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>\n" +
                            "                    <span aria-hidden='true'>&times;</span>\n" +
                            "                </button>\n" +
                            "            </div>\n" +
                            "            <div class='modal-body'>\n" +
                            "                <p>Are you sure you want to restore " + row[2] + " ?</p>\n" +
                            "            </div>\n" +
                            "            <div class='modal-footer justify-content-between'>\n" +
                            "                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>\n" +
                            "                <button type='submit' class='btn btn-warning' id='res_" + row[0] + "_999" + row[1] + "' data-announcement='" + row[0] + "' data-unique-id='" + row[1] + "' onclick='restoreAnnouncement(this.id);'>Yes restore</button>\n" +
                            "            </div>\n" +
                            "        </div>\n" +
                            "        <!-- /.modal-content -->\n" +
                            "    </div>\n" +
                            "    <!-- /.modal-dialog -->\n" +
                            "</div>"

                    }
                }
            ],
            columnDefs: [{
                className: 'select-checkbox',
                targets: 0
            }],
            paging: true,
            ajax: {
                url: "inc/ajax/noticeboard_get_all_deleted.inc.php?csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[15, 30, -1], [15, 30, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            },
            buttons: [
                'selectAll',
                'selectNone',
                {
                    text: 'Delete Selected',
                    action: function (e, dt, node, config) {
                        var selected_array = dt.rows({selected: true}).data();
                        if (confirm("Are you sure you want to delete the selected permissions?")) {
                            for (var i = 0, len = selected_array.length; i < len; i++) {

                                deletePermission(selected_array[i][0], 'rolesbtn_' + selected_array[i][0]);
                            }
                        }
                    },
                    className: "btn-danger"
                }
            ]
        }).on("select", function () {
            //console.log("selected");
        });
    }
});
/****************************/

function deleteAnnouncement(this_id){
    var announcement_id,unique_id;
    announcement_id = $("#"+this_id).attr("data-announcement");
    unique_id = $("#"+this_id).attr("data-unique-id");
    console.log(unique_id);
    $.ajax({
        type: "POST",
        url: "inc/ajax/noticeboard.delete.inc.php",
        data: {"announcement_id": announcement_id, "unique_id": unique_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        async: false,
        dataType: "json",
        success: function(response){
            $("#response_post").html(response.message);
            $('#x_del_' + announcement_id + '99'+ unique_id +'').modal('toggle');
            noticeboardTable.ajax.reload();
        },
        error: function(err){
            console.log(err);
            alert(err.responseText);
        }
    });
}

function restoreAnnouncement(this_id){
    var announcement_id,unique_id;
    announcement_id = $("#"+this_id).attr("data-announcement");
    unique_id = $("#"+this_id).attr("data-unique-id");
    console.log(unique_id);
    $.ajax({
        type: "POST",
        url: "inc/ajax/noticeboard.restore.inc.php",
        data: {"announcement_id": announcement_id, "unique_id": unique_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        async: false,
        dataType: "json",
        success: function(response){
            $("#response_post").html(response.message);
            $('#x_res_' + announcement_id + '99'+ unique_id +'').modal('toggle');
            noticeboardDeletedTable.ajax.reload();
        },
        error: function(err){
            console.log(err);
            alert(err.responseText);
        }
    });
}

function deletePermission(id, btn_id){
  var idJSON = "[" + JSON.stringify(id) + "]";
  $.ajax({
    type: "POST",
    url: "admin/inc/ajax/permissions_delete.php",
    data: {"ids": idJSON, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
    async: false,
    success: function(resp){
      noticeboardTable.row( $('#'+btn_id).parents('tr') ).remove().draw();
    },
    error: function(err){
      console.log(err);
      alert(err.responseText);
    }
  });
}


