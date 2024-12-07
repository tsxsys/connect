var url, radiocurrent_flow, radioload_type, radioConfig, lastActivity, device;
url = "inc/functions.ajax.inc.php";
// $(":file").filestyle({
//     input: false
// });


//Settings
// $(function () {
//     $("#sgh--password").passwordValidator({
//         // list of qualities to require
//         require: ['length', 'lower', 'upper', 'digit'],
//         // minimum length requirement
//         length: 8
//     });
// });
//Operations
function updatePass() { // updateForm is submitted
    'use strict';
    if ($("#updatePassForm")[0].checkValidity()) {
        $('#btnUpdate').hide();
        $('#resultUpdate').html("<img class='sgh--loading' src='../img/loader.gif' alt=''>");
        var password = $("input[name='pwd']").val();
        var newPassword = $("input[name='pwdNew']").val();
        var confirmPassword = $("input[name='pwdConfirm']").val();
        if (password && newPassword && confirmPassword) { // values are not empty
            $.post("../../includes/update.pwd.inc.php", {
                pwd: password,
                pwdNew: newPassword,
                pwdConfirm: confirmPassword
            }).done(function (data) {
                if (data === "success") {
                    $('#resultUpdate').addClass("response-success").removeClass("response-warning").text("Password successfully changed!");
                    $('#updatePassForm').trigger("reset");
                }
                if (data === "failed") {
                    $('#resultUpdate').addClass("response-warning").removeClass("response-success").text("Incorrect password entered!");
                }
                $('#btnUpdate').show();
            });
        }
    }
}

function updateInfo() { // updateForm is submitted
    'use strict';
    if ($("#updateInfoForm")[0].checkValidity()) {
        $('#update-cc').hide();
        $('#resultUpdate-cc').html("<img class='sgh--loading' src='../img/loader.gif' alt=''>");
        var formInfo = $("form#updateInfoForm").serialize();
        var session_id = "<?php echo $_SESSION['id'] ?>";
        var email = $("#email-cc").val();
        var verify = $("#re-email-cc").val();
        var tel = $("input[name='contact_tel']").val();
        var fax = $("input[name='contact_fax']").val();
        var ext = $("input[name='phoneExt']").val();
        var mobile = $("input[name='mobile']").val();
        if (formInfo && session_id && email && verify) { // values are not empty
            $.post("../../includes/functions.ajax.inc.php", {
                updateInfo: formInfo,
                emailN: email,
                emailC: verify,
                contact_tel: tel,
                contact_fax: fax,
                phoneExt: ext,
                mobile: mobile,
                id: session_id
            }).done(function (data) {
                // console.log(data);
                console.log(formInfo);
                if (data === "success") {
                    $('#resultUpdate-cc').addClass("response-success").removeClass("response-warning").text("General info successfully updated!");
                    $('#updateInfoForm').trigger("reset");
                }
                if (data === "failed") {
                    $('#resultUpdate-cc').addClass("response-warning").removeClass("response-success").text("Update failed! Please try again");
                }
                $('#update-cc').show();
            });
        }
    }
}

function update_gen_info(form_id) {
    'use strict';
    if ($("#" + form_id)[0].checkValidity()) {
        var action = $("#" + form_id).attr('data-action'),
            email = $("#" + form_id + " input[name='emailN']").val(),
            verifiedEmail = $("#" + form_id + " input[name='emailC']").val(),
            ext = $("#" + form_id + " input[name='phoneExt']").val(),
            mobile = $("#" + form_id + " input[name='mobile']").val(),
            tel = $("#" + form_id + " input[name='contact_tel']").val(),
            fax = $("#" + form_id + " input[name='contact_fax']").val(),
            save_btn = $("#" + form_id + " :button"),
            close_btn = $("#sgh_edit_" + form_id),
            response = "#response_" + form_id,
            reload_div = ".reload_" + form_id;
        console.log(action);
        if ((email && verifiedEmail && email == verifiedEmail) || (ext && mobile) || (tel && fax)) {
            save_btn
                .html("<img class='sgh--loading sm' src='../img/ls/loader2.gif'>")
                .attr("disabled", true)
                .prop("disabled", true);
            $.post("../../includes/funcs.inc.php", {
                actioned: action,
                emailN: email, emailC: verifiedEmail,
                phoneExt: ext, mobile: mobile,
                contact_tel: tel, contact_fax: fax
            }).done(function (data) {
                console.log(data);
                save_btn
                    .html("UPDATE")
                    .attr("disabled", false)
                    .prop("disabled", false);
                if (data === "fail") {
                    $(response).addClass("response-warning").removeClass("response-success").html("Request failed!");
                }
                if (data === "success") {
                    $(response).html("Request done!");
                    $("#" + form_id)[0].reset();
                    close_btn.click();
                    $(reload_div).fadeOut('slow').load(document.URL + ' ' + reload_div).fadeIn('slow');
                    return false;
                }
            });

        }
    }
}

function updateAddress(form_id) {
    'use strict';
    if ($("#" + form_id)[0].checkValidity()) {
        var action = $("#" + form_id).attr('data-action'),
            address_line_1 = $("#" + form_id + " input[name='address_line_1']").val(),
            address_line_2 = $("#" + form_id + " input[name='address_line_2']").val(),
            address_line_3 = $("#" + form_id + " input[name='address_line_3']").val(),
            address_line_4 = $("#" + form_id + " input[name='address_line_4']").val(),
            address_line_5 = $("#" + form_id + " input[name='address_line_5']").val(),
            address_line_6 = $("#" + form_id + " select[name='address_line_6']").val(),
            save_btn = $("#" + form_id + " :button"),
            close_btn = $("#sgh_edit_" + form_id),
            response = "#response_" + form_id,
            reload_div = ".reload_" + form_id;
        console.log(action);
        if (address_line_1 && address_line_6) {
            save_btn
                .html("<img class='sgh--loading sm' src='../img/ls/loader2.gif'>")
                .attr("disabled", true)
                .prop("disabled", true);
            $.post("../../includes/funcs.inc.php", {
                actioned: action,
                address_line_1: address_line_1, address_line_2: address_line_2,
                address_line_3: address_line_3, address_line_4: address_line_4,
                address_line_5: address_line_5, address_line_6: address_line_6
            }).done(function (data) {
                console.log(data);
                save_btn
                    .html("UPDATE")
                    .attr("disabled", false)
                    .prop("disabled", false);
                if (data === "fail") {
                    $(response).addClass("response-warning").removeClass("response-success").html("Request failed!");
                }
                if (data === "success") {
                    $(response).html("Request done!");
                    $("#" + form_id)[0].reset();
                    close_btn.click();
                    $(reload_div).fadeOut('slow').load(document.URL + ' ' + reload_div).fadeIn('slow');
                    return false;
                }
            });

        }
    }
}

function registerCompany() { // Customer registration form is submitted
    'use strict';
    if ($("#registerCusForm")[0].checkValidity()) {
        var customer = $("input[name='customer']").val(),
            contact_name = $("input[name='contact_name']").val(),
            email = $("#email-c").val(),
            registerInc = "../../includes/register.company.inc.php";
        if ($('input#testERQ-c').is(':checked')) {
            var testERQ = $("#testERQ-c").val();
        } else {
            var testERQ = "no";
        }
        if (customer && contact_name && email) { // values are not empty
            if (!$('#response').is(':empty')) {
                $('#response').empty();
                $('#loader-c').show();
            }
            $('#create-c').hide();
            $('#loader-c').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post(registerInc, {
                customer: customer,
                contact_name: contact_name,
                email: email,
                testERQ: testERQ
            }).done(function (data) {
                console.log(data);
                $('#create-c').show();
                $('#loader-c').hide();
                if (data === "fail") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed!");
                }
                if (data === "email") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("A company with this email already exists!");
                }
                if (data === "success") {
                    $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font sgh--text-center'>The company has been added</p></div></div></div>");
                    $('#registerCusForm').trigger("reset");
                } else {
                    // data = JSON.parse(data);
                    // $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font'>An account has been created for " + data[0] + ", please advise  " + data[0] + " to change password at first login!</p><div class='sgh--credentials'><p>Customer ID: " + data[1] + "</p><p class=''>Password: " + data[2] + "</p></div></div></div></div>");
                    $('#registerCusForm').trigger("reset");
                }
            });
        }
    }
}

