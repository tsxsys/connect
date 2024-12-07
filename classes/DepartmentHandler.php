<?php
/**
 * Connect\DepartmentHandler extends DbConn
 */

namespace Connect;

/**
 * Handles department functionality
 *
 * Various methods related departments and their related users
 */
class DepartmentHandler extends DbConn
{
    /**
     * Imports Department Trait
     * Includes `checkDepartment` function
     * @var DepartmentTrait
     */
    use Traits\DepartmentTrait;

    public function getDepartmentCount()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_departments;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getMemberCount()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_members;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getRoleCount()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_departments;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getPermissionCount()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_permissions;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * Returns department name by id
     *
     * @param string $department_id Department ID
     *
     * @return bool
     */

    public function getDepartmentName(string $department_id): bool
    {
        try {
            $sql = "SELECT `dept_name` FROM " . $this->tbl_departments . " WHERE `dept_id` = :dept_id LIMIT 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dept_id', $department_id);
            $stmt->execute();
            $result = $stmt->fetchColumn();

            if ($result) {
                $return = true;
            } else {
                $return = false;
            }
        } catch (\PDOException $e) {
            $return = false;
        }

        return $return;
    }

    /**
     * Returns the default department for new user creation
     *
     * @return int
     */
    public static function getDefaultDepartment(): int
    {
        $db = new DbConn;
        $sql = "SELECT id FROM " . $db->tbl_departments . "
                    WHERE default_department = 1";

        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return $result;
    }

