<?php
$contract_handler = new Connect\Contract;
if (!empty($_REQUEST['iA'])) {
    $contract_id = $_GET['iA'];
    $post_unique_id = $_GET['qq'];
    $contract_info = $contract_handler->getContractInfo($contract_id);
    $idAss = $contract_info['id'];
    $cid = $contract_info['company_id'];
    $contract_type = $contract_info['contract_type'];
    $contract_id = $contract_info['contract_id'];
    $contract_no = $contract_info['contract_no'];
    $date = $contract_info['date'];
    $site_address_line_1 = $contract_info['site_address_line_1'];
    $site_address_line_2 = $contract_info['site_address_line_2'];
    $site_address_line_3 = $contract_info['site_address_line_3'];
    $site_address_line_4 = $contract_info['site_address_line_4'];
    $site_address_line_5 = $contract_info['site_address_line_5'];
    $site_address_line_6 = $contract_info['site_address_line_6'];
    $quoteNum = $contract_info['quote_no'];
    $quoteDate = $contract_info['quote_date'];
    $order_no = $contract_info['order_no'];
    $order_date = $contract_info['order_date'];
    $quantity = $contract_info['quantity'];
    $requiredDate = $contract_info['required_date'];
    $jobNo = $contract_info['job_no'];
    $paymentTM = $contract_info['paymentTM'];
    $commissioning = $contract_info['commissioning'];
    $serviceNotified = $contract_info['service_notified'];
    $penaltyClause = $contract_info['penalty_clause'];
    $salesOrderNo = $contract_info['sales_order_no'];
    $salesperson_id_d = $contract_info['salesperson_id'];
    if (!empty($salesperson_id_d)) {
        $r_salesperson_id = explode("|", $salesperson_id_d);
        $salesperson_id_uid = $r_salesperson_id[0];
        $salesperson_id = $r_salesperson_id[1];
    }
    $current_flow = $contract_info['current_flow'];
    $load_type = $contract_info['load_type'];
    $config = $contract_info['config'];
    $usage = $contract_info['usage_frequency'];
//                Main Power spec
    $mainKW = $contract_info['mainKW'];
    $mainKVA = $contract_info['mainKVA'];
    $mainPF = $contract_info['mainPF'];
    $mainAMPS = $contract_info['mainAMPS'];
//                Main Power spec 2 StarDelta
    $mainKWSD = $contract_info['mainKWSD'];
    $mainKVASD = $contract_info['mainKVASD'];
    $mainPFSD = $contract_info['mainPFSD'];
    $mainAMPSSD = $contract_info['mainAMPSSD'];
//Test Supply
    $supplyV = $contract_info['supplyV'];
    $supplyHz = $contract_info['supplyHz'];
    $supplyPH = $contract_info['supplyPH'];
    $supplyW = $contract_info['supplyW'];
//Test Supply 2 StarDelta
    $supplyVSD = $contract_info['supplyVSD'];
    $supplyHzSD = $contract_info['supplyHzSD'];
//Delta Min1 Max2
    $supplyVD1 = $contract_info['supplyVD1'];
    $supplyVD2 = $contract_info['supplyVD2'];
//Auxiliary Supply
    $auxInfo = $contract_info['auxInfo'];
    $auxSV = $contract_info['auxSV'];
    $auxSHz = $contract_info['auxSHz'];
    $auxSPH = $contract_info['auxSPH'];
    $auxSW = $contract_info['auxSW'];
    $tempRange = $contract_info['tempRange'];
    if (!empty($tempRange)) {
        $tempRangeParts = explode(" to ", $tempRange);
        $rangeTempCFrom = array_values($tempRangeParts)[0];
        $rangeTempCTo = array_values($tempRangeParts)[1];
    } else {
        $rangeTempCFrom = '-50';
        $rangeTempCTo = '40';
    }
//Control System
    $ioInfo = $contract_info['ioInfo'];
    $controller = $contract_info['controller'];
    $controller_sub = $contract_info['controller_sub'];
    $controller_packages = $contract_info['controller_packages'];
    $interconnecting_packages = $contract_info['interconnecting_packages'];
    $control_info = $contract_info['control_info'];
    $leads = $contract_info['leads'];
//              Transformer
    $coolingType = $contract_info['coolingType'];
    $txPRating = $contract_info['txPRating'];
    $txSRating = $contract_info['txSRating'];
    $fanRotation = $contract_info['fanRotation'];
    $sgPRating = $contract_info['sgPRating'];
    $sgSRating = $contract_info['sgSRating'];
    $relayType = $contract_info['relayType'];
//Enclosure
    $enc = $contract_info['enclosure'];
    $encStyle = $contract_info['encStyle'];
    $encSize = $contract_info['encSize'];
    $encBase = $contract_info['encBase'];
    $encLifting = $contract_info['encLifting'];
    $encHeight = $contract_info['encHeight'];
    $encSpecial = $contract_info['encSpecial'];
    $enc_finishDefaultApplied = $contract_info['encSpecial'];
    $enc_finish = $contract_info['enc_finish'];
    if (!empty($contract_info['enc_finish'])) {
        $enc_finishParts = explode(" - ", $enc_finish);
        $enc_finishType = array_values($enc_finishParts)[0];
        $enc_finish = array_values($enc_finishParts)[1];
    } else {
        $enc_finishType = 'N/A';
        $enc_finish = 'N/A';
    }
//Company Info
    $company_name = $contract_info['company_name'];
    $cusName = $contract_info['contact_name'];
    $cusEmail = $contract_info['email'];
    $cusTel = $contract_info['contact_tel'];
    $cusFax = $contract_info['contact_fax'];
    $dir = '../files/lbs';
    if (file_exists($dir)) {
        $isDirEmpty = !(new \FilesystemIterator($dir))->valid();
    } else {
        $isDirEmpty = true;
    }
    $assetPinInfo = $contract_handler->getAssetPinInfo($contract_id);
    $lbPin = $assetPinInfo['contract_pin'];

    echo '
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <h3><small> Files for ' . $company_name . ', C' . $contract_no . '</small></h3>
            ';
    if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager() || $auth->isDesignEngineer()) {
        echo '
            <div class="row">
               <div class="btn_tr_xtra">
                  <div class="mb-3">
                     <button class="btn btn-primary-1 m-b-10 btn-sm pull-right s_h more__actions_bar" data-target="#more__actions_bar" style="margin-right: 10px;">More Actions</button>
                  </div>
               </div>
               <div class="col-md-8 col-sm-12 offset-md-2 text-center top__bar s_h_panel" id="more__actions_bar">
                  <div class="btn-group" role="group" data-toggle="tooltip" data-placement="top" title="Actions" data-original-title="Actions">
                     <button type="button" class="btn btn-primary-1 btn-sm m-b-10" data-bs-toggle="modal" data-bs-target="#contact_files">
                     <i class="icofont icofont-upload-alt"></i>Contract Files
                     </button>
                     <button type="button" class="btn btn-primary-1 btn-sm m-b-10" data-bs-toggle="modal" data-bs-target="#assign_software">
                     <i class="icofont icofont-code-alt"></i>Assign Software</button>
                     <button type="button" class="btn btn-primary-1 btn-sm m-b-10" data-bs-toggle="modal" data-bs-target="#assign_associations">
                     <i class="icofont icofont-users-social"></i>Assign Associations</button>';
                      if (empty($lbPin)) {
                          echo '<button type="button" class="btn btn-primary-1 btn-sm m-b-10" id="gen_u_pin" data-action="setAssetUPin" data-xeid="'.$contract_id.'" onclick="setAssetUPin(this.id)">
                     <i class="icofont icofont-key"></i>Generate Unique PIN</button>';
                      } else {
                          echo '<button type="button" class="btn btn-primary-1 btn-sm m-b-10" data-bs-toggle="modal" data-bs-target="#unique_pin">
                     <i class="icofont icofont-key"></i>View Unique PIN</button>';
                      }
                                            echo '</div>
               </div>
            </div>';
        include 'partials/pieces/contract-file-upload.piece.php';
        include 'partials/pieces/contract-assign-software.piece.php';
        include 'partials/pieces/contract-assign-associations.piece.php';
        include 'partials/pieces/contract-unique-pin.piece.php';
        echo '<div class="fixed-action-btn fly down click-to-toggle">
               <a class="btn-floating btn-large grey-1">
               <i class="large mat material-icons">notifications_active</i>
               </a>
               <ul>
                  ';
        if ($notified == 0) {
            if ((!empty($assWeight)) and (!empty($lbPin)) and (!empty($dataTags)) and ($isDirEmpty === false)) {
                if ((!empty($checkEng)) and (!empty($checkS))) {
                    if ($auth->isContractManager()) {
                        $extra = '';
                        $x_classes = '';
                    } else {
                        $extra = 'disabled';
                        $x_classes = 'ts__disabled';
                    }
                    $data_target = '#complete-all';
                } else {
                    $data_target = '#checks-all';
                    $extra = '';
                    $x_classes = '';
                }
                echo '
                  <li><a class="btn-floating blue-1 $x_classes" data-toggle="modal" data-target="$data_target" data-backdrop="static" data-keyboard="false"' . $extra . '>
                     <i class="mat material-icons">edit</i></a>
                  </li>
                  ';
            } else {
                echo '
                  <li>
                     <a class="btn-floating tooltip ts__disabled" onclick="return false;">
                        <span class="tooltiptext tooltip-left">
                           <p>Ensure document upload is complete</p>
                           <p>Ensure weight has been entered</p>
                           <p>Ensure Loadbank Unique Code LUC has been generated</p>
                        </span>
                        <i class="mat material-icons">edit</i>
                     </a>
                  </li>
                  ';
            }
        }
        echo '
                  <li><a class="btn-floating blue-dark-1 tooltip"><span class="tooltiptext tooltip-left">Sales check</span>';
        if ($checkS == 0) {
            echo '<span class="badge badge-bad"><i class="fa fa-times-circle fa-check"></i></span>';
        } else {
            echo '<span class="badge badge-good"><i class="fa fa-check-circle fa-check"></i></span>';
        }
        echo '<i class="mat material-icons">equalizer</i>
                     </a>
                  </li>
                  <li><a class="btn-floating blue-grey-1 tooltip"><span class="tooltiptext tooltip-left">Engineer check</span>';
        if ($checkEng == 0) {
            echo '<span class="badge badge-bad"><i class="fa fa-times-circle fa-check"></i></span>';
        } else {
            echo '<span class="badge badge-good"><i class="fa fa-check-circle fa-check"></i></span>';
        }
        echo '<i class="mat material-icons">perm_identity</i></a>
                  </li>
                  <li>
                     <div class="btn-floating blue-dark-1 tooltip"><span class="tooltiptext tooltip-left">Completed</span>';
        if ($completed == 0) {
            echo '<span class="badge badge-bad"><i class="fa fa-times-circle fa-check"></i></span>';
        } else {
            echo '<span class="badge badge-good"><i class="fa fa-check-circle fa-check"></i></span>';
        }
        echo '<i class="mat material-icons">done_all</i>
                     </div>
                  </li>
                  <li>
                     <div class="btn-floating blue-grey-1 tooltip"><span class="tooltiptext tooltip-left">Notification sent</span>';
        if ($notified == 0) {
            echo '<span class="badge badge-bad"><i class="fa fa-times-circle fa-check"></i></span>';
        } else {
            echo '<span class="badge badge-good"><i class="fa fa-check-circle fa-check"></i></span>';
        }
        echo '<i class="mat material-icons">send</i>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="modal fade sgh--modal sgh--modal-bg" id="checks-all" tabindex="-1" role="dialog"
               aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content sgh--modal-content">
                     <div class="modal-header sgh--modal-header">
                        <button type="button" class="close sgh-close dark" data-dismiss="modal"
                           aria-label="Close"><span
                           aria-hidden="true">×</span>
                        </button>
                        <h1 class="modal-title heading--bright" id="myModalLabel2">Verification</h1>
                     </div>
                     ';
        if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager()) {
            echo '
                     <form role="form" action="" method="post">
                        <div class="modal-body sgh--modal-body">
                           <h4>Sales check</h4>
                           ';
            if ($checkS == 0) {
                echo '
                           <div class="ts_neat_radio ts_inline"><label><input type="radio" id="checkedS-1" name="checkS" value="1"';
                if ($checkS == 1) {
                    echo 'checked';
                }
                echo '>Checked</label>
                           </div>
                           <div class="ts_neat_radio ts_inline"><label><input type="radio" id="checkedS-0" name="checkS" value="0"';
                if ($checkS == 0) {
                    echo 'checked';
                }
                echo '>Not checked </label>
                           </div>
                           ';
            } else {
                echo '
                           <p class="ts_verify_done">Checked <i class="la la-check"></i></p>
                           ';
            }
            echo '
                           <div class="modal-footer sgh--modal-footer">
                              <button type="submit" class="btn btn-primary" name="verifySalesSubmit">Save changes</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </form>
                     ';
        }
        if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isDesignEngineer()) {
            echo '
                     <form role="form" action="" method="post">
                        <div class="modal-body sgh--modal-body">
                           <h4>Engineer check</h4>
                           ';
            if ($checkEng == 0) {
                echo '
                           <div class="ts_neat_radio ts_inline"><label><input type="radio" name="checkEng" value="1"';
                if ($checkEng == 1) {
                    echo 'checked';
                }
                echo '>Checked</label>
                           </div>
                           <div class="ts_neat_radio ts_inline"><label><input type="radio" name="checkEng" value="0"';
                if ($checkEng == 0) {
                    echo 'checked';
                }
                echo '>Not checked </label>
                           </div>
                           <!--<div class="row m-t-10"><button type="submit" class="btn btn-primary" name="verifySubmit">Save changes</button></div>-->';
            } else {
                echo '
                           <p class="ts_verify_done">Checked <i class="la la-check"></i></p>
                           ';
            }
            echo '
                           <div class="modal-footer sgh--modal-footer">
                              <button type="submit" class="btn btn-primary" name="verifyEngSubmit">Save changes</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </form>
                     ';
        }
        echo '
                  </div>
               </div>
            </div>
            <div class="modal fade sgh--modal sgh--modal-bg" id="complete-all" tabindex="-1" role="dialog"
               aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content sgh--modal-content">
                     <div class="modal-header sgh--modal-header">
                        <button type="button" class="close sgh-close dark" data-dismiss="modal"
                           aria-label="Close"><span
                           aria-hidden="true">×</span>
                        </button>
                        <h1 class="modal-title heading--bright" id="myModalLabel2">Verification</h1>
                     </div>
                     <form role="form" action="" method="post">
                        <div class="modal-body sgh--modal-body">
                           ';
        if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager()) {
            if ($checkS == 1) {
                echo '
                           <h4>Completed</h4>
                           ';
                if ($completed == 0) {
                    echo '
                           <div class="ts_neat_radio ts_inline"><label><input type="radio" id="complete-1" name="completed" value="1"';
                    if ($completed == 1) {
                        echo 'checked';
                    }
                    echo '>Completed</label>
                           </div>
                           <div class="ts_neat_radio ts_inline"><label><input type="radio" id="complete-0" name="completed" value="0"';
                    if ($completed == 0) {
                        echo 'checked';
                    }
                    echo '>Not completed</label>
                           </div>
                           ';
                } else {
                    echo '
                           <p class="ts_verify_done">Completed <i class="la la-check"></i></p>
                           ';
                }
            }
            echo '
                           <div class="row">
                              <div class="col-md-6">
                                 <h4>Warranty end date</h4>
                                 <div class="form-group">
                                    <input type="date" class="form-control" name="warrantyDate"/>
                                 </div>
                              </div>
                           </div>
                           ';
        }
        echo '
                        </div>
                        <div class="modal-footer sgh--modal-footer">
                           <button type="submit" class="btn btn-primary" name="completedSubmit">Save changes</button>
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            ';
    }
    echo '
            <div class="container ts__container_doc">
               <div class="row">
                  <div class="col-lg-6 col-md-6">
                     <div class="ecni_x_info_box">
                        <div class="info-box-content">
                           <div class="row">
                              <div class="col-md-6">
                                 <span class="info_heading">Site Address</span>
                                 <p class="info_data">';
    if ((empty($site_address_line_1)) and (empty($site_address_line_2)) and (empty($site_address_line_3)) and (empty($site_address_line_4)) and (empty($site_address_line_5)) and (empty($site_address_line_6))) {
        echo 'No site address available';
    }
    if (!empty($site_address_line_1)) {
        echo $site_address_line_1 . '<br>';
    }
    if (!empty($site_address_line_2)) {
        echo $site_address_line_2 . '<br>';
    }
    if (!empty($site_address_line_3)) {
        echo $site_address_line_3 . '<br>';
    }
    if (!empty($site_address_line_4)) {
        echo $site_address_line_4 . '<br>';
    }
    if (!empty($site_address_line_5)) {
        echo $site_address_line_5 . '<br>';
    }
    if (!empty($site_address_line_6)) {
        echo $site_address_line_6 . '<br>';
    }
    echo '
                                 </p>
                                 <div class="btn-group">
                                <button type="button" class="btn btn-primary-1 btn-sm" data-bs-toggle="modal" data-bs-target="#edit_site_address">Edit
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </button>';
    include 'partials/pieces/contract-site-address.piece.php';
    if ((!empty($site_address_line_1)) || (!empty($site_address_line_2)) || (!empty($site_address_line_3)) || (!empty($site_address_line_4)) || (!empty($site_address_line_5)) || (!empty($site_address_line_6))) {
        echo '<button type="button" class="btn btn-primary-1 btn-sm" data-bs-toggle="modal" data-bs-target="#delete_site_address">Delete
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
                              </div>';
        include 'partials/pieces/contract-site-address-delete.piece.php';
    }

    echo '</div>
                                 
                              </div>
                              <div class="col-md-6">
                                 <span class="info_heading">Contact Name</span>
                                 <p class="info_data">';
    if (!empty($cusName)) {
        echo $cusName;
    } else {
        echo "No data found";
    }
    echo '
                                 </p>
                                 <span class="info_heading">Email</span>
                                 <p class="info_data">';
    if (!empty($cusEmail)) {
        echo $cusEmail;
    } else {
        echo "No data found";
    }
    echo '
                                 </p>
                                 <span class="info_heading">Telephone number</span>
                                 <p class="info_data">';
    if (!empty($cusTel)) {
        echo $cusTel;
    } else {
        echo "No data found";
    }
    echo '
                                 </p>
                                 <span class="info_heading">Fax</span>
                                 <p class="info_data">';
    if (!empty($cusFax)) {
        echo $cusFax;
    } else {
        echo "No data found";
    }
    echo '
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="ecni_x_info_box ecni_x_bg_grey">
                        <div class="info-box-content">
                           <div class="row">
                              <div class="col-md-6">
                                 <span class="info_heading">Warranty Status</span>
                                 ';
    if (!empty($warrantyDate)) {
        if (strtotime($warrantyDate) > strtotime('now')) {
            echo '
                                 <p class="info_data">In warranty</p>
                                 ';
        } else {
            echo '
                                 <p class="info_data">Out of warranty</p>
                                 ';
        }
        echo '
                                 <p>Ends: ' . $warrantyDate . '</p>
                                 ';
    } else {
        echo "No data found";
    }
    echo '
                              </div>
                              <div class="col-md-6">
                                 <a href="contracts.view.php?iA=' . $idAss . '&iC=' . $cid . '&vAss=' . $idAss . '">View Order</a>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-12">
                                 <h5>Mechanical Specification</h5>
                                 <div>
                                    <table class="table--spec">
                                       <thead>
                                          <tr>
                                             <td>Size</td>
                                             <td>';
    if (!strpos($encBase, "N/A") !== false) {
        echo 'Base';
    } elseif (!strpos($encLifting, "N/A") !== false) {
        echo 'Lifting';
    } else {
        echo 'N/A';
    }
    echo '
                                             </td>
                                             <td>Finish</td>
                                             <td>Weight</td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>
                                                ' . $encSize . '
                                             </td>
                                             <td>';
    if (!strpos($encBase, "N/A") !== false) {
        echo $encBase;
    } elseif (!strpos($encLifting, "N/A") !== false) {
        echo $encLifting;
    } else {
        echo 'N/A';
    }
    echo '
                                             </td>
                                             <td>
                                                ' . $enc_finish . '
                                             </td>
                                             <td>
                                                ';
    if (!empty($assWeight)) {
        echo $assWeight;
    } else {
        echo 'No data found';
    }
    echo '
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-12">
                                 <h5>Electrical Specification</h5>
                                 <span class="info_heading">Loadbank Power Rating</span>';
    if (!empty($load_type)) {
        if ($load_type == 'Resistive') {
            echo "
                                 <p class='big-num heading--flush'>$mainKW<sup> kW</sup></p>
                                 ";
        } elseif ($load_type == 'Resistive/Reactive') {
            echo "
                                 <p class='big-num heading--flush'>$mainKVA<sup> kVA</sup></p>
                                 ";
        } elseif ($load_type == 'Resistive/Capacitive') {
            echo "
                                 <p class='big-num heading--flush'>$mainAMPS<sup> AMPS</sup></p>
                                 ";
        }
    } else {
        echo "
                                 <p>No data found</p>
                                 ";
    }
    echo '
                                 <span class="info_heading">Test Supply</span>
                                 <div>
                                    <div>
                                       <table class="table--spec">
                                          <thead>
                                             <tr>
                                                <td>Volts</td>
                                                <td>Hz</td>
                                                <td>PH</td>
                                                <td>Wire</td>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>
                                                   ' . $supplyV . '
                                                </td>
                                                <td>
                                                   ' . $supplyHz . '
                                                </td>
                                                <td>
                                                   ' . $supplyPH . '
                                                </td>
                                                <td>
                                                   ' . $supplyW . '
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <span class="info_heading">Auxiliary Supply</span>
                                 <div>
                                    <div>
                                       <table class="table--spec">
                                          <thead>
                                             <tr>
                                                <td>Volts</td>
                                                <td>Hz</td>
                                                <td>PH</td>
                                                <td>Wire</td>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>
                                                   ' . $auxSV . '
                                                </td>
                                                <td>
                                                   ' . $auxSHz . '
                                                </td>
                                                <td>
                                                   ' . $auxSPH . '
                                                </td>
                                                <td>
                                                   ' . $auxSW . '
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </div>
                                 </div>
                                 <span class="info_heading">Control System</span>
                                 <div>
                                    <h6>Controller: ' . $controller . '</h6>
                                    Controller Info: ' . $control_info . '
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="ecni_x_info_box ecni_x_bg_alt">
                        <div class="info-box-content">
                           <div class="row">
                              <div class="col-12">
                                 <h5>Documents</h5>
                                
                                 <table id="" class="table table__scroll table-xs">
            <thead>
            <tr>
                <th>View and download documents.</th>
            </tr>
            </thead>
            <tbody>';
//    list_default_files();
//    list_files('documents', $contract_id);
//    list_contract_files($contract_id);
    echo  $contract_handler->pullAllContractFiles($contract_id);
    echo '</tbody>
        </table></div>
                           </div>
                        </div>
                     </div>
                     <div class="ecni_x_info_box ecni_x_bg_alt">
                        <div class="info-box-content">
                           <div class="row">
                              <div class="col-12">
                                 <h5>Software</h5>
                                 <p class="info_data">Download software</p>
                                 <table id="assetIOList" class="table table__scroll table-xs" data-asset-id="' . $contract_id . '">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Version</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>';

    if ((!empty($dataTags)) and ($isDirEmpty === false)) {
        echo 'Place PDFs here';
    } else {
        echo '
                                 <p class="info_data">No software available.</p>
                                 ';
    }
    echo '
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.card -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
   </div>
</section>
';
} else {
    echo '<script type="text/javascript"> document.location = "error.php?t=404" </script>';
}