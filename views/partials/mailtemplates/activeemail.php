<?php
$active_template = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn\'t be necessary -->
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

        /* If the above doesn\'t work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you\'d like to fix */

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
            font-family: "Lato", sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }

        body{
            font-family: "Lato", sans-serif;
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
            font-family: "Lato", sans-serif;
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
            content: "";
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
                                <h1><a href="'. $this->base_url .'" style="color: #c5092c;font-size: 24px;font-weight: 700;font-family:Lato, sans-serif;">'.$this->site_name.'</a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
                    <img src="data:image/png;base64,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" alt="welcome" style="width: 300px; max-width: 600px; height: auto; margin: auto; display: block;"/>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                    <table>
                        <tr>
                            <td>
                                <div class="text" style="padding: 0 2.5em; text-align: center;">
                                    <h2>'.$this->active_email.'</h2>
                                    <p><a href="'.$this->signin_url.'" class="btn btn-primary" style="border-radius: 5px;background: #c5092c;color: #ffffff;">Sign In</a></p>
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
</html>';