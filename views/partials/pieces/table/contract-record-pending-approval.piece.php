<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
$contract_handler = new Connect\Contract;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $contract_info = $contract_handler->getContractInfo($request_id);
        foreach ($contract_info as $key=>$value) {
            $contract_info[$key] = str_replace(' ', '', $value);
            if (empty($value)) {
                $contract_info[$key] = "-";
            }
        }
        echo '<input type="hidden" data-bs-toggle="modal" data-bs-target="#x_' . $request_id . '99">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="x_' . $request_id . '99Label"
   aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="x_' . $request_id . '99Label">Contract C' . $contract_info['contract_no'] . '</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
         <div class="row">
                    <div class="col-lg-12">
             <div class="card card-widget widget-user shadow-lg">
                    <div class="widget-user-header text-white background__cover" style="background-image: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url(' . ASSETS_URL . 'img/elements/bgs/bg_contract_approval.jpg);">
                        <h3 class="widget-user-username text-right">Contract C' . $contract_info['contract_no'] . '</h3>
                        <h5 class="widget-user-desc text-right">Contrac approval</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="' . ASSETS_URL . 'img/elements/bgs/icon_contract_approval_blue.png" alt="Contrac approval icon">
                    </div>
                    <div class="card-body box-profile">
                        <div class="row">
                            <div class="col-12">
                                <div class="widget_sec_01 dark_01">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="m-b-0"><i class="fas fa-file-alt"></i> Contract Review Document</h3>
                                            </div>
                                            <div class="col-auto">
                                                <a href="generatePDF.php?iA=' . $contract_info['contract_id'] . '&vAss=' . $contract_info['contract_id'] . '" target="_blank"> 
                                                    <h5 class="m-b-0"><i class="fas fa-external-link-alt"></i></h5>
                                                </a>
                                            </div>
                                            <div class="col-auto">
                                                <a href="generatePDF.php?iA=' . $contract_info['contract_id'] . '&vAss=' . $contract_info['contract_id'] . '"> 
                                                    <h5 class="m-b-0"><i class="fas fa-print"></i></h5>
                                                </a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 border-right text-center">
                                <a href="contracts.php?t=view-record-crd&iA=' . $contract_info['contract_id'] . '&vAss=' . $contract_info['contract_id'] . '" class="btn btn-primary-1 btn-sm">View and Approve</a>
                            </div>
                            <div class="col-sm-4 border-right text-center">
                                <a href="profile.php?t=edit" class="btn btn-primary-1 btn-sm">View Queries</a>
                            </div>
                            <div class="col-sm-4 text-center">
                                <a href="profile.php?t=edit" class="btn btn-primary-1 btn-sm">Verison History</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                            <div class="col-12">
                                <div class="latest-update-card">
                                    <div class="card-header">
                                        <h5>Approval Flow</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="scroll-widget">
                                            <div class="latest-update-box">
                                                <div class="row p-t-20 p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-danger update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Contract Manager Approval</h6></a>
                                                        <p class="text-muted m-b-0">Assigned to:</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-danger update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Sales Manager Approval</h6></a>
                                                        <p class="text-muted m-b-0">Assigned to:</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta p-r-0">
                                                        <i class="b-danger update-icon ring"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!"><h6>Technical Manager Approval</h6></a>
                                                        <p class="text-muted m-b-0">Assigned to:</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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