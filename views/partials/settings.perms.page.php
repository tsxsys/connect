<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="permissionList" class="table table-sm">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Permission Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Assign Roles</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Permission Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Assign Roles</th>
                                <th>Edit</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- New Permission Modal -->
    <div class="modal fade" id="newPermission">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Permission
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </h4>

                </div>
                <div class="modal-body">
                    <form id="newPermissionForm">
                        <input type="hidden" id="permission_id"></input>
                        <label for="permissionName">Permission Name</label>
                        <input class="form-control" name="permissionName" id="new_PermissionName"></input>
                        <label for="permissionDescription">Description</label>
                        <input class="form-control" name="permissionDescription" id="new_PermissionDescription"></input>
                        <label for="permissionCategory">Category</label>
                        <input class="form-control" name="permissionCategory" id="new_PermissionCategory"></input>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" id="submitNewPermission"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermission">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Permission
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </h4>

                </div>
                <div class="modal-body">
                    <form id="editPermissionForm">
                        <input type="hidden" id="edit_permission_id"></input>
                        <label for="editPermissionName">Permission Name</label>
                        <input class="form-control" name="editPermissionName" id="edit_PermissionName"></input>
                        <label for="editPermissionDescription">Permission Description</label>
                        <input class="form-control" name="editPermissionDescription"
                               id="edit_PermissionDescription"></input>
                        <label for="editpermissionCategory">Category</label>
                        <input class="form-control" name="editPermissionCategory" id="edit_PermissionCategory"></input>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" id="updatePermission"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php include "' . VIEWS_URL . 'admin/partials/permissionmanagementmodals.html"; ?>


    <!-- /.container-fluid -->
</section>
<!-- /.content -->

