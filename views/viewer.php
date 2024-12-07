<?php
/*********************************************************************
profile.php

Connect's home page

Copyright (c)  2017-2022 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/

include 'connect.inc.php';
// page builder
switch(strtolower($_REQUEST['t'])) {
    case 'pdf':
        $title = 'Document Viewer';
        $pgCss ='';

        $pgJs = '';
        $page='viewer-pdf.page.php';
        break;
    default:
        $title = 'Human Resource';
        $page='hr.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
