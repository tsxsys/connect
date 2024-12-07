<?php
/**
* Connect\Traits\RoleTrait
*/
namespace Connect\Traits;

/**
 * Re-usable role functionality
 */
trait DepartmentTrait
{
    /**
    * Checks if user has specified role by name
    *
    * @param string $user_id User ID
    * @param string $dept_name Role Name
    *
    * @return boolean
    */
    public function checkDepartment($user_id, $dept_name): bool
    {
        try {
            $sql = "SELECT md.id FROM ".$this->tbl_member_departments." md
                    INNER JOIN ".$this->tbl_departments." d on md.department_id = d.dept_id
                    WHERE md.member_id = :member_id
                    AND d.dept_name = :dept_name LIMIT 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $user_id);
            $stmt->bindParam(':dept_name', $dept_name);
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

    public function checkDepartmentHead($user_id): bool
    {
        try {
            $sql = "SELECT dept_head FROM ".$this->tbl_departments." WHERE dept_head = :dept_head";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':dept_head', $user_id);
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
}
