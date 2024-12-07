<?php
/********************************************
 ***   Contract Records function handler  ***
 ********************************************/
require '../../../../config/inc/func.inc.php';
require '../../../../vendor/autoload.php';

use Connect\PasswordHandler;

try {

    session_start();
    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;
    $contract_handler = new Connect\Contract;
    $file_manager_handler = new Connect\FileManager;
    $ajax_action = $_POST['ajax_action'];
    if (!array_key_exists('ajax_action', $_POST)) {
        $ajax_action = $_REQUEST['ajax_action'];
    }
    if (!empty($ajax_action)) {
        if ($ajax_action == 'getAllContracts') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $columns = array(
                    array('db' => 'contract_id', 'dt' => 0),
                    array('db' => 'contract_no', 'dt' => 1),
                    array('db' => 'mainKW', 'dt' => 2),
                    array('db' => 'mainKVA', 'dt' => 3),
                    array('db' => 'date_added', 'dt' => 4)
                );
                $data = $contract_handler->getAllContracts($columns);
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'getAllContractFiles') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $columns = array(
                    array('db' => 'contract_id', 'dt' => 0),
                    array('db' => 'file_id', 'dt' => 1),
                    array('db' => 'file_name', 'dt' => 2),
                    array('db' => 'operator_id', 'dt' => 3),
                    array('db' => 'operator_name', 'dt' => 4),
                    array('db' => 'upload_date', 'dt' => 5)
                );
                $data = $contract_handler->getAllContractFiles($columns);
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'getAllPendingContracts') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager() || $auth->isSalesStaff() || $auth->isTechnicalStaff())) {
                unset($_GET['csrf_token']);
                $columns = array(
                    array('db' => 'contract_id', 'dt' => 0),
                    array('db' => 'contract_no', 'dt' => 1),
                    array('db' => 'mainKW', 'dt' => 2),
                    array('db' => 'mainKVA', 'dt' => 3),
                    array('db' => 'date_added', 'dt' => 4),
                    array('db' => 'cm_full_name', 'dt' => 5),
                    array('db' => 'sm_full_name', 'dt' => 6),
                    array('db' => 'tm_full_name', 'dt' => 7),
                );
                $data = $contract_handler->getAllPendingContracts($columns);
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'validateContractNo') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $assetNo = $_POST['assValue'];
                $validateContractNo = $contract_handler->validateContractNo($assetNo);
                echo json_encode($validateContractNo);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'pullCompanyInfoCreate') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $company_id = $_POST['companyValue'];
                $data = $contract_handler->pullCompanyInfoCreate($company_id);
                $no_data = 'No Data';
                echo '
<div class="row">
   <div class="col-md-6 offset-md-3">
      <div class="ecni_x_info_box">
         <div class="info-box-content">
            <table>
               <tbody>
                  <tr>
                     <td>';
                echo '<span class="info_heading">Contact Name</span> ';
                if (!empty($data['contact_name'])) {
                    echo $data['contact_name'];
                } else {
                    echo $no_data;
                }
                echo '
                     </td>
                     <td>';
                echo '<span class="info_heading">Email</span> ';
                if (!empty($data['email'])) {
                    echo $data['email'];
                } else {
                    echo $no_data;
                }
                echo '
                     </td>
                  </tr>
                  <tr>
                     <td>';
                echo '<span class="info_heading">Tel</span> ';
                if (!empty($data['contact_tel'])) {
                    echo $data['contact_tel'];
                } else {
                    echo $no_data;
                }
                echo '
                     </td>
                     <td>';
                echo '<span class="info_heading">Fax</span> ';
                if (!empty($data['contact_fax'])) {
                    echo $data['contact_fax'];
                } else {
                    echo $no_data;
                }
                echo '
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
   </div>
</div>
<div class="row">
   <div class="col-md-3 offset-md-3">
      <div class="ecni_x_info_box ecni_x_bg_grey">
         <div class="info-box-content">
            <table>
               <tbody>
                  <tr>
                     <td>';
                echo '<span class="info_heading">Customer Address</span> ';
                if (!empty($data['address_line_1'])) {
                    echo '<span id="company_address">
                        <span data-name="address_line_1" data-value="' . $data['address_line_1'] . '">' . $data['address_line_1'] . '</span><br>
                        <span data-name="address_line_2" data-value="' . $data['address_line_2'] . '">' . $data['address_line_2'] . '</span><br>
                        <span data-name="address_line_3" data-value="' . $data['address_line_3'] . '">' . $data['address_line_3'] . '</span><br>
                        <span data-name="address_line_4" data-value="' . $data['address_line_4'] . '">' . $data['address_line_4'] . '</span><br>
                        <span data-name="address_line_5" data-value="' . $data['address_line_5'] . '">' . $data['address_line_5'] . '</span><br>
                        <span data-name="address_line_6" data-value="' . $data['address_line_6'] . '">' . $data['address_line_6'] . '</span><br>
                        </span>';
                } else {
                    echo $no_data;
                }
                echo '
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="col-md-3">
      <div class="ecni_x_info_box">
         <div class="info-box-content">
            <table>
               <tbody>
                  <tr>
                     <td>';
                echo '<span class="info_heading">Billing / Invoice Address</span> ';
                if (!empty($data['address_line_1'])) {
                    echo $data['i_address_line_1'] . '<br>' . $data['i_address_line_2'] . '<br>' . $data['i_address_line_3'] . '<br>' . $data['i_address_line_4'] . '<br>' . $data['i_address_line_5'] . '<br>' . $data['i_address_line_6'] . '<br>';
                } else {
                    echo $no_data;
                }
                echo '
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div id="postcode_lookup" class="col-md-6 col-md-push-3 col-sm-push-3 col-xs-12 form-group m-b-5"></div>
</div>
<div class="row">
   <div id="postcode_lookup_field" class="col-md-6 col-md-push-3 col-sm-push-3 col-xs-12 form-group m-b-5"></div>
