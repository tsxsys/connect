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
    case 'phonebook':
        $title = 'Telephone List';
        $pgCss ='<link rel="stylesheet" href="' . ASSETS_URL . 'lib/DataTables/datatables.min.css">';

        $pgJs = '<script src="' . ASSETS_URL . 'lib/DataTables/datatables.min.js"></script>
                 <script type="TEXT/javascript" src="js/contacts.handler.js"></script>';
        $page='function-phonebook.page.php';
        break;
    default:
        $title = 'Blank';
        $page='blank.page.php';
}

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';
