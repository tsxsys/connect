<?php

//***********************************
//******
//Client Records Page ********
//***********************************
//require '../func.inc.php';

/**
 * @return false|string
 */


try {
    require '../../../../vendor/autoload.php';

    session_start();

    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;
    $user_handler = new Connect\UserHandler;

    $ajax_action = $_POST['ajax_action'];
    if (!array_key_exists('ajax_action', $_POST)) {
        $ajax_action = $_REQUEST['ajax_action'];
    }
    if (isset($ajax_action) && !empty($ajax_action)) {
        /**********************************
         ***  Profile  ***
         **********************************/
        if ($ajax_action == 'validateEmail') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $data = $_POST['email'];
                $validateEmail = $user_handler->validateEmail($data);
                echo json_encode($validateEmail);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAccount') {
            if ($request->valid_token() && $auth->isLoggedIn()) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);

                $conf = Connect\AppConfig::pullMultiSettings(array("password_policy_enforce", "password_min_length"));

                $uid = $_SESSION['u_id'];
                $resp = array();
                $oldpw = Connect\UserData::pullUserPassword($uid);

                try {
                    if (!empty($_POST)) {
                        if (((trim($_POST['password1']) == '' || trim($_POST['password2']) == ''))) {
                            unset($_POST['password1']);
                            unset($_POST['password2']);
                        }

                        if (array_key_exists('password1', $_POST) && array_key_exists('password2', $_POST)) {
                            $pwvalid = Connect\PasswordHandler::validatePolicy($_POST['password1'], $_POST['password2'], $conf["password_policy_enforce"], $conf["password_min_length"]);


                            if ($pwvalid['status'] == true) {
                                $_POST['password'] = Connect\PasswordHandler::encryptPw($_POST['password1']);

                                unset($_POST['password1']);
                                unset($_POST['password2']);
                            } else {
                                unset($_POST['password1']);
                                unset($_POST['password2']);
                                throw new Exception($pwvalid['message']);
                            }
                        }

                        if (array_key_exists('email', $_POST)) {
                            $tryemail = $_POST['email'];

                            if (!filter_var($tryemail, FILTER_VALIDATE_EMAIL) == true) {
                                throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Must provide a valid email address</div><div id=\"returnVal\" style=\"display:none;\">false</div>");
                            } else {
                                //CHECK DATABASE FOR EXISTING EMAIL
                                $emailtaken = Connect\UserHandler::pullUserByEmail($tryemail);

                                if ($emailtaken['email'] == $tryemail) {
                                    //EMAIL EXISTS
                                    throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Email already exists</div>");
                                } else {

                                    //INSERT WITH EMAIL
                                    $upsert = Connect\UserData::upsertAccountInfo($uid, $_POST);
                                }
                            }
                        } elseif (array_key_exists('password', $_POST)) {

                            //INSERT WITHOUT EMAIL
                            $upsert = Connect\UserData::upsertAccountInfo($uid, $_POST);
                        }

                        $upsert = Connect\UserData::upsertAccountInfo($uid, $_POST);

                        if ($upsert == 1) {

                            //SUCCESS
                            $resp['status'] = true;
                            $resp['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes saved!</div>";
                            echo json_encode($resp);
                        } else {
                            throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>No changes saved</div>");
                        }
                    } else {
                        $resp['status'] = false;
                        $resp['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>No changes</div>";
                        echo json_encode($resp);
                    }
                } catch (Exception $e) {
                    $resp['status'] = false;
                    $resp['message'] = $e->getMessage();

                    echo json_encode($resp);
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateProfile') {
            if ($request->valid_token() && $auth->isLoggedIn()) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);

                $conf = Connect\AppConfig::pullMultiSettings(array("base_dir", "base_url", "avatar_dir"));
                $uid = $_SESSION['u_id'];
                $form = $_POST;

                if (array_key_exists('user_image', $form)) {
                    $extension = 'jpg';
                    $imgtarget = $conf["base_dir"] . $conf["avatar_dir"] . "/" . $uid . "." . $extension;
                    $imgurl = $conf["base_url"] . $conf["avatar_dir"] . "/" . $uid . "." . $extension;
                    $form['user_image'] = $imgurl;

                    try {
                        $upsert = Connect\ProfileData::upsertUserInfo($uid, $form);

                        if ($upsert == 1 && array_key_exists('user_image', $form)) {
                            $imgresp = Connect\ImgHandler::putImage($imgtarget, $_POST['user_image']);

                            echo $imgresp;
                        } else {
                            throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Database/image update failed</div>");
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        die();
                    }
                } else {
                    try {
                        $action_ed = Connect\ProfileData::upsertUserInfo($uid, $form);
                        echo json_encode($action_ed);
//                        if ($upsert['executed'] == 1) {
//                            echo $upsert['executed'];
//                        } else {
//                            throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Database update failed</div>");
//                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                        die();
                    }
                }

            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateImg') {
            if ($request->valid_token() && $auth->isLoggedIn()) {
                unset($_POST['ajax_action']);

                $appConfig = Connect\AppConfig::pullMultiSettings(array("base_dir", "base_url", "avatar_dir", "allowed_file_types", "max_upload_size"));
                $uid = $_SESSION['u_id'];
                $form = $_POST;
                $file_uploaded = $_FILES["user_image"];
                $fileName = $file_uploaded["name"]; // The file name with extension
                $fileType = $file_uploaded["type"]; // The type of file it is
                $fileSize = $file_uploaded["size"]; // File size in bytes
                $fileTmpLoc = $file_uploaded["tmp_name"]; // File in the PHP tmp folder
                $fileError = $file_uploaded["error"]; // 0 for false... and 1 for true

                $valid_extensions = explode("; ", $appConfig["allowed_file_types"]);
                $ext = explode(".", $fileName);
                $file_extension = end($ext);
                if ((($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/jpeg"))
                    && in_array($file_extension, $valid_extensions)) {
                    if ($fileSize < $appConfig["max_upload_size"]) {

                        $img_label = "avatar_" . $uid . "." . $file_extension;
                        $img_target_path = $appConfig["base_dir"] . $appConfig["avatar_dir"] . "/" . $img_label;
                        $form['user_image'] = $img_label;

                        try {
                            $upsert = Connect\ProfileData::upsertUserInfo($uid, $form);

                            if ($upsert['action'] == 1 && array_key_exists('user_image', $form)) {
                                $img_resp = Connect\ImgHandler::uploadImage($fileTmpLoc, $img_target_path);
                                echo json_encode($img_resp);
                            } else {
                                throw new Exception('Database/image update failed');
                            }
                        } catch (Exception $e) {
                            $result['message'] = $e->getMessage();
                            error_log($result['message']);
                            echo json_encode($result['message']);
                            die();
                        }
                    } else {
                        $response['status'] = false;
                        $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Size***</div>';
                        echo json_encode($response);
                    }
                } else {
                    $response['status'] = false;
                    $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Type***</div>';
                    echo json_encode($response);
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateBgImg') {
            if ($request->valid_token() && $auth->isLoggedIn()) {
                unset($_POST['ajax_action']);

                $appConfig = Connect\AppConfig::pullMultiSettings(array("base_dir", "base_url", "profile_bg_dir", "allowed_file_types", "max_upload_size"));
                $uid = $_SESSION['u_id'];
                $form = $_POST;
                $file_uploaded = $_FILES["bg_img"];
                $fileName = $file_uploaded["name"]; // The file name with extension
                $fileType = $file_uploaded["type"]; // The type of file it is
                $fileSize = $file_uploaded["size"]; // File size in bytes
                $fileTmpLoc = $file_uploaded["tmp_name"]; // File in the PHP tmp folder
                $fileError = $file_uploaded["error"]; // 0 for false... and 1 for true

                $valid_extensions = explode("; ", $appConfig["allowed_file_types"]);
//                $valid_extensions = array("jpeg", "jpg", "png");
                $ext = explode(".", $fileName);
                $file_extension = end($ext);
                if ((($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/jpeg"))
                    && in_array($file_extension, $valid_extensions)) {
                    if ($fileSize < $appConfig["max_upload_size"]) {

                        $img_label = "bg_" . $uid . "." . $file_extension;
                        $img_target_path = $appConfig["base_dir"] . $appConfig["profile_bg_dir"] . "/" . $img_label;
                        $form['bg_img'] = $img_label;

                        try {
                            $upsert = Connect\ProfileData::upsertUserInfo($uid, $form);

                            if ($upsert['action'] == 1 && array_key_exists('bg_img', $form)) {
                                $img_resp = Connect\ImgHandler::uploadImage($fileTmpLoc, $img_target_path);
                                echo json_encode($img_resp);
                            } else {
                                throw new Exception('Database/image update failed');
                            }
                        } catch (Exception $e) {
                            $result['message'] = $e->getMessage();
                            error_log($result['message']);
                            echo json_encode($result['message']);
                            die();
                        }
                    } else {
                        $response['status'] = false;
                        $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Size***</div>';
                        echo json_encode($response);
                    }
                } else {
                    $response['status'] = false;
                    $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Type***</div>';
                    echo json_encode($response);
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        //new
        if ($ajax_action == 'resetAccountPwd') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $uid = $_POST['request_id'];
                unset($_POST['request_id']);

                $unique_pwd = passwordGenerator();

                /**********************************
                 ***  Fetch User Data             ***
                 **********************************/
                $user_account = Connect\UserHandler::pullUserById($uid);
                $user_info = (new Connect\Contact)->getAllUserInfo($uid);
                $userArr = array(array('firstname'=>$user_info['firstname'], 'lastname'=>$user_info['lastname'], 'email'=>$user_account['email'], 'pw'=>$unique_pwd));
                /**********************************
                 ***  Fetch User Data End  ***
                 **********************************/
                $config = Connect\AppConfig::pullMultiSettings(array("password_policy_enforce", "password_min_length", "signup_thanks", "base_url" ));

                $pwresp = Connect\PasswordHandler::validatePolicy($unique_pwd, $unique_pwd, (bool) $config["password_policy_enforce"], (int) $config["password_min_length"]);


                //Validation passed
                if ($pwresp['status'] == 1) {
                    $action_ed = $user_handler->resetAccountPwd($uid, $unique_pwd);

                    //Success
                    if ($action_ed['status'] == 1) {
                        $action_ed['new_pwd'] = '<div class="alert alert-dark"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h2 class="text__teal2">Success</h2><p>A comfirmation has been sent to the user\'s email. </p><p>Password is '.$unique_pwd.'</p></div><div id="returnVal" style="display:none;">true</div><div id="returnVal" style="display:none;">true</div>';
                        echo json_encode($action_ed);
                        try { //Send verification email
                            $m = new Connect\MailHandler;

                            $m->sendMail($userArr, 'Reset Password');
//                                echo json_encode($m);
                        } catch (Exception $e) {
                            echo $e->getMessage();
//                                echo json_encode($e->getMessage());
                        }
                    } else {
                        //DB Failure
                        Connect\MiscFunctions::mySqlErrors($action_ed);
                    }
                } else {
                    //Password Failure
                    echo $pwresp['message'];
                }

            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAccountPwd') {
            $uid = $_POST['request_id'];
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin() || $uid == $_SESSION['uid'])) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['request_id']);

                $conf = Connect\AppConfig::pullMultiSettings(array("password_policy_enforce", "password_min_length"));
                $resp = array();
                $old_pw = Connect\UserData::pullUserPassword($uid);

                try {
                    if (!empty($_POST)) {
                        if (((trim($_POST['password1']) == '' || trim($_POST['password2']) == ''))) {
                            unset($_POST['password1']);
                            unset($_POST['password2']);
                        }

                        if (array_key_exists('password1', $_POST) && array_key_exists('password2', $_POST)) {
                            $pw_valid = Connect\PasswordHandler::validatePolicy($_POST['password1'], $_POST['password2'], $conf["password_policy_enforce"], $conf["password_min_length"]);


                            if ($pw_valid['status'] == true) {
                                $_POST['password'] = Connect\PasswordHandler::encryptPw($_POST['password1']);

                                unset($_POST['password1']);
                                unset($_POST['password2']);
                            } else {
                                unset($_POST['password1']);
                                unset($_POST['password2']);
                                throw new Exception($pw_valid['message']);
                            }
                        }
                        $action_ed = $user_handler->updateAccount($uid, $_POST);
                        echo json_encode($action_ed);
                    } else {
                        $resp['status'] = false;
                        $resp['stat'] = 'error';
                        $resp['message'] = 'No changes applied';
                        echo json_encode($resp);
                    }
                } catch (Exception $e) {
                    $resp['status'] = false;
                    $resp['message'] = $e->getMessage();

                    echo json_encode($resp);
                }

            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAccountInfo') {
            $uid = $_POST['request_id'];
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin() || $uid == $_SESSION['uid'])) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['request_id']);

                $action_ed = $user_handler->updateAccountInfo($uid, $_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAccountEmail') {
            $uid = $_POST['request_id'];
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin() || $uid == $_SESSION['uid'])) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['request_id']);

                $email_sample = $_POST['email'];

                if (!filter_var($email_sample, FILTER_VALIDATE_EMAIL) == true) {
                    throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Must provide a valid email address</div><div id=\"returnVal\" style=\"display:none;\">false</div>");
                } else {
                    //CHECK DATABASE FOR EXISTING EMAIL
                    $email_taken_check = Connect\UserHandler::pullUserByEmail($email_sample);

                    if ($email_taken_check['email'] == $email_sample) {
                        //EMAIL EXISTS
                        throw new Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Email already exists</div>");
                    } else {
                        $action_ed = $user_handler->updateAccount($uid, $_POST);
                        echo json_encode($action_ed);
                    }
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAccountImg') {
            $uid = $_POST['request_id'];
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin() || $uid == $_SESSION['uid'])) {
                unset($_POST['ajax_action']);
                unset($_POST['request_id']);

                $appConfig = Connect\AppConfig::pullMultiSettings(array("base_dir", "base_url", "avatar_dir", "allowed_file_types", "max_upload_size"));
                $form = $_POST;
                $file_uploaded = $_FILES["user_image"];
                $fileName = $file_uploaded["name"]; // The file name with extension
                $fileType = $file_uploaded["type"]; // The type of file it is
                $fileSize = $file_uploaded["size"]; // File size in bytes
                $fileTmpLoc = $file_uploaded["tmp_name"]; // File in the PHP tmp folder
                $fileError = $file_uploaded["error"]; // 0 for false... and 1 for true

                $valid_extensions = explode("; ", $appConfig["allowed_file_types"]);
                $ext = explode(".", $fileName);
                $file_extension = end($ext);
                if ((($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/jpeg"))
                    && in_array($file_extension, $valid_extensions)) {
                    if ($fileSize < $appConfig["max_upload_size"]) {

                        $img_label = "avatar_" . $uid . "." . $file_extension;
                        $img_target_path = $appConfig["base_dir"] . $appConfig["avatar_dir"] . "/" . $img_label;
                        $form['user_image'] = $img_label;

                        try {
                            $upsert = Connect\ProfileData::upsertUserInfo($uid, $form);

                            if ($upsert['action'] == 1 && array_key_exists('user_image', $form)) {
                                $img_resp = Connect\ImgHandler::uploadImage($fileTmpLoc, $img_target_path);
                                echo json_encode($img_resp);
                            } else {
                                throw new Exception('Database/image update failed');
                            }
                        } catch (Exception $e) {
                            $result['message'] = $e->getMessage();
                            error_log($result['message']);
                            echo json_encode($result['message']);
                            die();
                        }
                    } else {
                        $response['status'] = false;
                        $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Size***</div>';
                        echo json_encode($response);
                    }
                } else {
                    $response['status'] = false;
                    $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Type***</div>';
                    echo json_encode($response);
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAccountBgImg') {
            $uid = $_POST['request_id'];
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin() || $uid == $_SESSION['uid'])) {
                unset($_POST['ajax_action']);
                unset($_POST['request_id']);

                $appConfig = Connect\AppConfig::pullMultiSettings(array("base_dir", "base_url", "profile_bg_dir", "allowed_file_types", "max_upload_size"));
                $form = $_POST;
                $file_uploaded = $_FILES["bg_img"];
                $fileName = $file_uploaded["name"]; // The file name with extension
                $fileType = $file_uploaded["type"]; // The type of file it is
                $fileSize = $file_uploaded["size"]; // File size in bytes
                $fileTmpLoc = $file_uploaded["tmp_name"]; // File in the PHP tmp folder
                $fileError = $file_uploaded["error"]; // 0 for false... and 1 for true

                $valid_extensions = explode("; ", $appConfig["allowed_file_types"]);
//                $valid_extensions = array("jpeg", "jpg", "png");
                $ext = explode(".", $fileName);
                $file_extension = end($ext);
                if ((($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/jpeg"))
                    && in_array($file_extension, $valid_extensions)) {
                    if ($fileSize < $appConfig["max_upload_size"]) {

                        $img_label = "bg_" . $uid . "." . $file_extension;
                        $img_target_path = $appConfig["base_dir"] . $appConfig["profile_bg_dir"] . "/" . $img_label;
                        $form['bg_img'] = $img_label;

                        try {
                            $upsert = Connect\ProfileData::upsertUserInfo($uid, $form);

                            if ($upsert['action'] == 1 && array_key_exists('bg_img', $form)) {
                                $img_resp = Connect\ImgHandler::uploadImage($fileTmpLoc, $img_target_path);
                                echo json_encode($img_resp);
                            } else {
                                throw new Exception('Database/image update failed');
                            }
                        } catch (Exception $e) {
                            $result['message'] = $e->getMessage();
                            error_log($result['message']);
                            echo json_encode($result['message']);
                            die();
                        }
                    } else {
                        $response['status'] = false;
                        $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Size***</div>';
                        echo json_encode($response);
                    }
                } else {
                    $response['status'] = false;
                    $response['err_message'] = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>***Invalid file Type***</div>';
                    echo json_encode($response);
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}
