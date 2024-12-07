<?php
if (isset($_REQUEST['q']) && !empty($_REQUEST['qq']) && !empty($_REQUEST['x'])) {
$post_id = $_GET['q'];
$post_unique_id = $_GET['qq'];
$post_type = $_GET['x'];
$_SESSION['post_id'] = $post_id;
$_SESSION['post_unique_id'] = $post_unique_id;
$editing = $_SESSION['Editing'] = true;
$card_title = 'Edit post';
$hidden_input = '';
if ($post_type == 'announcement') {
    $post_info = (new Connect\Post)->getAnnouncementInfo($post_id, $post_unique_id);
    $post_status = $post_info['announcement_status'];
}
if ($post_type == 'event') {
    $post_info = (new Connect\Post)->getEventInfo($post_id, $post_unique_id);
    $post_status = $post_info['event_status'];
}
if ($post_type == 'news') {
    $post_info = (new Connect\Post)->getNewsInfo($post_id, $post_unique_id);
    $post_status = $post_info['news_status'];
}
if ($post_status == '0') {
    $post_status_ind = '<span class="badge badge-warning">Draft</span>';
} else {
    $post_status_ind = '<span class="badge badge-success">Live</span>';
}


    echo '<!-- Main content -->
<section class="content" id="editPost">
    <div class="row">
        <div class="col-md-12">
            <div class="card ecni_x card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">' . $card_title . '</h3>
                            <div class="card-tools">
                                ' . $post_status_ind . '
                            </div>
                            </div>
                    <div class="row">
                        <div class="col-12 p-4">
                            <div class="form-group">
                                <label for="post_type">Post Type</label>
                                <select class="custom-select form-control-border x__select" name="post_type"
                                        id="post_type" onchange="getPostForm(this.id)" disabled readonly="">
                                        <option value="' . $post_type . '"> ' . $post_type . '</option>
                                        <option value="announcement">Announcement</option>
                                        <option value="event">Event</option>
                                        <option value="news">News</option>
                                </select>
                            </div>
                        </div>
                    </div>

                
                <!-- /.card-header -->
                <div id="build__post__form"></div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
<!-- /.content -->';

} else {
    $card_title = 'Add a post';
    $btn_label = '<button type="submit" class="btn btn-sm btn-dark" id="submit_post" data-action="post_post" onclick="addPost(this.id, form.id)">Publish</button>';
    $btn_status = '<button type="submit" class="btn btn-sm btn-dark" id="draft_post" data-action="draft_post">Save as draft</button>';
    $post_title = '';
    $post_details = 'Place <em>some</em> <u>text</u> <strong>here</strong>';
    $post_status_ind = '';

    echo '<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ecni_x card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">' . $card_title . '</h3>
                            <div class="card-tools">
                                ' . $post_status_ind . '
                            </div>
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="form-group">
                                <label for="post_type">Post Type</label>
                                <select class="custom-select form-control-border" name="post_type"
                                        id="post_type" onchange="getPostForm(this.id)">
                                    <option>--SELECT AN OPTION--</option>
                                    <option value="announcement">Announcement</option>
                                    <option value="event">Event</option>
                                    <option value="news">News</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div id="build__post__form"></div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
<!-- /.content -->';
}
?>

