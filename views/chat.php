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
// page builder
switch(strtolower($_REQUEST['t'])) {

    case 'chat':
        $title = 'Chat';
        $pgCss ='<link rel="stylesheet" href="' . VIEWS_URL . 'chat/css/chat.css">';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/emojionearea/emojionearea.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'chat/js/chat.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'chat/js/chat.handler.js"></script>';
        $page='chat0.page.php';
        break;
    default:
        $title = 'Chat';
        $pgCss ='<link rel="stylesheet" href="' . VIEWS_URL . 'chat/css/chat.css">';

        $pgJs = '<script type="text/javascript" src="' . ASSETS_URL . 'lib/emojionearea/emojionearea.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'chat/js/chat.js"></script>
                 <script type="TEXT/javascript" src="' . VIEWS_URL . 'chat/js/chat.handler.js"></script>';
        $page='chat.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
