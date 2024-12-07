// Show/Hide Plugin
(function ($) {
        $.fn.ts__showHide = function (options) {

            //default vars for the plugin
            var defaults = {
                animation: 'fade',
                speed: 1000,
                easing: '',
                changeText: 0,
                showText: 'Show',
                hideText: 'Hide',
                addCustomClass: 0,
                customClass: '',
                hideShowDiv: 0
            };
            options = $.extend(defaults, options);

            $(this).click(function () {
                    var toggleType = (options.animation === 'fade' ? 'fadeToggle' : 'slideToggle'),

                        // this var stores which button you've clicked
                        toggleClick = $(this),
                        // this reads the rel attribute of the button to determine which div id to toggle
                        toggleDiv = $(this).attr('data-target'),
                        switchDiv = $(this).attr('data-target') + '_switch';


                    if (options.hideShowDiv === 1) {
                        $(switchDiv).toggleClass("d-none");
                        $(toggleDiv).toggleClass("d-none");
                        $(toggleDiv).is(":visible") ? toggleClick.text(options.showText) : toggleClick.text(options.hideText);

                    } else {

                        // here we toggle show/hide the correct div at the right speed and using which easing effect
                        $(toggleDiv).stop(true, true)[toggleType](options.speed, options.easing, function () {
                            // this only fires once the animation is completed
                            if (options.addCustomClass === 1) {
                                $(toggleDiv).toggleClass(options.customClass);
                            }

                            if (options.changeText === 1) {
                                $(toggleDiv).is(":visible") ?  toggleClick.text(options.hideText) : toggleClick.text(options.showText);
                            }

                        });
                    }


                    return false;

                }
            )
            ;

        };
        // Show/Hide Plugin with inputs
        $.fn.showHideInput = function (options) {

            //default vars for the plugin
            var defaults = {
                animation: '',
                speed: 1000,
                easing: '',
                changeText: 0,
                showText: 'Show',
                hideText: 'Hide',
                addCustomClass: 0,
                customClass: ''

            };
            var options = $.extend(defaults, options);

            $(this).click(function () {
                if (options.animation == 'fadeOut') {
                    $('.toggleDiv').fadeOut(options.speed, options.easing);
                } else {
                    $('.toggleDiv').slideUp(options.speed, options.easing);
                }

                // this var stores which button you've clicked
                var toggleClick = $(this);
                // this reads the rel attribute of the button to determine which div id to toggle
                var toggleDiv = $(this).attr('rel');
                // here we toggle show/hide the correct div at the right speed and using which easing effect
                $(toggleDiv).fadeToggle(options.speed, options.easing, function () {
                    // this only fires once the animation is completed
                    if (options.addCustomClass == 1) {
                        $(toggleDiv).toggleClass(options.customClass);
                    }
                    if (options.changeText == 1) {
                        $(toggleDiv).is(":visible") ? toggleClick.html(options.hideText).addClass(options.hideColour) : toggleClick.html(options.showText).removeClass(options.hideColour);
                    }
                });

                return false;

            });

        };
    }
)
(jQuery);