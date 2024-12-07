<?php /** * Modal for editing leaves requested **/
require '../../../../config/inc/func.inc.php';
require '../../../../vendor/autoload.php';
$auth = new Connect\AuthorizationHandler;
$contract_handler = new Connect\Contract;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $contract_type = $_POST['contract_type'];
        if ($contract_type === 'Single Unit') {
            echo '
    <div id="smart_contract_form" class="smart_contract_form">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="#step_0">
              <span class="num">
                <i class="far fa-folder-open"></i>
              </span> Job Details </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#step_1">
              <span class="num">
                <i class="fas fa-plug"></i>
              </span> Electrical Specification </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#step_2">
              <span class="num">
                <i class="fas fa-industry"></i>
              </span> Mechanical Specification </a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="#step_3">
              <span class="num">
                <i class="fas fa-info"></i>
              </span> Other Information </a>
            </li>
        </ul>
        <div class="tab-content card">
            <div id="step_0" class="tab-pane" role="tabpanel" aria-labelledby="step_0">
                <form role="form" class="needs-validation" id="form_0">
                <input type="hidden" name="contract_type" value="' . $contract_type . '">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="company_add">Company *</label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-border form-control-sm companyData select2 select2_default"
                                style="width: 100%;" id="company_add" name="company_id" data-action="company_add"
                                onchange="get_company_info(this.id)" required>';
                        $company_id = $contract_handler->getAllCompanyId();
                        echo '</select>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="contract_no">Contract No *</label>
                    <div class="col-sm-9">
                        <input type="number" id="contract_no" name="contract_no" value="1"
                               class="form-control form-control-border form-control-sm" required>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </div>
                    <span class="col-sm-6 col-xs-12 offset-sm-3" id="contract_no_res"></span>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="quote_no">Quote No *</label>
                            <div class="col-sm-9">
                                <input type="text" id="quote_no" name="quote_no" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="quote_date">Quote Date *</label>
                            <div class="col-sm-9">
                                <input type="date" id="quote_date" name="quote_date" value="2020-02-02"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="order_no">Order No *</label>
                            <div class="col-sm-9">
                                <input type="text" id="order_no" name="order_no" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="order_date">Order Date *</label>
                            <div class="col-sm-9">
                                <input type="date" id="order_date" name="order_date" value="2020-02-02"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="quantity">Quantity *</label>
                            <div class="col-sm-9">
                                <input type="number" id="quantity" name="quantity" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="required_date">Date Required *</label>
                            <div class="col-sm-9">
                                <input type="date" id="required_date" name="required_date" value="2020-02-02"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="job_no">Job No *</label>
                            <div class="col-sm-9">
                                <input type="number" id="job_no" name="job_no" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="sales_order_no">Sales Order No *</label>
                            <div class="col-sm-9">
                                <input type="number" id="sales_order_no" name="sales_order_no" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                </div>';
            echo '
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="paymentTM">Payment Terms/Method *</label>
                            <div class="col-sm-9">
                                <input type="text" id="paymentTM" name="paymentTM" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="commissioning">Commissioning *</label>
                            <div class="col-sm-9">
                                <input type="text" id="commissioning" name="commissioning" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="service_notified">Service Notified *</label>
                            <div class="col-sm-9">
                                <input type="text" id="service_notified" name="service_notified" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" for="penalty_clause">Penalty Clause *</label>
                            <div class="col-sm-9">
                                <input type="text" id="penalty_clause" name="penalty_clause" value="1"
                                       class="form-control form-control-border form-control-sm" required>
                                <div class="invalid-feedback">
                        This field is required
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" for="salesperson_id">Salesperson *</label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-border form-control-sm select2 select2_default"
                                style="width: 100%;" id="salesperson_id" name="salesperson_id" required>
                                <option value="">--SELECT AN OPTION--</option>
                            <option value="Rental/Sales|N/A">Crestchic Rental/Sales</option>
                            ';
                                $salesperson_ids = $contract_handler->getAllUsersWithSpecificRole(8);
                                echo '
                        </select>
                        <div class="invalid-feedback">This field is required</div>
                    </div>
                </div>
                <div id="info"></div>
                </form>
            </div>';
            echo '
            <div id="step_1" class="tab-pane" role="tabpanel" aria-labelledby="step_1">
            <form role="form" class="needs-validation" id="form_1">
                <div class="row m-b-30">
                    <div class="col-md-3">
                        <h2 class="StepTitle">Current Flow</h2>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="current_flow" value="AC" class="md-radio" checked>
                                <span class="circle"></span>
                                <span class="check"></span> AC </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="current_flow" value="DC Constant Current" class="md-radio" id="DCCI">
                                <span class="circle"></span>
                                <span class="check"></span> DC Constant Current </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="current_flow" value="DC Constant Voltage" class="md-radio" id="DCCV">
                                <span class="circle"></span>
                                <span class="check"></span> DC Constant Voltage </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="StepTitle">Load Type</h2>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="load_type" value="Resistive" class="md-radio" id="resistive"
                                       checked>
                                <span class="circle"></span>
                                <span class="check"></span> Resistive </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="load_type" value="Resistive/Reactive" class="md-radio"
                                       id="ResistiveReactive">
                                <span class="circle"></span>
                                <span class="check"></span> Resistive/Reactive </label>
                        </div>
                        <!-- <div class="sgh--radio radio radio-default sgh--block"><label><input type="radio" name="load_type" value="Resistive/Capacitive" class="md-radio" disabled><span class="circle"></span><span class="check"></span> Resistive/Capacitive </label></div>-->
                    </div>
                    <div class="col-md-3">
                        <h2 class="StepTitle">Configuration</h2>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="config" value="Single Phase" class="md-radio" checked>
                                <span class="circle"></span>
                                <span class="check"></span> Single Phase </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="config" value="Star" class="md-radio" checked>
                                <span class="circle"></span>
                                <span class="check"></span> Star </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="config" value="Delta" class="md-radio">
                                <span class="circle"></span>
                                <span class="check"></span> Delta </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="config" value="Star/Delta" class="md-radio" id="StarDelta">
                                <span class="circle"></span>
                                <span class="check"></span> Star/Delta </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h2 class="StepTitle">Usage</h2>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="usage_frequency" value="Periodically" class="md-radio" checked>
                                <span class="circle"></span>
                                <span class="check"></span> Periodically </label>
                        </div>
                        <div class="sgh--radio radio radio-default sgh--block">
                            <label>
                                <input type="radio" name="usage_frequency" value="Continuous" class="md-radio">
                                <span class="circle"></span>
                                <span class="check"></span> Continuous </label>
                        </div>
                    </div>
                </div>';
            echo '
                <div class="ln_solid"></div>
                <div class="well sgh--borderless" style="background-color: #fff;" id="ac_res">
                    <div class="form-group row mt-3">
                        <label for="mainKW" class="col-sm-3 col-form-label text-right">Power rating <span
                                class="required">*</span>
                        </label>
                        <div class="col-sm-6 col-xs-12">
                            <div class="input-group">
                                <input type="number" class="form-control form-control-border form-control-sm"
                                       name="mainKW" required id="mainKW">
                                <div class="input-group-append">
                                    <span class="input-group-text">kW</span>
                                </div>
                                <div class="invalid-feedback">
                                    This field is required
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="StepTitle">Test Supply</h4>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS</label>
                                <select class="form-control form-control-sm withOther" name="supplyV">
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyV"
                                       placeholder="Please state..." onkeypress="return isNumberSlash();">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Hz</label>
                                <select class="form-control form-control-sm withOther" name="supplyHz">
                                    <option value="N/A">N/A</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="50/60">50/60</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyHz"
                                       placeholder="Please state...">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group supplyPH">
                                <label>PH</label>
                                <select class="form-control form-control-sm supplyPH" name="supplyPH">
                                    <option value="N/A">N/A</option>
                                    <option value="1">1</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group supplyW checkbox_required" id="supplyW_group">
                                <label>WIRE</label>
                                <div class="row"></div>
                                <div class="checkbox checkbox-default sgh--checkbox">
                                    <label>
                                        <input type="checkbox" name="supplyW" value="2" class="md-checkbox" required>
                                        <span class="checkbox-material">
                                            <span class="check"></span>
                                        </span> 2 
                                    </label>
                                </div>
                                <div class="checkbox checkbox-default sgh--checkbox">
                                    <label>
                                        <input type="checkbox" name="supplyW" value="3" class="md-checkbox" required>
                                        <span class="checkbox-material">
                                            <span class="check"></span>
                                        </span> 3 
                                    </label>
                                </div>
                                <div class="checkbox checkbox-default sgh--checkbox">
                                    <label>
                                        <input type="checkbox" name="supplyW" value="4" class="md-checkbox" required>
                                        <span class="checkbox-material">
                                            <span class="check"></span>
                                        </span> 4 
                                    </label>
                                </div>
                            </div>
                            <div class="invalid-feedback">This field is required</div>
                        </div>
                    </div>
                </div>
                <div class="well sgh--borderless" style="background-color: #fff;" id="ac_res_sd">
                    <div class="row">
                        <h4 class="StepTitle">Power rating</h4>
                        <div class="sgh-form-item col-sm-6 col-xs-12">
                  <span data-component="Input" class="sgh-input-wrapper">
                    <input name="mainKW" type="number" class="sgh-input" required>
                    <label class="sgh-form-item-label sgh-form-item-label-top">Star kW: *</label>
                      <div class="invalid-feedback">
                        This field is required
                    </div>
                  </span>
                        </div>
                        <div class="sgh-form-item col-sm-6 col-xs-12">
                  <span data-component="Input" class="sgh-input-wrapper">
                    <input name="mainKWSD" type="number" class="sgh-input" required>
                    <label class="sgh-form-item-label sgh-form-item-label-top">Delta kW: *</label>
                      <div class="invalid-feedback">
                        This field is required
                    </div>
                  </span>
                        </div>
                    </div>
                    <h4 class="StepTitle">Test Supply</h4>
                    <div class="row">
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS <small>Star</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyV">
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyV"
                                       placeholder="Please state..." onkeypress="return isNumberSlash();">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Hz <small>Star</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyHz">
                                    <option value="N/A">N/A</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="50/60">50/60</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyHz"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS <small>Delta</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyVSD">
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyVSD"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Hz <small>Delta</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyHzSD">
                                    <option value="N/A">N/A</option>
                                    <option value="50">50</option>
                                    <option value="60">60</option>
                                    <option value="50/60">50/60</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyHzSD"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>PH</label>
                                <select class="form-control form-control-sm" name="supplyPH">
                                    <option value="N/A">N/A</option>
                                    <option value="1">1</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>WIRE</label>
                                <select class="form-control form-control-sm" name="supplyW">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="3/4">3/4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ac_res_rac">
                    <div class="well sgh--borderless" style="background-color: #fff;">
                        <div class="row" id="supplyConditions">
                            <h4 class="StepTitle">Power rating</h4>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainKVA" type="number" placeholder="7000" class="sgh-input mainKWCal" id="mainKVA"
                             required>
                      <label for="mainKVA" class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </span>
                  </span>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input id="mainPF" name="mainPF" step="0.01" max="1" type="number" placeholder="0.6"
                             class="sgh-input mainKWCal" required>
                      <label for="mainPF" class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </span>
                  </span>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainKW" type="number" class="sgh-input" id="mainKW">
                      <label for="mainKW" class="sgh-form-item-label sgh-form-item-label-top">kW: </label>
                    </span>
                  </span>
                        </div>
                    </div>
                    <div class="well sgh--borderless" style="background-color: #fff;">
                        <h4 class="StepTitle">Test Supply</h4>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>VOLTS</label>
                                    <select class="form-control form-control-sm withOther" name="supplyV">
                                        <option value="230">230</option>
                                        <option value="240">240</option>
                                        <option value="380">380</option>
                                        <option value="400">400</option>
                                        <option value="415">415</option>
                                        <option value="480">480</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input class="form-control otherField" disabled type="text" name="supplyVOther"
                                           placeholder="Please state..." onkeypress="return isNumberSlash();">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Hz</label>
                                    <select class="form-control form-control-sm withOther" name="supplyHz">
                                        <option value="N/A">N/A</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="50/60">50/60</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input class="form-control otherField" disabled type="text" name="supplyHzOther"
                                           placeholder="Please state...">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>PH</label>
                                    <select class="form-control form-control-sm supplyPH" name="supplyPH">
                                        <option value="N/A">N/A</option>
                                        <option value="1">1</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>WIRE</label>
                                    <select class="form-control form-control-sm" name="supplyW">
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="3/4">3/4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ac_res_rac_sd">
                    <div class="well sgh--borderless" style="background-color: #fff;">
                        <div class="row" id="supplyConditions">
                            <h4>Power rating <small>Star power rating</small>
                            </h4>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainKVA" type="number" placeholder="7000" class="sgh-input mainKWCal" id="mainKVA"
                             required>
                      <label class="sgh-form-item-label sgh-form-item-label-top">kVA: *</label>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </span>
                  </span>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input id="mainPF" name="mainPF" step="0.01" max="1" type="number" placeholder="0.6"
                             class="sgh-input mainKWCal" required>
                      <label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: *</label>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </span>
                  </span>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainKW" type="number" class="sgh-input" id="mainKW">
                      <label class="sgh-form-item-label sgh-form-item-label-top">kW: </label>
                    </span>
                  </span>
                        </div>
                        <div class="row" id="supplyConditionsSD">
                            <h4>Power rating <small>Delta power rating if required</small>
                            </h4>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainKVA">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainKVASD" type="number" class="sgh-input mainKWSDCal">
                      <label class="sgh-form-item-label sgh-form-item-label-top">kVA: </label>
                    </span>
                  </span>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-xs-12 mainPF">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainPFSD" type="number" step="0.01" max="1" placeholder=""
                             class="sgh-input mainKWSDCal">
                      <label class="sgh-form-item-label sgh-form-item-label-top">Power Factor: </label>
                    </span>
                  </span>
                            <span class="sgh-form-item col-md-4 col-sm-6 col-sm-push-3 col-xs-12 col-md-push-0 mainKW">
                    <span data-component="Input" class="sgh-input-wrapper">
                      <input name="mainKWSD" type="number" placeholder="" class="sgh-input" required="">
                      <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
                        <div class="invalid-feedback">
                        This field is required
                    </div>
                    </span>
                  </span>
                        </div>
                    </div>
                    <div class="well sgh--borderless" style="background-color: #fff;">
                        <h4 class="StepTitle">Test Supply</h4>
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>VOLTS <small>Star</small>
                                    </label>
                                    <select class="form-control form-control-sm withOther" name="supplyV">
                                        <option value="230">230</option>
                                        <option value="240">240</option>
                                        <option value="380">380</option>
                                        <option value="400">400</option>
                                        <option value="415">415</option>
                                        <option value="480">480</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input class="form-control otherField" disabled type="text" name="supplyVOther"
                                           placeholder="Please state..." onkeypress="return isNumberSlash();">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Hz <small>Star</small>
                                    </label>
                                    <select class="form-control form-control-sm withOther" name="supplyHz">
                                        <option value="N/A">N/A</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="50/60">50/60</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input class="form-control otherField" disabled type="text" name="supplyHzOther"
                                           placeholder="Please state...">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>VOLTS <small class="labelStar">Delta</small>
                                    </label>
                                    <select class="form-control form-control-sm withOther" name="supplyVSD">
                                        <option value="230">230</option>
                                        <option value="240">240</option>
                                        <option value="380">380</option>
                                        <option value="400">400</option>
                                        <option value="415">415</option>
                                        <option value="480">480</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input class="form-control otherField" disabled type="text" name="supplyVSDOther"
                                           placeholder="Please state...">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>Hz <small>Delta</small>
                                    </label>
                                    <select class="form-control form-control-sm withOther" name="supplyHzSD">
                                        <option value="N/A">N/A</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="50/60">50/60</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input class="form-control otherField" disabled type="text" name="supplyHzSDOther"
                                           placeholder="Please state...">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>PH</label>
                                    <select class="form-control form-control-sm supplyPH" name="supplyPH">
                                        <option value="N/A">N/A</option>
                                        <option value="1">1</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label>WIRE</label>
                                    <select class="form-control form-control-sm" name="supplyW">
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="3/4">3/4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well sgh--borderless" style="background-color: #fff;" id="dc_cc_res">
                    <div class="row">
                        <h4 class="StepTitle">Power rating</h4>
                        <div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3">
                  <span data-component="Input" class="sgh-input-wrapper">
                    <input name="mainKW" type="number" class="sgh-input" required>
                    <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
                      <div class="invalid-feedback">
                        This field is required
                    </div>
                  </span>
                        </div>
                    </div>
                    <h4 class="StepTitle">Test Supply</h4>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS <small>Min</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyV">
                                    <option value="N/A">N/A</option>
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyV"
                                       placeholder="Please state..." onkeypress="return isNumberSlash();">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS <small>Max</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyVSD">
                                    <option value="N/A">N/A</option>
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyVSD"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <input type="hidden" name="supplyHzSD" value="N/A">
                        <input type="hidden" name="supplyPH" value="N/A">
                    </div>
                </div>
                <div class="well sgh--borderless" style="background-color: #fff;" id="dc_cc_res_sd">
                    <div class="row">
                        <h4 class="StepTitle">Power rating</h4>
                        <div class="sgh-form-item col-sm-6 col-xs-12 col-md-push-3">
                  <span data-component="Input" class="sgh-input-wrapper">
                    <input name="mainKW" type="number" class="sgh-input" required>
                    <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
                      <div class="invalid-feedback">
                        This field is required
                    </div>
                  </span>
                        </div>
                    </div>
                    <h4 class="StepTitle">Test Supply</h4>
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV">
                            <div class="form-group">
                                <label>VOLTS <small>Star Min</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyV">
                                    <option value="N/A">N/A</option>
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyV"
                                       placeholder="Please state..." onkeypress="return isNumberSlash();">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12" id="dcSupplyV2">
                            <div class="form-group">
                                <label>VOLTS <small>Star Max</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyVSD">
                                    <option value="N/A">N/A</option>
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyVSD"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS <small>Delta Min</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyVD1">
                                    <option value="N/A">N/A</option>
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="number" name="supplyVD1"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>VOLTS <small>Delta Max</small>
                                </label>
                                <select class="form-control form-control-sm withOther" name="supplyVD2">
                                    <option value="N/A">N/A</option>
                                    <option value="230">230</option>
                                    <option value="240">240</option>
                                    <option value="380">380</option>
                                    <option value="400">400</option>
                                    <option value="415">415</option>
                                    <option value="480">480</option>
                                    <option value="Other">Other</option>
                                </select>
                                <input class="form-control otherField" disabled type="text" name="supplyVD2"
                                       placeholder="Please state...">
                            </div>
                        </div>
                        <input type="hidden" name="supplyHzSD" value="N/A">
                        <input type="hidden" name="supplyPH" value="N/A">
                    </div>
                </div>
                <div class="well sgh--borderless" style="background-color: #fff;" id="dc_cv_res">
                    <div class="row">
                        <h4 class="StepTitle">Power rating</h4>
                        <div class="sgh-form-item col-sm-6 col-xs-12">
                  <span data-component="Input" class="sgh-input-wrapper">
                    <input name="mainKW" type="number" class="sgh-input" required>
                    <label class="sgh-form-item-label sgh-form-item-label-top">kW: *</label>
                      <div class="invalid-feedback">
                        This field is required
                    </div>
                  </span>
                        </div>
                        <div class="sgh-form-item col-sm-6 col-xs-12">
                  <span data-component="Input" class="sgh-input-wrapper">
                    <input name="mainAMPS" type="number" class="sgh-input" id="mainAMPS" required>
                    <label for="mainAMPS" class="sgh-form-item-label sgh-form-item-label-top">AMPS: *</label>
                      <div class="invalid-feedback">
                        This field is required
                    </div>
                  </span>
                        </div>
                    </div>
                    <input type="hidden" name="supplyV" value="N/A">
                    <input type="hidden" name="supplyVSD" value="N/A">
                    <input type="hidden" name="supplyHz" value="N/A">
                    <input type="hidden" name="supplyHzSD" value="N/A">
                    <input type="hidden" name="supplyPH" value="N/A">
                </div>
                <div class="ln_solid"></div>
                <h2 class="StepTitle">Auxiliary Supply</h2>
                <div class="form-group" style="padding-left: 15px;">
                    <label>Auxiliary Type</label>
                    <div class="row"></div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="auxInfo" value="Internal" class="md-checkbox">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Internal </label>
                    </div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="auxInfo" value="External" class="md-checkbox">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> External </label>
                    </div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="auxInfo" value="Switched" class="md-checkbox">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Switched </label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>VOLTS</label>
                        <select class="form-control form-control-sm withOther" name="auxSV">
                            <option value="230">230</option>
                            <option value="240">240</option>
                            <option value="380">380</option>
                            <option value="400">400</option>
                            <option value="415">415</option>
                            <option value="480">480</option>
                            <option value="Other">Other</option>
                        </select>
                        <input class="form-control otherField" disabled type="text" name="auxSVOther"
                               placeholder="Please state..." onkeypress="return isNumberSlash();">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Hz</label>
                        <select class="form-control form-control-sm" name="auxSHz">
                            <option value="50">50</option>
                            <option value="60">60</option>
                            <option value="50/60">50/60</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>PH</label>
                        <select class="form-control form-control-sm" name="auxSPH">
                            <option value="1">1</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group auxSW checkbox_required" id="auxSW_group">
                            <label>WIRE</label>
                            <div class="row"></div>
                            <div class="checkbox checkbox-default sgh--checkbox">
                                <label>
                                    <input type="checkbox" name="auxSW" value="2" class="md-checkbox" required>
                                    <span class="checkbox-material">
                                        <span class="check"></span>
                                    </span> 2 
                                </label>
                            </div>
                            <div class="checkbox checkbox-default sgh--checkbox">
                                <label>
                                    <input type="checkbox" name="auxSW" value="3" class="md-checkbox" required>
                                    <span class="checkbox-material">
                                        <span class="check"></span>
                                    </span> 3 
                                </label>
                            </div>
                            <div class="checkbox checkbox-default sgh--checkbox">
                                <label>
                                    <input type="checkbox" name="auxSW" value="4" class="md-checkbox" required>
                                    <span class="checkbox-material">
                                        <span class="check"></span>
                                    </span> 4 
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <h2 class="StepTitle">Ambient Temperature Operation Range <b>&#8451;</b>
                </h2>
                <input type="text" id="range_temperature" name="range"/>
                <input type="hidden" id="range_tempC" name="range_temp_C"/>
                <h2 class="StepTitle">Control System</h2>
                <div class="form-group checkbox_required" id="controller_group" style="padding-left: 15px;">
                    <label>Controller</label>
                    <div class="row"></div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="controller" value="Baseload" class="md-checkbox" required>
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Baseload </label>
                    </div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="controller" value="KCS" class="md-checkbox" required>
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> KCS </label>
                    </div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="controller" value="MCS" class="md-checkbox open_xtra"
                                   data-action="nova" required>
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> MCS </label>
                    </div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="controller" value="Toggle Switches" class="md-checkbox" required>
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Toggle Switches </label>
                    </div>
                    <div class="checkbox checkbox-default sgh--checkbox">
                        <label>
                            <input type="checkbox" name="controller" value="Tracker" class="md-checkbox" required>
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Tracker </label>
                    </div>
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="controller" value="WTT" class="md-checkbox" required>
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> WTT </label>
                    </div>
                </div>
                <div class="row content_option_nova sgh--d-none">
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="controller_sub" value="Nova" class="md-checkbox open_xtra"
                                   data-action="nova_xtra">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Nova </label>
                    </div>
                </div>
                <div class="row content_option_nova_xtra sgh--d-none">
                    <p>Controller Packages</p>
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="controller_packages" value="Nova Platform PC software"
                                   class="md-checkbox open_xtra1" data-action="nova_xtra1">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Nova Platform PC software </label>
                    </div>
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="controller_packages" value="Nova Platform LC80 Controller"
                                   class="md-checkbox open_xtra1" data-action="nova_xtra1">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Nova Platform LC80 Controller </label>
                    </div>
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="controller_packages" value="Solar Platform Controller"
                                   class="md-checkbox open_xtra1" data-action="nova_xtra1">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Solar Platform Controller </label>
                    </div>
                    <p>Interconnecting Packages</p>
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="interconnecting_packages" value="Interconnection Package 1"
                                   class="md-checkbox open_xtra1" data-action="nova_xtra1">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Interconnection Package 1 </label>
                    </div>
                    <div class="sgh--checkbox checkbox-default">
                        <label>
                            <input type="checkbox" name="interconnecting_packages" value="Interconnection Package 2"
                                   class="md-checkbox open_xtra1" data-action="nova_xtra1">
                            <span class="checkbox-material">
                    <span class="check"></span>
                  </span> Interconnection Package 2 </label>
                    </div>
                </div>
                <div class="form-group row" id="leadSection">
                    <div class="col-md-3">
                        <label>Control Leads</label>
                        <select class="form-control form-control-sm withOther" id="lead">
                            <option value="Comms Lead">Comms Lead</option>
                            <option value="Ext Reel">Ext Reel</option>
                            <option value="HHT Lead">HHT Lead</option>
                            <option value="KCS100HM Lead">KCS100HM Lead</option>
                            <option value="LC60 Lead">LC60 Lead</option>
                            <option value="LC80 Lead">LC80 Lead</option>
                            <option value="PC Lead">PC Lead</option>
                            <option value="System Extend Lead">System Extend Lead</option>
                            <option value="System extend Standard">System extend Standard</option>
                            <option value="System extend Advanced">System extend Advanced</option>
                            <option value="Other">Other</option>
                        </select>
                        <input class="form-control leadInput otherField" id="leadOther" type="text"
                               placeholder="Please State..">
                    </div>
                    <div class="col-md-3">
                        <label>Length</label>
                        <select class="form-control form-control-sm withOther" id="leadLength">
                            <option value="5m">5m</option>
                            <option value="10m">10m</option>
                            <option value="20m">20m</option>
                            <option value="50m">50m</option>
                            <option value="100m">100m</option>
                            <option value="Other">Other</option>
                        </select>
                        <input class="form-control leadInput otherField" id="leadLengthOther" type="text"
                               placeholder="Please State..">
                    </div>
                    <div class="col-md-3">
                        <label>Quantity</label>
                        <input class="form-control form-control-sm leadInput" id="leadNo" type="number">
                    </div>
                    <div class="col-md-3" style="margin-top: 25px;">
                        <button class="btn-sm btn btn-success" id="addControlLead" type="button"
                                onclick="add_control_lead();">Add
                        </button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Controller Leads Selected</label>
                    <input id="tags_1" type="text" class="tags form-control"/>
                    <div id="suggestions-container"
                         style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                    <input class="form-control sgh--tags-box" type="hidden" name="leads" id="conLeads">
                </div>
                <div class="form-group">
                    <label>Controller Information</label>
                    <textarea class="form-control" id="control_info" name="control_info" rows="3"
                              style="margin: 0 78px 0 0; width: 100%; height: 84px;"
                              title="Controller Information"></textarea>
                </div>
                </form>
            </div>';
            echo '
            <div id="step_2" class="tab-pane" role="tabpanel" aria-labelledby="step_2">
            <form role="form" class="needs-validation" id="form_2">
                <h2 class="StepTitle">Enclosure</h2>
                <div id="mechSel">
                    <div class="form-group row">
                        <label for="enc" class="col-sm-3 col-form-label text-right"> Enclosure </label>
                        <div class="col-sm-6 col-xs-12">
                            <select class="form-control form-control-sm" name="enc" id="enc" title="Style">
                                <option>--SELECT AN OPTION--</option>
                                
                                <optgroup label="Canopy">
                                    <option value="Horizontal" data-encType="Canopy">Small Enclosure</option>
                                    
                                    <option value="Vertical" data-encType="Canopy">Vertical</option>
                                    
                                </optgroup>
                                
                                <optgroup label="Container">
                                    <option value="Container" data-encType="Container">Container</option>
                                    
                                    <option value="Small Container" data-encType="Container">Small Container (1, 2 or 3
                                        Fan)
                                    </option>
                                    
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <span id="encStyle"></span>
                    <span id="encSize"></span>
                    <div class="form-group row sgh--d-none">
                        <label for="encStyle" class="col-sm-3 col-form-label text-right">Style</label>
                        <div class="col-sm-6 col-xs-12 encStyle">
                            <select class="form-control form-control-sm" name="encStyle" id="">
                                <option>--SELECT AN OPTION--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row sgh--d-none encSize">
                        <label for="encSize" class="col-sm-3 col-form-label text-right"> Size </label>
                        <div class="col-sm-6 col-xs-12">
                            <select class="form-control form-control-sm size" name="encSize" id="encSize">
                                <option>--SELECT AN OPTION--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row sgh--d-none" id="encLiftingCol">
                        <label for="encLifting" class="col-sm-3 col-form-label text-right"> Lifting </label>
                        <div class="col-sm-6 col-xs-12">
                            <select class="form-control form-control-sm" name="encLifting" id="encLifting">
                                <option value="Standard">Standard</option>
                                
                                <option value="DMV">DMV</option>
                                
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row sgh--d-none encHeight" id="encHeightCol">
                        <label for="encHeight" class="col-sm-3 col-form-label text-right"> Height </label>
                        <div class="col-sm-6 col-xs-12">
                            <input type="text" placeholder="Enter container\'s height" name="encHeight" id="encHeight"
                                   class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="form-group row sgh--d-none encBase" id="encBaseCol">
                        <label for="encBase" class="col-sm-3 col-form-label text-right"> Base </label>
                        <div class="col-sm-6 col-xs-12"><select class="form-control form-control-sm withOther"
                                                                         name="encBase" id="encBase">
                            <option>--SELECT AN OPTION--</option>
                            </select><input class="form-control otherField" disabled type="text"
                                                              name="encBaseOther" placeholder="Please state...">
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="row">
                    <div class="form-group col-12"><label>Information</label><p>If colour does not
                        exist choose "Other" & enter details in Other Information</p>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="form-group col-md-3"><label>Finish Type</label><select
                            class="form-control form-control-sm withOther" id="enc_finishType" name="enc_finishType"
                            title="Finish Type">
                        <option value="BS 4800">British Standard 4800</option>
                        
                        <option value="RAL">RAL</option>
                        
                        <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3"><label>Colours</label><select
                            class="form-control form-control-sm withOther" name="enc_finish" title="Finish" id="enc_finish">
                        <option>--SELECT AN OPTION--</option>';
            bs_4800_colorsel();
            ralcolorsel();
            echo '<option value="Other - Other">Other</option>
                        </select><input class="form-control otherField" disabled type="text" name="enc_finishOther"
                                                          placeholder="Please state...">
                    </div>
                </div>
                </form>
            </div>
            <div id="step_3" class="tab-pane" role="tabpanel" aria-labelledby="step_3">
            <form role="form" class="needs-validation" id="form_3">
                <h2 class="StepTitle">Step 4 Content</h2>
                <div class="form-group"><label>Other Information</label><textarea name="otherInfo"
                                                                                                    class="form-control"
                                                                                                    rows="3"
                                                                                                    style="margin: 0 78px 0 0; width: 100%; height: 84px;"
                                                                                                    title="Other Information"></textarea>
                </div>
                <div id="feedback"></div>
            </div>
        </div>
    </div>
</form>
';
        } else if ($contract_type === "Combi") {
            echo ' <form role="form" class="form-horizontal form-label-left" action="" method="POST" id="setJob"> 
 <div id="smartLoader"></div> <div id="smart_contract_form" class="smart_contract_form"> 
 <ul class="nav"> <li class="nav-item"> <a class="nav-link" href="#step_0"> <span class="num"><i class="far fa-folder-open"></i></span> Job Details </a> </li> <li class="nav-item"> <a class="nav-link" href="#step_1"> <span class="num"><i class="fas fa-plug"></i></span> Electrical Specification </a> </li> <li class="nav-item"> <a class="nav-link " href="#step_2"> <span class="num"><i class="fas fa-random"> </i></span> Transformer Specification </a> </li> <li class="nav-item"> <a class="nav-link " href="#step_3"> <span class="num"><i class="fas fa-industry"></i></span> Mechanical Specification </a> </li> <li class="nav-item"> <a class="nav-link " href="#step_4"> <span class="num"><i class="fas fa-info"></i></span> Other Information </a> </li> </ul> <div class="tab-content card">
            <div id="step_0" class="tab-pane" role="tabpanel" aria-labelledby="step_0"> 
            <input type="hidden" name="contract_type" value="' . $contract_type . '">
            <div class="form-group row"> <label class="col-sm-3 col-form-label" for="company_add">Company *</label> <div class="col-sm-9"> <select class="form-control form-control-border form-control-sm companyData select2 select2_default" style="width: 100%;" id="company_add" name="company_id" data-action="company_add" onchange="get_company_info(this.id)"> <?php $company_id = $contract_handler->getAllCompanyId(); ?>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label" for="contract_no">Contract No *</label>
		<div class="col-sm-9">
			<input type="number" id="contract_no" name="contract_no" value="1" class="form-control form-control-border form-control-sm" required>
		</div><span class="col-sm-6 col-xs-12 offset-sm-3" id="contract_no_res"></span></div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="quote_no">Quote No *</label>
				<div class="col-sm-9">
					<input id="quote_no" name="quote_no" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="quote_date">Quote Date *</label>
				<div class="col-sm-9">
					<input type="date" id="quote_date" name="quote_date" value="2020-02-02" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="quantity">Quantity *</label>
				<div class="col-sm-9">
					<input type="number" id="quantity" name="quantity" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="required_date">Date Required *</label>
				<div class="col-sm-9">
					<input type="date" id="required_date" name="required_date" value="2020-02-02" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="job_no">Job No *</label>
				<div class="col-sm-9">
					<input type="number" id="job_no" name="job_no" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="sales_order_no">Sales Order No *</label>
				<div class="col-sm-9">
					<input type="number" id="sales_order_no" name="sales_order_no" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="paymentTM">Payment Terms/Method *</label>
				<div class="col-sm-9">
					<input id="paymentTM" name="paymentTM" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="commissioning">Commissioning *</label>
				<div class="col-sm-9">
					<input id="commissioning" name="commissioning" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="service_notified">Service Notified *</label>
				<div class="col-sm-9">
					<input id="service_notified" name="service_notified" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label" for="penalty_clause">Penalty Clause *</label>
				<div class="col-sm-9">
					<input id="penalty_clause" name="penalty_clause" value="1" class="form-control form-control-border form-control-sm" required>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label" for="salesperson_id">Salesperson *</label>
		<div class="col-sm-9">
			<select class="form-control form-control-border form-control-sm select2 select2_default" style="width:100%" id="salesperson_id" name="salesperson_id">
				<option value="Rental/Sales|N/A">Crestchic Rental/Sales</option>
				<?php $salesperson_ids = $contract_handler->getAllUsersWithSpecificRole(8); ?>
			</select>
		</div>
	</div>
	<div id="info"></div>
	<div id="step_1" class="tab-pane" role="tabpanel" aria-labelledby="step_1">Step content</div>
	<div id="step_2" class="tab-pane" role="tabpanel" aria-labelledby="step_2">Step content</div>
	<div id="step_3" class="tab-pane" role="tabpanel" aria-labelledby="step_3">
		<h2 class="StepTitle">Enclosure</h2>
		<div id="mechSel">
			<div class="form-group row">
				<label for="enc" class="col-sm-3 col-form-label text-right">Enclosure</label>
				<div class="col-sm-6 col-xs-12">
					<select class="form-control form-control-sm" name="enc" id="enc" title="Style">
						<option>--SELECT AN OPTION--</option>
						<optgroup label="Canopy">
							<option value="Horizontal" data-enctype="Canopy">Small Enclosure</option>
							<option value="Vertical" data-enctype="Canopy">Vertical</option>
						</optgroup>
						<optgroup label="Container">
							<option value="Container" data-enctype="Container">Container</option>
							<option value="Small Container" data-enctype="Container">Small Container (1, 2 or 3 Fan)</option>
						</optgroup>
					</select>
				</div>
			</div><span id="encStyle"></span> <span id="encSize"></span>
			<div class="form-group row sgh--d-none">
				<label for="encStyle" class="col-sm-3 col-form-label text-right">Style</label>
				<div class="col-sm-6 col-xs-12 encStyle">
					<select class="form-control form-control-sm" name="encStyle">
						<option>--SELECT AN OPTION--</option>
					</select>
				</div>
			</div>
			<div class="form-group row sgh--d-none encSize">
				<label for="encSize" class="col-sm-3 col-form-label text-right">Size</label>
				<div class="col-sm-6 col-xs-12">
					<select class="form-control form-control-sm size" name="encSize" id="encSize">
						<option>--SELECT AN OPTION--</option>
					</select>
				</div>
			</div>
			<div class="form-group row sgh--d-none" id="encLiftingCol">
				<label for="encLifting" class="col-sm-3 col-form-label text-right">Lifting</label>
				<div class="col-sm-6 col-xs-12">
					<select class="form-control form-control-sm" name="encLifting" id="encLifting">
						<option value="Standard">Standard</option>
						<option value="DMV">DMV</option>
						<option value="N/A">N/A</option>
					</select>
				</div>
			</div>
			<div class="form-group row sgh--d-none encHeight" id="encHeightCol">
				<label for="encHeight" class="col-sm-3 col-form-label text-right">Height</label>
				<div class="col-sm-6 col-xs-12">
					<input placeholder="Enter container\'s height" name="encHeight" id="encHeight" class="form-control form-control-sm">
				</div>
			</div>
			<div class="form-group row sgh--d-none encBase" id="encBaseCol">
				<label for="encBase" class="col-sm-3 col-form-label text-right">Base</label>
				<div class="col-sm-6 col-xs-12">
					<select class="form-control form-control-sm withOther" name="encBase" id="encBase">
						<option>--SELECT AN OPTION--</option>
					</select>
					<input class="form-control otherField" disabled name="encBaseOther" placeholder="Please state...">
				</div>
			</div>
		</div>
		<div class="ln_solid"></div>
		<div class="row">
			<div class="form-group col-12">
				<label>Information</label>
				<p>If colour does not exist choose "Other" & enter details in Other Information</p>
			</div>
			<div class="col-md-3"></div>
			<div class="form-group col-md-3">
				<label>Finish Type</label>
				<select class="form-control form-control-sm withOther" id="enc_finishType" name="enc_finishType" title="Finish Type">
					<option value="BS 4800">British Standard 4800</option>
					<option value="RAL">RAL</option>
					<option value="Other">Other</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label>Colours</label>
				<select class="form-control form-control-sm withOther" name="enc_finish" title="Finish" id="enc_finish">
					<option>--SELECT AN OPTION--</option>
					<?php bs_4800_colorsel(); ralcolorsel(); ?>
						<option value="Other - Other">Other</option>
				</select>
			</div>
		</div>
	</div>
	<div id="step_4" class="tab-pane" role="tabpanel" aria-labelledby="step_4">
		<h2 class="StepTitle">Step 4 Content</h2>
		<div class="form-group">
			<label>Other Information</label>
			<textarea name="otherInfo" class="form-control" rows="3" style="margin:0 78px 0 0;width:100%;height:84px" title="Other Information"></textarea>
		</div>
		<div id="feedback"></div>
	</div>';
        } else if ($contract_type === "Transformer") {
            echo '
	<form role="form" class="form-horizontal form-label-left" action="" method="POST" id="setJob">
		<div id="smartLoader"></div>
		<div id="smart_contract_form" class="smart_contract_form">
			<ul class="nav">
				<li class="nav-item"><a class="nav-link" href="#step_0"><span class="num"><i class="far fa-folder-open"></i></span> Job Details</a></li>
				<li class="nav-item"><a class="nav-link" href="#step_1"><span class="num"><i class="fas fa-plug"></i></span> Electrical Specification</a></li>
				<li class="nav-item"><a class="nav-link" href="#step_2"><span class="num"><i class="fas fa-random"></i></span> Transformer Specification</a></li>
				<li class="nav-item"><a class="nav-link" href="#step_3"><span class="num"><i class="fas fa-industry"></i></span> Mechanical Specification</a></li>
				<li class="nav-item"><a class="nav-link" href="#step_4"><span class="num"><i class="fas fa-info"></i></span> Other Information</a></li>
			</ul>
			<div class="tab-content card">
				<div id="step_0" class="tab-pane" role="tabpanel" aria-labelledby="step_0">
				<input type="hidden" name="contract_type" value="' . $contract_type . '">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label" for="company_add">Company *</label>
						<div class="col-sm-9">
							<select class="form-control form-control-border form-control-sm companyData select2 select2_default" style="width:100%" id="company_add" name="company_id" data-action="company_add" onchange="get_company_info(this.id)">';
								$company_id = $contract_handler->getAllCompanyId();
							echo '</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label" for="contract_no">Contract No *</label>
						<div class="col-sm-9">
							<input type="number" id="contract_no" name="contract_no" value="1" class="form-control form-control-border form-control-sm" required>
						</div><span class="col-sm-6 col-xs-12 offset-sm-3" id="contract_no_res"></span></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="quote_no">Quote No *</label>
								<div class="col-sm-9">
									<input id="quote_no" name="quote_no" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="quote_date">Quote Date *</label>
								<div class="col-sm-9">
									<input type="date" id="quote_date" name="quote_date" value="2020-02-02" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="quantity">Quantity *</label>
								<div class="col-sm-9">
									<input type="number" id="quantity" name="quantity" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="required_date">Date Required *</label>
								<div class="col-sm-9">
									<input type="date" id="required_date" name="required_date" value="2020-02-02" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="job_no">Job No *</label>
								<div class="col-sm-9">
									<input type="number" id="job_no" name="job_no" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="sales_order_no">Sales Order No *</label>
								<div class="col-sm-9">
									<input type="number" id="sales_order_no" name="sales_order_no" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="paymentTM">Payment Terms/Method *</label>
								<div class="col-sm-9">
									<input id="paymentTM" name="paymentTM" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="commissioning">Commissioning *</label>
								<div class="col-sm-9">
									<input id="commissioning" name="commissioning" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="service_notified">Service Notified *</label>
								<div class="col-sm-9">
									<input id="service_notified" name="service_notified" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label" for="penalty_clause">Penalty Clause *</label>
								<div class="col-sm-9">
									<input id="penalty_clause" name="penalty_clause" value="1" class="form-control form-control-border form-control-sm" required>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label" for="salesperson_id">Salesperson *</label>
						<div class="col-sm-9">
							<select class="form-control form-control-border form-control-sm select2 select2_default" style="width:100%" id="salesperson_id" name="salesperson_id">
								<option value="Rental/Sales|N/A">Crestchic Rental/Sales</option>
								<?php $salesperson_ids = $contract_handler->getAllUsersWithSpecificRole(8); ?>
							</select>
						</div>
					</div>
					<div id="info"></div>
				</div>
				<div id="step_1" class="tab-pane" role="tabpanel" aria-labelledby="step_1">Step content</div>
				<div id="step_2" class="tab-pane" role="tabpanel" aria-labelledby="step_2">Step content</div>
				<div id="step_3" class="tab-pane" role="tabpanel" aria-labelledby="step_3">
					<h2 class="StepTitle">Enclosure</h2>
					<div id="mechSel">
						<div class="form-group row">
							<label for="enc" class="col-sm-3 col-form-label text-right">Enclosure</label>
							<div class="col-sm-6 col-xs-12">
								<select class="form-control form-control-sm" name="enc" id="enc" title="Style">
									<option>--SELECT AN OPTION--</option>
									<optgroup label="Canopy">
										<option value="Horizontal" data-enctype="Canopy">Small Enclosure</option>
										<option value="Vertical" data-enctype="Canopy">Vertical</option>
									</optgroup>
									<optgroup label="Container">
										<option value="Container" data-enctype="Container">Container</option>
										<option value="Small Container" data-enctype="Container">Small Container (1, 2 or 3 Fan)</option>
									</optgroup>
								</select>
							</div>
						</div><span id="encStyle"></span> <span id="encSize"></span>
						<div class="form-group row sgh--d-none">
							<label for="encStyle" class="col-sm-3 col-form-label text-right">Style</label>
							<div class="col-sm-6 col-xs-12 encStyle">
								<select class="form-control form-control-sm" name="encStyle">
									<option>--SELECT AN OPTION--</option>
								</select>
							</div>
						</div>
						<div class="form-group row sgh--d-none encSize">
							<label for="encSize" class="col-sm-3 col-form-label text-right">Size</label>
							<div class="col-sm-6 col-xs-12">
								<select class="form-control form-control-sm size" name="encSize" id="encSize">
									<option>--SELECT AN OPTION--</option>
								</select>
							</div>
						</div>
						<div class="form-group row sgh--d-none" id="encLiftingCol">
							<label for="encLifting" class="col-sm-3 col-form-label text-right">Lifting</label>
							<div class="col-sm-6 col-xs-12">
								<select class="form-control form-control-sm" name="encLifting" id="encLifting">
									<option value="Standard">Standard</option>
									<option value="DMV">DMV</option>
									<option value="N/A">N/A</option>
								</select>
							</div>
						</div>
						<div class="form-group row sgh--d-none encHeight" id="encHeightCol">
							<label for="encHeight" class="col-sm-3 col-form-label text-right">Height</label>
							<div class="col-sm-6 col-xs-12">
								<input placeholder="Enter container\'s height" name="encHeight" id="encHeight" class="form-control form-control-sm">
							</div>
						</div>
						<div class="form-group row sgh--d-none encBase" id="encBaseCol">
							<label for="encBase" class="col-sm-3 col-form-label text-right">Base</label>
							<div class="col-sm-6 col-xs-12">
								<select class="form-control form-control-sm withOther" name="encBase" id="encBase">
									<option>--SELECT AN OPTION--</option>
								</select>
								<input class="form-control otherField" disabled name="encBaseOther" placeholder="Please state...">
							</div>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="row">
						<div class="form-group col-12">
							<label>Information</label>
							<p>If colour does not exist choose "Other" & enter details in Other Information</p>
						</div>
						<div class="col-md-3"></div>
						<div class="form-group col-md-3">
							<label>Finish Type</label>
							<select class="form-control form-control-sm withOther" id="enc_finishType" name="enc_finishType" title="Finish Type">
								<option value="BS 4800">British Standard 4800</option>
								<option value="RAL">RAL</option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label>Colours</label>
							<select class="form-control form-control-sm withOther" name="enc_finish" title="Finish" id="enc_finish">
								<option>--SELECT AN OPTION--</option>
								<?php bs_4800_colorsel(); ralcolorsel(); ?>
									<option value="Other - Other">Other</option>
							</select>
						</div>
					</div>
				</div>
				<div id="step_4" class="tab-pane" role="tabpanel" aria-labelledby="step_4">
					<h2 class="StepTitle">Step 4 Content</h2>
					<div class="form-group">
						<label>Other Information</label>
						<textarea name="otherInfo" class="form-control" rows="3" style="margin:0 78px 0 0;width:100%;height:84px" title="Other Information"></textarea>
					</div>
					<div id="feedback"></div>
				</div>
			</div>
		</div>
	</form>';
        }
    } else {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}