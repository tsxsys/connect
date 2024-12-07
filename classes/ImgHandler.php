<?php
/**
 * Connect\ImgHandler
 */
namespace Connect;

/**
 * Image handling functions
 *
 * Handles user image uploads and storage
 */
class ImgHandler
{
    /**
     * Converts base64 string to binary image
     *
     * @param  string $base64_string Base64 encoded string of image
     * @param  string $output_file   File path to store image to
     *
     * @return string Output file path
     */
    public static function base64ToImage($base64_string, $output_file)
    {
        $ifp = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }

    /**
     * Stores image to path
     *
     * @param  string $img_path       File path to store image to
     * @param  string $base64_string Base64 encoded string of image
     *
     * @return array
     */
    public static function putImage($img_path, $base64_string)
    {
        try {

            //searches for existing files with same userid
            $existing = glob(pathinfo($img_path, PATHINFO_DIRNAME)."/".pathinfo($img_path, PATHINFO_FILENAME)."*");

            if (is_writable(pathinfo($img_path, PATHINFO_DIRNAME))) {
                foreach ($existing as $file) {
                    //deletes existing files with same userid
                    unlink($file) ;
                }

                if (!self::base64ToImage($base64_string, $img_path)) {
                    throw new \Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Image upload failed</div>");
                } else {
                    //success
                    $result['status'] = true;
                    $result['stat'] = 'success';
                    $result['message'] = 'Request Completed Successfully';
                    return $result;
//                    return "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Changes saved!</div>";
                }
            } else {
                throw new \Exception("<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>Image directory not writable</div>");
            }
        } catch (\Exception $e) {
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error: " . $e->getMessage();
            return $result;
        }
    }

    public static function uploadImage($fileTmpLoc,$img_target_path): array
    {
        try {

            //searches for existing files with same userid
            $existing = glob(pathinfo($img_target_path, PATHINFO_DIRNAME)."/".pathinfo($img_target_path, PATHINFO_FILENAME)."*");

            if (is_writable(pathinfo($img_target_path, PATHINFO_DIRNAME))) {
                foreach ($existing as $file) {
                    //deletes existing files with same userid
                    unlink($file) ;
                }

                $move = move_uploaded_file($fileTmpLoc, $img_target_path); // Moving Uploaded file
                if ($move){
                    $result['status'] = true;
                    $result['stat'] = 'success';
                    $result['message'] = 'Request Completed Successfully';
                    return $result;
                }
            } else {
                $result['status'] = false;
                $result['stat'] = 'error';
                $result['message'] = 'Image directory not writable';
                return $result;
            }
        } catch (\Exception $e) {
            $result['status'] = false;
            $result['stat'] = 'error';
            $result['message'] = "Error: " . $e->getMessage();
            return $result;
        }
    }
}
