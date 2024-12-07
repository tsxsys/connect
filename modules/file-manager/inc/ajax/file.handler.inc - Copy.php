<?php
require '../../../../vendor/autoload.php';
//
$appConfig = Connect\AppConfig::pullMultiSettings(array("base_dir", "base_url", "avatar_dir", "allowed_file_types", "max_upload_size"));
//include $appConfig["base_dir"] . 'console/connect/connect.inc.php';
//require '../../../../connect/connect.inc.php';
$dir_target = 'contract';
//switch ($dir_target) {
//    case 'contract':
//        $FILE_DES_DIR = CONTRACTS_FILE_DIR;
//        break;
//    default:
//        $FILE_DES_DIR = CONTRACTS_FILE_DIR;
//
//}
$FILE_DES_DIR = $appConfig["base_dir"] . 'console/modules/file_server/contracts/';
//echo $FILE_DES_DIR;
if (!empty($_FILES)) {
    $access = FALSE;
    $file_uploaded = $_FILES['file'];
    $file_name = $file_uploaded["name"]; // The file name with extension
    $file_type = $file_uploaded["type"]; // The type of file it is
    $file_size = $file_uploaded["size"]; // File size in bytes
    $file_tmp_loc = $file_uploaded["tmp_name"]; // File in the PHP tmp folder
    $file_error = $file_uploaded["error"]; // 0 for false... and 1 for true

    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    $valid_extensions = explode("; ", $appConfig["allowed_file_types"]);

    foreach ($valid_extensions as $item) {

        if (preg_match("/$item\$/i", $file_name)) {
            $new_file_name = sha1(alphanumeric_token(4)) . "-" . time();
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


                    logger("successful uploaded " . $file_name . "-----" . $upload_file);
                }
            } else {
                logger("error" . $file_name . " not moved");
            }
        } else {
            logger("error " . $file_name . "not found {$file_error}-----" . implode($_FILES["file"]) . "--------file exists.." . file_exists($upload_file) . "---" . implode(getimagesize($file_tmp_loc)));
        }
    } else {
        logger("error " . $file_name . " access not {$access}");
    }


}

