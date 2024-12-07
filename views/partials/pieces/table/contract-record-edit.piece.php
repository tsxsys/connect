<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../config/inc/func.inc.php';
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
$user_handler = new Connect\UserHandler;
$contract_handler = new Connect\Contract;
$control_systems_Arr = $contract_handler->pullAllControlSystem();
$enclosures_Arr = $contract_handler->pullAllEnclosures();
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $company_info = $user_handler->getCompanyInfo($request_id);
        $members_info = $user_handler->getCompanyMemberInfo($request_id);
        $company_contract_info = $user_handler->getCompanyContractInfo($request_id);
        $contract_info = $contract_handler->getContractInfo($request_id);
        $iOCheckedArr = $contract_handler->pullCheckedAssignedSoftware($request_id);
        $cSCheckedArr = $contract_handler->pullAssignedControlSystem($request_id);
        echo '
<input type="hidden" data-bs-toggle="modal" data-bs-target="#x_' . $request_id . '99">
<form class="form-horizontal" id="form_edit_contract" name="form_edit_contract" method="post" 
    data-role="update" data-action="form_edit_contract" data-xeid="' . $request_id. '"
               enctype="multipart/form-data" onsubmit="return false">
<div class="modal fade" id="x_' . $request_id . '99" tabindex="-1" aria-labelledby="x_' . $request_id . '99Label"
   aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">

      <div class="modal-content">
         
         <div class="modal-header">
            <h5 class="modal-title" id="x_' . $request_id . '99Label">Edit Contract C' . $contract_info['contract_no'] . '</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           
               
               <ul class="nav nav-tabs md-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="contract_type_tab" data-bs-toggle="tab" data-bs-target="#contract_type" type="button" role="tab" aria-controls="contract_type" aria-selected="true">Contract Type</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="contract_details_tab" data-bs-toggle="tab" data-bs-target="#contract_details" type="button" role="tab" aria-controls="contract_details" aria-selected="false">Contract Details</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="electrical_specification_tab" data-bs-toggle="tab" data-bs-target="#electrical_specification" type="button" role="tab" aria-controls="electrical_specification" aria-selected="true">Electrical Specification</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="control_specification_tab" data-bs-toggle="tab" data-bs-target="#control_specification" type="button" role="tab" aria-controls="control_specification" aria-selected="false">Control Specification</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="transformer_details_tab" data-bs-toggle="tab" data-bs-target="#transformer_details" type="button" role="tab" aria-controls="transformer_details" aria-selected="false">Transformer Details</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="mechanical_specification_tab" data-bs-toggle="tab" data-bs-target="#mechanical_specification" type="button" role="tab" aria-controls="mechanical_specification" aria-selected="true">Mechanical Specification</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="other_specification_tab" data-bs-toggle="tab" data-bs-target="#other_specification" type="button" role="tab" aria-controls="other_specification" aria-selected="false">Other Specification</button>
                     <div class="slide"></div>
                  </li>
               </ul>
               <div class="tab-content ts_tab_content" id="myTabContent1">
                  <div class="tab-pane fade show active" id="contract_type" role="tabpanel" aria-labelledby="contract_type_tab">
                     <div title="Contract Details">
                        <div class="row center ts_contract_ty">
                           <div class="col-md-4 col-sm-4">
                              <label>
                                 <input class="ts_contract_type_radio" type="radio" name="contract_type" value="Single Unit" id="single_unit"
                                 onclick="ts_sel_a_form()"
                                 onload="ts_sel_a_form()" ';
        if ($contract_info['contract_type'] == "Single Unit") {
            echo "checked";
        }
        echo '>
                                 <span class="ts_contract_list comp-wrap__link-hover">
                                    <h4>Single Unit</h4>
                                    <span class="ts_description">Unit type single loadbank</span>
                                    <span title="Single Unit" class="read-more">
                                    <i class="ts_contract_icon ts_single_unit la la-building-o"></i>
                                    </span>
                                 </span>
                              </label>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>
                                 <input class="ts_contract_type_radio" type="radio" name="contract_type" value="Combi" id="combi"
                                 onclick="ts_sel_a_form(this.id)" onload="ts_sel_a_form(this.id)" ';
        if ($contract_info['contract_type'] == "Combi") {
            echo "checked";
        }
        echo '
                                 >
                                 <span class="ts_contract_list comp-wrap__link-hover">
                                    <h4>Combi</h4>
                                    <span class="ts_description">Unit type Combi loadbank</span>
                                    <span title="Combi" class="read-more">
                                    <i class="ts_contract_icon ts_combi_unit la la-server"></i>
                                    </span>
                                 </span>
                              </label>
                           </div>
                           <div class="col-md-4 col-sm-4">
                              <label>
                                 <input class="ts_contract_type_radio" type="radio" name="contract_type" value="Transformer" id="transformer"
                                 onclick="ts_sel_a_form(this.id)"
                                 onload="ts_sel_a_form(this.id)" ';
        if ($contract_info['contract_type'] == "Transformer") {
            echo "checked";
        }
        echo '
                                 >
                                 <span class="ts_contract_list comp-wrap__link-hover">
                                    <h4>Transformer</h4>
                                    <span class="ts_description">Unit type transformer</span>
                                    <span title="Transformer" class="read-more">
                                    <span class="ts_contract_icon ts_trx_unit icon-energy"></span>
                                    </span>
                                 </span>
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="contract_details" role="tabpanel" aria-labelledby="contract_details_tab">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="company_add">Company *</label>
                        <div class="col-sm-9">
                           <select class="form-control form-control-border form-control-sm companyData select2 select2_default"
                              style="width: 100%;" id="company_add" name="company_id" data-action="company_add"
                              onchange="get_company_info(this.id)" required>';
        if (!empty($contract_info['company_id'])) {
            echo '<option value="' . $contract_info['company_id'] . '">' . $contract_info['company_name'] . '</option>';
        }
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
                           <input type="number" id="contract_no" name="contract_no" value="';
        if (!empty($contract_info['contract_no'])) {
            echo $contract_info['contract_no'];
        } echo '"
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
                                 <input type="text" id="quote_no" name="quote_no" value="';
        if (!empty($contract_info['quote_no'])) {
            echo $contract_info['quote_no'];
        } echo '"
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
                                 <input type="date" id="quote_date" name="quote_date" value="';
        if (!empty($contract_info['quote_date'])) {
            echo $contract_info['quote_date'];
        } echo '"
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
                                 <input type="text" id="order_no" name="order_no" value="';
        if (!empty($contract_info['order_no'])) {
            echo $contract_info['order_no'];
        } echo '"
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
                                 <input type="date" id="order_date" name="order_date" value="';
        if (!empty($contract_info['order_date'])) {
            echo $contract_info['order_date'];
        } echo '"
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
                                 <input type="number" id="quantity" name="quantity" value="';
        if (!empty($contract_info['quantity'])) {
            echo $contract_info['quantity'];
        } echo '"
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
                                 <input type="date" id="required_date" name="required_date" value="';
        if (!empty($contract_info['required_date'])) {
            echo $contract_info['required_date'];
        } echo '"
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
                                 <input type="number" id="job_no" name="job_no" value="';
        if (!empty($contract_info['job_no'])) {
            echo $contract_info['job_no'];
        } echo '"
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
                                 <input type="number" id="sales_order_no" name="sales_order_no" value="';
        if (!empty($contract_info['sales_order_no'])) {
            echo $contract_info['sales_order_no'];
        } echo '"
                                    class="form-control form-control-border form-control-sm" required>
                                 <div class="invalid-feedback">
                                    This field is required
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     ';
        echo '
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="form-group row">
                              <label class="col-sm-3 col-form-label" for="paymentTM">Payment Terms/Method *</label>
                              <div class="col-sm-9">
                                 <input type="text" id="paymentTM" name="paymentTM" value="';
        if (!empty($contract_info['paymentTM'])) {
            echo $contract_info['paymentTM'];
        } echo '"
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
                                 <input type="text" id="commissioning" name="commissioning" value="';
        if (!empty($contract_info['commissioning'])) {
            echo $contract_info['commissioning'];
        } echo '"
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
                                 <input type="text" id="service_notified" name="service_notified" value="';
        if (!empty($contract_info['service_notified'])) {
            echo $contract_info['service_notified'];
        } echo '"
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
                                 <input type="text" id="penalty_clause" name="penalty_clause" value="';
        if (!empty($contract_info['penalty_clause'])) {
            echo $contract_info['penalty_clause'];
        } echo '" class="form-control form-control-border form-control-sm" required>
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
                              style="width: 100%;" id="salesperson_id" name="salesperson_id" required>';
        if (!empty($contract_info['salesperson_id'])) {
            echo '<option value="' . $contract_info['salesperson_id'] . '">' . $contract_info['full_name'] . '</option>';
        }
        echo '<option value="">--SELECT AN OPTION--</option> ';
        $salesperson_ids = $contract_handler->getAllUsersWithSpecificRole(8);
        echo '
                           </select>
                           <div class="invalid-feedback">This field is required</div>
                        </div>
                     </div>
                     <div id="info"></div>
                  </div>
                  <div class="tab-pane fade" id="electrical_specification" role="tabpanel" aria-labelledby="electrical_specification_tab">
                     <div title="Electrical Specification">
                        <div class="row">
                           <div class="col-lg-12 col-md-12">
                              <div class="sgh-box">
                                 <div class="row">
                                    <div class="row m-b-30 electrical_spec_config">
                                       <div class="col-md-3">
                                          <h2 class="StepTitle">Current Flow</h2>
                                          <div class="sgh--radio radio radio-default sgh--block">
                                             <label>
                                             <input type="radio" name="current_flow" value="AC"
                                             class="md-radio"
                                             ';
        if ($contract_info['current_flow'] == "AC") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['current_flow'] == "DC Constant Current") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['current_flow'] == "DC Constant Voltage") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['load_type'] == "Resistive") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['load_type'] == "Resistive/Reactive") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['config'] == "Single Phase") {
            echo "checked";
        }
        echo '
                                             ><span class="circle"></span><span
                                                class="check"></span>
                                             Single Phase
                                             </label>
                                          </div>
                                          <div class="sgh--radio radio radio-default sgh--block">
                                             <label>
                                             <input type="radio" name="config"
                                             value="Star" class="md-radio"
                                             ';
        if ($contract_info['config'] == "Star") {
            echo "checked";
        }
        echo '
                                             ><span class="circle"></span><span
                                                class="check"></span>
                                             Star
                                             </label>
                                          </div>
                                          <div class="sgh--radio radio radio-default sgh--block">
                                             <label>
                                             <input type="radio" name="config"
                                             value="Delta" class="md-radio"
                                             ';
        if ($contract_info['config'] == "Delta") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['config'] == "Star/Delta") {
            echo "checked";
        }
        echo '
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
                                             ';
        if ($contract_info['usage_frequency'] == "Periodically") {
            echo "checked";
        }
        echo '
                                             ><span class="circle"></span><span
                                                class="check"></span>
                                             Periodically
                                             </label>
                                          </div>
                                          <div class="sgh--radio radio radio-default sgh--block">
                                             <label>
                                             <input type="radio" name="usage_frequency"
                                             value="Continuous" class="md-radio"
                                             ';
        if ($contract_info['usage_frequency'] == "Continuous") {
            echo "checked";
        }
        echo '
                                             ><span class="circle"></span><span
                                                class="check"></span>
                                             Continuous
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="x_electrical_specification"></div>
                                 <div class="well" style="background-color: #fff;">
                                    <h2 class="StepTitle">Auxiliary Supply</h2>
                                    <div class="form-group" style="padding-left: 15px;">
                                       <label>Auxiliary Type</label>
                                       <div class="row"></div>
                                       <div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="Internal" class="md-checkbox"';
        if (strpos($contract_info['auxInfo'], "Internal") !== false) {
            echo "checked";
        }
        echo '><span class="checkbox-material"><span class="check"></span></span> Internal </label>
                                       </div>
                                       <div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="External" class="md-checkbox"';
        if (strpos($contract_info['auxInfo'], "External") !== false) {
            echo "checked";
        }
        echo '><span class="checkbox-material"><span class="check"></span></span> External </label>
                                       </div>
                                       <div class="checkbox checkbox-default sgh--checkbox"><label><input type="checkbox" name="auxInfo" value="Switched" class="md-checkbox"';
        if (strpos($contract_info['auxInfo'], "Switched") !== false) {
            echo "checked";
        }
        echo '><span class="checkbox-material"><span class="check"></span></span> Switched </label>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-3 col-sm-6 col-xs-12">
                                          <div class="form-group">
                                             <label>VOLTS</label>
                                             <select class="form-control withOther"
                                                name="auxSV">
                                                <option selected
                                                   value="' . $contract_info['auxSV'] . '  "> ' . $contract_info['auxSV'] . ' 
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
                                                <option selected value="' . $contract_info['auxSHz'] . '  ">
                                                   ' . $contract_info['auxSHz'] . '
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
                                                <option selected value="' . $contract_info['auxSPH'] . '  ">
                                                   ' . $contract_info['auxSPH'] . '
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
                                                ';
        if (strpos($contract_info['auxSW'], "2") !== false) {
            echo "checked";
        }
        echo '
                                                ><span class="checkbox-material"><span
                                                   class="check"></span></span>
                                                2</label>
                                             </div>
                                             <div class="checkbox checkbox-default sgh--checkbox">
                                                <label><input type="checkbox" name="auxSW"
                                                value="3" class="md-checkbox"
                                                ';
        if (strpos($contract_info['auxSW'], "3") !== false) {
            echo "checked";
        }
        echo '
                                                ><span class="checkbox-material"><span
                                                   class="check"></span></span>
                                                3</label>
                                             </div>
                                             <div class="checkbox checkbox-default sgh--checkbox">
                                                <label><input type="checkbox" name="auxSW"
                                                value="4" class="md-checkbox"
                                                ';
        if (strpos($contract_info['auxSW'], "4") !== false) {
            echo "checked";
        }
        echo '
                                                ><span class="checkbox-material"><span
                                                   class="check"></span></span>
                                                4</label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="well" style="background-color: #fff;">
                                    <h4 class="StepTitle">Ambient Temperature Operation Range
                                       <b>&#8451;</b>
                                    </h4>
                                    <input type="text" id="range_temperature_2" name="range"/>
                                    <input type="hidden" id="range_tempC" name="range_temp_C"/>
                                    <input type="hidden" id="rangeTempCFrom"
                                       value="$rangeTempCFrom"/>
                                    <input type="hidden" id="rangeTempCTo"
                                       value="' . $contract_info['supplyV'] . '$rangeTempCTo"/>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="control_specification" role="tabpanel" aria-labelledby="control_specification_tab">
                     <div title="Control Specification">
                        <div class="row">
                           <div class="col-lg-12 col-md-12">
                              <div class="sgh-box">
                                 <h4>Control System</h4>
                                 <div class="row">
                                    <div class="col-sm-12 col-xl-12 m-b-30">
                                       <h4 class="sub-title">Controller</h4>
                                       ';
        if ($control_systems_Arr['status'] === true) {
            foreach ($control_systems_Arr['control_system'] as $key => $control_system) {
                $control_system[4] = htmlspecialchars($control_system[4], ENT_QUOTES);
                $control_system[5] = htmlspecialchars($control_system[5], ENT_QUOTES);
                echo '
                                       <div class="checkbox-color checkbox-dark">
                                          <input class="control_system" data-xeid="' . $request_id . '" id="' . $control_system[0] . '_998" value="' . $control_system[0] . '"  type="' . $control_system[1] . '" name="' . $control_system[2] . '"';
                if (ifInArray($control_system[0], $cSCheckedArr, "control_system_id") === true) {
                    echo 'checked';
                }
                echo '><label for="' . $control_system[0] . '_998">' . $control_system[5] . '</label>
                                       </div>
                                       ';
            }
        }
        echo '
                                    </div>
                                 </div>

