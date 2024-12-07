<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../config/inc/func.inc.php';
require '../../../../vendor/autoload.php';
$auth = new Connect\AuthorizationHandler;
$contract_handler = new Connect\Contract;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $contract_file_info = $contract_handler->getContractFileInfo($request_id);
        echo '
<input type="hidden" data-bs-toggle="modal" data-bs-target="#x_' . $request_id . '99">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="x_' . $request_id . '99Label"
   aria-hidden="true">
   <form id="form_delete_contract_file" data-role="update" data-xeid="' . $request_id . '" onsubmit="return false"
                              enctype="multipart/form-data">
   <div class="modal-dialog modal-dialog-centered modal-small" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="x_' . $request_id . '99Label">Delete File</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
         <div class="row">
            <div class="col-sm-8 offset-1 text-center">';
        if (!empty($contract_file_info['file_name'])) {
            echo 'Deleting ' .$contract_file_info['file_name'];
        }
        echo '<input type="hidden" name="file_name" value="' . $contract_file_info['file_name'] . '" >
            </div>
        </div>
            <div class="row">
                <div class="col-sm-8 offset-2 text-center mt-5">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"
                                   onchange="document.getElementById(\'deleteContractFile\').disabled
                                    = !this.checked;"/> Yes, delete current file above
                        </label>
                    </div>
                </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-sm" id="deleteContractFile" disabled
                            data-role="form_submit_btn"
                            data-action="deleteContractFile" onclick="clientPost(this.id,form.id,true,true)">Confirm Delete
            </button>
            <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
   </form>
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