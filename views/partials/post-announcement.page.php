<?php

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


    if ($post_type == 'announcement') {
        $post_info = (new Connect\Post)->getAnnouncementInfo($post_id, $post_unique_id);
        if (!empty($post_info)) {
            $post_status = $post_info['announcement_status'];
            $post_title = $post_info['announcement_title'];
            $post_details = $post_info['announcement_details'];
            $post_img = $post_info['announcement_img'];
            $post_date = $post_info['date_added'];
            $post_by = $post_info['full_name'];

            $post_n_info = (new Connect\Post)->getAnnouncementNextInfo($post_id);
            $post_id_next = $post_n_info['announcement_id'];
            $post_unique_id_next = $post_n_info['announcement_unique_id'];
            $post_n_title = $post_n_info['announcement_title'];
            $post_p_info = (new Connect\Post)->getAnnouncementPrevInfo($post_id);
            $post_id_prev = $post_p_info['announcement_id'];
            $post_unique_id_prev = $post_p_info['announcement_unique_id'];
            $post_p_title = $post_p_info['announcement_title'];

            echo '<section class="content">
    <div class="container-fluid">
    <article class="row blog_item">
<div class="col-md-3">
<div class="blog_info text-right">
<div class="post_tag">
<a href="#">Food,</a>
<a class="active" href="#">Technology,</a>
<a href="#">Politics,</a>
<a href="#">Lifestyle</a>
</div>
<ul class="blog_meta list">
<li><a href="#">Mark wiens<i class="lnr lnr-user"></i></a></li>
<li><a href="#">12 Dec, 2017<i class="lnr lnr-calendar-full"></i></a></li>
<li><a href="#">1.2M Views<i class="lnr lnr-eye"></i></a></li>
<li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>
</ul>
</div>
</div>
<div class="col-md-9">
<div class="blog_post">
<img src="' . ASSETS_URL . 'img/elements/bgs/post/post1.jpg" alt="">
<div class="blog_details">
<a href="single-blog.html"><h2>Astronomy Binoculars A Great Alternative</h2></a>
<p>MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.</p>
<a href="single-blog.html" class="white_bg_btn">View More</a>
</div>
</div>
</div>
</article>
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
                echo '<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
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
                echo '<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">                      
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
            $post_p_info = (new Connect\Post)->getEventPrevInfo($post_id);
            $post_id_prev = $post_p_info['event_id'];
            $post_unique_id_prev = $post_p_info['event_unique_id'];
            $post_p_title = $post_p_info['event_title'];

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
                echo '<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
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
                echo '<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
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
        $post_info = (new Connect\Post)->getNewsInfo($post_id, $post_unique_id);
        if (!empty($post_info)) {
            $post_status = $post_info['news_status'];
            $post_title = $post_info['news_title'];
            $post_details = $post_info['news_details'];
            $post_img = $post_info['news_img'];
            $post_date = $post_info['date_added'];
            $post_by = $post_info['full_name'];

            $post_n_info = (new Connect\Post)->getNewsNextInfo($post_id);
            $post_id_next = $post_n_info['news_id'];
            $post_unique_id_next = $post_n_info['news_unique_id'];
            $post_n_title = $post_n_info['news_title'];
            $post_p_info = (new Connect\Post)->getNewsPrevInfo($post_id);
            $post_id_prev = $post_p_info['news_id'];
            $post_unique_id_prev = $post_p_info['news_unique_id'];
            $post_p_title = $post_p_info['news_title'];

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
                echo '<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
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
                            </div>';
            }
            if (!empty($post_n_info)) {
                echo '<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
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
