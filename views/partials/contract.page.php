<?php
$uid = $_SESSION['uid'];
require 'contracts/inc/ajax/contract.func.inc.php';
?>
<!-- Main content -->

<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="far fa-calendar-check text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h4 class="m-b-0">Contracts</h4 class="m-b-0">
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <?php
                                        if (!empty($assetCount['count'])) {
                                            echo '<a href="contracts.php?t=view-assets"><h6 class="m-b-0">View contracts</h6></a>';
                                        } else {
                                            echo '<h6 class="m-b-0">No contracts available</h6>';
                                        } ?>
                                    </div>
                                    <?php
                                    if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager()) {
                                        echo '
                                    <div class="col">
                                        <a href="contracts.php?t=record-a"> <h6 class="m-b-0">Add a contract</h6></a>
                                    </div>';
                                    }
                                    ?>
                                </div>
                                <h6 class="pt-badge bg-c-red"><?= $assetCount['count'] ?></h6>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager() || $auth->isSalesStaff()) {
                        echo '
               
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="far fa-calendar-check text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h4 class="m-b-0">Pending Contracts</h4 class="m-b-0">
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">';
                                        if (!empty($assetPendingChecksCount['count'])) {
                                            echo '<a href="contracts.php?t=record-pending"><h6 class="m-b-0">Approve Contracts</h6></a>';
                                        } else {
                                            echo '<h6 class="m-b-0">No contracts to approve</h6>';
                                        } echo '
                                    </div>
                                </div>
                                <h6 class="pt-badge bg-c-red">' . $assetPendingChecksCount['count'] . '</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="far fa-calendar-check text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h4 class="m-b-0">User Associations</h4 class="m-b-0">
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">';
                                        if (!empty($customerCount['count']) && !empty($intermediaryCount['count'])) {
                                            echo '<a href="contracts.php?t=assign-user"><h6 class="m-b-0">Assign a user</h6></a>';
                                        } else {
                                            echo '<h6 class="m-b-0">No users available</h6>';
                                        }
                                        echo '                                       
                                    </div>
                                </div>
                                <h6 class="pt-badge bg-c-red">' . $userAssociationCount['count'] . '</h6>
                            </div>
                        </div>
                    </div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content -->

