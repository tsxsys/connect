<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
$user_handler = new Connect\UserHandler;
$contract_handler = new Connect\Contract;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $company_info = $user_handler->getCompanyInfo($request_id);
        $members_info = $user_handler->getCompanyMemberInfo($request_id);
        $contracts_info = $user_handler->getCompanyContractInfo($request_id);
        echo '<input type="hidden" data-toggle="modal" data-target="#x_' . $request_id . '99">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="x_' . $request_id . '99Label"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="x_' . $request_id . '99Label">' . $company_info['company_name'] . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="ecni_x_info_box">
                    <table>
                        <tbody>
                            <tr><td><span class="info_heading">Contact Infoformation:</span></td></tr>
                            <tr><td>Contact Name</td><td>' . $company_info['contact_name'] . '</td></tr>
                            <tr><td>Email</td><td>' . $company_info['email'] . '</td></tr>
                            <tr><td>Tel</td><td>' . $company_info['contact_tel'] . '</td></tr>
                            <tr><td>Fax</td><td>' . $company_info['contact_fax'] . '</td></tr>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                    <table>
                        <tbody>
                            <tr><td><span class="info_heading">Company Address:</span>
                            ' . $company_info['address_line_1'] . '</br>
                            ' . $company_info['address_line_2'] . '</br>
                            ' . $company_info['address_line_3'] . '</br>
                            ' . $company_info['address_line_4'] . '</br>
                            ' . $company_info['address_line_5'] . '</br>
                            ' . $company_info['address_line_6'] . '</td></tr>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="ecni_x_info_box">
                    <table>
                        <tbody>
                            <tr><td><span class="info_heading">Billing / Invoice Address:</span>
                            ' . $company_info['i_address_line_1'] . '</br>
                            ' . $company_info['i_address_line_2'] . '</br>
                            ' . $company_info['i_address_line_3'] . '</br>
                            ' . $company_info['i_address_line_4'] . '</br>
                            ' . $company_info['i_address_line_5'] . '</br>
                            ' . $company_info['i_address_line_6'] . '</td></tr>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-6 col-12">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                    <table>
                        <tbody>
                            <tr><td><span class="info_heading">Members</span>
                            ' . implode("", $members_info) . '
                            </td></tr>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-md-6 col-12">
                  <div class="ecni_x_info_box">
                    <table>
                        <tbody>
                            <tr><td><span class="info_heading">Contracts</span>
                            ' . implode("", $contracts_info) . '</td></tr>
                        </tbody>
                    </table>
                  </div>
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