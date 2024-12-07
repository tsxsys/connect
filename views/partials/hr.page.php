<?php
$uid = $_SESSION['uid'];
$leave_type = 1;
$leave_status = 3;
$leaveStr = Connect\Leaves::pullLeaveStructure(array("AL"));
$leaveTaken = (new Connect\Leaves)->getLeaveTaken($uid, $leave_type, $leave_status);
$holidays_left = (int)$leaveStr['AL'] - (int)$leaveTaken;

//Representation Number Variables
define("HRF_DIR", $conf->base_dir . '/console/modules/hr/file_server/php/files/');
const EMPLOYEE_DOC = HRF_DIR . 'employee_doc';
const TRAINING_DOC = HRF_DIR . 'training_doc';
$employee_doc_files_Arr = scandir(EMPLOYEE_DOC);
$employee_doc_file_count = count($employee_doc_files_Arr) - 2;

$training_doc_files_Arr = scandir(TRAINING_DOC);
$training_doc_file_count = count($training_doc_files_Arr) - 2;

//Department Head
$department_id = (new Connect\DepartmentHandler)->getUserDept();
$deptLRequestCount = (new Connect\Leaves)->getDeptLRequestCount($department_id);
$leaveRequestCount = (new Connect\Leaves)->getLeaveRequestCount();
?><!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3><?= $training_doc_file_count ?></h3>

                        <p>Training Materials</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <a href="hr.php?t=training" class="small-box-footer">View Materials <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3><?= $holidays_left ?></h3>

                        <p>Holidays left</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                    <a href="hr.php?t=leave" class="small-box-footer">Manage Leaves <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3><?= $employee_doc_file_count ?></h3>

                        <p>Employee Documents</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-word"></i>
                    </div>
                    <a href="hr.php?t=employee-docs" class="small-box-footer">View Documents <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <?php
        if ($auth->isDepartmentHead()) {
            echo '<div class="row">
            <div class="col-lg-12 col-12">
                <!-- small box -->
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>'.$deptLRequestCount['count'].'</h3>

                        <p>Holidays Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                    <a href="hr.php?t=leave-panel" class="small-box-footer">Leave Panel <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>';
        }
        if ($auth->isHR()) {
            echo '<div class="row">
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>'.$leaveRequestCount['count'].'</h3>

                        <p>Holidays Requests</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-umbrella-beach"></i>
                    </div>
                    <a href="hr.php?t=leave-admin" class="small-box-footer">Leave Admin Panel <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-6 col-6">
                <!-- small box -->
                <div class="small-box ecni_x">
                    <div class="inner">
                        <h3>*</h3>

                        <p>File Manager</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <a href="hr.php?t=hr-admin" class="small-box-footer">Manage HR Files <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>';
        }
        ?>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
