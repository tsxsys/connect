var url = '' . VIEWS_URL . 'user/inc/ajax/account.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value');
$(function () {

});


function actionPost(this_id, form_id) {
    // form_submit_btn = $(this).find('button:submit').attr('id');
    //Instantiate empty FormData object
    var postData = $('form#' + form_id).serialize() + "&ajax_action=" + $('#' + this_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
        formRole = $('form#' + form_id).attr('data-role'),
        messageBox = $('form#' + form_id + ' .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
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
            // console.log(response.message);
            // console.log(response.arr);
            if (formRole === 'set') {
                $('#' + form_id).trigger('reset');
            }
            $('#' + this_id).prop('disabled', false);
            $('#' + this_id + '.label').text("Submit").fadeIn();
            notice.fire({
                icon: response.stat,
                title: response.message
            })
        },
        beforeSend: function () {
            $('#' + this_id).prop('disabled', true);
            $('#' + this_id + '.label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function (response) {
            alert(response.message);
        }
    });
}
function userInfoPull(id, elem) {
    $.ajax({
        type: "POST",
        url: "' . VIEWS_URL . 'admin/inc/user_getinfo.php",
        data: { "user_id": id, "csrf_token": $('meta[name="csrf_token"]').attr("value") },
        async: false,
        success: function(user_info){
            user_info = JSON.parse(user_info);
            var user_info_html = '';
            for(var prop in user_info){
                if (user_info[prop] != '' && user_info[prop] != null){
                    if(prop == 'UserImage'){
                        user_info_html += '<br><div class="img-thumbnail"><img src="'+user_info[prop]+'" height="240px"></div>';
                    } else {
                        user_info_html += '<div><b>' + prop.replace(/([A-Z])/g, ' $1') + ': </b>'+ user_info[prop] +'</div>';
                    }
                }
            }
            $(elem).attr('data-content', user_info_html).popover('show', {"html": true});
        },
        error: function (xhr, error, thrown) {
            console.log( error );
        }
    });
}
function profileEdit(request_id) {
    $.ajax({
        type: "POST",
        url: "partials/pieces/profile-edit-admin.piece.php",
        data: {id: request_id, "csrf_token": $('meta[name="csrf_token"]').attr("value")},
        success: function (response) {
            $("#profile_edit").html(response);
            $('#x_edit_' + request_id + '99').modal('toggle');
        },
        error: function (err) {
            console.log(err);
            alert(err.responseText);
            console.log(err.responseText);
        }
    });
}
function updateProfile(btn_id, form_id) {
    'use strict';
    var form = $('form#' + form_id),
        formData = form.serialize() + "&request_id=" + form.attr('data-xeid') + "&ajax_action=" + $('#' + btn_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
        formRole = form.attr('data-role'),
        btnLabel = $('#' + btn_id + ' .label').text(),
        messageBox = form.find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });

    if (form[0].checkValidity()) {
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
                    if (formRole === 'set') {
                        $('#' + form_id).trigger('reset');
                    }
                    notice.fire({
                        icon: response.stat,
                        title: response.message
                    });
                    $('#' + btn_id + ' .label').text(btnLabel).fadeIn();
                    $('#' + btn_id).prop('disabled', false);
                    $('#' + form_id + ' input').prop('disabled', false);
                } else if (response.status === false) {
                    messageBox.html(response.err_message);
                }
            },
            beforeSend: function () {
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
                alert(response.err_message);
            }
        });
    }
}
function resetAccountPwd(btn_id, form_id) {
    var form = $('form#' + form_id),
        formData = form.serialize() + "&request_id=" + form.attr('data-xeid') + "&ajax_action=" + $('#' + btn_id).attr("data-action") + "&csrf_token=" + $('meta[name="csrf_token"]').attr("value"),
        btnLabel = $('#' + btn_id + ' .label').text(),
        messageBox = form.find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
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
                $('#reset_account_pwd_msg').html(response.new_pwd).fadeIn();
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
                $('#' + btn_id + ' .label').text(btnLabel).fadeIn();
                $('#' + btn_id).prop('disabled', false);
                $('#' + form_id + ' input').prop('disabled', false);
            } else if (response.status === false) {
                messageBox.html(response.err_message);
            }
        },
        beforeSend: function () {
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
            alert(response.err_message);
        }
    });
}
$(document).on('keyup', '#email', function () {
    var input_id = $(this).attr('id'),
        data = $(this).val();
    emailChecker(input_id, data);
});
$(document).on('submit', '#form_profile_img_update, #form_profile_bg_img_update', function (e) {
    e.preventDefault();
    var formData = new FormData(this),
        btn_id = $(this).find('button:submit').attr('id'),
        messageBox = $(this).find('div .message'),
        notice = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500000
        });
    formData.append("ajax_action", this.getAttribute('data-action'));
    formData.append("request_id", this.getAttribute('data-xeid'));
    messageBox.empty();
    $.ajax({
        url: url,   	// Url to which the request is send
        type: 'POST',      				// Type of request to be send, called as method
        data: formData, 		// Data sent to server, a set of key/value pairs representing form fields and values
        contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        cache: false,					// To unable request pages to be cached
        processData: false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        dataType: 'json',
        success: function (response)  		// A function to be called if request succeeds
        {
            if (response.status == true) {
                notice.fire({
                    icon: response.stat,
                    title: response.message
                });
            } else if (response.status == false) {
                messageBox.html(response.err_message);
            }
            $('#' + btn_id + ' .label').text("Change Image").fadeIn();
        },
        beforeSend: function () {
            $('#' + btn_id).prop('disabled', true);
            $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        error: function (response) {
            alert(response.err_message);
            $('#' + btn_id + ' .label').text("Change Image").fadeIn();
        }
    });
});


