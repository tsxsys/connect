<?php
/**
 * Page that allows admins to verify or delete new (unverified) users
 **/
define("HRF_DIR", $conf->base_dir . '/console/modules/hr/file_server/php/files/');
define("HRF_URL", $conf->base_url . '/console/modules/hr/file_server/php/files/');
const DES_DIR = HRF_DIR . 'employee_doc/';
const DES_URL = HRF_URL . 'employee_doc/';
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <table id="employee_docs" class="table table__plain table-hover">
            <thead>
            <tr>
                <th>Description</th>
                <th>Language</th>
                <th>Revision</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $files = glob(DES_DIR .'*.{pdf}', GLOB_BRACE);
            //            echo DES_DIR;
            foreach($files as $file) {
                $path_parts = pathinfo($file);
                $file_size = round(filesize($file) / 1024 / 1024, 2);
                echo '<tr>
                        <td>
                        <span><i class="icon-docs"></i></span> '.$path_parts['filename'].'
                          <br>
                          <small>
                              ['.$path_parts['extension'].', '.$file_size.' MB] <a href="viewer.php?t=pdf&dt=employee_doc&dn='.$path_parts['filename'].'">View</a>
                          </small>
                      </td>
                <td>English</td>
                <td>00</td>
            </tr>';
            }
            ?>
            </tbody>
        </table>
        <div class="row">
        </div>
    </div>
</section>

