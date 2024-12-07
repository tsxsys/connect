var url = 'contracts/inc/ajax/contract.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value'),
    url_info = window.location.href,
    passphrase = 'X7aK8nU8zT5jS7bW',
    assetTable, assetEditTable;


$("#contract_no").keyup(function () {
    var assValue = $(this).val();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            ajax_action: 'validateContractNo',
            assValue: assValue,
            "csrf_token": $('meta[name=\'csrf_token\']').attr('value')
        },
        success: function (response) {
            // console.log(response);
            if (response === 'false') {
                $('#contract_no')
                    .addClass('is-invalid')
                    .removeClass('is-valid');
                $('#contract_no_res').text('Contract No. already exists');
                $(".buttonNext.btn.btn-success").addClass("d-none");
            } else if (response === 'true') {
                $('#contract_no')
                    .addClass('is-valid')
                    .removeClass('is-invalid');
                $('#contract_no_res').empty();
                $(".buttonNext.btn.btn-success").removeClass("d-none");
            } else {
                $(".buttonNext.btn.btn-success").addClass("d-none");
            }
        },
        error: function (err) {
            //error handler
        }
    });
});

// $('#enc').change(function () {
//     var encValue = $(this).val(),
//         url_info = window.location.href,
//         field1 = 'iA',
//         field2 = 'vAss';
//     // if ($('input#changeDefaultFin').is(':checked')) {
//     //     $("input#changeDefaultFin").prop("checked", false);
//     // }
//
//     if ((url_info.indexOf('?' + field1 + '=') != -1) && (url_info.indexOf('&' + field2 + '=') != -1)) {
//         var iA = $.urlParam('iA'),
//             vAss = $.urlParam('vAss');
//         if (iA && vAss) {
//             $.ajax({
//                 type: 'POST',
//                 url: "../../includes/functions.ajax.inc.php",
//                 data: {'encValue': encValue, iA: iA, vAss: vAss},
//                 dataType: 'html',
//                 success: function (data) {
//                     $("#encStyle").html(data);
//                     $(".sgh--d-none.encStyle").removeClass("sgh--d-none");
//                 }
//             });
//             if ((encValue == 'Container') || (encValue == 'Small Container')) {
//                 var encContainerValue = encValue;
//                 $.ajax({
//                     type: 'POST',
//                     url: "../../includes/functions.ajax.inc.php",
//                     data: {'encContainerValue': encContainerValue, iA: iA, vAss: vAss},
//                     dataType: 'html',
//                     success: function (data) {
//                         $("#encSize").html(data);
//                         $(".sgh--d-none.encSize").removeClass("sgh--d-none");
//                     }
//                 });
//                 $('select#encStyle').addClass("sgh--select-disabled");
//                 $("#encLiftingCol").removeClass("sgh--d-none");
//                 $("#encHeightCol").removeClass("sgh--d-none");
//                 $("#encBaseCol").addClass("sgh--d-none");
//                 // $("select[name='enc_finishType']")
//                 //     .addClass("sgh--select-disabled")
//                 //     .find("option[value='RAL']")
//                 //     .attr("selected", "selected")
//                 //     .prop("selected", true).change();
//                 // $("select[name='enc_finish']")
//                 //     .addClass("sgh--select-disabled")
//                 //     .find("option[value='7046 Telegrey 2']")
//                 //     .attr("selected", "selected")
//                 //     .prop("selected", true).change();
//             } else {
//                 $('select#encStyle').removeClass("sgh--select-disabled");
//                 $("#encLiftingCol").addClass("sgh--d-none");
//                 $("#encHeightCol").addClass("sgh--d-none");
//                 $("#encBaseCol").removeClass("sgh--d-none");
//                 // $("select[name='enc_finishType']")
//                 //     .addClass("sgh--select-disabled")
//                 //     .find("option[value='RAL']")
//                 //     .attr("selected", "selected")
//                 //     .prop("selected", true).change();
//                 // $("select[name='enc_finish']")
//                 //     .addClass("sgh--select-disabled")
//                 //     .find("option[value='9002 Grey White']")
//                 //     .attr("selected", "selected")
//                 //     .prop("selected", true).change();
//             }
//         }
//     } else {
//         $.ajax({
//             type: 'POST',
//             url: url,
//             data: {
//                 ajax_action: 'fetchBaseOps',
//                 csrf_token: $('meta[name=\'csrf_token\']').attr('value'),
//                 encValue: encValue
//             },
//             dataType: 'html',
//             success: function (data) {
//                 $("#encStyle").html(data);
//                 $(".sgh--d-none.encStyle").removeClass("sgh--d-none");
//             },
//             error: function (err) {
//                 //error handler
//             }
//         });
//         if ((encValue == 'Container') || (encValue == 'Small Container')) {
//             var encContainerValue = encValue;
//             $.ajax({
//                 type: 'POST',
//                 url: url,
//                 data: {'encContainerValue': encContainerValue},
//                 dataType: 'html',
//                 success: function (data) {
//                     $("#encSize").html(data);
//                     $(".sgh--d-none.encSize").removeClass("sgh--d-none");
//                 }
//             });
//             $('select#encStyle').addClass("sgh--select-disabled");
//             $("#encLiftingCol").removeClass("sgh--d-none");
//             $("#encHeightCol").removeClass("sgh--d-none");
//             $("#encBaseCol").addClass("sgh--d-none");
//             // $("select[name='enc_finishType']")
//             //     .addClass("sgh--select-disabled")
//             //     .find("option[value='RAL']")
//             //     .attr("selected", "selected")
//             //     .prop("selected", true).change();
//             // $("select[name='enc_finish']")
//             //     .addClass("sgh--select-disabled")
//             //     .find("option[value='7046 Telegrey 2']")
//             //     .attr("selected", "selected")
//             //     .prop("selected", true).change();
//         } else {
//             $('select#encStyle').removeClass("sgh--select-disabled");
//             $("#encLiftingCol").addClass("sgh--d-none");
//             $("#encHeightCol").addClass("sgh--d-none");
//             $("#encBaseCol").removeClass("sgh--d-none");
//             // $("select[name='enc_finishType']")
//             //     .addClass("sgh--select-disabled")
//             //     .find("option[value='RAL']")
//             //     .attr("selected", "selected")
//             //     .prop("selected", true).change();
//             // $("select[name='enc_finish']")
//             //     .addClass("sgh--select-disabled")
//             //     .find("option[value='9002 Grey White']")
//             //     .attr("selected", "selected")
//             //     .prop("selected", true).change();
//         }
//     }
//     console.log($("select[name='enc_finish']").val());
// });
// $('#encStyle').change(function () {
//     var encValue_ = $('#enc').val(),
//         styleValue_ = $('#encStyle').val(), //get the current value's option
//         sizeValue_ = $('#encSize').val(),
//         url_info = window.location.href,
//         field1 = 'iA',
//         field2 = 'vAss';
//     if ((url_info.indexOf('?' + field1 + '=') != -1) && (url_info.indexOf('&' + field2 + '=') != -1)) {
//         var iA = $.urlParam('iA'),
//             vAss = $.urlParam('vAss');
//         if (iA && vAss) {
//             $.ajax({
//                 type: 'POST',
//                 url: "../../includes/functions.ajax.inc.php",
//                 data: {
//                     'encValue_': encValue_,
//                     'styleValue_': styleValue_,
//                     'sizeValue_': sizeValue_, iA: iA, vAss: vAss
//                 },
//                 success: function (data) {
//                     //in here, for simplicity, you can substitue the HTML for a brand new select box for countries
//                     //1.
//                     $("#encSize").html(data);
//                     $(".sgh--d-none.encSize").removeClass("sgh--d-none");
//
//                     //2.
//                     // iterate through objects and build HTML here
//                 }
//             });
//         }
//     } else {
//         $.ajax({
//             type: 'POST',
//             url: "../../includes/functions.ajax.inc.php",
//             data: {
//                 'encValue_': encValue_,
//                 'styleValue_': styleValue_,
//                 'sizeValue_': sizeValue_
//             },
//             success: function (data) {
//                 //in here, for simplicity, you can substitue the HTML for a brand new select box for countries
//                 //1.
//                 $("#encSize").html(data);
//                 $(".sgh--d-none.encSize").removeClass("sgh--d-none");
//
//                 //2.
//                 // iterate through objects and build HTML here
//             }
//         });
//     }
// });
$('#encSize').change(function () {
    var encValue_1 = $('#enc').val();
    styleValue_1 = $('#encStyle').val(), //get the current value's option
        sizeValue_1 = $('#encSize').val(),
        url_info = window.location.href,
        field1 = 'iA',
        field2 = 'vAss';
    if ((url_info.indexOf('?' + field1 + '=') != -1) && (url_info.indexOf('&' + field2 + '=') != -1)) {
        var iA = $.urlParam('iA'),
            vAss = $.urlParam('vAss');
        if (iA && vAss) {
            $.ajax({
                type: 'POST',
                url: "../../includes/functions.ajax.inc.php",
                data: {
                    'encValue_1': encValue_1,
                    'styleValue_1': styleValue_1,
                    'sizeValue_1': sizeValue_1, iA: iA, vAss: vAss
                },
                success: function (data) {
                    $("#encBase").html(data);
                }
            });
        }
    } else {
        $.ajax({
            type: 'POST',
            url: "../../includes/functions.ajax.inc.php",
            data: {
                'encValue_1': encValue_1,
                'styleValue_1': styleValue_1,
                'sizeValue_1': sizeValue_1
            },
            success: function (data) {
                $("#encBase").html(data);
            }
        });
    }
});

