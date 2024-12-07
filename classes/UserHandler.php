<?php
/**
 * Connect\UserHandler extends DbConn
 */

namespace Connect;

/**
 * User handling functions
 *
 *  Various methods related to user management
 */
class UserHandler extends DbConn
{
    /**
     * Creates new user
     *
     * @param array $userarr Array of users
     *
     * @return mixed
     */
    public static function getDefaultDepartment(): int
    {
        $db = new DbConn;
        $sql = "SELECT `dept_id` FROM " . $db->tbl_departments . "
                    WHERE dept_name = 'Default'";

        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return $result;
    }

    public function validateEmail($data): array
    {
        try {
            // prepare sql and bind parameters
            $sql = "SELECT `email` FROM " . $this->tbl_members . " WHERE `email` = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $data);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $result['status'] = false;
            } else {
                $result['status'] = true;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function resetAccountPwd($request_id, $unique_pwd): array
    {
        try {
            // encrypt password
            $pw = PasswordHandler::encryptPw($unique_pwd);

            $sql = "UPDATE " . $this->tbl_members . " SET `password` = :password 
            WHERE `id` = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $request_id);
            $stmt->bindParam(':password', $pw);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function updateAccountInfo($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_member_info . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `userid` = :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userid', $request_id);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function updateAccount($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_members . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `id` = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $request_id);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function getAllStaffRoles()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_roles . " WHERE `id` != '1'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($result as $row) {
                    $role_id = $row['id'];
                    $role_name = $row['name'];
                    $options[] = '<option value="' . $role_id . '">' . $role_name . '</option>';
                }
            } else {
                $options = [];
            }
            return $options;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }

    }

