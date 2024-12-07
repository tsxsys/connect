<div class="modal fade" id="contact_files" tabindex="-1" aria-labelledby="contact_files_label" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contact_files_label">Contract Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs md-tabs" id="contact_files_tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="contact_file_uploader_tab" data-bs-toggle="tab" data-bs-target="#contact_file_uploader" type="button" role="tab" aria-controls="contact_file_uploader" aria-selected="true">Contract File Uploader</button>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact_file_manager_tab" data-bs-toggle="tab" data-bs-target="#contact_file_manager" type="button" role="tab" aria-controls="contact_file_manager" aria-selected="false">Contract File Manager</button>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="contact_file_uploader" role="tabpanel" aria-labelledby="contact_file_uploader_tab">
                        <div class="file_upload_header">
                            <h5 class="text-center"><i class="fas fa-info-circle"></i> Drop files here to upload or click on the upload box to browse for files</h5>
                        </div>
                        <div class="file_upload_body">
                        <form class="dropzone" id="my-dropzone" data-xeid="<?= $contract_id ?>">
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form>
                        </div>
                        <div class="file_upload_footer">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact_file_manager" role="tabpanel" aria-labelledby="contact_file_manager_tab">
                        <div class="row">
                            <div class="col-12">
                                <div class="row m-2">
                                    <div class="col-sm-6 offset-3 text-center">
                                        <button type="button"
                                                class="btn btn-primary-1 btn-sm reloadTable"
                                                data-target="contract_files_list" onclick="reloadTable(this.getAttribute('data-target'))">
                                            Refresh Table
                                        </button>
                                    </div>
                                </div>
                                <table id="contract_files_list" class="ts__table">
                                    <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Upload Date</th>
                                        <th>Uploaded By</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr></tr>
                                    </tbody>
                                </table>
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
<div id="x_modal"></div>