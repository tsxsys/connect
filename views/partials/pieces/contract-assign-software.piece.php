<?php
$contract_handler = new Connect\Contract;
$iOArr = $contract_handler->pullAllSoftware();
$iOCheckedArr = $contract_handler->pullCheckedAssignedSoftware($contract_id);
?>
<div class="modal fade" id="assign_software" tabindex="-1" aria-labelledby="assign_softwareLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assign_softwareLabel">Assign Software</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--            software checkboxes -->
                <div class="row">
                    <div class="col-12">
                        <h4 class="sub-title"><i class="fa fa-info-circle"></i> Tick the checkboxes to select the
                            associated software
                        </h4>
                        <div class="row">
                            <?php
                            if ($iOArr['status'] === true) {
                                foreach ($iOArr['software'] as $key => $value) {
                                    $groupedArr[$value[3]][] = $value;
                                }
                                foreach ($groupedArr as $category => $categoryVal) {
                                    echo '
                                        <div class="col-sm-12 col-xl-4 m-b-30">
                                            <h4 class="xx_label">
                                              ' . $category . '
                                            </h4>';
                                    foreach ($categoryVal as $software) {
                                        $software[4] = htmlspecialchars($software[4], ENT_QUOTES);
                                        $software[5] = htmlspecialchars($software[5], ENT_QUOTES);
                                        echo '<div class="checkbox-color checkbox-dark checkbox__block">
                                           <input class="io_select" data-xeid="' . $contract_id . '" id="' . $software[0] . '_998" value="' . $software[0] . '"  type="' . $software[1] . '" name="' . $software[2] . '"';
                                        if (ifInArray($software[0], $iOCheckedArr,"software_id") === true) {
                                            echo 'checked';
                                        }
                                        echo '><label for="' . $software[0] . '_998">' . $software[5] . '</label>
                                       </div>';
                                    }
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary-1 btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>