    public function getAllCompanyOptions()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_companies . " ORDER BY `company_name` ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($result as $row) {
                    $company_id = $row['company_id'];
                    $company_name = $row['company_name'];
                    $options[] = '<option value="' . $company_id . '">' . $company_name . '</option>';
                }
            } else {
                $options = [];
            }
            return $options;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }

    }

    public function getAllCompanies($columns): array
    {
        try {
            $sql = "SELECT c.*,ifnull(count(c.`company_id`), 0) AS company_contract_count 
                    FROM " . $this->tbl_companies . " c
                    LEFT JOIN " . $this->tbl_company_contracts . " c_contracts ON 
                        c.`company_id` = c_contracts.`company_id`
                     GROUP BY
                        c.`company_id`,
                        c.company_name";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return array(
                "data" => MiscFunctions::data_output($columns, $data)
            );
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getCompanyCount(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_companies;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getClientCount($member_type)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_members . " WHERE `member_type` = :member_type";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getCompanyInfo($request_id)
    {
        try {
            $sql = "SELECT
                        company.*
                    FROM
                        " . $this->tbl_companies . " AS company
                    WHERE 
                         company.`company_id` = :company_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $result = $row;
            }
            $result['status'] = false;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getCompanyMemberInfo($request_id): array
    {
        try {
            $sql = "SELECT
                        cm.*, mi.*
                    FROM
                        " . $this->tbl_company_members . " AS cm
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        cm.`member_id` = mi.`userid`
                    WHERE 
                         cm.`company_id` = :company_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $result[] = $firstname . ' ' . $lastname . '<br>';
                }
            } else {
                $result[] = 'No members found';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getCompanyContractInfo($request_id): array
    {
        try {
            $sql = "SELECT
                        company_contracts.*, contracts.*,companies.*
                    FROM
                        " . $this->tbl_company_contracts . " AS company_contracts
                    INNER JOIN " . $this->tbl_contracts . " AS contracts
                    INNER JOIN " . $this->tbl_companies . " AS companies
                    ON
                         company_contracts.`contract_id` = contracts.`contract_id` AND company_contracts.`company_id` = companies.`company_id`
                    WHERE 
                         company_contracts.`company_id` = :company_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $contract_no = $row['contract_no'];
                    $current_flow = $row['current_flow'];
                    $load_type = $row['load_type'];

                    if ($row['mainKW'] == 'N/A') {
                        $mainKW = '';
                    } else {
                        $mainKW = $row['mainKW'] . 'kW';
                    }
                    if ($row['mainKVA'] == 'N/A') {
                        $mainKVA = '';
                    } else {
                        $mainKVA = $row['mainKVA'] . 'kVA';
                    }
                    foreach ($row as $key => $value) {
                        $row[$key] = str_replace('N/A', '', $value);
                    }
                    $result[] = 'C' . $contract_no . ' ' . $mainKW . ' ' . $mainKVA . ' ' . $current_flow . ' ' . $load_type . '<br>';
                }
            } else {
                $result[] = 'No assets found';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAllCustomers($member_type, $columns): array
    {
        try {

            $sql = "SELECT
                        c.*,m.*,mi.*,cm.`company_id`
                    FROM
                        " . $this->tbl_members . " AS m
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_company_members . " AS cm
                    INNER JOIN " . $this->tbl_companies . " AS c
                    ON
                        m.`id` = mi.`userid` AND m.`id` = cm.`member_id` AND c.`company_id` = cm.`company_id`
                    WHERE 
                         m.`member_type` = :member_type";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return array(
                "data" => MiscFunctions::data_output($columns, $data)
            );
        } catch (\PDOException $e) {
            http_response_code(500);
            return ["Error" => $e->getMessage()];
        }
    }

    public function getAllClients($member_type, $columns): array
    {
        try {

            $sql = "SELECT
                        m.*, mi.*
                    FROM
                        " . $this->tbl_members . " AS m
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        m.`id` = mi.`userid`
                    WHERE 
                         m.`member_type` = :member_type";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return array(
                "data" => MiscFunctions::data_output($columns, $data)
            );
        } catch (\PDOException $e) {
            http_response_code(500);
            return ["Error" => $e->getMessage()];
        }
    }

    public function getCustomerInfo($member_type, $request_id)
    {
        try {

            $sql = "SELECT
                        c.*,m.*,mi.*,cm.`company_id`
                    FROM
                        " . $this->tbl_members . " AS m
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_company_members . " AS cm
                    INNER JOIN " . $this->tbl_companies . " AS c
                    ON
                        m.`id` = mi.`userid` AND m.`id` = cm.`member_id` AND c.`company_id` = cm.`company_id`
                    WHERE 
                         m.`member_type` = :member_type AND m.`id` = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->bindParam(':id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $result = $row;
                }
            } else {
                $result = [];
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getClientInfo($member_type, $request_id)
    {
        try {

            $sql = "SELECT
                        m.*, mi.*
                    FROM
                        " . $this->tbl_members . " AS m
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        m.`id` = mi.`userid`
                    WHERE 
                         m.`member_type` = :member_type AND m.`id` = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->bindParam(':id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $result = $row;
                }
            } else {
                $result = [];
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getCustomerAssetInfo($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        am.contract_id, a.*
                    FROM
                        " . $this->tbl_contract_members . " am
                    INNER JOIN " . $this->tbl_contracts . " a ON
                        am.contract_id = a.contract_id
                    WHERE
                        am.member_id = :member_id
                    ORDER BY a.contract_no ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $contract_no = $row['contract_no'];
                    $current_flow = $row['current_flow'];
                    $load_type = $row['load_type'];

                    if ($row['mainKW'] == 'N/A') {
                        $mainKW = '';
                    } else {
                        $mainKW = $row['mainKW'] . 'kW';
                    }
                    if ($row['mainKVA'] == 'N/A') {
                        $mainKVA = '';
                    } else {
                        $mainKVA = $row['mainKVA'] . 'kVA';
                    }
                    foreach ($row as $key => $value) {
                        $row[$key] = str_replace('N/A', '', $value);
                    }
                    $result[] = 'C' . $contract_no . ' ' . $mainKW . ' ' . $mainKVA . ' ' . $current_flow . ' ' . $load_type . '<br>';
                }
            } else {
                $result[] = 'No contracts found';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function editCustomerInfo($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_member_info . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `userid` = :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userid', $request_id);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function editClientEmail($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_members . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `id` = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $request_id);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function updateCustomerAC($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_company_members . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `member_id` = :member_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $request_id);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public static function createUser(array $userArr, $user_type)
    {
        try {
            $db = new DbConn;
            $default_dept = UserHandler::getDefaultDepartment();
            $default_role = RoleHandler::getDefaultRole();

            foreach ($userArr as $user) {

                // encrypt password
                $pw = PasswordHandler::encryptPw($user['pw']);

                // prepare sql and bind parameters
                switch (strtolower($user_type)) {
                    case 'intermediary':
                    case 'customer':
                        $role = $default_role;
                        break;
                    case 'staff':
                        $role = $user['staff_role'];
                        break;
                    default:
                        $role = $default_role;
                }
                $stmt = $db->conn->prepare("
                    INSERT INTO " . $db->tbl_members . " (id, member_type, username, password, email) VALUES (:id, :member_type, :username, :password, :email);
                    INSERT INTO " . $db->tbl_member_info . " (userid, firstname, lastname) VALUES (:id, :firstname, :lastname);
                    INSERT INTO " . $db->tbl_member_departments . " (member_id, department_id) VALUES (:id, :department_id);
                    INSERT INTO " . $db->tbl_member_roles . " (member_id, role_id) VALUES (:id, :role_id);
                ");
                $stmt->bindParam(':id', $user['id']);
                $stmt->bindParam(':member_type', $user_type);
                $stmt->bindParam(':username', $user['username']);
                $stmt->bindParam(':email', $user['email']);
                $stmt->bindParam(':password', $pw);
                $stmt->bindParam(':firstname', $user['firstname']);
                $stmt->bindParam(':lastname', $user['lastname']);
                $stmt->bindParam(':department_id', $default_dept);
                $stmt->bindParam(':role_id', $role);
                $stmt->execute();

                if ($user_type == 'customer') {
                    $stmt = $db->conn->prepare("
                    INSERT INTO " . $db->tbl_company_members . " (member_id, company_id) VALUES (:id, :company_id);
                ");
                    $stmt->bindParam(':id', $user['id']);
                    $stmt->bindParam(':company_id', $user['company']);
                    $stmt->execute();
                }
                unset($stmt);
            }
        } catch (\PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }
        //Determines returned value ('true' or error code)
        if (!isset($err)) {
            $resp = true;
        } else {
            $resp = $err;
        };

        return $resp;
    }

    public static function createUserSelfServered(array $userarr)
    {
        try {
            $db = new DbConn;
            $default_role = RoleHandler::getDefaultRole();

            foreach ($userarr as $user) {

                // encrypt password
                $pw = PasswordHandler::encryptPw($user['pw']);

                // prepare sql and bind parameters
                $stmt = $db->conn->prepare("
                    INSERT INTO " . $db->tbl_members . " (id, username, password, email) VALUES (:id, :username, :password, :email);
                    INSERT INTO " . $db->tbl_member_roles . " (member_id, role_id) VALUES (:id, :role_id);
                ");
                $stmt->bindParam(':id', $user['id']);
                $stmt->bindParam(':username', $user['username']);
                $stmt->bindParam(':email', $user['email']);
                $stmt->bindParam(':password', $pw);
                $stmt->bindParam(':role_id', $default_role);
                $stmt->execute();
                unset($stmt);
            }
        } catch (\PDOException $e) {
            $err = "Error: " . $e->getMessage();
        }
        //Determines returned value ('true' or error code)
        if (!isset($err)) {
            $resp = true;
        } else {
            $resp = $err;
        };

        return $resp;
    }

    /**
     * Deletes user by `$userid`
     *
     * @param string $userid User ID
     *
     * @return mixed
     */
    public static function deleteUser(string $userid)
    {
        try {
            $ddb = new DbConn;
            $tbl_members = $ddb->tbl_members;
            $derr = '';

            $dstmt = $ddb->conn->prepare('delete from ' . $tbl_members . ' WHERE id = :uid');
            $dstmt->bindParam(':uid', $userid);
            $dstmt->execute();
        } catch (\PDOException $d) {
            $derr = 'Error: ' . $d->getMessage();
        }

        $resp = ($derr == '') ? true : $derr;

        return $resp;
    }

    /**
     * Verifies user
     *
     * @param array $userarr Array of User IDs
     * @param bool $verify If user is verified
     *
     * @return array
     */
    public static function verifyUser(array $userarr, bool $verify)
    {
        try {
            $idset = [];

            foreach ($userarr as $user) {
                array_push($idset, $user['id']);
            }

            if (count($idset) > 0) {
                $in = str_repeat('?,', count($idset) - 1) . '?';

                $vdb = new DbConn;
                $tbl_members = $vdb->tbl_members;

                // prepare sql and bind parameters
                $vstmt = $vdb->conn->prepare("UPDATE " . $tbl_members . " SET verified = " . $verify . " WHERE id in ($in)");
                $vstmt->execute($idset);

                $vresp['status'] = true;
                $vresp['message'] = '';
            } else {
                $vresp['status'] = false;
                $vresp['message'] = 'User(s) not found';
            }
        } catch (\PDOException $v) {
            $vresp['status'] = false;
            $vresp['message'] = 'Error: ' . $v->getMessage();
        }

        return $vresp;
    }

    /**
     * Bans user by `$user_id` for number of `$ban_hours`
     *
     * @param string $user_id User ID
     * @param integer $ban_hours Hours to ban user for
     * @param  [type]  $reason    Reason for banning user
     *
     * @return mixed
     */
    public static function banUser(string $user_id, float $ban_hours = 0, string $reason = null)
    {
        try {
            $db = new DbConn;
            $err = null;
            //$curr_timestamp = date("Y-m-d H:i:s");

            $stmt = $db->conn->prepare('
              UPDATE ' . $db->tbl_members . ' SET banned = 1 WHERE id = :user_id;
              INSERT INTO ' . $db->tbl_member_jail . ' (user_id, banned_hours, reason) VALUES (:user_id, :banned_hours, :reason);
            ');

            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':banned_hours', $ban_hours);
            $stmt->bindParam(':reason', $reason);
            //$stmt->bindParam(':timestamp', $curr_timestamp);
            $stmt->execute();
        } catch (\PDOException $e) {
            $err = 'Error: ' . $e->getMessage();
        }

        $resp = ($err == null) ? true : $err;

        return $resp;
    }

    /**
     * Pulls user by email address
     *
     * @param string $email Email address
     *
     * @return array
     */
    public static function pullUserByEmail(string $email)
    {
        $db = new DbConn;
        $tbl_members = $db->tbl_members;
        $result = array();

        try {
            $sql = "SELECT id, email, username FROM " . $tbl_members . " WHERE email = :email LIMIT 1";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }

        return $result;
    }

    /**
     * Pulls user by ID
     *
     * @param string $id User ID
     *
     * @return array
     */
    public static function pullUserById($id)
    {
        $db = new DbConn;
        $tbl_members = $db->tbl_members;
        $result = array();

        try {
            $sql = "SELECT id, email, username FROM " . $tbl_members . " WHERE id = :id LIMIT 1";
            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $result = "Error: " . $e->getMessage();
        }

        return $result;
    }
}
