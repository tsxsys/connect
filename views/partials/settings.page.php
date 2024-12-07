<?php
$uid = $_SESSION['uid'];
$departmentCount = (new Connect\DepartmentHandler)->getDepartmentCount();
$memberCount = (new Connect\DepartmentHandler)->getMemberCount();
$roleCount = (new Connect\DepartmentHandler)->getRoleCount();
$permissionCount = (new Connect\DepartmentHandler)->getPermissionCount();
$softwareCount = (new Connect\Contract)->getSoftwareCount();
?>
<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <?php
                if ($auth->isSuperAdmin() || $auth->isAdmin()) {
                    if ($auth->isAdmin()) {
                        echo '<div class="row">
                   <div class="col-lg-3 col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="fas fa-user-plus text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Users</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=users"><h6 class="m-b-0">Manage Users</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red">' . $memberCount['count'] . '</h6>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="fas fa-pencil-ruler text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Roles</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=roles"><h6 class="m-b-0">Manage Roles</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red">' . $roleCount['count'] . '</h6>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="far fa-building text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Departments</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=depts"><h6 class="m-b-0">Manage Departments</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red">' . $departmentCount['count'] . '</h6>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="far fa-envelope text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Mail</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=mail"><h6 class="m-b-0">Mail Log</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red"><i class="fas fa-tasks"></i></h6>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-lg-3 col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="fas fa-code text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Software</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=software"><h6 class="m-b-0">Manage Software</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red">' . $softwareCount['count'] . '</h6>
                           </div>
                       </div>
                   </div>
                   </div>';
                    }
                    if ($auth->isSuperAdmin()) {
                        echo '<div class="row">
               <div class="col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="fa fa-user-shield text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Permissions</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=perms"><h6 class="m-b-0">Manage Permissions</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red">' . $permissionCount['count'] . '</h6>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="card proj-t-card">
                           <div class="card-body">
                               <div class="row align-items-center m-b-30">
                                   <div class="col-auto">
                                       <i class="fas fa-user-lock text-c-red f-30"></i>
                                   </div>
                                   <div class="col p-l-0">
                                       <h4 class="m-b-0">Site Settings</h4 class="m-b-0">
                                   </div>
                               </div>
                               <div class="row align-items-center text-center">
                                   <div class="col">
                                       <a href="settings.php?t=config"><h6 class="m-b-0">Edit Site Config</h6></a>
                                   </div>
                               </div>
                               <h6 class="pt-badge bg-c-red"><i class="fas fa-cog"></i></h6>
                           </div>
                       </div>
                   </div>
               </div>';
                    }
                } else {
                    header("Location:  dash.php");
                } ?>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content -->