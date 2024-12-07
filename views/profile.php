<?php
/*********************************************************************
profile.php

Connect's home page

Copyright (c)  2017-2099 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/

require_once('../config/config.php');
require_once('../config/inc/func.inc.php');

if (!isset($_REQUEST['t'])) {
        $_REQUEST['t'] = '';
    }
switch(strtolower($_REQUEST['t'])) {
    case 'edit-admin':
        $user_role = 'Admin';
        $title = 'Edit Profile';
        $pgJs = '<script type="text/javascript" src="' . VIEWS_URL . 'user/js/account.handler.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'user/js/croppie.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/jquery.validate.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/additional-methods.min.js"></script>';

        $page='profile-edit-admin.page.php';
        break;
    case 'edit':
        $user_role = 'Standard User';
        $title = 'Edit Profile';
        $pgJs = '<script type="text/javascript" src="' . VIEWS_URL . 'user/js/account.handler.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'user/js/croppie.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/jquery.validate.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/additional-methods.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'lib/jquery.password-validation/jquery.password-validation.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.plugin.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.int.js"></script>';

        $page='profile-edit.page.php';
        break;
    case 'profile-v':
        $user_role = 'Standard User';
        $title = 'Profile';
        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'js/sys.plugin.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.int.js"></script>';

        $page='profile.page.php';
        break;
    case 'info':
        $page='page-new.page.php';
        break;
    default:
        $title = 'Profile';
        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'js/sys.plugin.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.int.js"></script>';
        $page='profile.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
