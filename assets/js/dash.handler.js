var url = 'inc/ajax/dash.handler.inc.php?csrf_token=' + $('meta[name=\'csrf_token\']').attr('value'),
    monthsArr = [];
monthsArr[0] = "January";
monthsArr[1] = "February";
monthsArr[2] = "March";
monthsArr[3] = "April";
monthsArr[4] = "May";
monthsArr[5] = "June";
monthsArr[6] = "July";
monthsArr[7] = "August";
monthsArr[8] = "September";
monthsArr[9] = "October";
monthsArr[10] = "November";
monthsArr[11] = "December";

$(function () {
    if ($('#announcements_dash_pool').length) {
        getAllDashAnnouncements();
    }
    if ($('#contact_dash_pool').length) {
        getAllDashContacts();
    }
    if ($('#internal_events_dash_pool').length) {
        getAllDashEventsIn();
    }
    if ($('#external_events_dash_pool').length) {
        getAllDashEventsEx();
    }
    if ($('#news_dash_pool').length) {
        getAllDashNews();
    }
});

function getAllDashAnnouncements() {
    var _img_, img_url, list, preview;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            ajax_action: 'getAllDashAnnouncements'
        },
        success: function (data) {
            $("#announcements_dash_pool").empty();
            data = JSON.parse(data);
            if (data.length === 0) {
                list = '<li class="item text-center">No announcements available</li>';
                $(list).appendTo('#announcements_dash_pool');
                $("#announcements_dash_pool_footer").empty();
            } else {
                for (var i = 0; i < data.length; i++) {
                    _img_ = data[i]['announcement_img'];
                    if (_img_ === '' || _img_ === null) {
                        img_url = 'posts/announcement/img/default_announcement.jpg';
                    } else {
                        if (doesFileExist('posts/announcement/img/' + _img_) === false) {
                            img_url = 'posts/announcement/img/default_announcement.jpg';
                        } else {
                            img_url = 'posts/announcement/img/' + _img_;
                        }
                    }
                    list = '<li class="item">\n' +
                        ' <div class="product-img">\n' +
                        '     <img src="' + img_url + '" alt="Product Image" class="img-size-50">\n' +
                        ' </div>\n' +
                        ' <div class="product-info">\n' +
                        '     <a href="post.php?t=view&q=' + data[i]['announcement_id'] + '&qq=' + data[i]['announcement_unique_id'] + '&x=announcement" class="product-title">' + data[i]['announcement_title'] + '\n' +
                        '         <span class="badge badge-warning float-right">Notice</span></a>\n' +
                        '     <span class="product-description">Added on:' + moment(data[i]['date_added']).format("MMM D, YYYY") + '</span>\n' +
                        ' </div>\n' +
                        '</li>';

                    $(list).appendTo('#announcements_dash_pool');
                }
            }
            //result retrieval queries
            //and
            setTimeout(getAllDashAnnouncements, 5000); //call the same function every 1s.
        },
        error: function (err) {
            //error handler
        }
    });
}

function getAllDashContacts() {
    var address, _img_user, img_url, _img_bg, bg_img_url, list;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            ajax_action: 'getAllDashContacts'
        },
        success: function (data) {
            $("#contact_dash_pool").empty();
            data = JSON.parse(data);
            for (var i = 0; i < data.length; i++) {
                _img_user = data[i]['user_image'];
                if (_img_user === '' || _img_user === null) {
                    img_url = 'user/img/avatars/default_avatar.jpg';
                } else {
                    if (doesFileExist('user/img/avatars/' + _img_user) === false) {
                        img_url = 'user/img/avatars/default_avatar.jpg';
                    } else {
                        img_url = 'user/img/avatars/' + _img_user;
                    }
                }
                _img_bg = data[i]['bg_img'];
                if (_img_bg === '' || _img_bg === null) {
                    bg_img_url = 'user/img/profile_bgs/default_bg.png';
                } else {
                    if (doesFileExist('user/img/profile_bgs/' + _img_bg) === false) {
                        bg_img_url = 'user/img/profile_bgs/default_bg.png';
                    } else {
                        bg_img_url = 'user/img/profile_bgs/' + _img_bg;
                    }
                }
                address = data[i]['address_line_1'] + ' ' + data[i]['address_line_2'] + ' ' + data[i]['address_line_3'] + ' ' + data[i]['state'] + ' ' + data[i]['country'];
                list = '<div class="carousel-item">\n' +
                    '<div class="card-widget widget-user">\n' +
                    '    <!-- Add the bg color to the header using any of the bg-* classes -->\n' +
                    '    <div class="widget-user-header text-white"\n' +
                    '         style="background: url(' + bg_img_url + ') center center;">\n' +
                    '        <h3 class="widget-user-username text-right">' + data[i]['full_name'] + '</h3>\n' +
                    '        <h5 class="widget-user-desc text-right">' + data[i]['job_position'] + '</h5>\n' +
                    '    </div>\n' +
                    '    <div class="widget-user-image">\n' +
                    '        <img class="img-circle" src="' + img_url + '" alt="User Avatar">\n' +
                    '    </div>\n' +
                    '    <div class="card-footer">\n' +
                    '        <div class="row">\n' +
                    '<div class="col-sm-6 border-right">\n' +
                    '    <div class="description-block">\n' +
                    '        <h5 class="description-header">' + data[i]['phone'] + '</h5>\n' +
                    '        <span class="description-text">Phone</span>\n' +
                    '    </div>\n' +
                    '    <!-- /.description-block -->\n' +
                    '</div>\n' +
                    '<!-- /.col -->\n' +
                    '<div class="col-sm-6">\n' +
                    '    <div class="description-block">\n' +
                    '        <h5 class="description-header">' + data[i]['dept_name'] + '</h5>\n' +
                    '        <span class="description-text">Department</span>\n' +
                    '    </div>\n' +
                    '    <!-- /.description-block -->\n' +
                    '</div>\n' +
                    '        </div>\n' +
                    '        <!-- /.row -->\n' +
                    '    </div>\n' +
                    '</div>\n' +
                    '                    </div>';

                $(list).appendTo('#contact_dash_pool');
                $('#contact_dash_pool .carousel-item:first-child').addClass('active');
            }
        },
        error: function (err) {
            //error handler
        }
    });
}

