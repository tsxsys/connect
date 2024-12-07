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
    case '404':
        $title = '404 Page Not Found';
        $pgCss = '';

        $pgJs = '';
        break;

    default:
        $title = '404 Page not found';
}
$page='error-404.page.php';

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