function registerCus() { // Customer registration form is submitted
    'use strict';
    if ($("#registerCusForm")[0].checkValidity()) {
        var company_id = $("select[name='company_id']").val(),
            fullName = $("input[name='fullName']").val(),
            email = $("#email-c").val();
        var registerInc = "../../includes/register.cus.inc.php";
        if ($('#sendInfo').is(":checked")) {
            // var registerInc = "../../includes/register.cus.inc.php";
            var sendInfo = "Yes";
        } else {
            // var registerInc = "../../includes/register.cus_2.inc.php";
            var sendInfo = "No";
        }
        if ($('input#testERQ-c').is(':checked')) {
            var testERQ = $("#testERQ-c").val();
        } else {
            var testERQ = "no";
        }
        if (company_id && fullName && email) { // values are not empty
            if (!$('#response').is(':empty')) {
                $('#response').empty();
                $('#loader-c').show();
            }
            $('#create-c').hide();
            $('#loader-c').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post(registerInc, {
                company_id: company_id,
                fullName: fullName,
                email: email,
                testERQ: testERQ,
                sendInfo: sendInfo
            }).done(function (data) {
                console.log(data);
                $('#create-c').show();
                $('#loader-c').hide();
                if (data === "fail") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed!");
                }
                if (data === "Error 00XE0020") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed! Error 00XE0020");
                }
                if (data === "Error 00XE0021") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed! Error 00XE0021");
                }
                if (data === "email") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("A user with this email already exists!");
                }
                if (data === "success") {
                    $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font'>The account has been created. Login information will be sent out with contract notifications</p></div></div></div>");
                    $('#registerCusForm').trigger("reset");
                } else {
                    data = JSON.parse(data);
                    $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font'>An account has been created for " + data[0] + ", please advise  " + data[0] + " to change password at first login!</p><div class='sgh--credentials'><p>Customer ID: " + data[1] + "</p><p class=''>Password: " + data[2] + "</p></div></div></div></div>");
                    $('#registerCusForm').trigger("reset");
                }
            });
        }
    }
}

function register_company_customer() { // Customer registration form is submitted
    'use strict';
    if ($("#registerCusForm")[0].checkValidity()) {
        var company_info = $("select[name='company']").val(),
            company_other = $("input[name='company_other']").val(),
            fullName = $("input[name='fullName']").val(),
            email = $("#email-c").val();
        if (!company_other) {
            company_other = "Err"
        }

        var registerInc = "../../includes/register.c.inc.php";
        // if ($('#sendInfo').is(":checked")) {
        //     // var registerInc = "../../includes/register.cus.inc.php";
        //     var sendInfo = "Yes";
        // } else {
        //     // var registerInc = "../../includes/register.cus_2.inc.php";
        //     var sendInfo = "No";
        // }
        // if ($('input#testERQ-c').is(':checked')) {
        //     var testERQ = $("#testERQ-c").val();
        // } else {
        //     var testERQ = "no";
        // }
        if (company_info && fullName && email) { // values are not empty
            if (!$('#response').is(':empty')) {
                $('#response').empty();
            }
            $('#create-c').prop('disabled', true);
            $('#create-c .label_').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
            $.post(registerInc, {
                company: company_info,
                company_other: company_other,
                fullName: fullName,
                email: email
            }).done(function (data) {
                $('#create-c').prop('disabled', false);
                $('#create-c .label_').text("Submit").fadeIn();
                if (data === "fail") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed!");
                }
                if (data === "Error 00XE0020") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed! Error 00XE0020");
                }
                if (data === "Error 00XE0021") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("Registration failed! Error 00XE0021");
                }
                if (data === "email") {
                    $('#response-badC').addClass("response-warning").removeClass("response-success").text("A user with this email already exists!");
                }
                if (data === "success") {
                    $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font'>The account has been created. Login information will be sent out with contract notifications</p></div></div></div>");
                    $('#registerCusForm').trigger("reset");
                } else {
                    data = JSON.parse(data);
                    $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font'>An account has been created for " + data[0] + ", please advise  " + data[0] + " to change password at first login!</p><div class='sgh--credentials'><p>Customer ID: " + data[1] + "</p><p class=''>Password: " + data[2] + "</p></div></div></div></div>");
                    $('#registerCusForm').trigger("reset");
                }
            });
        }
    }
}

function registerStaff() { // Staff registration form is submitted
    'use strict';
    if ($("#registerStaffForm")[0].checkValidity()) {
        var first = $("input[name='first']").val();
        var last = $("input[name='last']").val();
        var email = $("#email-s").val();
        var level = $("select[name='level']").val();
        if ($('#sendInfo-s').is(":checked")) {
            var sendInfo = "Yes";
        } else {
            var sendInfo = "No";
        }
        if ($('#sendTestInfo-s').is(':checked')) {
            var sendTestInfo = $("#sendTestInfo-s").val();
        } else {
            var sendTestInfo = 'No';
        }
        if (first && last && email && level) { // values are not empty
            if (!$('#response').is(':empty')) {
                $('#response').empty();
                $('#loader-c').show();
            }
            $('#create-s').hide();
            $('#loader-s').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post("../../includes/register.eng.inc.php", {
                first: first,
                last: last,
                email: email,
                level: level,
                sendInfo: sendInfo,
                sendTestInfo: sendTestInfo
            }).done(function (data) {
                console.log(data);
                if (data === "Error 00XE0027") {
                    $('#response-badS').addClass("response-warning").removeClass("response-success").text("Staff registration email already exists!");
                }
                if (data === "Error 00XE0028") {
                    $('#response-badS').addClass("response-warning").removeClass("response-success").text("Failed to send staff registration email");
                }
                if (data === "Error 00XE0029") {
                    $('#response-badS').addClass("response-warning").removeClass("response-success").text("Failed to find staff registration email");
                }
                if (data === "fail") {
                    $('#response-badS').addClass("response-warning").removeClass("response-success").text("Registration failed!");
                }
                if (data === "email") {
                    $('#response-badS').addClass("response-warning").removeClass("response-success").text("A user with this email already exists!");
                } else {
                    data = JSON.parse(data);
                    // console.log(data[0]);
                    $('#response').html("<div class='sgh--reg-info animated zoomIn'><i class='fa fa-angle-double-down faa-bounce animated'></i><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font'>A confirmation link has been sent to " + data[0] + ", please verify your account by clicking on the link in the email!</p><div class='sgh--credentials'><p>Staff ID: " + data[1] + "</p><p class=''>Password: " + data[2] + "</p></div></div></div></div>");
                    $('#registerStaffForm').trigger("reset");
                }
                $('#create-s').show();
                $('#loader-s').hide();
            }).fail(function () {
                alert("error");
            });
        }
    }
}

