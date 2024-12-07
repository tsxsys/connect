/******************************************************
 *** STL - Web JS (www.sincetech.co.uk) ***
 *** Copyright 2017-2031 Since Dev Team ***
 *** Licensed under STL | SINCE TECH LTD  ***
 *****************************************************/

function init_IonRangeSlider() {
    if ($('input[name=range]').length) {
        if (($('#rangeTempCFrom').length) && ($('#rangeTempCTo').length)) {
            var from, to;
            if (!$('#rangeTempCFrom').val().trim() === '') {
                from = $('#rangeTempCFrom').val();
            } else {
                from = -20;
            }
            if (!$('#rangeTempCTo').val().trim() === '') {
                to = $('#rangeTempCTo').val();
            } else {
                to = 40;
            }
        }
        $("#range_temperature").ionRangeSlider({
            type: "double",
            min: -50,
            max: 70,
            from: -20,
            to: 40,
            // from_min: 10,
            from_max: 0,
            to_max: 60,
            step: 1,
            keyboard: true,
            postfix: "\u00b0" + "C",
            grid: !0,
            force_edges: !0,
            onStart: function (data) {
                var currentTempRange = data.from + " to " + data.to;
                // console.log(currentTempRange);
                $('#range_tempC').val(currentTempRange);
            },
            onChange: function (data) {
                var currentTempRange = data.from + " to " + data.to;
                // console.log(currentTempRange);
                $('#range_tempC').val(currentTempRange);
            }
        }), $("#range_temperature_2").ionRangeSlider({
            type: "double",
            min: -50,
            max: 70,
            from: from,
            to: to,
            // from_min: 10,
            from_max: 0,
            to_max: 60,
            step: 1,
            keyboard: true,
            postfix: "\u00b0" + "C",
            grid: !0,
            force_edges: !0,
            onStart: function (data) {
                var currentTempRange = data.from + " to " + data.to;
                // console.log(currentTempRange);
                $('#range_tempC').val(currentTempRange);
            },
            onChange: function (data) {
                var currentTempRange = data.from + " to " + data.to;
                // console.log(currentTempRange);
                $('#range_tempC').val(currentTempRange);
            }
        })
    }
}

function init_control() {
    if ($('input.open_xtra:checkbox').length) {
        $("input.open_xtra:checkbox").change(function () {
            var option = "content_option_" + $(this).attr("data-action");
            if ($("." + option).css("display") === "none") {
                // console.log("open1");
                $("." + option).removeClass("sgh--d-none").addClass("sgh--d-block");
                $("." + option).show();
            } else {
                $("." + option).addClass("sgh--d-none").removeClass("sgh--d-block");
                $("." + option).hide();
            }
        });
    }
}

function init_JQVmap1() {
    "undefined" != typeof jQuery.fn.vectorMap && (console.log("init_JQVmap"), $("#world-map-assets").length && $("#world-map-assets").vectorMap({
        map: "world_en",
        backgroundColor: null,
        color: "#ffffff",
        hoverOpacity: .7,
        selectedColor: "#666666",
        enableZoom: !0,
        showTooltip: !0,
        values: contract_data,
        scaleColors: ['#C8EEFF', '#2A3F54'],
        normalizeFunction: "polynomial",
        onRegionClick: function (element, code, region) {
            var contract_q;
            if (typeof contract_q != 'undefined') {
                contract_q = contract_data[code];
            } else {
                contract_q = 0;
            }
            var message = 'You have '
                + contract_q
                + ' asset(s) in '
                + region
                + ' which has the code: '
                + code.toUpperCase();

            $("#asset-map-info").html(message);
        }
    }), $("#usa_map").length && $("#usa_map").vectorMap({
        map: "usa_en",
        backgroundColor: null,
        color: "#ffffff",
        hoverOpacity: .7,
        selectedColor: "#666666",
        enableZoom: !0,
        showTooltip: !0,
        values: contract_data,
        scaleColors: ["#E6F2F0", "#149B7E"],
        normalizeFunction: "polynomial"
    }))
}

