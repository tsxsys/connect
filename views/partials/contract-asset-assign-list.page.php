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
                                        data-target="assetAssignList" onclick="reloadTable(this.getAttribute('data-target'))">
                                    Refresh Table
                                </button>
                            </div>
                        </div>
                        <table id="assetAssignList" class="ts__table">
                            <thead>
                                <tr>
                                    <th>Contract Number</th>
                                    <th>kW</th>
                                    <th>kVA</th>
                                    <th>Date added</th>
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
<div id="x_modal"></div>
<!-- /.content -->