function getAllDashEventsIn() {
    var day, month, date, list;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            ajax_action: 'getAllDashEventsIn'
        },
        success: function (data) {
            $("#internal_events_dash_pool").empty();
            data = JSON.parse(data);
            if (data.length === 0) {
                list = '<div class="col-12 text-center">No internal events available</div>';
                $(list).appendTo('#internal_events_dash_pool');
                $("#internal_events_dash_pool_footer").empty();
            } else {
                for (var i = 0; i < data.length; i++) {
                    date = new Date(data[i]['event_date']);
                    day = date.getUTCDate();
                    month = monthsArr[date.getUTCMonth()];
                    list = '<div class="col-md-4 col-sm-6 col-12">\n' +
                        '    <div class="info-box event__box">\n' +
                        '        <div class="info-box-icon">\n' +
                        '<span class="event_day">' + day + '</span>\n' +
                        '<span class="event_month">' + month + '</span>\n' +
                        '        </div>\n' +
                        '        <div class="info-box-content">\n' +
                        '<a href="#">' + data[i]['event_details'] + '</a>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</div>';

                    $(list).appendTo('#internal_events_dash_pool');
                }
            }
        },
        error: function (err) {
            //error handler
        }
    });
}

function getAllDashEventsEx() {
    var day, month, date, list;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            ajax_action: 'getAllDashEventsEx'
        },
        success: function (data) {
            $("#external_events_dash_pool").empty();
            data = JSON.parse(data);
            if (data.length === 0) {
                list = '<div class="col-12 text-center">No internal events available</div>';
                $(list).appendTo('#external_events_dash_pool');
                $("#external_events_dash_pool_footer").empty();
            } else {
                for (var i = 0; i < data.length; i++) {
                    date = new Date(data[i]['event_date']);
                    day = date.getUTCDate();
                    month = monthsArr[date.getUTCMonth()];
                    list = '<div class="col-md-4 col-sm-6 col-12">\n' +
                        '    <div class="info-box event__box">\n' +
                        '        <div class="info-box-icon">\n' +
                        '<span class="event_day">' + day + '</span>\n' +
                        '<span class="event_month">' + month + '</span>\n' +
                        '        </div>\n' +
                        '        <div class="info-box-content">\n' +
                        '<a href="#">' + data[i]['event_details'] + '</a>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</div>';

                    $(list).appendTo('#external_events_dash_pool');
                }
            }
        },
        error: function (err) {
            //error handler
        }
    });
}

/************************
 *** News ***
 ***********************/
function getAllDashNews() {
    var _img_, img_url, list, tile;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            ajax_action: 'getAllDashNews'
        },
        success: function (data) {
            $("#news_dash_pool").empty();
            $("#news_dash_pool_more").empty();
            data = JSON.parse(data);
            if (data.length === 0) {
                tile = '<div class="col-md-12 mb__half">\n' +
                    '                <div class="card ecni_x_nws ecni_x_nws_more no_nws">\n' +
                    '                    <div class="card-body">\n' +
                    '                            <span>No news available</span>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>';

            } else {
                for (var i = 0; i < data.length; i++) {
                    _img_ = data[i]['news_img'];
                    if (_img_ === '' || _img_ === null) {
                        img_url = 'posts/news/img/default_news.jpg';
                    } else {
                        if (doesFileExist('posts/news/img/' + _img_) === false) {
                            img_url = 'posts/news/img/default_news.jpg';
                        } else {
                            img_url = 'posts/news/img/' + _img_;
                        }
                    }
                    list = '<div class="col-md-6">\n' +
                        '    <div class="card ecni_x_nws" style="background-image: url(' + img_url + ');">\n' +
                        '        <div class="card-img-overlay d-flex flex-column justify-content-end">\n' +
                        '            <div class="ecni_x_nws_info">\n' +
                        '              <a href="post.php?t=view&q=' + data[i]['news_id'] + '&qq=' + data[i]['news_unique_id'] + '&x=news" class="card-text text-white pb-2 pt-1">' +
                        '                ' + data[i]['news_title'] + '</a>\n' +
                        '            </div>\n' +
                        '            <span class="ecni_x_time_stamp">' + moment(data[0]['date_added']).format("MMM D, YYYY") + '</span>\n' +
                        '        </div>\n' +
                        '    </div>\n' +
                        '</div>';

                    $(list).appendTo('#news_dash_pool');
                }
                tile = '<div class="col-md-12 mb__half">\n' +
                    '                <div class="card ecni_x_nws ecni_x_nws_more">\n' +
                    '                    <div class="card-body">\n' +
                    '                    <div class="x_nws__div">\n' +
                    '                        <a href="post.php?t=news">\n' +
                    '                            <span>More News</span>\n' +
                    '                        </a>\n' +
                    '                    </div>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '            </div>';
            }
            $("#news_dash_pool_more").html(tile);
        },
        error: function (err) {
            //error handler
        }
    });
}