</div>
<p>Delivery Address</p>';
                if (!empty($data['address_line_1'])) {
                    echo '
<div class="row">
   <div class="col-sm-4 text-right">
   <div class="border-checkbox-section">
<div class="border-checkbox-group border-checkbox-group-primary">
<input class="border-checkbox" type="checkbox" id="sameAddressStatic">
<label class="border-checkbox-label" for="sameAddressStatic">Click if same as above</label>
</div>
</div>
   </div>
</div>';
                }
                echo '<div id="delivery_address">
   <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="address_line_1">Address line 1 *</label>
      <div class="col-sm-9">
         <input type="text" id="d_address-line_1" data-name="d_address_line_1" name="d_address_line_1" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="address_line_2">Address line 2</label>
      <div class="col-sm-9">
         <input type="text" id="d_address-line_2" data-name="d_address_line_2" name="d_address_line_2" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="address_line_3">Address line 3 *</label>
      <div class="col-sm-9">
         <input type="text" id="d_address-line_3" data-name="d_address_line_3" name="d_address_line_3" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="address_line_4">Address line 4 </label>
      <div class="col-sm-9">
         <input type="text" id="d_address-line_4" data-name="d_address_line_4" name="d_address_line_4" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="address_line_5">Postal / Zip Code</label>
      <div class="col-sm-9">
         <input type="text" id="d_address_line_5" data-name="d_address_line_5"  name="d_address_line_5" class="form-control form-control-border form-control-sm companyData" >
      </div>
   </div>
   <div class="form-group row">
      <label class="col-sm-3 col-form-label" for="address_line_6">Country *</label>
      <div class="col-sm-9">
         <select class="form-control form-control-border form-control-sm select2 companyData" style="width: 100%;"
            id="d_address_line_6" data-name="d_address_line_6" name="d_address_line_6" required>
            ';
                countrySel();
                echo '
         </select>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
</div>
';
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'pullCompanyInfoCreate1') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $company_id = $_POST['companyValue'];
                $data = $contract_handler->pullCompanyInfoCreate($company_id);
                echo '
<div class="row">
   <div class="col-md-3 col-md-push-3 col-sm-push-3 col-sm-3 col-xs-12 form-group has-feedback">
      <input type="text" class="form-control has-feedback-left companyData" id="inputSuccess1" name="contact_name" value="' . $data['contact_name'] . '" placeholder="Full Contact Name" readonly>
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
   </div>
   <div class="col-md-3 col-md-push-3 col-sm-push-3 col-sm-3 col-xs-12 form-group has-feedback">
      <input type="email" class="form-control companyData" id="inputSuccess2" name="email" value="' . $data['email'] . '" placeholder="Email" readonly>
      <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
   </div>
</div>
<div class="row">
   <div class="col-md-3 col-md-push-3 col-sm-push-3 col-sm-3 col-xs-12 form-group has-feedback">
      <input type="number" class="form-control has-feedback-left companyData" value="' . $data['contact_tel'] . '" id="inputSuccess3" name="contact_tel" placeholder="Phone">
      <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
   </div>
   <div class="col-md-3 col-md-push-3 col-sm-3 col-sm-push-3 col-xs-12 form-group has-feedback">
      <input type="number" class="form-control companyData" id="inputSuccess4" value="' . $data['contact_fax'] . '" name="contact_fax" placeholder="Fax">
      <span class="fa fa-fax form-control-feedback right" aria-hidden="true"></span>
   </div>
</div>
<h4 class="StepTitle" style="margin-left: 15%;"> Customer Address </h4>
<div class="row">
   <div id="postcode_lookup" class="col-md-6 col-md-push-3 col-sm-push-3 col-xs-12 form-group m-b-5"></div>
</div>
<div class="row">
   <div id="postcode_lookup_field" class="col-md-6 col-md-push-3 col-sm-push-3 col-xs-12 form-group m-b-5"></div>
</div>
<div id="company_address">
   <div class="form-group row">
      <label for="address-line-1" class="col-sm-3 col-form-label text-right"> Address line 1
      <span class="required">*</span>
      </label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="address-line-1" name="address_line_1" data-name="address_line_1" value="' . $data['address_line_1'] . '" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label for="address-line-2" class="col-sm-3 col-form-label text-right">Address line 2</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="address-line-2" name="address_line_2" data-name="address_line_2" value="' . $data['address_line_2'] . '" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label for="address-line-3" class="col-sm-3 col-form-label text-right">Address line 3</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="address-line-3" name="address_line_3" data-name="address_line_3" value="' . $data['address_line_3'] . '" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label for="address-line-4" class="col-sm-3 col-form-label text-right"> Address line 4</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="address-line-4" name="address_line_4" data-name="address_line_4" value="' . $data['address_line_4'] . '" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label for="address-line-5" class="col-sm-3 col-form-label text-right"> Postal / Zip Code</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="address-line-5" name="address_line_5" data-name="address_line_5" value="' . $data['address_line_5'] . '" class="form-control form-control-border form-control-sm companyData" >
      </div>
   </div>
   <div class="form-group row">
      <label for="address-line-6" class="col-sm-3 col-form-label text-right">Country
      <span class="required">*</span></label>
      <div class="col-sm-6 col-xs-12">
         <select class="form-control form-control-border form-control-sm select2 companyData" style="width: 100%;"
            id="address-line-6" name="address_line_6" data-name="address_line_6" required>
            <option value="' . $data['address_line_6'] . '">' . $data['address_line_6'] . '</option>
            ';
                countrySel();
                echo '
         </select>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
