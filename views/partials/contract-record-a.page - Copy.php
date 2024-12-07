<?php
/**
 * Some info
 **/
include "../inc/func.inc.php";
$contract_handler = new Connect\Contract;
?>
<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="new_job-tab" data-bs-toggle="tab"
                                   data-bs-target="#new_job" type="button" role="tab" aria-controls="new_job"
                                   aria-selected="true">New Job</a>
                                <div class="slide"></div>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="new_company_customer-tab" data-bs-toggle="tab"
                                   data-bs-target="#new_company_customer" type="button" role="tab"
                                   aria-controls="new_company_customer" aria-selected="false">New Company/Customer</a>
                                <div class="slide"></div>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="new_job" role="tabpanel"
                                 aria-labelledby="new_job-tab">
                                <p class="m-3">Add Job Details</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="wizard">
                                            <section>
                                                <form class="wizard-form" id="example-advanced-form" action="#">
                                                    <h3> Asset Type </h3>
                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="row center m-t-50 ts_contract_ty">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <label>
                                                                        <input class="ts_contract_type_radio" type="radio"
                                                                               name="contract_type" value="Single Unit"
                                                                               id="single_unit"
                                                                               onclick="ts_generate_a_form(this.id)">
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
                                                                               name="contract_type" value="Combi"
                                                                               id="combi"
                                                                               onclick="ts_generate_a_form(this.id)">
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
                                                                               onclick="ts_generate_a_form(this.id)">
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
                                                    </fieldset>
                                                    <h3> Job Details </h3>
                                                    <fieldset>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="company_add">Company
                                                                *</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control form-control-border form-control-sm companyData"
                                                                        style="width: 100%;"
                                                                        id="company_add" name="company_id"
                                                                        data-action="company_add"
                                                                        onchange="get_company_info(this.id)">
                                                                    <?php $company_id = $contract_handler->getAllCompanyId(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="contract_no">Contract
                                                                No *</label>
                                                            <div class="col-sm-9">
                                                                <input type="number" id="contract_no" name="contract_no"
                                                                       value="1"
                                                                       class="form-control form-control-border form-control-sm"
                                                                       required>
                                                            </div>
                                                            <span class="col-sm-6 col-xs-12 offset-sm-3"
                                                                  id="contract_no_res"></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="quote_no">Quote No *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="quote_no"
                                                                               name="quote_no" value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="quote_date">Quote Date *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" id="quote_date"
                                                                               name="quote_date" value="2020-02-02"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="quantity">Quantity *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="number" id="quantity" name="quantity"
                                                                               value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="required_date">Date Required *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="date" id="required_date"
                                                                               name="required_date"
                                                                               value="2020-02-02"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="job_no">Job No *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="number" id="job_no" name="job_no"
                                                                               value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="sales_order_no">Sales Order No *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="number" id="sales_order_no"
                                                                               name="sales_order_no" value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="paymentTM">Payment Terms/Method *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="paymentTM" name="paymentTM"
                                                                               value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="commissioning">Commissioning *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="commissioning"
                                                                               name="commissioning" value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="service_notified">Service Notified *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="service_notified"
                                                                               name="service_notified" value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group row">
                                                                    <label class="col-sm-3 col-form-label"
                                                                           for="penalty_clause">Penalty Clause *</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="penalty_clause"
                                                                               name="penalty_clause" value="1"
                                                                               class="form-control form-control-border form-control-sm"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 col-form-label" for="salesperson_id">Salesperson
                                                                *</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control form-control-border form-control-sm select2"
                                                                        style="width: 100%;"
                                                                        id="salesperson_id" name="salesperson_id">
                                                                    <option value="Rental/Sales|N/A">Crestchic
                                                                        Rental/Sales
                                                                    </option>
                                                                    <?php $salesperson_ids = $contract_handler->getAllSalesmen(); ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div id="info"></div>
                                                    </fieldset>
                                                    <h3> Electrical Specification </h3>
                                                    <fieldset id="electrical_spec"></fieldset>
                                                    <h3> Transformer Specification </h3>
                                                    <fieldset id="transformer_spec"></fieldset>
                                                    <h3> Mechanical Specification </h3>
                                                    <fieldset>
                                                        <h2 class="StepTitle">Enclosure</h2>
                                                        <div id="mechSel">
                                                            <div class="form-group row">
                                                                <label for="enc"
                                                                       class="col-sm-3 col-form-label text-right">
                                                                    Enclosure </label>
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <select class="form-control form-control-sm"
                                                                            name="enc"
                                                                            id="enc"
                                                                            title="Style">
                                                                        <option>--SELECT AN OPTION--</option>
                                                                        <optgroup label="Canopy">
                                                                            <option value="Horizontal"
                                                                                    data-encType="Canopy">Small
                                                                                Enclosure
                                                                            </option>
                                                                            <option value="Vertical"
                                                                                    data-encType="Canopy">Vertical
                                                                            </option>
                                                                        </optgroup>
                                                                        <optgroup label="Container">
                                                                            <option value="Container"
                                                                                    data-encType="Container">Container
                                                                            </option>
                                                                            <option value="Small Container"
                                                                                    data-encType="Container">Small
                                                                                Container (1, 2 or
                                                                                3 Fan)
                                                                            </option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <span id="encStyle"></span>
                                                            <span id="encSize"></span>

                                                            <div class="form-group row sgh--d-none">
                                                                <label for="encStyle"
                                                                       class="col-sm-3 col-form-label text-right">
                                                                    Style </label>
                                                                <div class="col-sm-6 col-xs-12 encStyle">
                                                                    <select class="form-control form-control-sm"
                                                                            name="encStyle" id="">
                                                                        <option>--SELECT AN OPTION--</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row sgh--d-none encSize">
                                                                <label for="encSize"
                                                                       class="col-sm-3 col-form-label text-right">
                                                                    Size </label>
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <select class="form-control form-control-sm size"
                                                                            name="encSize" id="encSize">
                                                                        <option>--SELECT AN OPTION--</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row sgh--d-none" id="encLiftingCol">
                                                                <label for="encLifting"
                                                                       class="col-sm-3 col-form-label text-right">
                                                                    Lifting </label>
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <select class="form-control form-control-sm"
                                                                            name="encLifting" id="encLifting">
                                                                        <option value="Standard">Standard</option>
                                                                        <option value="DMV">DMV</option>
                                                                        <option value="N/A">N/A</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row sgh--d-none encHeight"
                                                                 id="encHeightCol">
                                                                <label for="encHeight"
                                                                       class="col-sm-3 col-form-label text-right">
                                                                    Height </label>
                                                                <div class="col-sm-6 col-xs-12">
                                                                    <input type="text"
                                                                           placeholder="Enter container's height"
                                                                           name="encHeight" id="encHeight"
                                                                           class="form-control form-control-sm">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row sgh--d-none encBase"
                                                                 id="encBaseCol">
                                                                <label for="encBase"
                                                                       class="col-sm-3 col-form-label text-right">
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
                                                                <p>If colour does not exist choose "Other" & enter
                                                                    details in Other
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
                                                                <select class="form-control form-control-sm withOther"
                                                                        name="enc_finish"
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
                                                        <br><br><br>
                                                    </fieldset>
                                                    <h3> Other Information </h3>
                                                    <fieldset>
                                                        <h2 class="StepTitle">Step 4 Content</h2>
                                                        <div class="form-group">
                                                            <label>Other Information</label>
                                                            <textarea name="otherInfo" class="form-control" rows="3"
                                                                      style="margin: 0 78px 0 0; width: 100%; height: 84px;"
                                                                      title="Other Information"></textarea>
                                                        </div>
                                                        <div id="feedback"></div>
                                                    </fieldset>
                                                </form>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <form role="form" class="form-horizontal form-label-left" action="" method="POST"
                                      id="setJob">
                                    <div id="smartLoader"></div>
                                    <div id="ts_smart_wizard" class="form_wizard wizard_horizontal">
                                        <ul class="wizard_steps">
                                            <li>
                                                <a href="#step-0">
                                                    <span class="step_no"><i class="la la-flash"></i></span>
                                                    <span class="step_descr">
                                                  <small>Asset Type</small>
                                              </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-1">
                                                    <span class="step_no"><i class="la la-folder-open-o"></i></span>
                                                    <span class="step_descr">
                                                    <small>Job Details</small>
                                              </span>
                                                </a>
                                            </li>
                                            <li id="step_electric">
                                                <a href="#step-2">
                                                    <span class="step_no"><i class="la la-plug"></i></span>
                                                    <span class="step_descr">
                                                  <small>Electrical Specification</small>
                                              </span>
                                                </a>
                                            </li>
                                            <li id="step_tx">
                                                <a href="#step-3">
                                                    <span class="step_no">
                                                        <i class="la la-exchange"
                                                           style="margin-left: -2px;font-size: 14px;">
                                                        </i>
                                                    </span>
                                                    <span class="step_descr"><small>Transformer Specification</small></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-4">
                                                    <span class="step_no"><i class="la la-industry"></i></span>
                                                    <span class="step_descr">
                                                  <small>Mechanical Specification</small>
                                              </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#step-5">
                                                    <span class="step_no"><i class="la la-info"></i></span>
                                                    <span class="step_descr">
                                                  <small>Other Information</small>
                                              </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4 class="sub-title">Auxiliary Type</h4>
                                                <div class="border-checkbox-section">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="checkbox1" name="auxInfo" value="Internal">
                                                        <label class="border-checkbox-label" for="checkbox1">Internal</label>
                                                    </div>
                                                </div>
                                                <div class="border-checkbox-section">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="checkbox1" name="auxInfo" value="External">
                                                        <label class="border-checkbox-label" for="checkbox1">External</label>
                                                    </div>
                                                </div>
                                                <div class="border-checkbox-section">
                                                    <div class="border-checkbox-group border-checkbox-group-primary">
                                                        <input class="border-checkbox" type="checkbox" id="checkbox1" name="auxInfo" value="Switched">
                                                        <label class="border-checkbox-label" for="checkbox1">Switched</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div id="step-0">
                                                <div class="row">
                                                    <div class="row center m-t-50 ts_contract_ty">
                                                        <div class="col-md-6 col-sm-6">
                                                            <label>
                                                                <input class="ts_contract_type_radio" type="radio"
                                                                       name="contract_type" value="Single Unit"
                                                                       id="single_unit"
                                                                       onclick="ts_generate_a_form(this.id)">
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
                                                                       onclick="ts_generate_a_form(this.id)">
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
                                                                       onclick="ts_generate_a_form(this.id)">
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
                                            <div id="step-1">
                                                <div class="form-group row">
                                                    <label for="company_add" class="col-sm-3 col-form-label text-right">Company
                                                        <span class="required">*</span></label>
                                                    <div class="col-sm-6 col-xs-12">
                                                        <select class="form-control form-control-border form-control-sm select2"
                                                                style="width: 100%;"
                                                                id="company_add" name="company_id"
                                                                data-action="company_add"
                                                                onchange="get_company_info(this.id)">
                                                            <?php $company_id = (new Connect\Contract)->getAllCompanyId(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="contract_no" class="col-sm-3 col-form-label text-right">Contract
                                                        No
                                                        <span class="required">*</span></label>
                                                    <div class="col-sm-6 col-xs-12 input-group">
                                                        <input type="number" id="contract_no" name="contract_id" value="1"
                                                               class="form-control form-control-border form-control-sm"
                                                               required>
                                                    </div>
                                                    <span class="col-sm-6 col-xs-12 offset-sm-3"
                                                          id="contract_no_res"></span>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="quote_num" class="col-sm-3 col-form-label text-right">Quote
                                                        No
                                                        <span class="required">*</span>
                                                    </label>
                                                    <div class="col-sm-3 col-xs-12 input-group">
                                                        <input type="text" id="quote_num" name="quote_no" value="1"
                                                               class="form-control form-control-border form-control-sm"
                                                               required>
                                                    </div>
                                                    <div class="col-sm-3 col-xs-12 input-group">
                                                        <input type="date" id="quote_date" name="quote_date"
                                                               value="2020-02-02"
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
                                                    <label for="required_date"
                                                           class="col-sm-3 col-form-label text-left">
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
                                                        <input type="number" id="sales_order_no" name="sales_order_no"
                                                               value="1"
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
                                                        <input type="text" id="commissioning" name="commissioning"
                                                               value="1"
                                                               class="form-control form-control-border form-control-sm"
                                                               required>
                                                    </div>
                                                    <label for="commissioning"
                                                           class="col-sm-3 col-form-label text-left">
                                                        <span class="required">*</span> Commissioning
                                                    </label>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="service_notified"
                                                           class="col-sm-3 col-form-label text-right">
                                                        Service Notified <span class="required">*</span>
                                                    </label>
                                                    <div class="col-sm-3 col-xs-12 input-group">
                                                        <input type="text" id="service_notified" name="service_notified"
                                                               value="1"
                                                               class="form-control form-control-border form-control-sm"
                                                               required>
                                                    </div>
                                                    <div class="col-sm-3 col-xs-12 input-group">
                                                        <input type="text" id="penalty_clause" name="penalty_clause"
                                                               value="1"
                                                               class="form-control form-control-border form-control-sm"
                                                               required>
                                                    </div>
                                                    <label for="penalty_clause"
                                                           class="col-sm-3 col-form-label text-left">
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
                                                            <option value="Rental/Sales|N/A">Crestchic Rental/Sales
                                                            </option>
                                                            <?php $salesperson_ids = (new Connect\Contract)->getAllSalesmen(); ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="info"></div>
                                            </div>
                                            <div id="step-2"></div>
                                            <div id="step-3"></div>
                                            <div id="step-4">
                                                <h2 class="StepTitle">Enclosure</h2>
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
                                                                    <option value="Horizontal" data-encType="Canopy">
                                                                        Small Enclosure
                                                                    </option>
                                                                    <option value="Vertical" data-encType="Canopy">
                                                                        Vertical
                                                                    </option>
                                                                </optgroup>
                                                                <optgroup label="Container">
                                                                    <option value="Container" data-encType="Container">
                                                                        Container
                                                                    </option>
                                                                    <option value="Small Container"
                                                                            data-encType="Container">Small Container (1,
                                                                        2 or
                                                                        3 Fan)
                                                                    </option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <span id="encStyle"></span>
                                                    <span id="encSize"></span>

                                                    <div class="form-group row sgh--d-none">
                                                        <label for="encStyle"
                                                               class="col-sm-3 col-form-label text-right">
                                                            Style </label>
                                                        <div class="col-sm-6 col-xs-12 encStyle">
                                                            <select class="form-control form-control-sm" name="encStyle"
                                                                    id="">
                                                                <option>--SELECT AN OPTION--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row sgh--d-none encSize">
                                                        <label for="encSize" class="col-sm-3 col-form-label text-right">
                                                            Size </label>
                                                        <div class="col-sm-6 col-xs-12">
                                                            <select class="form-control form-control-sm size"
                                                                    name="encSize" id="encSize">
                                                                <option>--SELECT AN OPTION--</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row sgh--d-none" id="encLiftingCol">
                                                        <label for="encLifting"
                                                               class="col-sm-3 col-form-label text-right">
                                                            Lifting </label>
                                                        <div class="col-sm-6 col-xs-12">
                                                            <select class="form-control form-control-sm"
                                                                    name="encLifting" id="encLifting">
                                                                <option value="Standard">Standard</option>
                                                                <option value="DMV">DMV</option>
                                                                <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row sgh--d-none encHeight" id="encHeightCol">
                                                        <label for="encHeight"
                                                               class="col-sm-3 col-form-label text-right">
                                                            Height </label>
                                                        <div class="col-sm-6 col-xs-12">
                                                            <input type="text" placeholder="Enter container's height"
                                                                   name="encHeight" id="encHeight"
                                                                   class="form-control form-control-sm">
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
                                                        <p>If colour does not exist choose "Other" & enter details in
                                                            Other
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
                                                        <select class="form-control form-control-sm withOther"
                                                                name="enc_finish"
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
                                                <br><br><br>
                                            </div>
                                            <div id="step-5">
                                                <h2 class="StepTitle">Step 4 Content</h2>
                                                <div class="form-group">
                                                    <label>Other Information</label>
                                                    <textarea name="otherInfo" class="form-control" rows="3"
                                                              style="margin: 0 78px 0 0; width: 100%; height: 84px;"
                                                              title="Other Information"></textarea>
                                                </div>
                                                <div id="feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="create_job_message"></div>
                            </div>
                            <div class="tab-pane fade" id="new_company_customer" role="tabpanel"
                                 aria-labelledby="new_company_customer-tab">
                                <p class="m-0">Add a company or an associated user</p>
                                <form class="form-horizontal form-label-left" id="registerCusForm"
                                      method="POST" onsubmit="return false">
                                    <div class="form-group row">
                                        <div class="col-10 offset-2">
                                            <label class="col-sm-2 col-form-label">Company *</label>
                                            <div class="col-sm-10">
                                                <select class="form-control withOther" name="company">
                                                    <option>--SELECT AN OPTION--</option>
                                                    <option value="opt2">Type 2</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <input class="form-control otherField" disabled type="text"
                                                       name="company_other"
                                                       placeholder="Please state...">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8 col-lg-10">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Right addon">
                                                    <span class="input-group-append">
                                                        <label class="input-group-text">
                                                            <i class="icofont icofont-ui-wifi"></i>
                                                        </label>
                                                    </span>
                                                </div>
                                            </div>
                                            <label class="col-sm-4 col-lg-2 col-form-label">Full Contact Name *</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 col-md-push-2 col-sm-3 col-xs-12 form-group">
                                            <label>Company *</label>
                                            <select class="form-control form-control-sm withOther" name="company">";company_sel($conn);echo"
                                                <option value="Other">Other</option>
                                            </select>

                                        </div>

                                        <div class="col-md-4 col-md-push-2 col-sm-3 col-xs-12 form-group has-feedback">
                                            <label>Full Contact Name *</label>
                                            <input type="text" class="form-control has-feedback-left"
                                                   id="inputSuccess7"
                                                   name="fullName" required="required"
                                                   placeholder="Full Contact Name *">
                                            <span class="fa fa-user form-control-feedback left"
                                                  aria-hidden="true"></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 col-md-push-2 col-sm-6 col-xs-12 form-group has-feedback">
                                            <label>Email *</label>
                                            <input type="email" class="form-control" id="email-c" name="email"
                                                   required="required" placeholder="Email *">
                                            <span class="fa fa-envelope form-control-feedback right"
                                                  aria-hidden="true"></span>
                                            <div class="result-icon" id="result-icon-c"></div>
                                            <div id="result-c"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 col-md-push-2 col-sm-3 col-xs-12 form-group sgh--d-none">
                                            <div class="sgh--checkbox checkbox-default">
                                                <label>
                                                    <input type="checkbox" name="sendInfo" value="Yes"
                                                           class="md-checkbox" id="sendInfo">
                                                    <span class="checkbox-material"><span class="check"></span></span>
                                                    Send credentials to customer now?
                                                </label>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <div id="loader-c"></div>
                                            <div id="response-badC"></div>
                                            <button id="create-c" type="submit" name="cusSubmit"
                                                    class="btn btn-sm sgh--btn white-1"
                                                    onclick="register_company_customer(this.form)"><span
                                                        class="label_">Submit</span>
                                            </button>
                                        </div>
                                    </div>

                                </form>
                                <div id="response"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->


