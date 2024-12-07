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
class Chat extends DbConn
{
//    public function getAllUsers(): array
//    {
//        try {
//            $this_user = $_SESSION['uid'];
//            $sql = "SELECT
//                        d.dept_name,
//                        mi.userid, mi.`firstname`, mi.`lastname`, mi.`user_image`
//                    FROM
//                        " . $this->tbl_departments . " AS d
//                    INNER JOIN " . $this->tbl_member_info . " AS mi
//                    ON
//                        mi.`department` = d.`dept_id`
//                    WHERE
//                        userid != :userid";
//            $stmt = $this->conn->prepare($sql);
//            $stmt->bindParam(':userid', $this_user);
//            $stmt->execute();
//            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//
//            if ($stmt->rowCount()) {
//                $output = array();
//                $var = array();
//                foreach ($result as $row) {
////                    while($row = $stmt->fetch_row()){
//                    $var['this_user'] = $this_user;
//                    $var['contact_id'] = $row['userid'];
//                    $var['firstname'] = $row['firstname'];
//                    $var['lastname'] = $row['lastname'];
//                    $var['department'] = $row['dept_name'];
//                    $var['user_image'] = $row['user_image'];
//
//                    array_push($output, $var);
//                }
//            }
//            return $output;
//        } catch (\PDOException $e) {
//            $result['status'] = false;
//            $result['message'] = $e->getMessage();
//            return $result;
//        }
//    }
    public function getAllUsers(): array
    {
        try {
            $user_id = $_SESSION['uid'];

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
                        userid != :userid";
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
    public function lunchChat(): array
    {
        try {
            $this_user = $_SESSION['uid'];
            $sql = "SELECT * FROM " . $this->tbl_chat . " WHERE `msg_from` = :msg_from OR `msg_to` = :msg_from";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':msg_from', $this_user);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $result['status'] = true;
            } else {
                $result['status'] = false;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }
    public function getAllChat(): array
    {
        try {
            $this_user = $_SESSION['uid'];
            $sql = "SELECT  
                        MAX(c.`msg`) AS latest_msg,MAX(c.`msg_time`) AS latest_msg_time,
                        c.`msg_to`,
                        mi2.`firstname` AS recipient_firstname,
                        mi2.`lastname` AS recipient_lastname,
                        mi2.`user_image` AS recipient_user_image
                    FROM
                        " . $this->tbl_chat . " AS c
                    INNER JOIN " . $this->tbl_member_info . " AS mi2 
                    ON
                        c.`msg_to` = mi2.`userid`
                    WHERE
                      `msg_from` = :msg_from 
                    GROUP BY
                        mi2.`userid`
                    ORDER BY 
                      c.`msg_time` DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':msg_from', $this_user);
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

    public function getChatHistory($recipient)
    {
        $this_user = $_SESSION['uid'];
        try {
            $sql = "SELECT
                        c.*,
                        mi1.`firstname` AS sender_firstname,
                        mi1.`lastname` AS sender_lastname,
                        mi1.`user_image` AS sender_user_image
                    FROM
                        " . $this->tbl_chat . " AS c
                    INNER JOIN " . $this->tbl_member_info . " AS mi1 
                    ON
                        c.`msg_from` = mi1.`userid`
                    INNER JOIN " . $this->tbl_member_info . " AS mi2 
                    ON
                        c.`msg_to` = mi2.`userid`
                    WHERE
                       (`msg_from` = :msg_from AND `msg_to` = :msg_to)
                     OR
                        (`msg_from` = :msg_to AND `msg_to` = :msg_from)
                    ORDER BY msg_time ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':msg_from', $this_user);
            $stmt->bindParam(':msg_to', $recipient);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $appConfig = AppConfig::pullMultiSettings(array("base_url", "avatar_dir"));
                foreach ($result as $row) {
                    $msg_from = $row['msg_from'];
                    $full_name_from = $row['sender_firstname'] . ' ' . $row['sender_lastname'];
                    $msg = $row['msg'];
                    $msg_time = $row['msg_time'];
                    $sender_user_image = $row['sender_user_image'];
                    $avatar_dir = $appConfig["base_url"] . $appConfig["avatar_dir"];
                    if (empty($sender_user_image)) {
                        $user_image = $avatar_dir . "/default_avatar.jpg";
                    } else {
                        $user_image = $avatar_dir . "/" . $sender_user_image;
                        if (@get_headers($user_image)[0] == 'HTTP/1.1 404 Not Found') {
                            $user_image = $avatar_dir . "/default_avatar.jpg";
                        }
                    }
                    $output = '';
                    if ($msg_from == $this_user) {
                        $output = '<li class="sent">
                                        <img src="' . $user_image . '" alt=""/>
                                        <p> ' . $msg . '</p>
                                    </li>';
                    } elseif ($msg_from == $recipient) {
                        $output = '<li class="received">
                                        <img src="' . $user_image . '" alt=""/>
                                        <p> ' . $msg . '</p>
                                    </li>';
                    }
                    echo $output;
                }

            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function getNotificationsBadge()
    {
        try {
            $this_user = $_SESSION['uid'];
            $unread_status = 0;
            $sql = "SELECT * FROM " . $this->tbl_chat . " WHERE `msg_to` = :msg_to AND `msg_status` = :msg_status";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':msg_to', $this_user);
            $stmt->bindParam(':msg_status', $unread_status);
            $stmt->execute();
//            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $result['count_unread'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getNotifications()
    {
        try {
            $this_user = $_SESSION['uid'];
            $unread_status = 0;
            $sql = "SELECT
                        c.*,
                        mi.userid, mi.`firstname`, mi.`lastname`, mi.`user_image`                      
                    FROM
                        " . $this->tbl_chat . " AS c
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        c.`msg_from` = mi.`userid`
                    WHERE 
                        `msg_to` = :msg_to AND `msg_status` = :msg_status";
//            $sql = "SELECT * FROM " . $this->tbl_chat . " WHERE `msg_to` = :msg_to AND `msg_status` = :msg_status";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':msg_to', $this_user);
            $stmt->bindParam(':msg_status', $unread_status);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//            $result['count_unread'] = $stmt->rowCount();

            $output = array();
            $var = array();

            if ($stmt->rowCount()) {
                foreach ($result as $row) {
                    $var['contact_id'] = $row['userid'];
                    $var['full_name'] = $row['firstname'] . ' ' . $row['lastname'];
                    $var['msg_preview'] = substr($row['msg'], 0, 20);
                    $var['msg_time'] = $row['msg_time'];
                    if (!empty($row['user_image'])) {
                        $var['user_image'] = $row['user_image'];
                    } else {
                        $var['user_image'] = '' . ASSETS_URL . 'img/user8-128x128.jpg';
                    }
                    array_push($output, $var);
                }
            }
            return $output;
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function sendMsg(array $postArr)
    {
        $date_added = date('Y-m-d H:i:s');
        $this_user = $_SESSION['uid'];
        $postArr = array_merge($postArr, array("msg_from" => $this_user, "msg_time" => $date_added));

        $columns = implode(',', array_keys($postArr));
        $values = implode(',', array_fill(0, count($postArr), '?'));

        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_chat . " ({$columns})
                                    values ({$values})");

            $result['status'] = $stmt->execute(array_values($postArr));
            $result['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes Saved Successfully</div>";
            $output = 1;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
            $output = 0;
        }
        echo $output;
    }

    public function test($columns): array
    {
        $bindings = array();

        try {
            $sql = "SELECT * FROM " . $this->tbl_noticeboard;

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


}