// $("#company").change(function () {
//     var companyValue = $(this).val(),
//         companyAction = $(this).attr('data-action'),
//         vAssValue = window.vAssValue,
//         company_info;
//     if ((typeof vAssValue != "undefined") && (vAssValue != null)) {
//         vAssValue = window.vAssValue;
//     } else {
//         vAssValue = "N/A";
//     }
//     if (companyValue && vAssValue) {
//         $.ajax({
//             url: url,
//             type: 'POST',
//             data: {
//                 ajax_action: 'pullCompanyInfoCreate',
//                 companyValue: companyValue,
//                 companyAction: companyAction,
//                 vAssValue: window.vAssValue
//             },
//             success: function(response){
//                 $("#info").html(response);
//             },
//             error: function(err){
//                 console.log(err);
//                 alert(err.responseText);
//                 console.log(err.responseText);
//             }
//         });
//     }
// });

//Assign Associations
// if ($("#assign_methods").length) {
//     const selectedAssignArr = [];
//     $('#assign_methods').multiSelect({
//         selectBoxHeight: '300px',
//         selectableOptgroup: true,
//         selectableFooter: "<div class='custom-header'>Available Users</div>",
//         selectionFooter: "<div class='custom-header'>Selected Users</div>",
//         selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Search users'>",
//         selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Search users'>",
//         afterInit: function (ms) {
//             var that = this, $selectableSearch = that.$selectableUl.prev(),
//                 $selectionSearch = that.$selectionUl.prev(),
//                 selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
//                 selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';
//             that.qs1 = $selectableSearch.quicksearch(selectableSearchString).on('keydown', function (e) {
//                 if (e.which === 40) {
//                     that.$selectableUl.focus();
//                     return false;
//                 }
//             });
//             that.qs2 = $selectionSearch.quicksearch(selectionSearchString).on('keydown', function (e) {
//                 if (e.which == 40) {
//                     that.$selectionUl.focus();
//                     return false;
//                 }
//             });
//         },
//         afterSelect: function (values) {
//             this.qs1.cache();
//             this.qs2.cache();
//             selectedAssignArr.push(values);
//             console.log("Select value: "+values);
//             console.log(selectedAssignArr);
//         },
//         afterDeselect: function (values) {
//             this.qs1.cache();
//             this.qs2.cache();
//             selectedAssignArr.splice( $.inArray(values, selectedAssignArr), 1 );
//             console.log(selectedAssignArr);
//             console.log("Deselect value: "+values);
//         }
//     });
// }
// $('#select-all').on('click', function () {
//     $('#assign_methods').multiSelect('select_all');
//     return false;
// });
// $('#deselect-all').on('click', function () {
//     $('#assign_methods').multiSelect('deselect_all');
//     return false;
// });

//Functions


/* -------------Javascript code example-----------------*/
var CryptoJSAesJson = {
    stringify: function (cipherParams) {
        var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
        if (cipherParams.iv) j.iv = cipherParams.iv.toString();
        if (cipherParams.salt) j.s = cipherParams.salt.toString();
        return JSON.stringify(j);
    },
    parse: function (jsonStr) {
        var j = JSON.parse(jsonStr);
        var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
        if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
        if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
        return cipherParams;
    }
}
// var key = "123456";
// var encrypted = CryptoJS.AES.encrypt(JSON.stringify("value to encrypt"), key, {format: CryptoJSAesJson}).toString();
// console.log(encrypted);
// var decrypted = JSON.parse(CryptoJS.AES.decrypt(encrypted, key, {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));
// console.log("decryyepted: "+decrypted);
function pullElectricalSpecificationForm(request_id = '') {
    var current_flow = $('input[name="current_flow"]:checked').val(),
        load_type = $('input[name="load_type"]:checked').val(),
        config = $('input[name="config"]:checked').val(),
        usage_frequency = $('input[name="usage_frequency"]:checked').val();//get the current value's option
    if (current_flow && load_type && config && usage_frequency) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                ajax_action: 'pullElectricalSpecificationForm',
                csrf_token: $('meta[name=\'csrf_token\']').attr('value'),
                current_flow: current_flow, load_type: load_type, config: config,
                usage_frequency: usage_frequency, request_id: request_id
            },
            success: function (data) {
                console.log(config);
                $("#x_electrical_specification").empty();
                $("#x_electrical_specification").html(data);
            }
        });
    }
}

$(document).on('change', '.electrical_spec_config input', function () {
    var request_id = this.form.getAttribute('data-xeid');
    pullElectricalSpecificationForm(JSON.stringify(request_id));
});

function enc_selection(el_id) {
    var el = $('#' + el_id),
        encValue = el.find(':selected').attr('data-enclosure_value'),
        encType = el.find(':selected').attr('data-encType');
    $("#encStyle").empty();
    if ($("#encSizeSelect").length) {
        $(this).empty();
    }
    if ($("#encBaseSelect").length) {
        $(this).empty();
    }
    console.log(encValue);
    if (encValue && encType) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                ajax_action: 'getStyleOps',
                csrf_token: $('meta[name=\'csrf_token\']').attr('value'),
                encValue: encValue, encType: encType
            },
            dataType: 'html',
            success: function (data) {
                $("#encStyle").html(data);
                smart_form_auto_height('smart_contract_form');
            },
            error: function (err) {
                //error handler
            }
        });
    }

}

function getSizeOps() {
    var encValue = $('#enc').find(':selected').attr('data-enclosure_value'),
        encStyle = $('#encStyleSelect').val();
    if ($("#encSizeSelect").length) {
        $(this).empty();
    }
    if ($("#encBaseSelect").length) {
        $(this).empty();
    }
    if (encValue && encStyle) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                ajax_action: 'getSizeOps',
                csrf_token: $('meta[name=\'csrf_token\']').attr('value'),
                encValue: encValue, encStyle: encStyle
            },
            success: function (data) {
                $("#encSizeSelect").html(data);
            }
        });
    }
}

function getBaseOps() {
    var encValue = $('#enc').find(':selected').attr('data-enclosure_value'),
        encStyle = $('#encStyleSelect').val(),
        encSize = $('#encSizeSelect').val(); //get the current value's option
    console.log(encValue + ' ' + encStyle + ' ' + encSize);
    if ($("#encBaseSelect").length) {
        $(this).empty();
    }
    if (encValue && encStyle && encSize) {
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                ajax_action: 'getBaseOps',
                csrf_token: $('meta[name=\'csrf_token\']').attr('value'),
                encValue: encValue, encStyle: encStyle, encSize: encSize
            },
            success: function (data) {
                $("#encBaseSelect").html(data);
            }
        });
    }
}


