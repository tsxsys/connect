<?php
$contract_handler = new Connect\Contract;
?>
<div class="modal fade" id="assign_associations" tabindex="-1" aria-labelledby="assign_associationsLabel"
     aria-hidden="true">
    <form class="modal-fullscreen" id="form_contract_users" data-role="update" data-xeid="<?= $contract_id ?>" onsubmit="return false"
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
                                contract C<?= $contract_no ?>.
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
                                            <select name="from[]" id="assign_contract_users" class="assign_methods" multiple="multiple">
                                                <?php $contract_handler->listAllUsersNotAssigned('customer', $contract_id); ?>
                                                <?php $contract_handler->listAllUsersNotAssigned('intermediary', $contract_id); ?>
                                            </select><label for="assign_methods">Available Users</label>
                                        </div>
                                        <div class="ms-selection">
                                            <select name="to[]" id="assign_contract_users_to" multiple="multiple">
                                                <?php $contract_handler->listAllUsersAssigned('customer', $contract_id); ?>
                                                <?php $contract_handler->listAllUsersAssigned('intermediary', $contract_id); ?>
                                            </select><label for="assign_methods_to">Selected Users</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 offset-3 text-center mt-5">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   onchange="document.getElementById('updateAssetUsers').disabled
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
</div>