</div>
<h4 class="StepTitle" style="margin-left: 15%;">Billing / Invoice Address</h4>
<div class="sgh--sub-checkbox">Click if same as above <input type="checkbox" id="sgh--sameAddress" onclick="sameAddress()"></div>
<div id="billing_address">
   <div class="form-group row">
      <label for="iaddress-line-1" class="col-sm-3 col-form-label text-right"> Address line 1
      <span class="required">*</span>
      </label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="iaddress-line-1" data-name="i_address_line_1" name="i_address_line_1" value="' . $data['i_address_line_1'] . '" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label for="iaddress-line-2" class="col-sm-3 col-form-label text-right">Address line 2</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="iaddress-line-2" data-name="i_address_line_2" name="i_address_line_2" value="' . $data['i_address_line_2'] . '" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label for="iaddress-line-3" class="col-sm-3 col-form-label text-right">Address line 3</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="iaddress-line-3" data-name="i_address_line_3" name="i_address_line_3" value="' . $data['i_address_line_3'] . '" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label for="iaddress-line-4" class="col-sm-3 col-form-label text-right"> Address line 4</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="iaddress-line-4" data-name="i_address_line_4" name="i_address_line_4" value="' . $data['address_line_4'] . '" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label for="iaddress-line-5" class="col-sm-3 col-form-label text-right"> Postal / Zip Code</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="iaddress-line-5" data-name="i_address_line_5" name="i_address_line_5" value="' . $data['i_address_line_5'] . '" class="form-control form-control-border form-control-sm companyData" >
      </div>
   </div>
   <div class="form-group row">
      <label for="iaddress-line-6" class="col-sm-3 col-form-label text-right">Country
      <span class="required">*</span></label>
      <div class="col-sm-6 col-xs-12">
         <select class="form-control form-control-border form-control-sm select2 companyData" style="width: 100%;"
            id="iaddress-line-6" data-name="i_address_line_6" name="i_address_line_6" required>
            <option value="' . $data['i_address_line_6'] . '">' . $data['i_address_line_6'] . '</option>
            ';
                countrySel();
                echo '
         </select>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
</div>
<h4 class="StepTitle" style="margin-left: 15%;">Delivery Address</h4>
<div class="sgh--sub-checkbox">Click if same as above <input type="checkbox" id="sgh--sameAddress_2" onclick="sameAddress_2()"></div>
<div id="delivery_address">
   <div class="form-group row">
      <label for="d_address-line_1" class="col-sm-3 col-form-label text-right"> Address line 1
      <span class="required">*</span>
      </label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="d_address-line_1" data-name="d_address_line_1" name="d_address_line_1" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label for="d_address-line_2" class="col-sm-3 col-form-label text-right">Address line 2</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="d_address-line_2" data-name="d_address_line_2" name="d_address_line_2" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label for="d_address-line_3" class="col-sm-3 col-form-label text-right">Address line 3</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="d_address-line_3" data-name="d_address_line_3" name="d_address_line_3" class="form-control form-control-border form-control-sm companyData" required>
         <div class="invalid-feedback">This field is required</div>
      </div>
   </div>
   <div class="form-group row">
      <label for="d_address-line_4" class="col-sm-3 col-form-label text-right"> Address line 4</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="d_address-line_4" data-name="d_address_line_4" name="d_address_line_4" class="form-control form-control-border form-control-sm companyData">
      </div>
   </div>
   <div class="form-group row">
      <label for="d_address-line_5" class="col-sm-3 col-form-label text-right"> Postal / Zip Code</label>
      <div class="col-sm-6 col-xs-12 input-group mb-3">
         <input type="text" id="d_address-line_5" data-name="d_address_line_5"  name="d_address_line_5" class="form-control form-control-border form-control-sm companyData" >
      </div>
   </div>
   <div class="form-group row">
      <label for="d_address-line_6" class="col-sm-3 col-form-label text-right">Country
      <span class="required">*</span></label>
      <div class="col-sm-6 col-xs-12">
         <select class="form-control form-control-border form-control-sm select2 companyData" style="width: 100%;"
            id="d_address-line_6" data-name="d_address_line_6" name="d_address_line_6" required>';
                countrySel();
                echo '</select>
<div class="invalid-feedback">This field is required</div>
      </div>
   </div>