function openPendingContract(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/contract-record-pending-approval.piece.php",
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

function openAssignAssociations(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/contract-assign-associations.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#x_modal").html(response);
            $('#x_' + request_id + '99').modal('toggle');
            init_multiselect();
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openSignContract(btn_id, form_id) {
    'use strict';
    if (!$("#" + btn_id).hasClass('disabled')) {
        var form = $('form#' + form_id),
            formData = form.serialize() + "&request_id=" + form.attr('data-xeid') + "&ajax_action=" + $('#' + btn_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
            formRole = form.attr('data-role'),
            btnLabel = $('#' + btn_id + ' .label').text(),
            messageBox = form.find('div .message');
        $.ajax({
            url: url,
            type: "POST",
            cache: false,
            data: formData,
            dataType: "json",
            processData: false,
            success: function (response) {
                /***********************
                 ***  For debugging  ***
                 ***********************/
                // console.log(response.message);
                // console.log(response.arr);
                if (response.status === true) {
                    $('#' + btn_id + ' .label').text('Signed').fadeIn();
                    $('#' + btn_id).prop('disabled', false);
                    $('#' + form_id + ' input').prop('disabled', false);
                    var timeleft = 4,
                        milisecs = timeleft * 1000,
                        downloadTimer = setInterval(function () {
                            timeleft--;
                            console.log(timeleft);
                            $("#" + form_id + " .sgh--modal-footer-response")
                                .addClass("clear")
                                .text("Page will reload in " + timeleft);
                            if (timeleft <= 0) {
                                clearInterval(downloadTimer);
                            }
                        }, 1000);
                    var timer = setTimeout(function () {
                        window.location.reload();
                    }, milisecs);
                } else if (response.status === false) {
                    messageBox.html(response.err_message);
                }
            },
            beforeSend: function () {
                $('#' + form_id + ' input').prop('disabled', true);
                $('#' + btn_id).prop('disabled', true);
                $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
            },
            error: function (response) {
                alert(response.err_message);
                $('#' + btn_id + ' .label').text(btnLabel).fadeIn();
                $('#' + btn_id).prop('disabled', false);
                $('#' + form_id + ' input').prop('disabled', false);
            }
        });
    }
}

function setContractSoftware(elem_id) {
    'use strict';
    var elem = $('#' + elem_id),
        ajax_action, formData;
    if (elem.is(':checked')) {
        ajax_action = "setContractSoftware";
    } else {
        ajax_action = "unsetContractSoftware";
    }
    formData = "&contract_id=" + JSON.stringify(elem.attr('data-xeid')) + "&software_id=" + elem.val() + "&ajax_action=" + ajax_action + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value");

    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: formData,
        dataType: "json",
        processData: false,
        success: function (response) {
            /***********************
             ***  For debugging  ***
             ***********************/
            // console.log(response.message);
            // console.log(response.arr);
            if (response.status === true) {
                console.log(response.message);
            } else if (response.status === false) {
                console.log(response);

            }
        },
        error: function (response) {
            console.log(response.err_message);
        }
    });
}

function setAssetUPin(elem_id) {
    'use strict';
    var elem = $('#' + elem_id),
        ajax_action = elem.attr('data-action'),
        formData,
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });

    formData = "&contract_id=" + elem.attr('data-xeid') + "&ajax_action=" + ajax_action + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value");

    $.ajax({
        url: url,
        type: "POST",
        cache: false,
        data: formData,
        dataType: "json",
        processData: false,
        success: function (response) {
            if (response.status === true) {
                console.log(response.message);
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
            } else if (response.status === false) {
                console.log(response.err_message);
            }
        },
        error: function (response) {
            console.log(response.status);
        }
    });
}


function intervalTrigger() {
    window.setInterval(function () {
        $("#message_leave_request").fadeOut();
    }, 8000);
}


//Dependencies
function init_contract_form() {
    init_IonRangeSlider();
    init_control();
    init_TagsInput();
    init_sel_other();
    color_select();
    init_select2();
    init_multiselect();

    trigger_change('#company_add');
    trigger_change('.electrical_spec_config input[type=radio]');
    trigger_change('#mechSel select');
}

function init_specSelections() {
    specSelection();
    mechSelection();
    init_IonRangeSlider();
    init_control();
    init_TagsInput();
    init_sel_other();
    color_select();

    // $("select.withOther ~ textarea").hide().prop('disabled', true);
    // $(".withOther ~ .otherField").hide().prop('disabled', true);
    // $("select.withOther").change(function () {
    //     var val = $(this).val();
    //     if (val === "Other") {
    //         $(this).siblings("textarea").show().prop('disabled', false);
    //         $(this).siblings(".otherField").show().prop('disabled', false);
    //     } else {
    //         $(this).siblings("textarea").hide().prop('disabled', true);
    //         $(this).siblings(".otherField").hide().prop('disabled', true);
    //     }
    // });

    $("#otherType").hide();
    $("#docType").change(function () {
        var val = $(this).val();
        if (val === "Other") {
            $("#otherType").show();
        } else {
            $("#otherType").hide();
        }
    });

    radiocurrent_flow = 'input[type=radio][name=current_flow]';
    radioload_type = 'input[type=radio][name=load_type]';
    radioConfig = 'input[type=radio][name=config]';
    $(radiocurrent_flow).change(function () {
        specSelection();
    });
    $(radioload_type).change(function () {
        specSelection();
    });
    $(radioConfig).change(function () {
        specSelection();
    });

    // Star only
    $("#ac_res_rac .mainKWCal").bind("keyup change", function () {
        $('#ac_res_rac #supplyConditions').kwCalculation2();
    });
    $("#ac_res_rac .mainKWSDCal").bind("keyup change", function () {
        $('#ac_res_rac #supplyConditionsSD').kwCalculation();
    });
// Star Delta
    $("#ac_res_rac_sd .mainKWCal").bind("keyup change", function () {
        $('#ac_res_rac_sd #supplyConditions').kwCalculation2();
    });
    $("#ac_res_rac_sd .mainKWSDCal").bind("keyup change", function () {
        $('#ac_res_rac_sd #supplyConditionsSD').kwCalculation();
    });
}

