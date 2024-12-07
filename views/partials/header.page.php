<?php
//require_once('../../config/config.php');
require_once(CONFIG_DIR . 'inc/func.inc.php');
require_once(VIEWS_DIR . "misc/pagehead.php");
echo "</head>";
if ($auth->isLoggedIn()) {
    $username = $_SESSION['username'];
    $uid = $_SESSION['uid'];
    $usr_info = Connect\ProfileData::pullAllUserInfo($uid);
    $user_info = (new Connect\Contact)->getAllUserInfo($uid);
    $appConfig = Connect\AppConfig::pullMultiSettings(array("base_url", "avatar_dir", "profile_bg_dir", "default_avatar", "default_bg"));
//Outputs empty user image if no image exists
    $first_name = $user_info['firstname'];
    $user_img = $user_info['user_image'];
    $profile_bg_img = $user_info['bg_img'];
    $avatar_dir = $appConfig["base_url"] . $appConfig["avatar_dir"];
    $bg_dir = $appConfig["base_url"] . $appConfig["profile_bg_dir"];
    $default_avatar = "/" . $appConfig["default_avatar"];
    $default_bg = "/" . $appConfig["default_bg"];
    $img_path = imgCheck($avatar_dir, $user_img, $default_avatar);
    $bg_img_path = imgCheck($bg_dir, $profile_bg_img, $default_bg);
    echo '<body>

<div class="loader-bg">
    <div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-logo">
                    <a href="dash.php">
                        <img class="img-fluid" src="../assets/img/elements/logo/cl-logo-fl.png" alt="Theme-Logo"/>
                    </a>
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-toggle-right"></i>
                    </a>
                    <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>
                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
<span class="input-group-prepend search-close">
 <i class="feather icon-x input-group-text"></i>
</span>
                                    <input type="text" class="form-control" placeholder="Enter Keyword">
                                    <span class="input-group-append search-btn">
<i class="feather icon-search input-group-text"></i>
</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!"
                               onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()"
                               class="waves-effect waves-light" data-cf-modified-906ddac6b3775a96bb4ff3ff-="">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" id="header__dropdown_1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont icofont-bell-alt"></i>
                                    <span class="badge bg-c-red">5</span>
                                </div>
                                <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn"
                                    data-dropdown-out="fadeOut" aria-labelledby="header__dropdown_1">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="img-radius" src="../assets/img/build-img/jpg/avatar-4.jpg"
                                                 alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="img-radius" src="../assets/img/build-img/jpg/avatar-3.jpg"
                                                 alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="img-radius" src="../assets/img/build-img/jpg/avatar-4.jpg"
                                                 alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                    <i class="feather icon-message-square"></i>
                                    <span class="badge bg-c-green">3</span>
                                </div>
                            </div>
                        </li>
                        <li class="user-profile header-notification">
                            <div class="dropdown-primary dropdown">
                                <div class="dropdown-toggle" data-toggle="dropdown" id="header__dropdown_2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="' . $img_path . '" class="img-radius" alt="User-Profile-Image">
                                    <span>' . $first_name . '</span>
                                    <i class="feather icon-chevron-down"></i>
                                </div>
                                <ul class="show-notification profile-notification dropdown-menu" aria-labelledby="header__dropdown_2"
                                    data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                    <li>
                                        <a href="profile.php">
                                            <i class="icofont icofont-ui-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="settings.php">
                                            <i class="icofont icofont-ui-settings"></i> Settings
                                        </a>
                                    </li>
                                    
                                    <li>
                                        <a href="email-inbox.html">
                                            <i class="icofont icofont-ui-message"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="auth-lock-screen.html">
                                            <i class="icofont icofont-lock"></i> Lock Screen
                                        </a>
                                    </li>
                                    <li>
                                        <a href="' . VIEWS_URL . 'login/func/logout.php">
                                            <i class="icofont icofont-logout"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="sidebar" class="users p-chat-user showChat">
            <div class="had-container">
                <div class="p-fixed users-main">
                    <div class="user-box">
                        <div class="chat-search-box">
                            <a class="back_friendlist">
                                <i class="feather icon-x"></i>
                            </a>
                            <div class="right-icon-control">
                                <div class="input-group input-group-button">
                                    <input type="text" id="search-friends" name="footer-email" class="form-control"
                                           placeholder="Search Friend">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary waves-effect waves-light" type="button"><i
                                                class="feather icon-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-friend-list">
                            <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online"
                                 data-username="Josephin Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius img-radius" src="../assets/img/build-img/jpg/avatar-3.jpg"
                                         alt="Generic placeholder image ">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="chat-header">Josephin Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box waves-effect waves-light" data-id="2" data-status="online"
                                 data-username="Lary Doe">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../assets/img/build-img/jpg/avatar-2.jpg"
                                         alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Lary Doe</div>
                                </div>
                            </div>
                            <div class="media userlist-box waves-effect waves-light" data-id="3" data-status="online"
                                 data-username="Alice">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../assets/img/build-img/jpg/avatar-4.jpg"
                                         alt="Generic placeholder image">
                                    <div class="live-status bg-success"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alice</div>
                                </div>
                            </div>
                            <div class="media userlist-box waves-effect waves-light" data-id="4" data-status="offline"
                                 data-username="Alia">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../assets/img/build-img/jpg/avatar-3.jpg"
                                         alt="Generic placeholder image">
                                    <div class="live-status bg-default"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Alia<small class="d-block text-muted">10 min
                                        ago</small></div>
                                </div>
                            </div>
                            <div class="media userlist-box waves-effect waves-light" data-id="5" data-status="offline"
                                 data-username="Suzen">
                                <a class="media-left" href="#!">
                                    <img class="media-object img-radius" src="../assets/img/build-img/jpg/avatar-2.jpg"
                                         alt="Generic placeholder image">
                                    <div class="live-status bg-default"></div>
                                </a>
                                <div class="media-body">
                                    <div class="f-13 chat-header">Suzen<small class="d-block text-muted">15 min
                                        ago</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="showChat_inner">
            <div class="media chat-inner-header">
                <a class="back_chatBox">
                    <i class="feather icon-x"></i> Josephin Doe
                </a>
            </div>
            <div class="main-friend-chat">
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="../assets/img/build-img/jpg/avatar-2.jpg"
                             alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">Im just looking around. Will you tell me something about yourself?</p>
                        </div>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">Ohh! very nice</p>
                        </div>
                        <p class="chat-time">8:22 a.m.</p>
                    </div>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="../assets/img/build-img/jpg/avatar-2.jpg"
                             alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">can you come with me?</p>
                        </div>
                        <p class="chat-time">8:20 a.m.</p>
                    </div>
                </div>
            </div>
            <div class="chat-reply-box">
                <div class="right-icon-control">
                    <div class="input-group input-group-button">
                        <input type="text" class="form-control" placeholder="Write hear . . ">
                        <div class="input-group-append">
                            <button class="btn btn-primary waves-effect waves-light" type="button"><i
                                    class="feather icon-message-circle"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">

                <nav class="pcoded-navbar">
                    <div class="pcoded-inner-navbar">
                        <ul class="pcoded-item">
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                                    <span class="pcoded-mtext">Navigation</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="dash.php" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext" data-i18n="nav.navigate.main">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="contracts.php" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext" data-i18n="nav.navigate.main">Contracts</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="clients.php" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext" data-i18n="nav.navigate.main">Clients</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="file-manager.php" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext" data-i18n="nav.navigate.main">File Manager</span>
                                        </a>
                                    </li>
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Test</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="index.html" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Test Reports</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="pcoded-hasmenu">
                                        <a href="javascript:void(0)" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Guides</span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <li class="">
                                                <a href="index.html" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Datasheets</span>
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="index.html" class="waves-effect waves-dark">
                                                    <span class="pcoded-mtext">Videos</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="pcoded-content">

                    <div class="page-header card">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="feather icon-sidebar bg-c-red"></i>
                                    <div class="d-inline">
                                        <h5>' . $title . '</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
} else {
    header("Location: index.php");
}