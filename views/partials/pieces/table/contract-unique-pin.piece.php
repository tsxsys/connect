<?php
$contract_handler = new Connect\Contract;
$assetPinInfo = $contract_handler->getAssetPinInfo($contract_id);
$lbPin = $assetPinInfo['contract_pin'];
?>
<div class="modal fade" id="unique_pin" tabindex="-1" aria-labelledby="unique_pinLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unique_pinLabel">Unique PIN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="sub-title"><i class="fa fa-info-circle"></i> View Unique PIN.</h4>
                        <div class="row p-30">
                            <div id='copyToClipboard_alert'></div>
                            <div class="col-md-6 offset-md-3 col-sm-12">
                                <div class="ts_bg_sky_blue_well">
                                    <div class="row">
                                        <div class="col-6">
                                            <h3>Asset ID:</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3>C<?= $contract_no ?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <h3>Unique PIN:</h3>
                                        </div>
                                        <div class="col-6">
                                            <h3 class="d-none" id="contract_u_pin_switch"
                                                data-u-pin="<?= $lbPin ?>"><?= $lbPin ?></h3>
                                            <h3 id="contract_u_pin">******</h3>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-3 col-sm-12 text-center">
                                <button type="button" class="btn btn-primary-1 m-b-10 btn-sm s_h reveal__pin"
                                        data-target="#contract_u_pin">Reveal pin
                                </button>
                                <button type="button" class="btn btn-primary-1 m-b-10 btn-sm"
                                        data-target="#contract_u_pin_switch"
                                        onclick="copyToClipboard(this.getAttribute('data-target'))">Copy PIN
                                </button>

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
</div>
