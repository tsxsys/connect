<?php
/*********************************************************************
profile.php

Connect's home page

Copyright (c)  2017-2022 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/

require_once('../config/config.php');
require_once('../config/inc/func.inc.php');

if (!isset($_REQUEST['t'])) {
    $_REQUEST['t'] = '';
}

require_once(VIEWS_URL .'file-manager/inc/ajax/file-manager.class1.php');
require_once(VIEWS_URL .'file-manager/inc/ajax/file-manager.inc.php');

$highlightjs_style = '1';
// page builder
switch(strtolower($_REQUEST['t'])) {
    case 'file-manager':
        $title = 'File Manager';
        $pgCss ='<link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'css/sys.file.manager-light.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/' . $highlightjs_style . '.min.css">
                <link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'build/css/select2.min.css" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
                <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin/>
                <link rel="dns-prefetch" href="https://cdn.jsdelivr.net"/>
                <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin/>
                <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com"/>';

        $pgJs = '<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.13.1/ace.js"></script>
        <script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
        <script type="TEXT/javascript" src="' . VIEWS_URL . 'file-manager/js/file-manager.handler.js"></script>';
        include '' . VIEWS_URL . 'file-manager/js/file-manager.handler.js.php';

        $page='file-manager.page.php';
        break;
    default:
        $title = 'File Manager';
        $pgCss ='<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
                <link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/' . $highlightjs_style . '.min.css">
                <link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'build/css/select2.min.css" />
              
                <link rel="stylesheet" type="text/css" href="' . ASSETS_URL . 'css/sys.file.manager-light.css" />';

        $pgJs = '<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.13.1/ace.js"></script>
        <script type="text/javascript" src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>';
        include '' . VIEWS_URL . 'file-manager/js/file-manager.handler.js.php';
        $page='file-manager.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
