<?php
if (!empty($_REQUEST['q'])) {
    $uid = $_GET['q'];
} else {
    $uid = $_SESSION['uid'];
}

$usr = Connect\UserHandler::pullUserById($uid);
$user_info = (new Connect\Contact)->getAllUserInfo($uid);
$appConfig = Connect\AppConfig::pullMultiSettings(array("base_url", "avatar_dir", "profile_bg_dir","default_avatar","default_bg"));
//Outputs empty user image if no image exists
$user_img = $user_info['user_image'];
$profile_bg_img = $user_info['bg_img'];
$avatar_dir = $appConfig["base_url"] . $appConfig["avatar_dir"];
$bg_dir = $appConfig["base_url"] . $appConfig["profile_bg_dir"];
$default_avatar = "/".$appConfig["default_avatar"];
$default_bg = "/".$appConfig["default_bg"];
$img_path = imgCheck($avatar_dir,$user_img,$default_avatar);
$bg_img_path = imgCheck($bg_dir,$profile_bg_img,$default_bg);
echo '<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
             <div class="card card-widget widget-user shadow-lg">
                    <div class="widget-user-header text-white background__cover"
                         style="background-image: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url(' . $bg_img_path . ');">
                        <h3 class="widget-user-username text-right">' . $user_info['full_name'] . '</h3>
                        <h5 class="widget-user-desc text-right">' . $user_info['job_position'] . '</h5>';
if ($_SESSION['uid'] != $uid) {
    echo '<div class="widget-user-desc widget__desc"><a href="chat.php"><i class="far fa-comment-alt"></i></div></a>';
}
echo '</div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="' . $img_path . '" alt="User Avatar">
                    </div>
                    <div class="card-body box-profile">
                        <div class="row">
                            ';
if ($_SESSION['uid'] == $uid) {
    echo '<div class="col-sm-4 offset-sm-2 mt-2">
            <a href="profile.php?t=edit" class="btn btn-dark-2 btn-block text-bold">Edit</a>
            </div>
            <div class="col-sm-4 mt-2">
                <a href="" class="btn btn-dark-2 btn-block text-bold s_h profile_more_info"
                   data-target="#more_info_panel">More Info</a>
            </div>';
} else {
    echo '<div class="col-sm-4 offset-sm-4 mt-2">
                <a href="" class="btn btn-dark-2 btn-block text-bold s_h profile_more_info"
                   data-target="#more_info_panel">More Info</a>
            </div>';
}
echo '
                            
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">' . $user_info['dept_name'] . '</h5>
                                    <span class="description-text">Department</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">' . $user_info['phone'] . '</h5>
                                    <span class="description-text">Phone</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">' . $user_info['bio'] . '</h5>
                                    <span class="description-text">Bio</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="card-footer s_h_panel" id="more_info_panel">
                        <div class="row mt-3">';

$education = $user_info['education'];
$experience = $user_info['experience'];
$skills = $user_info['skills'];
$notes = $user_info['notes'];
$no_data = 'No Data Found';
if (empty($education)) {
    $education = $no_data;
}
if (empty($experience)) {
    $experience = $no_data;
}
if (empty($skills)) {
    $skills = $no_data;
}
if (empty($notes)) {
    $notes = $no_data;
}

echo '<div class="col-sm-12">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>
                                <p class="text-muted">' . $education . '</p>
                            </div>
                        <div class="col-sm-12">
                                        <strong><i class="far fa-file-alt mr-1"></i> Experience</strong>
                                        <p class="text-muted">' . $experience . '</p>
                                      </div>    
          <div class="col-sm-12">
                                    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                                    <p class="text-muted">' . $skills . '</p>
                                  </div>                            
                <div class="col-sm-12">
                                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                        <p class="text-muted">' . $notes . '</p>
                                      </div>                      
                            </div>
                    </div>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->';

