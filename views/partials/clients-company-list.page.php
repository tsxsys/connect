<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-6 offset-3 text-center">
                                <button type="button"
                                        class="btn btn-primary-1 btn-sm"
                                        data-target="company_list" onclick="reloadTable(this.getAttribute('data-target'))">
                                    Refresh Table
                                </button>
                            </div>
                        </div>
                        <table id="company_list" class="ts__table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Company Name</th>
                                    <th>Contract Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
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
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div id="x_modal"></div>

