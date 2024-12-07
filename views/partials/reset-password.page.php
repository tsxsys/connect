<body>

<div class="theme-loader">
    <div class="loader-track">
        <div class="preloader-wrapper">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="auth-box card">
                    <div class="card-block">
                        <div class="row m-b-20">
                            <div class="col-md-12">
                                <div class='text-center' style='padding: 30px'>
                                    <a href='#'><img src='../' . ASSETS_URL . 'img/elements/logo/cl-logo-fl.png'
                                                     width='200px' height='50px' alt=""></a>
                                </div>
                                <h5 class="text-center">Reset Password</h5>
                            </div>
                        </div>
                        <div class="text-center mb-3" id="message"></div>
                        <div class="cl_login">

                            <?php

                            $jwt = $_GET['t'];

                            try {
                                $decoded = Firebase\JWT\JWT::decode($jwt, $conf->jwt_secret, array('HS256'));

                                $email = $decoded->email;
                                $tokenid = $decoded->tokenid;
                                $userid = $decoded->userid;
                                $pw_reset = $decoded->pw_reset;

                                $validToken = Connect\TokenHandler::selectToken($tokenid, $userid, 0);

                                if ($validToken && ($decoded->pw_reset == "true")) {
                                    require "partials/resetform.php";
                                } else {
                                    echo "<br><br><div class='alert alert-danger alert-dismissable'>Invalid or expired token, please resubmit <a href='" . $conf->base_url . "/console/modules/login/forgot-password.php'>forgot password form</a></div><div id='returnVal' style='display:none;'>false</div>";
                                };
                            } catch (Exception $e) {
                                echo "<br><br><div class='alert alert-danger alert-dismissable'>" . $e->getMessage() . "<br>Token failure, try re-sending request <a href='" . $conf->base_url . "/console/modules/login/forgot-password.php'>here</a></div><div id='returnVal' style='display:none;'>false</div>";
                            }
                            ?>

                            <p class="f-w-600 text-right">Back to <a href="index.php">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
