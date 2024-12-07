<?php
/**
 * Modal for adding software
 **/
?>
<input type="hidden" data-toggle="modal" data-target="#x_add_software_99" data-bs-toggle="modal"
       data-bs-target="#x_add_software_99">
<div class="modal fade" id="x_add_software_99" tabindex="-1" aria-labelledby="x_add_software_99Label"
     aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="x_add_software_99Label">New Software</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--            software checkboxes -->
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-sm-10 offset-1">
                                <form class="form-horizontal" id="software_set" data-role="set"
                                      enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Enabled or disable this option</label>
                                        <div class="col-sm-4">
                                            <input type="checkbox" name="input_type" value="on" class="jack_" checked/>
                                            <div class="check-change js-check-change-field"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="software_category">Category</label>
                                            <input id="software_category" type="text" class="form-control"
                                                   name="software_category" placeholder="Category" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="software_description">Description</label>
                                            <input id="software_description" type="text" class="form-control"
                                                   name="software_description" placeholder="Description" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4 offset-md-4">
                                            <div id="message_software_info"></div>
                                            <button type="submit" class="btn btn-dark-2 btn-block"
                                                    id="submit_software_info" data-role="form_submit_btn"
                                                    data-action="setSoftwareInfo" onclick="actionPost(this.id,form.id)">
                                                <span class="label">Save Changes</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
