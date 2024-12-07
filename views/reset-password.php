<?php
/*********************************************************************
reset-password.php

Connect's Reset Password page

Copyright (c)  2017-2099 SINCE TECH
http://www.sincetech.co.uk/

Released under the GNU General Public License WITHOUT ANY WARRANTY.

$Id: $
 **********************************************************************/
$user_role = 'loginpage';
$title = 'Reset Password | Crestchic Portal';
$pgCss ='<link rel="stylesheet" type="text/css" href="../' . ASSETS_URL . 'build/css/style.css">
         <link rel="stylesheet" type="text/css" href="../' . ASSETS_URL . 'build/css/pages.css">';
$pgJs = '<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/jquery.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/jquery-ui.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/popper.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/bootstrap.min.js"></script>

<script src="../' . ASSETS_URL . 'build/js/waves.min.js" type="4878d7dfa7bc22a8dfa99416-text/javascript"></script>

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/jquery.slimscroll.js"></script>

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/modernizr.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/css-scrollbars.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="../' . ASSETS_URL . 'build/js/common-pages.js"></script>

<script src="../' . ASSETS_URL . 'build/js/rocket-loader.min.js" data-cf-settings="4878d7dfa7bc22a8dfa99416-|49" defer=""></script>

         <script src="js/resetpw.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/additional-methods.min.js"></script>';



// page builder
require '../../../vendor/autoload.php';
//Render the page.
include 'misc/pagehead.php';
include 'partials/reset-password.page.php';
include 'partials/footer.php';
require 'js/ps.validator.js.php';