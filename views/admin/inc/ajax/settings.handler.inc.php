<?php
require '../../../../config/inc/func.inc.php';
try {
    require '../../../../vendor/autoload.php';

    session_start();

    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;
    $contract_handler = new Connect\Contract;

    $ajax_action = $_POST['ajax_action'];
    if (!array_key_exists('ajax_action', $_POST)) {
        $ajax_action = $_REQUEST['ajax_action'];
    }
    if (isset($ajax_action) && !empty($ajax_action)) {

        /**********************************
         ***  Software  ***
         **********************************/
        if ($ajax_action == 'getAllSoftware') {
            if ($request->valid_token() && ($auth->isAdmin() || $auth->isContractManager())) {
                unset($_GET['csrf_token']);
                $columns = array(
                    array('db' => 'software_id', 'dt' => 0),
                    array('db' => 'software_description', 'dt' => 1),
                    array('db' => 'software_category', 'dt' => 2),
                    array('db' => 'input_type', 'dt' => 3)
                );

                $data = $contract_handler->getAllSoftware($columns);

                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'setSoftwareInfo') {
            if ($request->valid_token() && ($auth->isAdmin() || $auth->isContractManager())) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                if ($_POST['input_type']) {
                    $_POST['input_type'] = 'checkbox';
                } else {
                    $_POST['input_type'] = 'hidden';
                }
                if ($_POST['software_description']) {
                    $_POST['software_value'] = preg_replace('/\s+/', '_', preg_replace('/\./', '_', $_POST['software_description']));
                }
                $software_id = 'io_' . generateRandomString(20);
                $software_name = 'ioInfo[]';
                $_POST = array_merge($_POST, array("software_id" => $software_id, "software_name" => $software_name));

                $action_ed = $contract_handler->setSoftwareInfo($_POST);

                echo json_encode($action_ed);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'updateSoftwareInfo') {
            $request_id = $_POST['request_id'];
            if ($_POST['input_type']){
                $_POST['input_type'] = 'checkbox';
            } else {
                $_POST['input_type'] = 'hidden';
            }
            if ($_POST['software_description']) {
                $_POST['software_value'] = preg_replace('/\s+/', '_', preg_replace('/\./', '_', $_POST['software_description']));
            }
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->isAdmin() || $request_id == $_SESSION['uid'])) {
                unset($_POST['ajax_action']);
                unset($_POST['csrf_token']);
                unset($_POST['request_id']);

                $action_ed = $contract_handler->updateSoftwareInfo($request_id, $_POST);
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
