<?php
/**
 * Off canvas for contract progress status
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
        $contract_info = $contract_handler->getContractInfo($request_id);
        $contract_progress = $contract_handler->getContractProgress($request_id);
        echo '
<input type="hidden" data-bs-toggle="offcanvas" data-bs-target="#x_' . $request_id . '99" aria-controls="x_' . $request_id . '99">

<div class="offcanvas offcanvas-end" data-bs-backdrop="false" tabindex="-1" id="x_' . $request_id . '99" aria-labelledby="x_' . $request_id . '99Label">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Contract C' . $contract_info['contract_no'] . ' progress</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="latest__update__0">
            <div class="latest__update__block">
                <div class="scroll-widget">
                    <div class="latest-update-box">
                        <div class="row p-b-30">
                            <div class="col-auto text-right update-meta p-r-0">
                                <i class="fas fa-check positive update-icon"></i>
                            </div>
                            <div class="col p-l-5">
                                <h6>Contract created</h6>
                                <p class="text-muted m-b-0">' . $contract_info['date_added'] . '</p>
                            </div>
                        </div>
                        ' . implode("", $contract_progress) . '
                    </div>
                </div>
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