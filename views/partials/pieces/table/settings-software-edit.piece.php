<?php
/**
 * Modal for editing leaves requested
 **/
require '../../../../config/inc/func.inc.php';
require '../../../../vendor/autoload.php';
$request = new Connect\CSRFHandler;
$auth = new Connect\AuthorizationHandler;
try {
    if (($auth->isLoggedIn())) {
        unset($_POST['csrf_token']);
        $request_id = $_POST['id'];
        $software_info = (new Connect\Contract)->getSoftwareInfo($request_id);
        echo '<input type="hidden" data-toggle="modal" data-target="#x_edit_' . $request_id . '99" data-bs-toggle="modal" data-bs-target="#x_edit_' . $request_id . '99">
<div class="modal fade" id="x_edit_' . $request_id . '99" tabindex="-1" aria-labelledby="x_edit_' . $request_id . '99Label" aria-hidden="true">
   <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editing ' . $software_info['software_description'] . '</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <!--            software checkboxes -->
            <div class="row">
               <div class="col-12">
                  <div class="row">
                     <div class="col-sm-10 offset-1">
                        <form class="form-horizontal" id="software_edit" data-role="update" data-xeid="' . $request_id . '"
                        enctype="multipart/form-data">
                        <div class="form-group row">
<label class="col-sm-4 col-form-label">Enabled or disable this option</label>
<div class="col-sm-4">
<input type="checkbox" name="input_type" value="on" class="jack_"';
        if ($software_info['input_type'] === 'checkbox') {
            echo 'checked';
        }
        echo '/>
<div class="check-change js-check-change-field"></div>
</div>
</div>
                           <div class="form-group row">
                           <div class="col-sm-6">
                                 <label for="">Category</label>
                                 <input type="text" class="form-control" name="software_category" placeholder="Category" value="' . $software_info['software_category'] . '" required>
                              </div>
                              <div class="col-sm-6">
                                 <label for="">Description</label>
                                 <input type="text" class="form-control" name="software_description" placeholder="Description" value="' . $software_info['software_description'] . '" required>
                              </div>                              
                           </div>
                           <div class="form-group row">
                           <div class="col-md-4 offset-md-4">
                              <div id="message_software_info"></div>
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="submit_software_info" data-role="form_submit_btn"
                                 data-action="updateSoftwareInfo" onclick="clientPost(this.id,form.id)">
                              <span class="label">Save Changes</span>
                              </button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
</div>';
    } else {
        http_response_code(401);
        throw new Exception('Unauthorized');
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo json_encode($e->getMessage());
}