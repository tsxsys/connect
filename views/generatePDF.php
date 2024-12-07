<?php
/*********************************************************************
 * generatePDF.php
 *
 * Connect's home page
 *
 * Copyright (c)  2017-2099 SINCE TECH
 * http://www.sincetech.co.uk/
 *
 * Released under the GNU General Public License WITHOUT ANY WARRANTY.
 *
 * $Id: $
 **********************************************************************/


require_once('../config/config.php');
require_once(VENDOR_DIR . 'autoload.php');

//this will be something like: http://www.yourapp.com/templates/log.php
$fileUrl = 'partials/pieces/frames/contract-record-crd.embed.php';

ob_start();
include $fileUrl;
$html = ob_get_clean();
ob_end_clean();


//get file content after the script is server-side interpreted
$fileContent = file_get_contents($fileUrl);

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(array(
    'isPhpEnabled' => true,
//    'isRemoteEnabled' => true
));
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');
// Render the HTML as PDF
$dompdf->render();
$dompdf->setBasePath($_SERVER['DOCUMENT_ROOT'] . 'views/partials/pieces/frames/crd.style.css');
ob_end_clean();

// Output the generated PDF to Browser
$dompdf->stream(
    'crdV0.0.1.pdf',
    array(
        'Attachment' => 0
    )
);