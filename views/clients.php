<?php
/*********************************************************************
clients.php

Connect's client's page

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

// page builder
switch(strtolower($_REQUEST['t'])) {

    case 'view-companies':
        $user_role = 'Contract Manager';
        $title = 'Manage Companies';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                 <link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'build/css/select2.min.css" />';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'build/js/select2.full.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'build/js/multiselect.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.int.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'clients/js/client.handler.js"></script>';
        $page='clients-company-list.page.php';
        break;
    case 'add-company':

    case 'view-customers':
        $user_role = 'Contract Manager';
        $title = 'Manage Customers';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                 <link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'build/css/select2.min.css" />';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'build/js/select2.full.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'build/js/multiselect.min.js"></script>
                 <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.int.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'clients/js/client.handler.js"></script>';
        $page='clients-customer-list.page.php';
        break;

    case 'view-intermediaries':
        $user_role = 'Contract Manager';
        $title = 'Manage Intermediaries';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">';

    $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
             <script type="text/javascript" src="' . ASSETS_URL . 'build/js/select2.full.min.js"></script>
             <script type="text/javascript" src="' . ASSETS_URL . 'build/js/multiselect.min.js"></script>
             <script type="text/javascript" src="' . ASSETS_URL . 'js/sys.int.js"></script>
             <script type="text/javascript" src="' . VIEWS_URL . 'clients/js/client.handler.js"></script>';
        $page='clients-intermediary-list.page.php';
        break;
    case 'add-client':
        $user_role = 'Contract Manager';
        $title = 'Client Management';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                 <link rel="stylesheet" type="text/css" href="' . VIEWS_URL . 'admin/css/usermanagement.css"/>';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="text/javascript"  src="' . ASSETS_URL . 'js/loadingoverlay.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/user.management.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/user.verification.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/user.handler.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/jquery.validate.min.js"></script>
                 <script type="text/javascript" src="' . VIEWS_URL . 'admin/js/additional-methods.min.js"></script>';
        $page='clients-add.page.php';
        break;

        default:
        $title = 'Client Manager';
        $page='clients.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
