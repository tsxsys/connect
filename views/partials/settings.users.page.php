<?php
/**
 * Page that allows admins to verify or delete new (unverified) users
 **/

?>
<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        <div class="card card-outline">
                            <div class="form-group" id="userForm">
                                <div class="card-header p-2">
                                    <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="manage_active_tab" data-bs-toggle="tab"
                                                    data-bs-target="#manage_active" type="button" role="tab"
                                                    aria-controls="manage_active" aria-selected="true">Manage Active
                                                Users
                                            </button>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="verification_tab" data-bs-toggle="tab"
                                                    data-bs-target="#verification" type="button" role="tab"
                                                    aria-controls="verification" aria-selected="false">Verify/Delete New
                                                Users
                                            </button>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="add_user_tab" data-bs-toggle="tab"
                                                    data-bs-target="#add_user" type="button" role="tab"
                                                    aria-controls="add_user" aria-selected="false">Add New User
                                            </button>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class='card-body'>
                                    <div class="tab-content card-block">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="manage_active" role="tabpanel"
                                                 aria-labelledby="manage_active_tab">
                                                <div class="row mb-2">
                                                    <div class="col-sm-6 offset-3 text-center">
                                                        <button type="button"
                                                                class="btn btn-primary-1 btn-sm"
                                                                data-target="manage_user_list"
                                                                onclick="reloadTable(this.getAttribute('data-target'))">
                                                            Refresh Table
                                                        </button>
                                                    </div>
                                                </div>
                                                <table id="manage_user_list" class="ts__table">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Role(s)</th>
                                                        <th>Timestamp</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="verification" role="tabpanel"
                                                 aria-labelledby="verification_tab">
                                                <div class="row mb-2">
                                                    <div class="col-sm-6 offset-3 text-center">
                                                        <button type="button"
                                                                class="btn btn-primary-1 btn-sm"
                                                                data-target="verify_user_list"
                                                                onclick="reloadTable(this.getAttribute('data-target'))">
                                                            Refresh Table
                                                        </button>
                                                    </div>
                                                </div>
                                                <table id="verify_user_list" class="ts__table">
                                                    <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Timestamp</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="add_user" role="tabpanel"
                                                 aria-labelledby="add_user_tab">
                                                <form class="form-horizontal" id="create_user_form"
                                                      name="create_user_form"
                                                      method="post" data-role="set" data-action="createUser"
                                                      enctype="multipart/form-data" onsubmit="return false">

                                                    <div class="form-group row">
                                                        <label for="user_type"
                                                               class="col-sm-3 col-form-label text-right">
                                                            User Type *
                                                        </label>
                                                        <div class="col-sm-9">
                                                            <select class="custom-select form-control form-control-border form-control-sm"
                                                                    name="user_type" id="user_type" data-action="getUserForm"
                                                                    onchange="getForm(this.id)">
                                                                <option>--SELECT AN OPTION--</option>
                                                                <option value="customer">Customer</option>
                                                                <option value="intermediary">Intermediary</option>
                                                                <option value="staff">Staff</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-4 offset-md-4">
                                                            <div class="text-center message"
                                                                 id="create_user_message"></div>
                                                        </div>
                                                    </div>
                                                    <div id="build__form"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <?php include ADMIN_DIR . "partials/usermanagementmodals.html"; ?>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->



