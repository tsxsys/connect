<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $member_type = 'intermediary';
        $client_info = (new Connect\UserHandler)->getClientInfo($member_type, $request_id);
        $client_contracts = (new Connect\UserHandler)->getCustomerAssetInfo($request_id);
        echo '<input type="hidden" data-bs-toggle="modal" data-bs-target="#x_' . $request_id . '99">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="x_' . $request_id . '99Label"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                    <h4 class="modal-title" id="x_' . $request_id . '99Label">' . $client_info['firstname'] . ' ' . $client_info['lastname'] . '</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
<div class="row">
<div class="col-md-10 col-sm-12 offset-md-1">
<div class="row">
               <div class="col-sm-5">
                  <div class="ecni_x_info_box">
                     <table>
                        <tbody>
                           <tr>
                              <td><span class="info_heading">Contact Infoformation</span></td>
                           </tr>
                           <tr>
                              <td>Name</td>
                              <td>' . $client_info['firstname'] . ' ' . $client_info['lastname'] . '</td>
                           </tr>
                           <tr>
                              <td>Email</td>
                              <td>' . $client_info['email'] . '</td>
                           </tr>
                           <tr>
                              <td>Phone</td>
                              <td>' . $client_info['phone'] . '</td>
                           </tr>
                           <tr>
                              <td>Phone ext</td>
                              <td>' . $client_info['phone_ext'] . '</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
                <div class="col-sm-7">
                  <div class="ecni_x_info_box ecni_x_bg_grey">
                     <table class="table__scroll">
                        <tbody>
                           <tr>
                              <td><span class="info_heading">Contract Access</span>
                                 ' . implode("", $client_contracts) . '
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               </div>
               </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>';
    } else {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}