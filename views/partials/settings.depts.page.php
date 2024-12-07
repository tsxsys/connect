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
                                        data-target="department_list" onclick="reloadTable(this.getAttribute('data-target'))">
                                    Refresh Table
                                </button>
                            </div>
                        </div>
                        <table id="department_list" class="ts__table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Department Name</th>
                                    <th>Department Head</th>
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
</div>
<!-- /.content -->

<div id="action_modal"></div>
<div id="edit_modal"></div>
<!-- Main content -->
<section class="content">
    <!-- New Department Modal -->
    <div class="modal fade" id="newDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Department
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </h4>

                </div>
                <div class="modal-body">
                    <form id="newDepartmentForm">
                        <div class="form-group">
                            <label for="new_DepartmentName">Department Name</label>
                            <input type="text" class="form-control form-control-border form-control-sm"
                                   name="departmentName" id="new_DepartmentName">
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" id="submitNewDepartment"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Department Modal -->
    <div class="modal fade" id="editDepartment">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Department
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </h4>

                </div>
                <div class="modal-body">
                    <form id="editDepartmentForm">
                        <input type="hidden" id="edit_department_id"></input>
                        <div class="form-group">
                            <label for="edit_DepartmentName">Department Name</label>
                            <input type="text" class="form-control form-control-border form-control-sm"
                                       name="dept_name" id="edit_DepartmentName">
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-success" id="updateDepartment"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Department Users Modal -->
    <div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-lg1" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="usersModalTitle"><span id="deptName"></span> Department</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ro" id="dept_users">
                        <p class="info-line">Assign users to this department</p>
                        <input type="hidden" id="department_id"/>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="subject-info-box-1">
                                    <br>
                                    <h4>Available</h4>
                                    <select multiple="multiple" class="form-control" data-idd="users-available">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 mt-xl-5">
                                <div class="subject-info-arrows text-center">
                                    <br>
                                    <input type="button" value=">>" class="btn btn-sm btn-default btnAllRight" data-idd="btnAllRight"/><br/>
                                    <input type="button" value=">" class="btn btn-sm btn-default btnRight" data-idd="btnRight"/><br/>
                                    <input type="button" value="<" class="btn btn-sm btn-default btnLeft" data-idd="btnLeft"/><br/>
                                    <input type="button" value="<<" class="btn btn-sm btn-default btnAllLeft" data-idd="btnAllLeft"/>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="subject-info-box-2">
                                    <br>
                                    <h4>Selected</h4>
                                    <select multiple="multiple" class="form-control" data-idd="users-selected">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-9">
                                <div class="section-modal-footer">
                                    <br>
                                    <button type="button" id="saveDeptUsers" class="btn btn-sm btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="ro" id="dept_head">
                        <p class="info-line">Assign a department head to this department</p>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="subject-info-box-1">
                                    <br>
                                    <h4>Available</h4>
                                    <select multiple="multiple" class="form-control" data-idd="users-available">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 mt-xl-5">
                                <div class="subject-info-arrows text-center">
                                    <br>
                                    <input type="button" value="SET" class="btn btn-sm btn-default btnRight" data-idd="set"/><br/>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="subject-info-box-2">
                                    <br>
                                    <h4>Selected</h4>
                                    <input type="text" class="form-control" data-idd="users-selected" readonly>
                                    <input type="hidden" class="form-control" data-idd="user-selected-id">
                                    </input>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 offset-9">
                                <div class="section-modal-footer pull-right">
                                    <br>
                                    <button type="button" id="saveDeptHead" class="btn btn-sm btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <button id="usersButton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#usersModal"
            style="display:none;">
    </button>


    <!-- /.container-fluid -->
</section>
<!-- /.content -->

