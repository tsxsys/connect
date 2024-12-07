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
                                    <a class="nav-link active" data-toggle='tab' href="#leave_history">Leave History</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle='tab' href="#leave_request">Request
                                        Leave</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class='card-body'>
                            <div class='tab-content'>
                                <div class='tab-pane active' id='leave_history'>
                                    <div class="row mb-2">
                                        <div class="col-mb-3 offset-mb-9 m-auto">
                                            <button type="button" class="btn btn-primary-1 btn-sm" data-target="user_leave_history_list" onclick="reloadTable(this.getAttribute('data-target'))">Refresh Table</button>
                                        </div>
                                    </div>

                                    <table id="user_leave_history_list" class="table table-sm">
                                        <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Requested On</th>
                                            <th>Leave From</th>
                                            <th>Leave To</th>
                                            <th>Leave Days</th>
                                            <th>Leave Type</th>
                                            <th>Leave Reason</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class='tab-pane' id='leave_request'>
                                    <form class="form-horizontal" id="leave_request_form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leave_from">Leave From Date</label>
                                                    <input type="date"
                                                           class="form-control form-control-border form-control-sm"
                                                           name="leave_from" id="leave_from" required onchange="validate_to(this.id)"
                                                           min=
                                                           <?php
                                                           echo date('Y-m-d');
                                                           ?>
                                                     >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="leave_to">Leave To Date</label>
                                                    <input type="date"
                                                           class="form-control form-control-border form-control-sm"
                                                           name="leave_to" id="leave_to" required
                                                           min=
                                                        <?php
                                                        echo date('Y-m-d');
                                                        ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="type">Leave Type</label>
                                                    <select class="custom-select form-control-border" name="type"
                                                            id="type">
                                                        <option>--SELECT AN OPTION--</option>
                                                        <?php $leave_type = (new Connect\Leaves)->getAllLeaveTypes(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="leave_reason">Reason For Leave</label>
                                                    <textarea rows="2" name="leave_reason"
                                                              class="form-control form-control-border form-control-sm"
                                                              id="leave_reason"
                                                              placeholder="Please provide reason for this leave"
                                                    ></textarea>
                                                    <span id="leave_reason_9x"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 offset-md-4">
                                                <div id="message_leave_request"></div>
                                                <button type="submit" class="btn btn-primary-1 btn-sm"
                                                        id="submit_leave_request"><span class="label">Submit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
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
<!-- /.content -->

<div id="edit_leave_modal"></div>