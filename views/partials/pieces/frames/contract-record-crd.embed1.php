<?php
require_once '../../../../vendor/autoload.php';

$auth = new Connect\AuthorizationHandler;
$contract_handler = new Connect\Contract;
if (!empty($_REQUEST['iA'])) {
    $request_id = $_GET['iA'];
    $contract_info = $contract_handler->getContractInfo($request_id);
    foreach ($contract_info as $key => $value) {
        $contract_info[$key] = str_replace(' ', '', $value);
        if (empty($value)) {
            $contract_info[$key] = "-";
        }
    }
    echo '<html lang="en">
<head>
<style>
/*! CSS Used from: http://lab.tssys.tst/portal_production/console/system/lib/line-awesome/css/line-awesome.min.css */
.la{display:inline-block;}
.la{font:normal normal normal 16px/1 LineAwesome;font-size:inherit;text-decoration:inherit;text-rendering:optimizeLegibility;text-transform:none;-moz-osx-font-smoothing:grayscale;-webkit-font-smoothing:antialiased;font-smoothing:antialiased;}
.la-check-circle-o:before{content:"\f17d";}
.la-close:before{content:"\f191";}
.la-pencil:before{content:"\f2b0";}
/*! CSS Used from: http://lab.tssys.tst/portal_production/console/system/lib/bootstrap/5.0.2/dist/css/bootstrap.min.css */
*,::after,::before{box-sizing:border-box;}
h1{margin-top:0;margin-bottom:.5rem;font-weight:500;line-height:1.2;}
h1{font-size:calc(1.375rem + 1.5vw);}
@media (min-width:1200px){
h1{font-size:2.5rem;}
}
a{color:#0d6efd;text-decoration:underline;}
a:hover{color:#0a58ca;}
table{caption-side:bottom;border-collapse:collapse; width: 100%;}
th{text-align:inherit;text-align:-webkit-match-parent;}
tbody,td,th,thead,tr{border-color:inherit;border-style:solid;border-width:0;}
.row{--bs-gutter-x:1.5rem;--bs-gutter-y:0;display:flex;flex-wrap:wrap;margin-top:calc(var(--bs-gutter-y) * -1);margin-right:calc(var(--bs-gutter-x) * -.5);margin-left:calc(var(--bs-gutter-x) * -.5);}
.row>*{flex-shrink:0;width:100%;max-width:100%;padding-right:calc(var(--bs-gutter-x) * .5);padding-left:calc(var(--bs-gutter-x) * .5);margin-top:var(--bs-gutter-y);}
.col-12{flex:0 0 auto;width:100%;}
@media (min-width:576px){
.col-sm-4{flex:0 0 auto;width:33.33333333%;}
.col-sm-6{flex:0 0 auto;width:50%;}
.col-sm-8{flex:0 0 auto;width:66.66666667%;}
}
@media (min-width:768px){
.col-md-4{flex:0 0 auto;width:33.33333333%;}
}
.btn{display:inline-block;font-weight:400;line-height:1.5;color:#212529;text-align:center;text-decoration:none;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.btn{transition:none;}
}
.btn:hover{color:#212529;}
.btn:focus{outline:0;box-shadow:0 0 0 .25rem rgba(13,110,253,.25);}
.btn:disabled{pointer-events:none;opacity:.65;}
/*! CSS Used from: http://lab.tssys.tst/portal_production/console/system/build/css/style.css */
*:focus{outline:none;}
a{text-decoration:none;font-size:13px;color:#37474f;-webkit-transition:all .3s ease-in-out;transition:all .3s ease-in-out;}
@media only screen and (min-width: 1400px){
a{font-size:14px;}
}
a:focus,a:hover{text-decoration:none;color:var(--main_1_theme_colour_1);}
h1{font-weight:500;font-family:quicksand, sans-serif;}
h1{font-size:2.5rem;}
@media only screen and (max-width: 575px){
h1{font-size:2rem;}
}
.btn{border-radius:2px;text-transform:capitalize;font-size:15px;padding:10px 19px;cursor:pointer;}
@media only screen and (max-width: 480px){
.btn{padding:10px 15px;}
}
.btn i{margin-right:5px;}
td,th{white-space:nowrap;}
th{font-weight:600;}
/*! CSS Used from: http://lab.tssys.tst/portal_production/console/system/css/xyz.css */
*,*:before,*:after{margin:0;padding:0;box-sizing:border-box;}
::placeholder{color:#444;font-size:13px;}
a{color:inherit;}
:disabled *{pointer-events:none;}
.ecni_x_info_box{border-radius:0.25rem;display:-ms-flexbox;display:flex;margin-bottom:1rem;min-height:80px;position:relative;width:100%;color:#002e5f;font-family:\'Roboto\', sans-serif;font-size:14px;background-color:#e5f5fc;padding:1.4em 1.4em 1.4em;}
.ecni_x_bg_grey{background-color:#e5e5e5;}
.ecni_x_info_box .info_heading{display:block;color:#009edf;font-weight:bold;}
::-webkit-scrollbar{width:6px;height:6px;}
::-webkit-scrollbar-track{-webkit-box-shadow:inset 0 0 6px rgba(0, 0, 0, .3);-webkit-border-radius:10px;border-radius:10px;background:#ffffff;}
::-webkit-scrollbar-thumb{-webkit-border-radius:10px;border-radius:10px;background:#333;-webkit-box-shadow:inset 0 0 6px #333;}

.crd_layout{font-size:0.5em!important;}
.crd_page_header {
    height: 7vh;
}
.crd_page_header h1 {
    font-size: 1.5em!important;
    float: left;
    padding: 0.5em;
}
.crd_page_header .crd_page_logo{
    float: right;
    padding: 0.5em;
}
.crd_page_header .crd_page_logo img{
    width: 200px;
}
</style>
<title>C' . $contract_info['contract_no'] . ' Contract Review Document</title>
<link rel="shortcut icon" href="http://lab.tssys.tst/portal_production/console/system/img/elements/logo/favicon.png">
</head>
<body><div class="crd_page_header">

<h1>Contract Review Document</h1>


<div class="crd_page_logo">
    <img class="img-fluid" src="http://lab.tssys.tst/portal_production/console/system/img/elements/logo/cl-logo-fl.png" alt="Theme-Logo">
                </div>


</div>
<div class="crd_body">             
            <div class="row">
               <div class="col-md-4 col-sm-6 col-12">
                  <div class="ecni_x_info_box">
                     <table>
                        <tbody>
                           <tr>
                              <td><span class="info_heading">Contact Infoformation:</span></td>
                           </tr>
                           <tr>
                              <td>Company Name</td>
                              <td>' . $contract_info['company_name'] . '</td>
                           </tr>
                           <tr>
                              <td>Contact Name</td>
                              <td>' . $contract_info['contact_name'] . '</td>
                           </tr>
                           <tr>
                              <td>Email</td>
                              <td>' . $contract_info['email'] . '</td>
                           </tr>
                           <tr>
                              <td>Tel</td>
                              <td>' . $contract_info['contact_tel'] . '</td>
                           </tr>
                           <tr>
                              <td>Fax</td>
                              <td>' . $contract_info['contact_fax'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 col-12">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <tbody>
                           <tr>
                              <td><span class="info_heading">Company Address:</span>
                                 ' . $contract_info['address_line_1'] . '</br>
                                 ' . $contract_info['address_line_2'] . '</br>
                                 ' . $contract_info['address_line_3'] . '</br>
                                 ' . $contract_info['address_line_4'] . '</br>
                                 ' . $contract_info['address_line_5'] . '</br>
                                 ' . $contract_info['address_line_6'] . '
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-md-4 col-sm-6 col-12">
                  <div class="ecni_x_info_box">
                     <table>
                        <tbody>
                           <tr>
                              <td><span class="info_heading">Billing / Invoice Address:</span>
                                 ' . $contract_info['i_address_line_1'] . '</br>
                                 ' . $contract_info['i_address_line_2'] . '</br>
                                 ' . $contract_info['i_address_line_3'] . '</br>
                                 ' . $contract_info['i_address_line_4'] . '</br>
                                 ' . $contract_info['i_address_line_5'] . '</br>
                                 ' . $contract_info['i_address_line_6'] . '
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="ecni_x_info_box">
                     <table>
                        <thead>
                           <tr>
                              <th>Payment Terms/Method</th>
                              <th>Commissioning</th>
                              <th>Service Notified</th>
                              <th>Penalty Clause</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>' . $contract_info['paymentTM'] . '</td>
                              <td>' . $contract_info['commissioning'] . '</td>
                              <td>' . $contract_info['service_notified'] . '</td>
                              <td>' . $contract_info['penalty_clause'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-4">
                  <div class="ecni_x_info_box">
                     <table>
                        <thead>
                           <tr>
                              <th>Contract Details</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Contract No</td>
                              <td>C' . $contract_info['contract_no'] . '</td>
                           </tr>
                           <tr>
                              <td>Quote No</td>
                              <td>' . $contract_info['quote_no'] . '</td>
                           </tr>
                           <tr>
                              <td>Quote Date</td>
                              <td>' . $contract_info['quote_date'] . '</td>
                           </tr>
                           <tr>
                              <td>Order No</td>
                              <td>' . $contract_info['order_no'] . '</td>
                           </tr>
                           <tr>
                              <td>Order Date</td>
                              <td>' . $contract_info['order_date'] . '</td>
                           </tr>
                           <tr>
                              <td>Quantity</td>
                              <td>' . $contract_info['quantity'] . '</td>
                           </tr>
                           <tr>
                              <td>Date Required</td>
                              <td>' . $contract_info['required_date'] . '</td>
                           </tr>
                           <tr>
                              <td>Acknowledged</td>
                              <td>' . $contract_info['quote_date'] . '</td>
                           </tr>
                           <tr>
                              <td>Contract No</td>
                              <td>' . $contract_info['job_no'] . '</td>
                           </tr>
                           <tr>
                              <td>Sales Order No</td>
                              <td>' . $contract_info['sales_order_no'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-sm-8">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <thead>
                           <tr>
                              <th>Electrical Specification</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Current Flow</td>
                              <td>' . $contract_info['current_flow'] . '</td>
                           </tr>
                           <tr>
                              <td>Load Type</td>
                              <td>' . $contract_info['load_type'] . '</td>
                           </tr>
                           <tr>
                              <td>Configuration</td>
                              <td>' . $contract_info['config'] . '</td>
                           </tr>
                           <tr>
                              <td>Usage</td>
                              <td>' . $contract_info['usage_frequency'] . '</td>
                           </tr>
                           <tr>
                              <th>Operation Range</th>
                              <th></th>
                           </tr>
                           <tr>
                              <td>Ambient Temperature Operation Range</td>
                              <td>' . $contract_info['tempRange'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-4">
                  <div class="ecni_x_info_box">
                     <table>
                        <thead>
                           <tr>
                              <th>Power rating Specification</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Resistive Power kW</td>
                              <td>' . $contract_info['mainKW'] . '</td>
                           </tr>
                           <tr>
                              <td>Reactive Power kVA</td>
                              <td>' . $contract_info['mainKVA'] . '</td>
                           </tr>
                           <tr>
                              <td>Power Factor</td>
                              <td>' . $contract_info['mainPF'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <thead>
                           <tr>
                              <th>Test Supply</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>VOLTS</td>
                              <td>' . $contract_info['supplyV'] . '</td>
                           </tr>
                           <tr>
                              <td>Frequency Hz</td>
                              <td>' . $contract_info['supplyHz'] . '</td>
                           </tr>
                           <tr>
                              <td>Phase PH</td>
                              <td>' . $contract_info['supplyPH'] . '</td>
                           </tr>
                           <tr>
                              <td>No of Wires</td>
                              <td>' . $contract_info['supplyW'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <thead>
                           <tr>
                              <th>Auxiliary Supply</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>VOLTS</td>
                              <td>' . $contract_info['auxSV'] . '</td>
                           </tr>
                           <tr>
                              <td>Frequency Hz</td>
                              <td>' . $contract_info['auxSHz'] . '</td>
                           </tr>
                           <tr>
                              <td>Phase PH</td>
                              <td>' . $contract_info['auxSPH'] . '</td>
                           </tr>
                           <tr>
                              <td>No of Wires</td>
                              <td>' . $contract_info['auxSW'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <thead>
                           <tr>
                              <th>Control</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Controller</td>
                              <td>' . $contract_info['controller'];
    if (strpos($contract_info['controller'], 'MCS') !== false) {//php 7.x
        echo ' - ' . $contract_info['controller_sub'] . ' - ' . $contract_info['controller_packages'] . ' - ' . $contract_info['interconnecting_packages'];
    }
    echo '
                              </td>
                           </tr>
                           <tr>
                              <td>Control Leads</td>
                              <td>' . $contract_info['leads'] . '</td>
                           </tr>
                           <tr>
                              <td>Controller Information</td>
                              <td>' . $contract_info['control_info'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="ecni_x_info_box">
                     <table>
                        <thead>
                           <tr>
                              <th>Mechanical Specification</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Enclosure</td>
                              <td>' . $contract_info['enclosure'] . '</td>
                           </tr>
                           <tr>
                              <td>Style</td>
                              <td>' . $contract_info['encStyle'] . '</td>
                           </tr>
                           <tr>
                              <td>Size</td>
                              <td>' . $contract_info['encSize'] . '</td>
                           </tr>
                           <tr>
                              <td>Height</td>
                              <td>' . $contract_info['encHeight'] . '</td>
                           </tr>
                           <tr>
                              <td>Base</td>
                              <td>' . $contract_info['encBase'] . '</td>
                           </tr>
                           <tr>
                              <td>Lifting Technique</td>
                              <td>' . $contract_info['encLifting'] . '</td>
                           </tr>
                           <tr>
                              <td>Finish</td>
                              <td>' . $contract_info['enc_finish'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <thead>
                           <tr>
                              <th>Other Information</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Other Information</td>
                              <td>' . $contract_info['otherInfo'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table>
                        <thead>
                           <tr>
                              <th scope="col">Position</th>
                              <th scope="col">Signature</th>
                              <th scope="col">Date</th>
                              <th scope="col">Checked</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <th>Contract Manager</th>';
    if ($contract_info['salesCheck1'] == '1') {
        $signature1 = '../img/signatures/' . $contract_info['salesCheck1By'] . '.png';
        echo '
                              <td>';
        if (file_exists($signature1)) {
            echo '<img class="sgh_sign_img" src="' . $signature1 . '" alt="signature1">';
        } else {
            echo 'Signed';
        }
        echo '
                              </td>
                              <td>' . $contract_info['salesCheck1Date'] . '</td>
                              <td><i class="la la-check-circle-o"></i></td>
                              ';
    } else {
        echo '
                              <td>';
        if ($auth->isSuperAdmin() || $auth->isContractManager()) {
            echo '<a href="" class="btn" data-toggle="modal" data-id="sign_1" data-target="#sign_1">Sign
                                 <i class="la la-pencil"></i>
                                 </a>';
        } else {
            echo 'Not Checked';
        }
        echo '
                              </td>
                              <td> - </td>
                              <td><i class="la la-close"></i></td>
                              ';
    }
    echo '
                           </tr>
                           <tr>
                              <td>Sales Manager</td>
                              ';
    if ($contract_info['salesCheck2'] == '1') {
        $signature2 = '../img/signatures/' . $contract_info['salesCheck2By'] . '.png';
        echo '
                              <td>';
        if (file_exists($signature2)) {
            echo '<img class="sgh_sign_img" src="' . $signature2 . '" alt="signature2">';
        } else {
            echo 'Signed';
        }
        echo '
                              </td>
                              <td>' . $contract_info['salesCheck2Date'] . '</td>
                              <td><i class="la la-check-circle-o"></i></td>
                              ';
    } else {
        echo '
                              <td>';
        if ($contract_info['salesCheck1'] == '1') {
            if ($auth->isSuperAdmin() || $auth->isSalesStaff()) {
                echo '<a href="" class="btn" data-toggle="modal" data-id="sign_1" data-target="#sign_1">Sign
                                 <i class="la la-pencil"></i>
                                 </a>
                                 <a href="" class="btn" data-toggle="modal" data-id="query_1" data-target="#query_1">Query
                                 <i class="la la-question"></i>
                                 </a>';
            } else {
                echo 'Not Checked';
            }
        } else {
            echo 'Not Checked';
        }
        echo '
                              </td>
                              <td>N/A</td>
                              <td><i class="la la-close"></i></td>
                              ';
    }
    echo '
                              <td>
                           </tr>
                           <tr>
                              <td>Technical Manager</td>
                              ';
    if ($contract_info['salesCheck3'] == '1') {
        $signature3 = '../img/signatures/' . $contract_info['salesCheck3By'] . '.png';
        echo '
                              <td>';
        if (file_exists($signature3)) {
            echo '<img class="sgh_sign_img" src="' . $signature3 . '" alt="signature3">';
        } else {
            echo 'Signed';
        }
        echo '
                              </td>
                              <td>' . $contract_info['salesCheck3Date'] . '</td>
                              <td><i class="la la-check-circle-o"></i></td>
                              ';
    } else {
        echo '
                              <td>';
        if ($contract_info['salesCheck2'] == '1') {
            if ($auth->isSuperAdmin() || $auth->isTechnicalStaff()) {
                echo '<a href="" class="btn" data-toggle="modal" data-id="sign_1" data-target="#sign_1">Sign
                             <i class="la la-pencil"></i>
                         </a>
                         <a href="" class="btn" data-toggle="modal" data-id="query_1" data-target="#query_1">Query
                            <i class="la la-question"></i>
                         </a>
                                 ';
            } else {
                echo 'Not Checked';
            }
        } else {
            echo 'Not Checked';
        }
        echo '
                              </td>
                              <td>N/A</td>
                              <td><i class="la la-close"></i></td>
                              ';
    }
    echo '
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            </div> 
            </body>
</html>';
} else {
    echo 'no!!';
//    echo '<script type="text/javascript"> document.location = "error.php?t=404" </script>';
}
