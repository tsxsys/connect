/******************************************************
 *** STL - Web JS (www.sincetech.co.uk) ***
 *** Copyright 2017-2031 Since Dev Team ***
 *** Licensed under STL | SINCE TECH LTD  ***
 *****************************************************/
const imgChange = false;
const salt = 'myPassword';

$(() => {});

/**********************************
 ***  Image Upload Viewer  ***
 **********************************/
function readURL(input, previewBoxId, formId) {
    const submitBtn = $(`#${formId}`).find('button:submit');
    const messageBox = $(`#${formId}`).find('div .message');
    let errorMsg;

    messageBox.empty();

    if (input.files && input.files[0]) {
        const file = input.files[0];
        const imagefile = file.type;
        const allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

        if (!allowedTypes.includes(imagefile)) {
            submitBtn.prop('disabled', true);
            errorMsg = 'Please select a valid image file <b>Note</b> Only jpeg, jpg, and png images type allowed';
            messageBox.html(`<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>${errorMsg}</div>`);
            return false;
        }

        imgChange = true;
        submitBtn.prop('disabled', false);

        const reader = new FileReader();
        reader.onload = (e) => {
            $(`#${previewBoxId}`).css('background-image', `url(${e.target.result})`).hide().fadeIn(650);
        }
        reader.readAsDataURL(file);
    }
}

function truncateString(str, num) {
    return str.length > num ? str.slice(0, num) + "..." : str;
}

function imgChecker(fileName) {
    return fileName && doesFileExist(`user/img/avatars/${fileName}`) ? `user/img/avatars/${fileName}` : 'user/img/avatars/default_avatar.jpg';
}

function emailChecker(inputId, data) {
    const postData = `email=${data}&ajax_action=validateEmail&csrf_token=${$('meta[name="csrf_token"]').attr("value")}`;
    const input = $(`input#${inputId}`);
    const inputResponse = input.closest('form').find('span.input_response');
    const submitBtn = input.closest('form').find('button[type=submit]');

    submitBtn.prop('disabled', true);

    if (data !== 'undefined' && data !== '') {
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: postData,
            dataType: 'json',
            processData: false,
            success: (response) => {
                console.log(`${response.status} ${inputId}`);
                if (response.status === false) {
                    input.addClass('is-invalid').removeClass('is-valid is-warning');
                    inputResponse.text('This email is in use.');
                    submitBtn.prop('disabled', true);
                } else if (response.status === true) {
                    input.addClass('is-valid').removeClass('is-invalid is-warning');
                    inputResponse.empty();
                    submitBtn.prop('disabled', false);
                } else {
                    submitBtn.prop('disabled', true);
                }
            },
            error: (response) => {
                alert(response.err_message);
            }
        });
    } else {
        submitBtn.prop('disabled', true);
        input.addClass('is-warning').removeClass('is-invalid is-valid');
    }
}

function getFormData(formId) {
    const formData = {};
    const inputs = $(`#${formId}`).serializeArray();
    $.each(inputs, (i, input) => {
        formData[input.name] = input.value;
    });
    return formData;
}

function actionPost(thisId, formId) {
    const postData = $(`form#${formId}`).serialize() + `&ajax_action=${$(`#${thisId}`).attr("data-action")}&csrf_token=${$('meta[name="csrf_token"]').attr("value")}`;
    const formRole = $(`form#${formId}`).attr('data-role');
    const buttonLabel = $(`#${thisId} .label`).text();
    const messageBox = $(`form#${formId}`).find('div .message');
    const notice = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500000
    });

    $.ajax({
        url: url,
        type: 'POST',
        data: postData,
        dataType: 'json',
        cache: false,
        processData: false,
        success: (response) => {
            /***********************
             ***  For debugging  ***
             ***********************/
            console.log(response.message);
            console.log(response.arr);

            if (response.status) {
                if (formRole === 'set') {
                    $(`#${formId}`).trigger('reset');
                }
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
                $('input').prop('disabled', false);
                $(`#${thisId}`).prop('disabled', false);
                $(`#${thisId} .label`).text(buttonLabel).fadeIn();
            } else {
                messageBox.html(response.err_message);
            }
        },
        beforeSend: () => {
            $('input').prop('disabled', true);
            $(`#${thisId}`).prop('disabled', true);
            $(`#${thisId} .label`).html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        // error: (response) => {
        //     console.log(response.err_message);
        //     $(`#${thisId}`).prop('disabled', false);
        //     $(`#${thisId} .label`).text(buttonLabel).fadeIn();
        //     messageBox.html(response.err_message).fadeIn();
        // }
    });
}

