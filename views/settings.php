<?php
/*********************************************************************
settings.php

Connect's settings page

Copyright (c)  2017-2099 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/

require_once('../config/config.php');

// page builder
switch(strtolower($_REQUEST['t'])) {
    case 'users':
        $user_role = 'Admin';
        $title = 'User Management';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                 <link rel="stylesheet" type="text/css" href="' . VIEWS_URL . 'admin/css/usermanagement.css"/>';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/loadingoverlay.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/user.management.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'admin/js/user.verification.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/user.handler.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/jquery.validate.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/additional-methods.min.js"></script>';
        $page='settings.users.page.php';
        break;
    case 'roles':
        $user_role = 'Admin';
        $title = 'Manage Roles';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/loadingoverlay.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/multiselect.min.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'admin/js/role.management.js"></script>';
        $page='settings.roles.page.php';
        break;
    case 'depts':
        $user_role = 'Admin';
        $title = 'Manage Departments';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/loadingoverlay.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/multiselect.min.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'admin/js/dept.management.js"></script>';
        $page='settings.depts.page.php';
        break;
    case 'mail':
        $user_role = 'Admin';
        $title = 'Mail Log';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'admin/js/maillog.js"></script>';
        $page='settings.mail.page.php';
        break;
    case 'software':
        $user_role = 'Admin';
        $title = 'Manage Software';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                    <link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'lib/switchery/switchery.min.css">';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/loadingoverlay.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/multiselect.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'lib/switchery/switchery.min.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'admin/js/settings.handler.js"></script>';
        $page='settings.software.page.php';
        break;
    case 'perms':
        $user_role = 'Superadmin';
        $title = 'Manage Permissions';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                 <link rel="stylesheet" type="text/css" href="' . VIEWS_URL . 'admin/css/permissionmanagement.css"/>';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/loadingoverlay.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'login/js/multiselect.min.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'admin/js/permission.management.js"></script>';
        $page='settings.perms.page.php';
        break;
    case 'config':
        $user_role = 'Superadmin';
        $title = 'Edit Site Configuration';
        $pgJs = '<script src="' . VIEWS_URL . 'admin/js/edit.config.js"></script>
                 <script>
                    $(function () {
                      //ENABLES TOOLTIPS
                      $("[data-toggle=\'tooltip\']").tooltip();
                    })
                    $(document).ready(function() {
                        $("#password_min_length").attr({
                           //"max" : 10,        // substitute your own
                           "min" : 8          // values (or variables) here
                        });
                    });
                 </script>';
        $page='settings.config.page.php';
        break;
    default:
        $title = 'Settings';
        $page='settings.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
