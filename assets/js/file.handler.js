/*
 * jQuery File Upload Demo
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */
var url = 'hr/inc/ajax/file.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value');

/* global $ */

$(function () {
    'use strict';
    // fileUpload(destination);

});

function fileUpload(destination) {

    $('table tbody.files').empty();
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        // url: 'server/php/'
        url: url
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
    );


    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        // type: 'GET',
        url: $('#fileupload').fileupload('option', 'url'),
        data: {
            ajax_action: 'UploadHandler', destination: destination
        },
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this)
            .fileupload('option', 'done')
            // eslint-disable-next-line new-cap
            .call(this, $.Event('done'), {result: result});
    });
}

function fileDelete(btn, link, destination) {
    // var link = $(this);
    //.
    console.log(link);
    $.ajax({
        type: 'DELETE',
        url: link,
        data: {
            destination: destination
        },
        dataType: 'json',
        success: function () {
            btn.closest('tr').remove();

        }
    });
}

$(document).on('change', '#fileCategory', function () {
    const destination = this.value;
    fileUpload(destination);
});
$(document).on('click', 'button.delete', function (e) {
    e.preventDefault();
    const destination = $('#fileCategory').val();
    fileDelete(this, this.getAttribute('data-url'), destination);

});
$(document).ready(function (e) {
    // var destination = 'training_doc';
    // fileUpload(destination);
    $('#fileCategory').trigger('change');
});

//DEMO
/* global $ */

// $(function () {
//     'use strict';
//
//     // Initialize the jQuery File Upload widget:
//     $('#fileupload').fileupload({
//         // Uncomment the following to send cross-domain cookies:
//         //xhrFields: {withCredentials: true},
//         // url: 'hr/file_server/php/'
//         url:url
//     });
//
//     // Enable iframe cross-domain access via redirect option:
//     $('#fileupload').fileupload(
//         'option',
//         'redirect',
//         window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
//     );
//
//     if (window.location.hostname === 'blueimp.github.io') {
//         // Demo settings:
//         $('#fileupload').fileupload('option', {
//             url: '//jquery-file-upload.appspot.com/',
//             // Enable image resizing, except for Android and Opera,
//             // which actually support image resizing, but fail to
//             // send Blob objects via XHR requests:
//             disableImageResize: /Android(?!.*Chrome)|Opera/.test(
//                 window.navigator.userAgent
//             ),
//             maxFileSize: 999000,
//             acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
//         });
//         // Upload server status check for browsers with CORS support:
//         if ($.support.cors) {
//             $.ajax({
//                 url: '//jquery-file-upload.appspot.com/',
//                 type: 'HEAD'
//             }).fail(function () {
//                 $('<div class="alert alert-danger"></div>')
//                     .text('Upload server currently unavailable - ' + new Date())
//                     .appendTo('#fileupload');
//             });
//         }
//     } else {
//         // Load existing files:
//         $('#fileupload').addClass('fileupload-processing');
//         $.ajax({
//             // Uncomment the following to send cross-domain cookies:
//             //xhrFields: {withCredentials: true},
//             url: $('#fileupload').fileupload('option', 'url'),
//             dataType: 'json',
//             context: $('#fileupload')[0]
//         })
//             .always(function () {
//                 $(this).removeClass('fileupload-processing');
//             })
//             .done(function (result) {
//                 $(this)
//                     .fileupload('option', 'done')
//                     // eslint-disable-next-line new-cap
//                     .call(this, $.Event('done'), { result: result });
//             });
//     }
// });
