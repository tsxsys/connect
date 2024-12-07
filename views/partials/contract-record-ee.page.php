<?php

if (!empty($_REQUEST['iA']) && !empty($_REQUEST['cA'])) {
    $id = $_GET['iA'];
    $contract_id = $_GET['cA'];
    $post_unique_id = $_GET['qq'];
    $contract_info = (new Connect\Contract)->getContractInfo($id, $contract_id);
    $date_published = $contract_info['date_published'];
    $idAss = $contract_info['id'];
    $cid = $contract_info['company_id'];
    $contract_type = $contract_info['contract_type'];
    $eAsset = $contract_info['contract_id'];
    $date = $contract_info['date'];

    $quoteNum = $contract_info['quote_no'];
    $quoteDate = $contract_info['quote_date'];
    $order_no = $contract_info['order_no'];
    $order_date = $contract_info['order_date'];
    $quantity = $contract_info['quantity'];
    $requiredDate = $contract_info['required_date'];
    $jobNo = $contract_info['job_no'];
    $paymentTM = $contract_info['paymentTM'];
    $commissioning = $contract_info['commissioning'];
    $serviceNotified = $contract_info['service_notified'];
    $penaltyClause = $contract_info['penalty_clause'];

    $salesOrderNo = $contract_info['sales_order_no'];
    $salesperson_id_d = $contract_info['salesperson_id'];
    if (!empty($salesperson_id_d)) {
        $r_salesperson_id = explode('|', $salesperson_id_d);
        $salesperson_id_uid = $r_salesperson_id[0];
        $salesperson_id = $r_salesperson_id[1];
    }

    $current_flow = $contract_info['current_flow'];
    $load_type = $contract_info['load_type'];
    $config = $contract_info['config'];
    $usage = $contract_info['usage_frequency'];
//                Main Power spec
    $mainKW = $contract_info['mainKW'];
    $mainKVA = $contract_info['mainKVA'];
    $mainPF = $contract_info['mainPF'];
    $mainAMPS = $contract_info['mainAMPS'];
//                Main Power spec 2 StarDelta
    $mainKWSD = $contract_info['mainKWSD'];
    $mainKVASD = $contract_info['mainKVASD'];
    $mainPFSD = $contract_info['mainPFSD'];
    $mainAMPSSD = $contract_info['mainAMPSSD'];

//Test Supply
    $supplyV = $contract_info['supplyV'];
    $supplyHz = $contract_info['supplyHz'];
    $supplyPH = $contract_info['supplyPH'];
    $supplyW = $contract_info['supplyW'];
//Test Supply 2 StarDelta
    $supplyVSD = $contract_info['supplyVSD'];
    $supplyHzSD = $contract_info['supplyHzSD'];
//Delta Min1 Max2
    $supplyVD1 = $contract_info['supplyVD1'];
    $supplyVD2 = $contract_info['supplyVD2'];
//Auxiliary Supply
    $auxInfo = $contract_info['auxInfo'];
    $auxSV = $contract_info['auxSV'];
    $auxSHz = $contract_info['auxSHz'];
    $auxSPH = $contract_info['auxSPH'];
    $auxSW = $contract_info['auxSW'];
    $tempRange = $contract_info['tempRange'];
    if (!empty($tempRange)) {
        $tempRangeParts = explode(" to ", $tempRange);
        $rangeTempCFrom = array_values($tempRangeParts)[0];
        $rangeTempCTo = array_values($tempRangeParts)[1];
    } else {
        $rangeTempCFrom = '-50';
        $rangeTempCTo = '40';
    }
//Control System
//                $controller = $contract_info['controller'];
//                $control_info = $contract_info['control_info'];
    $leads = $contract_info['leads'];

//              Transformer
    $coolingType = $contract_info['coolingType'];
    $txPRating = $contract_info['txPRating'];
    $txSRating = $contract_info['txSRating'];
    $fanRotation = $contract_info['fanRotation'];
    $sgPRating = $contract_info['sgPRating'];
    $sgSRating = $contract_info['sgSRating'];
    $relayType = $contract_info['relayType'];
//Enclosure
    $enc = $contract_info['enclosure'];
    $encStyle = $contract_info['encStyle'];
    $encSize = $contract_info['encSize'];
    $encBase = $contract_info['encBase'];
    $encLifting = $contract_info['encLifting'];
    $encHeight = $contract_info['encHeight'];
    $encSpecial = $contract_info['encSpecial'];
    $enc_finishDefaultApplied = $contract_info['encSpecial'];
    $enc_finish = $contract_info['enc_finish'];
    if (!empty($contract_info['enc_finish'])) {
        $enc_finishParts = explode(" - ", $enc_finish);
        $enc_finishType = array_values($enc_finishParts)[0];
        $enc_finish = array_values($enc_finishParts)[1];
    } else {
        $enc_finishType = 'N/A';
        $enc_finish = 'N/A';
    }
    $post_title = $contract_info['title'];
    $post_details = $contract_info['details'];
//    $date = DateTime::createFromFormat('Y/m/d-H-i-s.00', $notice_b_info2['date_added']);
//    $date_added = $date->format('d-m-Y-H:i:s');

//    $notice_b_n_info = (new Connect\Post)->getNoticeboardNextInfo($post_id);
//    $post_id_next = $notice_b_n_info['announcement_id'];
//    $post_unique_id_next = $notice_b_n_info['unique_id'];
//    $notice_b_p_info = (new Connect\Post)->getNoticeboardPrevInfo($post_id);
//    $post_id_prev = $notice_b_p_info['announcement_id'];
//    $post_unique_id_prev = $notice_b_p_info['unique_id'];
} else {
    header("Location:  contracts.php?t=record-e");
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                   href="#tab_1-1-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-home"
                                   aria-selected="true">Asset Type</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                   href="#tab_1-2-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-profile"
                                   aria-selected="false">Contract Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                   href="#tab_1-3-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-messages"
                                   aria-selected="false">Electrical Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                   href="#tab_1-4-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-settings"
                                   aria-selected="false">Control Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                   href="#tab_1-5-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-profile"
                                   aria-selected="false">Transformer Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                   href="#tab_1-6-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-messages"
                                   aria-selected="false">Mechanical Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                   href="#tab_1-7-<?= $idAss ?>" role="tab" aria-controls="custom-tabs-four-settings"
                                   aria-selected="false">Other Specification</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form role="form" class="sgh-form form-horizontal" id="editJD_1" method="post">
                            <p class="sgh-text sgh-text-right sgh-text-small sgh-text-light">* Mandatory fields</p>
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="tab_1-1-<?= $idAss ?>" role="tabpanel"
                                     aria-labelledby="tab_1-1-<?= $idAss ?>">
                                    <div title="Contract Details">
                                        <div class="row">
                                            <div class="row center m-t-50 ts_contract_ty">
                                                <div class="col-md-6 col-sm-6">
                                                    <label>
                                                        <input class="ts_contract_type_radio" type="radio"
                                                               name="contract_type" value="Single Unit"
                                                               id="single_unit"
                                                               onclick="ts_sel_a_form()"
                                                               onload="ts_sel_a_form()"
                                                            <?php
                                                            if ($contract_type == "Single Unit") {
                                                                echo "checked";
                                                            }
                                                            ?>
                                                        >
                                                        <div class="ts_contract_list comp-wrap__link-hover">
                                                            <h4>Single Unit</h4>
                                                            <span class="ts_description">Unit type single loadbank</span>
                                                            <span title="Single Unit" class="read-more">
                                        <i class="ts_contract_icon ts_single_unit la la-building-o"></i>
                                    </span>
                                                        </div>
                                                    </label>

                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <label>
                                                        <input class="ts_contract_type_radio" type="radio"
                                                               name="contract_type" value="Combi" id="combi"
                                                               onclick="ts_sel_a_form(this.id)"
                                                            <?php
                                                            if ($contract_type == "Combi") {
                                                                echo "checked";
                                                            }
                                                            ?>
                                                        >
                                                        <div class="ts_contract_list comp-wrap__link-hover">
                                                            <h4>Combi</h4>
                                                            <span class="ts_description">Unit type Combi loadbank</span>
                                                            <span title="Combi" class="read-more">
                                        <i class="ts_contract_icon ts_combi_unit la la-server"></i>
                                    </span>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="col-md-12 col-sm-12">
                                                    <label>
                                                        <input class="ts_contract_type_radio" type="radio"
                                                               name="contract_type" value="Transformer"
                                                               id="transformer"
                                                               onclick="ts_sel_a_form(this.id)"
                                                               onload="ts_sel_a_form(this.id)"
                                                            <?php
                                                            if ($contract_type == "Transformer") {
                                                                echo "checked";
                                                            }
                                                            ?>
                                                        >
                                                        <div class="ts_contract_list comp-wrap__link-hover">
                                                            <h4>Transformer</h4>
                                                            <span class="ts_description">Unit type transformer</span>
                                                            <span title="Transformer" class="read-more">
                                                                <span class="ts_contract_icon ts_trx_unit icon-energy"></span>
                                                            </span>
                                                        </div>
                                                    </label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1-2-<?= $idAss ?>" role="tabpanel"
                                     aria-labelledby="tab_1-2-<?= $idAss ?>">
                                    <div class="form-group row">
                                        <label for="company_add" class="col-sm-3 col-form-label text-right">Company
                                            <span class="required">*</span></label>
                                        <div class="col-sm-6 col-xs-12">
                                            <select class="form-control form-control-border form-control-sm select2"
                                                    style="width: 100%;"
                                                    id="company_add" name="company_id"
                                                    data-action="company_add" onchange="get_company_info(this.id)">
                                                <?php $company_id = (new Connect\Contract)->getAllCompanyId(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contract_no" class="col-sm-3 col-form-label text-right">Contract No
                                            <span class="required">*</span></label>
                                        <div class="col-sm-6 col-xs-12 input-group">
                                            <input type="number" id="contract_no" name="contract_id" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <span class="col-sm-6 col-xs-12 offset-sm-3" id="contract_no_res"></span>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quote_num" class="col-sm-3 col-form-label text-right">Quote No
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="text" id="quote_num" name="quote_no" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="date" id="quote_date" name="quote_date" value="2020-02-02"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <label for="quote_date" class="col-sm-3 col-form-label text-left">
                                            <span class="required">*</span> Quote Date
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="quantity" class="col-sm-3 col-form-label text-right">
                                            Quantity
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="number" id="quantity" name="quantity" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="date" id="required_date" name="required_date"
                                                   value="2020-02-02"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <label for="required_date" class="col-sm-3 col-form-label text-left">
                                            <span class="required">*</span> Date Required
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="job_no" class="col-sm-3 col-form-label text-right">
                                            Job No <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="number" id="job_no" name="job_no" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="number" id="sales_order_no" name="sales_order_no" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <label for="sales_order_no" class="col-sm-3 col-form-label text-left">
                                            <span class="required">*</span> Sales Order No
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="paymentTM" class="col-sm-3 col-form-label text-right">
                                            Payment Terms/Method <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="text" id="paymentTM" name="paymentTM" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="text" id="commissioning" name="commissioning" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <label for="commissioning" class="col-sm-3 col-form-label text-left">
                                            <span class="required">*</span> Commissioning
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="service_notified" class="col-sm-3 col-form-label text-right">
                                            Service Notified <span class="required">*</span>
                                        </label>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="text" id="service_notified" name="service_notified" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <div class="col-sm-3 col-xs-12 input-group">
                                            <input type="text" id="penalty_clause" name="penalty_clause" value="1"
                                                   class="form-control form-control-border form-control-sm"
                                                   required>
                                        </div>
                                        <label for="penalty_clause" class="col-sm-3 col-form-label text-left">
                                            <span class="required">*</span> Penalty Clause
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label for="salesperson_id" class="col-sm-3 col-form-label text-right">
                                            Salesperson <span class="required">*</span></label>
                                        <div class="col-sm-6 col-xs-12">
                                            <select class="form-control form-control-border form-control-sm select2"
                                                    style="width: 100%;"
                                                    id="salesperson_id" name="salesperson_id">
                                                <option value="Rental/Sales|N/A">Crestchic Rental/Sales</option>
                                                <?php $salesperson_ids = (new Connect\Contract)->getAllSalesmen(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="info"></div>
                                </div>
                                <div class="tab-pane fade" id="tab_1-3-<?= $idAss ?>" role="tabpanel"
                                     aria-labelledby="tab_1-3-<?= $idAss ?>">
                                    <div title="Electrical Specification">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="sgh-box">
                                                        <div class="row m-b-30 electrical_spec_config">
                                                            <div class="col-md-3">
                                                                <h2 class="StepTitle">Current Flow</h2>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="current_flow" value="AC"
                                                                               class="md-radio"
                                                                            <?php
                                                                            if ($current_flow == "AC") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        AC
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="current_flow"
                                                                               value="DC Constant Current"
                                                                               class="md-radio" id="DCCI"
                                                                            <?php
                                                                            if ($current_flow == "DC Constant Current") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        DC Constant Current
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="current_flow"
                                                                               value="DC Constant Voltage"
                                                                               class="md-radio" id="DCCV"
                                                                            <?php
                                                                            if ($current_flow == "DC Constant Voltage") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        DC Constant Voltage
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h2 class="StepTitle">Load Type</h2>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="load_type"
                                                                               value="Resistive" class="md-radio"
                                                                               id="resistive"
                                                                            <?php
                                                                            if ($load_type == "Resistive") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Resistive
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="load_type"
                                                                               value="Resistive/Reactive"
                                                                               class="md-radio"
                                                                               id="ResistiveReactive"
                                                                            <?php
                                                                            if ($load_type == "Resistive/Reactive") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Resistive/Reactive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h2 class="StepTitle">Configuration</h2>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="config"
                                                                               value="Single Phase" class="md-radio"
                                                                            <?php
                                                                            if ($config == "Single Phase") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Single Phase
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="config"
                                                                               value="Star" class="md-radio"
                                                                            <?php
                                                                            if ($config == "Star") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Star
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="config"
                                                                               value="Delta" class="md-radio"
                                                                            <?php
                                                                            if ($config == "Delta") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Delta
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="config"
                                                                               value="Star/Delta" class="md-radio"
                                                                               id="StarDelta"
                                                                            <?php
                                                                            if ($config == "Star/Delta") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Star/Delta
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <h2 class="StepTitle">Usage</h2>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="usage_frequency"
                                                                               value="Periodically" class="md-radio"
                                                                            <?php
                                                                            if ($usage == "Periodically") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Periodically
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--block">
                                                                    <label>
                                                                        <input type="radio" name="usage_frequency"
                                                                               value="Continuous" class="md-radio"
                                                                            <?php
                                                                            if ($usage == "Continuous") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="circle"></span><span
                                                                                class="check"></span>
                                                                        Continuous
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="well" style="background-color: #fff;" id="ac_res">
                                                        <h4>Power rating</h4>
                                                        <div class="row">
                                                            <div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="<?= $mainKW ?>" class="sgh-input"
                       required>
                <label for="mainKW" class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS</label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyV">
                                                                        <option selected value="<?= $supplyV ?>"
                                                                        <?=
                                                                        $supplyV ?>
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz</label>
                                                                    <select class="form-control"
                                                                            name="supplyHz">
                                                                        <option selected value="<?= $supplyHz ?>"
                                                                        <?=
                                                                        $supplyHz ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyPH">
                                                                    <label>PH</label>
                                                                    <select class="form-control supplyPH"
                                                                            name="supplyPH">
                                                                        <option selected value="<?= $supplyPH ?>"
                                                                        <?=
                                                                        $supplyPH ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($supplyW, "2") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($supplyW, "3") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($supplyW, "4") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well" style="background-color: #fff;" id="ac_res_sd">
                                                        <div class="row">
                                                            <h4>Power rating</h4>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="<?= $mainKW ?>" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">Star kW: *</label>
            </span>
                                                            </div>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKWSD" type="number" value="<?= $mainKWSD ?>" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">Delta kW: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Star</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyV">
                                                                        <option selected value="<?= $supplyV ?>"
                                                                        <?=
                                                                        $supplyV ?>
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz
                                                                        <small>Star</small>
                                                                    </label>
                                                                    <select class="form-control"
                                                                            name="supplyHz">
                                                                        <option selected value="<?= $supplyHz ?>"
                                                                        <?=
                                                                        $supplyHz ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Delta</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVSD">
                                                                        <option selected value="<?= $supplyVSD ?>">
                                                                            <?=
                                                                            $supplyVSD ?>
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz
                                                                        <small>Delta</small>
                                                                    </label>
                                                                    <select class="form-control" name="supplyHzSD">
                                                                        <option selected
                                                                                value="<?= $supplyHzSD ?>"> .
                                                                            <?= $supplyHzSD ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>PH</label>
                                                                    <select class="form-control" name="supplyPH">
                                                                        <option selected value="<?= $supplyPH ?>"
                                                                        <?=
                                                                        $supplyPH ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 col-sm-4 col-xs-12">
                                                                <div class="form-group supplyW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="2" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($supplyW, "2") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="3" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($supplyW, "3") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="supplyW"
                                                                                      value="4" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($supplyW, "4") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="ac_res_rac">
                                                        <div class="well" style="background-color: #fff;">
                                                            <div class="row" id="supplyConditions">
                                                                <h4>Power rating</h4>
                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA">
                                                        <span data-component="Input" class="sgh-input-wrapper">
                                                            <input name="mainKVA" type="number"
                                                                   placeholder="7000" value="<?= $mainKVA ?>"
                                                                   class="sgh-input mainKWCal" id="mainKVA"
                                                                   required>
                                                            <label for="mainKVA"
                                                                   class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label>
                                                        </span>
                                                    </span>


                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF">
                                                        <span data-component="Input" class="sgh-input-wrapper">
                                                            <input id="mainPF" name="mainPF" step="0.01" max="1"
                                                                   type="number" placeholder="0.6"
                                                                   value="<?= $mainPF ?>"
                                                                   class="sgh-input mainKWCal" required>
                                                            <label for="mainPF"
                                                                   class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label>
                                                        </span>
                                                    </span>
                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW">
                                                        <span data-component="Input" class="sgh-input-wrapper">
                                                            <input name="mainKW" type="number"
                                                                   class="sgh-input" value="<?= $mainKW ?>"
                                                                   id="mainKW">
                                                            <label for="mainKW"
                                                                   class="sgh-form-item-label sgh-form-item-label-top">kW: </label>
                                                        </span>
                                                    </span>
                                                            </div>
                                                        </div>
                                                        <div class="well" style="background-color: #fff;">
                                                            <h4>Test Supply</h4>
                                                            <div class="row">
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>VOLTS</label>
                                                                        <select class="form-control withOther"
                                                                                name="supplyV">
                                                                            <option selected
                                                                                    value="<?= $supplyV ?>"> .
                                                                                <?= $supplyV ?>
                                                                            </option>
                                                                            <option value="230">230</option>
                                                                            <option value="240">240</option>
                                                                            <option value="380">380</option>
                                                                            <option value="400">400</option>
                                                                            <option value="415">415</option>
                                                                            <option value="480">480</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                        <input class="form-control otherField" disabled
                                                                               type="text" name="supplyVOther"
                                                                               placeholder="Please state..."
                                                                               onkeypress="return isNumberSlash();">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Hz</label>
                                                                        <select class="form-control"
                                                                                name="supplyHz">
                                                                            <option selected
                                                                                    value="<?= $supplyHz ?>"> .
                                                                                <?= $supplyHz ?>
                                                                            </option>
                                                                            <option value="N/A">N/A</option>
                                                                            <option value="50">50</option>
                                                                            <option value="60">60</option>
                                                                            <option value="50/60">50/60</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>PH</label>
                                                                        <select class="form-control supplyPH"
                                                                                name="supplyPH">
                                                                            <option selected
                                                                                    value="<?= $supplyPH ?>"> .
                                                                                <?= $supplyPH ?>
                                                                            </option>
                                                                            <option value="N/A">N/A</option>
                                                                            <option value="1">1</option>
                                                                            <option value="3">3</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                                    <div class="form-group supplyW">
                                                                        <label>WIRE</label>
                                                                        <div class="row"></div>
                                                                        <div class="checkbox checkbox-default sgh--checkbox">
                                                                            <label><input type="checkbox"
                                                                                          name="supplyW" value="2"
                                                                                          class="md-checkbox"
                                                                                    <?php
                                                                                    if (strpos($supplyW, "2") !== false) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>
                                                                                ><span class="checkbox-material"><span
                                                                                            class="check"></span></span>
                                                                                2</label></div>
                                                                        <div class="checkbox checkbox-default sgh--checkbox">
                                                                            <label><input type="checkbox"
                                                                                          name="supplyW" value="3"
                                                                                          class="md-checkbox"
                                                                                    <?php
                                                                                    if (strpos($supplyW, "3") !== false) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>
                                                                                ><span class="checkbox-material"><span
                                                                                            class="check"></span></span>
                                                                                3</label></div>
                                                                        <div class="checkbox checkbox-default sgh--checkbox">
                                                                            <label><input type="checkbox"
                                                                                          name="supplyW" value="4"
                                                                                          class="md-checkbox"
                                                                                    <?php
                                                                                    if (strpos($supplyW, "4") !== false) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>
                                                                                ><span class="checkbox-material"><span
                                                                                            class="check"></span></span>
                                                                                4</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="ac_res_rac_sd">
                                                        <div class="well"
                                                             style="background-color: #fff;">
                                                            <div class="row" id="supplyConditions">
                                                                <h4>Power rating
                                                                    <small>Star power rating</small>
                                                                </h4>
                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA">
                                                        <span data-component="Input" class="sgh-input-wrapper">
                                                            <input name="mainKVA" type="number"
                                                                   placeholder="7000" value="<?= $mainKVA ?>"
                                                                   class="sgh-input mainKWCal" id="mainKVA"
                                                                   required>
                                                            <label class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label>
                                                        </span>
                                                    </span>
                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF">
                                                        <span data-component="Input" class="sgh-input-wrapper">
                                                            <input id="mainPF" name="mainPF" step="0.01" max="1"
                                                                   type="number" placeholder="0.6"
                                                                   value="<?= $mainPF ?>"
                                                                   class="sgh-input mainKWCal" required>
                                                            <label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label>
                                                        </span>
                                                    </span>
                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW">
                                                        <span data-component="Input" class="sgh-input-wrapper">
                                                            <input name="mainKW" type="number"
                                                                   class="sgh-input" value="<?= $mainKW ?>"
                                                                   id="mainKW">
                                                            <label class="sgh-form-item-label sgh-form-item-label-top">kW: </label>
                                                        </span>
                                                    </span>
                                                            </div>
                                                            <div class="row" id="supplyConditionsSD">
                                                                <h4>Power rating
                                                                    <small>Delta power rating</small>
                                                                </h4>

                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA">
                                                            <span data-component="Input" class="sgh-input-wrapper">
                                                                <input name="mainKVASD" type="number"
                                                                       value="<?= $mainKVASD ?>"
                                                                       class="sgh-input mainKWSDCal">
                                                                <label class="sgh-form-item-label sgh-form-item-label-top">kVA: </label>
                                                            </span>
                                                        </span>

                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF">
                                                            <span data-component="Input" class="sgh-input-wrapper">
                                                                <input name="mainPFSD" type="number" step="0.01" max="1"
                                                                       value="<?= $mainPFSD ?>"
                                                                       class="sgh-input mainKWSDCal">
                                                                <label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: </label>
                                                            </span>
                                                        </span>
                                                                <span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW">
                                                            <span data-component="Input" class="sgh-input-wrapper">
                                                                <input name="mainKWSD" type="number"
                                                                       value="<?= $mainKWSD ?>" class="sgh-input"
                                                                       required="">
                                                                <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
                                                            </span>
                                                        </span>
                                                            </div>
                                                        </div>
                                                        <div class="well" style="background-color: #fff;">
                                                            <h4>Test Supply</h4>
                                                            <div class="row">
                                                                <div class="col-md-2 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>VOLTS
                                                                            <small>Star</small>
                                                                        </label>
                                                                        <select class="form-control withOther"
                                                                                name="supplyV">
                                                                            <option selected
                                                                                    value="<?= $supplyV ?>"> .
                                                                                <?= $supplyV ?>
                                                                            </option>
                                                                            <option value="230">230</option>
                                                                            <option value="240">240</option>
                                                                            <option value="380">380</option>
                                                                            <option value="400">400</option>
                                                                            <option value="415">415</option>
                                                                            <option value="480">480</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                        <input class="form-control otherField" disabled
                                                                               type="text" name="supplyVOther"
                                                                               placeholder="Please state..."
                                                                               onkeypress="return isNumberSlash();">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Hz
                                                                            <small>Star</small>
                                                                        </label>
                                                                        <select class="form-control"
                                                                                name="supplyHz">
                                                                            <option selected
                                                                                    value="<?= $supplyHz ?>"> .
                                                                                <?= $supplyHz ?>
                                                                            </option>
                                                                            <option value="N/A">N/A</option>
                                                                            <option value="50">50</option>
                                                                            <option value="60">60</option>
                                                                            <option value="50/60">50/60</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>VOLTS
                                                                            <small class="labelStar">Delta</small>
                                                                        </label>
                                                                        <select class="form-control withOther"
                                                                                name="supplyVSD">
                                                                            <option selected
                                                                                    value="<?= $supplyVSD ?>"> .
                                                                                <?= $supplyV ?>
                                                                            </option>
                                                                            <option value="230">230</option>
                                                                            <option value="240">240</option>
                                                                            <option value="380">380</option>
                                                                            <option value="400">400</option>
                                                                            <option value="415">415</option>
                                                                            <option value="480">480</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                        <input class="form-control otherField" disabled
                                                                               type="text" name="supplyVSDOther"
                                                                               placeholder="Please state..."
                                                                               onkeypress="return isNumberSlash();">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-2 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>Hz
                                                                            <small>Delta</small>
                                                                        </label>
                                                                        <select class="form-control"
                                                                                name="supplyHzSD">
                                                                            <option selected
                                                                                    value="<?= $supplyHz ?>"> .
                                                                                <?= $supplyHz ?>
                                                                            </option>
                                                                            <option value="N/A">N/A</option>
                                                                            <option value="50">50</option>
                                                                            <option value="60">60</option>
                                                                            <option value="50/60">50/60</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-4 col-xs-12">
                                                                    <div class="form-group">
                                                                        <label>PH</label>
                                                                        <select class="form-control supplyPH"
                                                                                name="supplyPH">
                                                                            <option selected
                                                                                    value="<?= $supplyPH ?>"> .
                                                                                <?= $supplyPH ?>
                                                                            </option>
                                                                            <option value="N/A">N/A</option>
                                                                            <option value="1">1</option>
                                                                            <option value="3">3</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-4 col-xs-12">
                                                                    <div class="form-group supplyW">
                                                                        <label>WIRE</label>
                                                                        <div class="row"></div>
                                                                        <div class="checkbox checkbox-default sgh--checkbox">
                                                                            <label><input type="checkbox"
                                                                                          name="supplyW" value="2"
                                                                                          class="md-checkbox"
                                                                                    <?php
                                                                                    if (strpos($supplyW, "2") !== false) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>
                                                                                ><span class="checkbox-material"><span
                                                                                            class="check"></span></span>
                                                                                2</label></div>
                                                                        <div class="checkbox checkbox-default sgh--checkbox">
                                                                            <label><input type="checkbox"
                                                                                          name="supplyW" value="3"
                                                                                          class="md-checkbox"
                                                                                    <?php
                                                                                    if (strpos($supplyW, "3") !== false) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>
                                                                                ><span class="checkbox-material"><span
                                                                                            class="check"></span></span>
                                                                                3</label></div>
                                                                        <div class="checkbox checkbox-default sgh--checkbox">
                                                                            <label><input type="checkbox"
                                                                                          name="supplyW" value="4"
                                                                                          class="md-checkbox"
                                                                                    <?php
                                                                                    if (strpos($supplyW, "4") !== false) {
                                                                                        echo "checked";
                                                                                    }
                                                                                    ?>
                                                                                ><span class="checkbox-material"><span
                                                                                            class="check"></span></span>
                                                                                4</label></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well" style="background-color: #fff;"
                                                         id="dc_cc_res">
                                                        <div class="row">
                                                            <h4>Power rating</h4>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="<?= $mainKW ?>" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Min</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyV">
                                                                        <option selected value="<?= $supplyV ?>"
                                                                        <?=
                                                                        $supplyV ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Max</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVSD">
                                                                        <option selected value="<?= $supplyVSD ?>">
                                                                            <?=
                                                                            $supplyVSD ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="supplyHzSD" value="N/A">
                                                            <input type="hidden" name="supplyPH" value="N/A">
                                                        </div>
                                                    </div>
                                                    <div class="well" style="background-color: #fff;"
                                                         id="dc_cc_res_sd">
                                                        <h4>Power rating</h4>
                                                        <div class="row">
                                                            <div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="<?= $mainKW ?>" class="sgh-input"
                       required>
                <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <h4>Test Supply</h4>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Star Min</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyV">
                                                                        <option selected value="<?= $supplyV ?>"
                                                                        <?=
                                                                        $supplyV ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12"
                                                                 id="dcSupplyV2">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Star Max</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVSD">
                                                                        <option selected value="<?= $supplyVSD ?>">
                                                                            <?=
                                                                            $supplyVSD ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVSDOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Delta Min</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVD1">
                                                                        <option selected value="<?= $supplyVD1 ?>"
                                                                        <?=
                                                                        $supplyVD1 ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVD1Other"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS
                                                                        <small>Delta Max</small>
                                                                    </label>
                                                                    <select class="form-control withOther"
                                                                            name="supplyVD2">
                                                                        <b>
                                                                            <option selected
                                                                                    value="<?= $supplyVD2 ?>"> .
                                                                                <?= $supplyVD2 ?>
                                                                            </option>
                                                                        </b>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="supplyVD2Other"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="supplyHzSD" value="N/A">
                                                            <input type="hidden" name="supplyPH" value="N/A">
                                                        </div>
                                                    </div>
                                                    <div class="well" style="background-color: #fff;"
                                                         id="dc_cv_res">
                                                        <div class="row">
                                                            <h4>Power rating</h4>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainKW" type="number" value="<?= $mainKW ?>" class="sgh-input" required>
                <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
            </span>
                                                            </div>
                                                            <div class="sgh-form-item col-sm-6 col-xs-12">
            <span data-component="Input" class="sgh-input-wrapper">
                <input name="mainAMPS" type="number" value="<?= $mainAMPS ?>" class="sgh-input" required>
                <label for="mainAMPS" class="sgh-form-item-label sgh-form-item-label-top">AMPS: *</label>
            </span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="supplyV" value="N/A">
                                                        <input type="hidden" name="supplyVSD" value="N/A">
                                                        <input type="hidden" name="supplyHz" value="N/A">
                                                        <input type="hidden" name="supplyHzSD" value="N/A">
                                                        <input type="hidden" name="supplyPH" value="N/A">

                                                    </div>

                                                    <div class="well" style="background-color: #fff;">
                                                        <h4>Auxiliary Supply</h4>
                                                        <div class="form-group" style="padding-left: 15px;">
                                                            <label>Auxiliary Type</label>
                                                            <div class="row">
                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label><input type="checkbox" name="auxInfo"
                                                                                  value="Internal" class="md-checkbox"
                                                                            <?php
                                                                            if (strpos($auxInfo, "Internal") !== false) {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        Internal </label></div>
                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label><input type="checkbox" name="auxInfo"
                                                                                  value="External" class="md-checkbox"
                                                                            <?php
                                                                            if (strpos($auxInfo, "External") !== false) {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        External </label></div>
                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label><input type="checkbox" name="auxInfo"
                                                                                  value="Switched" class="md-checkbox"
                                                                            <?php
                                                                            if (strpos($auxInfo, "Switched") !== false) {
                                                                                echo "checked";
                                                                            }
                                                                            ?>
                                                                        ><span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        Switched </label></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>VOLTS</label>
                                                                    <select class="form-control withOther"
                                                                            name="auxSV">
                                                                        <option selected
                                                                                value="<?= $auxSV ?>"> <?= $auxSV ?>
                                                                        </option>
                                                                        <option value="230">230</option>
                                                                        <option value="240">240</option>
                                                                        <option value="380">380</option>
                                                                        <option value="400">400</option>
                                                                        <option value="415">415</option>
                                                                        <option value="480">480</option>
                                                                        <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control otherField" disabled
                                                                           type="text" name="auxSVOther"
                                                                           placeholder="Please state..."
                                                                           onkeypress="return isNumberSlash();">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Hz</label>
                                                                    <select class="form-control"
                                                                            name="auxSHz">
                                                                        <option selected value="<?= $auxSHz ?>"><?=
                                                                            $auxSHz ?>
                                                                        </option>
                                                                        <option value="N/A">N/A</option>
                                                                        <option value="50">50</option>
                                                                        <option value="60">60</option>
                                                                        <option value="50/60">50/60</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>PH</label>
                                                                    <select class="form-control"
                                                                            name="auxSPH">
                                                                        <option selected value="<?= $auxSPH ?>"><?=
                                                                            $auxSPH ?>
                                                                        </option>
                                                                        <option value="1">1</option>
                                                                        <option value="3">3</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="form-group auxSW">
                                                                    <label>WIRE</label>
                                                                    <div class="row"></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="auxSW"
                                                                                      value="2" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($auxSW, "2") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            2</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="auxSW"
                                                                                      value="3" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($auxSW, "3") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            3</label></div>
                                                                    <div class="checkbox checkbox-default sgh--checkbox">
                                                                        <label><input type="checkbox" name="auxSW"
                                                                                      value="4" class="md-checkbox"
                                                                                <?php
                                                                                if (strpos($auxSW, "4") !== false) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>
                                                                            ><span class="checkbox-material"><span
                                                                                        class="check"></span></span>
                                                                            4</label></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="well" style="background-color: #fff;">
                                                        <h4 class="StepTitle">Ambient Temperature Operation Range
                                                            <b>&#8451;</b></h4>
                                                        <input type="text" id="range_temperature_2" name="range"/>
                                                        <input type="hidden" id="range_tempC" name="range_temp_C"/>
                                                        <input type="hidden" id="rangeTempCFrom"
                                                               value="$rangeTempCFrom"/>
                                                        <input type="hidden" id="rangeTempCTo"
                                                               value="<?=$rangeTempCTo?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1-4-<?= $idAss ?>" role="tabpanel"
                                     aria-labelledby="tab_1-3-<?= $idAss ?>">
                                    <div title="Control Specification">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="sgh-box">
                                                    <h4>Control System</h4>
                                                    <div class="row">
                                                        <div class="col-md-8 col-sm-12 col-xs-12 col-md-push-2">
                                                            <label>Controller</label>
                                                            <div class="row">
                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="controller"
                                                                               value="Baseload" class="md-checkbox"<?php
                                                                        if (strpos($controller, "Baseload") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        Baseload
                                                                    </label>
                                                                </div>

                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="controller"
                                                                               value="KCS" class="md-checkbox"<?php
                                                                        if (strpos($controller, "KCS") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        KCS
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="controller"
                                                                               value="MCS" class="md-checkbox open_xtra" data-action="nova"<?php
                                                                        if (strpos($controller, "MCS") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        MCS
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="controller"
                                                                               value="Toggle Switches" class="md-checkbox"<?php
                                                                        if (strpos($controller, "Toggle Switches") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        Toggle Switches
                                                                    </label>
                                                                </div>

                                                                <div class="checkbox checkbox-default sgh--checkbox">
                                                                    <label>
                                                                        <input type="checkbox" name="controller"
                                                                               value="Tracker" class="md-checkbox"<?php
                                                                        if (strpos($controller, "Tracker") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        Tracker
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="controller"
                                                                               value="WTT" class="md-checkbox"<?php
                                                                        if (strpos($controller, "WTT") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material"><span
                                                                                    class="check"></span></span>
                                                                        WTT
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="row content_option_nova">
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="controller_sub[]" value="Nova" class="md-checkbox open_xtra" data-action="nova_xtra"<?php
                                                                        if (strpos($controller_sub, "Nova") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material">
                                                                                <span class="check"></span>
                                                                            </span> Nova
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="row content_option_nova_xtra">
                                                                <p>Controller Packages</p>
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="controller_packages[]" value="Nova Platform PC software" class="md-checkbox open_xtra1" data-action="nova_xtra1"<?php
                                                                        if (strpos($controller_packages, "Nova Platform PC software") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material">
                                                                                    <span class="check"></span>
                                                                                </span> Nova Platform PC software
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="controller_packages[]" value="Nova Platform LC80 Controller" class="md-checkbox open_xtra1" data-action="nova_xtra1"<?php
                                                                        if (strpos($controller_packages, "Nova Platform LC80 Controller") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material">
                                                                                        <span class="check"></span>
                                                                                    </span> Nova Platform LC80 Controller
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="controller_packages[]" value="Solar Platform Controller" class="md-checkbox open_xtra1" data-action="nova_xtra1"<?php
                                                                        if (strpos($controller_packages, "Solar Platform Controller") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material">
                                                                                            <span class="check"></span>
                                                                                        </span> Solar Platform Controller
                                                                    </label>
                                                                </div>
                                                                <p>Interconnecting Packages</p>
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="interconnecting_packages[]" value="Interconnection Package 1" class="md-checkbox open_xtra1" data-action="nova_xtra1"<?php
                                                                        if (strpos($interconnecting_packages, "Interconnection Package 1") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material">
                                                                                                <span class="check"></span>
                                                                                            </span> Interconnection Package 1
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--checkbox checkbox-default">
                                                                    <label>
                                                                        <input type="checkbox" name="interconnecting_packages[]" value="Interconnection Package 2" class="md-checkbox open_xtra1" data-action="nova_xtra1"<?php
                                                                        if (strpos($interconnecting_packages, "Interconnection Package 2") !== false) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>
                                                                        <span class="checkbox-material">
                                                                                                    <span class="check"></span>
                                                                                                </span> Interconnection Package 2
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" style="padding-left: 15px;">
                                                                <div class="form-group" id="leadSection">
                                                                    <div class="col-md-3">
                                                                        <label>Control Leads</label>
                                                                        <select class="form-control withOther"
                                                                                id="lead">
                                                                            <option value="Comms Lead">Comms Lead
                                                                            </option>
                                                                            <option value="Ext Reel">Ext Reel</option><option value="HHT Lead">HHT Lead</option><option value="KCS100HM Lead">KCS100HM Lead</option><option value="LC60 Lead">LC60 Lead</option><option value="LC80 Lead">LC80 Lead</option>
                                                                            <option value="PC Lead">PC Lead</option>
                                                                            <option value="System Extend">System
                                                                                Extend
                                                                            </option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                        <input class="form-control leadInput otherField"
                                                                               id="leadOther" type="text"
                                                                               placeholder="Please State..">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Length</label>
                                                                        <select class="form-control withOther"
                                                                                id="leadLength">
                                                                            <option value="5m">5m</option>
                                                                            <option value="10m">10m</option>
                                                                            <option value="20m">20m</option>
                                                                            <option value="50m">50m</option>
                                                                            <option value="100m">100m</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                        <input class="form-control leadInput otherField"
                                                                               id="leadLengthOther" type="text"
                                                                               placeholder="Please State..">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Quantity</label>
                                                                        <input class="form-control leadInput"
                                                                               id="leadNo" type="number">
                                                                    </div>
                                                                    <div class="col-md-1" style="margin-top: 25px;">
                                                                        <button class="btn-sm btn btn-success"
                                                                                id="addControlLead" type="button"
                                                                                onclick="add_control_lead()">
                                                                            Add
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tags_1">Controller Leads Selected</label>
                                                                    <input id="tags_1" type="text"
                                                                           class="tags form-control"
                                                                           value="<?=$leads?>"/>
                                                                    <div id="suggestions-container"
                                                                         style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                                                    <input class="form-control sgh--tags-box"
                                                                           type="hidden" name="leads" id="conLeads"
                                                                           value="<?=$leads?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="control_info" style="margin-top: 20px;">Controller
                                                                        Information</label>
                                                                    <textarea class="form-control" name="control_info"
                                                                              rows="3" id="control_info"
                                                                              style="margin: 0 78px 30px 0; max-width: 100%; height: 84px;"
                                                                    <?php
                                                                    if (empty($control_info)) {
                                                                        echo 'placeholder="No data found"';
                                                                        }

                                                                    if (!empty($control_info)) {
                                                                        echo $control_info;
                                                                    }
                                                                    ?>
                                                                    ></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1-5-<?= $idAss ?>" role="tabpanel"
                                     aria-labelledby="tab_1-5-<?= $idAss ?>">
                                    <div title="Transformer Specification">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="sgh-box">
                                                    <h4>Transformer Specification</h4>
                                                    <div class="row">
                                                        <div class="row m-b-30">
                                                            <div class="col-md-4">
                                                                <h2 class="StepTitle">Cooling Type</h2>
                                                                <div class="sgh--radio radio radio-default sgh--inline-block">
                                                                    <label>
                                                                        <input type="radio" name="coolingType"
                                                                               value="Cast Resin" class="md-radio"
                                                                               <?php
                                                                        if ($coolingType == "Cast Resin") {
                                                                        echo "checked";
                                                                        }
                                                                        ?>><span class="circle"></span><span class="check"></span>
                                                                        Cast Resin
                                                                    </label>
                                                                </div>
                                                                <div class="sgh--radio radio radio-default sgh--inline-block">
                                                                    <label>
                                                                        <input type="radio" name="coolingType"
                                                                               value="Oil Cooled"
                                                                               class="md-radio"
                                                                               <?php
                                                                        if ($coolingType == "Oil Cooled") {
                                                                        echo "checked";
                                                                        }
                                                                        ?>><span class="circle"></span><span class="check"></span>
                                                                        Oil Cooled
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h2 class="StepTitle">Transformer Rating</h2>
                                                                <div class="col-md-6">
                                                                    <label>Primary Rating (Volts)</label>
                                                                    <input class="form-control" type="number" name="txPRating" value="<?= $txPRating ?>">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label>Secondary Rating (Volts)</label>
                                                                    <input class="form-control" type="number" name="txSRating" value="<?= $txSRating ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div data-title="combi_tab_pane">
                                                            <div class="row m-b-30">
                                                                <div class="col-md-4">
                                                                    <h2 class="StepTitle">Fan Rotation</h2>
                                                                    <div class="sgh--radio radio radio-default sgh--inline-block">
                                                                        <label>
                                                                            <input type="radio" name="fanRotation"
                                                                                   value="Anticlockwise" class="md-radio"
                                                                                   <?php
                                                                            if ($fanRotation == "Anticlockwise") {
                                                                            echo "checked";
                                                                            }
                                                                            ?>>
                                                                            <span class="circle"></span><span
                                                                                    class="check"></span>
                                                                            Anticlockwise
                                                                        </label>
                                                                    </div>
                                                                    <div class="sgh--radio radio radio-default sgh--inline-block">
                                                                        <label>
                                                                            <input type="radio" name="fanRotation"
                                                                                   value="Clockwise"
                                                                                   class="md-radio"
                                                                                   <?php
                                                                            if ($fanRotation == "Clockwise") {
                                                                            echo "checked";
                                                                            }
                                                                            ?>><span class="circle"></span><span
                                                                                    class="check"></span>
                                                                            Clockwise
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <h2 class="StepTitle">Switchgear Rating</h2>
                                                                    <div class="col-md-6">
                                                                        <label>Primary Rating (Volts)</label>
                                                                        <input class="form-control" type="number" name="sgPRating" value="<?= $sgPRating ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label>Secondary Rating (Volts)</label>
                                                                        <input class="form-control" type="number" name="sgSRating" value="<?= $sgSRating ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row m-b-30">
                                                                <div class="col-md-4">
                                                                    <h2 class="StepTitle">Relay Type</h2>
                                                                    <div class="form-group">
                                                                        <label>ABB</label>
                                                                        <select class="form-control withOther"
                                                                                name="relayType">
                                                                            <option selected value="<?= $relayType ?>"><?= $relayType ?></option>
                                                                            <option value="REF615">REF615</option>
                                                                            <option value="REJ603 v1">REJ603 v1</option>
                                                                            <option value="REJ603 v3">REJ603 v3</option>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                        <input class="form-control otherField" disabled
                                                                               type="text" name="relayTypeOther"
                                                                               placeholder="Please state...">
                                                                    </div>
                                                                </div>
                                                            </div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab_1-6-<?= $idAss ?>" role="tabpanel"
                                     aria-labelledby="tab_1-6-<?= $idAss ?>">
                                    <div title="Other Information">
                                        <div id="mechSel">
                                            <div class="form-group row">
                                                <label for="enc" class="col-sm-3 col-form-label text-right">
                                                    Enclosure </label>
                                                <div class="col-sm-6 col-xs-12">
                                                    <select class="form-control form-control-sm" name="enc"
                                                            id="enc"
                                                            title="Style">
                                                        <option>--SELECT AN OPTION--</option>
                                                        <optgroup label="Canopy">
                                                            <option value="Horizontal" data-encType="Canopy">Small Enclosure</option>
                                                            <option value="Vertical" data-encType="Canopy">Vertical</option>
                                                        </optgroup>
                                                        <optgroup label="Container">
                                                            <option value="Container" data-encType="Container">Container</option>
                                                            <option value="Small Container" data-encType="Container">Small Container (1, 2 or
                                                                3 Fan)
                                                            </option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <span id="encStyle"></span>
                                            <span id="encSize"></span>

                                            <div class="form-group row sgh--d-none">
                                                <label for="encStyle" class="col-sm-3 col-form-label text-right">
                                                    Style </label>
                                                <div class="col-sm-6 col-xs-12 encStyle">
                                                    <select class="form-control form-control-sm" name="encStyle" id="">
                                                        <option>--SELECT AN OPTION--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row sgh--d-none encSize">
                                                <label for="encSize" class="col-sm-3 col-form-label text-right">
                                                    Size </label>
                                                <div class="col-sm-6 col-xs-12">
                                                    <select class="form-control form-control-sm size" name="encSize" id="encSize">
                                                        <option>--SELECT AN OPTION--</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row sgh--d-none" id="encLiftingCol">
                                                <label for="encLifting" class="col-sm-3 col-form-label text-right">
                                                    Lifting </label>
                                                <div class="col-sm-6 col-xs-12">
                                                    <select class="form-control form-control-sm" name="encLifting" id="encLifting">
                                                        <option value="Standard">Standard</option>
                                                        <option value="DMV">DMV</option>
                                                        <option value="N/A">N/A</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row sgh--d-none encHeight" id="encHeightCol">
                                                <label for="encHeight" class="col-sm-3 col-form-label text-right">
                                                    Height </label>
                                                <div class="col-sm-6 col-xs-12">
                                                    <input type="text" placeholder="Enter container's height"
                                                    name="encHeight" id="encHeight" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            <div class="form-group row sgh--d-none encBase" id="encBaseCol">
                                                <label for="encBase" class="col-sm-3 col-form-label text-right">
                                                    Base </label>
                                                <div class="col-sm-6 col-xs-12">
                                                    <select class="form-control form-control-sm withOther"
                                                            name="encBase" id="encBase">
                                                        <option>--SELECT AN OPTION--</option>
                                                    </select>
                                                    <input class="form-control otherField" disabled type="text"
                                                           name="encBaseOther"
                                                           placeholder="Please state...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>Information</label>
                                                <p>If colour does not exist choose "Other" & enter details in Other
                                                    Information</p>
                                            </div>

                                            <div class="col-md-3"></div>
                                            <div class="form-group col-md-3">
                                                <label>Finish Type</label>
                                                <select class="form-control form-control-sm withOther"
                                                        id="enc_finishType" name="enc_finishType"
                                                        title="Finish Type">
                                                    <option value="BS 4800">British Standard 4800
                                                    </option>
                                                    <option value="RAL">RAL</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Colours</label>
                                                <select class="form-control form-control-sm withOther" name="enc_finish"
                                                        title="Finish" id="enc_finish">
                                                    <option>--SELECT AN OPTION--</option>
                                                    <?php
                                                    bs_4800_colorsel();
                                                    ralcolorsel();
                                                    ?>
                                                    <option value="Other - Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="tab-pane fade" id="tab_1-7-<?= $idAss ?>" role="tabpanel"
                                 aria-labelledby="tab_1-7-<?= $idAss ?>">
                                <div title="Other Information">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="sgh-box">
                                                <div class="row">
                                                    <div class="col-md-8 col-sm-8 col-xs-12 col-md-push-2">
                                                        <div class="form-group">
                                                            <label>Other Information</label>
                                                            <textarea name="otherInfo" class="form-control"
                                                                      rows="3"
                                                                      style="margin: 0 24px 0 0;  max-width: 100%; height: 82px;"
                                                            <?php
                                                            if (empty($otherInfo)) {
                                                                echo 'placeholder="No data found"';
                                                                }

                                                            if (!empty($otherInfo)) {
                                                                echo $otherInfo;
                                                            }
                                                            ?>
                                                            ></textarea>
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
                </form>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
</section>
<!-- /.content -->

