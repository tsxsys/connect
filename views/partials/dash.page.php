<?php
include '' . VIEWS_URL . 'contracts/inc/ajax/contract.func.inc.php';


?>
<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card product-progress-card ts_card">
                            <div class="card-block">
                                <div class="row pp-main">
                                    <div class="col-xl-6 col-md-6">
                                        <div class="pp-cont">
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-auto">
                                                    <i class="fas fa-hourglass-end f-24 text-mute"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h2 class="m-b-0 text-c-grey"><?=$assetOutstandingCount?></h2>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-auto">
                                                    <p class="m-b-0">Outstanding Contacts</p>
                                                </div>
                                                <div class="col text-right">
                                                    <p class="m-b-0 text-c-grey"><i
                                                                class="fas fa-long-arrow-alt-up m-r-10"></i><?=roundTo($assetOutstandingPercent, 2)?>%
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-grey"
                                                     style="width:<?=roundTo($assetOutstandingPercent, 2)?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6">
                                        <div class="pp-cont">
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-auto">
                                                    <i class="fas fa-check-circle f-24 text-mute"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h2 class="m-b-0 text-c-grey"><?=$assetCompletedCount['count']?></h2>
                                                </div>
                                            </div>
                                            <div class="row align-items-center m-b-10">
                                                <div class="col-auto">
                                                    <p class="m-b-0">Completed Contacts</p>
                                                </div>
                                                <div class="col text-right">
                                                    <p class="m-b-0 text-c-grey"><i
                                                                class="fas fa-long-arrow-alt-down m-r-10"></i><?=roundTo($assetCompletedPercent, 2)?>%
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <div class="progress-bar bg-c-grey"
                                                     style="width:<?=roundTo($assetCompletedPercent, 2)?>%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <h5>Quick Actions</h5>
                        <div class="row">
                            <div class="col-xl-12 col-lg-6 col-md-12">
                                <div class="card ts_card sos-st-card cl">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="m-b-0"><i class="fas fa-users"></i> <a href="contracts.php">Contracts</a>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <a href="contracts.php"><i class="fas fa-arrow-up text-c-grey"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-6 col-md-12">
                                <div class="card ts_card sos-st-card cl">
                                    <div class="card-block">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h3 class="m-b-0"><i class="fas fa-users"></i> <a href="clients.php">Clients</a>
                                                </h3>
                                            </div>
                                            <div class="col-auto">
                                                <a href="clients.php"><i class="fas fa-arrow-up text-c-grey"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-12">
                        <div class="card ts_card sale-card">
                            <div class="card-header">
                                <h5>Contracts around the World</h5>
                            </div>
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id='world-map-assets' class='col-12' style='height:400px;'></div>
                                        <div id='asset-map-info' class='col-12'></div>
                                        <div class='col-md-12 hidden-small'>
                                            <h2 class='line_30 sgh--right sgh--capitalize' id='totalContracts'></h2>
                                            <table class='countries_list sgh--table table'>
                                                <tbody>
                                                <tr id='maxAssetQuantity'></tr>
                                                <tr id='minAssetQuantity'></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
