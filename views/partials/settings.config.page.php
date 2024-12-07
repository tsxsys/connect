<?php
$settingsArr = $conf->pullAllSettings(new Connect\AuthorizationHandler);
?>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-8 offset-md-2">
                    <div class="card card-dark">
                        <form id="settingsForm" action="#" enctype="multipart/form-data">
                            <div class="form-group" id="configForm">
                        <div class="card-header p-2">

                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                <?php

                                //Gets categories from settings array
                                if ($settingsArr['status'] === true) {
                                foreach ($settingsArr['settings'] as $key => $value) {
                                    $groupedArr[$value[4]][] = $value;
                                }
                                $i = 1;
                                //Builds tabs
                                foreach ($groupedArr as $category => $catval) {
                                    if ($i === 1) {
                                        echo "<li class='nav-item'>
                                                <button class='nav-link active' id='{$category}' data-bs-toggle='tab' data-bs-target='#{$category}_tab' type='button' role='tab' aria-controls='{$category}' aria-selected='true'>{$category}</button>
                                                <div class='slide'></div>
                                              </li>";
                                    } else {
                                        echo "<li class='nav-item'>
                                                <button class='nav-link' id='{$category}' data-bs-toggle='tab' data-bs-target='#{$category}_tab' type='button' role='tab' aria-controls='{$category}' aria-selected='true'>{$category}</button>
                                                <div class='slide'></div>
                                              </li>";
                                    }
                                    $i++;
                                }
                                echo "</ul>
                            </div><!-- /.card-header -->
                        <div class='card-body'>
                            <div class='tab-content' id='myTabContent'>";
                                $x = 1;
                                //Builds content within tabs
                                foreach ($groupedArr as $category => $catval) {
                                    if ($x === 1) {
                                        echo "<div class='tab-pane fade show active' id='{$category}_tab' role='tabpanel' aria-labelledby='{$category}' tabindex='0'>";
                                    } else {
                                        echo "<div class='tab-pane fade' id='{$category}_tab' role='tabpanel' aria-labelledby='{$category}' tabindex='0'>";
                                    }
                                        echo "<div class='row'>";
                                    foreach ($catval as $setting) {
                                        $setting[1] = htmlspecialchars($setting[1], ENT_QUOTES);
                                        $setting[2] = htmlspecialchars($setting[2], ENT_QUOTES);

                                        //Input Type
                                        switch ($setting[3]) {

                                            case "textarea":
                                                echo "<div class='col-sm-12'>
<div class='form-group'>
                                            <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                            <textarea class='form-control form-control-border form-control-sm' id='{$setting[0]}' rows='4' name='{$setting[0]}' placeholder='{$setting[0]}'>{$setting[1]}</textarea>
                                        </div>
                                        </div>";
                                                break;

                                            case "password":
                                                echo "<div class='col-sm-6'>
                                                        <div class='form-group'>
                                                          <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                          <input name='{$setting[0]}' id='{$setting[0]}' type='password' class='form-control form-control-border form-control-sm' value='{$setting[1]}'>
                                                        </div>
                                                    </div>";
                                                break;

                                            case "boolean":
                                                if ($setting[1] == 'true') {
                                                    echo "<div class='col-sm-6'>
                                                            <div class='form-group'>
                                                              <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                              <select class='custom-select form-control-border' id='{$setting[0]}' name='{$setting[0]}'>
                                                                <option value='true' selected>True</option>
                                                                <option value='false'>False</option>
                                                              </select>
                                                            </div>
                                                        </div>";
                                                } else {
                                                    echo "<div class='col-sm-6'>
                                                            <div class='form-group'>
                                                              <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                              <select class='custom-select form-control-border' id='{$setting[0]}' name='{$setting[0]}'>
                                                                <option value='true'>True</option>
                                                                <option value='false' selected>False</option>
                                                              </select>
                                                            </div>
                                                        </div>";
                                                }
                                                break;

                                            case "number":
                                                echo "<div class='col-sm-6'>
                                                        <div class='form-group'>
                                                          <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                          <input name='{$setting[0]}' id='{$setting[0]}' type='number' class='form-control form-control-border form-control-sm' value='{$setting[1]}'>
                                                        </div>
                                                    </div>";
                                                break;

                                            case "email":
                                                echo "<div class='col-sm-6'>
                                                        <div class='form-group'>
                                                          <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                          <input name='{$setting[0]}' id='{$setting[0]}' type='email' class='form-control form-control-border form-control-sm' value='{$setting[1]}'>
                                                        </div>
                                                    </div>";
                                                break;

                                            case "url":
                                                echo "<div class='col-sm-6'>
                                                        <div class='form-group'>
                                                          <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                          <input name='{$setting[0]}' id='{$setting[0]}' type='url' class='form-control form-control-border form-control-sm' value='{$setting[1]}'>
                                                        </div>
                                                    </div>";
                                                break;

                                            case "timezone":
                                                echo "<div class='col-sm-6'>
                                                            <div class='form-group'>
                                                              <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                              <select class='custom-select form-control-border' id='{$setting[0]}' name='{$setting[0]}' value='{$setting[1]}'>";
                                                foreach (timezone_identifiers_list() as $timezone) {
                                                    if ($setting[1] == $timezone) {
                                                        echo "<option value='$timezone' selected>$timezone</option>";
                                                    } else {
                                                        echo "<option value='$timezone'>$timezone</option>";
                                                    }
                                                }
                                                                echo "</select>
                                                            </div>
                                                        </div>";
                                                break;

                                            default:
                                                echo "<div class='col-sm-6'>
                                                        <div class='form-group'>
                                                          <label for='{$setting[0]}' data-toggle='tooltip' data-placement='right' title='{$setting[2]}'>{$setting[0]}</label>
                                                          <input name='{$setting[0]}' id='{$setting[0]}' class='form-control form-control-border form-control-sm' value='{$setting[1]}'>
                                                        </div>
                                                    </div>";
                                        }
                                    }
                                    echo '</div></div>';

                                    $x++;
                                }
                                echo '</div>'; ?>
                        <!-- /.tab-content -->
                                    <div class="form-group row mt-5">
                                        <div class="col-md-8 offset-md-2">
                                            <div id="message_config"></div>
                                            <div class="text-center">
                                            <button type="submit" class="btn btn-sm btn-dark" id="submit_config">Save changes</button>
                                            <button type="submit" class="btn btn-sm btn-dark" id="submit_test_email">Test Email Config</button>
                                        </div>
                                        </div>
                                    </div>
                    </div><!-- /.card-body -->
                </div>

                </form>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
     </div>
        <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->

                                    <?php
                                } else {
                                    echo $settingsArr['message'];
                                } ?>