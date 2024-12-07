<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-2">
                            <div class="col-sm-6 offset-3 text-center">
                                <button type="button"
                                        class="btn btn-primary-1 btn-sm"
                                        data-target="role_list" onclick="reloadTable(this.getAttribute('data-target'))">
                                    Refresh Table
                                </button>
                            </div>
                        </div>
                        <table id="role_list" class="ts__table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>User Count</th>
                                <th>Assign Users</th>
                                <th>Edit</th>
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
</div>
<!-- /.content -->

<div id="action_modal"></div>
<div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="newRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleLabel">New Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-10 offset-1">
                        <form id="newRoleForm" method="post">
                            <div class="row form-group">
                                <label for="new_RoleName" class="col-sm-3 col-form-label text-right">Role Name *</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           class="form-control form-control-border form-control-sm"
                                           name="roleName" id="new_RoleName" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="new_RoleDescription" class="col-sm-3 col-form-label text-right">Role
                                    Description *</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           class="form-control form-control-border form-control-sm"
                                           name="roleDescription" id="new_RoleDescription" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-dark-2 btn-block"
                                            data-role="form_submit_btn" data-action="submitNewRole"
                                            id="submitNewRole">
                                        <span class="label">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="editRole" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleLabel">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-10 offset-1">
                        <form id="editRoleForm" method="post">
                            <input type="hidden" id="edit_role_id">
                            <div class="row form-group">
                                <label for="edit_RoleName" class="col-sm-3 col-form-label text-right">Role Name *</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           class="form-control form-control-border form-control-sm"
                                           name="editRoleName" id="edit_RoleName" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="edit_RoleDescription" class="col-sm-3 col-form-label text-right">Role
                                    Description *</label>
                                <div class="col-sm-9">
                                    <input type="text"
                                           class="form-control form-control-border form-control-sm"
                                           name="editRoleDescription" id="edit_RoleDescription" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-dark-2 btn-block"
                                            data-role="form_submit_btn" data-action="updateRole"
                                            id="updateRole">
                                        <span class="label">Submit</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php include "' . VIEWS_URL . 'admin/partials/rolemanagementmodals.html"; ?>