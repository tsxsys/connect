<?php
/**
 * Connect\Post extends DbConn
 */

namespace Connect;


class Post extends DbConn
{

    /**
     * Noticeboard functions
     *
     * Handles noticeboard data in noticeboard table
     */
    public function getNoticeboardInfo($post_id, $post_unique_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_noticeboard . " WHERE `announcement_id` = ? AND `unique_id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id, $post_unique_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $noticeboard_row) {
                return $noticeboard_row;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getNoticeboardNextInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_noticeboard . " WHERE `announcement_id` = (SELECT MIN(announcement_id) FROM " . $this->tbl_noticeboard . " WHERE `announcement_id` > ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                foreach ($data as $noticeboard_row) {
                    return $noticeboard_row;
                }
            } else {
                $noticeboard_next = false;
            }
            return $noticeboard_next;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getNoticeboardPrevInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_noticeboard . " WHERE `announcement_id` = (SELECT MAX(announcement_id) FROM " . $this->tbl_noticeboard . " WHERE `announcement_id` < ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $noticeboard_row) {
                    return $noticeboard_row;
                }
            } else {
                $noticeboard_prev = false;
            }
            return $noticeboard_prev;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }


    public function getRecentAnnouncements()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_noticeboard . " WHERE `status` = '1' 
            ORDER BY " . $this->tbl_noticeboard . ".`date_published` DESC LIMIT 5";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($result as $row) {
                    $post_id = $row['announcement_id'];
                    $unique_id = $row['unique_id'];
                    $details = $row['details'];
                    $preview = substr($details, 0, 200);
                    echo '<li class="item">
                        <div class="product-img">
                            <img src="' . ASSETS_URL . 'img/default-150x150.png" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                            <a href="noticeboard.php?t=view&q=' . $post_id . '&qq=' . $unique_id . '" class="product-title">' . $row['title'] . '
                                <span class="badge badge-warning float-right">Notice</span></a>
                            <span class="product-description">' . $preview . '</span>
                        </div>
                    </li>';
                }
            }

        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function getAllAnnouncements1($request, $columns): array
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


    public function setAnnouncement(array $postArray): array
    {
        function generateRandomString($length)
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        }

        $unique_id = generateRandomString(10);
        $date_added = date('Y-m-d H:i:s');
        $add_by = $_SESSION['uid'];
        $postArray = array_merge($postArray, array("unique_id" => $unique_id, 'date_added' => $date_added, 'add_by' => $add_by, 'status' => '1', 'date_published' => $date_added, 'publish_by' => $add_by));

        $columns = implode(',', array_keys($postArray));
        $values = implode(',', array_fill(0, count($postArray), '?'));

        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_noticeboard . " ({$columns})
                                    values ({$values})");

            $result['status'] = $stmt->execute(array_values($postArray));
            $result['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes Saved Successfully</div>";
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function draftAnnouncement(array $postArray): array
    {
        function generateRandomString($length)
        {
            return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
        }

        $unique_id = generateRandomString(10);
        $date_added = date('Y-m-d H:i:s');
        $add_by = $_SESSION['uid'];
        $postArray = array_merge($postArray, array("unique_id" => $unique_id, 'date_added' => $date_added, 'add_by' => $add_by, 'status' => '0'));

        $columns = implode(',', array_keys($postArray));
        $values = implode(',', array_fill(0, count($postArray), '?'));

        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_noticeboard . " ({$columns})
                                    values ({$values})");

            $result['status'] = $stmt->execute(array_values($postArray));
            $result['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes Saved Successfully</div>";
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }


    public function publishAnnouncement(string $post_id, $unique_id, array $postArray): array
    {

        $date_published = date('Y-m-d H:i:s');
        $publish_by = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('date_published' => $date_published, 'publish_by' => $publish_by, 'status' => '1'));

        try {
//            $sql = "UPDATE " . $this->tbl_noticeboard . " SET {$columns} = {$values} WHERE announcement_id = $post_id AND unique_id = $unique_id";
            $sql = "UPDATE " . $this->tbl_noticeboard . " SET ";
            foreach ($postArray as $key => $value) {
//                $sql .= $key . " =  ? , ";
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `announcement_id` = '$post_id' AND `unique_id` = '$unique_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes Saved Successfully</div>";
        } catch (\PDOException $e) {
            $result['status'] = false;
//            $result['message'] = "Error: " . implode(',', array_keys($postArray)) .' '. $sql;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function updateAnnouncement(string $post_id, $unique_id, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $edit_by = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('date_edited' => $date_edited, 'edit_by' => $edit_by));

        try {
//            $sql = "UPDATE " . $this->tbl_noticeboard . " SET {$columns} = {$values} WHERE announcement_id = $post_id AND unique_id = $unique_id";
            $sql = "UPDATE " . $this->tbl_noticeboard . " SET ";
            foreach ($postArray as $key => $value) {
//                $sql .= $key . " =  ? , ";
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `announcement_id` = '$post_id' AND `unique_id` = '$unique_id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['message'] = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes Saved Successfully</div>";
        } catch (\PDOException $e) {
            $result['status'] = false;
//            $result['message'] = "Error: " . implode(',', array_keys($postArray)) .' '. $sql;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }


    /******************************************************
     *** Announcement ***
     *** Announcement functions  ***
     *** Handles announcement data in console ***
     ******************************************************/
    public function getAllDashAnnouncements(): array
    {
        try {

            $sql = "SELECT
                        a.*, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                         " . $this->tbl_announcements . " AS a
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        a.`added_by` = mi.`userid` 
                    ORDER BY `date_added` DESC LIMIT 2";
            $stmt = $this->conn->prepare($sql);
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
            $result['message'] = "Error: " . $e->getMessage();
            return $result;
        }
    }

    public function getAllAnnouncements($request, $columns): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_announcements;

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

    public function getAnnouncementInfo($post_id, $post_unique_id)
    {
        try {
            $sql = "SELECT a.*,
                           mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_announcements . " AS a
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        a.`added_by` = mi.`userid`
                    WHERE `announcement_id` = ? AND `announcement_unique_id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id, $post_unique_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                return $row;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getAnnouncementNextInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_announcements . " WHERE `announcement_id` = (SELECT MIN(announcement_id) FROM " . $this->tbl_announcements . " WHERE `announcement_id` > ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getAnnouncementPrevInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_announcements . " WHERE `announcement_id` = (SELECT MAX(announcement_id) FROM " . $this->tbl_announcements . " WHERE `announcement_id` < ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getAnnouncementCount(): array
    {
        try {
            $status = 0;
            $sql = "SELECT * FROM " . $this->tbl_announcements;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }


    public function postNewAnnouncementPost(array $formInfoArr): array
    {
        $date = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $formInfoArr = array_merge($formInfoArr, array('date_added' => $date, 'added_by' => $operator));

        $formInfoCol = implode(',', array_keys($formInfoArr));
        $formInfoValues = implode(',', array_fill(0, count($formInfoArr), '?'));

//        $result['arr'] = array_values($formInfoArr);
        try {
// prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_announcements . " ({$formInfoCol}) values ({$formInfoValues})");
            $result['action'] = $stmt->execute(array_values($formInfoArr));

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = $result['err_message'] = "Error: " . $e->getMessage();
            error_log($result['err_message']);
        }
        return $result;
    }

    public function editDraftAnnouncementPost(string $post_id, $post_unique_id, $status, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('announcement_status' => $status, 'date_edited' => $date_edited, 'edited_by' => $operator));

        try {
            $sql = "UPDATE " . $this->tbl_announcements . " SET ";
            foreach ($postArray as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `announcement_id` = '$post_id' AND `announcement_unique_id` = '$post_unique_id'";
            $stmt = $this->conn->prepare($sql);
            $result['action'] = $stmt->execute();

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function editLiveAnnouncementPost(string $post_id, $post_unique_id, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('date_edited' => $date_edited, 'edited_by' => $operator));

        try {
            $sql = "UPDATE " . $this->tbl_announcements . " SET ";
            foreach ($postArray as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `announcement_id` = '$post_id' AND `announcement_unique_id` = '$post_unique_id'";
            $stmt = $this->conn->prepare($sql);
            $result['action'] = $stmt->execute();

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    /******************************************************
     *** Events ***
     *** Events functions  ***
     *** Handles events data in console ***
     ******************************************************/
    public function getAllDashEvents($event_kind): array
    {
        try {
            $sql = "SELECT
                        e.*, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_events . " AS e
                    ON
                        e.`added_by` = mi.`userid` 
                    WHERE
                    e.`event_kind` = '$event_kind'
                    ORDER BY `event_date` DESC LIMIT 3";
            $stmt = $this->conn->prepare($sql);
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

    public function getAllEvents($request, $columns): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_events;

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

    public function getEventInfo($post_id, $post_unique_id)
    {
        try {
            $sql = "SELECT e.*,
                           mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_events . " AS e
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        e.`added_by` = mi.`userid`
                    WHERE `event_id` = ? AND `event_unique_id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id, $post_unique_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                return $row;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getEventNextInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_events . " WHERE `event_id` = (SELECT MIN(event_id) FROM " . $this->tbl_events . " WHERE `event_id` > ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getEventPrevInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_events . " WHERE `event_id` = (SELECT MAX(event_id) FROM " . $this->tbl_events . " WHERE `event_id` < ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getEventCount(): array
    {
        try {
            $status = 0;
            $sql = "SELECT * FROM " . $this->tbl_events;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function postNewEventPost(array $formInfoArr): array
    {
        $date = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $formInfoArr = array_merge($formInfoArr, array('date_added' => $date, 'added_by' => $operator));

        $formInfoCol = implode(',', array_keys($formInfoArr));
        $formInfoValues = implode(',', array_fill(0, count($formInfoArr), '?'));

//        $result['arr'] = array_values($formInfoArr);
        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_events . " ({$formInfoCol})
                                    values ({$formInfoValues})");
            $result['action'] = $stmt->execute(array_values($formInfoArr));

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

    public function editDraftEventPost(string $post_id, $post_unique_id, $status, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('event_status' => $status, 'date_edited' => $date_edited, 'edited_by' => $operator));

        try {
            $sql = "UPDATE " . $this->tbl_events . " SET ";
            foreach ($postArray as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `event_id` = '$post_id' AND `event_unique_id` = '$post_unique_id'";
            $stmt = $this->conn->prepare($sql);
            $result['action'] = $stmt->execute();

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function editLiveEventPost(string $post_id, $post_unique_id, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('date_edited' => $date_edited, 'edited_by' => $operator));

        try {
            $sql = "UPDATE " . $this->tbl_events . " SET ";
            foreach ($postArray as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `event_id` = '$post_id' AND `event_unique_id` = '$post_unique_id'";
            $stmt = $this->conn->prepare($sql);
            $result['action'] = $stmt->execute();

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    /******************************************************
     *** News ***
     *** News functions  ***
     *** Handles news data in console ***
     ******************************************************/

    public function getAllDashNews(): array
    {
        try {
//            $event_kind = 'external';
            $sql = "SELECT
                        n.*, 
                        mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_member_info . " AS mi
                    INNER JOIN " . $this->tbl_news . " AS n
                    ON
                        n.`added_by` = mi.`userid` 
                    ORDER BY `date_added` DESC LIMIT 2";
            $stmt = $this->conn->prepare($sql);
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

    public function getAllNews($request, $columns): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_news;

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

    public function getAllNewsPool()
    {
        try {
            $sql = "SELECT n.*,
                           mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_news . " AS n
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        n.`added_by` = mi.`userid`";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $output[] = $row;

            }
            return $output;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getNewsInfo($post_id, $post_unique_id)
    {
        try {
            $sql = "SELECT n.*,
                           mi.*,CONCAT_WS(' ', mi.`firstname`, mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_news . " AS n
                    INNER JOIN " . $this->tbl_member_info . " AS mi
                    ON
                        n.`added_by` = mi.`userid`
                    WHERE `news_id` = ? AND `news_unique_id` = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id, $post_unique_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                return $row;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getNewsNextInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_news . " WHERE `news_id` = (SELECT MIN(news_id) FROM " . $this->tbl_news . " WHERE `news_id` > ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getNewsPrevInfo($post_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_news . " WHERE `news_id` = (SELECT MAX(news_id) FROM " . $this->tbl_news . " WHERE `news_id` < ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$post_id]);
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    return $row;
                }
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
            return $result;
        }
    }

    public function getNewsCount(): array
    {
        try {
            $status = 0;
            $sql = "SELECT * FROM " . $this->tbl_news;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function postNewNewsPost(array $formInfoArr): array
    {
        $date = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $formInfoArr = array_merge($formInfoArr, array('date_added' => $date, 'added_by' => $operator));

        $formInfoCol = implode(',', array_keys($formInfoArr));
        $formInfoValues = implode(',', array_fill(0, count($formInfoArr), '?'));

//        $result['arr'] = array_values($formInfoArr);
        try {
// prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_news . " ({$formInfoCol})
values ({$formInfoValues})");
            $result['action'] = $stmt->execute(array_values($formInfoArr));

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

    public function editDraftNewsPost(string $post_id, $post_unique_id, $status, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('news_status' => $status, 'date_edited' => $date_edited, 'edited_by' => $operator));

        try {
            $sql = "UPDATE " . $this->tbl_news . " SET ";
            foreach ($postArray as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `news_id` = '$post_id' AND `news_unique_id` = '$post_unique_id'";
            $stmt = $this->conn->prepare($sql);
            $result['action'] = $stmt->execute();

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function editLiveNewsPost(string $post_id, $post_unique_id, array $postArray): array
    {

        $date_edited = date('Y-m-d H:i:s');
        $operator = $_SESSION['uid'];
        $postArray = array_merge($postArray, array('date_edited' => $date_edited, 'edited_by' => $operator));

        try {
            $sql = "UPDATE " . $this->tbl_news . " SET ";
            foreach ($postArray as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' '); // first trim last space
            $sql = trim($sql, ','); // then trim trailing and prefixing commas
            $sql .= " WHERE `news_id` = '$post_id' AND `news_unique_id` = '$post_unique_id'";
            $stmt = $this->conn->prepare($sql);
            $result['action'] = $stmt->execute();

            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    /**********************************
     ***  Delete and Restore Posts  ***
     **********************************/
    public function getAllDeletedPosts($request, $columns): array
    {

        try {
            $sql = "SELECT * FROM " . $this->tbl_post_del;

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

    public function getDeletedPostCount(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_post_del;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result['count'] = $stmt->rowCount();
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function deletePost(string $post_id, $post_unique_id, $post_type): array
    {
        try {
            if ($post_type == 'announcement') {
                $sql_archiving = "INSERT INTO " . $this->tbl_post_del . " (`post_id`, `post_unique_id`,`post_title`,`post_details`,`post_img`,`post_status`,`added_by`,`date_added`,`edited_by`,`date_edited`,`published_by`,`date_published`)
            SELECT `announcement_id`, `announcement_unique_id`, `announcement_title`, `announcement_details`, `announcement_img`, `announcement_status`,`added_by`, `date_added`, `edited_by`, `date_edited`, `published_by`,`date_published` 
            FROM " . $this->tbl_announcements . " 
            WHERE `announcement_id` = '$post_id' AND `announcement_unique_id` = '$post_unique_id'";
            }
            if ($post_type == 'event') {
                $sql_archiving = "INSERT INTO " . $this->tbl_post_del . " (`post_id`, `post_unique_id`,`post_kind`,`post_title`,`post_details`,`post_date`,`post_status`,`added_by`,`date_added`,`edited_by`,`date_edited`,`published_by`,`date_published`)
            SELECT `event_id`, `event_unique_id`,`event_kind`, `event_title`, `event_details`, `event_date`, `event_status`,`added_by`, `date_added`, `edited_by`, `date_edited`, `published_by`,`date_published` 
            FROM " . $this->tbl_events . " 
            WHERE `event_id` = '$post_id' AND `event_unique_id` = '$post_unique_id'";
            }
            if ($post_type == 'news') {
                $sql_archiving = "INSERT INTO " . $this->tbl_post_del . " (`post_id`, `post_unique_id`,`post_title`,`post_details`,`post_img`,`post_status`,`added_by`,`date_added`,`edited_by`,`date_edited`,`published_by`,`date_published`)
            SELECT `news_id`, `news_unique_id`, `news_title`, `news_details`, `news_img`, `news_status`,`added_by`, `date_added`, `edited_by`, `date_edited`, `published_by`,`date_published` 
            FROM " . $this->tbl_news . " 
            WHERE `news_id` = '$post_id' AND `news_unique_id` = '$post_unique_id'";
            }


            $stmt = $this->conn->prepare($sql_archiving);
            $stmt->execute();

            $date_deleted = date('Y-m-d H:i:s');
            $deleted_by = $_SESSION['uid'];
            $postArray = array('post_type' => $post_type, 'date_deleted' => $date_deleted, 'deleted_by' => $deleted_by);

            try {
                $sql = "UPDATE " . $this->tbl_post_del . " SET ";
                foreach ($postArray as $key => $value) {
                    if (is_numeric($value))
                        $sql .= $key . " = " . $value . ", ";
                    else
                        $sql .= $key . " = " . "'" . $value . "'" . ", ";
                }

                $sql = trim($sql, ' '); // first trim last space
                $sql = trim($sql, ','); // then trim trailing and prefixing commas
                $sql .= " WHERE `post_id` = '$post_id' AND `post_unique_id` = '$post_unique_id'";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                try {
                    if ($post_type == 'announcement') {
                        $sql_del = "DELETE FROM " . $this->tbl_announcements . " 
                    WHERE `announcement_id` = '$post_id' AND `announcement_unique_id` = '$post_unique_id'";
                    }
                    if ($post_type == 'event') {
                        $sql_del = "DELETE FROM " . $this->tbl_events . " 
                    WHERE `event_id` = '$post_id' AND `event_unique_id` = '$post_unique_id'";
                    }
                    if ($post_type == 'news') {
                        $sql_del = "DELETE FROM " . $this->tbl_news . " 
                    WHERE `news_id` = '$post_id' AND `news_unique_id` = '$post_unique_id'";
                    }
                    $stmt = $this->conn->prepare($sql_del);
                    $stmt->execute();
                    $result['stat'] = 'success';
                    $result['message'] = '<div class="toast-message">Request completed successfully</div>';
                } catch (\PDOException $e) {
                    $result['status'] = false;
                    $result['stat'] = 'error';
                    $result['message'] = "Error: " . $e->getMessage();
                }
            } catch (\PDOException $e) {
                $result['status'] = false;
                $result['stat'] = 'error';
                $result['message'] = "Error: " . $e->getMessage();
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function restorePost(string $post_id, $post_unique_id, $post_type): array
    {
        try {
            if ($post_type == 'announcement') {
                $sql_restoring = "INSERT INTO " . $this->tbl_announcements . " (`announcement_id`, `announcement_unique_id`, `announcement_title`, `announcement_details`, `announcement_img`, `announcement_status`,`added_by`, `date_added`, `edited_by`, `date_edited`, `published_by`,`date_published`)
            SELECT `post_id`, `post_unique_id`,`post_title`,`post_details`,`post_img`,`post_status`,`added_by`,`date_added`,`edited_by`,`date_edited`,`published_by`,`date_published` 
            FROM " . $this->tbl_post_del . " 
            WHERE `post_id` = '$post_id' AND `post_unique_id` = '$post_unique_id' AND `post_type` = '$post_type'";
            }
            if ($post_type == 'event') {
                $sql_restoring = "INSERT INTO " . $this->tbl_events . " (`event_id`, `event_unique_id`,`event_kind`, `event_title`, `event_details`, `event_date`, `event_status`,`added_by`, `date_added`, `edited_by`, `date_edited`, `published_by`,`date_published`)
            SELECT `post_id`, `post_unique_id`,`post_kind`,`post_title`,`post_details`,`post_date`,`post_status`,`added_by`,`date_added`,`edited_by`,`date_edited`,`published_by`,`date_published` 
            FROM " . $this->tbl_post_del . " 
            WHERE `post_id` = '$post_id' AND `post_unique_id` = '$post_unique_id' AND `post_type` = '$post_type'";
            }
            if ($post_type == 'news') {
                $sql_restoring = "INSERT INTO " . $this->tbl_news . " (`news_id`, `news_unique_id`, `news_title`, `news_details`, `news_img`, `news_status`,`added_by`, `date_added`, `edited_by`, `date_edited`, `published_by`,`date_published`)
            SELECT `post_id`, `post_unique_id`,`post_title`,`post_details`,`post_img`,`post_status`,`added_by`,`date_added`,`edited_by`,`date_edited`,`published_by`,`date_published` 
            FROM " . $this->tbl_post_del . " 
            WHERE `post_id` = '$post_id' AND `post_unique_id` = '$post_unique_id' AND `post_type` = '$post_type'";
            }
            $stmt = $this->conn->prepare($sql_restoring);
            $stmt->execute();

            try {
                $sql = "DELETE FROM " . $this->tbl_post_del . " 
                    WHERE `post_id` = '$post_id' AND `post_unique_id` = '$post_unique_id' AND `post_type` = '$post_type'";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result['message'] = '<div class="toast-message">Request completed successfully</div>';
                $result['stat'] = 'success';
            } catch (\PDOException $e) {
                $result['status'] = false;
                $result['stat'] = 'error';
                $result['message'] = "Error: " . $e->getMessage();
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }
}


