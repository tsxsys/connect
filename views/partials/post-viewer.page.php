<?php
//require '../inc/func.inc.php';
if (!empty($_REQUEST['q']) && !empty($_REQUEST['qq']) && !empty($_REQUEST['x'])) {
    $post_id = $_GET['q'];
    $post_unique_id = $_GET['qq'];
    $post_type = $_GET['x'];
//    $notice_b_info = (new Connect\Post)->getNoticeboardInfo($post_id, $post_unique_id);
//    $date_published = $notice_b_info['date_published'];
//    $post_title = $notice_b_info['title'];
//    $post_details = $notice_b_info['details'];
//    $date = DateTime::createFromFormat('Y/m/d-H-i-s.00', $notice_b_info2['date_added']);
//    $date_added = $date->format('d-m-Y-H:i:s');

    $appConfig = Connect\AppConfig::pullMultiSettings(array("base_url"));

    if ($post_type == 'announcement') {
        $post_dir = $appConfig["base_url"] . '/console/modules/posts/announcement/img/';
        $post_info = (new Connect\Post)->getAnnouncementInfo($post_id, $post_unique_id);
        if (!empty($post_info)) {
            $post_status = $post_info['announcement_status'];
            $post_title = $post_info['announcement_title'];
            $post_details = $post_info['announcement_details'];
            $post_img_ = $post_info['announcement_img'];
            $post_date = $post_info['date_added'];
            $post_by = $post_info['full_name'];
            if (empty($post_img_)) {
                $post_img = $post_dir.'default_announcement.jpg';
            } else {
                $post_img = $post_dir.$post_info['announcement_img'];
                if (@get_headers($post_img_)[0] == 'HTTP/1.1 404 Not Found') {
                    $post_img = $post_dir.'default_announcement.jpg';
                }
            }

            $post_n_info = (new Connect\Post)->getAnnouncementNextInfo($post_id);
            $post_id_next = $post_n_info['announcement_id'];
            $post_unique_id_next = $post_n_info['announcement_unique_id'];
            $post_n_title = $post_n_info['announcement_title'];
            $post_n_title = truncate($post_n_title,$length=20,$append="&hellip;");
            $post_p_info = (new Connect\Post)->getAnnouncementPrevInfo($post_id);
            $post_id_prev = $post_p_info['announcement_id'];
            $post_unique_id_prev = $post_p_info['announcement_unique_id'];
            $post_p_title = $post_p_info['announcement_title'];
            $post_p_title = truncate($post_p_title,$length=20,$append="&hellip;");
            echo '<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 blog_area single-post-area">
                <div class="posts-list">
                    <div class="single-post row">
                        <div class="col-md-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="' . $post_img . '"
                                     alt="">
                            </div>
                        </div>
                        <div class="col-md-3  col-md-3">
                            <div class="blog_info text-right">
                                <ul class="blog_meta list">
                                    <li>' . $post_by . '<i class="lnr lnr-user"></i></li>
                                    <li>' . $post_date . '<i class="lnr lnr-calendar-full"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 col-md-9 blog_details">
                            <h2>' . $post_title . '</h2>
                                ' . $post_details . '
                        </div>
                    </div>
                    <div class="navigation-area">
                        <div class="row">';
            if (!empty($post_p_info)) {
                echo '<div class="col-6 post__nav nav-left">
                            <div class="thumb">
                                <a href="post.php?t=view&q=' . $post_id_prev . '&qq=' . $post_unique_id_prev . '&x=announcement">
                                    <img class="img-fluid" src="' . ASSETS_URL . 'img/elements/bgs/post/postnavp.jpg" alt="">
                                </a>
                            </div>
                            <div class="arrow">
                                <span class="fas fa-arrow-left"></span>
                            </div>
                            <div class="title">
                                <p>Prev Post</p>
                                <h4>' . $post_p_title . '</h4>
                            </div>
                        </div>';
            }
            if (!empty($post_n_info)) {
                echo '<div class="col-6 post__nav nav-right">                      
                            <div class="title">
                                <p>Next Post</p>
                               <h4>' . $post_n_title . '</h4>
                            </div>
                            
                            <div class="arrow">
                                    <span class="fas fa-arrow-right"></span>
                            </div>
                            <div class="thumb"><a href="post.php?t=view&q=' . $post_id_next . '&qq=' . $post_unique_id_next . '&x=announcement">
                                <img class="img-fluid" src="' . ASSETS_URL . 'img/elements/bgs/post/postnavn.jpg"
                                                 alt=""></a>
                            </div>
                        </div>';
            }
            echo '
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
        } else {
            echo "<script type='text/javascript'> document.location = 'error.php?t=404'; </script>";
        }
    }
    if ($post_type == 'event') {
        $post_info = (new Connect\Post)->getEventInfo($post_id, $post_unique_id);
        if (!empty($post_info)) {
            $post_status = $post_info['event_status'];
            $post_title = $post_info['event_title'];
            $post_details = $post_info['event_details'];
            $post_img = $post_info['event_img'];
            $post_date = $post_info['date_added'];
            $post_by = $post_info['full_name'];

            $post_n_info = (new Connect\Post)->getEventNextInfo($post_id);
            $post_id_next = $post_n_info['event_id'];
            $post_unique_id_next = $post_n_info['event_unique_id'];
            $post_n_title = $post_n_info['event_title'];
            $post_n_title = truncate($post_n_title,$length=20,$append="&hellip;");
            $post_p_info = (new Connect\Post)->getEventPrevInfo($post_id);
            $post_id_prev = $post_p_info['event_id'];
            $post_unique_id_prev = $post_p_info['event_unique_id'];
            $post_p_title = $post_p_info['event_title'];
            $post_p_title = truncate($post_p_title,$length=20,$append="&hellip;");

            echo '<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 blog_area single-post-area">
                <div class="posts-list">
                    <div class="single-post row">
                        <div class="col-md-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="' . $post_img . '"
                                     alt="">
                            </div>
                        </div>
                        <div class="col-md-3  col-md-3">
                            <div class="blog_info text-right">
                                <ul class="blog_meta list">
                                    <li>' . $post_by . '<i class="lnr lnr-user"></i></li>
                                    <li>' . $post_date . '<i class="lnr lnr-calendar-full"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 col-md-9 blog_details">
                            <h2>' . $post_title . '</h2>
                            ' . $post_details . '
                        </div>
                    </div>
                    <div class="navigation-area">
                        <div class="row">';
            if (!empty($post_p_info)) {
                echo '<div class="col-6 post__nav nav-left">
                                <div class="thumb">
                                    <a href="post.php?t=view&q=' . $post_id_prev . '&qq=' . $post_unique_id_prev . '&x=event">
                                        <img class="img-fluid" src="' . ASSETS_URL . 'img/elements/bgs/post/postnavp.jpg" alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <span class="fas fa-arrow-left"></span>
                                </div>
                                <div class="title">
                                    <p>Prev Post</p>
                                    <h4>' . $post_p_title . '</h4>
                                </div>
                            </div>';
            }
            if (!empty($post_n_info)) {
                echo '<div class="col-6 post__nav nav-right">
                                <div class="title">
                                    <p>Next Post</p>
                                    <h4>' . $post_n_title . '</h4>
                                </div>

                                <div class="arrow">
                                    <span class="fas fa-arrow-right"></span>
                                </div>
                                <div class="thumb"><a href="post.php?t=view&q=' . $post_id_next . '&qq=' . $post_unique_id_next . '&x=event">
                                        <img class="img-fluid" src="' . ASSETS_URL . 'img/elements/bgs/post/postnavn.jpg"
                                             alt=""></a>
                                </div>
                            </div>';
            }
            echo '

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
        } else {
            echo "<script type='text/javascript'> document.location = 'error.php?t=404'; </script>";
        }
    }
    if ($post_type == 'news') {
        $post_dir = $appConfig["base_url"] . '/console/modules/posts/news/img/';
        $post_info = (new Connect\Post)->getNewsInfo($post_id, $post_unique_id);
        if (!empty($post_info)) {
            $post_status = $post_info['news_status'];
            $post_title = $post_info['news_title'];
            $post_details = $post_info['news_details'];
            $post_img_ = $post_dir.$post_info['news_img'];
            $post_date = $post_info['date_added'];
            $post_by = $post_info['full_name'];

            if (empty($post_img_)) {
                $post_img = $post_dir.'default_news.jpg';
            } else {
                $post_img = $post_dir.$post_info['news_img'];
                if (@get_headers($post_img_)[0] == 'HTTP/1.1 404 Not Found') {
                    $post_img = $post_dir.'default_news.jpg';
                }
            }

            $post_n_info = (new Connect\Post)->getNewsNextInfo($post_id);
            $post_id_next = $post_n_info['news_id'];
            $post_unique_id_next = $post_n_info['news_unique_id'];
            $post_n_title = $post_n_info['news_title'];
            $post_n_title = truncate($post_n_title,$length=20,$append="&hellip;");
            $post_p_info = (new Connect\Post)->getNewsPrevInfo($post_id);
            $post_id_prev = $post_p_info['news_id'];
            $post_unique_id_prev = $post_p_info['news_unique_id'];
            $post_p_title = $post_p_info['news_title'];
            $post_p_title = truncate($post_p_title,$length=20,$append="&hellip;");

            echo '<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 blog_area single-post-area">
                <div class="posts-list">
                    <div class="single-post row">
                        <div class="col-md-12">
                            <div class="feature-img">
                                <img class="img-fluid" src="' . $post_img . '"
                                     alt="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <ul class="blog_meta list">
                                    <li>' . $post_by . '<i class="lnr lnr-user"></i></li>
                                    <li>' . $post_date . '<i class="lnr lnr-calendar-full"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9 col-md-9 blog_details">
                            <h2>' . $post_title . '</h2>
                            ' . $post_details . '
                        </div>
                    </div>
                    <div class="navigation-area">
                        <div class="row">';
            if (!empty($post_p_info)) {
                echo '<div class="col-6">
<div class="post__nav nav-left">
                                <div class="thumb">
                                    <a href="post.php?t=view&q=' . $post_id_prev . '&qq=' . $post_unique_id_prev . '&x=news">
                                        <img class="img-fluid" src="' . ASSETS_URL . 'img/elements/bgs/post/postnavp.jpg" alt="">
                                    </a>
                                </div>
                                <div class="arrow">
                                    <span class="fas fa-arrow-left"></span>
                                </div>
                                <div class="title">
                                    <p>Prev Post</p>
                                    <h4>' . $post_p_title . '</h4>
                                </div>
                                </div>
                            </div>';
            }
            if (!empty($post_n_info)) {
                echo '<div class="col-6">
<div class="post__nav nav-right">
                                <div class="title">
                                    <p>Next Post</p>
                                    <h4>' . $post_n_title . '</h4>
                                </div>

                                <div class="arrow">
                                    <span class="fas fa-arrow-right"></span>
                                </div>
                                <div class="thumb"><a href="post.php?t=view&q=' . $post_id_next . '&qq=' . $post_unique_id_next . '&x=news">
                                        <img class="img-fluid" src="' . ASSETS_URL . 'img/elements/bgs/post/postnavn.jpg"
                                             alt=""></a>
                                </div>
                                </div>
                            </div>';
            }
            echo '

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>';
        } else {
            echo "<script type='text/javascript'> document.location = 'error.php?t=404'; </script>";
        }
    }
} else {
    echo "<script type='text/javascript'> document.location = 'error.php?t=404'; </script>";
}