function postSmartForm(thisId,formId) {
    const form = $(`form#${formId}`);
    const formRole = form.attr('data-role');
    const formInput = $('form[id^="form_"] input:not([type="checkbox"])');
    const formSelect = $('form[id^="form_"] select:not([type="checkbox"])');
    const checkboxes = $('form[id^="form_"] input').filter(':checked');
    const myArrays = {};
    const myArraysNames = [];
    const button = $(`#${thisId}`);
    let serializedForm;
    const serializedFormInput = formInput.serialize();
    const serializedFormSelect = formSelect.serialize();

    serializedForm = serializedFormInput += `&${serializedFormSelect}`;

    checkboxes.each(function () {
        const name = $(this).attr('name');
        const val = $(this).val();

        if (!myArrays[name]) myArrays[name] = [];
        myArrays[name].push(val);

        if (!myArraysNames.includes(name)) myArraysNames.push(name);
    });

    myArraysNames.forEach((x) => {
        if (x !== undefined && x !== "") {
            const updateParameter = `&${x}=${myArrays[x].toString().trim().replace("[", "").replace("]", "")}`;
            serializedForm += updateParameter;
        }
    });

    console.log(serializedForm);

    var postData = serializedForm + "&ajax_action=" + button.attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
        buttonLabel = $('#' + this_id + ' .label').text(),
        messageBox = $('form#' + this_id).find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
    if (formRole === 'update') {
        postData = postData + "&request_id=" + JSON.stringify(form.attr('data-xeid'));
    }
    console.log(postData);

    $.ajax({
        url: url,
        type: "POST",
        data: postData,
        dataType: "json",
        cache: false,
        processData: false,
        success: function (response) {
            /***********************
             ***  For debugging  ***
             ***********************/
            console.log(response.message);
            console.log(response);
            if (response.status === true) {
                $('input').prop('disabled', false);
                $('#' + this_id).prop('disabled', false);
                $('#' + this_id + ' .label').text(buttonLabel).fadeIn();
            } else if (response.status === false) {
                messageBox.html(response.err_message);
            }
            notice.fire({
                icon: response.stat,
                title: response.message
            });
        },
        beforeSend: function () {
            $('input').prop('disabled', true);
            $('#' + this_id).prop('disabled', true);
            $('#' + this_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function (response) {
            notice.fire({
                icon: response.stat,
                title: response.message
            });
            console.log(response.err_message);
            console.log(response);
            console.log(response.message + ' ' + response.stat);
            // $('#' + this_id).prop('disabled', false);
            // $('#' + this_id + ' .label').text(buttonLabel).fadeIn();
            // messageBox.html(response.err_message).fadeIn();
        }
    });
}

function copyToClipboard(target) {
    var text = $(target).data("u-pin"),
        dummy = document.createElement("textarea"),
        successHTML = '<div class="alert alert-primary-1 alert-dismissible fade show icons-alert">\n' +
            '               <p><strong class="bold">Success!</strong> <i>' + text + '</i> copied to clipboard</p>\n' +
            '           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    // to avoid breaking orgin page when copying more words
    // cant copy when adding below this code
    // dummy.style.display = 'none'
    document.body.appendChild(dummy);
    //Be careful if you use texarea. setAttribute('value', value), which works with "input" does not work with "textarea". – Eduard
    dummy.value = text;
    dummy.select();
    if (!navigator.clipboard) {
        document.execCommand("copy");
        $("#copyToClipboard_alert").html(successHTML);
    } else {
        navigator.clipboard.writeText(text).then(
            function () {
                $("#copyToClipboard_alert").html(successHTML);
            })
            .catch(
                function () {
                    alert("err"); // error
                    $("#copyToClipboard_alert").empty();
                });
    }

    document.body.removeChild(dummy);
}

function updateAssetUsers(btn_id, form_id) {
    'use strict';
    if (!$("#" + btn_id).hasClass('disabled')) {
        var _users = [];
        $('form#' + form_id + ' .ms-selection select option').each(function () {
            // var value = $(this).val();
            _users.push($(this).val());
        });

        var formJson = JSON.stringify(_users),
            form = $('form#' + form_id),
            formData = "_assigned=" + formJson + "&request_id=" + JSON.stringify(form.attr('data-xeid')) + "&ajax_action=" + $('#' + btn_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
            formRole = form.attr('data-role'),
            // btnLabel = $('#' + btn_id + ' .label').text(),
            messageBox = form.find('div .message'),
            notice = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500000
            });
        console.log(_users);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "json",
            cache: false,
            processData: false,
            success: function (response) {
                /***********************
                 ***  For debugging  ***
                 ***********************/
                console.log(response.message);
                // console.log(response.arr);
                if (response.status === true) {
                    if (formRole === 'set') {
                        $('#' + form_id).trigger('reset');
                    }
                    notice.fire({
                        icon: response.stat,
                        title: response.message
                    });
                    $('input').prop('disabled', false);
                    $('#' + btn_id).prop('disabled', false);
                    $('#' + btn_id + ' .label').text(buttonLabel).fadeIn();
                } else if (response.status == false) {
                    messageBox.html(response.err_message);
                }
            },
            beforeSend: function () {
                $('input').prop('disabled', true);
                $('#' + btn_id).prop('disabled', true);
                $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
            }
            // error: function (response) {
            //     console.log(response.err_message);
            //     $('#' + btn_id).prop('disabled', false);
            //     $('#' + btn_id + ' .label').text(buttonLabel).fadeIn();
            //     messageBox.html(response.err_message).fadeIn();
            // }
        });
    }
}

