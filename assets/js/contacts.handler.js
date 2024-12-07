//Function Management scripts
/* HANDLES POPOVERS FOR USER INFO */
var url;
url ='inc/ajax/contacts.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value');

$(function () {
    if ($('#contact_details_pool').length) {
        getAllContactDetails();
    }
});
function getAllContactDetails(){
    var address,img_url, list;
    $.ajax({
        type: 'POST',
        url: url,
        data:{
            ajax_action: 'getAllContactDetails'
        },
        success:function(data){
            $("#contact_details_pool").empty();
            data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                _img_user = data[i]['user_image'];
                if (_img_user === '' || _img_user === null) {
                    img_url = 'user/img/avatars/default_avatar.jpg';
                } else {
                    if (doesFileExist('user/img/avatars/' + _img_user) === false) {
                        img_url = 'user/img/avatars/default_avatar.jpg';
                    } else {
                        img_url = 'user/img/avatars/' + _img_user;
                    }
                }
                address = data[i]['address_line_1'] + ' ' + data[i]['address_line_2'] + ' ' + data[i]['address_line_3'] + ' ' + data[i]['address_line_4'] + ' ' + data[i]['country'];
                list = '<div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">\n' +
                    '              <div class="card bg-light">\n' +
                    '                <div class="card-header text-muted border-bottom-0">\n' +
                    '                  ' + data[i]['job_position'] + '\n' +
                    '                </div>\n' +
                    '                <div class="card-body pt-0">\n' +
                    '                  <div class="row">\n' +
                    '                    <div class="col-7">\n' +
                    '                      <h2 class="lead"><b>' + data[i]['full_name'] + '</b></h2>\n' +
                    '                      <p class="text-muted text-sm"><b>About: </b> ' + data[i]['bio'] + ' </p>\n' +
                    '                      <ul class="ml-4 mb-0 fa-ul text-muted">\n' +
                    '                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: ' + address + '</li>\n' +
                    '                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: ' + data[i]['phone'] + '</li>\n' +
                    '                      </ul>\n' +
                    '                    </div>\n' +
                    '                    <div class="col-5 text-center">\n' +
                    '                      <img src="' + img_url + '" alt="user-avatar" class="img-circle img-fluid">\n' +
                    '                    </div>\n' +
                    '                  </div>\n' +
                    '                </div>\n' +
                    '                <div class="card-footer">\n' +
                    '                  <div class="text-right">\n' +
                    '                    <a href="profile.php?t=profile-v&q='+data[i]['userid']+'" class="btn btn-sm btn-dark">\n' +
                    '                      View Profile\n' +
                    '                    </a>\n' +
                    '                  </div>\n' +
                    '                </div>\n' +
                    '              </div>\n' +
                    '            </div>';

                $(list).appendTo('#contact_details_pool');
            }
            // $("#notifications").html(list);
            //result retrieval queries
            //and
            // setTimeout(getAllContactDetails,500); //call the same function every 1s.
        },
        error:function(err){
            //error handler
        }
    });
}

/****************************/
/* DATATABLE INITIALIZATION */
/****************************/
$(document).ready(function() {
    if ($('#phonebookList').length) {
        phonebookTable = $('#phonebookList').DataTable({
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
                    searchable: true
                },
                {
                    name: "department",
                    searchable: true
                },
                {
                    name: "phone",
                    searchable: true
                },
                {
                    name: "phone ext",
                    width: "90px",
                    searchable: false,
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
                    ajax_action: 'getAllPhoneNumbers'
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
        }).on("select", function () {
            //console.log("selected");
        });
    }

});






