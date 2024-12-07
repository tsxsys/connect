<div class="modal fade" id="delete_site_address" tabindex="-1" aria-labelledby="delete_site_address_Label"
     aria-hidden="true">
    <form id="form_edit_site_address" data-role="update" data-xeid="<?= $contract_id ?>" onsubmit="return false"
                              enctype="multipart/form-data">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_site_address_Label">Delete Site Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 offset-1 text-center">
                            <?php
                            if (!empty($site_address_line_1)) {
                                echo $site_address_line_1 . '<br>';
                            }
                            if (!empty($site_address_line_2)) {
                                echo $site_address_line_2 . '<br>';
                            }
                            if (!empty($site_address_line_3)) {
                                echo $site_address_line_3 . '<br>';
                            }
                            if (!empty($site_address_line_4)) {
                                echo $site_address_line_4 . '<br>';
                            }
                            if (!empty($site_address_line_5)) {
                                echo $site_address_line_5 . '<br>';
                            }
                            if (!empty($site_address_line_6)) {
                                echo $site_address_line_6 . '<br>';
                            } ?>
                        </div>
                    </div>
                    <input type="hidden" name="site_address_line_1">
                    <input type="hidden" name="site_address_line_2">
                    <input type="hidden" name="site_address_line_3">
                    <input type="hidden" name="site_address_line_4">
                    <input type="hidden" name="site_address_line_5">
                    <input type="hidden" name="site_address_line_6">
                    <div class="row">
                        <div class="col-sm-8 offset-2 text-center mt-5">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           onchange="document.getElementById('deleteContractSiteAddress').disabled
                                            = !this.checked;"/> Yes, delete current site address above
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm" id="deleteContractSiteAddress" disabled
                            data-role="form_submit_btn"
                            data-action="deleteContractSiteAddress" onclick="clientPost(this.id,form.id)">Delete
                    </button>
                    <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

    </div>
    </form>
</div>