function clientPost(btn_id, form_id, isModal = false, inTable = false) {
    var form = $('form#' + form_id),
        formData = form.serialize() + "&request_id=" + JSON.stringify(form.attr('data-xeid')) + "&ajax_action=" + $('#' + btn_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
        formRole = form.attr('data-role'),
        btnLabel = $('#' + btn_id + ' .label').text(),
        messageBox = form.find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
    if (isModal) {
        var modal_id = $('#' + btn_id).closest('div .modal').attr('id');
    }
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
            // console.log(response);
            // console.log('done');
            if (response.status === true) {
                if (formRole === 'set') {
                    $('#' + form_id).trigger('reset');
                }
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
                if (isModal) {
                    toggleModal(modal_id);
                }
                if (inTable){
                    $('.reloadTable').click();
                }

                $('#' + btn_id + ' .label').text(btnLabel).fadeIn();
                $('#' + btn_id).prop('disabled', false);
                $('#' + form_id + ' input').prop('disabled', false);
            } else if (response.status === false) {
                messageBox.html(response.message);
            }
        },
        beforeSend: function () {
            // console.log(formData);
            $('#' + form_id + ' input').prop('disabled', true);
            $('#' + btn_id).prop('disabled', true);
            $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        complete: function () {
            $('#' + btn_id + ' .label').text(btnLabel).fadeIn();
            $('#' + btn_id).prop('disabled', false);
            $('#' + form_id + ' input').prop('disabled', false);
        },
        error: function (response) {
            alert(response.message);
        }
    });
}

