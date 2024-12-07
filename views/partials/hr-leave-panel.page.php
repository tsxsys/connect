<?php
/**
 * Page that allows admins to verify or delete new (unverified) users
 **/

?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="form-group" id="configForm">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle='tab' href="#leave_request">Leave Requests</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle='tab' href="#leave_history">Leave History</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class='card-body'>
                            <div class='tab-content'>
                                <div class='tab-pane active' id='leave_request'>
                                    <div class="row mb-2">
                                        <div class="col-mb-3 offset-mb-9 m-auto">
                                            <button type="button" class="btn btn-primary-1 btn-sm" data-target="leave_request_list_head" onclick="reloadTable(this.getAttribute('data-target'))">Refresh Table</button>
                                        </div>
                                    </div>
                                    <table id="leave_request_list_head" class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Originator</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Days</th>
                                            <th>Type</th>
                                            <th>Reason</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class='tab-pane' id='leave_history'>
                                    <div class="row mb-2">
                                        <div class="col-mb-3 offset-mb-9 m-auto">
                                            <button type="button" class="btn btn-primary-1 btn-sm" data-target="leave_history_list_head" onclick="reloadTable(this.getAttribute('data-target'))">Refresh Table</button>
                                        </div>
                                    </div>
                                    <table id="leave_history_list_head" class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Originator</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Days</th>
                                            <th>Type</th>
                                            <th>Reason</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div id="response_leave"></div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<div id="edit_leave_modal"></div>