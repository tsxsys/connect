<?php
/**
 * Connect\Chat extends DbConn
 */

namespace Connect;

/**
 * Chat data functions
 *
 * Handles the chat system in chat table
 */
class Contact extends DbConn
{
    public function getAllUsers(): array
    {
        try {
            $this_user = $_SESSION['uid'];
            $sql = "SELECT
                        d.dept_name,
                        mi.userid, mi.`firstname`, mi.`lastname`, mi.`user_image`                      
                    FROM
                        " . $this->tbl_departments . " AS d
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        mi.`department` = d.`dept_id`
                    WHERE 
                        userid != :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userid', $this_user);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                $output = array();
                $var = array();
                foreach ($result as $row) {
//                    while($row = $stmt->fetch_row()){
                    $var['this_user'] = $this_user;
                    $var['contact_id'] = $row['userid'];
                    $var['firstname'] = $row['firstname'];
                    $var['lastname'] = $row['lastname'];
                    $var['department'] = $row['dept_name'];
                    $var['user_image'] = $row['user_image'];

                    array_push($output, $var);
                }
            }
            return $output;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }


    public function getAllPhoneNumbers($columns): array
    {
        try {
            $sql = "SELECT
                        d.`dept_name`, 
                        mi.`userid`,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`,mi.`phone`, mi.`phone_ext`
                    FROM
                        " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_departments . " AS d
                    INNER JOIN " . $this->tbl_member_departments . " md 
                    ON
                        md.`member_id` = mi.`userid` AND md.`department_id` = d.`dept_id`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $return_data = array(
                "data" => MiscFunctions::data_output($columns, $data)
            );

            return $return_data;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getAllContactDetails(): array
    {
        try {
            $this_user = $_SESSION['uid'];
            $sql = "SELECT
                        d.`dept_name`, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_departments . " AS d
                    INNER JOIN " . $this->tbl_member_departments . " md 
                    ON
                        md.`member_id` = mi.`userid` AND md.`department_id` = d.`dept_id`
                    WHERE 
                        mi.`userid` != :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userid', $this_user);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $output[] = $row;
                }
            } else {
                $output = [];
            }
            return $output;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getSearchedUsers($searched): array
    {
        try {
            $searched = '%' . $searched . '%';
            $this_user = $_SESSION['uid'];
            $sql = "SELECT
                        d.`dept_name`, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_departments . " AS d
                    INNER JOIN " . $this->tbl_member_departments . " md 
                    ON
                        md.`member_id` = mi.`userid` AND md.`department_id` = d.`dept_id`
                    WHERE 
                        (mi.`firstname` LIKE :searched OR mi.`lastname` LIKE :searched) AND mi.`userid` != :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':searched', $searched);
            $stmt->bindParam(':userid', $this_user);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $output[] = $row;
                }
            } else {
                $output = [];
            }
            return $output;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getAllUserInfo($user_id): array
    {
        try {
//            $user_id = $_SESSION['uid'];

            $sql = "SELECT
                        d.`dept_name`, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_departments . " AS d
                    INNER JOIN " . $this->tbl_member_departments . " md 
                    ON
                        md.`member_id` = mi.`userid` AND md.`department_id` = d.`dept_id`
                    WHERE 
                        userid = :userid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':userid', $user_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }
}


