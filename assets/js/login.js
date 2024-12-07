$(document).ready(function () {
    "use strict";
    $("#submit").click(function () {

        var username = $("#myusername").val(), password = $("#mypassword").val();
        var remember;

        if ($("#remember").is(":checked")){
            remember = 1;
        } else {
            remember = 0;
        }

        if ((username === "") || (password === "")) {
          $("#message").fadeOut(0, function (){
              $(this).html('<div class="alert alert-danger icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-circled"></i></button><p>Please enter a username and a password</p></div>').fadeIn();
        });

        } else {
            $.ajax({
                type: "POST",
                url: "login/ajax/checklogin.php",
                data: {"myusername": username, "mypassword": password, "remember": remember },
                dataType: 'JSON',
                success: function (html) {

                    if (html.response === 'true') {
                       location.reload();
                        return html.username;
                    } else {
                        $("#message").fadeOut(0, function (){
                            $(this).html(html.response).fadeIn();
                        })
                    }
                },
                error: function (textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(errorThrown);
                    $("#message").fadeOut(0, function (){
                        $(this).html('<div class="alert alert-success icons-alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="icofont icofont-close-line-circled"></i></button><p>'+ textStatus.responseText +'</p></div>').fadeIn();

                        // $(this).html("<div class='alert alert-danger'>" + textStatus.responseText + "</div>").fadeIn();
                    })
                },
                beforeSend: function () {
                    $("#message").fadeOut(0, function (){
                        $(this).html("<p class='text-center'><img src='images/ajax-loader.gif'></p>").fadeIn();
                    })
                }
            });
        }
        return false;
    });
});
