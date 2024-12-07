<?php
require "../../../vendor/autoload.php";
Connect\LoginHandler::logout();

header("location:../../index.php");