$(document).ready(function (e) {

    var croppedimg;
    var imgChange = false,
        bgImgChange = true;

    function ajaxSend(formData) {

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        $.ajax({
            url: "' . VIEWS_URL . 'user/inc/ajax/profileupdate.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (html) {

                if (html == 1) {
                    $("#message_person_info").fadeOut(0, function () {
                        $(this).html("<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes saved!</div>").fadeIn();
                    })
                    $('#submit_person_info').hide();
                } else {
                    $("#message_person_info").fadeOut(0, function () {
                        $(this).html(html).fadeIn();
                    })
                    $('#submit_person_info').show();

                    $.ajax({
                        url: "' . VIEWS_URL . 'user/ajax/getimage.php",
                        type: "POST",
                        data: {"csrf_token": $('meta[name="csrf_token"]').attr("value")},
                        success: function (img) {

                            croppedimg.croppie('destroy');

                            $("#imgholder").html("<img src='" + img + "?i=" + new Date().getTime() + "' class='img-thumbnail' id='imgthumb'></img>");

                        }
                    })
                }
            },
            beforeSend: function () {
                $("#message_person_info").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                })
            }
        });
    }

    function croppiegen(e) {

        imgChange = true;


        $("<img />", {
            "src": e.target.result,
            "id": "imgthumb"
        }).appendTo($("#imgholder"));

        //Creates image cropper
        var imgcrop = $("#imgthumb").croppie({
            viewport: {
                width: 200,
                height: 200,
                type: 'square'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });
        $("#imgholder").addClass('image-thumbnail');
        imgcrop.croppie('bind', {
            url: e.target.result
        });
        return imgcrop;
    }

//Image preview/cropper
    $("#user_image").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var image_holder = $("#imgholder");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                croppedimg = croppiegen(e);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        }
    });


    //Ajax form submit
    $("#profile_edit1").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        if (imgChange == true) {

            croppedimg.croppie('result', {
                type: 'base64',
                format: 'jpeg',
                quality: '0.85',
                size: {
                    width: 500,
                    height: 500
                }
            }).then(function (userimg) {
                formData.append('user_image', userimg);
                ajaxSend(formData);

            });
        } else {
            ajaxSend(formData);
        }
        return false;
    });
    $("#form_profile_img_update,#form_profile_bg_img_update").on('submit', (function (e) {
        e.preventDefault();
        var formData = new FormData(this),
            btn_id = $(this).find('button:submit').attr('id'),
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
            contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
            cache: false,					// To unable request pages to be cached
            processData: false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
            dataType: 'json',
            success: function (response)  		// A function to be called if request succeeds
            {
                if (response.status == true) {
                    notice.fire({
                        icon: response.stat,
                        title: response.message
                    });
                } else if (response.status == false) {
                    messageBox.html(response.err_message);
                }
                $('#' + btn_id + ' .label').text("Change Image").fadeIn();
            },
            beforeSend: function () {
                $('#' + btn_id).prop('disabled', true);
                $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
            },
            error: function (response) {
                alert(response.err_message);
                $('#' + btn_id + ' .label').text("Change Image").fadeIn();
            }
        });
    }));
    //Ajax form submit
    $("#account_edit").submit(function (e) {

        if ($("#email").val() == $("#emailorig").val()) {
            $("#email").prop("disabled", true);
        }

        e.preventDefault();

        var formData = new FormData(this);

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        $.ajax({
            url: "' . VIEWS_URL . 'user/inc/ajax/accountupdate.php",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                $("#message_account_info").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();
                });

                if (json.status == true) {

                    $("#email").prop("disabled", false);
                    $("#emailorig").prop("disabled", false);
                    $("#emailorig").val($("#email").val());

                } else {

                    $("#email").prop("disabled", false);
                }
            },
            beforeSend: function () {
                $("#message_account_info").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='' . VIEWS_URL . 'login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });
});
