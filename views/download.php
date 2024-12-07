<?php
/*********************************************************************
 * download.php
 *
 * Connect's download script
 *
 * Copyright (c)  2017-2099 SINCE TECH
 * http://www.sincetech.co.uk/
 *
 * Released under the GNU General Public License WITHOUT ANY WARRANTY.
 *
 * $Id: $
 **********************************************************************/
//if(!strcasecmp(basename($_SERVER['SCRIPT_NAME']),basename(__FILE__))) die('Access denied!');
require_once('../config/config.php');
require_once('../config/inc/func.inc.php');

if ((isset($_REQUEST["dt"]) && isset($_REQUEST["dn"]) && isset($_REQUEST["de"])) && ((($_REQUEST["dt"]) == 'software') || (($_REQUEST["dt"]) == 'default'))) {
    // Get parameters
    $file_extension = urldecode($_REQUEST["de"]); // Decode URL-encoded string
    $file_name = urldecode($_REQUEST["dn"]);
    $file_target = urldecode($_REQUEST["dt"]);
    download_file($file_target, $file_name, $file_extension);
} else if ((isset($_REQUEST["dt"]) && isset($_REQUEST["dn"]) && isset($_REQUEST["de"]) && isset($_REQUEST["di"])) && (($_REQUEST["dt"]) == 'documents')) {
    $file_extension = urldecode($_REQUEST["de"]);
    $file_name = urldecode($_REQUEST["dn"]);
    $file_target = urldecode($_REQUEST["dt"]);
    $file_id = urldecode($_REQUEST["di"]);
    download_file($file_target, $file_name, $file_extension, $file_id);
}
