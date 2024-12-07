<?php
require '../../../../config/inc/func.inc.php';
try {
    require '../../../../vendor/autoload.php';

    session_start();

    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;
    $user_handler = new Connect\UserHandler;
    $file_manager_handler = new Connect\FileManager;

    $ajax_action = $_POST['ajax_action'];
    if (!array_key_exists('ajax_action', $_POST)) {
        $ajax_action = $_REQUEST['ajax_action'];
    }
    if (!empty($ajax_action)) {

        /**********************************
         ***     ***
         **********************************/
    }
} catch
(Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}