function ts_generate_a_form1(this_id) {
    'use strict';
    var smart_contract_form = $("#smart_contract_form"),
        delay = 1000,
        contract_type = $('input#' + this_id + '[name=contract_type]:checked').val();
    // $("#smartLoader")
    //     .addClass("loading")
    //     .html("<img src='' . ASSETS_URL . 'img/elements/loaders/loader2.gif' alt=''><p>Please wait...</p>");
    smart_contract_form.smartWizard("loader", "show");
    smart_contract_form.smartWizard("reset");
    setTimeout(function () {
        smart_contract_form.smartWizard("next");
        if (contract_type === 'Single Unit') {
            $('#step_2').html('<div class="row m-b-30"><div class="col-md-3"><h2 class="StepTitle">Current Flow</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="current_flow" value="AC" class="md-radio" checked><span class="circle"></span><span class="check"></span> AC </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="current_flow" value="DC Constant Current" class="md-radio" id="DCCI"><span class="circle"></span><span class="check"></span> DC Constant Current </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="current_flow" value="DC Constant Voltage" class="md-radio" id="DCCV"><span class="circle"></span><span class="check"></span> DC Constant Voltage </label></div></div><div class="col-md-3"><h2 class="StepTitle">Load Type</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive" class="md-radio" id="resistive" checked><span class="circle"></span><span class="check"></span> Resistive </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive/Reactive" class="md-radio" id="ResistiveReactive"><span class="circle"></span><span class="check"></span> Resistive/Reactive </label></div><!-- <div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive/Capacitive" class="md-radio" disabled><span class="circle"></span><span class="check"></span> Resistive/Capacitive </label></div>--></div><div class="col-md-3"><h2 class="StepTitle">Configuration</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Single Phase" class="md-radio" checked><span class="circle"></span><span class="check"></span> Single Phase </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Star" class="md-radio" checked><span class="circle"></span><span class="check"></span> Star </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Delta" class="md-radio"><span class="circle"></span><span class="check"></span> Delta </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Star/Delta" class="md-radio" id="StarDelta"><span class="circle"></span><span class="check"></span> Star/Delta </label></div></div><div class="col-md-3"><h2 class="StepTitle">Usage</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="usage_frequency" value="Periodically" class="md-radio" checked><span class="circle"></span><span class="check"></span> Periodically </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="usage_frequency" value="Continuous" class="md-radio"><span class="circle"></span><span class="check"></span> Continuous </label></div></div></div><div class="ln_solid"></div><div class="well sgh--borderless" style="background-color: #fff;" id="ac_res"><div class="form-group row mt-3"><label for="mainKW" class="col-sm-3 col-form-label text-right">Power rating <span class="required">*</span></label><div class="col-sm-6 col-xs-12"><div class="input-group"><input type="number" class="form-control form-control-border form-control-sm" name="mainKW" required id="mainKW"><div class="input-group-append"><span class="input-group-text">kW</span></div></div></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS</label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>Hz</label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></select></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group supplyPH"><label>PH</label><select class="form-control form-control-sm supplyPH" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group supplyW"><label>WIRE</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="supplyW" value="2" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 2</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="supplyW" value="3" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 3</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="supplyW" value="4" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 4</label></div></div></div></div></div><div class="well sgh--borderless" style="background-color: #fff;" id="ac_res_sd"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">Star kW: *</label></span></div><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKWSD" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">Delta kW: *</label></span></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small>Delta</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Delta</small></label><select class="form-control form-control-sm withOther" name="supplyHzSD"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>PH</label><select class="form-control form-control-sm" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>WIRE</label><select class="form-control form-control-sm" name="supplyW"><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="3/4">3/4</option></select></div></div></div></div> <div id="ac_res_rac"><div class="well sgh--borderless" style="background-color: #fff;"><div class="row" id="supplyConditions"><h4 class="StepTitle">Power rating</h4><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKVA" type="number" placeholder="7000" class="sgh-input mainKWCal" id="mainKVA" required><label for="mainKVA" class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF"><span data-component="Input" class="sgh-input-wrapper"><input id="mainPF" name="mainPF" step="0.01" max="1" type="number" placeholder="0.6" class="sgh-input mainKWCal" required><label for="mainPF" class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" id="mainKW"><label for="mainKW" class="sgh-form-item-label sgh-form-item-label-top">kW: </label></span></span></div></div><div class="well sgh--borderless" style="background-color: #fff;"><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS</label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>Hz</label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>PH</label><select class="form-control form-control-sm supplyPH" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>WIRE</label><select class="form-control form-control-sm" name="supplyW"><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="3/4">3/4</option></select></div></div></div></div></div> <div id="ac_res_rac_sd"><div class="well sgh--borderless" style="background-color: #fff;"><div class="row" id="supplyConditions"><h4>Power rating <small>Star power rating</small></h4><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKVA" type="number" placeholder="7000" class="sgh-input mainKWCal" id="mainKVA" required><label class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF"><span data-component="Input" class="sgh-input-wrapper"><input id="mainPF" name="mainPF" step="0.01" max="1" type="number" placeholder="0.6" class="sgh-input mainKWCal" required><label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" id="mainKW"><label class="sgh-form-item-label sgh-form-item-label-top">kW: </label></span></span></div><div class="row" id="supplyConditionsSD" ><h4>Power rating <small>Delta power rating if required</small></h4><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKVASD" type="number" class="sgh-input mainKWSDCal"><label class="sgh-form-item-label sgh-form-item-label-top">kVA: </label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF"><span data-component="Input" class="sgh-input-wrapper"><input name="mainPFSD" type="number" step="0.01" max="1" placeholder="" class="sgh-input mainKWSDCal"><label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: </label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKWSD" type="number" placeholder="" class="sgh-input" required=""><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></span></div></div> <div class="well sgh--borderless" style="background-color: #fff;"><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small class="labelStar">Delta</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Delta</small></label><select class="form-control form-control-sm withOther" name="supplyHzSD"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>PH</label><select class="form-control form-control-sm supplyPH" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>WIRE</label><select class="form-control form-control-sm" name="supplyW"><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="3/4">3/4</option></select></div></div></div></div></div> <div class="well sgh--borderless" style="background-color: #fff;" id="dc_cc_res"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Min</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Max</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><input type="hidden" name="supplyHzSD" value="N/A"><input type="hidden" name="supplyPH" value="N/A"></div></div><div class="well sgh--borderless" style="background-color: #fff;" id="dc_cc_res_sd"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV"><div class="form-group"><label>VOLTS <small>Star Min</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV2"><div class="form-group"><label>VOLTS <small>Star Max</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Delta Min</small></label><select class="form-control form-control-sm withOther" name="supplyVD1"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="number" name="supplyVD1Other" placeholder="Please state..."></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Delta Max</small></label><select class="form-control form-control-sm withOther" name="supplyVD2"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVD2Other" placeholder="Please state..."></div></div><input type="hidden" name="supplyHzSD" value="N/A"><input type="hidden" name="supplyPH" value="N/A"></div></div><div class="well sgh--borderless" style="background-color: #fff;" id="dc_cv_res"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></div><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainAMPS" type="number" class="sgh-input" required><label for="mainAMPS" class="sgh-form-item-label sgh-form-item-label-top">AMPS: *</label></span></div></div><input type="hidden" name="supplyV" value="N/A"><input type="hidden" name="supplyVSD" value="N/A"><input type="hidden" name="supplyHz" value="N/A"><input type="hidden" name="supplyHzSD" value="N/A"><input type="hidden" name="supplyPH" value="N/A"></div><div class="ln_solid"></div><h2 class="StepTitle">Auxiliary Supply</h2><div class="form-group" style="padding-left: 15px;"><label>Auxiliary Type</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="Internal" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Internal </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="External" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> External </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="Switched" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Switched </label></div></div><div class="row"><div class="form-group col-md-3"><label>VOLTS</label><select class="form-control form-control-sm withOther" name="auxSV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="auxSVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div><div class="form-group col-md-3"><label>Hz</label><select class="form-control form-control-sm" name="auxSHz"><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option></select></div><div class="form-group col-md-3"><label>PH</label><select class="form-control form-control-sm" name="auxSPH"><option value="1">1</option><option value="3">3</option></select></div><div class="form-group col-md-3"><div class="form-group auxSW"><label>WIRE</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxSW" value="2" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 2</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxSW" value="3" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 3</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxSW" value="4" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 4</label></div></div></div></div><div class="ln_solid"></div><h2 class="StepTitle">Ambient Temperature Operation Range <b>&#8451;</b></h2><input type="text" id="range_temperature" name="range" /><input type="hidden" id="range_tempC" name="range_temp_C" />' +
                '<h2 class="StepTitle">Control System</h2><div class="form-group" style="padding-left: 15px;"><label>Controller</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="Baseload" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Baseload </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="KCS" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> KCS </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="MCS" class="md-checkbox open_xtra" data-action="nova"><span class="checkbox-material"><span class="check"></span></span> MCS </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="Toggle Switches" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Toggle Switches </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="Tracker" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Tracker </label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller" value="WTT" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> WTT </label></div></div><div class="row content_option_nova sgh--d-none"><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_sub[]" value="Nova" class="md-checkbox open_xtra" data-action="nova_xtra"><span class="checkbox-material"><span class="check"></span></span> Nova </label></div></div><div class="row content_option_nova_xtra sgh--d-none"><p>Controller Packages</p><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_packages[]" value="Nova Platform PC software" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Nova Platform PC software</label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_packages[]" value="Nova Platform LC80 Controller" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Nova Platform LC80 Controller </label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_packages[]" value="Solar Platform Controller" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Solar Platform Controller </label></div><p>Interconnecting Packages</p><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="interconnecting_packages[]" value="Interconnection Package 1" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Interconnection Package 1 </label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="interconnecting_packages[]" value="Interconnection Package 2" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Interconnection Package 2 </label></div></div><div class="form-group row" id="leadSection"><div class="col-md-3"><label>Control Leads</label><select class="form-control form-control-sm withOther" id="lead"><option value="Comms Lead">Comms Lead</option><option value="Ext Reel">Ext Reel</option><option value="HHT Lead">HHT Lead</option><option value="KCS100HM Lead">KCS100HM Lead</option><option value="LC60 Lead">LC60 Lead</option><option value="LC80 Lead">LC80 Lead</option><option value="PC Lead">PC Lead</option><option value="System Extend Lead">System Extend Lead</option><option value="System extend Standard">System extend Standard</option><option value="System extend Advanced">System extend Advanced</option><option value="Other">Other</option></select><input class="form-control leadInput otherField" id="leadOther" type="text" placeholder="Please State.."></div><div class="col-md-3"><label>Length</label><select class="form-control form-control-sm withOther" id="leadLength"><option value="5m">5m</option><option value="10m">10m</option><option value="20m">20m</option><option value="50m">50m</option><option value="100m">100m</option><option value="Other">Other</option></select><input class="form-control leadInput otherField" id="leadLengthOther" type="text" placeholder="Please State.."></div><div class="col-md-3"><label>Quantity</label><input class="form-control form-control-sm leadInput" id="leadNo" type="number"></div><div class="col-md-3" style="margin-top: 25px;"><button class="btn-sm btn btn-success" id="addControlLead" type="button" onclick="add_control_lead();">Add</button></div></div><div class="form-group"><label>Controller Leads Selected</label><input id="tags_1" type="text" class="tags form-control" /><div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div><input class="form-control sgh--tags-box" type="hidden" name="leads" id="conLeads"></div><div class="form-group"><label>Controller Information</label><textarea class="form-control" id="control_info" name="control_info" rows="3" style="margin: 0 78px 0 0; width: 100%; height: 84px;" title="Controller Information"></textarea></div></div>');
        } else if (contract_type === "Combi") {
            smart_contract_form.data('smartWizard')._showStep(3);
            smart_contract_form.smartWizard("_showStep", [3], "enable");
            smart_contract_form.smartWizard("_showStep", [3], "show");
            $("#step_2").html('<div class="row m-b-30"><div class="col-md-3"><h2 class="StepTitle">Current Flow</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="current_flow" value="AC" class="md-radio" checked><span class="circle"></span><span class="check"></span> AC </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="current_flow" value="DC Constant Current" class="md-radio" id="DCCI"><span class="circle"></span><span class="check"></span> DC Constant Current </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="current_flow" value="DC Constant Voltage" class="md-radio" id="DCCV"><span class="circle"></span><span class="check"></span> DC Constant Voltage </label></div></div><div class="col-md-3"><h2 class="StepTitle">Load Type</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive" class="md-radio" id="resistive" checked><span class="circle"></span><span class="check"></span> Resistive </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive/Reactive" class="md-radio" id="ResistiveReactive"><span class="circle"></span><span class="check"></span> Resistive/Reactive </label></div><!-- <div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive/Capacitive" class="md-radio" disabled><span class="circle"></span><span class="check"></span> Resistive/Capacitive </label></div>--></div><div class="col-md-3"><h2 class="StepTitle">Configuration</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Single Phase" class="md-radio" checked><span class="circle"></span><span class="check"></span> Single Phase </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Star" class="md-radio" checked><span class="circle"></span><span class="check"></span> Star </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Delta" class="md-radio"><span class="circle"></span><span class="check"></span> Delta </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="config" value="Star/Delta" class="md-radio" id="StarDelta"><span class="circle"></span><span class="check"></span> Star/Delta </label></div></div><div class="col-md-3"><h2 class="StepTitle">Usage</h2><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="usage_frequency" value="Periodically" class="md-radio" checked><span class="circle"></span><span class="check"></span> Periodically </label></div><div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="usage_frequency" value="Continuous" class="md-radio"><span class="circle"></span><span class="check"></span> Continuous </label></div></div></div><div class="ln_solid"></div><div class="well sgh--borderless" style="background-color: #fff;" id="ac_res"><div class="form-group row mt-3"><label for="mainKW" class="col-sm-3 col-form-label text-right">Power rating <span class="required">*</span></label><div class="col-sm-6 col-xs-12"><div class="input-group"><input type="number" class="form-control form-control-border form-control-sm" name="mainKW" required id="mainKW"><div class="input-group-append"><span class="input-group-text">kW</span></div></div></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS</label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>Hz</label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></select></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group supplyPH"><label>PH</label><select class="form-control form-control-sm supplyPH" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group supplyW"><label>WIRE</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="supplyW" value="2" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 2</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="supplyW" value="3" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 3</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="supplyW" value="4" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 4</label></div></div></div></div></div><div class="well sgh--borderless" style="background-color: #fff;" id="ac_res_sd"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">Star kW: *</label></span></div><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKWSD" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">Delta kW: *</label></span></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small>Delta</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Delta</small></label><select class="form-control form-control-sm withOther" name="supplyHzSD"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>PH</label><select class="form-control form-control-sm" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>WIRE</label><select class="form-control form-control-sm" name="supplyW"><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="3/4">3/4</option></select></div></div></div></div> <div id="ac_res_rac"><div class="well sgh--borderless" style="background-color: #fff;"><div class="row" id="supplyConditions"><h4 class="StepTitle">Power rating</h4><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKVA" type="number" placeholder="7000" class="sgh-input mainKWCal" id="mainKVA" required><label for="mainKVA" class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF"><span data-component="Input" class="sgh-input-wrapper"><input id="mainPF" name="mainPF" step="0.01" max="1" type="number" placeholder="0.6" class="sgh-input mainKWCal" required><label for="mainPF" class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" id="mainKW"><label for="mainKW" class="sgh-form-item-label sgh-form-item-label-top">kW: </label></span></span></div></div><div class="well sgh--borderless" style="background-color: #fff;"><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS</label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>Hz</label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>PH</label><select class="form-control form-control-sm supplyPH" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>WIRE</label><select class="form-control form-control-sm" name="supplyW"><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="3/4">3/4</option></select></div></div></div></div></div> <div id="ac_res_rac_sd"><div class="well sgh--borderless" style="background-color: #fff;"><div class="row" id="supplyConditions"><h4>Power rating <small>Star power rating</small></h4><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKVA" type="number" placeholder="7000" class="sgh-input mainKWCal" id="mainKVA" required><label class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF"><span data-component="Input" class="sgh-input-wrapper"><input id="mainPF" name="mainPF" step="0.01" max="1" type="number" placeholder="0.6" class="sgh-input mainKWCal" required><label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" id="mainKW"><label class="sgh-form-item-label sgh-form-item-label-top">kW: </label></span></span></div><div class="row" id="supplyConditionsSD" ><h4>Power rating <small>Delta power rating if required</small></h4><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKVASD" type="number" class="sgh-input mainKWSDCal"><label class="sgh-form-item-label sgh-form-item-label-top">kVA: </label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF"><span data-component="Input" class="sgh-input-wrapper"><input name="mainPFSD" type="number" step="0.01" max="1" placeholder="" class="sgh-input mainKWSDCal"><label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: </label></span></span><span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKWSD" type="number" placeholder="" class="sgh-input" required=""><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></span></div></div> <div class="well sgh--borderless" style="background-color: #fff;"><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Star</small></label><select class="form-control form-control-sm withOther" name="supplyHz"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>VOLTS <small class="labelStar">Delta</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>Hz <small>Delta</small></label><select class="form-control form-control-sm withOther" name="supplyHzSD"><option value="N/A">N/A</option><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyHzSDOther" placeholder="Please state..."></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>PH</label><select class="form-control form-control-sm supplyPH" name="supplyPH"><option value="N/A">N/A</option><option value="1">1</option><option value="3">3</option></select></div></div><div class="col-md-2 col-sm-4 col-xs-12"><div class="form-group"><label>WIRE</label><select class="form-control form-control-sm" name="supplyW"><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="3/4">3/4</option></select></div></div></div></div></div> <div class="well sgh--borderless" style="background-color: #fff;" id="dc_cc_res"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Min</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Max</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><input type="hidden" name="supplyHzSD" value="N/A"><input type="hidden" name="supplyPH" value="N/A"></div></div><div class="well sgh--borderless" style="background-color: #fff;" id="dc_cc_res_sd"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></div></div><h4 class="StepTitle">Test Supply</h4><div class="row"><div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV"><div class="form-group"><label>VOLTS <small>Star Min</small></label><select class="form-control form-control-sm withOther" name="supplyV"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div></div><div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV2"><div class="form-group"><label>VOLTS <small>Star Max</small></label><select class="form-control form-control-sm withOther" name="supplyVSD"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVSDOther" placeholder="Please state..."></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Delta Min</small></label><select class="form-control form-control-sm withOther" name="supplyVD1"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="number" name="supplyVD1Other" placeholder="Please state..."></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label>VOLTS <small>Delta Max</small></label><select class="form-control form-control-sm withOther" name="supplyVD2"><option value="N/A">N/A</option><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="supplyVD2Other" placeholder="Please state..."></div></div><input type="hidden" name="supplyHzSD" value="N/A"><input type="hidden" name="supplyPH" value="N/A"></div></div><div class="well sgh--borderless" style="background-color: #fff;" id="dc_cv_res"><div class="row"><h4 class="StepTitle">Power rating</h4><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainKW" type="number" class="sgh-input" required><label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label></span></div><div class="sgh-form-item col-sm-6 col-xs-12"><span data-component="Input" class="sgh-input-wrapper"><input name="mainAMPS" type="number" class="sgh-input" required><label for="mainAMPS" class="sgh-form-item-label sgh-form-item-label-top">AMPS: *</label></span></div></div><input type="hidden" name="supplyV" value="N/A"><input type="hidden" name="supplyVSD" value="N/A"><input type="hidden" name="supplyHz" value="N/A"><input type="hidden" name="supplyHzSD" value="N/A"><input type="hidden" name="supplyPH" value="N/A"></div><div class="ln_solid"></div><h2 class="StepTitle">Auxiliary Supply</h2><div class="form-group" style="padding-left: 15px;"><label>Auxiliary Type</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="Internal" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Internal </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="External" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> External </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="Switched" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Switched </label></div></div><div class="row"><div class="form-group col-md-3"><label>VOLTS</label><select class="form-control form-control-sm withOther" name="auxSV"><option value="230">230</option><option value="240">240</option><option value="380">380</option><option value="400">400</option><option value="415">415</option><option value="480">480</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="auxSVOther" placeholder="Please state..." onkeypress="return isNumberSlash();"></div><div class="form-group col-md-3"><label>Hz</label><select class="form-control form-control-sm" name="auxSHz"><option value="50">50</option><option value="60">60</option><option value="50/60">50/60</option></select></div><div class="form-group col-md-3"><label>PH</label><select class="form-control form-control-sm" name="auxSPH"><option value="1">1</option><option value="3">3</option></select></div><div class="form-group col-md-3"><div class="form-group auxSW"><label>WIRE</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxSW" value="2" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 2</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxSW" value="3" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 3</label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxSW" value="4" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> 4</label></div></div></div></div><div class="ln_solid"></div><h2 class="StepTitle">Ambient Temperature Operation Range <b>&#8451;</b></h2><input type="text" id="range_temperature" name="range" /><input type="hidden" id="range_tempC" name="range_temp_C" />' +
                '<h2 class="StepTitle">Control System</h2><div class="form-group" style="padding-left: 15px;"><label>Controller</label><div class="row"></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="Baseload" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Baseload </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="KCS" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> KCS </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="MCS" class="md-checkbox open_xtra" data-action="nova"><span class="checkbox-material"><span class="check"></span></span> MCS </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="Toggle Switches" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Toggle Switches </label></div><div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="controller" value="Tracker" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> Tracker </label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller" value="WTT" class="md-checkbox"><span class="checkbox-material"><span class="check"></span></span> WTT </label></div></div><div class="row content_option_nova sgh--d-none"><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_sub[]" value="Nova" class="md-checkbox open_xtra" data-action="nova_xtra"><span class="checkbox-material"><span class="check"></span></span> Nova </label></div></div><div class="row content_option_nova_xtra sgh--d-none"><p>Controller Packages</p><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_packages[]" value="Nova Platform PC software" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Nova Platform PC software</label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_packages[]" value="Nova Platform LC80 Controller" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Nova Platform LC80 Controller </label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="controller_packages[]" value="Solar Platform Controller" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Solar Platform Controller </label></div><p>Interconnecting Packages</p><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="interconnecting_packages[]" value="Interconnection Package 1" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Interconnection Package 1 </label></div><div class="sgh--checkbox checkbox-default"><label><input type="checkbox" name="interconnecting_packages[]" value="Interconnection Package 2" class="md-checkbox open_xtra1" data-action="nova_xtra1"><span class="checkbox-material"><span class="check"></span></span> Interconnection Package 2 </label></div></div><div class="form-group row" id="leadSection"><div class="col-md-3"><label>Control Leads</label><select class="form-control form-control-sm withOther" id="lead"><option value="Comms Lead">Comms Lead</option><option value="Ext Reel">Ext Reel</option><option value="HHT Lead">HHT Lead</option><option value="KCS100HM Lead">KCS100HM Lead</option><option value="LC60 Lead">LC60 Lead</option><option value="LC80 Lead">LC80 Lead</option><option value="PC Lead">PC Lead</option><option value="System Extend Lead">System Extend Lead</option><option value="System extend Standard">System extend Standard</option><option value="System extend Advanced">System extend Advanced</option><option value="Other">Other</option></select><input class="form-control leadInput otherField" id="leadOther" type="text" placeholder="Please State.."></div><div class="col-md-3"><label>Length</label><select class="form-control form-control-sm withOther" id="leadLength"><option value="5m">5m</option><option value="10m">10m</option><option value="20m">20m</option><option value="50m">50m</option><option value="100m">100m</option><option value="Other">Other</option></select><input class="form-control leadInput otherField" id="leadLengthOther" type="text" placeholder="Please State.."></div><div class="col-md-3"><label>Quantity</label><input class="form-control form-control-sm leadInput" id="leadNo" type="number"></div><div class="col-md-3" style="margin-top: 25px;"><button class="btn-sm btn btn-success" id="addControlLead" type="button" onclick="add_control_lead();">Add</button></div></div><div class="form-group"><label>Controller Leads Selected</label><input id="tags_1" type="text" class="tags form-control" /><div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div><input class="form-control sgh--tags-box" type="hidden" name="leads" id="conLeads"></div><div class="form-group"><label>Controller Information</label><textarea class="form-control" id="control_info" name="control_info" rows="3" style="margin: 0 78px 0 0; width: 100%; height: 84px;" title="Controller Information"></textarea></div></div>');
            $("#step_3").html('<div class="row m-b-30"><div class="col-md-4"><h2 class="StepTitle">Cooling Type</h2><div class="sgh--radio radio radio-default sgh--inline-block"><label><input type="radio" name="coolingType" value="Cast Resin" class="md-radio" checked><span class="circle"></span><span class="check"></span> Cast Resin </label></div><div class="sgh--radio radio radio-default sgh--inline-block"><label><input type="radio" name="coolingType" value="Oil Cooled" class="md-radio"><span class="circle"></span><span class="check"></span> Oil Cooled </label></div></div><div class="col-md-8"><h2 class="StepTitle">Transformer Rating</h2><div class="col-md-6"><label>Primary Rating (Volts)</label><input class="form-control" type="number" name="txPRating"></div><div class="col-md-6"><label>Secondary Rating (Volts)</label><input class="form-control" type="number" name="txSRating"></div></div></div><div class="row m-b-30"><div class="col-md-4"><h2 class="StepTitle">Fan Rotation</h2><div class="sgh--radio radio radio-default sgh--inline-block"><label><input type="radio" name="fanRotation" value="Anticlockwise" class="md-radio" checked><span class="circle"></span><span class="check"></span> Anticlockwise </label></div><div class="sgh--radio radio radio-default sgh--inline-block"><label><input type="radio" name="fanRotation" value="Clockwise" class="md-radio"><span class="circle"></span><span class="check"></span> Clockwise </label></div></div><div class="col-md-8"><h2 class="StepTitle">Switchgear Rating</h2><div class="col-md-6"><label>Primary Rating (Volts)</label><input class="form-control" type="number" name="sgPRating"></div><div class="col-md-6"><label>Secondary Rating (Volts)</label><input class="form-control" type="number" name="sgSRating"></div></div></div><div class="row m-b-30"><div class="col-md-4"><h2 class="StepTitle">Relay Type</h2><div class="form-group"><label>ABB</label><select class="form-control form-control-sm withOther" name="relayType"><option value="REF615">REF615</option><option value="REJ603 v1">REJ603 v1</option><option value="REJ603 v3">REJ603 v3</option><option value="Other">Other</option></select><input class="form-control otherField" disabled type="text" name="relayTypeOther" placeholder="Please state..."></div></div></div>');
        } else if (contract_type === "Transformer") {
            smart_contract_form.smartWizard("stepState", [2], "hide");
            smart_contract_form.smartWizard("stepState", [3], "show");
            $("#step_3").html('<div class="row m-b-30"><div class="col-md-4"><h2 class="StepTitle">Cooling Type</h2><div class="sgh--radio radio radio-default sgh--inline-block"><label><input type="radio" name="coolingType" value="Cast Resin" class="md-radio" checked><span class="circle"></span><span class="check"></span> Cast Resin </label></div><div class="sgh--radio radio radio-default sgh--inline-block"><label><input type="radio" name="coolingType" value="Oil Cooled" class="md-radio"><span class="circle"></span><span class="check"></span> Oil Cooled </label></div></div><div class="col-md-8"><h2 class="StepTitle">Transformer Rating</h2><div class="col-md-6"><label>Primary Rating (Volts)</label><input class="form-control" type="number" name="txPRating"></div><div class="col-md-6"><label>Secondary Rating (Volts)</label><input class="form-control" type="number" name="txSRating"></div></div></div>');
        }
        // $("#smartLoader")
        //     .removeClass("loading")
        //     .empty();
        smart_contract_form.smartWizard("loader", "hide");
        init_specSelections();
        init_select2();
    }, delay);
}

