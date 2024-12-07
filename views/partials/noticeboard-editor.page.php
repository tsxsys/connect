<?php
if (isset($_REQUEST['q']) && !empty($_REQUEST['q'])) {
    $post_id = $_GET['q'];
    $post_unique_id = $_GET['qq'];
    $_SESSION['announcement_id'] = $post_id;
    $_SESSION['unique_id'] = $post_unique_id;
    $editing = $_SESSION['Editing'] = true;
    $card_title = 'Edit announcement';
    $btn_label = '<button type="submit" class="btn btn-sm btn-dark" id="edit_post" data-action="edit_post" onclick="">Save changes</button>';
    $hidden_input = '';
    $notice_b_info = (new Connect\Post)->getNoticeboardInfo($post_id, $post_unique_id);
    $post_title = $notice_b_info['title'];
    $post_details = $notice_b_info['details'];
    $post_status = $notice_b_info['status'];
    if ($post_status == '0'){
        $post_status_ind = '<span class="badge badge-warning">Draft</span>';
    }else{
        $post_status_ind = '<span class="badge badge-success">Live</span>';
    }
    if (isset($editing) and $post_status == '0') {
        $btn_status = '<button type="submit" class="btn btn-sm btn-dark" id="publish_post" data-action="publish_post"> <!--onclick="announcement_ac(this.id, form.id)"-->Publish</button>';
    } else {
        $btn_status = '';
    }
//    $date = DateTime::createFromFormat('Y/m/d-H-i-s.00', $notice_b_info2['date_added']);
//    $date_added = $date->format('d-m-Y-H:i:s');
} else {
    $card_title = 'Add an announcement';
    $btn_label = '<button type="submit" class="btn btn-sm btn-dark" id="submit_post" data-action="post_post">Publish</button>';
    $btn_status = '<button type="submit" class="btn btn-sm btn-dark" id="draft_post" data-action="draft_post">Save as draft</button>';
    $post_title = '';
    $post_details = 'Place <em>some</em> <u>text</u> <strong>here</strong>';
    $post_status_ind = '';
}
//function generateRandomString($length) {
//    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
//}
//$postArray = array(
//    "dog" => "cat"
//);
//$unique_id = generateRandomString(10);
//$date_added = date('d-m-Y h:i:s a', time());
//$add_by = $_SESSION['uid'];
//$postArray = array_merge($postArray, array("unique_id" => $unique_id, 'date_added' => $date_added, 'add_by' => $add_by, 'status' => '0'));
//$columns = array_keys($postArray);
//$values = array_values($postArray);
?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ecni_x card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><?= $card_title ?></h3>
                    <div class="card-tools">
                        <?php echo $post_status_ind; ?>
                    </div>
                </div>
                <!-- /.card-header -->
                <form role="form" method="post" id="form_post">
                    <div class="card-body">
                        <div class='form-group'>
                            <label for='nb_title'>Announcement Title</label>
                            <input name='title' id='nb_title' class='form-control form-control-border form-control-sm'
                                   value='<?= $post_title ?>'>
                        </div>
                        <div class='form-group'>
                            <label for='nb_details'>Announcement Details</label>
                            <textarea name='details' id='nb_details'
                                      class='form-control form-control-border form-control-sm'>
                                    <?php
                                    echo $post_details;
                                    ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div id="message_post"></div>
                                <div class="text-center">
                                    <?php
                                    echo $btn_label;
                                    echo $btn_status;
                                    ?>
                                    <a href="noticeboard.php" class="btn btn-sm btn-dark" id="submit_cancel">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.col-->
    </div>
</section>
<!-- /.content -->
