<?php
$uid = $_SESSION['uid'];
$user_handler = new Connect\UserHandler;
$companyCount = $user_handler->getCompanyCount();
$customerCount = $user_handler->getClientCount('customer');
$intermediaryCount = $user_handler->getClientCount('intermediary');
?>
<!-- Main content -->
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
                                        <i class="far fa-building text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h4 class="m-b-0">Companies</h4 class="m-b-0">
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <?php
                                        if (!empty($companyCount['count'])) {
                                            echo '<a href="clients.php?t=view-companies"><h6 class="m-b-0">View companies</h6></a>';
                                        } else {
                                            echo '<h6 class="m-b-0">No companies available</h6>';
                                        } ?>
                                    </div>
                                    <?php
                                    if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager()) {
                                        echo '
                                    <div class="col">
                                        <a href="clients.php?t=add-client"> <h6 class="m-b-0">Add a company</h6></a>
                                    </div>';
                                    }
                                    ?>
                                </div>
                                <h6 class="pt-badge bg-c-red"><?= $companyCount['count'] ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="fas fa-users text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h4 class="m-b-0">Customers</h4 class="m-b-0">
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <?php
                                        if (!empty($customerCount['count'])) {
                                            echo '<a href="clients.php?t=view-customers"><h6 class="m-b-0">View customers</h6></a>';
                                        } else {
                                            echo '<h6 class="m-b-0">No customers available</h6>';
                                        } ?>
                                    </div>
                                    <?php
                                    if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager()) {
                                        echo '
                                    <div class="col">
                                        <a href="clients.php?t=add-client"> <h6 class="m-b-0">Add a customer</h6></a>
                                    </div>';
                                    }
                                    ?>
                                </div>
                                <h6 class="pt-badge bg-c-red"><?= $customerCount['count'] ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <div class="card proj-t-card">
                            <div class="card-body">
                                <div class="row align-items-center m-b-30">
                                    <div class="col-auto">
                                        <i class="fas fa-exchange-alt text-c-red f-30"></i>
                                    </div>
                                    <div class="col p-l-0">
                                        <h4 class="m-b-0">Intermediaries</h4 class="m-b-0">
                                    </div>
                                </div>
                                <div class="row align-items-center text-center">
                                    <div class="col">
                                        <?php
                                        if (!empty($intermediaryCount['count'])) {
                                            echo '<a href="clients.php?t=view-intermediaries"><h6 class="m-b-0">View
                                                intermediaries</h6></a>';
                                        } else {
                                            echo '<h6 class="m-b-0">No intermediaries available</h6>';
                                        } ?>

                                    </div>
                                    <?php
                                    if ($auth->isSuperAdmin() || $auth->isAdmin() || $auth->isContractManager()) {
                                        echo '
                                    <div class="col">
                                        <a href="clients.php?t=add-client"> <h6 class="m-b-0">Add a intermediary</h6></a>
                                    </div>';
                                    }
                                    ?>
                                </div>
                                <h6 class="pt-badge bg-c-red"><?= $intermediaryCount['count'] ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content -->

