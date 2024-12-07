<?php
require '../../../../vendor/autoload.php';
try {
    //Pull username, generate new ID and hash password
    $newid = uniqid(rand(), false);
    $first = str_replace(' ', '', $_POST['firstname']);
    $last = str_replace(' ', '', $_POST['lastname']);
    $email = str_replace(' ', '', $_POST['email']);

    if ($first == '' || $last == '' || $email == '') {
        throw new Exception('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Must enter a first & last name and an email address</div><div id="returnVal" style="display:none;">false</div>');
    }
    $name = $first . '' . $last;
    //Username generator
    $username = substr(str_replace(' ', '', strtolower($name)), 0, 8) . rand(1, 99);
    //Password generator
    $unique_pwd = passwordGenerator();

    //Handles encryption
//    $salty = base64_encode($unique_pwd);
//    $pwd = password_hash($unique_pwd, PASSWORD_BCRYPT);

    $userArr = array(array('id'=>$newid, 'firstname'=>$first, 'lastname'=>$last, 'username'=>$username, 'email'=>$email, 'pw'=>$unique_pwd));

    $config = Connect\AppConfig::pullMultiSettings(array("password_policy_enforce", "password_min_length", "signup_thanks", "base_url" ));

    $pwresp = Connect\PasswordHandler::validatePolicy($unique_pwd, $unique_pwd, (bool) $config["password_policy_enforce"], (int) $config["password_min_length"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Must provide a valid email address</div><div id="returnVal" style="display:none;">false</div>';
    } else {
        //Validation passed
        if (!empty($first) && !empty($last) && !empty($email) && $pwresp['status'] == 1) {
            $a = new Connect\UserHandler;

            $response = $a->createUser($userArr);

            //Success
            if ($response == 1) {
                echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>User account has been successfully created for '.$first.'</p><p>Username is '.$username.'</p><p>Password is '.$unique_pwd.'</p></div><div id="returnVal" style="display:none;">true</div><div id="returnVal" style="display:none;">true</div>';

                try { //Send verification email
                    $m = new Connect\MailHandler;

                    $m->sendMail($userArr, 'Verify');
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                //DB Failure
                Connect\MiscFunctions::mySqlErrors($response);
            }
        } else {
            //Password Failure
            echo $pwresp['message'];
        }
    }
} catch (Exception $x) {
    echo $x->getMessage();
}