function setSRQ() {
    'use strict';
    if ($("#form_SRQ")[0].checkValidity()) {
        var serviceRQ = "serviceRQ";
        var email = $("#em_SRQ").val();
        if (email) { // values are not empty
            $('#btn_SRQ').hide();
            $('#loader_SRQ').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post("../../includes/functions.ajax.inc.php", {
                serviceRQ: serviceRQ,
                email: email
            }).done(function (data) {
                // console.log(data);
                $('#btn_SRQ').show();
                $('#loader_SRQ').hide();
                if (data === "fail") {
                    $('#response_SRQ').addClass("response-warning").removeClass("response-success").text("Request failed!");
                }
                if (data === "success") {
                    $('#notifySRQ').fadeOut('slow').load(document.URL + ' #notifySRQ').fadeIn('slow');
                    $('#edit_SRQ').fadeIn('slow').removeClass("sgh--d-none");
                    $('#serviceRQ').fadeOut('slow').addClass("sgh--d-none");
                }
            });
        }
    }
}

function setENotify(form_id) {
    'use strict';
    if ($("#" + form_id)[0].checkValidity()) {
        var email = $("#" + form_id + " input[type='email']").val(),
            save_btn = $("#" + form_id + " :button"),
            close_btn = $("#edit_" + form_id + " a"),
            notify = "#notify_" + form_id,
            action = $("#" + form_id).attr('data-action');
        console.log(action);
        if (email) {
            save_btn
                .html("<img class='sgh--loading sm' src='../img/ls/loader2.gif'>")
                .attr("disabled", true)
                .prop("disabled", true);
            $.post("../../includes/try.php", {
                notifyEmail: action,
                email: email
            }).done(function (data) {
                console.log(data);
                save_btn
                    .html("Save")
                    .attr("disabled", false)
                    .prop("disabled", false);
                if (data === "fail") {
                    $('#response_TE').addClass("response-warning").removeClass("response-success").text("Request failed!");
                }
                if (data === "success") {
                    console.log("hi");
                    $(notify).fadeOut('slow').load(document.URL + ' ' + notify).fadeIn('slow');
                    close_btn.click();
                    return false;
                }
            });
        }
    }
}

//Functions

$('#sgh--country').change(function () {
    countryCodeValue = $('#sgh--country').find("option:selected").attr("id");
    $('#country_code').val(countryCodeValue);
});

//Add and Edit Jobs


function ts_send_mail(form_id) {
    'use strict';
    if ($("#" + form_id)[0].checkValidity()) {
        var recipients = $("#" + form_id + " input[name='mail_to']").val(),
            subject = $("#" + form_id + " input[name='mail_subject']").val(),
            message = $("#" + form_id + " #editor").html(),
            send_btn = $("#" + form_id + " :button");
        // console.log(recipients +" "+subject + " "+message);
        if (recipients && subject && message) {
            send_btn
                .html("<img class='sgh--loading sm' src='../img/ls/loader2.gif'>")
                .attr("disabled", true)
                .prop("disabled", true);
            $.post("../../includes/send_mail.inc.php", {
                mail_to: recipients, mail_subject: subject,
                mail_message: message
            }).done(function (data) {
                // console.log(data);
                send_btn
                    .html("SEND")
                    .attr("disabled", false)
                    .prop("disabled", false);
                if (data === "fail") {
                    $("#" + form_id + " .response").html("<div class='sgh--alert-2 alert dark alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><div class='sgh--alert-i'><i class='material-icons'>close</i></div><div class='sgh--alert-content'>Could not complete request. Please try again. </div></div>");
                } else if (data === "success") {
                    $("#" + form_id + " .response").html("<div class='sgh--alert-2 alert dark alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><div class='sgh--alert-i'><i class='material-icons'>done</i></div><div class='sgh--alert-content'>Successfully completed! </div></div>");
                    $("#" + form_id)[0].reset();
                    $("#" + form_id + " #editor").empty();
                }
            });
        }
    }
}



// $('#enc').change(function () {
//     var encValue = $(this).val(),
//         url_info = window.location.href,
//         field1 = 'iA',
//         field2 = 'vAss';
//     if ($('input#changeDefaultFin').is(':checked')) {
//         $("input#changeDefaultFin").prop("checked", false);
//     }
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
//             url: "../../includes/functions.ajax.inc.php",
//             data: {'encValue': encValue},
//             dataType: 'html',
//             success: function (data) {
//                 $("#encStyle").html(data);
//                 $(".sgh--d-none.encStyle").removeClass("sgh--d-none");
//             }
//         });
//         if ((encValue == 'Container') || (encValue == 'Small Container')) {
//             var encContainerValue = encValue;
//             $.ajax({
//                 type: 'POST',
//                 url: "../../includes/functions.ajax.inc.php",
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
// $('#encSize').change(function () {
//     var encValue_1 = $('#enc').val();
//     styleValue_1 = $('#encStyle').val(), //get the current value's option
//         sizeValue_1 = $('#encSize').val(),
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
//                     'encValue_1': encValue_1,
//                     'styleValue_1': styleValue_1,
//                     'sizeValue_1': sizeValue_1, iA: iA, vAss: vAss
//                 },
//                 success: function (data) {
//                     $("#encBase").html(data);
//                 }
//             });
//         }
//     } else {
//         $.ajax({
//             type: 'POST',
//             url: "../../includes/functions.ajax.inc.php",
//             data: {
//                 'encValue_1': encValue_1,
//                 'styleValue_1': styleValue_1,
//                 'sizeValue_1': sizeValue_1
//             },
//             success: function (data) {
//                 $("#encBase").html(data);
//             }
//         });
//     }
// });
// $('#enc_finishType').change(function () {
//     var colorTypeValue = $(this).val(),
//         currentColour;
//     if ($('.enc_finishVal').length) {
//         $('.enc_finishVal').remove();
//     }
//     if (colorTypeValue === 'British Standard 4800') {
//         currentColour = $("#encBSCol").find('select').val();
//         $("#encBSCol").removeClass("fadeOutDown sgh--d-none").find('select').prop("selectedIndex", 0).prop('disabled', false);
//         $("#encRALCol").addClass("sgh--d-none fadeIn").find('select').prop('disabled', true);
//     } else if (colorTypeValue === 'RAL') {
//         currentColour = $("#encRALCol").find('select').val();
//         $("#encRALCol").removeClass("fadeOutDown sgh--d-none").find('select').prop("selectedIndex", 0).prop('disabled', false);
//         $("#encBSCol").addClass("sgh--d-none fadeIn").find('select').prop('disabled', true);
//     } else if (colorTypeValue === 'Other') {
//         currentColour = $("#encOtherCol").find('select').val();
//         $("#encRALCol").addClass("sgh--d-none fadeIn").find('select').prop('disabled', true);
//         $("#encBSCol").addClass("sgh--d-none fadeIn").find('select').prop('disabled', true);
//         $("#encOtherCol").removeClass("fadeOutDown sgh--d-none").find('select').prop('disabled', false);
//     }
//     $('#enc_finishColourDiv').html("<input id='enc_finishColourVal' type='hidden' name='enc_finish'/>");
//     console.log(currentColour);
//     $('#enc_finishColourVal').val(currentColour);
// });
$('.sgh--checkbox-button input:checkbox').change(function () {
    if ($(this).is(":checked")) {
        $('div.sgh--checkbox-button').addClass("sgh--ck-btn-inverse-dark");
    } else {
        $('div.sgh--checkbox-button').removeClass("sgh--ck-btn-inverse-dark");
    }
});

