<?php

?>
<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
<!--place content here -->
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

        </div>
    </div>
</div>
<!-- /.content -->
