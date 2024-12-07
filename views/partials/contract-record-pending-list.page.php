<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-sm-6 offset-3 text-center">
                        <button type="button"
                                class="btn btn-primary-1 btn-sm"
                                data-target="record_pending_list"
                                onclick="reloadTable(this.getAttribute('data-target'))">
                            Refresh Table
                        </button>
                    </div>
                </div>
                <table id="record_pending_list" class="ts__table">
                    <thead>
                        <tr>
                        <th>Contract Number</th>
                        <th>kW</th>
                        <th>kVA</th>
                        <th>Date added</th>
                        <th>Contract Manager</th>
                        <th>Sales Manager</th>
                        <th>Technical Manager</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div id="x_modal"></div>

