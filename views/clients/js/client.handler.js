var url = '' . VIEWS_URL . 'clients/inc/ajax/client.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value'),
    url_info = window.location.href;

function openViewCompanyModal(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/client-company-view.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#view_modal").html(response);
            $('#x_view_' + request_id + '99').modal('toggle');
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openEditCompanyModal(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/client-company-edit.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#x_modal").html(response);
            $('#x_' + request_id + '99').modal('toggle');
            init_select2();
            init_multiselect();
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openViewCustomerModal(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/client-customer-view.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#x_modal").html(response);
            $('#x_' + request_id + '99').modal('toggle');
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openEditCustomerModal(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/client-customer-edit.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#x_modal").html(response);
            $('#x_' + request_id + '99').modal('toggle');
            init_select2();
            init_multiselect();
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openViewIntermediaryModal(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/client-intermediary-view.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#x_modal").html(response);
            $('#x_' + request_id + '99').modal('toggle');
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openEditIntermediaryModal(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/client-intermediary-edit.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#x_modal").html(response);
            $('#x_' + request_id + '99').modal('toggle');
            init_select2();
            init_multiselect();
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

$(document).ready(function () {
    var companyTable, preview, company_contract_count;
    if ($('table#company_list').length) {
        $('table#company_list').DataTable({
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
                    name: "name",
                    searchable: true,
                    render: function (data, type, row) {
                        return "<a href=''>" + row[1] + "</a>";
                    }
                },
                {
                    name: "company_contract_count",
                    searchable: true,
                    render: function (data, type, row) {
                        company_contract_count = row[2];
                        // company_contract_count = 0;
                        return '<span class="badge badge-success">' + company_contract_count + '</span>';
                    }
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        var request_id = row[0],
                            piece_view_company = "client-company-view",
                            piece_edit_company = "client-company-edit";
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_view_company + '\')"><i class="fas fa-folder-open"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_edit_company + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" data-toggle="modal" data-target="#x_del_' + row[0] + '99' + row[1] + 'announcement"><i class="fas fa-trash"></i></button></div>';
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
                    ajax_action: 'getAllCompanies'
                },
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
    if ($('table#customer_list').length) {
        $('table#customer_list').DataTable({
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
                    name: "name",
                    searchable: true,
                    render: function (data, type, row) {
                        return "<a href=''>" + row[1] + " " + row[2] + "</a>";
                    }
                },
                {
                    name: "company",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[3];
                    }
                },
                {
                    name: "email",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[4];
                    }
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        var request_id = row[0],
                            piece_view_customer = "client-customer-view",
                            piece_edit_customer = "client-customer-edit";
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_view_customer + '\')"><i class="fas fa-folder-open"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_edit_customer + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" data-toggle="modal" data-target="#x_del_' + row[0] + '99' + row[1] + 'announcement"><i class="fas fa-trash"></i></button></div>';
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
                    ajax_action: 'getAllCustomers'
                },
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
    if ($('table#intermediary_list').length) {
        $('table#intermediary_list').DataTable({
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
                    name: "name",
                    searchable: true,
                    render: function (data, type, row) {
                        return "<a href=''>" + row[1] + " " + row[2] + "</a>";
                    }
                },
                {
                    name: "email",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[3];
                    }
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        var request_id = row[0],
                            piece_view_intermediary = "client-intermediary-view",
                            piece_edit_intermediary = "client-intermediary-edit";
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_view_intermediary + '\')"><i class="fas fa-folder-open"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_edit_intermediary + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" data-toggle="modal" data-target="#x_del_' + row[0] + '99' + row[1] + 'announcement"><i class="fas fa-trash"></i></button></div>';
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
                    ajax_action: 'getAllIntermediaries'
                },
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