function echo(this_is){
    var colorValue1 = $('#'+ this_is).val();
    console.log(colorValue1);
}
function color_select(){
    var optarray = $("#enc_finish").children('option').map(function() {
        return {
            "value": this.value,
            "option": "<option value='" + this.value + "'>" + this.text + "</option>"
        };
    });

    $("#enc_finishType").change(function() {
        $("#enc_finish").children('option').remove();
        var addoptarr = [];
        for (i = 0; i < optarray.length; i++) {
            if (optarray[i].value.indexOf($(this).val()) > -1) {
                addoptarr.push(optarray[i].option);
            }
        }
        $("#enc_finish").html(addoptarr.join(''));
    }).change();
}
function applyChange() {
    var encValue = $('#enc').val(),
        currentColour;
    if ($('input#changeDefaultFin').is(':checked')) {
        $('#enc_finishDefaultApplied').html('<input type="hidden" name="enc_finishDefaultApplied" value="1">');
        $("select[name='enc_finish']").removeClass("sgh--select-disabled");
        $("select[name='enc_finishType']").removeClass("sgh--select-disabled");
        $('#enc_finishColourDiv').empty();
    } else {
        $('#enc_finishDefaultApplied').html('<input type="hidden" name="enc_finishDefaultApplied" value="0">');
        if ((encValue == 'Container') || (encValue == 'Small Container')) {
            $("select[name='enc_finishType'] option[value='RAL']")
                .attr("selected", "selected")
                .prop("selected", true).change();
            $("select[name='enc_finish'] option[value='7046 Telegrey 2']")
                .attr("selected", "selected")
                .prop("selected", true).change();
            $("select[name='enc_finishType']").addClass("sgh--select-disabled");
            $("select[name='enc_finish']").addClass("sgh--select-disabled");
            currentColour = $("#encBSCol").find('select').val();
        } else {
            $("select[name='enc_finishType'] option[value='RAL']")
                .attr("selected", "selected")
                .prop("selected", true).change();
            $("select[name='enc_finish'] option[value='9002 Grey White']")
                .attr("selected", "selected")
                .prop("selected", true).change();
            $("select[name='enc_finishType']").addClass("sgh--select-disabled");
            $("select[name='enc_finish']").addClass("sgh--select-disabled");
            currentColour = $("#encRALCol").find('select').val();
        }
        $('#enc_finishColourDiv').html("<input id='enc_finishColourVal' type='hidden' name='enc_finish'/>");
        $('#enc_finishColourVal').val(currentColour);
    }
}

function mechSelection() {
    var colorTypeValue = $("#enc_finishType").find("option:selected").val();
    if (colorTypeValue === 'British Standard 4800') {
        $("#encBSCol").removeClass("fadeOutDown sgh--d-none").find('select').prop('disabled', false);
        $("#encRALCol").addClass("sgh--d-none fadeIn").find('select').prop('disabled', true);
    }
    if (colorTypeValue === 'RAL') {
        $("#encRALCol").removeClass("fadeOutDown sgh--d-none").find('select').prop('disabled', false);
        $("#encBSCol").addClass("sgh--d-none fadeIn").find('select').prop('disabled', true);
    }
}

function add_mail_recipient(this_id) {
    var action = $("#" + this_id).data("action");
    console.log(action);
    if (action === "all_staff") {
        $('input#email_tags_tag').val("all_staff@portal-crestchic.com").blur();
    } else if (action === "all_customers") {
        $('input#email_tags_tag').val("all_customers@portal-crestchic.com").blur();
    } else if (action === "all_users") {
        $('input#email_tags_tag').val("all_users@portal-crestchic.com").blur();
    }
}


