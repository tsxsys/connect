<?php
//$contract_handler = new Connect\Contract;
//$contract_info = $contract_handler->getContractInfo($contract_id);
?>
<div class="modal fade" id="edit_site_address" tabindex="-1" aria-labelledby="edit_site_addressLabel"
     aria-hidden="true">
    <form class="modal-fullscreen" id="form_edit_site_address" data-role="update" data-xeid="<?= $contract_id ?>" onsubmit="return false"
                              enctype="multipart/form-data">
    <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_site_addressLabel">Site Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-8 col-sm-12 offset-md-2 text-center">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="site_address_line_1">Address line 1 *</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="site_address_line_1" name="site_address_line_1" data-name="site_address_line_1" value="<?= $site_address_line_1 ?>" class="form-control form-control-border form-control-sm companyData" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="site_address_line_2">Address line 2</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="site_address_line_2" name="site_address_line_2" data-name="site_address_line_2" value="<?= $site_address_line_2 ?>" class="form-control form-control-border form-control-sm companyData">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="site_address_line_3">Address line 3 *</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="site_address_line_3" name="site_address_line_3" data-name="site_address_line_3" value="<?= $site_address_line_3 ?>" class="form-control form-control-border form-control-sm companyData">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="site_address_line_4">Address line 4 </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="site_address_line_4" name="site_address_line_4" data-name="site_address_line_4" value="<?= $site_address_line_4 ?>" class="form-control form-control-border form-control-sm companyData">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="site_address_line_5">Postal / Zip Code</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="site_address_line_5" name="site_address_line_5" data-name="site_address_line_5" value="<?= $site_address_line_5 ?>" class="form-control form-control-border form-control-sm companyData" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" for="site_address_line_6">Country *</label>
                                        <div class="col-sm-9">
                                            <select class="form-control form-control-border form-control-sm companyData" style="width: 100%;"
                                                    id="site_address_line_6" name="site_address_line_6" data-name="site_address_line_6">
                                                <option value="<?= $site_address_line_6 ?>"><?= $site_address_line_6 ?></option>
                                                <?php
                                                countrySel();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 offset-3 text-center mt-5">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   onchange="document.getElementById('updateContractSiteAddress').disabled
                                            = !this.checked;"/> I have checked & confirm the selection is correct
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary-1 btn-sm" id="updateContractSiteAddress" disabled
                            data-role="form_submit_btn"
                            data-action="updateContractSiteAddress" onclick="clientPost(this.id,form.id)">Save
                    </button>
                    <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

    </div>
    </form>
</div>