<?php
/**
 * Connect\FileManager extends DbConn
 */

namespace Connect;

/**
 * File Manager functions
 *
 * Handles the file system in connect
 */
class FileManager extends DbConn
{
    public function uploadFiles($file_to_action, $dir_target = null, $contract_id = null, $isContractFile = false): array
    {

        $date = date('Y-m-d H:i:s');
        $operator_id = $_SESSION['uid'];
        $access = FALSE;
        $appConfig = AppConfig::pullMultiSettings(array("base_dir", "base_url", "avatar_dir", "allowed_file_types", "max_upload_size"));


//        $FILE_DES_DIR = getDES_DIR($dir_target);
        $FILE_DES_DIR = getFileServerDir('contracts');
        $file_name = $file_to_action["name"]; // The file name with extension
        $file_type = $file_to_action["type"]; // The type of file it is
        $file_size = $file_to_action["size"]; // File size in bytes
        $file_tmp_loc = $file_to_action["tmp_name"]; // File in the PHP tmp folder
        $file_error = $file_to_action["error"]; // 0 for false... and 1 for true

        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

        $valid_extensions = explode("; ", $appConfig["allowed_file_types"]);

        foreach ($valid_extensions as $item) {

            if (preg_match("/$item\$/i", $file_name)) {
                $new_file_name = sha1(gen_uuid());
                $access = true;
                $upload_file = $FILE_DES_DIR . $new_file_name . "." . $file_extension;
            }
        }

        if ($access) {

            if (getimagesize($file_tmp_loc) || !file_exists($upload_file)) {

                if (move_uploaded_file($file_tmp_loc, $upload_file)) {

                    if (file_exists($upload_file)) {
                        /** you can make database query here and to upload information about file like *
                         *
                         * $query = $db->prepare("INSERT INTO album_images(image_name, image_album_id) VALUE (:imageName,:albumId)");
                         * $query->execute(array(":imageName" => $imageName, ":albumId" => $ablumId));
                         *  ...
                         */
                        if ($isContractFile) {
                            try {
                                $contractsFileArr = array('contract_id' => $contract_id, 'file_id' => $new_file_name, 'file_ext' => $file_extension, 'file_name' => $file_name, 'upload_date' => $date, 'operator_id' => $operator_id);
                                $contractsFileCol = implode(',', array_keys($contractsFileArr));
                                $contractsFileValues = implode(',', array_fill(0, count($contractsFileArr), '?'));
                                $stmt = $this->conn->prepare("INSERT INTO " . $this->tbl_contract_files . " ({$contractsFileCol}) VALUES ({$contractsFileValues})");
                                $stmt->execute(array_values($contractsFileArr));

                                $result['status'] = true;
                                $result['stat'] = 'success';
                                $result['message'] = 'Request Completed Successfully';
                                logger("successfully uploaded " . $file_name . "-----" . $upload_file);
                            } catch (\PDOException $e) {
//                                http_response_code(500);
                                $result['status'] = false;
                                $result['stat'] = 'error';
                                $result['message'] = "Error:: " . $e->getMessage();
                                logger("Error:: " . $e->getMessage());
                            }
                        }
                    } else {
                        $result['status'] = true;
                        $result['stat'] = 'success';
                        $result['message'] = 'Request Completed Successfully';
                        logger("successfully uploaded " . $file_name . "-----" . $upload_file);
                    }
                } else {
                    logger("error" . $file_name . " not moved");
                    $result['status'] = false;
                    $result['stat'] = 'error';
                    $result['message'] = "Error:: " . $date . " " . $file_name . " not moved";
                }
            } else {
                logger("error " . $file_name . "not found {$file_error}-----" . implode($_FILES["file"]) . "--------file exists.." . file_exists($upload_file) . "---" . implode(getimagesize($file_tmp_loc)));
                $result['status'] = false;
                $result['stat'] = 'error';
                $result['message'] = "Error:: " . $date . " " . $file_name . "not found {$file_error}-----" . implode($_FILES["file"]) . "--------file exists.." . file_exists($upload_file) . "---" . implode(getimagesize($file_tmp_loc));
            }
        } else {
            logger("error " . $file_name . " access is false");
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error:: " . $date . " " . $file_name . " access is false";
        }

        return $result;
    }

    public function deleteFile($file_to_action, $dir_target = null, $file_id = null, $isContractFile = false): array
    {
        $date = date('Y-m-d H:i:s');
        //        $FILE_DES_DIR = getDES_DIR($dir_target);
        $FILE_DES_DIR = getFileServerDir('contracts');

        if ($isContractFile) {
            $file_name = $file_id;
            $file_extension = pathinfo($file_to_action, PATHINFO_EXTENSION);
            $target_file = $FILE_DES_DIR . $file_id . "." . $file_extension;
        } else {
            $file_name = $file_to_action["name"]; // The file name with extension
            $file_type = $file_to_action["type"]; // The type of file it is
            $file_size = $file_to_action["size"]; // File size in bytes
            $file_tmp_loc = $file_to_action["tmp_name"]; // File in the PHP tmp folder
            $file_error = $file_to_action["error"]; // 0 for false... and 1 for true
            $target_file = $FILE_DES_DIR . $file_name;
        }

        if (file_exists($target_file)) {
            if (unlink($target_file)) {
                if ($isContractFile) {
                    try {
                        $stmt = $this->conn->prepare("DELETE FROM " . $this->tbl_contract_files . " WHERE `file_id` = :file_id");
                        $stmt->bindParam(':file_id', $file_id);
                        $stmt->execute();

                        $result['status'] = true;
                        $result['stat'] = 'success';
                        $result['message'] = 'Request Completed Successfully';
                        logger("Successfully deleted::" . $date . " " . $file_name . "-----" . $target_file);
                    } catch (\PDOException $e) {
                        $result['status'] = false;
                        $result['stat'] = 'error';
                        $result['message'] = "Error:: " . $e->getMessage();
                        logger("Error:: " . $e->getMessage());
                    }
                }
            } else {
                logger("Error::" . $date . " " . $target_file . " not deleted");
                $result['status'] = false;
                $result['stat'] = 'error';
                $result['message'] = "Error:: " . $date . " " . $target_file . " not deleted";
            }
        } else {
            logger("Error::" . $date . " " . $target_file . " does not exist");
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error::" . $date . " " . $target_file . " does not exist";
        }
        return $result;
    }

}




