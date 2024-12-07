<?php
$user_role = 'loginpage';
$title = 'Verify User';
$pgJs = '';
require 'misc/pagehead.php';
?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="<?=$conf->base_url?>" ><?=$conf->site_name?></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <?php
            //Pulls variables from url. Can pass 1 (verified) or 0 (unverified/blocked) into url
            $uid_decoded = base64_decode($_GET['uid']);
            $idarr = array($uid_decoded);
            $uids = json_encode($idarr);

            $userarr = Connect\UserData::userDataPull($uids, 0);

            try {
                //Updates the verify column on user
                $vresponse = Connect\UserHandler::verifyUser($userarr, 1);

                //Success
                if ($vresponse['status'] == true) {
                    echo '<form class="form-signin" action="'.$conf->signin_url.'"><div class="alert alert-success">'.$conf->active_msg.'</div><br><input type="submit" class="btn btn-primary-1 btn-sm text-uppercase" value="Click Here to Log In"></button></form>';

                    //Send verification email
                    $m = new Connect\MailHandler;

                    //SEND MAIL
                    $m->sendMail($userarr, 'Active');
                } else {
                    //Echoes error from MySQL
                    echo $vresponse['message'];
                }
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
            ?>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<?php
include 'footer.php';
?>

