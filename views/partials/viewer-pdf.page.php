<?php
/**
 * Description
 **/
if (!empty($_REQUEST['dt']) && !empty($_REQUEST['dn'])) {
    $doc_name = $_GET['dn'];
    $doc_type = $_GET['dt'];
    define("HRF_DIR", $conf->base_dir . '/console/modules/hr/file_server/php/files/');
    define("HRF_URL", $conf->base_url . '/console/modules/hr/file_server/php/files/');

    if ($doc_type == 'employee_doc') {
        define("DES_DIR", HRF_DIR . 'employee_doc/');
        define("DES_URL", HRF_URL . 'employee_doc/');
    } elseif ($doc_type == 'training_doc') {
        define("DES_DIR", HRF_DIR . 'training_doc/');
        define("DES_URL", HRF_URL . 'training_doc/');
    }
    $file_dir = DES_DIR . $doc_name . '.pdf';
    $file_url = DES_URL . $doc_name . '.pdf';
} else {
    echo "<script type='text/javascript'> document.location = 'error.php?t=404'; </script>";
}
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <script>
                    document.write('<a href=\"' + document.referrer + '\"><button class=\"btn btn-default\"/><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</button></a>');
                </script>
                <div class='container'>
                    <?php
                    if (!file_exists($file_dir)){
                        if ($auth->isSuperAdmin()) {
                            echo "Access Denied: " . $file_dir . " does not exit.";
                        } else {
                            echo "Access Denied";
                        }
                    } else {
                        echo "<object data='" . $file_url . "' type='application/pdf' width='100%'
                    height='100%' style='height: 70vh;'>
                    <p>If document viewer does not show click <a href='" . $file_url . "'>to
                            view the PDF!</a></p>
                    </object>";
                    }
                    ?>
                </div>
                <script>
                    document.write('<a href=\"' + document.referrer + '\"><button class=\"btn btn-default\"/><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> Back</button></a>');
                </script>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
