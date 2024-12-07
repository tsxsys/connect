<?php
try {
    require '../../../../vendor/autoload.php';

    session_start();

    $request = new Connect\CSRFHandler;
    $auth = new Connect\AuthorizationHandler;
    $admin_handler = new Connect\AdminFunctions;
    $department_handler = new Connect\DepartmentHandler;

    $ajax_action = $_POST['ajax_action'];
    if(isset($ajax_action) && !empty($ajax_action)) {
        if ($ajax_action == 'getAllDepts') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('View Departments'))) {
                unset($_GET['csrf_token']);
                $columns = array(
                    array('db' => 'dept_id', 'dt' => 0),
                    array('db' => 'dept_name', 'dt' => 1),
                    array('db' => 'dept_head', 'dt' => 2),
                    array('db' => 'full_name', 'dt' => 3),
                    array('db' => 'action', 'dt' => 4)
                );

                $data = $admin_handler->getAllDepts($_GET, $columns);

                echo json_encode($data);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'createDepartment') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Create Departments'))) {
                unset($_POST['csrf_token']);

                $departmentName = $_POST['departmentName'];

                $resp = $department_handler->createDepartment($departmentName);

                echo json_encode($resp);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized: function must be performed Superadmin');
            }
        }
        if ($ajax_action == 'getDepartmentData') {
            if ($request->valid_token() && ($auth->isSuperAdmin()) || $auth->hasPermission('Create Departments')) {
                $department_id = $_POST['department_id'];

                $department_data = $department_handler->getDepartmentData($department_id);

                echo json_encode($department_data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'editDepartment') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Create Departments'))) {
                unset($_POST['csrf_token']);

                $dept_id = $_POST['dept_id'];
                $dept_name = $_POST['dept_name'];

                $resp = $department_handler->updateDepartment($dept_id, $dept_name);

                echo json_encode($resp);
            } else {
                http_response_code(401);
                throw new Exception('Unauthorized');
            }
        }
        if ($ajax_action == 'deleteDepartment') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Delete Departments'))) {
                $ids = $_POST['ids'];

                $eresult = $department_handler->listSelectedDepartments($ids);

                foreach ($eresult as $e) {
                    try {
                        $singleId = $e['dept_id'];

//                    $Department_name = $department_handler->getDepartmentName($singleId);

//                    if (in_array($Department_name, array('Superadmin', 'Admin', 'Standard User'))) {
//                        header('HTTP/1.1 400 Bad Request');
//                        throw new Exception("Cannot delete Superadmin, Admin or Standard User Departments");
//                    } else {
//                        $dresponse = $department_handler->deleteDepartment($singleId);
//                    }

                        //Deletes Department
                        $dresponse = $department_handler->deleteDepartment($singleId);
                        //Success
                        if ($dresponse == 1) {
                            echo $dresponse;
                        } else {
                            //Validation error from empty form variables
                            header('HTTP/1.1 400 Bad Request');
                            throw new Exception("Failure");
                        }
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                    }
                }
            }
        }

        if ($ajax_action == 'departmentUsersInfo') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('View Users'))) {
                $user_id = $_POST['user_id'];
                $user_data = Connect\ProfileData::pullAllUserInfo($user_id);

                echo json_encode($user_data);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'departmentUsersList') {
            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Assign Users to Departments'))) {
                $department_id = $_POST['department_id'];

                $department_head = $department_handler->getDepartmentHead($department_id);
                $department_users = $department_handler->listDepartmentUsers($department_id);
                $users = $department_handler->listAllActiveUsers();

                $combo_array = [];
                $combo_array['all_users'] = $combo_array['department_head'] = $combo_array['department_users'] = $combo_array['diff_users'] = [];

                foreach ($users as $uid => $user) {
                    array_push($combo_array['all_users'], array('id' => $user['id'], 'username' => $user['username']));
                    array_push($combo_array['diff_users'], array('id' => $user['id'], 'username' => $user['username']));
                }

                foreach ($department_users as $d_id => $department_user) {
                    array_push($combo_array['department_users'], array('id' => $department_user['id'], 'username' => $department_user['username']));
                }
                foreach ($department_head as $d_id => $department_head_) {
                    array_push($combo_array['department_head'], array('id' => $department_head_['id'], 'username' => $department_head_['username']));
                }
                foreach ($combo_array['department_users'] as $department_user) {
                    if (($departmentKey = array_search($department_user['username'], array_column($combo_array['all_users'], 'username'))) !== false) {
                        unset($combo_array['diff_users'][$departmentKey]);
                    }
                }

                $combo_array['diff_users'] = array_values($combo_array['diff_users']);

                echo json_encode($combo_array);
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'assignDepartmentUsers') {

            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Assign Users to Departments'))) {
                try {
                    $users = json_decode($_POST['formData'], true);

                    $department_id = $_POST['departmentId'];

                    $department_handler->updateDepartmentUsers($users, $department_id);

                    http_response_code(200);
                    echo "true";
                    return;
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
        if ($ajax_action == 'assignDepartmentHead') {

            if ($request->valid_token() && ($auth->isSuperAdmin() || $auth->hasPermission('Assign Users to Departments'))) {
                try {
                    $dept_head = $_POST['dept_head'];
                    $department_id = $_POST['departmentId'];

                    $action = $department_handler->updateDepartmentHead($dept_head, $department_id);
                    echo json_encode($action);
//                http_response_code(200);
//                echo "true";
//                return;
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            } else {
                http_response_code(401);
                throw new Exception("Unauthorized");
            }
        }
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}