</div>
';
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'pullCompanyInfoEdit') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $data = $contract_handler->pullCompanyInfoEdit();
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'getStyleOps') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $enc = $_POST["encValue"];
                $encType = $_POST["encType"];
                if ($encType == 'Canopy') {
                    if ($enc == 'Horizontal') {
                        $encStyleOptions = "
<option>--SELECT AN OPTION--</option>
<option id='Fixed' value='Fixed'>Fixed</option>
<option id='Transportable' value='Transportable'>Transportable</option>
<option id='TransportableTrailer' value='Transportable / Trailer Mounted'>Transportable / Trailer Mounted</option>
";
                    } elseif ($enc == 'Vertical') {
                        $encStyleOptions = "
<option>--SELECT AN OPTION--</option>
<option id='Fixed' value='Fixed'>Fixed</option>
<option id='Transportable' value='Transportable'>Transportable</option>
<option id='TransportableTrailer' value='Transportable / Trailer Mounted'>Transportable / Trailer Mounted</option>
<option id='Attenuated' value='Attenuated'>Attenuated</option>
";
                    } elseif (($enc == 'Container') or ($enc == 'Small Container')) {
                        $encStyleOptions = "
<option value='N/A'>N/A</option>
";
                    } else {
                        $encStyleOptions = "
<option>--SELECT AN OPTION--</option>
";
                    }
                    echo '
<div class="form-group row">
   <label for="encStyleSelect" class="col-sm-3 col-form-label text-right">Style</label>
   <div class="col-sm-6 col-xs-12">
      <select class="form-control form-control-sm" name="encStyle" id="encStyleSelect" onchange="getSizeOps()">';
                    echo $encStyleOptions;
                    echo '</select>
   </div>
</div>
<div class="form-group row">
   <label for="encSizeSelect" class="col-sm-3 col-form-label text-right">Size</label>
   <div class="col-sm-6 col-xs-12">
      <select class="form-control form-control-sm" name="encSize" id="encSizeSelect" onchange="getBaseOps()">
         <option>--SELECT AN OPTION--</option>
      </select>
   </div>
</div>
<div class="form-group row" id="encBaseCol">
<label for="encBaseSelect" class="col-sm-3 col-form-label text-right">
Base </label>
<div class="col-sm-6 col-xs-12">
   <select class="form-control form-control-sm" name="encBase" id="encBaseSelect">
      <option>--SELECT AN OPTION--</option>
   </select>
</div>
';
                }
                if ($encType == 'Container') {
                    if ($enc == 'Container') {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Mini Container'>Mini Container</option>
<option value='6FT Container'>6FT Container</option>
<option value='7FT Container'>7FT Container</option>
<option value='10FT Container'>10FT Container</option>
<option value='12FT Container'>12FT Container</option>
<option value='13FT Container'>13FT Container</option>
<option value='15FT Container'>15FT Container</option>
<option value='20FT Container'>20FT Container</option>
<option value='25FT Container'>25FT Container</option>
<option value='30FT Container'>30FT Container</option>
<option value='40FT Container'>40FT Container</option>
";
                    } elseif ($enc == 'Small Container') {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Small Container (1 Fan)'>Small Container (1 Fan)</option>
<option value='Small Container (2 Fan)'>Small Container (2 Fan)</option>
<option value='Small Container (3 Fan)'>Small Container (3 Fan)</option>
";
                    } else {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
";
                    }
                    echo '
<div class="form-group row">
   <label for="encSizeSelect" class="col-sm-3 col-form-label text-right">Size</label>
   <div class="col-sm-6 col-xs-12">
      <select class="form-control form-control-sm size" name="encSize" id="encSizeSelect">';
                    echo $encSizeOptions;
                    echo '</select>
   </div>
</div>
<div class="form-group row" id="encLiftingCol">
   <label for="encLifting" class="col-sm-3 col-form-label text-right">Lifting</label>
   <div class="col-sm-6 col-xs-12">
      <select class="form-control form-control-sm" name="encLifting" id="encLifting">
         <option>--SELECT AN OPTION--</option>
         <option value="Standard">Standard</option>
         <option value="DMV">DMV</option>
      </select>
   </div>
</div>
<div class="form-group row" id="encHeightCol">
   <label for="encHeight" class="col-sm-3 col-form-label text-right">Height</label>
   <div class="col-sm-6 col-xs-12">
      <input type="text" placeholder="Enter container\'s height"
         name="encHeight" id="encHeight" class="form-control form-control-border form-control-sm">
   </div>
</div>
';
                }
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'getSizeOps') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $enc = $_POST["encValue"];
//                $encType = $_POST["encType"];
                $encStyle = $_POST["encStyle"];
                if ($enc == 'Horizontal') {
                    $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='10kW'>10kW</option>
<option value='30kW'>30kW</option>
<option value='100kW'>100kW</option>
<option value='300kW'>300kW</option>
<option value='400kW'>400kW</option>
<option value='600kW'>600kW</option>
";
                } elseif ($enc == 'Vertical') {
                    if ($encStyle == 'Fixed') {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='500kW (2 fan)'>500kW (2 fan)</option>
<option value='1000kW (3 fan)'>1000kW (3 fan)</option>
<option value='1200kW (3 fan)'>1200kW (3 fan)</option>
<option value='1600kW (4 fan)'>1600kW (4 fan)</option>
<option value='2000kW (5 fan)'>2000kW (5 fan)</option>
<option value='2400kW (6 fan)'>2400kW (6 fan)</option>
";
                    } elseif ($encStyle == 'Transportable') {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='1000kW (3 fan)'>1000kW (3 fan)</option>
<option value='1200kW (3 fan)'>1200kW (3 fan)</option>
<option value='1600kW (4 fan)'>1600kW (4 fan)</option>
";
                    } elseif ($encStyle == 'Transportable / Trailer Mounted') {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='1000kW (3 fan)'>1000kW (3 fan)</option>
<option value='1200kW (3 fan)'>1200kW (3 fan)</option>
<option value='1600kW (4 fan)'>1600kW (4 fan)</option>
";
                    } elseif ($encStyle == 'Attenuated') {
                        $encSizeOptions = "
<option>--SELECT AN OPTION--</option>
<option value='1000kW (3 fan)'>1000kW (3 fan)</option>
<option value='1600kW (4 fan)'>1600kW (4 fan)</option>
<option value='2000kW (5 fan)'>2000kW (5 fan)</option>
";
                    }
                }
                echo $encSizeOptions;
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'getBaseOps') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $enc = $_POST["encValue"];
                $encStyle = $_POST["encStyle"];
                $encSize = $_POST["encSize"];
                if ($enc == 'Horizontal') {
                    if ($encStyle == 'Fixed') {
                        if ($encSize == '10kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
";
                        } elseif ($encSize == '30kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
";
                        } elseif ($encSize == '100kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
";
                        } elseif ($encSize == '300kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
<option value='Stillage'>Stillage</option>
";
                        } elseif ($encSize == '400kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
";
                        } elseif ($encSize == '600kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
<option value='Crash Pack'>Crash Pack</option>
";
                        } else {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
";
                        }
                    } elseif ($encStyle == 'Transportable') {
                        if ($encSize == '10kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
";
                        } elseif ($encSize == '30kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Crash Pack'>Crash Pack</option>
";
                        } elseif ($encSize == '100kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
<option value='Crash Pack'>Crash Pack</option>
";
                        } elseif ($encSize == '300kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
<option value='Crash Pack'>Crash Pack</option>
";
                        } elseif ($encSize == '400kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
";
                        } elseif ($encSize == '600kW') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Channel'>Channel</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
<option value='Crash Pack'>Crash Pack</option>
";
                        } else {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
";
                        }
                    } elseif ($encStyle == 'Transportable / Trailer Mounted') {
                        $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
";
                    } else {
                        $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
";
                    }
                } elseif ($enc == 'Vertical') {
                    if ($encStyle == 'Fixed') {
                        if ($encSize == '500kW (2 fan)') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
";
                        } elseif (($encSize == '1000kW (3 fan)') or ($encSize == '1200kW (3 fan)')) {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
";
                        } elseif (($encSize == '1600kW (4 fan)') or ($encSize == '2000kW (5 fan)') or ($encSize == '2400kW (6 fan)')) {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Fork Base'>Fork Base</option>
";
                        }
                    } elseif ($encStyle == 'Transportable') {
                        if (($encSize == '1000kW (3 fan)') or ($encSize == '1200kW (3 fan)')) {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Castors'>Castors</option>
<option value='Fork Base'>Fork Base</option>
<option value='Fork Base with Castors'>Fork Base with Castors</option>
";
                        } elseif ($encSize == '1600kW (4 fan)') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Fork Base'>Fork Base</option>
";
                        } else {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
";
                        }
                    } elseif ($encStyle == 'Transportable / Trailer Mounted') {
                        if (($encSize == '1000kW (3 fan)') or ($encSize == '1200kW (3 fan)')) {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Angles'>Angles</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
";
                        } elseif ($encSize == '1600kW (4 fan)') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Fork Base'>Fork Base</option>
";
                        } else {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
";
                        }
                    } elseif ($encStyle == 'Attenuated') {
                        if ($encSize == '1000kW (3 fan)') {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Channel'>Channel</option>
<option value='Fork Base'>Fork Base</option>
";
                        } elseif (($encSize == '1600kW (4 fan)') or ($encSize == '2000kW (5 fan)')) {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
<option value='Fork Base'>Fork Base</option>
";
                        } else {
                            $encBaseOptions = "
<option>--SELECT AN OPTION--</option>
";
                        }
                    }
                }
                echo $encBaseOptions;
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }

        if ($ajax_action == 'pullElectricalSpecificationForm') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $current_flow = $_POST["current_flow"];
                $load_type = $_POST["load_type"];
                $config = $_POST["config"];
                $usage_frequency = $_POST["usage_frequency"];
                $request_id = json_decode($_POST['request_id'], true);
                if (!empty($request_id)) {
                    $contract_info = $contract_handler->getContractInfo($request_id);
                }


                if ($current_flow == 'AC') {
                    if ($load_type == 'Resistive') {
                        if (($config == 'Star') || ($config == 'Delta')) {
                            echo '<h4>Power rating</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKW">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW" value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKW'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                                <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyV">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyV'] . '">' . $contract_info['supplyV'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHz">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHz'] . '">' . $contract_info['supplyHz'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyPH">
                                                                    <label>PH</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyPH">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyPH'] . '">' . $contract_info['supplyPH'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "2") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "3") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "4") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                        }
                        if ($config == 'Single Phase') {
                            echo '<h4>Power rating</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="contract_no">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW" value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKW'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                                <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyV">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyV'] . '">' . $contract_info['supplyV'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHz">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHz'] . '">' . $contract_info['supplyHz'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyPH">
                                                                    <label>PH</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyPH" disabled>
                                                                            <option value="1">1</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox" checked>
                                                                                      <span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox" disabled>
                                                                                      <span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox" disabled>
                                                                                      <span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                        }
                        if ($config == 'Star/Delta') {
                            echo '<h4>Power rating</h4>
                          <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKW">kW <small>Star</small> *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW" value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKW'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKWSD">kW  <small>Delta</small> *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKWSD" name="mainKWSD" value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKWSD'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                            </div>
                          </div>
                          <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS <small>Star</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyV">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyV'] . '">' . $contract_info['supplyV'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz <small>Star</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHz">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHz'] . '">' . $contract_info['supplyHz'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS <small>Delta</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyVSD">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyVSD'] . '">' . $contract_info['supplyVSD'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz <small>Delta</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHzSD">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHzSD'] . '">' . $contract_info['supplyHzSD'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyPH">
                                                                    <label>PH</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyPH">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyPH'] . '">' . $contract_info['supplyPH'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "2") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "3") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "4") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<div class="well" style="background-color: #fff;" id="ac_res_sd">
                                                        <div class="row">
                                                            <h4>Power rating</h4>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="' . $contract_info['mainKW'] . '" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">Star kW: *</label>
            </span>
                                                            </div>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKWSD" type="number" value="' . $contract_info['mainKWSD'] . '" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">Delta kW: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Star</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyV">
                                                                        <option selected value="' . $contract_info['supplyV'] . ' "
                                                                        ' . $contract_info['supplyV'] . '
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz
                                                                        <small>Star</small>
                                                                    </label>
                                                                    <select class="form-control"
                                                                            name="supplyHz">
                                                                        <option selected value="' . $contract_info['supplyHz'] . '"
                                                                        ' . $contract_info['supplyHz'] . '
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Delta</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVSD">
                                                                        <option selected value="' . $contract_info['supplyVSD'] . '">
                                                                            ' . $contract_info['supplyVSD'] . '
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz
                                                                        <small>Delta</small>
                                                                    </label>
                                                                    <select class="form-control" name="supplyHzSD">
                                                                        <option selected
                                                                                value="' . $contract_info['supplyHzSD'] . '"> .
                                                                            ' . $contract_info['supplyHzSD'] . ' 
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>PH</label>
                                                                    <select class="form-control" name="supplyPH">
                                                                        <option selected value="' . $contract_info['supplyPH'] . '"
                                                                        ' . $contract_info['supplyPH'] . '
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"
                                                                                ';
                            if (strpos($contract_info['supplyW'], "2") !== false) {
                                echo "checked";
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"
                                                                                ';
                            if (strpos($contract_info['supplyW'], "3") !== false) {
                                echo "checked";
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"
                                                                                ';
                            if (strpos($contract_info['supplyW'], "4") !== false) {
                                echo "checked";
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                        }
                    } else if ($load_type == 'Resistive/Reactive') {
                        if (($config == 'Star') || ($config == 'Delta')) {
                            echo '<h4>Power rating</h4>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKVA">kVA *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKVA" name="mainKVA" placeholder="5000"
                                       value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKVA'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKVA_res"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainPF">Power Factor *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainPF" name="mainPF" placeholder="0.6"
                                       value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainPF'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainPF_res"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKW">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW"
                                                value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKW'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" 
                                                required="" readonly>
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                            </div>
                        </div>
                                <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyV">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyV'] . '">' . $contract_info['supplyV'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHz">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHz'] . '">' . $contract_info['supplyHz'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyPH">
                                                                    <label>PH</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyPH">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyPH'] . '">' . $contract_info['supplyPH'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "2") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "3") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "4") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                        }
                        if ($config == 'Star/Delta') {
                            echo '<h4>Power rating</h4>
                            <p>Star</p>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKVA">kVA *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKVA" name="mainKVA" placeholder="5000"
                                       value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKVA'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKVA_res"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainPF">Power Factor *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainPF" name="mainPF" placeholder="0.6"
                                       value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainPF'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainPF_res"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKW">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW"
                                                value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKW'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" 
                                                required="" readonly>
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                            </div>
                        </div>
                        <p>Delta <small>if required</small></p>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKVASD">kVA *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKVASD" name="mainKVASD" placeholder="5000"
                                       value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKVASD'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKVASD_res"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainPFSD">Power Factor *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainPFSD" name="mainPFSD" placeholder="0.6"
                                       value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainPFSD'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainPFSD_res"></span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKWSD">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKWSD" name="mainKWSD"
                                                value="';
                            if (!empty($request_id)) {
                                echo $contract_info['mainKWSD'];
                            }
                            echo '" class="form-control form-control-border form-control-sm" 
                                                required="" readonly>
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKWSD_res"></span>
                                 </div>
                            </div>
                        </div>
                          <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS <small>Star</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyV">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyV'] . '">' . $contract_info['supplyV'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz <small>Star</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHz">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHz'] . '">' . $contract_info['supplyHz'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS <small>Delta</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyVSD">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyVSD'] . '">' . $contract_info['supplyVSD'] . '</option>';
                            }
                            echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz <small>Delta</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyHzSD">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyHzSD'] . '">' . $contract_info['supplyHzSD'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyPH">
                                                                    <label>PH</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyPH">';
                            if (!empty($request_id)) {
                                echo '<option value="' . $contract_info['supplyPH'] . '">' . $contract_info['supplyPH'] . '</option>';
                            }
                            echo '
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "2") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "3") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"';
                            if (!empty($request_id)) {
                                if (strpos($contract_info['supplyW'], "4") !== false) {
                                    echo "checked";
                                }
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
<div class="well" style="background-color: #fff;" id="ac_res_sd">
                                                        <div class="row">
                                                            <h4>Power rating</h4>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="' . $contract_info['mainKW'] . '" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">Star kW: *</label>
            </span>
                                                            </div>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKWSD" type="number" value="' . $contract_info['mainKWSD'] . '" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">Delta kW: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Star</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyV">
                                                                        <option selected value="' . $contract_info['supplyV'] . ' "
                                                                        ' . $contract_info['supplyV'] . '
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz
                                                                        <small>Star</small>
                                                                    </label>
                                                                    <select class="form-control"
                                                                            name="supplyHz">
                                                                        <option selected value="' . $contract_info['supplyHz'] . '"
                                                                        ' . $contract_info['supplyHz'] . '
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Delta</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVSD">
                                                                        <option selected value="' . $contract_info['supplyVSD'] . '">
                                                                            ' . $contract_info['supplyVSD'] . '
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz
                                                                        <small>Delta</small>
                                                                    </label>
                                                                    <select class="form-control" name="supplyHzSD">
                                                                        <option selected
                                                                                value="' . $contract_info['supplyHzSD'] . '"> .
                                                                            ' . $contract_info['supplyHzSD'] . ' 
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>PH</label>
                                                                    <select class="form-control" name="supplyPH">
                                                                        <option selected value="' . $contract_info['supplyPH'] . '"
                                                                        ' . $contract_info['supplyPH'] . '
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"
                                                                                ';
                            if (strpos($contract_info['supplyW'], "2") !== false) {
                                echo "checked";
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"
                                                                                ';
                            if (strpos($contract_info['supplyW'], "3") !== false) {
                                echo "checked";
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"
                                                                                ';
                            if (strpos($contract_info['supplyW'], "4") !== false) {
                                echo "checked";
                            }
                            echo '
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                        }
                    }
                } else if ($current_flow == 'DC Constant Current') {
                    if ($config == 'Single Phase') {
                        echo '<h4>Power rating</h4>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKW">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW" value="';
                        if (!empty($request_id)) {
                            echo $contract_info['mainKW'];
                        }
                        echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                                <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS <small>Min</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyV">';
                        if (!empty($request_id)) {
                            echo '<option value="' . $contract_info['supplyV'] . '">' . $contract_info['supplyV'] . '</option>';
                        }
                        echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="col-form-label">VOLTS <small>Max</small></label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="supplyVSD">';
                        if (!empty($request_id)) {
                            echo '<option value="' . $contract_info['supplyVSD'] . '">' . $contract_info['supplyVSD'] . '</option>';
                        }
                        echo '
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                    </div>';
                    }
                } else if ($current_flow == 'DC Constant Voltage') {
                    if ($config == 'Single Phase') {
                        echo '<h4>Power rating</h4>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-xs-12">
                                                            <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainKW">kW *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainKW" name="mainKW" value="';
                        if (!empty($request_id)) {
                            echo $contract_info['mainKW'];
                        }
                        echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainKW_res"></span>
                                 </div>
                                 </div>
                                 <div class="col-sm-6 col-xs-12">
                                                            <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="mainAMPS">AMPS *</label>
                                    <div class="col-sm-9">
                                       <input type="number" id="mainAMPS" name="mainAMPS" value="';
                        if (!empty($request_id)) {
                            echo $contract_info['mainAMPS'];
                        }
                        echo '" class="form-control form-control-border form-control-sm" required="">
                                       <div class="invalid-feedback">
                                          This field is required
                                       </div>
                                    </div>
                                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="mainAMPS_res"></span>
                                 </div>
                                 </div>';
                    }
                }
//        echo $electric_spec;
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'addContract') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['range']);
                unset($_POST['range_temp_C']);
                unset($_POST['control_info']);
                unset($_POST['enc']);
                unset($_POST['enc_finishType']);
                $contractsArr = $_POST;
                $controlArrKeys = array(
                    'controller', 'controller_sub', 'controller_packages', 'interconnecting_packages', 'control_info'
                );
                $controlArr = array_intersect($controlArrKeys, $contractsArr);

                unset($contractsArr['controller'], $contractsArr['controller_sub'], $contractsArr['controller_packages'], $contractsArr['interconnecting_packages'], $contractsArr['control_info']);
//                $contractsArr = array_delete($controlArrKeys, $contractsArr);
                $addContract = $contract_handler->addContract($contractsArr, $controlArr);
//                echo json_encode($controlArr);
//                echo json_encode($contractsArr);
                echo json_encode($addContract);
            } else {
                echo json_encode($result['arr'] = 'not');
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateContract') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['range']);
                unset($_POST['control_info']);
                unset($_POST['enc']);
                unset($_POST['enc_finishType']);
                $request_id = json_decode($_POST['request_id'], true);
                unset($_POST['request_id']);
                $contractsArr = $_POST;
                $controlArrKeys = array(
                    'controller_id', 'controller', 'controller_sub', 'controller_packages', 'interconnecting_packages', 'control_info'
                );
                $controlArr = array_intersect($controlArrKeys, $contractsArr);

                unset($contractsArr['controller_id'], $contractsArr['controller'], $contractsArr['controller_sub'], $contractsArr['controller_packages'], $contractsArr['interconnecting_packages'], $contractsArr['control_info']);
//                $contractsArr = array_delete($controlArrKeys, $contractsArr);
                $action_ed = $contract_handler->updateContract($request_id, $contractsArr, $controlArr);
//                echo json_encode($controlArr);
//                echo json_encode($contractsArr);
                echo json_encode($action_ed);
//                echo json_encode($result['arrme'] = 'not1');
//                echo 'hi';
            } else {
//                echo 'hi7';
//                echo json_encode($result['arrme'] = 'not');
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'signContract') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = $_POST['request_id'];
                unset($_POST['request_id']);
                if ($auth->isContractManager()) {
                    $authorised_type = 'salesCheck1';
                    $role_id = '8'; //Sales Staff
                } elseif ($auth->isSalesStaff()) {
                    $authorised_type = 'salesCheck2';
                    $role_id = '9'; //Technical Staff
                } elseif ($auth->isTechnicalStaff()) {
                    $authorised_type = 'salesCheck3';
                    $notify_do = true;
                } else {
                    http_response_code(401);
                    throw new Exception("Unauthorized to perform approval");
                }
                $action_ed = $contract_handler->signContract($request_id, $authorised_type);
                if ($action_ed['stat'] = 'success') {
                    $appConfig = Connect\AppConfig::pullMultiSettings(array("from_email", "base_url", "dev_url", "design_office_email"));
                    if (isset($role_id)) {
                        $action_ed_2 = $contract_handler->sendContractApprovalNotification($role_id, $request_id, $appConfig);
                        echo json_encode($action_ed_2);
                    }
                    if (isset($notify_do) && ($notify_do == true)) {
                        $action_ed_2 = $contract_handler->sendDONotification($appConfig, $request_id);
                        echo json_encode($action_ed_2);
                    }
                } else {
                    http_response_code(401);
                    throw new Exception("Unauthorized");
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
//Contract Page functions
        if ($ajax_action == 'setContractSoftware') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $_POST['contract_id'] = json_decode($_POST['contract_id'], true);
                $action_ed = $contract_handler->setContractSoftware($_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'unsetContractSoftware') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $_POST['contract_id'] = json_decode($_POST['contract_id'], true);
                $action_ed = $contract_handler->unsetContractSoftware($_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateAssetUsers') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = json_decode($_POST['request_id'], true);
                $_assigned = json_decode($_POST['_assigned'], true);
                $action_ed = $contract_handler->updateAssetUsers($_assigned, $request_id);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if (($ajax_action == 'updateContractSiteAddress') || ($ajax_action == 'deleteContractSiteAddress')) {
            $request_id = json_decode($_POST['request_id'], true);
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['request_id']);

                $action_ed = $contract_handler->updateContractSiteAddress($request_id, $_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }

        if ($ajax_action == 'uploadContractFiles') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager() || $auth->isDesignEngineer())) {
                unset($_GET['csrf_token']);
                $file_to_action = $_FILES['file'];
                $request_id = json_decode($_POST['request_id'], true);
                $dir_target = 'contract';
                $data = $file_manager_handler->uploadFiles($file_to_action, $dir_target, $request_id, true);
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'deleteContractFile') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager() || $auth->isDesignEngineer())) {
                unset($_GET['csrf_token']);
                $file_to_action = $_POST['file_name'];
                $request_id = json_decode($_POST['request_id'], true);
                $dir_target = 'contract';
                $data = $file_manager_handler->deleteFile($file_to_action, $dir_target, $request_id, true);
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
//        if ($ajax_action == 'getAssignedSoftware') {
//            if ($request->valid_token() && ($auth->isLoggedIn())) {
//                $contract_id = $_POST['contract_id'];
//
//                $action_ed = $contract_handler->getAssignedSoftware($contract_id);
//                echo json_encode($action_ed);
//            } else {
//                http_response_code(401);
//                throw new Exception("Unauthorized");
//            }
//        }

        if ($ajax_action == 'getAssignedSoftware') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_GET['csrf_token']);
                $contract_id = $_POST['contract_id'];
                $columns = array(
                    array('db' => 'software_id', 'dt' => 0),
                    array('db' => 'software_value', 'dt' => 1),
                    array('db' => 'software_description', 'dt' => 2),
                    array('db' => 'software_extension', 'dt' => 3),
                    array('db' => 'software_version', 'dt' => 4),
                    array('db' => 'software_exists', 'dt' => 5)
                );
                $data = $contract_handler->getAssignedSoftware($columns, $contract_id);
