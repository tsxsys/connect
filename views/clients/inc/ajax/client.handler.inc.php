<?php
require '../../../../config/inc/func.inc.php';
try {
    require '../../../../vendor/autoload.php';

    session_start();

    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;
    $user_handler = new Connect\UserHandler;
    $contract_handler = new Connect\Contract;

    $ajax_action = $_POST['ajax_action'];
    if (!array_key_exists('ajax_action', $_POST)) {
        $ajax_action = $_REQUEST['ajax_action'];
    }
    if (!empty($ajax_action)) {

        /**********************************
         ***  Companies  ***
         **********************************/
        if ($ajax_action == 'getAllCompanies') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_GET['csrf_token']);
                $columns = array(
                    array('db' => 'company_id', 'dt' => 0),
                    array('db' => 'company_name', 'dt' => 1),
                    array('db' => 'company_contract_count', 'dt' => 2)
                );

                $data = $user_handler->getAllCompanies($columns);

                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'getAllCustomers') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_GET['csrf_token']);
                $member_type = 'customer';
                $columns = array(
                    array('db' => 'id', 'dt' => 0),
                    array('db' => 'firstname', 'dt' => 1),
                    array('db' => 'lastname', 'dt' => 2),
                    array('db' => 'company_name', 'dt' => 3),
                    array('db' => 'email', 'dt' => 4)
                );

                $data = $user_handler->getAllCustomers($member_type, $columns);

                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'getAllIntermediaries') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_GET['csrf_token']);
                $member_type = 'intermediary';
                $columns = array(
                    array('db' => 'id', 'dt' => 0),
                    array('db' => 'firstname', 'dt' => 1),
                    array('db' => 'lastname', 'dt' => 2),
                    array('db' => 'email', 'dt' => 3)
                );

                $data = $user_handler->getAllClients($member_type, $columns);

                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'editCustomerInfo') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = $_POST['request_id'];
                unset($_POST['request_id']);
                $action_ed = $user_handler->editCustomerInfo($request_id, $_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'editClientEmail') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = $_POST['request_id'];
                unset($_POST['request_id']);
                $action_ed = $user_handler->editClientEmail($request_id, $_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateCustomerAC') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = $_POST['request_id'];
                unset($_POST['request_id']);
                $action_ed = $user_handler->updateCustomerAC($request_id, $_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'editIntermediaryEmail') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isContractManager())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = $_POST['request_id'];
                unset($_POST['request_id']);
                $member_type = 'intermediary';
                $action_ed = $user_handler->editClientEmail($request_id, $member_type, $_POST);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateUsersContracts') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = json_decode($_POST['request_id'], true);
                $_assigned = json_decode($_POST['_assigned'], true);

                $action_ed = $contract_handler->updateUsersContracts($_assigned, $request_id);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateIntermediaryContracts') {
            if ($request->valid_token() && ($auth->isLoggedIn())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                $request_id = json_decode($_POST['request_id'], true);
                $_assigned = json_decode($_POST['_assigned'], true);

                $action_ed = $contract_handler->updateIntermediaryContracts($_assigned, $request_id);
                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
    }
} catch
(Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}
