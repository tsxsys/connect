var onStart = $('#onStart'),
    slideInForm = $('#sgh--slideIn-from'),
    slideInFormS = $('#sgh--slideIn-fromS'),
    slideshow = $('#sgh--slideshow'),
    heading = $('#sgh--hd'),
    footer = $('#sgh--ft');


var closeForm = function () {
    onStart.style.display = "block";
    slideInForm.style.display = "none";
    slideInFormS.style.display = "none";
    slideshow.classList.add("sgh--d-none");
    heading.classList.remove("sgh--hd");
    footer.classList.remove("white-1");
};

function openForm() {
    onStart.css({"display": "none"});
    slideInForm.css({"display": "block"});
    slideshow.removeClass("sgh--d-none");
    heading.addClass("sgh--hd");
    footer.addClass("white-1");
}

function openFormStaff() {
    onStart.css({"display": "none"});
    slideInForm.css({"display": "none"});
    slideInFormS.css({"display": "block"});
    slideshow.removeClass("sgh--d-none");
    heading.addClass("sgh--hd");
    footer.addClass("white-1");
}
function openFormClient() {
    onStart.css({"display": "none"});
    slideInForm.css({"display": "block"});
    slideInFormS.css({"display": "none"});
    slideshow.removeClass("sgh--d-none");
    heading.addClass("sgh--hd");
    footer.addClass("white-1");
}

function closeForm() {
    onStart.css({"display": "block"});
    slideInForm.css({"display": "none"});
    slideInFormS.css({"display": "none"});
    slideshow.addClass("sgh--d-none");
    heading.removeClass("sgh--hd");
    footer.removeClass("white-1");
}

$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    } else {
        return decodeURI(results[1]) || 0;
    }
};
var request_url = "../../includes/functions.ajax.inc.php",
    dt = new Date();

// lastActivity = "Accessed with " + platform.name + " v" + platform.version + " on " + platform.os + " at " + dt;
function loginActivity() {
    var dt = new Date(),
        lastActivity = "Accessed with " + platform.name + " v" + platform.version + " on " + platform.os + " at " + dt;
    if (lastActivity && window.this_id_e) {
        $.post(request_url, {
            id_e: window.this_id_e,
            lastActivity: lastActivity
        })
            .done(function (data) {
                console.log(data);
            });
    }
}

function loginCus() { // loginForm is submitted
    'use strict';
    if ($("#loginCusForm")[0].checkValidity()) {
        var username = $('#cusUID').val(), // get username
            password = $('#cusPWD').val(), // get password
            dt = new Date(),
            lastActivity = "Accessed with " + platform.name + " v" + platform.version + " on " + platform.os + " at " + dt;
        if ($('#cusREM').is(':checked')) {
            var remember = "set";
        } else {
            var remember = "unset";
        }
        if (username && password) { // values are not empty
            $('#lgCusLab').hide();
            $('#lgCusLoading').show();

            // $('#resultCus').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post("../../includes/login.c.inc.php", {
                uid: username, pwd: password, remember: remember, lastActivity: lastActivity
            })
                .done(function (data) {
                    if (data === "firstLogin") {
                        window.location = "update.user.php";
                    }
                    if (data === "verify") {
                        console.log(data);
                        $('#resultCus').html("<p><h6>Your account has not been verified! Please click link in your email to verify your account, or <span class='a_href' onclick='requestActivation_1();'>Click here</span> to request a new activation link.</h6></p>");
                        $('#lgCusLab').show();
                        $('#lgCusLoading').hide();
                    }
                    if (data === "success") {
                        window.location = "dashboard.php";
                    }
                    if (data === "disabled") {
                        $('#resultCus').text("Your account is unavailable at this time. Please contact the admin for more info.");
                        $('#lgCusLab').show();
                        $('#lgCusLoading').hide();
                    }
                    if (data === "failed") {
                        $('#resultCus').text("Your User ID or password is incorrect!");
                        $('#lgCusLab').show();
                        $('#lgCusLoading').hide();
                    } else {
                        data = JSON.parse(data);
                        window.location = data[1];
                    }
                    loginActivity();
                });
        }
    }
}