//                $_FILE_TARGET = 'D:\xampp\htdocs\Dropbox\www\sites\crestchic\portal-crestchic.com_1/console/modules/file_server/io/Corona220.zip';
//                if (file_exists($_FILE_TARGET)) {
//                    $data[] = array('db' => 'software_exists', 'dt' => 5, 'd8' => 'true');
//                } else{
//                    $data[] = array('false' => 'software_exists', 'dt' => 5, 'd8' => 'false');
//                }
                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'setAssetUPin') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $contract_id = $_POST['contract_id'];
                unset($_POST['contract_id']);
                $unique_pwd = passwordGenerator();
                $encryptedPwd = PasswordHandler::encryptPw($unique_pwd);
                $config = Connect\AppConfig::pullMultiSettings(array("password_policy_enforce", "password_min_length"));
                $pwresp = Connect\PasswordHandler::validatePolicy($unique_pwd, $unique_pwd, (bool)$config["password_policy_enforce"], (int)$config["password_min_length"]);
                $dataArr = array('contract_id' => $contract_id, 'contract_pin' => $unique_pwd, 'contract_pwd' => $encryptedPwd);
//Validation passed
                if ($pwresp['status'] == 1) {
                    $action_ed = $contract_handler->setAssetUPin($dataArr);
//Success
                    if (!$action_ed['status']) {
//DB Failure
                        Connect\MiscFunctions::mySqlErrors($action_ed['err_message']);
                    }
                    echo json_encode($action_ed);
                } else {
//Password Failure
                    echo $pwresp['message'];
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}