function postWithMedia(btn_id, form_id) {
    var formData = new FormData($('#' + form_id)[0]),
        formRole = $('form#' + form_id).attr('data-role'),
        btn_label = $('#' + btn_id + ' .label').text(),
        messageBox = $(this).find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
    formData.append("ajax_action", $('#' + btn_id).attr('data-action'));
    if (imgChange === true) {
        formData.append('img_change', 'true');
    } else {
        formData.append('img_change', 'false');
    }
    messageBox.empty();
    $.ajax({
        url: url,   	// Url to which the request is send
        type: 'POST',      				// Type of request to be send, called as method
        data: formData, 		// Data sent to server, a set of key/value pairs representing form fields and values
        cache: false,					// To unable request pages to be cached
        contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        processData: false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        dataType: 'json',
        success: function (response)  		// A function to be called if request succeeds
        {
            if (response.status === true) {
                if (formRole === 'set') {
                    $('#' + form_id).trigger('reset');
                }
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
            } else if (response.status === false) {
                messageBox.html(response.err_message);
            }
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
            // console.log(response.status);
        },
        beforeSend: function () {
            $('#' + btn_id).prop('disabled', true);
            $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function (response) {
            alert(response.err_message);
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
        }
    });
}

function actionTablePost(btn_id, form_id) {
    var formData = new FormData($('#' + form_id)[0]),
        formRole = $('form#' + form_id).attr('data-role'),
        table_id = $('form#' + form_id).attr('data-table-id'),
        modal_id = $(this).closest('div .modal').attr('id'),
        btn_label = $('#' + btn_id + ' .label').text(),
        messageBox = $(this).find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
    formData.append("ajax_action", $('#' + btn_id).attr('data-action'));
    formData.append("target_id", $('#' + btn_id).attr('data-target-id'));
    messageBox.empty();
    $.ajax({
        url: url,   	// Url to which the request is send
        type: 'POST',      				// Type of request to be send, called as method
        data: formData, 		// Data sent to server, a set of key/value pairs representing form fields and values
        cache: false,					// To unable request pages to be cached
        contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        processData: false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        dataType: 'json',
        success: function (response) {
            if (response.status === true) {
                if (formRole === 'set') {
                    $('#' + form_id).trigger('reset');
                }
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
                reloadTable(table_id);
                console.log(modal_id);
                // toggleModal(modal_id);
            } else if (response.status === false) {
                messageBox.html(response.err_message);
            }
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
            $('#' + btn_id).prop('disabled', false);
        },
        beforeSend: function () {
            $('#' + btn_id).prop('disabled', true);
            $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function (response) {
            alert(response.err_message);
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
        }
    });
}

function doesFileExist(urlToFile) {
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', urlToFile, false);
    xhr.send();

    return xhr.status !== 404;
}

function reloadTable(table_id) {
    $("#" + table_id).DataTable().ajax.reload();
}

function toggleModal(modal_id) {
    $("#" + modal_id).modal('toggle');
}

function sameAddress() {
    var billing_addressInput = $("#billing_address input"),
        company_address_selected = $("#company_address select option:selected").val();
    if ($("#sgh--sameAddress").is(":checked")) {
        billing_addressInput.attr("readonly", "readonly");
        $('#company_address input[name]').each(function () {
            var data_name = $(this).attr('data-name');
            $('#billing_address input[data-name="i' + data_name + '"]').val($(this).val());
        });
        $("#billing_address select").addClass("select-disabled").trigger('change');
        $('#billing_address select option[value="' + company_address_selected + '"]').attr("selected", true);
    } else {
        billing_addressInput.removeAttr("readonly");
        $("#billing_address select").removeClass("select-disabled");
    }
}

function sameAddress_2() {
    var company_address_input = $("#company_address input");
    var delivery_address_input = $("#delivery_address input");
    var delivery_address_selected = $("#delivery_address select option:selected").val();
    var company_address_selected = $("#company_address select option:selected").val();
    if ($("#sgh--sameAddress_2").is(":checked")) {
        delivery_address_input.attr("readonly", "readonly");
        $('#company_address input[name]').each(function () {
            var data_name = $(this).attr('data-name');
            $('#delivery_address input[data-name="d' + data_name + '"]').val($(this).val());
        });
        $("#delivery_address select").addClass("select-disabled").trigger('change');
        $('#delivery_address select option[value="' + company_address_selected + '"]').attr("selected", true);
    } else {
        delivery_address_input.removeAttr("readonly");
        $("#delivery_address select").removeClass("select-disabled");
    }
}

function sameAddressStatic() {
    // console.log(this_id);
    var delivery_address_input = $("#delivery_address input"),
        delivery_address_select = $("#delivery_address select"),
        data_value_6 = $('#company_address span[data-name="address_line_6"]').attr('data-value');
    if ($("#sameAddressStatic").is(":checked")) {
        delivery_address_input.attr("readonly", "readonly");
        $('#company_address span[data-name]').each(function () {
            var data_name = $(this).attr('data-name');
            $('#delivery_address input[data-name="d_' + data_name + '"]').val($(this).attr('data-value'));
        });
        delivery_address_select.attr("readonly", "readonly").addClass("select-disabled");
        $('#delivery_address select option[value="' + data_value_6 + '"]').attr("selected", true);
    } else {
        delivery_address_input.removeAttr("readonly");
        delivery_address_select.removeAttr("readonly").removeClass("select-disabled");
    }
}

function checkbox_required(cover_elem) {
    var requiredCheckboxes = $('#' + cover_elem + ' input:checkbox[required]');
    requiredCheckboxes.change(function () {
        if (requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
}

function smart_form_auto_height(obj_id) {
    $('#' + obj_id).smartWizard("fixHeight");
}

function updateAssociations(btn_id, form_id) {
    'use strict';
    if (!$("#" + btn_id).hasClass('disabled')) {
        var _selection = [];
        $('form#' + form_id + ' .ms-selection select option').each(function () {
            _selection.push($(this).val());
        });

        var formJson = JSON.stringify(_selection),
            form = $('form#' + form_id),
            request_id = JSON.stringify(form.attr('data-xeid')),
            formData = "_assigned=" + formJson + "&request_id=" + request_id + "&ajax_action=" + $('#' + btn_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
            formRole = form.attr('data-role'),
            // btnLabel = $('#' + btn_id + ' .label').text(),
            messageBox = form.find('div .message'),
            notice = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500000
            });
        // console.log(_selection);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "json",
            cache: false,
            processData: false,
            success: function (response) {
                /***********************
                 ***  For debugging  ***
                 ***********************/
                console.log(response.message);
                // console.log(response.arr);
                if (response.status === true) {
                    if (formRole === 'set') {
                        $('#' + form_id).trigger('reset');
                    }
                    notice.fire({
                        icon: response.stat,
                        title: response.message
                    });
                    $('input').prop('disabled', false);
                    $('#' + btn_id).prop('disabled', false);
                    $('#' + btn_id + ' .label').text(buttonLabel).fadeIn();
                } else if (response.status == false) {
                    messageBox.html(response.err_message);
                    notice.fire({
                        icon: response.stat,
                        title: response.message
                    });
                }
            },
            beforeSend: function () {
                $('input').prop('disabled', true);
                $('#' + btn_id).prop('disabled', true);
                $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
            }
            // error: function (response) {
            //     console.log(response.err_message);
            //     $('#' + btn_id).prop('disabled', false);
            //     $('#' + btn_id + ' .label').text(buttonLabel).fadeIn();
            //     messageBox.html(response.err_message).fadeIn();
            // }
        });
    }
}

function get_company_info(this_id) {
    $("#" + this_id).attr('data-action');
    var companyValue = $("#" + this_id).val();
    // vAssValue = window.vAssValue;
    // if ((typeof vAssValue != "undefined") && (vAssValue != null)) {
    //     vAssValue = window.vAssValue;
    // } else {
    //     vAssValue = "N/A";
    // }
    if (companyValue) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                ajax_action: 'pullCompanyInfoCreate',
                companyValue: companyValue,
                vAssValue: window.vAssValue
            },
            success: function (response) {
                $("#info").html(response);
                smart_form_auto_height('smart_contract_form');
            },
            error: function (err) {
                console.log(err);
                alert(err.responseText);
                console.log(err.responseText);
            }
        });
    }
}