function loginStaff() { // loginForm is submitted
    'use strict';
    if ($("#loginStaffForm")[0].checkValidity()) {
        var username = $('#engUID').val(), // get username
            password = $('#engPWD').val(), // get password
            dt = new Date(),
            lastActivity = "Accessed with " + platform.name + " v" + platform.version + " on " + platform.os + " at " + dt;
        if ($('#engREM').is(':checked')) {
            var remember = "set";
        } else {
            var remember = "unset";
        }

        if (username && password) { // values are not empty
            $('#lgStaffLab').hide();
            $('#lgStaffLoading').show();
            // $('#resultStaff').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post("../../includes/login.s.inc.php", {
                uid: username, pwd: password, remember: remember, lastActivity: lastActivity
            })
                .done(function (data) {
                    console.log(data);
                    if (data === "firstLogin") {
                        window.location = "update.user.php";
                    }
                    if (data === "verify") {
                        $('#resultStaff').html("<p><h6>Your account has not been verified! Please click link in your email to verify your account, or <a href='request.activation.php'>Click here</a> to request a new activation link.</h6></p>");
                        $('#lgStaffLab').show();
                        $('#lgStaffLoading').hide();
                    }
                    if (data === "success") {
                        window.location = "dashboard.php";
                    }
                    if (data === "disabled") {
                        $('#resultStaff').text("Your account is unavailable at this time. Please contact the admin for more info.");
                        $('#lgStaffLab').show();
                        $('#lgStaffLoading').hide();
                    }
                    if (data === "failed") {
                        $('#resultStaff').text("Your User ID or password is incorrect!");
                        $('#lgStaffLab').show();
                        $('#lgStaffLoading').hide();
                    } else {
                        data = JSON.parse(data);
                        window.location = data[1];
                    }

                });
        }
    }
}

function updatePWD() { // updateForm is submitted
    'use strict';
    if ($("#updatePWDForm")[0].checkValidity()) {
        var newPassword = $('#newPWD').val(),
            confirmPassword = $('#confirmPWD').val(),
            field1 = 'aT',
            field2 = 'email',
            field3 = 'hash',
            url = window.location.href;
        if (newPassword && confirmPassword) { // values are not empty
            $('#lgUpLabel').hide();
            $('#lgUpLoading').show();
            // $('#resultUpdate').html("<img class='sgh--loading' src='../img/loader.gif'>");
            if ((url.indexOf('?' + field1 + '=') != -1) && (url.indexOf('&' + field2 + '=') != -1) && (url.indexOf('&' + field3 + '=') != -1)) {
                var email = $.urlParam('email'),
                    hash = $.urlParam('hash');

                $.post("../../includes/set.pwd.inc.php", {
                    email: email, hash: hash,
                    pwdNew: newPassword, pwdConfirm: confirmPassword
                })
                    .done(function (data) {
                        if (data === "success") {
                            window.location = "dashboard.php";
                        }
                        if (data === "failed") {
                            $('#resultUpdate').text("The request could not be completed at this time!");
                            $('#lgUpLabel').show();
                            $('#lgUpLoading').hide();
                        }
                    });
            } else {
                $.post("../../includes/set.pwd.inc.php", {
                    pwdNew: newPassword, pwdConfirm: confirmPassword
                })
                    .done(function (data) {
                        console.log(data);
                        if (data === "success") {
                            window.location = "dashboard.php";
                        }
                        if (data === "Error 00XE0026") {
                            $('#resultUpdate').text("Passwords do not match. Try again");
                            $('#lgUpLabel').show();
                            $('#lgUpLoading').hide();
                        }
                        if (data === "failed") {
                            $('#resultUpdate').text("The request could not be completed at this time!");
                            $('#lgUpLabel').show();
                            $('#lgUpLoading').hide();
                        }
                        if (data === "") {
                            $('#resultUpdate').text("Error!! The request could not be completed at this time!");
                            $('#lgUpLabel').show();
                            $('#lgUpLoading').hide();
                        }
                    });

            }
        }
    }
}

function setForgotPWD() { // updateForm is submitted
    'use strict';
    var newPassword = $('#newPWD').val(); // get username
    var confirmPassword = $('#confirmPWD').val(); // get password
    if (newPassword && confirmPassword) { // values are not empty
        $('#lgUpdate').hide();
        $('#resultUpdate').html("<img class='sgh--loading' src='../img/loader.gif'>");
        $.post("../../includes/set.pwd.inc.php", {
            // uid: username, pwd: password,
            pwdNew: newPassword, pwdConfirm: confirmPassword
        })
            .done(function (data) {
                if (data === "success") {
                    window.location = "dashboard.php";
                }
                if (data === "failed") {
                    $('#resultUpdate').text("The request could not be completed at this time!");
                    $('#lgUpdate').show();
                }
            });
    }
}

