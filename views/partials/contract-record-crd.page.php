<?php
$contract_handler = new Connect\Contract;
if (!empty($_REQUEST['iA'])) {
        $request_id = $_GET['iA'];
        $contract_info = $contract_handler->getContractInfo($request_id);
        foreach ($contract_info as $key=>$value) {
            $contract_info[$key] = str_replace(' ', '', $value);
            if (empty($value)) {
                $contract_info[$key] = "-";
            }
        }
        echo '<div class="row">
                        <div class="col-sm-8 offset-2 text-center mb-2">
                        <button class="btn btn-primary-1 btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Approve</button>
                        </div>
                        </div>

<div class="offcanvas offcanvas-bottom ts_offcanvas_xs" data-bs-backdrop="false" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Approve</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
  <form id="form_sign_contract" data-role="update" data-xeid="' . $contract_info['contract_id'] . '" onsubmit="return false"
                              enctype="multipart/form-data">
  <div class="row">
                        <div class="col-sm-8 offset-2 text-center">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           onchange="document.getElementById(\'signContract\').disabled
                                            = !this.checked;"/> Yes,  I have checked the Contract Review Sheet for C' . $contract_info['contract_no'] . '
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary-1 btn-sm" id="signContract" disabled
                            data-role="form_submit_btn"
                            data-action="signContract" onclick="clientPost(this.id,form.id)">Sign
                    </button>
                        </div>
                    </div>
                    
                    </form>
  </div>
</div>
    <page size="A4" class="padding_A4 crd_layout">
        <div class="crd_page_header"><h1>Contract Review Document</h1></div>              
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
            echo ' - '.$contract_info['controller_sub'].' - '.$contract_info['controller_packages'].' - '.$contract_info['interconnecting_packages'];
        } echo '
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
                              <td>' . $contract_info['enclosure'].'</td>
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
                              <td>' . $contract_info['encHeight'].'</td>
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
                              <td>' . $contract_info['otherInfo'].'</td>
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
            $signature1 = '../img/signatures/' . $contract_info['salesCheck1By'].'.png';
            echo '
                              <td>';
            if (file_exists($signature1)) {
                echo '<img class="sgh_sign_img" src="'.$signature1.'" alt="signature1">';
            } else {
                echo 'Signed';
            }
            echo '
                              </td>
                              <td>'.$contract_info['salesCheck1Date'] .'</td>
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
            $signature2 = '../img/signatures/' . $contract_info['salesCheck2By'].'.png';
            echo '
                              <td>';
            if (file_exists($signature2)) {
                echo '<img class="sgh_sign_img" src="'.$signature2.'" alt="signature2">';
            } else {
                echo 'Signed';
            }
            echo '
                              </td>
                              <td>'.$contract_info['salesCheck2Date'] .'</td>
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
            $signature3 = '../img/signatures/' . $contract_info['salesCheck3By'].'.png';
            echo '
                              <td>';
            if (file_exists($signature3)) {
                echo '<img class="sgh_sign_img" src="'.$signature3.'" alt="signature3">';
            } else {
                echo 'Signed';
            }
            echo '
                              </td>
                              <td>'.$contract_info['salesCheck3Date'] .'</td>
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
</page>
<div class="modal fade" id="sign_1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sign</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="formSignHere" data-xeid="' . $contract_info['contract_id'] . '">
            <div class="modal-body">
              <p> I have checked the Contract Review Sheet for C' . $contract_info['contract_id'] . '</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn sgh--btn-dark sgh--modal-close" data-dismiss="modal" onclick="sgh_clear_response(this.form.id)">Close</button>
                <button type="button" class="btn sgh--btn-inverse-dark submit_btn" id="sign_btn" data-action="signContract" onclick="openSignContract(this.id,form.id)">
                    <span class="label">Sign</span>
                </button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
</div>';
} else {
    echo '<script type="text/javascript"> document.location = "error.php?t=404" </script>';
}