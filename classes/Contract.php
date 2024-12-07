<?php
/**
 * Connect\Contract extends DbConn
 */

namespace Connect;

/**
 * Asset specific functions
 *
 * Various methods specifically related to the handling of contracts and assets.
 */
class Contract extends DbConn
{
    public function getContractCount(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_contracts;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getUserAssociationCount(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_customer_contracts;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAssetPendingCount(): array
    {
        try {
            $salesCheck1 = 1;
            $salesCheck2 = 1;
            $salesCheck3 = 1;
            $member_id = NULL;
            $intermediary_id = NULL;
            $sql = "SELECT ac.*,
                            ca.member_id,
                            ia.intermediary_id
            FROM " . $this->tbl_contract_checks . " AS ac
            LEFT JOIN " . $this->tbl_customer_contracts . " AS ca
            ON 
            ac.`contract_id` = ca.`contract_id`
            LEFT JOIN " . $this->tbl_intermediary_contracts . " AS ia
            ON 
                 ac.`contract_id` = ia.`contract_id`
            WHERE 
                `salesCheck1` = :salesCheck1 OR `salesCheck2` = :salesCheck2 OR `salesCheck3` = :salesCheck3
                OR `member_id` = :member_id OR `intermediary_id` = :intermediary_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':salesCheck1', $salesCheck1);
            $stmt->bindParam(':salesCheck2', $salesCheck2);
            $stmt->bindParam(':salesCheck3', $salesCheck3);
            $stmt->bindParam(':member_id', $member_id);
            $stmt->bindParam(':intermediary_id', $intermediary_id);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAssetPendingChecksCount(): array
    {
        try {
            $salesCheck1 = 0;
            $salesCheck2 = 0;
            $salesCheck3 = 0;
            $sql = "SELECT * FROM " . $this->tbl_contract_checks . "
            WHERE
                `salesCheck1` = :salesCheck1 OR `salesCheck2` = :salesCheck2 OR `salesCheck3` = :salesCheck3";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':salesCheck1', $salesCheck1);
            $stmt->bindParam(':salesCheck2', $salesCheck2);
            $stmt->bindParam(':salesCheck3', $salesCheck3);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAssetPendingDocumentUploadCount(): array
    {
        try {
            $doc_uploaded = 0;
            $sql = "SELECT * FROM " . $this->tbl_contract_status . "
            WHERE
                `doc_uploaded` = :doc_uploaded";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':doc_uploaded', $doc_uploaded);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAssetCompletedCount(): array
    {
        try {
            $completed = 1;
            $sql = "SELECT * FROM " . $this->tbl_contract_status . "
            WHERE
                `completed` = :completed";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':completed', $completed);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAssetLocations(): array
    {
        try {
            $sql = "SELECT COUNT('contract_id') assetCount, address_line_7 FROM " . $this->tbl_contracts . " GROUP BY address_line_7";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($result as $row) {
                    $counter = $row['assetCount'];
                    $countryCode = $row['address_line_7'];
                    $assetData[] = '"' . $countryCode . '": "' . $counter . '"';
                    $assetDataCode[] = $countryCode;
                    $assetDataVal[] = $counter;
                    $result['assetDataList'] = implode(", ", $assetData);
                }
                $result['assetDataList'] = $stmt->rowCount();
            } else {
                $result['status'] = false;
                $result['assetDataList'] = false;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAllCompanyId()
    {

        try {
            $sql = "SELECT * FROM " . $this->tbl_companies . " ORDER BY company_name ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                echo '<option value="">--SELECT AN OPTION--</option>';
                foreach ($result as $row) {
                    $company_id = $row['company_id'];
                    $company = $row['company_name'];
//                    $company_id_e = base64_encode($company_id . SALTY_PASSPHRASE);
                    echo '<option value="' . $company_id . '">' . $company . '</option>';
                }
            } else {
                echo "<option>Add New Customer</option>";
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
        return $result;
    }

    public function getAllUsersWithSpecificRole($role_id)
    {
        try {
            $sql = "SELECT DISTINCT
                        m.id,
                        m.username,
                        CONCAT(mi.`firstname`, ' ', mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_members . " m
                    INNER JOIN " . $this->tbl_member_info . " mi ON
                        m.id = mi.userid
                    INNER JOIN " . $this->tbl_member_roles . " mr ON 
                        mr.member_id = m.id
                    INNER JOIN " . $this->tbl_roles . " r ON 
                        mr.role_id = r.id
                    WHERE 
                        r.id = :role_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_id', $role_id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $member_id = $row['id'];
                    $full_name = $row['full_name'];
                    echo '<option value="' . $member_id . '">' . $full_name . '</option>';
                }
            } else {
                echo "<option>No data found " . $stmt->rowCount() . "</option>";
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
        return $result;
    }

    public function getAllContracts($columns): array
    {
        try {
            $salt = "X7aK8nU8zT5jS7bW";
            $sql = "SELECT
                        c.`contract_id`,c.`contract_no`, c.`mainKW`, c.`mainKVA`,c_change_log.`date_added`
                    FROM
                        " . $this->tbl_contracts . " c
                    INNER JOIN " . $this->tbl_contract_change_log . " c_change_log ON
                    c.`contract_id` = c_change_log.`contract_id`
                    ORDER BY c_change_log.`date_added` DESC";
            $stmt = $this->conn->prepare($sql);
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

    public function getAllContractFiles($columns): array
    {
        try {
            $salt = "X7aK8nU8zT5jS7bW";
            $sql = "SELECT
                        contract_files.*,
                        CONCAT_WS(' ', member_info.`firstname`, member_info.`lastname`) AS `operator_name`
                    FROM
                        " . $this->tbl_contract_files . " contract_files
                    INNER JOIN " . $this->tbl_member_info . " member_info ON
                    contract_files.`operator_id` = member_info.`userid`
                    ORDER BY contract_files.`upload_date` DESC";
            $stmt = $this->conn->prepare($sql);
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

    public function pullAllContractFiles($contract_id)
    {
        try {
            $db_contract_files = array();
            $filename_id_map = array();
            $salt = "X7aK8nU8zT5jS7bW";
            $sql = "SELECT contract_files.*
                    FROM
                        " . $this->tbl_contract_files . " contract_files
                    WHERE contract_files.`contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $contract_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $file_extension = pathinfo($row['file_name'], PATHINFO_EXTENSION);
                    $db_contract_files[] = getFileServerDir('contracts') . $row['file_id'] . "." . $file_extension;

                    $filename_id_map[] = array($row['file_id'] => $row['file_name']);
//                    $filename_id_map = array_merge($filename_id_map, array($row['file_id'] => $row['file_name']));
                }
                $file_target = 'contract_docs';
                $files = glob(getFileServerDir('contracts') . '*.*', GLOB_BRACE);
                if (glob(getFileServerDir('contracts') . "/*")) {
                    foreach ($files as $file) {
                        if (in_array($file, $db_contract_files)) {
                            $path_parts = pathinfo($file);
                            $file_size = round(filesize($file) / 1024 / 1024, 2);

                            $filename = $path_parts['filename'];
                            $extension = $path_parts['extension'];
                            $file_id = $row['file_id'];
                            $realFileName = $this->findValues($filename_id_map, $filename);
                            $realFileName = pathinfo($realFileName)['filename'];
//                            echo '<script>console.log('.json_encode($filename).');</script>';
                            echo '<tr>
                        <td>
                            <span><i class="icon-docs"></i></span> ' . $realFileName . '
                            <br>
                                <small>
                                    [' . $extension . ', ' . $file_size . ' MB] 
                                    <a href="download.php?dt=' . $file_target . '&dn=' . urlencode($filename) . '&de=' . urlencode($extension) . '&di=' . urlencode($file_id) . '&dt=documents">Download</a>';
                            if ($extension == 'pdf' || $extension == 'PDF') {
                                echo '
                                    <span> | </span>
                                    <a href="view.pdf.php?dt=' . $file_target . '&dn=' . urlencode($filename) . '&de=' . urlencode($extension) . '&di=' . urlencode($file_id) . '&dt=documents" target="_blank">View</a>';
                            }
                            echo '</small>
                        </td>
                    </tr>';
                        }
                    }
                } else {
                    echo '<tr><td><p class="info_data text-center">No additional documents available.</p></td></tr>';
                }
            }
        } catch (\PDOException $e) {
            return ["Error" => $e->getMessage()];
        }
    }

    public function getContractFileInfo($file_id)
    {
        try {
            $sql = "SELECT
                        contract_files .*,
                        CONCAT_WS(' ', member_info . `firstname`, member_info . `lastname`) as `operator_name`
                    FROM
                        " . $this->tbl_contract_files . " contract_files
                    INNER JOIN " . $this->tbl_member_info . " member_info ON
                    contract_files . `operator_id` = member_info . `userid`
                    WHERE contract_files . `file_id` = :file_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':file_id', $file_id);
            $stmt->execute();
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

    public function getAllPendingContracts($columns): array
    {
        try {
            $salesCheck1 = 0;
            $salesCheck2 = 0;
            $salesCheck3 = 0;
            $sql = "SELECT
                        c .*,c_checks .*,c_change_log . `date_added`,
                        CONCAT_WS(' ', mi_cm . `firstname`, mi_cm . `lastname`) as `cm_full_name`,
                        CONCAT_WS(' ', mi_sm . `firstname`, mi_sm . `lastname`) as `sm_full_name`, 
                        CONCAT_WS(' ', mi_tm . `firstname`, mi_tm . `lastname`) as `tm_full_name` 
                    FROM
                        " . $this->tbl_contracts . " as c
                    INNER JOIN " . $this->tbl_contract_checks . " as c_checks
                    ON
                        c . `contract_id` = c_checks . `contract_id`
                    INNER JOIN " . $this->tbl_contract_change_log . " c_change_log 
                    ON
                    c . `contract_id` = c_change_log . `contract_id`
                    LEFT JOIN " . $this->tbl_member_info . " as mi_cm
                    ON
                        c_checks . `salesCheck1By` = mi_cm . `userid`
                    LEFT JOIN " . $this->tbl_member_info . " as mi_sm
                    ON
                        c_checks . `salesCheck2By` = mi_sm . `userid`
                    LEFT JOIN " . $this->tbl_member_info . " as mi_tm
                    ON
                        c_checks . `salesCheck3By` = mi_tm . `userid`
                    WHERE
                       c_checks . `salesCheck1` = :salesCheck1 or c_checks . `salesCheck2` = :salesCheck2 or c_checks . `salesCheck3` = :salesCheck3";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':salesCheck1', $salesCheck1);
            $stmt->bindParam(':salesCheck2', $salesCheck2);
            $stmt->bindParam(':salesCheck3', $salesCheck3);
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

    public function getContractProgress($contract_id)
    {
        try {
            $sql = "SELECT
                        contracts .*,contract_progress .*
                    FROM
                        " . $this->tbl_contracts . " as contracts
                    INNER JOIN " . $this->tbl_contract_progress . " as contract_progress
                    ON
                        contracts . `contract_id` = contract_progress . `contract_id`
                    WHERE contracts . `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $contract_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    if ($row['contract_pending']) {
                        $contract_pending = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Approved</h6>
                                <p class="text - muted m - b - 0">' . $row['pending_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_pending = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Pending approval</h6>
                            </div>
                        </div>';
                    }
                    if ($row['contract_document_upload']) {
                        $contract_document_upload = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Document(s) uploaded</h6>
                                <p class="text - muted m - b - 0">' . $row['document_upload_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_document_upload = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Pending document upload</h6>
                            </div>
                        </div>';
                    }
                    if ($row['contract_software_assigned']) {
                        $contract_software_assigned = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Software assigned</h6>
                                <p class="text - muted m - b - 0">' . $row['software_assigned_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_software_assigned = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Software assigned</h6>
                            </div>
                        </div>';
                    }
                    if ($row['contract_eng_check']) {
                        $contract_eng_check = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Checked and approved by engingeering</h6>
                                <p class="text - muted m - b - 0">' . $row['eng_check_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_eng_check = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Pending engineering Check</h6>
                            </div>
                        </div>';
                    }
                    if ($row['contract_sales_check']) {
                        $contract_sales_check = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Final sales check approved</h6>
                                <p class="text - muted m - b - 0">' . $row['sales_check_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_sales_check = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Pending final sales Check</h6>
                            </div>
                        </div>';
                    }
                    if ($row['contract_issued_live']) {
                        $contract_issued_live = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Issued and live</h6>
                                <p class="text - muted m - b - 0">' . $row['issued_live_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_issued_live = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Not live</h6>
                            </div>
                        </div>';
                    }
                    if ($row['contract_end_user_notified']) {
                        $contract_end_user_notified = '<div class="row p - b - 30">
                            <div class="col - auto text - right update - meta p - r - 0">
                                <i class="fas fa - check positive update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>End user notified</h6>
                                <p class="text - muted m - b - 0">' . $row['end_user_notified_datetime'] . '</p>
                            </div>
                        </div>';
                    } else {
                        $contract_end_user_notified = '<div class="row p-b-30">
                            <div class="col-auto text-right update-meta p-r-0">
                                <i class="fas fa - times negative update - icon"></i>
                            </div>
                            <div class="col p - l - 5">
                                <h6>Notification not sent</h6>
                            </div>
                        </div>';
                    }
                    $result[] = $contract_pending . $contract_document_upload . $contract_software_assigned
                        . $contract_eng_check . $contract_sales_check . $contract_issued_live . $contract_end_user_notified;
                }
            } else {
                $result[] = 'No assets found';
            }
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
        }
        return $result;
    }

    public function getContractInfo($contract_id)
    {
        try {
            $sql = "SELECT
                        contract.*,control .*,checks .*,company .*,change_log .*,
                        CONCAT_WS(' ', member_info.`firstname`, member_info.`lastname`) AS `full_name`,
                        enclosures.*
                    FROM
                        " . $this->tbl_contracts . " AS contract
                    INNER JOIN " . $this->tbl_contract_checks . " AS checks
                    INNER JOIN " . $this->tbl_contract_controllers . " AS control
                    INNER JOIN " . $this->tbl_contract_change_log . " AS change_log
                    INNER JOIN " . $this->tbl_member_info . " AS member_info
                    INNER JOIN " . $this->tbl_sys_enclosures . " AS enclosures
                    ON
                        contract . `contract_id` = checks . `contract_id` AND contract . `contract_id` = control . `contract_id`
                        AND contract . `contract_id` = change_log . `contract_id` AND contract.`salesperson_id` = member_info.`userid`
                        AND contract.`enclosure` = enclosures.`enclosure_id`
                        
                    INNER JOIN " . $this->tbl_companies . " as company
                    ON
                        contract . `company_id` = company . `company_id`
                    WHERE contract . `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $contract_id);
            $stmt->execute();
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

    public function validateContractNo($assetNo)
    {
        try {
            // prepare sql and bind parameters
            $sql = "SELECT `contract_id` FROM " . $this->tbl_contracts . " WHERE `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $assetNo);
            $stmt->execute();
            $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $result = false;
            } else {
                $result = true;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    //For managing software
    public function getSoftwareCount()
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_sys_software;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount()) {
                $result['count'] = $stmt->rowCount();
            } else {
                $result['count'] = '0';
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAllSoftware($columns): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_sys_software;

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

    public function getSoftwareInfo($request_id)
    {
        try {
            $sql = "SELECT
                        software .*
                    FROM
                        " . $this->tbl_sys_software . " as software
                    WHERE 
                         software . `software_id` = :software_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':software_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $result = $row;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function setSoftwareInfo($post_data): array
    {

        $date_added = date('Y-m-d H:i:s');
        $columns = implode(',', array_keys($post_data));
        $values = implode(',', array_fill(0, count($post_data), '?'));

        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_sys_software . " ({
                $columns}) VALUES({$values})");
            $stmt->execute(array_values($post_data));
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

    public function updateSoftwareInfo($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_sys_software . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `software_id` = :software_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':software_id', $request_id);
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

//For assigning software
    public function pullAllSoftware(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_sys_software . " where input_type != 'hidden' ORDER BY software_category ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result['software'] = $stmt->fetchAll(\PDO::FETCH_NUM);
            $result['status'] = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;
    }

    public function setContractSoftware($post_data): array
    {

        $date_added = date('Y-m-d H:i:s');
        $columns = implode(',', array_keys($post_data));
        $values = implode(',', array_fill(0, count($post_data), '?'));

        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contract_software . " ({$columns}) VALUES({$values})");
            $stmt->execute(array_values($post_data));
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

    public function unsetContractSoftware($post_data): array
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM " . $this->tbl_contract_software . " WHERE contract_id = :contract_id AND software_id = :software_id");
            $stmt->bindParam(':contract_id', $post_data['contract_id']);
            $stmt->bindParam(':software_id', $post_data['software_id']);
            $stmt->execute();
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

    public function pullCheckedAssignedSoftware($request_id): array
    {
        try {
            $sql = "SELECT
                        contract_software.software_id
                    FROM " . $this->tbl_contract_software . " as contract_software
                    INNER JOIN " . $this->tbl_sys_software . " as sys_software
                    ON contract_software.software_id = sys_software.software_id
                    WHERE contract_software.contract_id = :contract_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
        }
        return $result;
    }

    public function getAssignedSoftware($columns, $request_id)
    {
//        echo '<script>console.log("name");</script>';
        try {
            $db_contract_software = array();
            $sql = "SELECT
            *
            FROM " . $this->tbl_contract_software . " as a_s
                    INNER JOIN " . $this->tbl_sys_software . " as s 
                    ON a_s . software_id = s . software_id
                    WHERE a_s . contract_id = :contract_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $db_contract_software[] = getFileServerDir('io') . $row['software_id'] . "." . $row['software_extension'];
                }
                $yes_file = file_check('software', null, $db_contract_software);
                $columns['software_exists'] =  $yes_file;
            }




            return array(
                    "data" => MiscFunctions::data_output($columns, $data)
                );

        } catch (\PDOException $e) {
            http_response_code(500);
            return ["Error" => $e->getMessage()];
        }
    }

    public function pullCompanyInfoCreate($company_id)
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_companies . "  WHERE `company_id` = :company_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_id', $company_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                return $row;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    public function pullCompanyInfoEdit($company_id, $contract_id)
    {
        try {
            $sql = "SELECT
                        a .*,c .*
                    FROM
                        " . $this->tbl_contracts . " as a
                    INNER JOIN " . $this->tbl_companies . " as c
                    ON
                        a . `company_id` = c . `id`
                    WHERE  c . id = :id and a . contract_id = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $company_id);
            $stmt->bindParam(':contract_id', $contract_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                return $row;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    //For assigning control systems
    public function pullAllControlSystem(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_sys_control_systems . " where input_type != 'hidden'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result['control_system'] = $stmt->fetchAll(\PDO::FETCH_NUM);
            $result['status'] = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;
    }

    public function pullAssignedControlSystem($request_id): array
    {
        try {
            $sql = "SELECT
                        contract_controllers.control_system_id
                    FROM " . $this->tbl_contract_controllers . " as contract_controllers
                    INNER JOIN " . $this->tbl_sys_control_systems . " as sys_control_systems
                    ON contract_controllers.control_system_id = sys_control_systems.control_system_id
                    WHERE contract_controllers.contract_id = :contract_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            http_response_code(500);
            $result = ["Error" => $e->getMessage()];
        }
        return $result;
    }

    public function pullAllEnclosures(): array
    {
        try {
            $sql = "SELECT * FROM " . $this->tbl_sys_enclosures . " where input_type != 'hidden'";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            $result['enclosures'] = $stmt->fetchAll(\PDO::FETCH_NUM);
            $result['status'] = true;
        } catch (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['message'] = "Error: " . $e->getMessage();
        }

        return $result;
    }

//    public function checkUuid($uuid, $column_uuid, $search_table)
//    {
//        try {
//            $sql = "SELECT " . $column_uuid . " FROM " . $this->tbl_{$search_table} . " WHERE " . $column_uuid . " = :uuid";
//
//            $stmt = $this->conn->prepare($sql);
//            $stmt->bindParam(':uuid', $uuid);
//            $stmt->execute();
//            $stmt->fetchAll(\PDO::FETCH_ASSOC);
//            if ($stmt->rowCount()) {
//                $uuid = null;
//                $uuid = gen_uuid();
//                $result['uuid_stat'] = false;
//            } else {
//                $result['uuid_stat'] = true;
//            }
//        } catch (\PDOException $e) {
//            $result['status'] = false;
//            $result['message'] = $e->getMessage();
//        }
//        return $result;
//    }

    public function addContract($contractsArr, $controlArr)
    {
        $date = date('Y-m-d H:i:s');
        $operator_id = $_SESSION['uid'];

        $contract_id = gen_uuid();
//        if ($this->checkUuid($contract_id, 'contract_id', 'contracts')['uuid_stat']) {

        $contractsArr = array_merge($contractsArr, array('contract_id' => $contract_id));

        $contractsCol = implode(',', array_keys($contractsArr));
        $contractsValues = implode(',', array_fill(0, count($contractsArr), '?'));

        $controlArr = array_merge($controlArr, array('contract_id' => $contract_id));
        $controlCol = implode(',', array_keys($controlArr));
        $controlValues = implode(',', array_fill(0, count($controlArr), '?'));

        $contractsAssigneesArr = array('contract_id' => $contract_id, 'date_added' => $date, 'added_by_id' => $operator_id);
        $contractsAssigneesCol = implode(',', array_keys($contractsAssigneesArr));
        $contractsAssigneesValues = implode(',', array_fill(0, count($contractsAssigneesArr), '?'));


        try {
            // prepare sql and bind parameters
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contracts . " ({
                $contractsCol}) VALUES({$contractsValues})");
            $stmt->execute(array_values($contractsArr));
            try {
                $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contract_controllers . " ({
                $controlCol}) VALUES({$controlValues})");
                $stmt->execute(array_values($controlArr));
                try {
                    $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contract_change_log . " ({
                    $contractsAssigneesCol}) VALUES({$contractsAssigneesValues})");
                    $stmt->execute(array_values($contractsAssigneesArr));

                    $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contract_checks . " (contract_id) VALUES(:contract_id)");
                    $stmt->bindParam(':contract_id', $contract_id);
                    $stmt->execute();

                    $result['status'] = true;
                    $result['stat'] = 'success';
                    $result['message'] = 'Request Completed Successfully';
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

    public function updateContract($request_id, $contractsArr, $controlArr): array
    {
        $date = date('Y-m-d H:i:s');
        $operator_id = $_SESSION['uid'];

        echo '<script>console.log("hi");</script>';
        try {

            $sql = "UPDATE " . $this->tbl_contracts . " SET ";
            foreach ($contractsArr as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->execute();

            try {

                $sql = "UPDATE " . $this->tbl_contract_controllers . " SET ";
                foreach ($controlArr as $key => $value) {
                    if (is_numeric($value))
                        $sql .= $key . " = " . $value . ", ";
                    else
                        $sql .= $key . " = " . "'" . $value . "'" . ", ";
                }

                $sql = trim($sql, ' ');
                $sql = trim($sql, ',');
                $sql .= " WHERE `contract_id` = :contract_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':contract_id', $request_id);
                $stmt->execute();
                try {
                    $sql = "UPDATE " . $this->tbl_contract_change_log . " SET edited_by_id = :edited_by_id, date_edited = :date_edited WHERE `contract_id` = :contract_id";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bindParam(':contract_id', $request_id);
                    $stmt->bindParam(':edited_by_id', $operator_id);
                    $stmt->bindParam(':date_edited', $date);
                    $stmt->execute();
                    $result['status'] = true;
                    $result['stat'] = 'success';
                    $result['message'] = 'Request Completed Successfully';
                } catch (\PDOException $e) {
                    $result['status'] = false;
                    $result['err_message'] = "Error: " . $e->getMessage();
                }
            } catch (\PDOException $e) {
                $result['status'] = false;
                $result['err_message'] = "Error: " . $e->getMessage();
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function signContract($request_id, $authorised_type): array
    {
        try {
            $this_user = $_SESSION['uid'];
            $date_approved = date('Y-m-d H:i:s');

            $sql = "UPDATE " . $this->tbl_contract_checks . " SET " . $authorised_type . " = 1, " . $authorised_type . "Date =:" . $authorised_type . "Date," . $authorised_type . "By =:" . $authorised_type . "By";
            $sql .= " WHERE `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->bindParam(':' . $authorised_type . 'Date', $date_approved);
            $stmt->bindParam(':' . $authorised_type . 'By', $this_user);
            $stmt->execute();
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            http_response_code(5000);
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function sendContractApprovalNotification(string $role_id, string $contract_id, array $appConfig): array
    {

        $from_email = $appConfig["from_email"];
        $base_url = $appConfig["base_url"];
        $dev_url = $appConfig["dev_url"];
        try {
            $sql = "SELECT m .* 
                    FROM " . $this->tbl_member_roles . " mr
                    INNER JOIN " . $this->tbl_roles . " r 
                        ON mr . role_id = r . id
                    INNER JOIN " . $this->tbl_members . " m 
                        ON mr . member_id = m . id
                    WHERE r . id = :role_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':role_id', $role_id);

            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                foreach ($data as $row) {
                    $salesStaffEmail = $row['email'];

                    $recipients = array(
                        $salesStaffEmail
                        // more emails
                    );
                    $sendTo = implode(',', $recipients);
                    if (!empty($sendTo)) {
                        $message_body = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">';
                        $message_body .= '<head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="x-apple-disable-message-reformatting">';
                        $message_body .= '<style>@import url(https://fonts.googleapis.com/css?family=Roboto:300,400);body,html,table{margin:0 auto!important}.a6S,img.g-img+div{display:none!important}body,html{padding:0!important;height:100%!important;width:100%!important}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important}table table table{table-layout:auto}img{-ms-interpolation-mode:bicubic}.aBn,.x-gmail-data-detectors,.x-gmail-data-detectors *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{opacity:.01!important}.button-link{text-decoration:none!important}@media only screen and (min-device-width:375px) and (max-device-width:413px){.email-container{min-width:375px!important}}.button-a,.button-td{transition:all .1s ease-in}.button-a:hover,.button-td:hover{background:#555!important;border-color:#555!important}@media screen and (max-width:480px){.fluid,.stack-column,.stack-column-center{width:100%!important;max-width:100%!important}.center-on-narrow,.stack-column-center{text-align:center!important}.center-on-narrow,.fluid{margin-left:auto!important;margin-right:auto!important}.fluid{height:auto!important}.stack-column,.stack-column-center{display:block!important;direction:ltr!important}.center-on-narrow{display:block!important;float:none!important}table.center-on-narrow{display:inline-block!important}.email-container p{font-size:17px!important;line-height:22px!important}}</style>';
                        $message_body .= '<div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;"></div>';
                        $message_body .= '<div style="max-width: 680px; margin: auto;" class="email-container"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;"><tr><td style="padding: 20px 0; text-align: center"><a href="$domain"><img src="' . $base_url . '/assets/img/cl-logo-fl.png" width="400" height="50" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 20px;"></a>';
                        $message_body .= '<hr width="20%"></td></tr></table><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" class="email-container"><tr><td bgcolor="#ffffff"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">';
                        $message_body .= '<tr><td style="padding: 40px 40px 20px; text-align: left;"><h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;">Hello,&nbsp;</h1></td></tr>';
                        $message_body .= '<tr><td style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: center;"><p style="margin: 0;">Loadbank C' . $contract_id . '\"s contract review document is now ready to be checked and signed.</p></td></tr>';
                        $message_body .= '<tr><td style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td"><a href="$domain" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">';
                        $message_body .= '<span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr></table></td></tr></table></td></tr></table>';
                        $message_body .= '<div style="display:inline-block; margin: 0 -2px; max-width:66.66%; min-width:320px; vertical-align:top;" class="stack-column"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 40px 40px; text-align: left;" class="center-on-narrow">';
                        $message_body .= '<h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 18px; line-height: 21px; color: #333333; text-align:left; font-weight: bold;">Crestchic | Portal</h2></td></tr></table></div><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; font-family: sans-serif; color: #555555; background-color:#eee;line-height:18px;">';
                        $message_body .= '<tr><td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors"><webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>';
                        $message_body .= '<br><br>Crestchic Ltd<br>2nd Avenue, Centrum 100 Burton-on-Trent. DE14 2WF UK<br>Tel: +44 (0) 1283 531 645<p style="font-family: Roboto!important; font-size: 12px!important">Powered by <a href="' . $dev_url . '" target="_blank" style="cursor: pointer!important; text-decoration: none!important; color: #a0a0a0!important;">STL</a></p></td></tr></table></div></div></body></html>';

                        $headers = array('MIME-Version: 1.0',
                            'Content-Type: text/html; charset="UTF-8";',
                            'From: ' . $from_email,
                            'Reply-To: ' . $from_email,
                            'Return-Path: ' . $from_email,
                            'X-Mailer: PHP/' . phpversion()
                        );
                        $subject = "C" . $contract_id . " Ready for signing | Crestchic Loadbanks";
//                $send_mail = mail($sendTo, $subject, $message_body, implode("\n", $headers));
                        $send_mail = true;
                        if ($send_mail) {
                            $result['status'] = true;
                            $result['stat'] = 'success';
                            $result['message'] = 'Signed Completed Successfully';
                        } else {
                            $result['status'] = false;
                            $result['stat'] = 'error';
                            $result['message'] = 'Failed to send contract approval notification';
                        }
                    }
                }
            } else {
                $result = [];
            }
        } catch
        (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function sendDONotification($appConfig, $contract_id): array
    {

        $from_email = $appConfig["from_email"];
        $base_url = $appConfig["base_url"];
        $dev_url = $appConfig["dev_url"];
        $design_office_email = $appConfig["design_office_email"];
        try {


            $recipients = array(
                $design_office_email
                // more emails
            );
            $sendTo = implode(',', $recipients);
            if (!empty($sendTo)) {
                $message_body = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">';
                $message_body .= '<head><meta charset="utf-8"><meta name="viewport" content="width=device-width"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="x-apple-disable-message-reformatting">';
                $message_body .= '<style>@import url(https://fonts.googleapis.com/css?family=Roboto:300,400);body,html,table{margin:0 auto!important}.a6S,img.g-img+div{display:none!important}body,html{padding:0!important;height:100%!important;width:100%!important}*{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}div[style*="margin: 16px 0"]{margin:0!important}table,td{mso-table-lspace:0!important;mso-table-rspace:0!important}table{border-spacing:0!important;border-collapse:collapse!important;table-layout:fixed!important}table table table{table-layout:auto}img{-ms-interpolation-mode:bicubic}.aBn,.x-gmail-data-detectors,.x-gmail-data-detectors *,[x-apple-data-detectors]{border-bottom:0!important;cursor:default!important;color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.a6S{opacity:.01!important}.button-link{text-decoration:none!important}@media only screen and (min-device-width:375px) and (max-device-width:413px){.email-container{min-width:375px!important}}.button-a,.button-td{transition:all .1s ease-in}.button-a:hover,.button-td:hover{background:#555!important;border-color:#555!important}@media screen and (max-width:480px){.fluid,.stack-column,.stack-column-center{width:100%!important;max-width:100%!important}.center-on-narrow,.stack-column-center{text-align:center!important}.center-on-narrow,.fluid{margin-left:auto!important;margin-right:auto!important}.fluid{height:auto!important}.stack-column,.stack-column-center{display:block!important;direction:ltr!important}.center-on-narrow{display:block!important;float:none!important}table.center-on-narrow{display:inline-block!important}.email-container p{font-size:17px!important;line-height:22px!important}}</style>';
                $message_body .= '<div style="display: none; font-size: 1px; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;"></div>';
                $message_body .= '<div style="max-width: 680px; margin: auto;" class="email-container"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;"><tr><td style="padding: 20px 0; text-align: center"><a href="$domain"><img src="' . $base_url . '/assets/img/cl-logo-fl.png" width="400" height="50" alt="alt_text" border="0" style="height: auto; font-family: sans-serif; font-size: 15px; line-height: 20px;"></a>';
                $message_body .= '<hr width="20%"></td></tr></table><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" class="email-container"><tr><td bgcolor="#ffffff"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">';
                $message_body .= '<tr><td style="padding: 40px 40px 20px; text-align: left;"><h1 style="margin: 0; font-family: sans-serif; font-size: 24px; line-height: 27px; color: #333333; font-weight: normal;">Hello,&nbsp;</h1></td></tr>';
                $message_body .= '<tr><td style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; text-align: center;"><p style="margin: 0;">Loadbank C' . $contract_id . ' is now complete and checked.</p><p>STATUS: Now available to view and upload documents to.</p></td></tr>';
                $message_body .= '<tr><td style="padding: 0 40px 40px; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;"><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" style="margin: auto;"><tr><td style="border-radius: 3px; background: #222222; text-align: center;" class="button-td"><a href="$domain" style="background: #222222; border: 15px solid #222222; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;" class="button-a">';
                $message_body .= '<span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr></table></td></tr></table></td></tr></table>';
                $message_body .= '<div style="display:inline-block; margin: 0 -2px; max-width:66.66%; min-width:320px; vertical-align:top;" class="stack-column"><table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td dir="ltr" style="font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555; padding: 0 40px 40px; text-align: left;" class="center-on-narrow">';
                $message_body .= '<h2 style="margin: 0 0 10px 0; font-family: sans-serif; font-size: 18px; line-height: 21px; color: #333333; text-align:left; font-weight: bold;">Crestchic | Portal</h2></td></tr></table></div><table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px; font-family: sans-serif; color: #555555; background-color:#eee;line-height:18px;">';
                $message_body .= '<tr><td style="padding: 40px 10px;width: 100%;font-size: 12px; font-family: sans-serif; line-height:18px; text-align: center; color: #888888;" class="x-gmail-data-detectors"><webversion style="color:#cccccc; text-decoration:underline; font-weight: bold;">View as a Web Page</webversion>';
                $message_body .= '<br><br>Crestchic Ltd<br>2nd Avenue, Centrum 100 Burton-on-Trent. DE14 2WF UK<br>Tel: +44 (0) 1283 531 645<p style="font-family: Roboto!important; font-size: 12px!important">Powered by <a href="' . $dev_url . '" target="_blank" style="cursor: pointer!important; text-decoration: none!important; color: #a0a0a0!important;">STL</a></p></td></tr></table></div></div></body></html>';

                $headers = array('MIME-Version: 1.0',
                    'Content-Type: text/html; charset="UTF-8";',
                    'From: ' . $from_email,
                    'Reply-To: ' . $from_email,
                    'Return-Path: ' . $from_email,
                    'X-Mailer: PHP/' . phpversion()
                );
                $subject = "C" . $contract_id . " Ready for signing | Crestchic Loadbanks";
//                $send_mail = mail($sendTo, $subject, $message_body, implode("\n", $headers));
                $send_mail = true;
                if ($send_mail) {
                    $result['status'] = true;
                    $result['stat'] = 'success';
                    $result['message'] = 'Signed Completed Successfully';
                } else {
                    $result['status'] = false;
                    $result['stat'] = 'error';
                    $result['message'] = 'Failed to send contract approval notification';
                }
            }

        } catch (\PDOException $e) {
            http_response_code(500);
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function listAllUsersNotAssigned($member_type, $request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        m.id,
                        m.username,
                        CONCAT(mi.`firstname`, ' ', mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_members . " m
                    INNER JOIN " . $this->tbl_member_info . " mi ON
                        m.id = mi.userid
                    WHERE
                        m.`member_type` = :member_type AND NOT EXISTS(
                        SELECT
                            am.member_id
                        FROM
                            " . $this->tbl_contract_members . " am
                        WHERE
                            m.id = am.member_id AND am.contract_id = :contract_id
                    )
                    ORDER BY `full_name` ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                if ($member_type == 'customer') {
                    $optgroup_label = 'customers';
                } else if ($member_type == 'intermediary') {
                    $optgroup_label = 'intermediaries';
                }
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $member_id = $row['id'];
                    $full_name = $row['full_name'];
//                    $member_id_e = base64_encode($member_id . SALTY_PASSPHRASE);
                    echo '<option value="' . $member_id . '">' . $full_name . '</option>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllUsersAssigned($member_type, $request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        m.id,
                        m.username,
                        CONCAT(mi.`firstname`, ' ', mi.`lastname`) AS `full_name`
                    FROM
                        " . $this->tbl_members . " m
                    INNER JOIN " . $this->tbl_member_info . " mi ON
                        m.id = mi.userid
                    INNER JOIN " . $this->tbl_contract_members . " am ON
                    m.id = am.member_id
                    WHERE
                        am.`contract_id` = :contract_id AND m.`member_type` = :member_type
                    ORDER BY `full_name` ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                if ($member_type == 'customer') {
                    $optgroup_label = 'customers';
                } else if ($member_type == 'intermediary') {
                    $optgroup_label = 'intermediaries';
                }
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $member_id = $row['id'];
                    $full_name = $row['full_name'];
//                    $member_id_e = base64_encode($member_id . SALTY_PASSPHRASE);
                    echo '<option value="' . $member_id . '">' . $full_name . '</option>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllUsersAssigned1($member_id, $request_id): array
    {
        try {
            $sql = "SELECT *
                    FROM " . $this->tbl_contract_members . "
                    WHERE `contract_id` = :contract_id AND `member_id` = :member_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->bindParam(':member_id', $member_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $result['status'] = true;
            } else {
                $result['status'] = false;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllAssetUsers($member_type, $request_id): array
    {
        try {
            $sql = "SELECT DISTINCT m.id, m.username,
                                    CONCAT(mi.`firstname`, ' ', mi.`lastname`) AS `full_name`
                    FROM " . $this->tbl_members . " m
                    INNER JOIN " . $this->tbl_member_info . " mi ON m.id = mi.userid
                    WHERE m.`member_type` = :member_type
                    ORDER BY `full_name` ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_type', $member_type);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                if ($member_type == 'customer') {
                    $optgroup_label = 'customers';
                } else if ($member_type == 'intermediary') {
                    $optgroup_label = 'intermediaries';
                }
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $member_id = $row['id'];
                    $full_name = $row['full_name'];
                    $member_id_e = base64_encode($member_id . SALTY_PASSPHRASE);
                    $action_ed = $this->listAllUsersAssigned1($member_id, $request_id);
                    if ($action_ed['status']) {
                        $selected = 'selected';
                    } else {
                        $selected = null;
                    }
                    echo '<option value="' . $member_id . '" ' . $selected . '>' . $full_name . '</option>';
                }
            } else {
                echo "<option>No ' . $member_type . ' found</option>";
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function updateAssetUsers(array $users, $request_id): array
    {
        try {

            $this->conn->beginTransaction();

            $sql_del = "DELETE FROM " . $this->tbl_contract_members . " WHERE contract_id = :contract_id";

            $stmt_del = $this->conn->prepare($sql_del);
            $stmt_del->bindParam(':contract_id', $request_id);
            $stmt_del->execute();

            if (!empty($users)) {
                $request_id_ = quotify($request_id);
                $chunks = MiscFunctions::placeholders($users, ",", $request_id_);

                $sql = "REPLACE INTO " . $this->tbl_contract_members . "
                          (`member_id`, `contract_id`)
                          VALUES $chunks";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();


                $result['status'] = true;
                $result['stat'] = 'success';
                $result['message'] = 'Request Completed Successfully';
            } else {
                $result['status'] = true;
                $result['stat'] = 'success';
                $result['message'] = 'No members assigned';
            }
            $this->conn->commit();
        } catch (\PDOException $e) {
//            $this->conn->rollback();
//            http_response_code(500);
            error_log($e->getMessage());
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = 'Cannot complete request';
//            $result['message'] = $chunks;
        }
        return $result;
    }

    public function updateUsersContracts(array $contracts, string $request_id): array
    {
        try {

            $this->conn->beginTransaction();

            $sql_del = "DELETE FROM " . $this->tbl_contract_members . " WHERE member_id = :member_id";

            $stmt_del = $this->conn->prepare($sql_del);
            $stmt_del->bindParam(':member_id', $request_id);
            $stmt_del->execute();

            if (!empty($contracts)) {
                $request_id_ = quotify($request_id);
                $chunks = MiscFunctions::placeholders($contracts, ",", $request_id_);

                $sql = "REPLACE INTO " . $this->tbl_contract_members . "
                          (`contract_id`, `member_id`)
                          VALUES $chunks";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();


                $result['status'] = true;
                $result['stat'] = 'success';
                $result['message'] = 'Request Completed Successfully';
            } else {
                $result['status'] = true;
                $result['stat'] = 'success';
                $result['message'] = 'No contracts assigned';
            }
            $this->conn->commit();
        } catch (\PDOException $e) {
//            $this->conn->rollback();
//            http_response_code(500);
            error_log($e->getMessage());
            $result['status'] = false;
            $result['stat'] = 'error';
//            $result['message'] = 'Cannot complete request';
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function updateIntermediaryContracts(array $contracts, string $request_id): array
    {
        try {

            $this->conn->beginTransaction();

            $sql_del = "DELETE FROM " . $this->tbl_intermediary_contracts . " WHERE intermediary_id = :intermediary_id";

            $stmt_del = $this->conn->prepare($sql_del);
            $stmt_del->bindParam(':intermediary_id', $request_id);
            $stmt_del->execute();

            if (!empty($contracts)) {
                $request_id_ = quotify($request_id);
                $chunks = MiscFunctions::placeholders($contracts, ",", $request_id_);

                $sql = "REPLACE INTO " . $this->tbl_intermediary_contracts . "
                          (`contract_id`, `intermediary_id`)
                          VALUES $chunks";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();


                $result['status'] = true;
                $result['stat'] = 'success';
                $result['message'] = 'Request Completed Successfully';
            } else {
                $result['status'] = true;
                $result['stat'] = 'success';
                $result['message'] = 'No contracts assigned';
            }
            $this->conn->commit();
        } catch (\PDOException $e) {
//            $this->conn->rollback();
//            http_response_code(500);
            error_log($e->getMessage());
            $result['status'] = false;
            $result['stat'] = 'error';
//            $result['message'] = 'Cannot complete request';
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function getAssetPinInfo($request_id)
    {
        try {
            $sql = "SELECT
                        *
                    FROM
                        " . $this->tbl_contract_public . "
                    WHERE 
                         `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($data as $row) {
                $result = $row;
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function setAssetUPin($post_data)
    {
        $columns = implode(',', array_keys($post_data));
        $values = implode(',', array_fill(0, count($post_data), '?'));
        try {
            $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contract_public . " ({$columns}) VALUES ({$values})");
            $stmt->execute(array_values($post_data));
            $result['status'] = true;
            $result['stat'] = 'success';
            $result['message'] = 'Request Completed Successfully';
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['err_message'] = "Error: " . $e->getMessage();
        }
        return $result;
    }

    public function updateContractSiteAddress($request_id, $post_data): array
    {
        try {

            $sql = "UPDATE " . $this->tbl_contracts . " SET ";
            foreach ($post_data as $key => $value) {
                if (is_numeric($value))
                    $sql .= $key . " = " . $value . ", ";
                else
                    $sql .= $key . " = " . "'" . $value . "'" . ", ";
            }

            $sql = trim($sql, ' ');
            $sql = trim($sql, ',');
            $sql .= " WHERE `contract_id` = :contract_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':contract_id', $request_id);
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

    public function listAllContractsNotAssigned($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        a.contract_id, a.contract_no
                    FROM
                        " . $this->tbl_contracts . " a
                    WHERE NOT EXISTS(
                        SELECT
                            am.contract_id
                        FROM
                            " . $this->tbl_contract_members . " am
                        WHERE
                            am.contract_id = a.contract_id AND am.member_id = :member_id
                    )
                    ORDER BY a.contract_no ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':member_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $optgroup_label = 'Contracts';
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $contract_id = $row['contract_id'];
                    $contract_no = $row['contract_no'];
                    echo '<option value="' . $contract_id . '">C' . $contract_no . '</option>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllContractsAssigned($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        am.contract_id, a.contract_no
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
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $optgroup_label = 'Contracts';
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $contract_id = $row['contract_id'];
                    $contract_no = $row['contract_no'];
                    echo '<option value="' . $contract_id . '">C' . $contract_no . '</option>';
                }
                if (!empty($optgroup_label)) {
                    echo '</optgroup>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllCompanyContractsNotAssigned($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        c.contract_id, c.contract_no
                    FROM
                        " . $this->tbl_contracts . " c
                    WHERE NOT EXISTS(
                        SELECT
                            cm.contract_id
                        FROM
                            " . $this->tbl_company_contracts . " cm
                        WHERE
                            cm.contract_id = c.contract_id AND cm.company_id = :company_id
                    )
                    ORDER BY c.contract_no ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $optgroup_label = 'Contracts';
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $contract_id = $row['contract_id'];
                    $contract_no = $row['contract_no'];
                    echo '<option value="' . $contract_id . '">C' . $contract_no . '</option>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllCompanyContractsAssigned($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        cm.contract_id, a.contract_no
                    FROM
                        " . $this->tbl_company_contracts . " cm
                    INNER JOIN " . $this->tbl_contracts . " a ON
                        cm.contract_id = a.contract_id
                    WHERE
                        cm.member_id = :member_id
                    ORDER BY a.contract_no ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':company_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $optgroup_label = 'Contracts';
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $contract_id = $row['contract_id'];
                    $contract_no = $row['contract_no'];
                    echo '<option value="' . $contract_id . '">C' . $contract_no . '</option>';
                }
                if (!empty($optgroup_label)) {
                    echo '</optgroup>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllIntermediaryContractsNotAssigned($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        a.contract_id, a.contract_no
                    FROM
                        " . $this->tbl_contracts . " a
                    WHERE NOT EXISTS(
                        SELECT
                            ia.contract_id
                        FROM
                            " . $this->tbl_intermediary_contracts . " ia
                        WHERE
                            ia.contract_id = a.contract_id AND ia.intermediary_id = :intermediary_id
                    )
                    ORDER BY a.contract_no ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':intermediary_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $optgroup_label = 'Contracts';
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $contract_id = $row['contract_id'];
                    $contract_no = $row['contract_no'];
                    echo '<option value="' . $contract_id . '">C' . $contract_no . '</option>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    public function listAllIntermediaryContractsAssigned($request_id): array
    {
        try {
            $sql = "SELECT DISTINCT
                        im.contract_id, a.contract_no
                    FROM
                        " . $this->tbl_intermediary_contracts . " im
                    INNER JOIN " . $this->tbl_contracts . " a ON
                        im.contract_id = a.contract_id
                    WHERE
                        im.intermediary_id = :intermediary_id
                    ORDER BY a.contract_no ASC";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':intermediary_id', $request_id);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if ($stmt->rowCount()) {
                $optgroup_label = 'Contracts';
                if (!empty($optgroup_label)) {
                    echo '<optgroup label="' . $optgroup_label . '">';
                }
                foreach ($result as $row) {
                    $contract_id = $row['contract_id'];
                    $contract_no = $row['contract_no'];
                    echo '<option value="' . $contract_id . '">C' . $contract_no . '</option>';
                }
                if (!empty($optgroup_label)) {
                    echo '</optgroup>';
                }
            }
        } catch (\PDOException $e) {
            $result['status'] = false;
            $result['message'] = $e->getMessage();
        }
        return $result;
    }

    private function find_Value($key, $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->find_Value($key, $array);
            } else {
                return $key . " => " . $value . "<br>";
            }
        }
    }

    private function findValues(array $filename_id_map, $filename)
    {
        foreach ($filename_id_map as $pair) {
            if (array_keys($pair)[0] == $filename) {
                return array_values($pair)[0];
            }
        }
    }
}