function requestActivation() { // activeForm is submitted
    'use strict';
    if ($("#activeForm")[0].checkValidity()) {
        var email = $('#email-cs').val(); // get email
        var username = $('#uid-cs').val(); // get username
        if (email && username) { // values are not empty
            $('#lgActivate').hide();
            $('#resultActivate-bad').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post("../../includes/verifyRq.inc.php", {
                email: email, uid: username
            })
                .done(function (data) {
                    if (data === "success") {
                        $('#resultActivate').html("<div class='animated zoomIn'><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font sgh--text-left'>A new activation link has been sent to " + email + ", please verify your account by clicking on the link in the email!</p><p><a class='btn sgh--btn sgh--btn-default' href='login.client.php'>Login</a></p></div></div></div>");
                        $("#activeForm").hide();
                    } else if (data === "noMatch") {
                        $('#email-cs').focus();
                        $('#resultActivate-bad').text("Your Email or User ID is incorrect!");
                        $('#lgActivate').show();
                    } else if (data === "fail") {
                        $('#resultActivate-bad').text("The request could not be completed at this time!");
                        $('#lgActivate').show();
                    } else {
                        $('#resultActivate-bad').text("The request could not be completed at this time!");
                        $('#lgActivate').show();
                    }
                });
        }
    }
}

function requestActivation_1() { // activeForm is submitted
    'use strict';
    if ($("#loginCusForm")[0].checkValidity()) {
        var username = $('#cusUID').val(), // get username
            password = $('#cusPWD').val(); // get password
        if (username && password) { // values are not empty
            $('#lgCusLab').hide();
            $('#lgCusLoading').show();
            $.post("../../includes/request.activation.inc.php", {
                uid: username, pwd: password
            })
                .done(function (data) {
                    if (data) {
                        $('#resultCus').html("<p><h6>A new activation link has been sent to " + data + ", please verify your account by clicking on the link in the email!</h6></p>");
                        $('#lgCusLab').show();
                        $('#lgCusLoading').hide();
                    }
                });
        }
    }
}

function forgot() { // forgotForm is submitted
    'use strict';
    if ($("#forgotForm")[0].checkValidity()) {
        var email = $('#email-cs').val(); // get email
        var username = $('#uid-cs').val(); // get username
        if (email && username) { // values are not empty
            $('#lgUpLabel').hide();
            $('#lgUpLoading').show();
            // $('#resultForgot-bad').html("<img class='sgh--loading' src='../img/loader.gif'>");
            $.post("../../includes/forgot.inc.php", {
                email: email, uid: username
            })
                .done(function (data) {
                    if (data === "success") {
                        $('#resultForgot').html("<div class='animated zoomIn'><div class='card grey darken-4'><div class='card-content white-text'><div class='card-title teal-text sgh--text-center'>Success</div><p class='sgh--s-font sgh--text-left'>A link to reset your password has been sent to " + email + ", please click on the link in the email to complete your request.</p><p><a class='btn sgh--btn sgh--btn-default' href='login.client.php'>Login</a></p></div></div></div>");
                        $("#forgotForm").hide();
                    } else if (data === "noMatch") {
                        $('#email-cs').focus();
                        $('#resultForgot-bad').text("Your Email or User ID is incorrect!");
                        $('#lgUpLabel').show();
                        $('#lgUpLoading').hide();
                    } else if (data === "fail") {
                        $('#resultForgot-bad').text("The request could not be completed at this time!");
                        $('#lgUpLabel').show();
                        $('#lgUpLoading').hide();
                    } else {
                        $('#resultForgot-bad').text("The request could not be completed at this time!");
                        $('#lgUpLabel').show();
                        $('#lgUpLoading').hide();
                    }
                });
        }
    }
}

