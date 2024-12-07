<?php

if (!empty($_REQUEST['q']) && !empty($_REQUEST['qq'])) {
    $post_id = $_GET['q'];
    $post_unique_id = $_GET['qq'];
    $notice_b_info = (new Connect\Post)->getNoticeboardInfo($post_id, $post_unique_id);
    $date_published = $notice_b_info['date_published'];
    $post_title = $notice_b_info['title'];
    $post_details = $notice_b_info['details'];
//    $date = DateTime::createFromFormat('Y/m/d-H-i-s.00', $notice_b_info2['date_added']);
//    $date_added = $date->format('d-m-Y-H:i:s');

    $notice_b_n_info = (new Connect\Post)->getNoticeboardNextInfo($post_id);
    $post_id_next = $notice_b_n_info['announcement_id'];
    $post_unique_id_next = $notice_b_n_info['unique_id'];
    $notice_b_p_info = (new Connect\Post)->getNoticeboardPrevInfo($post_id);
    $post_id_prev = $notice_b_p_info['announcement_id'];
    $post_unique_id_prev = $notice_b_p_info['unique_id'];
} else {
    header("Location:  noticeboard.php");
}
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-clipboard" aria-hidden="true"></i></h3>

                        <div class="card-tools">
                            <?php if (!empty($notice_b_p_info)){
                                echo '<a href="noticeboard.php?t=view&q='.$post_id_prev.'&qq='.$post_unique_id_prev.'" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>';
                            }
                            if (!empty($notice_b_n_info)){
                                echo '<a href="noticeboard.php?t=view&q='.$post_id_next.'&qq='.$post_unique_id_next.'" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>';
                            }?>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="mailbox-read-info">
                            <h5><?=$post_title?></h5>
                            <h6>From: support@adminlte.io
                                <span class="mailbox-read-time float-right"> <?=$date_published?></span></h6>
                        </div>
                        <div class="mailbox-read-message">
                            <?=$post_details?>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer bg-white">
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li>
                                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>
                                        Sep2014-report.pdf</a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i
                                      class="fas fa-cloud-download-alt"></i></a>
                        </span>
                                </div>
                            </li>
                            <li>
                                <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App
                                        Description.docx</a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i
                                      class="fas fa-cloud-download-alt"></i></a>
                        </span>
                                </div>
                            </li>
                            <li>
                                <span class="mailbox-attachment-icon has-img"><img src="' . ASSETS_URL . 'lib/img/photo1.png"
                                                                                   alt="Attachment"></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>2.67 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i
                                      class="fas fa-cloud-download-alt"></i></a>
                        </span>
                                </div>
                            </li>
                            <li>
                                <span class="mailbox-attachment-icon has-img"><img src="' . ASSETS_URL . 'lib/img/photo2.png"
                                                                                   alt="Attachment"></span>

                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1.9 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i
                                      class="fas fa-cloud-download-alt"></i></a>
                        </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