function init_sel_other() {
    $('select.withOther').on('change', function () {
        var selected_elem = this,
            value = 'Other',
            other_option = $("option[value='" + value + "']", this),
            other_option_selected_state = selected_elem.value.toLowerCase() === "other";

        $(other_option)
            .prop({
                'disabled': other_option_selected_state
            });
        $(selected_elem).next().toggle(other_option_selected_state).prop({
            'required': other_option_selected_state,
            'disabled': !other_option_selected_state
        });
    }).change();
}

function isNumberSlash(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 47) {
        return false;
    }
    return true;
}

function kwCalculation1() {
    var _changeInterval = null;
    // wait until user type in something
    // Don't let call setInterval - clear it, user is still typing
    clearInterval(_changeInterval);
    _changeInterval = setInterval(function () {
        // Typing finished, now you can Do whatever after 2 sec
        var kw, kva, pf;
        kva = $('#mainKVA').val();
        pf = $('#mainPF').val();
        if ((!kva.trim() === '') && (!pf.trim() === '')) {
            kw = kva * pf;
            $('#mainKW').val(kw);
        }
        clearInterval(_changeInterval)
    }, 500);
}

function specSelection() {
    var radiocurrent_flowValue, radioload_typeValue, radioConfigValue;
    radiocurrent_flowValue = $(radiocurrent_flow + ':checked').val();
    radioload_typeValue = $(radioload_type + ':checked').val();
    radioConfigValue = $(radioConfig + ':checked').val();
    $(radioload_type + ":not(:eq(0))").prop("disabled", false).enabledCSS();
    $(radioConfig + ":not(:eq(0))").prop("disabled", false).enabledCSS();
    $(radioConfig + ":eq(0)").prop("disabled", false).enabledCSS();
    $('div[id^="ac_"]').disableSelect().hide().find(':input').prop('disabled', true);
    $('div[id^="dc_"]').disableSelect().hide().find(':input').prop('disabled', true);
    $('.dc_cv_res_sd select.sgh--select-disabled').removeClass("sgh--select-disabled");
    if (radiocurrent_flowValue === 'AC') {
        if (radioload_typeValue === 'Resistive') {
            if (radioConfigValue !== 'Star/Delta') {
                $('#ac_res').show().enableSelect().find(':input').prop('disabled', false);
                if (radioConfigValue === 'Single Phase') {
                    $('.supplyPH').disableSelect().find('option[value="1"]').prop('selected', true);
                    $('.supplyW').disableSelect().find('option[value="2"]').prop('selected', true);
                }
            } else {
                $('#ac_res_sd').show().enableSelect().find(':input').prop('disabled', false);
            }
        } else if (radioload_typeValue === 'Resistive/Reactive') {
            $(radioConfig + ":eq(0)").prop("disabled", true).disabledCSS();
            $('.mainKW input').attr("readonly", "readonly");
            if (radioConfigValue !== 'Star/Delta') {
                $('#ac_res_rac').show().enableSelect().find(':input').prop('disabled', false);
            } else {
                $('#ac_res_rac_sd').show().enableSelect().find(':input').prop('disabled', false);
            }
        }
    } else {
        $(radioload_type + ":eq(0)").prop('checked', true);
        $(radioload_type + ":not(:eq(0))").prop("disabled", true).disabledCSS();
        $(radioConfig + ":not(:eq(0))").prop("disabled", true).disabledCSS();
        if (radiocurrent_flowValue === 'DC Constant Current') {
            if (radioConfigValue !== 'Star/Delta') {
                $('#dc_cc_res').show().enableSelect().find(':input').prop('disabled', false);
            } else {
                $('#dc_cc_res_sd').show().enableSelect().find(':input').prop('disabled', false);
            }
        }
        if (radiocurrent_flowValue === 'DC Constant Voltage') {
            $('#dc_cv_res').show().enableSelect().find(':input').prop('disabled', false);
            if (radioConfigValue === 'Star') {
                $('.dc_cv_res_s').disableSelect2();
                $('#dc_cv_res input').prop('disabled', false);
            }
            if (radioConfigValue === 'Delta') {
                $('.dc_cv_res_d').disableSelect2();
                $('#dc_cv_res input').prop('disabled', false);
            }
        }
    }
}
function trigger_change(selector) {
    $(selector).trigger("change");
}
function add_control_lead() {
    $('input.leadInput').not(":hidden").each(function () {
        if (!$(this).val()) {
            $(this).addClass('warning').focus;
            return false;
        } else {
            if ($('.leadInput.warning').length) {
                $('.leadInput').removeClass('warning');
            }
        }
    });
    if (!$('.leadInput#leadNo').val().trim() == '') {
        if ($('#lead option:selected').val() == 'Other') {
            var leadType = $('#leadOther').val();
        } else {
            var leadType = $('#lead option:selected').val();
        }
        if ($('#leadLength option:selected').val() == 'Other') {
            var leadLength = $('#leadLengthOther').val();
        } else {
            var leadLength = $('#leadLength option:selected').val();
        }
        var ControlLead = $('#leadNo').val() + 'x' + leadLength + ' ' + leadType;
        var currentVal = $('#conLeads').val();
        $('#tags_1_tag').val(ControlLead).blur();
        if (!$('#conLeads').val().trim() == '') {
            $('#conLeads').val(currentVal + ', ' + ControlLead);
        } else {
            $('#conLeads').val(ControlLead);
        }
        $('#leadSection input').val('');
        $('#lead').prop('selectedIndex', 0);
        $("#lead.withOther ~ .otherField").hide();
    }
}

