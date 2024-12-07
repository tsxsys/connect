<?php

//***********************************
//******
//Client Records Page ********
//***********************************
require '../../../../config/inc/func.inc.php';
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
        if ($ajax_action == 'getUserForm') {
            if ($request->valid_token() && $auth->isLoggedIn()) {
                unset($_POST['ajax_action']);
                $staff_roles = $user_handler->getAllStaffRoles();
                $company_options = $user_handler->getAllCompanyOptions();

//                echo json_encode($staff_roles);
                $user_type = $_POST['user_type'];
                if (isset($user_type) && !empty($user_type)) {
                    switch(strtolower($user_type)) {
                        case 'customer':
                            $form = '<p><i class="fa fa-info-circle"></i> You are creating a customer account</p>
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 col-form-label text-right">First Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="firstname" id="firstname" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 col-form-label text-right">Last Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="lastname" id="lastname" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label text-right">Email *</label>
                                        <div class="col-sm-9">
                                            <input type="email"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="email" id="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="company" class="col-sm-3 col-form-label text-right">Company *</label>
                                        <div class="col-sm-9">
                                            <select class="custom-select form-control form-control-border form-control-sm" name="company"
                                                    id="company">
                                                <option>--SELECT AN OPTION--</option>';
                            $form .= implode("", $company_options);
                            $form .= '</select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 offset-md-4">
                                            <button type="submit" class="btn btn-primary-1 btn-sm btn-block" 
                                                    data-role="form_submit_btn" data-action="createUser"
                                                    id="create_user_submit" onclick="createUser(this.id, form.id)">
                                                    <span class="label">Submit</span>
                                            </button>
                                        </div>
                                    </div>';
                            break;
                        case 'intermediary':
                            $form = '<p><i class="fa fa-info-circle"></i> You are creating an intermediary account</p>
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 col-form-label text-right">First Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="firstname" id="firstname" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 col-form-label text-right">Last Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="lastname" id="lastname" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label text-right">Email *</label>
                                        <div class="col-sm-9">
                                            <input type="email"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="email" id="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 offset-md-4">
                                            <button type="submit" class="btn btn-primary-1 btn-sm btn-block" 
                                                    data-role="form_submit_btn" data-action="createUser"
                                                    id="create_user_submit" onclick="createUser(this.id, form.id)">
                                                    <span class="label">Submit</span>
                                            </button>
                                        </div>
                                    </div>';
                            break;
                        case 'staff':
                            $form = '<p><i class="fa fa-info-circle"></i> You are creating a staff account</p>
                                    <div class="form-group row">
                                        <label for="firstname" class="col-sm-3 col-form-label text-right">First Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="firstname" id="firstname" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lastname" class="col-sm-3 col-form-label text-right">Last Name *</label>
                                        <div class="col-sm-9">
                                            <input type="text"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="lastname" id="lastname" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 col-form-label text-right">Email *</label>
                                        <div class="col-sm-9">
                                            <input type="email"
                                                   class="form-control form-control-border form-control-sm"
                                                   name="email" id="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_type" class="col-sm-3 col-form-label text-right">Role *</label>
                                        <div class="col-sm-9">
                                            <select class="custom-select form-control form-control-border form-control-sm" name="staff_role"
                                                    id="staff_role">
                                                <option>--SELECT AN OPTION--</option>';
                            $form .= implode("", $staff_roles);
                            $form .= '</select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 offset-md-4">
                                            <button type="submit" class="btn btn-primary-1 btn-sm btn-block" 
                                                    data-role="form_submit_btn" data-action="createUser"
                                                    id="create_user_submit" onclick="createUser(this.id, form.id)"><span class="label">Submit</span>
                                            </button>
                                        </div>
                                    </div>';
                            break;
                        default:
                            $form='default form';
                    }
                    echo $form;
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'createUser') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Manage Users'))) {
                unset($_POST['ajax_action']);

                //Pull username, generate new ID and hash password
                $newid = uniqid(rand(), false);
                foreach ($_POST as $key=>$value) {
                    $_POST[$key] = str_replace(' ', '', $value);
                    if ($value == '' ) {
                        throw new Exception('<div class="alert alert-primary-1 alert-dismissible fade show icons-alert"><p>Must enter a first & last name and an email address</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                }
                $user_type = $_POST['user_type'];
                $first = $_POST['firstname'];
                $last = $_POST['lastname'];
                $email = $_POST['email'];

                $name = $first . '' . $last;
                //Username generator
                $username = substr(str_replace(' ', '', strtolower($name)), 0, 8) . rand(1, 99);
                //Password generator
                $unique_pwd = passwordGenerator();

                //Handles encryption
//    $salty = base64_encode($unique_pwd);
//    $pwd = password_hash($unique_pwd, PASSWORD_BCRYPT);
                switch(strtolower($user_type)) {
                    case 'customer':
                        $company = $_POST['company'];
                        $userArr = array(array('id'=>$newid, 'firstname'=>$first, 'lastname'=>$last, 'username'=>$username, 'email'=>$email, 'pw'=>$unique_pwd, 'company'=>$company));
                        break;
                    case 'intermediary':
                        $userArr = array(array('id'=>$newid, 'firstname'=>$first, 'lastname'=>$last, 'username'=>$username, 'email'=>$email, 'pw'=>$unique_pwd));
                        break;
                    case 'staff':
                        $staff_role = $_POST['staff_role'];
                        $userArr = array(array('id'=>$newid, 'firstname'=>$first, 'lastname'=>$last, 'username'=>$username, 'email'=>$email, 'pw'=>$unique_pwd, 'staff_role'=>$staff_role));
                        break;
                    default:
                        $userArr = array(array('id'=>$newid, 'firstname'=>$first, 'lastname'=>$last, 'username'=>$username, 'email'=>$email, 'pw'=>$unique_pwd));
                }

                $config = Connect\AppConfig::pullMultiSettings(array("password_policy_enforce", "password_min_length", "signup_thanks", "base_url" ));

                $pwresp = Connect\PasswordHandler::validatePolicy($unique_pwd, $unique_pwd, (bool) $config["password_policy_enforce"], (int) $config["password_min_length"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                    echo '<div class="alert alert-primary-1 alert-dismissible fade show icons-alert"><p>Must provide a valid email address</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                } else {
                    //Validation passed
                    if (!empty($first) && !empty($last) && !empty($email) && $pwresp['status'] == 1) {
                        $response = $user_handler->createUser($userArr, $user_type);

                        //Success
                        if ($response == 1) {
                            echo '<div class="alert alert-primary-1 alert-dismissible fade show icons-alert"><p>User account has been successfully created for '.$first.'</p><p>Username is '.$username.'</p><p>Password is '.$unique_pwd.'</p><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
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
