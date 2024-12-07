<?php
/*********************************************************************
index.php

Connect's Login page

Copyright (c)  2017-2099 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/
$user_role = 'loginpage';
$title = 'Login | Crestchic Portal';
$pgCss ='<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
         <link rel="stylesheet" type="text/css" href="../assets/css/pages.css">';
$pgJs = '<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/jquery-ui.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/popper.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/bootstrap.min.js"></script>

<script src="../assets/js/waves.min.js" type="4878d7dfa7bc22a8dfa99416-text/javascript"></script>

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/jquery.slimscroll.js"></script>

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/modernizr.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/css-scrollbars.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../assets/js/common-pages.js"></script>

<script src="../assets/js/rocket-loader.min.js" data-cf-settings="4878d7dfa7bc22a8dfa99416-|49" defer=""></script>
         <script src="../assets/js/login.js"></script>';



// page builder
//Render the page.
include 'misc/pagehead.php';
include 'partials/login.page.php';
include 'partials/public.footer.php';