<div class="row">
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Control Leads</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther" id="lead"
                                                                            style="width: 100%;">
                                                                        <option value="Comms Lead">Comms Lead
                                                   </option>
                                                   <option value="Ext Reel">Ext Reel</option>
                                                   <option value="HHT Lead">HHT Lead</option>
                                                   <option value="KCS100HM Lead">KCS100HM Lead</option>
                                                   <option value="LC60 Lead">LC60 Lead</option>
                                                   <option value="LC80 Lead">LC80 Lead</option>
                                                   <option value="PC Lead">PC Lead</option>
                                                   <option value="System Extend">System
                                                      Extend
                                                   </option>
                                                   <option value="Other">Other</option>
                                                                    </select>
                                                                    <input class="form-control form-control-border form-control-sm leadInput otherField"
                                                   id="leadOther" type="text"
                                                   placeholder="Please State..">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Length</label>
                                                                    <select class="form-control form-control-border form-control-sm select2 select2_default withOther" id="leadLength"
                                                                            style="width: 100%;">
                                                                            <option value="5m">5m</option>
                                                   <option value="10m">10m</option>
                                                   <option value="20m">20m</option>
                                                   <option value="50m">50m</option>
                                                   <option value="100m">100m</option>
                                                   <option value="Other">Other</option>
                                                                    </select>
                                                   <input class="form-control form-control-border form-control-sm leadInput otherField"
                                                   id="leadLengthOther" type="text"
                                                   placeholder="Please State..">
                                                                </div>
                                                            </div>
                                                             <div class="col-sm-3 col-xs-12">
                                                        <label>Quantity</label>
                                                <input class="form-control form-control-border form-control-sm leadInput"
                                                   id="leadNo" type="number">     
                                                             </div>
                                                            <div class="col-sm-3 col-xs-12">
                                                <button class="btn btn-primary-1 btn-sm"
                                                   id="addControlLead" type="button"
                                                   onclick="add_control_lead()">
                                                Add
                                                </button>
                                             </div>
                                                            </div>
                                                     <div class="row">
                                                     <div class="col-12">       
                                                            <div class="form-group">
                                             <label for="tags_1">Controller Leads Selected</label>
                                             <input id="tags_1" type="text"
                                                class="tags form-control"
                                                value="' . $contract_info['leads'] . '"/>
                                             <div id="suggestions-container"
                                                style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                             <input class="form-control sgh--tags-box"
                                                type="hidden" name="leads" id="conLeads"
                                                value="' . $contract_info['leads'] . '">
                                          </div>
                                          </div>
                                                            </div>
                                                     <div class="row">
                                                     <div class="col-12"> 
                                          <div class="form-group">
                                             <label for="control_info" style="margin-top: 20px;">Controller
                                             Information</label>
                                             <textarea class="form-control form-control-border form-control-sm" name="control_info"
                                             rows="3" id="control_info"
                                             style="margin: 0 78px 30px 0; max-width: 100%; height: 84px;"';
        if (empty($control_info)) {
            echo 'placeholder="No data found"';
        }
        if (!empty($control_info)) {
            echo $control_info;
        }
        echo '
                                             ></textarea>
                                          </div>
                                      </div>
                                      </div>    
                                 
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="transformer_details" role="tabpanel" aria-labelledby="transformer_details_tab">
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
                                             ';
        if ($contract_info['coolingType'] == "Cast Resin") {
            echo "checked";
        }
        echo '><span class="circle"></span><span class="check"></span>
                                             Cast Resin
                                             </label>
                                          </div>
                                          <div class="sgh--radio radio radio-default sgh--inline-block">
                                             <label>
                                             <input type="radio" name="coolingType"
                                             value="Oil Cooled"
                                             class="md-radio"
                                             ';
        if ($contract_info['coolingType'] == "Oil Cooled") {
            echo "checked";
        }
        echo '><span class="circle"></span><span class="check"></span>
                                             Oil Cooled
                                             </label>
                                          </div>
                                       </div>
                                       <div class="col-md-8">
                                          <h2 class="StepTitle">Transformer Rating</h2>
                                          <div class="row">
                                          <div class="col-md-6">
                                             <label>Primary Rating (Volts)</label>
                                             <input class="form-control form-control-border form-control-sm" type="number" name="txPRating" value="' . $contract_info['txPRating'] . '  ">
                                          </div>
                                          <div class="col-md-6">
                                             <label>Secondary Rating (Volts)</label>
                                             <input class="form-control form-control-border form-control-sm" type="number" name="txSRating" value="' . $contract_info['txSRating'] . '  ">
                                          </div>
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
                                                ';
        if ($contract_info['fanRotation'] == "Anticlockwise") {
            echo "checked";
        }
        echo '>
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
                                                ';
        if ($contract_info['fanRotation'] == "Clockwise") {
            echo "checked";
        }
        echo '><span class="circle"></span><span
                                                   class="check"></span>
                                                Clockwise
                                                </label>
                                             </div>
                                          </div>
                                          <div class="col-md-8">
                                             <h2 class="StepTitle">Switchgear Rating</h2>
                                             <div class="row">
                                             <div class="col-md-6">
                                                <label>Primary Rating (Volts)</label>
                                                <input class="form-control form-control-border form-control-sm" type="number" name="sgPRating" value="' . $contract_info['sgPRating'] . '">
                                             </div>
                                             <div class="col-md-6">
                                                <label>Secondary Rating (Volts)</label>
                                                <input class="form-control form-control-border form-control-sm" type="number" name="sgSRating" value="' . $contract_info['sgSRating'] . '">
                                             </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="row m-b-30">
                                          <div class="col-md-4">
                                             <h2 class="StepTitle">Relay Type</h2>
                                             <div class="form-group">
                                                <label>ABB</label>
                                                <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
                                                                            style="width: 100%;"
                                                                            name="relayType">
                                                   <option selected value="' . $contract_info['relayType'] . '  ">' . $contract_info['relayType'] . '</option>
                                                   <option value="REF615">REF615</option>
                                                   <option value="REJ603 v1">REJ603 v1</option>
                                                   <option value="REJ603 v3">REJ603 v3</option>
                                                   <option value="Other">Other</option>
                                                </select>
                                                <input class="form-control form-control-border form-control-sm otherField" disabled
                                                   type="text" name="relayTypeOther"
                                                   placeholder="Please state...">
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
                  <div class="tab-pane fade" id="mechanical_specification" role="tabpanel" aria-labelledby="mechanical_specification_tab">
                     <div title="Mechanical Information">
                        <div id="mechSel">
                           <div class="form-group row">
                              <label for="enc" class="col-sm-3 col-form-label text-right">
                              Enclosure </label>
                              <div class="col-sm-6 col-xs-12">
                                 <select class="form-control form-control-border form-control-sm select2 select2_default" name="enclosure"
                                    id="enc"
                                    title="Style">';
        if (!empty($contract_info['enclosure'])) {
            echo '<option value="' . $contract_info['enclosure_id'] . '" data-enclosure_value="' . $contract_info['enclosure_value'] . '" data-encType="' . $contract_info['enclosure_category'] . '">' . $contract_info['enclosure_description'] . '</option>';
        } else {
            echo '<option>--SELECT AN OPTION--</option>';
        }

        if ($enclosures_Arr['status'] === true) {
            foreach ($enclosures_Arr['enclosures'] as $key => $value) {
                $groupedArr[$value[3]][] = $value;
            }
            foreach ($groupedArr as $category => $categoryVal) {
                echo '<optgroup label="' . $category . '">';
                foreach ($categoryVal as $enclosure) {
//                    $enclosure[4] = htmlspecialchars($enclosure[4], ENT_QUOTES);
//                    $enclosure[5] = htmlspecialchars($enclosure[5], ENT_QUOTES);
                    echo '<option id="' . $enclosure[0] . '_998" value="' . $enclosure[0] . '" data-enclosure_value="' . $enclosure[4] . '" data-encType="' . $enclosure[3] . '">' . $enclosure[5] . '</option>';

                }
                echo '</optgroup>';
            }
        }

        echo '</select>
                              </div>
                           </div>
                           <span id="encStyle"></span>
                           <span id="encSize"></span>
                           <div class="form-group row sgh--d-none">
                              <label for="encStyle" class="col-sm-3 col-form-label text-right">
                              Style </label>
                              <div class="col-sm-6 col-xs-12 encStyle">
                                 <select class="form-control form-control-border form-control-sm select2 select2_default" name="encStyle" id="">
                                    <option>--SELECT AN OPTION--</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row sgh--d-none encSize">
                              <label for="encSize" class="col-sm-3 col-form-label text-right">
                              Size </label>
                              <div class="col-sm-6 col-xs-12">
                                 <select class="form-control form-control-border form-control-sm select2 select2_default size" name="encSize" id="encSize">
                                    <option>--SELECT AN OPTION--</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row sgh--d-none" id="encLiftingCol">
                              <label for="encLifting" class="col-sm-3 col-form-label text-right">
                              Lifting </label>
                              <div class="col-sm-6 col-xs-12">
                                 <select class="form-control form-control-border form-control-sm select2 select2_default" name="encLifting" id="encLifting">
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
                                 <input type="text" placeholder="Enter container\'s height"
                                    name="encHeight" id="encHeight" class="form-control form-control-border form-control-sm">
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
                                 <input class="form-control form-control-border form-control-sm otherField" disabled type="text"
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
                                 Information
                              </p>
                           </div>
                           <div class="col-md-3"></div>
                           <div class="form-group col-md-3">
                              <label>Finish Type</label>
                              <select class="form-control form-control-border form-control-sm select2 select2_default withOther"
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
                              <select class="form-control form-control-border form-control-sm select2 select2_default withOther" name="enc_finish"
                                 title="Finish" id="enc_finish">
                                 <option>--SELECT AN OPTION--</option>
                                 ';
        bs_4800_colorsel();
        ralcolorsel();
        echo '
                                 <option value="Other - Other">Other</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="other_specification" role="tabpanel" aria-labelledby="other_specification_tab">
                     <div title="Other Information">
                        <div class="row">
                           <div class="col-lg-12 col-md-12">
                              <div class="sgh-box">
                                 <div class="row">
                                    <div class="col-12">
                                       <div class="form-group">
                                          <label>Other Information</label>
                                          <textarea name="otherInfo" class="form-control"
                                          rows="3"
                                          style="margin: 0 24px 0 0;  max-width: 100%; height: 82px;"
                                          ';
        if (empty($otherInfo)) {
            echo 'placeholder="No data found"';
        }
        if (!empty($otherInfo)) {
            echo $otherInfo;
        }
        echo '
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
         
         <div class="modal-footer">
             <button type="submit" class="btn btn-primary-1 btn-sm" data-role="form_submit_btn" data-action="updateContract"
                     id="edit_contract_btn" onclick="post_smart_form(this.id, form.id)">
                 Submit
             </button>
            <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
   
</div></form>
';
    } else {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}