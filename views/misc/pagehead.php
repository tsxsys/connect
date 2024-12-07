<?php
/**
* Require this at the top of every page
* This is the master page that includes
* all other controls and classes
**/
try {
    require dirname(dirname(__DIR__))."/vendor/autoload.php";

    if (!isset($user_role)) {
        $user_role = null;

        if (!isset($title)) {
            $title = 'Page';
        }
    }
    if (!isset($pgCss)) {
        $pgCss = null;
    }

    /**
    * The $conf object's class extends AppConfig, so Connect\AppConfig variables can be pulled from it
    **/
    $auth = new Connect\AuthorizationHandler;
    $conf = new Connect\PageConstructor($auth);

    if (!isset($_SESSION)) {
        session_start();
        date_default_timezone_set($conf->timezone);
    }

    //Builds page head and returns CSRF token object
    $csrf = $conf->buildHead($user_role, $title, $pgCss);

    //Checks for cookie
    if (isset($_COOKIE['usertoken'])) {
        include_once($conf->base_dir.'/views/login/ajax/cookiedecode.php');
    }
} catch (Exception $ex) {
    die($ex->getMessage());
}
