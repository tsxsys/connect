<?php
/*********************************************************************
dash.php

Connect's home page

Copyright (c)  2017-2099 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/
require_once '../config/config.php';
require_once '../config/inc/func.inc.php';

$title = 'Home | Crestchic Portal';
$pgCss ='<link rel="stylesheet" href="../assets/lib/jqvmap/v1.5.1/jqvmap.min.css"/>';
$pgJs = '<script type="text/javascript" src="../assets/lib/jqvmap/v1.5.1/jquery.vmap.min.js"></script>
         <script type="text/javascript" src="../assets/lib/jqvmap/v1.5.1/maps/jquery.vmap.world.js"></script>
         <script type="text/javascript" src="../assets/js/ts.cl.map.js"></script>
         <script type="text/javascript" src="../assets/js/dash.handler.js"></script>';

// page builder
$page='dash.page.php';

//Render the page.
include PARTIALS_DIR.'header.page.php';
include PARTIALS_DIR . $page;
include PARTIALS_DIR.'footer.page.php';