function lock() { // loginForm is submitted
    'use strict';
    if ($("#lockForm")[0].checkValidity()) {
        $('#lgLock').hide();
        $('#sgh--load').html("<img class='sgh--loading' src='../img/loader.gif'>");
        var password = $('#lockPWD').val(); // get password
        if (password) { // values are not empty
            $.post("../../includes/lockin.inc.php", {
                pwd: password
            })
                .done(function (data) {
                    console.log(data);
                    if (data === "disabled") {
                        $('#resultLock').text("Your account is unavailable at this time. Please contact the admin for more info.");
                        $('#lgLock').show();
                        $('#sgh--load').hide();
                    } else if (data === "fail") {
                        $('#resultLock').text("Your password is incorrect!");
                        $('#lgLock').show();
                        $('#sgh--load').hide();
                    } else if (data === "login") {
                        window.location = "login.client.php";
                    } else if (data === "success") {
                        var field1 = 'location';
                        var url = window.location.href;
                        if (url.indexOf('?' + field1 + '=') != -1) {
                            var location = $.urlParam('location');
                            window.location = location;
                        } else {
                            window.location = "dashboard.php";
                        }
                    } else {
                        data = JSON.parse(data);
                        window.location = data[1];
                    }
                });
        }
    }
}

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

// Public Site
function loginPublic() { // loginForm is submitted
    'use strict';
    if ($("#publicLoginForm")[0].checkValidity()) {
        var asset = $('#assetID').val(); // get username
        var password = $('#assetPin').val(); // get password
        if (asset && password) { // values are not empty
            $('#lgPublicLab').hide();
            $('#lgPublicLoader').show();
            $.post("../../includes/login.s.inc.php", {
                uid: username, pwd: password
            })
                .done(function (data) {
                    if (data === "firstLogin") {
                        window.location = "update.user.php";
                    } else if (data === "verify") {
                        $('#resultStaff').html("<p><h6>Your account has not been verified! Please click link in your email to verify your account, or <a href='request.activation.php'>Click here</a> to request a new activation link.</h6></p>");
                        $('#lgStaff').show();
                    } else if (data === "success") {
                        window.location = "dashboard.php";
                    } else if (data === "disabled") {
                        $('#resultStaff').text("Your account is unavailable at this time. Please contact the admin for more info.");
                        $('#lgStaff').show();
                    } else if (data === "failed") {
                        $('#resultStaff').text("Your User ID or password is incorrect!");
                        $('#lgStaff').show();
                    }
                });
        }
    }
}

var particles = {
    "particles": {
        "number": {
            "value": 160,
            "density": {
                "enable": true,
                "value_area": 800
            }
        },
        "color": {
            "value": "#ffffff"
        },
        "shape": {
            "type": "circle",
            "stroke": {
                "width": 0,
                "color": "#000000"
            },
            "polygon": {
                "nb_sides": 5
            },
            "image": {
                "src": "img/github.svg",
                "width": 100,
                "height": 100
            }
        },
        "opacity": {
            "value": 1,
            "random": true,
            "anim": {
                "enable": true,
                "speed": 1,
                "opacity_min": 0,
                "sync": false
            }
        },
        "size": {
            "value": 3,
            "random": true,
            "anim": {
                "enable": false,
                "speed": 4,
                "size_min": 0.3,
                "sync": false
            }
        },
        "line_linked": {
            "enable": false,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
        },
        "move": {
            "enable": true,
            "speed": 0.17,
            "direction": "none",
            "random": true,
            "straight": false,
            "out_mode": "out",
            "bounce": false,
            "attract": {
                "enable": false,
                "rotateX": 600,
                "rotateY": 600
            }
        }
    },
    "interactivity": {
        "detect_on": "canvas",
        "events": {
            "onhover": {
                "enable": false,
                "mode": "bubble"
            },
            "onclick": {
                "enable": false,
                "mode": "repulse"
            },
            "resize": false
        },
        "modes": {
            "grab": {
                "distance": 400,
                "line_linked": {
                    "opacity": 1
                }
            },
            "bubble": {
                "distance": 250,
                "size": 0,
                "duration": 2,
                "opacity": 0,
                "speed": 3
            },
            "repulse": {
                "distance": 400,
                "duration": 0.4
            },
            "push": {
                "particles_nb": 4
            },
            "remove": {
                "particles_nb": 2
            }
        }
    },
    "retina_detect": true
};
// particlesJS('particles-js', particles, function() {
//     console.log('callback - particles.js config loaded');
// });
$(document).ready(function () {

});