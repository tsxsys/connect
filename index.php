<?php
$title = 'Home';
define('TITLE ', 'Home');
include "views/misc/pagehead.php";
?>
</head>
<?php

if ($auth->isLoggedIn()) {
    $location = 'views/dash.php';
} else {
    $location = 'views/index.php';
}
header("Location: " . $location);

echo "<footer class='main-footer'>
&copy; " . date("Y") . " " . COMPANY_LABEL . " | All rights reserved |
        Developed by <a href=" . DEV_DOMAIN . " target='_blank'>" . DEV_DOMAIN_LABEL_2 . "</a>
        <div class='float-right d-none d-sm-inline-block'>
            <span><a href='#' class='m-r-10'>Support</a> | <a href='#' class='m-l-10 m-r-10'>Terms of use</a> |
            <a href='#' class='m-l-10'>Privacy Policy</a></span>
        </div>
    </footer>
    </div>
    <!-- jQuery -->
<script src='system/lib/jquery/jquery.min.js'></script>
<!-- Bootstrap 4 -->
<script src='system/lib/bootstrap/js/bootstrap.bundle.min.js'></script>
<!-- AdminLTE App -->
<script src='system/js/adminlte.min.js'></script>";
if (isset($pgJs) && is_string($pgJs)) {
    echo $pgJs;
}
echo "</body>
</html>";
?>

