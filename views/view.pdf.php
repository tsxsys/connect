<?php
/*********************************************************************
 * view.pdf.php
 *
 * Connect's PDF Viewer script
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
if (!strcasecmp(basename($_SERVER['SCRIPT_NAME']), basename(__FILE__))) die('Access denied!');
if (isset($_REQUEST["dt"]) && isset($_REQUEST["dn"]) && isset($_REQUEST["de"])) {
    $file_extension = urldecode($_REQUEST["de"]);
    $file_name = urldecode($_REQUEST["dn"]);
    $file_type = urldecode($_REQUEST["dt"]);
    if ((isset($_REQUEST["di"])) && (($_REQUEST["dt"]) == 'documents')) {
        $file_id = urldecode($_REQUEST["di"]);
        open_doc($file_type, $file_name, $file_extension, $file_id);
    } else if (($_REQUEST["dt"]) == 'default') {
        open_doc($file_type, $file_name, $file_extension);
    }
}