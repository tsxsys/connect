<?php
/**
 * Connect\ProfileData extends DbConn
 */

namespace Connect;

/**
 * User profile data functions
 *
 * Handles user profile data in member_info table
 */
class ProfileData extends DbConn
{
    /**
     * Pulls fields from `member_info` table for a given user
     *
     * @param string $user_id User ID
     * @param array $fieldarr Array of fields to return
     *
     * @return array
     */
    public static function pullUserFields(string $user_id, array $fieldarr): array
    {
        $fields = implode(", ", $fieldarr);

        try {
            //Pull specific user data
            $db = new DbConn;
            $tbl_member_info = $db->tbl_member_info;

            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("SELECT $fields from $tbl_member_info
                                        WHERE userid = :userid");
            $stmt->bindParam(':userid', $user_id);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            $result['status'] = true;
            return $result;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
    }

    /**
     * Pulls all user profile data
     *
     * @param string $user_id User ID
     *
     * @return array User profile data array
     */
    public static function pullAllUserInfo(string $user_id): array
    {
        try {
            //Pull user info into edit form
            $db = new DbConn;
            $tbl_member_info = $db->tbl_member_info;

            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("SELECT FirstName, LastName, Phone, address_line_1,
                                    address_line_2, City, State, Country, Bio, UserImage
                                    from $tbl_member_info WHERE userid = :userid");
            $stmt->bindParam(':userid', $user_id);
            $stmt->execute();

            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 0) {
                $result = array('FirstName' => null, 'LastName' => null, 'Phone' => null,
                    'address_line_1' => null, 'address_line_2' => null, 'City' => null,
                    'State' => null, 'Country' => null, 'Bio' => null, 'UserImage' => null);
            }
            $result['status'] = true;
            return $result;
        } catch (\Exception $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    /**
     * Upserts user profile data
     *
     * @param string $user_id User ID
     * @param array $dataarray New user profile data
     *
     * @return mixed
     */
    public static function upsertUserInfo(string $user_id, array $dataarray)
    {
        try {
            //Upsert user data
            $db = new DbConn;
            $tbl_member_info = $db->tbl_member_info;

            $columnString = implode(',', array_keys($dataarray));
            $valueString = implode(',', array_fill(0, count($dataarray), '?'));

            $insdata = implode('\', \'', $dataarray);

            foreach ($dataarray as $key => $value) {
                if (isset($updata)) {
                    $updata = $updata . $key . ' = ' . $db->conn->quote($value) . ', ';
                } else {
                    $updata = $key . ' = ' . $db->conn->quote($value) . ', ';
                }
            }

            $updata = rtrim($updata, ", ");

            // prepare sql and bind parameters
            $stmt = $db->conn->prepare("INSERT INTO " . $tbl_member_info . " (userid, {$columnString})
                                    values ('$user_id', {$valueString}) ON DUPLICATE KEY UPDATE $updata");

            $result['action'] = $stmt->execute(array_values($dataarray));


            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function getAllUserInfo1(string $user_id)
    {
        try {
            $db = new DbConn;
            $sql = "SELECT
                        d.`dept_name`, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $db->tbl_member_info . " AS mi
                    INNER JOIN " . $db->tbl_departments . " AS d
                    INNER JOIN " . $db->tbl_member_departments . " md 
                    ON
                        md.`member_id` = mi.`userid` AND md.`department_id` = d.`dept_id`
                    WHERE mi.`userid` = :userid";

            $stmt = $db->conn->prepare($sql);
            $stmt->bindParam(':userid', $user_id);
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
}