function addContract() {
    //Instantiate empty FormData object
    var assetData = $('form#setContract').serialize() + "&ajax_action=addContract&csrf_token=" + $('meta[name="csrf_token"]').attr("value");
    // var assetData = $('form#setContract').serializeArray();
    // assetData.push(
    //     {
    //         name: 'ajax_action',
    //         value: 'addContract'
    //     }, {
    //         name: 'csrf_token',
    //         value: $('meta[name="csrf_token"]').attr("value")
    //     });
    console.log(assetData);
    var notice = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1500000
    });
    $.ajax({
        url: url,
        type: "POST",
        data: assetData,
        dataType: "json",
        success: function (json) {
            /*****
             For debugging
             *****/
            console.log(json.message);
            console.log(json.arr);

            smart_contract_form.smartWizard("reset");
            $('#create_Contract_submit').prop('disabled', false);
            $('#create_Contract_submit .label').text("Submit").fadeIn();
            // $("#create_Contract_message").fadeOut(0, function () {
            //     $(this).html(json.message).fadeIn();
            // });
            notice.fire({
                icon: json.stat,
                title: json.message
            })
        },
        beforeSend: function () {
            $('#create_Contract_submit').prop('disabled', true);
            $('#create_Contract_submit .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function () {
            alert(json.message);
        }
    });
}