function ts_generate_a_form(this_id) {
    'use strict';
    var smart_contract_form = $("#smart_contract_form1"),
        delay = 1000,
        contract_type = $('input#' + this_id + '[name=contract_type]:checked').val(),
        res = {
            loader: $("<div />", {
                "class": "loading",
                "id": "smartLoader"
            }).html("<img src=' ../assets/img/elements/loaders/loader2.gif' alt=''><p>Please wait...</p>")
        };
    smart_contract_form.empty();
    smart_contract_form.smartWizard("reset");

    function delaySuccess(data) {
        smart_contract_form.find(res.loader).remove();
        smart_contract_form.html(data);

        init_SmartWizard();
        init_specSelections();
    }

    $.ajax({
        type: "POST",
        url: "partials/pieces/form/smart-contract.form.php",
        data: {contract_type: contract_type, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        beforeSend: function () {
            smart_contract_form.append(res.loader);
        },
        success: function (data) {
            setTimeout(function () {
                delaySuccess(data);
            }, delay);
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
    return false;
}


function ts_sel_a_form() {
    'use strict';
    // console.log("ts_sel_a_form");
    var delay = 1000,
        contract_type = $('input[name=contract_type]:checked').val();
    setTimeout(function () {
        if (contract_type == 'Single Unit') {
            $("li.tx_tab").addClass("ts_disabled").children("a").addClass("ts_disabled");
            $("li.electrical_tab").removeClass("ts_disabled").children("a").removeClass("ts_disabled");
            $("li.control_tab").removeClass("ts_disabled").children("a").removeClass("ts_disabled");
        } else if (contract_type == 'Combi') {
            $("li.electrical_tab").removeClass("ts_disabled").children("a").removeClass("ts_disabled");
            $("li.control_tab").removeClass("ts_disabled").children("a").removeClass("ts_disabled");
            $("li.tx_tab").removeClass("ts_disabled").children("a").removeClass("ts_disabled");
            $(".tab-pane div[data-title='combi_tab_pane']").show();
        } else if (contract_type == 'Transformer') {
            $("li.tx_tab").removeClass("ts_disabled").children("a").removeClass("ts_disabled");
            $("li.electrical_tab").addClass("ts_disabled").children("a").addClass("ts_disabled");
            $("li.control_tab").addClass("ts_disabled").children("a").addClass("ts_disabled");
            $(".tab-pane div[data-title='combi_tab_pane']").hide();
        }
        init_specSelections();
    }, delay);
}

function ts_generate_upload_form(this_id) {
    'use strict';
    var delay = 1000,
        file_category = $('#' + this_id).find(":selected").val();
    var fetchAllVideos = "; <?php echo fetchAllVideos($conn); ?>";
    setTimeout(function () {
        console.log("done");
        // $(".buttonNext").click();
        // smart_contract_form.smartWizard("next");
        if (file_category == 'Subtitle') {

            $("#uploader_step_2").html("<div class='row'>\n" +
                "                                <span class='sgh-form-item col-md-4 col-sm-6 col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                        <input name='fileTitle' type='text' placeholder='Title' class='sgh-input' required=''>\n" +
                "                                        <label for='fileTitle' class='sgh-form-item-label sgh-form-item-label-top active'>File Title: *</label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                                \n" +
                "                                <span class='sgh-form-item col-md-4 col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                        <input name='fileType' type='text' class='sgh-input' id='fileType' readonly='readonly'>\n" +
                "                                        <label for='fileType' class='sgh-form-item-label sgh-form-item-label-top active'>File Type: </label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                                <span class='sgh-form-item col-md-4 col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                    <select class='sgh-input' id='fileAssociated' name='fileAssociated'>" + fetchAllVideos + "\n" +
                "                                    </select>\n" +
                "                                        <label for='fileAssociated' class='sgh-form-item-label sgh-form-item-label-top active'>Associated Video: *</label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                                </div>\n" +
                "                                <div class='row'>\n" +
                "                                <span class='sgh-form-item col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                        <textarea name='fileDescription' class='sgh-input' placeholder='Describe file content here...' required style='width:100%;'></textarea>\n" +
                "                                        <label for='fileDescription' class='sgh-form-item-label sgh-form-item-label-top active'>Description: *</label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                               </div>");
        } else if (file_category == 'Video') {
            $("#uploader_step_2").html("<div class='row'>\n" +
                "                                <span class='sgh-form-item col-md-4 col-sm-6 col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                        <input name='fileTitle' type='text' placeholder='Title' class='sgh-input' required=''>\n" +
                "                                        <label for='fileTitle' class='sgh-form-item-label sgh-form-item-label-top active'>File Title: *</label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                                \n" +
                "                                <span class='sgh-form-item col-md-4 col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                        <input name='fileType' type='text' class='sgh-input' id='fileType' readonly='readonly'>\n" +
                "                                        <label for='fileType' class='sgh-form-item-label sgh-form-item-label-top active'>File Type: </label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                                </div>\n" +
                "                                <div class='row'>\n" +
                "                                <span class='sgh-form-item col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                        <textarea name='fileDescription' class='sgh-input' placeholder='Describe file content here...' required style='width:100%;'></textarea>\n" +
                "                                        <label for='fileDescription' class='sgh-form-item-label sgh-form-item-label-top active'>Description: *</label>\n" +
                "                                    </span>\n" +
                "                                </span>\n" +
                "                               </div>");
        } else if (file_category == '') {
            $("#uploader_step_2").html("<span class='sgh-form-item col-md-4 col-sm-6 col-xs-12'>\n" +
                "                                    <span data-component='Input' class='sgh-input-wrapper'>\n" +
                "                                    <select class='sgh-input' id='fileCategory' name='fileCategory' onChange='ts_generate_upload_form(this.id)'>\n" +
                "                                        <option value='Video'>Video</option>\n" +
                "                                        <option value='Subtitle'>Subtitle</option>\n" +
                "                                    </select>\n" +
                "                                        <label for='fileCategory' class='sgh-form-item-label sgh-form-item-label-top active'>Category: *</label>\n" +
                "                                    </span>\n" +
                "                                </span>");
        }
        $("#smartLoader")
            .removeClass("loading")
            .empty();
        init_specSelections();
    }, delay);
}


$(document).on('change', '.io_select', function () {
    var elem_id = this.getAttribute('id');
    setContractSoftware(elem_id);
});

$(document).ready(function (e) {
    //Instantiate empty FormData object
    var formData = new FormData();

    //Detect changes and append changes to FormData
    $("input").change(function () {
        formData.append(this.name, this.value);
    });

    $("select").change(function () {
        formData.append($(this).attr('name'), $(this).val());
    });
    $("radio").change(function () {
        formData.append($(this).attr('name'), $(this).val());
    });
    $("checkbox").change(function () {
        formData.append($(this).attr('name'), $(this).val());
    });
    $("textarea").change(function () {
        formData.append(this.name, this.value);
    });

    //Ajax form submit
    $("#create_Contract_submit").click(function (e) {
        formData.append("ajax_action", "addContract");
        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        // e.preventDefault();
        console.log(formData);
        $.ajax({
            url: url,
            type: "POST",
            data: assetData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {
                console.log(json.message);
                console.log(json.arr);
                $("#create_Contract_message").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();
                });

            },
            beforeSend: function () {
                $('#create_Contract_submit').prop('disabled', true);
                $('#create_Contract_submit .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
            }
        });
    });

    /**********************
     *  pulls all assets  *
     *********************/
    if ($('table#assetList').length) {
        $('table#assetList').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "contract_no",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[1];
                    }
                },
                {
                    name: "mainKW",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[2];
                    }
                },
                {
                    name: "mainKVA",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[3];
                    }
                },
                {
                    name: "date",
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
                            piece_edit_contract = "contract-record-edit",
                            piece_contract_progress = "contract-progress";
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openCanvas(\'' + request_id + '\', \'' + piece_contract_progress + '\')"><i class="fas fa-route"></i></button>\n' +
                            '<a class="btn btn-outline-theme-dark btn-sm" href="contracts.php?t=view-asset&iA=' + encodeURIComponent(row[0]) + '"><i class="fas fa-folder-open"></i></a>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_edit_contract + '\')"><i class="fas fa-pencil-alt"></i></button>' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" data-toggle="modal" data-target="#x_del_' + row[0] + '99' + row[1] + 'announcement"><i class="fas fa-trash"></i></button></div>';
                    }
                }
            ],
            columnDefs: false,
            paging: true,
            ajax: {
                type: 'POST',
                url: url,
                data: {
                    ajax_action: 'getAllContracts'
                },
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                    console.log(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            }
        }).on("select", function () {
            //console.log("selected");
        });
    }
    if ($('table#assetListEdit').length) {
        $('table#assetListEdit').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "contract_id",
                    searchable: true
                },
                {
                    name: "mainKW",
                    searchable: true
                },
                {
                    name: "mainKVA",
                    searchable: true
                },
                {
                    name: "date",
                    searchable: true
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        return '<div class="btn-group">\n' +
                            '<a class="btn btn-outline-bright-success btn-sm" href="contracts.php?t=view&iA=' + row[4] + '&vAss=' + row[5] + '"><i class="fas fa-folder-open"></i></a>\n' +
                            '<a class="btn btn-outline-bright-warning btn-sm" href="contracts.php?t=record-ee&iA=' + encodeURIComponent(row[4]) + '&cA=' + encodeURIComponent(row[0]) + '"><i class="fas fa-pencil-alt"></i></a>\n' +
                            '</div>';

                    }
                }
            ],
            columnDefs: false,
            paging: true,
            ajax: {
                type: 'POST',
                url: url,
                data: {
                    ajax_action: 'getAllContracts'
                },
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            }
        }).on("select", function () {
            //console.log("selected");
        });
    }
    if ($('table#assetAssignList').length) {
        $('table#assetAssignList').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "contract_no",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[1];
                    }
                },
                {
                    name: "mainKW",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[2];
                    }
                },
                {
                    name: "mainKVA",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[3];
                    }
                },
                {
                    name: "date",
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
                            piece_view_assign_associations = "contract-assign-associations";
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_view_assign_associations + '\')"><i class="fas fa-folder-open"></i></button>' +
                            '</div>';
                    }
                }
            ],
            columnDefs: false,
            paging: true,
            ajax: {
                type: 'POST',
                url: url,
                data: {
                    ajax_action: 'getAllContracts'
                },
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            }
        }).on("select", function () {
            //console.log("selected");
        });
    }
    if ($('table#record_pending_list').length) {
        $('table#record_pending_list').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "Contract Number",
                    searchable: true,
                    render: function (data, type, row) {
                        return "C" + row[1];
                    }
                },
                {
                    name: "kW",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[2];
                    }
                },
                {
                    name: "kVA",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[3];
                    }
                },
                {
                    name: "Date added",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[4];
                    }
                },
                {
                    name: "Contract Manager",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[5];
                    }
                },
                {
                    name: "Sales Manager",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[6];
                    }
                },
                {
                    name: "Technical Manager",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[7];
                    }
                },
                {
                    name: "action",
                    searchable: false,
                    sortable: false,
                    render: function (data, type, row) {
                        var request_id = row[0],
                            piece = "contract-record-pending-approval";
                        return '<div class="btn-group">\n' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece + '\')"><i class="fas fa-pencil-alt"></i></button>\n' +
                            '</div>';

                    }
                }
            ],
            paging: true,
            ajax: {
                type: 'POST',
                url: url,
                data: {
                    ajax_action: 'getAllPendingContracts'
                },
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            }
        }).on("select", function () {
            //console.log("selected");
        });
    }

    if ($('table#assetIOList').length) {
        var contract_id = $('table#assetIOList').attr('data-asset-id');
        $('table#assetIOList').DataTable({
            columns: [
                {
                    name: "software_description",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[2];
                    }
                },
                {
                    name: "software_version",
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

                        var btnRow = row[4]?
                            "<a class='btn btn-outline-theme-dark btn-sm' href='download.php?dt=software&dn=" + row[1] + "&de=" + row[3] + "'>Download</a>"
                            :
                            "<button type='button' class='btn btn-outline-theme-dark btn-sm'><i class='fas fa-ban'></i></button>";

                        console.log(btnRow);

                        return "<div class='btn-group'>\n" + btnRow + "</div>";
                    }
                }
            ],
            paging: true,
            ajax: {
                type: 'POST',
                url: url,
                data: {
                    ajax_action: 'getAssignedSoftware',
                    contract_id: contract_id
                },
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            language: {
                emptyTable: "No software available."
            }
        });
    }
    if ($('table#contract_files_list').length) {
        $('table#contract_files_list').DataTable({
            dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            order: [[3, "asc"], [1, "asc"]],
            columns: [
                {
                    name: "file_name",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[2];
                    }
                },
                {
                    name: "upload_date",
                    searchable: true,
                    render: function (data, type, row) {
                        return row[5];
                    }
                },
                {
                    name: "uploaded_by",
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
                        var request_id = row[1],
                            piece_delete_contract_file = "contract-delete-file";
                        return '<div class="btn-group">' +
                            '<button type="button" class="btn btn-outline-theme-dark btn-sm" onclick="openModal(\'' + request_id + '\', \'' + piece_delete_contract_file + '\')"><i class="fas fa-trash"></i></button>' +
                            '</div>';
                    }
                }
            ],
            columnDefs: false,
            paging: true,
            ajax: {
                type: 'POST',
                url: url,
                data: {
                    ajax_action: 'getAllContractFiles'
                },
                error: function (xhr, error, thrown) {
                    alert(xhr.responseJSON.Error);
                }
            },
            scrollY: "600px",
            scrollCollapse: true,
            lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
            select: {
                style: "multi",
                selector: 'td:first-child'
            }
        }).on("select", function () {
            //console.log("selected");
        });
    }


    // init_multiselect();

    // The dropzone method is added to jQuery elements and can
// be invoked with an (optional) configuration object.
//     $("#my-dropzone").dropzone({
//         url: url,
//         sending: function (file, xhr, formData) {
//             formData.append('ajax_action', 'uploadContractFiles');
//             formData.append('request_id', JSON.stringify($('#my-dropzone').attr('data-xeid')));
//         },
//         queuecomplete: function (file, response) {
//             var notice = Swal.mixin({
//                 toast: true,
//                 position: 'top-end',
//                 showConfirmButton: false,
//                 timer: 1500000
//             });
//             notice.fire({
//                 icon: response.stat,
//                 title: response.message
//             });
//         }
//     });

});
