<?php
/**
* Connect\ConnectHandler extends DbConn
*/
namespace Connect;

/**
* User profile data functions
*
* Handles user profile data in notice_board table
*/
class ConnectHandler extends DbConn{
    public function listAllAnnouncements (): array
    {
        try {
            $sql = "SELECT DISTINCT id, title, description
                    FROM ".$this->$tbl_notice_board;

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
}