function openModal(request_id, piece) {
    $.ajax({
        type: 'POST',
        url: 'partials/pieces/table/' + piece + '.piece.php',
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $('#x_modal').html(response);
            $('#x_' + request_id + '99').modal('toggle');
            // init_contract_form();
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}

function openCanvas(request_id, piece) {
    $.ajax({
        type: 'POST',
        url: 'partials/pieces/table/' + piece + '.piece.php',
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $('#x_canvas').html(response);
            $('#x_' + request_id + '99').offcanvas('toggle');
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}
// function file_search() {
//     $.ajax({
//         type: 'POST',
//         url: url,
//         data: {ajax_action: 'file_search'},
//         success: function (response) {
//             var resultA[] = response
//         },
//         error: function (err) {
//             console.log(err);
//             alert(err.responseText);
//             console.log(err.responseText);
//         }
//     });
// }

// function color_select(){
//     var optarray = $("#enc_finish").children('option').map(function() {
//         return {
//             "value": this.value,
//             "option": "<option value='" + this.value + "'>" + this.text + "</option>"
//         };
//     });
//     $(document).on('change', '#enc_finishType', function () {
//         $("#enc_finish").children('option').remove();
//         var addoptarr = [];
//         for (i = 0; i < optarray.length; i++) {
//             if (optarray[i].value.indexOf($(this).val()) > -1) {
//                 addoptarr.push(optarray[i].option);
//             }
//         }
//         $("#enc_finish").html(addoptarr.join(''));
//     }).change();
// }




$(document).on('change', '.imageUploadIn', function () {
    var form = this.closest('form').getAttribute('id');
    readURL(this, this.getAttribute('data-target'), form);
});
$(document).on('change', '#enc', function () {
    enc_selection(this.id);
});
$(document).on('change', '.checkbox_required', function () {
    var cover_elem = this.closest('.checkbox_required').getAttribute('id');
    checkbox_required(cover_elem);
});
$(document).on('submit', '#form_post1', function (e) {
    e.preventDefault();
    var formData = new FormData($('#form_post')[0]),
        btn_id = $(this).find('button:submit').attr('id'),
        btn_label = $('#' + btn_id + ' .label').text(),
        messageBox = $(this).find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
    formData.append("ajax_action", this.getAttribute('data-action'));
    messageBox.empty();
    $.ajax({
        url: url,   	// Url to which the request is send
        type: 'POST',      				// Type of request to be send, called as method
        data: formData, 		// Data sent to server, a set of key/value pairs representing form fields and values
        cache: false,					// To unable request pages to be cached
        contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        processData: false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        dataType: 'json',
        success: function (response)  		// A function to be called if request succeeds
        {
            if (response.status === true) {
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
            } else if (response.status === false) {
                messageBox.html(response.err_message);
            }
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
            console.log(response.status);
        },
        beforeSend: function () {
            $('#' + btn_id).prop('disabled', true);
            $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function (response) {
            alert(response.err_message);
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
        }
    });
});
$(document).on('click', '.updateAssociations', function () {
    var elem_id = this.getAttribute('id');
    updateAssociations(elem_id, this.form.id);
});
$(document).on('click', '#sameAddressStatic', function () {
    sameAddressStatic();
});
$(document).on('click', '.ts_contract_type_radio', function () {
    ts_generate_a_form(this.id);
});

$(document).ready(function (e) {
    if ($('#password1').length) {
        $("#password1").passwordValidation({"confirmField": "#password2"}, function (element, valid, match, failedCases) {
            if ($('#password1, #password2').is(":focus")) {
                $('#message_account_ps_info').html('<pre class="alert-dark-2">' + failedCases.join('\n') + '</pre>');

                if (valid) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                    $('#message_account_ps_info').empty();
                }
                if (!valid) $(element).addClass('is-invalid').removeClass('is-valid');
                if (valid && match) {
                    $("#password2").addClass('is-valid').removeClass('is-invalid');
                    $('#message_account_ps_info').empty();
                    $('#reset_account_pwd').prop('disabled', false);
                }
                if (!valid || !match) {
                    $("#password2").addClass('is-invalid').removeClass('is-valid');
                    $('#reset_account_pwd').prop('disabled', true);
                }
                if (!match) {
                    $('#password2_error').text('Passwords do not match.');
                } else {
                    $('#password2_error').empty();
                }
            }
        });
    }
});