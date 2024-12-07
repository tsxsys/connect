<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../config/inc/func.inc.php';
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
$user_handler = new Connect\UserHandler;
$contract_handler = new Connect\Contract;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $member_type = 'customer';
        $client_info = $user_handler->getCustomerInfo($member_type, $request_id);
        $company_options = $user_handler->getAllCompanyOptions();
        echo '
<input type="hidden" data-bs-toggle="modal" data-bs-target="#x_' . $request_id . '99">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="x_' . $request_id . '99Label"
   aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="x_' . $request_id . '99Label">' . $client_info['firstname'] . ' ' . $client_info['lastname'] . '</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
               <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">Info</button>
                  <div class="slide"></div>
               </li>
               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contract_association-tab" data-bs-toggle="tab" data-bs-target="#contract_association" type="button" role="tab" aria-controls="contract_association" aria-selected="false">Contract Association</button>
                  <div class="slide"></div>
               </li>
            </ul>
            <div class="tab-content ts_tab_content" id="myTabContent">
               <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-12">
                              <form class="form-horizontal" id="edit_conpany_form" data-role="" data-xeid="' . $request_id . '"
                                 enctype="multipart/form-data" onsubmit="return false">
                                 <p>
                                    <i class="fa fa-info-circle"></i> Contact Infoformation
                                 </p>
                                 <div class="p-10">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="firstname">First Name *</label>
                                       <div class="col-sm-9">
                                          <input type="text"
                                             class="form-control form-control-border form-control-sm" name="firstname"
                                             id="firstname" value="' . $client_info['firstname'] . '" required>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="lastname">Last Name *</label>
                                       <div class="col-sm-9">
                                          <input type="text"
                                             class="form-control form-control-border form-control-sm" name="lastname" 
                                             id="lastname" value="' . $client_info['lastname'] . '"  required>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="phone">Phone</label>
                                       <div class="col-sm-9">
                                          <input type="tel"
                                             class="form-control form-control-border form-control-sm" name="phone" 
                                             id="phone" value="' . $client_info['phone'] . '">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <div class="col-md-4 offset-md-4">
                                          <div class="text-center message" id="create_user_message"></div>
                                       </div>
                                    </div>
                                 </div>
                                 <p>
                                    <i class="fa fa-info-circle"></i> Company Address
                                 </p>
                                 <div class="p-10" id="company_address">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="address_line_1">Address line 1 *</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="address_line_1" name="address_line_1" data-name="address_line_1" value="' . $client_info['address_line_1'] . '" class="form-control form-control-border form-control-sm companyData" required>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="address_line_2">Address line 2</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="address_line_2" name="address_line_2" data-name="address_line_2" value="' . $client_info['address_line_2'] . '" class="form-control form-control-border form-control-sm companyData">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="address_line_3">Address line 3 *</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="address_line_3" name="address_line_3" data-name="address_line_3" value="' . $client_info['address_line_3'] . '" class="form-control form-control-border form-control-sm companyData">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="address_line_4">Address line 4 </label>
                                       <div class="col-sm-9">
                                          <input type="text" id="address_line_4" name="address_line_4" data-name="address_line_4" value="' . $client_info['address_line_4'] . '" class="form-control form-control-border form-control-sm companyData">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="address_line_5">Postal / Zip Code</label>
                                       <div class="col-sm-9">
                                          <input type="text" id="address_line_5" name="address_line_5" data-name="address_line_5" value="' . $client_info['address_line_5'] . '" class="form-control form-control-border form-control-sm companyData" >
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="address_line_6">Country *</label>
                                       <div class="col-sm-9">
                                          <select class="form-control form-control-border form-control-sm companyData" style="width: 100%;"
                                             id="address_line_6" name="country" data-name="country">
                                             <option value="' . $client_info['address_line_6'] . '">' . $client_info['address_line_6'] . '</option>';
        countrySel();
        echo '
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-md-4 offset-md-4 text-center">
                                       <button type="submit" class="btn btn-primary-1 btn-sm" 
                                          data-role="form_submit_btn" data-action="editCustomerInfo"
                                          id="edit_customer_info" onclick="clientPost(this.id, form.id)">
                                       <span class="btn-label">Update</span>
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-12 mb-5">
                              <p>
                                 <i class="fa fa-info-circle"></i> Associated Company Information
                              </p>
                              <form class="form-horizontal" id="edit_cus_ac_form" data-role="" data-xeid="' . $request_id . '"
                                 enctype="multipart/form-data" onsubmit="return false">
                                 <div class="p-10">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="company_id">Associated Company *</label>
                                       <div class="col-sm-9">
                                          <select class="form-control form-control-border form-control-sm select2 companyData" style="width: 100%;"
                                             id="company_id" name="company_id" data-name="company_id">
                                             <option value="' . $client_info['company_id'] . '">' . $client_info['company_name'] . '</option>
                                             ' . implode("", $company_options) . '
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-md-4 offset-md-4 text-center">
                                       <button type="submit" class="btn btn-primary-1 btn-sm" 
                                          data-role="form_submit_btn" data-action="updateCustomerAC"
                                          id="edit_cus_ac" onclick="clientPost(this.id, form.id)">
                                       <span class="btn-label">Update</span>
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 mb-5">
                              <form class="form-horizontal" id="edit_cus_email_form" data-role="" data-xeid="' . $request_id . '"
                                 enctype="multipart/form-data" onsubmit="return false">
                                 <div class="p-10">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label" for="email">Email *</label>
                                       <div class="col-sm-9">
                                          <input type="email"
                                             class="form-control form-control-border form-control-sm" name="email" 
                                             id="email" value="' . $client_info['email'] . '"  required>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <div class="col-md-4 offset-md-4 text-center">
                                       <button type="submit" class="btn btn-primary-1 btn-sm" 
                                          data-role="form_submit_btn" data-action="editClientEmail"
                                          id="edit_customer_email" onclick="clientPost(this.id, form.id)">
                                       <span class="btn-label">Update Email</span>
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                        <p>
                           <i class="fa fa-info-circle"></i> Reset Password Here
                        </p>
                        <div class="row">
                           <div class="col-12 mb-5">
                              <form class="form-horizontal" id="customer_pwd_reset_form" data-role="" data-xeid="' . $request_id . '"
                                 enctype="multipart/form-data" onsubmit="return false">
                                 <div class="form-group row">
                                    <div class="col-md-4 offset-md-4 text-center">
                                       <button type="submit" class="btn btn-primary-1 btn-sm" 
                                          data-role="form_submit_btn" data-action="customerPwdReset"
                                          id="customer_pwd_reset" onclick="clientPost(this.id, form.id)">
                                       <span class="btn-label">Reset Password</span>
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="contract_association" role="tabpanel" aria-labelledby="contract_association-tab">
                  <form id="form_users_contracts" data-role="update" data-xeid="'. $request_id .'" onsubmit="return false"
                              enctype="multipart/form-data">
                      <div class="row m-t-50">
                     <p><i class="fa fa-info-circle"></i> Select contracts to assign to this user.</p>
                     <div class="col-md-8 col-sm-12 offset-md-2 text-center">
                        <div class="row">
                           <div class="col-12">
                              <button type="button" id="assign_contracts_rightAll"
                                 class="btn btn-primary-1 btn-sm m-b-10">
                              select all
                              </button>
                              <button type="button" id="assign_contracts_leftSelected"
                                 class="btn btn-primary-1 btn-sm m-b-10">
                              <i class="fa fa-chevron-left"></i>
                              </button>
                              <button type="button" id="assign_contracts_rightSelected"
                                 class="btn btn-primary-1 btn-sm m-b-10">
                              <i class="fa fa-chevron-right"></i>
                              </button>
                              <button type="button" id="assign_contracts_leftAll"
                                 class="btn btn-primary-1 btn-sm m-b-10">
                              deselect all
                              </button>
                              <button type="button" id="assign_contracts_undo"
                                 class="btn btn-primary-1 btn-sm m-b-10">
                              <i class="fa fa-undo"></i>
                              </button>
                              <button type="button" id="assign_contracts_redo"
                                 class="btn btn-primary-1 btn-sm m-b-10">
                              <i class="fa fa-redo"></i>
                              </button>
                           </div>
                        </div>
                        <div class="ms-container">
                           <div class="ms-selectable">
                              <select name="from[]" id="assign_contracts" class="assign_methods" multiple="multiple">';
        $contract_handler->listAllContractsNotAssigned($request_id);
        echo '</select><label for="assign_contracts">Available Contracts</label>
                           </div>
                           <div class="ms-selection">
                              <select name="to[]" id="assign_contracts_to" multiple="multiple">';
        $contract_handler->listAllContractsAssigned($request_id);
        echo '</select><label for="assign_contracts_to">Selected Contracts</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 offset-3 text-center mt-5">
                        <div class="checkbox">
                           <label>
                           <input type="checkbox"
                              onchange="document.getElementById(\'updateUsersContracts\').disabled
                              = !this.checked;"/> I have checked & confirm the selection is correct
                           </label>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-md-4 offset-md-4 text-center">
                        <button type="submit" class="btn btn-primary-1 btn-sm updateAssociations" id="updateUsersContracts" disabled
                           data-role="form_submit_btn"
                           data-action="updateUsersContracts">Save Associations
                        </button>
                     </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
';
    } else {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}