<?php
try {
    require '../../../../vendor/autoload.php';

    session_start();

    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;

    if ($request->valid_token() && $auth->isLoggedIn()) {
        $img = Connect\ProfileData::pullUserFields($_SESSION["uid"], array("user_image"));

        echo $img["user_image"];
    } else {
        throw new Exception("Unauthorized");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
