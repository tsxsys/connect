function intervalTrigger() {
    window.setInterval(function(){
        $("#message_config").fadeOut();
    }, 8000);
}

//Ajax form submit

$(document).ready(function (e) {
    function intervalTrigger() {
        window.setInterval(function(){
            $("#message_config").fadeOut();
        }, 8000);
    }
    var trigid = intervalTrigger();


    //Test Email
    $("#submit_test_email").click(function () {

        $.ajax({
            url: "admin/inc/ajax/email_testsettings.php",
            type: "GET",
            data: "t=1&csrf_token="+ $('meta[name="csrf_token"]').attr("value"),
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                $("#message_config").fadeOut(0, function () {

                    if (json.status == 'true') {
                        var alertType = "success";
                    } else {
                        var alertType = "danger";
                    }

                    $(this).html("<div class=\"alert alert-"+alertType+" alert-dismissable\">\
                                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">\
                                    &times;\
                                  </button>"+json.message+"</div>"
                    ).fadeIn();
                });
            },
            beforeSend: function () {

                window.clearInterval(trigid);

                $("#message_config").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });

    //Instantiate empty FormData object
    var formData = new FormData();

    //Detect changes and append changes to FormData
    $("input").change(function(){
        formData.append(this.name, this.value);
    });

    $("select").change(function(){
        formData.append($(this).attr('name'), $(this).val());
    });

    $("textarea").change(function(){
        formData.append(this.name, this.value);
    });
    $(".note-editable.card-block").change(function(){
        formData.append(this.name, this.value);
    });

    //Ajax form submit
    $("#submit_post").click(function (e) {

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        e.preventDefault();

        $.ajax({
            url: "inc/ajax/noticeboard.create.inc.php",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                var trigid = intervalTrigger();

                $("#message_post").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();

                });

            },
            beforeSend: function () {

                $("#message_post").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });
    $("#draft_post").click(function (e) {

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        e.preventDefault();

        $.ajax({
            url: "inc/ajax/noticeboard.draft.inc.php",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                var trigid = intervalTrigger();

                $("#message_post").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();

                });

            },
            beforeSend: function () {

                $("#message_post").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });
    $("#edit_post").click(function (e) {

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        e.preventDefault();

        $.ajax({
            url: "inc/ajax/noticeboard.edit.inc.php",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                var trigid = intervalTrigger();

                $("#message_post").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();

                });

            },
            beforeSend: function () {

                $("#message_post").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });
    $("#publish_post").click(function (e) {

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        e.preventDefault();

        $.ajax({
            url: "inc/ajax/noticeboard.publish.inc.php",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                var trigid = intervalTrigger();

                $("#message_post").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();

                });

            },
            beforeSend: function () {

                $("#message_post").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });
    $("#del_post").click(function (e) {

        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        e.preventDefault();

        $.ajax({
            url: "inc/ajax/noticeboard.edit.inc.php",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (json) {

                var trigid = intervalTrigger();

                $("#message_post").fadeOut(0, function () {
                    $(this).html(json.message).fadeIn();

                });

            },
            beforeSend: function () {

                $("#message_post").fadeOut(0, function () {
                    $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                });
            }
        });
    });
    function announcement_ac(this_id, this_form_id) {
        console.log(this_form_id);
        //Instantiate empty FormData object
        formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));

        //Detect changes and append changes to FormData
        // formData = $("#" + this_form_id).serialize() + '&csrf_token=' + $('meta[name="csrf_token"]').attr("value");

        // formData = $("#" + this_form_id).serializeArray(); // convert form to array
        // $.each(x, function(i, field){
        //     $("#results").append(field.name + ":" + field.value + " ");
        // });
        // formData.push({name: "csrf_token", value: $('meta[name="csrf_token"]').attr("value")});
        'use strict';
        if ($("#" + this_form_id)[0].checkValidity()) {
            let action, url;
            action = $("#" + this_id).attr("data-action");
            if (action === "post_post"){
                url = "inc/ajax/noticeboard.create.inc.php";
            } else if (action === "edit_post"){
                url = "inc/ajax/noticeboard.edit.inc.php?csrf_token="+ $('meta[name="csrf_token"]').attr("value");
            } else if (action === "draft_post"){
                url = "inc/ajax/noticeboard.draft.inc.php?csrf_token="+ $('meta[name="csrf_token"]').attr("value");
            } else if (action === "publish_post"){
                url = "inc/ajax/noticeboard.publish.inc.php?csrf_token="+ $('meta[name="csrf_token"]').attr("value");
            }

            // formData.append("csrf_token", $('meta[name="csrf_token"]').attr("value"));
            console.log(formData + ' '+url);
            // e.preventDefault();

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (json) {

                    var trigid = intervalTrigger();

                    $("#message_post").fadeOut(0, function () {
                        $(this).html(json.message).fadeIn();

                    });

                },
                beforeSend: function () {

                    $("#message_post").fadeOut(0, function () {
                        $(this).html("<p class='text-center'><img src='../login/images/ajax-loader.gif'></p>").fadeIn();
                    });
                }
            });
        }
    }
});
