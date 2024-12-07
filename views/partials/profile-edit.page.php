<?php
$uid  = $_SESSION['u_id'] = $_SESSION['uid'];
$usr = Connect\UserHandler::pullUserById($uid);
$user_info = (new Connect\Contact)->getAllUserInfo($uid);
if (!empty($usr) && !empty($usr_info) && !empty($user_info)) {
    $appConfig = Connect\AppConfig::pullMultiSettings(array("base_url", "avatar_dir", "profile_bg_dir","default_avatar","default_bg"));
//Outputs empty user image if no image exists
    $user_img = $user_info['user_image'];
    $profile_bg_img = $user_info['bg_img'];
    $avatar_dir = $appConfig["base_url"] . $appConfig["avatar_dir"];
    $bg_dir = $appConfig["base_url"] . $appConfig["profile_bg_dir"];
    $default_avatar = "/" . $appConfig["default_avatar"];
    $default_bg = "/" . $appConfig["default_bg"];
    $img_path = imgCheck($avatar_dir, $user_img, $default_avatar);
    $bg_img_path = imgCheck($bg_dir, $profile_bg_img, $default_bg);
    echo '
<!-- Main content -->
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-body">
                   <div class="row">
      <!-- /.col -->
      <div class="col-md-8 offset-md-2">
         <div class="card card-dark">
            <div class="card-header p-2">
               <ul class="nav nav-tabs md-tabs" id="myProfileTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="personal_info_tab" data-bs-toggle="tab" data-bs-target="#personal_info" type="button" role="tab" aria-controls="personal_info" aria-selected="true">Personal
                     Info</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="about_tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="false">About</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="images_tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">Images</button>
                     <div class="slide"></div>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="account_tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="account" aria-selected="false">Account</button>
                     <div class="slide"></div>
                  </li>
               </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <div class="tab-content" id="myProfileTabContent">
                  <div class="tab-pane fade show active" id="personal_info" role="tabpanel" aria-labelledby="personal_info_tab">
                     <form class="form-horizontal" id="profile_edit" data-role="update" data-xeid="' . $user_id . '"
                        enctype="multipart/form-data">
                        <div class="row">
                           <div class="col-12">
                              <div class="form-group row">
                                 <label for="firstname" class="col-sm-3 col-form-label">First
                                 Name</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="firstname" id="firstname" placeholder="First Name"
                                       value="' . $user_info['firstname'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="lastname" class="col-sm-3 col-form-label">Last
                                 Name</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="lastname" id="lastname" placeholder="Last Name"
                                       value="' . $user_info['lastname'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="phone" class="col-sm-3 col-form-label">Phone</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="phone"
                                       id="phone" placeholder="Phone"
                                       value="' . $user_info['phone'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="phone_ext" class="col-sm-3 col-form-label">Phone Ext</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="phone_ext"
                                       id="phone_ext" placeholder="Phone Ext"
                                       value="' . $user_info['phone_ext'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="address_line_1" class="col-sm-3 col-form-label">Address
                                 1</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="address_line_1" placeholder="Address 1" id="address_line_1"
                                       value="' . $user_info['address_line_1'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="address_line_2" class="col-sm-3 col-form-label">Address
                                 2</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="address_line_2" placeholder="Address 2" id="address_line_2"
                                       value="' . $user_info['address_line_2'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="address_line_3" class="col-sm-3 col-form-label">City</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="address_line_3"
                                       placeholder="City" id="address_line_3"
                                       value="' . $user_info['address_line_3'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="address_line_4" class="col-sm-3 col-form-label">State</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="address_line_4"
                                       placeholder="State" id="address_line_4"
                                       value="' . $user_info['address_line_4'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="country" class="col-sm-3 col-form-label">Country</label>
                                 <div class="col-sm-9">
                                    <input type="text"
                                       class="form-control form-control-border form-control-sm editprofile"
                                       name="country" placeholder="Country" id="country"
                                       value="' . $user_info['country'] . '">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="bio" class="col-sm-3 col-form-label">Bio</label>
                                 <div class="col-sm-9">
                                    <textarea rows="6" name="bio"
                                       class="form-control form-control-border form-control-sm"
                                       id="bio">' . $user_info['bio'] . '</textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-4 offset-md-4">
                              <div id="message_person_info"></div>
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="submit_personal_info" data-role="form_submit_btn"
                                 data-action="updateAccountInfo" onclick="updateProfile(this.id,form.id)">
                              <span class="label">Save Changes</span>
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about_tab">
                     <form class="form-horizontal" id="profile_update_about" data-role="update" data-xeid="' . $user_id . '">
                        <div class="form-group row">
                           <label for="education" class="col-sm-2 col-form-label">Education</label>
                           <div class="col-sm-10">
                              <input type="text" class="form-control form-control-border form-control-sm"
                                 id="education" name="education" placeholder="Education"
                                 value="' . $user_info['education'] . '">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="skills" class="col-sm-2 col-form-label">Skills</label>
                           <div class="col-sm-10">
                              <input type="text" class="form-control form-control-border form-control-sm"
                                 id="skills" name="skills" placeholder="Skills"
                                 value="' . $user_info['skills'] . '">
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="experience" class="col-sm-2 col-form-label">Experience</label>
                           <div class="col-sm-10">
                              <textarea class="form-control form-control-border form-control-sm"
                              id="experience" name="experience"';
    if (empty($user_info['experience'])) {
        echo 'placeholder="Experience"';
    }
    echo '>';
    if (!empty($user_info['experience'])) {
        echo $user_info['experience'];
    }
    echo '</textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label for="notes" class="col-sm-2 col-form-label">Notes</label>
                           <div class="col-sm-10">
                              <textarea class="form-control form-control-border form-control-sm"
                                 id="notes" name="notes" placeholder="Notes">';
    if (!empty($user_info['notes'])) {
        echo $user_info['notes'];
    }
    echo '</textarea>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-4 offset-md-4">
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="submit_about_info" data-role="form_submit_btn"
                                 data-action="updateAccountInfo" onclick="updateProfile(this.id,form.id)">
                              <span class="label">Save Changes</span>
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images_tab">
                     <form class="form-horizontal" id="form_profile_img_update" data-role="update" data-action="updateAccountImg"
                        method="post" enctype="multipart/form-data" data-xeid="' . $user_id . '">
                        <div class="row">
                           <div class="col-12">
                              <p class="text-bold">Select your profile image</p>
                              <div class="img_upload">
                                 <div class="img_edit">
                                    <input type="file" class="imageUploadIn" id="imageUpload" data-target="imagePreview"
                                       name="user_image" accept=".png, .jpg, .jpeg" required/>
                                    <label for="imageUpload"></label>
                                 </div>
                                 <div class="img_preview">
                                    <div id="imagePreview" style="background-image: url(' . $img_path . ');">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row form-group">
                           <div class="col-md-4 offset-md-4">
                              <div class="message"></div>
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="submit_profile_img_update" data-role="form_submit_btn"
                                 data-action="updateImg" disabled>
                              <span class="label">Change Image</span>
                              </button>
                           </div>
                        </div>
                     </form>
                     <form class="form-horizontal" id="form_profile_bg_img_update" data-role="update" data-action="updateAccountBgImg"
                        method="post" enctype="multipart/form-data" data-xeid="' . $user_id . '">
                        <div class="row">
                           <div class="col-12">
                              <p class="text-bold">Select your background image</p>
                              <div class="img_upload bg__img_upload">
                                 <div class="img_edit">
                                    <input type="file" class="imageUploadIn" id="bg__imageUpload" data-target="bg__imagePreview"
                                       name="bg_img" accept=".png, .jpg, .jpeg" />
                                    <label for="bg__imageUpload"></label>
                                 </div>
                                 <div class="img_preview">
                                    <div id="bg__imagePreview" style="background-image: url(' . $bg_img_path . ');">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row form-group">
                           <div class="col-md-4 offset-md-4">
                              <div class="message"></div>
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="submit_profile_bg_img_update" data-role="form_submit_btn"
                                 data-action="updateBgImg" disabled>
                              <span class="label">Change Image</span>
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account_tab">
                     <form class="form-horizontal" id="account_e_edit" data-xeid="' . $user_id . '">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group row">
                                 <label for="username" class="col-sm-3 col-form-label">Username</label>
                                 <div class="col-sm-9">
                                    <span class="form-control form-control-border form-control-sm input__disabled"
                                       disabled>' . $usr['username'] . '</span>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="email" class="col-sm-3 col-form-label">Email <span class="required">*</span></label>
                                 <div class="col-sm-9">
                                    <input type="email" name="email" id="email"
                                       class="form-control form-control-border form-control-sm"
                                       value="' . $usr['email'] . '" required>
                                 </div>
                                 <span class="col-sm-9 col-xs-12 offset-sm-3 input_response center mt-2"></span>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-4 offset-md-4">
                              <div id="message_account_e_info"></div>
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="submit_account_e_info" data-action="updateAccountEmail"
                                 onclick="updateProfile(this.id,form.id)" disabled>
                              <span class="label">Change Email</span>
                              </button>
                           </div>
                        </div>
                     </form>
                     <form class="form-horizontal" id="account_pwd_edit" data-xeid="' . $user_id . '">
                        <div class="row">
                           <div class="col-md-12">
                              <p class="text-bold">Reset Password</p>
                              <div class="form-group row">
                                 <label for="password1" class="col-sm-3 col-form-label">Password</label>
                                 <div class="col-sm-9">
                                    <input name="password1" id="password1" type="password"
                                       class="form-control form-control-border form-control-sm"
                                       placeholder="New Password">
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label for="password2" class="col-sm-3 col-form-label">Confirm
                                 Password</label>
                                 <div class="col-sm-9">
                                    <input name="password2" id="password2" type="password"
                                       class="form-control form-control-border form-control-sm"
                                       placeholder="Confirm Password">
                                    <span id="password2_error" class="error invalid-feedback"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div id="message_account_ps_info" class="col-md-10 offset-md-1 mb-3"></div>
                           <div class="col-md-4 offset-md-4">
                              <button type="submit" class="btn btn-dark-2 btn-block"
                                 id="reset_account_pwd" data-action="updateAccountPwd"
                                 onclick="updateProfile(this.id, form.id)" disabled>
                              <span class="label">Reset Password</span>
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
            </div>

        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
   <div class="container-fluid">

   </div>
</section>
';
} else {
    echo "<script type='text/javascript'> document.location = 'error.php?t=404'; </script>";
}