    /**
     * Returns all departments
     *
     * @return array
     */
    public function listAllDepartments(): array
    {
        try {
            $sql = "SELECT DISTINCT id, name, description, default_department
                    FROM " . $this->tbl_departments . " WHERE name != 'Superadmin'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    /**
     * Returns data of given department
     *
     * @param string $department_id Department ID
     *
     * @return array
     */
    public function getDepartmentData(string $department_id): array
    {
        try {
            $sql = "SELECT DISTINCT dept_id, dept_name, dept_head, required
                      FROM " . $this->tbl_departments . " WHERE dept_id = :dept_id LIMIT 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dept_id', $department_id);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * Returns user's department
     *
     *
     */
    public function getUserDept()
    {
        try {
            $this_user = $_SESSION['uid'];
            $sql = "SELECT `department_id` FROM " . $this->tbl_member_departments . " WHERE `member_id` = :member_id LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $this_user);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $result = $row['department_id'];
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * Returns all active users
     *
     * @return array
     */
    public function listAllActiveUsers(): array
    {
        try {
            $sql = "SELECT DISTINCT id, username
                    FROM " . $this->tbl_members . " where verified = 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    /**
     * Returns departments by list of IDs
     *
     * @param string $ids JSON string of department IDs
     *
     * @return array
     */
    public function listSelectedDepartments(string $ids)
    {
        $idset = json_decode($ids);
        $result = array();

        try {
            $in = str_repeat('?,', count($idset) - 1) . '?';

            $sql = "SELECT `dept_id` FROM " . $this->tbl_departments . " WHERE `required` != 1 AND `dept_id` IN ($in)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($idset);

            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = "Error: " . $e->getMessage();
        }
        return $result;
    }

    /**
     * Returns all users of a given $department_id
     *
     * @param string $department_id Department ID
     *
     * @return array
     */
    public function listDepartmentUsers(string $department_id): array
    {
        try {
            $sql = "SELECT m.id, m.username FROM " . $this->tbl_member_departments . " md
                    INNER JOIN " . $this->tbl_departments . " d on md.department_id = d.dept_id
                    INNER JOIN " . $this->tbl_members . " m on md.member_id = m.id
                    WHERE d.dept_id = :department_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':department_id', $department_id);

            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            http_response_code(500);
            $return = ["Error" => $e->getMessage()];
            return $return;
        }
    }

    public function getDepartmentHead(string $department_id): array
    {
        try {
            $sql = "SELECT m.id, m.username FROM " . $this->tbl_members . " m
                    INNER JOIN " . $this->tbl_departments . " d on d.dept_head = m.id
                    WHERE d.dept_id = :department_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':department_id', $department_id);

            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $result;
        } catch (\PDOException $e) {
            http_response_code(500);
            $return = ["Error" => $e->getMessage()];
            return $return;
        }
    }

    /**
     * Returns all users of a given $department_id
     *
     * @param array $users Array of user IDs
     * @param string $department_id Department ID
     *
     * @return bool
     */
    public function updateDepartmentUsers(array $users, string $department_id): bool
    {
        try {
            $this->conn->beginTransaction();

            $sqldel = "DELETE FROM {$this->tbl_member_departments} where department_id = :department_id";

            $stmtdel = $this->conn->prepare($sqldel);
            $stmtdel->bindParam(':department_id', $department_id);
            $stmtdel->execute();

            if (!empty($users)) {
                $chunks = MiscFunctions::placeholders($users, ",", $department_id);

                $sql = "REPLACE INTO {$this->tbl_member_departments}
                          (member_id, department_id)
                          VALUES $chunks";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
            }

            $this->conn->commit();

            return true;
        } catch (\PDOException $e) {
            $this->conn->rollback();
            http_response_code(500);
            error_log($e->getMessage());
            $return = false;
        }

        return $return;
    }

    public function updateDepartmentHead(string $dept_head, $dept_id): bool
    {
        try {
           $sql = "UPDATE " . $this->tbl_departments . " SET `dept_head` = :dept_head
                    WHERE `dept_id` = :dept_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dept_head', $dept_head);
            $stmt->bindParam(':dept_id', $dept_id);
            $stmt->execute();
            $return = true;
        } catch (\PDOException $e) {
            $this->conn->rollback();
            http_response_code(500);
            error_log($e->getMessage());
            $return = false;
        }

        return $return;
    }


    /**
     * Returns all departments of a given $user_id
     *
     * @param string $user_id User ID
     *
     * @return array
     */
    public function listUserDepartments(string $user_id): array
    {
        try {
            $sql = "SELECT r.id, r.name FROM " . $this->tbl_member_departments . " mr
                  INNER JOIN " . $this->tbl_departments . " r on mr.department_id = r.id
                  INNER JOIN " . $this->tbl_members . " m on mr.member_id = m.id
                  WHERE m.id = :member_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $user_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }

        return $return;
    }

    /**
     * Creates new department
     *
     * @param string $department_name Department name
     * @param string $department_desc Department description
     * @param boolean $default Default department
     *
     * @return bool
     */
    public function createDepartment(string $department_name, $default = false): bool
    {
        try {
            $sql = "INSERT INTO " . $this->tbl_departments . " (dept_name) values (:department_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':department_name', $department_name);
            $stmt->execute();

            $return = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            error_log($e->getMessage());
            $return = false;
        }

        return $return;
    }

    /**
     * Updates department
     *
     * @param string $department_id Department ID
     * @param string $department_name Department Name
     * @param boolean $default Default department
     *
     * @return bool
     */
    public function updateDepartment(string $department_id, string $department_name, $default = null): bool
    {
        try {
            $sql = "UPDATE " . $this->tbl_departments . " SET `dept_name` = :dept_name
                    WHERE dept_id = :dept_id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':dept_id', $department_id);
            $stmt->bindParam(':dept_name', $department_name);
            $stmt->execute();

            $return = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            error_log($e->getMessage());
            $return = false;
        }

        return $return;
    }


    /**
     * Deletes department
     *
     * @param string $department_id Department ID
     *
     * @return bool
     */
    public function deleteDepartment(string $department_id): bool
    {
        try {
            $sql = "DELETE FROM " . $this->tbl_departments . " WHERE dept_id = :dept_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dept_id', $department_id);
            $stmt->execute();

            $return = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            error_log($e->getMessage());
            $return = false;
        }
        return $return;
    }

    /**
     * Assigns department to a user
     *
     * @param string $department_id Department ID
     * @param string $user_id User ID
     *
     * @return bool
     */
    public function assignDepartment(string $department_id, string $user_id): bool
    {
        try {
            $sql = "REPLACE INTO " . $this->tbl_member_departments . "
                    (member_id, department_id) values (:member_id, :department_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $user_id);
            $stmt->bindParam(':department_id', $department_id);
            $stmt->execute();

            $return = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            error_log($e->getMessage());
            $return = false;
        }

        return $return;
    }

    /**
     * Unassigns all departments from a user
     *
     * @param string $user_id User ID
     *
     * @return bool
     */
    public function unassignAllDepartments(string $user_id): bool
    {
        try {
            $sql = "DELETE FROM " . $this->tbl_member_departments . "
                    WHERE member_id = :member_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $user_id);
            $stmt->execute();

            $return = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            $return = false;
        }

        return $return;
    }
}
