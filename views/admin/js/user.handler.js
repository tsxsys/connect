var url = 'admin/inc/ajax/user.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value');
function getForm(this_id) {
    var user_type = $("#" + this_id).val(),
        ajax_action = $('#' + this_id).attr("data-action");
    if (user_type && ajax_action) {
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                ajax_action: ajax_action,
                user_type: user_type
                // post_id: post_id,post_unique_id: post_unique_id,post_x: x
            },
            success: function (response) {
                $("#build__form").html(response);

            },
            error: function (err) {
                console.log(err);
                alert(err.responseText);
                console.log(err.responseText);
            }
        });
    }
}
function createUser(btn_id, form_id) {
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

    messageBox.empty();
    $.ajax({
        url: url,   	// Url to which the request is send
        type: 'POST',      				// Type of request to be send, called as method
        data: formData, 		// Data sent to server, a set of key/value pairs representing form fields and values
        cache: false,					// To unable request pages to be cached
        contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
        processData: false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
        // dataType: 'json',
        success: function (response_html)  		// A function to be called if request succeeds
        {
            var text = $(response_html).text();
            //Pulls hidden div that includes "true" in the success response
            var response = text.substr(text.length - 4);

            if (response === 'true') {
                $("#create_user_message").html(response_html);
                $('#create_user_form')[0].reset();
                $('#build__form').empty();
            } else {
                console.log('response_html');
                $("#create_user_message").html(response_html);
            }
        },
        beforeSend: function () {
            $('#' + form_id + ' input').prop('disabled', true);
            $('#' + btn_id).prop('disabled', true);
            $('#' + btn_id + ' .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
        },
        complete: function () {
            $('#' + btn_id + ' .label').text(btn_label).fadeIn();
            $('#' + btn_id).prop('disabled', false);
            $('#' + form_id + ' input').prop('disabled', false);
        },
        error: function (response) {
            alert(response.err_message);
        }
    });
}

$(document).ready(function () {

    $("#create_user_submit1").click(function () {

        var firstname = $("#first_name").val();
        var lastname = $("#last_name").val();
        var email = $("#email").val();

        if ((firstname == "") || (lastname == "") || (email == "")) {
            $("#create_user_message").fadeOut(0, function () {
                $(this).html("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Please enter a first & last name and an email address</div>").fadeIn();
            })
        } else {
            $.ajax({
                type: "POST",
                url: "admin/inc/ajax/create.user.php",
                data: "firstname=" + firstname + "&lastname=" + lastname + "&email=" + email,
                success: function (html) {

                    var text = $(html).text();
                    //Pulls hidden div that includes "true" in the success response
                    var response = text.substr(text.length - 4);

                    if (response == 'true') {
                        $("#create_user_message").fadeOut(0, function () {
                            $(this).html(html).fadeIn();
                        })
                        $('#create_user_form')[0].reset();
                    } else {
                        $("#create_user_message").fadeOut(0, function () {
                            $(this).html(html).fadeIn();
                        })
                    }
                    $('input').prop('disabled', false);
                    $('#create_user_submit').prop('disabled', false);
                    $('#create_user_submit .label').text("Submit").fadeIn();
                },
                beforeSend: function () {
                    $('input').prop('disabled', true);
                    $('#create_user_submit').prop('disabled', true);
                    $('#create_user_submit .label').html('<i class="fas fa-spinner fa-pulse"></i> Loading...').fadeIn();
                    // $("#create_user_message").fadeOut(0, function () {
                    //     $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                    // })
                }
            });
        }
        return false;
    });
});
