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
                        <p class="m-3">Add Job Details</p>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="smart_contract_form1">
                                    <div class="row center ts_contract_ty">
                                        <div class="col-md-4 col-sm-4">
                                            <label>
                                                <input class="ts_contract_type_radio" type="radio"
                                                       name="contract_type" value="Single Unit" id="single_unit">
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
                                                <input class="ts_contract_type_radio" type="radio"
                                                       name="contract_type" value="Combi"
                                                       id="combi"
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
                                                <input class="ts_contract_type_radio" type="radio"
                                                       name="contract_type" value="Transformer"
                                                       id="transformer"
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
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->


