<?php
$reset_template = <<<RESETEMAIL
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style type="text/css">

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode:bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],  /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }
        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }
        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style type="text/css">

        .primary{
            background: #c5092c;
        }
        .bg_white{
            background: #ffffff;
        }
        .bg_light{
            background: #fafafa;
        }
        .bg_black{
            background: #000000;
        }
        .bg_dark{
            background: rgba(0,0,0,.8);
        }
        .email-section{
            padding:2.5em;
        }

        /*BUTTON*/
        .btn{
            padding: 10px 15px;
            display: inline-block;
        }
        .btn.btn-primary{
            border-radius: 5px;
            background: #c5092c;
            color: #ffffff;
        }
        .btn.btn-white{
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }
        .btn.btn-white-outline{
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }
        .btn.btn-black-outline{
            border-radius: 0px;
            background: transparent;
            border: 2px solid #000;
            color: #000;
            font-weight: 700;
        }

        h1,h2,h3,h4,h5,h6{
            font-family: 'Lato', sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }

        body{
            font-family: 'Lato', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0,0,0,.4);
        }

        a{
            color: #c5092c;
        }

        table{
        }
        /*LOGO*/

        .logo h1{
            margin: 0;
        }
        .logo h1 a{
            color: #c5092c;
            font-size: 24px;
            font-weight: 700;
            font-family: 'Lato', sans-serif;
        }

        /*HERO*/
        .hero{
            position: relative;
            z-index: 0;
        }

        .hero .text{
            color: rgba(0,0,0,.3);
        }
        .hero .text h2{
            color: #000;
            font-size: 40px;
            margin-bottom: 0;
            font-weight: 400;
            line-height: 1.4;
        }
        .hero .text h3{
            font-size: 24px;
            font-weight: 300;
        }
        .hero .text h2 span{
            font-weight: 600;
            color: #c5092c;
        }


        /*HEADING SECTION*/
        .heading-section{
        }
        .heading-section h2{
            color: #000000;
            font-size: 28px;
            margin-top: 0;
            line-height: 1.4;
            font-weight: 400;
        }
        .heading-section .subheading{
            margin-bottom: 20px !important;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(0,0,0,.4);
            position: relative;
        }
        .heading-section .subheading::after{
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            content: '';
            width: 100%;
            height: 2px;
            background: #c5092c;
            margin: 0 auto;
        }

        .heading-section-white{
            color: rgba(255,255,255,.8);
        }
        .heading-section-white h2{
            font-family:
            line-height: 1;
            padding-bottom: 0;
        }
        .heading-section-white h2{
            color: #ffffff;
        }
        .heading-section-white .subheading{
            margin-bottom: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,.4);
        }


        ul.social{
            padding: 0;
        }
        ul.social li{
            display: inline-block;
            margin-right: 10px;
        }

        /*FOOTER*/

        .footer{
            border-top: 1px solid rgba(0,0,0,.05);
            color: rgba(0,0,0,.5);
        }
        .footer .heading{
            color: #000;
            font-size: 20px;
        }
        .footer ul{
            margin: 0;
            padding: 0;
        }
        .footer ul li{
            list-style: none;
            margin-bottom: 10px;
        }
        .footer ul li a{
            color: rgba(0,0,0,1);
        }


        @media screen and (max-width: 500px) {


        }


    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center;">
                                <h1><a href="#">$this->site_name</a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
                    <img src="data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfNSIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNjQgNjQiIGhlaWdodD0iNTEyIiB2aWV3Qm94PSIwIDAgNjQgNjQiIHdpZHRoPSI1MTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxsaW5lYXJHcmFkaWVudCBpZD0iU1ZHSURfMV8iIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIiB4MT0iMzIiIHgyPSIzMiIgeTE9IjYzIiB5Mj0iMSI+PHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjOWYyZmZmIi8+PHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMGJiMWQzIi8+PC9saW5lYXJHcmFkaWVudD48cGF0aCBkPSJtMTEuNjUxIDQ3LjI3Mi0uMzc5IDEuNTE1Yy0uMTguNzIyLS4yNzIgMS40NjYtLjI3MiAyLjIxM3MuMDkyIDEuNDkxLjI3MiAyLjIxMmwuMzc5IDEuNTE3Yy4zMzQgMS4zMzYgMS41MzIgMi4yNzEgMi45MTEgMi4yNzFoMi40Mzh2LTEyaC0yLjQzOGMtMS4zNzkgMC0yLjU3Ny45MzUtMi45MTEgMi4yNzJ6bTMuMzQ5IDcuNzI4aC0uNDM4Yy0uNDYgMC0uODU4LS4zMTItLjk3MS0uNzU3bC0uMzc5LTEuNTE3Yy0uMTQxLS41NjItLjIxMi0xLjE0My0uMjEyLTEuNzI2cy4wNzEtMS4xNjQuMjEyLTEuNzI4bC4zNzktMS41MTVjLjExMi0uNDQ1LjUxMS0uNzU3Ljk3MS0uNzU3aC40Mzh6bTQxLTU0aC00OHY3LjYyNGwtNyA4djM1LjM3Nmg2djJjMCAxLjMyMi44NTkgMi40NDYgMi4wNDkgMi44NDYuMzM1IDIuMzQ1IDIuMzU3IDQuMTU0IDQuNzk0IDQuMTU0aC4xNzhjLjgwOCAwIDEuNjA5LS4yMDQgMi4zMTgtLjU5MWw5LjkxNi01LjQwOWgxMC43NDV2OGg2di00aDJ2Mmg2di02aDFjMS42NTQgMCAzLTEuMzQ2IDMtM2g4di0zNS4zNzZsLTctOHptLTE0LjM1OCAzMC4xNDEgMTkuMzU4LTEyLjMxOXYyOS45MTd6bS0zOC42NDIgMTcuNTk4di0yOS45MTdsMTkuMzU4IDEyLjMxOXptMjEuMjkyLTE4LjczOS0zLjc5LTIuNDEyYy40ODEtMS42MzMgMS4yODQtMy4wOTkgMi4zMzEtNC4zNDFsNi43NTMgNi43NTN6bS0uMDQ2LTguMTY4YzIuMTA1LTEuNzggNC44MTYtMi44MzIgNy43NTQtMi44MzJzNS42NDkgMS4wNTIgNy43NTQgMi44MzFsLTcuNzU0IDcuNzU1em0xNi45MjEgMS40MTRjMS4wNDggMS4yNDIgMS44NTEgMi43MDggMi4zMzIgNC4zNDFsLTMuNzkxIDIuNDEzaC01LjI5NHptMTIuODMzLTIwLjI0NnYxNy45MDVsLTguNzUzIDUuNTdjLTEuOTEtNS42NDEtNy4xNzItOS40NzUtMTMuMjQ3LTkuNDc1cy0xMS4zMzcgMy44MzQtMTMuMjQ3IDkuNDc1bC04Ljc1My01LjU3di0xNy45MDV6bS00NiAxNi42MzMtNC40OC0yLjg1MSA0LjQ4LTUuMTJ6bS0zLjQxMyAzMC4zNjcgMi40My0yLjIwOWMtLjAwNS4wNy0uMDE3LjEzOC0uMDE3LjIwOXYyem0yMC40MTMgMy40MDYtOS42MTggNS4yNDdjLS40MTYuMjI3LS44ODcuMzQ3LTEuMzYxLjM0N2gtLjE3OGMtMS41NjggMC0yLjg0My0xLjI3NS0yLjg0My0yLjg0M3YtMS4xNTdoLTFjLS41NTIgMC0xLS40NDgtMS0xdi02YzAtLjU1Mi40NDgtMSAxLTFoMXYtMS4xNTdjMC0xLjU2OCAxLjI3NS0yLjg0MyAyLjg0My0yLjg0M2guMTc4Yy40NzUgMCAuOTQ1LjEyIDEuMzYxLjM0N2w5LjYxOCA1LjI0N3ptMjQgNS41OTRoLTJ2LTJoLTZ2NGgtMnYtNmgxMHptNC03YzAgLjU1Mi0uNDQ4IDEtMSAxaC0yNXYtNGgyNWMuNTUyIDAgMSAuNDQ4IDEgMXptLTIyLjQ5Ny0xMC40MTljLS45NDEtLjU0OC0xLjUwMy0xLjUxMy0xLjUwMy0yLjU4MSAwLTEuNjU0IDEuMzQ2LTMgMy0zczMgMS4zNDYgMyAzYzAgMS4wNjgtLjU2MiAyLjAzMy0xLjUwMyAyLjU4MWwtLjQ5Ny4yODl2NS4xM2gtMnYtNS4xM3ptMjEuNDk3IDUuNDE5aC0xN3YtNC4wMjFjMS4yNDYtLjkzOSAyLTIuNDE2IDItMy45NzkgMC0yLjc1Ny0yLjI0My01LTUtNXMtNSAyLjI0My01IDVjMCAxLjU2My43NTQgMy4wNCAyIDMuOTc5djQuMDIxaC0yLjc0NWwtOS45MTYtNS40MDljLS41ODEtLjMxNy0xLjIyNS0uNTA0LTEuODgyLS41NjNsOS45My05LjAyOGgxNS4yMjdsMTkuOCAxOGgtNC40MTRjMC0xLjY1NC0xLjM0Ni0zLTMtM3ptOC40OC0zMC4yMTgtNC40OCAyLjg1MXYtNy45NzF6bS04LjQ4LTkuNzgyaC00MHYtMmg0MHptLTIgMmgydjJoLTJ6bS0yIDJoLTM2di0yaDM2em0tMTYgNGgtMjB2LTJoMjB6IiBmaWxsPSJ1cmwoI1NWR0lEXzFfKSIvPjwvc3ZnPg==" alt="reset_password" style="width: 300px; max-width: 600px; height: auto; margin: auto; display: block;"/>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                    <table>
                        <tr>
                            <td>
                                <div class="text" style="padding: 0 2.5em; text-align: center;">
                                    <h2>$this->reset_email</h2>
                                    <p><a href="$reset_url" class="btn btn-primary">Reset Password</a></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <!-- 1 Column Text + Button : END -->
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td class="bg_light" style="text-align: center;">
                    <p>Powered by <a href="https://sincetech.co.uk/" target="_blank" style="color: rgba(0,0,0,.8);">STL</a></p>
                </td>
            </tr>
        </table>

    </div>
</center>
</body>
</html>
RESETEMAIL;
?>