function mechSelection_edits() {
    var encValue, styleValue, sizeValue, styleValueId, baseValue, colorTypeValue;
    encValue = $('#enc').find("option:selected").val();
    styleValue = $('#encStyle').find("option:selected").val();
    styleValueId = $('#encStyle').find("option:selected").attr('id');
    sizeValue = $('#encSize').find("option:selected").val();
    baseValue = $('#encBase').find("option:selected").val();
    colorTypeValue = $("#enc_finishType").find("option:selected").val();
    // $('#mechSel select').trigger('change');
    $('.encStyle').enableSelect();
    // $('.encStyle select.sgh--select-disabled').removeClass("sgh--select-disabled");
    $("#encMountingCol").removeClass("sgh--d-none");
    $("#encLiftingCol").addClass("sgh--d-none");
    $("#encHeightCol").addClass("sgh--d-none");
    $("optgroup.base").not("." + encValue).removeClass("sgh--block").addClass("sgh--d-none");
    $("#encSize optgroup").removeClass("sgh--block").addClass("sgh--d-none");
    $('#encBase option').addClass("sgh--block").removeClass("sgh--d-none");
    if ((encValue === 'Container') || (encValue === 'Small Container')) {
        // $("#encSize optgroup").hasClass(encValue).addClass("sgh--block").removeClass("sgh--d-none");
        $('.encStyle').disableSelect3();
        $("#encLiftingCol").removeClass("sgh--d-none");
        $("#encHeightCol").removeClass("sgh--d-none");
        $("#encMountingCol").addClass("sgh--d-none");
    } else {
        $("#encStyle ." + encValue).addClass("sgh--block").removeClass("sgh--d-none");
        // $("optgroup.base").hasClass(encValue).addClass("sgh--block").removeClass("sgh--d-none");
        $("optgroup.base." + encValue).addClass("sgh--block").removeClass("sgh--d-none");
        // $("#encSize optgroup."+encValue+"#"+styleValue).addClass("sgh--block").removeClass("sgh--d-none");
        if (encValue == 'Horizontal') {
            $("#encSize optgroup.Horizontal").addClass("sgh--block").removeClass("sgh--d-none");
            $("#encSize optgroup.Horizontal option:first").attr('selected', 'selected');
            if (styleValue == 'Fixed') {
                if (sizeValue == '10kW') {
                    $('#encBase option[value!="Channel"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '30kW') {
                    $('#encBase option[value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '100kW') {
                    $('#encBase option[value!="Channel"][value!="Fork Base"][value!="Castors"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '300kW') {
                    $('#encBase option[value!="Channel"][value!="Fork Base"][value!="Castors"][value!="Fork Base with Castors"][value!="Stillage"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '400kW') {
                    $('#encBase option[value!="Channel"][value!="Fork Base"][value!="Fork Base with Castors"][value!="Castors"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '600kW') {
                    $('#encBase option[value!="Channel"][value!="Crash Pack"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
            }
            if (styleValue == 'Transportable') {
                if (sizeValue == '10kW') {
                    $('#encBase option[value!="Castors"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '30kW') {
                    $('#encBase option[value!="Castors"][value!="Crash Pack"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '100kW') {
                    $('#encBase option[value!="Channel"][value!="Castors"][value!="Fork Base with Castors"][value!="Crash Pack"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '300kW') {
                    $('#encBase option[value!="Channel"][value!="Castors"][value!="Fork Base with Castors"][value!="Crash Pack"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '400kW') {
                    $('#encBase option[value!="Channel"][value!="Castors"][value!="Fork Base with Castors"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '600kW') {
                    $('#encBase option[value!="Channel"][value!="Castors"][value!="Fork Base with Castors"][value!="Crash Pack"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
            }
            if (styleValue == 'Transportable / Trailer Mounted') {
                $('#encBase option[value!="Channel"]').removeClass("sgh--block").addClass("sgh--d-none");
            }
        }
        if (encValue == 'Vertical') {
            $("#encSize>optgroup." + styleValueId).addClass("sgh--block").removeClass("sgh--d-none");
            $("#encSize optgroup." + styleValueId + " option:first").attr('selected', 'selected');
            console.log("#encSize>optgroup." + styleValueId);
            if (styleValue == 'Fixed') {
                if (sizeValue == '500kW (2 fan)') {
                    $('#encBase option[value!="Channel"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if ((sizeValue == '1000kW (3 fan)') || (sizeValue == '1200kW (3 fan)')) {
                    $('#encBase option[value!="Channel"][value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if ((sizeValue == '1600kW (4 fan)') || (sizeValue == '2000kW (5 fan)') || (sizeValue == '2400kW (6 fan)')) {
                    $('#encBase option[value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
            }
            if (styleValue == 'Transportable') {
                if ((sizeValue == '1000kW (3 fan)') || (sizeValue == '1200kW (3 fan)')) {
                    $('#encBase option[value!="Castors"][value!="Fork Base"][value!="Fork Base with Castors"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '1600kW (4 fan)') {
                    $('#encBase option[value!="Fork Base with Castors"][value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
            }
            if (styleValue == 'Transportable / Trailer Mounted') {
                if ((sizeValue == '1000kW (3 fan)') || (sizeValue == '1200kW (3 fan)')) {
                    $('#encBase option[value!="Channel"][value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if (sizeValue == '1600kW (4 fan)') {
                    $('#encBase option[value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
            }
            if (styleValue == 'Attenuated') {
                if (sizeValue == '1000kW (3 fan)') {
                    $('#encBase option[value!="Channel"][value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
                if ((sizeValue == '1600kW (4 fan)') || (sizeValue == '2000kW (5 fan)')) {
                    $('#encBase option[value!="Fork Base"]').removeClass("sgh--block").addClass("sgh--d-none");
                }
            }
        }
        $("#encBase option.sgh--block:first").attr('selected', 'selected');
        // $("#encSize optgroup.sgh--block option:first").attr('selected','selected');
    }
    if (colorTypeValue === 'British Standard 4800') {
        $("#encBSCol").removeClass("fadeOutDown sgh--d-none");
        $("#encRALCol").addClass("sgh--d-none fadeIn");
    }
    if (colorTypeValue === 'RAL') {
        $("#encRALCol").removeClass("fadeOutDown sgh--d-none");
        $("#encBSCol").addClass("sgh--d-none fadeIn");
    }
}

function updatePartsI() {
    $("#partQ").val($("#partQInput").val());
    $("#partNo").val($("#partNoInput").val());
    $("#partDes").val($("#partDesInput").val());
}

function updateParts() {
    $("#updatePartsForm").submit();
}

function set_isCM() {
    'use strict';
    var isCMValue = $("#i_isCM").val();
    if ($('input#i_isCM').is(':checked')) {
        var perm_ = "enable";
    } else {
        var perm_ = "disable";
    }
    $.post(url, {
        isCM: isCMValue, perm_: perm_
    }).done(function (data) {
        console.log(data);
        if (data === "failed") {
            console.log("fail");
        }
        if (data === "success") {
            console.log("success");
        } else {
            console.log("error");
        }

    });
}

function set_isTM() {
    'use strict';
    var isTMValue = $("#i_isTM").val();
    if ($('input#i_isTM').is(':checked')) {
        var perm_ = "enable";
    } else {
        var perm_ = "disable";
    }
    $.post(url, {
        isTM: isTMValue, perm_: perm_
    }).done(function (data) {
        console.log(data);
        if (data === "failed") {
            console.log("fail");
        }
        if (data === "success") {
            console.log("success");
        } else {
            console.log("error");
        }

    });
}

function set_isSM() {
    'use strict';
    var isSMValue = $("#i_isSM").val();
    if ($('input#i_isSM').is(':checked')) {
        var perm_ = "enable";
    } else {
        var perm_ = "disable";
    }
    $.post(url, {
        isSM: isSMValue, perm_: perm_
    }).done(function (data) {
        console.log(data);
        if (data === "failed") {
            console.log("fail");
        }
        if (data === "success") {
            console.log("success");
        } else {
            console.log("error");
        }
    });
}


//Dashboard Map Info
function getAssData() {
    var assDataValue = 'getAssData';
    $.get(url, {
        assDataValue: assDataValue
    }).done(function (data) {
        console.log(data);
    });
}

// formData.append('file', this.files[0], signatureTitle + 'png');
// $.ajax({
//     url: "../../includes/signDoc.inc.php",
//     data: formData,
//     processData: false,
//     contentType: false,
//     type: 'POST',
//     success: callback
// });formData = new FormData(),
//         signatureTitle = $("#sign_btn").attr("data-title")

function sgh_sign(form_id) {
    'use strict';
    if (!$("#" + form_id + " .submit_btn").hasClass('disabled')) {
        var delay = 2000,
            url_info = window.location.href,
            field1 = 'iA',
            field2 = 'iC',
            field3 = 'vAss';
        if ((url_info.indexOf('?' + field1 + '=') != -1) && (url_info.indexOf('&' + field2 + '=') != -1) && (url_info.indexOf('&' + field3 + '=') != -1)) {
            var iA = $.urlParam('iA'),
                iC = $.urlParam('iC'),
                vAss = $.urlParam('vAss');
            if (iA && iC) {
                $("#" + form_id + " .onLoadLab").hide();
                $("#" + form_id + " .loadingLab").show();
                $.post("../../includes/sign_doc.inc.php", {
                        iA: iA, iC: iC, vAss: vAss
                    }
                ).done(function (data) {
                    setTimeout(function () {
                        if (data === "success") {
                            $("#" + form_id + " .loadingLab").hide();
                            $("#" + form_id + " .onFinishLab").show();
                            $("#" + form_id + " .submit_btn").addClass('disabled');
                            $("#" + form_id + " .sgh--modal-close").hide();
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

                        } else if ((data === "error") || (data === "failed") || (data === "sign_failed")) {
                            console.log(data);
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                            if (data === "error") {
                                $("#" + form_id + " .sgh--modal-footer-response")
                                    .addClass("warning")
                                    .html("An error occurred please check the URL or contact system admin");
                            }
                            if (data === "sign_failed") {
                                $("#" + form_id + " .sgh--modal-footer-response")
                                    .addClass("warning")
                                    .html("Not checked by Constact or Technical Manager");
                            }
                        } else if (data === "sign_failed1") {
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                        } else {
                            console.log(data);
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                            $("#" + form_id + " .sgh--modal-footer-response")
                                .addClass("warning")
                                .html("An error occurred please check the URL or contact system admin");
                        }
                    }, delay);
                });
            }
        }
    }
}

function sgh_e_sign(form_id) {
    'use strict';
    if (!$("#" + form_id + " .submit_btn").hasClass('disabled')) {
        var delay = 2000,
            url_info = window.location.href,
            field1 = 'iA',
            field2 = 'iC',
            field3 = 'vAss',
            field4 = 'e';
        if ((url_info.indexOf('?' + field1 + '=') != -1) && (url_info.indexOf('&' + field2 + '=') != -1) && (url_info.indexOf('&' + field3 + '=') != -1) && (url_info.indexOf('&' + field4 + '=') != -1)) {
            var iA = $.urlParam('iA'),
                iC = $.urlParam('iC'),
                vAss = $.urlParam('vAss'),
                email = $.urlParam('e');
            if (iA && iC && vAss && email) {
                $("#" + form_id + " .onLoadLab").hide();
                $("#" + form_id + " .loadingLab").show();
                $.post("../../includes/signDoc_e.inc.php", {
                        iA: iA, iC: iC, vAss: vAss, e: email
                    }
                ).done(function (data) {
                    setTimeout(function () {
                        if (data === "success") {
                            $("#" + form_id + " .loadingLab").hide();
                            $("#" + form_id + " .onFinishLab").show();
                            $("#" + form_id + " .submit_btn").addClass('disabled');
                            $("#" + form_id + " .sgh--modal-close").hide();
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
                        } else if ((data === "error") || (data === "failed") || (data === "sign_failed")) {
                            console.log(data);
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                            if (data === "error") {
                                $("#" + form_id + " .sgh--modal-footer-response")
                                    .addClass("warning")
                                    .html("An error occurred please check the URL or contact system admin");
                            }
                            if (data === "sign_failed") {
                                $("#" + form_id + " .sgh--modal-footer-response")
                                    .addClass("warning")
                                    .html("Not checked by Constact or Technical Manager");
                            }
                        } else if (data === "sign_failed1") {
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                        } else {
                            console.log(data);
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                            $("#" + form_id + " .sgh--modal-footer-response")
                                .addClass("warning")
                                .html("An error occurred please check the URL or contact system admin");
                        }
                    }, delay);
                });
            }
        }
    }
}

function sgh_clear_response(form_id) {
    $("#" + form_id + " .sgh--modal-footer-response").empty();
}

function sgh_query(form_id) {
    'use strict';
    if (!$("#" + form_id + " .submit_btn").hasClass('disabled')) {
        var delay = 2000,
            url_info = window.location.href,
            field1 = 'iA',
            field2 = 'iC',
            field3 = 'vAss';
        if ((url_info.indexOf('?' + field1 + '=') != -1) && (url_info.indexOf('&' + field2 + '=') != -1) && (url_info.indexOf('&' + field3 + '=') != -1)) {
            var iA = $.urlParam('iA'),
                iC = $.urlParam('iC'),
                vAss = $.urlParam('vAss'),
                pendingQuery_info = $("#" + form_id + " textarea[name='pendingQuery']").val();
            console.log(pendingQuery_info);
            if (iA && iC && pendingQuery_info) {
                $("#" + form_id + " .onLoadLab").hide();
                $("#" + form_id + " .loadingLab").show();
                $.post("../../includes/query_doc.inc.php", {
                        iA: iA, iC: iC, vAss: vAss, pendingQuery: pendingQuery_info
                    }
                ).done(function (data) {
                    setTimeout(function () {
                        if (data === "success") {
                            $("#" + form_id + " .loadingLab").hide();
                            $("#" + form_id + " .onFinishLab").show();
                            $("#" + form_id + " .submit_btn").addClass('disabled');
                            $("#" + form_id + " .sgh--modal-close").hide();
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

                        } else if ((data === "error") || (data === "failed") || (data === "sign_failed")) {
                            console.log(data);
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                            if (data === "error") {
                                $("#" + form_id + " .sgh--modal-footer-response")
                                    .addClass("warning")
                                    .html("An error occurred please check the URL or contact system admin");
                            }
                            if (data === "sign_failed") {
                                $("#" + form_id + " .sgh--modal-footer-response")
                                    .addClass("warning")
                                    .html("Not checked by Constact or Technical Manager");
                            }
                        } else if (data === "sign_failed1") {
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                        } else {
                            console.log(data);
                            $("#" + form_id + " .onLoadLab").show();
                            $("#" + form_id + " .loadingLab").hide();
                            $("#" + form_id + " .sgh--modal-footer-response")
                                .addClass("warning")
                                .html("An error occurred please check the URL or contact system admin");
                        }
                    }, delay);
                });
            }
        }
    }
}

function sgh_createCanvas(this_id) {
    "use strict";
    // function doWorkWithResult() {
    //     if (window.uid_e == undefined) {
    //         setTimeout(doWorkWithResult, 100); //Callback hasn't been called yet, wait 100 ms
    //     } else {
    //         alert(window.uid_e);
    //     }
    //     console.log(window.uid_e);
    // }
    //
    // doWorkWithResult();
    // alert(' $uid_e ');
    $("#" + this_id).fadeOut("slow").hide();
    $("#" + this_id + " ~ a#sgh_deleteCanvas").fadeOut("slow").hide();
    $("#signature_canvas")
        .hide()
        .addClass("sgh_signatures")
        .html("<div id='signature-pad' class='signature-pad'><div class='signature-pad--body'><canvas></canvas></div><div class='signature-pad--footer'><div class='description'>Sign above</div><div class='signature-pad--actions'><div><button type='button' class='clear btn sgh--btn-inverse-dark' data-action='clear'>Clear</button><button type='button' class='btn sgh--btn-inverse-dark' data-action='change-color'>Change colour</button><button type='button' class='btn sgh--btn-inverse-dark' data-action='undo'>Undo</button></div><div><button type='button' class='save btn sgh--btn-inverse-dark' data-title='" + window.uid_e + "' data-action='save-btn'>Save</button><button type='button' class='save btn sgh--btn-danager' data-action='close-btn' onclick='sgh_closeCanvas()'>Close</button></div></div></div></div>")
        .fadeIn('slow');
    var sgh_canvas = $("#signature-pad canvas");
    var signaturePad = new SignaturePad();
}

function sgh_closeCanvas() {
    $("#signature_canvas").removeClass("sgh_signatures").empty();
    $("#sgh_createCanvas").fadeIn("slow").show();
    $("#sgh_deleteCanvas").fadeIn("slow").show();
}

function sgh_deleteCanvas(this_id) {
    'use strict';
    if (!$("#" + this_id).hasClass('disabled')) {
        var delay = 1000,
            signatureToDelete = $("#" + this_id).data('title');
        if (signatureToDelete) {
            $("#" + this_id).addClass("disabled");
            $("#" + this_id + " .onLoadLab").hide();
            $("#" + this_id + " .loadingLab").show();
            $.post("../../includes/delSign.inc.php", {
                    signatureToDelete: signatureToDelete
                }
            ).done(function (data) {
                setTimeout(function () {
                    if (data === "success") {
                        $("#" + this_id + " .loadingLab").hide();
                        $("#" + this_id + " .onFinishLab").show();
                    } else if (data === "failed") {
                        $("#" + this_id).removeClass("disabled");
                        $("#" + this_id + " .onLoadLab").show();
                        $("#" + this_id + " .loadingLab").hide();
                    } else {
                        console.log(data);
                    }
                }, delay);
            });
        }
    }
}

function sgh_print(el) {
    var restorepage = document.body.innerHTML,
        printcontent = document.getElementById(el).innerHTML,
        originalTitle = document.title;
    document.body.innerHTML = printcontent;
    document.title = "Contract Review Document";
    window.print();
    document.body.innerHTML = restorepage;
    document.title = originalTitle;
}

function sgh_signHereOpen() {
    $("body").addClass("sgh_signHere_open");
}

function sgh_signHereClose() {
    $("body").removeClass("sgh_signHere_open");
}

function sgh_queryHereOpen() {
    sgh_signHereOpen();
}

function sgh_queryHereClose() {
    sgh_signHereClose();
}

function loginActivity() {
    var dt = new Date();
    lastActivity = "Accessed with " + platform.name + " v" + platform.version + " on " + platform.os + " at " + dt;
    // device.html(lastActivity);
    if (lastActivity && window.this_id_e) {
        $.post(url, {
            id_e: window.this_id_e,
            lastActivity: lastActivity
        })
            .done(function (data) {
                console.log(data);
            });
    }
}



var dropUp = function () {
    var windowHeight = $(window).innerHeight();
    var pageScroll = $('body').scrollTop();

    $("td.ts--status-info").each(function () {
        var offset = $(this).offset().top;
        var space = windowHeight - (offset - pageScroll);
        console.log(space);
        if (space > 500) {
            // $(this).after().css("top", "0");
            $(this).addClass("dropup");
        } else {
            // $(this).css({"bottom": "0"});
            $(this).removeClass("dropup");
        }
    });
}

// $(window).load(dropUp);
// $(window).bind('resize scroll mousewheel', dropUp);
$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    } else {
        return decodeURI(results[1]) || 0;
    }
};
$.fn.disabledCSS = function () {
    return this.each(function () {
        $("input[type=radio][disabled]").parents('label').css({
            "color": "rgba(170, 170, 170, 1)",
            "cursor": "not-allowed"
        });
    });
};
$.fn.enabledCSS = function () {
    return this.each(function () {
        $("input[type=radio]").parents('label').css({
            "color": "rgba(0, 0, 0, 0.84)",
            "cursor": "pointer"
        });
    });
};
$.fn.disableSelect = function () {
    return this.each(function () {
        $(this).find('select').addClass("sgh--select-disabled");
    });
};
$.fn.disableSelect2 = function () {
    return this.each(function () {
        $(this).find('select').addClass("sgh--select-disabled");
        $(this).find('select option:selected').each(function () {
            $(this).removeAttr('selected').remove();
        });
        if ($(this).find("select option[value='N/A']").length == 0) {
            $(this).find('select').append($('<option>', {
                value: 'N/A',
                text: 'N/A'
            }));
        }
        $(this).find("select option[value='N/A']").attr("selected", "selected").trigger('change');
        // $(this).find('select option:nth-child(2)').attr("selected", true);
    });
};
$.fn.disableSelect3 = function () {
    return this.each(function () {
        $(this).find('select').addClass("sgh--select-disabled");
        $(this).find('select option:selected').each(function () {
            $(this).removeAttr('selected').remove();
        });
        $(this).find("select optgroup option[value='N/A']").attr("selected", "selected").trigger('change');
    });
};
$.fn.enableSelect = function () {
    return this.each(function () {
        $(this).find('select').removeClass("sgh--select-disabled");
        $(this).find('select ~ :input').prop('disabled', true);
        // $("select.withOther ~ textarea").hide().prop('disabled', true);
        // $(".withOther ~ .otherField").hide().prop('disabled', true);
    });
};
$.fn.kwCalculation = function () {
    // console.log($(this));
    // console.log($(this).find('input:eq(2)').val());
    var _changeInterval = null;
    // wait untill user type in something
    // Don't let call setInterval - clear it, user is still typing
    clearInterval(_changeInterval);
    var kwInput, kw, kva, pf;
    kwInput = $(this).find(':input:eq(2)');
    kva = $(this).find(':input:eq(0)').val();
    pf = $(this).find(':input:eq(1)').val();
    console.log(kva);
    console.log(pf);
    _changeInterval = setInterval(function () {
        // Typing finished, now you can Do whatever after 2 sec
        if ((!kva.trim() == '') && (!pf.trim() == '')) {
            kw = kva * pf;
            kwInput.val(kw);
        }
        clearInterval(_changeInterval)
    }, 100);
};
$.fn.kwCalculation2 = function () {
    var _changeInterval = null;
    clearInterval(_changeInterval);
    var kwInput, kw, kva, pf;
    kwInput = $(this).find(':input[name=mainKW]');
    kva = $(this).find(':input[name=mainKVA]').val();
    pf = $(this).find(':input[name=mainPF]').val();
    console.log(kva);
    console.log(pf);
    _changeInterval = setInterval(function () {
        if ((!kva.trim() == '') && (!pf.trim() == '')) {
            kw = kva * pf;
            kwInput.val(kw);
        }
        clearInterval(_changeInterval)
    }, 100);
};
$.fn.isValidEmail = function () {
    var form_id = $(this).attr("data-title"),
        icon = $("#" + form_id + " .result_icon"),
        save_btn = $("#" + form_id + " :button"),
        response = $("#response_email_" + form_id),

        emailValue = $(this).val(),
        aType = $(this).attr("data-info");
    $.post("info.email.php", {
        emailValue: emailValue
    }).done(function (data) {
        console.log(data);
        if (data === "fail") {
            save_btn.attr("disabled", "disabled");
            icon.html("<i class='icon-close fail'></i>");
            $("#result-hr-c").addClass("fail")
            response.addClass("fail").removeClass("success").html("<div class='alert_material alert_material-danger' role='alert'><span class='icon'><i class='icon-close'></i></span> <span class='info'><span id='validEmail'>A user with this email already exists!</span><span id='sameEmail' class='sgh--inline-block'></span></span></div>");
        }
        if (data === "success") {
            save_btn.removeAttr("disabled");
            icon.html("<i class='icon-check success'></i>");
            $("#result-hr-c").removeClass("fail")
            response.empty();
        }
    });
};
$.fn.isSameEmail = function () {
    var form_id = $(this).attr("data-title"),
        icon = $("#" + form_id + " .result_icon_2"),
        save_btn = $("#" + form_id + " :button"),
        response = $("#response_email_" + form_id),
        email = $("#" + form_id + " input[name='emailN']").val(),
        verifiedEmail = $("#" + form_id + " input[name='emailC']").val();
    if (email === verifiedEmail) {
        save_btn.removeAttr("disabled");
        icon.html("<i class='icon-check success'></i>");
        $("#result-hr-c").removeClass("fail")
        if ($("#validEmail").is(':empty')) {
            response.empty();
        } else {
            $("#sameEmail").empty();
        }
    } else {
        save_btn.attr("disabled", "disabled");
        icon.html("<i class='icon-close fail'></i>");
        $("#result-hr-c").addClass("fail");
        if ($("#response_email_" + form_id + " .alert_material.alert_material-danger").length) {
            $("#sameEmail").html("");
        } else {
            response.addClass("fail").removeClass("success").html("<div class='alert_material alert_material-danger' role='alert'><span class='icon'><i class='icon-close'></i></span> <span class='info'><span id='validEmail'></span><span id='sameEmail' class='sgh--inline-block'></span>Emails do not match!</span></div>");
        }
    }
};
$.fn.isValidEmail_s = function () {
    var emailValue = $(this).val();
    var aType = "Customer";
    $.post("info.email.php", {
        emailValue: emailValue
    }).done(function (data) {
        // console.log(data);
        if (data === "fail") {
            $("#create-c").attr("disabled", "disabled");
            $("#result-icon-c").html("<i class='icon-close fail'></i>");
            $("#result-hr-c").addClass("fail")
            $("#result-c").addClass("fail").removeClass("success").html("<i class='icon-close'></i> A user with this email already exists!");
        }
        if (data === "success") {
            $("#create-c").removeAttr("disabled");
            $("#result-icon-c").html("<i class='icon-check success'></i>");
            $("#result-hr-c").removeClass("fail")
            $("#result-c").empty();
        }
        if (data === "") {
        }
    });
};
$.fn.onEnterKey = function (form_id, e) {
// Get the input field
    var input = $("#" + form_id + " input:not([type='checkbox']):last"),
        button = $("#" + form_id + " :button");
    input.keypress(function (e) {
        var key = e.which;
        if (key === 13) {
            button.click();
            return false;
        }
    });
};


$("form input:not([type='checkbox']):last").keyup(function () {
    var formID = $(this).parents("form").attr('id');
    $(this).onEnterKey(formID);
});
$("#partSubmit").click(function () {
    $("#updatePartsForm").submit();
});

function assetNoValid() {
    var assValue = $("#asset-no").val();
    $.post("info.ass.php", {
        assValue: assValue
    }).done(function (data) {
        // console.log(data);
        if (data == "fail") {
            $("#tick").hide();
            $("#cross").fadeIn();
            $(".buttonNext.btn.btn-success").addClass("sgh--d-none");
        }
        if (data == "success") {
            $("#cross").hide();
            $("#tick").fadeIn();
            $(".buttonNext.btn.btn-success").removeClass("sgh--d-none");
        }
        if (data == "") {
            $("#cross").hide();
            $("#tick").hide();
            $(".buttonNext.btn.btn-success").addClass("sgh--d-none");
        }
    });
}

$(document).on('keyup', "#asset-no", function () {
    assetNoValid();
});

// function  get_company_info(this_id) {
//     var companyValue = $("#" + this_id).val(),
//         companyAction = $("#" + this_id).attr('data-action'),
//         vAssValue = window.vAssValue;
//     if ((typeof vAssValue != "undefined") && (vAssValue != null)) {
//         vAssValue = window.vAssValue;
//     } else {
//         vAssValue = "N/A";
//     }
//     if (companyValue && vAssValue) {
//         $.get(url, {
//             companyValue: companyValue,
//             companyAction: companyAction,
//             vAssValue: window.vAssValue
//         }, function (data) {
//             $("#info").html(data);
//             $('#postcode_lookup').getAddress({
//                 api_key: 'bchnos67rUqSmp8-Y31Dvg14512',
//                 // <!--  Or use your own endpoint - api_endpoint:https://your-web-site.com/getAddress, -->
//                 output_fields: {
//                     line_1: "#address-line-1",
//                     line_2: "#address-line-2",
//                     line_3: "#address-line-3",
//                     post_town: "#address-line-4",
//                     postcode: "#address-line-5",
//                     country: "#address-line-6"
//                 },
//                 <!--  Optionally register callbacks at specific stages -->
//                 onLookupSuccess: function (data) { /* Your custom code */
//                 },
//                 onLookupError: function () { /* Your custom code */
//                 },
//                 onAddressSelected: function (elem, index) { /* Your custom code */
//                 }
//             });
//         });
//     }
// };

$("#email-c").keyup(function () {
    $(this).isValidEmail_s();
});


// $("#encSize optgroup").addClass("sgh--d-none");
// $("." + valueOfSelected).addClass("sgh--block").removeClass("sgh--d-none");
// $("select#enc_finishType").change(function() {
//     var valueOfSelected = $(this).find("option:selected").val();
//     if (valueOfSelected === 'British Standard 4800') {
//         $("#encBSCol").removeClass("fadeOutDown sgh--d-none");
//         $("#encRALCol").addClass("sgh--d-none fadeIn");
//     }
//     if (valueOfSelected === 'RAL') {
//         $("#encRALCol").removeClass("fadeOutDown sgh--d-none");
//         $("#encBSCol").addClass("sgh--d-none fadeIn");
//     }
// });
$(".record_a select[id^=enc]").change(function () {
    // mechSelection();
});

$(".record_ee select[id^=enc]").change(function () {
    // mechSelection_edits();
});
$('#world-map-assets').on('mousewheel', function (event, delta, deltaX, deltaY) {
    event.preventDefault();
    if (delta == 1) {
        $('.jqvmap-zoomin').trigger('click');
    } else {
        $('.jqvmap-zoomout').trigger('click');
    }
});
// device = $("div#ts_device1");
// if ((typeof device != "undefined") && (device != null)) {
//     console.log(platform);
//     loginActivity();
// }
$(document).ready(function () {
    init_specSelections();
    ts_sel_a_form();
    color_select();
    $("#checkedS-0").click(function () {
        if ($(this).is(":checked")) {
            $("#complete-0").attr("checked", true);
        } else {
            $("#complete-0").attr("checked", false);
        }
    });
    $("input.disablecopypaste").bind("copy paste", function (e) {
        e.preventDefault();
    });
    $("#email-c").keyup(function () {
        var emailValue = $(this).val();
        var aType = "Customer";
        $.post("info.email.php", {
            emailValue: emailValue
        }).done(function (data) {
            console.log(data);
            if (data === "fail") {
                $("#create-c").attr("disabled", "disabled");
                $("#result-icon-c").html("<i class=\'icon-close fail\'></i>");
                $("#result-hr-c").addClass("fail")
                $("#result-c").addClass("fail").removeClass("success").html("<i class=\'icon-close\'></i> A user with this email already exists!");
            } else if (data === "success") {
                $("#create-c").removeAttr("disabled");
                $("#result-icon-c").html("<i class=\'icon-check success\'></i>");
                $("#result-hr-c").removeClass("fail")
                $("#result-c").empty();
            } else if (data === "") {
            }
        });
    });
    $("#email-s").keyup(function () {
        var emailValue = $(this).val();
        var aType = "Staff";
        $.post("info.email.php", {
            emailValue: emailValue,
            aType: aType
        }).done(function (data) {
            console.log(data);
            if (data === "fail") {
                $("#create-s").attr("disabled", "disabled");
                $("#result-icon-s").html("<i class=\'icon-close fail\'></i>");
                $("#result-hr-s").addClass("fail")
                $("#result-s").addClass("fail").removeClass("success").html("<i class=\'icon-close\'></i> A user with this email already exists!");
            } else if (data === "success") {
                $("#create-s").removeAttr("disabled");
                $("#result-icon-s").html("<i class=\'icon-check success\'></i>");
                $("#result-hr-s").removeClass("fail")
                $("#result-s").empty();
            } else if (data === "") {
            }
        });
    });
    $("#email-cc").keyup(function () {
        var emailValue = $(this).val();
        var aType = "Customer";
        $.post("info.email.php", {
            emailValue: emailValue
        }).done(function (data) {
            console.log(data);
            if (data === "fail") {
                $("#update-cc").attr("disabled", "disabled");
                $("#result-icon-cc").html("<i class=\'icon-close fail\'></i>");
                $("input#email-cc.sgh--form-control").addClass("fail-hr");
                $("#result-cc").addClass("fail").removeClass("success").html("<i class=\'icon-close\'></i> A user with this email already exists!");
            } else if (data === "success") {
                $("#update-cc").removeAttr("disabled");
                $("#result-icon-cc").html("<i class=\'icon-check success\'></i>");
                $("input#email-cc.sgh--form-control").removeClass("fail-hr");
                $("#result-cc").empty();
            }
            if (data === "") {
            }
        });
    });
    $("#re-email-cc").blur(function () {
        //check to two here.
        if ($("#email-cc").val() != $("#re-email-cc").val()) {
            $("#update-cc").attr("disabled", "disabled");
            $("#re-result-icon-cc").html("<i class=\'icon-close fail\'></i>");
            $("input#re-email-cc.sgh--form-control").addClass("fail-hr");
            $("#result-cc").addClass("fail").removeClass("success").html("<i class=\'icon-close\'></i> Email does not match!");
        } else {
            $("#update-cc").removeAttr("disabled");
            $("#re-result-icon-cc").html("<i class=\'icon-check success\'></i>");
            $("input#re-email-cc.sgh--form-control").removeClass("fail-hr");
            $("#result-cc").empty();
        }
    });


    // $('td.ts--status-info:after').hover(function(){
    //     var scrollTop     = $(window).scrollTop(),
    //     elementOffset = $('td.ts--status-info').offset().top,
    //     distance      = (elementOffset - scrollTop);
    //     console.log(distance);
    //     $(this).css('max-height', distance);
    // });
});



