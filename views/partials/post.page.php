<?php
$announcement_count = (new Connect\Post)->getAnnouncementCount();
$event_count = (new Connect\Post)->getEventCount();
$news_count = (new Connect\Post)->getNewsCount();
$del_post_count = (new Connect\Post)->getDeletedPostCount();


if ($auth->isSuperAdmin() || $auth->hasPermission('Manage Posts')) {
    echo '<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>*</h3>

                        <p>Post</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sticky-note"></i>
                    </div>
                    <a href="post.php?t=add-edit" class="small-box-footer">Create a post <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>'. $announcement_count['count'] .'</h3>

                        <p>Announcements</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                    <a href="post.php?t=announcement-manager" class="small-box-footer">Announcement Manager <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
             
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>'. $event_count['count'] .'</h3>

                        <p>Events</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                    <a href="post.php?t=event-manager" class="small-box-footer">Event Manager <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
    
            <div class="col-lg-4 col-6">
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>'. $news_count['count'] .'</h3>

                        <p>News</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                    <a href="post.php?t=news-manager" class="small-box-footer">News Manager <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>'. $del_post_count['count'] .'</h3>

                        <p>Deleted Post</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-trash"></i>
                    </div>
                    <a href="post.php?t=del-posts" class="small-box-footer">Deleted Posts <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>';
}

