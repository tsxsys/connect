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
                                        data-target="software_list" onclick="reloadTable(this.getAttribute('data-target'))">
                                    Refresh Table
                                </button>
                            </div>
                        </div>
                        <table id="software_list" class="ts__table">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Status</th>
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
<div id="edit_modal"></div>