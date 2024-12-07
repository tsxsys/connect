<?php
/**
 * Modal for ...
 **/
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
$contract_handler = new Connect\Contract;
try {
    $request_id = $_POST['id'];
    if (($auth->isLoggedIn()) AND !empty($request_id)) {
        unset($_POST['csrf_token']);
        $contract_info = $contract_handler->getContractInfo($request_id);
        $contract_no = $contract_info['contract_no'];
        echo '<input type="hidden" data-bs-toggle="modal" data-bs-target="#x_' . $request_id . '99">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="assign_associationsLabel"
     aria-hidden="true">
    <form class="modal-fullscreen" id="form_contract_users" data-role="update" data-xeid="'.$request_id.'" onsubmit="return false"
                              enctype="multipart/form-data">
    <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assign_associationsLabel">Assign Associations</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="sub-title"><i class="fa fa-info-circle"></i> Select users to assign to
                                contract C'.$contract_no.'.
                            </h4>
                            <div class="row">
                                <div class="col-md-8 col-sm-12 offset-md-2 text-center">
                                    <div class="row">
                                        <div class="col-12">
                                            <button type="button" id="assign_contract_users_rightAll"
                                                    class="btn btn-primary-1 btn-sm m-b-10">
                                                select all
                                            </button>
                                            <button type="button" id="assign_contract_users_leftSelected"
                                                    class="btn btn-primary-1 btn-sm m-b-10">
                                                <i class="fa fa-chevron-left"></i>
                                            </button>
                                            <button type="button" id="assign_contract_users_rightSelected"
                                                    class="btn btn-primary-1 btn-sm m-b-10">
                                                <i class="fa fa-chevron-right"></i>
                                            </button>
                                            <button type="button" id="assign_contract_users_leftAll"
                                                    class="btn btn-primary-1 btn-sm m-b-10">
                                                deselect all
                                            </button>
                                            <button type="button" id="assign_contract_users_undo"
                                                    class="btn btn-primary-1 btn-sm m-b-10">
                                                <i class="fa fa-undo"></i>
                                            </button>
                                            <button type="button" id="assign_contract_users_redo"
                                                    class="btn btn-primary-1 btn-sm m-b-10">
                                                <i class="fa fa-redo"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="ms-container">
                                        <div class="ms-selectable">
                                            <select name="from[]" id="assign_contract_users" class="assign_methods" multiple="multiple">';
                                                $contract_handler->listAllUsersNotAssigned('customer', $request_id);
                                                $contract_handler->listAllUsersNotAssigned('intermediary', $request_id);
                                            echo '</select><label for="assign_methods">Available Users</label>
                                        </div>
                                        <div class="ms-selection">
                                            <select name="to[]" id="assign_contract_users_to" multiple="multiple">';
                                               $contract_handler->listAllUsersAssigned('customer', $request_id);
                                               $contract_handler->listAllUsersAssigned('intermediary', $request_id);
                                            echo '</select><label for="assign_methods_to">Selected Users</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 offset-3 text-center mt-5">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   onchange="document.getElementById(\'updateAssetUsers\').disabled
                                            = !this.checked;"/> I have checked & confirm the selection is correct
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-1 btn-sm updateAssociations" id="updateAssetUsers" disabled
                            data-role="form_submit_btn"
                            data-action="updateAssetUsers">Save
                    </button>
                    <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
    </div>
    </form>
</div>';
    } else {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}