function init_SmartWizard() {
    $(function () {

        // Toolbar extra buttons
        var smart_contract_form = $("#smart_contract_form"),
            btnFinish = $('<button></button>').html('<span class="btn-label">Finish</span>')
                .attr({"id": "create_job_submit", "type": "submit", "data-action": "addContract"})
                .addClass('btn btn-primary-1 btn-sm m-0-25')
                .on('click', function () {
                    post_smart_form(this.id, 'smart_contract_form');
                }),
            btnCancel = $('<a></a>').text('Reset')
                .addClass('btn btn-sm btn-danger m-0-25')
                .attr({
                    "data-toggle": "modal",
                    "data-id": "Q1NNIFJFUExBQ0VNRU5MODALU",
                    "data-target": "#Q1NNIFJFUExBQ0VNRU5MODALU"
                }),
            btnCancelConfirm = $('<button></button>').text('Reset')
                .addClass('btn btn-sm btn-danger')
                .on('click', function () {
                    smart_contract_form.smartWizard("reset");
                });


        // Leave step event is used for validating the forms
        smart_contract_form.on("leaveStep", function (e, anchorObject, currentStepIdx, nextStepIdx, stepDirection) {
            // Validate only on forward movement
            if (stepDirection === 'forward') {
                let form = document.getElementById('form_' + (currentStepIdx));
                if (form) {
                    if (!form.checkValidity()) {
                        form.classList.add('was-validated');
                        smart_contract_form.smartWizard("setState", [currentStepIdx], 'error');
                        smart_contract_form.smartWizard('fixHeight');
                        return false;
                    }
                    smart_contract_form.smartWizard("unsetState", [currentStepIdx], 'error');
                }
            }
        });

        // Step show event
        smart_contract_form.on("showStep", function (e, anchorObject, stepIndex, stepDirection, stepPosition) {
            $("#prev-btn").removeClass('disabled').prop('disabled', false);
            $("#next-btn").removeClass('disabled').prop('disabled', false);
            if (stepPosition === 'first') {
                $("#prev-btn").addClass('disabled').prop('disabled', true);
                // $(".sw-toolbar-elm").hide();
            } else if (stepPosition === 'last') {
                $("#next-btn").addClass('disabled').prop('disabled', true);
            } else {
                $("#prev-btn").removeClass('disabled').prop('disabled', false);
                $("#next-btn").removeClass('disabled').prop('disabled', false);
                // $(".sw-toolbar-elm").show();
            }

            // Get step info from Smart Wizard
            let stepInfo = smart_contract_form.smartWizard("getStepInfo");
            $("#sw-current-step").text(stepInfo.currentStep + 1);
            $("#sw-total-step").text(stepInfo.totalSteps);

            if (stepPosition === 'last') {
                $("#btnFinish").prop('disabled', false);
            } else {
                $("#btnFinish").prop('disabled', true);
            }

            // Focus first name
            if (stepIndex === 1) {
                setTimeout(() => {
                    $('#first-name').focus();
                }, 0);
            }
        });

        "undefined" !== typeof jQuery.fn.smartWizard && (console.log("init_SmartWizard"),
            $(".smart_contract_form").length && smart_contract_form.smartWizard({
                selected: 0,
                autoAdjustHeight: true,
                theme: 'dots', // basic, arrows, square, round, dots
                transition: {
                    animation: 'slide'
                },
                style: {
                    btnCss: "btn-primary-1 btn-sm m-0-25"
                },
                toolbar: {
                    showNextButton: true, // show/hide a Next button
                    showPreviousButton: true, // show/hide a Previous button
                    position: 'bottom', // none/ top/ both bottom
                    extraHtml: [btnFinish, btnCancel]
                },
                anchor: {
                    enableNavigation: true, // Enable/Disable anchor navigation
                    enableNavigationAlways: false, // Activates all anchors clickable always
                    enableDoneState: true, // Add done state on visited steps
                    markPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    unDoneOnBackNavigation: true, // While navigate back, done state will be cleared
                    enableDoneStateNavigation: true // Enable/Disable the done state navigation
                },
                // hiddenSteps: [3]
            }),

                $("#state_selector").on("change", function () {
                    smart_contract_form.smartWizard("setState", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
                    return true;
                }),

                $("#style_selector").on("change", function () {
                    smart_contract_form.smartWizard("setStyle", [$('#step_to_style').val()], $(this).val(), !$('#is_reset').prop("checked"));
                    return true;
                }),
                init_select2()
        )

    });

}

// True Code starts here
function init_multiselect() {
    "undefined" !== typeof jQuery.fn.multiselect && (console.log("multiselect"), $(".assign_methods").length && $('#assign_contract_users').multiselect({
            sort: {
                left: function (a, b) {
                    return a.value > b.value ? 1 : -1;
                },
                right: function (a, b) {
                    return a.value > b.value ? -1 : 1;
                }
            },
            search: {
                left: '<input type="text" name="q" class="form-control" autocomplete="off" placeholder="Search users..." />',
                right: '<input type="text" name="q" class="form-control" autocomplete="off" placeholder="Search users..." />'
            },
            fireSearch: function (value) {
                return value.length > 0;
            }
        }),
            $('#assign_contracts').multiselect({
                sort: {
                    left: function (a, b) {
                        return a.value > b.value ? 1 : -1;
                    },
                    right: function (a, b) {
                        return a.value > b.value ? -1 : 1;
                    }
                },
                search: {
                    left: '<input type="text" name="q" class="form-control" autocomplete="off" placeholder="Search contracts..." />',
                    right: '<input type="text" name="q" class="form-control" autocomplete="off" placeholder="Search contracts..." />'
                },
                fireSearch: function (value) {
                    return value.length > 0;
                }
            })
    );
}

function init_select2() {
    "undefined" !== typeof jQuery.fn.select2 && (console.log("select2"), $(".select2").length && $("[id$='address_line_6']").select2({
            placeholder: "Select a country"
        }),
            $('#company_id').select2({
                placeholder: "Select an associated company"
            }),
            $('.select2_default').select2({
                placeholder: "--SELECT AN OPTION--"
            })
    );
}

function init_TagsInput() {
    "undefined" != typeof $.fn.tagsInput && $("#tags_1").tagsInput({width: "auto"})
    "undefined" != typeof $.fn.tagsInput && $("#email_tags").tagsInput({ defaultText:'add a recipient', width: "auto", height: "auto"})
}
$(document).ready(function () {
    if ($('.s_h').length) {
        $('.show_hide').ts__showHide({
            speed: 400, // speed you want the toggle to happen
            easing: '', // the animation effect you want. Remove this line if you dont want an effect and if you haven't included jQuery UI
            changeText: 1, // if you dont want the button text to change, set this to 0
            showText: 'SET PERMISSIONS',// the button text to show when a div is closed
            hideText: 'Close' // the button text to show when a div is open
        });
        $('.profile_more_info').ts__showHide({
            speed: 400,
            easing: '',
            changeText: 1,
            showText: 'More Info',
            hideText: 'Close'
        });
        $('.more__actions_bar').ts__showHide({
            speed: 400,
            easing: '',
            changeText: 1,
            showText: 'More Actions',
            hideText: 'Close'
        });
        $('.reveal__pin').ts__showHide({
            speed: 400,
            easing: '',
            changeText: 1,
            showText: 'Reveal pin',
            hideText: 'Hide pin',
            hideShowDiv: 1
        });

        // Not in use
        // $('#sgh_general_info_a').ts__showHide({
        //     animation: 'fadeOut',
        //     speed: 100, // speed you want the toggle to happen
        //     easing: '', // the animation effect you want. Remove this line if you dont want an effect and if you haven't included jQuery UI
        //     changeText: 1, // if you dont want the button text to change, set this to 0
        //     showText: 'EDIT',// the button text to show when a div is closed
        //     hideText: 'Close', // the button text to show when a div is open
        //     hideShowDiv: 1
        //
        // });
        // $('.show_hide_std').ts__showHide({
        //     animation: 'fadeOut',
        //     speed: 100,
        //     easing: '',
        //     changeText: 1,
        //     showText: 'Edit',
        //     hideText: 'Close'
        // });
        // $('.reset_pass').ts__showHide({
        //     speed: 100,
        //     changeText: 1,
        //     showText: 'RESET PASSWORD',
        //     hideText: 'Close'
        // });
    }
    if ($('audio,video').length) {
        // const player = new Plyr('#player',{
        //     clickToPlay: true
        // });
        const players = Plyr.setup("#player", {
            clickToPlay: true
        });
        $(".ts__video_mod").on("hide.bs.modal", function () {
            players.forEach(function (player) {
                player.stop();
            });

        });
        // const players = Plyr.setup("#player");
        // $("#exampleModal").on("hide.bs.modal",function (){
        //     players.forEach(function(player) {
        //         player.pause();
        //     });
        // });
    }

    init_JQVmap1();
    init_IonRangeSlider();
    init_SmartWizard();
});